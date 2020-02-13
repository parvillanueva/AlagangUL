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
			$this->session_set('');
		} else{
			$explode_email = explode("@",$_POST['email']);
			$white_test = $this->white_list_check($explode_email[1]);
			if($white_test == 'empty'){
				echo json_encode(array('responce'=>'no_list'));
			} else{ 
				$from = $_POST['email'];
				$fr_name = 'Guest';
				$subject = 'Link Registration and OTP';
				$this->send_sgrid($from, $fr_name, $from, $subject);
			}
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
		$content = $this->email_template_otp($otp); //'<p> otp = '.$otp.'</p>';
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
		$content = $this->email_template_otp($otp);//'<p>otp = '.$otp.'</p>';
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
	
	function email_template_otp($otp){
		$html = '<!DOCTYPE html>
				<html lang="en">
				<head>
					<title>Alagang Unilab | OTP email template</title>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				</head>
				<body style="background-color:#092e6e; margin:0; padding:0;">
					<div style="background-color:#092e6e; text-align: center; font-family: montserrat, sans-serif; padding: 15px 15px 45px;">
						<img src="http://172.29.70.126/alagang_unilab/uploads/au-alagangunilab.png" style="width: 400px; height: auto; margin: auto;">
						<!-- otp sent message -->
						<div style="max-width: 500px; border: 1px solid #ccc; background-color: #fff; margin: auto;">
							<div style="padding:20px;">
								<h4 style="font-family: "myriad-pro", sans-serif; color: #092e6e;">One-time password for Alagang Unilab signup</h4>
								<p>
									Hello Guest;<br>
									Thank you for your interest in joining the Alagang Unilab program. In order to continue with your Sign up, please enter the One-Time Password provided below:
								</p>
								<div style="border: 1px solid #eee; padding: 15px 0 15px 25px; display: inline-block; margin-bottom: 20px; font-size: 2.2em; font-weight: bold; letter-spacing: .75em;">
									'.$otp.'
								</div>
							</div>
						</div>
						<div style="color: #fff; max-width: 500px; font-size: .75em; margin: 15px auto 15px;">
							If you received this email by mistake, send us a report. Lorem ipsum dolor sit amet conserctetuer adipiscing nomnumny di dalam hati nay.
						</div>				
					</div>
				</body>
				</html>';
		return 	$html;	
	}
}