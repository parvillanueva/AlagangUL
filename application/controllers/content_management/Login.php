<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->helper('email');
		$this->load->model('content_management/Global_model');
	}

	public function index()
	{
		$data['title'] = "Content Management";
		$data['logout_data'] = '';
		$data['PageName'] = 'Login';
		$this->load->view('content_management/login', $data);
	}

	public function forgot()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Forgot Password";
		$this->load->view('content_management/login_forgot', $data);
	}


	public function validate_log() {
		$details_cms = $this->load->details("cms_preference",1);
		$ad_authentication = $details_cms[0]->ad_authentication;
		$ad_status = $this->input->post('ad_status');
		$username = '';

		$table = 'cms_users';
		$field = '';
		$where = '';
		$login_attempts = '';
		$current_datetime = date("Y-m-d H:i:s");
		$super_admin = '';

		if(valid_email($this->input->post('username'))){ //Checks for Super Admin email or AD post
			$super_admin = $this->Global_model->check_email($this->input->post('username'));
		}else{
			$super_admin = $this->Global_model->check_user($this->input->post('username'));
		}

		if($super_admin != null &&  $super_admin[0]->role == 7){ //Checks if user is Super Admin
			$check_user = $super_admin;
			$username = $check_user[0]->username;
		}else if($ad_authentication == 1){ //Check if AD authentication is enabled
			$check_user = $this->Global_model->get_list_query($table, 'email="'.$this->input->post('username').'"');
			$username = ($check_user != null) ? $check_user[0]->username : null;
		}else{
			$username = $this->input->post('username');
			$check_user = $this->Global_model->check_user($username);
		}

		$field = 'username';
		$where = $username;
		$count = count($check_user);

		//Login attemps Counter
		if($check_user != null){
			if($check_user[0]->user_error_logs == 0){
				$login_attempts = '2 attempts remaining';
			}elseif ($check_user[0]->user_error_logs == 1) {
				$login_attempts = '1 attempt remaining';
			}
		}
		
		if($count == 1){
			if($check_user[0]->user_block_logs != 3){
				//check if username is disabled or less than 3 attempts
				if($check_user[0]->user_lock_time == '0000-00-00 00:00:00' || $current_datetime >=  $check_user[0]->user_lock_time){
					//set user error logs to 0
					if($check_user[0]->user_error_logs >= 3){
					  	$data['user_error_logs'] = 0;
					  	$data['user_lock_time'] = '0000-00-00 00:00:00';
					  	$this->Global_model->update_data($table,$data,$field,$where);
					  	$login_attempts = '2 attempts remaining';
					}

					if($check_user[0]->role == 7){// If user role is Super Admin
						if(valid_email($this->input->post('username'))){
							if($ad_status == 'success'){ //Super Admin AD account
								$data = $check_user;
							}else{
								$data = null;
							}
						}else{
							$data = $this->Global_model->validate_log($username, sha1($_POST['password']));
						}
					}else if($ad_authentication == 1){
						if($ad_status == 'success'){
							$data = $check_user;
						}else{
							$data = null;
						}
					}else{
						$data = $this->Global_model->validate_log($username, sha1($_POST['password']));
					}
					

					if($data != null){
							$result_data = count($data);
							if($result_data > 0 ){
								if($data[0]->status > 0 ){
									//if count = 3 account is active 
									$table = 'cms_users';
									$field = 'username';
									$where = $username;
									$user_data['user_error_logs'] = 0;
									$user_data['user_lock_time'] = '';
									$this->Global_model->update_data($table,$user_data,$field,$where);
									//Check expiration of password
									$expiration_days = $this->check_expiration_of_password($check_user[0]->id);
									if($expiration_days > 90){
										$count += 4; //expired password
										$this->send_email($check_user[0]->email); //send email reset password
									}else if($expiration_days > 83){
										$count += 2;
										$days_left = 90 - $expiration_days;
										$this->set_session($data);
										$this->session->set_flashdata('toast_message', 'You only have '.$days_left.' day(s) left before your password expires. Please change immediately.');
									}else{
										$count += 2;
										$this->set_session($data);
									}
								}else{
									//if count = 2 account is inactive
									$this->get_error_logs($username);
									$count += 1;
								}
							}else{
								$this->get_error_logs($username);
							}
					}else{
						$this->get_error_logs($username);
					}
				}else{
					$count += 3;
				}
			}else{
				$count += 5;
			}
		}	

		$resul_array = array(
			'count' => $count,
			'message' => $login_attempts
		);
		echo json_encode($resul_array);
	}

	public function get_error_logs($username){
		$current_datetime =  date("Y-m-d H:i:s");
		$table = 'cms_users';
		$field = 'username';
		$where = $username;
		$user_checker = $this->Global_model->check_user($username);
		$get_admin_email = $this->Global_model->get_list_query($table, 'role = 6 AND notif_login = 1');
		//get brand name
		$title = $this->Global_model->get_list_all('cms_preference');

		if($user_checker != null){
			if( $user_checker[0]->user_error_logs == 2){
				$expire_lock_time = date('Y-m-d H:i:s', strtotime("+5 min"));
				if($user_checker[0]->user_lock_time == '0000-00-00 00:00:00' || $current_datetime > $user_checker[0]->user_lock_time){
					$data['user_lock_time'] = $expire_lock_time;
				}
				$data['user_error_logs'] = 0;
				$data['user_block_logs'] = $user_checker[0]->user_block_logs + 1;
				$mail_title = 'FAILED LOGIN ATTEMPTS';
				$mail_content = '<p>Hi '.$user_checker[0]->username.',</p>
	        				 <br>
	                         <p>The '.$title[0]->cms_title.' Website Content Management System detected a problem on the account of '.$user_checker[0]->username.'. There was an occurrence of multiple failed attempts of logging in from the user&#10076;s account.</p>
	 						 <br>
	 						 <p>Kindly ensure the security regarding this matter.</p>       				 
	        				 <br>
	        				 <p>Thank you.</p>
	        				 <br>
	        				 <br>
	        				 <p>CIT</p>';
				$send_mail = $this->email
								  ->from("phpdev.unilab@gmail.com")
								  ->to($user_checker[0]->email)
								  ->subject($mail_title)
								  ->message($mail_content)
								  ->send(); 


				  if($user_checker[0]->user_block_logs >= 2){
						foreach ($get_admin_email as $value) {
					  		$mail_title = 'FAILED LOGIN ATTEMPTS';
							$mail_content = '<p>Hi '.$value->username.',</p>
				        				 <br>
				                         <p>The '.$title[0]->cms_title.' Website Content Management System detected a problem on the account of '.$user_checker[0]->username.'. There was an occurrence of multiple failed attempts of logging in from the user&#10076;s account.</p>
				 						 <br>
				 						 <p>Kindly ensure the security regarding this matter.</p>       				 
				        				 <br>
				        				 <p>Thank you.</p>
				        				 <br>
				        				 <br>
				        				 <p>CIT</p>';


								$send_mail = $this->email
												  ->from("phpdev.unilab@gmail.com")
												  ->to($value->email)
												  ->subject($mail_title)
												  ->message($mail_content)
												  ->send(); 
						}

				  }

			}else{
				$data['user_error_logs'] = $user_checker[0]->user_error_logs + 1;
			}
		}
		$this->Global_model->update_data($table,$data,$field,$where);
	}


	public function set_session($data) 
	{

		foreach ($data as $key => $value) {
			$newdata = array(
				'sess_uid'  => $value->id,
		        'sess_user' => $value->username,
		        'sess_email' => $value->email,
		        'sess_name' => $value->name,
		        'sess_role' => $value->role
			);

			//add to audit trail
		    $data2['user_id'] = $value->id;
		  	$data2['url'] = "";
		  	$data2['action'] = strip_tags(ucwords("Login"));
		  	$data2['create_date'] = date('Y-m-d H:i:s'); 
		  	$table = 'cms_audit_trail';
		  	$this->Global_model->save_data($table,$data2);
		}

		$this->session->set_userdata($newdata);
	}

	public function unset_session() {

		//add to audit trail
	    $data2['user_id'] = $this->session->userdata('sess_uid');
	  	$data2['url'] ="";
	  	$data2['action'] = strip_tags(ucwords("Logout"));
	  	$data2['create_date'] = date('Y-m-d H:i:s'); 
	  	$table = 'cms_audit_trail';

	  	if($data2['user_id'] != null){
	  		$this->Global_model->save_data($table,$data2);
	  	}
	  	
	  	$this->session->sess_destroy();
		header('Location: '.base_url("content_management/login/sign_out"));
	}

	public function sign_out()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Sign Out";
		$data['logout_data'] = 'You are successfully logged out.';
		$data['PageName'] = 'Login';
		$this->load->view('content_management/login', $data);
	}

	public function is_activated()
	{
		$username = $_POST['username'];
		$password = sha1($_POST['password']);
		$count = count($this->Global_model->is_activated($username, $password));
        echo json_decode($count);
	}

	public function reset_password()
	{

		$data['title'] = "Reset Password";
		$data['PageName'] = "Reset Password";

		$token = $this->uri->segment(4);

		$query = "token = '" . $token . "' AND status = 0";
		$select = "id, token, redirect, user_id, create_date, expire_date, status";
		$result_data = $this->Global_model->get_data_list("cms_site_token", $query, 1,0, $select, "create_date", "desc", null, null);

        if(count($result_data) > 0 ){

            if($result_data[0]->expire_date >= date('Y-m-d H:i:s')){

                $token = array(
                    "status" => 1
                );

                $this->Global_model->update_data("cms_site_token",$token,"user_id",$result_data[0]->user_id);
                $data['user_id'] = $result_data[0]->user_id;
                $data['success'] = true;
                $data['title'] = "RESET PASSWORD";

            } else {

                $data['user_id'] = 0;
                $data['success'] = false;
                $data['title'] = "EXPIRED TOKEN";

            }
        } else {
            $data['user_id'] = 0;
            $data['success'] = false;
            $data['title'] = "INCORRECT/USED TOKEN";
        }

		$this->load->view('content_management/reset_password', $data);
	}

	public function check_expiration_of_password($user_id)
	{
		$details = $this->Global_model->get_list_query_sort('cms_historical_passwords', 'user_id='.$user_id, 'create_date', 'DESC');
		$date1 = date_create($details[0]->create_date); //create date
		$date2 = date_create(date('Y-m-d')); //current date
		$date_diff = date_diff($date1,$date2)->format("%a"); //date difference

		return $date_diff;
	}

	public function check_diff()
	{
		$user = $this->session->userdata('sess_uid');
		$details = $this->Global_model->get_list_query_sort('cms_historical_passwords', 'user_id='.$user, 'create_date', 'DESC');
		$date1 = date_create($details[0]->create_date); //create date
		$date2 = date_create(date('Y-m-d')); //current date
		$date_diff = date_diff($date1,$date2)->format("%a"); //date difference
		
		if($date_diff >= 90){
			echo "Expired - " . $date_diff . " days";
		}else if($date_diff >= 83){
			echo "Warning - " . $date_diff . " days";
		}else{
			echo "Good - " . $date_diff . " days";
		}
	}

	public function send_email($user_email){
		$users = $this->Global_model->check_email($user_email);
        $activation_token = $this->token($users[0]->id, $user_email);

		$subject = 'Expired Password';
        $content1 = 'Your current password to Content Management is already expired. Please reset your password immediately. The link below can only be used once, request again if necessary.
        <br><br>
        Thank you!';
		

        $body = '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#3e3e3e3e;padding:0;margin:0;width:100%;font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica"> 
                <tbody>
                    <tr width="100%"> 
                        <td valign="top" align="left" style="background:#3e3e3e3e;font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica"> 
                            <table style="border:none;padding:0 18px;margin:50px auto;width:730px"> 
                                <tbody>
                                    <tr width="100%" height="57"> 
                                        <td valign="top" align="left" style="border-top-left-radius:4px;border-top-right-radius:4px;background:#3B3B3B;padding:17px 18px;text-align:center">
                                            <h1 style="font-size:20px;margin:0;color:#fff">Content Management</h1>
                                        </td> 
                                    </tr>
                                    <tr width="100%"> 
                                        <td valign="top" align="left" style="border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#fff;padding:18px"> 
                                            <h1 style="font-size:20px;margin:0;color:#333">Hi '.$users[0]->name .', </h1>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333">' . $content1 . '</p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333">
                                                <a href="'.base_url("content_management/login/reset_password").'/'.$activation_token.'" style="border-radius:3px;background:#3B3B3B;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:250px;text-align:center" target="_blank"> Reset Password </a>
                                            </p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333;text-align: center;">or you may copy this url: ' . base_url("content_management/login/reset_password") .'/'.$activation_token. '</p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#939393;margin-bottom:0; text-align: center;"> Content Management </p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#939393;margin-bottom:0; text-align: center;"> This is a system generated email. Do not reply. </p>
                                        </td> 
                                    </tr>
                                </tbody> 
                            </table> 
                        </td> 
                    </tr>
                </tbody> 
            </table>';
            
        $this->config->load('email');
        $email = $this->config->item("default_email");

		$result = $this->email
			->from($email)
		    ->to($user_email)
		    ->subject($subject)
		    ->message($body)
		    ->send();
	}

	public function token($user_id, $user_email)
    {
        $salt = md5('Unilab CMS' . date('Y-m-d H:i:s'));
        $token = md5($user_email . $salt);
        $data = array(
            "token"=>$token,
            "redirect"=>"content_management/login/reset_password",
            "user_id"=>$user_id,
            "status"=>0,
            "create_date"=>date('Y-m-d H:i:s'),
            "expire_date"=>date('Y-m-d H:i:s', strtotime("+24 hours"))
        );
        $this->Global_model->save_data("cms_site_token",$data);
        return $token;
    }

    public function test(){
    	$email = 'marclesterlagunday@gmail.com';
    	$check_user = $this->Global_model->get_list_query('cms_users', 'email="'.$email.'"');
    	echo $check_user[0]->username;
    }

    public function testing(){
    	$items = null;

		foreach((array)$items as $item) {
			print $item;
		}
	}

}