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

    <!-- FONTAWESOME -->
    <link href="<?= base_url();?>assets/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/css/fontawesome-all.min.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url();?>assets/css/styles.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/css/login-styles.css" rel="stylesheet">

    <script src="<?= base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?= base_url();?>assets/js/footer.js"></script>
    <script src="<?= base_url();?>assets/js/custom.js"></script>
    <script src="<?= base_url();?>assets/js/bootbox.min.js"></script>
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

</head>