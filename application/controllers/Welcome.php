<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{

		$data['content'] = "site/welcome/default.php";
		$data['meta'] = array(
			"title"         =>  "Welcome",
			"description"   =>  "[Page Description]",
			"keyword"       =>  "[Page Keyword]"
		);
		
		$data['fb_og'] = array(
			"type"          =>  "[page type]",
			"title"         =>  "Welcome",
			"image"         =>  "[page image]"
		);
		$this->load->view("site/layout/template",$data);
	}

	public function change_city_special_char(){
		echo "<pre>";
		$query = "SELECT * FROM tbl_city WHERE tbl_city.city_name LIKE '%Ã±%'";
		$result = $this->db->query($query)->result();
		foreach ($result as $key => $value) {
			$id = $value->id;
			$city_name = str_replace("Ã±", "ñ", $value->city_name) ;
			$update_query = "UPDATE tbl_city SET city_name ='" . $city_name . "' WHERE id = " . $id;
			$this->db->query($update_query);
		}
	}

}
