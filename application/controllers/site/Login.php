<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends CI_Controller {
	
	public function index(){
		$data['token'] = '214379c94ea72a85f638ca88292248c6';
		$this->load->view("site/login/login", $data);	
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
	
	public function session_set($data){
		$impersonate_token = $this->request_impersonate_token($data[0]->email_address);

		$arr_session = array(
			'user_sess_email' => $data[0]->email_address,
			'user_sess_id'  => $data[0]->id,
			'user_sess_pass'  => $data[0]->password,
			'user_sess_role'  => 1,
			'user_impersonate_token' => $impersonate_token
		);
		$this->session->set_userdata($arr_session);
        echo json_encode(array("status"=>TRUE));
	}
	
	public function login_register(){
		$arr_where = array(
			'email_address' => $_POST['email_address'],
			'password' => md5($_POST['password'])
		);
		$sql_result = $this->Gmodel->get_query('tbl_users',$arr_where);
		if(empty($sql_result)){
			$result = array('responce'=>'failed');
			echo json_encode($result);
		} else{
			$this->session_set($sql_result);
			$result = array('responce'=>'success');
			echo json_encode($result);
		}
	}
	
	public function forgot_password(){
		$data["content"] = "site/login/forgot_password";
		$this->load->view("site/layout/template2",$data);
	}
	
	public function reset_password($user_id){
		$data["user_id"] = $user_id;
		$data["content"] = "site/login/reset_password";
		$this->load->view("site/layout/template2",$data);
	}
	
	public function update_password(){
		date_default_timezone_set('Asia/Manila');
		$arr = array(
			'password' => md5($_POST['password']),
			'update_date' => date('Y-m-d H:i:s'),
		);
		$sql_result = $this->Gmodel->update_data('tbl_users', $arr, 'id', $_POST['user_id']);
		echo json_encode(array('responce' => $sql_result));
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
