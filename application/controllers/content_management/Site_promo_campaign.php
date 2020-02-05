
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_promo_campaign extends GS_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("Promo Campaign");
		$data['edit_title'] = true;
		$data["content"] = "content_management/promo_campaign/page";
		$data["breadcrumb"] = array('Promo Campaign' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function add()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ucfirst("Add Promo Campaign");
		$data["content"] = "content_management/promo_campaign/add";
		$data["breadcrumb"] = array('Promo Campaign' => base_url('content_management/site_promo_campaign'),'Add Promo Campaign' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

	public function edit()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ucfirst("Edit Promo Campaign");
		$data["content"] = "content_management/promo_campaign/edit";
		$data["breadcrumb"] = array('Promo Campaign' => base_url('content_management/site_promo_campaign'),'Edit Promo Campaign' => '');
		$this->load->view("content_management/template/layout", $data);	
	}

}
	    