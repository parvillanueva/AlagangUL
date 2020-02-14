<div class="container-fluid au-heading">
	<div class="au-container au-padding">
		<span class="au-h5 no-margin">Manage Programs</span>

		<button class="au-btn float-right" id="btn_addProgram" style="background-color: #11295b;"><i class="fa fa-plus"></i>Add Program</button>
		<button class="au-btn float-right" id="btn_unpublishProgram" style="background-color: #ffc107; display: none;"><i class="fa fa-minus"></i>Unpublish Program</button>
		<button class="au-btn float-right" id="btn_publishProgram" style="background-color: #8bc34a; display: none;"><i class="fa fa-check"></i>Publish Program</button>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container-fluid">
	<div class="au-container au-padding">
		<div class="au-eventswrapper row">
			<div class="col">
				<div class="au-opptable">
					<table>
						<thead>
							<tr>
								<th scope="col" style="width: 30px;"><input type="checkbox" id="select_all"></th>
								<th scope="col">Program</th>
								<th scope="col">Area Covered</th>
								<th scope="col" style="width: 300px;">Created Date</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="program_list">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>