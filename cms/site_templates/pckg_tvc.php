<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->

<div class="main-content">
	<div class="row">
		<?php  $tvc = $this->load->active_list("pckg_tvc"); ?>
		<div class="col-md-12">
			<h2 class="tvc_title"><?= $tvc[0]->tvc_title ?></h2>
		</div>
		<div class="col-md-6">
			<?php if($tvc[0]->tvc_video_type == 1) : ?>
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="<?= $tvc[0]->tvc_youtube_video_url ?>" allowfullscreen class="tvc_youtube_video_url"></iframe>
			</div>
			<?php else : ?>
			<video src="<?= $tvc[0]->tvc_upload_video_url ?>" width="100%" controls></video>
			<?php endif; ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		check_field_status('pckg_tvc');
	});
</script>