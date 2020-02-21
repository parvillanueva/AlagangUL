<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends GS_Controller {

	public function index()
	{
		$data['events'] = $this->get_details();
		$data['badges'] = $this->get_badges();
		$data['event_task'] = $this->get_event_tasks_all();
		$data['event_program'] = $this->get_event_list();
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
		$data['task'] = $this->get_task();
		$data['get_volunteer_type'] = $this->get_volunteer_type();
		$this->parser->parse("site/layout/template",$data);
	}
	public function publish()
	{
		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$event_id = $this->uri->segment(5);
		$event_alias = $this->uri->segment(6);
		$data['update_date'] = date("Y-m-d H:i:s");
		$data['status'] = $this->uri->segment(8);;
		$this->Gmodel->update_data("tbl_program_events",$data,"id",$event_id);
		redirect(base_url("programs") . "/" . $program_id . "/" . $program_alias. "/event/" . $event_id . "/" . $event_alias);
	}

	function volunteer() {
		$user_id = $this->session->userdata('user_sess_id');
		$data_array = array(
			'program_id' 	=> $_GET['program_id'],
			'event_id'	 	=> $_GET['event_id'],
			'event_task_id' => $_GET['event_task_id'],
			'user_id'		=> $user_id,
			'date_volunteer'=> date('Y-m-d H:i:s'),
			'status'		=> 1
			);
		$data_array2 = $data_array;

		//$this->db->query("DELETE FROM tbl_program_event_task_volunteers WHERE event_id = '".$_GET['event_id']."' AND user_id ='".$user_id."'");
		$this->db->query("DELETE FROM tbl_users_points_approved WHERE event_id = '".$_GET['event_id']."' AND user_id ='".$user_id."'");
		$this->db->query("DELETE FROM tbl_users_badge WHERE event_id = '".$_GET['event_id']."' AND user_id ='".$user_id."'");
		if($_GET['is_submit']==0){
			$this->db->query("DELETE FROM tbl_program_event_task_volunteers WHERE event_id = '".$_GET['event_id']."' AND user_id ='".$user_id."'"." AND event_task_id ='".$_GET['event_task_id']."'");
		}
		else{
			$this->db->query("UPDATE tbl_program_event_task_volunteers SET status = -3 WHERE event_id = '".$_GET['event_id']."' AND user_id ='".$user_id."'");

			$this->Gmodel->save_data('tbl_program_event_task_volunteers', $data_array);



			$data = "SELECT volunteer_points FROM tbl_program_events WHERE id = ".$_GET['event_id'];
			$result = $this->db->query($data)->result();

			
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
		$program_alias = $this->uri->segment(3);
		$event_id = $this->uri->segment(5);
		$event_alias = $this->uri->segment(6);

		$data['program_details'] = $this->get_program_details($program_id, $program_alias);
		$data['event_details'] = $this->get_event_details($event_id, $event_alias);

		$data['testimonials'] = $this->get_testimonial(1,4,$event_id,0,"all");
		$data['testimonials_count'] = ceil($this->get_testimonial(1,9999,$event_id,0,"count")/4);
		$data['galleries'] = $this->get_gallery(4,$event_id,0);
		//check event
		$page_Status = @$data['event_details'][0]['status'];
		$is_admin = @$data['event_details'][0]['is_admin'];
		
		if($page_Status){
			if($page_Status == 0){
				if($is_admin === false){
					show_404();
				}
			}
		} else {
			if($is_admin === false){
				show_404();
			}
		}


		$data['event_task'] = $this->get_event_tasks($event_id);
		$data['event_volunteers'] = $this->get_volunteers($event_id);
		$data['badges'] = $this->get_badges();
		$data['earn_badge'] = $this->get_earn_badge($event_id);
		$data['validate_testimonial'] = $this->validate_testimonial($event_id, $_SESSION['user_sess_id']);
		$data['program_id'] = $program_id;
		$data['event_id'] = $event_id;
		$is_volunteered = 0;
		$user_id = $this->session->userdata('user_sess_id');
		$data['is_allowed_to_volunteer'] = $this->check_is_allowed($event_id,date('Y-m-d',strtotime($data['event_details'][0]['when'])));

		$data['guidelines'] = $this->get_guidelines();
		$data['waiver'] = $this->get_waiver();

		//$data['is_volunteered'] = array_search($user_id, array_column($data['event_volunteers'], 'user_id'));
		/*echo "<pre>";
		print_r($data);
		die();*/
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

	public function get_guidelines(){
		$data = "SELECT title, description FROM tbl_guidelines";
		$result = $this->db->query($data)->result();
		return $result;
	}
	

	public function get_waiver(){
		$data = "SELECT title, description FROM tbl_waivers";
		$result = $this->db->query($data)->result();
		return $result;
	}
	
	public function submit_filter(){
		$date = $_POST['date']; 
		$date_explode = explode('-',$date);
		$date_from = date('Y-m-d', strtotime($date_explode[0]));
		$date_to = date('Y-m-d', strtotime($date_explode[1]));
		$arr = array(
			'search_box' => $_POST['search_box'],
			'location' => $_POST['location'],
			'task' => $_POST['task'],
			'date_from' => $date_from,
			'date_to' => $date_to,
			//'badge_id' => $_POST['badge_id']
		);
		if(!empty($_POST['task'])){
			$arr['badge_id'] = $_POST['badge_id'];
		}
		$data_arry = $this->get_details($arr);
		if(!empty($data_arry)){
			$data['events'] = $data_arry;
			$this->load->view('site/events/event_list', $data);
		} else{
			$this->load->view('site/events/event_no_data');
		}
	}
	
	public function filter_where($arr){
			$where_date = '';
		if($arr['date_from'] != '' && $arr['date_to'] != ''){
			$where_date = 'AND "'.$arr['date_from'].'" <= when AND when <= "'.$arr['date_to'].'"';
		}
			$where_location = '';
		if($arr['location'] != ''){
			$where_location = "AND where like '%".$arr['location']."%'";
		}
			$where_search = '';
		if($arr['search_box'] != ''){
			$where_search = 'AND (title like "%\\'.$arr['search_box'].'%" OR url_alias like "%\\'.$arr['search_box'].'%" OR description like "%\\'.$arr['search_box'].'%" OR where like "%\\'.$arr['search_box'].'%")';
		}
			$where_task = '';
		if($arr['task'] != ''){
			$task_event = $this->event_task($arr['task'], $arr['badge_id']);
			$eve = '';
			foreach($task_event as $eve_loop){
				$eve .= "id like '%".$eve_loop->event_id."%' OR ";
			}
			$string = rtrim($eve, 'OR ');
			$where_task = 'AND ('.$string.')';
		}
			$where_type = '';
		/* if($arr['types'] != ''){
			$type_event = $this->event_type($arr['types']);
			$task = '';
			foreach($type_event as $typ_loop){
				$task .= "id like '%".$typ_loop->event_task_id."%' OR ";
			}
			$string_type = rtrim($task, 'OR ');
			$where_type = 'AND ('.$string_type.')';
		} */
		
		$result = array(
			'search_date' => $where_date .' '. $where_search.' '.$where_location,
			'task' => $where_task,
			//'type' => $where_type
			
		);
		return $result;
	}
	
	public function get_details($dat_arr = null){
			$filter_where = "AND when like '%" . date("Y") . "%'";
			$task_where = '';
			$type_where = '';
		if(!empty($dat_arr)){
			$result_where = $this->filter_where($dat_arr);
			$filter_where = $result_where['search_date'];
			$task_where = $result_where['task'];
			//$type_where = $result_where['type'];
		}
		
		$event_list = $this->Gmodel->get_query('tbl_program_events',"status = 1 ".$filter_where." ".$task_where." ".$type_where." ORDER BY month(`when`)");

		$events = array();
		foreach ($event_list as $key => $value) {

			$query_needed_volunteer = "SELECT SUM(required_volunteers) as count FROM tbl_program_event_task WHERE event_id = " . $value->id;
			$needed_volunteer = $this->db->query($query_needed_volunteer)->result();

			$query_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $value->id . " AND status >= 0";
			$joined_volunteer = $this->db->query($query_joined_volunteer)->result();


			$is_joined = false;
			$query_is_joined = "SELECT * FROM tbl_program_event_task_volunteers WHERE user_id = " . $this->session->userdata('user_sess_id')." AND status >=0 " . " AND event_id = " . $value->id ."";
			$result_is_joined = $this->db->query($query_is_joined)->result();
			if(count($result_is_joined) > 0){
				$is_joined = true;
			}
			$is_not_joined = $this->db->query("SELECT count(id) as count FROM tbl_program_event_task_volunteers WHERE user_id = " . $this->session->userdata('user_sess_id') . " AND event_id = " . $value->id)->result(); 
			
			$query_program_details = "SELECT id, image_thumbnail, url_alias FROM tbl_programs WHERE id = " . $value->program_id;
			$program_details = $this->db->query($query_program_details)->result();
			
			$events[] = array( 
				"id"				=> $value->id,
				"get_earn_badge"	=> $this->get_earn_badge($value->id),
				"url_alias"			=> $value->url_alias,
				"program_details"   => $program_details[0],
				//"link"				=> $event_page_url,
				"title"				=> $value->title,
				"image"				=> base_url() . $value->image,
				"description"		=> $value->description,
				"when"				=> $value->when,
				"where"				=> $value->where,
				"status"			=> $value->status,
				"volunteer_points"	=> $value->volunteer_points,
				"is_admin"			=> ($value->user_id == $this->session->userdata('user_sess_id')) ? true : false,
				"is_joined"			=> $is_joined,
				"is_not_joined"		=> ($is_not_joined[0]->count>=2) ? 1 : 0, 
				"required_volunteer"=> ($needed_volunteer[0]->count != "") ? $needed_volunteer[0]->count : 0,
				"joined_volunteers"	=> ($joined_volunteer[0]->count != "") ? $joined_volunteer[0]->count : 0,
			);
		}

		return $events;
	}
	
	public function event_task($task_title, $badge_id){
		$data = "SELECT event_id FROM tbl_program_event_task et INNER JOIN tbl_program_event_task_badge etb ON et.id=etb.event_task_id where et.task like '%".$task_title."%' and etb.badge_id='".$badge_id."'";
		$result = $this->db->query($data)->result();
		return $result;
	}
	
	public function event_type($type_id){
		$data = "SELECT event_task_id FROM tbl_program_event_task_badge where badge_id = '".$type_id."'";
		$result = $this->db->query($data)->result();
		return $result;
	}
	
	public function validate_testimonial($event_id, $user_id){
		$arr = array(
			'event_id' => $event_id,
			'user_id' => $user_id,
			'status >=' => 0
		);
		$result = $this->Gmodel->get_query('tbl_program_event_task_volunteers', $arr);
		if(empty($result)){
			return 'empty';
		} else{
			return 'not_empty';
		}
	}
	
	public function get_badges(){
		$sql = "Select * From tbl_badges";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function get_event_tasks_all(){
		$sql = "Select * From tbl_badges";
		$result_badges = $this->db->query($sql)->result();
		$arr = array();
		foreach($result_badges as $lbadge){
			$arr[$lbadge->name] = array(
				'task' => $this->task_event_set($lbadge->id),
				'badge_id' => $lbadge->id
			);
		}
		return $arr;
	}
	
	public function task_event_set($badgeId){
		$sql = "Select task From tbl_program_event_task tblpret INNER JOIN tbl_program_event_task_badge tblpetb ON tblpret.id=tblpetb.event_task_id WHERE tblpetb.badge_id='".$badgeId."' GROUP BY tblpret.task";
		$result_badges = $this->db->query($sql)->result();
		return $result_badges;
	}

	public function check_is_allowed($event_id,$date){
		$user_id = $this->session->userdata('user_sess_id');
		$data = "SELECT COUNT(pe.id) as count FROM tbl_program_events pe LEFT JOIN tbl_program_event_task_volunteers petv ON pe.id = petv.event_id WHERE pe.id !='" .$event_id."' AND pe.when LIKE '".$date."%' AND petv.user_id = ".$user_id;
		$result = $this->db->query($data)->result();
		return $result[0]->count;
	}

	public function manage()
	{

		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$event_id = $this->uri->segment(5);
		$event_alias = $this->uri->segment(6);

		// $arra
		$data['program_details'] = $this->get_program_details($program_id, $program_alias);
		$data['event_details'] = $this->get_event_details($event_id, $event_alias);
		$data['event_task'] = $this->get_event_tasks($event_id);
		$data['event_volunteers'] = $this->get_volunteers($event_id);
		$data['users_approval'] = $this->get_approval_volunteers($event_id);
		
		$data['content'] = "site/events/manage";
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

	public function get_earn_badge($event_id){
		$query = 'SELECT
			tbl_program_events.id,
			tbl_badges.`name`,
			tbl_badges.icon,
			tbl_badges.icon_image,
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

	public function get_volunteer_badge($event_id, $user_id){
		$query = 'SELECT
			tbl_program_events.id,
			tbl_badges.`name`,
			tbl_badges.icon,
			tbl_badges.icon_image,
			tbl_badges.color
			FROM
			tbl_program_events
			INNER JOIN tbl_program_event_task ON tbl_program_events.id = tbl_program_event_task.event_id
			INNER JOIN tbl_program_event_task_badge ON tbl_program_event_task.id = tbl_program_event_task_badge.event_task_id
			INNER JOIN tbl_badges ON tbl_program_event_task_badge.badge_id = tbl_badges.id
			INNER JOIN tbl_program_event_task_volunteers ON tbl_program_event_task_volunteers.event_task_id = tbl_program_event_task.id
			WHERE
			tbl_program_events.id = '.$event_id.' AND
			tbl_program_event_task_volunteers.user_id = '.$user_id.' AND
			tbl_program_event_task_volunteers.status >= 0
			GROUP BY
			tbl_badges.id
';
		return $this->db->query($query)->result();

	}


	public function data_volunteers(){
		// $event_id = $this->uri->segment(5);
		$event_id = $this->input->post('event_id');
		$result = $this->get_approval_volunteers($event_id);
		echo json_encode($result);
	}

	public function get_volunteers($event_id){
		$query_joined_volunteer = "SELECT tbl_program_event_task_volunteers.*, CONCAT('" . base_url() . "','/',tbl_users.imagepath) as profile_image , CONCAT(tbl_users.first_name, ' ', tbl_users.last_name) as user FROM tbl_program_event_task_volunteers LEFT JOIN tbl_users ON tbl_users.id = tbl_program_event_task_volunteers.user_id WHERE event_id = " . $event_id . " AND tbl_program_event_task_volunteers.status >= 0 GROUP BY tbl_users.id";
		$joined_volunteer = $this->db->query($query_joined_volunteer)->result();

		$data = array();
		foreach ($joined_volunteer as $key => $value) {
			$data[] = array(
				"user_id"			=> $value->user_id,
				"profile_image"		=> $value->profile_image,
				"user"				=> $value->user,
				"badge"				=> $this->get_volunteer_badge($event_id, $value->user_id),
			);

		}
		return $data;
	}


	public function get_approval_volunteers($event_id){
		$arr = array();
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
		return $arr;
	}

	public function get_event_tasks($event_id){
		$get_event_tasks = $this->Gmodel->get_query('tbl_program_event_task',"status = 1 AND event_id = " . $event_id);
		$event_task = array();
		
		foreach ($get_event_tasks as $key => $value) {
			$task_badge = array();
			$query_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $event_id . " AND event_task_id = " . $value->id." AND status >=0";
			$joined_volunteer = $this->db->query($query_joined_volunteer)->result();

			$query_event_task_badge = "SELECT b.id, b.name, b.icon, b.color, b.image, petb.event_task_id FROM tbl_program_event_task_badge petb LEFT JOIN tbl_badges b ON petb.badge_id = b.id WHERE petb.event_task_id = ".$value->id." ";
			$event_task_badge = $this->db->query($query_event_task_badge)->result();

			foreach ($event_task_badge as $key => $badge) {
				$task_badge[] = $badge;
			}
			$user_id = $this->session->userdata('user_sess_id');
			$query_user_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $event_id . " AND event_task_id = " . $value->id. " AND user_id = ". $user_id." AND status >=0";
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

	public function get_program_details($program_id, $program_alias){
		$program_details = $this->Gmodel->get_query('tbl_programs',"id = " . $program_id . " AND url_alias ='" . $program_alias . "'");


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
		$program = array();
		foreach ($program_details as $key => $value) {
			$program[] = array(
				"name"					=> $value->name,
				"url_alias"				=> $value->url_alias,
				"image_thumbnail"		=> base_url() . $value->image_thumbnail,
				"id"					=> $value->id,
				"status"					=> $value->status,
			);
		}
		return $program;
	}
	
	public function get_event_list(){
		$sql = "Select * From tbl_program_events group by `where`";
		$result = $this->db->query($sql)->result();
		return $result;
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

	public function upload(){
		$ds = DIRECTORY_SEPARATOR; 
		$storeFolder = "uploads/events/gallery/".$_GET['event_id']. "/". date('Y_m_d');

		if (!file_exists($storeFolder)) {
		    mkdir($storeFolder, 0777, true);
		}
		if (!file_exists($storeFolder . "/thumb/")) {
		    mkdir($storeFolder . "/thumb/", 0777, true);
		}
		if (!empty($_FILES)) {

			$config['upload_path']         = "./" . $storeFolder;
            $config['allowed_types']       = 'gif|jpg|png';
            $config['encrypt_name']        = true;
            $this->load->library('upload', $config);

            if($this->upload->do_upload('file')){ 
	            $uploadData = $this->upload->data(); 
	            $uploadedImage = $uploadData['file_name']; 
	            $org_image_size = $uploadData['image_width'].'x'.$uploadData['image_height']; 
	             $imagePath = $storeFolder . "/" . $uploadData['file_name'];
	             
	            $source_path = $storeFolder . "/" .$uploadedImage; 
	            $thumb_path = $storeFolder .'/thumb/'; 
	            $thumb_width = 300; 
	             
	            // Image resize config 
	            $config['image_library']    = 'gd2'; 
	            $config['source_image']     = $source_path; 
	            $config['new_image']         = $thumb_path; 
	            $config['maintain_ratio']   = TRUE; 
	            $config['width']            = $thumb_width; 
	             
	            // Load and initialize image_lib library 
	            $this->load->library('image_lib', $config); 
	            $this->image_lib->resize();
             
         	

			    // $tempFile = $_FILES['file']['tmp_name'];                   
			 //    $targetPath =  $storeFolder . "/";
				// $file_name_new = $this->clean_str($_FILES['file']['name']);
			 //    $targetFile =  $targetPath. str_replace(" ", "_", strtolower($file_name_new)); 
			 //    move_uploaded_file($tempFile,$targetFile);

				// $this->createThumbs($storeFolder,$storeFolder . "/thumb/",100);


			    $data = array(
			    	"event_id"			=> $_GET['event_id'],
			    	"path"				=> $imagePath,
			    	"thumb"				=> $thumb_path . $uploadData['file_name'],
					"status"			=> 1,
					"uploader_id" 		=> $this->session->userdata('user_sess_id'),
			    	"create_date"		=> date("Y-m-d H:i:s")
			    );
			    echo $this->Gmodel->save_data('tbl_program_event_gallery', $data);
			}
		}
	}
	function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
	{
	  // open the directory
	  $dir = opendir( $pathToImages );

	  // loop through it, looking for any/all JPG files:
	  while (false !== ($fname = readdir( $dir ))) {
	    // parse path for the extension
	    $info = pathinfo($pathToImages . $fname);
	    // continue only if this is a JPEG image
	    if ( strtolower($info['extension']) == 'jpg' ) 
	    {
	      echo "Creating thumbnail for {$fname} <br />";

	      // load image and get image size
	      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
	      $width = imagesx( $img );
	      $height = imagesy( $img );

	      // calculate thumbnail size
	      $new_width = $thumbWidth;
	      $new_height = floor( $height * ( $thumbWidth / $width ) );

	      // create a new temporary image
	      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

	      // copy and resize old image into new image 
	      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

	      // save thumbnail into a file
	      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
	    }
	  }
	  // close the directory
	  closedir( $dir );
	}
	
	function clean_str($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9-.\-]/', '', $string); // Removes special chars.
	}

	function get_gallery($limit,$event_id,$is_load_page,$is_admin=null,$is_joined=null){
		//header('Content-Type: application/json');

		//$event_id = $_GET['event_id'];
		//$limit = $_GET['limit'];
		$gallery_query_count = "SELECT count(*) as total_data FROM tbl_program_event_gallery WHERE event_id = " . $event_id ." and status = '1'";
		$gallery_result_count = $this->db->query($gallery_query_count)->result();
		$gallery_query = "SELECT * FROM tbl_program_event_gallery WHERE event_id = " . $event_id . " and status = '1' ORDER BY create_date DESC LIMIT " . $limit;
		$gallery_result = $this->db->query($gallery_query)->result();
		$array_data = array(
			'result' => $gallery_result,
			'count' => $gallery_result_count[0]->total_data,
		);
		if($is_load_page==0){
			return $array_data;
		}
		else{
			$data['galleries'] = $array_data['result'];
			$data['galleries_pages'] = $array_data['count'];
			$data['is_admin'] = $is_admin;
			$data['is_joined'] = $is_joined;
			$this->load->view('site/events/gallery',$data);
		}
		
	}
	
	function get_testimonial($page,$limit,$event_id,$is_load_page,$select){
		$x =0;
		if($select=='all'){
			$select = 'testimonial,user_id,create_date';
			$x = 1;
		}
		else{
			$select = 'COUNT(id) as count';
		}
		$start = ($page-1) * $limit;
		$testimonial_query = "SELECT ".$select." FROM tbl_program_event_testimonials WHERE event_id = " . $event_id." ORDER BY create_date DESC LIMIT ".$start.", ".$limit;
		$testimonial_result = $this->db->query($testimonial_query)->result();
		if($x==0){
			return $testimonial_result[0]->count;
		}
		else{
			$array_data = array();
			foreach($testimonial_result as $tes_loop){
				$array_data[] = array(
					'testimonial' 	=> $tes_loop->testimonial,
					'badge'			=> $this->get_volunteer_badge($event_id, $tes_loop->user_id),
					'picture' 		=> $this->profile_image($tes_loop->user_id),
					'date_posted'	=> date('F d, Y h:s A', strtotime($tes_loop->create_date))
				);
			}
			if($is_load_page==0){
				return $array_data;
			}
			else{
				$data['testimonials'] = $array_data;
				$data['testimonials_page'] = (count($array_data)>0) ? 1 : 0 ;
				$this->load->view('site/events/testimonials',$data);
			}
		}
	}
	
	public function profile_image($user_id){
		$user_query = "SELECT * FROM tbl_users WHERE id = " . $user_id ;
		$user_result = $this->db->query($user_query)->result();
		$data_arr = array(
			'image_path' => $user_result[0]->imagepath,
			'email' => $user_result[0]->email_address,
			'name' => $user_result[0]->first_name.' '.$user_result[0]->last_name,
			'user_id' => $user_result[0]->id
		);
		return $data_arr;
	}
	
	public function testimonial_save(){
		$arr = array(
			'event_id' => $_POST['event_id'],
			'user_id' => $_SESSION['user_sess_id'],
			'testimonial' => $_POST['testimonial'],
			'create_date' => date('Y-m-d H:i:s')
		);
		$sql_result = $this->Gmodel->save_data('tbl_program_event_testimonials', $arr);
		if($sql_result != ''){
			echo json_encode(array('responce' => 'success'));
		} else{
			echo json_encode(array('responce' => 'failed'));
		}
	}
	
	public function delete_gallery_image(){
		date_default_timezone_set('Asia/Manila');
		$arr = array(
			'status' => -2,
			'update_date' => date('Y-m-d H:i:s')
		);
		$sql_result = $this->Gmodel->update_data('tbl_program_event_gallery', $arr, 'id', $_POST['id']);
		echo json_encode(array('responce' => $sql_result));
	}

	public function add_event_task(){
		$arr = array(
			'event_id' => $_POST['event_id'],
			'task'=> $_POST['possible_volunteer'],
			'qualification' => $_POST['qualification'],
			'required_volunteers' => $_POST['needed'],
			'create_date' => date('Y-m-d H:i:s'),
			'update_date' => date('Y-m-d H:i:s'),
			'status' => 1,
		);
		$sql_result = $this->Gmodel->save_data('tbl_program_event_task', $arr);
		$task_query = "SELECT max(id) as task_id FROM tbl_program_event_task" ;
		$task_result = $this->db->query($task_query)->result();
		$this->add_badges_details($task_result[0]->task_id, $_POST['badges']);
		if($task_result != ''){
			echo json_encode(array('responce' => 'success'));
		} else{
			echo json_encode(array('responce' => 'failed'));
		}
	}


	public function update_event_task(){

		$id = $_POST['task_id'];
		$arr = array(
			'event_id' => $_POST['event_id'],
			'task'=> $_POST['possible_volunteer'],
			'qualification' => $_POST['qualification'],
			'required_volunteers' => $_POST['needed'],
			'create_date' => date('Y-m-d H:i:s'),
			'update_date' => date('Y-m-d H:i:s'),
			'status' => 1,
		);

		$sql_result = $this->Gmodel->update_data('tbl_program_event_task',$arr,'id',$id);
		// $task_query = "SELECT max(id) as task_id FROM tbl_program_event_task" ;
		// $task_result = $this->db->query($task_query)->result();
		$result = $this->update_badges_details($id,$_POST['badges']);
		if($result > 0 ){
			echo json_encode(array('responce' => 'success'));
		} else{
			echo json_encode(array('responce' => 'failed'));
		}
	}
	
	public function add_badges_details($task_id, $badges){
		foreach($badges as $bloop){
			$arr = array(
				'event_task_id' => $task_id,
				'badge_id' => $bloop
			);
			$sql_result = $this->Gmodel->save_data('tbl_program_event_task_badge', $arr);
		}
	}
	
	public function update_badges_details($task_id, $badges){
		$count = 0;
		$query = "DELETE FROM tbl_program_event_task_badge WHERE event_task_id = $task_id";
		$result = $this->db->query($query);
		foreach($badges as $bloop){
			$arr = array(
				'event_task_id' => $task_id,
				'badge_id' => $bloop
			);
			$sql_result = $this->Gmodel->save_data('tbl_program_event_task_badge', $arr);
			$count++;
			// $this->Gmodel->update_data('tbl_program_event_task_badge',$arr,'id',$result[0]['id']);
		}
		return $count;
	}
	public function add_event(){
		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$post = $_POST;
		$data['program_id'] = $program_id;
		$data['title'] = $post['eventTitle'];
		$data['url_alias'] = $this->format_slug($post['eventTitle']);
		$data['description'] = $post['overview'];
		$data['when'] = date("Y-m-d H:i:s", strtotime($post['eventWhen']));
		$data['where'] = $post['eventWhere'];
		$data['volunteer_points'] = $post['eventPoints'];
		$data['create_date'] = date("Y-m-d H:i:s");
		$data['update_date'] = date("Y-m-d H:i:s");
		$data['status'] = 0;
		$data['user_id'] = $this->session->userdata('user_sess_id');

		$storeFolder2 = "uploads/events/";
		$tempFile = $_FILES['eventImage']['tmp_name'];                   
		$targetPath =  $storeFolder2 . "/"; 
		$file_name_new = $this->clean_str($_FILES['eventImage']['name']);
		$targetFile =  $targetPath. str_replace(" ", "_", strtolower($file_name_new)); 
		//$targetFile =  $targetPath. str_replace(" ", "_", strtolower($_FILES['eventImage']['name'])); 
		$data['image'] = $targetFile;

		$event_id = $this->Gmodel->save_data("tbl_program_events",$data);

		if (!empty($_FILES)) {
			if($_FILES['eventImage']['size'] > 0) { //10 MB (size is also in bytes)		        
			    move_uploaded_file($tempFile,$targetFile);			    
		    }
		   
		}

		if($event_id){
			$data['image'] = $targetFile;
		}

		$this->Gmodel->update_data("tbl_program_events",$data,"id",$event_id);
 
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function update(){
		$program_id = $this->uri->segment(2);
		$program_alias = $this->uri->segment(3);
		$event_id = $this->uri->segment(5);
		$event_alias = $this->uri->segment(6);

		$post = $_POST;

		$data['title'] = $post['eventTitle'];
		$data['url_alias'] = $this->format_slug($post['eventTitle']);
		$data['description'] = $post['overview'];
		$data['when'] = date("Y-m-d H:i:s", strtotime($post['eventWhen']));
		$data['where'] = $post['eventWhere'];
		$data['volunteer_points'] = $post['eventPoints'];
		$data['update_date'] = date("Y-m-d H:i:s");

		$storeFolder = "uploads/events/" ;

		if (!file_exists($storeFolder)) {
		    mkdir($storeFolder, 0777, true);
		}
		if (!empty($_FILES)) {
			if($_FILES['eventImage']['size'] > 0) { //10 MB (size is also in bytes)
		        $tempFile = $_FILES['eventImage']['tmp_name'];                   
			    $targetPath =  $storeFolder . "/";  
				$file_name_new = $this->clean_str($_FILES['eventImage']['name']);
				$targetFile =  $targetPath. str_replace(" ", "_", strtolower($file_name_new)); 
			    //$targetFile =  $targetPath. str_replace(" ", "_", strtolower($_FILES['eventImage']['name'])); 
			    move_uploaded_file($tempFile,$targetFile);
			    $data['image'] = $targetFile;
		    }
		   
		}


		$this->Gmodel->update_data("tbl_program_events",$data,"id",$event_id);

		redirect($_SERVER['HTTP_REFERER']);
	}

	function format_slug($title)
	{
	    $title = trim(strtolower($title));
	    $title = preg_replace('#[^a-z0-9\\/]#i', '-', $title);
	   	$title = str_replace('/', '-', $title);
	    return trim(preg_replace('/-+/', '-', $title), '-/');
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

	public function get_task()
	{
		$query = "SELECT task, id FROM tbl_program_event_task WHERE status = 1";
		$result_events= $this->db->query($query)->result_array();
		return $result_events;
	}

	public function get_volunteer_type()
	{
		$query = "SELECT name, id FROM tbl_badges WHERE status = 1";
		$result_events= $this->db->query($query)->result_array();
		return $result_events;
	}

	public function get_date()
	{
		// $query = "SELECT task,id FROM tbl_program_event_task WHERE status = 1";
		// $result_events= $this->db->query($query)->result_array();
		// return $result_events;
	}


	public function get_task_data(){
		$id = $this->input->post('id');
		$query = "SELECT * FROM tbl_program_event_task WHERE id = $id ";
		$result = $this->db->query($query)->result_array();
		$arr = array();
		$selected_badge = "SELECT tbl_badges.id,name FROM tbl_program_event_task_badge LEFT JOIN tbl_badges ON tbl_badges.id = tbl_program_event_task_badge.badge_id WHERE event_task_id = ".$result[0]['id'];
		$selected_badge_result = $this->db->query($selected_badge)->result_array();
		array_push($result[0],$selected_badge_result);
		echo json_encode($result);
	}
	public function delete_task_data(){
		$id = $this->input->post('id');
		$query = "UPDATE tbl_program_event_task SET status = '-2' WHERE id = $id";
		$result = $this->db->query($query);
		echo json_encode($result);
	}

}
