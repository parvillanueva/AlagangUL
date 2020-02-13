<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- ANIMATION -->

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="https://use.typekit.net/scj2ogv.css">
    
    <link href="<?= base_url();?>assets/css/css/bootstrap.min.css" rel="stylesheet" type="text/css" />  

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/css/main-style.css">
	<link rel="icon" type="image/png" href="<?= base_url();?>assets/img/favicon.png" sizes="16x16">

    <!-- Custom styles for this template -->
	<script src="https://kit.fontawesome.com/47b29f79cf.js" crossorigin="anonymous"></script>
    <script src="<?= base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url();?>assets/js/js/popper.min.js" text="type/javascript"></script>
    <script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?= base_url();?>assets/js/footer.js"></script>
	<script src="<?= base_url();?>cms/js/bootbox.min.js"></script>
    <script src="<?= base_url();?>cms/js/custom.js"></script>
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
	.modal-dialog{
		opacity: 1 !important;
		position: fixed !important;
		z-index: 99999 !importatn;
	}
</style>

</head>