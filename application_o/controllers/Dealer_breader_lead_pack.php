<?php
class Dealer_breader_lead_pack extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
	}
    public function index(){
        $type = $this->input->get_post('type');
        $lang = $this->input->get_post('lang');
        $where = '';
        if($type != ''){
            $where = " AND type = '".$type."'";
        }
        $select = '';
        $lang_select = '';
        if($lang != 'en' && $lang != ''){
            $select = ", name_".$lang." as name";
            $lang_select = ", description_".$lang." as description";
        }else{
            $select = ", name";
            $lang_select = ", description";
        }
        if($data = $this->api_model->get_data('', 'dealer_breader_lead_pack', '', 'id, lead_qty, price, offre_price, retailer_price '.$select.'')){
            $data_point = $this->api_model->get_data('isactive = "1" '.$where.'', 'breed_dealer', '', 'id '.$lang_select.'');
            $json['success'] = true;
            $json['comman_points'] = $data_point;
            $json['data_package'] = $data;
            //print_r($data);
        }else{
            $json['success'] = false;
            $json['error'] = 'This is shikku';
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
    public function purchase_lead(){
            $users_id = $this->input->get_post('users_id');
            $id = $this->input->get_post('id');
            $qty = $this->input->get_post('qty');
            $app_type = $this->input->get_post('app_type');
            $type = $this->input->get_post('type');
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
                $data1['animal_id'] = '';
                $data1['amount'] = $livestoc_balence_consume;
                $data1['status'] = 'Dr';
                $data1['wallet_type'] = '0';
                $data1['date'] = date('Y-m-d h:i:s');
                $this->api_model->submit('livestoc_wallets',$data1);
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
            }
            $data['users_id'] = $users_id;
            $data['app_type'] = $app_type;
            $data['package_id'] = $id;
            $data['lead_qty'] = $qty;
            $data['rest_qty'] = $qty;
            $data['admin_id'] = $admin_id;
            $data['log_id'] = $log_id;
            $data['created_date'] = date('Y-m-d');
            $this->api_model->submit('dealer_breader_lead_log', $data);
            // $u_data = $this->api_model->get_user_info_id($users_id); 
            // $to = TO_ADMIN;
            // $subject = 'Top Champion Dog Listing'; 
            // $email = ''.$contact_person.'('.$contact_phone.') has registered as breeder/dealer from '.$address.'';
            $count = $this->api_model->get_data('users_id = '.$users_id.'', 'dealer_breader_lead_log', '', 'if(sum(rest_qty) IS NOT NULL, sum(rest_qty), 0) as count');
            $json['success'] = true;
            $json['count'] = $count[0]['count'];
            $json['msg'] = 'You have successfully purchased the package. Thanks ';
            header('Content-Type: application/json');
            echo json_encode($json);
            exit;
	}
    public function lead_count(){
        $users_id = $this->input->get_post('users_id');
        if($data = $this->api_model->get_data('users_id = '.$users_id.'', 'dealer_breader_lead_log', '', 'if(sum(rest_qty) IS NOT NULL, sum(rest_qty), 0) as count')){
            $json['success'] = true;
            $json['count'] = $data[0]['count'];
        }else{
            $json['success'] = false;
            $json['error'] = 'You have no available leads count. Please purchase first.';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }

}