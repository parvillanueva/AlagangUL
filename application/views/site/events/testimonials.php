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
		<div class="text-right">
			<!-- a href="#" class="au-lnk"><span class="au-share share-wp"><i class="fas fa-share-alt"></i> Share on <img src="<?php echo base_url("assets/img/au-workplace2.svg")?>" alt="Workplace"></span></a> -->
		</div>
	</div>
</div> 

<?php } } ?>

