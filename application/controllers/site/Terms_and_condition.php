<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_and_condition extends GS_Controller {

	public function index()
	{
		
		$data['content'] = "site/terms_and_condition/default";
		$data['meta'] = array(
			"title"         =>  "Terms and Conditions",
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
		$data['terms_and_condition'] = (array)$this->getTermsAndCondition();
		$this->parser->parse("site/layout/template",$data);
	}


	public function getTermsAndCondition(){
		// $this->session->userdata("sess_email")
		$result = $this->Global_model->get_list_query_sort('tbl_terms_and_condition','id = 1','title','asc');
		return $result[0];
	}
}
