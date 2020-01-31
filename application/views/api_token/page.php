<div class="box main-page-install">
	<?php
		$data['buttons'] = ['save'];
		$this->load->view("layout/buttons",$data);
	?>
    <div class="box-body">
		<div class="form-group" id="data_sets">
			<label class="control-label token_android_label col-sm-2">Android<span style="color: red;">*</span> :</label>
			<div class="col-sm-5"><input type="text" name="token_android" value="" class="form-control token_android_input required_input" id="token_android" placeholder="Android" label="Android"></div>
			<a href="#" class="btn btn-primary" id="generate_token" attr-host="token_android"><i class="fa fa-refresh" style="width:55px;"></i> Generate Token</a>
			<div class="col-sm-3 pull-right">
				<select name="android_status" type="dropdown" class="form-control no_html required_input" id="android_status" label="Status" value="">
					<option value="1">Active</option>
					<option value="0">Inactive</option>
				</select>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group" id="data_sets">
			<label class="control-label token_ios_label col-sm-2">IOS<span style="color: red;">*</span> :</label>
			<div class="col-sm-5"><input type="text" name="token_ios" value="" class="form-control token_ios_input required_input" id="token_ios" placeholder="IOS" label="IOS"></div>
			<a href="#" class="btn btn-primary" id="generate_token" attr-host="token_ios"><i class="fa fa-refresh" style="width:55px;"></i> Generate Token</a>
			<div class="col-sm-3 pull-right">
				<select name="ios_status" type="dropdown" class="form-control no_html required_input" id="ios_status" label="Status" value="">
					<option value="1">Active</option>
					<option value="0">Inactive</option>
				</select>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group" id="data_sets">
			<label class="control-label token_web_label col-sm-2">Web<span style="color: red;">*</span> :</label>
			<div class="col-sm-5"><input type="text" name="token_web" value="" class="form-control token_web_input required_input" id="token_web" placeholder="Web" label="Web"></div>
			<a href="#" class="btn btn-primary" id="generate_token" attr-host="token_web"><i class="fa fa-refresh" style="width:55px;"></i> Generate Token</a>
			<div class="col-sm-3 pull-right">
				<select name="web_status" type="dropdown" class="form-control no_html required_input" id="web_status" label="Status" value="">
					<option value="1">Active</option>
					<option value="0">Inactive</option>
				</select>
			</div>
			<div class="clearfix"></div>
		</div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		modal.loading(true);
		var url = "<?php echo base_url().'token/first_load'?>";
		aJax.get(url,function(result){
			if (result != '') {
				var obj = is_json(result);
				$.each(obj, function(i,v){
					switch(v.api_host){
						case 'Android':
							$("#token_android").val(v.api_token);
							$("#android_status").val(v.is_active);
						break;
						case 'IOS':
							$("#token_ios").val(v.api_token);
							$("#ios_status").val(v.is_active);
						break;
						case 'Web':
							$("#token_web").val(v.api_token);
							$("#web_status").val(v.is_active);
						break;
					}
				});
			}
			modal.loading(false);
		});
	});

	$(document).on("click","#generate_token",function(){
		var host_id = $(this).attr('attr-host');
		var url = '<?php echo base_url()."token/generate_token"?>';
		aJax.get(url,function(result){
			var obj = is_json(result);
			$('#'+host_id+'').val(obj.token);
		});
	});

	$(document).on("click","#btn_save",function(){
		var modal_obj = '<?= $this->standard->confirm("confirm_save"); ?>';
		modal.standard(modal_obj, function(result){
			if(result){
			modal.loading(true);
				var token_android = $("#token_android").val();
				var token_ios = $("#token_ios").val();
				var token_web = $("#token_web").val();
				var status_android = $("#android_status").val();
				var status_ios = $("#ios_status").val();
				var status_web = $("#web_status").val();
				var data = {
					'andoid' : {
						'token' : token_android,
						'status' : status_android,
						'host' : 'android',
					},
					'ios' : {
						'token' : token_ios,
						'status' : status_ios,
						'host' : 'ios',
					},
					'web' : {
						'token' : token_web,
						'status' : status_web,
						'host' : 'web',
					}
				};
				var url = "<?php echo base_url().'token/update'?>";
				aJax.post(url,data,function(result){
					var obj = is_json(result);
					var response = obj.response;
					if(response == 'success'){
						var message = '<?= $this->standard->dialog("save_success"); ?>';
						modal.loading(false);
						modal.alert(message);
					} else{
						var message = '<?= $this->standard->dialog("insert_failed"); ?>';
						modal.loading(false);
						modal.alert(message);
					}
				});
			}
		});
	});
</script>
