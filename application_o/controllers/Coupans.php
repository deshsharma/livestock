<?php
class Coupans extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		//$this->load->model('serviceboy');
		//$this->load->model('request_hospital');
		//$this->load->model('hospital');
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
	}
    public function index(){

    }
    public function create($id, $product_id, $users_id, $type){
		if(isset($_POST['submit'])){
			$name = $this->input->get_post('name');	
			$type = $this->input->get_post('type');	
			$user = $this->input->get_post('user');	
			$animal = $this->input->get_post('animal');
			$time = $this->input->get_post('time');
			$rate = $this->input->get_post('rate');	
			$data['coupan'] = $name;
			$data['product_id'] = $animal;
			$data['users_id'] = $user;
			$data['type'] = $type;
			$data['time'] = $time;
			$data['rate'] = $rate;
			$data['created_on'] = date('Y-m-d h:i:s');
			$this->form_validation->set_rules('name','Please Enter Coupan','required|trim');
			$this->form_validation->set_rules('animal','Please Select Product','required');
			$this->form_validation->set_rules('user','Please Select User','required');
			$this->form_validation->set_rules('type','Please Select Type','required');
			$this->form_validation->set_rules('time','Please Select Time','required');
			$this->form_validation->set_rules('rate','Please Enter Rate','required|trim');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('coupans', $data)){
					$this->session->set_flashdata('add_bank','Your Properties is Updated.');
					redirect(base_url().'coupans');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$data['id'] = $id;
					$data['product_id'] = $product_id;
					$data['users_id'] = $users_id;
					$data['type'] = $type;
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/coupans_create', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['id'] = $id;
				$data['product_id'] = $product_id;
				$data['users_id'] = $users_id;
				$data['type'] = $type;
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/coupans_create', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['id'] = $id;
			$data['product_id'] = $product_id;
			$data['users_id'] = $users_id;
			$data['type'] = $type;
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/coupans_create', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
    }
}