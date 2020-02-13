<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User extends CI_Controller {
	public function index(){
		//$data["title"] = "Content Management";
		//$data["PageName"] = ("User");
		$data["content"] = "site/user_profile/page";
		$this->load->view("site/layout/template2",$data);	
	}
	
	public function view($user_id){
		$data['division'] = $this->Global_model->get_list_all('tbl_division');
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
		date_default_timezone_set('Asia/Manila');
		$this->upload_file($_FILES, $_POST['email']);
		$arrData = array(
			'last_name' => $_POST['lname'],
			'first_name' => $_POST['fname'],
			'mobile_number' => $_POST['phone'],
			'password' => md5($_POST['password']),
			'status' => $_POST['password'],
			'update_date' => date('Y-m-d H:i:s'),
			'imagepath' => 'upload_file/'.$_POST['email'].'/'.$_FILES['file_set']['name'],
		);
		$this->Gmodel->update_data('tbl_users', $arrData, 'email_address', $_POST['email']);
		header("Location: ".base_url('login').""); 
		exit();		
	}
	
	public function upload_file($file, $email){
		if (!file_exists("./upload_file/" . $email)) {
			mkdir("./upload_file/" . $email, 0777, true);
		}
		$target_dir = './upload_file/'.$email.'/'. $file['file_set']['name'];
		$move_file = move_uploaded_file($_FILES["file_set"]["tmp_name"], $target_dir);
	}
}