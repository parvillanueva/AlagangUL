AJAX.config.base_url(base_url);

$("#password1").on("change keydown paste input", function(event){ 
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

$(document).on('click', '#btn_close', function(){
    location.href = content_management + "/login";
});

$(document).on('click', '#request_new', function(){
    location.href = content_management + "/login/forgot";
});

$(document).on('click', '#reset_password', function(e){
    e.preventDefault();
    var counter = 0;
    var re_password = $('#password1').val().trim();
    var new_password = $('#password2').val().trim();
    var required_message = "<span class='validate_error_message' style='color: red;'>"+form_empty_error+"<br></span>";
    var wrong_old_password_message = "<span class='validate_error_message' style='color: red;'>Incorrect old password.<br></span>";
    var password_miss_match_message = "<span class='validate_error_message' style='color: red;'>New password is not matched with Confirm password.<br></span>";
    var password_used_message = "<span class='validate_error_message' style='color: red;'>You have already used this password. Please try something new.<br></span>";

    $('.validate_error_message').remove();
    $('.required').css('border-color', '#eee');

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
        if(!$(this).is(':checked')){
            counter++;
            $("."+id+"").css('color','red');
        }else{
            $("."+id+"").css('color','#333');
        }
    });

    if(counter == 0){
        modal.loading(true);
        setTimeout(save, 1000);
    }
});

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

function save(){

    var password1 = $('#password1').val();
    var password2 = $('#password2').val();

    var url_save = content_management + "/forgot_password/change_password";
    var data = { 
            user_id : user_id2,
            password1 : password1,
            password2 : password2
        }

    aJax.post(url_save,data,function(result){
        var obj = is_json(result);
        if(obj.success){
            $('.callout').addClass('callout-success').removeClass('callout-danger');
            $('.callout').html(obj.message);
            $('.callout').show();
        } else {
            $('.callout').addClass('callout-danger').removeClass('callout-success');
            $('.callout').html(obj.message);
            $('.callout').show();
        }

        $(".btn-reset").html("Reset Password");
        modal.loading(false);
    });
}

$(document).on("keypress", "#password1, #password2", function(e) {                          
    if(e.keyCode == 13){
        $("#reset_password").click();
    }
});