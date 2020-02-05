<header class="au-header">
		<div class="au-navigation au-container">
			<nav class="au-navbar navbar navbar-expand-lg">
				<button type="button" class="au-navbar-toggler navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
					<img src="<?=base_url()?>assets/site/img/au-menu.svg" width="28px" height="28px">
				</button>
				<a href="home" class="au-navbar-brand navbar-brand">
					<img src="<?=base_url()?>assets/site/img/au-logo.png" alt="Alagang Unilab Logo" class="au-logo">
				</a>
				<div class="d-lg-none">
					<img src="<?=base_url()?>assets/site/img/au-avatar.svg" class="au-avatar">
				</div>

				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="au-navbar-nav navbar-nav ml-auto flex-column-reverse flex-lg-row">
						<div class="au-menu">
							<a id="home" href="<?= base_url();?>" class="nav-item nav-link">Home</a>
							<a id="about" href="<?= base_url("about");?>" class="nav-item nav-link">About</a>
							<a id="programs"  href="<?= base_url("programs");?>" class="nav-item nav-link">Programs</a>
							<a id="events"  href="<?= base_url("events");?>" class="nav-item nav-link">Events</a>
							<a id="get_rewards"  href="<?= base_url("get-rewards");?>" class="nav-item nav-link">Get Rewards</a>

							<div class="d-lg-none">								
								<a href="#" class="nav-item nav-link">Sign In</a><!-- show this when logged out -->
								<a href="#" class="nav-item nav-link">Sign Up</a><!-- show this when logged out -->
								<a href="#" class="nav-item nav-link">Account Settings</a><!-- show this when logged in -->
								<a href="#" class="nav-item nav-link">Logout</a><!-- show this when logged in -->
							</div>
						</div>
						<div class="au-user">
							<!-- show this when logged out -->
							<!-- <div class="d-none d-lg-block au-login">
								<a href="#"><button class="au-btn">Login</button></a>
								<a href="#"><button class="au-btn">Sign Up</button></a>
							</div> -->
							<!-- end -->

							<!-- show this when logged in -->
							<div class="au-acc">
								<button type="button" class="au-accbtn dropdown-toggle d-none d-lg-block" data-toggle="dropdown">
									<div class="au-inner">
										<img src="<?=base_url()?>assets/site/img/au-avatar.svg" class="au-avatar">
									</div>
									<div class="au-inner">
										<span class="au-accname">John Michael Doe</span>
										<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 1234 points</span>
									</div>
								</button>

								<div class="au-accmobile d-lg-none">
									<a href="#">
										<div class="au-inner">
											<img src="<?=base_url()?>assets/site/img/au-avatar.svg" class="au-avatar-lg">
										</div>
										<div class="au-inner">
											<span class="au-accname">John Michael Doe</span>
											<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 1234 points</span>	
										</div>
									</a>
								</div>
								<div class="au-dropdown dropdown-menu">
									<a class="dropdown-item" href="#"><i class="fas fa-user"></i> Visit Profile</a>
									<a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Account Settings</a>
									<a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
								</div>
							</div>
							<!-- end -->

						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<script type="text/javascript">
		$("#<?= $active_menu;?>").addClass("active")
	</script>