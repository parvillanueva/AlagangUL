<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRS_api extends CI_Controller {

    public function registration() 
    {
        
        $this->load->model('Global_model');
        $this->load->model('CRS_model');
        
        $api = $this->CRS_model->check_api_exist($_POST['hostname'],$_POST['brand_token']);
        
        if ($api == 0) {
            echo json_encode(array('status'=>'error', 'message'=>'Invalid Token'));
        } else {

            if ($this->input->post('email') !== NULL) {
                $email = $this->input->post('email');
            } else {
                $email = "";
            }

            if ($this->input->post('firstname') !== NULL) {
                $firstname = $this->input->post('firstname');
            } else {
                $firstname = "";
            }

            if ($this->input->post('lastname') !== NULL) {
                $lastname = $this->input->post('lastname');
            } else {
                $lastname = "";
            }

            if ($this->input->post('mobile') !== NULL) {
                $mobile = $this->input->post('mobile');
            } else {
                $mobile = "";
            }

            if ($this->input->post('gender') !== NULL) {
                $gender = $this->input->post('gender');
                if ($gender == 1) {
                    $gender = "Male";
                } else if ($gender == 2) {
                    $gender = "Female";
                }
            } else {
                $gender = "";
            }

             if ($this->input->post('dob') !== NULL) {
                $birthdate = date('Y-m-d', strtotime($this->input->post('dob')));
            } else {
                $birthdate = "";
            }

            if ($this->input->post('civil_status') !== NULL) {
                $civil_status = $this->input->post('civil_status');
            } else {
                $civil_status = 0;
            }
            
            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'civil_status' => $civil_status,
                'gender' => $gender,
                'dob' => $birthdate,
                'mobile' => $mobile,
                'status' => 1,
                'orders' => 0,
                'registration_date' => date('Y-m-d H:i:s')
            );
            
            $tbl_name = 'site_signup';

            $count = $this->CRS_model->check_signup($email);
            if ($count > 0) {
                $this->CRS_model->update_data($data,$tbl_name, $email);
                echo json_encode(array('status'=>'success', 'message'=>'Successfully Updated'));
            } else {
                $this->CRS_model->insert_data($data);
                echo json_encode(array('status'=>'success', 'message'=>'Successfully Added'));
            }       
            
        }

    }
    
}
