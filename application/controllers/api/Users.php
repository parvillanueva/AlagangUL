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

			case 'authenticate':
				$this->login($Post);
				break;

			case 'profile':
				$this->profile($Post);
				break;
			
			default:
				$this->output(false, 509);
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
					$this->output(true, 201);
				} else {
					$this->output(false, 507);	
				}
				
			} else {
				$this->output(false, 507);	
			}
			
		} else {
			$this->output(false, 507);
		}


	}

	function update($post){

	}

	function login($post){
		$EmailAddress 	= $this->validate($post, 'email_address', ["required","email"]);
		$Password 	= $this->validate($post, 'password', ["required"]);

		$query = "SELECT * FROM tbl_users WHERE email_address ='" . $EmailAddress . "' AND password ='" . md5($Password) . "' AND status = 1";
		$result = $this->Api_model->run_query($query);

		if(count($result) > 0){
			$data = array(
				"user_id"		=> $result[0]->id,
				"first_name"	=> $result[0]->first_name,
				"last_name"		=> $result[0]->last_name,
				"display_name"	=> $result[0]->first_name . " " . $result[0]->last_name,
				"email_address"	=> $result[0]->email_address
			);
			$this->output(true, 202, $data);
		} else {
			$this->output(false, 508);
		}
	}

	function profile($post){

	}

}
