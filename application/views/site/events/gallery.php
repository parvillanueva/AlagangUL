<?php

$user_id = $this->session->userdata('user_sess_id');
if($galleries_pages>0){
	foreach ($galleries as $key => $gallery) {

?>
<div class="col-lg-3 col-md-6 col-6">
	<div class="au-opthumbnail au-lnk au-plink">
		<a href="<?= base_url().$gallery->path?>" data-toggle="lightbox" data-gallery="gallery" class="toggle_image">
			<img src="<?= base_url().$gallery->thumb?>" class="au-gl-thumbnailimg img-fluid" onerror="imgErrorEvent(this);">
		</a>
<?php
//if($is_admin==1 || $user_id==$gallery->uploader_id){

?>
			<!--<div class="au-gltitle" style="text-align:right; cursor:pointer"><font color="red"><span class="fa fa-trash" path-url= "<?php //echo base_url().$gallery->path?>" path-id="<?php //echo $gallery->id?>" id="delete_image"></span></font></div>-->
<?php //} ?>
	</div>
</div>

<?php } } ?>