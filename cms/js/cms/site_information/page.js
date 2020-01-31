AJAX.config.base_url(base_url);

$('#google_analytics').wrap('<div class="input-group"></div>');
$('<span class="input-group-addon"><input type="checkbox" id="ga_status"> Enabled</span>').insertAfter('#google_analytics');

$(document).ready(function(){

    get_data();
});

$(document).on('click', '#btn_update', function(e){
    $('.error-msg').html(''); 
    validate_fields();
});

function validate_fields(){
    var error_message = 'This field is required.';
    var error_message_link = 'Invalid URL.';

    var FB_url = /^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i;
    var Twitter_url =/^(https?:\/\/)?((w{3}\.)?)twitter.com\/.*/i;
    var Instagram_url= /^(https?:\/\/)?((w{3}\.)?)instagram.com\/.*/i;
    var Linkedin_url = /(https?)?:?(\/\/)?(([w]{3}||\w\w)\.)?linkedin.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    var Tumblr_url = /^(https?:\/\/)?((w{3}\.)?)tumblr.com\/.*/i;
    var Pinterest_url = /^(https?:\/\/)?((w{3}\.)?)pinterest.ph\/.*/i;
    var Youtube_url = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
    var facebook = $('#facebook').val();
    var twitter = $('#twitter').val();
    var instagram = $('#instagram').val();
    var linkedin = $('#linked_in').val();
    var tumblr = $('#tumblr').val();
    var pinterest = $('#pinterest').val();
    var youtube = $('#youtube_link').val();
    var shop_url = $('#shop_url').val();
    var g_tag_header = $('#gtm_header').val();
    var g_tag_body = $('#gtm_body').val();
    
    var counter =0;
    
    if(validate.standard(site_details)){

        if(validate.standard(notification_details)){
            if(is_valid_url(shop_url) == false && shop_url.length != 0){
                $('.url_error').remove();  
                $('<i class="url_error" style="color: red;" >Invalid URL.</i>').insertAfter('#shop_url');
                counter++;  
            } else {
                $('.url_error').remove(); 
            }

         
            if (facebook.match(FB_url)) {
                $('.facebook_error').remove(); 
            } else {
                if(facebook != ''){
                    $('.facebook_error').remove(); 
                   $('<i class="facebook_error" style="color: red;" >Please enter valid Facebook URL.</i>').insertAfter('#facebook');
                    counter++;
                }else{
                    $('.facebook_error').remove();
                }
            }

            if (twitter.match(Twitter_url)) {
                $('.twitter_error').remove();
            } else {
                if(twitter != ''){
                    $('.twitter_error').remove();
                    $('<i class="twitter_error" style="color: red;" >Please enter valid Twitter URL.</i>').insertAfter('#twitter');
                    counter++;
                }else{
                    $('.twitter_error').remove();
                }
            }

            if (instagram.match(Instagram_url)) {
                $('.instagram_error').remove();
            } else {
                if(instagram != ''){
                    $('.instagram_error').remove();
                    $('<i class="instagram_error" style="color: red;" >Please enter valid Instagram URL.</i>').insertAfter('#instagram');
                    counter++;
                }else{
                    $('.instagram_error').remove();
                }
            }

            if (linkedin.match(Linkedin_url)) {
                $('.linkedin_error').remove();
            } else {
                if(linkedin != ''){
                    $('.linkedin_error').remove();
                    $('<i class="linkedin_error" style="color: red;" >Please enter valid linkedin URL.</i>').insertAfter('#linked_in');
                    counter++;
                }else{
                    $('.linkedin_error').remove();
                }
            }

            if (tumblr.match(Tumblr_url)) {
                $('.tumblr_error').remove();
            } else {
                if(tumblr != ''){
                    $('.tumblr_error').remove();
                    $('<i class="tumblr_error" style="color: red;" >Please enter valid Tumbler URL.</i>').insertAfter('#tumblr');
                    counter++;
                }else{
                    $('.tumblr_error').remove();
                }
            }

            if (pinterest.match(Pinterest_url)) {
                $('.pinterest_error').remove();
            } else {
                if(pinterest != ''){
                    $('.pinterest_error').remove();
                    $('<i class="pinterest_error" style="color: red;" >Please enter valid Pinterest URL.</i>').insertAfter('#pinterest');
                    counter++;
                }else{
                    $('.pinterest_error').remove();
                }
            }
            
            if (youtube.match(Youtube_url)) {
               $('.youtube_error').remove();
            } else { 
                if(youtube != ''){
                    $('.youtube_error').remove();
                    $('<i class="youtube_error" style="color: red;" >Please enter valid Pinterest URL.</i>').insertAfter('#youtube_link');
                    counter++;
                }else{
                    $('.youtube_error').remove();
                }
            }

            if(g_tag_header.match(/<\?/) || g_tag_header.match(/<\?php/)){
                $('#g_tag_header_err').html('Invalid script.');
                counter++;  
            }

            if(g_tag_body.match(/<\?/) || g_tag_body.match(/<\?php/)){
                $('#g_tag_body_err').html('Invalid script.');
                counter++;  
            }
            if(counter == 0){
                update_data();
            }
        }
    }     
    
}

