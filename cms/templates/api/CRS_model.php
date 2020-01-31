<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Taipei');

	class CRS_model extends CI_Model{

		public function check_api_exist($host, $token) 
		{
			$query = $this->db->get_where('pckg_crs_config', array('host' => $host, 'token' => $token));
			return $query->num_rows();
		}

		public function check_signup($email, $mobile)
		{
			$this->db->select('id, firstname, lastname, email, civil_status, gender, dob, mobile, offers, status, registration_date');
			$this->db->from('pckg_crs_users');
			$this->db->where('email', $email);
			$this->db->or_where('mobile', $mobile);
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
			return $this->db->insert('pckg_crs_users', $data);
		}

	}
?>