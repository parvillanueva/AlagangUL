<div class="container-fluid">
	<div class="au-container au-exfilter au-padding">
		<form action="" class="au-form" id="filter">
			<div class="row">
				<div class="col au-max-width">
					<div class="row">
						<div class="col-lg col-sm-12">
							<span class="au-stitle">Search</span>
							<div class="form-row">
								<div class="au-iconned-mini">
									<i class="fas fa-search"></i>
									<input type="text" class="form-control" id="search" placeholder="Type a keyword" name="search">
								</div>
							</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Program</span>
							<div class="form-row">
								<select class="form-control custom-select" id="program">
									<option value="" selected="">All Programs</option>
									<?php foreach($program as $pro_loop){ ?>
										<option value="<?php echo $pro_loop->id; ?>"><?php echo $pro_loop->name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Event</span>
							<div class="form-row">
								<select class="form-control custom-select" id="select_event">
									<option value="" selected="">All Event</option>
									<?php foreach($event_task as $ttask=>$etloop){ ?>
										<?php if(!empty($etloop['task'])){ ?>
										<optgroup label="<?= $ttask;?>">
											<?php foreach($etloop['task'] as $task){?>
												<option value="<?= $task->task;?>" badge-id="<?= $etloop['badge_id'];?>" ><?= $task->task;?></option>
										<?php } } }?>
								</select>
							</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Division</span>
							<div class="form-row">
								<select class="form-control custom-select" id="select_division">
									<option value="" selected="">All Division</option>
									<?php foreach($division as $div_loop){ ?>
										<option value="<?php echo $div_loop->id; ?>"><?php echo $div_loop->name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Date Volunteered</span>
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
							<button type="button" class="btn btn-primary au-btnblue" id="btnSubmitSearch">Search</button><button type="reset" class="btn btn-primary au-btnblue au-reset" id="reset" title="reset"><i class="fas fa-redo-alt"></i></button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-md-6"></div>
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
						<table id="myTable" class="table">
							<thead id="table_header">
								<tr>
									<th scope="col">Program</th>
									<th scope="col">Event</th>
									<th scope="col">Task</th>
									<th scope="col">Employee</th>
									<th scope="col">Division</th>
									<th scope="col">Email Address</th>
									<th scope="col" class="remove_img">Work Number</th>
									<th scope="col" class="remove_img">Date Volunteered</th>
								</tr>
							</thead>
							<tbody id="table_tbody" class="tbody_table">
								<?php $this->load->view('site/report/volunteered_listview', $type_vol)?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-md-6">
				<ul class="pagination"></ul>
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
	
	$(document).on('click', '#btnSubmitSearch', function(result){
		var search = $('#search').val();
		var program = $('#program').val();
		var event = $('#select_event').val();
		var division = $('#select_division').val();
		var date = $('#date_input').val();
		var limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/volunteered_filter') ?>";
		var data = {
			'search' : search,
			'program' : program,
			'event' : event,
			'division' : division,
			'date' : date,
			'limit' : limit
		}
		aJax.post(url, data, function(result){
			$('#table_tbody').html(result);
		});
	});
	
	$(document).on('click','#reset',function(){
		location.reload();
	});
	
	function get_data_filter(){
		var search = $('#search').val();
		var program = $('#program').val();
		var event = $('#select_event').val();
		var division = $('#select_division').val();
		var date = $('#date_input').val();
		var limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/volunteered_filter') ?>";
		var data = {
			'search' : search,
			'program' : program,
			'event' : event,
			'division' : division,
			'date' : date,
			'limit' : limit
		}
		aJax.post(url, data, function(result){
			$('#table_tbody').html(result);
		});
		pagination("<?php echo $total_data ?>", limit);	
	}
	
	function get_data_filter_pagination(){
		var search = $('#search').val();
		var program = $('#program').val();
		var event = $('#select_event').val();
		var division = $('#select_division').val();
		var date = $('#date_input').val();
		var limit = $('#filter_limit').val();
		var url = "<?php echo base_url('site/report/volunteered_filter') ?>";
		var data = {
			'search' : search,
			'program' : program,
			'event' : event,
			'division' : division,
			'date' : date,
			'limit' : limit
		}
		aJax.post(url, data, function(result){
			$('#table_tbody').html(result);
		});	
	}
	
	function filter_pagination(limit_page, total){
		var search = $('#search').val();
		var program = $('#program').val();
		var event = $('#select_event').val();
		var division = $('#select_division').val();
		var date = $('#date_input').val();
		var limit = $('#filter_limit').val();
		var limit_set = ""+limit_page+","+total+"";	
		var url = "<?php echo base_url('site/report/volunteered_filter')?>";
		var data = {
			'search' : search,
			'program' : program,
			'event' : event,
			'division' : division,
			'date' : date,
			'limit' : limit_set
		}
		aJax.post(url, data, function(result){
			$('#table_tbody').html(result);
		});
	}
</script>