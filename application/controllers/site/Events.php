<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends GS_Controller {

	public function index()
	{

		$data['content'] = "site/events/list";
		$data['meta'] = array(
			"title"         =>  "Event List",
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

	function volunteer() {
		$user_id = $this->session->userdata('user_sess_id');
		$data_array = array(
			'program_id' 	=> $_GET['program_id'],
			'event_id'	 	=> $_GET['event_id'],
			'event_task_id' => $_GET['event_task_id'],
			'user_id'		=> $user_id,
			'date_volunteer'=> date('Y-m-d H:i:s')
			);
		$data_array2 = $data_array;

		$this->db->query("DELETE FROM tbl_program_event_task_volunteers WHERE event_id = '".$_GET['event_id']."' AND user_id ='".$user_id."'");
		$this->db->query("DELETE FROM tbl_users_points_approved WHERE event_id = '".$_GET['event_id']."' AND user_id ='".$user_id."'");
		$this->db->query("DELETE FROM tbl_users_badge WHERE event_id = '".$_GET['event_id']."' AND user_id ='".$user_id."'");
		if($_GET['is_submit']==0){
			
		}
		else{
			$data = "SELECT volunteer_points FROM tbl_program_events WHERE id = ".$_GET['event_id'];
			$result = $this->db->query($data)->result();

			$this->Gmodel->save_data('tbl_program_event_task_volunteers', $data_array);
			$data_array['points'] = $result[0]->volunteer_points;
			$this->Gmodel->save_data('tbl_users_points_approved', $data_array);

			$data = "SELECT badge_id FROM tbl_program_event_task_badge WHERE event_task_id = ".$_GET['event_task_id'];
			$result = $this->db->query($data)->result();

			foreach ($result as $key => $value) {
				$data_array2['create_date'] = date('Y-m-d H:i:s');
				$data_array2['update_date'] = date('Y-m-d H:i:s');
				$data_array2['badge_id'] = $value->badge_id;
				unset($data_array2['date_volunteer']);
				$this->Gmodel->save_data('tbl_users_badge', $data_array2);
			}
			
		}
	}
	public function view()
	{

		$program_id = $this->uri->segment(2);
		$event_id = $this->uri->segment(5);

		
		$data['program_details'] = $this->get_program_details($program_id);
		$data['event_details'] = $this->get_event_details($event_id);
		$data['event_task'] = $this->get_event_tasks($event_id);
		$data['event_volunteers'] = $this->get_volunteers($event_id);
		$data['program_id'] = $program_id;
		$data['event_id'] = $event_id;
		$is_volunteered = 0;
		$user_id = $this->session->userdata('user_sess_id');
		$data['is_allowed_to_volunteer'] = $this->check_is_allowed($event_id,date('Y-m-d',strtotime($data['event_details'][0]['when'])));
		//$data['is_volunteered'] = array_search($user_id, array_column($data['event_volunteers'], 'user_id'));

		$data['content'] = "site/events/view";
		$data['meta'] = array(
			"title"         => $data['event_details'][0]['title'],
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
	public function check_is_allowed($event_id,$date){
		$user_id = $this->session->userdata('user_sess_id');
		$data = "SELECT COUNT(pe.id) as count FROM tbl_program_events pe LEFT JOIN tbl_program_event_task_volunteers petv ON pe.id = petv.event_id WHERE pe.id !='" .$event_id."' AND pe.when LIKE '".$date."%' AND petv.user_id = ".$user_id;
		$result = $this->db->query($data)->result();
		return $result[0]->count;
	}

	public function get_volunteers($event_id){
		$query_joined_volunteer = "SELECT tbl_program_event_task_volunteers.*, CONCAT('" . base_url() . "','/',tbl_users.imagepath) as profile_image , CONCAT(tbl_users.first_name, ' ', tbl_users.last_name) as user FROM tbl_program_event_task_volunteers LEFT JOIN tbl_users ON tbl_users.id = tbl_program_event_task_volunteers.user_id WHERE event_id = " . $event_id . " GROUP BY tbl_users.id";
		$joined_volunteer = $this->db->query($query_joined_volunteer)->result();
		return $joined_volunteer;
	}


	public function get_event_tasks($event_id){
		$get_event_tasks = $this->Gmodel->get_query('tbl_program_event_task',"event_id = " . $event_id);
		$event_task = array();
		
		foreach ($get_event_tasks as $key => $value) {
			$task_badge = array();
			$query_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $event_id . " AND event_task_id = " . $value->id;
			$joined_volunteer = $this->db->query($query_joined_volunteer)->result();

			$query_event_task_badge = "SELECT b.id, b.name, b.icon, b.color, petb.event_task_id FROM tbl_program_event_task_badge petb LEFT JOIN tbl_badges b ON petb.badge_id = b.id WHERE petb.event_task_id = ".$value->id." ";
			$event_task_badge = $this->db->query($query_event_task_badge)->result();

			foreach ($event_task_badge as $key => $badge) {
				$task_badge[] = $badge;
			}
			$user_id = $this->session->userdata('user_sess_id');
			$query_user_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $event_id . " AND event_task_id = " . $value->id. " AND user_id = ". $user_id;
			$is_joined = $this->db->query($query_user_joined_volunteer)->result();

			$event_task[] = array(
				"id"					=> $value->id,
				"task"					=> $value->task,
				"qualification"			=> $value->qualification,
				"required_volunteers"	=> $value->required_volunteers,
				"joined_volunteers"		=> $joined_volunteer[0]->count,
				"task_badge"			=> $task_badge,
				"user_id_joined"		=> $is_joined[0]->count
			);
		}
		return $event_task;
	}

	public function get_program_details($program_id){
		$program_details = $this->Gmodel->get_query('tbl_programs',"id = " . $program_id);
		$program = array();
		foreach ($program_details as $key => $value) {
			$program[] = array(
				"name"					=> $value->name,
				"image_thumbnail"		=> base_url() . $value->image_thumbnail,
				"id"					=> $value->id
			);
		}
		return $program;
	}

	public function get_event_details($event_id){
		$event_details = $this->Gmodel->get_query('tbl_program_events',"id = " . $event_id . " AND status = 1");
		$events = array();
		foreach ($event_details as $key => $value) {

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


			$events[] = array(
				"id"				=> $value->id,
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
		return $events;

	}

	public function upload(){
		$ds = DIRECTORY_SEPARATOR; 
		$storeFolder = "uploads/events/gallery/".$_GET['event_id'];

		if (!file_exists($storeFolder)) {
		    mkdir($storeFolder, 0777, true);
		}
		if (!empty($_FILES)) {
		    $tempFile = $_FILES['file']['tmp_name'];                   
		    $targetPath =  $storeFolder . "/";  
		    $targetFile =  $targetPath. str_replace(" ", "_", strtolower($_FILES['file']['name'])); 
		    move_uploaded_file($tempFile,$targetFile);

		    $data = array(
		    	"event_id"		=> $_GET['event_id'],
		    	"path"			=> $targetFile,
		    	"create_date"	=> date("Y-m-d H:i:s")
		    );
		    $this->Gmodel->save_data('tbl_program_event_gallery', $data);
		}
	}

	public function get_gallery(){
		header('Content-Type: application/json');

		$event_id = $_GET['event_id'];
		$limit = $_GET['limit'];
		$gallery_query = "SELECT * FROM tbl_program_event_gallery WHERE event_id = " . $event_id . " LIMIT " . $limit;
		$gallery_result = $this->db->query($gallery_query)->result();
		echo json_encode($gallery_result);
	}
}
