<?php
class Employee extends CI_Controller {
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
        $this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/employee_ret');
		$this->load->view('admin/layouts/admin_footer');
    }
    public function employee_search(){
        $name =  $this->input->get('name');
        $start = $this->input->get_post('start');
        $district_id = $this->input->get_post('dist_id');
        // print_r($_SESSION['status']);
        // exit;
        $perpage = 20;
        $where = '';   
        $where = 'type IN ("37", "38","39") ';     
        if($_SESSION['status'] == '39'){
            $where .= 'AND FIND_IN_SET ("service_district","'.$district_id.'") ';
        }
        
        if($name != ''){
            $where = 'AND fname like = "%'.$name.'% "';
        }
		$detail = $this->api_model->get_data($where , 'admin', 'admin_id desc', '*,CONCAT("'.IMAGE_PATH.'harpahu_merge_dev/uploads/bank/",image) as emp_image', $start, $perpage);
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
    public function employee_status(){
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
    public function edit($id){
        $admin_data['data'] = $this->api_model->get_data('admin_id = "'.$id.'"', 'admin','','*,CONCAT("'.IMAGE_PATH.'harpahu_merge_dev/uploads/bank/",image) as emp_image');
        if(isset($_REQUEST['submit'])){
            $data['image'] = $this->input->post('animal_image');
            $data['fname'] = $this->input->post('name');
            $data['lname'] = $this->input->post('lname');
            $data['admin_group_id'] = $this->input->post('r_code');
            $data['mobile'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['district'] = $this->input->post('district1');
            $data['state'] = $this->input->post('state1');
            $data['complete_addr'] = $this->input->post('address');
            $data['type'] = $this->input->post('type');
            // if($data['type'] == '37'){
            //     $data['user_type'] = '41';
            // }else{
            //     $data['user_type'] = '42';
            // }
            $data['created_on'] = date('Y-m-d h:i:s');
            $password = $this->input->post('password');
            // $data['password'] = md5($password);
            // $num_str = sprintf("%08d", mt_rand(1, 99999999));
            // $data['referral_code'] = $num_str;
            $this->form_validation->set_rules('name','Name','required|trim');
            $this->form_validation->set_rules('phone','Phone','required|trim');
            $this->form_validation->set_rules('address','Address','required|trim');
            $this->form_validation->set_rules('email','Email','required|trim');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run('superv_add')){
                        if($this->api_model->get_data_update('admin_id="'.$id.'"','admin', $data)){
                            redirect(base_url('employee'));
                        }else{
                            $this->session->set_flashdata('superv_add','There is problem with database.');
                            $this->load->view('admin/layouts/admin_nav');
                            $this->load->view('admin/layouts/admin_header');
                            $this->load->view('admin/employee_ret_edit', $admin_data);
                            $this->load->view('admin/layouts/admin_footer');
                        }
            }else{
                $this->load->view('admin/layouts/admin_nav');
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/employee_ret_edit', $admin_data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }else{
            $this->load->view('admin/layouts/admin_nav');
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/employee_ret_edit', $admin_data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function add(){
        if(isset($_REQUEST['submit'])){
            // print_r($_REQUEST);
            // exit;
            $data['image'] = $this->input->post('animal_image');
            $data['employee_code'] = $this->input->post('employee_code');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['corp_address'] = 'C-86 Ph VII, Ind Area, Mohali,Punjab';
            $data['type_of_job'] = $this->input->post('type_of_job');
            $data['fname'] = $this->input->post('name');
            $data['lname'] = $this->input->post('lname');
            $data['admin_group_id'] = $this->input->post('r_code');
            $data['mobile'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $district_code = $this->input->post('district1');
            $data['district'] = implode(',', $district_code);
            $data['service_district'] = implode(',', $district_code);
            $state = $this->input->post('state1');
            $data['state'] = implode(',', $state);
            $data['service_state'] = implode(',', $state);
            $data['complete_addr'] = $this->input->post('address');
            $data['type'] = $this->input->post('type');
            // print_r($data);
            // exit;
            if($data['type'] == '37'){
                $data['user_type'] = '42';
            }else{
                $data['user_type'] = '43';
            }
            $data['created_on'] = date('Y-m-d h:i:s');
            $password = $this->input->post('password');
            $data['password'] = md5($password);
            $num_str = sprintf("%08d", mt_rand(1, 99999999));
            $data['referral_code'] = $num_str;
            $this->form_validation->set_rules('name','Name','required|trim');
            $this->form_validation->set_rules('phone','Phone','required|trim');
            $this->form_validation->set_rules('address','Address','required|trim');
            $this->form_validation->set_rules('email','Email','required|trim');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run('superv_add')){
                if($this->api_model->get_data('email = "'.$data['email'].'"', 'admin')){
                    $this->session->set_flashdata('superv_add','Email Id is associated with other account.');
                    $this->load->view('admin/layouts/admin_nav');
                    $this->load->view('admin/layouts/admin_header');
                    $this->load->view('admin/employee_ret_add');
                    $this->load->view('admin/layouts/admin_footer');
                }else{
                    if($this->api_model->get_data('mobile = "'.$data['mobile'].'"', 'admin')){
                        $this->session->set_flashdata('superv_add','Mobile No is associated with other account.');
                        $this->load->view('admin/layouts/admin_nav');
                        $this->load->view('admin/layouts/admin_header');
                        $this->load->view('admin/employee_ret_add');
                        $this->load->view('admin/layouts/admin_footer');
                    }else{ 
                        if($this->api_model->submit('admin', $data)){
                            redirect(base_url('employee'));
                        }else{
                            $this->session->set_flashdata('superv_add','There is problem with database.');
                            $this->load->view('admin/layouts/admin_nav');
                            $this->load->view('admin/layouts/admin_header');
                            $this->load->view('admin/employee_ret_add');
                            $this->load->view('admin/layouts/admin_footer');
                        }
                    }
                }
            }else{
                $this->load->view('admin/layouts/admin_nav');
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/employee_ret_add');
                $this->load->view('admin/layouts/admin_footer');
            }
        }else{
            $this->load->view('admin/layouts/admin_nav');
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/employee_ret_add');
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function user($id){
        $data['id'] = $id;
        $this->load->view('admin/layouts/admin_nav');
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/emp_user', $data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function employee_user_search(){
        $id =  $this->input->get('id');
        $name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
        $where = 'admin_id = "'.$id.'" ';
        if($name != ''){
            $where = ' AND fname like "%'.$name.'% "';
        }
        $start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
		$end_data = date('Y-m-d');
		$detail = $this->api_model->get_data($where , 'users', '', 'users_id, full_name, mobile, created_on, (select count(id) from ai_package_log where users_id = users.users_id AND  ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'") as premium', $start, $perpage);
		$detail['count'] = $this->api_model->get_data($where , 'users', '', 'count(*) as count');
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
    public function vt($id){
        $data['id'] = $id;
        $this->load->view('admin/layouts/admin_nav');
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/emp_vt', $data);
        $this->load->view('admin/layouts/admin_footer');
    }
    public function employee_vt_search(){
        $id =  $this->input->get('doc_code');
        $name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
        $where = 'admin_id = "'.$id.'" ';
        if($name != ''){
            $where = ' AND username like "%'.$name.'% "';
        }
        // $start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
		// $end_data = date('Y-m-d');
		$detail = $this->api_model->get_data($where , 'doctor as d', '', "doctor_id, users_type, (select sum(amount) from company_settlement_account where users_id = d.doctor_id AND users_type = '1' AND status = 'Dr') as sttel_dr, (select sum(amount) from company_settlement_account where users_id = d.doctor_id AND users_type = '1' AND status = 'Cr') as sttel_cr,(select sum((((doctor_charge * call_total_minute) * '.CALL_PERCENTAGE.')/100)) from doctor_call_inisite as ca where doctor_id = d.doctor_id) as company_share, (select sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * '.CALL_PERCENTAGE.')/100)))  from doctor_call_inisite as ca where doctor_id = d.doctor_id) as your_share, (select sum(if((select request_status from log_file where id = st.log_id) = 2, if((select company_charges from bull_table where id = st.vacc_id) <= (select if(sum(amount) IS NOT NULL,sum(amount),0) from livestoc_wallets where status ='Dr' AND log_id = st.log_id), (select if(sum(amount) IS NOT NULL,sum(amount),0) from livestoc_wallets where status ='Dr' AND log_id = st.log_id) - (select company_charges from bull_table where id = st.vacc_id), '0'),((select ai_price from semen_invoice_performa where id = Invoice_id) + (select semen_stock_price from semen_invoice_performa where id = Invoice_id) - (select company_charges from bull_table where id = st.vacc_id)))) from vt_requests as st where vt_id = doctor_id) as total_cr, (select sum(if((select request_status from log_file where id = st.log_id) = 2,if((select company_charges from bull_table where id = st.vacc_id) >= (select if(sum(amount) IS NOT NULL,sum(amount),0) from livestoc_wallets where status ='Dr' AND log_id = st.log_id), (select company_charges from bull_table where id = st.vacc_id) - (select if(sum(amount) IS NOT NULL,sum(amount),0) from livestoc_wallets where status ='Dr' AND log_id = st.log_id), '0'),0)) from vt_requests as st where vt_id = doctor_id) as total_dr,(select id from document_table where degree_name='10th' AND doc_id = d.doctor_id) as tenth_id, (select image from document_table where degree_name='10th' AND doc_id = d.doctor_id) as tenth, (select isactive from document_table where degree_name='10th' AND doc_id = d.doctor_id) as tenth_status, (select id from document_table where degree_name='10th+2' AND doc_id = d.doctor_id) as tenthtwo_id, (select image from document_table where degree_name='10th+2' AND doc_id = d.doctor_id) as tenthtwo, (select isactive from document_table where degree_name='10th+2' AND doc_id = d.doctor_id) as tenthtwo_status, (select id from document_table where degree_name='diploma' AND doc_id = d.doctor_id) as diploma_id, (select image from document_table where degree_name='diploma' AND doc_id = d.doctor_id) as diploma_image, (select isactive from document_table where degree_name='diploma' AND doc_id = d.doctor_id) as diploma_status, username, fathers_name, registration_no, registeration_year, registeration_council, refral_by_code, refral_code, email, isactivated, is_payment, is_available_consultation, is_perform_ai is_vecc_term, rej_region, password, specialisation_list, qualification, qualification_specialisation, mobile, mobile_2nd, mobile_code, mobile_verification, aadhar_no, adhaar_img, fullname, first_name, middle_name, last_name, languages, expertise_list, gender, dob, gmail, facebook, currencie_id, father_name, image, doctor_address_id, experience_desc, total_experience, latitude, longitude, fcm_android, fcm_ios, fcm_status, status, service_availability, wallet_balance, consul_fee, visiting_fee, ai_visiting_fee, bank_name, branch_address, ifsc_code, account_no, account_holder_name, service_charge	date_added, activationcode, date_modified, officers_code, parent_id, parent_code, landline, city, state, state_code, pincode, district, district_code, subdistrict, subdistrict_code, address_full, date, is_premium, is_paid, is_consultation_on, online_for_visit, avaialable_for_visit, telephonic_consult, home_visit_changes", $start, $perpage);
		$detail['count'] = $this->api_model->get_data($where , 'doctor', '', 'count(*) as count');
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