
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_terms_and_condition extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("terms and condition");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/terms_and_condition/page";
		$data['breadcrumb'] = array('Terms and Condition' => '');
		$this->load->view("content_management/template/layout", $data);	
	}



	//controller_config
}
	    