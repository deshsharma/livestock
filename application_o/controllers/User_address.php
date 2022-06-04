<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_address extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
    }
    public function insert_address(){
        $users_id = $this->input->get_post('users_id');
        $latitude = $this->input->get_post('latitude');
        $langitude = $this->input->get_post('langitude');
        $address = $this->input->get_post('address');
        $type = $this->input->get_post('type');
        $created_at = date('Y-m-d h:i:s');
        $json = [];
        if(!isset($users_id) || $users_id == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send User id";
        }else if(!isset($latitude) || $latitude == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send latitude";
        }else if(!isset($langitude) || $langitude == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send langitude";
        }else if(!isset($type) || $type == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send Type";
        }else if(!isset($address) || $address == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send Address";
        }else{
            $data['users_id'] = $users_id;
            $data['latitude'] = $latitude;
            $data['longitude'] = $langitude;
            $data['address1'] = $address;
            $data['address_type'] = $type;
            $data['created_on'] = $created_at;
            $this->api_model->insert_add($data);
            $json['success'] =  True;
            $json['msg'] =  "Your Address is Updated";
        }
        echo json_encode($json);
    }
    public function  get_address(){
        $users_id = $this->input->get_post('users_id');
        $json = [];
        if(!isset($users_id) || $users_id == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send User id";
        }else{
            $detail = $this->api_model->get_address($users_id);
            if($detail){
                $json['success'] =  True;
                $json['data'] = $detail;
            }else{
                $json['success'] =  False;
                $json['error'] =  "There is No address Found with this user";
            }
            
        }
        echo json_encode($json);
    }
    public function delete_address(){
        $id = $this->input->get_post('id');
        $json = [];
        if(!isset($id) || $id == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send ID"; 
        }else{
            $detail = $this->api_model->del_address($id);
            if($detail){
                $json['success'] =  True;
                $json['msg'] = 'Your Address Is Deleted';
            }else{
                $json['success'] =  False;
                $json['error'] =  "There is No address Found with this id";
            }
        }
        echo json_encode($json);
    }
    public function insert_doc_address(){
        $users_id = $this->input->get_post('users_id');
        $latitude = $this->input->get_post('latitude');
        $langitude = $this->input->get_post('langitude');
        $address = $this->input->get_post('address');
        $type = $this->input->get_post('type');
        $created_at = date('Y-m-d h:i:s');
        $json = [];
        if(!isset($users_id) || $users_id == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send User id";
        }else if(!isset($latitude) || $latitude == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send latitude";
        }else if(!isset($langitude) || $langitude == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send langitude";
        }else if(!isset($type) || $type == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send Type";
        }else if(!isset($address) || $address == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send Address";
        }else{
            $data['users_id'] = $users_id;
            $data['latitude'] = $latitude;
            $data['langitude'] = $langitude;
            $data['address'] = $address;
            $data['type'] = $type;
            $data['created_at'] = $created_at;
            $this->api_model->insert_doc_add($data);
            $json['success'] =  True;
            $json['msg'] =  "Your Address is Updated";
        }
        echo json_encode($json);
    }
    public function  get_doc_address(){
        $users_id = $this->input->get_post('users_id');
        $json = [];
        if(!isset($users_id) || $users_id == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send User id";
        }else{
            $detail = $this->api_model->get_doc_address($users_id);
            if($detail){
                $json['success'] =  True;
                $json['data'] = $detail;
            }else{
                $json['success'] =  False;
                $json['error'] =  "There is No address Found with this user";
            }
            
        }
        echo json_encode($json);
    }
    public function delete_doc_address(){
        $id = $this->input->get_post('id');
        $json = [];
        if(!isset($id) || $id == ''){
            $json['success'] =  False;
            $json['error'] =  "Please Send ID"; 
        }else{
            $detail = $this->api_model->del_doc_address($id);
            if($detail){
                $json['success'] =  True;
                $json['msg'] = 'Your Address Is Deleted';
            }else{
                $json['success'] =  False;
                $json['error'] =  "There is No address Found with this id";
            }
        }
        echo json_encode($json);
    }
}