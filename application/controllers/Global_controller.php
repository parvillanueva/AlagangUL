<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_controller extends CI_Controller {

	public function index()
	{
		switch ($_POST['event']) { 
			case 'list':
				try { 
					$query = $_POST['query'];
					$table = $_POST['table'];
					$select =  $_POST['select'];
					$limit = isset($_POST['limit'])? $_POST['limit'] : 99999;
					$offset = isset($_POST['offset'])? $_POST['offset'] : 1;
					$order_field = isset($_POST['order']['field'])? $_POST['order']['field'] : null;
					$order_type = isset($_POST['order']['order']) ? $_POST['order']['order']: null;
					$join = isset($_POST['join']) ? $_POST['join']: null;
					$group= isset($_POST['group']) ? $_POST['group']: null;
					$result_data = $this->Global_model->get_data_list($table, $query, $limit, ($offset - 1) * $limit, $select,$order_field,$order_type, $join, $group);

			        echo json_encode($result_data);
			    } catch (Error $e) {
	        		echo "Error displaying a list from database: " . $e->getMessage();
				}
			break;

			case 'insert':
				try { 
					$table = $_POST['table'];
					$data = $_POST['data'];
					$id = $this->Global_model->save_data($table,$data);
					//insert audit trail
					$this->audit_trail_controller("Create", $data);
					echo $id;
				} catch (Exception $e) {
	        		echo "Error adding data: " . $e->getMessage();
				}
			break;

			case 'update':
				try { 
					$table = $_POST['table'];
					$field = $_POST['field'];
					$where = $_POST['where'];
					$data = $_POST['data'];

					//get old data for audit trail
					$query = $field . " = " . $where;
					$old_data = $this->Global_model->get_data_list($table, $query, 1, 0, "*" ,null,null,null);

					//update new data
					$status = $this->Global_model->update_data($table,$data,$field,$where);
					echo $status;	
		 
	                //insert audit trail	 
	                if(isset($data['status'])){
	                    if($data['status'] == -2){
	                        $this->audit_trail_controller("Delete", $data, $old_data);    
	                    } else {
	                        $this->audit_trail_controller("Update", $data, $old_data);
	                    }
	                } else {
	                	$this->audit_trail_controller("Update", $data, $old_data);
	                }
	            } catch (Exception $e) {
	        		echo "Error updating data: " . $e->getMessage();
				}
			break;

			case 'delete':
				try { 
					$table = $_POST['table'];
					$id = $_POST['id'];

					//get old data for audit trail
					$query = "id = " . $id;
					$old_data = $this->Global_model->get_data_list($table, $query, 1, 0, "*" ,null,null,null);

					//delete data
					$status = $this->Global_model->delete_data($table,$id);
					echo $status;

					//insert audit trail
					$this->audit_trail_controller("Remove", null, $old_data);
				} catch (Exception $e) {
	        		echo "Error deleting data: " . $e->getMessage();
				}
			break;

			case 'pagination':
				$query = $_POST['query'];
				$table = $_POST['table'];
				$select =  $_POST['select'];
				$limit = isset($_POST['limit'])? $_POST['limit'] : 99999;
				$offset = 1;
				$order_field = isset($_POST['order']['field'])? $_POST['order']['field'] : null;
				$order_type = isset($_POST['order']['order']) ? $_POST['order']['order']: null;
				$join = isset($_POST['join']) ? $_POST['join']: null;

				$result_data = $this->Global_model->get_data_list($table, $query, 9999999, ($offset - 1) * 9999999, $select,$order_field,$order_type, $join);
				$result_return = array(
					"total_record"=> count($result_data),
					"total_page"=>ceil(count($result_data) / 10)
				);

				echo json_encode($result_return);
				break;
		
		}
		
	}

	public function audit_trail_controller($action, $new_data = null, $old_data = null)
	{
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

	public function audit_trail()
	{
	    $data['user_id'] = $this->session->userdata('sess_uid');
	  	$data['url'] =str_replace(base_url("content_management") . '/', "", rtrim($_POST['uri'],"#")); ;
	  	$data['action'] = strip_tags(ucwords($_POST['action']));
	  	$data['create_date'] = date('Y-m-d H:i:s'); 
	  	$table = 'cms_audit_trail';
	  	$this->Global_model->save_data($table,$data);
	}


	public function contact_us()
	{
		$table = "pckg_contact_us";
		$data = $_POST['data'];
		$id = $this->Global_model->save_data($table,$data);
	}

}
