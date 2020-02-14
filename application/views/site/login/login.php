<style type="text/css">
	.login-form .form-control {
     	margin-bottom: 0px !important; 
	}

</style>

<?php $this->load->view("site/login_layout/header"); ?>    
<body>
	<header class="au-header">
		<div class="au-navigation au-container">
			<nav class="au-navbar navbar navbar-expand-lg">
				<div>
					<!-- <button type="button" class="au-navbar-toggler navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
						<img src="assets/img/au-menu.svg" width="28px" height="28px">
					</button> -->
				</div>
				<a href="<?= base_url();?>" class="au-navbar-brand navbar-brand">
					<img src="<?php echo base_url().'assets/img/au-logo.png'?>" alt="Alagang Unilab Logo" class="au-logo">
				</a>
				<div class="d-lg-none">
					<!-- <img src="assets/img/au-avatar.svg" class="au-avatar"> -->
				</div>

				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="au-navbar-nav navbar-nav ml-auto flex-column-reverse flex-lg-row">
					</div>
				</div>
			</nav>
		</div>
	</header>

	<div class="au-wrapper">
		<div class="container-fluid au-heading au-wrapper au-flexcenter">
			<div class="au-container au-padding">
				<div class="row au-userbox au-fullheight">					
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
									<form action="index.html" class="au-form" id="login">
										<span class="au-h4">Login</span>
										<span class="au-h4" id="failed_label"><font color="red"><small>Incorrect username and password. Please try again.</small></font></span>
										<div class="form-row">
											<div class="col au-iconned">
												<i class="fas fa-envelope"></i>
												<input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required>
												<div class="valid-feedback"></div>
	    										<div class="invalid-feedback">Please fill out this field.</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col au-iconned">		
												<i class="fas fa-lock"></i>									
												<input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
												<div class="valid-feedback"></div>
	    										<div class="invalid-feedback">Please fill out this field.</div>
											</div>
										</div>			    						
										<div class="form-row">    							
											<div class="col-md-6">	
												<div class="form-row">
													<div class="col">
														<label class="form-check-label">
						        							<input class="form-check-input" type="checkbox" name="remember"> Remember me
						      							</label>
													</div>
												</div>
											</div>
											<div class="col-md-6">					
												<div class="form-row">
													<div class="col text-right">
														<a href="#" class="au-lnk" id="forgot_password">Forgot password?</a>
													</div>
												</div>
											</div>
										</div>	
										<div class="form-row">
											<div class="col text">	
				      							<button type="button" class="btn btn-primary au-btnblue mx-auto" id="btnSubmit">Login</button>
				      						</div>
			    						</div>								
									</form>
									<hr>
									<a href="#"><button type="submit" class="au-btnblue mx-auto font-italic" id="not_register">Not yet registered? Sign up now!</button></a>
								</div>
								

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view("site/login_layout/footer"); ?>
    <script type="text/javascript">
			$(document).ready(function() {
				responsive();
				$('#failed_label').hide();
			});
        	$(document).on("click","#btnSubmit", function(x){
        		x.preventDefault();	
				var user_name = $("#email").val();
				var password = $("#password").val();
        		if(user_name != '' && password != ''){
        			modal.loading(true);
        			var url = '<?php echo base_url()."site/login/login_register" ?>';
        			var data = {
        				email_address : user_name,
        				password : password
        			}
        			aJax.post(url, data, function(result){
						var obj = is_json(result);
						if(obj.responce == 'failed'){
							$('#failed_label').show();
							modal.loading(false);
						} else{
							modal.loading(false);
							location.href = '<?=base_url();?>';	
						}
        			});
        		} else{
					var form = $("#login")
					if (form[0].checkValidity() === false) {
						event.preventDefault()
						event.stopPropagation()
					}
					form.addClass('was-validated');
				}
        	});
			
			$(document).on('click', '#not_register', function(){
				location.href = '<?=base_url("signup");?>';
			});
			
			$(document).on('click', '#forgot_password', function(){
				location.href = '<?=base_url("forgot_password");?>';
			});
			
			$("#password, #email").on('keyup', function (e) {
				if (e.keyCode == 13) {
					$('#btnSubmit').click();
				}
			}); 
			
			$(".custom-file-input").on("change", function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
			});
			
			$("#btnSend").click(function(event) {
				var form = $("#signup")

				if (form[0].checkValidity() === false) {
					event.preventDefault()
					event.stopPropagation()
				}
				form.addClass('was-validated');
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
    </body>
</html>