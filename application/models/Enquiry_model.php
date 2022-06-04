<?php
class Enquiry_model extends CI_Model {
	
    public function insert_enquiry($data){
		
        $insert = $this->db->insert('enquiry', $data);
        if($insert){
            return True;
        }else{
            return false;
        }
    }
    public function get_users_info($users_id){
        
        $detail = $this->db->select('email')->where('users_id',$users_id)->get('users')->row();
		if($detail){
            return $detail;
        }else{
            return false;
        }
    }
	 public function enquiry_already_exist($users_id,$enquiry_form){
        
        $detail = $this->db->select('id')->where("users_id = ".$users_id." AND enquiry_form =".$enquiry_form." AND status='0'")->get('enquiry')->row();
		if($detail){
            return TRUE;
        }else{
            return false;
        }
    }
   
}