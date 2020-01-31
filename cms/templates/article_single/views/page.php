<div class="box">
	<?php	
		$data["buttons"] = ["update"]; // add, save, update
		$this->load->view("content_management/template/buttons", $data);
	?>
	<div class="box-body">
		<div class="form-horizontal">
            <div class="form-group">
              	<div class="col-sm-12">
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

	$(document).on("click", "#btn_update", function(e){
		modal.confirm("Are you sure you want to save this record?",function(result){
			if(result){
				// if(validate.required('.required') == 0){
					var editor = CKEDITOR.instances.body.getData();

				    AJAX.update.table("{table}");
				    AJAX.update.where("id", 1);
				    AJAX.update.params("body", editor);
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