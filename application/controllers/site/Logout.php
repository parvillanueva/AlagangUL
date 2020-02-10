<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Logout extends CI_Controller {
	
	public function index(){
		$this->session->sess_destroy();
		header('Location: '.base_url('login'));	
		exit();
	}
	
	public function already_exist(){
		$data["content"] = "site/logout/exist";
		$this->load->view("site/layout/template2",$data);
	}
}