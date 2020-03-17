<?php foreach($user_info as $user_loop){ ?>
	<tr>
		<!--<td><input type='checkbox' class='select'></td>-->
		<td><?php echo $user_loop->first_name.' '. $user_loop->first_name; ?></td>
		<td><?php echo $user_loop->email_address; ?></td>
		<td><?php echo date('F d, Y', strtotime($user_loop->create_date)); ?></td>
		<td><?php echo ($user_loop->status == '1') ? 'Active' : 'Inactive'; ?></td>
		<td><a href='#' class='au-lnk au-action editUserBtn' id='editUserBtn' title='Edit User'><i class='fas fa-edit' id='editUserBtn'></i></a></td>
	</tr>
<?php } ?>