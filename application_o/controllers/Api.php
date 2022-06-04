<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {
	
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
	public function get_date_test(){
		$users_id = $this->input->get_post('users_id');
		$type = $_REQUEST['type'];
		$msg = $_REQUEST['msg'];
		$data = $this->simple_push_none($users_id, $type , 'sample', '1', $msg);
		//print_r($data);
		// if($data){
		// 	$json['success'] = True;
		// 	//$json['data'] = $data;
		// 	//$json['count'] = $data_count[0]['count'];
		// }else{
			$json['success'] = True;
			//$json['error'] = 'No data found';
		//}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
		// $date1 = '2000-00-25';
		// $date2 = date('Y-m-d');

		// $ts1 = strtotime($date1);
		// $ts2 = strtotime($date2);

		// $year1 = date('Y', $ts1);
		// $year2 = date('Y', $ts2);

		// $month1 = date('m', $ts1);
		// $month2 = date('m', $ts2);

		// echo $diff_year = (($year2 - $year1));
		// echo "</br>";
		// echo $diff_month = ($month2 - $month1);
		// echo $diff;
	}
	public function send_test_mail(){
		//$this->load->library('email');  
		// $mail->SMTPDebug = 2;									
		// $mail->isSMTP();											
		// $mail->Host	 = ssl://smtp.gmail.com';					
		// $mail->SMTPAuth = true;							
		// $mail->Username = 'user@gfg.com';				
		// $mail->Password = 'password';						
		// $mail->SMTPSecure = 'ssl';							
		// $mail->Port	 = 465;
			$config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
			$config['smtp_host']    = "ssl://smtp.gmail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
			$config['smtp_user']    = "shahiakhilesh75@gmail.com"; // client email gmail id
			$config['smtp_pass']    = "7827735267akhil"; // client password
			$config['smtp_port']    =  465;
			$config['smtp_auth']    =  true;
			$config['smtp_crypto']  = 'ssl';
			$config['mailtype']     = "html";
			$config['newline']      = "\r\n";
			// $mail->Host = 'ssl://smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
			// $mail->Port = '465';								//Sets the default SMTP server port
			// $mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
			// $mail->Username = 'shahiakhilesh75@gmail.com';					//Sets SMTP username
			// $mail->Password = '7827735267akhil';					//Sets SMTP password
			// //$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
			// $mail->From = $_POST["email"];					//Sets the From email address for the message
			// $mail->FromName = $_POST["name"];				//Sets the From name of the message
			// $mail->AddAddress('shahiakhilesh75@gmail.com', 'Akhilesh');		//Adds a "To" address
			// $mail->AddCC($_POST["email"], $_POST["name"]);	//Adds a "Cc" address
			// $mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
			// $mail->IsHTML(true);							//Sets message type to HTML				
			// $mail->Subject = $_POST["subject"];				//Sets the Subject of the message
			// $mail->Body = $_POST["message"];				//An HTML or plain text message body
		// $config['smtp_host'] = 'smtp.gmail.com';
		// $config['smtp_port'] = '465';
		// $config['smtp_user'] = 'shahiakhilesh75@gmail.com';
		// $config['Authentication'] = TRUE;
		// $config['smtp_pass'] = '7827735267akhil';
		// $config['Authentication'] = 'smtp';
			$this->load->library('email', $config); // intializing email library, whitch is defiend in system
		
			//$this->email->set_newline("\r\n"); // comuplsory line attechment because codeIgniter interacts with the SMTP server with regards to line break
		
			$from_email = 'shobhnath800@gmail.com'; // sender email, coming from my view page 
			$to_email = 'shahiakhilesh75@gmail.com'; // reciever email, coming from my view page
			//Load email library
		
			$this->email->from($from_email);
			$this->email->to($to_email);
			$this->email->subject('Send Email Codeigniter'); 
			$this->email->message('The email send using codeigniter library');  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
			//$this->email->send();
			if($this->email->send()){
				$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
				echo "email_sent";
			}
			else{
				echo "email_not_sent";
				echo $this->email->print_debugger();  // If any error come, its run
			}
	}
	public function send_mail(){
		return true;
		exit;
			// $this->load->library('email');   
			// $config = array();
			// $config['useragent'] = 'CodeIgniter';
			// $config['protocol'] = 'smtp';
			// //$config['mailpath'] = '/usr/sbin/sendmail';
			// $config['smtp_host']    = "ssl://smtp.gmail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
			// $config['smtp_user']    = "shahiakhilesh75@gmail.com"; // client email gmail id
			// $config['smtp_pass']    = "7827735267akhil"; // client password
			// $config['smtp_port'] = 465; 
			// $config['wordwrap'] = TRUE;
			// $config['wrapchars'] = 76;
			// $config['mailtype'] = 'html';
			// $config['charset'] = 'utf-8';
			// $config['validate'] = TRUE;
			// $config['priority'] = 3;
			// $config['crlf'] = "\r\n";
			// $config['newline'] = "\r\n";
			// $config['bcc_batch_mode'] = FALSE;
			// $config['bcc_batch_size'] = 200;
			// $config = Array(
			// 	'protocol' => 'smtp',
			// 	'smtp_host' => 'ssl://smtp.googlemail.com',
			// 	'smtp_port' => 465,
			// 	'mailtype' => 'html',
			// 	'charset' => 'iso-8859-1',
			// 	'wordwrap' => TRUE
			// 	);
			// // $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
			// // $config['smtp_host']    = "ssl://smtp.googlemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
			// // $config['smtp_user']    = "shahiakhilesh75@gmail.com"; // client email gmail id
			// // $config['smtp_pass']    = "7827735267akhil"; // client password
			// // $config['smtp_port']    =  587;
			// // $config['smtp_crypto']  = 'ssl';
			// // $config['smtp_timeout'] = "";
			// // $config['mailtype']     = "html";
			// // $config['charset']      = "iso-8859-1";
			// // $config['newline']      = "\r\n";
			// // $config['wordwrap']     = TRUE;
			// // $config['validate']     = FALSE;
			// $this->load->library('email', $config); // intializing email library, whitch is defiend in system
		
			// $this->email->set_newline("\r\n"); // comuplsory line attechment because codeIgniter interacts with the SMTP server with regards to line break
		
			// $from_email = 'test@gmail.com'; // sender email, coming from my view page 
			// $to_email = 'shahiakhilesh75@gmail.com'; // reciever email, coming from my view page
			// //Load email library
		
			// $this->email->from($from_email);
			// $this->email->to($to_email);
			// $this->email->subject('Send Email Codeigniter'); 
			// $this->email->message('The email send using codeigniter library');  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
			// $this->email->send();
			//Send mail
			// if($this->email->send()){
			// 	$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
			// 	echo "email_sent";
			// }
			// else{
			// 	echo "email_not_sent";
			// 	echo $this->email->print_debugger();  // If any error come, its run
			// }
	}
	// public function send_mail($to, $subject, $message){
	// 	//$this->load->library('email');  
	// 	$this->load->library('email');
	// 	$this->load->library('parser');
	// 	// $config['protocol'] = "smtp";
	// 	// $config['smtp_host'] = "ssl://smtp.gmail.com";
	// 	// $config['smtp_port'] = "465";
	// 	// $config['smtp_user'] = "shahiakhilesh75@gmail.com"; 
	// 	// $config['smtp_pass'] = "7827735267akhil";
	// 	// $config['charset'] = "utf-8";
	// 	// $config['mailtype'] = "html";
	// 	// $config['newline'] = "\r\n";
	// 	// $config['protocol'] = 'smtp';
	// 	// $config['smtp_host'] = 'ssl://smtp.gmail.com'; //change this
	// 	// $config['smtp_port'] = 587;
	// 	// $config['smtp_user'] = 'shahiakhilesh75@gmail.com'; //change this
	// 	// $config['smtp_pass'] = '7827735267akhil'; //change this
	// 	// $config['mailtype'] = 'html';
	// 	// $config['authentication'] = 'plain';
	// 	// $config['charset'] = 'iso-8859-1';
	// 	$config = array();
	// 	$config['protocol']     = "sendmail"; // you can use 'mail' instead of 'sendmail or smtp'
	// 	$config['smtp_host']    = "ssl://smtp.gmail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	// 	$config['smtp_user']    = "shahiakhilesh75@gmail.com"; // client email gmail id
	// 	$config['smtp_pass']    = "7827735267akhil"; // client password
	// 	$config['smtp_port']    =  587;
	// 	$config['smtp_crypto']  = 'ssl';
	// 	$config['smtp_timeout'] = "";
	// 	//$config['mailtype']     = "html";
	// 	$config['charset']      = "iso-8859-1";
	// 	$config['newline']      = "\r\n";
	// 	$config['wordwrap']     = TRUE;
	// 	//$config['validate']     = FALSE;
	// 	$config['wordwrap'] = TRUE;
	// 	$config['newline'] = "\r\n";
	// 	//$config['validate']     = FALSE;
	// 	$this->email->clear();
	// 	//$config['mailtype'] = "html";
	// 	$this->email->initialize($config);
	// 	$this->email->set_newline("\r\n");
	// 	$this->email->from('email@example.com', 'Website');
	// 	$list = array('shahiakhilesh75@gmail.com');
	// 	$this->email->to($list);
	// 	$data = array();
	// 	//$htmlMessage = $this->parser->parse('messages/email', $data, true);
	// 	$this->email->subject('This is an email test');
	// 	$this->email->message("this is test mail");
	// 	//$ci->email->send();
	// 	//$this->email->send();
	// 	// $config = array();
	// 	// $config['protocol']     = "sendmail"; // you can use 'mail' instead of 'sendmail or smtp'
	// 	// $config['smtp_host']    = "ssl://smtp.googlemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	// 	// $config['smtp_user']    = "shahiakhilesh75@gmail.com"; // client email gmail id
	// 	// $config['smtp_pass']    = "7827735267akhil"; // client password
	// 	// $config['smtp_port']    =  465;
	// 	// $config['smtp_crypto']  = 'ssl';
	// 	// $config['smtp_timeout'] = "";
	// 	// $config['mailtype']     = "html";
	// 	// $config['charset']      = "iso-8859-1";
	// 	// $config['newline']      = "\r\n";
	// 	// $config['wordwrap']     = TRUE;
	// 	// $config['validate']     = FALSE;
	// 	// $this->load->library('email', $config); 
	// 	// $this->email->set_newline("\r\n");
	// 	// $this->email->from('shahiakhilesh75@gmail.com', 'Akhilesh');
	// 	// $this->email->to($to);
	// 	// $this->email->subject($subject); 
	// 	// $this->email->message($message);
	// 	//$this->email->send();
	// 	if($this->email->send()){
	// 		$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
	// 		echo "email_sent";
	// 		echo $this->email->print_debugger();
	// 	}
	// 	else{
	// 		echo "email_not_sent";
	// 		echo $this->email->print_debugger();
	// 	}
	// }
	
	public function get_doc_statement(){
		$doc_id = $this->input->get_post('doc_id');
		$start = $this->input->get_post('start');
		$query = "call get_doctor_statement (".$doc_id.", ".$start.", 20);";
		$data = $this->api_model->query_build($query);
		$this->db->close();
		
		$detail=[];
		$i = 0;
		foreach($data as $da){
			//print_r($da);
			// if(!is_null($da['dr'])){
			// 	if(!is_null($da['cr'])){
				//$da;
					if($da['cr'] != '0' || $da['dr'] != '0'){
						$detail[$i] = $da;
						$i++;
					}
			// 	}
			// }
		}
		$count_entery = count($detail);
		// print_r($detail);
		$query = "call get_doc_account(".$doc_id.");";
		$count = $this->api_model->query_build($query);
		$this->db->close();
		$query = "Select count(id) as count, if(sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)) IS NOT NULL, sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)),0) as company_share, if(sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))) IS NOT NULL,sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))), 0) as your_share from doctor_call_inisite where log_id <> '0' AND doctor_id = '".$doc_id."'";
		$call_data = $this->api_model->query_build($query);
		$query = "select  count(id) as count, sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Cr' AND ((select request_status from log_file where id = com.log_id) <> '1' OR log_id = '0')";
		$account_summary = $this->api_model->query_build($query);
		$query = "select  count(id) as count, sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Cr' AND (select request_status from log_file where id = com.log_id) = '1' AND log_id <> '0'";
		$account_summary_online = $this->api_model->query_build($query);
		$query = "select  count(id) as count, sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Cr' AND (select request_status from log_file where id = com.log_id) = '1' AND log_id <> '0'";
		$account_dr_summary = $this->api_model->query_build($query);
		$query = "select  count(id) as count, sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Dr' AND (select request_status from log_file where id = com.log_id) = '1' AND log_id <> '0'";
		$account_dr_summary_online = $this->api_model->query_build($query);
		// print_r($count);
		// print_r($account_summary);
		// print_r($account_summary_online);
		// print_r($account_dr_summary);
		// print_r($account_dr_summary_online);
		//$count[0]['total_dr'] += $account_dr_summary[0]['amount'];
		$count[0]['total_cr'] += $account_dr_summary_online[0]['amount'] + $account_dr_summary[0]['amount'];
		// print_r($count);
		$total_yours = ($count[0]['total_cr']);
		$your_share = $total_yours;
		$company_share = $count[0]['total_dr'] - $account_summary_online[0]['amount'];
		//$count[0]['total_cr'] = $count[0]['total_cr'] - $account_summary[0]['amount'];
		$count[0]['count'] =  $count[0]['count'] + $account_summary[0]['count'] + $account_summary_online[0]['count'];
		// if($count[0]['total_dr'] != 0 && $count[0]['total_cr'] != 0){
			// if($company_share > $your_share){
			// 	$count[0]['total_cr'] = $company_share - $your_share;
			// }else{
				// if($your_share > $company_share){
				// 	$count[0]['total_dr'] = $company_share;
				// 	$count[0]['total_cr'] = $your_share;
				// }
			// }
		// }
		// $st = $account_summary_online[0]['amount']-$count[0]['total_dr'];
		$count[0]['total_val'] = ($count[0]['total_cr']);
		$count[0]['total_val'] -= $count[0]['total_dr'];
		 //print_r($count);
		// $query = "call get_doc_account (".$doc_id.");";
		// $count = $this->api_model->query_build($query);
		// $this->db->close();
		// $query = "select count(id) as count, sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Cr' AND ((select request_status from log_file where id = com.log_id) <> '1' OR log_id = '0')";
		// $account_summary = $this->api_model->query_build($query);
		// $query = "select count(id) as count, sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Cr' AND (select request_status from log_file where id = com.log_id) = '1'";
		// $account_summary_online = $this->api_model->query_build($query);
		// $total_yours = ($count[0]['total_cr']);
		// $your_share = $total_yours;
		// $company_share = $count[0]['total_dr'] - $account_summary_online[0]['amount'];
		// $count[0]['count'] =  $count[0]['count'] + $account_summary[0]['count'] + $account_summary_online[0]['count'];
		// // print_r($account_summary);
		// // exit;
		// //$count[0]['total_cr'] = $count[0]['total_cr'] - $account_summary[0]['amount'];
		// if($company_share > $your_share){
		// 	$count[0]['total_cr'] = $company_share - $your_share;
		// }else{
		// 	if($your_share > $company_share){
		// 		$count[0]['total_dr'] = $company_share - $account_summary[0]['amount'];
		// 		$count[0]['total_cr'] = $your_share - $account_summary[0]['amount'];
		// 	}else{
		// 		$count[0]['total_dr'] = '0';
		// 		$count[0]['total_cr'] = '0';
		// 	}
		// }
		if($detail)
		{
			$json['success']  = TRUE;
			$json['data'] = $detail;
			$count[0]['count'] = $count_entery;
			$json['count'] = $count;
		}else{
			$json['success']  = False;
			$json['error'] = 'No data found';
			$json['count'] = [];
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_semen_company_price(){
		if($data = $this->api_model->query_build('select fname, admin_id from admin where FIND_IN_SET(admin_id ,(SELECT GROUP_CONCAT(DISTINCT company) FROM `company_group_price`))')){
			$json['success']  = TRUE;
			$json['data'] = $data;
		}else{
			$json['success']  = FALSE;
			$json['error'] = "No Data Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function crone(){
		date_default_timezone_set('Asia/Calcutta');
		$my_date_time = date("Y-m-d h:i:s", strtotime("+".TREATMENT_CANCEL_TIME." hours"));
		$data = $this->api_model->get_data('created_on >= "'.$my_date_time.'" AND status = "0"' , 'vt_requests', '', '*');
		if(!empty($data)){
			if($data[0]['log_id'] != '' && $data[0]['log_id'] != '0'){
				$log_data = $this->api_model->get_data('id = "'.$data[0]['log_id'].'"' , 'log_file', '', '*');
				if($log_data[0]['request_status'] == '2'){
					$wall_dr = $this->api_model->get_data('log_id = "'.$data[0]['log_id'].'" AND status = "Dr"', 'livestoc_wallets','', 'sum(amount) as amount');
					if($data[0]['treat_type'] == '3'){
						if(!empty($wall_dr)){
							$update['status'] = '3';
							$this->api_model->get_data_update('id = "'.$data[0]['id'].'"', 'vt_requests', $update);
							$wall_update['log_id'] = $data[0]['log_id'];
							$wall_update['status'] = 'Cr';
							$wall_update['date'] = date('Y-m-d h:i:s');
							$wall_update['type'] = '27';
							$wall_update['wallet_type'] = '1';
							$wall_update['amount'] = $wall_dr[0]['amount'];
							$this->api_model->submit('livestoc_wallets', $wall_update);
							$title = 'AI Request Cancelled';
							$msg1 = 'Sorry, we regret to inform you that our service providers are unable to accept your request at this time. Please try after some time.';
							$msg['users_id'] = $data[0]['users_id'];
							$msg['title'] = $title;
							$msg['message'] = $msg1;
							$msg['date'] = date('Y-m-d h:i:s');
							$msg['type'] = '2';
							$msg['isactive'] = '1';
							$msg['flag'] = '1';
							$this->api_model->user_notification($msg);
							$old_msg['to_users_id'] = $data[0]['users_id'];
							$old_msg['to_id'] = $data[0]['users_id'];
							$old_msg['to_type'] = 'users';
							$old_msg['title'] = $title;
							$old_msg['from_type'] = 'Livestoc Team';
							$old_msg['success'] = '1';
							$old_msg['device'] = 'android';
							$old_msg['active'] = '1'; 
							$old_msg['description'] = $msg1;
							$old_msg['date_added'] = date('Y-m-d h:i:s');
							$this->api_model->old_notification($old_msg);
							$this->simple_push_none($data[0]['users_id'], 2 , $title, '1', $msg);
						}else{
							$update['status'] = '3';
							$this->api_model->get_data_update('id = "'.$data[0]['id'].'"', 'vt_requests', $update);
							$title = 'AI Request Cancelled';
							$msg1 = 'Sorry, we regret to inform you that our service providers are unable to accept your request at this time. Please try after some time.';
							$msg['users_id'] = $data[0]['users_id'];
							$msg['title'] = $title;
							$msg['message'] = $msg1;
							$msg['date'] = date('Y-m-d h:i:s');
							$msg['type'] = '2';
							$msg['isactive'] = '1';
							$msg['flag'] = '1';
							$this->api_model->user_notification($msg);
							$old_msg['to_users_id'] = $data[0]['users_id'];
							$old_msg['to_id'] = $data[0]['users_id'];
							$old_msg['to_type'] = 'users';
							$old_msg['title'] = $title;
							$old_msg['from_type'] = 'Livestoc Team';
							$old_msg['success'] = '1';
							$old_msg['device'] = 'android';
							$old_msg['active'] = '1'; 
							$old_msg['description'] = $msg1;
							$old_msg['date_added'] = date('Y-m-d h:i:s');
							$this->api_model->old_notification($old_msg);
							$this->simple_push_none($data[0]['users_id'], 2 , $title, '1', $msg);
						}
					}
				}
			}else{
					if($data[0]['treat_type'] == '3'){
						$update['status'] = '3';
						$this->api_model->get_data_update('id = "'.$data[0]['id'].'"', 'vt_requests', $update);
						$title = 'AI Request Cancelled';
						$msg1 = 'Sorry, we regret to inform you that our service providers are unable to accept your request at this time. Please try after some time.';
						$msg['users_id'] = $data[0]['users_id'];
						$msg['title'] = $title;
						$msg['message'] = $msg1;
						$msg['date'] = date('Y-m-d h:i:s');
						$msg['type'] = '2';
						$msg['isactive'] = '1';
						$msg['flag'] = '1';
						$this->api_model->user_notification($msg);
						$old_msg['to_users_id'] = $data[0]['users_id'];
						$old_msg['to_id'] = $data[0]['users_id'];
						$old_msg['to_type'] = 'users';
						$old_msg['title'] = $title;
						$old_msg['from_type'] = 'Livestoc Team';
						$old_msg['success'] = '1';
						$old_msg['device'] = 'android';
						$old_msg['active'] = '1'; 
						$old_msg['description'] = $msg1;
						$old_msg['date_added'] = date('Y-m-d h:i:s');
						$this->api_model->old_notification($old_msg);
						$this->simple_push_none($data[0]['users_id'], 2 , $title, '1', $msg);
					}
			}
		}
		// print_r($data);
		// echo date('Y-m-d h:i:s');
		// echo "<br>";
		// echo $my_date_time;
	}
	public function make_treat_payement(){
		$users_id = $this->input->get_post('users_id');
		$data['users_id'] = $users_id; 
		$doc_id = $this->input->get_post('doc_id');
		$amount = $this->input->get_post('amount');
		$request_id = $this->input->get_post('request_id');
		// $doc_rate = $this->api_model->get_doc_id_det($doc_id);
		//$product_rate = $doc_rate['visiting_fee'];
		$product_rate = $amount;
		$data['log_id'] = $this->input->get_post('log_id');
		$data['type'] = '26';
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$address = $this->input->get_post('address');
		$data['wallet_type'] = '1';
		$data['animal_id'] = $doc_id;
		$data['date'] = date('Y-m-d h:i:s');
		$data['status'] = 'Dr';
		$data['amount'] = $product_rate;
		$data['animal_id'] = $lead;
		$le['status'] = '1';
		if($request_id != ''){
			$l_data['request_id'] = $request_id ? $request_id : 0;
			$l_data['request_status'] = '2';
			$this->api_model->get_data_update('id = '.$data['log_id'].'', 'log_file', $l_data);
			$vt_request['vt_id'] = $doc_id;
			$vt_request['log_id'] = $data['log_id'];
			$vt_request['status'] = '1';
			$this->api_model->get_data_update('id = '.$request_id.'', 'vt_requests', $vt_request);
			$this->api_model->submit('livestoc_wallets', $data);
			// $doctor = $this->api_model->get_data('doctor_id = '.$doc_id.'','doctor');
			// $invoice['log_id'] = $data['log_id'];
			// $invoice['request_id'] = $request_id ? $request_id : 0;
			// $invoice['users_id'] = $users_id;
			// $invoice['ai_price'] = $amount;
			// $invoice['semen_stock_price'] = $doctor[0]['visiting_fee'] - (($doctor[0]['visiting_fee']*HOME_VISIT)/100) ;
			// $invoice['semen_stock_qty'] = 1;
			// $invoice['status'] = '2';
			// $invoice['date'] = date('Y-m-d h:i:s');
			// $ini = $this->api_model->submit('semen_invoice_performa', $invoice);
			// $ai_log['request_id'] = $request_id;
			// $ai_log['log_id'] = $data['log_id'];
			// $ai_log['vt_id'] = $doc_id;
			// $ai_log['invoice_id'] = $ini;
			// $ai_log['company_charges'] = ($doctor[0]['visiting_fee']*HOME_VISIT)/100;
			// $ai_log['farmer_price'] = $amount;
			// $ai_log['ai_service_price'] =$doctor[0]['visiting_fee'] - (($doctor[0]['visiting_fee']*HOME_VISIT)/100) ;
			// $ai_log['premium_type'] = '0';
			// $ai_log['status'] = '1';
			// $ai_log['date_time'] = date('Y-m-d h:i:s');
			// $this->api_model->submit('ai_log', $ai_log);	
			
		}else{
			$otp_l = rand(1000,9999);
				$req_filed['users_id'] = $users_id;
				$req_filed['treat_type'] = '6';
				$req_filed['vt_id'] = $doc_id;
				$req_filed['vacc_id'] = '';
				$req_filed['animal_simtoms'] = '';
				$req_filed['status']  = '1';
				$req_filed['address'] = $address;
				$req_filed['latitude'] = $latitude?$latitude:'0';
				$req_filed['langitude '] = $langitude?$langitude:'0';
				$req_filed['otp'] = $otp_l;
				$req_filed['created_on'] =  date('Y-m-d H:i:s');
				$req_filed['date'] = date('Y-m-d');
				$insert = $this->api_model->insert_vt_request($req_filed);
					//$otp_2 = rand(1000,9999);
					$r_data['request_id'] = $insert; 
					$r_data['user_id'] = $users_id;
					$r_data['animal_id'] = '';
					$r_data['treat_type'] = '6';
					$r_data['doc_id'] = $doc_id;
					$r_data['animal_simtoms'] = '';
					$r_data['vacc_id'] = '';
					$r_data['vt_id'] = $doc_id;
					$r_data['status'] = '1';
					$r_data['treat_status'] = '1';
					$r_data['type'] = '1';
					$r_data['otp'] = $otp_l;
					$r_data['date'] = date('Y-m-d');
					$this->api_model->insert_vt_track_request($r_data);
					$this->api_model->update('id', $lead, 'lead_breader_dealer', $le);
		}
				//$req_filed['animal_id'] = $total_im_animal;
				
					
					//$msg['users_id'] = $doc_id;
					$msg['title'] = "Visitation Request";
					$msg['message'] = 'You have a new request for home visit';
					$msg['date'] = date('Y-m-d h:i:s');
					//$msg['type'] = '2';
					$msg['isactive'] = '1';
					$msg['flag'] = '1';
					//$this->api_model->user_notification($user_note);
					// $ms = "Your treatment has been Rescheduled";
					// $msg['message'] = $ms;
					$msg['users_id'] = $doc_id;
					$msg['type'] = '1';
					//$msg['title'] = "Treatment";
					$this->pushnoti_model->insert_noti($msg);
					$old_msg['to_users_id'] = $doc_id;
					$old_msg['to_id'] = $doc_id;
					$old_msg['to_type'] = 'users';
					$old_msg['title'] = "Visitation Request";
					$old_msg['from_type'] = 'Livestoc Team';
					$old_msg['success'] = '1';
					$old_msg['device'] = 'android';
					$old_msg['active'] = '1'; 
					$old_msg['description'] = 'You have a new request for home visit';
					$old_msg['date_added'] = date('Y-m-d h:i:s');
					$this->api_model->old_notification($old_msg);
					$this->push_non($msg['users_id'], 1 , $msg['title'], $msg['flag'], PARAVATE_SERVERKEY, PARAVATE_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
		$json['success'] = true;
		$json['msg'] = 'Your request for home visit has been sent.';
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function doc_account_status(){
		$doc_id = $this->input->get_post('doc_id');
		$currency = $this->input->get_post('currency');
		$query = "call get_doc_account (".$doc_id.");";
		$data = $this->api_model->query_build($query);
		$this->db->close();
		//$query = "call get_doc_call_account(".$doc_id.")";
		$query = "Select count(id) as count, if(sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)) IS NOT NULL, sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)),0) as company_share, if(sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))) IS NOT NULL,sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))), 0) as your_share from doctor_call_inisite where log_id <> '0' AND doctor_id = '".$doc_id."'";
		$call_data = $this->api_model->query_build($query);
		// $query = "select sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Cr' AND ((select request_status from log_file where id = com.log_id) <> '1' OR log_id = '0')";
		// $account_summary = $this->api_model->query_build($query);
		// $query = "select sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Cr' AND (select request_status from log_file where id = com.log_id) = '1'";
		// $account_summary_online = $this->api_model->query_build($query);
		$query = "select  sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Cr' AND (select request_status from log_file where id = com.log_id) = '1' AND log_id <> '0'";
		$account_dr_summary = $this->api_model->query_build($query);
		$query = "select  sum(amount) as amount from company_settlement_account as com where users_id = ".$doc_id." AND company_status = 'Dr' AND (select request_status from log_file where id = com.log_id) = '1' AND log_id <> '0'";
		$account_dr_summary_online = $this->api_model->query_build($query);
		$your_share = ($data[0]['total_cr'] + $call_data[0]['your_share'] + $account_dr_summary[0]['amount'] + $account_dr_summary_online[0]['amount']);
		$company_share = $call_data[0]['company_share'] + $account_dr_summary_online[0]['amount'] ;
		// echo "<pre>";
		// print_r($data);
		// print_r($call_data);
		// print_r($account_summary);
		// print_r($account_summary_online);
		// print_r($account_dr_summary);
		// print_r($account_dr_summary_online);
		// // // if($total_yours < $account_summary[0]['amount']){
		// // 	$your_share = $total_yours;
		// // }else{
		// // 	if($data[0]['total_dr'] >=  $account_summary[0]['amount']){
		// // 		$your_share =  $total_yours - $account_summary[0]['amount'];
		// // 	}else{
		// // 		$your_share =  $total_yours -  $account_summary[0]['amount'];
		// // 	}
		// // }
		// $your_share = $total_yours;
		$company_share = $data[0]['total_dr'];
		if($company_share > $your_share){
			$pay = $company_share - $your_share;
			$log['users_id'] = $doc_id;
			$log['currency'] = $currency;
			$log['type'] = '32';
			$log['amount'] = $pay * 100;
			$log['user_type'] = '0';
			$log['premium_bull_type'] = '';
			$log['request_status'] = '0';
			$log['date'] = date('Y-m-d h:i:s');
			$log_id = $this->api_model->insert_log_data($log);
			$log_id = $log_id[0]['purchase_id'];
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$log_id."&amount=".$pay."&currency=".$currency."",
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
			$json['success'] = true;
			$json['razorpayOrderId'] =  json_decode($response);
			$json['order_id'] = "LVAT_".$log_id;
			$json['purchase_id'] = $log_id;
			$json['company_amount'] = $company_share - $your_share;
			$json['your_share'] = 0;
			$json['rest_balance'] =$pay;
			$json['amount'] = '0';
			$json['call_check_account'] = CALL_CHECK_ACCOUNT;
			$json['limit'] = '0';
		}else{
			if($your_share > $company_share){

				$json['success'] = true;
				$json['razorpayOrderId'] =  '';
				$json['order_id'] = '';
				$json['purchase_id'] = '';
				$json['company_amount'] = 0;
				$json['your_share'] = $your_share - $company_share;
				//if($company_share == '0'){
					$json['rest_balance'] = '0';
				//}else{
					//$json['rest_balance'] = $company_share;
				//}
				$json['amount'] = '0';
				$json['call_check_account'] = CALL_CHECK_ACCOUNT;
				$json['limit'] = '0';
				//$json['msg'] = "We have settled Company's money from your balance";
			}else{
				$json['success'] = false;
				$json['razorpayOrderId'] =  '';
				$json['order_id'] = '';
				$json['purchase_id'] = '';
				$json['company_amount'] = '0';
				$json['your_share'] = '0';
				$json['rest_balance'] = '0';
				$json['amount'] = 0;
				$json['call_check_account'] = CALL_CHECK_ACCOUNT;
				$json['limit'] = '0';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function account_settale_payment(){
		$company_share = $this->input->get_post('company_share');
		$doc_id = $this->input->get_post('doc_id');
		$your_share = $this->input->get_post('your_share');
		$type = $this->input->get_post('type');
		$currency = $this->input->get_post('currency');
			$log['users_id'] = $doc_id;
			$log['currency'] = $currency;
			$log['type'] = $type;
			$log['amount'] = $company_share * 100;
			$log['user_type'] = '1';
			$log['payment_type'] = 'Dr';
			$log['premium_bull_type'] = '';
			$log['request_status'] = '0';
			$log['date'] = date('Y-m-d h:i:s');
			$log_id = $this->api_model->insert_log_data($log);;
			$data['payment_type'] = $type;
			$data['users_id'] = $doc_id;
			$data['log_id'] = $log_id[0]['purchase_id'];
			$data['users_type'] = '1';
			$data['status'] = 'Dr';
			$data['company_status'] = 'Cr';
			$data['amount'] = $company_share;
			$data['date'] = date('Y-m-d');
			$this->api_model->submit('company_settlement_account', $data);
			// if($company_share > 0){
			// 	$data['payment_type'] = $type;
			// 	$data['users_id'] = $doc_id;
			// 	$data['log_id'] = '0';
			// 	$data['users_type'] = '1';
			// 	$data['status'] = 'Dr';
			// 	$data['company_status'] = 'Cr';
			// 	$data['amount'] = $company_share;
			// 	$this->api_model->submit('company_settlement_account', $data);
			// }
			$json['success'] = true;
			$json['amount'] = $your_share - $company_share;
			$json['msg'] = "We have settled Company's money from your balance";
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doctore_account(){
		$id = $this->input->get_post('id');
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$dateto = $this->input->get_post('datefrom');
		$datefrom = $this->input->get_post('dateto');
		$perpage = ITEMS_PER_PAGE;
		$type = $this->input->get_post('type');
		$perpage = 20;
		// echo "<pre>";
		$detail = $this->api_model->get_doctore_account($id, $name, $start, $perpage, $dateto, $datefrom);
		$query = "call get_doc_account (".$id.");";
		$count = $this->api_model->query_build($query);
		$this->db->close();
		$query = "Select count(id) as count, if(sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)) IS NOT NULL, sum((((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100)),0) as company_share, if(sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))) IS NOT NULL,sum(((doctor_charge*call_total_minute) - (((doctor_charge * call_total_minute) * ".CALL_PERCENTAGE.")/100))), 0) as your_share from doctor_call_inisite where log_id <> '0' AND doctor_id = '".$doc_id."'";
		$call_data = $this->api_model->query_build($query);
		$query = "select sum(amount) as amount from company_settlement_account as com where users_id = ".$id." AND company_status = 'Cr' AND ((select request_status from log_file where id = com.log_id) <> '1' OR log_id = '0')";
		$account_summary = $this->api_model->query_build($query);
		$query = "select sum(amount) as amount from company_settlement_account as com where users_id = ".$id." AND company_status = 'Cr' AND (select request_status from log_file where id = com.log_id) = '1' AND log_id <> '0'";
		$account_summary_online = $this->api_model->query_build($query);
		// print_r($count);
		// print_r($account_summary);
		// print_r($account_summary_online);
		$total_yours = ($count[0]['total_cr']);
		$your_share = $total_yours;
		$company_share = $count[0]['total_dr'] - $account_summary_online[0]['amount'];
		//$count[0]['total_cr'] = $count[0]['total_cr'] - $account_summary[0]['amount'];
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
		if($detail)
		{
			$json['success']  = TRUE;
			$json['data'] = array_values($detail);
			$json['count'] = $count;
		}
		else
		{
			$json['success']  = false; 
			$json['error'] = 'No Data Found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_farmer(){
		$name = $this->input->get_post('serach');
		if($name == ''){
			$json['success'] = false;
			$json['error'] = 'Please send search item';
		}else{
			$data = $this->api_model->usersearch($name);
			if(!empty($data)){
				$json['success'] = true;
				$json['data'] = $data;
			}else{
				$json['success'] = false;
				$json['error'] = 'No record found';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function test_json(){
		$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://etsrds.kapps.in/webapi/enterprise/v1/makecall.py",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => array('k_number' => '+916366783212','caller_id' => '+918047248869','agent_number' => '+919918990731','customer_number' => '+917986060078','timer' => '00:09:05','user_type_agent' => '984','user_id_agent' => '984','user_type_customer' => '984','user_id_customer' => '984'),
			  CURLOPT_HTTPHEADER => array(
			    "authorization: 95d4c58b-80a1-4e75-bf78-5970a52d0c11",
			    "x-api-key: nDRUngYws3739teklCMYp9IufbQ8qjf212iyMkiG",
			    "Content-Type: multipart/form-data; boundary=--------------------------275353496800163766266088"
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;
		//$sms_template_vars = array('var1'=>$user_data['full_name']);
		            //$send_sms_res = globalfunctions::send_sms($mobile,'UserRegistration', $sms_template_vars);
		// $sms_template = urlencode('AIREQUEST');
		// $vars = array('var1'=>'1234');
		// $mobile = '7007692445';
		// $curl = curl_init();

		// $url = "https://2factor.in/API/R1/?module=TRANS_SMS&apikey=85aab6cd-b267-11e7-94da-0200cd936042&to=$mobile&from=LIVEST&templatename=$sms_template";
		// foreach($vars as $key=>$var){
		// $url .=	"&".$key."=".urlencode($var);
		// }
  //       curl_setopt_array($curl, array(
  //       CURLOPT_URL => $url,
  //       CURLOPT_RETURNTRANSFER => true,
  //       CURLOPT_ENCODING => "",
  //       CURLOPT_MAXREDIRS => 10,
  //       CURLOPT_TIMEOUT => 30,
  //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //       CURLOPT_CUSTOMREQUEST => "GET",
  //       CURLOPT_POSTFIELDS => "{}",
  //       ));

		
  //       $response = curl_exec($curl);
  //       $err = curl_error($curl);

  //       curl_close($curl);

		
  //       if ($err) {
  //       echo "cURL Error #:" . $err;
  //       } else {
  //        echo  $response;
  //       }
		// echo $json = '{"entity":"event","account_id":"acc_A0CUAE1RxCJyIZ","event":"payment.authorized","contains":["payment"],"payload":{"payment":{"entity":{"id":"pay_FJr8XaFqJgRK6Q","entity":"payment","amount":100,"currency":"INR","status":"authorized","order_id":null,"invoice_id":null,"international":false,"method":"netbanking","amount_refunded":0,"refund_status":null,"captured":false,"description":"Add Bull","card_id":null,"bank":"SBIN","wallet":null,"vpa":null,"email":"jarnail@livestoc.in","contact":"+917986060078","notes":{"purchase_id":"2250","shopping_order_id":"LVAT_2250","bank_id":"62903","user_type":"18","product_type":"LKBIG","animal_id":"[\"4122\"]","latitude":"30.7167342","address":"c 86 phase 7 industrial area, Phase 8B, Industrial Area, Sector 74, Sahibzada Ajit Singh Nagar, Punjab 160055, India","longitude":"76.6947301","contact_name":"jarnail singh","contact_number":"7986060078","semen_price":"90","bull_detail":"{\"animal_id\":\"[\\\"4122\\\"]\",\"avg_milk_proteen\":\"12\",\"daughter_yield\":\"19\",\"is_certified\":\"NO\",\"is_imported\":\"NO\",\"lat_yield\":\"19\",\"progini_test\":\"NO\",\"semen_price\":\"90\",\"semen_type\":\"Sexed\",\"total_milk_fat\":\"12\",\"total_milk_proteen\":\"\"}","bull_detail2":"{\"brochure\":\"\",\"championship_images\":\"\",\"health_certificate\":\"\",\"livestoc_balence_consume\":\"0\",\"purchase_amount\":\"1\",\"real_balance_consume\":\"0\",\"registration_certificate\":\"\"}"},"fee":null,"tax":null,"error_code":null,"error_description":null,"error_source":null,"error_step":null,"error_reason":null,"acquirer_data":{"bank_transaction_id":"8624684"},"created_at":1595926291}}},"created_at":1595926294}';
		// $json = ltrim($json,"'");
		// $json = rtrim($json,"'");
		// $data = json_decode('{"entity":"event","account_id":"acc_A0CUAE1RxCJyIZ","event":"payment.authorized","contains":["payment"],"payload":{"payment":{"entity":{"id":"pay_FJrq2CTJyx81fA","entity":"payment","amount":100,"currency":"INR","status":"authorized","order_id":null,"invoice_id":null,"international":false,"method":"netbanking","amount_refunded":0,"refund_status":null,"captured":false,"description":"Add Bull","card_id":null,"bank":"SBIN","wallet":null,"vpa":null,"email":"jarnail@livestoc.in","contact":"+917986060078","notes":{"purchase_id":"2251","shopping_order_id":"LVAT_2251","bank_id":"62903","user_type":"18","product_type":"LKBIG","animal_id":"4122","latitude":"30.7167342","address":"c 86 phase 7 industrial area, Phase 8B, Industrial Area, Sector 74, Sahibzada Ajit Singh Nagar, Punjab 160055, India","longitude":"76.6947301","contact_name":"jarnail singh","contact_number":"7986060078","semen_price":"58","bull_detail":"{\"animal_id\":\"4122\",\"avg_milk_proteen\":\"25\",\"daughter_yield\":\"26\",\"is_certified\":\"YES\",\"is_imported\":\"YES\",\"lat_yield\":\"25\",\"progini_test\":\"YES\",\"semen_price\":\"58\",\"semen_type\":\"Normal\",\"total_milk_fat\":\"25\",\"total_milk_proteen\":\"25\"}","bull_detail2":"{\"brochure\":\"1595928721.jpg\",\"championship_images\":\"1595928729.jpg\",\"health_certificate\":\"1595928725.jpg\",\"livestoc_balence_consume\":\"0\",\"purchase_amount\":\"1\",\"real_balance_consume\":\"0\",\"registration_certificate\":\"1595928716.jpg\"}"},"fee":null,"tax":null,"error_code":null,"error_description":null,"error_source":null,"error_step":null,"error_reason":null,"acquirer_data":{"bank_transaction_id":"8179885"},"created_at":1595928761}}},"created_at":1595928763}');
		// echo "<pre>";
		// $da = json_decode($data->payload->payment->entity->notes->bull_detail2, true);
		//print_r($data->payload->payment->entity->notes->bull_detail2);
		//print_r($data);
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
	public function test_call_api(){
		$number1 = $this->input->get_post('number1');
		$number2 = $this->input->get_post('number2');
		$number1 = '+91'.$number1;  //number1 mens user
		$number2 = '+91'.$number2;  // number2 mens doctor
		// print_r($number1);
		// print_r($number2);
		$time = $this->input->get_post('duration');

		    $curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://etsrds.kapps.in/webapi/enterprise/v1/makecall.py",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => array('k_number' => '+916366783212','caller_id' => '+918047248869','agent_number' => ''.$number1.'','customer_number' => ''.$number2.'','timer' => ''.$time.''),
			  CURLOPT_HTTPHEADER => array(
			    "Authorization: 95d4c58b-80a1-4e75-bf78-5970a52d0c11",
			    "x-api-key: nDRUngYws3739teklCMYp9IufbQ8qjf212iyMkiG"
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;
		// $curl = curl_init();

		// 	curl_setopt_array($curl, array(
		// 	  CURLOPT_URL => "http://etsrds.kapps.in/webapi/enterprise/v1/makecall.py",
		// 	  CURLOPT_RETURNTRANSFER => true,
		// 	  CURLOPT_ENCODING => "",
		// 	  CURLOPT_MAXREDIRS => 10,
		// 	  CURLOPT_TIMEOUT => 30,
		// 	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 	  CURLOPT_CUSTOMREQUEST => "POST",
		// 	  CURLOPT_POSTFIELDS => "{\n  \"k_number\": \"+916366783212\",\n  \"agent_number\": \"+919918990731\",\n  \"customer_number\": \"+917007692445\",\n  \"caller_id\": \"+918047248869\"\n}",
		// 	  CURLOPT_HTTPHEADER => array(
		// 	    "authorization: 95d4c58b-80a1-4e75-bf78-5970a52d0c11",
		// 	    "cache-control: no-cache",
		// 	    "postman-token: d1a26172-8518-0705-d546-c464d3303c9f",
		// 	    "x-api-key: nDRUngYws3739teklCMYp9IufbQ8qjf212iyMkiG"
		// 	  ),
		// 	));
		// 	$response = curl_exec($curl);
		// 	$err = curl_error($curl);
		// 	curl_close($curl);
		// 	if ($err) {
		// 	  echo "cURL Error #:" . $err;
		// 	} else {
		// 	  echo $response;
		// 	}
	}
	public function get_doc_package_list(){
		$doc_id = $this->input->get_post('doc_id');
		$pack = $this->api_model->get_data('' , 'doctor_package', 'price DESC', 'id, groups as name, price, incentive_link,description');
		$detail = [];
		$elemente = [];
		$i = 0;
		foreach($pack as $pa){
			$detail['id'] = $pa['id'];
			$detail['name'] = $pa['name'];
			$detail['incentive_link'] = $pa['incentive_link'];
			$detail['price'] = $pa['price'];
			$detail['description'] = $pa['description'];
			$element =$this->api_model->get_data('pack_id = "'.$pa['id'].'"' , 'doc_package_elements', '', 'groups, straws');
			foreach($element as $ele){
				$detail[$ele['groups']] = $ele['straws'];
			}
			$doc_pack = $this->api_model->get_data('users_id = "'.$doc_id.'"', 'doc_package_log', 'id DESC', '*');
			if($doc_pack[0]['pack_id'] == $detail['id']){
				$detail['ispurchased'] = '1';
			}else{
				$detail['ispurchased'] = '0';
			}
			$elemente[] = $detail;
			$i++;
		}
		$json['success'] = true;
		$json['data'] = $elemente;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function doc_certificate_update(){
		$doc_id = $this->input->get_post('doc_id');
		$update = '';
		if($this->input->get_post('10th_pic')){
			$degree_name = '10th';
			$pic['image'] = $this->input->get_post('10th_pic');
			$this->api_model->get_data_update('doc_id = "'.$doc_id.'" AND degree_name = "'.$degree_name.'"', 'document_table', $pic);
			$update = 1;
		}
		if($this->input->get_post('10_plus_2')){
			$degree_name = '10th+2';
			$pic['image'] = $this->input->get_post('10_plus_2');
			$this->api_model->get_data_update('doc_id = "'.$doc_id.'" AND degree_name = "'.$degree_name.'"', 'document_table', $pic);
			$update = 1;
		}
		if($this->input->get_post('diploma')){
			$degree_name = 'diploma';
			$pic['image'] = $this->input->get_post('diploma');
			$this->api_model->get_data_update('doc_id = "'.$doc_id.'" AND degree_name = "'.$degree_name.'"', 'document_table', $pic);
			$update = 1;
		}
		if($update == 1){
			$json['success'] = true;
			$json['msg'] = 'Documents Successfully  Updated.';
		}else{
			$json['success'] = false;
			$json['error'] = 'Something went wrong';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_user_premium_package(){
		$id = $this->input->get_post('id');
		$users_id = $this->input->get_post('users_id');
		$detail = $this->api_model->premium_package($id, $users_id);		
		if(!empty($detail)){
			$json['success'] = true;
			$json['data'] = $detail;
		}else{			
			$json['success'] = false;
			$json['error'] = 'No record found.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_yield_checker(){
		// $id = $this->input->get_post('id');
		// $users_id = $this->input->get_post('users_id');
		$detail = $this->api_model->yield_checker($id, $users_id);		
		if(!empty($detail)){
			$json['success'] = true;
			$json['data'] = $detail;
		}else{			
			$json['success'] = false;
			$json['error'] = 'No record found.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_approved_certificate(){
		$doctor_id = $this->input->get_post('doctor_id');
		$detail = $this->api_model->document_details($doctor_id);		
		if(!empty($detail)){
			$json['success'] = true;
			$json['data'] = $detail;
		}else{			
			$json['success'] = false;
			$json['error'] = 'No record found.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doc_calculation(){
		$doc_id = $this->input->get_post('doc_id');
		$id = $this->input->get_post('id');
		$type = $this->input->get_post('type');
		$request_status = $this->input->get_post('request_status');
		$currency = $this->input->get_post('currency');
		$pack = $this->api_model->get_data('id = "'.$id.'"' , 'doctor_package', 'price ASC', '*');
		$a['min_balance'] = $pack[0]['price'];
		$log['users_id'] = $doc_id;
		$log['currency'] = $currency;
		$log['type'] = $type;
		$log['amount'] = $pack[0]['price'];

		$log['user_type'] = '1';
		$log['premium_bull_type'] = '';
		$log['request_status'] = isset($request_status) ? $request_status : 0;
		$log['date'] = date('Y-m-d h:i:s');
		$log_id = $this->api_model->insert_log_data($log);
		$a['log_id'] = $log_id[0]['purchase_id'];
		$logid = $log_id[0]['purchase_id'];
		$product_rate = $pack[0]['price'];
		$data = [];
		//$data['actual_security_amount'] = $pack[0]['actual_security_amount'];
		$data[0]['service_key'] = 'Registration Amount';
		$data[0]['price'] = $pack[0]['regstration_amount'];
		$data[1]['service_key'] = 'Security (Semen & Operations)';
		$data[1]['price'] = $pack[0]['security_amount'] + $pack[0]['amount'];
		$data[2]['service_key'] = 'Total Amount';
		$data[2]['price'] = $pack[0]['price'];
		$pr = $product_rate;
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
		$json['service_id'] = $pack[0]['id'];
		if($pack[0]['id'] == '7'){
			$pro['offer_title'] = "Special Offer :- Registration Amount";
			$pro['offer_mrp'] = $pack[0]['actual_security_amount'];
			$pro['offer_actual'] = $pack[0]['regstration_amount'];
			$json['actual_security_amount'] = $pro;
		}
		$json['purchase_amount'] = $product_rate;
		$json['actual_payment'] = $product_rate;
		$json['total_price'] = $product_rate;
		$json['livestoc_balence_status'] = 0;
		$json['livestoc_balence_consume'] = 0;
		$json['real_balance_status'] = 0;
		$json['real_balance_consume'] = 0;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function customer_vet_req(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('req_type');
		$admin_id = $this->input->get_post('admin_id');
		$app_type = $this->input->get_post('app_type');
		$where = '';
		if($type != ''){
			$where = ' AND treat_type = "'.$type.'"';
		}
		if($app_type == '3'){
			$data = $this->api_model->get_data('admin_id = "'.$admin_id.'" '.$where.'' , 'vt_requests', 'id DESC ', '
		id, log_id, users_id, if(Invoice_id<>0, CONCAT("'.base_url('api/vetinvoice/').'", Invoice_id), "") as invoice, animal_id, treat_type, vt_id, register_status, vacc_id, status, request_type, address, vt_type, animal_simtoms, CONCAT("'.IMAGE_PATH.'harpahu_merge_dev/uploads/treatment_image/",symptoms_image) as straw_image, latitude, langitude, otp, date, time, created_on');
		}else{
			$data = $this->api_model->get_data('users_id = "'.$users_id.'" '.$where.'' , 'vt_requests', 'id DESC ', '
		id, log_id, users_id, if(Invoice_id<>0, CONCAT("'.base_url('api/vetinvoice/').'", Invoice_id), "") as invoice, animal_id, treat_type, vt_id, register_status, vacc_id, status, request_type, address, vt_type, animal_simtoms, CONCAT("'.IMAGE_PATH.'harpahu_merge_dev/uploads/treatment_image/",symptoms_image) as straw_image, latitude, langitude, otp, date, time, created_on');
		}
		if($type == '1'){
			$data = $this->api_model->get_data('users_id = "'.$users_id.'" '.$where.'' , 'vt_requests', 'id DESC ', '
		id, log_id, users_id, if(Invoice_id<>0, CONCAT("'.base_url('package/invoice/').'", Invoice_id), "") as invoice, animal_id, treat_type, vt_id, register_status, vacc_id, status, request_type, address, vt_type, animal_simtoms, CONCAT("'.IMAGE_PATH.'harpahu_merge_dev/uploads/treatment_image/",symptoms_image) as straw_image, latitude, langitude, otp, date, time, created_on');
		}
		//print_r($data);
		if(!empty($data))
		{
            foreach($data as $row){
                    $ani_de = explode(',',$row['animal_id']);
                    if(!empty($ani_de[0])){
                        $ani_de = count($ani_de);
                    }else{
                        $ani_de = 0;
					}
						$anim = []; 
						$ani_a =[];
						if(!is_null($row['animal_id']) && $row['animal_id'] != ''){
							// echo "<pre>";
							// echo $row['animal_id'];
							$animal_data = $this->api_model->get_animal_in_id($row['animal_id']);
							foreach($animal_data as $ani){
								$anim['animal_name']= $ani['fullname'];
								$anim['gender']= $ani['gender'];
								$animal_category = $this->api_model->get_animal_category($ani['category_id']);
								$anim['animal_category'] = $animal_category[0]['category'];
								$animal_breed = $this->api_model->get_animal_breed($seman_data[0]['bread']);
								$anim['animal_breed'] = $animal_breed[0]['breed_name']; 
								$anim['animal_id']= $ani['animal_id'];
								$anim['animal_dob']= $ani['dob'];
								$img = $this->api_model->get_animal_image($ani['animal_id']);
								$imm = '';
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
								if(empty($imm['images']) || $imm['images'] == ''){
									$imm['images'] = [];
								}
								$anim['animal_image'] = $imm['images'];
								$ani_a[] =$anim; 
							}
						
						}
						$row['animal_data'] = $ani_a;
					$vt_data = '';
					if($row['status'] != '0'){
						if(!is_null($row['vt_id']) || $row['vt_id'] != ''){
							$vt_data = $this->api_model->doc_detail_id($row['vt_id']);
							$row['vt_name'] = $vt_data[0]['username'];
							$row['vt_mobile'] = $vt_data[0]['mobile'];
							$row['vt_image'] = base_url()."uploads/doc/".$vt_data[0]['image'];
						}
					}
                    if($row['treat_type'] == 3){
                        $seman_data = $this->api_model->get_seman_detail($row['vacc_id']);
                        $animal_breed = $this->api_model->get_animal_breed($seman_data[0]['bread']);
                        $row['seman_bread_name'] = $animal_breed[0]['breed_name']; 
						$animal_category = $this->api_model->get_animal_category($seman_data[0]['category']);
						if($row['vacc_id'] != '0'){
							$row['semen_tag_no'] = 'LIVE_'.$row['vacc_id'];
						}else{
							$row['semen_tag_no'] = '';
						}
                        $row['seman_category'] = $animal_category[0]['category'];
                        $row['seman_price'] = $seman_data[0]['price'];
                        $group = $this->api_model->get_data('id = "'.$seman_data[0]['groups'].'"', 'semen_group','','*');
                		$row['seman_groups'] = $group[0]['group'];
                        //$row['seman_groups'] = $seman_data[0]['groups'];
                        $row['vt_price'] = $seman_data[0]['vt_ai_price'];
                    }
                    $row['animal_count'] = $ani_de;
                    $detail[] =  $row;
			}
			//exit;
			$json['success'] = true;
			$json['data'] = $detail;
		}
		else{
			$json['success'] = false;
			$json['error'] = 'No data found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function make_payment_ai_wallet(){
		$vt_id = $this->input->get_post('vt_id');
		$bull_id = $this->input->get_post('bull_id');
		$users_id =$this->input->get_post('users_id');
		$animal_id =$this->input->get_post('animal_id');
		$admin_id = $this->input->get_post('admin_id');
		$app_type = $this->input->get_post('app_type');
		$request_type = $this->input->get_post('request_type');
		$address = $this->input->get_post('address');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$order_type = $this->input->get_post('order_type');
		$amount = $this->input->get_post('amount');
		$livestoc_balence_consume = $this->input->get_post('livestoc_balence_consume');
		$real_balance_consume = $this->input->get_post('real_balance_consume');
		$log_id = $this->input->get_post('log_id');
		if($users_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send User ID';
		}
		// else if($animal_id == ''){
		// 	$json['success'] = false;
		// 	$json['error'] = 'Please send Animal Id';
		// }
		else if($log_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send Log Id';
		}else{
			if($livestoc_balence_consume != '0'){
				$wall['log_id'] = $log_id;
				if($app_type == '3'){
					$wall['users_id'] = $admin_id;
					$wall['user_type'] = '3';
				}else{
					$wall['users_id'] = $users_id;
				}
				$wall['animal_id'] = '';
				$wall['type'] = '27';
				$wall['amount'] = $livestoc_balence_consume;
				$wall['status'] = 'Dr';
				$wall['wallet_type'] = '0';
				$wall['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('livestoc_wallets',$wall);
			}
			if($real_balance_consume != '0'){
				$wall['log_id'] = $log_id;
				if($app_type == '3'){
					$wall['users_id'] = $admin_id;
					$wall['user_type'] = '3';
				}else{
					$wall['users_id'] = $users_id;
				}
				$wall['animal_id'] = '';
				$wall['type'] = '27';
				$wall['amount'] = $real_balance_consume;
				$wall['status'] = 'Dr';
				$wall['wallet_type'] = '1';
				$wall['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('livestoc_wallets',$wall);
			}
			$animal_id = json_decode($animal_id);
			$ani = implode(',', $animal_id);
			//$bull_id = json_decode($bull_id);
			if($request_type == '2'){
				$vt_type = $this->api_model->get_ai_doc_stoc('pvt_ai', $langitude, $latitude, $bull_id, $order_type);
				$l=0;
				foreach($vt_type as $v){
					if($l == '0'){
						$do = $v['doctor_id'];
					}else{
						$do .= ','.$v['doctor_id'];
					}
					$vet[$l] = $v['doctor_id'];
					if($l == '5'){
					break;
					}
					$l++;
				}
				$vt_id =$do;
			}else{
				$vt_id = json_decode($vt_id);
				$vet = $vt_id;
				$vt_id = implode(',', $vt_id);
			}
			// $vt_id = json_decode($vt_id);
			$bull = $bull_id;
			// $vt_id = implode(',', $vt_id);
			$treat_type = 4;
			$status = '0';
			$rand = rand(1000,9999);
			// if($request_type == '0'){
			// 	$status = '1';
			// }
			//if($request_type == '2'){
				$data['vt_id'] = $vt_id;
			//}
			$bull_data = $this->api_model->get_data('id = "'.$bull.'"' , 'bull_table', '', '*');
			$semen_group = $this->api_model->get_data('id ="'.$bull_data[0]['groups'].'"', 'semen_group','','*');
			if($order_type == '1'){
				// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
				// if($pack_data[0]['sum'] >  0){
				$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
				$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
				$end_data = date('Y-m-d');
				if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
					$data['premium_type'] = '1';
				}
			}
			$data['vacc_id'] = $bull;
			$data['log_id'] = $log_id;
			$data['users_id'] =$users_id;
			$data['animal_id'] = $ani;
			$data['admin_id'] = $admin_id;
			$data['treat_type'] = $treat_type;
			$data['address'] = $address;
			$data['latitude'] = $latitude;
			$data['langitude'] = $langitude;
			$data['status'] = $status;
			$data['order_type'] = $order_type;
			$data['request_type'] = $request_type;
			$data['treat_type'] = '3';
			$data['otp'] = $rand;
			$data['date'] = date('Y-m-d');
			$data['time'] = '00:00';
			$data['created_on'] = date('Y-m-d h:i:s');
			$da = $this->api_model->submit('vt_requests', $data);
			// print_r($data);
			// exit;
			$log['type'] = '27';
			if($app_type == '3'){
				$log['users_id'] = $admin_id;
			}else{
				$log['users_id'] = $users_id;
			}
			$log['currency'] = 'INR';
			$log['request_id'] = $da;
			$log['request_status'] = '1';
			$log['status'] = '1';
			$log['user_type'] = '1';
			$log['date'] = date('Y-m-d');
			$log['method'] = 'Payment From Wallet';
			$this->api_model->update('id', $log_id, 'log_file', $log);
			//$this->api_model->submit('log_file', $log);
			$ra = rand(1000,9999);
			$dat = [];
			if(!empty($animal_id)){
				foreach($animal_id as $bu){
					$dat['request_id'] = $da;
					$dat['log_id'] = $log_id;
					$dat['animal_id'] = $bu;
					$dat['vt_id'] = $vt_id;
					$dat['request_type'] = $request_type;
					$dat['user_id'] = $users_id;
					$dat['vacc_id'] = $bull;
					$dat['treat_type'] = '3';
					$dat['treat_status'] ='0';
					$dat['status'] = $status;
					$dat['otp'] = $ra;
					$dat['date'] = date('Y-m-d');
					$this->api_model->submit('vt_request_tracking', $dat);
				}
			}else{
					$dat['request_id'] = $da;
					$dat['log_id'] = $log_id;
					$dat['animal_id'] = '';
					$dat['vt_id'] = $vt_id;
					$dat['request_type'] = $request_type;
					$dat['user_id'] = $users_id;
					$dat['vacc_id'] = $bull;
					$dat['treat_type'] = '3';
					$dat['treat_status'] ='0';
					$dat['status'] = $status;
					$dat['otp'] = $ra;
					$dat['date'] = date('Y-m-d');
					$this->api_model->submit('vt_request_tracking', $dat);
			}
			$user = $this->api_model->get_user_detail($users_id);
			// if($request_type == '0' || $request_type == ''){
				foreach($vet as $v){
						$user_note = '';
						$title = 'AI Request Placed';
						$flag = 1;
						$msg1 = 'You have new AI request by '.$user[0]['fullname'].' ('.$user[0]['address'].')';
						$user_note['users_id'] = $v; 
						$user_note['title'] = $title;
						$user_note['message'] = $msg1;
						$user_note['date'] = date('Y-m-d h:i:s');
						$user_note['type'] = '2';
						$user_note['isactive'] = '1';
						$user_note['flag'] = '1';
						$this->api_model->user_notification($user_note);
						$this->push_non($v,  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg1);
				}
			// }else if($request_type == '2'){
			// 	$vt_data = $this->api_model->get_ai_doc_stoc('pvt_ai', $langitude, $latitude);
			// 	foreach($vt_data as $vr){
			// 			$user_note = '';
			// 			$title = 'AI Request Placed';
			// 			$flag = 1;
			// 			$msg1 = 'You have new AI request by '.$user[0]['fullname'].' ('.$user[0]['address'].')';
			// 			$user_note['users_id'] = $vr['doctor_id'];
			// 			$user_note['title'] = $title;
			// 			$user_note['message'] = $msg1;
			// 			$user_note['date'] = date('Y-m-d h:i:s');
			// 			$user_note['type'] = '2';
			// 			$user_note['isactive'] = '1';
			// 			$user_note['flag'] = '1';
			// 			$this->api_model->user_notification($user_note);
			// 			$this->push_non($vr['doctor_id'],  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg1);
			// 	}
			// }
			$msg['users_id'] = $users_id;
			$msg['title'] = "AI Request Placed";
			$msg['message'] = 'Your AI request has been successfully generated.';
			$msg['date'] = date('Y-m-d h:i:s');
			$msg['type'] = '2';
			$msg['isactive'] = '1';
			$msg['flag'] = '1';
			$this->api_model->user_notification($msg);
			$old_msg['to_users_id'] = $users_id;
			$old_msg['to_id'] = $users_id;
			$old_msg['to_type'] = 'users';
			$old_msg['title'] = "AI Request Placed";
			$old_msg['from_type'] = 'Livestoc Team';
			$old_msg['success'] = '1';
			$old_msg['device'] = 'android';
			$old_msg['active'] = '1'; 
			$old_msg['description'] = 'Your AI request has been successfully generated.';
			$old_msg['date_added'] = date('Y-m-d h:i:s');
			$this->api_model->old_notification($old_msg);
			$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
			$u_data = $this->api_model->get_user_info_id($users_id);
			$to = TO_ADMIN;
			$subject = 'AI Request';
			$email = ''.$u_data[0]['full_name'].'('.$u_data[0]['mobile'].') has been initiated a AI request from '.$address.'';
			$e = $this->send_mail($to, $subject, $email);
			// print_r($e);
			// exit;
			$json['success'] = true;
			$json['msg'] = 'Your AI request has been successfully generated.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function make_lead_payement(){
		$lead_id= $this->input->get_post('lead_id');
		$users_id = $this->input->get_post('users_id');
		$data['users_id'] = $this->input->get_post('users_id');
		$data['log_id'] = $this->input->get_post('log_id');
		$data['type'] = $this->input->get_post('type');
		$data['wallet_type'] = '1';
		$data['user_type'] = '0';
		$data['date'] = date('Y-m-d h:i:s');
		$data['status'] = 'Dr';
		$data['amount'] = UNLOCK_PRICE;
		$lead_id = json_decode($lead_id, true);
		foreach($lead_id as $lead){
			$data['animal_id'] = $lead;
			$le['status'] = '1';
			$this->api_model->update('id', $lead, 'lead_breader_dealer', $le);
			$lead_count = $this->api_model->get_data('users_id = "'.$users_id.'" and rest_qty <> 0','dealer_breader_lead_log', '', 'if(sum(rest_qty) IS NOT NULL, sum(rest_qty), 0) as count');
			if($lead_count[0]['count'] != '0'){
				$consume = $this->api_model->get_data('users_id = "'.$users_id.'" and rest_qty <> 0', 'dealer_breader_lead_log','','id, rest_qty');
				foreach($consume as $con){
					$update['rest_qty'] = $con['rest_qty'] - 1; 
					$this->api_model->get_data_update('id = '.$con['id'].'', 'dealer_breader_lead_log', $update);
					break;
				}
			}else{
				$this->api_model->submit('livestoc_wallets', $data);
			}
		}
		$json['success'] = true;
		$led = $this->api_model->get_data('users_id = "'.$users_id.'" and rest_qty <> 0','dealer_breader_lead_log', '', 'if(sum(rest_qty) IS NOT NULL, sum(rest_qty), 0) as count');
		$json['count'] = $led[0]['count'];
		$json['msg'] = 'You have successfully unlocked the lead.';
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
		public function make_doc_lead_payement(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['log_id'] = $this->input->get_post('log_id');
		$lead_id= $this->input->get_post('lead_id');
		$data['type'] = $this->input->get_post('type');
		$data['wallet_type'] = '1';
		$data['user_type'] = '1';
		$data['date'] = date('Y-m-d h:i:s');
		$data['status'] = 'Dr';
		$data['amount'] = UNLOCK_PRICE;
		$lead_id = json_decode($lead_id, true);
		foreach($lead_id as $lead){
			$data['animal_id'] = $lead;
			$le['status'] = '1';
			$this->api_model->update('id', $lead, 'lead_doc', $le);
			$this->api_model->submit('livestoc_wallets', $data);
		}
		$json['success'] = true;
		$json['msg'] = 'You have successfully unlocked the lead.';
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function make_cod_ai(){
		$vt_id = $this->input->get_post('vt_id');
		$bull_id = $this->input->get_post('bull_id');
		$users_id =$this->input->get_post('users_id');
		$animal_id =$this->input->get_post('animal_id');
		$request_type = $this->input->get_post('request_type');
		$address = $this->input->get_post('address');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$amount = $this->input->get_post('amount');
		$order_type = $this->input->get_post('order_type');
		$order_id = $this->input->get_post('log_id');
		$livestoc_balence_consume = $this->input->get_post('livestoc_balence_consume');
		$real_balance_consume = $this->input->get_post('real_balance_consume');
		$animal_id = json_decode($animal_id);
		$ani = implode(',',$animal_id);
		//$bull_id = json_decode($bull_id);
		//print_r($bull_id);
		// echo "<pre>";
		if($request_type == '2'){
			$vt_type = $this->api_model->get_ai_doc_stoc('pvt_ai', $langitude, $latitude, $bull_id, $order_type);
			$l=0;
			foreach($vt_type as $v){
				if($l == '0'){
					$do = $v['doctor_id'];
				}else{
					$do .= ','.$v['doctor_id'];
				}
				$vet[$l] = $v['doctor_id'];
				$l++;
			}
			$vt_id =$do;
		}else{
			$vt_id = json_decode($vt_id);
			$vet = $vt_id;
			$vt_id = implode(',', $vt_id);
		}
		$bull = $bull_id;
		$treat_type = 4;
		$status = '0';
		$rand = rand(1000,9999);
		$doc_data = $this->api_model->get_data('doctor_id = "'.$vt_id.'"', 'doctor', '', '*');
		if($order_type == '1'){
			$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
			$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
			$end_data = date('Y-m-d');
			if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
			// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
			// if($pack_data[0]['sum'] >  0){
				// if($doc_data[0]['company_partner'] == '1'){
					$data['premium_type'] = '1';
				// }
			}
		}
		$data['vt_id'] = $vt_id;
		if($bull != '')
		$data['vacc_id'] = $bull;
		$data['log_id'] = $order_id;
		$data['admin_id'] = $admin_id;
		$data['animal_id'] = $ani;
		$data['users_id'] =$users_id;
		$data['treat_type'] = $treat_type;
		$data['address'] = $address;
		$data['latitude'] = $latitude;
		$data['langitude'] = $langitude;
		$data['status'] = $status;
		$data['request_type'] = $request_type;
		$data['order_type'] = $order_type;
		$data['treat_type'] = '3';
		$data['otp'] = $rand;
		$data['date'] = date('Y-m-d');
		$data['time'] = '00:00';
		$data['created_on'] = date('Y-m-d h:i:s');
		$da = $this->api_model->submit('vt_requests', $data);
		if($livestoc_balence_consume != '0' && $livestoc_balence_consume != ''){
			$wall['log_id'] = $order_id;
			$wall['users_id'] = $users_id;
			$wall['type'] = '27';
			$wall['amount'] = $livestoc_balence_consume;
			$wall['status'] = 'Dr';
			$wall['wallet_type'] = '0';
			$wall['date'] = date('Y-m-d h:i:s');
			$w = $this->api_model->submit('livestoc_wallets',$wall);
		}
		if($real_balance_consume != '0' && $real_balance_consume != ''){
			$wall['log_id'] = $order_id;
			$wall['users_id'] = $users_id;
			$wall['type'] = '27';
			$wall['amount'] = $real_balance_consume;
			$wall['status'] = 'Dr';
			$wall['wallet_type'] = '1';
			$wall['date'] = date('Y-m-d h:i:s');
			$w = $this->api_model->submit('livestoc_wallets',$wall);
		}
		$log['type'] = '27';
		$log['users_id'] = $users_id;
		$log['currency'] = 'INR';
		$log['request_id'] = $da;
		$log['request_status'] = '2';
		$log['status'] = '2';
		$log['user_type'] = '1';
		$log['date'] = date('Y-m-d');
		$log['method'] = 'Cash on Delivery';
		$this->api_model->update('id', $order_id, 'log_file', $log);
		$ra = rand(1000,9999);
		$dat = [];
		if(!empty($animal_id)){
			foreach($animal_id as $bu){
				$dat['request_id'] = $da;
				$dat['vt_id'] = $vt_id;
				$dat['animal_id'] = $bu;
				$dat['log_id'] = $order_id;
				$dat['request_type'] = $request_type;
				$dat['user_id'] = $users_id;
				$dat['vacc_id'] = $bull;
				$dat['treat_type'] = '3';
				$dat['treat_status'] ='0';
				$dat['status'] = $status;
				$dat['otp'] = $ra;
				$dat['date'] = date('Y-m-d');
				$this->api_model->submit('vt_request_tracking', $dat);
			}
		}else{
				$dat['request_id'] = $da;
				$dat['vt_id'] = $vt_id;
				$dat['animal_id'] = '';
				$dat['log_id'] = $order_id;
				$dat['request_type'] = $request_type;
				$dat['user_id'] = $users_id;
				$dat['vacc_id'] = $bull;
				$dat['treat_type'] = '3';
				$dat['treat_status'] ='0';
				$dat['status'] = $status;
				$dat['otp'] = $ra;
				$dat['date'] = date('Y-m-d');
				$this->api_model->submit('vt_request_tracking', $dat);
		}
		$user = $this->api_model->get_user_detail($users_id);
		// if($request_type == '0' || $request_type == ''){
			foreach($vet as $v){
					$user_note = '';
					$title = 'AI Request Placed';
					$flag = 1;
					$msg = 'You have new AI request by '.$user[0]['fullname'].' ('.$user[0]['address'].')';
					$user_note['users_id'] = $v;
					$user_note['title'] = $title;
					$user_note['message'] = $msg;
					$user_note['date'] = date('Y-m-d h:i:s');
					$user_note['type'] = '2';
					$user_note['isactive'] = '1';
					$user_note['flag'] = '1';
					$this->api_model->user_notification($user_note);
					$this->push_non($v,  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg);
			}
		// }else if($request_type == '2'){
		// 	$vt_data = $this->api_model->get_ai_doc_stoc('pvt_ai', $langitude, $latitude, $bull_id);
		// 	foreach($vt_data as $vr){
		// 			$user_note = '';
		// 			$title = 'AI Request Placed';
		// 			$flag = 1;
		// 			//$msg = "You have new request for AI";
		// 			$user_note['users_id'] = $vr['doctor_id'];
		// 			$user_note['title'] = $title;
		// 			$user_note['message'] = 'You have new AI request by '.$user[0]['fullname'].' ('.$user[0]['address'].')';
		// 			$user_note['date'] = date('Y-m-d h:i:s');
		// 			$user_note['type'] = '2';
		// 			$user_note['isactive'] = '1';
		// 			$user_note['flag'] = '1';
		// 			$this->api_model->user_notification($user_note);
		// 			$this->push_non($vr['doctor_id'],  1, $title , $flag, PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg);
		// 	}
		// }
		$msg['users_id'] = $users_id;
		$msg['title'] = "AI Request Placed";
		$msg['message'] = 'Your AI request has been successfully generated.';
		$msg['date'] = date('Y-m-d h:i:s');
		$msg['type'] = '2';
		$msg['isactive'] = '1';
		$msg['flag'] = '1';
		$this->api_model->user_notification($msg);
		$old_msg['to_users_id'] = $users_id;
		$old_msg['to_id'] = $users_id;
		$old_msg['to_type'] = 'users';
		$old_msg['title'] = "AI Request Placed";
		$old_msg['from_type'] = 'Livestoc Team';
		$old_msg['success'] = '1';
		$old_msg['device'] = 'android';
		$old_msg['active'] = '1';
		$old_msg['description'] = 'Your AI request has been successfully generated.';
		$old_msg['date_added'] = date('Y-m-d h:i:s');
		$this->api_model->old_notification($old_msg);
		$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
		$u_data = $this->api_model->get_user_info_id($users_id);
		$to = TO_ADMIN;
		$subject = 'AI Request';
		$email = ''.$u_data[0]['full_name'].'('.$u_data[0]['mobile'].') has been initiated a AI request from '.$address.'';
		$e = $this->send_mail($to, $subject, $email);
		$json['success']  = True;
		$json['msg'] = "Your AI request has been successfully generated.";
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function make_wallet_yield_request(){
		$users_id =$this->input->get_post('users_id');
		$animal_id =$this->input->get_post('animal_id');
		$request_type = $this->input->get_post('request_type');
		$address = $this->input->get_post('address');
		$latitude = $this->input->get_post('latitude');
		$langitude = $this->input->get_post('langitude');
		$amount = $this->input->get_post('amount');
		$livestoc_balence_consume = $this->input->get_post('wallet_balance_consume');
		$real_balance_consume = $this->input->get_post('real_balance_consume');
		$animal_id = json_decode($animal_id);
		$ani = implode(',',$animal_id);
		$rand = rand(1000,9999);
		$dat = [];
		$status = '2';
		$request_type = '7';			
		$log['type'] = '36';
		$log['users_id'] = $users_id;
		$log['payment_type'] = 'Dr';
		$log['currency'] = 'INR';
		$log['request_id'] = '';
		$log['amount'] = $livestoc_balence_consume;
		$log['request_status'] = '1';
		$log['status'] = '1';
		$log['user_type'] = '1';
		$log['date'] = date('Y-m-d h:i:s');
		$log['method'] = 'Paid From wallet';
		$order_id = $this->api_model->submit('log_file', $log);
		//$order_id = $log_id;
		$data['log_id'] = $order_id;
		$data['animal_id'] = $ani;
		$data['users_id'] =$users_id;
		$data['treat_type'] = $treat_type;
		$data['address'] = $address;
		$data['latitude'] = $latitude;
		$data['langitude'] = $langitude;
		$data['status'] = $status;
		$data['request_type'] = $request_type;
		$data['treat_type'] = '6';
		$data['otp'] = $rand;
		$data['date'] = date('Y-m-d');
		$data['created_on'] = date('Y-m-d h:i:s');
		$da = $this->api_model->submit('vt_requests', $data);	
		if($livestoc_balence_consume != '0' && $livestoc_balence_consume != ''){
		$wall['log_id'] = $order_id;
		$wall['users_id'] = $users_id;
		$wall['type'] = '36';
		$wall['amount'] = $livestoc_balence_consume;
		$wall['status'] = 'Dr';
		$wall['wallet_type'] = '1';
		$wall['date'] = date('Y-m-d h:i:s');
		$w = $this->api_model->submit('livestoc_wallets',$wall);
		}
		if(!empty($animal_id)){
			foreach($animal_id as $bu){
				$dat['request_id'] = $da;
				$dat['animal_id'] = $bu;
				$dat['log_id'] = $order_id;
				$dat['request_type'] = $request_type;
				$dat['user_id'] = $users_id;
				$dat['vacc_id'] = $bull;
				$dat['treat_type'] = '6';
				$dat['treat_status'] ='0';
				$dat['status'] = $status;
				$dat['otp'] = $rand;
				$dat['date'] = date('Y-m-d');
				$this->api_model->submit('vt_request_tracking', $dat);
			}
		}else{
				$dat['request_id'] = $da;
				$dat['animal_id'] = '';
				$dat['log_id'] = $order_id;
				$dat['request_type'] = $request_type;
				$dat['user_id'] = $users_id;
				$dat['vacc_id'] = $bull;
				$dat['treat_type'] = '6';
				$dat['treat_status'] ='0';
				$dat['status'] = $status;
				$dat['otp'] = $rand;
				$dat['date'] = date('Y-m-d');
				$this->api_model->submit('vt_request_tracking', $dat);
		}		
		$u_data = $this->api_model->get_user_info_id($users_id);
		$to = TO_ADMIN;
		$subject = 'Yield Request';
		$email = ''.$u_data[0]['full_name'].'('.$u_data[0]['mobile'].') has been initiated a Yield request from '.$address.'';
		$e = $this->send_mail($to, $subject, $email);
		$json['success']  = True;
		$json['msg'] = "Your request has been submitted successfully. We will contact you shortly.";
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_ai_doc_stoc(){
		$lat = $this->input->get_post('latitude');
		$lang = $this->input->get_post('langitute');
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
		// echo "select DISTINCT st.bull_id as id, bull.semen_type, bull.category, bull.bread,bull.progini_test, bull.dam_no, bull.lat_yield, bull.daughter_yield, bull.total_milk_fat, do.doctor_id, CONCAT('LIVE_', st.bull_id) as bull_no, do.username, (select g.group from semen_group as g where id = bull.groups) as groups, bull.image as bull_image, bull.video as bull_video, (select breed_name from breed where breed_id= bull.bread) as breed_name,  (select category from category where category_id = bull.category) as category_name,(select min(id) from seman_stock where bull_id = st.bull_id AND rest_stock <> 0 AND admin_id = st.admin_id) as stock_id,do.email, bull.bull_id as bull_id, bull.image as bull_image, do.total_experience, do.image, (select if(ROUND(avg(rating),1) IS NOT NULL, ROUND(avg(rating),1), '0')  as rating from doctor_call_rating where doctor_id = do.doctor_id) as rating, st.farmer_price, st.admin_id, st.farmer_offer_price, st.ai_farmer_price, st.company_charges, st.company_offer_charges, (select sum(rest_stock) from seman_stock where bull_id = st.bull_id) As rest_stock, (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from seman_stock as st, current_loc as cl, doctor as do, bull_table as bull where bull.id  = st.bull_id AND st.admin_id = cl.doctor_id AND do.doctor_id = st.admin_id AND do.users_type IN ('pvt_ai', 'pvt_vt') AND st.rest_stock <> 0 AND do.isactivated = '1' AND do.is_premium = '1' AND  (select sum(rest_stock) from seman_stock where bull_id = st.bull_id) > 0 AND (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) <= '".RADIOUS_DIST."' ".$where." ORDER BY ".$order_by." LIMIT ".$start.", ".$perpage."";
		// exit;
		$data = $this->api_model->query_build("select DISTINCT st.bull_id as id, bull.semen_type, bull.category, bull.bread,bull.progini_test, bull.dam_no, bull.lat_yield, bull.daughter_yield, bull.total_milk_fat, do.doctor_id, CONCAT('LIVE_', st.bull_id) as bull_no, do.username, (select g.group from semen_group as g where id = bull.groups) as groups, bull.image as bull_image, bull.video as bull_video, (select breed_name from breed where breed_id= bull.bread) as breed_name,  (select category from category where category_id = bull.category) as category_name,(select min(id) from seman_stock where bull_id = st.bull_id AND rest_stock <> 0 AND admin_id = st.admin_id) as stock_id,do.email, bull.bull_id as bull_id, bull.image as bull_image, do.total_experience, do.image, (select if(ROUND(avg(rating),1) IS NOT NULL, ROUND(avg(rating),1), '0')  as rating from doctor_call_rating where doctor_id = do.doctor_id) as rating, st.farmer_price, st.admin_id, st.farmer_offer_price, st.ai_farmer_price, st.company_charges, st.company_offer_charges, (select sum(rest_stock) from seman_stock where bull_id = st.bull_id) As rest_stock, (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from seman_stock as st, current_loc as cl, doctor as do, bull_table as bull where bull.id  = st.bull_id AND st.admin_id = cl.doctor_id AND do.doctor_id = st.admin_id AND do.users_type IN ('pvt_ai', 'pvt_vt') AND st.rest_stock <> 0 AND do.isactivated = '1' AND do.is_premium = '1' AND  (select sum(rest_stock) from seman_stock where bull_id = st.bull_id) > 0 AND (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) <= '".RADIOUS_DIST."' ".$where." ORDER BY ".$order_by." LIMIT ".$start.", ".$perpage."");
		$count = $this->api_model->query_build("select DISTINCT st.bull_id as id, count(st.bull_id) as count, (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from seman_stock as st, current_loc as cl, doctor as do, bull_table as bull where bull.id  = st.bull_id AND st.admin_id = cl.doctor_id AND do.doctor_id = st.admin_id AND do.users_type IN ('pvt_ai', 'pvt_vt') AND st.rest_stock <> 0 AND do.isactivated = '1' AND do.is_premium = '1' AND  (select sum(rest_stock) from seman_stock where bull_id = st.bull_id) > 0 AND (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) <= '".RADIOUS_DIST."' ".$where." ORDER BY ".$order_by." LIMIT ".$start.", ".$perpage."");
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
	public function update_doc_avaialable_for_visit(){
		$doc_id = $this->input->get_post('doc_id');
		$data['online_for_visit'] = $this->input->get_post('online_for_visit');
		$detail = $this->api_model->avaialable_for_visit($doc_id, $data);
		if($detail){
			$json_data['success'] = TRUE;
			$json_data['msg'] = 'Your status has been successfully updated';
		}else{
			$json_data['success'] = FALSE;
			$json_data['error'] = "There is problem with data base";
		}
		header('Content-Type:application/json');
		echo json_encode($json_data);
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
	public function lead_doctor(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['doc_id'] = $this->input->get_post('doc_id');
		$data['perposs'] = $this->input->get_post('perposs');
		$data['type'] = $this->input->get_post('type');
		$data['status'] = '0';
		$data['created_on'] = date('Y-m-d h:i:s');
		$user = $this->api_model->get_doc_profile($data['doc_id']);
		$user_lead = $this->api_model->get_user_info_id($data['users_id']);
		if(!$this->api_model->get_data('users_id = "'.$data['users_id'].'" AND status = "0" AND doc_id = "'.$data['doc_id'].'"' , 'lead_doc', '', '*')){
			if($this->api_model->submit('lead_doc', $data)){
					$msg['users_id'] = $data['doc_id'];
					$msg['title'] = "Lead";
					$msg['message'] = ''.$user_lead[0]['full_name'].' wants to contact you';
					$msg['date'] = date('Y-m-d h:i:s');
					$msg['type'] = '2';
					$msg['isactive'] = '1';
					$msg['flag'] = '1';
					$this->api_model->user_notification($msg);
					// $old_msg['to_users_id'] = $data['lead_user_id'];
					// $old_msg['to_id'] = $data['lead_user_id'];
					// $old_msg['to_type'] = 'users';
					// $old_msg['title'] = "Lead";
					// $old_msg['from_type'] = 'Livestoc Team';
					// $old_msg['success'] = '1';
					// $old_msg['device'] = 'android';
					// $old_msg['active'] = '1'; 
					// $old_msg['description'] = ''.$user_lead[0]['full_name'].' wants to contact you';
					// $old_msg['date_added'] = date('Y-m-d h:i:s');
					// $this->api_model->old_notification($old_msg);
					$this->push_non($msg['users_id'], 1 , $msg['title'], $msg['flag'],  PARAVATE_SERVERKEY, IOS_PARAVATE_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
				//$this->push_non($msg['users_id'], 1 , $msg['title'],  $msg['flag'], $msg['message'], $msg['title']);
				$json['success']  = true; 
				$json['msg'] = 'Thanks, '.$user[0]['username'].' will contact you soon.';
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}else{
			$json['success']  = false; 
			$json['error'] = 'Your request to connect, has been already sent.';
		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_lead_doctor(){
		$user_id = $this->input->get_post('doc_id');
		$status = $this->input->get_post('status');
		if($data = $this->api_model->get_lead_doc($user_id, $status)){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = 'Currently, You do not have any leads in your account';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function get_district_manager(){
		$doctor_id = $this->input->get_post('doctor_id');
		if($data = $this->api_model->get_district_manager($doctor_id)){
			$json['success']  = true; 
			$json['data'] = $data;
		}else{
			$json['success']  = false; 
			$json['error'] = 'Data base Error.';
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
		if($data['type'] == 1){
						$msg['message'] = ''.$user_lead[0]['full_name'].' आपके द्वारा पोस्ट किये गए  बुल में रूचि रखता  है। लीड को अनलॉक करने के लिए कृपया Livestoc पर लॉगिन करें <br> '.$user_lead[0]['full_name'].' is interested in your posted Bull. Please login at Livestoc to unlock the lead';
					}elseif($data['type'] == 2){
						$msg['message'] = ''.$user_lead[0]['full_name'].' आपके द्वारा पोस्ट किये गए  कुत्ते  में रूचि रखता  है। लीड को अनलॉक करने के लिए कृपया Livestoc पर लॉगिन करें| <br> '.$user_lead[0]['full_name'].'is interested in your posted Dog for mating. Please login at Livestoc to unlock the lead';
					}else{
					$msg['message'] = ''.$user_lead[0]['full_name'].' पशु खरीदने के लिए आपको संपर्क करना चाहते हैं. उनका नंबर पाने के लिए तुरंत लाइवस्टॉक एप्प  पर लॉगिन करें।  धन्यवाद् | <br> '.$user_lead[0]['full_name'].' is interested in buying Animal from you. Please login at Livestoc to unlock the lead. Thanks';
					}
		$date = date('Y-m-d');
		if(!$this->api_model->get_data('users_id = "'.$data['users_id'].'" AND lead_user_id = "'.$data['lead_user_id'].'" AND created_on LIKE "%'.$date.'%"' , 'lead_breader_dealer', '', '*')){
			$lead_count = $this->api_model->get_data('users_id = "'.$data['lead_user_id'].'" and rest_qty <> 0','dealer_breader_lead_log', '', 'if(sum(rest_qty) IS NOT NULL, sum(rest_qty), 0) as count');
			if($lead_count[0]['count'] != '0'){
				$data['status'] = '1';
				$consume = $this->api_model->get_data('users_id = "'.$data['lead_user_id'].'" and rest_qty <> 0', 'dealer_breader_lead_log','','id, rest_qty');
				foreach($consume as $con){
					$update['rest_qty'] = $con['rest_qty'] - 1; 
					$this->api_model->get_data_update('id = '.$con['id'].'', 'dealer_breader_lead_log', $update);
					break;
				}
				$json['show_detail']  = 1; 
			}else{
				$json['show_detail']  = 0; 
			}
			if($this->api_model->submit('lead_breader_dealer', $data)){
					$msg['users_id'] = $data['lead_user_id'];
					$msg['title'] = "Lead";
					// if($data['type'] == 1){
					// 	$msg['message'] = ''.$user_lead[0]['full_name'].' ('.$user_lead[0]['category'].') sdfdfsdfddsfdf <br> '.$user_lead[0]['full_name'].' is interested in buying ('.$user_lead[0]['category'].') from you. Name of User" is interested in you posted Bull. Please login at Livestoc to unlock the lead';
					// }elseif($data['type'] == 2){
					// 	$msg['message'] = ''.$user_lead[0]['full_name'].' ('.$user_lead[0]['category'].') खरीदने के लिए आपको संपर्क करना चाहते हैं. उनका नंबर पाने के लिए तुरंत लाइवस्टॉक एप्प  पर लॉगिन करें।  धन्यवाद् | <br> '.$user_lead[0]['full_name'].' is interested in buying ('.$user_lead[0]['category'].') Name of User" is interested in you posted Dog for mating. Please login at Livestoc to unlock the lead';
					// }else{
					// $msg['message'] = ''.$user_lead[0]['full_name'].' ('.$user_lead[0]['category'].') खरीदने के लिए आपको संपर्क करना चाहते हैं. उनका नंबर पाने के लिए तुरंत लाइवस्टॉक एप्प  पर लॉगिन करें।  धन्यवाद् | <br> '.$user_lead[0]['full_name'].' is interested in buying ('.$user_lead[0]['category'].') from you. Please login at Livestoc to unlock the lead. Thanks';
					// }
					$msg['date'] = date('Y-m-d h:i:s');
					$msg['type'] = '1';
					$msg['isactive'] = '1';
					$msg['flag'] = '3';
					$this->api_model->user_notification($user_note);
					$old_msg['to_users_id'] = $data['lead_user_id'];
					$old_msg['to_id'] = $data['lead_user_id'];
					$old_msg['to_type'] = 'users';
					$old_msg['title'] = "Lead";
					$old_msg['from_type'] = 'Livestoc Team';
					$old_msg['success'] = '1';
					$old_msg['device'] = 'android';
					$old_msg['active'] = '1'; 
					$old_msg['description'] = ''.$user_lead[0]['full_name'].'  ('.$user_lead[0]['category'].')  खरीदने के लिए आपको संपर्क करना चाहते हैं. उनका नंबर पाने के लिए तुरंत लाइवस्टॉक एप्प  पर लॉगिन करें।  धन्यवाद् | '.$user_lead[0]['full_name'].' is interested in buying ('.$user_lead[0]['category'].') from you. Please login at Livestoc to unlock the lead. Thanks';
					$old_msg['date_added'] = date('Y-m-d h:i:s');
					$this->api_model->old_notification($old_msg);
					$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
				//$this->push_non($msg['users_id'], 1 , $msg['title'],  $msg['flag'], $msg['message'], $msg['title']);
				$json['success']  = true; 
				$json['msg'] = 'Thanks, '.$user[0]['full_name'].' will contact you soon.';
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}else{
			if($this->api_model->get_data('users_id = "'.$data['users_id'].'" AND status = "1" AND lead_user_id = "'.$data['lead_user_id'].'" AND created_on LIKE "%'.$date.'%"' , 'lead_breader_dealer', '', '*')){
				$json['success']  = true; 
				$json['show_detail']  = 1; 
				$json['msg'] = 'Thanks, '.$user[0]['full_name'].' will contact you soon.';
			}else{
				$json['success']  = false; 
				$json['error'] = 'Your request to connect, has been already sent.';
			}
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
			$json['success']  = false; 
			$json['error'] = 'Currently, You do not have any leads in your account';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function get_distributer_distance(){
		$dist_id = $this->input->get_post('dist_id');
		$latitude = $this->input->get_post('latitude');
		$longitude = $this->input->get_post('longitude');
		$straw = $this->input->get_post('straw');
		if($data = $this->api_model->get_address_lat_data($dist_id)){
			$distance = $this->distance($latitude, $longitude,$data[0]['latitude'], $data[0]['longitude'], 'K');
			if($distance <= 200){
				if($straw >= 25 ){
					$json['success']  = true; 
					$json['data'] = $data;
				}else{
					$json['success']  = false; 
					$json['error'] = 'Please order minimum 25 semen straws';
				}
			}else{
				$json['success']  = false; 
				$json['error'] = 'Currently we are not dealing in your area';
			}
		}else{
			$json['success']  = false; 
			$json['error'] = 'sorrry';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	
	public function dealer_breader_calculation(){
		$type = $this->input->get_post('type');
		$admin_id = $this->input->get_post('admin_id');
		$users_id =$this->input->get_post('users_id');
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
		//$d = $this->api_model->get_semen_price($type, $bull_id);

			if($type == '15'){
				if($users_type == '3'){
					$total_rate =  RETAILER_DEALER_PRICE + (((RETAILER_DEALER_PRICE) * SERVICE_TAX)/100);
				}else{
					$total_rate =  DEALER_PRICE + (((DEALER_PRICE) * SERVICE_TAX)/100);
				}
			}
			if($type == '16'){
				if($users_type == '3'){
					$total_rate =  RETAILER_BREADER_PRICE + (((RETAILER_BREADER_PRICE) * SERVICE_TAX)/100);
				}else{
					$total_rate =  DEALER_PRICE + (((DEALER_PRICE) * SERVICE_TAX)/100);
				}
			}
			if($type == '17'){
				if($users_type == '3'){
					$total_rate =  RETAILER_DOG_MEATING_PRICE + (((RETAILER_DOG_MEATING_PRICE) * SERVICE_TAX)/100);
				}else{
					$total_rate =  DEALER_PRICE + (((DEALER_PRICE) * SERVICE_TAX)/100);
				}
			}
			if($type == '18'){
				if($users_type == '3'){
					$total_rate =  RETAILER_BULL_MEATING_PRICE + (((RETAILER_BULL_MEATING_PRICE) * SERVICE_TAX)/100);
				}else{
					$total_rate =  DEALER_PRICE + (((DEALER_PRICE) * SERVICE_TAX)/100);
				}
			}
			if($type == '36'){
				if($users_type == '3'){
					$total_rate =  (YIELD_OFFER_CHARGES + (((YIELD_OFFER_CHARGES) * SERVICE_TAX)/100)) * $qty;
				}
			}
			// $data[1]['service_key'] = "Bull ID"." #".$d[0]['id'];
			// $data[1]['price'] = $d[0]['price'];
			// $data[2]['service_key'] = "Ai charges";
			// $data[2]['price'] = $d[0]['price'];
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
				//$a['livestoc_balence'] = $real_balance;
				if($type == '15'){
					$a['product_consume_rate'] = LIVESTOC_CASH_DEALER;
				}
				if($type == '16'){
					$a['product_consume_rate'] = LIVESTOC_CASH_BREADER;
				}
				if($type == '17'){
					$a['product_consume_rate'] = LIVESTOC_CASH_DOG_MEATING;
				}
				if($type == '18'){
					$a['product_consume_rate'] = LIVESTOC_CASH_BULL_MEATING;
				}
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
					// if($a['livestoc_balence'] > 0){
					// 	if($a['livestoc_balence'] == $a['product_consume_rate']){
					// 		$a['livestoc_balence_consume'] = $a['product_consume_rate'];
					// 		$a['livestoc_balence_status'] = 0; 
					// 		$product_rate = $total_rate - $a['product_consume_rate'];
					// 	}else if($a['livestoc_balence'] < $a['product_consume_rate']){
					// 		if($a['livestoc_balence'] > $a['product_consume_rate']){
					// 			$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
					// 			$a['livestoc_balence_consume'] = $a['product_consume_rate'];
					// 			$product_rate = $total_rate - $a['product_consume_rate'];
					// 		}else{
					// 			$a['livestoc_balence_status'] = $a['livestoc_balence']; 
					// 			$a['livestoc_balence_consume'] =$a['livestoc_balence'];
					// 			$product_rate = $total_rate - $a['livestoc_balence'];
					// 		}	
					// 	}else if($a['livestoc_balence'] > $a['product_consume_rate']){
					// 		$a['livestoc_balence_consume'] =$a['livestoc_balence']- $total_rate;
					// 		$a['livestoc_balence_status'] = $a['livestoc_balence']- $total_rate; 
					// 		$product_rate =0;
					// 	}else{
					// 		$a['livestoc_balence_status'] = 0;
					// 		$a['livestoc_balence_consume'] = 0;
					// 	}
					// }else{
					// 	$a['livestoc_balence_status'] = 0;
					// 	$a['livestoc_balence_consume'] = 0;
					// 	$product_rate = $total_rate;
					// } 
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
					if($type == '15'){
						if($users_type == '3'){
							$loq =  RETAILER_DEALER_PRICE;
							$tax =  (((RETAILER_DEALER_PRICE) * SERVICE_TAX)/100);
							$purchase_amount = RETAILER_DEALER_PRICE + (((RETAILER_DEALER_PRICE) * SERVICE_TAX)/100);
						}else{
							$loq =  DEALER_PRICE;
							$tax =  (((DEALER_PRICE) * SERVICE_TAX)/100);
							$purchase_amount = DEALER_PRICE + (((DEALER_PRICE) * SERVICE_TAX)/100);
						}
					}
					if($type == '16'){
						if($users_type == '3'){
							$loq =  RETAILER_BREADER_PRICE;
							$tax =  (((RETAILER_BREADER_PRICE) * SERVICE_TAX)/100);
							$purchase_amount = RETAILER_BREADER_PRICE + (((RETAILER_BREADER_PRICE) * SERVICE_TAX)/100);
						}else{
							$loq =  BREADER_PRICE;
							$tax =  (((BREADER_PRICE) * SERVICE_TAX)/100);
							$purchase_amount = BREADER_PRICE + (((BREADER_PRICE) * SERVICE_TAX)/100);
						}
					}
					if($type == '17'){
						if($users_type == '3'){
							$loq =  RETAILER_DOG_MEATING_PRICE;
							$tax =  (((RETAILER_DOG_MEATING_PRICE) * SERVICE_TAX)/100);
							$purchase_amount = RETAILER_DOG_MEATING_PRICE + (((RETAILER_DOG_MEATING_PRICE) * SERVICE_TAX)/100);
						}else{
							$loq =  DOG_MEATING_PRICE;
							$tax =  (((DOG_MEATING_PRICE) * SERVICE_TAX)/100);
							$purchase_amount = DOG_MEATING_PRICE + (((DOG_MEATING_PRICE) * SERVICE_TAX)/100);
						}
					}
					if($type == '18'){
						if($users_type == '3'){
							$loq =  RETAILER_BULL_MEATING_PRICE;
							$tax =  (((RETAILER_BULL_MEATING_PRICE) * SERVICE_TAX)/100);
							$purchase_amount = RETAILER_BULL_MEATING_PRICE + (((RETAILER_BULL_MEATING_PRICE) * SERVICE_TAX)/100);
						}else{
							$loq =  BULL_MEATING_PRICE;
							$tax =  (((BULL_MEATING_PRICE) * SERVICE_TAX)/100);
							$purchase_amount = BULL_MEATING_PRICE + (((BULL_MEATING_PRICE) * SERVICE_TAX)/100);
						}
					}
					if($type == '36'){
						if($users_type == '3'){
							if($users_type == '3'){
								$loq =  $qty * YIELD_OFFER_CHARGES;
								$tax =  $qty * (((YIELD_OFFER_CHARGES) * SERVICE_TAX)/100);
								$purchase_amount = $qty * (YIELD_OFFER_CHARGES + (((YIELD_OFFER_CHARGES) * SERVICE_TAX)/100));
							}
						}
					}
			$data = [];
			$data[1]['service_key'] = "Amount";
			$data[1]['price'] = $loq;
			$data[2]['service_key'] = "GST (".SERVICE_TAX."%)";
			$data[2]['price'] = $tax;
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
			if($type == '15'){
				$json['dummy_amount'] = DEALER_DOMMY_PRICE;
			}
			if($type == '16'){
				$json['dummy_amount'] = BREADER_DOMMY_PRICE;
			}
			if($type == '17'){
				$json['dummy_amount'] = DOG_MEATING_DUMMY_PRICE;
			}
			if($type == '18'){
				$json['dummy_amount'] = BULL_MEATING_DUMMY_PRICE;
			}
			if($type == '36'){
				$json['dummy_amount'] = YIELD_CHARGES;
			}
			$json['livestoc_balence_status'] = $a['livestoc_balence_status'];
			$json['livestoc_balence_consume'] = $a['livestoc_balence_consume'];
			$json['real_balance_status'] = $a['real_balance_status'];
			$json['real_balance_consume'] = $a['real_balance_consume'];
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function new_ai_calculation(){
		$type = $this->input->get_post('type');
		$users_id =$this->input->get_post('users_id');
		$order_type =$this->input->get_post('order_type');
		$admin_id = $this->input->get_post('admin_id');
		$request_status = $this->input->get_post('request_status');
		$currency = $this->input->get_post('currency');
		$bull_id = $this->input->get_post('bull_id');
		$doctor_id = $this->input->get_post('doctor_id');
		$d = $this->api_model->ai_bull_detail_id($bull_id);
		// print_r($d);
		// exit;
		if($order_type == '1'){
			$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
			$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
			$end_data = date('Y-m-d');
			if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
				//$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
				// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*');
				// print_r($pack_data);
				// exit;
				//if($pack_data[0]['sum'] >  0){	
				$per = $semen_data[0]['farmer_offer_price'];
				$json['premium_bill'] = '1';
			}else{
				$per = $semen_data[0]['farmer_price'];
				$json['premium_bill'] = '0';
			}
		}else if($order_type == '3'){
			$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
			$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
			$end_data = date('Y-m-d');
			if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
				//$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
				// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*');
				// print_r($pack_data);
				// exit;
				//if($pack_data[0]['sum'] >  0){	
				$per = $semen_data[0]['farmer_offer_price'];
				$json['premium_bill'] = '1';
			}else{
				$per = $semen_data[0]['farmer_price'];
				$json['premium_bill'] = '0';
			}
		}else{
			//$semen_data = $this->api_model->query_build('SELECT farmer_price, farmer_offer_price, ai_farmer_price FROM seman_stock where admin_id = "'.$doctor_id.'" AND bull_id = "'.$bull_id.'" AND rest_stock <> 0 AND is_update = "1" ORDER BY id DESC');
			$semen_data = $this->api_model->query_build('SELECT farmer_price, farmer_offer_price, ai_farmer_price FROM seman_stock where admin_id = "'.$doctor_id.'" AND bull_id = "'.$bull_id.'" AND rest_stock <> 0 ORDER BY id DESC');
			$per = $semen_data[0]['ai_farmer_price'];
			$json['premium_bill'] = '0';
		}
		$data[1]['service_key'] = $d[0]['bull_id'];
		$data[1]['price'] = $per;
		$data[2]['service_key'] = "Ai charges";
		$data[2]['price'] = $per;
		$data[6]['service_key'] = "Total Price";
		$data[6]['price'] = $per;
		if($order_type == '3'){
			$amount_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amount_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "1" AND user_type = "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
			$amoun_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "0" AND user_type = "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amoun_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="dr" AND wallet_type = "0" AND user_type = "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
			$log['users_id'] = $admin_id;
		}else{
			$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
			$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
			$log['users_id'] = $users_id;
		}
		// $livestoc_balance = 0;
		// $livestoc_balance = 0;
		//$real_balance = $per;
		$a['real_balance'] = $livestoc_balance;
		$a['livestoc_balence'] = $livestoc_balance;
		$a['product_consume_rate'] = $d[0]['livestoc_cash_use'];
		$a['min_balance'] = $total_rate;
		
		$log['currency'] = $currency;
		$log['type'] = '26';
		$log['amount'] = $per;
		$log['user_type'] = '1';
		$log['premium_bull_type'] = '';
		$log['request_status'] = isset($request_status) ? $request_status : 0;
		$log['date'] = date('Y-m-d h:i:s');
		$log_id = $this->api_model->insert_log_data($log);	
		//print_r($log);
		$a['log_id'] = $log_id[0]['purchase_id'];
		$logid = $log_id[0]['purchase_id'];
					// if($a['livestoc_balence'] > 0){
					// 	if($a['livestoc_balence'] == $a['product_consume_rate']){
					// 		$a['livestoc_balence_consume'] = $a['product_consume_rate'];
					// 		$a['livestoc_balence_status'] = 0; 
					// 		$product_rate = $total_rate - $a['product_consume_rate'];
					// 	}else if($a['livestoc_balence'] < $a['product_consume_rate']){
					// 		$a['livestoc_balence_consume'] = $a['product_consume_rate']-$a['livestoc_balence'];
					// 		$a['livestoc_balence_status'] = 0; 
					// 		$product_rate = $total_rate - $a['livestoc_balence_consume'];
					// 	}else if($a['livestoc_balence'] > $a['product_consume_rate']){
					// 		$a['livestoc_balence_status'] = $a['livestoc_balence'] - $a['product_consume_rate']; 
					// 		$a['livestoc_balence_consume'] = $a['product_consume_rate'];
					// 		$product_rate = $total_rate - $a['product_consume_rate'];
					// 	}else{
					// 		$a['livestoc_balence_status'] = 0;
					// 		$a['livestoc_balence_consume'] = 0;
					// 	}
					// }else{
						// if($pack_data[0]['sum'] >  0){
							$a['livestoc_balence_status'] = 0;
							$a['livestoc_balence_consume'] = 0;
							$product_rate = $per;
						// }else{

						// }
					// }
					//if($product_rate  != 0 && $json['premium_bill'] == '1'){ 
					if($product_rate  != 0){
						if($a['real_balance'] > 0){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$product_rate = 0;
							}else if($a['real_balance'] < $product_rate){
								$a['real_balance_status'] = 0; 
								$a['real_balance_consume'] = $a['real_balance'];
								$product_rate =  $product_rate - $a['real_balance'];
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
				$data = [];
				$data[1]['service_key'] = "AI Price (".$d[0]['bull_id'].")";
				$data[1]['price'] = $per;
			if($a['livestoc_balence_consume'] != 0){
				$data[4]['service_key'] = 'Livestoc Balance';
				$data[4]['price'] = $a['livestoc_balence_consume'];
			}
			if($a['real_balance_consume'] != 0){
				$data[5]['service_key'] = 'Wallet Balance';
				$data[5]['price'] = $a['real_balance_consume'];
			}
			if($product_rate == 0 ){
				$pr = $log['amount'];
			}else{
				$pr = $product_rate;
			}
			if($json['premium_bill'] == '1'){
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
				}
				$json['order_id'] = "LVAT_".$logid;
				$json['purchase_id'] = $logid;
			$detail_1['services_charges'] = array_values($data);
			$json['success']  = true; 
			$json['data'] = $detail_1;
			$json['actual_payment'] = ($per - $a['real_balance_consume']) - $a['livestoc_balence_consume'];
			$json['total_price'] = $per;
			$json['livestoc_balence_status'] = $a['livestoc_balence_status'];
			$json['livestoc_balence_consume'] = $a['livestoc_balence_consume'];
			$json['real_balance_status'] = $a['real_balance_status'];
			$json['real_balance_consume'] = $a['real_balance_consume'];
			$dummy['data'] = $json;
			//$this->load->view('test_payment', $dummy);
		// echo "<pre>";
		// print_r($json);
		// print_r($log);
		// print_r($log_id);
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function ai_calculation(){
		$type = $this->input->get_post('type');
		$users_id =$this->input->get_post('users_id');
		$bull_id = $this->input->get_post('bull_id');
		$request_status = $this->input->get_post('request_status');
		$currency = $this->input->get_post('currency');
		if(isset($type)){
			if($type == '1' ){
				$type = 'price';
			}if($type == '2'){
				$type = 'ai_price';
			}if($type == '3'){
				$type = 'distributor_price';
			}
		}else{
			$type = 'price';
		}
		$data = [];
		$detail =[];
		$detail_1 =[];
		$i = 0;
		$y = 0;
		$num_strow = 0;
		$ai_charge = 0;
		$d = $this->api_model->get_semen_price($type, $bull_id);
			$data[1]['service_key'] = "Bull ID"." #".$d[0]['id'];
			$data[1]['price'] = $d[0]['price'];
			$data[2]['service_key'] = "Ai charges";
			$data[2]['price'] = $d[0]['price'];
			$data[3]['service_key'] = "Service Tax";
			$data[3]['price'] = (($d[0]['price'] + $d[0]['vt_ai_price']) * SERVICE_TAX)/100;
			$data[6]['service_key'] = "Total Price";
			$data[6]['price'] = $d[0]['price'] + $d[0]['vt_ai_price'] + ((($d[0]['price'] + $d[0]['vt_ai_price']) * SERVICE_TAX)/100);
			$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
			$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
				$a['real_balance'] = $livestoc_balance;
				$a['livestoc_balence'] = $real_balance;
				$a['product_consume_rate'] = $d[0]['livestoc_cash_use'];
				$a['min_balance'] = $total_rate;
				$total_rate = $d[0]['price'] + $d[0]['vt_ai_price'];
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
							$product_rate = $total_rate - $a['product_consume_rate'];
						}else{
							$a['livestoc_balence_status'] = 0;
							$a['livestoc_balence_consume'] = 0;
						}
					}else{
						$a['livestoc_balence_status'] = 0;
						$a['livestoc_balence_consume'] = 0;
						$product_rate = $d[0]['price'] + $d[0]['vt_ai_price'];
					} 
					if($product_rate  != 0){
						if($a['real_balance'] > 0){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$product_rate = 0;
							}else if($a['real_balance'] <= $product_rate){
								$a['real_balance_status'] = $product_rate - $a['real_balance']; 
								$a['real_balance_consume'] = $product_rate - $a['real_balance_status'];
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
						$a['real_balance_status'] = $livestoc_balance;
						$a['real_balance_consume'] = 0;
					}  
				$data = [];
				$data[1]['service_key'] = "Straw Price (Bull ID"." #".$d[0]['id'].")";
				$data[1]['price'] = $d[0]['price'] + $d[0]['vt_ai_price'];
			if($a['livestoc_balence_consume'] != 0){
				$data[4]['service_key'] = 'Livestoc Balance';
				$data[4]['price'] = $a['livestoc_balence_consume'];
			}
			if($a['real_balance_consume'] != 0){
				$data[5]['service_key'] = 'Wallet Balance';
				$data[5]['price'] = $a['real_balance_consume'];
			}
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
			$json['actual_payment'] = $product_rate;
			$json['total_price'] = $d[0]['price'] + $d[0]['vt_ai_price'];
			$json['livestoc_balence_status'] = $a['livestoc_balence_status'];
			$json['livestoc_balence_consume'] = $a['livestoc_balence_consume'];
			$json['real_balance_status'] = $a['real_balance_status'];
			$json['real_balance_consume'] = $a['real_balance_consume'];
			$dummy['data'] = $json;
			$this->load->view('test_payment', $dummy);
		// header('Content-Type: application/json');
		// echo json_encode($json);
		// exit;
	}
	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);

		  if ($unit == "K") {
		      return ($miles * 1.609344);
		  } else if ($unit == "N") {
		      return ($miles * 0.8684);
		  } else {
		      return $miles;
		  }
	}
	public function get_coustomer_stock(){
		$users_id = $this->input->get_post('users_id');
		if($data = $this->api_model->get_data('admin_id ="'.$users_id.'"' , 'seman_stock', 'id DESC', '*')){
			$detail='';
			foreach($data as $d){
				$bull_data = $this->api_model->ai_bull_detail_id($d['bull_id']);
				//print_r($bull_data);
					$semen_group = $this->api_model->get_data('id ="'.$bull_data[0]['groups'].'"', 'semen_group','','*');
					$d['groups'] = $semen_group[0]['group'];
					$d['tag_no'] = $bull_data[0]['bull_no'];
					$d['progini_test'] = $bull_data[0]['progini_test'];
					$admin_detail = $this->api_model->get_admin_detail($d['bank_id']);
					$d['semen_bank_name'] = $admin_detail[0]['fname'];
					$cat_name = $this->api_model->get_category($bull_data[0]['category']);
					$d['bull_cat_name'] = $cat_name[0]['category'];
					$bread_name = $this->api_model->get_animal_breed($bull_data[0]['bread']);
					$d['bull_bread_name'] = $bread_name[0]['breed_name'];
					$d['bull_image'] = base_url().'uploads/bank/'.$bull_data[0]['image'];
					$d['sale_price'] = $d['advance_booking_price'];
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
	public function make_otp_match(){
		$order_id = $this->input->get_post('order_id');
		$stock_id = $this->input->get_post('stock_id');
		$type = $this->input->get_post('type');
		$otp = $this->input->get_post('otp');
		if($type == '1'){
			$type = '1';
		}else{
			$type = '0';
		}
		// echo "<pre>";
		if($dat = $this->api_model->get_data('otp = "'.$otp.'" AND id = "'.$order_id.'"' , 'pre_order_ai_table', '', '*')){
				$detail = $this->api_model->get_semen_stock_id($stock_id);
				// print_r($dat);
				// print_r($detail);
				// exit;
				$error = 0;
				if($dat[0]['no_strow'] > $detail[0]['rest_stock']){
						$error = '#'.$stock_id;
				}
				if($error === 0){
					//$i = 0;
					//foreach($stock_id as $as){
						$detail = $this->api_model->get_semen_stock_id($stock_id);
						//print_r($detail);
						$data['farmer_price'] = $detail[0]['farmer_price'];
						$data['farmer_offer_price'] = $detail[0]['farmer_offer_price'];
						$data['ai_price'] = $detail[0]['ai_price'];
						$data['order_id'] = $order_id;
						$data['ai_offer_price'] = $detail[0]['ai_offer_price'];
						$data['advance_booking_price'] = $detail[0]['advance_booking_price'];
						$data['advance_booking_offer_price'] = $detail[0]['advance_booking_offer_price'];
						$data['ai_service_price'] = $detail[0]['ai_service_price'];
						$data['ai_service_offer_price'] = $detail[0]['ai_service_offer_price'];
						$data['company_charges'] = $detail[0]['company_charges'];
						$data['company_offer_charges'] = $detail[0]['company_offer_charges'];
						$data['bull_id'] = $detail[0]['bull_id'];
						$data['stock_id'] = $detail[0]['id'];
						$data['batch_no'] = $detail[0]['batch_no'];
						$data['rest_stock'] = $dat[0]['no_strow'];
						$data['opening_stock'] = $dat[0]['no_strow'];
						$data['date'] = date('Y-m-d h:i:s');
						$data['bank_id'] = $detail[0]['bank_id'];
						$data['type'] = $detail[0]['type'];
						$data['image'] = $detail[0]['image'];
						$data['admin_id'] = $dat[0]['users_id'];
						$data['user_type'] = $type;
						// print_r($data);
						// exit;
						$deta = $this->api_model->add_semen_stock($data);
						$stock['rest_stock'] = $detail[0]['rest_stock'] - $dat[0]['no_strow'];
						$this->api_model->update_semen_stock($detail[0]['id'], $stock);
						$du['deliverd'] = '1';
						$this->api_model->update('id', $order_id, 'pre_order_ai_table', $du);
						$msg['users_id'] = $dat[0]['users_id'];
						$msg['title'] = "Semen Order";
						$msg['message'] = 'Your semen order has been successfully delivered to you';
						$msg['date'] = date('Y-m-d h:i:s');
						$msg['type'] = '2';
						$msg['isactive'] = '1';
						$msg['flag'] = '1';
						$this->api_model->user_notification($user_note);
						$old_msg['to_users_id'] = $dat[0]['users_id'];
						$old_msg['to_id'] = $dat[0]['users_id'];
						$old_msg['to_type'] = 'users';
						$old_msg['title'] = "Semen Order";
						$old_msg['from_type'] = 'Livestoc Team';
						$old_msg['success'] = '1';
						$old_msg['device'] = 'android';
						$old_msg['active'] = '1'; 
						$old_msg['description'] = 'Your semen order has been successfully delivered to you';
						$old_msg['date_added'] = date('Y-m-d h:i:s');
						$this->api_model->old_notification($old_msg);
						$this->push_non($msg['users_id'], 4 , $msg['title'], $msg['flag'], LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
					$json['success']  = True; 
					$json['msg'] = "Your Semen stock has been transferred to the coustomer.";
				}else{
					$json['success']  = false; 
					$json['error'] = "Quantity is more then available stock (".$error.") or Out of stock";
				}
		}else{
			$json['success']  = false; 
			$json['error'] = "Please enter valid otp";
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
	public function lab_reg_wallet(){
		$purchase_id = $this->input->get_post('purchase_id');
		$update['payment_type'] = 'Dr';
		$update['date'] = date('Y-m-d H:i:s');
		$this->api_model->get_data_update('id = "'.$purchase_id.'"', 'log_file', $update);
		$reg_no = $this->input->get_post('reg_no'); 
		$reg['ispaid'] = '1';
		$this->api_model->get_data_update('id = "'.$reg_no.'"', 'lab_reg', $reg);
		$users_id = $this->input->get_post('bank_id');
		$amount = $this->input->get_post('wallet_balance_consume');
		if($amount > 0){
			$wallet_data['log_id'] = $purchase_id;
			$wallet_data['type'] = '23';
			$wallet_data['users_id'] = $users_id;
			$wallet_data['amount'] = $amount;
			$wallet_data['status'] = 'Dr';
			$wallet_data['wallet_type'] = '1';
			$wallet_data['date'] = date('Y-m-d H:i:s');
			$this->api_model->submit('livestoc_wallets', $wallet_data);
		}
		$u_data = $this->api_model->get_user_info_id($users_id);
		$to = TO_ADMIN;
		$subject = 'Sample Collection Center Application';
		$email = ''.$u_data[0]['full_name'].'('.$u_data[0]['mobile'].') registered for  Sample Collection Center Application Form from '.$address.'';
		$e = $this->send_mail($to, $subject, $email);
		$json['success']  = True;
		$json['msg'] = "Thanks, You have successfully submitted for Sample Collection Centre in your Area.";
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
			$json['distance'] = LAB_DISTANCE;
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
				$app_type = $this->input->get_post('app_type');
				$admin_id = $this->input->get_post('admin_id');
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
				$log_id = $this->input->get_post('purchase_id');
				$livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
				$real_balance_consume = $this->input->get_post('real_balance_consume');
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
					$data1['type'] = $user_type;
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
					}else{
						$data1['users_id'] = $users_id;
					}
					$data1['type'] = $user_type;
					$data1['animal_id'] = '';
					$data1['amount'] = $real_balance_consume;
					$data1['status'] = 'Dr';
					$data1['wallet_type'] = '1';
					$data1['date'] = date('Y-m-d h:i:s');
					$this->api_model->submit('livestoc_wallets',$data1);
					$is_premium = '1';
				}	
				// if($livestoc_balence_consume!='0' || $real_balance_consume!='0'){
				// 	$this->consume_wallet($users_id, '', $livestoc_balence_consume, $real_balance_consume, $log_id, $user_type);
				// }
				if($app_type == '3'){
					$data['app_type'] = $app_type;
					$data['admin_change_status_id'] = $admin_id;
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
				$data['is_premium'] = $is_premium;
                if($this->api_model->update('users_id', $users_id, 'users', $data)){
					$u_data = $this->api_model->get_user_info_id($users_id); 
					$to = TO_ADMIN;
					$subject = 'Top Champion Dog Listing'; 
					$email = ''.$contact_person.'('.$contact_phone.') has registered as breeder/dealer from '.$address.'';
						$json['success'] = true;
                	if($u_type == "4")
						if($app_type == '3'){
							$msg = 'Thanks, Successfully upgraded to breeder';
						}else{
							$msg = 'Thanks, You are successfully upgraded to breeder';
						}
                	else{
						if($app_type == '3'){
							$msg = 'Thanks, Successfully upgraded to dealer';
						}else{
							$msg = 'Thanks, You are successfully upgraded to dealer';
						}
					}
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
		$lab_id = $this->input->get_post('lab_id');
		$app_type = $this->input->get_post('app_type');
		$admin_id = $this->input->get_post('admin_id');
		$premium_type = $this->input->get_post('premium_type');
		$no_of_sample = $this->input->get_post('no_of_sample');
		$no_of_non_premium_animal = $this->input->get_post('no_of_non_premium_animal');
		$no_of_premium_animal = $this->input->get_post('no_of_premium_animal');
		$update['payment_type'] = 'Dr';
        $update['request_status'] = '2';
        $update['date'] = date('Y-m-d H:i:s');
        $this->api_model->update('id', $purchase_id, 'log_file', $update);
		$amount = $this->input->get_post('wallet_balance_consume');
		if($amount == '0' || $amount ==''){
			$lab['ispaid'] = '0';
		}else{
			$lab['ispaid'] = '1';
		}
		$lab['admin_id'] = $admin_id;  
		$lab['premium_type'] = $premium_type;
		$lab['log_id'] = $purchase_id; 
		$lab['lab_id'] = $lab_id; 
		$lab['no_of_non_premium_samples'] = $no_of_non_premium_animal;
		$lab['no_of_premium_samples'] = $no_of_premium_animal;
		$this->api_model->update('id', $reg_no, 'lab_request', $lab);
		$users_id = $this->input->get_post('users_id');
		$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'" AND rest_quantity <> 0', 'ai_package_log', '', 'sum(rest_milk_collection) as sum');
				if($pack_data[0]['sum'] >  0){
					$pack_up_data = $this->api_model->get_data('users_id = "'.$users_id.'" AND rest_milk_collection <> 0', 'ai_package_log', '', '*');
					$p_d['rest_milk_collection'] = $pack_up_data[0]['rest_milk_collection'] -  $no_of_premium_animal;
					$this->api_model->get_data_update('id = "'.$pack_up_data[0]['id'].'"', 'ai_package_log', $p_d);
				}
        
       
        if($amount > 0){
        	$data['type'] = '24'; 
			if($app_type == '3'){
				$data['user_type'] = '3';
				$data['users_id'] = $admin_id;
			}else{
				$data['users_id'] = $users_id;
			}
        	$data['amount'] = $amount;
        	$data['status'] = 'Dr';
        	$data['wallet_type'] = '1';
        	$data['date'] = date('Y-m-d H:i:s');
        	$this->api_model->submit('livestoc_wallets', $data);
		}
		$lab_data = $this->api_model->get_data('id = "'.$lab_id.'"','lab_reg','', $select = '*');
		$request_id = $this->api_model->get_data('id = "'.$reg_no.'"','lab_request','', $select = '*');
		$sms_template = urlencode('LABREQUEST');
		$vars = array('var1'=>$request_id[0]['name'],'var2'=>$request_id[0]['phone'], 'var3'=>$request_id[0]['adress']);
		$mobile = $lab_data[0]['phone'];
		$curl = curl_init();
		$url = "https://2factor.in/API/R1/?module=TRANS_SMS&apikey=85aab6cd-b267-11e7-94da-0200cd936042&to=$mobile&from=LIVLAB&templatename=$sms_template";
		$url1 ='';
		foreach($vars as $key=>$var){
		$url1 .="&".$key."=".urlencode($var);
		}
		$url = $url.$url1;
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
		$u_data = $this->api_model->get_user_info_id($users_id);
		$to = TO_ADMIN;
		$subject = 'Free request for sample collection';
		$email = ''.$u_data[0]['full_name'].'('.$u_data[0]['mobile'].') requested for  Milk Sample Collection from '.$address.'';
		$e = $this->send_mail($to, $subject, $email);
        $json['success'] = true;
        $json['msg'] = 'Your request has been submitted successfully. We will contact you shortly.';
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_free_lbig(){
		$data['address'] = $this->input->get_post('address');
		$app_type = $this->input->get_post('app_type');
		$admin_id = $this->input->get_post('admin_id');
        $data['latitude'] = $this->input->get_post('latitude');
        $data['longitude'] = $this->input->get_post('longitude');
        $data['contact_name'] = $this->input->get_post('contact_name');
        $data['contact_number'] = $this->input->get_post('contact_number');              
        $data['semen_price'] = $this->input->get_post('semen_price');
		$data['users_id'] = $this->input->get_post('users_id');
		$data['daughter_yield'] = $this->input->get_post('daughter_yield');                
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
		$log_id = $this->input->get_post('purchase_id');
		$livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
		$real_balance_consume = $this->input->get_post('real_balance_consume');
		$animal_id = $this->input->get_post('animal_id');
		//$data['animal_id'] = json_decode($animal_id);
		$data['animal_id'] = implode(',', json_decode($animal_id));
		//$data['animal_id'] = $animal_id;
		$is_premium = '0';
		if($app_type != '3'){
			if($livestoc_balence_consume != '0' && !is_null($livestoc_balence_consume) && $livestoc_balence_consume !=''){
				if($app_type == '3'){
					$data1['users_id'] = $admin_id;
					$data1['user_type'] = '3';
				}else{
					$data1['users_id'] = $users_id;
				}
				$data1['log_id'] = $log_id;
				$data1['animal_id'] = '';
				$data1['amount'] = $livestoc_balence_consume;
				$data1['status'] = 'Dr';
				$data1['type'] = $user_type;
				$data1['wallet_type'] = '0';
				$data1['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('livestoc_wallets',$data1);
				$is_premium = '1';
			}
		}
		if($real_balance_consume != '0' && !is_null($real_balance_consume) && $real_balance_consume !=''){
			if($app_type == '3'){
				$data1['users_id'] = $admin_id;
				$data1['user_type'] = '3';
			}else{
				$data1['users_id'] = $users_id;
			}
			$data1['log_id'] = $log_id;
			$data1['animal_id'] = '';
			$data1['amount'] = $real_balance_consume;
			$data1['status'] = 'Dr';
			$data1['type'] = $user_type;
			$data1['wallet_type'] = '1';
			$data1['date'] = date('Y-m-d h:i:s');
			$this->api_model->submit('livestoc_wallets',$data1);
			$is_premium = '1';
		}
				if($app_type == '3'){
					$data['app_type'] = $app_type;
					$data['admin_id'] = $admin_id;
					$data['flag_type'] = '1';
				}	
        //$data['animal_id'] = json_decode($animal_id);
   //      	print_r($data);
			// exit;
        //foreach($animal_id as $ani){
			$pack_id = $this->api_model->get_data('animal_id = "'.$ani.'" AND users_id = "'.$data['users_id'].'"' , 'package_users_dog', '', '*');
		
				//$data['animal_id'] = $ani;
				$this->api_model->submit('package_users_dog', $data);
           	$dat['meating_payment_status'] = $is_premium;
           	$dat['latitude'] = $data['latitude'];
           	$dat['longitude'] = $data['longitude'];
           	$this->api_model->update('animal_id', $ani, 'animals', $dat);
		//}
		$u_data = $this->api_model->get_user_info_id($data['users_id']);
		$to = TO_ADMIN;
		$subject = 'Top Champion Bull Listing'; 
		$email = ''.$data['contact_name'].'('.$data['contact_number'].') registered his/her  bull in top Champion Bull Listing from '.$data['address'].'';
		$e = $this->send_mail($to, $subject, $email);
        $json['success'] = true;
		$json['msg'] = 'Your bull is successfully placed in Champion Bull listing.';
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;  
	}
	public function get_free_knin(){
		 		$users_id = $this->input->get_post('users_id');
				$app_type = $this->input->get_post('app_type');
				$admin_id = $this->input->get_post('admin_id');
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
				$log_id = $this->input->get_post('purchase_id');
				$livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
				$real_balance_consume = $this->input->get_post('real_balance_consume');
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
				$is_premium = '0';
				if($livestoc_balence_consume != '0' && !is_null($livestoc_balence_consume) && $livestoc_balence_consume !=''){
					if($app_type == '3'){
						$data1['users_id'] = $admin_id;
						$data1['user_type'] = '3';
					}else{
						$data1['users_id'] = $users_id;
					}
					$data1['log_id'] = $log_id;
					$data1['animal_id'] = '';
					$data1['amount'] = $livestoc_balence_consume;
					$data1['status'] = 'Dr';
					$data1['type'] = $user_type;
					$data1['wallet_type'] = '0';
					$data1['date'] = date('Y-m-d h:i:s');
					$this->api_model->submit('livestoc_wallets',$data1);
					$is_premium = '1';
				}
				if($real_balance_consume != '0' && !is_null($real_balance_consume) && $real_balance_consume !=''){
					if($app_type == '3'){
						$data1['users_id'] = $admin_id;
						$data1['user_type'] = '3';
					}else{
						$data1['users_id'] = $users_id;
					}
					$data1['log_id'] = $log_id;
					$data1['animal_id'] = '';
					$data1['amount'] = $real_balance_consume;
					$data1['status'] = 'Dr';
					$data1['type'] = $user_type;
					$data1['wallet_type'] = '1';
					$data1['date'] = date('Y-m-d h:i:s');
					$this->api_model->submit('livestoc_wallets',$data1);
					$is_premium = '1';
				}
				if($app_type == '3'){
					$data['app_type'] = $app_type;
					$data['admin_id'] = $admin_id;
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
                $dat['meating_payment_status'] = $is_premium;
				$this->api_model->update('animal_id', $animal_id, 'animals', $dat);   
				$u_data = $this->api_model->get_user_info_id($data['users_id']); 
				$to = TO_ADMIN;
				$subject = 'Top Champion Dog Listing'; 
				$email = ''.$u_data[0]['full_name'].'('.$u_data[0]['mobile'].') registered his/her  bull in top Champion Dog Listing from '.$address.'';
				$e = $this->send_mail($to, $subject, $email);
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
		$app_type = $this->input->get_post('app_type');
		$admin_id = $this->input->get_post('admin_id');
		$data1['users_id'] = $this->input->get_post('users_id');
		$data1['order_date'] = date('Y-m-d h:i:s');
		$users_id = $data1['users_id'];
		$data1['email'] = $this->input->get_post('email');
		
		//$this->api_model->submit('lab_reg', $data1);
		if($app_type == '3'){
			$amount_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amount_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		}else{
			$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		}
		$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
		$a['real_balance'] = $livestoc_balance;
		$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
		$end_data = date('Y-m-d');
		//$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_milk_collection) as sum');
		// echo $data1['no_of_sample'];
		// print_r($pack_data);
		// exit;
		$amount = 0;
		$total_amount = 0;
		if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
		//if($pack_data[0]['sum'] >  0){
			// if($pack_data[0]['sum'] > $data1['no_of_sample']){
				$amount = LAB_OFFER_CHARGES;
				$total_amount = LAB_OFFER_CHARGES * $data1['no_of_sample'];
				$amount_detail[1]['name'] = 'Premium rate for '.$data1['no_of_sample'].' animals';
				$amount_detail[1]['value'] = $amount;
				$json['premium_type'] = '1';
				$json['no_of_premium_animal'] =  $data1['no_of_sample'];
				$json['no_of_non_premium_animal'] = '0';
			// }else{
			// 	$sample_pre = $data1['no_of_sample'] - $pack_data[0]['sum'];
			// 	if($sample_pre != '0'){
			// 		$amount = LAB_CHARGES;
			// 		$total_amount = LAB_CHARGES * $sample_pre;
			// 		$amount_detail[1]['name'] = 'Non premium rate for '.$sample_pre.' animals';
			// 		$amount_detail[1]['value'] = $amount;
			// 		$json['premium_type'] = '0';
			// 		$json['no_of_non_premium_animal'] = $sample_pre;
			// 	}else{
			// 		$json['no_of_non_premium_animal'] = '0';
			// 	}
			// 	$amount = LAB_OFFER_CHARGES;
			// 	$total_amount += LAB_OFFER_CHARGES * $pack_data[0]['sum'];
			// 	$json['premium_type'] = '1';
			// 	$json['no_of_premium_animal'] =  $pack_data[0]['sum'];
			// 	$amount_detail[0]['name'] = 'Premium rate for '.$pack_data[0]['sum'].' animals';
			// 	$amount_detail[0]['value'] = $amount;
			// }
		}else{
			$amount = LAB_CHARGES;
			$total_amount = LAB_CHARGES * $data1['no_of_sample'];
			$amount_detail[1]['name'] = 'Non premium rate for '.$data1['no_of_sample'].' animals';
			$amount_detail[1]['value'] = $amount;
			$json['premium_type'] = '0';
			$json['no_of_premium_animal'] =  $data1[0]['sum'];
			$json['no_of_non_premium_animal'] ='0';
		}
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
			$amount_detail[2]['name'] = 'No of Samples';
			$amount_detail[2]['value'] = $data1['no_of_sample'];
			if(!$a['real_balance_consume'] == '0'){
				$amount_detail[3]['name'] = 'Wallet balance used';
				$amount_detail[3]['value'] = $a['real_balance_consume'];
			}
			$amount_detail[4]['name'] = 'Total Amount';
			$amount_detail[4]['value'] = $a['balance_actual_payment'];
			
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
	public function yield_checker_test(){
		date_default_timezone_set('Asia/Calcutta');
		$number_of_animal = $this->input->get_post('number_of_animal');
		$data1['users_id'] = $this->input->get_post('users_id');
		$data1['created_on'] = date('Y-m-d h:i:s');
		$users_id = $data1['users_id'];
		$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
		$a['real_balance'] = $livestoc_balance;	
		$my_date_time_from = date("Y-m-d");
		$my_date_time_to = date("Y-m-d", strtotime("-12 Months"));
		$dat = $this->api_model->get_data("users_id = '".$users_id."' AND date BETWEEN '".$my_date_time_to."' AND '".$my_date_time_from."' AND (rest_quantity <> 0 OR rest_milk_collection <> 0)", 'ai_package_log','', '*');
		$amount = 0;
		$total_amount = 0;
		if(!empty($dat)){
				$amount = YIELD_OFFER_CHARGES;
				$total_amount = YIELD_OFFER_CHARGES * $number_of_animal;
				$amount_detail[1]['name'] = 'Price';
				$amount_detail[1]['value'] = $total_amount;
				$json['premium_type'] = '1';
		}else{
			$amount = YIELD_CHARGES;
			$total_amount = YIELD_CHARGES * $number_of_animal;
			$amount_detail[1]['name'] = 'Price';
			$amount_detail[1]['value'] = $total_amount;
			$json['premium_type'] = '0';
		}
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
		$data1['treat_type'] = '6';
		$type = '24';
		$currency = $this->input->get_post('currency');
		$user_type = $this->input->get_post('user_type');
		$request_status  =$this->input->get_post('request_status');
		//if($last_id = $this->api_model->submit('vt_requests', $data1)){
			$data['users_id'] = $users_id;
			$data['currency'] = $currency;
			$data['type'] = $type;
			$data['amount'] = $total_amount;
			if(!$a['real_balance_consume'] == '0'){
				$amount_detail[3]['name'] = 'Wallet balance used';
				$amount_detail[3]['value'] = $a['real_balance_consume'];
			}
			$amount_detail[4]['name'] = 'Total Amount';
			$amount_detail[4]['value'] = $a['balance_actual_payment'];
			$data['user_type'] = $user_type;
			$data['premium_bull_type'] = '';
			$data['request_status'] = isset($request_status) ? $request_status : 0;
			$data['date'] = date('Y-m-d h:i:s');
			//$detail = $this->api_model->insert_log_data($data);
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
			$detail[0]['razorpayOrderId'] =  json_decode($response);
			$json['success'] = true;
			$json['data'] = $detail;
			$json['payment_detail'] = array_values($amount_detail);
			$json['actual_pay_amount'] = $a['balance_actual_payment'];
			$json['wallet_balance_consume'] = $a['real_balance_consume'];
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
		
		$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		// echo $amount_cr;
		// exit;

		$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
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
	public function get_service_rating_status(){
		// echo "this is test";
		// exit;
		$users_id = $this->input->get_post('users_id');
		$data = $this->api_model->get_data('users_id = "'.$users_id.'" AND rating_status = "0" AND conversation_duration <> "0:00:00"' , 'doctor_call_inisite', 'id DESC', 'DISTINCT(call_date) as date, (select max(id) as id from doctor_call_inisite where `users_id` = "'.$users_id.'" AND `rating_status` = "0") as id, `doctor_id`, 30 as `type`, `rating_status`',0,4);
		$count = count($data);
		if($count <= 5){	
			$co = (4 - $count);
			$data_re = $this->api_model->get_data('users_id = "'.$users_id.'" AND rating_status = "0" AND status = "4"' , 'vt_requests as vt', 'id DESC', 'DISTINCT(date),(select max(id) as id from  vt_requests  where `users_id` = "'.$users_id.'" AND `rating_status` = "0" AND `status` = "4" AND date=vt.date) as id, vt_id as doctor_id, if(treat_type = "3", 27,if(treat_type = "5", 26,"")) as type, rating_status',0,$co);
			$details = array_merge($data,$data_re);	
		}else{
			$details = $data;	
		}
		foreach($details as $da){
			if($da['type'] == '30'){
					$da['type_message']= 'Please Rate the Veterinary Doctor';
				}else if($da['type'] == '27'){
					$da['type_message'] = 'Please Rate the AI Technician';
				}else if($da['type'] == '26'){
					$da['type_message'] = 'Please Rate the Doctors Visit';
				}
			
			$rating = $this->api_model->get_doctor_list_rating($da['doctor_id']);
			$da['service_type'] = $da['type'];
			$da['users_type'] = $rating[0]['users_type'];
            $da['doctor_name'] = $rating[0]['username'];
            $da['doctor_id'] = $rating[0]['doctor_id'];
            $da['mobile'] = $rating[0]['mobile'];
            $da['institute'] = $rating[0]['institute'];
            $da['qualifi_name'] = $rating[0]['qualifi_name'];
            $da['total_experience'] = $rating[0]['total_experience'];
            $da['languages'] = $rating[0]['languages']; 
            $da['expertise_list'] = $rating[0]['expertise_list'];
            $da['image'] = $rating[0]['image'];	
			$da['rating'] = $rating[0]['rating'];
			$d[] = $da; 
		}
		if(!empty($d)){
			$json['success'] = true;
			$json['data'] = $d;
		}else{			
			$json['success'] = false;
			$json['error'] = 'No record found.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_doctor_rating_list(){
		$id = $this->input->get_post('id');
		$doctor_id = $this->input->get_post('doctor_id');
		$users_id = $this->input->get_post('users_id');
		$start = $this->input->get_post('start');
		$type = $this->input->get_post('type');
		$doctor_id = $data[0]['doctor_id'];
		if($start == '')
			$start = 0;
		$data = $this->api_model->get_users_call_history($users_id, '0');
		if($data[0]['type'] == '30'){
				$type= 'Please rate the Doctor';
			}else if($data[0]['type'] == '27'){
				$type = 'Please rate the AI worker';
			}else if($data[0]['type'] == '26'){
				$type = 'Please Rate the Doctors Visit';
			}
		foreach ($data as $da) {
			$data = $this->api_model->doctor_list_call_rating($da['doctor_id'],$start);
			// print_r($data);
			// exit;
			$da['image'] = $data[0]['image'];
			$da['service_type'] = $da['type'];
			$da['doctor_name'] = $data[0]['username'];
			$da['mobile'] = $data[0]['mobile'];
			$da['institute'] = $data[0]['institute'];
			$da['qualifi_name'] = $data[0]['qualifi_name'];
			$da['total_experience'] = $data[0]['total_experience'];
			$da['languages'] = $data[0]['languages'];
			$da['expertise_list'] = $data[0]['expertise_list'];
			$da['qulifi_name'] = $data[0]['qulifi_name'];
			$da['rating'] = $data[0]['rating'];
			$da['type'] = $type;
			$dat[] = $da;
		}
		if(!empty($dat)){
			$json['success'] = true;
			$json['data'] = $dat;
		}else{			
			$json['success'] = false;
			$json['error'] = 'No record found.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function update_rating_status(){
		$id = $this->input->get_post('id');
		$id = json_decode($id);
		$type = $this->input->get_post('type');
		$type = json_decode($type);
		$data['rating_status'] = '2';
		$i = 0;
			foreach($id as $value){
				if($type[$i] == '30'){
					$table = 'doctor_call_inisite';
					$where = 'id = "'.$value.'"';
				}else{
					$table = 'vt_requests';
					$where = 'id = "'.$value.'"';
				}
				$detail= $this->api_model->get_data_update($where, $table, $data);
				$i++;
			}
		if($detail){
			$json_data['success'] = TRUE;
			$json_data['msg'] = 'Your status has been successfully updated';
		}else{
			$json_data['success'] = FALSE;
			$json_data['error'] = "There is problem with data base";
		}
		header('Content-Type:application/json');
		echo json_encode($json_data);
		exit;
	}
	public function doc_call_rating_insert(){
		$id = $this->input->get_post('id');
		$data['request_id'] = $id;
		$doctor_id = $this->input->get_post('doctor_id');		
		$data['doctor_id'] = $doctor_id;
		$data['users_id'] = $this->input->get_post('users_id');
		$data['rating'] = $this->input->get_post('rating');
		$data['feedback'] = $this->input->get_post('feedback');		 
		$type = $this->input->get_post('type');
		$data['type'] = $type; 
		$data['created_on'] = date('Y-m-d H:i:s');
		$dat['rating_status'] = '1';
			if($type == '30'){
				$table = 'doctor_call_inisite';
				$where = 'id = "'.$id.'"';
			}else{
				$table = 'vt_requests';
				$where = 'id = "'.$id.'"';
			}
		 $detail= $this->api_model->get_data_update($where, $table, $dat);
		if(!isset($_REQUEST['doctor_id']) || $_REQUEST['doctor_id'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please send doctor id';
		}else if (!isset($_REQUEST['users_id']) || $_REQUEST['users_id'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please send users id';
		}else if (!isset($_REQUEST['rating']) || $_REQUEST['rating'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please send rating';
		}else if (!isset($_REQUEST['feedback']) || $_REQUEST['feedback'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please write your reviews';
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
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		}		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	// public function doc_call_rating_insert(){
	// 	$data['doctor_id'] = $this->input->get_post('doctor_id');
	// 	$data['users_id'] = $this->input->get_post('users_id');
	// 	$data['rating'] = $this->input->get_post('rating');
	// 	$data['feedback'] = $this->input->get_post('feedback');
	// 	$data['type'] = $this->input->get_post('type');
	// 	$data['created_on'] = date('Y-m-d H:i:s');
	// 	if(!isset($_REQUEST['doctor_id']) || $_REQUEST['doctor_id'] == ''){
	// 		$json['success'] = false;
	// 		$json['error'] = 'Please send doctor id';
	// 	}else if (!isset($_REQUEST['users_id']) || $_REQUEST['users_id'] == ''){
	// 		$json['success'] = false;
	// 		$json['error'] = 'Please send users id';
	// 	}else if (!isset($_REQUEST['rating']) || $_REQUEST['rating'] == ''){
	// 		$json['success'] = false;
	// 		$json['error'] = 'Please send rating';
	// 	}
	// 	// else if (!isset($_REQUEST['feedback']) || $_REQUEST['feedback'] == ''){
	// 	// 	$json['success'] = false;
	// 	// 	$json['error'] = 'Please send feedback';
	// 	// }
	// 	else{
	// 		if($this->api_model->submit('doctor_call_rating',$data)){
	// 			$json['success']  = true; 
	// 			$json['msg'] ='Your Rate and Reviews has been successfully submitted.';
	// 		}else{
	// 			$json['success']  = true; 
	// 			$json['error'] = 'Database Error';
	// 		}
	// 	}		
	// 	header('Content-Type: application/json');
	// 	echo json_encode($json);
	// 	exit;
	// }
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
	//if(lf.type = '48', 'Vaccination Request Generated',
	public function get_wallets_transaction(){
		$users_id = $this->input->get_post('users_id');
		$users_type = $this->input->get_post('users_type');
		$detail = $this->api_model->wallets_transaction($users_id, $users_type);
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
	public function consume_wallet($users_id, $animal_id, $livestoc_balence_consume, $real_balance_consume, $log_id, $type){
		if($users_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send User ID';
		}
		else if($animal_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send Animal Id';
		}else if($log_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send Log Id';
		}else{
			if($livestoc_balence_consume != '0'){
				$data['log_id'] = $log_id;
				$data['users_id'] = $users_id;
				$data['animal_id'] = $animal_id;
				$data['amount'] = $livestoc_balence_consume;
				$data['status'] = 'Dr';
				$data['type'] = $type;
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
				$data['type'] = $type;
				$data['wallet_type'] = '1';
				$data['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('livestoc_wallets',$data);
			}	
			$json['success'] = true;
			$json['msg'] = 'Your Wallet is Updated';
		}
		return $json;
	}
	public function wallet_consume(){
		$users_id = $this->input->get_post('users_id');
		$animal_id = $this->input->get_post('animal_id');
		$livestoc_balence_consume = $this->input->get_post('livestoc_balence_consume');
		$real_balance_consume = $this->input->get_post('real_balance_consume');
		$log_id = $this->input->get_post('log_id');
		if($users_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send User ID';
		}
		else if($animal_id == ''){
			$json['success'] = false;
			$json['error'] = 'Please send Animal Id';
		}else if($log_id == ''){
			$json['success'] = false;
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
		$number1 = '+91'.$number1;  //number1 mens user
		$number2 = '+91'.$number2;  // number2 mens doctor
		$user_type_agent = $this->input->get_post('user_type_agent');
		$user_id_agent = $this->input->get_post('user_id_agent');
		$user_type_customer = $this->input->get_post('user_type_customer');
		$user_id_customer = $this->input->get_post('user_id_customer');
		$time = $this->input->get_post('duration');
			$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "http://etsrds.kapps.in/webapi/enterprise/v1/makecall.py",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => array("k_number" => "+916366783212","caller_id" => "+918047248869","agent_number" => "$number1","customer_number" => "$number2","timer" => "$time","user_type_agent" => "984","user_id_agent" => "984","user_type_customer" => "984","user_id_customer" => "984"),
				  CURLOPT_HTTPHEADER => array(
				    "authorization: 95d4c58b-80a1-4e75-bf78-5970a52d0c11",
				    "x-api-key: nDRUngYws3739teklCMYp9IufbQ8qjf212iyMkiG",
				    "Content-Type: multipart/form-data; boundary=--------------------------275353496800163766266088"
				  ),
				));				
			$response = curl_exec($curl);
			curl_close($curl);
			$err = curl_error($curl);
			//echo $response;
		//curl_close($curl);
		// if ($err) {
		//   echo json_decode($err);
		// } else {
		$res = json_decode($response);
		  //echo json_encode($res);
		  if($res->status != 'Success'){
		  	//$json['error'] = $res->error->message;
		  	$json['success'] = False;
		  	$json['error'] = 'Sorry for inconvenience, Unable to Connect at the moment';
		  }else{		  	
		  	$json['success'] = true;
		  	$json['msg'] = 'Please wait you will receive a call shortly';
		  	$json['status'] = $res->success->status;
		  }		  
		//   echo $res->success->call_id;
		// }
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;

	}
	public function get_call_history(){		
		$doctor_id = $this->input->get_post('doctor_id');
		$start= $this->input->get_post('start');
		if($start == '')
			$start = 0;
		$perpage = 10;
		$dat = $this->api_model->get_users_details($doctor_id, $start, $perpage);
		$count = $this->api_model->get_users_details_count($doctor_id);
		$total_amt = $dat[0]['company_share'];
		$i = 0;
		foreach($dat as $d){
		 $amount +=  $d['company_share']+$dat[0]['company_share'];
		 $i++;
		}
		if(!empty($dat)){
			
			$json['success'] = true;
			$json['data'] = $dat;
			$json['count'] = $count[0]['count'];
			$json['total_amount'] = $amount;
		}else{			
			$json['success'] = false;
			if($count[0]['count'] < $start){
				$json['error'] = 'No more record found.';
			}else{
				$json['error'] = 'No record found.';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	// public function call_inisite(){
	// 	$number1 = $this->input->get_post('number1');
	// 	$number2 = $this->input->get_post('number2');
	// 	$number1 = '+91'.$number1;
	// 	$number2 = '+91'.$number2;
	// 	$curl = curl_init();

	// 	curl_setopt_array($curl, array(
	// 	  CURLOPT_URL => "https://kpi.knowlarity.com/Basic/v1/account/call/makecall",
	// 	  CURLOPT_RETURNTRANSFER => true,
	// 	  CURLOPT_ENCODING => "",
	// 	  CURLOPT_MAXREDIRS => 10,
	// 	  CURLOPT_TIMEOUT => 30,
	// 	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 	  CURLOPT_CUSTOMREQUEST => "POST",
	// 	  CURLOPT_POSTFIELDS => "{\n  \"k_number\": \"+917428513734\",\n  \"agent_number\": \"+917428513734\",\n  \"customer_number\": \"$number1\",\n  \"caller_id\": \"$number2\"\n}",
	// 	  CURLOPT_HTTPHEADER => array(
	// 	    "authorization: b3afc056-9e3f-427a-83e9-cff7727444dc",
	// 	    "cache-control: no-cache",
	// 	    "postman-token: afe93f69-431b-b0c1-db6a-c8f11ab0d317",
	// 	    "x-api-key: qygykJocLq1qvAlJOUP1oMQsH5Jzol5iIT1OJc00"
	// 	  ),
	// 	));

	// 	$response = curl_exec($curl);
	// 	$err = curl_error($curl);

	// 	curl_close($curl);
	// 	if ($err) {
	// 	  echo json_decode($err);
	// 	} else {
	// 	  $res = json_decode($response);
	// 	  //echo json_encode($res);
	// 	  if(isset($res->error)){
	// 	  	$json['error'] = $res->error->message;
	// 	  	$json['success'] = False;
	// 	  }else{
	// 	  	$json['msg'] = 'Please wait you will receive a call shortly';
	// 	  	$json['success'] = true;
	// 	  	//$json['status'] = $res->success->status;
	// 	  }
		  
	// 	  //echo $res->success->call_id;
	// 	}
	// 	header('Content-Type: application/json');
	// 	echo json_encode($json);
	// 	exit;

	// }
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
	public function get_user_treat_request(){
		$users_id = $this->input->get_post('users_id');
		$treat_type = '6';
		$data = $this->api_model->get_visiting_treet($users_id, $treat_type);
		$detial = [];
		foreach($data as $da){
			$doctor_detail = $this->api_model->doc_detail_id($da['vt_id']);
			$da['doctor_name'] = $doctor_detail[0]['username'];
			$da['image'] = base_url().'uploads/doctor/'.$doctor_detail[0]['image'];
			$da['doctor_mobile'] = $doctor_detail[0]['mobile'];
			$da['mob_code'] = $doctor_detail[0]['mobile_code'];
			$da['doctor_email'] = $doctor_detail[0]['email'];
			$da['doctor_address'] = $doctor_detail[0]['address_full'];
			$detial[] = $da;
		}
		if(empty($detial)){
			$json['success'] = False;
			$json['error'] = 'You do not have any request at the moment.';
		}else{
			$json['success'] = true;
			$json['data'] = $detial;
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_all_doc_by_visit(){
		$users_id = $this->input->get_post('users_id');
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
		$vacc_term = $this->input->get_post('vacc_term');
		if($start == '' || !isset($start))
		$start = 0;
		$langitude = $this->input->get_post('langitude');
		$speci_type = $this->input->get_post('speci_id');
		$state = $this->input->get_post('state_code');
		if($vacc_term == ''){
			$visit = 1;
		}else{
			$visit = '';
		}
			$detail = $this->api_model->get_doc_quif_speci_list($speci_type, $premium_type, $latitu, $langitude, $languages, $name, $expertise, $visiting_set, $start, $visit, $vacc_term);
			$data = [];
			$i = 0;
			foreach($detail as $d){	
					$i++;
					$doc_primum = $this->api_model->get_my_purchase_detail($d['doc_id']);
						if($users_id != '' ){
							$prev_date = date("Y-m-d", strtotime("".date('Y-m-d')." -".HOME_VISIT_DAYS." day"));
							$current_date = date("Y-m-d", strtotime("".date('Y-m-d')." +".HOME_VISIT_DAYS." day"));;
							if($home_charge = $this->api_model->get_data('users_id = '.$users_id.' AND vt_id = '.$d['doc_id'].' AND created_on BETWEEN "'.$prev_date.'" AND "'.$current_date.'" AND (select log_id from vt_requests where id= request_id) = 0','home_visit_log')){
								if($check_status = $this->api_model->get_data('id = '.$home_charge[0]['request_id'].' AND (status NOT IN (4, 3))','vt_requests')){
									if($home_charge[0]['amount'] != '0.00' && !is_null($home_charge[0]['amount'])){
										$d['request_id'] = $home_charge[0]['request_id'];
										$d['priscription_amount'] = $home_charge[0]['amount'];
									}
								}
							}
						} 
					if($d['languages'] != ''){
						$d_name= $this->api_model->get_all_lang($d['languages']);
						$d['languages'] = $d_name[0]['name'];
					}
					$de['is_paid'] = $doc_primum[0]['is_paid'];
					if(!empty($de)){
						$d['service_data'] = 1;
					}else{
						$d['service_data'] = 0;
					}
					$doc_qua = $this->login_cheak_model->get_qulification_doc_id($d['doc_id']);
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
						$dtx = $doc_exp;
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
				}
				if($cou != '0'){
					if(!empty($data)){
					$json['success'] = True;
					$json['data'] = $data;
					$json['count']	= $i;	
					}else{
						$json['success'] = False;
						$json['error'] = "We are in process of updating the listings please check after 48 Hrs";
					}
				}else{
					$json['success'] = False;
					$json['error'] = "We are in process of updating the listings please check after 48 Hrs";
				}
		//}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function purchase_lead_dealer_breader(){
		$users_id = $this->input->get_post('users_id');
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
		}else{
				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
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
				if($a['real_balance'] != '0'){
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
				}else{
					$a['real_balance_status'] = 0;
					$a['real_balance_consume'] = 0;
					$a['diffrence_amount'] = $product_rate; 
				}
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
						$lead_count = $this->api_model->get_data('users_id = "'.$users_id.'" AND rest_qty <> 0','dealer_breader_lead_log', '', 'if(sum(rest_qty) IS NOT NULL, sum(rest_qty), 0) as count');
						$detail[0]['lead_count'] = $lead_count[0]['count'];
						$json['data'] = $detail;
						$json['consume'] = '1';	
					}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function purchase_lead_doctor(){
		$users_id = $this->input->get_post('users_id');
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
		}else{
				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1" AND user_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
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
				if($a['real_balance'] != '0'){
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
				}else{
					$a['real_balance_status'] = 0;
					$a['real_balance_consume'] = 0;
					$a['diffrence_amount'] = $product_rate; 
				}
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
				if($data['consul_fee'] != '' || $data['consul_fee'] != '0'){
					$call_rate = $data['consul_fee'];
				}else{
					$call_rate = CALL_RATE;
				}
				$total_rate = $call_rate * CALL_MIN;
				$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$real_balance = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
				$product_info = $this->api_model->get_data('product_type = "'.$product_type.'"', 'product_wallet_price_consume', '', '*');
				$a['real_balance'] = $livestoc_balance;
				$a['livestoc_balence'] = $real_balance;
				$a['product_consume_rate'] = $product_info[0]['product_consume_rate'];
				$a['min_minut'] = CALL_MIN;
				$time_call =round($livestoc_balance/$call_rate);
				$a['total_call_by_balance'] = $time_call; 
				$a['min_balance'] = $total_rate;
				$len = round($time_call);
				if($len > '1'){
					$time = "00:0".$time_call.":00";	
				}else if($len == '2'){
					$time = "00:".$time_call.":00";
				}
				// else if($len == '3'){
				// 	$time_call= $time_call/60;
				// 	$time = "00:".$time_call.":0";
				// }
				$a['duration'] = $time;
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
				$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$detail =[];				
				$a['real_balance'] = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
					$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
					$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
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
				$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$detail =[];
				$a['real_balance'] = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
					$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
					$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "0" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
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
	public function get_wallets(){
		$users_id = $this->input->get_post('users_id');
		$users_type = $this->input->get_post('users_type');
		if($users_type == '1'){
			$users_type = '1';
		}else if($users_type == '3'){
			$users_type = '3';
		}else{
			$users_type = '0';
		}
		$amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "'.$users_type.'"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		$amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "'.$users_type.'"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
		$detail =[];
		// foreach($amount_cr as $a){

			 $a['real_balance'] = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
			$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0" AND user_type = "'.$users_type.'"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
			$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "0" AND user_type = "'.$users_type.'"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
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
			$detail = [];
			foreach($data as $de){
				// if($de['designation']== '' || $de['organization']== '' || $de['from_date']== '' || $de['to_date']== '' || $de['doc_id']== '' || $de['exp_id'] ){
				// 	unset($de['designation']);
				// 	unset($de['organization']);
				// 	unset($de['from_date']);
				// 	unset($de['to_date']);
				// 	unset($de['year']);
				// }else{
					$detail[] = $de;
				// }
			}
			if(empty($detail)){
				$json['success']  = false; 
				$json['error'] = 'You have not added your experience & employment details yet! Please add first.';
			}else{
				$json['success']  = true; 
				$json['data'] = $detail;
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
		if($data = $this->api_model->get_data('doctor_id = "'.$doc_id.'"' , 'doctor', '', 'is_perform_ai,is_consultation_on, is_available_consultation, ai_visiting_fee, visiting_fee, ai_visiting_fee,consul_fee,avaialable_for_visit,online_for_visit, is_vecc_term')){
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
		$avaialable_for_visit = $this->input->get_post('avaialable_for_visit');
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
		if(isset($avaialable_for_visit) || $avaialable_for_visit != ''){
			$data['avaialable_for_visit'] = $avaialable_for_visit;
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
		$certificate = $this->input->get_post('vc_certificate');
		$district_code = $this->input->get_post('district_id');
		$district = $this->input->get_post('district');
		$state_code = $this->input->get_post('state_id');
		//print_r($vc_certificate);
		if(isset($name) || $name != ''){
			$data['username'] = $name;
			$data['fullname'] = $name;
		}
		if(isset($state) || $state != ''){
			$data['state'] = $state;
			//$data['state_code'] = $state;
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
		if(isset($certificate) || $certificate != ''){
			$data['vc_certificate'] = $certificate;
		}
		if(isset($district_id) || $district_id != ''){
			$data['district_code'] = $district_id;
		}
		if(isset($district) || $district != ''){
			$data['district'] = $district;
		}
		if(isset($state_code) || $state_code != ''){
			$data['state_code'] = $state_code;
		} 

		// print_r($data);
		// exit;
			if($this->api_model->update('doctor_id', $doc_id, 'doctor', $data)){
				$detail = $this->api_model->get_data('doctor_id = "'.$doc_id.'"' , 'doctor', '', 'doctor_id, CONCAT("'.IMAGE_PATH.'harpahu_merge_dev/uploads/doctore_doc/",vc_certificate) as vc_certificate, users_type, username, mobile, refral_code, ai_visiting_fee, email, image, isactivated, is_payment, expertise_list, total_experience, rej_region, state,district,district_code as district_id,state_code, pincode, address_full, city, aadhar_no, adhaar_img');
				if($detail[0]['users_type'] == 'pvt_doc'){
						$doc_qua = $this->login_cheak_model->get_qulification_doc_id($detail[0]['doctor_id']);
						// print_r();
						// exit;
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
						if($detail[0]['users_type'] == 'pvt_doc'){
							$detail[0]['image'] = base_url()."uploads/doctor/".$detail[0]['image'];
						}else{
							$detail[0]['image'] = base_url()."uploads/doc/".$detail[0]['image'];
						}
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
	public function proforma_invoice_status(){
		$invoice_id = $this->input->get_post('invoice');
		if($invoice_id == ''){
			$json['error'] = "Please send invoice id";
			$json['success'] = false;
		}else{
			if($this->api_model->proforma_invoice_status($invoice_id)){
				$json['success'] = true;
			}else{
				$json['success'] = false;
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function proforma_invoice_cod(){
			$id = $this->input->get_post('invoice');
			if($id == ''){
				$json['error'] = "Please send invoice id";
				$json['success'] = false;
			}else{
				$data = $this->api_model->get_invoice_id($id);
				$log_data['amount']=$data[0]['invoice_total'];
				$log_data['user_type']='1';
				$log_data['users_id']=$data[0]['users_id'];
				$log_data['currency']='INR';
				$log_data['type']='13';
				$log_data['request_id']=$id;
				$log_data['payment_type'] = 'Dr';
				$log_data['status'] = '1';
				$log_data['request_status'] = '1';  
				$log_data['date'] = date('Y-m-d H:i:s');  
				$log_id = $this->api_model->submit('log_file',$log_data);
				$invoice_data['payment_status'] = '1';
				$invoice_data['invoice_status'] = '1';
				$invoice_data['log_id'] = $log_id;
				$this->api_model->update('id', $id, 'semen_invoice_performa', $invoice_data);
				if($data[0]['purchased_breeding_record'] > 0){
					$breed_data['doc_id'] = $data[0]['users_id'];
					$breed_data['breeding_total'] = $data[0]['purchased_breeding_record'];
					$breed_data['status'] = '1';
					$breed_data['log_id'] = $log_id;
					$breed_data['payment_status'] = '2';
					$breed_data['breeding_record_price'] = BREADING_RECORD_PRICE;
					$breed_data['created_date'] = date('Y-m-d');
					$log_id = $this->api_model->submit('breeding_account',$breed_data);
				}
				$stock_id = explode(",",$data['0']['semen_stock_id']);
				$stock_qty = explode(",",$data['0']['semen_stock_qty']);
				$i = 0;
				foreach($stock_id as $s_id){
					$stock_detail = $this->api_model->get_data('id = "'.$s_id.'"' , 'seman_stock', '', '*');
					$date = date('Y-m-d h:i:s');
					$stock_data['bull_id'] = $stock_detail[0]['bull_id'];
					$stock_data['stock_id'] = $stock_detail[0]['id'];
					$stock_data['batch_no'] = $stock_detail[0]['batch_no'];
					$stock_data['rest_stock'] = $stock_qty[$i];
					$stock_data['opening_stock'] = $stock_qty[$i];
					$stock_data['date'] = $date;
					$stock_data['bank_id'] = $stock_detail[0]['bank_id'];
					$stock_data['type'] = '13';
					$stock_data['ai_farmer_price'] = $stock_detail[0]['farmer_price'];
					$stock_data['farmer_price'] = $stock_detail[0]['farmer_price'];
					$stock_data['farmer_offer_price'] = $stock_detail[0]['farmer_offer_price'];
					$stock_data['ai_price'] = $stock_detail[0]['ai_price'];
					$stock_data['ai_offer_price'] = $stock_detail[0]['ai_offer_price'];
					$stock_data['advance_booking_price'] = $stock_detail[0]['advance_booking_price'];
					$stock_data['advance_booking_offer_price'] = $stock_detail[0]['advance_booking_offer_price'];
					$stock_data['ai_service_price'] = $stock_detail[0]['ai_service_price'];
					$stock_data['ai_service_offer_price'] = $stock_detail[0]['ai_service_offer_price'];
					$stock_data['ai_company_charges'] = $stock_detail[0]['company_charges'];
					$stock_data['company_charges'] = $stock_detail[0]['company_charges'];
					$stock_data['company_offer_charges'] = $stock_detail[0]['company_offer_charges'];
					$stock_data['purchase_price'] = $stock_detail[0]['purchase_price'];
					$stock_data['sale_price'] = $stock_detail[0]['sale_price'];
					$stock_data['ai_sale_price'] = $stock_detail[0]['ai_sale_price'];
					$stock_data['stock_type'] = $stock_detail[0]['stock_type'];
					$stock_data['admin_id'] = $data[0]['users_id'];
					$stock_data['isactive'] = "1";
					$this->api_model->submit('seman_stock',$stock_data);
					$rest_stock = $stock_detail[0]['rest_stock'] - $stock_qty[$i];
					$rest['rest_stock'] = $rest_stock;
					$this->api_model->update('id', $s_id, 'seman_stock', $rest);
					//$db->query('UPDATE seman_stock SET rest_stock = "'.$rest_stock.'" where id = "'.$s_id['id'].'"');
					$i++;
				}
				$json['msg'] = "COD request successfully performed, Please check Semen stock of AI worker";
				$json['success'] = true;
			}
			header('Content-Type: application/json');
			echo json_encode($json);
			exit;
	}
	public function vetinvoice($id){
		$data['data'] = $this->api_model->get_invoice_id($id);
		$this->load->view('admin/invoice', $data);
	}
	public function proforma_invoice(){
		$opening_stock = $this->input->get_post('opening_stock');
		$admin_id = $this->input->get_post('admin_id');
		$stock = $this->input->get_post('stock_id');
		$users_id = $this->input->get_post('doc_id');
		$breeding_record = $this->input->get_post('breeding_record');
		$gas_qty = $this->input->get_post('gas');
		$sheath =$this->input->get_post('sheath');
		$gloves = $this->input->get_post('gloves');
		$opening_stock = json_decode($opening_stock);
		$stock = json_decode($stock);
		$i = 0;
		$di0 = 0;
		$di1 = 0;
		foreach($stock as $st){
			$stock_data = $this->api_model->get_semen_stock_id($st);
			$bull_group = $this->api_model->get_data('id = '.$stock_data[0]['bull_id'].'', 'bull_table');
			$discount = $this->api_model->get_data('FIND_IN_SET('.$bull_group[0]['groups'].', groups)' , 'semen_group_discount');
			$bull_id_array[$i] = $stock_data[0]['bull_id'];
			//if($discount[0]['semen_quantity'] =< )
			if($i == 0){
				$stock_id = $st;
				$stoct_price =  $stock_data[0]['ai_price'];
				$stock_qty = $opening_stock[$i];
				$total = $stock_data[0]['ai_price'] * $opening_stock[$i];
			}else{
				$stock_id .= ','.$st;
				$stoct_price .= ','.$stock_data[0]['ai_price'];
				$stock_qty .= ','.$opening_stock[$i];
				$total += $stock_data[0]['ai_price'] * $opening_stock[$i];
			}
			$i++;
		}
		$st_q = explode(',',$stock_qty);
		$st_id = explode(',',$stock_id);
		// echo "<pre>";
		// print_r($st_q);
		// print_r($bull_id_array);
		$tot = array_combine($st_id , $bull_id_array);
		// $array = [1, 2, 3, 1, 2,2,1,1];
		$output = [];
		$i = 0;
		foreach ($bull_id_array as $key => $value) {
			$output[$value] += $st_q[$i];
			$i++;
		}

		// $array = [];
		// foreach ($output as $key => $value) {
		// 	if($value > 1)
		// 	$array[] = $key;
		// }

		// echo '<pre>';
		// print_r($tot);
		// print_r($output);
		//print_r($opening_stock);
		$i = 0;
		foreach($bull_id_array as $bu_array){
			$stock_data = $this->api_model->get_semen_stock_id($stock[$i]);
			$bull_group = $this->api_model->get_data('id = '.$bu_array.'', 'bull_table');
			$discount = $this->api_model->get_data('FIND_IN_SET('.$bull_group[0]['groups'].', groups)' , 'semen_group_discount');
			$str = 0;
			foreach($output as $key => $bu_a){
				if($i == 0){
					if($key == $bu_array){
						if(!empty($discount)){
							foreach($discount as $dis){
								if($dis['limit_quantity'] != '0'){
									if($dis['semen_quantity'] <= $bu_a && $dis['limit_quantity'] >= $bu_a){
										$di0 = $dis['percentage'];	
										break;
									}
								}else{
									if($dis['semen_quantity'] <= $bu_a){
										$di0 = $dis['percentage'];
										break;
									}
								}
							}
							$discount_total = (($stock_data[0]['ai_price'] * $opening_stock[$i]) * $di0) / 100;
							$disc = $discount_total;
						}
					}
				}else{
					if($key == $bu_array){
						if(!empty($discount)){
							foreach($discount as $dis){
								if($dis['limit_quantity'] != '0'){
									if($dis['semen_quantity'] <= $bu_a && $dis['limit_quantity'] >= $bu_a){
										$di1 = $dis['percentage'];
										break;
									}
								}else{
									if($dis['semen_quantity'] <= $bu_a){
										$di1 = $dis['percentage'];
										break;
									}
								}
							}
							$discount_total += (($stock_data[0]['ai_price'] * $opening_stock[$i]) * $di1) / 100;
							$disc .=','.(($stock_data[0]['ai_price'] * $opening_stock[$i]) * $di1) / 100;
						}
						$di0 .=','.$di1;
					}
				}
				
				// print_r($bu_a);
				// $st_q[$i];
				//if($i != '0'){
					//if($key == $bu_a){
						
						//if($str > )
						// cho $bu_a;
						//echo "</br>";
						// echo "this is test";e
						//if($i > 0){
						//	echo $str += $st_q[$i];
						//}
						//$i++;
					//}
				//}
				
			}
			$i++;
		}
		// $st_d = explode(',', $discount_total);
		// print_r($st_d);
		// echo $di0;
		// echo "</br>";
		// echo $disc;
		// echo "</br>";
		// echo $discount_total;
		// exit;
		$gas = $gas_qty * GAS_PRICE + (($gas_qty * GAS_PRICE)*GAS_TAX/100);
		$total += $gas;
		$total += $breeding_record * BREADING_RECORD_PRICE;
		$total += $sheath * SHEATH_PRICE;
		$total += $gloves * GLOVES_PRICE;
		$data['users_id'] = $users_id;
		$data['admin_id'] = $admin_id;
		$data['semen_stock_id'] = $stock_id;
		$data['semen_stock_price'] = $stoct_price;
		$data['semen_stock_qty'] = $stock_qty;
		$data['sheath_qty'] = $sheath;
		$data['gas_qty'] = $gas_qty;
		$data['total_discount'] = $discount_total;
		$data['discount'] = $disc;
		$data['discount_per'] = $di0;
		$data['breeding_record'] = $stock_qty;
		$data['purchased_breeding_record'] = $breeding_record;
		$data['gloves_qty'] = $gloves;
		$data['invoice_total'] = $total - $discount_total;
		$data['date'] = date('y-m-d');
		$last_id = $this->api_model->submit('semen_invoice_performa', $data);
		$json['total'] = $total;
		$json['invoice'] = $last_id;
		$json['link'] = base_url().'api/vetinvoice/'.$last_id;
		$json['success'] = true;
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_proforma(){
		$user_id = $this->input->get_post('users_id');
		$invoice_id = $this->input->get_post('invoice');
		if($data = $this->api_model->get_proforma_invoice($user_id, $invoice_id)){
			$data[0]['breeding_record_price'] = BREADING_RECORD_PRICE;
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
	public function make_other_treetment(){
		$users_id = $this->input->get_post('users_id');	
		$vt_id = $this->input->get_post('admin_id');
		$ani = $this->input->get_post('animal_id');
		$type = $this->input->get_post('request_type');
		$rand = rand(1000,9999);
		$user_detail = $this->api_model->get_data('users_id = "'.$users_id.'"' , 'users', '', $select = '*');
		// $pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
		// if($pack_data[0]['sum'] >  0){
		$semen_data = $this->api_model->get_data('id = "'.$d[0]['groups'].'"', 'semen_group', '', '*');
		$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
		$end_data = date('Y-m-d');
		if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){
			$data['premium_type'] = '1';
		}
		$data['users_id'] =$users_id;
		$data['animal_id'] = $ani;
		$data['treat_type'] = $type;
		$data['address'] = $user_detail[0]['address'];
		$data['latitude'] = $user_detail[0]['latitude'];;
		$data['langitude'] = $user_detail[0]['longitude'];
		$data['request_type'] = '2';
		$data['status'] = '1';
		$data['vt_id'] = $vt_id;
		$data['otp'] = $rand;
		$data['date'] = date('Y-m-d');
		$data['time'] = '00:00';
		$data['created_on'] = date('Y-m-d h:i:s');
		$da = $this->api_model->submit('vt_requests', $data);
		$dat['request_id'] = $da;
		$dat['animal_id'] = $ani;
		$dat['user_id'] = $users_id;
		$dat['treat_type'] = $type;
		$dat['vt_id'] = $vt_id;
		$dat['treat_status'] ='1';
		$dat['request_type'] = '2';
		$dat['status'] = '1';
		$dat['otp'] = $rand;
		$dat['date'] = date('Y-m-d');
		$this->api_model->submit('vt_request_tracking', $dat);
		$json['data'] = $da;
		$json['success'] = true;
		header('Content-Type: application/json');
		echo json_encode($json);	
		exit;
	}
	public function invoice_vet($id){
		$data['data'] = $this->api_model->get_invoice_id($id);
		$this->load->view('admin/admin_invoice', $data);
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
			// echo "<pre>";
			// print_r($request);
			$semen_group1 = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_price, ai_farmer_price FROM seman_stock where admin_id = "'.$data['admin_id'].'" AND bull_id = "'.$data['bull_id'].'" AND rest_stock <> 0');
			// print_r($semen_group);
			// echo "dasdasdasdasd----------";
			$bull = $this->api_model->get_data('id = "'.$data['bull_id'].'"' , 'bull_table', '', '*');
			$semen_group = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"', 'semen_group','','*');
			if($request[0]['order_type'] == '1'){
				$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
				if($pack_data[0]['sum'] >  0){
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
					$semen_group1 = $this->api_model->query_build('SELECT  min(id) as id, farmer_price, farmer_offer_price, ai_price, ai_farmer_price FROM seman_stock where admin_id = "'.$data['admin_id'].'" AND bull_id = "'.$data['bull_id'].'" AND rest_stock <> 0');
					// print_r($semen_group);
					// exit;
					$bull = $this->api_model->get_data('id = "'.$data['bull_id'].'"' , 'bull_table', '', '*');
					$semen_group = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"', 'semen_group','','*');
					$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
					if($request[0]['order_type'] == '1'){
						if($pack_data[0]['sum'] >  0){
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
					$old_semen_group1 = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_price, ai_farmer_price FROM seman_stock where admin_id = "'.$data['admin_id'].'" AND bull_id = "'.$request[0]['vacc_id'].'" AND rest_stock <> 0 ');
					if($request[0]['order_type'] == '1'){
						$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
						if($pack_data[0]['sum'] >  0){
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
						$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
						if($pack_data[0]['sum'] >  0){
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
			$pack_data = $this->api_model->get_data('users_id = "'.$users_id.'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
			if($request[0]['order_type'] == '1'){
				if($pack_data[0]['sum'] >  0){
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
					$pack_data = $this->api_model->get_data('users_id = "'.$data[0]['users_id'].'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
					if($pack_data[0]['sum'] >  0){
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
				$semen_price = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_farmer_price, ai_price FROM seman_stock where admin_id = "'.$data[0]['vt_id'].'" AND bull_id = "'.$in[0]['bull_id'].'" AND rest_stock <> 0 AND is_update = "1"');
				// $bull = $this->api_model->get_data('id = "'.$in[0]['bull_id'].'"' , 'bull_table', '', '*');
				// $semen_price = $this->api_model->get_data('id ="'.$bull[0]['groups'].'"','semen_group','','*');
				$semen_old_price = $this->api_model->query_build('SELECT min(id) as id, farmer_price, farmer_offer_price, ai_farmer_price, ai_price FROM seman_stock where admin_id = "'.$data[0]['vt_id'].'" AND bull_id = "'.$in[0]['old_bull_id'].'" AND rest_stock <> 0 AND is_update = "1"');
				// $old_bull = $this->api_model->get_data('id = "'.$in[0]['old_bull_id'].'"' , 'bull_table', '', '*');
				// $semen_old_price = $this->api_model->get_data('id ="'.$old_bull[0]['groups'].'"','semen_group','','*');
				
				if($order_type == '1'){
					$pack_data = $this->api_model->get_data('users_id = "'.$data[0]['users_id'].'"', 'ai_package_log', '', 'sum(rest_quantity) as sum');
					if($pack_data[0]['sum'] >  0){
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
				//-----------------------------------------------//
				$update['Invoice_id'] = $invoice_id;
				$update['symptoms_image'] = $straw_image;
				$this->api_model->update('id', $in[0]['request_id'], 'vt_requests', $update);
				//$this->api_model->change_request_status($in[0]['request_id'], $update);
				$data1['status'] = '4';
				$this->api_model->change_request_status($in[0]['request_id'], $data1);

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
	public function change_ai_semen_rate(){
		$bull_id = $this->input->get_post('bull_id');
		$ai_rate = $this->input->get_post('ai_rate');
		$admin_id = $this->input->get_post('doc_id');
		if($bull_id == '' || !isset($bull_id)){
			$json['success']  = false; 
			$json['error'] = "Please Send Bull ID";
		}else if($ai_rate == '' || !isset($ai_rate)){
			$json['success']  = false; 
			$json['error'] = "Please Send AI Price";
		}else if($admin_id == '' || !isset($admin_id)){
			$json['success']  = false; 
			$json['error'] = "Please Send AI Price";	
		}else{
			$data['ai_farmer_price'] = $ai_rate;
			//$data['farmer_offer_price'] = $ai_rate;
			$data['ai_company_charges'] = BREADING_PRICE;
			//$data['company_offer_charges'] = BREADING_PRICE;
			$data['is_update'] = '1';
			// $this->api_model->get_data_update('bull_id = "'.$bull_id.'" AND rest_stock <> "0"', 'seman_stock', $data);
			if($this->api_model->get_data_update('bull_id = "'.$bull_id.'" AND admin_id ="'.$admin_id.'" AND rest_stock <> "0"', 'seman_stock', $data)){
				$json['msg'] = "Your price for AI is updated for this Bull. Make sure your charges includes the breeding record price.";
				$json['success']  = TRUE; 
			}else{
				$json['error'] = "Database Problem";
				$json['success']  = false; 
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;	
	}
	public function genrate_treat(){
		$users_id = $this->input->get_post('users_id');
		$doc_id = $this->input->get_post('doc_id');
		$request_id = $this->input->get_post('request_id');
		$amount = $this->input->get_post('amount');
		//$doc_rate = $this->api_model->get_doc_id_det($doc_id);
		// print_r($doc_rate);
		// exit;
		//$product_rate = $doc_rate['visiting_fee'];
		$product_rate = $amount;
		$type = $this->input->get_post('type');
		$premium_bull_type = $this->input->get_post('premium_bull_type');
		$currency = $this->input->get_post('currency');
		$user_type = $this->input->get_post('user_type');
		$request_status  =$this->input->get_post('request_status');
		if(!isset($users_id) && $users_id ==''){
			$json['success'] = false;
			$json['error'] = 'Please Send User ID';
		}else{
				$amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
				$amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
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
				if($a['real_balance'] != '0'){
							if($a['real_balance'] == $product_rate){
								$a['real_balance_consume'] = $product_rate;
								$a['real_balance_status'] = 0; 
								$a['diffrence_amount'] = 0;
								$product_rate = 0;
							}else if($a['real_balance'] <= $product_rate){
								$a['real_balance_status'] = 0; 
								$a['real_balance_consume'] =  $a['real_balance'];
								$a['diffrence_amount'] = $product_rate - $a['real_balance'];
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
				}else{
					$a['real_balance_status'] = 0;
					$a['real_balance_consume'] = 0;
					$a['diffrence_amount'] = $product_rate; 
				}
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
	public function get_dashboard_list(){
		$category = $this->input->get_post('category_id');
		if($category == '0'){
			$category  = '';
		}
		$user_id = $this->input->get_post('user_id');
		$language = $this->input->get_post('language');
		$state_id = $this->input->get_post('state_id');
		$state_name = $this->input->get_post('state_name');
		$sale_animal = $this->api_model->get_animals($category, 0, 5, $users_type_id, '1','');
		if($category == '1,8' || $category =='0' || $category == ''){			
				$json['data']['user_sell_semen'] = '1';
				$json['data']['show_livestoc_lab'] = '1';				
				}else{
					$json['data']['user_sell_semen'] = '0';
					$json['data']['show_livestoc_lab'] = '0';
				}
		$semen_banner = $this->api_model->get_featured_semen($category, 0, 2);
		$get_information_banners = $this->api_model->get_information_banners($category, 1, 4, 'dashboard');
		//$get_dog_cat_banners = $this->api_model->get_dog_cat_banners($category, 1, 4, 'dashboard');
		$get_information_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 1);
		$get_featured_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 2);
		$get_featured_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 2);
		$get_featured_product = $this->api_model->get_featured_product($category, $start, $perpage, 1);
		$get_featured_product_new = $this->front_end_model->get_produc_with_price_and_details(1,1,$category);
		$get_featured_feed_product = $this->front_end_model->get_produc_with_price_and_details(1, 1, 17);
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
		$breeder_animal = $this->api_model->get_animals($category, 1, 5, 4, "'1','2'", '');
		$ai_worker = $this->api_model->doc_premium_type("'pvt_ai', 'pvt_vt'");
		$doc_worker = $this->api_model->doc_premium_type("'repeat_breading', 'animal_nutrition'");
		$video_tutorials = $this->Admin_detail->get_last_five_video_block_showto();
		if($cat == '4' || $cat == '9')
		{
			$sec_id = '';
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
		$section = $this->api_model->get_product_cat();
		$home_doc=[];
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
			$sequence_order[] = 'Check_leads';
			$sequence_order[] = 'search';
			
			if($category =='0' || $category =='' || $category =='4' || $category =='9' || $category =='7,10' || $category =='3,14' || $category == '1,8' || $category == '5'){
				if(!empty($home_doc_worker)){
					$json['data']['home_doc_worker'] = $home_doc;
					//$sequence_order[] = 'home_doc_worker';
				}
			}
			if($category =='0' || $category =='' || $category =='4' || $category =='9' || $category =='7,10' || $category =='3,14' || $category == '1,8' || $category == '5'){
				if(!empty($home_doc_worker)){
					$json['data']['doc_home_visit'] = $home_doc;
					//$sequence_order[] = 'home_doc_worker';
				}
			}
			if(!empty($get_featured_product_new))
            {
                $json['data']['ecomm_product'] = $get_featured_product_new;
                $sequence_order[] = 'ecomm_product';
            }
            if(!empty($get_featured_feed_product))
            {
				$json['data']['feed_product'] = $get_featured_feed_product;
				$sequence_order[] = 'feed_product';
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
			$json['data']['breeder_price'] = '5999';
			$json['data']['mating_price'] = '5999';
			$json['data']['add_bull_price'] = '5999';
			$json['data']['pregnancy_test_price'] = LAB_CHARGES;
			$json['data']['pregnancy_sample_helpline'] = HELP_LINE;
			$json['data']['yield_checker_price'] = YIELD_CHARGES;
			// end static value
			if(!empty($get_featured_product))
			{
			 $json['data']['featured_product'] = $get_featured_product;
			 //$sequence_order[] = 'featured_product';
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
			 $json['data']['other_primum_list'] = [];
			 //$sequence_order[] = 'other_primum_list';
			}
			//$sequence_order[] = 'knowledge_bank';
			if(!empty($get_articles))
			{
			 $json['data']['articles'] = $get_articles;
			 $sequence_order[] = 'articles1';
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
			if(!empty($get_information_videos))
			{
			 $json['data']['information_videos'] = $get_information_videos;
			 //$sequence_order[] = 'information_videos';
			}
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
				$json['data']['events'] = [];
			 //$json['data']['events'] = $get_events;
			 //$sequence_order[] = 'events';
			}
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
	{	$get_featured_product_new = $this->front_end_model->get_produc_with_price_and_details(1, 17, '1');
		print_r($get_featured_product_new);
		exit;
		//echo phpinfo();
		//$name =;
		//$name = '{"animal_id":"[\"4054\"]","avg_milk_proteen":"[\"22\"]","is_certified":"[\"NO\"]","is_imported":"[\"NO\"]","lat_yield":"[\"12\"]","milk_type":"[\"A1\"]","progini_test":"[\"NO\"]","semen_price":"[\"1234\"]","semen_type":"[\"Normal\"]","total_milk_fat":"[\"12\"]","total_milk_proteen":"[\"12\"]"}';
		//$name = json_encode($name);
		//echo $name;
		//$name = stripslashes($name);
		// echo $name;
        //$name = json_decode($name, true);
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
			}else if($de['type_type'] == '2'){
				$de['type'] = 'Seller Access Package';
			}else if($de['type_type'] == '6'){
				$de['type'] = 'Artificial Insemination';
			}else if($de['type_type'] == '11'){
				$de['type'] = 'Advance Semen Booking';
			}else if($de['type_type'] == '12'){
				$de['type'] = 'Animal Premium';
			}else if($de['type_type'] == '13'){
				$de['type'] = 'Semen Stock Payment';
			}else if($de['type_type'] == '14'){
				$de['type'] = 'Shopping Cart';
			}else if($de['type_type'] == '15'){
				$de['type'] = 'Registered as Dealer';
			}else if($de['type_type'] == '16'){
				$de['type'] = 'Registered as Breeder';
			}else if($de['type_type'] == '17'){
				$de['type'] = 'Dog Mating Registration';
			}else if($de['type_type'] == '18'){
				$de['type'] = 'Bull Registration to Sell Semen';
			}else if($de['type_type'] == '19'){
				$de['type'] = 'Upgraded to Premium Member';
			}else if($de['type_type'] == '23'){
				$de['type'] = 'Livestoc lab+cattle pregnancy test in 28 days with American Technology.';
			}else if($de['type_type'] == '24'){
				$de['type'] = 'Pregnancy Detection Sample';
			}else if($de['type_type'] == '27'){
				$pack_id = $this->api_model->get_data('id = "'.$de['package_id'].'"' , 'doctor_package', '','*');
				$de['type'] = $pack_id[0]['groups'].' Package Purchesed';
			}else if($de['type_type'] == '36'){
				$de['type'] = 'Yield Verification Request';
			}else if($de['type_type'] == '39'){
				$de['type'] = "Purchased Retailer's ID";
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
			$semen_price = $this->api_model->get_data('id ="'.$semen_data[0]['groups'].'"','semen_group','','*');
			$d['seman_groups'] = $semen_price[0]['group'];
			//$d['farmer_price'] = $semen_price[0]['farmer_price'];
			// $d['farmer_offer_price'] = $semen_price[0]['farmer_offer_price'];
			// $d['ai_sale_price'] = $semen_price[0]['ai_price'];
			$d['bull_no'] = 'LIVE_'.$d['bull_id'];
			$d['semen_bull_no'] = $semen_data[0]['bull_no'];
			$d['lat_yield'] = $semen_data[0]['lat_yield'];
			$d['daughter_yield'] = $semen_data[0]['daughter_yield'];
			$admin_detail = $this->api_model->get_admin_detail($semen_data[0]['bull_source']);
			$d['bank_name'] = $admin_detail[0]['fname'];
			$d['image'] = base_url().'uploads/bank/'.$semen_data[0]['image'];
			$category = $this->api_model->get_animal_category($semen_data[0]['category']);
			$d['category'] = $category[0]['category'];
			$bread = $this->api_model->get_animal_breed($semen_data[0]['bread']);
			$d['bread'] = $bread[0]['breed_name'];
			$stock_detail = $this->api_model->get_semen_stock_id($d['stock_id']);
			$stock_admin = $this->api_model->get_admin_detail($stock_detail[0]['admin_id']);
			$d['sendor_name'] = $stock_admin[0]['fname'];
			//$d['seman_groups'] = $semen_data[0]['groups'];
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
		$data['payment_type'] = 'Dr';
		$data['status'] = 1;
		$data['request_status'] = '2';
		$log_data = $this->api_model->update_log_file($data, $purchase_id);
		if($payment_method == 'LVET'){
			$user_l = $this->api_model->get_user_detail($user_id);
			$full_name = $user_l[0]['fullname'];
			$full_mobile = $user_l[0]['mobile'];
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
		$user_type = '0';	
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
					CURLOPT_URL => "https://www.livestoc.com/harpahu_merge_dev/home/push_notification?user_id=".$user_id."&description=".urlencode($msg)."&title=".urlencode($title)."",
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
					$user_type = 1;
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
				}
			}
			if($payment_method == 'LPRO'){
				$user_type = '1';
			}
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
			$ai_data['user_type'] = $user_type;
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
	public function simple_push_none($user_id, $type , $title, $flag = 0, $msg){
		if($type == 1){
			$detail = $this->api_model->get_fcm_doc($user_id);
			$server_key = PARAVATE_SERVERKEY;
		}else if($type == 2){
			$detail = $this->api_model->get_fcm_user($user_id);
			$server_key = LIVESTOCK_AND_SERVERKEY;
		}else if($type == 3){
			$detail = $this->api_model->get_fcm_admin($user_id);
			//$server_key = DEALER_APP_SERVERKEY;
			$server_key = 'AAAAtoSpA8o:APA91bF6gUR3XLHSMmIyRsiTKP3kmoCWOchNe_fJTfaV1Aj_Ah7miB8CS83GJRS-64LCqsbUzQpUGiwjXzQHZDK-n4GCwTnZ91Wmss8-Vg2O4NP7WdFwhe45EXknZDfwogxaf0CE29M2';
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
			if($detail){
				$data['success'] =  TRUE;
	      		$data['data'] =  $detail;
			}else{
				$data['success'] =  FALSE;
	      		$data['error'] =  "No Record Found";
			}
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
	public function get_suppliyer_order(){
		$user_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		$admin = $this->api_model->get_admin_detail($user_id);
		if($type == ''){
			$type = '0';
		}
				$detail = $this->api_model->get_suppliyer_order($user_id, $type);
				$detail1 = [];
				foreach($detail as $d){
					$go = $this->api_model->get_seman_detail($d['bull_id']);
					if($type == 1){
						$user = $this->api_model->doc_detail_id($d['users_id']);
						if(is_null($user[0]['image'])){
							$d['user_image'] = '';
						}else{
							$d['user_image'] = base_url().'uploads/doc/'.$d['image'];
						}
					}else{
						$user = $this->api_model->get_user_detail($d['users_id']);
						if(is_null($user[0]['image'])){
							$d['user_image'] = '';
						}else{
							$d['user_image'] = IMAGE_PATH.'uploads_new/profile/thumb/'.$user[0]['image'];
						}
					}	
					$d['fullname'] = $user[0]['fullname'];
					$d['mobile'] = $user[0]['mobile'];
					$d['bull_no'] = $go[0]['bull_no'];
					$semen_group = $this->api_model->get_data('id ="'.$go[0]['groups'].'"', 'semen_group','','*');
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
					
					$d['bull_name'] = $go[0]['bull_name'];
					$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
					$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
					$d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
					$animal_category = $this->api_model->get_animal_category($go[0]['category']);
					$d['seman_category'] = $animal_category[0]['category'];
					$detail1[] = $d;
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
	public function get_coustomer_semen_order(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
		if($type == ''){
			$type = '0';
		}
		$data = $this->api_model->get_coustomer_semen_order1($users_id, $type);
		$detail = '';
		foreach ($data as $d) {
			$de = $this->api_model->get_seman_bull_detail($d['bull_id']);
			$semen_group = $this->api_model->get_data('id ="'.$de[0]['groups'].'"', 'semen_group','','*');
			$breed = $this->api_model->get_breed($de[0]['bread']);
			$category = $this->api_model->get_category($de[0]['category']);
			$d['groups'] = $semen_group[0]['group'];
			if($type == '1'){
				$d['price'] = $semen_group[0]['ai_price'];
			}else{
				$d['price'] = $semen_group[0]['advance_booking_price'];
			}
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
			$d['category'] = $category[0]['category'];
			$d['breed_name'] = $breed[0]['breed_name'];
			$d['bull_name'] = $de[0]['bull_name'];
			$d['bull_no'] = $de[0]['bull_no'];
			$d['lat_yield'] = $de[0]['lat_yield'];
			$d['rating'] = $de[0]['rating']; 
			//$d['price'] = $de[0]['price'];
			$seman_bank = $this->api_model->get_seman_company_id($de[0]['bull_source']);
			$d['bank_name'] = $seman_bank[0]['fname'];
			$d['bank_email'] = $seman_bank[0]['email'];
			$d['total_milk_fat'] = $de[0]['total_milk_fat'];
			$d['bull_image'] = base_url().'uploads/bank/'.$de[0]['image'];
			$sup = $this->api_model->get_admin_detail1($d['suppliyer_id']);
			$d['supplier_name'] = $sup[0]['fname'];
			$d['supplier_mobile'] = $sup[0]['mobile'];
			$d['supplier_image'] = base_url().'uploads/bank/'.$sup[0]['image'];
			$detail[] = $d;
		}
		if(!empty($detail)){
				$data1['success'] =  TRUE;
				$data1['data'] =  $detail;
		}else{
				$data1['success'] =  False;
				$data1['error'] =  'No Data Found';
				$data1['data'] =  [];
		}
		header('Content-Type: application/json');
		echo json_encode($data1);
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
						$semen_group = $this->api_model->get_data('id ="'.$go[0]['groups'].'"', 'semen_group','','*');
						$d['groups'] = $semen_group[0]['group'];
						$d['bull_no'] = $go[0]['bull_no'];
						$d['bull_name'] = $go[0]['bull_name'];
						$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
						$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
						$d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
						$animal_category = $this->api_model->get_animal_category($go[0]['category']);
						$d['seman_category'] = $animal_category[0]['category'];
						$sup = $this->api_model->get_admin_detail($d['suppliyer_id']);
						$d['supplier_name'] = $sup[0]['fname'];
						$d['supplier_email'] = $sup[0]['email'];
						$d['supplier_image'] = base_url().'uploads/bank/'.$sup[0]['image'];
						$detail1[] = $d;
					}
			}else{
				$detail = $this->api_model->pre_order_ai_table_comp($user_id, $request_type);
				$detail1 = [];
				foreach($detail as $d){
					$go = $this->api_model->get_seman_detail($d['bull_id']);
					$semen_group = $this->api_model->get_data('id ="'.$go[0]['groups'].'"', 'semen_group','','*');
					$d['groups'] = $semen_group[0]['group'];
					$d['bull_name'] = $go[0]['bull_name'];
					$d['bull_no'] = $go[0]['bull_no'];
					$d['bull_image'] = base_url().'uploads/bank/'.$go[0]['image'];
					$animal_breed = $this->api_model->get_animal_breed($go[0]['bread']);
					$d['seman_bread_name'] = $animal_breed[0]['breed_name']; 
					$animal_category = $this->api_model->get_animal_category($go[0]['category']);
					$d['seman_category'] = $animal_category[0]['category'];
					$sup = $this->api_model->get_admin_detail($d['suppliyer_id']);
					$d['supplier_name'] = $sup[0]['fname'];
					$d['supplier_email'] = $sup[0]['email'];
					$d['supplier_image'] = base_url().'uploads/bank/'.$sup[0]['image'];
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
		$semen_group = $this->api_model->get_data('id ="'.$bull_data[0]['groups'].'"', 'semen_group','','*');
		$bull_data[0]['groups'] = $semen_group[0]['group'];
		$bull_data[0]['farmer_price'] = $semen_group[0]['farmer_price'];
		$bull_data[0]['farmer_offer_price'] = $semen_group[0]['farmer_offer_price'];
		$bull_data[0]['ai_price'] = $semen_group[0]['ai_price'];
		$bull_data[0]['ai_offer_price'] = $semen_group[0]['ai_offer_price'];
		$bull_data[0]['advance_booking_price'] = $semen_group[0]['advance_booking_price'];
		$bull_data[0]['advance_semen_booking_price'] = $semen_group[0]['advance_booking_price'];
		$bull_data[0]['advance_booking_offer_price'] = $semen_group[0]['advance_booking_offer_price'];
		$bull_data[0]['ai_service_price'] = $semen_group[0]['ai_service_price'];
		$bull_data[0]['ai_service_offer_price'] = $semen_group[0]['ai_service_offer_price'];
		$bull_data[0]['company_charges'] = $semen_group[0]['company_charges'];
		$bull_data[0]['company_offer_charges'] = $semen_group[0]['company_offer_charges'];
		$bull_data[0]['championship_images'] = $chmp;
		$admin_detail = $this->api_model->get_admin_detail($bull_data[0]['bull_source']);
		if($admin_detail[0]['fname'] == ''){
			$bull_data[0]['semen_bank_name'] = $admin_detail[0]['bank_name'];
		}else{
			$bull_data[0]['semen_bank_name'] = $admin_detail[0]['fname'];
		}
		$bull_data[0]['price'] = $bull_data[0]['price'];
		$bull_data[0]['farmer_ai_price'] = $bull_data[0]['price'];
		$bull_data[0]['farmer_semen_price'] = $bull_data[0]['price'];
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
			foreach($d as $ds){
				$semen_price = $this->api_model->get_data('id = "'.$ds['groups'].'"', 'semen_group','','*');
				$data[$i]['service_key'] = "Bull ID"." LIVE_".$ds['id']." * ".$seman_qty[$y];
				if($type == 'ai_price'){
					$discount = $this->api_model->get_data('FIND_IN_SET('.$ds['groups'].', groups)' , 'semen_group_discount');
					$disc = 0;
					if(!empty($discount)){
						$di0 =0;
						foreach($discount as $dis){
							//exit;
							if($dis['limit_quantity'] != '0'){
								if($dis['semen_quantity'] <= $seman_qty[$y] && $dis['limit_quantity'] >= $seman_qty[$y]){
									$di0 = $dis['percentage'];	
									break;
								}
							}else{
								if($dis['semen_quantity'] <= $seman_qty[$y]){
									$di0 = $dis['percentage'];
									break;
								}
							}
						}
						$discount_total = (($semen_price[0]['ai_price'] * $seman_qty[$y]) * $di0) / 100;
						$disc = $discount_total;
					}
					$data[$i]['price'] = ($semen_price[0]['ai_price'] * $seman_qty[$y]);
					if($disc != 0)
					$data[$i]['discount'] = ($semen_price[0]['ai_price'] * $seman_qty[$y]) - $disc;
					$company_charg += '';
				}else{
					$data[$i]['price'] = ($semen_price[0]['advance_booking_price']) * $seman_qty[$y];
				}
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
			$detail_1['ai_charges']['price'] = 0;
		}else{
			$detail_1['ai_charges']['price'] = $ai_charge;
			$detail_1['ai_charges']['no_strow'] = $num_strow;
			$detail_1['ai_charges']['price'] = 0;
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
			//print_r($count);
			$detail['isactivated'] = $data[0]['isactivated'];
			$admin_detail = $this->api_model->get_admin_detail($admin_id);
			
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
	public function get_semen_vt_distributer(){
		$type = $this->input->get_post('type');
		$search = $this->input->get_post('search');
		if($type == 6){
			$data = $this->api_model->get_semen_vt_ai($search, '"pvt_ai", "pvt_vt"');
			$json['success']  = True; 
			$json['data'] = $data;
		}else{
			$data = $this->api_model->get_semen_vt_ai($search, '"pvt_ai", "pvt_vt"');
			$detail =[]; 
			foreach($data as $d){
				$d['image'] = base_url().'uploads/doc/'.$d['image'];
				$detail[] = $d;
			}
			if(!empty($detail)){
				$json['success']  = True; 
				$json['data'] = $detail;
			}
			else{
				$json['success']  = false; 
				$json['error'] = 'No AI worker found';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}	
	public function get_semen_offer(){
		$data = $this->api_model->get_data('' , 'semen_group_discount');
		$json['success']  = true; 
		$json['data'] = $data;
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
	public function get_seman_stock_list(){
		$admin_id = $this->input->get_post('admin_id');
		$name = $this->input->get_post('name');
		if($data = $this->api_model->get_seman_stock_list($admin_id, $name)){
			// print_r($data);
			// exit;
			$detail = [];
			foreach($data as $d){
				$bull_data = $this->api_model->ai_bull_detail_id($d['bull_id']);
				$admin_detail = $this->api_model->get_admin_detail($d['bank_id']);
				$d['semen_bank_name'] = $admin_detail[0]['fname'];
				$cat_name = $this->api_model->get_category($d['category']);
				$d['bull_cat_name'] = $cat_name[0]['category'];
				$bread_name = $this->api_model->get_animal_breed($d['bread']);
				$d['bull_bread_name'] = $bread_name[0]['breed_name'];
				$d['bull_image'] = base_url().'uploads/bank/'.$d['image'];
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
	public function get_semen_stock_listing(){
		$admin_id = $this->input->get_post('admin_id');
		$name = $this->input->get_post('name');
		if($data = $this->api_model->get_semen_stock_listing($admin_id, $name)){
			// print_r($data);
			// exit;
			$detail = [];
			foreach($data as $d){
				$bull_data = $this->api_model->ai_bull_detail_id($d['bull_id']);
				//print_r($bull_data);
				$semen_group = $this->api_model->get_data('id ="'.$bull_data[0]['groups'].'"', 'semen_group','','*');
				$d['groups'] = $semen_group[0]['group'];
				$d['farmer_price'] = $semen_group[0]['farmer_price'];
				$d['farmer_offer_price'] = $semen_group[0]['farmer_offer_price'];
				$d['ai_price'] = $semen_group[0]['ai_price'];
				$d['ai_sale_price'] = $semen_group[0]['ai_price'];
				$d['ai_offer_price'] = $semen_group[0]['ai_offer_price'];
				$d['advance_booking_price'] = $semen_group[0]['advance_booking_price'];
				$d['advance_semen_booking_price'] = $semen_group[0]['advance_booking_price'];
				$d['advance_booking_offer_price'] = $semen_group[0]['advance_booking_offer_price'];
				$d['ai_service_price'] = $semen_group[0]['ai_service_price'];
				$d['ai_service_offer_price'] = $semen_group[0]['ai_service_offer_price'];
				$d['company_charges'] = $semen_group[0]['company_charges'];
				$d['company_offer_charges'] = $semen_group[0]['company_offer_charges'];
				$d['tag_no'] = $bull_data[0]['bull_no'];
				$d['progini_test'] = $bull_data[0]['progini_test'];
				$d['daughter_yield'] = $bull_data[0]['daughter_yield'];
				$d['video'] = $bull_data[0]['video'];
				$d['progini_test'] = $bull_data[0]['progini_test'];
				$d['is_certified'] = $bull_data[0]['is_certified'];
				$d['ai_price'] = $bull_data[0]['price'];
				$d['lat_yield'] = $bull_data[0]['lat_yield'];
				$d['dam_yield'] = $bull_data[0]['dam_yield'];
				//$d['groups'] = $bull_data[0]['groups'];
				$d['is_imported'] = $bull_data[0]['is_imported'];
				$d['bull_bank_name'] = $bull_data[0]['bull_bank_name'];
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
	public function get_supplier_details(){
		$name = $this->input->get_post('name');
		$data = $this->api_model->get_supplier($name);
		$admin_id = $data[0]['admin_id'];
		//print_r($admin_id);
		$count = $this->api_model->athority_count($admin_id, $user_type);
		foreach($count as $c){
			$stock_count = $c['stock_count'];

		}
		// print_r($count);
		// exit;
		$detail =[]; 
		foreach($data as $d){
				$d['image'] = base_url().'uploads/doc/'.$d['image'];
				$detail[] = $d;
				$detail['count'] = $count;
		}
		if($detail){
		$json['success']  = True; 
		$json['data'] = $detail;		
		}else{
			$json['success']  = false; 
			$json['error'] = 'There is problem with database.';
		}		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;       
	}
	public function get_supplier_list(){
		$name = $this->input->get_post('name');
		$data = $this->api_model->get_supplier($name);
		$admin_id = $data[0]['admin_id'];
		if(!empty($data)){
		$json['success']  = True; 
		$json['data'] = $data;		
		}else{
			$json['success']  = false; 
			$json['error'] = 'No supplier found.';
		}		
		header('Content-Type: application/json');
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
						if($user_type == 26){
							$d['image'] = 'https://www.amazebrandlance.com/uploads/delevery_partner/'.$d['image'];
						}else{
							$d['image'] =  base_url().'uploads/bank/'.$d['image'];
						}
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
					}else if($user_type == 26){
						$json['error'] = "No Delivery Partner Found. Please add first";
					}else if($user_type == 39){
						$json['error'] = "No Distributor found. Please add first";
					}else if($user_type == 40){
						$json['error'] = "No Sub-Distributor found. Please add first";
					}else if($user_type == 41){
						$json['error'] = "No Retailer found. Please add first";
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
				}else if($user_type == 26){
					$json['error'] = "No Delivery Partner Found. Please add first";
				}else if($user_type == 39){
					$json['error'] = "No Distributor found. Please add first";
				}else if($user_type == 40){
					$json['error'] = "No Sub-Distributor found. Please add first";
				}else if($user_type == 41){
					$json['error'] = "No Retailer found. Please add first";
				}else{
					$json['error'] = "No Semen Supplier found. Please add first";
				}
			}
		}
		header('Content-Type:application/json');
		echo json_encode($json);
		exit;
	}
	public function get_level_onle(){
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
			if( $detail = $this->api_model->get_data('user_type = "'.$user_type.'"', 'admin','','*,CONCAT("https://www.amazebrandlance.com/uploads/delevery_partner/",image) as image')){
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
	public function supplier_semen_transfer(){
		$supplier_id = $this->input->get_post('supplier_id');
		$order_id = $this->input->get_post('order_id');
		$stock_id = $this->input->get_post('stock_id');
		$opening_stock = $this->input->get_post('opening_stock');
		$user_type = $this->input->get_post('user_type');
		if($stock_id != ''){
			$i = 0;
			$y = 0;
			$error = 0;
			$stock_id = json_decode($stock_id);
			$opening_stock = json_decode($opening_stock);
			foreach($stock_id as $as){
				$detail = $this->api_model->get_semen_stock_id($as);
				//print_r($detail);
				//exit;
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
					$data1['suppliyer_id'] = $supplier_id;
					$data1['otp'] = rand(1001,9999);
					$this->api_model->update('id', $order_id, 'pre_order_ai_table', $data1);
					$user_note4 = '';
					$title = 'Semen Order';
					$flag = 1;
					$msg = 'A new order for delivery has been assigned to you by the Distributor.';
					$this->push_non($supplier_id,  2, $title , $flag, BUSINESS_AND_SERVERKEY, BUSINESS_IOS_SERVERKEY, $msg);
					$user_note4['users_id'] = $supplier_id;
					$user_note4['title'] = $title;
					$user_note4['message'] = $msg;
					$user_note4['date'] = date('Y-m-d h:i:s');
					$user_note4['type'] = '3';
					$user_note4['isactive'] = '1';
					$user_note4['flag'] = '1';
					$this->api_model->user_notification($user_note4);
					foreach($stock_id as $as){
						$detail = $this->api_model->get_semen_stock_id($as);
						$data['farmer_price'] = $detail[0]['farmer_price'];
						$data['farmer_offer_price'] = $detail[0]['farmer_offer_price'];
						$data['ai_price'] = $detail[0]['ai_price'];
						$data['order_id'] = $order_id;
						$data['ai_offer_price'] = $detail[0]['ai_offer_price'];
						$data['advance_booking_price'] = $detail[0]['advance_booking_price'];
						$data['advance_booking_offer_price'] = $detail[0]['advance_booking_offer_price'];
						$data['ai_service_price'] = $detail[0]['ai_service_price'];
						$data['ai_service_offer_price'] = $detail[0]['ai_service_offer_price'];
						$data['company_charges'] = $detail[0]['company_charges'];
						$data['company_offer_charges'] = $detail[0]['company_offer_charges'];
						$data['bull_id'] = $detail[0]['bull_id'];
						$data['stock_id'] = $detail[0]['id'];
						$data['batch_no'] = $detail[0]['batch_no'];
						$data['rest_stock'] = $opening_stock[$i];
						$data['opening_stock'] = $opening_stock[$i];
						$data['date'] = date('Y-m-d h:i:s');
						$data['bank_id'] = $detail[0]['bank_id'];
						$data['type'] = $detail[0]['type'];
						$data['image'] = $detail[0]['image'];
						$data['admin_id'] = $supplier_id;
						$data['user_type'] = $user_type;
						$deta = $this->api_model->add_semen_stock($data);
						$stock['rest_stock'] = $detail[0]['rest_stock'] - $opening_stock[$i];
						$this->api_model->update_semen_stock($detail[0]['id'], $stock);
						$i++;
					}
					$json['success']  = True; 
					$json['msg'] = "Your order and Semen stock has been transferred to the suplier.";
				}else{
					$json['success']  = false; 
					$json['error'] = "Quantity is more then available stock (".$error.") or Out of stock";
				}
		}else{
			$data1['suppliyer_id'] = $supplier_id;
			$data1['otp'] = rand(1001,9999);
			$this->api_model->update('id', $order_id, 'pre_order_ai_table', $data1);
			$user_note4 = '';
			$title = 'Semen Order';
			$flag = 1;
			$msg = 'A new order for delivery has been assigned to you by the Distributor';
			$this->push_non($supplier_id,  2, $title , $flag, BUSINESS_AND_SERVERKEY, BUSINESS_IOS_SERVERKEY, $msg);
			$user_note4['users_id'] = $supplier_id;
			$user_note4['title'] = $title;
			$user_note4['message'] = $msg;
			$user_note4['date'] = date('Y-m-d h:i:s');
			$user_note4['type'] = '3';
			$user_note4['isactive'] = '1';
			$user_note4['flag'] = '1';
			$this->api_model->user_notification($user_note4);
			$json['success']  = true; 
			$json['msg'] = "Your order has been transferred to the suplier.";
		}
		header('Content-Type: application/json');
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
		$data['vehical_type'] = $this->input->get_post('vehical_type');
		$data['vehical_number'] = $this->input->get_post('vehical_number');
		$data['dl_number'] = $this->input->get_post('dl_number');
		$data['per_km'] = $this->input->get_post('per_km');
		$data['licence_photo'] = $this->input->get_post('licence_photo');
		$data['labour_charge'] = $this->input->get_post('labour_charge');
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
		//$data['super_admin_id'] = $this->input->get_post('user_id');
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
		$data['vehical_type'] = $this->input->get_post('vehical_type');
		$data['vehical_number'] = $this->input->get_post('vehical_number');
		$data['dl_number'] = $this->input->get_post('dl_number');
		$data['per_km'] = $this->input->get_post('per_km');
		$data['licence_photo'] = $this->input->get_post('licence_photo');
		$data['labour_charge'] = $this->input->get_post('labour_charge');
		$data['created_on'] = date('Y-m-d h:i:s');
		if($this->api_model->comp_mobile_email($data['mobile'])){
			$json['success']  = false; 
			$json['error'] = "Mobile No is already associated with other Account";
		}
		else if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
			if($data['user_type'] == '41'){

				$ad = $this->api_model->get_data('admin_id = "'.$super_id.'" AND rest_qty <> 0', 'admin_package_log','', 'sum(rest_qty) as count');
				if($ad[0]['count'] > 0){
					if($detail = $this->api_model->add_bank($data)){
						$wall['users_id'] = $detail;
						$wall['user_type'] = '3';
						$wall['amount'] = RETAILER_ADD;
						$wall['status'] = 'Cr';
						$wall['wallet_type'] = '1';
						$wall['date'] = date('Y-m-d H:i:s');
						$this->api_model->submit('livestoc_wallets', $wall);
						$up = $this->api_model->get_data('admin_id = "'.$super_id.'" AND rest_qty <> 0','admin_package_log');
						$updata['rest_qty'] = $up[0]['rest_qty'] - 1;
						$this->api_model->update('id', $up[0]['id'], 'admin_package_log', $updata);
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
					$json['error'] = "Please purchase IDs to Create Retailer";
				}
			}else{
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
		$users_id = $this->input->get_post('users_id');
		$data['doc_referal_by'] = $this->input->get_post('refral_id');
		$exe = $this->api_model->check_ref($data['doc_referal_by']);
		if($this->api_model->check_ref($data['doc_referal_by'])){
			if($detail = $this->api_model->update_referal_code($data, $users_id)){
				$json['success']  = True; 
				$json['msg'] = "Your request for updating Service Provider has been submited successfuly.";
			}else{
				$json['success']  = false; 
				$json['error'] = "Database Error";
			}
		}else{
			$json['success']  = false; 
			$json['error'] = "Your referral code is not matched";
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
			//if($dta = $this->api_model->get_data('users_id = "'.$users_id.'" AND category_id="'.$category_id.'" AND bread_id = "'.$bread_id.'"' , 'user_interested_in', '', '*')){
			if($dta = $this->api_model->get_data('users_id = "'.$users_id.'"' , 'user_interested_in', '', '*')){
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
	public function get_company_bull(){
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
		if($data = $this->api_model->get_company_bull($breed_id, $category_id, $limit, $premium, $daughter_yield_from, $daughter_yield_to, $user_type, $price_from, $price_to, $milk_type, $price_order, $latitude, $longitude,  $start)){
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
						$semen_group = $this->api_model->get_data('id ="'.$d['groups'].'"', 'semen_group','','*');
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
							$d['image'] = base_url()."uploads/bank/".$d['image'];
						}
						if($d['video'] == ''){
							$d['video'] ='';
						}else{
							$d['video'] = base_url()."uploads/bank/".$d['video'];
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
		 //   echo "<pre>";		
			// print_r($data);
			// exit;
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
						$semen_data = $this->api_model->get_data('id = "'.$d['groups'].'"', 'semen_group', '', '*');
						$d['advance_semen_booking_price'] = $semen_data[0]['advance_booking_price'];
						$d['groups'] = $semen_data[0]['group'];
						$d['like'] = $count[0]['count'];
						if(isset($users_id)){
							if($like = $this->api_model->get_like_status($users_id, $d['id'],0)){
								$d['like_status'] = '1';
							}else{
								$d['like_status'] = '0';
							}
						}
						$d['bull_no'] = 'LIVE_'.$d['id'];
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
						$d['ai_price'] = $semen_data[0]['ai_price'];
						//$d['image'] = isset($d['image']) ? base_url()."uploads/bank/".$d['image'] : '';
						//$d['video'] = isset($d['video']) ? base_url()."uploads/bank/".$d['video'] : '';
						$breed = $this->api_model->get_animal_breed($d['bread']);
						$d['breed_name'] = $breed[0]['breed_name'];
						$d['price'] = $semen_data[0]['farmer_price'];
						$dommy[] = $d;
					}
				$json['success']  = true; 
				$json['data'] = $dommy;
				$json['count'] = $this->api_model->get_seman_breed_id_count($breed_id, $category_id, $primium, $daughter_yield_from, $daughter_yield_to, $user_type, $price_from, $price_to, $milk_type, $price_order, $latitude, $longitude);
			}else{
				$json['success']  = false; 
				if($start <= 1){
					$json['error'] = "We are in process of updating the listings please check after 48 Hrs";
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
							if(empty($dat)){
										$detail[0]['qualification'] = [];
									}else{
										$detail[0]['qualification'] = $dat;
									}
							if(empty($detail[0]['vc_certificate'] != '' )){
										$detail[0]['vc_certificate'] = [];
									}else{
										$detail[0]['vc_certificate'] = base_url()."/uploads/doctore_doc/".$detail[0]['vc_certificate'];
							}
						//$detail[0]['vc_certificate'] = $detail[0]['vc_certificate'];
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
		$latitu=$this->input->get_post('latitude'); 
		$langitude=$this->input->get_post('langitude');
		if($start == '')
			$start = 0;
			

		if($data = $this->api_model->get_doctor_list($languages, $expertise_list, $specialisation_list, $qualification, $start, $expertise_list_num, $name, $price,  $latitu, $langitude)){
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
	public function get_user_call_history(){
		$users_id = $this->input->get_post('users_id');
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
		$details = $this->api_model->get_users_call_history($users_id);
			$data_count = $this->api_model->get_call_details_count($users_id);
			//print_r($details);
			foreach ($details as $val) {
				$data = $this->api_model->get_doctor_call_list($languages, $expertise_list, $specialisation_list, $qualification, $start, $expertise_list_num, $name, $price, $val['doctor_id']);
				//print_r($data);
				$da['doctor_id'] = $data[0]['doctor_id'];
				$da['username'] = $data[0]['username'];
				$da['is_consultation_on'] = $data[0]['is_consultation_on'];
				$da['consul_fee'] = $data[0]['consul_fee'];
				$da['mobile_code'] = $data[0]['mobile_code'];
				$da['mobile'] = $data[0]['mobile'];
				$da['rating'] = $data[0]['rating'];
				$da['institute'] = $data[0]['institute'];
				$da['qualifi_name'] = $data[0]['qualifi_name'];
				$da['total_experience'] = $data[0]['total_experience'];
				$da['languages'] = $data[0]['languages'];
				$da['expertise_list'] = $data[0]['expertise_list'];
				$da['image'] = $data[0]['image'];
				$da['qulifi_name'] = $data[0]['qulifi_name'];
				$da['call_date'] = $val['call_date'];
				$da['call_time'] = $val['call_time'];
				$da['call_direction'] = $val['call_direction'];
				$da['customer_number'] = $val['customer_number'];
				$da['agent_number'] = $val['agent_number'];
				$da['call_duration'] = $val['call_duration'];
				$da['call_status'] = $val['call_status'];
				$dat[] = $da;				
			}
			if(!empty($dat)){
			$json['success'] = True;
			$json['data'] = $dat;
			$json['count'] = $data_count[0]['count'];
		}else{
			$json['success'] = False;
			$json['error'] = 'No data found';
		}
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
		$district_code = $this->input->get_post('district_id');
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
		$vc_certificate = $this->input->get_post('vc_certificate');
		$qualificationList = json_decode($qualificationList);
		$experience_list = json_decode($experience_list);
		$mobilecheck = $this->api_model->docmobileadhaarcheck($mobile, $mobile_code); 
		$adhaarcheck = $this->api_model->docadhaarcheck($aadhar_no);
		$emailcheck = $this->api_model->docemailcheck($email);

		$state_reg_number = $this->input->get_post('state_reg_number');
		$state_year_of_reg = $this->input->get_post('state_year_of_reg');
		$state_veterinary_council = $this->input->get_post('state_veterinary_council');
		$state_vci_certificate = $this->input->get_post('state_vci_certificate');
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
				$data['vc_certificate'] = $vc_certificate;
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
				$data['state_reg_number'] = $state_reg_number;
				$data['state_year_of_reg'] = $state_year_of_reg;
				$data['state_veterinary_council'] = $state_veterinary_council;
				$data['state_vci_certificate'] = $state_vci_certificate;
				
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
				$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
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
		header('Content-Type: application/json');
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
		    	'upload_path'   => '/var/www/html/harpahu_merge_dev/uploads/cropper_images/',
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
		            'upload_path'  => '/var/www/html/harpahu_merge_dev/uploads/cropper_images/',
		            'source_image' => $upload_data['full_path'], 
		            'new_image'    => '/var/www/html/harpahu_merge_dev/uploads/'.$path.'/'.$upload_data['file_name'],
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
		            // if got fail.file_name
		            $error['resize'] = $this->image_lib->display_errors();	
		            echo json_encode($error);
					exit;						
		        }else{
					//print_r($upload_data);
		            $data_to_store['ProfilePic'] = $upload_data['file_name'];						
					$data1['ProfilePic'] = $upload_data[''];
					$data['success'] =  TRUE;
					$data['data'][] = $upload_data['raw_name']."_thumb".$upload_data['file_ext'];		        }
		    }
		}
		echo json_encode($data);
		exit;
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
        	$upload_path = '/var/www/html/harpahu_merge_dev/uploads/'.$path.'/';
            $config['upload_path'] = $upload_path;
            //allowed file types. * means all types
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
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
		$state_id = $this->input->get_post('zone_id');
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
		$type = $this->input->get_post('type');
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
																if($type == '3'){
																	$config['upload_path'] = '/var/www/html/uploads_new/profile/thumb/';
																}else{
																	$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
																}
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
		$data['district_code'] = $this->input->get_post('district_id');
		$data['district'] = $this->input->get_post('district');
		$data['state_code'] = $this->input->get_post('state_id');
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
		// else if($adhaarcheck) {
		// 		$json_data['success'] = false;
		// 		$json_data['error'] = "Adhaar already associated with another account.";
		// }
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
	public function pushcalllog(){
		$call_date = $this->input->get_post('call_date');
		$call_time = $this->input->get_post('call_time');
		$call_direction = $this->input->get_post('call_direction');
		$customer_number = $this->input->get_post('customer_number');
		$doc_number = substr($customer_number,3);
		$doctor = $this->api_model->get_doctor_id($doc_number);
		$doctor_id = $doctor[0]['doctor_id'];

		$call_duration = $this->input->get_post('call_duration');
		$conversation_duration = $this->input->get_post('conversation_duration');
		$call_uuid = $this->input->get_post('call_uuid');
		$call_status = $this->input->get_post('call_status');
		$agent_number = $this->input->get_post('agent_number');

		$user_number = substr($agent_number,3);
		$users = $this->api_model->get_users_id($user_number);
		$users_id = $users[0]['users_id'];

        $user_type_agent = $this->input->get_post('user_type_agent');
        $user_id_agent = $this->input->get_post('user_id_agent');
        $user_type_customer = $this->input->get_post('user_type_customer');
        $user_id_customer = $this->input->get_post('user_id_customer');


		$called_number = $this->input->get_post('called_number');
		$call_transfer_duration = $this->input->get_post('call_transfer_duration');
		$call_transfer_status = $this->input->get_post('call_transfer_status');
		$agent_list = $this->input->get_post('agent_list');

			$dem['call_date'] = $call_date;
			$dem['call_time'] = $call_time;
			$dem['call_direction'] = $call_direction;
			$dem['customer_number'] = $customer_number;
			$dem['call_duration'] = $call_duration;
			$dem['conversation_duration'] = $conversation_duration;
			$dem['call_uuid'] = $call_uuid;
			$dem['call_status'] = $call_status;
			$dem['agent_number'] = $agent_number;
			$dem['user_type_agent'] = $user_type_agent;
			$dem['user_id_agent'] = $user_id_agent;
			$dem['user_type_customer'] = $user_type_customer;
			$dem['user_id_customer'] = $user_id_customer;
			$dem['doctor_id'] = $doctor_id;
			$dem['users_id'] = $users_id;
			$dem['type'] = '30';
			$json['success'] = True;
			$json['data'] = $dem;
		$this->api_model->submit('doctor_call_inisite', $dem);
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function update_chat_status(){
		$doctor_id = $this->input->get_post('doctor_id');
		$users_id = $this->input->get_post('users_id');
		$chat_status =  $this->input->get_post('chatstatus');
		$data['chat_status'] = $chat_status;
		if ($chat_status == '1') {
				$dat['status'] = "Now User can initiate a chat with you.";
		}else{
				$dat['status'] = "Chat is disabled for this User.";
		}		
		$detail = $this->api_model->get_data_update('users_id = "'.$users_id.'" AND doctor_id = "'.$doctor_id.'"', 'doctor_call_inisite', $data);
		if($detail){
			$json['success'] = true;
			$json['msg'] = $dat['status'];
		}else{
			$json['success'] = false;
			$json['error'] = "Database error.";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_chat_status(){
		$doctor_id = $this->input->get_post('doctor_id');
		$users_id = $this->input->get_post('users_id');
		$chat_status =  $this->input->get_post('chatstatus');
		$detail = $this->api_model->get_chat_status($doctor_id,$users_id);
		$de['chat_status'] = $detail[0]['chat_status'];
		if(empty($detail)){
				$json['success'] = false;
				$json['error'] = 'Chat is not enabled for this user.';
			}else{
				$json['success'] = true;
				$json['msg'] = $detail[0]['chat_status'];
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function chat_push_non($user_id,$doctor_id, $type , $title, $flag = 0, $server_key = 0, $key=0, $msg, $fcm_and= '', $fcm_ios = ''){
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
	public function chat(){
		$data['sender_id'] = $this->input->get_post('sender_id'); 
		$data['reciver_id'] = $this->input->get_post('reciver_id');
		$data['sender_type'] = $this->input->get_post('sender_type');
		$data['reciver_type'] = $this->input->get_post('reciver_type');
		$data['message'] = $this->input->get_post('message');
		$data['message_type'] = $this->input->get_post('message_type');
		$data['date'] = date('Y-m-d');
		$data['time'] = date('H:i:s');	
		if($data['sender_type'] == '1' && $data['reciver_type']=='0'){
				if($data['sender_type'] == '1'){
					$doctor_id = $data['sender_id'];
					$user_id = $data['reciver_id'];
				}if($data['reciver_type'] == '1'){
					$doctor_id = $data['reciver_id'];
					$user_id = $data['sender_id'];
				}
				$dat = $this->api_model->get_data('doctor_id = "'.$doctor_id.'"' , 'doctor', '', 'username,doctor_id');
				$title = $dat[0]['username'];
				if($data['message_type'] == 'text'){
					$message = $data['message'];
				}else{
					$message = 'Attachment';
				}
				$msg1 = $message;
				$flag ='2';
				$msg['users_id'] = $doctor_id;
				$msg['title'] = $title;
				$msg['message'] = $msg1;
				$msg['date'] = date('Y-m-d h:i:s');
				$msg['type'] = '2';
				$msg['isactive'] = '1';
				$msg['flag'] = '2';
				$msg['doctor_id'] = $dat[0]['doctor_id'];
				// print_r($msg);
				// exit;
				$this->api_model->user_notification($msg);
				$this->chat_push_non($user_id,$doctor_id,  0, $title , $flag, LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg1);
				//$this->push_non($data['sender_id'],  1, $title , $flag, PARAVATE_SERVERKEY, PARAVATE_SERVERKEY, $msg1);
			}else if($data['sender_type'] == '1' && $data['reciver_type']=='1'){
				if($data['sender_type'] == '1'){
					$doctor_id = $data['sender_id'];
					$user_id = $data['reciver_id'];
				}if($data['reciver_type'] == '1'){
					$doctor_id = $data['reciver_id'];
					$user_id = $data['sender_id'];
				}
				$dat = $this->api_model->get_data('doctor_id = "'.$doctor_id.'"' , 'doctor', '', 'username,doctor_id');
				$title = $dat[0]['username'];
				if($data['message_type'] == 'text'){
					$message = $data['message'];
				}else{
					$message = 'Attachment';
				}
				$msg1 = $message;
				$flag ='2';
				$msg['users_id'] = $doctor_id;
				$msg['title'] = $title;
				$msg['message'] = $msg1;
				$msg['date'] = date('Y-m-d h:i:s');
				$msg['type'] = '2';
				$msg['isactive'] = '1';
				$msg['flag'] = '2';
				$msg['doctor_id'] = $dat[0]['doctor_id'];
				// print_r($msg);
				// exit;
				$this->api_model->user_notification($msg);
				$this->chat_push_non($user_id,$doctor_id,  1, $title , $flag, PARAVATE_SERVERKEY, PARAVATE_SERVERKEY, $msg1);
			}else{
				if($data['sender_type'] == '0'){
					$user_id = $data['sender_id'];
					$doctor_id = $data['reciver_id'];
				}if($data['reciver_type'] == '0'){
					$user_id = $data['reciver_id'];
					$doctor_id = $data['sender_id'];
				}
				$dat = $this->api_model->get_data('users_id = "'.$user_id.'"' , 'users', '', 'full_name,users_id');
				//print_r($dat);
				$title = $dat[0]['full_name'];
				if($data['message_type'] == 'text'){
					$message = $data['message'];
				}else{
					$message = 'Attachment';
				}
				$msg1 = $message;
				$flag = '2';
				$msg['users_id'] = $user_id;
				$msg['title'] = $title;
				$msg['message'] = $msg1;
				$msg['date'] = date('Y-m-d h:i:s');
				$msg['type'] = '2';
				$msg['isactive'] = '1';
				$msg['flag'] = '2';
				$this->api_model->user_notification($msg);
				$old_msg['to_users_id'] = $user_id;
				$old_msg['to_id'] = $user_id;
				$old_msg['to_type'] = 'users';
				$old_msg['title'] = $title;
				$old_msg['from_type'] = 'Livestoc Team';
				$old_msg['success'] = '1';
				$old_msg['device'] = 'android';
				$old_msg['active'] = '1'; 
				$old_msg['description'] = $msg1;
				$old_msg['date_added'] = date('Y-m-d h:i:s');
				  // print_r($dat);
				  // print_r($old_msg);
				  // print_r($data['sender_id']);
				  // exit;
				$this->api_model->old_notification($old_msg);
				$this->chat_push_non($user_id,$doctor_id,  1, $title , $flag, PARAVATE_SERVERKEY, PARAVATE_SERVERKEY, $msg1);
				//$this->chat_push_non($users_id,  0, $title , $flag, LIVESTOCK_AND_SERVERKEY, LIVESTOCK_IOS_SERVERKEY, $msg1);
			}
		if($id = $this->api_model->submit('chat',$data)){
				$da = $this->api_model->query_build("select IF(sender_id = '".$data['sender_id']."', '1', '0') as status, sender_id, reciver_id, sender_type, reciver_type, message_type, date, time, if(message_type != 'text', CONCAT('".base_url()."uploads/chats/', message),message) as message from chat as ch where id = '".$id."' AND ((reciver_id = '".$data['sender_id']."' AND reciver_type = '".$data['sender_type']."') OR (sender_id = '".$data['sender_id']."' AND sender_type = '".$data['sender_type']."') AND (reciver_id = '".$data['reciver_id']."' AND reciver_type = '".$data['reciver_type']."') OR (sender_id = '".$data['reciver_id']."' AND sender_type = '".$data['reciver_type']."'))");
				$json['success']  = true; 
				$json['data'] =$da;
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_chat(){
		$data['sender_id'] = $this->input->get_post('sender_id'); 
		$data['reciver_id'] = $this->input->get_post('reciver_id');
		$data['sender_type'] = $this->input->get_post('sender_type');
		$data['reciver_type'] = $this->input->get_post('reciver_type');
		$data['message'] = $this->input->get_post('message');
		$data['message_type'] = $this->input->get_post('message_type');
		$start = $this->input->get_post('start');
		$limit = $this->input->get_post('limit');
		$id = $this->input->get_post('id');
		$data['date'] = date('Y-m-d');
		$data['time'] = date('H:i:s');
		$chat_count = $this->api_model->query_build("select count(id) as count from chat as ch where ((reciver_id = '".$data['sender_id']."' AND reciver_type = '".$data['sender_type']."') OR (sender_id = '".$data['sender_id']."' AND sender_type = '".$data['sender_type']."')) AND ((reciver_id = '".$data['reciver_id']."' AND reciver_type = '".$data['reciver_type']."') OR (sender_id = '".$data['reciver_id']."' AND sender_type = '".$data['reciver_type']."'))");
		if($da = $this->api_model->query_build("select IF(sender_id = '".$data['sender_id']."', '1', '0') as status, sender_id,id, reciver_id, sender_type, reciver_type, message_type, date, time, if(message_type != 'text', CONCAT('".base_url()."uploads/chats/', message),message) as message from chat as ch where ((reciver_id = '".$data['sender_id']."' AND reciver_type = '".$data['sender_type']."') OR (sender_id = '".$data['sender_id']."' AND sender_type = '".$data['sender_type']."')) AND ((reciver_id = '".$data['reciver_id']."' AND reciver_type = '".$data['reciver_type']."') OR (sender_id = '".$data['reciver_id']."' AND sender_type = '".$data['reciver_type']."'))ORDER BY id DESC LIMIT ".$start.",".$limit." ")){
				$json['success']  = true; 
				$json['data'] =$da;
				$json['count'] = $chat_count[0]['count'];
			}else{
				$json['success']  = false; 
				$json['error'] = 'Database Error';
			}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	// public function vt_semen_strow_deactive(){
	// 	$stock_id = $this->input->get_post('stock_id');
	// 	$admin_id = $this->input->get_post('doctor_id');
	// 	$data['rest_stock'] = '0';
	// 	if($this->api_model->get_data_update('stock_id = "'.$stock_id.'" AND admin_id = "'.$admin_id.'"', 'seman_stock', $data)){
	// 		$json['success']  = true; 
	// 		$json['msg'] = "Successfully Deleted";
	// 	}
	// 	header('Content-Type: application/json');
	// 	echo json_encode($json);
	// 	exit;
	// }
	public function vt_semen_strow_deactive(){
		$stock_id = $this->input->get_post('stock_id');
		$admin_id = $this->input->get_post('doctor_id');		
		$data['rest_stock'] = '0';
		if(!isset($stock_id) || $stock_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please send stock Id";
		}else if(!isset($admin_id) || $admin_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please send user doctor Id";
		}else{
			if($this->api_model->get_data_update('id = "'.$stock_id.'" AND admin_id = "'.$admin_id.'"', 'seman_stock', $data)){
				$json['success']  = true; 
				$json['msg'] = "Successfully Deleted";
			}else{
				$json['success']  = false; 
				$json['msg'] = "Something Went Wrong.";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_language(){
			$data = $this->api_model->get_languge();			
			if($data){
				$json['success']  = true; 
				$json['msg'] = $data;
			}else{
				$json['success']  = false; 
				$json['msg'] = "Something Went Wrong.";
			}		
		
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function  get_video_category(){
		$category = $this->input->get_post('category');
		$category = json_decode($category);
		 $video_cat = $this->api_model->get_video_category($category);
		 print_r($video_cat);
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
	public function get_near_by_ai_worker(){
		$lat = $this->input->get_post('latitude');
		$lang = $this->input->get_post('langitute');
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
		$data = $this->api_model->query_build("select do.ai_visiting_fee,do.refral_code,do.city,do.state,do.doctor_id, do.username,do.email, do.total_experience, do.image, if((select id from vt_requests where vt_id = do.doctor_id AND treat_type = '3' AND status = '4') IS NOT NULL, 1,0) as status, (IFNULL(( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('".$lang."') ) + sin( radians('".$lat."') ) * sin( radians( cl.lantitute ) ) ) ),0)) AS distance from current_loc as cl, doctor as do where do.doctor_id = cl.doctor_id AND do.users_type IN ('pvt_ai', 'pvt_vt')  AND do.isactivated = '1' ".$where."  ORDER BY ".$order_by." LIMIT ".$start.", ".$perpage."");
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
	public function web_upload_videos()
  	{
		$path = $this->input->get_post('path');
		// print_r($_REQUEST);
		// print_r($_FILES);
		if (!empty($_FILES['image']['name'])) {
			$config = array();
				$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
				$config['allowed_types'] = 'mp4|mov|wmv|flv|avi|mkv';
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
		}else if (!empty($_FILES['video']['name'])) {
			$config = array();
				$config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/'.$path;
				$config['allowed_types'] = 'mp4|mov|wmv|flv|avi|mkv';
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
		}else{
			$data['success'] =  False;
			$data['error'] = $this->upload->display_errors(); 
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
	
}
