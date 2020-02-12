<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_policy extends GS_Controller {

	public function index()
	{

		$data['content'] = "site/privacy_policy/default";
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
		
		$data['active_menu'] = "about";
		$data['privacy_policy'] = (array)$this->getPrivacyPolicy();
		$this->parser->parse("site/layout/template",$data);
	}

	public function getPrivacyPolicy(){
		// $this->session->userdata("sess_email")
		$result = $this->Global_model->get_list_query_sort('tbl_privacy_policy','id = 1','title','asc');
		return $result[0];
	}
}
