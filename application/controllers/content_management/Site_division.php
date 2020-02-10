
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_division extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("division");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/division/page";
		$data['breadcrumb'] = array('Division' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("division");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/division/add";
		$data['breadcrumb'] = array('Division' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function update()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("division");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/division/edit";
		$data['breadcrumb'] = array('Division' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	//controller_config
}
	    