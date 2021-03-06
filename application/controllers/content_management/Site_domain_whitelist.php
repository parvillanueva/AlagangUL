
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_domain_whitelist extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("domain whitelist");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/domain_whitelist/page";
		$data['breadcrumb'] = array('Domain Whitelist' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("domain whitelist");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/domain_whitelist/add";
		$data['breadcrumb'] = array('Domain Whitelist' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function update()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("domain whitelist");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/domain_whitelist/edit";
		$data['breadcrumb'] = array('Domain Whitelist' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function delete(){
		$id = $this->input->post('id');
		$this->Global_model->delete_data('tbl_email_domain_whitelist',$id);
	}
	//controller_config
}
	    