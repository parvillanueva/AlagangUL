<style type="text/css">
		#btn_Closebtn{
		margin-right: 10px;
    	margin-top: 10px;
	}

	.au-btn .fa-times{
		color:white;
	}
</style>
<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<strong class="au-h5 no-margin" style="max-width: 100%;" title = "<?= $details[0]->name; ?>">
			<?php 
				$name = $details[0]->name;
				if (strlen($name) > 40){
					$name = substr($name, 0, 35) . '...';
				}
				echo $name;
			?>
		</strong>

		<button class="au-btn" id="btn_Closebtn" style="background-color: #f44336;"><i class="fa fa-times"></i>Close</button>
		<button class="au-btn" id="btn_addEvent" style="background-color: #11295b;"><i class="fa fa-plus"></i>Add Event</button>
		<button class="au-btn" id="btn_publishEvent" style="background-color: #8bc34a; display: none;"><i class="fa fa-check"></i>Publish Event</button>
		<button class="au-btn" id="btn_unpublishEvent" style="background-color: #ffc107; display: none;"><i class="fa fa-minus"></i>Unpublish Event</button>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container-fluid">
	<div class="au-container au-padding">
		<div class="au-eventswrapper row">
			<div class="col">
				<div class="au-manageprogramtable au-opptable">
					<table>
						<thead>
							<tr>
								<th scope="col" style="width: 30px;"><input type="checkbox" id="select_all"></th>
								<th scope="col">Title</th>
								<th scope="col" style="width: 200px;">When</th>
								<th scope="col">Where</th>
								<th scope="col">Status</th>
								<th scope="col">Created Date</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="program_list">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Add Event Modal -->
<div class="modal fade text-center" id="AddEventModal" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	        <div class="modal-body">
	  			<form action="<?= base_url("programs/") . $program_id . "/" . $program_url . "/add_event";?>" method="post" enctype="multipart/form-data" class="au-form" id="addEventForm" >
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
							<input type="text" class="form-control required_input no_html" id="event_title" placeholder="Event Title" name="eventTitle" value="">
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
							<input type="text" class="form-control required_input no_html" id="where" placeholder="Where" name="eventWhere" value="" >
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row" hidden>
						<div class="col">											
							<input type="number" class="form-control required_input no_html" id="add_point" placeholder="Add Points" name="eventPoints" value="0">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<!-- <div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="event_overview" placeholder="Event Overview" name="overview" rows=5></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div> -->
				</form>
	  		</div> 
	  		<div class="modal-footer">
	  			<button type="button" class="btn btn-secondary" id="SubmitEventAdd_close" data-dismiss="modal">Close</button>
        		<button type="button" class="btn btn-primary" id="btnSubmitEvent">Save</button>
     		</div>
		</div>
	</div>
</div>

<!-- Edit Event Modal -->
<div class="modal fade text-center" id="EditEventModal" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	        <div class="modal-body">
	  			<form action="" method="post" enctype="multipart/form-data" class="au-form" id="editEventForm">
	        		<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="eventImage" id="customFile" onchange="readURLImgStandardPreviewEventEdit(this);" accept="image/x-png,image/jpeg" />
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<img  style="width: 100%;" src="" id="previewImageEventEdit"/>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="EditeventTitle" placeholder="Event Title" name="eventTitle" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" readonly="true" id="whenpickeredit" placeholder="When" name="eventWhen" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="EditEventwhere" placeholder="Where" name="eventWhere" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row" hidden>
						<div class="col">											
							<input type="number" class="form-control required_input no_html" id="EditEventpoints" placeholder="Add Points" name="eventPoints" value="0">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<!-- <div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="EditEventoverview" placeholder="Event Overview" name="overview" rows=5></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div> -->
				</form>
	  		</div> 
	  		<div class="modal-footer">
	  			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="button" class="btn btn-primary" id="btnSubmitEditEvent">Save</button>
     		</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?= base_url();?>/assets/site/js/bootstrap-show-modal.js"></script>
