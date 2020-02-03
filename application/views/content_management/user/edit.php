<div class="box">
	<?php
		$data['buttons'] = ['update','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$user_id = $this->uri->segment(4);
            $top_details = $this->load->details("cms_users", $user_id);

			$inputs = [
                'name',
                'username',
                'email_address',
                'role',
                'status'
            ];

            $values = [
                $top_details[0]->name,
                $top_details[0]->username,
                $top_details[0]->email,
                $top_details[0]->role,
                $top_details[0]->status
            ];

            $role_id = $top_details[0]->role;

            $top_content = $this->standard->inputs($inputs, $values);
		?>

		<br>
        <h2><strong>Notification</strong></h2>
        <hr>

        <?php
			$inputs = [
                'dd_user_sign_up',
                'dd_contact_us',
                'dd_notif_login'
            ];

            $values = [
                $top_details[0]->notif_signup,
                $top_details[0]->notif_contactus,
                $top_details[0]->notif_login
            ];

            $bottom_content = $this->standard->inputs($inputs, $values);
		?>
	</div>
</div>

<script type="text/javascript">
	var id = "<?= $this->uri->segment(4); ?>";
	var role_id = "<?= $role_id; ?>";

	//Get list of * active roles
	$(document).ready(function() {
		$('<small><i>Minimum character count is 10.</i></small>').insertAfter('#username');
		get_data();
	})


	$(document).on('change','.role_input',function(e){
		var selected_role = $(this).val();
		if(selected_role == 6){
			$('.dd_notif_login_label').show();
			$('#dd_notif_login').show();
			$("#dd_notif_login option[value=0]").removeAttr('selected');
		}else{
			$('.dd_notif_login_label').hide();
			$('#dd_notif_login').hide();
			$('#dd_notif_login').next('span').remove();
			$("#dd_notif_login option[value=0]").attr('selected', 'selected');
		}
	});


	function get_data(){
		var url = "<?= base_url('content_management/global_controller'); ?>";
		var data = {
			event : 'list',
			select : 'id, name',
			table : 'cms_user_roles',
			query : 'status = 1'
		}

		aJax.post_async(url, data, function(result) {
			var obj = is_json(result);

			var dd_role_content = '';

			$.each(obj, function(x, y) {
				if (role_id == y.id) {
					dd_role_content += '<option value = "'+y.id+'" selected>'+y.name+'</option>';
				} else {
					dd_role_content += '<option value = "'+y.id+'">'+y.name+'</option>';
				}
				if(role_id == 6){
					$('.dd_notif_login_label').show();
					$('#dd_notif_login').show();
				}else{
					$('.dd_notif_login_label').hide();
					$('#dd_notif_login').hide();
					$('#dd_notif_login').next('span').remove();
					$("#dd_notif_login option[value=0]").attr('selected', 'selected');
				}
			})

			$('#role').append(dd_role_content);

			modal.loading(false);
		});
	}

	//Check if email exists
	$(document).on('click', '#btn_update', function(){
		$('.invalid-format').remove();
		$('.email-exists').remove();
		$('.maximum-admin').remove();
		var previous_email = '<?=$top_details[0]->email;?>';
		var email = $('#email_address').val();
		var username_val = $('#username').val();
		var username_checker = username_val.length;
		var counter = 0;
		if (validate.standard("<?= $top_content; ?>")) {
			if (validate.standard("<?= $bottom_content; ?>")) {
				if(username_checker < 10){
					$('#username').css('border-color','red');
					$('#username').next().css('color','red');
					counter++;
				}else if (username_checker > 25){
					$('#username').css('border-color','red');
					$('#username').next().css('color','red');
					counter++;
				}else{
					counter=0;
					if(validate.email_address(email)){
				    	var url = "<?= base_url('content_management/global_controller');?>";
						var data = {
						    event : "list",
						    select : "id,email,status",
						    query : "email = '" + email + "' AND status >= 0 AND id != " + id,
						    table : "cms_users"
						}

						aJax.post(url,data,function(result){
					    	var obj = is_json(result);

					    	//Email already exists
					    	//Add red border to email address input box
					    	//Display email address already registered notification below the email address input box
						    if(obj.length != 0 && email != previous_email){
						    	$('#email_address').css('border-color', 'red');
					  			$('<i class="email-exists" style="color: red">This email address is already registered.</i>').insertAfter('#email_address');
					  			counter++;
						    }

						    if($('#role').val() == 6 && count_admin() >= 2){ // limit two admin
						    	$('#role').css('border-color', 'red');
					  			$('<i class="maximum-admin" style="color: red">The maximum Admin account that can be created is two.</i>').insertAfter('#role');
					  			counter++;
						    }

						    if(counter == 0){
								update_data();
							}
						});
			 		} else {
			 			//Invalid email format
			 			//Add red border to email address input box
			 			//Display invalid email format notification below the email address input box

			 			$('#email_address').css('border-color','red');
			  			$('<i class="invalid-format" style="color: red">Invalid email address format.</i>').insertAfter('#email_address');
			 		}
			  }
			}
		}
	});

	//Update record
	function update_data(){
		modal.confirm("Are you sure you want to update this record?",function(result){
			if(result){
				var url = "<?= base_url('content_management/global_controller');?>";
		   		var data = {
			    	event : "update",
			        table : "cms_users",
			        field : "id",
			        where : id,
			        data : {
			        	username : $('#username').val(),
			        	email : $('#email_address').val(),
			        	name : $('#name').val(),
			        	role : $('#role').val(),
			        	status : $('#status').val(),
			        	notif_signup : $('#dd_user_sign_up').val(),
	                    notif_contactus : $('#dd_contact_us').val(),
	                    notif_login : $('#dd_notif_login').val(),
			        	update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
			       }
		    	}

			   	aJax.post_async(url,data,function(result){
			   		var obj = is_json(result);

				    modal.alert("<?= $this->standard->dialog("update_success"); ?>",function(){
		            	location.href = '<?=base_url("content_management/users/") ?>';
		            })
				})
		 	}
		})
	}

	$(document).on('click', '#btn_close', function(e){
		location.href = '<?=base_url("content_management/users") ?>';
	});

	function count_admin(){
		var url = "<?= base_url('content_management/global_controller');?>";
		var data = {
		    event : "list",
		    select : "id,role,status",
		    query : "role = 6 AND status >= 0 AND id != "+id+"",
		    table : "cms_users"
		}
		var count = 0;

		aJax.post(url,data,function(result){
	    	var obj = is_json(result);
	    	console.log(obj);
	    	count = obj.length;
	    });

	    return count;
	}
</script>