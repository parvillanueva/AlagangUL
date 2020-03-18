<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function registered_volunteered()
	{
		$data['data_set']['emp_volunteer_as_of'] = $this->employees_volunteer_as_of();
		$data['data_set']['registered_as_of'] = $this->count_registered_as_of();	
		$data['data_set']['registered'] = $this->count_registered();
		$data['data_set']['emp_volunteer'] = $this->employees_volunteer();
		$data['meta'] = array(
			"title"         =>  "Registered Volunteered",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		$data['active_menu'] = "Registered Volunteered";
		$data['module'] = 'registered_volunteered';
		$data['content_view'] = "site/report/registered_volunteered";
		$data["content"] = "site/report/template_report";
		$this->load->view("site/layout/template",$data);
	}
	
	public function volunteered_division()
	{
		$data['data_set']['vol_div']['vol_division'] = $this->vol_division_data();
		$data['data_set']['division'] = $this->division_list_info();
		$data['data_set']['total_data'] = $this->vol_division_data_count();
		$data['meta'] = array(
			"title"         =>  "Volunteered Division",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		$data['active_menu'] = "Volunteered Division";
		$data['module'] = 'volunteered_division';
		$data["content_view"] = "site/report/volunteered_division";
		$data["content"] = "site/report/template_report";
		$this->load->view("site/layout/template",$data);
	}
	
	public function volunteered_program()
	{
		$data['data_set']['vol_prog']['vol_prog_list'] = $this->volunteered_program_list();
		$data['data_set']['program'] = $this->program_list();
		$data['data_set']['total_data'] = $this->volunteered_program_list_count();
		$data['meta'] = array(
			"title"         =>  "Volunteered Program",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		$data['active_menu'] = "Volunteered Program";
		$data['module'] = 'volunteered_program';
		$data["content_view"] = "site/report/volunteered_program";
		$data["content"] = "site/report/template_report";
		$this->load->view("site/layout/template",$data);
	}
	
	public function volunteer_type()
	{
		$data['data_set']['graph'] = $this->graph_data($this->vol_type_listing());
		$data['data_set']['event_task'] = $this->program_list();
		
		$data['data_set']['type_info']['type_list'] = $this->vol_type_listing();
		$data['data_set']['total_data'] = $this->vol_type_listing_count();
		$data['meta'] = array(
			"title"         =>  "Volunteered Type",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		$data['active_menu'] = "Volunteered Type";
		$data['module'] = 'volunteer_type';
		$data["content_view"] = "site/report/volunteer_type";
		$data["content"] = "site/report/template_report";
		$this->load->view("site/layout/template",$data);
	}
	
	public function registered()
	{
		$data['data_set']['division'] = $this->division_list_info();
		$data['data_set']['user_info'] = $this->user_list_info();
		$data['data_set']['total_data'] = $this->user_list_info_count();
		$data['meta'] = array(
			"title"         =>  "Registered",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		$data['active_menu'] = "Registered";
		$data['module'] = 'registered';
		$data["content_view"] = "site/report/registered";
		$data["content"] = "site/report/template_report";
		$this->load->view("site/layout/template",$data);
	}
	
	public function volunteered()
	{
		$data['data_set']['type_vol']['type_vol_list'] = $this->volunteered_list(); 
		$data['data_set']['division'] = $this->division_list_info();
		$data['data_set']['program'] = $this->program_list();
		$data['data_set']['event_task'] = $this->get_event_tasks_all();
		$data['data_set']['total_data'] = $this->volunteered_list_count();
		$data['meta'] = array(
			"title"         =>  "Volunteered",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		$data['active_menu'] = "Volunteered";
		$data['module'] = 'volunteered';
		$data["content_view"] = "site/report/volunteered";
		$data["content"] = "site/report/template_report";
		$this->load->view("site/layout/template",$data);
	}
	
	public function division_list_info(){
		$data = "Select * From tbl_division where status = '1'";
		$result = $this->db->query($data)->result();
		return $result;
	}
	
	public function user_list_info(){
		$data = "Select * From tbl_users LEFT JOIN tbl_division ON tbl_users.division=tbl_division.id where tbl_users.status <> -2 limit 10";
		$result = $this->db->query($data)->result();
		return $result;
	}

	public function user_list_info_count(){
		$data = "Select * From tbl_users LEFT JOIN tbl_division ON tbl_users.division=tbl_division.id where tbl_users.status <> -2";
		$result = $this->db->query($data)->result();
		return count($result);
	}
	
	public function user_search(){
		$data['user_info'] = $this->data_search($_POST);
		$this->load->view('site/report/registered_listview', $data);
	}
	
	public function data_search($post){
		$where = $this->user_where($post);
		$limit = trim($post['filter_limit']);
		$data = "Select * From tbl_users LEFT JOIN tbl_division ON tbl_users.division=tbl_division.id where tbl_users.status <> -2 ".$where." limit ".$limit."";
		$result = $this->db->query($data)->result();
		return $result;
	}
	
	public function user_where($post){
		$search = '';
		if($post['search'] != ''){
			$search = " AND (last_name like '%".$post['search']."%' OR first_name like '%".$post['search']."%' OR email_address like '%".$post['search']."%')";
		}
		
		$division = '';
		if($post['division'] != ''){
			$division = "AND division = '".$post['division']."'";
		}
		
		$date = '';
		if($post['date'] != ''){
			$date_explode = explode('-', $post['date']);
			$date_from = date('Y-m-d', strtotime($date_explode[0]));
			$date_to = date('Y-m-d', strtotime($date_explode[1]));
			$date = "AND tbl_users.create_date between '".$date_from."' and '".$date_to."'";
		}
		
		return $search .' '. $division.' '.$date;
	}
	
	public function count_registered(){
		$data = "Select count(*) as total From tbl_users where tbl_users.status <> -2";
		$result = $this->db->query($data)->result();
		return $result[0]->total;
	}
	
	public function employees_volunteer(){
		$data = "SELECT * FROM tbl_program_event_task_volunteers WHERE `status` >= 0 GROUP BY user_id";
		$result = $this->db->query($data)->result();
		return count($result);
	}
	
	public function count_registered_as_of(){
		$data = "Select count(*) as total From tbl_users where tbl_users.status <> -2 AND create_date >= '".date('Y-m').'-01'."' AND create_date <= '".date('Y-m').'-31'."'";
		$result = $this->db->query($data)->result();
		return $result[0]->total;
	}
	
	public function employees_volunteer_as_of(){
		$data = "SELECT * FROM tbl_program_event_task_volunteers WHERE `status` >= 0 AND date_volunteer >= '".date('Y-m').'-01'."' AND date_volunteer <= '".date('Y-m').'-31'."' GROUP BY user_id";
		$result = $this->db->query($data)->result();
		return count($result);
	}
	
	public function vol_division_data(){
		$data = "Select * From tbl_division where tbl_division.status = 1 limit 10";
		$result = $this->db->query($data)->result();
			$arr_result = array();
		foreach($result as $rloop){
			$arr_result[] = array(
				'registered' => $this->user_division($rloop->id),
				'volunteered' => $this->volunteered_division_set($rloop->id),
				'division_name' => $rloop->name,
				'division_id' => $rloop->id,
			);
		}
		return $arr_result;
	}
	
	public function vol_division_data_count(){
		$data = "Select * From tbl_division where tbl_division.status = 1";
		$result = $this->db->query($data)->result();
		$arr_result = array();
		foreach($result as $rloop){
			$arr_result[] = array(
				'registered' => $this->user_division($rloop->id),
				'volunteered' => $this->volunteered_division_set($rloop->id),
				'division_name' => $rloop->name,
				'division_id' => $rloop->id,
			);
		}
		return count($arr_result);
	}
	
	public function user_division($id){
		$data = "Select * From tbl_users where division = '".$id."' AND tbl_users.status <> -2";
		$result = $this->db->query($data)->result();
		return count($result);
	}
	
	public function volunteered_division_set($id){
		$data = "Select * From tbl_users INNER JOIN tbl_program_event_task_volunteers tbltv ON tbl_users.id=tbltv.user_id where tbl_users.division = '".$id."' AND tbl_users.status <> -2";
		$result = $this->db->query($data)->result();
		return count($result);
	}
	
	public function division_search(){
		$data['vol_division'] = $this->vol_division_data_filter($_POST['division'], $_POST['limit']);
		$this->load->view("site/report/vol_division_listview",$data);
	}
	
	public function vol_division_data_filter($division, $limit){
		$division_where = '';
		if($division != ''){
			$division_where = "AND id='".$division."'";
		}
		$data = "Select * From tbl_division where tbl_division.status = 1 ".$division_where." limit ".$limit."";
		$result = $this->db->query($data)->result();
			$arr_result = array();
		foreach($result as $rloop){
			$arr_result[] = array(
				'registered' => $this->user_division($rloop->id),
				'volunteered' => $this->volunteered_division_set($rloop->id),
				'division_name' => $rloop->name,
				'division_id' => $rloop->id,
			);
		}
		return $arr_result;
	}
	
	public function volunteered_program_list(){
		$data = "Select * From tbl_programs where tbl_programs.status = '1' limit 10";
		$result = $this->db->query($data)->result();
		$arr_result = array();
		foreach($result as $rloop){
			$arr_result[] = array(
				'program_name' => $rloop->name,
				'program_id' => $rloop->id,
				'needed' => $this->volunteered_program_needed($rloop->id),
				'volunteered' => $this->volunteered_prog($rloop->id),
				'difference' => $this->volunteered_program_needed($rloop->id) - $this->volunteered_prog($rloop->id),
				
			);
		}
		return $arr_result;
	}

	public function volunteered_program_list_count(){
		$data = "Select * From tbl_programs where tbl_programs.status = '1' limit 10";
		$result = $this->db->query($data)->result();
		$arr_result = array();
		foreach($result as $rloop){
			$arr_result[] = array(
				'program_name' => $rloop->name,
				'program_id' => $rloop->id,
				'needed' => $this->volunteered_program_needed($rloop->id),
				'volunteered' => $this->volunteered_prog($rloop->id),
				'difference' => $this->volunteered_program_needed($rloop->id) - $this->volunteered_prog($rloop->id),
				
			);
		}
		return count($arr_result);
	}
	
	public function volunteered_program_needed($program_id){
		$data = "Select * From tbl_program_events INNER JOIN tbl_program_event_task ON tbl_program_events.id=tbl_program_event_task.event_id where tbl_program_events.status = '1' AND program_id='".$program_id."'";
		$result = $this->db->query($data)->result();
		return count($result);
	}
	
	public function volunteered_prog($program_id){
		$data = "Select * From tbl_program_event_task_volunteers tblpetv where tblpetv.status = '1' AND  tblpetv.program_id='".$program_id."'";
		$result = $this->db->query($data)->result();
		return count($result);
	}
	
	public function program_list(){
		$data = "Select * From tbl_programs where tbl_programs.status = '1'";
		$result = $this->db->query($data)->result();
		return $result;
	}
	
	public function vol_program_filter(){
		$data['vol_prog_list'] = $this->vol_program_data_filter($_POST['program'], $_POST['limit']);
		$this->load->view("site/report/volunteered_pro_listview",$data);
	}
	
	public function vol_program_data_filter($program, $limit){
		$program_filter = "AND id='".$program."'";
		if(empty($program)){
			$program_filter = '';
		}
		$data = "Select * From tbl_programs where tbl_programs.status = '1' ".$program_filter."  limit ".$limit."";
		$result = $this->db->query($data)->result();
		$arr_result = array();
		foreach($result as $rloop){
			$arr_result[] = array(
				'program_name' => $rloop->name,
				'program_id' => $rloop->id,
				'needed' => $this->volunteered_program_needed($rloop->id),
				'volunteered' => $this->volunteered_prog($rloop->id),
				'difference' => $this->volunteered_program_needed($rloop->id) - $this->volunteered_prog($rloop->id),
				
			);
		}
		return $arr_result;
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
		$sql = "Select task From tbl_program_event_task tblpret INNER JOIN tbl_program_event_task_badge tblpetb ON tblpret.id=tblpetb.event_task_id RIGHT JOIN tbl_program_events tblpe ON tblpe.id = tblpret.event_id WHERE tblpetb.badge_id='".$badgeId."' AND tblpe.status = 1 GROUP BY tblpret.task";
		$result_badges = $this->db->query($sql)->result();
		return $result_badges;
	}
	
	public function vol_type_listing(){
		$sql = "select a.name as program_name, e.name as badge_name, count(b.user_id) as total
				from tbl_programs as a 
				inner join tbl_program_event_task_volunteers as b on b.program_id = a.id
				inner join tbl_program_event_task as c on b.event_task_id = c.id
				inner join tbl_program_event_task_badge as d on c.id = d.event_task_id
				inner join tbl_badges as e on d.badge_id = e.id
				group by a.name, e.name";
		$sql_result = $this->db->query($sql)->result();
		$sql_badge = "SELECT id, name, icon, color, image FROM tbl_badges WHERE status='1'";
		$result_badge = $this->db->query($sql_badge)->result();
		$badge_array = array();
		$badge_array_head = array();
		foreach($result_badge as $key => $badges){
			$badge_array[$badges->name] = '';
			$badge_array_head[$badges->name] = array(
				'icon' => $badges->icon,
				'color' => $badges->color,
				'image' => $badges->image,
				'total' => $this->total_badge($badges->id),
			);
			
		}

		$arr = array();
		$head = array();
		$program_name = '';

		foreach($sql_result as $key => $loop){
			if($program_name != $loop->program_name){
				$program_name = $loop->program_name;
				$head[] = $badge_array_head;
				$arr[$program_name] = $badge_array;
				$arr[$program_name][$loop->badge_name] = $loop->total;
			}
			else{
				$head[] = $badge_array_head;
				$arr[$program_name][$loop->badge_name] = $loop->total;
			}
		}
		$data_final = array(
			'data' => $arr,
			'header' => $head
		);
		return $data_final;
	}

	public function vol_type_listing_count(){
		$sql = "select a.name as program_name, e.name as badge_name, count(b.user_id) as total
				from tbl_programs as a 
				inner join tbl_program_event_task_volunteers as b on b.program_id = a.id
				inner join tbl_program_event_task as c on b.event_task_id = c.id
				inner join tbl_program_event_task_badge as d on c.id = d.event_task_id
				inner join tbl_badges as e on d.badge_id = e.id
				group by a.name, e.name";
		$sql_result = $this->db->query($sql)->result();
		$sql_badge = "SELECT id, name, icon, color, image FROM tbl_badges WHERE status='1'";
		$result_badge = $this->db->query($sql_badge)->result();
		$badge_array = array();
		$badge_array_head = array();
		foreach($result_badge as $key => $badges){
			$badge_array[$badges->name] = '';
			$badge_array_head[$badges->name] = array(
				'icon' => $badges->icon,
				'color' => $badges->color,
				'image' => $badges->image,
				'total' => $this->total_badge($badges->id),
			);
			
		}

		$arr = array();
		$head = array();
		$program_name = '';

		foreach($sql_result as $key => $loop){
			if($program_name != $loop->program_name){
				$program_name = $loop->program_name;
				$head[] = $badge_array_head;
				$arr[$program_name] = $badge_array;
				$arr[$program_name][$loop->badge_name] = $loop->total;
			}
			else{
				$head[] = $badge_array_head;
				$arr[$program_name][$loop->badge_name] = $loop->total;
			}
		}
		$data_final = array(
			'data' => $arr,
			'header' => $head
		);
		return count($data_final);
	}
	
	public function total_badge($id){
		$sql_badge = "SELECT * FROM tbl_program_event_task_badge WHERE badge_id='".$id."'";
		$result_badge = $this->db->query($sql_badge)->result();
		return count($result_badge);
	}
	
	public function badge_count_data($id){
		$sql = "Select * From tbl_program_events tblpe
				INNER JOIN tbl_program_event_task tblpet ON tblpe.id=tblpet.event_id
				INNER JOIN tbl_program_event_task_badge tblpetb ON tblpet.id=tblpetb.event_task_id where tblpe.program_id='".$id."'";
		$sql_result = $this->db->query($sql)->result();
		return count($sql_result);
	}
	
	public function volunteered_list(){
		$sql = "Select
				tbl_users.id as user_id,
				tbl_users.first_name as first_name,
				tbl_users.last_name as last_name,
				tbl_users.email_address as email_address,
				tbl_users.work_number as work_number,
				tbl_division.name as division,
				tbl_programs.name as name,
				tbl_program_events.title as title,
				tbl_program_event_task.task as task,
				tbl_program_event_task_volunteers.date_volunteer as date_volunteer
				From tbl_users 
				INNER JOIN tbl_division ON tbl_users.division=tbl_division.id
				INNER JOIN tbl_program_event_task_volunteers ON tbl_users.id=tbl_program_event_task_volunteers.user_id
				INNER JOIN tbl_programs ON tbl_programs.id=tbl_program_event_task_volunteers.program_id
				INNER JOIN tbl_program_events ON tbl_program_events.program_id=tbl_programs.id
				INNER JOIN tbl_program_event_task ON tbl_program_event_task.event_id=tbl_program_events.id WHERE tbl_users.status = '1' AND tbl_programs.status = '1' AND tbl_program_events.status = '1' AND tbl_program_event_task_volunteers.status = '1' limit 10";
		$sql_result = $this->db->query($sql)->result();
			$arr = array();
		foreach($sql_result as $loop){
			$arr[] = array(
				'profile_name' => $loop->first_name.' '.$loop->last_name,
				'email'=> $loop->email_address,
				'work_number' => $loop->work_number,
				'division' => $loop->division,
				'program_name' =>  $loop->name,
				'event_name' => $loop->title,
				'task_name' => $loop->task,
				'date_volunteer' => $loop->date_volunteer
			);
		}
			return $arr;
	}

	public function volunteered_list_count(){
		$sql = "Select
				tbl_users.id as user_id,
				tbl_users.first_name as first_name,
				tbl_users.last_name as last_name,
				tbl_users.email_address as email_address,
				tbl_users.work_number as work_number,
				tbl_division.name as division,
				tbl_programs.name as name,
				tbl_program_events.title as title,
				tbl_program_event_task.task as task,
				tbl_program_event_task_volunteers.date_volunteer as date_volunteer
				From tbl_users 
				INNER JOIN tbl_division ON tbl_users.division=tbl_division.id
				INNER JOIN tbl_program_event_task_volunteers ON tbl_users.id=tbl_program_event_task_volunteers.user_id
				INNER JOIN tbl_programs ON tbl_programs.id=tbl_program_event_task_volunteers.program_id
				INNER JOIN tbl_program_events ON tbl_program_events.program_id=tbl_programs.id
				INNER JOIN tbl_program_event_task ON tbl_program_event_task.event_id=tbl_program_events.id WHERE tbl_users.status = '1' AND tbl_programs.status = '1' AND tbl_program_events.status = '1' AND tbl_program_event_task_volunteers.status = '1'";
		$sql_result = $this->db->query($sql)->result();
			$arr = array();
		foreach($sql_result as $loop){
			$arr[] = array(
				'profile_name' => $loop->first_name.' '.$loop->last_name,
				'email'=> $loop->email_address,
				'work_number' => $loop->work_number,
				'division' => $loop->division,
				'program_name' =>  $loop->name,
				'event_name' => $loop->title,
				'task_name' => $loop->task,
				'date_volunteer' => $loop->date_volunteer
			);
		}
			return count($arr);
	}
	
	public function graph_data($data){
		$arr_keys = array_keys($data['data']);
		$label = array();
		foreach($data['data'] as $dkey => $dloop){
				$data_arr = array();
			$label[] = $dkey;
			foreach($dloop as $ddkey => $ddloop){
				$data_arr[] = $this->graph_label($ddkey, $data['data'], $data['header'][0]);
				/* if($arr_keys[0] == $dkey){
					$label[] = $ddkey;
				} */
			}
		}
		//$label_set = rtrim($label, ',');
		$arr = array(
			'label' => $label,
			'data' => $data_arr,
		);
		return $arr;
	}
	
	public function graph_label($label, $arr, $header){
			$arr_set = array();
			$arr_color = '';
		foreach($arr as $key => $loop){
			foreach($loop as $dkey => $dloop){
				$value = ($dloop == '') ? '0' : $dloop;
				if($label == $dkey){
					$arr_set[] = $value;
				}
			}
		}
		
		foreach($header as $hkey => $hloop){
			if($label == $hkey){
				$arr_color = $hloop['color'];
			}
		}
		
		$arr_set_final = array(
			'label' => $label,
			'data' => $arr_set,
			'backgroundColor' => $arr_color,
		);
		return $arr_set_final;
	}
	
	public function event_list(){
		$sql_event = "SELECT * FROM tbl_program_events WHERE status='1'";
		$result_badge = $this->db->query($sql_event)->result();
		return $result_badge;
	}
	
	public function volunteered_filter(){
		$where_filter = $this->volunteered_filter_where($_POST);
		$sql = "Select
				tbl_users.id as user_id,
				tbl_users.first_name as first_name,
				tbl_users.last_name as last_name,
				tbl_users.email_address as email_address,
				tbl_users.work_number as work_number,
				tbl_division.name as division,
				tbl_programs.name as name,
				tbl_program_events.title as title,
				tbl_program_event_task.task as task,
				tbl_program_event_task_volunteers.date_volunteer as date_volunteer
				From tbl_users 
				INNER JOIN tbl_division ON tbl_users.division=tbl_division.id
				INNER JOIN tbl_program_event_task_volunteers ON tbl_users.id=tbl_program_event_task_volunteers.user_id
				INNER JOIN tbl_programs ON tbl_programs.id=tbl_program_event_task_volunteers.program_id
				INNER JOIN tbl_program_events ON tbl_program_events.program_id=tbl_programs.id
				INNER JOIN tbl_program_event_task ON tbl_program_event_task.event_id=tbl_program_events.id WHERE tbl_users.status = '1' ".$where_filter." AND tbl_programs.status = '1' AND tbl_program_events.status = '1' AND tbl_program_event_task_volunteers.status = '1' limit ".$_POST['limit']."";
		$sql_result = $this->db->query($sql)->result();
			$arr = array();
		foreach($sql_result as $loop){
			$arr[] = array(
				'profile_name' => $loop->first_name.' '.$loop->last_name,
				'email'=> $loop->email_address,
				'work_number' => $loop->work_number,
				'division' => $loop->division,
				'program_name' =>  $loop->name,
				'event_name' => $loop->title,
				'task_name' => $loop->task,
				'date_volunteer' => $loop->date_volunteer
			);
		}
		
		$data['type_vol_list'] = $arr;
			$this->load->view('site/report/volunteered_listview', $data);
	}
	
	public function volunteered_filter_where($post){
		$search = '';
		if($post['search'] != ''){
			$search = "AND (tbl_users.email_address LIKE '%".$post['search']."%' OR tbl_users.work_number LIKE '%".$post['search']."%')";
		}
		
		$program = '';
		if($post['program'] != ''){
			$program = "AND tbl_programs.id = '".$post['program']."'";
		}
		
		$event = '';
		if($post['event'] != ''){
			$event = "AND tbl_program_events.title = '".$post['event']."'";
		}
		
		$division = '';
		if($post['division'] != ''){
			$event = "AND tbl_division.id = '".$post['division']."'";
		}
		
		$date = '';
		if($post['date'] != ''){
			$date_explode = explode('-', $post['date']);
			$date_from = date('Y-m-d', strtotime($date_explode[0]));
			$date_to = date('Y-m-d', strtotime($date_explode[1]));
			$date = "AND tbl_program_event_task_volunteers.date_volunteer >= '".$date_from."' AND tbl_program_event_task_volunteers.date_volunteer <= '".$date_to."'";
		}
		
		return $search.' '.$program.' '.$event.' '.$division.' '.$date;
	}
	
	public function volunteer_type_report(){
		$type_info['type_list'] = $this->volunteer_type_result($_POST);
		$this->load->view('site/report/volunteer_type_listview', $type_info);
	}
	
	public function volunteer_type_result($post){
		$sql = "select a.id as id, a.name as program_name, e.name as badge_name, count(b.user_id) as total
				from tbl_programs as a 
				inner join tbl_program_event_task_volunteers as b on b.program_id = a.id
				inner join tbl_program_event_task as c on b.event_task_id = c.id
				inner join tbl_program_event_task_badge as d on c.id = d.event_task_id
				inner join tbl_badges as e on d.badge_id = e.id
				where a.id='".$post['task_val']."'
				group by a.name, e.name limit ".$post['filter']."";
		$sql_result = $this->db->query($sql)->result();
		$sql_badge = "SELECT id, name, icon, color, image FROM tbl_badges WHERE status='1'";
		$result_badge = $this->db->query($sql_badge)->result();
		$badge_array = array();
		$badge_array_head = array();
		foreach($result_badge as $key => $badges){
			$badge_array[$badges->name] = '';
			$badge_array_head[$badges->name] = array(
				'icon' => $badges->icon,
				'color' => $badges->color,
				'image' => $badges->image,
				'total' => $this->total_badge($badges->id),
			);
			
		}

		$arr = array();
		$head = array();
		$program_name = '';

		foreach($sql_result as $key => $loop){
			if($program_name != $loop->program_name){
				$program_name = $loop->program_name;
				$head[] = $badge_array_head;
				$arr[$program_name] = $badge_array;
				$arr[$program_name][$loop->badge_name] = $loop->total;
			}
			else{
				$head[] = $badge_array_head;
				$arr[$program_name][$loop->badge_name] = $loop->total;
			}
		}
		$data_final = array(
			'data' => $arr,
			'header' => $head
		);
		return $data_final;
	}
	
	public function extract_excel_report(){
		$sql_program_event = "SELECT
		tbl_programs.`name` AS ProgramName,
		tbl_program_events.title AS EventName,
		DATE(tbl_program_events.`when`) AS EventDate,
		CONCAT(tbl_program_events.venue, ' ', tbl_program_events.city) AS EventVenue,
		tbl_program_event_task.task AS Task,
		(SELECT GROUP_CONCAT(b.name) FROM tbl_badges b LEFT JOIN tbl_program_event_task_badge petb ON petb.badge_id = b.id WHERE petb.event_task_id = tbl_program_event_task.id) as Type,
		tbl_program_event_task.required_volunteers as `vol_required`,
		(Select Count(*) From tbl_program_event_task_volunteers where event_task_id=tbl_program_event_task.id) as `vol_joined`
		FROM
		tbl_program_event_task_volunteers
		INNER JOIN tbl_programs ON tbl_program_event_task_volunteers.program_id = tbl_programs.id
		INNER JOIN tbl_program_events ON tbl_program_event_task_volunteers.event_id = tbl_program_events.id
		INNER JOIN tbl_program_event_task ON tbl_program_event_task_volunteers.event_task_id = tbl_program_event_task.id
		WHERE tbl_program_events.`status` = '1'
		ORDER BY 
		tbl_programs.id ASC";
		
		
		$sql_program = "SELECT
		tbl_programs.`name` AS ProgramName,
		tbl_program_events.title AS EventName,
		DATE(tbl_program_events.`when`) AS EventDate,
		CONCAT(tbl_program_events.venue, ' ', tbl_program_events.city) AS EventVenue,
		tbl_program_event_task.task AS Task,
		CONCAT(tbl_users.first_name, ' ' , tbl_users.last_name) AS EmployeeName,
		tbl_users.email_address AS EmailAddress,
		tbl_users.work_number AS WorkNumber,
		(SELECT GROUP_CONCAT(b.name) FROM tbl_badges b LEFT JOIN tbl_program_event_task_badge petb ON petb.badge_id = b.id WHERE petb.event_task_id = tbl_program_event_task.id) as Type,
		tbl_program_event_task.required_volunteers as `vol_required`,
		(Select Count(*) From tbl_program_event_task_volunteers where event_task_id=tbl_program_event_task.id) as `vol_joined`
		FROM
		tbl_program_event_task_volunteers
		INNER JOIN tbl_programs ON tbl_program_event_task_volunteers.program_id = tbl_programs.id
		INNER JOIN tbl_program_events ON tbl_program_event_task_volunteers.event_id = tbl_program_events.id
		INNER JOIN tbl_program_event_task ON tbl_program_event_task_volunteers.event_task_id = tbl_program_event_task.id
		INNER JOIN tbl_users ON tbl_program_event_task_volunteers.user_id = tbl_users.id
		WHERE tbl_program_events.`status` = '1'
		ORDER BY 
		tbl_programs.id ASC";
		
		$sql_result = $this->db->query($sql_program_event)->result();
		
		$sql_result2 = $this->db->query($sql_program)->result();
		
		$this->load->library("Excel");
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$worksheet = $objPHPExcel->getActiveSheet();
		$objPHPExcel->getActiveSheet()->setTitle('Volunteer Count Summary');
		$worksheet2 = $objPHPExcel->createSheet(1);
		$worksheet2->setTitle("Volunteer Details");
		$style_head = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	            'wrap' => true
	        ),
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'FFFF00')
	        ),
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN,
	                'color' => array('rgb' => '000000')
	            )
	        ),
	        'font'  => array(
		        'bold'  => true
		    )
	    );
		$style_title = array(
	        'font'  => array(
		        'bold'  => true
		    )
	    );
	    $style_body = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	            'wrap' => true
	        )
	    );
		
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'RRGGBB')
	        ),
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN,
	                'color' => array('rgb' => '000000')
	            )
	        ),
	        'font'  => array(
		        'bold'  => true
		    )
		);


		//header
		$worksheet->SetCellValueByColumnAndRow(0, 2, "Program Name");
		$worksheet->SetCellValueByColumnAndRow(1, 2, "Event Name");
		$worksheet->SetCellValueByColumnAndRow(2, 2, "Event Date");
		$worksheet->SetCellValueByColumnAndRow(3, 2, "Event Venue");
		$worksheet->SetCellValueByColumnAndRow(4, 2, "Task Type");
		$worksheet->SetCellValueByColumnAndRow(5, 2, "Task");
		$worksheet->SetCellValueByColumnAndRow(6, 2, "# of Volunteers - Required");
		$worksheet->SetCellValueByColumnAndRow(7, 2, "# of Volunteers - Joined");
		$worksheet->getColumnDimension('A')->setAutoSize(TRUE);
		$worksheet->getColumnDimension('B')->setWidth(25);
		$worksheet->getColumnDimension('C')->setWidth(25);
		$worksheet->getColumnDimension('D')->setWidth(25);
		$worksheet->getColumnDimension('E')->setWidth(25);
		$worksheet->getColumnDimension('F')->setWidth(25);
		$worksheet->getColumnDimension('G')->setWidth(25);
		$worksheet->getColumnDimension('H')->setWidth(25);
		$worksheet->getStyle("A2:H2")->applyFromArray($style_head);
		

		$colstart = 3;
		foreach ($sql_result as $key => $value) {
			//$sessionName = wordwrap($value['SessionName'], 50);
			$worksheet->SetCellValueByColumnAndRow(0, $colstart, $value->ProgramName);
			$worksheet->SetCellValueByColumnAndRow(1, $colstart, $value->EventName);
			$worksheet->SetCellValueByColumnAndRow(2, $colstart, $value->EventDate);
			$worksheet->SetCellValueByColumnAndRow(3, $colstart, $value->EventVenue);
			$worksheet->SetCellValueByColumnAndRow(4, $colstart, $value->Task);
			$worksheet->SetCellValueByColumnAndRow(5, $colstart, $value->Type);
			$worksheet->SetCellValueByColumnAndRow(6, $colstart, $value->vol_required);
			$worksheet->SetCellValueByColumnAndRow(7, $colstart, $value->vol_joined);
			
			$worksheet->getCellByColumnAndRow(0,$colstart)->getStyle('B1:E999')->getAlignment()->setWrapText(true); 
			$worksheet->getCellByColumnAndRow(1,$colstart)->getStyle()->applyFromArray($style_body);
			$worksheet->getCellByColumnAndRow(2,$colstart)->getStyle()->applyFromArray($style_body);
			$worksheet->getCellByColumnAndRow(3,$colstart)->getStyle()->applyFromArray($style_body);
			$worksheet->getCellByColumnAndRow(4,$colstart)->getStyle()->applyFromArray($style_body);
			$worksheet->getCellByColumnAndRow(5,$colstart)->getStyle()->applyFromArray($style_body);
			$worksheet->getCellByColumnAndRow(6,$colstart)->getStyle()->applyFromArray($style_body);
			$worksheet->getCellByColumnAndRow(7,$colstart)->getStyle()->applyFromArray($style_body);
			$colstart++;
		}
		
		//////////////////sheet 2/////////////
		$worksheet2->SetCellValueByColumnAndRow(0, 2, "Program Name");
		$worksheet2->SetCellValueByColumnAndRow(1, 2, "Event Name");
		$worksheet2->SetCellValueByColumnAndRow(2, 2, "Event Date");
		$worksheet2->SetCellValueByColumnAndRow(3, 2, "Event Venue");
		$worksheet2->SetCellValueByColumnAndRow(4, 2, "Task Type");
		$worksheet2->SetCellValueByColumnAndRow(5, 2, "Task");
		$worksheet2->SetCellValueByColumnAndRow(6, 2, "# of Volunteers - Required");
		$worksheet2->SetCellValueByColumnAndRow(7, 2, "# of Volunteers - Joined");
		$worksheet2->SetCellValueByColumnAndRow(8, 2, "Volunteer Name");
		$worksheet2->SetCellValueByColumnAndRow(9, 2, "Email Address");
		$worksheet2->SetCellValueByColumnAndRow(10, 2, "Mobile Number");
		$worksheet2->getStyle("I1:K1")->applyFromArray($style);
		$worksheet2->mergeCells("I1:K1");
		$worksheet2->SetCellValueByColumnAndRow(8, 1, "VOLUNTEER DETAILS");
		$worksheet2->getColumnDimension('A')->setAutoSize(TRUE);
		$worksheet2->getColumnDimension('B')->setWidth(25);
		$worksheet2->getColumnDimension('C')->setWidth(25);
		$worksheet2->getColumnDimension('D')->setWidth(25);
		$worksheet2->getColumnDimension('E')->setWidth(25);
		$worksheet2->getColumnDimension('F')->setWidth(25);
		$worksheet2->getColumnDimension('G')->setWidth(25);
		$worksheet2->getColumnDimension('H')->setWidth(25);
		$worksheet2->getColumnDimension('I')->setWidth(25);
		$worksheet2->getColumnDimension('J')->setWidth(25);
		$worksheet2->getColumnDimension('K')->setWidth(25);
		$worksheet2->getStyle("A2:K2")->applyFromArray($style_head);



		$colstart2 = 3;
		foreach ($sql_result2 as $key => $value) {
			//$sessionName = wordwrap($value['SessionName'], 50);
			$worksheet2->SetCellValueByColumnAndRow(0, $colstart2, $value->ProgramName);
			$worksheet2->SetCellValueByColumnAndRow(1, $colstart2, $value->EventName);
			$worksheet2->SetCellValueByColumnAndRow(2, $colstart2, $value->EventDate);
			$worksheet2->SetCellValueByColumnAndRow(3, $colstart2, $value->EventVenue);
			$worksheet2->SetCellValueByColumnAndRow(4, $colstart2, $value->Task);
			$worksheet2->SetCellValueByColumnAndRow(5, $colstart2, $value->Type);
			$worksheet2->SetCellValueByColumnAndRow(6, $colstart2, $value->vol_required);
			$worksheet2->SetCellValueByColumnAndRow(7, $colstart2, $value->vol_joined);
			$worksheet2->SetCellValueByColumnAndRow(8, $colstart2, $value->EmployeeName);
			$worksheet2->SetCellValueByColumnAndRow(9, $colstart2, $value->EmailAddress);
			$worksheet2->SetCellValueByColumnAndRow(10, $colstart2, $value->WorkNumber);

			$worksheet2->getCellByColumnAndRow(0,$colstart2)->getStyle('B1:E999')->getAlignment()->setWrapText(true); 
			$worksheet2->getCellByColumnAndRow(1,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(2,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(3,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(4,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(5,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(6,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(7,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(8,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(9,$colstart2)->getStyle()->applyFromArray($style_body);
			$worksheet2->getCellByColumnAndRow(10,$colstart2)->getStyle()->applyFromArray($style_body);
			$colstart2++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.strtoupper($details[0]->event_name).' Alagang Unilab as of '.date('F, d, Y').'.xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Cache-Control: cache, must-revalidate'); 
		header ('Pragma: public'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();
		$objWriter->save('php://output');		
	}
	
	public function pagination(){
		
	}
}	