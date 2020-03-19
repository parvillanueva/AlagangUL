<script src="<?= base_url();?>assets/site/js/custom_report.js" text="type/javascript"></script>
<div class="au-wrapper">
	<div class="container-fluid au-heading">
		<div class="au-container au-padding">
			<button class="au-btn float-right" id="excel_extract"> Export to Excel</button>
			<span class="au-h5 no-margin">Alagang Unilab Report</span>
		</div>
		<div class="au-container">
			<div class="row au-tab-menu au-tab-menu-desktop">
				<a href="<?php echo base_url('registered_volunteered')?>"><button class="au-tab-menu-link" id="reg_vol">Registered and Volunteered</button></a>

				<a href="<?php echo base_url('volunteered_division')?>"><button class="au-tab-menu-link" id="vol_div">Registered and Volunteered By Division</button></a>

				<a href="<?php echo base_url('volunteered_program')?>"><button class="au-tab-menu-link" id="vol_prog">Volunteered by Program</button></a>

				<a href="<?php echo base_url('volunteer_type')?>"><button class="au-tab-menu-link" id="vol_type">Volunteer Type</button></a>

				<a href="<?php echo base_url('registered')?>"><button class="au-tab-menu-link" id="reg">Registered</button></a>
				
				<a href="<?php echo base_url('volunteered')?>"><button class="au-tab-menu-link" id="vol">Volunteered</button></a>
			</div>
		</div>
	</div>
	<?php $this->load->view($content_view, $data_set); ?>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var module = "<?php echo $module ?>";
		switch(module){
			case 'registered_volunteered':
				$('#reg_vol').addClass('active');
				$('#excel_extract').remove();
			break;
			case 'volunteered_division':
				$('#vol_div').addClass('active');
				$('#excel_extract').addClass('vol_div_excel');
			break;
			case 'volunteered_program':
				$('#vol_prog').addClass('active');
				$('#excel_extract').addClass('vol_prog_excel');
			break;
			case 'volunteer_type':
				$('#vol_type').addClass('active');
				$('#excel_extract').addClass('vol_type_excel');
			break;
			case 'registered':
				$('#reg').addClass('active');
				$('#excel_extract').addClass('reg_excel');
			break;
			case 'volunteered':
				$('#vol').addClass('active');
				$('#excel_extract').addClass('vol_excel');
			break;
		}
		
	});
	
	$(document).on('change', '#filter_limit', function(){
		get_data_filter();
	});

	
	$(document).on('click', '#excel_extract', function(){
		var header = Array();
		$("#table_header tr th").each(function(i, v){
			header[i] = $(this).text();
        });
		
		var body = Array();
            
        $(".tbody_table tr").each(function(i, v){
            body[i] = Array();
            $(this).children('td').each(function(ii, vv){
                body[i][ii] = $(this).text();
            }); 

        });
		
		var data = {
			header : header,
			body : body,
			title : "<?php echo $title_set; ?>"
		}
		var url = "<?php echo base_url('site/report/table_excel_report') ?>";
		$('<form id="filterform" method="POST" action="'+url+'"><input type="text" hidden name="data" value=' + "'" +JSON.stringify(data) + "'" + ' /></form>').appendTo("body").submit();
	});
</script>