<?php

class Audit_trail_lib {

	public function save($module, $action){
		$CI =& get_instance();
		$CI->load->model('Gmodel'); 
		date_default_timezone_set('Asia/Manila'); 
		$table = 'tbl_audit_trail';
		$ArrayData = array(
			'username' => $_SESSION['user_sess_email'],
			'action' => $action,
			'module' => $module,
			'date_created' => date('Y-m-d H:i:s')
		);
		$sql = $CI->Gmodel->save_data($table, $ArrayData);
		return $sql;
	}
}	