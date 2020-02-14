<div class="col">
	<div class="row">
		<?php $month = '';
		foreach($events as $key => $eloop){ ?>
			<?php 
			$when = date('F', strtotime($eloop['when']));
			if($month != $when){ 
			$month = $when;
			?>
				<div class="col-12"><span class="au-ptitle"><?php echo $month;?></span></div>
			<?php } ?>
			<div class="au-event-entry col-lg-6 vol-time vol-treasure volunteered" id="progress1">
				<div class="au-event">
					<div class="row">
						<div class="col-sm-4 au-eventthumbnail">
							<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 10 points</span>
							<span class="au-accpoints au-accpointsv"><div class="au-heart"><i class="fas fa-heart"></i></div>Volunteered</span>
							<img src="<?= $eloop['image']; ?>" class="au-eventimg" onerror="imgErrorEvent(this);">
						</div>
						<div class="col-sm-8 au-eventdetails">
							<div class="au-program">
								<a href="<?= base_url('programs/'.$eloop['program_details']->id.'/'.$eloop['program_details']->url_alias); ?>" class="au-lnk">
									<div class="au-pthumbnail">
										<img src="<?= base_url($eloop['program_details']->image_thumbnail); ?>" class="au-fp-thumbnailimg" onerror="imgErrorEvent(this);">
									</div>
									<span class="au-ptitle"><?= $eloop['title'] ?></span>
									<span class="au-pdetails"><?= $eloop['description'] ?></span>
								</a>
							</div>
							<div class="au-programdetails">
								<div class="au-inner">
									<span class="au-pans"><span class="au-pques">When:</span><?= date('F d, Y h:i A', strtotime($eloop['when'])); ?></span>
								</div>
								<div class="au-inner">
									<span class="au-pans"><span class="au-pques">Where:</span><?= $eloop['where'] ?></span>
								</div>
							</div>
							<div class="au-volunteers">
								<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
								<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
								<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
							</div>
							<div class="au-action">
								<div class="row">
									<div class="col"><span class="au-needed"><?= $eloop['required_volunteer'] ?> volunteers needed</span></div>
									<div class="col">
										<a href="eventdetails.html"><button type="button" class="au-volunteer au-btnyellow float-right">Volunteer</button></a>
										<button type="button" class="au-volunteered au-btnyellow float-right">Volunteered</button>
									</div>
								</div>
							</div>
							<div class="au-pprogress">
								<div class="au-bar"></div>
								<span class="au-numbers"><i class="fas fa-walking"></i> <?= $eloop['joined_volunteers'] ?> of <?= $eloop['required_volunteer'] ?> Volunteers</span>
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
        image.src = base_url+"/assets/img/broken_img1.jpg";
        return true;
    }
</script>