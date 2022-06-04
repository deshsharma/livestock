<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Featured_access_pack extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		$this->load->model('loginmodel');
		$this->load->model('pushnoti_model');
		$this->load->model('front_end_model');
		$this->load->model('Admin_detail');
		$this->data = '';
		date_default_timezone_set('Asia/Calcutta');
	}
    public function index(){
        $package_id=$this->input->get_post('package_id');
		$users_id=$this->input->get_post('users_id');
        $admin_id=$this->input->get_post('admin_id');
        $animal_id=$this->input->get_post('animal_id');
		$package_type = $this->input->get_post('package_type');
        $type = $this->input->get_post('type');
        $currency = $this->input->get_post('currency');
        $request_status = $this->input->get_post('request_status');
        $users_type =$this->input->get_post('users_type');
        if(!isset($_REQUEST['package_id']) || $_REQUEST['package_id'] =='')
		{
			$json['error'][] = "Package id is required";
		}
		if(!isset($_REQUEST['users_id']) || $_REQUEST['users_id']=='')
		{
			$json['error'][] = "Users id is required";
		}
		if(!isset($_REQUEST['package_type']) || $_REQUEST['package_type']=='')
		{
			$json['error'][] = "Package type is required";
		}
        $get_package_list = $this->api_model->get_data('package_id='.$package_id.'', 'package_masters');
        $package_name = $get_package_list[0]['package_name'];
	    $package_type_id = $get_package_list[0]['package_type_id'];
		$package_days = $get_package_list[0]['package_days'];
		$package_callnum = $get_package_list[0]['package_callnum'];
		$expiry_date = date('Y-m-d H:i:s', strtotime('+'.$package_days.' days'));
		$amount = $get_package_list[0]['package_price'];
		$total = $get_package_list[0]['total'];
        $today = date("Y-m-d");
        $pack = $this->api_model->get_data('package_id='.$package_id.' and users_id='.$users_id.' and package_call_left>0 and package_current_status ="1" and package_expired_on>="'.$today.'"', 'package_users_log', '', 'package_users_log_id');
        if($pack[0]['package_users_log_id']>0){
            $json['error'][] = "This pack is already purchased by you";
        }
        if(!$json)
		{
            $addpackage_field = [
                'users_id'         =>  $users_id,
                'package_id'       =>  $package_id,
                'users_type'       =>  $users_type,
                'animal_id'        =>  $animal_id,
                'type'             =>  $package_type,
                'package_callnum'  =>  $package_callnum,
            // 'date_added'          =>  $date_added,
                'expiry_date'      =>  $expiry_date,
                'amount'           =>  $amount,
                'total'            =>  $total,
                'created_on'       =>  date('Y-m-d H:i:s')
                    ];
                $add_purchase = $this->api_model->submit('purchase', $addpackage_field);
                //print_r($add_purchase);
                    $log['users_id'] = $users_id;
                    $log['currency'] = $currency;
                    $log['type'] = $type;
                    $log['amount'] = $amount;
                    $log['user_type'] = '1';
                    $log['premium_bull_type'] = '';
                    $log['request_status'] = isset($request_status) ? $request_status : 0;
                    $log['date'] = date('Y-m-d h:i:s');
                    
            if($log_id = $this->api_model->insert_log_data($log)){
                $logid = $log_id[0]['purchase_id'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$log_id."&amount=".$amount."&currency=".$currency."",
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
                if($users_type == '3'){
                    $amount_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "1" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $amount_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "1" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
                    $amoun_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "0" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $amoun_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "0" AND user_type= "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
                }
                else{
                    $amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
                    $amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
                }
                $a['real_balance'] = $livestoc_balance;
				$a['livestoc_balence'] = $real_balance;
				$a['min_balance'] = $total_rate;
				// if($type == 32){
					$a['product_consume_rate'] = $real_balance;
                    $a['livestoc_balence_status']=0;
                    $a['livestoc_balence_consume']=0;
				// }else{
				// 	$a['product_consume_rate'] = 500;
				// }
                //$a['log_id'] = $log_id[0]['purchase_id'];
                $total_rate = $amount;
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
                $insert_user_pack_log = [
                        'purchase_id'           =>  $add_purchase,
                        'users_id'              =>  $users_id,
                        'animal_id'             =>  $animal_id,
                        'package_id'            =>  $package_id,
                        'package_name'          =>  $package_name,
                        'package_call_left'     =>  $package_callnum,
                        'package_type_id'       =>  $package_type_id,
                        'package_subscribed_on' =>  date('Y-m-d H:i:s'),
                        'package_current_status'=> 0,
                        'package_expired_on'    =>  $expiry_date 
                            ];
                $this->api_model->submit('package_users_log', $insert_user_pack_log);
                $logsfields = [
                        'users_id'         =>  $users_id,
                        'animal_id'        =>  $animal_id,
                        'type'             =>  'Buy Pack',
                        'purchase_id'      =>  $add_purchase,
                        'api'              =>  'featured_access_pack',
                        'created_on'       =>  date('Y-m-d H:i:s')
                    ];
                $this->api_model->submit('users_logs',$logsfields);
                // $json['success'] = TRUE;
                // $json['data'] = $addpackage_field;
                // $json['data']['purchase_id'] = $add_purchase;
                // $json['data']['shopping_order_id'] = 'pack_'.$add_purchase;
                $loq =  $total_rate;
			// $tax =  ((($total_rate) * SERVICE_TAX)/100);
			// $purchase_amount = $total_rate + ((($total_rate) * SERVICE_TAX)/100);
			$purchase_amount = $total_rate;
			$data = [];
			$data[1]['service_key'] = "Amount";
			$data[1]['price'] = $loq;
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
			$data[5]['service_key'] = "Total Amount";
			$data[5]['price'] = $product_rate;
            }
            $json['razorpayOrderId'] =  json_decode($response);
			$json['order_id'] = "LVAT_".$logid;
			$json['purchase_id'] = $logid;
			$detail_1['services_charges'] = array_values($data);
			$json['success']  = true; 
			$json['data'] = $detail_1;
			$json['purchase_amount'] = $purchase_amount;
			$json['actual_payment'] = $product_rate;
			$json['total_price'] = $loq;
			$json['livestoc_balence_status'] = $a['livestoc_balence_status'];
			$json['livestoc_balence_consume'] = $a['livestoc_balence_consume'];
			$json['real_balance_status'] = $a['real_balance_status'];
			$json['real_balance_consume'] = $a['real_balance_consume'];
            $json['expired_on'] = $expiry_date;
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function make_feature(){
        $users_id = $this->input->get_post('users_id');
        $app_type = $this->input->get_post('user_type');
        $type = $this->input->get_post('type');
        $animal_id = $this->input->get_post('animal_id');
        $admin_id = $this->input->get_post('admin_id');
        $log_id = $this->input->get_post('purchase_id');
        $livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
        $real_balance_consume = $this->input->get_post('real_balance_consume');
        if($livestoc_balence_consume != '0' && !is_null($livestoc_balence_consume) && $livestoc_balence_consume != ''){
            $data1['log_id'] = $log_id;
            if($app_type == '3'){
                $data1['users_id'] = $admin_id;
                $data1['user_type'] = '3';
            }else{
                $data1['users_id'] = $users_id;
            }
            $data1['type'] = $type;
            $data1['animal_id'] = $animal_id;
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
            $data1['animal_id'] = $animal_id;
            $data1['amount'] = $real_balance_consume;
            $data1['status'] = 'Dr';
            $data1['wallet_type'] = '1';
            $data1['date'] = date('Y-m-d h:i:s');
            $this->api_model->submit('livestoc_wallets',$data1);
            $is_premium = '1';
        }
        $data['package_current_status'] = '1' ;
        $this->api_model->get_data_update("purchase_id = '".$purchase_id."' and `package_current_status` = 0", "package_users_log", $data);
        $users = $this->api_model->get_data("users_id = '".$users_id."'","users");
        $ani_data['animal_purpose'] = '2';
        $this->api_model->get_data_update("users_id = '" .$users_id."' and `animal_id`='" .$animal_id . "'",'animals', $ani_data);
        $pack_data['package_call_left'] = '0';
        $pack_data['package_current_status'] = '0';
        $this->api_model->get_data_update("users_id = '".$users_id."' and package_id=21",'package_users_log', $pack_data);
        $json['success'] = true;
        if($type == '47')
        $json['msg'] = 'Your animal is successfully added to featured section.';
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
}