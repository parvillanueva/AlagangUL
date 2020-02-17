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
		//featured programs
		$data['programs'] = $this->Site_model->get_featured_programs_module();
		$this->parser->parse("site/layout/template",$data);
	}

	public function view()
	{

		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$program_details = $this->get_details($program_id, $program_alias);

		$data['details'] = $program_details;
		$data['workplace_feed'] = $this->get_workplace_feed();
		$data['content'] = "site/programs/view";
		$data['meta'] = array(
			"title"         =>  $program_details['details'][0]->name,
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
		$data['programs'] = $this->Site_model->get_other_programs($program_id);
		$this->parser->parse("site/layout/template",$data);
	}

	function get_workplace_feed(){
		$query = "SELECT post_by, post_by_img, likes, date_posted, post_message, post_image, post_link FROM tbl_workplace_feed ORDER BY date_posted DESC";
		$result = $this->db->query($query)->result();
		return $result;
	}

	public function get_details($program_id, $program_alias){
		$program_details = $this->Gmodel->get_query('tbl_programs',"id = " . $program_id . " AND url_alias ='" . $program_alias . "'");


		//check programs
		$page_Status = @$program_details[0]->status;
		$is_admin = @$program_details[0]->created_by == $_SESSION['user_sess_id'];
		if(count($program_details) > 0){
			if($page_Status == 0){
				if($is_admin === false){
					show_404();
				}
			}
		} else {
			show_404();
		}

		$is_admin = 0;
		if($program_details[0]->created_by == $this->session->userdata('user_sess_id')){
			$is_admin = 1;
		}


		// if($is_admin == 1){
		// 	$event_list = $this->Gmodel->get_query('tbl_program_events',"program_id = " . $program_id . " AND when >= '" . date("Y-m-d H:i:s") . "'");
		// } else 	{
			$event_list = $this->Gmodel->get_query('tbl_program_events',"program_id = " . $program_id . " AND status = 1 AND when >= '" . date("Y-m-d H:i:s") . "'");
		// }

		$events = array();
		foreach ($event_list as $key => $value) {

			$query_needed_volunteer = "SELECT SUM(required_volunteers) as count FROM tbl_program_event_task WHERE event_id = " . $value->id;
			$needed_volunteer = $this->db->query($query_needed_volunteer)->result();

			$query_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $value->id . " AND status >= 0";
			$joined_volunteer = $this->db->query($query_joined_volunteer)->result();


			$is_joined = false;
			$query_is_joined = "SELECT * FROM tbl_program_event_task_volunteers WHERE user_id = " . $this->session->userdata('user_sess_id') . " AND event_id = " . $value->id." AND status >=0";
			$result_is_joined = $this->db->query($query_is_joined)->result();
			if(count($result_is_joined) > 0){
				$is_joined = true;
			}

			$is_not_joined = $this->db->query("SELECT count(id) as count FROM tbl_program_event_task_volunteers WHERE user_id = " . $this->session->userdata('user_sess_id') . " AND event_id = " . $value->id)->result();


			$event_page_url = base_url("programs") . "/" . $program_id . "/" . $program_alias . "/event/" . $value->id . "/" . $value->url_alias;
			$events[] = array(
				"id"				=> $value->id,
				"link"				=> $event_page_url,
				"title"				=> $value->title,
				"image"				=> base_url() . $value->image,
				"description"		=> $value->description,
				"when"				=> $value->when,
				"where"				=> $value->where,
				"status"				=> $value->status,
				"volunteer_points"	=> $value->volunteer_points,
				"is_admin"			=> ($value->user_id == $this->session->userdata('user_sess_id')) ? true : false,
				"is_joined"			=> $is_joined,
				"is_not_joined"		=> ($is_not_joined[0]->count>=2) ? 1 : 0,
				"get_earn_badge"	=> $this->get_earn_badge($value->id),
				"required_volunteer"=> ($needed_volunteer[0]->count != "") ? $needed_volunteer[0]->count : 0,
				"joined_volunteers"	=> ($joined_volunteer[0]->count != "") ? $joined_volunteer[0]->count : 0,
			);
		}


		$query_members = "SELECT tbl_program_event_task_volunteers.*, CONCAT('" . base_url() . "','/',tbl_users.imagepath) as profile_image , CONCAT(tbl_users.first_name, ' ', tbl_users.last_name) as user, tbl_users.id as used_id, tbl_users_points.current_points as current_pt FROM tbl_program_event_task_volunteers LEFT JOIN tbl_users ON tbl_users.id = tbl_program_event_task_volunteers.user_id LEFT JOIN tbl_users_points ON tbl_users.id = tbl_users_points.user_id WHERE program_id = " . $program_id . " AND tbl_program_event_task_volunteers.status >= 0 GROUP BY user_id";
		$result_members = $this->db->query($query_members)->result();

		$details = array(
			"details"		=> $program_details,
			"members_count"	=> count($result_members),
			"members"		=> $result_members,
			"is_admin"		=> $is_admin,
			"events"		=> $events,
		);

		return $details;
	}

	public function get_earn_badge($event_id){
		$query = 'SELECT
			tbl_program_events.id,
			tbl_badges.`name`,
			tbl_badges.icon,
			tbl_badges.color
			FROM
			tbl_program_events
			INNER JOIN tbl_program_event_task ON tbl_program_events.id = tbl_program_event_task.event_id
			INNER JOIN tbl_program_event_task_badge ON tbl_program_event_task.id = tbl_program_event_task_badge.event_task_id
			INNER JOIN tbl_badges ON tbl_program_event_task_badge.badge_id = tbl_badges.id
			WHERE
			tbl_program_events.id = '.$event_id.'
			GROUP BY
			tbl_badges.id';
		return $this->db->query($query)->result();

	}


	public function update()
	{
		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);

		$post = $_POST;

		$data['name'] = $post['programName'];
		$data['url_alias'] = $this->format_slug($post['programName']);
		$data['overview'] = $post['overview'];
		$data['area_covered'] = $post['areaCovered'];
		$data['update_date'] = date("Y-m-d H:i:s");


		$storeFolder = "uploads/programs/" . $program_id ;

		if (!file_exists($storeFolder)) {
		    mkdir($storeFolder, 0777, true);
		}
		if (!empty($_FILES)) {
			if($_FILES['programImage']['size'] > 0) { //10 MB (size is also in bytes)
		        $tempFile = $_FILES['programImage']['tmp_name'];                   
			    $targetPath =  $storeFolder . "/";  
			    $targetFile =  $targetPath. str_replace(" ", "_", strtolower($_FILES['programImage']['name'])); 
			    move_uploaded_file($tempFile,$targetFile);
			    $data['image_thumbnail'] = $targetFile;
		    }
		   
		}


		$this->Gmodel->update_data("tbl_programs",$data,"id",$program_id);

		redirect($_SERVER['HTTP_REFERER']);

	}

	public function add()
	{
		$post = $_POST;

		$data['name'] = $post['programName'];
		$data['url_alias'] = $this->format_slug($post['programName']);
		$data['overview'] = $post['overview'];
		$data['area_covered'] = $post['areaCovered'];
		$data['created_by'] = $this->session->userdata('user_sess_id');
		$data['create_date'] = date("Y-m-d H:i:s");
		$data['update_date'] = date("Y-m-d H:i:s");
		$data['status'] = 0;

		$storeFolder2 = "uploads/programs/";
		$tempFile = $_FILES['programImage']['tmp_name'];                   
		$targetPath =  $storeFolder2 . "/";  
		$targetFile =  $targetPath. str_replace(" ", "_", strtolower($_FILES['programImage']['name'])); 
		$data['image_thumbnail'] = $targetFile;

		$program_id = $this->Gmodel->save_data("tbl_programs",$data);

		$storeFolder = "uploads/programs/" . $program_id ;

		if (!file_exists($storeFolder)) {
		    mkdir($storeFolder, 0777, true);
		}
		if (!empty($_FILES)) {
			if($_FILES['programImage']['size'] > 0) { //10 MB (size is also in bytes)		        
			    move_uploaded_file($tempFile,$targetFile);			    
		    }
		   
		}

		if($program_id){
			$data['image_thumbnail'] = $targetFile;
		}

		$this->Gmodel->update_data("tbl_programs",$data,"id",$program_id);
		
		redirect($_SERVER['HTTP_REFERER']);

	}

	public function publish()
	{
		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$post = $_POST;
		$data['update_date'] = date("Y-m-d H:i:s");
		$data['status'] = 1;
		$this->Gmodel->update_data("tbl_programs",$data,"id",$program_id);
		redirect(base_url("programs") . "/" . $program_id . "/" . $program_alias);
	}

	public function unpublish()
	{
		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$post = $_POST;
		$data['update_date'] = date("Y-m-d H:i:s");
		$data['status'] = 0;
		$this->Gmodel->update_data("tbl_programs",$data,"id",$program_id);
		redirect(base_url("programs") . "/" . $program_id . "/" . $program_alias);
	}

	function format_slug($title)
	{
	    $title = trim(strtolower($title));
	    $title = preg_replace('#[^a-z0-9\\/]#i', '-', $title);
	    $title = str_replace('/', '-', $title);
	    return trim(preg_replace('/-+/', '-', $title), '-/');
	}

}
