<?php
date_default_timezone_set("Asia/Manila");
defined('BASEPATH') OR exit('No direct script access allowed');
class Cron extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model');
	}

	public function index() {

		$string = 'https://graph.facebook.com/507458846798175/feed?access_token=DQVJ1X3JxZAlRfM2pWN2I5eFVmVUJBYmhORENMSXM1bjZArbW4yOU13ZAmNYdFlqZA2hITWpQcnJEblg4UzB4bWYtV1BMcngxUE8xR2Q3SEI1WWk2bEdDX0toV0xFNVg5LXBnazV1Q1lmRHFNRHl1d1ZATeW9MaVMtdTBKckoyejQtX1lDTVRVc3poOWNTamx0d2RQRGtGeGtmVExRUDRTRi1ybl9Ub0liZAXlORU9VZAjVjaUlZAa1VvRDJMSWxQSUtkdjRWQ2xVWWNn&limit=100';
		$data = $this->curlExecute($string);
		//echo "<pre>";
		foreach ($data->data as $key => $value) {
			$id = explode('_', $value->id);
			$id = $id[1];
			if(isset($value->message)){
				
				$string = 'https://graph.facebook.com/'.$id.'?fields=from,permalink_url,likes,attachments,created_time,updated_time&access_token=DQVJ1X3JxZAlRfM2pWN2I5eFVmVUJBYmhORENMSXM1bjZArbW4yOU13ZAmNYdFlqZA2hITWpQcnJEblg4UzB4bWYtV1BMcngxUE8xR2Q3SEI1WWk2bEdDX0toV0xFNVg5LXBnazV1Q1lmRHFNRHl1d1ZATeW9MaVMtdTBKckoyejQtX1lDTVRVc3poOWNTamx0d2RQRGtGeGtmVExRUDRTRi1ybl9Ub0liZAXlORU9VZAjVjaUlZAa1VvRDJMSWxQSUtkdjRWQ2xVWWNn';
				$data = $this->curlExecute($string);
				$date_posted = date('Y-m-d H:i:s',strtotime($data->created_time));
				$link = 'https://unilab.facebook.com/groups/325111411161147';
				if(isset($data->permalink_url)){
					$link = $data->permalink_url;
				}

				$data_array = array(
					'post_id' => $id,
					'title' => $value->message,
					'date_posted' => $date_posted,
					'post_link' => $link,
					'generated_date' => date('Y-m-d'),
					'type' => 3
					);
				//print_r($data);
				$checkifExisit = $this->model->checkifExisit('workplace_posts','post_id = '.$id);
				if($checkifExisit[0]->count == 0){
					$this->model->insert_data('workplace_posts',$data_array);
				}
				else{
					$this->model->update_data('workplace_posts',$data_array,"post_id = ".$id);
				}
			}
			
		}
		
	}
	function curlExecute($string) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_URL, $string);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$api_response = trim(curl_exec($ch));
		$api_response_info = curl_getinfo($ch);
		curl_close($ch);

		$api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
		$api_response_body = substr($api_response, $api_response_info['header_size']);

		return json_decode($api_response_body);
		
	}

}

