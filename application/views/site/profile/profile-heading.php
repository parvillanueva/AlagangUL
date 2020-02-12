<div class="container-fluid au-heading">
    <div class="au-container au-padding">
        <div class="au-programheading">
            <div class="au-evthumbnail d-lg-none" >
                <?php if(empty($profile->imagepath)) : ?>
                    <img src="<?=base_url() ?>assets/img/au-avatar.svg" class="au-fp-thumbnailimg">
                <?php else: ?>
                    <img src="<?=base_url() . $profile->imagepath ?>" class="au-fp-thumbnailimg">
                <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-4 d-none d-lg-block">
            </div>
            <div class="au-phdetails au-max-width">
                <span class="au-h5"><?= $profile->full_name ?></span>
                <div class="au-phstats">
                    <a href="#" class="au-lnk au-email"><?= $profile->email_address ?></a>
                </div>
            </div>
            <button class="au-btn" data-toggle="modal" data-target="#profilesettings"><i class="fas fa-user-edit"></i>Edit Profile</button>
        </div>
        
    </div>
</div>