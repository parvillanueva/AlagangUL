<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{

		$data['content'] = "site/welcome/default.php";
		$data['meta'] = array(
			"title"         =>  "Welcome",
			"description"   =>  "[Page Description]",
			"keyword"       =>  "[Page Keyword]"
		);
		
		$data['fb_og'] = array(
			"type"          =>  "[page type]",
			"title"         =>  "Welcome",
			"image"         =>  "[page image]"
		);
		$this->load->view("site/layout/template",$data);
	}

	public function change_city_special_char(){
		echo "<pre>";
		$query = "SELECT * FROM tbl_city WHERE tbl_city.city_name LIKE '%Ã±%'";
		$result = $this->db->query($query)->result();
		foreach ($result as $key => $value) {
			$id = $value->id;
			$city_name = str_replace("Ã±", "ñ", $value->city_name) ;
			$update_query = "UPDATE tbl_city SET city_name ='" . $city_name . "' WHERE id = " . $id;
			$this->db->query($update_query);
		}
	}

	public function otps(){
		echo "<pre>";
		$query = "SELECT * FROM tbl_users ORDER BY status ASC";
		$user_result = $this->db->query($query)->result();

		$data = array();
		$count = 1;
		foreach ($user_result as $key => $value) {

			$otp_query = "SELECT * FROM tbl_otp_record WHERE email_address = '" . $value->email_address . "' ORDER BY create_date DESC LIMIT 1";
			$otp_result = $this->db->query($otp_query)->result();

			if(count($otp_result) > 0){

				$send_link = "";
				if($value->status == 0){
					$send_link = "<a target='_blank' href='".base_url("welcome/send_sgrid") . "?email_address=" . $value->email_address . "&otp=" . @$otp_result[0]->otp_code . "&token=" . @$otp_result[0]->token . "'>Send</a>";
				}

				$data[] = array(
					"#"			=> $count,
					"ID"		=> $value->id,
					"Name"		=> $value->first_name . " " . $value->last_name,
					"Email"		=> $value->email_address,
					"Code"		=> @$otp_result[0]->otp_code,
					"Token"		=> @$otp_result[0]->token,
					"Expire"	=> @$otp_result[0]->expiration_date,
					"Resend"	=> $send_link
				);

				$count++;
			}
			
		}

		$this->load->library('table');

		$template = array(
		    'table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">'
		);

		$this->table->set_template($template);

		$this->table->set_heading('#', 'User ID', 'Name', 'Email', 'Code', 'Token', 'Expire', 'OTP Email');
		echo $this->table->generate($data);


	}

	public function send_sgrid(){


		$email_config = $this->load->details('cms_email_config', 1);
        $from_email = $email_config[0]->sendgrid_from_email;
        $from_name = $email_config[0]->sendgrid_from_name;

        $to = $this->input->get("email_address");
        $otp = $this->input->get("otp");
        $token = $this->input->get("token");

		$subject = 'One-Time-Password for Alagang Unilab';

		$content = $this->email_template_otp($otp);
		$arr = array(
			'from' 		=> $from_email,
			'from_name' => $from_name,
			'to' 		=> $to,
			'subject' 	=> $subject,
			'content' 	=> $content,
		);
		echo $this->sndgrd->send($arr);
	}

	function email_template_otp($otp){
		$html = '<html>
					<head></head>
						<body style="background: #efefef;width:100%;height: 100%;font-family: Arial, sans-serif;">
						<table align="center" width="500" bgcolor="white" style="display:block;border:1px solid #dedede;margin-top:30px;margin-bottom:30px;margin-left:auto;margin-right:auto;border-radius: 10px;padding:10px;">
							<tbody>
								<tr>
									<td style="background-color: #092E6E;padding:10px 0px;border-radius: 8px 8px 0px 0px;">
										<img width="220" src="'.base_url().'alagang_unilab/uploads/au-alagangunilab.png">
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
													<p style="color:#fff;font-size:14px;">Website: <a href="'.base_url().'" style="color:#0e5bdf;text-decoration: none;">www.alagangunilab.unilab.com.ph</a></p>
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
