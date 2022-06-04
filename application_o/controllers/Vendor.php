<?php
class Vendor extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
    }
    public function index(){
        $this->load->view('front_end/otp');
    }
    public function request_for_otp(){
        $phone = $this->input->get_post('mobile');
        if(isset($phone)){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://2factor.in/API/V1/85aab6cd-b267-11e7-94da-0200cd936042/SMS/".$phone."/AUTOGEN/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: 8d67126e-6fa5-4bab-bb00-165629b84df3",
                "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
            $json['data'] = json_decode($response);
            echo json_encode($json);
            }
        }else{
            $opt = $this->input->get_post('opt');
            $detail = $this->input->get_post('detail');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://2factor.in/API/V1/85aab6cd-b267-11e7-94da-0200cd936042/SMS/VERIFY/".$detail."/".$opt."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: ba5992bd-eb5a-46a5-80ad-032e7a59f945",
                "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
                $json['data'] = json_decode($response);
                echo json_encode($json);
            }
        }               
    }
    public function vendor_reg(){
        if(isset($_POST['sub'])){
           $data['bank_name'] = $this->input->get_post('name');
           $data['email'] = $this->input->get_post('email');
           $data['fname'] = $this->input->get_post('contact_person');
           $data['password'] = md5($this->input->get_post('password'));
           $data['authorisation_letter'] = $this->input->get_post('authorisation_letter');
           $type = $this->input->get_post('type');
           $type2 = $type;
           if($type == 'partnership'){
                $user_type = 2;
                $type = '12';
           }else if($type == 'public'){
                $user_type = 3;
                $type = '12';
           }else if($type == 'gov'){
                $user_type = 4;
                $type = '12';
           }else if($type == 'indivisual'){
                $user_type = 1;
                $type = '13';
           }else if($type == 'dev'){
                $user_type = 9;
                $type = '19';
           }
           $data['user_type'] = $user_type;
           $data['type'] =  $type;
           $data['pan_no'] = $this->input->get_post('pan');
           $data['mobile'] = $this->input->get_post('mobile');
           $data['cin'] = $this->input->get_post('reg_num');
           $data['state'] = $this->input->get_post('state');
           $data['district'] = $this->input->get_post('district');
           $data['pin'] = $this->input->get_post('pincode');
           $data['adhar_no'] = $this->input->get_post('aadhar_no');
           $data['address'] = $this->input->get_post('full_address').' '.$this->input->get_post('full_address1');
           $data['address_document'] = $this->input->get_post('address_doc_image');
           $data['adhar_image'] = $this->input->get_post('aadhar_image_image');
           $data['created_on'] = date('Y-m-d h:i:s');
           $data['gst_no'] = $this->input->get_post('gst_no');
           $data['adhar_back_image'] = $this->input->get_post('aadhar_image_back_image');
           $data['proprietorship_document'] = $this->input->get_post('partnership_deed_image');
           $data['cin_document'] = $this->input->get_post('reg_certificate_image');
           if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
                if($detail = $this->api_model->add_bank($data)){
                    //print_r($detail);
                    // $json['success']  = true; 
                    // $json['data'] = $this->api_model->get_seman_company_id($detail);
                    //$json['data'] = $this->api_model->get_seman_company_id($detail);
                    $login = $this->api_model->get_admin_detail($detail);
                    $login_id = $login[0]['admin_id'];
                    $login_name = $login[0]['fname'];
                    $status = $login[0]['type'];
                    $hspid = $login[0]['hospital_id'];
                    $type =  $login[0]['user_type'];
                    $this->session->set_userdata('user_id', $login_id);
                    $this->session->set_userdata('user_name', $login_name);
                    $this->session->set_userdata('type', $type);
                    $this->session->set_userdata('status', $status);
                    $this->session->set_userdata('hspid', $hspid);
                    redirect(base_url().'?suc=suc');
                }else{
                    $json['success']  = false; 
                    $json['error'] = "Error with database";
                }
            }else{
                //print_r($_REQUEST);
                echo "this email is already exists";
                $data['type'] = $type2;
                //print_r($data);
                $this->load->view('front_end/vendor_reg', $data);
                // $json['success']  = false; 
                // $json['error'] = "Email ID is already associated with other Account";
            }
           //$this->load->view('front_end/vendor_reg');
        }else{
            $this->load->view('front_end/vendor_reg');
        }
    }
    public function vendor_done(){
        $this->load->view('front_end/reg_done');
    }
    public function vendor_re(){
        $this->load->view('front_end/company_type');
    }
    public function authorise(){
        $data['type'] = $this->input->get_post('type');
        $this->load->view('front_end/authorise', $data);
    }
    public function product_vendor(){
        $this->load->view('front_end/product_company_type');
    }
    public function product_otp(){
        $this->load->view('front_end/product_otp');
    }
    public function product_vendor_reg(){
        if(isset($_POST['sub'])){
            $data['bank_name'] = $this->input->get_post('name');
            $data['email'] = $this->input->get_post('email');
            $data['fname'] = $this->input->get_post('contact_person');
            $data['password'] = md5($this->input->get_post('password'));
            $data['authorisation_letter'] = $this->input->get_post('authorisation_letter');
            $type = $this->input->get_post('type');
            $type2 = $type;
            if($type == 'partnership'){
                 $user_type = 15;
                 $type = '18';
            }else if($type == 'public'){
                 $user_type = 16;
                 $type = '18';
            }else if($type == 'gov'){
                 $user_type = 17;
                 $type = '18';
            }else if($type == 'indivisual'){
                 $user_type = 14;
                 $type = '18';
            }
            $data['user_type'] = $user_type;
            $data['type'] =  $type;
            $data['pan_no'] = $this->input->get_post('pan');
            $data['mobile'] = $this->input->get_post('mobile');
            $data['cin'] = $this->input->get_post('reg_num');
            $data['state'] = $this->input->get_post('state');
            $data['district'] = $this->input->get_post('district');
            $data['pin'] = $this->input->get_post('pincode');
            $data['adhar_no'] = $this->input->get_post('aadhar_no');
            $data['address'] = $this->input->get_post('full_address').' '.$this->input->get_post('full_address1');
            $data['address_document'] = $this->input->get_post('address_doc_image');
            $data['adhar_image'] = $this->input->get_post('aadhar_image_image');
            $data['created_on'] = date('Y-m-d h:i:s');
            $data['gst_no'] = $this->input->get_post('gst_no');
            $data['adhar_back_image'] = $this->input->get_post('aadhar_image_back_image');
            $data['proprietorship_document'] = $this->input->get_post('partnership_deed_image');
            $data['cin_document'] = $this->input->get_post('reg_certificate_image');
            if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
                 if($detail = $this->api_model->add_bank($data)){
                     //print_r($detail);
                     // $json['success']  = true; 
                     // $json['data'] = $this->api_model->get_seman_company_id($detail);
                     //$json['data'] = $this->api_model->get_seman_company_id($detail);
                     $login = $this->api_model->get_admin_detail($detail);
                     $login_id = $login[0]['admin_id'];
                     $login_name = $login[0]['fname'];
                     $status = $login[0]['type'];
                     $hspid = $login[0]['hospital_id'];
                     $type =  $login[0]['user_type'];
                     $this->session->set_userdata('user_id', $login_id);
                     $this->session->set_userdata('user_name', $login_name);
                     $this->session->set_userdata('type', $type);
                     $this->session->set_userdata('status', $status);
                     $this->session->set_userdata('hspid', $hspid);
                     redirect(base_url().'?suc=suc');
                 }else{
                     $json['success']  = false; 
                     $json['error'] = "Error with database";
                 }
             }else{
                 //print_r($_REQUEST);
                 echo "this email is already exists";
                 $data['type'] = $type2;
                 //print_r($data);
                 $this->load->view('front_end/product_vendor_reg', $data);
                 // $json['success']  = false; 
                 // $json['error'] = "Email ID is already associated with other Account";
             }
            //$this->load->view('front_end/vendor_reg');
         }else{
             $this->load->view('front_end/product_vendor_reg');
         }
    }
}