<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

	function check_token($token){
		$this->db->select("*");
		$this->db->where("api_token",$token);
		$this->db->from("tbl_api_tokens");
		$q = $this->db->get();
		return $q->result();
	}

	function save_data($table, $data){
		$this->db->insert($table, $data);
		$insertId = $this->db->insert_id();
		return $insertId;
	}

	function update_data($table,$data,$field,$where)
	{
		$this->db->where($field, $where);
		$this->db->update($table, $data);
		$result = $this->db->affected_rows();
		return $result;
	}

	function run_query($query){
		$q = $this->db->query($query);
		return $q->result();
	}

}