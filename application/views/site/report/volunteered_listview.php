<?php 
if(!empty($type_vol_list)){
	foreach($type_vol_list as $in_loop){ ?>
	<tr class="forvolunteer volunteer">
		<td data-header="Program"><?php echo $in_loop['program_name']; ?></td>
		<td data-header="Event"><?php echo $in_loop['event_name']; ?></td>
		<td data-header="Task"><?php echo $in_loop['task_name']; ?></td>
		<td data-header="Employee"><?php echo $in_loop['profile_name']; ?></td>
		<td data-header="Division"><?php echo $in_loop['division']; ?></td>
		<td data-header="Email Address"><?php echo $in_loop['email']; ?></td>
		<td data-header="Work Number"><?php echo $in_loop['work_number']; ?></td>
		<td data-header="Date Volunteered"><?php echo date('m/d/Y H:i:s', strtotime($in_loop['date_volunteer'])); ?></td>
	</tr>
	
<?php  }} else{	?>
	<tr><td style="text-align:center" colspan="8"><strong>No Data Found!</strong></td></tr>
<?php } ?>