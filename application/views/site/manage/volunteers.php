<style type="text/css">
	
	.btn_approve:hover{
		color: white ;
	}
	.btn_disqualify:hover{
		color: white ;
	}

</style>

<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Manage Volunters</span>
		<button class="au-btn" id="btn_Closebtn" style="background-color: #f44336;"><i class="fa fa-times"></i>Close</button>
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
								<!-- <th scope="col" style="width: 30px;"><input type="checkbox" id="select_all"></th> -->
								<th scope="col">Possible task for volunteers</th>
								<th scope="col">Volunteer Name</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="volunteers_list">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?= base_url();?>/assets/site/js/bootstrap-show-modal.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		get_list();
	});

   function get_list(){
            $.ajax({
                type : "POST",
                url  :  "<?= base_url('site/manage/volunteers_list');?>",
                dataType : "JSON",
                data : {event_id:"<?= $event_id; ?>"},
                  beforeSend: function() {
                  },
                  success: function(data) {
                  },
                  complete: function(data){
                    var obj = data.responseJSON;
                    // console.log(obj);
                    var html = '';
                   	$.each(obj, function(x,y){
                   		console.log(y)
							html += '	<tr class="forvolunteer">'
							html += '		<td data-header="Task">'+y["task_name"]+'</td>'
							html += '		<td data-header="Volunteer Name">'+y["volunteer_name"]+'</td>'
								 if(y['status'] == 0){ 

						  			html += "	<td>" ;
						  			html += "		<a href='javascript:void(0)'  class='au-btnyellow btn_approve' data-user_id = '"+y["volunteer_id"]+"' data-event_task_id = '"+y["event_task_id"]+"' data-id = '"+y["approval_id"]+"'  data-points = '"+y["points"]+"' style='background-color: #1894e7; float: left;'>Qualify</a>";
						  			html += "		<a href='javascript:void(0)'   class='au-btnyellow btn_disqualify ' data-user_id = '"+y["volunteer_id"]+"' data-event_task_id = '"+y["event_task_id"]+"' data-id = '"+y["approval_id"]+"'  data-points = '"+y["points"]+"' style='background-color: red; float: left;'>Disqualify</a>";
						  			// html += "		<a href=''  class='au-btnyellow' style='background-color: #132b62; float: left;'>></a>";
						  			html += "	</td>";
								}
								else if(y['status'] == 1){
						  			html += "	<td>" ;
						  			html += "		<a href='javascript:void(0)'   class='au-btnyellow btn_disqualify ' data-user_id = '"+y["volunteer_id"]+"' data-event_task_id = '"+y["event_task_id"]+"' data-id = '"+y["approval_id"]+"'  data-points = '"+y["points"]+"' style='background-color: red; float: left;'>Disqualify</a>";
						  			// html += "		<a href=''  class='au-btnyellow' style='background-color: #132b62; float: left;'>></a>";
						  			html += "	</td>";						
								}
								else{				
						  			html += "	<td>" ;
						  			html += "		<a href='javascript:void(0)'   class='au-btnyellow btn_approve' data-user_id = '"+y["volunteer_id"]+"' data-event_task_id = '"+y["event_task_id"]+"' data-id = '"+y["approval_id"]+"'  data-points = '"+y["points"]+"' style='background-color: #1894e7; float: left;'>Qualify</a>";
						  			// html += "		<a href=''  class='au-btnyellow' style='background-color: #132b62; float: left;'>></a>";
						  			html += "	</td>";
								}
							html += '	</tr>'
                   	});
                   	$('#volunteers_list').html(html);

                  }
            });

    }



    $(document).on("click", '.btn_approve', function(event) {
    	var user_id = $(this).attr('data-user_id');
    	var points = $(this).attr('data-points');
    	var approval_id = $(this).attr('data-id');
    	var event_task_id = $(this).attr('data-event_task_id');

    	BM.confirm("Are you sure you want to Qualify selected Volunteer?", function(result){
			if(result){
	            $.ajax({
	                type : "POST",
	                url  :  "<?= base_url('site/manage/update_task_user');?>",
	                dataType : "JSON",
	                data : {approval_id:approval_id,points:points,user_id:user_id,event_task_id:event_task_id},
	                  beforeSend: function() {
	                  },
	                  success: function(data) {
	                  },
	                  complete: function(data){
	                    get_list();
	                  }
	            });
			}
		});

	});

    $(document).on("click", '.btn_disqualify', function(event) {
    	var user_id = $(this).attr('data-user_id');
    	var points = $(this).attr('data-points');
    	var approval_id = $(this).attr('data-id');
    	var event_task_id = $(this).attr('data-event_task_id');

    	BM.confirm("Are you sure you want to Disqualify selected Volunteer?", function(result){
            $.ajax({
                type : "POST",
                url  :  "<?= base_url('site/manage/disqualify_task_user');?>",
                dataType : "JSON",
                data : {approval_id:approval_id,points:points,user_id:user_id,event_task_id:event_task_id},
                  beforeSend: function() {
                  },
                  success: function(data) {
                  },
                  complete: function(data){
                    get_list();
                  }
            });
    	});
	});



</script>