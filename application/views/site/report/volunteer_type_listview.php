<?php 
if(!empty($type_list['data'] )){
	foreach($type_list['data'] as $key=>$in_loop){ ?>
	<tr class="forvolunteer volunteer">
		<td data-header="<?php echo $key; ?>"><?php echo $key; ?></td>
		<?php foreach($in_loop as $keyin=>$loop){ ?>
			<td data-header="<?php echo $keyin; ?>"><?php echo $loop; ?></td>	
		<?php } ?>
	</tr>
<?php }} else{ 
		$colspan = count($olddata['header'][0]) + 1;
		echo '<tr><td style="text-align:center" colspan="'.$colspan.'" ><strong>No Data Found!</strong></td></tr>';
 } ?>