<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_program extends CI_Controller {

	public function index()
	{
		$data['content'] = "site/create_program/page.php";
		$data['meta'] = array();
		$data['fb_og'] = array();
		

		$data['teams'] = $this->Site_model->get_teams();
		$this->load->view("site/layout/template",$data);
	}

}