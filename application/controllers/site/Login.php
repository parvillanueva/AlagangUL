<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{

	}

	public function send_otp()
	{
		
	}
	
	public function register_email()
	{
		$data = array();
		$this->parser->parse("site/login/register_email", $data);
	}

	
	public function register_otp()
	{
		
	}
	
	public function register_information()
	{
		
	}

}
