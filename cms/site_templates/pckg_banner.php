<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->

<div class="row">
	<?php  $banner = $this->load->active_list("pckg_banner"); ?>
	<div class="col-md-12">
		<img src="<?= base_url() . $banner[0]->banner_image ?>" class="img-responisve banner_image"/>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        check_field_status('pckg_banner');
    });
</script>