<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User_profile extends CI_Controller {
	public function index(){
		//$data["title"] = "Content Management";
		//$data["PageName"] = ("User");
		$data["content"] = "site/user_profile/page";
		$this->load->view("site/layout/template2",$data);	
	}
	public function view($user_id){
		$arrWhere = array(
			'id' => $user_id
		);
		$result = $this->Gmodel->get_query('tbl_users', $arrWhere);
		$data['data_set'] = $result;
		$data["title"] = "Content Management";
		$data["PageName"] = ("User");
		$data["content"] = "site/user_profile/page";
		$this->load->view("site/layout/template2",$data);		
	}
	
	public function submit(){
		$this->upload_file($_FILES);
		$arrData = array(
			'last_name' => $_POST['lname'],
			'first_name' => $_POST['fname'],
			'mobile_number' => $_POST['phone'],
			'password' => md5($_POST['password']),
			'status' => $_POST['password'],
			'update_date' => date('Y-m-d H:i:s'),
			'imagepath' => $_FILES['file_set']['name'],
		);
		$this->Gmodel->update_data('tbl_users', $arrData, 'email_address', $_POST['email']);
		header("Location: ".base_url('login').""); 
		exit();		
	}
	
	public function upload_file($file){
		return $file;
	}
}