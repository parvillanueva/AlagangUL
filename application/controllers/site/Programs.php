<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends GS_Controller {

	public function index()
	{

		$data['content'] = "site/programs/list";
		$data['meta'] = array(
			"title"         =>  "Programs",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		$data['active_menu'] = "programs";
		$this->parser->parse("site/layout/template",$data);
	}

	public function view()
	{

		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$user_details = $this->Gmodel->get_query('tbl_programs',"id = " . $program_id . " AND url_alias ='" . $program_alias . "'");
		$data['details'] = $user_details;
		$data['content'] = "site/programs/view";
		$data['meta'] = array(
			"title"         =>  "Program",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		$data['active_menu'] = "programs";
		$this->parser->parse("site/layout/template",$data);
	}

}
