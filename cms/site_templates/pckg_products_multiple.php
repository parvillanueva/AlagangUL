<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->
<div class="main-content">
    <div class="row">

    <?php $product = $this->load->active_list("pckg_products_multiple", "status = 1", "create_date", "desc"); ?>

    <?php
    if (count($product) > 0) {
        foreach ($product as $key => $value) {
            ?>

            <div class="col-md-4">
                <div class="article-img-container">
                    <img src="<?= base_url() . $value->product_image ?>" class="product_image"/>
                </div>
                <div style="color: 555">
                    <h4 class="product_product"><?= $value->product_product ?></h4>
                    <p class="product_description"><?= $value->product_description ?></p>
                </div>
            </div>

            <?php
        }
    }
    ?> 

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        check_field_status('pckg_products_multiple');
    });
</script>