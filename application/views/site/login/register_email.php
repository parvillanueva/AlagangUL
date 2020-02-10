
<!-- Scripts -->
<script type="text/javascript" src="<?= base_url();?>/assets/js/jquery.min.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/assets/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/assets/js/masking.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/assets/js/numeral.min.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/jquery-ui.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/bootbox.min.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/moment.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/custom.js" ></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/placeholder.js" ></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="<?= base_url();?>/cms/js/gcontroller.js" ></script>

<!-- bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/site/css/main-style.css">
<link rel="stylesheet" type="text/css" href="https://use.typekit.net/scj2ogv.css">
<link rel="icon" href="<?= base_url();?>assets/site/img/favicon.png" type="image/png" sizes="16x16">

<?php
    $inputs = [
        'email_address'
    ];

    $form_id = $this->standard->inputs($inputs);
?>

<button id="submit">Sumbit</button>



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

    $(document).on("click","#submit", function(){
        if(validate.standard("<?= $form_id ;?>")){
            modal.loading(true);
        }
    });
</script>