<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_visit extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('api_model');
    }
    public function index(){
        $log_id = $this->input->get_post('log_id');
        $address = $this->input->get_post('address');
        $latitude = $this->input->get_post('latitude');
        $users_id = $this->input->get_post('users_id');
        $name = $this->input->get_post('name');
        $doc_id = $this->input->get_post('doc_id');
        $langitude = $this->input->get_post('langitude');
		//$re_data = $this->api_model->get_data('created_on LIKE "%'.date('Y-m-d').'%" AND users_id = "'.$users_id.'" AND treat_type = "6" AND log_id = 0', 'vt_requests');
		// print_r($re_data);
		// exit;
        if($re_data = $this->api_model->get_data('created_on LIKE "%'.date('Y-m-d').'%" AND users_id = "'.$users_id.'" AND treat_type = "6" AND log_id = 0', 'vt_requests')){
			if(!$home = $this->api_model->get_data('created_on LIKE "%'.date('Y-m-d').'%" AND users_id = "'.$users_id.'" AND vt_id = "'.$doc_id.'"', 'home_visit_log')){
                $log['vt_id']=$doc_id;
                $log['users_id']=$users_id;
                $log['request_id']=$re_data[0]['id'];
                $log['created_on']= date('Y-m-d h:i:s');
                $this->api_model->submit('home_visit_log', $log);
                $user_note = '';
                $title = 'Interested For Home Visit';
                $flag = 6;
                $msg1 = $name." has shown interest for home visit in your profile. Please provide proposal for that.";
                $user_note['users_id'] = $doc_id; 
                $user_note['title'] = $title;
                $user_note['message'] = $msg1;
                $user_note['date'] = date('Y-m-d h:i:s');
                $user_note['type'] = '2';
                $user_note['isactive'] = '1';
                $user_note['flag'] = '1';
                $this->api_model->user_notification($user_note);
                $this->push_non($doc_id,  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg1);
            }
        }else{
            $otp = rand(1, 10000);
            $data['users_id'] = $users_id;
            $data['address'] = $address;
            $data['latitude'] = $latitude;
            $data['langitude'] = $langitude;
            $data['treat_type'] = '6';
            $data['otp'] = $otp;
            $data['created_on'] = date('Y-m-d h:i:s');
            $data['date'] = date('Y-m-d h:i:s');
            $request = $this->api_model->submit('vt_requests', $data);
            $log['vt_id']=$doc_id;
            $log['users_id']=$users_id;
            $log['request_id']=$request;
            $log['created_on']= date('Y-m-d h:i:s');
            $this->api_model->submit('home_visit_log', $log);
            $user_note = '';
            $title = 'Interested For Home Visit';
            $flag = 6;
            $msg1 = $name." has shown interest for home visit in your profile. Please provide proposal for that.";
            $user_note['users_id'] = $doc_id; 
            $user_note['title'] = $title;
            $user_note['message'] = $msg1;
            $user_note['date'] = date('Y-m-d h:i:s');
            $user_note['type'] = '2';
            $user_note['isactive'] = '1';
            $user_note['flag'] = '1';
            $this->api_model->user_notification($user_note);
            $this->push_non($doc_id,  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg1);
        }
        $json['success']  = true; 
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function update_chat_status(){
		$doctor_id = $this->input->get_post('doctor_id');
		$users_id = $this->input->get_post('users_id');
        $request_id = $this->input->get_post('request_id');
		$chat_status =  $this->input->get_post('chatstatus');
		$data['chat_status'] = $chat_status;
		if($chat_status == '1') {
				$dat['status'] = "Now User can initiate a chat with you.";
		}else{
				$dat['status'] = "Chat is disabled for this User.";
		}		
		$detail = $this->api_model->get_data_update('id=', 'vt_requests', $data);
		if($detail){
			$json['success'] = true;
			$json['msg'] = $dat['status'];
		}else{
			$json['success'] = false;
			$json['error'] = "Database error.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
    public function get_doc_home_visit_list(){
        $doc_id = $this->input->get_post('vt_id');
		$prev_date = date("Y-m-d", strtotime("".date('Y-m-d')." -".HOME_VISIT_DAYS." day"));
		$current_date = date("Y-m-d", strtotime("".date('Y-m-d')." +".HOME_VISIT_DAYS." day"));;
        if($data = $this->api_model->get_data('vt_id = "'.$doc_id.'" AND created_on BETWEEN "'.$prev_date.'" AND "'.$current_date.'" AND (select log_id from vt_requests where id= request_id) = 0', 'home_visit_log as ho','','id, vt_id, users_id, (select langitude from vt_requests where id=ho.request_id) as langitude, (select latitude from vt_requests where id=ho.request_id) as latitude, (select address from vt_requests where id=ho.request_id) as address, (select full_name from users where users_id=ho.users_id) as name, (select CONCAT("https://www.livestoc.com//uploads_new/profile/thumb/", image) from users where users_id=ho.users_id) as image, (select mobile from users where users_id=ho.users_id) as mobile, request_id, amount, created_on')){
            $json['success']  = true; 
            $json['data']  = $data; 
        }else{
            $json['success']  = false; 
            $json['error']  = 'No data found'; 
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
	public function treatment_start_com(){
		$request_type = $this->input->get_post('treat_status');
		$otp = $this->input->get_post('otp');
		$request_id = $this->input->get_post('request_id');
		if($data = $this->api_model->get_data('otp = "'.$otp.'" AND id = '.$request_id.'', 'vt_requests')){
			$log = $this->api_model->get_data('id = '.$data[0]['log_id'].'', 'log_file');
			// $update['status'] = $request_type;
			// $this->api_model->get_data_update('id = '.$request_id.'', 'vt_requests', $update);
			$visit['status']= '4';
			$this->api_model->get_data_update('id = "'.$request_id.'"', 'vt_requests', $visit);
			$doctor = $this->api_model->get_data('doctor_id = '.$data[0]['vt_id'].'','doctor');
			$invoice['log_id'] = $data[0]['log_id'];
			$invoice['request_id'] = $request_id ? $request_id : 0;
			$invoice['users_id'] = $data[0]['users_id'];
			$invoice['ai_price'] = $log[0]['amount'];
			$invoice['semen_stock_price'] = $doctor[0]['visiting_fee'] - (($doctor[0]['visiting_fee']*HOME_VISIT)/100) ;
			$invoice['semen_stock_qty'] = 1;
			$invoice['status'] = '2';
			$invoice['date'] = date('Y-m-d h:i:s');
			$ini = $this->api_model->submit('semen_invoice_performa', $invoice);
			$ai_log['request_id'] = $request_id;
			$ai_log['log_id'] = $data[0]['log_id'];
			$ai_log['vt_id'] = $data[0]['vt_id'];
			$ai_log['invoice_id'] = $ini;
			$ai_log['company_charges'] = ($doctor[0]['visiting_fee']*HOME_VISIT)/100;
			$ai_log['farmer_price'] =$log[0]['amount'];
			$ai_log['ai_service_price'] =$doctor[0]['visiting_fee'] - (($doctor[0]['visiting_fee']*HOME_VISIT)/100) ;
			$ai_log['premium_type'] = '0';
			$ai_log['status'] = '1';
			$ai_log['date_time'] = date('Y-m-d h:i:s');
			$this->api_model->submit('ai_log', $ai_log);
			$ms = "Doctor has successfully completed his visit";
			$msg['message'] = $ms;
			$msg['users_id'] =  $data[0]['users_id'];
			$msg['date'] = date('Y-m-d h:i:s');
			$msg['type'] = '2';
			$msg['isactive'] = '1';
			$msg['flag'] = '6';
			$msg['type'] = 1;
			$msg['title'] = "Visitation Request";
			$this->api_model->user_notification($msg);
			$old_msg['to_users_id'] =   $data[0]['users_id'];
			$old_msg['to_id'] =   $data[0]['users_id'];
			$old_msg['to_type'] = 'users';
			$old_msg['title'] = $msg['title'];
			$old_msg['from_type'] = 'Livestoc Team';
			$old_msg['success'] = '1';
			$old_msg['device'] = 'android';
			$old_msg['active'] = '1'; 
			$old_msg['description'] = $ms;
			$old_msg['date_added'] = date('Y-m-d h:i:s');
			$this->api_model->old_notification($old_msg);
			$msg['message'] = 'Doctor has successfully completed his visit.';
			$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
			$json['success']  = true; 
            $json['msg']  = 'Successfully Submitted';
		}else{
			$json['success']  = false; 
            $json['error']  = 'Mismatch OTP';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
    public function submit_doc_charges(){
        $id = $this->input->get_post('id');
        $name = $this->input->get_post('name');
        $users_id = $this->input->get_post('users_id');
        $amount = $this->input->get_post('amount');
        $data['amount'] = $amount;
        if($this->api_model->get_data_update('id = "'.$id.'"', 'home_visit_log', $data)){
            $json['success']  = true; 
            $json['msg']  = 'Successfully Submitted';
        }else{
            $json['success']  = false; 
            $json['error']  = 'Data base Error'; 
        }
        $msg['users_id'] = $users_id;
		$msg['title'] = "Proposal Amount";
		$msg['message'] = $name.' has proposed you rs '.$amount.' for Home Visit.';
		$msg['date'] = date('Y-m-d h:i:s');
		$msg['type'] = '2';
		$msg['isactive'] = '1';
		$msg['flag'] = '6';
		$this->api_model->user_notification($msg);
		$old_msg['to_users_id'] = $users_id;
		$old_msg['to_id'] = $users_id;
		$old_msg['to_type'] = 'users';
		$old_msg['title'] = "Proposal Amount";
		$old_msg['from_type'] = 'Livestoc Team';
		$old_msg['success'] = '1';
		$old_msg['device'] = 'android';
		$old_msg['active'] = '1'; 
		$old_msg['description'] = $name.' has proposed you rs '.$amount.' for Home Visit.';
		$old_msg['date_added'] = date('Y-m-d h:i:s');
		$this->api_model->old_notification($old_msg);
		$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function push_non($user_id, $type , $title, $flag = 0, $server_key = 0, $key=0, $msg, $fcm_and= '', $fcm_ios = ''){
		if($type == 1){
			$detail = $this->api_model->get_fcm_doc($user_id);
		}else if($type == 2){
			$detail1 = $this->api_model->get_admin_detail($user_id);
			$detail[0]['fcm_android'] = $detail1[0]['fcm_and'];
			$detail[0]['fcm_ios'] = $detail1[0]['fcm_IOS'];
		}else if($type == 3){
			$detail[0]['fcm_android'] = $fcm_and;
			$detail[0]['fcm_ios'] = $fcm_ios;
		}else{
			$detail = $this->api_model->get_fcm_user($user_id);
		}
		if($detail[0]['fcm_android'] != ''){
											$fcm = $detail[0]['fcm_android'];
											$path_to_fcm = "https://fcm.googleapis.com/fcm/send";
											$headers = array(
												'Authorization:key=' . $server_key, 
												'Content-Type:application/json');
												$keys = [$fcm];
												$fields = array(
													"registration_ids" => $keys,
													"priority" => "high",
													'data' => array(
																'title' => $title,
																'description' => $msg,
																'flag' => $flag,
																'date' => date('Y-m-d')
															)
														);
												$payload = json_encode($fields);
												$curl_session = curl_init();
												curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
												curl_setopt($curl_session, CURLOPT_POST, true);
												curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
												curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
												curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
												curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
												curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
												$curl_result = curl_exec($curl_session);
		}if($detail[0]['fcm_ios'] != ''){
											$fcm = $detail[0]['fcm_ios'];
											$fcmMsg = array(
													'title' => $title,
													'description' => $msg,
													'flag' => $flag,
													'date' => date('Y-m-d')
											);
											$fcmFields = array(
													'to' => $fcm,
													'priority' => 'high',
													'notification' => $fcmMsg,
											);
											$headers = array(
													'Authorization: key=' . $key,
													'Content-Type: application/json'
											);

											$ch = curl_init();
											curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
											curl_setopt($ch, CURLOPT_POST, true);
											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
											curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
											$result = curl_exec($ch);
											curl_close($ch);
		}
		
	}
}