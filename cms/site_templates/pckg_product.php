<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->

<div class="main-content">
	<div class="row">
		<?php  $about = $this->load->active_list("pckg_product"); ?>
		<div class="col-md-6">
			<img src="<?= base_url() . $about[0]->product_image ?>" class="img-responisve product_image"/>
		</div>
		<div class="col-md-12">
			<h2 class="pckg_product"><?= $about[0]->product_product ?></h2>
			<p class="product_description"><?= $about[0]->product_description ?></p>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        check_field_status('pckg_product');
    });
</script>