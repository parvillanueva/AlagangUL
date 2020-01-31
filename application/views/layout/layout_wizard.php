<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view("layout/header"); ?>
	<link href="<?= base_url();?>assets/css/login-styles.css" rel="stylesheet">
</head>
<body class="login-body">
	<div class="parent">
	    <div class="child">
		    <div class="login-container z-depth-5 animated fadeInDownBig">
		        <div class="container-fluid">
		          	<div class="row">
		            	<div class="col-md-12 p-0">
				              	<!-- <img src="assets/images/bg_login.png" class="img-responsive login-right-img" alt=""> -->
				              	<div id="rightImg" class="">
				              		<?php $this->load->view($content); ?>
				              	</div>
		            	</div>
		          	</div>
		        </div>
		    </div>
	    </div>
  	</div>
</body>
</html>