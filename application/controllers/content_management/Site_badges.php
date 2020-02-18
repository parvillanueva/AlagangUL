
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_badges extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("badges");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/badges/page";
		$data['breadcrumb'] = array('Badges' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("badges");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/badges/add";
		$data['breadcrumb'] = array('Badges' => '');
		$this->load->view("content_management/template/layout", $data);	
	}	

	public function update()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("badges");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/badges/edit";
		$data['breadcrumb'] = array('Badges' => '');
		$data['details'] 	= $this->load->details("tbl_badges",$this->uri->segment(4));
		$this->load->view("content_management/template/layout", $data);	
	}	

	public function insert(){
		$name 	= $this->input->post('name');
		$icon 	= $this->input->post('icon');
		$color 	= '#'.$this->input->post('color');
		$status = $this->input->post('status');
		$minimum_points = $this->input->post('minimum_points');
		$data   = array(
					'name' 		  			=> $name,
					'icon' 					=> $icon,
					'color'					=> $color,
					'create_date' 			=> date('Y-m-d'),
					'create_by'				=> $this->session->userdata('sess_uid'),
					'update_date'			=> date('Y-m-d'),
					'update_by'				=> $this->session->userdata('sess_uid'),
					'status'				=> $status,
					'minimum_points' 		=> $minimum_points
				  );

		$result_id = $this->Global_model->save_data('tbl_badges',$data);
		return $result_id;
	}


	public function update_data(){


		$id 	= $this->input->post('id');
		$name 	= $this->input->post('name');
		$icon 	= $this->input->post('icon');
		$color 	= '#'.$this->input->post('color');
		$status = $this->input->post('status');
		$minimum_points = $this->input->post('minimum_points');
		$data   = array(
					'name' 		  			=> $name,
					'icon' 					=> $icon,
					'color'					=> $color,
					'create_date' 			=> date('Y-m-d'),
					'create_by'				=> $this->session->userdata('sess_uid'),
					'update_date'			=> date('Y-m-d'),
					'update_by'				=> $this->session->userdata('sess_uid'),
					'status'				=> $status,
					'minimum_points' 		=> $minimum_points
				  );


		$update = $this->Global_model->update_data('tbl_badges',$data,'id',$id);
		return $update;
	}
	//controller_config
}
	    