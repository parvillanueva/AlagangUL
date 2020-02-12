
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
						<a href="#" class="au-lnk" id="addTask_button"><span class="au-share"><i class="fas fa-plus"></i>Add Task</span></a>
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
						<?php if($event_details[0]['is_admin'] == 1){ ?>
						<form class="dropzone" id="FileManagerDropZone">
			                <div class="fallback">
			                    <input name="file" type="file" multiple />
			                </div>
			            </form>
						<?php } ?>
						<div class="row" id="gallery_photos"></div>
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
						<div class="col"><button class="au-btn float-right" id="addtestimonial_button"><i class="fas fa-plus"></i>Add Testimonial</button></div>
					</div>
					<div class="row">
						<div class="col au-testimonialwrapper">
							<div class="row" id="testimonial_div"></div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>

<div class="modal fade text-center" id="addtestimonial">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<span class="au-h4">Write a testimonial</span>
				<form action="eventdetail.html" class="au-form text-left" id="testimonial">		
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p3">Content</label>
							<textarea class="form-control" rows="5" id="testimonial_comment" placeholder="" required=""></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>	

					<div class="au-modalbtn text-center">
						<button type="button" class="au-btn au-btnyellow" id="btnTestimonial_close" data-dismiss="modal">Close</button>
						<button type="button" class="au-btn" id="btnTestimonial">Submit</button>
					</div>
				</form>		
			</div>
		</div>
	</div>
</div>

