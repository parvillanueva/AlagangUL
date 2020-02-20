<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Login_otp extends CI_Controller {
	
	public function index(){
		$token = $this->session->userdata('token');
		$arr = array(
			'token' => $token
		);
		$result = $this->Gmodel->get_query('tbl_otp_record', $arr);
		if(!empty($result)){
			$check_email = $this->check_email($token);
			if($check_email == 'not_empty'){
				header("Location: ".base_url('already-xist').""); 
				exit();	
			} else{
				$data["content"] = "site/login/otp";
				$this->load->view("site/layout/template2",$data);
			}
		} else{
			header("Location: ".base_url('already-xist').""); 
			exit();	
		}
	}
	
	public function otp_check(){
		$otp = $_POST['otp_code'];
		$token = $_POST['token'];
		$arr = array(
			'otp_code' => $otp,
			'token' => $token
		);
		$result = $this->Gmodel->get_query('tbl_otp_record', $arr);
		if(!empty($result)){
			$expiry_date = $this->expiration_date($result[0]->email_address);
			if($expiry_date){
				$email_data = $result[0]->email_address;
				$email_check = $this->email_exist($email_data);
				if($email_check['result'] == 'empty'){
					$insert_result = $this->create_user($email_data);
					if($insert_result){
						$email_check = $this->email_exist($email_data);
					}
				}
				$arr = array('responce'=>'success', 'user_id'=>$email_check['user_id']);
				echo json_encode($arr);
			} else{
				$arr = array('responce'=>'expired');
				echo json_encode($arr);
			}
			
		} else{
			$arr = array('responce'=>'failed');
			echo json_encode($arr);
		}
		//$this->session->sess_destroy();
	}
	
	public function expiration_date($id){
		$data = "SELECT * FROM tbl_otp_record Where id='".$id."' AND expiration_date = '".date('Y-m-d H:i:s')."' AND expiration_date < '".date('Y-m-d H:i:s')."'";
		$result = $this->db->query($data)->result();
		if(empty($result)){
			return true;
		} else{
			return false;
		}
	}
	
	public function check_email($token){
		$arr = array(
			'token' => $token
		);
		$result = $this->Gmodel->get_query('tbl_otp_record', $arr);
		if(count($result) > 0 ){
			$arr_user = array(
				'email_address' => @$result[0]->email_address
			);
			$result_user = $this->Gmodel->get_query('tbl_users', $arr_user);
			if(!empty($result_user)){
				return 'not_empty';
			} else{
				return 'empty';
			}
		} else {
			return "not_empty";
		}
		
	}
	
	public function create_user($email){
		date_default_timezone_set('Asia/Manila'); 
		$arrInsert = array(
			'last_name' => '',
			'first_name' => '',
			'email_address' => $email,
			'mobile_number' => '',
			'password' => '',
			'status' => 1,
			'create_date' => date('Y-m-d H:i:s'),
			'update_date' => date('Y-m-d H:i:s'),
			'imagepath' => '',
		);
		$sql_result = $this->Gmodel->save_data('tbl_users', $arrInsert);
		$user_id = $this->get_user_data($email);
		$this->create_points($user_id);
		return $sql_result;
	}
	
	public function get_user_data($email){
		$arr = array(
			'email_address' => $email
		);
		$result = $this->Gmodel->get_query('tbl_users', $arr);
		return $result[0]->id;
	}
	
	public function create_points($user_id){
		$arrInsert = array(
			'user_id' => $user_id,
			'current_points' => 0,
			'total_points' => 0,
			'update_date' => date('Y-m-d H:i:s'),
		);
		$sql_result = $this->Gmodel->save_data('tbl_users_points', $arrInsert);
	}
	
	public function email_exist($email){
		$arr = array(
			'email_address' => $email
		);
		$result = $this->Gmodel->get_query('tbl_users', $arr);
		if(!empty($result)){
			$arr = array('result'=> 'not_empty', 'user_id'=>$result[0]->id);
			return $arr;
		} else{
			$arr = array('result'=> 'empty');
			return $arr;
		}
	}
	
	public function otp_fpw(){
		$token = $_SESSION['token'];
		$arr = array(
			'token' => $token
		);
		$result = $this->Gmodel->get_query('tbl_otp_record_fpw', $arr);
		if(!empty($result)){
			$data["content"] = "site/login/otp_fpw";
			$this->load->view("site/layout/template2",$data);
		} else{
			header("Location: ".base_url('already-xist').""); 
			exit();	
		}
	}
	
	public function otp_check_fpw(){
		$otp = $_POST['otp_code'];
		$token = $_POST['token'];
		$arr = array(
			'otp_code' => $otp,
			'token' => $token
		);
		$result = $this->Gmodel->get_query('tbl_otp_record_fpw', $arr);
		if(!empty($result)){
			$email_data = $result[0]->email_address;
			$email_check = $this->email_exist($email_data);
			$arr = array('responce'=>'success', 'user_id'=>$email_check['user_id']);
			echo json_encode($arr);
		} else{
			$arr = array('responce'=>'failed');
			echo json_encode($arr);
		}
		//$this->session->sess_destroy();
	}
}	