<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Repeat_breeding extends CI_Controller {
	
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
	public function get_installment_price(){
		$user_type = $this->input->get_post('user_type');
		$district_id = $this->input->get_post('district_id');
		$detail = $this->api_model->get_data('', 'repeat_breeding_price', '', '*');
		if($detail){
			$json['success'] = true;
			$json['data'] = $detail;
		}else{
			$json['success'] = false;
			$json['error'] = "Database error.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
public function check_service_availability(){
		$de['dis_id'] = $this->input->get_post('district_id');
		$de['service_type'] = $this->input->get_post('service_type');
		$de['users_id'] = $this->input->get_post('users_id');
		$de['state_id'] = $this->input->get_post('state_id');
		$de['created_on'] = date('Y-m-d  H:i:s');
		$detail = $this->api_model->get_data('dis_id = "'.$de['dis_id'].'" AND FIND_IN_SET('.$de['service_type'].',service_type)', 'district', '', '*');
		if($detail){
			$json['success'] = true;
			$json['data'] = $detail;
		}else{
			$data = $this->api_model->get_data('district_id = "'.$de['dis_id'].'" AND users_id = "'.$de['users_id'].'" AND service_type = "'.$de['service_type'].'"', 'user_serch_services', '', '*');
			if($data){
				$this->api_model->update('id', $data[0]['id'], 'user_serch_services', $de);
			}else{
				$this->api_model->submit('user_serch_services', $de);
			}
			
			$json['success'] = false;			
			$json['error'] = "Currently we are not providing this service in this region.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}	
	public function make_repeat_breeding(){
		$users_id = $this->input->get_post('users_id');
        $id = $this->input->get_post('package_id');
        $payment_status = $this->input->get_post('payment_status');
        $app_type = $this->input->get_post('app_type');
        $type = $this->input->get_post('type');
        $admin_id = $this->input->get_post('admin_id');
        $log_id = $this->input->get_post('purchase_id');
        $livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
        $real_balance_consume = $this->input->get_post('real_balance_consume');
		$da['users_id']  = $users_id;
		$da['latitude'] = $this->input->get_post('latitude');
		$da['langitude'] = $this->input->get_post('langitude');
		$da['admin_id'] = $admin_id;
		$da['address'] = $this->input->get_post('address');
		$da['animal_id'] = $this->input->get_post('animal_id');
		$da['contact_person'] = $this->input->get_post('contact_person');
		$da['contact_phone'] = $this->input->get_post('contact_phone');
		$da['district_id'] = $this->input->get_post('district_id');
		$da['state_id'] = $this->input->get_post('state_id');
		$price = $this->input->get_post('total_price');		
		$da['date'] = date('Y-m-d h:i:s');
		$da['created_on'] = date('Y-m-d h:i:s');
		$da['treat_type'] = '7';
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
            $data1['animal_id'] = $da['animal_id'];
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
            $data1['animal_id'] = $da['animal_id'];
            $data1['amount'] = $real_balance_consume;
            $data1['status'] = 'Dr';
            $data1['wallet_type'] = '1';
            $data1['date'] = date('Y-m-d h:i:s');
            $this->api_model->submit('livestoc_wallets',$data1);
            $is_premium = '1';
        }        
        if($id != '' ){
            $rep_bree = $this->api_model->get_data('id = '.$id.'','repeat_breeding_price');			
			$log['users_id'] = $users_id;
			$log['currency'] = 'INR';
			$log['type'] = '50';
			$log['amount'] = $price;
			$log['user_type'] =  $data1['users_id'];
			$log['payment_type'] = 'Dr';
			$log['request_status'] = '3';
			$log['date'] = date('Y-m-d h:i:s');
			$last_log_id = $this->api_model->submit('log_file', $log);
            $data['installment_id'] = $id;
            $data['installment_name'] = $rep_bree[0]['installment_name'];
            $data['price'] = $price;
            $data['users_id'] = $users_id;           
            $data['user_type'] =  $data1['users_id'];
            $data['payment_status'] = $payment_status;
			$data['created_on'] = date('Y-m-d H:i:s');
            $this->api_model->submit('repeat_breeding_installment', $data);
            $da['log_id'] = $last_log_id;
			$request_id= $this->api_model->submit('vt_requests', $da);			
			$update_log['package_id'] = $request_id;
			$update_log['payment_type'] = 'Dr';
			$this->api_model->get_data_update('id = '.$last_log_id.'', 'log_file', $update_log);
        }
        $json['success'] = true;
        $json['msg'] = 'Your Request has been submitted and Our Veterinarian will contact you soon.';
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
	public function get_repeat_breeding(){

		$doctor_id = $this->input->get_post('doctor_id');
		$type = $this->input->get_post('req_type');
		$where = '';
        if($type !='' ){
            $where .= 'AND status = "'.$type.'"';
        }else{
        	$where .= 'AND status <> "0" AND status <> "2"';
        }
		$user_type = $this->input->get_post('user_type');
		if(!isset($doctor_id) || !$doctor_id){
			$json['success'] = False;
			$json['error'] =  "users id is required";
		}else{
			 $detail = $this->api_model->get_data('doc_id = '.$doctor_id.' '.$where.'','vt_requests');
			if($detail)
			{
				$json['success'] =  TRUE;
				$json['data'] =  $detail;
			}
			else{
				$json['success'] =  False;
				$json['error'] =  "No record found";
			}
		}
		header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	
	}
	public function get_repeat_breeding_details(){
		$doctor_id = $this->input->get_post('doctor_id');
		$type = $this->input->get_post('req_type');
		$user_type = $this->input->get_post('user_type');
		if($user_type == 'pvt_doc'){
		            $where .= 'AND doc_id = "'.$doctor_id.'"';
		        }else{
		        	$where .= 'AND vt_id = "'.$doctor_id.'"';
		        }
		$request_id = $this->input->get_post('request_id');
		if(!isset($doctor_id) || !$doctor_id){
			$data['success'] = False;
			$data['error'] =  "users id is required";
		}else{
				$request = $this->api_model->get_data('id = '.$request_id.' '.$where.'','vt_requests as vt','','*,CONCAT("'.IMAGE_PATH.'uploads_new/profile/thumb/",(select image from users where users_id = vt.users_id)) as user_image,CONCAT("'.base_url('uploads/doctor').'/",(select image from doctor where doctor_id = vt.doc_id)) as doctor_image,CONCAT("'.base_url('uploads/doc').'/",(select image from doctor where doctor_id = vt.vt_id)) as vt_image');
				$i =0;
				foreach($request as $rep){
			  	  $subreq = $this->api_model->get_data('request_id = '.$rep['id'].'','vt_request_tracking');
			  	  	$detail = $this->api_model->get_request_by_id($rep['id']);
			  	  	$animal_data = $this->api_model->get_data('animal_id = "'.$rep['animal_id'].'"' , 'animals as ani', '', 'animal_id,fullname as animal_name, age as animal_age,age_month as animal_age_month,breed_id,category_id, CONCAT("'.base_url('uploads/animal').'/",(select images from animals_images where animal_id = ani.animal_id )) as image,(select breed_name from breed where breed_id = ani.breed_id ) as  animal_breed,(select category as cat from category where category_id = ani.category_id) as animal_category ');			
			  	 $request[$i]['subrequest'] = $subreq;
			  	 $request[$i]['animal_details'] = $animal_data;
			  	 $i++;
			  }					
			if($request)
			{
				$json['success'] =  TRUE;
				$json['data'] =  $request;
			}
			else{
				$json['success'] =  False;
				$json['error'] =  "No record found";
			}
		}
		header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
	public function animals_sell_purchase(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['address'] = $this->input->get_post('address');
		$data['state_id'] = $this->input->get_post('state_id');
		$data['district_id'] = $this->input->get_post('district_id');
		$data['estimate_amount'] = $this->input->get_post('estimate_amount');
		$data['total_animals'] = $this->input->get_post('total_animals');
		$data['animal_purpose'] = $this->input->get_post('animal_purpose');
		$animal_detail = json_decode($_REQUEST['animal_detail']);
		$data['created_on'] = date('Y-m-d H:i:s');
		$details = $this->api_model->get_data('users_id = '.$data['users_id'].' AND animal_purpose = '.$data['animal_purpose'].'','animals_sell_purchase');
		if($details){
			$json['success'] = false;
			$json['error'] = 'We have already received your data. Our team will contact you soon';
		}else{
			if($animal_detail == ''){
				$request_id= $this->api_model->submit('animals_sell_purchase', $data);
			}
			foreach ($animal_detail as $value){
				 $sell_purchase = [
	                                'users_id'         =>  $data['users_id'],
	                                'no_of_animal'     =>  $value->animal_count,
	                                'category_id'      =>  $value->category_id,
	   								'breeds_id'        =>   implode(",",$value->breed_interested),
	   								'address'          =>  $data['address'],
	   								'state_id'         =>  $data['state_id'],
	   								'district_id'      =>  $data['district_id'],
	   								'estimate_amount'  =>  $data['estimate_amount'],
	   								'total_animals'    =>  $data['total_animals'],
	   								'animal_purpose'   =>  $data['animal_purpose'],                
	                                'created_on'       =>  $data['created_on']
	                             ]; 
	             $request_id= $this->api_model->submit('animals_sell_purchase', $sell_purchase);
			}
			$json['success'] = true;
			$json['msg'] = 'Thanks your form has been submitted, Livestoc team will contact you soon';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
		
	}
}