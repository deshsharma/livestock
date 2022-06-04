<?php
class Evaluation extends CI_Controller {
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
		$this->load->view('admin/evaluation');
		$this->load->view('admin/layouts/admin_footer');
    }   
    public function edit($id){
             if(isset($_POST['submit'])){
			$animal_id = $this->input->get_post('animal_id');
		    $data['state_id'] = $this->input->get_post('state_name');
		    $data['animal_rating'] = $this->input->get_post('animal_rating');
		    $data['animal_style'] = $this->input->get_post('animal_style');
            $data['dist_id'] = $this->input->get_post('dist_name');
            $data['livestoc_price'] = $this->input->get_post('livestoc_price');
            $data['bidding_price'] = $this->input->get_post('bidding_price');
            $data['bidding_hours'] = $this->input->get_post('bidding_time');
			$datacart['livestoc_price']=$this->input->get_post('livestoc_price');
			$datacart['bidding_price']=$this->input->get_post('bidding_price');
		    if($data['bidding_hours'] != '0' && $data['bidding_hours'] != ''){
                $data['bidding_start_time'] = date('h:i:s');
                $data['bidding_start_date'] = date('Y-m-d');
            }
            $this->form_validation->set_rules('state_name','Please Select State','required');
		    $this->form_validation->set_rules('dist_name','Please Select District','required');
			$this->form_validation->set_rules('livestoc_price','Please Enter Livestoc Price','required|trim');
			$this->form_validation->set_rules('bidding_price','Please Enter Bidding Price','required|trim');
			if($this->form_validation->run('add_bank')){
                if($this->api_model->get_data_update('id = '.$id.'', 'animals_evalutor', $data)){
					$this->api_model->get_data_update('animal_id = '.$animal_id.'', 'animal_cart', $datacart);
                    $this->session->set_flashdata('add_bank','Your Evaluation is Updated.');
					redirect(base_url().'evaluation');

                }else{
                    $this->session->set_flashdata('add_bank','Database Error.');
                    $data['data'] = $this->api_model->get_data('id = '.$id.'','animals_evalutor');
                    $this->load->view('admin/layouts/admin_nav');
                    $this->load->view('admin/layouts/admin_header');
                    $this->load->view('admin/evaluation_edit', $data);
                    $this->load->view('admin/layouts/admin_footer');
                }
            }else{
                $data['data'] = $this->api_model->get_data('id = '.$id.'','animals_evalutor');
                $this->load->view('admin/layouts/admin_nav');
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/evaluation_edit', $data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }else{
            $data['data'] = $this->api_model->get_data('id = '.$id.'','animals_evalutor');
            $this->load->view('admin/layouts/admin_nav');
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/evaluation_edit', $data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function change_status(){
      
        $id = $this->input->get_post('id');
        $status = $this->input->get_post('status');
        $type = $this->input->get_post('type');
        $bidding_price = $this->input->get_post('bidding_price');
		 if($type=='livestoc_sell'){
           
			if($status=='1'){
				$data['livestoc_sell'] = '1';	
				$data['animal_bidding'] = '0';	
			}else{
				$data['livestoc_sell'] = '0';	
				$data['animal_bidding'] = '1';	
			}
		}elseif($type=='animal_bidding'){
           
			if($status=='1'){
				$data['animal_bidding'] = '1';	
				$data['livestoc_sell'] = '0';	
			}else{
				$data['animal_bidding'] = '0';	
				$data['livestoc_sell'] = '1';	
			}
		} 
        $data[$type] = $status;
       
        $this->api_model->get_data_update('id = '.$id.'', 'animals_evalutor', $data);
        $json = $this->api_model->get_data('id = '.$id.'', 'animals_evalutor');
        echo json_encode($json);
    }
    public function eve_search(){
        $name =  $this->input->get('name');
        $start = $this->input->get_post('start');
        $district_id = $this->input->get_post('dist_id');
        $perpage = 20;
        $district_id = $_SESSION['district'];
        // $where = 'type IN ("37", "38","39") ';   
        // if($_SESSION['status'] == '39'){
        //     $where .= 'AND FIND_IN_SET ("service_district","'.$district_id.'") ';
        // } 
        // if($name != ''){
        //     $where = 'AND fname like = "%'.$name.'% "';
        // }
		$detail = $this->api_model->get_data('' , 'animals_evalutor', 'id DESC', 'id, animal_id, (select full_name from users where users_id = animals_evalutor.users_id) as user_name, (select mobile from users where users_id = animals_evalutor.users_id) as user_mobile, (select fname from admin where admin_id = animals_evalutor.admin_id) as admin_name, (select mobile from admin where admin_id = animals_evalutor.admin_id) as admin_mobile, evaluation_price, livestoc_sell, livestoc_price, animal_bidding, bidding_price', $start, $perpage);
		$detail['count'] = $this->api_model->get_data($where , 'animals_evalutor', '', 'count(*) as count');
		if($detail)
		{
			$json_data = $detail;
		}
		else
		{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
    }
    public function eve_status(){
        $id = $this->input->get_post('id');
        $name =  $this->input->get_post('name');
		$start = $this->input->get_post('start');
        $data['isactivated'] = $this->input->get_post('status');
		$perpage = 10;
        $where = 'type IN ("37", "38") ';
        if($name != ''){
            $where = 'AND fname like = "%'.$name.'% "';
        }
        if($this->api_model->get_data_update('admin_id = '.$id.'', 'admin', $data)){
            $detail = $this->api_model->get_data($where , 'admin', '', '*', $start, $perpage);
            $detail['count'] = $this->api_model->get_data($where , 'admin', '', 'count(*) as count');
            if($detail)
            {
                $json_data = $detail;
            }
            else
            {
                $json_data['error'] = '1';
            }
            echo json_encode($json_data);
        }
    }
}