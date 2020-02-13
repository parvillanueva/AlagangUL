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
		$data['badges'] = $this->get_badges();
		$data['earn_badge'] = $this->get_earn_badge($event_id);
		$data['validate_testimonial'] = $this->validate_testimonial($event_id, $_SESSION['user_sess_id']);
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
	public function validate_testimonial($event_id, $user_id){
		$arr = array(
			'event_id' => $event_id,
			'user_id' => $user_id
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

	public function check_is_allowed($event_id,$date){
		$user_id = $this->session->userdata('user_sess_id');
		$data = "SELECT COUNT(pe.id) as count FROM tbl_program_events pe LEFT JOIN tbl_program_event_task_volunteers petv ON pe.id = petv.event_id WHERE pe.id !='" .$event_id."' AND pe.when LIKE '".$date."%' AND petv.user_id = ".$user_id;
		$result = $this->db->query($data)->result();
		return $result[0]->count;
	}

	public function manage()
	{

		$program_id = $this->uri->segment(2);
		$event_id = $this->uri->segment(5);

		// $arra
		$data['program_details'] = $this->get_program_details($program_id);
		$data['event_details'] = $this->get_event_details($event_id);
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
			tbl_badges.color
			FROM
			tbl_program_events
			INNER JOIN tbl_program_event_task ON tbl_program_events.id = tbl_program_event_task.event_id
			INNER JOIN tbl_program_event_task_badge ON tbl_program_event_task.id = tbl_program_event_task_badge.event_task_id
			INNER JOIN tbl_badges ON tbl_program_event_task_badge.badge_id = tbl_badges.id
			INNER JOIN tbl_program_event_task_volunteers ON tbl_program_event_task_volunteers.event_task_id = tbl_program_event_task.id
			WHERE
			tbl_program_events.id = '.$event_id.' AND
			tbl_program_event_task_volunteers.user_id = '.$user_id.'
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
		$query_joined_volunteer = "SELECT tbl_program_event_task_volunteers.*, CONCAT('" . base_url() . "','/',tbl_users.imagepath) as profile_image , CONCAT(tbl_users.first_name, ' ', tbl_users.last_name) as user FROM tbl_program_event_task_volunteers LEFT JOIN tbl_users ON tbl_users.id = tbl_program_event_task_volunteers.user_id WHERE event_id = " . $event_id . " GROUP BY tbl_users.id";
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
				"url_alias"				=> $value->url_alias,
				"image_thumbnail"		=> base_url() . $value->image_thumbnail,
				"id"					=> $value->id
			);
		}
		return $program;
	}

	public function get_event_details($event_id){
		$event_details = $this->Gmodel->get_query('tbl_program_events',"id = " . $event_id);
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
				"status"			=> $value->status,
				"url_alias"			=> $value->url_alias,
				"volunteer_points"	=> $value->volunteer_points,
				"is_admin"			=> ($value->user_id == $this->session->userdata('user_sess_id')) ? 1 : 0,
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
				"status"		=> 1,
		    	"create_date"	=> date("Y-m-d H:i:s")
		    );
		    echo $this->Gmodel->save_data('tbl_program_event_gallery', $data);
		}
	}

	public function get_gallery(){
		header('Content-Type: application/json');

		$event_id = $_GET['event_id'];
		$limit = $_GET['limit'];
		$gallery_query_count = "SELECT count(*) as total_data FROM tbl_program_event_gallery WHERE event_id = " . $event_id ." and status = '1'";
		$gallery_result_count = $this->db->query($gallery_query_count)->result();
		$gallery_query = "SELECT * FROM tbl_program_event_gallery WHERE event_id = " . $event_id . " and status = '1' LIMIT " . $limit;
		$gallery_result = $this->db->query($gallery_query)->result();
		$array_data = array(
			'result' => $gallery_result,
			'count' => $gallery_result_count[0]->total_data
		);
		echo json_encode($array_data);
	}
	
	public function get_testimonial(){
		header('Content-Type: application/json');
		
		$event_id = $_GET['event_id'];
		$limit = $_GET['limit'];
		$testimonial_query = "SELECT * FROM tbl_program_event_testimonials WHERE event_id = " . $event_id ;
		$testimonial_result = $this->db->query($testimonial_query)->result();
		$arr_testi = array();
		foreach($testimonial_result as $tes_loop){
			$array_data[] = array(
				'testimonial' 	=> $tes_loop->testimonial,
				'badge'			=> $this->get_volunteer_badge($event_id, $tes_loop->user_id),
				'picture' 		=> $this->profile_image($tes_loop->user_id),
				'date_posted'	=> date('F d, Y h:s A', strtotime($tes_loop->create_date))
			);
		}
		echo json_encode($array_data);
	}
	
	public function profile_image($user_id){
		$user_query = "SELECT * FROM tbl_users WHERE id = " . $user_id ;
		$user_result = $this->db->query($user_query)->result();
		$data_arr = array(
			'image_path' => $user_result[0]->imagepath,
			'email' => $user_result[0]->email_address,
			'name' => $user_result[0]->first_name.' '.$user_result[0]->last_name
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
	
	public function add_badges_details($task_id, $badges){
		foreach($badges as $bloop){
			$arr = array(
				'event_task_id' => $task_id,
				'badge_id' => $bloop
			);
			$sql_result = $this->Gmodel->save_data('tbl_program_event_task_badge', $arr);
		}
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
		$targetFile =  $targetPath. str_replace(" ", "_", strtolower($_FILES['eventImage']['name'])); 
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

		redirect(base_url("programs") . "/" . $program_id . "/" . $program_alias . "/event/" . $event_id . "/" . $data['url_alias']);
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
			    $targetFile =  $targetPath. str_replace(" ", "_", strtolower($_FILES['eventImage']['name'])); 
			    move_uploaded_file($tempFile,$targetFile);
			    $data['image'] = $targetFile;
		    }
		   
		}


		$this->Gmodel->update_data("tbl_program_events",$data,"id",$event_id);

		 redirect(base_url("programs") . "/" . $program_id . "/" . $program_alias . "/event/" . $event_id . "/" . $event_alias);
	}

	function format_slug($title)
	{
	    $title = trim(strtolower($title));
	    $title = preg_replace('#[^a-z0-9\\/]#i', '-', $title);
	    return trim(preg_replace('/-+/', '-', $title), '-/');
	}

	public function update_points(){

		$approval_id = $this->input->post('approval_id');
		$user_id 	 = $this->input->post('user_id');
		$points 	 = $this->input->post('points');
		$event_task_id 	 = $this->input->post('event_task_id');
		
		$update_status = "UPDATE tbl_users_points_approved SET status = 1 WHERE id = $approval_id";
		$update_status_result = $this->db->query($update_status);
		$update_status2 = "UPDATE tbl_users_points SET current_points = current_points + $points , total_points = total_points + $points  WHERE user_id = $user_id";
		$update_status_result2 = $this->db->query($update_status2);
		$update_status3 = "UPDATE tbl_users_badge SET  points = $points  WHERE user_id = $user_id AND event_task_id = $event_task_id";
		$update_status_result3 = $this->db->query($update_status3);
		return $update_status_result3;
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

}
