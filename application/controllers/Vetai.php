<?php
class Vetai extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('front_end_model');
        $this->load->model('api_model');
        $this->load->model('login_cheak_model');
        $this->load->model('loginmodel');
    }
    public function login(){
       $this->load->view('front_end/product/header');
       $this->load->view('vet_ai/registration/login_reg');
    }
    public function ecommerce_page(){
        $this->load->view('vet_reg/ecommerce_page.php');
    }
    public function homepage(){
        $this->load->view('vet_ai/homepage');
    }
    public function pricingList(){
         $this->load->view('vet_ai/pricingList.php');
    }
    public function vt_otp(){
        $this->load->view('vet_ai/vt_otp');
    }
    public function ai_otp(){
        $this->load->view('vet_ai/ai_otp');
    }
    public function vet_registration(){
    	 $this->load->view('vet_reg/registration/header');
         $this->load->view('vet_reg/registration/vet_registration');
    }
    public function registration(){
        $data['mobile'] = $this->input->get_post('mobile');
        $data['users_type'] = $this->input->get_post('type');
        if($_POST['submit']){
            $data['image'] = $this->input->get_post('image_name');
            $data['first_name'] = $this->input->get_post('first_name');
            $data['fullname'] = $this->input->get_post('first_name');
            $data['username'] = $this->input->get_post('first_name');

            $data['father_name'] = $this->input->get_post('father_name');
            $data['fathers_name'] = $this->input->get_post('father_name');

            $data['gender'] = $this->input->get_post('options');
            $data['gmail'] = $this->input->get_post('your_email');

            $data['aadhar_no'] = $this->input->get_post('adhar');
            $data['adhaar_img'] = $this->input->get_post('aadharcar_name');

            $data['mobile_code'] = '+91';
            $data['mobile'] = $data['mobile'];
            //$data['mobile'] = $this->input->get_post('mobile');
            $data['mobile_2nd '] = $this->input->get_post('alternatemobile');

            $document_table['tenth'] = $this->input->get_post('tenth_name');
            $document_table['plustwo'] = $this->input->get_post('plustwo_name');
            $document_table['diploma'] = $this->input->get_post('diplomainstitute_name');

            $data['total_experience'] = $this->input->get_post('total_experince');
            $data['address_full'] = $this->input->get_post('address');
            $data['district'] = $this->input->get_post('place');
            $data['state'] = $this->input->get_post('state');

            $data['pincode'] = $this->input->get_post('pincode');
            $data['password'] = $this->input->get_post('passcode');
            $confirm_pass = $this->input->get_post('confirm_passcode');
            $data['expertise_list'] = $this->input->get_post('checkbox1');
            $data['users_type'] = $data['users_type'];
            if (!empty($this->input->get_post('checkbox1'))){
                $this->form_validation->set_rules('checkbox1',"Expertise", "trim|xss_clean|numeric");
            } else {
                $this->form_validation->set_rules('checkbox1',"Expertise", "trim|required");
            }
           

            $this->form_validation->set_rules('first_name','Please Enter Name','required|trim');
            $this->form_validation->set_rules('your_email','Please Enter Your Email','required|trim');
            $this->form_validation->set_rules('pincode','Please Enter Pin Code','numeric|required|trim');
            $this->form_validation->set_rules('place','Please Enter place','required|trim');
            $this->form_validation->set_rules('state','Please Enter State','required|trim');
            $this->form_validation->set_rules('address','Please Enter address','required|trim');
            $this->form_validation->set_rules('passcode','Please Enter passcode','numeric|required|trim');
            $this->form_validation->set_rules('confirm_passcode','Please Enter Confirm passcode','numeric|required|trim');
            $this->form_validation->set_rules('adhar','Please Enter Adhar No','numeric|required|trim');
            $this->form_validation->set_rules('father_name','Please Father Name','required|trim');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');  

            if($this->form_validation->run('add_bank')){
                $data['date'] = date('Y-m-d h:i:s');
                if($data['password'] != $confirm_pass){
                    $this->session->set_flashdata('add_bank','Passcode and Confiem Passcode is not matched');
                    $this->load->view('vet_ai/registration/header');
                    $this->load->view('vet_ai/registration/registration', $data);
                }else if($this->api_model->docmobileadhaarcheck($data['mobile'], $data['mobile_code'])){
                    $this->session->set_flashdata('add_bank','Mobile No Already Exist');
                    $this->load->view('vet_ai/registration/header');
                    $this->load->view('vet_ai/registration/registration', $data);
                }elseif($this->api_model->docadhaarcheck($data['aadhar_no'])){
                    $this->session->set_flashdata('add_bank','Adhaar already associated with another account.');
                    $this->load->view('vet_ai/registration/header');
                    $this->load->view('vet_ai/registration/registration', $data);
                }elseif($this->api_model->docemailcheck($data['gmail'])){
                    $this->session->set_flashdata('add_bank','Email is already associated with another account.');
                    $this->load->view('vet_ai/registration/header');
                    $this->load->view('vet_ai/registration/registration', $data);
                }else{
                    $data['password'] = md5($data['password']);
                    $data['expertise_list'] = implode(",", $data['expertise_list']);
                    if($last_id = $this->api_model->ins_doc($data)){
                        if(!empty($document_table['tenth'])) {
                            $document_table1['doc_id'] = $last_id; 
                            $document_table1['degree_name'] = '10th';
                            $document_table1['image']= $document_table['tenth'];
                            $this->api_model->ins_pic($document_table1);
                        }
                        if(!empty($document_table['plustwo'])) {
                            $document_table2['doc_id'] = $last_id; 
                            $document_table2['degree_name'] = '10th+2';
                            $document_table2['image']= $document_table['plustwo'];
                            $this->api_model->ins_pic($document_table2);
                        }
                        if(!empty($document_table['diploma'])) {
                            $document_table3['doc_id'] = $last_id; 
                            $document_table3['degree_name'] = 'diploma';
                            $document_table3['image']= $document_table['diploma'];
                            $this->api_model->ins_pic($document_table3);
                        }
                        $this->session->set_userdata('users_id', $last_id);
                        $this->session->set_userdata('user_name', $data['first_name']);
                        $this->session->set_userdata('user_type', $data['users_type']);
                        redirect('all_videos');
                    } else {
                        $this->load->view('vet_ai/registration/header');
                        $this->load->view('vet_ai/registration/registration', $data);
                    }
                }
            }else{
                $this->load->view('vet_ai/registration/header');
                $this->load->view('vet_ai/registration/registration', $data);
            }
        } else {
            $this->load->view('vet_ai/registration/header');
            $this->load->view('vet_ai/registration/registration', $data);
        }
    }

    public function active_your_account(){
        //echo $this->input->get_post('id');
        $data['id'] = $this->input->get_post('id');
        $data['showsecondtab'] = 0;
        if($_POST['submit']){
            $data['id'] = $this->input->get_post('id');
            $data['username'] = $this->input->get_post('username');
            $data['password'] = $this->input->get_post('password');
            $data['email'] = $this->input->get_post('email');
            $dataisAactive['isactivated'] = '1';
            $this->form_validation->set_rules('id','Please Enter Account Id','required|trim');
            $this->form_validation->set_rules('username','Please Enter Username','required|trim');
            $this->form_validation->set_rules('password','Please Enter Password','required|trim');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');              
            if($this->form_validation->run('add_bank')){
                if($this->api_model->doctor_doc_status($data['id'], $dataisAactive)) {
                    //We need to create login for login
                    $login_detail = $this->login_cheak_model->login_paravate($data['email'], $data['password']);
                    if(!empty($login_detail)) {
                        //redirection when user login
                        $login_id = $login_detail[0]['doctor_id'];
                        $login_name = $login_detail[0]['username'];
                        $type = 0;
                        $this->session->set_userdata('users_id', $login_id);
                        $this->session->set_userdata('user_name', $login_name);
                        $this->session->set_userdata('user_type', $type);
                        return redirect(base_url().'all_videos');
                    } else {
                        $this->load->view('vet_reg/registration/header');
                        $data['details'] = $this->session->userdata("active_account_details");
                        $data['showsecondtab'] = 1;
                        $this->load->view('vet_reg/registration/active_your_account', $data);
                    }
                }
            }else{
                $this->load->view('vet_reg/registration/header');
                $data['details'] = $this->session->userdata("active_account_details");
                $data['showsecondtab'] = 1;
                $this->load->view('vet_reg/registration/active_your_account', $data);
            }
        }else if($_POST['submitskip']){
            $data['id'] = $this->input->get_post('id');
            $data['username'] = $this->input->get_post('username');
            $data['password'] = $this->input->get_post('password');
            $data['email'] = $this->input->get_post('email');
            $dataisAactive['isactivated'] = '1';
            $this->form_validation->set_rules('id','Please Enter Account Id','required|trim');
            //$this->form_validation->set_rules('username','Please Enter Username','required|trim');
            $this->form_validation->set_rules('password','Please Enter Password','required|trim');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');              
            if($this->form_validation->run('add_bank')){
                if($this->api_model->doctor_doc_status($data['id'], $dataisAactive)) {
                    $data['users_id'] = $this->input->get_post('id');
                    $data1['type'] = '3';
                    $data1['date'] = date('Y-m-d h:i:s');
                    $data1['payment_type'] = 'Cr';
                    if(!isset($refral_code) || $refral_code !=''){
                        $ref_data['refral_by_code'] = $refral_code;
                        $data_ref = $this->api_model->get_doc_by_ref_code($refral_code);
                        $ref_data_ins['point'] = REFER_AMOUNT;
                        $ref_data_ins['users_id'] = $data_ref['doctor_id'];
                        $ref_data_ins['type'] = '3';
                        $ref_data_ins['date'] = date('Y-m-d h:i:s');
                        $ref_data_ins['payment_type'] = 'Cr';
                        $this->api_model->insert_point_data($ref_data_ins);
                        $this->api_model->insert_point_data($data1);
                    }
                    $ref_data['is_payment'] = '2';
                    $ref_data['isactivated'] = '1';
                    $this->api_model->update_para_fcm($doc_id, $ref_data);
                    //We need to create login for login
                    $login_detail = $this->login_cheak_model->login_paravate($data['email'], $data['password']);
                    if(!empty($login_detail)) {
                        //redirection when user login
                        $login_id = $login_detail[0]['doctor_id'];
                        $login_name = $login_detail[0]['username'];
                        $type = 0;
                        $this->session->set_userdata('users_id', $login_id);
                        $this->session->set_userdata('user_name', $login_name);
                        $this->session->set_userdata('user_type', $type);
                        return redirect(base_url().'all_videos');
                    } else {
                        $this->load->view('vet_reg/registration/header');
                        $data['details'] = $this->session->userdata("active_account_details");
                        $data['showsecondtab'] = 1;
                        $this->load->view('vet_reg/registration/active_your_account', $data);
                    }
                }
            }else{
                $this->load->view('vet_reg/registration/header');
                $data['details'] = $this->session->userdata("active_account_details");
                $data['showsecondtab'] = 1;
                $this->load->view('vet_reg/registration/active_your_account', $data);
            }
        }else{
            $d = $data;
            $this->load->view('vet_reg/registration/header');
            $data = $this->session->userdata("active_account_details");
            $this->load->view('vet_reg/registration/active_your_account', $d);
        }
    }
    public function skip_ref_code(){
        //if($_POST['submitskip']){
         
            $data['id'] = $this->input->get_post('id');
            $data['username'] = $this->input->get_post('username');
            $data['password'] = $this->input->get_post('password');
            $data['email'] = $this->input->get_post('email');
            $dataisAactive['isactivated'] = '1';
             if($this->api_model->doctor_doc_status($data['id'], $dataisAactive)) {
                 $login_detail = $this->login_cheak_model->login_paravate($data['email'], $data['password']);
                    if(!empty($login_detail)) {
                        //redirection when user login
                        $login_id = $login_detail[0]['doctor_id'];
                        $login_name = $login_detail[0]['username'];
                        $type = 0;
                        $this->session->set_userdata('users_id', $login_id);
                        $this->session->set_userdata('user_name', $login_name);
                        $this->session->set_userdata('user_type', $type);
                        return redirect(base_url().'all_videos');
                    } else {
                        $this->load->view('vet_reg/registration/header');
                        $data['details'] = $this->session->userdata("active_account_details");
                        $data['showsecondtab'] = 1;
                        $this->load->view('vet_reg/registration/active_your_account', $data);
                    }
                }
            }
    
    public function check_ref_hpkd(){
        $ref = $this->input->get_post('ref');
        if(!isset($ref) || $ref == ''){
                $json['success'] =  false;
                $json['error'] = "Please send referral code";
        }else{
            if($ref == '92018397'){
                $json['success'] =  TRUE;
                $json['data'] = [];
            }else{
                $ref_data = $ref_count = $this->api_model->count_refral_uses($ref);
                if($ref_data[0]['count'] == '50'){
                    $json['success'] =  false;
                    $json['error'] = "Your referral code is invalid";
                }else{
                    $data = $this->api_model->check_ref($ref);
                    if(!$data){
                        $json['success'] =  false;
                        $json['error'] = "Your referral code is not matched";
                    }else{
                        $json['success'] =  TRUE;
                        $json['data'] = $data;
                    }
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }


    public function yearDropdownMenu($start_year = 1950, $end_year = 2020, $id='year_select', $selected=null) {
        $end_year = is_null($end_year) ? date('Y') : $end_year;
        $selected = is_null($selected) ? date('Y') : $selected;
        $r = range($start_year, $end_year);
        return $r;
    }

    public function get_city(){
        $state_id = $this->input->get_post('state_id');
        if(!isset($state_id) || $state_id == ''){
            echo "Please send state id";
        }else{
            $data = $this->front_end_model->get_city($state_id);
        }
        // print_r($data);
        // exit;
		header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    public function get_premium_detail(){
        $data = $this->front_end_model->premium_type();
        $detail = [];
        foreach($data as $d){
            $d['benefits'] = $this->front_end_model->get_benefits($d['id']);
            $detail[] = $d;
        }
        $json['success'] = True;
        $json['data'] = $detail;
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    } 
    public function semen_bull_listing(){
        $this->load->view('semen_bull_listing');
    }
    public function payment_success(){
        $this->load->view('registration_done');
    }
    public function get_user_by_ref(){
        $ref = $this->input->get_post('ref');
        $data = $this->front_end_model->get_user_by_ref_code($ref);
        echo json_encode($data);
    }
}