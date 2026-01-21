
<!-- Admin Footer Start -->
<footer class="admin_footer text-white py-3 mt-0 bg-primary">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 text-left">
                Copyright &copy; <?= date('Y'); ?> All rights reserved.
            </div>
            <div class="col-12 col-sm-6 col-md-6 text-right">
                <?php $sociallinks = $settings->get_socallinks(); ?>
                <ul class="footer_social_links">
                    <li><a href="<?php echo $sociallinks['instagram']; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="<?php echo $sociallinks['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="<?php echo $sociallinks['facebook']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Admin Footer End-->

<?php
//Blog Informations
$bloginfo = blog_info();
?>

<!-- Script Files -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript">
var blogAdminUrl = '<?= admin_url(); ?>';
</script>

<?php if(isset($_GET['type']) && ($_GET['type']=='layout')) { ?>

    <script src="js/codemirror.js"></script>
    <!--<script src="js/codemirror/mode/matchbrackets.js"></script>-->
    <!--<script src="js/codemirror/mode/htmlmixed.js"></script>-->
    <script src="js/codemirror/mode/xml.js"></script>
    <script src="js/codemirror/mode/javascript.js"></script>
    <script src="js/codemirror/mode/css.js"></script>
    <script src="js/codemirror/mode/clike.js"></script>
    <script src="js/codemirror/mode/php.js"></script>
    <!--<script src="js/codemirror/mode/active-line.js"></script>-->

    <script>

    //  Editor 1
      var editor = CodeMirror.fromTextArea(document.getElementById("headercode"), {
        lineNumbers: true,
        styleActiveLine: false,
        matchBrackets: false
      });


    //  Editor 2
      var editor2 = CodeMirror.fromTextArea(document.getElementById("footercode"), {
        lineNumbers: true,
        styleActiveLine: false,
        matchBrackets: false
      });


    </script>

<?php } ?>

<?php if(isset($_GET['type']) && ($_GET['type']=='style')) { ?>

    <script src="js/codemirror.js"></script>
    <script src="js/codemirror/mode/css.js"></script>
    <!--<script src="js/codemirror/mode/active-line.js"></script>-->
    <!--<script src="js/codemirror/mode/matchbrackets.js"></script>-->
    <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        styleActiveLine: true,
        matchBrackets: false
      });

    </script>

<?php } ?>

<?php if(isset($_GET['type']) && (($_GET['type']=='editblog') || ($_GET['type']=='addblog'))) { ?>
    <script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
        }
    }
    </script>
    <script type="module" src="js/ckeditor.js"></script>
<?php } ?>

<?php if (isset($_GET['type']) && (($_GET['type'] == 'blog') || ($_GET['type'] == 'authors'))) { ?>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script>

        jQuery('document').ready(function($) {
            var table = jQuery('#blog_list_table').DataTable({
                "paging":   true,
                "ordering": true,
                "info":     false,
                "pageLength": 10,
                "order": [[ 1, "desc" ]],
                "searching": true,
                "stateSave": true,
                'columnDefs': [{
                    'targets': 1,
                    'render': function (data, type, full, meta) {
                        if (type === 'display') {
                            data = strtrunc(data, 550);
                        }
                        return data;
                    }
                }]
            });
        });
		function strtrunc(str, max, add) {
            add = add || '...';
            return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
        }
    </script>
<?php } ?>

<?php if(isset($_GET['type']) && ($_GET['type']=='editblog')) { ?>
    <script src="assets/lightbox/js/lightbox.js"></script>
<?php } ?>

<script type="text/javascript" src="js/script.js"></script>

</body>
<!-- Body End -->

</html>
