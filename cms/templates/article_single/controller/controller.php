
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_{title} extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ucfirst("{title_header}") . " - Update";
		$data["content"] = "content_management/module/{title}/page";
		$data["details"] = $this->Global_model->get_by_id("{table}",1);
		$this->load->view("content_management/template/layout", $data);	
	}

}
	    