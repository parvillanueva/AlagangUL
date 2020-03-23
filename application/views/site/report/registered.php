<div class="container-fluid">
	<div class="au-container au-exfilter au-padding">
		<div class="au-form" id="filter">
			<div class="row">
				<div class="col au-max-width">
					<div class="row">
						<div class="col-lg col-sm-12">
							<span class="au-stitle">Search</span>
							<div class="form-row">
								<div class="au-iconned-mini">
									<i class="fas fa-search"></i>
									<input type="text" class="form-control" id="search_input" placeholder="Type a keyword" name="search">
								</div>
							</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Division</span>
							<div class="form-row">
								<select class="form-control custom-select" id="division_set">
									<option value="">All Division</option>
									<?php foreach($division as $div_loop){ ?>
										<option value="<?php echo $div_loop->id; ?>"><?php echo $div_loop->name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Date Registered</span>
							<div class="form-row">
								<input type="text" class="form-control" id="date_input" placeholder="" name="date" autocomplete="off">
							</div>
						</div>
					</div>
				</div>
				<div class="au-inner au-searchbtn">
					<div class="col">
						<span class="au-stitle">&nbsp;</span>
						<div class="form-row right-flex">
							<button class="btn btn-primary au-btnblue" id="btnSubmitsSearch">Search</button>
							<button type="reset" id="reset" class="btn btn-primary au-btnblue au-reset" title="reset"><i class="fas fa-redo-alt"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6 au-display">
				<div class="au-inner"><span class="au-stitle">Results per page</span></div>
				<div class="au-inner au-displaycount">
					<select class="form-control custom-select filter_limit" name="filter_limit" id="filter_limit">
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
						<table id="myTable" class="table">
							<thead id="table_header">
								<tr>
									<th scope="col">Division</th>
									<th scope="col">Last Name</th>
									<th scope="col">First Name</th>
									<th scope="col">Email Address</th>
									<th scope="col">Work Number</th>
									<th scope="col" class="remove_img">Date Registered</th>
								</tr>
							</thead>
							<tbody id="user_list" class="tbody_table">
								<?php $this->load->view('site/report/registered_listview', $user_info)?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6" id="page_div">
				<ul class="pagination" id="pagination"></ul>
			</div>
			<div class="col-md-6 au-display">
				<div class="au-inner"><span class="au-stitle">Results per page</span></div>
				<div class="au-inner au-displaycount">
					<select class="form-control custom-select filter_limit" name="filter_limit" id="filter_limit">
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
	$(document).ready(function(){
		pagination("<?php echo $total_data ?>", '10');
		$(".table").addSortWidget();
		$(".remove_img img").remove();
		$('#date_input').daterangepicker({
			"showDropdowns": true,
			"linkedCalendars": false,
			"startDate": "01/01/<?= date('Y') ?>",
			"endDate": "12/31/<?= date('Y') ?>"
		  }, function(start, end, label) {
			var start = start.format('YYYY-MM-DD');
			var end = end.format('YYYY-MM-DD');
			var date_set = start+'-'+end;
			$(this).val(date_set);
		});
	});
	
	$(document).on('click', '#btnSubmitsSearch', function(){
		var input_search = $('#search_input').val();
		var select_division = $('#division_set').val();
		var date_input = $('#date_input').val();
		var filter_limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/user_search')?>";
		var data = {
			search : input_search,
			division : select_division,
			date : date_input,
			filter_limit : filter_limit
			
		}
		aJax.post(url, data, function(result){
			$('#user_list').html(result);
		}); 
	});
	
	function get_data_filter(){
		var input_search = $('#search_input').val();
		var select_division = $('#division_set').val();
		var date_input = $('#date_input').val();
		var filter_limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/user_search')?>";
		var data = {
			search : input_search,
			division : select_division,
			date : date_input,
			filter_limit : filter_limit
			
		}
		aJax.post(url, data, function(result){
			$('#user_list').html(result);
		}); 
		pagination("<?php echo $total_data ?>", filter_limit);
	}
	
	function get_data_filter_pagination(){
		var input_search = $('#search_input').val();
		var select_division = $('#division_set').val();
		var date_input = $('#date_input').val();
		var filter_limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/user_search')?>";
		var data = {
			search : input_search,
			division : select_division,
			date : date_input,
			filter_limit : filter_limit
			
		}
		aJax.post(url, data, function(result){
			$('#user_list').html(result);
		}); 		
	}
	
	function filter_pagination(limit_page, total){
		var input_search = $('#search_input').val();
		var select_division = $('#division_set').val();
		var date_input = $('#date_input').val();
		var limit_set = ""+limit_page+","+total+"";	
		var filter_limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/user_search')?>";
		var data = {
			search : input_search,
			division : select_division,
			date : date_input,
			filter_limit : limit_set
			
		}
		aJax.post(url, data, function(result){
			$('#user_list').html(result);
		}); 
	}
</script>
