<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends GS_Controller 
{
	public function index()
	{
		//get basic details 
		$user_id 		  	= $this->session->userdata('user_sess_id');
		$profile_details  	= $this->Site_model->get_member_details($user_id);
		$created_programs 	= $this->Site_model->get_created_programs($user_id);
		$joined_programs  	= $this->Site_model->get_joined_programs($user_id);

		//get achievements
		$member_badges		= $this->Site_model->get_member_badges($user_id);

		//get joined activities and events
		$joined_events		= $this->Site_model->get_joined_events($user_id);

		$divisions 			= $this->Site_model->get_divisions();

		$arr_badge = array();
		foreach($joined_events as $i => $event)
		{
			$arr_badge[$i] = explode(",", $event['badges']);
			$event['badges'] = $arr_badge[$i];
			$temp = array();

			foreach($event['badges'] as $badge)
			{
				$temp[] = explode("|", $badge);
			}

			$joined_events[$i]['badges'] = $temp;
			
			
		}
		$data['division']	= $divisions;
		$data['profile']	= $profile_details;
		$data['created']	= $created_programs;
		$data['badges']		= $member_badges;
		$data['programs']	= $joined_programs;
		$data['events']		= $joined_events;
		$data['c_programs'] = count($joined_programs);
		$data['c_events']   = count($joined_events);
		$data['active_menu']= '';
		$data['content'] 	= "site/profile/default";
		$data['meta'] 	 	= array(
			 "title"        =>  "Profile"
		);
		$data['css']		= array("assets/site/css/calendar.css");
		$data['js']			= array("assets/site/js/calendar.js", "assets/site/js/profile.js");

		$this->load->view("site/layout/template",$data);
	}

	public function reset()
	{
		$data['content'] 	= "site/profile/profile-reset-password";
		$data['meta'] 	 	= array(
			 "title"        =>  "Reset Password"
		);
		$data['active_menu']= '';
		$this->load->view("site/layout/template",$data);
	}

	public function view($id)
	{
		if(isset($id))
		{
			//get basic details 
			$user_id 		  	= $id;
			$profile_details  	= $this->Site_model->get_member_details($user_id);

			
				$created_programs 	= $this->Site_model->get_created_programs($user_id);
				$joined_programs  	= $this->Site_model->get_joined_programs($user_id);
	
				//get achievements
				$member_badges		= $this->Site_model->get_member_badges($user_id);
	
				//get joined activities and events
				$joined_events		= $this->Site_model->get_joined_events($user_id);

				$arr_badge = array();
				foreach($joined_events as $i => $event)
				{
					$arr_badge[$i] = explode(",", $event['badges']);
					$event['badges'] = $arr_badge[$i];
					$temp = array();

					foreach($event['badges'] as $badge)
					{
						$temp[] = explode("|", $badge);
					}

					$joined_events[$i]['badges'] = $temp;
					
					
				}
				
				$data['profile']	= $profile_details;
				$data['created']	= $created_programs;
				$data['badges']		= $member_badges;
				$data['programs']	= $joined_programs;
				$data['events']		= $joined_events;
				$data['c_programs'] = count($joined_programs);
				$data['c_events']   = count($joined_events);
				$data['active_menu']= '';
				$data['content'] 	= "site/profile/other";
				$data['meta'] 	 	= array(
					"title"        =>  "Profile"
				);
				$data['css']		= array("assets/site/css/calendar.css");
				$data['js']			= array("assets/site/js/calendar.js", "assets/site/js/profile.js");
	
				$this->load->view("site/layout/template",$data);
			
			
		}
		else
		{
			header("Location: " . base_url()); 
		}
		
	}

	public function edit()
	{
		$user_id 		  	= $this->session->userdata('sess_id');
		$profile_details  	= $this->Site_model->get_member_details($user_id);

		$data['details']	= $profile_details;
		$data['content'] 	= "site/profile/edit";
		$data['meta'] 	 	= array("title" =>  "Edit Profile");
		$data['js']	  		= array("assets/site/js/signup.js");

			
		$this->load->view("site/layout/template",$data);
	}

	public function update()
	{
		date_default_timezone_set('Asia/Manila');
		$id = $this->session->userdata('user_sess_id');
		$email = $this->session->userdata('email_address');
		/* $arrData = array(
			'last_name' => $_POST['last_name'],
			'first_name' => $_POST['first_name'],
			'mobile_number' => $_POST['mobile'],
			'work_number' => $_POST['work_number'],
			'division' => $_POST['division'],
			'update_date' => date('Y-m-d H:i:s')
		); */
		$userId = $_SESSION['user_sess_id'];
		$arrData = array(
			'last_name' => $_POST['lname'],
			'first_name' => $_POST['fname'],
			'mobile_number' => $_POST['phone'],
			'work_number' => $_POST['work_number'],
			'division' => $_POST['division'],
			'update_date' => date('Y-m-d H:i:s')
		);

		if(!empty($_FILES['programImage']['tmp_name'])){
			$file_path = $this->upload_file($_FILES, $userId, $email);
			$arrData['imagepath'] = $file_path; //"upload_file/" . $userId. "/". $_FILES['programImage']['name'];
		} else{
			$arrData['imagepath'] = $_POST['image_file'];
		}
		
		$this->Gmodel->update_data('tbl_users', $arrData, 'id', $id);
		//$arr = array('response'=>'success');
		//echo json_encode($arr);
		header("Location: ".base_url('profile').""); 
		exit();
	}
	
	function clean_str($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9-.\-]/', '', $string); // Removes special chars.
	}

	public function upload_file($file, $userId, $email){
		if (!file_exists("./upload_file/" . $userId)) {
			mkdir("./upload_file/" . $userId, 0777, true);
		}
		$clean_name = $this->clean_str($file['programImage']['name']);
		$target_dir = './upload_file/'.$userId.'/'. $clean_name;
		$move_file = move_uploaded_file($_FILES["programImage"]["tmp_name"], $target_dir);
		return $target_dir;
	}

}
