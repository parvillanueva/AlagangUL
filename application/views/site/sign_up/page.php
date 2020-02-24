<script src="https://www.google.com/recaptcha/api.js" async defer></script> <!--CAPCHA SAMPLE ONLY-->
<div class="col-md-6 au-padding au-bg">
	<div class="au-bgtrans">
		<div class="au-inner">
			<div class="col-12 au-flexcenter">
				<img src="<?php echo base_url().'assets/img/au-alagangunilab.png'?>" class="au-img-responsive au-signupimg">
			</div>
			<div class="col-12">
				<span class="au-h1">&nbsp;</span>
				<span class="au-h2"><b>Alagang Unilab</b> is the United Health Group’s banner advocacy program committed to make primary healthcare accessible to communities.  Grounded on bayanihan, we work closely with partners and volunteers to ensure sustainability and impact.</span>
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
					<div class="alert alert_failed alert-warning" id="failed_label">Email Address already exists! </div>
					<div class="alert alert_failed alert-warning" id="failed_valid">Valid Email Address must be Entered! </div>
					<div class="alert alert_failed alert-warning" id="failed_list"><small>Please use unilab email address! </div>
					<span class="au-p2">You may be missing out a world of opportunity by not being a member. Please provide your email address to register.</span>
					<div class="form-row">
						<div class="col au-iconned">
							<i class="fas fa-lock"></i>		
							<input type="email" class="form-control email" id="email" placeholder="Work Email" name="email" required>
							<div class="valid-feedback" id="html_element"></div>
							<div class="invalid-feedback error_message">Please fill out this field.</div>
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
	$(document).ready(function(){
		$('#failed_label').hide();
		$('#failed_list').hide();
		$('#failed_valid').hide();
	});
	function recaptcha_callback(){
		$('#btnSend').show();
	}
	$(document).on('click', '#btnSend', function(){
		//modal.loading(true);
		var email_address = $('#email').val();
		var email_validate = email_validates(email_address);
		if(email_validate){
			$('#failed_valid').hide();
			if(email_address != ''){
				var data = {
					email : email_address
				};
				var url = "<?php echo base_url('site/sign_up/email_send') ?>";
				aJax.post(url, data, function(result){	
					var obj = is_json(result);	
					if(obj.responce == 'exist'){
						$('#failed_label').show();
					} else if(obj.responce == 'no_list'){
						$('#failed_list').show();
					} else if(obj.responce == 'pass_empty'){
						//location.href = '<?=base_url("user_profile");?>';
					} else{
						 if(obj.result_sgrid == 202){
							 console.log('doms');
							BM.loading(true);
							location.href = '<?=base_url("login_otp");?>';
						} 
					}
				});
			} else{
				$('.error_message').show();
			}
		}
	});
	
	function email_validates(email){
		var counter = 0;
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		//console.log(pattern.test(email));
		if(!pattern.test(email)){
		counter++;
			$('#failed_valid').show();
			return false;
		} else{
			return true;
		}
	}	
</script>