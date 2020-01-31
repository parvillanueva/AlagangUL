<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRS_Api extends CI_Controller {

    public function registration() 
    {
        $this->load->model('Global_model');
        $this->load->model('CRS_model');

        $data = $this->Global_model->get_list_all('pckg_crs_config');

        foreach ($data as $key => $val) {
            $_POST['host'] = $val->host;
            $_POST['token'] = $val->token;
        }

        $api = $this->CRS_model->check_api_exist($_POST['host'],$_POST['token']);

        if ($api == 0) {
            echo json_encode(array('status'=>'error', 'message'=>'Invalid Token'));
        } else {

            if ($this->input->post('email') !== NULL) {
                $email = $this->input->post('email');
            } else {
                $email = "";
            }

            if ($this->input->post('mobile') !== NULL) {
                $mobile = $this->input->post('mobile');
            } else {
                $mobile = "";
            }

            if ($this->input->post('gender') !== NULL) {
                $gender = $this->input->post('gender');
            } else {
                $gender = 0;
            }

            ($gender == 1) ? $gender = 1 : $gender = 0;
            
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'email' => $email,
                'civil_status' => $this->input->post('civil_status'),
                'gender' => $gender,
                'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                'mobile' => $mobile,
                'registration_date' => date('Y-m-d H:i:s')
            );
            
            $tbl_name = 'pckg_crs_users';

            $count = $this->CRS_model->check_signup($email, $mobile);
            if ($count > 0) {
                $this->CRS_model->update_data($data,$tbl_name, $email);
                echo json_encode(array('status'=>'success', 'message'=>'Successfully Updated'));
                // redirect(base_url().'sign-up');
            } else {
                $this->CRS_model->insert_data($data);
                echo json_encode(array('status'=>'success', 'message'=>'Successfully Added'));
                // redirect(base_url().'sign-up');
            }       
            
        }

    }
    

}
