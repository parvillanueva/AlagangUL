<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends GS_Controller {

	public function index()
	{

		//banner data	
		$data['content'] = "site/manage/programs";
		$data['meta'] = array(
			"title"         =>  "Manage",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		
		$data['active_menu'] = "manage";
		$this->parser->parse("site/layout/template",$data);
	}


	public function program_list()
	{
		header("Content-Type: application/json");
		$keyword = $this->input->get("keyword");
		$user_id = $this->session->userdata('user_sess_id');
		$select = "SELECT * FROM tbl_programs WHERE (name LIKE '%".$keyword."%' OR overview LIKE '%".$keyword."%' OR area_covered LIKE '%".$keyword."%') AND created_by = " . $user_id;
		$result = $this->db->query($select)->result();
		echo json_encode($result);
	}

}
