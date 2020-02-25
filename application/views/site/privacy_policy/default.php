<?php
	
	$back_url = base_url();
	if(isset($_SERVER['HTTP_REFERER'])){
		$back_url = $_SERVER['HTTP_REFERER'];
	}
?>

<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin"><?= $privacy_policy['title'];?></span>
		<a href="<?= $back_url;?>" class="au-lnk">
			<button class="au-btn au-back"><i class="fas fa-arrow-left"></i> Go back</button>
		</a>
	</div> 
</div>

<div class="container-fluid">

	<div class="au-container au-padding">

		<div class="au-eventswrapper row">
			<div class="col">
					<p class="au-p4"><?=$privacy_policy['content']?></p>
					<hr>
			</div>

		</div>

	</div>
</div>