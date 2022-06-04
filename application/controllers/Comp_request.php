<?php
class Comp_request extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
	}
    public function index(){
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/comp_request');
		$this->load->view('admin/layouts/admin_footer');
    }
	public function comp_request_search(){
        $name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
        $where = '';
        if($name != ''){
            $where = ' AND name like = "%'.$name.'% "';
        }
		$detail = $this->api_model->get_data('payment_status = "1"'.$where , 'feed_formulation_req', 'id DESC', 'id, (select name from product_section where section_id = id) as section_name, (select full_name from users where users_id = feed_formulation_req.users_id) as user_name, (select mobile from users where users_id = feed_formulation_req.users_id) as user_mobile, (select name from section_property where section_prop_id = id) as section_prop_name, prop_price, isactive', $start, $perpage);
		$detail['count'] = $this->api_model->get_data($where , 'feed_formulation_req', '', 'count(*) as count');
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
	public function view($id){
		$dum = $this->api_model->get_data('payment_status = "1" AND id = "'.$id.'"', 'feed_formulation_req', 'id DESC', 'id, users_id, (select name from product_section where section_id = id) as section_name, (select full_name from users where users_id = feed_formulation_req.users_id) as user_name, (select mobile from users where users_id = feed_formulation_req.users_id) as user_mobile, (select name from section_property where section_prop_id = id) as section_prop_name, prop_price, isactive');
		$data['data'] = $dum;
		if(isset($_REQUEST['submit'])){
			$comp = $this->api_model->get_data('', 'feed_composition'); 
                foreach($comp as $co){
					$re = $_REQUEST['name_'.$co['id']];
					if($re != ''){
						$dat['request_id'] = $id;
						$dat['feed_composition_id'] = $co['id'];
						$dat['feed_composition_rate'] = $_REQUEST['name_'.$co['id']];
						$dat['isactive'] = '1';
						$dat['created_on'] = date('Y-m-d');
						$this->api_model->submit('feed_composition_log', $dat);
					}
				}
				$title = 'Feed Formulation';
				$msg1 = 'Please check your Livestoc APP,  feed formulation is sent to you.';
				$msg['users_id'] = $dum[0]['users_id'];
				$msg['title'] = $title;
				$msg['message'] = $msg1;
				$msg['date'] = date('Y-m-d h:i:s');
				$msg['type'] = '2';
				$msg['isactive'] = '1';
				$msg['flag'] = '1';
				$this->api_model->user_notification($msg);
				$old_msg['to_users_id'] =  $dum[0]['users_id'];
				$old_msg['to_id'] =  $dum[0]['users_id'];
				$old_msg['to_type'] = 'users';
				$old_msg['title'] = $title;
				$old_msg['from_type'] = 'Livestoc Team';
				$old_msg['success'] = '1';
				$old_msg['device'] = 'android';
				$old_msg['active'] = '1'; 
				$old_msg['description'] = $msg1;
				$old_msg['date_added'] = date('Y-m-d h:i:s');
				$this->api_model->old_notification($old_msg);
				$this->simple_push_none($dum[0]['users_id'], 2 , $title, '5', $msg1);
				$update['isactive'] = '2';
				$this->api_model->get_data_update('id = "'.$id.'"', 'feed_formulation_req', $update);
				$this->session->set_flashdata('add_bank','Your Composition is Added.');
				redirect(base_url().'comp_request');
		}else{
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/comp_request_view', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
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
}