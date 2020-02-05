<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Taipei');

	class CRS_model extends CI_Model{

		public function check_api_exist($host, $token) 
		{
			$query = $this->db->get_where('site_token', array('host' => $host, 'token' => $token));
			return $query->num_rows();
			// return $this->db->last_query();
		}

		public function check_signup($email)
		{
			$this->db->select('*');
			$this->db->from('site_signup');
			$this->db->where('email', $email);
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function update_data($data, $tbl_name, $email)
		{
			$this->db->where('email', $email);
			$this->db->update($tbl_name, $data);
			$updated_status = $this->db->affected_rows();
			return $updated_status;
		}

		public function insert_data($data)
		{	
			return $this->db->insert('site_signup', $data);
		}

	}
?>