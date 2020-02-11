<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends CI_Controller {
	
	public function index(){
		$data['token'] = '214379c94ea72a85f638ca88292248c6';
		$this->load->view("site/login/login", $data);	
	}
	
	public function session_set($data){
		$arr_session = array(
			'sess_email' => $data[0]->email_address,
			'sess_id'  => $data[0]->id,
			'sess_pass'  => $data[0]->password,
			'sess_role'  => 1 
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
}
