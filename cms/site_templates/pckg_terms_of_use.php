<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->
<div class="main-content">
	<div class="row">
		<?php  $about = $this->load->active_list("pckg_terms_of_use"); ?>
		<div class="col-md-12">
			<h2 class="terms_of_use_title"><?= $about[0]->terms_of_use_title ?></h2>
			<p class="terms_of_use_statement"><?= $about[0]->terms_of_use_statement ?></p>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        check_field_status('pckg_terms_of_use');
    });
</script>