<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Sign_up extends CI_Controller {
	
	function index(){
		$data['content'] = "site/sign_up/page";
		$this->load->view("site/layout/template2",$data);
	}
	
	function email_send(){
		$email_result = $this->email_check($_POST['email']);
		$status = 0;
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
				$status = 1;
				$from = $_POST['email'];
				$fr_name = 'Guest';
				$subject = 'Link Registration and OTP';
				$this->send_sgrid($from, $fr_name, $from, $subject);
			}
		}
		$data_array = array(
			'email_address' 	=> $_POST['email'],
			'action' 			=> 'signup',
			'status' 			=> $status,
			'create_date' 		=> date('Y-m-d H:i:s')
			);

		$this->Gmodel->save_data('tbl_signup_login_logs', $data_array);
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
		$html = '<html>
					<head>
					</head>

					<body style="background: #092E6E;width:100%;height: 100%;font-family: Arial, Helvetica, sans-serif;">
					<table style="width:100%;">
						<tbody>
							<tr>
								<td>
									<center>
										<img width="330" height="150px" src="http://172.29.70.126/alagang_unilab/uploads/au-alagangunilab.png"
											style="margin-bottom:15px;">
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<table width="500" align="center" bgcolor="white" style="border:1px solid #dedede;padding:25px; margin-right:auto;margin-left:auto">
										<tr>
											<td>
												<center>
													<b style="padding-bottom:35px;color: #092e6e;font-weight:700;font-size:18px;">One-time password for Alagang Unilab signup</b>
													<p style="font-size:15px;font-weight:300;color: #4b4d4d;line-height: 24px;">
														Hello Juan dela Cruz;<br>
														Thank you for your interest in joining the Alagang Unilab program. In order to continue with your Sign up,
														please
														enter the One-Time Password provided below:
													</p>
													<br><br>
													<table width="340" align="center" style="border: 1px solid #eee;" >
														<tr>
															<td>
																<center>
																	<p align="center"
																		style="text-align:center;padding: 15px 0 15px 25px; display: inline-block; font-size:40px; font-weight: bold; letter-spacing: .75em;margin:0px auto;">
																		'.$otp.'
																	</p>
																</center>
															</td>
														</tr>
													</table>
													<br><br>    
													<p width="375" align="center" style="width:75%; font-size: 12px; color: #bbb; margin:0px auto;margin-bottom:25px;">
														Please note that this One-time password will expire if not used in 6 hours. If the expiration period has passed, you may just request for another OTP by clicking <a href="#">here</a>.
													</p>
													<table role="presentation" cellspacing="0" cellpadding="0" border="0">
														<tr>
															<td width="125" height="50" style="background: #1AA3F9; text-align: center;">
																<a href="javascript:void(0);"
																	style="background: #1AA3F9; padding: 15px;  font-size: 16px; line-height: 1.1; text-align: center; text-decoration: none; display: block; text-transform: uppercase;">
																	<span style="color:#ffffff;">Verify OTP</span>
																</a>
															</td>
														</tr>
													</table>
													<!-- <a align="center" width="125" height="50" href="javascript:void(0);" bgcolor="#1AA3F9" color="white" style="text-decoration: none; background-color:#1AA3F9 ;color:#fff; margin-top: 15px; border: 0; padding: 15px; text-transform: uppercase;">Verify OTP</a> -->
												</center>
											</td>
										</tr>
									</table>
									
								</td>
							</tr>
							<tr>
								<td>
									<table width="500" align="center">
										<tr>
											<td>
												<center style="width:500px;margin-left:auto;margin-right:auto;">
													<p align="center" style="color: #fff; width: 500px; font-size: 14px; margin: 15px auto 15px;">
														If you received this email by mistake, send us a report. Lorem ipsum dolor sit amet conserctetuer adipiscing
														nomnumny di dalam hati nay.
													</p>
												</center>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					</body>
				</html>';
		return 	$html;	
	}
}