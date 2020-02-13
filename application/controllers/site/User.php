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
		$this->upload_file($_FILES, $this->session->userdata('email_address'));
		$impersonate_token = $this->request_impersonate_token($this->session->userdata('email_address'));

		$arrData = array(
			'last_name' => $_POST['lname'],
			'first_name' => $_POST['fname'],
			'mobile_number' => $_POST['phone'],
			'password' => md5($_POST['password']),
			'status' => $_POST['password'],
			'update_date' => date('Y-m-d H:i:s'),
			'imagepath' => 'upload_file/'.$_POST['email'].'/'.$_FILES['file_set']['name'],
			'impersonate_token' => $impersonate_token
		);
		$this->Gmodel->update_data('tbl_users', $arrData, 'email_address', $this->session->userdata('email_address'));
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
}