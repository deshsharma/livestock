<?php
class Employee_app extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
	}
    public function get_district_manager(){
        if($data = $this->api_model->get_data('type IN ("37","38")', 'admin', '', 'admin_id, referral_code as refral_code, CONCAT(CONCAT(fname," "), lname) as user_name')){
                $json['success']  = true; 
                $json['data'] = $data;
        }else{
                $json['success']  = false; 
                $json['error'] = 'No data found.';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function get_referal_valid(){
        $referral_code = $this->input->get_post('referral_code');
        if($data = $this->api_model->get_data('referral_code = "'.$referral_code.'"', 'admin', '', 'admin_id')){
                $json['success']  = true; 
                $json['admin_id'] = $data[0]['admin_id'];
        }else{
                $json['success']  = false; 
                $json['error'] = 'Please Enter Valid Referral code.';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
}