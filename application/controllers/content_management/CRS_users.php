
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class CRS_users extends GS_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("CRS Users");
		$data['edit_title'] = true;
		$data["content"] = "content_management/CRS/crs_users/page";
		$data["breadcrumb"] = array('CRS Users' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	//controller_config
}
	    