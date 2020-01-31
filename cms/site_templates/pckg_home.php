
<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->


<div id="myCarousel" class="carousel slide" data-ride="carousel">
<?php $slider = $this->load->active_list("pckg_home_slider", "status = 1", "create_date", "desc"); ?>
  <!-- Indicators -->
  <ol class="carousel-indicators">

	<?php
	if (count($slider) > 0) {
		$counter = 1;
	    foreach ($slider as $key => $value) {
	        ?>

			<li data-target="#myCarousel" data-slide-to="<?= $counter; ?>"></li>

	        <?php
	        $counter++;
	    }
	}
	?>

  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">

	<?php
	$banner_count = 0;
	if (count($slider) > 0) {
	    foreach ($slider as $key => $value) {
	    	$banner_count++;
	        ?>

			<div class="item <?php if($banner_count==1){echo 'active';}?>">
		      <img src="<?= base_url() . $value->home_slider_image; ?>" class="img-responisve home_slider_url"/>
		    </div>

	        <?php
	    }
	}
	?> 

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        check_field_status('pckg_home_slider');
    });
</script>