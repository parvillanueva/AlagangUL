<div class="box">
	<?php
		$data['buttons'] = ['save','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$inputs = [
                'name',
                'username',
                'email_address',
                'password',
                'role',
                'status'
            ];

            $top_content = $this->standard->inputs($inputs);
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

            $bottom_content = $this->standard->inputs($inputs);
		?>
	</div>
</div>

<script type="text/javascript">





	$("#password").on("change keydown paste input", function(event) { 
			var password_input = $(this).val();
			var min_ten_Regex = new RegExp("^(?=.{10,})");
			var special_char_Regex =  new RegExp("^(?=.*[!@#\$%\^&])");
			var upper_char_Regex = new RegExp("^(?=.*?[A-Z])");
			var number_Regex = new RegExp("^(?=.*[0-9])");

			if(min_ten_Regex.test(password_input)){
				$('.min_ten_chck').addClass('password_checker');
				$('.min_ten_chckbx').prop('checked', true);
			}else{
				$('.min_ten_chckbx').prop('checked', false);
				$('.min_ten_chck').removeClass('password_checker');
			}

			if (special_char_Regex.test(password_input)){
				$('.special_chck').addClass('password_checker');
				$('.special_chckbx').prop('checked', true);
			}else{
				$('.special_chckbx').prop('checked', false);
				$('.special_chck').removeClass('password_checker');
			}

			if(upper_char_Regex.test(password_input)){
				$('.upper_chck').addClass('password_checker');
				$('.upper_chckbx').prop('checked', true);
			}else{
				$('.upper_chckbx').prop('checked', false);
				$('.upper_chck').removeClass('password_checker');
			}

			if (number_Regex.test(password_input)){
				$('.number_chck').addClass('password_checker');
				$('.number_chckbx').prop('checked', true);
			}else{
				$('.number_chckbx').prop('checked', false);
				$('.number_chck').removeClass('password_checker');
			}
	   
	});


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

	//Get list of * active roles
	$(document).ready(function() {
		$('#status [value="1"]').prop('selected', true);
		$('<small><i>Minimum character count is 10.</i></small>').insertAfter('#username');
		get_data();

	})

	//Check if email exists
	$(document).on('click', '#btn_save', function(){
		$('.invalid-format').remove();
		$('.email-exists').remove();
		$('.maximum-admin').remove();
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
						    query : "email = '" + email + "' AND status >= 0",
						    table : "cms_users"
						}

						aJax.post(url,data,function(result){
					    	var obj = is_json(result);
					    	//Email already exists
					    	//Add red border to email address input box
					    	//Display email address already registered notification below the email address input box
						    if(obj.length != 0){
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
								save_data();
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

	function get_data(){
		modal.loading(true);
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
				dd_role_content += '<option value = "'+y.id+'">'+y.name+'</option>'
			})

			$('#role').append(dd_role_content);
			$('.dd_notif_login_label').hide();
			$('#dd_notif_login').hide();
			$("#dd_notif_login option[value=0]").attr('selected', 'selected');
			modal.loading(false);
		});
	}

	//Save record
	function save_data(){
		modal.confirm("Are you sure you want to save this record?",function(result){
			if(result){
				var hash_password = sha1($('#password').val());
				var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
			    var data = {
			    	event : "insert", // list, insert, update, delete
		  	        table : "cms_users", //table
			       	data : {
			        	username : $('#username').val(),
			        	email : $('#email_address').val(),
			        	name : $('#name').val(),
			        	password : hash_password,
			        	role : $('#role').val(),
	                    status : $('#status').val(),
	                    notif_signup : $('#dd_user_sign_up').val(),
	                    notif_contactus : $('#dd_contact_us').val(),
	                    notif_login : $('#dd_notif_login').val(),
			        	create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
				    }
				}

		   		aJax.post_async(url,data,function(result){
			   		var obj = is_json(result);
			   		modal.loading(true);
			   		insert_to_historical(obj,hash_password);
				})
			}
		})
	}


	function insert_to_historical(user_id,data){
		var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
		var data = {
	    	event : "insert", // list, insert, update, delete
  	        table : "cms_historical_passwords", //table
	       	data : {
	        	user_id : user_id,
	        	password : data,
	        	create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
		    }
		}
		aJax.post_async(url,data,function(result){
	   		var obj = is_json(result);
	   		modal.loading(false);
		    modal.alert("<?= $this->standard->dialog("add_success"); ?>",function(){
            	location.href = '<?=base_url("content_management/users/") ?>';
            })
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
		    query : "role = 6 AND status >= 0",
		    table : "cms_users"
		}
		var count = 0;

		aJax.post(url,data,function(result){
	    	var obj = is_json(result);
	    	count = obj.length;
	    });

	    return count;
	}
</script>