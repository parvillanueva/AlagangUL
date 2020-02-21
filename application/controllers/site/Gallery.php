<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends GS_Controller {

	public function view()
	{
		$event_id = $this->uri->segment(5);
		$event_alias = $this->uri->segment(6);
		$data['is_admin'] = $this->get_event_details($event_id, $event_alias);
		$event_id =  $this->uri->segment(5);
		$data['content'] = "site/gallery/default";
		$data['meta'] = array(
			"title"         =>  "Gallery",
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

		$data['photos'] = $this->db->query("SELECT * FROM tbl_program_event_gallery WHERE event_id = " . $event_id)->result();
		
		$this->parser->parse("site/layout/template",$data);
	}
	
	public function get_event_details($event_id, $event_alias){
		$event_details = $this->Gmodel->get_query('tbl_program_events',"id = " . $event_id . " AND url_alias ='" . $event_alias . "'");
		$events = array();
		foreach ($event_details as $key => $value) {

			$query_needed_volunteer = "SELECT SUM(required_volunteers) as count FROM tbl_program_event_task WHERE event_id = " . $value->id;
			$needed_volunteer = $this->db->query($query_needed_volunteer)->result();

			$query_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $value->id. " AND status >=0";
			$joined_volunteer = $this->db->query($query_joined_volunteer)->result();


			$is_joined = false;
			$query_is_joined = "SELECT * FROM tbl_program_event_task_volunteers WHERE user_id = " . $this->session->userdata('user_sess_id') . " AND event_id = " . $value->id ." AND status >=0"; 
			$result_is_joined = $this->db->query($query_is_joined)->result();
			if(count($result_is_joined) > 0){
				$is_joined = true;
			}
			$is_not_joined = $this->db->query("SELECT count(id) as count FROM tbl_program_event_task_volunteers WHERE user_id = " . $this->session->userdata('user_sess_id') . " AND event_id = " . $value->id)->result(); 


			$events[] = array(
				"id"				=> $value->id,
				"title"				=> $value->title,
				"image"				=> base_url() . $value->image,
				"description"		=> $value->description,
				"when"				=> $value->when,
				"where"				=> $value->where,
				"status"			=> $value->status,
				"url_alias"			=> $value->url_alias,
				"volunteer_points"	=> $value->volunteer_points,
				"is_admin"			=> ($value->user_id == $this->session->userdata('user_sess_id')) ? 1 : 0,
				"is_joined"			=> $is_joined,
				"is_not_joined"		=> ($is_not_joined[0]->count>=2) ? 1 : 0, 
				"required_volunteer"=> ($needed_volunteer[0]->count != "") ? $needed_volunteer[0]->count : 0,
				"joined_volunteers"	=> ($joined_volunteer[0]->count != "") ? $joined_volunteer[0]->count : 0,
			);
		}
		return $events;

	}
	
	public function delete_gallery_image(){
		unlink("./".$_POST['path']);
		$arr = array(
			'id'=>$_POST['id']
		);
		$result_sql = $this->Gmodel->delete_data_user('tbl_program_event_gallery', $arr);
		if($result_sql == 'success'){
			echo json_encode(array('response'=>'success'));
		} else{
			echo json_encode(array('response'=>'failed'));
		}
	}

}
