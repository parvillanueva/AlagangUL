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
		$Gender 		= $this->validate($post, 'gender',["required"]);
		$Birthday 		= $this->validate($post, 'birthday', ["required","date"]);
		$EmailAddress 	= $this->validate($post, 'email_address', ["required","email"]);
		$MobileNumber 	= $this->validate($post, 'mobile_number', ["required","mobile_no"]);
		$Password 		= $this->validate($post, 'password', ["required","password"], 'confirm_password');
		$Image 			= $this->validate($post, 'user_image', ["file"]);

		$this->uniquedata("tbl_users","email_address",$EmailAddress);
		$this->uniquedata("tbl_users","mobile_number",$MobileNumber);

		$save_data = array(
			"last_name"		=> $LastName,
			"first_name"	=> $FirstName,
			"gender"		=> $Gender,
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

				$points_data = array(
					"user_id"			=> $user_id,
					"current_points"	=> 0,
					"total_points"		=> 0,
					"update_date"		=> date("Y-m-d H:i:s")
				);

				if($this->Api_model->save_data("tbl_users_points", $points_data)){
					$this->output(true, "Success saving record.");
				} else {
					$this->output(false, "Error saving record. please try again.");	
				}
				
			} else {
				$this->output(false, "Error saving record. please try again.");	
			}
			
		} else {
			$this->output(false, "Error saving record. please try again.");
		}


	}

	function update($post){

	}

	function login($post){

	}

	function profile($post){

	}

}
