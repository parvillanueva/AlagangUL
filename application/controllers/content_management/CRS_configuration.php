
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class CRS_configuration extends GS_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("configuration");
		$data['edit_title'] = true;
		$data["content"] = "content_management/CRS/configuration/page";
		$data["breadcrumb"] = array('CRS Configuration' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	//controller_config
}
	    