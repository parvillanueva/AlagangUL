<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends GS_Controller {

	public function index()
	{
		//get basic details 
		$profile_details  = $this->Site_model->get_member_details(15);
		$created_programs = $this->Site_model->get_created_programs(15);
		$joined_programs  = $this->Site_model->get_joined_programs(15);

		//get achievements
		//get joined activities and events

		$data['content'] = "site/profile/default";
		$data['meta'] = array(
			 "title"         =>  "Profile",
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
