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

    function uniquedata($table, $field, $value){

    	$query = 'SELECT * FROM ' . $table . ' WHERE ' . $field . ' = "' . $value . '" AND status = 1';
    	$result = $this->Api_model->run_query($query);
    	if(count($result) > 0){
    		$this->output(false, $value . " already exisit on the record, " . $field . " must be unique.");
    		die();
    	} else {
    		return true;
    	}
	}

    function upload($file,$folder){
    	$uploaddir = 'uploads/' . $folder . "/";

    	if (!file_exists('./'. $uploaddir)) {
		    mkdir('./'.$uploaddir, 0777, true);
		}

    	$Filepath = $file['name'];
		$filenamekey = md5(uniqid(time(), true));     
		$Fileext = pathinfo($Filepath, PATHINFO_EXTENSION);

		$uploadfile = $uploaddir .  $filenamekey.'.'.$Fileext;

		if (move_uploaded_file($file['tmp_name'], "./" . $uploadfile)) {
		    return $uploadfile;
		} else {
		    $this->output(false, "Failed to move uploaded file.");
		    die();
		}
    	
	}

	function validate($post, $field, $validate = array(), $confirmpass = null){
		$error = array();
		$success = true;
		$data = @$post[$field];
		foreach ($validate as $value) {
			switch ($value) {
				case 'required':
					if(!isset($data)){
						array_push($error, "This field is required");
						$success = false;
					} else if(trim($data) === ""){
						array_push($error, "This field is required");
						$success = false;
					}
					break;

				case 'date':
					if(!$this->validateDate($data)){
						array_push($error, "Invalid Date format, required format : Y-m-d");
						$success = false;
					}
					break;

				case 'time':
					if(!$this->validateTime($data)){
						array_push($error, "Invalid Date format, required format : H:i:s");
						$success = false;
					}
					break;

				case 'datetime':
					if(!$this->validateDateTime($data)){
						array_push($error, "Invalid Date format, required format : Y-m-d H:i:s");
						$success = false;
					}
					break;

				case 'email':
					if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
						array_push($error, "Invalid Email address");
						$success = false;
					}
					break;

				case 'number':
					if (!is_numeric($data)) {
						array_push($error, "Invalid Number");
						$success = false;
					}
					break;
				

				case 'mobile_no':
					if(!preg_match("/^9[0-9]{9}$/", $data)) {
						array_push($error, "Invalid Mobile Number format : 917XXXXXXX");
						$success = false;
					}
					break;

				case 'password':
					if(@$post[$confirmpass] == ""){
						array_push($error, "Confirm Password is required");
						$success = false;
					}
					if($data != @$post[$confirmpass]) {
						array_push($error, "Passsword not matched.");
						$success = false;
					} else {
						$data = md5($data);
					}
					break;

				case 'file':
					if(@$_FILES[$field]['size'] == 0 && @$_FILES[$field]['error'] == 0){ 
						array_push($error, "File is Empty");
						$success = false;
					} else {
						$data = $_FILES[$field];
					}
					break;
				
				default:
					# code...
					break;
			}
		}

		if($success){
			return $data;
		} else {
			$this->output(false, $field , $error);	
			die();

		}
	}

	function validateTime($date, $format = 'H:i:s'){
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) === $date;
	}

	function validateDate($date, $format = 'Y-m-d'){
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) === $date;
	}

	function validateDateTime($date, $format = 'Y-m-d H:i:s'){
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) === $date;
	}
}