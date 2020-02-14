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

		//banner data	
		$data['program_id'] = $program_id;
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
			CONCAT('programs/',tbl_programs.id, '/', tbl_programs.url_alias, '/event/' , tbl_program_events.id , '/' , tbl_program_events.url_alias ) AS Url
			FROM
			tbl_program_events
			INNER JOIN tbl_programs ON tbl_programs.id = tbl_program_events.program_id
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

}
