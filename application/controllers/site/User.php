<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User extends CI_Controller {
	
	public function index(){
		$data['token'] = '214379c94ea72a85f638ca88292248c6';
		$data["title"] = "Content Management";
		$data["PageName"] = ("User");
		$data["content"] = "site/user/user";
		$this->load->view("layout/layout", $data);	
	}
}