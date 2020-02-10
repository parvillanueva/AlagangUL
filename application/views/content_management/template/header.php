<!DOCTYPE html>
<html lang="en">
	<head>
		<?php  $cms_title = $this->load->active_list("cms_preference"); ?>

		<title><?= $cms_title[0]->cms_title?> - <?= $PageName;?></title>
		<meta name="description" content="description" />
		<meta equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="no-cache" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge;" />

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<link rel="stylesheet" href="<?= base_url();?>cms/font-awesome/css/font-awesome.min.css">
		<link href="<?= base_url();?>cms/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/cms.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/dropzone.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/iconpicker.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>cms/css/datetimepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>cms/css/timepicki.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/datatables.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/morris.js/morris.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/powertip/jquery.powertip.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/bootstrap-material-datetimepicker.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>cms/css/breadcrumb/<?= $cms_title[0]->cms_skin?>.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="<?= base_url();?>/cms/js/jquery.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/filetree/php_file_tree_jquery.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/bootbox.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/moment.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/custom.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/dropzone.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/app.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/jquery-ui.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/numeral.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/iconpicker.js" ></script>
        <script type="text/javascript" src="<?= base_url();?>/cms/js/datetimepicker.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/timepicki.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/ckeditor/ckeditor.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/ckeditor/config.js" ></script>
        <script type="text/javascript" src="<?= base_url();?>/cms/raphael/raphael.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/datatables.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/morris.js/morris.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/powertip/jquery.powertip.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/resumable.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/bootstrap.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/placeholder.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/bootstrap-material-datetimepicker.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/jscolor.js" ></script>

		<!-- For Export -->
		<script type="text/javascript" src="<?= base_url();?>/cms/js/FileSaver.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/xlsx.core.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/tableExport.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/jquery.base64.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/sprintf.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/jspdf.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/base64.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/jspdf.plugin.table.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/jquery.tablesorter.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/gcontroller.js" ></script>
        <style type="text/css">
                .cke_button__youtube_label { display: inline !important; }
                pre { border-radius: 0px !important; }
        </style>

	
        <!--- declaring form validation error message-->
        <script type="text/javascript">
            var base_url = "<?= base_url();?>";
            var form_empty_error = "<?= $this->standard->dialog("form_empty");?>";
            var form_invalid_email = "<?= $this->standard->dialog("form_invalid_email");?>";
            var form_script = "<?= $this->standard->dialog("form_script");?>";
            var form_invalid_mobile_no = "<?= $this->standard->dialog("form_invalid_mobile_no");?>";
            var form_nohtml = "<?= $this->standard->dialog("form_nohtml");?>";
            var form_invalid_extension = "<?= $this->standard->dialog("form_invalid_extension");?>";
            var form_max_size = "<?= $this->standard->dialog("form_max_size");?>";
            var form_invalid_captcha = "<?= $this->standard->dialog("form_invalid_captcha");?>";

        </script>


        <script  type="text/javascript" >

	        window.onload = function(){
			  	var tableCont = document.querySelector('.tbl-content')
			  	
				  function scrollHandle (e){
				    var scrollTop = this.scrollTop;
				    this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';

				  }
			  
			    tableCont.addEventListener('scroll',scrollHandle)
			}
        </script>

	    <!--- checking internet and database connection -->    
	    <!-- <script type="text/javascript">
	    	var click_return = true;
			$(document).on('click','a',function(event){
				checkConnections();
				return click_return;
		    });

		    $(document).on('click','button',function(event){
		        checkConnections();
				return click_return;
		    });
			
			function checkConnections(callback){
				$("#loading_div_standard").show();
				$.ajax(
					{
						url: "<?= base_url();?>", 
						async: false,
						success: function(data, textStatus, jqXHR){
							$("#loading_div_standard").hide();
			        		click_return = true;
			    		},
			    		error: function(XMLHttpRequest, textStatus, errorThrown) {
							$("#loading_div_standard").hide();
					        if (XMLHttpRequest.readyState == 4) {
					            // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
					            modal.alert('<h4><center><i class="fa fa-database fa-2x"></i><br><br>Something went wrong and we couldnt complete your request.</center></h4>');
					            click_return = false;
					        }
					        else if (XMLHttpRequest.readyState == 0) {
					            // Network error (i.e. connection refused, access denied due to CORS, etc.)
					            modal.alert('<h4><center><i class="fa fa-wifi fa-2x"></i><br><br>Cannot connect, Please check your internet connection.</center></h4>');
					            click_return = false;
					        } else {
					        	return false;
					        }
					    }
					}
				);
			};
		</script> -->

		<style type="text/css">
			#loading_div_standard {
				position: absolute;
				top: 50%;
				left: 50%;
				width: 200px;
				height: 50px;
				margin-top: -25px;
				margin-left: -100px;
				text-align: center;
				display: none;
			}

		</style>
	</head>
	
	<p id="loading_div_standard"><i class="fa fa-spinner fa-spin" style="font-size:54px"></i></p>