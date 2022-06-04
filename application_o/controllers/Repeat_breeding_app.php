<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
class Repeat_breeding_app extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
        $this->load->helper('push_notification');
    }
    public function change_status(){
        $id = $this->input->get_post('sub_treat_id');
        $request_id = $this->input->get_post('request_id');
        $animal_id = $this->input->get_post('animal_id');
        $status = $this->input->get_post('status');
        $data['treat_status'] = $status;
        $data['animal_id'] = $animal_id;
        if($this->api_model->get_data_update('id = '.$id.'', 'vt_request_tracking',$data)){
            $sub_req = $this->api_model->get_data('id = '.$id.'', 'vt_request_tracking');
                //print_r($sub_req);
                // $count_sub_req = $this->api_model->get_data('request_id = '.$sub_req[0]['request_id'].'', 'vt_request_tracking','','count(id) as count');
                // if($count_sub_req[0]['count']==1){
                //     if( $data['treat_status'] == '5'){
                //         $request = $this->api_model->get_data('id = '.$sub_req[0]['request_id'].'', 'vt_requests');
                //         $re['log_id'] = $request[0]['log_id'];
                //         $re['request_id'] = $sub_req[0]['request_id'];
                //         $re['animal_id'] = $request[0]['animal_id'];
                //         $re['user_id'] = $request[0]['users_id'];
                //         $re['treat_type'] = '3';
                //         $re['vt_id'] = $request[0]['vt_id'];
                //         $re['treat_status'] = '1';
                //         $re['date'] = date('Y-m-d');
                //         $this->api_model->submit('vt_request_tracking', $re);
                //     }
                // }
            $update_data['animal_id'] = $animal_id;
            $this->api_model->get_data_update('id = '.$request_id.'', 'vt_requests',$update_data);
            $json['success']  = true;
            $json['data'] = $this->api_model->get_data('id = '.$id.'', 'vt_request_tracking'); 
        }else{
            $json['success']  = false; 
			$json['error'] = "Please Send valid id";
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function submit_comment(){
        $data['request_id'] = $this->input->get_post('id');
        $data['comment'] = $this->input->get_post('comment');
        $data['image'] = $this->input->get_post('image');
        $data['created_on'] = date('Y-m-d h:i:s'); 
        if($this->api_model->submit('vt_request_comment',$data)){
            $json['success']  = true; 
            $json['data'] = $this->api_model->get_data('request_id = '.$data['request_id'].'', 'vt_request_comment','id DESC', '*', '0','1');
        }else{
            $json['success']  = false; 
			$json['error'] = "Please Send valid id";
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function get_comment(){
        $id = $this->input->get_post('request_id');
        if($data = $this->api_model->get_data('request_id = '.$id.'','vt_request_comment')){
            $json['success']  = true; 
            $json['data'] = $data;
        }else{
            $json['success']  = false; 
			$json['error'] = "No Data Found";
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function create_new_request(){
        $id = $this->input->get_post('id');
        $bull_id = $this->input->get_post('bull_id');
        $doc_id = $this->input->get_post('doc_id');
        if($stock = $this->api_model->get_data('admin_id = "'.$doc_id.'" AND bull_id = "'.$bull_id.'" AND rest_stock <> 0', 'seman_stock')){
            $rest_stock = $stock[0]['rest_stock'] - 1;
			$r_data['rest_stock'] = $rest_stock;
            $this->api_model->get_data_update('id = "'.$stock[0]['semen_stock_id'].'"', 'seman_stock', $r_data);
            $request = $this->api_model->get_data('id = '.$id.'', 'vt_requests');
            $bull = $this->api_model->get_data('id = "'.$bull_id.'"' , 'bull_table', '', '*');
            $semen_group = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"', 'semen_group','','*');
            $data['users_id'] = $request[0]['users_id'];
            $data['admin_id'] = $doc_id;
            $data['animal_id'] = $request[0]['animal_id'];
            $data['bull_id'] = $bull_id;
            $pack_data = $this->api_model->get_data('users_id = "'.$request[0]['users_id'].'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
			if($request[0]['order_type'] == '1'){
				if($pack_data[0]['sum'] >  0){
					$per = $semen_group[0]['farmer_offer_price'];
				}else{
					$per = $semen_group[0]['farmer_price'];
				}
			}else{
				$per = $semen_group1[0]['ai_farmer_price'];
			}
			$semen_stock_price = $per;
            $data['semen_stock_price'] = $semen_stock_price;
            $data['semen_stock_id'] = $stock[0]['semen_stock_id'];
            $data['semen_stock_qty'] = 1;
            $data['sheath_qty'] =  0;
            $data['gloves_qty'] =  0;
            $data['ai_price'] = $semen_group[0]['ai_price'];
            $data['otp'] = rand(1000,9999);
            $data['invoice_total'] = $semen_stock_price;
            $data['type'] = '3';
            $data['date'] = date('Y-m-d h:i:s');
            $this->api_model->submit('semen_invoice_performa',$data);
            $re['log_id'] = $request[0]['log_id'];
            $re['request_id'] = $id;
            $re['animal_id'] = $request[0]['animal_id'];
            $re['user_id'] = $request[0]['users_id'];
            $re['treat_type'] = '3';
            $re['vt_id'] = $request[0]['vt_id'];
            $re['treat_status'] = '4';
            $re['vacc_id'] = $bull_id;
            $re['date'] = date('Y-m-d');
            $this->api_model->submit('vt_request_tracking', $re);
            $semen_data = $this->api_model->get_seman_detail($bull_id);
			$semen_price = $this->api_model->get_data('id ="'.$semen_data[0]['groups'].'"','semen_group','','*');
			$d['seman_groups'] = $semen_price[0]['group'];
			//$d['farmer_price'] = $semen_price[0]['farmer_price'];
			// $d['farmer_offer_price'] = $semen_price[0]['farmer_offer_price'];
			// $d['ai_sale_price'] = $semen_price[0]['ai_price'];
			$re['bull_no'] = 'LIVE_'.$bull_id;
			$re['semen_bull_no'] = $semen_data[0]['bull_no'];
			$re['lat_yield'] = $semen_data[0]['lat_yield'];
			$re['daughter_yield'] = $semen_data[0]['daughter_yield'];
			$admin_detail = $this->api_model->get_admin_detail($semen_data[0]['bull_source']);
			$re['bank_name'] = $admin_detail[0]['fname'];
			$re['image'] = base_url().'uploads/bank/'.$semen_data[0]['image'];
			$category = $this->api_model->get_animal_category($semen_data[0]['category']);
			$re['category'] = $category[0]['category'];
			$bread = $this->api_model->get_animal_breed($semen_data[0]['bread']);
			$re['bread'] = $bread[0]['breed_name'];
            $re['sendor_name'] = $stock_admin[0]['fname'];
            $json['success']  = true; 
            $json['data'][] = $re;
        }else{
            $json['success']  = false; 
			$json['error'] = "No Stock Found";
        }
        header('Content-Type: application/json');
		echo json_encode($json);
        exit;
    } 
}