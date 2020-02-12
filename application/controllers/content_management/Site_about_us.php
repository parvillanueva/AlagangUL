
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_about_us extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("about us");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/about_us/page";
		$data['breadcrumb'] = array('About Us' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("about us");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/about_us/add";
		$data['breadcrumb'] = array('About Us' => '');
		$this->load->view("content_management/template/layout", $data);	
	}	


	public function update()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("about us");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/about_us/edit";
		$data['breadcrumb'] = array('About Us' => '');
		$data['details'] 	= $this->load->details("tbl_about_us",$this->uri->segment(4));
		$this->load->view("content_management/template/layout", $data);	
	}

	public function insert(){
		$title 	= $this->input->post('title');
		$description 	= $this->input->post('description');
		$status = $this->input->post('status');
		$data   = array(
					'title' 		=> $title,
					'description' 	=> $description,
					'create_date' 	=> date('Y-m-d'),
					'create_by'		=> $this->session->userdata('sess_uid'),
					'update_date'	=> date('Y-m-d'),
					'update_by'		=> $this->session->userdata('sess_uid'),
					'status'		=> $status
				  );

		$result_id = $this->Global_model->save_data('tbl_about_us',$data);
		return $result_id;
	}

	public function update_data(){
		$id 	= $this->input->post('id');
		$title 	= $this->input->post('title');
		$description 	= $this->input->post('description');
		$status = $this->input->post('status');
		$data   = array(
					'title' 		=> $title,
					'description' 	=> $description,
					'create_date' 	=> date('Y-m-d'),
					'create_by'		=> $this->session->userdata('sess_uid'),
					'update_date'	=> date('Y-m-d'),
					'update_by'		=> $this->session->userdata('sess_uid'),
					'status'		=> $status
				  );


		$update = $this->Global_model->update_data('tbl_about_us',$data,'id',$id);
		return $update;
	}

	//controller_config
}
	    