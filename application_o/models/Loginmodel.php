<?php

class Loginmodel extends CI_Model {
	public function login_valid( $username, $password )
	{
		if(is_numeric($username)){
			$userdata = 'phone';
		}else{
			$userdata = 'email';
		}
		$this->db->select('*, (select fname from admin where admin_id = ad.super_admin_id) as super_admin_name, (select mobile from admin where admin_id = ad.super_admin_id) as super_admin_mobile ');
		$q = $this->db->where([$userdata=>$username,'password'=>md5($password)])->get('admin as ad');
		if ( $q->num_rows() ) {
			return $q->row();
		} else {
			return FALSE;
		}
	}
	public function login_paravate($user, $password){
        $detail = $this->db->select('doctor_id, users_type, username, mobile, refral_code, ai_visiting_fee, email, image, isactivated, is_payment, expertise_list, total_experience, rej_region, state, pincode, address_full, city, aadhar_no, adhaar_img')->where('email = "'.$user.'" AND password ="'.md5($password).'"')->get('doctor')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
	public function user_login_valid($username, $password )
	{
		if(is_numeric($username)){
			$userdata = 'mobile';
		}else{
			$userdata = 'email';
		}

		$q = $this->db->where([$userdata=>$username,'passcode'=>md5($password)])->get('users');
		if ( $q->num_rows() ) {
			return $q->row();
		} else {
			return FALSE;
		}
	}
	public function admin_login_valid( $username, $password )
	{
		$q = $this->db->where(['fname'=>$username,'password'=>md5($password), 'status'=>'2'])
						->get('admin');
		if ( $q->num_rows() ) {
			return $q->row();
		} else {
			return FALSE;
		}
	}
	public function mobile_valid($mob)
	{
		$mob_valid = $this->db->where('phone', $mob)->get('m_user')->result_array();
		if($mob_valid)
		{
			return $mob_valid;
		}
		else{
			return false;
		}
	}
	public function send_msg($mobile, $text)
	{	
		 //echo 'http://bulksms.passiontech.in/api/sendmsg.php?user='.SMS_USER.'&pass='.SMS_PASS.'&sender='.SMS_SENDER.'&phone='.$mobile.'&text='.$text.'&priority=ndnd&stype=normal';
		 $ch = curl_init('http://bulksms.passiontech.in/api/sendmsg.php?user='.SMS_USER.'&pass='.SMS_PASS.'&sender='.SMS_SENDER.'&phone='.$mobile.'&text='.$text.'&priority=ndnd&stype=normal'); 
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		 $response = curl_exec($ch);
		 curl_close($ch);
	         if(!$response)
                   return false;
                 else
		  		   return $response;
	}
	public function get_sponser_info($id)
	{
		$data = $this->db->where('id', $id)->get('m_user')->result_array();
		if($data){
			return $data;
		}else{
			return false;
		}
	}
}