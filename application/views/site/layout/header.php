<!-- HTML Header -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- <title><?php //$this->load->site_title($title);?></title> -->
        <!-- <meta name="description" content="<?php //$this->load->site_description($description);?>" /> -->
        <!-- <meta name="keywords" content="<?php //$this->load->site_keyword($keyword);?>" /> -->
        
        <title>Alagang Unilab</title>
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

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <!-- bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/site/css/main-style.css">
        <link rel="stylesheet" type="text/css" href="https://use.typekit.net/scj2ogv.css">
        <link rel="icon" href="<?= base_url();?>assets/site/img/favicon.png" type="image/png" sizes="16x16">
        



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