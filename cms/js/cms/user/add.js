AJAX.config.base_url(base_url);

$("#password").on("change keydown paste input", function(event){
	var password_input = $(this).val();
	var min_ten_Regex = new RegExp("^(?=.{10,})");
	var special_char_Regex =  new RegExp('\\W|_');
	var upper_char_Regex = new RegExp("^(?=.*?[A-Z])");
	var number_Regex = new RegExp("^(?=.*[0-9])");

	if(min_ten_Regex.test(password_input)){
		$('.min_ten_chck').addClass('password_checker');
		$('.min_ten_chckbx').prop('checked', true);
	}else{
		$('.min_ten_chckbx').prop('checked', false);
		$('.min_ten_chck').removeClass('password_checker');
	}

	if(special_char_Regex.test(password_input)){
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

	if(number_Regex.test(password_input)){
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
});

//Check if email exists
$(document).on('click', '#btn_save', function(){
	$('.invalid-format').remove();
	$('.email-exists').remove();
	$('.maximum-admin').remove();
	var email = $('#email_address').val();
	var username_val = $('#username').val();
	var username_checker = username_val.length;
	var counter = 0;

	if(validate.standard(top_content)){
		if(validate.standard(bottom_content)){
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

					AJAX.select.exec(function(result){
				    	var obj = result;
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
		 		}else{
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

	AJAX.select.table("cms_user_roles");
	AJAX.select.select("id, name");
	AJAX.select.where.equal("status", 1);

	AJAX.select.exec(function(result){
		var obj = result;

		var dd_role_content = '';
		$.each(obj, function(x, y) {
			dd_role_content += '<option value = "'+y.id+'">'+y.name+'</option>'
		});

		$('#role').append(dd_role_content);
		$('.dd_notif_login_label').hide();
		$('#dd_notif_login').hide();
		$("#dd_notif_login option[value=0]").attr('selected', 'selected');
		modal.loading(false);
	});
}

//Save record
function save_data(){

	modal.standard(confirm_add, function(result){
		if(result){
			var username = $('#username').val();
			var name = $('#name').val()
		    var username_escaped = encode_Html(username);
		    var name_escaped = encode_Html(name);
			var hash_password = sha1($('#password').val());

			AJAX.insert.table("cms_users");
			AJAX.insert.params("username", username_escaped);
			AJAX.insert.params("email", $('#email_address').val());
			AJAX.insert.params("name", name_escaped);
			AJAX.insert.params("password", hash_password);
			AJAX.insert.params("role", $('#role').val());
			AJAX.insert.params("status", $('#status').val());
			AJAX.insert.params("notif_signup", $('#dd_user_sign_up').val());
			AJAX.insert.params("notif_contactus", $('#dd_contact_us').val());
			AJAX.insert.params("notif_login", $('#dd_notif_login').val());
			AJAX.insert.params("create_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
			AJAX.insert.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

			AJAX.insert.exec(function(result){
		   		modal.loading(true);
		   		insert_to_historical(result.id,hash_password);
			});
		}
	});
}

function insert_to_historical(user_id,data){
	AJAX.insert.table("cms_historical_passwords");
	AJAX.insert.params("user_id", user_id);
	AJAX.insert.params("password", data);
	AJAX.insert.params("create_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
	//AJAX.insert.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

	AJAX.insert.exec(function(result){
 		var obj = result;
   		modal.loading(false);
	    modal.alert(add_success, function(){
        	location.href = content_management + '/users';
        });
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
	AJAX.select.select("id,role,status");
	AJAX.select.where.equal("role", 6);
	AJAX.select.where.greater_equal("status", 0);

	AJAX.select.exec(function(result){
    	var obj = result;
    	count = obj.length;
    });

    return count;
}