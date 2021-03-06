
<div class="container-fluid" id="featured">
    <div class="au-container au-padding">
        <span class="au-h3">Featured Programs</span>
        <div class="row">
        {programs}
            <div class="col-lg-4 col-sm-6">
                <div class="au-featured-program">
                    <div class="au-fp-thumbnail">
                        <a href="<?= base_url("programs");?>/{id}/{url_alias}">
                            <img src="<?=base_url()?>{image_thumbnail}" class="au-fp-thumbnailimg" onerror="imgErrorProgram(this);">
                        </a>
                    </div>
                    <div class="au-fp-details">
                        <a href="<?= base_url("programs");?>/{id}/{url_alias}">
                            <span class="au-p1">{name}</span>
                        </a>
                        <span class="au-p2">{headline}</span>
                        <div class="au-fp-fdetails">
                            <span class="au-p2 au-memcounter"><i class="fas fa-user-friends"></i> {member_count} </span>
                            <a href="<?= base_url("programs");?>/{id}/{url_alias}"><button type="button" class="au-btnyellow">Read More</button></a>
                        </div>
                    </div>
                </div>
            </div>
        {/programs}
        </div>
    </div>
</div>
<script type="text/javascript">
    var base_url = '<?=base_url();?>';
    
    function imgErrorProgram(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/broken_img1.jpg";
        return true;
    }

</script>