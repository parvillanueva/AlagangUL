
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_for_approval extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("For Approval");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/for_approval/page";
		$data['breadcrumb'] = array('For Approval' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function validate_password(){
		$username = $this->session->userdata('sess_user');
		$password = $this->input->post('password');
		$data = $this->Global_model->validate_log($username, sha1($password));
		$count = 0;
		if($data){
			$count += 1;
		}
		echo json_encode($count);
	}
	//controller_config
}
	    