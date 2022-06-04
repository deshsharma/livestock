<?php
class Home extends CI_Controller {
	public function __construct() {

        parent::__construct();
        $this->load->model('front_end_model');
    }
    public function index(){
        $active['active'] = 'home';
        $this->load->view('layout/header', $active);
        $this->load->view('layout/slider');
        return redirect(base_url('homenew/index'));
        //$this->load->view('index');
        $this->load->view('layout/footer');
    }
    public function get_coustomer(){
        $users_id = $this->input->get_post('user_id');
        $data = $this->front_end_model->get_coustomer($users_id);
        echo $data = json_encode($data);
        //return $data;
    }
    public function push_notification(){
        $push = array(
            'title' => $this->input->get_post('title'),
            'description' => $this->input->get_post('description'),
            'from_type' => 'Livestoc Team',
            'from_id' => 0,
            'to_type' => 'users',
            'to_id' => $this->input->get_post('user_id'),
            'to_users_id' => $this->input->get_post('user_id'),
            'date_added' => date('Y-m-d H:i:s'),
            'device' => 'android',
        );
        $push['request_data'] = serialize($push);
        // $push['response_data'] = serialize($this->input->get_post('title'));
        // $push['success'] = $result['success'];
        $data['title'] = $this->input->get_post('title');
        $data['description'] = $this->input->get_post('description');
        $data['from_type'] = 'Livestoc Team';
        $data['to_users_id'] = $this->input->get_post('user_id');
        $data['to_type'] = 'users';
        $data['to_id'] = $this->input->get_post('user_id');
        $data['date_added'] = date('Y-m-d h:i:s');
        $data['request_data'] = serialize($push);
        $data['response_data'] = '';
        $data['success'] = 1;
        $data['device'] = 'android';
        $data['active'] = '1';
        $this->front_end_model->ins_push($data);
    }
}