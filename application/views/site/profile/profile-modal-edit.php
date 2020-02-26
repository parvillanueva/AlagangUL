<style>
	.include_class {
		z-index: 9 !important
	}
</style>
<div class="modal fade text-center" id="profilesettings" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <span class="au-h4">Edit Profile</span>
                    <form action="<?= base_url('update-profile'); ?>" method="post" enctype="multipart/form-data" class="au-form" id="editprofile">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control required_input no_html alphaonly" id="fname" placeholder="First Name" value="<?= @$profile->first_name ?>" name="fname" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Entry.</div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control required_input no_html alphaonly" id="lname" placeholder="Last Name" value="<?= @$profile->last_name ?>" name="lname" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Entry.</div>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col">
                                <select class="form-control custom-select required_input" id="division" name="division" required="required" />
                                        <option value="" selected disabled>Business Unit/Division</option>
                                        <?php 
                                        $group = '';
                                        foreach($division as $div_lop){ ?>
                                            <?php
                                        
                                                if($group!=$div_lop['group_name']){
                                                    $group = $div_lop['group_name'];
                                            ?>

                                            <optgroup label="<?=$group?>">
                                            <?php } ?>
                                            <option value="<?php echo $div_lop['id']; ?>" <?php if($profile->division == $div_lop['id']) echo ' selected'?>><?php echo $div_lop['name']; ?></option>
                                        <?php } ?>
                                
                                </select>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Entry.</div>
                            </div>
                            <div class="col">
                                <input type="email" class="form-control required_input" id="email" placeholder="Work Email" name="email" required value="<?= @$profile->email_address ?>" disabled>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Entry.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="tel" class="form-control required_input" id="phone" placeholder="Mobile Number" value="<?= @$profile->work_number ?>" name="phone" required pattern="[0-9]{11}">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Mobile Number.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col" style="">
                                <div class="custom-file">
									<input type="hidden" name="image_file" class="" value="<?= $profile->imagepath;?>">
                                    <input type="file" class="custom-file-input" name="programImage" id="customFile"  onchange="readURLImgStandardPreview(this);" accept="image/x-png,image/jpeg" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <img  style="width: 100%;vertical-align: baseline;" src="<?= base_url() . $profile->imagepath;?>" onerror="imgErrorProfile(this);" id="previewImage" />
                                </div>
                            </div>
                        </div>
                        <div class="au-modalbtn text-center">
                            <button type="button" class="au-btn au-btnyellow" id="btnsubmit_data_close" data-dismiss="modal">Close</button>
                            <button type="button" class="au-btn" id="btnsubmit_data">Submit</button>
                        </div>
                    </form>	
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-center" id="profile_confirm_modal" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" add_confirm>
        <div class="modal-body" id="profile_confirm">
                <div class="form-row">
                    <div class="col">
                            <label class="file-label" >Are you sure you want to Update this record?</label>
                    </div>
                </div>
                <div class="au-modalbtn text-center">
                    <button type="button" class="au-btn au-btnyellow" id="dismiss_modal" data-dismiss="modal">No</button>
                    <button type="button" class="au-btn" id="btnSubmit2">Yes</button>
                </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    var base_url = '<?=base_url();?>';
    var validFile = true;
    $(document).ready(function(){
		$('#failed_label').hide();
	});
    function imgErrorProfile(image) {
        image.onerror = "";
        image.src = base_url+"/assets/img/au-avatar.svg";
        return true;
    }

	$(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

        if(extFile == 'png' || extFile == 'jpeg' || extFile == 'jpg')
        {
            $('#failed_label').hide();
            validFile = true;
        }
        else
        {
            
            $('#failed_label').show();
            validFile = false;
        }
    });

 	$(document).on('click', '#btnsubmit_data', function(){
        /* var email = $('#email').val() ? strip_tags($('#email').val()) : '';
        if(email != '')
        {
            update();
        } */
		var phone_val = $("#phone").val();
		if(phone_val == ''){
			$("#phone").addClass('required_input');
		} else{
			$("#phone").addClass('mobile_number');
		}
				console.log(validate.standard("editprofile"));
		if(validate.standard("editprofile")){				
			update();
		}
    });
	
	$(document).on('click', '#btnsubmit_data_close', function(){
		$('.validate_error_message').hide();
		$('input').css('border-color', 'rgb(204, 204, 204)');
	});
 
    function update(){
        $("#profilesettings").css('opacity',0.5);
        $("#profile_confirm_modal").modal("show");
    }

    $(document).on('click', '#btnSubmit2', function(e){
        e.preventDefault();
        /* var fname = $('#fname').val() ? strip_tags($('#fname').val()) : '';
        var lname = $('#lname').val() ? strip_tags($('#lname').val()) : '';
        var phone = $('#phone').val() ? strip_tags($('#phone').val()) : '';
        var division = $('#division').val() ? strip_tags($('#division').val()) : '';
        var work = $('#work_number').val() ? strip_tags($('#work_number').val()) : '';

        var user_id = <?=$this->session->userdata('user_sess_id')?>;
        var email = $('#email').val() ? strip_tags($('#email').val()) : '';    
        var file_data = $('#customFile').prop('files')[0]; 
        var form_data = new FormData();

            form_data.append('file', file_data);
            form_data.append('last_name', lname);
            form_data.append('first_name', fname);
            form_data.append('mobile', phone);
            form_data.append('id', user_id);
            form_data.append('email', email);
            form_data.append('division', division);
            form_data.append('work_number', work);


            var url = "<?php echo base_url('site/profile/update') ?>";
            
            $.ajax({
                url: url,
                dataType: 'text',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
            }).done(function(response) {
                var obj = is_json(response);
                if(obj.response == 'success'){
                    location.href = '<?=base_url("site/profile");?>';
                }
            });
            $("#profilesettings").css('opacity',1);
            $("#profile_confirm_modal").modal("hide"); */
			$("#editprofile").submit();

    });


    $(document).on('click', '#dismiss_modal', function(e){
        e.preventDefault();
            $("#profilesettings").css('opacity',1);
            $("#profilesettings").css('overflow','scroll');
            $("#profile_confirm_modal").modal("hide");
    });
    
    function readURLImgStandardPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var extension = input.files[0].name.split('.').pop().toLowerCase();

                if (!input.files[0].name.match(/.(jpg|jpeg|png)$/i)){
                    input.val = "";
					$('#profilesettings').addClass('include_class');
                    BM.alert("This file type is not supported.","text");
                } else {
                    var base64 = e.target.result;
                    $("#previewImage").attr("src",base64);
					
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
	
	$(document).on('click', '#not_support', function(){
		$('#profilesettings').removeClass('include_class');
	});
</script>