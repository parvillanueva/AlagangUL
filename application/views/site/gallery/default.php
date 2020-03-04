<?php

	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$back_url = explode('/', $actual_link);
	array_pop($back_url);
	$back_url =  implode('/', $back_url); 
	$user_id = $this->session->userdata('user_sess_id');
?>

<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Event Gallery</span>
		<a href="<?= $back_url;?>" class="au-lnk">
			<button class="au-btn au-back"><i class="fas fa-arrow-left"></i> Go back</button>
		</a>
	</div>
</div>

<div class="container-fluid">

	<div class="au-container au-padding">

		<div class="au-gallerywrapper row">
			<?php foreach ($photos as $key => $value) { ?>
				<div class="col-lg-3 col-md-6 col-6">
					<?php
					if($is_admin==1 || $user_id==$value->uploader_id){

					?>
					<button class="au-delete" id="delete_image" path-url= "<?= $value->path?>" path-id="<?=$value->id?>" title="Delete"><i class="fas fa-trash"></i></button>
					<?php } ?>
					<a href="<?= base_url() . "/" . $value->path;?>" data-toggle="lightbox" data-gallery="gallery" class="au-lnk au-glink">
						<div class="au-opthumbnail">
							<img src="<?= base_url() . "/" . $value->thumb;?>" class="au-gl-thumbnailimg" onerror="imgErrorEvent(this);">
						</div>
					</a>
				</div>
			<?php } ?>
		</div>

	</div>
</div>

<script type="text/javascript">
	var base_url = '<?=base_url();?>';

	function imgErrorEvent(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/broken_img2.jpg";
        return true;
    }

	$(document).on("click", '[data-toggle="lightbox"]', function(event){
		event.preventDefault();
		$(this).ekkoLightbox();
	});
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
	
	$(document).on('click', '#delete_image', function(){
		var path_url = $(this).attr('path-url');
		var path_id = $(this).attr('path-id');
		var data = {
			path : path_url,
			id : path_id
		};
		var url = "<?php echo base_url('site/gallery/delete_gallery_image') ?>";
		BM.confirm('Are you sure you want to delete this photo?', function(results){
			if(results){
				BM.loading(true);
				aJax.post(url, data, function(result){
					var obj = is_json(result);
					if(obj.response == 'success'){
						location.reload();
					}
				});
			}
		});
	});
</script>