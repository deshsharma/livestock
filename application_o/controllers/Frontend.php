<?php
class Frontend extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('front_end_model');
        $this->load->model('api_model');
        $this->load->model('Admin_detail');
    }
    public function test(){
        $base = "testing";
        $encoded = base64_encode(utf8_encode($base));
        $decoded = utf8_decode(base64_decode($encoded));
        echo ($decoded === $base) . "\n";
        echo $encoded;
    }
    public function buyer_seller_point($id){
        $data['id'] = $id;
        $this->load->view('buyer_point', $data);
    }
    public function get_city(){
        $state_id = $this->input->get_post('state_id');
        if(!isset($state_id) || $state_id == ''){
            echo "Please send state id";
        }else{
            $data = $this->front_end_model->get_city($state_id);
        }
        // print_r($data);
        // exit;
		header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
     public function language(){
        $_SESSION['language'] = $this->input->get_post('lang');
        echo true;
    }
     function send_push_none(){
        $id = $this->input->get_post('id');
        $type = $this->input->get_post('type');
        $title = $this->input->get_post('title');
        $flag = $this->input->get_post('flag');
        $msg = $this->input->get_post('msg');
        $this->simple_push_none($id, $type , $title, $flag, $msg);
    }
     public function simple_push_none($user_id, $type , $title, $flag = 0, $msg){
        if($type == 1){
            $detail = $this->api_model->get_fcm_doc($user_id);
            $server_key = PARAVATE_SERVERKEY;
        }else if($type == 2){
            $detail = $this->api_model->get_fcm_user($user_id);
            $server_key = LIVESTOCK_AND_SERVERKEY;
        }else if($type == 3){
            $detail = $this->api_model->get_fcm_admin($user_id);
            $server_key = DEALER_APP_SERVERKEY;
            $detail[0]['fcm_android'] = $detail[0]['fcm_and'];
            $detail[0]['fcm_ios'] = $detail[0]['fcm_IOS'];
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
                                                $result = curl_exec($curl_session);
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
        //return $result;
    }
    public function reset_pass($id){
        if(isset($_POST['submit'])){
        	$pass = $this->input->get_post('password');
        	$confirm = $this->input->get_post('cpassword');
        	$this->form_validation->set_rules('password','Please Fill Password','required|numeric');
        	$this->form_validation->set_rules('cpassword','Please Fill Confirm Password','required|numeric');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
	        	if($pass == $confirm){
	        		$data_ins['passcode'] = md5($pass);
	        		$id = $this->input->get_post('id');
	        		$this->api_model->update('users_id', $id, 'users', $data_ins);
	        		$this->session->set_flashdata('add_bank','Your Password Change You can Login');
	        		$data['id'] = $this->input->get_post('id');
		        	$this->load->view('front_end/product/header');
		        	$this->load->view('front_end/product/resetpass', $data);
	        		return redirect(base_url('frontend/login'));
	        	}else{
	        		$this->session->set_flashdata('add_bank','Confirm Password and Password should be same');
	        		$data['id'] = $this->input->get_post('id');
		        	$this->load->view('front_end/product/header');
		        	$this->load->view('front_end/product/resetpass', $data);
	        	}
	        }else{
	        	$data['id'] = $this->input->get_post('id');
		        $this->load->view('front_end/product/header');
		        $this->load->view('front_end/product/resetpass', $data);
	        }
        }else{
        	$data['id'] = $id;
        	$this->load->view('front_end/product/header');
        	$this->load->view('front_end/product/resetpass', $data);	
        }
    }
    public function  my_account(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/my_account');
    }
    public function  resend(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/resend');
    }
    public function  otp(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/otp');
    }
    public function  my_order(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/my_order');
    }
    public function all_review($id){
        $data['data'] = $this->front_end_model->get_product_id($id);
       $this->load->view('front_end/product/header');
       $this->load->view('front_end/product/allreview',$data);
    }
    public function get_premium_detail(){
        $data = $this->front_end_model->premium_type();
        $detail = [];
        foreach($data as $d){
            $d['benefits'] = $this->front_end_model->get_benefits($d['id']);
            $detail[] = $d;
        }
        $json['success'] = True;
        $json['data'] = $detail;
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function add_subscriber(){
        $data['email'] = $this->input->get_post('email');
        if($this->api_model->get_data('email ="'.$data['email'].'"', 'product_subscribe')){
            $error['msg'] = 'You are already subscribed';
        }else{
            if($this->api_model->submit('product_subscribe', $data)){
                $error['msg'] = 'You are subscribed';
            }else{
                echo "this is test";
            }
        }
        echo json_encode($error);
    } 
    public function semen_bull_listing(){
        $this->load->view('semen_bull_listing');
    }
    public function payment_success(){
        $this->load->view('registration_done');
    }
    public function get_user_by_ref(){
        $ref = $this->input->get_post('ref');
        $data = $this->front_end_model->get_user_by_ref_code($ref);
        echo json_encode($data);
    }
    public function get_refral_doc(){
        $users_id = $this->input->get_post('users_id');
        if(!isset($users_id) || $users_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send users id";
        }else{
            if($data = $this->front_end_model->check_refral_code($users_id)){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.livestoc.com/harpahu_merge_dev/animal/check_ref?ref=".$data[0]['doc_referal_by']."",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "postman-token: a8cfa165-6d9f-4bcb-c43a-1f69520cbf2c"
                ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $res = json_decode($response);
                if($res->success){
                    $data_w['name'] = $res->data->username;
                    $data_w['mobile'] = $res->data->mobile;
                    $data_w['mobile2'] = $res->data->mobile_2nd;
                    $data_w['refral_code'] = $res->data->refral_code;
                    $url = 'https://www.livestoc.com/harpahu_dhyan/uploads/doc/'.$res->data->image;
                    $h = get_headers($url);
                    $status = array();
                    preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
                    if($status[1]==200){
                        $data_w['image'] = $url;
                    }else{
                        $data_w['image'] = 'https://www.livestoc.com/harpahu_dhyan/uploads/image/profile.jpg';
                    }
                    $json['success'] = true;
                    $json['data'] =  $data_w;
                    //$json['msg'] =  "Your Service provider has been successfully assoiciated with your Account";
                }else{
                    $json['success'] = False;
                    $json['error'] = "There is no service provider associated with your Account";
                }
            }else{
                $json['success'] = False;
                $json['error'] = "There is no service provider associated with your Account";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function cheak_refral_code(){
        $users_id = $this->input->get_post('users_id');
        $refral_id = $this->input->get_post('refral_id');
        if(!isset($users_id) || $users_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send users id";
        }else if(!isset($refral_id) || $refral_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send refral id";
        }else{
            if($data = $this->front_end_model->check_refral_code($users_id, $refral_id)){
                    $json['success'] = False;
                    $json['error'] = "The Service Provider is already attached with you";
            }else{
                $data_ref = $this->front_end_model->check_refral_code($users_id);
                if($data_ref[0]['doc_referal_by'] == 0 || $data_ref[0]['doc_referal_by'] == ''){
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://www.livestoc.com/harpahu_merge_dev/animal/check_ref?ref=".$refral_id."",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "postman-token: a8cfa165-6d9f-4bcb-c43a-1f69520cbf2c"
                    ),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $res = json_decode($response);
                    if($res->success){
                        $ref_data['doc_referal_by'] = $refral_id;
                        $this->front_end_model->update_referal_code($ref_data, $users_id);
                        $data['name'] = $res->data->username;
                        $data['mobile'] = $res->data->mobile;
                        $data['mobile2'] = $res->data->mobile_2nd;
                        $url = 'https://www.livestoc.com/harpahu_dhyan/uploads/doc/'.$res->data->image;
                        $h = get_headers($url);
                        $status = array();
                        preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
                        if($status[1]==200){
                            $data['image'] = $url;
                        }else{
                            $data['image'] = '';
                        }
                        $json['success'] = true;
                        $json['data'] =  $data;
                        $json['msg'] =  "Your Service provider has been successfully assoiciated with your Account";
                    }else{
                        $json['success'] = False;
                        $json['error'] = "Your referral code is not matched";
                    }
                }else{
                    $json['success'] = true;
                    $json['msg'] =  "Your request for updating Service Provider has been submited successfuly. After approval, it will be updated into your account.";
                }               
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    } 
    public function cart_sess(){
        $data['product_id'] = $this->input->get_post('product_id');
        $data['users_id'] = $this->input->get_post('users_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['pack_id'] = $this->input->get_post('pack_id');
        $data['pack_price'] = $this->input->get_post('pack_price');
        $data['qty'] = $this->input->get_post('qty');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($product_data = $this->front_end_model->get_data('product_cart', 'product_id = "'.$data['product_id'].'" AND users_id = "'.$data['users_id'].'" AND user_type = "'.$data['user_type'].'"')){
            if($product_data[0]['qty'] != $data['qty']){
                $update['qty'] = $data['qty'];
                if($this->api_model->update('id', $product_data[0]['id'], 'product_cart', $update)){
                    $error['msg'] = 'Added to Cart list';
                }
            }else{
                $error['msg'] = "Already in Cart list";
            }
        }else{
            $count = $this->api_model->get_data('users_id = "'.$data['users_id'].'" AND user_type = "'.$data['user_type'].'"', 'product_cart', '', 'count(id) as count');
            if($count[0]['count'] < '1'){
                if($this->front_end_model->submit_data('product_cart', $data)){
                    $error['msg'] = "Added to Cart list";
                    $error['flag'] = '1';
                }else{
                    $error['msg'] = "database problem";
                }
            }else{
                $error['msg'] = "Only one item can be added to cart at a time";
            }
        }
        echo json_encode($error);
    }
    public function webhook(){
        $last_id = $this->input->get_post('last_id');
        $data['payment_status'] = '1';
        $this->front_end_model->register_data_update($data, $last_id);
    }
    public function animal_premium_status(){
        $purchase_id = $this->input->get_post('purchase_id');
        $users_id = $this->input->get_post('bank_id');
        $bull_id = $this->input->get_post('bull_id');
        $bull_price = $this->input->get_post('bull_price');
        $type = $this->input->get_post('type');
        $bull_id = json_decode($bull_id);
        $bull_price = json_decode($bull_price);
        $i = 0;
        foreach($bull_id as $bull){
            $data['ispremium'] = '1';
            $this->front_end_model->update_animal($data, $bull);
            $i++;
        }
    }
	public function get_product_category(){
		$data = $this->front_end_model->get_product_category();
		$json['success']  = true; 
		$json['data'] = $data;
		header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
	public function get_listing_data(){
		$id = $this->input->get_post('cat_id');
		$type = $this->input->get_post('type');
		$data = $this->front_end_model->get_listing_data_cat($id, $type);
		$detail = [];
		$im_data = [];
		foreach($data as $da){
			$image = explode(',',$da['images']);
			foreach($image as $im){
				$im_data[] = base_url()."uploads/register/".$im;
			}
			$da['images'] = $im_data;
			$detail[] = $da; 
		}
		if($data){
			$json['success']  = true; 
			$json['data'] = $detail;
		}else{
			$json['success']  = false; 
			$json['error'] = "No data found";
		}
		header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
    public function register(){
        if(isset($_POST['sub'])){
            //print_r($_POST);
            $data['choice'] = $this->input->get_post('choice');
            $data['name'] = $this->input->get_post('name');
            $data['address1'] = $this->input->get_post('address1');
            $data['address2'] = $this->input->get_post('address2');
            $data['address3'] = $this->input->get_post('address3');
            $data['city'] = $this->input->get_post('city');
            $data['State'] = $this->input->get_post('state');
            $data['pin'] = $this->input->get_post('pin');
            $data['mobile'] = $this->input->get_post('mobilr');
            $data['mobile2'] = $this->input->get_post('mobilr1');
            $data['category'] = $this->input->get_post('cat');
            $data['section'] = implode(',',$this->input->get_post('section'));
            $data['land_line'] = $this->input->get_post('land_line');
            $data['land_line2'] = $this->input->get_post('land_line1');
            $data['contact_person'] = $this->input->get_post('contact_person');
            $data['email'] = $this->input->get_post('email');
            $data['email2'] = $this->input->get_post('email2');
			$data['discription'] = $this->input->get_post('desc');
            $data['product'] = implode(',',$this->input->get_post('product'));
            $data['brand'] = implode(',',$this->input->get_post('brand'));
            $data['services_in'] = implode(',',$this->input->get_post('s'));
            $data['user_type'] = $this->input->get_post('user_type');
            $data['date'] = date('Y-m-d h:i:s');
            $this->form_validation->set_rules('choice','Chose Type','required|trim');
            $this->form_validation->set_rules('name','Name filed','required|trim');
            $this->form_validation->set_rules('address1','Address Field','required|trim');
            $this->form_validation->set_rules('pin','Pin Field','required|trim');
            $this->form_validation->set_rules('mobilr','Mobile Field','numeric|required|trim');
            $this->form_validation->set_rules('contact_person','Contact Person Field','required|trim');
            $this->form_validation->set_rules('email','Email Field','required|valid_email|trim');
            if($this->form_validation->run('product_add')){
                if($data['user_type'] == 1){
                    $data['payment_price'] = 12000 + (12000*18/100);
                    //$data['payment_price'] = 1;
                    if($_FILES){
                        $this->load->library('upload');
                            $files = $_FILES;
                            // echo "<pre>";
                            // print_r($files);
                            $cpt = count($_FILES['register']['name']);
                            $name = [];
                            for($i=0; $i<$cpt; $i++){
                                    $_FILES['file']['name']       = $_FILES['register']['name'][$i];
                                    $_FILES['file']['type']       = $_FILES['register']['type'][$i];
                                    $_FILES['file']['tmp_name']   = $_FILES['register']['tmp_name'][$i];
                                    $_FILES['file']['error']      = $_FILES['register']['error'][$i];
                                    $_FILES['file']['size']       = $_FILES['register']['size'][$i]; 
                                    $config = array();
                                    $config['upload_path'] = '/var/www/html/uploads/register';
                                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                                    $config['max_size']      = '5000';
                                    $config['overwrite']     = FALSE;	 
                                    $this->load->library('upload', $config);
                                    $this->upload->initialize($config);
                                    if($this->upload->do_upload('file')){
                                        $imageData = $this->upload->data();
                                        $uploadImgData[] = $imageData['file_name'];
                                    }else{
                                        $do = $this->upload->display_errors();
                                    }
                            }
                            $image_name = implode(',',$uploadImgData);
                            $data['images'] = $image_name;
                            $data1 = $this->front_end_model->ins_registration($data);
                            if($data1){
                                $data['last_id'] = $data1;
                                $this->load->view('register_pay', $data);
                            }else{
                                $this->load->view('register');
                            }
                    }
                }else{
                    $data['payment_price'] = '0';
                    if($_FILES){
                    
                        $this->load->library('upload');
                            $files = $_FILES;
                            // echo "<pre>";
                            // print_r($files);
                            $cpt = count($_FILES['register']['name']);
                            $name = [];
                            for($i=0; $i<$cpt; $i++){
                                    $_FILES['file']['name']       = $_FILES['register']['name'][$i];
                                    $_FILES['file']['type']       = $_FILES['register']['type'][$i];
                                    $_FILES['file']['tmp_name']   = $_FILES['register']['tmp_name'][$i];
                                    $_FILES['file']['error']      = $_FILES['register']['error'][$i];
                                    $_FILES['file']['size']       = $_FILES['register']['size'][$i]; 
                                    $config = array();
                                    $config['upload_path'] = '/var/www/html/uploads/register';
                                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                                    $config['max_size']      = '5000';
                                    $config['overwrite']     = FALSE;	 
                                    $this->load->library('upload', $config);
                                    $this->upload->initialize($config);
                                    if($this->upload->do_upload('file')){
                                        $imageData = $this->upload->data();
                                        $uploadImgData[] = $imageData['file_name'];
                                    }else{
                                        $do = $this->upload->display_errors();
                                    }
                            }
                            $image_name = implode(',',$uploadImgData);
                            $data['images'] = $image_name;
                            $data = $this->front_end_model->ins_registration($data);
                            if($data){
                                $this->load->view('registration_done');
                            }else{
                                $this->load->view('register');
                            }
                    }
                }
            //    if($data){
            //     $this->load->view('registration_done');
            //    }else{
            //     $this->load->view('register');
            //    }
            }else{
                $this->load->view('register');
            }
        }else{
            $this->load->view('register');
        }
    }
    public function  get_product_list(){
        $name = $this->input->get_post('name');
        $color = $this->input->get_post('color');
        $section = $this->input->get_post('section');
        echo $name;
        echo $color;
        echo $section;
    }
    public function product_cat($cat_id, $id, $language){
		$pro_data = $this->api_model->product_cat_id($cat_id);
        //if($pro_data){
    		$i = 0;
    		$div .= '<ul class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(145px, -230px, 0px); top: 0px; left: 0px; will-change: transform;">';
    		foreach($pro_data as $pro){
                $cat_name = $pro['cat_name'];
    				if($i == 0){
    					$div .= '<li class="dropdown-submenu">
                    <a href="'.base_url('frontend/product_listing/').$pro['id'].'/'.$id.'" id="'.$pro['id'].'" onclick="node('.$pro['id'].')" class="level2">'.$language[$cat_name].'</a>';  
                    
    					$div .= $this->product_cat($pro['id']);
    					$div .='</li>';
    				}else{
    					$div .= '<li class="dropdown-submenu"><a class="filter" href="'.base_url('frontend/product_listing/').$pro['id'].'/'.$id.'" id="'.$pro['id'].'" onclick="node('.$pro['id'].')">'.$language[$cat_name].'</a>';
    					$div .= $this->product_cat($pro['id']);
    					$div .= '</li>';
    				}
    			$i++;
    		}
    		$div .= '</ul>';
    		return $div;
        //}	
    }
    public function product_category_show($id, $language){
		$category = $this->api_model->get_category_main($id);
		//$div = "<ul class='dropdown forfilters mb-4 pl-0 list-unstyled'>";
		foreach($category as $cat){
            $cat_name = $cat['cat_name'];
			$div .= '<ul class="dropdown forfilters mb-4 pl-0 list-unstyled"><li class="dropdown-submenu"><a href="'.base_url('frontend/product_listing/').$cat['id'].'/'.$id.'" class="level" d="'.$cat['id'].'" onclick="node('.$cat['id'].')">'.$language[$cat_name].'</a></li><button class="btn btn-default" type="button" data-toggle="dropdown" aria-expanded="true"><i class="ion-ios-arrow-down"></i></button>';
				$data = $this->product_cat($cat['id'], $id, $language);
				$div .= $data;
			$div .= '</ul>';
		}
		//$div .= "</ul>";
		return $div;
	}
    public function product_listing($cat_id, $id){

       $data['sec_id'] = $id;
       if($cat_id == ''){
        $cat_id = 0;
       }
       // print_r($cat_id);
       // print_r($data);
       $data['cat'] = $cat_id;
       $data['data_pro'] = $this->front_end_model->get_produc_with_price($id, $cat_id, '1');
       $data['data'] = $this->front_end_model->get_produc_with_price($id, $cat_id, '0'); 
       $this->load->library('language_left');
       $lang = $this->language_left->get_language('hi');
       $data['category'] = $this->product_category_show($id, $lang);
       //print_r($data);
       $this->load->view('front_end/product/header');
       $this->load->view('front_end/product/allproduct',$data);
   }
   public function product_view($id, $cat_id){
       $data['data'] = $this->front_end_model->get_product_id($id);
       $this->load->view('front_end/product/header');
       $this->load->view('front_end/product/product_single',$data);
   }
   public function product_cart(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/cart2');
    }

    public function product_checkout(){
        // print_r($_REQUEST);
        //     exit;
        if(isset($_POST['submit'])){

            $purchase_id = $this->input->get_post('shopping_order_id');
           // $row = $this->api_model->get_data('id = "'.$purchase_id.'"', 'log_file');
            $update['payment_type'] = 'Dr';
            $update['status'] = '2';
            $update['transaction_id'] = $purchase_id;  
            $this->api_model->update('id', $purchase_id, 'log_file', $update);
            $wallet = $this->input->get_post('wall');
            $product_id = $this->input->get_post('product_id');
            $product_id = explode(',',$product_id);
            $package_id = $this->input->get_post('package_id');
            $package_id = explode(',',$package_id);
            $package_price = $this->input->get_post('package_price');
            $package_price = explode(',',$package_price);
            $user_type = $this->session->userdata("type");
            $users_id = $this->session->userdata("users_id");
            $product_qty = $this->input->get_post('product_qty');
            $product_qty = explode(',',$product_qty);
            $date = date('Y-m-d h:i:s');
            $i = 0;
            if($wallet > 0){
                $wall['log_id'] = $purchase_id;
                $wall['users_id'] = $users_id;
                $wall['type'] = '14';
                $wall['amount'] = $wallet;
                $wall['status'] = 'Dr';
                $wall['wallet_type'] = '1';
                $wall['date'] = $date;
                $this->api_model->submit('livestoc_wallets', $wall);
            }
            foreach($product_id as $pur){
                $pri_row = $this->api_model->get_data('id = "'.$package_price[$i].'"', 'product_pack_rate');
                if($user_type == 0){
                    $price = $pri_row[0]['sale_price'];
                }
                else{
                    $price = $pri_row[0]['vt_sale_price'];
                }
                if($product_offer = $this->api_model->get_data('product_pack = "'.$package_id[$i].'" AND product_id = "'.$pur.'"', 'product_offer')){
                    $wall['log_id'] = $purchase_id;
                    $wall['users_id'] = $users_id;
                    $wall['type'] = '14';
                    $wall['animal_id'] = $pur;
                    $wall['amount'] = $product_offer[0]['discount_wallet'];
                    $wall['status'] = 'Cr';
                    $wall['wallet_type'] = '1';
                    $wall['date'] = $date;
                    $this->api_model->submit('livestoc_wallets', $wall);
                }
                $date = date('Y-m-d h:i:s');
                $order['log_id'] = $purchase_id;
                $order['product_id'] = $pur;
                $order['users_id'] = $users_id;
                $order['package_id'] = $package_id[$i];
                $order['package_price'] = $price;
                $order['user_type'] = $user_type;
                $order['product_qty'] = $product_qty[$i];
                $order['isactive'] = '1';
                $order['update_date'] = $date;
                $order['date'] = $date;
                $this->api_model->submit('product_order', $order);
                $i++;
            }
            redirect(base_url().'frontend/product_thanku');
        }else{
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/checkout');
        }
    }
    public function order_cod(){
        $order_id = $this->input->get_post('order_id');
        if($order_id == ''){
            echo "<script>alert('Please Send Order Id')</script>";
        }else{
            $order_id;
            $data['order_payment_status'] = '0';
            if($this->api_model->update('id', $order_id, 'product_order', $data)){
                $dis = $this->api_model->get_data('id = '.$order_id.'', 'product_order');
                $title = 'Order Payment Mode';
                $msg1 = 'COD Payment mode has been selected for Order ID= #'.$order_id;
                $msg['users_id'] = $dis[0]['distributor_id'];
                $msg['title'] = $title;
                $msg['message'] = $msg1;
                $msg['date'] = date('Y-m-d h:i:s');
                $msg['type'] = '4';
                $msg['isactive'] = '1';
                $msg['flag'] = '4';
                $this->api_model->user_notification($msg);
                $old_msg['to_users_id'] = $dis[0]['distributor_id'];
                $old_msg['to_id'] = $dis[0]['distributor_id'];
                $old_msg['to_type'] = 'Dealer';
                $old_msg['title'] = $title;
                $old_msg['from_type'] = 'Livestoc Team';
                $old_msg['success'] = '1';
                $old_msg['device'] = 'android';
                $old_msg['active'] = '1'; 
                $old_msg['description'] = $msg1;
                $old_msg['date_added'] = date('Y-m-d h:i:s');
                $this->api_model->old_notification($old_msg);
                $this->simple_push_none($dis[0]['distributor_id'], 3 , $title, '1', $msg1);
                $dis = $this->api_model->get_data('id = '.$order_id.'', 'product_order');
                $title = 'Order Payment Mode';
                $msg1 = 'COD Payment mode has been selected for Order ID= #'.$order_id;
                $msg['users_id'] = $dis[0]['delivery_partner'];
                $msg['title'] = $title;
                $msg['message'] = $msg1;
                $msg['date'] = date('Y-m-d h:i:s');
                $msg['type'] = '4';
                $msg['isactive'] = '1';
                $msg['flag'] = '4';
                $this->api_model->user_notification($msg);
                $old_msg['to_users_id'] = $dis[0]['delivery_partner'];
                $old_msg['to_id'] = $dis[0]['delivery_partner'];
                $old_msg['to_type'] = 'Dealer';
                $old_msg['title'] = $title;
                $old_msg['from_type'] = 'Livestoc Team';
                $old_msg['success'] = '1';
                $old_msg['device'] = 'android';
                $old_msg['active'] = '1'; 
                $old_msg['description'] = $msg1;
                $old_msg['date_added'] = date('Y-m-d h:i:s');
                $this->api_model->old_notification($old_msg);
                $this->simple_push_none($dis[0]['delivery_partner'], 3 , $title, '1', $msg1);
                redirect(base_url('frontend/my_order'));
            }else{
                echo "<script>alert('Database Error')</script>";
            }
        }
    }
    public function cash_on_delivery(){
        if(!empty($_POST)){
            // print_r($_REQUEST);
            // exit
            $order_type = '0';
            $purchase_id = $this->input->get_post('shopping_order_id');
           // $row = $this->api_model->get_data('id = "'.$purchase_id.'"', 'log_file');
            $update['payment_type'] = 'Dr';
            $update['status'] = '2';
            $update['transaction_id'] = $purchase_id;  
            $this->api_model->update('id', $purchase_id, 'log_file', $update);
            $wallet = $this->input->get_post('wall');
            $product_id = $this->input->get_post('product_id'); 
            $product_id = explode(',',$product_id);
            $package_id = $this->input->get_post('package_id');
            $package_id = explode(',',$package_id);
            $package_price = $this->input->get_post('package_price');
            $package_price = explode(',',$package_price);
            $user_type = $this->input->get_post('user_type');
            $address_id = $this->input->get_post('address_id');
            $users_id = $this->input->get_post('users_id');
            $product_qty = $this->input->get_post('product_qty');
            $product_qty = explode(',',$product_qty);
            $date = date('Y-m-d h:i:s');
            $i = 0;
            if($wallet > 0){
                $wall['log_id'] = $purchase_id;
                $wall['users_id'] = $users_id;
                $wall['type'] = '14';
                $wall['amount'] = $wallet;
                $wall['status'] = 'Dr';
                $wall['wallet_type'] = '1';
                $wall['date'] = $date;
                $this->api_model->submit('livestoc_wallets', $wall);
            }
             // print_r($_REQUEST);
            // exit
            foreach($product_id as $pur){
                $product = $this->api_model->get_data('id = "'.$pur.'"','product');
                    $dis = '';
                    if($product[0]['livestoc_status'] == '1'){
                        $address = $this->api_model->get_data('address_id = '.$address_id.'', 'address_mst');
                        $admin_data = $this->api_model->get_data(' FIND_IN_SET('.$address[0]['district_id'].', service_district) AND (type = 32 or type = 33)', 'admin');
                        // print_r($admin_data);
                        // exit;
                        $k = 0;
                        $y = 0;
                        $dist = 0;
                        $dist1 = 0;
                        foreach($admin_data as $ad){
                            if($ad['type'] = '32'){
                                if($k == '0'){
                                    $dist1 = $ad['admin_id'];
                                }else{
                                    $dist1 .= ','. $ad['admin_id'];
                                }
                                $k++;
                            }
                            // if($ad['type'] = '33'){
                            //     if($y == '0'){
                            //         $dist1 = $ad['admin_id'];
                            //     }else{
                            //         $dist1 = '1'.$ad['admin_id'];
                            //     }
                            //     $y++;
                            // }
                            $title = 'New Order';
                            $msg1 = 'you have new order.Please check the App.';
                            $msg['users_id'] = $ad['admin_id'];
                            $msg['title'] = $title;
                            $msg['message'] = $msg1;
                            $msg['date'] = date('Y-m-d h:i:s');
                            $msg['type'] = '4';
                            $msg['isactive'] = '1';
                            $msg['flag'] = '4';
                            $this->api_model->user_notification($msg);
                            $old_msg['to_users_id'] = $ad['admin_id'];
                            $old_msg['to_id'] = $ad['admin_id'];
                            $old_msg['to_type'] = 'Dealer';
                            $old_msg['title'] = $title;
                            $old_msg['from_type'] = 'Livestoc Team';
                            $old_msg['success'] = '1';
                            $old_msg['device'] = 'android';
                            $old_msg['active'] = '1'; 
                            $old_msg['description'] = $msg1;
                            $old_msg['date_added'] = date('Y-m-d h:i:s');
                            $this->api_model->old_notification($old_msg);
                            $this->simple_push_none($ad['admin_id'], 3 , $title, '1', $msg1);
                        }
                        //$transporter_level1 = $this->api_model->query_build('select');
                    }else{
                        if($product[0]['hub'] == '0'){
                            $distributer = $this->api_model->query_build('SELECT `admin_id`, IFNULL(( 3959 * acos( cos( radians('.round($_REQUEST['latitude'], 4).') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('.round($_REQUEST['langitude'], 4).') ) + sin( radians('.round($_REQUEST['latitude'], 4).') ) * sin( radians( latitude ) ) ) ), 0) AS distance FROM `admin` WHERE `super_admin_id` = '.$product[0]['user'].' having distance < 10');
                            //$distributer = $this->api_model->get_data("super_admin_id = ".$product[0]['user']." HAVING distance < 10", 'admin','','admin_id, IFNULL(( 3959 * acos( cos( radians('.round($_REQUEST['latitude'], 4).') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('.round($_REQUEST['langitude'], 7).') ) + sin( radians('.round($_REQUEST['latitude'],4).') ) * sin( radians( latitude ) ) ) ),0) AS distance');
                            $i = 0;
                            foreach($distributer as $dist){
                                if($i == 0){
                                    $dis = $dist['admin_id'];
                                }else{
                                    $dis .= ','.$dist['admin_id'];
                                }
                                $i++;
                            }
                            $title = 'New Order';
                            $msg1 = 'you have new order.Please check the App.';
                            $msg['users_id'] = $users_id;
                            $msg['title'] = $title;
                            $msg['message'] = $msg1;
                            $msg['date'] = date('Y-m-d h:i:s');
                            $msg['type'] = '4';
                            $msg['isactive'] = '1';
                            $msg['flag'] = '4';
                            $this->api_model->user_notification($msg);
                            $old_msg['to_users_id'] = $dist['admin_id'];
                            $old_msg['to_id'] = $dist['admin_id'];
                            $old_msg['to_type'] = 'Dealer';
                            $old_msg['title'] = $title;
                            $old_msg['from_type'] = 'Livestoc Team';
                            $old_msg['success'] = '1';
                            $old_msg['device'] = 'android';
                            $old_msg['active'] = '1'; 
                            $old_msg['description'] = $msg1;
                            $old_msg['date_added'] = date('Y-m-d h:i:s');
                            $this->api_model->old_notification($old_msg);
                            $this->simple_push_none($dist['admin_id'], 3 , $title, '1', $msg1);
                        }
                    }
                $pri_row = $this->api_model->get_data('id = "'.$package_price[$i].'"', 'product_pack_rate');
                if($user_type == 0){
                    $price = $pri_row[0]['sale_price'];
                }
                else{
                    $price = $pri_row[0]['vt_sale_price'];
                }
                if($product_offer = $this->api_model->get_data('product_pack = "'.$package_id[$i].'" AND product_id = "'.$pur.'"', 'product_offer')){
                    $wall['log_id'] = $purchase_id;
                    $wall['users_id'] = $users_id;
                    $wall['type'] = '14';
                    $wall['animal_id'] = $pur;
                    $wall['amount'] = $product_offer[0]['discount_wallet'];
                    $wall['status'] = 'Cr';
                    $wall['wallet_type'] = '1';
                    $wall['date'] = $date;
                    $this->api_model->submit('livestoc_wallets', $wall);
                }
                $date = date('Y-m-d h:i:s');
                $order['log_id'] = $purchase_id;
                $order['product_id'] = $pur;
                $order['distributor_id'] = $dis;
                $order['delivery_partner'] = $dist1;
                $order['address_id'] = $address_id;
                $order['delivery_partner_level2'] = '0';
                $order['users_id'] = $users_id;
                $order['package_id'] = $package_id[$i];
                $tax =$this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage'); 
                $price += $price * ($tax[0]['tax_percentage']/100);
                $order['package_price'] = $price;
                $order['user_type'] = $user_type;
                $order['otp'] = rand(1000,9999);
                $order['latitude'] = $_REQUEST['latitude'];
                $order['longitude'] = $_REQUEST['langitude'];
                $order['product_qty'] = $product_qty[$i];
                $order['isactive'] = '0';
                $order['update_date'] = $date;
                $order['order_type'] = $order_type;
                $order['date'] = $date;
                $this->api_model->submit('product_order', $order);
                if($dis != ''){
                    $msg1 = 'you have new order.Please check the App';
                    $flag ='2';
                    $msg['users_id'] = $dis;
                    $msg['title'] = 'you have new order.Please check the App';
                    $msg['message'] = $msg1;
                    $msg['date'] = date('Y-m-d h:i:s');
                    $msg['type'] = '2';
                    $msg['isactive'] = '1';
                    $msg['flag'] = '2';
                    $msg['doctor_id'] = $dis;
                    // print_r($msg);
                    // exit;
                    $this->api_model->user_notification($msg);
                    $this->oder_push_non($user_id,$doctor_id,  2, $title , $flag, DEALER_APP_SERVERKEY, DEALER_IOS_SERVERKEY, $msg1);
                }
                $i++;
               
            }
            redirect(base_url().'frontend/product_thanku');
        }
    }
    
    public function oder_push_non($user_id,$doctor_id, $type , $title, $flag = 0, $server_key = 0, $key=0, $msg, $fcm_and= '', $fcm_ios = ''){
        print_r($_REQUEST);
        //exit;
        if($type == 1){
            $detail = $this->api_model->get_fcm_doc($doctor_id);
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
                                                                'doctor_id' => $doctor_id,
                                                                'users_id' => $user_id,
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
                                                    'doctor_id' => $doctor_id,
                                                    'users_id' => $user_id,
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
    public function product_reg(){
        if($_POST['submit']){
            $data['full_name'] = $this->input->get_post('name');
            $data['fathers_name'] = $this->input->get_post('f_name');
            $data['mobile'] = $this->input->get_post('number');
            $data['mobile_code'] = '+91';
            $data['email'] = $this->input->get_post('email');
            $data['aadhaar_no'] = $this->input->get_post('adhar');
            $data['address'] = $this->input->get_post('address1').' '. $this->input->get_post('address2');
            $data['state_code'] = $this->input->get_post('state');
            $data['passcode'] = md5($this->input->get_post('passcode'));
            $data['zone_id'] = $this->input->get_post('state');
            $data['city'] = $this->input->get_post('District');
            $data['terms_conditions'] = $this->input->get_post('termsandconditions');
            $data['country_id'] = '99';
            $this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('f_name','Please Enter Father Name','required|trim');
            $this->form_validation->set_rules('number','Please Enter Mobile No','numeric|required|trim');
            $this->form_validation->set_rules('email','Please Enter Email','required|trim');
            $this->form_validation->set_rules('adhar','Please Enter Adhar No','numeric|required|trim');
            $this->form_validation->set_rules('address1','Please Enter Address','required|trim');
            $this->form_validation->set_rules('passcode','Please Enter Passcode','numeric|required|trim');
            $this->form_validation->set_rules('state','Please Enter State','required');
            $this->form_validation->set_rules('District','Please Select District','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
                $data['created_on'] = date('Y-m-d h:i:s');
                if($this->api_model->mobilecheck($data['mobile'], '+91')){
                    $this->session->set_flashdata('add_bank','Mobile No Already Exist');
                    $this->load->view('front_end/product/header');
                    $this->load->view('front_end/product/product_reg');
                }else{
                    $ins = $this->api_model->submit('users', $data);
                    $doc_data = $this->api_model->get_data('users_id = "'.$ins.'"' , 'users', '', '*');
                    $login_id = $login_detail[0]['users_id'];
					$login_name = $login_detail[0]['full_name'];
					$status = $login_detail[0]['type'];
                    $type = 0;
                    $this->session->set_userdata('users_id', $login_id);
                    $this->session->set_userdata('user_name', $login_name);
                    $this->session->set_userdata('user_type', $type);
                    return redirect(base_url().'frontend/product_checkout');
                }
            }else{
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/product_reg');
            }
        }else{
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/product_reg');
        } 
    }
    public function resetpass(){
        if(isset($_POST['submit'])){
            $data['full_name'] = $this->input->get_post('name');
            $data['fathers_name'] = $this->input->get_post('fname');
            $data['email'] = $this->input->get_post('email');
            $data['aadhaar_no'] = $this->input->get_post('adhar_no');
            $this->form_validation->set_rules('adhar_no','Please Enter Addhar No','required|trim');
            $this->form_validation->set_rules('name','Please Enter Name','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run('add_bank')){
                    $ins = $this->api_model->update('users_id',$this->session->userdata("users_id"), 'users', $data);
                    $doc_data = $this->api_model->get_data('users_id = "'.$ins.'"' , 'users', '', '*');
                    $this->session->set_flashdata('add_bank','Your Password is Updated');
                    $this->load->view('front_end/product/header');
                    $this->load->view('front_end/product/resetpass');
            }else{
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/resetpass'); 
            }
        }else{
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/resetpass');
        }
    }
    public function resetprofile(){
        if(isset($_POST['submit'])){
            $data['full_name'] = $this->input->get_post('name');
            $data['fathers_name'] = $this->input->get_post('fname');
            $data['email'] = $this->input->get_post('email');
            $data['aadhaar_no'] = $this->input->get_post('adhar_no');
            $this->form_validation->set_rules('adhar_no','Please Enter Addhar No','required|trim');
            $this->form_validation->set_rules('name','Please Enter Name','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run('add_bank')){
                    $ins = $this->api_model->update('users_id',$this->session->userdata("users_id"), 'users', $data);
                    $doc_data = $this->api_model->get_data('users_id = "'.$ins.'"' , 'users', '', '*');
                    $this->session->set_flashdata('add_bank','Your Profile is Updated');
                    $this->load->view('front_end/product/header');
                    $this->load->view('front_end/product/resetprofile');
            }else{
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/resetprofile'); 
            }
        }else{
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/resetprofile');
        }
    }
    public function resetaddress($id = ''){
        if(isset($_POST['submit'])){
            $data['address1'] = $this->input->get_post('address');
            $data['address2'] = $this->input->get_post('address2');
            $data['users_id'] = $this->session->userdata("users_id");
            $data['fullname'] = $this->input->get_post('contact_person');
            $data['mobile'] = $this->input->get_post('mobile');
            $data['latitude'] = $this->input->get_post('cityLat');
            $data['longitude'] = $this->input->get_post('cityLng');
            $data['postal_code'] = $this->input->get_post('pin_code');
            $data['country_id'] = '99';
            $data['mobile_code'] = '+91';
            $data['address_type'] = $this->input->get_post('address_type');
            $data['zone_id'] = $this->input->get_post('state');
            $data['city'] = $this->input->get_post('city');
            $district = $this->input->get_post('district');
            $data['district_id'] = $district;
            $district = $this->api_model->get_data('dis_id = "'.$district.'"' , 'district', '', 'dist_name');
            $data['district'] = $district[0]['dist_name'];
            $data['created_on'] = date('Y-m-d h:i:s');
            $this->form_validation->set_rules('contact_person','Please Enter Contact Person','required|trim');
            $this->form_validation->set_rules('mobile','Please Enter Mobile','required');
            $this->form_validation->set_rules('pin_code','Please Enter Pin Code','required');
            $this->form_validation->set_rules('address','Please Enter Address','required|trim');
            $this->form_validation->set_rules('state','Select State','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run('add_bank')){
                    if($id != ''){
                        if($ins = $this->api_model->update('address_id',$id, 'address_mst', $data)){
                            $this->session->set_flashdata('add_bank','Your Address is Updated');
                            redirect(base_url('frontend/my_account'));
                        }else{
                            $this->session->set_flashdata('add_bank','Database Error');
                            $this->load->view('front_end/product/header');
                            $this->load->view('front_end/product/resetaddress', $data); 
                        }
                    }else{
                        if($ins = $this->api_model->submit('address_mst', $data)){
                            $this->session->set_flashdata('add_bank','Your Address is Added');
                            redirect(base_url('frontend/my_account'));
                        }else{
                            $this->session->set_flashdata('add_bank','Database Error');
                            $this->load->view('front_end/product/header');
                            $this->load->view('front_end/product/resetaddress', $data); 
                        }
                    }
            }else{
                $data['data'] = $this->api_model->get_data('address_id = "'.$id.'"', 'address_mst');
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/resetaddress', $data); 
            }
        }else{
            $data['data'] = $this->api_model->get_data('address_id = "'.$id.'"', 'address_mst');
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/resetaddress', $data); 
        }
    }
    public function add_interested(){
        $data['product_id'] = $this->input->get_post('product_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($this->front_end_model->get_data('produc_interest', 'product_id = "'.$data['product_id'].'" AND users_id = "'.$data['users_id'].'"')){
            $error['msg'] = "You have already showed your interest.";
        }else{
            if($this->front_end_model->submit_data('produc_interest', $data)){
                $error['msg'] = "Thanks for showing your interest. The seller will contact you soon.";
            }else{
                $error['msg'] = "database problem";
            }
        }
        echo json_encode($error);
    }
    public function intrest_by_app(){
        $data['product_id'] = $this->input->get_post('product_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($this->front_end_model->get_data('produc_interest', 'product_id = "'.$data['product_id'].'" AND users_id = "'.$data['users_id'].'"')){
            $json['error'] = "You have already showed your interest.";
            $json['success'] = false;
        }else{
            if($this->front_end_model->submit_data('produc_interest', $data)){
                $json['msg'] = "Thanks for showing your interest. The seller will contact you soon.";
                $json['success'] = true;
            }else{
                $json['error'] = "database problem";
                $json['success'] = false;
            }
        }
        header('Content-Type: application/json');
		echo json_encode($json);	
		exit;
    }
    public function product_thanku(){
        $this->load->view('front_end/product/thanku.php');
    }
    public function wishlist(){
    	$this->load->view('front_end/product/header');
        $this->load->view('front_end/product/wishlist');
    }
    public function add_like(){ 
        $data['product_id'] = $this->input->get_post('product_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['pack_id'] = $this->input->get_post('pack_id');
        $data['pack_price'] = $this->input->get_post('pack_price');
        $data['qty'] = $this->input->get_post('qty');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($this->front_end_model->get_data('product_like', 'product_id = "'.$data['product_id'].'" AND users_id = "'.$data['users_id'].'"')){
            $error['msg'] = "Already in Wishlist";
        }else{
            if($this->front_end_model->submit_data('product_like', $data)){
                $error['msg'] = "Added to Wishlist";
            }else{
                $error['msg'] = "database problem";
            }
        }
        echo json_encode($error);
    }
    public function removelike(){
    	$id =$this->input->get_post('id');
    	$this->api_model->removeproductlike($id);
    }
    public function login(){
        if($_POST['submit']){
            $data['full_name'] = $this->input->get_post('name');
            $data['fathers_name'] = $this->input->get_post('f_name');
            $data['mobile'] = $this->input->get_post('number');
            $data['mobile_code'] = '+91';
            $data['email'] = $this->input->get_post('email');
            $data['aadhaar_no'] = $this->input->get_post('adhar');
            $data['address'] = $this->input->get_post('address1').' '. $this->input->get_post('address2');
            $data['state_code'] = $this->input->get_post('state');
            $data['passcode'] = md5($this->input->get_post('passcode'));
            $data['zone_id'] = $this->input->get_post('state');
            $data['city'] = $this->input->get_post('District');
            $data['terms_conditions'] = $this->input->get_post('termsandconditions');
            $data['country_id'] = '99';
            //$data['city'] = $this->input->get_post('District');
            $this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('f_name','Please Enter Father Name','required|trim');
            $this->form_validation->set_rules('number','Please Enter Mobile No','numeric|required|trim');
            $this->form_validation->set_rules('email','Please Enter Email','required|trim');
            $this->form_validation->set_rules('adhar','Please Enter Adhar No','numeric|required|trim');
            $this->form_validation->set_rules('address1','Please Enter Address','required|trim');
            $this->form_validation->set_rules('passcode','Please Enter Passcode','numeric|required|trim');
            $this->form_validation->set_rules('state','Please Enter State','required');
            $this->form_validation->set_rules('District','Please Select District','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
                $data['created_on'] = date('Y-m-d h:i:s');
                if($this->api_model->mobilecheck($data['mobile'], '+91')){
                    $this->session->set_flashdata('add_bank','Mobile No Already Exist');
                    $this->load->view('front_end/product/header');
                    $this->load->view('frontend/product/login_reg');
                }else{
                    $ins = $this->api_model->submit('users', $data);
                    $doc_data = $this->api_model->get_data('users_id = "'.$ins.'"' , 'users', '', '*');
                    //print_r($doc_data);
                    $login_id = $doc_data[0]['users_id'];
					$login_name = $doc_data[0]['full_name'];
                    $type = 0;
                    $this->session->set_userdata('users_id', $login_id);
                    $this->session->set_userdata('user_name', $login_name);
                    $this->session->set_userdata('user_type', $type);
                    return redirect(base_url().'frontend/product_listing');
                }
            }else{
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/login_reg');
            }
        }else{
            if($this->session->userdata("users_id")) {
                return redirect(base_url().'frontend/product_listing');
            } else {
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/login_reg');
            }
        }
    }
    public function interest(){
       $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/login_reg');
    }
    public function review($id){
        $data['id'] = $id; 
       $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/login_review',$data);
    }
    public function rating_ajax(){
        $data['product_id'] = $this->input->get_post('product_id');
        $data['user_id'] = $this->input->get_post('farmer_id');
        $data['description'] = $this->input->get_post('description');
        $data['rating'] = $this->input->get_post('rating');
        if($data['description'] == ''){
            echo "Please Fill description";
        }else if($data['rating'] == ''){
            echo "Please fill Rating";
        }else{
        	if($review = $this->api_model->get_data('product_id = '.$data['product_id'].' AND user_id = '.$data['user_id'].'' ,'products_reviews', '', '*')){
        		echo "Your review is already submited";
	        }else{
	        	if($this->api_model->submit('products_reviews', $data)){
	                echo "Your Product Review Send";
	            }else{
	                echo "Database Error";
	            }
	        }
        }
    }
    public function get_category()
	{
		$name =  $this->input->get('name');
		$data['name'] = isset($name)?$name:'';
		if(!$data = $this->front_end_model->get_category($data)){
			$data['error'] = '1';
		}
		echo json_encode($data);
	} 
	public function get_subcategory($name)
	{
		$name =  $this->input->get('name');
		$data['name'] = isset($name)?$name:'';
		if(!$data = $this->front_end_model->get_subcategory($data)){
			$data['error'] = '1';
		}
		echo json_encode($data);
    }

    public function get_login_reg(){
        $this->load->view('front_end/product/login_reg');
    }
    public function logout()
	{
		$this->session->sess_destroy();
		return redirect(base_url('frontend/login'));
	}
    // public function section_search($id){
	// 	$detail['data'] = $this->front_end_model->get_section_id($id);		
    //     $this->load->view('front_end/product/allproduct',$detail);
    //        }
    public function section_search(){
        $name =  $this->input->get('name');
        $name = $this->input->get_post('section');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->front_end_model->section_search($name, $start, $perpage);
		$detail['count'] = $this->front_end_model->section_count($name);
		if($detail)
		{
			$json_data = $detail;
		}
		else
		{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
    }
    public function removecart_sess(){
        //print_r($_REQUEST);
		$id=$_POST['id'];
	    $count =count($this->session->userdata('cart_session'));
	    if($count==1)
	   	$this->session->unset_userdata('cart_session');
        $cart_des=$this->session->userdata('cart_session');
        print_r($cart_des);
        unset($cart_des[$id]);
        $this->session->set_userdata('cart_session',$cart_des);
        //print_r($this->session->userdata("cart_session"));
    }	
    public function farmer_list($cat_id, $id){
        $data['cat_id'] = $cat_id;
        $data['id'] = $id;
        $data['product_list'] = $this->front_end_model->product_list($id);
        // print_r($data);
        // exit;
      //$data['subcategory_list'] = $this->Admin_detail->get_subcategory_cat_id($id);
        $this->load->view('front_end/product/product_single',$data);
    }
    public function product_category_search($name){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->front_end_model->product_category_search($name, $start, $perpage);
        $detail['count'] = $this->front_end_model->product_category_count($name);
        print_r($detail);
        exit;
        $this->load->view('front_end/product/allproduct',$detail);
		// if($detail)
		// {
		// 	$json_data = $detail;
		// }
		// else
		// {
		// 	$json_data['error'] = '1';
		// }
		// echo json_encode($json_data);
    }
    public function product_category_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->front_end_model->product_category_status($id, $data))
		{
			$product_data = $this->front_end_model->product_category_search($name, $start,$perpage);
			$product_data['count']= $this->front_end_model->product_category_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
    }
    public function mycart($users_id){		
        $data['customer_details'] = $this->front_end_model->custmer_details($_SESSION['users_id']);
        //print_r($data);        
        $this->load->view('front_end/product/cart2'); 
    }
    public function subcat($id = ''){
        if(!isset($id)){
            $id = $this->input->get_post('id');
        }
        $data['customer_details'] = $this->Front_end_model->custmer_details($_SESSION['user_id']);
        $data['subcategory_list'] = $this->Front_end_model->get_subcategory_cat_id($id);
        $data['id'] = $id;
        print_r($data);
        $this->load->view('Frontend/allproduct', $data);	
	}
    public function check_video_block(){
        $data['video_id'] = $this->input->get_post('video_id');
        $data = $this->Admin_detail->get_data('video_block', 'video_id = "'.$data['video_id'].'" AND isactivated = "1"');
        if($data){
            $error['msg'] = "Your Request is already Submitted";
            $error['video_url'] = $data;
        }else{
            $error['msg'] = "Payment required";
        }
        echo json_encode($error);
    }
}