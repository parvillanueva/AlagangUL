<div class="container-fluid">
	<div class="au-container au-padding">
		<div class="row">
			<div class="col text-center"><span class="au-h4">As of <?php echo date('F d, Y h:i A');?></span></div>
		</div>
		<div class="row text-center">
			<div class="au-report">
				<div class="row">
					<div class="col-sm-6 au-padding">
						<div class="au-report-counter"><?php echo $data_set['registered']?></div>
						<div class="au-report-counter-title">Registered</div>
						<div class="au-report-details">Additional <?php echo $data_set['registered_as_of']; ?> Registered as of <?php echo date('F d, Y h:i A');?></div>
					</div>
					<div class="col-sm-6 au-padding">
						<div class="au-report-counter"><?php echo $data_set['emp_volunteer']?></div>
						<div class="au-report-counter-title">Employees have signed up for Volunteer Work</div>
						<div class="au-report-ave"><?php echo round(($data_set['registered'] / $data_set['emp_volunteer']), 1); ?></div><div class="ave-cont">Average employee sign-ups</div>
						<div class="au-report-details">Additional <?php echo $data_set['emp_volunteer_as_of']; ?> Volunteered as of <?php echo date('F d, Y h:i A');?></div>		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>