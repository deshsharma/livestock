<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		$this->load->model('loginmodel');
		$this->load->model('pushnoti_model');
		$this->load->model('Admin_detail');
	}

	public function test_call_api(){
		$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://etsrds.kapps.in/webapi/enterprise/v1/makecall.py",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "{\n  \"k_number\": \"+916366783212\",\n  \"agent_number\": \"+919918990731\",\n  \"customer_number\": \"+917007692445\",\n  \"caller_id\": \"+918047248869\"\n}",
			  CURLOPT_HTTPHEADER => array(
			    "authorization: 95d4c58b-80a1-4e75-bf78-5970a52d0c11",
			    "cache-control: no-cache",
			    "postman-token: d1a26172-8518-0705-d546-c464d3303c9f",
			    "x-api-key: nDRUngYws3739teklCMYp9IufbQ8qjf212iyMkiG"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}

	}
	public function product_invoice($id){
		$data['data'] = $this->api_model->get_data('id = '.$id.'', 'product_order');
		//print_r($data);
		$this->load->view('admin/product_invoice', $data);
	}
	//appends all error messages
    private function handle_error($err) {
        $this->error .= $err . "\r\n";
    }

    //appends all success messages
    private function handle_success($succ) {
        $this->success .= $succ . "\r\n";
    }
	public function upload_vedio(){
			$path = $this->input->get_post('path');
		//set preferences
            //file upload destination
            $upload_path = '/var/www/html/uploads/'.$path.'/';
            $config['upload_path'] = $upload_path;
            //allowed file types. * means all types
            $config['allowed_types'] = 'wmv|mp4|avi|mov|WebM|Ogg';
            //allowed max file size. 0 means unlimited file size
            $config['max_size'] = '0';
            //max file name size
            $config['max_filename'] = '255';
            //whether file name should be encrypted or not
            $config['encrypt_name'] = FALSE;
            //store video info once uploaded
            $video_data = array();
            //check for errors
            $is_file_error = FALSE;
            //check if file was selected for upload
            if (!$_FILES) {
                $is_file_error = TRUE;
                $this->handle_error('Select a video file.');
            }
            //if file was selected then proceed to upload
            if (!$is_file_error) {
                //load the preferences
                $this->load->library('upload', $config);
                //check file successfully uploaded. 'video_name' is the name of the input
                if (!$this->upload->do_upload('image')) {
                    //if file upload failed then catch the errors
                    $this->handle_error($this->upload->display_errors());
                    $is_file_error = TRUE;
                } else {
                    //store the video file info
                    $video_data = $this->upload->data();
                }
            }
            // There were errors, we have to delete the uploaded video
            if ($is_file_error) {
                if ($video_data) {
                    $file = $upload_path . $video_data['file_name'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            } else {
                $data['video_name'] = $video_data['file_name'];
                $data['video_path'] = $upload_path;
                $data['video_type'] = $video_data['file_type'];
                $this->handle_success('Video was successfully uploaded to direcoty <strong>' . $upload_path . '</strong>.');
            }
        //load the error and success messages
        $data['errors'] = $this->error;
        $data['success'] = $this->success;
		echo json_encode($data);
		exit;
	}
	public function animal_view(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['cat_id'] = $this->input->get_post('cate_id');
		$data['breed_id'] = $this->input->get_post('breed_id');
		$data['animale_id'] = $this->input->get_post('animale_id');
		$data['perpose'] = $this->input->get_post('perpose');
		$data['created_on'] = date('Y-m-d h:i:s');
		if($this->api_model->submit('animal_view', $data)){
			$json['success']  = true; 
		}else{
			$json['success']  = false; 
			$json['error'] = 'Database Error';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function lead_dealer_breader(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['lead_user_id'] = $this->input->get_post('lead_user_id');
		$data['perposs'] = $this->input->get_post('perposs');
		$data['type'] = $this->input->get_post('type');
		$data['status'] = '0';
		$data['created_on'] = date('Y-m-d h:i:s');
		$user = $this->api_model->get_user_info_id($data['lead_user_id']);
		$user_lead = $this->api_model->get_user_info_id($data['users_id']);
		if(!$this->api_model->get_data('users_id = "'.$data['users_id'].'" AND lead_user_id = "'.$data['lead_user_id'].'"' , 'lead_breader_dealer', '', '*')){
			if($this->api_model->submit('lead_breader_dealer', $data)){
				$json['success']  = true; 
				$json['msg'] = 'Thanks, '.$user[0]['full_name'].' will contact you soon.';
				$msg['message'] = ''.$user_lead[0]['full_name'].' contact you';
				$msg['users_id'] = $data['lead_user_id'];
				$msg['type'] = 1;
				$msg['title'] = "Lead";
				$msg['date'] = date('Y-m-d h:i:s');
				$this->pushnoti_model->insert_noti($msg);
				$msg['flag'] = 1;
				$this->push_non($msg['users_id'], 1 , $msg['title'],  $msg['flag'], $msg['message'], $msg['title']);
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}else{
			$json['success']  = flase; 
			$json['error'] = 'Your request to connect, has been already sent.';
		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_lead_breader_dealer(){
		$user_id = $this->input->get_post('users_id');
		$status = $this->input->get_post('status');
		if($data = $this->api_model->get_lead_dealer_breader($user_id, $status)){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = flase; 
			$json['error'] = 'Currently, You do not have any leads in your account';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function push_non_new($user_id, $type , $title, $flag = 0, $msg){
		if($type == 1){
			$detail = $this->api_model->get_fcm_doc($user_id);
			$server_key = PARAVATE_SERVERKEY;
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
	public function get_breed_name(){
		$name = $this->input->get_post('name');
		$category = $this->input->get_post('category');
		if($data = $this->api_model->get_breed_name($name, $category)){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = 'No Data Found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_lab_detail(){
		$id = $this->input->get_post('id');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		if($data = $this->api_model->get_lab_detail($id, $latitude, $langitude)){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = 'We are in process of updating the listings please check after 48 Hrs.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function make_free_breeder(){
                $users_id = $this->input->get_post('users_id');
                $category = $this->input->get_post('category');
                $bread = $this->input->get_post('bread');
                $user_type = $this->input->get_post('user_type');
                $state_id = $this->input->get_post('state_id');
                $district_id = $this->input->get_post('district_id');
                $latitude = $this->input->get_post('latitude');
                $longitude = $this->input->get_post('longitude');
                $address = $this->input->get_post('address');
                $city = $this->input->get_post('city');
                $state = $this->input->get_post('state');
                $district = $this->input->get_post('district');
                $farm_name = $this->input->get_post('farm_name');
                $contact_person = $this->input->get_post('contact_person');
                $contact_phone = $this->input->get_post('contact_phone');
                if($user_type == "15"){
                    $u_type = "5";
                }
                if($user_type == "16"){
                    $u_type = "4";
                }
                $data['dealer_cat_id'] = $category;
                $data['dealer_bread_id'] = $bread;
                $data['dealer_state_id'] = $state_id;
                $data['dealer_city_id'] = $district_id;
                $data['users_type_id'] = $u_type;
                $data['latitude'] = $latitude;
                $data['longitude'] = $longitude;
                $data['address'] = $address;
                $data['breeder_city'] = $city;
                $data['state'] = $state;
                $data['district'] = $district;
                $data['farm_name'] = $farm_name;
                $data['contact_person'] = $contact_person;
                $data['contact_phone'] = $contact_phone;
                $data['breader_type'] = '0';
                $data['is_premium'] = '0';
                if($this->api_model->update('users_id', $users_id, 'users', $data)){
                	$json['success'] = true;
                	if($u_type == "5")
                		$msg = 'Thanks, You are successfully upgraded to breeder';
                	else
                		$msg = 'Thanks, You are successfully upgraded to dealer';
		        	$json['msg'] = $msg;
                }else{
                	$json['success'] = false;
		        	$json['error'] = 'Database Error.';
                }
		        header('Content-Type: application/json');
				echo json_encode($json);
				exit;
                
	}
	public function make_cod(){
		$purchase_id = $this->input->get_post('purchase_id');
		$reg_no = $this->input->get_post('reg_no');
        //$update['payment_type'] = 'Dr';
        $update['request_status'] = '2';
        $update['date'] = date('Y-m-d H:i:s');
        $this->api_model->update('id', $purchase_id, 'log_file', $update);
        $lab['ispaid'] = '0';  
        $lab['log_id'] = $purchase_id; 
        $this->api_model->update('id', $reg_no, 'lab_request', $lab);
        $users_id = $this->input->get_post('users_id');
        $amount = $this->input->get_post('wallet_balance_consume');
        if($amount > 0){
        	$data['type'] = '24'; 
        	$data['users_id'] = $users_id;
        	$data['amount'] = $amount;
        	$data['status'] = 'Dr';
        	$data['wallet_type'] = '1';
        	$data['date'] = date('Y-m-d H:i:s');
        	$this->api_model->submit('livestoc_wallets', $data);
        }
        $json['success'] = true;
        $json['msg'] = 'Your request has been submitted successfully. We will contact you shortly.';
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_free_lbig(){
		$data['address'] = $this->input->get_post('address');
        $data['latitude'] = $this->input->get_post('latitude');
        $data['longitude'] = $this->input->get_post('longitude');
        $data['contact_name'] = $this->input->get_post('contact_name');
        $data['contact_number'] = $this->input->get_post('contact_number');              
        $data['semen_price'] = $this->input->get_post('semen_price');
        $data['users_id'] = $this->input->get_post('users_id');                
        $data['avg_milk_proteen'] = $this->input->get_post('avg_milk_proteen');
        $data['registration_certificate'] = $this->input->get_post('registration_certificate');
        $data['health_certificate'] = $this->input->get_post('health_certificate');
        $data['championship_images'] = $this->input->get_post('championship_images');
        $data['brochure'] = $this->input->get_post('brochure');
        $data['total_milk_proteen'] = $this->input->get_post('total_milk_proteen');
        $data['total_milk_fat'] = $this->input->get_post('total_milk_fat');
        $data['semen_type'] = $this->input->get_post('semen_type');
        $data['progini_test'] = $this->input->get_post('progini_test');
        $data['milk_type'] = $this->input->get_post('milk_type');
        $data['lat_yield'] = $this->input->get_post('lat_yield');
        $data['is_imported'] = $this->input->get_post('is_imported');
        $data['user_type'] = $this->input->get_post('user_type');
        $data['purchase_id'] = '';
        $animal_id = $this->input->get_post('animal_id');
        $animal_id = json_decode($animal_id, true);
        foreach($animal_id as $ani){
           	$data['animal_id'] = $ani;
           	$this->api_model->submit('package_users_dog', $data);
           	$dat['meating_payment_status'] = '0';
           	$dat['latitude'] = $data['latitude'];
           	$dat['longitude'] = $data['longitude'];
           	$this->api_model->update('animal_id', $ani, 'animals', $dat);
        }
        $json['success'] = true;
		$json['msg'] = 'Your bull is successfully placed in Champion Bull listing.';
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;  
	}
	public function get_free_knin(){
		 		$users_id = $this->input->get_post('users_id');
                $category = $this->input->get_post('category');
                $bread = $this->input->get_post('bread');
                $user_type = $this->input->get_post('user_type');
                $latitude = $this->input->get_post('latitude');
                $longitude = $this->input->get_post('longitude');
                $awb_certificate = $this->input->get_post('awb_certificate');
                $vaccination_certificate = $this->input->get_post('vaccination_certificate');
                $mating_charge = $this->input->get_post('mating_charge');
                $animal_id = $this->input->get_post('animal_id');
                $animal_id = implode(',', json_decode($animal_id));
                $award = $this->input->get_post('award');
                $address = $this->input->get_post('address');
                //$award = explode(',', json_decode($award));
                //$award = implode(',', json_decode($award));
                $name = json_decode($award);
                foreach($name as $na){
                    $var = $na->date;
                    $date = str_replace('/', '-', $var);
                    $date = date('Y-m-d', strtotime($date));
                    $da['animal_id']=$animal_id;
                    $da['award_name']=$na->award_name;
                    $da['date']=$date;
                    $da['event_organized_by']=$na->event_organized_by;
                    $da['image_path']=$na->image_path;
                    $this->api_model->submit('package_users_dog_award', $da);
                    $ani['championship_status'] = '1';
                    $this->api_model->update('animal_id', $animal_id, 'animals', $ani);
                    }
               
                //$mating_charge = $data['payload']['payment']['entity']['notes']['mating_charge'];
                $detail = '';
                if($user_type == "17"){
                    $u_type = "2";
                }
                $data['users_id'] = $users_id;
                $data['user_type'] = $user_type;
                $data['animal_id'] = $animal_id;
                $data['purchase_id'] = $purchase_id;
                $data['package_id'] = '';
                $data['package_type_id'] = '';
                $data['latitude'] = $latitude;
                $data['longitude'] = $longitude;
                $data['awb_certificate'] = $awb_certificate;
                $data['vaccination_certificate'] = $vaccination_certificate;
                $data['mating_charge'] = $mating_charge;
                $data['award'] = '';
                $data['package_subscribed_on'] = date('Y-m-d H:i:s');
                $data['package_expired_on'] = date('Y-m-d H:i:s');
                $this->api_model->submit('package_users_dog',$data);
                $dateUpdate = date("Y-m-d h:i:s");
                $dat['latitude'] = $latitude;
                $dat['longitude'] = $longitude;
                $dat['meeting_flag'] = date("Y-m-d h:i:s");
                $dat['address1'] = $address;
                $dat['meeting_status'] = '1';
                $dat['meating_payment_status'] = '0';
                $this->api_model->update('animal_id', $animal_id, 'animals', $dat);    
                $json['success'] = true;
				$json['msg'] = 'Thanks, Now your Dog is available in our champion dog listing for mating';
				header('Content-Type: application/json');
				echo json_encode($json);
				exit;    
	}
	public function prog_test_lab(){
		$data1['name'] = $this->input->get_post('name');
		$data1['adress'] = $this->input->get_post('address');
		$data1['district'] = $this->input->get_post('district');
		$data1['no_of_sample'] = $this->input->get_post('no_of_sample');
		$data1['farm_name'] = $this->input->get_post('farm_name');
		$data1['state'] = $this->input->get_post('state');
		$data1['pin'] = $this->input->get_post('pin');
		$data1['location'] = $this->input->get_post('location');
		$data1['latitude'] = $this->input->get_post('latitude');
		$data1['langitude'] = $this->input->get_post('langitude');
		$data1['phone'] = $this->input->get_post('phone');
		$data1['city'] = $this->input->get_post('city');
		$data1['users_id'] = $this->input->get_post('users_id');
		$data1['order_date'] = date('Y-m-d h:i:s');
		$users_id = $data1['users_id'];
		$data1['email'] = $this->input->get_post('email');
		//$this->api_model->submit('lab_reg', $data1);
		
		$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		// echo $amount_cr;
		// exit;

		$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
		$a['real_balance'] = $livestoc_balance;
		$amount = LAB_CHARGES;
		$total_amount = LAB_CHARGES * $data1['no_of_sample'];
		$product_rate = $total_amount;
		if($product_rate  != 0){
						if($a['real_balance'] > 0){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$product_rate = 0;
							}else if($a['real_balance'] <= $product_rate){
								$a['real_balance_status'] = 0; 
								$a['real_balance_consume'] = $a['real_balance'];
								$product_rate =  $product_rate - $a['real_balance'];
							}else if($a['real_balance'] >= $product_rate){
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
						$a['real_balance_status'] = 0;
						$a['real_balance_consume'] = 0;
					}  
					$a['balance_actual_payment'] = $product_rate;
		$type = '24';
		// $payment_type = $this->input->get_post('payment_type');
		// $month = $this->input->get_post('month');
		// $tax = $this->input->get_post('tax');
		// $discount = $this->input->get_post('tax');
		// $package_id = $this->input->get_post('package_id');
		$currency = $this->input->get_post('currency');
		$user_type = $this->input->get_post('user_type');
		$request_status  =$this->input->get_post('request_status');
		if($last_id = $this->api_model->submit('lab_request', $data1)){
			//print_r($last_id);
			$data['users_id'] = $users_id;
			$data['currency'] = $currency;
			$data['type'] = $type;
			$data['amount'] = $total_amount;
			$amount_detail[0]['name'] = 'Amount';
			$amount_detail[0]['value'] = $amount;
			$amount_detail[1]['name'] = 'No of Samples';
			$amount_detail[1]['value'] = $data1['no_of_sample'];
			if(!$a['real_balance_consume'] == '0'){
				$amount_detail[2]['name'] = 'Wallet balance used';
				$amount_detail[2]['value'] = $a['real_balance_consume'];
			}
			$amount_detail[3]['name'] = 'Total Amount';
			$amount_detail[3]['value'] = $a['balance_actual_payment'];
			
			// $data['payment_type'] = $payment_type;
			// $data['month'] = $month;
			// $data['package_id'] = $package_id;
			// $data['tax'] = $tax;
			// $data['discount'] = $discount;
			$data['user_type'] = $user_type;
			$data['premium_bull_type'] = '';
			$data['request_status'] = isset($request_status) ? $request_status : 0;
			$data['date'] = date('Y-m-d h:i:s');
			$detail = $this->api_model->insert_log_data($data);
			// print_r($detail);
			// exit;
			$detail[0]['order_id'] = "LVAT_".$detail[0]['purchase_id']."";
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$detail[0]['purchase_id']."&amount=".$a['balance_actual_payment']."&currency=".$currency."",
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
			//print_r(json_decode($response));
			// if ($err) {
			// 	echo "cURL Error #:" . $err;
			// } else {
			// 	print_r(json_decode($response));
			// }
			$detail[0]['razorpayOrderId'] =  json_decode($response);
			$json['success'] = true;
			$json['data'] = $detail;
			$json['payment_detail'] = array_values($amount_detail);
			$json['actual_pay_amount'] = $a['balance_actual_payment'];
			$json['reg_no'] = $last_id;
			$json['wallet_balance_consume'] = $a['real_balance_consume'];
		}else{
			$json['success'] = false;
			$json['error'] = 'Database Problem';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function prog_registration_lab(){
		$data1['name'] = $this->input->get_post('name');
		$data1['adress'] = $this->input->get_post('address');
		$data1['district'] = $this->input->get_post('district');
		$data1['state'] = $this->input->get_post('state');
		$data1['pin'] = $this->input->get_post('pin');
		$data1['location'] = $this->input->get_post('location');
		$data1['latitude'] = $this->input->get_post('latitude');
		$data1['langitude'] = $this->input->get_post('langitude');
		$data1['phone'] = $this->input->get_post('phone');
		$data1['city'] = $this->input->get_post('city');
		$data1['business_name'] = $this->input->get_post('business_name');
		$data1['users_id'] = $this->input->get_post('users_id');
		$users_id = $data1['users_id'];
		$data1['email'] = $this->input->get_post('email');
		//$this->api_model->submit('lab_reg', $data1);
		
		$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		// echo $amount_cr;
		// exit;

		$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
		$a['real_balance'] = $livestoc_balance;
		$amount = LAB_PRICE;
		$tax = ($amount * 18)/100; 
		$total_amount = $tax + $amount;
		$product_rate = $total_amount;
		if($product_rate  != 0){
						if($a['real_balance'] > 0){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$product_rate = 0;
							}else if($a['real_balance'] <= $product_rate){
								$a['real_balance_status'] = 0; 
								$a['real_balance_consume'] = $a['real_balance'];
								$product_rate =  $product_rate - $a['real_balance'];
							}else if($a['real_balance'] >= $product_rate){
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
						$a['real_balance_status'] = 0;
						$a['real_balance_consume'] = 0;
					}  
					$a['balance_actual_payment'] = $product_rate;
		$type = '23';
		// $payment_type = $this->input->get_post('payment_type');
		// $month = $this->input->get_post('month');
		// $tax = $this->input->get_post('tax');
		// $discount = $this->input->get_post('tax');
		// $package_id = $this->input->get_post('package_id');
		$currency = $this->input->get_post('currency');
		$user_type = $this->input->get_post('user_type');
		$request_status  =$this->input->get_post('request_status');
		if($last_id = $this->api_model->submit('lab_reg', $data1)){
			//print_r($last_id);
			$data['users_id'] = $users_id;
			$data['currency'] = $currency;
			$data['type'] = $type;
			$data['amount'] = $total_amount;
			$amount_detail[0]['name'] = 'Amount';
			$amount_detail[0]['value'] = $amount;
			$amount_detail[1]['name'] = 'Tax (GST) %';
			$amount_detail[1]['value'] = '18';
			if(!$a['real_balance_consume'] == '0'){
				$amount_detail[2]['name'] = 'Wallet balance used';
				$amount_detail[2]['value'] = $a['real_balance_consume'];
			}
			$amount_detail[3]['name'] = 'Total Amount';
			$amount_detail[3]['value'] = $a['balance_actual_payment'];
			
			// $data['payment_type'] = $payment_type;
			// $data['month'] = $month;
			// $data['package_id'] = $package_id;
			// $data['tax'] = $tax;
			// $data['discount'] = $discount;
			$data['user_type'] = $user_type;
			$data['premium_bull_type'] = '';
			$data['request_status'] = isset($request_status) ? $request_status : 0;
			$data['date'] = date('Y-m-d h:i:s');
			$detail = $this->api_model->insert_log_data($data);
			// print_r($detail);
			// exit;
			$detail[0]['order_id'] = "LVAT_".$detail[0]['purchase_id']."";
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$detail[0]['purchase_id']."&amount=".$a['balance_actual_payment']."&currency=".$currency."",
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
			//print_r(json_decode($response));
			// if ($err) {
			// 	echo "cURL Error #:" . $err;
			// } else {
			// 	print_r(json_decode($response));
			// }
			$detail[0]['razorpayOrderId'] =  json_decode($response);
			$json['success'] = true;
			$json['data'] = $detail;
			$json['payment_detail'] = array_values($amount_detail);
			$json['actual_pay_amount'] = $a['balance_actual_payment'];
			$json['reg_no'] = $last_id;
			$json['wallet_balance_consume'] = $a['real_balance_consume'];
		}else{
			$json['success'] = false;
			$json['error'] = 'Database Problem';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_banners(){
		$banners_type = $this->input->get_post('banners_type');
		$data = $this->api_model->get_banners($banners_type);
		//$data= $this->api_model->get_banner_description();
		foreach ($data as $de) {
			$desc = '';
			// print_r($de);
			// exit;
			$data= $this->api_model->get_banner_description($de['banners_id']);				
			$desc = $data;
			$de['description'] = $desc;
	        $dat[] = $de;
		}
		$json['success']  = true; 
		$json['data'] = $dat;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	// 	public function get_banners(){
	// 	$banners_type = $this->input->get_post('banners_type');
	// 	$data = $this->api_model->get_banners($banners_type);
	// 	$json['success']  = true; 
	// 	$json['data'] = $data;
	// 	header('Content-Type: application/json');
	// 	echo json_encode($json);
	// 	exit;
	// }
	public function get_call(){
		$data['request'] = $_REQUEST;
		$this->api_model->submit('dommy',$data);
		exit;
	}
	public function get_after_call(){
		$data['request'] = $_REQUEST;
		$this->api_model->submit('dommy',$data);
		exit;
	}
	public function doctor_call_rating(){
		$doctor_id = $this->input->get_post('doctor_id');
		if(!isset($_REQUEST['doctor_id']) || $_REQUEST['doctor_id'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please send doctor id';
		}else{
			$detail = $this->api_model->doctor_call_rating($doctor_id);
			if(empty($detail)){
				$json['success'] = false;
				$json['error'] = 'No reviews found.';

			}else{
				$json['success'] = true;
				$json['data'] = $detail;
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function doc_call_rating_insert(){
		$data['doctor_id'] = $this->input->get_post('doctor_id');
		$data['users_id'] = $this->input->get_post('users_id');
		$data['rating'] = $this->input->get_post('rating');
		$data['feedback'] = $this->input->get_post('feedback');
		$data['created_on'] = date('Y-m-d H:i:s');
		if(!isset($_REQUEST['doctor_id']) || $_REQUEST['doctor_id'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please send doctor id';
		}else if (!isset($_REQUEST['users_id']) || $_REQUEST['users_id'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please send users id';
		}else if (!isset($_REQUEST['rating']) || $_REQUEST['rating'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please send rating';
		}
		// else if (!isset($_REQUEST['feedback']) || $_REQUEST['feedback'] == ''){
		// 	$json['success'] = false;
		// 	$json['error'] = 'Please send feedback';
		// }
		else{
			if($this->api_model->submit('doctor_call_rating',$data)){
				$json['success']  = true; 
				$json['msg'] ='Your Rate and Reviews has been successfully submitted.';
			}else{
				$json['success']  = true; 
				$json['error'] = 'Database Error';
			}
		}		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_mobile_status()
	{
		$mobile = $this->input->get_post('mobile');
		if($data = $this->api_model->get_data('mobile = "'.$mobile.'"',  'users', '', '*')){
			$data['succ'] = $data;
		}else{
			$data['succ'] = 0;
		}
		echo json_encode($data);
	}
	public function animal_edit(){
		$animal_id = $this->input->get_post('animal_id');
		
		$data['users_type_id'] = $this->input->get_post('users_type_id');
		$data['category_id'] = $this->input->get_post('category_id');
		$data['breed_id'] = $this->input->get_post('breed_id');
		$data['isactivated'] = $this->input->get_post('isactivated');
		$data['animal_purpose'] = $this->input->get_post('animal_purpose');
		$data['tag_no'] = $this->input->get_post('tag_no');
		$data['fullname'] = $this->input->get_post('fullname');
		$data['gender'] = $this->input->get_post('gender');
		$data['castration'] = $this->input->get_post('castration');
		$data['lactation'] = $this->input->get_post('lactation');
		$data['price'] = $this->input->get_post('price');
		$data['lactation'] = $this->input->get_post('lactation');
		$data['last_calving_occured'] = $this->input->get_post('last_calving_occured');
		$data['milking_status'] = $this->input->get_post('milking_status');
		$data['peak_milk_yield'] = $this->input->get_post('peak_milk_yield');
		$data['sex_of_calf'] = $this->input->get_post('sex_of_calf');
		$data['calf_status'] = $this->input->get_post('calf_status');
		$data['inter_calving_period'] = $this->input->get_post('inter_calving_period');
		$data['is_pregnant'] = $this->input->get_post('is_pregnant');
		$data['no_of_males'] = $this->input->get_post('no_of_males');
		$data['no_of_females'] = $this->input->get_post('no_of_females');
		$data['method_of_conception'] = $this->input->get_post('method_of_conception');
		$data['isaccepted'] = $this->input->get_post('isaccepted');
		$data['address1'] = $this->input->get_post('address1');
		$data['state'] = $this->input->get_post('state');
		$data['country'] = $this->input->get_post('country');
		$data['created_on'] = date('Y-m-d h:i:s');

		if(!isset($_REQUEST['animal_id']) || $_REQUEST['animal_id']==''){
			$json['success'] = false;
			$json['error'][] = "Please send animal id";
		}
		// else if (isset($_REQUEST['price']) || $_REQUEST['price'] !='' || !is_null($_REQUEST['price']))
		// 		$data['price'] = $price;
			// print_r($price);
			// exit();
		else{
					
					if($this->api_model->update('animal_id', $animal_id, 'animals', $data)){
						$json['success']  = true; 
						$json['msg'] = 'Your detail has been successfully updated';
					}else{
						$json['success']  = false; 
						$json['error'] = 'Database Error';
						}
		}
		
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function animal_price_update(){
		$animal_id = $this->input->get_post('animal_id');
		$price = $this->input->get_post('price');
		if(!isset($_REQUEST['animal_id']) || $_REQUEST['animal_id']==''){
			$json['success'] = false;
			$json['error'][] = "Please send animal id";
		}else if (!isset($_REQUEST['price']) || $_REQUEST['price']=='') {
				$json['success'] = false;
				$json['error'][] = "Please send animal id";
		}else{
					$data['price'] = $price;
					if($this->api_model->update('animal_id', $animal_id, 'animals', $data)){
						$json['success']  = true; 
						$json['msg'] = 'Your detail has been successfully updated';
					}else{
						$json['success']  = false; 
						$json['error'] = 'Database Error';
						}
		}
		
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function show_hide_doc_meeting(){
		$doctor_id = $this->input->get_post('doctor_id');
		$is_consultation_on = $this->input->get_post('is_consultation_on');
		if(!isset($_REQUEST['doctor_id']) || $_REQUEST['doctor_id']==''){
			$json['success'] = false;
			$json['error'][] = "Please send doctor id";
		}else if (!isset($_REQUEST['is_consultation_on']) || $_REQUEST['is_consultation_on']==''){
			//print_r($is_available_consultation);
				$json['success'] = false;
				$json['error'] = "Please send is available consultation";
		}else{
					$data['is_consultation_on'] = $is_consultation_on;
					if($this->api_model->update('doctor_id', $doctor_id, 'doctor', $data)){
						$json['success']  = true; 
						$json['msg'] = 'Your consultation has been successfully updated';
					}else{
						$json['success']  = false; 
						$json['error'] = 'Database Error';
						}
		}
		
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function get_wallets_transaction(){
		$users_id = $this->input->get_post('users_id');
		$detail = $this->api_model->wallets_transaction($users_id);
		if(empty($detail)){
			$json['success'] = false;
			$json['error'] = 'No record found.';

		}else{
			$json['success'] = true;
			$json['data'] = $detail;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function wallet_test(){

	}
	public function wallet_consume(){
		$users_id = $this->input->get_post('users_id');
		$animal_id = $this->input->get_post('animal_id');
		$livestoc_balence_consume = $this->input->get_post('livestoc_balence_consume');
		$real_balance_consume = $this->input->get_post('real_balance_consume');
		$log_id = $this->input->get_post('log_id');
		if($users_id == ''){
			$json['success'] = Flase;
			$json['error'] = 'Please send User ID';
		}
		else if($animal_id == ''){
			$json['success'] = Flase;
			$json['error'] = 'Please send Animal Id';
		}else if($log_id == ''){
			$json['success'] = Flase;
			$json['error'] = 'Please send Log Id';
		}else{
			if($livestoc_balence_consume != '0'){
			$data['log_id'] = $log_id;
			$data['users_id'] = $users_id;
			$data['animal_id'] = $animal_id;
			$data['amount'] = $livestoc_balence_consume;
			$data['status'] = 'Dr';
			$data['wallet_type'] = '0';
			$data['date'] = date('Y-m-d h:i:s');
			$this->api_model->submit('livestoc_wallets',$data);
			}
			if($real_balance_consume != '0'){
				$data['log_id'] = $log_id;
				$data['users_id'] = $users_id;
				$data['animal_id'] = $animal_id;
				$data['amount'] = $real_balance_consume;
				$data['status'] = 'Dr';
				$data['wallet_type'] = '1';
				$data['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('livestoc_wallets',$data);
			}	
			$json['success'] = true;
			$json['msg'] = 'Your Wallet is Updated';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function call_inisite(){
		$number1 = $this->input->get_post('number1');
		$number2 = $this->input->get_post('number2');
		$number1 = '+91'.$number1;
		$number2 = '+91'.$number2;
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://kpi.knowlarity.com/Basic/v1/account/call/makecall",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\n  \"k_number\": \"+917428513734\",\n  \"agent_number\": \"+917428513734\",\n  \"customer_number\": \"$number1\",\n  \"caller_id\": \"$number2\"\n}",
		  CURLOPT_HTTPHEADER => array(
		    "authorization: b3afc056-9e3f-427a-83e9-cff7727444dc",
		    "cache-control: no-cache",
		    "postman-token: afe93f69-431b-b0c1-db6a-c8f11ab0d317",
		    "x-api-key: qygykJocLq1qvAlJOUP1oMQsH5Jzol5iIT1OJc00"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($err) {
		  echo json_decode($err);
		} else {
		  $res = json_decode($response);
		  //echo json_encode($res);
		  if(isset($res->error)){
		  	$json['error'] = $res->error->message;
		  	$json['success'] = False;
		  }else{
		  	$json['msg'] = 'Please wait you will receive a call shortly';
		  	$json['success'] = true;
		  	//$json['status'] = $res->success->status;
		  }
		  
		  //echo $res->success->call_id;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function call(){
		// $data['request'];
		// $data = $this->api_model->submit('call_test_dummy', $data);
		//  if(isset($data)){
		//   	$json['error'] = 'data base error';
		//   	$json['success'] = False;
		//   }else{
		//   	$json['msg'] = 'Please wait you will receive a call shortly';
		//   	$json['success'] = true;
		//   }		
		// header('Content-Type: application/json');
		// echo json_encode($json);
		// exit;
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://kpi.knowlarity.com/Basic/v1/account/calllog",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_HTTPHEADER => array(
		    "authorization: b3afc056-9e3f-427a-83e9-cff7727444dc",
		    "cache-control: no-cache",
		    "channel: Basic",
		    "content-type: application/json",
		    "end_time: 2020-05-14 12:00:00+05:30",
		    "start_time: 2020-05-13 12:00:00+05:30",
		    "x-api-key: qygykJocLq1qvAlJOUP1oMQsH5Jzol5iIT1OJc00"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	}
	public function purchase_lead_dealer_breader(){
		$users_id = $this->input->get_post('users_id');
		$product_type = $this->input->get_post('product_type');
		$product_rate = $this->input->get_post('product_rate');
		$qty = $this->input->get_post('qty');
		$product_rate = $product_rate * $qty;
		$type = $this->input->get_post('type');
		$premium_bull_type = $this->input->get_post('premium_bull_type');
		$currency = $this->input->get_post('currency');
		$user_type = $this->input->get_post('user_type');
		$request_status  =$this->input->get_post('request_status');
		if(!isset($users_id) && $users_id ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send User ID';
		}
		else if(!isset($product_type) && $product_type ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send Product type';	
		}else{
				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
				//$a['real_balance'] = $livestoc_balance;
				$a['real_balance'] = $real_balance;
				$a['product_consume_rate'] = $product_rate;
				//$a['min_minut'] = CALL_TIME;
				//$a['total_call_by_balance'] = $livestoc_balance/$call_rate;
				//$a['fee_per_minut'] = $call_rate;
				$data['users_id'] = $users_id;
				$data['currency'] = $currency;
				$data['type'] = $type;
				$data['amount'] = $product_rate;
				$data['user_type'] = $user_type;
				$data['premium_bull_type'] = $premium_bull_type;
				$data['request_status'] = isset($request_status) ? $request_status : 0;
				$data['date'] = date('Y-m-d h:i:s');
				$log_id = $this->api_model->insert_log_data($data);
				$a['log_id'] = $log_id[0]['purchase_id'];
				$a['order_id'] = "LVAT_".$a['log_id']."";
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$a['diffrence_amount'] = 0;
								$product_rate = 0;
							}else if($a['real_balance'] <= $product_rate){
								$a['real_balance_status'] = 0; 
								$a['real_balance_consume'] = $product_rate - $a['real_balance'];
								$a['diffrence_amount'] = $product_rate - $a['real_balance_consume'];
								$product_rate =  $product_rate - $a['real_balance'];
							}else if($a['real_balance'] >= $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = $a['real_balance'] - $product_rate;
								$a['diffrence_amount'] = 0; 
								$product_rate = 0;
							}else{
								$a['real_balance_status'] = 0;
								$a['real_balance_consume'] = 0;
								$a['diffrence_amount'] = $product_rate; 
							}

				// }else{
				// 	$a['real_balance_status'] = 0;
				// 	$a['real_balance_consume'] = 0;
				// }
				if($product_rate != 0){
							$curl = curl_init();
							curl_setopt_array($curl, array(
							CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$a['order_id']."&amount=".$product_rate."&currency=".$currency."",
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
							$a['razorpayOrderId'] =  json_decode($response);
					}
					unset($a['amount']);
					$detail[] = $a;
					if(empty($detail)){
						$json['success'] = false;
						$json['error'] = 'Your Wallet is Empty';
						$json['consume'] = '1';
					}else{
						$json['success'] = true;
						$json['data'] = $detail;
						$json['consume'] = '1';
					}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function check_call_wallet_amount(){
		$users_id = $this->input->get_post('users_id');
		$doctor_id = $this->input->get_post('doctor_id');
		$product_type = $this->input->get_post('product_type');
		$type = $this->input->get_post('type');
		$premium_bull_type = $this->input->get_post('premium_bull_type');
		$currency = $this->input->get_post('currency');
		$user_type = $this->input->get_post('user_type');
		$request_status  =$this->input->get_post('request_status');
		if(!isset($users_id) && $users_id ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send User ID';
		}
		if(!isset($product_type) && $product_type ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send Product type';	
		}
		if(!isset($doctor_id) && $doctor_id ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send Doctor ID';
		}else{
				$data = $this->api_model->get_doc_id_det($doctor_id);
				$call_rate = $data['consul_fee'];
				$total_rate = $call_rate * CALL_TIME;
				$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
				$product_info = $this->api_model->get_data('product_type = "'.$product_type.'"', 'product_wallet_price_consume', '', '*');
				$a['real_balance'] = $livestoc_balance;
				$a['livestoc_balence'] = $real_balance;
				$a['product_consume_rate'] = $product_info[0]['product_consume_rate'];
				$a['min_minut'] = CALL_TIME;
				$a['total_call_by_balance'] = $livestoc_balance/$call_rate;
				$a['min_balance'] = $total_rate;
				$product_rate = $total_rate;
				$a['fee_per_minut'] = $call_rate;
				$data['users_id'] = $users_id;
				$data['currency'] = $currency;
				$data['type'] = $type;
				$data['amount'] = $product_rate;
				$data['user_type'] = $user_type;
				$data['premium_bull_type'] = $premium_bull_type;
				$data['request_status'] = isset($request_status) ? $request_status : 0;
				$data['date'] = date('Y-m-d h:i:s');
				$log_id = $this->api_model->insert_log_data($data);
				$a['log_id'] = $log_id[0]['purchase_id'];
				$a['order_id'] = "LVAT_".$a['log_id']."";
					if($a['livestoc_balence'] > 0){
						if($a['livestoc_balence'] == $a['product_consume_rate']){
							$a['livestoc_balence_consume'] = $a['product_consume_rate'];
							$a['livestoc_balence_status'] = 0; 
							$product_rate = $total_rate - $a['product_consume_rate'];
						}else if($a['livestoc_balence'] <= $a['product_consume_rate']){
							$a['livestoc_balence_consume'] = $a['product_consume_rate'];
							$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
							$product_rate = $total_rate - $a['product_consume_rate'];
						}else if($a['livestoc_balence'] >= $a['product_consume_rate']){
							$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
							$a['livestoc_balence_consume'] = $a['product_consume_rate'];
							$product_rate = 0;
						}else{
							$a['livestoc_balence_status'] = 0;
							$a['livestoc_balence_consume'] = 0;
						}
					}else{
						$a['livestoc_balence_status'] = 0;
						$a['livestoc_balence_consume'] = 0;
					} 
					//echo $product_rate; 
					if($product_rate  != 0){
						if($a['real_balance'] > 0){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$product_rate = 0;
							}else if($a['real_balance'] <= $product_rate){
								$a['real_balance_status'] = 0; 
								$a['real_balance_consume'] = $product_rate - $a['real_balance'];
								$product_rate =  $product_rate - $a['real_balance'];
							}else if($a['real_balance'] >= $product_rate){
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
						$a['real_balance_status'] = 0;
						$a['real_balance_consume'] = 0;
					}  
					$a['balance_actual_payment'] = $product_rate;
					if($product_rate != 0){
							$curl = curl_init();
							curl_setopt_array($curl, array(
							CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$a['order_id']."&amount=".$product_rate."&currency=".$currency."",
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
							$a['razorpayOrderId'] =  json_decode($response);
					}
					unset($a['amount']);
					$detail[] = $a;
				if(empty($detail)){
					$json['success'] = false;
					$json['error'] = 'Your Wallet is Empty';
					$json['consume'] = '1';
				}else{
					$json['success'] = true;
					$json['data'] = $detail;
					$json['consume'] = '1';
				}
			}		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
		public function check_prouct_wallet_amount(){
		$users_id = $this->input->get_post('users_id');
		$product_type = $this->input->get_post('product_type');
		$animal_id = $this->input->get_post('animal_id');
		$type = $this->input->get_post('type');
		$premium_bull_type = $this->input->get_post('premium_bull_type');
		$currency = $this->input->get_post('currency');
		$user_type = $this->input->get_post('user_type');
		$request_status  =$this->input->get_post('request_status');
		if(!isset($users_id) && $users_id ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send User ID';
		}
		if(!isset($product_type) && $product_type ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send User ID';	
		}
		if(!isset($animal_id) && $animal_id ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send User ID';
		}else{
			if($this->api_model->get_data('users_id = "'.$users_id.'" AND animal_id = "'.$animal_id.'"',  'livestoc_wallets', '', '*')){
				$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$detail =[];				
				$a['real_balance'] = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
					$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
					$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
					$a['livestoc_balence'] = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
					$product_info = $this->api_model->get_data('product_type = "'.$product_type.'"', 'product_wallet_price_consume', '', '*');
					$a['product_price_rate'] = $product_info[0]['product_price_rate'];
					$product_rate = $a['product_price_rate'];
					$a['product_consume_rate'] = $product_info[0]['product_consume_rate'];
					$data['users_id'] = $users_id;
					$data['currency'] = $currency;
					$data['type'] = $type;
					$data['amount'] = $product_rate;
					$data['user_type'] = $user_type;
					$data['premium_bull_type'] = $premium_bull_type;
					$data['request_status'] = isset($request_status) ? $request_status : 0;
					$data['date'] = date('Y-m-d h:i:s');
					$log_id = $this->api_model->insert_log_data($data);
					$a['log_id'] = $log_id[0]['purchase_id'];
					$a['order_id'] = "LVAT_".$a['log_id']."";
					if($a['livestoc_balence'] > 0){
						if($a['livestoc_balence'] == $a['product_consume_rate']){
							$a['livestoc_balence_consume'] = $a['product_consume_rate'];
							$a['livestoc_balence_status'] = 0; 
							$product_rate = $a['product_price_rate'] - $a['product_consume_rate'];
						}else if($a['livestoc_balence'] <= $a['product_consume_rate']){
							$a['livestoc_balence_consume'] = $a['product_consume_rate'];
							$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
							$product_rate = $a['product_price_rate'] - $a['product_consume_rate'];
						}else if($a['livestoc_balence'] >= $a['product_consume_rate']){
							$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
							$a['livestoc_balence_consume'] = $a['product_consume_rate'];
							$product_rate = 0;
						}else{
							$a['livestoc_balence_status'] = 0;
							$a['livestoc_balence_consume'] = 0;
						}
					}else{
						$a['livestoc_balence_status'] = 0;
						$a['livestoc_balence_consume'] = 0;
					} 
					if($product_rate  != 0){
						if($a['real_balance'] > 0){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$product_rate = 0;
							}else if($a['real_balance'] <= $product_rate){
								$a['real_balance_status'] = 0; 
								$a['real_balance_consume'] = $product_rate - $a['real_balance'];
								$product_rate =  $product_rate - $a['real_balance'];
							}else if($a['real_balance'] >= $product_rate){
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
						$a['real_balance_status'] = 0;
						$a['real_balance_consume'] = 0;
					}  
					$a['balance_actual_payment'] = $product_rate;
					if($product_rate != 0){
							$curl = curl_init();
							curl_setopt_array($curl, array(
							CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$a['order_id']."&amount=".$product_rate."&currency=".$currency."",
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
							$a['razorpayOrderId'] =  json_decode($response);

							//Save livestoc wallets 
							$livestoc_wallets['log_id'] = $log_id[0]['purchase_id'];
							$livestoc_wallets['type'] = $type;
							$livestoc_wallets['users_id'] = $users_id;
							$livestoc_wallets['animal_id'] = $animal_id;
							$livestoc_wallets['amount'] = $product_rate;
							$livestoc_wallets['status'] = 'Dr';
							$livestoc_wallets['wallet_type'] = '1';
							$livestoc_wallets['date'] = date('Y-m-d h:i:s');
							$log_id = $this->api_model->insert_livestoc_wallets($livestoc_wallets);
					}
					unset($a['amount']);
					$detail[] = $a;
				if(empty($detail)){
					$json['success'] = false;
					$json['error'] = 'Your Wallet is Empty';
					$json['consume'] = '1';
				}else{
					$json['success'] = true;
					$json['data'] = $detail;
					$json['consume'] = '1';
				}
			}else{
				$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$detail =[];
				$a['real_balance'] = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
					$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
					$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
					$a['livestoc_balence'] = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
					$product_info = $this->api_model->get_data('product_type = "'.$product_type.'"', 'product_wallet_price_consume', '', '*');
					$a['product_price_rate'] = $product_info[0]['product_price_rate'];
					$product_rate = $a['product_price_rate'];
					$a['product_consume_rate'] = $product_info[0]['product_consume_rate'];
					$data['users_id'] = $users_id;
					$data['currency'] = $currency;
					$data['type'] = $type;
					$data['amount'] = $product_rate;
					$data['user_type'] = $user_type;
					$data['premium_bull_type'] = $premium_bull_type;
					$data['request_status'] = isset($request_status) ? $request_status : 0;
					$data['date'] = date('Y-m-d h:i:s');
					$log_id = $this->api_model->insert_log_data($data);
					$a['log_id'] = $log_id[0]['purchase_id'];
					$a['order_id'] = "LVAT_".$a['log_id']."";
					if($a['livestoc_balence'] > 0){
						if($a['livestoc_balence'] == $a['product_consume_rate']){
							$a['livestoc_balence_consume'] = $a['product_consume_rate'];
							$a['livestoc_balence_status'] = 0; 
							$product_rate = $a['product_price_rate'] - $a['product_consume_rate'];
						}else if($a['livestoc_balence'] <= $a['product_consume_rate']){
							$a['livestoc_balence_consume'] = $a['product_consume_rate']-$a['livestoc_balence'];
							$a['livestoc_balence_status'] = $a['product_consume_rate']-$a['livestoc_balence'];
							$product_rate = $a['product_price_rate'] - $a['livestoc_balence'];
						}else if($a['livestoc_balence'] >= $a['product_consume_rate']){
							$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
							$a['livestoc_balence_consume'] = $a['product_consume_rate'];
							$product_rate = 0;
						}else{
							$a['livestoc_balence_status'] = 0;
							$a['livestoc_balence_consume'] = 0;
						}
					}else{
						$a['livestoc_balence_status'] = 0;
						$a['livestoc_balence_consume'] = 0;
					} 
					if($product_rate  != 0){
						if($a['real_balance'] > 0){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$product_rate = 0;
							}else if($a['real_balance'] <= $product_rate){
								$a['real_balance_status'] = 0; 
								$a['real_balance_consume'] = $product_rate - $a['real_balance'];
								$product_rate =  $product_rate - $a['real_balance'];
							}else if($a['real_balance'] >= $product_rate){
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
						$a['real_balance_status'] = 0;
						$a['real_balance_consume'] = 0;
					} 
					$a['product_actual_payment'] = $product_rate;
					if($product_rate != 0){
							$curl = curl_init();
							curl_setopt_array($curl, array(
							CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$a['order_id']."&amount=".$product_rate."&currency=".$currency."",
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
							$a['razorpayOrderId'] =  json_decode($response);

							
							//Save livestoc wallets 
							$livestoc_wallets['log_id'] = $log_id[0]['purchase_id'];
							$livestoc_wallets['type'] = $type;
							$livestoc_wallets['users_id'] = $users_id;
							$livestoc_wallets['animal_id'] = $animal_id;
							$livestoc_wallets['amount'] = $product_rate;
							$livestoc_wallets['status'] = 'Dr';
							$livestoc_wallets['wallet_type'] = '1';
							$livestoc_wallets['date'] = date('Y-m-d h:i:s');
							$log_id = $this->api_model->insert_livestoc_wallets($livestoc_wallets);
					}
					unset($a['amount']);
					$detail[] = $a;
				// foreach($amount_cr as $a){
					
				// }
				if(empty($detail)){
					$a['real_balance'] = 0;
					$a['livestoc_balence'] = 0;
					$product_info = $this->api_model->get_data('product_type = "'.$product_type.'"', 'product_wallet_price_consume', '', '*');
					$a['product_price_rate'] = $product_info[0]['product_price_rate'];
					$product_rate = $a['product_price_rate'];
					$a['product_consume_rate'] = $product_info[0]['product_consume_rate'];
					$a['product_actual_payment'] = $product_info[0]['product_price_rate'];
					$data['users_id'] = $users_id;
					$data['currency'] = $currency;
					$data['type'] = $type;
					$data['amount'] = $product_rate;
					$data['user_type'] = $user_type;
					$data['premium_bull_type'] = $premium_bull_type;
					$data['request_status'] = isset($request_status) ? $request_status : 0;
					$data['date'] = date('Y-m-d h:i:s');
					$log_id = $this->api_model->insert_log_data($data);
					$a['log_id'] = $log_id[0]['purchase_id'];
					$a['order_id'] = "LVAT_".$a['log_id']."";
					$curl = curl_init();
							curl_setopt_array($curl, array(
							CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$a['order_id']."&amount=".$product_rate."&currency=".$currency."",
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
							$a['razorpayOrderId'] =  json_decode($response);
					$detail[] = $a;
					$json['success'] = true;
					$json['data'] = $detail;
					$json['consume'] = '0';
				}else{
					$json['success'] = true;
					$json['data'] = $detail;
					$json['consume'] = '0';
				}
			}
		}		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	// public function check_prouct_wallet_amount(){
	// 	$users_id = $this->input->get_post('users_id');
	// 	$product_type = $this->input->get_post('product_type');
	// 	$animal_id = $this->input->get_post('animal_id');
	// 	$type = $this->input->get_post('type');
	// 	$premium_bull_type = $this->input->get_post('premium_bull_type');
	// 	$currency = $this->input->get_post('currency');
	// 	$user_type = $this->input->get_post('user_type');
	// 	$request_status  =$this->input->get_post('request_status');
	// 	if(!isset($users_id) && $users_id ==''){
	// 		$json['success'] = false;
	// 		$json['error'] = 'Please Send User ID';
	// 	}
	// 	if(!isset($product_type) && $product_type ==''){
	// 		$json['success'] = false;
	// 		$json['error'] = 'Please Send User ID';	
	// 	}
	// 	if(!isset($animal_id) && $animal_id ==''){
	// 		$json['success'] = false;
	// 		$json['error'] = 'Please Send User ID';
	// 	}else{
	// 		if($this->api_model->get_data('users_id = "'.$users_id.'" AND animal_id = "'.$animal_id.'"',  'livestoc_wallets', '', '*')){
	// 			$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
	// 			$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
	// 			$detail =[];				
	// 			$a['real_balance'] = $a[0]['amount'] - $amount_dr[0]['amount'];
	// 				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
	// 				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
	// 				$a['livestoc_balence'] = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
	// 				$product_info = $this->api_model->get_data('product_type = "'.$product_type.'"', 'product_wallet_price_consume', '', '*');
	// 				$a['product_price_rate'] = $product_info[0]['product_price_rate'];
	// 				$product_rate = $a['product_price_rate'];
	// 				$a['product_consume_rate'] = $product_info[0]['product_consume_rate'];
	// 				$data['users_id'] = $users_id;
	// 				$data['currency'] = $currency;
	// 				$data['type'] = $type;
	// 				$data['amount'] = $product_rate;
	// 				$data['user_type'] = $user_type;
	// 				$data['premium_bull_type'] = $premium_bull_type;
	// 				$data['request_status'] = isset($request_status) ? $request_status : 0;
	// 				$data['date'] = date('Y-m-d h:i:s');
	// 				$log_id = $this->api_model->insert_log_data($data);
	// 				$a['log_id'] = $log_id[0]['purchase_id'];
	// 				$a['order_id'] = "LVAT_".$a['log_id']."";
	// 				if($a['livestoc_balence'] > 0){
	// 					if($a['livestoc_balence'] == $a['product_consume_rate']){
	// 						$a['livestoc_balence_consume'] = $a['product_consume_rate'];
	// 						$a['livestoc_balence_status'] = 0; 
	// 						$product_rate = $a['product_price_rate'] - $a['product_consume_rate'];
	// 					}else if($a['livestoc_balence'] <= $a['product_consume_rate']){
	// 						$a['livestoc_balence_consume'] = $a['product_consume_rate'];
	// 						$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
	// 						$product_rate = $a['product_price_rate'] - $a['product_consume_rate'];
	// 					}else if($a['livestoc_balence'] >= $a['product_consume_rate']){
	// 						$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
	// 						$a['livestoc_balence_consume'] = $a['product_consume_rate'];
	// 						$product_rate = 0;
	// 					}else{
	// 						$a['livestoc_balence_status'] = 0;
	// 						$a['livestoc_balence_consume'] = 0;
	// 					}
	// 				}else{
	// 					$a['livestoc_balence_status'] = 0;
	// 					$a['livestoc_balence_consume'] = 0;
	// 				} 
	// 				if($product_rate  != 0){
	// 					if($a['real_balance'] > 0){
	// 						if($a['real_balance'] == $product_rate){
	// 							$a['real_balance_consume'] = $product_rate;
	// 							$a['real_balance_status'] = 0; 
	// 							$product_rate = 0;
	// 						}else if($a['real_balance'] <= $product_rate){
	// 							$a['real_balance_status'] = 0; 
	// 							$a['real_balance_consume'] = $product_rate - $a['real_balance'];
	// 							$product_rate =  $product_rate - $a['real_balance'];
	// 						}else if($a['real_balance'] >= $product_rate){
	// 							$a['real_balance_consume'] = $product_rate;
	// 							$a['real_balance_status'] = $a['real_balance'] - $product_rate; 
	// 							$product_rate = 0;
	// 						}else{
	// 							$a['real_balance_status'] = 0;
	// 							$a['real_balance_consume'] = 0;
	// 						}
	// 					}else{
	// 						$a['real_balance_status'] = 0;
	// 						$a['real_balance_consume'] = 0;
	// 					}
	// 				}else{
	// 					$a['real_balance_status'] = 0;
	// 					$a['real_balance_consume'] = 0;
	// 				}  
	// 				$a['balance_actual_payment'] = $product_rate;
	// 				if($product_rate != 0){
	// 						$curl = curl_init();
	// 						curl_setopt_array($curl, array(
	// 						CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$a['order_id']."&amount=".$product_rate."&currency=".$currency."",
	// 						CURLOPT_RETURNTRANSFER => true,
	// 						CURLOPT_ENCODING => "",
	// 						CURLOPT_MAXREDIRS => 10,
	// 						CURLOPT_TIMEOUT => 30,
	// 						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 						CURLOPT_CUSTOMREQUEST => "GET",
	// 						CURLOPT_HTTPHEADER => array(
	// 							"Accept: */*",
	// 							"Accept-Encoding: gzip, deflate",
	// 							"Cache-Control: no-cache",
	// 							"Connection: keep-alive",
	// 							"Cookie: PHPSESSID=pd76811dvepd0ao972vfg5abi4; ci_session=pmsh0l1ish4521b781egnuj41galc4uj",
	// 							"Host: www.livestoc.com",
	// 							"Postman-Token: 91f7b6cf-efc3-4c86-a7ec-f27f9e4f829f,ef189fb4-d157-44d2-ba00-804ee44657e4",
	// 							"User-Agent: PostmanRuntime/7.15.2",
	// 							"cache-control: no-cache"
	// 						),
	// 						));
	// 						$response = curl_exec($curl);
	// 						$err = curl_error($curl);
	// 						curl_close($curl);
	// 						$a['razorpayOrderId'] =  json_decode($response);
	// 				}
	// 				unset($a['amount']);
	// 				$detail[] = $a;
	// 			if(empty($detail)){
	// 				$json['success'] = false;
	// 				$json['error'] = 'Your Wallet is Empty';
	// 				$json['consume'] = '1';
	// 			}else{
	// 				$json['success'] = true;
	// 				$json['data'] = $detail;
	// 				$json['consume'] = '1';
	// 			}
	// 		}else{
	// 			$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
	// 			$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
	// 			$detail =[];
	// 			$a['real_balance'] = $a[0]['amount'] - $amount_dr[0]['amount'];
	// 				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
	// 				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
	// 				$a['livestoc_balence'] = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
	// 				$product_info = $this->api_model->get_data('product_type = "'.$product_type.'"', 'product_wallet_price_consume', '', '*');
	// 				$a['product_price_rate'] = $product_info[0]['product_price_rate'];
	// 				$product_rate = $a['product_price_rate'];
	// 				$a['product_consume_rate'] = $product_info[0]['product_consume_rate'];
	// 				$data['users_id'] = $users_id;
	// 				$data['currency'] = $currency;
	// 				$data['type'] = $type;
	// 				$data['amount'] = $product_rate;
	// 				$data['user_type'] = $user_type;
	// 				$data['premium_bull_type'] = $premium_bull_type;
	// 				$data['request_status'] = isset($request_status) ? $request_status : 0;
	// 				$data['date'] = date('Y-m-d h:i:s');
	// 				$log_id = $this->api_model->insert_log_data($data);
	// 				$a['log_id'] = $log_id[0]['purchase_id'];
	// 				$a['order_id'] = "LVAT_".$a['log_id']."";
	// 				if($a['livestoc_balence'] > 0){
	// 					if($a['livestoc_balence'] == $a['product_consume_rate']){
	// 						$a['livestoc_balence_consume'] = $a['product_consume_rate'];
	// 						$a['livestoc_balence_status'] = 0; 
	// 						$product_rate = $a['product_price_rate'] - $a['product_consume_rate'];
	// 					}else if($a['livestoc_balence'] <= $a['product_consume_rate']){
	// 						$a['livestoc_balence_consume'] = $a['product_consume_rate']-$a['livestoc_balence'];
	// 						$a['livestoc_balence_status'] = $a['product_consume_rate']-$a['livestoc_balence'];
	// 						$product_rate = $a['product_price_rate'] - $a['livestoc_balence'];
	// 					}else if($a['livestoc_balence'] >= $a['product_consume_rate']){
	// 						$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
	// 						$a['livestoc_balence_consume'] = $a['product_consume_rate'];
	// 						$product_rate = 0;
	// 					}else{
	// 						$a['livestoc_balence_status'] = 0;
	// 						$a['livestoc_balence_consume'] = 0;
	// 					}
	// 				}else{
	// 					$a['livestoc_balence_status'] = 0;
	// 					$a['livestoc_balence_consume'] = 0;
	// 				} 
	// 				if($product_rate  != 0){
	// 					if($a['real_balance'] > 0){
	// 						if($a['real_balance'] == $product_rate){
	// 							$a['real_balance_consume'] = $product_rate;
	// 							$a['real_balance_status'] = 0; 
	// 							$product_rate = 0;
	// 						}else if($a['real_balance'] <= $product_rate){
	// 							$a['real_balance_status'] = 0; 
	// 							$a['real_balance_consume'] = $product_rate - $a['real_balance'];
	// 							$product_rate =  $product_rate - $a['real_balance'];
	// 						}else if($a['real_balance'] >= $product_rate){
	// 							$a['real_balance_consume'] = $product_rate;
	// 							$a['real_balance_status'] = $a['real_balance'] - $product_rate; 
	// 							$product_rate = 0;
	// 						}else{
	// 							$a['real_balance_status'] = 0;
	// 							$a['real_balance_consume'] = 0;
	// 						}
	// 					}else{
	// 						$a['real_balance_status'] = 0;
	// 						$a['real_balance_consume'] = 0;
	// 					}
	// 				}else{
	// 					$a['real_balance_status'] = 0;
	// 					$a['real_balance_consume'] = 0;
	// 				} 
	// 				$a['product_actual_payment'] = $product_rate;
	// 				if($product_rate != 0){
	// 						$curl = curl_init();
	// 						curl_setopt_array($curl, array(
	// 						CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$a['order_id']."&amount=".$product_rate."&currency=".$currency."",
	// 						CURLOPT_RETURNTRANSFER => true,
	// 						CURLOPT_ENCODING => "",
	// 						CURLOPT_MAXREDIRS => 10,
	// 						CURLOPT_TIMEOUT => 30,
	// 						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 						CURLOPT_CUSTOMREQUEST => "GET",
	// 						CURLOPT_HTTPHEADER => array(
	// 							"Accept: */*",
	// 							"Accept-Encoding: gzip, deflate",
	// 							"Cache-Control: no-cache",
	// 							"Connection: keep-alive",
	// 							"Cookie: PHPSESSID=pd76811dvepd0ao972vfg5abi4; ci_session=pmsh0l1ish4521b781egnuj41galc4uj",
	// 							"Host: www.livestoc.com",
	// 							"Postman-Token: 91f7b6cf-efc3-4c86-a7ec-f27f9e4f829f,ef189fb4-d157-44d2-ba00-804ee44657e4",
	// 							"User-Agent: PostmanRuntime/7.15.2",
	// 							"cache-control: no-cache"
	// 						),
	// 						));
	// 						$response = curl_exec($curl);
	// 						$err = curl_error($curl);
	// 						curl_close($curl);
	// 						$a['razorpayOrderId'] =  json_decode($response);
	// 				}
	// 				unset($a['amount']);
	// 				$detail[] = $a;
	// 			// foreach($amount_cr as $a){
					
	// 			// }
	// 			if(empty($detail)){
	// 				$a['real_balance'] = 0;
	// 				$a['livestoc_balence'] = 0;
	// 				$product_info = $this->api_model->get_data('product_type = "'.$product_type.'"', 'product_wallet_price_consume', '', '*');
	// 				$a['product_price_rate'] = $product_info[0]['product_price_rate'];
	// 				$product_rate = $a['product_price_rate'];
	// 				$a['product_consume_rate'] = $product_info[0]['product_consume_rate'];
	// 				$a['product_actual_payment'] = $product_info[0]['product_price_rate'];
	// 				$data['users_id'] = $users_id;
	// 				$data['currency'] = $currency;
	// 				$data['type'] = $type;
	// 				$data['amount'] = $product_rate;
	// 				$data['user_type'] = $user_type;
	// 				$data['premium_bull_type'] = $premium_bull_type;
	// 				$data['request_status'] = isset($request_status) ? $request_status : 0;
	// 				$data['date'] = date('Y-m-d h:i:s');
	// 				$log_id = $this->api_model->insert_log_data($data);
	// 				$a['log_id'] = $log_id[0]['purchase_id'];
	// 				$a['order_id'] = "LVAT_".$a['log_id']."";
	// 				$curl = curl_init();
	// 						curl_setopt_array($curl, array(
	// 						CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$a['order_id']."&amount=".$product_rate."&currency=".$currency."",
	// 						CURLOPT_RETURNTRANSFER => true,
	// 						CURLOPT_ENCODING => "",
	// 						CURLOPT_MAXREDIRS => 10,
	// 						CURLOPT_TIMEOUT => 30,
	// 						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 						CURLOPT_CUSTOMREQUEST => "GET",
	// 						CURLOPT_HTTPHEADER => array(
	// 							"Accept: */*",
	// 							"Accept-Encoding: gzip, deflate",
	// 							"Cache-Control: no-cache",
	// 							"Connection: keep-alive",
	// 							"Cookie: PHPSESSID=pd76811dvepd0ao972vfg5abi4; ci_session=pmsh0l1ish4521b781egnuj41galc4uj",
	// 							"Host: www.livestoc.com",
	// 							"Postman-Token: 91f7b6cf-efc3-4c86-a7ec-f27f9e4f829f,ef189fb4-d157-44d2-ba00-804ee44657e4",
	// 							"User-Agent: PostmanRuntime/7.15.2",
	// 							"cache-control: no-cache"
	// 						),
	// 						));
	// 						$response = curl_exec($curl);
	// 						$err = curl_error($curl);
	// 						curl_close($curl);
	// 						$a['razorpayOrderId'] =  json_decode($response);
	// 				$detail[] = $a;
	// 				$json['success'] = true;
	// 				$json['data'] = $detail;
	// 				$json['consume'] = '0';
	// 			}else{
	// 				$json['success'] = true;
	// 				$json['data'] = $detail;
	// 				$json['consume'] = '0';
	// 			}
	// 		}
	// 	}		
	// 	header('Content-Type: application/json');
	// 	echo json_encode($json);
	// 	exit;
	// }
	public function get_wallets(){
		$users_id = $this->input->get_post('users_id');
		$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		$detail =[];
		// foreach($amount_cr as $a){

			 $a['real_balance'] = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
			$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$a['livestoc_balence'] = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
			//unset($a['amount']);
			$detail[] = $a;
		//}
		if(empty($detail)){
			$json['success'] = false;
			$json['error'] = 'No Data Found';
			
		}else{
			$json['success'] = true;
			$json['data'] = $detail;
		}		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doc_animal(){
		$doc_id = $this->input->get_post('doc_id');
		$cat_id = $this->input->get_post('cat_id');
		$gendor = $this->input->get_post('gender');
		$breed_id = $this->input->get_post('breed_id');
		$data = $this->api_model->get_animal($id, $cat_id, $gendor, $heard, $breed_id, $doc_id);
		$deat = [];
		foreach($data as $de){
					$img = $this->api_model->get_animal_image($de['selling_id']);
                    $breed = $this->api_model->get_breed($de['breed_id']);
					$category = $this->api_model->get_category($de['category_id']);
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
		$json['success']  = true; 
		$json['data'] = $deat;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function add_breed(){
		$data['category_id'] = $this->input->get_post('cat_id');
		$data['breed_name'] = $this->input->get_post('breed_name');
		if($data1 = $this->api_model->submit('breed', $data)){
			$json['success'] = true;
			$json['data']['breed_id'] = $data1;
			$json['data']['breed_name'] = $data['breed_name'];
		}else{
			$json['success'] = false;
			$json['error'] = 'Database Error';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	// public function get_expertise(){
	// 	$doc_id = $this->input->get_post('doc_id');  //mandatory
	// 	if($data = $this->api_model->get_data('doc_id = "'.$doc_id.'"', 'doc_experience')){
	// 		$json['success']  = true; 
	// 		$json['data'] = $data;
	// 		$json['msg'] = '';
	// 	}else{
	// 		$json['success']  = false; 
	// 		$json['error'] = 'You have not added your experience & employment details yet! Please add first.';
	// 	}
	// 	header('Content-Type: application/json');
	// 	echo json_encode($json);
	// 	exit;
	// }
	public function get_experience(){
		$doc_id = $this->input->get_post('doc_id');  //mandatory
		if($data = $this->api_model->get_data('doc_id = "'.$doc_id.'"', 'doc_experience')){
			// $json['success']  = true; 
			// $json['data'] = $data;
			if(empty($data)){
				$jos['success'] = false;
				$json[error] = 'You have not added your experience & employment details yet! Please add first.';
			}else{
				$json['success']  = true; 
				$json['data'] = $data;
				$json['msg'] = '';
			}
		}else{
			$json['success']  = false; 
			$json['error'] = 'You have not added your experience & employment details yet! Please add first.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doc_ai_detail(){
		$doc_id = $this->input->get_post('doc_id');
		if($data = $this->api_model->get_data('doctor_id = "'.$doc_id.'"' , 'doctor', '', 'is_perform_ai, is_available_consultation, ai_visiting_fee, visiting_fee, ai_visiting_fee,consul_fee, is_vecc_term')){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = 'No data Found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function update_doc_ai_detail(){
		$doc_id = $this->input->get_post('doc_id');
		$is_perform_ai = $this->input->get_post('is_perform_ai');
		$is_available_consultation = $this->input->get_post('is_available_consultation');
		$ai_visiting_fee = $this->input->get_post('ai_visiting_fee');
		$visiting_fee = $this->input->get_post('visiting_fee');
		$consul_fee = $this->input->get_post('consul_fee');
		$is_vecc_term = $this->input->get_post('is_vecc_term');
		$emp = '';
		if(isset($is_perform_ai) || $is_perform_ai != ''){
			$data['is_perform_ai'] = $is_perform_ai;
			$emp = 1;
		}
		if(isset($is_available_consultation) || $is_available_consultation != ''){
			$data['is_available_consultation'] = $is_available_consultation;
			$emp = 1;
		}
		if(isset($ai_visiting_fee) || $ai_visiting_fee != ''){
			$data['ai_visiting_fee'] = $ai_visiting_fee;
			$emp = 1;
		}
		if(isset($visiting_fee) || $visiting_fee != ''){
			$data['visiting_fee'] = $visiting_fee;
			$emp = 1;
		}
		if(isset($consul_fee) || $consul_fee != ''){
			$data['consul_fee'] = $consul_fee;
			$emp = 1;
		}
		if(isset($is_vecc_term) || $is_vecc_term != ''){
			$data['is_vecc_term'] = $is_vecc_term;
			$emp = 1;
		}
		if($emp != ''){
			if($this->api_model->update('doctor_id', $doc_id, 'doctor', $data)){
				$json['success']  = true; 
				$json['msg'] = 'Your detail has been successfully updated';
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}else{
			$json['success']  = false; 
			$json['error'] = 'Please Send Any of The required data';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function doc_update(){
		$doc_id = $this->input->get_post('doc_id'); //mandatory
		$name = $this->input->get_post('name');
		$city = $this->input->get_post('city');
		$state = $this->input->get_post('state');
		$pincode = $this->input->get_post('pincode');
		$address_full = $this->input->get_post('address_full');
		$aadhar_no = $this->input->get_post('aadhar_no');
		$adhaar_img = $this->input->get_post('adhaar_img');
		$image = $this->input->get_post('image');
		if(isset($name) || $name != ''){
			$data['username'] = $name;
			$data['fullname'] = $name;
		}
		if(isset($state) || $state != ''){
			$data['state'] = $state;
			$data['state_code'] = $state;
		}
		if(isset($image) || $image != ''){
			$data['image'] = $image;
		}
		if(isset($city) || $city != ''){
			$data['city'] = $city;
		}
		if(isset($pincode) || $pincode != ''){
			$data['pincode'] = $pincode;
		}
		if(isset($address_full) || $address_full != ''){
			$data['address_full'] = $address_full;
		}
		if(isset($aadhar_no) || $aadhar_no != ''){
			$data['aadhar_no'] = $aadhar_no;
		}
		if(isset($adhaar_img) || $adhaar_img != ''){
			$data['adhaar_img'] = $adhaar_img;
		} 
		// print_r($data);
		// exit;
			if($this->api_model->update('doctor_id', $doc_id, 'doctor', $data)){
				$detail = $this->api_model->get_data('doctor_id = "'.$doc_id.'"' , 'doctor', '', 'doctor_id, users_type, username, mobile, refral_code, ai_visiting_fee, email, image, isactivated, is_payment, expertise_list, total_experience, rej_region, state, pincode, address_full, city, aadhar_no, adhaar_img');
				if($detail[0]['users_type'] == 'pvt_doc'){
						$doc_qua = $this->login_cheak_model->get_qulification_doc_id($detail[0]['doctor_id']);
						foreach($doc_qua as $dq){
							$qua_name = $this->login_cheak_model->get_qualification($dq['qualifi_id']);
							$dq['qualification_name'] = $qua_name[0]['qualifi_name'];
							$dq['document'] = base_url()."uploads/doctore_doc/".$dq['document'];
								if(!isset($dq['speci_id']) || $dq['speci_id'] != ''){
									//echo "this is true";
									$sp = json_decode($dq['speci_id']);
									foreach($sp as $s){
										$specialization = $this->login_cheak_model->get_specialisation($s);
										$sep[] = $specialization[0]['speci_name'];
									}
								$dq['speci_name'] = $sep;
								}else{
								$dq['speci_name'] = [];
								}
							$dat[] = $dq; 
						}
				}else{
					$dat = [];
				}
				if($detail){
					if(!isset($detail['image'])){
						$detail[0]['image'] = base_url()."uploads/doctor/".$detail[0]['image'];
					}else{
						$url= base_url()."uploads/image/".$detail['image'];
						$h = get_headers($url);
						$status = array();
						// preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
						// if($status[1]==200){
							$data['image'] = $url;
						// }else{
						// 	$data['image'] = base_url()."/uploads/image/profile.jpg";
						// }
						//$detail[0]['image1'] = $detail['image'];
					}
					if(isset($detail[0]['expertise_list'])){
						$detail[0]['expertise_list'] = explode(',',$detail[0]['expertise_list']);
					}
					
				// $detail[0]['qualification'] = $dat;
				// $detail[0]['rating'] = 4;
				$json['success'] = True;
				$json['data'] = $detail;
				$json['msg'] = 'Your Profile has been successfully updated';
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function del_education(){	
			$doc_qu_id = $this->input->get_post('doc_qu_id');
			if(isset($doc_qu_id) || $doc_qu_id != ''){
				if($this->api_model->del_education($doc_qu_id)){
					$json['success']  = True; 
					$json['msg'] = 'Successfully Detail is deleted.';
				}else{
					$json['success']  = false; 
					$json['error'] = 'Database Error';
					}
				}else {
					$json['success']  = false; 
					$json['error'] = 'Please send experience id.';
				}			
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function del_experience(){	
		$exp_id = $this->input->get_post('exp_id');
		if(isset($exp_id) || $exp_id != ''){
			if($this->api_model->del_experience($exp_id)){
				$json['success']  = True; 
				$json['msg'] = 'Successfully Detail is deleted.';
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}else{
			$json['success']  = false; 
			$json['error'] = 'Please send experience id.';
		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_education(){
		//echo "<pre>";
		$doc_id = $this->input->get_post('doc_id');
		$data = $this->api_model->get_doc_degree($doc_id);
		$detail = [];
		foreach($data as $da){
			$qualifi_id = $this->api_model->get_qualification($da['qualifi_id']);
			$da['qualifi_name'] = $qualifi_id[0]['qualifi_name'];
			$speci_id = json_decode($da['speci_id']);
			if($speci_id == ''){
				$da['speci_id'] = [];
			}else{
				$da['speci_id'] = json_decode($da['speci_id']);
			}
			
			//print_r($speci_id);
			$sp = '';
			$i = 0;
			foreach($speci_id as $sa){
				$speci = $this->api_model->get_specialisation_id($sa);
				//print_r($speci);
				if($i == 0){
					$sp .= $speci[0]['speci_name'];
				}else{
					$sp .= ','.$speci[0]['speci_name'];
				}
				$i++;
			}
		// echo $sp;
		//exit;
			$da['speciname'] = json_encode($sp);
			$detail[] = $da;
			
		}
		// print_r($detail);
	//	exit;
		//$data[0]['speciname'] = $sp;
		if(!empty($detail)){
			$json['success']  = true; 
			$json['data'] = $detail;
		}else{
			$json['success']  = false; 
			$json['error'] = 'You have not added your qualification details yet! Please add first.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function ins_education(){
		$doc_id = $this->input->get_post('doc_id');
		$data['doc_id'] = $doc_id;
		$qualifi_id = $this->input->get_post('qualifi_id');
		$data['qualifi_id'] = $qualifi_id;
		$data['institute'] = $this->input->get_post('institute');
		$data['speci_id'] = $this->input->get_post('speci_id');
		$data['document'] = $this->input->get_post('document');
		$data['year'] = $this->input->get_post('year');
		$get_data = $this->api_model->get_data('doc_id = '.$doc_id .' AND qualifi_id = '.$qualifi_id .'' , 'doc_qualification', '', '*');
		if(empty($get_data)){
			if($this->api_model->insert_doc_quali($data)){
				$data = $this->api_model->get_doc_degree($doc_id);
				$detail = [];
				foreach($data as $da){
					$qualifi_id = $this->api_model->get_qualification($da['qualifi_id']);
					$data[0]['qualifi_id'] = $qualifi_id[0]['qualifi_name'];
					$speci_id = json_decode($da['speci_id']);
					$i = 0;
					foreach($speci_id as $spe){
						$speci = $this->api_model->get_specialisation_id($spe);
							if($i == 0){
								$sp = $speci[0]['speci_name'];
							}else{
								$sp .= ','.$speci[0]['speci_name'];
							}
							$i++;
						}
					$da['speciname'] = $sp;
					if($speci_id == ''){
						$da['speci_id'] = [];
					}else{
						$da['speci_id'] = $speci_id;
					}
					$detail[] = $da;
				}
				if(!empty($data)){
						$json['success']  = true; 
						$json['data'] = $detail;
						$json['msg'] = 'Your education detail has been successfully added.';
				}else{
						$json['success']  = false; 
						$json['error'] = 'No Data Found';
				}
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}else{
			if($this->api_model->update_quilfi($doc_id, $qualifi_id, $data)){
				$data = $this->api_model->get_doc_degree($doc_id);
				$detail = [];
				foreach($data as $da){
					$qualifi_id = $this->api_model->get_qualification($da['qualifi_id']);
					$data[0]['qualifi_id'] = $qualifi_id[0]['qualifi_name'];
					$speci_id = json_decode($da['speci_id']);
					$i = 0;
					foreach($speci_id as $spe){
						$speci = $this->api_model->get_specialisation_id($spe);
							if($i == 0){
								$sp = $speci[0]['speci_name'];
							}else{
								$sp .= ','.$speci[0]['speci_name'];
							}
							$i++;
						}
					$da['speciname'] = $sp;
					if($speci_id == ''){
						$da['speci_id'] = [];
					}else{
						$da['speci_id'] = $speci_id;
					}
					$detail[] = $da;
					}
					
					if(!empty($data)){
							$json['success']  = true; 
							$json['data'] = $detail;
							$json['msg'] = 'Your education detail has been successfully Updated.';
					}else{
							$json['success']  = false; 
							$json['error'] = 'No Data Found';
					}
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function update_education(){
		$doc_id = $this->input->get_post('doc_id');
		$doc_qu_id = $this->input->get_post('doc_qu_id');
		$data['doc_id'] = $doc_id;
		$data['qualifi_id'] = $this->input->get_post('qualifi_id');
		$data['institute'] = $this->input->get_post('institute');
		$data['speci_id'] = $this->input->get_post('speci_id');
		$data['document'] = $this->input->get_post('document');
		$data['year'] = $this->input->get_post('year');
		if($this->api_model->update_doc_quali('doc_qu_id', $doc_qu_id, 'doc_qualification', $data)){
			$data = $this->api_model->get_doc_degree($doc_id);
			$qualifi_id = $this->api_model->get_qualification($data[0]['qualifi_id']);
			$data[0]['qualifi_id'] = $qualifi_id[0]['qualifi_name'];
			$speci_id = json_decode($data[0]['speci_id']);
			$i = 0;
			foreach($speci_id as $da){
				$speci = $this->api_model->get_specialisation_id($da);
					if($i == 0){
						$sp = $speci[0]['speci_name'];
					}else{
						$sp .= ','.$speci[0]['speci_name'];
					}
					$i++;
				}
				$data[0]['speciname'] = $sp;
			if(!empty($data)){
					$json['success']  = true; 
					$json['data'] = $data;
			}else{
					$json['success']  = false; 
					$json['error'] = 'No Data Found';
			}
		}else{
			$json['success']  = false; 
			$json['error'] = 'Database Error';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function ins_experience(){
		$doc_id = $this->input->get_post('doc_id');
		$data['doc_id'] = $doc_id;
		$data['designation'] = $this->input->get_post('designation');
		$data['from_date'] = $this->input->get_post('from_date');
		$data['organization'] = $this->input->get_post('organization');
		$data['to_date'] = $this->input->get_post('to_date');
		$data['year'] = $this->input->get_post('year');
		if($this->api_model->submit('doc_experience',$data)){
			$data = $this->api_model->get_data('doc_id = "'.$doc_id.'"','doc_experience');
			// $qualifi_id = $this->api_model->get_qualification($data[0]['designation']);
			// $data[0]['organization'] = $qualifi_id[0]['organization'];
			// $speci_id = json_decode($data[0]['organization']);
			// $i = 0;			
			if(!empty($data)){
					$json['success']  = true; 
					$json['data'] = $data;
					$json['msg'] ='Your experience details has been successfully added.';
			}else{
					$json['success']  = false; 
					$json['error'] = 'No Data Found';
			}
		}else{
			$json['success']  = false; 
			$json['error'] = 'Database Error';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function update_experience(){
		$exp_id = $this->input->get_post('exp_id');
		$designation = $this->input->get_post('designation');
		$from_date = $this->input->get_post('from_date');
		$organization = $this->input->get_post('organization');
		$to_date = $this->input->get_post('to_date');
		$year = $this->input->get_post('year');

		if(isset($designation) || $designation != ''){
			$data['designation'] = $designation;
		}	
		if(isset($from_date) || $from_date != ''){
			$data['from_date'] = $from_date;
		}
		if(isset($organization) || $organization != ''){
			$data['organization'] = $organization;
		}
		if(isset($to_date) || $to_date != ''){
			$data['to_date'] = $to_date;
		}
		if(isset($year) || $year != ''){
			$data['year'] = $year;
		}
			if($this->api_model->update('exp_id',$exp_id, 'doc_experience', $data)){
				$json['success']  = true; 
				$json['msg'] = 'Your Profile has been successfully updated';
			}else{
				$json['success']  = true; 
				$json['error'] = 'Database Error';
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_category(){
		$data = $this->api_model->get_category();
		$json['success']  = true; 
		$json['data'] = $data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_proforma(){
		$user_id = $this->input->get_post('users_id');
		$invoice_id = $this->input->get_post('invoice');
		if($data = $this->api_model->get_proforma_invoice($user_id, $invoice_id)){
			$json['success']  = TRUE; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = 'No Invoice Found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_pro_dashboard(){
		$doc_id = $this->input->get_post('doc_id');	
		if(!isset($doc_id) || $doc_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please Send doc_id';
		}else{
			$doc_detail = $this->api_model->doc_detail_id($doc_id);
			$semen_stock = $this->api_model->get_semen_stock_id($doc_id);
			// echo"<pre>";
			// print_r($doc_detail);
			// exit;
			$data = $this->api_model->get_pro_dashboard($doc_detail[0]['users_type']);
			$detail = [];
			foreach($data as $da){
				//print_r($da);
				if($da['field']){
					$count = $this->api_model->get_count($da['table'], $da['field'], $doc_detail[0][$da['field_web']], $da['where_field'],$da['field_count']);
					$da['count'] = $count[0]['count'];
				}else{
					$da['count'] = '';
				}
				$detail[] = $da;
			}			
			$json['success'] = true;
			$json['data'] = $detail;
		}
		///print_r($data);
		header('Content-Type: application/json');
		echo json_encode($json);	
		exit;

	}
	public function make_invoice(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['admin_id'] = $this->input->get_post('admin_id');
		$data['animal_id'] = $this->input->get_post('animal_id');
		$data['bull_id'] = $this->input->get_post('bull_id');
		$mobile = $this->input->get_post('mobile_code');
		$user_phone = $this->input->get_post('mobile');
		$data['semen_stock_price'] = $this->input->get_post('semen_stock_price');
		$data['semen_stock_id'] = $this->input->get_post('semen_stock_id');
		$data['semen_stock_qty'] = $this->input->get_post('semen_stock_qty');
		$data['sheath_qty'] =  $this->input->get_post('sheath_qty');
		$data['gloves_qty'] =  $this->input->get_post('gloves_qty');
		$data['ai_price'] = AI_PRICE;
		$data['otp'] = rand(1000,9999);
		$data['invoice_total'] = $this->input->get_post('invoice_total') + AI_PRICE;
		$data['type'] = $this->input->get_post('type');
		$data['date'] = date('Y-m-d h:i:s');
		if($id = $this->api_model->submit('semen_invoice_performa',$data)){
			$msg = "Please Pay Rs = ".$data['invoice_total']."to the Service Provider and OTP is ".$data['otp']."  https://www.livestoc.com/harpahu_merge_dev/api/invoice/".$id;
			$json['data'] = $this->api_model->get_proforma_invoice('', $id);
			$json['success']  = TRUE; 
		}
		header('Content-Type: application/json');
		echo json_encode($json);	
		exit;
	}
	public function complite_invoice(){
		$invoice_id = $this->input->get_post('invoice_id');
		$otp = $this->input->get_post('otp');
		$address = $this->input->get_post('address');
		if($data = $this->api_model->check_invoice_otp($invoice_id, $otp)){
			$user_id = $data[0]['users_id'];
			$stock_id = explode(',',$data[0]['semen_stock_id']);
			$stock_qty = explode(',',$data[0]['semen_stock_qty']);
			$i = 0;
			foreach($stock_id as $st){
				$sto = $this->api_model->get_semen_stock_id($st);
				$stock_data['rest_stock'] = $sto[0]['rest_stock'] - $stock_qty[$i];
				$this->api_model->update_semen_stock($st, $stock_data);
				$req_filed = [
					'users_id'     => $user_id,
					'animal_id'     => $data[0]['animal_id'],
					'treat_type'    => '3',
					'vt_id'         => $data[0]['admin_id'],
					'animal_simtoms'=> '',
					'status'        => '4',
					'address'       => $address,
					'latitude'      => '0',
					'langitude '    => '0',
					'otp'          => $otp,
					'date'		   => date('Y-m-d'),
					'created_on'    =>  date('Y-m-d H:i:s'),
				];
				$insert = $this->api_model->insert_vt_request($req_filed);
				$r_data['request_id'] = $insert; 
				$r_data['user_id'] = $user_id;
				$r_data['animal_id'] = $data[0]['animal_id'];
				$r_data['treat_type'] = '3';
				$r_data['animal_simtoms'] = '';
				$r_data['treat_status'] = '4';
				$r_data['doc_id'] = '0';
				$r_data['vacc_id'] = $data[0]['bull_id'];
				$r_data['vt_id'] = $data[0]['admin_id'];
				$r_data['status'] = '4';
				$r_data['type'] = '0';
				$r_data['otp'] = $otp;
				$r_data['date'] = date('Y-m-d');
				//print_r($req_filed);
				$this->api_model->insert_vt_track_request($r_data);
				$i++;
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
	public function get_breed(){
		$category_id  = $this->input->get_post('category_id');
		$data = $this->api_model->get_breed($id, $category_id);
		$json['success']  = true; 
		$json['data'] = $data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_dashboard_list(){
		$category = $this->input->get_post('category_id');
		if($category == '0'){
			$category  = '';
		}
		$user_id = $this->input->get_post('user_id');
		$language = $this->input->get_post('language');
		$state_id = $this->input->get_post('state_id');
		$state_name = $this->input->get_post('state_name');
		$sale_animal = $this->api_model->get_animals($category, 1, 5, $users_type_id, '1','');
		if($category == '1,8' || $category =='0' || $category == ''){			
				$json['data']['user_sell_semen'] = '1';
				$json['data']['show_livestoc_lab'] = '1';				
				}else{
					$json['data']['user_sell_semen'] = '0';
					$json['data']['show_livestoc_lab'] = '0';
				}
		
		// if($category == '2'){
		// 	$category  = '';
		// }
		$semen_banner = $this->api_model->get_featured_semen($category, 0, 2);
		$get_information_banners = $this->api_model->get_information_banners($category, 1, 4, 'dashboard');
		//$get_dog_cat_banners = $this->api_model->get_dog_cat_banners($category, 1, 4, 'dashboard');
		$get_information_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 1);
		$get_featured_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 2);
		$get_featured_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 2);
		$get_featured_product = $this->api_model->get_featured_product($category, $start, $perpage, 1);
		$get_articles = $this->api_model->get_articles($category, 1, 5, 1, $user_id);
		$get_dog_cat_banner = $this->api_model->get_dog_cat_banner($category, $start, $perpage);
		$get_animal_services = $this->api_model->get_animal_services($category, $start, $perpage);

		$get_events = $this->api_model->get_events($category, $start, $perpage);
		$get_featured_feed = $this->api_model->get_information_banners($category, $start, $perpage, 'feed');
		$get_featured_mineral_mixtures = $this->api_model->get_information_banners($category, $start, $perpage, 'mixtures');
		$get_featured_equipment = $this->api_model->get_information_banners($category, $start, $perpage, 'equipment');
		$get_featured_sinage = $this->api_model->get_featured_sinage($category, $start, $perpage);
		$featured_animal = $this->api_model->get_animals($category, 1, 5, $users_type_id, '2', '');
		$cat = $category;
		$dealer_animal = $this->api_model->get_animals($category, 1, 5, 5, "'1','2'", '');
		// echo "<pre>";
		// print_r($dealer_animal);
		// exit;
		$breeder_animal = $this->api_model->get_animals($category, 1, 5, 4, "'1','2'", '');
		// echo "<pre>";
		// print_r($breeder_animal);
		// exit;
		$ai_worker = $this->api_model->doc_premium_type("'pvt_ai', 'pvt_vt'");	
		//echo $category;`
		$doc_worker = $this->api_model->doc_premium_type("'repeat_breading', 'animal_nutrition'");

		//video tutorials
		$video_tutorials = $this->Admin_detail->get_last_five_video_block();

		if($cat == '4' || $cat == '9')
		{
			$sec_id = '';
			//print_r($sec_id);
		}else{
			$sec_id = '';
		}
		if($cat == '3,14'){
			$home_doc_worker = $this->api_model->doc_premium_type("'expert_in_medicine','vet_surgeon','animal_nutrition'", '',$sec_id);
		}else if($cat == '7,10'){
			$home_doc_worker = $this->api_model->doc_premium_type("'expert_in_medicine','vet_surgeon','repeat_breading', 'animal_nutrition'", '',$sec_id);
		}else if($cat == '4' || $cat == '9'){
			$home_doc_worker = $this->api_model->doc_premium_type("'Nutrition'", '',$sec_id);
			//print_r($sec_id);
		}else if($cat == '5'){
			$home_doc_worker = $this->api_model->doc_premium_type("'animal_nutrition'", '',$sec_id);
			//print_r($sec_id);
		}else{
			$home_doc_worker = $this->api_model->doc_premium_type("'veternary_doctor', 'farm_automation','expert_in_medicine','vet_surgeon','repeat_breading','animal_nutrition'", '',$sec_id);
		}
		//echo $sec_id;
		
		//print_r($home_doc_worker);
		// $section = $this->api_model->get_section();
		$section = $this->api_model->get_product_cat();
		$home_doc=[];
		// echo utf8_decode($get_articles[1]->title);
		// echo "<pre>";
		 // print_r($section);
		// exit;
		$json['data']['livestoc_lab_price'] = LAB_PRICE;
		foreach($home_doc_worker as $home){
			$home['image'] = IMAGE_PATH.'uploads/doctor_type/doctor.png'; 
			$home_doc[] = $home;
		}
		$sequence_order =[];//array("featured_animal","sale_animal","featured_feed","featured_mineral_mixtures","featured_equipment","information_banners","information_videos", "featuredproduct_videos","featured_product","articles","events","dealer_animal","breeder_animal");
		if ($featured_animal || $home_doc_worker|| $sale_animal || $get_information_videos || $get_information_banners || $get_featured_videos || $get_featured_product || $get_articles || $get_events) {
			$json['success'] = TRUE;
			if($category == '1,8' || $category =='0' || $category == '2' || $category == ''){
				if(!empty($semen_banner))
				{
				$json['data']['featured_semen'] = $semen_banner;
				//$sequence_order[] = 'featured_semen';
				}
			}
			
			//print_r($home_doc_worker);	
			if($category == '3,14'){
				if(!empty($expert_in_medicine))
					{
					$json['data']['expert_in_medicine'] = $expert_in_medicine;
					//$sequence_order[] = 'expert_in_medicine';
					}
					$sequence_order[] = 'dog_mating';
					$sequence_order[] = 'Dog_list_mating';
				}
			if(!empty($sale_animal))
			{
			 $json['data']['sale_animal'] = $sale_animal;
			 $sequence_order[] = 'sale_animal';
			}
			$sequence_order[] = 'sell_Your_Animal';
			$sequence_order[] = 'Happiness';
			$sequence_order[] = 'register_dealer_breeder';
			$sequence_order[] = 'search';
			
			if($category =='0' || $category =='' || $category =='4' || $category =='9' || $category =='7,10' || $category =='3,14' || $category == '1,8' || $category == '5'){
				if(!empty($home_doc_worker)){
					$json['data']['home_doc_worker'] = $home_doc;
					//$sequence_order[] = 'home_doc_worker';
				}
			}
			if($category != '5' && $category != '4' && $category != '9'){
				//$sequence_order[] = 'ai_reqest';
				if(!empty($get_information_banners))
				{
				$json['data']['information_banners'] = $get_information_banners;
				$sequence_order[] = 'information_banners';
				}
			}
			if($category == '1,8' || $category == ''){
				$sequence_order[] = 'sale_bull_semen';
			}
			// Static value
			$json['data']['breeder_price'] = '5999';
			$json['data']['mating_price'] = '5999';
			$json['data']['add_bull_price'] = '5999';
			$json['data']['pregnancy_test_price'] = LAB_CHARGES;
			$json['data']['pregnancy_sample_helpline'] = HELP_LINE;
			// end static value
			if(!empty($get_featured_product))
			{
			 $json['data']['featured_product'] = $get_featured_product;
			 $sequence_order[] = 'featured_product';
			}
			//$json['data']['information_banners'] = $get_information_banners;
			if($category != '3,14' && $category != '7,10' && $category != '2' && $category != '5' && $category != '4' && $category != '9'){
				if($category == '1,8' || $category =='0' || $category == '' || $category == '7,10'){
					if(!empty($ai_worker)){
						$json['data']['ai_worker'] = $ai_worker;
						//$sequence_order[] = 'ai_worker';
					}
				}

			}
			if($category == '3,14'){
				if(!empty($get_dog_cat_banner))
				{
				 $json['data']['dog_mating'] = $get_dog_cat_banner;
				 //$sequence_order[] = 'dog_mating';
				}
			}
			if(!empty($get_animal_services))
				{
				 $json['data']['animal_services'] = $get_animal_services;
				 //$sequence_order[] = 'dog_mating';
				}
			
			if(!empty($section))
			{
			 $json['data']['other_primum_list'] = $section;
			 //$sequence_order[] = 'other_primum_list';
			}
			//$sequence_order[] = 'knowledge_bank';
			if(!empty($get_articles))
			{
			 $json['data']['articles'] = $get_articles;
			 $sequence_order[] = 'articles';
			}
			// dog Image
			if(!empty($featured_animal))
			{
			 $json['data']['featured_animal'] = $featured_animal;
			// $sequence_order[] = 'featured_animal';
			}
			if($category == '1,8' || $category =='0' || $category == ''){			
				if(!empty($doc_worker)){
					$json['data']['doc_worker'] = $doc_worker;
					//$sequence_order[] = 'doc_worker';				
				}
			}			
			// if(!empty($get_featured_mineral_mixtures))
			// {
			// 	$json['data']['featured_mineral_mixtures'] = $get_featured_mineral_mixtures;
			// 	//$sequence_order[] = 'featured_mineral_mixtures';
			// }
			// if(!empty($get_featured_equipment)){
			// 	$json['data']['featured_equipment'] = $get_featured_equipment;
			// 	//$sequence_order[] = 'featured_equipment';
			// }
			// if($category == '3,14'){
			// 	if(!empty($get_dog_mating)){
			// 		$json['data']['get_dog_matingred_feed'] = $get_dog_mating;
			// 		//$sequence_order[] = 'get_dog_mating';
			// 	}
			// }			
			if(!empty($get_information_videos))
			{
			 $json['data']['information_videos'] = $get_information_videos;
			 //$sequence_order[] = 'information_videos';
			}
						
			// if(!empty($get_featured_sinage)){
			// 	$json['data']['featured_silage'] = $get_featured_sinage;
			// 	//$sequence_order[] = 'featured_silage';
			// }
			if(!empty($get_featured_videos))
			{
			 $json['data']['featuredproduct_videos'] = $get_featured_videos;
			// $sequence_order[] = 'featuredproduct_videos';
			}else{
				$json['data']['featuredproduct_videos'] = [];
				//$sequence_order[] = 'featuredproduct_videos';
			}
			// if(!empty($get_dog_cat_banners))
			// {
			//  $json['data']['get_dog_cat_banners'] = IMAGE_PATH.'uploads/doctor_type/doctor1.png';
			// // $sequence_order[] = 'get_dog_mating';
			// }else{
			// 	$json['data']['get_dog_cat_banners']['image'] = IMAGE_PATH.'uploads/doctor_type/doctor1.png';
			// 	//$json['data']['name'] = [];
			// 	//$sequence_order[] = 'get_dog_mating';
			// }
			// foreach($get_dog_cat_banners as $dog){
			// 	$dog['image'] = IMAGE_PATH.'uploads/doctor_type/doctor.png'; 
			// 	$doc_image[] = $dog;
			// }
			if(!empty($dealer_animal))
			{
			 $json['data']['dealer_animal'] = $dealer_animal;
			 //$sequence_order[] = 'dealer_animal';
			}
			if(!empty($breeder_animal))
			{
			 $json['data']['breeder_animal'] = $breeder_animal;
			 //$sequence_order[] = 'breeder_animal';
			}		
			if(!empty($get_events))
			{
			 $json['data']['events'] = $get_events;
			 //$sequence_order[] = 'events';
			}
			// if($category == '3,14'){
			// 	$json['sequence_order'] = array('animals','search','home_doc','ai_request','ai_worker_list','other_primum_list','knowledge','artical');
			// }else if($category == '5'){
			// 	$json['sequence_order'] = array('search','home_doc','ai_request','ai_worker_list','other_primum','knowledge','artical');
			// }else{
				 $json['sequence_order'] = $sequence_order;
			//}
			if(!empty($video_tutorials)) {
				$dem = [];
				foreach($video_tutorials as $d){
					$d['video_thumb'] = isset($d['video_thumb']) ? base_url()."uploads/videos/images/".$d['video_thumb'] : '';
					$d['video'] = isset($d['video']) ? base_url()."uploads/videos/".$d['video'] : '';
					$dem[] = $d;
				}
				$json['data']['video_tutorials'] = $dem;
			}
        } else {
			$json['success'] = FALSE;
			$json['error'][] = "Listing Not Available";
		}
		// echo "<pre>";
		// print_r($json);
		header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
	public function ios(){
		$json['type'] = '0';
		$json['success'] =  TRUE;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function product_section(){
		$data = $this->api_model->product_section();
		$json['data'] = $data;
		$json['success'] =  TRUE;
		$json['doc_treat_price'] = DOC_TREAT_PRICE;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function test()
	{	
		//echo phpinfo();
		//$name =;
		$name = '{"animal_id":"[\"4054\"]","avg_milk_proteen":"[\"22\"]","is_certified":"[\"NO\"]","is_imported":"[\"NO\"]","lat_yield":"[\"12\"]","milk_type":"[\"A1\"]","progini_test":"[\"NO\"]","semen_price":"[\"1234\"]","semen_type":"[\"Normal\"]","total_milk_fat":"[\"12\"]","total_milk_proteen":"[\"12\"]"}';
		//$name = json_encode($name);
		//echo $name;
		//$name = stripslashes($name);
		// echo $name;
        $name = json_decode($name, true);
		 //$name = jsone_decode($name, true);
        //foreach($name as $na){
   //      	$animal = json_decode($name['animal_id']);
   //      	print_r($animal);
			// echo "</br>";
			echo $name['avg_milk_proteen'];
			echo "</br>";
			echo $name['is_certified'];
		// //}
		 print_r($name);
		// $date = strtotime(date('Y-m-d H:i:s'));
		// echo $newDate = date("Y-m-d H:i:s", strtotime("+1 month", $date));
		// $var = '18/03/2020';
		// $date = str_replace('/', '-', $var);
		//echo date('Y-m-d', strtotime($date));
		//echo date('Y-m-d', strtotime($date));
		// $name = $this->input->get_post('name');
		// $name = json_decode($name);
		// foreach($name as $na){
		// 	echo $na->award_name;
		// 	echo "</br>";
		// 	echo $na->date;
		// 	echo "</br>";
		// 	echo $na->event_organized_by;
		// 	echo "</br>";
		// 	echo "<pre>";
		// 	$image= $na->image_path;
		// 	print_r($image);
		// 	//echo implode(',',);
		// }
		// $date = date('Y-m-d');
		// $month = 5;
		// echo date('Y-m-d', strtotime("+$month months", strtotime($date)));
		///--------------------------------------------------//
		// $latitude = '30.67995';
		// $longitude = '76.72211';
		// //echo "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&key=AIzaSyDBKXAzms3AOjKJz4hjMlPdFreKAryub2U";
		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		// CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&key=AIzaSyDBKXAzms3AOjKJz4hjMlPdFreKAryub2U",
		// CURLOPT_RETURNTRANSFER => true,
		// CURLOPT_ENCODING => "",
		// CURLOPT_MAXREDIRS => 10,
		// CURLOPT_TIMEOUT => 30,
		// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// CURLOPT_CUSTOMREQUEST => "GET",
		// CURLOPT_POSTFIELDS => "",
		// CURLOPT_HTTPHEADER => array(
		// 	"Postman-Token: 449f4095-22e5-46df-a959-1632d3f2fb18",
		// 	"cache-control: no-cache"
		// ),
		// ));
		// $response = curl_exec($curl);
		// $err = curl_error($curl);
		// curl_close($curl);
		// if ($err) {
		// echo "cURL Error #:" . $err;
		// } else {
		// 	echo "<pre>";
		// 	$data = json_decode($response);
		// 	print_r($data->results[0]->formatted_address);
		// 	//echo $data->results->formatted_address;
		// }
		//=========================================================//
		// $radious = '10000';
		// $data = $this->api_model->get_distributor_by_latlong( $longitude, $latitude, '25', $radious);
		// print_r($data);
		// echo "this is test";
		// $mobile = '7837736422';
		// $mobile_code = '+91';
		// $mobilecheck = $this->api_model->docmobileadhaarcheck($mobile, $mobile_code); 
		// if($mobilecheck){
		// 	echo "this is true";
		// }else{
		// 	echo "this is false";
		// }
		// $adhaarcheck = $this->api_model->docadhaarcheck($data['aadhar_no']);
		// $emailcheck = $this->api_model->docemailcheck($data['email']);
		// if($data = $this->api_model->check_doc_email('')){
		// 	print_r($data);
		// }else{
		// 	echo "this is test";
		// }
		// $ai_id = "[\"2\",\"3\",\"4\"]";
		// $ai_id = json_decode($ai_id);
		// //print_r($ai_id);
		// foreach($ai_id as $d){
		// 	echo $d;
		// }
		// $log_data['status'] = 2;
		// if($log_data['status'] == '1' || $log_data['status'] == '2'){
		// $data = $this->api_model->test();
		// echo "this is true";
		// }

		// $data = [];
		// $users_id = $this->input->get_post('users_id');
		// if(!isset($usersid)){
		// 	$data['error'] ="You Must send users_id";
		// }else{
		// 	$detail = $this->get_user->login($mobile, $adhar);
		// 	print_r($detail);
		// }
		// print_r($data['users_id']);
		//  echo json_encode($data);
	}
	public function invoice($id){
		$data['data'] = $this->api_model->get_invoice_id($id);
		$this->load->view('admin/invoice', $data);
	}
	
	public function myorder(){
		$type = $this->input->get_post('type');
		$users_id = $this->input->get_post('users_id');
		//$date = date('Y:m:d');
		$detail = $this->api_model->get_user_payment_detail1($users_id, $type);
		$purch = $this->api_model->purchase($users_id);
		//echo "<pre>";
		//print_r($detail);
		//$detail[] =array_values($purch); 
		//print_r($purch);
		$data = [];
		
		/*echo "<pre>";
		print_r($detail);
		die();*/

		foreach($detail as $de){
			if($de['type_type'] == '5'){
				$de['type'] = 'Breeding Record Charges';
			}else if($de['type_type'] == '6'){
				$de['type'] = 'Artificial Insemination';
			}else if($de['type_type'] == '15'){
				$de['type'] = 'Registered as Dealer';
			}else if($de['type_type'] == '16'){
				$de['type'] = 'Registered as Breeder';
			}else if($de['type_type'] == '17'){
				$de['type'] = 'Dog Mating Registration';
			}else if($de['type_type'] == '12'){
				$de['type'] = 'Animal Premium';
			}else if($de['type_type'] == '18'){
				$de['type'] = 'Bull Registration to Sell Semen';
			}else if($de['type_type'] == '19'){
				$de['type'] = 'Upgraded to Premium Member';
			}else if($de['type_type'] == '23'){
				$de['type'] = 'Livestoc lab+cattle pregnancy test in 28 days with American Technology.';
			}else if($de['type_type'] == '24'){
				$de['type'] = 'Pregnancy Detection Sample';
			}

			else if($de['type_type'] == '4' 
				|| $de['type_type'] == '15' 
				|| $de['type_type'] == '16'){
				
				$pack = $this->api_model->get_my_purchase_detail('', $de['id']);
				//print_r($pack);
				if($pack[0]['service_type'] == ''){
					$de['type'] = '';
				}else{
					$de['type'] = $pack[0]['service_type'];
				}
				$subs = $this->api_model->get_subus_dtail($pack[0]['subscription_id']);
				if($pack[0]['created_at']){
					$date = $pack[0]['created_at'];
					$month = $subs[0]['no_of_month'];
					$effectiveDate= date('Y-m-d', strtotime("+$month months", strtotime($date)));
				}else{
					$effectiveDate= date('Y-m-d');
				}
					
				//$effectiveDate = date("Y-m-t", strtotime(strtotime($de['created_at']) ,"+".$pack[0]['no_of_month']." months"));
				 
				$de['exp_date'] = $effectiveDate;
				//  print_r($effectiveDate);
				//  exit;
			}
			//if($de['request_status'] > 0) {
				$de['payment_status'] = "Payment has been received";
				$data[] = $de;
			//}
			//$data[] = $de;
		}
		$push = [];
		foreach($purch as $pu){
			$new = [];
			$new['id'] = $pu['purchase_id'];
			$new['type'] = $pu['type'];
			$new['type_type'] = '';
			$new['premium_bull_type'] ='';
			$new['payment_type'] = 'Dr';
			$new['users_id'] = $pu['users_id'];
			$new['ai_id'] = '';
			$new['currency'] = 'INR';
			$new['request_id'] = '0';
			$new['request_status'] = '0';
			$new['status'] = '0';
			$new['amount'] = $pu['amount'];
			$new['user_type'] = '0';
			$new['date'] = $pu['created_on'];
			$new['payment_status'] = 'Payment has been received';
			$push[] = $new;
		}
		$data = array_merge($data,$push); 
		if(!empty($data)){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = "NO Data Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}

	public function get_seman_stock(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		$cat = $this->input->get_post('cat_id');
		$data = $this->api_model->get_seman_stock($users_id, $type);
		$detail = [];
		foreach($data as $d){
			$semen_data = $this->api_model->get_seman_detail($d['bull_id']);
			$admin_detail = $this->api_model->get_admin_detail($semen_data[0]['bull_source']);
			$d['bank_name'] = $admin_detail[0]['fname'];
			$d['image'] = base_url().'uploads/bank/'.$d['image'];
			$category = $this->api_model->get_animal_category($semen_data[0]['category']);
			$d['category'] = $category[0]['category'];
			$bread = $this->api_model->get_animal_breed($semen_data[0]['bread']);
			$d['bread'] = $bread[0]['breed_name'];
			$stock_detail = $this->api_model->get_semen_stock_id($d['stock_id']);
			$stock_admin = $this->api_model->get_admin_detail($stock_detail[0]['admin_id']);
			$d['sendor_name'] = $stock_admin[0]['fname'];
			if($cat != ''){
				if($semen_data[0]['category'] == $cat){
					$detail[] = $d;
				}
			}else{
				$detail[] = $d;
			}
			
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
	public function get_oldUser_by_mobile(){
		$mobile = $this->input->get_post('mobile');
		if($data = $this->api_model->check_mobile($mobile)){
			$json['success']  = TRUE; 
			$json['data'] = $data[0]['doctor_id'];
		}else{
			$json['success']  = false;
			$json['error'] = "This mobile no is not register with us";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function passcode_update_doc(){
		$doctor_id = $this->input->get_post('doctor_id');
		$data['password'] = md5($this->input->get_post('passcode'));
		if($data = $this->api_model->passcode_update_doc($doctor_id, $data)){
			$json['success']  = TRUE; 
			$json['msg'] = "Your Passcode has been successfully updated";
		}else{
			$json['success']  = false;
			$json['error'] = "Database Error";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doc_specialisation_name_latlong(){
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('longitude');
		$specialization = $this->input->get_post('specialization');
		$data = $this->api_model->get_doc_specialisation_name_latlong($latitude, $langitude, $specialization);
		$detail = [];
		foreach($data as $da){
			$special = $this->api_model->get_doc_degree($da['doctor_id']);
			$spe = [];
			foreach($special as $sp){
				$speci = implode(',',json_decode($sp['speci_id']));
				$spec = $this->api_model->get_specialisation_for_doc($speci);
				$spel = implode(',',array_column($spec, 'speci_name'));
				$sp['speci_name'] = $spel;
				$spe[] = $sp;
			}
			$da['qualification'] = $spe;
			$detail[] = $da;
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
	public function get_user_list_by_refral_code(){
		$refral_code = $this->input->get_post('refral_code');
				$data = $this->api_model->check_refral_code($users_id, $refral_code);
				// echo "<pre>";
				// print_r($data);
				// $curl = curl_init();
                // curl_setopt_array($curl, array(
                // CURLOPT_URL => "https://www.livestoc.com/frontend/get_user_by_ref?ref=".$refral_code."",
                // CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                // CURLOPT_TIMEOUT => 30,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "GET",
                // CURLOPT_HTTPHEADER => array(
                //     "cache-control: no-cache",
                //     "postman-token: a8cfa165-6d9f-4bcb-c43a-1f69520cbf2c"
                // ),
                // ));
                // $response = curl_exec($curl);
                // $err = curl_error($curl);
                // curl_close($curl);
				$res = $data;
				// $data = [];
				$detail = [];
				foreach($data as $r){
					$r['users_id'] = $r['users_id'];
					$r['full_name'] = $r['full_name'];
					$r['mobile'] = $r['mobile'];
					$r['image'] = base_url().'uploads/user/'.$r['image'];
					$r['address'] = $r['address'];
					$r['no_count'] = $r['no_count'];
					$animal_count = $this->api_model->get_animal_count_user($r['users_id']);
					//print_r($animal_count);
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
	
	public function business_ai_request(){
		$latitude = $this->input->get_post('latitude');
		$purchase_id = $this->input->get_post('purchase_id');
		$longitude = $this->input->get_post('longitude');
		$address = $this->input->get_post('address');
		$bull_id = $this->input->get_post('bull_id');
		$no_strow = $this->input->get_post('no_strow');
		$distributor_id = $this->input->get_post('distributor_id');
		$distributor_id = json_decode($distributor_id);
		$no_strow = json_decode($no_strow);
		$bull_id = json_decode($bull_id);
		$bull_price = $this->input->get_post('bull_price');
		$bull_price = json_decode($bull_price);
		$user_id = $this->input->get_post('user_id');
		$type = $this->input->get_post('type');
		$payment_method = $this->input->get_post('payment_method');
		$data['payment_type'] = 'Cr';
		$data['status'] = 1;
		$data['request_status'] = '2';
		$log_data = $this->api_model->update_log_file($data, $purchase_id);
		if($payment_method == 'LVET'){
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://www.livestoc.com/home/get_coustomer?user_id=".$user_id."",
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
			$err = curl_error($curl);
			$response = json_decode($response);
			$full_name = $response[0]->full_name;
			$full_mobile = $response[0]->mobile;
		}else if($payment_method == 'LPRO'){
			$user_l = $this->api_model->get_user_info($user_id);
			$full_name = $user_l->username;
			$full_mobile = $user_l->mobile;
		}else{
			$user_l = $this->api_model->get_user_detail($user_id);
			$full_name = $user_l[0]['fullname'];
			$full_mobile = $user_l[0]['mobile'];
		}
		$i = 0;		
		foreach($bull_id as $bu){
			$bull = $this->api_model->get_seman_detail($bu);
			$bank_detail = $this->api_model->get_admin_detail($distributor_id[$i]);
			$breed = $this->api_model->get_breed($bull[0]['bread']);
			if($payment_method == 'LVET'){
				$title = 'Advance Semen Booking';
				$flag = 1;
				$msg = 'The request of # '.$bu.'('.$breed[0]['breed_name'].') for advance semen booking has been successfully placed. ';
				$result = $this->push_non($bank_detail[0]['admin_id'],  3, $title , $flag, LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg, $response[0]->fcm_android,  $response[0]->fcm_ios);
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://www.livestoc.com/home/push_notification?user_id=".$user_id."&description=".urlencode($msg)."&title=".urlencode($title)."",
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
				$err = curl_error($curl);
			}else if($payment_method == 'LPRO'){
					$user_note = '';
					$title = 'Advance Semen Booking';
					$flag = 1;
					$msg = 'The request of # '.$bu.'('.$breed[0]['breed_name'].') for advance semen booking has been successfully placed. ';
					$user_note['users_id'] = $user_id;
					$user_note['title'] = $title;
					$user_note['message'] = $msg;
					$user_note['date'] = date('Y-m-d h:i:s');
					$user_note['type'] = '2';
					$user_note['isactive'] = '1';
					$user_note['flag'] = '1';
					$this->api_model->user_notification($user_note);
					$this->push_non($user_id,  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg);
			}else{
				$user_note = '';
				$title = 'Advance Semen Booking';
				$flag = 1;
				$msg = 'The request of # '.$bu.'('.$breed[0]['breed_name'].') for advance semen booking has been successfully placed. ';
				$this->push_non($user_id,  0, $title , $flag, COUSTOMER_SERVERKEY, IOS_COUSTOMER_SERVERKEY, $msg);
				$user_note['users_id'] = $user_id;
				$user_note['title'] = $title;
				$user_note['message'] = $msg;
				$user_note['date'] = date('Y-m-d h:i:s');
				$user_note['type'] = '1';
				$user_note['isactive'] = '1';
				$user_note['flag'] = '1';
				$this->api_model->user_notification($user_note);
			}
			if(!empty($bank_detail)){
				if($bank_detail[0]['super_admin_id'] == 0){
					$user_note4 = '';
					$title = 'Advance Semen Booking';
					$flag = 1;
					$msg = 'The request of # '.$bu.'('.$breed[0]['breed_name'].') for advance semen booking has been generated by '.$full_name.' from '.$address.'';
					$this->push_non($bank_detail[0]['admin_id'],  2, $title , $flag, BUSINESS_AND_SERVERKEY, BUSINESS_IOS_SERVERKEY, $msg);
					$user_note4['users_id'] = $bank_detail[0]['admin_id'];
					$user_note4['title'] = $title;
					$user_note4['message'] = $msg;
					$user_note4['date'] = date('Y-m-d h:i:s');
					$user_note4['type'] = '3';
					$user_note4['isactive'] = '1';
					$user_note4['flag'] = '1';
					$this->api_model->user_notification($user_note4);
					$company_id = $bank_detail[0]['admin_id'];
				}else{
					$user_note = '';
					$title = 'Advance Semen Booking';
					$flag = 1;
					$msg = 'The request of # '.$bu.'('.$breed[0]['breed_name'].') for advance semen booking has been generated by '.$full_name.' from '.$address.'';
					$this->push_non($bank_detail[0]['admin_id'],  2, $title , $flag, BUSINESS_AND_SERVERKEY, BUSINESS_IOS_SERVERKEY, $msg);
					$user_note1['users_id'] = $bank_detail[0]['admin_id'];
					$user_note1['title'] = $title;
					$user_note1['message'] = $msg;
					$user_note1['date'] = date('Y-m-d h:i:s');
					$user_note1['type'] = '3';
					$user_note1['isactive'] = '1';
					$user_note1['flag'] = '1';
					$this->api_model->user_notification($user_note1);
					//$msg = 'The request of # '.$bu.'('.$breed[0]['breed_name'].') for advance semen booking has been generated by '.$full_name.' from '.$address.'';
					$sup_data = $this->api_model->get_admin_detail($bank_detail[0]['super_admin_id']);
					$user_note2['users_id'] = $sup_data[0]['admin_id'];
					$user_note2['title'] = $title;
					$user_note2['message'] = $msg;
					$user_note2['date'] = date('Y-m-d h:i:s');
					$user_note2['type'] = '3';
					$user_note2['isactive'] = '1';
					$user_note2['flag'] = '1';
					$this->api_model->user_notification($user_note2);
					$this->push_non($sup_data[0]['admin_id'],  2, $title , $flag, BUSINESS_AND_SERVERKEY, BUSINESS_IOS_SERVERKEY, $msg);
					//$msg = 'The request of # '.$bu.'('.$breed[0]['breed_name'].') for advance semen booking has been generated by '.$full_name.' from '.$address.'';
					$user_note3['users_id'] = $sup_data[0]['super_admin_id'];
					$user_note3['title'] = $title;
					$user_note3['message'] = $msg;
					$user_note3['date'] = date('Y-m-d h:i:s');
					$user_note3['type'] = '3';
					$user_note3['isactive'] = '1';
					$user_note3['flag'] = '1';
					$this->api_model->user_notification($user_note3);
					$company_id = $sup_data[0]['super_admin_id'];
					$this->push_non($sup_data[0]['super_admin_id'],  2, $title , $flag, BUSINESS_AND_SERVERKEY, BUSINESS_IOS_SERVERKEY, $msg);

					// $distributor_data = $this->api_model->get_distributor_by_latlong($longitude, $latitude, $bank_detail[0]['admin_id'], '10');
					// foreach($distributor_data as $dat){
					// 	$user_note['users_id'] = $dat['admin_id'];
					// 	$user_note['title'] = $title;
					// 	$user_note['message'] = $msg;
					// 	$user_note['date'] = date('Y-m-d h:i:s');
					// 	$user_note['type'] = '3';
					// 	$user_note['isactive'] = '1';
					// 	$user_note['flag'] = '1';
					// 	$this->api_model->user_notification($user_note);
					// 	$this->push_non($dat['admin_id'],  2, $title , $flag, BUSINESS_AND_SERVERKEY, BUSINESS_IOS_SERVERKEY, $msg);
					// }
				}
			}
			// $vt_data = $this->api_model->get_vt_comp_latitude_pvt($longitude,$latitude,'10');
			// $b = 0;
			// foreach($vt_data as $vt){
			// 	$user_note = '';
			// 	if($b == 0){
			// 		$vt_user = $vt['doctor_id']; 
			// 	}else{
			// 		$vt_user .= ','.$vt['doctor_id'];
			// 	}
			// 	$title = 'Advance Semen Booking';
			// 	$flag = 1;
			// 	$msg = 'The request of # '.$bu.'('.$breed[0]['breed_name'].') for advance semen booking has been generated by '.$full_name.' from '.$address.'';
			// 	$user_note['users_id'] = $vt['doctor_id'];
			// 	$user_note['title'] = $title;
			// 	$user_note['message'] = $msg;
			// 	$user_note['date'] = date('Y-m-d h:i:s');
			// 	$user_note['type'] = '2';
			// 	$user_note['isactive'] = '1';
			// 	$user_note['flag'] = '1';
			// 	$this->api_model->user_notification($user_note);
			// 	$this->push_non($vt['doctor_id'],  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg);
			// 	$b++;
			// }
			$ai_data['users_id'] = $user_id;
			$ai_data['bull_id'] = $bu;
			$ai_data['company_id'] = $company_id;
			$ai_data['log_id'] = $log_data['id'];
			$ai_data['distributor_id'] = $distributor_id[$i];
			$ai_data['vt_id'] = '';
			$ai_data['bull_price'] = $bull_price[$i];
			$ai_data['ispaid'] = '1';
			$ai_data['no_strow'] = $no_strow[$i];
			$ai_data['latitude'] = $latitude;
			$ai_data['longitude'] = $longitude;
			$ai_data['address'] = $address;
			$ai_data['requested_app'] = $payment_method;
			$ai_data['date'] = date('Y-m-d h:i:s');
			$ai_data['full_name'] = $full_name;
			$ai_data['mobile_no'] = $full_mobile;
			$this->api_model->business_ai_request($ai_data);
			$i++;
		}
	}

		
	public function push_notification_to_users_interested(){
		if($dta = $this->api_model->users_interested_records()){
			foreach ($dta as $key => $value) {
				$user_note = [];
				$title = 'Interested for your search';
				$msg = 'The request of for Interested search for Breeder Dealer';
				//$titleSecond = $this->translate("Interested for your search", "en", $value['lang_code']);
				$flag = 1;
				$msgSecond = $value['description'];
				$user_note['users_id'] = $value['users_id'];
				$user_note['title'] = $title;
				$user_note['message'] = $msg." ".$msgSecond;
				$user_note['date'] = date('Y-m-d h:i:s');
				$user_note['type'] = '4';
				$user_note['isactive'] = '1';
				$user_note['flag'] = '1';
				$this->api_model->user_notification($user_note);

				$old_msg['to_users_id'] =  $value['users_id'];
				$old_msg['to_id'] =  $value['users_id'];
				$old_msg['to_type'] = 'users';
				$old_msg['title'] = $title;
				$old_msg['from_type'] = 'Livestoc Team';
				$old_msg['success'] = '1';
				$old_msg['device'] = 'android';
				$old_msg['active'] = '1'; 
				$old_msg['description'] = $msg." ".$msgSecond;
				$old_msg['date_added'] = date('Y-m-d h:i:s');
				$this->api_model->old_notification($old_msg);

				$this->push_non_second($value['users_id'],  4, $title, $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg, $msgSecond);
			}
		} else {
			$data['success'] =  FALSE;
	      	$data['error'] =  "User id is required";
			header('Content-Type: application/json');
			echo json_encode($data);
			exit;
		}
	}
	public function translate($q, $sl, $tl){
		$res = file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=".$sl."&tl=".$tl."&hl=hl&q=".urlencode($q), $_SERVER['DOCUMENT_ROOT']."/transes.html");
		$res=json_decode($res);
		return $res[0][0][0];
	}
	public function push_non_second($user_id, $type , $title, $flag = 0, $server_key = 0, $key=0, $msg, $msgSecond, $fcm_and= '', $fcm_ios = ''){
		$detail = $this->api_model->get_fcm_user($user_id);
		if($detail[0]['fcm_android'] != ''){
			$fcm = $detail[0]['fcm_android'];
			$fcmMsg = array(
				'title' => $title,
				'description' => $msg.$msgSecond,
				'flag' => $flag,
				'date' => date('Y-m-d'),
			);
			/*$fcmMsgSecond = array(
				'title' => $title,
				'description' => $msgSecond,
				'flag' => $flag,
				'date' => date('Y-m-d')
			);*/
			$fcmFields = array(
				'to' => $fcm,
				'priority' => 'high',
				'notification' => $fcmMsg,
			);
			$headers = array(
				'Authorization: key=' . $key,
				'Content-Type: application/json'
			);
			
			$path_to_fcm = "https://fcm.googleapis.com/fcm/send";
			$headers = array(
			'Authorization:key=' . LIVESTOCK_AND_SERVERKEY, 
			'Content-Type:application/json');
			$keys = [$fcm];
			$fields = array(
			"registration_ids" => $keys,
			"priority" => "normal",
			'data' => array(
					'title' => $title,
					'description' => $fcmFields,
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
			echo "<pre>";
			print_r($curl_result);
			die();
		}
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
	public function get_push_note(){
		$id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		if($id == ''){
			$data['success'] =  FALSE;
	      	$data['error'] =  "User id is required";
		}else{
			$detail = $this->pushnoti_model->get_puch_note($id, $type);
			$data['success'] =  TRUE;
	      	$data['data'] =  $detail;
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	public function pre_order(){
		$user_id = $this->input->get_post('users_id');
		$request_type = $this->input->get_post('request_type');
		$detail = $this->api_model->pre_order_ai_table($user_id, $request_type);
		$detail1 = [];
		foreach($detail as $d){
			$go = $this->api_model->get_seman_detail($d['bull_id']);
			$d['bull_name'] = $go[0]['bull_name'];
			$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
			$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
            $d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
			$animal_category = $this->api_model->get_animal_category($go[0]['category']);
			$d['seman_category'] = $animal_category[0]['category'];
			$detail1[] = $d;
		}
		$data['success'] =  TRUE;
	    $data['data'] =  $detail1;
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	public function pre_order_comp(){
		$user_id = $this->input->get_post('users_id');
		$request_type = $this->input->get_post('request_type');
		$type = $this->input->get_post('type');
		$admin = $this->api_model->get_admin_detail($user_id);
			if($type == '1'){
					$detail = $this->api_model->pre_order_ai_table_ai($user_id, $request_type);
					$detail1 = [];
					foreach($detail as $d){
						$go = $this->api_model->get_seman_detail($d['bull_id']);
						$d['bull_name'] = $go[0]['bull_name'];
						$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
						$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
						$d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
						$animal_category = $this->api_model->get_animal_category($go[0]['category']);
						$d['seman_category'] = $animal_category[0]['category'];
						$detail1[] = $d;
					}
			}else{
				$detail = $this->api_model->pre_order_ai_table_comp($user_id, $request_type);
				$detail1 = [];
				foreach($detail as $d){
					$go = $this->api_model->get_seman_detail($d['bull_id']);
					$d['bull_name'] = $go[0]['bull_name'];
					$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
					$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
					$d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
					$animal_category = $this->api_model->get_animal_category($go[0]['category']);
					$d['seman_category'] = $animal_category[0]['category'];
					$detail1[] = $d;
				}
			}
			if(!empty($detail1)){
				$data['success'] =  TRUE;
				$data['data'] =  $detail1;
			}else{
				$data['success'] =  False;
				$data['error'] =  'No Data Found';
				$data['data'] =  [];
			}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	public function pre_order_pro(){
		$user_id = $this->input->get_post('users_id');
		$request_type = $this->input->get_post('request_type');
		$admin = $this->api_model->get_admin_detail($user_id);
		if($admin[0]['super_admin_id'] == '0'){
			$admin_ad = $this->api_model->get_admin_by_super_admin_id_type($user_id , 5);
			$i = 0;
			$user_id = '';
			foreach($admin_ad as $ad){
				if($i == 0){
					$user_id = $ad['admin_id'];
				}else{
					$user_id .= ','.$ad['admin_id'];
				}
			}
				$detail = $this->api_model->pre_order_ai_table_comp($user_id, $request_type);
				$detail1 = [];
				foreach($detail as $d){
					$go = $this->api_model->get_seman_detail($d['bull_id']);
					$d['bull_name'] = $go[0]['bull_name'];
					$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
					$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
					$d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
					$animal_category = $this->api_model->get_animal_category($go[0]['category']);
					$d['seman_category'] = $animal_category[0]['category'];
					$detail1[] = $d;
				}
		}else{
			$detail = $this->api_model->pre_order_ai_table_comp($user_id, $request_type);
			$detail1 = [];
			foreach($detail as $d){
				$go = $this->api_model->get_seman_detail($d['bull_id']);
				$d['bull_name'] = $go[0]['bull_name'];
				$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
				$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
				$d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
				$animal_category = $this->api_model->get_animal_category($go[0]['category']);
				$d['seman_category'] = $animal_category[0]['category'];
				$detail1[] = $d;
			}
		}
		
		$data['success'] =  TRUE;
	    $data['data'] =  $detail1;
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	public function pre_order_vt(){
		$user_id = $this->input->get_post('users_id');
		$request_type = $this->input->get_post('request_type');
		$detail = $this->api_model->pre_order_ai_table_vt($user_id, $request_type);
		$detail1 = [];
		foreach($detail as $d){
			$go = $this->api_model->get_seman_detail($d['bull_id']);
			$d['bull_name'] = $go[0]['bull_name'];
			$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
			$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
            $d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
			$animal_category = $this->api_model->get_animal_category($go[0]['category']);
			$d['seman_category'] = $animal_category[0]['category'];
			$detail1[] = $d;
		}
		$data['success'] =  TRUE;
	    $data['data'] =  $detail1;
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	public function update_company_data(){
		$data['latitude'] = $this->input->get_post('latitude');
		$data['longitude'] = $this->input->get_post('longitude');
		$data['complete_addr'] = $this->input->get_post('complete_addr');
		$admin_id = $this->input->get_post('admin_id');
		if($admin_id == ''){
				$json['success']  = false; 
				$json['error'] = "Please send Admin Id";
		}else{
			if($data = $this->api_model->update_company_data($admin_id, $data)){
				$json['success']  = true; 
				$json['data'] = '';
			}else{
				$json['success']  = false; 
				$json['error'] = "Database Error";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function update_doc_service_loc(){
		$admin_id = $this->input->get_post('doctor_id');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$address = $this->input->get_post('address');
		if($admin_id == ''){
				$json['success']  = false; 
				$json['error'] = "Please send doctor_id";
		}else{
			$data['langitute'] = $langitude;
			$data['latitute'] = $latitude;
			$data['address'] = $address;
			if($this->api_model->cheak_doc_service_loc($admin_id)){
				if($data = $this->api_model->update_doc_service_loc($admin_id, $data)){
				$json['success']  = true; 
				$json['data'] = $data;
				}else{
					$json['success']  = false; 
					$json['error'] = "Database Error";
				}
			}
			else{
				$data['doctor_id'] = $admin_id;
				if($data = $this->api_model->insert_doc_service_loc($data)){
				$json['success']  = true; 
				$json['data'] = $data;
				}else{
					$json['success']  = false; 
					$json['error'] = "Database Error";
				}
			}
			
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doc_service_lat_data(){
		$admin_id = $this->input->get_post('doctor_id');
		if($admin_id == ''){
				$json['success']  = false; 
				$json['error'] = "Please send Admin Id";
		}else{
			if($data = $this->api_model->cheak_doc_service_loc($admin_id)){
				$json['success']  = true; 
				$json['data'] = $data;
			}else{
				$json['success']  = false; 
				$json['error'] = "No Service Address Found";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doc_pricing_plan(){
		$id = $this->input->get_post('id');
		$doctor_id = $this->input->get_post('doctor_id');
		$data = $this->api_model->get_doc_premium_plans($id);
		$doc_data = $this->api_model->get_doc_premium_status($doctor_id);
		//print_r($doc_data);
		$detail = [];
		foreach ($data as  $d) {
			$d['premium'] = $doc_data[0]['is_premium'];
			$detail[] = $d;
		}
		$json['success']  = true; 
		$json['data'] = $detail;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_address_lat_data(){
		$admin_id = $this->input->get_post('admin_id');
		if($admin_id == ''){
				$json['success']  = false; 
				$json['error'] = "Please send Admin Id";
		}else{
			if($data = $this->api_model->get_address_lat_data($admin_id)){
				$json['success']  = true; 
				$json['data'] = $data;
			}else{
				$json['success']  = false; 
				$json['error'] = "Database Error";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_semen_bull_id(){
		$bull_id = $this->input->get_post('bull_id');
		$bull_data = $this->api_model->ai_bull_detail_id($bull_id);
		$users_id = $this->input->get_post('users_id');
		// $d['tag_no'] = $bull_data[0]['bull_no'];
		// $d['price'] = $bull_data[0]['price'];
		// $d['ai_price'] = $bull_data[0]['ai_price'];
		// $d['distributor_price'] = $bull_data[0]['distributor_price'];	
		// $d['progini_test'] = $bull_data[0]['progini_test'];
		$champ_img = json_decode($bull_data[0]['championship_images']);
		$chmp = [];
		foreach($champ_img as $ch){
			$chmp[] = base_url().'uploads/bank/'.$ch;
		}
		$count = $this->api_model->get_like_count($bull_id,0);
		$bull_data[0]['like'] = $count[0]['count'];
		if($users_id != ''){
			if($like = $this->api_model->get_like_status($users_id, $bull_id,0)){
				$bull_data[0]['like_status'] = '1';
			}else{
				$bull_data[0]['like_status'] = '0';
			}
		}
		$bull_data[0]['championship_images'] = $chmp;
		$admin_detail = $this->api_model->get_admin_detail($bull_data[0]['bull_source']);
		if($admin_detail[0]['fname'] == ''){
			$bull_data[0]['semen_bank_name'] = $admin_detail[0]['bank_name'];
		}else{
			$bull_data[0]['semen_bank_name'] = $admin_detail[0]['fname'];
		}
		$bull_data[0]['price'] = $bull_data[0]['price'] + $bull_data[0]['company_charges'];
		$cat_name = $this->api_model->get_category($bull_data[0]['category']);
		$bull_data[0]['bull_cat_name'] = $cat_name[0]['category'];
		$bread_name = $this->api_model->get_animal_breed($bull_data[0]['bread']);
		$bull_data[0]['bull_bread_name'] = $bread_name[0]['breed_name'];
		if($bull_data[0]['registration_certificate'] != ''){
			$bull_data[0]['registration_certificate'] = base_url().'uploads/bank/'.$bull_data[0]['registration_certificate'];
		}else{
			$bull_data[0]['registration_certificate'] = '';
		}
		if($bull_data[0]['brochure'] != ''){
			$bull_data[0]['brochure'] = base_url().'uploads/bank/'.$bull_data[0]['brochure'];
		}else{
			$bull_data[0]['brochure'] = '';
		}
		if($bull_data[0]['health_certificate'] != ''){
			$bull_data[0]['health_certificate'] = base_url().'uploads/bank/'.$bull_data[0]['health_certificate'];
		}else{
			$bull_data[0]['health_certificate'] = '';
		}
		if($bull_data[0]['image'] != ''){
			$bull_data[0]['bull_image'] = base_url().'uploads/bank/'.$bull_data[0]['image'];
		}else{
			$bull_data[0]['bull_image'] = '';
		}
		if($bull_data[0]['video']!=''){
			$bull_data[0]['video'] = base_url().'uploads/bank/'.$bull_data[0]['video'];
		}else{
			$bull_data[0]['video'] = '';
		}
		$json['success']  = true; 
		$json['data'] = $bull_data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function business_payment(){
		$purchase_id = $this->input->get_post('purchase_id');
		$month_id = $this->input->get_post('month_id');
		$bull_id = $this->input->get_post('bull_id');
		$bank_id = $this->input->get_post('bank_id');
		$data['payment_type'] = 'Cr';
		$data['status'] = 1;
		$data['request_id'] = $bull_id;
		$data['ai_id'] = $month_id;
		$detail = $this->api_model->get_log_file_id($purchase_id);
		$bull_data['ispremium'] = $detail[0]['premium_bull_type'];
		$this->api_model->update_log_file($data, $purchase_id);
		$this->api_model->change_active_status($bull_id, $bull_data);
	}
	public function get_facility_price(){
		$data['facility'] = $this->api_model->get_facility();
		$data['price'] = $this->api_model->get_premium_bull_price();
		$json['success']  = true;
		$json['data'] = $data;
		header('Content-Type:application/json');
		echo json_encode($json);
		exit;
	}

	public function get_breed_dealer_details(){
		$type = $this->input->get_post('type');
		$data = $this->api_model->get_breed_dealer($type);		
		if(!empty($data)){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = 'No datafound.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_premium_listing_rate(){
		$type = $this->input->get_post('type');
		if(!isset($type) ||$type == ''){
			$json['success']  = false; 
			$json['error'] = 'Please Send Type.';
		}else{
			if($data = $this->api_model->get_premium_bull_rate($type)){
				$json['success']  = true; 
				$json['data'] = $data;
			}else{
				$json['success']  = false; 
				$json['error'] = 'No Data Found.';
			}
		}
		header('Content-Type:application/json');
		echo json_encode($json);
		exit;
	}
	public function semen_price(){
		$type = $this->input->get_post('type');
		$users_id =$this->input->get_post('users_id');
		$bull_id = $this->input->get_post('bull_id');
		$seman_qty = $this->input->get_post('seman_qty');
		$bull_id = json_decode($bull_id);
		$seman_qty = json_decode($seman_qty);
		if(isset($type)){
			if($type == '1'){
				$type = 'price';
			}if($type == '2'){
				$type = 'ai_price';
			}if($type == '3'){
				$type = 'distributor_price';
			}
		}
		$data = [];
		$detail =[];
		$detail_1 =[];
		$i = 0;
		$y = 0;
		$num_strow = 0;
		$ai_charge = 0;
		foreach($bull_id as $bu){
			$d = $this->api_model->get_semen_price($type, $bu);
			// print_r($d);
			// exit;
			foreach($d as $ds){
				$data[$i]['service_key'] = "Bull ID"." #".$ds['id']." * ".$seman_qty[$y];
				if($type == 'ai_price'){
					$data[$i]['price'] = ($ds['price'] * $seman_qty[$y]);
					$company_charg += ((($ds['price'] * $seman_qty[$y]) * $ds['Company_charges'])/100);
				}else{
					$data[$i]['price'] = $ds['price'] * $seman_qty[$y];
					$ai_charge += $ds['vt_ai_price'] *  $seman_qty[$y];
				}
				$i++;
				$num_strow += $seman_qty[$y];
				$i++;
			}
			$detail =$data;
			$y++;
		}
		$detail_1['services_charges'] = array_values($detail);
		if($type == 'ai_price'){
			$detail_1['company_charges']['no_strow'] = $num_strow;
			$detail_1['company_charges']['price'] = $company_charg;
		}else{
			$detail_1['ai_charges']['no_strow'] = $num_strow;
			$detail_1['ai_charges']['price'] = $ai_charge;
		}
		$json['success']  = true; 
		$json['data'] = $detail_1;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function check_activate_status(){
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
			if($admin_detail[0]['user_type'] == '1' || $admin_detail[0]['user_type'] == '5'){
				$data = $this->api_model->get_coustomer_pre_count($admin_detail[0]['admin_id']);
			}else if($admin_detail[0]['user_type'] == '2' || $admin_detail[0]['user_type'] == '3' || $admin_detail[0]['user_type'] == '4'){
				$d = $this->api_model->get_coustomer_pre_comp_count($admin_detail[0]['admin_id']);
				$data[0]['count'] = $d;
			}
			$user_count = $this->api_model->get_admin_sub_user($admin_id);
			$count['sub_user_count'] = $user_count[0]['count'];
			$count['coustomer_order'] = $data[0]['count'];
			$detail['count'] = $count;
			$json['success']  = True; 
			$json['data'] = $detail;
		}
		//print_r($data);
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_semen_vt_distributer(){
		$type = $this->input->get_post('type');
		$search = $this->input->get_post('search');
		if($type == 6){
			$data = $this->api_model->get_semen_vt_ai($search, '"pvt_ai", "govt_vt", "pvt_vt"');
			$json['success']  = True; 
			$json['data'] = $data;
		}else{
			$data = $this->api_model->get_semen_vt_ai($search, '"pvt_ai", "govt_vt", "pvt_vt"');
			$detail =[]; 
			foreach($data as $d){
				$d['image'] = base_url().'uploads/doc/'.$d['image'];
				$detail[] = $d;
			}
			$json['success']  = True; 
			$json['data'] = $detail;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function semen_bull_deactive(){
		$bull_id = $this->input->get_post('bull_id');
		$data['isactive'] = $this->input->get_post('isactive');
		if($this->api_model->change_active_status($bull_id, $data)){
			$json['success']  = true; 
			$json['msg'] = "Successfully Deleted";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function semen_strow_deactive(){
		$stock_id = $this->input->get_post('stock_id');
		$data['isactive'] = $this->input->get_post('isactive');
		if($this->api_model->change_stow_active_status($stock_id, $data)){
			$json['success']  = true; 
			$json['msg'] = "Successfully Deleted";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_semen_stock_listing(){
		$admin_id = $this->input->get_post('admin_id');
		$name = $this->input->get_post('name');
		if($data = $this->api_model->get_semen_stock_listing($admin_id, $name)){
			// print_r($data);
			// exit;
			$detail = [];
			foreach($data as $d){
				$bull_data = $this->api_model->ai_bull_detail_id($d['bull_id']);
				$d['tag_no'] = $bull_data[0]['bull_no'];
				$d['progini_test'] = $bull_data[0]['progini_test'];
				$admin_detail = $this->api_model->get_admin_detail($d['bank_id']);
				$d['semen_bank_name'] = $admin_detail[0]['fname'];
				$cat_name = $this->api_model->get_category($bull_data[0]['category']);
				$d['bull_cat_name'] = $cat_name[0]['category'];
				$bread_name = $this->api_model->get_animal_breed($bull_data[0]['bread']);
				$d['bull_bread_name'] = $bread_name[0]['breed_name'];
				$d['bull_image'] = base_url().'uploads/bank/'.$bull_data[0]['image'];
				$detail[] = $d;
			}
			$json['success']  = true; 
			$json['data'] = $detail;
		}else{
			$json['success']  = false; 
			$json['error'] = 'No stock Found.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function delivery_partner(){
		$search = $this->input->get_post('search');
			$data = $this->api_model->delivery_partner($search);
			$detail =[]; 	
			foreach($data as $d){
				$d['image'] = base_url().'uploads/bank/'.$d['image'];
				$detail[] = $d;
			}
			$json['success']  = True; 
			$json['data'] = $detail;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function update_comp_fcm()	
	{
		$json_data = array();
		$users_id = $this->input->get_post('admin_id');
		$fcm = $this->input->get_post('fcm');
		$status = $this->input->get_post('status');
		if(!isset($users_id) || $users_id == '')
		{
		   	$json_data['error'] = "Users id is required";
		}
		if (!isset($fcm) || $fcm == '') {
          $json_data['error'] =  "FCM is required";
		}
		if (!isset($status) || $status == '' || ($status != 'android' && $status != 'ios')) {
			$json_data['error'] =  "Please send android or ios ";
		}
		if(!$json_data)
		{
			if($status =='android')
			{
				 $data = [
                        'fcm_and'              =>  $fcm
                    ];
			}
			elseif($status =='ios')
			{
				 $data = [
                        'fcm_IOS'              =>  $fcm
                    ];
				
			}
					
			$this->api_model->update_comp_fcm($users_id,$data);
			$json_data['success'] = TRUE;
			$json_data['data']['msg'] = $status." Fcm Updated Succesfully";
		
		}
		else
		{
			$json_data['success'] = FALSE;
			
		}
		header('Content-Type:application/json');
		echo json_encode($json_data);
		exit;
		
	}
	public function add_semen_bull(){
			$data['bull_no'] = $this->input->get_post('bull_no');
			$data['bull_id'] = $this->input->get_post('bull_id');
			$data['dob'] = $this->input->get_post('dob');
			$data['bull_name'] = $this->input->get_post('bull_name');
			$data['sire_no'] = $this->input->get_post('sire_no');
			$data['brochure'] = $this->input->get_post('brochure');
			$data['daughter_yield'] = $this->input->get_post('daughter_yield');
			$data['total_milk_fat'] = $this->input->get_post('total_milk_fat');
			$data['sires_breed'] = $this->input->get_post('sires_breed');
			$data['dams_breed'] = $this->input->get_post('dams_breed');
			$data['total_milk_proteen'] = $this->input->get_post('total_milk_proteen');
			$data['star_cat'] = $this->input->get_post('star_cat');
			$data['avg_milk_proteen'] = $this->input->get_post('avg_milk_proteen');
			$data['rating'] = $this->input->get_post('rating');
			$data['seman_category'] = $this->input->get_post('seman_category');
			$data['image'] = $this->input->get_post('image');
			$data['is_imported'] = $this->input->get_post('is_imported');
			$data['is_certified'] = $this->input->get_post('is_certified');
			$data['video'] = $this->input->get_post('video');
			$data['progini_record'] = $this->input->get_post('progini_record');
			$data['progini_test'] = $this->input->get_post('progini_test');
			$data['other_document'] = $this->input->get_post('other_document');
			$data['registration_certificate'] = $this->input->get_post('registration_certificate');
			$data['championship_images'] = $this->input->get_post('championship_images');
			$data['health_certificate'] = $this->input->get_post('health_certificate');
			$data['price'] = $this->input->get_post('price');
			$data['ai_price'] = $this->input->get_post('ai_price');
			$data['distributor_price'] = $this->input->get_post('distributor_price');
			$data['description'] = $this->input->get_post('description');
			$data['sires_breed'] = $this->input->get_post('sires_breed');
			$data['dam_no'] = $this->input->get_post('dam_no');
			$data['lat_yield'] = $this->input->get_post('lat_yield');
			$data['lact_no'] = $this->input->get_post('lact_no');
			$data['bull_source'] = $this->input->get_post('bull_source');
			$data['milk_type'] = $this->input->get_post('milk_type');
			$data['category'] = $this->input->get_post('category');
			$data['semen_type'] = $this->input->get_post('semen_type');
			$data['bread'] = $this->input->get_post('bread');
			$detail = $this->api_model->add_bull($data);
			if($detail){
				$json['success']  = true; 
				$json['bull_id'] = $detail;
				$json['msg'] = 'Your bull has been successfully Added.';
			}else{
				$json['success']  = false; 
				$json['error'] = 'There is problem with database.';
			}
			header('Content-Type:application/json');
			echo json_encode($json);
			exit;
	}
	public function listing_authority(){
		$admin_id = $this->input->get_post('admin_id');
		$user_type = $this->input->get_post('user_type');
		$search = $this->input->get_post('search');
		if(!isset($admin_id) || $admin_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send ID";
		}else if(!isset($user_type) || $user_type == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send Type";
		}else{
			if($data = $this->api_model->listing_authority($admin_id, $user_type, $search)){

				$detail = [];
				foreach($data as $d){
					if($d['admin_id']){
						$admin_data = $this->api_model->get_admin_detail($d['super_admin_id']);
						$d['super_admin_name'] = $admin_data[0]['fname'];
						$d['image'] =  base_url().'uploads/bank/'.$d['image'];
						$detail[] = $d;
					}
				}
				if(!empty($detail)){
					$json['success']  = True; 
					$json['data'] = $detail;
				}else{
					$json['success']  = false; 
					if($user_type == 5){
						$json['error'] = "No Semen Bank/Authority found. Please add first";
					}else if($user_type == 6){
						$json['error'] = "No Semen Distributer found. Please add first";
					}else{
						$json['error'] = "No Semen Supplier found. Please add first";
					}
				}
				
			}else{
				$json['success']  = false; 
				if($user_type == 5){
					$json['error'] = "No Semen Bank/Authority found. Please add first";
				}else if($user_type == 6){
					$json['error'] = "No Semen Distributer found. Please add first";
				}else{
					$json['error'] = "No Semen Supplier found. Please add first";
				}
			}
		}
		header('Content-Type:application/json');
		echo json_encode($json);
		exit;
	}
	public function athority_count(){
		$admin_id = $this->input->get_post('admin_id');
		$user_type = $this->input->get_post('user_type');
		if(!isset($admin_id) || $admin_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send ID";
		}else if(!isset($user_type) || $user_type == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send Type";
		}else{
			if($data = $this->api_model->athority_count($admin_id, $user_type)){
				$json['success']  = True; 
				$json['data'] = $detail;
			}else{
				$json['success']  = false; 
				$json['error'] = "NO Data Found";
			}
		}
		header('Content-Type:application/json');
		echo json_encode($json);
		exit;
	}
	public function change_status_company(){
		$admin_id = $this->input->get_post('admin_id');
		$status = $this->input->get_post('status');
		if(!isset($admin_id) || $admin_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send ID";
		}else if(!isset($status) || $status == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send Status";
		}else{
			$detail['isactivated'] = $status;
			if($this->api_model->change_status_company($admin_id, $detail)){
				$json['success']  = True;
				if($status == 1){
					$msg = "This A/c has been Successfully Activated";
				}else{
					$msg = "This A/c has been Successfully Deactivated";
				} 
				$json['msg'] = $msg;
			}else{
				$json['success']  = False; 
				$json['error'] = 'Database Error';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function edit_sub_user_type_document(){
		$user_id = $this->input->get_post('admin_id');
		$document_name = $this->input->get_post('document_name');
		$document_name_image = $this->input->get_post('document_name_image');
		$data[''.$document_name.''] = $document_name_image;
		if($detail = $this->api_model->change_status_company($user_id, $data)){
			$json['success']  = true;
			$json['msg']  = "Your Document successfully updated";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function add_sub_user_type_edit(){
		$user_id = $this->input->get_post('admin_id');
		// if($_SESSION['status'] == 1){
		// 	$user_id = $_SESSION['user_id']; 
		// }else{
		// 	$super_id = $this->input->get_post('super_admin_id');
		// 	$user_id = isset($super_id) ? $super_id : 0;
		// }
		$data['email'] = $this->input->get_post('email');
		$data['password'] = md5($this->input->get_post('password'));
		$data['fname'] = $this->input->get_post('fname');
		$data['lname'] = $this->input->get_post('lname');
		$data['bank_name'] = $this->input->get_post('bank_name');
		$data['image'] = $this->input->get_post('image');
		$data['type'] = $this->input->get_post('type');
		$data['gst_no'] = $this->input->get_post('gst_no');
		$data['moa_aoa'] = $this->input->get_post('moa_aoa');
		$data['cin'] = $this->input->get_post('cin');
		$data['user_type'] = $this->input->get_post('user_type');
		$data['cin_document'] = $this->input->get_post('cin_document');
		$data['adhar_no'] = $this->input->get_post('adhar_no');
		$data['adhar_image'] = $this->input->get_post('adhar_image');
		$data['pan_no'] = $this->input->get_post('pan_no');
		$data['pin'] = $this->input->get_post('pin');
		$data['s_s_grade'] = $this->input->get_post('s_s_grade');
		$data['semen_bank_type'] = $this->input->get_post('semen_bank_type');
		$data['adhar_back_image'] = $this->input->get_post('adhar_back_image');
		$data['address'] = $this->input->get_post('address');
		$data['rent_dead'] = $this->input->get_post('rent_dead');
		$data['mobile'] = $this->input->get_post('mobile');
		$data['phone'] = $this->input->get_post('phone');
		$data['district'] = $this->input->get_post('district');
		$data['fcm_and'] = $this->input->get_post('fcm_and');
		$data['fcm_IOS'] = $this->input->get_post('fcm_IOS');
		$data['state'] = $this->input->get_post('state');
		$service_district = $this->input->get_post('service_district');
		$service_district = json_decode($service_district);
		$service_district = implode(',', $service_district);
		$service_state = $this->input->get_post('service_state');
		// $service_state = json_decode($service_state);
		// $service_state = implode(',',$service_state);
		$data['service_state'] = $service_state;
		$data['service_district'] = $service_district;
		$data['contact_person'] = $this->input->get_post('contact_person');
		$data['authorisation_letter'] = $this->input->get_post('authorisation_letter');
		$data['proprietorship_ship'] = $this->input->get_post('proprietorship_ship');
		$data['proprietorship_document'] = $this->input->get_post('proprietorship_document');
		$data['created_on'] = date('Y-m-d h:i:s');
		//if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
			if($detail = $this->api_model->change_status_company($user_id, $data)){
				$json['success']  = true; 
				$junk_data = $this->api_model->get_seman_company_id($user_id);
				$dist = $this->api_model->get_distict_id($junk_data[0]['district']);
				$state = $this->api_model->get_state_id($junk_data[0]['state']);
				$junk_data[0]['state_name'] = $state[0]['state_name'];
				$junk_data[0]['district_name'] = $dist[0]['dist_name'];
				$junk_data[0]['image'] = base_url().'uploads/bank/'.$junk_data[0]['image'];
				$json['data'] = $junk_data;
			}else{
				$json['success']  = false; 
				$json['error'] = "Error with database";
			}
		// }else{
		// 	$json['success']  = false; 
		// 	$json['error'] = "Email ID is already associated with other Account";
		// }
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function add_sub_user_type(){
		if($_SESSION['status'] == 1){
			$data['super_admin_id'] = $_SESSION['user_id']; 
		}else{
			$super_id = $this->input->get_post('super_admin_id');
			$data['super_admin_id'] = isset($super_id) ? $super_id : 0;
		}
		$data['email'] = $this->input->get_post('email');
		$data['password'] = md5($this->input->get_post('password'));
		$data['fname'] = $this->input->get_post('fname');
		$data['lname'] = $this->input->get_post('lname');
		$data['bank_name'] = $this->input->get_post('bank_name');
		$data['image'] = $this->input->get_post('image');
		$data['type'] = $this->input->get_post('type');
		$data['gst_no'] = $this->input->get_post('gst_no');
		$data['moa_aoa'] = $this->input->get_post('moa_aoa');
		$data['cin'] = $this->input->get_post('cin');
		$data['user_type'] = $this->input->get_post('user_type');
		$data['cin_document'] = $this->input->get_post('cin_document');
		$data['adhar_no'] = $this->input->get_post('adhar_no');
		$data['adhar_image'] = $this->input->get_post('adhar_image');
		$data['pan_no'] = $this->input->get_post('pan_no');
		$data['pin'] = $this->input->get_post('pin');
		$data['s_s_grade'] = $this->input->get_post('s_s_grade');
		$data['semen_bank_type'] = $this->input->get_post('semen_bank_type');
		$data['address'] = $this->input->get_post('address');
		$data['rent_dead'] = $this->input->get_post('rent_dead');
		$data['mobile'] = $this->input->get_post('mobile');
		$data['phone'] = $this->input->get_post('phone');
		$data['district'] = $this->input->get_post('district');
		$data['fcm_and'] = $this->input->get_post('fcm_and');
		$data['fcm_IOS'] = $this->input->get_post('fcm_IOS');
		$data['state'] = $this->input->get_post('state');
		$data['contact_person'] = $this->input->get_post('contact_person');
		$data['authorisation_letter'] = $this->input->get_post('authorisation_letter');
		$data['proprietorship_ship'] = $this->input->get_post('proprietorship_ship');
		$data['proprietorship_document'] = $this->input->get_post('proprietorship_document');
		$data['created_on'] = date('Y-m-d h:i:s');
		if($this->api_model->comp_mobile_email($data['mobile'])){
			$json['success']  = false; 
			$json['error'] = "Mobile No is already associated with other Account";
		}
		else if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
			if($detail = $this->api_model->add_bank($data)){
				$json['success']  = true; 
				$junk_data = $this->api_model->get_seman_company_id($detail);
				$dist = $this->api_model->get_distict_id($junk_data[0]['district']);
				$state = $this->api_model->get_state_id($junk_data[0]['state']);
				$junk_data[0]['state_name'] = $state[0]['state_name'];
				$junk_data[0]['district_name'] = $dist[0]['dist_name'];
				$junk_data[0]['image'] = base_url().'uploads/bank/'.$junk_data[0]['image'];
				$json['data'] = $junk_data;
			}else{
				$json['success']  = false; 
				$json['error'] = "Error with database";
			}
		}else{
			$json['success']  = false; 
			$json['error'] = "Email ID is already associated with other Account";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function visiting_fees(){
		$data['visiting_fee'] = $this->input->get_post('visiting_fee');
		$id= $this->input->get_post('doc_id');
		if($this->api_model->update_payment_status($data,  $id)){
			$json['success']  = true; 
			$json['msg'] = "Your Visitation Charges Succesfully Updated";
		}else{
			$json['success']  = false; 
			$json['error'] = "Error with database";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function comp_mobile(){
		$mobile = $this->input->get_post('mobile');
		if($data = $this->api_model->comp_mobile_email($mobile)){
			$json['success'] = true;
			$json['data'] = $data;
		}
		else{
			$json['success'] = false;
			$json['error'] = 'Your Mobile no is not registered with us.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function comp_mobile_email(){
		$mobile = $this->input->get_post('mobile');
		$email = $this->input->get_post('email');
		if(isset($mobile)){
			if($this->api_model->comp_mobile_email($mobile)){
				$json['success'] = false;
				$json['error'] = 'This Mobile no is already associated with another account. Please use another one';
			}else{
				$json['success'] = true;
			}
		}else if(isset($email)){
			if($this->api_model->comp_mobile_email($mobile = '', $email)){
				$json['success'] = false;
				$json['error'] = 'This Email is already associated with another account. Please use another one';
			}else{
				$json['success'] = true;
			}
		}
		else if($this->api_model->comp_mobile_email($mobile, $email)){
			$json['success'] = false;
		}else{
			$json['success'] = true;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function village(){
		$dist_id = $this->input->get_post('dis_id');
		if($data = $this->api_model->get_village($dist_id)){
			$json['success'] = true;
		  	$json['data'] = $data;
		}else{
			$json['success'] = false;
		  	$json['error'] = 'No Village found with this district';
		}
		echo json_encode($json);
	}
	public function login_comp(){
		if($_REQUEST['email']!='' && $_REQUEST['password']!='')
		{
			$username = $_REQUEST['email'];
			$password = $_REQUEST['password'];	
			$data = [];
			if($login_detail = $this->loginmodel->login_valid($username, $password))
			{
				$dist = $this->api_model->get_distict_id($login_detail->district);
				$state = $this->api_model->get_state_id($login_detail->state);
				$login_detail->state_name = $state[0]['state_name'];
				$login_detail->district_name = $dist[0]['dist_name'];
				$login_detail->image = base_url().'uploads/bank/'.$login_detail->image;
				$json['success']  = true; 
				$json['data'] = $login_detail;
			}
			else
			{
				$json['success']  = false; 
				$json['error'] = "Please check your email and password";
			}
		}
		else
		{
			$json['success']  = false; 
			$json['error'] = "Error with database";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function add_company_semen(){
		$data['email'] = $this->input->get_post('email');
		$data['password'] = md5($this->input->get_post('password'));
		$data['fname'] = $this->input->get_post('fname');
		$data['lname'] = $this->input->get_post('lname');
		$data['bank_name'] = $this->input->get_post('bank_name');
		$data['image'] = $this->input->get_post('image');
		$data['type'] = $this->input->get_post('type');
		$data['gst_no'] = $this->input->get_post('gst_no');
		$data['moa_aoa'] = $this->input->get_post('moa_aoa');
		$data['cin'] = $this->input->get_post('cin');
		$data['pancard'] = $this->input->get_post('pancard');
		$data['pan_no'] = $this->input->get_post('pan_no');
		$data['address'] = $this->input->get_post('address');
		$data['rent_dead'] = $this->input->get_post('rent_dead');
		$data['mobile'] = $this->input->get_post('mobile');
		$data['phone'] = $this->input->get_post('phone');
		$data['contact_person'] = $this->input->get_post('contact_person');
		$data['proprietorship_ship'] = $this->input->get_post('proprietorship_ship');
		$data['proprietorship_document'] = $this->input->get_post('proprietorship_document');
		$data['created_on'] = date('Y-m-d h:i:s');
		if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
			if($detail = $this->api_model->add_bank($data)){
				//print_r($detail);
				$json['success']  = true; 
				$json['data'] = $this->api_model->get_seman_company_id($detail);
				//$json['data'] = $this->api_model->get_seman_company_id($detail);
			}else{
				$json['success']  = false; 
				$json['error'] = "Error with database";
			}
		}else{
			$json['success']  = false; 
			$json['error'] = "Email ID is already associated with other Account";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function add_stock(){
		$data['bull_id'] = $this->input->get_post('bull_id');
		$data['batch_no'] = $this->input->get_post('batch_no');
		$data['rest_stock'] = $this->input->get_post('opening_stock');
		$data['opening_stock'] = $this->input->get_post('opening_stock');
		$data['date'] = date('Y-m-d h:i:s');
		$data['ejacuation_no'] = $this->input->get_post('ejacuation_no');
		$data['bank_id'] = $this->input->get_post('bank_id');
		$data['type'] = $this->input->get_post('type');
		$data['image'] = $this->input->get_post('image');
		$data['admin_id'] = $this->input->get_post('admin_id');
		if($detail = $this->api_model->add_semen_stock($data)){
			$json['success']  = True; 
			$json['msg'] = "Your Semen Stock Added";
		}else{
			$json['success']  = false; 
			$json['error'] = "Database Error";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function user_reff_insert_req(){
		$data['user_id'] = $this->input->get_post('user_id');
		$data['refral_code'] = $this->input->get_post('refral_code');
		$data['updated_by'] = $this->input->get_post('updated_by');
		$data['created_on'] = $this->input->get_post('created_on');
		$data['on_update'] = $this->input->get_post('on_update');
		if($this->api_model->check_ref($data['refral_code'])){
			if($detail = $this->api_model->submit('user_reff_update_req',$data)){
				$json['success']  = True; 
				$json['msg'] = "Your request for updating Service Provider has been submited successfuly.";
			}else{
				$json['success']  = false; 
				$json['error'] = "Database Error";
			}
		}else{
			$json['success']  = false; 
			$json['error'] = "Database Error";
		}		
		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_jobs(){
		$category = json_decode($_REQUEST['category']);
		if(!empty($category->subcate_data)){
			$exp = $category->id;
			$y = 0;
			$s_exp = '';
			foreach($category->subcate_data as $sub_cat){
				$sub_data['job_category_id'] = $category->id;
				$sub_data['sub_cat_name'] = $sub_cat->other_name;
				if(isset($sub_cat->other_name)){
					$sub_last = $this->api_model->submit('job_sub_category', $sub_data);
					$s_exp .= $sub_cat->id.','.$sub_last;
				}else{
					if($y == 0){
						$s_exp .= $sub_cat->id;
					}
					else{
						$s_exp .= ','.$sub_cat->id;
					}
				}
				if(!empty($sub_cat->sub_sub_cat)){
					$s = 0;
					$s_s_exp = 0;
					foreach($sub_cat->sub_sub_cat as $sub_sub){
						if($sub_sub->other_name != ''){
							$sub_sub_data['sub_cat_id'] = $sub_sub->sub_cat_id;
							$sub_sub_data['sub_cat_name'] = $sub_sub->other_name;
							$sub_last = $this->api_model->submit('job_sub_subcategory', $sub_sub_data);
							if($s == 0){
								$s_s_exp = $sub_sub->id.','.$sub_last;
							}else{
								$s_s_exp .= $sub_sub->id.','.$sub_last; 
							}
						}else{
							if($s == 0){
								$s_s_exp = $sub_sub->id;
							}else{
								$s_s_exp .=','.$sub_sub->id; 
							}
						}
						$s++;
					}
				}
				$y++;
			}
		}
		$data['category'] = $exp;
		$data['sub_category'] = $s_exp;
		$data['sub_subcategory'] = $s_s_exp;
		//print_r($data);
		$data['users_id'] = $this->input->get_post('users_id');
		$location = $this->input->get_post('prefered_location');
		$data['prefered_location'] = implode(',', json_decode($location));
		$salary = explode(' ',$this->input->get_post('salary'));
		$data['salary'] = $salary[0];
		$salary_thousand = explode(' ',$this->input->get_post('salary_thousand'));
		$data['salary_thousand'] = $salary_thousand[0];
		$expected_salary = explode(' ',$this->input->get_post('expected_salary'));
		$data['expected_salary'] = $expected_salary[0];
		$expected_salary_thousand = explode(' ',$this->input->get_post('expected_salary_thousand'));
		$data['expected_salary_thousand'] = $expected_salary_thousand[0];
		$notice = $notice[0];
		$notice = $this->input->get_post('notice');
		$notice = explode(' ',$this->input->get_post('notice'));
		$data['notice'] = $notice[0];
		$data['show_in_job'] = $this->input->get_post('show_in_job');
		$resume['users_id'] = $this->input->get_post('users_id');
		$resume['resume'] = $this->input->get_post('resume');		
		$data['date'] = date('Y-m-d h:i:s');
		$date['updated_on'] = date('Y-m-d h:i:s');	
		if($data= $this->api_model->submit('naukari_profile',$data)){
			if($resume['resume'] != '')
			$this->api_model->submit('job_resume',$resume);
			$json['success']= true;
			$json['msg'] = "Your information has been successfully submitted.";
		}else{
			$json['success']= false;
			$json['error']="Database Error";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function jobs_profile_update(){
		$category = json_decode($_REQUEST['category']);
		$exp = $category->id;
		if(!empty($category->subcate_data)){
			$y = 0;
			$s_exp = '';
			foreach($category->subcate_data as $sub_cat){
				$sub_data['job_category_id'] = $category->id;
				$sub_data['sub_cat_name'] = $sub_cat->other_name;
				if($sub_cat->other_name != ''){
					$sub_last = $this->api_model->submit('job_sub_category', $sub_data);
					$s_exp .= $sub_cat->id.','.$sub_last;
				}else{
					if($y == 0){
						$s_exp .= $sub_cat->id;
					}
					else{
						$s_exp .= ','.$sub_cat->id;
					}
				}
				if(!empty($sub_cat->sub_sub_cat)){
					$s = 0;
					$s_s_exp = 0;
					foreach($sub_cat->sub_sub_cat as $sub_sub){
						if($sub_sub->other_name != ''){
							$sub_sub_data['sub_cat_id'] = $sub_sub->sub_cat_id;
							$sub_sub_data['sub_cat_name'] = $sub_sub->other_name;
							$sub_last = $this->api_model->submit('job_sub_subcategory', $sub_sub_data);
							if($s == 0){
								$s_s_exp = $sub_sub->id.','.$sub_last;
							}else{
								$s_s_exp .= $sub_sub->id.','.$sub_last; 
							}
						}else{
							if($s == 0){
								$s_s_exp = $sub_sub->id;
							}else{
								$s_s_exp .=','.$sub_sub->id; 
							}
						}
						$s++;
					}
				}
				$y++;
			}
		}
		if($exp != ''){
			$data['category'] = $exp;
		}
		if($s_exp != ''){
			$data['sub_category'] = $s_exp;
		}
		if($s_s_exp != ''){
			$data['sub_subcategory'] = $s_s_exp;
		}	
		// print_r($data);
		// exit;
		$users_id = $this->input->get_post('users_id');
		if($users_id != '' || !isset($users_id)){
			$data['users_id'] = $users_id;		
		}			
		$location = $this->input->get_post('prefered_location');
		if($location != '' || !isset($location)){
			$prefered_location = implode(',', json_decode($location));
			$data['prefered_location'] = $prefered_location;		
		}
		$show_in_job = $this->input->get_post('show_in_job');
		// if($show_in_job != '' || !isset($show_in_job)){
			$data['show_in_job'] = $show_in_job;	
		// }
		$salary = $this->input->get_post('salary');
		if($salary != '' || !isset($salary)){
			$salary = explode(' ',$this->input->get_post('salary'));
			$data['salary'] = $salary[0];		
		}
		$salary_thousand = $this->input->get_post('salary_thousand');
		if($salary_thousand != '' || !isset($salary_thousand)){
			$salary_thousand = explode(' ',$this->input->get_post('salary_thousand'));
			$data['salary_thousand'] = $salary_thousand[0];		
		}
		$expected_salary = explode(' ',$this->input->get_post('expected_salary'));
		$expected_salary= $expected_salary[0];
		if($expected_salary != '' || !isset($expected_salary)){
			$data['expected_salary'] = $expected_salary;		
		}
		$expected_salary_thousand = explode(' ',$this->input->get_post('expected_salary_thousand'));
		$expected_salary_thousand= $expected_salary_thousand[0];
		if($expected_salary_thousand != '' || !isset($expected_salary_thousand)){
			$data['expected_salary_thousand'] = $expected_salary_thousand;		
		}
		$notice = $this->input->get_post('notice');
		if($notice != '' || !isset($notice)){
			$notice = explode(' ',$this->input->get_post('notice'));
			$data['notice'] = $notice[0];		
		}		
		$users_id = $this->input->get_post('users_id');
		if($users_id != '' || !isset($users_id)){
			$resume['users_id'] = $users_id;		
		}
		$resume__1 = $this->input->get_post('resume');
		if($resume__1 != '' || !isset($resume__1)){
			$resume['resume'] = $resume__1;		
		}
		$data['date'] = date('Y-m-d h:i:s');
		$date['updated_on'] = date('Y-m-d h:i:s');
		// print_r($data);
		// 	exit;	
		if($data= $this->api_model->update('users_id', $users_id,'naukari_profile',$data)){
			// print_r($data);
			// exit;
			if($resume__1!= ''){
				$re_data = $this->api_model->get_data('users_id = "'.$users_id.'"','job_resume');
				if($re_data){
					$this->api_model->update('users_id', $users_id,'job_resume',$resume);
				}else{
						$this->api_model->submit('job_resume',$resume);
				}
			}
			$json['success']= true;
			$json['msg'] = "Your profile has been successfully updated.";
		}else{
			$json['success']= false;
			$json['error']="Database Error";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function job_sub_category_insert(){	
		//echo "<pre>";					
		if($detail = $this->api_model->get_job_category('job_sub_category')){
			//print_r($detail);
			$dat = [];
			foreach($detail as $de){
			$subcate_data =  $this->api_model->get_job_sub_cat($de['id']);
				$su =[];
				foreach($subcate_data as $sub){
					$sub['sub_sub_cat'] = $this->api_model->sub_sub_cat($sub['id']);
					//print_r($sub);
					$su[]= $sub; 
				}
			$de['subcate_data'] = $su;
			$dat[] = $de;
			}
			$json['success']  = true;			
			$json['data'] = $dat;			
		}else{
			$json['success']  = false;			
			$json['error'] = "Database Error";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function edit_sub_user_type_filed(){
		$user_id = $this->input->get_post('admin_id');
		$document_name = $this->input->get_post('document_name');
		$document_name = json_decode($document_name);
		$document_name_image = $this->input->get_post('document_name_image');
		$document_name_image = json_decode($document_name_image);
		$i =0;
		foreach($document_name as $do){
			if($do == 'password'){
				$data[''.$do.''] = md5($document_name_image[$i]);
			}else{
				$data[''.$do.''] = $document_name_image[$i];
			}
			if($detail = $this->api_model->change_status_company($user_id, $data)){
				$json['success']  = true;
				$json['msg']  = "Successfully updated";
			}
			$i++;
		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_bull_by_source_id(){
		$bull_source = $this->input->get_post('bull_source');
		$name = $this->input->get_post('name');
		$admin = $this->api_model->get_admin_detail($bull_source);
		if($admin[0]['user_type'] == 2 || $admin[0]['user_type'] == 3 || $admin[0]['user_type'] == 4 || $_SESSION['status'] == 1){
			$admin_list = $this->api_model->get_bank_issuer($bull_source);
			$detail = [];
			if(!empty($admin_list )){
				foreach($admin_list as  $ad){
					if($data = $this->api_model->get_bull_by_source_id($ad['admin_id'], $name)){
						foreach($data as $d){
							$admin_detail = $this->api_model->get_admin_detail($d['bull_source']);
							$d['semen_bank_name'] = $admin_detail[0]['fname'];
							$strow_count = $this->api_model->get_strow_count_by_source_id_bull_id($d['bull_source'], $d['id'], $bull_source, $name);
							$d['strow_count'] = $strow_count[0]['count'];
							$cat_name = $this->api_model->get_category($d['category']);
							$d['bull_cat_name'] = $cat_name[0]['category'];
							$bread_name = $this->api_model->get_animal_breed($d['bread']);
							$d['bull_bread_name'] = $bread_name[0]['breed_name'];
							$sire_bread = $this->api_model->get_animal_breed($d['sires_breed']);
							$d['sire_bread_name'] = $sire_bread[0]['breed_name'];
							$dams_breed = $this->api_model->get_animal_breed($d['dams_breed']);
							$d['dams_bread_name'] = $dams_breed[0]['breed_name'];
							$d['progini_record'] = base_url().'uploads/bank/'.$d['progini_record'];
							$d['registration_certificate'] = base_url().'uploads/bank/'.$d['registration_certificate'];
							$d['bull_image'] = base_url().'uploads/bank/'.$d['image'];
							$championship_images = json_decode($d['championship_images']);
							$che = [];
							foreach($championship_images as $ch){
								$ch = base_url().'uploads/bank/'.$ch;
								$che[] = $ch;
							}
							$d['championship_images'] = $che;
							// $d['bull_image'] = base_url().'uploads/bank/'.$d['image'];
							// $d['bull_image'] = base_url().'uploads/bank/'.$d['image'];
							$detail[] = $d; 
						}
					}
						$json['success']  = true; 
						$json['data'] = $detail;
				}
			}else{
				$json['success']  = false; 
				$json['error'] = "No bull is added, Please add first";
			}
		}else{			
			$bull_source = $this->input->get_post('bull_source');
			if($data = $this->api_model->get_bull_by_source_id($bull_source, $name)){
				$detail = [];
				foreach($data as $d){
					$admin_detail = $this->api_model->get_admin_detail($d['bull_source']);
					$d['semen_bank_name'] = $admin_detail[0]['fname'];
					$strow_count = $this->api_model->get_strow_count_by_source_id_bull_id($d['bull_source'], $d['id'],$bull_source);
					$d['strow_count'] = $strow_count[0]['count'];
					$cat_name = $this->api_model->get_category($d['category']);
					$d['bull_cat_name'] = $cat_name[0]['category'];
					$bread_name = $this->api_model->get_animal_breed($d['bread']);
					$d['bull_bread_name'] = $bread_name[0]['breed_name'];
					$sire_bread = $this->api_model->get_animal_breed($d['sires_breed']);
					$d['sire_bread_name'] = $sire_bread[0]['breed_name'];
					$dams_breed = $this->api_model->get_animal_breed($d['dams_breed']);
					$d['dams_bread_name'] = $dams_breed[0]['breed_name'];
					$d['progini_record'] = base_url().'uploads/bank/'.$d['progini_record'];
					$d['registration_certificate'] = base_url().'uploads/bank/'.$d['registration_certificate'];
					$d['bull_image'] = base_url().'uploads/bank/'.$d['image'];
					$championship_images = json_decode($d['championship_images']);
					$che = [];
					foreach($championship_images as $ch){
						$ch = base_url().'uploads/bank/'.$ch;
						$che[] = $ch;
					}
					$d['championship_images'] = $che;
					// $d['bull_image'] = base_url().'uploads/bank/'.$d['image'];
					// $d['bull_image'] = base_url().'uploads/bank/'.$d['image'];
					$detail[] = $d; 
				}
				$json['success']  = true; 
				$json['data'] = $detail;
			}else{
				$json['success']  = false; 
				$json['error'] = "No bull is added, Please add first";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}

	public function transfer_stock(){	
		$stock_id = $this->input->get_post('stock_id');
		$stock_id = json_decode($stock_id);
		$opening_stock = $this->input->get_post('opening_stock');
		$opening_stock = json_decode($opening_stock);
		$i = 0;
		$y = 0;
		$error = 0;
		foreach($stock_id as $as){
			$detail = $this->api_model->get_semen_stock_id($as);
			if($opening_stock[$i] > $detail[0]['rest_stock']){
				if($y == 0){
					$error = '#'.$as;
				}else{
					$error .= ',#'.$as;
				}
				$y++;
			}
			$i++;
		}
			if($error === 0){
				$i = 0;
				foreach($stock_id as $as){
					$detail = $this->api_model->get_semen_stock_id($as);
					//print_r($detail);
					$data['bull_id'] = $detail[0]['bull_id'];
					$data['stock_id'] = $detail[0]['id'];
					$data['batch_no'] = $detail[0]['batch_no'];
					$data['rest_stock'] = $opening_stock[$i];
					$data['opening_stock'] = $opening_stock[$i];
					$data['date'] = date('Y-m-d h:i:s');
					$data['bank_id'] = $detail[0]['bank_id'];
					$data['type'] = $detail[0]['type'];
					$data['image'] = $detail[0]['image'];
					$data['admin_id'] = $this->input->get_post('admin_id');
					$deta = $this->api_model->add_semen_stock($data);
					$stock['rest_stock'] = $detail[0]['rest_stock'] - $opening_stock[$i];
					$this->api_model->update_semen_stock($detail[0]['id'], $stock);
					$i++;
				}
				$json['success']  = True; 
				$json['msg'] = "Your Semen Stock has been successfully  Transfered";
			}else{
				$json['success']  = false; 
				$json['error'] = "Quantity is more then available stock (".$error.") or Out of stock";
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function ai_listing_by_state(){
		$state_name = $this->input->get_post('state_name');
		$type =$this->input->get_post('type');
		$vt_type =$this->input->get_post('vt_type');
		// if(!isset($state_name) || $state_name == ''){
		// 	$json['success']  = false;
		// 	if($type == 0){
		// 		$json['error'] = "Please send state name";
		// 	}else{
		// 		$json['error'] = "कृपया राज्य का नाम भेजें";
		// 	}
		// }else{
			if($data = $this->api_model->ai_listing_by_state($state_name, $vt_type)){
				$detail = [];
				foreach($data as $d){
					$degree = $this->api_model->get_doc_degree($d['doctor_id']);
					$d['name'] = $d['username'];
					$d['qualification'] = $degree == false ? [] : $degree;
					$d['no_of_ai'] = '';
					$d['succes_ai'] = '';
					$d['succes_rate'] = '';
					$d['rating'] = '4';
					$d['total_price'] =  $price;
					$d['image'] = base_url()."uploads/doc/".$d['image'];
					$detail[] = $d;
				}
				$json['success']  = true; 
				$json['data'] = $detail;
			}else{
				$json['success']  = false; 
				if($type == 0){
					$json['error'] = "There is no listing found in your area";
				}else{
					$json['error'] = "इस क्षेत्र में कोई भी ए॰आई॰ मौजूद नहीं है ।";
				}
			}
		// }
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function check_semen_strow(){
		$bull_id = $this->input->get_post('bull_id');
		$strow = $this->input->get_post('strow_no');
		$data = $this->api_model->check_semen_strow($strow, $bull_id);
		$data[0]['doc_name'] = "";
		$detail = $this->api_model->get_admin_detail($data[0]['bank_id']);
		$data['bank_name'] = $detail[0]['bank_name'];
		if($data){
			$json['success']  = true; 
			$json['data'] = $data[0];
			$json['msg'] = "आपके द्वारा जांचा गया वीर्य स्ट्रॉ नंबर बैंक (".$detail[0]['bank_name'].") द्वारा जारी किया गया है यह प्रामाणित और वास्तविक है|";
		}else{
			$json['success']  = false; 
			$json['error'] = "आपके द्वारा दिया गया सीमेन स्ट्रॉ नंबर सही नहीं है";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function buy_animal(){
		$data['name'] = $this->input->get_post('name');
		$data['address'] = $this->input->get_post('address');
		$data['doc_id'] = $this->input->get_post('users_id');
		$data['phone'] = $this->input->get_post('phone');
		$data['budget'] = $this->input->get_post('budget');
		$data['date'] = date('Y-m-d h:i:s');
		$animal = json_decode($this->input->get_post('animal'));
		$count = count($animal);
		$data['no_animal'] = $count;
		if($buy_id =$this->api_model->ins_buy_table($data)){
			foreach($animal as $ani){
				//print_r($ani);
				$ani_data['buy_id'] = $buy_id;
				$ani_data['cat_id'] = $ani->cat_id;
				$ani_data['breed_id'] = $ani->breed_id;
				$ani_data['gender'] = $ani->gender;
				$ani_data['no_animal'] = $ani->no_animal;
				$this->api_model->ins_buy_animal($ani_data);
			}
			$json['success']  = true; 
			$json['msg'] = "Your Request has been Submited";
		}else{
			$json['success']  = false; 
			$json['error'] = "Data base Error";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function skip_payment(){
		$data['point'] = REFER_AMOUNT;
		$doc_id = $this->input->get_post('doc_id');
		$refral_code = $this->input->get_post('refral_code');
		$data['users_id'] = $this->input->get_post('doc_id');
		$data['type'] = '3';
		$data['date'] = date('Y-m-d h:i:s');
		$data['payment_type'] = 'Cr';
		if(!isset($refral_code) || $refral_code !=''){
			$ref_data['refral_by_code'] = $refral_code;
			$data_ref = $this->api_model->get_doc_by_ref_code($refral_code);
			$ref_data_ins['point'] = REFER_AMOUNT;
			$ref_data_ins['users_id'] = $data_ref['doctor_id'];
			$ref_data_ins['type'] = '3';
			$ref_data_ins['date'] = date('Y-m-d h:i:s');
			$ref_data_ins['payment_type'] = 'Cr';
			$this->api_model->insert_point_data($ref_data_ins);
			$this->api_model->insert_point_data($data);
		}
		$ref_data['is_payment'] = '2';
		$ref_data['isactivated'] = '1';
		if($this->api_model->update_para_fcm($doc_id, $ref_data)){
			$json['success']  = true;
		}else{
			$json['success']  = false; 
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function paid_service_detail(){
		$doc_id = $this->input->get_post('doc_id');
		$data = $this->api_model->get_paid_servises_payout($doc_id);
		$x= 0;
		foreach($data as $d){
			$p_data = $this->api_model->get_paid_service_id($d['service_id']);
			if($p_data[0]['no_installment'] != '0'){
				$ins_data = $this->api_model->get_paid_service_installment_count($d['service_id']);
				$due_ins_data = $this->api_model->get_paid_id_id($d['id']);
				if($due_ins_data[0]['count'] != $ins_data[0]['count']){
					$installment = $ins_data[0]['count'] - $due_ins_data[0]['count'];
					if($installment != '0'){
						$install_detail = $this->api_model->get_paid_service_installment_desc($d['service_id']);
						// $y = 0;
						// foreach($install_detail as $ins){
							// $yesterday =date("y-m-d", strtotime("yesterday"));
							// $today = date("y-m-d");
							//print_r($data);
							//echo date('Y-m-d', strtotime($d['date']. ' + '.NUM_DAYS_PAYMENT.' days'));
							if(date('Y-m-d') == date('Y-m-d', strtotime($d['date']. ' + '.NUM_DAYS_PAYMENT.' days'))){
								$date = date('Y-m-d', strtotime($d['date']. ' + '.NUM_DAYS_PAYMENT.' days'));
								$ins['permanent_block'] = true;
							}else{
								$date = date('Y-m-d', strtotime($d['date']. ' + '.NUM_DAYS_PAYMENT.' days'));
								$ins['permanent_block'] =false;
							}
							$ins['service_name'] = $p_data[0]['name'];
							$ins['saved_amount'] = $install_detail[0]['saved_amount'];
							$ins['paid_amount'] = $install_detail[0]['paid_amount'];
							$ins['mlm'] = $install_detail[0]['mlm'];
							$ins['credit_point'] = $install_detail[0]['credit_point'];
							$ins['credit_used'] = $install_detail[0]['credit_used'];
							$ins['type'] = '9';
							$detail[]= $ins;
							// if($y == $installment){
							// 	break;
							// }
							// $y++;
							//print_r($ins);
							$total += $install_detail[0]['paid_amount'];
						//}//
						
					}
				}
			}
			$x++;
		}
		if($total == ''){
			$json['success']  = false;
		}else{
		    $json['success']  = true;
			$json['data']['installment_detail'] = $detail;
			$json['data']['total_paid_amount'] = $total;
			if($ins['permanent_block']){
				$json['data']['permanent_block'] = true;
				$json['data']['msg'] = 'Your account has been blocked due to payment Due';
			}else{
				$json['data']['permanent_block'] = false;
				$json['data']['msg'] = 'This is reminder for you that your payment is due, if it is not paid before due date('.$date.'), Your Account would be blocked';
			}
			
			$detail = '';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function ins_paid_services_order(){
		$data['name'] = $this->input->get_post('name');
		$data['phone'] = $this->input->get_post('phone');
		$data['address'] = $this->input->get_post('address');
		$data['no_animal'] = $this->input->get_post('no_animal');
		$data['users_id'] = $this->input->get_post('users_id');
		$data['service_id'] = $this->input->get_post('service_id');
		$data['date'] = date('Y-m-d h:i:s');
		if(isset($data['service_id']) || $data['service_id'] != ''){
			$credit = $this->api_model->get_point_total($data['users_id'], $type = '', $payment_type = 'Cr');
			$service_detail = $this->api_model->paid_services_id($data['service_id']);
			$data['service_discount'] = $service_detail[0]['credit_used'];
			$data['service_point'] = $service_detail[0]['credit_point'];
			$data['service_mlm'] = $service_detail[0]['mlm'];
			if($detail = $this->api_model->ins_paid_services_order($data)){
				$json['success']  = true;
				$json['last_id'] = $detail;
				if($credit[0]['sum'] != null){
					$cr = ($service_detail[0]['paid_amount'] * $data['no_animal'])  * $service_detail[0]['credit_used']/100;
					if($credit[0]['sum'] <= $cr){
						$json['credit'] = $credit[0]['sum'];
					}else{
						$json['credit'] = $credit[0]['sum'];
						$json['credit_used'] = $cr;
					}
				}else{
					$json['credit'] = '0';
					$json['credit_used'] = '0';
				}
				$json['discount_percentage'] = $service_detail[0]['discount'] * $data['no_animal'];
				$json['discount'] = ($service_detail[0]['paid_amount'] * $service_detail[0]['discount']/100) * $data['no_animal'];
				$json['product_point'] = $service_detail[0]['credit_point'] * $data['no_animal'];
				$json['product_mlm_amount'] = $service_detail[0]['mlm'] * $data['no_animal'];
				$json['user_saved_amount'] = $service_detail[0]['saved_amount'] * $data['no_animal'];
				$json['price'] = $service_detail[0]['price'] * $data['no_animal'];
				$json['show_price'] = $service_detail[0]['show_price'];
				$json['actual_price'] = $service_detail[0]['actual_price'] * $data['no_animal'];
				$json['actual_paid_amount'] = (($service_detail[0]['paid_amount']) * $data['no_animal']) - ($json['discount'] + $json['credit_used']) ;
			}else{
				$json['success']  = false; 
				$json['error'] = "Error with Databases";
			}
		}else{
			$json['success']  = false; 
			$json['error'] = "Service Id is mandatory";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function paid_services(){
		if($data = $this->api_model->paid_services()){
			$json['success']  = true;
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['msg'] = "NO Data Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function in_user_detail(){
		$name = $this->input->get_post('name');
		$phone = $this->input->get_post('phone');
		if(!isset($name) || $name == ''){
			$json['success']  = false; 
			$json['error'] = "Please send user name";
		}else if(!isset($phone) || $phone == ''){
			$json['success']  = false; 
			$json['error'] = "Please send user Mobile no";
		}else{
			$data['name'] = $name;
			$data['phone'] = $phone;
			$detail = $this->api_model->inp_user_detail($data);
			if($detail){
				$json['success']  = true; 
				$json['msg'] = "Your request is submited contact you soon";
			}else{
				$json['success']  = false; 
				$json['msg'] = "Database error";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function like(){
			$data['users_id'] = $this->input->get_post('users_id');
			$data['like'] = $this->input->get_post('like');
			$data['product_id'] = $this->input->get_post('product_id');
			$data['user_type'] = $this->input->get_post('user_type');
			$data['product_type'] = $this->input->get_post('product_type');
			if($detail = $this->api_model->check_like($data['users_id'], $data['product_id'], $data['user_type'], $data['product_type'])){
				$this->api_model->update_like($detail[0]['id'], $data);
				$count = $this->api_model->get_like_count($data['product_id'],$data['product_type']);
				$shiku['count'] = $count[0]['count'];
				$json['data'] = $shiku;
				$json['success'] = True;
			}else{
				if($su = $this->api_model->like($data)){
					$count = $this->api_model->get_like_count($data['product_id'],$data['product_type']);
					$shiku['count'] = $count[0]['count'];
					$json['data'] = $shiku;
					$json['success'] = True;
				}
			}
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;

	}
	public function user_lang(){
		$code = $this->input->get_post('code');
		$users_id = $this->input->get_post('users_id');
		if($code == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send language code";
		}else if($users_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send user id";
		}else{
			if($dta = $this->api_model->get_data('users_id = "'.$users_id.'"' , 'user_language', '', '*')){
				$lang = $this->api_model->get_data('code = "'.$code.'"' , 'language', '', '*');
				$data['lang_id'] = $lang[0]['id'];
				$data['lang_code'] = $lang[0]['code'];
				$data['users_id'] = $users_id;
				$this->api_model->update('id', $dta[0]['id'], 'user_language', $data);
				$json['success']  = true; 
				$json['msg'] = "Your language is Inserted";
			}else{
				$lang = $this->api_model->get_data('code = "'.$code.'"' , 'language', '', '*');
				$data['lang_id'] = $lang[0]['id'];
				$data['lang_code'] = $lang[0]['code'];
				$data['users_id'] = $users_id;
				if($this->api_model->submit('user_language', $data)){
					$json['success']  = true; 
					$json['msg'] = "Your language is updated";
				}else{
					$json['success']  = false; 
					$json['error'] = "Data base error";
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;		
	}
	public function user_interested_in(){
		$category_id = $this->input->get_post('category_id');
		$bread_id = $this->input->get_post('bread_id');
		$users_id = $this->input->get_post('users_id');
		if($category_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send category id";
		}else if($bread_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send bread id";
		}else if($users_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please Send users id";
		}else{
			if($dta = $this->api_model->get_data('users_id = "'.$users_id.'" AND category_id="'.$category_id.'" AND bread_id = "'.$bread_id.'"' , 'user_interested_in', '', '*')){
				$data['category_id'] = $category_id;
				$data['bread_id'] = $bread_id;
				$data['users_id'] = $users_id;
				$data['updated_on'] = date('Y-m-d h:i:s');	
				$this->api_model->update('id', $dta[0]['id'], 'user_interested_in', $data);
				$json['success']  = true; 
				$json['msg'] = "Your interested is Inserted";
			}else{
				$data['category_id'] = $category_id;
				$data['bread_id'] = $bread_id;
				$data['users_id'] = $users_id;
				$data['created_on'] = date('Y-m-d h:i:s');	
				$data['updated_on'] = date('Y-m-d h:i:s');	
				if($this->api_model->submit('user_interested_in', $data)){
					$json['success']  = true; 
					$json['msg'] = "Your interested is updated";
				}else{
					$json['success']  = false; 
					$json['error'] = "Data base error";
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;		
	}
	public function get_seman_availability(){
		$users_id = $this->input->get_post('users_id');
		$breed_id = $this->input->get_post('breed_id');
		$category_id = $this->input->get_post('category_id');
		$limit = $this->input->get_post('limit');
		$start = $this->input->get_post('start');
		$primium = $this->input->get_post('primium');
		$daughter_yield_from = $this->input->get_post('daughter_yield_from');
		$daughter_yield_to = $this->input->get_post('daughter_yield_to');
		$user_type = $this->input->get_post('user_type');
		$price_from = $this->input->get_post('price_from');
		$price_to = $this->input->get_post('price_to');
		$milk_type = $this->input->get_post('milk_type');
		$price_order = $this->input->get_post('price_order');
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');
		$error = 0;
		if($data = $this->api_model->get_seman_breed_id($breed_id, $category_id, $limit, $primium, $daughter_yield_from, $daughter_yield_to, $user_type, $price_from, $price_to, $milk_type, $price_order, $latitude, $longitude, $start)){		
			
			$dommy = [];
					if(isset($breed_id)){
						if($primium != '1'){
							$detail = $this->api_model->get_seman_breed_without_id($category_id);
							if(!empty($detail[0])){
								$data[] = $detail[0];
							}
						}
					}
					foreach($data as $d){
						$cat = $this->api_model->get_category($d['category']);
						$bull_id = $this->api_model->get_bank_name_by_id($d['bull_source']);
						$count = $this->api_model->get_like_count($d['id'],0);
						$d['like'] = $count[0]['count'];
						if(isset($users_id)){
							if($like = $this->api_model->get_like_status($users_id, $d['id'],0)){
								$d['like_status'] = '1';
							}else{
								$d['like_status'] = '0';
							}
						}
						$d['bull_source'] = $bull_id[0]['fname'];
						$d['category_name'] = $cat[0]['category'];
						if($d['image'] == ''){
							$d['image'] ='';
						}else{
							$d['image'] = base_url()."uploads/bank/".$d['image'];
						}
						if($d['video'] == ''){
							$d['video'] ='';
						}else{
							$d['video'] = base_url()."uploads/bank/".$d['video'];
						}
						//$d['image'] = isset($d['image']) ? base_url()."uploads/bank/".$d['image'] : '';
						//$d['video'] = isset($d['video']) ? base_url()."uploads/bank/".$d['video'] : '';
						$breed = $this->api_model->get_animal_breed($d['bread']);
						$d['breed_name'] = $breed[0]['breed_name'];
						$d['price'] = $d['price'];
						$dommy[] = $d;
					}
				$json['success']  = true; 
				$json['data'] = $dommy;
				$json['count'] = $this->api_model->get_seman_breed_id_count($breed_id, $category_id, $primium, $daughter_yield_from, $daughter_yield_to, $user_type, $price_from, $price_to, $milk_type, $price_order, $latitude, $longitude);
			}else{
				$json['success']  = false; 
				if($start <= 1){
					$json['error'] = "No bull listing is found";
				}else{
					$json['error'] = "No more bull listing is found";
				}	
			}
		 header('Content-Type: application/json');
		 echo json_encode($json);
		 exit;
	}
	public function get_ai_doc_latlog_type(){
		$type = $this->input->get_post('type');
		$price = $this->input->get_post('price');
		$langituit = $this->input->get_post('longitude');
		$latituit = $this->input->get_post('latitude');
		if(!isset($type) || $type == ''){
			$json['success']  = false; 
			$json['error'] = "Please send Type";
		}else if(!isset($langituit) || $langituit == ''){
			$json['success']  = false; 
			$json['error'] = "Please send Longitude";
		}else if(!isset($latituit) || $latituit == ''){
			$json['success']  = false; 
			$json['error'] = "Please send Latitude";
		}else{
			if($data = $this->api_model->get_ai_doc_latlog_type($type, $langituit, $latituit)){
				$da = [];
				foreach($data as $d){
					$degree = $this->api_model->get_doc_degree($d['doctor_id']);
					$d['qualification'] = $degree == false ? [] : $degree;
					$d['image'] = base_url().'uploads/doc/'.$d['image'];
					$d['no_of_ai'] = '';
					$d['succes_ai'] = '';
					$d['succes_rate'] = '';
					$d['rating'] = '';
					$d['total_price'] =  $price;
					$da[] = $d;
				}
				$data = $da;
				$json['success']  = true; 
				$json['data'] = $data;
			}else{
				$json['success']  = false; 
				$json['error'] = "No data found";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function user_payment_detail(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		$detail = $this->api_model->get_user_payment_detail($users_id, $type);
		$data = [];
		foreach($detail as $de){
			if($de['type_type'] == '5'){
				$de['type'] = 'Breeding Record Charges';
			}else if($de['type_type'] == '6'){
				$de['type'] = 'Artificial Insemination';
			}else if($de['type_type'] == '4'){
				$pack = $this->api_model->get_my_purchase_detail('', $de['id']);
				$de['type'] = $pack[0]['service_type'];
				$subs = $this->api_model->get_subus_dtail($pack[0]['subscription_id']);
				print_r($subs);
			}
			$data[] = $de;
		}
		if($detail){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = "No Data Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}	
	public function get_all_bull(){
		$search = $this->input->get_post('search');
		$detail = $this->api_model->get_all_bull($search);
		if($detail){
			$json['success']  = true; 
			$json['data'] = $detail;
		}else{
			$json['success']  = false; 
			$json['error'] = "No Data Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_bull_detail(){
		$id = $this->input->get_post('id');
		$detail = $this->api_model->get_bull_detail($id);
		//print_r($detail);
		if($detail){
			$json['success']  = true; 
			$json['data'] = $detail;
		}else{
			$json['success']  = false; 
			$json['error'] = 'No data found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_ai_detail_payment_status(){
		$user_id = $this->input->get_post('users_id');
		$type =$this->input->get_post('type');
		$data = $this->api_model->get_ai_payment($user_id, $type);
		if($data){
			$animal_data = [];
			$i = 0;
			foreach($data as $d){
				$detail = $this->api_model->get_animal_id($d['animal_id']);
				$seman_data = $this->api_model->get_seman_detail($d['bull_id']);
				$animal_image = $this->api_model->get_animal_image($d['animal_id']);
				$d['animal_name'] = $detail[0]['title'];
				$d['animal_id'] = $detail[0]['selling_id'];
				$d['animal_tag_no'] = $detail[0]['tag_no'];
				$image = '2251315099364.jpg';
        		$d['animal_images'] = base_url().'uploads/animal/'.$image;
				//$d['animal_images'] = $animal_image[0]['images'];
				$d['breeding_price'] = BREADING_PRICE;
				//print_r($d);
				$animal_data[] = $d;
				$i++;
			}
			$total = BREADING_PRICE * $i; 
			$json['success']  = true; 
			$json['data'] = $animal_data;
			$json['total'] = $total;
			$json['breading_text'] = BREADING_TEXT;
		}else{
			$json['success']  = false; 
			$json['data'] = [];
			$json['error'] = 'No data found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function breading_detail(){
		echo "this is test";
		$user_id = $this->input->get_post('users_id');
		$detail = $this->api_model->breading_detail($user_id);
		print_r($detail);
	}
	public function paravate_payment(){
		//$data['purchase_id'] = '123';
		$purchase_id = $this->input->get_post('purchase_id');
		$data['purchase_id'] = $purchase_id;
		$data['amount'] = $this->input->get_post('amount');
		$data['currency'] = $this->input->get_post('currency');
		$data['id'] = $this->input->get_post('id');
		$data['debud_data'] = $this->input->get_post('debud_data');
		$data['contact'] = $this->input->get_post('contact');
		$data['description'] = $this->input->get_post('payment_type');
		$data['date_added'] = $this->input->get_post('date_added');
		$data['event'] = $this->input->get_post('event');
		$data['email'] = $this->input->get_post('email');
		$product_point = $this->input->get_post('product_point');
		$product_mlm_amount = $this->input->get_post('product_mlm_amount');
		///$this->api_model->payment_status($data);
		$credits_used = $this->input->get_post('credits_used');
		$doc_id = $this->input->get_post('doc_id');
		$last_id = $this->input->get_post('last_id');
		$no_animal = $this->input->get_post('no_animal');
		$type = $this->input->get_post('type');
		if(isset($credits_used) || $credits_used == ''){
			$point_data['users_id'] = $doc_id;
			$point_data['type'] = $type;
			$point_data['payment_type'] = 'Dr';
			$point_data['point'] = $credits_used;
			$point_data['date'] = date('Y-m-d h:i:s');
			$this->api_model->insert_point_data($point_data);
		}
		$point_data['users_id'] = $doc_id;
		$point_data['type'] = $type;
		$point_data['payment_type'] = 'Cr';
		$point_data['point'] = $product_point;
		$point_data['date'] = date('Y-m-d h:i:s');
		$this->api_model->insert_point_data($point_data);
		$mlm_point['type'] = $type;
		$mlm_point['users_id'] = $doc_id;
		$mlm_point['point'] = $product_mlm_amount;
		$mlm_point['date'] = date('Y-m-d h:i:s');
		$this->api_model->insert_mlm_point_data($mlm_point);
		$log_data['payment_type'] = 'Cr';
		$log_data['status'] = '1';
		$log = $this->api_model->update_log_file($log_data, $data['purchase_id']);
		$paid_data['payment_status'] = '1';
		$paid_data['purchase_id'] = $purchase_id;
		for($i=0; $i < $no_animal; $i++){
			$service_data['paid_order_id'] = $last_id;
			$service_data['type'] = $type;
			$service_data['date'] = date('Y-m-d h:i:s');
			$this->api_model->insert_animal_paid_services($service_data);
		}
		$p_data = $this->api_model->paid_service_update($paid_data, $last_id);
	}
	public function payment_status(){
		//$data['purchase_id'] = '1234';
		$data['purchase_id'] = $this->input->get_post('purchase_id');
		$data['amount'] = $this->input->get_post('amount');
		$data['currency'] = $this->input->get_post('currency');
		$data['id'] = $this->input->get_post('id');
		$data['debud_data'] = $this->input->get_post('debud_data');
		$data['contact'] = $this->input->get_post('contact');
		$data['description'] = $this->input->get_post('payment_type');
		$data['date_added'] = $this->input->get_post('date_added');
		$log_data['status'] = $this->input->get_post('purchase_status_id');
		$listing_id = $this->input->get_post('listing_id');
		$credit_used = $this->input->get_post('credits_used');
		$doc_id = $this->input->get_post('doc_id');
		$type = $this->input->get_post('type');
		$data['event'] = $this->input->get_post('event');
		$data['email'] = $this->input->get_post('email');
		$log_data['date'] = date('Y-m-d h:i:s');
		$payment_type = $this->input->get_post('payment_type');
		$this->api_model->payment_status($data);
		$log_data['payment_type'] = 'Dr';
		if($payment_type == 'HKPD'){
			if($type == '6'){
				$animal_id = $this->input->get_post('animal_id'); //["275","276"]
				$users_id = $this->input->get_post('users_id');
				$vt_id = $this->input->get_post('doc_id');
				$ai_id = $this->input->get_post('ai_id'); 
				$doc_type = $this->input->get_post('doc_type');
				$treat_type = $this->input->get_post('treat_type');
				$address = $this->input->get_post('address');
				$latitude = $this->input->get_post('latitude');
				$langitude  = $this->input->get_post('langitude');
				$vt_id = json_decode($vt_id);
				$vt_id_imp = implode(',',$vt_id);
				$ai_id = json_decode($ai_id);
				$ai_id_imp = implode(',',$ai_id);
				$total_animal = json_decode($animal_id);
				$vacc_id = $ai_id;
				$total_im_animal = implode(',',$total_animal);
				$vacc_im_id = $ai_id_imp;
				$otp_l = rand(1000,9999);
						$req_filed['animal_id'] = $total_im_animal;
						$req_filed['users_id'] = $users_id;
						$req_filed['treat_type'] = $treat_type;
						$req_filed['vt_id'] = '0';
						$req_filed['vacc_id'] = $vacc_im_id;
						$req_filed['animal_simtoms'] = '';
						$req_filed['status']  = '0';
						$req_filed['address'] = $address;
						$req_filed['latitude'] = $latitude?$latitude:'0';
						$req_filed['langitude '] = $langitude?$langitude:'0';
						$req_filed['otp'] = $otp_l;
						$req_filed['created_on'] =  date('Y-m-d H:i:s');
						$req_filed['date'] = date('Y-m-d');
						$insert = $this->api_model->insert_vt_request($req_filed);
						$log_data['ai_id'] = $ai_id_imp;
						$log_data['request_id'] = $insert;
						$log_data['user_type'] = '1';
						$log = $this->api_model->update_log_file($log_data, $data['purchase_id']);
				foreach($total_animal as $animals)
				{
							$cont_animal++;
							$this->api_model->get_animal_ani_id($animals);
							$ani_title= $animal_data['0']['title'];	
							$otp_2 = rand(1000,9999);
							if(isset($vacc_id)){
									$r_data['request_id'] = $insert; 
									$r_data['user_id'] = $users_id;
									$r_data['animal_id'] = $animals;
									$r_data['treat_type'] = $treat_type;
									$r_data['doc_id'] = '0';
									$r_data['animal_simtoms'] = '';
									$r_data['vacc_id'] = $vacc_im_id;
									$r_data['vt_id'] = '0';
									$r_data['status'] = '0';
									$r_data['type'] = '1';
									$r_data['otp'] = $otp_2;
									$r_data['date'] = date('Y-m-d');
									$this->api_model->insert_vt_track_request($r_data);
							}else{
									$r_data['request_id'] = $insert; 
									$r_data['user_id'] = $users_id;
									$r_data['animal_id'] = $animals;
									$r_data['treat_type'] = $treat_type;
									$r_data['animal_simtoms'] = $animal_simtoms;
									$r_data['doc_id'] = isset($th) ? $th->parent_id : '0';
									$r_data['vacc_id'] = '0';
									$r_data['vt_id'] = $vt_id_imp;
									$r_data['status'] = '0';
									$r_data['type'] = '0';
									$r_data['otp'] = $otp_2;
									$r_data['date'] = date('Y-m-d');
									$this->api_model->insert_vt_track_request($r_data);
							}
							if($insert)
								{
									$datafiled = [
									'treatment_status'     => '1',
								];
								$update = $this->api_model->animal_table_update($animals,$datafiled);
					}
				}
				foreach($vt_id as $vt){
					$ms = "User (Usersid:#'.$vt.') has send you a AI request for '.$cont_animal.' animals.";
					$msg['message'] = $ms;
					$msg['users_id'] = $users_id;
					$msg['type'] = 1;
					$msg['title'] = "Treatment /Vaccination";
					$msg['date'] = date('Y-m-d h:i:s'); 
					$this->pushnoti_model->insert_noti($msg);
					$msg['flag'] = '0';
					$msg['message'] = 'You have a new AI request.';
					$this->push_non($vt, 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);	
				}
					// $ms = "User (Usersid:#'.$users_id.') has send you a AI request for '.$cont_animal.' animals.";
					// $msg['message'] = $ms;
					// $msg['users_id'] = $users_id;
					// $msg['type'] = 1;
					// $msg['title'] = "Treatment /Vaccination";
					// $msg['date'] = date('Y-m-d h:i:s'); 
					// $this->pushnoti_model->insert_noti($msg);
					// $msg['flag'] = '0';
					// $msg['message'] = 'You have a new AI request.';
					// $this->push_non($vt_id_imp, 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);	
					// $msg['message'] = 'Your Paravet got a new request.';
					// $this->push_non($th->parent_id, 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);
			}else{
				$ai_id = $this->input->get_post('ai_id');
				$ai_id = json_decode($ai_id);
				$ai_id_imp = implode(',',$ai_id);
				$log_data['ai_id'] = $ai_id_imp;
				$log_data['user_type'] = '1';
				$log = $this->api_model->update_log_file($log_data, $data['purchase_id']);
				foreach($ai_id as $d){
					$ai_data['payment'] = '1';
					$ai_data['amount'] = BREADING_PRICE;
					$this->api_model->update_ai_detail($d, $ai_data);
				}
			}
		}else{
			$log = $this->api_model->update_log_file($log_data, $data['purchase_id']);
					if($log_data['status'] == '1' || $log_data['status'] == '2'){
						if(isset($listing_id) && $listing_id != ''){
							$list_data['is_paid'] = '1';
							$list_data['purchse_date'] = date('Y-m-d h:i:s');
							$list_data['is_active'] = '1';
							$listing_data = $this->api_model->listing_update($listing_id, $list_data);
							if(isset($credit_used) && $credit_used != ''){
								$log_data['type'] = '2';
								$log_data['payment_type'] = 'Dr';
								$log_data['users_id'] = $doc_id;
								$log_data['currency'] = 'INR';
								$log_data['status'] = '1';
								$log_data['amount'] = $credit_used;
								$this->api_model->insert_log_data($log_data);
							}
						}else{
										$refral_code =  $this->input->get_post('refral_id');
										$payment_data['is_payment'] = '1';
										if(isset($refral_code) && $refral_code != ''){
											$users_id = $this->api_model->get_doc_by_ref_code($refral_code);
											$payment_data['refral_by_code'] = $users_id['doctor_id'];
										}
										$this->api_model->update_payment_status($payment_data, $log['users_id']);
										if(isset($credit_used) && $credit_used != ''){
											$log_data['type'] = '3';
											$log_data['payment_type'] = 'Cr';
											$log_data['users_id'] = $doc_id;
											$log_data['currency'] = 'INR';
											$log_data['status'] = '1';
											$log_data['amount'] = $credit_used;
											$this->api_model->insert_log_data($log_data);
											$log_data['type'] = '3';
											$log_data['payment_type'] = 'Dr';
											$log_data['users_id'] = $doc_id;
											$log_data['currency'] = 'INR';
											$log_data['status'] = '1';
											$log_data['amount'] = $credit_used;
											$this->api_model->insert_log_data($log_data);
										}
										if(isset($refral_code) && $refral_code != ''){
											$ref_data['users_id'] = $users_id['doctor_id'];
											$ref_data['currency'] = 'INR';
											$ref_data['status'] = '1';
											$ref_data['type'] = '3';
											$ref_data['payment_type'] = 'Cr';
											$ref_data['amount'] = REFER_REV_AMOUNT;
											$this->api_model->insert_log_data($ref_data);
										}

						}			
					}
				}
	}
	public function version() {
			$json = array(
					'version' => VERSION,
					'force_update' => VER_FORCE,
					'notes' => ''
			);
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function business_version() {
			$json = array(
					'version' => BUSINESS_VERSION,
					'force_update' => BUSI_FORCE,
					'notes' => ''
			);
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function pro_version() {
			$json = array(
					'version' => PRO_VERSION,
					'force_update' => PRO_FORCE,
					'notes' => ''
			);
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function doc_bank_datil(){
		$doc_id = $this->input->get_post('doc_id');
		$data = $this->api_model->get_bank_detail($doc_id);
		if($data){
			$json['success'] = true;
			$json['data'] = $data;
		}else{
			$json['success'] = false;
			$json['error'] = "Database error.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function doc_bank_datil_update(){
		$doc_id = $this->input->get_post('doc_id');
		$data['bank_name'] = $this->input->get_post('bank_name');
		$data['branch_address'] = $this->input->get_post('branch_address');
		$data['ifsc_code'] = $this->input->get_post('ifsc_code');
		$data['account_no'] =  $this->input->get_post('account_no');
		$data['account_holder_name'] = $this->input->get_post('account_holder_name');
		$detail = $this->api_model->get_bank_detail_update($data, $doc_id);
		if($detail){
			$json['success'] = true;
			$json['msg'] = "Your Bank Detail Updated";
		}else{
			$json['success'] = false;
			$json['error'] = "Database error.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_payment_history(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		if(!isset($users_id) || $users_id == ''){
			$json['success'] = false;
			$json['error'] = "Please send Doctor id";
		}else{
			$data = $this->api_model->get_tarnsaction_record($users_id, $type);
			$json['success'] = true;
			$json['data'] = $data;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_payment_history_debit_credit(){
		$users_id = $this->input->get_post('users_id');
		if(!isset($users_id) || $users_id == ''){
			$json['success'] = false;
			$json['error'] = "Please send Doctor id";
		}else{
			$tr_data = $this->api_model->get_tarnsaction_record($users_id);
			$tran = [];
			foreach($tr_data as $tr){
				if($tr['type'] == 1){
					$tr['type'] = 'Registration Charges';
				}else if($tr['type'] == 2){
					$tr['type'] = 'Purchased';
				}else if($tr['type'] == 3){
					$tr['type'] = 'Referral';
				}else if($tr['type'] == 4){
					$tr['type'] = 'Pack Purchase';
				}else{
					$tr['type'] = 'Airtificial Insemination';
				}
				$tran[] = $tr;
			}
			$data['transaction_detail'] = $tran;
			$debit = $this->api_model->get_total_debit($users_id);
			if($debit[0]['amount'] == null){
				$debit[0]['amount'] = 0;
			}
			$data['total_debit'] = $debit[0]['amount'];
			$credit = $this->api_model->get_total_point_credit($users_id);
			if($credit[0]['amount'] == null){
				$credit[0]['amount'] = 0;
			}
			$credit_amount = $this->api_model->get_total_credit($users_id);
			$data['total_credit'] = $credit[0]['amount'];
			$data['final_amount'] = $credit_amount[0]['amount'] - $debit[0]['amount'];
			$json['success'] = true;
			$json['data'] = $data;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function point_total(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		$payment_type = $this->input->get_post('payment_type');
		if(!isset($users_id) || $users_id == ''){
			$json['success'] = false;
			$json['error'] = "Please send Doctor id";
		}else{
			$data = $this->api_model->get_point_total($users_id, $type, $payment_type);
			$json['success'] = true;
			if($data[0]['sum'] != ''){
				$json['total_balance'] = $data[0]['sum'];
			}else{
				$json['total_balance'] = 0;
			}
			
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_payment_total(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		$payment_type = $this->input->get_post('payment_type');
		if(!isset($users_id) || $users_id == ''){
			$json['success'] = false;
			$json['error'] = "Please send Doctor id";
		}else{
			$data = $this->api_model->get_tarnsaction_total($users_id, $type, $payment_type);
			$json['success'] = true;
			if($data[0]['sum'] != ''){
				$json['total_balance'] = $data[0]['sum'];
			}else{
				$json['total_balance'] = 0;
			}
			
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doc_detail_dash(){
				$doc_id = $this->input->get_post('doc_id');
				$detail = $this->api_model->doc_detail_id($doc_id);
				if($detail[0]['users_type'] == 'pvt_doc'){
						$doc_qua = $this->login_cheak_model->get_qulification_doc_id($doc_id);
							foreach($doc_qua as $dq){
								$qua_name = $this->login_cheak_model->get_qualification($dq['qualifi_id']);
								$dq['qualification_name'] = $qua_name[0]['qualifi_name'];
								$dq['document'] = base_url()."uploads/doctore_doc/".$dq['document'];
								$sp = json_decode($dq['speci_id']);
									if(!isset($dq['speci_id']) || $dq['speci_id'] != ''){
										//echo "this is true";
										
										foreach($sp as $s){
											$specialization = $this->login_cheak_model->get_specialisation($s);
											$sep[] = $specialization[0]['speci_name'];
										}
									$dq['speci_name'] = $sep;
									}else{
									$dq['speci_name'] = [];
									//$dq['speci_id'] = [];
									}
									//$dq['speci_id'] = $sp;
									if(empty($sp)){
										$dq['speci_id'] = [];
									}else{
										$dq['speci_id'] = $sp;
									}
									
								$dat[] = $dq; 
							}
						}
						if($detail){
							if(!isset($detail[0]['image'])){
								$detail[0]['image'] = base_url()."/uploads/image/profile.jpg";
							}else{
								$detail[0]['image'] = base_url()."/uploads/doctor/".$detail[0]['image'];
							}if(isset($detail[0]['expertise_list'])){
								$detail[0]['expertise_list'] = explode(',',$detail[0]['expertise_list']);
							}
						$detail[0]['qualification'] = $dat;
						$detail[0]['rating'] = 4;
						$data['success'] = True;
						$data['data'] = $detail;
						}else{
							$data['success'] = False;
							$data['error'] = "Invalid User Name Or Password";
						}
					header('Content-Type: application/json');
					echo json_encode($data);
					exit;
	}
	public function get_my_purchase_detail(){
		$doc_id = $this->input->get_post('doc_id');
		if(!isset($doc_id) && $doc_id != ''){
			$json['success'] = false;
			$json['error'] = "Please send Doctor id";
		}else{
			$data = $this->api_model->get_my_purchase_detail($doc_id);
			$det_data = [];
			foreach($data as $d){
				$subs = $this->api_model->get_subus_dtail($d['subscription_id']);
				$d['subs_name'] = $subs[0]['name'];
				$effectiveDate = strtotime("+".$subs[0]['no_of_month']." months", strtotime($d['created_at'])); // returns timestamp
				$d['expiry_date'] = date('Y-m-d h:i:s',$effectiveDate); // formatted version
				$det_data[] = $d;
			}

			$json['success'] = True;
			$json['data'] = $det_data;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function state_data(){
		$type = $this->input->get_post('type');
		if(!isset($type) || $type == ''){
			$json['success'] = false;
			$json['error'] = "Please send Type";
		}else{
			$detail = $this->api_model->state_data($type);
			$json['distance_price'] = DISTANCE_PRICE;
			$json['success'] = true;
			$json['data'] = $detail;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_dog_list(){
		//$name = $this->input->get_post('name');
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');	  // text
		//$type = $this->input->get_post('type');  //1-indivisuals,2-dealers,3-Breeders
		$mating_charge = $this->input->get_post('mating_charge');
		$data =  $this->api_model->get_dog_listing($latitude,$longitude,$mating_charge,$start);
		echo "<pre>";
		print_r($data);
		exit;
		$cat = explode(',', $d['dealer_cat_id']);
		$bre = explode('-', $d['dealer_bread_id']);
		$ca = [];
			if($cat[0] != ''){
				$i = 0;
				$ca = [];
			foreach($cat as $c){
				$cu = $this->api_model->get_category($c,$dealer_cat_id);
				// print_r($cu);
				// exit;
				$ca[$i]['category'] = $cu[0]['category'];
				$br = explode(',',$bre[$i]);
				$y = 0;
				foreach($br as $b){
					$bu = $this->api_model->get_breed($b);
					if($y == 0){
						$be = $bu[0]['breed_name'];
					}else{
						$be .=','.$bu[0]['breed_name'];;
					}
					$y++;
				}
				$ca[$i]['breed'] = $be;
				$i++;
			}
		}
			if($data){
				$json['success'] = true;
				$json['data'] = $data;
			}else{
				$json['success'] = false;
				$json['error'] = "Database error.";
			}
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function get_user_type(){
		$name = $this->input->get_post('name');
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');	  // text
		$type = $this->input->get_post('type');  //1-indivisuals,2-dealers,3-Breeders
		$dealer_cat_id = $this->input->get_post('category_id');
		if($dealer_cat_id == '' || $dealer_cat_id =='0'){
			$dealer_cat_id = '';
		}else{
			
			$dealer_cat_id = explode(',', $dealer_cat_id);
			$dealer_cat_id = implode('|', $dealer_cat_id);
		}
		$start = 0;
		//$premium = $this->input->get_post('premium'); //1=premium //0=nonpremium
		//$state = $this->input->get_post('state'); // dealer_state_id
		//$district = $this->input->get_post('district'); //dealer_city_id		
		//if($data = $this->api_model->get_get_user_type($name,$type,$district,$state)){
		if($data = $this->api_model->get_latlong_distance($latitude,$longitude,$type, $start,$name, $dealer_cat_id)){
			// print_r($data);
			// exit;
			$detail = [];
			foreach($data as $d){
				$cat = explode(',', $d['dealer_cat_id']);
				$bre = explode('-', $d['dealer_bread_id']);

				/*echo  "<pre>category...";
				print_r($cat);

				echo  "<pre>dealer_bread_id...";
				print_r($bre[0]);
				exit;*/

				$ca = [];
				$errorFlag = 1;
				if($cat[0] != ''){
					$i = 0;
					$ca = [];
					foreach($cat as $c){
						$cuRequest = $this->api_model->get_category($c);
						if(empty($cuRequest)) {
							if($errorFlag == 0) {
								$errorFlag = 0;
							}
						} else {
							$errorFlag = 0;
						}
						$cu = $this->api_model->get_category($c);
						$ca[$i]['category'] = $cu[0]['category'];
						$br = explode(',',$bre[$i]);
						
						$y = 0;
						foreach($br as $b){

							/*echo "<pre>..";
							print_r($c);

							echo "<pre>.....";
							print_r($b);*/
							if(!empty($b)) {
								//echo "<pre>.tre....";
								$bu = $this->api_model->get_breed($b);
								if($y == 0){
									$be = $bu[0]['breed_name'];
									// print_($be);
									// exit;
								}else{
									$be .=','.$bu[0]['breed_name'];
								
								}
							} else {
								$be = '';
							}

							/*echo 'ssss<pre>...';
							print_r($b);
							echo '<pre>..';
							print_r($cu[0]['category_id']);
							echo '<pre>...rrr';*/
							/*echo '<pre>...rrr';
							print_r($bu[0]['breed_id']);
							echo '<pre>...rrr';

							print_r($bu[0]['category_id']);
							print_r($bu);*/

							//print_r($b);
							//$bu = $this->api_model->get_breed($b,$dealer_cat_id);
							//added new bread for name
							
							$y++;
						}
						$ca[$i]['breed'] = $be;
						
						$i++;
					}
					//exit();
				}
				if ($errorFlag == 1) {
					$d['category'] = [];
				} else {
					$d['category'] = $ca;
					$detail[] = $d;
				}
				
			}
			
			if (empty($detail)) {
				$json['success'] = false;
				$json['error'] = "We are in process of updating the listings please check after 48 Hrs";
			} else {
				// echo "<pre>";
				// print_r($detail);
				// exit;
				$json['success'] = true;
				$json['data'] = $detail;
			}	
		}else{
			$json['success'] = false;
			$json['error'] = "We are in process of updating the listings please check after 48 Hrs";	
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}

	// public function get_user_type(){
	// 	$name = $this->input->get_post('name');
	// 	$latitude = $this->input->get_post('latitude');
	// 	$longitude = $this->input->get_post('longitude');	  // text
	// 	$type = $this->input->get_post('type');  //1-indivisuals,2-dealers,3-Breeders
	// 	$dealer_cat_id = $this->input->get_post('category_id');
	// 	$start = 0;
	// 	//$premium = $this->input->get_post('premium'); //1=premium //0=nonpremium
	// 	//$state = $this->input->get_post('state'); // dealer_state_id
	// 	//$district = $this->input->get_post('district'); //dealer_city_id		
	// 	//if($data = $this->api_model->get_get_user_type($name,$type,$district,$state)){
	// 	if($data = $this->api_model->get_latlong_distance($latitude,$longitude,$type, $start,$name)){
	// 		//print_r($data);
	// 		//exit;
	// 		$detail = [];
	// 		foreach($data as $d){
	// 			//print_r($d);
	// 			//$state = $this->api_model->get_state('', $d['dealer_state_id']);
	// 			//print_r($state);
	// 			//$d['dealer_state_name'] = $state[0]['name'];
	// 			//$city= $this->api_model->get_city_dist($d['dealer_city_id']);
	// 			//print_r($city);
	// 			//$d['dealer_city_name'] = $city[0]['city_name'];
	// 			$cat = explode(',', $d['dealer_cat_id']);
	// 			$bre = explode('-', $d['dealer_bread_id']);

	// 			//print_r($$bre);
	// 			//if($ca[$category] !='')
	// 			$d['category'] = $ca;
	// 			$detail[] = $d;
	// 			$test;
	// 			$ca = [];
	// 			if($cat[0] != ''){
	// 				$i = 0;
	// 				$ca = [];
	// 				foreach($cat as $c){
	// 					$cu = $this->api_model->get_category($c,$dealer_cat_id);
	// 					//print_r($cu);
	// 					//exit;
	// 					$ca[$i]['category'] = $cu[0]['category'];
	// 					$br = explode(',',$bre[$i]);
	// 					//print_r($br);
	// 					$y = 0;
	// 					foreach($br as $b){
	// 						//print_r($b);
	// 						if($ca[$i]['bread']!=undefined && $ca[$i]['bread']!=null) {
	// 						$bu = $this->api_model->get_breed($b,$dealer_cat_id);
	// 						if($y != 0){
	// 							$be = $bu[0]['breed_name'];
	// 						}else{
	// 							$be .=','.$bu[0]['breed_name'];;
	// 						}

	// 						$y++;
	// 					}

	// 					//$ca[$i]['test'] = "testing test";
	// 					if($be) {
	// 						$ca[$i]['test1'] = "111";
	// 						$ca[$i]['breed'] = $be;
	// 						$i++;
	// 					} else {
	// 						$ca[$i] = [];
	// 						$i++;
	// 					}
	// 					//$ca[$i]['breed'] = $be;
	// 					//$i++;
	// 				}}
	// 			}
	// 			$d['category'] = $ca;
	// 			$detail[] = $d;
	// 		}
	// 		$json['success'] = true;
	// 		//$json['abc'] = "testing ";
	// 		$json['data'] = $detail;	
	// 	}else{
	// 		$json['success'] = false;
	// 		$json['error'] = "No data Found";	
	// 	}
	// 	header('Content-Type: application/json');
	// 	echo json_encode($json);
	// 	exit;
	// }
	// public function get_user_type(){
	// 	$name = $this->input->get_post('name');	  // text
	// 	$type = $this->input->get_post('type');  //1-indivisuals,2-dealers,3-Breeders
	// 	$premium = $this->input->get_post('premium'); //1=premium //0=nonpremium
	// 	$latitude = $this->input->get_post('latitude');
	// 	$longitude = $this->input->get_post('longitude');
	// 	$where = '';
	// 	// var_dump($name);
	// 	// exit;
	// 	if($name != ""){
	// 		$where .= 'AND full_name like "%'.$name.'"';
	// 	}if($latitude != ""){
	// 		$where .= 'AND latitude like "%'.$latitude.'"';
	// 	}
	// 	if($premium != '')
	// 		$where .= 'AND is_premium = "'.$premium.'"';
	// 	if($data = $this->api_model->get_data('users_type_id = "'.$type.'" '.$where.'', 'users')){
	// 		// print_r($data);
	// 		// exit;
	// 		$json['success'] = true;
	// 		$json['data'] = $data;	
	// 	}else{
	// 		$json['success'] = false;
	// 		$json['error'] = "No data Found";	
	// 	}
	// 	header('Content-Type: application/json');
	// 	echo json_encode($json);
	// 	exit;
	// }
	public function make_animal_feature(){
		$animal_id = $this->input->get_post('animal_id');
		$users_id = $this->input->get_post('users_id');
		$feture_type = $this->input->get_post('feture_type');
		// if(!empty($anima_id) || $animal_id != ''){
		// 	$jaon['success']= false;
		// 	$json['error'] = "Please send animal id";
		// }else
			if(isset($users_id) || $users_id != ''){
				$count = $this->api_model->get_data('users_id = "'.$users_id.'" AND ispremium="1"' ,'animals', '', 'COUNT(animal_id) as count');
				if($count >= 5){
					$data['ispremium'] = $feture_type;
					if($data = $this->api_model->update('animal_id', $animal_id, 'animals', $data)){
						$json['success'] = true;
						$json['msg'] = 'Your Animal is updated as featured';	
					}else{
						$json['success'] = false;
						$json['error'] = 'Database Error';
					}
				}	
			}
		else{ 
			$json['success'] = false;
			$json['msg'] = 'You crosed your limit';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function subcription_calculation(){
		$doc_id = $this->input->get_post('doc_id');
		$prcentage = $this->input->get_post('percentage');
		$month = $this->input->get_post('month');
		$price = $this->input->get_post('price');
		$state = $this->input->get_post('state');
		if(isset($state) || $state != ''){
			$state = json_decode($state);
		}
		$price_sub = json_decode($price);
		$price = array_sum($price_sub);
		$data = $this->api_model->get_all_tax();
		$tot = $price*$month;
		$discount = ($tot*($prcentage/100));
		$array_data['discount'] = $discount;
		$array_data['sub_total'] =  round($tot, 2);
		$sub_total = $tot - $discount;
		$total = 0;
		$i=0;
		if(isset($state) || $state != ''){
			foreach($state as $sta){
				$sta_data[$i]['price'] = round($price_sub[$i] * $month, 2);
				$sta_data[$i]['name'] = $sta;
				$i++;
				//print_r($sta_data);
			}
		}else{
			$sta_data[$i]['price'] = round($tot,2);
			$sta_data[$i]['name'] = "Subscribe";
			$i++;
		}
		$y = 0;
		$sta_data[$i]['price'] = round($tot,2);	
		$sta_data[$i]['name'] = "Sub Total";
		$i++;
		$sta_data[$i]['price'] = $discount;	
		$sta_data[$i]['name'] = "Total Discount";
		$i++;
		foreach($data as $da){
			$total += $sub_total * ($da['tax_percentage']/100);
			$sta_data[$i]['price'] = $sub_total * ($da['tax_percentage']/100);	
			$sta_data[$i]['name'] = $da['name']." ". $da['tax_percentage']."%";
			$taxes[$y]['tax'] = $da['tax_percentage'];
			$taxes[$y]['name'] = $da['name'];
			$y++;
			$i++;
		}
		$credit = $this->api_model->get_total_credit($doc_id);
		$debit = $this->api_model->get_total_debit($doc_id);
		$total_cr = $credit[0]['amount'] - $debit[0]['amount'];
		if($total_cr != 0 && $total_cr > 0){
				$sta_data[$i]['name'] = "Credit Used";
				$sta_data[$i]['price'] = "-".$total_cr * PURCHASE_PER/100;
				$array_data['credit_used'] = $total_cr * PURCHASE_PER/100;
				// $log_data['type'] = '3';
				// $log_data['payment_type'] = 'Dr';
				// $log_data['users_id'] = $doc_id;
				// $log_data['currency'] = 'INR';
				// $log_data['status'] = '1';
				// $log_data['amount'] = $total_cr * PURCHASE_PER/100;
				// $this->api_model->insert_log_data($log_data);
		}else{
			$array_data['credit_used'] = "";
		}
		$array_data['total'] =  round(($sub_total + $total) - ($total_cr * PURCHASE_PER/100),2);
		$array_data['state'] = $sta_data;
		$array_data['tax'] = $taxes;
		//$array_data['tax'] = $total;
		$json['success'] = true;
		$json['data'] = $array_data;
		//$array_data['state'] = $data_tax;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doc_with_premium(){
		$type = $this->input->get_post('type');
		$distance = $this->input->get_post('distance');
		$latitude = $this->input->get_post('latitude');
		$limit = $this->input->get_post('limit');
		$start = $this->input->get_post('start');
		$langitude = $this->input->get_post('langitude');
		$speci_id = $this->input->get_post('speci_id');
		$speci_name = $this->input->get_post('speci_name');
		$state = $this->input->get_post('state_code');
		if(!isset($type) || $type==''){
			$json['success'] = false;
			$json['error'] = "Please send type";
		}else if(!isset($distance) && $distance != ''){
			if(isset($latitude) || $latitude ==''){
				$json['success'] = false;
				$json['error'] = "Please send latitude";
			}else if(isset($langitude) || $langitude ==''){
				$json['success'] = false;
				$json['error'] = "Please send Langitude";
			}
		}else{
			$where = '';
			$select = '';
			if($speci_id != '' || isset($speci_id)){
				$where .= 'AND (select GROUP_CONCAT(speci_id) from doc_qualification where doc_id = doc.doctor_id) like "%'.$speci_id.'%"';
			}
			if($speci_name != '' || isset($speci_name)){
				$select .= ', if(FIND_IN_SET("1",(SELECT GROUP_CONCAT(is_paid) from doc_pack_listing where service_type = "'.$speci_name.'" AND doc.doctor_id = doc_id)), "1","0") as is_paid';
			}
			$detail = $this->api_model->sql_query('select distinct doc.doctor_id, doc.image, doc.username, doc.visiting_fee, doc.ai_visiting_fee, doc.consul_fee '.$select.'  from doctor as doc  where doc.users_type = "'.$type.'" '.$where.' order by is_paid DESC limit '.$start.','.NUM_DISPLAY_ENTRIES.'');
			$count = $this->api_model->sql_query('select count(distinct doc.doctor_id) as count from doctor as doc  where doc.users_type = "'.$type.'" '.$where.'');
			$data = [];
			foreach($detail as $d){		
				// $doc_primum = $this->api_model->get_my_purchase_detail($d['doc_id']);
				// // print_r($doc_primum);
				// // exit;
				// if(!empty($doc_primum)){
				// 	//$d['service_data'] = $doc_primum;
				// 	$d['service_data'] = 1;
				// }else{
				// 	$d['service_data'] = 0;
				// }
				
				//print_r($doc_primum);
				// foreach($doc_primum as $pr){
				// 	print_r($pr);
				// 	exit;
				// }
				$doc_qua = $this->login_cheak_model->get_qulification_doc_id($d['doc_id']);
				//print_r($doc_qua);
					foreach($doc_qua as $dq){
						$qua_name = $this->login_cheak_model->get_qualification($dq['qualifi_id']);
						//print_r($qua_name);
						$dq['qualification_name'] = $qua_name[0]['qualifi_name'];
						$dq['document'] = base_url()."uploads/doctore_doc/".$dq['document'];
							if(!isset($dq['speci_id']) || $dq['speci_id'] != ''){
								//echo "this is true";
								$sp = json_decode($dq['speci_id']);
								//print_r($sp);
								foreach($sp as $s){
									$specialization = $this->login_cheak_model->get_specialisation($s);
									//print_r($specialization);
									$sep[] = $specialization[0]['speci_name'];
								}
							$dq['speci_name'] = $sep;
							}else{
							$dq['speci_name'] = [];
							}
						$dat[] = $dq; 
					}
					$doc_exp = $this->login_cheak_model->get_exp_doc_id($d['doc_id']);
					// print_r($doc_exp);
					// exit;
					$dtx = $doc_exp; 
					if(!isset($d['image'])){
						$d['image'] = base_url()."/uploads/image/profile.jpg";
					}else{
						$d['image'] = base_url()."/uploads/doctor/".$d['image'];
					}if(isset($d['expertise_list'])){
						$d['expertise_list'] = explode(',',$d['expertise_list']);
					}
					//$d['experience'] = $dtx;
					if(!empty($dtx)){
						$d['experience'] = $dtx;
					}else{
						$d['experience'] = [];
					}
					//$d['qualification'][0] = $dat;
					if(!empty($dat)){
						$d['qualification'] = $dat;
					}else{
						$d['qualification'] = [];
					}
					$d['rating'] = 4;
					$data = $d;
					//print_r($data);
					//$count['count']= $count[0]['data'];
					//print_r($doc_exp);			
				}
				// if($detail){
				// 	if(!isset($detail['image'])){
				// 		$detail[0]['image'] = base_url()."/uploads/image/profile.jpg";
				// 	}if(isset($detail[0]['expertise_list'])){
				// 		$detail[0]['expertise_list'] = explode(',',$detail[0]['expertise_list']);
				// 	}
				// $detail[0]['experience'] = $dtx;
				// $detail[0]['qualification'] = $dat;
				// $detail[0]['rating'] = 4;
				//if($speci_type !=''){
					//$count = $this->api_model->get_doc_quif_speci_count($speci_type);
					//$data['count'] = $count;
					//  print_r($speci_type);
					//  exit;
				//}else{
					//$count = $this->api_model->count_primum_doctor($type , $distance, $latitu, $langitude, $state, $speci_type, '');
					//$data['count'] = $count;
				//}
				if(!empty($data)){
					// print_r($data);
					// exit;
				$json['success'] = True;
				$json['data'][] = $data;
				$json['count'] = $count[0]['count'];	
				}else{
					$json['success'] = False;
					$json['error'] = "No Listing Found in Your Area";
				}
			// $json['success'] = true;
			// $json['data'] = $data;
		}
		echo json_encode($json);

	}
	public function get_doctor_list(){
		$languages= $this->input->get_post('languages');
		$languages = explode(',', $languages);
		$languages = implode('|', $languages);
		$name = $this->input->get_post('name');
		$price = $this->input->get_post('price');
		$expertise_list = $this->input->get_post('expertise_list');
		$expertise_list_num = $this->input->get_post('expertise_list_num');
		$specialisation_list = $this->input->get_post('specialisation_list');
		$qualification= $this->input->get_post('qualification');
		$start= $this->input->get_post('start');
		if($start == '')
			$start = 0;
			

		if($data = $this->api_model->get_doctor_list($languages, $expertise_list, $specialisation_list, $qualification, $start, $expertise_list_num, $name, $price)){
			$data_count = $this->api_model->get_doctor_list_count($languages, $expertise_list, $specialisation_list, $qualification, $start, $expertise_list_num, $name, $price);
			$json['success'] = True;
			$json['data'] = $data;
			$json['count'] = $data_count[0]['count'];
		}else{
			$json['success'] = False;
			$json['error'] = 'No data found';
		}
		
		// print_r($data);
		// exit();
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_all_doc_by_premium(){
		$type = $this->input->get_post('type');
		$distance = $this->input->get_post('distance');
		$premium_type = $this->input->get_post('premium_type');
		$latitu = $this->input->get_post('latitu');
		$limit = $this->input->get_post('limit');
		$start = $this->input->get_post('start');
		$languages = $this->input->get_post('languages');
		$languages = explode(',', $languages);
		$languages = implode('|', $languages);
		$name = $this->input->get_post('name');
		$visiting_set = $this->input->get_post('visiting_set');
		$expertise = $this->input->get_post('expertise');
		// if($premium_type == '0'){
		// 	$premium_type = '';
		// }
		// if(!isset($start) || $start == ''){
		// 	$json['success'] = false;
		// 	$json['error'] = "Please send  peci type type";
		// }else{
		// 	$detail = $this->api_model->get_doc_quif_speci($speci_type);
		// }
		if($start == '' || !isset($start))
		$start = 0;
		$langitude = $this->input->get_post('langitude');
		$speci_type = $this->input->get_post('speci_id');
		$state = $this->input->get_post('state_code');
		// if(!isset($type) || $type==''){
		// 	$json['success'] = false;
		// 	$json['error'] = "Please send type";
		// }else if(!isset($distance) && $distance != ''){
			// if(isset($latitu) || $latitu ==''){
			// 	$json['success'] = false;
			// 	$json['error'] = "Please send latitude";
			// }else if(isset($langitude) || $langitude ==''){
			// 	$json['success'] = false;
			// 	$json['error'] = "Please send Langitude";
			// }
			
		 //}//if($premium_type = '0'){
		// 	$detail = $this->api_model->doc_primum_listing($type , $distance, $latitu, $langitude, $state, $speci_type, $start);
		// 	prit_r($detail);
		// 	exit;
		// }
		//else{ 
			// if(!isset() || $premium_type = '0'){
			// 	$detail = $this->api_model->doc_primum_listing($type , $distance, $latitu, $langitude, $state, $speci_type, $start);
			// }
			//if($speci_type !=''){
				$detail = $this->api_model->get_doc_quif_speci_list($speci_type, $premium_type, $latitu, $langitude, $languages, $name, $expertise, $visiting_set, $start);
			// }else{
			// 	$detail = $this->api_model->doc_primum_listing($type , $distance, $latitu, $langitude, $state, $speci_type, $start);
			// 	 //print_r($detail);
			// 	// exit;
				
			// }
			$data = [];
			$i = 0;
			foreach($detail as $d){	
				//if($d['doc_id'] != ''){
					$i++;
					$doc_primum = $this->api_model->get_my_purchase_detail($d['doc_id']);
					if($d['languages'] != ''){
						$d_name= $this->api_model->get_all_lang($d['languages']);
						$d['languages'] = $d_name[0]['name'];
					}
					//print_r($doc_primum);
					$de['is_paid'] = $doc_primum[0]['is_paid'];
					//print_r($de);
					//exit;
					 
					if(!empty($de)){
						$d['service_data'] = 1;
					}else{
						$d['service_data'] = 0;
					}
					$doc_qua = $this->login_cheak_model->get_qulification_doc_id($d['doc_id']);
					//print_r($doc_qua);
						foreach($doc_qua as $dq){
							//if(!$dq['doc_id'] === NULL){
								$qua_name = $this->login_cheak_model->get_qualification($dq['qualifi_id']);
								//print_r($qua_name);
								$dq['qualification_name'] = $qua_name[0]['qualifi_name'];
								$dq['document'] = base_url()."uploads/doctore_doc/".$dq['document'];
									if(!isset($dq['speci_id']) || $dq['speci_id'] != ''){
										//echo "this is true";
										$sp = json_decode($dq['speci_id']);
										//print_r($sp);
										foreach($sp as $s){
											$specialization = $this->login_cheak_model->get_specialisation($s);
											//print_r($specialization);
											$sep[] = $specialization[0]['speci_name'];
										}
									$dq['speci_name'] = $sep;
									}else{
									$dq['speci_name'] = [];
									}
								$dat[] = $dq; 
							//}
						}
						$doc_exp = $this->login_cheak_model->get_exp_doc_id($d['doc_id']);
						// print_r($doc_exp);
						// exit;
						$dtx = $doc_exp; 
						// if(!isset($d['image'])){
						// 	$d['image'] = base_url()."/uploads/image/profile.jpg";
						// }else{
						// 	$d['image'] = base_url()."uploads/doctor/".$d['image'];
						// }
						if(isset($d['expertise_list'])){
							$d['expertise_list'] = explode(',',$d['expertise_list']);
						}
						//$d['experience'] = $dtx;
						if(!empty($dtx)){
							$d['experience'] = $dtx;
						}else{
							$d['experience'] = [];
						}
						//$d['qualification'][0] = $dat;
						if(!empty($dat)){
							$d['qualification'] = $dat;
						}else{
							$d['qualification'] = [];
						}
						$dat = '';
						$d['rating'] = 4;
						$data[] = $d;
					//}	
				
					//print_r($data);
					//$count['count']= $count[0]['data'];
					//print_r($doc_exp);			
				}
				// if($detail){
				// 	if(!isset($detail['image'])){
				// 		$detail[0]['image'] = base_url()."/uploads/image/profile.jpg";
				// 	}if(isset($detail[0]['expertise_list'])){
				// 		$detail[0]['expertise_list'] = explode(',',$detail[0]['expertise_list']);
				// 	}
				// $detail[0]['experience'] = $dtx;
				// $detail[0]['qualification'] = $dat;
				// $detail[0]['rating'] = 4;
				//if($speci_type !=''){
					// $count = $this->api_model->get_doc_quif_speci_count($speci_type);
					// $cou = $count[0]['count'];
					//  print_r($speci_type);
					//  exit;
				// }else{
				// 	$count = $this->api_model->count_primum_doctor($type , $distance, $latitu, $langitude, $state, $speci_type, '');
				// 	$cou = $count[0]['count'];
				// }
				if($cou != '0'){
					if(!empty($data)){
						// print_r($data);
						// exit;
					$json['success'] = True;
					$json['data'] = $data;
					$json['count']	= $i;	
					}else{
						$json['success'] = False;
						$json['error'] = "No Listing Found in Your Area";
					}
				}else{
					$json['success'] = False;
					$json['error'] = "No Listing Found in Your Area";
				}
		//}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_feed_company_detail(){
		$id = $this->input->get_post('id');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$data = $this->api_model->get_company_detail($id , $latitude, $langitude);
		$darray = [];
		foreach($data as $d){
			$d['logo'] = base_url()."/uploads/company/".$d['logo'];
			$d['banner'] = base_url()."/uploads/company_banner/".$d['banner'];
			$darray[] = $d;
		}
		$json['success'] = True;
		$json['data'] = $darray;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_dary_farm(){
		$id = $this->input->get_post('id');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$data = $this->api_model->get_dary_farm($id , $latitude, $langitude);
		$darray = [];
		$animai_detail = [];
		foreach($data as $d){
			$animal_type = explode(',',$d['animal_type']);
			$animal_breed = explode(',',$d['animal_breed']);
			$animale_no = explode(',',$d['animale_no']);
			$i = 0;
			$ani_detail = [];
			$an_d = [];
			foreach($animal_type as $ani){
				$ani_detail['animal_type'] =  $ani;
				$ani_detail['animal_breed'] =  $animal_breed[$i];
				$ani_detail['animale_no'] = $animale_no[$i];
				$an_d[] = $ani_detail;
				$i++;
			}
			$d['animal_detail'] = $an_d;
			$d['image'] = base_url()."/uploads/company/".$d['image'];
			$ban_data = [];
			$banarray = explode(',',$d['banner']);
			foreach($banarray as $ban){
				$ban_data[] = base_url()."/uploads/company_banner/".$ban;
			}
			$d['banner'] = $ban_data;
			$darray[] = $d;
		}
		$json['success'] = True;
		$json['data'] = $darray;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function user_animal_symtoms(){
		$data = $this->api_model->user_animal_symtoms();
		$json['success'] = True;
		$json['data'] = $data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function report_milk_adulttration(){
		$data['user_id'] = $this->input->get_post('users_id');
		$data['text'] = $this->input->get_post('text');
		if($this->api_model->add_report_milk_adulttration($data)){
			$json['success'] = True;
			$json['msg'] = "Your Report has been Successfully Submited";
		}else{
			$json['success'] = False;
			$json['error'] = "There is problem with database";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_seman_company_detail(){
		$id = $this->input->get_post('id');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$data = $this->api_model->get_seman_company_detail($id , $latitude, $langitude);
		$darray = [];
		foreach($data as $d){
			$d['image'] = base_url()."/uploads/company/".$d['image'];
			$d['banner'] = base_url()."/uploads/company_banner/".$d['banner'];
			$darray[] = $d;
		}
		$json['success'] = True;
		$json['data'] = $darray;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function insert_doc_pack(){
		$data['type'] = $this->input->get_post('type'); //distance, state
		$state_id = json_decode($this->input->get_post('state_id')); // ['1','2']
		$data['service_type'] = $this->input->get_post('service_type');
		$data['state_id'] = implode(',', $state_id);
		$price = json_decode($this->input->get_post('price')); // ["14000","15000"]
		$data['price'] = implode(',',$price);
		$data['subscription_id'] = $this->input->get_post('subscription_id');
		$data['doc_id'] = $this->input->get_post('doc_id');
		$data['discount_amount'] = $this->input->get_post('discount_amount');
		$data['subscription_discount'] = $this->input->get_post('subscription_discount');
		$data['subtotal'] = $this->input->get_post('subtotal');
		$data['total'] = $this->input->get_post('total');
		$taxes = json_decode($this->input->get_post('taxes')); //["18","19"]
		$data['taxes'] = implode(',',$taxes);
		$taxes_name = json_decode($this->input->get_post('taxes_name')); //["service_tax", "GST"]
		$data['taxes_name']  = implode(',',$taxes_name);
		$data['latitude'] = $this->input->get_post('latitude');
		$data['langitude'] = $this->input->get_post('langitude');
		$data['address'] = $this->input->get_post('address');
		$data['purchase_id'] = $this->input->get_post('purchase_id');
		$data['created_at'] = date('Y-m-d h:i:s');
		//print_r($data);
		if($last = $this->api_model->insert_doc_pack($data)){
			$json['success'] = true;
			$json['data']['listing_id'] = $last;
		}else{
			$json['success'] = false;
			$json['error'] = "There is problem with database";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_subscription(){
		$data = $this->api_model->get_subscription();
		$json['success'] = true;
		$json['data'] = $data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function register_doc(){
		$name = $this->input->get_post('name');
		$gender = $this->input->get_post('gender');
		$type = $this->input->get_post('type');
		$fathers_name = $this->input->get_post('fathers_name');
		$registration_no = $this->input->get_post('registration_no');
		$email = $this->input->get_post('email');
		$mobile = $this->input->get_post('mobile');
		$expertise_list = $this->input->get_post('expertise_list');
		$expertise_list = json_decode($expertise_list);
		$expertise_list = implode(',',$expertise_list);
		$aadhar_no = $this->input->get_post('aadhar_num');
		$dob = $this->input->get_post('dob');
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');
		$fcm_android = $this->input->get_post('fcm_android');
		$fcm_ios = $this->input->get_post('fcm_ios');
		$bank_name = $this->input->get_post('bank_name');
		$branch_address =$this->input->get_post('branch_address');
		$ifsc_code = $this->input->get_post('ifsc_code');
		$account_no= $this->input->get_post('account_number');
		$account_holder_name= $this->input->get_post('account_holder_name');
		$city= $this->input->get_post('city');
		$state= $this->input->get_post('state');
		$state_code= $this->input->get_post('state_code');
		$district= $this->input->get_post('district');
		$district_code= '';
		$address_full = $this->input->get_post('address');
		$qualificationList = $this->input->get_post('qualificationList');
		$experience_list = $this->input->get_post('experience_list');
		$experience_desc = $this->input->get_post('experience_desc');
		$total_experience = $this->input->get_post('total_experience');
		$adhaar_img = $this->input->get_post('adhaar_img');
		$pincode = $this->input->get_post('pincode');
		$user_image = $this->input->get_post('image');
		$is_available_consultation = $this->input->get_post('available_consultation');
		$languages = $this->input->get_post('selected_language_id');
		$languages = json_decode($languages);
		$languages = implode(',', $languages);
		$registeration_council = $this->input->get_post('registeration_council');
		$registeration_year = $this->input->get_post('registeration_year');
		$password = $this->input->get_post('passcode');
		$consul_fee = $this->input->get_post('consultation_fee'); 
		$visiting_fee = $this->input->get_post('visiting_fee');
		$mobile_code = $this->input->get_post('mobile_code');
		//$is_consultation_on = $this->input->get_post('is_consultation_on');
		$qualificationList = json_decode($qualificationList);
		$experience_list = json_decode($experience_list);
		$mobilecheck = $this->api_model->docmobileadhaarcheck($mobile, $mobile_code); 
		$adhaarcheck = $this->api_model->docadhaarcheck($aadhar_no);
		$emailcheck = $this->api_model->docemailcheck($email);
		if ($mobilecheck) {
				$json['success'] = false;
				$json['error'] = "Mobile No already associated with another account.";
		}
		// if ($adhaarcheck) {
		// 		$json['success'] = false;
		// 		$json['error'] = "Adhaar already associated with another account.";
		// }
		if ($emailcheck) {
				$json['success'] = false;
				$json['error'] = "Email is already associated with another account.";
		}
		if($json['error'] == ''){
				$data['registeration_council'] = $registeration_council;
				$data['registeration_year'] = $registeration_year;
				$data['adhaar_img'] = $adhaar_img;
				$data['username'] = $name;
				$data['fathers_name'] = $fathers_name;
				$data['password'] = md5($password);
				$specialisation_list = json_decode($this->input->get_post('specialisation_list'));
				$data['specialisation_list'] = implode(',', $specialisation_list);
				$data['gender'] = $gender;
				$data['address_full'] = $address_full;
				$data['users_type'] = $type;
				$data['registration_no'] = $registration_no;
				$data['email'] = $email;
				$data['mobile'] = $mobile;
				//$data['is_consultation_on'] = '1';
				$data['mobile_code'] = $this->input->get_post('mobile_code');
				$data['aadhar_no'] = $aadhar_no;
				$data['dob'] = $dob;
				$data['image'] = $user_image;
				$data['latitude'] = $latitude;
				$data['longitude'] = $longitude;
				$data['fcm_android'] =  $fcm_android;
				$data['fcm_ios'] = $fcm_ios;
				$data['bank_name'] = $bank_name;
				$data['branch_address'] = $branch_address;
				$data['ifsc_code'] = $ifsc_code;
				$data['languages'] = $languages;
				$data['account_no'] = $account_no;
				$data['total_experience'] = $total_experience;
				$data['experience_desc'] = $experience_desc;
				$data['account_holder_name'] = $account_holder_name;
				$data['is_available_consultation'] = $is_available_consultation;
				$data['city'] = $city;
				$data['date'] = date('Y-m-d h:i:s');
				$data['state'] = $state;
				$data['state_code'] = $state_code;
				$data['district'] = $district;
				$data['district_code'] = $district_code;
				$data['pincode'] = $pincode;
				$data['consul_fee'] = $consul_fee;
				$data['expertise_list'] = $expertise_list;
				$data['visiting_fee'] = $visiting_fee;
				$num_str = sprintf("%08d", mt_rand(1, 99999999));
				$data['refral_code'] = $num_str;
				$data['refral_by_code'] = '';
				
				if($last_id = $this->api_model->insert_doc_info($data)){
					if(!empty($qualificationList)){
						foreach($qualificationList as $quali){
							$quali_data['doc_id'] =  $last_id;
							$quali_data['qualifi_id'] =  $quali->qualifi_id;
							$quali_data['document'] = $quali->document;
							$quali_data['institute'] =  $quali->institute;
							$quali_data['speci_id'] =  $quali->speci_id;
							$quali_data['year'] =  $quali->year;
							$this->api_model->insert_doc_quali($quali_data);
						}
					}
					if(!empty($experience_list)){
						foreach($experience_list as $exp){
							$exp_data['doc_id'] = $last_id;
							$exp_data['designation']= $exp->designation;
							$exp_data['from_date']= $exp->from_date;
							$exp_data['organization']= $exp->organization;
							$exp_data['to_date']= $exp->to_date;
							$exp_data['year']= $exp->year;
							$ex = $this->api_model->insert_doc_exp($exp_data);
						}
					}
					$last_data = $this->api_model->get_doc_id_det($last_id);
					$last_data['expertise_list'] = explode(',',$last_data['expertise_list']);
					$last_data['image'] = base_url().'uploads/doctor/'.$last_data['image'];
					$json['success'] = TRUE;
					$json['msg'] =  "Its Done";
					$json['data'][] = $last_data;
				}
			}
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}

	public function get_state(){
		$country_id = $this->input->get_post('country_id');
		$detail = $this->api_model->get_state($country_id);
		if(isset($detail)){
			$json['success'] = true;
		  $json['data'] = $detail;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}

	public function doc_banner(){
		$type = $this->input->get_post('type');
		if(!isset($type) || $type == ''){
			$json['success'] = false;
			$json['error'] = "Type is Required";
		}else{
			$data = $this->api_model->get_doc_banner($type);
			foreach($data as $d){
				$d['image'] = base_url()."uploads/doc_banner/".$d['image'];
				$d_new[] = $d;
			}
			$json['success'] = TRUE;
			$json['data'] = $d_new;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_last_log_id(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		// $payment_type = $this->input->get_post('payment_type');
		// $month = $this->input->get_post('month');
		// $tax = $this->input->get_post('tax');
		// $discount = $this->input->get_post('tax');
		// $package_id = $this->input->get_post('package_id');
		$premium_bull_type = $this->input->get_post('premium_bull_type');
		$currency = $this->input->get_post('currency');
		$amount = $this->input->get_post('amount');
		$user_type = $this->input->get_post('user_type');
		$request_status  =$this->input->get_post('request_status');
		if(!isset($users_id) || $users_id == ''){
			$json['success'] = false;
			$json['error'] = "User id Required";
		}else if(!isset($type) || $type == ''){
			$json['success'] = false;
			$json['error'] = "Type Required";
		}else if(!isset($currency) || $currency == ''){
			$json['success'] = false;
			$json['error'] = "Currency Required";
		}else if(!isset($amount) || $amount == ''){
			$json['success'] = false;
			$json['error'] = "Amount Required";
		}else{
			$data['users_id'] = $users_id;
			$data['currency'] = $currency;
			$data['type'] = $type;
			$data['amount'] = $amount;
			// $data['payment_type'] = $payment_type;
			// $data['month'] = $month;
			// $data['package_id'] = $package_id;
			// $data['tax'] = $tax;
			// $data['discount'] = $discount;
			$data['user_type'] = $user_type;
			$data['premium_bull_type'] = $premium_bull_type;
			$data['request_status'] = isset($request_status) ? $request_status : 0;
			$data['date'] = date('Y-m-d h:i:s');
			$detail = $this->api_model->insert_log_data($data);
			$detail[0]['order_id'] = "LVAT_".$detail[0]['purchase_id']."";
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$detail[0]['purchase_id']."&amount=".$amount."&currency=".$currency."",
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
			//print_r(json_decode($response));
			// if ($err) {
			// 	echo "cURL Error #:" . $err;
			// } else {
			// 	print_r(json_decode($response));
			// }
			$detail[0]['razorpayOrderId'] =  json_decode($response);
			$json['success'] = true;
			$json['data'] = $detail;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function web_upload_Images()
  	{
		$path = $this->input->get_post('path');
		if (!empty($_FILES['image']['name'])) {
			$config = array();
				$config['upload_path'] = '/var/www/html/harpahu_merge/uploads/'.$path;
				$config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG|pdf';
				$config['max_size']      = '20000';

				$config['overwrite']     = FALSE;
				$config['file_name'] =time().$_FILES['userfile']['name'];
				//$config['file_name'] =  time() . ".";										
				$this->load->library('upload');
				foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
				{
					if (!empty($fileObject['name']))
					{
						$this->upload->initialize($config);
						if (!$this->upload->do_upload($fieldname))
						{
							$data['success'] =  False;
							$data['error'] = $this->upload->display_errors(); 
							//print_r($data);
						}
						else
						{
							$upload_data = $this->upload->data();
							// $test['test_id'] = $test_id;
							// $test['sub_request_id'] = $sub_request_id;
							// $test['image'] =$upload_data['file_name'];
							// $this->api_model->request_test_ins($test);
							$data['success'] =  TRUE;
							$data['data'][] = $upload_data['file_name'];
						}
					}
															
				}
		}
		echo json_encode($data);
		exit;
	}
	public function web_cropper_images()
  	{
  		//$path = $this->input->get_post('path');
		//$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
		//Working with each images are required
      	$path = $this->input->get_post('path');
		if (!empty($_FILES['image']['name'])) {
	  	    $upload_conf = array(
		    	'upload_path'   => '/var/www/html/harpahu_merge/uploads/cropper_images/',
		   	 	'allowed_types' => 'jpg|gif|png|jpeg|jpg|png|pdf',
		    	'max_size'      => '300000',
		    	'encrypt_name'  => true,
		    );
		    
		    $this->load->library('upload');
		    $this->upload->initialize( $upload_conf );
		    $field_name = 'image';
		    if ( !$this->upload->do_upload('image','')){
		        $error['upload']= $this->upload->display_errors();	
		        echo json_encode($error);
				exit;			
		    } else {
		    	//Working with  crop x left and y top
		    	/*
		    	$upload_data = $this->upload->data();
		        $resize_conf = array(
		            'upload_path'  => realpath('C:/xampp/htdocs/harpahu_merge_dev/uploads/user/'),
		            'source_image' => $upload_data['full_path'], 
		            'new_image'    => $upload_data['file_path'].'/thumbnail/'.$upload_data['file_name'],
		            'x_axis'        => '300',
		            'y_axis'       => '300',
		            'width'        => ($upload_data['image_width'] - 300),
		            'height'       => ($upload_data['image_height'] - 300),
		            'create_thumb' => TRUE,
					'maintain_ratio' => TRUE,
					'image_library' => 'gd2',
					'quality' => '100%',
		        );
		        $this->load->library('image_lib'); 
		        $this->image_lib->initialize($resize_conf);
		        //$this->image_lib->crop();
		        if (!$this->image_lib->crop()){
		            // if got fail.
		            $error['resize'] = $this->image_lib->display_errors();	
		            echo json_encode($error);
					exit;					
		        }else{
		            $data_to_store['ProfilePic'] = $upload_data['file_name'];						
		            $data1['ProfilePic'] = $upload_data['file_name'];
		        }*/

		   		//Working with  500px values
		        $upload_data = $this->upload->data();
		        //New code px
		        $upload_data = $this->upload->data();
			    $aspect_ratio = ($upload_data['image_height'] / $upload_data['image_width']);
			    // Change the height according to the aspect ratio
			    $height = (int)($aspect_ratio * 500);
				// Divide height by width to get the apect ratio.
			    $aspect_ratio = ($upload_data['image_width'] / $upload_data['image_height']);
			    // Change the height according to the aspect ratio
			    $width = (int)($aspect_ratio * 500);

		        $resize_conf = array(
		            'upload_path'  => '/var/www/html/harpahu_merge/uploads/cropper_images/',
		            'source_image' => $upload_data['full_path'], 
		            'new_image'    => '/var/www/html/harpahu_merge/uploads/'.$path.'/'.$upload_data['file_name'],
		            'width'        => $width,
		            'height'       => $height,
		            'create_thumb' => TRUE,
					'maintain_ratio' => TRUE,
					'image_library' => 'gd2'
		        );
		        $this->load->library('image_lib'); 
		        $this->image_lib->initialize($resize_conf);
		        //$this->load->library('image_lib', $resize_conf); 
		        // do it!
		        if (!$this->image_lib->resize()){
		            // if got fail.
		            $error['resize'] = $this->image_lib->display_errors();	
		            echo json_encode($error);
					exit;					
		        }else{
		            $data_to_store['ProfilePic'] = $upload_data['file_name'];						
					$data1['ProfilePic'] = $upload_data[''];
					$data['success'] =  TRUE;
					$data['data'][] = $upload_data['raw_name']."_thumb".$upload_data['file_ext'];	
		        }
		    }
		}
		echo json_encode($data);
		exit;
	}
	public function upload_job(){
		$path = $this->input->get_post('path');
		if(!isset($path) || !$path)
		{ 
			  $data['error'] =  "path is required";
		}  
		if(empty($data['error'])){
				if (!empty($_FILES['image']['name'])) {
						$config = array();
						$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
						$config['allowed_types'] = 'pdf|doc|docx|txt';
						$config['max_size']      = '20000';
						$config['overwrite']     = FALSE;
						$config['file_name'] =time().$_FILES['userfile']['name'];									
						$this->load->library('upload');
						foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
						{
							if (!empty($fileObject['name']))
							{
								$this->upload->initialize($config);
								if (!$this->upload->do_upload($fieldname))
								{
									$data['success'] =  False;
									$data['error'] = $this->upload->display_errors(); 
								}
								else
								{
									$upload_data = $this->upload->data();
									// $test['test_id'] = $test_id;
									// $test['sub_request_id'] = $sub_request_id;
									// $test['image'] =$upload_data['file_name'];
									// $this->api_model->request_test_ins($test);
									$data['success'] =  TRUE;
									$data['data'][] = $upload_data['file_name'];
								}
							}
																			
						}
				}
				else{
					$data['success'] =  False;
					 $data['error'][] = "File is required";
			   	}
			}
			else{
				$data['success'] =  False;
			}
			header('Content-Type: application/json');
			echo json_encode($data);
			exit;	
	}
	public function get_city(){
		$country_id = $this->input->get_post('country_id');
		$state_id = $this->input->get_post('state_id');
		// echo $state_id;
		// exit;
			$detail = $this->api_model->get_city($state_id, $country_id);
			if(isset($detail)){
				$json['success'] = true;
				$json['data'] = $detail;
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}

	public function get_qualification(){
		$detail = $this->api_model->get_qualification();
		if(isset($detail)){
			$json['success'] = true;
		  $json['data'] = $detail;
		}
		header("Content-type:application/json");
		echo json_encode($json);
		exit;
	}

	public function get_prefered_language(){
		$detail = $this->api_model->get_prefered_language();
		if(isset($detail)){
			$json['success'] = true;
		  $json['data'] = $detail;
		}
		header("Content-type:application/json");
		echo json_encode($json);
		exit;
	}

	public function doc_register(){
		if(!isset($_REQUEST['name']))
		{ 
				$json['success'] = False;
			  $json['error'] =  "Name is required";
		}else if(!isset($_REQUEST['gender']))
		{ 
				$json['success'] = False;
			  $json['error'] =  "Gender is required";
		}else if(!isset($_REQUEST['name']))
		{ 
				$json['success'] = False;
			  $json['error'] =  "Name is required";
		}else{
			
		}
	}

	public function get_specialisation(){
		$quali_id = $this->input->get_post('quali_id');
		if(!isset($quali_id))
		{ 
				$json['success'] = False;
			  	$json['error'] =  "Qualification ID is required";
		}else{
				$detail = $this->api_model->get_specialisation($_REQUEST['quali_id']);
				if(isset($detail)){
					$json['success'] = true;
					$json['data'] = $detail;
				}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function request_edit(){
		$id = $this->input->get_post('id');
		$month = $this->input->get_post('month');
		$vaccin = '-'.$month. 'month';
		$vacc_date = date('Y-m-d', strtotime($vaccin));
		$data['date'] = $vacc_date;
		if($data = $this->api_model->request_edit($id, $data)){
			$tre_arr = $this->api_model->get_vacc_det($data[0]['vacc_id']);
			$i=0;
			foreach($tre_arr as $tre){
				if($i==0){
					$tre_name = $tre['name'];
				}else{
					$tre_name .= ','.$tre['name'];
				}
				$i++;
			}
			$data[0]['name'] = $tre_name;
			$json['success'] = true;
			$json['msg'] = 'सफलता पूर्वक सम्पादित हुआ';
			$json['data'] = $data;
		}else{
			$json['success'] = false;
			$json['msg'] = 'Database error';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	// public function upload_Images()
  	// {
	// 	$path = $this->input->get_post('path');
		
	// 		foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name(This function used for upload multiple files)
	// 		{
	// 			$file = exif_imagetype($fileObject['tmp_name']);

	// 			if(empty($fileObject['tmp_name'])){
	// 				$data['success'] =  False;
	// 				$data['error'] = "Something Went Wrong";
	// 				$data['internal use'] = "Image is blank";
	// 				$data['errorcode'] = "7001";
	// 			}
	// 			else if(!empty($file))
	// 			{
					
	// 				$data =	$this->doimageupload($path,$_FILES,$fieldname ,$fileObject);
	// 			}
	// 		else{
	// 				$data =	$this->dofileupload($path,$_FILES, $fileObject);
	// 			}
	// 		}
	// 		header('Content-Type: application/json');
	// 		echo json_encode($data);
	// 		exit;
	//   }
	 
	//   public function doimageupload($path,$FILES,$fieldname ,$fileObject)
	//   {
	// 	$config = array();
	// 	$config['upload_path'] = file_path.$path;
	// 	$config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
	// 	$config['max_size']      = '20000';
	// 	$config['overwrite']     = FALSE;
	// 	$config['file_name'] =time().'-'.rand(10,10000).$fileObject['name'];
	// 	$this->load->library('upload');
	// 	$this->upload->initialize($config);
	// 		if (!$this->upload->do_upload($fieldname))
	// 		{
	// 					$data['success'] =  False;
	// 					$data['error'] = $this->upload->display_errors();
	// 					$data['errorcode'] = "7002";
	// 					return $data;
	// 		}
	// 		else
	// 		{
	// 				$upload_data = $this->upload->data();
	// 				$data['success'] =  TRUE;
	// 				$data['data'][] = $upload_data['file_name'];
	// 				//Image Resize Code
	// 				$config['image_library'] = 'gd2';
	// 				$config['source_image'] = file_path.$path.'/'.$upload_data['file_name'];
	// 				$config['new_image'] = file_path.$path.'/thumbs';
	// 				//$config['create_thumb'] = TRUE;
	// 				$config['maintain_ratio'] = TRUE;
	// 				$config['width'] = 200;
	// 				$config['height'] = 200;
	// 				$this->load->library('image_lib', $config);
	// 				//$this->image_lib->resize();
	// 				if ( ! $this->image_lib->resize())
	// 				{
	// 					unlink($config['source_image']);
	// 					$data['success'] =  False;
	// 					$data['error'] = $this->image_lib->display_errors();
	// 					$data['errorcode'] = "7003";
	// 				}
	// 				//end image resize code
					
	// 		}
	// 	//}

	// 	//End for each Replace
	// 	return $data;		
	//   }

	//   public function dofileupload($path,$FILES, $fileObject)
	//   {
	// 	$config = array();
	// 	$config['upload_path'] = file_path.$path;
	// 	$config['allowed_types'] = 'mov|mpeg|mp3|avi|mp4|pdf';
	// 	$config['max_size']      = '20000';
	// 	$config['overwrite']     = FALSE;
	// 	//$config['max_size']    ='100';
	// 	//$config['max_width'] 	= '500';
	// 	//$config['max_height'] = '900';
	// 	//900*500px
	// 	$config['file_name'] =time().'-'.rand(10,10000).$FILES['image']['name'];
	// 	//$config['file_name'] =  time() . ".";										
	// 	$this->load->library('upload');
	// 	foreach ($FILES as $fieldname => $fileObject)  //fieldname is the form field name
	// 	{
	// 		if (!empty($fileObject['name']))
	// 		{
	// 			$this->upload->initialize($config);
	// 			if (!$this->upload->do_upload($fieldname))
	// 			{
	// 						$data['success'] =  False;
	// 						$data['error'] = $this->upload->display_errors(); 
	// 						return $data;
	// 			}
	// 			else
	// 			{
	// 					$upload_data = $this->upload->data();
	// 					$data['image'] =$upload_data['file_name'];
	// 					$data['success'] =  TRUE;
	// 					$data['data'][] = $upload_data['file_name'];
	// 					return $data;
	// 			}
	// 		}
	
	// 	}		
	//   }
	public function upload_Images()
  	{
		$path = $this->input->get_post('path');
		$test_id = $this->input->get_post('test_id');
		$sub_request_id = $this->input->get_post('sub_request_id');
		$treat_id = $this->input->get_post('treat_id');
		if(!isset($path) || !$path)
		{ 
			  $data['error'] =  "path is required";
		}  
		if(empty($data['error']))
		{
	   	if (!empty($_FILES['image']['name'])) {
											if(isset($test_id)){
																$config = array();
																$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
																$config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG|mov|mpeg|mp3|avi|mp4|pdf';
																$config['max_size']      = '20000';
																$config['overwrite']     = FALSE;
																$config['file_name'] =time().$_FILES['userfile']['name'];
																										//$config['file_name'] =  time() . ".";										
																$this->load->library('upload');
																foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
																{
																	if (!empty($fileObject['name']))
																	{
																		$this->upload->initialize($config);
																		if (!$this->upload->do_upload($fieldname))
																		{
																					$data['success'] =  False;
																					$data['error'] = $this->upload->display_errors(); 
																		}
																		else
																		{
																				$upload_data = $this->upload->data();
																				$test['test_id'] = $test_id;
																				$test['sub_request_id'] = $sub_request_id;
																				$test['image'] =$upload_data['file_name'];
																				$this->api_model->request_test_ins($test);
																				$data['success'] =  TRUE;
																				$data['data'][] = $upload_data['file_name'];
																		}
																	}
															
																}	
											}else{
														if($path == 'blood'){
																			$config = array();
																				$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
																				$config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG|mov|mpeg|mp3|avi|mp4|pdf';
																				$config['max_size']      = '20000';
																				$config['overwrite']     = FALSE;
																				$config['file_name'] =time().$_FILES['userfile']['name'];
																														//$config['file_name'] =  time() . ".";										
																				$this->load->library('upload');
																				foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
																				{
																					if (!empty($fileObject['name']))
																					{
																						$this->upload->initialize($config);
																						if (!$this->upload->do_upload($fieldname))
																						{
																									$data['success'] =  False;
																									$data['error'] = $this->upload->display_errors(); 
																						}
																						else
																						{
																								$upload_data = $this->upload->data();
																								$test['blod_test'] = $upload_data['file_name'];
																								$this->api_model->request_supertest_ins($treat_id, $test);
																								$data['success'] =  TRUE;
																								$data['data'][] = $upload_data['file_name'];
																						}
																					}
																				}
														}else{
																$config = array();
																$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
																$config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG|mov|mpeg|mp3|avi|mp4|pdf';
																$config['max_size']      = '20000';
																$config['overwrite']     = FALSE;
																$config['file_name'] =time().$_FILES['userfile']['name'];
																										//$config['file_name'] =  time() . ".";										
																$this->load->library('upload');
																foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
																{
																	if (!empty($fileObject['name']))
																	{
																		$this->upload->initialize($config);
																		if (!$this->upload->do_upload($fieldname))
																		{
																					$data['success'] =  False;
																					$data['error'] = $this->upload->display_errors(); 
																		}
																		else
																		{
																				$upload_data = $this->upload->data();
																				$data['success'] =  TRUE;
																				$data['data'][] = $upload_data['file_name'];
																		}
																	}
																}
														}
											}										
			}
			else{
				 $data['success'] =  False;
				  $data['error'][] = "File is required";
			}
			 }
			 else{
				  $data['success'] =  False;
	
			 }
			 header('Content-Type: application/json');
			 echo json_encode($data);
			 exit;
	  }
	  
	   
		public function update_fcm()
			
		{
		
		$json_data = array();
		$users_id = $this->input->get_post('users_id');
		$fcm = $this->input->get_post('fcm');
		//android , ios
		$status = $this->input->get_post('status');
	
		if(!isset($users_id) || $users_id == '')
		{
		   	$json_data['error'] = "Users id is required";
		}
		
		if (!isset($fcm) || $fcm == '') {
          $json_data['error'] =  "FCM is required";
        }
		
		if (!isset($status) || $status == '' || ($status != 'android' && $status != 'ios')) {
          $json_data['error'] =  "Please send android or ios ";
        }
		
		if(!$json_data)
		{
			if($status =='android')
			{
				 $data = [
                        'fcm_android'              =>  $fcm
                    ];
			}
			elseif($status =='ios')
			{
				 $data = [
                        'fcm_ios'              =>  $fcm
                    ];
				
			}
					
			$this->api_model->update_fcm($users_id,$data);
			$json_data['success'] = TRUE;
			$json_data['data']['msg'] = $status." Fcm Updated Succesfully";
		
		}
		else
		{
			$json_data['success'] = FALSE;
			
		}
		header('Content-Type:application/json');
		echo json_encode($json_data);
		exit;
		
	}
	
	public function update_para_fcm()	
	{
		$json_data = array();
		$users_id = $this->input->get_post('doctor_id');
		$fcm = $this->input->get_post('fcm');
		$status = $this->input->get_post('status');
		if(!isset($users_id) || $users_id == '')
		{
		   	$json_data['error'] = "Users id is required";
		}
		if (!isset($fcm) || $fcm == '') {
          $json_data['error'] =  "FCM is required";
    }
		if (!isset($status) || $status == '' || ($status != 'android' && $status != 'ios')) {
          $json_data['error'] =  "Please send android or ios ";
    }
		if(!$json_data)
		{
			if($status =='android')
			{
				 $data = [
                        'fcm_android'              =>  $fcm
                    ];
			}
			elseif($status =='ios')
			{
				 $data = [
                        'fcm_ios'              =>  $fcm
                    ];
				
			}
					
			$this->api_model->update_para_fcm($users_id,$data);
			$json_data['success'] = TRUE;
			$json_data['data']['msg'] = $status." Fcm Updated Succesfully";
		
		}
		else
		{
			$json_data['success'] = FALSE;
			
		}
		header('Content-Type:application/json');
		echo json_encode($json_data);
		exit;
		
	}
	public function register_vt(){
		$data['users_type'] = $this->input->get_post('users_type');
		$data['username'] = $this->input->get_post('username');
		$data['email'] = $this->input->get_post('email');
		$data['mobile'] = $this->input->get_post('mobile');
		$data['ai_visiting_fee'] = $this->input->get_post('ai_visitation_charge');
		$specialisation_list = json_decode($this->input->get_post('specialisation_list'));
		$data['specialisation_list'] = implode(',', $specialisation_list);
		$data['mobile_code'] = $this->input->get_post('mobile_code');
		$data['mobile_2nd'] = $this->input->get_post('mobile_2nd');
		$data['password']  = md5($this->input->get_post('password'));
		$data['fullname'] = $this->input->get_post('fullname');
		$data['father_name'] = $this->input->get_post('father_name');
		$data['image'] = $this->input->get_post('image');
		$data['latitude'] = $this->input->get_post('latitude');
		$data['longitude'] = $this->input->get_post('longitude');
		$data['aadhar_no'] = $this->input->get_post('aadhar_no');
		$data['adhaar_img'] = $this->input->get_post('addhar');
		$data['city'] = $this->input->get_post('city');
		$data['state'] = $this->input->get_post('state');
		$data['date'] = date('Y-m-d h:i:s');
		$data['address_full'] = $this->input->get_post('address_full');
		$num_str = sprintf("%08d", mt_rand(1, 99999999));
		$data['refral_code'] = $num_str;
		$data['total_experience'] =$this->input->get_post('experience');
		$expertise_list = $this->input->get_post('expertise_list');
		$expertise_list = json_decode($expertise_list);
		$expertise_list = implode(',',$expertise_list);
		$data['expertise_list'] = $expertise_list;
		$mobilecheck = $this->api_model->docmobileadhaarcheck($data['mobile'], $data['mobile_code']); 
		$adhaarcheck = $this->api_model->docadhaarcheck($data['aadhar_no']);
		$emailcheck = $this->api_model->docemailcheck($data['email']);
		if($mobilecheck) {
				$json_data['success'] = false;
				$json_data['error'] = "Mobile No already associated with another account.";
		}
		else if($adhaarcheck) {
				$json_data['success'] = false;
				$json_data['error'] = "Adhaar already associated with another account.";
		}
		else if($emailcheck) {
				$json_data['success'] = false;
				$json_data['error'] = "Email is already associated with another account.";
		}
		else if($last_id = $this->api_model->ins_doc($data)){
				$ref_name['doc_id'] = $last_id;	
				$ref_name['name'] = $this->input->get_post('ref_name_1');
				$ref_name['fname'] = $this->input->get_post('ref_father_name_1');
				$ref_name['address'] = $this->input->get_post('ref_address_1');
				$ref_name['phone_no'] = $this->input->get_post('ref_mob_1');
				$this->api_model->ins_ref($ref_name);
				$r_ref_name['doc_id'] = $last_id;
				$r_ref_name['name'] = $this->input->get_post('ref_name_2');
				$r_ref_name['fname'] = $this->input->get_post('ref_father_name_2');
				$r_ref_name['address'] = $this->input->get_post('ref_address_2');
				$r_ref_name['phone_no'] = $this->input->get_post('ref_mob_2');
				$this->api_model->ins_ref($r_ref_name);
				$pic['doc_id'] = $last_id;
				$pic['degree_name'] = '10th';
				$pic['image'] = $this->input->get_post('10th_pic');
				$this->api_model->ins_pic($pic);
				$pic['doc_id'] = $last_id;
				$pic['degree_name'] = '10th+2';
				$pic['image'] = $this->input->get_post('10_plus_2');
				$this->api_model->ins_pic($pic);
				$pic['doc_id'] = $last_id;
				$pic['degree_name'] = 'diploma';
				$pic['image'] = $this->input->get_post('diploma');
				$this->api_model->ins_pic($pic);
				$pic['doc_id'] = $last_id;
				$pic['degree_name'] = 'addhar';
				$pic['image'] = $this->input->get_post('addhar');
				$this->api_model->ins_pic($pic);
				$last_data = $this->api_model->get_doc_id_det($last_id);
				$last_data['expertise_list'] = [];
				$last_data['image'] = base_url().'uploads/doc/'.$last_data['image'];
				$json_data['success'] = TRUE;
				$json_data['msg'] = "Your profile has been submited successfully";
				$json_data['data'][] = $last_data;
		}else{
			$json_data['success'] = FALSE;
			$json_data['error'] = "There is problem with data base";
		}
		header('Content-Type:application/json');
		echo json_encode($json_data);
		exit;
	}   

	public function update_doc_ai_charges(){
		$doc_id = $this->input->get_post('doc_id');
		$data['ai_visiting_fee'] = $this->input->get_post('price');
		$detail = $this->api_model->update_doc_ai_charges($doc_id, $data);
		if($detail){
			$json_data['success'] = TRUE;
			$json_data['data']['price'] = $this->input->get_post('price');;
		}else{
			$json_data['success'] = FALSE;
			$json_data['error'] = "There is problem with data base";
		}
		header('Content-Type:application/json');
		echo json_encode($json_data);
		exit;
	}
	public function get_vt_by_latlong(){
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');
		if(!isset($latitude) || $latitude == '')
		{
				$json['success'] = False;
		   	$json['error'] = "Latitude is required";
		}
		else if(!isset($longitude) || $longitude == '')
		{
				$json['success'] = False;
		   	$json['error'] = "Longitude is required";
		}else{
				$data = $this->api_model->get_vt_by_latlong($latitude, $longitude);
				$dem = [];
				foreach($data as $d){
					$d['image'] = isset($d['image']) ? base_url()."uploads/category/user_icon.png" : '';
					$dem[] = $d;
				}
				$json['success'] = True;
		   	$json['data'] = $dem;
		}
		echo json_encode($json);
	}
	
	//Api for admin_details for video.................
	public function get_user_video_block_by_video_id(){
		$video_id = $this->input->get_post('video_id');
		if(!isset($video_id) || $video_id == ''){
			$json['success'] = False;
		   	$json['error'] = "video_id is required";
		}else{
			$data = $this->Admin_detail->get_user_video_block_by_id($video_id);
			$dem = [];
			foreach($data as $d){
				$d['video_thumb'] = isset($d['video_thumb']) ? base_url()."uploads/videos/images/".$d['video_thumb'] : '';
				$dem[] = $d;
			}
			$json['success'] = True;
		   	$json['data'] = $dem;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_user_video_block(){
		$user_id = $this->input->get_post('user_id');
		if(!isset($user_id) || $user_id == ''){
			$json['success'] = False;
		   	$json['error'] = "video_id is required";
		}else{
			$data = $this->Admin_detail->get_user_video_block($user_id);
			$dem = [];
			foreach($data as $d){
				$d['video_thumb'] = isset($d['video_thumb']) ? base_url()."uploads/videos/images/".$d['video_thumb'] : '';
				$dem[] = $d;
			}
			$json['success'] = True;
		   	$json['data'] = $dem;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_video_block_by_video_id_user_id(){
		$video_id = $this->input->get_post('video_id');
		$user_id = $this->input->get_post('user_id');
		if(!isset($video_id) || $video_id == '')
		{
			$json['success'] = False;
		   	$json['error'] = "video_id is required";
		}
		else if(!isset($user_id) || $user_id == '')
		{
			$json['success'] = False;
		   	$json['error'] = "user_id is required";
		}else{
			$data = $this->Admin_detail->get_user_video_block_by_video_id($video_id, $user_id);
			$dem = [];
			foreach($data as $d){
				$d['video_thumb'] = isset($d['video_thumb']) ? base_url()."uploads/videos/images/".$d['video_thumb'] : '';
				$dem[] = $d;
			}
			$json['success'] = True;
		   	$json['data'] = $dem;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}

	public function get_last_five_video_block(){
		$data = $this->Admin_detail->get_last_five_video_block();
		$dem = [];
		foreach($data as $d){
			$d['video_thumb'] = isset($d['video_thumb']) ? base_url()."uploads/videos/images/".$d['video_thumb'] : '';
			$dem[] = $d;
		}
		$json['success'] = True;
	   	$json['data'] = $dem;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	

	public function pushcalllog(){
		$call_date = $this->input->get_post('call_date');
		$call_time = $this->input->get_post('call_time');
		$call_direction = $this->input->get_post('call_direction');
		$customer_number = $this->input->get_post('customer_number');
		$call_duration = $this->input->get_post('call_duration');
		$call_uuid = $this->input->get_post('call_uuid');
		$call_status = $this->input->get_post('call_status');

		$called_number = $this->input->get_post('called_number');
		$call_transfer_duration = $this->input->get_post('call_transfer_duration');
		$call_transfer_status = $this->input->get_post('call_transfer_status');
		$agent_list = $this->input->get_post('agent_list');
		$agent_number = $this->input->get_post('agent_number');
		$menu = $this->input->get_post('menu');
		$client_variable_1 = $this->input->get_post('client_variable_1');
		$client_variable_2 = $this->input->get_post('client_variable_2');
		$client_variable_3 = $this->input->get_post('client_variable_3');
	
		if(!isset($call_date) || $call_date == '' 
			&& !isset($call_time) || $call_time == '' 
			&& !isset($call_direction) || $call_direction == ''
			&& !isset($customer_number) || $customer_number == ''
			&& !isset($call_duration) || $call_duration == ''
			&& !isset($call_uuid) || $call_uuid == ''
			&& !isset($call_status) || $call_status == ''
		)
		{
			$json['success'] = False;
		   	$json['error'] = "information is required";
		}else{
			$dem = [];
			$dem['call_date'] = $call_date;
			$dem['call_time'] = $call_time;
			$dem['call_direction'] = $call_direction;
			$dem['customer_number'] = $customer_number;
			$dem['call_duration'] = $call_duration;
			$dem['call_uuid'] = $call_uuid;
			$dem['call_status'] = $call_status;

			/*
			$dem['called_number'] = $called_number;
			$dem['call_transfer_duration'] = $call_transfer_duration;
			$dem['call_transfer_status'] = $call_transfer_status;
			$dem['agent_list'] = $agent_list;
			$dem['agent_number'] = $agent_number;
			$dem['menu'] = $menu;
			$dem['client_variable_1'] = $client_variable_1;
			$dem['client_variable_2'] = $client_variable_2;
			$dem['client_variable_3'] = $client_variable_3;
			
			$dem['opt-in1'] = base_url()."uploads/logpush/Opt-in-1.png";
			$dem['opt-in2'] = base_url()."uploads/logpush/Opt-in-2.png";
			$dem['opt-in3'] = base_url()."uploads/logpush/Opt-in3.jpeg";
			$dem['sample_optin'] = base_url()."uploads/logpush/Sample_optin.png";
			$dem['sample_optin1'] = base_url()."uploads/logpush/sample_optin1.jpeg";
			*/
			$json['success'] = True;
			$json['data'] = $dem;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
}
