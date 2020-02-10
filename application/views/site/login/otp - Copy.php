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
									<div class="login-sub-title">OTP INPUT</div>
									<div class="alert alert_failed alert-warning">
									  	Incorrect OTP!
									</div>
									<form class="login-form">
											<?php
									            $inputs = [
									                'user_otp'
									            ];
									            $id = $this->standard->inputs($inputs);
									        ?>
									        <div class="text-right">
												<a href="#" class="btn btn-login text-right hoverable" id="submit_otp">Submit</a>
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
			$(".alert_failed").hide();
        	$(document).on("click","#submit_otp", function(x){
        		x.preventDefault();	
				$(".alert_failed").hide();
        		if(validate.standard("<?= $id; ?>")){
        			modal.loading(true);
        			var url = '<?php echo base_url()."login_otp/otp_check" ?>';
        			var data = {
        				otp_code : $("#user_otp").val(),
						token : "<?php echo $_GET['token'] ?>"
        			}
        			aJax.post(url, data, function(result){
						var obj = is_json(result);
						if(obj.responce == 'success'){
							modal.loading(false);
							window.location.href = "<?php echo base_url().'site/user/view/' ?>"+obj.user_id;
						} else{
							$(".alert_failed").show();
							modal.loading(false);
						}
        			});
        		}
        	});
			
			$("#user_otp").on('keyup', function (e) {
				if (e.keyCode == 13) {
					$('#submit_otp').click();
				}
			});
        </script>
    </body>
</html>