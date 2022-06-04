<?php
class Retailer_pack extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
    }
    public function index(){
        $admin_id = $this->input->get_post('admin_id');
        $select = '';
        if($admin_id != ''){
            $select  = ' , (select if((select super_admin_id from admin where admin_id = a.super_admin_id) = 0, a.super_admin_id, (select super_admin_id from admin where admin_id = a.super_admin_id)) as super_admin_id from admin as a where admin_id = '.$admin_id.') as super_admin_id';
        }
        $data = $this->api_model->get_data('isactive = "1"','retialer_pack','','id, name, credit_value, discription, price, cast((price - (price * (retailer_discount/100))) as decimal(10,2)) as retailer_offer_price, cast((price * (distributor_discount/100)) as decimal(10,2)) as distributor_commision '.$select.'');
        $json['success']  = true; 
        $json['data'] = $data;
        header('Content-Type: application/json');
		echo json_encode($json);
		exit;
    }
}