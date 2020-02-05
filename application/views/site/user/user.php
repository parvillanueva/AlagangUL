<div class="box">
	<?php
		$data['buttons'] = ['save','cancel'];
		$this->load->view("layout/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$inputs = [
				'user_firstname',
				'user_lastname',
				'user_gender',
				'user_birthday',
				'user_email',
				'user_mobile',
				'user_password',
				'user_confirm_password',
				
				
            ];

            $id = $this->standard->inputs($inputs);
		?>
		<div class="form-group">
			<label class="control-label user_profile_image col-sm-2" style="">Image:</label>
			<div class="col-sm-10">
				<div class="input-group user_profile_image" style="">   
					<input id="user_image_input" class="form-control" readonly="" value="" accept="" name="meta_keyword" max_size="">     
					<form id="first_form" method="post" enctype="multipart/form-data">
						<input type="file" id="user_image" accept="image/png,image/gif,image/jpg">
					</form>
					<span class="input-group-btn" style="vertical-align: top;">          
						<button type="button" data-id="user_image" class="user_image_button btn btn-info btn-flat">Open File Manager</button>
					</span>  
				</div>
				<br>
				<div id="img_delete_button" class="img_delete_button_video_article_thumbnail"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#user_image').hide();
	});
	$(document).on('click', '#btn_save', function(){
		if(validate.standard("<?php echo $id?>")) {
			var modal_obj = '<?= $this->standard->confirm("confirm_save"); ?>'; 
			modal.standard(modal_obj, function(result){
				if(result){
					modal.loading(true);
					var lastname = $('#user_lastname').val();
					var firstname = $('#user_firstname').val();
					var gender = $('#user_gender').val();
					var birthday = $('#user_birthday').val();
					var email = $('#email_address').val();
					var mobile = $('#user_mobile').val();
					var password = $('#password').val();
					var con_password = $('#confirm_password').val();
					var file_data = $('#user_image').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('user_image', file_data);
					form_data.append('CMDEvent', 'register');
					form_data.append('last_name', lastname);
					form_data.append('first_name', firstname);
					form_data.append('gender', gender);
					form_data.append('birthday', birthday);
					form_data.append('email_address', email);
					form_data.append('mobile_number', mobile);
					form_data.append('password', password);
					form_data.append('confirm_password', con_password);
					var url = '<?php echo base_url()."api/users?token=".$token ?>';                           
					$.ajax({
						url: url,
						dataType: 'text',  
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,                         
						type: 'post',
						success: function(result){
							var obj = is_json(result);
							console.log(obj);
							var result_code = obj.Code;
							switch(result_code){
								case 201:
									var message = '<?= $this->standard->dialog("save_success"); ?>';
									modal.loading(false);
									modal.alert(message);
								break;
								case 504:
									var message = '<?= $this->standard->dialog("duplicate_entry"); ?>';
									modal.loading(false);
									modal.alert(message);
								break;
							}
						}
					});
				}
			});
		}		
	});
	
	$(document).on('click', '.user_image_button', function(){
		$('#user_image').click();
	});
	
	$(document).on('change', '#user_image', function(e){
		var image_val = $(this).val();
		$('#user_image_input').val(image_val);
	});
</script>