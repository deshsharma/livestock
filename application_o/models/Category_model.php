<?php
class Category_model extends CI_Model {
	
    public function get_category(){
		
        $detail = $this->db->where('isactivated', '1')->get('category')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
	
	public function get_breed($category_id =''){
	
        $detail = $this->db->where("category_id='".$category_id."' AND isactivated ='1'")->get('breed')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
   	
}