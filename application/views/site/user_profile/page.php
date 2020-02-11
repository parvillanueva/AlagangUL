<div class="col-md-6 au-padding au-bg">
	<div class="au-bgtrans">
		<div class="au-inner">
			<div class="col-12 au-flexcenter">
				<img src="<?php echo base_url('assets/img/au-alagangunilab.png'); ?>" class="au-img-responsive au-signupimg">
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
				<form action="<?= base_url('submit'); ?>" method="post" enctype="multipart/form-data" class="au-form" id="signups">
					<span class="au-h4">Sign Up</span>
					<span class="au-p2">Create your account by filling out the form below.</span>

					<div class="form-row">
						<div class="col">
							<input type="text" class="form-control required_input no_html" id="fname" placeholder="First Name" name="fname">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" placeholder="Last Name" name="lname">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<select class="form-control custom-select required_input" >
									<option value="" selected disabled>Division / Business Unit</option>
								<?php foreach($division as $div_lop){ ?>
									<option value="<?php echo $div_lop->id; ?>"><?php echo $div_lop->name; ?></option>
								<?php } ?>
							</select>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
						<div class="col">											
							<input type="text" class="form-control required_input email" id="email" placeholder="Work Email" name="email" value="<?= $data_set[0]->email_address?>">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<input type="text" class="form-control required_input mobile_number" id="phone" placeholder="Mobile Number" name="phone"">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
						<div class="col">											
							<input type="text" class="form-control" id="local" placeholder="Work Number" name="local" pattern="[0-9]{9}">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<input type="password" class="form-control required_input new-password" id="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z]).{8,}">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback" id="invalid_pass">Password does not meet requirements</div>
						</div>
						<div class="col">											
							<input type="password" class="form-control required_input re-password" id="cpassword" placeholder="Confirm Password" name="cpassword">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback" id="invalid_confirm">Passwords do not match.</div>
						</div>
						<div class="col-12">
							<span class="au-p3">Use 8 or more characters with a mix of letters, numbers & symbols for a strong password.</span>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input required_input" name="file_set" id="customFile" accept="image/x-png,image/gif,image/jpeg" />
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label class="form-check-label">
								<input class="form-check-input required_input" type="checkbox" name="terms"> I have read and understood the <a href="#" class="au-lnk">Terms of Use</a> and <a href="#" class="au-lnk">Privacy Statement</a>.
								<div class="valid-feedback"></div>
								<div class="invalid-feedback"></div>
							</label>
						</div>
					</div>    								
					<div class="form-row">
						<div class="col">
							<button class="btn btn-primary au-btnblue float-right" id="btnSubmit">Create Account</button>
						</div>
					</div>
				</form>
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
		if(validate.standard("signups")){
			var password = $('#password').val();
			var pass_check = checkPasswordStrength(password);
			if(pass_check){
				$("#signups").submit();
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