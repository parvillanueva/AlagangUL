<script src="https://www.google.com/recaptcha/api.js" async defer></script> <!--CAPCHA SAMPLE ONLY-->
<div class="col-md-6 au-padding au-bg">
	<div class="au-bgtrans">
		<div class="au-inner">
			<div class="col-12 au-flexcenter">
				<img src="<?php echo base_url('assets/img/au-alagangunilab.png')?>" class="au-img-responsive au-signupimg">
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
				<div class="au-form" id="form_forgot_pass">
					<span class="au-h4">Forgot your password?</span>
					<small><span class="au-h5" id="email_alert"><font color="red">Email address doesn't exist!<font></span></small>
					<span class="au-p2">Please enter your email address. You will receive a  link to create a new password via email.</span>
					<div class="form-row">
						<div class="col au-iconned">
							<i class="fas fa-lock"></i>		
							<input type="email" class="form-control required_input email" id="email" placeholder="Email Address" name="email" required>
							<div class="valid-feedback"></div>
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
							<button class="btn btn-primary au-btnblue mx-auto" style="display: none;" id="btnSubmit">Reset my Password</button>
						</div>
					</div>									
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		responsive();
		$('#email_alert').hide();
	});
	
	function recaptcha_callback(){
		$('#btnSubmit').show();
	}
	
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	$(document).on('click', '#btnSubmit', function(e){
		e.preventDefault();
		if(validate.standard("form_forgot_pass")){
			var email = $('#email').val();
			var url = "<?php echo base_url('site/sign_up/email_check_fpw') ?>";
			var data = {
				email : email
			};
			aJax.post(url, data, function(result){
				if(result == 202){
					BM.loading(true);
					location.href = '<?=base_url("login_otp_fpw");?>';
				} else{
					//modal.loading(false);
					$('#email_alert').show();
				}
			});
		}
	});

	$(window).resize(function() {
		responsive();
	});

	function responsive() {
		//minimum height for hero banner
		var maxHeight = -1;
		$('.au-hero-container .carousel-item').each(function() {
			if ($(this).outerHeight(true) > maxHeight) {
				maxHeight = $(this).outerHeight(true) + 64;
			}
		});
		$('.au-hero-bg').css("min-height", maxHeight);

		var headerheight = $('.au-header').outerHeight(true);;
		var footerheight = $('.au-footer').outerHeight(true);

		//full height hero banner
		$(".au-hero-bg").css("height", "calc(100vh - " + headerheight + "px)");
		$(".au-wrapper").css("min-height", "calc(100vh - " + (headerheight + footerheight) + "px)");
	}
</script>