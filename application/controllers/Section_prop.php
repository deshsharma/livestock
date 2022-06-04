<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Section_prop extends CI_Controller {
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
	public function get_feed_formulation(){
		$users_id = $this->input->get_post('users_id');
		if($data = $this->api_model->get_data('payment_status = "1" AND users_id = "'.$users_id.'" AND isactive = "2"', 'feed_formulation_req', 'id DESC', 'id, created_on,  (select name from product_section where section_id = id) as section_name, (select full_name from users where users_id = feed_formulation_req.users_id) as user_name, (select mobile from users where users_id = feed_formulation_req.users_id) as user_mobile, (select name from section_property where section_prop_id = id) as section_prop_name, prop_price, isactive')){
			$detail = '';
			foreach($data as $da){
				$feed_data = $this->api_model->get_data('request_id = "'.$da['id'].'"','feed_composition_log','','(select name from feed_composition where id = feed_composition_id) as composition_name, (select (select name from unit where id = feed_composition.unit) from feed_composition where id = feed_composition_id) as composition_unit, feed_composition_rate');
				$da['comp_data'] =  $feed_data;
				$detail[] = $da;
			}
			//print_r($detail);
			$json['success']  = true; 
			$json['data']  = $detail; 
		}else{
			$json['success']  = false; 
			$json['error'] = "No Feed Formulation Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
    public function get_section_prop(){
		$section_id = $this->input->get_post('section_id');
		$where = '';
		if($section_id != ''){
			$where = 'AND section_id = "'.$section_id.'"';
		}
		if($data = $this->api_model->get_data('isactive = "1" '.$where.'','section_property')){
			$json['success']  = true; 
			$json['data']  = $data; 
		}else{
			$json['success']  = false; 
			$json['error'] = "No data found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
    public function get_section_prop_calculation(){
		$type = $this->input->get_post('type');
		$admin_id = $this->input->get_post('admin_id');
		$users_id =$this->input->get_post('users_id');
        $total_price = $this->input->get_post('total_price');
		$users_type =$this->input->get_post('users_type');
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
		$total_rate = $total_price;
			if($users_type == '3'){
				$amount_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "1" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "1" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
				$amoun_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "0" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "0" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
			}else{
				$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type <> "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1" AND user_type <> "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0" AND user_type <> "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0" AND user_type <> "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
			}
				$a['real_balance'] = $livestoc_balance;
				$a['min_balance'] = $total_rate;
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
				$product_rate = $total_rate;
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
			$loq =  $total_rate;
			$tax =  ((($total_rate) * SERVICE_TAX)/100);
			$purchase_amount = $total_rate + ((($total_rate) * SERVICE_TAX)/100);
			$data = [];
			$data[1]['service_key'] = "Amount";
			$data[1]['price'] = $loq;
			$data[2]['service_key'] = "GST (".SERVICE_TAX."%)";
			$data[2]['price'] = $tax;
			if($a['livestoc_balence_consume'] != 0){
				$data[3]['service_key'] = 'Livestoc Balance';
				$data[3]['price'] = $a['livestoc_balence_consume'];
			}
			if($a['real_balance_consume'] != 0){
				$data[4]['service_key'] = 'Wallet Balance';
				$data[4]['price'] = $a['real_balance_consume'];
			}
			$data[5]['service_key'] = "Total Amount";
			$data[5]['price'] = $product_rate;
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
			$json['purchase_amount'] = $purchase_amount;
			$json['actual_payment'] = $product_rate;
			$json['total_price'] = $loq;
			$json['livestoc_balence_status'] = 0;
			$json['livestoc_balence_consume'] = 0;
			$json['real_balance_status'] = $a['real_balance_status'];
			$json['real_balance_consume'] = $a['real_balance_consume'];
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
    public function make_free_section_prop(){
        $users_id = $this->input->get_post('users_id');
        $id = $this->input->get_post('ids');
        $id = json_decode($id);
        $payment_status = $this->input->get_post('payment_status');
        $section_id = $this->input->get_post('section_id');
        $app_type = $this->input->get_post('user_type');
        $type = $this->input->get_post('type');
        $admin_id = $this->input->get_post('admin_id');
        $log_id = $this->input->get_post('purchase_id');
        $livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
        $real_balance_consume = $this->input->get_post('real_balance_consume');
        if($user_type == "15"){
            $u_type = "5";
        }
        if($user_type == "16"){
            $u_type = "4";
        }
        $is_premium = '0';
        if($livestoc_balence_consume != '0' && !is_null($livestoc_balence_consume) && $livestoc_balence_consume != ''){
            $data1['log_id'] = $log_id;
            if($app_type == '3'){
                $data1['users_id'] = $admin_id;
                $data1['user_type'] = '3';
            }else{
                $data1['users_id'] = $users_id;
            }
            $data1['type'] = $type;
            $data1['animal_id'] = '';
            $data1['amount'] = $livestoc_balence_consume;
            $data1['status'] = 'Dr';
            
            $data1['wallet_type'] = '0';
            $data1['date'] = date('Y-m-d h:i:s');
            $this->api_model->submit('livestoc_wallets',$data1);
            $is_premium = '1';
        }
        if($real_balance_consume != '0' && !is_null($real_balance_consume) && $real_balance_consume != ''){
            $data1['log_id'] = $log_id;
            if($app_type == '3'){
                $data1['users_id'] = $admin_id;
                $data1['user_type'] = '3';
            }else{
                $data1['users_id'] = $users_id;
            }
            $data1['type'] = $type;
            $data1['animal_id'] = '';
            $data1['amount'] = $real_balance_consume;
            $data1['status'] = 'Dr';
            $data1['wallet_type'] = '1';
            $data1['date'] = date('Y-m-d h:i:s');
            $this->api_model->submit('livestoc_wallets',$data1);
            $is_premium = '1';
        }	
        // if($livestoc_balence_consume!='0' || $real_balance_consume!='0'){
        // 	$this->consume_wallet($users_id, '', $livestoc_balence_consume, $real_balance_consume, $log_id, $user_type);
        // }
        if($app_type == '3'){
            $data['app_type'] = $app_type;
            $data['admin_change_status_id'] = $admin_id;
        }
        foreach($id as $d){
            $dom = $this->api_model->get_data('id = '.$d.'','section_property');
            $data['section_id'] = $section_id;
            $data['users_id'] = $users_id;
            $data['section_prop_id'] = $d;
            $data['prop_price'] = $dom[0]['price'];
            $data['user_type'] = $app_type;
            $data['payment_status'] = $payment_status;
			$data['created_on'] = date('Y-m-d');
            $this->api_model->submit('feed_formulation_req', $data);
        }
            $u_data = $this->api_model->get_user_info_id($users_id); 
            $to = TO_ADMIN;
            $subject = 'Top Champion Dog Listing'; 
            $email = ''.$contact_person.'('.$contact_phone.') has registered as breeder/dealer from '.$address.'';
            $json['success'] = true;
            $json['msg'] = 'You will get a Feed Formulation soon. You will be updated by a notification.';
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
        
	}
}