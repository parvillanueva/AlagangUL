<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_activation extends CI_Controller {

	public function _remap()
	{
		if ($this->uri->segment(2) == 'success') {
			$data['title'] = "Account Activated";
			$this->load->view("content_management/template/header", $data);
			$this->load->view('content_management/account_activation/success');
		} else if ($this->uri->segment(2) == 'invalid') {
			$data['title'] = "Invalid Token";
			
			$this->load->view("content_management/template/header", $data);
			$this->load->view('content_management/account_activation/invalid');
		} else {
			$user_id = $this->Global_model->check_token_exist($this->uri->segment(2));
			if (COUNT($user_id) > 0) {
				$result = $this->Global_model->activate_user($user_id[0]->id);
				if ($result == true) {
					redirect(base_url("account_activation/success"));
				}
			} else {
				redirect(base_url("account_activation/invalid"));
			}
		}
	}

}
