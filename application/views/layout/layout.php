<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view("layout/header"); ?>
</head>
<body>
	<div id="main" class="">
		<aside id="sideNav" class="sidenav">
		</aside>

		<div id="leftPanel" class="left-panel">
			<?php $this->load->view("layout/navbar");?>
			<div class="main-content">
			<?php $this->load->view($content); ?>
			</div>
		</div>
	</div>
</body>
</html>