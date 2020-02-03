<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Content Management Setup</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>cms/css/bootstrap.css">
	<style type="text/css">

	::selection { background-color: #f07746; color: #fff; }
	::-moz-selection { background-color: #f07746; color: #fff; }

	body {
		background-color: #edeee8;
		margin: 40px auto;
		max-width: 1024px;
		font: 16px/24px normal "Helvetica Neue",Helvetica,Arial,sans-serif;
		color: #808080;
	}

	a {
		color: #dd4814;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
	   color: #97310e;
	}

	h1 {
		color: #fff;
		background-color: 	#82a4b4;
		border-bottom: 1px solid #d0d0d0;
		font-size: 22px;
		font-weight: bold;
		margin: 0 0 14px 0;
		padding: 5px 10px;
		line-height: 40px;
	}

	h4 {
		background-color:#c9c9d4;
		padding: 5px;
		color:#095f88;
	}

	h2 {
		color:#404040;
		margin:0;
		padding:0 0 10px 0;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		 margin: 0 0 10px;
		 padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 12px;
		border-top: 1px solid #d0d0d0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
		background:#8ba8af;
		color:#fff;
	}

	#container {
		background: #fff;
		margin: 10px;
		border: 1px solid #d0d0d0;
		box-shadow: 0 0 8px #d0d0d0;
		border-radius: 4px;
	}
	</style>

</head>
<body>
	<div id="container">
		<h1>Content Management Setup1</h1>

		<div id="body">
			<?php echo validation_errors(); ?>
			<form id="setup_form" class="form-horizontal" action="<?= base_url('content_management/global_controller/save_data');?>">
				<center><h4>Information</h4></center><br>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">CMS Title</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control">
			    	</div>
			  	</div>
			  	<br><br>
			  	<center><h4>Database Connection</h4></center><br>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Host/Address</label>
			    	<div class="col-sm-5">
			      		<input type="text" class="form-control">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Username</label>
			    	<div class="col-sm-5">
			      		<input type="text" class="form-control">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Password</label>
			    	<div class="col-sm-5">
			      		<input type="text" class="form-control">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Database</label>
			    	<div class="col-sm-5">
			      		<input type="text" class="form-control">
			    	</div>
			  	</div>
			  	<br><br>
			  	<center><h4>Administrator Account</h4></center><br>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Name</label>
			    	<div class="col-sm-5">
			      		<input type="text" class="form-control">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Email</label>
			    	<div class="col-sm-5">
			      		<input type="email" class="form-control">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Username</label>
			    	<div class="col-sm-5">
			      		<input type="text" class="form-control">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Password</label>
			    	<div class="col-sm-5">
			      		<input type="password" class="form-control">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="control-label col-sm-2">Confirm Password</label>
			    	<div class="col-sm-5">
			      		<input type="password" class="form-control">
			    	</div>
			  	</div>
			  	<br><br>
			  	<div class="form-group">
			    	<div class="col-sm-12" style="text-align: center;">
			      		<input type="submit" class="btn btn-default">
			    	</div>
			  	</div>
			</form>
		</div>
	</div>
</body>
</html>
