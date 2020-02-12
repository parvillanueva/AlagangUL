
<style type="text/css">
	h1 { text-align: center; }

	.dropzone {
	    background: white;
	    border-radius: 5px;
	    border: 2px dashed rgb(0, 135, 247);
	    border-image: none;
	    margin-left: auto;
	    margin-right: auto;
	    margin-bottom: 10px;
	}
</style>
<div class="au-wrapper">
	<div class="container-fluid au-heading">
		<div class="au-container au-padding">
			<div class="au-programheading">
				<div class="au-evthumbnail">
					<img src="<?= $event_details[0]['image'];?>" class="au-fp-thumbnailimg">
				</div>
				<div class="au-phdetails">
					<span class="au-h5"><?= $event_details[0]['title'];?></span>
					<div class="au-phstats">
						<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> <?= $event_details[0]['volunteer_points'];?> Join to receive points</span>
						<span class="au-members"><i class="fas fa-walking"></i><?= $event_details[0]['joined_volunteers'];?> <?= ($event_details[0]['joined_volunteers'] > 1 ) ? 'Volunteers' : 'Volunteer';?> </span>
						<a href="#" class="au-lnk"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="<?= base_url();?>assets/site/img/au-workplace.svg" alt="Workplace"></span></a>
					</div>
					<div class="au-badges">
						<span class="au-pb">Badges you can earn</span>
						<div class="au-badge"><i class="fas fa-hourglass au-time au-icon" title="Time"></i></div>
						<div class="au-badge"><i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i></div>
						<div class="au-badge"><i class="fas fa-gem au-treasure au-icon" title="Treasure"></i></div>
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
						<div class="au-titlebox">Volunteers</div>
						<div class="au-content">
							<div class="au-inner au-cscroll">
								<?php foreach ($event_volunteers as $key => $value) { ?>
									<div class="au-userentry">
										<a href="profile.html" class="au-userentry">
											<div class="au-inner">
												<img src="<?= $value->profile_image;?>" class="au-avatar-lg">
											</div>
											<div class="au-inner">
												<span class="au-accname"><?= $value->user; ?></span>
												<span class="au-accvolunteer">
													<div class="au-accvicon">
														<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
														<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
														<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
													</div>
												</span>	
											</div>
										</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

				</div>
				<div class="col-lg-9 col-md-8">
					<div class="au-programdetailsinside">
						<div class="au-inner">
							<a href="program.html" class="au-lnk">
								<div class="au-phthumbnail">
									<img src="<?= $program_details[0]['image_thumbnail'];?>" class="au-fp-thumbnailimg">
								</div>
							</a>
						</div>
						<div class="au-inner au-max-width">
							<span class="au-dtitle">Volunteers Needed:</span>
							<div class="au-pprogress" id="progress1">
								<div class="au-bar"></div>
								<span class="au-numbers"><i class="fas fa-walking"></i> <?= $event_details[0]['joined_volunteers'];?> of <?= $event_details[0]['required_volunteer'];?> Volunteers</span>
							</div>
							<div class="au-inner">
								<span class="au-pques">When:</span><span class="au-pans"><?= date("F d, Y h:i a", strtotime($event_details[0]['when']));?></span>
							</div>
							<div class="au-inner">
								<span class="au-pques">Where:</span><span class="au-pans"><?= $event_details[0]['where'];?></span>
							</div>
						</div>
					</div>
					<div class="au-programdescription">
						<span class="au-p4"><?= $event_details[0]['description'];?></span>
					</div>
					<hr>
					<div class="au-programdescription">
						<span class="au-title">Opportunities for volunteers to help</span>
						<div class="au-opptable">
							<table>
								<thead>
									<tr>
										<th scope="col">Possible task for volunteers</th>
										<th scope="col">Qualifications</th>
										<th scope="col">Needed</th>
										<th scope="col">Joined</th>
										<th scope="col">Volunteer your:</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($event_task as $key => $value) { ?>
										<tr class="forvolunteer">
											<td data-header="Task"><?= $value['task'];?></td>
											<td data-header="Qualifications"><?= $value['qualification'];?></td>
											<td data-header="Needed"><?= $value['required_volunteers'];?></td>
											<td data-header="Joined"><?= $value['joined_volunteers'];?></td>
											<td data-header="Volunteer your:" class="au-actions">
												<button class="au-btnvolunteer">
													<span class="au-btnvolunteertype au-time"><i class="fas fa-hourglass" title="Time"></i>Time</span>
												</button>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col">
							<span class="au-h4">Gallery</span>
						</div>
					</div>
					<div class="au-gallerywrapper">
						<form class="dropzone" id="FileManagerDropZone">
			                <div class="fallback">
			                    <input name="file" type="file" multiple />
			                </div>
			            </form>
						<div class="row" id="gallery_photos">

							<div class="col-lg-3 col-md-6 col-6">
								<a href="assets/img/au-sample-thumbnail.jpg" data-toggle="lightbox" data-gallery="gallery" class="au-lnk au-plink">
									<div class="au-opthumbnail">
										<img src="assets/img/au-sample-thumbnail.jpg" class="au-gl-thumbnailimg">
									</div>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col"><button class="au-btn float-right" id="loadMore">Load More</button></div>
						</div>
					</div>				
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col">
							<span class="au-h4">Testimonials</span>
						</div>
						<div class="col"><button class="au-btn float-right"><i class="fas fa-plus"></i>Add Testimonial</button></div>
					</div>
					<div class="row">
						<div class="col au-testimonialwrapper">
							<div class="row">

								<div class="col-lg-6 au-fullheight au-testimonialentry">
									<div class="au-testimonial au-fullheight">
										<div class="au-userentry">
											<a href="profile.html" class="au-userentry">
												<div class="au-inner">
													<img src="assets/img/au-avatar.svg" class="au-avatar-lg">
												</div>
												<div class="au-inner">
													<span class="au-accname">John Michael Doe</span>
													<span class="au-accvolunteer">
														<div class="au-accvicon">
															<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
															<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
															<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
														</div>
													</span>	
												</div>
											</a>
										</div>
										<span class="au-date">January 1, 2020 2:00PM</span>
										<span class="au-p5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</span>
										<div class="text-right">
											<a href="#" class="au-lnk"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="assets/img/au-workplace2.svg" alt="Workplace"></span></a>
										</div>
									</div>
								</div>

								<div class="col-lg-6 au-fullheight au-testimonialentry">
									<div class="au-testimonial au-fullheight">
										<div class="au-userentry">
											<a href="profile.html" class="au-userentry">
												<div class="au-inner">
													<img src="assets/img/au-avatar.svg" class="au-avatar-lg">
												</div>
												<div class="au-inner">
													<span class="au-accname">John Michael Doe</span>
													<span class="au-accvolunteer">
														<div class="au-accvicon">
															<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
															<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
															<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
														</div>
													</span>	
												</div>
											</a>
										</div>
										<span class="au-date">January 1, 2020 2:00PM</span>
										<span class="au-p5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</span>
										<div class="text-right">
											<a href="#" class="au-lnk"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="assets/img/au-workplace2.svg" alt="Workplace"></span></a>
										</div>
									</div>
								</div>

								<div class="col-lg-6 au-fullheight au-testimonialentry">
									<div class="au-testimonial au-fullheight">
										<div class="au-userentry">
											<a href="profile.html" class="au-userentry">
												<div class="au-inner">
													<img src="assets/img/au-avatar.svg" class="au-avatar-lg">
												</div>
												<div class="au-inner">
													<span class="au-accname">John Michael Doe</span>
													<span class="au-accvolunteer">
														<div class="au-accvicon">
															<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
															<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
															<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
														</div>
													</span>	
												</div>
											</a>
										</div>
										<span class="au-date">January 1, 2020 2:00PM</span>
										<span class="au-p5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</span>
										<div class="text-right">
											<a href="#" class="au-lnk"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="assets/img/au-workplace2.svg" alt="Workplace"></span></a>
										</div>
									</div>
								</div>

								<div class="col-lg-6 au-fullheight au-testimonialentry">
									<div class="au-testimonial au-fullheight">
										<div class="au-userentry">
											<a href="profile.html" class="au-userentry">
												<div class="au-inner">
													<img src="assets/img/au-avatar.svg" class="au-avatar-lg">
												</div>
												<div class="au-inner">
													<span class="au-accname">John Michael Doe</span>
													<span class="au-accvolunteer">
														<div class="au-accvicon">
															<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
															<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
															<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
														</div>
													</span>	
												</div>
											</a>
										</div>
										<span class="au-date">January 1, 2020 2:00PM</span>
										<span class="au-p5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</span>
										<div class="text-right">
											<a href="#" class="au-lnk"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="assets/img/au-workplace2.svg" alt="Workplace"></span></a>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>			

		</div>
	</div>
</div>

<script type="text/javascript">
	$('input[name="date"]').daterangepicker();
</script>
<script type="text/javascript">
	var limit  = 4;
	$(document).ready(function() {
		var required_volunteer = <?= $event_details[0]['required_volunteer'];?>;
		var joined_volunteers = <?= $event_details[0]['joined_volunteers'];?>;
		var result = (joined_volunteers * 100) / required_volunteer;
		progressBar('#progress1 .au-bar', result);
		get_gallery();

	});


	Dropzone.options.FileManagerDropZone = {
        paramName: "file", 
        url: "<?= base_url("events/upload");?>?event_id=<?= $event_details[0]['id']; ?>",
        acceptedFiles: "image/*",
        maxFilesize: 50,
        init: function () {
            var _this = this;
            this.on("sending", function(file, xhr, data) {
                var filename = file.name;
                var filesize = file.size;
                console.log(filename);
               
            });
        },
        success: function(file, response){
            console.log("SUCCESS");
        },
        complete: function(response){
        	get_gallery();
        }
    }


    function get_gallery(){
    	var url = "<?= base_url("events/get_gallery");?>?event_id=<?= $event_details[0]['id']; ?>&limit=" + limit;
    	$.get(url, function(data) {
    		var html = "";
    		$.each(data, function(x, y){
    			html += '<div class="col-lg-3 col-md-6 col-6">';
				html += '	<a href="<?= base_url();?>'+y.path+'" data-toggle="lightbox" data-gallery="gallery" class="au-lnk au-plink">';
				html += '		<div class="au-opthumbnail">';
				html += '			<img src="<?= base_url();?>'+y.path+'" class="au-gl-thumbnailimg">';
				html += '		</div>';
				html += '	</a>';
				html += '</div>';
    		});

    		$("#gallery_photos").html(html);
		});
    }

    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});

    $(document).on("click", '#loadMore', function(event) {
		event.preventDefault();
		limit += 4;
		get_gallery();
	});

</script>