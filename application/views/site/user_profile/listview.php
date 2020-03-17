<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">User List</span>

		<div class="au-form" id="filter">
			<div class="row">
				<div class="col au-max-width">
					<div class="row">
						<div class="col-lg col-sm-12">
							<span class="au-stitle">&nbsp;</span>
							<div class="form-row">
								<button class="btn btn-primary" id="btn_addUser" style="background-color: #11295b;"><i class="fa fa-plus"></i>Add User</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
								<!--<th scope="col" style="width: 30px;"><input type="checkbox" id="select_all"></th>-->
								<th scope="col">Name</th>
								<th scope="col">Email Address</th>
								<!-- <th scope="col">Area Covered</th> -->
								<th scope="col" style="width: 300px;">Created Date</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="user_list">
							<?php $this->load->view('site/user_profile/listview_loop', $user_info)?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade text-center" id="AddUserProfile" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <span class="au-h4">Add Profile</span>
                    <form class="au-form" id="addprofile">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control required_input no_html alphaonly" id="fname" placeholder="First Name" value="" name="fname" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Entry.</div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control required_input no_html alphaonly" id="lname" placeholder="Last Name" value="" name="lname" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Entry.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control custom-select required_input" id="division" name="division" required="required" />
                                        <option value="" selected disabled>Business Unit/Division</option>
                                        <?php foreach($division as $dloop){ ?>
										<option value="<?php echo $dloop->id?>"><?php echo $dloop->name?></option>
										<?php } ?>                               
                                </select>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Entry.</div>
                            </div>
                            <div class="col">
                                <input type="email" class="form-control required_input" id="email" placeholder="Work Email" name="email" required value="">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">Invalid Entry.</div>
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

<script type="text/javascript" src="<?= base_url();?>/assets/site/js/bootstrap-show-modal.js"></script>
<script type="text/javascript">

	var keyword = "";

	$(document).ready(function(){
		//get_list();
	});
	
	/* $(document).on('click', '#btnSubmitsSearch', function(){
		var input_search = $('#search_input').val();
		var select_division = $('#division_set').val();
		var url = "<?php echo base_url('site/user/user_search')?>";
		var data = {
			search : input_search,
			division : select_division
		}
		aJax.post(url, data, function(result){
			$('#user_list').html(result);
		});
	}); */
	
	$(document).on('click', '#btn_addUser', function(){
		$('#AddUserProfile').modal('show');
	});
	
	$(document).on('click', '#btnsubmit_data', function(){
		var url = "<?php echo base_url('site/user/add_user_profile'); ?>";
		var lastname = $('#lname').val();
		var firstname = $('#fname').val();
		var division = $('#division').val();
		var email = $('#email').val();
		var data = {
			lastname : lastname,
			firstname : firstname,
			division : division,
			email : email
		};
		aJax.post(url, data, function(result){
			console.log(result);
		});
	});
	
</script>
