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

	}
?>