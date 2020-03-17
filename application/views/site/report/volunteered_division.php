<div class="container-fluid">
	<div class="au-container au-exfilter au-padding">
		<div class="au-form" id="filter">
			<div class="row">
				<div class="col au-max-width">
					<div class="row">
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Division</span>
							<div class="form-row">
								<select class="form-control custom-select" id="division_set">
									<option value="" selected="">All Division</option>
									<?php foreach($division as $div_loop){ ?>
										<option value="<?php echo $div_loop->id; ?>"><?php echo $div_loop->name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="au-inner au-searchbtn">
					<div class="col">
						<span class="au-stitle">&nbsp;</span>
						<div class="form-row right-flex">
							<button type="submit" class="btn btn-primary au-btnblue" id="btnSubmitsSearch">Search</button><button type="reset" id="reset" class="btn btn-primary au-btnblue au-reset" title="reset"><i class="fas fa-redo-alt"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<ul class="pagination">
				  <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
				  <li class="page-item active"><a class="page-link" href="#">1</a></li>
				  <li class="page-item"><a class="page-link" href="#">2</a></li>
				  <li class="page-item"><a class="page-link" href="#">3</a></li>
				  <li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
			</div>
			<div class="col-md-6 au-display">
				<div class="au-inner"><span class="au-stitle">Results per page</span></div>
				<div class="au-inner au-displaycount">
					<select class="form-control custom-select filter_limit" id="filter_limit">
						<option value="10">10</option>
						<option value="30">30</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="9999999">ALL</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="au-programdescription">
					<div class="au-opptablex">
						<table id="myTable" class="tablesorter">
							<thead>
								<tr>
									<th scope="col">Division</th>
									<th scope="col">Registered</th>
									<th scope="col">Volunteered</th>
									<option value="9999999">ALL</option>
								</tr>
							</thead>
							<tbody id="division_list">
								<?php $this->load->view("site/report/vol_division_listview",$vol_div); ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<ul class="pagination">
				  <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
				  <li class="page-item active"><a class="page-link" href="#">1</a></li>
				  <li class="page-item"><a class="page-link" href="#">2</a></li>
				  <li class="page-item"><a class="page-link" href="#">3</a></li>
				  <li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
			</div>
			<div class="col-md-6 au-display">
				<div class="au-inner"><span class="au-stitle">Results per page</span></div>
				<div class="au-inner au-displaycount">
					<select class="form-control custom-select filter_limit" id="filter_limit">
						<option value="10">10</option>
						<option value="30">30</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="9999999">ALL</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).on('click', '#btnSubmitsSearch', function(){
		var select_division = $('#division_set').val();
		var filter_limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/division_search')?>";
		var data = {
			division : select_division,
			limit: filter_limit
		}
		aJax.post(url, data, function(result){
			$('#division_list').html(result);
		}); 
	});
	
	$(document).on('click','#reset',function(){
		location.reload();
	});
	
	function get_data_filter(){
		var select_division = $('#division_set').val();
		var filter_limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/division_search')?>";
		var data = {
			division : select_division,
			limit: filter_limit
		}
		aJax.post(url, data, function(result){
			$('#division_list').html(result);
		}); 
	}
</script>