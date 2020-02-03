<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {

	function check_email(){
		$this->load->model('content_management/Global_model');
		echo json_encode(count($this->Global_model->check_email($_POST['email'])));
	}

	function send_email(){
		$this->load->model('content_management/Global_model');
		$this->load->library('email');
		$users = $this->Global_model->check_email($_POST['email']);

        $details = $this->get_cms_user_details($_POST['email']);
        $activation_token = $this->token($details[0]->id, $details[0]->email);

		$subject = 'Forgot Password';
        $content1 = 'You recently requested to reset your password for your Content Management Account. 
        <br><br>
        Thank you!';
		

        $body = '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#3e3e3e3e;padding:0;margin:0;width:100%;font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica"> 
                <tbody>
                    <tr width="100%"> 
                        <td valign="top" align="left" style="background:#3e3e3e3e;font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica"> 
                            <table style="border:none;padding:0 18px;margin:50px auto;width:730px"> 
                                <tbody>
                                    <tr width="100%" height="57"> 
                                        <td valign="top" align="left" style="border-top-left-radius:4px;border-top-right-radius:4px;background:#3B3B3B;padding:17px 18px;text-align:center">
                                            <h1 style="font-size:20px;margin:0;color:#fff">Content Management</h1>
                                        </td> 
                                    </tr>
                                    <tr width="100%"> 
                                        <td valign="top" align="left" style="border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#fff;padding:18px"> 
                                            <h1 style="font-size:20px;margin:0;color:#333">Hi '.$users[0]->name .', </h1>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333">' . $content1 . '</p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333">
                                                <a href="'.base_url("content_management/login/reset_password").'/'.$activation_token.'" style="border-radius:3px;background:#3B3B3B;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:250px;text-align:center" target="_blank"> Reset Password </a>
                                            </p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333;text-align: center;">or you may copy this url: ' . base_url("content_management/login/reset_password") .'/'.$activation_token. '</p>
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
            
        $this->config->load('email');
        $email = $this->config->item("default_email");

		$result = $this->email
			->from($email)
		    ->to($_POST['email'])
		    ->subject($subject)
		    ->message($body)
		    ->send();

		echo json_encode($result);

	}

    public function token($user_id, $user_email)
    {
        $salt = md5('Unilab CMS' . date('Y-m-d H:i:s'));
        $token = md5($user_email . $salt);
        $data = array(
            "token"=>$token,
            "redirect"=>"content_management/login/reset_password",
            "user_id"=>$user_id,
            "status"=>0,
            "create_date"=>date('Y-m-d H:i:s'),
            "expire_date"=>date('Y-m-d H:i:s', strtotime("+24 hours"))
        );
        $this->Global_model->save_data("cms_site_token",$data);
        return $token;
    }

    public function get_cms_user_details($email)
    {

        $select =  "id, username, email, name, password, create_date, update_date, status, notif_signup, notif_contactus, role";
        $limit = 99999;
        $offset = 1;
        $join = null;
        $group= null;
        $query = "email ='" . $email . "' AND status > 0";

        $result_data = $this->Global_model->get_data_list("cms_users", $query, $limit, ($offset - 1) * $limit, $select,null,null, $join, $group);
        return $result_data;
    }

    public function change_password()
    {
        $this->load->model('content_management/Global_model');
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $user_id = $_POST['user_id'];

        $redirect = base_url("content_management/login");

        if($password1 != $password2){
            $message = "Password not matched!";
            $success = false;
        }
        elseif(count($this->Global_model->get_historical_passwords($user_id, sha1($password1))) > 0){
            $message = "You have already used this password. Please try something new.";
            $success = false;
        }
        else{
            $user = array(
                            'password' => sha1($password1),
                            'update_date' => date('Y-m-d H:i:s')
                         );
            $data2 = array( 'user_id' => $user_id, 'password' => sha1($password1) ); //historical

            $this->Global_model->update_data("cms_users",$user,"id",$user_id);
            $this->Global_model->save_data("cms_historical_passwords", $data2); //historical

            $message = "Password reset complete! <a href='".$redirect."' class='btn btn-primary btn-click-login'> Click here to Login</a>";
            $success = true;
        }

        echo json_encode(array("success"=>$success, "message"=>$message));
    }


    public function send_email_sample_format($email,$subject,$message){

        $this->config->load('email');
        $smtp_user = $this->config->item('smtp_user');
        $smtp_pass = $this->config->item('smtp_pass');
    
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => $smtp_user, 
          'smtp_pass' => $smtp_pass, 
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($smtp_user, 'Sample Email');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send()){
            echo $smtp_user;
        }else{
            show_error($this->email->print_debugger());
        }

    }

    public function send_email_test() 
    {

        $email="marclesterlagunday@gmail.com";
        $subject="Your subject";
        $message="You can write html tags in this message";
        $this->send_email_sample_format($email,$subject,$message);
    }

    public function email_template(){
        $content1 = 'You recently requested to reset your password for your Content Management Account. 
        <br><br>
        Thank you!';

        $body = '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#3e3e3e3e;padding:0;margin:0;width:100%;font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica"> 
                <tbody>
                    <tr width="100%"> 
                        <td valign="top" align="left" style="background:#3e3e3e3e;font:15px &apos;Helvetica Neue&apos;,Arial,Helvetica"> 
                            <table style="border:none;padding:0 18px;margin:50px auto;width:730px"> 
                                <tbody>
                                    <tr width="100%" height="57"> 
                                        <td valign="top" align="left" style="border-top-left-radius:4px;border-top-right-radius:4px;background:#3B3B3B;padding:17px 18px;text-align:center">
                                            <h1 style="font-size:20px;margin:0;color:#fff">Content Management</h1>
                                        </td> 
                                    </tr>
                                    <tr width="100%"> 
                                        <td valign="top" align="left" style="border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#fff;padding:18px"> 
                                            <h1 style="font-size:20px;margin:0;color:#333">Hi Administrator, </h1>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333">' . $content1 . '</p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333">
                                                <a href="'.base_url("content_management/login").'" style="border-radius:3px;background:#3B3B3B;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:250px;text-align:center" target="_blank"> Login to CMS </a>
                                            </p>
                                            <p style="font:15px/1.25em &apos;Helvetica Neue&apos;,Arial,Helvetica;color:#333;text-align: center;">or you may copy this url: ' . base_url("content_management/login"). '</p>
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

            echo $body;
    }


}