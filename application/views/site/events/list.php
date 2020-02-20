
<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Explore Events</span>
	</div>
</div>

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
									<input type="text" class="form-control" id="search_input" placeholder="Type a keyword" name="search">
								</div>
							</div>
						</div>
						<!--<div class="col-lg col-sm-6">
							<span class="au-stitle">Volunteer Type</span>
							<div class="form-row">
								<select class="form-control custom-select" id="types_select">
									<option value="" selected>All Types</option>
									<?php //foreach($badges as $bloop){ ?>
										<option value="<?php //echo $bloop->id;?>"><?php //echo $bloop->name;?></option>
									<?php //} ?>
				  				</select>
			  				</div>
						</div>-->
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Schedule</span>
							<div class="form-row">
								<input type="text" class="form-control" id="date_input" readonly="true" placeholder="Type a keyword" name="date">
			  				</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Location</span>
							<div class="form-row">
								<select class="form-control custom-select" id="location">
									<option value="" selected>All Types</option>
									<?php foreach($event_program as $eprogram){ ?>
										<option value="<?php echo $eprogram->where;?>"><?php echo $eprogram->where;?></option>
									<?php } ?>
				  				</select>
			  				</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Tasks</span>
							<div class="form-row">
								<select class="form-control custom-select" id="task_select">
									<option value="" selected>All Tasks</option>
									<?php foreach($event_task as $etloop){ ?>
										<option value="<?= $etloop->task;?>"><?= $etloop->task;?></option>
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
							<button type="button" class="btn btn-primary au-btnblue" id="btnSubmit">Search</button>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="row">
				<div class="col-lg-2">
					<div class="form-row">
						<select class="form-control custom-select" >
							<option value="" selected>Sorted by: Date</option>
							<option value="sample">Sample</option>
		  				</select>
	  				</div>
				</div>
			</div>-->
		</form>

		<div class="au-eventswrapper row" id="event_view">
			<?php $this->load->view('site/events/event_list', $events)?>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
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
	
	$(document).on('click', '#btnSubmit', function(){
		BM.loading(true);
		var search_box = $('#search_input').val();
		var location = $('#location').val();
		var task = $('#task_select').val();
		var date = $('#date_input').val();
		var url = "<?= base_url('site/events/submit_filter') ?>";
		var data = {
			search_box : search_box,
			location : location,
			task : task,
			date : date
		};
		aJax.post(url, data, function(result){
			setTimeout(function(){ 
				$('#event_view').html(result);
				BM.loading(false)
			}, 500);
		});

	});
</script>