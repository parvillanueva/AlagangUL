<style type="text/css">
	li {
	    margin-bottom: 10px;
	    margin-top: 10px;
	}
</style>

<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<!-- <span class="au-h5 no-margin">About Alagang Unilab</span> -->
	</div>
</div>

<div class="container-fluid">

	<div class="au-container au-padding">

		<div class="au-eventswrapper row">
			<div class="col">

				<?php foreach($details as $i => $about) { ?>
					<h2 class="au-h4"><?=$about['title']?></h2>

					<p class="au-p4"><?=$about['description']?></p>
					<hr>

		        <?php } ?>

				
				
			</div>

		</div>

	</div>
</div>