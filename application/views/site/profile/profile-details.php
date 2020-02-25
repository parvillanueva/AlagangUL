   
<div class="container-fluid">
    <div class="au-container au-exfilter au-padding">
        <div class="row">        
            <div class="col-lg-3 col-md-4">
                <div class="au-userpicture d-none d-lg-block">
                    <?php if(empty($profile->imagepath)) : ?>
                        <img src="<?=base_url() ?>assets/img/au-avatar.svg" class="au-useravatar" onerror="imgErrorProfile(this);">
                    <?php else: ?>
                        <img src="<?=base_url() . $profile->imagepath ?>" class="au-useravatar" onerror="imgErrorProfile(this);">
                    <?php endif; ?>
                </div>

                <div id='calendar'></div>

            </div>

            <div class="col-lg-9 col-md-8">
                <span class="au-h4 au-fpoints">Points Level</span>
                <div class="au-pointslevel">
                    <div class="au-ptscol">
                        <span class="au-pts">0</span>
                        <span class="au-level"><span>0</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">10</span>
                        <span class="au-level"><span>1</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">20</span>
                        <span class="au-level"><span>2</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">30</span>
                        <span class="au-level"><span>3</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">40</span>
                        <span class="au-level"><span>4</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">50</span>
                        <span class="au-level"><span>5</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">60</span>
                        <span class="au-level"><span>6</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">70</span>
                        <span class="au-level"><span>7</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">80</span>
                        <span class="au-level"><span>8</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">90</span>
                        <span class="au-level"><span>9</span></span>
                    </div>
                    <div class="au-ptscol">
                        <span class="au-pts">100</span>
                        <span class="au-level"><span>10</span></span>
                    </div>
                    <div class="au-prbar">
                        <div class="au-levelbar" id="progress1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">								
                        <div class="au-boxed au-achivements">
                            <div class="au-titlebox">Achievements
                                <div class="au-inner">
                                    <div class="au-p2">
                                        <span class="au-fpoints">Points Earned</span>
                                        <span class="au-pfaccpoints"><div class="au-heart"><i class="fas fa-heart"></i></div><?=$profile->current_points?></span>
                                    </div>
                                    <!-- <div class="au-p2"> -->
                                        <?php // if(!empty($badges)) : ?>
                                            <!-- <span>Badges</span> -->
                                                <!-- <div class="au-badges"> -->
                                                   <!--  <?php foreach($badges as $badge) : ?>
                                                        <div class="au-badge">
                                                            <i class="au-icon <?=@$badge['icon']?>" title="<?=@$badge['title']?>" style="color:<?=@$badge['color']?>"></i>
                                                        </div>
                                                    <?php endforeach; ?> -->
                                                    <!-- <div class="au-badge"><i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i></div>
                                                    <div class="au-badge"><i class="fas fa-gem au-treasure au-icon" title="Treasure"></i></div> -->
                                                <!-- </div> -->
                                        <?php // endif; ?>
                                    <!-- </div> -->
                                    <div class="row">
                                        <?php if(isset($c_programs)){ ?>
                                        <div class="col-sm-6">
                                            <div class="au-p2">
                                                <span>Joined Programs</span>
                                                <span class="au-pfnum"><?= @$c_programs ?></span>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="col-sm-6">
                                            <div class="au-p2">
                                                <span>Volunteered Events</span>
                                                <span class="au-pfnum"><?= @$c_events ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="au-jprogramswrapper">
                            <?php if(!empty($created)) : ?>
                                <!-- <span class="au-title">Programs Created</span> -->
                                <div class="slider programs">
                                
                                        <?php foreach($created as $program) : ?>
                                            <div class="au-slprograms">
                                                <a href="<?= base_url()?>programs/<?= @$program['id']?>/<?= @$program['url_alias']?>" class="au-lnk">
                                                    <div class="au-opthumbnail">
                                                        <img src="<?=base_url().@$program['image_thumbnail']?>" class="au-fp-thumbnailimg" onerror="imgErrorProfileDetails(this);">
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                
                                </div>
                            
                            <hr>
                            <?php endif; ?>
                            <span class="au-title">Programs Joined</span>
                            <div class="slider programs">
                                <?php if(!empty($programs)) : ?>
                                    <?php foreach($programs as $program) : ?>
                                        <div class="au-slprograms">
                                            <a href="<?= base_url()?>programs/<?= @$program['id']?>/<?= @$program['url_alias']?>" class="au-lnk">
                                                <div class="au-opthumbnail">
                                                    <img src="<?=base_url().@$program['image_thumbnail']?>"class="au-fp-thumbnailimg" onerror="imgErrorProfileDetails(this);">
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="au-boxed">
                    <div class="au-titlebox">Activities Volunteered</div>
                    <div class="au-content au-padding">
                        <div class="au-eventswrapper au-volunteeredwrapper">
                            <?php if(!empty($events)) : ?>
                                <?php foreach($events as $event) : ?>
                                    <div class="au-event-entry" id="activity<?=@$event['program_id']?>">
                                        <div class="au-event">
                                            <div class="row">
                                                <div class="col-sm-3 au-eventthumbnail">
                                                    <img src="<?=base_url(). @$event['image']?>" class="au-eventimg">
                                                </div>
                                                <div class="col-sm-9 au-eventdetails">
                                                    <div class="au-program">
                                                        <a href="<?= base_url("programs") . "/" . $event['program_id'] . "/" . $event['program_alias'] . "/event/" . $event['event_id'] .  "/" . $event['event_alias']; ?>" class="au-lnk">
                                                            <div class="au-pthumbnail">
                                                                <img src="<?=base_url(). @$event['image_thumbnail']?>" class="au-fp-thumbnailimg" onerror="imgErrorProfileDetails2(this);">
                                                            </div>
                                                            <span class="au-ptitle" attr-program-id="<?=$event['program_id']?>" attr-event-id="<?= @$event['event_id']?>"><?= @$event['title']?></span>
                                                            <span class="au-pdetails">
                                                                <div class="au-programdetails">
                                                                    <div class="au-inner">
                                                                        <span class="au-pans"><span class="au-pques">When:</span><?=@date_format(date_create($event['when']),"F d, Y  h:i A")?></span>
                                                                    </div>
                                                                    <div class="au-inner">
                                                                        <span class="au-pans"><span class="au-pques">Where:</span><?= @$event['where']?></span>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="volunteer">


                                                        <div class="row">	
                                                            <div class="au-volunteers col" >
                                                                <!-- <?php if(!empty($event['badges'])) : ?>
                                                                    <?php foreach($event['badges'] as $badges) : ?>
                                                                        <?php if($badges[0] == 'Treasure') : ?>
                                                                            <img src="<?=base_url()?>assets/img/au-treasure-2.jpg" class="au-imgbadge" title="Treasure">
                                                                        <?php endif; ?> 
                                                                        <?php if($badges[0] == 'Talent') : ?>
                                                                            <img src="<?=base_url()?>assets/img/au-talent-2.jpg" class="au-imgbadge" title="Talent">
                                                                        <?php endif; ?> 
                                                                        <?php if($badges[0] == 'Time') : ?> 
                                                                            <img src="<?=base_url()?>assets/img/au-time-2.jpg" class="au-imgbadge" title="Time">
                                                                        <?php endif; ?>   
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                                 -->
																
																
															
                                                            </div>
                                                            <div class="col">
                                                                <button class="au-btnvolunteer au-btn float-right" data-toggle="modal" onclick="volunteer('<?=$event['task_name']?>','<?=$event['program_name']?>',<?=$event['program_id']?>,<?= @$event['event_id']?>,<?= @$event['task_id']?>)">
                                                                    Joined
                                                                </button>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            

                        </div>
                    </div>
                </div>

            </div>
        </div>				
    </div>
</div>

<div class="modal fade text-center" id="volunteermodal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<span class="au-h4">Thank you for volunteering</span>
				<div class="au-yourvolunteer" attr-prog-id="" attr-event-id="" task-id="">
					
				</div>
				<span class="au-p6">in <span class="au-programvolunteer"></span>
				<br><br>Task: <span class="volunteer-task"></span></span>
				<hr>	
				<form>
					<div class="form-row au-terms">
						<!-- <div class="col">
		      				<label class="form-check-label">
		        				<input class="form-check-input is_agree_checkbox" type="checkbox" name="terms" required=""> I have read and understood the <a href="#" class="au-lnk event-guidelines" data-toggle="modal" data-target="#eventdetails">Guidelines</a>.
			        			<div class="valid-feedback"></div>
			        			<div class="invalid-feedback"></div>
		      				</label>
		      				
		      			</div> -->
		      			<!-- <span class="au-p6 au-errormessage"><i class="fas fa-exclamation-triangle"></i> Please read and agree to the event guidelines above.</span> -->
	    			</div>
					<div class="au-modalbtn text-center">
						<button type="button" class="au-btn au-btnyellow volunteer-as" data-dismiss="modal" attr-submit="0">No, I made a mistake</button>
						<!-- <button type="button" class="au-btn volunteer-as" attr-submit="1">Yes, sign me up!</button> -->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade text-center" id="volunteerthankyou" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<span class="au-h4 volunteer-title">Thank you!</span>
				<span class="au-p6 volunteer-body">Your help is greatly appreciate. Please standby for more details.</span>
				<div class="au-modalbtn text-center">
					<button type="button" class="au-btn close-btn" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    var base_url = '<?=base_url();?>';
    function imgErrorProfile(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/au-avatar.svg";
        return true;
    }

    function imgErrorProfileDetails(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/broken_img1.jpg";
        return true;
    }

    function imgErrorProfileDetails2(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/broken_img2.jpg";
        return true;
    }

    function volunteer(task, program, prog_id,event_id, task_id)
    {
        $('.au-yourvolunteer').attr('attr-prog-id',prog_id).attr('attr-event-id',event_id).attr('task-id',task_id);
        $('.volunteer-task').html(task);
        $('.au-programvolunteer').html(program);

       
        $('#volunteermodal').modal('show');
    }
    
    $(document).ready(function() {
        $(document).on('click', '.event-volunteer', function() {
			
			var task = $(this).closest('tr').children(':nth-child(2)').html();
			var event_task_id = $(this).attr('attr-id');
			var is_joined = $(this).attr('attr-isjoined');
			var volunteer_type = $('.hid-id-'+event_task_id).html();

			if(is_joined==1){
				$('.au-terms').hide();
			}
			else{
				$('.au-terms').show();
			}

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
           
            var program_id = $('.au-yourvolunteer').attr('attr-prog-id');
            var event_id = $('.au-yourvolunteer').attr('attr-event-id');
            var event_task_id = $('.au-yourvolunteer').attr('task-id');


			var is_submit = $(this).attr('attr-submit');
            var task = $(this).closest('tr').children(':nth-child(2)').html();
			var is_joined = $(this).attr('attr-isjoined');
			var volunteer_type = $('.hid-id-'+event_task_id).html();
			var is_joined = $(this).attr('attr-isjoined');

			// if($('.is_agree_checkbox').is(':checked') || (is_submit==0 && is_joined==1) ){
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
		    			
		    		}
		    		else{
		    			$('.volunteer-body').html('Your volunteered task has been cancelled.');
		    		}
		    		$('#volunteerthankyou').modal('show');

				});
			// }
			// else{
			// 	$('.au-errormessage').show();
			// }
			

		});
    });
</script>
