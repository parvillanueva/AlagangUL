<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<div class="au-programheading">
			<div class="au-phthumbnail">
				<img src="<?= base_url() . $details['details'][0]->image_thumbnail;?>" class="au-fp-thumbnailimg" onerror="imgErrorProgram(this);">
			</div>
			<div class="au-phdetails">
				<span class="au-h5" title="<?= $details['details'][0]->name; ?>">
					<?php 
						$str = $details['details'][0]->name;
						if (strlen($str) > 50){
							$str_out = substr($str, 0, 50) . '...';
							echo $str_out;
						} else{
							echo $str;
						}	
					?>
				</span>
				<div class="au-powner">
				    <a href="mailto:<?= @$details['admin_email'][0]->email_address;?>" class="au-lnk"><span class="au-share">Program Owner: <?= @$details['admin_email'][0]->first_name;?> <?= @$details['admin_email'][0]->last_name;?> <i class="fas fa-envelope"></i></span></a>
				</div>
				<div class="au-phstats">
					<span class="au-members"><i class="fas fa-user-friends"></i><?= $details['members_count'];?> <?= ($details['members_count'] > 1 ) ? 'Members' : 'Member';?></span>
					<?php
						if($_SESSION['user_impersonate_token']!=''){
					?>
					<a href="javascript:void(0)" class="au-lnk workplace-share"><span class="au-share"><i class="fas fa-share-alt"></i> Share on <img src="<?= base_url();?>assets/site/img/au-workplace.svg" alt="Workplace"></span></a>
					<?php } ?>
					<?php if($details['is_admin']) { ?>
						<!-- <a href="#" class="au-lnk" data-toggle="modal" data-target="#editPrgoramDetails"><span class="au-share"><i class="fas fa-pen"></i> Edit Details</a> -->
						<!-- <a href="#" class="au-lnk" data-toggle="modal" data-target="#addEvent"><span class="au-share"><i class="fas fa-calendar"></i> Add Events</a> -->
						
						<?php if($details['details'][0]->status == 0) { ?>
							<a href="<?= base_url("programs/") . $details['details'][0]->id . "/" . $details['details'][0]->url_alias . "/publish";?>" class="au-lnk pub-program"><span class="au-share"><i class="fas fa-check"></i> Publish Program</span></a>
						<?php }else{ ?>
							<a href="<?= base_url("programs/") . $details['details'][0]->id . "/" . $details['details'][0]->url_alias . "/unpublish";?>" class="au-lnk pub-program"><span class="au-share"><i class="fas fa-minus"></i> Unpublish Program</span></a>
						<?php } ?>						
						
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
				<div class="au-boxed au-memberslist">
					<div class="au-titlebox">Members</div>
					<div class="au-content">
						<div class="au-inner au-cscroll">
							<?php foreach ($details['members'] as $key => $value) { ?>
								<div class="au-userentry">
									<a href="<?= base_url('profile') ?>/<?= $value->used_id;?>" class="au-userentry">
										<div class="au-inner">
											<?php
												$profile_image = $value->profile_image;
												if($profile_image==null){
													if(!file_exists($profile_image)){
														$profile_image = base_url().'assets/site/img/au-avatar.svg';
													}
												}
											?>
											<img src="<?= $profile_image;?>" class="au-avatar-lg" onerror="imgErrorProfile(this);">
										</div>
										<div class="au-inner">
											<span class="au-accname"><?= $value->user;?></span>
											<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> <?= $value->current_pt;?> points</span>	
										</div>
									</a>
								</div>
							<?php } ?>
						</div>

					</div>
				</div>

				<div class="au-boxed">
					<div class="au-titlebox"><img src="<?= base_url();?>assets/site/img/au-workplace.svg" height="30px;"></div>
					<div class="au-content au-workplace" style="max-height: 400px;overflow: hidden;overflow-y: auto;padding: 5px;">
						<!-- insert facebook feed here -->
						<?php
							foreach ($workplace_feed as $key => $value) {
						?>
						<div class="row">
							
						
						<div class="col-md-12" style="margin-bottom:12px;border-bottom: 1px solid #9B9B9B;">
							<div class="col-md-2" style="float: left;padding: 0px;">
								<img src="<?=$value->post_by_img?>" style="width:92%;margin-right:2px;">
							</div>
							<div class="col-md-10" style="float: left;">
								<label style="font-weight:bold;"><?=$value->post_by?></label>
								<p style="font-size: 10px;"><?=date('F d, Y h:i A',strtotime($value->date_posted))?></p>
								<div class="row">
									<div class="col-md-12" style="padding-bottom:10px;margin-top:10px;">
										<a href="<?=$value->post_link?>">
											<?=$value->post_message?>
											<img src="<?=$value->post_image?>" style="width:100%;">
										</a>
									</div>
								</div>
							</div>
						</div>
						</div>
						<?php } ?>
						<!-- <iframe src="" class="au-frame"></iframe> -->
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-8">
				<div class="au-programdescription">
					<span class="au-p4"><?= $details['details'][0]->overview;?></span>
				</div>
				<hr>
				<!-- <div class="au-programdescription" hidden>
					<span class="au-title">Areas covered: <?= $details['details'][0]->area_covered;?></span>
				</div>
				<hr> -->
				<?php if(count($details['events']) == 0) { ?>
					<span class="au-h4">No Upcoming Events</span>
				<?php } else { ?>
					<span class="au-h4">Upcoming Events</span>
				<?php } ?>
				<div class="au-eventswrapper">
					<?php
						//echo "<pre>";
						//print_r($details['events']);
					?>
					<?php foreach ($details['events'] as $key => $value) { ?>
						<div class="au-event-entry vol-time vol-treasure vol-talent volunteered" id="progress1">
							<div class="au-event">
								<div class="row">
									<div class="col-sm-4 au-eventthumbnail">
										<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 10 points</span>
										<a href="<?= $value['link'];?>">
											<img src="<?= $value['image'];?>" class="au-eventimg" onerror="imgErrorEvent(this);">
										</a>
									</div>
									<div class="col-sm-8 au-eventdetails">
										<div class="au-program">
											<a href="<?= $value['link'];?>" class="au-lnk">
												<div class="au-pthumbnail">
													<img src="<?= base_url() . $details['details'][0]->image_thumbnail;?>" class="au-fp-thumbnailimg" onerror="imgErrorEvent(this);">
												</div>
												<span class="au-ptitle"><?= $value['title'];?></span>
												<!-- <span class="au-pdetails"><?= $value['description'];?></span> -->
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
										<!-- <div class="au-volunteers">
											<?php foreach ($value['get_earn_badge'] as $a => $b) { ?>
												<img src="<?= base_url() . "/" . $b->icon_image;?>" class="au-imgbadge" title="<?= $b->name;?>">
											<?php } ?>
										</div> -->
										<div class="au-action">
											<div class="row">
												<div class="col"><span class="au-needed"><?= $value['required_volunteer'] ;?> volunteers needed</span></div>
												<div class="col">
													<?php if($details['is_admin']) { ?>
														<!-- <?php if($value['status'] == 1) { ?>
															<button type="button" class="au-volunteered au-btnyellow float-right" style="background-color: #00b513;">Published</button>
														<?php } else { ?>
															<button type="button" class="au-volunteered au-btnyellow float-right">Unpublished</button>
														<?php } ?> -->
													<?php } else {
														if($value['required_volunteer']!=0 && $value['is_not_joined'] !=1){
															if(!$value['is_joined']){
													?>	
														<a href="<?= $value['link'];?>" class="au-volunteer au-btnyellow float-right" style="display: block">Volunteer</a>
														<?php } else { ?>

														<a href="<?= $value['link'];?>" class="au-volunteered au-btnyellow float-right">Volunteered</a>
													<?php } } } ?>
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

						{programs}
						<div class="col-lg-3 col-6">
							<a href="<?= base_url(); ?>programs/{id}/{url_alias}" class="au-lnk au-plink">
								<div class="au-opthumbnail">
									<img src="<?=base_url()?>{image_thumbnail}" class="au-fp-thumbnailimg" onerror="imgErrorProgram(this);" alt="{name}">
								</div>
							</a>
						</div>
				        {/programs}

					</div>
				</div>

			</div>
		</div>				
		

	</div>
</div>

<!-- Edit Details Modal -->
<div class="modal fade text-center" id="editPrgoramDetails" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <span class="au-h4">Edit Program</span>
      			<form action="<?= base_url("programs/") . $details['details'][0]->id . "/" . $details['details'][0]->url_alias . "/update";?>" method="post" enctype="multipart/form-data" class="au-form" id="editprogramform">
	        		<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="programImage" id="customFile" onchange="readURLImgStandardPreview(this);" accept="image/x-png,image/jpeg" />
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<img  style="width: 100%;" src="<?= base_url() . $details['details'][0]->image_thumbnail;?>" id="previewImage" onerror="imgErrorProgram(this);"/>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" placeholder="Program Name" name="programName" value="<?= $details['details'][0]->name;?>">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" placeholder="Areas Covered" name="areaCovered" value="<?= $details['details'][0]->area_covered;?>">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="lname" placeholder="Program Overview" name="overview" rows=5><?= $details['details'][0]->overview;?></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
					<div class="au-modalbtn text-center">
	                    <button type="button" class="au-btn au-btnyellow" data-dismiss="modal">Close</button>
	                    <button type="button" class="au-btn" id="btnSubmit">Submit</button>
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

<div class="modal fade text-center" id="program_confirm_modal" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
        		<div class="form-row">
					<div class="col">
							<label class="file-label" >Are you sure you want to Update this record?</label>
					</div>
				</div>
				<div class="au-modalbtn text-center">
                    <button type="button" class="au-btn au-btnyellow" id="btn_edit_dismiss" data-dismiss="modal">No</button>
                    <button type="button" class="au-btn" id="btn_edit_confirm">Yes</button>
                </div>
        </div>
    </div>
</div>
</div>

<!-- Add Event Modal -->
<div class="modal fade text-center" id="addEvent" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	        <div class="modal-body">
	            <span class="au-h4">Add Event</span>
	  			<form action="<?= base_url("programs/") . $details['details'][0]->id . "/" . $details['details'][0]->url_alias . "/add_event";?>" method="post" enctype="multipart/form-data" class="au-formm" id="addEventForm">
	        		<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input required_input" name="eventImage" id="customFile" onchange="readURLImgStandardPreviewEvent(this);" accept="image/x-png,image/jpeg" />
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<img  style="width: 100%;" src="" id="previewImageEvent"/>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" placeholder="Event Title" name="eventTitle" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="whenpicker" placeholder="When" name="eventWhen" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" placeholder="Where" name="eventWhere" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row" hidden>
						<div class="col">											
							<input type="number" class="form-control required_input no_html" id="lname" placeholder="Add Points" name="eventPoints" value="0">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<!-- <div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="lname" placeholder="Event Overview" name="overview" rows=5></textarea>
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
		</div>
	</div>
</div>

<div class="modal fade text-center" id="program_add_event_modal" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
        		<div class="form-row">
					<div class="col">
							<label class="file-label" >Are you sure you want to Add this record?</label>
					</div>
				</div>
				<div class="au-modalbtn text-center">
                    <button type="button" class="au-btn au-btnyellow" id="btn_add_event_dismiss" data-dismiss="modal">No</button>
                    <button type="button" class="au-btn" id="btn_add_event_confirm">Yes</button>
                </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
	var base_url = '<?=base_url();?>';
	var datatoday = new Date();
	var datatodays = datatoday.setDate(new Date(datatoday).getDate() + 1);

    function imgErrorProgram(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/broken_img1.jpg";
        return true;
    }

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
	    minDate: datatoday,
	    oneLine: true,
	    timeFormat: 'hh:mm tt'

	});
	$(document).on('click', '.workplace-share', function() {
		var user_fb_id = "<?=$_SESSION['user_impersonate_token']?>";
		BM.loading(true);
		$.get('https://graph.facebook.com/'+user_fb_id+'?fields=picture,name&access_token=DQVJ1X3JxZAlRfM2pWN2I5eFVmVUJBYmhORENMSXM1bjZArbW4yOU13ZAmNYdFlqZA2hITWpQcnJEblg4UzB4bWYtV1BMcngxUE8xR2Q3SEI1WWk2bEdDX0toV0xFNVg5LXBnazV1Q1lmRHFNRHl1d1ZATeW9MaVMtdTBKckoyejQtX1lDTVRVc3poOWNTamx0d2RQRGtGeGtmVExRUDRTRi1ybl9Ub0liZAXlORU9VZAjVjaUlZAa1VvRDJMSWxQSUtkdjRWQ2xVWWNn', function(data3) {
			BM.loading(false);
			var user_img = data3.picture.data.url;
			var user_fb_name = data3.name;
			var photo = "<?=base_url().$details['details'][0]->image_thumbnail;?>";
			var desc = "<?=trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags((strlen($details['details'][0]->overview)>150) ? substr($details['details'][0]->overview, 0, 150).'...' : $details['details'][0]->overview))))))?>";
			var title = "<?=trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($details['details'][0]->name))))))?>";
			$('.au-workplacefield').val('');
			$('.au-workplaceavatar').attr('src',user_img);
			$('.au-workplaceusername').html(user_fb_name);
			$('.au-workplaceimg').attr('src',photo);
			$('.au-workplacecontenttitle').html(title);
			$('.au-workplacecontenttext').html(desc);
			$('#sharetoworkplace').modal('show');
		}, 'json');	
		
	});
	

	$(document).on('click', '.share-to-workplace', function() {
		var user_fb_id = "<?=$_SESSION['user_impersonate_token']?>";
		var url_root = document.location.host;
		var uri = window.location.href;
		var url = url_root;
		var id = "<?=$details['details'][0]->id?>";
		var base_url = "<?=base_url()?>";
		var photo = "<?=$details['details'][0]->image_thumbnail;?>";
		var desc = "<?=trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($details['details'][0]->overview))))))?>";
		var message = $('.au-workplacefield').val();
		var title = "<?=trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($details['details'][0]->name))))))?>";	
		BM.loading(true);
		$.get('https://graph.facebook.com/'+user_fb_id+'?fields=impersonate_token&access_token=DQVJ1X3JxZAlRfM2pWN2I5eFVmVUJBYmhORENMSXM1bjZArbW4yOU13ZAmNYdFlqZA2hITWpQcnJEblg4UzB4bWYtV1BMcngxUE8xR2Q3SEI1WWk2bEdDX0toV0xFNVg5LXBnazV1Q1lmRHFNRHl1d1ZATeW9MaVMtdTBKckoyejQtX1lDTVRVc3poOWNTamx0d2RQRGtGeGtmVExRUDRTRi1ybl9Ub0liZAXlORU9VZAjVjaUlZAa1VvRDJMSWxQSUtkdjRWQ2xVWWNn', function(data) {
			var impersonate_token = data.impersonate_token;
			$.post('https://graph.facebook.com/355003108168230/feed?access_token='+impersonate_token+'&name='+title+'&link='+uri+'&picture='+base_url+photo+'&caption='+url+'&description='+desc+'&message='+message, function(data) {
					BM.loading(false);
					$('#sharesuccess').modal('show');

			}, 'json');
		}, 'json');

	});

	$(document).on('click', '#btnSubmit', function(e){
		e.preventDefault();
		$('.au-form .custom-file-label').css('border-color','#ced4da');
		if(validate.standard('editprogramform')){
			// $("#editprogramform").trigger("reset");
			$("#editPrgoramDetails").css('opacity',0.5);
			$("#program_confirm_modal").modal("show");
		}
		else{
			$('#editprogramform .required_input').each(function(){
				if($(this).val() == null || $(this).val() == ""){
					var img_border = $('#previewImage').attr("src");
						if(img_border == ''){
							$('#editprogramform .custom-file-label').css('border-color','red');
						}else{
							$('#editprogramform .custom-file-label').css('border-color','');
						}
					$('.au-form .custom-file-label').css('border-color','');
					$(this).css('border-color','red');
				}
			});

		}
	});

	$(document).on('click', '#btn_edit_confirm', function(e){
		e.preventDefault();
			$("#editprogramform").submit();
			$("#editPrgoramDetails").css('opacity',1);
			$("#program_confirm_modal").modal("hide");
	});


	$(document).on('click', '#btn_edit_dismiss', function(e){
		e.preventDefault();
			$("#editPrgoramDetails").css('opacity',1);
			$("#editPrgoramDetails").css('overflow','scroll');
			$("#program_confirm_modal").modal("hide");
	});

	$(document).on('click', '#btnSubmitEvent', function(e){
		e.preventDefault();
		if(validate.standard('addEventForm')){
			$("#addEvent").css('opacity',0.5);
			$("#program_add_event_modal").modal("show");
		}else{
			$('#addEventForm .required_input').each(function(){
				if($(this).val() == null || $(this).val() == ""){
					var img_border = $('#previewImageEvent').attr("src");
						if(img_border == ''){
								$('#addEventForm .custom-file-label').css("border-color","red");
						}else{
							$('#addEventForm .custom-file-label').css("border-color",'');
						}
					$(this).css('border-color','red');
				}
			});

		}
	});

	$(document).on('click', '.au-btnyellow', function(e){
		$('.validate_error_message').remove();
		$('.required_input').css('border-color','');
		$('.custom-file-label').css('border-color','');
	});

	$(document).on('click', '#btn_add_event_confirm', function(e){
		e.preventDefault();
			$("#addEventForm").submit();
			$("#addEvent").css('opacity',1);
			$("#program_add_event_modal").modal("hide");
	});


	$(document).on('click', '#btn_add_event_dismiss', function(e){
		e.preventDefault();
			$("#addEvent").css('opacity',1);
			$("#addEvent").css('overflow','scroll');
			$("#program_add_event_modal").modal("hide");
	});

	function readURLImgStandardPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var extension = input.files[0].name.split('.').pop().toLowerCase();
                var base64 = e.target.result;
               	$("#previewImage").attr("src",base64);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
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