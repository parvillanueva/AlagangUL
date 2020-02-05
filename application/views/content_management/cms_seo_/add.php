<div class="box">
	<?php
			$data['buttons'] = ['save','close'];
			$this->load->view("content_management/template/buttons",$data);
		?>
	<div class="box-body">
		
		<div class="form-horizontal col-md-12">
			<div class="form-group">
				<label class="control-label col-sm-2">URL<span style="color: red;">*</span>:</label>
				<div class="col-sm-5">
		     		<input type="text" class="form-control url req required_input">
		   		</div>
		   		<span class = "invalid"></span>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Meta Title<span style="color: red;">*</span>:</label>
				<div class="col-sm-5">
			     	<input type="text" class="form-control meta-title req required_input" maxlength="70">
			     	<small><i>Maximum character count is 70.</i></small>
			   	</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Meta Description<span style="color: red;">*</span>:</label>
				<div class="col-sm-5">
			     	<textarea class="form-control meta-description req required_input" rows="5" maxlength="160"></textarea>
			     	<small><i>Maximum character count is 160.</i></small>
			   	</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Meta Keyword<span style="color: red;">*</span>:</label>
				<div class="col-sm-5">
			     	<textarea class="form-control meta-keywords req required_input" rows="5"></textarea>
			   	</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="control-label col-sm-2">OG Title<span style="color: red;">*</span>:</label>
				<div class="col-sm-5">
			     	<input type="text" class="form-control og-title req required_input" rows="5" maxlength="95">
			     	<small><i>Maximum character count is 95.</i></small>
			   	</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">OG Description<span style="color: red;">*</span>:</label>
				<div class="col-sm-5">
			     	<input type="text" class="form-control og-description req required_input" maxlength="200">
			     	<small><i>Maximum character count is 200.</i></small>
			   	</div>
			</div>
			<div class="form-group">
					<label class="control-label col-sm-2">OG Image<span style="color: red;">*</span>:</label>
					<div class="col-sm-5">
						<div class="input-group">
							<input class="og-img form-control required_input ext_filter size_filter" readonly value="" id="og_image_img" required>
							<input type="hidden" id="og_image_alt">
							<span class="input-group-btn ">
								<button type="button" class="btn btn-primary open_filemanager" data-id="og_image">Open File Manager</button>
							</span>
						</div>
                        <small><strong>Note:</strong> Acceptable file types are jpg, jpeg and png.</small>
                        <br/>
                        <small><i> <b>Note:</b> Minimum Size: 200px X 200px.</i></small>
						<div id="og_image_container">

						</div>
						<span id="og_image_img_err" class="error-msg"></span>
					</div>
				</div>
	  	</div>
	</div>

	</div>

<script type="text/javascript">

$(document).on('click', '.open_filemanager', function(e){
	$('#file_url').val('');
	$('#file_alt').val('');
    var data_id = $(this).attr("data-id");
    modal.file_manager(data_id);
});

$(document).on("click", ".btn_insert", function(e){
	var data_identifier = $(this).attr("identifier");
    var image_thumbnail = $('#file_url').val();
    var image_alt = $('#file_alt').val();
    var allowed_extensions_img = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    image_thumbnail = image_thumbnail.replace("<?= base_url();?>","");

    if(allowed_extensions_img.exec(image_thumbnail))
    {
    	$('#'+data_identifier+'_alt').val(image_alt);
    	$('#'+data_identifier+'_img').val(image_thumbnail);
    	$('#'+data_identifier+'_container').html('<img src="<?= base_url(); ?>'+image_thumbnail+'" alt="" class="img-responsive">');
    }else{
        $('#'+data_identifier+'_alt').val(image_alt);
        $('#'+data_identifier+'_img').val(image_thumbnail);
        $('#'+data_identifier+'_container').html('<img src="<?= base_url(); ?>assets/images/times.png" alt="" class="img-responsive">');
    }

    $(".bootbox").modal("hide");
    $("#ckeditor_filemanager_modal").modal("hide");

});

$(document).on('click', '#btn_save', function(){

	var url_new = $('.url').val();
	var counter = 0;

	$('.invalid').html('');

    	if(validate.standard()){
			var query = "url = '" + url_new + "'";
	    	var url = "<?= base_url('content_management/global_controller');?>";
			var data = {
			    event : "list", 
			    select : "*",
			    query : query, 
			    table : "cms_seo"
			}
			aJax.post(url,data,function(result){
		    	var obj = is_json(result);
			    if(obj.length != 0){
			    	$('.url').css('border-color', 'red');
		  			$('.invalid').html('<i>This URL is already registered.</i>');
		  			counter++;
			    }
			    if(counter == 0){
					save_data();
				}
			});

 		}

});

function save_data(){
	modal.confirm("Are you sure you want to save this record?",function(result){
	if(result){ 
		var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
	    var data = {
	    	event : "insert", // list, insert, update, delete
  	        table : "cms_seo", //table
	       	data : {
		        	url : $('.url').val(),
		        	meta_title : $('.meta-title').val(),
		        	meta_description : $('.meta-description').val(),
		        	meta_keywords : $('.meta-keywords').val(),
		        	og_description : $('.og-description').val(),
		        	og_title : $('.og-title').val(),
		        	og_image : $('.og-img').val(),
		        	og_type : 'product',
		        	create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
		        	update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
		        	status : 1
		    }  
		}

   		aJax.post(url,data,function(result){
	   		var obj = is_json(result);
		    modal.alert("<strong>Success!</strong> Record has been Saved",function(){ 
               location.reload();
            })
		})
	}

})
}

$(document).on('click', '#btn_close', function(e){
	location.href = '<?=base_url("content_management/seo") ?>';
});

</script>