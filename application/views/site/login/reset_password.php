<div class="col-md-6 au-padding au-bg">
	<div class="au-bgtrans">
		<div class="au-inner">
			<div class="col-12 au-flexcenter">
				<img src="<?php echo base_url('assets/img/au-alagangunilab.png');?>" class="au-img-responsive au-signupimg">
			</div>
			<div class="col-12">
				<!-- <span class="au-h1">Mula sa simula, hanggang sa pagtanda, may Alagang Unilab.</span> -->
				<span class="au-h2"><b>Alagang Unilab</b> is the United Health Group’s banner advocacy program committed to make primary healthcare accessible to communities.  Grounded on bayanihan, we work closely with partners and volunteers to ensure sustainability and impact.</span>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="row au-fullheight">
		<div class="col-12 au-padding au-flexcenter">
			<div class="au-form-wrapper au-inner">
				<div class="au-form" id="reset_password">
					<span class="au-h4">Change your password</span>
					<span class="au-p2">Use 8 or more characters with a mix of letters, numbers & symbols for a strong password.</span>			
					<div class="form-row">
						<div class="col">
							<input type="password" class="form-control required_input" id="password" placeholder="New Password" name="password" required pattern="(?=.*\d)(?=.*[a-z]).{8,}">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback" id="invalid_pass">Password does not meet requirements</div>
						</div>
					</div>		
					<div class="form-row">
						<div class="col">											
							<input type="password" class="form-control required_input" id="cpassword" placeholder="Confirm Password" name="cpassword" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback" id="invalid_confirm">Passwords do not match.</div>
						</div>
					</div>	    						
					<div class="form-row">    							
						<div class="col">
							<button type="submit" class="btn btn-primary au-btnblue mx-auto" id="btnSubmit">Reset my Password</button>
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
		$('#email').attr('readonly', true);
	});
	
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	$(document).on('click', '#btnSubmit', function(e){
		e.preventDefault();
		if(validate.standard("reset_password")){
			var password = $('#password').val();
			var pass_check = checkPasswordStrength(password);
			if(pass_check){
				var data = {
					user_id : "<?php echo $user_id ?>",
					password : password
				};
				var url = "<?php echo base_url('site/login/update_password') ?>";
				aJax.post(url, data, function(result){
					var obj = is_json(result);
					if(obj.responce == 'success'){
						window.location.href = "<?= base_url('change_pfw_message') ?>";
					}
				});
			}
		}
	});

	$(window).resize(function() {
		responsive();
	});
	
	function checkPasswordStrength(password) {
		var number = /([0-9])/;
		var alphabets = /([a-zA-Z])/;
		var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
		var confirm_pass = $('#cpassword').val();
		if (password.length < 8) {
			$('#invalid_pass').show();
			confirm_password(password, confirm_pass);
			return false;
		} else {
			if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
				if(confirm_password(password, confirm_pass)){
					return true;
				} else{
					return false;
				}
				
			} else {
				$('#invalid_pass').show();
				confirm_password(password, confirm_pass);
				return false;
			}
		}
	}
	
	function confirm_password(pass, confirm){
		if(pass == confirm){
			return true;
		} else{
			$('#invalid_confirm').show();
			return false;
		}
	}

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