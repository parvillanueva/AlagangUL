<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->
<div class="main-content">
	<div class="row">
		<?php  $privacy = $this->load->active_list("pckg_privacy_statement"); ?>
		<div class="col-md-12 privacy_statement">
			<h2>Privacy Statement</h2>
			<p><?= $privacy[0]->privacy_statement ?></p>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        check_field_status('pckg_privacy_statement');
    });
</script>