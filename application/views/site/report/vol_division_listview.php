<?php foreach($vol_division as $vol_loop){ ?>
<tr class="forvolunteer volunteer">
	<td data-header="Division"><?php echo $vol_loop['division_name']; ?></td>
	<td data-header="Registered"><?php echo $vol_loop['registered']; ?></td>
	<td data-header="Volunteered"><?php echo $vol_loop['volunteered']; ?></td>
</tr>
<?php } ?>