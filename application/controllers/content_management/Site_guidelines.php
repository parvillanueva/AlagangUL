
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_guidelines extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("guidelines");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/guidelines/page";
		$data['breadcrumb'] = array('guidelines' => '');
		$data['details'] 	= $this->load->details("tbl_guidelines",1);
		$this->load->view("content_management/template/layout", $data);	
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


		$update = $this->Global_model->update_data('tbl_guidelines',$data,'id',$id);
		return $update;
	}

	//controller_config
}
	    