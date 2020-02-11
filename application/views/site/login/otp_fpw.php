<div class="col-md-6 au-padding au-bg">
	<div class="au-bgtrans">
		<div class="au-inner">
			<div class="col-12 au-flexcenter">
				<img src="assets/img/au-alagangunilab.png" class="au-img-responsive au-signupimg">
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
				<div class="au-form" id="otp">
					<span class="au-h4">Input One-Time Password</span>
					<div class="alert alert_failed alert-warning">Incorrect OTP!</div>
					<span class="au-p2">Please input the one-time-password that has been sent to your email address. If you arrived here by mistake, <a href="<?= base_url("log-in") ;?>" class="au-lnk">click here</a> to go back to Login page.</span>
					<div class="form-row">
						<div class="col">
							<input type="text" class="form-control au-otp" id="otp1" name="otp" required pattern="[0-9]{1}" maxlength="1" 
							onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)">
						</div>
						<div class="col">
							<input type="text" class="form-control au-otp" id="otp2" name="otp" required pattern="[0-9]{1}" maxlength="1"
							onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)">
						</div>
						<div class="col">
							<input type="text" class="form-control au-otp" id="otp3" name="otp" required pattern="[0-9]{1}" maxlength="1"
							onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)">
						</div>
						<div class="col">
							<input type="text" class="form-control au-otp" id="otp4" name="otp" required pattern="[0-9]{1}" maxlength="1"
							onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)">
						</div>
						<div class="col">
							<input type="text" class="form-control au-otp" id="otp5" name="otp" required pattern="[0-9]{1}" maxlength="1"
							onkeyup="onKeyUpEvent(5, event)" onfocus="onFocusEvent(5)">
						</div>
						<div class="col">
							<input type="text" class="form-control au-otp" id="otp6" name="otp" required pattern="[0-9]{1}" maxlength="1"
							onkeyup="onKeyUpEvent(6, event)" onfocus="onFocusEvent(6)">
						</div>
						<div class="valid-feedback"></div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>									
					<div class="form-row">
						<div class="col">
							<button class="btn btn-primary au-btnblue mx-auto" id="btnSubmit">Submit</button>
						</div>
					</div>									
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".alert_failed").hide();
	});
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	$(document).on('click', '#btnSubmit', function(){
		var otp1 = $('#otp1').val();
		var otp2 = $('#otp2').val();
		var otp3 = $('#otp3').val();
		var otp4 = $('#otp4').val();
		var otp5 = $('#otp5').val();
		var otp6 = $('#otp6').val();
		if(otp1 != '' && otp2 != '' && otp3 != '' && otp4 != '' && otp5 != '' && otp6 != ''){
			var url = "<?php echo base_url('site/login_otp/otp_check_fpw') ?>"; 
			var data = {
				otp_code : otp1+otp2+otp3+otp4+otp5+otp6,
				token : "<?php echo $_SESSION['token']?>"
			};
			aJax.post(url, data, function(result){
				var obj = is_json(result);
				if(obj.responce == 'success'){
					modal.loading(false);
					window.location.href = "<?php echo base_url().'reset_password/' ?>"+obj.user_id;
				} else{
					$(".alert_failed").show();
					modal.loading(false);
				}
			});
		} else{
			var form = $("#otp");
			if (form[0].checkValidity() === false) {
				event.preventDefault()
				event.stopPropagation()
			}
			form.addClass('was-validated');
		}
	});

	//for otp function
	function getCodeBoxElement(index) {
		return document.getElementById('otp' + index);
	}

	function onKeyUpEvent(index, event) {
		const eventCode = event.which || event.keyCode;
		if (getCodeBoxElement(index).value.length === 1) {
			if (index !== 6) {
				getCodeBoxElement(index + 1).focus();
			} else {
				getCodeBoxElement(index).blur();
				// Submit code
			}
		}
		if (eventCode === 8 && index !== 1) {
			getCodeBoxElement(index - 1).focus();
		}
	}

	function onFocusEvent(index) {
		for (item = 1; item < index; item++) {
			const currentElement = getCodeBoxElement(item);
			if (!currentElement.value) {
				currentElement.focus();
				break;
			}
		}
	}
</script>