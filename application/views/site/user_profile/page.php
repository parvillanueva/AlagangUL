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
				<form class="au-form" id="signup">
					<span class="au-h4">Sign Up</span>
					<span class="au-p2">Create your account by filling out the form below.</span>

					<div class="form-row">
						<div class="col">
							<input type="text" class="form-control input_required" id="fname" placeholder="First Name" name="fname" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
						<div class="col">											
							<input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<select class="form-control custom-select" >
								<option value="" selected disabled>Division / Business Unit</option>
								<option value="sample">Sample</option>
							</select>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
						<div class="col">											
							<input type="email" class="form-control" id="email" placeholder="Work Email" name="email" required value="johndoe@unilab.com.ph" disabled>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<input type="tel" class="form-control" id="phone" placeholder="Mobile Number" name="phone" required">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
						<div class="col">											
							<input type="tel" class="form-control" id="local" placeholder="Work Number" name="local" pattern="[0-9]{9}">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<input type="password" class="form-control" id="password" placeholder="Password" name="password" required pattern="(?=.*\d)(?=.*[a-z]).{8,}">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Password does not meet requirements</div>
						</div>
						<div class="col">											
							<input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Passwords do not match.</div>
						</div>
						<div class="col-12">
							<span class="au-p3">Use 8 or more characters with a mix of letters, numbers & symbols for a strong password.</span>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox" name="terms" required> I have read and understood the <a href="#" class="au-lnk">Terms of Use</a> and <a href="#" class="au-lnk">Privacy Statement</a>.
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
	});
	
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	$(document).on('click', '#btnSubmit', function(){
		
		if(validate.standard("signup")){
			
		}
		/* var lastname = $('#user_lastname').val();
		var firstname = $('#user_firstname').val();
		var gender = $('#user_gender').val();
		var birthday = $('#user_birthday').val();
		var mobile = $('#user_mobile').val();
		var password = $('#password').val();
		var con_password = $('#confirm_password').val();
		var file_data = $('#user_image').prop('files')[0];  
		if(lastname != '' && firstname != '' && gender != '' && birthday != '' && mobile != '' && password != '' && con_password != ''){
			
		} else{
			var form = $("#signup");

			if (form[0].checkValidity() === false) {
				event.preventDefault()
				event.stopPropagation()
			}

			form.addClass('was-validated');
		} */
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