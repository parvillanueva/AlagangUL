<?php

class Send {

	public function email($data)
	{
		$CI =& get_instance();

        $details = $CI->Global_model->get_by_id("site_information",1);

        $CI->config->load('email');
        $to_email = $data['to_email'];
        $from_name = $details[0]->title;
        $from_email = $CI->config->item("default_email");
        $subject = $data['subject'];
        $body = $data['body'];
        
        $CI->load->library('email');
        $result = $CI->email
                ->from($from_email, $from_name)
                ->to($to_email)
                ->subject($subject)
                ->message($body)
                ->send();

        return $result;
	}
}