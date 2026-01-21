<div>
    <div class="main-container">
        <div class="editor-container editor-container_classic-editor editor-container_include-style" id="editor-container">
            <div class="editor-container__editor">
                <div id="editor"><?=isset($_GET['type']) && $_GET['type']=='editblog' ? $blogdata->blog_content: ''?></div>
            </div>
        </div>
    </div>
</div>