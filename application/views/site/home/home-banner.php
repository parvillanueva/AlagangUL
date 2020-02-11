<div id="auCarousel" class="au-carousel carousel slide" data-ride="carousel" data-interval="10000">
    <div class="carousel-inner">
        <?php foreach($banners as $i => $banner) { ?>
            <div class="carousel-item <?php if($i == 0) echo 'active'; ?>">		
                <div class="container-fluid au-hero-bg" style="background-image: url(<?=base_url().$banner['banner_media_web']?>);">
                    <div class="au-hero-container">
                        <div class="au-inner">
                            <div class="row">
                                <div class="col-lg-6 au-flexcenter">
                                    <img src="<?=base_url().$banner['banner_logo']?>" class="au-img-responsive">
                                </div>
                                <div class="col-lg-6 au-flexcenter">
                                    <div class="au-inner">
                                        <span class="au-h1"><?=$banner['title']?></span>
                                        <span class="au-h2"><?=$banner['description']?> </span>
                                        <button type="button" class="au-btnblue" onclick="location.href='<?=base_url().$banner['button_url']?>'">
                                            <?=$banner['button_text']?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php if(isset($is_slider)) { ?>
        <a class="carousel-control-prev" href="#auCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#auCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    <?php } ?>
    <div class="au-scroll">
        <a href="#featured"><i class="fas fa-chevron-down"></i></a>
    </div>
</div>