AJAX.config.base_url(base_url);

$(document).on('click', '#btn_update', function(){
	validate_fields();
});

function validate_fields(){
	var counter = 0;
	var re_password = $('.re-password').val().trim();
	var new_password = $('.new-password').val().trim();
	var old_password = $('.old-password').val().trim();
	var required_message = "<span class='validate_error_message' style='color: red;'>"+form_empty_error+"<br></span>";
	var wrong_old_password_message = "<span class='validate_error_message' style='color: red;'>Incorrect old password.<br></span>";
	var password_miss_match_message = "<span class='validate_error_message' style='color: red;'>New password is not matched with Confirm password.<br></span>";
	var password_used_message = "<span class='validate_error_message' style='color: red;'>Your new password is too similar to your previous passwords. Please try another password.<br></span>";


	$('.validate_error_message').remove();
	$('.required').css('border-color', '#eee');

	/* Old Password */
	if(old_password == ''){
		$('.old-pw-err').html(required_message);
		$('.old-password').css('border-color','red');
		counter++;
	}else if(is_exists(user_id, old_password) == 0){
		$('.old-pw-err').html(wrong_old_password_message);
		$('.old-password').css('border-color','red');
		counter++;
	}

	/* New Password */
	if(new_password == ''){
		$('.new-pw-err').html(required_message);
		$('.new-password').css('border-color','red');
		counter++;
	}else if(is_exists_historical(user_id, new_password) == 1){
		$('.new-pw-err').html(password_used_message);
		$('.new-password').css('border-color','red');
		counter++;
	}

	/* Confirm Password */
	if(re_password == ''){
		$('.re-pw-err').html(required_message);
		$('.re-password').css('border-color','red');
		counter++;
	}else if(re_password != new_password){
		$('.re-pw-err').html(password_miss_match_message);
		$('.re-password').css('border-color','red');
		$('.new-password').css('border-color','red');
		counter++;
	}

	$('.password_checkbox').each(function(){
		var id = $(this).attr("id");
		if(!$(this).is(':checked')) {
			counter++;
			$("."+id+"").css('color','red');
		}else{
			$("."+id+"").css('color','#333');
		}
	});

	if(counter == 0){
		save_data();
	}
}

$("#password").on("change keydown paste input", function(event) { 
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



function is_exists(user_id, password){
    var exists = 0;

    AJAX.select.table("cms_users");
    AJAX.select.select("id, password");
    AJAX.select.where.equal("id", user_id);
    AJAX.select.where.equal("password", sha1(password));
    AJAX.select.exec(function(result){
        var obj = result;
        if(obj.length != 0){
            exists = 1;
        }
        else{
            exists = 0;
        }
    });
    return exists;
}

function is_exists_historical(user_id, password){
    var exists = 0;
    
    AJAX.select.table("cms_historical_passwords");
    AJAX.select.select("id, user_id, password");
    AJAX.select.where.equal("user_id", user_id);
    AJAX.select.where.equal("password", sha1(password));

    AJAX.select.exec(function(result){
        var obj = result;
        if(obj.length != 0){
            exists = 1;
        }
        else{
            exists = 0;
        }
    });
    return exists;
}

function save_data(){
	modal.confirm("Are you sure you want to change your password?", function(result){
		if(result){
			modal.loading(true);
			setTimeout(function(){
				var url = content_management + '/change_password/update_password';
				var data = {
				    password : $('.re-password').val().trim()
		    	}

				aJax.post(url,data,function(result){
			    	modal.loading(false);
		    		modal.alert("Your password has been updated successfully.",function(){		
						location.href = content_management + '/change_password';	
					});
			    });
			}, 2000);
		}
	});
}

$(document).on("keypress", ".re-password, .new-password, old-password", function(e) {               
	if (e.keyCode == 13) {
	 	$("#btn_update").click();
	}
});