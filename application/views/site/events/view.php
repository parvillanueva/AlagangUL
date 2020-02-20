
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
		display: <?=($_SESSION['user_impersonate_token']=='') ? 'none;' : 'block;' ?>;
	}
	.volunteer .au-btnvolunteer {
		cursor: default;
	}
	.disabled_css {
		cursor: default;
	}
</style>
<div class="au-wrapper">
	<div class="container-fluid au-heading">
		<div class="au-container au-padding">
			<div class="au-programheading">
				<div class="au-evthumbnail">
					<img src="<?= $event_details[0]['image'];?>" class="au-fp-thumbnailimg" onerror="imgErrorEvent(this);">
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
							<!-- <a href="#" class="au-lnk" data-toggle="modal" data-target="#editEvent"><span class="au-share"><i class="fas fa-pen"></i> Edit Event</a> -->
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
							<img src="<?= base_url() . "/" . $value->icon_image;?>" class="au-imgbadge" title="<?= $value->name;?>">
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
												<img src="<?= $value['profile_image'];?>" class="au-avatar-lg" onerror="imgErrorProfile(this);">
											</div>
											<div class="au-inner">
												<span class="au-accname"><?= $value['user']; ?></span>
												<span class="au-accvolunteer">
													<div class="au-accvicon">
														<?php foreach ($value['badge'] as $a => $b) { ?>
															<img src="<?= base_url() . "/" . $b->icon_image;?>" class="au-imgbadge" title="<?= $b->name;?>">
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
										 		// print_r($event_details[0]['id']);
										 		// die
								?>
										<a href="<?= base_url(""). "volunteers/" .$event_details[0]['id'];?>"  class="au-btnvolunteer au-btnvolunteertype au-time primary btn_approve"  style="background-color:#1894e7; width:100%; text-align:center;">Manage</a>
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
									<img src="<?= $program_details[0]['image_thumbnail'];?>" class="au-fp-thumbnailimg" onerror="imgErrorEvent(this);">
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
										<th scope="col">Volunteer your:</th>
										<th scope="col">Possible task for volunteers</th>
										<th scope="col">Qualifications</th>
										<th scope="col">Needed</th>
										<th scope="col">Joined</th>
										<?php if($event_details[0]['is_admin'] == 1) { ?>
											<th scope="col" colspan="2">Actions</th>
										<?php } else{ ?>
										<th scope="col">Actions</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php
									 foreach ($event_task as $key => $value) {
									 		$is_disabled = '';
									 		$is_disabled_css = '';
									 		$x = 0;
									 		if($value['required_volunteers']<=$value['joined_volunteers'] || $event_details[0]['is_joined']==1 || $event_details[0]['is_not_joined']==1 || $event_details[0]['is_admin']==1){ 
									 			$is_disabled = 'disabled';
									 			$is_disabled_css = 'disabled_css';
									 			$x = 1;
									 			if($event_details[0]['is_joined']==1 && $value['user_id_joined']==1){
									 				$is_disabled_css = '';
									 			}
									 			
									 		}
									 	?>
										<tr class="forvolunteer <?=($value['user_id_joined']==1 ) ? 'volunteer' : ''?> vol-id<?=$value['id']?> <?=($is_disabled_css!='') ? $is_disabled : ''?>" attr-id="<?=$value['id']?>" <?=$is_disabled?>>
											<td data-header="Volunteer your:" class="au-actions">
												<?php
													$badge_count = count($value['task_badge']);
													if($badge_count>0){
												?>
												<?php foreach ($value['task_badge'] as $key => $badge) {
												?>
												<img src="<?=base_url().$badge->image?>" class="au-btnicon">
												<?php } ?>
												<?php $htm = ''; ?>
												<?php 	
												$htm .= '<span class="au-btnvolunteertype"><i class="'.$badge->icon.'" title="'.$badge->name.'" style="color:'.$badge->color.'"></i><b style="color:'.$badge->color.'">'.$badge->name.'</b></span>';
												?>
												<!--  <button class="event-volunteer au-btnvolunteer au-btnvolunteer-<?=$badge_count?> <?=$is_disabled_css?>" attr-id="<?=$value['id']?>" attr-isjoined="<?=$value['user_id_joined']?> <?=$is_disabled?>" <?=$is_disabled?>>
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
												</button>  -->

												<?php }?>

												<div style="display: none" class="badge-hid hid-id-<?=$value['id']?>">
													<?=$htm?>
												</div>
												
											</td>
											<td data-header="Task"><?= $value['task'];?></td>
											<td data-header="Qualifications"><?= $value['qualification'];?></td>
											<td data-header="Needed"><?= $value['required_volunteers'];?></td>
											<td data-header="Joined" class="joined-<?=$value['id']?>"><?= $value['joined_volunteers'];?></td>
											<td>												
												<button class="<?=($x==0) ? 'event-volunteer' : '' ?> au-btnvolunteer au-btn au-btnvolunteer-<?=$badge_count?> <?=$is_disabled_css?>" attr-id="<?=$value['id']?>" attr-isjoined="<?=$value['user_id_joined']?>">
													<?=($value['user_id_joined']==1) ? 'Joined' : 'Join' ?>
												</button>
											</td>

											<?php if($event_details[0]['is_admin'] == 1) { ?>
											<td data-header="Actions:" class="au-actions">
												<a href="#"  data-toggle="modal" data-id = "<?=$value['id']?>" data-target="#editTask" id="btn_edit_task" class="au-lnk au-action" title="Edit Details"><i class="fas fa-edit"></i></a>
												<a href="#" id="btn_delete"  data-id = "<?=$value['id']?>"  class="au-lnk au-action" title="Delete"><i class="fas fa-times"></i></a>
											</td>
											<?php } ?>

										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col">
							<div class="input-group">
								<span class="au-h4">Gallery</span>
								<?php if($event_details[0]['is_joined'] == 1 || $event_details[0]['is_admin'] == 1){ ?>
								<div class="col" style="margin-right:-15px !important"><button class="au-btn float-right" id="button_dropzone"><i class="fas fa-plus"></i>Upload Photos</button></div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="au-gallerywrapper">
						<?php if($event_details[0]['is_joined'] == 1 || $event_details[0]['is_admin'] == 1){ ?>
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
            <span class="au-h4">Edit Event</span>
      			<form action="<?= base_url("programs/") . $program_details[0]['id'] . "/" . $program_details[0]['url_alias'] . "/event/" . $event_details[0]['id'] . "/" . $event_details[0]['url_alias'] . "/update";?>" method="post" enctype="multipart/form-data" class="au-form" id="addEventForm">
	        		<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="eventImage" id="customFile" onchange="readURLImgStandardPreviewEvent(this);" accept="image/x-png,image/jpeg" />
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
	        		<div class="form-row" hidden>
						<div class="col">											
							<input type="number" class="form-control required_input no_html" id="lname" value="<?= $event_details[0]['volunteer_points'];?>" placeholder="Add Points" name="eventPoints" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<!-- <div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="lname" placeholder="Event Overview" name="overview" rows=5><?= $event_details[0]['description'];?></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div> -->
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

<div class="modal fade text-center" id="events_edit_event_modal" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
        		<div class="form-row">
					<div class="col">
							<label class="file-label" >Are you sure you want to Update this record?</label>
					</div>
				</div>
				<div class="au-modalbtn text-center">
                    <button type="button" class="au-btn au-btnyellow" id="btn_events_edit_dismiss" data-dismiss="modal">No</button>
                    <button type="button" class="au-btn" id="btn_events_edit_confirm">Yes</button>
                </div>
        </div>
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
				<hr>
				<form>
					<div class="form-row au-terms">
						<div class="col">
		      				<label class="form-check-label">
		        				<input class="form-check-input is_agree_checkbox" type="checkbox" name="terms" required=""> I have read and understood the <a href="#" class="au-lnk event-guidelines" data-toggle="modal" data-target="#eventdetails">Guidelines</a>.
			        			<div class="valid-feedback"></div>
			        			<div class="invalid-feedback"></div>
		      				</label>
		      				
		      			</div>
		      			<span class="au-p6 au-errormessage"><i class="fas fa-exclamation-triangle"></i> Please read and agree to the event guidelines above.</span>
	    			</div>
					<div class="au-modalbtn text-center">
						<button type="button" class="au-btn au-btnyellow" data-dismiss="modal" attr-submit="0">No, I made a mistake</button>
						<button type="button" class="au-btn volunteer-as" attr-submit="1">Yes, sign me up!</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade text-center" id="eventdetails">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<span class="au-h4"><?=$guidelines[0]->title?></span>
					<div class="au-inner au-cscroll au-guidelines text-left">
						<?=$guidelines[0]->description?>
					</div>
					<div class="au-modalbtn text-center">
						<button type="button" class="au-btn au-btnyellow au-guidlinebtn guidelinebtn" data-dismiss="modal" attr-data="0">I disagree</button>
						<button type="button" class="au-btn au-guidlinebtn guidelinebtn" data-dismiss="modal" attr-data="1">I agree</button>
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
							<textarea class="form-control required_input no_html" rows="5" id="testimonial_comment" placeholder="" required=""></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>	
					<div class="au-modalbtn text-center">
						<button type="button" class="au-btn au-btnyellow" id="btnTestimonial_close" data-dismiss="modal">Close</button>
						<button type="button" class="au-btn" id="btnTestimonial_submit">Submit</button>
					</div>
				</form>		
			</div>
		</div>
	</div>
</div>

<div class="modal fade text-center modal2" id="addtask" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<span class="au-h4">Opportunities for volunteers to help</span>
				<form class="au-form text-left" id="volunteer_form">		
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Possible task for volunteers</label>
							<input class="form-control required_input reset_data" rows="5" id="possible_volunteer" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Qualifications</label>
							<input class="form-control required_input reset_data" rows="5" id="qualification" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Needed Volunteer</label>
							<input type="number" class="form-control required_input reset_data" rows="5" id="needed" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Badges</label>
							<?php foreach($badges as $bloop){ ?>
								<input type="checkbox" style="margin-left:50px;" class="badges_input reset_badge" id="<?php echo $bloop->name; ?>" value="<?php echo $bloop->id; ?>" name="badges[]" required="" /> <span class="au-btnvolunteertype" style="background-color:<?php echo $bloop->color; ?>" ><i class="<?php echo $bloop->icon; ?>" title="<?php echo $bloop->name; ?>"></i> <?php echo $bloop->name; ?></span><br/><br/>
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

<div class="modal fade text-center" id="editTask">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<span class="au-h4">Opportunities for volunteers to help</span>
				<form class="au-form text-left" id="edit_volunteer_form">		
					<input type="hidden" id="table_id" value=""/>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Possible task for volunteers</label>
							<input class="form-control required_input" rows="5" id="edit_possible_volunteer" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Qualifications</label>
							<input class="form-control required_input" rows="5" id="edit_qualification" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Needed Volunteer</label>
							<input type="number" class="form-control required_input" rows="5" id="edit_needed" placeholder="" required="" />
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="comment" class="au-p4">Badges</label>
							<?php foreach($badges as $bloop){ ?>
								<input type="checkbox" style="margin-left:50px;" class="badges_input edit_<?php echo $bloop->id; ?>" id="edit_<?php echo $bloop->name; ?>" value="<?php echo $bloop->id; ?>" name="badges[]" required="" /> <span class="au-btnvolunteertype" style="background-color:<?php echo $bloop->color; ?>" ><i class="<?php echo $bloop->icon; ?>" title="<?php echo $bloop->name; ?>"></i> <?php echo $bloop->name; ?></span><br/><br/>
							<?php } ?>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>

					<div class="au-modalbtn text-center">
						<button type="button" class="au-btn au-btnyellow" id="tbtneditBadges_close" data-dismiss="modal">Close</button>
						<button type="button" class="au-btn" id="btn_editBadges">Submit</button>
					</div>
				</form>		
			</div>
		</div>
	</div>
</div>

<div class="modal fade text-center" id="addtask_confirm_modal" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
        		<div class="form-row">
					<div class="col">
							<label class="file-label" >Are you sure you want to Add this record?</label>
					</div>
				</div>
				<div class="au-modalbtn text-center">
                    <button type="button" class="au-btn au-btnyellow" id="btn_addtask_dismiss" data-dismiss="modal">No</button>
                    <button type="button" class="au-btn" id="btn_addtask_confirm">Yes</button>
                </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?= base_url();?>/assets/site/js/bootstrap-show-modal.js"></script>

<script type="text/javascript">
	//$('input[name="date"]').daterangepicker();
	$(document).ready(function(){
		$('#FileManagerDropZone').hide();
	});
	$(document).on('click', '#button_dropzone', function(){
		$('#FileManagerDropZone').click();
	});
</script>
<script type="text/javascript">
	var base_url = '<?=base_url();?>';
	var datatoday = new Date();
	var datatodays = datatoday.setDate(new Date(datatoday).getDate() + 1);
	var count_checked = 0;

    function imgErrorEvent(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/broken_img2.jpg";
        return true;
    }

    function imgErrorProfile(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/au-avatar.svg";
        return true;
    }

	$('#whenpicker').datetimepicker({
	    controlType: 'select',
	    setDate: '<?= $event_details[0]['when'];?>',
	    minDate: datatoday,
	    oneLine: true,
	    timeFormat: 'hh:mm tt'
	});

	$(document).on('click', '#btnSubmitEvent', function(e){
		e.preventDefault();
		if(validate.standard('addEventForm')){
			$("#editEvent").css('opacity',0.5);
			$("#events_edit_event_modal").modal("show");
		}else{
			$('.required_input').each(function(){
				if($(this).val() == null || $(this).val() == ""){
					$('.au-form .custom-file-label').css('border-color','');
					$(this).css('border-color','red');
				}
			});
		}
	});

	$(document).on('click', '#btn_events_edit_confirm', function(e){
		e.preventDefault();
			$("#addEventForm").submit();
			$("#editEvent").css('opacity',1);
			$("#events_edit_event_modal").modal("hide");
	});


	$(document).on('click', '#btn_events_edit_dismiss', function(e){
		e.preventDefault();
			$("#editEvent").css('opacity',1);
			$("#editEvent").css('overflow','scroll');
			$("#events_edit_event_modal").modal("hide");
	});

	$(document).on("click", "#addtestimonial_button", function(){
		$("#addtestimonial").modal("show");
	});
	
	$(document).on("click", "#addTask_button", function(){
		count_checked = 0;
		$("#addtask").modal("show");
		// $("#addtask").reload();

	});
	
	$(document).on('click','#btnTestimonial_close',function(){
		$('.validate_error_message').hide();
		$('#testimonial_comment').val('');
		$('#testimonial_comment').css('border-color','#ced4da');
	});


	$(document).on("click", "#btn_delete", function(){
		id = $(this).attr('data-id');
            $.ajax({
                type : "POST",
                url  :  "<?= base_url('site/events/delete_task_data');?>",
                dataType : "JSON",
                data : {id:id},
                  beforeSend: function() {
                  },
                  success: function(data) {
                  },
                  complete: function(data){
                    var obj = data.responseJSON;
                    if(obj == true){
                    	location.reload();
                    }
                  }
            });
	});

	$(document).on("click", "#btn_edit_task", function(){
		$("#editTask").trigger("reset");
		id = $(this).attr('data-id');
            $.ajax({
                type : "POST",
                url  :  "<?= base_url('site/events/get_task_data');?>",
                dataType : "JSON",
                data : {id:id},
                  beforeSend: function() {
                  },
                  success: function(data) {
                  },
                  complete: function(data){
                    var obj = data.responseJSON;
                   	$.each(obj, function(x,y){
                   		$('#table_id').val(y['id']);
                   		$('#edit_possible_volunteer').val(y['task']);
                   		$('#edit_qualification').val(y['qualification']);
                   		$('#edit_needed').val(y['required_volunteers']);
                   		$.each(y[0],function(a,b){
                   			console.log(b)
                   			name = '.edit_'+b["id"];
                   			$(name).attr("checked", true);
                   		});
                   		count_checked = y[0].length
                   		if(count_checked == 2){
                   			$(".badges_input:not(:checked)").attr('disabled', true);
                   		}
                   		else{
                   			$(".badges_input:not(:checked)").attr('disabled', true);

                   		}
                   	});
                  }
            });
	});
	var limit  = 4;
	$(document).ready(function() {
		var required_volunteer = <?= $event_details[0]['required_volunteer'];?>;
		var joined_volunteers = <?= $event_details[0]['joined_volunteers'];?>;
		var result = (joined_volunteers * 100) / required_volunteer;
		//progressBar('#progress1 .au-bar', result);
		get_gallery();
		get_testimonial();

		$(document).on('click', '.event-guidelines', function() {
			$('#volunteermodal').modal('hide');
		});	

		$(document).on('click', '.is_agree_checkbox', function() {
			if($(this).is(':checked')){
				$('.au-errormessage').hide();
			}
		});

		$(document).on('click', '.guidelinebtn', function() {
			var is_agree = $(this).attr('attr-data');
			if(is_agree==1){
				$('.is_agree_checkbox').attr('checked',true);
			}
			else{
				$('.is_agree_checkbox').attr('checked',false);
			}
			$('#volunteermodal').modal('show');
		});

		$(document).on('click', '.event-volunteer', function() {
			
			var task = $(this).closest('tr').children(':nth-child(2)').html();
			var event_task_id = $(this).attr('attr-id');
			var is_joined = $(this).attr('attr-isjoined');
			var volunteer_type = $('.hid-id-'+event_task_id).html();
			$('.volunteer-as').attr('attr-id',event_task_id).attr('attr-isjoined',is_joined);
			$('.au-yourvolunteer').html(volunteer_type);
			$('.volunteer-task').html(task);
			$('#volunteermodal').modal('show');
			$('.au-errormessage').hide();
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

			if($('.is_agree_checkbox').is(':checked')){
				var url = "<?= base_url("events/volunteer");?>?program_id="+program_id+"&event_id="+event_id+"&event_task_id="+event_task_id+"&is_submit="+is_submit;
		    	$.get(url, function(data) {
		    		$('#volunteermodal').modal('hide');
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
			else{
				$('.au-errormessage').show();
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
			this.on("addedfile", function(file) {
				//BM.confirm("Are you sure you wan't to upload this photos?", function(result){
					//if(result){
						this.on("sending", function(file, xhr, data) {
							var filename = file.name;
							var filesize = file.size;  
							BM.loading(true);
						});
					//} else{
						//this.removeFile(file);
					//}
				//})
				/* if(!confirm("Do you want to upload this file?")){
					this.removeFile(file);
					return false;
				}
				BM.loading(true); */
			});
        },
        success: function(file, response){
			//$('#gallery_photos_name').val(file.name);
            this.removeFile(file);
			BM.loading(false);
        },
        complete: function(response){
        	get_gallery();
        }
    }


    function get_gallery(){
    	var url = "<?= base_url("events/get_gallery");?>?event_id=<?= $event_details[0]['id']; ?>&limit=" + limit;
		var is_admin = "<?= $event_details[0]['is_admin'] ?>";
		var is_joined = "<?= $event_details[0]['is_joined'] ?>";
    	$.get(url, function(data) {
    		var html = "";
    		$.each(data.result, function(x, y){
    			html += '<div class="col-lg-3 col-md-6 col-6">';
				html += '	<div class="au-opthumbnail au-lnk au-plink">';
				html += '		<a href="<?= base_url();?>'+y.path+'" data-toggle="lightbox" data-gallery="gallery" class="toggle_image">';
				html += '			<img src="<?= base_url();?>'+y.path+'" class="au-gl-thumbnailimg img-fluid" onerror="imgErrorEvent(this);">';
				html += '		</a>';
				if(is_admin == 1 || is_joined == 1){
					html += '		<div class="au-gltitle" style="text-align:right; cursor:pointer"><font color="red"><span class="fa fa-trash" path-url= "'+y.path+'" path-id="'+y.id+'" id="delete_image"></span></font></div>';
				}
				html += '	</div>';
				html += '</div>';
    		});

    		$("#gallery_photos").html(html);
			count_image(data.count);
		});
    }
	
	$(document).on("click", '[data-toggle="lightbox"]', function(event){
		event.preventDefault();
		$(this).ekkoLightbox();
	});
	
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
				html += '					<img src="<?php echo base_url("'+y['picture']['image_path']+'") ?>" class="au-avatar-lg" onerror="imgErrorProfile(this);">';
				html += '				</div>';
				html += '				<div class="au-inner">';
				html += '					<span class="au-accname">'+y['picture']['name']+'</span>';
				html += '					<span class="au-accvolunteer">';
				html += '						<div class="au-accvicon">';
					$.each(y['badge'], function(a, b){
						html += '				<img src="<?= base_url();?>/'+b.icon_image+'" class="au-imgbadge" title="'+b.name+'">';
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
	
	$(document).on('click', '.badges_input', function(){
		if($(this).is(':checked')){
			 count_checked = $('.badges_input:checked').length;
			if(count_checked == 2){
				$(".badges_input:not(:checked)").attr('disabled', true);
			}
		} else{
			var count_checked_un = $('.badges_input:checked').length;
			if(count_checked_un < 2){
				$(".badges_input:not(:checked)").attr('disabled', false);
			}
		}
	});
	
	$(document).on('click', '#btnTestimonial_submit', function(){
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


		if(validate.standard('volunteer_form')){
			$("#addtask").css('opacity',0.5);
			$("#addtask_confirm_modal").modal("show");

		}else{
			$('.required_input').each(function(){
				if($(this).val() == null || $(this).val() == ""){
					$(this).css('border-color','red');
				}
			});

		}
	});

	$(document).on('click', '#btn_addtask_confirm', function(e){
		e.preventDefault();
			add_task();
			$("#addtask").css('opacity',1);
			$("#addtask_confirm_modal").modal("hide");
	});

	$(document).on('click', '#btn_addtask_dismiss', function(e){
		e.preventDefault();
			$("#addtask").css('opacity',1);
			$("#addtask").css('overflow','scroll');
			$("#addtask_confirm_modal").modal("hide");
	});
	
	function count_image(total){
		var div_count = $('.au-opthumbnail').length;
		if(div_count == total){
			$('#loadMore').hide();
		}
	}

	function add_task(){
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
	}

	$(document).on('click', '#btn_editBadges', function(result){
		var possible_volunteer = $('#edit_possible_volunteer').val();
		var qualification = $('#edit_qualification').val();
		var needed = $('#edit_needed').val();
		var id = $('#table_id').val();
		var val_badges = [];
        $('.badges_input:checkbox:checked').each(function(i){
          val_badges[i] = $(this).val();
        });
		var data = {
			event_id : "<?= $event_details[0]['id']; ?>",
			possible_volunteer : possible_volunteer,
			qualification : qualification,
			needed : needed,
			badges : val_badges,
			task_id	: id
		};
		var url = "<?php echo base_urL('site/events/update_event_task') ?>";
		if(validate.standard("edit_volunteer_form")){
			aJax.post(url, data, function(result){
				var obj = is_json(result);
				if(obj.responce == 'success'){
					location.reload();
				}
			});
		}
	});
/* 	function count_image(total){
		var div_count = $('.au-opthumbnail').length;
		if(div_count == total){
			$('#loadMore').hide();
		}

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
	} */

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
		BM.confirm('Are you sure?', function(results){
			if(results){
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

    $(document).on('click','#btnBadges_close',function(){
    		$('.reset_data').css('border-color','');
    		$('.validate_error_message').remove();
	        $('.reset_badge').each(function(i){
	           $(this).attr("disabled",false)
	           $(this).prop("checked", false);
	        });
    		
    		count_checked = 0;
    });
</script>