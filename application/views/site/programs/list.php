<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Explore Programs</span>
	</div>
</div>

<div class="container-fluid">

	<div class="au-container au-exfilter au-padding">

		<!-- <form action="" class="au-form" id="filter">
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
		</form> -->

		<div class="au-eventswrapper row">
			<div class="col">
				<div class="row">
			        {programs}
			            <div class="col-lg-4 col-sm-6">
			                <div class="au-featured-program">
			                    <div class="au-fp-thumbnail">
			                        <img src="<?=base_url()?>{image_thumbnail}" class="au-fp-thumbnailimg">
			                    </div>
			                    <div class="au-fp-details">
			                        <span class="au-p1">{name}</span>
			                        <span class="au-p2">{overview}</span>
			                        <div class="au-fp-fdetails">
			                            <span class="au-p2 au-memcounter"><i class="fas fa-user-friends"></i> {member_count} </span>
			                            <a href="<?= base_url("programs");?>/{id}/{url_alias}"><button type="button" class="au-btnyellow">Read More</button></a>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        {/programs}
			        </div>
			</div>

		</div>

	</div>
</div>