$(document).ready(function(){
    if(logout_data != ''){
        $('.logout-success').html(logout_data);
        $('.logout-success').show();
    }

    setTimeout(function(){
        $('.logout-success').hide();
    }, 5000);
});

$(document).on('click', '#btn_login', function() {

    //button loader
    var spinner_btn = $(this);
    spinner_btn.button('loading');

    //checks if ad authentication is enabled
    var ad_status = (is_ad == 1 || is_ad == 2) ? ad_authentication() : 'disabled';

    setTimeout(function(){
        $('.callout').hide();
        var url = content_management + "/login/validate_log";
        var data = {
            username: $('.username').val(), 
            password: $('.password').val(),
            ad_status: ad_status
        }

        aJax.post(url,data,function(result){
            var obj = is_json(result);
            var result_count = obj.count;

            if(result_count == 0 || result_count == 1){

                var encoded_username = document.getElementById("username");
                var encoded_password = document.getElementById("password");

                if($('.username').val() == '' || $('.password').val() == ''){

                    var callout_message = '';

                    if($('.username').val() == ''){
                        callout_message += 'Username is required. ';
                        encoded_username.style.border = "thin solid red";
                    }else{
                        encoded_username.removeAttribute("style");
                    }

                    if($('.password').val() == ''){
                        callout_message += 'Password is required.';
                        encoded_password.style.border = "thin solid red";
                    }else{
                        encoded_password.removeAttribute("style");
                    }

                    $('.callout-warning').text(callout_message);
                    $('.callout-warning').show();

                }else if(result_count == 0 || result_count == 1 ){
                    encoded_username.style.border = "thin solid red";
                    encoded_password.style.border = "thin solid red";
                    $('.callout-warning').html("Login Failed: Incorrect "+account_type+" or password. "+obj.message+"");
                    $('.callout-warning').addClass('callout-warning').removeClass('callout-success');
                    $('.callout-warning').show();
                    spinner_btn.button('reset');
                }
            }else if(result_count == 2){
                $('.callout-warning').html("Your account has been deactivated. Please contact the administrator immediately.");
                $('.callout-warning').addClass('callout-warning').removeClass('callout-success');
                $('.callout-warning').show();
                spinner_btn.button('reset');
            }else if(result_count == 3){
                $('#username').css("border", "#d2d6de solid 1px");
                $('#password').css("border", "#d2d6de solid 1px");
                location.href = content_management + '/home';
            }else if (result_count == 4){
                $('.callout-warning').addClass('callout-danger').removeClass('callout-warning').removeClass('callout-success').html("We’re sorry, your account has been blocked due to too many recent failed login attempts. Please try again after 5 minutes.");
                $('.callout-danger').show();
                spinner_btn.button('reset');
            }else if(result_count == 5){
                $('.callout-warning').removeClass('callout-success');
                $('.callout-warning').removeClass('callout-danger');
                $('.callout-warning').html('Password is expired. We sent you an email to reset your password.');
                $('.callout-warning').show();
            }else if (result_count == 6){
                $('.callout-warning').addClass('callout-danger').removeClass('callout-warning').removeClass('callout-success').html("We’re sorry, your account has been blocked due to too many recent failed login attempts. Please contact the administrator immediately.");
                $('.callout-danger').show();
                spinner_btn.button('reset');
            }
        });

        spinner_btn.button('reset');
    }, 300);
});

$(document).on("keypress", "#username, #password", function(e) {                          
    if(e.keyCode == 13){
        $("#btn_login").click();
    }
});

$(document).on("click", "#reset_password", function(){
    location.href = content_management + "/login/forgot";
});

function ad_authentication(){
    var url = azure_pwgrant;
    var data = {
        email: $('.username').val(), 
        password: $('.password').val()
    }

    var result = '';

    aJax.post(url, data, function(data){
        var obj = is_json(data);
        result = obj.status;
    });

    return result;
}

$(document).on('focus, input', '#password', function(){
    var password = $(this).val();

    if(password.length == 0 || password == ''){
        $(this).removeClass('masked-password');
    }else{
        $(this).addClass('masked-password');
    }
});