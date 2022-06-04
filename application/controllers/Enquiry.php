<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Enquiry extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Enquiry_model');
		$this->load->model('Pushnoti_model');
    }
	
    public function enquiry_form(){
        $users_id =$this->input->get_post('users_id');
		$name =$this->input->get_post('name');
		$ani_name =$this->input->get_post('ani_name');
		$enquiry_form =$this->input->get_post('enquiry_form');
		$address = $this->input->get_post('address');
		$mobile_no =$this->input->get_post('mobile_no');
		$fathers_name =$this->input->get_post('fathers_name');
		$image = json_decode($_REQUEST['image']); //	["01552885268.jpg","11552885268.jpg"]
		$district =$this->input->get_post('district');
		$tehsil =$this->input->get_post('tehsil');
		$village =$this->input->get_post('village');
	    $locality =$this->input->get_post('locality');
		$house_no =$this->input->get_post('house_no');
		$email =$this->input->get_post('email');
		$total_animals =$this->input->get_post('total_animals');
		$ani_category_id =$this->input->get_post('ani_category_id');
		$ani_breed_id =$this->input->get_post('ani_breed_id');
		$ani_gendor =$this->input->get_post('ani_gendor');
		$ani_tag_no =$this->input->get_post('ani_tag_no');
		$ani_dob =$this->input->get_post('ani_dob');
		$ani_vt_id =$this->input->get_post('ani_vt_id');
		$ani_sire_name =$this->input->get_post('ani_sire_name');
		$ani_sire_breed_id =$this->input->get_post('ani_sire_breed_id');
		$ani_dam_name =$this->input->get_post('ani_dam_name');
		$ani_dam_breed_id =$this->input->get_post('ani_dam_breed_id');
		
		
		 $enquiry_exist = $this->Enquiry_model->enquiry_already_exist($users_id,$enquiry_form);
			if($enquiry_exist)
			{
				 $data['error'] =  "Already request in process";
			}
		 
		 if($image)
		 {
		 $img = implode(',', $image);
		 }
		 
		if($enquiry_form == '6')
		 {
		 $status = "1";
		 }
	
		   
		if(empty($data['error']))
		{
			$datafiled = [
			'users_id'     => $users_id,
			'enquiry_form' => $enquiry_form,
			'mobile_no'    => $mobile_no? $mobile_no : '0',
			'address'      => $address,
			'name'         => $name ? $name : '0',
			'ani_name'     => $ani_name ? $ani_name : '0',
			'fathers_name' => $fathers_name ? $fathers_name : '0',
			'district'     => $district ? $district: '0',
			'tehsil'       => $tehsil ? $tehsil: '0',
			'village'      => $village ? $village: '0',
			'locality'     => $locality ? $locality: '0',
			'house_no'     => $house_no ? $house_no: '0',
			'email'        => $email ? $email: '0',
			'image'        => $img ? $img: '0',
			'ani_category_id' => $ani_category_id ? $ani_category_id: '0',
			'ani_breed_id' => $ani_breed_id ? $ani_breed_id: '0',
			'ani_gendor' => $total_animals ? $total_animals: '0',
			'ani_tag_no' => $ani_tag_no ? $ani_tag_no: '0',
			'ani_dob' => $ani_dob ? $ani_dob: '0',
			'ani_vt_id' => $ani_vt_id ? $ani_vt_id: '0',
			'ani_sire_name' => $ani_sire_name ? $ani_sire_name: '0',
			'ani_sire_breed_id' => $ani_sire_breed_id ? $ani_sire_breed_id: '0',
			'ani_dam_name' => $ani_dam_name ? $ani_dam_name: '0',
			'ani_dam_breed_id' => $ani_dam_breed_id ? $ani_dam_breed_id: '0',
			'status' => $status ? $status: '0',
			'created_on'     =>  date('Y-m-d H:i:s'),
			];
			
			$insert = $this->Enquiry_model->insert_enquiry($datafiled);
				if($insert){
                    $data['success'] =  True;
					 $data['msg'] =  "Your Request is successfully submitted";
                    $data['data'] =  $datafiled;
                }else{
                    $data['success'] =  False;
                    $data['error'] =  "Error";
                }
					$userinfo = $this->Enquiry_model->get_users_info($users_id);
					if($enquiry_form == 1){
						$ms = "Loans Request is successfully submitted";
					}
					if($enquiry_form == 2){
						$ms = "Insurance Request is successfully submitted";
					}
					if($enquiry_form == 3){
						$ms = "KCC Request is successfully submitted";
					}
					if($enquiry_form == 4){
						$ms = "Ai Request is successfully submitted";
					}
					if($enquiry_form == 5){
						$ms = "Sell cow dung Request is successfully submitted";
					}
					if($enquiry_form == 6){
						$ms = "Birth Certificate Request is successfully submitted";
					}
					if($enquiry_form == 7){
						$ms = "Feed consultancy Request is successfully submitted";
					}
					if($enquiry_form == 8){
						$ms = "Repeat Breading Request is successfully submitted";
					}
					if($enquiry_form == 9){
						$ms = "Vaccination Request is successfully submitted";
					}
					if($enquiry_form == 10){
						$ms = "Dewarming Request is successfully submitted";
					}
					if($enquiry_form == 11){
						$ms = "Pregnancy check Request is successfully submitted";
					}
					if($enquiry_form == 12){
						$ms = "Register Request is successfully submitted";
					} 
					$msg['message'] = $ms;
					$msg['users_id'] = $users_id;
					$msg['title'] = "Inquery Form";
					$msg['type'] = '0';
					$this->Pushnoti_model->insert_noti($msg);
					$email = $userinfo->email;
					if($email)
					{
					$this->email->from(CO_EMAIL, 'Livestoc');
					$this->email->to($email);
					$this->email->subject('Email For Livestoc Enquiry form');
					$this->email->message('Your request is send succesfully');
					$this->email->send();	
					}
		 
		}
		else{
			$data['success'] =  False;
		}
    	echo json_encode($data);    
    }
   
}