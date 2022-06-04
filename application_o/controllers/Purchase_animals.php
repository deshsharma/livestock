<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_animals extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		date_default_timezone_set('Asia/Calcutta');
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
    }
    public function index(){
	    $this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/purchase_animals');
		$this->load->view('admin/layouts/admin_footer');
    }
    
}