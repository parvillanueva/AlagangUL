<?php foreach($user_info as $user_loop){ ?>
	<tr>
		<td data-header="Division"><?php echo $user_loop->name; ?></td>
		<td data-header="Last Name"><?php echo $user_loop->last_name; ?></td>
		<td data-header="First Name"><?php echo $user_loop->first_name; ?></td>
		<td data-header="Email Address"><?php echo $user_loop->email_address; ?></td>
		<td data-header="Work Number"><?php echo $user_loop->work_number; ?></td>
		<td data-header="Date Registered"><?php echo date('F d, Y', strtotime($user_loop->create_date)); ?></td>
	</tr>
<?php } ?>