<?php
class Class_public extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//$this->load->model('product');
		$this->load->model('admin_detail');
		$this->load->model('user_detail');
		//$this->load->model('request_hospital');
	}
	public function index()
	{
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
		$data['about'] = $this->admin_detail->get_about_us();
		$data['product'] = $this->product->get_list();
		$data['address'] = $this->admin_detail->get_address();
		$this->load->view('public/home', $data);
	}
	public function product()
	{
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
		$data['about'] = $this->admin_detail->get_about_us();
		$data['product'] = $this->product->get_list();
		$data['address'] = $this->admin_detail->get_address();
		$data['page_id'] = 'home';
		$this->load->view('public/product', $data);
	}
	public function term()
	{
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
		$policy['policy'] = $this->admin_detail->get_term();
		$this->load->view('public/public_term',$policy);
	}
	public function dashboard()
	{
		// echo "this is true";
		// if(isset($_SESSION['user_id'])){
			//if($_SESSION['status']== ADMIN){
				//$this->load->view('admin/dashboard', $user_data);
				redirect('admin/dashboard');
			// }
			// if($_SESSION['status']== CUSTOMER){
			// 	//echo "this is test";
			// 	redirect('app');
			// }
			// 
			// if($_SESSION['status']==CUSTOMER)
			// redirect('app');
		// }
		// else if(isset($_REQUEST['users_id']) && isset($_REQUEST['status'])){
		// 		if($detail = $this->user_detail->get_user_by_id($_REQUEST['users_id'])){
		// 			$this->session->set_userdata('user_id', $detail[0]['id']);
		// 			$this->session->set_userdata('user_name', $detail[0]['name']);
		// 			$this->session->set_userdata('status', $detail[0]['status']);
		// 			redirect('app');
		// 		}
		// }else{
		// 	redirect('app');
		// }

		// print_r($_SESSION);
		// $id = $this->session->userdata('user_id');
		// $user_detail = $this->user_detail->get_detail($id);
		// $user_data['user_data'] = $user_detail;
		// //echo "This is Dashboard";
		// // $user_data['product'] = $this->product->get_list();
		// // $this->load->model('fif');
		// // $fif_detail = $this->fif->fif_detail_id($id);
		// // $fif_detail = $this->fif->fif_detail_id($id);
		// // if($this->session->userdata('status')!=CUSTOMER)
		// // {
		// 	$this->load->view('admin/dashboard', $user_data);
		// }
		// else{
		// 	//if($fif_detail==true)
		// 	//{	
		// 		$fif_status = '1'; 
		// 		//$this->session->set_userdata('fif_status', $fif_status);
		// 		$this->load->view('public/product', $user_data);
		// 	//}
		// 	//else{
		// 		$this->load->view('user/dashboard', $user_data);
		// 	//}
		// }
	}
	public function user_profile()
	{
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
		//$this->load->library('form_validation');
		$id = $this->session->userdata('user_id');
		$user_detail = $this->user_detail->get_detail($id);
		$user_data['user_data'] = $user_detail;
		$this->load->view('user/user_profile', $user_data);
	}
	public function change_password()
	{
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
		//$this->load->library('form_validation');
		$this->load->view('user/change_pass');
	}
	public function update_profile()
	{
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
		$data['userdata'] = $this->session->userdata;
		$id = $this->session->userdata('user_id');
		$user_detail['name'] = $this->input->post('name');
		$user_detail['phone'] = $this->input->post('phone');
		$user_detail['email'] = $this->input->post('email');
		$user_detail['address'] = $this->input->post('address');
		$user_detail['reg_no'] = $this->input->post('tin_no');
		$user_data['user_data'][0] = $user_detail;
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','User Phone','required|num|trim');
		$this->form_validation->set_rules('email','Email','required|email|trim');
		$this->form_validation->set_rules('address','User address','required|trim');
		$this->form_validation->set_error_delimiters('<div  class="text-danger" align="center">', '</div>');
		if($this->form_validation->run('user_profile'))
		{
			$user_dat['name'] = $this->input->post('name');
			$user_dat['phone'] = $this->input->post('phone');
			$user_dat['email'] = $this->input->post('email');
			$user_dat['address'] = $this->input->post('address');
			$user_dat['reg_no'] = $this->input->post('tin_no');
			$id = $this->session->userdata('user_id');		
			if($detail = $this->admin_detail->push_detail($user_dat, $id))
			{
				redirect('class_public/dashboard', $user_data);
			}
			else
			{
				$this->session->set_flashdata('update_profile','There is problem with Database.');
				return redirect('class_public/user_profile', $user_data);
			}
		}
		else
		{	
			$this->load->view('user/user_profile',$user_data);
		}
	}
	public function change_pass()
	{
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
		$this->load->library('form_validation');
		$id = $this->session->userdata('user_id');
		$user_detail = $this->user_detail->get_detail($id);
		$this->form_validation->set_rules('oldpassword','Old Password','required|trim');
		$this->form_validation->set_rules('newpassword','New Password','required|trim');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','required|trim');
		$this->form_validation->set_error_delimiters('<div  class="text-danger" align="center">', '</div>');
		if($this->form_validation->run('change_pass')){
			$old_pass = $this->input->post('oldpassword');
			if($user_detail[0]['password']==md5($old_pass))
			{
				$user_detail['password'] = $this->input->post('oldpassword');
				$user_detail['id'] = $id;
				if($detail = $this->user_detail->chanege_pass($user_detail))
				{
					redirect('class_public/dashboard');
				}
				else
				{
					$this->session->set_flashdata('change_pass','There is problem with Database.');
					return redirect('class_public/change_pass');
				}
			}
			else
			{
				$this->session->set_flashdata('change_pass','<div  class="text-danger" align="center">Your Old Password is not matched.</div>');
				return redirect('class_public/change_pass');
			}
		}
		else{
			$this->load->view('user/change_pass');
		}
	}
}