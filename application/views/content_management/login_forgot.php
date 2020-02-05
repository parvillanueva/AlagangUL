<?php $this->load->view("content_management/template/header"); ?>
<body class="hold-transition login-page">
  <div class="container">
    <div class="row vertical-offset-100">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-footer">                                
            <div class="row-fluid user-row"> 
              <button id="btn_close" type="button" class="close pull-right" data-dismiss="alert" aria-hidden="true">×</button>
              Forgot Password
            </div>
          </div>
          <div class="panel-body">
            <div accept-charset="UTF-8" role="form" class="form-signin">
              <fieldset>
                <div class="callout callout-warning" hidden style="margin-bottom: 0px !important;"></div>
                <label class="panel-login">
                  <div class="login_result"> Please enter email address </div>
                </label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input id="email" type="email" class="email txtlog form-control" placeholder="Email Address">                                        
                </div>
              </fieldset>                  
            </div>
          </div>
          <div class="panel-footer">                                
            <div class="row-fluid user-row" style="text-align: center;"> 
              <button id="reset_password" href="" class="btn btn-primary reset-password">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">

    $(document).on('click', '#btn_close', function(){
        location.href = "<?= base_url('content_management/login');?>";
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
        var url = "<?=base_url();?>content_management/forgot_password/send_email";
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
        var url = "<?=base_url();?>content_management/forgot_password/check_email";
        var data = { 
            email : email 
        }

        aJax.post(url,data,function(result){
            count = result;
        });

        return count;
    }
  
</script>