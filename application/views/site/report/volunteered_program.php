<div class="container-fluid">
	<div class="au-container au-exfilter au-padding">
		<div class="au-form" id="filter">
			<div class="row">
				<div class="col au-max-width">
					<div class="row">
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Program</span>
							<div class="form-row">
								<select class="form-control custom-select" id="program_filter">
									<option value="" selected="">All Programs</option>
									<?php foreach($program as $pro_loop){ ?>
										<option value="<?php echo $pro_loop->id; ?>"><?php echo $pro_loop->name; ?></option>
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
									<th scope="col">Programs</th>
									<th scope="col">Needed</th>
									<th scope="col">Volunteered</th>
									<th scope="col">Difference</th>
								</tr>
							</thead>
							<tbody id="program_listview">
								<?php $this->load->view("site/report/volunteered_pro_listview",$vol_prog);?>
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
		var program_filter = $('#program_filter').val();
		var filter_limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/vol_program_filter')?>";
		var data = {
			program : program_filter,
			limit : filter_limit
		}
		aJax.post(url, data, function(result){
			$('#program_listview').html(result);
		}); 
	});
	
	$(document).on('click','#reset',function(){
		location.reload();
	});
	
	function get_data_filter(){
		var program_filter = $('#program_filter').val();
		var filter_limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/vol_program_filter')?>";
		var data = {
			program : program_filter,
			limit : filter_limit
		}
		aJax.post(url, data, function(result){
			$('#program_listview').html(result);
		}); 
	}
</script>