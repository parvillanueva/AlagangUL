<?php 
	// echo "<pre>";
	// print_r($details);
	// echo "</pre>";
?>

<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<div class="au-programheading">
			<div class="au-phthumbnail">
				<img src="<?= base_url() . $details['details'][0]->image_thumbnail;?>" class="au-fp-thumbnailimg">
			</div>
			<div class="au-phdetails">
				<span class="au-h5"><?= $details['details'][0]->name;?></span>
				<div class="au-phstats">
					<span class="au-members"><i class="fas fa-user-friends"></i><?= $details['members_count'];?> <?= ($details['members_count'] > 1 ) ? 'Members' : 'Member';?></span>
					<a href="#" class="au-lnk"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="<?= base_url();?>assets/site/img/au-workplace.svg" alt="Workplace"></span></a>
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="container-fluid">

	<div class="au-container au-exfilter au-padding">

		<div class="row flex-column-reverse flex-md-row">
			<div class="col-lg-3 col-md-4">
				<div class="au-boxed">
					<div class="au-titlebox">Members</div>
					<div class="au-content">
						<div class="au-inner au-cscroll">
							<?php foreach ($details['members'] as $key => $value) { ?>
								<div class="au-userentry">
									<a href="profile.html" class="au-userentry">
										<div class="au-inner">
											<img src="<?= $value->profile_image;?>" class="au-avatar-lg">
										</div>
										<div class="au-inner">
											<span class="au-accname"><?= $value->user;?></span>
											<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 1234 points</span>	
										</div>
									</a>
								</div>
							<?php } ?>
						</div>

					</div>
				</div>

				<div class="au-boxed">
					<a href="#" class="au-lnk"><div class="au-titlebox"><img src="<?= base_url();?>assets/site/img/au-workplace.svg" height="30px;"></div></a>
					<div class="au-content">
						<!-- insert facebook feed here -->
						<iframe src="" class="au-frame"></iframe>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-8">
				<div class="au-programdescription">
					<span class="au-p4"><?= $details['details'][0]->overview;?></span>
				</div>
				<hr>
				<div class="au-programdescription">
					<span class="au-title">Areas covered: <?= $details['details'][0]->area_covered;?></span>
				</div>
				<hr>
				<span class="au-h4">Upcoming Events</span>
				<div class="au-eventswrapper">
					
					<?php foreach ($details['events'] as $key => $value) { ?>
						<div class="au-event-entry vol-time vol-treasure vol-talent volunteered" id="progress1">
							<div class="au-event">
								<div class="row">
									<div class="col-sm-4 au-eventthumbnail">
										<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 10 points</span>
										<span class="au-accpoints au-accpointsv"><div class="au-heart"><i class="fas fa-heart"></i></div>Volunteered</span>
										<img src="<?= $value['image'];?>" class="au-eventimg">
									</div>
									<div class="col-sm-8 au-eventdetails">
										<div class="au-program">
											<a href="<?= $value['link'];?>" class="au-lnk">
												<div class="au-pthumbnail">
													<img src="<?= base_url() . $details['details'][0]->image_thumbnail;?>" class="au-fp-thumbnailimg">
												</div>
												<span class="au-ptitle"><?= $value['title'];?></span>
												<span class="au-pdetails"><?= $value['description'];?></span>
											</a>
										</div>
										<div class="au-programdetails">
											<div class="au-inner">
												<span class="au-pans"><span class="au-pques">When:</span><?= date("F d, Y h:i a", strtotime($value['when']));?></span>
											</div>
											<div class="au-inner">
												<span class="au-pans"><span class="au-pques">Where:</span><?= $value['where'];?></span>
											</div>
										</div>
										<div class="au-volunteers">
											<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
											<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
											<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
										</div>
										<div class="au-action">
											<div class="row">
												<div class="col"><span class="au-needed"><?= $value['required_volunteer'] ;?> volunteers needed</span></div>
												<div class="col">
													<a href="eventdetails.html" class="au-lnk"><button type="button" class="au-volunteer au-btnyellow float-right">Volunteer</button></a>
													<button type="button" class="au-volunteered au-btnyellow float-right">Volunteered</button>
												</div>
											</div>
										</div>
										<div class="au-pprogress">
											<div class="au-bar"></div>
											<span class="au-numbers"><i class="fas fa-walking"></i> <?= $value['joined_volunteers'] ;?> of <?= $value['required_volunteer'] ;?> Volunteers</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>

				<span class="au-h4 d-none d-md-block">Other Programs</span>

				<div class="au-programwrapper d-none d-md-block">
					<div class="row">

						<div class="col-lg-3 col-6">
							<a href="programdetails.html" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="assets/img/au-batang1000.jpg" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-6">
							<a href="programdetails.html" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="assets/img/au-lingapdiwa.jpg" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-6">
							<a href="programdetails.html" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="assets/img/au-huwagkangsusuko.jpg" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-6">
							<a href="programdetails.html" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="assets/img/au-brostate.jpg" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>

					</div>
				</div>

			</div>
		</div>				
		<div class="row d-md-none">
			<div class="col-12">
				<span class="au-h4">Other Programs</span>

				<div class="au-programwrapper">
					<div class="row">
						<div class="col-lg-3 col-6">
							<a href="programdetails.html" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="assets/img/au-batang1000.jpg" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-6">
							<a href="programdetails.html" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="assets/img/au-lingapdiwa.jpg" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-6">
							<a href="programdetails.html" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="assets/img/au-huwagkangsusuko.jpg" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-6">
							<a href="programdetails.html" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="assets/img/au-brostate.jpg" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>

					</div>
				</div>

			</div>
		</div>

	</div>
</div>