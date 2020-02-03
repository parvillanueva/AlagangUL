<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_now extends CI_Controller {

	public function index()
	{
		date_default_timezone_set("Asia/Manila");
		header("Content-Type: application/json");
		
		$results = $this->db->query("SELECT * FROM site_shop_now where status > 0")->result();
		echo json_encode($results);
	}
   
}
