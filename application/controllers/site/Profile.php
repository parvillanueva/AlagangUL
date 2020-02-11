<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends GS_Controller 
{
	public function index()
	{
		//get basic details 
		$user_id 		  	= $this->session->userdata('sess_id');
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


		// $calendar 			= array();
		// foreach($joined_events as $i => $event)
		// {
		// 	$calendar[$i]	= array(
		// 		'allDay'	=> true,
		// 		'start'		=> $event['when'],
		// 		'className' => 'info',
		// 		'url'		=> '#activity'.$event['id'],
		// 		'className' => 'activity-date'
		// 	);
		// }
		$data['content'] 	= "site/profile/default";
		$data['meta'] 	 	= array(
			 "title"        =>  "Profile"
		);
		$data['css']		= array("assets/site/css/calendar.css");
		$data['js']			= array("assets/site/js/calendar.js", "assets/site/js/profile.js");

		$this->load->view("site/layout/template",$data);
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
		die($_REQUEST);
	}

}
