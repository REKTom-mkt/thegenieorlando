<?php

/**
 * Blogs
 * @author Tech Productions, Inc.
 */
class Blogs {
    /*
     * Function Add Blog
     */

    public function add_blog() {

        $blog_title = trim($_POST['blog_title']);
        $blog_sub_title = trim($_POST['blog_sub_title']);
        $custom_url_switch = trim($_POST['custom_url_switch']);
        $custom_blog_url = string_to_slug(trim($_POST['custom_blog_url']));
        $blog_content = trim($_POST['blog_content']);
        $blog_meta_title = trim($_POST['blog_meta_title']);
        $blog_meta_desc = trim($_POST['blog_meta_desc']);
        $blog_author = trim($_POST['blog_author']);
        $blog_post_status = trim($_POST['blog_post_status']);
        $uploaded_file = $_FILES['blog_featured_image'];
        $hide_banner = (int) trim($_POST['hide_banner']);
        $featured_image_url = '';

        // File Upload
        $filedata = $this->upload($uploaded_file);
        if ($filedata['status'] == 1) {
            $featured_image_url = $filedata['location'];
        }

        // Check if all required value given
        if (($blog_title != '') && ($blog_content != '') && ($blog_author != '')) :

            if (!$custom_url_switch) {
                $custom_blog_url = string_to_slug($blog_title) . '.html';
            }

            // Time With File Name
            $filelocation = PUBLICHTMLPATH . '/' . $custom_blog_url;

            // Check if file exists
            if (file_exists($filelocation)) {
                $actual_name = pathinfo($filelocation, PATHINFO_FILENAME);
                $custom_blog_url = (string) $actual_name . '-' . time() . ".html";
            }

            $extension = pathinfo($custom_blog_url, PATHINFO_EXTENSION);
            if ($extension == '') {
                $extension = 'html';
                $custom_blog_url = $custom_blog_url . '.' . $extension;
            }

            //Get blogs
            $dbfilepath = SYSTEMPATH . '/database/blogs.json';
            $dbfilejson = file_get_contents($dbfilepath);
            $dbfileobj = json_decode($dbfilejson);

            $custom_blog_url = $this->getUniqueBlogUrl($custom_blog_url, $dbfileobj);

            if ($blog_post_status == 'Published') {

                // Create File
                $fstatus = $this->create_html_file($custom_blog_url, $blog_meta_title, $blog_meta_desc, $blog_author, $blog_title, $blog_content, $blog_sub_title, $featured_image_url, $custom_blog_url, $hide_banner);
            } else {
                $fstatus = 1;
            }

            if ($fstatus == 1) {

                //First Object To Array
                $dbfilearry = [];
                if ($dbfileobj) {
                    foreach ($dbfileobj as $dbfobj_key => $dbobj) {
                        $dbfilearry[$dbfobj_key] = $dbobj;
                    }
                }

                $inildatacount = count($dbfilearry);
                ksort($dbfilearry);    // Fix reverse Storage
                $lastdata = end($dbfilearry);
                $lastdataid = $lastdata->id;

                // Today Date and Time
                $today = date("F j, Y, g:i a");

                $newblog = new stdClass();
                $newblog->id = $lastdataid + 1;
                $newblog->blog_title = $blog_title;
                $newblog->blog_sub_title = $blog_sub_title;
                $newblog->custom_url_switch = $custom_url_switch;
                $newblog->custom_blog_url = $custom_blog_url;
                $newblog->blog_content = $blog_content;
                $newblog->blog_meta_title = $blog_meta_title;
                $newblog->blog_meta_desc = $blog_meta_desc;
                $newblog->blog_author = $blog_author;
                $newblog->blog_post_status = $blog_post_status;
                $newblog->blog_featured_image = $featured_image_url;
                $newblog->hide_banner = $hide_banner;
                $newblog->blog_registered = $today;

                $dbfilearry[] = $newblog;

                $finaldatacount = count($dbfilearry);

                if ($finaldatacount > $inildatacount) {

                    $dbfilearryjson = json_encode(array_values($dbfilearry)); //reset array keys on save
                    // Save in Database
                    file_put_contents($dbfilepath, $dbfilearryjson);

                    if (SYSTEMMODE == 'TEST') :
                        console_log('New blog inserted.');
                    endif;

                    return 1;
                } else {

                    if (SYSTEMMODE == 'TEST') :
                        console_log('New blog not inserted.');
                    endif;

                    return 0;
                }
            } if ($fstatus == 3) {
                return $fstatus;
            } else {
                return 0;
            }

        endif;
    }

