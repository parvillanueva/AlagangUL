<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends GS_Controller {

	public function index()
	{

		$data['content'] = "site/programs/list";
		$data['meta'] = array(
			"title"         =>  "Programs",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		$data['active_menu'] = "programs";
		$this->parser->parse("site/layout/template",$data);
	}

	public function view()
	{

		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$program_details = $this->get_details($program_id, $program_alias);
		$data['details'] = $program_details;
		$data['content'] = "site/programs/view";
		$data['meta'] = array(
			"title"         =>  "Program",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);
		$data['active_menu'] = "programs";
		$this->parser->parse("site/layout/template",$data);
	}

	public function get_details($program_id, $program_alias){
		$program_details = $this->Gmodel->get_query('tbl_programs',"id = " . $program_id . " AND url_alias ='" . $program_alias . "'");
		$event_list = $this->Gmodel->get_query('tbl_program_events',"program_id = " . $program_id . " AND status = 1");

		$is_admin = 0;
		if($program_details[0]->created_by == $this->session->userdata('user_sess_id')){
			$is_admin = 1;
		}



		$events = array();
		foreach ($event_list as $key => $value) {

			$query_needed_volunteer = "SELECT SUM(required_volunteers) as count FROM tbl_program_event_task WHERE event_id = " . $value->id;
			$needed_volunteer = $this->db->query($query_needed_volunteer)->result();

			$query_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $value->id;
			$joined_volunteer = $this->db->query($query_joined_volunteer)->result();


			$is_joined = false;
			$query_is_joined = "SELECT * FROM tbl_program_event_task_volunteers WHERE user_id = " . $this->session->userdata('user_sess_id') . " AND event_id = " . $value->id;
			$result_is_joined = $this->db->query($query_is_joined)->result();
			if(count($result_is_joined) > 0){
				$is_joined = true;
			}


			$event_page_url = base_url("programs") . "/" . $program_id . "/" . $program_alias . "/event/" . $value->id . "/" . $value->url_alias;
			$events[] = array(
				"id"				=> $value->id,
				"link"				=> $event_page_url,
				"title"				=> $value->title,
				"image"				=> base_url() . $value->image,
				"description"		=> $value->description,
				"when"				=> $value->when,
				"where"				=> $value->where,
				"volunteer_points"	=> $value->volunteer_points,
				"is_admin"			=> ($value->user_id == $this->session->userdata('user_sess_id')) ? true : false,
				"is_joined"			=> $is_joined,
				"required_volunteer"=> ($needed_volunteer[0]->count != "") ? $needed_volunteer[0]->count : 0,
				"joined_volunteers"	=> ($joined_volunteer[0]->count != "") ? $joined_volunteer[0]->count : 0,
			);
		}

		$details = array(
			"details"	=> $program_details,
			"is_admin"	=> $is_admin,
			"events"	=> $events,
		);

		return $details;
	}

	public function upload(){
		
	}

}
