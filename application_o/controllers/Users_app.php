<?php
class Users_app extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
    }
    public function index(){
        $data['admin_id'] = $this->input->get_post('admin_id');
        $data['ifsc_code'] = $this->input->get_post('ifsc_code');
        $data['account_holder_name'] = $this->input->get_post('account_holder_name');
        $data['bank_name'] = $this->input->get_post('bank_name');
        $data['branch_address'] = $this->input->get_post('branch_address');
        $data['users_id'] = $this->input->get_post('users_id');
        $data['account_no'] = $this->input->get_post('account_no');
        if($this->api_model->get_data('users_id = '.$data['users_id'].'', 'users_bank_detial')){
            if($this->api_model->get_data_update('id = '.$id.'','users_bank_detial', $data)){
                $json['data'] = $this->api_model->get_data('id = '.$id.'', 'users_bank_detial');
                $json['success'] = true;
                $json['msg'] = 'Successfully Updated';
            }else{
                $json['success'] = false;
                $json['error'] = 'Database Error';
            }
        }else{
            if($id = $this->api_model->submit('users_bank_detial', $data)){
                $json['data'] = $this->api_model->get_data('id = '.$id.'', 'users_bank_detial');
                $json['success'] = true;
                $json['msg'] = 'Successfully Added';
            }else{
                $json['success'] = false;
                $json['error'] = 'Database Error';
            }
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function update(){
        $id = $this->input->get_post('id');
        $ifsc_code = $this->input->get_post('ifsc_code');
        if($ifsc_code!= ''){
            $data['ifsc_code'] = $ifsc_code;
        }
        $account_holder_name = $this->input->get_post('account_holder_name');
        if($account_holder_name != ''){
            $data['account_holder_name'] = $account_holder_name; 
        }
        $bank_name = $this->input->get_post('bank_name');
        if($bank_name != ''){
            $data['bank_name'] = $bank_name;
        }
        $branch_address = $this->input->get_post('branch_address');
        if($branch_address != ''){
            $data['branch_address'] = $branch_address;
        }
        $users_id = $this->input->get_post('users_id');
        if($users_id != ''){
            $data['users_id'] = $users_id;
        }
        $account_no = $this->input->get_post('account_no');
        if($account_no != ''){
            $data['account_no'] = $this->input->get_post('account_no');
        }
        if($this->api_model->get_data_update('id = '.$id.'','users_bank_detial', $data)){
            $json['data'] = $this->api_model->get_data('id = '.$id.'', 'users_bank_detial');
            $json['success'] = true;
        }else{
            $json['success'] = false;
            $json['error'] = 'Database Error';
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function get_bank_detail(){
        $users_id = $this->input->get_post('users_id');
        if($data = $this->api_model->get_data('users_id = '.$users_id.'', 'users_bank_detial')){
            $json['success'] = true;
            $json['data'] = $data;
        }else{
            $json['success'] = false;
            $json['error'] = 'Currently you have not added your bank details';
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
}