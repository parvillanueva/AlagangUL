<?php
if($testimonials_page>0){
	foreach ($testimonials as $key => $testimonial) {
?>
<div class="col-lg-6 au-fullheight au-testimonialentry">
	<div class="au-testimonial au-fullheight">
		<div class="au-userentry">
			<a href="<?=base_url()?>profile/<?=$testimonial['picture']['user_id']?>" class="au-userentry">
				<div class="au-inner">
					<img src="<?=base_url().$testimonial['picture']['image_path']?>" class="au-avatar-lg" onerror="imgErrorProfile(this);">
				</div>
				<div class="au-inner">
					<span class="au-accname"><?=$testimonial['picture']['name']?></span>
					<span class="au-accvolunteer">
					</span>
				</div>
			</a>
		</div>
		<span class="au-date"><?=$testimonial['date_posted']?></span>
		<span class="au-p5"><?=$testimonial['testimonial']?></span>
		<?php
			if($this->session->userdata('user_sess_id')==$testimonial['picture']['user_id'] && $this->session->userdata('user_impersonate_token') !=''){
		?>
		<div class="text-right">
			<a href="javascript:void(0);" class="au-lnk wokplace-testimonial" attr-message="<?=$testimonial['testimonial']?>"><span class="au-share share-wp"><i class="fas fa-share-alt"></i> Share on <img src="<?php echo base_url("assets/img/au-workplace2.svg")?>" alt="Workplace"></span></a>
		</div>
		<?php } ?>
	</div>
</div> 

<?php } } ?>

