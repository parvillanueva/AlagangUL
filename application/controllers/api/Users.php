<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends GS_Controller {

	public function index()
	{
		$Post = $this->input->post();
		$Event = $GLOBALS['CMDEvent'];
		switch ($Event) {
			case 'register':
				$this->register($Post);
				break;

			case 'update':
				$this->update($Post);
				break;

			case 'login':
				$this->login($Post);
				break;

			case 'profile':
				$this->profile($Post);
				break;
			
			default:
				$this->output(false, 'Invalid Event.');
				break;
		}
	}

	function register($post){

		$LastName 		= $this->validate($post, 'last_name', ["required"]);
		$FirstName 		= $this->validate($post, 'first_name', ["required"]);
		$MiddleName 	= $this->validate($post, 'middle_name');
		$Birthday 		= $this->validate($post, 'birthday', ["required","date"]);
		$EmailAddress 	= $this->validate($post, 'email_address', ["required","email"]);
		$MobileNumber 	= $this->validate($post, 'mobile_number', ["required","mobile_no"]);
		$Password 		= $this->validate($post, 'password', ["required","password"], 'confirm_password');
		$Image 			= $this->validate($post, 'user_image', ["file"]);

		$save_data = array(
			"last_name"		=> $LastName,
			"first_name"	=> $FirstName,
			"middle_name"	=> $MiddleName,
			"birthday"		=> $Birthday,
			"email_address"	=> $EmailAddress,
			"mobile_number"	=> $MobileNumber,
			"password"		=> $Password,
			"status"		=> 1,
			"create_date"	=> date("Y-m-d H:i:s")
		);




		$user_id = $this->Api_model->save_data("tbl_users", $save_data);
		if($user_id){
			$image_path = $this->upload($Image, "user_image");
			$update_data = array(
				"imagepath"	=> $image_path
			);
			if($this->Api_model->update_data("tbl_users",$update_data,"id",$user_id)){
				$this->output(true, "Saving record success.");
			} else {
				$this->output(false, "Error saving record. please try again.");	
			}
			
		} else {
			$this->output(false, "Error saving record. please try again.");
		}


	}

	function sendsms($user_id, $mobile_number){

	}

	function update($post){

	}

	function login($post){

	}

	function profile($post){

	}

}
