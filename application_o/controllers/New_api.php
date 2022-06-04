<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class New_api extends CI_Controller {
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
		// $this->load->view('admin/layouts/admin_nav');
		// $this->load->view('admin/layouts/admin_header');
		// $this->load->view('admin/chat');
		// $this->load->view('admin/layouts/admin_footer');
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
		//print_r($data);
		//echo "this is test";
	}
	public function get_referal_valid(){
		$referral_code = $this->input->get_post('referral_code');
		if($this->api_model->get_data('refral_code ="'.$referral_code.'"','doctor')){
			$json['success']  = true; 
		}else{
			$json['success']  = false; 
			$json['error'] = "Please Enter Valid Referral Code";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_admin_user(){
		$admin_id = $this->input->get_post('admin_id');
				$data = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'users');
				$res = $data;
				$detail = [];
				foreach($data as $r){
					$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
					$end_data = date('Y-m-d');
					if($this->api_model->get_data('users_id = "'.$r['users_id'].'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
						$r['is_premium'] = '1';
					}else{
						$r['is_premium'] = '0';
					}
					$r['users_id'] = $r['users_id'];
					$r['full_name'] = $r['full_name'];
					$r['mobile'] = $r['mobile'];
					$r['image'] = IMAGE_PATH.'uploads_new/profile/thumb/'.$r['image'];
					$r['address'] = $r['address'];
					$r['no_count'] = $r['no_count'];
					$animal_count = $this->api_model->get_animal_count_user($r['users_id']);
					$r['animal_count'] = $animal_count[0]['count'];
					$detail[] = $r;
				}
				if(!empty($detail)){
					$json['success']  = true; 
					$json['data'] = $detail;
				}else{
					$json['success']  = false; 
					$json['error'] = "NO Data Found";
				}
				header('Content-Type: application/json');
				echo json_encode($json);
				exit;
	}
	public function get_animal_admin(){
		$admin_id = $this->input->get_post('admin_id');
		$cat_id = $this->input->get_post('cat_id');
		$gendor = $this->input->get_post('gender');
		$breed_id = $this->input->get_post('breed_id');
		$where = '';
        if($cat_id != ''){
            $where .= 'AND category_id IN ('.$cat_id.')';
        }if($gendor!=''){
            $where .= ' AND gender like "'.$gendor.'"';
        }if($breed_id != ''){
            $where .= 'AND breed_id = "'.$breed_id.'"';
        }
		$data = $this->api_model->get_data('admin_id = "'.$admin_id.'" '.$where.'', 'animals');
		$deat = [];
					foreach($data as $de){
						$img = $this->api_model->get_animal_image($de['animal_id']);
						$breed = $this->api_model->get_breed($de['breed_id']);
						$category = $this->api_model->get_category($de['category_id']);
						$videos = $this->api_model->get_animal_videos($de['animal_id']);
						//print_r()
						$ani = [];
						$i=0;
						foreach($videos as $vid){
							$url = 'https://www.livestoc.com/uploads_new/animals/video/'.$vid['videos'];
							$h = get_headers($url);
							$status = array();
							preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
							if($status[1]==200){
								$ani[$i] = $url;
							}else{
								$ani[0] = [];
							}
							$i++;
						}
						$de['animals_video'] = $ani;
						$imm= [];
						foreach($img as $im){
							$url = base_url().'uploads/animal/'.$im['images'];
							$h = get_headers($url);
							$status = array();
							preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
							if($status[1]==200){
								$imm['images'][] = $url;
							}else{
								$imm['images'][] = [];
							}
							//$imm['images'][] = base_url().'uploads/animal/'.$image;
						}
						$de['breed_name'] = $breed[0]['breed_name'];
						$de['category_name'] = $category[0]['category'];
						if(empty($imm)){
							$imm['images'] = [];
						}
						$de['images'] = $imm;
						$deat[] = $de;
					}
			if(empty($deat)){
				$json['success']  = false; 
				$json['error'] = 'No Data Found';
			}else{
				$json['success']  = true; 
				$json['data'] = $deat;
			}
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;	
	}
	public function sub_distributor_deactive(){
		$admin_id = $this->input->get_post('admin_id');
		$super_admin_id = $this->input->get_post('super_admin_id');
		$type = $this->input->get_post('type');
		if($type == '0'){
			$ad_count = $this->api_model->get_data('admin_id = "'.$admin_id.'" AND super_admin_id = "'.$super_admin_id.'" AND rest_qty <> 0', 'admin_package_log', '', '*');
			foreach($ad_count as $ad){
				$data['admin_id'] = $ad['super_admin_id'];
				$data['super_admin_id'] = '0';
				$data['pack_log_id'] = $ad['id'];
				$data['package_id'] = $ad['package_id'];
				$data['package_price'] = $ad['package_price'];
				$data['package_qty'] = $ad['package_qty'];
				$data['rest_qty'] = $ad['rest_qty'];
				$data['created_date'] = date('Y-m-d');
				$this->api_model->submit('admin_package_log', $data);
				$st_update['rest_qty'] = 0;
				$this->api_model->update('id', $ad['id'], 'admin_package_log', $st_update);
			}
			$update['isactivated'] = '0';
			$this->api_model->update('admin_id', $admin_id, 'admin', $update);
			$json['success']  = TRUE; 
			$json['msg'] = 'Deactivated successfully';
		}else{
			$update['isactivated'] = '1';
			$this->api_model->update('admin_id', $admin_id, 'admin', $update);
			$json['success']  = TRUE; 
			$json['msg'] = 'Activated successfully';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function get_transfer_history(){
		$admin_id = $this->input->get_post('admin_id');
		$type = $this->input->get_post('type');
		if($type == '39'){
			$ad_count = $this->api_model->get_data('super_admin_id = "'.$admin_id.'"', 'admin_package_log', 'id DESC', 'admin_id, (select fname from admin where admin.admin_id = admin_package_log.admin_id) as admin_name, CONCAT("'.base_url('uploads/bank').'", (select image from admin where admin.admin_id = admin_package_log.admin_id)) as image, package_id, package_price, package_qty, rest_qty, created_date');
		}
		if($type == '40'){
			$ad_count = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'admin_package_log', 'id DESC', 'super_admin_id as admin_id, (select fname from admin where admin.admin_id = admin_package_log.super_admin_id) as admin_name, CONCAT("'.base_url('uploads/bank').'", (select image from admin where admin.admin_id = admin_package_log.super_admin_id)) as image, package_id, package_price, package_qty, rest_qty, created_date');
		}
		if(!empty($ad_count)){
			$json['success']  = TRUE; 
			$json['data'] = $ad_count;
		}else{
			$json['success']  = false; 
			$json['error'] = "No Data Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function transfer_retialer_ids(){
		$admin_id = $this->input->get_post('admin_id');
		$super_admin_id = $this->input->get_post('super_admin_id');
		$qty = $this->input->get_post('qty');
		$ad_count = $this->api_model->get_data('admin_id = "'.$super_admin_id.'"', 'admin_package_log', '', 'sum(rest_qty) as count');
		if($ad_count[0]['count'] > 0){
			if($ad_count[0]['count'] >= $qty){
				$stock = $this->api_model->get_data('admin_id = "'.$super_admin_id.'" AND rest_qty <> 0', 'admin_package_log', '', '*');
				foreach($stock as $st){
					if($qty == 0){
						break;
					}else{
						if($st['rest_qty'] >= $qty){
							$updata['rest_qty'] =$st['rest_qty'] - $qty;
							$this->api_model->update('id', $st['id'], 'admin_package_log', $updata);
							$update_data['pack_log_id'] = $st['id'];
							$update_data['admin_id'] = $admin_id;
							$update_data['super_admin_id'] = $super_admin_id;
							$update_data['package_price'] =  $st['package_price'];
							$update_data['package_qty'] = $qty;
							$update_data['rest_qty'] = $qty;
							$update_data['created_date'] = date('Y-m-d');
							$this->api_model->submit('admin_package_log', $update_data);
							$qty = $st['rest_qty'] - $qty;
						}else{
							$updata['rest_qty'] = 0;
							$this->api_model->update('id', $st['id'], 'admin_package_log', $updata);
							$update_data['pack_log_id'] = $st['id'];
							$update_data['admin_id'] = $admin_id;
							$update_data['super_admin_id'] = $super_admin_id;
							$update_data['package_price'] =  $st['package_price'];
							$update_data['package_qty'] = $qty - $st['rest_qty'];
							$update_data['rest_qty'] = $qty - $st['rest_qty'];
							$update_data['created_date'] = date('Y-m-d');
							$this->api_model->submit('admin_package_log', $update_data);
							$qty = $qty - $st['rest_qty'];
						}
					}
				}
				$json['success']  = TRUE; 
				$json['msg'] = "Successfully Done";
			}else{
				$json['success']  = false; 
				$json['error'] = "Please Send ID";
			}
		}else{
			$json['success']  = false; 
			$json['error'] = "Please Send ID";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function get_admin_package(){
		$data = $this->api_model->get_data('isactive="1"','admin_package','','id, package_name, mrp, discount, cast((mrp - (mrp * (discount /100))) as decimal(10,2)) as sale_price, retailer_qty, decription, isactive');
		$json['success'] = true;
		$json['data'] = $data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function retialer_version() {
		$json = array(
				'version' => RETAILER_VERSION,
				'force_update' => RETAILER_FORCE,
				'notes' => ''
		);
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function check_activate_status_retailer(){
		$admin_id = $this->input->get_post('admin_id');
		$user_type = $this->input->get_post('user_type');
		if(!isset($admin_id) || $admin_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send ID";
		}else{
			$admin_data = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'admin', '', 'isactivated');
			$json['success'] = true;
			$json['data'] = $admin_data[0];
			if($user_type == 39){
				$sub_distributor_data = $this->api_model->get_data('super_admin_id = "'.$admin_id.'" AND user_type = "40"', 'admin', '', 'count(admin_id) as count');
				$retailer_count = $this->api_model->get_data('super_admin_id = "'.$admin_id.'" AND user_type = "41"', 'admin', '', 'count(admin_id) as count');
				$id_count = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'admin_package_log', '', 'sum(rest_qty) as count');
				$json['data']['count']['sub_distributor_count'] = $sub_distributor_data[0]['count'];
				$json['data']['count']['retailer_count'] = $retailer_count[0]['count'];
				$json['data']['count']['id_count'] = $id_count[0]['count'];
				$json['data']['count']['users_count'] = 0;
				$json['data']['count']['animal_count'] = 0;
			}else if($user_type == 40){
				$retailer_count = $this->api_model->get_data('super_admin_id = "'.$admin_id.'" AND user_type = "41"', 'admin', '', 'count(admin_id) as count');
				$id_count = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'admin_package_log', '', 'sum(rest_qty) as count');
				$json['data']['count']['sub_distributor_count'] = 0;
				$json['data']['count']['retailer_count'] = $retailer_count[0]['count'];
				$json['data']['count']['id_count'] = $id_count[0]['count'];
				$json['data']['count']['users_count'] = 0;
				$json['data']['count']['animal_count'] = 0;
			}else{
				$users_count = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'users', '', 'count(users_id) as count');
				$animal_count = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'animals', '', 'count(animal_id) as count');
				$json['data']['count']['sub_distributor_count'] = 0;
				$json['data']['count']['retailer_count'] = 0;
				$json['data']['count']['id_count'] = 0;
				$json['data']['count']['users_count'] = $users_count[0]['count'];
				$json['data']['count']['animal_count'] = $animal_count[0]['count'];
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function get_company_type(){
		$data = $this->api_model->get_data('isactive = "1"','company_type');
		//print_r($data);
		if(!empty($data)){
			$json  = $data; 
		}else{
			$json['success']  = false; 
			$json['error']  = 'No data found'; 
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;		
	}
	public function get_json_dashboard(){
		$section_id = $this->input->get_post('category_id');
		if($section_id == ''){
			$section_id  = '0';
		}
		$data = $this->api_model->get_data('section_id = "'.$section_id.'"','test_crone','','value');
		if(!empty($data)){
			$json  = $data[0]['value']; 
		}else{
			$json['success']  = false; 
			$json['error']  = 'No data found'; 
		}
		header('Content-Type: application/json');
		echo stripslashes($json);
		exit;		
	}
	public function product_invoice($id){
		$data['data'] = $this->api_model->get_data('id = '.$id.'', 'product_order');
		//print_r($data);
		$this->load->view('admin/product_invoice', $data);
	}
	public function delivery_partner_offline_payment(){
		$orders_ids = $this->input->get_post('orders_ids');
		$amount = $this->input->get_post('amount');
		$admin_id = $this->input->get_post('admin_id');
		$bank_slip =$this->input->get_post('bank_slip');
		$transection_id = $this->input->get_post('transection_id');
		$data['users_id'] = $admin_id;
		$data['currency'] = 'INR';
		$data['type'] = '38';
		$data['amount'] = $amount;
		$data['user_type'] = '3';
		$data['payment_type'] = 'Dr';
		$data['request_status'] = '2';
		$data['bank_slip'] = $bank_slip;
		$data['date'] = date('Y-m-d h:i:s');
		$last_log_id = $this->api_model->submit('log_file', $data);
		$orders_ids = json_decode($orders_ids);
		foreach($orders_ids as $id){
			$updata['order_payment_status'] = '4';
			$this->api_model->update('id', $id, 'product_order', $updata);
			$date = date('Y-m-d h:i:s');
			$order = $this->api_model->get_data('id = '.$id.'','product_order');
			$amount1 = $order[0]['package_price'];
			$update1['admin_id'] = $admin_id;
			$update1['order_id'] = $id;
			$update1['log_id'] = $last_log_id;
			$update1['transaction_id'] = $transection_id;
			$update1['amount'] = $amount1;
			$update1['payment_type'] = 'Dr';
			$update1['type'] = '2';
			$update1['date'] = date('Y-m-d h:i:s');
			$this->api_model->submit('delivery_partner_account', $update1);
		}
		$json['success'] = True;
		$json['msg'] = 'Your Request has been submitted and it will take time to reflect in your account';
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function order_payment_status_delivery(){
		$id = $this->input->get_post('order_id');
		$admin_id = $this->input->get_post('admin_id');
		$data['order_payment_status'] = '1';
		if($this->api_model->get_data_update('id = '.$id.' AND delivery_partner = "'.$admin_id.'"', 'product_order', $data)){
			$json['success']  = True;  
		}else{
			$json['success']  = false; 
			$json['error']  = 'Database Error'; 
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function update_dashboard(){
		$data = $this->api_model->get_data('','test_crone', '','section_id');
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
			$this->api_model->update('section_id',$da['section_id'],'test_crone', $dat);
		}
	}
	public function order_tarnsfer(){
		$order_id = $this->input->get_post('order_id');
		$admin_id = $this->input->get_post('d_id');
		$data['delivery_partner'] = $admin_id;
		if($this->api_model->update('id', $order_id, 'product_order', $data)){
			$json['success'] = true;
			$json['msg'] = "Your Order has been successfully assigned.";
		}else{
			$json['success'] = false;
			$json['msg'] = "Database Error.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function order_payment_status(){
		$order_id = $this->input->get_post('order_id');
		if($order = $this->api_model->get_data('id = '.$order_id.'', 'product_order')){
			if($order[0]['order_payment_status'] == '0'){
				$json['success'] = true;
				$json['flag'] = 0;
			}else{
				$json['success'] = true;
				$json['flag'] = $order[0]['order_payment_status'];
			}
		}else{
			$json['success'] = false;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function send_ecom_order_sms($order_id){
		$data = $this->api_model->get_data('id = "'.$order_id.'"' , 'product_order', '', '*');
		$user = $this->api_model->get_data('users_id = "'.$data[0]['users_id'].'"', 'users','','*');
		//print_r($user);
		//exit;
		//$request = $this->api_model->get_data('id = "'.$data[0]['request_id'].'"', 'vt_requests','','*');
		//print_r($user[0]['mobile']);
		$sms_template = urlencode('ECOMREQUEST');
		$vars = array('var1'=>$data[0]['otp']);
		$mobile = $user[0]['mobile'];
		$curl = curl_init();

		$url = "https://2factor.in/API/R1/?module=TRANS_SMS&apikey=85aab6cd-b267-11e7-94da-0200cd936042&to=$mobile&from=LIVEST&templatename=$sms_template";
		foreach($vars as $key=>$var){
		$url .=	"&".$key."=".urlencode($var);
		}
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        ));

		
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

		
        if ($err) {
		$json['success'] = false;
		$json['error'] = $err;
        } else {
		 	//echo  $response;
			$json['success'] = true;
			$json['msg'] = "OTP is sent to  Farmer's Number. Please enter the OTP.";
		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function get_hub_order(){
		$admin_id = $this->input->get_post('admin_id');
		$name = $this->input->get_post('name');
		$perpage = $this->input->get_post('perpage');
		$start = $this->input->get_post('start');
		$data = $this->api_model->get_data('admin_id = '.$admin_id.'','admin');
		if($data[0]['type'] == '30'){
			$where = "where p.hub = '".$admin_id."'";
			$detail = $this->api_model->query_build("select DISTINCT po.id, pp.name as package_name,(select full_name from users where users_id = po.users_id) as user_name, (select mobile from users where users_id = po.users_id) as user_mobile, (select address from users where users_id = po.users_id) as user_address, po.product_qty, po.package_id, po.package_price, po.date, po.isactive, p.user, p.name, p.images from product_order as po left join product as p on p.id = po.product_id left join product_package pp on po.package_id = pp.id ".$where." LIMIT ".$perpage." OFFSET ".$start."");
			$count = $this->api_model->query_build('select count(po.id) as count from product_order as po left join product as p on p.id = po.product_id '.$where.'');
		}
		if($data[0]['type'] == '31'){
			$where = "where p.hubemp = '".$admin_id."'";
			$detail = $this->api_model->query_build("select DISTINCT po.id, pp.name as package_name,(select full_name from users where users_id = po.users_id) as user_name, (select mobile from users where users_id = po.users_id) as user_mobile, (select address from users where users_id = po.users_id) as user_address, po.product_qty, po.package_id, po.package_price, po.date, po.isactive, p.user, p.name, p.images from product_order as po left join product as p on p.id = po.product_id left join product_package pp on po.package_id = pp.id ".$where." LIMIT ".$perpage." OFFSET ".$start."");
			$count = $this->api_model->query_build('select count(po.id) as count from product_order as po left join product as p on p.id = po.product_id '.$where.'');
		}
		if(empty($detail)){
			$json['success']  = False; 
			$json['error'] = 'No Data Found';
		}else{
			$deta = [];
			$i = 0;
			foreach($detail as $de){
				$image = explode(',',$de['images']);
				$deta[$i] = $de; 
				$deta[$i]['images'] = base_url().'/uploads/product/'.$image[0];
				$i++;
			}
			$json['success']  = True; 
			$json['data'] = $deta;
			$json['count'] = $count[0]['count'];
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function transfer_delevery_partner(){
		$id = $this->input->get_post('id');
		$admin_id = $this->input->get_post('admin_id');
		$status = $this->input->get_post('status');
		print_r($_REQUEST);
	}
	public function get_hub_product(){
		$admin_id = $this->input->get_post('admin_id');
		$name = $this->input->get_post('name');
		$perpage = $this->input->get_post('perpage');
		$start = $this->input->get_post('start');
		$data = $this->api_model->get_data('admin_id = '.$admin_id.'','admin');
		if($data[0]['type'] == '30'){
			$detail = $this->api_model->query_build('select pro.id, pro.name, pro.brand, pc.cat_name as product_cat, pro.images, pro.shor_desc,  pro.hight, pro.width, pro.sku, pro.isactive from product as pro, product_category as pc where pro.category = pc.id AND pro.hub="'.$admin_id.'" AND pro.name like "%'.$name.'%" LIMIT '.$perpage.' OFFSET '.$start.'');
			$count = $this->api_model->query_build('select count(*) as count from product as pro, product_category as pc where pro.category = pc.id AND pro.hub="'.$admin_id.'" AND pro.name like "%'.$name.'%"');
		}
		if($data[0]['type'] == '31'){
			$detail = $this->api_model->query_build('select pro.id, pro.name, pro.brand, pc.cat_name as product_cat, pro.images, pro.shor_desc,  pro.hight, pro.width, pro.sku, pro.isactive from product as pro, product_category as pc where pro.category = pc.id AND pro.hubemp="'.$admin_id.'" AND pro.name like "%'.$name.'%" LIMIT '.$perpage.' OFFSET '.$start.'');
			$count = $this->api_model->query_build('select count(*) as count from product as pro, product_category as pc where pro.category = pc.id AND pro.hubemp="'.$admin_id.'" AND pro.name like "%'.$name.'%"');
		}
		if(empty($detail)){
			$json['success']  = False; 
			$json['error'] = 'No Data Found';
		}else{
			$deta = [];
			$i = 0;
			foreach($detail as $de){
				$image = explode(',',$de['images']);
				$deta[$i] = $de; 
				$deta[$i]['images'] = base_url().'/uploads/product/'.$image[0];
				$i++;
			}
			$json['success']  = True; 
			$json['data'] = $deta;
			$json['count'] = $count[0]['count'];
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_animal_status(){
		$data = $this->api_model->get_data('isactive = "1"','animal_status','','id, name');
		$json['success']  = True;
		$json['data'] = $data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function dealer_accept(){
		$id = $this->input->get_post('id');
		$dealer_id = $this->input->get_post('dealer_id');
		if($id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Order ID';
		}else if($dealer_id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Dealer ID';
		}else{
			$data['distributor_id'] = $dealer_id;
			$data['isactive'] = '1';
			$orders= $this->api_model->get_data('FIND_IN_SET('. $dealer_id.', distributor_id) AND id = '.$id.'', 'product_order');
			// print_r($orders);
			//exit;
			if(!empty($orders)){
				if($this->api_model->update('id', $id, 'product_order', $data)){
					$json['success']  = True; 
					$json['msg'] = "Your order has been successfully Accepted";
				}else{
					$json['success']  = false; 
					$json['error'] = "Database error";
				}
			}else{
				$json['success']  = false; 
				$json['error'] = "Allready accepted by other Dealer";	
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_dealer_order($id){
		$id = $this->input->get_post('id');
		if($id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send User ID';
		}else{
				$where = '';
				$order = 'order by id DESC';
				$status = $this->input->get_post('status');
				if($status != ''){
						$where = 'AND pro.isactive = "'.$status.'"';
				}else{
					$where = 'AND pro.isactive <> "0" AND pro.isactive <> "5"';
				}
				$start = $this->input->get_post('start');
				$perpage = '10';
				if($start != ''){
					$limit = 'LIMIT '.$start.', '.$perpage.'';
				}
				if($latitude != ''){
					$select = ' IFNULL(( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( pro.latitude ) ) * cos( radians( pro.longitude ) - radians ('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( pro.latitude ) ) ) ),0) AS distance';
					$order = 'ORDER BY distance';
				}
				$admin_data = $this->api_model->get_data('admin_id = "'.$id.'"', 'admin');
				if($admin_data[0]['type'] != '18'){
					if($order = $this->api_model->query_build('SELECT `id`, `product_qty`, `date` as `order_date`, delivery_partner_status, schedul_date, '.$select.' CONCAT("'.base_url().'new_api/product_invoice/", id) as invoice, order_type, delivery_partner, CONCAT("https://www.amazebrandlance.com/uploads/delevery_partner/",(select image from admin where admin_id = pro.delivery_partner)) as d_image, (select fname from admin where admin_id = pro.delivery_partner) as d_name, (select mobile from admin where admin_id = pro.delivery_partner) as d_mobile, (select fullname from address_mst where address_id = pro.address_id) as user_name, (select address1 from address_mst where address_id = pro.address_id) as user_address1, pro.latitude  as user_latitude, pro.longitude as user_longitude, (select address2 from address_mst where address_id = pro.address_id) as user_address2, (select city from address_mst where address_id = pro.address_id) as user_city, (select district from address_mst where address_id = pro.address_id) as user_district, (select postal_code from address_mst where address_id = pro.address_id) as user_postal_code, (select address_type from address_mst where address_id = pro.address_id) as user_address_type, (select mobile from address_mst where address_id = pro.address_id) as user_mobile, `isactive` as `order_status`, (select name from product where id = product_id) as product_name, (select brand from product where id = product_id) as product_brand, (select images from product where id = product_id) as product_image, (select sku from product where id = product_id) as product_sku, (select shor_desc from product where id = product_id) as product_shor_desc, (select long_desc from product where id = product_id) as product_long_desc, (select other_desc from product where id = product_id) as product_other_desc, (select discount from product where id = product_id) as product_discount, `product_qty`, `package_price`, (select name from product_package where id = package_id) as package_name FROM `product_order` as `pro` WHERE FIND_IN_SET('.$id.', distributor_id) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.' '.$order.' '.$limit.'')){
						$count = $this->api_model->query_build('SELECT count(id) as count FROM `product_order` as `pro` WHERE FIND_IN_SET('.$id.', distributor_id) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.'');
						$detail = [];
						$i = 0;
						foreach($order as $or){
							$image = explode(',',$or['product_image']);
							$detail[$i] = $or; 
							$detail[$i]['product_image'] = base_url().'/uploads/product/'.$image[0];
							$i++;
						}
						$json['success']  = True; 
						$json['data'] = $detail;
						$json['count'] = $count[0]['count'];
					}else{
						$json['success']  = False; 
						$json['error'] = 'Currently , your order list is empty';
					}
				}else{
					if($order = $this->api_model->query_build('select id, product_qty, date as order_date, order_type, delivery_partner_status, schedul_date, delivery_partner, CONCAT("'.base_url().'new_api/product_invoice/", id) as invoice, CONCAT("https://www.amazebrandlance.com/uploads/delevery_partner/",(select image from admin where admin_id = pro.delivery_partner)) as d_image, (select fname from admin where admin_id = pro.delivery_partner) as d_name, (select mobile from admin where admin_id = pro.delivery_partner) as d_mobile, (select fullname from address_mst where address_id = pro.address_id) as user_name, (select address1 from address_mst where address_id = pro.address_id) as user_address1,  (select address2 from address_mst where address_id = pro.address_id) as user_address2,pro.latitude as user_latitude, pro.longitude as user_longitude, (select city from address_mst where address_id = pro.address_id) as user_city, (select district from address_mst where address_id = pro.address_id) as user_district, (select images from product where id = product_id) as product_image, (select postal_code from address_mst where address_id = pro.address_id) as user_postal_code, (select address_type from address_mst where address_id = pro.address_id) as user_address_type, (select mobile from address_mst where address_id = pro.address_id) as user_mobile, isactive as order_status, (select name from product where id = product_id) as product_name, (select brand from product where id = product_id) as product_brand, (select sku from product where id = product_id) as product_sku, (select shor_desc from product where id = product_id) as product_shor_desc, (select long_desc from product where id = product_id) as product_long_desc, (select other_desc from product where id = product_id) as product_other_desc, (select discount from product where id = product_id) as product_discount, product_qty, package_price, (select name from product_package where id = package_id) as package_name from product_order as pro where FIND_IN_SET(pro.product_id ,(select GROUP_CONCAT(pd.id) from product as pd where pd.user = '.$id.')) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.' '.$limit.'')){
						$count = $this->api_model->query_build('select count(id) as count from product_order as pro where FIND_IN_SET(pro.product_id ,(select GROUP_CONCAT(pd.id) from product as pd where pd.user = '.$id.')) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.' order by id DESC ');
						$detail = [];
						$i = 0;
						foreach($order as $or){
							$image = explode(',',$or['product_image']);
							$detail[$i] = $or; 
							$detail[$i]['product_image'] = base_url().'/uploads/product/'.$image[0];
							$i++;
						}
						$json['success']  = True; 
						$json['data'] = $detail;
						$json['count'] = $count[0]['count'];
					}else{
						$json['success']  = False; 
						$json['error'] = 'Currently , your order list is empty';
					}
				}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function dilivery_partner_accept(){
		$id = $this->input->get_post('id');
		$dilivery_partner_id = $this->input->get_post('dilivery_partner_id');
		if($id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Order ID';
		}else if($dilivery_partner_id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Delivery Partner ID';
		}else{
			$data['delivery_partner'] = $dilivery_partner_id;
			$schedul_date = date('Y-m-d', strtotime(date('Y-m-d'). ' +1 day'));
			$data['schedul_date'] = $schedul_date; 
			$data['isactive'] = '1';
			$orders= $this->api_model->get_data('FIND_IN_SET('. $dilivery_partner_id.', delivery_partner) AND id = '.$id.'', 'product_order');
			// print_r($orders);
			//exit;
			if(!empty($orders)){
				//$data['date'] = date('Y-m-d H:i:s'); 
				if($this->api_model->update('id', $id, 'product_order', $data)){
					$json['success']  = True; 
					$json['msg'] = "Your order has been successfully Accepted";
				}else{
					$json['success']  = false; 
					$json['error'] = "Database error";
				}
			}else{
				$json['success']  = false; 
				$json['error'] = "Allready accepted by other Dealer";	
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function delivery_reshdule(){
		$id = $this->input->get_post('id');
		$dilivery_partner_id = $this->input->get_post('dilivery_partner_id');
		$date = $this->input->get_post('date');
		if($id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Order ID';
		}else if($dilivery_partner_id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Delivery Partner ID';
		}else{
			$data['schedul_date'] = $date; 
				if($this->api_model->update('id', $id, 'product_order', $data)){
					$json['success']  = True; 
					$json['msg'] = "Your order has been successfully rescheduled";
				}else{
					$json['success']  = false; 
					$json['error'] = "Database error";
				}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_delivery_report_delivery_partner(){
		$id =$this->input->get_post('id');	
		$to_date = $this->input->get_post('to_date');
		$from_date = $this->input->get_post('from_date');
		$cod = $this->input->get_post('cod');
		$insentive = $this->input->get_post('insentive');
		$ispaid = $this->input->get_post('ispaid');
		$date = '';
		if($insentive != ''){
			if($to_date != '' && $from_date !=''){
				$to_date = date("Y-m-d", strtotime("1 day",  strtotime($to_date)));
				$date = 'AND update_date BETWEEN "'.$from_date.'" AND "'.$to_date.'" ';
			}else if($from_date != ''){
				$to_date = date("Y-m-d", strtotime("1 day",  strtotime($from_date))); 
				$date = 'AND update_date BETWEEN "'.$from_date.'" AND "'.$to_date.'" ';
			}
			if($ispaid != ''){
				$date .= 'AND delivery_partner_insentive_payment_status = "'.$ispaid.'" ';
			}
			$date .= "AND isactive IN('5','7')";
			$data = $this->api_model->query_build("select id, ((select insentive from admin where admin_id = ".$id.")) as total_amount, (select name from product where id = product_id) as product_name, delivery_partner_insentive_payment_status, package_price, update_date from product_order where  distance_covered  IS NOT NULL AND delivery_partner = ".$id." ".$date."");
		}else if($cod == ''){
			if($to_date != '' && $from_date !=''){
				$to_date = date("Y-m-d", strtotime("1 day",  strtotime($to_date)));
				$date = 'AND update_date BETWEEN "'.$from_date.'" AND "'.$to_date.'" ';
			}else if($from_date != ''){
				$to_date = date("Y-m-d", strtotime("1 day",  strtotime($from_date))); 
				$date = 'AND update_date BETWEEN "'.$from_date.'" AND "'.$to_date.'" ';
			}
			if($ispaid != ''){
				$date .= 'AND delivery_partner_payment_status = "'.$ispaid.'" ';
			}
			$date .= "AND isactive IN('5','7')";
			$data = $this->api_model->query_build("select id, (select name from product where id = product_id) as product_name, distance_covered, (distance_covered * (select per_km from admin where admin_id = ".$id.")) as total_amount, delivery_partner_payment_status, package_price, update_date from product_order where  distance_covered  IS NOT NULL AND delivery_partner = ".$id." ".$date."");
		}else{
			$date = "AND order_type = '0' AND order_payment_status = '1' AND isactive = '5' ";
			$data = $this->api_model->query_build("select id, (select name from product where id = product_id) as product_name, distance_covered, (package_price) as total_amount, delivery_partner_payment_status, update_date from product_order where  distance_covered  IS NOT NULL AND delivery_partner = ".$id." ".$date."");
		}
		if(!empty($data)){
			if($insentive != ''){
				$total_insentive = $this->api_model->query_build("select (count(id) * (select insentive from admin where admin_id = ".$id.")) as total_insentive  from product_order where isactive = '5' AND delivery_partner = ".$id." ".$date." AND delivery_partner_insentive_payment_status = '0'");
				$json['total_insentive'] = $total_insentive[0]['total_insentive'];
			}else if($cod == ''){
			$total = $this->api_model->query_build("select sum(distance_covered) as total_km, (sum(distance_covered) * (select per_km from admin where admin_id = ".$id.")) as total_amount  from product_order where isactive IN('5') AND order_payment_status <> '0' AND delivery_partner_payment_status = '0' AND delivery_partner = ".$id." AND distance_covered  IS NOT NULL ".$date."");
			$total_insentive = $this->api_model->query_build("select (count(id) * (select insentive from admin where admin_id = ".$id.")) as total_insentive  from product_order where isactive = '5' AND delivery_partner = ".$id." ".$date."");
			//$json['total_insentive'] = $total_insentive[0]['total_insentive'];
			$json['total_km'] = $total[0]['total_km'];
			}else{
				$total = $this->api_model->query_build("select (sum(package_price)) as total_amount  from product_order where delivery_partner = ".$id." AND distance_covered  IS NOT NULL ".$date."");
			}
			$json['success']  = True; 
			$json['data'] = $data;
			$json['total_amount'] = $total[0]['total_amount'];
		}else{
			$json['success']  = false;
			if($cod != ''){
				$json['error'] = 'Your outstanding amount is 0.';
			}else{
				$json['error'] = 'You have not delivered any product till now';
			}
			
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_delivery_total(){
		$id =$this->input->get_post('id');
		$total = $this->api_model->query_build("select if(sum(distance_covered) IS NOT NULL, sum(distance_covered), 0) as total_km, if((sum(distance_covered) * (select per_km from admin where admin_id = ".$id.")) IS NOT NULL, (sum(distance_covered) * (select per_km from admin where admin_id = ".$id.")), 0) as total_amount  from product_order where isactive IN('5','7') AND delivery_partner = ".$id." AND distance_covered  IS NOT NULL ");
		$total_insentive = $this->api_model->query_build("select if((count(id) * (select insentive from admin where admin_id = ".$id.")) IS NOT NULL,(count(id) * (select insentive from admin where admin_id = ".$id.")), 0) as total_insentive  from product_order where isactive = '5' AND delivery_partner = ".$id."");
		$json['success']  = True;
		$json['total_km'] = $total[0]['total_km'];
		$json['total_amount'] = $total[0]['total_amount'];
		$json['total_insentive'] = $total_insentive[0]['total_insentive'];
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	//public function 
	public function get_delivery_order($id){
		$id = $this->input->get_post('id');
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');
		$date = $this->input->get_post('date');
		if($id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send User ID';
		}else{
				$where = '';
				$status = $this->input->get_post('status');
				$order = 'order by id DESC';
				if($status != ''){
						$where .= 'AND pro.isactive = "'.$status.'"';
				}else{
					$where .= 'AND pro.isactive NOT IN ("0","4","5")';
					//$where .= 'AND pro.isactive <> "0"';
				}
				$start = $this->input->get_post('start');
				$perpage = '10';
				if($start != ''){
					$limit = 'LIMIT '.$start.', '.$perpage.'';
				}
				if($date != ''){
					$where .= ' AND schedul_date = "'.$date.'"';
				}
				if($latitude != ''){
					//$select = ' IFNULL(( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( pro.latitude ) ) * cos( radians( pro.longitude ) - radians ('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( pro.latitude ) ) ) ),0) AS distance,';
					$select = "((((acos(sin((".$latitude."*pi()/180)) * sin((pro.latitude*pi()/180)) + cos((".$latitude."*pi()/180)) * cos((pro.latitude*pi()/180)) * cos(((".$longitude."- pro.longitude)*pi()/180)))) * 180/pi()) * 60 * 1.1515) * 1.60934)  AS distance, ";
					$order = 'ORDER BY distance';
				}
				$admin_data = $this->api_model->get_data('admin_id = "'.$id.'"', 'admin');
				//print_r($admin_data);
				if($admin_data[0]['type'] != '18'){
					if($order = $this->api_model->query_build('SELECT `id`, `product_qty`, `date` as `order_date`, delivery_partner_status, schedul_date, '.$select.' order_type, CONCAT("'.base_url().'new_api/product_invoice/",id) as invoice, delivery_partner, CONCAT("https://www.amazebrandlance.com/uploads/delevery_partner/",(select image from admin where admin_id = pro.delivery_partner)) as d_image, (select fname from admin where admin_id = pro.delivery_partner) as d_name, (select mobile from admin where admin_id = pro.delivery_partner) as d_mobile, (select fullname from address_mst where address_id =  pro.address_id) as user_name, (select address1 from address_mst where address_id =  pro.address_id) as user_address1,  pro.latitude as user_latitude, pro.longitude as user_longitude, (select address2 from address_mst where address_id = pro.address_id) as user_address2, (select city from address_mst where address_id = pro.address_id) as user_city, (select district from address_mst where address_id = pro.address_id) as user_district,(select start_point_latitude from product_order where id = pro.id) as start_latitude,(select start_point_longitude from product_order where id = pro.id) as start_longitude,(select distance_covered from product_order where id = pro.id) as travelled_distance, (select postal_code from address_mst where address_id = pro.address_id) as user_postal_code, (select address_type from address_mst where address_id = pro.address_id) as user_address_type, (select mobile from address_mst where address_id = pro.address_id) as user_mobile, `isactive` as `order_status`, (select name from product where id = product_id) as product_name, (select brand from product where id = product_id) as product_brand, (select images from product where id = product_id) as product_image, (select sku from product where id = product_id) as product_sku, (select shor_desc from product where id = product_id) as product_shor_desc, (select long_desc from product where id = product_id) as product_long_desc, (select other_desc from product where id = product_id) as product_other_desc, (select discount from product where id = product_id) as product_discount, `product_qty`, `package_price`, (select name from product_package where id = package_id) as package_name FROM `product_order` as `pro` WHERE  FIND_IN_SET('.$id.', delivery_partner) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.' '.$order.' '.$limit.'')){
						$count = $this->api_model->query_build('SELECT count(id) as count FROM `product_order` as `pro` WHERE FIND_IN_SET('.$id.', delivery_partner) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.'');
						$detail = [];
						$i = 0;
						foreach($order as $or){
							$image = explode(',',$or['product_image']);
							$detail[$i] = $or; 
							$detail[$i]['product_image'] = base_url().'/uploads/product/'.$image[0];
							$i++;
						}
						$json['success']  = True; 
						$json['data'] = $detail;
						$json['count'] = $count[0]['count'];
					}else{
						$json['success']  = False; 
						$json['error'] = 'Currently , your order list is empty';
					}
				}else{
					if($order = $this->api_model->query_build('select id, product_qty, date as order_date, order_type, delivery_partner, CONCAT("'.base_url().'new_api/product_invoice/",id) as invoice, CONCAT("https://www.amazebrandlance.com/uploads/delevery_partner/",(select image from admin where admin_id = pro.delivery_partner)) as d_image, (select fname from admin where admin_id = pro.delivery_partner) as d_name, (select mobile from admin where admin_id = pro.delivery_partner) as d_mobile, (select fullname from address_mst where address_id = pro.address_id) as user_name, (select address1 from address_mst where address_id = pro.address_id) as user_address1,  (select address2 from address_mst where address_id = pro.address_id) as user_address2, pro.latitude as user_latitude, pro.longitude as user_longitude, (select city from address_mst where address_id = pro.address_id) as user_city, (select district from address_mst where address_id = pro.address_id) as user_district, (select images from product where id = product_id) as product_image, (select postal_code from address_mst where address_id = pro.address_id) as user_postal_code, (select address_type from address_mst where address_id = pro.address_id) as user_address_type, (select mobile from address_mst where address_id = pro.address_id) as user_mobile, isactive as order_status, (select name from product where id = product_id) as product_name, (select brand from product where id = product_id) as product_brand, (select sku from product where id = product_id) as product_sku, (select shor_desc from product where id = product_id) as product_shor_desc, (select long_desc from product where id = product_id) as product_long_desc, (select other_desc from product where id = product_id) as product_other_desc, (select discount from product where id = product_id) as product_discount, product_qty, package_price, (select name from product_package where id = package_id) as package_name from product_order as pro where FIND_IN_SET(pro.product_id ,(select GROUP_CONCAT(pd.id) from product as pd where pd.user = '.$id.')) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.' '.$limit.'')){
						$count = $this->api_model->query_build('select count(id) as count from product_order as pro where FIND_IN_SET(pro.product_id ,(select GROUP_CONCAT(pd.id) from product as pd where pd.user = '.$id.')) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.' order by id DESC ');
						$detail = [];
						$i = 0;
						foreach($order as $or){
							$image = explode(',',$or['product_image']);
							$detail[$i] = $or; 
							$detail[$i]['product_image'] = base_url().'/uploads/product/'.$image[0];
							$i++;
						}
						$json['success']  = True; 
						$json['data'] = $detail;
						$json['count'] = $count[0]['count'];
					}else{
						$json['success']  = False; 
						$json['error'] = 'Currently , your order list is empty';
					}
				}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function change_order_status(){
		$id = $this->input->get_post('id');
		$status = $this->input->get_post('status');
		$otp = $this->input->get_post('otp');
		$distance_covered = $this->input->get_post('distance_covered');
		$distance_covered = explode(' ', $distance_covered);
		$distance_covered = $distance_covered[0];
		$data['isactive'] = $status;
		if($id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send Id";
		}else if($status == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send Status";
		}else{
			if($status == '5'){
				if($otp != ''){
					$ot = $this->api_model->get_data('id = '.$id.' AND otp = "'.$otp.'"', 'product_order');
					if(!empty($ot)){
						$data['distance_covered'] = $ot[0]['distance_covered'] + $distance_covered;
						$data['delivery_partner_status']='0';
						if($this->api_model->update('id', $id, 'product_order', $data)){
							$json['success']  = True; 
							$json['msg'] = "Your Product Status Updated";
						}else{
							$json['success']  = false; 
							$json['error'] = "Database error";
						}
					}else{
						$json['success']  = false; 
						$json['error'] = "Otp is Mismatched";
					}
				}else{
					$json['success']  = false; 
					$json['error'] = "Please Send OTP";
				}
			}else{
				if($status == '7'){
					$data['delivery_partner_status']='0';
					$data['distance_covered'] = $ot[0]['distance_covered'] + $distance_covered;
				}
				if($this->api_model->update('id', $id, 'product_order', $data)){
					$json['success']  = True; 
					$json['msg'] = "Your Product Status Updated";
				}else{
					$json['success']  = false; 
					$json['error'] = "Database error";
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function order_rejection(){
		$id = $this->input->get_post('id');
		$vendor_id = $this->input->get_post('vendor_id');
		if($id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send Id";
		}else if($vendor_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please vendor Id";
		}else{
			$data['order_id'] = $id;
			$data['vendor_id'] = $vendor_id;
			$data['updated_on'] = date('Y-m-d h:i:s');
			if($this->api_model->submit('product_order_rejection_log', $data)){
				$json['success']  = True; 
				$json['msg'] = "Your Product Order is rejected";
			}else{
				$json['success']  = false; 
				$json['error'] = "Database error";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
 	public function dealer_version() {	
        $json = array(
            'version' => '1',
            'force_update' => 1,
            'notes' => '',
            'doctor_contact_no' =>  '1800 103 1541'
        );        
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function delivery_version() {	
        $json = array(
            'version' => '1',
            'force_update' => 1,
            'notes' => '',
            'doctor_contact_no' =>  '1800 103 1541'
        );        
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function check_dealer_activate_status(){
		$admin_id = $this->input->get_post('admin_id');
		$user_type = $this->input->get_post('user_type');
		if(!isset($admin_id) || $admin_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send ID";
		}else{
			$data = $this->api_model->get_admin_detail($admin_id);
			$count = $this->api_model->athority_count($admin_id, $user_type);
			$detail['isactivated'] = $data[0]['isactivated'];
			$admin_detail = $this->api_model->get_admin_detail($admin_id);
			//print_r($admin_detail);
			if($admin_detail[0]['user_type'] == '1' || $admin_detail[0]['user_type'] == '5'){
				$data = $this->api_model->get_coustomer_pre_count($admin_detail[0]['admin_id']);
			}else if($admin_detail[0]['user_type'] == '3' || $admin_detail[0]['user_type'] == '4' ){
				$d = $this->api_model->get_coustomer_pre_comp_count($admin_detail[0]['admin_id'], $admin_detail[0]['user_type']);
				$data[0]['count'] = $d;
			}else if($admin_detail[0]['user_type'] == '6'){
				$d = $this->api_model->gett_coustomer_dist_pre_count($admin_detail[0]['admin_id']);
				$data[0]['count'] = $d[0]['count'];
			}else if($admin_detail[0]['user_type'] == '2'){
				$d = $this->api_model->gett_coustomer_comp_pre_count($admin_detail[0]['admin_id']);
				$data[0]['count'] = $d[0]['count'];
			}
			$d = $this->api_model->gett_coustomer_order_comp_pre_count($admin_detail[0]['admin_id'], 'LVET');
			$data[0]['count'] = $d[0]['count'];
			$user_count = $this->api_model->get_admin_sub_user($admin_id);
			$count['sub_user_count'] = $user_count[0]['count'];
			$count['coustomer_order'] = $data[0]['count'];
			$ai_count = $this->api_model->gett_coustomer_order_comp_pre_count($admin_detail[0]['admin_id'], 'LPRO');
			$count['ai_order_count'] = $ai_count[0]['count'];
			$detail['count'] = $count;
			$json['success']  = True; 
			$json['data'] = $detail;
		}
		//print_r($data);
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function insert_dealer(){
		$data['email'] = $this->input->get_post('email');
		$data['password'] = $this->input->get_post('password');
		$data['fname'] = $this->input->get_post('fname');
		$data['gst_no'] = $this->input->get_post('gst_no');
		$data['adhar_no'] = $this->input->get_post('adhar_no');
		$data['pan_no'] = $this->input->get_post('pan_no');
		$data['latitude'] = $this->input->get_post('latitude');
		$data['longitude'] = $this->input->get_post('longitude');
		$data['address'] = $this->input->get_post('address');
		$data['fcm_and'] = $this->input->get_post('fcm_and');
		$data['fcm_IOS'] = $this->input->get_post('fcm_IOS');
		$data['adhar_image'] = $this->input->get_post('adhar_image');
		$data['adhar_back_image'] = $this->input->get_post('adhar_back_image');
		$data['state'] = $this->input->get_post('state');
		$data['district'] = $this->input->get_post('district');
		$data['mobile'] = $this->input->get_post('mobile');
		$data['pin'] = $this->input->get_post('pin');
		if($this->api_model->get_data('email = "'.$data['email'].'"', 'admin')){
			$json['success']  = false;
			$json['error'] = 'Email Allready Exists';
		}else{
			if($this->api_model->get_data('mobile = "'.$data['mobile'].'"', 'admin')){
				$json['success']  = false;
				$json['error'] = 'Mobile No Allready Exists';
			}else{
				if($this->api_model->submit('admin', $data)){
					$json['success']  = True;
					$json['error'] = 'You are successfully Register';
				}else{
					$json['success']  = false;
					$json['error'] = 'Database Error';
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_farm_by_diffrent_id(){
		$where = '';
		$users_id = $this->input->get_post('users_id');
		$doc_id = $this->input->get_post('doc_id');
		$vt_id = $this->input->get_post('vt_id');
		$id = $this->input->get_post('id');
		$created_by = $this->input->get_post('created_by');
		$created_by_type = $this->input->get_post('created_by_type');
		if(isset($users_id) && $users_id != ''){
			$where = 'users_id = "'.$users_id.'"';
		}
		if(isset($doc_id) && $doc_id != ''){
			$where = 'doc_id = "'.$doc_id.'"';
		}
		if(isset($vt_id) && $vt_id != ''){
			$where = 'vt_id = "'.$vt_id.'"';
		}
		if(isset($created_by) && $created_by != ''){
			$where = 'created_by = "'.$created_by.'" AND created_by_type = "'.$created_by_type.'"';
		}
		if(isset($id) && $id != ''){
			$where = 'id = "'.$id.'"';
		}
		if($data = $this->api_model->get_data($where,'from_profile as fp', '', '*, (Select name from form_type where id = type_of_form) as type_of_form_name, (Select username from doctor where doctor_id = doc_id) as doctor_name, (Select username from doctor where doctor_id = vt_id) as vt_name, (Select mobile from doctor where doctor_id = doc_id) as doctor_mobile, (Select mobile from doctor where doctor_id = vt_id) as vt_mobile, (Select email from doctor where doctor_id = doc_id) as doctor_email, (Select email from doctor where doctor_id = vt_id) as vt_email, (Select CONCAT("https://www.livestoc.com/harpahu_merge_dev/uploads//doctor/", image) from doctor where doctor_id = doc_id) as doctor_image, (Select CONCAT("https://www.livestoc.com/harpahu_merge_dev/uploads//doc/", image) from doctor where doctor_id = vt_id) as vt_image, (Select full_name from users where users_id = fp.users_id) as user_name, (Select mobile from users where users_id = fp.users_id) as user_mobile, (Select address1 from address_mst where address_id = (select address_id from users where users_id = "2")) as user_default_address, (select (select (select name from zone as z where z.zone_id = mst.zone_id) from address_mst as mst where mst.users_id = frp.users_id order by address_id DESC limit 1) as state from address_mst as frp where frp.address_id = (select address_id from users where users_id = "2")) as user_state, (Select CONCAT("https://www.livestoc.com/uploads_new//profile//thumb/", image) from users where users_id = fp.users_id) as user_image')){
			$json['success']  = True;
			$json['data'] = $data;
		}else{
			$json['success']  = false;
			$json['error'] = 'No Data Found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_form_type(){
		$data = $this->api_model->get_data('', 'form_type', '', 'id, name');
		$json['success']  = True;
		$json['data'] = $data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_message_alert_status($users_id){
		if($data = $this->api_model->query_build('select DISTINCT vaccination_date, animal_vaccination_id, animal_id, (select name from medicine where id = av.vaccination_id) as vaccination_name, (select fullname from animals as ani where ani.animal_id = av.animal_id) as fullname, (select gender from animals as ani where ani.animal_id = av.animal_id) as gender, (select (select ca.category from category as ca where ca.category_id = ani.category_id) from animals as ani where ani.animal_id = av.animal_id) as category, (select (select ba.breed_name from breed as ba where ba.breed_id = ani.category_id) from animals as ani where ani.animal_id = av.animal_id) as breed_name from animal_vaccination as av where av.vaccination_status = "0" AND av.request_status = "0" AND type = "1"  AND view_status = "0" AND FIND_IN_SET(animal_id, (select group_concat(animal_id) from animals where users_id = "'.$users_id.'")) ORDER BY av.vaccination_date DESC')){
			$detail = [];
			$i = 0;
			foreach($data as $da){
				$detail[$i] = $da;
				$detail[$i]['animals_images'] = $this->api_model->get_data('animal_id = "'.$da['animal_id'].'"', 'animals_images', '', 'CONCAT("https://www.livestoc.com/uploads_new/animals/thumb/",images) as images');
				$i++;
			}
			$json['success']  = True;
			$json['data'] = $detail;
		}else{
			$json['success']  = False;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function dewarming_status_view($animal_id){
		$animal_id = $this->input->get_post('animal_id');
		$animal_id = json_decode($animal_id);
		foreach($animal_id as $ani){
			$update['view_status'] = '1';
			$this->api_model->update('animal_id', $ani, 'animal_vaccination', $update);
		}
		$json['success']  = True;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function create_form(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['doc_id'] = $this->input->get_post('doc_id');
		$data['vt_id'] = $this->input->get_post('vt_id');
		$data['type_of_form'] = $this->input->get_post('type_of_form');
		$data['form_name'] = $this->input->get_post('form_name');		
		$data['total_no_animal'] = $this->input->get_post('total_no_animal');
		$animal_status = $this->input->get_post('animal_status');
		$data['calf_male'] = $this->input->get_post('calf_male');
		$data['calf_female'] = $this->input->get_post('calf_female');
		$data['type_of_shed'] = $this->input->get_post('type_of_shed');
		$data['ventilation'] = $this->input->get_post('ventilation');
		$data['exposer_sun_light'] = $this->input->get_post('exposer_sun_light');
		$data['milking_practices'] = $this->input->get_post('milking_practices');
		$data['type_of_floring'] = $this->input->get_post('type_of_floring');
		$data['green_fodder'] = $this->input->get_post('green_fodder');
		$data['feed'] = $this->input->get_post('feed');
		$data['dry_fodder'] = $this->input->get_post('dry_fodder');
		$data['minral_mixture'] = $this->input->get_post('minral_mixture');
		$data['milking'] = $this->input->get_post('milking');
		$data['non_milking'] = $this->input->get_post('non_milking');
		$data['dry'] = $this->input->get_post('dry');
		$data['pregnent'] = $this->input->get_post('pregnent');
		$data['non_pregnent'] = $this->input->get_post('non_pregnent');
		$data['heifer'] = $this->input->get_post('heifer');
		$data['repeat_breeders'] = $this->input->get_post('repeat_breeders');
		$data['no_of_fattening_pig'] = $this->input->get_post('no_of_fattening_pig');
		$data['no_of_sow'] = $this->input->get_post('no_of_sow');
		$data['no_of_piglets'] = $this->input->get_post('no_of_piglets');
		$data['no_of_boar'] = $this->input->get_post('no_of_boar');
		$data['adequate_ventilalion'] = $this->input->get_post('adequate_ventilalion');
		$data['sunlight_enposure'] = $this->input->get_post('sunlight_enposure');
		$data['type_of_flooring'] = $this->input->get_post('type_of_flooring');
		$data['creep_space'] = $this->input->get_post('creep_space');
		$data['farrawing_pen'] = $this->input->get_post('farrawing_pen');
		$data['adequate_drainage'] = $this->input->get_post('adequate_drainage');		
		$data['total_no_of_birds'] = $this->input->get_post('total_no_of_birds');
		$data['no_of_broiler'] = $this->input->get_post('no_of_broiler');
		$data['no_of_layer'] = $this->input->get_post('no_of_layer');
		$data['no_of_breeder'] = $this->input->get_post('no_of_breeder');
		$data['rearing_system'] = $this->input->get_post('rearing_system');
		$data['type_of_bedding'] = $this->input->get_post('type_of_bedding');
		$data['animals_reared_for_meat'] = $this->input->get_post('animals_reared_for_meat');
		$data['animals_reared_for_wool'] = $this->input->get_post('animals_reared_for_wool');
		$data['milch_animals'] = $this->input->get_post('milch_animals');
		$data['system_of_rearing'] = $this->input->get_post('system_of_rearing');
		$data['type_of_housing'] = $this->input->get_post('type_of_housing');
		$data['type_of_pond'] = $this->input->get_post('type_of_pond');
		$data['sige_of_pond'] = $this->input->get_post('sige_of_pond');
		$data['type_of_aeration'] = $this->input->get_post('type_of_aeration');	
		$data['poultry_type'] = $this->input->get_post('poultry_type');
		$data['species'] = $this->input->get_post('species');
		$data['no_of_fish'] = $this->input->get_post('no_of_fish');
		$data['created_by_type'] = $this->input->get_post('created_by_type');	
		$data['created_by'] = $this->input->get_post('created_by');		
		$data['others'] = $this->input->get_post('others');
		// echo "<pre>";
		// print_r($data);
		// exit;
		$animal_status = json_decode($animal_status);
		// print_r($animal_status->data);
		// exit;
		if(!isset($data['users_id']) || $data['users_id'] == ''){
			$json['success']  = False;
			$json['error'] = 'Please Send User ID';
		}
		// else if(!isset($data['doc_id']) || $data['doc_id'] == ''){
		// 	$json['success']  = False;
		// 	$json['error'] =  'Please Send Doctor ID';
		// }
		else{
			if($last = $this->api_model->submit('from_profile', $data)){
				foreach($animal_status->data as $ani_status){
					$status['form_id'] = $last;
					$status['status_id'] = $ani_status->id;
					$status['value'] = $ani_status->value;
					$this->api_model->submit('from_animal_status_record',$status);
				}
				$json['success']  = true;
				$json['msg'] = 'Farm has been registered successfully';
			}else{
				$json['success']  = False;
				$json['error'] = 'Database Error';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_edit_form(){
		$id = $this->input->get_post('id');
		$data['users_id'] = $this->input->get_post('users_id');
		$doc_id = $this->input->get_post('doc_id');
		if(isset($doc_id) && $doc_id != ''){
			$data['doc_id'] = $doc_id;			
		}
		$vt_id = $this->input->get_post('vt_id');
		if(isset($vt_id) && $vt_id != ''){
			$data['vt_id'] = $vt_id;			
		}
		$form_name = $this->input->get_post('form_name');
		if(isset($form_name) && $form_name != ''){
			$data['form_name'] = $form_name;			
		}
		$total_no_animal = $this->input->get_post('total_no_animal');
		if(isset($total_no_animal) && $total_no_animal != ''){
			$data['total_no_animal'] = $total_no_animal;			
		}
		$calf_male = $this->input->get_post('calf_male');
		if(isset($calf_male) && $calf_male != ''){
			$data['calf_male'] = $calf_male;			
		}
		$calf_female = $this->input->get_post('calf_female');
		if(isset($calf_female) && $calf_female != ''){
			$data['calf_female'] = $calf_female;			
		}
		$type_of_shed = $this->input->get_post('type_of_shed');
		if(isset($type_of_shed) && $type_of_shed != ''){
			$data['type_of_shed'] = $type_of_shed;			
		}
		$ventilation = $this->input->get_post('ventilation');
		if(isset($ventilation) && $ventilation != ''){
			$data['ventilation'] = $ventilation;			
		}
		$exposer_sun_light = $this->input->get_post('exposer_sun_light');
		if(isset($exposer_sun_light) && $exposer_sun_light != ''){
			$data['exposer_sun_light'] = $exposer_sun_light;			
		}
		$milking_practices = $this->input->get_post('milking_practices');
		if(isset($milking_practices) && $milking_practices != ''){
			$data['milking_practices'] = $milking_practices;			
		}
		$type_of_floring = $this->input->get_post('type_of_floring');
		if(isset($type_of_floring) && $type_of_floring != ''){
			$data['type_of_floring'] = $type_of_floring;			
		}
		$green_fodder = $this->input->get_post('green_fodder');
		if(isset($green_fodder) && $green_fodder != ''){
			$data['green_fodder'] = $green_fodder;			
		}
		$feed = $this->input->get_post('feed');
		if(isset($feed) && $feed != ''){
			$data['feed'] = $feed;			
		}
		$dry_fodder = $this->input->get_post('dry_fodder');
		if(isset($dry_fodder) && $dry_fodder != ''){
			$data['dry_fodder'] = $dry_fodder;			
		}
		$minral_mixture = $this->input->get_post('minral_mixture');
		if(isset($minral_mixture) && $minral_mixture != ''){
			$data['minral_mixture'] = $minral_mixture;			
		}
		$milking = $this->input->get_post('milking');
		if(isset($milking) && $milking != ''){
			$data['milking'] = $milking;			
		}
		$non_milking = $this->input->get_post('non_milking');
		if(isset($non_milking) && $non_milking != ''){
			$data['non_milking'] = $non_milking;			
		}
		$dry = $this->input->get_post('dry');
		if(isset($dry) && $dry != ''){
			$data['dry'] = $dry;			
		}
		$pregnent = $this->input->get_post('pregnent');
		if(isset($pregnent) && $pregnent != ''){
			$data['pregnent'] = $pregnent;			
		}
		$non_pregnent = $this->input->get_post('non_pregnent');
		if(isset($non_pregnent) && $non_pregnent != ''){
			$data['non_pregnent'] = $non_pregnent;			
		}
		$heifer = $this->input->get_post('heifer');
		if(isset($heifer) && $heifer != ''){
			$data['heifer'] = $heifer;			
		}
		$repeat_breeders = $this->input->get_post('repeat_breeders');
		if(isset($repeat_breeders) && $repeat_breeders != ''){
			$data['repeat_breeders'] = $repeat_breeders;			
		}
		$no_of_fattening_pig = $this->input->get_post('no_of_fattening_pig');
		if(isset($no_of_fattening_pig) && $no_of_fattening_pig != ''){
			$data['no_of_fattening_pig'] = $no_of_fattening_pig;			
		}
		$no_of_sow = $this->input->get_post('no_of_sow');
		if(isset($no_of_sow) && $no_of_sow != ''){
			$data['no_of_sow'] = $no_of_sow;			
		}
		$no_of_piglets = $this->input->get_post('no_of_piglets');
		if(isset($no_of_piglets) && $no_of_piglets != ''){
			$data['no_of_piglets'] = $no_of_piglets;			
		}
		$no_of_boar = $this->input->get_post('no_of_boar');
		if(isset($no_of_boar) && $no_of_boar != ''){
			$data['no_of_boar'] = $no_of_boar;			
		}
		$adequate_ventilalion = $this->input->get_post('adequate_ventilalion');
		if(isset($adequate_ventilalion) && $adequate_ventilalion != ''){
			$data['adequate_ventilalion'] = $adequate_ventilalion;			
		}
		$sunlight_enposure = $this->input->get_post('sunlight_enposure');
		if(isset($sunlight_enposure) && $sunlight_enposure != ''){
			$data['sunlight_enposure'] = $sunlight_enposure;			
		}
		$type_of_flooring = $this->input->get_post('type_of_flooring');
		if(isset($type_of_flooring) && $type_of_flooring != ''){
			$data['type_of_flooring'] = $type_of_flooring;			
		}
		$creep_space = $this->input->get_post('creep_space');
		if(isset($creep_space) && $creep_space != ''){
			$data['creep_space'] = $creep_space;			
		}
		$farrawing_pen = $this->input->get_post('farrawing_pen');
		if(isset($farrawing_pen) && $farrawing_pen != ''){
			$data['farrawing_pen'] = $farrawing_pen;			
		}
		$adequate_drainage = $this->input->get_post('adequate_drainage');
		if(isset($adequate_drainage) && $adequate_drainage != ''){
			$data['adequate_drainage'] = $adequate_drainage;			
		}
		$type_of_form = $this->input->get_post('type_of_form');
		if(isset($type_of_form) && $type_of_form != ''){
			$data['type_of_form'] = $type_of_form;			
		}
		$total_no_of_birds = $this->input->get_post('total_no_of_birds');
		if(isset($total_no_of_birds) && $total_no_of_birds != ''){
			$data['total_no_of_birds'] = $total_no_of_birds;			
		}
		$no_of_broiler = $this->input->get_post('no_of_broiler');
		if(isset($no_of_broiler) && $no_of_broiler != ''){
			$data['no_of_broiler'] = $no_of_broiler;			
		}
		$no_of_layer = $this->input->get_post('no_of_layer');
		if(isset($no_of_layer) && $no_of_layer != ''){
			$data['no_of_layer'] = $no_of_layer;			
		}
		$no_of_breeder = $this->input->get_post('no_of_breeder');
		if(isset($no_of_breeder) && $no_of_breeder != ''){
			$data['no_of_breeder'] = $no_of_breeder;			
		}
		$rearing_system = $this->input->get_post('rearing_system');
		if(isset($rearing_system) && $rearing_system != ''){
			$data['rearing_system'] = $rearing_system;			
		}
		$type_of_bedding = $this->input->get_post('type_of_bedding');
		if(isset($type_of_bedding) && $type_of_bedding != ''){
			$data['type_of_bedding'] = $type_of_bedding;			
		}
		$animals_reared_for_meat = $this->input->get_post('animals_reared_for_meat');
		if(isset($animals_reared_for_meat) && $animals_reared_for_meat != ''){
			$animals_reared_for_meat = $animals_reared_for_meat;			
		}
		$animals_reared_for_wool = $this->input->get_post('animals_reared_for_wool');
		if(isset($animals_reared_for_wool) && $animals_reared_for_wool != ''){
			$data['animals_reared_for_wool'] = $animals_reared_for_wool;			
		}
		$milch_animals = $this->input->get_post('milch_animals');
		if(isset($milch_animals) && $milch_animals != ''){
			$data['milch_animals'] = $milch_animals;			
		}
		$system_of_rearing = $this->input->get_post('system_of_rearing');
		if(isset($system_of_rearing) && $system_of_rearing != ''){
			$data['system_of_rearing'] = $system_of_rearing;			
		}
		$type_of_housing = $this->input->get_post('type_of_housing');
		if(isset($type_of_housing) && $type_of_housing != ''){
			$data['type_of_housing'] = $type_of_housing;			
		}
		$type_of_pond = $this->input->get_post('type_of_pond');
		if(isset($type_of_pond) && $type_of_pond != ''){
			$data['type_of_pond'] = $type_of_pond;			
		}
		$sige_of_pond = $this->input->get_post('sige_of_pond');
		if(isset($sige_of_pond) && $sige_of_pond != ''){
			$data['sige_of_pond'] = $sige_of_pond;			
		}
		$type_of_aeration = $this->input->get_post('type_of_aeration');
		if(isset($type_of_aeration) && $type_of_aeration != ''){
			$data['type_of_aeration'] = $type_of_aeration;			
		}
		$poultry_type = $this->input->get_post('poultry_type');	
		if(isset($poultry_type) && $poultry_type != ''){
			$data['poultry_type'] = $poultry_type;			
		}
		$species = $this->input->get_post('species');	
		if(isset($species) && $species != ''){
			$data['species'] = $species;			
		}
		$others = $this->input->get_post('others');
		if(isset($others) && $others != ''){
			$data['others'] = $others;			
		}
		$no_of_fish = $this->input->get_post('no_of_fish');
		if(isset($no_of_fish) && $no_of_fish != ''){
			$data['no_of_fish'] = $no_of_fish;			
		}		
		if(!isset($data['users_id']) || $data['users_id'] == ''){
			$json['success']  = False;
			$json['error'] = 'Please Send User ID';
		}else if(!isset($id) || $id == ''){
			$json['success']  = False;
			$json['error'] =  'Please Send ID';
		}else{
		// 	echo "<pre>";
		// print_r($data);
		// exit;
			if($last = $this->api_model->get_data_update('id = "'.$id.'"', 'from_profile', $data)){				
				$json['success']  = true;
				$json['msg'] = 'Your Form has been Successfully Updated';
			}else{
				$json['success']  = False;
				$json['error'] = 'Database Error';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function edit_form($id){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['doc_id'] = $this->input->get_post('doc_id');
		$data['form_name'] = $this->input->get_post('form_name');
		$data['total_no_animal'] = $this->input->get_post('total_no_animal');
		$animal_status = $this->input->get_post('animal_status');
		$data['calf_male'] = $this->input->get_post('calf_male');
		$data['calf_female'] = $this->input->get_post('calf_female');
		$data['type_of_shed'] = $this->input->get_post('type_of_shed');
		$data['ventilation'] = $this->input->get_post('ventilation');
		$data['exposer_sun_light'] = $this->input->get_post('exposer_sun_light');
		$data['milking_practices'] = $this->input->get_post('milking_practices');
		$data['type_of_floring'] = $this->input->get_post('type_of_floring');
		$data['green_fodder'] = $this->input->get_post('green_fodder');
		$data['feed'] = $this->input->get_post('feed');
		$data['dry_fodder'] = $this->input->get_post('dry_fodder');
		$data['minral_mixture'] = $this->input->get_post('minral_mixture');
		$data['others'] = $this->input->get_post('others');
		// echo "<pre>";
		// print_r($data);
		$animal_status = json_decode($animal_status);
		// print_r($animal_status->data);
		// exit;
		if(!isset($data['users_id']) || $data['users_id'] == ''){
			$json['success']  = False;
			$json['error'] = 'Please Send User ID';
		}else if(!isset($data['doc_id']) || $data['doc_id'] == ''){
			$json['success']  = False;
			$json['error'] =  'Please Send Doctor ID';
		}else{
			if($last = $this->api_model->submit('from_profile', $data)){
				foreach($animal_status->data as $ani_status){
					$status['form_id'] = $last;
					$status['status_id'] = $ani_status->id;
					$status['value'] = $ani_status->value;
					$this->api_model->submit('from_animal_status_record',$status);
				}
				$json['success']  = true;
				$json['msg'] = 'Your Form Added Successfully';
			}else{
				$json['success']  = False;
				$json['error'] = 'Database Error';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_farmer_category($id, $sum = ''){
		$data = $this->api_model->get_data('id = "'.$id.'"', 'farmer_product_category');
		if($sum != ''){
			$ids .= $data[0]['id'];
		}else{
			$ids = '';
			$ids .= $data[0]['id'];
		}
		if($data1 = $this->api_model->get_data('super_cat_id = "'.$data[0]['id'].'"','farmer_product_category')){
			foreach($data1 as $da){
				$ids .= ','.$this->get_farmer_category($da['id'], $ids);	
			}
		}
		// $data = $this->api_model->get_data('id = "'.$id.'"', 'farmer_product_category');
		// if($sum != ''){
		// 	$ids = '';
		// }else{
		// 	$ids = '';
		// 	$ids .= $data[0]['id'];
		// }
		// if($data[0]['super_cat_id'] != '0'){
		// 	$data1 = $this->api_model->get_data('super_cat_id = "'.$data[0]['id'].'"', 'farmer_product_category');
		// 	$ids .=','.$data1[0]['id'];
		// 	if($data1[0]['super_cat_id'] == '0'){
		// 		$data2 = $this->api_model->get_data('super_cat_id = "'.$data1[0]['id'].'"', 'farmer_product_category');
		// 		$ids .=','.$data2[0]['id'];
		// 		$last = $this->get_farmer_category($data1[0]['id'], $ids);
		// 		$ids .= $last;
		// 	}
		// }
		//echo $ids;
		return $ids;
	}
	public function get_medicine($type, $category = '', $users_id = ''){
		$where = 'isactive = "1"';
		if($category != ''){
			if($where == ''){
				$where = 'FIND_IN_SET("'.$category.'", category)';
			}else{
				$where .= ' AND FIND_IN_SET("'.$category.'", category)';
			}
		}
		if($type != ''){
			if($where == ''){
				$where = 'type = "'.$type.'"';
			}else{
				$where .= 'AND type = "'.$type.'"';
			}
		}
		if($users_id != ''){
			if($where == ''){
				$where = 'users_id = "'.$users_id.'"';
			}else{
				$where .= ' OR (users_id = "'.$users_id.'" AND FIND_IN_SET("'.$category.'", category) AND type = "'.$type.'")';
			}
		}
		if($data = $this->api_model->get_data($where, 'medicine', '', 'id, name, type, composition')){
			$size = count($data);
			$data[$size]['id'] =''; 
			$data[$size]['name'] = 'Others';
			$data[$size]['type'] = '';
			$data[$size]['composition'] ='';
			$json['success']  = True;
			$json['data'] = $data;
		}else{
			$json['success']  = False;
			$json['error'] = 'No data found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_company_bull_filter(){
		$data = $this->api_model->get_data('isactive = "1"' , 'bull_table', '', 'id, bull_id, (select semen_group.group from semen_group where id =bull_table.groups) as group_name');
		$json['success']  = true; 
		$json['data'] = $data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_ai_detail($animal_id){
		if($data = $this->api_model->get_data('animal_id = "'.$animal_id.'" AND treat_type = "3" AND status = "4"', 'vt_requests', 'id DESC', 'id, concat("'.base_url().'api/vetinvoice/", Invoice_id) as Invoice_id, vt_id, vacc_id, date')){
			$detail = [];
			$i = 0;
			foreach($data as $da){
				$doctor = $this->api_model->get_data('doctor_id = "'.$da['vt_id'].'"','doctor','','doctor_id, username, mobile, concat("'.base_url().'uploads/doc/", image) as image');
				$bull_data = $this->api_model->get_data('id ="'.$da['vacc_id'].'"', 'bull_table','','id, concat("LIVE_", id) as bull_no, bull_id, (select br.breed_name from breed as br where br.breed_id = bread) as bread_name, concat("https://www.livestoc.com/harpahu_merge_dev/uploads/bank",image) as image, (Select sg.group from semen_group as sg where sg.id = groups) as groups_name');
				$detail[$i] = $da;
				$detail[$i]['doctor_id'] = $doctor[0]['doctor_id'];
				$detail[$i]['doctor_name'] = $doctor[0]['username'];
				$detail[$i]['doctor_mobile'] = $doctor[0]['mobile'];
				$detail[$i]['doctor_image'] = $doctor[0]['image'];
				$detail[$i]['b_id'] = $bull_data[0]['id'];
				$detail[$i]['bull_no'] = $bull_data[0]['bull_no'];
				$detail[$i]['bull_id'] = $bull_data[0]['bull_id'];
				$detail[$i]['bull_image'] = $bull_data[0]['image'];
				$detail[$i]['bread_name'] = $bull_data[0]['bread_name'];
				$detail[$i]['groups_name'] = $bull_data[0]['groups_name'];
				$i++;
			}
			$json['success']  = True;
			$json['data'] = $detail;
		}else{
			$json['success']  = False;
			$json['error'] = 'No data found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_animal_yield($animal_id,  $date_from = '', $data_to = '', $flag = ''){
		$animal_id = $this->input->get_post('animal_id');
		$date_from = $this->input->get_post('date_from');
		$data_to = $this->input->get_post('data_to');
		$flag = $this->input->get_post('flag');
		$where = '';
		if($animal_id != ''){
			$where .= 'where animal_id = "'.$animal_id.'"';
		}if($date_from != ''){
			$where .= 'AND created_date BETWEEN "'.$date_from.'" AND "'.$data_to.'"';
		}if($flag != '1'){
			$where .= 'AND doc_id IS NOT NULL';
		}else{
			$where .= 'AND doc_id IS NULL';
		}
		if($data = $this->api_model->query_build('SELECT DISTINCT created_date, animal_id, (select avg(ay.yield) from animals_yield_check as ay where ay.created_date = ayc.created_date AND ay.animal_id = ayc.animal_id ) as yeild_avg from animals_yield_check as ayc '.$where)){
			$detail = [];
			$i = 0;
			foreach($data as $da){
				$detail[$i] = $da;
				$der = $this->api_model->query_build('SELECT id, users_id, video, yield, created_time from animals_yield_check where created_date = "'.$da['created_date'].'" AND animal_id = "'.$da['animal_id'].'" ORDER BY created_time DESC');
				$detail[$i]['records'] = $der;
				$i++;
			}
			$json['success']  = true; 
			$json['data']  = $detail;
		}else{
			$json['success']  = False;
			$json['error'] = 'Currently Your Yield Record is Empty';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_animal_yield_by_doctor(){
		$animal_id = $this->input->get_post('animal_id');
		$date_from = $this->input->get_post('date_from');
		$data_to = $this->input->get_post('date_to');
		$flag = $this->input->get_post('flag');
		$where = '';
		// if($animal_id == ''){ 
		// 	$json['success']  = False;
		// 	$json['error'] = 'Please Send Animal ID';
		// }else{}
		if($animal_id != ''){
			$where .= 'where animal_id = "'.$animal_id.'"';
		}if($date_from != ''){
			$where .= 'AND created_date BETWEEN "'.$date_from.'" AND "'.$data_to.'"';
		}if($flag != '1'){
			$where .= 'AND doc_id IS NOT NULL';
		}else{
			$where .= 'AND doc_id IS NULL';
		}
		if($data = $this->api_model->query_build('SELECT DISTINCT created_date, admin_id,record_number,animal_id, (select avg(ay.yield) from animals_yield_check as ay where ay.created_date = ayc.created_date AND ay.animal_id = ayc.animal_id ) as yeild_avg from animals_yield_check as ayc '.$where)){
			$detail = [];
			$i = 0;
			foreach($data as $da){
				$detail[$i] = $da;
				$der = $this->api_model->query_build('SELECT id,record_number,admin_id,users_id, CONCAT("https://amazebrandlance.com/uploads/yield/",video) as video, yield, fat_snf, lactation_period ,last_calving_date,created_time from animals_yield_check where created_date = "'.$da['created_date'].'" AND animal_id = "'.$da['animal_id'].'" ORDER BY created_time DESC');
				$detail[$i]['records'] = $der;
				$i++;
			}
			$json['success']  = true; 
			$json['data']  = $detail;
		}else{
			$json['success']  = False;
			$json['error'] = 'Currently Your Yield Record is Empty';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function add_yield(){
		$users_id = $this->input->get_post('users_id');
		$doc_id = $this->input->get_post('doc_id');
		$animal_id = $this->input->get_post('animal_id');
		$video = $this->input->get_post('video');
		//$video = json_decode($video);
		$yield = $this->input->get_post('yield');
		$yield = json_decode($yield);
		$fat_snf = $this->input->get_post('fat_snf');
		$lactation_period = $this->input->get_post('lactation_period');
		$last_calving_date = $this->input->get_post('last_calving_date');
		$admin_id = $this->input->get_post('admin_id');
		$record_number = $this->input->get_post('record_number');
		$created_date = $this->input->get_post('created_date');
		$created_time = $this->input->get_post('created_time');
		$created_time = json_decode($created_time);
		//print_r($yield);
		if(!isset($users_id) || $users_id == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Users Id';
		}
		if(!isset($animal_id) || $animal_id == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Animal Id';
		}
		if(empty($yield)){
			$json['success']  = false; 
			$json['error']  = 'Please Send Yield';
		}else{
			$i = 0;
			$array_count =  count($yield);
			$count = $this->api_model->get_data('created_date = "'.$created_date.'" AND animal_id = "'.$animal_id.'"','animals_yield_check', '', 'count(id) as count');
			$count[0]['count'] = $count[0]['count'] + $array_count;
			if($count[0]['count'] <= '3'){
				foreach($yield as $yi){
					$data['users_id'] = $users_id;
					$data['animal_id'] = $animal_id;
					$data['doc_id'] = $doc_id;
					$data['video'] = $video;
					$data['yield'] = $yi;
					$data['fat_snf'] = $fat_snf;
					$data['lactation_period'] = $lactation_period;
					$data['last_calving_date'] = $last_calving_date;
					$data['admin_id'] = $admin_id;
					$data['record_number'] = $record_number;
					$data['created_date'] = $created_date;
					$data['created_time'] = $created_time[$i];
					if($this->api_model->submit('animals_yield_check', $data)){
						$json['success']  = true; 
						$json['msg']  = 'Record has been successfully updated';
					}else{
						$json['success']  = false; 
						$json['error']  = 'Database Error';
					}
					$i++;
				}
			}else{
				$json['success']  = false; 
				$json['error']  = 'You can add maximum 3 Records';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function insert_dewarming(){
		$vaccination_id = $this->input->get_post('id');
		$type = $this->input->get_post('type');
		$animal_id = $this->input->get_post('animal_id');
		$vaccination_date = $this->input->get_post('vaccination_date');
		if(!isset($vaccination_id) || $vaccination_id == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Vaccination Id';
		}else if(!isset($type) || $type == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Type';
		}else if(!isset($animal_id) || $animal_id == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Animal Id';
		}else if(!isset($vaccination_date) || $vaccination_date == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Vaccination Date';
		}else{
			$data['vaccination_id'] = $vaccination_id;
			$data['type'] = $type;
			$data['animal_id'] = $animal_id;
			$data['vaccination_date'] = $vaccination_date;
			if($type == 1){
				$data['vaccination_status'] = '0';	
				$update_data['vaccination_status'] = '1';		
				$compaire_date = date("Y-m-d", strtotime("- 3 months"));
				if($compaire_date > $vaccination_date){
					$data['vaccination_status'] = '1';
					$vr = $this->api_model->get_data('animal_id = "'.$animal_id.'"', 'animal_vaccination', 'vaccination_date DESC', 'animal_vaccination_id, vaccination_date', '', '1');
					$this->api_model->get_data_update('animal_id = "'.$animal_id.'" AND animal_vaccination_id <> "'.$vr[0]['animal_vaccination_id'].'"', 'animal_vaccination', $update_data);
				}else{
					//$vr = $this->api_model->get_data('animal_id = "'.$animal_id.'"', 'animal_vaccination', 'vaccination_date DESC', 'animal_vaccination_id, vaccination_date', '', '1');
					$this->api_model->get_data_update('animal_id = "'.$animal_id.'"', 'animal_vaccination', $update_data);
				}
			}else{
				$data['vaccination_status'] = '1';
			}
			$data['created_on'] = date('Y-m-d h:i:s');
			if($this->api_model->submit('animal_vaccination', $data)){
				$json['success']  = true; 
				$json['msg']  = 'Record has been successfully updated';
			}else{
				$json['success']  = false; 
				$json['error']  = 'Database Error';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_animal_dewarming($animal_id, $type = ''){
		$where = '';
		if($type != ''){
			$where = ' AND type = "'.$type.'"'; 
		}
		if($data = $this->api_model->get_data('animal_id = "'.$animal_id.'"'. $where, 'animal_vaccination', 'vaccination_date DESC', 'animal_vaccination_id, if((SELECT name from medicine where id = vaccination_id) IS NULL, "Deworming",(SELECT name from medicine where id = vaccination_id)) as name, vaccination_id, request_status, (select name from medicine_type where id = type ) as type, vaccination_date, vaccination_status, created_on')){
			$json['success']  = true; 
			$json['data']  = $data;
		}else{
			if($type=='1'){
				$json['success']  = false; 
			$json['error']  = 'No Vaccination Record Found';
			}else{
				$json['success']  = false; 
				$json['error']  = 'No Deworming Record Found.';
			}
			
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function insert_other_medicine(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['type'] = $this->input->get_post('type');
		$data['name'] = $this->input->get_post('name');
		$data['category'] = $this->input->get_post('category');
		if(!isset($data['type']) || $data['type'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Type';
		}else if(!isset($data['name']) || $data['name'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Name';
		}else if(!isset($data['category']) || $data['category'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Category';
		}else{
			$data['isactive'] = '0';
			if($last = $this->api_model->submit('medicine', $data)){
				$json['success']  = true; 
				$json['data'] = $this->api_model->get_data('id = "'.$last.'"', 'medicine');
				$json['msg']  = 'Record has been successfully updated';
			}else{
				$json['success']  = false; 
				$json['error']  = 'Database Error';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_farmer_product_list($id = '', $distance = '', $latitude = '', $longitude='', $start = ''){
		// echo $id.'1';
		// echo "<br>";
		// echo $distance.'2';
		// echo "<br>";
		// echo $latitude.'3';
		// echo "<br>";
		// echo $longitude.'4';
		// echo "<br>";
		// echo $start.'5';
		// exit;
		$where = '';
		$perpage = 10;
		if($id != ''){
			$get_cat = $this->get_farmer_category($id);
			if($get_cat != ''){
				$where = 'FIND_IN_SET(category_id, "'.$get_cat.'")';
			}
		}
		// echo $where;
		// exit;
		$order_by = '';
		if($distance != '0'){
			$order_by = 'distance DESC';
		}else{
			$order_by = 'distance ASC';
		}
		$select = ', IFNULL(( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ),0) AS distance';
		if($data = $this->api_model->get_data($where, 'farmer_product', $order_by, 'id, users_id, (select cat_name from farmer_product_category where id = category_id) as category_name,(select cat_name_hindi from farmer_product_category where id = category_id) as cat_name_hindi,(select cat_name_punjabi from farmer_product_category where id = category_id) as cat_name_punjabi, contact_person, phone_number, business_name, latitude, longitude, type, address '.$select.'', $start, $perpage)){
			$detail = [];
			$i=0;
			foreach($data as $da){
				$detail[$i] = $da;
				if($price = $this->api_model->get_data('product_id = "'.$da['id'].'"', 'farmer_product_price', '', 'id, product_id, (select name from unit where id = unit_id) as name,(select name_hindi from unit where id = unit_id) as name_hindi,(select name_punjabi from unit where id = unit_id) as name_punjabi,(select id from unit where id = unit_id) as unit_id, price'))
				$detail[$i]['price'] = $price; 
				if($image = $this->api_model->get_data('product_id = "'.$da['id'].'"', 'farmer_product_image','', 'CONCAT("'.base_url().'uploads/farmer_products/",image) as image'))
				$y = 0;
				$imm = [];
				foreach($image as $img){
					$imm[$y] = $img['image']; 
					$y++;
				}
				$detail[$i]['image'] = array_values($imm);
				if(is_null($detail[$i]['type'])){
					unset($detail[$i]['type']);
				}
				
				$i++;
			}
			$count = $this->api_model->get_data($where, 'farmer_product', '', 'count(id) as count', '', '');
			$json['success']  = True; 
			$json['data']  = $detail;
			$json['count']  = $count[0]['count'];
		}else{
			$json['success']  = false; 
			$json['error']  = 'No data found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function farmer_product_ins(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['category_id'] = $this->input->get_post('category_id');
		$data['contact_person'] = $this->input->get_post('contact_person');
		$data['phone_number'] = $this->input->get_post('phone_number');
		$data['business_name'] = $this->input->get_post('business_name');
		$data['type'] = $this->input->get_post('type');
		$data['latitude'] = $this->input->get_post('latitude');
		$data['longitude'] = $this->input->get_post('longitude');
		$data['address'] = $this->input->get_post('address');
		$data['description'] = $this->input->get_post('description');
		if(!isset($data['users_id']) || $data['users_id'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send User id'; 
		}else if(!isset($data['category_id']) || $data['category_id'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Category id';
		}else if(!isset($data['contact_person']) || $data['contact_person'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Contact Person Name';; 
		}else if(!isset($data['phone_number']) || $data['phone_number'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send Phone Number';
		}else if(!isset($data['latitude']) || $data['latitude'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send latitude'; 
		}else if(!isset($data['longitude']) || $data['longitude'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send longitude';
		}else if(!isset($data['address']) || $data['address'] == ''){
			$json['success']  = false; 
			$json['error']  = 'Please Send address';
		}else{
			if($last = $this->api_model->submit('farmer_product', $data)){
				$price = $this->input->get_post('price');
				$price = json_decode($price);
				foreach($price as $pr){
					$pri['price'] = $pr->value;
					$pri['unit_id'] = $pr->id;
					$pri['product_id'] = $last; 
					$this->api_model->submit('farmer_product_price', $pri);
				}
				$image = $this->input->get_post('image');
				//$image = explode(',', $image);
				$image = json_decode($image);
				foreach($image as $im){
					$ima['product_id'] = $last; 
					$ima['image'] = $im;
					$this->api_model->submit('farmer_product_image', $ima);
				}
				$json['success']  = True; 
				$json['msg']  = 'Your Product has been Successfully Submitted'; 
			}else{
				$json['success']  = false; 
				$json['error']  = 'No data found'; 
			}
		}
		// $price = $this->input->get_post('price');
		// $image = $this->input->get_post('image');
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function farmer_product_cat($cat_id){
		$pro_data = $this->api_model->farmer_product_cat_id($cat_id);
		$cate = [];
		$i = 0;
		foreach($pro_data as $pro){
					$cate[$i]['name'] = $pro['cat_name'];
					$cate[$i]['cat_name_hindi'] = $pro['cat_name_hindi'];
					$cate[$i]['cat_name_punjabi'] = $pro['cat_name_punjabi'];
					$cate[$i]['id'] = $pro['id'];
					if($this->farmer_product_cat($pro['id'])){
						$cate[$i]['sub_category'] = $this->farmer_product_cat($pro['id']);
					}
			$i++;
		}
		return $cate;
	}
	public function farmer_product_category_show(){
		$category = $this->api_model->get_farmer_category_main();
		$cate = [];
		$i = 0;
		foreach($category as $cat){
			$cate[$i]['category_name'] =  $cat['cat_name'];
			$cate[$i]['cat_name_hindi'] =  $cat['cat_name_hindi'];
			$cate[$i]['cat_name_punjabi'] =  $cat['cat_name_punjabi'];
			$cate[$i]['image'] =  $cat['image'];
			$cate[$i]['category_id'] =  $cat['id'];
			$cate[$i]['price'] = $this->api_model->get_data('FIND_IN_SET(id, "'.$cat['unit'].'")', 'unit', '', 'id, name,name_hindi,name_punjabi');;
			$cate[$i]['sub_category'] = $this->farmer_product_cat($cat['id']);
			$i++;
		}
		return $cate;
	}
	public function get_farmer_rpoduct_category(){
		if($data = $this->farmer_product_category_show()){
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
	public function get_farmer_product_subcategory($id){
		if($data = $this->api_model->get_data('category_id = "'.$id.'"', 'farmer_product_subcategory')){
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
    public function get_ai_doc_stoc(){
		$lat = $this->input->get_post('latitude');
		$lang = $this->input->get_post('longitude');
		$bull_id = $this->input->get_post('bull_id');
		$daughter_yield_to = $this->input->get_post('daughter_yield_to');
		$daughter_yield_from = $this->input->get_post('daughter_yield_from');
		$price_to = $this->input->get_post('price_to');
		$price_from = $this->input->get_post('price_from');
		$price_order = $this->input->get_post('price_order');
		$start = $this->input->get_post('start');
		$milk_type = $this->input->get_post('milk_type');	
		$breed_id = $this->input->get_post('breed_id');
		$category_id = $this->input->get_post('category_id');
		$perpage = ITEMS_PER_PAGE;
		$where = '';
		$order_by = '';
		if($daughter_yield_to != ''){
			$where .= " AND bull.daughter_yield BETWEEN '".$daughter_yield_from."' AND '".$daughter_yield_to."'";
		}
		if($price_to != ''){
			$where .= " AND st.farmer_price BETWEEN '".$price_to."' AND '".$price_from."'";
		}
		if($bull_id != ''){
			$where .= " AND st.bull_id = '".$bull_id."'";
		}
		if($milk_type != ''){
			$where .= " AND bull.milk_type = '".$milk_type."'";
		}
		if($breed_id != ''){
			$where .= " AND bull.bread = '".$breed_id."'";
		}
		if($category_id != ''){
			$where .= " AND bull.category = '".$category_id."'";
		}
		if($price_order != ''){
			if($price_order == '1'){
				$order_by = 'st.farmer_price ASC';
			}else{
				$order_by = 'st.farmer_price DESC';
			}
		}else{
			$order_by = 'distance ASC';
		}
		$data = $this->api_model->query_build("select DISTINCT st.bull_id as id, bull.semen_type, bull.category, bull.bread,bull.progini_test, bull.dam_no, bull.lat_yield, bull.daughter_yield, bull.total_milk_fat, do.doctor_id, CONCAT('LIVE_', st.bull_id) as bull_no, do.username, (select g.group from semen_group as g where id = bull.groups) as groups, bull.image as bull_image, bull.video as bull_video, (select breed_name from breed where breed_id= bull.bread) as breed_name,  (select category from category where category_id = bull.category) as category_name,(select min(id) from seman_stock where bull_id = st.bull_id AND rest_stock <> 0 AND admin_id = st.admin_id) as stock_id,do.email, bull.bull_id as bull_id, bull.image as bull_image, do.total_experience, do.image, (select if(ROUND(avg(rating),1) IS NOT NULL, ROUND(avg(rating),1), '0')  as rating from doctor_call_rating where doctor_id = do.doctor_id) as rating, st.farmer_price, st.admin_id, st.farmer_offer_price, st.company_charges, st.company_offer_charges, (select sum(rest_stock) from seman_stock where bull_id = st.bull_id) As rest_stock, (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from seman_stock as st, current_loc as cl, doctor as do, bull_table as bull where bull.id  = st.bull_id AND st.admin_id = cl.doctor_id AND do.doctor_id = st.admin_id AND do.users_type IN ('pvt_ai', 'pvt_vt') AND st.rest_stock <> 0 AND is_update = '1' AND do.isactivated = '1' ".$where." having (distance <= '10' AND rest_stock > 0) ORDER BY ".$order_by." LIMIT ".$start.", ".$perpage."");
		$count = $this->api_model->query_build("select DISTINCT st.bull_id as id, count(st.bull_id) as count, (select sum(rest_stock) from seman_stock where bull_id = st.bull_id) As rest_stock, (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from seman_stock as st, current_loc as cl, doctor as do, bull_table as bull where bull.id  = st.bull_id AND st.admin_id = cl.doctor_id AND do.doctor_id = st.admin_id AND do.users_type IN ('pvt_ai', 'pvt_vt') AND st.rest_stock <> 0 AND is_update = '1' AND do.isactivated = '1' ".$where." having (distance <= '10' AND rest_stock > 0) ORDER BY ".$order_by." LIMIT ".$start.", ".$perpage."");
		// print_r($count);
		// exit;
		if(!empty($data)){
		// exit;
		// if($data = $this->api_model->get_ai_doc_stoc('pvt_ai, pvt_vt', $lang, $lat, $bull_id)){
				foreach($data as $d){
					$degree = $this->api_model->get_doc_degree($d['doctor_id']);
					$no_of_ai_done =  $this->api_model->get_data('vt_id = '.$d['doctor_id'].' AND status = "4" AND treat_type = "3"' , 'vt_requests', '','count(id) count');
					$d['qualification'] = $degree == false ? [] : $degree;
					$d['image'] = base_url().'uploads/doc/'.$d['image'];
					$d['bull_image'] = base_url().'uploads/bank/'.$d['bull_image'];
					$d['video'] = base_url().'uploads/bank/'.$d['bull_video'];
					$d['no_of_ai'] = $no_of_ai_done[0]['count'];
					$d['succes_ai'] = '';
					$d['succes_rate'] = '';
					$d['rating'] = '';
					$d['total_price'] =  $price;
					$da[] = $d;
				}
				$data = $da;
				$json['success']  = true; 
				$json['data'] = $data;
				$json['count'] = $count[0]['count'];
			}else{
				$json['success']  = false; 
				if($start > 0){
					$json['error'] = "No more Data found.";
				}else{
					$json['error'] = "Sorry, our AI services are not available in your area presently. Coming soon. Please call 1800 102 0379 for more information.";
				}
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function check_service_provider(){
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$bull_id = $this->input->get_post('bull_id');
		$order_type = $this->input->get_post('order_type');
		if($vt_type = $this->api_model->get_ai_doc_stoc('pvt_ai', $langitude, $latitude, $bull_id, $order_type)){
			$json['success']  = true; 
			//$json['data'] = $data;
		}else{
			$json['success']  = False; 
			$json['error'] = 'Sorry, our AI services are not available in your area presently. Coming soon. Please call 1800 102 0379 for more information.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
    public function get_company_bull(){
		$users_id = $this->input->get_post('users_id');
		$breed_id = $this->input->get_post('breed_id');
		$category_id = $this->input->get_post('category_id');
		$limit = $this->input->get_post('limit');
		$start = $this->input->get_post('start');
		$primium = $this->input->get_post('primium');
		$bull_id_2 = $this->input->get_post('bull_id');
		$daughter_yield_from = $this->input->get_post('daughter_yield_from');
		$daughter_yield_to = $this->input->get_post('daughter_yield_to');
		$user_type = $this->input->get_post('user_type');
		$price_from = $this->input->get_post('price_from');
		$price_to = $this->input->get_post('price_to');
		$milk_type = $this->input->get_post('milk_type');
		$price_order = $this->input->get_post('price_order');
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');
		if($data = $this->api_model->get_company_bull($breed_id, $category_id, $limit, $premium, $daughter_yield_from, $daughter_yield_to, $user_type, $price_from, $price_to, $milk_type, $price_order, $latitude, $longitude,  $start, $bull_id_2)){
			$dommy = [];
					if(isset($breed_id)){
						if($primium != '1'){
							$detail = $this->api_model->get_seman_breed_without_id($category_id);
							if(!empty($detail[0])){
								$data[] = $detail[0];
							}
						}
                    }
                    //echo "<pre>";
					foreach($data as $d){
						//print_r($d);
						$bull_data = $this->api_model->get_data('id = '.$d['id'].'','bull_table as bul','','bul.groups, bul.id, CONCAT("LIVE_", bul.id) as bull_no, (select if(sum(st.rest_stock) IS NULL, 0, sum(st.rest_stock)) as stock from seman_stock as st where st.bull_id = bul.id) as stock,`bul`.`bull_name`, `bul`.`bull_id`, `bul`.`dob`, `bul`.`progini_test`, `bul`.`sire_no`, `bul`.`video`, `bul`.`dam_no`, `bul`.`lat_yield`, `bul`.`daughter_yield`, `bul`.`total_milk_fat`, `bul`.`sires_breed`, `bul`.`dams_breed`, `bul`.`total_milk_proteen`, `bul`.`avg_milk_proteen`, `bul`.`rating`, `bul`.`description`, `bul`.`lact_no`, `bul`.`bull_source`, `bul`.`category`, `bul`.`bread`, `bul`.`seman_category`, `bul`.`image`, `bul`.`price`, `bul`.`ai_price`, `bul`.`vt_ai_price`, `bul`.`is_imported`, `bul`.`is_certified`, `bul`.`ispremium`, `bul`.`company_charges`, `bul`.`semen_type`');
						$cat = $this->api_model->get_category($bull_data[0]['category']);
						$bull_id = $this->api_model->get_bank_name_by_id($bull_data[0]['bull_source']);
						$count = $this->api_model->get_like_count($bull_data[0]['id'],0);
						$d['groups'] = $bull_data[0]['groups'];
						$d['id'] = $bull_data[0]['id'];
						$d['bull_no'] = $bull_data[0]['bull_no'];
						$d['stock'] = $bull_data[0]['stock'];
						$d['bull_name'] = $bull_data[0]['bull_name'];
						$d['bull_id'] = $bull_data[0]['bull_id'];
						$d['dob'] = $bull_data[0]['dob'];
						$d['progini_test'] = $bull_data[0]['progini_test'];
						$d['sire_no'] = $bull_data[0]['sire_no'];
						$d['video'] = $bull_data[0]['video'];
						$d['dam_no'] = $bull_data[0]['dam_no'];
						$d['lat_yield'] = $bull_data[0]['lat_yield'];
						$d['daughter_yield'] = $bull_data[0]['daughter_yield'];
						$d['total_milk_fat'] = $bull_data[0]['total_milk_fat'];
						$d['sires_breed'] = $bull_data[0]['sires_breed'];
						$d['dams_breed'] = $bull_data[0]['dams_breed'];
						$d['total_milk_proteen'] = $bull_data[0]['total_milk_proteen'];
						$d['avg_milk_proteen'] = $bull_data[0]['avg_milk_proteen'];
						$d['rating'] = $bull_data[0]['rating'];
						$d['description'] = $bull_data[0]['description'];
						$d['lact_no'] = $bull_data[0]['lact_no'];
						$d['bull_source'] = $bull_data[0]['bull_source'];
						$d['category'] = $bull_data[0]['category'];
						$d['bread'] = $bull_data[0]['bread'];
						$d['seman_category'] = $bull_data[0]['seman_category'];
						$d['image'] = $bull_data[0]['image'];
						$d['price'] = $bull_data[0]['price'];
						$d['ai_price'] = $bull_data[0]['ai_price'];
						$d['vt_ai_price'] = $bull_data[0]['vt_ai_price'];
						$d['is_imported'] = $bull_data[0]['is_imported'];
						$d['is_certified'] = $bull_data[0]['is_certified'];
						$d['ispremium'] = $bull_data[0]['ispremium'];
						$d['company_charges'] = $bull_data[0]['company_charges'];
						$d['semen_type'] = $bull_data[0]['semen_type'];
						$d['like'] = $count[0]['count'];
						if(isset($users_id)){
							if($like = $this->api_model->get_like_status($users_id, $d['id'],0)){
								$d['like_status'] = '1';
							}else{
								$d['like_status'] = '0';
							}
						}
						$semen_group = $this->api_model->get_data('id ="'.$bull_data[0]['groups'].'"', 'semen_group','','*');
						$min_price = $this->api_model->query_build("select if(if(min(ai_farmer_price) <> 0, min(ai_farmer_price), min(farmer_price)) IS NOT NULL, if(min(ai_farmer_price) <> 0, min(ai_farmer_price), min(farmer_price)), (select farmer_price from semen_group where id = bull.groups)) as min, (IFNULL(( 3959 * acos( cos( radians('".$latitude."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$longitude."') ) + sin( radians('".$latitude."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from seman_stock as st, current_loc as cl, doctor as do, bull_table as bull where bull.id  = '".$d['id']."' AND st.bull_id = '".$d['id']."' AND st.admin_id = cl.doctor_id AND do.doctor_id = st.admin_id AND do.users_type IN ('pvt_ai', 'pvt_vt') AND st.rest_stock <> 0 AND is_update = '1' AND do.isactivated = '1' having distance <= '".RADIOUS_DIST."' ");
                        // $min_price = $this->api_model->get_data('bull_id ="'.$d['id'].'" and ai_farmer_price <> 0', 'seman_stock as st','','if(if(min(ai_farmer_price) <> 0, min(ai_farmer_price), min(farmer_price)) IS NOT NULL, if(min(ai_farmer_price) <> 0, min(ai_farmer_price), min(farmer_price)),(select farmer_price from semen_group where id = "'.$d['groups'].'")) as min');
                        //print_r($min_price);
                        $d['min_price'] = $min_price[0]['min'];
						$d['groups'] = $semen_group[0]['group'];
						$d['farmer_price'] = $semen_group[0]['farmer_price'];
						$d['farmer_offer_price'] = $semen_group[0]['farmer_offer_price'];
						$d['ai_price'] = $semen_group[0]['ai_price'];
						$d['ai_offer_price'] = $semen_group[0]['ai_offer_price'];
						$d['advance_booking_price'] = $semen_group[0]['advance_booking_price'];
						$d['advance_booking_offer_price'] = $semen_group[0]['advance_booking_offer_price'];
						$d['ai_service_price'] = $semen_group[0]['ai_service_price'];
						$d['ai_service_offer_price'] = $semen_group[0]['ai_service_offer_price'];
						$d['company_charges'] = $semen_group[0]['company_charges'];
						$d['company_offer_charges'] = $semen_group[0]['company_offer_charges'];
						$d['bull_source'] = $bull_id[0]['fname'];
						$d['category_name'] = $cat[0]['category'];
						if($d['image'] == ''){
							$d['image'] ='';
						}else{
							$d['image'] = base_url()."uploads/bank/".$bull_data[0]['image'];
						}
						if($d['video'] == ''){
							$d['video'] ='';
						}else{
							$d['video'] = base_url()."uploads/bank/".$bull_data[0]['video'];
						}
						//$d['price'] = $d['price'] ; 
						//$d['image'] = isset($d['image']) ? base_url()."uploads/bank/".$d['image'] : '';
						//$d['video'] = isset($d['video']) ? base_url()."uploads/bank/".$d['video'] : '';
						$breed = $this->api_model->get_animal_breed($d['bread']);
						$d['breed_name'] = $breed[0]['breed_name'];
						$d['price'] = $d['price'];
                        $dommy[] = $d;  
					}
				$json['success']  = true; 
                $json['data'] = $dommy;
                //$json['count'] = $i;
				$json['count'] = $this->api_model->get_company_bull_count($breed_id, $category_id, $limit, $premium, $daughter_yield_from, $daughter_yield_to, $user_type, $price_from, $price_to, $milk_type, $price_order, $latitude, $longitude,  $start, $bull_id_2);
			}else{
				$json['success']  = false; 
				if($start <= 1){
					$json['error'] = "We are in process of updating the listings please check after 48 Hrs";
				}else{
					$json['error'] = "We are in process of updating the listings please check after 48 Hrs";
				}	
			}
		 header('Content-Type: application/json');
		 echo json_encode($json);
		 exit;
	}
	public function farmer_product_price_update(){
		$id = $this->input->get_post('id');
		$users_id = $this->input->get_post('users_id');	
		$product_id = $this->input->get_post('product_id');	
		$unit_id = $this->input->get_post('unit_id');
		$update['price'] = $this->input->get_post('price');
		if(!isset($id) || $id == ''){
			$json['success']  = false; 
			$json['error'] = "Please send  Id";
		}
		else if(!isset($product_id) || $product_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please send product Id";
		}
		else if(!isset($unit_id) || $unit_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please sen unit Id";
		}else{
			if($this->api_model->get_data_update('id = "'.$id.'" AND product_id = "'.$product_id.'" AND unit_id = "'.$unit_id.'"', 'farmer_product_price', $update)){
				$json['success']  = true; 
				$json['msg'] = "Price has been successfully updated";
			}else{
				$json['success']  = false; 
				$json['msg'] = "Something Went Wrong.";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function make_invoice(){
		$users_id = $this->input->get_post('users_id');
		$data['users_id'] = $this->input->get_post('users_id');
		$data['admin_id'] = $this->input->get_post('admin_id');
		$data['animal_id'] = $this->input->get_post('animal_id');
		$data['bull_id'] = $this->input->get_post('bull_id');
		$order_type= $this->input->get_post('order_type');
		$additional_charges = $this->input->get_post('additional_charges');
		$mobile = $this->input->get_post('mobile_code');
		$user_phone = $this->input->get_post('mobile');
		$request_id = $this->input->get_post('request_id');
		// echo "<pre>";
		// print_r($_REQUEST);
		// exit;
		if($request_id != ''){
			$request = $this->api_model->get_data('id = "'.$request_id.'"' , 'vt_requests', '', '*');
			if($data['animal_id'] != ''){
				$req_update['animal_id'] =  $data['animal_id'];
				$this->api_model->update('id', $request_id,'vt_requests', $req_update);
			}
			// echo "<pre>";
			// print_r($request);
			$semen_group1 = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_price, ai_farmer_price FROM seman_stock where admin_id = "'.$data['admin_id'].'" AND bull_id = "'.$data['bull_id'].'" AND rest_stock <> 0');
			// print_r($semen_group);
			// echo "dasdasdasdasd----------";
			$bull = $this->api_model->get_data('id = "'.$data['bull_id'].'"' , 'bull_table', '', '*');
			$semen_group = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"', 'semen_group','','*');
			if($request[0]['order_type'] == '1'){
				$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
				$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
				$end_data = date('Y-m-d');
				if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
				// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
				// if($pack_data[0]['sum'] >  0){
					$per = $semen_group[0]['farmer_offer_price'];
				}else{
					$per = $semen_group[0]['farmer_price'];
				}
			}else{
				$per = $semen_group1[0]['ai_farmer_price'];
			}
			$bull[0]['price'] = $semen_group[0]['ai_price'];
			if($request[0]['vacc_id'] == '' || $request[0]['vacc_id'] == '0'){
				// print_r($request);
				// exit;
					$data['log_id'] = $request[0]['log_id'];
					$data['request_id'] = $request_id;
					$data['old_bull_id'] = $data['bull_id'];
					$semen_group1 = $this->api_model->query_build('SELECT  min(id) as id, farmer_price, farmer_offer_price, ai_price, ai_farmer_price FROM seman_stock where admin_id = "'.$data['admin_id'].'" AND bull_id = "'.$data['bull_id'].'" AND rest_stock <> 0 ');
					// print_r($semen_group);
					// exit;
					$bull = $this->api_model->get_data('id = "'.$data['bull_id'].'"' , 'bull_table', '', '*');
					$semen_group = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"', 'semen_group','','*');
					//$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
					if($request[0]['order_type'] == '1'){
						$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
						$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
						$end_data = date('Y-m-d');
						if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
						// if($pack_data[0]['sum'] >  0){
							$per = $semen_group[0]['farmer_offer_price'];
						}else{
							$per = $semen_group[0]['farmer_price'];
						}
					}else{
						$per = $semen_group1[0]['ai_farmer_price'];
					}
					$semen_stock_price = $per;
					$semen_stock_id = $this->input->get_post('semen_stock_id');
					$semen_stock_qty = $this->input->get_post('semen_stock_qty');
					$sheath_qty = $this->input->get_post('sheath_qty');
					$gloves_qty = $this->input->get_post('gloves_qty');
					$ai_price = $semen_group[0]['ai_price'];
			}else{
				if($request[0]['vacc_id'] != $data['bull_id']){
					$old_bull = $this->api_model->get_data('id = "'.$request[0]['vacc_id'].'"' , 'bull_table', '', '*');
					$old_semen_group = $this->api_model->get_data('id ="'.$old_bull[0]['groups'].'"', 'semen_group','','*');
					$old_semen_group1 = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_price, ai_farmer_price FROM seman_stock where admin_id = "'.$data['admin_id'].'" AND bull_id = "'.$request[0]['vacc_id'].'" AND rest_stock <> 0');
					if($request[0]['order_type'] == '1'){
						$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
						$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
						$end_data = date('Y-m-d');
						if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
						// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
						// if($pack_data[0]['sum'] >  0){
							$old_per = $old_semen_group[0]['farmer_offer_price'];
						}else{
							$old_per = $old_semen_group[0]['farmer_price'];
						}
					}else{
						$old_per = $old_semen_group1[0]['ai_farmer_price'];
					}
					$log_data_s = $this->api_model->get_data('id = "'.$request[0]['log_id'].'"' , 'log_file', '', '*');
					if($log_data_s[0]['request_status'] == '1'){
						if($log_data_s['0']['amount'] < $per){
							$update_log['request_status'] =  '2';
							$this->api_model->update('id', $request[0]['log_id'],'log_file', $update_log);
						}
					}
					// print_r($log_data_s);
					// exit;
					$data['old_bull_id'] = $request[0]['vacc_id'];
					$data['old_semen_stock_price'] = $old_per;
					$data['old_ai_price'] = $old_semen_group[0]['ai_price'];
					if($old_per > $per){
						$data['symble'] = '+';
						$data['diff_price'] = $old_per - $per;
					}else{
						$data['symble'] = '-';
						$data['diff_price'] = $per - $old_per;
					}	
					$data['log_id'] = $request[0]['log_id'];
					$data['request_id'] = $request_id;			
					$semen_stock_price = $per;
					$semen_stock_id =$this->input->get_post('semen_stock_id');
					$semen_stock_qty = $this->input->get_post('semen_stock_qty');
					$sheath_qty = $this->input->get_post('sheath_qty');
					$gloves_qty = $this->input->get_post('gloves_qty');
					$ai_price = $semen_group[0]['ai_price'];
					//if($data['animal_id'] != ''){
						$data2['vacc_id'] = $data['bull_id'];
						$this->api_model->change_request_status($request_id, $data2);
					//}
				}else{
				// 	print_r($request);
				// exit;
					$data['log_id'] = $request[0]['log_id'];
					$data['request_id'] = $request_id;	
					$data['old_bull_id'] = $data['bull_id'];
					$log_data_s = $this->api_model->get_data('id = "'.$request[0]['log_id'].'"' , 'log_file', '', '*');
					$semen_group1 = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_price, ai_farmer_price FROM seman_stock where admin_id = "'.$data['admin_id'].'" AND bull_id = "'.$data['bull_id'].'" AND rest_stock <> 0');
					// echo "this is test";
					// print_r($semen_group);
					// exit;
					$bull = $this->api_model->get_data('id = "'.$data['bull_id'].'"' , 'bull_table', '', '*');
					$semen_group = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"', 'semen_group','','*');
					if($request[0]['order_type'] == '1'){
						$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
						$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
						$end_data = date('Y-m-d');
						if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
						// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
						// if($pack_data[0]['sum'] >  0){
							$per = $semen_group[0]['farmer_offer_price'];
						}else{
							$per = $semen_group[0]['farmer_price'];
						}
					}else{
						$per = $semen_group1[0]['ai_farmer_price'];
					}
					$semen_stock_price = $per;
					$semen_stock_id = $this->input->get_post('semen_stock_id');
					$semen_stock_qty = $this->input->get_post('semen_stock_qty');
					$sheath_qty = $this->input->get_post('sheath_qty');
					$gloves_qty = $this->input->get_post('gloves_qty');
					$ai_price = $semen_group[0]['ai_price'];
					if($log_data_s[0]['request_status'] == '1'){
						$data['payment_status'] = '1';
					}
				}
			}
			if($data['animal_id'] != ''){
				// $data1['animal_id'] = $data['animal_id'];
				// $this->api_model->change_request_status($request_id, $data1);
			}
		}else{
			$semen_group1 = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_price, ai_farmer_price FROM seman_stock where admin_id = "'.$data['admin_id'].'" AND bull_id = "'.$data['bull_id'].'" AND rest_stock <> 0');
			$bull = $this->api_model->get_data('id = "'.$data['bull_id'].'"' , 'bull_table', '', '*');
			$semen_group = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"', 'semen_group','','*');
			// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
			if($request[0]['order_type'] == '1'){
				$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
				$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
				$end_data = date('Y-m-d');
				if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
				// if($pack_data[0]['sum'] >  0){
					$per = $semen_group[0]['farmer_offer_price'];
				}else{
					$per = $semen_group[0]['farmer_price'];
				}
			}else{
				$per = $semen_group1[0]['ai_farmer_price'];
			}
			$semen_stock_price = $per;
			$semen_stock_id =$this->input->get_post('semen_stock_id');
			$semen_stock_qty = $this->input->get_post('semen_stock_qty');
			$sheath_qty = $this->input->get_post('sheath_qty');
			$gloves_qty = $this->input->get_post('gloves_qty');
			$ai_price = $semen_group[0]['ai_price'];
		}
		$data['addtional_charges'] = $additional_charges;
		$data['semen_stock_price'] = $semen_stock_price;
		$data['semen_stock_id'] = $semen_stock_id;
		$data['semen_stock_qty'] = $semen_stock_qty;
		$data['sheath_qty'] =  $sheath_qty;
		$data['gloves_qty'] =  $gloves_qty;
		$data['ai_price'] = $ai_price;
		$data['otp'] = rand(1000,9999);
		$data['invoice_total'] = $semen_stock_price;
		$data['type'] = $this->input->get_post('type');
		$data['date'] = date('Y-m-d h:i:s');
		if($id = $this->api_model->submit('semen_invoice_performa',$data)){
			$msg = "Please Pay Rs = ".$data['invoice_total']."to the Service Provider and OTP is ".$data['otp']."  https://www.livestoc.com/harpahu_merge_dev/api/vetinvoice/".$id;
			$count =  $this->api_model->query_build('select if(sum(breeding_total) IS NULL, "0", sum(breeding_total)) as sum from breeding_account where doc_id = "'.$data['admin_id'].'"');
			$json['data'] = $this->api_model->get_proforma_invoice('', $id);
			$json['data'][0]['breeding_record_count'] = $count[0]['sum'];
			$json['data'][0]['breeding_record_price'] = BREADING_RECORD_PRICE;
			$json['success']  = TRUE; 
		}
		header('Content-Type: application/json');
		echo json_encode($json);	
		exit;
	}
	public function send_treatment_sms($invoice_id){
		$data = $this->api_model->get_data('id = "'.$invoice_id.'"' , 'semen_invoice_performa', '', '*');
		$user = $this->api_model->get_data('users_id = "'.$data[0]['users_id'].'"', 'users','','*');
		$request = $this->api_model->get_data('id = "'.$data[0]['request_id'].'"', 'vt_requests','','*');
		//print_r($user[0]['mobile']);
		$sms_template = urlencode('AIREQUEST');
		$vars = array('var1'=>$request[0]['otp']);
		$mobile = $user[0]['mobile'];
		$curl = curl_init();

		$url = "https://2factor.in/API/R1/?module=TRANS_SMS&apikey=85aab6cd-b267-11e7-94da-0200cd936042&to=$mobile&from=LIVEST&templatename=$sms_template";
		foreach($vars as $key=>$var){
		$url .=	"&".$key."=".urlencode($var);
		}
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        ));

		
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

		
        if ($err) {
		$json['success'] = false;
		$json['error'] = $err;
        } else {
		 	//echo  $response;
			$json['success'] = true;
			$json['msg'] = "OTP is sent to  Farmer's Number. Please enter the OTP.";
		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function complite_invoice(){	
		$invoice_id = $this->input->get_post('invoice_id');
		$otp = $this->input->get_post('otp');
		$straw_image = $this->input->get_post('straw_image');
		$order_type = $this->input->get_post('order_type');
		$address = $this->input->get_post('address');
		$in = $this->api_model->get_invoice_id($invoice_id);
		if($data = $this->api_model->check_request_otp($in[0]['request_id'], $otp)){
			if($order_type == '0'){
				$count =  $this->api_model->query_build('select * from breeding_account where doc_id = "'.$data[0]['vt_id'].'" AND breeding_total <> 0');
				if(!empty($count)){
					$count_update['breeding_total'] = $count[0]['breeding_total'] - 1;
					$this->api_model->update('id', $count[0]['id'], 'breeding_account', $count_update);
				}
			}
			if($data[0]['log_id'] == '0'){
				if($data[0]['vacc_id'] == '0'){
					$bull_update['vacc_id'] = $in[0]['bull_id'];
					$this->api_model->update('id', $in[0]['request_id'], 'vt_requests', $bull_update);
					$bull = $this->api_model->get_data('id = "'.$in[0]['bull_id'].'"' , 'bull_table', '', '*');
					$semen_price = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"','semen_group','','*');
					$old_bull = $this->api_model->get_data('id = "'.$in[0]['old_bull_id'].'"' , 'bull_table', '', '*');
					$semen_old_price = $this->api_model->get_data('id ="'.$old_bull[0]['groups'].'"','semen_group','','*');
				}else{
					$bull = $this->api_model->get_data('id = "'.$data[0]['vacc_id'].'"' , 'bull_table', '', '*');
				}
				if($order_type == '1'){
					$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
					$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
					$end_data = date('Y-m-d');
					if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
					// $pack_data = $this->api_model->get_data('users_id = "'.$data[0]['users_id'].'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
					// if($pack_data[0]['sum'] >  0){
						$per = $semen_price[0]['farmer_offer_price'];
						$old_per = $semen_old_price[0]['farmer_offer_price'];
					}else{
						$per = $semen_price[0]['farmer_price'];
						$old_per = $semen_old_price[0]['farmer_price'];
					}
				}else{
					$per = $semen_price[0]['ai_farmer_price'];
					$old_per = $semen_old_price[0]['ai_farmer_price'];
				}
				if($in[0]['log_id'] != '' || $in[0]['log_id'] != '0'){
					$log['type'] = '26';
					$log['users_id'] = $data[0]['users_id'];
					$log['currency'] = 'INR';
					$log['request_id'] = $in[0]['request_id'];
					$log['amount'] = $per;
					$log['request_status'] = '2';
					$log['status'] = '1';
					$log['user_type'] = '1';
					$log['date'] = date('Y-m-d');
					$log['method'] = 'Cash On Delivery';
					$log_id = $this->api_model->submit('log_file', $log);
					$update['log_id'] = $log_id;
					$in[0]['log_id'] = $log_id;
				}else{
					$update['log_id'] = $in[0]['log_id'];
				}
				if($in[0]['old_bull_id'] != $data[0]['vacc_id']){
					// $data1['animal_id'] = $in[0]['old_bull_id'];
					// $this->api_model->change_request_status($in[0]['request_id'], $data1);
					// $per = $per - $in[0]['addtional_charges'];
					if($old_per > $per){
						$wall_dr = $this->api_model->get_data('log_id = "'.$update['log_id'].'" AND status = "Dr"', 'livestoc_wallets','', 'sum(amount) as amount');
						$per = $per+$in[0]['addtional_charges'];
						if($wall_dr[0]['amount'] >  $per){
							$wall_update['amount'] = $wall_dr[0]['amount'] - $per;
							$wall_update['log_id'] = $update['log_id'];
							$wall_update['status'] = 'Cr';
							$wall_update['date'] = date('Y-m-d h:i:s');
							$wall_update['type'] = '35';
							$wall_update['users_id'] =$data[0]['users_id'];
							$wall_update['wallet_type'] = '1';
							$wall_update['animal_id'] = '0';
							$this->api_model->submit('livestoc_wallets', $wall_update);
						}
					}
				}
				$this->api_model->update('id', $invoice_id, 'semen_invoice_performa', $update);
				$update['created_on'] = date('Y-m-d h:i:s');
				$update['log_id'] = $log_id;
				$this->api_model->update('id', $in[0]['request_id'], 'vt_requests', $update);
			}else{
				$semen_price = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_farmer_price, ai_price FROM seman_stock where admin_id = "'.$data[0]['vt_id'].'" AND bull_id = "'.$in[0]['bull_id'].'" AND rest_stock <> 0');
				// $bull = $this->api_model->get_data('id = "'.$in[0]['bull_id'].'"' , 'bull_table', '', '*');
				// $semen_price = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"','semen_group','','*');
				$semen_old_price = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_farmer_price, ai_price FROM seman_stock where admin_id = "'.$data[0]['vt_id'].'" AND bull_id = "'.$in[0]['old_bull_id'].'" AND rest_stock <> 0');
				// $old_bull = $this->api_model->get_data('id = "'.$in[0]['old_bull_id'].'"' , 'bull_table', '', '*');
				// $semen_old_price = $this->api_model->get_data('id ="'.$old_bull[0]['groups'].'"','semen_group','','*');
				
				if($order_type == '1'){
					$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
					$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
					$end_data = date('Y-m-d');
					if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
					// $pack_data = $this->api_model->get_data('users_id = "'.$data[0]['users_id'].'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
					// if($pack_data[0]['sum'] >  0){
						$per = $semen_price[0]['farmer_offer_price'];
						$old_per = $semen_old_price[0]['farmer_offer_price'];
					}else{
						$per = $semen_price[0]['farmer_price'];
						$old_per = $semen_old_price[0]['farmer_price'];
					}
				}else{
					$per = $semen_price[0]['ai_farmer_price'];
					$old_per = $semen_old_price[0]['ai_farmer_price'];
				}
				
				if($in[0]['old_bull_id'] != $data[0]['vacc_id']){
					//echo $per = $per - $in[0]['addtional_charges'];
					// $data1['animal_id'] = $in[0]['old_bull_id'];
					// $this->api_model->change_request_status($in[0]['request_id'], $data1);
					// echo "this is test";
					// exit;
					if($old_per > $per){
						$wall_dr = $this->api_model->get_data('log_id = "'.$data[0]['log_id'].'" AND status = "Dr"', 'livestoc_wallets','', '(if(sum(amount) IS NOT NULL, sum(amount), 0)) as amount');
						$per = $per+$in[0]['addtional_charges'];
						if($wall_dr[0]['amount'] >  $per){
							$wall_update['amount'] = $wall_dr[0]['amount'] - $per;
							$wall_update['log_id'] =$data[0]['log_id'];
							$wall_update['status'] = 'Cr';
							$wall_update['date'] = date('Y-m-d h:i:s');
							$wall_update['type'] = '35';
							$wall_update['users_id'] =$data[0]['users_id'];
							$wall_update['wallet_type'] = '1';
							$wall_update['animal_id'] = '0';
							$this->api_model->submit('livestoc_wallets', $wall_update);
						}
					}
				}
			}
			$old_msg['to_users_id'] =  $data[0]['users_id'];
			$old_msg['to_id'] =  $data[0]['users_id'];
			$old_msg['to_type'] = 'users';
			$old_msg['title'] = 'AI Done';
			$old_msg['from_type'] = 'Livestoc Team';
			$old_msg['success'] = '1';
			$old_msg['device'] = 'android';
			$old_msg['active'] = '1'; 
			$old_msg['description'] = 'AI of your animal (#'.$data[0]['animal_id'].') has been done successfully.';
			$old_msg['date_added'] = date('Y-m-d h:i:s');
			$this->api_model->old_notification($old_msg);
			$msg['users_id'] = $data[0]['users_id'];
			$msg['title'] = 'AI Done';
			$msg['message'] = 'AI of your animal (#'.$data[0]['animal_id'].') has been done successfully.';;
			$msg['date'] = date('Y-m-d h:i:s');
			$msg['type'] = '2';
			$msg['isactive'] = '1';
			$msg['flag'] = '1';
			$this->api_model->user_notification($msg);
			$this->simple_push_none($data[0]['users_id'], 2 , $msg['title'], '1', $msg['message']);
			//$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
			// $user_id = $data[0]['users_id'];
			// $stock_id = explode(',',$data[0]['semen_stock_id']);
			// $stock_qty = explode(',',$data[0]['semen_stock_qty']);
			// $i = 0;
			// $ani_data[''] = '4'
			// $this->api_model->update('animal_id', $data[0]['animal_id'], 'log_file', $ani_data);
				// echo "<pre>";
				// print_r($in);
				// print_r($data);
				//if($order_type == '1'){
					$pack_data = $this->api_model->get_data('users_id = "'.$data[0]['users_id'].'" AND rest_quantity <> 0', 'ai_package_log', '', 'sum(rest_quantity) as sum');
					if($order_type == '1'){
						if($pack_data[0]['sum'] >  0){
							// $doc_data = $this->api_model->get_data('doctor_id = "'.$data[0]['vt_id'].'"', 'doctor', '', '*');
							// if($doc_data[0]['company_partner'] == '1'){
								$pack_up_data = $this->api_model->get_data('users_id = "'.$data[0]['users_id'].'" AND rest_quantity <> 0', 'ai_package_log', '', '*');
								$p_d['rest_quantity'] = $pack_up_data[0]['rest_quantity'] - 1;
								$this->api_model->get_data_update('id = "'.$pack_up_data[0]['id'].'"', 'ai_package_log', $p_d);
								$update['premium_type'] = '1';
							// }
						}
					}
				//}
				$stock = $this->api_model->get_data('id = "'.$in[0]['semen_stock_id'].'"' , 'seman_stock', '', '*');
				$rest_stock = $stock[0]['rest_stock'] - $in[0]['semen_stock_qty'];
				$r_data['rest_stock'] = $rest_stock;
				$this->api_model->get_data_update('id = "'.$in[0]['semen_stock_id'].'"', 'seman_stock', $r_data);
				$l_data['status'] = '1';
				$this->api_model->get_data_update('id = "'.$in[0]['log_id'].'"', 'log_file', $l_data);
				$i_data['payment_status'] = '1';
				$this->api_model->get_data_update('id = "'.$invoice_id.'"', 'semen_invoice_performa', $l_data);
				$performa_invoice = $this->api_model->get_data('id= "'.$invoice_id.'"', 'semen_invoice_performa');
				//-----------------------------------------------//
				$update['Invoice_id'] = $invoice_id;
				$update['symptoms_image'] = $straw_image;
				$this->api_model->update('id', $in[0]['request_id'], 'vt_requests', $update);
				//$this->api_model->change_request_status($in[0]['request_id'], $update);
				$data1['status'] = '4';
				$this->api_model->change_request_status($in[0]['request_id'], $data1);
				$ai_log['request_id'] = $in[0]['request_id'];
				$ai_log['invoice_id'] = $invoice_id;
				$ai_log['log_id'] = $in[0]['log_id'];
				if($data[0]['premium_type'] == '1'){
					$ai_log['company_charges'] = $stock[0]['company_offer_charges'];
					$ai_log['farmer_price'] = $stock[0]['farmer_offer_price'];
				}else{
					$ai_log['company_charges'] = $stock[0]['company_charges'];
					$ai_log['farmer_price'] = $stock[0]['farmer_price'];
				}
				$ai_log['vt_id'] = $data[0]['vt_id'];
				$ai_log['premium_type'] = $data[0]['premium_type'];
				$ai_log['status'] = $performa_invoice[0]['payment_status'];
				$ai_log['date_time'] = date('Y-m-d h:i:s');	
				$this->api_model->submit('ai_log', $ai_log);
				//-----------------------------------------------//
			// foreach($stock_id as $st){
			// 	$sto = $this->api_model->get_semen_stock_id($st);
			// 	$stock_data['rest_stock'] = $sto[0]['rest_stock'] - $stock_qty[$i];
			// 	$this->api_model->update_semen_stock($st, $stock_data);
			// 	$req_filed = [	
			// 		'users_id'     => $user_id,
			// 		'animal_id'     => $data[0]['animal_id'],
			// 		'treat_type'    => '3',
			// 		'vt_id'         => $data[0]['admin_id'],
			// 		'animal_simtoms'=> '',
			// 		'status'        => '4',
			// 		'address'       => $address,
			// 		'latitude'      => '0',
			// 		'langitude '    => '0',
			// 		'otp'          => $otp,
			// 		'date'		   => date('Y-m-d'),
			// 		'created_on'    =>  date('Y-m-d H:i:s'),
			// 	];
			// 	$insert = $this->api_model->insert_vt_request($req_filed);
			// 	$r_data['request_id'] = $insert; 
			// 	$r_data['user_id'] = $user_id;
			// 	$r_data['animal_id'] = $data[0]['animal_id'];
			// 	$r_data['treat_type'] = '3';
			// 	$r_data['animal_simtoms'] = '';
			// 	$r_data['treat_status'] = '4';
			// 	$r_data['doc_id'] = '0';
			// 	$r_data['vacc_id'] = $data[0]['bull_id'];
			// 	$r_data['vt_id'] = $data[0]['admin_id'];
			// 	$r_data['status'] = '4';
			// 	$r_data['type'] = '0';
			// 	$r_data['otp'] = $otp;
			// 	$r_data['date'] = date('Y-m-d');
			// 	//print_r($req_filed);
			// 	$this->api_model->insert_vt_track_request($r_data);
			// 	$i++;
			// }
			$query = "call get_doc_account(".$data[0]['vt_id'].");";
			$count = $this->api_model->query_build($query);
			$this->db->close();
			$query = "Select count(id) as count, if(sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)) IS NOT NULL, sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)),0) as company_share, if(sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))) IS NOT NULL,sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))), 0) as your_share from doctor_call_inisite where log_id <> '0' AND doctor_id = '".$data[0]['vt_id']."'";
			$call_data = $this->api_model->query_build($query);
			$query = "select  count(id) as count, sum(amount) as amount from company_settlement_account as com where users_id = ".$data[0]['vt_id']." AND company_status = 'Cr' AND ((select request_status from log_file where id = com.log_id) <> '1' OR log_id = '0')";
			$account_summary = $this->api_model->query_build($query);
			$query = "select  count(id) as count, sum(amount) as amount from company_settlement_account as com where users_id = ".$data[0]['vt_id']." AND company_status = 'Cr' AND (select request_status from log_file where id = com.log_id) = '1' AND log_id <> '0'";
			$account_summary_online = $this->api_model->query_build($query);
			$total_yours = ($count[0]['total_cr']);
			$your_share = $total_yours;
			$company_share = $count[0]['total_dr'] - $account_summary_online[0]['amount'];
			//$count[0]['total_cr'] = $count[0]['total_cr'] - $account_summary[0]['amount'];
			$count[0]['count'] =  $count[0]['count'] + $account_summary[0]['count'] + $account_summary_online[0]['count'];
			if($count[0]['total_dr'] != 0 && $count[0]['total_cr'] != 0){
				if($company_share > $your_share){
					$count[0]['total_cr'] = $company_share - $your_share;
				}else{
					if($your_share > $company_share){
						$count[0]['total_dr'] = $company_share - $account_summary[0]['amount'];
						$count[0]['total_cr'] = $your_share - $account_summary[0]['amount'];
					}else{
						$count[0]['total_dr'] = '0';
						$count[0]['total_cr'] = '0';
					}
				}
			}
			if($count[0]['total_dr'] != 0 && $count[0]['total_cr'] != 0){
				if($count[0]['total_cr'] >= $count[0]['total_dr']){
					$settled_amount = $count[0]['total_dr'];
				}else{
					$settled_amount =  $count[0]['total_cr'];
				}
				$log['users_id'] = $data[0]['vt_id'];
				$log['currency'] = 'INR';
				$log['type'] = '31';
				$log['amount'] = ($settled_amount) * 100;
				$log['user_type'] = '1';
				$log['payment_type'] = 'Dr';
				$log['premium_bull_type'] = '';
				$log['request_status'] = '0';
				$log['date'] = date('Y-m-d h:i:s');
				$log_id = $this->api_model->insert_log_data($log);
				$data_st['payment_type'] = '31';
				$data_st['users_id'] = $data[0]['vt_id'];
				$data_st['log_id'] = $log_id[0]['purchase_id'];
				$data_st['users_type'] = '1';
				$data_st['status'] = 'Dr';
				$data_st['company_status'] = 'Cr';
				$data_st['amount'] = $settled_amount;
				$data_st['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('company_settlement_account', $data_st);
			}
			$json['data'] = $data;
			$json['msg'] = "AI has been successfully done";
			$json['success']  = TRUE; 	
		}else{
			$json['success']  = false; 
			$json['error'] = "Otp Not Matched Please Try";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
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
	public function get_payment_details(){
		$data = $this->api_model->payment_details();
		if($data){
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
	public function mastitis(){
		$data['animal_id'] = $this->input->get_post('animal_id');
		$data['animal_id'] = $this->input->get_post('animal_id');
		$data['strip_photo'] = $this->input->get_post('strip_photo');
		$data['created_time'] = $this->input->get_post('created_time');
		$data['doctor_id'] = $this->input->get_post('doctor_id');	
		$data['comments'] = $this->input->get_post('comments');	
		$data['latitude'] = $this->input->get_post('latitude');
		$data['longitude'] = $this->input->get_post('longitude');
		$data['address'] = $this->input->get_post('address');
		$data['record_date'] = $this->input->get_post('record_date');
		$data['date'] = date('Y-m-d');
		if(!isset($data['animal_id']) || $data['animal_id'] == ''){
			$json['success']  = false; 
			$json['error'] = "Please send  animal Id";
		}else
		if($this->api_model->submit('animal_mastitas', $data)){
				$json['success']  = True; 
				$json['msg'] = "Your Record is Successfully Submitted";
			}else{
				$json['success']  = false; 
				$json['error'] = "Database error";
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function get_mastitis_details(){
		$animal_id = $this->input->get_post('animal_id');
		if(!isset($animal_id) || $animal_id == ''){
			$json['sucees'] = false;
			$json['msg'] = 'Please send Animal Id';
		}else{
		$data = $this->api_model->get_data('animal_id = '.$animal_id.'','animal_mastitas','','*,CONCAT("https://amazebrandlance.com/uploads/mastitis/",strip_photo) as strip_photo');
		if($data){
			$json['success']  = true; 
			$json['data']  = $data; 
		}else{
			$json['success']  = false; 
			$json['error']  = 'Currently You do not have any report available for this animal'; 
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_vehicals_details(){
		$data = $this->api_model->get_data('is_activated = "1"','vehicals_type','','*,CONCAT("https://www.livestoc.com/harpahu_merge_dev/uploads/category/",image) as image');
		if($data){
			$json['success']  = true; 
			$json['data']  = $data; 
		}else{
			$json['success']  = false; 
			$json['error']  = 'No Vehicals Found.'; 
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;		
	}	
	public function delivery_partner_checkin_status(){
		$id = $this->input->get_post('id');
		$delivery_partner = $this->input->get_post('delivery_partner');
		$data['start_point_latitude'] = $this->input->get_post('latitude');
		$data['start_point_longitude'] = $this->input->get_post('longitude');
		$delivery_partner_status = $this->input->get_post('delivery_partner_status');
		if($id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Order ID';
		}else if($delivery_partner == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Delivery Partner ID';
		}else if($delivery_partner_status == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send Delivery Partner Status';
		}else{
			if($delivery_partner_status == '0'){
				$data['delivery_partner_status'] = $delivery_partner_status;
				if($this->api_model->update('id', $id, 'product_order', $data)){
					$json['success']  = True; 
					$json['msg'] = "Your login status update";
				}else{
					$json['success']  = false; 
					$json['error'] = "Database error";
				}
			}$detail = $this->api_model->get_data('id = "'.$id.'" AND isactive IN ("1","2","7")' ,'product_order','','*');
			if(!empty($detail)){
				$details = $this->api_model->get_data('delivery_partner = "'.$delivery_partner.'" AND delivery_partner_status = "'.$delivery_partner_status.'"' ,'product_order','','*');
				// print_r($details);
				// exit;
				$data['delivery_partner_status'] = $delivery_partner_status;
				$data['isactive'] = '3';
				if(empty($details)){
					if($this->api_model->update('id', $id, 'product_order', $data)){
						$json['success']  = True; 
						$json['msg'] = "Your login status update";
					}else{
						$json['success']  = false; 
						$json['error'] = "Database error";
					}
				}else{
					$json['success']  = false; 
					$json['error'] = "You are already checked in with other Order";	
				}
			}else{
					$json['success']  = false; 
					$json['error'] = "You can not Checked into in this order";	
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_orderlatlong($id){
		$id = $this->input->get_post('id');
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');
		$date = $this->input->get_post('date');
		if($id == ''){
			$json['success']  = False; 
			$json['error'] = 'Please Send User ID';
		}else{
				$where = '';
				$status = $this->input->get_post('status');
				$order = 'order by id DESC';
				if($status != ''){
						$where .= 'AND pro.isactive = "'.$status.'"';
				}else{
					$where .= 'AND pro.isactive NOT IN ("0","4","5")';
				}
				$start = $this->input->get_post('start');
				$perpage = '1000';
				if($start != ''){
					$limit = 'LIMIT '.$start.', '.$perpage.'';
				}
				if($date != ''){
					$where .= ' AND schedul_date = "'.$date.'"';
				}
				if($latitude != ''){
					$select = "((((acos(sin((".$latitude."*pi()/180)) * sin((pro.latitude*pi()/180)) + cos((".$latitude."*pi()/180)) * cos((pro.latitude*pi()/180)) * cos(((".$longitude."- pro.longitude)*pi()/180)))) * 180/pi()) * 60 * 1.1515) * 1.60934)  AS distance, ";
					$order = 'ORDER BY distance';
				}
				$admin_data = $this->api_model->get_data('admin_id = "'.$id.'"', 'admin');
				//print_r($admin_data);
				if($admin_data[0]['type'] != '18'){
					if($order = $this->api_model->query_build('SELECT `id`, `product_qty`, `date` as `order_date`,  schedul_date, '.$select.'  pro.latitude as user_latitude, pro.longitude as user_longitude FROM `product_order` as `pro` WHERE  FIND_IN_SET('.$id.', delivery_partner) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.' '.$order.' '.$limit.'')){
						$count = $this->api_model->query_build('SELECT count(id) as count FROM `product_order` as `pro` WHERE FIND_IN_SET('.$id.', delivery_partner) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.'');
						$detail = [];
						$i = 0;
						
						$json['success']  = True; 
						$json['data'] = $order;
						$json['count'] = $count[0]['count'];
					}else{
						$json['success']  = False; 
						$json['error'] = 'No Order Found';
					}
				}else{
				if($order = $this->api_model->query_build('SELECT `id`, `product_qty`, `date` as `order_date`,  schedul_date, '.$select.'   delivery_partner, pro.latitude as user_latitude, pro.longitude as user_longitude FROM `product_order` as `pro` WHERE  FIND_IN_SET('.$id.', delivery_partner) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.' '.$order.' '.$limit.'')){
						$count = $this->api_model->query_build('SELECT count(id) as count FROM `product_order` as `pro` WHERE FIND_IN_SET('.$id.', delivery_partner) AND (select id from product_order_rejection_log where order_id = pro.id and vendor_id = '.$id.') IS NULL '.$where.'');
						$detail = [];
						$i = 0;
						
						$json['success']  = True; 
						$json['data'] = $order;
						$json['count'] = $count[0]['count'];
					}else{
						$json['success']  = False; 
						$json['error'] = 'No Order Found';
					}
				}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_near_by_ai_worker(){
		$lat = $this->input->get_post('latitude');
		$lang = $this->input->get_post('langitude');
		$bull_id = $this->input->get_post('bull_id');
		$daughter_yield_to = $this->input->get_post('daughter_yield_to');
		$daughter_yield_from = $this->input->get_post('daughter_yield_from');
		$price_to = $this->input->get_post('price_to');
		$price_from = $this->input->get_post('price_from');
		$price_order = $this->input->get_post('price_order');
		$start = $this->input->get_post('start');
		if($start ==''){
			$start = 0;
		}
		$milk_type = $this->input->get_post('milk_type');	
		$breed_id = $this->input->get_post('breed_id');
		$category_id = $this->input->get_post('category_id');
		$perpage = 500;
		$where = '';
		$order_by = '';
		if($daughter_yield_to != ''){
			$where .= " AND bull.daughter_yield BETWEEN '".$daughter_yield_from."' AND '".$daughter_yield_to."'";
		}
		if($price_to != ''){
			$where .= " AND st.farmer_price BETWEEN '".$price_to."' AND '".$price_from."'";
		}
		if($bull_id != ''){
			$where .= " AND st.bull_id = '".$bull_id."'";
		}
		if($milk_type != ''){
			$where .= " AND bull.milk_type = '".$milk_type."'";
		}
		if($breed_id != ''){
			$where .= " AND bull.bread = '".$breed_id."'";
		}
		if($category_id != ''){
			$where .= " AND bull.category = '".$category_id."'";
		}
		if($price_order != ''){
			if($price_order == '1'){
				$order_by = 'st.farmer_price ASC';
			}else{
				$order_by = 'st.farmer_price DESC';
			}
		}else{
			$order_by = 'distance ASC';
		}
		$data = $this->api_model->query_build("select do.ai_visiting_fee,do.refral_code,do.city,do.state,do.doctor_id, do.username,do.email, do.total_experience, do.image, if((select GROUP_CONCAT(id) as id from vt_requests where vt_id = do.doctor_id AND treat_type = '3' AND status = '4') IS NOT NULL, 1,0) as status, (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from current_loc as cl, doctor as do where do.doctor_id = cl.doctor_id AND do.users_type IN ('pvt_ai', 'pvt_vt')  AND do.isactivated = '1' ".$where."  ORDER BY ".$order_by." LIMIT ".$start.", ".$perpage."");
		// $count = $this->api_model->query_build("select DISTINCT st.bull_id as id, count(st.bull_id) as count,  (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from seman_stock as st, current_loc as cl, doctor as do, bull_table as bull where bull.id  = st.bull_id AND st.admin_id = cl.doctor_id AND do.doctor_id = st.admin_id AND do.users_type IN ('pvt_ai', 'pvt_vt') AND is_update = '1' AND do.isactivated = '1' ".$where."  ORDER BY ".$order_by." LIMIT ".$start.", ".$perpage."");
		// print_r($data);
		// exit;
		if(!empty($data)){
		// exit;
		// if($data = $this->api_model->get_ai_doc_stoc('pvt_ai, pvt_vt', $lang, $lat, $bull_id)){
				foreach($data as $d){
					$degree = $this->api_model->get_doc_degree($d['doctor_id']);
					$no_of_ai_done =  $this->api_model->get_data('vt_id = '.$d['doctor_id'].' AND status = "4" ', 'vt_requests', '','count(id) count');
					$d['qualification'] = $degree == false ? [] : $degree;
					$d['image'] = base_url().'uploads/doc/'.$d['image'];
					$d['no_of_ai'] = $no_of_ai_done[0]['count'];
					$d['succes_ai'] = '';
					$d['succes_rate'] = '';
					$d['rating'] = '';
					$d['total_price'] =  $price;
					$da[] = $d;
				}
				$data = $da;
				$json['success']  = true; 
				$json['data'] = $data;
				//$json['count'] = $count[0]['count'];
			}else{
				$json['success']  = false; 
				if($start > 0){
					$json['error'] = "No more Data found.";
				}else{
					$json['error'] = "Sorry, our AI services are not available in your area presently. Coming soon. Please call 1800 102 0379 for more information.";
				}
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function admin_bank_datil_update(){
		$admin_id = $this->input->get_post('admin_id');
		$data['admin_id'] = $admin_id;
		$data['bank_name'] = $this->input->get_post('bank_name');
		$data['branch_address'] = $this->input->get_post('branch_address');
		$data['ifsc_code'] = $this->input->get_post('ifsc_code');
		$data['account_no'] =  $this->input->get_post('account_no');
		$data['date'] = date('Y-m-d');
		$data['account_holder_name'] = $this->input->get_post('account_holder_name');	
		if($this->api_model->get_data('admin_id = "'.$admin_id.'"', 'admin_account_details')){
			$detail = $this->api_model->update('admin_id', $admin_id, 'admin_account_details', $data);
			$json['success']  = True; 
			$json['msg'] = "Your Bank Detail Successfully Submitted";
		}else
		if($this->api_model->submit('admin_account_details', $data)){
				$json['success']  = True; 
				$json['msg'] = "Your Bank Detail Successfully Submitted";
			}else{
				$json['success']  = false; 
				$json['error'] = "Database error";
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function admin_bank_datil(){
		$admin_id = $this->input->get_post('admin_id');
		$data = $this->api_model->get_data('admin_id = "'.$admin_id.'"', 'admin_account_details');
		if($data){
			$json['success'] = true;
			$json['data'] = $data;
		}else{
			$json['success'] = false;
			$json['error'] = "Please update your bank details.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function animals_sell_details(){
		$seller_id = $this->input->get_post('seller_id');
		$buyer_id = $this->input->get_post('buyer_id');
		$product_id = $this->input->get_post('product_id');
		$purpose = $this->input->get_post('purpose');
		$action = $this->input->get_post('action');
		if($seller_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send Seller id";
		}else if($buyer_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Byer Id";
		}else{
			$data['seller_id'] = $seller_id;
			$data['buyer_id'] = $buyer_id;
			$data['product_id'] = $product_id;
			$data['purpose'] = $purpose;
			$data['action'] = $action;
			$data['date'] = date('Y-m-d h:i:s');
			if($this->api_model->submit('animal_sell_details', $data)){
				$json['success']  = True; 
				$json['msg'] = "your animal sell";
			}else{
				$json['success']  = false; 
				$json['error'] = "Database error";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_animals_sell_details(){
		$seller_id = $this->input->get_post('seller_id');
		$buyer_id = $this->input->get_post('buyer_id');
		$product_id = $this->input->get_post('product_id');
		$purpose = $this->input->get_post('purpose');
		$action = $this->input->get_post('action');
		$data = $this->api_model->query_build("SELECT DISTINCT an.buyer_id, an.seller_id,an.purpose,an.action,(Select CONCAT('https://www.livestoc.com//uploads_new/profile/thumb/', image) from users where users_id = an.buyer_id) as image, (select full_name from users where users_id = an.buyer_id) as name, (select mobile from users where users_id = an.buyer_id) as mobile FROM animal_sell_details as an WHERE (seller_id  = '".$seller_id."') and (action ='".$action."' or purpose = '".$purpose."')");
		// $data = $this->api_model->get_data('buyer_id = "'.$buyer_id.'" AND action = "'.$action.'"', 'animal_sell_details as an','', 'DISTINCT an.buyer_id, an.seller_id,an.purpose,an.action,(Select CONCAT("https://www.livestoc.com//uploads_new/profile/thumb/", image) from users where users_id = an.buyer_id) as image, (select full_name from users where users_id = an.buyer_id) as name, (select mobile from users where users_id = an.buyer_id) as mobile');
		if($data){
			$json['success'] = true;
			$json['data'] = $data;
		}else{
			$json['success'] = false;
			$json['error'] = "Database Error.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function app_resent_use(){
		$users_id = $this->input->get_post('users_id');
		$data['services'] = $this->input->get_post('service');
		$data['user_type'] = $this->input->get_post('user_type');
		$data['app_type'] = $this->input->get_post('app_type');
		$data['date']     = date('Y-m-d H:i:s');
		if($users_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send Seller id";
		}
		$data['users_id'] = $users_id;
		if($this->api_model->submit('app_services_used',$data)){
			$json['success'] = true;
			$json['msg'] = 'Data inserted';
		}else{
			$json['success'] = false;
			$json['error'] = 'Database Error';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
	public function app_servicess_used(){
		$users_id = $this->input->get_post('users_id');
		$data['services'] = $this->input->get_post('service');
		$data['user_type'] = $this->input->get_post('user_type');
		$data['app_type'] = $this->input->get_post('app_type');
		$data['date']     = date('Y-m-d H:i:s');
		if($users_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send users id";
		}
		$data['users_id'] = $users_id;
		if($this->api_model->submit('app_services_used',$data)){
			$json['success'] = true;
			$json['msg'] = 'Data inserted';
		}else{
			$json['success'] = false;
			$josn['error'] = 'Database Error';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_app_service(){
		$data = $this->api_model->get_data('is_activated = "1"', 'app_service');
		if($data){
			$json['success'] = true;
			$json['data'] = $data;
		}else{
			$json['success'] = false;
			$josn['error'] = 'Database Error';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}	
}