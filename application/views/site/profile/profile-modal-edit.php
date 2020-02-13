<div class="modal fade text-center" id="profilesettings" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <span class="au-h4">Edit Profile</span>
                    <form class="au-form" id="editprofile">
                        <div class="au-form form-row">
                            <div class="col">
                                <input type="text" class="form-control" id="fname" placeholder="First Name" value="<?= @$profile->first_name ?>" name="fname" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="lname" placeholder="Last Name" value="<?= @$profile->last_name ?>" name="lname" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="email" class="form-control" id="email" placeholder="Work Email" name="email" required value="<?= @$profile->email_address ?>" disabled>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="tel" class="form-control" id="phone" placeholder="Mobile Number" value="<?= @$profile->mobile_number ?>" name="phone" required pattern="[0-9]{11}">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Mobile Number.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col" style="overflow: scroll;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="programImage" id="customFile" onchange="readURLImgStandardPreview(this);" accept="image/x-png,image/gif,image/jpeg" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <img  style="width: 100%;" src="<?= base_url() . $profile->imagepath;?>" id="previewImage"/>
                                </div>
                            </div>
                        </div>
                        <div class="au-modalbtn text-center">
                            <button type="button" class="au-btn au-btnyellow" data-dismiss="modal">Close</button>
                            <button type="button" class="au-btn" id="btnsubmit">Submit</button>
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
	$(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

	$(document).on('click', '#btnsubmit', function(){
        var email = $('#email').val() ? strip_tags($('#email').val()) : '';
        if(email != '')
        {
            update();
        }
    });

    function update(){
        $("#profilesettings").css('opacity',0.5);
        $("#profile_confirm_modal").modal("show");
    }

    $(document).on('click', '#btnSubmit2', function(e){
        e.preventDefault();
        var fname = $('#fname').val() ? strip_tags($('#fname').val()) : '';
        var lname = $('#lname').val() ? strip_tags($('#lname').val()) : '';
        var phone = $('#phone').val() ? strip_tags($('#phone').val()) : '';
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
            $("#profile_confirm_modal").modal("hide");
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
                var base64 = e.target.result;
                $("#previewImage").attr("src",base64);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>