<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		if($this->session->userdata('sess_email')=='' ) { 
			redirect(base_url("content_management/login"));
		}
	}

    public function html()
    {
        /* Site Main Menu List */
        $tags = $this->Global_model->get_list_query_sort('cms_metatags','meta_status = 1','id','desc');
        $html = '';
        $html .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
        $html .= '<html>'."\n";
        $html .= '    <head>'."\n";
        $html .= '        <title>Site Map | Sample Site</title>'."\n";
        $html .= '        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />'."\n";
        $html .= '        <meta name="viewport" content="width=device-width, initial-scale=1.0" />'."\n";
        $html .= '        <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.png">'."\n";
        $html .= '    </head>'."\n";
        $html .= '    <body>'."\n";
        $html .= '        <style type="text/css">
            body {
                font: normal 80%  "Trebuchet MS", "Helvetica", sans-serif;
                margin:0;
                text-align:center;
            }
            #cont{
                margin:auto;
                max-width:800px;
                text-align:left;
            }
            a:link,a:visited {
                color: #0180AF;
                text-decoration: underline;
            }
            a:hover {

            }
            h1 {
                padding:20px;
                color:#00AEEF;
                text-align:left;
                margin:0px;
            }
            h3 {
                font-size:inherit;
                background-color:#d8d7f5;
                margin:0px;
                padding:10px 20px;
            }
            h3 a {
                float:right;
                font-weight:normal;
                display:block;
                padding-right: 20px;
            }

            #footer {
                background-color:#d8d7f5;
                padding:10px 20px;
            }

            .lcount {
                color:#000;
                padding:2px 18px;
                margin:2px;
                font-size: inherit;
                font-weight: bold;
            }

            .link-container {
                width: 100%;
                position: relative;
            }
            .link-a {
                width: 100%;
                padding: 0 20px;
            }
            .hide{
                display: none;
            }
             @media screen and (max-width: 1680px) {
                h1{
                    padding: 10px 20px;
                }
                h3 a {
                    padding-right: 0;
                }
            }
            @media screen and (max-width: 1366px) {
                h1{
                    padding: 10px 20px;
                }
                h3 a {
                    padding-right: 0;
                }
            }
            @media screen and (max-width: 768px) {
                h3 a {
                    padding-right: 50px;
                }
            }
             @media screen and (max-width: 640px) {
                h3 a {
                    padding-right: 40px;
                }
            }
            
            @media screen and (max-width: 320px) {
                h3 a {
                    padding-right: 0;
                }
            }
        </style>'."\n";

        $tagCount = 0;
        $htm = '';
        foreach ($tags as $key => $value) 
        {   
            if($value->meta_parent_id == "")
            {
                $tagCount = $tagCount+1;
                $htm .= '   <div class="link-a">'."\n";
                $htm .= '        <a href="http://sample.com.ph/'.$value->meta_url.'" title="'.strtoupper($value->meta_title).'">'.ucwords($value->meta_title).'</a>'."\n";
                $htm .= '   </div>'."\n";
            }
        }

        $withS = "";
        if($tagCount > 1){$withS = "'s";}
        
        $html .= '        <div id="cont">'."\n";
        $html .= '            <h1>Sample Site Site Map</h1>'."\n";
        $html .= '            <h2 class="hide">Sample Site Site Map</h2>'."\n";
        $html .= '            <h3><a href="http://www.sample.com.ph">Homepage</a>'."\n";
        $html .= '                Last updated: '.date('F d, Y')."\n";
        $html .= '            </h3>'."\n";
        $html .= '            <div class="">'."\n";
        $html .= '                <span class="lcount">Main page - '.$tagCount.' page'.$withS.'</span>'."\n";
        $html .= '            </div>'."\n";
        $html .= '            <div class="link-container">'."\n";
        $html .= $htm;

        $html .= '    </div>'."\n";

        foreach ($tags as $key => $value) 
        {
            $withChild = $this->Global_model->get_list_query('cms_metatags','meta_parent_id = "'.$value->id.'"');
            if($withChild)
            {
                $withS = "";
                if(count($withChild) > 1)
                {
                    $withS = "'s";
                }
                $html .= '                <hr />'."\n";
                $html .= '              <div class="">'."\n";
                $html .= '                  <span class="lcount">'.ucwords($value->meta_title).' Page - '.count($withChild).' page'.$withS.'</span>'."\n";
                $html .= '              </div>'."\n";

                foreach ($withChild as $key => $value) 
                {
                    $html .= '                <div class="link-a">'."\n";
                    $html .= '                    <a href="http://www.sample.com.ph/'.$value->meta_url.'" title="'.strtoupper($value->meta_title).'">'.ucwords($value->meta_title).'</a>'."\n";
                    $html .= '                </div>'."\n";
                }
            }
        }
        $html .= '                <br />'."\n";
        $html .= '                <div id="footer">'."\n";
        $html .= '                    Copyright &copy; 2018 United Laboratories'."\n";
        $html .= '                </div>'."\n";
        $html .= '            </div>'."\n";
        $html .= '        </div>'."\n";
        $html .= '    </body>'."\n";
        $html .= '</html>';
        $file_handle = fopen('./sitemap.html', 'w'); 
        fwrite($file_handle, $html);
        fclose($file_handle);
        $this->xml($tags);
    }

    public function xml($tags)
    {

        $xml = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";

        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\n";

        /* Menu XML */
        foreach ($tags as $key => $value) 
        {
                $url = 'http://www.sample.com.ph/'.$value->meta_url;
                $xml .= '    <url>'."\n";
                $xml .= '        <loc>'.$url.'</loc> '."\n";
                $xml .= '        <lastmod>'. date('c', time()) .'</lastmod> '."\n";
                $level = '1.0';
                if($value->meta_level != 1)
                {
                    $level = '0.8';
                }
                $xml .= '    <priority>'.$level.'</priority>'."\n";

                $xml .= '    </url>'."\n";
        }

        $xml .= '</urlset>';
        $file_handle = fopen('./sitemap.xml', 'w'); 
        fwrite($file_handle, $xml);
        fclose($file_handle);
    }
    
}
