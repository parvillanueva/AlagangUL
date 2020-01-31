<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Taipei');

	class Global_model extends CI_Model{ 

		function check_sess() {
			if($this->session->userdata('sess_user')!='') { 
				return true;
			} else {
				return false;
			}
		}

		function validate_log($user, $pass){
			$this->db->select('*');
			$this->db->from('cms_users');
			$this->db->where('username', $user); 
			$this->db->where('password', $pass); 

			$query = $this->db->get();

			return $query->result();
		}

		function check_user($user){
			$this->db->select('id,username,status,user_error_logs,user_block_logs,user_lock_time,email,role');
			$this->db->from('cms_users'); 
			$this->db->where('username', $user); 
			$this->db->where('status >= ', 0);
			$query = $this->db->get();
			return $query->result();
		}

		function check_email($email)
		{
			$this->db->select('*');
			$this->db->from('cms_users');
			$this->db->where('email', $email);
			$this->db->where('status', 1);	

			$query = $this->db->get();

			return $query->result();

		}

		function check_password($password, $user_id)
		{
			$this->db->select('*');
			$this->db->from('cms_users');
			$this->db->where('id', $user_id);
			$this->db->where('password', $password);
			$this->db->where('status', 1);	

			$query = $this->db->get();

			return $query->result();

		}

		function is_activated($username, $password)
		{
			$this->db->select('*');
			$this->db->from('cms_users');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->where('status', 1);

			$query = $this->db->get();

			return $query->result();

		}
		
	    function get_by_id($table, $id) {
			$this->db->select("*");
			$this->db->where("id", $id);
			$this->db->from($table);
			$q = $this->db->get();
			return $q->result();
		}

		function get_event_name(){
			$query = $this->db->query('SELECT event_name , id FROM tbl_event_list');
        	return $query->result();
		}

		function get_by_list_where_not_in($table,$ids,$where=null)
		{
			$this->db->select('*');
			$this->db->from($table);
			if($where)
			{
				$this->db->where($where);
			}
			$this->db->where_not_in('id', $ids);

			$query = $this->db->get();

			return $query->result();

		}

		function get_list_query_sort($table, $query,$order_by,$sort)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->where($query);
			$this->db->order_by($order_by,$sort);
			$q = $this->db->get();
			return $q->result();
		}
		
		function select_query($sql_query){
			$sql = $this->db->query($sql_query);
			return $sql->result();
		}
		
	    function get_list_all($table)
		{
			$this->db->select("*");
			$this->db->from($table);
			$q = $this->db->get();
			return $q->result();
		}

		function get_list_query($table, $query)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->where($query);
			$q = $this->db->get();
			return $q->result();
		}
		
		function get_list_query_not_equal($table, $query)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->where($query);
			$this->db->where(''.$table.'.status != ',-2,FALSE);
			$q = $this->db->get();
			return $q->result();
		}
		
		function get_list_query_not_equal_count($table, $query)
		{
			$this->db->select("count(*) Total");
			$this->db->from($table);
			$this->db->where($query);
			$q = $this->db->get();
			return $q->result();
		}
		
		function get_list_query_not_equal_join($table, $query, $join, $table_joiner, $join_joiner)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->join($join, $table.'.'.$table_joiner.'='. $join.'.'.$join_joiner);
			$this->db->where($query);
			$this->db->where($table.'.status',1,FALSE);
			$q = $this->db->get();
			return $q->result();
		}
		
		function get_list_query_not_equal_join_order_desc($table, $query, $join, $table_joiner, $join_joiner, $order)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->join($join, $table.'.'.$table_joiner.'='. $join.'.'.$join_joiner);
			$this->db->where($query);
			$this->db->where('tbl_event_attend.isAttend',1,FALSE);
			$this->db->order_by	($order, "DESC");
			$this->db->group_by('tbl_event_attend.UserId');
			$q = $this->db->get();
			return $q->result();
		}
		
		function get_list_query_not_equal_join_order_asc($table, $query, $join, $table_joiner, $join_joiner, $order)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->join($join, $table.'.'.$table_joiner.'='. $join.'.'.$join_joiner);
			$this->db->where($query);
			$this->db->where($table.'.status != ',-2,FALSE);
			$this->db->order_by	($order, "ASC");
			$q = $this->db->get();
			return $q->result();
		}
		
		function get_list_query_not_equal_left_join($table, $query, $join, $table_joiner, $join_joiner)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->join($join, $table.'.'.$table_joiner.'='. $join.'.'.$join_joiner, "left");
			$this->db->where($query);
			$this->db->where($table.'.status != ',-2,FALSE);
			$q = $this->db->get();
			return $q->result();
		}
		
		function get_list_query_not_equal_left_join_group($table, $query, $join, $table_joiner, $join_joiner, $group)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->join($join, $table.'.'.$table_joiner.'='. $join.'.'.$join_joiner, "left");
			$this->db->where($query);
			$this->db->where($table.'.status != ',-2,FALSE);
			$this->db->group_by($group);
			$q = $this->db->get();
			return $q->result();
		}
		
		function get_list_select($select, $table, $query)
		{
			$this->db->select($select);
			$this->db->from($table);
			$this->db->where($query);
			$q = $this->db->get();
			return $q->result();
		}

		function get_list_menu($table, $query)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->where($query);
			$this->db->order_by("menu_orders","asc");
			$q = $this->db->get();
			return $q->result();
		}

		function get_users_model($table)
		{
			$this->db->select("*");
			$this->db->from($table);
			$this->db->where('status >=',0);
			$q = $this->db->get();
			return $q->result();
		}
		
		function select_all($table)
		{
			$this->db->select("*");
			$this->db->from($table);
			$q = $this->db->get();
			return $q->result();
		}
		

		function get_data_list($table, $query = null, $limit, $start, $select, $order_field = null, $order_type = asc, $join = null, $group = null)
		{
			$this->db->limit($limit, $start);
			$this->db->select($select);
			if($query != null){
				$this->db->where($query);
			}
			
			$this->db->from($table);

			if($join != null){
				foreach ($join as $key => $vl) {
					$this->db->join($vl['table'],$vl['query'],$vl['type']);
				};
			}
			if($order_field != null){
				$this->db->order_by($order_field, $order_type);
			}
			if($group != null){
				$this->db->group_by($group);
			}
			$q = $this->db->get();
			return $q->result();
		}

		function save_data($table, $data)
		{
			$this->db->insert($table, $data);
			$insertId = $this->db->insert_id();
   			// return  $insertId;
   			if($insertId):
   				return $insertId;
			else:
			    return "failed";
			endif;
		}

		function update_data($table,$data,$field,$where)
		{
			$this->db->where($field, $where);
			$this->db->update($table, $data);
			$updated_status = $this->db->affected_rows();
			if($updated_status):
			    return "success";
			else:
			    return "failed";
			endif;
		}

		function delete_data($table, $id)
		{
			$this->db->where("id", $id);
			$this->db->delete($table);
   			$updated_status = $this->db->affected_rows();
			if($updated_status):
			    return "success";
			else:
			    return "failed";
			endif;
		}
		
		function delete_all($table)
		{
			$this->db->truncate($table);
		}

		function get_admin(){
			$this->db->select('*');
			$this->db->from('cms_users');
			$this->db->where_in('status', [1, 2]);

			$query = $this->db->get();

			return $query->result();

		}

		function check_visit($unid, $type, $url, $date = null)
		{
			$this->db->select('*');
			$this->db->from('site_analytics');
			$this->db->where('unid', $unid);
			$this->db->where('url', $url);
			$this->db->where('type', $type);
			if($date != null){
				$this->db->like('datetime', $date);
			}
			

			$query = $this->db->get();

			return $query->num_rows();

		}

        function db_search($search_values)
        {
            $table_fields = array();
            $cumulative_results = array();

            $result = $this->db->query("
                SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE
                FROM  `INFORMATION_SCHEMA`.`COLUMNS` 
                WHERE  `TABLE_SCHEMA` =  '".$this->db->database."'
                AND `DATA_TYPE` IN ('varchar', 'char', 'text')
                ")->result_array();
            
            foreach ( $result  as $o ) 
            {
                $table_fields[$o['TABLE_NAME']][] = $o['COLUMN_NAME'];          
            }
            
            foreach($table_fields as $table_name => $fields)
            {
                $search_array = array();
                foreach($fields as $field)
                {
                    $search_array[] = " `{$field}` LIKE '{$search_values}' ";
                }

                $search_string = implode (' OR ', $search_array);
                $query_string = "SELECT * FROM `{$table_name}` WHERE {$search_string}";
                
                $table_results = $this->db->query($query_string)->result_array();       
                $cumulative_results = array_merge($cumulative_results, $table_results);
            }
            
            return $cumulative_results;
        }

        function get_user_id($field = null)
        {
			$this->db->select('id');
			$this->db->from('pckg_sign_up');
			$this->db->where('sign_up_email_address', $field);

			$query = $this->db->get();

			return $query->result();
        }

        function email_notif_enabled_admins($field = null)
        {
			$this->db->select('*');
			$this->db->from('cms_users');
			$this->db->where('status', 1);

			if ($field == 'notif_contactus') {
				$this->db->where('notif_contactus', 1);
			}

			if ($field == 'notif_signup') {
				$this->db->where('notif_signup', 1);
			}

			$query = $this->db->get();

			return $query->result();
		}

		function check_token_exist($token = null)
		{
			$this->db->select('id');
			$this->db->from('pckg_sign_up');
			$this->db->where('sign_up_token', $token);
			$this->db->where('sign_up_status', 0);

			$query = $this->db->get();

			return $query->result();
		}

	    function activate_user($id = null)
	    {
			$this->db->where('id', $id);
			$this->db->update('pckg_sign_up', array('sign_up_status' => 1,'sign_up_token'=>''));

			$updated_status = $this->db->affected_rows();
			if($updated_status):
			    return "success";
			else:
			    return "failed";
			endif;
	    }

	    function site_meta_og($id, $table, $field)
	    {

	    	$full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	    	$this->db->where('url', $full_url);
	    	$query_first = $this->db->get("cms_seo");
	    	$count = $query_first->num_rows();

	    	if($count > 0){
		    	return $query_first->row_array()[$field];
	    	}else{
	    		$this->db->where('id', $id);
		    	$query = $this->db->get($table);
		    	return $query->row_array()[$field];
	    	}

	    } 

	    function get_historical_passwords($user_id, $password)
	    {
	    	$this->db->where('user_id', $user_id);
	    	$this->db->where('password', $password);
	    	$query = $this->db->get('cms_historical_passwords');
	    	return $query->result();
	    }

	    function update_package($table,$data,$field,$where)
		{
			$this->db->where($field, $where, FALSE);
			$this->db->update($table, $data);
			$updated_status = $this->db->affected_rows();
			if($updated_status):
			    return "success";
			else:
			    return "failed";
			endif;
		}

		function get_no($no){
			$this->db->from("cms_menu");
			$this->db->select('menu_level');
			$this->db->where("menu_level",$no);
			$query = $this->db->get();
			$res = $query->result_array();
			return $res;
		}

	}
?>