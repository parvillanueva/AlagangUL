<script src="https://kit.fontawesome.com/47b29f79cf.js" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script> <!--CAPCHA SAMPLE ONLY-->
<div class="col-md-6 au-padding au-bg">
	<div class="au-bgtrans">
		<div class="au-inner">
			<div class="col-12 au-flexcenter">
				<img src="<?php echo base_url().'assets/img/au-alagangunilab.png'?>" class="au-img-responsive au-signupimg">
			</div>
			<div class="col-12">
				<span class="au-h1">Working towards a healthier Philippines, One community at a time.</span>
				<span class="au-h2">Alagang Unilab is the corporate advocacy movement committed to care for the Filipinos through various community-based healthcare programs.</span>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="row au-fullheight">
		<div class="col-12 au-padding au-flexcenter">
			<div class="au-form-wrapper au-inner">
				<div class="au-form" id="signup">
					<span class="au-h4">Sign up for an Alagang Unilab Account</span>
					<span class="au-p2">You may be missing out a world of opportunity by not being a member. Please provide your email address to register.</span>
					<div class="form-row">
						<div class="col au-iconned">
							<i class="fas fa-lock"></i>		
							<input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required>
							<div class="valid-feedback" id="html_element"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<div class="g-recaptcha" data-callback="recaptcha_callback" data-sitekey="6LdLmtYUAAAAAM_aIZNjKt_k8sZ4bz8XwZkRWedH"></div>
						</div>
					</div>										
					<div class="form-row">
						<div class="col">
							<button class="btn btn-primary au-btnblue mx-auto" style="display: none;" id="btnSend">Send</button>												
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function recaptcha_callback(){
		$('#btnSend').show();
	}
	$(document).on('click', '#btnSend', function(){
		modal.loading(true);
		var email_address = $('#email').val();
		if(email_address != ''){
			var data = {
				email : email_address
			};
			var url = "<?php echo base_url('site/sign_up/email_send') ?>";
			aJax.post(url, data, function(result){
				if(result == 202){
					modal.loading(false);
					location.href = '<?=base_url("site/sign_up/thankyou_message");?>';
				}
			});
		}
	});
</script>