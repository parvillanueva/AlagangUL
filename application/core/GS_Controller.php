<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CMDDateTime = date('Y-m-d H:i:s');
$CMDEvent;
class GS_Controller extends CI_Controller {

    public function __construct() {
       	parent::__construct();
       	$this->load->model("Api_model");
		$token = $this->input->get("token");
		if(trim($token) == ""){
			$this->output(false, 'Auth Token not found.');
			die();
		}

		if(count($this->Api_model->check_token($token)) == 0){
			$this->output(false, 'Auth Token provided is invalid.');
			die();
		}


		$GLOBALS['CMDEvent'] =  $this->input->post("CMDEvent");
		if(trim($GLOBALS['CMDEvent']) == ""){
			$this->output(false, 'Event required.');
			die();
		}
    }

    function output($status = false, $message = null, $data = null){

    	header('Content-Type: application/json');
    	$result = array(
			'Status' 	=> $status, 
			'Message' 	=> $message, 
			'Data' 		=> $data, 
			'DateTime'  => $GLOBALS['CMDDateTime']
		);
    	echo json_encode($result);
    	
	}
}