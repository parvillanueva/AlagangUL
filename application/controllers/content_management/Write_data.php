<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write_data extends CI_Controller {

	public function index()
	{
		$file = fopen($_POST['link'],"w");
		fwrite($file,$_POST['content']);
		fclose($file);
	}

}