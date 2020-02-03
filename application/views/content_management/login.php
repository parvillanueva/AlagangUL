<?php $this->load->view("content_management/template/header"); ?>
<?php
    $details = $this->load->details("site_information",1);
    $details_cms = $this->load->details("cms_preference",1);
    $account_type = ($details_cms[0]->ad_authentication == 1) ? 'Email' : 'Username';
    $previous_user_email = $this->session->flashdata('previous_user_email');
?>
<body class="hold-transition login-page">
  <div class="container">
    <div class="row vertical-offset-100">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-footer">                                
            <div class="row-fluid user-row"> 
              Content Management
            </div>
          </div>
          <div class="panel-body">
            <div class="logo text-center">
              <?php if(isset($details[0]->logo) == '') {
               ?>
                <img class="cms-logo" src="<?=base_url().$details[0]->logo;?>" alt="logo" style="    display: none;">
              <?php } else { ?>
                  <img class="cms-logo" src="<?=base_url().$details[0]->logo;?>" alt="logo">
              <?php }
               ?>
            </div>

            <div accept-charset="UTF-8" role="form" class="form-signin">
              <fieldset>
                <div class="callout callout-warning" hidden style="margin-bottom: 0px !important;"></div>
                <div class="callout callout-success logout-success" style="margin-bottom: 0px !important; display: none;"></div>
                <label class="panel-login">
                  <div class="login_result"></div>
                </label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input id="username" type="text" class="username txtlog form-control" name="username" type="text" placeholder="<?=$account_type;?>" value="<?=$previous_user_email;?>">                                        
                </div>
                <br>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="password" type="password" class="password txtlog form-control" name="password" placeholder="Password">
                </div>   
                <br>
<!--                 <input id="btn_login"  class="btn btn-md btn-info btnblog btn-block" type="button" value="Login »"> -->
                <button id="btn_login" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading" class="btn btn-md btn-info btnblog btn-block" type="button">Login »</button>
              </fieldset>                  
            </div>
          </div>
          <div class="panel-footer">                                
            <div class="row-fluid user-row" style="text-align: center;"> 
              <a id="reset_password" href="" class="reset-password" data-toggle="modal">Forgot Password</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">

  var logout_data = '<?= $logout_data ?>';


   $(document).ready(function(){
      if(logout_data != ''){
        $('.logout-success').html(logout_data);
        $('.logout-success').show();
      }
   });

  $(document).on('click', '#btn_login', function() {

    //button loader
    var spinner_btn = $(this);
    spinner_btn.button('loading');

    //checks if ad authentication is enabled
    var is_ad = "<?=$details_cms[0]->ad_authentication;?>";
    var ad_status = (is_ad == 1) ? ad_authentication() : 'disabled';

    setTimeout(function() {
        $('.callout').hide();
        var url = "<?=base_url('content_management/login/validate_log');?>";
        var data = {
          username: $('.username').val(), 
          password: $('.password').val(),
          ad_status: ad_status
        } 
        aJax.post(url,data,function(result){
          var obj = is_json(result);
          var result_count = obj.count;

           if(result_count == 0 || result_count == 1 || $('.username').val() == '' || $('.password').val() == '') {

              var encoded_username = document.getElementById("username");
              var encoded_password = document.getElementById("password");

              if ($('.username').val() == '' || $('.password').val() == '') {
 
                var callout_message = '';

                if ($('.username').val() == '') {
                  callout_message += 'Username is required. ';
                  encoded_username.style.border = "thin solid red";
                } else {
                  encoded_username.removeAttribute("style");
                }

                if ($('.password').val() == '') {
                  callout_message += 'Password is required.';
                  encoded_password.style.border = "thin solid red";
                } else {
                  encoded_password.removeAttribute("style");
                }

                $('.callout-warning').html(callout_message);

              } else if (result_count == 0 || result_count == 1 ) {
                encoded_username.style.border = "thin solid red";
                encoded_password.style.border = "thin solid red";
                $('.callout-warning').html("Login Failed: Incorrect username or password. "+obj.message+"");
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
              location.href = '<?=base_url("content_management/home");?>';
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
            console.log('result count: '+result_count);
            console.log('message: '+obj.message);
        });
        spinner_btn.button('reset');
      }, 300);

  });



  $(document).on("keypress", "#username, #password", function(e) {                          
      if (e.keyCode == 13) {
          $("#btn_login").click();
      }
  });

  $(document).on("click", "#reset_password", function(){
    location.href = "<?= base_url('content_management/login/forgot');?>";
  });

  function ad_authentication(){
    var url = "<?= base_url('azure/pwgrant.php'); ?>"
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

</script>