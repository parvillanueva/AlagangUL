<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Documentation extends GS_Controller {

	public function __construct() 
	{
		parent::__construct();
		if($this->session->userdata('sess_email')=='' ) { 
			redirect(base_url("content_management/login"));
		}
	}
	
	public function template()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Developers Documentation";
		$data['content'] = "content_management/documentation/template";
		$data["breadcrumb"] = array('Developers Documentation' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function helper()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Developers Documentation";
		$data['content'] = "content_management/documentation/helper";
		$data["breadcrumb"] = array('Developers Documentation' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function global_use()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Developers Documentation";
		$data['content'] = "content_management/documentation/global";
		$data["breadcrumb"] = array('Developers Documentation' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function site_loader()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Developers Documentation";
		$data['content'] = "content_management/documentation/front";
		$data["breadcrumb"] = array('Developers Documentation' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function package()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "Developers Documentation";
		$data['content'] = "content_management/documentation/package";
		$data["breadcrumb"] = array('Developers Documentation' => '');
		$this->load->view('content_management/template/layout', $data);
	}

}
