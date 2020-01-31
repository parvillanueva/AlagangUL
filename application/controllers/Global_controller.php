<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_controller extends CI_Controller {

	public function index()
	{
		switch ($_POST['event']) { 
			case 'list':
				try { 
					$query = $_POST['query'];
					$table = $_POST['table'];
					$select =  $_POST['select'];
					$limit = isset($_POST['limit'])? $_POST['limit'] : 99999;
					$offset = isset($_POST['offset'])? $_POST['offset'] : 1;
					$order_field = isset($_POST['order']['field'])? $_POST['order']['field'] : null;
					$order_type = isset($_POST['order']['order']) ? $_POST['order']['order']: null;
					$join = isset($_POST['join']) ? $_POST['join']: null;
					$group= isset($_POST['group']) ? $_POST['group']: null;
					$result_data = $this->Global_model->get_data_list($table, $query, $limit, ($offset - 1) * $limit, $select,$order_field,$order_type, $join, $group);

			        echo json_encode($result_data);
			    } catch (Error $e) {
	        		echo "Error displaying a list from database: " . $e->getMessage();
				}
			break;

			case 'insert':
				try { 
					$table = $_POST['table'];
					$data = $_POST['data'];
					$id = $this->Global_model->save_data($table,$data);
					//insert audit trail
					$this->audit_trail_controller("Create", $data);
					echo $id;
				} catch (Exception $e) {
	        		echo "Error adding data: " . $e->getMessage();
				}
			break;

			case 'update':
				try { 
					$table = $_POST['table'];
					$field = $_POST['field'];
					$where = $_POST['where'];
					$data = $_POST['data'];

					//get old data for audit trail
					$query = $field . " = " . $where;
					$old_data = $this->Global_model->get_data_list($table, $query, 1, 0, "*" ,null,null,null);

					//update new data
					$status = $this->Global_model->update_data($table,$data,$field,$where);
					echo $status;	
		 
	                //insert audit trail	 
	                if(isset($data['status'])){
	                    if($data['status'] == -2){
	                        $this->audit_trail_controller("Delete", $data, $old_data);    
	                    } else {
	                        $this->audit_trail_controller("Update", $data, $old_data);
	                    }
	                } else {
	                	$this->audit_trail_controller("Update", $data, $old_data);
	                }
	            } catch (Exception $e) {
	        		echo "Error updating data: " . $e->getMessage();
				}
			break;

			case 'delete':
				try { 
					$table = $_POST['table'];
					$id = $_POST['id'];

					//get old data for audit trail
					$query = "id = " . $id;
					$old_data = $this->Global_model->get_data_list($table, $query, 1, 0, "*" ,null,null,null);

					//delete data
					$status = $this->Global_model->delete_data($table,$id);
					echo $status;

					//insert audit trail
					$this->audit_trail_controller("Remove", null, $old_data);
				} catch (Exception $e) {
	        		echo "Error deleting data: " . $e->getMessage();
				}
			break;

			case 'pagination':
				$query = $_POST['query'];
				$table = $_POST['table'];
				$select =  $_POST['select'];
				$limit = isset($_POST['limit'])? $_POST['limit'] : 99999;
				$offset = 1;
				$order_field = isset($_POST['order']['field'])? $_POST['order']['field'] : null;
				$order_type = isset($_POST['order']['order']) ? $_POST['order']['order']: null;
				$join = isset($_POST['join']) ? $_POST['join']: null;

				$result_data = $this->Global_model->get_data_list($table, $query, 9999999, ($offset - 1) * 9999999, $select,$order_field,$order_type, $join);
				$result_return = array(
					"total_record"=> count($result_data),
					"total_page"=>ceil(count($result_data) / 10)
				);

				echo json_encode($result_return);
				break;
		
		}
		
	}

	public function audit_trail_controller($action, $new_data = null, $old_data = null)
	{
	    $data2['user_id'] = $this->session->userdata('sess_uid');
	  	$data2['url'] =str_replace(base_url("content_management") . '/', "", $_SERVER['HTTP_REFERER']); ;
	  	$data2['action'] = strip_tags(ucwords($action));
	  	if($new_data != null){
	  		$data2['new_data'] = json_encode($new_data);
	  	}

	  	if($old_data != null){
	  		$data2['old_data'] = json_encode($old_data);
	  	}
	  	
	  	$data2['create_date'] = date('Y-m-d H:i:s'); 
	  	$this->Global_model->save_data('cms_audit_trail',$data2);
	}

	public function audit_trail()
	{
	    $data['user_id'] = $this->session->userdata('sess_uid');
	  	$data['url'] =str_replace(base_url("content_management") . '/', "", rtrim($_POST['uri'],"#")); ;
	  	$data['action'] = strip_tags(ucwords($_POST['action']));
	  	$data['create_date'] = date('Y-m-d H:i:s'); 
	  	$table = 'cms_audit_trail';
	  	$this->Global_model->save_data($table,$data);
	}


	public function contact_us()
	{
		$table = "pckg_contact_us";
		$data = $_POST['data'];
		$id = $this->Global_model->save_data($table,$data);
	}

	public function send_inquiry()
	{
		$this->load->library('email');
		$this->config->load('email');
        $default_email = $this->config->item('default_email');
        $site_information = $this->load->details('site_information', 1);

        $site_name = $site_information[0]->title;
        $subject = 'Contact Us - '.$site_information[0]->title;
  		$title = 'Content Management';

		$data = array(
                'contact_us_first_name' => $this->input->post('firstname'),
                'contact_us_middle_name' => $this->input->post('middlename'),
                'contact_us_last_name' => $this->input->post('lastname'),
                'contact_us_email_address' => $this->input->post('email'),
               	'contact_us_mobile_number' => $this->input->post('mobile'),
                'contact_us_inquiry_type' => $this->input->post('inquiry_type'),
                'contact_us_inquiry' => $this->input->post('message'),
                'contact_us_offers' => $this->input->post('offers'),
                'status' => 1,
                'create_date' => date('Y-m-d H:i:s')
        );

        //set content
        $content = '
        	<p>We have received a new inquiry. Please see details below:</p>
        	<br>
            <table style="width:100%;">
                <tr>
                    <td style="width: 20%;"><b>Name</b></td>
                    <td style="width: 80%;">'. $data['contact_us_first_name'] .' '. $data['contact_us_middle_name'] .' '. $data['contact_us_last_name'] .'</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><b>Email Address</b></td>
                    <td style="width: 80%;">'. $data['contact_us_email_address'] .'</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><b>Mobile Number</b></td>
                    <td style="width: 80%;">'. $data['contact_us_mobile_number'] .'</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><b>Inquiry Type</b></td>
                    <td style="width: 80%;">'. $data['contact_us_inquiry_type'] .'</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><b>Message</b></td>
                    <td style="width: 80%;">'. $data['contact_us_inquiry'] .'</td>
                </tr>
                <tr>
                    <td style="width: 20%;"><b>Inquiry Date</b></td>
                    <td style="width: 80%;">'. date('F j, Y') .'</td>
                </tr>
            </table>
            <br>
        ';

        //get all admin email with notification contact us is active
        $email_list = $this->load->all_list("cms_users", "notif_contactus = 1 AND status = 1 AND role IN (6, 7)");


        /* Send Emails to Admins */
        foreach ((array)$email_list as $key => $value) {
        	$body = $this->email_body($title, $value->name, $content, true);

            $result = $this->email
			->from($default_email)
		    ->to($value->email)
		    ->subject($subject)
		    ->message($body)
		    ->send();
        }

        $content_user = '<p>We have successfully received your inquiry. We&#39;ll reply as soon as we can!
        				 <br>
                         <br>
        				 Thank you very much!
 						 <br>
 						 <br>       				 
        				 Regards,
        				 <br>
        				 <br>
        				 The '.$site_name.' Website Team</p>';
        $body_user = $this->email_body($site_name, $data['contact_us_first_name'], $content_user);

        /* Send Email to Site User */
        $result = $this->email
			->from($default_email)
		    ->to($data['contact_us_email_address'])
		    ->subject($subject)
		    ->message($body_user)
		    ->send();

        /* Save Data */
        echo $this->Global_model->save_data('pckg_contact_us', $data);
	}

	public function email_body($title, $user, $content, $login = false){

		$login_button = '';

		if($login){
			$login_button = '<p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333">
                                <a href="'.base_url("content_management/login").'" style="border-radius:3px;background:#3B3B3B;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:250px;text-align:center" target="_blank"> Login </a>
                            </p>';
		}

        $body = '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#3e3e3e3e;padding:0;margin:0;width:100%;font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica"> 
                <tbody>
                    <tr width="100%"> 
                        <td valign="top" align="left" style="background:#3e3e3e3e;font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica"> 
                            <table style="border:none;padding:0 18px;margin:50px auto;width:730px"> 
                                <tbody>
                                    <tr width="100%" height="57"> 
                                        <td valign="top" align="left" style="border-top-left-radius:4px;border-top-right-radius:4px;background:#3B3B3B;padding:17px 18px;text-align:center">
                                            <h1 style="font-size:20px;margin:0;color:#fff">'. $title .'</h1>
                                        </td> 
                                    </tr>
                                    <tr width="100%"> 
                                        <td valign="top" align="left" style="border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#fff;padding:18px"> 
                                            <h1 style="font-size:20px;margin:0;color:#333">Hi '.$user .', </h1>
                                            '. $content .'
                                            '. $login_button .'
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#939393;margin-bottom:0; text-align: center;"> Content Management </p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#939393;margin-bottom:0; text-align: center;"> This is a system generated email. Do not reply. </p>
                                        </td> 
                                    </tr>
                                </tbody> 
                            </table> 
                        </td> 
                    </tr>
                </tbody> 
            </table>';


            return $body;
	}

}
