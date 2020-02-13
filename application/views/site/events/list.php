
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
									<input type="text" class="form-control" id="search" placeholder="Type a keyword" name="search">
								</div>
							</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Volunteer Type</span>
							<div class="form-row">
								<select class="form-control custom-select" >
									<option value="" selected>All Types</option>
									<?php
		                                foreach ($get_volunteer_type as $key => $value) {
		                                    echo '<option  title = "'.$value["name"].'" value="'.$value["id"].'">'.$value["name"].'</option>';
		                                }
		                            ?>
				  				</select>
			  				</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Schedule</span>
							<div class="form-row">
								<input type="date" class="form-control" id="asd" placeholder="Type a keyword" name="date">
			  				</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Tasks</span>
							<div class="form-row">
								<select class="form-control custom-select task" >
									<option value="" selected>All Task</option>
									<?php
		                                foreach ($task as $key => $value) {
		                                    echo '<option  title = "'.$value["task"].'" value="'.$value["id"].'">'.$value["task"].'</option>';
		                                }
		                            ?>
				  				</select>
			  				</div>
						</div>
					</div>
				</div>
				<div class="au-inner au-searchbtn">
					<div class="col">
						<span class="au-stitle">&nbsp;</span>
						<div class="form-row right-flex">
							<button type="submit" class="btn btn-primary au-btnblue" id="btnSubmit" onclick="getData(); return false;">Search</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<div class="form-row">
						<select class="form-control custom-select" >
							<option value="" selected>Sorted by: Date</option>
							<option value="sample">Sample</option>
		  				</select>
	  				</div>
				</div>
			</div>
		</form>

		<div class="au-eventswrapper row">
			
			
				<div class="col">
					<div class="row">
						<div class='col-12'><span class='au-ptitle'>January</span></div>
						<div class="data">

						</div>	
					</div>
				</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	var base_url = '<?=base_url();?>';

	$(document).ready(function(){
		get_data();
	});

	function getData(){
		return false;
	}

	$("#search").on("keyup", function(e) {
	    if(e.which === 13) {
	        var keyword = $(this).val().toLowerCase();
	        get_data(keyword);
	    }
	});

	function get_data(keyword){
		if(keyword){

		}else{
			keyword='';
		}
		var url = base_url + "content_management/global_controller/get_program_events?keyword="+keyword;
		console.log(url);
	 aJax.get(url, function(result){
	 	obj = result;
	 	var html = '';
	 	var html2 = '';
	 	$.each(obj, function(a,b){
	 		console.log(b);
	 		var task = b.task;
	 		console.log(b.when);
	 		const monthNames = ["January", "February", "March", "April", "May", "June",
			  "July", "August", "September", "October", "November", "December"
			];

			const d = new Date(b.when);
			var new_date = monthNames[d.getMonth()];
			html += " <div class='au-event-entry col-lg-6 vol-time vol-treasure volunteered' id='progress1'>";
			html += " <div class='au-event'>";
			html += " <div class='row'>";
			html += " <div class='col-sm-4 au-eventthumbnail'>";
			html += " <span class='au-accpoints'><div class='au-heart'><i class='fas fa-heart'></i></div> 10 points</span>";
			html += " <span class='au-accpoints au-accpointsv'><div class='au-heart'><i class='fas fa-heart'></i></div>Volunteered</span>";
			html += " <img src='"+b.image+"' class='au-eventimg'>";
			html += " </div>";
			html += " <div class='col-sm-8 au-eventdetails'>";
			html += " <div class='au-program'>";
			html += " <a href='eventdetails.html' class='au-lnk'>";
			html += " <div class='au-pthumbnail'>";
			html += " <img src='assets/img/au-akap.jpg' class='au-fp-thumbnailimg'>";
			html += " </div>";
			html += " <span class='au-ptitle'>"+b.title+"</span>";
			html += " <span class='au-pdetails'>"+b.description+"</span>";
			html += " </a>";
			html += " </div>";
			html += " <div class='au-programdetails'>";
			html += " <div class='au-inner'>";
			html += " <span class='au-pans'><span class='au-pques'>When:</span>"+b.when+"</span>";
			html += " </div>";
			html += " <div class='au-inner'>";
			html += " <span class='au-pans'><span class='au-pques'>Where:</span>"+b.where+"</span>";
			html += " </div>";
			html += " </div>";
			html += " <div class='au-volunteers'>";
			html += " <i class='fas fa-hourglass au-time au-icon' title='Time'></i>";
			html += " <i class='fas fa-hands-helping au-talent au-icon' title='Talent'></i>";
			html += " <i class='fas fa-gem au-treasure au-icon' title='Treasure'></i>";
			html += " </div>";
			html += " <div class='au-action'>";
			html += " <div class='row'>";
			html += " <div class='col'><span class='au-needed'>"+b.required_volunteers+" volunteers needed</span></div>";
			html += " <div class='col'>";
			html += " <a href='eventdetails.html'><button type='button' class='au-volunteer au-btnyellow float-right'>Volunteer</button></a>";
			html += " <button type='button' class='au-volunteered au-btnyellow float-right'>Volunteered</button>";
			html += " </div>";
			html += " </div>";
			html += " </div>";
			html += " <div class='au-pprogress'>";
			html += " <div class='au-bar'></div>";
			html += " <span class='au-numbers'><i class='fas fa-walking'></i> 80 of "+b.required_volunteers+" Volunteers</span>";
			html += " </div>";
			html += " </div>";
			html += " </div>";
			html += " </div>";
			html += " </div>";
	 	});
	 	 	$('.data').html(html);
	 });
	}

	function get_task(){

	}
</script>