function get_data(){
    
    AJAX.select.table("site_information");
    AJAX.select.select("id, title, description, keyword, ga_id, shop_url, favicon, logo, facebook, twitter, instagram, pinterest, linkedin, tumblr, youtube, ga_status, notif_status, notif_position, notif_browser, notif_message,google_tag_manager_header,google_tag_manager_body");
    AJAX.select.where.equal("id", "1");

    AJAX.select.exec(function(result){
        var obj = result;
        var notif_browser = [];
        $.each(obj, function(x,y){
            $('#title').val(y.title);
            $('#meta_description').val(y.description);
            $('#meta_keyword').val(y.keyword);
            $('#google_analytics').val(y.ga_id);
            $('#shop_url').val(y.shop_url);
            $('#facebook').val(y.facebook);
            $('#twitter').val(y.twitter);
            $('#instagram').val(y.instagram);
            $('#pinterest').val(y.pinterest);
            $('#linked_in').val(y.linkedin);
            $('#youtube_link').val(y.youtube);
            $('#tumblr').val(y.tumblr);

            if(y.ga_status == 1){
              $('#ga_status').prop('checked', true);
            }

            notif_browser = JSON.parse(y.notif_browser);
            $.each(notif_browser, function(a,b) {
                $("input[value='"+b.value+"']").prop('checked', true);
                console.log(b.value);
            });

            $('#notification_status').val(y.notif_status);
            $('#notification_position').val(y.notif_position);
            $('#notification_message').val(y.notif_message);
            $('#gtm_header').val(y.google_tag_manager_header);
            $('#gtm_body').val(y.google_tag_manager_body);
        });
    });

}

function update_data(){

    var ga_status = 0;
    if ($('#ga_status').prop('checked')) {
        ga_status = 1;
    }

    if(validate.standard(site_details) && validate.standard(notification_details)){
        modal.standard(confirm_update, function(result){
            if(result){

                AJAX.update.table("site_information");
                AJAX.update.where("id", 1);
                AJAX.update.params("title", $('#title').val());
                AJAX.update.params("description", $('#meta_description').val());
                AJAX.update.params("keyword", $('#meta_keyword').val());
                AJAX.update.params("ga_id", $('#google_analytics').val());
                AJAX.update.params("shop_url", $('#shop_url').val());
                AJAX.update.params("favicon", $('#favicon_img').val());
                AJAX.update.params("logo", $('#brand_logo').val());
                AJAX.update.params("facebook", $('#facebook').val());
                AJAX.update.params("twitter", $('#twitter').val());
                AJAX.update.params("instagram", $('#instagram').val());
                AJAX.update.params("pinterest", $('#pinterest').val());
                AJAX.update.params("linkedin", $('#linked_in').val());
                AJAX.update.params("youtube", $('#youtube_link').val());
                AJAX.update.params("tumblr", $('#tumblr').val());
                AJAX.update.params("ga_status", ga_status);
                AJAX.update.params("notif_status", $('#notification_status').val());
                AJAX.update.params("notif_position", $('#notification_position').val());
                AJAX.update.params("notif_browser", JSON.stringify($('input[name*="notification_browser"]').serializeArray()));
                AJAX.update.params("notif_message", $('#notification_message').val());
                AJAX.update.params("google_tag_manager_header", $('#gtm_header').val());
                AJAX.update.params("google_tag_manager_body", $('#gtm_body').val());
                AJAX.update.params("update_date", moment(new Date()).format("YYYY-MM-DD HH:mm:ss"));                               
                
                // var protocol = $("#protocol").val();
                // var host = $("#host").val();
                // var email = $("#email").val();
                // var email_sendmail = $("#default_email").val();
                // var password = $("#password").val();
                // var port = $("#port").val();
                // aJax.post(
                //     url,
                //     {
                //         protocol : protocol,
                //         host : host,
                //         email : email,
                //         email_sendmail : email_sendmail,
                //         password : password,
                //         port : port
                //     },
                //     function(result){

                //     }
                // );
                AJAX.update.exec(function(result){
                    modal.alert(update_success, function(){
                        location.reload();
                    });
                });
            }
        });
    }
}

function is_valid_url(string) {
    var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if (res == null)
        return false;
    else
        return true;
};

$(document).on('keypress', 'textarea', function(e){
    if (e.which == 13) { 
       e.preventDefault();
    }
});