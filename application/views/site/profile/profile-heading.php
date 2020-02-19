<div class="container-fluid au-heading">
    <div class="au-container au-padding">
        <div class="au-programheading">
            <div class="au-evthumbnail d-lg-none" >
                <?php if(empty($profile->imagepath)) : ?>
                    <img src="<?=base_url() ?>assets/img/au-avatar.svg" class="au-fp-thumbnailimg">
                <?php else: ?>
                    <img src="<?=base_url() . $profile->imagepath ?>" class="au-fp-thumbnailimg" onerror="imgErrorProfile(this);">
                <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-4 d-none d-lg-block">
            </div>
            <div class="au-phdetails au-max-width">
                <span class="au-h5">
                <?php 
                    $str_full_name = $profile->full_name;
                    if (strlen($str_full_name) > 25){
                        $str_full_name = substr($str_full_name, 0, 20) . '...';
                    }
                    echo $str_full_name;
                ?>
                </span>
                <div class="au-phstats">
                    <a href="#" class="au-lnk au-email"><?= $profile->email_address ?></a>
                </div>
            </div>
            <button class="au-btn" data-toggle="modal" data-target="#profilesettings"><i class="fas fa-user-edit"></i>Edit Profile</button>
        </div>
        
    </div>
</div>
<script type="text/javascript">
    var base_url = '<?=base_url();?>';
    function imgErrorProfile(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/au-avatar.svg";
        return true;
    }
</script>