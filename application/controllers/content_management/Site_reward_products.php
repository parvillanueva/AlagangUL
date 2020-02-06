
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_reward_products extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("reward products");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/reward_products/page";
		$data['breadcrumb'] = array('Reward Products' => '');
		$this->load->view("content_management/template/layout", $data);	
	}


	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("reward products");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/reward_products/add";
		$data['breadcrumb'] = array('Reward Products' => '');
		$this->load->view("content_management/template/layout", $data);	
	}


	public function update()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("reward products");
		$data['edit_title'] = true;
		$data["content"] = "content_management/module/reward_products/edit";
		$data['breadcrumb'] = array('Reward Products' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function insert()
	{

		$data = array(
						'reward_name'			=> $this->input->post('reward_name'),
						'reward_image' 			=> $this->input->post('reward_image'),
						'reward_description'	=> $this->input->post('reward_description'),
						'points_needed'			=> $this->input->post('points_needed'),
						'reward_rating'			=> $this->input->post('reward_rating'),
						'category_id'			=> $this->input->post('category_id'),
						'status'				=> $this->input->post('status'),
						'create_by'				=> $this->session->userdata('sess_uid'),
						'create_date'			=> date('Y-m-d')
					 );

		

		$result_id = $this->Global_model->save_data('tbl_reward_products',$data);
		if($result_id){
			$data2 = array(
							'product_id'		   => $result_id,
							'total_stocks'         => $this->input->post('initial_stock'),
							'current_stocks'       => $this->input->post('initial_stock'),
							'create_by'			   => $this->session->userdata('sess_uid'),
							'create_date'		   => date('Y-m-d'),
							'status'				=> $this->input->post('status'),
						   );
			$this->Global_model->save_data('tbl_reward_inventory',$data2);
		}

	}

	public function get_category(){

		$query = ' status >= 1';
		$select = 'id,name, status, create_date, update_date';
		$result_data 	= $this->Global_model->get_list_query_sort('tbl_category',$query,'name','asc');
		echo json_encode($result_data);
	}

	//controller_config
}
	    