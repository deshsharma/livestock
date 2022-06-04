<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
class Animal_evaluator extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		$this->load->model('loginmodel');
		$this->load->model('pushnoti_model');
		$this->load->model('front_end_model');
		$this->load->model('admin_detail');
		$this->load->library('form_validation');
        $this->load->helper('push_notification');
		date_default_timezone_set('Asia/Calcutta');
    }
    public function add_animal_evaluation(){
            $data['users_id'] = $this->input->get_post('users_id');
            $data['animal_id'] = $this->input->get_post('animal_id');
            $data['admin_id'] = $this->input->get_post('admin_id');
            $data['evaluation_price'] = $this->input->get_post('evaluation_price');
            $data['livestoc_sell'] = $this->input->get_post('livestoc_sell');
            $data['animal_bidding'] = $this->input->get_post('animal_bidding');
            $data['evaluator_name'] = $this->input->get_post('evaluator_name');
            $data['evaluator_phone'] = $this->input->get_post('evaluator_phone');
            $data['created_on'] = date('Y-m-d H:i:s');
            $details = $this->api_model->get_data('users_id = '.$data['users_id'].' AND animal_id = '.$data['animal_id'].'','animals_evalutor');
        if($details){
            $json['success'] = false;
            $json['error'] = 'We have already received your data. Our team will contact you soon';
        }else{            
            $request_id= $this->api_model->submit('animals_evalutor', $data);            
            $json['success'] = true;
            $json['msg'] = 'Thanks your form has been submitted, Livestoc team will contact you soon';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
        
    }
    public function update_animal_evaluation_video(){
        $data['animal_id'] = $this->input->get_post('animal_id');
        $data['videos'] = $this->input->get_post('videos');
        $data['created'] = date('Y-m-d H:i:s');
        $action = $this->input->get_post('action');
       $details = $this->api_model->get_data('animal_id = '.$data['animal_id'].' ','animals_videos');
        if($details){
            $this->api_model->update('animal_id', $data['animal_id'], 'animals_videos', $data);
            $json['success'] = true;
            $json['error'] = 'Video  successfully updated';
        }else{
                $request_id= $this->api_model->submit('animals_videos', $data);
                $json['success'] = true;
                $json['msg'] = 'Video successfully inserted';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function index(){
        $this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
        $this->load->view('admin/animal_evaluator');
        $this->load->view('admin/layouts/admin_footer');
    }
    public function add_animal_evalutor(){
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/layouts/admin_nav');
        $this->load->view('admin/add_animal_evaluator');
        $this->load->view('admin/layouts/admin_footer');
    }
    public function search(){
        $name= $this->input->get_post('name');
        $start = $this->input->get_post('start');
        $perpage = $this->input->get_post('perpage');
        $data = $this->api_model->get_data('','animals_sell_purchase as ap','','*,(select full_name from users where users_id = ap.users_id ) as users_name,(select mobile from users where users_id = ap.users_id ) as mobile,(select category as cat_name from category where category_id = ap.category_id ) as category_name,(select GROUP_CONCAT(category) as category_name from category where FIND_IN_SET(category_id,"1,4")) as breed_name,(select dist_name from district where dis_id = ap.district_id ) as district_name ');
        $count = $this->api_model->get_data('','animals_sell_purchase','', 'count(id) as count');
        $data['count'] = $count[0]['count'];
        echo json_encode($data);
    }
    public function view($id){
       $data['data'] = $this->api_model->get_data('id = '.$id.'', 'vt_requests');   
       $this->load->view('admin/layouts/admin_header');
       $this->load->view('admin/layouts/admin_nav');
       $this->load->view('admin/repeat_breading_view', $data);
       $this->load->view('admin/layouts/admin_footer');
    }
    
    
}