<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GS_Controller extends CI_Controller {

    public function __construct() {
       	parent::__construct();
       	if($this->session->userdata('sess_id')=='') { 
			redirect(base_url("login"));
		}
    }

    
}