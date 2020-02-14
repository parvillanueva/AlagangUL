<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- <title><?php //$this->load->site_title($title);?></title> -->
        

        <title>Alagang Unilab | <?= @$meta['title'];?></title>
        <meta name="description" content="<?= @$meta['description'];?>" />
        <meta name="keywords" content="<?= @$meta['keyword'];?>" />
        <!-- required -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php
            $fullurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url = str_replace(base_url(), '', $fullurl);
            if($fullurl == base_url())
            {
              $url = 'home';
            }
            $page_og = $this->load->active_list('cms_metatags',"meta_url = '". $url."'");

            if($page_og){
                    echo "<title>".$page_og[0]->meta_title." | Sample Title</title>";
                    $config['title'] = $page_og[0]->meta_title . ' | Sample Title';
                    $config['description'] = $page_og[0]->meta_description;
                    $config['keyword'] = $page_og[0]->meta_keyword;
                    $config['default-description'] = $page_og[0]->meta_description;
                    $config['default-title'] = $page_og[0]->meta_title;
                    $config['url'] = $fullurl;
                    $config['type'] = $page_og[0]->og_type;
                    $config['image'] = base_url().$page_og[0]->meta_image;
                    $config['type'] = 'Website';
                    
                $this->load->facebook_og($config);
            }

            $this->load->google_analytics();
            
            $google_tag_manager_header = $this->load->active_list("site_information");
            if(isset($google_tag_manager_header[0]->google_tag_manager_header)){
                echo ($google_tag_manager_header[0]->google_tag_manager_header);
            }

        ?>
        
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
        <link rel="stylesheet" type="text/css" href="https://use.typekit.net/scj2ogv.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/site/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/site/slick/slick.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/site/slick/slick-theme.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/site/css/main-style.css">
        <link rel="icon" href="<?= base_url();?>assets/site/img/favicon.png" type="image/png" sizes="16x16">


        <link href="<?= base_url();?>assets/site/css/dropzone.css" type="text/css" rel="stylesheet" />
        <script src="<?= base_url();?>assets/site/js/dropzone.js"></script>
        <script src="<?= base_url();?>assets/site/js/event.js"></script>

        <script src="<?= base_url();?>assets/site/slick/slick.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/site/css/daterangepicker.css" />
        <script src="<?= base_url();?>assets/site/js/daterangepicker.js" type="text/javascript" ></script>

        
        <!-- <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script> -->
        <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-sliderAccess.js"></script> 
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-timepicker-addon.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-timepicker-addon.js"></script>
        
        <?php if(!empty($css)) : ?>
        <?php foreach($css as $path) : ?>
                <link rel="stylesheet" type="text/css" href="<?= base_url() . $path; ?>">
            <?php endforeach; ?>
        <?php endif; ?>



        <?php

            if ($this->agent->is_browser()) {
                $agent = $this->agent->browser().' '.$this->agent->version();
            } elseif ($this->agent->is_robot()) {
                $agent = $this->agent->robot();
            } elseif ($this->agent->is_mobile()) {
                $agent = $this->agent->mobile();
            } else {
                $agent = 'Unidentified User Agent';
            }


            $result['agent'] = $agent;
            $result['platform'] = $this->agent->platform();
            $result['session_id'] = $_SESSION['__ci_last_regenerate'] . str_replace(":", "", str_replace(".", "", $_SERVER['REMOTE_ADDR']));
            $result['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $result['public_address'] = file_get_contents("http://ipecho.net/plain");
            $result['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $result['date_time'] = date("Y-m-d H:i:s");
        ?>

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

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N9VJ329');
        </script>
        <!-- End Google Tag Manager -->
    </head>
    
    <p id="loading_div_standard"><i class="fa fa-spinner fa-spin" style="font-size:54px"></i></p>