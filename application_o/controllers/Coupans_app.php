<?php
class Coupans_app extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		date_default_timezone_set('Asia/Calcutta');
    }
    public function check_coupans(){
		$product_id = $this->input->get_post('product_id');
		$product_id = json_decode($product_id);
		$product_id = implode(',', $product_id);
		//echo $product_id;
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		$isactive = '1';
        $detail = '';
		if($coup = $this->api_model->get_data('FIND_IN_SET(product_id , "'.$product_id.'") AND users_id = '.$users_id.' AND type = "'.$type.'" AND isactive = "'.$isactive.'"', 'coupans')){
			$i = 0;
            foreach($coup as $co){
			// echo $co['created_on'];
			// echo "</br>";
			// echo date('Y-m-d h:i:s', strtotime('+1 hour',strtotime($co['created_on'])));
                if(date('Y-m-d h:i:s') <= date('Y-m-d h:i:s', strtotime('+1 hour',strtotime($co['created_on'])))){
					//echo "this is test"; 
                    $detail[$i] = $co;
                    $i++;
                }
			}
			//echo "this is test";
			if(!empty($detail)){
				$json['success'] = true;
				$json['data'] =  $detail;
			}else{
				$json['success'] = false;
				$json['error'] = 'No Coupans Found';
			}
        }else{
            $json['success'] = false;
            $json['error'] = 'No Coupans Found';
        }
	        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
    public function get_calculation(){
		$type = $this->input->get_post('type');
		$admin_id = $this->input->get_post('admin_id');
		$users_id =$this->input->get_post('users_id');
        $total_price = $this->input->get_post('total_price');
		$users_type =$this->input->get_post('users_type');
		$coupans_id = $this->input->get_post('coupans_id');
		$coupand_id = json_decode($coupans_id);
		$coupans_id = implode(',',$coupand_id);
		$qty =$this->input->get_post('qty');
		$request_status = $this->input->get_post('request_status');
		$currency = $this->input->get_post('currency');
		$data = [];
		$detail =[];
		$detail_1 =[];
		$i = 0;
		$y = 0;
		$num_strow = 0;
		$ai_charge = 0;
		$discount = 0;
		if($coup = $this->api_model->get_data('FIND_IN_SET(id, "'.$coupans_id.'") AND isactive = "1"', 'coupans')){
            $i = 0;
            foreach($coup as $co){
                if(date('Y-m-d h:i:s') <= date('Y-m-d h:i:s', strtotime('+1 hour',strtotime($co['created_on'])))){
                    $discount += $co['rate'];
                    $i++;
                }
            }
        }
		$total_rate = $total_price - $discount;
		$company_set = 0;
			if($users_type == '3'){
				$amount_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "1" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "1" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
				$amoun_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "0" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "0" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
			}else if($users_type == '2'){
				$query = "call get_doc_account(".$admin_id.");";
				$count = $this->api_model->query_build($query);
				$this->db->close();
				$query = "Select count(id) as count, if(sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)) IS NOT NULL, sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)),0) as company_share, if(sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))) IS NOT NULL,sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))), 0) as your_share from doctor_call_inisite where log_id <> '0' AND doctor_id = '".$admin_id."'";
				$call_data = $this->api_model->query_build($query);
				if((($count[0]['total_cr'] - $count[0]['total_dr'])+($call_data[0]['your_share'] - $call_data[0]['company_share'])) > 0){
					$company_set = (($count[0]['total_cr'] - $count[0]['total_dr'])+($call_data[0]['your_share'] - $call_data[0]['company_share']));
				}
				$amount_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "1" AND user_type= "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "1" AND user_type= "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
				$amoun_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "0" AND user_type= "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "0" AND user_type= "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
				// exit;
			}else{
				$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
			}
			// print_r($real_balance);
			// print_r($livestoc_balance);
				// $a['real_balance'] = $livestoc_balance;
				// if($type == 50){
					$a['livestoc_balence'] = 0;
				// }else{
				// 	$a['livestoc_balence'] = $real_balance;
				// }
				//$a['livestoc_balence'] = $real_balance;
				$a['min_balance'] = $total_rate;
				// if($type == 32){
					$a['product_consume_rate'] = 0;
				// }else{
				// 	$a['product_consume_rate'] = 500;
				// }
				$log['users_id'] = $users_id;
				$log['currency'] = $currency;
				$log['type'] = $type;
				$log['amount'] = $total_rate;
				$log['user_type'] = '1';
				$log['premium_bull_type'] = '';
				$log['request_status'] = isset($request_status) ? $request_status : 0;
				$log['date'] = date('Y-m-d h:i:s');
				$log_id = $this->api_model->insert_log_data($log);
				$a['log_id'] = $log_id[0]['purchase_id'];
				$logid = $log_id[0]['purchase_id'];
				// if($company_set > 0){
				// 	if($company_set >= $total_rate){
				// 		$consume_set = $total_rate;
				// 		$total_rate = 0;
				// 	}else{
				// 		$consume_set = $company_set;
				// 		$total_rate = $total_rate - $company_set;
				// 	}
				// }
				$a['real_balance'] = $livestoc_balance;
				//$product_rate = $total_rate;
					if($a['livestoc_balence'] > 0){
						if($a['product_consume_rate'] >= $total_rate){
							if($a['livestoc_balence'] == $total_rate){
								$a['livestoc_balence_consume'] = $total_rate;
								$a['livestoc_balence_status'] = 0; 
								$product_rate = 0;
							}else if($a['livestoc_balence'] < $total_rate){
									$a['livestoc_balence_status'] = 0; 
									$a['livestoc_balence_consume'] = $a['livestoc_balence'];
									$product_rate = $total_rate - $a['livestoc_balence'];
							}else if($a['livestoc_balence'] >  $total_rate){
								$a['livestoc_balence_consume'] = $total_rate;
								$a['livestoc_balence_status'] = $a['livestoc_balence']- $total_rate; 
								$product_rate =0;
							}
						}else{
							// echo "this is false";
							// echo $total_rate."<br>";
							//echo $a['livestoc_balence']."<br>";
							// echo $a['product_consume_rate'];
							if($a['livestoc_balence'] == $a['product_consume_rate']){
								$a['livestoc_balence_consume'] = $a['product_consume_rate'];
								$a['livestoc_balence_status'] = 0; 
								$product_rate = $total_rate - $a['product_consume_rate'];
							}else if($a['livestoc_balence'] < $total_rate){
								if($a['livestoc_balence'] > $a['product_consume_rate']){
									$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
									$a['livestoc_balence_consume'] = $a['product_consume_rate'];
									$product_rate = $total_rate - $a['product_consume_rate'];
								}else{
									$a['livestoc_balence_status'] = $a['livestoc_balence']; 
									$a['livestoc_balence_consume'] =$a['livestoc_balence'];
									$product_rate = $total_rate - $a['livestoc_balence'];
								}	
							}else if($a['livestoc_balence'] > $total_rate){
								if($a['livestoc_balence'] > $a['product_consume_rate']){
									$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
									$a['livestoc_balence_consume'] = $a['product_consume_rate'];
									$product_rate = $total_rate - $a['product_consume_rate'];
								}else{
									$a['livestoc_balence_status'] = $a['livestoc_balence']; 
									$a['livestoc_balence_consume'] =$a['livestoc_balence'];
									$product_rate = $total_rate - $a['livestoc_balence'];
								}	
							}else{
								$a['livestoc_balence_status'] = 0;
								$a['livestoc_balence_consume'] = 0;
							}
						}
					}else{
						$a['livestoc_balence_status'] = 0;
						$a['livestoc_balence_consume'] = 0;
						$product_rate = $total_rate;
					} 
					// echo $a['livestoc_balence_status'];
					// echo $a['livestoc_balence_consume']; 
					// echo $product_rate;
					// exit;
					if($product_rate  != 0){
						if($a['real_balance'] > 0){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$product_rate = 0;
							}else if($a['real_balance'] < $product_rate){
								$a['real_balance_status'] =  $product_rate - $a['real_balance']; 
								$a['real_balance_consume'] =$a['real_balance'];
								$product_rate = $product_rate - $a['real_balance'];
							}else if($a['real_balance'] > $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = $a['real_balance'] - $product_rate; 
								$product_rate = 0;
							}else{
								$a['real_balance_status'] = 0;
								$a['real_balance_consume'] = 0;
							}
						}else{
							$a['real_balance_status'] = 0;
							$a['real_balance_consume'] = 0;
						}
					}else{
						$a['real_balance_status'] = $product_rate;
						$a['real_balance_consume'] = 0;
					}
			$loq = $log['amount'];
			//print_r($a);
			// $tax =  ((($total_rate) * SERVICE_TAX)/100);
			// $purchase_amount = $total_rate + ((($total_rate) * SERVICE_TAX)/100);
			$purchase_amount = $log['amount'];
			$data = [];
			$data[1]['service_key'] = "Amount";
			$data[1]['price'] = $total_price;
			// $data[2]['service_key'] = "GST (".SERVICE_TAX."%)";
			// $data[2]['price'] = $tax;
			if($a['livestoc_balence_consume'] != 0){
				$data[3]['service_key'] = 'Livestoc Balance';
				$data[3]['price'] = $a['livestoc_balence_consume'];
			}
			if($a['real_balance_consume'] != 0){
				$data[4]['service_key'] = 'Wallet Balance';
				$data[4]['price'] = $a['real_balance_consume'];
			}
			if($consume_set != 0){
				$data[6]['service_key'] = 'Company Outstanding';
				$data[6]['price'] = $consume_set;
			}
			$data[6]['service_key'] = 'Discount';
			$data[6]['price'] = $discount;
			$data[5]['service_key'] = "Total Amount";
			$data[5]['price'] = $product_rate;
			//$data[6]['service_key'] = 'Grand total';
			//$data[6]['price'] = $total_price;
			if($product_rate == 0 ){
				$pr = $log['amount'];
			}else{
				$pr = $product_rate;
			}
					$curl = curl_init();
					curl_setopt_array($curl, array(
					CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$logid."&amount=".$pr."&currency=".$currency."",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER => array(
						"Accept: */*",
						"Accept-Encoding: gzip, deflate",
						"Cache-Control: no-cache",
						"Connection: keep-alive",
						"Cookie: PHPSESSID=pd76811dvepd0ao972vfg5abi4; ci_session=pmsh0l1ish4521b781egnuj41galc4uj",
						"Host: www.livestoc.com",
						"Postman-Token: 91f7b6cf-efc3-4c86-a7ec-f27f9e4f829f,ef189fb4-d157-44d2-ba00-804ee44657e4",
						"User-Agent: PostmanRuntime/7.15.2",
						"cache-control: no-cache"
					),
					));
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);
					$json['razorpayOrderId'] =  json_decode($response);
					$json['order_id'] = "LVAT_".$logid;
					$json['purchase_id'] = $logid;
			$detail_1['services_charges'] = array_values($data);
			$json['success']  = true; 
			$json['data'] = $detail_1;
			$json['discount'] = $discount;
			$json['purchase_amount'] = $total_price;
			$json['actual_payment'] = $product_rate;
			$json['total_price'] = $loq;
			$json['livestoc_balence_status'] = $a['livestoc_balence_status'];
			$json['company_outstanding'] = $consume_set;
			$json['livestoc_balence_consume'] = $a['livestoc_balence_consume'];;
			$json['real_balance_status'] = $a['real_balance_status'];
			$json['real_balance_consume'] = $a['real_balance_consume'];
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
}