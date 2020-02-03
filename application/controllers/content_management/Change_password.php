<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends CI_Controller {

    function __construct(){
	    parent::__construct();
	    $this->load->model('content_management/Global_model');
	    if(!$this->session->userdata('sess_user')){
	      redirect('content_management/login');
	    }
	}

	function check_password(){
		$this->load->model('content_management/Global_model');
		$this->load->library('email');
		$this->config->load('email');
		$user = $this->Global_model->check_password($_POST['password'], $_POST['user_id']);
		$admins = $this->Global_model->get_admin();

		if(count($user) != 0) {
			$subject = 'Change password';
			$message = '<p>'.ucfirst($user[0]->name).' was changed their password.</p>';

			// Get full html:
			$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
			    <title>' . html_escape($subject) . '</title>
			    <style type="text/css">
			        body {
			            font-family: Arial, Verdana, Helvetica, sans-serif;
			            font-size: 16px;
			        }
			    </style>
			</head>
			<body>
			' . $message . '
			</body>
			</html>';
			// Also, for getting full html you may use the following internal method:
			//$body = $this->email->full_html($subject, $message);

			foreach ($admins as $admin) {
				$result = $this->email
				->from($this->config->item("default_email"))
			    ->to($admin->email)
			    ->subject($subject)
			    ->message($body)
			    ->send();
			}
		}
		
		echo json_encode(count($user));
	}
  
	function index(){
		$sessionData = $this->session->userdata('sess_user');
		$data['title'] = "Content Management";
		$data['PageName'] = "Change Password";
		$data["breadcrumb"] = array('Change Password' => '');
		$data['content'] = "content_management/change_password";
		$this->load->view('content_management/template/layout', $data);	
	}

	function update_password(){
		$user_id = $this->session->userdata('sess_uid');
		$password = sha1($this->input->post('password'));

		$data1 = array( 'password' => $password );
		$data2 = array( 'user_id' => $user_id, 'password' => $password );

		$this->load->model('content_management/Global_model');
		$result1 = $this->Global_model->update_data('cms_users',$data1,'id',$user_id);
		$result2 = $this->Global_model->save_data('cms_historical_passwords',$data2);
		$result3 = array( 'update_password' => $result1, 'historical_password' => $result2 );

		echo(json_encode($result3)); //Ajax callback purposes
	}

}