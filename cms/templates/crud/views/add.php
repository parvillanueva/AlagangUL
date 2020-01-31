<div class="box">
	<?php $data["buttons"] = ["save","close"]; ?>
	<?php $this->load->view("content_management/template/buttons", $data); ?>

	<div class="box-body">
		<div class="form-horizontal">
			{form}
 			<div class="form-group">
              	<label class="col-sm-2 control-label">Status</label>
              	<div class="col-sm-3">
              		<select id="status" class="form-control">
                		<option value=1>Published</option>
                		<option value=0>Unpublished</option>
                	</select>
              	</div>
            </div>
        </div>
	</div>
</div>

<script type="text/javascript">
	
	{ckeditor}
	$('.ui-tooltip').attr("stlye","hidden");

	$(document).on("click", "#btn_close", function(e){
		location.href = "<?=base_url("content_management/site_{menu}/");?>";
	});

	$(document).on("click", "#btn_save", function(e){
		modal.confirm("Are you sure you want to save this record?",function(result){
			if(result){
			// if(validate.required('.required') == 0){
				var url = "<?=base_url();?>content_management/global_controller"; //URL OF CONTROLLER
			    var data = {
			    	event : "insert", // list, insert, update, delete
			        table : "{table}", //table
			        data : { {table_field}
		        		status : $("#status").val(),
		        		create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
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