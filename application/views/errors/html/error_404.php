<?php
    $protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
    $root  = $protocol.$_SERVER['HTTP_HOST'];
    $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    // session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Alagang Unilab | Page Not Available</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://use.typekit.net/scj2ogv.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url;?>assets/site/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url;?>assets/site/css/main-style.css">
    <link rel="icon" type="image/png" href="<?= $base_url;?>assets/site/img/favicon.png" sizes="16x16">

    <link rel="stylesheet" type="text/css" href="<?= $base_url;?>assets/site/css/daterangepicker.css" />
</head>
<body>
    
    <?php   
        if(isset($_SESSION['user_sess_id']) && !empty($_SESSION['user_sess_id'])) {
            include VIEWPATH.'site'.DIRECTORY_SEPARATOR.'page_not_found'.DIRECTORY_SEPARATOR.'menu_logged.php';
        } else {
            include VIEWPATH.'site'.DIRECTORY_SEPARATOR.'page_not_found'.DIRECTORY_SEPARATOR.'menu_logged_out.php';
        }
    ?>

    <div class="au-wrapper">
        <div class="container-fluid au-heading au-wrapper au-flexcenter">
            <div class="au-container au-padding text-center">
                <span class="au-h5"><i class="fas fa-exclamation-circle"></i></span>
                <span class="au-h5" style="font-size: 32px;">Page not found.</span>
                <span class="au-p4" style="color: #fff;">We can't seem to find the page you are looking for.</span>
            </div>
        </div>
    </div>

     <?php   
        if(isset($_SESSION['user_sess_id']) && !empty($_SESSION['user_sess_id'])) {
            include VIEWPATH.'site'.DIRECTORY_SEPARATOR.'page_not_found'.DIRECTORY_SEPARATOR.'footer_logged.php';
        } else {
            include VIEWPATH.'site'.DIRECTORY_SEPARATOR.'page_not_found'.DIRECTORY_SEPARATOR.'footer_logged_out.php';
        }
    ?>
    
    <script src="<?= $base_url;?>assets/site/js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="<?= $base_url;?>assets/site/js/popper.min.js" text="type/javascript"></script>
    <script src="<?= $base_url;?>assets/site/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= $base_url;?>assets/site/js/script.js" type="text/javascript"></script>
    <script src="<?= $base_url;?>assets/site/js/moment.min.js" type="text/javascript" ></script>
</body>
</html>