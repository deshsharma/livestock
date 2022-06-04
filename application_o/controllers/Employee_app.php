<?php
class Employee_app extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
    }
    public function deep_link(){
        $code = $this->input->get_post('code');
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
        $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
        if( $iPod || $iPhone || $iPad){
        header( 'Location: http://itunes.apple.com/app/clash-of-clans/id529479190?mt=8' );
        die();
        }
        else if($Android){
        header( 'Location: market://details?id=com.it.livestoc&code='.$code.'' );
        die();
        }
        else
        {
        header( 'Location: https://play.google.com/store/apps/details?id=com.it.livestoc&hl=ene&code='.$code.'' );
        die();
        }
    }
    public function get_emp_data(){
        $admin_id = $this->input->get_post('admin_id');
        $login_detail = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'admin as ad', '', '*, (select fname from admin where admin_id = ad.super_admin_id) as super_admin_name, (select mobile from admin where admin_id = ad.super_admin_id) as super_admin_mobile');
        $dist = $this->api_model->get_distict_id($login_detail[0]['district']);
		$state = $this->api_model->get_state_id($login_detail[0]['state']);
		$login_detail[0]['state_name'] = $state[0]['state_name'];
		$login_detail[0]['district_name'] = $dist[0]['dist_name'];
		$login_detail[0]['image'] = base_url().'uploads/bank/'.$login_detail[0]['image'];
		$json['success']  = true; 
        $json['data'] = $login_detail[0];
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function get_district_manager(){
        if($data = $this->api_model->get_data('type IN ("37","38")', 'admin', '', 'admin_id, referral_code as refral_code, CONCAT(CONCAT(fname," "), lname) as user_name')){
                $json['success']  = true; 
                $json['data'] = $data;
        }else{
                $json['success']  = false; 
                $json['error'] = 'No data found.';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function get_referal_valid(){
        $referral_code = $this->input->get_post('referral_code');
        if($data = $this->api_model->get_data('referral_code = "'.$referral_code.'"', 'admin', '', 'admin_id')){
                $json['success']  = true; 
                $json['admin_id'] = $data[0]['admin_id'];
        }else{
                $json['success']  = false; 
                $json['error'] = 'Please Enter Valid Referral code.';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function user_update_premium(){
                $log_id = $this->input->get_post('purchase_id');
                $package_id = $this->input->get_post('package_id');
                $payment_type = $this->input->get_post('payment_type');
                $package_price = $this->input->get_post('package_price');
                $admin_id = $this->input->get_post('admin_id');
                $promo_balance = $this->input->get_post('promo_balance');
                $ai_promo_balance = $this->input->get_post('ai_promo_balance');
                $company_outstanding = $this->input->get_post('company_outstanding');
                $users_id = $this->input->get_post('users_id');
                $app_type = $this->input->get_post('user_type');
                $type = '0';
                $livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
                $real_balance_consume = $this->input->get_post('real_balance_consume');
              
                if($package_id == ''){
                        $json['success']  = false; 
                        $json['error'] = 'Please send package Id';
                }else{
                      if($this->api_model->get_data('id = "'.$package_id.'" AND is_active = "1"', 'farmer_plans')){
                                        if($livestoc_balence_consume != '0' && !is_null($livestoc_balence_consume) && $livestoc_balence_consume != ''){
                                                $data1['log_id'] = $log_id;
                                                if($app_type == '3'){
                                                $data1['users_id'] = $admin_id;
                                                $data1['user_type'] = '3';
                                                }else if($app_type == '2'){
                                                    $data1['users_id'] = $admin_id;
                                                    $data1['user_type'] = '1';
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
                                                }else if($app_type == '2'){
                                                    $data1['users_id'] = $admin_id;
                                                    $data1['user_type'] = '1';
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
                                        $update['payment_type'] = 'Cr';
                                        $update['date'] = date('Y-m-d H:i:s');
                                        $update['method'] = "Wallet";
                                        // print_r($update);
                                        // exit;
                                        $this->api_model->update('id', $log_id,'log_file', $update);
                                        // echo "this is test";
                                        // exit;
                                        $date = date('Y-m-d H:i:s');
                                        $data_pack['users_id'] = $users_id;
                                        $data_pack['package_id'] = $package_id;
                                        $data_pack['animal_quantity'] = '0';
                                        $data_pack['rest_quantity'] = '0';
                                        $data_pack['payment_type'] = $payment_type;
                                        $data_pack['package_price'] = $package_price;
                                        $data_pack['admin_id'] = $admin_id;
                                        $data_pack['date'] = date('Y-m-d');
                                        $this->api_model->submit('ai_package_log', $data_pack);
                                        if($promo_balance != '0'){
                                            if($app_type == '2'){
                                                if($company_outstanding != 0 && $company_outstanding != ''){
                                                    $set['log_id'] = $log_id;
                                                    $set['payment_type'] = '32';
                                                    $set['users_id'] = $admin_id;
                                                    $set['users_type'] = '2';
                                                    $set['status'] = 'Dr';
                                                    $set['transaction_id'] = '';
                                                    $set['company_status'] = 'Cr';
                                                    $set['amount'] = $company_outstanding;
                                                    $set['date'] = date('Y-m-d h:i:s');
                                                    $set['created_on'] = date('Y-m-d h:i:s');
                                                    $this->api_model->submit('company_settlement_account', $set);
                                                }
                                                if($ai_promo_balance != 0 && $ai_promo_balance != ''){
                                                    $set1['log_id'] = $log_id;
                                                    $set1['payment_type'] = '46';
                                                    $set1['users_id'] = $admin_id;
                                                    $set1['users_type'] = '2';
                                                    $set1['status'] = 'Cr';
                                                    $set1['transaction_id'] = '';
                                                    $set1['company_status'] = 'Dr';
                                                    $set1['amount'] = $ai_promo_balance;
                                                    $set1['date'] = date('Y-m-d h:i:s');
                                                    $set1['created_on'] = date('Y-m-d h:i:s');
                                                    $this->api_model->submit('  ', $set1);
                                                }
                                            }
                                                $wall_data['log_id'] = $log_id;
                                                $wall_data['users_id'] = $users_id;
                                                $wall_data['user_type'] = '0';
                                                $wall_data['amount'] = $promo_balance;
                                                $wall_data['status'] = 'Cr';
                                                $wall_data['wallet_type'] = '0';
                                                $wall_data['date'] = date('Y-m-d h:i:s');
                                                $this->api_model->submit('livestoc_wallets', $wall_data);
                                            
                                        }
                                        $json['success']  = true; 
                                        $json['msg'] = 'Successfully upgraded to Premium';
                      } else{
                        $json['success']  = false; 
                        $json['error'] = 'Please send valid package Id';    
                      }
                }
                
                header('Content-Type: application/json');
                echo json_encode($json);
                exit;
    }
    public function make_retailer(){
        $id = $this->input->get_post('id');
        $qty = $this->input->get_post('qty');
        $app_type = $this->input->get_post('user_type');
        $type = $this->input->get_post('type');
        $package_price = $this->input->get_post('package_price');
        $admin_id = $this->input->get_post('admin_id');
        $log_id = $this->input->get_post('purchase_id');
        $livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
        $real_balance_consume = $this->input->get_post('real_balance_consume');
        if($livestoc_balence_consume != '0' && !is_null($livestoc_balence_consume) && $livestoc_balence_consume != ''){
            $data1['log_id'] = $log_id;
            // if($app_type == '3'){
                $data1['users_id'] = $admin_id;
                $data1['user_type'] = '3';
            // }else{
            //     $data1['users_id'] = $users_id;
            // }
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
            // if($app_type == '3'){
                $data1['users_id'] = $admin_id;
                $data1['user_type'] = '3';
            // }else{
            //     $data1['users_id'] = $users_id;
            // }
            $data1['type'] = $type;
            $data1['animal_id'] = '';
            $data1['amount'] = $real_balance_consume;
            $data1['status'] = 'Dr';
            $data1['wallet_type'] = '1';
            $data1['date'] = date('Y-m-d h:i:s');
            $this->api_model->submit('livestoc_wallets',$data1);
        }
        $data['admin_id'] = $admin_id;
        $data['package_id'] = $id;
        $data['log_id'] = $log_id;
        $data['package_price'] = $package_price;
        $data['package_qty'] = $qty;
        $data['rest_qty'] = $qty;
        $data['created_date'] = date('Y-m-d');
        $this->api_model->submit('admin_package_log', $data);
        $json['success'] = true;
        $json['msg'] = 'You have successfully purchased the package. Thanks ';
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    // public function get_user_refcode(){
    //     $users_id =  $this->input->get_post('users_id');
    //     if($data = $this->api_model->get_data('users_id = '.$users_id.'','users','','referal_code')){
    //         $json['success'] = true;
    //         $json['msg'] = 'You have successfully purchased the package. Thanks ';
    //         $json['ref_msg'] = 'You have successfully purchased the package. Thanks ';
    //         $json['data'] = $data['0']['referal_code'];
    //     }
    //     header('Content-Type: application/json');
    //     echo json_encode($json);
    //     exit;
    // }
    public function get_user_refcode(){
        $users_id =  $this->input->get_post('users_id');
        if($data = $this->api_model->get_data('users_id = '.$users_id.'','users','','referal_code')){
            $json['success'] = true;
            $json['msg'] = 'Refer and Earn Rs 25';
            $json['ref_msg'] = 'Refer and Earn Rs 25';
            $json['data'] = $data['0']['referal_code'];
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    
}