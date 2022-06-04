<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class App_login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		$this->load->model('loginmodel');
		$this->load->model('pushnoti_model');
	}
	public function index(){
		$id = $this->input->get_post('user_id');
		$login_detail = $this->api_model->get_fcm_user($id);
		if(!empty($login_detail)){
			$login_id = $login_detail[0]['users_id'];
			$login_name = $login_detail[0]['full_name'];
			$status = $login_detail[0]['type'];
			$type = 0;
			$this->session->set_userdata('users_id', $login_id);
			$this->session->set_userdata('user_name', $login_name);
			$this->session->set_userdata('user_type', $type);
			redirect(base_url('frontend/product_listing'));
		}else{
			echo "Please Send Valid Id";
		}
	}
	public function doc_login(){
		$id = $this->input->get_post('doctor_id');
		$login_detail = $this->api_model->doc_detail_id($id);
		if(!empty($login_detail)){
			$login_id = $login_detail[0]['doctor_id'];
			$login_name = $login_detail[0]['username'];
			$status = $login_detail[0]['users_type'];
			$type = 1;
			$this->session->set_userdata('users_id', $login_id);
			$this->session->set_userdata('user_name', $login_name);
			$this->session->set_userdata('user_type', $type);
			redirect(base_url('frontend/product_listing'));
		}else{
			echo "Please Send Valid Id";
		}
	}
	public function category_wise_login(){
		$id = $this->input->get_post('user_id');
		$category_id = $this->input->get_post('category_id');
		$section_id = $this->input->get_post('section_id');
		$sec = $this->api_model->get_data('category = "'.$section_id.'"', 'product_section');
		// print_r($sec);
		// exit;
		$login_detail = $this->api_model->get_fcm_user($id);
		if(!empty($login_detail)){
			$login_id = $login_detail[0]['users_id'];
			$login_name = $login_detail[0]['full_name'];
			$status = $login_detail[0]['type'];
			$type = 1;
			$this->session->set_userdata('users_id', $login_id);
			$this->session->set_userdata('user_name', $login_name);
			$this->session->set_userdata('user_type', $type);
			redirect(base_url('frontend/product_listing/').$category_id.'/'.$sec[0]['id'].'/');
		}else{
			echo "Please Send Valid Id";
		}
	}
	/*public function videos(){
		$id = $this->input->get_post('user_id');
		$login_detail = $this->api_model->get_fcm_user($id);
		if(!empty($login_detail)){
			$login_id = $login_detail[0]['users_id'];
			$login_name = $login_detail[0]['full_name'];
			$status = $login_detail[0]['type'];
			$type = 1;
			$this->session->set_userdata('users_id', $login_id);
			$this->session->set_userdata('user_name', $login_name);
			$this->session->set_userdata('user_type', $type);
			redirect(base_url('all_videos'));
		}else{
			echo "Please Send Valid Id";
		}
	}*/

	public function get_user_auth_tocken(){
		$id = $this->input->get_post('user_id');
		$type = $this->input->get_post('type');
		$users_number = rand(0, 1000000);
		$users_number = $id."_".$users_number;
		$users_tocken = $this->api_model->get_user_auth_tocken($users_number, $type);
		if(!empty($users_tocken)){
			$users_auth_tocken = $users_tocken['users_auth_tocken'];
			$json['data'] = $users_tocken;
			$json['success']  = true; 
		}else{
			$json['success']  = false; 
			$json['error'] = 'Please Send Valid Id';
		}	
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function videos(){
		$id = $this->input->get_post('user_id');
		$login_detail = $this->api_model->get_user_auth_users($id);
		if(!empty($login_detail)){
			if($login_detail[0]['user_type'] == '1'){
				$login_id = $login_detail[0]['users_id'];
				$login_name = $login_detail[0]['full_name'];
				$type = $login_detail[0]['user_type'];
			}elseif($login_detail[0]['user_type'] == '0'){
				$login_id = $login_detail[0]['doctor_id'];
				$login_name = $login_detail[0]['username'];
				$type = $login_detail[0]['user_type'];
			} else {
				$login_id = $login_detail[0]['users_id'];
				$login_name = $login_detail[0]['full_name'];
				$type = 1;
			}
			$this->session->set_userdata('users_id', $login_id);
			$this->session->set_userdata('user_name', $login_name);
			$this->session->set_userdata('user_type', $type);
			redirect(base_url('all_videos'));
		}else{
			echo "Please Send Valid Id";
		}
	}
	public function cart(){
		$id = $this->input->get_post('user_id');
		$login_detail = $this->api_model->get_fcm_user($id);
		if(!empty($login_detail)){
			$login_id = $login_detail[0]['users_id'];
			$login_name = $login_detail[0]['full_name'];
			$status = $login_detail[0]['type'];
			$type = 1;
			$this->session->set_userdata('users_id', $login_id);
			$this->session->set_userdata('user_name', $login_name);
			$this->session->set_userdata('user_type', $type);
			redirect(base_url('frontend/product_cart'));
		}else{
			echo "Please Send Valid Id";
		}
	}
}