<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<strong class="au-h5 no-margin"><?= $details[0]->name;?></strong>

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
				<div class="au-opptable">
					<table>
						<thead>
							<tr>
								<th scope="col" style="width: 30px;"><input type="checkbox" id="select_all"></th>
								<th scope="col">Title</th>
								<th scope="col" style="width: 200px;">When</th>
								<th scope="col">Where</th>
								<th scope="col" style="width: 100px;">Status</th>
								<th scope="col" style="width: 300px;">Created Date</th>
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
	  			<form action="<?= base_url("programs/") . $program_id . "/" . $program_url . "/add_event";?>" method="post" enctype="multipart/form-data" class="au-form" id="addEventForm">
	        		<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input required_input" name="eventImage" id="customFile" onchange="readURLImgStandardPreviewEvent(this);" accept="image/x-png,image/gif,image/jpeg" />
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
	        		<div class="form-row">
						<div class="col">											
							<input type="number" class="form-control required_input no_html" id="lname" placeholder="Add Points" name="eventPoints" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="lname" placeholder="Event Overview" name="overview" rows=5></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
				</form>
	  		</div> 
	  		<div class="modal-footer">
	  			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="button" class="btn btn-primary" id="btnSubmitEvent">Save</button>
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
		get_list();
	});

	$(document).on('click', '#btn_Closebtn', function(){
		location.href = '<?= base_url("manage");?>';
	});


	$(document).on('click', '#btn_addEvent', function(){
		BM.show("#AddEventModal");
	});

	$(document).on('click', '#btnSubmitEvent', function(){
		if(validate.standard("addEventForm")) {
			BM.confirm("Are you sure you want to Add this Event?", function(result){
				if(result){
					$("#addEventForm").submit();
				}
			});
		}
	});

	$(document).on('change', '#select_all', function(){
		var del = 0;
		if(this.checked) { 
			$('.select').each(function() { 
				this.checked = true;  
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
            		BM.loading(false);
            		location.reload();
            	} else {
					count ++;
            	}
			});
        });
	}

	function get_list(){
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
		  		
		  		$.each(result, function(a, b){

		  			var status = "Not Published";
		  			if(b.status == 1){
		  				status = "Published";
		  			}

		  			html += "<tr>";
		  			html += "	<td><input type='checkbox' class='select' data-alias='"+b.url_alias+"' data-id="+b.id+"/></td>";
		  			html += "	<td>" + b.title + "</td>";
		  			html += "	<td>" + moment(b.when).format("LLL") + "</td>";
		  			html += "	<td>" + b.where + "</td>";
		  			html += "	<td>" + status + "</td>";
		  			html += "	<td>" + moment(b.create_date).format("LLL") + "</td>";
		  			html += "	<td>" ;
		  			html += "		<button type='button' class='au-btnyellow editProgramBtn' style='background-color: #ff5722; float: left;'>Edit</button>";
		  			html += "		<a href='"+b.Url+"' target='_blank' type='button' class='au-btnyellow' style='background-color: #2196f3; float: left;'>Manage Page</a>";
		  			html += "		<a href='<?= base_url("volunteers");?>/"+b.id+"' type='button' class='au-btnyellow' style='background-color: #132b62; float: left;'>Volunteers <span class='badge badge-pill  badge-light'>"+b.volunteers+"</span></a>";
		  			html += "	</td>";
		  			html += "</tr>";
		  		});
		  		$("#program_list").html(html);
		  	}
		});
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

    $('#whenpicker').datetimepicker({
	    controlType: 'select',
	    minDate: datatoday,
	    oneLine: true,
	    timeFormat: 'hh:mm tt'
	});

</script>