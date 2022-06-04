<?php
class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		//$this->load->model('serviceboy');
		//$this->load->model('request_hospital');
		//$this->load->model('hospital');
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
	}
	public function chat(){
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/chat');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function retailer_sub_retailer($id){
		$data['id'] =$id;
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/retailer_sub_retailer', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function section_prop_edit($id){
		if($_REQUEST['submit']){
			$data['section_id'] = $this->input->get_post('section');
			$data['name'] = $this->input->get_post('prop');
			$data['price'] = $this->input->get_post('price');
			$data['retailer_price'] = $this->input->get_post('ret_price');
			$this->form_validation->set_rules('ret_price','Please Enter Retailer Price','required|trim');
			$this->form_validation->set_rules('section','Please Select Section','required');
			$this->form_validation->set_rules('prop','Please Enter Properties','required|trim');
			$this->form_validation->set_rules('price','Please Enter Price','required|trim');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('id', $id, 'section_property', $data)){
					$this->session->set_flashdata('add_bank','Your Properties is Updated.');
					redirect(base_url().'admin/section_prop');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$data['data'] = $this->api_model->get_data('id = '.$id.'', 'section_property');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/section_prop_edit', $data);
					$this->load->view('admin/layouts/admin_footer');
					}
			}else{
				$data['data'] = $this->api_model->get_data('id = '.$id.'', 'section_property');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/section_prop_edit', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = '.$id.'', 'section_property');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/section_prop_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function section_prop_add(){
		if($_REQUEST['submit']){
			$data['section_id'] = $this->input->get_post('section');
			$data['name'] = $this->input->get_post('prop');
			$data['price'] = $this->input->get_post('price');
			$data['retailer_price'] = $this->input->get_post('ret_price');
			$this->form_validation->set_rules('section','Please Select Section','required');
			$this->form_validation->set_rules('prop','Please Enter Properties','required|trim');
			$this->form_validation->set_rules('price','Please Enter Price','required|trim');
			$this->form_validation->set_rules('ret_price','Please Enter Retailer Price','required|trim');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('section_property', $data)){
					$this->session->set_flashdata('add_bank','Your Properties is Added.');
					redirect(base_url().'admin/section_prop');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/section_prop_add');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/section_prop_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/section_prop_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function section_prop(){
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/section_prop');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function section_prop_status(){
		$admin_id = $this->input->get_post('admin_id');
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		if($this->api_model->section_prop_status($id, $status))
		{
			$detail = $this->api_model->section_prop_search($name, $start, $perpage);
			$detail['count'] = $this->api_model->section_prop_search_count($name);
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
	}
	public function section_prop_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->section_prop_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->section_prop_search_count($name);
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
	public function retailer_sub_retailer_status()
	{
		$admin_id =  $this->input->get_post('admin_id');
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		if($this->api_model->sys_user_status($id, $status))
		{
			$product_data = $this->api_model->retailer_sub_retailer_search($name, $start,$perpage, $admin_id);
			$detail['count'] = $this->api_model->retailer_sub_retailer_count($name, $admin_id);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function retailer_sub_retailer_search(){
		$admin_id =  $this->input->get_post('admin_id');
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->retailer_sub_retailer_search($name, $start, $perpage, $admin_id);
		$detail['count'] = $this->api_model->retailer_sub_retailer_count($name, $admin_id);
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
	public function retailer_sub_distributor($id){
		$data['id'] =$id;
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/retailer_sub_distributor', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function retailer_sub_distributor_status()
	{
		$admin_id = $this->input->get_post('admin_id');
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		if($this->api_model->sys_user_status($id, $status))
		{
			$product_data = $this->api_model->retailer_sub_distributor_search($name, $start,$perpage, $admin_id);
			$detail['count'] = $this->api_model->retailer_sub_distributor_count($name, $admin_id);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function retailer_sub_distributor_search($id){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->retailer_sub_distributor_search($name, $start, $perpage, $id);
		$detail['count'] = $this->api_model->retailer_sub_distributor_count($name, $id);
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
	public function retailer_distributor(){
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/retailer_distributor');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function retailer_distributor_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		if($this->api_model->sys_user_status($id, $status))
		{
			$product_data = $this->api_model->retailer_distributor_search($name, $start,$perpage);
			$detail['count'] = $this->api_model->retailer_distributor_count($name);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function retailer_distributor_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->retailer_distributor_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->retailer_distributor_count($name);
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
	public function retailer_package_add(){
		if(isset($_POST['submit'])){
			$data['package_name'] = $this->input->get_post('name');
			$data['mrp'] = $this->input->get_post('mrp');
			$data['sale_price'] = $this->input->get_post('sale');
			$data['retailer_qty'] = $this->input->get_post('qty');
			$data['decription'] = $this->input->get_post('description');
		    $this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('mrp','Please Enter MRP','required|trim');
			$this->form_validation->set_rules('sale','Please Enter Sale Price','required|trim');
			$this->form_validation->set_rules('qty','Please Enter Qty','required|trim');
			$this->form_validation->set_rules('description','Please Enter Description','required|trim');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('admin_package', $data)){
					$this->session->set_flashdata('add_bank','Your Package is Added.');
					redirect('admin/retailer_package');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/retailer_package_add');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->session->set_flashdata('add_bank','Database Error.');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/retailer_package_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/retailer_package_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function retailer_package(){
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/retailer_package');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function retailer_package_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		if($this->api_model->retailer_package_status($id, $status))
		{
			$product_data = $this->api_model->retailer_package_search($name, $start,$perpage);
			$detail['count'] = $this->api_model->retailer_package_count($name);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function retailer_package_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->retailer_package_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->retailer_package_count($name);
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
	public function ecom_offer(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/ecom_offer');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function v_type(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/v_type');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function offline_delivery_partner_transaction(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/offline_delivery_partner_transaction');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function edit_v_type($id){
		if($_POST['submit']){
			$data['vehicals_name'] = $this->input->get_post('name');
			$data['image'] = $this->input->get_post('pro_image');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('pro_image','Please Upload Image','required|trim');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('id',$id,'vehicals_type', $data)){
					$this->session->set_flashdata('add_bank','Your data is Added.');
					redirect('admin/v_type');
				}else{
						$this->session->set_flashdata('add_bank','Database Error.');
						$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'vehicals_type');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/edit_v_type', $data);
						$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'vehicals_type');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/edit_v_type', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'vehicals_type');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/edit_v_type', $data);
			$this->load->view('admin/layouts/admin_footer');
		}		
	}
	public function v_type_add(){
		if($_POST['submit']){
			$data['vehicals_name'] = $this->input->get_post('name');
			$data['image'] = $this->input->get_post('pro_image');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('pro_image','Please Upload Image','required|trim');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('vehicals_type', $data)){
					$this->session->set_flashdata('add_bank','Your data is Added.');
					redirect('admin/v_type');
				}else{
						$this->session->set_flashdata('add_bank','Database Error.');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/v_type_add');
						$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/v_type_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/v_type_add');
			$this->load->view('admin/layouts/admin_footer');
		}		
	}
	public function v_type_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->v_type_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_v_type_count($name);
		if($detail){
			$json_data = $detail;
		}
		else{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
	}
	public function v_type_status(){
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_activated'] = $status;
		if($this->api_model->update('id',$id,'vehicals_type', $data))
		{
			$product_data = $this->api_model->v_type_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_v_type_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function hub_employee(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/hub_employee');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function hub_employee_edit($id){
		if(isset($_POST['submit'])){
			$data['super_admin_id'] =  $this->input->get_post('hub');
			$data['type'] =  "31";
			$password = $this->input->get_post('password');
			if($password == ''){
				$data['password'] = md5($this->input->get_post('password'));
			}
			$data['fname'] = $this->input->get_post('name');
			$data['mobile'] = $this->input->get_post('mobile');
			$data['address'] = $this->input->get_post('address');
			$data['email'] = $this->input->get_post('email');
			$this->form_validation->set_rules('hub','Please Select Hub', 'required');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('mobile','Please Enter Mobile','required|trim');
			$this->form_validation->set_rules('address','Please Enter Address','required|trim');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('admin_id',$id,'admin', $data)){
					$this->session->set_flashdata('add_bank','Your data is Updated.');	
					redirect('admin/hub_employee');
				}else{
						$this->session->set_flashdata('add_bank','Database Error.');
						$data['data'] = $this->api_model->get_data('admin_id = "'.$id.'"', 'admin');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/hub_employee_edit', $data);
						$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('admin_id = "'.$id.'"', 'admin');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/hub_employee_edit', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('admin_id = "'.$id.'"', 'admin');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/hub_employee_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function order_insentive_pay(){
		$id = $this->input->get_post('id');
		$id = explode(',', $id);
		$delivery_id = $this->input->get_post('delivery_id');
		$transaction_id = $this->input->get_post('transaction_id');
		$ad = $this->api_model->get_data('admin_id = '.$delivery_id.'', 'admin');
		$tot = $this->api_model->query_build("select sum(if((distance_covered * ".$ad[0]['per_km'].") IS NOT NULL, (distance_covered * ".$ad[0]['per_km']."), 0)) as total from product_order where isactive = '5' AND delivery_partner_payment_status = '0' AND delivery_partner = ".$delivery_id." ");
		$log['type'] = '14';
		$log['payment_type'] = 'Cr';
		$log['users_id'] = $delivery_id;
		$log['currency'] = 'INR';
		$log['status'] = '1';
		$log['amount'] = $tot[0]['total'];
		$log['user_type'] = '3';
		$log['transaction_id'] = $transaction_id;
		$log['date'] = date('Y-m-d h:i:s');
		$log['method'] = 'Bank';
		$log_id = $this->api_model->submit('log_file', $log);
		foreach($id as $d){
			if($data = $this->api_model->get_data('id = '.$d.' AND isactive = "5" AND delivery_partner_insentive_payment_status = "0"', 'product_order')){
				$dat['delivery_partner_insentive_payment_status'] = '1';
				$this->api_model->update('id', $d, 'product_order', $dat);
				$acc['admin_id'] = $delivery_id;
				$acc['order_id'] = $d;
				$acc['log_id'] = $log_id;
				$acc['transaction_id'] = $transaction_id;
				$acc['payment_type'] = 'Cr';
				$acc['type'] = '1';
				$acc['amount'] = $ad[0]['insentive'];
				$acc['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('delivery_partner_account', $acc);
			}
		}
		echo true;
	}
	public function order_pay(){
		$id = $this->input->get_post('id');
		$id = explode(',', $id);
		$delivery_id = $this->input->get_post('delivery_id');
		$transaction_id = $this->input->get_post('transaction_id');
		$ad = $this->api_model->get_data('admin_id = '.$delivery_id.'', 'admin');
		$tot = $this->api_model->query_build("select sum(if((distance_covered * ".$ad[0]['per_km'].") IS NOT NULL, (distance_covered * ".$ad[0]['per_km']."), 0)) as total from product_order where isactive = '5' AND delivery_partner_payment_status = '0' AND delivery_partner = ".$delivery_id." ");
		$log['type'] = '14';
		$log['payment_type'] = 'Cr';
		$log['users_id'] = $delivery_id;
		$log['currency'] = 'INR';
		$log['status'] = '1';
		$log['amount'] = $tot[0]['total'];
		$log['user_type'] = '3';
		$log['transaction_id'] = $transaction_id;
		$log['date'] = date('Y-m-d h:i:s');
		$log['method'] = 'Bank';
		$log_id = $this->api_model->submit('log_file', $log);
		foreach($id as $d){
			if($data = $this->api_model->get_data('id = '.$d.' AND isactive = "5" AND delivery_partner_payment_status = "0"', 'product_order')){
				$dat['delivery_partner_payment_status'] = '1';
				$this->api_model->update('id', $d, 'product_order', $dat);
				$acc['admin_id'] = $delivery_id;
				$acc['order_id'] = $d;
				$acc['log_id'] = $log_id;
				$acc['transaction_id'] = $transaction_id;
				$acc['payment_type'] = 'Cr';
				$acc['amount'] = $data[0]['distance_covered'] * $ad[0]['per_km'];
				$acc['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('delivery_partner_account', $acc);
			}
		}
		echo true;
	}
	public function hub_employee_add(){
		if(isset($_POST['submit'])){
			$data['super_admin_id'] =  $this->input->get_post('hub');
			$data['type'] =  "31";
			$data['password'] = md5($this->input->get_post('password'));
			$data['fname'] = $this->input->get_post('name');
			$data['mobile'] = $this->input->get_post('mobile');
			$data['email'] = $this->input->get_post('email');
			$data['address'] = $this->input->get_post('address');
			$this->form_validation->set_rules('hub','Please Select Hub', 'required');
			$this->form_validation->set_rules('email','Please Select email', 'required');
			$this->form_validation->set_rules('password','Please Enter Password','required|trim');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('mobile','Please Enter Mobile','required|trim');
			$this->form_validation->set_rules('address','Please Enter Address','required|trim');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('admin', $data)){
					$this->session->set_flashdata('add_bank','Your data is Added.');
					redirect('admin/hub_employee');
				}else{
						$this->session->set_flashdata('add_bank','Database Error.');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/hub_employee_add');
						$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/hub_employee_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/hub_employee_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function hub_employee_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->hub_employee_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->hub_employee_count($name);
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
	public function hub_employee_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->update('id',$id,'admin', $data))
		{
			$product_data = $this->api_model->hub_employee_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->hub_employee_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function ecom_hub(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/ecom_hub');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function hub_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->hub_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->hub_count($name);
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
	public function hub_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->update('id',$id,'admin', $data))
		{
			$product_data = $this->api_model->hub_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->hub_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function hub_add(){
		if(isset($_POST['submit'])){
			$data['name'] = $this->input->get_post('name');
			$this->form_validation->set_rules('name','Please Enter Name','required');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('hub', $data)){
					$this->session->set_flashdata('add_bank','Your data is Added.');
					redirect('admin/ecom_hub');
				}else{
						$this->session->set_flashdata('add_bank','Database Error.');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/hub_add');
						$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/hub_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/hub_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function hub_edit($id){
		if(isset($_POST['submit'])){
			$data['name'] = $this->input->get_post('name');
			$this->form_validation->set_rules('name','Please Enter Name','required');
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('id',$id,'hub', $data)){
					$this->session->set_flashdata('add_bank','Your data is Updated.');
					redirect('admin/ecom_hub');
				}else{
						$this->session->set_flashdata('add_bank','Database Error.');
						$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'hub');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/hub_edit', $data);
						$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'hub');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/hub_edit', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'hub');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/hub_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function ecom_offer_edit($id){
		if(isset($_POST['submit'])){
			$data['product_id'] = $this->input->get_post('product');
			$data['discount_wallet'] = $this->input->get_post('rate');
			$data['product_pack'] = $this->input->get_post('product_pack');
			$this->form_validation->set_rules('product','Please Select Product','required');
			$this->form_validation->set_rules('rate','Please Discount Rate','required|trim');
			$this->form_validation->set_rules('product_pack','Please Product Pack','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('id',$id,'product_offer', $data)){
					$this->session->set_flashdata('add_bank','Your data is Updated.');
					redirect('admin/ecom_offer');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/ecom_offer_add');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/ecom_offer_add');
					$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'product_offer');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/ecom_offer_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function ecom_offer_add(){
		if(isset($_POST['submit'])){
			$data['product_id'] = $this->input->get_post('product');
			$data['discount_wallet'] = $this->input->get_post('rate');
			$data['product_pack'] = $this->input->get_post('product_pack');
			$this->form_validation->set_rules('product','Please Select Product','required');
			$this->form_validation->set_rules('rate','Please Discount Rate','required|trim');
			$this->form_validation->set_rules('product_pack','Please Product Pack','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('product_offer', $data)){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/ecom_offer');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/ecom_offer_add');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/ecom_offer_add');
					$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/ecom_offer_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function get_product_pack(){
		$id = $this->input->get_post('id');
		$data = $this->api_model->get_data('product_id = "'.$id.'"', 'product_pack_rate', '', 'id, product_id, pack_id, mrp, sale_price, vt_sale_price, (select name from product_package where id = pack_id) as pack_name');
		// foreach($data as $da){
		// 	$pri .= "<option value='".$da['id']."'>".$da['pack_name']."</option>";
		// }
		echo json_encode($data);
	}
	public function product_offer_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->product_offer_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->product_offer_count($name);
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
	public function product_offer_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->update('id',$id,'product_offer', $data))
		{
			$product_data = $this->api_model->product_offer_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->product_offer_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function dewarming(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/dewarming');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function dewarming_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->dewarming_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->dewarming_count($name);
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
	public function dewarming_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->update('id',$id,'medicine', $data))
		{
			$product_data = $this->api_model->dewarming_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->dewarming_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function send_mail(){
		$this->load->library('email');   
		$config = array();
		$config['protocol']     = "sendmail"; // you can use 'mail' instead of 'sendmail or smtp'
		$config['smtp_host']    = "ssl://smtp.googlemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
		$config['smtp_user']    = "amazebrandlance@gmail.com"; // client email gmail id
		$config['smtp_pass']    = "TejinderKaushal@@@2309"; // client password
		$config['smtp_port']    =  465;
		$config['smtp_crypto']  = 'ssl';
		$config['smtp_timeout'] = "";
		$config['mailtype']     = "html";
		$config['charset']      = "iso-8859-1";
		$config['newline']      = "\r\n";
		$config['wordwrap']     = TRUE;
		$config['validate']     = FALSE;
		$this->load->library('email', $config); // intializing email library, whitch is defiend in system
	
		$this->email->set_newline("\r\n"); // comuplsory line attechment because codeIgniter interacts with the SMTP server with regards to line break
	
		// $from_email = $this->input->post('f_email'); // sender email, coming from my view page 
		// $to_email = $this->input->post('email'); // reciever email, coming from my view page
		//Load email library
	
		$this->email->from('info@livestoc.com', 'LiveStoc');
		$this->email->to('shahiakhilesh75@gmail.com');
		$this->email->subject('Send Email Codeigniter'); 
		$this->email->message('The email send using codeigniter library');  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
		//Send mail
		if($this->email->send()){
			$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
			echo "email_sent";
		}
		else{
			echo "email_not_sent";
			echo $this->email->print_debugger();  // If any error come, its run
		}
		// //$this->load->library('email');
		// $config['protocol']    = 'smtp';
		// $config['smtp_host']    = 'ssl://smtp.gmail.com';
		// $config['smtp_port']    = '587';
		// $config['smtp_timeout'] = '7';
		// $config['smtp_user']    = 'amazebrandlance@gmail.com';
		// $config['smtp_pass']    = 'TejinderKaushal@@@2309';
		// $config['charset']    = 'utf-8';
		// $config['newline']    = "\r\n";
		// $config['mailtype'] = 'text'; // or html
		// $config['validation'] = TRUE; // bool whether to validate email or not      
		// $this->load->library('email', $config);
		// $this->email->from('info@livestoc.com', 'LiveStoc');
		// $this->email->to('shahiakhilesh75@gmail.com'); 
		// $this->email->subject('Email Test');
		// $this->email->message('Testing the email class.');  
		// $this->email->send();
		// echo $this->email->print_debugger();
	}
	public function medicine(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/medicine');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function medicine_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->medicine_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->medicine_count($name);
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
	public function medicine_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->update('id',$id,'medicine', $data))
		{
			$product_data = $this->api_model->medicine_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->medicine_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function add_medicine(){
		if($_POST['submit']){
			$data['name'] = $this->input->get_post('name');
			$data['composition'] = $this->input->get_post('composition');
			$category = $this->input->get_post('category');
			$data['category'] = implode(',', $category);
			$data['type'] = $this->input->get_post('type');
			$data['unit'] = $this->input->get_post('unit');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('composition','Please Enter Composition','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				if($this->api_model->submit('medicine', $data)){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/medicine');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_medicine');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_medicine');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_medicine');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function edit_medicine($id){
		if($_POST['submit']){
			$data['name'] = $this->input->get_post('name');
			$category = $this->input->get_post('category');
			$data['category'] = implode(',', $category);
			$data['composition'] = $this->input->get_post('composition');
			$data['type'] = $this->input->get_post('type');
			$data['unit'] = $this->input->get_post('unit');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('composition','Please Enter Composition','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				if($this->api_model->update('id',$id,'medicine', $data)){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/medicine');
				}else{
					$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'medicine');
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/edit_medicine', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'medicine');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/edit_medicine', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'medicine');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/edit_medicine', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function add_medicine_type(){
		if($_POST['submit']){
			$data['name'] = $this->input->get_post('name');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				if($this->api_model->submit('medicine_type', $data)){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/medicine_type');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_medicine_type');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_medicine_type');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_medicine_type');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function edit_medicine_type($id){
		if($_POST['submit']){
			$data['name'] = $this->input->get_post('name');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				if($this->api_model->update('id',$id,'medicine_type', $data)){
					$this->session->set_flashdata('add_bank','Your data is Updated.');
					redirect('admin/medicine_type');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'medicine_type');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/edit_medicine_type', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'medicine_type');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/edit_medicine_type', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'medicine_type');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/edit_medicine_type', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function medicine_type(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/medicine_type');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function medicine_type_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->medicine_type_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->medicine_type_count($name);
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
	public function medicine_type_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->update('id',$id,'medicine_type', $data))
		{
			$product_data = $this->api_model->medicine_type_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->medicine_type_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function cron(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/cron');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function edit_cron($id){
		if($_POST['submit']){
			$data['table'] = $this->input->get_post('table');
			$data['function'] = $this->input->get_post('function');
			$data['condition'] = $this->input->get_post('Condition');
			$this->form_validation->set_rules('table','Please Enter Product Table Name','required|trim');
			$this->form_validation->set_rules('function','Please Enter Function Name','required|trim');
			$this->form_validation->set_rules('Condition','Please Enter Condition','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				if($this->api_model->update('id',$id,'cron', $data)){
					$this->session->set_flashdata('add_bank','Your data is Updated.');
					redirect('admin/cron');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'cron');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/edit_cron', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'cron');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/edit_cron', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'cron');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/edit_cron', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function add_cron(){
		if($_POST['submit']){
			$data['table'] = $this->input->get_post('table');
			$data['function'] = $this->input->get_post('function');
			$data['condition'] = $this->input->get_post('Condition');
			$this->form_validation->set_rules('table','Please Enter Product Table Name','required|trim');
			$this->form_validation->set_rules('function','Please Enter Function Name','required|trim');
			$this->form_validation->set_rules('Condition','Please Enter Condition','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				if($this->api_model->submit('cron', $data)){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/cron');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_cron');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_cron');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_cron');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function cron_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->cron_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->cron_count($name);
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
	public function cron_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactivated'] = $status;
		if($this->api_model->update('id',$id,'cron', $data))
		{
			$product_data = $this->api_model->cron_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->cron_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function farmer_cat(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/farmer_cat');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function add_farmers_feed_ingredients(){
		if($_POST['submit']){
			$data['ingredients'] = $this->input->get_post('name');
			$this->form_validation->set_rules('name','Please Enter Product Category Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				$data = $this->api_model->submit('farmers_feed_ingredients', $data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/farmers_feed_ingredients');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_farmers_feed_ingredients', $section);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_farmers_feed_ingredients', $section);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_farmers_feed_ingredients', $section);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function farmers_feed_ingredients(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/farmers_feed_ingredients');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function product_feed_ingredients_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->product_feed_ingredients_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->product_feed_ingredients_count($name);
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
	public function product_feed_ingredients_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->product_farmer_category_status($id, $data))
		{
			$product_data = $this->api_model->product_feed_ingredients_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->product_feed_ingredients_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function farmer_product_cat($cat_id){
		$pro_data = $this->api_model->farmer_product_cat_id($cat_id);
		$i = 0;
		$div .= "<ul class='tree'>";
		foreach($pro_data as $pro){
				if($i == 0){
					$div .= '<li class="tree"><a class="toggle" href="javascript:void(0);" id="'.$pro['id'].'" onclick="node('.$pro['id'].')">'.$pro['cat_name'].'</a>';
					$div .= $this->farmer_product_cat($pro['id']);
					$div .='</li>';
				}else{
					$div .= '<li class="tree"><a class="toggle" href="javascript:void(0);" id="'.$pro['id'].'" onclick="node('.$pro['id'].')">'.$pro['cat_name'].'</a>';
					$div .= $this->farmer_product_cat($pro['id']);
					$div .= '</li>';
				}
			$i++;
		}
		$div .= '</ul>';
		return $div;
	}
	public function farmer_product_category_show(){
		$category = $this->api_model->get_farmer_category_main();
		$div = "<ul class='tree'>";
		foreach($category as $cat){
			$div .= '<li ><a class="toggle" href="javascript:void(0);" id="'.$cat['id'].'" onclick="node('.$cat['id'].')">'.$cat['cat_name'].'</a>';
				$data = $this->farmer_product_cat($cat['id']);
				$div .= $data;
			$div .= '</li>';
		}
		$div .= "</ul>";
		return $div;
	}
	public function farmer_cat_edit($id){
		$section['cat'] = $this->api_model->get_data('id = "'.$id.'"', 'farmer_product_category');
		$section['unit'] = $this->api_model->get_data('isactive = "1"', 'unit');
		$section['category'] = $this->farmer_product_category_show();
		if($_POST['submit']){
			$data['cat_name'] = $this->input->get_post('name');
			//$data['super_cat_id'] = $this->input->get_post('cat');
			$unit = $this->input->get_post('unit');
			$data['unit'] = implode(',', $unit);
			$this->form_validation->set_rules('name','Please Enter Product Category Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				//echo $_SESSION['status'];
				if($_SESSION['status'] == '1'){
					$data['isactive'] = '1';
				}else{
					$data['isactive'] = '0';
				}
				$data = $this->api_model->update('id', $id, 'farmer_product_category', $data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Updated.');
					redirect('admin/farmer_cat');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/farmer_cat_edit', $section);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/farmer_cat_edit', $section);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/farmer_cat_edit', $section);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function event_export(){
		if(isset($_POST['export'])){
			$date_from = $this->input->get_post('date_from');
			$date_to = $this->input->get_post('date_to');
			$this->form_validation->set_rules('date_from','Please Enter Date From','required|trim');
			$this->form_validation->set_rules('date_to','Please Enter Date To','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				//print_r($event_id);
				$event_id = implode(',',$event_id);
				//echo $event_id;
				if($event_id == ''){
					$result = $this->admin_detail->get_event_report();
				}else{
					$result = $this->admin_detail->get_event_report('', 'AND event IN ('.$event_id.')');    
				}
			// echo "<pre>";
			// print_r($result);
				header("Content-type: application/csv");
				header("Content-Disposition: attachment; filename=\"Holidaykraftdata".".csv\"");
				header("Pragma: no-cache");
				header("Expires: 0");
				$handle = fopen('php://output', 'w');
				fputcsv($handle, array('Event Name', 'Name', 'Mobile NO', 'Email ID', 'Company Name','Landline', 'Address', 'City', 'State', 'Country', 'Remark', 'Date', 'Image'));
						$i = 1;
						foreach ($result as $data) {
							$city_id = $data['city'];
						$city = $this->admin_detail->get_city_by_id($data['city']);
						$state = $this->admin_detail->get_state_id_id($data['state']);
						$country = $this->admin_detail->get_country_id($data['country']);
						//echo json_encode($data['state'] = $state[0]['state_name']);
							$image = '';
							if($data["image"] != '')
							$image = base_url('uploads/image/').$data["image"];
							fputcsv($handle, array($data["event_name"], $data["name"], $data['mobile'], $data["email"], $data["company"], $data["landline"],$data['address'], $city[0]['name'],$state[0]['name'], $country[0]['name'],$data["remark"], $data["date"], $image));
							$i++;
						}
							fclose($handle);
						exit;
			}else{
				$this->load->view('admin/layout/header');
				$this->load->view('admin/layout/sidebar');
				$this->load->view('admin/event_export');
				$this->load->view('admin/layout/footer');  
			}
		}else{
				$this->load->view('admin/layout/header');
				$this->load->view('admin/layout/sidebar');
				$this->load->view('admin/event_export');
				$this->load->view('admin/layout/footer');  
		}
 }
 
	public function add_farmer_product_category(){
		$section['unit'] = $this->api_model->get_data('isactive = "1"', 'unit');
		$section['category'] = $this->farmer_product_category_show();
		if($_POST['submit']){
			$data['cat_name'] = $this->input->get_post('name');
			$data['super_cat_id'] = $this->input->get_post('cat');
			$unit = $this->input->get_post('unit');
			$data['unit'] = implode(',', $unit);
			$this->form_validation->set_rules('name','Please Enter Product Category Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				//echo $_SESSION['status'];
				if($_SESSION['status'] == '1'){
					$data['isactive'] = '1';
				}else{
					$data['isactive'] = '0';
				}
				$data = $this->api_model->submit('farmer_product_category', $data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/farmer_cat');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_farmer_product_category', $section);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_farmer_product_category', $section);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_farmer_product_category', $section);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function product_farmer_category_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->product_farmer_category_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->product_farmer_category_count($name);
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
	public function product_farmer_category_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->product_farmer_category_status($id, $data))
		{
			$product_data = $this->api_model->product_farmer_category_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->product_farmer_category_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function semen_company_price(){
		$this->load->view('admin/semen_company_price');
	}
	public function semen_company_price_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->semen_company_price_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->semen_company_price_count($name);
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
	public function semen_company_price_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->semen_company_price_status($id, $data))
		{
			$product_data = $this->api_model->semen_company_price_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->semen_company_price_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function semen_company_price_edit($id){
		if(isset($_POST['submit'])){
			$data['group'] = $this->input->get_post('group');
			$data['farmer_price']=$this->input->get_post('farmer_price');
			$data['farmer_offer_price']=$this->input->get_post('farmer_offer_price');
			$data['ai_price']=$this->input->get_post('ai_price');
			$data['ai_offer_price']=$this->input->get_post('ai_offer_price');
			$data['advance_booking_price']=$this->input->get_post('advance_booking_price');
			$data['advance_booking_offer_price']=$this->input->get_post('advance_booking_offer_price');
			$data['ai_service_price']=$this->input->get_post('ai_service_price');
			$data['ai_service_offer_price']=$this->input->get_post('ai_service_offer_price');
			$data['company_charges']=$this->input->get_post('company_charges');
			$data['company_offer_charges']=$this->input->get_post('company_offer_charges');
			$data['ai_incentive']=$this->input->get_post('ai_incentive');
			$data['ai_offer_incentive']=$this->input->get_post('ai_offer_incentive');
			$data['company'] = $this->input->get_post('company');
			$this->form_validation->set_rules('company','Please Select Company Name','required');
			$this->form_validation->set_rules('group','Please Select Group Name','required');
			$this->form_validation->set_rules('farmer_price','Please Enter Farmer Price','required');
			$this->form_validation->set_rules('farmer_offer_price','Please Enter Farmer Offer Price','required');
			$this->form_validation->set_rules('ai_price','Please Enter Semen Price','required');
			$this->form_validation->set_rules('ai_offer_price', 'Please Enter Semen Offer Price','required');
			$this->form_validation->set_rules('advance_booking_price', 'Please Enter Advance Booking Price','required');
			$this->form_validation->set_rules('ai_service_offer_price', 'Please Enter Advance Booking Offer Price','required');
			$this->form_validation->set_rules('company_charges', 'Please Enter Company Charges','required');
			$this->form_validation->set_rules('company_offer_charges', 'Please Enter Company Offer Charges','required');
			$this->form_validation->set_rules('ai_incentive', 'Please Enter AI Incentive','required');
			$this->form_validation->set_rules('ai_offer_incentive', 'Please Enter AI Offer Incentive','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('id', $id, 'company_group_price', $data)){
					$this->session->set_flashdata('msg','Your Data Succesfully Updated');
                    redirect(base_url('admin/semen_company_price'));
				}else{
					//$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'farmer_plans', '', '*');
					$this->session->set_flashdata('msg','Problem With database');
					$data['data'] = $this->api_model->get_data('id = "'.$id.'"' , 'company_group_price');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/semen_company_price_edit', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = "'.$id.'"' , 'company_group_price');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_company_price_edit', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"' , 'company_group_price');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_company_price_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_company_price_add(){
		if(isset($_POST['submit'])){
			$data['group'] = $this->input->get_post('group');
			$data['farmer_price']=$this->input->get_post('farmer_price');
			$data['farmer_offer_price']=$this->input->get_post('farmer_offer_price');
			$data['ai_price']=$this->input->get_post('ai_price');
			$data['ai_offer_price']=$this->input->get_post('ai_offer_price');
			$data['advance_booking_price']=$this->input->get_post('advance_booking_price');
			$data['advance_booking_offer_price']=$this->input->get_post('advance_booking_offer_price');
			$data['ai_service_price']=$this->input->get_post('ai_service_price');
			$data['ai_service_offer_price']=$this->input->get_post('ai_service_offer_price');
			$data['company_charges']=$this->input->get_post('company_charges');
			$data['company_offer_charges']=$this->input->get_post('company_offer_charges');
			$data['ai_incentive']=$this->input->get_post('ai_incentive');
			$data['ai_offer_incentive']=$this->input->get_post('ai_offer_incentive');
			$data['company'] = $this->input->get_post('company');
			$this->form_validation->set_rules('company','Please Select Company Name','required');
			$this->form_validation->set_rules('group','Please Select Group Name','required');
			$this->form_validation->set_rules('farmer_price','Please Enter Farmer Price','required');
			$this->form_validation->set_rules('farmer_offer_price','Please Enter Farmer Offer Price','required');
			$this->form_validation->set_rules('ai_price','Please Enter Semen Price','required');
			$this->form_validation->set_rules('ai_offer_price', 'Please Enter Semen Offer Price','required');
			$this->form_validation->set_rules('advance_booking_price', 'Please Enter Advance Booking Price','required');
			$this->form_validation->set_rules('ai_service_offer_price', 'Please Enter Advance Booking Offer Price','required');
			$this->form_validation->set_rules('company_charges', 'Please Enter Company Charges','required');
			$this->form_validation->set_rules('company_offer_charges', 'Please Enter Company Offer Charges','required');
			$this->form_validation->set_rules('ai_incentive', 'Please Enter AI Incentive','required');
			$this->form_validation->set_rules('ai_offer_incentive', 'Please Enter AI Offer Incentive','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('company_group_price', $data)){
					$this->session->set_flashdata('msg','Your Data Succesfully Added');
                    redirect(base_url('admin/semen_company_price'));
				}else{
					//$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'farmer_plans', '', '*');
					$this->session->set_flashdata('msg','Problem With database');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/semen_company_price_add');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_company_price_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_company_price_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_account(){
		$this->load->view('admin/semen_account');
	}
	public function semen_packages(){
		$this->load->view('admin/semen_packages');
	}
	public function semen_group_discount(){
		$this->load->view('admin/semen_group_discount');
	}
	public function semen_group_discount_add(){
		if(isset($_POST['submit'])){
			$data['name'] = $_POST['name'];
			$group = $_POST['group'];
			$group = implode(',', $group);
			$data['groups'] = $group;
			$data['limit_quantity'] = $_POST['limit_qty'];
			$data['semen_quantity'] = $_POST['qty'];
			$data['percentage'] = $_POST['percentage'];
			$data['flag'] = $_POST['flag'];
			$data['description'] = $_POST['description'];
			// echo "<pre>";
			// print_r($_POST);
			// print_r($data);
			// exit;
			$this->form_validation->set_rules('name','Please Enter Offer Name','required|trim');
			$this->form_validation->set_rules('qty','Please Enter Semen Quantity','required|trim');
			$this->form_validation->set_message('percentage', 'Please Enter Discount Percentage','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('semen_group_discount', $data)){
					$this->session->set_flashdata('msg','Your Data Succesfully Inserted');
					redirect(base_url('admin/semen_group_discount'));
				}else{
					$this->session->set_flashdata('msg','Problem With database');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/semen_group_discount_add');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_group_discount_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_group_discount_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_group_apply($id){
		$data['id'] = $id;
		if(isset($_POST['submit'])){
			$id = $this->input->get_post('id');
			$semen_type = $this->input->get_post('semen_type');
			$data_semen = $this->api_model->get_data('id = '.$id.'', 'semen_group', '', '*');
			$data_st['farmer_price'] = $data_semen[0]['farmer_price'];
			$data_st['farmer_offer_price'] = $data_semen[0]['farmer_offer_price'];
			$data_st['ai_price'] = $data_semen[0]['ai_price'];
			$data_st['ai_offer_price'] = $data_semen[0]['ai_offer_price'];
			$data_st['advance_booking_price'] = $data_semen[0]['advance_booking_price'];
			$data_st['advance_booking_offer_price'] = $data_semen[0]['advance_booking_offer_price'];
			$data_st['ai_service_price'] = $data_semen[0]['ai_service_price'];
			$data_st['ai_service_offer_price'] = $data_semen[0]['ai_service_offer_price'];
			$data_st['company_charges'] = $data_semen[0]['company_charges'];
			$data_st['company_offer_charges'] = $data_semen[0]['company_offer_charges'];
			$data_st['ai_incentive'] = $data_semen[0]['ai_incentive'];
			$data_st['ai_sale_price'] = $data_semen[0]['ai_price'];
			$data_st['ai_offer_incentive'] = $data_semen[0]['ai_offer_incentive'];
			if(in_array(0,$semen_type)){
				$data = $this->api_model->query_build('SELECT * from seman_stock as st where rest_stock <> "0" AND (select id from bull_table where groups = "'.$id.'" AND id = st.bull_id) IS NOT NULL AND (select admin_id from admin where admin_id = st.admin_id AND user_type = "5") IS NOT NULL'); 
				foreach($data as $d){
					$this->api_model->update('id', $d['id'], 'seman_stock', $data_st);
				}
			}
			if(in_array(1,$semen_type)){
				$data = $this->api_model->query_build('SELECT * from seman_stock as st where rest_stock <> "0" AND (select id from bull_table where groups = "'.$id.'" AND id = st.bull_id) IS NOT NULL AND (select admin_id from admin where admin_id = st.admin_id AND user_type = "6") IS NOT NULL');
				foreach($data as $d){
					$this->api_model->update('id', $d['id'], 'seman_stock', $data_st);
				}
			}
			if(in_array(2,$semen_type)){
				$data = $this->api_model->query_build('SELECT * from seman_stock as st where rest_stock <> "0" AND (select id from bull_table where groups = "'.$id.'" AND id = st.bull_id) IS NOT NULL AND (select admin_id from admin where admin_id = st.admin_id AND user_type = "7") IS NOT NULL');
				foreach($data as $d){
					$this->api_model->update('id', $d['id'], 'seman_stock', $data_st);
				}
			}
			redirect(base_url('admin/semen_group'));
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_group_apply', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_packages_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->semen_packages_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_semen_packages_count($name);
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
	public function semen_package_add(){
		if(isset($_POST['submit'])){
			$data['name'] = $this->input->get_post('name');
			$data['price'] = $this->input->get_post('price');
			$data['offer_price'] = $this->input->get_post('offer_price');
			$data['per_animal_price'] = $this->input->get_post('per_animal_price');
			$data['animal_quantity'] = $this->input->get_post('qty');
			$data['image'] = $this->input->get_post('bull_photo');
			$data['description'] = $this->input->get_post('descr');	
			$this->form_validation->set_rules('name','Please Enter Package Name','required');
			$this->form_validation->set_rules('price','Please Enter Package Price','required');
			$this->form_validation->set_rules('offer_price','Please Enter Package Offer Price','required');
			$this->form_validation->set_rules('qty','Please Enter Animal Quantity','required');
			$this->form_validation->set_message('per_animal_price', 'Please Enter Per Animal Price','required');
			$this->form_validation->set_message('description', 'Please Enter Package Description','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('farmer_plans', $data)){
					$this->session->set_flashdata('msg','Your Data Succesfully Inserted');
                    redirect(base_url('admin/semen_packages'));
				}else{
					$this->session->set_flashdata('msg','Problem With database');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/semen_package_add');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_package_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_package_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_packages_edit($id){
		if(isset($_POST['submit'])){
			$id = $this->input->get_post('id');
			$data['name'] = $this->input->get_post('name');
			$data['price'] = $this->input->get_post('price');
			$data['offer_price'] = $this->input->get_post('offer_price');
			$data['per_animal_price'] = $this->input->get_post('per_animal_price');
			$data['animal_quantity'] = $this->input->get_post('qty');
			$data['image'] = $this->input->get_post('bull_photo');
			$data['description'] = $this->input->get_post('descr');	
			$this->form_validation->set_rules('name','Please Enter Package Name','required');
			$this->form_validation->set_rules('price','Please Enter Package Price','required');
			$this->form_validation->set_rules('offer_price','Please Enter Package Offer Price','required');
			$this->form_validation->set_rules('qty','Please Enter Animal Quantity','required');
			$this->form_validation->set_message('per_animal_price', 'Please Enter Per Animal Price','required');
			$this->form_validation->set_message('description', 'Please Enter Package Description','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('id', $id, 'farmer_plans', $data)){
					$this->session->set_flashdata('msg','Your Data Succesfully Updated');
                    redirect(base_url('admin/semen_packages'));
				}else{
					$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'farmer_plans', '', '*');
					$this->session->set_flashdata('msg','Problem With database');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/semen_package_add', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'farmer_plans', '', '*');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_package_add', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'farmer_plans', '', '*');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_packages_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_package_status(){
		$id = $this->input->get_post('id');
		$data['is_active'] = $this->input->get_post('status');
		$this->api_model->update('id', $id, 'farmer_plans', $data);
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->semen_packages_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_semen_packages_count($name);
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
	public function semen_account_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->semen_account_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_semen_account_count($name);
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
	public function semen_discount_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->semen_discount_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->semen_discount_count($name);
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
	public function semen_discount_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$start = $this->input->get_post('start');
		$name =  $this->input->get('name');
		$perpage = 10;
		if($this->api_model->semen_discount_status($id, $status))
		{
			$detail = $this->api_model->semen_discount_search($name, $start, $perpage);
			$detail['count'] = $this->api_model->semen_discount_count($name);
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
	}
	public function semen_group_discount_edit($id){
		if(isset($_POST['submit'])){
			$data['name'] = $_POST['name'];
			$group = $_POST['group'];
			$group = implode(',', $group);
			$data['groups'] = $group;
			$data['semen_quantity'] = $_POST['qty'];
			$data['limit_quantity'] = $_POST['limit_qty'];
			$data['percentage'] = $_POST['percentage'];
			$data['flag'] = $_POST['flag'];
			$data['description'] = $_POST['description'];
			$this->form_validation->set_rules('name','Please Enter Offer Name','required|trim');
			$this->form_validation->set_rules('qty','Please Enter Semen Quantity','required|trim');
			$this->form_validation->set_message('percentage', 'Please Enter Discount Percentage','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('id', $id, 'semen_group_discount', $data)){
					$this->session->set_flashdata('msg','Your Data Succesfully Updated');
					redirect(base_url('admin/semen_group_discount'));
				}else{
					$this->session->set_flashdata('msg','Problem With database');
					$data['data'] = $this->api_model->get_data('id = '.$id.'' , 'semen_group_discount');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/semen_group_discount_edit', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = '.$id.'' , 'semen_group_discount');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_group_discount_edit', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = '.$id.'' , 'semen_group_discount');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_group_discount_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_group_add(){
		if(isset($_POST['submit'])){
			$data['group'] = $this->input->get_post('group');
			$data['farmer_price']=$this->input->get_post('farmer_price');
			$data['farmer_offer_price']=$this->input->get_post('farmer_offer_price');
			$data['ai_price']=$this->input->get_post('ai_price');
			$data['ai_offer_price']=$this->input->get_post('ai_offer_price');
			$data['advance_booking_price']=$this->input->get_post('advance_booking_price');
			$data['advance_booking_offer_price']=$this->input->get_post('advance_booking_offer_price');
			$data['ai_service_price']=$this->input->get_post('ai_service_price');
			$data['ai_service_offer_price']=$this->input->get_post('ai_service_offer_price');
			$data['company_charges']=$this->input->get_post('company_charges');
			$data['company_offer_charges']=$this->input->get_post('company_offer_charges');
			$data['ai_incentive']=$this->input->get_post('ai_incentive');
			$data['ai_offer_incentive']=$this->input->get_post('ai_offer_incentive');
			$this->form_validation->set_rules('group','Please Enter Group Name','required');
			$this->form_validation->set_rules('farmer_price','Please Enter Farmer Price','required');
			$this->form_validation->set_rules('farmer_offer_price','Please Enter Farmer Offer Price','required');
			$this->form_validation->set_rules('ai_price','Please Enter Semen Price','required');
			$this->form_validation->set_rules('ai_offer_price', 'Please Enter Semen Offer Price','required');
			$this->form_validation->set_rules('advance_booking_price', 'Please Enter Advance Booking Price','required');
			$this->form_validation->set_rules('ai_service_offer_price', 'Please Enter Advance Booking Offer Price','required');
			$this->form_validation->set_rules('company_charges', 'Please Enter Company Charges','required');
			$this->form_validation->set_rules('company_offer_charges', 'Please Enter Company Offer Charges','required');
			$this->form_validation->set_rules('ai_incentive', 'Please Enter AI Incentive','required');
			$this->form_validation->set_rules('ai_offer_incentive', 'Please Enter AI Offer Incentive','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->submit('semen_group', $data)){
					$this->session->set_flashdata('msg','Your Data Succesfully Updated');
                    redirect(base_url('admin/semen_group'));
				}else{
					$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'farmer_plans', '', '*');
					$this->session->set_flashdata('msg','Problem With database');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/semen_group_add', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_group_add', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_group_add', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_group_edit($id){
		if(isset($_POST['submit'])){
			$id = $this->input->get_post('id');
			$data['group'] = $this->input->get_post('group');
			$data['farmer_price']=$this->input->get_post('farmer_price');
			$data['farmer_offer_price']=$this->input->get_post('farmer_offer_price');
			$data['ai_price']=$this->input->get_post('ai_price');
			$data['ai_offer_price']=$this->input->get_post('ai_offer_price');
			$data['advance_booking_price']=$this->input->get_post('advance_booking_price');
			$data['advance_booking_offer_price']=$this->input->get_post('advance_booking_offer_price');
			$data['ai_service_price']=$this->input->get_post('ai_service_price');
			$data['ai_service_offer_price']=$this->input->get_post('ai_service_offer_price');
			$data['company_charges']=$this->input->get_post('company_charges');
			$data['company_offer_charges']=$this->input->get_post('company_offer_charges');
			$data['ai_incentive']=$this->input->get_post('ai_incentive');
			$data['ai_offer_incentive']=$this->input->get_post('ai_offer_incentive');
			$this->form_validation->set_rules('group','Please Enter Group Name','required');
			$this->form_validation->set_rules('farmer_price','Please Enter Farmer Price','required');
			$this->form_validation->set_rules('farmer_offer_price','Please Enter Farmer Offer Price','required');
			$this->form_validation->set_rules('ai_price','Please Enter Semen Price','required');
			$this->form_validation->set_rules('ai_offer_price', 'Please Enter Semen Offer Price','required');
			$this->form_validation->set_rules('advance_booking_price', 'Please Enter Advance Booking Price','required');
			$this->form_validation->set_rules('ai_service_offer_price', 'Please Enter Advance Booking Offer Price','required');
			$this->form_validation->set_rules('company_charges', 'Please Enter Company Charges','required');
			$this->form_validation->set_rules('company_offer_charges', 'Please Enter Company Offer Charges','required');
			$this->form_validation->set_rules('ai_incentive', 'Please Enter AI Incentive','required');
			$this->form_validation->set_rules('ai_offer_incentive', 'Please Enter AI Offer Incentive','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				if($this->api_model->update('id', $id, 'semen_group', $data)){
					$this->session->set_flashdata('msg','Your Data Succesfully Updated');
                    redirect(base_url('admin/semen_group'));
				}else{
					$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'semen_group', '', '*');
					$this->session->set_flashdata('msg','Problem With database');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/semen_group_add', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'semen_group', '', '*');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_group_add', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_data('id = "'.$id.'"', 'semen_group', '', '*');
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_group_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_group(){
		$this->load->view('admin/semen_group');
	}
	public function semen_distributor($id){
		$data['id'] = $id;
		$this->load->view('admin/semen_distributor', $data);
	}
	public function semen_bank($id){
		$data['id'] = $id;
		$this->load->view('admin/semen_bank', $data);
	}
	public function semen_suplier($id){
		$data['id'] = $id;
		$this->load->view('admin/semen_suplier', $data);
	}
	public function semen_transaction($id){
		$data['id'] = $id;
		$this->load->view('admin/semen_transaction', $data);
	}
	public function get_semen_transaction(){
		$id = $this->input->get_post('id');
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$type = $this->input->get_post('type');
		$perpage = 10;
		$detail = $this->api_model->get_semen_transaction($id, $name, $start, $perpage, $type, $admin_id);
		$detail['count'] = $this->api_model->get_semen_transaction_count($id, $name, $type, $admin_id);
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
	public function get_semen_suplier(){
		$id = $this->input->get_post('id');
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$type = $this->input->get_post('type');
		$perpage = 10;
		$detail = $this->api_model->get_semen_suplier($id, $name, $start, $perpage, $type, $admin_id);
		$count = $this->api_model->get_semen_suplier_count($id, $name, $type, $admin_id);
		if($detail)
		{
			$json_data = $count[0]['count'];
		}
		else
		{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
	}
	public function get_seman_company(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$type = $this->input->get_post('type');
		$perpage = 10;
		$detail = $this->api_model->get_seman_company($name, $start, $perpage, $type, $admin_id);
		$count = $this->api_model->get_seman_company_count($name, $start, $perpage);
		$detail['count'] = $count[0]['count'];
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
	public function get_seman_distributor(){
		$id = $this->input->get_post('id');
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$type = $this->input->get_post('type');
		$perpage = 10;
		$detail = $this->api_model->get_seman_distributor($id, $name, $start, $perpage, $type, $admin_id);
		$detail['count'] = $this->api_model->get_seman_distributor_count($id, $name, $type, $admin_id);
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
	public function get_semen_bank(){
		$id = $this->input->get_post('id');
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$type = $this->input->get_post('type');
		$perpage = 10;
		$detail = $this->api_model->get_semen_bank($id, $name, $start, $perpage, $type, $admin_id);
		$detail['count'] = $this->api_model->get_semen_bank_count($id, $name, $type, $admin_id);
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
	public function lab_test_request(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/lab_test_request');
		$this->load->view('admin/layouts/admin_footer');
	}	
	public function location(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/location');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function set_location(){
		if(isset($_POST["location"])){
		$data['complete_addr'] = $this->input->get_post('city2');
		$data['latitude'] = $this->input->get_post('cityLat');
		$data['longitude'] = $this->input->get_post('cityLng');
		$user_id = $this->session->userdata('user_id');
		// print_r($data);
		// exit;
		$this->api_model->update('admin_id', $user_id, 'admin', $data);
		 redirect(base_url('admin/location'));

		}
	}
	public function assign_test(){
		$req_id = $this->input->get_post('id');
		$emp_id = $this->input->get_post('emp_id');
		$data['emp_id'] = $emp_id;
		$this->api_model->update('id', $req_id, 'lab_request', $data);
		echo true;
	}
	public function change_status_test(){
		$req_id = $this->input->get_post('id');
		$status = $this->input->get_post('status');
		$data['ispaid'] = $status;
		$this->api_model->update('id', $req_id, 'lab_request', $data);
		echo true;
	}
	public function subscribe(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/subscribe');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function importdata()
	{ 
		//$this->load->view('import_data');
		if(isset($_POST["import"]))
		{
			$file = $_FILES['file']['tmp_name'];
			$handle = fopen($file, "r");
			$c = 0;//
			while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
			{
				$data['name'] = $filesop['0'];
				$data['phone'] = $filesop['1'];
				$data['address'] =$filesop['2'];
				if($c<>0){					//SKIP THE FIRST ROW
					//$this->Crud_model->saverecords($fname,$lname);
					// print_r($data);
					// exit;
					$this->api_model->submit('test_csv', $data);
				}
				$c = $c + 1;
			}
			echo "sucessfully import data !";
				
		}
	}
	public function seman_import(){
		  if(isset($_POST['import'])){
    	            $fileName = $_FILES["file"]["tmp_name"];
                    if ($_FILES["file"]["size"] > 0) {
                        $file = fopen($fileName, "r");
                        $field = array("Sire's ID/Tag No","Sire's Name","Date of Birth","Sire's Category (Buffalo/Cow)","Sire's Sire's Breed","Sire's Dams Breed","Semen Type (Normal/Sexed)","Progeny Tested (Yes/No)","Imported (Yes/No)","Govt. Certified (Yes/No)","Category (1 Star/ 3 Star/ 5 Star)","Brochure (if any)-UPLOAD","Sire's Dams Yield(kg)","Sire's Daughter's Yield(kg)","Total Milk Fat (Kg)","Avg. Milk Protein(%)","Total Milk Protein(kg)","Milk Type (A1/A2)","Fats (%)","Parents average yield (kg)","Upload Photo Link","Upload Video Link","List of Bulls Categories","END USER PRICE","Livestoc Cash Incentive Farmer","LIVESTOC CASH USGAE ALLOWED","AI RATE","Distributor Price");
                        $i = 0;
                        $error = 0;
                        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                            if($i == 0){
                                if(!empty(array_diff($field, $column))){
                                	 print_r($column);
                                     exit;
                                    $this->session->set_flashdata('error','Fields are not in Same sequence');
                                    $this->load->view('admin/layouts/admin_header');
									$this->load->view('admin/layouts/admin_nav');
									$this->load->view('admin/bull');
									$this->load->view('admin/layouts/admin_footer');
                                    break;
                                }else{
                                    $i++;
                                }
                            }else{
                                $i++;
                                $bull_id = $column[1];
                                $data['bull_no'] = $bull_id;
                                $data['bull_id']= $bull_id;
                                $data['bull_name'] = $column[2];
                                $data['dob'] = $column[3];
                                $data['category'] = $column[4];
                                $data['bread'] = $column[5];
                                $data['dams_breed'] = '';
                                $data['semen_type'] = $column[7];
                                $data['progini_test'] = '';
                                $data['is_imported'] = $column[9];
                                $data['registration_certificate']= '';
                                $data['rating']= $column[11];
                                $data['brochure'] = '';
                                $data['dam_yield'] = $column[13];
                                $data['lat_yield'] = '';
                                $data['daughter_yield'] = '';
                                $data['total_milk_fat'] = '';
                                $data['avg_milk_proteen'] = '';
                                $data['total_milk_proteen'] = '';
                                $data['milk_type']= '';
                                $data['total_milk_fat'] = '';                                
                                $data['image'] = $column[21];
                                $data['bull_source'] = $this->session->userdata('user_id');
                                $data['video'] = '';
                                $data['groups'] = $column[23];
                                $data['price'] = $column[24];                               
                                $data['livestoc_incentive_price'] = $column[25];
                                $data['livestoc_cash_use'] = $column[26];
                                $data['ai_price'] = $column[27];
                                $data['distributor_price'] = $column[28];                                
                                $data['company_charges'] = '';                          
                                $data['date'] = date('Y-m-d');
                                $data['created_on'] = date('Y-m-d h:i:s');
                               // print_r($data);
                                //exit;
                                $this->api_model->submit('bull_table', $data);
                            }
                        }
                        if($error == 0){
                            $this->session->set_flashdata('msg','Your Data Succesfully Inserted');
                            redirect(base_url('admin/bull'));
                        }
                    }
				 }else{
				    $this->load->view('admin/layouts/admin_header');
				 	$this->load->view('admin/layouts/admin_nav');
				 	$this->load->view('admin/bull');
				 	$this->load->view('admin/layouts/admin_footer');
				 }
	}
	public function order_view($id){
		$data['order'] = $this->api_model->get_data('id = '.$id.'' , 'product_order', '', '*');
		//print_r($order);
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/order_view', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function get_account_info($user_id, $type){
		$data['users_id'] = $user_id;
		$data['type'] = $type;
		$dat['data'] = $data;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/account_detail', $dat);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function get_account_detail($user_id, $type, $start, $perpage){
		if($type == '1'){
			$data = $this->api_model->get_data('users_id = '.$user_id.' AND user_type = "'.$type.'" AND payment_type <> ""', 'log_file', '', '*', $start, $perpage);
			$count = $this->api_model->get_data('users_id = '.$user_id.' AND user_type = "'.$type.'" AND payment_type <> ""', 'log_file', '', 'count(id) as count');
		}
		if($type == '0'){
			$data = $this->api_model->get_data('users_id = '.$user_id.' AND user_type = "'.$type.'" AND payment_type <> ""', 'log_file', '', '*', $start, $perpage);
			$count = $this->api_model->get_data('users_id = '.$user_id.' AND user_type = "'.$type.'" AND payment_type <> ""', 'log_file', '', 'count(id) as count');
		}
		if(!empty($data))
		{
			$data['count'] = $count;
			$json_data = $data;
		}
		else{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
	}
	public function get_summary_detail($id){
		$data['data'] = $this->api_model->get_data('id = '.$id.'', 'log_file', '', '*');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/get_summary_detail', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function order_status(){
		//print_r($_REQUEST);
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->order_status($id, $data))
		{
			$user_id = $this->session->userdata("user_id");
			$detail = $this->api_model->get_order_search($name, $user_id, $start, $perpage);
			$detail['count'] = $this->api_model->get_order_count($name, $user_id);
			if($detail)
			{
				$json_data = $detail;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function subscribe_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->subscribe_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->subscribe_count($name);
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
	public function lab_request(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/lab_request');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function lab_view(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/lab_view');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function lab_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->lab_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->lab_count($name);
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

	public function lab_test_search(){
		$user_id = $this->input->get_post('user_id');
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->lab_test_search($name, $start, $perpage, '',$user_id);
		$detail['count'] = $this->api_model->lab_test_count($name, $user_id);
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
	public function lab_test_view($id){
		$detail['data'] = $this->api_model->lab_test_search('', '', '', $id);
		$this->load->view('admin/lab_test_view',$detail);
	}
	public function index(){
		$this->load->view('user_login');
	}
	public function add_pro_subuser($type){
		$data['type'] = $type;
		if($_POST['submit']){	
			$data['super_admin_id'] = $this->input->get_post('vendor_id');
			$data['image'] = $this->input->get_post('image');
			$data['adhar_image'] = $this->input->get_post('adhar_image');
			$data['adhar_back_image'] = $this->input->get_post('adhar_back_image');
			$data['bank_name'] = $this->input->get_post('name');
			$data['fname'] = $this->input->get_post('name');
			$data['email'] = $this->input->get_post('email');
			$data['password'] = md5($this->input->get_post('password'));
			$data['mobile'] = $this->input->get_post('mobile');
			$data['user_type'] = $this->input->get_post('user_type');
			$data['user_type'] = $this->input->get_post('comp_type');
			$data['type'] = $this->input->get_post('type');
			$data['s_s_grade'] = $this->input->get_post('grade');
			$data['latitude'] = $this->input->get_post('cityLat');
			$data['longitude'] = $this->input->get_post('cityLng');
			$data['address'] = $this->input->get_post('address1').$this->input->get_post('address2');
			$service_district = $this->input->get_post('district1');
			$service_state = $this->input->get_post('state1');
			$data['service_state'] = $service_state;
			$data['service_district'] = $service_district;
			$data['district'] = $this->input->get_post('district');
			$data['state'] = $this->input->get_post('state');
			$data['pin'] = $this->input->get_post('pin');
			$data['adhar_no'] = $this->input->get_post('adhar_no');
			$type_user = $this->input->get_post('type_user');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('email','Please Enter Email','required|trim');
			$this->form_validation->set_rules('mobile','Please Enter mobile','numeric|required|trim');
			$this->form_validation->set_rules('vendor_id','Please Select vendor','required');
			// if($type_user == 1){
			// 	$this->form_validation->set_rules('grade','Please Enter Choose Grade.','required');
			// 	$this->form_validation->set_rules('authority_type','Please Enter Semen Bank/Authority Type','required');
			// }
			$this->form_validation->set_rules('address1','Please Enter Address','required|trim');
			$this->form_validation->set_rules('district1','Please Enter Service District','required');
			$this->form_validation->set_rules('state1','Please Enter Service State','required');
			$this->form_validation->set_rules('district','Please Enter District','required');
			$this->form_validation->set_rules('state','Please Enter State','required');
			$this->form_validation->set_message('pin', 'Please Enter Pin','required');
			$this->form_validation->set_message('adhar_no', 'Please Enter Pin','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				$data['created_on'] = date('Y-m-d h:i:s');
				if($this->api_model->comp_mobile_email($data['mobile'])){
					$this->session->set_flashdata('add_bank','Mobile No is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_pro_subuser', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
				else if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
					if($detail = $this->api_model->add_bank($data)){
							$this->session->set_flashdata('add_bank','Your data is Inserted.');
							if($type == 1){
								redirect('admin/pro_district');
							}else if($type == 2){
								redirect('admin/distributors');
							} else if($type == 3){
								redirect('admin/suppliers');
							}
							
					}else{
						$this->session->set_flashdata('add_bank','Error with database');
						$data['type'] = $this->input->get_post('type_user');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/add_pro_subuser', $data);
						$this->load->view('admin/layouts/admin_footer');
					}
				}else{
					$this->session->set_flashdata('add_bank','Email ID is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_pro_subuser', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['type'] = $this->input->get_post('type_user');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_pro_subuser', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['type'] = $type;
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_pro_subuser', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function feed_sup($type){
		$data['type'] = $type;
		if($_POST['submit']){	
			$data['super_admin_id'] = $this->input->get_post('vendor_id');
			$data['image'] = $this->input->get_post('image');
			$data['adhar_image'] = $this->input->get_post('adhar_image');
			$data['adhar_back_image'] = $this->input->get_post('adhar_back_image');
			$data['bank_name'] = $this->input->get_post('name');
			$data['fname'] = $this->input->get_post('name');
			$data['email'] = $this->input->get_post('email');
			$data['password'] = md5($this->input->get_post('password'));
			$data['mobile'] = $this->input->get_post('mobile');
			$data['user_type'] = $this->input->get_post('user_type');
			$data['user_type'] = $this->input->get_post('comp_type');
			$data['type'] = $this->input->get_post('type');
			$data['s_s_grade'] = $this->input->get_post('grade');
			$data['latitude'] = $this->input->get_post('cityLat');
			$data['longitude'] = $this->input->get_post('cityLng');
			$data['address'] = $this->input->get_post('address1').$this->input->get_post('address2');
			$service_district = $this->input->get_post('district1');
			$service_state = $this->input->get_post('state1');
			$data['service_state'] = $service_state;
			$data['service_district'] = $service_district;
			$data['district'] = $this->input->get_post('district');
			$data['state'] = $this->input->get_post('state');
			$data['pin'] = $this->input->get_post('pin');
			$data['adhar_no'] = $this->input->get_post('adhar_no');
			$data['vehical_type'] = $this->input->get_post('vehical_type');
			$data['vehical_number'] = $this->input->get_post('vehical_number');
			$data['dl_number'] = $this->input->get_post('dl_number');
			$data['per_km'] = $this->input->get_post('per_km');
			$data['licence_photo'] = $this->input->get_post('dl_image');
			$data['labour_charge'] = $this->input->get_post('labour_charge');
			$type_user = $this->input->get_post('type_user');
			// print_r($data);
			// exit;
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('email','Please Enter Email','required|trim');
			$this->form_validation->set_rules('mobile','Please Enter mobile','numeric|required|trim');
			$this->form_validation->set_rules('vendor_id','Please Select vendor','required');
			// if($type_user == 1){
			// 	$this->form_validation->set_rules('grade','Please Enter Choose Grade.','required');
			// 	$this->form_validation->set_rules('authority_type','Please Enter Semen Bank/Authority Type','required');
			// }
			$this->form_validation->set_rules('address1','Please Enter Address','required|trim');
			$this->form_validation->set_rules('district1','Please Enter Service District','required');
			$this->form_validation->set_rules('state1','Please Enter Service State','required');
			$this->form_validation->set_rules('district','Please Enter District','required');
			$this->form_validation->set_rules('state','Please Enter State','required');
			$this->form_validation->set_message('pin', 'Please Enter Pin','required');
			$this->form_validation->set_message('adhar_no', 'Please Enter Pin','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				$data['created_on'] = date('Y-m-d h:i:s');
				if($this->api_model->comp_mobile_email($data['mobile'])){
					$this->session->set_flashdata('add_bank','Mobile No is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/feed_sup', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
				else if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
					if($detail = $this->api_model->add_bank($data)){
							$this->session->set_flashdata('add_bank','Your data is Inserted.');
							// if($type == 1){
							// 	redirect('admin/pro_district');
							// }else if($type == 2){
							// 	redirect('admin/distributors');
							// } else if($type == 3){
								redirect('admin/pro_supplier');
							//}
							
					}else{
						$this->session->set_flashdata('add_bank','Error with database');
						$data['type'] = $this->input->get_post('type_user');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/feed_sup', $data);
						$this->load->view('admin/layouts/admin_footer');
					}
				}else{
					$this->session->set_flashdata('add_bank','Email ID is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/feed_sup', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['type'] = $this->input->get_post('type_user');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/feed_sup', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['type'] = $type;
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/feed_sup', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function transportatin_level_one(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/transportatin_level_one');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function transportation_level($type){
		$data['type'] = $type;
		if($_POST['submit']){	
			$data['super_admin_id'] = $this->input->get_post('vendor_id');
			$data['image'] = $this->input->get_post('image');
			$data['adhar_image'] = $this->input->get_post('adhar_image');
			$data['adhar_back_image'] = $this->input->get_post('adhar_back_image');
			$data['bank_name'] = $this->input->get_post('name');
			$data['fname'] = $this->input->get_post('name');
			$data['email'] = $this->input->get_post('email');
			$data['password'] = md5($this->input->get_post('password'));
			$data['mobile'] = $this->input->get_post('mobile');
			//$data['user_type'] = "27";
			$data['user_type'] = $this->input->get_post('comp_type');
			$data['type'] = $this->input->get_post('type');
			$data['s_s_grade'] = $this->input->get_post('grade');
			$data['latitude'] = $this->input->get_post('cityLat');
			$data['longitude'] = $this->input->get_post('cityLng');
			$data['address'] = $this->input->get_post('address1').$this->input->get_post('address2');
			$service_district = $this->input->get_post('district1');
			$data['service_district'] = implode(',', $service_district);
			$service_state = $this->input->get_post('state1');
			$data['service_state'] = $service_state;			
			$data['district'] = $this->input->get_post('district');
			// $data['district'] = implode(',', $district);
			$data['state'] = $this->input->get_post('state');
			$data['pin'] = $this->input->get_post('pin');
			$data['adhar_no'] = $this->input->get_post('adhar_no');
			$data['vehical_type'] = $this->input->get_post('vehical_type');
			$data['vehical_number'] = $this->input->get_post('vehical_number');
			$data['dl_number'] = $this->input->get_post('dl_number');
			$data['per_km'] = $this->input->get_post('per_km');
			$data['licence_photo'] = $this->input->get_post('dl_image');
			$data['labour_charge'] = $this->input->get_post('labour_charge');
			$type_user = $this->input->get_post('type_user');
			// print_r($data);
			// exit;
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('email','Please Enter Email','required|trim');
			$this->form_validation->set_rules('mobile','Please Enter mobile','numeric|required|trim');
			$this->form_validation->set_rules('vendor_id','Please Select vendor','required');
			// if($type_user == 1){
			// 	$this->form_validation->set_rules('grade','Please Enter Choose Grade.','required');
			// 	$this->form_validation->set_rules('authority_type','Please Enter Semen Bank/Authority Type','required');
			// }
			$this->form_validation->set_rules('address1','Please Enter Address','required|trim');
			$this->form_validation->set_rules('district1','Please Enter Service District','required');
			$this->form_validation->set_rules('state1','Please Enter Service State','required');
			// $this->form_validation->set_rules('district','Please Enter District','required');
			$this->form_validation->set_rules('state','Please Enter State','required');
			$this->form_validation->set_message('pin', 'Please Enter Pin','required');
			$this->form_validation->set_message('adhar_no', 'Please Enter Pin','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				$data['created_on'] = date('Y-m-d h:i:s');
				if($this->api_model->comp_mobile_email($data['mobile'])){
					$this->session->set_flashdata('add_bank','Mobile No is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/transportation_level', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
				else if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
					if($detail = $this->api_model->add_bank($data)){
							$this->session->set_flashdata('add_bank','Your data is Inserted.');
							// if($type == 1){
							// 	redirect('admin/pro_district');
							// }else if($type == 2){
							// 	redirect('admin/distributors');
							// } else if($type == 3){
								redirect('admin/transportatin_level_one');
							//}
							
					}else{
						$this->session->set_flashdata('add_bank','Error with database');
						$data['type'] = $this->input->get_post('type_user');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/transportation_level', $data);
						$this->load->view('admin/layouts/admin_footer');
					}
				}else{
					$this->session->set_flashdata('add_bank','Email ID is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/transportation_level', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['type'] = $this->input->get_post('type_user');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/transportation_level', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['type'] = $type;
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/transportation_level', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function add_paravate(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/paravate_reg');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function pro_district(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/pro_distributor');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function pro_supplier(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/pro_supplier');
		$this->load->view('admin/layouts/admin_footer');
	}	
	public function pro_retailer(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/pro_retailer');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function pro_stock(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/pro_stock');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function district(){
		$this->load->view('admin/district');
	}
	public function note(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/note');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function add_note(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/add_note');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function language(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/language');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function language_add(){
		if(isset($_POST['submit'])){
			$data['name'] = $this->input->get_post('name');
			$data['code'] = $this->input->get_post('code');
			$this->form_validation->set_rules('name','Please Fill Language Name Field','required');
			$this->form_validation->set_rules('code','Please Fill Language Code Field','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				if($this->api_model->input_laguage($data)){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect(base_url('admin/language'));
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/language_add');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/language_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/language_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function proforma_invoice($id, $type){
		if($_POST['final']){
			$stock_data = json_decode($_POST['stock_data']);
			$i = 0;
			$y = 0;
			$error = 0;
			//print_r($stock_data);
			foreach($stock_data->data as $stoc){
				if($_POST['strow_'.$stoc->id]){
					$detail = $this->api_model->get_semen_stock_id($stoc->id);
					if($_POST['strow_'.$stoc->id] > $detail[0]['rest_stock']){
						if($y == 0){
							$error = '#'.$stoc->id;
						}else{
							$error .= ',#'.$stoc->id;
						}
						$y++;
					}
				}
				$i++;
			}
			if($error === 0){
				$i = 0;
				foreach($stock_data->data as $stoc){
					if($_POST['strow_'.$stoc->id]){
						$detail = $this->api_model->get_semen_stock_id($stoc->id);
						//print_r($detail);
						if($i == 0){
							$stock_id = $stoc->id;
							$stoct_price =  $detail[0]['ai_sale_price'];
							$stock_qty = $_POST['strow_'.$stoc->id];
							$total = $detail[0]['ai_sale_price'] * $_POST['strow_'.$stoc->id];
						}else{
							$stock_id .= ','.$stoc->id;
							$stoct_price .= ','.$detail[0]['ai_sale_price'];
							$stock_qty .= ','.$_POST['strow_'.$stoc->id];
							$total += $detail[0]['ai_sale_price'] * $_POST['strow_'.$stoc->id];
						}
						$i++;
					}
				}
				$data['users_id'] = $this->input->post('doc_id');
				$data['admin_id'] = $this->session->userdata('user_id');
				$data['semen_stock_id'] = $stock_id;
				$data['semen_stock_price'] = $stoct_price;
				$data['semen_stock_qty'] = $stock_qty;
				$data['sheath_qty'] = $this->input->post('sheath');
				$data['gas_qty'] = $this->input->post('gas');
				$data['gloves_qty'] = $this->input->post('gloves');
				$data['invoice_total'] = $total;
				$data['date'] = date('y-m-d');
				$last_id = $this->api_model->submit('semen_invoice_performa', $data);
				$this->session->set_flashdata('add_bank','Your Semen Stock has been successfully  Transfered');
				redirect('admin/invoice/'.$last_id);
			}else{
				// echo "this is test";
				// echo "Quantity is more then available stock (".$error.") or Out of stock";
				$this->session->set_flashdata('add_bank','Quantity is more then available stock ('.$error.') or Out of stock');
				$id='';
				$type='';
				$data['doc_id'] = $id;
				$data['doc_type'] = $type;
				$data['stock_data'] = $_POST['stock_data'];
				$data['data'] = $this->api_model->get_bank();
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/proforma_invoice', $data);
				$this->load->view('admin/layouts/admin_footer');
			 }
		}
		else if($_POST['submit']){
			$data['doc_id'] = $id;
			$data['doc_type'] = $type;
			$data['stock_data'] = $_POST['stock_data'];
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/proforma_invoice', $data);
			$this->load->view('admin/layouts/admin_footer');
			
		}else{
			$data['doc_id'] = $id;
			$data['doc_type'] = $type;
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');	
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/proforma_invoice', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_stock_transfer($id, $type){
		if($_POST['final']){
			$stock_data = json_decode($_POST['stock_data']);
			// print_r($stock_data);
			// exit;
			$i = 0;
			$y = 0;
			$error = 0;
			// echo "<pre>";
			// print_r($stock_data);
			foreach($stock_data->data as $stoc){
				if($_POST['strow_'.$stoc->id]){
					$detail = $this->api_model->get_semen_stock_id($stoc->id);
					if($_POST['strow_'.$stoc->id] > $detail[0]['rest_stock']){
						if($y == 0){
							$error = '#'.$stoc->id;
						}else{
							$error .= ',#'.$stoc->id;
						}
						$y++;
					}
				}
				$i++;
			}
			if($error === 0){
				$i = 0;
				foreach($stock_data->data as $stoc){
					if($_POST['strow_'.$stoc->id]){
						$detail = $this->api_model->get_semen_stock_id($stoc->id);
						//print_r($detail);
						if($i == 0){
							$stock_id = $stoc->id;
							$stoct_price =  $detail[0]['ai_sale_price'];
							$stock_qty = $_POST['strow_'.$stoc->id];
							$total = $detail[0]['ai_sale_price'] * $_POST['strow_'.$stoc->id];
						}else{
							$stock_id .= ','.$stoc->id;
							$stoct_price .= ','.$detail[0]['ai_sale_price'];
							$stock_qty .= ','.$_POST['strow_'.$stoc->id];
							$total += $detail[0]['ai_sale_price'] * $_POST['strow_'.$stoc->id];
						}
						$i++;
					}
				}
				$data['users_id'] = $this->input->post('doc_id');
				$data['admin_id'] = $this->session->userdata('user_id');
				$data['semen_stock_id'] = $stock_id;
				$data['semen_stock_price'] = $stoct_price;
				$data['semen_stock_qty'] = $stock_qty;
				$data['sheath_qty'] = $this->input->post('sheath');
				$data['gas_qty'] = $this->input->post('gas');
				$data['gloves_qty'] = $this->input->post('gloves');
				$data['invoice_total'] = $total;
				$data['date'] = date('y-m-d');
				// print_r($data);
				// exit;
				$last_id = $this->api_model->submit('semen_invoice_performa', $data);
				$this->session->set_flashdata('add_bank','Your Semen Stock has been successfully  Transfered');
				redirect('admin/invoice/'.$last_id);
			}else{
				// echo "this is test";
				// echo "Quantity is more then available stock (".$error.") or Out of stock";
				$this->session->set_flashdata('add_bank','Quantity is more then available stock ('.$error.') or Out of stock');
				$id='';
				$type='';
				$data['doc_id'] = $id;
				$data['doc_type'] = $type;
				$data['stock_data'] = $_POST['stock_data'];
				$data['data'] = $this->api_model->get_bank();
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_stock_by_transfer', $data);
				$this->load->view('admin/layouts/admin_footer');
			 }
		}
		else if($_POST['submit']){
			$data['doc_id'] = $id;
			$data['doc_type'] = $type;
			$data['stock_data'] = $_POST['stock_data'];
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_stock_by_transfer', $data);
			$this->load->view('admin/layouts/admin_footer');
			
		}else{
			$data['doc_id'] = $id;
			$data['doc_type'] = $type;
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');	
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_stock_by_transfer', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function get_product_category(){
		$section = $this->input->get_post('section');
		$data = $this->api_model->get_product_main_cate($section);
		print_r($data);
		//echo json_decode($data);
	}
	public function invoice($id){
		//print_r($_REQUEST);
		$data['data'] = $this->api_model->get_invoice_id($id);
		// echo "<pre>";
		// print_r($data);
		// $this->load->view('admin/layouts/admin_header');	
		// $this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/admin_invoice', $data);
		//$this->load->view('admin/layouts/admin_footer');
		//print_r($data);
	}
	public function language_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->language_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_language_count($name);
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
	public function district_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->district_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_district_count($name);
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
	public function language_status(){
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_activate'] = $status;
		if($this->api_model->language_status($id, $data))
		{
			$product_data = $this->api_model->language_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_language_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function get_last_log_id_web(){
		$users_id = $this->input->get_post('users_id');
		$type = $this->input->get_post('type');
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
			$data['user_type'] = $user_type;
			$data['premium_bull_type'] = $premium_bull_type;
			$data['request_status'] = isset($request_status) ? $request_status : 0;
			$data['date'] = date('Y-m-d h:i:s');
			$detail['data'] = $this->api_model->insert_log_data($data);
			$detail['data'][0]['order_id'] = "LVAT_".$detail[0]['purchase_id']."";
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
			$detail['data'][0]['razorpayOrderId'] =  json_decode($response);
		}
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/premium_be', $detail);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function add_stock($id){
		$detail = $this->api_model->get_seman_detail($id);
		$bread_name = $this->api_model->get_animal_breed($detail[0]['bread']);
		$data_p['data'] = $detail ;
		$data_p['data'][0]['breed_name'] = $bread_name[0]['breed_name'];
		if($_POST['submit']){
			$data['bull_id'] = $this->input->get_post('bull_id');
			$detail = $this->api_model->get_seman_detail($data['bull_id']);
			$semen_group = $this->api_model->get_data('id ="'.$detail[0]['groups'].'"', 'semen_group','','*');
			$data['farmer_price'] = $semen_group[0]['farmer_price'];
			$data['farmer_offer_price'] = $semen_group[0]['farmer_offer_price'];
			$data['ai_price'] = $semen_group[0]['ai_price'];
			$data['ai_offer_price'] = $semen_group[0]['ai_offer_price'];
			$data['advance_booking_price'] = $semen_group[0]['advance_booking_price'];
			$data['advance_booking_offer_price'] = $semen_group[0]['advance_booking_offer_price'];
			$data['ai_service_price'] = $semen_group[0]['ai_service_price'];
			$data['ai_service_offer_price'] = $semen_group[0]['ai_service_offer_price'];
			$data['company_charges'] = $semen_group[0]['company_charges'];
			$data['company_offer_charges'] = $semen_group[0]['company_offer_charges'];
			// print_r($detail);
			// exit;
			$data['purchase_price'] = $detail[0]['distributor_price'];
			$data['sale_price'] = $detail[0]['price'];
			$data['ai_sale_price'] = $detail[0]['ai_price'];
			$data['batch_no'] = $this->input->get_post('batch_days').'/'.$this->input->get_post('batch_date').'('.$this->input->get_post('batch_num').')';
			$data['rest_stock'] = $this->input->get_post('opening_stock');
			$data['opening_stock'] = $this->input->get_post('opening_stock');
			$data['date'] = date('Y-m-d h:i:s');
			$data['ejacuation_no'] = $this->input->get_post('ejacuation_no');
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$sup_detail = $this->api_model->get_semen_company_id($admin_data[0]['super_admin_id']);
				$data['bank_id'] = $sup_detail[0]['admin_id'];
				$data['type'] = $sup_detail[0]['user_type'];
				$data['admin_id'] = $sup_detail[0]['admin_id'];
			}else{
				$data['bank_id'] =  $_SESSION['user_id'];
				$data['type'] = $_SESSION['type'];
				$data['admin_id'] = $_SESSION['user_id'];
			}
			$data['image'] = $this->input->get_post('image');
			$this->form_validation->set_rules('opening_stock','Please Enter No Of Stock','numeric|required|trim');
			$this->form_validation->set_rules('ejacuation_no','Please Enter Ejacuation No','numeric|required|trim');
			$this->form_validation->set_rules('batch_days','Please Enter Batch No of Days','numeric|required|trim');
			$this->form_validation->set_rules('batch_date','Please Enter Batch date','required|trim');
			$this->form_validation->set_rules('batch_num','Please Enter Straw number','numeric|required|trim');
			if($detail = $this->api_model->add_semen_stock($data)){
				redirect('admin/semen_stock_list');
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_stock', $data_p);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_stock', $data_p);
			$this->load->view('admin/layouts/admin_footer');
		}
		
	}
	public function get_breed(){
		$id = $this->input->get_post('id');
		$data = $this->api_model->get_breed_cat_id($id);
		echo json_encode($data);
	}
	public function sys_user(){
		$data['roles'] = $this->admin_detail->get_role();
        $this->load->view('admin/sys_user', $data);
	}
	public function premium($id, $type){
		$data['type'] = $type;	
		$data['bull_id'] = $id;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/premium', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function state(){
		$this->load->view('admin/state');	
	}
	public function sys_user_search(){
		// print_r($_SESSION);
		// exit;
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$type = $this->input->get_post('type');
		if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
			$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
			$admin_id = $admin_data[0]['super_admin_id'];
			// echo "this is test";
			// exit;
		}else{
			$admin_id = $_SESSION['user_id'];
		}
		$perpage = 10;
		$detail = $this->api_model->sys_user_search($name, $start, $perpage, $type, $admin_id);
		$detail['count'] = $this->api_model->get_sys_user_count($name, $type, $admin_id);
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
	public function state_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->state_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_state_count($name);
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
	public function village(){
		$this->load->view('admin/village');
	}
	
	public function village_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->village_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_village_count($name);
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
	
	public function tehshil_add(){
		if(isset($_POST['submit'])){
			$data['dist_id'] = $this->input->get_post('dist_name');
			$data['tehshil_name'] = $this->input->get_post('name');
			$this->form_validation->set_rules('dist_name','Please Select District','required');
			$this->form_validation->set_rules('name','Please check Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				$data = $this->api_model->ins_tehshil($data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/teshil');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/tehshil_add');
				}
			}else{
				$this->load->view('admin/tehshil_add');
			}
		}else{
			$this->load->view('admin/tehshil_add');
		}
	}
	public function gvh_add(){
		if($_POST['submit']){
			$data['dist_id'] = $this->input->get_post('dist_name');
			$data['tehshil_id'] = $this->input->get_post('tehshil');
			$data['gvh_name'] = $this->input->get_post('name');
			$this->form_validation->set_rules('dist_name','Please Select District','required');
			$this->form_validation->set_rules('tehshil','Please Select District','required');
			$this->form_validation->set_rules('name','Please check Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				$data = $this->api_model->ins_gvh($data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/gvh');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/gvh_add');
				}
			}else{
				$this->load->view('admin/gvh_add');
			}
		}else{
			$this->load->view('admin/gvh_add');
		}
	}
	public function gvd_add(){
		if($_POST['submit']){
			$data['dist_id'] = $this->input->get_post('dist_name');
			$data['tehshil_id'] = $this->input->get_post('tehshil');
			$data['gvh_id'] = $this->input->get_post('gvh');
			$data['gvd_name'] = $this->input->get_post('name');
			$this->form_validation->set_rules('dist_name','Please Select District','required');
			$this->form_validation->set_rules('tehshil','Please Select District','required');
			$this->form_validation->set_rules('gvh','Please Select GVH','required');
			$this->form_validation->set_rules('name','Please check Name Field','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				$data = $this->api_model->ins_gvd($data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/gvd');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/gvd_add');
				}
			}else{
				$this->load->view('admin/gvd_add');
			}
		}else{
			$this->load->view('admin/gvd_add');
		}
	}
	public function employee_report(){
				$result = $this->api_model->get_employee_report();
				header("Content-type: application/csv");
				header("Content-Disposition: attachment; filename=\"employee_report".".csv\"");
				header("Pragma: no-cache");
				header("Expires: 0");
				$handle = fopen('php://output', 'w');
				fputcsv($handle, array('SubDistrict', 'GVH', 'GVD', 'Employee', 'Employee_no', 'village'));
                    $i = 1;
                    foreach ($result as $data) {
                        fputcsv($handle, array($data["SubDistrict"], $data["GVH"], $data["GVD"], $data["Employee"], $data["Employee_no"], $data["village"]));
                        $i++;
                    }
                        fclose($handle);
                    exit;
	}
	public function employee_edit($id){
		if($_POST['submit']){
			$id = $this->input->get_post('id');
			$data['dist_id'] = $this->input->get_post('dist_name');
			$data['tehshil_id'] = $this->input->get_post('tehshil');
			$data['gvh_id'] = $this->input->get_post('gvh');
			$data['gvd_id'] = $this->input->get_post('gvd');
			$data['type'] = $this->input->get_post('user_type');
			$village = $this->input->get_post('village');
			$data['village_id'] = implode(',', $village);
			$data['doc_name'] = $this->input->get_post('name');
			$data['doc_mobile'] = $this->input->get_post('phone');
			$this->form_validation->set_rules('dist_name','Please Select District','required');
			$this->form_validation->set_rules('tehshil','Please Select Sub District','required');
			$this->form_validation->set_rules('phone','Please fill Mobile No','trim|numeric|required');
			$this->form_validation->set_rules('name','Please check Name Field','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				if(isset($village)){
					// $count = $this->api_model->get_employee_count();
					// $data['doc_code'] = 'HPKD'.'000'.$count[0]['count'];
					// $data['doc_pass'] = md5('HPKD'.'000'.$count[0]['count'].'*1');
					//if($detail = $this->api_model->check_mobile_number_employee($data['doc_mobile'])){
					//	$this->session->set_flashdata('add_bank','Mobile No is already Exists Please try again.');
					//	$this->load->view('admin/employee_add');
					//}else{
						$data = $this->api_model->update_employee($data, $id);
						if($data){
							$this->session->set_flashdata('add_bank','Your data is Updated.');
							redirect('admin/employee');
						}else{
							$this->session->set_flashdata('add_bank','Database Error.');
							$data['data'] = $this->api_model->get_employee_detial_id($id);
							$this->load->view('admin/employee_edit',$data);
						}
					//}
				}else{
					$this->session->set_flashdata('add_bank','Please Select Village Field.');
					$data['data'] = $this->api_model->get_employee_detial_id($id);
					$this->load->view('admin/employee_edit',$data);
				}
				
			}else{
				$data['data'] = $this->api_model->get_employee_detial_id($id);
				$this->load->view('admin/employee_edit',$data);
			}
		}else{
		$data['data'] = $this->api_model->get_employee_detial_id($id);
		$this->load->view('admin/employee_edit',$data);
		}
	}
	public function employee_add(){
		if($_POST['submit']){
			$data['dist_id'] = $this->input->get_post('dist_name');
			$data['tehshil_id'] = $this->input->get_post('tehshil');
			$data['gvh_id'] = $this->input->get_post('gvh');
			$data['gvd_id'] = $this->input->get_post('gvd');
			$data['type'] = $this->input->get_post('user_type');
			$village = $this->input->get_post('village');
			$data['village_id'] = implode(',', $village);
			$data['doc_name'] = $this->input->get_post('name');
			$data['doc_mobile'] = $this->input->get_post('phone');
			$this->form_validation->set_rules('dist_name','Please Select District','required');
			$this->form_validation->set_rules('tehshil','Please Select Sub District','required');
			$this->form_validation->set_rules('phone','Please fill Mobile No','trim|numeric|required');
			$this->form_validation->set_rules('name','Please check Name Field','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				if(isset($village)){
					$count = $this->api_model->get_employee_count();
					$data['doc_code'] = 'HPKD'.'000'.$count[0]['count'];
					$data['doc_pass'] = md5('HPKD'.'000'.$count[0]['count'].'*1');
					//if($detail = $this->api_model->check_mobile_number_employee($data['doc_mobile'])){
					//	$this->session->set_flashdata('add_bank','Mobile No is already Exists Please try again.');
					//	$this->load->view('admin/employee_add');
					//}else{
						$data = $this->api_model->ins_employee($data);
						if($data){
							$this->session->set_flashdata('add_bank','Your data is Inserted.');
							redirect('admin/employee');
						}else{
							$this->session->set_flashdata('add_bank','Database Error.');
							$this->load->view('admin/employee_add');
						}
					//}
				}else{
					$this->session->set_flashdata('add_bank','Please Select Village Field.');
					$this->load->view('admin/employee_add');
				}
				
			}else{
				$this->load->view('admin/employee_add');
			}
		}else{
			$this->load->view('admin/employee_add');
		}
	}
	public function unit(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/unit');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function unit_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->unit_status($id, $data))
		{
			$product_data = $this->api_model->unit_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->unit_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function unit_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->unit_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->unit_count($name);
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
	public function package(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/package');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function package_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->package_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->package_count($name);
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
	public function get_packages(){
		$id = $this->input->get_post('id');
		$data = $this->api_model->get_packages_unit_id($id);
		if(!$data){
			$data['error'] = '1';
		}
		echo json_encode($data);
	}
	public function package_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->package_status($id, $data))
		{
			$product_data = $this->api_model->package_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->package_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function colour(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/colour');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function colour_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->colour_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->colour_count($name);
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
	public function colour_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->colour_status($id, $data))
		{
			$product_data = $this->api_model->colour_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->colour_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function add_colour(){
		if($_POST['submit']){
			$data['name'] = $this->input->get_post('name');
			$data['colour'] = $this->input->get_post('color');
			$this->form_validation->set_rules('name','Please Enter Product Name','required|trim');
			$this->form_validation->set_rules('color','Please Enter Colour Code','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				if($_SESSION['status'] == '1'){
					$data['isactive'] = '1';
				}else{
					$data['isactive'] = '0';
				}
				$data = $this->api_model->ins_colour_name($data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/colour');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_colour');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_colour');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_colour');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function section(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/section');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function add_section(){
		if($_POST['submit']){
			$data['name'] = $this->input->get_post('name');
			$this->form_validation->set_rules('name','Please Enter Product Section Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				//echo $_SESSION['status'];
				if($_SESSION['status'] == '1'){
					$data['isactive'] = '1';
				}else{
					$data['isactive'] = '0';
				}
				$data = $this->api_model->ins_section_name($data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/section');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/add_section');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_section');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_section');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function section_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->section_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->section_count($name);
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
	public function section_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->section_status($id, $data))
		{
			$product_data = $this->api_model->section_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->section_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function product_category(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/product_category');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function product_cat($cat_id){
		$pro_data = $this->api_model->product_cat_id($cat_id);
		$i = 0;
		$div .= "<ul class='tree'>";
		foreach($pro_data as $pro){
				if($i == 0){
					$div .= '<li class="tree"><a class="toggle" href="javascript:void(0);" id="'.$pro['id'].'" onclick="node('.$pro['id'].')">'.$pro['cat_name'].'</a>';
					$div .= $this->product_cat($pro['id']);
					$div .='</li>';
				}else{
					$div .= '<li class="tree"><a class="toggle" href="javascript:void(0);" id="'.$pro['id'].'" onclick="node('.$pro['id'].')">'.$pro['cat_name'].'</a>';
					$div .= $this->product_cat($pro['id']);
					$div .= '</li>';
				}
			$i++;
		}
		$div .= '</ul>';
		return $div;
	}
	public function product_category_show(){
		$category = $this->api_model->get_category_main();
		$div = "<ul class='tree'>";
		foreach($category as $cat){
			$div .= '<li ><a class="toggle" href="javascript:void(0);" id="'.$cat['id'].'" onclick="node('.$cat['id'].')">'.$cat['cat_name'].'</a>';
				$data = $this->product_cat($cat['id']);
				$div .= $data;
			$div .= '</li>';
		}
		$div .= "</ul>";
		return $div;
	}
	public function add_product_category(){
		$section['section'] = $this->api_model->get_section();
		$section['category'] = $this->product_category_show();
		if($_POST['submit']){
			$data['cat_name'] = $this->input->get_post('name');
			$section = $this->input->get_post('section');
			$data['section'] = implode(',', $section);
			$data['super_cat_id'] = $this->input->get_post('cat');
			// echo "<pre>";
			// print_r($_POST);
			// print_r($data);
			// exit;
			$this->form_validation->set_rules('name','Please Enter Product Category Name','required|trim');
			// $this->form_validation->set_rules('section','Please Select Product Section First','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				//echo $_SESSION['status'];
				if($_SESSION['status'] == '1'){
					$data['isactive'] = '1';
				}else{
					$data['isactive'] = '0';
				}
				$data = $this->api_model->ins_product_category_name($data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/product_category');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/add_product_category', $section);
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_product_category', $section);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_product_category', $section);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function product_category_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->product_category_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->product_category_count($name);
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
	public function product_category_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->product_category_status($id, $data))
		{
			$product_data = $this->api_model->product_category_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->product_category_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function unit_add(){
		if($_POST['submit']){
			//print_r($_POST);
			$data['name'] = $this->input->get_post('name');
			$data['quantity'] = $this->input->get_post('quantity');
			$data['quantity_fare'] = $this->input->get_post('quantity_fare');
			$data['rate_unit'] = $this->input->get_post('rate_unit');
			$data['rate'] = $this->input->get_post('rate');
			$this->form_validation->set_rules('name','Please Enter Unit Name','required|trim');
			$this->form_validation->set_rules('quantity','Please Enter Unit Quantity','numeric|required|trim');
			$this->form_validation->set_rules('quantity_fare','Please Enter Maximum quantity fare','numeric|required|trim');
			$this->form_validation->set_rules('rate','Please Enter Dilivary Rate','numeric|required|trim');
			$this->form_validation->set_rules('rate_unit','Please Enter Dilivary Rate In','required|callback_select_validate');
			$this->form_validation->set_message('select_validate', 'Please Select Dilivary Rate In');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				$data = $this->api_model->ins_unit($data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/unit');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/unit_add');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/unit_add');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/unit_add');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function package_add(){
		$back_up['unit'] = $this->api_model->get_unit();
		if($_POST['submit']){
			//print_r($_POST);
			$data['name'] = $this->input->get_post('name');
			$data['unit_id'] = $this->input->get_post('unit');
			$data['quantity'] = $this->input->get_post('quantity');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('quantity','Please Enter Quantity','numeric|required|trim');
			$this->form_validation->set_rules('unit','Please Enter Unit','required');
			$this->form_validation->set_error_delimiters('<div class="col-md-12"><div class="error">', '</div></div>');				
			if($this->form_validation->run('add_bank'))
			{
				$data = $this->api_model->ins_package($data);
				if($data){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/package');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/package_add',$back_up);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/package_add', $back_up);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/package_add', $back_up);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function bull_report($id){
		$source_id = $id;
		$result = $this->api_model->get_bull_by_source_id($source_id);
		$bull_source = $id;
		$admin = $this->api_model->get_admin_detail($bull_source);
		if($admin[0]['user_type'] == 2 || $admin[0]['user_type'] == 3 || $admin[0]['user_type'] == 4 || $_SESSION['status'] == 1){
			$admin_list = $this->api_model->get_bank_issuer($bull_source);
			$detail = [];
			if(!empty($admin_list )){
				foreach($admin_list as  $ad){
					if($data = $this->api_model->get_bull_by_source_id($ad['admin_id'])){
						foreach($data as $d){
							$admin_detail = $this->api_model->get_admin_detail($d['bull_source']);
							$d['semen_bank_name'] = $admin_detail[0]['fname'];
							$strow_count = $this->api_model->get_strow_count_by_source_id_bull_id($d['bull_source'], $d['id'], $bull_source);
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
				
			}
		}else{			
			if($data = $this->api_model->get_bull_by_source_id($source_id)){
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
			}
		}
		// echo "<pre>";
		// print_r($json);
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=\"Bull_report".".csv\"");
		header("Pragma: no-cache");
		header("Expires: 0");
		$handle = fopen('php://output', 'w');
		fputcsv($handle, array('Bull id', 'Bull Name', 'D.O.B','Farmer Price', 'AI Price', 'Distributor Price', 'Semen Type', 'Milk Type', 'Progeny Test', 'Semen Bank Name', 'Bull category', 'Bull Breed', "Daughter's Yield(In Lites)"));
			$i = 1;
			foreach ($detail as $data) {
				fputcsv($handle, array($data["bull_id"], $data["bull_name"], $data["dob"], $data['price'], $data['ai_price'], $data['distributor_price'], $data['semen_type'], $data['milk_type'], $data['progini_test'], $data['semen_bank_name'], $data['bull_cat_name'], $data['bull_bread_name'], $data['daughter_yield']));
				$i++;
			}
				fclose($handle);
			exit;
	}
	public function product(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/product');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function product_edit($id){
		if($_POST['submit']){
			// echo "<pre>";
			// print_r($_REQUEST);
			$product_id = $id;
			$data['user'] = $_SESSION['user_id'];
			$data['unit'] = $this->input->get_post('unit');
			$data['name'] = $this->input->get_post('name');
			$data['hight'] = $this->input->get_post('height');
			$data['category'] = $this->input->get_post('cat');
			$data['section'] = implode(',',$this->input->get_post('section'));
			$data['width'] = $this->input->get_post('width');
			$data['brand'] = $this->input->get_post('brand');
			$data['sku'] = $this->input->get_post('sku');
			$data['gst'] = $this->input->get_post('gst');
			$data['color'] = $this->input->get_post('color');
			$data1['description'] = $this->input->get_post('desc');
			$data['discount'] = $this->input->get_post('discount');
			$data1['long_description'] = $this->input->get_post('long_desc');
			$data1['other_description'] = $this->input->get_post('other_desc');
			$data1['language_id'] = $this->input->get_post('language');
			$data1['table'] = 'product';
			$data1['created_on'] = date('Y-m-d');
			$data['images'] = implode(',',$this->input->get_post('pro_image'));
			$data['vedio'] = $this->input->get_post('pro_vedio');
			$data['hub'] = $this->input->get_post('hub');
			$data['hubemp'] = $this->input->get_post('hubemp');
			$composition_name = $this->input->get_post('composition_name');
			$composition_value = $this->input->get_post('composition_value');
			$pack_price_id = $this->input->get_post('pack_price_id');
			$lang_id = $this->input->get_post('lang_id');
			$language = $this->input->get_post('language');
			$long_desc = $this->input->get_post('long_desc');
			$compo_id = $this->input->get_post('compo_id');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('cat','Please Enter Product Category','required|trim');
			$this->form_validation->set_rules('height','Please Enter Hight','required|trim');
			$this->form_validation->set_rules('width','Please Enter Width','required|trim');
			$this->form_validation->set_rules('brand','Please Enter Brand','required|trim');
			$this->form_validation->set_rules('unit','Please Enter Unit','required|trim');
			$this->form_validation->set_rules('sku','Please Enter Sku','required|trim');	
			$this->form_validation->set_rules('color','Please Enter Colour','required|trim');
			// $this->form_validation->set_rules('desc','Please Enter Short Description','required|trim');
			// $this->form_validation->set_rules('long_desc','Please Enter Long Description','required|trim');
			// $this->form_validation->set_rules('other_desc','Please Enter Other Description','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				// echo "<pre>";
				// print_r($data);
				// print_r($_REQUEST);
				
				if($_SESSION['status'] == '1'){
					$data['isactive'] = '1';
				}else{
					$data['isactive'] = '0';
				}
				$detail = $this->api_model->get_data_update('id = "'.$product_id.'"','product', $data);
				if(array_filter($composition_name)){
					$i = 0;
					foreach($composition_name as $com){
						if($com !=''){
							$comp_data['product_id'] = $product_id;
							$comp_data['name'] = $com;
							$comp_data['value'] = $composition_value[$i];
							if($compo_id[$i] != ''){
								$this->api_model->get_data_update('id = "'.$compo_id[$i].'"','product_composition', $comp_data);
							}else{
								$this->api_model->submit('product_composition', $comp_data);
							}
						}
						$i++;
					}
				}
				$pack_id = $this->input->get_post('pack_id');
				$pack_mrp = $this->input->get_post('pack_mrp');
				$pack_sale_price_vt = $this->input->get_post('pack_sale_price_vt');
				$pack_sale = $this->input->get_post('pack_sale');
				if(array_filter($pack_mrp)){
					$i = 0;
					foreach($pack_mrp as $pack){
						if($pack !=''){
							$pack_data['product_id'] = $product_id;
							$pack_data['pack_id'] = $pack_id[$i];
							$pack_data['mrp'] = $pack;
							$pack_data['sale_price'] = $pack_sale[$i];
							$pack_data['vt_sale_price'] = $pack_sale_price_vt[$i];
							if($pack_price_id[$i] != ''){
								$this->api_model->get_data_update('id = "'.$pack_price_id[$i].'"','product_pack_rate', $comp_data);
							}else{
								$this->api_model->submit('product_pack_rate', $comp_data);
							}
						}
						$i++;
					}
				}
				if(array_filter($language)){
					$i = 0;
					foreach($language as $lang){
						if($lang !=''){
							echo "this is test";
							$lang_detail = $this->api_model->get_data('id = "'.$lang.'"', 'language');
							$lang_data['table'] = 'product';
							$lang_data['table_id'] = $product_id;
							$lang_data['language_id'] = $lang;
							$lang_data['language_code'] = $lang_detail[0]['code'];
							$lang_data['description'] = $long_desc[$i];
							$lang_data['is_activated'] = '1';
							$lang_data['created_on'] = date('Y-m-d');
							if($lang_id[$i] != ''){
								$this->api_model->get_data_update('id = "'.$lang_id[$i].'"','different_language_details', $lang_data);
							}else{
								$this->api_model->submit('different_language_details', $lang_data);
							}
						}
						$i++;
					}
				}
				 
				$this->session->set_flashdata('add_bank','Your data is Updated.');
				redirect('admin/product');
			}else{
				// echo validation_errors(); 
				// exit;
				$data = $this->api_model->get_data('id = '.$id.'', 'product');
				$data = $data[0];
				$data['unit1'] = $this->api_model->get_unit();
				$data['sku_num'] = 'LIVE'.$this->api_model->get_product_last_id().'ECOM';
				//$data['category'] = $this->api_model->get_product_cat();
				$data['section1'] = $this->api_model->get_section();
				//$data['name'] = $this->api_model->get_productname();
				$data['color1'] = $this->api_model->get_color();
				$data['package'] = $this->api_model->get_package($data[0]['unit']);
				$data['product_hub'] = $this->api_model->get_data('type ="30"', 'admin');
				$count = $this->api_model->product_count();
				$data['category1'] = $this->product_category_show();
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/product_edit', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data = $this->api_model->get_data('id = '.$id.'', 'product');
			$data = $data[0];
			$data['unit1'] = $this->api_model->get_unit();
			$data['sku_num'] = 'LIVE'.$this->api_model->get_product_last_id().'ECOM';
			//$data['category'] = $this->api_model->get_product_cat();
			$data['section1'] = $this->api_model->get_section();
			//$data['name'] = $this->api_model->get_productname();
			$data['color1'] = $this->api_model->get_color();
			$data['package'] = $this->api_model->get_package($data[0]['unit']);
			$data['product_hub'] = $this->api_model->get_data('type ="30"', 'admin');
			$count = $this->api_model->product_count();
			$data['category1'] = $this->product_category_show();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/product_edit', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function product_add(){
		if($_POST['submit']){
			//print_r($_SESSION);
			//echo "<pre>";
			// print_r($_POST);
			// exit;
			// echo "</br>";
			$data['user'] = $_SESSION['user_id'];
			$data['unit'] = $this->input->get_post('unit');
			$data['name'] = $this->input->get_post('name');
			$data['hight'] = $this->input->get_post('height');
			$data['category'] = $this->input->get_post('cat');
			$data['section'] = implode(',',$this->input->get_post('section'));
			$data['width'] = $this->input->get_post('width');
			$data['brand'] = $this->input->get_post('brand');
			$data['sku'] = $this->input->get_post('sku');
			$data['color'] = $this->input->get_post('color');+
			$data1['description'] = $this->input->get_post('desc');
			$data['discount'] = $this->input->get_post('discount');
			$data1['long_description'] = $this->input->get_post('long_desc');
			$data1['other_description'] = $this->input->get_post('other_desc');
			$data1['language_id'] = $this->input->get_post('language');
			$data1['table'] = 'product';
			$data1['created_on'] = date('Y-m-d');
			$data['images'] = implode(',',$this->input->get_post('pro_image'));
			$data['vedio'] = $this->input->get_post('pro_vedio');
			$data['hub'] = $this->input->get_post('hub');
			$data['hubemp'] = $this->input->get_post('hubemp');
			$composition_name = $this->input->get_post('composition_name');
			$composition_value = $this->input->get_post('composition_value');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('cat','Please Enter Product Category','required|trim');
			$this->form_validation->set_rules('height','Please Enter Hight','required|trim');
			$this->form_validation->set_rules('width','Please Enter Width','required|trim');
			$this->form_validation->set_rules('brand','Please Enter Brand','required|trim');
			$this->form_validation->set_rules('unit','Please Enter Unit','required|trim');
			$this->form_validation->set_rules('sku','Please Enter Sku','required|trim');	
			$this->form_validation->set_rules('color','Please Enter Colour','required|trim');
			$this->form_validation->set_rules('desc','Please Enter Short Description','required|trim');
			$this->form_validation->set_rules('long_desc','Please Enter Long Description','required|trim');
			$this->form_validation->set_rules('other_desc','Please Enter Other Description','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank'))
			{
				if($_SESSION['status'] == '1'){
					$data['isactive'] = '1';
				}else{
					$data['isactive'] = '0';
				}
				$detail = $this->api_model->submit('product', $data);
				$data1['table_id'] = $detail;
				$language_desc = $this->api_model->submit('different_language_details', $data1);
				if(array_filter($composition_name)){
					$i = 0;
					foreach($composition_name as $com){
						if($com !=''){
							$comp_data['product_id'] = $detail;
							$comp_data['name'] = $com;
							$comp_data['value'] = $composition_value[$i];
							$this->api_model->submit('product_composition', $comp_data);
						}
						$i++;
					}
				}
				$pack_id = $this->input->get_post('pack_id');
				$pack_mrp = $this->input->get_post('pack_mrp');
				$pack_sale_price_vt = $this->input->get_post('pack_sale_price_vt');
				$pack_sale = $this->input->get_post('pack_sale');
				if(array_filter($pack_mrp)){
					$i = 0;
					foreach($pack_mrp as $pack){
						if($pack !=''){
							$pack_data['product_id'] = $detail;
							$pack_data['pack_id'] = $pack_id[$i];
							$pack_data['mrp'] = $pack;
							$pack_data['sale_price'] = $pack_sale[$i];
							$pack_data['vt_sale_price'] = $pack_sale_price_vt[$i];
							$this->api_model->submit('product_pack_rate',$pack_data);
						}
						$i++;
					}
				}
				 
				$this->session->set_flashdata('add_bank','Your data is Inserted.');
				redirect('admin/product');
			}else{
				// echo validation_errors(); 
				// exit;
				$this->session->set_flashdata('add_bank',validation_errors());
				$data['unit'] = $this->api_model->get_unit();
				$data['sku_num'] = 'LIVE'.$this->api_model->get_product_last_id().'ECOM';
				$data['category'] = $this->api_model->get_product_cat();
				$data['section'] = $this->api_model->get_section();
				$data['name'] = $this->api_model->get_productname();
				$data['color'] = $this->api_model->get_color();
				$count = $this->api_model->product_count();
				$data['category1'] = $this->product_category_show();
				$data['sku_no'] = 'LIVE_'.$count+1;
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_product', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['unit'] = $this->api_model->get_unit();
			$data['sku_num'] = 'LIVE'.$this->api_model->get_product_last_id().'ECOM';
			$data['category'] = $this->api_model->get_product_cat();
			$data['section'] = $this->api_model->get_section();
			$data['name'] = $this->api_model->get_productname();
			$data['color'] = $this->api_model->get_color();
			$data['package'] = $this->api_model->get_package();
			$data['product_hub'] = $this->api_model->get_data('type ="30"', 'admin');
			$count = $this->api_model->product_count();
			$data['category1'] = $this->product_category_show();
			$data['sku_no'] = 'LIVE_'.$count+1;
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_product', $data);
			//$this->load->view('admin/product_add', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function get_hub_employee(){
		$id = $this->input->get_post('admin_id');
		$data = $this->api_model->get_data('type = "31" AND super_admin_id = "'.$id.'"', 'admin');
		$html = '';
		$html = "<option>Select Hub Employee</option>";
		foreach($data as $da){
			$html .= "<option value='".$da['admin_id']."'>".$da['fname']."</option>";
		}
		echo $html;
	}
	public function product_view($id){
		$data['data'] = $this->api_model->product_id($id);
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/product_view', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function product_lead($product_id){
		$data['data'] = $this->admin_detail->get_product_lead($product_id);
		// print_r($data);
		// exit;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/product_lead', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function product_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->product_search($name, $start, $perpage);
		if($detail)
		{
			$data = [];
			foreach($detail as $de){
				$image = explode(',',$de['images']);
				$de['images'] = base_url().'uploads/product/'.$image[0];
				$data[] = $de;
			}
		}
		else
		{
			$json_data['error'] = '1';
		}
		$data['count'] = $this->api_model->product_count($name);
		$json_data = $data;
		echo json_encode($json_data);
	}
	public function product_livetoc_status(){
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$start = $this->input->get_post('start');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['livestoc_status'] = $status;
		if($this->api_model->update('id', $id, 'product', $data))
		{
			$product_data = $this->api_model->product_search($name, $start, $perpage);
			$product_data['count']= $this->api_model->product_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function product_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$start = $this->input->get_post('start');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->api_model->update('id', $id, 'product', $data))
		{
			$product_data = $this->api_model->product_search($name, $start, $perpage);
			$product_data['count']= $this->api_model->product_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	
	public function add_village(){
		if($_POST['submit']){
			//$data['dist_id'] = $this->input->get_post('dist_name');
			$data['tehshil_code'] = $this->input->get_post('tehshil');
			$data['vill_name'] = $this->input->get_post('name');
			$data['village_code'] = $this->input->get_post('vill_code');
			$this->form_validation->set_rules('dist_name','Please Select District','required');
			$this->form_validation->set_rules('tehshil','Please Select District','required');
			$this->form_validation->set_rules('name','Please check Name Field','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				if($detail = $this->api_model->check_village_code($data['village_code'])){
					$this->session->set_flashdata('add_bank','This Village Code is already associated with another village');
						$this->load->view('admin/add_village');
				}else{
					$data = $this->api_model->ins_village($data);
					if($data){
						$this->session->set_flashdata('add_bank','Your data is Inserted.');
						redirect('admin/village');
					}else{
						$this->session->set_flashdata('add_bank','Database Error.');
						$this->load->view('admin/add_village');
					}
				}
			}else{
				$this->load->view('admin/add_village');
			}
		}else{
			$this->load->view('admin/add_village');
		}
	}
	public function teshil(){
		$this->load->view('admin/teshil');
	}
	public function get_tehshil(){
		$dist_id = $this->input->get_post('id');
		$data = $this->api_model->get_tehshil($dist_id);
		if($data){
			$json_data = $data;
		}else{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
	}
	public function get_gvh(){
		$dist_id = $this->input->get_post('id');
		$data = $this->api_model->get_gvh($dist_id);
		if($data){
			$json_data = $data;
		}else{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
	}
	public function get_village(){
		$dist_id = $this->input->get_post('id');
		$data = $this->api_model->get_village($dist_id);
		if($data){
			$json_data = $data;
		}else{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
	}
	public function get_gvd(){
		$dist_id = $this->input->get_post('id');
		$data = $this->api_model->get_gvd($dist_id);
		if($data){
			$json_data = $data;
		}else{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
	}
	public function teshil_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->teshil_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_teshil_count($name);
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
	public function gvh(){
		$this->load->view('admin/gvh');
	}
	public function gvh_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->gvh_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_gvh_count($name);
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
	public function gvd(){
		$this->load->view('admin/gvd');
	}
	public function gvd_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->gvd_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_gvd_count($name);
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
	public function employee(){
		$this->load->view('admin/employee');
	}
	public function employee_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->employee_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_employee_count($name);
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
	public function sys_user_add(){
		if(isset($_POST['submit'])){
			$data['email'] = $this->input->get_post('email');
			$data['fname'] = $this->input->get_post('login_name');
			$data['password'] = md5($this->input->get_post('password'));
			$data['type'] = $this->input->get_post('role');		
			if($data['type'] == '19'){
				$data['user_type'] = '9';
				$data['super_admin_id'] = $_SESSION['user_id'];
			}
			if($_SESSION['type'] == '2' || $_SESSION['type'] == '3' || $_SESSION['type'] == '4'){
				$data['user_type'] = '10';
				$data['super_admin_id'] = $_SESSION['user_id'];
			}
			if($_SESSION['type'] == '5' || $_SESSION['type'] == '1'){
				$data['user_type'] = '11';
				$data['super_admin_id'] = $_SESSION['user_id'];
			}
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$data['super_admin_id'] = $admin_data[0]['super_admin_id'];
			}
			$this->form_validation->set_rules('role','Please check role','required');
			$this->form_validation->set_rules('password','Please check password','required|trim');
			$this->form_validation->set_rules('email','Please check email','required|trim');
			$this->form_validation->set_rules('login_name','Please check Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="col-md-12" style="color:red;text-align:center;">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				$detail = $this->api_model->add_sys_user($data);
				if($detail){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/sys_user');
				}else{
					$this->session->set_flashdata('add_bank','There is problem with database.');
					redirect('admin/sys_user_add');
				}
			}else{
				$this->load->view('admin/sys_user_add');
			}
		}else{
			$this->load->view('admin/sys_user_add');
		}
	}
	public function siman_bank(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/simam_bank');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function add_bull(){
		if(isset($_POST['submit'])){
			$data['bull_name'] = $this->input->get_post('name');
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$data['bull_source'] = $admin_data[0]['super_admin_id'];
			}else{
				$data['bull_source'] = $this->input->get_post('bull_source');
			}
			$data['category'] = $this->input->get_post('category');
			$data['bread'] = $this->input->get_post('bread');
			$data['sires_breed'] = $this->input->get_post('sire_bread');
			$data['dams_breed'] = $this->input->get_post('Dam_bread');
			$data['lat_yield'] = $this->input->get_post('lat_yield');
			$data['daughter_yield'] = $this->input->get_post('daughter_yield');
			$data['total_milk_fat'] = $this->input->get_post('total_milk_fat');
			$data['star_cat'] = $this->input->get_post('star_cat');
			$data['avg_milk_proteen'] = $this->input->get_post('avg_milk_proteen');
			$data['bull_bank_name'] = $this->input->get_post('bull_bank_name');
			$data['groups'] = $this->input->get_post('groups');
			$data['milk_type'] = $this->input->get_post('milk_type');
			$data['semen_type'] = $this->input->get_post('semen_type');
			$data['progini_test'] = $this->input->get_post('progini_test');
			$data['is_imported'] = $this->input->get_post('is_imported');
			$data['is_certified'] = $this->input->get_post('is_certified');
			$data['total_milk_proteen'] = $this->input->get_post('total_milk_proteen');
			$data['price'] = $this->input->get_post('price');
			$data['ai_price'] = $this->input->get_post('ai_price');
			$data['ai_incentive'] = $this->input->get_post('ai_incentive');
			$data['company_charges'] = $this->input->get_post('company_charges');
			$data['advance_booking_of_semen'] = $this->input->get_post('advance_booking_of_semen');
			$data['created_on'] = date('Y-m-d h:i:s');
			$data['distributor_price'] = $this->input->get_post('distributor_price');
			$data['description'] = $this->input->get_post('description');
			$data['registration_certificate'] = $this->input->get_post('registration');
			$data['brochure'] = $this->input->get_post('brochure');
			$data['health_certificate'] = $this->input->get_post('health');
			$data['progini_record'] = $this->input->get_post('progeny');
			$data['championship_images'] = $this->input->get_post('champion');
			$data['video'] = $this->input->get_post('video');
			$bulls_id = $this->input->get_post('bull_id');
			$data['bull_id'] = $bulls_id;
			$data['bull_no'] = $bulls_id;
			$data['dob'] = $this->input->get_post('dob');
			$data['image'] = $this->input->get_post('bull_photo');
			$this->form_validation->set_rules('bull_id','Bull Id','required|trim');
			$this->form_validation->set_rules('name','Bull Name','required|trim');
			$this->form_validation->set_rules('dob','Date of Birth','required|trim');
			//$this->form_validation->set_rules('daughter_yield',"Daughter's Yield",'required|trim');
			$this->form_validation->set_rules('bull_source','Bull Source','required');
			$this->form_validation->set_rules('sire_bread','Sire Breed','required');
			$this->form_validation->set_rules('Dam_bread','Dam Breed','required');
			$this->form_validation->set_rules('bread','Breed','required');
			$this->form_validation->set_rules('category','Category','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run('add_bull'))
			{
				$detail = $this->api_model->add_bull($data);
				if($detail){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/premium/'.$detail);
				}else{
					$this->session->set_flashdata('add_bank','There is problem with database.');
					redirect('admin/add_bull_record',$data);
				}
			}else{
				$data['data'] = $this->api_model->get_bank();
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				//$this->load->view('admin/add_bull', $data);
				$this->load->view('admin/add_bull_record', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			//$this->load->view('admin/add_bull', $data);
			$this->load->view('admin/add_bull_record', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function edit_bull($id){
		if(isset($_POST['submit'])){
			$id['id'] = $this->input->get_post('id');
			$data['bull_name'] = $this->input->get_post('name');
			$data['category'] = $this->input->get_post('category');
			$data['bread'] = $this->input->get_post('bread');
			$data['sires_breed'] = $this->input->get_post('sire_bread');
			$data['dams_breed'] = $this->input->get_post('Dam_bread');
			$data['lat_yield'] = $this->input->get_post('lat_yield');
			$data['daughter_yield'] = $this->input->get_post('daughter_yield');
			$data['total_milk_fat'] = $this->input->get_post('total_milk_fat');
			$data['avg_milk_proteen'] = $this->input->get_post('avg_milk_proteen');
			$data['bull_bank_name'] = $this->input->get_post('bull_bank_name');
			$data['groups'] = $this->input->get_post('groups');
			$data['milk_type'] = $this->input->get_post('milk_type');
			$data['semen_type'] = $this->input->get_post('semen_type');
			$data['progini_test'] = $this->input->get_post('progini_test');
			$data['is_imported'] = $this->input->get_post('is_imported');
			$data['is_certified'] = $this->input->get_post('is_certified');
			$data['total_milk_proteen'] = $this->input->get_post('total_milk_proteen');
			$data['ai_incentive'] = $this->input->get_post('ai_incentive');
			$data['company_charges'] = $this->input->get_post('company_charges');
			$data['advance_booking_of_semen'] = $this->input->get_post('advance_booking_of_semen');
			$data['price'] = $this->input->get_post('price');
			$data['ai_price'] = $this->input->get_post('ai_price');
			$data['distributor_price'] = $this->input->get_post('distributor_price');
			$data['description'] = $this->input->get_post('description');
			$data['registration_certificate'] = $this->input->get_post('registration');
			$data['brochure'] = $this->input->get_post('brochure');
			$data['health_certificate'] = $this->input->get_post('health');
			$data['progini_record'] = $this->input->get_post('progeny');
			$data['championship_images'] = $this->input->get_post('champion');
			$data['video'] = $this->input->get_post('video');
			$data['bull_id'] = $this->input->get_post('bull_id');
			$data['dob'] = $this->input->get_post('dob');
			$data['image'] = $this->input->get_post('bull_photo');
			$this->form_validation->set_rules('bull_id','Bull Id','required|trim');
			$this->form_validation->set_rules('name','Bull Name','required|trim');
			$this->form_validation->set_rules('dob','Date of Birth','required|trim');
			//$this->form_validation->set_rules('daughter_yield',"Daughter's Yield",'required|trim');
			$this->form_validation->set_rules('bull_source','Bull Source','required');
			$this->form_validation->set_rules('sire_bread','Sire Breed','required');
			$this->form_validation->set_rules('Dam_bread','Dam Breed','required');
			$this->form_validation->set_rules('bread','Breed','required');
			$this->form_validation->set_rules('category','Category','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run('add_bull'))
			{
				$detail = $this->api_model->change_active_status($id, $data);
				if($detail){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/bull/');
				}else{
					$this->session->set_flashdata('add_bank','There is problem with database.');
					redirect('admin/edit_bull/'.$id);
				}
			}else{
				$data['id'] = $id; 
				$data['data'] = $this->api_model->get_bank();
				$data['bull_data'] = $this->api_model->get_seman_detail($id);
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				//$this->load->view('admin/add_bull', $data);
				$this->load->view('admin/add_bull_record', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['id'] = $id; 
			$data['data'] = $this->api_model->get_bank();
			$data['bull_data'] = $this->api_model->get_seman_detail($id);
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/edit_bull_record', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function seman_stock(){
		if(isset($_POST['submit'])){
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$data['bank_id'] = $admin_data[0]['super_admin_id'];
			}else{
				$data['bank_id'] = $this->input->get_post('bull_source');
			}
			//$data['bank_id'] = $this->input->get_post('bull_source');
			$data['bull_id'] = $this->input->get_post('bull_id');
			$data['batch_no'] = $this->input->get_post('batch_no');
			$data['date'] = date('Y-m-d h:i:s');
			$this->form_validation->set_rules('bull_source','Please Select Bull Source','required');
			$this->form_validation->set_rules('bull_id','Please Select Bull ID','required');
			$this->form_validation->set_rules('batch_no','Batch No Required','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run('add_bank'))
			{
				$detail = $this->api_model->input_semem_stock($data);
				if($detail){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/seman_stock');
				}else{
					$this->session->set_flashdata('add_bank','Problem With Database.');
					redirect('admin/seman_stock');
				}
			}else{
				$data['data'] = $this->api_model->get_bank();
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/seman_stock', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/stock_bull', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function get_bull(){
		$bull_source = $this->input->get_post('bull_source');
		$data = $this->api_model->get_bull_by_source_id($bull_source);
		echo json_encode($data);
	}
	public function seman_bank_add(){
		if(isset($_POST['submit'])){
			$data['email'] = $this->input->get_post('email');
			$data['bank_name'] = $this->input->get_post('name');
			$data['fname'] = $this->input->get_post('login_name');
			$data['password'] = md5($this->input->get_post('password'));
			$data['type'] = '8';
			$this->form_validation->set_rules('password','Password of Bank','required|trim');
			$this->form_validation->set_rules('login_name','Login Name of Bank','required|trim');
			$this->form_validation->set_rules('name','Name of Bank','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run('add_bank'))
			{
				$detail = $this->api_model->add_bank($data);
				if($detail){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/seman_bank_add');
				}else{
					$this->session->set_flashdata('add_bank','There is problem with database.');
					redirect('admin/seman_bank_add');
				}
			}
			else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_bank');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_bank');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function add_dary_farms(){
		$submit = $this->input->get_post('submit');
		if(isset($submit)){
			$data['type'] = $this->input->get_post('type');
			$data['farm_name'] = $this->input->get_post('farm_name');
			$data['owner_name'] = $this->input->get_post('owner_name');
			$data['address'] = $this->input->get_post('address');
			$data['location'] = $this->input->get_post('location');
			$data['latitude'] = $this->input->get_post('latitude');
			$data['langitude'] = $this->input->get_post('langitude');
			$data['product'] = $this->input->get_post('product');
			$data['rating'] = $this->input->get_post('rating');
			$animal_type = $this->input->get_post('animal_type');
			$animal_type = implode(',', $animal_type);
			$data['animal_type'] = $animal_type;
			$animal_breed = $this->input->get_post('animal_breed');
			$animal_breed = implode(',', $animal_breed);
			$data['animal_breed'] = $animal_breed;
			$animale_no = $this->input->get_post('animale_no');
			$animale_no = implode(',', $animale_no);
			$data['animale_no'] = $animale_no;
			$this->form_validation->set_rules('type','Dairy type','required|trim');
			$this->form_validation->set_rules('farm_name','Dairy Farm Name','required|trim');
			$this->form_validation->set_rules('owner_name','Dairy Owner Name','required|trim');
			$this->form_validation->set_rules('address','Dairy Address','required|trim');
			$this->form_validation->set_rules('location','Dairy Location','required|trim');
			$this->form_validation->set_rules('latitude','Dairy latitude','required|trim');
			$this->form_validation->set_rules('langitude','Dairy langitude','required|trim');
			$this->form_validation->set_rules('product','Dairy product','required|trim');
			$this->form_validation->set_rules('rating','Dairy rating','required|trim');
			if($this->form_validation->run('dary_farm'))
			{
				$data['emp_id'] = $_SESSION['user_id'];
				$config = array();
				$config['upload_path'] = '/var/www/html/harpahu_dhyan/uploads/company';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '5000';
				$config['overwrite']     = FALSE;	
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ($this->upload->do_upload('Logo')) {
					$upload_data = $this->upload->data();
					$data['image'] = $upload_data['file_name'];
				}
				$this->load->library('upload');
				$files = $_FILES;
				//print_r($files);
				$cpt = count($_FILES['Banner']['name']);
				$name = [];
    			for($i=0; $i<$cpt; $i++){
					 //echo $files['Banner']['name'][$i];
					$_FILES['file']['name']       = $_FILES['Banner']['name'][$i];
					$_FILES['file']['type']       = $_FILES['Banner']['type'][$i];
					$_FILES['file']['tmp_name']   = $_FILES['Banner']['tmp_name'][$i];
					$_FILES['file']['error']      = $_FILES['Banner']['error'][$i];
					$_FILES['file']['size']       = $_FILES['Banner']['size'][$i]; 
					$config = array();
					$config['upload_path'] = '/var/www/html/harpahu_dhyan/uploads/company_banner';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']      = '5000';
					$config['overwrite']     = FALSE;	 
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file')){
						$imageData = $this->upload->data();
						$uploadImgData[] = $imageData['file_name'];
					}
			}
						$image_name = implode(',',$uploadImgData);
						$data['Banner'] = $image_name;
						if($this->admin_detail->add_farm_comp($data)){
							$this->session->set_flashdata('dary_farm','Company created succesfully');
							$this->load->view('admin/layouts/admin_header');
							$this->load->view('admin/layouts/admin_nav');
							$this->load->view('admin/seman_com_reg');
							$this->load->view('admin/layouts/admin_footer');
						}else{
							$this->session->set_flashdata('dary_farm','Problem with database');
							$this->load->view('admin/layouts/admin_header');
							$this->load->view('admin/layouts/admin_nav');
							$this->load->view('admin/seman_com_reg');
							$this->load->view('admin/layouts/admin_footer');
						}
					}else{
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/dary_farm');
						$this->load->view('admin/layouts/admin_footer');
					}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/dary_farm');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function interest_view($id=''){
		if($id == ''){
			redirect(base_url('admin/product_interest'));
		}
		$data['id'] = $id;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/interest_view', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function product_interest_view_status(){
		$id = $this->input->get_post('id');
		$this->api_model->own_query('UPDATE produc_interest SET view_status = "1" where FIND_IN_SET(id, "'.$id.'")');
	}
	public function buy_lead($id = ''){
		if($id == ''){
			redirect(base_url('admin/product_interest'));
		}
		$id = urldecode($id);
		$data['id'] = $id;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/buy_lead', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function add_seman_comp(){
		$submit = $this->input->get_post('submit');
		if(isset($submit)){
			$data['type'] = $this->input->get_post('type');
			$data['bull_id'] = $this->input->get_post('bull_id');
			$data['name'] = $this->input->get_post('name');
			$data['breed_bull'] = $this->input->get_post('breed');
			$data['dob'] = $this->input->get_post('dob');
			$data['phone'] = $this->input->get_post('phone');
			$data['dam_yield'] = $this->input->get_post('dam_yield');
			$data['doughter_yield'] = $this->input->get_post('doughter_yield');
			$data['latitute'] = $this->input->get_post('latitute');
			$data['langitute'] = $this->input->get_post('langitute');
			$data['company_name'] = $this->input->get_post('company_name');
			$data['rating'] = $this->input->get_post('rating');
			$data['contact_person'] = $this->input->get_post('contact_person');
			$data['milk_yield'] = $this->input->get_post('milk_yield');
			$data['avvg_milk_fat'] = $this->input->get_post('avvg_milk_fat');
			$data['total_milk_fat'] = $this->input->get_post('total_milk_fat');
			$data['avg_milk_protein'] = $this->input->get_post('avg_milk_protein');
			$data['total_milk_protein'] = $this->input->get_post('total_milk_protein');
			$data['email'] = $this->input->get_post('email');
			$data['url'] = $this->input->get_post('url');
			$data['address'] = $this->input->get_post('address');
			$data['description'] = $this->input->get_post('description');
			$this->form_validation->set_rules('type','Company Type','required|trim');
			$this->form_validation->set_rules('bull_id','Company Bull id','required|trim');
			$this->form_validation->set_rules('name','Company Name','required|trim');
			$this->form_validation->set_rules('breed','Company Breed','required|trim');
			$this->form_validation->set_rules('dob','Company Dob','required|trim');
			$this->form_validation->set_rules('dam_yield','Company Dam yield','required|trim');
			$this->form_validation->set_rules('doughter_yield','Company Doughter yield','required|trim');
			$this->form_validation->set_rules('latitute','Company latitute','required|trim');
			$this->form_validation->set_rules('langitute','Company langitute','required|trim');
			$this->form_validation->set_rules('company_name','Company Company Name','required|trim');
			$this->form_validation->set_rules('rating','Company Rating','required|trim');
			$this->form_validation->set_rules('contact_person','Company Contact Person','required|trim');
			$this->form_validation->set_rules('milk_yield','Company Milk Yield','required|trim');
			$this->form_validation->set_rules('avvg_milk_fat','Company Avg milk fat','required|trim');
			$this->form_validation->set_rules('total_milk_fat','Company Total Milk Fat','required|trim');
			$this->form_validation->set_rules('avg_milk_protein','Company Avg milk protein','required|trim');
			$this->form_validation->set_rules('total_milk_protein','Company Total milk protein','required|trim');
			$this->form_validation->set_rules('email','Company Email','required|trim');
			$this->form_validation->set_rules('url','Company url','required|trim');
			$this->form_validation->set_rules('address','Company Address','required|trim');
			$this->form_validation->set_rules('description','Company Description','required|trim');
			if($this->form_validation->run('sem_com_profile'))
			{
				$data['emp_id'] = $_SESSION['user_id'];
				$config = array();
				$config['upload_path'] = '/var/www/html/harpahu_dhyan/uploads/company';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '5000';
				$config['overwrite']     = FALSE;	
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ($this->upload->do_upload('Logo')) {
					$upload_data = $this->upload->data();
					$data['image'] = $upload_data['file_name'];
					$pro_id = $data['name'];
				}
				$config = array();
				$config['upload_path'] = '/var/www/html/harpahu_dhyan/uploads/company_banner';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '5000';
				$config['overwrite']     = FALSE;	
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ($this->upload->do_upload('Banner')) {
					$upload_data = $this->upload->data();
					$data['banner'] = $upload_data['file_name'];
					$pro_id = $data['name'];
				}
				if($this->admin_detail->seman_company_add($data)){
					$this->session->set_flashdata('com_profile','Company created succesfully');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/seman_com_reg');
					$this->load->view('admin/layouts/admin_footer');
				}else{
					$this->session->set_flashdata('com_profile','Problem with database');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/seman_com_reg');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/seman_com_reg');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/seman_com_reg');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function add_comp(){
		$submit = $this->input->get_post('submit');
		if(isset($submit)){
			$data['type'] = $this->input->get_post('type');
			$data['name'] = $this->input->get_post('name');
			$data['brand'] = $this->input->get_post('brand');
			$data['contact_person'] = $this->input->get_post('con_per');
			$data['phone'] = $this->input->get_post('phone');
			$data['location'] = $this->input->get_post('loc');
			$data['rating'] = $this->input->get_post('rating');
			$data['product'] = $this->input->get_post('product');
			$data['address'] = $this->input->get_post('address');
			$data['latitude'] = $this->input->get_post('latitute');
			$data['longitude'] = $this->input->get_post('langitute');
			$data['email'] = $this->input->get_post('email');
			$data['url'] = $this->input->get_post('url');
			$data['description'] = $this->input->get_post('description');
			$this->form_validation->set_rules('type','Company Type','required|trim');
			$this->form_validation->set_rules('name','Company Name','required|trim');
			$this->form_validation->set_rules('brand','Company brand','required|trim');
			$this->form_validation->set_rules('rating','Company Rating','required|trim');
			$this->form_validation->set_rules('con_per','Company Concern Person','required|trim');
			$this->form_validation->set_rules('phone','Company Phone','required|trim');
			$this->form_validation->set_rules('loc','Company City','required|trim');
			$this->form_validation->set_rules('product','Company Product','required|trim');
			$this->form_validation->set_rules('email','Company Email','required|trim');
			$this->form_validation->set_rules('url','Company url','required|trim');
			$this->form_validation->set_rules('address','Company address','required|trim');
			$this->form_validation->set_rules('description','Company description','required|trim');
			$this->form_validation->set_rules('latitute','Company Latitute','required|trim');
			$this->form_validation->set_rules('langitute','Company Langitute','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run('com_profile'))
			{
				$data['emp_id'] = $_SESSION['user_id'];
				$config = array();
				$config['upload_path'] = '/var/www/html/harpahu_dhyan/uploads/company';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '5000';
				$config['overwrite']     = FALSE;	
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ($this->upload->do_upload('Logo')) {
					$upload_data = $this->upload->data();
					$data['logo'] = $upload_data['file_name'];
					$pro_id = $data['name'];
				}
				$config = array();
				$config['upload_path'] = '/var/www/html/harpahu_dhyan/uploads/company_banner';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '5000';
				$config['overwrite']     = FALSE;	
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ($this->upload->do_upload('Banner')) {
					$upload_data = $this->upload->data();
					$data['banner'] = $upload_data['file_name'];
					$pro_id = $data['name'];
				}
				if($this->admin_detail->company_add($data)){
					$this->session->set_flashdata('com_profile','Company created succesfully');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/company_reg');
					$this->load->view('admin/layouts/admin_footer');
				}else{
					$this->session->set_flashdata('com_profile','Problem with database');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/company_reg');
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/company_reg');
				$this->load->view('admin/layouts/admin_footer');
			}

		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/company_reg');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function dashboard()
	{
		$id = $this->session->userdata('user_id');
		$user_detail = $this->admin_detail->get_detail($id);
		//uncomment code for dsiplay records in deshboard
		$user_data['farmer'] = $this->admin_detail->getfarmer_count();
		$user_data['counstomer'] = $this->admin_detail->getcoustomer_count();
		$user_data['product'] = $this->admin_detail->getproduct_count();
		$user_data['order_count'] = $this->admin_detail->getorder_count();
		
		if($user_detail[0]['type'] == '11'){
			$user_data['doc_count'] = $this->api_model->get_count_doc('pvt_doc');
			$user_data['vt_count'] = $this->api_model->get_count_doc('pvt_vt');
			$user_data['ai_count'] = $this->api_model->get_count_doc('pvt_ai');
		}else{
			$user_data['user_data'] = $user_detail;
			$name = $user_detail[0]['name'];
		}
		//$this->session->set_userdata('user_name', $name );
		$this->load->view('admin/dashboard', $user_data);
	}
	public function user_profile()
	{
		$id = $this->session->userdata('user_id');
		$this->load->model('user_detail');
		$user_detail = $this->user_detail->get_detail($id);
		$user_data['user_data'] = $user_detail;
		$this->load->view('admin/profile', $user_data);
	}
	public function bull(){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/bull');
				$this->load->view('admin/layouts/admin_footer');
	}
	public function add_subuser($type){
		if($_POST['submit']){	
			if($_SESSION['status'] == 1){
				$data['super_admin_id'] = $_SESSION['user_id']; 
			}else{
				$super_id = $_SESSION['user_id'];
				$data['super_admin_id'] = isset($super_id) ? $super_id : 0;
			}
			$data['image'] = $this->input->get_post('image');
			$data['bank_name'] = $this->input->get_post('name');
			$data['fname'] = $this->input->get_post('name');
			$data['email'] = $this->input->get_post('email');
			$data['password'] = md5($this->input->get_post('password'));
			$data['mobile'] = $this->input->get_post('mobile');
			$data['user_type'] = $this->input->get_post('user_type');
			$data['type'] = $this->input->get_post('type');
			$data['s_s_grade'] = $this->input->get_post('grade');
			$data['semen_bank_type'] = $this->input->get_post('authority_type');
			$data['address'] = $this->input->get_post('address1').$this->input->get_post('address2');
			$service_district = $this->input->get_post('district1');
			$service_state = $this->input->get_post('state1');
			$data['service_state'] = $service_state;
			$data['service_district'] = $service_district;
			$data['district'] = $this->input->get_post('district');
			$data['state'] = $this->input->get_post('state');
			$data['pin'] = $this->input->get_post('pin');
			$type_user = $this->input->get_post('type_user');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('email','Please Enter Email','required|trim');
			$this->form_validation->set_rules('mobile','Please Enter mobile','numeric|required|trim');
			if($type_user == 1){
				$this->form_validation->set_rules('grade','Please Enter Choose Grade.','required');
				$this->form_validation->set_rules('authority_type','Please Enter Semen Bank/Authority Type','required');
			}
			$this->form_validation->set_rules('address1','Please Enter Address','required|trim');
			$this->form_validation->set_rules('district1','Please Enter Service District','required');
			$this->form_validation->set_rules('state1','Please Enter Service State','required');
			$this->form_validation->set_rules('district','Please Enter District','required');
			$this->form_validation->set_rules('state','Please Enter State','required');
			$this->form_validation->set_message('pin', 'Please Enter Pin','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				$data['created_on'] = date('Y-m-d h:i:s');
				if($this->api_model->comp_mobile_email($data['mobile'])){
					$this->session->set_flashdata('add_bank','Mobile No is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_subuser', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
				else if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
					if($detail = $this->api_model->add_bank($data)){
							$this->session->set_flashdata('add_bank','Your data is Inserted.');
							if($type == 1){
								redirect('admin/sub_user');
							}else if($type == 2){
								redirect('admin/distributors');
							} else if($type == 3){
								redirect('admin/suppliers');
							}
							
					}else{
						$this->session->set_flashdata('add_bank','Error with database');
						$data['type'] = $this->input->get_post('type_user');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/add_subuser', $data);
						$this->load->view('admin/layouts/admin_footer');
					}
				}else{
					$this->session->set_flashdata('add_bank','Email ID is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/add_subuser', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				$data['type'] = $this->input->get_post('type_user');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/add_subuser', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$data['type'] = $type;
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/add_subuser', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function transfer_semen($id, $type){
		if($_POST['final']){
			// print_r($_POST);
			// exit;
			$stock_data = json_decode($_POST['stock_data']);
			$i = 0;
			$y = 0;
			$error = 0;
			foreach($stock_data->data as $stoc){
				if($_POST['strow_'.$stoc->id]){
					$detail = $this->api_model->get_semen_stock_id($stoc->id);
					if($_POST['strow_'.$stoc->id] > $detail[0]['rest_stock']){
						if($y == 0){
							$error = '#'.$stoc->id;
						}else{
							$error .= ',#'.$stoc->id;
						}
						$y++;
					}
				}
				$i++;
			}
			if($error === 0){
				$i = 0;
				foreach($stock_data->data as $stoc){
					if($_POST['strow_'.$stoc->id]){
						$detail = $this->api_model->get_semen_stock_id($stoc->id);
						// echo "<pre>";
						// print_r($detail);
						// exit;
						$data['bull_id'] = $detail[0]['bull_id'];
						$data['stock_id'] = $detail[0]['id'];
						$data['batch_no'] = $detail[0]['batch_no'];
						$data['rest_stock'] = $_POST['strow_'.$stoc->id];
						$data['opening_stock'] =$_POST['strow_'.$stoc->id];
						$data['date'] = date('Y-m-d h:i:s');
						$data['bank_id'] = $detail[0]['bank_id'];
						$data['type'] = $this->input->get_post('doc_type');
						$data['farmer_price'] = $detail[0]['farmer_price'];
						$data['ai_farmer_price'] = $detail[0]['farmer_price'];
						$data['farmer_offer_price'] = $detail[0]['farmer_offer_price'];
						$data['ai_price'] = $detail[0]['ai_price'];
						$data['ai_offer_price'] = $detail[0]['ai_offer_price'];
						$data['advance_booking_price'] = $detail[0]['advance_booking_price'];
						$data['advance_booking_offer_price'] = $detail[0]['advance_booking_offer_price'];
						$data['ai_service_price'] = $detail[0]['ai_service_price'];
						$data['ai_service_offer_price'] = $detail[0]['ai_service_offer_price'];
						$data['company_charges'] = $detail[0]['company_charges'];
						$data['company_offer_charges'] = $detail[0]['company_offer_charges'];
						$data['ai_incentive'] = $detail[0]['ai_incentive'];
						$data['ai_offer_incentive'] = $detail[0]['ai_offer_incentive'];
						$data['image'] = $detail[0]['image'];
						$data['bank_id'] = $detail[0]['bank_id'];
						$data['purchase_price'] = $detail[0]['purchase_price'];
						$data['ejacuation_no'] = $detail[0]['ejacuation_no'];
						$data['sale_price'] = $detail[0]['sale_price'];
						$data['ai_sale_price'] = $detail[0]['ai_sale_price'];	
						$data['admin_id'] = $this->input->get_post('doc_id');
						$deta = $this->api_model->add_semen_stock($data);
						$stock['rest_stock'] = $detail[0]['rest_stock'] - $_POST['strow_'.$stoc->id];
						$this->api_model->update_semen_stock($detail[0]['id'], $stock);
						$i++;
					}
				}
				$this->session->set_flashdata('add_bank','Your Semen Stock has been successfully  Transfered');
				redirect('admin/dashboard');
			}else{
				// echo "this is test";
				// echo "Quantity is more then available stock (".$error.") or Out of stock";
				$this->session->set_flashdata('add_bank','Quantity is more then available stock ('.$error.') or Out of stock');
				$id='';
				$type='';
				$data['doc_id'] = $id;
				$data['doc_type'] = $type;
				$data['stock_data'] = $_POST['stock_data'];
				$data['data'] = $this->api_model->get_bank();
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_stock_transfer', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}
		else if($_POST['submit']){
			$data['doc_id'] = $id;
			$data['doc_type'] = $type;
			$data['stock_data'] = $_POST['stock_data'];
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_stock_transfer', $data);
			$this->load->view('admin/layouts/admin_footer');
			
		}else{
			$data['doc_id'] = $id;
			$data['doc_type'] = $type;
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_stock_transfer', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function semen_stock_by_transfer(){
			if($_POST['final']){
			$stock_data = json_decode($_POST['stock_data']);
			$i = 0;
			$y = 0;
			$error = 0;
			//print_r($stock_data);
			foreach($stock_data->data as $stoc){
				if($_POST['strow_'.$stoc->id]){
					$detail = $this->api_model->get_semen_stock_id($stoc->id);
					if($_POST['strow_'.$stoc->id] > $detail[0]['rest_stock']){
						if($y == 0){
							$error = '#'.$stoc->id;
						}else{
							$error .= ',#'.$stoc->id;
						}
						$y++;
					}
				}
				$i++;
			}
			if($error === 0){
				$i = 0;
				foreach($stock_data->data as $stoc){
					if($_POST['strow_'.$stoc->id]){
						$detail = $this->api_model->get_semen_stock_id($stoc->id);
						//print_r($detail);
						if($i == 0){
							$stock_id = $stoc->id;
							$stoct_price =  $detail[0]['ai_sale_price'];
							$stock_qty = $_POST['strow_'.$stoc->id];
							$total = $detail[0]['ai_sale_price'] * $_POST['strow_'.$stoc->id];
						}else{
							$stock_id .= ','.$stoc->id;
							$stoct_price .= ','.$detail[0]['ai_sale_price'];
							$stock_qty .= ','.$_POST['strow_'.$stoc->id];
							$total += $detail[0]['ai_sale_price'] * $_POST['strow_'.$stoc->id];
						}
						$i++;
					}
				}
				$data['users_id'] = $this->input->post('doc_id');
				$data['admin_id'] = $this->session->userdata('user_id');
				$data['semen_stock_id'] = $stock_id;
				$data['semen_stock_price'] = $stoct_price;
				$data['semen_stock_qty'] = $stock_qty;
				$data['sheath_qty'] = $this->input->post('sheath');
				$data['gas_qty'] = $this->input->post('gas');
				$data['gloves_qty'] = $this->input->post('gloves');
				$data['invoice_total'] = $total;
				$data['date'] = date('y-m-d');
				$last_id = $this->api_model->submit('semen_invoice_performa', $data);
				$this->session->set_flashdata('add_bank','Your Semen Stock has been successfully  Transfered');
				redirect('admin/invoice/'.$last_id);
			}else{
				// echo "this is test";
				// echo "Quantity is more then available stock (".$error.") or Out of stock";
				$this->session->set_flashdata('add_bank','Quantity is more then available stock ('.$error.') or Out of stock');
				$id='';
				$type='';
				$data['doc_id'] = $id;
				$data['doc_type'] = $type;
				$data['stock_data'] = $_POST['stock_data'];
				$data['data'] = $this->api_model->get_bank();
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/semen_stock_by_transfer', $data);
				$this->load->view('admin/layouts/admin_footer');
			 }
		}
		else if($_POST['submit']){
			$data['doc_id'] = $id;
			$data['doc_type'] = $type;
			$data['stock_data'] = $_POST['stock_data'];
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_stock_by_transfer', $data);
			$this->load->view('admin/layouts/admin_footer');
		}else{
			$data['doc_id'] = $id;
			$data['doc_type'] = $type;
			$data['data'] = $this->api_model->get_bank();
			$this->load->view('admin/layouts/admin_header');	
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/semen_stock_by_transfer', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function update_profile()
	{
		$id = $this->session->userdata('user_id');
		$this->load->model('user_detail');
		$user_detail = $this->user_detail->get_detail($id);
		$user_data['user_data'] = $user_detail;
		$this->form_validation->set_rules('name','User Name','required|trim');
		$this->form_validation->set_rules('phone','User Phone','required|numeric|trim');
		$this->form_validation->set_rules('email','User Email','required|trim');
		$this->form_validation->set_rules('address','User address','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('user_profile'))
		{
			if($this->input->post('newpassword')!=''){
				if($this->input->post('newpassword')==$this->input->post('confirmpassword')){
					$username = $this->input->post('name');
					$data['password'] = md5($this->input->post('newpassword'));
					$this->session->set_userdata('user_name', $username);
					$data['fname'] = $username;
					$data['mobile'] = $this->input->post('phone');
					$data['address'] = $this->input->post('address');
					$data['email'] = $this->input->post('email');
					$id = $this->session->userdata('user_id');
					if($detail = $this->admin_detail->push_detail($data, $id))
					{
						$user_detail = $this->user_detail->get_detail($id);
						$user_data['user_data'] = $user_detail;
						$this->session->set_flashdata('login_failed','Your Profile Is Updated.');
						$this->load->view('admin/profile',$user_data);
					}
					else
					{
						$this->session->set_flashdata('login_failed','There is problem with Database.');
						return redirect('user_profile');
					}
				}else{
					$this->session->set_flashdata('login_failed','Password and Confirm Password Shuld be Matched.');
					return redirect('user_profile');
				}
			}else{
					$username = $this->input->post('name');
					$this->session->set_userdata('user_name', $username);
					$data['fname'] = $username;
					$data['mobile'] = $this->input->post('phone');
					$data['address'] = $this->input->post('address');
					$data['email'] = $this->input->post('email');
					$id = $this->session->userdata('user_id');
					if($detail = $this->admin_detail->push_detail($data, $id))
					{
						$user_detail = $this->user_detail->get_detail($id);
						$user_data['user_data'] = $user_detail;
						$this->session->set_flashdata('login_failed','Your Profile Is Updated.');
						$this->load->view('admin/profile',$user_data);
					}
					else
					{
						$this->session->set_flashdata('login_failed', validation_errors());
						return redirect('user_profile');
					}
				}
		}
		else
		{	
			$this->session->set_flashdata('login_failed', validation_errors());
			$this->load->view('admin/profile',$user_data);
		}
	} 
	// public function doctor(){
	// 	echo "this is test";
	// }
	public function parvate_order(){
		$this->load->view('admin/paravate_order');
	}
	public function semen_stock_list(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/semen_stock_list');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function sub_user(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/sub_user');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function distributors(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/distributers');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function suppliers(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/suppliers');
		$this->load->view('admin/layouts/admin_footer');
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
																'image_url'=> 'https://www.livestoc.com/assets/home/images/logo.png',
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
	public function push_non_notification($user_id, $type , $title, $flag = 0, $server_key = 0, $key=0, $msg, $img, $fcm_and= '', $fcm_ios = ''){
	
		if($type == 1){
			$detail = $this->api_model->get_fcm_doc($user_id);
		}else if($type == 2){
			$detail = $this->api_model->get_fcm_doc($user_id);
		}else if($type == 3){
			$detail1 = $this->api_model->get_admin_detail($user_id);
			$detail[0]['fcm_android'] = $detail1[0]['fcm_and'];
			$detail[0]['fcm_ios'] = $detail1[0]['fcm_IOS'];
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
																'image_url'=> $img,
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
	public function send_notification($type = '', $is_premium = '', $title = '', $district_id = '', $msg = '', $image = '', $start = '', $perpage = ''){
		$type = $this->input->get_post('type');
		$is_premium = $this->input->get_post('is_premium');
		$title = $this->input->get_post('title');
		$district_id = $this->input->get_post('district_id');
		$msg = $this->input->get_post('msg');
		$image = $this->input->get_post('image');
		$img = base_url().'uploads/bank/'.$image;
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		// print_r($_REQUEST);
		// exit;
		if($type == '2' && $is_premium == '1' ){
			$table = 'doctor';
			$key =  PARAVATE_SERVERKEY;
			$count = $this->api_model->get_data('users_type IN ("pvt_ai", "pvt_vt") AND is_premium = "1" AND district_code = "'.$district_id.'"', 'doctor', '','count(doctor_id) as count');
			$data = $this->api_model->get_data('users_type IN ("pvt_ai", "pvt_vt") AND is_premium = "1" AND district_code = "'.$district_id.'"', $table, '',' if(fcm_android != " ", fcm_android, fcm_ios) as fcm, doctor_id as id ', $start, $perpage);
		}else if($type == '2' && $is_premium == '0' ){
			$table = 'doctor';
			$key =  PARAVATE_SERVERKEY;
			$count = $this->api_model->get_data('users_type IN ("pvt_ai", "pvt_vt") AND is_premium = "0" AND district_code = "'.$district_id.'"', 'doctor', '','count(doctor_id) as count');
			$data = $this->api_model->get_data('users_type IN ("pvt_ai", "pvt_vt") AND is_premium = "0" AND district_code = "'.$district_id.'"', $table, '',' if(fcm_android != " ", fcm_android, fcm_ios) as fcm, doctor_id as id ', $start, $perpage);
		}else if($type == '2' && $is_premium == '' ){
			$table = 'doctor';
			$key =  PARAVATE_SERVERKEY;
			$count = $this->api_model->get_data('users_type IN ("pvt_ai", "pvt_vt") ', 'doctor', '','count(doctor_id) as count');
			$data = $this->api_model->get_data('users_type IN ("pvt_ai", "pvt_vt")', $table, '',' if(fcm_android != " ", fcm_android, fcm_ios) as fcm, doctor_id as id ', $start, $perpage);
		}else if($type == '1' && $is_premium == '1'){
			$table = 'doctor';
			$key =  PARAVATE_SERVERKEY;
			$count = $this->api_model->get_data('users_type = "pvt_doc"  AND is_premium = "1" AND district_code = "'.$district_id.'"', 'doctor', '','count(doctor_id) as count');
			$data = $this->api_model->get_data('users_type = "pvt_doc"  AND is_premium = "1" AND district_code = "'.$district_id.'"', $table, '',' if(fcm_android != " ", fcm_android, fcm_ios) as fcm, doctor_id as id ', $start, $perpage);
		}else if($type == '1' && $is_premium == '0'){
			$table = 'doctor';
			$key =  PARAVATE_SERVERKEY;
			$count = $this->api_model->get_data('users_type = "pvt_doc"  AND is_premium = "0" AND district_code = "'.$district_id.'"', 'doctor', '','count(doctor_id) as count');
			$data = $this->api_model->get_data('users_type = "pvt_doc"  AND is_premium = "0" AND district_code = "'.$district_id.'"', $table, '',' if(fcm_android != " ", fcm_android, fcm_ios) as fcm, doctor_id as id ', $start, $perpage);
		}else if($type == '1' && $is_premium == ''){
			$table = 'doctor';
			$key =  PARAVATE_SERVERKEY;
			$count = $this->api_model->get_data('users_type = "pvt_doc"', 'doctor', '','count(doctor_id) as count');
			$data = $this->api_model->get_data('users_type = "pvt_doc"', $table, '',' if(fcm_android != " ", fcm_android, fcm_ios) as fcm, doctor_id as id ', $start, $perpage);
		}else if($type == '3'){
			$table = 'admin';
			$key =  RETAILER_SERVERKEY;
			$count = $this->api_model->get_data('user_type = "41"', 'admin', '','count(admin_id) as count');
			$data = $this->api_model->get_data('user_type = "41"', $table, '',' if(fcm_and != " ", fcm_and, fcm_ios) as fcm, admin_id as id ', $start, $perpage);
		}else if($type =='0' && $is_premium == '1'){
			$table = 'users';
			$key =  LIVESTOCK_AND_SERVERKEY;
			$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
			$end_data = date('Y-m-d');	
			$count = $this->api_model->query_build('SELECT count(u.users_id) as count FROM (SELECT  (select count(id) from ai_package_log where users_id = users.users_id AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'") as premium,users_id FROM `users` HAVING premium = "1") as u');
			$data = $this->api_model->get_data_having('','premium = "1"', $table, '','(select count(id) from ai_package_log where users_id = users.users_id AND  ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'") as premium, if(fcm_android != " ", fcm_android, fcm_ios) as fcm, users_id as id ', $start, $perpage);
		}else if($type =='0' && $is_premium == '0'){			
			$table = 'users';
			$key =  LIVESTOCK_AND_SERVERKEY;
			$start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
			$end_data = date('Y-m-d');	
			$count = $this->api_model->query_build('SELECT count(u.users_id) as count FROM (SELECT  (select count(id) from ai_package_log where users_id = users.users_id AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'") as premium,users_id FROM `users` HAVING premium = "0") as u');
			$data = $this->api_model->get_data_having('','premium = "0"', $table, '','(select count(id) from ai_package_log where users_id = users.users_id AND  ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'") as premium, if(fcm_android != " ", fcm_android, fcm_ios) as fcm, users_id as id ', $start, $perpage);
		}else{
			$table = 'users';
			$key =  LIVESTOCK_AND_SERVERKEY;			
			$count = $this->api_model->get_data('', 'users', '','count(users_id) as count');
			$data = $this->api_model->get_data('', $table, '','if(fcm_android != " ", fcm_android, fcm_ios) as fcm, users_id as id ', $start, $perpage);
		}
			foreach($data as $d){
						$user_note = '';
						$flag = 1;
						$user_note['users_id'] = $d['id'];
						$user_note['title'] = $title;
						$user_note['message'] = $msg;
						$user_note['image'] = $image;
						$user_note['date'] = date('Y-m-d h:i:s');
						$user_note['type'] = '2';
						$user_note['isactive'] = '1';
						$user_note['flag'] = '1';
						$this->api_model->user_notification($user_note);
						if($type != '1' || $type != '2'){
							$old_msg['to_users_id'] = $d['id'];
							$old_msg['to_id'] =$d['id'];
							$old_msg['to_type'] = 'users';
							$old_msg['title'] = $title;
							$old_msg['from_type'] = 'Livestoc Team';
							$old_msg['success'] = '1';
							$old_msg['device'] = 'android';
							$old_msg['active'] = '1'; 
							$old_msg['description'] = $msg;
							$old_msg['image'] = $image;
							$old_msg['date_added'] = date('Y-m-d h:i:s');
							$this->api_model->old_notification($old_msg);
						}
						$this->push_non_notification($d['id'], $type, $title, $flag, $key, '', $msg, $img, '', '');
			}
		$count = $count[0]['count'];
		if($count > $start){
			$json['status'] = '1';
		}else{
			$json['status'] = '0';
		}
		$json['start'] = $start;
		$json['count'] = $count;
		echo json_encode($json);
		exit;
	}
	public function notification(){
		if($_POST['submit']){
			
			//$this->form_validation->set_rules('ai','Select Type','required|trim');
			$this->form_validation->set_rules('title','Titel','required|trim');
			$this->form_validation->set_rules('msg','Message','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run('about_us')){
					$title = $this->input->get_post('title');
					$msg = $this->input->get_post('msg');
					if($_POST['ai'] == 'ai'){
						$count = $this->api_model->get_data('', 'doctor', '','count(doctor_id) as count');
						$this->send_notification($title, $msg, 1,'doctor','0', '100', $count[0]['count']);
					}if($_POST['cous']  == 'cous'){
						$count = $this->api_model->get_data('', 'users', '','count(users_id) as count');
						$this->send_notification($title, $msg, 0, 'users', '0', '100', $count[0]['count']);
					}
					echo "<script>alert('Notifications has been sent.')</script>";
					$this->session->set_flashdata('about_us','Notifications has been sent.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/notification');
					$this->load->view('admin/layouts/admin_footer');
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/notification');
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/notification');
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function sale(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/sale');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function paravet_order_search(){
		//echo "this is test";
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->paravet_order_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_paravet_order_count($name);
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
	public function paravate_order_view(){
		$this->load->view('admin/paravate_order_view');
	}
	public function user_list(){
			$this->load->model('user_detail');
			$user_detail = $this->user_detail->get_user_list();
			if($user_detail)
			{
				$user_data['user_data'] = $user_detail;
				$this->load->view('admin/user_list', $user_data);
			}
	}
	public function regis_user(){
			$this->load->model('user_detail');
			$user_detail = $this->user_detail->get_user_list();
			if($user_detail)
			{
				$user_data['user_data'] = $user_detail;
				$this->load->view('admin/register_user', $user_data);
			}
	}
	public function treatment(){
		$this->load->view('admin/treatment');
	}
	public function user_approval()
	{
		$id = $this->input->post('id');
		$this->load->model('user_detail');
		$updata = $this->user_detail->change_status($id);
		$email_body = "<b>Your Account Is Approved click here to fill More <a href='http://ourmidway.com/fif/form/".$id."/'>Detail</a></b>";
		if($updata)
		{
			$error['error'] = '0';
			$detail  = $this->user_detail->get_detail($id);
			if($detail[0]['email']!='')
			{
				$this->load->library('email');
				$this->email->from('shahiakhilesh75h@gmail.com', 'Akhilesh');
				$this->email->to($detail[0]['email']); 
				$this->email->subject('Email Test');
				$this->email->message($email_body);	
				$this->email->send();
			}
			$this->load->model('user_detail');
			$user_detail = $this->user_detail->get_user_list();
			if($user_detail)
			{
				$user_data['user_data'] = $user_detail;
				$this->load->view('admin/user_list', $user_data);
			}
		}
		else
		{
			

		}
			
	}
	public function about_us()
	{
		
		
		$data['about'] = $this->admin_detail->get_about_us();
		$this->load->view('admin/about_us', $data);
	} 
	public function about_us_update()
	{
		
		
		$data['about'] = $this->admin_detail->get_about_us();
		$this->form_validation->set_rules('address','Content of About Us','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('about_us'))
		{
			$data_update['about_text'] = $this->input->post('address');
			$this->admin_detail->update_about_us($data_update); 
			$this->load->view('admin/about_us', $data);
		}
		else
		{
			$this->load->view('admin/about_us', $data);
		}
	}
	public function address()
	{
		
		
		$data['address'] = $this->admin_detail->get_address();
		$this->load->view('admin/address', $data);
	}
	public function address_update()
	{
		
			
		$data['address'] = $this->admin_detail->get_address();	
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('fax','Fax','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('about_us')){
			$data_update['phone'] = $this->input->post('phone');
			$data_update['fax'] = $this->input->post('fax');
			$data_update['email'] = $this->input->post('email');
			$data_update['address'] = $this->input->post('address');
			if($this->admin_detail->update_address($data_update)){
				$this->load->view('admin/address', $data);
			}
			else
			{
				$this->session->set_flashdata('address','There is problem with Database.');
				$this->load->view('admin/address', $data);
			}
		}
		else{
			$this->load->view('admin/address', $data);
		}
	}
	public function search()
	{
		$name =  $this->input->get('name');
		$email =  $this->input->get('email');
		$data['name'] = isset($name)?$name:'';
		$data['email'] =isset($email)?$email:''; 
		
		$detail = $this->admin_detail->search($data);
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
	public function reg_search()
	{
		$name =  $this->input->get('name');
		$email =  $this->input->get('email');
		$data['name'] = isset($name)?$name:'';
		$data['email'] =isset($email)?$email:''; 
		
		$detail = $this->admin_detail->reg_search($data);
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
	public function user_view($id)
	{
		
		$user_data = $this->admin_detail->reg_search_id($id);
		$detail['user'] = $user_data;
		$detail['sposer_data'] = $this->admin_detail->user_reg_id($user_data[0]['sponcer_id']);
		$detail['nomnee'] = $this->admin_detail->nomnee($id);
		$this->load->view('admin/user_view',$detail);
	}
	public function user_pending_view($id)
	{
		
		$user_data = $this->admin_detail->reg_search_id($id);
		$detail['id'] = $id;
		$detail['user'] = $user_data;
		$detail['sposer_data'] = $this->admin_detail->user_reg_id($user_data[0]['sponcer_id']);
		$detail['nomnee'] = $this->admin_detail->nomnee($id);
		$this->load->view('admin/user_pending_view',$detail);
	}
	public function unit_del()
	{
		$id = $this->input->get('id');
		$data1['isactivated'] = $this->input->get('status');
		if($this->admin_detail->unit_del($id,$data1))
		{
				$detail = $this->admin_detail->get_unit();
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
	}
	public function user_delete()
	{
		$id = $this->input->get('id');
		$name =  $this->input->get('name');
		$email =  $this->input->get('email');
		$data['name'] = isset($name)?$name:'';
		$data['email'] =isset($email)?$email:''; 
		
		if($this->admin_detail->user_delete($id))
		{
				$detail = $this->admin_detail->reg_search($data);
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
	}
	public function product_delete($id)
	{
		$this->load->model('product');
		if($this->product->product_delete($id))
		{
			$product_data = $this->product->get_list();
			if($product_data)
			{
				$user_data['user_data'] = $product_data;
				$this->load->view('admin/product_list', $user_data);
			}
		}
	}
	// public function product_search()
	// {
	// 	$name =  $this->input->get('name');
	// 	$data['name'] = isset($name)?$name:'';
	// 	$detail = $this->admin_detail->product_list($data);
	// 	if($detail)
	// 	{
	// 		$json_data = $detail;
	// 	}
	// 	else
	// 	{
	// 		$json_data['error'] = '1';
	// 	}
	// 	echo json_encode($json_data);
	// }
	public function module()
	{
		$this->load->view('admin/module');
	}
	public function add_module_editer()
	{
		
		$this->load->view('admin/module_editor');
	}
	public function add_module()
	{
		
		$this->form_validation->set_rules('name','Name of Module','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('add_module')){
			$name['module_name'] = $this->input->post('name');
			
			$name_detail = $this->admin_detail->create_module($name);
			if($name_detail)
			{
				$this->load->view('admin/module');
			}
			else{
				$this->session->set_flashdata('add_mmodel','There is problem with Database.');
				$this->load->view('admin/module_editor');
			}	
		}
		else{
			$this->load->view('admin/module_editor');
		}		
	}
	public function get_module()
	{
		$name =  $this->input->get('name');
		$data['module_name'] = isset($name)?$name:'';
		
		$data = $this->admin_detail->get_module($data);
		echo json_encode($data);
	}
	public function module_get_id($id)
	{
		
		
		$product_detail = $this->admin_detail->get_module_id($id);
		//print_r($product_detail);
		$data['module'] = $product_detail;
		$this->load->view('admin/module_edit', $data);
	}
	public function module_edit()
	{
		
		$this->form_validation->set_rules('name','Name of Module','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('module_edit')){
			$name['module_name'] = $this->input->post('name');
			$id = $this->input->post('id');
			
			$name_detail = $this->admin_detail->module_edit($name, $id);
			if($name_detail)
			{
			 	$this->load->view('admin/module');
			}
			else{
				$this->session->set_flashdata('add_mmodel','There is problem with Database.');
				$this->load->view('admin/module_editor');
			}	
		}
		else{
			$this->load->view('admin/module_editor');
		}	
	}
	public function module_del()
	{
		$id = $this->input->get('id');
		
		$name_detail = $this->admin_detail->module_del($id);
		if($name_detail){
			
			$data = $this->admin_detail->get_module();
			echo json_encode($data);
		}
	}
	public function user(){
		$data['roles'] = $this->admin_detail->get_role();
        $this->load->view('admin/user', $data);
	}
	public function user_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->user_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_user_count($name);
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
	public function animal(){
		$data['roles'] = $this->admin_detail->get_role();
		$this->load->view('admin/animal', $data);
	}
	public function seman_bull_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->seman_bull_search($name, $start, $perpage);
		$de = '';
		foreach($detail as $d){
			$bank_name = $this->api_model->get_bank_name_by_id($d['bull_source']);
			$d['bull_source'] = $bank_name[0]['bank_name'];
			$de[] = $d;
		}
		$detail = $de;
		$detail['count'] = $this->api_model->get_bank_count($name);
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
	public function seman_bank_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->seman_bank_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_bank_count($name);
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
	public function animal_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->animal_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_animal_count($name);
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
	public function category_add(){
		$data['roles'] = $this->admin_detail->get_role();
        $this->load->view('admin/category_add', $data);
	}
	public function subcategory_add(){
		$data['roles'] = $this->admin_detail->get_role();
		$data['cat'] = $this->admin_detail->get_category();
        $this->load->view('admin/subcategory_add', $data);
	}
	public function add_category(){
		$data['name'] = $this->input->post('name');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$info['data'] = $data;
		if($this->form_validation->run('category_add')){
			$config = array();
			$config['upload_path'] = '/var/www/html/purestoc/uploads/category';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = '5000';
			$config['overwrite']     = FALSE;	
			$this->load->library('upload');
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('image')) {
				$this->session->set_flashdata('category_add', 'Error Occured While Uploading Files');
				$this->load->view('admin/category_add', $info);
			}else{
				$upload_data = $this->upload->data();
				$data['image'] = $upload_data['file_name'];
				$result = $this->admin_detail->input_category($data);
					if($result)
						$this->load->view('admin/category');
					else{
						$this->session->set_flashdata('category_add','There is problem with database.');
						$this->load->view('admin/category_add', $info);
					}
			}
		}
		else{
			$this->load->view('admin/category_add');
		}
	}
	public function add_subcategory(){
		$data['name'] = $this->input->post('name');
		$data['cat_id'] = $this->input->post('cat');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('cat','Category','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$info['data'] = $data;
		if($this->form_validation->run('subcategory_add')){
			$config = array();
			$config['upload_path'] = '/var/www/html/purestoc/uploads/subcategory';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = '5000';
			$config['overwrite']     = FALSE;	
			$this->load->library('upload');
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('image')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('category_add', $error);
				$this->load->view('admin/category_add', $info);
			}else{
				$upload_data = $this->upload->data();
				$data['image'] = $upload_data['file_name'];
				$result = $this->admin_detail->input_subcategory($data);
					if($result)
						$this->load->view('admin/sub_category');
					else{
						$this->session->set_flashdata('suncategory_add','There is problem with database.');
						$this->load->view('admin/subcategory_add', $info);
					}
			}
		}
		else{
			$this->load->view('admin/subcategory_add');
		}
	}
	public function get_category()
	{
		$name =  $this->input->get('name');
		$data['name'] = isset($name)?$name:'';
		if(!$data = $this->admin_detail->get_category($data)){
			$data['error'] = '1';
		}
		echo json_encode($data);
	} 
	public function get_subcategory($name)
	{
		$name =  $this->input->get('name');
		$data['name'] = isset($name)?$name:'';
		if(!$data = $this->admin_detail->get_subcategory($data)){
			$data['error'] = '1';
		}
		echo json_encode($data);
	} 
	public function category(){
		$this->load->view('admin/category');
	}
	public function category_del()
	{
		$id = $this->input->get('id');
		$name_detail = $this->admin_detail->category_del($id);
		if($name_detail){
				if(!$data = $this->admin_detail->get_category()){
					$data['error'] = '1';
				}			
		}
		echo json_encode($data);
	}
	
		public function category_isactivated()
	{
		$id = $this->input->get('id');
        $data1['isactivated'] = $this->input->get('status');;
		if($this->admin_detail->category_isactivated($id, $data1))
		{
               
				$detail = $this->admin_detail->get_category();
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
	}
	public function subcategory_del()
	{
		$id = $this->input->get('id');
		$name_detail = $this->admin_detail->subcategory_del($id);
		if($name_detail){
				if(!$data = $this->admin_detail->get_subcategory()){
					$data['error'] = '1';
				}			
		}
		echo json_encode($data);
	}
	 public function subcategory_isactivated(){
        $id = $this->input->get('id');
        $data1['isactive'] = $this->input->get('status');;
		if($this->admin_detail->subcategory_isactivated($id, $data1))
		{
                
				$detail = $this->admin_detail->get_subcategory();
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
	}
	
	public function att_emp()
	{
		$id = $this->input->get('id');
		$data['user_id']=$id;
		$data['date'] = date("Y-m-d h:i:s");
		$name_detail = $this->admin_detail->emp_att($data);
		if($name_detail){
				if(!$data = $this->admin_detail->get_emp()){
					$data['error'] = '1';
				}			
		}
		echo json_encode($data);
	}
	public function emp_att(){
		$this->load->view('admin/emp_att');
	}
	public function att(){
		$detail = $this->admin_detail->get_emp();
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
	public function att_rep(){
		$this->load->view('admin/att_rep');
	}
	public function emp_att_report(){
		$detail = $this->admin_detail->get_emp_rep();
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
	public function category_edit($id=false)
	{
		
		$role['id'] = $id;
		$role['data'] = $this->admin_detail->get_category_id($id);
		$this->form_validation->set_rules('name','Name of Category','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('category_add'))
		{
			if (!empty($_FILES['image']['name'])) {
										$config = array();
										$config['upload_path'] = '/var/www/html/purestoc/uploads/category';
										$config['allowed_types'] = 'gif|jpg|png|jpeg';
										$config['max_size']      = '5000';
										$config['overwrite']     = FALSE;	
										$this->load->library('upload');
										$this->upload->initialize($config);
										if ( ! $this->upload->do_upload('image')) {
													$this->session->set_flashdata('category_add', 'Error Occured While Uploading Files');
													$this->load->view('admin/category_add', $info);
										}else{
													$upload_data = $this->upload->data();
													$value['image'] = $upload_data['file_name'];
													$id = $this->input->post('id');
													$value['name'] = $this->input->post('name');
													if($this->admin_detail->category_edit($value, $id))
													{
																redirect('admin/category');
																exit;
													}
													else
													{
																$this->session->set_flashdata('category_add','There is Problem With Database.');
																$this->load->view('admin/category_edit',$role);
													}
										}
			}else{
						$id = $this->input->post('id');
						$value['name'] = $this->input->post('name');
						if($this->admin_detail->category_edit($value, $id))
						{
									redirect('admin/category');
									exit;
						}
						else
						{
									$this->session->set_flashdata('category_add','There is Problem With Database.');
									$this->load->view('admin/category_edit',$role);
						}
			}
		}
		else{
			$this->load->view('admin/category_edit', $role);
		}	
	}
	public function subcategory_edit($id=false)
	{
		
		$role['id'] = $id;
		$role['data'] = $this->admin_detail->get_subcategory_id($id);
		$role['cat'] = $this->admin_detail->get_category();
		$this->form_validation->set_rules('name','Name of Category','required|trim');
		$this->form_validation->set_rules('cat','Select Category Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('subcategory_add'))
		{
					//if (!empty($_FILES['image']['name'])) {
									$config = array();
									$config['upload_path'] = '/var/www/html/purestoc/uploads/subcategory';
									$config['allowed_types'] = 'gif|jpg|png|jpeg';
									$config['max_size']      = '5000';
									$config['overwrite']     = FALSE;	
									$this->load->library('upload');
									$this->upload->initialize($config);
									if ( ! $this->upload->do_upload('image')) {
												$this->session->set_flashdata('subcategory_add', 'Error Occured While Uploading Files');
												$this->load->view('admin/subcategory_edit', $info);
									}else{
												$upload_data = $this->upload->data();
												$value['image'] = $upload_data['file_name'];
												$id = $this->input->post('id');
												$value['name'] = $this->input->post('name');
												$value['cat_id'] = $this->input->post('cat');
												if($this->admin_detail->subcategory_edit($value, $id))
												{
															redirect('admin/sub_category');
															exit;
												}
												else
												{
															$this->session->set_flashdata('subcategory_add','There is Problem With Database.');
															$this->load->view('admin/subcategory_edit',$role);
												}
									}								
					// }else{
					// 				$id = $this->input->post('id');
					// 				$value['name'] = $this->input->post('name');
					// 				$value['cat_id'] = $this->input->post('cat');
					// 				if($this->admin_detail->subcategory_edit($value, $id))
					// 				{
					// 					redirect('admin/sub_category');
					// 					exit;
					// 				}
					// 				else
					// 				{
					// 					$this->session->set_flashdata('subcategory_add','There is Problem With Database.');
					// 					$this->load->view('admin/subcategory_edit',$role);
					// 				}
					// }
		}
		else{
			$this->load->view('admin/subcategory_edit', $role);
		}	
	}
	public function sub_category(){
		$this->load->view('admin/sub_category');
	}
	public function role()
	{
		$this->load->view('admin/role');
	}
	// public function 
	public function role_add()
	{
		$this->load->view('admin/role_add');
	}
	public function role_add_editor()
	{
		$url = base_url('assets/admin/json/module.json');
		$string = file_get_contents($url); 
		$navigation = json_decode($string,true);
		
		$this->form_validation->set_rules('name','Name of Module','required|trim');
		$this->form_validation->set_error_delimiters('<div class="col-md-12" style="color:red; text-align:center;">', '</div>');
		if($this->form_validation->run('add_rol'))
		{
			$value['role_name'] = $this->input->post('name');
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$value['admin_id'] = $admin_data[0]['super_admin_id'];
			}else{
				$value['admin_id'] = $_SESSION['user_id'];
			}
			$name = $this->input->post('name');
			if($this->admin_detail->cheak_role($name))
			{
					$this->session->set_flashdata('add_rol','Please Choose Another Role Name.');
					$this->load->view('admin/role_add');
			}
			else
			{
				$val = implode(",",$_POST['module']);
				$value['module_list'] = $val;
				if($this->admin_detail->add_rol($value))
				{
					$this->load->view('admin/role');
				}else{
					$this->session->set_flashdata('add_rol','There is Problem With Database.');
					$this->load->view('admin/role_add');
				}
			}
		}
		else{
			$this->load->view('admin/role_add');
		}	
	}

	public function get_role()
	{
		$name =  $this->input->get('name');
		$name = isset($name)?$name:'';
		$admin_id = '';
		if($_SESSION['status'] != 1){
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$admin_id = $admin_data[0]['super_admin_id'];
			}else{
				$admin_id = $_SESSION['user_id'];
			}
		}
		$url = base_url('assets/admin/json/module.json');
		$string = file_get_contents($url); 
		$navigation = json_decode($string,true);
		$data = $this->admin_detail->get_role($name, $admin_id);
		foreach($data as $key_data => $mod){
			$data_array = explode(',', $mod['module_list']);
			$i=0;$module=false;
			//foreach($data_array as $dat_arr)
			//{
				foreach($navigation as $key => $nav){
					if(in_array($key,$data_array))
					{
						$module[] = $nav['Text'];
					}
				}
			//}
			$data[$key_data]['module_list']= implode(",",$module);
			$module="";			
		}
		echo json_encode($data);
	}
	public function role_get_id($id)
	{
		$data['id']= $id;
		$this->load->view('admin/role_edit', $data);
	}
	public function role_edit($id)
	{
		$role['id'] = $id;
		$role['role'] = $this->admin_detail->get_rol_id($id);
		$url = base_url('assets/admin/json/module.json');
		$string = file_get_contents($url); 
		$navigation = json_decode($string,true);
		$this->form_validation->set_rules('name','Name of Module','required|trim');
		$this->form_validation->set_error_delimiters('<div  class="col-md-12 error">', '</div>');
		if($this->form_validation->run('role_add'))
		{
			$value['role_name'] = $this->input->post('name');
			$name = $this->input->post('name');
			$val = implode(",",$_POST['module']);
			$value['module_list'] = $val;
			if($this->admin_detail->role_edit($value, $id))
			{
				redirect('admin/role');
				exit;
			}
			else
			{
				$this->session->set_flashdata('add_rol','There is Problem With Database.');
				$this->load->view('admin/role_edit',$role);
			}
		}
		else{
			$this->load->view('admin/role_edit', $role);
		}	
	}
	public function role_del()
	{
		$id = $this->input->get('id');
		$name_detail = $this->admin_detail->role_del($id);
		if($name_detail){
			$url = base_url('assets/admin/json/module.json');
			$string = file_get_contents($url); 
			$navigation = json_decode($string,true);
			$data = $this->admin_detail->get_role();
			foreach($data as $key_data => $mod){
				$data_array = explode(',', $mod['module_list']);
				$i=0;
				foreach($data_array as $dat_arr)
				{
					foreach($navigation as $key => $nav){
						if($dat_arr == $key)
						{
							if($i == 0)
							{	
								$module = $nav['Text'];
								$i++;
							}
							else
							{
								$module .= ",".$nav['Text']; 
								$i++;
							}
						}
					}
				}
				$data[$key_data]['module_list']= $module;
				$module="";			
			}
			echo json_encode($data);
		}
	}
	public function hospital()
	{
		$this->load->view('admin/hospital');
	}
	public function hospital_add()
	{
		$this->load->model('hospital');
		$data['name'] = "";
		$info['dept'] = $this->hospital->dept_search($data);
		$this->load->view('admin/hospital_add', $info);
	}
	public function add_hospital()
	{
		$this->load->model('hospital');
		$rule['name'] = '';
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['reg_no'] = $this->input->post('reg_no');
		$info['data'] = $data;
		$info['dept'] = $this->hospital->dept_search($rule);
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Name','required|number|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('reg_no','Reg NO','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('role_add')){
			$dept="";
			$dept = $this->hospital->dept_search($rule);
					$i=0;
					foreach($dept as $key=>$dep):
								if(isset($_POST["dept_".$key]))
								{
									if($i==0)
									{
										 $val = $dep['id'];
									}
									else
									{
										$val .= ",".$dep['id']; 
									}
									 $i++;
								}
					endforeach;
					if($i!=0)
					{ 
						 $data['dept'] = $val;
						 if($this->hospital->input_hospital($data))
							$this->load->view('admin/hospital', $info);
						 else{
							$this->session->set_flashdata('hospital_add','There is problem with database.');
							$this->load->view('admin/hospital_add', $info);
						 }
					}
					else{
						$this->session->set_flashdata('hospital_add','Please Select At List One Permission.');
						$this->load->view('admin/hospital_add', $info);
					}
		}
		else{
			$this->load->view('admin/hospital_add', $info);
		}
	}
	public function get_hospital()
	{
		$this->load->model('hospital');
		$this->hospital->get_hospital();
	}
	public function get_hospital_ajax()
	{
		$term =$this->input->get('terms');
		$this->load->model('hospital');
		$hos = $this->hospital->get_hospital_ajax();
		$result = array();
		foreach ($hos as $company) {
		   $companyLabel = $company[ "name" ];
		   if ( strpos( strtoupper($companyLabel), strtoupper($term) )!== false ) {

		      array_push( $result, $company );
		   }
		}
		echo json_encode( $result );
	}
	public function hospital_search()
	{
		$module="";
		$name =  $this->input->get('name');
		$data['name'] = isset($name)?$name:'';
		$this->load->model('hospital');
		$detail = $this->hospital->hospital_search($data);
		if($detail)
		{
			$depart = $this->hospital->dept_search($data);
			foreach($detail as $key_data=>$det){
				$dept_id = explode(',',$det['dept']); 
				$i=0;
				foreach($dept_id as $dat_arr)
				{
					foreach($depart as $key => $nav){
						if($dat_arr == $nav['id'])
						{
							if($i == 0)
							{	
								$module = $nav['name'];
								$i++;
							}
							else
							{
								$module .= ",".$nav['name']; 
								$i++;
							}
						}
					}
				}
				$detail[$key_data]['dept']= $module;
				$module="";	
			}
			//print_r($detail);
			$json_data = $detail;
		}
		else
		{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
	}
	public function hospital_del()
	{
		$id = $this->input->get('id');
		$data['name']= '';
		$this->load->model('hospital');
		if($this->hospital->hospital_del($id))
		{
			$product_data = $this->hospital->hospital_search($data);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function hospital_edit($id)
	{
		
		$this->load->model('hospital');
		$data['name'] = "";
		$info['dept'] = $this->hospital->dept_search($data);
		$hos_data = $this->hospital->get_hospital($id);
		$data['name'] = $hos_data[0]['name'];
		$data['address'] = $hos_data[0]['address'];
		$data['reg_no'] = $hos_data[0]['reg_no'];
		$data['phone'] = $hos_data[0]['phone'];
		$data['dept'] = $hos_data[0]['dept'];
		$info['data'] = $data;
		$info['id'] =  $id;
		$this->load->view('admin/hospital_edit', $info);
	}
	public function update_hospital()
	{
		$this->load->model('hospital');
		
		$id = $this->input->post('id_hos');
		$hos_data = $this->hospital->get_hospital($id);
		$rule['name'] = '';
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['reg_no'] = $this->input->post('reg_no');
		$data['dept'] = $hos_data[0]['dept'];
		$info['dept'] = $this->hospital->dept_search($rule);
		$info['data'] = $data;
		$info['id']  = $this->input->post('id_hos');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Name','required|number|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('reg_no','Reg NO','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('update_hospital')){
			$dept="";
			$dept = $this->hospital->dept_search($rule);
					$i=0;
					foreach($dept as $key=>$dep):
								if(isset($_POST["dept_".$key]))
								{
									if($i==0)
									{
										 $val = $dep['id'];
									}
									else
									{
										$val .= ",".$dep['id']; 
									}
									 $i++;
								}
					endforeach;
					if($i!=0)
					{ 
						 $data['dept'] = $val;
						 if($this->hospital->edit_hospital($data, $id)){
						 	$this->load->view('admin/hospital', $info);
						 }
						 else{
							$this->session->set_flashdata('update_hospital','There is problem with database.');
							$this->load->view('admin/hospital_edit', $info);
						 }
					}
					else{
						$this->session->set_flashdata('update_hospital','Please Select At List One Permission.');
						$this->load->view('admin/hospital_edit', $info);
					}
		}
		else{
			$this->load->view('admin/hospital_edit', $info);
		}
	}
	public function department()
	{
		$this->load->view('admin/dept');
	}
	public function department_add()
	{
		$this->load->view('admin/dept_add');
	}
	public function add_department()
	{
			$data['name'] = $this->input->post('name');
			$info['data'] = $data;
			$this->form_validation->set_rules('name','Name','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run('role_add')){
					$this->load->model('hospital');
					if($this->hospital->input_department($data))
						$this->load->view('admin/dept');
					else{
						$this->session->set_flashdata('dept_add','There is problem with database.');
						$this->load->view('admin/dept_add', $info);
					}
			}
			else{
					$this->load->view('admin/dept_add');
			}
	}
	public function dept_search()
	{
		$name =  $this->input->get('name');
		$data['name'] = isset($name)?$name:'';
		$this->load->model('hospital');
		$detail = $this->hospital->dept_search($data);
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
	public function dept_id()
	{
		$name['name'] = '';
		$this->load->model('hospital');
		$id =  $this->input->get('id');
		$hos = $this->hospital->get_hospital($id);
		$depart = $this->hospital->dept_search($name);
		$dept = explode(',',$hos[0]['dept']);
		$i=0;
		$depat ='';
		foreach($dept as $de){
			foreach($depart as $dep){
				if($dep['id']==$de){
						$depat[$i]['name'] = $dep['name'];
						$depat[$i]['id'] = $dep['id'];
						$i++;
					}
			}
		}
		echo json_encode($depat);
	}
	public function dept_del()
	{
		$id = $this->input->get('id');
		$data['name']= '';
		$this->load->model('hospital');
		if($this->hospital->dept_del($id))
		{
			$product_data = $this->hospital->dept_search($data);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function dept_edit($id)
	{
		
		$this->load->model('hospital');
		$hos_data = $this->hospital->get_dept($id);
		$data['name'] = $hos_data[0]['name'];
		$info['data'] = $data;
		$info['id'] =  $id;
		$this->load->view('admin/dept_edit', $info);
	}
	public function update_dept()
	{
		
		$data['name'] = $this->input->post('name');
		$info['data'] = $data;
		$info['id']  = $this->input->post('dept_id');
		$id = $this->input->post('dept_id');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('dept_edit')){
			$this->load->model('hospital');
			if($this->hospital->edit_dept($data, $id))
				$this->load->view('admin/dept', $info);
			else{
				$this->session->set_flashdata('dept_edit','There is problem with database.');
				$this->load->view('admin/dept_edit', $info);
			}
		}
		else{
			$this->load->view('admin/dept_edit');
		}
	}
	public function doctor()
	{
		$this->load->view('admin/doctor');
	}
	public function doctor_add()
	{
		$this->load->model('hospital');	
		$name['name']="";
		$data = $this->hospital->hospital_search($name);
		$hos_data['hos'] = $data;
		
		$this->load->view('admin/doctor_add', $hos_data);
	}
	public function add_doctor()
	{
		
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['hospital'] = $this->input->post('hospital');
		$data['dept'] = $this->input->post('dept');
		$info['data'] = $data;
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('hospital','Hospital','required|trim');
		$this->form_validation->set_rules('dept','Department','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('role_add')){
			$this->load->model('hospital');
			if($this->hospital->input_doctor($data))
				$this->load->view('admin/doctor');
			else{
				$this->session->set_flashdata('add_doctor','There is problem with database.');
				$this->load->view('admin/doctor_add', $info);
			}
		}
		else{
			$this->load->view('admin/doctor_add');
		}
	}
	public function doctor_report(){
		//echo "<pre>";
		$result = $this->api_model->get_doctor_report();
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=\"doctor_report".".csv\"");
		header("Pragma: no-cache");
		header("Expires: 0");
		$handle = fopen('php://output', 'w');
		fputcsv($handle, array('Name', 'Full Name', 'Father Name', 'Type', 'Email', 'Mobile', 'Image', 'Total Experience', 'City', 'State'));
			$i = 1;
			foreach ($result as $data) {
				if($data['users_type'] == 'pvt_ai'){ 
					$type = "Private AI";
				}if($data['users_type'] == 'pvt_doc'){ 
					$type = "Private Doctor"; 
				} if($data['users_type'] == 'pvt_vt'){ 
					$type = "Private Veterinarian"; 
				}
				fputcsv($handle, array($data["username"], $data["fullname"], $data["father_name"], $type, $data["email"], $data["mobile"], $data["image"], $data['total_experience'], $data['city'], $data['state']));
				$i++;
			}
				fclose($handle);
			exit;
	}
	public function doc_approval(){
		$doc_id = $this->input->get_post('doc_id');
		$document_id =$this->input->get_post('document_id');
		$data['isactive'] = $this->input->get_post('status');
		$data['remark'] = $this->input->get_post('remark');
		if($this->api_model->update('id', $document_id, 'document_table', $data)){
			if($data['isactive'] == '1'){
				$title = 'Account Verified';
				$msg1 = 'Your profile has been reviewed and verified by Admin.';
			}else{
				$title = 'Documents Rejected';
				$msg1 = $data['remark'];
			}
			$user_note['users_id'] = $doc_id;
			$user_note['title'] = $title;
			$user_note['message'] = $msg1;
			$user_note['date'] = date('Y-m-d h:i:s');
			$user_note['type'] = '2';
			$user_note['isactive'] = '1';
			$user_note['flag'] = '1';
			$this->api_model->user_notification($user_note);
			$this->push_non($doc_id, 1 , $title, '1', PARAVATE_SERVERKEY, $key=0, $msg1, $fcm_and= '', $fcm_ios = '');
			$msg['msg'] = "Action Performed";
		}else{
			$msg['msg'] = "Database Error";
		}
		echo json_encode($msg);
	}
	public function doctore_view($id){
		$data = $this->api_model->get_doc_detail_id($id);
		$data = json_decode(json_encode($data), True);
		$doc_qua = $this->login_cheak_model->get_qulification_doc_id($id);
		//print_r($doc_qua);
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
					$data['doc'] = $dat;
					$detail['data'] = $data;
					$this->load->view('admin/doctor_view',$detail);
	}
	public function manager_search()
	{
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->district_manager_search($name, $start, $perpage);
		$detail['count']= $this->api_model->get_dis_count($name); 
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
	public function doctor_search()
	{
		$name =  $this->input->get('name');
		$district_code =  $this->input->get('district_code');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->doctor_search($name, $start, $perpage);
		$detail['count']= $this->api_model->get_doc_count($name); 
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
	public function doc_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$region = $this->input->get_post('region');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactivated'] = $status;
		if(isset($region) || $region !=''){
			$data['rej_region'] = $region;
		}
		if($this->api_model->doctor_doc_status($id, $data))
		{
			$product_data = $this->api_model->doctor_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_doc_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function state_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_active'] = $status;
		if(isset($region) || $region !=''){
			$data['rej_region'] = $region;
		}
		if($this->api_model->state_status($id, $data))
		{
			$product_data = $this->api_model->state_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_state_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function tehshil_status(){
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_active'] = $status;
		if($this->api_model->tehshil_status($id, $data))
		{
			$product_data = $this->api_model->teshil_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_teshil_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function gvh_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_active'] = $status;
		if($this->api_model->gvh_status($id, $data))
		{
			$product_data = $this->api_model->gvh_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_gvh_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function employee_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_active'] = $status;
		if($this->api_model->employee_status($id, $data))
		{
			$product_data = $this->api_model->employee_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_employee_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function gvd_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_active'] = $status;
		if($this->api_model->gvd_status($id, $data))
		{
			$product_data = $this->api_model->gvd_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_gvd_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function district_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_active'] = $status;
		if($this->api_model->district_status($id, $data))
		{
			$product_data = $this->api_model->district_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_district_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function user_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		if($this->api_model->user_status($id, $status))
		{
			$product_data = $this->api_model->user_search($name, $start,$perpage);
			$detail['count'] = $this->api_model->get_user_count($name);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function sys_user_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		if($this->api_model->sys_user_status($id, $status))
		{
			$product_data = $this->api_model->sys_user_search($name, $start,$perpage);
			$detail['count'] = $this->api_model->get_sys_user_count($name);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function doctor_del()
	{
		$id = $this->input->get('id');
		$data['name']= '';
		$this->load->model('hospital');
		if($this->hospital->doctor_del($id))
		{
			$product_data = $this->hospital->doctor_search($data);
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function doctor_edit($id)
	{
		
		$this->load->model('hospital');
		$hos_data = $this->hospital->get_doctor($id);
		$data['name'] = $hos_data[0]['name'] ;
		$data['phone'] = $hos_data[0]['phone'] ;
		$data['address'] = $hos_data[0]['address'] ;
		$info['data'] = $data;
		$info['id'] =  $id;
		$this->load->view('admin/doctor_edit', $info);
	}
	public function update_doctor()
	{
		
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone') ;
		$data['address'] = $this->input->post('address');
		$info['data'] = $data;
		$info['id']  = $this->input->post('doctor_id');
		$id = $this->input->post('doctor_id');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('doctor_edit')){
			$this->load->model('hospital');
			if($this->hospital->edit_doctor($data, $id))
				$this->load->view('admin/doctor', $info);
			else{
				$this->session->set_flashdata('doctor_edit','There is problem with database.');
				$this->load->view('admin/doctor_edit', $info);
			}
		}
		else{
			$this->load->view('admin/doctor_edit');
		}
	}
	public function service_boy(){
		$this->load->view('admin/serviceboy_list');
	}
	public function serviceboy_search()
	{
		$this->load->model('serviceboy');
		$detail = $this->serviceboy->serviceboy_get();
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
	public function serviceboy_delete()
	{
		$id = $this->input->get('id');
		$data['name']= '';
		
		if($this->serviceboy->serviceboy_delete($id))
		{
			$product_data = $this->serviceboy->serviceboy_get();
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
    }
	public function service_add()
	{
		
        $this->load->view('admin/serviceboy');
    }
    public function add_service()
	{
		
		
		$password = $this->input->post('password');
		$conf_password = $this->input->post('confirm_password');
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['password'] = md5($password);
		$data['status'] ='4';
		$info['data'] = $data;
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('serviceboy')){
			if($password!='' || $conf_password!='')
			{
				if($password == $conf_password)
				{
					if(!empty($this->input->post('hos')))
					{
						$hos_id = implode(',',$this->input->post('hos'));
						$data['hospital_id'] = $hos_id;
						
						$this->serviceboy->serviceboy_insert($data);
						$this->load->view('admin/serviceboy_list');
					}
					else{
						$this->session->set_flashdata('serviceboy','Plese select Hospital');
						$this->load->view('admin/serviceboy', $info);
					}				}
				else{
					$this->session->set_flashdata('serviceboy','Password and Confirm Password is Not Matched');
					$this->load->view('admin/serviceboy', $info);
				}
			}
			else{
				$this->session->set_flashdata('serviceboy','Password and Confirm Password is Not BlanK');
				$this->load->view('admin/serviceboy', $info);
			 }
			
		}
		else{
			$this->load->view('admin/serviceboy');
		}
	}
	public function service_boy_edit($id)
	{
		$service_boy_detail = $this->serviceboy->serviceboy_get_id($id);
		$data['id'] = $id;	
		$data['name'] = $service_boy_detail[0]['name'];
		$data['address'] = $service_boy_detail[0]['address'];
		$data['hospital_id'] = $service_boy_detail[0]['hospital_id'];
		$data['phone'] = $service_boy_detail[0]['phone'];
		$data['hospital'] = $this->serviceboy->get_hospital();
		
		$this->load->view('admin/serviceboy_edit', $data);
	}
	public function service_boy_update()
	{
		
		$id = $this->input->post('id');
		$service_boy_detail = $this->serviceboy->serviceboy_get_id($id);
		$data_info['id'] = $id;	
		$data_info['name'] = $service_boy_detail[0]['name'];
		$data_info['address'] = $service_boy_detail[0]['address'];
		$data_info['hospital_id'] = $service_boy_detail[0]['hospital_id'];
		$data_info['phone'] = $service_boy_detail[0]['phone'];
		$data_info['hospital'] = $this->serviceboy->get_hospital();
		
		$password = $this->input->post('password');
		$conf_password = $this->input->post('confirm_password');
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['password'] = md5($password);
		$data['status'] ='4';
		$info['data'] = $data;
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('serviceboy_edit')){
			if($password!='' || $conf_password!='')
			{
				if($password == $conf_password)
				{
					if(!empty($this->input->post('hos')))
					{
						$hos_id = implode(',',$this->input->post('hos'));
						$data['hospital_id'] = $hos_id;
						$this->serviceboy->serviceboy_edit($id, $data);
						$this->load->view('admin/serviceboy_list');
					}
					else{
						$this->session->set_flashdata('serviceboy_edit','Plese select Hospital');
						$this->load->view('admin/serviceboy_edit', $data_info);
					}				}
				else{
					$this->session->set_flashdata('serviceboy_edit','Password and Confirm Password is Not Matched');
					$this->load->view('admin/serviceboy_edit', $data_info);
				}
			}
			else{
				$this->session->set_flashdata('serviceboy_edit','Password and Confirm Password is Not BlanK');
				$this->load->view('admin/serviceboy_edit', $data_info);
			 }
			
		}
		else{
			$this->load->view('admin/serviceboy_edit');
		}
	}
	// public function superv_list()	
	// {
	// 	$this->load->view('admin/superv_list');
	// }
	public function superv_search()
	{
		$detail = $this->admin_detail->superv_list();
		if($detail!='')
			{
		   		$json_data = $detail;
		  	}
		  else
		  	{
		 	  $json_data['error'] = '1';
		 	}
		echo json_encode($json_data);
	}
	
	public function superv_add()
	{
		$data['roles'] = $this->admin_detail->get_role();
        $this->load->view('admin/superv_add', $data);
	}
	public function add_superv()
	{
		$password = $this->input->post('password');
		$conf_password = $this->input->post('conf_password');
		$data['name'] = $this->input->post('name');
		$data['username'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['farm_name'] = $this->input->post('farm_name');
		$data['phone_alt'] = $this->input->post('phone_alt');
		$data['aadhar'] = $this->input->post('aadhar');
		$data['land_owned'] = $this->input->post('land_owned');
		$data['cows'] = $this->input->post('cows');
		$data['buffaloes'] = $this->input->post('buffaloes');
		$data['sheep'] = $this->input->post('sheep');
		$data['goat'] = $this->input->post('goat');
		$data['camel'] = $this->input->post('camel');
		$data['poultry'] = $this->input->post('poultry');
		$data['cows_breed'] = $this->input->post('cows_breed');
		$data['cows_milking'] = $this->input->post('cows_milking');
		$data['cows_dry'] = $this->input->post('cows_dry');
		$data['cows_repeat'] = $this->input->post('cows_repeat');
		$data['buffaloes_breed'] = $this->input->post('buffaloes_breed');
		$data['buffaloes_milking'] = $this->input->post('buffaloes_milking');
		$data['buffaloes_dry'] = $this->input->post('buffaloes_dry');
		$data['buffaloes_repeat'] = $this->input->post('buffaloes_repeat');
		$data['organic_farming'] = $this->input->post('organic_farming');
		$data['product_farmer'] = $this->input->post('product_farmer');

		$role_id = $data['status'] = $this->input->post('role');
		$data['password'] = md5($password);
		//$data['status'] ='3';
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('role','Role','required|trim');
		if($role_id==SERVICE_BOY || $role_id==CALLER || $role_id==HOSPITAL){
			$data['hospital_id'] = $this->input->post('hsptl');
			$this->form_validation->set_rules('hsptl','Hospital','required|trim');
		}
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$info['data'] = $data;
		if($this->form_validation->run('role_add')){
			if($password!='' || $conf_password!='')
			{
				if($password == $conf_password)
				{
					$result = $this->admin_detail->input_superv($data);
					if($result)
						$this->load->view('admin/superv_list');
					else{
						$this->session->set_flashdata('superv_add','There is problem with database.');
						$this->load->view('admin/superv_add', $info);
					}
				}
				else{
					$this->session->set_flashdata('superv_add','Password and Confirm Password is Not Matched');
					$this->load->view('admin/superv_add', $info);
				}
			}
			else{
				$this->session->set_flashdata('superv_add','Password and Confirm Password is Not BlanK');
				$this->load->view('admin/superv_add', $info);
			}
			
		}
		else{
			$this->load->view('admin/superv_add');
		}
	}
	public function farmer_add()
	{
		$data['roles'] = $this->admin_detail->get_role();
		$data['animal_details'] = $this->admin_detail->get_animal_detail();
		$data['animal_breed'] = $this->admin_detail->get_animal_breed();
		$data['country'] =$this->admin_detail->get_country();
    	$this->load->view('admin/farmer_add', $data);
	}
	public function get_city(){
		$id = $this->input->get_post('id');
		$detail = $this->admin_detail->get_city($id);
		if(!empty($detail))
			{
		   		$json_data = $detail;
		  	}
		  else
		  	{
		 	  $json_data['error'] = '1';
		 	}
		echo json_encode($json_data);
		
	}
	public function get_location(){
		$id = $this->input->get_post('id');
		$detail = $this->admin_detail->get_location($id);
		if(!empty($detail))
			{
		   		$json_data = $detail;
		  	}
		  else
		  	{
		 	  $json_data['error'] = '1';
		 	}
		echo json_encode($json_data);
	}
	public function get_state(){
		$id = $this->input->get_post('id');
		$detail = $this->admin_detail->get_state($id);
		if(!empty($detail))
			{
		   		$json_data = $detail;
		  	}
		  else
		  	{
		 	  $json_data['error'] = '1';
		 	}
		echo json_encode($json_data);
	}
	public function animal_detail(){
		//echo "this is true";
		$id = $this->input->get_post('id');
		//$data['animal_details'] = $this->admin_detail->get_animal_detail_id($id);
		$data['animal_breed'] = $this->admin_detail->get_animal_breed_cat_id($id);
		//print_r($data['animal_details']);
		$json = $this->admin_detail->get_animal_breed_cat_id($id);
		echo json_encode($json);
	}
	public function add_farmer()
	{
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('phone_alt','phone_alt','required|trim');
		$this->form_validation->set_rules('aadhar','aadhar','required|trim');
		$this->form_validation->set_rules('land_owned','land_owned','required|trim');
		$this->form_validation->set_rules('animal','animal','required|trim');
		$this->form_validation->set_rules('land_owned','land_owned','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('farmer_add')){
			$data['farm_name'] = $this->input->get_post('farm_name');
			$data['name'] = $this->input->get_post('name');
			$data['phone'] = $this->input->get_post('phone');
			$data['phone_alt'] = $this->input->get_post('phone_alt');
			$data['email'] = $this->input->get_post('email');
			$data['password'] = $this->input->get_post('password');
			$password = $this->input->get_post('password');
			$conf_password = $this->input->get_post('conf_password');
			$data['aadhar'] = $this->input->get_post('aadhar');
			$data['address'] = $this->input->get_post('address');
			$data['land_owned'] = $this->input->get_post('land_owned');
			$animal = $this->input->get_post('animal');
			$animal_type = $this->input->get_post('animal_type');
			$data['is_organic_farming'] = $this->input->get_post('organic');
			$data['country_id'] = $this->input->get_post('country');
			$data['state_id'] = $this->input->get_post('state');
			$data['city_id'] = $this->input->get_post('city');
			$location_id = $this->input->get_post('location');
			$data['status'] = 2;
			if($password!='' || $conf_password!='')
			{
				if($password == $conf_password)
				{
							if($result = $this->admin_detail->input_superv($data)){
								
									$last_id = $result;
									foreach($animal_type as $ani){
										$ani_data['user_id'] = $last_id;
										$ani_data['animal_id'] = $ani;
										$ani_data['milking_animals'] = $this->input->get_post($ani.'_m_ani_no');
										$ani_data['dry_animals'] = $this->input->get_post($ani.'_d_ani_no');
										$ani_data['repeat_animal'] = $this->input->get_post($ani.'_r_ani_no');
										$this->admin_detail->m_animal_owned_details($ani_data);
										$bread['user_id'] = $last_id;
										$bread['breed_id'] = $this->input->get_post($ani.'_bread');
										$bread['animal_id'] = $ani;
										$this->admin_detail->m_animal_breed($bread);
									}	
									foreach($location_id as $loc){
										$locy['user_id'] = $last_id;
										$locy['country_id'] = $this->input->get_post('country');
										$locy['state_id'] = $this->input->get_post('state');
										$locy['city_id'] = $this->input->get_post('city');
										$locy['location_id'] = $loc;
										$this->admin_detail->m_farmer_location($locy);
									}
										$this->load->view('admin/farmer');
							}
							else{
								$this->session->set_flashdata('farmer_add','There is problem with database.');
								$this->load->view('admin/farmer_add', $info);
							}
					}
				else{
					$this->session->set_flashdata('farmer_add','Password and Confirm Password is Not Matched askdhkahskjhdkjh');
					$this->load->view('admin/farmer_add', $info);
				}
			}
			}else{
				$this->load->view('admin/farmer_add', $info);
			}
		}
	
	public function superv_del()
	{
		$id = $this->input->get('id');
		$data['name']= '';
		
		if($this->admin_detail->superv_del($id))
		{
			$product_data = $this->admin_detail->superv_list();
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	public function farmer_edit($id)
	{
		$data['id'] = $id ;
		
		$data['superv_data'] = $this->admin_detail->superv_get_id($id);
		
		$this->load->view('admin/farmer_edit',$data);
	}
	public function update_farmer()
	{
		$id = $this->input->post('id');
		$password = $this->input->post('password');
		$conf_password = $this->input->post('conf_password');
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['farm_name'] = $this->input->post('farm_name');	
		$data['phone_alt'] = $this->input->post('phone_alt');
		$data['email'] = $this->input->post('email');
		$data['aadhar'] = $this->input->post('aadhar');
		$data['land_owned'] = $this->input->post('land_owned');
		$data['cows'] = $this->input->post('cows');
		$data['buffaloes'] = $this->input->post('buffaloes');
		$data['sheep'] = $this->input->post('sheep');
		$data['goat'] = $this->input->post('goat');
		$data['camel'] = $this->input->post('camel');
		$data['poultry'] = $this->input->post('poultry');
		$data['cows_breed'] = $this->input->post('cows_breed');
		$data['cows_milking'] = $this->input->post('cows_milking');
		$data['cows_dry'] = $this->input->post('cows_dry');
		$data['cows_repeat'] = $this->input->post('cows_repeat');
		$data['buffaloes_breed'] = $this->input->post('buffaloes_breed');
		$data['buffaloes_milking'] = $this->input->post('buffaloes_milking');
		$data['buffaloes_dry'] = $this->input->post('buffaloes_dry');
		$data['buffaloes_repeat'] = $this->input->post('buffaloes_repeat');
		$data['organic_farming'] = $this->input->post('organic_farming');
		$data['location_farmer'] = $this->input->post('location_farmer');
		$data['product_farmer'] = $this->input->post('product_farmer');
		$data['password'] = md5($password);
		//$data['status'] ='3';
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$info['data'] = $data;
		if($this->form_validation->run('role_add')){
			if($password!='' || $conf_password!='')
			{
				if($password == $conf_password)
				{
					
					if($this->admin_detail->update_superv($data, $id))
						redirect('admin/farmer_reg');
					else{
						$this->session->set_flashdata('superv_add','There is problem with database.');
						$this->load->view('admin/farmer_add', $info);
					}
				}
				else{
					$this->session->set_flashdata('superv_add','Password and Confirm Password is Not Matched');
					$this->load->view('admin/farmer_add', $info);
				}
			}
			else{
				$this->session->set_flashdata('superv_add','Password and Confirm Password is Not BlanK');
				$this->load->view('admin/farmer_add', $info);
			}			
		}
		else{
			$this->load->view('admin/farmer_add');
		}
	}
	public function superv_edit($id)
	{
		$data['id'] = $id ;
		
		$data['superv_data'] = $this->admin_detail->superv_get_id($id);
		
		$this->load->view('admin/superv_edit',$data);
	}
	public function update_superv()
	{
		
		$id = $this->input->post('id');
		$password = $this->input->post('password');
		$conf_password = $this->input->post('conf_password');
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$role_id = $data['status'] = $this->input->post('role');
		$data['password'] = md5($password);
		//$data['status'] ='3';
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($role_id==SERVICE_BOY || $role_id==CALLER || $role_id==HOSPITAL){
			$data['hospital_id'] = $this->input->post('hsptl');
			$this->form_validation->set_rules('hsptl','Hospital','required|trim');
		}
		$info['data'] = $data;
		if($this->form_validation->run('role_add')){
			if($password!='' || $conf_password!='')
			{
				if($password == $conf_password)
				{
					
					if($this->admin_detail->update_superv($data, $id))
						redirect('admin/superv_list');
					else{
						$this->session->set_flashdata('superv_add','There is problem with database.');
						$this->load->view('admin/superv_add', $info);
					}
				}
				else{
					$this->session->set_flashdata('superv_add','Password and Confirm Password is Not Matched');
					$this->load->view('admin/superv_add', $info);
				}
			}
			else{
				$this->session->set_flashdata('superv_add','Password and Confirm Password is Not BlanK');
				$this->load->view('admin/superv_add', $info);
			}			
		}
		else{
			$this->load->view('admin/superv_add');
		}
	}
	public function edit_user()
	{
		
		$id = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		//$data['status'] ='3';
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$info['data'] = $data;
		if($this->form_validation->run('role_add')){
					if($this->admin_detail->update_superv($data, $id))
						redirect('admin/user');
					else{
						$this->session->set_flashdata('user_add','There is problem with database.');
						$this->load->view('admin/user_edit', $info);
					}	
		}
		else{
			$this->load->view('admin/user_edit');
		}
	}
	public function request()
	{    
		$this->load->view('admin/request_hospital');
	}
	public function closedRequest()
	{    
		$this->load->view('admin/closedRequest');
	}

	public function closedRequestView($id)
	{
		$request_detail = $this->request_hospital->request_edit($id);
		$data['id'] = $id;
		$data['hospital_id'] = $request_detail[0]['hospital_id'];	
		$data['hospital'] = $this->serviceboy->get_hospital($request_detail[0]['hospital_id']);
		$data['user_id'] = $request_detail[0]['user_id'];
		$data['name_p'] = $request_detail[0]['name_p'];
		$data['p_time'] = $request_detail[0]['p_time'];
		$data['date'] = $request_detail[0]['date'];
		$data['dept'] = $this->serviceboy->getDepart($request_detail[0]['dept']);
		$data['message'] = $request_detail[0]['msg'];
		$data['sboy'] = $this->serviceboy->serviceboy_get(array('hospital_id'=>$request_detail[0]['hospital_id']));
		$data['asSboy'] = $request_detail[0]['sboy'];
		$data['serv_close'] = $request_detail[0]['serv_close'];
		$data['app_sts'] = $request_detail[0]['app_sts'];
		$data['app_rem'] = $request_detail[0]['app_rem'];
		$data['call_close'] = $request_detail[0]['call_close'];
		$data['call_rem'] = $request_detail[0]['call_rem'];
		$data['callers'] = $this->serviceboy->getCaller();
		$data['asclr'] = $request_detail[0]['caller'];
		$data['status'] = $request_detail[0]['status'];
		$this->load->view('admin/closedRequestView', $data);
	}

	public function livestoc_balance(){
		$this->load->view('admin/livestoc_balance');
	}
	public function add_balance(){
		if($_POST['submit']){
			$data['balance_amount'] = $this->input->get_post('balance_amount');
			$this->form_validation->set_rules('balance_amount','Please Select Livestoc','numeric|required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			if($this->form_validation->run('add_balance_amount'))
			{
				$data = $this->api_model->ins_user_livestoc_amount($data['balance_amount']);
				$user = $this->api_model->get_user_info_id();
				foreach($user as $u){
					$title =  'Livestoc cash replenishment';
					$msg = 'Rs 200 Livestoc cash has been credited to your account';
					$flag = 1;
					$user_note4['users_id'] = $u;
					$user_note4['title'] = $title;
					$user_note4['message'] = $msg;
					$user_note4['date'] = date('Y-m-d h:i:s');
					$user_note4['type'] = '3';
					$user_note4['isactive'] = '1';
					$user_note4['flag'] = $flag;
					$this->api_model->user_notification($user_note4);
					$this->push_non($u, '' , $title, $flag = 0, $server_key = 0, $key=0, $msg, $fcm_and= '', $fcm_ios = '');
				}
				if($data){
					$this->session->set_flashdata('add_balance_amount','Your livestoc is added.');
					redirect('admin/livestoc_balance');
				}else{
					$this->session->set_flashdata('add_balance_amount','Database Error.');
					$this->load->view('admin/add_balance');
				}
			}else{
				$this->load->view('admin/add_balance');
			}
		}else{
			$this->load->view('admin/add_balance');
		}
	}
	public function product_interest($request = ''){
		$data['request'] = $request;
		$this->load->view('admin/product_interest', $data);
	}
	public function product_interest_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$user_id = '';
		if($_SESSION['status'] != '1'){
		$user_id = $this->session->userdata("user_id");
		}
		$detail1 = $this->api_model->product_interest_search($name, $user_id, $start, $perpage);
		$detail = $detail1['details'];
		$detail['count'] = $detail1['count'];
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
	public function delivery_partner_order_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$id = $this->input->get_post('delivery_id');
		$cod = $this->input->get_post('cod');
		if($_SESSION['status'] != '1')
		$user_id = $this->session->userdata("user_id");
		$detail = $this->api_model->get_order_search($name, $user_id, $start, $perpage, $id, $cod);
		$detail['count'] = $this->api_model->get_order_count($name, $user_id, $id, $cod);
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
	public function delivery_partner_account($id){
		$data['id'] = $id;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/delivery_partner_account', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function delivery_partner_insentive($id){
		$data['id'] = $id;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/delivery_partner_insentive', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function delivery_partner(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/delivery_partner');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function delivery_partner_cod($id){
		$data['id'] = $id;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/delivery_partner_cod', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function offline_delivery_partner_transaction_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		if($_SESSION['status'] != '1')
		$user_id = $this->session->userdata("user_id");
		$detail = $this->api_model->offline_delivery_partner_transaction_search($name, $user_id, $start, $perpage);
		$detail['count'] = $this->api_model->offline_delivery_partner_transaction_count($name, $user_id);
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
	public function delivery_partner_search(){
			$name =  $this->input->get('name');
			$start = $this->input->get_post('start');
			$perpage = $this->input->get_post('perpage');
			if($_SESSION['status'] != '1')
			$user_id = $this->session->userdata("user_id");
			$detail = $this->api_model->delivery_partner_search($name, $user_id, $start, $perpage);
			$detail['count'] = $this->api_model->delivery_partner_count($name, $user_id);
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
	public function delivery_partner_status(){
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactivated'] = $status;
		if($this->api_model->update('admin_id', $id, 'admin', $data))
		{
			$detail = $this->api_model->delivery_partner_search($name, $start,$perpage);
			$detail['count'] = $this->api_model->delivery_partner_count($name, $user_id);
			if($detail)
			{
				$json_data = $detail;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}
	// public function order_search(){
	// 	$name =  $this->input->get('name');
	// 	$start = $this->input->get_post('start');
	// 	$perpage = $this->input->get_post('perpage');
	// 	if($_SESSION['status'] != '1')
	// 	$user_id = $this->session->userdata("user_id");
	// 	$detail = $this->api_model->get_order_search($name, $user_id, $start, $perpage);
	// 	$detail['count'] = $this->api_model->get_order_count($name, $user_id);
	// 	if($detail)
	// 	{
	// 		$json_data = $detail;
	// 	}
	// 	else
	// 	{
	// 		$json_data['error'] = '1';
	// 	}
	// 	echo json_encode($json_data);
	// }
	public function orders(){
		//echo "select DISTINCT po.id, (select full_name from users where users_id = po.users_id) as user_name, (select mobile from users where users_id = po.users_id) as user_mobile, (select address from users where users_id = po.users_id) as user_address, po.product_qty, po.package_id, po.package_price, po.date, po.isactive, p.user from product_order as po, product as p where p.user = '27'";
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/orders');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function order_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		if($_SESSION['status'] != '1')
		$user_id = $this->session->userdata("user_id");
		$detail = $this->api_model->get_order_search($name, $user_id, $start, $perpage);
		$detail['count'] = $this->api_model->get_order_count($name, $user_id);
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
	public function account(){
		$this->load->view('admin/account');
	}
	public function account_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$user_id = $this->session->userdata("user_id");
		$detail = $this->api_model->query_build("SELECT lf.id,lf.user_type,lf.type,lf.payment_type as status,lf.users_id,lf.amount,lf.date,if(user_type = 3, (select username from doctor where doctor .doctor_id= lf.users_id),if(user_type = 3, (select fname from admin where admin.admin_id  = lf.users_id), (select full_name from users where users.users_id= lf.users_id))) as users_name,(SELECT mobile FROM users where users_id = lf.users_id ) as mobile,if(lf.type='18','Advance semen Booking',IF(lf.type='20', 'Added Money to Wallet',if(lf.type='23', 'Lab Request for Pregnancy Detection',if(lf.type='24','Pregnancy Detection',if(lf.type='27','AI Request Place',if(lf.type=32,'User Upgraded to priemium', '')))))) as payment_type FROM log_file as lf where lf.payment_type='Dr' OR lf.payment_type='Cr' AND lf.amount <> 0  UNION ALL SELECT log_id as id,lw.user_type,lw.type,lw.status, lw.users_id,lw.amount,lw.date,if(user_type = 2,(select username from doctor where doctor.doctor_id=lw.users_id), if(user_type = 3, (select fname from admin where admin.admin_id = lw.users_id),(select full_name from users where users.users_id = lw.users_id))) as users_name,(SELECT mobile FROM users where users_id = lw.users_id ) as mobile,if(lw.type='18','Advance semen Booking',IF(lw.type='20', 'Added Money to Wallet',if(lw.type='23','Lab Request For Pregnancy Deteaction',if(lw.type='24','Pregnancy Detection',if(lw.type='27','AI Request Place',if(lw.type=32, 'User Upgraded to priemium', '')))))) as payment_type FROM livestoc_wallets as lw where lw.status ='Dr' OR lw.status ='Cr' AND lw.amount <> 0 ORDER BY id DESC LIMIT ".$start.",".ITEMS_PER_PAGE.""); 
		//$detail = $this->api_model->get_account_search($name, $user_id, $start, $perpage);
		//$detail['count'] = $this->api_model->get_account_count("$name, $user_id");
		$detail['count'] = $this->api_model->query_build("SELECT SUM(cou.count) as total_count  FROM (SELECT COUNT(lf.id) as count,lf.id,lf.type,lf.payment_type as status,lf.users_id,lf.amount FROM log_file as lf where lf.payment_type='Dr' OR lf.payment_type='Cr' AND users_id <> 0 UNION ALL SELECT  COUNT(lw.id) as count,log_id as id,lw.type,lw.status, users_id,amount FROM livestoc_wallets as lw where lw.status ='Dr' OR lw.status ='Cr' AND users_id <> 0) as cou");
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

	//call logs function and details
	public function calllogs(){
		$this->load->view('admin/calllogs');
	}
	
	public function calllogs_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$user_id = $this->session->userdata("user_id");
		$detail = $this->api_model->get_calllogs_search($name, $user_id, $start, $perpage);
		$detail['count'] = $this->api_model->get_calllogs_count($name, $user_id);
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

	//video function and details
	public function videos(){
		$this->load->view('admin/videos');
	}
	// public function 
	public function video_add()
	{
		$data['title'] = $this->input->get_post('video_title');
		$data['price'] = $this->input->get_post('video_price');
		$data['qualifications'] = $this->input->get_post('qualifications');
        $data['institute'] = $this->input->get_post('institute');
		$data['user_id'] = $_SESSION['user_id'];
		$data['user_type'] = $_SESSION['type'];	
		$data['isactivated'] = '0';
		$data['created_on'] = date('Y-m-d h:i:s');
		$data['updated_on'] = date('Y-m-d h:i:s');		
		if ($this->input->post('video_upload')) {
			if($_FILES['video_name']['name']) {
	            //set preferences
	            //file upload destination
	            $upload_path = '/var/www/html/harpahu_merge_dev/uploads/videos';
	            $config['upload_path'] = $upload_path;
	            //allowed file types. * means all types
	            $config['allowed_types'] = 'wmv|mp4|avi|mov|3gp|flv|mp3';
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
	                if (!$this->upload->do_upload('video_name')) {
	                    //if file upload failed then catch the errors
	                    //$this->handle_error($this->upload->display_errors());
	                    $is_file_error = TRUE;
	                } else {
	                    //store the video file info
	                    $video_data = $this->upload->data();
	                }
	            }
	            // There were errors, we have to delete the uploaded video
	            if ($is_file_error) {
	            	//this message added for show that error
	            	$this->session->set_flashdata('add_rol','Please add video for upload');
	                if ($video_data) {
	                    $file = $upload_path . $video_data['file_name'];
	                    if (file_exists($file)) {
	                        unlink($file);
	                    }
	                }
	            } else {
	                //$data['video_name'] = $video_data['file_name'];
	                //$data['video_path'] = $upload_path;
	                //$data['video_type'] = $video_data['file_type'];
	                $data['video'] = $video_data['file_name'];
	                $data['link'] = $upload_path;
	                //$data['video_type'] = $video_data['file_type'];
	                //$this->handle_success('Video was successfully uploaded to direcoty <strong>' . $upload_path . '</strong>.');
	                $this->session->set_flashdata('add_rol','Video was successfully uploaded to direcoty');
	            }
	            if($_FILES['video_image']['name']){
	                $this->load->library('upload');
	                if($_FILES['video_image']['name']){
	                    $_FILES['file']['name']       = $_FILES['video_image']['name'];
	                    $_FILES['file']['type']       = $_FILES['video_image']['type'];
	                    $_FILES['file']['tmp_name']   = $_FILES['video_image']['tmp_name'];
	                    $_FILES['file']['error']      = $_FILES['video_image']['error'];
	                    $_FILES['file']['size']       = $_FILES['video_image']['size']; 
	                    $config = array();
	                    $config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/videos/images';
	                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	                    $config['max_size']      = '5000';
	                    $config['overwrite']     = FALSE;    
	                    $this->load->library('upload', $config);
	                    $this->upload->initialize($config);
	                    if($this->upload->do_upload('file')){
	                        $imageData = $this->upload->data();
	                        $uploadImgData = $imageData['file_name'];
	                    }else{
	                        $do = $this->upload->display_errors();
	                    }
	                    $image_name = $uploadImgData;
	                    $data['video_thumb'] = $image_name;
	                }
	            }
		        if($this->admin_detail->video_block_add($data)){
		        	//load the error and success messages
			        $data['errors'] = $this->error;
			        $data['success'] = $this->success;
			        //load the view along with data
					$this->session->set_flashdata('add_rol','Video created succesfully');
					//$this->load->view('admin/videos', $data);
					redirect('admin/videos');
					exit;
				}else{
					//load the error and success messages
			        $data['errors'] = $this->error;
			        $data['success'] = $this->success;
			        //load the view along with data
					$this->session->set_flashdata('add_rol','Problem with database');
					$this->load->view('admin/video_add', $data);
				}
			}else{
				$this->session->set_flashdata('add_rol','Please add video for upload');
				$this->load->view('admin/video_add', $data);
			}
        }else{
			$this->load->view('admin/video_add');
		}
	}
	public function video_add_editor()
	{
		$url = base_url('assets/admin/json/module.json');
		$string = file_get_contents($url); 
		$navigation = json_decode($string,true);
		
		$this->form_validation->set_rules('name','Name of Module','required|trim');
		$this->form_validation->set_error_delimiters('<div class="col-md-12" style="color:red; text-align:center;">', '</div>');
		if($this->form_validation->run('add_rol'))
		{
			$value['role_name'] = $this->input->post('name');
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$value['admin_id'] = $admin_data[0]['super_admin_id'];
			}else{
				$value['admin_id'] = $_SESSION['user_id'];
			}
			$name = $this->input->post('name');
			if($this->admin_detail->cheak_role($name))
			{
					$this->session->set_flashdata('add_rol','Please Choose Another Role Name.');
					$this->load->view('admin/video_add');
			}
			else
			{
				$val = implode(",",$_POST['module']);
				$value['module_list'] = $val;
				if($this->admin_detail->add_rol($value))
				{
					$this->load->view('admin/videos');
				}else{
					$this->session->set_flashdata('add_rol','There is Problem With Database.');
					$this->load->view('admin/video_add');
				}
			}
		}
		else{
			$this->load->view('admin/video_add');
		}	
	}

	public function get_video()
	{
		$name =  $this->input->get('name');
		$name = isset($name)?$name:'';
		$admin_id = '';
		if($_SESSION['status'] != 1){
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$admin_id = $admin_data[0]['super_admin_id'];
			}else{
				$admin_id = $_SESSION['user_id'];
			}
		}
		$url = base_url('assets/admin/json/module.json');
		$string = file_get_contents($url); 
		$navigation = json_decode($string,true);
		$detail = $this->admin_detail->get_video_block($name, $admin_id);
		//$detail = $this->api_model->product_search($name, $start, $perpage);
		if($detail)
		{
			$data = [];
			foreach($detail as $de){
				$image = explode(',',$de['video_thumb']);
				$de['video_thumb'] = base_url().'uploads/videos/images/'.$image[0];
				$data[] = $de;
			}
		}
		else
		{
			$json_data['error'] = '1';
		}
		//$data['count'] = $this->admin_detail->get_video_block_count($name);
		$json_data = $data;
		echo json_encode($json_data);
	}

	public function video_play() {
		$data['video_name']= $this->input->get_post('video');
		$this->load->view('admin/video_play', $data);
	}

	public function video_get_id($id)
	{
		$data['id']= $id;
		$this->load->view('admin/video_edit', $data);
	}
	public function video_edit($id)
	{
		$video['id'] = $id;
		$video['video'] = $this->admin_detail->get_video_block_by_id($id);
		$this->form_validation->set_rules('video_title','Title Required','required|trim');
		$this->form_validation->set_rules('video_price','Price Required','required|trim');
		$this->form_validation->set_error_delimiters('<div  class="col-md-12 error">', '</div>');
		if($this->form_validation->run('edit_video'))
		{
			$id = $this->input->get_post('video_id');
			$value['title'] = $this->input->post('video_title');
			$value['price'] = $this->input->post('video_price');
			$value['qualifications'] = $this->input->get_post('qualifications');
        	$value['institute'] = $this->input->get_post('institute');
        	if ($this->input->post('video_upload')) {
				if($_FILES['video_name']['name']) {
		            $upload_path = '/var/www/html/harpahu_merge_dev/uploads/videos';
		            $config['upload_path'] = $upload_path;
		            $config['allowed_types'] = 'wmv|mp4|avi|mov|3gp|flv|mp3';
		            $config['max_size'] = '0';
		            $config['max_filename'] = '255';
		            $config['encrypt_name'] = FALSE;
		            $video_data = array();
		            $is_file_error = FALSE;
		            if (!$_FILES) {
		                $is_file_error = TRUE;
		                $this->handle_error('Select a video file.');
		            }
		            if (!$is_file_error) {
		                $this->load->library('upload', $config);
		                if (!$this->upload->do_upload('video_name')) {
		                    $is_file_error = TRUE;
		                } else {
		                    $video_data = $this->upload->data();
		                }
		            }
		            if ($is_file_error) {
		            	$this->session->set_flashdata('add_rol','Please add video for upload');
		                if ($video_data) {
		                    $file = $upload_path . $video_data['file_name'];
		                    if (file_exists($file)) {
		                        unlink($file);
		                    }
		                }
		            }else{
		               $value['video'] = $video_data['file_name'];
		               $value['link'] = $upload_path;
		            }
				}
	        }
	        if($_FILES['video_image']['name']){
                $this->load->library('upload');
                if($_FILES['video_image']['name']){
                    $_FILES['file']['name']       = $_FILES['video_image']['name'];
                    $_FILES['file']['type']       = $_FILES['video_image']['type'];
                    $_FILES['file']['tmp_name']   = $_FILES['video_image']['tmp_name'];
                    $_FILES['file']['error']      = $_FILES['video_image']['error'];
                    $_FILES['file']['size']       = $_FILES['video_image']['size']; 
                    $config = array();
                    $config['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/videos/images';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']      = '5000';
                    $config['overwrite']     = FALSE;    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('file')){
                        $imageData = $this->upload->data();
                        $uploadImgData = $imageData['file_name'];
                    }else{
                        $do = $this->upload->display_errors();
                    }
                    $image_name = $uploadImgData;
                    $value['video_thumb'] = $image_name;
                }
            }
			if($this->admin_detail->edit_video_block($value, $id))
			{
				redirect('admin/videos');
				exit;
			}
			else
			{
				$this->session->set_flashdata('add_rol','There is Problem With Database.');
				$this->load->view('admin/video_edit', $video);
			}
		}
		else{
			$this->load->view('admin/video_edit', $video);
		}	
	}

	public function video_del()
	{
		$id = $this->input->get('id');
		$name =  $this->input->get('name');
		$name = isset($name)? $name:'';
		$admin_id = '';
		if($_SESSION['status'] != 1){
			if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
				$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
				$admin_id = $admin_data[0]['super_admin_id'];
			}else{
				$admin_id = $_SESSION['user_id'];
			}
		}
		$name_detail = $this->admin_detail->video_del($id);
		if($name_detail){
			$detail = $this->admin_detail->get_video_block($name, $admin_id);
			//$detail = $this->api_model->product_search($name, $start, $perpage);
			if($detail)
			{
				$data = [];
				foreach($detail as $de){
					$image = explode(',',$de['video_thumb']);
					$de['video_thumb'] = base_url().'uploads/videos/images/'.$image[0];
					$data[] = $de;
				}
			}
			else
			{
				$json_data['error'] = '1';
			}
			$json_data = $data;
			echo json_encode($json_data);
		}
	}

	public function package_uniqid_count(){
		$uniqid = $this->input->get_post('uniqid');
		$detail['count'] = $this->api_model->package_uniqid_count($uniqid);
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

	//apis listing function
	public function apislist(){
		$this->load->view('admin/apis_list');
	}
	public function apislist_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$user_id = $this->session->userdata("user_id");
		$detail = $this->api_model->get_account_search($name, $user_id, $start, $perpage);
		$detail['count'] = $this->api_model->get_account_count($name, $user_id);
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
	public function add_apis(){
		if(isset($_POST['submit'])){
			$data['linkurl'] = $this->input->get_post('linkurl');
			$data['description'] = $this->input->get_post('description');
			$data['detailsjson'] = $this->input->get_post('detailsjson');
			$data['method'] = $this->input->get_post('lom');
			$data['jsonresponse'] = $this->input->get_post('jsonresponse');
			$this->form_validation->set_rules('linkurl','Please check linkurl','required');
			$this->form_validation->set_rules('description','Please check description','required|trim');
			$this->form_validation->set_error_delimiters('<div class="col-md-12" style="color:red;text-align:center;">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				$data['created_on'] = date('Y-m-d h:i:s');
				$data['updated_on'] = date('Y-m-d h:i:s');
				$detail = $this->api_model->add_api_records($data);
				if($detail){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/apislist');
				}else{
					$this->session->set_flashdata('add_bank','There is problem with database.');
					redirect('admin/add_apis');
				}
			}else{
				$this->load->view('admin/add_apis');
			}
		}else{
			$this->load->view('admin/add_apis');
		}
	}
	public function apis_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$user_id = $this->session->userdata("user_id");
		$detail = $this->api_model->get_apis_search($name, $user_id, $start, $perpage);
		$detail['count'] = $this->api_model->get_apis_count($name, $user_id);
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

	public function apis_del()
	{
		$id = $this->input->get('id');
		$name =  $this->input->get('name');
		$name = isset($name)? $name:'';
		$name_detail = $this->admin_detail->apis_del($id);
		if($name_detail){
			$detail = $this->admin_detail->get_apis_block($name);
		
			if($detail)
			{
				$data = $detail;
			}
			else
			{
				$json_data['error'] = '1';
			}
			$json_data = $data;
			echo json_encode($json_data);
		}
	}

	public function apis_edit($id)
	{
		$details['id'] = $id;
		$details['details'] = $this->admin_detail->get_apis_by_id($id);
		//print_r($api[0]['api_id']); die();
		if(isset($_POST['submit'])){
			$data['linkurl'] = $this->input->get_post('linkurl');
			$data['description'] = $this->input->get_post('description');
			$data['detailsjson'] = $this->input->get_post('detailsjson');
			$data['method'] = $this->input->get_post('lom');
			$data['jsonresponse'] = $this->input->get_post('jsonresponse');
			$this->form_validation->set_rules('linkurl','Please check linkurl','required');
			$this->form_validation->set_rules('description','Please check description','required|trim');
			$this->form_validation->set_error_delimiters('<div class="col-md-12" style="color:red;text-align:center;">', '</div>');			
			if($this->form_validation->run('add_bank'))
			{
				$data['created_on'] = date('Y-m-d h:i:s');
				$data['updated_on'] = date('Y-m-d h:i:s');
				$detail = $this->admin_detail->edit_apis($data, $id);
				if($detail){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/apislist');
				}else{
					$this->session->set_flashdata('add_bank','There is problem with database.');
					redirect('admin/edit_apis');
				}
			}else{
				$this->load->view('admin/edit_apis', $details);
			}
		} else {
			$this->load->view('admin/edit_apis', $details);
		}	
	}

	//function for sale reports
	public function salereports(){
		$this->load->view('admin/sale_reports');
	}
	
	public function salereports_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$user_id = $this->session->userdata("user_id");
		$detail = $this->api_model->get_salereports_search($name, $user_id, $start, $perpage);
		$detail['count'] = $this->api_model->get_salereports_count($name, $user_id);
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

	//language_library changes in our application
	public function language_library(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/language_library');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function language_library_add(){
		$allLangues['allLangues'] = $this->api_model->get_all_languages();
		if(isset($_POST['submit'])){
			$data['language_id'] = $this->input->get_post('language_id');
			$data['key'] = $this->input->get_post('key');
			$data['description'] = $this->input->get_post('description');
			//$data['code'] = $this->input->get_post('code');
			$this->form_validation->set_rules('language_id','Please check language_id','required');
			$this->form_validation->set_rules('key','Please check key','required|trim');
			$this->form_validation->set_rules('description','Please check description','required|trim');
			$this->form_validation->set_error_delimiters('<div class="col-md-12" style="color:red;text-align:center;">', '</div>');		
			if($this->form_validation->run('add_bank'))
			{
				$data['created_on'] = date('Y-m-d h:i:s');
				$data['updated_on'] = date('Y-m-d h:i:s');
				if($this->api_model->language_library_save($data)){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect(base_url('admin/language_library'));
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/language_library_add');
					$this->load->view('admin/layouts/admin_footer', $allLangues);
				}
			}else{
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/language_library_add', $allLangues);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/language_library_add', $allLangues);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function language_library_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->language_library_search($name, $start, $perpage);
		$detail['count'] = $this->api_model->get_language_library_count($name);
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
	public function language_library_status(){
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['is_activate'] = $status;
		if($this->api_model->language_library_status($id, $data))
		{
			$product_data = $this->api_model->language_library_search($name, $start,$perpage);
			$product_data['count']= $this->api_model->get_language_library_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			echo json_encode($json_data);
		}
	}

	public function language_library_del()
	{
		$id = $this->input->get('id');
		$name =  $this->input->get('name');
		$name = isset($name)? $name:'';
		$name_detail = $this->admin_detail->language_library_del($id);
		if($name_detail){
			$detail = $this->admin_detail->get_language_library($name);
		
			if($detail)
			{
				$data = $detail;
			}
			else
			{
				$json_data['error'] = '1';
			}
			$json_data = $data;
			echo json_encode($json_data);
		}
	}

	public function language_library_edit($id)
	{
		$details['id'] = $id;
		$details['details'] = $this->admin_detail->get_language_library_by_id($id);
		$details['allLangues'] = $this->api_model->get_all_languages();
		if(isset($_POST['submit'])){
			$data['language_id'] = $this->input->get_post('language_id');
			$data['key'] = $this->input->get_post('key');
			$data['description'] = $this->input->get_post('description');
			//$data['code'] = $this->input->get_post('code');
			$this->form_validation->set_rules('language_id','Please check language_id','required');
			$this->form_validation->set_rules('key','Please check key','required|trim');
			$this->form_validation->set_rules('description','Please check description','required|trim');
			$this->form_validation->set_error_delimiters('<div class="col-md-12" style="color:red;text-align:center;">', '</div>');
			if($this->form_validation->run('add_bank'))
			{
				$data['created_on'] = date('Y-m-d h:i:s');
				$data['updated_on'] = date('Y-m-d h:i:s');
				$detail = $this->admin_detail->edit_language_library($data, $id);
				if($detail){
					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					redirect('admin/language_library');
				}else{
					$this->session->set_flashdata('add_bank','There is problem with database.');
					redirect('admin/language_library_edit');
				}
			}else{
				$this->load->view('admin/language_library_edit', $details);
			}
		} else {
			$this->load->view('admin/language_library_edit', $details);
		}	
	}
	 
	public function test()
	{
		$this->load->view('admin/test_list.php');
	}
	public function test_list()
	{
		$detail = $this->admin_detail->test_list();
		if($detail!='')
			{
		   		$json_data = $detail;
		  	}
		  else
		  	{
		 	  $json_data['error'] = '1';
		 	}
		echo json_encode($json_data);
	}
	public function add_test()
	{
		$this->load->view('admin/add_test');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		return redirect('');
	}
	public function sub_dis_doc($id){
		$data['data'] = $this->api_model->get_data('doctor_id = '.$id.'', 'doctor','','refral_code');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/sub_dis_doc', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function location_update($id){
		$data['doctor_id'] = $id;
		//print_r($data);
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/location_update',$data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function set_location_dis(){
		//$data['doctor_id'] = $id; 
		if(isset($_POST["location"])){		
		$data['address_full'] = $this->input->get_post('city2');
		$data['latitude'] = $this->input->get_post('cityLat');
		$data['longitude'] = $this->input->get_post('cityLng');
		$doctor_id = $this->input->get_post('doctor_id');
		// print_r($data);
		// print_r($doctor_id);
		// exit;
		//$user_id = $this->session->userdata('user_id');		
		$this->api_model->update('doctor_id', $doctor_id, 'doctor', $data);
		redirect('admin/dis_list');
		// redirect(base_url('admin/location_update($id)'));
		// $this->load->view('admin/layouts/admin_header');
		// $this->load->view('admin/layouts/admin_nav');
		// $this->load->view('admin/location_update');
		// $this->load->view('admin/layouts/admin_footer');

		}
	}
	public function manager_reg(){
		$data['image'] = $this->input->post('animal_image');
		$data['username'] = $this->input->post('name');
		$data['refral_by_code'] = $this->input->post('r_code');	
		$data['last_name'] = $this->input->post('lname');
		$data['mobile'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');
		$district_code = $this->input->post('district1');
		$data['district_code'] = implode(',', $district_code);
		$state = $this->input->post('state1');
		$data['state_code'] = implode(',', $state);
		$data['address_full'] = $this->input->post('address');
		$data['users_type'] = $this->input->post('type');
		$data['company_partner'] = '1';		
		$data['date'] = date('Y-m-d h:i:s');		
		$password = $this->input->post('password');
		$conf_password = $this->input->post('conf_password');
		$data['password'] = md5($password);
		$num_str = sprintf("%08d", mt_rand(1, 99999999));
        $data['refral_code'] = $num_str;
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('phone','Phone','required|trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$info['data'] = $data;
		if($this->form_validation->run('role_add')){
			if($password!='' || $conf_password!='')
			{
				if($password == $conf_password)
				{
					$result = $this->admin_detail->post_manager_users($data);
					if($result)
						$this->load->view('admin/dis_list');
					else{
						$this->session->set_flashdata('superv_add','There is problem with database.');
						$this->load->view('admin/district_manager_reg', $info);
					}
				}
				else{
					$this->session->set_flashdata('superv_add','Password and Confirm Password is Not Matched');
					$this->load->view('admin/district_manager_reg', $info);
				}
			}
			else{
				$this->session->set_flashdata('superv_add','Password and Confirm Password is Not BlanK');
				$this->load->view('admin/district_manager_reg', $info);
			}
			
		}
		else{
			$this->load->view('admin/district_manager_reg');
		}
	}
	public function district_manager_reg(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/district_manager_reg');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function dis_list()	
	{
		$this->load->view('admin/dis_list');
	}
	public function yield_test_request(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/yield_test_request');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function yield_test_search()
	{
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->api_model->yield_test_search($name, $start, $perpage);
		$detail['count']= $this->api_model->get_yield_count($name); 
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
	public function yield_test_view($id){
		$detail['user_id'] = $id;
		$this->load->view('admin/yield_test_view',$detail);
	}
	public function yield_video_upload(){
		if(isset($_POST['submit'])){
			$data['users_id']= $this->input->get_post('user_id');
			$data['animal_id']= $this->input->get_post('animal_id');
			$data['video']= $this->input->get_post('video_name');
			$data['second_video']= $this->input->get_post('video_name2');
			$yield1= $this->input->get_post('yield1');
			$data['first_yield'] = $yield1;
			$yield2= $this->input->get_post('yield2');
			$data['second_yield'] = $yield2;
			$yield = $yield1 + $yield2;
			$update['yield'] = $yield/2;			
			$data['first_date']= $this->input->get_post('first_date');
			$data['second_date']= $this->input->get_post('second_date');
			//$update['update_on']=$data['updated_on'];
			if($this->api_model->submit('animals_yield_check', $data)){
				$this->api_model->get_data_update('animal_id = "'.$data['animal_id'].'"', 'animals', $update);
					//$this->session->set_flashdata('msg','Your Data Succesfully Inserted');
                    redirect(base_url('admin/yield_test_request'));
				}else{
					redirect(base_url('admin/yield_test_view'));
				}

		}
	}
	public function upload_vedio(){
			$path = $this->input->get_post('path');
            $upload_path = '/var/www/html/harpahu_merge_dev/uploads/'.$path.'/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = FALSE;
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
	public function get_yiled_verified_animal(){
		$animal_id = $this->input->get_post('animal_id');	
		if(!isset($_REQUEST['animal_id']) || $_REQUEST['animal_id'] == ''){
			$json['success'] = false;
			$json['error'] = 'Please send Animal id';
		}else{		
		$detail = $this->api_model->get_data('animal_id = '.$animal_id.'', 'animals_yield_check', '', 'animal_id,users_id,first_yield,second_yield,first_date,second_date,CONCAT("'.IMAGE_PATH.'harpahu_merge_dev/uploads/animal_yield/",video) as first_video,CONCAT("'.IMAGE_PATH.'harpahu_merge_dev/uploads/animal_yield/",second_video) as second_video,(SELECT yield from animals where animal_id = '.$animal_id.') as average_yield');;
		if($detail){
			$json['success'] = true;
				$json['data'] = $detail;
			}else{
				$json['success'] = false;
				$json['error'] = "Database error.";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function vendor(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/vendor');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function vendor_register($type){
		$data['user_type'] = $type;
		if($_POST['submit']){	
			// print_r($_REQUEST);
			// exit;
			$data['mobile'] = $this->input->get_post('mobile');
			$data['authorisation_letter'] = $this->input->get_post('authorization');
			$data['image'] = $this->input->get_post('image');
			// $data['bank_name'] = $this->input->get_post('name');
			$data['fname'] = $this->input->get_post('name');
			$data['super_admin_id'] = $this->input->get_post('vendor_id');
			$data['bank_name'] = $this->input->get_post('company');
			$data['pan_no'] = $this->input->get_post('pan_number');
			$data['gst_no'] = $this->input->get_post('gst_number');
			$data['cin'] = $this->input->get_post('cin');
			$type_user = $this->input->get_post('type_user');
			$data['address'] = $this->input->get_post('address1').$this->input->get_post('address2');
			$data['state'] = $this->input->get_post('state');
			if($_SESSION['status'] == '30'){
				$data['hub'] = $_SESSION['user_id'];
			}
			if($_SESSION['status'] == '31'){
				$data['hub'] = $_SESSION['user_id'];
				$admin = $this->api_model->get_data('admin_id = "'.$_SESSION['user_id'].'"', 'admin');
				$data['hubemp'] = $admin[0]['super_admin_id'];
			}
			$data['district'] = $this->input->get_post('district');
			$data['adhar_no'] = $this->input->get_post('adhar_no');
			$data['pin'] = $this->input->get_post('pin');
			$data['proprietorship_ship'] = $this->input->get_post('bill');
			$data['proprietorship_document'] = $this->input->get_post('partnership');			
			$data['email'] = $this->input->get_post('email');
			$data['password'] = md5($this->input->get_post('password'));			
			$data['type'] = $this->input->get_post('company_type');
			$data['latitude'] = $this->input->get_post('cityLat');
			$data['longitude'] = $this->input->get_post('cityLng');
			$this->form_validation->set_rules('email','Please Enter Email','required|trim');
			$this->form_validation->set_rules('name','Please Enter Name','required|trim');			
			$this->form_validation->set_rules('mobile','Please Enter mobile','numeric|required|trim');
			$this->form_validation->set_rules('state','Please Enter State','required');
			$this->form_validation->set_message('pin', 'Please Enter Pin','required');
			$this->form_validation->set_message('adhar_no', 'Please Enter Pin','required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				$data['created_on'] = date('Y-m-d h:i:s');
				if($this->api_model->comp_mobile_email($data['mobile'])){
					$this->session->set_flashdata('add_bank','Mobile No is already associated with other Account');
					$data['type'] = $this->input->get_post('company_type');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/vendor_register', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
				else if(!$email_data = $this->api_model->check_company_seman_email($data['email'])){
					if($detail = $this->api_model->add_bank($data)){
							$this->session->set_flashdata('add_bank','Your data is Inserted.');
							if($type == 1){
								redirect('admin/vendor');
							}else if($type == 2){
								redirect('admin/vendor');
							} else if($type == 3){
								redirect('admin/vendor');
							}
							
					}else{
						$this->session->set_flashdata('add_bank','Error with database');
						$data['type'] = $this->input->get_post('type_user');
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/vendor_register', $data);
						$this->load->view('admin/layouts/admin_footer');
					}
				}else{
					$this->session->set_flashdata('add_bank','Email ID is already associated with other Account');
					$data['type'] = $this->input->get_post('type_user');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/vendor_register', $data);
					$this->load->view('admin/layouts/admin_footer');
				}
			}else{
				//$data['type'] = $this->input->get_post('type_user');
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/vendor_register', $data);
				$this->load->view('admin/layouts/admin_footer');
			}
		}else{
			//$data['type'] = $type;
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/vendor_register', $data);
			$this->load->view('admin/layouts/admin_footer');
		}
	}
	public function payment(){
		$this->load->view('admin/payment');
	}
	public function pet_vaccination(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/pet_vaccination');	
		$this->load->view('admin/layouts/admin_footer');
	}
	public function pet_vaccination_view($id){
		$data['id'] = $id;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/pet_vaccination_view',$data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function pet_vaccination_edit($id){
		$data['id'] = $id;
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/pet_vaccination_edit',$data);
		$this->load->view('admin/layouts/admin_footer');
	}
	public function pet_vaccination_update(){
		
		// print_r($_REQUEST);
		// exit;
		$id = $this->input->post('package_id');
		$data['package_type_id'] = $this->input->post('package_type_id');
		$data['package_name'] = $this->input->post('package_name');
		$data['package_days'] = $this->input->post('package_days');
		$data['package_callnum'] = $this->input->post('package_call');
		$data['package_price'] = $this->input->post('package_price');
		$data['package_discount_percent'] = $this->input->post('package_discount_percent');
		$data['gst_percent'] = $this->input->post('gst_percent');
		$data['features'] = $this->input->post('features');
		$data['package_desc'] = $this->input->post('package_desc');
		$data['package_short_desc'] = $this->input->post('package_short_desc');
		$data['image'] = $this->input->post('animal_image');
		$data['isactivated'] = $this->input->get_post('isactivated');
		$data['updated_on'] = date('Y-m-d H:i:s');
		$this->form_validation->set_rules('package_name','Please enter Package Name ','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('add_bank')){
			if($this->api_model->update('package_id', $id, 'package_masters', $data))
				redirect('admin/pet_vaccination', 'refresh');
				//$this->load->view('admin/pet_vaccination_view', $info);
			else{
				$this->session->set_flashdata('add_bank','There is problem with database.');
				//$this->load->view('admin/pet_vaccination_edit', $info);
				redirect('admin/pet_vaccination_edit', 'refresh');
			}
		}
		else{
			redirect('admin/pet_vaccination_edit', 'refresh');
		}
	}
	public function pet_vacc_add(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/pet_vaccination_add');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function pet_vaccination_add(){
		// $id = $this->input->post('id');
		$data['package_type_id'] = $this->input->post('package_type_id');
		$data['package_name'] = $this->input->post('package_name');
		$data['package_days'] = $this->input->post('package_days');
		$data['package_callnum'] = $this->input->post('package_call');
		$data['package_price'] = $this->input->post('package_price');
		$data['doc_price'] = $this->input->post('doc_price');
		$data['company_price'] = $this->input->post('company_price');
		$data['package_discount_percent'] = $this->input->post('package_discount_percent');
		$data['gst_percent'] = $this->input->post('gst_percent');
		$data['features'] = $this->input->post('features');
		$data['package_desc'] = $this->input->post('package_desc');
		$data['package_short_desc'] = $this->input->post('package_short_desc');
		$data['image'] = $this->input->post('animal_image');
		$data['isactivated'] = '1';
		$data['created_on'] = date('Y-m-d H:i:s');
		$this->form_validation->set_rules('package_name','Please enter Package Name ','required|trim');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('add_bank')){
			if($this->api_model->submit('package_masters', $data))
				//$this->load->view('admin/pet_vaccination_view', $info);
				redirect('admin/pet_vaccination', 'refresh');
			else{
				$this->session->set_flashdata('add_bank','There is problem with database.');
				//$this->load->view('admin/pet_vacc_add', $info);
				redirect('admin/pet_vacc_add', 'refresh');
				//direct('admin/pet_vacc_add');
			}
		}
		else{
			//$this->load->view('admin/pet_vacc_add');
			redirect('admin/pet_vacc_add', 'refresh');
		}
	}
	public function upgrade_ai_worker(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/upgrade_ai_worker');
		$this->load->view('admin/layouts/admin_footer');

	}
	public function upgrade_to_worker(){
		if($_POST['submit']){
			$referral_code = $this->input->get_post('referral_code');
			$mobile = $this->input->get_post('mobile');
			$transaction_id = $this->input->get_post('transaction_id');
			$da['is_premium'] = '1';
			$da['is_paid'] = '1';
			if($mob = $this->api_model->get_data('mobile = "'.$mobile.'" AND users_type IN ("pvt_vt","pvt_ai")', 'doctor', '', 'doctor_id,mobile,doctor_id')){
				// print_r($mob[0]['mobile']);
				// exit;
				if($referral_code !== ''){					
					if($data = $this->api_model->get_data('referral_code = "'.$referral_code.'"', 'admin', '', 'admin_id,referral_code')){
						$da['refral_by_code'] = $data[0]['referral_code'];
						$da['admin_id'] = $data[0]['admin_id'];						
						if($data[0]['referral_code'] != ''){
							$log['type'] = '19';
							$log['payment_type'] = 'Cr';
							$log['users_id'] = $mob[0]['doctor_id'];
							$log['currency'] = 'INR';
							$log['status'] = '1';
							$log['amount'] = '500';
							$log['user_type'] = '2';
							$log['transaction_id'] = $transaction_id;
							$log['date'] = date('Y-m-d h:i:s');
							$log['method'] = 'COD';
							$log_id = $this->api_model->submit('log_file', $log);							
							$detail = $this->api_model->get_data_update('mobile = "'.$mob[0]['mobile'].'"', 'doctors', $da);
							$this->load->view('admin/upgrade_ai');						
						}else{
							$log['type'] = '19';
							$log['payment_type'] = 'Cr';
							$log['users_id'] = $mob[0]['doctor_id'];
							$log['currency'] = 'INR';
							$log['status'] = '1';
							$log['amount'] = '500';
							$log['user_type'] = '2';
							$log['transaction_id'] = $transaction_id;
							$log['date'] = date('Y-m-d h:i:s');
							$log['method'] = 'COD';
							$log_id = $this->api_model->submit('log_file', $log);							
							$detail = $this->api_model->get_data_update('mobile = "'.$mob[0]['mobile'].'"', 'doctor', $da);
							$this->load->view('admin/upgrade_ai');
						}
					}else{
						$this->load->view('admin/layouts/admin_header');
						$this->load->view('admin/layouts/admin_nav');
						$this->load->view('admin/upgrade_ai_worker');
						$this->load->view('admin/layouts/admin_footer');
						echo '<script language="javascript">alert("please enter valid referral code")</script>';
					}						
				}else{
					$log['type'] = '19';
					$log['payment_type'] = 'Cr';
					$log['users_id'] = $mob[0]['doctor_id'];
					$log['currency'] = 'INR';
					$log['status'] = '1';
					$log['amount'] = '500';
					$log['user_type'] = '2';
					$log['transaction_id'] = $transaction_id;
					$log['date'] = date('Y-m-d h:i:s');
					$log['method'] = 'COD';
					$log_id = $this->api_model->submit('log_file', $log);
					$detail = $this->api_model->get_data_update('mobile = "'.$mob[0]['mobile'].'"', 'doctor', $da);
					$this->load->view('admin/upgrade_ai');
				}
			}else{
				echo '<script language="javascript">alert("Nobile number not registered")</script>';
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/upgrade_ai_worker');
					$this->load->view('admin/layouts/admin_footer');
			}		
		}else{
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/layouts/admin_nav');
			$this->load->view('admin/upgrade_ai_worker');
			$this->load->view('admin/layouts/admin_footer');
		}	
	}
	public function upgrade_ai(){
		$this->load->view('admin/upgrade_ai');
	}
	public function ai_account_search(){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
		$detail = $this->api_model->ai_account($name, $start, $perpage);
		//$mob = $this->api_model->get_data('is_premium = "1" AND is_paid = "1" AND users_type IN ("pvt_vt,pvt_ai")', 'doctor', '', '*,(SELECT amount FROM log_file WHERE users_id = doctor_id ) as total_amount');
		$detail['count'] = $this->api_model->ai_account_count($name);
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
	public function users_premium(){
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/user_premium');
		$this->load->view('admin/layouts/admin_footer');
	}
	public function user_update_premium(){
		$package_id = $this->input->get_post('package_id');
		$package_price = $this->input->get_post('package_price');
		$admin_id = $this->input->get_post('admin_id');
		$promo_balance = $this->input->get_post('promo_balance');
		$ai_promo_balance = $this->input->get_post('ai_promo_balance');
		$mobile = $this->input->get_post('mobile');
		$app_type = '0';
		$type = '32';
		 if($details = $this->api_model->get_data('mobile = "'.$mobile.'"', 'users')){
			$this->api_model->get_data('id = "'.$package_id.'" AND is_active = "1"', 'farmer_plans');
			$log['users_id'] = $details[0]['users_id'];
			$log['currency'] = 'INR';
			$log['type'] = $type;
			$log['amount'] = $package_price;
			$log['user_type'] = '0';
			$log['premium_bull_type'] = '';
			$log['request_status'] = isset($request_status) ? $request_status : 0;
			$log['date'] = date('Y-m-d h:i:s');
			$log_id = $this->api_model->insert_log_data($log);
			$a['log_id'] = $log_id[0]['purchase_id'];
			$logid = $log_id[0]['purchase_id'];
			$update['payment_type'] = 'Cr';
			$update['date'] = date('Y-m-d H:i:s');
			$update['method'] = "COD";
			$this->api_model->update('id', $log_id[0]['purchase_id'],'log_file', $update);
			$date = date('Y-m-d H:i:s');
			$data_pack['users_id'] = $details[0]['users_id'];
			$data_pack['package_id'] = $package_id;
			$data_pack['animal_quantity'] = '0';
			$data_pack['rest_quantity'] = '0';
			$data_pack['payment_type'] = '32';
			$data_pack['package_price'] = $package_price;
			$data_pack['admin_id'] = $admin_id;
			$data_pack['date'] = date('Y-m-d');
			$this->api_model->submit('ai_package_log', $data_pack);
			if($promo_balance != '0'){									
				$wall_data['log_id'] = $log_id[0]['purchase_id'];
				$wall_data['users_id'] = $details[0]['users_id'];
				$wall_data['user_type'] = '0';
				$wall_data['amount'] = $promo_balance;
				$wall_data['status'] = 'Cr';
				$wall_data['wallet_type'] = '0';
				$wall_data['date'] = date('Y-m-d h:i:s');
				$this->api_model->submit('livestoc_wallets', $wall_data);
				}
				echo '<script language="javascript">alert("User Successfully Premium")</script>';
				redirect('/admin/user');
		}else{
				echo '<script language="javascript">alert("Nobile number not registered")</script>';
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/layouts/admin_nav');
				$this->load->view('admin/user_premium');
				$this->load->view('admin/layouts/admin_footer');   
			}
	}

}