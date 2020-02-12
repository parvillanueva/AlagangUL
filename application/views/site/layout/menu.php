<?php
	$user_id = $this->session->userdata('user_sess_id');
	$arr_where = array(
		'id' => $user_id
	);
	$user_details = $this->Gmodel->get_query('tbl_users',"id = " . $user_id);
	$points_details = $this->Gmodel->get_query('tbl_users_points',"user_id = " . $user_id);
?>

<header class="au-header">
		<div class="au-navigation au-container">
			<nav class="au-navbar navbar navbar-expand-lg">
				<button type="button" class="au-navbar-toggler navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
					<img src="<?=base_url()?>assets/site/img/au-menu.svg" width="28px" height="28px">
				</button>
				<a href="<?= base_url();?>" class="au-navbar-brand navbar-brand">
					<img src="<?=base_url()?>assets/site/img/au-logo.png" alt="Alagang Unilab Logo" class="au-logo">
				</a>
				<div class="d-lg-none">
					<?php if(empty($user_details[0]->imagepath)) : ?>
						<img src="<?=base_url() ?>assets/img/au-avatar.svg" class="au-avatar">
					<?php else: ?>
						<img src="<?=base_url() . $user_details[0]->imagepath ?>" class="au-avatar">
					<?php endif; ?>
					
				</div>

				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="au-navbar-nav navbar-nav ml-auto flex-column-reverse flex-lg-row">
						<div class="au-menu">
							<a id="home" href="<?= base_url();?>" class="nav-item nav-link">Home</a>
							<a id="about" href="<?= base_url("about");?>" class="nav-item nav-link">About</a>
							<a id="programs"  href="<?= base_url("programs");?>" class="nav-item nav-link">Programs</a>
							<a id="events"  href="<?= base_url("events");?>" class="nav-item nav-link">Events</a>
							<!-- <a id="get_rewards"  href="<?= base_url("get-rewards");?>" class="nav-item nav-link">Get Rewards</a> -->
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
										<?php if(empty($user_details[0]->imagepath)) : ?>
											<img src="<?=base_url() ?>assets/img/au-avatar.svg" class="au-avatar">
										<?php else: ?>
											<img src="<?=base_url() . $user_details[0]->imagepath ?>" class="au-avatar">
										<?php endif; ?>
									</div>
									<div class="au-inner">
										<span class="au-accname"><?= $user_details[0]->first_name . " " . $user_details[0]->last_name;?></span>
										<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> <?= $points_details[0]->current_points ?> points</span>
									</div>
								</button>

								<div class="au-accmobile d-lg-none">
									<a href="#">
										<div class="au-inner">
											<img src="<?=base_url()?>assets/site/img/au-avatar.svg" class="au-avatar-lg">
										</div>
										<div class="au-inner">
											<span class="au-accname"><?= $user_details[0]->first_name . " " . $user_details[0]->last_name;?></span>
											<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> <?= $points_details[0]->current_points ?> points</span>	
										</div>
									</a>
								</div>
								<div class="au-dropdown dropdown-menu">
									<a class="dropdown-item" href="profile"><i class="fas fa-user"></i> Visit Profile</a>
									<a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Account Settings</a>
									<a class="dropdown-item" href="<?= base_url("log-out");?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
		$("#<?= $active_menu;?>").addClass("active");
		$(document).on('click', '#logout', function(){
			window.location.href = "<?php echo base_url('site/logout') ?>";
		});
	</script>