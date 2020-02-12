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
			$this->db->select("p.id, p.url_alias, p.image_thumbnail, p.name,  p.overview, COUNT(pm.program_id) AS member_count");
			$this->db->from("tbl_programs p");
			$this->db->join("tbl_program_members pm", "pm.program_id = p.id", "LEFT");
			$this->db->group_by("p.id");
			$this->db->limit(6);

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
			$this->db->select("id, email_address, imagepath, CONCAT(first_name, ' ', last_name) as full_name");
			$this->db->from("tbl_users");
			$this->db->where("id", $id);

			$query = $this->db->get();
			return $query->row();
		}

		function get_created_programs($id)
		{
			$this->db->select("id, name, image_thumbnail");
			$this->db->from("tbl_programs");
			$this->db->where("created_by", $id);

			return $this->db->get()->result_array();
		}

		function get_joined_programs($id)
		{
			$this->db->select("p.id, p.name, p.image_thumbnail");
			$this->db->from("tbl_programs p");
			$this->db->join("tbl_program_members pm", "pm.program_id = p.id", "LEFT");
			$this->db->where("pm.user_id", $id);

			return $this->db->get()->result_array();
		}

	}
?>