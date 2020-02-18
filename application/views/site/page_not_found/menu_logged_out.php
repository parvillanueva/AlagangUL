<?php
	$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
	$root  = $protocol.$_SERVER['HTTP_HOST'];
	$base_url = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<header class="au-header">
		<div class="au-navigation au-container">
			<nav class="au-navbar navbar navbar-expand-lg">
				<div>
					<button type="button" class="au-navbar-toggler navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
						<img src="<?=$base_url;?>assets/site/img/au-menu.svg" width="28px" height="28px">
					</button>
				</div>
				<a href="<?= $base_url;;?>" class="au-navbar-brand navbar-brand">
					<img src="<?=$base_url;?>assets/site/img/au-logo.png" alt="Alagang Unilab Logo" class="au-logo">
				</a>
				<div class="d-lg-none">
					<?php if(empty($user_details[0]->imagepath)) : ?>
						<img src="<?=$base_url; ?>assets/img/au-avatar.svg" class="au-avatar" onerror="imgErrorProfile(ci);">
					<?php else: ?>
						<img src="<?=$base_url . $user_details[0]->imagepath ?>" class="au-avatar" onerror="imgErrorProfile(ci);">
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
