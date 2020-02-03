<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_campaign extends CI_Controller {

	public function index()
	{
		date_default_timezone_set("Asia/Manila");
		header("Content-Type: application/json");
		$redirect = @$_SERVER['HTTP_REFERER'];
		$url = null;
		$photo = null;
		if($redirect == base_url()){
			$result = $this->db->query("SELECT * FROM site_promo_campaign WHERE status > 0 AND start_date <= DATE(NOW()) and end_date >= DATE(NOW()); ")->result();
			$url = $result[0]->redirect_url; 
			$photo = base_url() . $result[0]->img_banner; 
		}
		$result = array(
			"url"	=> $url,
			"photo"	=> $photo,
		);

		echo json_encode($result);
	}

}

