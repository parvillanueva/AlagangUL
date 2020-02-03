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

}
