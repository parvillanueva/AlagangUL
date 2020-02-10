<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Sign_up extends CI_Controller {
	
	function index(){
		$data['content'] = "site/sign_up/page";
		$this->load->view("site/layout/template2",$data);
	}
	
	function email_send(){
		$from = $_POST['email'];
		$fr_name = 'Guest';
		$subject = 'Link Registration and OTP';
		$this->send_sgrid($from, $fr_name, $from, $subject);
	}
	
	function send_sgrid($from, $fr_name, $to, $subject){
		$otp = mt_rand(100000, 999999);
		$token = md5(uniqid(rand(), true));
		$link = base_url().'login_otp?token='.$token;
		$content = '<p>link = '.$link.' <br> otp = '.$otp.'</p>';
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
	
	function thankyou_message(){
		$data['content'] = "site/sign_up/thankyou_message";
		$this->load->view("site/layout/template2",$data);
	}
}