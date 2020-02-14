<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Programs Events</span>

		<button class="au-btn float-right" id="btn_addProgram" style="background-color: #11295b;"><i class="fa fa-plus"></i>Add Event</button>
		<button class="au-btn float-right" id="btn_unpublishProgram" style="background-color: #ffc107; display: none;"><i class="fa fa-minus"></i>Unpublish Event</button>
		<button class="au-btn float-right" id="btn_publishProgram" style="background-color: #8bc34a; display: none;"><i class="fa fa-check"></i>Publish Event</button>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container-fluid">
	<div class="au-container au-padding">
		<div class="au-eventswrapper row">
			<div class="col">
				<div class="au-opptable">
					<table>
						<thead>
							<tr>
								<th scope="col" style="width: 30px;"><input type="checkbox" id="select_all"></th>
								<th scope="col">Title</th>
								<th scope="col" style="width: 200px;">When</th>
								<th scope="col">Where</th>
								<th scope="col" style="width: 100px;">Status</th>
								<th scope="col" style="width: 300px;">Created Date</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="program_list">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?= base_url();?>/assets/site/js/bootstrap-show-modal.js"></script>
<script type="text/javascript">

	var keyword = "";

	$(document).ready(function(){
		get_list();
	});

	function get_list(){
		var url = "<?= base_url("manage/event_list");?>";
		var data = {
			program_id : <?= $program_id;?>
		};
		$.ajax({
		  	type: "POST",
		  	url: url,
		  	data: data,
		  	success: function(result){

		  		console.log(result);
		  		var html = "";
		  		
		  		$.each(result, function(a, b){

		  			var status = "Not Published";
		  			if(b.status == 1){
		  				status = "Published";
		  			}

		  			html += "<tr>";
		  			html += "	<td><input type='checkbox' class='select' data-alias='"+b.url_alias+"' data-id="+b.id+"/></td>";
		  			html += "	<td>" + b.title + "</td>";
		  			html += "	<td>" + moment(b.when).format("LLL") + "</td>";
		  			html += "	<td>" + b.where + "</td>";
		  			html += "	<td>" + status + "</td>";
		  			html += "	<td>" + moment(b.create_date).format("LLL") + "</td>";
		  			html += "	<td>" ;
		  			html += "		<button type='button' class='au-btnyellow editProgramBtn' style='background-color: #ff5722; float: left;'>Edit</button>";
		  			html += "		<a href='"+b.Url+"' target='_blank' type='button' class='au-btnyellow' style='background-color: #2196f3; float: left;'>Manage Page</a>";
		  			html += "		<a href='<?= base_url("manage");?>/"+b.id+"' type='button' class='au-btnyellow' style='background-color: #132b62; float: left;'>Volunteers <span class='badge badge-pill  badge-light'>"+b.volunteers+"</span></a>";
		  			html += "	</td>";
		  			html += "</tr>";
		  		});
		  		$("#program_list").html(html);
		  	}
		});
	}

</script>