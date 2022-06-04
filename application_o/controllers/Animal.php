<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Animal extends CI_Controller {	
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('pushnoti_model');
		$this->load->model('login_cheak_model');
    }
    public function mail_sute(){
        $this->email->from('shahiakhilesh75@gmail.com', 'Identification');
        $this->email->to('shahiakhilesh75@gmail.com');
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('The email send using codeigniter library');
        $this->email->send();
	}
	public function get_refral_doc(){
        $users_id = $this->input->get_post('users_id');
        if(!isset($users_id) || $users_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send users id";
        }else{
            if($data = $this->api_model->check_refral_code($users_id)){
				$ref = $this->check_ref_hpkd($data[0]['doc_referal_by']);
				if($ref['success']){
					// echo "this is ";
						$data_w['name'] = $ref['data']['username'];
						$data_w['mobile'] = $ref['data']['mobile'];
						$data_w['mobile2'] = $ref['data']['mobile_2nd'];
						$url = base_url().'uploads/doc/'.$ref['data']['image'];
						$h = get_headers($url);
						$status = array();
						preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
						if($status[1]==200){
							$data['image'] = $url;
						}else{
							$data_w['image'] = base_url().'uploads/image/profile.jpg';
						}
						$json['success'] = true;
						$json['data'] =  $data_w;
                    $json['msg'] =  "Your Service provider has been successfully assoiciated with your Account";
                }else{
                    $json['success'] = False;
                    $json['error'] = "There is no service provider associated with your Account";
                }
            }
		}
		//print_r($json);
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}

	//Get get_doc_premiumlist with details
	public function get_doc_premiumlist(){
		$is_premium =$this->input->get_post('is_premium');
		$is_paid =$this->input->get_post('is_paid');
		//is premius conditions
		if(isset($is_premium) && $is_premium != ''){
			$is_premium = $is_premium;
		}else if(!isset($is_premium) || $is_premium == ''){
			$is_premium = '1';
		} else {
			$is_premium = '1';
		}
		//is paid conditions
		if(isset($is_paid) && $is_paid != ''){
			$is_paid = $is_paid;
		}else if(!isset($is_paid) || $is_paid == ''){
			$is_paid = '1';
		} else {
			$is_paid = '1';
		}	

		$langituit = $this->input->get_post('longitude');
		$latituit = $this->input->get_post('latitude');

		$specy_id = $this->input->get_post('specy_id');
		//specy_id search
		if(isset($specy_id) && $specy_id != '')
		{
			$specy_id = $specy_id;
			$specy_id_where = $specy_id;
			//$specy_id_where .= " where sp.specy_id IN (".$specy_id.")";
		} else {
			$specy_id_where = "Any"; 
		}

		$data = $this->api_model->get_doc_premiumlist_detail($is_premium, $is_paid, $langituit, $latituit,$specy_id_where);
		
		$tax = $this->api_model->get_all_tax();
		foreach($data as $da){
			$da['total_amonut'] = $da['price'];
			$da['refral_amonut'] = REFER_AMOUNT;
			$da['is_premium'] = $is_premium;
			$da['is_paid'] = $is_paid;
			foreach($tax as $t){
				$amount = $da['price']*$t['tax_percentage']/100;
				$da['total_amonut'] += $amount;
			}
			$doc_qua = $this->login_cheak_model->get_qulification_doc_id($da['doc_id']);
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
			$doc_exp = $this->login_cheak_model->get_exp_doc_id($da['doc_id']);
			$dtx = $doc_exp; 
			if(!isset($d['image'])){
				$da['image'] = base_url()."/uploads/image/profile.jpg";
			}else{
				$da['image'] = base_url()."/uploads/doctor/".$da['image'];
			}if(isset($d['expertise_list'])){
				$da['expertise_list'] = explode(',',$da['expertise_list']);
			}
			//$d['experience'] = $dtx;
			if(!empty($dtx)){
				$da['experience'] = $dtx;
			}else{
				$da['experience'] = [];
			}
			//$d['qualification'][0] = $dat;
			if(!empty($dat)){
				$da['qualification'] = $dat;
			}else{
				$da['qualification'] = [];
			}
			$json_data[] = $da; 
		}

		$type = 'repeat_premiumlist';
		$distance = '';
		$latitu = $this->input->get_post('latitude');
		$limit = $this->input->get_post('limit');
		$start = $this->input->get_post('start');
		if($start == '' || !isset($start))
			$start = 0;
			$langitude = $this->input->get_post('longitude');
			$speci_type = $this->input->get_post('speci_id');
		$state = '';
		if(!isset($type) || $type==''){
			$json['success'] = false;
			$json['error'] = "Please send type";
		} else if(!isset($distance) && $distance != ''){
			if(isset($latitu) || $latitu ==''){
				$json['success'] = false;
				$json['error'] = "Please send latitude";
			}else if(isset($langitude) || $langitude ==''){
				$json['success'] = false;
				$json['error'] = "Please send Langitude";
			}
		}
		
		if(!empty($data)){
			$count = $this->api_model->count_doc_premiumlist(
					$type , 
					$distance, 
					$latitu, 
					$langitude, 
					$state, 
					$speci_type, 
					'',
					$is_premium,
					$is_paid,
					$specy_id_where

			);
			$cou = $count;
			$json['success'] = True;
			$json['data'] = $json_data;
			$json['count']	= $cou;	
		}else{
			$json['success'] = False;
			$json['error'] = "No Listing Found in Your Area";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}

	public function check_refral_code(){
        $users_id = $this->input->get_post('users_id');
        $refral_id = $this->input->get_post('refral_id');
        if(!isset($users_id) || $users_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send users id";
        }else if(!isset($refral_id) || $refral_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send refral id";
        }else{
            if($data = $this->api_model->check_refral_code($users_id, $refral_id)){
                    $json['success'] = False;
                    $json['error'] = "The Service Provider is already attached with you";
            }else{
                $data_ref = $this->api_model->check_refral_code($users_id);
                if($data_ref[0]['doc_referal_by'] == 0 || $data_ref[0]['doc_referal_by'] == ''){
					$ref = $this->check_ref_hpkd($refral_id);
					if($ref['success']){
						//$ref_data['users_id'] = $users_id;
						$ref_data['doc_referal_by'] = $refral_id;
						$this->api_model->update_referal_code($ref_data, $users_id);
						$data['name'] = $ref['data']['username'];
						$data['mobile'] = $ref['data']['mobile'];
						$data['mobile2'] = $ref['data']['mobile_2nd'];
						$url = base_url().'uploads/doc/'.$ref['data']['image'];
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
					$ref = $this->check_ref_hpkd($refral_id);
					if($ref['success']){
						$ref_data['doc_referal_by'] = $refral_id;
						$this->api_model->update_referal_code($ref_data, $users_id);
						$data['name'] = $ref['data']['username'];
						$data['mobile'] = $ref['data']['mobile'];
						$data['mobile2'] = $ref['data']['mobile_2nd'];
						$url = base_url().'uploads/doc/'.$ref['data']['image'];
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
						$json['msg'] =  "Your request for updating Service Provider has been submited successfuly.";
					}else{
						$json['success'] = False;
						$json['error'] = "Your referral code is not matched";
					}
                }               
            }
		}
        header('Content-Type: application/json');
        echo json_encode($json);
		exit;
	}
	
    public function get_job_list(){
		$cat_id = $this->input->get_post('category');
		$sub_cat = $this->input->get_post('sub_category');
		$prefered_location = $this->input->get_post('prefered_location');
		$jod = $this->api_model->get_job_list($cat_id, $sub_cat, $prefered_location);
		if($jod){
			$json['success'] = true;
			$json['data'] =  $jod;
		}else{
			$json['success'] = false;
			$json['error'] =  "No Data Found";
		}
		header('Content-Type: application/json');
        echo json_encode($json);
		exit;
    }
	public function get_doc_profile(){ 
		$doc_id = $this->input->get_post('doc_id');
		if($doc_id == '' || !isset($doc_id)){
			$json['success'] = false;
			$json['error'] =  "Doctor Id Not Found";
		}else{
			$profile = $this->api_model->get_doc_profile($doc_id);
			$json['success'] = true;
			$json['data'] =  $profile;
		}
		header('Content-Type: application/json');
        echo json_encode($json);
		exit;
	}
	public function check_ref_hpkd($ref){
		if(!isset($ref) || $ref == ''){
				$json['success'] =  false;
				$json['error'] = "Please send referral code";
		}else{
			if($ref == '92018397'){
				$json['success'] =  TRUE;
				$json['data'] = [];
			}else{
				$ref_data = $ref_count = $this->api_model->count_refral_uses($ref);
				if($ref_data[0]['count'] == '50'){
					$json['success'] =  false;
					$json['error'] = "Your referral code is invalid";
				}else{
					$data = $this->api_model->check_ref($ref);
					if(!$data){
						$json['success'] =  false;
						$json['error'] = "Your referral code is not matched";
					}else{
						$json['success'] =  TRUE;
						$json['data'] = $data;
					}
				}
			}
		}
		return $json;
	}
    public function get_animal(){
				$users_id =$this->input->get_post('users_id');
				$catggory_id = $this->input->get_post('category_id');
				$status = $this->input->get_post('status');
				if(isset($catggory_id) || $catggory_id != ''){
					$catggory_id = json_decode($catggory_id);
					if(is_array($catggory_id)){
						$catggory_id = implode(',',$catggory_id);
					}
				}
				$gendor = $this->input->get_post('gender');
			if(!$users_id){
				$data['success'] =  False;
				$data['error'] =  "Please Send User id";
			}else{
						$animal_id = $this->input->get_post('animal_id');
						$heard = $this->input->get_post('herd');
            if(!isset($animal_id)){
                $detail = $this->api_model->get_animal($users_id, $catggory_id, $gendor, $heard);
                foreach($detail as $de){
					$img = $this->api_model->get_animal_image($de['animal_id']);
                    $breed = $this->api_model->get_breed($de['breed_id']);
					$category = $this->api_model->get_category($de['category_id']);
					$videos = $this->api_model->get_animal_videos($de['animal_id']);
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
						$file = base_url().'uploads/animal/'.$im['images'];
						$handlerr = curl_init($file);
						curl_setopt($handlerr,  CURLOPT_RETURNTRANSFER, TRUE);
						$resp = curl_exec($handlerr);
						$ht = curl_getinfo($handlerr, CURLINFO_HTTP_CODE);
						if ($ht == '404'){
							$imm['images'][] = 'https://www.livestoc.com/uploads_new/animals/thumb/'.$im['images'];
						}
						else {
							$imm['images'][] = $file;
						}
					}
                    $de['breed_name'] = $breed[0]['breed_name'];
					$de['category_name'] = $category[0]['category'];
					if(empty($imm)){
						$imm['images'] = [];
					}
                    $de['images'] = $imm;
                    $deat[] = $de;
                }
                $detail = $deat;
                $data = [];
                if($detail){
                    $data['success'] =  True;
                    $data['data'] =  $detail;
                }else{
                    $data['success'] =  False;
                    $data['error'] =  "आपके द्वारा कोई भी पशु पंजीकृत नहीं किया गया है";
                }
            }else{
				
                //$animal_id = '294';
				$detail = $this->api_model->get_animal_ani_id($animal_id);
								$vacc = $this->api_model->get_animal_vacc($animal_id);
								$t_vacc = [];
								foreach($vacc as $v){
									$tre_arr = $this->api_model->get_vacc_det($v['vacc_id']);
									$i=0;
									foreach($tre_arr as $tre){
										if($i==0){
											$tre_name = $tre['name'];
										}else{
											$tre_name .= ','.$tre['name'];
										}
										$i++;
									}
									$v['name'] = $tre_name;
									$t_vacc[]=$v;
								}
								$vacc = $t_vacc;
								$treat = $this->api_model->get_treat($animal_id);
								$t_arry = [];
								foreach($treat as $t){
									$tre_arr = $this->api_model->get_simtoms_det($t['simtoms']);
									$i=0;
									foreach($tre_arr as $tre){
										if($i==0){
											$tre_name = $tre['name'];
										}else{
											$tre_name .= ','.$tre['name'];
										}
										$i++;
									}
									$t['simtoms'] = $tre_name;
									$t_arry[]=$t;
								}
								$treat = $t_arry;
								$preg = $this->api_model->get_pregnancy($animal_id, 5);
                $dewo = $this->api_model->get_pregnancy($animal_id, 2);
				$ai = $this->api_model->get_pregnancy($animal_id, 3);
				$ai_some = [];
				foreach($ai as $a){
					$bull_data = $this->api_model->get_bull_detail_ai($a['id']);
					//print_r($bull_data);
					$Date = $a['date'];
					$a['pregnancy_check_date'] = date('Y-m-d', strtotime($Date. ' + 45 days'));
					$a['bull_no'] = isset($bull_data[0]['bull_no']) ? $bull_data[0]['bull_no'] : '';
					$a['bull_id'] = isset($bull_data[0]['id']) ? $bull_data[0]['id'] : '';
					$ai_some[] = $a;
				}
                foreach($detail as $de){
					$img = $this->api_model->get_animal_image($de['selling_id']);
                    $breed = $this->api_model->get_breed($de['breed_id']);
					$category = $this->api_model->get_category($de['category_id']);
					$imm['images']=[];
                    foreach($img as $im){

                        $url = base_url().'uploads/animal/'.$im['images'];
                        $h = get_headers($url);
                        $status = array();
                        preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
                        if($status[1]==200){
                            $imm[] = $url;
                        }else{
                            $imm = [];
                        }
                    }
                    $de['breed_name'] = $breed[0]['breed_name'];
                    $de['category_name'] = $category[0]['category'];
                    $de['images'] = $imm; 
                    $deat[] = $de;
                }
                $detail = $deat;
                $data = [];
                if($detail){
                    $data['success'] =  True;
                    $data['data'] =  $detail;
                    $data['vaccination_detail'] = $vacc;
                    $data['treatment_detail'] = $treat;
										$data['deworming_detail'] = $dewo;
										$data['pregnancy_detail'] = $preg ;
                    $data['ai_detail'] = $ai_some;
                }else{
                    $data['success'] =  False;
                    $data['error'] =  "आपके द्वारा कोई भी पशु पंजीकृत नहीं किया गया है";
                }
            }                
		}
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
		}
	public function get_bull_animal_detail(){
		$bull_id = $this->input->get_post('bull_id');
		$detail = $this->api_model->ai_bull_detail_id($bull_id);
		if($detail){
			$dommy = [];
			foreach($detail as $d){
					$cat = $this->api_model->get_category($d['category']);
					$d['category_name'] = $cat[0]['category'];
					$breed = $this->api_model->get_breed($d['bread']);
					$d['breed_name'] = $breed[0]['breed_name'];
					$dommy[] = $d;
			}
			$data['success'] =  true;
			$data['data'] =  $dommy;
		}else{
			$data['success'] =  False;
			$data['error'] =  "No Data found";
		}
		header('Content-Type: application/json');
				echo json_encode($data);
				exit;
	}
	public function get_doc_price(){
		$data = $this->api_model->get_doc_price();
		$tax = $this->api_model->get_all_tax();
		foreach($data as $da){
			$da['total_amonut'] = $da['price'];
			$da['refral_amonut'] = REFER_AMOUNT;
			foreach($tax as $t){
				$amount = $da['price']*$t['tax_percentage']/100;
				// print_r($amount);
				// echo "</br>"; 
				$da['total_amonut'] += $amount;
			}
			$json_data[] = $da; 
		}
		$json['success'] =  TRUE;
		$json['data'] = $json_data;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function check_ref(){
		$ref = $this->input->get_post('ref');
		if(!isset($ref) || $ref == ''){
				$json['success'] =  false;
				$json['error'] = "Please send referral code";
		}else{
			if($ref == '92018397'){
				$json['success'] =  TRUE;
				$json['data'] = [];
			}else{
				$ref_data = $ref_count = $this->api_model->count_refral_uses($ref);
				if($ref_data[0]['count'] == '50'){
					$json['success'] =  false;
					$json['error'] = "Your referral code is invalid";
				}else{
					$data = $this->api_model->check_ref($ref);
					if(!$data){
						$json['success'] =  false;
						$json['error'] = "Your referral code is not matched";
					}else{
						$json['success'] =  TRUE;
						$json['data'] = $data;
					}
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function animal_vacc_request(){
		$animal_id = $this->input->get_post('animal_id');//["275","276"]
		$vacc_id = $this->input->get_post('vacc_id');//["1","2"]
		$user_id = $this->input->get_post('users_id');
		if(!isset($animal_id) || !$animal_id){
			$json['success'] = False;
			$json['error'] =  "animal id is required";
		}else if(!isset($vacc_id) || !$vacc_id){
			$json['success'] = False;
			$json['error'] =  "Category id is required";
		}else if(!isset($user_id) || !$user_id){
			$json['success'] = False;
			$json['error'] =  "User id is required";
		}else{
			$animal_id = json_decode($animal_id);
			$vacc_id = json_decode($vacc_id);
			foreach($animal_id as $a){
				foreach($vacc_id as $v){
					$data['animal_id'] = $a;
					$data['users_id'] = $user_id;
					$data['vacc_id'] = $v;
					$data['status']  = '1';
					$data['date'] = date('Y-m-d');
					$this->api_model->insert_vacc_req($data);
				}
			}
			$json['success'] = True;
			$json['msg'] =  "Your Vaccination Request is Submitted";
			$msg['message'] = "Your Vaccination Request is Submitted";
			$msg['users_id'] = $user_id;
			$msg['type'] = 0;
			$msg['title'] = "Vaccination";
			$msg['date'] = date('Y-m-d h:i:s');
			$this->pushnoti_model->insert_noti($msg);
			$msg['flag'] = 1;
			$this->push_non($user_id, 1 , $msg['title'],  $msg['flag'], $msg['message'], $msg['title']);
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function animal_dead()
	{
		$animal_id = $this->input->get_post('animal_id'); //["275","276"]
		$users_id = $this->input->get_post('users_id'); 
		if(!isset($animal_id) || !$animal_id){
	      	$data['error'] =  "animal id is required";
		}
		if(!isset($animal_id) || !$animal_id){
			$data['error'] =  "User id is required";
		}
		$total_animal = json_decode($animal_id);
		if(empty($data['error']))
		{
			foreach($total_animal as $animals)
			{
				$datafiled = [
			    'ismodified'     => '2',
				];
				$update = $this->api_model->animal_dead_update($animals,$datafiled);
			}
			if($update)
			{
				$data['success'] =  TRUE;
				$data['msg'] =  "Dead Animal request successfully submitted";
				// $ms = "Dead Animal request successfully submitted for ".$total_animal."";
				// $msg['message'] = $ms;
				// $msg['users_id'] = $users_id;
				// $msg['type'] = 0;
				// $msg['title'] = "Animal Dead";
				// $msg['date'] = date('Y-m-d h:i:s');
				// $this->Pushnoti_model->insert_noti($msg);
			}
			else{
				$data['success'] =  FALSE;
				 $data['error'] =  "Update Error";
			}
		}
		else{
			$data['success'] =  FALSE;
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	public function vaccin(){
		$cat_id = $this->input->get_post('cat_id');
		$data = [];
		if(!isset($cat_id) || $cat_id == ''){
			$data['success'] =  FALSE;
			$data['error'] =  "Category id is required";
		}else{
			$detail = $this->api_model->get_vaccin($cat_id);
			if($detail){
				$data['success'] =  True;
				$data['data'] =  $detail;
			}else{
				$data['success'] =  FALSE;
				$data['error'] =  "There is no Vaccination found with this category id";
			}
		}
		echo json_encode($data);
	}
	public function animal_treatment_request()
	{
		$animal_id = $this->input->get_post('animal_id'); //["275","276"]
		$vacc_id = $this->input->get_post('vacc_id');//["1","2"]
		$users_id = $this->input->get_post('users_id'); 
		$doc_type = $this->input->get_post('doc_type');
		$treat_type = $this->input->get_post('treat_type');
		$address = $this->input->get_post('address');
		$latitude = $this->input->get_post('latitude');
		$langitude  = $this->input->get_post('langitude');
		$animal_simtoms = $this->input->get_post('animal_simtoms');//["gdgjg","ahdhk"]
		$animal_simtoms = json_decode($animal_simtoms);
		$animal_simtoms = implode(',',$animal_simtoms);
		$total_animal = json_decode($animal_id);
		$vacc_id = json_decode($vacc_id);
		if(is_array($total_animal)){
			$total_im_animal = implode(',',$total_animal);
		}else{
			$total_im_animal = $total_animal;
		}
		if(is_array($vacc_id)){
			$vacc_im_id = implode(',',$vacc_id);
		}else{
			$vacc_im_id = $vacc_id;
		}
		if(!isset($animal_id) || !$animal_id){
	      $data['error'] =  "animal id is required";
	    }
		if(!isset($users_id) || !$users_id){
	      $data['error'] =  "users id is required";
	    }
		if(!isset($treat_type) || $treat_type ==''){
	      $data['error'] =  "treatment type is required";
	    }
		if(!isset($address) || !$address){
	      $data['error'] =  "Address is required";
		}
		if(is_array($total_im_animal)){
			foreach($total_im_animal as $animals)
			{
				$animal_data = $this->api_model->get_animal_ani_id($animals);
				//$users_id= $animal_data['0']['users_id'];
				$treatment_status= $animal_data['0']['treatment_status'];
				if($treatment_status == '1')
				{
					$data['error'] =  "Request already send for this animal #".$animals." ";
				}
			}
		}else{
			$animal_data = $this->api_model->get_animal_ani_id($total_im_animal);
			//$users_id= $animal_data['0']['users_id'];
				$treatment_status= $animal_data['0']['treatment_status'];
				if($treatment_status == '1')
				{
					$data['error'] =  "Request already send for this animal #".$total_im_animal." ";
				}
		}		
		$animal_treatment = [];
		$ani_tret = [];
		$cont_animal = 0;
		if(empty($data['error']))
		{
			$otp_l = rand(1000,9999);
			if($doc_type == 1){
				$vt_id = '0';
			}else{
				$vt_id= $animal_data['0']['vt_id'];
				$th= $this->api_model->get_doctor_info($vt_id);	
			}
			$ani_title= $animal_data['0']['title'];
		
					if(isset($vacc_id)){
						// foreach($vacc_id as $v){
							$req_filed['animal_id'] = $total_im_animal;
							$req_filed['users_id'] = $users_id;
							$req_filed['treat_type'] = $treat_type;
							$req_filed['vt_id'] = $vt_id;
							$req_filed['vacc_id'] = $vacc_im_id;
							$req_filed['animal_simtoms'] = $animal_simtoms;
							$req_filed['status']  = '0';
							$req_filed['address'] = $address;
							$req_filed['latitude'] = $latitude?$latitude:'0';
							$req_filed['langitude '] = $langitude?$langitude:'0';
							$req_filed['otp'] = $otp_l;
							$req_filed['created_on'] =  date('Y-m-d H:i:s');
							$req_filed['date'] = date('Y-m-d');
							$insert = $this->api_model->insert_vt_request($req_filed);
						// }
					}else{
							$req_filed = [
								'users_id'     => $users_id,
								'animal_id'     => $total_im_animal,
								'treat_type'    => $treat_type,
								'vt_id'         => $vt_id,
								'animal_simtoms'=> $animal_simtoms,
								'status'        => '0',
								'address'       => $address,
								'latitude'      => $latitude?$latitude:'0',
								'langitude '    => $langitude?$langitude:'0',
								'otp'          => $otp_l,
								'date'		   => date('Y-m-d'),
								'created_on'    =>  date('Y-m-d H:i:s'),
							];
							$insert = $this->api_model->insert_vt_request($req_filed);
					}
					
							foreach($total_animal as $animals)
							{
								$cont_animal++;
								$this->api_model->get_animal_ani_id($animals);
								$ani_title= $animal_data['0']['title'];	
								$otp_2 = rand(1000,9999);
								if(isset($vacc_id)){
									//foreach($vacc_id as $v){
										$r_data['request_id'] = $insert; 
										$r_data['user_id'] = $users_id;
										$r_data['animal_id'] = $animals;
										$r_data['treat_type'] = $treat_type;
										$r_data['doc_id'] = isset($th) ? $th->parent_id : '0';
										$r_data['animal_simtoms'] = $animal_simtoms;
										$r_data['vacc_id'] = $vacc_im_id;
										$r_data['vt_id'] = $vt_id;
										$r_data['status'] = '0';
										$r_data['type'] = '1';
										$r_data['otp'] = $otp_2;
										$r_data['date'] = date('Y-m-d');
										$this->api_model->insert_vt_track_request($r_data);
									//}
								}else{
										$r_data['request_id'] = $insert; 
										$r_data['user_id'] = $users_id;
										$r_data['animal_id'] = $animals;
										$r_data['treat_type'] = $treat_type;
										$r_data['animal_simtoms'] = $animal_simtoms;
										$r_data['doc_id'] = isset($th) ? $th->parent_id : '0';
										$r_data['vacc_id'] = '0';
										$r_data['vt_id'] = $vt_id;
										$r_data['status'] = '0';
										$r_data['type'] = '0';
										$r_data['otp'] = $otp_2;
										$r_data['date'] = date('Y-m-d');
										$this->api_model->insert_vt_track_request($r_data);
								}
								$ani_tret = $r_data;
								$ani_tret['address'] = $address;
								$ani_tret['latitude'] = $latitude?$latitude:'0';
								$ani_tret['langitude'] = $langitude?$langitude:'0';
								$ani_tret['created_on'] =  date('Y-m-d H:i:s');
								$ani_tret['date'] = date('Y-m-d');
								$ani_tret['title'] = $ani_title;
								$animal_img = '';
								$animal_img = $this->api_model->get_animal_image($animals);
								$image = $animal_img['0']['images'];
								$url = base_url().'uploads/animal/'.$image;
								$h = get_headers($url);
								$status = array();
								preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
								if($status[1]==200){
									$ani_tret['image']  = $url;
								}else{
									$ani_tret['image'] = '';
								}
								// $defaultimage = '1315099364.jpg';
								// $ani_tret['image'] = base_url().'uploads/animal/'.$defaultimage;
								$animal_treatment[] = $ani_tret;
								//print_r($ani_tret);
								if($insert)
								{
									$datafiled = [
									'treatment_status'     => '1',
								];
								$update = $this->api_model->animal_table_update($animals,$datafiled);
							}
							$re_value = $ani_tret;
							}
				if($doc_type == 1){
						$vill_data = $this->api_model->get_vt_by_latitude_pvt($latitude, $langitude);
						foreach($vill_data as $vill){
								$users_id = $vill['doctor_id'];
								$ms = "User (Usersid:#'.$users_id.') has send you a treatment request for '.$cont_animal.' animals.";
								$msg['message'] = $ms;
								$msg['users_id'] = $users_id;
								$msg['type'] = 1;
								$msg['title'] = "Treatment /Vaccination";
								$msg['date'] = date('Y-m-d h:i:s'); 
								$this->pushnoti_model->insert_noti($msg);
								$msg['flag'] = '0';
								$msg['message'] = 'You have new Treatment/ Vaccination request.';
								$this->push_non($vt_id, 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);	
					}					
				}else{
					$ms = "User (Usersid:#'.$users_id.') has send you a treatment request for '.$cont_animal.' animals.";
					$msg['message'] = $ms;
					$msg['users_id'] = $users_id;
					$msg['type'] = 1;
					$msg['title'] = "Treatment /Vaccination";
					$msg['date'] = date('Y-m-d h:i:s'); 
					$this->pushnoti_model->insert_noti($msg);
					$msg['flag'] = '0';
					$msg['message'] = 'You have new Treatment /Vaccination request.';
					$this->push_non($vt_id, 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);	
					$msg['message'] = 'Your Paravet got a new request.';
					$this->push_non($th->parent_id, 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);
				}
				// $ms = "User (Usersid:#'.$users_id.') has send you a treatment request for '.$cont_animal.' animals.";
				// $msg['message'] = $ms;
				// $msg['users_id'] = $users_id;
				// $msg['type'] = 1;
				// $msg['title'] = "Treatment /Vaccination";
				// $msg['date'] = date('Y-m-d h:i:s'); 
				// $this->pushnoti_model->insert_noti($msg);
				// $msg['flag'] = '0';
				// $msg['message'] = 'You have new Treatment/ Vaccination request.';
				// $this->push_non($vt_id, 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);	
				// $msg['message'] = 'Your Paravet got a new request.';
				// $this->push_non($th->parent_id, 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);
				$vt_email = $th->email;
				if($vt_email)
					{
					$this->email->from(CO_EMAIL, 'Livestoc');
					$this->email->to($vt_email);
					$this->email->subject('Animal Treatment Request');
					$this->email->message('User (Usersid:#'.$users_id.') has send you a treatment request for '.$cont_animal.' animals.');
					$this->email->send();	
					}
					$data['success'] =  TRUE;
				$data['data']['animal_info'] =  array_values($animal_treatment);
				$data['data']['vt_info'] =  $th;
				if($treat_type == '0'){
					$ter = 'Treatment';
				}if($treat_type == '1'){
					$ter = 'Vaccination';
				}if($treat_type == '2'){
					$ter = 'Deworming';
				}if($treat_type == '3'){
					$ter = 'Artifical Insemination';
				}if($treat_type == '4'){
					$ter = 'Crisis';
				}  
				$data['msg'] ="Your request of ".$ter." of ".$cont_animal." animals has been submitted successfully";
		}
		else{
			$data['success'] =  False;	
		}
		 echo json_encode($data);
	}
	
	// public function vt_request_det(){
	// 	$doctor_id = $this->input->get_post('doctor_id');
	// 	$type = $this->input->get_post('req_type');
	// 	$user_type = $this->input->get_post('user_type');
	// 	if(!isset($doctor_id) || !$doctor_id){
	// 		$data['success'] = False;
	// 		$data['error'] =  "users id is required";
	// 	}else{
	// 		$doc_data = $this->api_model->doc_detail_id($doctor_id);
	// 		if($type != ''){
	// 			if($user_type == 'pvt_ai' || $user_type == 'pvt_vt'){
	// 				$doc_data = $this->api_model->get_doc_langitued($doctor_id);
	// 				$detail = $this->api_model->vt_req_det_lanitude($doctor_id, $type, $doc_data[0]['langitute'], $doc_data[0]['lantitute'], $doc_data[0]['date']);
	// 			}else{
	// 				$detail = $this->api_model->vt_req_det($doctor_id, $type, $doc_data[0]['date']);
	// 			}
	// 		}else{
	// 			$detail = $this->api_model->vt_req_det($doctor_id, $type, $doc_data[0]['date']);
	// 		}	
	// 		if($detail)
	// 		{
	// 			$data['success'] =  TRUE;
	// 			$data['data'] =  $detail;
	// 		}
	// 		else{
	// 			$data['success'] =  False;
	// 			$data['error'] =  "No record found";
	// 		}
	// 	}
	// 	echo json_encode($data);
	// }
	public function vt_request_det(){
		$doctor_id = $this->input->get_post('doctor_id');
		$type = $this->input->get_post('req_type');
		$user_type = $this->input->get_post('user_type');
		if(!isset($doctor_id) || !$doctor_id){
			$data['success'] = False;
			$data['error'] =  "users id is required";
		}else{
			$doc_data = $this->api_model->doc_detail_id($doctor_id);
			if($type != ''){
				if($user_type == 'pvt_ai' || $user_type == 'pvt_vt'){
					$doc_data = $this->api_model->get_doc_langitued($doctor_id);
					$detail = $this->api_model->vt_req_det_lanitude($doctor_id, $type, $doc_data[0]['langitute'], $doc_data[0]['lantitute'], $doc_data[0]['date']);
				}else{
					$detail = $this->api_model->vt_req_det($doctor_id, $type, $doc_data[0]['date']);
				}
			}else{
				$detail = $this->api_model->vt_req_det($doctor_id, $type, $doc_data[0]['date']);
			}	
			if($detail)
			{
				$data['success'] =  TRUE;
				$data['data'] =  $detail;
			}
			else{
				$data['success'] =  False;
				$data['error'] =  "No record found";
			}
		}
		echo json_encode($data);
	}

	public function doc_request_detial(){
				$doctor_id = $this->input->get_post('doctor_id');
				$type = $this->input->get_post('req_type');

				if(!isset($doctor_id) || !$doctor_id){
					$json['success'] = False;
					$json['error'] =  "users id is required";
				}else{
							$data = $this->api_model->get_vt($doctor_id);
							$i = 0;
							foreach($data as $d){
									if($i==0){
										$tre_name = $d['doctor_id'];
									}else{
										$tre_name .= ','.$d['doctor_id'];
									}
									$i++;
							}
							$detail = $this->api_model->get_doc_req_det($tre_name, $type);
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
				echo json_encode($json);
	}

	public function get_treat_request_doc(){
		$doctor_id = $this->input->get_post('doctor_id');
		if(!isset($doctor_id) || !$doctor_id){
			$json['success'] = False;
			$json['error'] =  "users id is required";
		}else{
							$detail = $this->api_model->get_doc_treat_det($doctor_id);
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
		echo json_encode($json);
	}
	public function animal_treatment_track()
	{
		$users_id = $this->input->get_post('users_id'); 
	     if(!isset($users_id) || !$users_id){
	      $data['error'] =  "users id is required";
	    }
		if(empty($data['error']))
		{
			$animal_data = $this->api_model->animal_treatment_track($users_id);
			// $some = $this->api_model->get_requ_some($animal_data[0]['request_id']);
			// print_r($some);
			$vt = $this->api_model->get_doctor_info($animal_data['0']['vt_id']);
			// foreach($animal_data as $ani_d){
			// 	print_r($ani_d);
			// }
		
			if($animal_data)
			{
				$data['success'] =  TRUE;
				
				$data['data']['animal_info'] =  $animal_data;
				$data['data']['vt_info'] =  $vt;
			}
			else{
				$data['success'] =  False;
				 $data['error'] =  "No record found";
			}
			
		}
		else{
			$data['success'] =  False;
		}
		 echo json_encode($data);
	
	}
	
	public function get_prescription_report()
	{
	  //$users_id = $this->input->get_post('users_id');
      $animal_id = $this->input->get_post('animal_id');	
    /*   if(!isset($users_id) || !$users_id){
			$data['error'] =  "users id is required";
			} */
	 if(!isset($animal_id) || !$animal_id){
	      $data['error'] =  "animal id is required";
	    }
		
	  if(empty($data['error']))
		{
			$report = $this->api_model->get_prescription_report($animal_id);
			$prescription_id = $report->prescription_id;
			$test_report = $this->api_model->get_prec_test_report($prescription_id);	  
			 if($report){
				  $data['success'] =  TRUE;
				  $data['data']['rescreption'] =  $report;
				  if($test_report)
				  {
					   $data['data']['test_report'] =  $report;
				  }
			}
			else
			{
				   $data['success'] =  False;
				   $data['error'] =  "No record Found";
		    }
		}
		else{
			 $data['success'] =  False;
		}
		 echo json_encode($data);
	}
	public function tert_req_ac_re(){
		$doc_id = $this->input->get_post('doc_id');
		$users_id = $this->input->get_post('users_id');
		$request_id = $this->input->get_post('request_id');
		$animal_id = $this->input->get_post('animal_id');
		$request_type = $this->input->get_post('type');
		$users_type = $this->input->get_post('users_type');
		$time = $this->input->get_post('time');
		$re = $this->api_model->get_request_by_id($request_id);
	    if(!isset($users_id) || !$users_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "users id is required";
	    }if(!isset($request_id) || !$request_id){
					$data['success'] =  FALSE;
	      	$data['error'] =  "Request id is required";
	    }if(!isset($request_type) || !$request_type){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Request Type id is required";
	    }else{
			$data1['status'] = $request_type;
			if($request_type == 1){
				$data1['status'] = '1';
				$data1['time'] = $time;
			}
			if($users_type == 'pvt_ai' || $users_type == 'pvt_vt'){
				$data1['vt_id'] = $doc_id;
				if($request_type == 2){
					$request_detail = $this->api_model->get_request_detail($request_id, '');
					$data1['vt_id'] = '';
					$data1['status'] = '0';
					$rej['vt_id'] = $doc_id;
					$rej['request_id'] = $request_id;
					$rej['updated_date'] = date('Y-m-d h:i:s');                    
					$this->api_model->submit('vt_requests_rejection_log', $rej);
					//if(!empty($request_detail)){
					
						// $animal_data['treatment_status'] = '0';
						// $this->api_model->animal_table_update($animal_id,$animal_data);
					//}
					// explode
					// print_r($request_detail);
					// exit;
					if($request_detail[0]['order_type'] == '0'){
					if($request_type == 1){
						$req = "Accepted";
						$data1['status'] = '1';
					}if($request_type == 2){
						$req = "Rejected";
						$data1['status'] = '2';
					}if($request_type == 3){
						$req = "Cancelled";
						$data1['status'] = '3';
					}if($request_type == 4){
						$req = "Closed";
						$data1['status'] = '4';
					}
					$detail = $this->api_model->change_request_status($request_id,$data1);
					if($request_type == '1'){
						if($req_detai[0]['treat_type'] == '3'){
							$msg1 = "Your request has been accepted by AI worker ".$vt[0]['vt_name']." and  will be available there with in ".$time;
							$title = "AI Request";
						}if($req_detai[0]['treat_type'] == '1'){
							$msg1 = "Your request has been ".$req."";
							$title = "Vaccination Request";
						}else{
							$msg1 = "Your request has been ".$req."";
							$title = "AI Request";
						}
					}else{
						if($req_detai[0]['treat_type'] == '1'){
							$msg1 = "Your request has been ".$req."";
							$title = "Vaccination Request";
						}else{
							$msg1 = "Your request has been ".$req."";
							$title = "AI Request";
						}
					}
					// print_r($request_detail);
					// echo "this is test";
					// exit;
					//$detail = $this->api_model->change_request_status($request_id,$data1);
				
						// echo "this is test";
						// exit;
						$data['success'] =  TRUE;
						$data['msg'] =  $msg1;
						$msg['message'] = $msg1;
						$msg['users_id'] = $users_id;
						$msg['type'] = 1;
						$msg['title'] = $title;
						$msg['date'] = date('Y-m-d h:i:s'); 
						//$re = $this->api_model->get_request_by_id($request_id);
						//print_r($re);
						//$this->Pushnoti_model->insert_noti($msg);
						$th= $this->api_model->get_doctor_info($re[0]['vt_id']);
						$this->pushnoti_model->insert_noti($msg);
						$old_msg['to_users_id'] =  $users_id;
						$old_msg['to_id'] =  $users_id;
						$old_msg['to_type'] = 'users';
						$old_msg['title'] = $title;
						$old_msg['from_type'] = 'Livestoc Team';
						$old_msg['success'] = '1';
						$old_msg['device'] = 'android';
						$old_msg['active'] = '1'; 
						$old_msg['description'] = $msg1;
						$old_msg['date_added'] = date('Y-m-d h:i:s');
						$this->api_model->old_notification($old_msg);
						$this->push_non($users_id, 2 , $msg['title'], '1', $msg['message']);
						// $msg['message'] = 'You have new Treatment/ Vaccination request.';
						// $this->push_non($re[0]['vt_id'], 1 , $msg['title'], $msg['message'], $msg['title']);	
						$msg['message'] = "Request has been ".$req." by Paravet";
						$this->push_non($th->parent_id, 1 , $msg['title'], '1', $msg['message']);
					}
					$data['success'] =  true;
					$data['msg'] =  "This Request has been rejected";
				}else{
					
					$request_detail = $this->api_model->get_request_detail($request_id);
					$req_detai = $this->api_model->get_request_by_id($request_id);
					$vt = $this->api_model->get_vt_detail($doc_id);
					$rs = explode(',',$request_detail[0]['vt_id']);
					$cut = count($rs);
					if($cut == '1' && $request_detail[0]['status'] != '0'){
						// if($request_type == 2){
						// 	$data['success'] =  true;
						// 	$data['error'] =  "This Request has been rejected";
						// }else{	
							$data['success'] =  FALSE;
							$data['error'] =  "This Request has been already accepted by other";
						// }
					}else{
						$detail = $this->api_model->change_request_status($request_id,$data1);
						/* 2 = reject, 3 = cancel, 4 = closed */
						if($request_type == 3 || $request_type == 4){
							$animal_data['treatment_status'] = '0';
							$this->api_model->animal_table_update($animal_id,$animal_data);
						}
						if($request_type == 1){
							$req = "Accepted";
						}if($request_type == 2){
							$req = "Rejected";
						}if($request_type == 3){
							$req = "Cancelled";
						}if($request_type == 4){
							$req = "Closed";
						}
						if($request_type == '1'){
							if($req_detai[0]['treat_type'] == '3'){
								$msg1 = "Your request has been accepted by AI worker ".$vt[0]['vt_name']." and  will be available there with in ".$time;
								$title = "AI Request";
							}if($req_detai[0]['treat_type'] == '1'){
								$msg1 = "Your request has been ".$req."";
								$title = "Vaccination Request";
							}else{
								$msg1 = "Your request has been ".$req."";
								$title = "Treatment";
							}
						}else{
							if($req_detai[0]['treat_type'] == '1'){
								$msg1 = "Your request has been ".$req."";
								$title = "Vaccination Request";
							}else{
								$msg1 = "Your request has been ".$req."";
								$title = "Treatment";
							}
						}
						$data['success'] =  TRUE;
						$data['msg'] =  $msg1;
						if($request_detail[0]['order_type'] == '0'){
							$msg['message'] = $msg1;
							$msg['users_id'] = $users_id;
							$msg['type'] = 1;
							$msg['title'] = $title;
							$msg['date'] = date('Y-m-d h:i:s'); 
							//$re = $this->api_model->get_request_by_id($request_id);
							//print_r($re);
							//$this->Pushnoti_model->insert_noti($msg);
							$th= $this->api_model->get_doctor_info($re[0]['vt_id']);
							$this->pushnoti_model->insert_noti($msg);
							$old_msg['to_users_id'] =  $users_id;
							$old_msg['to_id'] =  $users_id;
							$old_msg['to_type'] = 'users';
							$old_msg['title'] = $title;
							$old_msg['from_type'] = 'Livestoc Team';
							$old_msg['success'] = '1';
							$old_msg['device'] = 'android';
							$old_msg['active'] = '1'; 
							$old_msg['description'] = $msg1;
							$old_msg['date_added'] = date('Y-m-d h:i:s');
							$this->api_model->old_notification($old_msg);
							$this->push_non($users_id, 2 , $msg['title'], '1', $msg['message']);
							// $msg['message'] = 'You have new Treatment/ Vaccination request.';
							// $this->push_non($re[0]['vt_id'], 1 , $msg['title'], $msg['message'], $msg['title']);	
							$msg['message'] = "Request has been ".$req." by Paravet";
							$this->push_non($th->parent_id, 1 , $msg['title'], '1', $msg['message']);
						}
					}
				}
				//print_r($request_detail);
				
			}else{
				$detail = $this->api_model->change_request_status($request_id,$data1);
				$req_detai = $this->api_model->get_request_by_id($request_id);
				$vt = $this->api_model->get_vt_detail($doc_id);
				// print_r($detail);
				// exit;
				/* 2 = reject, 3 = cancel, 4 = closed */
					if($request_type == 3 || $request_type == 4){
						$animal_data['treatment_status'] = '0';

						$this->api_model->animal_table_update($animal_id,$animal_data);
					}
					if($request_type == 1){
						$req = "Accepted";
					}if($request_type == 2){
						$req = "Rejected";
					}if($request_type == 3){
						$req = "Cancelled";
					}if($request_type == 4){
						$req = "Closed";
					}
					if($request_type == '1'){
						if($req_detai[0]['treat_type'] == '3'){
							$msg1 = "Your request has been accepted by AI worker ".$vt[0]['vt_name']." and  will be available there with in ".$time;
							$title = "AI Request";
						}else if($req_detai[0]['treat_type'] == '1'){
							$msg1 = "Your request has been ".$req."";
							$title = "Vaccination Request";
						}else{
							$msg1 = "Your request has been ".$req."";
							$title = "Treatment";
						}
					}else{
						if($req_detai[0]['treat_type'] == '1'){
							$msg1 = "Your request has been ".$req."";
							$title = "Vaccination Request";
						}else{
							$msg1 = "Your request has been ".$req."";
							$title = "Treatment";
						}
					}
					$data['success'] =  TRUE;
					$data['msg'] =  $msg1;
					$msg['message'] = $msg1;
					$msg['users_id'] = $users_id;
					$msg['type'] = 1;
					$msg['title'] = $title;
					$msg['date'] = date('Y-m-d h:i:s'); 
					//$re = $this->api_model->get_request_by_id($request_id);
					//print_r($re);
					//$this->Pushnoti_model->insert_noti($msg);
					$th= $this->api_model->get_doctor_info($re[0]['vt_id']);
					$this->pushnoti_model->insert_noti($msg);
					$old_msg['to_users_id'] =  $users_id;
							$old_msg['to_id'] =  $users_id;
							$old_msg['to_type'] = 'users';
							$old_msg['title'] = $title;
							$old_msg['from_type'] = 'Livestoc Team';
							$old_msg['success'] = '1';
							$old_msg['device'] = 'android';
							$old_msg['active'] = '1'; 
							$old_msg['description'] = $msg1;
							$old_msg['date_added'] = date('Y-m-d h:i:s');
							$this->api_model->old_notification($old_msg);
					$this->push_non($users_id, 2 , $msg['title'], '1',  $msg['message']);
					// $msg['message'] = 'You have new Treatment/ Vaccination request.';
					// $this->push_non($re[0]['vt_id'], 1 , $msg['title'], $msg['message'], $msg['title']);	
					$msg['message'] = "Request has been ".$req." by Paravet";
					$this->push_non($th->parent_id, 1 , $msg['title'], '1', $msg['message']);
				}
		}
		echo json_encode($data);
	}
	public function request_detail(){
		$request_id = $this->input->get_post('request_id');
		if(!isset($request_id) || !$request_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Request id is required";
	    }else{
			$ani_d = [];
			$r =[];
			$detail = $this->api_model->get_request_by_id($request_id);
			if($detail[0]['users_id'] != '')
			$user_data = $this->api_model->get_user_info_id($detail[0]['users_id']);
		//print_r($user_data);
			$treatment_image = $this->api_model->cheack_tretment_image($detail[0]['request_id']);
			if($treatment_image){
				$user_data[0]['treatment_image'] = '1';
			}else{
				$user_data[0]['treatment_image'] = '0';
			}
			$request_det = $this->api_model->request_detail($request_id);
			$user_data[0]['address'] = $request_det[0]['address'];
			$user_data[0]['latitude'] = $request_det[0]['latitude'];
			$user_data[0]['langitude'] = $request_det[0]['langitude'];
			$user_data[0]['treat_type'] = $request_det[0]['treat_type'];
			if($request_det[0]['treat_type'] == 3){
				//$request_det[0]['treat_type']
				$seman_data = $this->api_model->get_seman_detail($request_det[0]['vacc_id']);
				$user_data[0]['seman_price'] = $seman_data[0]['price'] + $seman_data[0]['vt_ai_price'];
				$breed_name = $this->api_model->get_animal_breed($seman_data[0]['bread']);
			}else{
				$user_data[0]['seman_price'] = '';
			}
			$user_data[0]['date'] = $request_det[0]['date'];
			$image = IMAGE_PATH.'uploads_new/profile/thumb/'.$user_data[0]['image'];
			$file = $image ;
			//$file = 'http://www.domain.com/somefile.jpg';
			$file_headers = @get_headers($file);
			if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
				$user_data[0]['image'] = 'https://www.livestoc.com/harpahu_merge/uploads/animal/'.$user_data[0]['image'];
			}
			else {
				$user_data[0]['image'] = $file;
			}
			foreach($detail as $d){
				$log_data = $this->api_model->get_data('id = '.$d['log_id'].'','log_file');
				$d['payment_status'] = $log_data[0]['request_type'];
				$d['paid_amount'] = $log_data[0]['amount'];
				//if($log_data[0]['request_type'] == '2'){
					$wall = $this->api_model->get_data('log_id = '.$d['log_id'].'', 'livestoc_wallets');
					$d['wallet_amount'] = $wall[0]['amount'];
					$d['due_amount'] = $log_data[0]['amount'] - $wall[0]['amount'];
				//}
				$animal_data = $this->api_model->get_animal_ani_id($d['animal_id']);
					$animal_img = $this->api_model->get_animal_image($d['animal_id']);
					//print_r($animal_img);
					$animal_detail = $this->api_model->get_data('animal_id = "'.$d['animal_id'].'"' , 'animals_detail', '', '');
					$get_payment =  $this->api_model->get_user_payment($d['request_id']);
				if($d['treat_type'] == '3'){
					//if($d['vacc_id'] != '')
					$seman_data = $this->api_model->get_seman_detail($d['vacc_id']);
					$animal_breed = $this->api_model->get_animal_breed($seman_data[0]['bread']);
					$d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
					$animal_category = $this->api_model->get_animal_category($seman_data[0]['category']);
					$d['seman_category'] = $animal_category[0]['category'];
					$d['seman_price'] = $seman_data[0]['price'];
					$group = $this->api_model->get_data('id = "'.$seman_data[0]['groups'].'"', 'semen_group','','*');
					$d['seman_groups'] = $group[0]['group'];
					if(!is_null($seman_data[0]['id'])){
						$d['semen_tag_no'] = 'LIVE_'.$seman_data[0]['id'];
					}else{
						$d['semen_tag_no'] = '';
					}
					$d['vt_price'] = $seman_data[0]['vt_ai_price'];
					$d['semen_bull_no'] = $seman_data[0]['bull_no'];
					$d['semen_bull_id'] = $seman_data[0]['id'];
					$d['semen_groups'] = $seman_data[0]['groups'];
				}	
				
				// $vacc_array = explode(',', $d['vacc_id']);
				// foreach($vacc_array as $v_arr){

				// }
				$d['total_coustomer_payment'] = isset($get_payment[0]['amount']) ? $get_payment[0]['amount'] : '';
				$animal_breed = $this->api_model->get_animal_breed($animal_data[0]['breed_id']);
				$d['animal_breed'] = $animal_breed[0]['breed_name']; 
				$animal_category = $this->api_model->get_animal_category($animal_data[0]['category_id']);
				$d['animal_category'] = $animal_category[0]['category']; 
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
				//echo "<pre>";
				//print_r($d);
				if($d['treat_type'] == 1){
					$pack_data = $this->api_model->get_data('vacc_id = "'.$d['vacc_id'].'"', 'package_masters');
					$d['package_name'] = $pack_data[0]['package_name'];
					$d['package_price'] = $pack_data[0]['package_price'];
					$d['package_doc_price'] = $pack_data[0]['doc_price'];
					$this->api_model->get_data('request_id = '.$d['id'].'', 'vt_request_tracking');
					$vacc_data = $this->api_model->get_data('request_id = '.$d['id'].'', 'vt_request_tracking');
					if($d['vacc_id'] != ''){
						$i = 0;
						foreach($vacc_data as $v_d){
							$d_v = $this->api_model->get_data('vaccination_id = '.$v_d['vacc_id'].'','vaccination');
							$dv_v[$i]['sub_request'] = $v_d['id'];
							$dv_v[$i]['treat_status'] = $v_d['treat_status'];
							$dv_v[$i]['vacc_name'] = $d_v[0]['name'];
							$dv_v[$i]['vacc_description'] = $d_v[0]['short_desc'];
							$dv_v[$i]['reschedule_date'] = $v_d['reschedule_date'];
							$i++;
						}
						//$vacc_detail = $this->api_model->get_vacc_detail_id($d['vacc_id']);
						$vacc_detail = $dv_v;
					}
				}
				$d['animal_name'] = $animal_data[0]['fullname'];
				$d['tag_no'] = $animal_data[0]['tag_no'];
				if($animal_data[0]['age'] != ''){
					$d['animal_age'] = $animal_data[0]['age'];
					$d['animal_age_month'] = $animal_data[0]['age_month'];
				}else{
					$d['animal_age'] = $animal_detail[0]['animal_age'];
					$d['animal_age_month'] = $animal_detail[0]['animal_month'];
				}
					$img = $this->api_model->get_animal_image($d['animal_id']);
					//$imm= [];
                    //foreach($img as $im){
						$file = base_url().'uploads/animal/'.$img[0]['images'];
						$handlerr = curl_init($file);
						curl_setopt($handlerr,  CURLOPT_RETURNTRANSFER, TRUE);
						$resp = curl_exec($handlerr);
						$ht = curl_getinfo($handlerr, CURLINFO_HTTP_CODE);
						if ($ht == '404'){
							$ani_tret['image'] = 'https://www.livestoc.com/uploads_new/animals/thumb/'.$img[0]['images'];
						}
						else {
							$ani_tret['image'] = $file;
						}
					//}
				// $defaultimage = $animal_img[0]['images'];
				// //$ani_tret['image'] = base_url().'uploads/animal/'.$defaultimage;
				// $file = base_url().'uploads/animal/'.$defaultimage;
				// $file_headers = @get_headers($file);
				// if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
				// 	$ani_tret['image'] = $file;
				// }
				// else {
				// 	$ani_tret['image'] = IMAGE_PATH.'uploads_new/animals/'.$defaultimage;;
				// }
				//$d['image'] =  $animal_img[0]['images'];
				$d['image'] =  $ani_tret['image'];
				if($d['treat_type'] != 3){
					$d['vacc_detail'] = $vacc_detail;
				}else{
					$d['vacc_detail'] = [];
				}
				$d['seman_breed'] = $d['seman_bread_name'];
				$d['invoice'] =  base_url('package/invoice/').$d['Invoice_id'];
				$r[] = $d;
			}
			//print_r($r);
			$ani_d['animal_detail'] = array_values($r);
			$ani_d['user_data'] = array_values($user_data);
			$ani_d['order_type'] =  $request_det[0]['order_type'];
			$data['success'] =  True;
			$data['data'] =  $ani_d; 
		}
		echo json_encode($data);
	} 
	public function doc_loc_upadate(){
		$id = $this->input->get_post('doctor_id');
		$lan = $this->input->get_post('langitude');
		$lat = $this->input->get_post('latitude');
		if(!isset($id) || !$id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Doctor id is required";
		}else if(!isset($lan) || !$lan){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Longitude is required";
	    }else if(!isset($lat) || !$lat){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Latitude is required";
	    }else{
			$json['doctor_id'] = $id;
			$de = $this->api_model->cheak_doc_loc($id);
			$json['langitute'] = $lan;
			$json['lantitute'] = $lat;
			if(empty($de)){
				if($this->api_model->insert_doc_loc($json)){
					$data['success'] =  TRUE;
	      			$data['msg'] =  "Inserted sussefully";
				}else{
					$data['success'] =  False;
	      			$data['msg'] =  "There is problem with database";
				}
			}else{
				if($this->api_model->update_doc_loc($id, $json)){
					$data['success'] =  TRUE;
	      			$data['msg'] =  "Update sussefully";
				}else{
					$data['success'] =  False;
	      			$data['msg'] =  "There is problem with database";
				}
			}
		}
		echo json_encode($data);
	}
	public function get_doc_loc(){
		$id = $this->input->get_post('doctor_id');
		//$lat = $this->input->get_post('latitude');
		if(!isset($id) || !$id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Doctor id is required";
		}else{
			$de = $this->api_model->cheak_doc_loc($id);
			$data['success'] =  True;
	      	$data['data'] =  $de;
		}
		echo json_encode($data);
	}
	public function get_push_note(){
		$id = $this->input->get_post('users_id');
		if(!isset($id) || !$id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "User id is required";
		}else{
			$detail = $this->pushnoti_model->get_puch_note($id);
			$data['success'] =  TRUE;
	      	$data['data'] =  $detail;
		}
		echo json_encode($data);
	}
	public function priccription_send_doc(){
		$request_id = $this->input->get_post('request_id');
		$map_id = $this->input->get_post('id');
		$simtoms = $this->input->get_post('simtoms');
		$suggetions = $this->input->get_post('simtoms_text');
		$symptoms_image = $this->input->get_post('symptoms_image');
		$animal_id = $this->input->get_post('animal_id');
		$users_id = $this->input->get_post('users_id');
		$vt_id = $this->input->get_post('vt_id');
		if(!isset($request_id) || !$request_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Request id is required";
		}else if(!isset($map_id) || !$map_id){
					$data['success'] =  FALSE;
	      	$data['error'] =  "id is required";
		}else if(!isset($animal_id) || !$animal_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Animal id is required";
		}else if(!isset($users_id) || !$users_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "User id is required";
		}else if(!isset($vt_id) || !$vt_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "VT id is required";
		}else{
			$simtoms = json_decode($simtoms);
			if(is_array($simtoms)){
				$simtoms = implode(',',$simtoms);
			}
			$de = $this->api_model->get_doc_id($vt_id);
			$json['request_id'] = $request_id;
			$json['animal_id'] = $animal_id;
			$json['users_id'] = $users_id;
			$json['map_id'] = $map_id;
			$json['date'] = date('Y-m-d');
			$json['prescription'] = '';
			$json['simtoms'] =$simtoms;
			$json['symptoms_image'] = isset($symptoms_image) ? $symptoms_image : '';
			$json['blod_test'] = '';
			$json['suggetions'] = $suggetions;
			$json['price'] = '';
			$json['vt_id']= $vt_id;
			$json['doc_id'] = $de[0]['parent_id'];
			if($this->api_model->insert_prescription($json)){
				$req['presc_status'] = '1';
				$this->api_model->change_status_treat($map_id, $req);
				$data['success'] =  True;
						$data['msg'] =  "Your Prescription has been Sent";
						$ms = "Your Prescription has been Sent";
						$msg['message'] = $ms;
						$msg['users_id'] = $users_id;
						$msg['type'] = 1;
						$msg['title'] = "Prescription Request #".$animal_id;
						$msg['date'] = date('Y-m-d h:i:s'); 
						$this->pushnoti_model->insert_noti($msg);
						// $this->push_non($vt_id, 1 , $msg['title'], $msg['message'], $msg['title']);	
						// $msg['message'] = 'Your Animal Prescription has been sent to the Doctor';
						//$this->push_non($users_id, 0 , $msg['title'], $msg['message'], $msg['title']);
						$msg['message'] = 'You have new Prescription Request #'.$animal_id;
						$this->push_non($de[0]['parent_id'], 1 , $msg['title'], $msg['message'], $msg['title']);					
			}else{
				$data['success'] =  false;
	      		$data['msg'] =  "Database Error";
			}
		}
		echo json_encode($data);
	}
	public function test_push(){
		$msg['message'] = "your vactination is done";
		$msg['title'] = "Treatment /Vaccination";
		$this->push_non('2739', 1 , $msg['title'], $msg['message'], $msg['title']);
		//$de = $this->push_non('2739', '1');
	}
	public function push_non($user_id, $type , $title, $flag = 0, $msg){
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
	public function check_prescription(){
		$request_id = $this->input->get_post('request_id');
		$animal_id = $this->input->get_post('animal_id');
		$users_id = $this->input->get_post('users_id');
		$id = $this->input->get_post('id');
		$vt_id = $this->input->get_post('vt_id');
		if(!isset($request_id) || !$request_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Request id is required";
		}else if(!isset($animal_id) || !$animal_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "Animal id is required";
		}else if(!isset($users_id) || !$users_id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "User id is required";
		}else if(!isset($id) || !$id){
			$data['success'] =  FALSE;
	      	$data['error'] =  "id is required";
		}else if(!isset($vt_id) || !$vt_id){
					$data['success'] =  FALSE;
	      	$data['error'] =  "VT id is required";
		}else{
				$detail = $this->api_model->check_pre($request_id, $animal_id, $users_id, $id, $vt_id);
				if(empty($detail[0]['prescription'])){
					$data['success'] =  FALSE;
					$data['error'] =  "Your Prescription Not Genrated Yet";
				}else{
					$some = [];
					foreach($detail as $de){
							$size = explode(',',$de['size']);
							$days = explode(',',$de['days']);
							$doze = explode('-',$de['doze_time']);
							$pils = $this->api_model->get_pils_det($de['prescription']);
							$i = 0;
							$pill_data = [];
							foreach($pils as $p){
									$p['doses'] = $size[$i];
									$p['interval'] = explode(',',$doze[$i]);
									$p['days'] = $days[$i];
									$pill_data[]= $p;
									$i++;
							}
							unset($de['size']);
							unset($de['doze_time']);
							if(isset($de['test_id']) && $de['test_id'] != ''){
							$test = $this->api_model->get_test_det($de['test_id']);
							$te = [];
								foreach($test as $t){
									$fr =  $this->api_model->get_test_pic($t['id'], $detail[0]['id']);
									$t['image'] = isset($fr[0]['image']) ? base_url().'uploads/test/'.$fr[0]['image'] : '';
									$te[] = $t;
								}
							}else{
								$te = [];
							}
							$sim = $this->api_model->get_simtoms_det($de['simtoms']);
							$de['prescription']	= $pill_data;
							$de['test_id']	= $te;
							$de['simtoms'] = $sim;
							$de['blod_test'] = isset($de['blod_test']) ? base_url().'uploads/blood/'.$de['blod_test'] : '';
							$some[]=  $de;
					}
					$data['success'] =  TRUE;
	      	$data['data'] =  $some;
				}
		}
		echo json_encode($data);
	 }
	 public function get_simtoms(){
		 $detail = $this->api_model->get_total_simtoms();
		 if($detail){
			$data['success'] =  TRUE;
			$data['data'] =  $detail;
		 }else{
			$data['success'] =  FALSE;
			$data['data'] =  "There is no record found";
		 }
		 echo json_encode($data);
	 }
	 public function treatment_start_com(){
			 $sub_request_id = $this->input->get_post('sub_request_id');
			 $request_type = $this->input->get_post('treat_status');
			 $otp = $this->input->get_post('otp');
			 $preg_status = $this->input->get_post('preg_status');
			 $strow_no = $this->input->get_post('strow_id');
			 $bull_id = $this->input->get_post('bull_id');
			 if(!isset($sub_request_id) || !$sub_request_id){
						$data['success'] =  FALSE;
						$data['error'] =  "Sub Request id is required";
			 }if(!isset($request_type) || !$request_type){
						$data['success'] =  FALSE;
						$data['error'] =  "Request Type is required";
	 		 }else{
						if($request_type == '6'){
							$reschedule_date = $this->input->get_post('reschedule_date');
							if(!isset($reschedule_date) || !$reschedule_date){
								$data['success'] =  FALSE;
								$data['error'] =  "Reschedule Date is required";
							}else{
									if(!isset($otp) || !$otp){
										$data['success'] =  FALSE;
										$data['error'] =  "OTP is required";
									}else{
												if($data_req =$this->api_model->get_opt_request($sub_request_id, $otp)){
													$request_detail = $this->api_model->get_subrequest_by_id($sub_request_id);
													$r_data['request_id'] = $request_detail[0]['request_id']; 
													$r_data['user_id'] = $request_detail[0]['user_id'];
													$r_data['animal_id'] = $request_detail[0]['animal_id'];
													$r_data['treat_type'] = $request_detail[0]['treat_type'];
													$r_data['vacc_id'] = $request_detail[0]['vacc_id'];
													$r_data['vt_id'] = $request_detail[0]['vt_id'];
													$r_data['treat_status'] = '6';
													$r_data['status'] = '1';
													$r_data['type'] = '0';
													$r_data['otp'] = rand(1000,9999);
													$r_data['reschedule_date'] = $reschedule_date;
													$r_data['date'] = date('Y-m-d');
													$this->api_model->insert_vt_track_request($r_data);
													$json['treat_status']= '4';
													$this->api_model->change_status_treat($sub_request_id, $json);
													$data['success'] =  TRUE;
													$data['msg'] =  'Your treatment has been Rescheduled';
													$ms = "Your treatment has been Rescheduled";
													$msg['message'] = $ms;
													$msg['users_id'] = $request_detail[0]['user_id'];
													$msg['type'] = 1;
													$msg['title'] = "Treatment";
													// $th= $this->api_model->get_doctor_info($vt_id);
													$this->pushnoti_model->insert_noti($msg);

													$old_msg['to_users_id'] =  $request_detail[0]['user_id'];
													$old_msg['to_id'] =  $request_detail[0]['user_id'];
													$old_msg['to_type'] = 'users';
													$old_msg['title'] = $msg['title'];
													$old_msg['from_type'] = 'Livestoc Team';
													$old_msg['success'] = '1';
													$old_msg['device'] = 'android';
													$old_msg['active'] = '1'; 
													$old_msg['description'] = $data['msg'];
													$old_msg['date_added'] = date('Y-m-d h:i:s');
													$this->api_model->old_notification($old_msg);
													$msg['message'] = 'Your treatment has been Rescheduled.';
													$this->push_non($data_req[0]['user_id'], 0 , $msg['title'], $msg['message'], $msg['title']);
													// $msg['message'] = 'You have new Treatment/ Vaccination request.';
													// $this->push_non($request_detail[0]['vt_id'], 1 , $msg['title'], $msg['message'], $msg['title']);	
													$msg['message'] = 'Treatment has been Rescheduled.';
													$this->push_non($request_detail[0]['doc_id'], 1 , $msg['title'], $msg['message'], $msg['title']);
												}else{
													$data['success'] =  FALSE;
													$data['error'] =  'Mismatch OTP';
												}
									}
							}
						}else{
							if($request_type == '4'){
								if(!isset($otp) || !$otp){
									$data['success'] =  FALSE;
									$data['error'] =  "OTP is required";
								}else{
												if($data_req = $this->api_model->get_opt_request($sub_request_id, $otp)){
														$gen_req = $this->api_model->get_super_request_by_id($data_req[0]['request_id']);
															if(isset($gen_req[0]['treat_type']) && $gen_req[0]['treat_type'] == '5'){
																		if(!isset($preg_status)){
																			//$data['some'] = $preg_status;
																			$data['success'] =  FALSE;
																			$data['error'] =  "Pregnancy status is required";
																		}else{
																			$json['pregnancy_status'] = $preg_status;
																			$json['treat_status']= '4';
																			$json['status'] = '4';
																			$this->api_model->change_status_treat($sub_request_id, $json);
																			if($this->api_model->get_subrequest_by_id_status($data_req[0]['request_id'])){
																				$some['status'] = '4';
																				$this->api_model->change_super_request($data_req[0]['request_id'], $some);
																				$ani_status['treatment_status'] = '0';
																				$this->api_model->change_animal_status($data_req[0]['animal_id'], $ani_status);
																			}
																			$data['success'] =  TRUE;
																			$data['msg'] =  'Your treatment has been Closed';
																			$ms = "Your treatment has been Closed";
																			$msg['message'] = $ms;
																			$msg['users_id'] = $data_req[0]['user_id'];
																			$msg['type'] = 1;
																			$msg['title'] = "Treatment";
																			// $th= $this->api_model->get_doctor_info($vt_id);
																			$this->pushnoti_model->insert_noti($msg);
																			$msg['message'] = 'Your treatment has been Closed.';
																			$this->push_non($data_req[0]['user_id'], 0 , $msg['title'], $msg['message'], $msg['title']);
																			$old_msg['to_users_id'] =  $data_req[0]['user_id'];
																			$old_msg['to_id'] =  $data_req[0]['user_id'];
																			$old_msg['to_type'] = 'users';
																			$old_msg['title'] = $msg['title'];
																			$old_msg['from_type'] = 'Livestoc Team';
																			$old_msg['success'] = '1';
																			$old_msg['device'] = 'android';
																			$old_msg['active'] = '1'; 
																			$old_msg['description'] = $ms;
																			$old_msg['date_added'] = date('Y-m-d h:i:s');
																			$this->api_model->old_notification($old_msg);
																			// $msg['message'] = 'You have new Treatment/ Vaccination request.';
																			// $this->push_non($gen_req[0]['vt_id'], 1 , $msg['title'], $msg['message'], $msg['title']);	
																			$msg['message'] = 'Your treatment has been Closed.';
																			$this->push_non($data_req[0]['doc_id'], 1 , $msg['title'], $msg['message'], $msg['title']);
																		}
															}else if(isset($gen_req[0]['treat_type']) && $gen_req[0]['treat_type'] == '3'){
																if(!isset($strow_no)){
																	//$data['some'] = $preg_status;
																	$data['success'] =  FALSE;
																	$data['error'] =  "Strow No Required";
																}else{
																	//strow_no
																	$ai_data['user_id'] = $gen_req[0]['users_id'];
																	$ai_data['animal_id'] = $gen_req[0]['animal_id'];
																	$ai_data['doc_id'] = $gen_req[0]['vt_id'];
																	$ai_data['bull_id'] = $bull_id;
																	$ai_data['bull_stro_no'] = $strow_no;
																	$ai_data['sub_request_id'] = $sub_request_id;
																	$json['treat_status']= '4';
																			$json['status'] = '4';
																			$this->api_model->change_status_treat($sub_request_id, $json);
																			if($this->api_model->get_subrequest_by_id_status($data_req[0]['request_id'])){
																				$some['status'] = '4';
																				$this->api_model->change_super_request($data_req[0]['request_id'], $some);
																				$ani_status['treatment_status'] = '0';
																				$this->api_model->change_animal_status($data_req[0]['animal_id'], $ani_status);
																				$this->api_model->input_ai_record($ai_data);
																			}
																			$data['success'] =  TRUE;
																			$data['msg'] =  'Your AI has been Done';
																			$ms = "Your AI has been Done";
																			$msg['message'] = $ms;
																			$msg['users_id'] = $data_req[0]['user_id'];
																			$msg['type'] = 1;
																			$msg['title'] = "AI";
																			// $th= $this->api_model->get_doctor_info($vt_id);
																			$this->pushnoti_model->insert_noti($msg);
																			$msg['message'] = 'Your treatment has been Done.';
																			$this->push_non($data_req[0]['user_id'], 0 , $msg['title'], $msg['message'], $msg['title']);
																			$old_msg['to_users_id'] =  $data_req[0]['user_id'];
																			$old_msg['to_id'] =  $data_req[0]['user_id'];
																			$old_msg['to_type'] = 'users';
																			$old_msg['title'] = $msg['title'];
																			$old_msg['from_type'] = 'Livestoc Team';
																			$old_msg['success'] = '1';
																			$old_msg['device'] = 'android';
																			$old_msg['active'] = '1'; 
																			$old_msg['description'] = $ms;
																			$old_msg['date_added'] = date('Y-m-d h:i:s');
																			$this->api_model->old_notification($old_msg);
																			// $msg['message'] = 'You have new Treatment/ Vaccination request.';
																			// $this->push_non($gen_req[0]['vt_id'], 1 , $msg['title'], $msg['message'], $msg['title']);	
																			$msg['message'] = 'Your treatment has been Closed.';
																			$this->push_non($data_req[0]['doc_id'], 1 , $msg['title'], $msg['message'], $msg['title']);
																}
															}else{
															
																	//echo $data_req[0]['request_id'];
																	$json['treat_status']= '4';
																	$json['status'] = '4';
																	$this->api_model->change_status_treat($sub_request_id, $json);
																	if($this->api_model->get_subrequest_by_id_status($data_req[0]['request_id'])){
																		$some['status'] = '4';
																		$this->api_model->change_super_request($data_req[0]['request_id'], $some);
																		$ani_status['treatment_status'] = '0';
																		$this->api_model->change_animal_status($data_req[0]['animal_id'], $ani_status);
																	}
																	// print_r($data_req);
																	// exit;
																	$data['success'] =  TRUE;
																	$data['msg'] =  'Your treatment has been Closed';
																	$ms = "Your treatment has been Closed";
																			$msg['message'] = $ms;
																			$msg['users_id'] = $data_req[0]['user_id'];
																			$msg['type'] = 1;
																			$msg['title'] = "Treatment";
																			// $th= $this->api_model->get_doctor_info($vt_id);
																			$this->pushnoti_model->insert_noti($msg);
																			$msg['message'] = 'Your treatment has been Closed.';
																			$this->push_non($data_req[0]['user_id'], 0 , $msg['title'], $msg['message'], $msg['title']);
																			$old_msg['to_users_id'] =  $data_req[0]['user_id'];
																			$old_msg['to_id'] =  $data_req[0]['user_id'];
																			$old_msg['to_type'] = 'users';
																			$old_msg['title'] = $msg['title'];
																			$old_msg['from_type'] = 'Livestoc Team';
																			$old_msg['success'] = '1';
																			$old_msg['device'] = 'android';
																			$old_msg['active'] = '1'; 
																			$old_msg['description'] = $ms;
																			$old_msg['date_added'] = date('Y-m-d h:i:s');
																			$this->api_model->old_notification($old_msg);
																			// $msg['message'] = 'You have new Treatment/ Vaccination request.';
																			// $this->push_non($gen_req[0]['vt_id'], 1 , $msg['title'], $msg['message'], $msg['title']);	
																			$msg['message'] = 'Your treatment has been Closed.';
																			$this->push_non($data_req[0]['doc_id'], 1 , $msg['title'], $msg['message'], $msg['title']);
															}
												}else{
													$data['success'] =  FALSE;
													$data['error'] =  'Mismatch OTP';
												}
								}
							}else{
								$json['treat_status']= $request_type;
								$this->api_model->change_status_treat($sub_request_id, $json);
								$request_detail = $this->api_model->get_subrequest_by_id($sub_request_id);
								$data['success'] =  TRUE;
								$data['msg'] =  'Your treatment has been started';
								$ms = "Your treatment has been started";
																			$msg['message'] = $ms;
																			$msg['users_id'] = $data_req[0]['user_id'];
																			$msg['type'] = 1;
																			$msg['title'] = "Treatment";
																			// $th= $this->api_model->get_doctor_info($vt_id);
																			// $this->pushnoti_model->insert_noti($msg);
																			$msg['message'] = 'Treatment has been started.';
																			$this->push_non($data_req[0]['user_id'], 0 , $msg['title'], $msg['message'], $msg['title']);
																			$old_msg['to_users_id'] =  $data_req[0]['user_id'];
																			$old_msg['to_id'] =  $data_req[0]['user_id'];
																			$old_msg['to_type'] = 'users';
																			$old_msg['title'] = $msg['title'];
																			$old_msg['from_type'] = 'Livestoc Team';
																			$old_msg['success'] = '1';
																			$old_msg['device'] = 'android';
																			$old_msg['active'] = '1'; 
																			$old_msg['description'] = $ms;
																			$old_msg['date_added'] = date('Y-m-d h:i:s');
																			$this->api_model->old_notification($old_msg);
																			// $msg['message'] = 'You have new Treatment/ Vaccination request.';
																			// $this->push_non($request_detail[0]['vt_id'], 1 , $msg['title'], $msg['message'], $msg['title']);	
																			$msg['message'] = 'Treatment has been started';
																			$this->push_non($request_detail[0]['doc_id'], 1 , $msg['title'], $msg['message'], $msg['title']);
							}						
						}
			 }
			 echo json_encode($data);
	 }
	 public function get_pharmacy(){
			$data = $this->api_model->get_pharmacy();
			$json['success'] =  TRUE;
			$json['data'] = $data;
			echo json_encode($json);
	 }
	 public function get_lab_test(){
		$data = $this->api_model->get_lab_test();
		$json['success'] =  TRUE;
		$json['data'] = $data;
		echo json_encode($json);
 }
	 public function submit_prescription(){
				$treat_id = $this->input->get_post('treat_id');
				$suggestion = $this->input->get_post('suggestion');
				$sub_request_id = $this->input->get_post('sub_request_id');
				$prescription = $this->input->get_post('prescription');
				//$size = $this->input->get_post('size');
				$test_id = $this->input->get_post('test_id');
				//$dozes = $this->input->get_post('dozes');
				$blod_test = $this->input->get_post('blod_test');
				if(!isset($treat_id) || !$treat_id){
					$json['success'] =  FALSE;
					$json['error'] =  "Treatment id is required";
				}else{
					$data = json_decode($prescription);
					$i=0;
								foreach($data as $d){
									//print_r($d);
													if($i == 0){
														$days = $d->days;
														$doses = $d->doses;
														$int = json_decode($d->interval);
														$y = 0;
															foreach($int as $in){
																	if($y == 0){
																			$interval = $in;
																	}else{
																			$interval .= ','.$in;
																	}
																	$y++;
															}
														$interval = $interval;
														$name = $d->name;
													}else{
																		$intro = $interval;
																		$days .= ','.$d->days;
																		$doses .= ','.$d->doses;
																		$int = json_decode($d->interval);
																		$y = 0;
																			foreach($int as $in){
																					if($y == 0){
																							$interval = $in;
																					}else{
																							$interval .= ','.$in;
																					}
																					$y++;
																			}
																		$intro .= '-'.$interval;
																		$name .= ','.$d->name;
													}
											$i++; 
								}
					$data1['prescription'] = $name;
					$data1['size'] = $doses;
					$data1['days'] = $days;
					$data1['doze_time'] = isset($intro) ? $intro : $interval;
					$data1['doc_suggetions'] = $suggestion;
					$i = 0;
					$test_id = json_decode($test_id);
					foreach($test_id as $t){
						if($i == 0){
							$te = $t;
						}else{
							$te .= ','.$t;
						}
						$i++;
					}
					$data1['test_id'] = $te;
					$data1['blod_test_status'] = $blod_test;
					$data1['status'] = '1';
					if($this->api_model->update_treat_data($treat_id, $data1)){
						$req['presc_status'] = '1';
						$this->api_model->change_status_treat($sub_request_id, $req);
						$json['success'] =  True;
						$json['msg'] =  "Your Prescription is successfully sent.";
						$treat_data = $this->api_model->get_treet_id($treat_id);
						$ms = "Your Prescription is successfully sent.";
						$msg['message'] = $ms;
						$msg['users_id'] = $treat_data[0]['users_id'];
						$msg['type'] = 1;
						$msg['title'] = "Prescription";
						// $th= $this->api_model->get_doctor_info($vt_id);
						//$this->pushnoti_model->insert_noti($msg);
						$msg['flag'] = 2;
						$msg['message'] = 'Your Prescription is successfully sent.';
						$this->push_non($treat_data[0]['users_id'], 0 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);
						$msg['message'] = 'You have new prescription.';
						$this->push_non($treat_data[0]['vt_id'], 1 , $msg['title'], $msg['flag'], $msg['message'], $msg['title']);
					}else{
						$json['success'] =  FALSE;
						$json['error'] =  "Database Error";
					}
				}
				echo json_encode($json);
	 }
	 public function add_vt_request()
	 {
			 	$users_id = $_REQUEST['users_id'];
				$animal_id = $_REQUEST['animal_id'];
				$treat_type = $_REQUEST['treat_type'];				
				$register_status = $_REQUEST['register_status'];
				$vacc_id = $_REQUEST['vacc_id'];
				$status = $_REQUEST['status'];
				$address = $_REQUEST['address'];
				$vt_type = $_REQUEST['vt_type'];
				$animal_simtoms = $_REQUEST['animal_simtoms'];
				//$symptoms_image=json_decode($_REQUEST['symptoms_image']);
				$otp = $_REQUEST['otp'];				
				if($otp='')
				{
					$json['error'] ='Incorrect otp';
				}			
				if (!isset($users_id) || $users_id == '') {
						$json['error'] = "users_id is required";
				}
				if (!isset($animal_id) || $animal_id == '') {
						$json['error'] = "animal_id is required";
				}
				if (!isset($treat_type) || $treat_type == '') {
						$json['error'] = "treat_type is required";
				}
	 			if (!isset($symptoms_image) || $symptoms_image == '') {
						$json['error'] = "symptoms_image Image is required";
				}
				if (!isset($register_status) || $register_status == '') {
						$json['error'] = "register_status is required";
				}
				if (!isset($vt_type) || $vt_type == '') {
						$json['error'] = "vt_type is required";
				}
				if (!isset($animal_simtoms) || $animal_simtoms == '') {
						$json['error']= "animal_simtoms is required";
				}
				//sell animal check
		 		//-0-fixed,1 - not fixed
				if(!$json)
					{
						if($users_id!= ''){
							$users_id = $this->api_model->insert_vt_request($users_id);
						}else{
							$users_id = '';
						} 
						$fieldvalues = [
													'users_id'                =>  $users_id,
													'animal_id'             =>  $animal_id,
													'treat_type'                => $treat_type,
													'register_status'             =>  $register_status,
													'vacc_id'                  =>  $vacc_id,
													'status'				  =>  $status,
													'address'                  =>  $address,
													'vt_type'                =>  $vt_type,
													'animal_simtoms'               =>  $animal_simtoms,
													'symptoms_image'          	=>  $symptoms_image, 
													'otp'         					=>  $otp,													
													'vt_id'							=> $vt_id,
													'date'					=> date('Y-m-d H:i:s')													
										];
								if($animal_id =  $this->api_model->insert_vt_request($fieldvalues)){
													$symptoms_image=json_decode($_REQUEST['symptoms_image']);
													foreach ($symptoms_image as $images) 
													{
														$field_images = [
														'animal_id'            =>  $animal_id,														
														'created'              =>  date('Y-m-d H:i:s')
														]; 
														$this->api_model->insert_vt_request($field_images);
													}											
													
						  
													$json['success'] = TRUE;
													$json['msg'] = "Your Animal Registered";
								}else{
									$json['success'] = FALSE;
									$json['error'] = "Error with database";
								}
					}
					else {
									$json['success'] = FALSE;
					}
					header('Content-Type: application/json');
					echo json_encode($json);
					exit;
	 }
	 public function add_animals()
	 {
			 	$users_id = $_REQUEST['users_id'];
				$category_id = $_REQUEST['category_id'];
				$breed_id = $_REQUEST['breed_id'];
				$admin_id = $_REQUEST['admin_id'];
				if($admin_id == ''){
					$isactivated = '0';
					$isaccepted = '0';
				}else{
					$isactivated = '1';
					$isaccepted = '1';
				}
				$animals_images=json_decode($_REQUEST['animals_images']);
				$animals_videos=json_decode($_REQUEST['animals_videos']);
				$tag_no = $_REQUEST['tag_no'];
				$private_ai = $_REQUEST['vt_id'];
				$fullname = $_REQUEST['fullname'];
				$latitude = $_REQUEST['latitude'];
				$longitude = $_REQUEST['longitude'];
				$animal_age = $_REQUEST['animal_age'];
				$animal_month = $_REQUEST['animal_month'];
				$gender = $_REQUEST['gender'];
				$club_reg_no = $_REQUEST['club_reg_no'];
				$club_name = $_REQUEST['club_name'];
				$lactation = $_REQUEST['lactation'];
				$castration = $_REQUEST['castration'];
				$tag_no = $_REQUEST['tag_no'];
				if($gender!='Male' && $gender!='Female')
				{
					$json['error'] ='Incorrect Gender';
				}
				$milking_status = $_REQUEST['milking_status'];
				$peak_milk_yield = $_REQUEST['peak_milk_yield'];
				$sex_of_calf = $_REQUEST['sex_of_calf'];
				$calf_status = $_REQUEST['calf_status'];
				//0 - less then 1 year,1 - 1 year to 1.5 years, 2 - 1.5 year to 2 years, 3 - More then 2 years
				$inter_calving_period = $_REQUEST['inter_calving_period'];
				//enum('Yes','No','Do not Know')
				$is_pregnant = $_REQUEST['is_pregnant'];
				$pregnancy_day = $_REQUEST['pregnancy_date'];
				$pregnant_month = $_REQUEST['pregnancy_month'];
				//enum('AI','NS')
				$method_of_conception = $_REQUEST['method_of_conception'];
				//vaccinations--------------------------------------
				//enum('Yes -1','No-0','Do not Know-2')
				// [{"vaccination_id": "8", "vaccination_date": "2017-12-01","vaccination_status": "1"},{"vaccination_id": "5","vaccination_date": "2017-12-01","vaccination_status": "0"}]
				 $vaccinations = json_decode($_REQUEST['vaccinations']);
				//  print_r(json_decode($vaccinations));
				//  foreach($vaccinations as $values)
				//  {
				// 	 echo "this is";
				// 	 print_r(json_decode($values));
				//  }
				//  exit;
				$herd = isset($_REQUEST['herd']) ? $_REQUEST['herd'] : '1';
				$no_of_males = $_REQUEST['no_of_males'];
		 		$no_of_females = $_REQUEST['no_of_females']; 
				//optional
				$description = $_REQUEST['description'];
				$father = $_REQUEST['father'];
				$mother = $_REQUEST['mother'];
				$height = $_REQUEST['height'];
				$weight = $_REQUEST['weight'];
				$color = $_REQUEST['color'];
				$mothers_breed = $_REQUEST['mothers_breed'];
				$fathers_breed = $_REQUEST['fathers_breed'];
				if (!isset($users_id) || $users_id == '') {
						$json['error'] = "users_id is required";
				}
				if (!isset($category_id) || $category_id == '') {
						$json['error'] = "category_id is required";
				}
				if (!isset($breed_id) || $breed_id == '') {
						$json['error'] = "breed_id is required";
				}
	 			if (!isset($animals_images) || $animals_images == '') {
						$json['error'] = "Animals Image is required";
				}
				if ((!isset($animal_age) || $animal_age == '') && (isset($animal_month) || $animal_month == '')) {
					$json['error'] = "Animal age is required";
				}
				// if (!isset($animal_month) || $animal_month == '') {
				// 		$json['error'] = "Animal is in Month is required";
				// }
				if (!isset($gender) || $gender == '') {
						$json['error']= "Gender is required";
				}
				//sell animal check
		 		//-0-fixed,1 - not fixed
				if(!$json)
					{
						if($users_id!= ''){
							$vt_id = $this->api_model->get_user_doc_id($users_id);
						}else{
							$vt_id = '';
						} 
						$fieldvalues = [
													'users_id'                =>  $users_id,
													'category_id'             =>  $category_id,
													'breed_id'                =>  $breed_id,
													'isactivated'             =>  $isactivated,
													'tag_no'                  =>  $tag_no,
													'fullname'				  =>  $fullname,
													'gender'                  =>  $gender,
													'private_vt'			  =>  $private_ai,
													'castration'              =>  $castration,
													'lactation'               =>  $lactation,
													'milking_status'          =>  $milking_status, 
													'yield'         		  =>  $peak_milk_yield,
													'sex_of_calf'             =>  $sex_of_calf,
													'calf_status'             =>  $calf_status, 
													'inter_calving_period'    =>  $inter_calving_period, 
													'is_pregnant'             =>  $is_pregnant,
													'no_of_males'             =>  $no_of_males, 
													'no_of_females'           =>  $no_of_females,
													//'pregnancy_date'        =>  $pregnancy_date,
											 		'method_of_conception'   =>  isset($method_of_conception)?$method_of_conception:'',
													'isaccepted'        =>  $isaccepted,
													'pregnant_month'	=>  $pregnant_month,
													'price'             =>  $price,
													'age'				=>  $animal_age,
													'age_month' 		=>  $animal_month,
													'pregnancy_date' 	=>  $pregnancy_day,
													'description'       =>  $description,
													'height'			=>  $height,
													'weight'			=>  $weight,
													'herd' 				=>  $herd,
													'admin_id'          =>  $admin_id,
													'vt_id'				=>  $vt_id,
													'created_on'		=>  date('Y-m-d H:i:s'),
													'update_on'			=>  date('Y-m-d H:i:s')													
										];

								if($animal_id =  $this->api_model->insert_animals($fieldvalues)){
													//$animals_images=json_decode($_REQUEST['animals_images']);
													foreach ($animals_images as $images) 
													{
														$field_images = [
														'animal_id'            =>  $animal_id,
														'images'              =>  $images,
														'created'              =>  date('Y-m-d H:i:s')
														]; 
														$this->api_model->insert_animals_images($field_images);
													}
													foreach ($animals_videos as $video) 
													{
														$ani_video = [
														'animal_id'            =>  $animal_id,
														'videos'              =>  $video,
														'created'              =>  date('Y-m-d H:i:s')
														]; 
														$last_id = $this->api_model->submit('animals_videos', $ani_video);
														//$this->api_model->insert_animals_images($field_images);
													}
													
													if(isset($vaccinations)){ 
														foreach($vaccinations as $values)
														{
															$vaccin = '-'.$values->vaccination_date. 'month';
															if($values->vaccination_date != '')
															{
																$vacc_date = date('Y-m-d', strtotime($vaccin));
															}
															else{
																$vacc_date = '';
															}
															$req_filed['animal_id'] = $animal_id;
															$req_filed['users_id'] = $users_id;
															$req_filed['treat_type'] = '1';
															$req_filed['vt_id'] = '';
															$req_filed['vacc_id'] = $values->vaccination_id;
															$req_filed['register_status'] = '1';
															$req_filed['status']  = '0';
															$req_filed['address'] = '';
															$req_filed['latitude'] = $latitude?$latitude:'0';
															$req_filed['langitude '] = $langitude?$langitude:'0';
															$req_filed['otp'] = '';
															$req_filed['created_on'] =  $vacc_date;
															$req_filed['date'] = $vacc_date;
															$insert = $this->api_model->insert_vt_request($req_filed);
															$r_data['request_id'] = $insert; 
															$r_data['user_id'] = $users_id;
															$r_data['animal_id'] = $animal_id;
															$r_data['treat_type'] = '1';
															$r_data['treat_status'] = '4';
															$r_data['doc_id'] = '';
															$r_data['vacc_id'] = $values->vaccination_id;
															$r_data['vt_id'] = '';
															$r_data['status'] = '4';
															$r_data['type'] = '1';
															$r_data['otp'] = '';
															$r_data['date'] = $vacc_date;
															$this->api_model->insert_vt_track_request($r_data);
															//print_r($values);
														}
															//$addvaccination = $this->api_model->insert_vaccinationsWithDate($field_vaccination);
															
														}
													$fieldvalues['animal_id'] = $animal_id;
													$json['success'] = TRUE;
													$json['msg'] = "Your Animal Registered";
													$json['data'] = $fieldvalues;
								}else{
									$json['success'] = FALSE;
									$json['error'] = "Error with database";
								}
					}
					else {
									$json['success'] = FALSE;
					}
					header('Content-Type: application/json');
					echo json_encode($json);
					exit;
	 }
	//  public function test_get_vt(){s
	// 	 $users_id = $this->input->get_post('users_id');
	// 	$vt_id = $this->api_model->get_user_doc_id($users_id);
	// 	print_r($vt_id);
	//  }
	 public function get_banner(){
		 if($detail = $this->api_model->get_banner()){
			$json['success'] = TRUE;
			$json['data'] = $detail;
		 }else{
			$json['success'] = False;
			$json['data'] = [];
		 }
		 echo json_encode($json);
	 }
	 public function district(){
		 $state_id = $this->input->get_post('state_id');
		 if(!isset($state_id) || !$state_id){
					$data['success'] =  FALSE;
	      	$data['error'] =  "State id is required";
		}else{
					if($detial = $this->api_model->get_distict($state_id)){
							$data['success'] =  TRUE;
							$data['data'] =  $detial;
					}else{
							$data['success'] =  FALSE;
							$data['error'] =  "NO data found";
					}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	 }
	 public function teshil(){
		$state_id = $this->input->get_post('dist_id');
		if(!isset($state_id) || !$state_id){
				 $data['success'] =  FALSE;
				 $data['error'] =  "Teshil id is required";
	 }else{
				 if($detial = $this->api_model->get_tehshil($state_id)){
						 $data['success'] =  TRUE;
						 $data['data'] =  $detial;
				 }else{
						 $data['success'] =  FALSE;
						 $data['error'] =  "NO data found";
				 }
	 }
	 echo json_encode($data);
	}
	public function village(){
				$state_id = $this->input->get_post('tehchi_id');
				if(!isset($state_id) || !$state_id){
						$data['success'] =  FALSE;
						$data['error'] =  "Tehsil id is required";
			}else{
						if($detial = $this->api_model->get_village($state_id)){
								$data['success'] =  TRUE;
								$data['data'] =  $detial;
						}else{
								$data['success'] =  FALSE;
								$data['error'] =  "NO data found";
						}
			}
			header('Content-Type: application/json');
			echo json_encode($data);
			exit;
		}
		public function test(){
			$vill_data = $this->api_model->get_request_detail(267);
			print_r($vill_data);
			// foreach($vill_data as $vill){
			// 	print_r($vill['doctor_id']);
			// }
		}
		public function user_add() {
			$data['full_name'] = $this->input->get_post('fullname');
			$data['mobile_code'] = $this->input->get_post('mobile_code');
			$data['doc_referal_by'] = $this->input->get_post('referal_code');
			$data['mobile'] = $this->input->get_post('mobile');
			$data['city'] = $this->input->get_post('city');
			$data['email'] = $this->input->get_post('email');
			$data['address'] = $this->input->get_post('address');
			$data['latitude'] = $this->input->get_post('latitude');
			$data['longitude'] = $this->input->get_post('longitude');
			$data['fathers_name'] = $this->input->get_post('fathers_name');
			$data['aadhaar_no'] = $this->input->get_post('aadhaar_no');
			$data['caste'] = $this->input->get_post('caste');
			$data['occupation_of_household'] = $this->input->get_post('occupation_of_household');
			$data['training_attended'] = $this->input->get_post('training_attended');
			$data['zone_id'] = $this->input->get_post('state_code');
			$data['tehsil_code'] = $this->input->get_post('tehsil_code');
			$village_code = $this->input->get_post('village_code');
			$data['village_code'] = $village_code;
			$data['is_sharable'] = $this->input->get_post('is_sharable');
			$data['address_type'] = $this->input->get_post('address_type');
			$data['income_fom_livestoc'] = $this->input->get_post('income_from_livestoc');
			$data['income_fom_livestoc'] = $this->input->get_post('income_fom_livestoc');
			if(isset($village_code)){
				$vill_data = $this->api_model->check_village_map($village_code);
				$data['vt_id'] = $vill_data[0]['doc_id'];
			}
			//--------------------$data['nhh_name'] = $this->input->get_post('nhh_name');
			$mobile= $data['mobile'];
			$mobile_code= $data['mobile_code'];
			$aadhaar_no= $data['aadhaar_no'];
			$email = $data['email'];
			//---------------$mobilecheck = $this->api_model->mobilecheck($mobile, $mobile_code);
			//----------- if ($mobilecheck) {
			// ---------		  $json['success'] = false;
			// -----------			$json['error'] = "Mobile No is already associated with another account.";
			//----------- }	
			$mobileadhaarcheck = $this->api_model->mobileadhaarcheck($mobile, $mobile_code, $aadhaar_no);
			if($mobileadhaarcheck){
				if ($aadhaar_no != '') {
					$json['success'] = false;
					$json['error'] = "Mobile No already associated with another account.";
				}else{
							$json['success'] = false;
							$json['error'] = "Mobile No and Adhaar already associated with another account.";
				}
			} 
			if($email){
				$emailcheck = $this->api_model->emailcheck($email);
					if ($emailcheck) {
								$json['success'] = false;
								$json['error'] = "Email is already associated with another account.";
					}
			}
			
			if(!$json['error']){
				// if($this->input->get_post('image') != 0){
					if (!empty($_FILES['file']['name'])){
							$config = array();
							$config['upload_path'] = '/var/www/html/harpahu_dhyan/uploads/user';
							$config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
							$config['max_size']      = '10000';
							$config['overwrite']     = FALSE;
							$config['file_name'] =time().$_FILES['userfile']['name'];									
							$this->load->library('upload');
							$this->upload->initialize($config);
							if (!$this->upload->do_upload('file'))
							{
										$json['success'] =  False;
										$json['error'] = $this->upload->display_errors(); 
							}
							else
							{
									$upload_data = $this->upload->data();
									$test['image'] =$upload_data['file_name'];
									$data['image'] = $upload_data['file_name'];
									if($detial = $this->api_model->set_user($data)){
										$json['success'] =  true;
										$json['msg'] = "आपकी प्रोफ़ाइल सफलतापूर्वक पंजीकृत हो गई है"; 
									}else{
										$json['success'] =  False;
										$json['error'] = "Problem with database"; 
									}
							}
					// }else{
					// 	$json['success'] = false;
					// 	$json['error'] = "Please Upload image";
					// }
				}else{
					if($detial = $this->api_model->set_user($data)){
						$json['success'] =  true;
						$json['msg'] = "आपकी प्रोफ़ाइल सफलतापूर्वक पंजीकृत हो गई है"; 
					}else{
						$json['success'] =  False;
						$json['error'] = "Problem with database"; 
					}
				}
			}
			header('Content-type: application/json');
			echo json_encode($json);
			exit;
}
public function user_vet_add() {
	$data['full_name'] = $this->input->get_post('fullname');
	$data['mobile_code'] = $this->input->get_post('mobile_code');
	$data['doc_referal_by'] = $this->input->get_post('referal_code');
	$data['mobile'] = $this->input->get_post('mobile');
	$data['city'] = $this->input->get_post('city');
	$data['email'] = $this->input->get_post('email');
	$data['address'] = $this->input->get_post('address');
	$data['latitude'] = $this->input->get_post('latitude');
	$data['longitude'] = $this->input->get_post('longitude');
	$data['image'] = $this->input->get_post('image');
	$data['fathers_name'] = $this->input->get_post('fathers_name');
	$data['aadhaar_no'] = $this->input->get_post('aadhaar_no');
	$data['caste'] = $this->input->get_post('caste');
	$data['occupation_of_household'] = $this->input->get_post('occupation_of_household');
	$data['training_attended'] = $this->input->get_post('training_attended');
	$data['zone_id'] = $this->input->get_post('state_code');
	$data['district_id'] = $this->input->get_post('city_code');
	$data['tehsil_code'] = $this->input->get_post('tehsil_code');
	$village_code = $this->input->get_post('village_code');
	$data['village_code'] = $village_code;
	$admin_id = $this->input->get_post('admin_id');
	$data['is_sharable'] = $this->input->get_post('is_sharable');
	$data['address_type'] = $this->input->get_post('address_type');
	$data['is_verified'] = '1';
	$data['income_fom_livestoc'] = $this->input->get_post('income_from_livestoc');
	$data['income_fom_livestoc'] = $this->input->get_post('income_fom_livestoc');
	$data['created_on'] = date('Y-m-d H:i:s');
	$data['updated_on'] = date('Y-m-d H:i:s');
	if(isset($village_code)){
		$vill_data = $this->api_model->check_village_map($village_code);
		$data['vt_id'] = $vill_data[0]['doc_id'];
	}
	if(isset($admin_id)){
		$data['admin_id'] = $admin_id;
	}
	//--------------------$data['nhh_name'] = $this->input->get_post('nhh_name');
	$mobile= $data['mobile'];
	$mobile_code= $data['mobile_code'];
	$aadhaar_no= $data['aadhaar_no'];
	$email = $data['email'];
	//---------------$mobilecheck = $this->api_model->mobilecheck($mobile, $mobile_code);
	//----------- if ($mobilecheck) {
	// ---------		  $json['success'] = false;
	// -----------			$json['error'] = "Mobile No is already associated with another account.";
	//----------- }	
	$mobileadhaarcheck = $this->api_model->mobileadhaarcheck($mobile, $mobile_code, $aadhaar_no); 
	if($mobileadhaarcheck){
			if ($aadhaar_no != '') {
						$json['success'] = false;
						$json['error'] = "Mobile No already associated with another account.";
			}else{
						$json['success'] = false;
						$json['error'] = "Mobile No or Adhaar already associated with another account.";
			}
		}
	if($email){
		$emailcheck = $this->api_model->emailcheck($email);
			if ($emailcheck) {
						$json['success'] = false;
						$json['error'] = "Email is already associated with another account.";
			}
	}
	
	if(!$json['error']){
			if($detial = $this->api_model->set_user($data)){
				$json['success'] =  true;
				$json['msg'] = "Your Farmer is successfully register with us"; 
			}else{
				$json['success'] =  False;
				$json['error'] = "Problem with database"; 
			}
	}
	header('Content-type: application/json');
	echo json_encode($json);
	exit;
	}
}