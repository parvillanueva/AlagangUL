<div id="auCarousel" class="au-carousel carousel slide" data-ride="carousel" data-interval="10000">
    <div class="carousel-inner">
        {banners}
            <div class="carousel-item active">		
                <div class="container-fluid au-hero-bg" style="background-image: url(<?=base_url()?>{banner_media_web});">
                    <div class="au-hero-container">
                        <div class="au-inner">
                            <div class="row">
                                <div class="col-lg-6 au-flexcenter">
                                    <img src="<?=base_url()?>{banner_logo}" class="au-img-responsive">
                                </div>
                                <div class="col-lg-6 au-flexcenter">
                                    <div class="au-inner">
                                        <span class="au-h1">{title}</span>
                                        <span class="au-h2">{description} </span>
                                        <button type="button" class="au-btnblue">{button_text} </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/banners}
        <!-- <div class="carousel-item">		
            <div class="container-fluid au-hero-bg">
            </div>
        </div> -->

    </div>

    <a class="carousel-control-prev" href="#auCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#auCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <div class="au-scroll">
        <a href="#featured"><i class="fas fa-chevron-down"></i></a>
    </div>
</div>