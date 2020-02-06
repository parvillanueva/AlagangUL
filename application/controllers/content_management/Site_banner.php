
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_banner extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("Banner List");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/banner/page";
		$data['breadcrumb'] = array('Banner List' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("Banner List");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/banner/add";
		$data['breadcrumb'] = array('Banner List' => '');
		$this->load->view("content_management/template/layout", $data);	
	}
}
	    