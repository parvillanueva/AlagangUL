<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends GS_Controller {

	public function index()
	{
		//get basic details 
		//get achievements
		//get joined activities and events

		$data['content'] = "site/profile/default";
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
		
		$this->parser->parse("site/layout/template",$data);
	}

}
