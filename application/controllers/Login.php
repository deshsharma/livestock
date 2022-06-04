<?php
header('Access-Control-Allow-Origin: *');
Class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('loginmodel');
	}

	public function index()
	{
		if( $this->session->userdata('user_id') )
		{
			if($this->session->userdata('status')=='2')
			{

			}
			else
			{
				return redirect('file/');
			}
		}			
		
		$this->load->helper('form');
		$this->load->view('file/');
	}

	public function doc_login()
	{
		if($_REQUEST['username']!='' && $_REQUEST['password']!='')
		{
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];	
			if($login_detail = $this->loginmodel->doc_login_valid($username, $password))
			{
				// $login_id = $login_detail->admin_id;
				// $login_name = $login_detail->fname;
				// $status = $login_detail->type;
				// $type = $login_detail->user_type;
				// //$hspid = $login_detail->hospital_id;
				// $this->session->set_userdata('users_id', $login_id);
				// $this->session->set_userdata('user_name', $login_name);
				// $this->session->set_userdata('status', $status);
				// $this->session->set_userdata('type', $type);
				// $this->session->set_userdata('hspid', $hspid);
				// $error = '0';
			}
			else
			{
				$error = '1';
			}
		}
		else
		{
			$error= '1';
		}
		echo json_encode(array('error'=>$error));
	}
	public function user_login()
	{
		if($_REQUEST['username']!='' && $_REQUEST['password']!='')
		{
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];	
			// if(isset($_REQUEST['option'])){
			// 	if($_REQUEST['option'] == 0)
			// 	{
			// 		$login_detail = $this->loginmodel->user_login_valid($username, $password);
			// 	}else{
			// 		$login_detail = $this->loginmodel->login_paravate($username, $password);
			// 	}
			// }else{
				$login_detail = $this->loginmodel->user_login_valid($username, $password);
			//}
			if($login_detail)
			{
				if(isset($_REQUEST['option'])){
					if($_REQUEST['option'] == 0){
						$login_id = $login_detail->users_id;
						$login_name = $login_detail->full_name;
						$status = $login_detail->type;
						$type = 1;
					}else{
						$login_id = $login_detail[0]['doctor_id'];
						$login_name = $login_detail[0]['username'];
						$status = $login_detail->type;
						$type = 0;
					}
				}else{
						$login_id = $login_detail->users_id;
						$login_name = $login_detail->full_name;
						$status = $login_detail->type;
						$type = 1;
				}
				//$hspid = $login_detail->hospital_id;
				$this->session->set_userdata('users_id', $login_id);
				$this->session->set_userdata('user_name', $login_name);
				$this->session->set_userdata('user_type', $type);
				//print_r($_SESSION);
				$error = '0';
			}
			else
			{
				$error = '1';
			}
		}
		else
		{
			$error= '1';
		}
		echo json_encode(array('error'=>$error));
	}
	public function admin_login()
	{
		if($_REQUEST['username']!='' && $_REQUEST['password']!='')
		{
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];	
			if($login_detail = $this->loginmodel->login_valid($username, $password))
			{
				$login_id = $login_detail->admin_id;
				$login_name = $login_detail->fname;
				$status = $login_detail->type;
				$type = $login_detail->user_type;
				//$hspid = $login_detail->hospital_id;
				$this->session->set_userdata('user_id', $login_id);
				$this->session->set_userdata('user_name', $login_name);
				$this->session->set_userdata('status', $status);
				$this->session->set_userdata('type', $type);
				$this->session->set_userdata('hspid', $hspid);
				$error = '0';
			}
			else
			{
				$error = '1';
			}
		}
		else
		{
			$error= '1';
		}
		echo json_encode(array('error'=>$error));
	}
	public function forget_password()
	{
		$mob = $this->input->post('mob');
		if($mob!='')
		{
			if($login_detail = $this->loginmodel->mobile_valid($mob))
			{
				$mobile = $login_detail[0]['phone'];
				$id = $login_detail[0]['id'];
				$new_pass = mt_rand(10000000,999999999);
				$t = 'Your New Password Is '.$new_pass;
				$text = urlencode($t);
				$resp = $this->loginmodel->send_msg($mobile, $text);
				$data['password'] =  md5($new_pass);
				$this->load->model('user_detail');
				if($this->user_detail->user_update($data, $id))
				{
					$error = 0;
				}				
				else{
					$error = '2';
				}
			}
			else
			{
				$error = '1';
			}
		}
		else
		{
			$error= '1';
		}
		echo json_encode(array('error'=>$error));
	}

	public function logout()
	{
		$this->session->sess_destroy();
		return redirect('');
	}
	public function reg($id){
		$data = $this->loginmodel->get_sponser_info($id);
		$sponcer_data['sponcer'] = $data; 
		$this->load->view('user/usre_sign_up', $sponcer_data);
	}

	//Video section authetication
	public function userloginapi(){
		$option = $this->input->get_post('option');
		$username = $this->input->get_post('username');
		$password = $this->input->get_post('password');
		if($username!='' && $password!='')
		{
			if(isset($option)){
				if($option == 0) {
					$login_detail = $this->loginmodel->user_login_valid($username, $password);
				} else {
					$login_detail = $this->loginmodel->login_paravate($username, $password);
				}
			}else{
				$login_detail = $this->loginmodel->user_login_valid($username, $password);
			}
			if($login_detail)
			{
				if(isset($option)){
					if($option == 0){
						$login_id = $login_detail->users_id;
						$login_name = $login_detail->full_name;
						$status = $login_detail->type;
						$type = 1;
					}else{
						$login_id = $login_detail[0]['doctor_id'];
						$login_name = $login_detail[0]['username'];
						$status = $login_detail->type;
						$type = 0;
					}
				}else{
					$login_id = $login_detail->users_id;
					$login_name = $login_detail->full_name;
					$status = $login_detail->type;
					$type = 1;
				}
				$this->session->set_userdata('users_id', $login_id);
				$this->session->set_userdata('user_name', $login_name);
				$this->session->set_userdata('user_type', $type);
				return redirect(base_url().'all_videos');
			}
			else
			{
				$json['success'] = FALSE;
				$json['error'][] = "User Not Available";
			}
		}
		else
		{
			$json['success'] = FALSE;
			$json['error'][] = "User Not Available";
		}
		header('Content-Type: application/json');
        echo json_encode($json);
	}

	public function vet_login()
	{
		if($_REQUEST['username']!='' && $_REQUEST['password']!='')
		{
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];	
			$login_detail = $this->loginmodel->login_paravate($username, $password);
			if($login_detail)
			{
				$login_id = $login_detail[0]['doctor_id'];
				$login_name = $login_detail[0]['username'];
				//$hspid = $login_detail->hospital_id;
				$this->session->set_userdata('users_id', $login_id);
				$this->session->set_userdata('user_name', $login_name);
				$this->session->set_userdata('user_type', '0');
				//print_r($_SESSION);
				$error = '0';
			}
			else
			{
				$error = '1';
			}
		}
		else
		{
			$error= '1';
		}
		echo json_encode(array('error'=>$error));
	}
}







