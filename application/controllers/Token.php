<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Token extends CI_Controller {

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("API TOKEN");
		$data['edit_title'] = true;
		$data["content"] = "api_token/page";
		$data['breadcrumb'] = array('API TOKEN' => '');
		$this->load->view("layout/layout", $data);	
	}

	public function generate_token(){
		$Arry_data = array(
			'token' => md5(uniqid(rand(), true))
		);
		echo json_encode($Arry_data);
	}
	
	public function update(){
		date_default_timezone_set('Asia/Manila');
		$table = 'tbl_api_tokens';
		$this->Global_model->delete_all($table);
		foreach($_POST as $data_loop){
			$ArryInsert = array(
				'api_token' 		=> $data_loop['token'],
				'api_host'  		=> $data_loop['host'],
				'is_active'  		=> $data_loop['status'],
				'update_date'  		=> date('Y-m-d H:i:s'),
			);
			$data = $ArryInsert;
			$id = $this->Global_model->save_data($table,$data);
		}
		if($id != ''){
			$ArryResponse = array(
				'response'=> 'success'
			);
		} else{
			$ArryResponse = array(
				'response'=> 'failed'
			);
		}
		echo json_encode($ArryResponse);
	}
	
	public function first_load(){
		$result = $this->Global_model->select_all("tbl_api_tokens");
			$dataArray = '';
		if(!empty($result)){
			$dataArray = $result;
		}
		echo json_encode($dataArray);
	}
}
	    