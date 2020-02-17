<?php
    $ci = new CI_Controller();
    $ci =& get_instance();
    $ci->load->helper('url');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Alagang Unilab | Page Not Available</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://use.typekit.net/scj2ogv.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/site/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/siteassets/css/main-style.css">
    <link rel="icon" type="image/png" href="<?= base_url();?>assets/siteassets/img/favicon.png" sizes="16x16">

    <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/siteassets/css/daterangepicker.css" />
</head>
<body>
    <?php $ci->load->view("site/layout/menu"); ?>

    <div class="au-wrapper">
        <div class="container-fluid au-heading au-wrapper au-flexcenter">
            <div class="au-container au-padding text-center">
                <span class="au-h5"><i class="fas fa-exclamation-circle"></i></span>
                <span class="au-h5" style="font-size: 32px;">Page not found.</span>
                <span class="au-p4" style="color: #fff;">We can't seem to find the page you are looking for.</span>
            </div>
        </div>
    </div>

    <?php $ci->load->view("site/layout/footer"); ?>
    
    <script src="<?= base_url();?>assets/site/js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="<?= base_url();?>assets/site/js/popper.min.js" text="type/javascript"></script>
    <script src="<?= base_url();?>assets/site/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url();?>assets/site/js/script.js" type="text/javascript"></script>
    <script src="<?= base_url();?>assets/site/js/moment.min.js" type="text/javascript" ></script>
</body>
</html>