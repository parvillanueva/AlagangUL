<div class="box">
	<?php $data["buttons"] = ["save","close"]; ?>
	<?php $this->load->view("content_management/template/buttons", $data); ?>

	<div class="box-body">
		<div class="form-horizontal">
            <div class="form-group">
              	<label class="col-sm-2 control-label">Title</label>
              	<div class="col-sm-5">
                	<input id="title" class="form-control required" placeholder="Title">
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">URL Alias</label>
              	<div class="col-sm-5">
                	<input id="alias" class="form-control required" placeholder="url" />
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Banner</label>
              	<div class="col-sm-5">
              		<div class="input-group img_banner"> 
	              		<input id="img_banner" class="form-control required" readonly />
	              		<span class="input-group-btn ">
	              			<button type="button" data-id="img_banner" class="btn open_filemanager btn-info btn-flat">Open File Manager</button>
	              		</span>
	              	</div>
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Image Thumbnail</label>
              	<div class="col-sm-5">
              		<div class="input-group img_thumbnail"> 
              			<input id="img_thumbnail" class="form-control required" readonly />
              			<span class="input-group-btn">
	              			<button type="button" data-id="img_thumbnail" class="btn open_filemanager btn-info btn-flat">Open File Manager</button>
	              		</span>
              		</div>
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Status</label>
              	<div class="col-sm-3">
              		<select id="status" class="form-control">
                		<option value=0>Published</option>
                		<option value=1>Unpublished</option>
                	</select>
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Short Description</label>
              	<div class="col-sm-10">
                	<textarea id="short_description" class="form-control required" rows="3"></textarea>
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Body</label>
              	<div class="col-sm-10">
                	<textarea id="body" class="form-control" rows="10"></textarea>
              	</div>
            </div>
        </div>
	</div>
</div>

<script type="text/javascript">
	
    AJAX.config.base_url(base_url);

	CKEDITOR.replace( 'body',{height: '500px'});
	$('.ui-tooltip').attr("stlye","hidden");

	$(document).on("click", ".btn_insert", function(e){
		//get source
		var data_id = $(this).attr("indentifier");
		//path of file
		var path = $('#file_url').val();
		var ext =  path.split('.').pop();
		switch(ext.toLowerCase()) {
            case 'jpg':
            case 'png':
            case 'gif':
               var preview = '<img class="img_banner_preview" src="'+path+'" width="100%" />';
            break;                         // the alert ended with pdf instead of gif.
            case 'mp4':
                var preview = '<video class="img_banner_preview" style="width : 100%" controls>';
                preview += '<source src="'+path+'" type="video/mp4">';
                preview += 'Your browser does not support HTML5 video.';
                preview += '</video>';
            break;
            default:
				var preview = '<span class="img_banner_preview"></span>';

        }

		if(data_id == "img_banner"){
			$('.img_banner').next('.img_banner_preview').remove();
			$('#img_banner').val(path);
			$(preview).insertAfter('.img_banner');
		}

		if(data_id == "img_thumbnail"){
			$('.img_thumbnail').next('.img_banner_preview').remove();
			$('#img_thumbnail').val(path);
			$(preview).insertAfter('.img_thumbnail');
		}

		//close modal
		$("#ckeditor_filemanager_modal").modal("hide");

	});

	$(document).on("click", ".open_filemanager", function(e){
		var data_id = $(this).attr("data-id");
		modal.file_manager(data_id); //open filemanager modal
	});

	$(document).on("click", "#btn_close", function(e){
		location.href = "<?=base_url("content_management/site_{menu}/");?>";
	});

	$(document).on('keypress', '#title', function() {
	  	var uri = $(this).val();
	  	uri = uri.split(' ').join('_');
		var res = encodeURI(uri);
	  	$("#alias").val(res);
	});
	$(document).on('keyup', '#title', function() {
		var uri = $(this).val();
		uri = uri.split(' ').join('_');
		var res = encodeURI(uri);
	  	$("#alias").val(res);
	});

	$(document).on("click", "#btn_save", function(e){
		modal.confirm("Are you sure you want to save this record?",function(result){
			if(result){
			// if(validate.required('.required') == 0){
				var editor = CKEDITOR.instances.body.getData();

			    AJAX.insert.table("{table}");
			    AJAX.insert.params("title", $("#title").val());
			    AJAX.insert.params("alias", $("#alias").val());
			    AJAX.insert.params("short_description", $("#short_description").val());
			    AJAX.insert.params("body", editor);
			    AJAX.insert.params("thumbnail", $("#img_thumbnail").val());
			    AJAX.insert.params("banner_img", $("#img_banner").val());
			    AJAX.insert.params("status", $("#status").val());
			    AJAX.insert.params("create_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
			    AJAX.insert.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
			    AJAX.insert.params("user", "<?= $this->session->userdata('sess_uid');?>");

			    AJAX.insert.exec(function(result){
		    		//success code here
		    		modal.alert("Successfully Saved!",function(){
						location.href = "<?= base_url('content_management/site_{menu}');?>";		
					});
			    });
			// }
			}
		});
	});

</script>