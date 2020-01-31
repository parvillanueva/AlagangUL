<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->
<div class="main-content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel-group" id="accordion">
				<?php $faqs = $this->load->active_list("pckg_faqs", "status = 1", "create_date", "desc"); ?>
				<?php
					foreach($faqs as $key => $value) {
				?>
				
					<div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title" class="faqs_question">
						    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $value->id ?>">
						    <?= $value->faqs_question ?></a>
						  </h4>
						</div>
						<div id="collapse<?= $value->id ?>" class="panel-collapse collapse in" >
						  <div class="panel-body" class="faqs_answer"><?= $value->faqs_answer ?></div>
						</div>
					</div>

				<?php
					}
				?>

			</div>	
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        check_field_status('pckg_faqs');
    });
</script>