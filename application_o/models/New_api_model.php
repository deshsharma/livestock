<?php
class New_api_model extends CI_Model {
	public function delete_post($id){
        return $this->db->where('id',$id)->delete('post');
    
	}
	public function insert_log_data($data){
        $detail = $this->db->insert('vt_requests',$data);
        $last_id[]['purchase_id'] = $this->db->insert_id();
        return $last_id;
    }
}