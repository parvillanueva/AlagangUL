<?php

    $details = str_replace(base_url(), "", $this->load->details("site_information",1));
    $logo= "";
    $favicon = "";
    
    if($details[0]->logo != ""){
        $logo = '<img class="img_logo_img" src="'.base_url().$details[0]->logo.'" width="100%" />';
    }
    
    if($details[0]->favicon != ""){
        $favicon = '<img class="img_favicon_img" src="'.base_url().$details[0]->favicon.'" width="100%" />';
    }

    $this->config->load('email');

    $host = "";
    if($this->config->item("smtp_host")){
        $host = $this->config->item("smtp_host");
    }

    $email = "";
    if($this->config->item("smtp_user")){
        $email = $this->config->item("smtp_user");
    }

    $password = "";
    if($this->config->item("smtp_pass")){
        $password = $this->config->item("smtp_pass");
    }

    $port = "";
    if($this->config->item("smtp_port")){
        $port = $this->config->item("smtp_port");
    }

    $default_email = "";
    if($this->config->item("default_email")){
        $default_email = $this->config->item("default_email");
    }

?>

<div class="box">
  <?php
    $data['buttons'] = ['update']; // add, save, update
    $this->load->view("content_management/template/buttons", $data);
  ?>  
    <div class="box-body"> 
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input id="title" class="form-control" placeholder="Website Title">
                </div>
            </div>
            <!-- <div class="form-group">
                <label  class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea id="description" class="form-control" rows="6"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Keyword</label>
                <div class="col-sm-10">
                    <textarea id="keyword" class="form-control" rows="6"></textarea>
                </div>
            </div> -->

            <div class="form-group">
                <label class="col-sm-2 control-label">Shop URL</label>
                <div class="col-sm-10">
                    <input id="shop" class="form-control" type="text" />
                    <span id="shop_url_err" class="error-msg"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Favicon</label>
                <div class="col-sm-6">
                    <div class="input-group favicon_img"> 
                        <input id="favicon_img" class="form-control req" readonly value="<?= $details[0]->favicon;?>" />
                        <span class="input-group-btn ">
                            <button type="button" data-id="favicon_img" class="btn open_filemanager btn-info btn-flat">Open File Manager</button>
                        </span>
                    </div>
                    <?= $favicon;?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Brand Logo</label>
                <div class="col-sm-6">
                    <div class="input-group logo_img"> 
                        <input id="logo_img" class="form-control req" readonly value="<?= $details[0]->logo;?>" />
                        <span class="input-group-btn ">
                            <button type="button" data-id="logo_img" class="btn open_filemanager btn-info btn-flat">Open File Manager</button>
                        </span>
                    </div>
                    <?= $logo;?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Keywords</label>
                <div class="col-sm-7">
                    <textarea id="keyword" class="text form-control" rows="10" placeholder=""></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-7">
                    <textarea id="description" class="text form-control" rows="10" placeholder=""></textarea>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Google Analytics</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" id="ga_id" class="form-control" placeholder="Tracking ID">
                    <span class="input-group-addon">
                      <input type="checkbox" id="ga_status"> Enabled
                    </span>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Google Tag Manager(Header)</label>
                <div class="col-sm-7">
                    <textarea id="gmt_header" class="text form-control" rows="10" placeholder=""></textarea>
                    <span id="g_tag_header_err" class="error-msg"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Google Tag Manager(Body)</label>
                <div class="col-sm-7">
                    <textarea id="gmt_body" class="text form-control" rows="10" placeholder=""></textarea>
                    <span id="g_tag_body_err" class="error-msg"></span>
                </div>
            </div>
            <hr>
            <div class="form-container">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Facebook Link</label>
                    <div class="col-sm-10">
                        <input id="facebook" class="form-control facebook" type="text" />
                        <span id="fb_link_err" class="error-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Twitter Link</label>
                    <div class="col-sm-10">
                        <input id="twitter" class="form-control twitter" type="text" />
                        <span id="twitter_link_err" class="error-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Intagram Link</label>
                    <div class="col-sm-10">
                        <input id="instagram" class="form-control instagram" type="text" />
                        <span id="instagram_link_err" class="error-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Pinterest Link</label>
                    <div class="col-sm-10">
                        <input id="pinterest" class="form-control pinterest" type="text" />
                        <span id="pinterest_link_err" class="error-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Linked in Link</label>
                    <div class="col-sm-10">
                        <input id="linkedin" class="form-control linkedin" type="text" />
                        <span id="linkedin_link_err" class="error-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Youtube Link</label>
                    <div class="col-sm-10">
                        <input id="youtube" class="form-control youtube" type="text" />
                        <span id="youtube_link_err" class="error-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Tumblr Link</label>
                    <div class="col-sm-10">
                        <input id="tumblr" class="form-control tumblr" type="text" />
                        <span id="tumblr_link_err" class="error-msg"></span>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Email Configuration</h3>
            <div class="form-group">
                <label class="col-sm-2 control-label">Protocol</label>
                <div class="col-sm-5">
                    <select id="protocol" class="form-control required">
                        <option disabled value="">Select..</option>
                        <option value="smtp" <?php if($this->config->item("protocol") == "smtp") { echo "selected"; }?>>SMTP</option>
                        <option value="sendmail" <?php if($this->config->item("protocol") == "sendmail") { echo "selected"; }?>>Sendmail</option>
                    </select>
                </div>
            </div>
            <div class="smtp">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Host</label>
                    <div class="col-sm-5">
                        <input id="host" class="form-control required_input" placeholder="Host" value="<?= $host;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-5">
                        <input id="email" class="form-control required_input" placeholder="Email" value="<?= $email;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-5">
                        <input id="password" type="password" class="form-control required_input" placeholder="Password"  value="<?= $password;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Port</label>
                    <div class="col-sm-5">
                        <input id="port" class="form-control required_input" placeholder="Port"  value="<?= $port;?>">
                    </div>
                </div>
            </div>
            <div class="sendmail">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Default Email</label>
                    <div class="col-sm-5">
                        <input id="default_email" class="form-control required_input" placeholder="Default Email" value="<?= $default_email;?>">
                    </div>
                </div>
            </div>
            <hr>
            <h3>Notification</h3>
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-5">
                    <select name="notif_status" id="notif_status" class="form-control">
                        <option value="1">Show</option>
                        <option value="0">Hide</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Position</label>
                <div class="col-sm-5">
                    <select name="notif_position" id="notif_position" class="form-control">
                        <option value="top">Top</option>
                        <option value="bottom">Bottom</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Browser Display</label>
                <div class="col-sm-5">
                    <label class="checkbox-inline"><input type="checkbox" class="notif_browser" name="notif_browser" value="mozilla_firefox">Mozilla Firefox</label>
                    <label class="checkbox-inline"><input type="checkbox" class="notif_browser" name="notif_browser" value="google_chrome">Google Chrome</label>
                    <label class="checkbox-inline"><input type="checkbox" class="notif_browser" name="notif_browser" value="internet_explorer">Internet Explorer</label>
                    <label class="checkbox-inline"><input type="checkbox" class="notif_browser" name="notif_browser" value="safari">Safari</label>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Message</label>
                <div class="col-sm-5">
                    <textarea name="notif_message" rows="5" id="notif_message" class="form-control" placeholder="Enter message">Lorem ipsum dolor sit amet.</textarea>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){

        <?php if($this->config->item("protocol") != "smtp") { ?>
             $(".smtp").hide();
        <?php } ?>

        <?php if($this->config->item("protocol") != "sendmail") { ?>
             $(".sendmail").hide();
        <?php } ?>

        get_data();
    });

    $(document).on('change', '#protocol', function(e){
        var value = $(this).val();
        if(value == "smtp"){
            $(".smtp").show();
            $(".sendmail").hide();
        }

        if(value == "sendmail"){
            $(".smtp").hide();
            $(".sendmail").show();
        }

    });
    $(document).on('click', '#btn_update', function(e){
        $('.error-msg').html('');
        validate_fields();
    });

    function validate_fields(){
        var error_message = 'This field is required.';
        var error_message_link = 'Invalid URL.';

        var FB_url = /^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i;
        var Twitter_url =/^(https?:\/\/)?((w{3}\.)?)twitter\.com\/(#!\/)?[a-z0-9_]+$/i;
        var Instagram_url= /^(https?:\/\/)?((w{3}\.)?)instagram.com\/.*/i;
        var Linkedin_url = /(https?)?:?(\/\/)?(([w]{3}||\w\w)\.)?linkedin.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        var Tumblr_url = /^(https?:\/\/)?((w{3}\.)?)tumblr.com\/.*/i;
        var Pinterest_url = /^(https?:\/\/)?((w{3}\.)?)pinterest.ph\/.*/i;
        var Youtube_url = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
        var facebook = $('.facebook').val();
        var twitter = $('.twitter').val();
        var instagram = $('.instagram').val();
        var linkedin = $('.linkedin').val();
        var tumblr = $('.tumblr').val();
        var pinterest = $('.pinterest').val();
        var youtube = $('.youtube').val();
        var shop_url = $('#shop').val();
        var g_tag_header = $('#gmt_header').val();
        var g_tag_body = $('#gmt_body').val();

        var counter =0;

        if(is_valid_url(shop_url) == false && shop_url.length != 0){
            counter++;
            $('#shop_url_err').html('Invalid URL');
        }

        if (facebook.match(FB_url)) {
            $('#fb_link_err').html('');
        } else {
            if(facebook != ''){
                $('#fb_link_err').html('Please enter valid Facebook URL');
                counter++;
            }
        }

        if (twitter.match(Twitter_url)) {
            $('#twitter_link_err').html('');
        } else {
            if(twitter != ''){
                $('#twitter_link_err').html('Please enter valid Twitter URL');
                counter++;
            }
        }

        if (instagram.match(Instagram_url)) {
            $('#instagram_link_err').html('');
        } else {
            if(instagram != ''){
                $('#instagram_link_err').html('Please enter valid Instagram URL');
                counter++;
            }
        }

        if (linkedin.match(Linkedin_url)) {
            $('#linkedin_link_err').html('');
        } else {
            if(linkedin != ''){
                $('#linkedin_link_err').html('Please enter valid Linkedin URL');
                counter++;
            }
        }

        if (tumblr.match(Tumblr_url)) {
            $('#tumblr_link_err').html('');
        } else {
            if(tumblr != ''){
                $('#tumblr_link_err').html('Please enter valid Tumblr URL');
                counter++;
            }
        }

        if (pinterest.match(Pinterest_url)) {
            $('#pinterest_link_err').html('');
        } else {
            if(tumblr != ''){
                $('#pinterest_link_err').html('Please enter valid Pinterest URL');
                counter++;
            }
        }

        if (youtube.match(Youtube_url)) {
            $('#youtube_link_err').html('');
        } else {
            if(youtube != ''){
                $('#youtube_link_err').html('Please enter valid YouTube URL');
                counter++;
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

    $(document).on('click', '.open_filemanager', function(e){
        var data_id = $(this).attr("data-id");
            modal.file_manager(data_id);
    });

    $(document).on("click", ".btn_insert", function(e){

        var data_identifier = $(this).attr("identifier");
        $(".img_" + data_identifier).remove();
        var image_thumbnail = $('#file_url').val();
        image_thumbnail = image_thumbnail.replace("<?= base_url();?>","");
        
        //add path value to input
        $("#" + data_identifier).val(image_thumbnail);
        //generate preview
        var preview = '<img class="img_'+data_identifier+'" src="<?= base_url();?>'+image_thumbnail+'" width="100%" />';
        $(preview).insertAfter("." + data_identifier);
        
        $(".modal").modal("hide");
        $('.bootbox').modal('hide');
        $("#ckeditor_filemanager_modal").modal("hide");
    });

    var url = "<?= base_url('content_management/global_controller');?>";

    function get_data(){
        
        var data = {
            event : "list", // list, insert, update, delete
            select : "id, title, description, keyword, ga_id, shop_url, favicon, logo, facebook, twitter, instagram, pinterest, linkedin, tumblr, youtube, ga_status, notif_status, notif_position, notif_browser, notif_message,google_tag_manager_header,google_tag_manager_body",
            query : "id = 1", 
            table : "site_information", 
        }

        aJax.post(url,data,function(result){
            var obj = is_json(result);
            var notif_browser = [];
            $.each(obj, function(x,y){
                $('#title').val(y.title);
                $('#description').val(y.description);
                $('#keyword').val(y.keyword);
                $('#ga_id').val(y.ga_id);
                $('#shop').val(y.shop_url);
                $('#facebook').val(y.facebook);
                $('#twitter').val(y.twitter);
                $('#instagram').val(y.instagram);
                $('#pinterest').val(y.pinterest);
                $('#linkedin').val(y.linkedin);
                $('#youtube').val(y.youtube);
                $('#tumblr').val(y.tumblr);

                if(y.ga_status == 1){
                  $('#ga_status').prop('checked', true);
                }

                notif_browser = JSON.parse(y.notif_browser);
                $.each(notif_browser, function(a,b) {
                    $("input[value='"+b.value+"']").prop('checked', true);
                    console.log(b.value);
                });

                $('#notif_status').val(y.notif_status);
                $('#notif_position').val(y.notif_position);
                $('#notif_message').val(y.notif_message);
                $('#gmt_header').val(y.google_tag_manager_header);
                $('#gmt_body').val(y.google_tag_manager_body);
            });
        });

    }

    function update_data(){

        var ga_status = 0;
        if ($('#ga_status').prop('checked')) {
            ga_status = 1;
        }

        modal.confirm("Are you sure you want to update this record?",function(result){
            if(result){
                var data = {
                    event : "update", // list, insert, update, delete
                    table : "site_information", 
                    field : "id", 
                    where : 1,
                    data : 
                        {
                            title : $('#title').val(),
                            description : $('#description').val(),
                            keyword : $('#keyword').val(),
                            ga_id : $('#ga_id').val(),
                            shop_url : $('#shop').val(),
                            favicon : $('#favicon_img').val(),
                            logo : $('#logo_img').val(),
                            facebook : $('#facebook').val(),
                            twitter : $('#twitter').val(),
                            instagram : $('#instagram').val(),
                            pinterest : $('#pinterest').val(),
                            linkedin : $('#linkedin').val(),
                            youtube : $('#youtube').val(),
                            tumblr : $('#tumblr').val(),
                            ga_status : ga_status,
                            notif_status: $('#notif_status').val(),
                            notif_position: $('#notif_position').val(),
                            notif_browser: JSON.stringify($('input[name*="notif_browser"]').serializeArray()),
                            notif_message: $('#notif_message').val(),
                            google_tag_manager_header : $('#gmt_header').val(),
                            google_tag_manager_body : $('#gmt_body').val(),
                            update_date : moment(new Date()).format("YYYY-MM-DD HH:mm:ss")
                        }
                }

                //updating  email config
                var protocol = $("#protocol").val();
                var host = $("#host").val();
                var email = $("#email").val();
                var email_sendmail = $("#default_email").val();
                var password = $("#password").val();
                var port = $("#port").val();
                aJax.post(
                    "<?= base_url("content_management/preference/config_email");?>",
                    {
                        protocol : protocol,
                        host : host,
                        email : email,
                        email_sendmail : email_sendmail,
                        password : password,
                        port : port
                    },
                    function(result){

                    }
                );

                aJax.post(url,data,function(result){
                    modal.alert("Successfully saved.",function(){
                        location.reload();
                    })
                });
            }
        });

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

</script>