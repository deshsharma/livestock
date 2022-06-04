<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
class Animal_sell_purchase extends CI_Controller {
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
    public function index(){
        $this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
        $this->load->view('admin/animal_sell_purchase');
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
    public function assign(){
        $type = $this->input->get_post('type');
        $emp_id = $this->input->get_post('emp_id');
        $id = $this->input->get_post('id');
        if($type == "vt"){
            $data['vt_id'] = $emp_id;
            $data['status'] = '1';
        }else{
            $data['doc_id'] = $emp_id;
            $request = $this->api_model->get_data('id = '.$id.'', 'vt_requests');
            $re['log_id'] = $request[0]['log_id'];
            $re['request_id'] = $id;
            $re['animal_id'] = $request[0]['animal_id'];
            $re['user_id'] = $request[0]['users_id'];
            $re['treat_type'] = '0';
            $re['vt_id'] = 0;
            $re['doc_id'] = $emp_id;
            $re['treat_status'] = '1';
            $this->api_model->submit('vt_request_tracking', $re);
        }
        $this->api_model->get_data_update('id = '.$id.'', 'vt_requests', $data);
    }
    public function edit_sub($id){
        if(isset($_POST['submit'])){
            $data['doc_id'] = $this->input->get_post('doc');
            $data['vt_id'] = $this->input->get_post('ai');
            $data['treat_type'] = $this->input->get_post('type');
            $data['treat_status'] = $this->input->get_post('status');
            $data['animal_simtoms'] = $this->input->get_post('symtoms');
            $data['animal_suggestion'] = $this->input->get_post('suggestion');
			$this->form_validation->set_rules('type','Please Enter Properties','required|trim');
			$this->form_validation->set_rules('status','Please Enter Price','required|trim');
            if($this->form_validation->run('add_bank')){
                $sub_req = $this->api_model->get_data('id = '.$id.'', 'vt_request_tracking');
                //print_r($sub_req);
                //$count_sub_req = $this->api_model->get_data('request_id = '.$sub_req[0]['request_id'].'', 'vt_request_tracking','','count(id) as count');
                // if($count_sub_req[0]['count']==1){
                //     if( $data['treat_status'] == '5'){
                //         $request = $this->api_model->get_data('id = '.$sub_req[0]['request_id'].'', 'vt_requests');
                //         $re['log_id'] = $request[0]['log_id'];
                //         $re['request_id'] = $sub_req[0]['request_id'];
                //         $re['animal_id'] = $request[0]['animal_id'];
                //         $re['user_id'] = $request[0]['users_id'];
                //         $re['treat_type'] = '3';
                //         $re['vt_id'] = $request[0]['vt_id'];
                //         $re['treat_status'] = '1';
                //         $this->api_model->submit('vt_request_tracking', $re);
                //     }
                // }
                $this->session->set_flashdata('add_bank','Your Sub Request is Updated.');
                $this->api_model->get_data_update('id = '.$id.'','vt_request_tracking', $data);
                $data['data'] = $this->api_model->get_data('id = '.$id.'', 'vt_request_tracking');   
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/layouts/admin_nav');
                $this->load->view('admin/repeat_breading_edit', $data);
                $this->load->view('admin/layouts/admin_footer');
            }else{
                $data['data'] = $this->api_model->get_data('id = '.$id.'', 'vt_request_tracking');   
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/layouts/admin_nav');
                $this->load->view('admin/repeat_breading_edit', $data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }else{
            $data['data'] = $this->api_model->get_data('id = '.$id.'', 'vt_request_tracking');   
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/layouts/admin_nav');
            $this->load->view('admin/repeat_breading_edit', $data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
}