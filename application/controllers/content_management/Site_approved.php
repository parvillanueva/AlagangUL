
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_approved extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("approved");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/approved/page";
		$data['breadcrumb'] = array('Approved' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	//controller_config
}
	    