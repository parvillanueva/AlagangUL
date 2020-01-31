<style type="text/css">
	.login-form .form-control {
     	margin-bottom: 0px !important; 
	}

</style>

<?php $this->load->view("login_layout/header"); ?>    
    <body class="login-body">
        <div class="parent">
			<div class="child">
				<div class="login-container">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12 left-login-wrapper">
								<div class="left-login-container">
									<div class="login-sub-title">Login to your Account</div>
									<div class="alert alert_failed alert-warning">
									  	Permission Failed! Please try again.
									</div>
									<div class="alert alert_false alert-warning">
									  	Login Failed! Please try again.
									</div>
									<form class="login-form">
											<?php
									            $inputs = [
									                'ad_user',
									                'password'
									            ];

									            $id = $this->standard->inputs($inputs);
									        ?>
									        <div class="text-right">
												<a href="#" class="btn btn-login text-right hoverable" id="ad_login">Login</a>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


        <script type="text/javascript">
        	$(".alert_false").hide();
			$(".alert_failed").hide();
        	$(document).on("click","#ad_login", function(x){
        		x.preventDefault();	
        		$(".alert_false").hide();
				$(".alert_failed").hide();
        		if(validate.standard("<?= $id; ?>")){
        			modal.loading(true);
        			var url = '<?php echo base_url()."api/users?token=".$token ?>';
        			var data = {
						CMDEvent: 'authenticate',
        				email_address : $("#ad_user").val(),
        				password : $("#password").val()
        			}
					
        			aJax.post(url, data, function(result){
						var result_code = result.Code;
						switch(result_code){
							case 202:
								var url_login = '<?php echo base_url()."login/session_set" ?>';
								var data_login = {
									email : $("#ad_user").val(),
								};
								aJax.post(url_login, data_login, function(result_set){
									if(result_set){
										location.href = '<?=base_url("user");?>';
										modal.loading(false);
									}
								});
							break;
							case 508:
								$(".alert_false").show();
								modal.loading(false);
							break;
						}
        			});
        		}
        	});
			
			$("#password, #email_address").on('keyup', function (e) {
				if (e.keyCode == 13) {
					$('#ad_login').click();
				}
			});
        </script>
    </body>
</html>