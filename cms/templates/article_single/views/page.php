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
	
	CKEDITOR.replace( 'body',{height: '500px'});
	CKEDITOR.instances.body.setData('<?= $details[0]->body;?>');
	$('.ui-tooltip').attr("stlye","hidden");

	$(document).on("click", "#btn_update", function(e){
		modal.confirm("Are you sure you want to save this record?",function(result){
			if(result){
				// if(validate.required('.required') == 0){
					var editor = CKEDITOR.instances.body.getData();
					var url = "<?=base_url();?>content_management/global_controller"; //URL OF CONTROLLER
				    var data = {
				    	event : "update", // list, insert, update, delete
				    	field : "id", //field name
		        		where : 1, //equals to
				        table : "{table}", //table
				        data : {
			        		body : editor,
			        		update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
			        		user : "<?= $this->session->userdata('sess_uid');?>"
				        } //data to insert
				    }

				    aJax.post(url,data,function(result){
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