<script type="text/javascript">

	var keyword = "";
	var datatoday = new Date();
	var datatodays = datatoday.setDate(new Date(datatoday).getDate() + 1);

	$(document).ready(function(){
		BM.loading(true);
		get_list();
		$("#EditEventpoints, #add_point").keypress(function (e) {
			 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
	});

	$(document).on('click', '#btn_Closebtn', function(){
		location.href = '<?= base_url("manage");?>';
	});


	$(document).on('click', '#btn_addEvent', function(){
		BM.show("#AddEventModal");
	});

	$(document).on('click', '.editEventBtn', function(){

		var title = $(this).attr("data-title");
		var where = $(this).attr("data-where");
		var points = $(this).attr("data-points");
		var overview = $(this).attr("data-overview");
		var image = $(this).attr("data-image");
		var when = $(this).attr("data-when");
		var id = $(this).attr("data-id");
		var alis = $(this).attr("data-alias");

		var url = "<?= base_url("programs/") . $program_id . "/" . $program_url . "/event/";?>" + id + "/" + alis + "/update";

		// $('#whenpickeredit').data("DateTimePicker").minDate(when);

		$("#EditeventTitle").val(title);
		$("#EditEventwhere").val(where);
		$("#EditEventpoints").val(points);
		$("#EditEventoverview").val(overview);
		$("#whenpickeredit").val(when);
		$("#previewImageEventEdit").attr("src",image);
		$("#editEventForm").attr("action",url);
		
		BM.show("#EditEventModal");

		$('img').on("error", function() {
          $(this).attr('src', base_url+"/assets/img/broken_img2.jpg");
        });
	});

	$(document).on('click', '#btnSubmitEditEvent', function(){
		if(validate.standard("editEventForm")) {
			$('#EditEventModal').css("opacity","0.5");
			BM.confirm("Are you sure you want to Edit this Event?", function(result){
				if(result){
					BM.loading(true);
					$("#editEventForm").submit();
					$('#EditEventModal').css("opacity","1");
				}
				else{
					$("#EditEventModal").css('overflow','auto');
					$('#EditEventModal').css("opacity","1");
				}
			});
		}
	});
	$(document).on('click', '#btnSubmitEvent', function(){
		if(validate.standard("addEventForm")) {
			$('#AddEventModal').css("opacity","0.5");
			BM.confirm("Are you sure you want to Add this Event?", function(result){
				// alert(result)
				if(result){
					BM.loading(true);
					$("#addEventForm").submit();
					$("#AddEventModal").css("opacity","1");
				}
				else{
					$("#AddEventModal").css('overflow','auto');
					$("#AddEventModal").css("opacity","1");
				}
			});
		}
	});
	
	$(document).on('click', '#SubmitEventAdd_close', function(){
		$('.validate_error_message').hide();
		("#AddEventModal").css("opacity","1");
	});

	$(document).on('change', '#select_all', function(){
		var del = 0;
		if(this.checked) { 
			$('.select').each(function() { 
				if($(this).is(':disabled') === false){
					this.checked = true; 
				}
				$("#btn_unpublishEvent").show();        
				$("#btn_publishEvent").show();        
			});
		}else{
			$('.select').each(function() { 
				this.checked = false;     
				$("#btn_unpublishEvent").hide();        
				$("#btn_publishEvent").hide();            
			});         
		}
	});

	$(document).on('change', '.select', function(){
		var check_count = 0;
	    $('.select').each(function(){
	        if(this.checked){
	        	check_count++;
	        } else {
	        }
	    });

	    if(check_count > 0){
            $("#btn_unpublishEvent").show();        
			$("#btn_publishEvent").show();  
        } else {
        	$("#btn_unpublishEvent").hide();        
			$("#btn_publishEvent").hide();   
        }
	});


	$(document).on('click', '#btn_publishEvent', function(){
		BM.confirm("Are you sure you want to Publish selected Event?", function(result){
			if(result){
				change_status(1);	
			}
		});
	});
	
	$(document).on('click', '#btn_unpublishEvent', function(){
		BM.confirm("Are you sure you want to Unpublish selected Event?", function(result){
			if(result){
				change_status(0);	
			}
		});
	});

	function change_status(status){
		// alert(status);
		BM.loading(true);
		var total = $('.select:checked').length;
		var count = 1;
		$('.select:checked').each(function(index) { 
            var id = $(this).attr('data-id');
            var alias = $(this).attr('data-alias');
            if(status == 1){
            	var url = "<?= base_url("programs");?>/<?= $details[0]->id;?>/<?= $details[0]->url_alias;?>/event/" + id + "/" + alias + "/publish/1";
            } else {
            	var url = "<?= base_url("programs");?>/<?= $details[0]->id;?>/<?= $details[0]->url_alias;?>/event/" + id + "/" + alias + "/publish/0";
            }
            $.get(url, function( data ) {
            	if(count == total){
            		get_list();
            	} 
			});
        });
	}

	function get_list(){
		// BM.loading(true);
		var url = "<?= base_url("manage/event_list");?>";
		var data = {
			program_id : <?= $program_id;?>
		};
		$.ajax({
		  	type: "POST",
		  	url: url,
		  	data: data,
		  	success: function(result){

		  		console.log(result);
		  		var html = "";
		  		var count_task = 0;
		  		
		  		$.each(result, function(a, b){

		  			var status = "Not Published";
		  			if(b.status == 1){
		  				status = "Published";
		  			}

		  			var disabled = "disabled";
		  			var tooltip = "No task available.";
		  			if(b.task_count > 0){
		  				disabled = "";
		  				tooltip = "";
		  				count_task++;
		  			}

		  			html += "<tr>";
		  			html += "	<td><input title='"+tooltip+"' "+disabled+" type='checkbox' class='select' data-alias='"+b.url_alias+"' data-id="+b.id+"/></td>";
		  			html += "	<td>" + b.title + "</td>";
		  			html += "	<td>" + moment(b.when).format("LLL") + "</td>";
		  			html += "	<td>" + b.where + "</td>";
		  			html += "	<td>" + status + "</td>";
		  			html += "	<td>" + moment(b.create_date).format("LLL") + "</td>";
		  			html += "	<td>" ;
		  			html += "		<a href='#' data-id="+b.id+" data-alias='"+b.url_alias+"' data-when='"+moment(b.when).format("MM/DD/YYYY hh:mm a")+"' data-image='"+b.image+"' data-overview='"+b.description+"' data-points='"+b.volunteer_points+"' data-where='"+b.where+"' data-title='"+b.title+"' type='button' class='au-lnk au-action editEventBtn' title='Edit Event'><i class='fas fa-edit'></i></button>";
		  			html += "		<a href='"+b.Url+"' target='_blank' type='button' class='au-lnk au-action' title='Manage Page'><i class='fas fa-cog' style='color: #11295b;'></i></a>";
		  			html += "		<a href='<?= base_url("volunteers");?>/"+b.id+"' type='button' class='au-lnk au-action' title='Volunteers' ><i class='fas fa-users' style='color: #795548;'></i><span class='au-evnu badge badge-pill  badge-light'>"+b.volunteers+"</span></a>";
		  			html += "	</td>";
		  			html += "</tr>";
		  		});

		  		if(count_task == 0){
		  		 $('#select_all').attr("disabled",true);
		  		}
		  		$("#program_list").html(html);
		  		BM.loading(false);
		  	}
		});
	}


	function readURLImgStandardPreviewEvent(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
               	var extension = input.files[0].name.split('.').pop().toLowerCase();
                if (!input.files[0].name.match(/.(jpg|jpeg|png)$/i)){
                	input.val = "";
               		BM.alert("This file type is not supported.","text");
               		$('#AddEventModal').css('overflow','auto');

                } else {
                	var base64 = e.target.result;
               		$("#previewImageEvent").attr("src",base64);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


	function readURLImgStandardPreviewEventEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
               	if (!input.files[0].name.match(/.(jpg|jpeg|png)$/i)){
                	input.val = "";
               		BM.alert("This file type is not supported.","text");
               		$('#EditEventModal').css('overflow','auto');
                } else {
                	var base64 = e.target.result;
               		$("#previewImageEventEdit").attr("src",base64);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#whenpicker').datetimepicker({
	    controlType: 'select',
	    minDate: datatoday,
	    oneLine: true,
	    timeFormat: 'hh:mm tt'
	});

    $('#whenpickeredit').datetimepicker({
	    controlType: 'select',
	    minDate: datatoday,
	    oneLine: true,
	    timeFormat: 'hh:mm tt'
	});

    

</script>