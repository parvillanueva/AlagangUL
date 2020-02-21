<div class="col-md-6 au-padding au-bg">
	<div class="au-bgtrans">
		<div class="au-inner">
			<div class="col-12 au-flexcenter">
				<img src="<?php echo base_url('assets/img/au-alagangunilab.png'); ?>" class="au-img-responsive au-signupimg">
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
				<form action="<?= base_url('submit'); ?>" method="post" enctype="multipart/form-data" class="au-form" id="signups">
					<span class="au-h4">Sign Up</span>
					<span class="au-p2">Create your account by filling out the form below.</span>

					<div class="form-row">
						<div class="col">
							<input type="text" class="form-control required_input no_html alphaonly" id="fname" placeholder="* First Name" name="fname">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
						<div class="col">											
							<input type="text" class="form-control required_input no_html alphaonly" id="lname" placeholder="* Last Name" name="lname">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<select class="form-control custom-select required_input" id="division" name="division" required="required" />
									<option value="" selected disabled>* Division / Business Unit</option>
								<?php foreach($division as $div_lop){ ?>
									<option value="<?php echo $div_lop->id; ?>"><?php echo $div_lop->name; ?></option>
								<?php } ?>
							</select>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
						<div class="col">											
							<input type="text" class="form-control required_input email" id="email" placeholder="* Work Email" name="email_add" value="<?=$this->session->userdata('email_address');?>">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<!--<div class="col">
							<input type="text" class="form-control required_input" id="phone" placeholder="* Mobile Number" name="phone" maxlength="11" pattern="[0-9]{9}">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>-->
						<div class="col">											
							<input type="text" class="form-control not_required mobile_number_not" id="work_number" placeholder="Mobile Number" name="work_number" maxlength="11" pattern="[0-9]{9}">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<input type="password" class="form-control required_input new-password" id="password" placeholder="* Password" name="password" pattern="(?=.*\d)(?=.*[a-z]).{8,}">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback" id="invalid_pass">Password does not meet requirements</div>
						</div>
						<div class="col">											
							<input type="password" class="form-control required_input re-password" id="cpassword" placeholder="* Confirm Password" name="cpassword">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback" id="invalid_confirm">Password do not match.</div>
						</div>
						<div class="col-12">
							<span class="au-p3">Use 8 or more characters with a mix of letters, numbers & symbols for a strong password.</span>
						</div>
					</div>
					<div class="form-row">
						<div class="col-12">
							<span class="au-p3">Upload profile picture</span>
						</div>
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="file_set" id="customFile" accept="image/x-png,image/jpeg" />
								<label class="custom-file-label" for="customFile">* Choose file</label>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label class="form-check-label">
								<input class="form-check-input required_input" required="required" id="understood_details" type="checkbox" name="terms"> I have read and understood the <a href="<?= base_url("terms-and-conditions");?>" class="au-lnk">Terms of Use</a> and <a href="<?= base_url("privacy-statement");?>" class="au-lnk">Privacy Statement</a>.
								<div class="alert_understood"><font color="red">This field is required.</font></div>
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
		$('.alert_understood').hide();
		$("#work_number").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
		$("#work_number").keyup(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
	});
	
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	$(document).on('click', '#btnSubmit', function(e){
		e.preventDefault();
		/* var phone_val = $("#phone").val();
		if(phone_val == ''){
			$("#phone").addClass('required_input');
		} else{
			$("#phone").addClass('mobile_number');
		} */
		var password = $('#password').val();
		var pass_check = checkPasswordStrength(password);
		if(validate.standard("signups")){
			var password = $('#password').val();
			var pass_check = checkPasswordStrength(password);
			if(pass_check){
				var division = $('#division').val();
				if(division != null){
					if($('#understood_details').is(":checked")){
						BM.loading(true);
						$("#signups").submit();
					} else{
						$('.alert_understood').show();
					}
				}
			}
		}
	});

	$(window).resize(function() {
		responsive();
	});
	
	function checkPasswordStrength(password) {
		$('#invalid_pass').hide();
		$('#invalid_confirm').hide();
		var number = /([0-9])/;
		var alphabets = /([a-zA-Z])/;
		var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
		var confirm_pass = $('#cpassword').val();
		if(password.trim() != ''){
			if (password.length < 8) {
				$('#invalid_pass').show();
				confirm_password(password, confirm_pass);
				//return false;
			} else {
				if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
					$('#invalid_pass').hide();
					if(confirm_password(password, confirm_pass)){
						$('#invalid_pass').hide();
						return true;
					} else{
						$('#invalid_pass').show();
						return false;
					}
					
				} else {
					$('#invalid_pass').show();
					confirm_password(password, confirm_pass);
					//return false;
				}
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