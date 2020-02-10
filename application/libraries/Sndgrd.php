<?php
class Sndgrd {

	public function send($data)
	{
        $CI =& get_instance();
        $email_config = $CI->load->details('cms_email_config', 1);
        //$details = $CI->load->details('cms_preference', 1);
        $from_email = $email_config[0]->sendgrid_from_email;
        $from_name = $email_config[0]->sendgrid_from_name;
        $token = $email_config[0]->sendgrid_token;

        $replyTo        = $data['from'];
        $replyTo_name   = $data['from_name'];
        $sendTo         = $data['to'];
        $subject        = $data['subject'];
        $content        = $data['content'];

		require 'vendor_sndgrd/autoload.php';
        $email = new \SendGrid\Mail\Mail(); 
		
        $email->setFrom($from_email, $from_name);
        $email->setReplyTo($replyTo, $replyTo_name);
        $email->setSubject($subject);
        $email->addTo($sendTo);
        $email->addContent("text/html", $content);
        $sendgrid = new \SendGrid($token); 
        try {
			$response = $sendgrid->send($email);
            return $response->statusCode();
        } catch (Exception $e) {
            return 'Caught exception: '. $e->getMessage() ."\n";
        }
	}
}