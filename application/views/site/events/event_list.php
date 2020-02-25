<div class="col">
	<div class="row">
		<?php $month = '';
		foreach($events as $key => $eloop){ ?>
			<?php
			$when = ($eloop['when_set'] == 'TBA') ? 'TBA' : date('F', strtotime($eloop['when_set']));
			if($month != $when){
				$month = $when;
			?>
				<div class="col-12"><span class="au-ptitle"><?php echo $month;?></span></div>
			<?php } ?>

			<?php
				$link = base_url('programs/'.$eloop['program_details']->id.'/'.$eloop['program_details']->url_alias.'/event/'.$eloop['id'].'/'.$eloop['url_alias']);
			?>
			<div class="au-event-entry col-lg-6 vol-time vol-treasure volunteered" id="progress1">
				<div class="au-event">
					<div class="row">
						<div class="col-sm-4 au-eventthumbnail">
							<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 10 points</span>
							<span class="au-accpoints au-accpointsv"><div class="au-heart"><i class="fas fa-heart"></i></div>Volunteered</span>
							<a href="<?=$link?>">
								<img src="<?= $eloop['image']; ?>" class="au-eventimg" onerror="imgErrorEvent(this);">
							</a>
						</div>
						<div class="col-sm-8 au-eventdetails">
							<div class="au-program">
								
								<a href="<?=$link?>" class="au-lnk">
									<div class="au-pthumbnail">
										<img src="<?= base_url($eloop['program_details']->image_thumbnail);?>" class="au-fp-thumbnailimg" onerror="imgErrorEvent(this);">
									</div>
									<span class="au-ptitle"><?= $eloop['title'] ?></span>
									<!-- <span class="au-pdetails"><?= $eloop['description'] ?></span> -->
								</a>
							</div>
							<div class="au-programdetails">
								<div class="au-inner">
									<span class="au-pans"><span class="au-pques">When:</span><?= $eloop['when']; ?></span>
								</div>
								<div class="au-inner">
									<span class="au-pans"><span class="au-pques">Where:</span><?= $eloop['where'] ?></span>
								</div>
								<?php 
								if($eloop['contact_person']!=''){
								?>
								<div class="au-inner">
								<span class="au-pans">
								    <span class="au-pques">Contact Person:</span>
								    <?=$eloop['contact_person']?>(<?=$eloop['contact_number']?>)
								</span>
								</div>
								<?php } ?>
							</div>
							<!-- <div class="au-volunteers">
								<?php foreach ($eloop['get_earn_badge'] as $a => $b) { ?>

									<img src="<?= base_url() . "/" . $b->icon_image;?>" class="au-imgbadge" title="<?= $b->name;?>">

								<?php } ?>
							</div> -->
							<div class="au-action">
								<div class="row">
									<!-- <div class="col"><span class="au-needed"><?= $eloop['required_volunteer'] ?> volunteers needed</span></div> -->
									<div class="col">
										<?php 
										if($eloop['required_volunteer']!=0 && $eloop['is_not_joined'] !=1){
											if(!$eloop['is_joined']){
										?>	
										<a href="<?=$link?>" class="au-volunteer au-btnyellow float-right" style="display: block">Volunteer</a>
										<?php } else { ?>

										<a href="<?=$link?>" class="au-volunteered au-btnyellow float-right">Volunteered</a>
									<?php } }  ?>
									</div>
								</div>
							</div>
							<div class="au-pprogress">
								<?php
									$bar_width = 0;
									@$bar_width = ceil($eloop['joined_volunteers'] / $eloop['required_volunteer']);
								?>
								<div class="au-bar" style="width:<?=$bar_width?>%"></div>
								<span class="au-numbers" style="position: absolute;right: 50%;"><?=$bar_width?>%</span>
								<span class="au-numbers"><i class="fas fa-walking"></i> <?= intval($eloop['required_volunteer']-$eloop['joined_volunteers'])?> Volunteers Needed</span>
				
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
	var base_url = '<?=base_url();?>';
    function imgErrorEvent(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/broken_img2.jpg";
        return true;
    }
</script>