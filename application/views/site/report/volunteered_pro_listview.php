<?php foreach($vol_prog_list as $loop){ ?>
	<tr class="forvolunteer volunteer">
		<td data-header="Programs"><?php echo $loop['program_name']; ?></td>
		<td data-header="Needed"><?php echo $loop['needed']; ?></td>
		<td data-header="Volunteered"><?php echo $loop['volunteered']; ?></td>
		<td data-header="Difference"><?php echo $loop['difference']; ?></td>
	</tr>
<?php } ?>