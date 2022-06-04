<?php
class Login_cheak_model extends CI_Model {
    public function login($mobile,  $adhar){
        $detail = $this->db->select('users_id, mobile, aadhaar_no, passcode')->where('mobile = '.$mobile.' AND aadhaar_no = '.$adhar.'')->get('users')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    
    public function login_paravate($user, $password){
        $detail = $this->db->select('doctor_id, users_type, username,is_consultation_on, mobile, refral_code, ai_visiting_fee, email, image, isactivated, is_payment, expertise_list, total_experience, rej_region, state, pincode, address_full, city, aadhar_no, adhaar_img,is_premium')->where('email = "'.$user.'" AND password ="'.$password.'"')->get('doctor')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_exp_doc_id($doc_id){
        $detail = $this->db->where('doc_id = '.$doc_id.'')->get('doc_experience')->result_array();
        return $detail;
    }
    public function get_qualification($id){
       // $this->db->limit($perpage, $start);
        $detail = $this->db->where('qualifi_id = '.$id.'')->get('qualification')->result_array();
        return $detail;
    }
    public function get_qulification_doc_id($doc_id){
        $detail = $this->db->where('doc_id = '.$doc_id.'')->get('doc_qualification')->result_array();
        return $detail;
    }
	public function get_specialisation($id){
        $detail = $this->db->where('speci_id = "'.$id.'"')->get('specialisation')->result_array();
        return $detail;
    }
	public function password_exist($users_id){
		
        $detail = $this->db->query('SELECT `users_id`, `password` FROM `users` WHERE `users_id` = '.$users_id.' AND `password` != ""')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
	public function password_update($users_id,$data){
       	$update = $this->db->where('users_id', $users_id)->update('users',$data);
		if($update)
			return TRUE;
		else
			return FALSE;
    }
    public function login_passcode($id, $pass){
        $detail = $this->db->select('users_id, referal_code, referal_by_code, doc_referal_by, full_name as fullname, address as address, address as address1, address as address2, mobile, mobile_code, email, doctor_id, zone_id as state, tehsil_code as tehsil, village_code as village, tehsil_code, city as city_code, village_code, zone_id as state_code, fathers_name, aadhaar_no, caste, occupation_of_household, vt_id, address_type, income_fom_livestoc, image, passcode, fcm_android, fcm_ios, address_id, latitude, longitude, is_verified, country_id, zone_id, city, gender, access_token, updated_on, created_on, is_sharable, isactivated')->where('users_id = '.$id.' AND passcode = '.$pass.'')->get('users')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_specialisation_for_vetreg(){
        $detail = $this->db->get('specialisation')->result_array();
        return $detail;
    }
}