<div class="modal fade text-center" id="addtask">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<span class="au-h4">Opportunities for volunteers to help</span>
				<form action="eventdetail.html" class="au-form text-left" id="testimonial">		
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Possible task for volunteers</label>
							<input class="form-control" rows="5" id="possible_volunteer" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Qualifications</label>
							<input class="form-control" rows="5" id="qualification" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Needed Volunteer</label>
							<input type="number" class="form-control" rows="5" id="needed" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Badges</label>
							<?php foreach($badges as $bloop){ ?>
								<input type="checkbox" style="margin-left:50px;" class="badges_input" id="<?php echo $bloop->name; ?>" value="<?php echo $bloop->id; ?>" name="badges[]" required="" /> <span class="au-btnvolunteertype" style="background-color:<?php echo $bloop->color; ?>" ><i class="<?php echo $bloop->icon; ?>" title="<?php echo $bloop->name; ?>"></i> <?php echo $bloop->name; ?></span><br/><br/>
							<?php } ?>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>

					<div class="au-modalbtn text-center">
						<button type="button" class="au-btn au-btnyellow" id="btnBadges_close" data-dismiss="modal">Close</button>
						<button type="button" class="au-btn" id="btnBadges">Submit</button>
					</div>
				</form>		
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	//$('input[name="date"]').daterangepicker();
</script>
<script type="text/javascript">

	$(document).on("click", "#addtestimonial_button", function(){
		$("#addtestimonial").modal("show");
	});
	
	$(document).on("click", "#addTask_button", function(){
		$("#addtask").modal("show");
	});


	var limit  = 4;
	$(document).ready(function() {
		var required_volunteer = <?= $event_details[0]['required_volunteer'];?>;
		var joined_volunteers = <?= $event_details[0]['joined_volunteers'];?>;
		var result = (joined_volunteers * 100) / required_volunteer;
		progressBar('#progress1 .au-bar', result);
		get_gallery();
		get_testimonial();

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
    		$.each(data.result, function(x, y){
    			html += '<div class="col-lg-3 col-md-6 col-6">';
				html += '	<div class="au-opthumbnail au-lnk au-plink">';
				html += '		<a href="<?= base_url();?>'+y.path+'" data-toggle="lightbox" data-gallery="gallery" class="">';
				html += '			<img src="<?= base_url();?>'+y.path+'" class="au-gl-thumbnailimg">';
				html += '		</a>';
				html += '		<div class="au-gltitle" style="text-align:right; cursor:pointer"><font color="red"><span class="fa fa-trash" path-url= "'+y.path+'" path-id="'+y.id+'" id="delete_image"></span></font></div>';
				html += '	</div>';
				html += '</div>';
    		});

    		$("#gallery_photos").html(html);
			count_image(data.count);
		});
    }
	
	function get_testimonial(){
		var url = "<?= base_url("site/events/get_testimonial");?>?event_id=<?= $event_details[0]['id']; ?>&limit=" + limit;
		$.get(url, function(data) {
    		var html = "";
    		$.each(data, function(x, y){
    			html += '<div class="col-lg-6 au-fullheight au-testimonialentry">';
				html += '	<div class="au-testimonial au-fullheight">';
				html += '		<div class="au-userentry">';
				html += '			<a href="profile.html" class="au-userentry">';
				html += '				<div class="au-inner">';
				html += '					<img src="<?php echo base_url("upload_file/'+y['picture']['email']+'/'+y['picture']['image_path']+'") ?>" class="au-avatar-lg">';
				html += '				</div>';
				html += '				<div class="au-inner">';
				html += '					<span class="au-accname">'+y['picture']['name']+'</span>';
				html += '					<span class="au-accvolunteer">';
				html += '						<div class="au-accvicon">';
				html += '							<i class="fas fa-hourglass au-time au-icon" title="Time"></i>';
				html += '							<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>';
				html += '							<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>';
				html += '						</div>';
				html += '					</span>';
				html += '				</div>';
				html += '			</a>';
				html += '		</div>';
				html += '		<span class="au-date">January 1, 2020 2:00PM</span>';
				html += '		<span class="au-p5">'+y['testimonial']+'</span>';
				html += '		<div class="text-right">';
				html += '			<a href="#" class="au-lnk"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="assets/img/au-workplace2.svg" alt="Workplace"></span></a>';
				html += '		</div>';
				html += '	</div>';
				html += '</div>';
    		});

    		$("#testimonial_div").html(html);
		});
	}
	
	$(document).on('click', '#btnTestimonial', function(result){
		var event_id = "<?php echo $event_details[0]['id'] ?>";
		var testimonial = $('#testimonial_comment').val();
		var url = "<?php echo base_url('site/events/testimonial_save') ?>";
		var data = {
			event_id : event_id,
			testimonial : testimonial
		};
		aJax.post(url, data, function(result){
			var obj = is_json(result);
			if(obj.responce == 'success'){
				$("#addtestimonial").modal('hide');
				$('#testimonial_comment').val('');
				get_testimonial();
			}
		});
	});
	
	$(document).on('click', '#btnBadges', function(result){
		var possible_volunteer = $('#possible_volunteer').val();
		var qualification = $('#qualification').val();
		var needed = $('#needed').val();
		var val_badges = [];
        $('.badges_input:checkbox:checked').each(function(i){
          val_badges[i] = $(this).val();
        });
		var data = {
			event_id : "<?= $event_details[0]['id']; ?>",
			possible_volunteer : possible_volunteer,
			qualification : qualification,
			needed : needed,
			badges : val_badges
		};
		var url = "<?php echo base_urL('site/events/add_event_task') ?>";
		aJax.post(url, data, function(result){
			var obj = is_json(result);
			if(obj.responce == 'success'){
				$('#possible_volunteer').val('');
				$('#needed').val('');
				$('#qualification').val('');
				$('.badges_input').prop('checked', false); 
				$("#addtask").modal('hide');
			}
		});
	});
	
	function count_image(total){
		var div_count = $('.au-opthumbnail').length;
		if(div_count == total){
			$('#loadMore').hide();
		}
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
	
	$(document).on('click', '#delete_image', function(){
		var path_url = $(this).attr('path-url');
		var path_id = $(this).attr('path-id');
		var data = {
			path : path_url,
			id : path_id
		};
		var url = "<?php echo base_url('site/events/delete_gallery_image') ?>";
		var modal_obj = '<?= $this->standard->confirm("confirm_delete"); ?>'; 
		modal.standard(modal_obj, function(result){
			if(result){
				aJax.post(url, data, function(result){
					var obj = is_json(result);
					if(obj.responce == 'success'){
						get_gallery();
					}
				});
			}
		});
	});

</script>