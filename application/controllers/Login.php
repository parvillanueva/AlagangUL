<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends CI_Controller {
	
	public function index(){
		$data['token'] = '214379c94ea72a85f638ca88292248c6';
		$this->load->view("login", $data);	
	}
	
	public function session_set(){
		$email = $_POST['email'];
		$arr_where = array('email_address'=>$email);
		$sql_result = $this->Gmodel->get_query('tbl_users',$arr_where);
		$arr_session = array(
			'sess_email' => $sql_result[0]->email_address,
			'sess_id'  => $sql_result[0]->id,
			'sess_pass'  => $sql_result[0]->password,
			'sess_role'  => 1 
		);
		$this->session->set_userdata($arr_session);
        echo json_encode(array("status"=>TRUE));
	}
}