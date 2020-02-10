<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User extends GS_Controller {
	
	public function view($user_id){
		$arrWhere = array(
			'id' => $user_id
		);
		$result = $this->Gmodel->get_query('tbl_users', $arrWhere);
		$data['data_set'] = $result;
		$data["title"] = "Content Management";
		$data["PageName"] = ("User");
		$data["content"] = "site/user/user";
		$this->load->view("layout/layout", $data);	
	}
	
	public function save(){
		print_r($_FILES);
	}
}