<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends CI_Controller {
	
	public function __construct() 
	{
	 	parent::__construct();
		if($this->session->userdata('user_sess_email')!='' ) { 
	 		redirect(base_url("home"));
	 	} 
	} 
	
	public function index(){
		if(isset($_GET['share'])){
			$share = explode('-',$_GET['share']);
			$module = $share[0];
			$id = $share['1'];
			if($module=='program'){
				$table = 'tbl_programs';	
			}
			else{
				$table = 'tbl_program_events';
			}
			$where = array(
				'id' => $id
			);
			$sql_result = $this->Gmodel->get_query($table,$where);

			if(count($sql_result)>0){
				if($module=='program'){
					$title = $sql_result[0]->name;
					$image = $sql_result[0]->image_thumbnail;
					$desc = $sql_result[0]->overview;
				}
				else{
					$title = $sql_result[0]->title;
					$image = $sql_result[0]->image;
					$desc = date("m/d/Y h:i a", strtotime($sql_result[0]->when));
					$file = fopen("./test.txt", "w");        
					fwrite($file, $image);
					fclose($file);
				}
				$data['og'] = true;
				$data['og_title'] = $title;
				$data['og_image'] = $image;
				$data['og_desc'] = $desc;
				$data['og_url'] = 'login?share='.$module.'-'.$id;
				
			}		
		}
		$data['token'] = '214379c94ea72a85f638ca88292248c6';
		$this->load->view("site/login/login", $data);	
	}	
	
	public function session_set($data){
		$arr_session = array(
			'user_sess_email' => $data[0]->email_address,
			'user_sess_id'  => $data[0]->id,
			'user_sess_pass'  => $data[0]->password,
			'user_sess_role'  => 1,
			'is_admin' => $data[0]->isAdmin,
			'user_impersonate_token' => $data[0]->impersonate_token
		);
		$this->session->set_userdata($arr_session);
        echo json_encode(array("status"=>TRUE));
	}
	
	public function login_register(){
		$arr_where = array(
			'email_address' => $_POST['email_address'],
			'password' => md5($_POST['password']),
			'status' => 1
		);

		$sql_result = $this->Gmodel->get_query('tbl_users',$arr_where);
		if(empty($sql_result)){
			$result = array('responce'=>'failed');
			$status = 0;
		} else{
			$this->session_set($sql_result);
			$result = array('responce'=>'success');
			$status = 1;
		}

		$data_array = array(
			'email_address' 	=> $_POST['email_address'],
			'action' 			=> 'login',
			'status' 			=> $status,
			'create_date' 		=> date('Y-m-d H:i:s')
			);

		$this->Gmodel->save_data('tbl_signup_login_logs', $data_array);
		echo json_encode($result);
		if($_POST['is_remember_me']=='on'){
			setcookie('alagangunilabemail', $_POST['email_address'], time() + (86400 * 10), "/");
		}
		else{
			delete_cookie("alagangunilabemail");
		}
	}
	
	public function forgot_password(){
		$data["content"] = "site/login/forgot_password";
		$this->load->view("site/layout/template2",$data);
	}
	
	public function fpw_message_success(){
		$data["content"] = "site/login/forgot_pass_message";
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
