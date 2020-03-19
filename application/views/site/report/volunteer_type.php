<div class="container-fluid">
	<div class="au-container au-exfilter au-padding">
		<div class="row">
			<div class="col text-center"><span class="au-h4">As of February 26, 2020 6:16pm</span></div>
		</div>
		<div class="row text-center">
			<div class="au-report">
				<div class="row">
					<?php foreach($type_info['type_list']['header'][0] as $key=>$in_loop){ ?>
						<div class="col-sm-4 au-padding">
							<div class="au-report-counter-type au-talent"><?php echo $in_loop['total']; ?></div>
							<div class="au-report-counter-title"><img src="<?php echo $in_loop['image']; ?>" title="<?php echo $key; ?>"></div>
							<div class="au-report-details">1,592 volunteers needed</div>
						</div>	
					<?php } ?>
				</div>
			</div>
		</div>

		<form action="" class="au-form" id="filter">
			<div class="row">
				<div class="col au-max-width">
					<div class="row">
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Type</span>
							<div class="form-row">
								<select class="form-control custom-select filter_task">
									<?php foreach($event_task as $pro_loop){ ?>
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
							<button type="button" class="btn btn-primary au-btnblue" id="btnSubmitsSearch">Search</button>
							<button type="reset" class="btn btn-primary au-btnblue au-reset" id="reset" title="reset"><i class="fas fa-redo-alt"></i></button>
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
						<table id="myTable" class="tablesorter">
							<thead id="table_header">
								<tr>
									<td scope="col">Program</td>
									<?php foreach($type_info['type_list']['header'][0] as $key=>$in_loop){ ?>	
										<td scope="col"><?php echo $key; ?></td>	
									<?php } ?>
								</tr>
							</thead>
							<tbody id="tbody_table" class="tbody_table">
								<?php $this->load->view('site/report/volunteer_type_listview', $type_info)?>
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
		<hr>
		<div class="row">
			<div class="au-report au-padding">			
				<div class="au-graph">
					<canvas id="chart" width="400" height="350"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		pagination("<?php echo $total_data ?>", '10');
	});
	$('input[name="date"]').daterangepicker({
		autoUpdateInput: false,
		locale: {
			cancelLabel: 'Clear'
		}
	});
	
	$(document).on('click', '#btnSubmitsSearch', function(){
		var task_val = $(".filter_task").val();
		var filter = $('#filter_limit').val();
		var data = {
			task_val : task_val,
			filter : filter
		}
		var url = "<?php echo base_url('site/report/volunteer_type_report')?>";
		aJax.post(url, data, function(result){
			$('#tbody_table').html(result);
		});
	});

	function get_data_filter(){
		var task_val = $(".filter_task").val();
		var filter_limit = $('#filter_limit').val();
		var data = {
			task_val : task_val,
			filter : filter_limit
		}
		var url = "<?php echo base_url('site/report/volunteer_type_report')?>";
		aJax.post(url, data, function(result){
			$('#program_listview').html(result);
		});
		pagination("<?php echo $total_data ?>", filter_limit);	
	}

	function get_data_filter_pagination(){
		var task_val = $(".filter_task").val();
		var filter = $('#filter_limit').val();
		var data = {
			task_val : task_val,
			filter : filter
		}
		var url = "<?php echo base_url('site/report/volunteer_type_report')?>";
		aJax.post(url, data, function(result){
			$('#program_listview').html(result);
		});		
	}
	
	function filter_pagination(limit_page, total){
		var task_val = $(".filter_task").val();
		var filter_limit = $('#filter_limit').val();
		var limit_set = ""+limit_page+","+total+"";	
		var url = "<?php echo base_url('site/report/volunteer_type_report')?>";
		var data = {
			task_val : task_val,
			filter : limit_set
		}
		aJax.post(url, data, function(result){
			$('#program_listview').html(result);
		});
	}

	//$(function() {
	//	$("#myTable").tablesorter();
	//});
</script>
<!--for graphs-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script type="text/javascript">	
	Chart.defaults.global.elements.responsive = true;
	Chart.defaults.global.legend.display = true;
	Chart.defaults.scale.ticks.beginAtZero = true;
	Chart.defaults.global.elements.line.borderColor = '#5C73F2';
	Chart.defaults.global.elements.point.borderColor = '#5C73F2';
	Chart.defaults.global.elements.point.backgroundColor = '#5C73F2';
	Chart.defaults.global.defaultFontColor = '#222';
	Chart.defaults.global.defaultFontFamily = "myriad-pro, sans-serif";
	Chart.defaults.global.defaultFontStyle = "italic";
	Chart.defaults.global.defaultFontSize = 14;
	Chart.defaults.global.responsive = true;
	Chart.defaults.global.maintainAspectRatio = false;

	var chartcanvas = $('#chart');
	var graph_data_label = <?php echo json_encode($graph['label']) ?>;
	var graph_data = <?php echo json_encode($graph['data']) ?>;
	console.log(graph_data);
	var chartdata = {
		labels: graph_data_label,
		datasets: graph_data,
	};

	var chartoptions = {
		scales: {
			xAxes: [{
				gridLines: {
					drawOnChartArea: false
				}
				,
				stacked: true
			}],
			yAxes: [{
				gridLines: {
					drawOnChartArea: false
				}
				,
				stacked: true,
			}]
		}
	}

	var chart = new Chart(chartcanvas, {
		type: 'horizontalBar',
		data: chartdata,
		options: chartoptions
	});
</script>