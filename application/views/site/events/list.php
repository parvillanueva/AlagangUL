<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Explore Events</span>
	</div>
</div>

<div class="container-fluid">

	<div class="au-container au-exfilter au-padding">

		<form action="" class="au-form" id="filter">
			<div class="row">
				<div class="col au-max-width">
					<div class="row">
						<div class="col-lg col-sm-12">
							<span class="au-stitle">Search</span>
							<div class="form-row">
								<div class="au-iconned-mini">
									<i class="fas fa-search"></i>
									<input type="text" class="form-control" id="search" placeholder="Type a keyword" name="search">
								</div>
							</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Volunteer Type</span>
							<div class="form-row">
								<select class="form-control custom-select" >
									<option value="" selected>All Types</option>
									<option value="sample">Sample</option>
				  				</select>
			  				</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Schedule</span>
							<div class="form-row">
								<input type="text" class="form-control" id="date" placeholder="Type a keyword" name="date">
			  				</div>
						</div>
						<div class="col-lg col-sm-6">
							<span class="au-stitle">Tasks</span>
							<div class="form-row">
								<select class="form-control custom-select" >
									<option value="" selected>All Tasks</option>
									<option value="sample">Sample</option>
				  				</select>
			  				</div>
						</div>
					</div>
				</div>
				<div class="au-inner au-searchbtn">
					<div class="col">
						<span class="au-stitle">&nbsp;</span>
						<div class="form-row right-flex">
							<button type="submit" class="btn btn-primary au-btnblue" id="btnSubmit">Search</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<div class="form-row">
						<select class="form-control custom-select" >
							<option value="" selected>Sorted by: Date</option>
							<option value="sample">Sample</option>
		  				</select>
	  				</div>
				</div>
			</div>
		</form>

		<div class="au-eventswrapper row">
			<div class="col">
				<div class="row">

					<div class="col-12"><span class="au-ptitle">January</span></div>
					<!-- add this classes for volunteer types: vol-time vol-talent vol-treasure -->
					<!-- add this classes if user already volunteered: volunteered-->
					<div class="au-event-entry col-lg-6 vol-time vol-treasure volunteered" id="progress1">
						<div class="au-event">
							<div class="row">
								<div class="col-sm-4 au-eventthumbnail">
									<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 10 points</span>
									<span class="au-accpoints au-accpointsv"><div class="au-heart"><i class="fas fa-heart"></i></div>Volunteered</span>
									<img src="assets/img/au-sample-thumbnail.jpg" class="au-eventimg">
								</div>
								<div class="col-sm-8 au-eventdetails">
									<div class="au-program">
										<a href="eventdetails.html" class="au-lnk">
											<div class="au-pthumbnail">
												<img src="assets/img/au-akap.jpg" class="au-fp-thumbnailimg">
											</div>
											<span class="au-ptitle">Community Wellness Program Community Wellness Program</span>
											<span class="au-pdetails">AKAP is rooted in social partnerships with the aim of providing quality healthcare to a target population. In collaboration with the city/municipal/provincial health office, the local government unit, churches, non-profits and community organizations, attendees are given medical interventions which include check-up, diagnosis, health talks, provision of medicines and follow through as needed. As part of sustainability, patients are being referred to the local health center for holistic intervention.</span>
										</a>
									</div>
									<div class="au-programdetails">
										<div class="au-inner">
											<span class="au-pans"><span class="au-pques">When:</span>January 19, 2020 2:00PM</span>
										</div>
										<div class="au-inner">
											<span class="au-pans"><span class="au-pques">Where:</span>Barangay Lorem Ipsum Dolor, Muntinlupa City, Metro Manila</span>
										</div>
									</div>
									<div class="au-volunteers">
										<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
										<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
										<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
									</div>
									<div class="au-action">
										<div class="row">
											<div class="col"><span class="au-needed">100 volunteers needed</span></div>
											<div class="col">
												<a href="eventdetails.html"><button type="button" class="au-volunteer au-btnyellow float-right">Volunteer</button></a>
												<button type="button" class="au-volunteered au-btnyellow float-right">Volunteered</button>
											</div>
										</div>
									</div>
									<div class="au-pprogress">
										<div class="au-bar"></div>
										<span class="au-numbers"><i class="fas fa-walking"></i> 80 of 100 Volunteers</span>
									</div>
								</div>
							</div>
						</div>
					</div>

			 		<!-- add this classes for volunteer types: vol-time vol-talent vol-treasure -->
					<!-- add this classes if user already volunteered: volunteered-->
					<div class="au-event-entry col-lg-6 vol-time vol-treasure vol-talent" id="progress2">
						<div class="au-event">
							<div class="row">
								<div class="col-sm-4 au-eventthumbnail">
									<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 10 points</span>
									<span class="au-accpoints au-accpointsv"><div class="au-heart"><i class="fas fa-heart"></i></div>Volunteered</span>
									<img src="assets/img/au-sample-thumbnail.jpg" class="au-eventimg">
								</div>
								<div class="col-sm-8 au-eventdetails">
									<div class="au-program">
										<a href="eventdetails.html" class="au-lnk">
											<div class="au-pthumbnail">
												<img src="assets/img/au-akap.jpg" class="au-fp-thumbnailimg">
											</div>
											<span class="au-ptitle">Community Wellness Program Community Wellness Program</span>
											<span class="au-pdetails">AKAP is rooted in social partnerships with the aim of providing quality healthcare to a target population. In collaboration with the city/municipal/provincial health office, the local government unit, churches, non-profits and community organizations, attendees are given medical interventions which include check-up, diagnosis, health talks, provision of medicines and follow through as needed. As part of sustainability, patients are being referred to the local health center for holistic intervention.</span>
										</a>
									</div>
									<div class="au-programdetails">
										<div class="au-inner">
											<span class="au-pans"><span class="au-pques">When:</span>January 19, 2020 2:00PM</span>
										</div>
										<div class="au-inner">
											<span class="au-pans"><span class="au-pques">Where:</span>Barangay Lorem Ipsum Dolor, Muntinlupa City, Metro Manila</span>
										</div>
									</div>
									<div class="au-volunteers">												
										<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
										<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
										<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
									</div>
									<div class="au-action">
										<div class="row">
											<div class="col"><span class="au-needed">100 volunteers needed</span></div>
											<div class="col">
												<a href="eventdetails.html" class="au-lnk"><button type="button" class="au-volunteer au-btnyellow float-right">Volunteer</button></a>
												<button type="button" class="au-volunteered au-btnyellow float-right">Volunteered</button>
											</div>
										</div>
									</div>
									<div class="au-pprogress">
										<div class="au-bar"></div>
										<span class="au-numbers"><i class="fas fa-walking"></i> 80 of 100 Volunteers</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- add this classes for volunteer types: vol-time vol-talent vol-treasure -->
					<!-- add this classes if user already volunteered: volunteered-->
					<div class="au-event-entry col-lg-6 vol-time vol-treasure vol-talent" id="progress3">
						<div class="au-event">
							<div class="row">
								<div class="col-sm-4 au-eventthumbnail">
									<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 10 points</span>
									<span class="au-accpoints au-accpointsv"><div class="au-heart"><i class="fas fa-heart"></i></div>Volunteered</span>
									<img src="assets/img/au-sample-thumbnail.jpg" class="au-eventimg">
								</div>
								<div class="col-sm-8 au-eventdetails">
									<div class="au-program">
										<a href="eventdetails.html" class="au-lnk">
											<div class="au-pthumbnail">
												<img src="assets/img/au-akap.jpg" class="au-fp-thumbnailimg">
											</div>
											<span class="au-ptitle">Community Wellness Program Community Wellness Program</span>
											<span class="au-pdetails">AKAP is rooted in social partnerships with the aim of providing quality healthcare to a target population. In collaboration with the city/municipal/provincial health office, the local government unit, churches, non-profits and community organizations, attendees are given medical interventions which include check-up, diagnosis, health talks, provision of medicines and follow through as needed. As part of sustainability, patients are being referred to the local health center for holistic intervention.</span>
										</a>
									</div>
									<div class="au-programdetails">
										<div class="au-inner">
											<span class="au-pans"><span class="au-pques">When:</span>January 19, 2020 2:00PM</span>
										</div>
										<div class="au-inner">
											<span class="au-pans"><span class="au-pques">Where:</span>Barangay Lorem Ipsum Dolor, Muntinlupa City, Metro Manila</span>
										</div>
									</div>
									<div class="au-volunteers">												
										<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
										<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
										<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
									</div>
									<div class="au-action">
										<div class="row">
											<div class="col"><span class="au-needed">100 volunteers needed</span></div>
											<div class="col">
												<a href="eventdetails.html" class="au-lnk"><button type="button" class="au-volunteer au-btnyellow float-right">Volunteer</button></a>
												<button type="button" class="au-volunteered au-btnyellow float-right">Volunteered</button>
											</div>
										</div>
									</div>
									<div class="au-pprogress">
										<div class="au-bar"></div>
										<span class="au-numbers"><i class="fas fa-walking"></i> 80 of 100 Volunteers</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12"><span class="au-ptitle">February</span></div>

					<!-- add this classes for volunteer types: vol-time vol-talent vol-treasure -->
					<!-- add this classes if user already volunteered: volunteered-->
					<div class="au-event-entry col-lg-6 vol-time vol-treasure vol-talent" id="progress4">
						<div class="au-event">
							<div class="row">
								<div class="col-sm-4 au-eventthumbnail">
									<span class="au-accpoints"><div class="au-heart"><i class="fas fa-heart"></i></div> 10 points</span>
									<span class="au-accpoints au-accpointsv"><div class="au-heart"><i class="fas fa-heart"></i></div>Volunteered</span>
									<img src="assets/img/au-sample-thumbnail.jpg" class="au-eventimg">
								</div>
								<div class="col-sm-8 au-eventdetails">
									<div class="au-program">
										<a href="eventdetails.html" class="au-lnk">
											<div class="au-pthumbnail">
												<img src="assets/img/au-akap.jpg" class="au-fp-thumbnailimg">
											</div>
											<span class="au-ptitle">Community Wellness Program Community Wellness Program</span>
											<span class="au-pdetails">AKAP is rooted in social partnerships with the aim of providing quality healthcare to a target population. In collaboration with the city/municipal/provincial health office, the local government unit, churches, non-profits and community organizations, attendees are given medical interventions which include check-up, diagnosis, health talks, provision of medicines and follow through as needed. As part of sustainability, patients are being referred to the local health center for holistic intervention.</span>
										</a>
									</div>
									<div class="au-programdetails">
										<div class="au-inner">
											<span class="au-pans"><span class="au-pques">When:</span>February 19, 2020 2:00PM</span>
										</div>
										<div class="au-inner">
											<span class="au-pans"><span class="au-pques">Where:</span>Barangay Lorem Ipsum Dolor, Muntinlupa City, Metro Manila</span>
										</div>
									</div>
									<div class="au-volunteers">												
										<i class="fas fa-hourglass au-time au-icon" title="Time"></i>
										<i class="fas fa-hands-helping au-talent au-icon" title="Talent"></i>
										<i class="fas fa-gem au-treasure au-icon" title="Treasure"></i>
									</div>
									<div class="au-action">
										<div class="row">
											<div class="col"><span class="au-needed">100 volunteers needed</span></div>
											<div class="col">
												<a href="eventdetails.html" class="au-lnk"><button type="button" class="au-volunteer au-btnyellow float-right">Volunteer</button></a>
												<button type="button" class="au-volunteered au-btnyellow float-right">Volunteered</button>
											</div>
										</div>
									</div>
									<div class="au-pprogress">
										<div class="au-bar"></div>
										<span class="au-numbers"><i class="fas fa-walking"></i> 80 of 100 Volunteers</span>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>

	</div>
</div>