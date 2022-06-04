<?php
class Vetreg extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('front_end_model');
        $this->load->model('api_model');
        $this->load->model('login_cheak_model');
        $this->load->model('loginmodel');
    }
    public function login(){
       $this->load->view('front_end/product/header');
       $this->load->view('vet_reg/registration/login_reg');
    }
    public function ecommerce_page(){
        $this->load->view('vet_reg/ecommerce_page.php');
    }
    public function homepage(){
        $this->load->view('vet_reg/homepage');
    }
    public function pricingList(){
         $this->load->view('vet_reg/pricingList.php');
    }
     public function product_otp(){
        $this->load->view('vet_reg/product_otp');
    }
    public function vet_registration(){
    	 $this->load->view('vet_reg/registration/header');
         $this->load->view('vet_reg/registration/vet_registration');
    }
    public function registration(){
        //$data['mobile'] = $_REQUEST['mobile'];
        //print_r('reg3_edu.....');
        //echo "<pre>";
        //print_r($this->session->userdata("reg3_edu"));
        /*print_r('reg4_experience.....');
        print_r($this->session->userdata("reg4_experience"));
        print_r('reg5_regdetails.....');
        print_r($this->session->userdata("reg5_regdetails"));
        print_r('reg6_bankdetails.....');
        print_r($this->session->userdata("reg6_bankdetails"));*/
        //print_r('reg2_edu.....');
        $data['mobile'] = $this->input->get_post('mobile');
        if(empty($this->session->userdata("steps"))) {
            $this->session->set_userdata('steps', 'basicinformation');
        }
        $data = $this->session->userdata('reg2');
        if($this->session->userdata("steps") == 'qualification') {
            $specializationList = $this->login_cheak_model->get_specialisation_for_vetreg();;
            $years = $this->yearDropdownMenu();
            $data['years'] = $years;
            $data['specialization'] = $specializationList;
            $this->load->view('vet_reg/registration/header');
            $this->load->view('vet_reg/registration/registration', $data);
        } else if($this->session->userdata("steps") == 'registration') {
            $years = $this->yearDropdownMenu();
            $data['years'] = $years;
            $this->load->view('vet_reg/registration/header');
            $this->load->view('vet_reg/registration/registration', $data);
        } else {
            $data['steps'] = 'basicinformation';
            if($_POST['submit']){
                $data['first_name'] = $this->input->get_post('first_name');
                $data['gender'] = $this->input->get_post('options');
                $data['email'] = $this->input->get_post('your_email');
                $data['mobile_code'] = '+91';
                $data['mobile'] = $data['mobile'];
                //$data['mobile'] = $this->input->get_post('mobile');
                $data['pincode'] = $this->input->get_post('pincode');
                $data['place'] = $this->input->get_post('place');
                $data['state'] = $this->input->get_post('state');
                $data['address'] = $this->input->get_post('address');
                $data['passcode'] = $this->input->get_post('passcode');
                $confirm_pass = $this->input->get_post('confirm_passcode');
                $data['adhar'] = $this->input->get_post('adhar');
                $data['profileimage'] = $this->input->get_post('image_name');
                $data['addarcardimage'] = $this->input->get_post('aadharcar_name');
                if($this->input->get_post('telephonicConsult')==1) {
                    $data['telephonicConsult'] = $this->input->get_post('telephonicConsult');
                    $data['telephonicConsultText']  = $this->input->get_post('telephonicConsultText');
                } else {
                    $data['telephonicConsult'] = '0';
                    $data['telephonicConsultText']  = '0';
                }
                if($this->input->get_post('homeVisit')==1) {
                    $data['homeVisit'] = $this->input->get_post('homeVisit');
                    $data['homeVisitChangesText']  = $this->input->get_post('homeVisitChangesText');
                } else {
                    $data['homeVisit'] = '0';
                    $data['homeVisitChangesText']  = '0';
                }
                $data['your_email'] = $this->input->get_post('your_email');
                $this->form_validation->set_rules('first_name','Please Enter Name','required|trim');
                $this->form_validation->set_rules('your_email','Please Enter Your Email','required|trim');
                $this->form_validation->set_rules('pincode','Please Enter Pin Code','numeric|required|trim');
                $this->form_validation->set_rules('place','Please Enter place','required|trim');
                $this->form_validation->set_rules('state','Please Enter State','required|trim');
                $this->form_validation->set_rules('address','Please Enter address','required|trim');
                $this->form_validation->set_rules('passcode','Please Enter passcode','numeric|required|trim');
                $this->form_validation->set_rules('confirm_passcode','Please Enter Confirm passcode','numeric|required|trim');
                $this->form_validation->set_rules('adhar','Please Enter Adhar No','numeric|required|trim');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');              
                if($this->form_validation->run('add_bank')){
                    $data['created_on'] = date('Y-m-d h:i:s');
                    if($data['passcode'] != $confirm_pass){
                        $this->session->set_flashdata('add_bank','Passcode and Confiem Passcode is not matched');
                        $this->load->view('vet_reg/registration/header');
                        $this->load->view('vet_reg/registration/registration', $data);
                    }else if($this->api_model->docmobileadhaarcheck($data['mobile'], $data['mobile_code'])){
                        $this->session->set_flashdata('add_bank','Mobile No Already Exist');
                        $this->load->view('vet_reg/registration/header');
                        $this->load->view('vet_reg/registration/registration', $data);
                    }elseif($this->api_model->docadhaarcheck($data['adhar'])){
                        $this->session->set_flashdata('add_bank','Adhaar already associated with another account.');
                        $this->load->view('vet_reg/registration/header');
                        $this->load->view('vet_reg/registration/registration', $data);
                    }elseif($this->api_model->docemailcheck($data['your_email'])){
                        $this->session->set_flashdata('add_bank','Email is already associated with another account.');
                        $this->load->view('vet_reg/registration/header');
                        $this->load->view('vet_reg/registration/registration', $data);
                    }else{
                        $this->session->set_userdata('reg2', $data);
                        $this->session->set_userdata('steps', 'qualification');
                        $specializationList = $this->login_cheak_model->get_specialisation_for_vetreg();;
                        $years = $this->yearDropdownMenu();
                        $data['years'] = $years;
                        $data['specialization'] = $specializationList;
                        $this->load->view('vet_reg/registration/header');
                        $this->load->view('vet_reg/registration/registration', $data);
                    }
                }else{
                    $this->load->view('vet_reg/registration/header');
                    $this->load->view('vet_reg/registration/registration', $data);
                }
            } else {
                $this->load->view('vet_reg/registration/header');
                $this->load->view('vet_reg/registration/registration', $data);
            }
        }
    }

    public function reg3_edu(){
        if(!empty($this->session->userdata("reg2"))){
            $years = $this->yearDropdownMenu();
            $specializationList = $this->login_cheak_model->get_specialisation_for_vetreg();
            $data['specializationFullList'] = '';
            if($_POST['submit']){
                 if(!$_POST['telephonicConsult']){
                    $data['EDU'] = $this->input->get_post('EDU');
                    $data['institute'] = $this->input->get_post('institute');
                    $data['specialization'] = $this->input->get_post('specialization');
                    $data['yearCompletion'] = $this->input->get_post('yearCompletion');
                    $this->form_validation->set_rules('EDU','Please Enter Education','required|trim');
                    $this->form_validation->set_rules('institute','Please Enter institute','required|trim');
                    $this->form_validation->set_rules('yearCompletion','Please Enter Year Completion','required|trim');
                    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');              
                    if($this->form_validation->run('add_bank')){
                        if($this->input->get_post('documents_name')) {
                            $data['addarcardimage'] = $this->input->get_post('documents_name');
                            $image_name = $this->input->get_post('documents_name');
                            $newArray = array();
                            $newArray['educatonimage'] = $image_name;
                            $newArray['EDU'] = $this->input->get_post('EDU');
                            $newArray['institute'] = $this->input->get_post('institute');
                            $newArray['yearCompletion'] = $this->input->get_post('yearCompletion');
                            $newArray['educatonAdditional'] = $this->input->get_post('educatonAdditional');
                            $newArray['specialization'] = $this->input->get_post('specialization');
                            $data[] = $newArray;
                            $data['specializationFullList'] = $this->input->get_post('specialization');
                            $data['is_available_consultation'] = $this->input->get_post('telephonicConsult');
                            $data['avaialable_for_visit'] = $this->input->get_post('homeVisit');
                            $data['homeVisitChanges'] = $this->input->get_post('homeVisitChangesText');

                        }
                        if($this->input->get_post('educaton_image1')){
                            $image_name = $this->input->get_post('educaton_image1');
                            $newArray = array();
                            $newArray['educatonimage1'] = $image_name;
                            $newArray['EDU1'] = $this->input->get_post('EDU1');
                            $newArray['institute1'] = $this->input->get_post('institute1');
                            $newArray['yearCompletion1'] = $this->input->get_post('yearCompletion1');
                            $newArray['educatonAdditional1'] = $this->input->get_post('educatonAdditional1');
                            $newArray['specialization1'] = $this->input->get_post('specialization1');
                            $data[] = $newArray;
                            $data['specializationFullList'] = $data['specializationFullList'].','.$this->input->get_post('specialization1');
                        }
                        if($this->input->get_post('educaton_image2')){
                            $image_name = $this->input->get_post('educaton_image2');
                            $newArray = array();
                            $newArray['educatonimage2'] = $image_name;
                            $newArray['EDU2'] = $this->input->get_post('EDU2');
                            $newArray['institute2'] = $this->input->get_post('institute2');
                            $newArray['yearCompletion2'] = $this->input->get_post('yearCompletion2');
                            $newArray['educatonAdditional2'] = $this->input->get_post('educatonAdditional2');
                            $newArray['specialization2'] = $this->input->get_post('specialization2');
                            $data[] = $newArray;
                            $data['specializationFullList'] = $data['specializationFullList'].','.$this->input->get_post('specialization2');

                        }
                        if($this->input->get_post('educaton_image3')){
                            $image_name = $this->input->get_post('educaton_image3');
                            $newArray = array();
                            $newArray['educatonimage3'] = $image_name;
                            $newArray['EDU3'] = $this->input->get_post('EDU3');
                            $newArray['institute3'] = $this->input->get_post('institute3');
                            $newArray['yearCompletion3'] = $this->input->get_post('yearCompletion3');
                            $newArray['educatonAdditional3'] = $this->input->get_post('educatonAdditional3');
                            $newArray['specialization3'] = $this->input->get_post('specialization3');
                            $data[] = $newArray;
                            $data['specializationFullList'] = $data['specializationFullList'].','.$this->input->get_post('specialization3');
                        }
                        /* echo "<pre>";
                        print_r($data);
                        die();*/
                        $this->session->set_userdata('reg3_edu', $data);
                        $this->session->set_userdata('steps', 'experience');
                        return redirect(base_url().'vetreg/registration');
                    }else{
                        $this->load->view('vet_reg/registration/header');
                        $data['years'] = $years;
                        $data['specialization'] = $specializationList;
                        $this->session->set_userdata('steps', 'qualification');
                        $this->load->view('vet_reg/registration/registration', $data);
                    } 
            }else{
                $this->session->set_userdata('reg3_edu', $data);
                $this->session->set_userdata('steps', 'experience');
                return redirect(base_url().'vetreg/registration');
            }
            }else{
                $this->load->view('vet_reg/registration/header');
                $data['years'] = $years;
                $data['specialization'] = $specializationList;
                $this->load->view('vet_reg/registration/registration', $data);
            }
        } else {
           return redirect(base_url().'vetreg/registration');
        }
    }


    public function reg4_experience(){
        //print_r($_REQUEST);
        //print_r($this->session->userdata("reg2"));
        //print_r('reg3_edu.....');
        //print_r($this->session->userdata("reg3_edu"));
        //if(!empty($this->session->userdata("reg2")) && !empty($this->session->userdata("reg3_edu"))) {
        if(isset($_POST['submit'])){
            $data['total_experince'] = $this->input->get_post('total_experince');
            $name_organization = $this->input->get_post('name_organization');
            $designation = $this->input->get_post('designation');
           // print_r($designation);
            $fromdate = $this->input->get_post('fromdate');
            $fromtodate = $this->input->get_post('fromtodate');
            $descriptions= $this->input->get_post('descriptions');
            // print_r($descriptions);
            // exit;
            $detial = [];
            $i = 0;
            foreach($name_organization as $na){
                if(!empty($na)) {
                    $detial[$i]['name_organization'.$i] = $na;
                    $detial[$i]['designation'] = $designation[$i];
                    //$date = new DateTime('2020-07-25');
                    //$date->format('Y-m-d H:i:s');
                    $detial[$i]['fromdate'] = $fromdate[$i];
                    $detial[$i]['fromtodate'] = $fromtodate[$i];
                    $detial[$i]['descriptions'] = $descriptions[$i];
                    $i = $i + 1;
                }
            }
            $data['experince_list'] = $detial;
            $data['specialize'] = $this->input->get_post('checkbox1');
            if($this->input->get_post('telephonicConsult') != 'on'){
                    //$this->form_validation->set_rules('total_experince','Please Enter Experince','numeric|required|trim');
                    //$this->form_validation->set_rules('checkbox1','Please Enter Specialization','required|trim');
                    if (!empty($this->input->get_post('checkbox1'))){
                        $this->form_validation->set_rules('checkbox1',"Expertise", "trim|xss_clean|numeric");
                    } else {
                        $this->form_validation->set_rules('checkbox1',"Expertise", "trim|required");
                    }
                    //$this->form_validation->set_rules('name_organization','Please Enter Year Completion','required|trim');
                    //$this->form_validation->set_rules('designation','Please Enter Educaton Additional','required|trim');
                    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');     
                    if($this->form_validation->run('add_bank')){
                        $this->session->set_userdata('reg4_experience', $data);
                        $this->session->set_userdata('steps', 'registration');
                        return redirect(base_url().'vetreg/registration');
                    }else{
                        $this->load->view('vet_reg/registration/header');
                        $this->session->set_userdata('steps', 'experience');
                        $this->load->view('vet_reg/registration/registration', $data);
                    }
            }else{
                $this->session->set_userdata('experience', $data);
                return redirect(base_url().'vetreg/registration');
            }  
        }else{
            $this->load->view('vet_reg/registration/header');
            $this->session->set_userdata('steps', 'experience');
            $this->load->view('vet_reg/registration/registration', $data);
        }
    }
    public function reg5_regdetails(){
        //print_r($this->session->userdata("reg2"));
        //print_r('reg3_edu.....');
        //print_r($this->session->userdata("reg3_edu"));
        //print_r('reg4_experience.....');
        //print_r($this->session->userdata("reg4_experience"));
        if(!isset($_POST['telephonicConsult'])){
            // if(!empty($this->session->userdata("reg2")) 
            //     && !empty($this->session->userdata("reg3_edu")) 
            //     && !empty($this->session->userdata("reg4_experience"))) {
                $years = $this->yearDropdownMenu();
                if($_POST['submit']){
                    $data['regisration_number'] = $this->input->get_post('regisration_number');
                    $data['registeration_council'] = $this->input->get_post('regisration_council');
                    $data['registeration_year'] = $this->input->get_post('year_registration');
                    $this->form_validation->set_rules('regisration_number','Please Enter Regisration number','numeric|required|trim');
                    $this->form_validation->set_rules('regisration_council','Please Enter Council','required|trim');
                    $this->form_validation->set_rules('year_registration','Please Enter Year Regisration','required|trim');
                    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');              
                        if($this->form_validation->run('add_bank')){
                            $this->session->set_userdata('reg5_regdetails', $data);
                            $this->session->set_userdata('steps', 'bankdetails');
                            return redirect(base_url().'vetreg/registration#bankdetails');
                        }else{
                            $this->load->view('vet_reg/registration/header');
                            $data['years'] = $years;
                            $this->session->set_userdata('steps', 'registration');
                            $this->load->view('vet_reg/registration/registration', $data);
                        }
                    }else{
                        //return redirect(base_url().'vetreg/reg6_bankdetails');
                        //  $this->load->view('vet_reg/registration/header');
                        // $data['years'] = $years;
                        // $this->load->view('vet_reg/registration/reg5_regdetails', $data);
                       $this->load->view('vet_reg/registration/header');
                       $data['years'] = $years;
                       $this->session->set_userdata('steps', 'registration');
                       $this->load->view('vet_reg/registration/registration', $data);
                    }
            // }else{
            //    return redirect(base_url().'vetreg/reg2');
            //    // return redirect(base_url().'vetreg/reg6_bankdetails');
            // }
        } else {
            return redirect(base_url().'vetreg/reg6_bankdetails');
        }
    }
    public function reg6_bankdetails(){
        if($_POST['submit']){
            if(!isset($_POST['telephonicConsult'])){
                $data['acct_holder_name'] = $this->input->get_post('acct_holder_name');
                $data['account_no'] = $this->input->get_post('acct_number');
                $data['bank_name'] = $this->input->get_post('bank_name');
                $data['ifsc'] = $this->input->get_post('ifsc');
                $data['branch_address'] = $this->input->get_post('branch_address');
                $this->form_validation->set_rules('acct_holder_name','Please Enter Account Holder','required|trim');
                $this->form_validation->set_rules('acct_number','Please Enter Account number','numeric|required|trim');
                $this->form_validation->set_rules('bank_name','Please Enter Bank Name','required|trim');
                $this->form_validation->set_rules('ifsc','Please Enter ifsc','required|trim');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');              
                if($this->form_validation->run('add_bank')){
                    $this->session->set_userdata('reg6_bankdetails', $data);
                    $this->session->set_userdata('steps', 'language');
                    return redirect(base_url().'vetreg/registration#language');
                }else{
                    $this->session->set_userdata('reg6_bankdetails', $data);
                    $this->session->set_userdata('steps', 'language');
                    return redirect(base_url().'vetreg/registration#language');
                }
            }else{
                $this->session->set_userdata('reg6_bankdetails', $data);
                $this->session->set_userdata('steps', 'language');
                return redirect(base_url().'vetreg/registration#language');
            }   
        }else{
            $this->load->view('vet_reg/registration/header');
            $this->session->set_userdata('steps', 'bankdetails');
            $this->load->view('vetreg/registration', $data);
        }
    }

    public function reg7_language(){

        $add_attributes['reg2'] = $_SESSION['reg2'];
        $add_attributes['reg3_edu'] = $_SESSION['reg3_edu'];
        $add_attributes['reg4_experience'] =$_SESSION['reg4_experience'];
        $add_attributes['reg5_regdetails'] =$_SESSION['reg5_regdetails'];
        $add_attributes['reg6_bankdetails'] =$_SESSION['reg6_bankdetails'];
        $add_attributes['reg7_language'] = $_SESSION['reg7_language'];
        /*echo "<pre>";
        print_r($add_attributes);
        die('aaaaaaa');*/
        
            if($_POST['submit']){
                $data['languages'] = $this->input->get_post('checkbox1');
                if (!empty($this->input->get_post('checkbox1'))){
                    $this->form_validation->set_rules('checkbox1',"Please Select language", "trim|xss_clean|numeric");
                } else {
                    $this->form_validation->set_rules('checkbox1',"Please Select language", "trim|required");
                }
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');              
                if($this->form_validation->run('add_bank')){

                    if(empty($_SESSION['reg2'])) {
                       $this->session->set_userdata('steps', 'basicinformation');
                       return redirect(base_url().'vetreg/registration#basicinformation');
                    } else if(empty($_SESSION['reg3_edu'])) {
                        $this->session->set_userdata('steps', 'qualification');
                        return redirect(base_url().'vetreg/registration#qualification');
                    } else if(empty($_SESSION['reg4_experience'])) {
                        $this->session->set_userdata('steps', 'experience');
                        return redirect(base_url().'vetreg/registration#experience');
                    } else if(empty($_SESSION['reg5_regdetails'])) {
                        $this->session->set_userdata('steps', 'registration');
                        return redirect(base_url().'vetreg/registration#registration');
                    } else if(empty($_SESSION['reg6_bankdetails'])) {
                        $this->session->set_userdata('steps', 'bankdetails');
                        return redirect(base_url().'vetreg/registration#bankdetails');
                    } else {
                        $this->session->set_userdata('reg7_language', $data);
                        $reg3_edu = $_SESSION['reg3_edu'];
                        $reg4_experience = $_SESSION['reg4_experience'];
                        $data['adhaar_img'] = $_SESSION['reg2']['addarcardimage'];
                        $data['username'] = $_SESSION['reg2']['first_name'];
                        $data['gender'] = $_SESSION['reg2']['gender'];
                        $data['email'] = $_SESSION['reg2']['email'];
                        $data['mobile_code'] = $_SESSION['reg2']['mobile_code'];
                        $data['mobile'] = $_SESSION['reg2']['mobile'];
                        $data['pincode'] = $_SESSION['reg2']['pincode'];
                        $data['city'] = $_SESSION['reg2']['place'];
                        $data['state'] = $_SESSION['reg2']['state'];
                        $data['address_full'] = $_SESSION['reg2']['address'];
                        $data['password'] = md5($_SESSION['reg2']['passcode']);
                        $data['aadhar_no'] = $_SESSION['reg2']['adhar'];
                        $data['telephonic_consult'] = $_SESSION['reg2']['telephonicConsultText'];
                        $data['home_visit_changes'] = $_SESSION['reg2']['homeVisitChangesText'];
                        $data['is_available_consultation'] = $_SESSION['reg2']['telephonicConsult'];
                        $data['avaialable_for_visit'] = $_SESSION['reg2']['homeVisit'];
                        $data['date'] = $_SESSION['reg2']['created_on'];
                        $data['image'] = $_SESSION['reg2']['profileimage'];
                        $data['specialisation_list'] = $_SESSIN['reg2']['specializationFullList'];
                        $data['registration_no'] = $_SESSION['reg5_regdetails']['regisration_number'];
                        $data['registration_no'] = $_SESSION['reg5_regdetails']['regisration_number'];
                        $data['registeration_council'] = $_SESSION['reg5_regdetails']['registeration_council'];
                        $data['registeration_year'] = $_SESSION['reg5_regdetails']['registeration_year'];
                        $data['account_holder_name'] = $_SESSION['reg6_bankdetails']['acct_holder_name'];
                        $data['account_no'] = $_SESSION['reg6_bankdetails']['account_no'];
                        $data['bank_name'] = $_SESSION['reg6_bankdetails']['bank_name'];
                        $data['ifsc_code'] = $_SESSION['reg6_bankdetails']['ifsc'];
                        $data['branch_address'] = $_SESSION['reg6_bankdetails']['branch_address'];
                        $data['languages'] = implode(",", $_SESSION['reg6_bankdetails']['languages']);
                        $data['languages'] = implode(",", $_SESSION['reg7_language']['languages']);
                        $data['users_type'] = 'pvt_doc';
                        $data['dob'] = $_SESSION['reg2']['created_on'];
                        $data['total_experience'] = $_SESSION['reg4_experience']['total_experince'];
                        $data['experience_desc'] = $_SESSION['reg4_experience']['designation'];
                        $data['date'] = date('Y-m-d h:i:s');
                        $data['district_code'] = '';
                        $data1['expertise_list'] = $_SESSION['reg4_experience']['experince_list'];
                        $num_str = sprintf("%08d", mt_rand(1, 99999999));
                        $data['refral_code'] = $num_str;
                        $data['refral_by_code'] = '';
                 
                        if($last_id = $this->api_model->insert_doc_info($data)){
                            if(!empty($reg3_edu)){
                                foreach($reg3_edu as $key=>$quali){
                                    if($key!== 'specializationFullList') {
                                        if($key == 0) {
                                            $quali_data['doc_id'] =  $last_id;
                                            $quali_data['qualifi_id'] = $quali['EDU'];
                                            $quali_data['institute'] =  $quali['institute'];
                                            $quali_data['speci_id'] =  json_encode(array($quali['specialization']));
                                             $quali_data['year'] =  $quali['yearCompletion'];
                                            $quali_data['document'] = $quali['educatonimage']; 
                                        } else {
                                            $quali_data['doc_id'] =  $last_id;
                                            $quali_data['qualifi_id'] =  $quali['EDU'.$key];
                                            $quali_data['document'] = $quali['educatonimage'.$key];
                                            $quali_data['institute'] =  $quali['institute'.$key];
                                            $quali_data['speci_id'] =  json_encode(array($quali['specialization'].$key));
                                            $quali_data['year'] =  $quali['yearCompletion'.$key];
                                        }
                                        $this->api_model->insert_doc_quali($quali_data);
                                    }
                                }
                            }
                            
                            if(!empty($data1['expertise_list'])){
                                foreach ($data1['expertise_list'] as $key => $value) {
                                    $exp_data['doc_id'] = $last_id;
                                    $exp_data['designation'] = $data1['expertise_list'][$key]['designation'];
                                    $exp_data['from_date']=  $data1['expertise_list'][$key]['fromdate'];
                                    $exp_data['organization']= $data1['expertise_list'][$key]['name_organization0'];
                                    $exp_data['to_date']=  $data1['expertise_list'][$key]['fromtodate'];
                                    $exp_data['year']= '';
                                    $ex = $this->api_model->insert_doc_exp($exp_data);
                                }
                               
                            }
                            $last_data = $this->api_model->get_doc_id_det($last_id);
                            $last_data['expertise_list'] = explode(',',$last_data['expertise_list']);
                            $last_data['image'] =  base_url().'harpahu_merge/uploads/doc/'.$last_data['image'];
                            $json['success'] = TRUE;
                            $json['msg'] =  "Its Done";
                            $json['data'][] = $last_data;

                            //login details and redirect
                            $dataisAactive['isactivated'] = '1';
                            if($this->api_model->doctor_doc_status($last_id, $dataisAactive)) {
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
                                }
                            }
                            //$this->session->set_userdata('active_account_details', $json);
                            //$this->session->unset_userdata("reg2");
                            //$this->session->unset_userdata("reg3_edu");
                            //$this->session->unset_userdata("reg4_experience");
                            //$this->session->unset_userdata("reg5_regdetails");
                            //$this->session->unset_userdata("reg6_bankdetails");
                            //$this->session->unset_userdata("reg7_bankdetails");
                            //return redirect(base_url().'vetreg/active_your_account/?id='.$last_id);
                        }
                    }
                } else {
                    $this->load->view('vet_reg/registration/header');
                    $this->load->view('vet_reg/registration/reg7_language');
                }
            } else {
                $this->load->view('vet_reg/registration/header');
                $this->load->view('vet_reg/registration/reg7_language');
            }
        // } else {
        //     return redirect(base_url().'vetreg/reg2');
        // }
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