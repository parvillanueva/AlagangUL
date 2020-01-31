<div class="box">
	<?php	
		$data["buttons"] = ["update","close"]; // add, save, update
		$this->load->view("content_management/template/buttons", $data);
	?>
	<div class="box-body">
		<div class="form-horizontal">
			<div class="form-group">
              	<label class="col-sm-2 control-label">Display</label>
              	<div class="col-sm-3">
                	<input id="date_from" class="form-control required" placeholder="From" value="<?= $details[0]->date_from;?>">
              	</div>
              	<div class="col-sm-3">
                	<input id="date_to" class="form-control required" placeholder="To" value="<?= $details[0]->date_to;?>">
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Title</label>
              	<div class="col-sm-5">
                	<input id="title" class="form-control required" placeholder="Title" value="<?= $details[0]->title;?>">
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">URL Alias</label>
              	<div class="col-sm-5">
                	<input id="alias" class="form-control required" placeholder="url"  value="<?= $details[0]->alias;?>"/>
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Banner</label>
              	<div class="col-sm-5">
              		<div class="input-group img_banner"> 
	              		<input id="img_banner" class="form-control required" readonly  value="<?= $details[0]->banner_img;?>"/>
	              		<span class="input-group-btn ">
	              			<button type="button" data-id="img_banner" class="btn open_filemanager btn-info btn-flat">Open File Manager</button>
	              		</span>
	              	</div>
	              	<?php 

	              	$extension = pathinfo($details[0]->banner_img, PATHINFO_EXTENSION);
	              	switch (strtolower($extension)) {
	              		case 'jpg':
	              		case 'gif':
	              		case 'png':
	              			echo '<img class="img_banner_preview" src="'.$details[0]->banner_img.'" width="100%" />';
	              			break;
	              		case 'mp4':
	              			echo '<video class="img_banner_preview" style="width : 100%" controls>';
	              			echo '	<source src="'.$details[0]->banner_img.'" type="video/mp4">';
	              			echo '	Your browser does not support HTML5 video.';
	              			echo '</video>';
	              			break;
	              		default:
	              			# code...
	              			break;
	              	}
	              	?>
	              	
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Image Thumbnail</label>
              	<div class="col-sm-5">
              		<div class="input-group img_thumbnail"> 
              			<input id="img_thumbnail" class="form-control required" readonly  value="<?= $details[0]->thumbnail;?>"/>
              			<span class="input-group-btn">
	              			<button type="button" data-id="img_thumbnail" class="btn open_filemanager btn-info btn-flat">Open File Manager</button>
	              		</span>
              		</div>
              		<?php 

	              	$extension = pathinfo($details[0]->thumbnail, PATHINFO_EXTENSION);
	              	switch (strtolower($extension)) {
	              		case 'jpg':
	              		case 'gif':
	              		case 'png':
	              			echo '<img class="img_banner_preview" src="'.$details[0]->thumbnail.'" width="100%" />';
	              			break;
	              		case 'mp4':
	              			echo '<video class="img_banner_preview" style="width : 100%" controls>';
	              			echo '	<source src="'.$details[0]->thumbnail.'" type="video/mp4">';
	              			echo '	Your browser does not support HTML5 video.';
	              			echo '</video>';
	              			break;
	              		default:
	              			# code...
	              			break;
	              	}
	              	?>
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Short Description</label>
              	<div class="col-sm-10">
                	<textarea id="short_description" class="form-control required" rows="3"><?= $details[0]->short_description;?></textarea>
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
	CKEDITOR.instances.body.setData('<?= $details[0]->body;?>');
	$('.ui-tooltip').attr("stlye","hidden");
	$('#date_from').datepicker({dateFormat: 'yy-mm-dd',});
	$('#date_to').datepicker({dateFormat: 'yy-mm-dd',});

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
				modal.alert("Selected file is not valid.",function(){});
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

	$(document).on("click", "#btn_update", function(e){
		modal.confirm("Are you sure you want to save this record?",function(result){
			if(result){
				// if(validate.required('.required') == 0){
					var editor = CKEDITOR.instances.body.getData();

				    AJAX.update.table("{table}");
				    AJAX.update.where("id", "<?= $this->uri->segment(4);?>");
				    AJAX.update.params("date_from", $("#date_from").val());
				    AJAX.update.params("date_to", $("#date_to").val());
				    AJAX.update.params("title", $("#title").val());
				    AJAX.update.params("alias", $("#alias").val());
				    AJAX.update.params("short_description", $("#short_description").val());
				    AJAX.update.params("body", editor);
				    AJAX.update.params("thumbnail", $("#img_thumbnail").val());
				    AJAX.update.params("banner_img", $("#img_banner").val());
				    AJAX.update.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
				    AJAX.update.params("user", "<?= $this->session->userdata('sess_uid');?>");

				    AJAX.update.exec(function(result){
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