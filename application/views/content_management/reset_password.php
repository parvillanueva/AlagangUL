<?php $this->load->view("content_management/template/header"); 
  $token = $this->uri->segment(4);
  $get_token = 'token = "'.$token.'"';
  $user_token = $this->Global_model->get_list_query('cms_site_token',$get_token);
?>
<body class="hold-transition login-page">
  <div class="container">
    <div class="row vertical-offset-100">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-footer">                                
            <div class="row-fluid user-row"> 
              <button id="btn_close" type="button" class="close pull-right" data-dismiss="alert" aria-hidden="true">×</button>
              <?php if($success){echo "Reset Password";}else{echo $title;} ?>
            </div>
          </div>
          <?php if($success) : ?>
          <div class="panel-body">
            <div accept-charset="UTF-8" role="form" class="form-signin">
              <fieldset>
                <div class="callout" hidden style="margin-bottom: 0px !important;"></div>
                <label>New Password</label>
                <div class="input-group" style="margin-bottom: 5px;">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input id="password1" name="password1" type="password" class="txtlog form-control required new-password" placeholder="New Password">
                </div>
                <label>Confirm Password</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input id="password2" name="password2" type="password" class="txtlog form-control required re-password" placeholder="Confirm Password"/>
                </div>
                  <div class="re-pw-err"></div>
                    <div id="password_chcklist">
                        <p>Password Must:</p>
                        <div class="password_chcklist_contanier">
                            <input type="checkbox"  id="min_ten_chckbx_p" class="min_ten_chckbx password_checkbox required_input hidden"> 
                           <i class="fas fa-check-square min_ten_chck" ></i> <p class="min_ten_chckbx_p"> Minimum of 10 characters</p>
                        </div>
                        <div class="password_chcklist_contanier">
                            <input type="checkbox" id="special_chckbx_p" class="special_chckbx password_checkbox required_input hidden"> 
                          <i class="fas fa-check-square special_chck"></i> <p class="special_chckbx_p">Atleast 1 Special Characters</p>
                        </div>
                        <div class="password_chcklist_contanier">
                            <input type="checkbox" id="upper_chckbx_p" class="upper_chckbx password_checkbox required_input hidden"> 
                          <i class="fas fa-check-square upper_chck"></i> <p class="upper_chckbx_p">Atleast 1 Uppercase</p>
                        </div>
                        <div class="password_chcklist_contanier">
                            <input type="checkbox" id="number_chckbx_p" class="number_chckbx password_checkbox required_input hidden"> 
                          <i class="fas fa-check-square number_chck"></i> <p class="number_chckbx_p">Atleast 1 Number</p>
                        </div>
                     </div>

              </fieldset>                  
            </div>
          </div>
          <div class="panel-footer">                                
            <div class="row-fluid user-row" style="text-align: center;"> 
              <button id="reset_password" href="" class="btn btn-primary reset-password">Submit</button>
            </div>
          </div>
          <?php else : ?>
          <div class="panel-footer">                                
            <div class="row-fluid user-row" style="text-align: center;"> 
              <button id="request_new" href="" class="btn btn-primary request-new">Request New</button>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">

  var user_id = '<?= $user_token[0]->user_id;?>';

  $("#password1").on("change keydown paste input", function(event) { 
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


  $(document).on('click', '#btn_close', function(){
      location.href = "<?= base_url('content_management/login');?>";
  });

  $(document).on('click', '#request_new', function(){
      location.href = "<?= base_url('content_management/login/forgot');?>";
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
          if(!$(this).is(':checked')) {
            counter++;
            $("."+id+"").css('color','red');
          }else{
            $("."+id+"").css('color','#333');
          }
        });


        if(counter == 0){
          modal.loading(true);
          setTimeout(save, 1000)
        }




    });



    function is_exists_historical(user_id, password){
        var query = "user_id = " + user_id + " and password = '"+ sha1(password) +"'";
        var exists = 0;

        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "list", 
            select : "id, user_id, password",
            query : query, 
            table : "cms_historical_passwords"
        }

        aJax.post(url,data,function(result){
            var obj = is_json(result);
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

        var url_save = "<?= base_url("content_management/forgot_password/change_password") ;?>";
        var data = { 
                user_id : <?= $user_id;?>,
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
        if (e.keyCode == 13) {
            $("#reset_password").click();
        }
    });

</script>