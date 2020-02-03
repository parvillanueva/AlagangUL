<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{

		$data['content'] = "site/home/default.php";
		$data['meta'] = array(
			// "title"         =>  "Home",
			// "description"   =>  $this->Global_model->site_meta_og(38, 'site_menu', 'meta_description'),
			// "keyword"       =>  $this->Global_model->site_meta_og(38, 'site_menu', 'meta_keywords')
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		$this->load->view("site/layout/template",$data);
	}

}
