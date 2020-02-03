
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User_role extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("User Roles");
		$data['edit_title'] = true;
		$data["content"] = "content_management/user_role/page";
		$data["breadcrumb"] = array('User Roles' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function edit()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Edit User Role";
		$data['content'] = "content_management/user_role/edit";
		$data["breadcrumb"] = array('User Roles' => base_url('content_management/user_role'),'Edit User Role' => '');
		$this->load->view('content_management/template/layout', $data);

	}
	public function add()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Add User Role";
		$data['content'] = "content_management/user_role/add";
		$data["breadcrumb"] = array('User Roles' => base_url('content_management/user_role'),'Add User Role' => '');
		$this->load->view('content_management/template/layout', $data);

	}

	public function save_role(){
		$table = $_POST['table'];
		$data = $_POST['data'];
		$data_id = $this->Global_model->save_data($table,$data);
		echo json_encode($data_id);
	}

	public function update_role(){
		$table = $_POST['table'];
		$query = $_POST['where'];
		$data = $_POST['data'];
		//update new data
		$status = $this->Custom_model->update_menu_data($table,$data,$query);
		echo $status;	

		echo json_encode($data_id);
	}	
}
	    