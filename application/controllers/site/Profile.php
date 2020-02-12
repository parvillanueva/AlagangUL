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

		$data['profile']	= $profile_details;
		$data['created']	= $created_programs;
		$data['badges']		= $member_badges;
		$data['programs']	= $joined_programs;
		$data['events']		= $joined_events;
		$data['c_programs'] = count($joined_programs);
		$data['c_events']   = count($joined_events);

		$data['content'] 	= "site/profile/default";
		$data['meta'] 	 	= array(
			 "title"        =>  "Profile"
		);
		$data['css']		= array("assets/site/css/calendar.css");
		$data['js']			= array("assets/site/js/calendar.js", "assets/site/js/profile.js");

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
	
				$data['profile']	= $profile_details;
				$data['created']	= $created_programs;
				$data['badges']		= $member_badges;
				$data['programs']	= $joined_programs;
				$data['events']		= $joined_events;
				$data['c_programs'] = count($joined_programs);
				$data['c_events']   = count($joined_events);
	
				$data['content'] 	= "site/profile/default";
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
		
		$id = $_POST['id'];

		$arrData = array(
			'last_name' => $_POST['last_name'],
			'first_name' => $_POST['first_name'],
			'mobile_number' => $_POST['mobile'],
			'update_date' => date('Y-m-d H:i:s')
		);

		if(count($_FILES) > 0)
		{
			$this->upload_file($_FILES, $_POST['email']);
			$arrData['imagepath'] = "upload_file/" . $_POST['email']. "/". $_FILES['file']['name'];
		}
		
		$this->Gmodel->update_data('tbl_users', $arrData, 'id', $id);
		$arr = array('response'=>'success');
		echo json_encode($arr);
	}

	public function upload_file($file, $email){
		if (!file_exists(FCPATH  . "upload_file/" . $email)) {
			mkdir(FCPATH  . "upload_file/" . $email, 0777, true);
		}
		$target_dir = FCPATH .'upload_file\\'.$email.'\\'. $file['file']['name'];
		$move_file = move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir);
	}

}
