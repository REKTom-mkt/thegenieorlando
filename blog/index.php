<?php include_once('admin/config.php'); ?>
<?php include_once('admin/functions.php'); ?>
<?php
//URL info
$serverUriParts = explode('?', $_SERVER['REQUEST_URI']);
$serverUri = $serverUriParts[0];

//Blog Informations
$bloginfo = blog_info();

$blog_title = $bloginfo->blog_name;
$meta_title = $bloginfo->blog_meta_title;
$meta_desc = $bloginfo->blog_meta_desc;
$meta_author = $bloginfo->blog_name;

$blogs = $blog->get_blogs(true);

//TODO: Move all logic to controller
//invalid page number
if (isset($_GET['page']) && !is_numeric($_GET['page'])) {
    redirectPageNotFound();
}

//Backwards compatibility for page numbers
if ($blogs) {
    $iPage = max((int) $_GET['page'], 1 );
    $iPagination = ($bloginfo->blog_pagination > 0 ? $bloginfo->blog_pagination : 10);

    //Get blogs by page
    $blogChunks = array_chunk($blogs, $iPagination);

    //If not a custom blog link then paginate
    if (substr($serverUri, -5) != '.html') {
        $blogs = $blogChunks[$iPage - 1];
    }

    //Min and Max Pages
    $iPageMax = count($blogChunks);
    $iPageCharMaxLength = strlen((string)$iPageMax);

    //Page Navigation
    $showPrevious = ($iPage > 1);
    $showNext = ($iPage != $iPageMax);

    //invalid page number
    if ($iPage > $iPageMax) {
        redirectPageNotFound();
    }
}

define('RELATIVE_SITE_URL', '/' . array_values(array_slice(explode('/', dirname(__FILE__)), -1))[0] . '/');

//subfolder blogname support - /blog/2009/blogname.html
$bBlogFound = false;
$sSubfolderSafeUri = '/' . array_values(array_slice(array_filter(explode('/', $serverUri)), -1))[0] . '/';
$sBlogName = str_replace(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '', $serverUri);
if (substr($serverUri, -5) == '.html') {
    $sBlogRealName = str_replace('/', '+', $sBlogName);
    if (count($blogs) > 0) {
        foreach ($blogs as $oBlog) {
            if ($oBlog->custom_blog_url == $sBlogName) {
                include $sBlogRealName;
                $bBlogFound = true;
                break;
            }
        }
    }

    if (!$bBlogFound) {
        redirectPageNotFound();
    } else {
        exit;
    }

} elseif ((!isset($_GET['page']) && basename($serverUri) != 'index.php' && RELATIVE_SITE_URL != $sSubfolderSafeUri) || $sBlogName) {
    redirectPageNotFound();
}

include_once('admin/blog_header.php');
?>

<div class="container" id="blog-listing">
    <div class="row">
        <div class="col-12">
            <div class="custom_blog_html">
                <h2 class="blog_page_heading">Blog Page</h2>
                <div class="blog_listing_front">
                    <table id="blog_list_front" >
                        <thead style="display:none;">
                            <tr>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($blogs) {
                                foreach ($blogs as $blogdata) {
                                    $blog_post_status = $blogdata->blog_post_status;
                                    if ($blog_post_status == 'Published') {
                                        $blog_title = htmlentities($blogdata->blog_title,ENT_QUOTES);
                                        $blog_sub_title = htmlentities($blogdata->blog_sub_title,ENT_QUOTES);
                                        $custom_blog_url = $blogdata->custom_blog_url;
                                        $blog_content = $blogdata->blog_content;
                                        $blog_url = blog_url($custom_blog_url);
                                        $blog_featured_image = $blogdata->blog_featured_image;
                                        $iContentLength = ($bloginfo->listing_description_count && $bloginfo->listing_description_count > 0 ? $bloginfo->listing_description_count : 255);
                                        ?>

                                        <tr>
                                            <td>
                                                <div class="blog_list">
                                                    <h3 class="main_heading"><a href="<?php echo $blog_url; ?>"><?=$blog_title; ?></a></h3>
                                                    <h4 class="sub_heading"><?=$blog_sub_title; ?></h4>

                                                    <?php if ($blog_featured_image != '') { ?>
                                                        <div class="imgthumbnail_wr">
                                                            <a href="<?php echo $blog_url; ?>"><img class="img-responsive" src="<?php echo upload_url($blog_featured_image); ?>" alt="<?= substr($blog_title, 0, 100); ?>" /></a>
                                                        </div>
                                                    <?php } ?>
                                                    <p><?php echo strip_tags(substr($blog_content, 0, $iContentLength)) .'...'; ?></p>
                                                    <div class="blog-list-button"><a href="<?php echo $blog_url; ?>"><button class="listing-button">Continue Reading</button></a></div>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>

                    </table>

                    <!--Page Navigation -->
                    <div class="text-right">
                        <hr>
                        <?php if($showPrevious):?>
                        <a href="?page=<?=$iPage - 1?>" class="btn btn-secondary mr-3 d-inline-block">Previous</a>
                        <?php endif;?>

                        <form action="" method="GET" class="d-inline-block">
                            <div class="input-group mb-3">
                                <input type="text" name="page" value="<?=$iPage?>" maxlength="<?=$iPageCharMaxLength?>" size="<?=$iPageCharMaxLength?>" max="<?=$iPageMax?>" class="form-control" aria-describedby="total-pages">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="total-pages">of <?=$iPageMax?></span>
                                </div>
                                <input type="submit" value="Go" class="ml-2">
                            </div>
                        </form>

                        <?php if($showNext):?>
                        <a href="?page=<?=$iPage + 1?>" class="btn btn-secondary ml-3 d-inline-block">Next</a>
                        <?php endif;?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once('admin/blog_footer.php');


$pagename = basename($_SERVER['PHP_SELF']);
if ($pagename == 'index.php') {
    ?>
    <!-- Index Page Scripts-->

<?php } ?>

</body>
</html>