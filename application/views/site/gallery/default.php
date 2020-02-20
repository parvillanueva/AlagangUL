<?php

	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$back_url = explode('/', $actual_link);
	array_pop($back_url);
	$back_url =  implode('/', $back_url); 
?>

<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Event Name Gallery</span>
		<a href="<?= $back_url;?>" class="au-lnk">
			<button class="au-btn au-back"><i class="fas fa-arrow-left"></i> Go back</button>
		</a>
	</div>
</div>

<div class="container-fluid">

	<div class="au-container au-padding">

		<div class="au-gallerywrapper row">
			
			<ul id="imageGallery">
				<?php foreach ($photos as $key => $value) { ?>
					<li data-thumb="<?= base_url() . "/" . $value->path;?>" data-src="<?= base_url() . "/" . $value->path;?>">
						<img src="<?= base_url() . "/" . $value->path;?>" class="au-gallerythumb"/>
					</li>
				<?php } ?>
			</ul>

		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
			$('#imageGallery').lightSlider({
			gallery:true,
			item:1,
			loop:true,
			thumbItem:9,
			slideMargin:0,
			enableDrag: false,
			keyPress: false,
	        controls: true,
	        prevHtml: '<i class="fas fa-chevron-left"></i>',
	        nextHtml: '<i class="fas fa-chevron-right"></i>',
			currentPagerPosition:'left',
			onSliderLoad: function(el) {
					el.lightGallery({
					selector: '#imageGallery .lslide'
					});
			}	 
			});	
	});
</script>