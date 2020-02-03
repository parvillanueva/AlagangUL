<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('sess_email')=='' ) { 
			redirect(base_url("content_management/login"));
		}
	}
	
	public function index()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Dashboard";
		$data['content'] = "content_management/home_cms"; 
		$this->load->view('content_management/template/layout', $data);
	}



}