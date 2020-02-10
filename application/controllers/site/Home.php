<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends GS_Controller {

	public function index()
	{
		//banner data
		$data['banners']  = $this->Site_model->get_banners();	
		//featured programs
		$data['programs'] = $this->Site_model->get_featured_programs();
		//get rewards

		$data['content'] = "site/home/default";
		$data['meta'] = array(
			"title"         =>  "Home",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);

		$data['active_menu'] = "home";
		
		$this->parser->parse("site/layout/template",$data);
	}

}
