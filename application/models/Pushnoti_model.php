<?php
class Pushnoti_model extends CI_Model {
    public function insert_noti($msg){
        if($this->db->insert('user_notification', $msg)){
            return True;
        }else{
            return false;
        }
    }
    public function get_puch_note($user_id, $type = ''){
        if($type != ''){
            $this->db->where('type', $type);
        }
        $detail = $this->db->where('users_id', $user_id)->order_by('id', 'DESC')->get('user_notification')->result_array();
        return $detail;
    }
}