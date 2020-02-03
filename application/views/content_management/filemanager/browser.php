<style type="text/css">
    .box {
        margin-top: 7em !important;
    }

    .breadcrumb {
        border: 1px solid #ccc;
        padding: 8px 15px !important;
        margin-bottom: 0px !important;
        background-color: transparent !important;
        border-radius: 0px !important;
    }

    .sfbContent {
        border-bottom: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        height: auto;
    }

    .sfbContent ul {
        padding: 0;
        margin: 0;
    }

    ul {
        list-style: none;
    }

    .sfbContent.icon li {
        width: 80px;
        height: 87px;
        padding: 10px;
    }

    .sfbContent.icon li {
        display: inline-block;
        text-align: center;
    }

    .sfbContent li {
        cursor: pointer;
        margin: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .sfbContent.icon span {
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        word-wrap: break-word;
        line-height: 1.2;
    }

    .sfbContent.icon li.no-content {
        text-align: left;
        width: 100%;
        font-weight: 900;
    }

    .sfbUploader {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
    }

    .sfbUploader #fileuploader {
        width: 100% !important;
    }

    .ajax-upload-dragdrop {
        border: 2px dotted #9E9E9E;
        width: 100%;
        color: #DADCE3;
        text-align: left;
        vertical-align: middle;
        padding: 10px 10px 0px 10px;
    }

    .dropzone .dz-message {
        text-align: center;
        margin: 5em 0;
    }

    .dropzone {
        min-height: 194px;
        max-height: 194px;
        border: 2px dotted rgba(0, 0, 0, 0.3);
        background: white;
        padding: 20px 20px;
    }

    ul#file_actions {
        padding: 0px;
    }

    ul#file_actions li {
        display: inline-block;
    }

    a#select_folder{
        color: #000;
    }
    .breadcrumb-item a {
        color: #fff;
    }

    .breadcrumb-item a {
        color: #fff !important;
    }

    #files {
        display: inline-block;
    }


    .file_rename .edit_icon{
        font-size: 14px;
        color: #468dbc;
        cursor: pointer;
        background-color: #fff;
        border-radius: 2px;
        padding: 1px 4px;
    }

   .file_delete .trash_icon{
        font-size: 16px;
        color: #dd4b39;
        cursor: pointer;
        background-color: #fff;
        border-radius: 2px;
        padding: 2px 5px;
    }
    .file_name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 100px;
        color:#fff;
        position: relative;
    }
    .file_name a {
        color: #fff;
    }
    
    .file_container {
        position: relative;
        width: 100%;
        min-width: 120px;
        max-width: 120px;
        margin: 10px;
        min-height: 120px;
        max-height: 120px;
        display: inline-block;
        overflow: hidden;
    }
    .file_container img{
        overflow: hidden;
        object-fit: cover;
        min-width: 120px;
        max-width: 120px;
        min-height: 120px;
        max-height: 120px;
        width: 120px;
        height: 120px;

    }
    .file_content {
      opacity: 1;
      display: block;
      width: 100%;
      height: auto;
      transition: .5s ease;
      backface-visibility: hidden;
    }

    .middle {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      text-align: center;
      cursor: pointer;
    }

    .middle_container #select_folder {
        color: #fff;
    }

    .file_container:hover {
      background: rgba(0, 0, 0, 0.71);
    }

    .file_container:hover .file_content {
      opacity: 0.3;
    }

    .file_container:hover  .middle {
      opacity: 1;

    }
    .file_container:hover  .file_rename {
      opacity: 1;

    }

    .file_container:hover  .file_delete {
      opacity: 1;

    }



    .file_rename {
        display: inline-block;
        position: absolute;
        top: 4px;
        right: 55px;
        z-index: 2;
        width: 20px;
        opacity: 0;
    }

    .file_delete {
        display: inline-block;
        position: absolute;
        top: 4px;
        right: 30px;
        z-index: 2;
        width: 20px;
        opacity: 0;
    }
       
    .file_chckbx {
        position: absolute;
        top: 4px;
        right: 4px;
        z-index: 2;
        width: 20px;
        text-align: center;
    }

    .file_folder_delete {
        cursor: pointer;
    } 

    /**Custom Checkbox **/

    .file_chckbx_container {
      display: block;
      position: relative;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }


    .file_chckbx_container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }


    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #fff;
      border: 2px solid #468dbc;
    }


    .file_chckbx_container:hover input ~ .checkmark {
      background-color: #fff;
    }


    .file_chckbx_container input:checked ~ .checkmark {
      background-color: #468dbc;
    }


    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }


    .file_chckbx_container input:checked ~ .checkmark:after {
      display: block;
    }


    .file_chckbx_container .checkmark:after {
        left: 5px;
        top: 1px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }  

    /**Custom Checkbox All **/

    .file_chckbx_all_container {
      display: block;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .file_chckbx_all {
        float: right;
    }

    .file_chckbx_all_container input {
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    .checkmark_all {
      position: absolute;
      margin-top: -22px;
      margin-left: -30px;
      height: 20px;
      width: 20px;
      background-color: #fff;
      border: 2px solid #468dbc;
    }

    .file_chckbx_all_container:hover input ~ .checkmark_all {
      background-color: #fff;
    }


    .file_chckbx_all_container input:checked ~ .checkmark_all {
      background-color: #468dbc;
    }

    .checkmark_all:after {
      content: "";
      position: absolute;
      display: none;
    }

    .file_chckbx_all_container input:checked ~ .checkmark_all:after {
      display: block;
    }

    .file_chckbx_all_container .checkmark_all:after {
        left: 5px;
        top: 1px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    
    .file_container_back {
        position: relative;
        width: 40px;
        margin: 10px;
        min-height: 120px;
        max-height: 120px;
        display: inline-block;
        vertical-align: top;
    }
    .file_arrow_back i {
        font-size: 25px;
    }

    .file_container_back span {
        font-size: 14px;
    }

    .show_image_container{
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .file_modal_body{
        max-height: 500px;
        overflow-x: auto;
    }


</style>

    <div class="content">
        <input class="hidden" id="filemanager_identifier">
        <ul id="file_actions">
            <li>
                <span  class="btn btn-primary" id="create_folder" data-toggle="tooltip" title="Create Folder">
                    <i class="fas fa-folder-plus"></i>
                </span>
            </li>
            <li>
                <span  id="upload_files" class="btn btn-primary" data-toggle="tooltip" title="Upload Files">
                    <i class="fa fa-upload"></i>
                </span>
                <span  id="close_upload_files" class="btn btn-default" data-toggle="tooltip" title="Close">
                    <i class="fa fa-times"></i>
                </span>
            </li>

            <li class="pull-right" style="margin-right: 3px;">
                <span  id="delete_selected" class="btn btn-danger" data-toggle="tooltip" title="Delete">
                    <i class="fa fa-trash"></i>
                </span>
            </li>
        </ul>
        <nav aria-label="breadcrumb" style="background-color: #468dbc;">
            <div class="file_chckbx_all">
                <label class="file_chckbx_all_container">
                    <input type="checkbox" class="check-all">
                    <span class="checkmark_all"></span>
                </label>
            </div>
            <ol class="breadcrumb">     
            </ol>
        </nav>
        <div class="sfbUploader">
            <form class="dropzone" id="FileManagerDropZone">
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
            </form>
            <select id="quality" data-toggle="tooltip" title="Compress Image">
                <option value="0" selected>Original</option>
                <option value="90">90%</option>
                <option value="80">80%</option>
                <option value="70">70%</option>
                <option value="60">60%</option>
                <option value="50">50%</option>
                <option value="40">40%</option>
                <option value="30">30%</option>
                <option value="20">20%</option>
                <option value="10">10%</option>
            </select>
        </div>
        <div class="sfbContent">
            <div id="files" >
            </div>  
        </div> 

    </div>

<script type="text/javascript">

    $('.sfbUploader').hide();

    var current_path = "./uploads";

    var allowed_mimes = "image/*, video/mp4, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, text/plain, application/vnd.ms-excel, application/msexcel, application/x-msexcel, application/x-ms-excel, application/x-excel, application/x-dos_ms_excel, application/xls, application/x-xls, application/excel, application/vnd.ms-office, text/x-comma-separated-values, text/comma-separated-values, application/x-csv, text/x-csv, text/csv, application/csv, application/vnd.msexcel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .txt";

    Dropzone.options.FileManagerDropZone = {
        paramName: "file", 
        url: "<?= base_url("content_management/file_manager_2/upload_compress");?>",
        acceptedFiles: allowed_mimes,
        maxFilesize: 50,
        init: function () {
            var _this = this;
            this.on("sending", function(file, xhr, data) {
                /*data.append("path", current_path);
                data.append("quality", $('#quality').val());*/
                var filename = file.name;
                var filesize = file.size;
                console.log(filename);
                if(filename.match(/(\.png)|(\.jpg)|(\.jpeg)|(\.gif)|(\.ico)/gi)){ //Images
                    if(filesize < 5242880){ //5MB
                        data.append("path", current_path);
                        data.append("quality", $('#quality').val());
                    }else{
                        modal.alert('File size for images is limited to 5MB only.');
                    }
                }else if(filename.match(/(\.mp4)/gi)){ //Videos
                    if(filesize < 52428800){ //50MB
                        data.append("path", current_path);
                        data.append("quality", $('#quality').val());
                    }else{
                        modal.alert('File size for Videos is limited to 50MB only.');
                    }
                }else if(filename.match(/(\.pdf)|(\.docx)|(\.doc)|(\.txt)|(\.xls)|(\.csv)|(\.xlsx)/gi)){
                    data.append("path", current_path);
                    data.append("quality", $('#quality').val());
                }else{
                    modal.alert('File type is not allowed.');
                }
            });
        },
        success: function(file, response){
            this.removeFile(file);
            get_path_files(current_path);
            $(".sfbUploader").show();
            $("#close_upload_files").show();
            $("#uncheck_files").hide();
            $("#check_files").removeAttr("disabled");
            $(".file_folder_delete").hide();
        }
    }

    $(document).ready(function(){
        get_path_files();
        $("#close_upload_files").hide();
        $('[data-toggle="tooltip"]').tooltip(); 
    });

    $(document).on('click', '#delete_selected', function(e){
         var checked_chckbx = $( ".file_folder_delete:checked" ).length;
         if(checked_chckbx > 0){
            var modal_obj = '<?= $this->standard->confirm("confirm_delete"); ?>'; 
            modal.standard(modal_obj, function(result){
                if(result){
                    modal.loading(true);
                    $('.file_folder_delete').each(function() {
                        if(this.checked==true){
                            var path = $(this).attr("path");
                            var extension = path.substr( (path.lastIndexOf('.') +1) );
                            if(extension.length > 4){
                                //folder
                                delete_folder(path);
                            } else {
                                //file
                                delete_file(path);
                            }
                        }  
                    });
                    $("#close_upload_files").hide();
                    $("#upload_files").show();
                    modal.loading(false);
                }
            });
         }else{
            modal.alert("No file Selected", function(result){
            });
         }


    });

    $(document).on('click', '#download_file', function(e){
        var path = $(this).attr("path");
        download_uri(path);
    });

    function download_uri(uri) 
    {
        var link = document.createElement("a");
        link.href = uri;
        link.click();
    }

    $(document).on('click', '#upload_files', function(e){
        $(".sfbUploader").show();
        $("#close_upload_files").show();
        $("#upload_files").hide();
        $("input:checkbox").prop('checked', false);
    });

    $(document).on('click', '#close_upload_files', function(e){
        $(".sfbUploader").hide();
        $("#upload_files").show();
        $("#close_upload_files").hide();
        $("input:checkbox").prop('checked', false);
        $("#quality").val(0);
    });


/*
    $(document).on('change', '.file_folder_delete', function(){
        var x = 0;
        $('.file_folder_delete').each(function() {  
            var ischecked =  $(this).is(":checked");
            if (this.checked==true) { x++; } 
            if (x > 0 ) {
                $("#delete_selected").show();
            } else {
                $("#delete_selected").hide();
            }
        });
    });
*/
    $(document).on('click', '#select_file', function(e){
        e.preventDefault();
        var path = $(this).attr("path");
        var identifier = $('#filemanager_identifier').val();
        var ext = path.substr(path.lastIndexOf('.') + 1);

        switch(ext) {
            case "jpg":
            case "png":
            case "gif":
            case "jpeg":
                modal.image_view("<?= base_url();?>" + path.substr(2, path.length),identifier);
                break;
            case "mp4":
                modal.video_view("<?= base_url();?>" + path.substr(2, path.length),identifier);
                break;
            case "pdf":
                modal.iframe("<?= base_url();?>" + path.substr(2, path.length),identifier);
                break;
            default:
                modal.view_file("<?= base_url();?>" + path.substr(2, path.length),identifier);

        }
    });

    $(document).on('mouseenter', '#files > li[data-type="folder"]', function(e){
        $(this).children('.edit_icon').show();
    }).on('mouseleave', '#files > li[data-type="folder"]', function(e) {
        $(this).children('.edit_icon').hide();
    });

    $(document).on('click', '.edit_icon', function(e) {
        var file_name = $(this).attr('path').replace(current_path+'/', '');
        var filename = $(this).attr('data-filename');
        $(window).on('shown.bs.modal', function() { 
            $('.bootbox-prompt').modal('show');
            if (file_name.includes('.')) {
                $('.bootbox-input').val(filename.substr(0, file_name.lastIndexOf('.'))); 
            } else {
                $('.bootbox-input').val(filename);
            }
        });
        rename_file(current_path, file_name);
        $('.bootbox-input').val(filename);
    });

    $(document).on('click', '.delete_icon', function(e) {
        var path = $(this).attr("path");
        var modal_obj = '<?= $this->standard->confirm("confirm_delete"); ?>'; 
        modal.standard(modal_obj, function(result){
            if(result){
                //modal.loading(true);
                    var extension = path.substr( (path.lastIndexOf('.') +1) );
                    if(extension.length > 4){
                        //folder
                        delete_folder(path);
                    } else {
                        //file
                        delete_file(path);
                    }
                //modal.loading(false);
            }
        });
        
    });

    function delete_filename(path){
        var modal_obj = '<?= $this->standard->confirm("confirm_delete"); ?>'; 
        modal.standard(modal_obj, function(result){
            if(result){
                //modal.loading(true);
                    var extension = path.substr( (path.lastIndexOf('.') +1) );
                    if(extension.length > 4){
                        //folder
                        delete_folder(path);
                    } else {
                        //file
                        delete_file(path);
                    }
                //modal.loading(false);
            }
        });
        
    }

    $(document).on('click', '#delete_file_manager_file', function(e){
        e.preventDefault();
        var path = $(this).attr("path");
        modal.confirm("Are you sure you want to delete this file?",function(result){
            if(result){
                delete_filename(path.replace("<?= base_url();?>", "./"));
            }
        });  
    });

    $(document).on('click', '#select_folder', function(e){
        e.preventDefault();
        var path = $(this).attr("path");
        get_path_files(path);
    });

    $(document).on('click', '#create_folder', function(e){
        e.preventDefault();
        create_folder(current_path);

        $(window).on('shown.bs.modal', function() { 
            $('.bootbox-prompt').modal('show');
            $('.bootbox-input').val("");
        });
    });

    function delete_file(path){
        var url = "<?= base_url("content_management/file_manager_2/remove_file");?>";
        var data = {
            path : path,
            data: {
                path : path
            }
        }
        aJax.post(url, data, function(obj){ 
            var obj = JSON.parse(obj);
            if (obj.success) {
                $('.modal').modal('hide');
                get_path_files(obj.path);
                //$(".sfbUploader").hide();
                $("input:checkbox").prop('checked', false);
            } else {
                modal.alert(obj.message);
            }
        });
    }

    function delete_folder(path){
        var url = "<?= base_url("content_management/file_manager_2/remove_dir");?>";
        var data = {
            path : path,
            data: {
                path : path
            }
        }
        aJax.post(url, data, function(obj){
            var obj = JSON.parse(obj);
            if (obj.success) {
                $('.modal').modal('hide');
                get_path_files(obj.path);
               // $(".sfbUploader").hide();
                $("input:checkbox").prop('checked', false);
            } else {
                modal.alert(obj.message);
            }
        });
    }

    function get_path_files(path){

        if(path == null){
            path = "./uploads";
        }

        var url = "<?= base_url("content_management/file_manager_2/get");?>";
        var data = {
            path : path
        }
        aJax.post(url, data, function(obj){
            current_path = obj.current_path;
            $(".upload_path").val(current_path);
            $("#current_path").val(current_path);

            var html_path = "";
            html_path += '<i style="color:#fff;font-size: 13px;" class="fa fa-folder"></i> ';
            $.each(obj.path, function(x,y){
                html_path += '<li class="breadcrumb-item" aria-current="page"><a href="#" id="select_folder" path="'+y.path+'">'+y.value+'</a></li>';
            });
            $(".breadcrumb").html(html_path);


            var html_dir = "";
            if(path != "./uploads"){
                var to = current_path.lastIndexOf('/');
                to = to == -1 ? current_path.length : to + 1;
                var str = current_path.substring(0, to);
                str = str.replace(/\/$/, "");

               html_dir += '<div class="file_container_back">';
               html_dir += '   <a href="" id="select_folder" path="'+str+'">';
               html_dir += '      <div class="file_arrow_back">';
               html_dir += '           <i class="fa fa-arrow-left" style="color: #ccc;"></i>';
               html_dir += '       </div>';
               html_dir += '       <span>Back</span>';
               html_dir += '   </a>';
               html_dir += '</div>';
            }

            $.each(obj.directories, function(x,y){
                var folder_icon = "<?= base_url();?>cms/extensions/folder.png";

                html_dir += '<div class="file_container">';
                html_dir += '<div class="file_chckbx">';
                html_dir += '   <label class="file_chckbx_container">';
                html_dir += '       <input type="checkbox" class="file_folder_delete" path="'+current_path+'/'+y.value+'">';
                html_dir += '       <span class="checkmark"></span>';
                html_dir += '   </label>';
                html_dir += '</div>';
                html_dir += '          <div class="file_rename folder_file_rename"><span class="edit_icon" path="'+current_path+'/'+y.value+'" data-filename="'+y.value+'"><i class="fa fa-pencil-square-o"  title="Rename" ></i></span></div>';
                html_dir += '            <div class="file_delete"><span class="delete_icon folde_file_delete" path="'+current_path+'/'+y.value+'"><i class="fa fa-trash trash_icon "  title="Delete" ></i></div>';

                html_dir += '<a href="" id="select_folder" path="'+current_path+'/'+y.value+'"><img src="'+folder_icon+'"" class="file_content">';
                html_dir += '   <div class="middle">';
                html_dir += '   <div class="middle_container">';
                html_dir += '       <div class="file_name"><span>'+y.value+'</span></div>';

                html_dir += '     </div>';
                html_dir += '    </div></a>';
                html_dir += '</div>';

            });

            var counter = 1;
            var current_url = window.location.href;
            var filemanager_url = "<?= base_url('content_management/file_manager');?>";

            $.each(obj.files, function(x,y){

                var ext = y.value.substr(y.value.lastIndexOf('.') + 1);
                switch(ext) {
                    case "jpg":
                    case "png":
                    case "gif":
                    case "jpeg":
                        var icon = "<?= base_url();?>"+current_path+'/'+y.value;
                        break;
                    case "mp4":
                        var icon = "<?= base_url();?>cms/extensions/" + ext + ".png";
                        break;
                    case "pdf":
                        var icon = "<?= base_url();?>cms/extensions/" + ext + ".png";
                        break;
                    default:
                        var icon = "<?= base_url();?>cms/extensions/" + ext + ".png";

                }
    


                var error_icon = "<?= base_url();?>cms/extensions/file.png";

                html_dir += '<div class="file_container">';
                html_dir += '   <div class="file_chckbx">';
                html_dir += '       <label class="file_chckbx_container">';
                html_dir += '           <input type="checkbox" class="file_folder_delete" path="'+current_path+'/'+y.value+'">';
                html_dir += '           <span class="checkmark"></span>';
                html_dir += '       </label>';
                html_dir += '   </div>';
                html_dir += '          <div class="file_rename"><span class="edit_icon" path="'+current_path+'/'+y.value+'" data-filename="'+y.value+'"><i class="fa fa-pencil-square-o"  title="Rename" ></i></span></div>';

                html_dir += '              <div class="file_delete"><span class="delete_icon"  path="'+current_path+'/'+y.value+'"><i class="fa fa-trash trash_icon "  title="Delete"></i></span></div>';
                if(current_url == filemanager_url ){
                    html_dir += '   <div class="show_image_container" data-toggle="modal" data-target="#modal_image_'+counter+'">';
                    html_dir += '       <img  onerror="icon_error(this)" src="'+icon+'" class="file_content" >';
                    html_dir += '   </div>';
                    html_dir += '       <div class="middle">';
                    html_dir += '           <div class="middle_container">';
                    html_dir += '             <div class="file_name"><span data-toggle="modal" data-target="#modal_image_'+counter+'">'+y.value+'</span></div>';

                    html_dir += '     </div>';
                    html_dir += '   </div>';
                }else{
                    html_dir += '   <div class="show_image_container">';
                    html_dir += '       <a href="" id="select_file" path="'+current_path+'/'+y.value+'"> ';
                    html_dir += '           <img  onerror="icon_error(this)" src="'+icon+'" class="file_content">';
                    html_dir += '       </a>';
                    html_dir += '   </div>';
                    html_dir += '       <div class="middle">';
                    html_dir += '           <div class="middle_container">';
                    html_dir += '             <div class="file_name"><a href="" id="select_file" path="'+current_path+'/'+y.value+'"><span>'+y.value+'</span></a></div>';
                    html_dir += '      </div> ';
                    html_dir += '   </div>';
                }
                html_dir += '</div>';

                //Show image or Video
                html_dir += '<div class="modal fade" role="dialog" id="modal_image_'+counter+'" aria-hidden="true">';
                html_dir += '    <div class="modal-dialog">';
                html_dir += '      <div class="modal-content">';
                html_dir += '        <div class="modal-header">';
                html_dir += '          <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                html_dir += '           <span aria-hidden="true">&times;</span></button>';
                html_dir += '         <h4 class="modal-title" id="gridSystemModalLabel">'+y.value+'</h4>';
                html_dir += '        </div>';
                html_dir += '        <div class="modal-body file_modal_body">';
                html_dir += '          <div class="container-fluid text-center">';
                                        if(ext == 'mp4'){
                html_dir += '               <video width="500" controls>';
                html_dir += '                   <source src="<?= base_url();?>'+current_path+'/'+y.value+'" type="video/mp4">';
                html_dir += '                </video>';

                                        }else{
                html_dir += '               <img src="'+icon+'" style="width:100%">';                                   
                                        }
                html_dir += '          </div>';
                html_dir += '        </div>';
                html_dir += '        <div class="modal-footer">';
                html_dir += '           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                html_dir += '       </div>';
                html_dir += '     </div>';
                html_dir += '   </div>';
                html_dir += '</div>';


                counter++;

            });

            $("#files").html(html_dir);
            //$(".sfbUploader").hide();
            $("input:checkbox").prop('checked', false);
        }); 
    }

    function icon_error(image)
    {
        var error_icon = "<?= base_url();?>cms/extensions/file.png";
        image.onerror = "";
        image.src = error_icon;
        return true;
    }

    function create_folder(path) {
        if(path == null){
            path  = "./uploads";
        }
        modal.input("Enter Folder Name","text",function(folder_name){
            if(folder_name){
                if(folder_name != "" || folder_name != null){
                    var url = "<?= base_url("content_management/file_manager_2/create_folder");?>";
                    var data = {
                        folder : folder_name,
                        path : path,
                        data: {
                            folder : folder_name,
                            path : path
                        }
                    }
                    aJax.post(url, data, function(obj){
                        if(obj.success){
                            get_path_files(obj.path);
                        } else {
                            modal.alert(obj.message);
                        }
                    });
                }
            }
        })
    }

    $(document).on('keypress', '.bootbox-input', function() {
        var bootbox_input =  $(this).val();
        bootbox_input = bootbox_input.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, "");
    });

    function rename_file(path, file_name) {
        if(path == null){
            path = "./uploads";
        }

        var modal_label = "";
        if (file_name.match(/[^/]+(jpeg|jpg|png|gif)$/g)) {
            modal_label = "image";
        } else if (file_name.match(/[^/]+(pdf)$/g)) {
            modal_label = "pdf file";
        } else if (file_name.match(/[^/]+(mp4)$/g)) {
            modal_label = "video";
        } else if (file_name.match(/[^/]+(audio)$/g)) {
            modal_label = "audio file";
        } else if (file_name.match(/[^/]+(xls|xlsx)$/g)) {
            modal_label = "excel file";
        } else if (file_name.match(/[^/]+(docx)$/g)) {
            modal_label = "word file";
        } else if (file_name.match(/[^/]+(txt)$/g)) {
            modal_label = "text file";
        } else {
            // modal_label = "folder -" + file_name;
            modal_label = "folder";
        }
        modal.input("Rename "+modal_label,"text",function(new_file_name){
            if (new_file_name == null) {
                new_file_name = file_name.replace(/\.[^/.]+$/, "");
                $('.bootbox-input').val("");
            }

            if ($('.bootbox-input').val() !== "") { 
                if (new_file_name !== "" || new_file_name !== null) {
                    if (file_name.indexOf('.') !== -1) {
                        var ext = file_name.split('.').pop();
                        ext = '.'+ ext;
                    } else {
                        var ext = "";
                    }

                    new_file_name.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, "");
                    var url = "<?= base_url("content_management/file_manager_2/rename_file");?>";
                    var data = {
                        file_name : file_name,
                        new_file_name : new_file_name+ext,
                        path : path
                    }

                    aJax.post(url, data, function(obj){
                        if(obj.success){
                            get_path_files(obj.path);
                        } else {
                            modal.alert(obj.message);
                        }
                    });
                }
            }
        })
    } 

    $(document).on('click','.check-all',function () {
        $('.file_folder_delete').not(this).prop('checked', this.checked);
    });

    $(document).on('click','.file_folder_delete',function () {
        if (!$(this).is(":checked")) {
            $('.check-all').prop('checked', false);
        }

        if ($('.file_folder_delete:checked').length == $('.file_folder_delete').length) {
            $('.check-all').prop('checked', true);   
        }
    });

    $(document).on('click', '.dz-error', function(){
        $(this).remove();
    });

</script>
