<div class="modal fade text-center" id="profilesettings">
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
                                <input type="tel" class="form-control" id="phone" placeholder="Mobile Number" value="<?= @$profile->mobile_number ?>" name="phone" required pattern="[0-9]">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Mobile Number.</div>
                            </div>
                        </div>
                        <div class="form-row text-left">
                            <div class="col">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" accept='image/*'>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
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

<script type="text/javascript">
	$(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

	$(document).on('click', '#btnsubmit', function(){

        var email = $('#email').val() ? strip_tags($('#email').val()) : '';
		var fname = $('#fname').val() ? strip_tags($('#fname').val()) : '';
        var lname = $('#lname').val() ? strip_tags($('#lname').val()) : '';
        var phone = $('#phone').val() ? strip_tags($('#phone').val()) : '';
        var user_id = <?=$this->session->userdata('user_sess_id')?>;
        var file_data = $('#customFile').prop('files')[0]; 

        if(email != '')
        {
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
        }
        

    });
    
    function validate()
    {

    }
</script>