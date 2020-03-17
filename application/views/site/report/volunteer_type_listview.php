<?php foreach($type_list['data'] as $key=>$in_loop){ ?>
	<tr class="forvolunteer volunteer">
		<td data-header="<?php echo $key; ?>"><?php echo $key; ?></td>
		<?php foreach($in_loop as $keyin=>$loop){ ?>
			<td data-header="<?php echo $keyin; ?>"><?php echo $loop; ?></td>	
		<?php } ?>
	</tr>
<?php } ?>