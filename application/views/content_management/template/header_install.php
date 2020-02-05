<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= $title;?></title>
		<meta name="description" content="description" />
		<meta equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="no-cache" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge;" />

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<link rel="stylesheet" href="<?= base_url();?>cms/font-awesome/css/font-awesome.min.css">
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

		<script type="text/javascript" src="<?= base_url();?>/cms/js/jquery.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/cms/js/bootstrap.min.js" ></script>
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

		<!-- For Export -->
		<script type="text/javascript" src="<?= base_url();?>/assets/js/FileSaver.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/assets/js/xlsx.core.min.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/assets/js/tableExport.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/assets/js/jquery.base64.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/assets/js/sprintf.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/assets/js/jspdf.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/assets/js/base64.js" ></script>
		<script type="text/javascript" src="<?= base_url();?>/assets/js/jspdf.plugin.table.js" ></script>

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