<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller {
    public function test_push(){
        $fcm = $this->input->get_post('fcm');
        $key = $this->input->get_post('key');
		$msg['message'] = "your vactination is done";
		$msg['title'] = "Treatment /Vaccination";
		$this->push_non('2739', 1 , $fcm, $key, $msg['title'], $flag=1, $msg['message'], $msg['title']);
		//$de = $this->push_non('2739', '1');
	}
  public function index(){
    echo "this is test";
  }
	public function test(){

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
      CURLOPT_POSTFIELDS => array('k_number' => '+916366783212','caller_id' => '+918047248869','agent_number' => '+919918990731','customer_number' => '+917986060078','timer' => '00:10:02','user_type_agent' => '9811086604','user_id_agent' => '7986060078','user_type_customer' => '9840481462','user_id_customer' => '9840481462'),
      CURLOPT_HTTPHEADER => array(
        "authorization: 95d4c58b-80a1-4e75-bf78-5970a52d0c11",
        "x-api-key: nDRUngYws3739teklCMYp9IufbQ8qjf212iyMkiG"
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    }
}
