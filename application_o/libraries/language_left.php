<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Language_left{
	private $_CI;
    public function __construct()
    {
        $this->_CI = & get_instance();	
    }
	public function get_language($code){
		$this->_CI->load->model('api_model', 'am', TRUE);
		$language = $this->_CI->am->get_data('code = "'.$code.'"', 'language');
		$key = $this->_CI->am->get_data('language_id = "'.$language[0]['id'].'"','language_library','','key');
		$value = $this->_CI->am->get_data('language_id = "'.$language[0]['id'].'"','language_library','','description');
		// echo "<pre>";
		// print_r($value);
		$i= 0;
		foreach($key as $k){
		  $detail[$k['key']] = $value[$i]['description'];
		  $i++;
		}
		return $detail;
	}
}
