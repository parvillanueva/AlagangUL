<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GS_Controller extends CI_Controller {

    public function __construct() {

       	parent::__construct();
       	$str = '';
		$select = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($select, 'facebookexternalhit') !== false) {
			if($this->uri->segment(4)=='event'){
				$module = 'event';
				$id = $this->uri->segment(5);
			}
			else{
				$module = 'program';
				$id = $this->uri->segment(2);
			}
			$str = '?share='.$module.'-'.$id;
			$file = fopen("./test.txt", "w");        
			fwrite($file, $str);
			fclose($file);
		}
       	if($this->session->userdata('user_sess_id')=='') { 
			redirect(base_url("login".$str));
		}
    }

    
}