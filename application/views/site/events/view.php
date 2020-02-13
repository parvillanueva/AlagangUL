
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
	.disabled_css .au-btnvolunteertype {
		background-color: #cfd8dc !important;
	}
	.au-yourvolunteer .au-btnvolunteertype {
		font-size: 18px;
	}
	.au-yourvolunteer .au-btnvolunteertype {
		width: auto;
	}
	.share-wp {
		display: <?=($_SESSION['user_impersonate_token']=='') ? 'hidden' : 'block' ?>;
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
						<?php
							if($_SESSION['user_impersonate_token']!=''){
						?>
						<a href="#" class="au-lnk workplace-share"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="<?= base_url();?>assets/site/img/au-workplace.svg" alt="Workplace"></span></a>
						<?php } ?>						
						<?php if($event_details[0]['is_admin'] == 1){ ?>
							<?php
							$current_date = date('Y-m-d');
							$data_date = date("Y-m-d", strtotime($event_details[0]['when']));
							if($data_date == $current_date || $data_date > $current_date){ ?>
							<a href="#" class="au-lnk" id="addTask_button"><span class="au-share"><i class="fas fa-plus"></i>Add Task</span></a>
							<a href="#" class="au-lnk" data-toggle="modal" data-target="#editEvent"><span class="au-share"><i class="fas fa-pen"></i> Edit Event</a>
							<?php
								if(count($event_task)>0){
							 	if($event_details[0]['status'] == 0) { ?>
								<a href="<?= base_url("programs/").$program_details[0]['id']."/".$program_details[0]['url_alias']."/event/" . $event_details[0]['id'] . "/" . $event_details[0]['url_alias'] . "/publish/1";?>" class="au-lnk pub-program"><span class="au-share"><i class="fas fa-check"></i> Publish Event</span></a>
							<?php }else{ ?>
								<a href="<?= base_url("programs/").$program_details[0]['id']."/".$program_details[0]['url_alias']."/event/" . $event_details[0]['id'] . "/" . $event_details[0]['url_alias']. "/publish/0";?>" class="au-lnk pub-program"><span class="au-share"><i class="fas fa-minus"></i> Unpublish Event</span></a>
							<?php } }?>	
						<?php } }?>
					</div>
					<div class="au-badges">
						<span class="au-pb">Badges you can earn</span>
						<?php foreach ($earn_badge as $key => $value) { ?>
							<div class="au-badge"><i style="color: <?= $value->color;?>" class="<?= $value->icon;?> au-time au-icon" title="<?= $value->name;?>"></i></div>
						<?php } ?>
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
										<a href="<?= base_url('profile') ?>/<?= $value['user_id'];?>" class="au-userentry">
											<div class="au-inner">
												<img src="<?= $value['profile_image'];?>" class="au-avatar-lg">
											</div>
											<div class="au-inner">
												<span class="au-accname"><?= $value['user']; ?></span>
												<span class="au-accvolunteer">
													<div class="au-accvicon">
														<?php foreach ($value['badge'] as $a => $b) { ?>
															<i style="color: <?= $b->color;?>" class="<?= $b->icon;?> au-time au-icon" title="<?= $b->name;?>"></i>
														<?php } ?>
													</div>
												</span>	
											</div>
										</a>
									</div>
								<?php } ?>
							</div>
								<div class="au-inner au-cscroll">
								<?php 	if(count($event_volunteers) > 0) { 
										 	if($event_details[0]['is_admin'] == 1){
								?>php
										<a href="<?= $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>/manage"   class="au-btnvolunteer au-btnvolunteertype au-time primary btn_approve"  style="background-color:#1894e7; width:100%; text-align:center;">Manage</a>
								<?php		 		
										 	}
										}
								?>		
								</div>
							
						</div>
					</div>

				</div>
				<div class="col-lg-9 col-md-8">
					<div class="au-programdetailsinside">
						<div class="au-inner">
							<a href="<?= base_url("programs") . "/" . $program_details[0]['id'] . "/" . $program_details[0]['url_alias'];?>" class="au-lnk">
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
									<?php
									 $is_disabled = '';
									 $is_disabled_css = '';
									 $x = 0;
									 if($is_allowed_to_volunteer==1 || $event_details[0]['is_admin']){
									 	$x =1;
									 	$is_disabled = 'disabled';
									 	$is_disabled_css = 'disabled_css';
									 }
									 foreach ($event_task as $key => $value) { ?>
									 	<?php
									 		if($value['required_volunteers']<=$value['joined_volunteers'] && $value['user_id_joined']!=1){
									 			$is_disabled = 'disabled';
									 			$is_disabled_css = 'disabled_css';
									 		}
									 		else{
									 			if($x==0){
									 				$is_disabled = '';
									 				$is_disabled_css = '';
									 			}
									 			else{
									 				$is_disabled = 'disabled';
									 				$is_disabled_css = 'disabled_css';
									 			}
									 		}
									 	?>
										<tr class="forvolunteer <?=($value['user_id_joined']==1) ? 'volunteer' : ''?> vol-id<?=$value['id']?>" attr-id="<?=$value['id']?>">
											<td data-header="Task"><?= $value['task'];?></td>
											<td data-header="Qualifications"><?= $value['qualification'];?></td>
											<td data-header="Needed"><?= $value['required_volunteers'];?></td>
											<td data-header="Joined" class="joined-<?=$value['id']?>"><?= $value['joined_volunteers'];?></td>
											<td data-header="Volunteer your:" class="au-actions">
												<?php
													$badge_count = count($value['task_badge']);
													if($badge_count>0){
												?>
												<button class="event-volunteer au-btnvolunteer au-btnvolunteer-<?=$badge_count?> <?=$is_disabled_css?>" attr-id="<?=$value['id']?>" attr-isjoined="<?=$value['user_id_joined']?>" <?=$is_disabled?>>
												<?php $htm = ''; ?>
												<?php foreach ($value['task_badge'] as $key => $badge) {
												?>
													<span class="au-btnvolunteertype" style="background-color:<?=$badge->color?>">
													<i class="<?=$badge->icon?>" title="<?=$badge->name?>"></i><?=$badge->name?></span>
												<?php 	
												$htm .= '<span class="au-btnvolunteertype"><i class="'.$badge->icon.'" title="'.$badge->name.'" style="color:'.$badge->color.'"></i><b style="color:'.$badge->color.'">'.$badge->name.'</b></span>';
												?>
												<?php
													if($badge_count> ($key+1) ){
												?>
												<i class="fas fa-plus au-plus"></i>
												<?php } ?>
												<?php } ?>
												</button>
												<?php }?>

												<div style="display: none" class="badge-hid">
													<?=$htm?>
												</div>
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
						<?php if($validate_testimonial == 'not_empty'){ ?>
							<div class="col"><button class="au-btn float-right" id="addtestimonial_button"><i class="fas fa-plus"></i>Add Testimonial</button></div>	
						<?php } ?>
						
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

<!-- Add Event Modal -->
<div class="modal fade text-center" id="editEvent" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <span class="au-h4">Add Event</span>
      			<form action="<?= base_url("programs/") . $program_details[0]['id'] . "/" . $program_details[0]['url_alias'] . "/event/" . $event_details[0]['id'] . "/" . $event_details[0]['url_alias'] . "/update";?>" method="post" enctype="multipart/form-data" class="au-form" id="addEventForm">
	        		<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="eventImage" id="customFile" onchange="readURLImgStandardPreviewEvent(this);" accept="image/x-png,image/gif,image/jpeg" />
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<img  style="width: 100%;" src="<?= $event_details[0]['image'];?>" id="previewImageEvent"/>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" value="<?= $event_details[0]['title'];?>" placeholder="Event Title" name="eventTitle" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="whenpicker" value="<?= date("m/d/Y h:i a", strtotime($event_details[0]['when']));?>"  placeholder="When" name="eventWhen" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" value="<?= $event_details[0]['where'];?>" placeholder="Where" name="eventWhere" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="number" class="form-control required_input no_html" id="lname" value="<?= $event_details[0]['volunteer_points'];?>" placeholder="Add Points" name="eventPoints" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="lname" placeholder="Event Overview" name="overview" rows=5><?= $event_details[0]['description'];?></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="au-modalbtn text-center">
	                    <button type="button" class="au-btn au-btnyellow" data-dismiss="modal">Close</button>
	                    <button type="button" class="au-btn" id="btnSubmitEvent">Submit</button>
	                </div>
				</form>
      		</div>
      		<!-- <div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="button" class="btn btn-primary" id="btnSubmit">Save changes</button>
     		</div> -->
    	</div>
  	</div>
</div>

<div class="modal fade text-center" id="volunteermodal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<span class="au-h4">We have a volunteer!</span>
				<span class="au-p6">Thank you for your intent to volunteer your:</span>
				<div class="au-yourvolunteer">
					
				</div>
				<span class="au-p6">as a:</span>
				<span class="au-p4 volunteer-task"></span>
				<span class="au-p6">is this correct?</span>
				<div class="au-modalbtn text-center">
					<button type="button" class="au-btn au-btnyellow volunteer-as" data-dismiss="modal" attr-submit="0" >No, I made a mistake</button>
					<button type="button" class="au-btn volunteer-as" data-dismiss="modal" attr-submit="1">Yes, sign me up!</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade text-center" id="volunteerthankyou" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<span class="au-h4">Thank you!</span>
				<span class="au-p6">Your help is greatly appreciated. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
				<div class="au-modalbtn text-center">
					<button type="button" class="au-btn close-btn" data-dismiss="modal">Close</button>
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
				<form class="au-form text-left" id="testimonial_form">		
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p3">Content</label>
							<textarea class="form-control required_input" rows="5" id="testimonial_comment" placeholder="" required=""></textarea>
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
				<form class="au-form text-left" id="volunteer_form">		
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Possible task for volunteers</label>
							<input class="form-control required_input" rows="5" id="possible_volunteer" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Qualifications</label>
							<input class="form-control required_input" rows="5" id="qualification" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Needed Volunteer</label>
							<input type="number" class="form-control required_input" rows="5" id="needed" placeholder="" required="" />
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

	var datatoday = new Date();
	var datatodays = datatoday.setDate(new Date(datatoday).getDate() + 1);


	$('#whenpicker').datetimepicker({
	    controlType: 'select',
	    setDate: '<?= $event_details[0]['when'];?>',
	    minDate: datatoday,
	    oneLine: true,
	    timeFormat: 'hh:mm tt'
	});

	$(document).on('click', '#btnSubmitEvent', function(e){
		e.preventDefault();
		if(validate.standard("addEventForm")){
			$("#addEventForm").submit();
		}
	});

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
		//progressBar('#progress1 .au-bar', result);
		get_gallery();
		get_testimonial();

		$(document).on('click', '.event-volunteer', function() {
			var volunterr_type = $(this).siblings('.badge-hid').html();
			var task = $(this).closest('tr').children(':first-child').html();
			var event_task_id = $(this).attr('attr-id');
			var is_joined = $(this).attr('attr-isjoined');
			$('.volunteer-as').attr('attr-id',event_task_id).attr('attr-isjoined',is_joined);
			$('.au-yourvolunteer').html(volunterr_type);
			$('.volunteer-task').html(task);
			$('#volunteermodal').modal('show');
		});

		$(document).on('click', '.close-btn', function() {
			location.reload();
		});

		$(document).on('click', '.volunteer-as', function() {
			var event_task_id = $(this).attr('attr-id');
			var is_submit = $(this).attr('attr-submit');
			var program_id = '<?=$program_id?>';
			var event_id = '<?=$event_id?>';	
			var is_joined = $(this).attr('attr-isjoined');

			if( is_submit==1 || (is_submit==0 && is_joined==1)){
				var url = "<?= base_url("events/volunteer");?>?program_id="+program_id+"&event_id="+event_id+"&event_task_id="+event_task_id+"&is_submit="+is_submit;
		    	$.get(url, function(data) {
		    		var vol_id = $('.volunteer').attr('attr-id');
		    		$('tr.forvolunteer').removeClass('volunteer'); 
		    		$('.event-volunteer').attr('attr-isjoined',0);
		    		$('.joined-'+vol_id).html(parseInt($('.joined-'+vol_id).html())-1);
		    		if(is_submit==1){
		    			$(".vol-id"+event_task_id).addClass('volunteer');
		    			$('.event-volunteer[attr-id="'+event_task_id+'"]').attr('attr-isjoined',1);
		    			$('.joined-'+event_task_id).html(parseInt($('.joined-'+event_task_id).html())+1);
		    			$('#volunteerthankyou').modal('show');
		    		}
		    		else{
		    			location.reload();
		    		}		    		
				});
			}

		});

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
		var is_admin = "<?= $event_details[0]['is_admin'] ?>";
    	$.get(url, function(data) {
    		var html = "";
    		$.each(data.result, function(x, y){
    			html += '<div class="col-lg-3 col-md-6 col-6">';
				html += '	<div class="au-opthumbnail au-lnk au-plink">';
				html += '		<a href="<?= base_url();?>'+y.path+'" data-toggle="lightbox" data-gallery="gallery" class="">';
				html += '			<img src="<?= base_url();?>'+y.path+'" class="au-gl-thumbnailimg">';
				html += '		</a>';
				if(is_admin == 1){
					html += '		<div class="au-gltitle" style="text-align:right; cursor:pointer"><font color="red"><span class="fa fa-trash" path-url= "'+y.path+'" path-id="'+y.id+'" id="delete_image"></span></font></div>';
				}
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
				html += '					<img src="<?php echo base_url("'+y['picture']['image_path']+'") ?>" class="au-avatar-lg">';
				html += '				</div>';
				html += '				<div class="au-inner">';
				html += '					<span class="au-accname">'+y['picture']['name']+'</span>';
				html += '					<span class="au-accvolunteer">';
				html += '						<div class="au-accvicon">';
					$.each(y['badge'], function(a, b){
						html += '					<i style="color: '+b.color+';" class="'+b.icon+' au-time au-icon" title="'+b.name+'"></i>';
					});
				html += '						</div>';
				html += '					</span>';
				html += '				</div>';
				html += '			</a>';
				html += '		</div>';
				html += '		<span class="au-date">'+y.date_posted+'</span>';
				html += '		<span class="au-p5">'+y['testimonial']+'</span>';
				html += '		<div class="text-right">';
				html += '			<a href="#" class="au-lnk"><span class="au-share share-wp"><i class="fas fa-share-alt"></i> Share on <img src="<?php echo base_url("assets/img/au-workplace2.svg")?>" alt="Workplace"></span></a>';
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
		if(validate.standard("testimonial_form")){
			aJax.post(url, data, function(result){
				var obj = is_json(result);
				if(obj.responce == 'success'){
					$("#addtestimonial").modal('hide');
					$('#testimonial_comment').val('');
					get_testimonial();
				}
			});
		}
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
		if(validate.standard("volunteer_form")){
			aJax.post(url, data, function(result){
				var obj = is_json(result);
				if(obj.responce == 'success'){
					$('#possible_volunteer').val('');
					$('#needed').val('');
					$('#qualification').val('');
					$('.badges_input').prop('checked', false); 
					$("#addtask").modal('hide');
					location.reload();
				}
			});
		}
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


	function readURLImgStandardPreviewEvent(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var extension = input.files[0].name.split('.').pop().toLowerCase();
                var base64 = e.target.result;
               	$("#previewImageEvent").attr("src",base64);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>