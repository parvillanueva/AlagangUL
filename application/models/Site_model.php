<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Taipei');

	class Site_model extends CI_Model{ 

		function get_teams(){
			$this->db->select("*");
			$this->db->where("status", 1);
			$this->db->from("tbl_program_teams");
			$q = $this->db->get();
			return $q->result();
		}
		
		// HOME PAGE
		function get_featured_programs()
		{
			$this->db->select("p.id, p.url_alias, p.image_thumbnail, p.name, p.overview, COUNT(DISTINCT(pm.user_id)) AS member_count");
			$this->db->from("tbl_programs p");
			$this->db->where("p.status", 1);
			$this->db->join("tbl_program_event_task_volunteers pm", "pm.program_id = p.id", "LEFT");
			$this->db->group_by("p.id");
			$this->db->order_by("p.update_date","desc");
			$this->db->limit(6);

			$query = $this->db->get();
			return $query->result_array();
		}

		function get_featured_programs_module()
		{
			$this->db->select("p.id, p.url_alias, p.image_thumbnail, p.name, p.overview, COUNT(pm.program_id) AS member_count");
			$this->db->from("tbl_programs p");
			$this->db->join("tbl_program_members pm", "pm.program_id = p.id", "LEFT");
			$this->db->where("p.status", 1);
			$this->db->group_by("p.id");
			$this->db->order_by("p.update_date","desc");

			$query = $this->db->get();
			return $query->result_array();
		}

		function get_other_programs()
		{
			$this->db->select("p.id, p.url_alias, p.image_thumbnail, p.name, p.overview, COUNT(pm.program_id) AS member_count");
			$this->db->from("tbl_programs p");
			$this->db->join("tbl_program_members pm", "pm.program_id = p.id", "LEFT");
			$this->db->where("p.status", 1);
			$this->db->group_by("p.id");
			$this->db->order_by("p.update_date","desc");
			$this->db->limit(4);

			$query = $this->db->get();
			return $query->result_array();
		}

		function get_banners()
		{
			$this->db->select("b.id, b.title, b.description, b.button_text, b.button_url, b.banner_media_web, b.banner_media_mobile, b.banner_logo");
			$this->db->from("tbl_banner_list b");
			$this->db->where("b.status", 1);

			$query = $this->db->get();
			return $query->result_array();

		}

		//MEMBER PROFILE PAGE
		function get_member_details($id)
		{
			$this->db->select("u.id, u.email_address, u.imagepath, CONCAT(u.first_name, ' ', u.last_name) as full_name, u.first_name, u.last_name, u.mobile_number, up.total_points, up.current_points");
			$this->db->from("tbl_users u");
			$this->db->join("tbl_users_points up", "up.user_id = u.id", "LEFT");
			$this->db->where("u.id", $id);
			
			$query = $this->db->get();
			return $query->row();
		}

		function get_created_programs($id)
		{
			$this->db->select("id, name, image_thumbnail, url_alias");
			$this->db->from("tbl_programs");
			$this->db->where("created_by", $id);

			return $this->db->get()->result_array();
		}

		function get_joined_programs($id)
		{
			$this->db->select("p.id, p.name, p.image_thumbnail, p.url_alias");
			$this->db->from("tbl_programs p");
			$this->db->join("tbl_program_event_task_volunteers pm", "pm.program_id = p.id", "LEFT");
			$this->db->where("pm.user_id", $id);
			$this->db->group_by("p.id");
			return $this->db->get()->result_array();
		}
		function get_member_badges($id)
		{
			$this->db->select("b.name, b.icon, b.color");
			$this->db->from("tbl_badges b");
			$this->db->join("tbl_program_event_task_badge etb", "etb.badge_id = b.id", "LEFT");
			$this->db->join("tbl_program_event_task et", "etb.event_task_id = et.id", "LEFT");
			$this->db->join("tbl_program_event_task_volunteers etv", "etv.event_task_id = et.id", "LEFT");
			$this->db->where("etv.user_id", $id);
			$this->db->where("b.status", 1);
			$this->db->group_by("b.id");

			return $this->db->get()->result_array();
		}

		function get_joined_events($id)
		{
			$this->db->select("p.image_thumbnail, p.id, pe.title, p.url_alias, pe.title, pe.`when`, pe.`where`, b.name as badge, b.icon, b.color");
			$this->db->from("tbl_program_events pe");
			$this->db->join("tbl_programs p", "p.id = pe.program_id", "LEFT");
			$this->db->join("tbl_program_event_task pet", "pet.event_id = pe.id", "LEFT");
			$this->db->join("tbl_program_event_task_volunteers etv", "etv.event_task_id = pet.id", "LEFT");
			$this->db->join("tbl_program_event_task_badge petb", "petb.event_task_id = pet.id", "LEFT");
			$this->db->join("tbl_badges b", "b.id = petb.badge_id", "LEFT");
					
		
			$this->db->where("etv.user_id", $id);

			return $this->db->get()->result_array();

		}
		//ABOUT US

		function get_about_us()
		{
			$this->db->select("title,description");
			$this->db->from("tbl_about_us");
			$this->db->where("status", 1);

			$query = $this->db->get();
			return $query->result_array();
		}

	}
?>