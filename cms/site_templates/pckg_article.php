<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->

<div class="main-content">

    <div class="row">

    <?php $articles = $this->load->active_list("pckg_article", "status = 1", "create_date", "desc"); ?>

    <?php
    if (count($articles) > 0) {
        foreach ($articles as $key => $value) {
            ?>

            <div class="col-md-4">
                <div class="article-img-container">
                    <img src="<?= base_url() . $value->article_thumbnail ?>" class="img-responisve article_thumbnail"/>
                </div>
                <div style="color: 555">
                    <h4 class="article_title"><?= $value->article_title ?></h4>
                    <p class="article_description"><?= $value->article_description ?></p>
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
        check_field_status('pckg_article');
    });
</script>