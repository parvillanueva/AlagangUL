<div class="modal fade text-center" id="profilesettings">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <span class="au-h4">Edit Profile</span>
                    <form class="au-form" id="editprofile">
                        <div class="form-row">
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
                            <!-- <div class="col">
                                <select class="form-control custom-select">
                                    <option value="" selected disabled>Division / Business Unit</option>
                                    <option value="sample">Sample</option>
                                </select>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div> -->
                            <div class="col">
                                <input type="email" class="form-control" id="email" placeholder="Work Email" name="email" required value="<?= @$profile->email_address ?>" disabled>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="tel" class="form-control" id="phone" placeholder="Mobile Number" value="<?= @$profile->mobile_number ?>" name="phone" required pattern="[0-9]{10}">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-row text-left">
                            <div class="col">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="au-modalbtn text-center">
                            <button type="button" class="au-btn au-btnyellow" data-dismiss="modal">Close</button>
                            <button type="submit" class="au-btn" id="btnsubmit">Submit</button>
                        </div>
                    </form>	
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	
	$(document).on('click', '#btnsubmit', function(){
        alert("hi");
		modal.loading(true);
        var email = $('#email').val();
		var fname  = $('#fname').val();
        var lname = $('#lname').val();
        var user_id = <?=$this->session->userdata('user_sess_id')?>;

		if(email_address != ''){
			var data = {
                email_address : email_address,
				first_name : fname,
                last_name : lname,
                id: user_id
                
			};
			var url = "<?php echo base_url('site/profile/update') ?>";
			aJax.post(url, data, function(result){
				var obj = is_json(result);
				if(obj.responce == 'exist'){
					$('#failed_label').show();
				} else{
					if(result == 202){
						modal.loading(false);
						location.href = '<?=base_url("site/profile");?>';
					}
				}
			});
		}
	});
</script>