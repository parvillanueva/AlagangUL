$(document).on('click', '#btn_close', function(){
    location.href = content_management + '/login';
});

$(document).on('click', '#reset_password', function(){
    $('.callout').hide().addClass('callout-warning').removeClass('callout-success');
    var email = $('.email').val(); 

    if(email.length > 0){
        if(check_email() == 0){
            $('.callout').html("This email does not exist.");
            $('.callout').show();
        }else if(validate.email_address(email)){
            submit_email();
        }else{
            $('.callout').html("Email address is not valid.");
            $('.callout').show();
        }    
    }else{
        $('.callout').html("Email address is required.");
        $('.callout').show();
    }   
});

$(document).on("keypress", "#email", function(e){                          
    if(e.keyCode == 13){
        $("#reset_password").click();
    }
});

function submit_email(){
    var email = $('.email').val();
    var url = content_management + "/forgot_password/send_email";
    var data = { 
        email : email 
    }

    modal.loading(true);
    aJax.post(url,data,function(result){
        modal.loading(false);
        $('.callout').html("We've sent an email to <b>" + email + "</b>");
        $('.callout').show().removeClass('callout-warning').addClass('callout-success');
    });
}

function check_email(){
    var email = $('.email').val();
    var count = 0;

    var url = content_management + "/forgot_password/check_email";
    var data = { 
        email : email 
    }

    aJax.post(url,data,function(result){
        count = result;
    });

    return count;
}