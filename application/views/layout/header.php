<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="assets/images/favicon.ico">

<title>Application Monitoring</title>

<!-- ANIMATION -->
<link rel="stylesheet" href="<?= base_url();?>assets/css/animate.min.css">

<!-- FONTAWESOME -->
<link href="<?= base_url();?>assets/css/fontawesome.min.css" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="<?= base_url();?>cms/font-awesome/css/font-awesome.min.css">
<link href="<?= base_url();?>cms/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url();?>cms/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url();?>cms/css/cms.css" rel="stylesheet" type="text/css" />
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

<!-- Custom styles for this template -->
<link href="<?= base_url();?>assets/css/OverlayScrollbars.min.css" rel="stylesheet">
<link href="<?= base_url();?>assets/css/styles.css" rel="stylesheet">
<link href="<?= base_url();?>assets/css/footer.css" rel="stylesheet">


<script src="<?= base_url();?>assets/js/jquery.min.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/js/OverlayScrollbars.min.js"></script>
<script src="<?= base_url();?>assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="<?= base_url();?>assets/js/footer.js"></script>
<script src="<?= base_url();?>assets/js/sidenav.js"></script>
<script src="<?= base_url();?>assets/js/scripts.js"></script>
<script src="<?= base_url();?>assets/js/custom.js"></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/bootbox.min.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/moment.js" ></script>
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
<script type="text/javascript" src="<?= base_url();?>/cms/js/placeholder.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/bootstrap-material-datetimepicker.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/sorttable.js"></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/gcontroller.js" ></script>
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
	.page-wrapper {
	    background-color: #fff;
	    border-radius: 4px;
	    padding: 10px;
	    margin-bottom: 15px;
	    margin-top: 15px;
	    padding-top: 24px;
	}
</style>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">