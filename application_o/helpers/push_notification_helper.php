<?php
defined('BASEPATH') OR exit('No direct script access allowed.');
function push_non($user_id, $type , $title,$post_id = '', $flag = 0, $server_key = 0, $key=0, $msg, $fcm_and= '', $fcm_ios = ''){
	 $CI = get_instance();
		if($type == 1){
			$detail = $CI->api_model->get_fcm_doc($user_id);
		}else if($type == 2){
			$detail1 = $CI->api_model->get_admin_detail($user_id);
			$detail[0]['fcm_android'] = $detail1[0]['fcm_and'];
			$detail[0]['fcm_ios'] = $detail1[0]['fcm_IOS'];
		}else if($type == 3){
			$detail[0]['fcm_android'] = $fcm_and;
			$detail[0]['fcm_ios'] = $fcm_ios;
		}else{
			$detail = $CI->api_model->get_fcm_user($user_id);
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
																'post_id' => $post_id,
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
													'post_id' => $post_id,
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