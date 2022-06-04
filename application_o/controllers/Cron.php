<?php
class Cron extends CI_Controller {
	public function __construct() {

        parent::__construct();
		$this->load->model('cronmodel');
		$this->load->model('api_model');
    }
	public function index(){
		$this->cronmodel->seller();
	}
	public function test(){
		date_default_timezone_set('Asia/Calcutta');
		$my_date_time_from = date("Y-m-d", strtotime("-".DEWARMING_TIME_FROM." days"));
		$my_date_time_to = date("Y-m-d", strtotime("-".DEWARMING_TIME_FROM." days"));
		//'vaccination_date BETWEEN "'.$my_date_time_from.'" AND "'.$my_date_time_to.'" AND request_status <> "1" AND vaccination_date <> "1"','animal_vaccination'
		if($data = $this->api_model->get_data('vaccination_date <= "'.$my_date_time_to.'" AND type = "1" AND vaccination_status = "0" AND request_status <> "1" AND view_status <> "1"','animal_vaccinationasd')){
			foreach($data as $da){
				$update_data['request_status'] = '1';
				$this->api_model->get_data_update('animal_vaccination_id = "'.$da['animal_vaccination_id'].'"', 'animal_vaccination', $update_data);
				$animals = $this->api_model->get_data('animal_id = "'.$da['animal_id'].'"','animals', '','users_id');
				$medicine = $this->api_model->get_data('id = "'.$da['vaccination_id'].'"', 'medicine', '', 'name');
				$title = 'Reminder';
				$msg1 = 'Your "'.$medicine[0]['name'].'" has been passed due.';
				$msg['users_id'] = $animals[0]['users_id'];
				$msg['title'] = $title;
				$msg['message'] = $msg1;
				$msg['date'] = date('Y-m-d h:i:s');
				$msg['type'] = '2';
				$msg['isactive'] = '1';
				$msg['flag'] = '1';
				$this->api_model->user_notification($msg);
				$old_msg['to_users_id'] =  $animals[0]['users_id'];
				$old_msg['to_id'] =  $animals[0]['users_id'];
				$old_msg['to_type'] = 'users';
				$old_msg['title'] = $title;
				$old_msg['from_type'] = 'Livestoc Team';
				$old_msg['success'] = '1';
				$old_msg['device'] = 'android';
				$old_msg['active'] = '1'; 
				$old_msg['description'] = $msg1;
				$old_msg['date_added'] = date('Y-m-d h:i:s');
				$this->api_model->old_notification($old_msg);
				$this->simple_push_none( $animals[0]['users_id'], 2 , $title, '1', $msg1);
			}
		}
		// date_default_timezone_set('Asia/Calcutta');
		// $my_date_time = date("Y-m-d h:i:s", strtotime("+".TREATMENT_CANCEL_TIME." hours"));
		// echo date('Y-m-d h:i:s');
		// echo "<br><pre>";
		// echo $my_date_time;
		// $data = $this->api_model->get_data('created_on >= "'.$my_date_time.'" AND status = "0"' , 'vt_requests', '', '*');
		// $data = $this->api_model->get_crone_data();
		// print_r($data);
	}
	public function simple_push_none($user_id, $type , $title, $flag = 0, $msg){
		if($type == 1){
			$detail = $this->api_model->get_fcm_doc($user_id);
			$server_key = PARAVATE_SERVERKEY;
		}else if($type == 2){
			$detail = $this->api_model->get_fcm_user($user_id);
			$server_key = LIVESTOCK_AND_SERVERKEY;
		}else{
			$detail = $this->api_model->get_fcm_user($user_id);
			$server_key = COUSTOMER_SERVERKEY;
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
													"priority" => "normal",
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
											$key = IOS_COUSTOMER_SERVERKEY;
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
?>