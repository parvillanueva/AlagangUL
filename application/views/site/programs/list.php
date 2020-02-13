<style type="text/css">
#program_confirm_modal{
	z-index: 1051;
}
</style>

<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Explore Programs</span>
		<button class="au-btn" id="btn_addProgram" style="position: absolute;
    right: 0px;
    top: 13px;"><i class="fa fa-plus"></i>Add Program</button>
	</div>
</div>

<div class="container-fluid">

	<div class="au-container au-exfilter au-padding">

		<!-- <form action="" class="au-form" id="filter">
			<div class="row">
				<div class="col-lg-2">
					<div class="form-row">
						<select class="form-control custom-select" >
							<option value="" selected>Sorted by: Date</option>
							<option value="sample">Sample</option>
		  				</select>
	  				</div>
				</div>
			</div>
		</form> -->

		<div class="au-eventswrapper row">
			<div class="col">
				<div class="row">
			        {programs}
			            <div class="col-lg-4 col-sm-6">
			                <div class="au-featured-program">
			                    <div class="au-fp-thumbnail">
			                        <img src="<?=base_url()?>{image_thumbnail}" class="au-fp-thumbnailimg">
			                    </div>
			                    <div class="au-fp-details">
			                        <span class="au-p1">{name}</span>
			                        <span class="au-p2">{overview}</span>
			                        <div class="au-fp-fdetails">
			                            <span class="au-p2 au-memcounter"><i class="fas fa-user-friends"></i> {member_count} </span>
			                            <a href="<?= base_url("programs");?>/{id}/{url_alias}"><button type="button" class="au-btnyellow">Read More</button></a>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        {/programs}
			        </div>
			</div>

		</div>

	</div>
</div>

<div class="modal fade text-center" id="program_confirm_modal" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <form action="<?= base_url("programs/add")?>" method="post" enctype="multipart/form-data" class="au-form" id="add_confirm">
        		<div class="form-row">
					<div class="col">
							<label class="file-label" >Are you sure you want to add this record?</label>
					</div>
				</div>
				<div class="au-modalbtn text-center">
                    <button type="button" class="au-btn au-btnyellow" id="dismiss_modal" data-dismiss="modal">No</button>
                    <button type="button" class="au-btn" id="btnSubmit2">Yes</button>
                </div>
			</form>	
        </div>
    </div>
</div>
</div>

<div class="modal fade text-center" id="program_settings" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <span class="au-h4">Add Program</span>
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
				<div class="au-modalbtn text-center">
                    <button type="button" class="au-btn au-btnyellow" data-dismiss="modal">Close</button>
                    <button type="button" class="au-btn" id="btnSubmit">Submit</button>
                </div>
			</form>	
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function(result){

    });
	$(document).on("click", "#btn_addProgram", function(){

		$("#previewImage").attr("src","");
		$("#addprogramform").trigger("reset");
		$("#program_settings").modal("show");
	});

	$(document).on('click', '#btnSubmit', function(e){
		e.preventDefault();
		$('.au-form .custom-file-label').css('border-color','#ced4da');
		if(validate.all()){
			$("#program_confirm_modal").modal("show");
			$("#program_settings").css('opacity',0.5);
		}
		else{

			if($('#customFile').val() != ''){
				$('.au-form .custom-file-label').css('border-color','#ced4da');
			}
			else{
				$('.au-form .custom-file-label').css('border-color','');
				$('.custom-file-label ').css('border-color','red');
			}
		}
	});

	$(document).on('click', '#btnSubmit2', function(e){
		e.preventDefault();
			$("#addprogramform").submit();
			$("#program_settings").css('opacity',1);
			$("#program_confirm_modal").modal("hide");
	});

	$(document).on('click', '#dismiss_modal', function(e){
		e.preventDefault();
			$("#program_settings").css('opacity',1);
			$("#program_settings").css('overflow','scroll');
			$("#program_confirm_modal").modal("hide");
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
</script>