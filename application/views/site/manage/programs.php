<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Manage Programs</span>

		<button class="au-btn float-right" id="btn_addProgram" style="background-color: #11295b;"><i class="fa fa-plus"></i>Add Program</button>
		<button class="au-btn float-right" id="btn_unpublishProgram" style="background-color: #ffc107; display: none;"><i class="fa fa-minus"></i>Unpublish Program</button>
		<button class="au-btn float-right" id="btn_publishProgram" style="background-color: #8bc34a; display: none;"><i class="fa fa-check"></i>Publish Program</button>
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
								<th scope="col">Program</th>
								<th scope="col">Area Covered</th>
								<th scope="col" style="width: 300px;">Created Date</th>
								<th scope="col">Status</th>
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

<div class="modal fade text-center" id="AddProgramModal" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLabel">Add Program</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	        <div class="modal-body">
	            <form action="<?= base_url("programs/add")?>" method="post" enctype="multipart/form-data" class="au-form" id="addprogramform">
	        		<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input required_input" name="programImage" id="customFile" onchange="readURLImgStandardPreview(this);" accept="image/x-png,image/gif,image/jpeg" />
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<img  style="width: 100%;" src="" id="previewImage"/>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" placeholder="Program Name" name="programName" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="lname" placeholder="Areas Covered" name="areaCovered" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="lname" placeholder="Program Overview" name="overview" rows=5></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
				</form>	
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
		    </div>
	    </div>
	</div>
</div>

<div class="modal fade text-center" id="editPrgoramDetails" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLabel">Edit Program</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
        <div class="modal-body">
      			<form action="" method="post" enctype="multipart/form-data" class="au-form" id="editprogramform">
	        		<div class="form-row">
						<div class="col">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="programImage" id="customFile" onchange="readURLImgStandardPreviewEdit(this);" accept="image/x-png,image/gif,image/jpeg" />
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<img  style="width: 100%;" src="" id="previewImageEdit"/>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="programname" placeholder="Program Name" name="programName" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<input type="text" class="form-control required_input no_html" id="areacovered" placeholder="Areas Covered" name="areaCovered" value="">
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
	        		<div class="form-row">
						<div class="col">											
							<textarea type="text" class="form-control required_input no_html" id="overview" placeholder="Program Overview" name="overview" rows=5></textarea>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
				</form>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="button" class="btn btn-primary" id="btnSubmitUpdate">Save changes</button>
     		</div>
    	</div>
  	</div>
</div>


<script type="text/javascript" src="<?= base_url();?>/assets/site/js/bootstrap-show-modal.js"></script>
<script type="text/javascript">

	var keyword = "";

	$(document).ready(function(){
		get_list();
	});

	function get_list(){
		var url = "<?= base_url("manage/program_list");?>";
		var data = {};
		$.ajax({
		  	type: "POST",
		  	url: url,
		  	data: data,
		  	success: function(result){
		  		var html = "";
		  		
		  		$.each(result, function(a, b){

		  			var status = "Not Published";
		  			if(b.status == 1){
		  				status = "Published";
		  			}

		  			html += "<tr>";
		  			html += "	<td><input type='checkbox' class='select' data-alias='"+b.url_alias+"' data-id="+b.id+"/></td>";
		  			html += "	<td>" + b.name + "</td>";
		  			html += "	<td>" + b.area_covered + "</td>";
		  			html += "	<td>" + moment(b.create_date).format("LLL") + "</td>";
		  			html += "	<td>" + status + "</td>";
		  			html += "	<td>" ;
		  			html += "		<button data-image='"+b.image_thumbnail+"' data-id='"+b.id+"' data-urlalias='"+b.url_alias+"' data-name='"+b.name+"' data-overview='"+b.overview+"'  data-area='"+b.area_covered+"' type='button' class='au-btnyellow editProgramBtn' style='background-color: #ff5722; float: left;'>Edit</button>";
		  			html += "		<a href='<?= base_url("programs");?>/"+b.id+"/"+b.url_alias+"' target='_blank' type='button' class='au-btnyellow' style='background-color: #2196f3; float: left;'>Manage Page</a>";
		  			html += "		<a href='<?= base_url("manage");?>/"+b.id+"/"+b.url_alias+"' type='button' class='au-btnyellow' style='background-color: #132b62; float: left;'>Events <span class='badge badge-pill  badge-light'>"+b.event_count+"</span></a>";
		  			html += "	</td>";
		  			html += "</tr>";
		  		});
		  		$("#program_list").html(html);
		  	}
		});
	}

	$(document).on('change', '#select_all', function(){
		var del = 0;
		if(this.checked) { 
			$('.select').each(function() { 
				this.checked = true;  
				$("#btn_unpublishProgram").show();        
				$("#btn_publishProgram").show();        
			});
		}else{
			$('.select').each(function() { 
				this.checked = false;     
				$("#btn_unpublishProgram").hide();        
				$("#btn_publishProgram").hide();            
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
            $("#btn_unpublishProgram").show();        
			$("#btn_publishProgram").show();  
        } else {
        	$("#btn_unpublishProgram").hide();        
			$("#btn_publishProgram").hide();   
        }
	});


	$(document).on('click', '#btn_publishProgram', function(){
		BM.confirm("Are you sure you want to Publish selected Programs?", function(result){
			if(result){
				change_status(1);	
			}
		});
	});
	
	$(document).on('click', '#btn_unpublishProgram', function(){
		BM.confirm("Are you sure you want to Unpublish selected Programs?", function(result){
			if(result){
				change_status(0);	
			}
		});
	});
	
	$(document).on('click', '#btn_addProgram', function(){
		BM.show("#AddProgramModal");
	});

	
	$(document).on('click', '.editProgramBtn', function(){
		var id = $(this).attr("data-id");
		var urlalias = $(this).attr("data-urlalias");
		var image = $(this).attr("data-image");
		var name = $(this).attr("data-name");
		var area = $(this).attr("data-area");
		var overview = $(this).attr("data-overview");

		var form_post = "<?= base_url("programs");?>/" + id + "/" + urlalias + "/update";
		$("#editprogramform").attr("action", form_post);

		$("#previewImageEdit").attr("src", "<?= base_url();?>" + image);
		$("#programname").val(name);
		$("#areacovered").val(area);
		$("#overview").val(overview);

		BM.show("#editPrgoramDetails");

	});

	$(document).on('click', '#btnSubmit', function(){
		if(validate.standard("addprogramform")) {
			BM.confirm("Are you sure you want to Add this Programs?", function(result){
				if(result){
					$("#addprogramform").submit();
				}
			});
		}
	});

	$(document).on('click', '#btnSubmitUpdate', function(){
		if(validate.standard("editprogramform")) {
			BM.confirm("Are you sure you want to Update this Programs?", function(result){
				if(result){
					$("#editprogramform").submit();
				}
			});
		}
	});

	function change_status(status){
		BM.loading(true);
		var total = $('.select:checked').length;
		var count = 1;
		$('.select:checked').each(function(index) { 
            var id = $(this).attr('data-id');
            var alias = $(this).attr('data-alias');
            if(status == 1){
            	var url = "<?= base_url("programs");?>/" + id + "/" + alias + "/publish";
            } else {
            	var url = "<?= base_url("programs");?>/" + id + "/" + alias + "/unpublish";
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

	function readURLImgStandardPreviewEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var extension = input.files[0].name.split('.').pop().toLowerCase();
                var base64 = e.target.result;
               	$("#previewImageEdit").attr("src",base64);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
