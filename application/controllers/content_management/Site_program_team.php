
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_program_team extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("program team");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/program_team/page";
		$data['breadcrumb'] = array('Program Team' => '');
		$this->load->view("content_management/template/layout", $data);	
	}


	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("program team");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/program_team/add";
		$data['breadcrumb'] = array('Program Team' => '');
		$this->load->view("content_management/template/layout", $data);	
	}


	public function update()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("Program team");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/program_team/edit";
		$data['breadcrumb'] = array('Program Team' => '');
		$this->load->view("content_management/template/layout", $data);	
	}
	//controller_config
}
	    