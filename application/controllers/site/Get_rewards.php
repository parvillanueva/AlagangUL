<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_rewards extends GS_Controller {

	public function index()
	{

		$data['content'] = "site/get_rewards/default";
		$data['meta'] = array(
			"title"         =>  "Rewards",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);

		$data['active_menu'] = "get_rewards";
		
		$this->parser->parse("site/layout/template",$data);
	}

}
