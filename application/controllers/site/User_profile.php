<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User_profile extends CI_Controller {
	public function index(){
		//$data["title"] = "Content Management";
		//$data["PageName"] = ("User");
		$data["content"] = "site/user_profile/page";
		$this->load->view("site/layout/template2",$data);	
	}
	public function view($user_id){
		$arrWhere = array(
			'id' => $user_id
		);
		$result = $this->Gmodel->get_query('tbl_users', $arrWhere);
		$data['data_set'] = $result;
		$data["title"] = "Content Management";
		$data["PageName"] = ("User");
		$data["content"] = "site/user_profile/page";
		$this->load->view("layout/layout", $data);	
	}
	
	public function save(){
		print_r($_FILES);
	}
}