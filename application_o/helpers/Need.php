<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Need_helper{
    function email($message = '',$to_email ='',$subject ='')
    {
        echo "this";
        exit;
        $this->email->from(CO_EMAIL, 'Livestoc');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);   
        return $this->email->send();
    } 
    function msg($mobile, $sms_template, $vars = array()){
            $sms_template = urlencode($sms_template);
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
            //print_r($response);
            //exit;
            if ($err) {
            return "cURL Error #:" . $err;
            } else {
             return $response;
            }
    }  
}
    
