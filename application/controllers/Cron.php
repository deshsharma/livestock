<?php

class Cron extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('cronmodel');
		$this->load->model('api_model');
		date_default_timezone_set('Asia/Calcutta');
    }
	public function index(){
		//$this->cronmodel->seller();
		// date_default_timezone_set('Asia/Calcutta');
		// $my_date_time = date("Y-m-d h:i:s", strtotime("+".TREATMENT_CANCEL_TIME." hours"));
		// get_data()
		// echo date('Y-m-d h:i:s');
		// echo "<br>";
		// echo $my_date_time;
		date_default_timezone_set('Asia/Calcutta');
		$my_date_time = date("Y-m-d h:i:s", strtotime("-".TREATMENT_CANCEL_TIME." hours"));
		$data = $this->api_model->get_crone_data();
		if(!empty($data)){
			
			foreach($data as $da){
				if($da['log_id'] != '' && $da['log_id'] != '0'){
					$log_data = $this->api_model->get_data('id = "'.$da['log_id'].'"' , 'log_file', '', '*');
					//if($log_data[0]['request_status'] == '2'){
						$wall_dr = $this->api_model->get_data('log_id = "'.$da['log_id'].'" AND status = "Dr"', 'livestoc_wallets','', 'sum(amount) as amount');
						//print_r($wall_dr);
						//if($data[0]['treat_type'] == '3'){
							if(!empty($wall_dr)){
								$update['status'] = '3';
								$this->api_model->get_data_update('id = "'.$da['id'].'"', 'vt_requests', $update);
								$wall_update['log_id'] = $da['log_id'];
								$wall_update['status'] = 'Cr';
								$wall_update['date'] = date('Y-m-d h:i:s');
								$wall_update['type'] = '33';
								if($da['admin_id'] != '0' || $da['admin_id'] != ''){
									$wall_update['users_id'] = $da['admin_id'];
									$wall_update['user_type'] = '3';
								}else{
									$wall_update['users_id'] = $da['users_id'];
								}
								$wall_update['wallet_type'] = '1';
								$wall_update['animal_id'] = '0';
								$wall_update['amount'] = $wall_dr[0]['amount'];
								$this->api_model->submit('livestoc_wallets', $wall_update);
								$title = 'AI Request Cancelled';
								$msg1 = ' Sorry, there are no service providers available in your area. We are adding the money deducted to your wallet. Inconvenience regretted.';
								$msg['users_id'] = $da['users_id'];
								$msg['title'] = $title;
								$msg['message'] = $msg1;
								$msg['date'] = date('Y-m-d h:i:s');
								$msg['type'] = '2';
								$msg['isactive'] = '1';
								$msg['flag'] = '1';
								$this->api_model->user_notification($msg);
								$old_msg['to_users_id'] = $da['users_id'];
								$old_msg['to_id'] = $da['users_id'];
								$old_msg['to_type'] = 'users';
								$old_msg['title'] = $title;
								$old_msg['from_type'] = 'Livestoc Team';
								$old_msg['success'] = '1';
								$old_msg['device'] = 'android';
								$old_msg['active'] = '1'; 
								$old_msg['description'] = $msg1;
								$old_msg['date_added'] = date('Y-m-d h:i:s');
								$this->api_model->old_notification($old_msg);
								$this->simple_push_none($da['users_id'], 2 , $title, '1', $msg1);
							}else{
								$update['status'] = '3';
								$this->api_model->get_data_update('id = "'.$da['id'].'"', 'vt_requests', $update);
								$title = 'AI Request Cancelled';
								$msg1 = 'Sorry, we regret to inform you that our service providers are unable to accept your request at this time. Please try after some time.';
								$msg['users_id'] = $da['users_id'];
								$msg['title'] = $title;
								$msg['message'] = $msg1;
								$msg['date'] = date('Y-m-d h:i:s');
								$msg['type'] = '2';
								$msg['isactive'] = '1';
								$msg['flag'] = '1';
								$this->api_model->user_notification($msg);
								$old_msg['to_users_id'] = $da['users_id'];
								$old_msg['to_id'] = $da['users_id'];
								$old_msg['to_type'] = 'users';
								$old_msg['title'] = $title;
								$old_msg['from_type'] = 'Livestoc Team';
								$old_msg['success'] = '1';
								$old_msg['device'] = 'android';
								$old_msg['active'] = '1'; 
								$old_msg['description'] = $msg1;
								$old_msg['date_added'] = date('Y-m-d h:i:s');
								$this->api_model->old_notification($old_msg);
								$this->simple_push_none($da['users_id'], 2 , $title, '1', $msg1);
							}
						//}
					//}
				}else{
						//if($data[0]['treat_type'] == '3'){
							$update['status'] = '3';
							$this->api_model->get_data_update('id = "'.$da['id'].'"', 'vt_requests', $update);
							$title = 'AI Request Cancelled';
							$msg1 = 'Sorry, we regret to inform you that our service providers are unable to accept your request at this time. Please try after some time.';
							$msg['users_id'] = $da['users_id'];
							$msg['title'] = $title;
							$msg['message'] = $msg1;
							$msg['date'] = date('Y-m-d h:i:s');
							$msg['type'] = '2';
							$msg['isactive'] = '1';
							$msg['flag'] = '1';
							$this->api_model->user_notification($msg);
							$old_msg['to_users_id'] = $da['users_id'];
							$old_msg['to_id'] = $da['users_id'];
							$old_msg['to_type'] = 'users';
							$old_msg['title'] = $title;
							$old_msg['from_type'] = 'Livestoc Team';
							$old_msg['success'] = '1';
							$old_msg['device'] = 'android';
							$old_msg['active'] = '1'; 
							$old_msg['description'] = $msg1;
							$old_msg['date_added'] = date('Y-m-d h:i:s');
							$this->api_model->old_notification($old_msg);
							$this->simple_push_none($da['users_id'], 2 , $title, '1', $msg1);
						//}
				}
			}
		}
		$this->premium_disable();
	}
	public function premium_disable(){
		date_default_timezone_set('Asia/Calcutta');
		$my_date_time_from = date("Y-m-d", strtotime("-".PREMIUM_DAYS." day"));
		$my_date_time_to = date("Y-m-d", strtotime("-".PREMIUM_DAYS_TO." day"));
		// $my_date_time_from = '2020-09-26';
		// $my_date_time_to = '2020-09-28';
		// echo $my_date_time_from;
		// echo $my_date_time_to;
		// exit;
		$data = $this->api_model->get_data("date BETWEEN '".$my_date_time_to."' AND '".$my_date_time_from."' AND (rest_quantity <> 0 OR rest_milk_collection <> 0)", 'ai_package_log','', '*');
		foreach($data as $da){
			$update['rest_quantity'] = '0';
			$update['rest_milk_collection'] = '0';
			$this->api_model->get_data_update('id = "'.$da['id'].'"', 'ai_package_log', $update);
		}
	}
	public function test(){
		date_default_timezone_set('Asia/Calcutta');
		echo $my_date_time_from = date("Y-m-d", strtotime("-".DEWARMING_TIME_FROM." days"));
		$my_date_time_to = date("Y-m-d", strtotime("-".DEWARMING_TIME_FROM." days"));
		exit;
		//'vaccination_date BETWEEN "'.$my_date_time_from.'" AND "'.$my_date_time_to.'"','animal_vaccination'
		if($data = $this->api_model->get_data('vaccination_date < "'.$my_date_time_to.'"','animal_vaccination')){
			foreach($data as $da){
				$update_data['request_status'] = '1';
				$this->api_model->get_data_update('animal_vaccination_id = "'.$da['animal_vaccination_id'].'"', 'animal_vaccination', $update_data);
				$animals = $this->api_model->get_data('animal_id = "'.$da['animal_id'].'"','animals', '','users_id');
				$medicine = $this->api_model->get_data('id = "'.$da['vaccination_id'].'"', 'medicine', '', 'name');
				$title = 'Reminder';
				$msg1 = 'Your  "'.$medicine[0]['name'].'" has been passed due.';
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
	public function run_15_minute(){
		$data = $this->api_model->get_data('','dashboard_crone', '','section_id');
		foreach($data as $da){
			$url = 'https://www.livestoc.com/harpahu_merge/api/get_dashboard_list?category_id='.$da['section_id'].'&state_name=&language=en&state_id=';
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => array(
						"Postman-Token: 8460f633-8c51-4182-a33f-cfd7c6f4818f",
						"cache-control: no-cache"
			),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			//echo $response;
			$dat['update_on'] = date('Y-m-d h:i:s');
			$dat['value'] = $response;
			//print_r($dat);
			$this->api_model->update('section_id',$da['section_id'],'dashboard_crone', $dat);
		}
	}
	public function run_12_hourse(){
		date_default_timezone_set('Asia/Calcutta');
		$my_date_time_from = date("Y-m-d", strtotime("-".DEWARMING_TIME_FROM." days"));
		$my_date_time_to = date("Y-m-d", strtotime("-".DEWARMING_TIME_FROM." days"));
		//'vaccination_date BETWEEN "'.$my_date_time_from.'" AND "'.$my_date_time_to.'" AND request_status <> "1" AND vaccination_date <> "1"','animal_vaccination'
		if($data = $this->api_model->get_data('vaccination_date <= "'.$my_date_time_to.'" AND type = "1" AND vaccination_status = "0" AND request_status <> "1" AND view_status <> "1"','animal_vaccination')){
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
				$this->simple_push_none( $animals[0]['users_id'], 2 , $title, '3', $msg1);
			}
		}
		// $data['value'] = '12';
		// $data['create_date'] = date('Y-m-d h:i:s');
		// $this->api_model->submit('test_crone', $data);
		$this->premium_to_non();
	}
	public function premium_to_non(){
		$data = $this->api_model->get_data('package_id = "21"','package_masters');
		foreach($data as $da){
			$start_data = date('Y-m-d',strtotime(date("Y-m-d h:i:s", mktime()) . " - ".$da['package_days']." day"));
			$package = $this->api_model->get_data('package_id = '.$da['package_id'].' AND package_expired_on <= "'.$start_data.'"','package_users_log');
			foreach($package as $pack){
				if($pack['animal_id'] != '0'){
					$purpus['animal_purpose'] = '1';
					$this->api_model->update('animal_id', $pack['animal_id'], 'animals', $purpus);
				}
			}
		}
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