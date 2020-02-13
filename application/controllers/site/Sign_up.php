<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Sign_up extends CI_Controller {
	
	function index(){
		$data['content'] = "site/sign_up/page";
		$this->load->view("site/layout/template2",$data);
	}
	
	function email_send(){
		$email_result = $this->email_check($_POST['email']);
		if($email_result == 'not_empty'){
			echo json_encode(array('responce'=>'exist'));
		} else if($email_result == 'pass_empty'){
			echo json_encode(array('responce'=>'pass_empty'));
		} else{
/* 			$explode_email = explode("@",$_POST['email']);
			$white_test = $this->white_list_check($explode_email[1]);
			if($white_test == 'empty'){
				echo json_encode(array('responce'=>'no_list'));
			} else{ */
				$from = $_POST['email'];
				$fr_name = 'Guest';
				$subject = 'Link Registration and OTP';
				$this->send_sgrid($from, $fr_name, $from, $subject);
			//}
		}
	}
	
	public function white_list_check($data){
		$arrWhere = array(
			'domain' => $data
		);
		
		$sql = $this->Global_model->get_list_query('tbl_email_domain_whitelist', $arrWhere);
		if(!empty($sql)){
			return 'not_empty';
		} else{
			return 'empty';
		}
	}
	
	function email_check($email){
		$arrWhere = array(
			'email_address' => $email
		);
		
		$sql = $this->Global_model->get_list_query('tbl_users', $arrWhere);
		if(!empty($sql)){
			$password = $sql[0]->password;
			if($password != ''){
				return 'not_empty';
			} else{
				return 'pass_empty';
			}
		} else{
			return 'empty';
		}
	}
	
	function send_sgrid($from, $fr_name, $to, $subject){
		$otp = mt_rand(100000, 999999);
		$token = md5(uniqid(rand(), true));
		$this->session_set($token);
		//$link = base_url().'login_otp?token='.$token;
		$content = '<p> otp = '.$otp.'</p>';
		$this->otp_save($otp, $from, $token);
		$arr = array(
			'from' => $from,
			'from_name' => $fr_name,
			'to' => $to,
			'subject' => $subject,
			'content' => $content,
		);
		echo $this->sndgrd->send($arr);
	}
	
	public function session_set($token){
		$arr_token = array(
			'token' => $token,
			'email_address' => $_POST['email']
		);
		$this->session->set_userdata($arr_token);
	}
	
	function otp_save($otp, $email, $token){
	date_default_timezone_set('Asia/Manila'); 
		$arrInsert = array(
			'otp_code' => $otp,
			'email_address' => $email,
			'token' => $token,
			'create_date' => date('Y-m-d H:i:s'),
		);
		$this->Gmodel->save_data('tbl_otp_record', $arrInsert);
	}
	
	function email_check_fpw(){
		$email = $_POST['email'];
		$email_check = $this->email_check($email);
		if($email_check == 'not_empty'){
			echo $this->email_send_fpw($email);
		} else{
			echo 404;
		}
	}
	
	function email_send_fpw(){
		$from = $_POST['email'];
		$fr_name = 'Guest';
		$subject = 'Link Registration and OTP';
		$this->send_sgrid_fpw($from, $fr_name, $from, $subject);
	}
	
	function send_sgrid_fpw($from, $fr_name, $to, $subject){
		$otp = mt_rand(100000, 999999);
		$token = md5(uniqid(rand(), true));
		$this->session_set($token);
		//$link = base_url().'login_otp_fpw?token='.$token;
		$content = '<p>otp = '.$otp.'</p>';
		$this->otp_save_fpw($otp, $from, $token);
		$arr = array(
			'from' => $from,
			'from_name' => $fr_name,
			'to' => $to,
			'subject' => $subject,
			'content' => $content,
		);
		echo $this->sndgrd->send($arr);
	}
	
	function otp_save_fpw($otp, $email, $token){
	date_default_timezone_set('Asia/Manila'); 
		$arrInsert = array(
			'otp_code' => $otp,
			'email_address' => $email,
			'token' => $token,
			'create_date' => date('Y-m-d H:i:s'),
		);
		$this->Gmodel->save_data('tbl_otp_record_fpw', $arrInsert);
	}
	
	function thankyou_message(){
		$data['content'] = "site/sign_up/thankyou_message";
		$this->load->view("site/layout/template2",$data);
	}
}