
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_category extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("category");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/category/page";
		$data['breadcrumb'] = array('Category' => '');
		$this->load->view("content_management/template/layout", $data);	
	}


	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("category");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/category/add";
		$data['breadcrumb'] = array('Category' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function update()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("category");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/category/edit";
		$data['breadcrumb'] = array('Category' => '');
		$this->load->view("content_management/template/layout", $data);	
	}
	//controller_config
}
	    