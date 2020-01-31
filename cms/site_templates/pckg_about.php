<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->

<div class="main-content">
	<div class="row">
		<?php $about = $this->load->active_list("pckg_about"); ?>
		<div class="col-md-12">
			<h2 class="about_title"><?= $about[0]->about_title ?></h2>
			<p class="about_description"><?= $about[0]->about_description ?></p>
		</div>
		<div class="col-md-6">
			<?php if($about[0]->about_youtube_video_url == 0){

				$str = $about[0]->about_banner;

				if (strpos($str, 'mp4') !== false) {?>

				    <iframe class="embed-responsive-item" src="<?= $about[0]->about_banner ?>" allowfullscreen class="about_banner"></iframe>
				    
				<?php
				}else{ ?>
					<img src="<?= base_url() . $about[0]->about_banner ?>" class="img-responisve about_banner"/ >
				<?php
				}
				?>

			<?php
				}else{ 
			?> 
				<iframe class="embed-responsive-item" src="<?= $about[0]->about_youtube_video_url ?>" allowfullscreen class="about_youtube_video_url"></iframe>

			<?php
				} 
			?>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		check_field_status('pckg_about');
	});
</script>