    /*
     * Function For Retrive All Blogs
     */

    public function get_blogs($isActive = false) {

        $dbfilepath = SYSTEMPATH . '/database/blogs.json';
        $dbfilejson = file_get_contents($dbfilepath);
        $dbfilearry = (array) json_decode($dbfilejson);

        // Reverse Sort
        if ($dbfilearry) {
            krsort($dbfilearry);

            //Remove drafts from blog results
            if ($isActive) {
                foreach ($dbfilearry as $dataKey => $blogData) {
                    if ($blogData->blog_post_status != 'Published') {
                        unset($dbfilearry[$dataKey]);
                    }
                }
            }

        }

        return $dbfilearry;
    }

    /*
     * Get Blog By ID
     */

    public function get_blog_by_id($blog_id) {

        $blog = array();

        $blogs = $this->get_blogs();
        if ($blogs) {
            foreach ($blogs as $blogdata) {
                if ($blog_id == $blogdata->id) {
                    $blog = $blogdata;
                    break;
                }
            }
        }

        return $blog;
    }

    /*
     * Get Blog By Author ID
     */

    public function get_blog_by_author_id($blog_id) {

        $blog = array();

        $blogs = $this->get_blogs();
        if ($blogs) {
            foreach ($blogs as $blogdata) {
                if ($blog_id == $blogdata->id) {
                    $blog = $blogdata;
                    break;
                }
            }
        }

        return $blog;
    }

    /*
     * Delete Blog
     */

    public function delete($blog_id) {

        $newblog = array();
        $blogs = $this->get_blogs();

        if ($blogs) {

            // Delete Blog
            foreach ($blogs as $blogkey => $blogdata) {
                if ($blog_id != $blogdata->id) {
                    $newblog[$blogkey] = $blogdata;
                } else {

                    //support subfolders
                    if (strpos($blogdata->custom_blog_url, '/')) {
                        $blogdata->custom_blog_url = str_replace('/', '+', $blogdata->custom_blog_url);
                    }

                    // Delete HTML File
                    $custom_blog_url = $blogdata->custom_blog_url;
                    $filelocation = PUBLICHTMLPATH . '/' . $custom_blog_url;
                    if (is_file($filelocation)) {
                        unlink($filelocation);
                    }

                    //delete featured image
                    if (is_file(SYSTEMPATH . '/uploads/' . $blogdata->blog_featured_image)) {
                        unlink(SYSTEMPATH . '/uploads/' . $blogdata->blog_featured_image);
                    }
                    //delete ckuploads
                    $this->delete_ckuploads($blogdata->blog_content);
                }
            }

            $dbfilepath = SYSTEMPATH . '/database/blogs.json';
            $dbfilearryjson = json_encode($newblog);
            file_put_contents($dbfilepath, $dbfilearryjson);

            return 1;
        } else {
            return 0;
        }
    }

    /*
     * Delete Blog From List
     */

    public function delete_from_list($blog_array, $bDeleteAll = FALSE) {

        $newblog = array();
        $blogs = $this->get_blogs();

        if (is_array($blog_array) && count($blog_array) > 0 && $blogs) {
            // Delete Blog From List
            foreach ($blogs as $blogkey => $blogdata) {
                if (!in_array($blogdata->id, $blog_array) && !$bDeleteAll) {
                    $newblog[$blogkey] = $blogdata;
                } else {
                    //support subfolders
                    if (strpos($blogdata->custom_blog_url, '/')) {
                        $blogdata->custom_blog_url = str_replace('/', '+', $blogdata->custom_blog_url);
                    }

                    // Delete HTML File
                    $custom_blog_url = $blogdata->custom_blog_url;
                    $filelocation = PUBLICHTMLPATH . '/' . $custom_blog_url;
                    if (is_file($filelocation)) {
                        unlink($filelocation);
                    }
                    //delete featured image
                    if (is_file(SYSTEMPATH . '/uploads/' . $blogdata->blog_featured_image)) {
                        unlink(SYSTEMPATH . '/uploads/' . $blogdata->blog_featured_image);
                    }
                    //delete ckuploads
                    $this->delete_ckuploads($blogdata->blog_content);
                }
            }

            $dbfilepath = SYSTEMPATH . '/database/blogs.json';
            $dbfilearryjson = json_encode($newblog);
            file_put_contents($dbfilepath, $dbfilearryjson);

            return 1;
        } else {
            return 0;
        }
    }

