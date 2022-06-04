<?php
class User_negotiation extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		// if(!$this->session->userdata("user_id")){
	    //     redirect('');	    
		// }
	}
    public function index(){
        $this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
        $this->load->view('admin/user_negotiation');
        $this->load->view('admin/layouts/admin_footer');
    }
    public function request(){
        $data['users_id'] = $this->input->get_post('users_id');
		$data['product_id'] = $this->input->get_post('product_id');
		$data['type'] = $this->input->get_post('type');
        $data['user_type'] = $this->input->get_post('user_type');
        $data['createdon'] = date('Y-m-d h:i:s');
        if(!$this->api_model->get_data('user_type = "'.$data['user_type'].'" AND type = '.$data['type'].' AND product_id = '.$data['product_id'].' AND users_id = '.$data['users_id'].'', 'user_negotiation_request')){
            $this->api_model->submit('user_negotiation_request', $data);
            $json['success'] = true;
            $json['msg'] = 'Your request has been submitted and Our  team will contact you soon.';
        }else{
            $json['success'] = false;
            $json['error'] = 'You already have submitted your request. Our team get back to you soon.';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function search(){
        $name= $this->input->get_post('name');
        $start = $this->input->get_post('start');
        $perpage = $this->input->get_post('perpage');
        $name = $this->input->get_post('name');
        $where = '';
        if($name != ''){
            $where  = 'WHERE (product_id = "'.$name.'" OR (select mobile from users where `users_id` = ap.users_id) like "%'.$name.'%")';
        }
        $query= 'SELECT *,(select evaluation_price from animals_evalutor where animals_evalutor.animal_id = product_id) as evaluation_price, (select livestoc_price from animals_evalutor where animals_evalutor.animal_id = product_id) as livestoc_price, (select bidding_price from animals_evalutor where animals_evalutor.animal_id = product_id) as bidding_price, (select full_name from users where users_id = ap.users_id) as users_name,(select mobile from users where users_id = ap.users_id) as mobile, ap.createdon from user_negotiation_request as ap '.$where.' LIMIT '.$start.', '.$perpage.'';
        $data = $this->api_model->sql_query($query);
        //print_r($data);
        $query= 'SELECT count(id) as count from user_negotiation_request as ap  '.$where.'';
        $count = $this->api_model->sql_query($query);
        // $data = $this->api_model->get_data('purpose = "32" '.$where.'','animal_sell_details as ap','id DESC','*,(select full_name from users where users_id = ap.buyer_id) as users_name,(select mobile from users where users_id = ap.buyer_id) as mobile, ap.date');
        //$count = $this->api_model->get_data('purpose = "32" '.$where.'','animal_sell_details','', 'count(id) as count');
        $data['count'] = $count[0]['count'];
        echo json_encode($data);
    }
}