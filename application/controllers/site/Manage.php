<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends GS_Controller {

	public function index()
	{

		//banner data	
		$data['content'] = "site/manage/programs";
		$data['meta'] = array(
			"title"         =>  "Manage",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		
		$data['active_menu'] = "manage";
		$this->parser->parse("site/layout/template",$data);
	}
	public function events()
	{
 
		$program_id = $this->uri->segment(2);
		$program_url = $this->uri->segment(3);

		//banner data	
		$data['program_id'] = $program_id;
		$data['program_url'] = $program_url;
		$data['details'] = $this->db->query("SELECT * FROM tbl_programs WHERE id = " . $program_id)->result();
		$data['content'] = "site/manage/events";
		$data['meta'] = array(
			"title"         =>  "Manage",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		
		$data['active_menu'] = "events";
		$this->parser->parse("site/layout/template",$data);
	}
	public function volunteers()
	{

		$event_id = $this->uri->segment(2);


		//banner data	
		$data['event_id'] = $event_id;
		$data['content'] = "site/manage/volunteers";
		$data['meta'] = array(
			"title"         =>  "Manage",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		
		$data['active_menu'] = "events";
		$this->parser->parse("site/layout/template",$data);
	}

	public function program_list()
	{
		header("Content-Type: application/json");
		$keyword = $this->input->get("keyword");
		$user_id = $this->session->userdata('user_sess_id');
		$select = "SELECT
			tbl_programs.id,
			tbl_programs.image_thumbnail,
			tbl_programs.`name`,
			tbl_programs.overview,
			tbl_programs.area_covered,
			tbl_programs.headline,
			tbl_programs.created_by,
			tbl_programs.create_date,
			tbl_programs.update_date,
			tbl_programs.url_alias,
			tbl_programs.`status`,
			Count(tbl_program_events.id) as event_count
			FROM
			tbl_programs
			LEFT JOIN tbl_program_events ON tbl_program_events.program_id = tbl_programs.id
			WHERE (name LIKE '%".$keyword."%' OR overview LIKE '%".$keyword."%' OR area_covered LIKE '%".$keyword."%') AND created_by = " . $user_id . "
			GROUP BY
			tbl_programs.image_thumbnail,
			tbl_programs.`name`,
			tbl_programs.overview,
			tbl_programs.area_covered,
			tbl_programs.created_by,
			tbl_programs.create_date,
			tbl_programs.update_date,
			tbl_programs.url_alias,
			tbl_programs.`status`,
			tbl_programs.id";
		$result = $this->db->query($select)->result();
		echo json_encode($result);
	}

	public function get_event_list(){
		header("Content-Type: application/json");
		$program_id = $this->input->post("program_id");
		$query = "SELECT
			tbl_program_events.id,
			tbl_program_events.title,
			tbl_program_events.image,
			tbl_program_events.description,
			tbl_program_events.create_date,
			tbl_program_events.status,
			tbl_program_events.`when`,
			tbl_program_events.`where`,
			tbl_program_events.`url_alias`,
			tbl_program_events.volunteer_points,
			CONCAT('programs/',tbl_programs.id, '/', tbl_programs.url_alias, '/event/' , tbl_program_events.id , '/' , tbl_program_events.url_alias ) AS Url,
			COUNT(tbl_program_event_task.id) as task_count
			FROM
			tbl_program_events
			LEFT JOIN tbl_programs ON tbl_programs.id = tbl_program_events.program_id
			LEFT JOIN tbl_program_event_task ON tbl_program_event_task.event_id = tbl_program_events.id
			WHERE tbl_program_events.program_id = ".$program_id."
			GROUP BY
			tbl_program_events.title,
			tbl_program_events.description,
			tbl_program_events.`when`,
			tbl_program_events.`where`,
			tbl_program_events.volunteer_points,
			tbl_program_events.id";
		$result = $this->db->query($query)->result();
		$data = array();
		foreach ($result as $key => $value) {

			$volunteer_query = "SELECT
				Count(tbl_program_event_task_volunteers.id) AS count
				FROM
				tbl_program_event_task_volunteers
				WHERE
				tbl_program_event_task_volunteers.`status` >= -2 
				AND 
				tbl_program_event_task_volunteers.event_id = " . $value->id;
			$colunteer_result = $this->db->query($volunteer_query)->result();
			$data[] = array(
				"id"				=> $value->id,
				"title"				=> $value->title,
				"task_count"		=> $value->task_count,
				"url_alias"			=> $value->url_alias,
				"image"				=> base_url() . $value->image,
				"description"		=> $value->description,
				"when"				=> $value->when,
				"where"				=> $value->where,
				"status"			=> $value->status,
				"volunteer_points"	=> $value->volunteer_points,
				"volunteers"		=> $colunteer_result[0]->count,
				"create_date"		=> $value->create_date,
				"Url"				=> base_url() . $value->Url
			);
		}
		echo json_encode($data);
	}


	public function volunteers_list(){;
		$arr = array();
		$event_id = $this->input->post('event_id');
		$query_joined_volunteer = "	SELECT tbl_users_points_approved.*, 
										CONCAT('" . base_url() . "','/',tbl_users.imagepath) as profile_image , CONCAT(tbl_users.first_name, ' ', tbl_users.last_name) as user 
										FROM tbl_users_points_approved 
										LEFT JOIN tbl_users ON tbl_users.id = tbl_users_points_approved.user_id 
										WHERE event_id = " . $event_id . " GROUP BY tbl_users.id";

		$joined_volunteer = $this->db->query($query_joined_volunteer)->result();
			foreach($joined_volunteer as $key => $value){
				$query_task = "SELECT * from tbl_program_event_task where id = $value->event_task_id";
				$query_task = $this->db->query($query_task)->result();
				$volunteer_arr = [];
				$volunteer_arr['approval_id'] 		= $joined_volunteer[$key]->id;
				$volunteer_arr['volunteer_name'] 	= $joined_volunteer[$key]->user;
				$volunteer_arr['volunteer_id'] 		= $joined_volunteer[$key]->user_id;
				$volunteer_arr['task_name'] 		= $query_task[0]->task;
				$volunteer_arr['points'] 			= $joined_volunteer[$key]->points;
				$volunteer_arr['status'] 			= $joined_volunteer[$key]->status;
				$volunteer_arr['event_task_id']		= $joined_volunteer[$key]->event_task_id;
				array_push($arr,$volunteer_arr);
			}
		echo json_encode($arr);
	}


	public function update_task_user(){

		$approval_id = $this->input->post('approval_id');
		$user_id 	 = $this->input->post('user_id');
		$points 	 = $this->input->post('points');
		$event_task_id 	 = $this->input->post('event_task_id');
		$datetoday 		= date("Y-m-d H:i:s");
		
		$update_status = "UPDATE tbl_users_points_approved SET status = 1 WHERE id = $approval_id";
		$update_status_result = $this->db->query($update_status);
		$update_status2 = "UPDATE tbl_users_points SET current_points = current_points + $points , total_points = total_points + $points, update_date = '$datetoday' WHERE user_id = $user_id";
		$update_status_result2 = $this->db->query($update_status2);
		$update_status3 = "UPDATE tbl_users_badge SET  points = $points, update_date = '$datetoday'   WHERE user_id = $user_id AND event_task_id = $event_task_id";
		$update_status_result3 = $this->db->query($update_status3);
		$update_status4 = "UPDATE tbl_program_event_task_volunteers SET  status = 1  WHERE user_id = $user_id AND event_task_id = $event_task_id";
				$update_status_result4 = $this->db->query($update_status4);
		return $update_status_result4;
	}


	public function disqualify_task_user(){

		$approval_id = $this->input->post('approval_id');
		$user_id 	 = $this->input->post('user_id');
		$points 	 = $this->input->post('points');
		$event_task_id 	 = $this->input->post('event_task_id');
		$datetoday 		= date("Y-m-d H:i:s");
		
		$update_status = "UPDATE tbl_users_points_approved SET status = '-2' WHERE id = $approval_id";
		$update_status_result = $this->db->query($update_status);
		$update_status2 = "UPDATE tbl_users_points SET current_points = current_points - $points , total_points = total_points - $points, update_date = '$datetoday' WHERE user_id = $user_id";
		$update_status_result2 = $this->db->query($update_status2);
		$update_status3 = "UPDATE tbl_users_badge SET  points = $points, update_date = '$datetoday'   WHERE user_id = $user_id AND event_task_id = $event_task_id";
		$update_status_result3 = $this->db->query($update_status3);
		$update_status4 = "UPDATE tbl_program_event_task_volunteers SET  status = '-2'  WHERE user_id = $user_id AND event_task_id = $event_task_id";
				$update_status_result4 = $this->db->query($update_status4);
		return $update_status_result4;
	}

}