    /*
     * Delete All Blogs
     */

    public function delete_all() {

        //delete all physical files
        $this->delete_from_list(array(0), TRUE);

        $newauthors = '[{}]';
        $dbfilepath = SYSTEMPATH . '/database/blogs.json';
        file_put_contents($dbfilepath, $newauthors);

        //delete all ckeditor uploads
        $files = glob(SYSTEMPATH . '/ckuploads/*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }

        //delete all featured image uploads
        $files = glob(SYSTEMPATH . '/uploads/*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }

        return 1;
    }

    /*
     * Delete ckuploads
     */

    public function delete_ckuploads($sCKEditorContent = '') {
        if (trim($sCKEditorContent)) {
            $aCkEditorImageLinks = explode('ckuploads', $sCKEditorContent);
            foreach ($aCkEditorImageLinks as $sCkEditorLink) {
                //delete ckeditor images
                $aJpgImage = explode('.jpg', strtolower($sCkEditorLink));
                $aJpegImage = explode('.jpeg', strtolower($sCkEditorLink));
                $aPngImage = explode('.png', strtolower($sCkEditorLink));
                if (count($aJpgImage) > 1 && is_file(SYSTEMPATH . '/ckuploads' . $aJpgImage[0] . '.jpg')) {
                    //delete jpg
                    unlink(SYSTEMPATH . '/ckuploads' . $aJpgImage[0] . '.jpg');
                } else if (count($aJpegImage) > 1 && is_file(SYSTEMPATH . '/ckuploads' . $aJpegImage[0] . '.jpeg')) {
                    //delete jpeg
                    unlink(SYSTEMPATH . '/ckuploads' . $aJpegImage[0] . '.jpeg');
                } else if (count($aPngImage) > 1 && is_file(SYSTEMPATH . '/ckuploads' . $aPngImage[0] . '.png')) {
                    //delete png
                    unlink(SYSTEMPATH . '/ckuploads' . $aPngImage[0] . '.png');
                }
            }
        }
    }

    /*
     * Delete featured image
     */
    public function delete_featured_image ($iBlogId) {
        if((int)$iBlogId>0){
            $aNewBlog = array();
            $aBlogs = $this->get_blogs();
            if(count($aBlogs)>0){
                foreach ($aBlogs as $iBlogKey => $oBlogData) {
                    if($oBlogData->id == (int) $iBlogId){
                        //delete featured image
                        if (is_file(SYSTEMPATH . '/uploads/' . $oBlogData->blog_featured_image)) {
                            unlink(SYSTEMPATH . '/uploads/' . $oBlogData->blog_featured_image);
                        }
                        $oBlogData->blog_featured_image = '';
                    }
                    $aNewBlog[$iBlogKey] = $oBlogData;
                }
                $dbfilepath = SYSTEMPATH . '/database/blogs.json';
                $dbfilearryjson = json_encode($aNewBlog);
                file_put_contents($dbfilepath, $dbfilearryjson);

                return TRUE;
            }
        }
    }

    /*
     * Update Blog
     */

    public function update() {

        $result = 0;

        $blog_id = (int) $_POST['blog_id'];

        $blog_title = trim($_POST['blog_title']);
        $blog_sub_title = trim($_POST['blog_sub_title']);
        $custom_url_switch = trim($_POST['custom_url_switch']);
        $custom_blog_url = string_to_slug(trim($_POST['custom_blog_url']));
        $blog_content = trim($_POST['blog_content']);
        $blog_meta_title = trim($_POST['blog_meta_title']);
        $blog_meta_desc = trim($_POST['blog_meta_desc']);
        $blog_author = trim($_POST['blog_author']);
        $blog_post_status = trim($_POST['blog_post_status']);
        $uploaded_file = $_FILES['blog_featured_image'];
        $hide_banner = (int) trim($_POST['hide_banner']);
        $featured_image_url = '';

        // File Upload
        if ($uploaded_file['name'] && $blog_id > 0) {
            $oBlog = (object) $this->get_blog_by_id($blog_id);
            $filedata = $this->upload($uploaded_file, NULL, $oBlog->blog_featured_image);
        }

        if ($filedata['status'] == 1) {
            $featured_image_url = $filedata['location'];
        }

        $blogs = $this->get_blogs();

        if ($blogs) {
            foreach ($blogs as $blogdata) {
                if ($blog_id == $blogdata->id) {

                    if (!$custom_url_switch) {
                        $custom_blog_url = string_to_slug($blog_title) . '.html';
                    }

                    $blogdata->blog_title = $blog_title;
                    $blogdata->blog_sub_title = $blog_sub_title;
                    $blogdata->custom_url_switch = $custom_url_switch;

                    $extension = pathinfo($custom_blog_url, PATHINFO_EXTENSION);
                    if ($extension == '') {
                        $extension = 'html';
                        $custom_blog_url = $custom_blog_url . '.' . $extension;
                    }

                    $sOldFileUrl = '';
                    if (($custom_blog_url != '') && ($custom_blog_url != $blogdata->custom_blog_url)) {
                        $sOldFileUrl = $blogdata->custom_blog_url;
                        $blogdata->custom_blog_url = $custom_blog_url;
                    }

                    if ($blog_post_status == 'Published') {
                        // Update File
                        if ($featured_image_url == '') {
                            $featured_image_url = $blogdata->blog_featured_image;
                        }
                        $this->create_html_file($custom_blog_url, $blog_meta_title, $blog_meta_desc, $blog_author, $blog_title, $blog_content, $blog_sub_title, $featured_image_url, $custom_blog_url, $hide_banner);

                        //support subfolders
                        if (strpos($sOldFileUrl, '/')) {
                            $sOldFileUrl = str_replace('/', '+', $sOldFileUrl);
                        }
                        //delete old file
                        if (trim($sOldFileUrl) && is_file(PUBLICHTMLPATH . '/' . $sOldFileUrl)) {
                            unlink(PUBLICHTMLPATH . '/' . $sOldFileUrl);
                        }
                    }

//                    Delete File
                    if ($blog_post_status == 'Draft') {
                        $filelocation = PUBLICHTMLPATH . '/' . $custom_blog_url;
                        unlink($filelocation);
                    }


                    $blogdata->blog_content = $blog_content;
                    $blogdata->blog_meta_title = $blog_meta_title;
                    $blogdata->blog_meta_desc = $blog_meta_desc;
                    $blogdata->blog_author = $blog_author;
                    $blogdata->blog_post_status = $blog_post_status;
                    if ($featured_image_url != '') {
                        $blogdata->blog_featured_image = $featured_image_url;
                    }
                    $blogdata->hide_banner = $hide_banner;
                }
            }

            $dbfilepath = SYSTEMPATH . '/database/blogs.json';

            $blogsjson = json_encode($blogs);

            file_put_contents($dbfilepath, $blogsjson);

            if (SYSTEMMODE == 'TEST') :
                console_log('Blog updated.');
            endif;

            $result = 1;
        } else {
            if (SYSTEMMODE == 'TEST') :
                console_log('New blog not updated.');
            endif;
        }

        return $result;
    }

    /*
     * Update Blogs Status
     */

    public function update_status($blogslist, $newstatus) {

        $result = 0;

        $blogs = $this->get_blogs();

        if ($blogs) {
            foreach ($blogs as $blogdata) {
                if (in_array($blogdata->id, $blogslist)) {
                    $blogdata->blog_post_status = $newstatus;
                } else {
                    // echo "no";
                }
            }

            $dbfilepath = SYSTEMPATH . '/database/blogs.json';
            $blogsjson = json_encode($blogs);
            file_put_contents($dbfilepath, $blogsjson);

            if (SYSTEMMODE == 'TEST') :
                console_log('Blog updated.');
            endif;

            $result = 1;
        } else {
            if (SYSTEMMODE == 'TEST') :
                console_log('New blog not updated.');
            endif;
        }

        return $result;
    }

    /*
     * Function For Retrive All Editing blogs
     */

    public function get_temp_edit() {

        $dbfilepath = SYSTEMPATH . '/database/temp_edit.json';
        $dbfilejson = file_get_contents($dbfilepath);
        $dbfilearry = json_decode($dbfilejson);

        return $dbfilearry;
    }

    /*
     * Update Blogs Status
     */

    public function blog_takeover($blog_id, $author_name) {

        $result = 0;

        $blogs = $this->get_temp_edit();

        if ($blogs) {

            foreach ($blogs as $blogdata) {
                if ($blogdata->blog_id == $blog_id) {
                    $blogdata->author_name = $author_name;
                }
            }

            $dbfilepath = SYSTEMPATH . '/database/temp_edit.json';
            $blogsjson = json_encode($blogs);
            file_put_contents($dbfilepath, $blogsjson);

            if (SYSTEMMODE == 'TEST') :
                console_log('Takeover applied.');
            endif;

            $result = 1;
        }

        return $result;
    }

    /*
     * Insert Edit Blog
     */

    public function insert_temp_edit($blog_id, $author_name) {

        $result = 0;

        $dbfilepath = SYSTEMPATH . '/database/temp_edit.json';
        $dbfilejson = file_get_contents($dbfilepath);
        $dbfileobj = json_decode($dbfilejson);

        // First Object To Array
        if ($dbfileobj) {
            foreach ($dbfileobj as $dbfobj_key => $dbobj) {
                $dbfilearry[$dbfobj_key] = $dbobj;
            }
        }

        $inildatacount = count($dbfilearry);

        $lastdata = end($dbfilearry);
        $lastdataid = $lastdata->id;

        $newblog = new stdClass();
        $newblog->id = $lastdataid + 1;
        $newblog->blog_id = $blog_id;
        $newblog->author_name = $author_name;

        $dbfilearry[] = $newblog;

        $finaldatacount = count($dbfilearry);

        if ($finaldatacount > $inildatacount) {

            $dbfilearryjson = json_encode($dbfilearry);

            // Save in Database
            file_put_contents($dbfilepath, $dbfilearryjson);

            $result = 1;
        }

        return $result;
    }

    /*
     * Create a new HTML File
     */

    function create_html_file($file_name, $meta_title = '', $meta_desc = '', $meta_author = '', $blog_title = '', $generatedhtml = '', $blog_sub_title = '', $blog_featured_image = '', $custom_blog_url = '', $hide_banner = 0) {

        $user = new Users();
        $authormeta = $user->get_user_by_id($meta_author);

        $meta_author = $authormeta->firstname . ' ' . $authormeta->lastname;

        //support subfolders
        if (strpos($file_name, '/')) {
            $file_name = str_replace('/', '+', $file_name);
        }

        //hide banner
        if ($hide_banner) {
            $blog_featured_image = '';
        }

        if ($file_name != '') {

            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            if ($extension == '') {
                $extension = 'html';
                $file_name . '.' . $extension;
            }

            if (($extension == 'html') || ($extension == 'htm')) {

                $filelocation = PUBLICHTMLPATH . '/' . $file_name;

                $htmlfile = fopen($filelocation, "w");
                $bloginfo = blog_info();

                ob_start();
                include('blog_header.php');

                if ($bloginfo->blog_breadcrumb == 'Yes') {
                    echo $php_breadcrumb = php_breadcrumb($blog_title);
                }

                $blog_header = ob_get_clean();

                ob_start();
                include('blog_footer.php');
                echo '</body></html>';
                $blog_title = htmlentities($blog_title,ENT_QUOTES);
                $blog_sub_title = htmlentities($blog_sub_title,ENT_QUOTES);
                $blog_footer = ob_get_clean();
                $image = upload_url($blog_featured_image);
                $content = strip_tags($generatedhtml);
                $url = site_url($custom_blog_url);
                $social_share_links = ($bloginfo->allow_sharing ? social_share_links($blog_title, $content, $image, $url) : '');
                $htmlcontent = '
<div class="container" id="blog-details">
    <div class="row">
        <div class="col-12">
            <div class="custom_blog_html">
            ' . $social_share_links . '
            <h2 class="sub_heading">' . $blog_sub_title . '</h2> ';
                if ($blog_featured_image != '') {
                    $htmlcontent .= '<img class="img-thumbnail img-responsive m-0 mb-2" src="' . upload_url($blog_featured_image) . '" alt="' . substr($blog_title,0,100) . '" />';
                }
                $htmlcontent .= $generatedhtml . '</div>

        </div>
    </div>
</div>
';
                //social media javascript
                if ($bloginfo->allow_sharing) {
                    $htmlcontent .= '
  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=289057962041758&autoLogAppEvents=1"></script>
<!--LinkedIn Javascript snippet-->
<script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
<!--/LinkedIn Javascript snippet-->
';
                }

                fwrite($htmlfile, $blog_header . $htmlcontent . $blog_footer);
                fclose($htmlfile);

                return 1;
            } else {

                return 3;
            }
        } else {
            return 2;
        }
    }

    /*
     * Regenerate Blog Templates
     */

    public function regen_templates() {

        $result = 0;

        $blogs = $this->get_blogs();

        if ($blogs) {

            //Clean up directory
            $excludeFiles = ['404.html'];
            $mainDirectoryFiles = array_diff(scandir(PUBLICHTMLPATH), array('.', '..'));
            if ($mainDirectoryFiles) {
                foreach ($mainDirectoryFiles as $fileName) {
                    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                    if ($extension == 'html' && !in_array($fileName, $excludeFiles)) {
                        unlink( PUBLICHTMLPATH . '/' . $fileName);
                    }
                }
            }

            //Build templates
            foreach ($blogs as $blogdata) {

                $blog_title = $blogdata->blog_title;
                $blog_sub_title = $blogdata->blog_sub_title;
                $custom_blog_url = $blogdata->custom_blog_url;
                $blog_content = $blogdata->blog_content;
                $blog_meta_title = $blogdata->blog_meta_title;
                $blog_meta_desc = $blogdata->blog_meta_desc;
                $blog_author = $blogdata->blog_author;
                $blog_post_status = $blogdata->blog_post_status;
                $blog_featured_image = $blogdata->blog_featured_image;
                $hide_banner = $blogdata->hide_banner;

                // Delete File
//                $filelocation = PUBLICHTMLPATH.'/'.$custom_blog_url;
//                unlink($filelocation);
                if ($blog_post_status == 'Published') {

                    // Create HTML Template
                    $this->create_html_file($custom_blog_url, $blog_meta_title, $blog_meta_desc, $blog_author, $blog_title, $blog_content, $blog_sub_title, $blog_featured_image, $custom_blog_url, $hide_banner);
                }
//                sleep(2);
            }

            if (SYSTEMMODE == 'TEST') :
                console_log('Templates Regenerated');
            endif;

            $result = 1;
        } else {
            if (SYSTEMMODE == 'TEST') :
                console_log('Templates not updated');
            endif;

            $result = 0;
        }

        return $result;
    }

    /*
     * Upload File
     */

    public function upload($FILE, $newfilename = '', $old_file = '') {
        $output = array();
        $newfilename = trim($newfilename);

        // If File Uploaded
        if ($FILE['name']) {

            // If Error Not Found
            if (!$FILE['error']) {

                $file_temp_name = $FILE['tmp_name'];
                $file_name = strtolower(basename($FILE['name']));
                $file_size = $FILE['size'];
                $file_type = $FILE['type'];

                $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                //check image mime types
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mtype = finfo_file($finfo, $file_temp_name);
                finfo_close($finfo);
                if ($mtype != 'image/jpeg' && $mtype != 'image/png') {
                    $extension = 'FALSE';
                }

                if (($extension == 'png') || ($extension == 'jpg') || ($extension == 'jpeg') || ($extension == 'gif')) {
                    // Destination/Target Path
                    $current_dir = getcwd();
                    $date = date("Y");

                    if ($newfilename != '') {
                        $file_name = $newfilename . "." . $extension;
                    }

                    $file_name = strtolower(str_replace(' ', '_', $file_name));

                    $target_path = $current_dir . '/uploads/' . $date . '/' . $file_name;

                    //create directory if not exist
                    if (!is_dir($current_dir . '/uploads/' . $date . '/')) {
                        mkdir($current_dir . '/uploads/' . $date . '/', 0777, true);
                    }

                    // Data and Time
                    $actual_name = pathinfo($file_name, PATHINFO_FILENAME);
                    if (file_exists($target_path)) {
                        $current_date_time = '_' . time();
                        $new_file_name = (string) $actual_name . $current_date_time;
                        $new_name = $new_file_name . "." . $extension;
                        $target_path = $current_dir . '/uploads/' . $date . '/' . $new_name;
                    }

                    if (!$new_name) {
                        $new_name = $file_name;
                    }

                    // File Size Filter
                    if ($file_size > (4096000)) {
                        $output['message'] = '<div class="alert alert-danger" role="alert">Oops!  Your file\'s size is to large than 4 MB.</div>';
                    } else {
                        // Move Uploaded File to folder
                        $bUploadResult = move_uploaded_file($file_temp_name, $target_path);
                        if ($bUploadResult) {
                            //remove old pictures
                            if ($old_file) {
                                unlink($current_dir . '/uploads/' . $old_file);
                            }

                            $upload_location = $date . '/' . $new_name;
                            $output['location'] = $upload_location;
                            $output['status'] = 1;
                            $output['message'] = 'File Uploaded';
                        } else {
                            $output['status'] = 0;
                            $output['message'] = '<div class="alert alert-danger" role="alert">Unable to upload file. Please try again.</div>';
                        }
                    }
                } else {
                    $output['status'] = 0;
                    $output['message'] = '<div class="alert alert-danger" role="alert">Invalid file format.</div>';
                }
            } else {
                $output['status'] = 0;
                $output['message'] = '<div class="alert alert-danger" role="alert">Unable to upload file. Please try again.</div>';
            }
        }

        return $output;
    }

    private function getUniqueBlogUrl($custom_blog_url, $blogList)
    {
        // Check if blog custom URL exists and append an incrementing duplicate number to the custom URL if it already exists
        $urlExist = false;
        $duplicateNumber = 0;
        $newUrlHasDuplicateNumber = false;

        if ($blogList) {

            foreach ($blogList as $oBlog) {
                //Get existing base url and extension
                $existingUrlDirectory = pathinfo($oBlog->custom_blog_url, PATHINFO_DIRNAME) ? pathinfo($oBlog->custom_blog_url, PATHINFO_DIRNAME) . '/' : '';
                $existingUrl = $existingUrlDirectory . pathinfo($oBlog->custom_blog_url, PATHINFO_FILENAME);
                $existingUrlExtension = pathinfo($oBlog->custom_blog_url, PATHINFO_EXTENSION);

                //Get duplicate number if exist
                if (preg_match('/^(\S+)_([0-9]+)$/', $existingUrl, $matches)) {
                    $existingUrlBase = $matches[1];
                    $existingDuplicateNumber = intval($matches[2]);
                } else {
                    $existingUrlBase = $existingUrl;
                    $existingDuplicateNumber = 0;
                }

                //If existing URL and new url have the same extension then check if base URLs are the same
                if ($existingUrlExtension == pathinfo($custom_blog_url, PATHINFO_EXTENSION)) {
                    $newUrlDirectory = pathinfo($custom_blog_url, PATHINFO_DIRNAME) ? pathinfo($custom_blog_url, PATHINFO_DIRNAME) . '/' : '';
                    $newUrlBase =  $newUrlDirectory . pathinfo($custom_blog_url, PATHINFO_FILENAME);

                    //check if new blog url has appended duplicate number
                    if (preg_match('/^(\S+)_([0-9]+)$/', $newUrlBase, $newUrlMatches)) {
                        $newUrlBase = $newUrlMatches[1];
                        $newUrlHasDuplicateNumber = true;
                    }

                    //If base URLs are the same then get the highest duplicate number
                    if ($existingUrlBase == $newUrlBase) {
                        $urlExist = true;
                        $duplicateNumber = max($duplicateNumber, $existingDuplicateNumber);
                    }
                }

            }

            //Add duplicate number to URLs that already exist
            if ($urlExist) {
                //Remove duplicate number on new URLs
                $fileName = pathinfo($custom_blog_url, PATHINFO_FILENAME);
                if ($newUrlHasDuplicateNumber) {
                    $fileName = preg_replace('/_([0-9]+)$/', '', $fileName, 1);
                }

                $directory = pathinfo($custom_blog_url, PATHINFO_DIRNAME) ? pathinfo($custom_blog_url, PATHINFO_DIRNAME) . '/' : '';
                $custom_blog_url = $directory . $fileName . '_' . ($duplicateNumber + 1) . '.' . pathinfo($custom_blog_url, PATHINFO_EXTENSION);
            }
        }

        return $custom_blog_url;
    }

}

$blog = new Blogs();
