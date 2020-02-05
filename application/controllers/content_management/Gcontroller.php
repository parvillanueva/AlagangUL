<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gcontroller extends CI_Controller {

	public function index(){
		$this->load->model("content_management/Gmodel");
		header('Content-Type: application/json');

		switch ($_POST['event']) {
			case 'insert':
				$table = $_POST['table'];
				$data = $_POST['data'];
				$id = $this->Gmodel->save_data($table,$data);
				//insert audit trail
				$this->audit_trail_controller("Create", $data);
				

				$result_return = array(
					"success"	=> true,
					"id"		=> $id 
				);

				echo json_encode($result_return);

				break;

			case 'update':
				$table = $_POST['table'];
				$field = $_POST['field'];
				$where = $_POST['where'];
				$data = $_POST['data'];

				//get old data for audit trail
				$query = $field . " = " . $where;
				$old_data = $this->Gmodel->get_data_list($table, $query, 1, 0, "*" ,null,null,null);

				//update new data
				$status = $this->Gmodel->update_data($table,$data,$field,$where);
				
				//insert audit trail
				$this->audit_trail_controller("Update", $data, $old_data);

				$result_return = array(
					"success"=> true,
					"message"=> $status 
				);

				echo json_encode($result_return);
                
				break;

			case 'status':
				$table = $_POST['table'];
				$field = $_POST['field'];
				$where = $_POST['where'];
				$data = $_POST['data'];
				$status = array($data['field'] => $data['value']);

				//get old data for audit trail
				$query = $field . " = " . $where;
				$old_data = $this->Gmodel->get_data_list($table, $query, 1, 0, "*" ,null,null,null);

				//update new data
				$status = $this->Gmodel->update_data($table,$status,$field,$where);

				//insert audit trail
				$this->audit_trail_controller("Update Status", $data, $old_data);

				$result_return = array(
					"success"=> true,
					"message"=> $status 
				);

				echo json_encode($result_return);
                
				break;

			case 'delete':
				$table = $_POST['table'];
				$field = $_POST['field'];
				$where = $_POST['where'];
				$data = $_POST['data'];
				$status = array($data['field'] => $data['value']);

				//get old data for audit trail
				$query = $field . " = " . $where;
				$old_data = $this->Gmodel->get_data_list($table, $query, 1, 0, "*" ,null,null,null);

				//update new data
				$status = $this->Gmodel->update_data($table,$status,$field,$where);
				echo $status;

				//insert audit trail
				$this->audit_trail_controller("Remove", $data, $old_data);
                
				break;

			case 'select':
				$table = $_POST['table'];
				$select =  $_POST['select'];
				$offset =  $_POST['offset'];
				$limit =  $_POST['limit'];
				if($_POST['custom_q'] != ""){
					$query = $this->generate_query(@$_POST['query']) . " " . @$_POST['custom_q'];
				} else {
					$query = $this->generate_query(@$_POST['query']);
				}
				

				$limit = isset($_POST['limit'])? $_POST['limit'] : 99999;
				$offset = isset($_POST['offset'])? $_POST['offset'] : 1;
				$order = isset($_POST['order'])? $_POST['order'] : null;
				$join = isset($_POST['join']) ? $_POST['join']: null;
				$group= isset($_POST['group']) ? $_POST['group']: null;

				$result_data = $this->Gmodel->get_data_list($table, $query, $limit, $offset * $limit, $select, $order, $join, $group);

		        echo json_encode($result_data);
				break;

			case 'pagination':
				$table = $_POST['table'];
				$select =  $_POST['select'];
				$offset =  $_POST['offset'];
				$limit =  $_POST['limit'];
				if($_POST['custom_q'] != ""){
					$query = $this->generate_query(@$_POST['query']) . " " . @$_POST['custom_q'];
				} else {
					$query = $this->generate_query(@$_POST['query']);
				}

				$offset = isset($_POST['offset'])? $_POST['offset'] : 1;
				$order = isset($_POST['order'])? $_POST['order'] : null;
				$join = isset($_POST['join']) ? $_POST['join']: null;
				$group= isset($_POST['group']) ? $_POST['group']: null;

				$result_data = $this->Gmodel->get_data_list($table, $query, 9999999, 0, $select, $order, $join, $group);

				$result_return = array(
					"total_record"=> count($result_data),
					"total_page"=>ceil(count($result_data) / $limit)
				);

				echo json_encode($result_return);
				break;

		}
	}


	function generate_query($data)
	{

		$query = "";
		if($data != ""){
			foreach ($data as $key => $value) {
				switch ($key) {
					case 'where':
						foreach ($value as $a => $b) {
							foreach ($b as $c => $d) {
								switch ($c) {
									case 'equal':
										if($query != ""){
											$query .= " AND ";
										}
										$query .= $d['field'] . " = '" . $d['value'] . "'";
										break;
									case 'like':
										if($query != ""){
											$query .= " AND ";
										}
										$query .= $d['field'] . " like '%" . $d['value'] . "%'";
										break;
									case 'not':
										if($query != ""){
											$query .= " AND ";
										}
										$query .= $d['field'] . " != '" . $d['value'] . "'";
										break;
									case 'greater':
										if($query != ""){
											$query .= " AND ";
										}
										$query .= $d['field'] . " > '" . $d['value'] . "'";
										break;
									case 'less':
										if($query != ""){
											$query .= " AND ";
										}
										$query .= $d['field'] . " < '" . $d['value'] . "'";
										break;
									case 'greater_equal':
										if($query != ""){
											$query .= " AND ";
										}
										$query .= $d['field'] . " >= '" . $d['value'] . "'";
										break;
									case 'less_equal':
										if($query != ""){
											$query .= " AND ";
										}
										$query .= $d['field'] . " <= '" . $d['value'] . "'";
										break;
								}
							}
							
						}
						break;
					
					case 'or_where':
						foreach ($value as $a => $b) {
							foreach ($b as $c => $d) {
								switch ($c) {
									case 'equal':
										if($query != ""){
											$query .= " OR ";
										}
										$query .= $d['field'] . " = '" . $d['value'] . "'";
										break;
									case 'like':
										if($query != ""){
											$query .= " OR ";
										}
										$query .= $d['field'] . " like '%" . $d['value'] . "%'";
										break;
									case 'not':
										if($query != ""){
											$query .= " OR ";
										}
										$query .= $d['field'] . " != '" . $d['value'] . "'";
										break;
									case 'greater':
										if($query != ""){
											$query .= " OR ";
										}
										$query .= $d['field'] . " > '" . $d['value'] . "'";
										break;
									case 'less':
										if($query != ""){
											$query .= " OR ";
										}
										$query .= $d['field'] . " < '" . $d['value'] . "'";
										break;
									case 'greater_equal':
										if($query != ""){
											$query .= " OR ";
										}
										$query .= $d['field'] . " >= '" . $d['value'] . "'";
										break;
									case 'less_equal':
										if($query != ""){
											$query .= " OR ";
										}
										$query .= $d['field'] . " <= '" . $d['value'] . "'";
										break;
								}
							}
							
						}
						break;
				}
				
			}
		}
		return $query;
	}


	public function audit_trail_controller($action, $new_data = null, $old_data = null){
	    $data2['user_id'] = $this->session->userdata('sess_uid');
	  	$data2['url'] =str_replace(base_url("content_management") . '/', "", $_SERVER['HTTP_REFERER']); ;
	  	$data2['action'] = strip_tags(ucwords($action));
	  	if($new_data != null){
	  		$data2['new_data'] = json_encode($new_data);
	  	}

	  	if($old_data != null){
	  		$data2['old_data'] = json_encode($old_data);
	  	}

	  	$data2['create_date'] = date('Y-m-d H:i:s');
	  	$this->Global_model->save_data('cms_audit_trail',$data2);
	}

	public function upload_file(){
		header('Content-Type: application/json');
		$base64 = $this->input->post("base64");
		$extension = $this->input->post("extension");

		$temp_folder = "uploads/files/";
		$output_file = $temp_folder . md5(time().uniqid()) . "." . $extension ;


		if (!file_exists($temp_folder)) {
		    mkdir($temp_folder, 0777, true);
		}

		$ifp = fopen( $output_file, 'wb' ); 
	    $data = explode( ',', $base64 );
	    fwrite( $ifp, base64_decode($data[1]));
	    fclose( $ifp ); 

	    echo json_encode(array(
	    	"path"		=>  $output_file,
	    	"fullpath"	=> base_url() . $output_file,
	    ));
	}
}