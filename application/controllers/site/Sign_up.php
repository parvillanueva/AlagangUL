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
				$subject = 'One-Time-Password for Alagang Unilab';
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
			'email_address' => $email,
			'status' => 1
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
		$subject = 'One-Time-Password for Alagang Unilab';
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
					<head></head>
						<body style="background: #efefef;width:100%;height: 100%;font-family: Arial, sans-serif;">
						<table align="center" width="500" bgcolor="white" style="display:block;border:1px solid #dedede;margin-top:30px;margin-bottom:30px;margin-left:auto;margin-right:auto;border-radius: 10px;padding:10px;">
							<tbody>
								<tr>
									<td style="background-color: #092E6E;padding:10px 0px;border-radius: 8px 8px 0px 0px;">
										<img width="220" src="http://172.29.70.126/alagang_unilab/uploads/au-alagangunilab.png">
									</td>
								</tr>
								<tr>
									<td>
										<table style="padding:20px;">
											<tr>
												<td>
													<p style="font-size:14px;font-weight:300;color: #000;line-height: 24px;">
														<b style="font-size:15px;">Hello Guest;</b><br>
														You have requested online access for the Alagang Unilab online portal.  We have generated a One-Time Registration Code for you.  Kindly input this code in the sign up form accordingly.
													</p>
													<p style="font-size:17px;font-weight:600;margin: 30px 0px;">Your One-Time Registration Code is: <span style="color: red;">'.$otp.'</span></p>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td style="background-color: #092E6E;padding:15px;border-radius:0px 0px 8px 8px ;">
										<table width="100%">
											<tr>
												<td>
													<p style="color:#fff;font-size:14px;">Alagang Unilab</p>
												</td>
												<td style="text-align:right">
													<p style="color:#fff;font-size:14px;">Website: <a href="javascript:void(0);" style="color:#0e5bdf;text-decoration: none;">www.alagangunilab.unilab.com.ph</a></p>
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