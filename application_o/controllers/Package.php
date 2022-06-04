<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
class Package extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		$this->load->model('loginmodel');
		$this->load->model('pushnoti_model');
		$this->load->model('front_end_model');
		$this->load->model('Admin_detail');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Calcutta');
    }
    public function index(){
        $type = $this->input->get_post('type');
        if($type == ''){
            $json['success'] = false;
            $json['error'] = 'Please send package type id';
        }else{
            $data = $this->api_model->get_data('package_type_id = "'.$type.'"', 'package_masters');
            $json['success'] = false;
            $json['data'] = $data;
        }
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
    public function get_vecc_term_doc(){
        $data = $this->api_model->get_data('is_vecc_term = "1"', 'doctor');
        $json['success'] = false;
        $json['data'] = $data;
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
	public function get_vacc(){
		$users_id = $this->input->get_post('users_id');
		$treat_type = $this->input->get_post('treat_type');
		$animal_id = $this->input->get_post('animal_id');
		$purchase_id = $this->input->get_post('purchase_id');
		$where = '';
		if($animal_id != ''){
			$where = ' AND animal_id = '.$animal_id.'';
		}
		if($purchase_id != ''){
			$where .= ' AND log_id = '.$purchase_id.'';
		}
		if($data = $this->api_model->get_data('users_id = '.$users_id.' AND treat_type = "1" '.$where.'','vt_requests')){
			$detail = [];
			foreach($data as $da){
				if($da['treat_type'] == '1'){
					$pack_data = $this->api_model->get_data('vacc_id = "'.$da['vacc_id'].'"', 'package_masters');
					if($da['vt_id'] != '' && $da['status'] != '0'){
						$doctor = $this->api_model->get_data('doctor_id = '.$da['vt_id'].'', 'doctor');
						$da['doctor_name']= $doctor[0]['username'];
						$da['doctor_mobile']= $doctor[0]['mobile'];
					}
					$da['package_name'] = $pack_data[0]['package_name'];
					$da['package_price'] = $pack_data[0]['package_price'];
					$da['doc_price'] = $pack_data[0]['doc_price'];
					$da['invoice'] = base_url('package/invoice/').$da['Invoice_id'];
					$subdata = $this->api_model->get_data('request_id = '.$da['id'].'', 'vt_request_tracking');
					$sub_data = [];
					$i = 0;
					foreach($subdata as $sub){
						$vacc = $this->api_model->get_data('vaccination_id = '.$sub['vacc_id'].'','vaccination');
						$sub_data[$i]['name'] = $vacc[0]['name'];
						$sub_data[$i]['description'] = $vacc[0]['description'];
						$sub_data[$i]['treat_status'] = $sub['treat_status'];
						$sub_data[$i]['reschedule_date'] = $sub['reschedule_date'];
						$i++;
					}
					$da['vaccination'] = $sub_data;
				}
				$detail[] = $da;
			}
			$data1['success'] =  True;
			$data1['data'] =  $detail; 
		}else{
			$data1['success'] =  false;
			$data1['error'] =  'No record found'; 
		}
		
		header('Content-Type: application/json');
		echo json_encode($data1);
		exit;
		//print_r($detail);
	}
	public function vacc_package_done(){
		$request_id = $this->input->get_post('request_id');
		$sub_request_id = $this->input->get_post('sub_request_id');
		$animal_id = $this->input->get_post('animal_id');
		$treat_type = $this->input->get_post('treat_type');
		$vacc_name = $this->input->get_post('vacc_name');
		if(!isset($request_id) || !$request_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Request id is required";
	    }else if(!isset($sub_request_id) || !$sub_request_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Sub Request id is required";
		}else if(!isset($animal_id) || !$animal_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Animal id is required";
		}else{
			$ani_d = [];
			$r =[];
			$detail = $this->api_model->get_request_by_id($request_id);
			$sub_detail = $this->api_model->get_data('request_id = '.$detail[0]['id'].'', 'vt_request_tracking', '', 'count(id) as count');
			//print_r($sub_detail[0]['count']);
			if($detail[0]['users_id'] != '')
			$user_data = $this->api_model->get_user_info_id($detail[0]['users_id']);
			$treatment_image = $this->api_model->cheack_tretment_image($detail[0]['request_id']);
			if($treatment_image){
				$user_data[0]['treatment_image'] = '1';
			}else{
				$user_data[0]['treatment_image'] = '0';
			}
			$request_det = $this->api_model->request_detail($request_id);
			// $user_data[0]['address'] = $request_det[0]['address'];
			// $user_data[0]['latitude'] = $request_det[0]['latitude'];
			// $user_data[0]['langitude'] = $request_det[0]['langitude'];
			// $user_data[0]['treat_type'] = $request_det[0]['treat_type'];
			if($request_det[0]['treat_type'] == 3){
				$seman_data = $this->api_model->get_seman_detail($request_det[0]['vacc_id']);
				// $user_data[0]['seman_price'] = $seman_data[0]['price'] + $seman_data[0]['vt_ai_price'];
				$breed_name = $this->api_model->get_animal_breed($seman_data[0]['bread']);
			}else{
				$user_data[0]['seman_price'] = '';
			}
			// $user_data[0]['date'] = $request_det[0]['date'];
			// $image = IMAGE_PATH.'uploads_new/profile/thumb/'.$user_data[0]['image'];
			// $file = $image ;
			// $file_headers = @get_headers($file);
			// if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
			// 	$user_data[0]['image'] = 'https://www.livestoc.com/harpahu_merge/uploads/animal/'.$user_data[0]['image'];
			// }
			// else {
			// 	$user_data[0]['image'] = $file;
			// }
			foreach($detail as $d){
				$log_data = $this->api_model->get_data('id = '.$d['log_id'].'','log_file');
				$d['payment_status'] = $log_data[0]['request_type'];
				$d['paid_amount'] = $log_data[0]['amount'];
				if($log_data[0]['request_type'] == '2'){
					$wall = $this->api_model->get_data('log_id = '.$d['log_id'].'', 'livestoc_wallets');
					$d['wallet_amount'] = $wall[0]['amount'];
					$d['due_amount'] = $log_data[0]['amount'] - $wall[0]['amount'];
				}
				$d['invoice'] =  base_url('package/invoice/').$d['Invoice_id'];
				$animal_data = $this->api_model->get_animal_ani_id($d['animal_id']);
				$animal_img = $this->api_model->get_animal_image($d['animal_id']);
				$animal_detail = $this->api_model->get_data('animal_id = "'.$d['animal_id'].'"' , 'animals_detail', '', '');
				$get_payment =  $this->api_model->get_user_payment($d['request_id']);
				//$d['total_coustomer_payment'] = isset($get_payment[0]['amount']) ? $get_payment[0]['amount'] : '';
				$animal_breed = $this->api_model->get_animal_breed($animal_data[0]['breed_id']);
				//$d['animal_breed'] = $animal_breed[0]['breed_name']; 
				$animal_category = $this->api_model->get_animal_category($animal_data[0]['category_id']);
				//$d['animal_category'] = $animal_category[0]['category']; 
				if(isset($d['animal_simtoms'])){
					if($d['animal_simtoms'] == null){
						$ani_sys = [];
					}else{
					$ani_sys = $this->api_model->get_symtoms_animal($d['animal_simtoms']);
					}
				}else{
					$ani_sys = [];
				}
				foreach($ani_sys as $a_s){
						$b[] = $a_s['name'];
				}
				$d['animal_simtoms'] =$b;
				if($d['treat_type'] == 1){
					$pack_data = $this->api_model->get_data('vacc_id = "'.$d['vacc_id'].'"', 'package_masters');
					if($log_data[0]['package_id'] == ''){
						$log_update['package_id'] = $pack_data[0]['package_id'];
						$this->api_model->get_data_update('id = '.$log_data[0]['id'].'','log_file', $log_update);
					}
					$log = $this->api_model->get_data('id = '.$d['log_id'].'','log_file');
					// $d['package_name'] = $pack_data[0]['package_name'];
					// $d['package_price'] = $pack_data[0]['package_price'];
					// $d['package_doc_price'] = $pack_data[0]['doc_price'];
					//$this->api_model->get_data('request_id = '.$d['id'].'', 'vt_request_tracking');
					$vacc_data = $this->api_model->get_data('request_id = '.$d['id'].'', 'vt_request_tracking');
					if($d['vacc_id'] != ''){
						$i = 0;
						$y= 0;
						$pack_days =  explode(',',$pack_data[0]['package_days']);
						foreach($vacc_data as $v_d){
							if($i == 0 && $v_d['treat_status'] != '4'){
								$ai_log['log_id'] = $log[0]['id'];
								$ai_log['request_id'] = $d['id'];
								$ai_log['invoice_id'] =$d['Invoice_id'];
								$ai_log['vt_id'] = $d['vt_id'];
								$ai_log['company_charges'] =  $pack_data[0]['company_price'];
								$ai_log['farmer_price'] = $pack_data[0]['package_price'];
								$ai_log['ai_service_price'] = $pack_data[0]['doc_price'];
								$ai_log['premium_type'] = '0';
								$ai_log['status'] =  $log[0]['request_type'];
								$ai_log['date_time'] = date('Y-m-d h:i:s');
								$this->api_model->submit('ai_log', $ai_log);
							}
							if($sub_request_id == $v_d['id']){
								$up['treat_status'] = '4';
								$up['reschedule_date'] = date('Y-m-d');
								if(!is_null($v_d['animal_d']) || $v_d['animal_d']!=''){
									$up['animal_id'] = $animal_id;
								}
								$this->api_model->get_data_update('id = '.$v_d['id'].'','vt_request_tracking', $up);
							}
							$com_vacc = $this->api_model->get_data('id = '.$v_d['id'].'','vt_request_tracking');
							
							if($com_vacc[0]['treat_status'] != 4){
								$days += $pack_days[$i];
								$Date = date('Y-m-d');
								$dw['animal_id'] = $animal_id;
								if(is_null($v_d['animal_d']) || $v_d['animal_d']=='' || $v_d['animal_d'] == '0'){
									$dw['animal_id'] = $animal_id;
								}
								$dw['reschedule_date'] = date('Y-m-d', strtotime($Date. ' + '.$days.' days'));
								$this->api_model->get_data_update('id = '.$v_d['id'].'','vt_request_tracking', $dw);    
							}
							if($com_vacc[0]['treat_status'] == "4"){
								$y++;
							}
							
							$com_vacc = $this->api_model->get_data('id = '.$v_d['id'].'','vt_request_tracking');
							$d_v = $this->api_model->get_data('vaccination_id = '.$v_d['vacc_id'].'','vaccination');
							$dv_v[$i]['sub_request'] = $v_d['id'];
							$dv_v[$i]['treat_status'] = $com_vacc[0]['treat_status'];
							$dv_v[$i]['vacc_name'] = $d_v[0]['name'];
							$dv_v[$i]['vacc_description'] = $d_v[0]['short_desc'];
							$dv_v[$i]['reschedule_date'] = $com_vacc[0]['reschedule_date'];
							$i++;
						}
						if($y == $sub_detail[0]['count']){
							$up1['status'] = '4';
							$this->api_model->get_data_update('id = '.$request_id.'','vt_requests', $up1);
						}
						if(is_null($d['animal_id']) || $d['animal_id'] == '' || $d['animal_id'] == '0'){
							$up2['animal_id'] = $animal_id;
							$this->api_model->get_data_update('id = '.$request_id.'','vt_requests', $up2);
						}
						$vacc_detail = $dv_v;
					}
				}
				// $d['animal_name'] = $animal_data[0]['fullname'];
				// $d['tag_no'] = $animal_data[0]['tag_no'];
				// if($animal_data[0]['age'] != ''){
				// 	$d['animal_age'] = $animal_data[0]['age'];
				// 	$d['animal_age_month'] = $animal_data[0]['age_month'];
				// }else{
				// 	$d['animal_age'] = $animal_detail[0]['animal_age'];
				// 	$d['animal_age_month'] = $animal_detail[0]['animal_month'];
				// }
				// 	$img = $this->api_model->get_animal_image($d['animal_id']);
				// 		$file = base_url().'uploads/animal/'.$img[0]['images'];
				// 		$handlerr = curl_init($file);
				// 		curl_setopt($handlerr,  CURLOPT_RETURNTRANSFER, TRUE);
				// 		$resp = curl_exec($handlerr);
				// 		$ht = curl_getinfo($handlerr, CURLINFO_HTTP_CODE);
				// 		if ($ht == '404'){
				// 			$ani_tret['image'] = 'https://www.livestoc.com/uploads_new/animals/thumb/'.$img[0]['images'];
				// 		}
				// 		else {
				// 			$ani_tret['image'] = $file;
				// 		}
				// $d['image'] =  $ani_tret['image'];
				if($d['treat_type'] != 3){
					$d['vacc_detail'] = $vacc_detail;
				}else{
					$d['vacc_detail'] = [];
				}
				// $d['seman_breed'] = $d['seman_bread_name'];
				$r[] = $d;
			}
			$ani_d['animal_detail'] = array_values($r);
			// $ani_d['user_data'] = array_values($user_data);
			// $ani_d['order_type'] =  $request_det[0]['order_type'];
			$msg['users_id'] = $detail[0]['users_id'];
			$msg['title'] = "Vaccination Done";
			$msg['message'] = 'Animal ( # '.$animal_id.' )  has been successfully vaccinated with '.$vacc_name.'.';
			$msg['date'] = date('Y-m-d h:i:s');
			$msg['type'] = '2';
			$msg['isactive'] = '1';
			$msg['flag'] = '5';
			$this->api_model->user_notification($msg);
			$old_msg['to_users_id'] = $detail[0]['users_id'];
			$old_msg['to_id'] = $detail[0]['users_id'];
			$old_msg['to_type'] = 'users';
			$old_msg['title'] = "Vaccination Done";
			$old_msg['from_type'] = 'Livestoc Team';
			$old_msg['success'] = '1';
			$old_msg['device'] = 'android';
			$old_msg['active'] = '1'; 
			$old_msg['description'] = 'Animal ( # '.$animal_id.' )  has been successfully vaccinated with '.$vacc_name.'.';
			$old_msg['date_added'] = date('Y-m-d h:i:s');
			$this->api_model->old_notification($old_msg);
			$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
			$data['success'] =  True;
			$data['data'] =  $ani_d; 
		}
		echo json_encode($data);
	}
    public function make_request_package(){
        $vt_id = $this->input->get_post('vt_id');
		$pack_id = $this->input->get_post('pack_id');
		$users_id =$this->input->get_post('users_id');
		$animal_id =$this->input->get_post('animal_id');
		$admin_id = $this->input->get_post('admin_id');
		$app_type = $this->input->get_post('app_type');
		$request_type = $this->input->get_post('request_type');
		$address = $this->input->get_post('address');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$order_type = $this->input->get_post('order_type');
		$amount = $this->input->get_post('amount');
		$livestoc_balence_consume = $this->input->get_post('livestoc_balence_consume');
		$real_balance_consume = $this->input->get_post('real_balance_consume');
		$log_id = $this->input->get_post('log_id');
		if($users_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send User ID';
		}
		else if($log_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send Log Id';
		}else{
			if($livestoc_balence_consume != '0'){
				$wall['log_id'] = $log_id;
				if($app_type == '3'){
					$wall['users_id'] = $admin_id;
					$wall['user_type'] = '3';
				}else{
					$wall['users_id'] = $users_id;
				}
				$wall['animal_id'] = '';
				$wall['type'] = '48';
				$wall['amount'] = $livestoc_balence_consume;
				$wall['status'] = 'Dr';
				$wall['wallet_type'] = '0';
				$wall['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('livestoc_wallets',$wall);
			}
			if($real_balance_consume != '0'){
				$wall['log_id'] = $log_id;
				if($app_type == '3'){
					$wall['users_id'] = $admin_id;
					$wall['user_type'] = '3';
				}else{
					$wall['users_id'] = $users_id;
				}
				$wall['animal_id'] = '';
				$wall['type'] = '48';
				$wall['amount'] = $real_balance_consume;
				$wall['status'] = 'Dr';
				$wall['wallet_type'] = '1';
				$wall['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('livestoc_wallets',$wall);
			}
			// $animal_id = json_decode($animal_id);
			// $ani = implode(',', $animal_id);
			//$bull_id = json_decode($bull_id);
			if($request_type == '2'){

               // $this->api_model->
               $where .= ' AND users_type IN ("pvt_doc") AND is_vecc_term = "1" AND isactivated = "1" ';
            //    if($order_type == '1'){
            //         $where .= ' AND do.company_partner = "'.$order_type.'"';
            //     }
            //     if($bull_id != ''){
            //         $where1 = ' AND bull_id = "'.$bull_id.'"';
            //     }
			// echo "SELECT cl.doctor_id, do.username, do.email, do.total_experience, do.city, do.ai_visiting_fee, do.image,(select ROUND(avg(rating),1) as rating from doctor_call_rating where doctor_id = do.doctor_id) as rating, IFNULL(( 3959 * acos( cos( radians('$latitude') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('$langitude') ) + sin( radians('$latitude') ) * sin( radians( cl.lantitute ) ) ) ),0) AS distance FROM current_loc as cl, doctor as do where do.doctor_id = cl.doctor_id ".$where." having (distance <= '".RADIOUS_DIST."') order by  RAND() LIMIT 10";
			// exit;
               $vt_type = $this->api_model->query_build("SELECT cl.doctor_id, do.username, do.email, do.total_experience, do.city, do.ai_visiting_fee, do.image,(select ROUND(avg(rating),1) as rating from doctor_call_rating where doctor_id = do.doctor_id) as rating, IFNULL(( 3959 * acos( cos( radians('$latitude') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('$langitude') ) + sin( radians('$latitude') ) * sin( radians( cl.lantitute ) ) ) ),0) AS distance FROM current_loc as cl, doctor as do where do.doctor_id = cl.doctor_id ".$where." having (distance <= '".RADIOUS_DIST."') order by  RAND() LIMIT 10");
				//$vt_type = $this->api_model->get_ai_doc_stoc('pvt_doc', $langitude, $latitude, $bull_id, $order_type);
				$l=0;
				foreach($vt_type as $v){
					if($l == '0'){
						$do = $v['doctor_id'];
					}else{
						$do .= ','.$v['doctor_id'];
					}
					$vet[$l] = $v['doctor_id'];
					if($l == '5'){
					break;
					}
					$l++;
				}
				$vt_id =$do;
			}else{
				$vt_id = json_decode($vt_id);
				$vet = $vt_id;
				$vt_id = implode(',', $vt_id);
			}
			// echo $vt_id;
			// exit;
			// $vt_id = json_decode($vt_id);
			$pack_id = $pack_id;
			// $vt_id = implode(',', $vt_id);
			$treat_type = 4;
			$status = '0';
			$rand = rand(1000,9999);
			// if($request_type == '0'){
			// 	$status = '1';
			// }
			//if($request_type == '2'){
				$data['vt_id'] = $vt_id;
			//}
			$pack_data = $this->api_model->get_data('package_id = "'.$pack_id.'"' , 'package_masters', '', '*');
            $pack_id = explode(',',$pack_data[0]['vacc_id']);
			//$semen_group = $this->api_model->get_data('id ="'.$bull_data[0]['groups'].'"', 'semen_group','','*');
			if($order_type == '1'){
				// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
				// if($pack_data[0]['sum'] >  0){
				$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
				$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
				$end_data = date('Y-m-d');
				if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
					$data['premium_type'] = '1';
				}
			}
			$data['vacc_id'] = implode(',',$pack_id);
			$data['log_id'] = $log_id;
			$data['users_id'] =$users_id;
			$data['animal_id'] = $animal_id;
			$data['admin_id'] = $admin_id;
			$data['treat_type'] = $treat_type;
			$data['address'] = $address;
			$data['latitude'] = $latitude;
			$data['langitude'] = $langitude;
			$data['status'] = $status;
			$data['order_type'] = $order_type;
			$data['request_type'] = $request_type;
			$data['treat_type'] = '1';
			$data['otp'] = $rand;
			$data['date'] = date('Y-m-d');
			$data['time'] = '00:00';
			$data['created_on'] = date('Y-m-d h:i:s');
			$da = $this->api_model->submit('vt_requests', $data);
			// print_r($data);
			// exit;
			$log['type'] = '48';
			if($app_type == '3'){
				$log['users_id'] = $admin_id;
			}else{
				$log['users_id'] = $users_id;
			}
			$log['currency'] = 'INR';
			$log['request_id'] = $da;
            if($amount != $real_balance_consume){
                $log['request_status'] = '2';
                $log['status'] = '1';
                $log['request_type'] = '2';
            }else{
                $log['request_type'] = '1';
                $log['request_stats'] = '1';
			    $log['status'] = '1';
            }
			$log['user_type'] = '2';
			$log['date'] = date('Y-m-d');
			$log['method'] = 'Payment From Wallet';
			$this->api_model->update('id', $log_id, 'log_file', $log);
			//$this->api_model->submit('log_file', $log);
			$ra = rand(1000,9999);
			$dat = [];

			if(!empty($pack_id)){
				foreach($pack_id as $bu){
					$dat['request_id'] = $da;
					$dat['log_id'] = $log_id;
					$dat['animal_id'] = $animal_id;
					$dat['vt_id'] = $vt_id;
					$dat['request_type'] = $request_type;
					$dat['user_id'] = $users_id;
					$dat['vacc_id'] = $bu;
					$dat['treat_type'] = '1';
					$dat['treat_status'] ='0';
					$dat['status'] = $status;
					$dat['otp'] = $ra;
					$dat['date'] = date('Y-m-d');
					$this->api_model->submit('vt_request_tracking', $dat);
				}
			}
			$invoice['log_id'] = $log_id;
			$invoice['request_id'] = $da;
			$invoice['users_id'] =$users_id;
			$invoice['animal_id'] = $animal_id;
			$invoice['ai_price'] =  $pack_data[0]['doc_price'];
			$invoice['semen_stock_id'] = $pack_data[0]['package_id'];
			$invoice['semen_stock_price'] = $pack_data[0]['package_price'];
			$invoice['old_semen_stock_price'] = 0;
			$invoice['semen_stock_qty'] = 1;
			$invoice['status'] =  $log['request_type'];
			$invoice['date'] = date('Y-m-d h:i:s');
			$inv = $this->api_model->submit('semen_invoice_performa', $invoice);
			$user = $this->api_model->get_user_detail($users_id);
			$vt_inv['Invoice_id'] = $inv;
			$this->api_model->update('id', $da, 'vt_requests', $vt_inv);
			// if($request_type == '0' || $request_type == ''){
                //print_r($vet);

				foreach($vet as $v){
						$user_note = '';
						$title = 'New Vaccination Request';
						$flag = 5;
						$msg1 = 'You have a new Vaccination Request by '.$user[0]['fullname'].' from ('.$user[0]['address'].')';
						$user_note['users_id'] = $v; 
						$user_note['title'] = $title;
						$user_note['message'] = $msg1;
						$user_note['date'] = date('Y-m-d h:i:s');
						$user_note['type'] = '2';
						$user_note['isactive'] = '1';
						$user_note['flag'] = '1';
						$this->api_model->user_notification($user_note);
						$this->push_non($v,  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg1);
				}
			// }else if($request_type == '2'){
			// 	$vt_data = $this->api_model->get_ai_doc_stoc('pvt_ai', $langitude, $latitude);
			// 	foreach($vt_data as $vr){
			// 			$user_note = '';
			// 			$title = 'AI Request Placed';
			// 			$flag = 1;
			// 			$msg1 = 'You have new AI request by '.$user[0]['fullname'].' ('.$user[0]['address'].')';
			// 			$user_note['users_id'] = $vr['doctor_id'];
			// 			$user_note['title'] = $title;
			// 			$user_note['message'] = $msg1;
			// 			$user_note['date'] = date('Y-m-d h:i:s');
			// 			$user_note['type'] = '2';
			// 			$user_note['isactive'] = '1';
			// 			$user_note['flag'] = '1';
			// 			$this->api_model->user_notification($user_note);
			// 			$this->push_non($vr['doctor_id'],  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg1);
			// 	}
			// }
			$msg['users_id'] = $users_id;
			$msg['title'] = "Vaccination Request";
			$msg['message'] = 'Your request has been submitted successfully.You will be contacted soon.';
			$msg['date'] = date('Y-m-d h:i:s');
			$msg['type'] = '2';
			$msg['isactive'] = '1';
			$msg['flag'] = '5';
			$this->api_model->user_notification($msg);
			$old_msg['to_users_id'] = $users_id;
			$old_msg['to_id'] = $users_id;
			$old_msg['to_type'] = 'users';
			$old_msg['title'] = "Vaccination Request";
			$old_msg['from_type'] = 'Livestoc Team';
			$old_msg['success'] = '1';
			$old_msg['device'] = 'android';
			$old_msg['active'] = '1'; 
			$old_msg['description'] = 'Your request has been submitted successfully.You will be contacted soon.';
			$old_msg['date_added'] = date('Y-m-d h:i:s');
			$this->api_model->old_notification($old_msg);
			$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
			$u_data = $this->api_model->get_user_info_id($users_id);
			$to = TO_ADMIN;
			$subject = 'AI Request';
			$email = ''.$u_data[0]['full_name'].'('.$u_data[0]['mobile'].') has been initiated a AI request from '.$address.'';
			// $e = $this->send_mail($to, $subject, $email);
			// print_r($e);
			// exit;
			$json['success'] = true;
			$json['invoice'] = base_url('package/invoice/'.$inv.'');
			$json['msg'] = 'Your request has been submitted successfully.You will be contacted soon.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
    }
	public function invoice($id){
		$data['data'] = $this->api_model->get_data('id = '.$id.'', 'semen_invoice_performa');
		$this->load->view('admin/invoice_pack', $data);
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