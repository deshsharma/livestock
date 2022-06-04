<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('api_model');
        $this->load->model('login_cheak_model');
    }
    public function index(){
        $data['users_id'] = $this->input->get_post('users_id');
        $data['users_type'] = $this->input->get_post('users_type');
        $data['block_id'] = $this->input->get_post('block_id');
        $data['block_type'] = $this->input->get_post('block_type');
        $data['created_on'] = date('Y-m-d h:i:s');
        if($chat_data = $this->api_model->get_data('((`users_id` = '.$data['users_id'].' OR `block_id` = '.$data['users_id'].') AND (`block_id` = '.$data['block_id'].' OR `users_id` = '.$data['block_id'].')) AND ((`users_type` = "'.$data['users_type'].'" OR `block_type` = "'.$data['users_type'].'") AND (`block_type` = "'.$data['block_type'].'" OR `users_type` = "'.$data['block_type'].'"))', 'chat_log_data')){
            if($chat_data = $this->api_model->get_data('users_id = '.$data['users_id'].' AND users_type = "'.$data['users_type'].'" AND block_id = '.$data['block_id'].' AND block_type = "'.$data['block_type'].'"', 'chat_log_data')){
                if($this->api_model->own_query('DELETE FROM chat_log_data WHERE id = '.$chat_data[0]['id'].'')){
                    $json['success'] = true;
                    $json['msg'] = '1';
                }
            }else{
                    $json['success'] = false;
                    $json['error'] = 'You are not authorize to change this status.';
            }
        }else{
            if($this->api_model->submit('chat_log_data', $data)){
                $json['success'] = true;
                $json['msg'] = '0';
            }
        }
      
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function get_doctor(){
		$type = $this->input->get_post('type');
        $doc_id = $this->input->get_post('doc_id');
		$search = $this->input->get_post('search');
		if($data = $this->api_model->get_data('users_type = "pvt_doc"  AND doctor_id <> '.$doc_id.' AND username LIKE "%'.$search.'%" OR mobile LIKE "%'.$search.'%"', 'doctor','doctor_id DESC','doctor_id as users_id, username as user_name, mobile, image as user_image')){
            $detail =[]; 
			foreach($data as $d){
                if($d['user_image'] != ''){
                    $d['user_image'] = base_url().'uploads/doctor/'.$d['user_image'];
                }
                $doc_qua = $this->login_cheak_model->get_qulification_doc_id($d['users_id']);
                $i = 0;
                $qu_name  = '';
						foreach($doc_qua as $dq){
								$qua_name = $this->login_cheak_model->get_qualification($dq['qualifi_id']);
                                if($i == 0){
                                    $qu_name = $qua_name[0]['qualifi_name'];
                                }else{
                                    $qu_name .= ','.$qua_name[0]['qualifi_name'];
                                } 
                                $i++;
						}
                $d['qualification_name'] = $qu_name;
				$detail[] = $d;
			}
			if(!empty($detail)){
				$json['success']  = True; 
				$json['data'] = $detail;
			}
			else{
				$json['success']  = false; 
				$json['error'] = 'No Veterinarian found';
			}
        }else{
            $json['success']  = false; 
            $json['error'] = 'No Veterinarian found';
        }	
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
    public function chat_status(){
        $data['users_id'] = $this->input->get_post('users_id');
        $data['users_type'] = $this->input->get_post('users_type');
        $data['block_id'] = $this->input->get_post('block_id');
        $data['block_type'] = $this->input->get_post('block_type');
        $chat_data = $this->api_model->get_data('((`users_id` = '.$data['users_id'].' OR `block_id` = '.$data['users_id'].') AND (`block_id` = '.$data['block_id'].' OR `users_id` = '.$data['block_id'].')) AND ((`users_type` = "'.$data['users_type'].'" OR `block_type` = "'.$data['users_type'].'") AND (`block_type` = "'.$data['block_type'].'" OR `users_type` = "'.$data['block_type'].'"))', 'chat_log_data');
        //print_r($chat_data);
        if($chat_data){
            $json['success'] = true;
            $json['msg'] = '0';
        }else{
            $json['success'] = true;
            $json['msg'] = '1';
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
}