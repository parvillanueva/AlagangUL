<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guidelines extends GS_Controller {

	public function index()
	{

		//banner data
		$about_list      = $this->Site_model->get_guidelines();	
		$data['details']  = $about_list;

		$data['content'] = "site/guidelines/default";
		$data['meta'] = array(
			"title"         =>  "Guidelines",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		
		$data['active_menu'] = "about";
		$this->parser->parse("site/layout/template",$data);
	}

}
