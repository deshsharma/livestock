<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unproductive_animals extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		$this->load->model('loginmodel');
		$this->load->model('pushnoti_model');
		$this->load->model('front_end_model');
        $this->load->model('Admin_detail');
		$this->load->library('form_validation');
        date_default_timezone_set('Asia/Calcutta');
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
    }
	
	public function index(){
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/unproductive_animals');
		$this->load->view('admin/layouts/admin_footer');
		//echo "Hello"; die;
       /*  $this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/evaluation');
		$this->load->view('admin/layouts/admin_footer'); */
    } 
	
    public function put_unproductive_animals(){
		 $state_id = $this->input->get_post('state_id');
		 $district_id = $this->input->get_post('district_id');
		 $address = $this->input->get_post('address');
		 $age_year = $this->input->get_post('age_year');
		 $age_month	 =  $this->input->get_post('age_month');
		 $photo_path = $this->input->get_post('photo_path');
		 $user_id = $this->input->get_post('user_id');
		 $contact_name =$this->input->get_post('contact_name'); 	
		 $contact_phone =$this->input->get_post('contact_phone'); 	
		 $weight =$this->input->get_post('weight'); 	
		 $gender =$this->input->get_post('gender'); 	
		 $state_name =$this->input->get_post('state_name'); 	
		 $district_name =$this->input->get_post('district_name'); 	
		 $admin_id =$this->input->get_post('admin_id'); 	
			$created_on = date('Y-m-d h:i:s');
			$updated_on = date('Y-m-d h:i:s');
			$json = [];
			$data['state_id'] = $state_id;
            $data['district_id'] = $district_id;
            $data['address'] = $address;
            $data['age_year'] = $age_year;
            $data['age_month'] = $age_month;
            $data['photo_path'] = $photo_path;
            $data['user_id'] = $user_id;
            $data['contact_name'] = $contact_name;
            $data['contact_phone'] = $contact_phone;
            $data['weight'] = $weight;
            $data['gender'] = $gender;
            $data['state_name'] = $state_name;
            $data['district_name'] = $district_name;
            $data['admin_id'] = $admin_id;
            $data['created_on'] = $created_on;
            $data['updated_on'] = $updated_on;
			if(isset($user_id) && $user_id != ''){ 
				$res=$this->api_model->add_unproductive_animals($data);
				if($res==true){
						$json['success'] =  True;
					$json['msg'] =  "Your details have been successfully submitted. Our team will contact you soon.";
				}else{
					$json['success'] =  False;
					$json['error'] =  "Please Contact admin"; 
				}	
			}else{
				$json['success'] =  False;
				$json['error'] =  "User id is Mandatory"; 
			}
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	
}