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

					if(strpos($select, '*') !== false){
						$data = array('message' => "Asterisk is not allowed!");
						echo json_encode($data);
						break;
					}

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
					$this->db->trans_start();
					$table = $_POST['table'];
					$data = $_POST['data'];
					$id = $this->Global_model->save_data($table,$data);
					//insert audit trail
					$this->audit_trail_controller("Create", $data);
					$this->db->trans_complete();
					if ($this->db->trans_status() === FALSE) {
		               return "Query Failed";
		           	} else {
		               echo $id;
		           	}
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

				if(strpos($select, '*') !== false){
					$data = array('message' => "Asterisk is not allowed!");
					echo json_encode($data);
					break;
				}
				
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

	public function get_analytics()
	{
		$url = $_POST['url'];
		
		
		$table = "site_analytics";
		$select =  "count(id), datetime";

		$limit =  1;
		$offset = 1;
		$order_field = "datetime";
		$order_type = "desc";
		$join =null;
		$group= "CAST(datetime AS DATE)";

		
		$array = array();
		$key = array();

        $count = 0;
        $date = new DateTime();
        for ($i=1; $i <= $_POST['days'] ; $i++) { 
            $count ++ ;
            $date->modify('-1 day');
            $query = "datetime like '" . $date->format('Y-m-d') . "%'";
            if($url != ""){
                $query = "url = '" . $url . "' AND datetime like '" . $date->format('Y-m-d') . "%'";
            }

            $result_data = $this->Global_model->get_data_list($table, $query, $limit, ($offset - 1) * $limit, $select,$order_field,$order_type, $join, $group);

            if(count($result_data) > 0){
                foreach ($result_data as $key => $value) {
                    $array[] = array(
                        "date"=>$date->format('Y-m-d'),
                        "global"=> $this->get_analytics_count($url, "global", $value->datetime),
                        "unique"=> $this->get_analytics_count($url, "unique", $value->datetime),
                        "daily"=> $this->get_analytics_count($url, "daily", $value->datetime),
                    );
                }
            } else {
                $array[] = array(
                    "date"=>$date->format('Y-m-d'),
                    "global"=> 0,
                    "unique"=> 0,
                    "daily"=> 0,
                );
            }
            


        }


		

		$keys[] = array("keys"=>"global");
		$keys[] = array("keys"=>"unique");
		$keys[] = array("keys"=>"daily");



        echo json_encode($array);
		

	}

	public function get_analytics_count($url, $type, $date)
	{
		if($url != ""){
			$query = "url = '".$url."' AND type = '" . $type . "' AND datetime like '%" . date("Y-m-d",strtotime($date)) . "%'";
		} else {
			$query = "type = '" . $type . "' AND datetime like '%" . date("Y-m-d",strtotime($date)) . "%'";
		}

		$table = "site_analytics";
		$select =  "id, unid, url, datetime, browser, type";

		$limit =  99999;
		$offset = 1;
		$order_field = "datetime";
		$order_type = "asc";
		$join =null;
		$group= null;

		$result_data = $this->Global_model->get_data_list($table, $query, $limit, ($offset - 1) * $limit, $select,$order_field,$order_type, $join, $group);
		return count($result_data);
	}

	public function captcha_ci()
	{	
        $cap = create_captcha();
        echo json_encode(
        	array(
				'cpt_val' => sha1($cap['word']), 
				'cpt_image' => $cap['image']
			)
		);
	}

    function send_contact_us_email_notif()
    {

		$sender_full_name = $_POST['contact_us_full_name'];

		$this->load->library('email');

		$email_notif_enabled_admins = $this->Global_model->email_notif_enabled_admins('notif_contactus');

		$data = $_POST;

		$message_admin = '
			<p>Hi Admin,</p><br><p>We have received a new user trying to contact us. Please see details below:</p><br>
			<h3>Personal Information</h3>
	        <table style="width:100%;">
	            <tr>
	                <td style="width: 20%;">First Name:</td>
	                <td style="width: 80%;">'. $data['contact_us_first_name'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Middle Name:</td>
	                <td style="width: 80%;">'. $data['contact_us_middle_name'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Last Name:</td>
	                <td style="width: 80%;">'. $data['contact_us_last_name'].'</td>
	            </tr>
	        </table>

	        <h3>Contact Information</h3>

	        <table style="width:100%;">
	            <tr>
	                <td style="width: 20%;">Email Address:</td>
	                <td style="width: 80%;">'. $data['contact_us_email_address'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Mobile Number:</td>
	                <td style="width: 80%;">'. $data['contact_us_mobile_number'].'</td>
	            </tr>
	        </table>

	        <br><br>
	        Thank you!
        ';

		$subject = 'Contact Us';
		$message = '<p>Hi Admin,</p><br><br><p>We have received a new user trying to contact us. Please see details below:</p><br>';
		$message_user = '<h3>Hi '.ucfirst($sender_full_name).'</h3><p>You recently sent a contact us inquiry.</p><br><p>Thank you!</p><br><p>This is a system generated email. Do not reply.</p>';

		$message_user2 = '
			<table width="100%" cellpadding="0" cellspacing="0" height="75%">
			    <tbody>
			        <tr height="10%"><td colspan="3" style="background: #06243e; font-size: 22px/1.25em;"><p>&nbsp;</p><p>&nbsp;</p></td></tr>
			        <tr height="80%">
			            <td width="15%" style="background: #06243e;"></td>
			            <td style="background: #06243e;">
			                <table style="border:2px solid #fde101;" width="100%">
			                    <tbody>
			                        <tr style="font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica;">
			                            <td style="border-top-left-radius:4px;border-top-right-radius:4px;background:#06243e;padding:17px 18px;border-bottom-left-radius:4px;border-bottom-right-radius:4px;">
			                                <center><h1 style="font-size:30px;color:#fde101;text-align: center;">Contact Us</h1></center>
			                                <br>
			                                <p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#FFF; text-align: center;">Once again, thank you for contacting us.</p>
			                                <p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#FFF;text-align: center;">We' . "'" . 'll get back to you as soon as possible.</p>
			                                <!--<p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#FFF; text-align: center;">your sign up request to our website.</p>-->
			                                <br>
			                                <p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#FFF;">Regards,</p>
			                                <p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#fde101;"><b>Website Team</b></p>
			                            </td>
			                        </tr>
			                    </tbody>
			                </table>
			            </td>
			            <td width="15%" style="background: #06243e;"></td>
			        </tr>
			        <tr height="10%"><td colspan="3" style="background: #06243e; font-size: 22px/1.25em;"><p>&nbsp;</p><p>&nbsp;</p></td></tr>
			    </tbody>
			</table>';

			// Get full html:
		$body = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
				    <title>' . html_escape($subject) . '</title>
				    <style type="text/css">
				        body {
				            font-family: Arial, Verdana, Helvetica, sans-serif;
				            font-size: 16px;
				        }
				    </style>
				</head>
				<body>
				' . $message_admin . '
				</body>
			</html>';
			// Also, for getting full html you may use the following internal method:
			//$body = $this->email->full_html($subject, $message);

		$body_user = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
				    <title>' . html_escape($subject) . '</title>
				    <style type="text/css">
				        body {
				            font-family: Arial, Verdana, Helvetica, sans-serif;
				            font-size: 16px;
				        }
				    </style>
				</head>
				<body>
				' . $message_user2 . '
				</body>
			</html>';
			// Also, for getting full html you may use the following internal method:
			//$body = $this->email->full_html($subject, $message);

		$email['to_email'] = $_POST['contact_us_email_address'];
		$email['subject'] = $subject;
		$email['body'] = $body_user;
		$this->send->email($email);

        foreach ($email_notif_enabled_admins as $value) {

        	$email['to_email'] = $value->email;
			$email['subject'] = $subject;
			$email['body'] = $body;
			$result = $this->send->email($email);

        }

		echo json_encode($result);
    }

    function send_sign_up_email_notif()
    {

		$sender_full_name = $_POST['sign_up_full_name'];

		$this->load->library('email');

		$email_notif_enabled_admins = $this->Global_model->email_notif_enabled_admins('notif_signup');

		$data = $_POST;

		$message_admin = '
			<p>Hi Admin,</p><br><p>We have received a new sign up request. Please see details below:</p><br>
			<h3>Personal Information</h3>
	        <table style="width:100%;">
	            <tr>
	                <td style="width: 20%;">First Name:</td>
	                <td style="width: 80%;">'. $data['sign_up_first_name'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Middle Name:</td>
	                <td style="width: 80%;">'. $data['sign_up_middle_name'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Last Name:</td>
	                <td style="width: 80%;">'. $data['sign_up_last_name'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Civil Status:</td>
	                <td style="width: 80%;">'. $data['sign_up_civil_status'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Gender:</td>
	                <td style="width: 80%;">'. $data['sign_up_gender'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Birthdate:</td>
	                <td style="width: 80%;">'. $data['sign_up_birthday'].'</td>
	            </tr>
	        </table>

	        <h3>Contact Information</h3>

	        <table style="width:100%;">
	            <tr>
	                <td style="width: 20%;">Email Address:</td>
	                <td style="width: 80%;">'. $data['sign_up_email_address'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Mobile Number:</td>
	                <td style="width: 80%;">'. $data['sign_up_mobile_number'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Country:</td>
	                <td style="width: 80%;">'. $data['sign_up_country'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Region:</td>
	                <td style="width: 80%;">'. $data['sign_up_region'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">Province:</td>
	                <td style="width: 80%;">'. $data['sign_up_province'].'</td>
	            </tr>
	            <tr>
	                <td style="width: 20%;">City:</td>
	                <td style="width: 80%;">'. $data['sign_up_city'].'</td>
	            </tr>
	        </table>

	        <br><br>
	        Thank you!
        ';

		$subject = 'Sign Up Request';
		$message = '<p>Hi Admin,</p><br><br><p>We have received a new sign up request. Please see details below:</p><br>';
		$message_user = '<h3>Hi '.ucfirst($sender_full_name).'</h3><p>You recently sent us a sign up request.</p><br><p>Thank you!</p><br><p>This is a system generated email. Do not reply.</p>';

		$message_user2 = '
			<table width="100%" cellpadding="0" cellspacing="0" height="75%">
			    <tbody>
			        <tr height="10%"><td colspan="3" style="background: #06243e; font-size: 22px/1.25em;"><p>&nbsp;</p><p>&nbsp;</p></td></tr>
			        <tr height="80%">
			            <td width="15%" style="background: #06243e;"></td>
			            <td style="background: #06243e;">
			                <table style="border:2px solid #fde101;" width="100%">
			                    <tbody>
			                        <tr style="font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica;">
			                            <td style="border-top-left-radius:4px;border-top-right-radius:4px;background:#06243e;padding:17px 18px;border-bottom-left-radius:4px;border-bottom-right-radius:4px;">
			                                <center><h1 style="font-size:30px;color:#fde101;text-align: center;">Sign Up</h1></center>
			                                <br>
			                                <p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#FFF; text-align: center;">Once again, thank you for signing up to our website!</p>
			                                <p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#FFF;text-align: center;">Click <a href="' . base_url() . 'account_activation/' . $data['sign_up_token'] . '">here</a> to activate your account. </p>
			                                <!--<p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#FFF; text-align: center;">your sign up request to our website.</p>-->
			                                <br>
			                                <p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#FFF;">Regards,</p>
			                                <p style="font:22px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#fde101;"><b>Website Team</b></p>
			                            </td>
			                        </tr>
			                    </tbody>
			                </table>
			            </td>
			            <td width="15%" style="background: #06243e;"></td>
			        </tr>
			        <tr height="10%"><td colspan="3" style="background: #06243e; font-size: 22px/1.25em;"><p>&nbsp;</p><p>&nbsp;</p></td></tr>
			    </tbody>
			</table>';

			// Get full html:
		$body = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
				    <title>' . html_escape($subject) . '</title>
				    <style type="text/css">
				        body {
				            font-family: Arial, Verdana, Helvetica, sans-serif;
				            font-size: 16px;
				        }
				    </style>
				</head>
				<body>
				' . $message_admin . '
				</body>
			</html>';
			// Also, for getting full html you may use the following internal method:
			//$body = $this->email->full_html($subject, $message);

		$body_user = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
				    <title>' . html_escape($subject) . '</title>
				    <style type="text/css">
				        body {
				            font-family: Arial, Verdana, Helvetica, sans-serif;
				            font-size: 16px;
				        }
				    </style>
				</head>
				<body>
				' . $message_user2 . '
				</body>
			</html>';
			// Also, for getting full html you may use the following internal method:
			//$body = $this->email->full_html($subject, $message);

		$email['to_email'] = $_POST['sign_up_email_address'];
		$email['subject'] = $subject;
		$email['body'] = $body_user;
		$this->send->email($email);

        foreach ($email_notif_enabled_admins as $value) {

        	$email['to_email'] = $value->email;
			$email['subject'] = $subject;
			$email['body'] = $body;
			$result = $this->send->email($email);

        }

		echo json_encode($result);
    }

    public function check_database()
	{

	    ini_set('display_errors', 'Off');
	    
	    if(file_exists($file_path = APPPATH.'config/database.php'))
	    {
	        include($file_path);
	    }
	    
	    $config = $db[$active_group];

	    if( $config['dbdriver'] === 'mysqli' )
	    {
	        $mysqli = new mysqli( $_POST['hostname'] , $_POST['username'] , $_POST['password']);
	        if( !$mysqli->connect_error )
	        {
	            $mysqli->close();
	            if($mysqli->affected_rows >= 0){
	            	echo "success";	
	            }else{
	            	echo "failed";
	            }
	        }else{
	        	echo "failed";
	        }
	        
	        $mysqli->close();
	    }
	    
	}

}
