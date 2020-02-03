<!-- HTML Header -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- <title><?php //$this->load->site_title($title);?></title> -->
        <!-- <meta name="description" content="<?php //$this->load->site_description($description);?>" /> -->
        <!-- <meta name="keywords" content="<?php //$this->load->site_keyword($keyword);?>" /> -->
        <meta equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="robots" content="no-cache" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge;" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

        <!-- Styles -->
        <link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>/cms/css/jquery-ui.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>/cms/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" />

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

        <style type="text/css">
        
        /** { 
            outline: 1px solid #657aec;
            outline-offset: -1px;
        }*/

        </style>



        <?php
            $dir = dirname(__FILE__);
            $this->minify->css($dir . "/asset/style.css", "Global Style"); //STYLE CSS FILE GOES HERE
            $this->minify->css($dir . "/asset/responsive.css", "Global Responsive"); // RESPONSIVE CSS FILE GOES HERE
            $this->minify->js($dir . "/asset/function.js", "Global Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
        ?>


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
    </head>
    
    <p id="loading_div_standard"><i class="fa fa-spinner fa-spin" style="font-size:54px"></i></p>