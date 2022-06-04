<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_cheak extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('login_cheak_model');
	}
	public function login_cheak_paravete()
	{
		$user = $this->input->get_post('user_name');
		$password = $this->input->get_post('password');
		$data = [];
		if(!isset($user) || $user == ''){
			$data['success'] = False;
			$data['error'] ="You Must send User Name";
		}else if(!isset($password) || $password == ''){
			$data['success'] = False;
			$data['error'] ="You Must send Password";
		}else{
			$detail = $this->login_cheak_model->login_paravate($user, md5($password));
			if($detail[0]['users_type'] == 'pvt_doc'){
					$doc_qua = $this->login_cheak_model->get_qulification_doc_id($detail[0]['doctor_id']);
					foreach($doc_qua as $dq){
						if(is_numeric($dq['qualifi_id'])){
						$qua_name = $this->login_cheak_model->get_qualification($dq['qualifi_id']);
						$dq['qualification_name'] = $qua_name[0]['qualifi_name'];
						$dq['document'] = base_url()."uploads/doctore_doc/".$dq['document'];
						$dq['adhar_img'] = base_url()."uploads/doctore_doc/".$dq['adhar_img'];
						}
						// echo $speci_id = $dq['speci_id'];
							if(isset($dq['speci_id']) || $dq['speci_id'] != ''){
								//echo "this is true";
								$sp = json_decode($dq['speci_id']);
								foreach($sp as $s){
									//print_r($s);
									$specialization = $this->login_cheak_model->get_specialisation($s);
									//print_r($specialization);
									//exit;
									$sep[] = $specialization[0]['speci_name'];
								}
								if(empty($sep)){
									$dq['speci_name'] = [];
								}else{
									$dq['speci_name'] = $sep;
								}
							
							}else{
							$dq['speci_name'] = [];
							}
							if($dq['speci_id'] == ''){
								$dq['speci_id'] = [];
							}else{
								$dq['speci_id'] = json_decode($dq['speci_id']);
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
					$detail[0]['image1'] = $detail['image'];
				}
				if(isset($detail[0]['expertise_list'])){
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
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	public function login_cheak()
	{
		$mobile = $this->input->get_post('mobile');
		$adhar = $this->input->get_post('adhar');
		$data = [];
		if(!isset($mobile) || $mobile == ''){
			$data['success'] = False;
			$data['error'] ="You Must send Mobile No";
		}else if(!isset($adhar) || $adhar == ''){
			$data['success'] = False;
			$data['error'] ="You Must send adhar No";
		}else{
			$detail = $this->login_cheak_model->login($mobile, $adhar);
			if($detail){
			$data['success'] = True;
			$data['data'] = $detail;
			$data['tel_no'] = TEL_NO;
			}else{
				$data['success'] = False;
				$data['error'] = "यदि आप लॉगिन करने में असमर्थ है तो सहायता के लिए कॉल करे टोल फ्री नंबर ".TEL_NO."";
				$data['tel_no'] = TEL_NO;
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	
	public function check_login_pass(){
		$pass = $this->input->get_post('passcode');
		$user_id = $this->input->get_post('users_id');
		$data = [];
		if(!isset($pass)){
			$data['success'] = False;
			$data['error'] ="You Must send Passcode";
		}else if(!isset($user_id)){
			$data['success'] = False;
			$data['error'] ="You Must send User Id";
		}else{
			$detail = $this->login_cheak_model->login_passcode($user_id, $pass);
			if($detail){
			$data['success'] = True;
			$data['data'] = $detail;
			$data['tel_no'] = TEL_NO;
			}else{
				$data['success'] = False;
				$data['error'] = "Please Check Your Passcode";
				$data['tel_no'] = TEL_NO;
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	} 
	
  	public function password_exit()
	{
		$users_id = $this->input->get_post('users_id');
		$data = [];
	
		 if(!isset($users_id) || $users_id == ''){
			 $data['success'] = False;
			$data['error'] ="You Must send users id";
		}else{
			$detail = $this->login_cheak_model->password_exist($users_id);
			if($detail){
				$data['success'] = True;
				$data['data'] = $detail;
			}else{
				$data['success'] = False;
				$data['error'] ="There is no data found with this id";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	
	  public function password_update()
	{
		$users_id = $this->input->get_post('users_id');
		$password = $this->input->get_post('password');
		$data = [];
	
		 if(!isset($users_id) || $users_id == ''){
			 $data['success'] = False;
			$data['error'] ="You Must send users id";
		}
		elseif(!isset($password) || $password == ''){
			 $data['success'] = False;
			$data['error'] ="You Must send password";
		}
		else{
			$filed =[
			'passcode' =>$password,
			];
			$detail = $this->login_cheak_model->password_update($users_id,$filed);
			if($detail){
				$data['success'] = True;
			}else{
				$data['success'] = False;
				$data['error'] ="Error";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}

}
