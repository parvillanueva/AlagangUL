<?php
	$user_id = $ci->session->userdata('user_sess_id');
	$arr_where = array(
		'id' => $user_id
	);
	$user_details = $ci->Gmodel->get_query('tbl_users',"id = " . $user_id);
	$points_details = $ci->Gmodel->get_query('tbl_users_points',"user_id = " . $user_id);
?>

<header class="au-header">
		<div class="au-navigation au-container">
			<nav class="au-navbar navbar navbar-expand-lg">
				<div>
					<button type="button" class="au-navbar-toggler navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
						<img src="<?=base_url()?>assets/site/img/au-menu.svg" width="28px" height="28px">
					</button>
				</div>
				<a href="<?= base_url();?>" class="au-navbar-brand navbar-brand">
					<img src="<?=base_url()?>assets/site/img/au-logo.png" alt="Alagang Unilab Logo" class="au-logo">
				</a>
				<div class="d-lg-none">
					<?php if(empty($user_details[0]->imagepath)) : ?>
						<img src="<?=base_url() ?>assets/img/au-avatar.svg" class="au-avatar" onerror="imgErrorProfile(ci);">
					<?php else: ?>
						<img src="<?=base_url() . $user_details[0]->imagepath ?>" class="au-avatar" onerror="imgErrorProfile(ci);">
					<?php endif; ?>
					
				</div>

				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="au-navbar-nav navbar-nav ml-auto flex-column-reverse flex-lg-row">
						<div class="au-menu">

						</div>
						<div class="au-user">

							<!-- end -->

						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<script type="text/javascript">
		var base_url = '<?=base_url();?>';
	    function imgErrorProfile(image) {
	        image.onerror = "";
	        image.src = base_url+"/assets/img/au-avatar.svg";
	        return true;
	    }
	   	function imgError(image) {
	        image.onerror = "";
	        image.src = base_url+"/assets/img/broken_img1.jpg";
	        return true;
	    }
	    
		$("#<?= $active_menu;?>").addClass("active");
		$(document).on('click', '#logout', function(){
			window.location.href = "<?php echo base_url('site/logout') ?>";
		});

	</script>