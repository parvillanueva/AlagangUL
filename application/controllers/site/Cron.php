<?php
date_default_timezone_set("Asia/Manila");
defined('BASEPATH') OR exit('No direct script access allowed');
class Cron extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index() {

		$string = 'https://graph.facebook.com/507458846798175/feed?access_token=DQVJ1X3JxZAlRfM2pWN2I5eFVmVUJBYmhORENMSXM1bjZArbW4yOU13ZAmNYdFlqZA2hITWpQcnJEblg4UzB4bWYtV1BMcngxUE8xR2Q3SEI1WWk2bEdDX0toV0xFNVg5LXBnazV1Q1lmRHFNRHl1d1ZATeW9MaVMtdTBKckoyejQtX1lDTVRVc3poOWNTamx0d2RQRGtGeGtmVExRUDRTRi1ybl9Ub0liZAXlORU9VZAjVjaUlZAa1VvRDJMSWxQSUtkdjRWQ2xVWWNn&limit=2';
		$data = $this->curlExecute($string);
		foreach ($data->data as $key => $value) {
			$id = explode('_', $value->id);
			$id = $id[1];
			if(isset($value->message)){
				
				$string = 'https://graph.facebook.com/'.$id.'?fields=from,permalink_url,likes,attachments,created_time,updated_time&access_token=DQVJ1X3JxZAlRfM2pWN2I5eFVmVUJBYmhORENMSXM1bjZArbW4yOU13ZAmNYdFlqZA2hITWpQcnJEblg4UzB4bWYtV1BMcngxUE8xR2Q3SEI1WWk2bEdDX0toV0xFNVg5LXBnazV1Q1lmRHFNRHl1d1ZATeW9MaVMtdTBKckoyejQtX1lDTVRVc3poOWNTamx0d2RQRGtGeGtmVExRUDRTRi1ybl9Ub0liZAXlORU9VZAjVjaUlZAa1VvRDJMSWxQSUtkdjRWQ2xVWWNn';
				$data2 = $this->curlExecute($string);
				$likes_count = '';

				if(isset($data2->likes)){
                    $likes_count = count($data2->likes->data);
                }
                $link = 'https://unilab.facebook.com/groups/507458846798175';
				if(isset($data->permalink_url)){
					$link = $data2->permalink_url;
				}
				$user_fb_id = $data2->from->id;
				$post_attachment = '';
				$data_array = array(
					'post_id' 		=>	$id,
					'post_by'		=>	$data2->from->name,
					'date_posted' 	=>  date('Y-m-d H:i:s',strtotime($data2->created_time)),
					'post_message'	=>  $value->message,
					'likes'			=>	$likes_count,
					'post_link'		=>	$link,
					'generated_date'=>	date('Y-m-d H:i:s')
				);



				if(isset($data2->attachments)){
					if(!isset($data2->attachments->data[0]->subattachments)){
						if(isset($data2->attachments->data[0]->media)){
                            $post_image = $data2->attachments->data[0]->media->image->src;
                        }   
					}
					else{
						if(isset($data2->attachments->data[0]->subattachments->data[0]->media)){
                            $post_image = $data2->attachments->data[0]->subattachments->data[0]->media->image->src;
                        }
                        else{
                            $post_image = @$data2->attachments->data[0]->subattachments->data[0]->media->image->src;

                        }      
					}
				}
				$data_array['post_image']= $post_image;

				$string = 'https://graph.facebook.com/'.$user_fb_id.'?fields=picture&access_token=DQVJ1X3JxZAlRfM2pWN2I5eFVmVUJBYmhORENMSXM1bjZArbW4yOU13ZAmNYdFlqZA2hITWpQcnJEblg4UzB4bWYtV1BMcngxUE8xR2Q3SEI1WWk2bEdDX0toV0xFNVg5LXBnazV1Q1lmRHFNRHl1d1ZATeW9MaVMtdTBKckoyejQtX1lDTVRVc3poOWNTamx0d2RQRGtGeGtmVExRUDRTRi1ybl9Ub0liZAXlORU9VZAjVjaUlZAa1VvRDJMSWxQSUtkdjRWQ2xVWWNn';
				$data3 = $this->curlExecute($string);

				$user_img = $data3->picture->data->url;
				$data_array['post_by_img']= $data3->picture->data->url;

				$checkifExisit = $this->Gmodel->get_query('tbl_workplace_feed','post_id = '.$id);
				if(count($checkifExisit)== 0){
					$this->Gmodel->save_data('tbl_workplace_feed',$data_array);
				}
				else{
					$this->Gmodel->update_data('tbl_workplace_feed',$data_array,"post_id", $id);
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

