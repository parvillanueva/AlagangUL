<!-- <link rel=stylesheet href="<?= base_url();?>vendor/codemirror/doc/docs.css"> -->
<link rel="stylesheet" href="<?= base_url();?>vendor/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="<?= base_url();?>vendor/codemirror/addon/fold/foldgutter.css">
<link rel="stylesheet" href="<?= base_url();?>vendor/codemirror/addon/dialog/dialog.css">
<link rel="stylesheet" href="<?= base_url();?>vendor/codemirror/theme/monokai.css">
<script src="<?= base_url();?>vendor/codemirror/lib/codemirror.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/search/searchcursor.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/search/search.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/dialog/dialog.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/edit/matchbrackets.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/edit/closebrackets.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/comment/comment.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/wrap/hardwrap.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/fold/foldcode.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/fold/brace-fold.js"></script>
<script src="<?= base_url();?>vendor/codemirror/mode/javascript/javascript.js"></script>
<script src="<?= base_url();?>vendor/codemirror/mode/css/css.js"></script>
<script src="<?= base_url();?>vendor/codemirror/keymap/sublime.js"></script>
<style>
    .php-file-tree {
        font-family: Georgia;
        font-size: 12px;
        letter-spacing: 1px;    line-height: 1.5;
    }

    .php-file-tree A {
        color: #000000;
        text-decoration: none;
    }
    
    .php-file-tree A:hover {
        color: #666666;
    }

    .php-file-tree .open {
        font-style: italic;
    }
    
    .php-file-tree .closed {
        font-style: normal;
    }
    
    .php-file-tree .pft-directory {
        list-style-image: url("<?= base_url() ?>assets/img/tree/directory.png");
    }
    
    /* Default file */
    .php-file-tree LI.pft-file { list-style-image: url("<?= base_url() ?>assets/img/tree/file.png"); }
    /* Additional file types */
    .php-file-tree LI.ext-3gp { list-style-image: url("<?= base_url() ?>assets/img/tree/film.png"); }
    .php-file-tree LI.ext-afp { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-afpa { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-asp { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-aspx { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-avi { list-style-image: url("<?= base_url() ?>assets/img/tree/film.png"); }
    .php-file-tree LI.ext-bat { list-style-image: url("<?= base_url() ?>assets/img/tree/application.png"); }
    .php-file-tree LI.ext-bmp { list-style-image: url("<?= base_url() ?>assets/img/tree/picture.png"); }
    .php-file-tree LI.ext-c { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-cfm { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-cgi { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-com { list-style-image: url("<?= base_url() ?>assets/img/tree/application.png"); }
    .php-file-tree LI.ext-cpp { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-css { list-style-image: url("<?= base_url() ?>assets/img/tree/css.png"); }
    .php-file-tree LI.ext-doc { list-style-image: url("<?= base_url() ?>assets/img/tree/doc.png"); }
    .php-file-tree LI.ext-exe { list-style-image: url("<?= base_url() ?>assets/img/tree/application.png"); }
    .php-file-tree LI.ext-gif { list-style-image: url("<?= base_url() ?>assets/img/tree/picture.png"); }
    .php-file-tree LI.ext-fla { list-style-image: url("<?= base_url() ?>assets/img/tree/flash.png"); }
    .php-file-tree LI.ext-h { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-htm { list-style-image: url("<?= base_url() ?>assets/img/tree/html.png"); }
    .php-file-tree LI.ext-html { list-style-image: url("<?= base_url() ?>assets/img/tree/html.png"); }
    .php-file-tree LI.ext-jar { list-style-image: url("<?= base_url() ?>assets/img/tree/java.png"); }
    .php-file-tree LI.ext-jpg { list-style-image: url("<?= base_url() ?>assets/img/tree/picture.png"); }
    .php-file-tree LI.ext-jpeg { list-style-image: url("<?= base_url() ?>assets/img/tree/picture.png"); }
    .php-file-tree LI.ext-js { list-style-image: url("<?= base_url() ?>assets/img/tree/script.png"); }
    .php-file-tree LI.ext-lasso { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-log { list-style-image: url("<?= base_url() ?>assets/img/tree/txt.png"); }
    .php-file-tree LI.ext-m4p { list-style-image: url("<?= base_url() ?>assets/img/tree/music.png"); }
    .php-file-tree LI.ext-mov { list-style-image: url("<?= base_url() ?>assets/img/tree/film.png"); }
    .php-file-tree LI.ext-mp3 { list-style-image: url("<?= base_url() ?>assets/img/tree/music.png"); }
    .php-file-tree LI.ext-mp4 { list-style-image: url("<?= base_url() ?>assets/img/tree/film.png"); }
    .php-file-tree LI.ext-mpg { list-style-image: url("<?= base_url() ?>assets/img/tree/film.png"); }
    .php-file-tree LI.ext-mpeg { list-style-image: url("<?= base_url() ?>assets/img/tree/film.png"); }
    .php-file-tree LI.ext-ogg { list-style-image: url("<?= base_url() ?>assets/img/tree/music.png"); }
    .php-file-tree LI.ext-pcx { list-style-image: url("<?= base_url() ?>assets/img/tree/picture.png"); }
    .php-file-tree LI.ext-pdf { list-style-image: url("<?= base_url() ?>assets/img/tree/pdf.png"); }
    .php-file-tree LI.ext-php { list-style-image: url("<?= base_url() ?>assets/img/tree/php.png"); }
    .php-file-tree LI.ext-png { list-style-image: url("<?= base_url() ?>assets/img/tree/picture.png"); }
    .php-file-tree LI.ext-ppt { list-style-image: url("<?= base_url() ?>assets/img/tree/ppt.png"); }
    .php-file-tree LI.ext-psd { list-style-image: url("<?= base_url() ?>assets/img/tree/psd.png"); }
    .php-file-tree LI.ext-pl { list-style-image: url("<?= base_url() ?>assets/img/tree/script.png"); }
    .php-file-tree LI.ext-py { list-style-image: url("<?= base_url() ?>assets/img/tree/script.png"); }
    .php-file-tree LI.ext-rb { list-style-image: url("<?= base_url() ?>assets/img/tree/ruby.png"); }
    .php-file-tree LI.ext-rbx { list-style-image: url("<?= base_url() ?>assets/img/tree/ruby.png"); }
    .php-file-tree LI.ext-rhtml { list-style-image: url("<?= base_url() ?>assets/img/tree/ruby.png"); }
    .php-file-tree LI.ext-rpm { list-style-image: url("<?= base_url() ?>assets/img/tree/linux.png"); }
    .php-file-tree LI.ext-ruby { list-style-image: url("<?= base_url() ?>assets/img/tree/ruby.png"); }
    .php-file-tree LI.ext-sql { list-style-image: url("<?= base_url() ?>assets/img/tree/db.png"); }
    .php-file-tree LI.ext-swf { list-style-image: url("<?= base_url() ?>assets/img/tree/flash.png"); }
    .php-file-tree LI.ext-tif { list-style-image: url("<?= base_url() ?>assets/img/tree/picture.png"); }
    .php-file-tree LI.ext-tiff { list-style-image: url("<?= base_url() ?>assets/img/tree/picture.png"); }
    .php-file-tree LI.ext-txt { list-style-image: url("<?= base_url() ?>assets/img/tree/txt.png"); }
    .php-file-tree LI.ext-vb { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-wav { list-style-image: url("<?= base_url() ?>assets/img/tree/music.png"); }
    .php-file-tree LI.ext-wmv { list-style-image: url("<?= base_url() ?>assets/img/tree/film.png"); }
    .php-file-tree LI.ext-xls { list-style-image: url("<?= base_url() ?>assets/img/tree/xls.png"); }
    .php-file-tree LI.ext-xml { list-style-image: url("<?= base_url() ?>assets/img/tree/code.png"); }
    .php-file-tree LI.ext-zip { list-style-image: url("<?= base_url() ?>assets/img/tree/zip.png"); }

    .CodeMirror {border-top: 1px solid #eee; border-bottom: 1px solid #eee; line-height: 1.3; height: auto;}
    .CodeMirror-linenumbers { padding: 0 8px; }
    strong { font-size: 14px;  }
    .title { font-size: 18px;  margin-top: 15px; }
    #txtcon { margin-top: 5px; }
    #fname { margin: 0px; }

    .CodeMirror {
      border: 1px solid #eee;
      height: 400px;
    }

</style>
<?php
include("php_file_tree.php");
?>
<div class="box"> 
    <?php
        $data['buttons'] = ['update', 'close']; // add, save, update
        $this->load->view("content_management/template/buttons", $data);
    ?> 
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?php
                echo php_file_tree("assets/dist", "javascript:read_file('[link]');");
                ?>
            </div>
            <div class="col-md-9">
                <h4 id="fname"></h4>
                <small id="fpath"></small>
                <div id="imgcon" style="display: none;"></div>
                <div id="txtcon">
                    <textarea id="code"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var g_link;
    var content;
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        mode: "css",
        keyMap: "sublime",
        autoCloseBrackets: true,
        matchBrackets: true,
        showCursorWhenSelecting: true,
        theme: "monokai",
        tabSize: 2
    });

    function read_file(link){
        
        var file = '<?= base_url() ?>'+link;
        g_link = link;
        var url = file;
        var last_segment = url.split('/').slice(-1).join(); 
        $("#fname").html(last_segment);
        $("#fpath").html(file);
        if (file.match(/\.(jpg|jpeg|png|gif)$/)) {
            $(".btn_update").hide();
            $("#txtcon").hide();
            $("#imgcon").show();
            $("#imgcon").html("<img src='"+file+"' class='img-responsive'>");
        } else {
            if (file.match(/\.(js)$/)) {
                editor.setOption("mode", "javascript");
            } else {
                editor.setOption("mode", "css");
            }
            $(".btn_update").show();
            $("#txtcon").show();
            $.post(file, function(data) {
                $("#imgcon").hide();
                $("#code").html("");
                editor.getDoc().setValue(data);
                content = data;
            });
        }
    }

    $(document).on('click', '#btn_update', function(){   
        if(validate.standard()){

            var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
            modal.standard(modal_obj, function(result){
                if(result){
                    var url = "<?= base_url('content_management/write_data');?>"; 
                    var data = {
                        link : g_link,
                        content : editor.getDoc().getValue()
                    }

                    aJax.post(url,data,function(result){
                        modal.alert("<?= $this->standard->dialog("save_success"); ?>", function(){
                            // location.reload();
                        });
                    })
                }
            });
        }
    });

    $(document).on('click', '#btn_close', function(){  
        window.location.replace("<?= base_url() ?>content_management");
    });

</script>