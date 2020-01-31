AJAX.config.base_url(base_url);
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

	AJAX.select.table("cms_user_roles");
	AJAX.select.select("id, name");
	AJAX.select.where.equal("status", 1);

	AJAX.select.exec(function(result){
		var obj = result;
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
	var email = $('#email_address').val();
	var username_val = $('#username').val();
	var username_checker = username_val.length;
	var counter = 0;
	if (validate.standard(top_content)) {
		if (validate.standard(bottom_content)) {
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

					AJAX.select.table("cms_users");
					AJAX.select.select("id,email,status");
					AJAX.select.where.equal("email", email);
					AJAX.select.where.greater_equal("status", 0);
					AJAX.select.where.not("id", id);

					AJAX.select.exec(function(result){
					//aJax.post(url,data,function(result){
				    	var obj = result;

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
	modal.standard(confirm_update, function(result){
		if(result){
			modal.loading(true);
			var escaped_name = encode_Html($('#name').val());

	    	AJAX.update.table("cms_users");
	    	AJAX.update.where("id", id);
	    	AJAX.update.params("username", $('#username').val());
	    	AJAX.update.params("email", $('#email_address').val());
	    	AJAX.update.params("name", escaped_name);
	    	AJAX.update.params("role", $('#role').val());
	    	AJAX.update.params("status", $('#status').val());
	    	AJAX.update.params("notif_signup", $('#dd_user_sign_up').val());
	    	AJAX.update.params("notif_contactus", $('#dd_contact_us').val());
	    	AJAX.update.params("notif_login", $('#dd_notif_login').val());
	    	AJAX.update.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

	    	AJAX.update.exec(function(result){
		   		var obj = result;
		   		modal.loading(false);
			    modal.alert(update_success, function(){
	            	location.href = content_management + '/users';
	            });
			});
	 	}
	});
}

$(document).on('click', '#btn_cancel', function(e){
	modal.standard(confirm_cancel, function(result){
		if(result){
			location.href = content_management + '/users';
		}
	});
});

function count_admin(){

	var count = 0;
	AJAX.select.table("cms_users");
	AJAX.select.select("id, role, status");
	AJAX.select.where.equal("role", 6);
	AJAX.select.where.greater_equal("status", 0);
	AJAX.select.where.not("id", id);

	AJAX.select.exec(function(result){
    	var obj = result;
    	count = obj.length;
    });

    return count;
}