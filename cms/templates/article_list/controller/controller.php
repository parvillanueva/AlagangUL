
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
		$data["PageName"] = ucfirst("{title_header}");
		$data["content"] = "content_management/module/{title}/list";
		$this->load->view("content_management/template/layout", $data);	
	}

	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ucfirst("{title_header}") . " - Add";
		$data["content"] = "content_management/module/{title}/add";
		$this->load->view("content_management/template/layout", $data);	
	}

	public function update()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ucfirst("{title_header}") . " - Update";
		$data["content"] = "content_management/module/{title}/edit";
		$data["details"] = $this->Global_model->get_by_id("{table}",$this->uri->segment(4));
		$this->load->view("content_management/template/layout", $data);	
	}
}
	    