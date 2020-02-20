<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User extends CI_Controller {
	public function index(){
		//$data["title"] = "Content Management";
		//$data["PageName"] = ("User");

		$data["content"] = "site/user_profile/page";
		$this->load->view("site/layout/template2",$data);	
	}
	
	public function view(){
		$data['division'] = $this->Global_model->get_list_all('tbl_division');
		/*$arrWhere = array(
			'id' => $user_id
		);
		$result = $this->Gmodel->get_query('tbl_users', $arrWhere);
		$data['data_set'] = $result;*/
		$data["title"] = "Content Management";
		$data["PageName"] = ("User");
		$data["content"] = "site/user_profile/page";
		$this->load->view("site/layout/template2",$data);		
	}
	
	public function submit(){
		date_default_timezone_set('Asia/Manila');
		$get_user_data = $this->get_user_data($this->session->userdata('email_address'));
			$image_path = 'assets/img/broken_img1.jpg';
		if(!empty($_FILES)){
			//$this->upload_file($_FILES, $get_user_data, $this->session->userdata('email_address'));
			$image_path = $this->upload_file($_FILES, $get_user_data, $this->session->userdata('email_address'));
		}
		$impersonate_token = $this->request_impersonate_token($this->session->userdata('email_address'));
		if($impersonate_token==0){
			$impersonate_token = '';
		}
		$arrData = array(
			'last_name' => $_POST['lname'],
			'first_name' => $_POST['fname'],
			//'mobile_number' => $_POST['phone'],
			'division' => $_POST['division'],
			'work_number' => $_POST['work_number'],
			'password' => md5($_POST['password']),
			'status' => $_POST['password'],
			'update_date' => date('Y-m-d H:i:s'),
			'imagepath' => $image_path,//'upload_file/'.$get_user_data.'/'.$_FILES['file_set']['name'],
			'impersonate_token' => $impersonate_token,
			'status' => 1
		);
		
		$this->Gmodel->update_data('tbl_users', $arrData, 'email_address', $this->session->userdata('email_address'));
		header("Location: ".base_url('successfull_register').""); 
		exit();		
	}
	
	public function get_user_data($email){
		$arr = array(
			'email_address' => $email
		);
		
		$sql = $this->Global_model->get_list_query('tbl_users', $arr);
		return $sql[0]->id;
	}
	
	function clean_str($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9-.\-]/', '', $string); // Removes special chars.
	}
	public function upload_file($file, $userId, $email){
		if (!file_exists("./upload_file/" . $userId)) {
			mkdir("./upload_file/" . $userId, 0777, true);
		}
		$clean_name = $this->clean_str($file['file_set']['name']);
		$target_dir = './upload_file/'.$userId.'/'. $clean_name;
		$move_file = move_uploaded_file($_FILES["file_set"]["tmp_name"], $target_dir);
		return $target_dir;
	}
	function request_impersonate_token($email) {
		$token = "DQVJ1X3JxZAlRfM2pWN2I5eFVmVUJBYmhORENMSXM1bjZArbW4yOU13ZAmNYdFlqZA2hITWpQcnJEblg4UzB4bWYtV1BMcngxUE8xR2Q3SEI1WWk2bEdDX0toV0xFNVg5LXBnazV1Q1lmRHFNRHl1d1ZATeW9MaVMtdTBKckoyejQtX1lDTVRVc3poOWNTamx0d2RQRGtGeGtmVExRUDRTRi1ybl9Ub0liZAXlORU9VZAjVjaUlZAa1VvRDJMSWxQSUtkdjRWQ2xVWWNn";

		$string = "https://graph.facebook.com/".$email."?access_token=".$token;
		$data = $this->curlExecute($string);
		if(!isset($data->error)){
			return $data->id;
		}
		else{
			return false;
		}
	}
	function curlExecute($string) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_URL, $string);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$api_response = trim(curl_exec($ch));
		$api_response_info = curl_getinfo($ch);
		curl_close($ch);
		$api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
		$api_response_body = substr($api_response, $api_response_info['header_size']);
		return json_decode($api_response_body);
	}
	
	function successfull_register(){
		$data["content"] = "site/login/sign_up_success_message";
		$this->load->view("site/layout/template2",$data);	
	}
}