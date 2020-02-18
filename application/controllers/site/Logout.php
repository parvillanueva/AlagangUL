<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Logout extends CI_Controller {
	
	public function index(){
		$this->session->sess_destroy();
		header('Location: '.base_url());
	}

	public function unset_session(){
		$this->session->sess_destroy();
		// header('Location: '.base_url());
	}
	
	public function already_exist(){
		$data["content"] = "site/logout/exist";
		$this->load->view("site/layout/template2",$data);
	}
	
	public function delete_user_email($email){
		$replace = str_replace('-', '@' , $email);
		$arr = array('email_address' => $replace);
		$user = $this->Gmodel->delete_data_user('tbl_users', $arr);
		$user_otop = $this->Gmodel->delete_data_user('tbl_otp_record', $arr);
		echo $user.'<br/>'.$user_otop;
	}
}