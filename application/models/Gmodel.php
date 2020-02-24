<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Taipei');

	class Gmodel extends CI_Model{ 

		function save_data($table, $data){
			$this->db->insert($table, $data);
			$insertId = $this->db->insert_id();
   			// return  $insertId;
   			if($insertId):
   				return $insertId;
			else:
			    return "failed";
			endif;
		}

		function update_data($table,$data,$field,$where){
			$this->db->where($field, $where);
			$this->db->update($table, $data);
			$updated_status = $this->db->affected_rows();
			if($updated_status):
			    return "success";
			else:
			    return "failed";
			endif;
		}
		
		function update_data_arr($table,$data,$where_arr){
			$this->db->where($where_arr);
			$this->db->update($table, $data);
			$updated_status = $this->db->affected_rows();
			if($updated_status):
			    return "success";
			else:
			    return "failed";
			endif;
		}

		function delete_data($table, $id){
			$this->db->where("id", $id);
			$this->db->delete($table);
   			$updated_status = $this->db->affected_rows();
			if($updated_status):
			    return "success";
			else:
			    return "failed";
			endif;
		}
		
		function delete_data_user($table, $where){
			$this->db->where($where);
			$this->db->delete($table);
   			$updated_status = $this->db->affected_rows();
			if($updated_status):
			    return "success";
			else:
			    return "failed";
			endif;
		}

		function get_query($table, $query){
			$this->db->where($query);
			$this->db->from($table);
			$q = $this->db->get();
			return $q->result();
		}

		function get_data_list($table, $query = null, $limit, $start, $select, $order_field = null, $join = null, $group = null)
		{
			$this->db->limit($limit, $start);
			$this->db->select($select);
			if($query != null){
				$this->db->where($query);
			}
			
			$this->db->from($table);

			if(isset($join)){
				if(count($join)> 0){
					foreach ($join as $key => $vl) { 
						foreach ($vl as $a => $b) {
							$this->db->join($b['table'], $b['param1'] . ' = ' . $b['param2'], $a);
						}
					};
				}
			}
			
			if($order_field != null){
				foreach ($order_field as $key => $vl) {
					foreach ($vl as $a => $b) {
						$this->db->order_by($b, $a);
					}
					
				};
			}

			$group_array = array();
			if($group != null){
				foreach ($group as $key => $value) {
					array_push($group_array, $value['field']);
				}
				$this->db->group_by($group_array);
			}
			$q = $this->db->get();
			// return $this->db->last_query();
			return $q->result();
		}		
	}