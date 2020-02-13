<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends GS_Controller {

	public function index()
	{
		$data['events'] = $this->get_details();
		$data['badges'] = $this->get_badges();
		$data['event_task'] = $this->get_event_tasks_all();
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
	public function view()
	{

		$program_id = $this->uri->segment(2);
		$event_id = $this->uri->segment(5);

		$data['program_details'] = $this->get_program_details($program_id);
		$data['event_details'] = $this->get_event_details($event_id);
		$data['event_task'] = $this->get_event_tasks($event_id);
		$data['event_volunteers'] = $this->get_volunteers($event_id);
		$data['badges'] = $this->get_badges();
		$data['validate_testimonial'] = $this->validate_testimonial($event_id, $_SESSION['user_sess_id']);

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
	
	public function submit_filter(){
		$date = $_POST['date']; 
		$date_explode = explode('-',$date);
		$date_from = date('Y-m-d', strtotime($date_explode[0]));
		$date_to = date('Y-m-d', strtotime($date_explode[1]));
		$arr = array(
			'search_box' => $_POST['search_box'],
			'types' => $_POST['types'],
			'task' => $_POST['task'],
			'date_from' => $date_from,
			'date_to' => $date_to
		);
		$data['events'] = $this->get_details($arr);
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		die();
		$this->load->view('site/events/event_list', $data);
	
	}
	
	public function filter_where($arr){
			$where_date = '';
		if($arr['date_from'] != '' && $arr['date_to'] != ''){
			$where_date = 'AND "'.$arr['date_from'].'" <= when AND when <= "'.$arr['date_to'].'"';
		}
			$where_search = '';
		if($arr['search_box'] != ''){
			$where_search = 'AND (title like "%'.$arr['search_box'].'%" OR url_alias like "%'.$arr['search_box'].'%" OR description like "%'.$arr['search_box'].'%" OR where like "%'.$arr['search_box'].'%")';
		}
			$where_task = '';
		if($arr['task'] != ''){
			$where_task = 'AND id = "'.$arr['task'].'"';
		}
		
			$where_type = '';
		if($arr['types'] != ''){
			$where_type = 'AND id = "'.$arr['task'].'"';
		}
		
		$result = array(
			'search_date' => $where_date .' '. $where_search,
			'task' => $where_task,
			'type' => $where_type
			
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
			$type_where = $result_where['type'];
		}
		$event_list = $this->Gmodel->get_query('tbl_program_events',"status = 1 ".$filter_where."");

		$events = array();
		foreach ($event_list as $key => $value) {

			$query_needed_volunteer = "SELECT SUM(required_volunteers) as count FROM tbl_program_event_task WHERE event_id = " . $value->id ." ".$task_where."";
			$needed_volunteer = $this->db->query($query_needed_volunteer)->result();

			$query_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $value->id;
			$joined_volunteer = $this->db->query($query_joined_volunteer)->result();


			$is_joined = false;
			$query_is_joined = "SELECT * FROM tbl_program_event_task_volunteers WHERE user_id = " . $this->session->userdata('user_sess_id') . " AND event_id = " . $value->id ." ".$type_where."";
			$result_is_joined = $this->db->query($query_is_joined)->result();
			if(count($result_is_joined) > 0){
				$is_joined = true;
			}
			
			$query_program_details = "SELECT id, image_thumbnail, url_alias FROM tbl_programs WHERE id = " . $value->program_id;
			$program_details = $this->db->query($query_program_details)->result();
			
			$events[] = array(
				"id"				=> $value->id,
				"program_details"   => $program_details[0],
				//"link"				=> $event_page_url,
				"title"				=> $value->title,
				"image"				=> base_url() . $value->image,
				"description"		=> $value->description,
				"when"				=> $value->when,
				"where"				=> $value->where,
				"status"				=> $value->status,
				"volunteer_points"	=> $value->volunteer_points,
				"is_admin"			=> ($value->user_id == $this->session->userdata('user_sess_id')) ? true : false,
				"is_joined"			=> $is_joined,
				"required_volunteer"=> ($needed_volunteer[0]->count != "") ? $needed_volunteer[0]->count : 0,
				"joined_volunteers"	=> ($joined_volunteer[0]->count != "") ? $joined_volunteer[0]->count : 0,
			);
		}

		return $events;
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
	
	public function get_event_tasks_all(){
		$sql = "Select * From tbl_program_event_task";
		$result = $this->db->query($sql)->result();
		return $result;
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

			$query_joined_volunteer = "SELECT COUNT(id) as count FROM tbl_program_event_task_volunteers WHERE event_id = " . $event_id . " AND event_task_id = " . $value->id;
			$joined_volunteer = $this->db->query($query_joined_volunteer)->result();

			$event_task[] = array(
				"id"					=> $value->id,
				"task"					=> $value->task,
				"qualification"			=> $value->qualification,
				"required_volunteers"	=> $value->required_volunteers,
				"joined_volunteers"		=> $joined_volunteer[0]->count,
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
				'testimonial' => $tes_loop->testimonial,
				'picture' => $this->profile_image($tes_loop->user_id),
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

	function format_slug($title)
	{
	    $title = trim(strtolower($title));
	    $title = preg_replace('#[^a-z0-9\\/]#i', '-', $title);
	    return trim(preg_replace('/-+/', '-', $title), '-/');
	}

}
