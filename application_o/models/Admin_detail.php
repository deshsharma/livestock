<?php 
class Admin_detail extends CI_Model {
	public function get_detail($id)
	{
		$q = $this->db->where('admin_id', $id)->get('admin')->result_array();
		if ( $q !="") {
			return $q;
		} else {
			return FALSE;
		}
	}
	public function getfarmer_count(){
		$detail = $this->db->get('admin')->num_rows();
		return $detail;
	}
	public function get_data($table, $where = ''){
		if($where != ''){
			$this->db->where($where);
		}
		return $this->db->get($table)->result_array();
	}
	public function get_product_lead($product_id = ''){
		if($product_id != ''){
			$this->db->where('product_id', $product_id);
		}
		$this->db->where('isactive', '1');
		$detail = $this->db->get('produc_interest')->result_array();
		return $detail;
	}
	public function post_manager_users($data)
	{
		if($this->db->insert('doctor', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	public function get_district_manager($name='', $admin_id = '')
	{	
		
		if($detail = $this->db->where('users_type  = "pvt_dis" AND refral_by_code =""')->get('doctor')->result_array()){
			return $detail;
		}else{
			return false;
		}
		
	}
	public function getorder_count(){
		//changed for order count in desboard
		//$detail = $this->db->get('m_order')->num_rows();
		$detail = $this->db->get('purchase')->num_rows();
		return $detail;
	}
	public function get_country(){
		$detail = $this->db->where('isactivated = "1"')->get('m_country')->result_array();
		return $detail; 
	}
	public function company_add($data){
		if($this->db->insert('company_detail', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function seman_company_add($data){
		if($this->db->insert('seman_comp_detail', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function add_farm_comp($data){
		if($this->db->insert('dary_company_detail', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function get_city($id){
		$detail = $this->db->where('isactivated = "1" AND state_id = "'.$id.'"')->get('m_city')->result_array();
		return $detail;
	}
	public function get_state($id){
		$detail = $this->db->where('isactivated = "1" AND country_id = "'.$id.'"')->get('m_state')->result_array();
		return $detail;
	}
	public function get_location($id){
		$detail = $this->db->where('isactivated = "1" AND city_id = "'.$id.'"')->get('m_location')->result_array();
		return $detail;
	}
	public function getcoustomer_count(){
		$detail = $this->db->get('admin')->num_rows();
		return $detail;
	}
	public function getproduct_count(){
		//commented code for old deshboard
		//$detail = $this->db->get('m_product')->num_rows();
		$detail = $this->db->get('product')->num_rows();
		return $detail;
	}
	public function get_animal_detail()
	{
		$detail = $this->db->where('isactivated = "1" '.$and.'')->get('m_animal_cat')->result_array();
		return $detail;
	}
	public function get_animal_detail_id($id){
		$detail = $this->db->where('isactivated = "1" AND id="'.$id.'"')->get('m_animal_cat')->result_array();
		return $detail;
	}
	public function get_animal_breed_cat_id($id)
	{
		$detail = $this->db->where('isactivated = "1" AND a_cat_id="'.$id.'"')->get('m_breed')->result_array();
		return $detail;
	}
	public function get_animal_breed()
	{
		$detail = $this->db->where('isactivated', '1')->get('m_breed')->result_array();
		return $detail;
	}
	public function push_detail($data, $id)
	{
		$this->db->where('admin_id', $id);
		$res = $this->db->update('admin', $data);
		return $res; 
	}
	public function chanege_pass($data)
	{
		$insert_data = array(
		'password' => md5($data['password'])
		);
		$this->db->where('id', $data['id']);
		$res = $this->db->update('m_user', $insert_data);
		return $res; 
	}
	public function get_about_us()
	{
		$detail = $this->db->where('id', '1')->get('m_about_us')->result_array();
		return $detail;
	}
	public function update_about_us($data)
	{
		$detail = $this->db->where('id', '1')->update('m_about_us',  $data);
		if($detail)
			return True;
		else
			return false;
	}
	public function get_address()
	{
		$detail = $this->db->where('id', '1')->get('m_address')->result_array();
		return $detail;
	}
	public function update_address($data)
	{
		if($this->db->where('id', '1')->update('m_address', $data))
			return true;
		else
			return false;
	}
	public function search($data='')
	{
	
		$detail = $this->db->where("(status='2' && name LIKE '%".$data['name']."%' && email LIKE '%".$data['email']."%') AND approval = '1'")->get('m_user')->result_array();
		return $detail;
	}
	public function reg_search($data)
	{
		$detail = $this->db->where("(status=5 && name LIKE '%".$data['name']."%' && email LIKE '%".$data['email']."%') AND approval = '1'")->get('m_user')->result_array();
		return $detail;
	}
	public function reg_search_id($id)
	{
		$this->db->from('m_user')
         ->join('m_fif_form', 'm_user.id = m_fif_form.user_id');
		$query = $this->db->get()->result_array();
		//$detail = $this->db->where('id', $id)->get('m_user')->result_array();
		return $query;
	}
	public function user_reg_id($id)
	{
		//$query = $this->db->where('id',$id)->get('m_user')->result_array();
		$detail = $this->db->where('id', $id)->get('m_user')->result_array();
		return $detail;
	}
	public function nomnee($id)
	{
		$query = $this->db->where('user_id',$id)->get('m_fif_member')->result_array();
		return $query;
	}
	public function product_search($data = 0)
	{
		$detail = $this->db->where("(product_name LIKE '%".$data['name']."%')")->get('m_product')->result_array();
		return $detail;	
	}
	public function add_rol($data)
	{
		//print_r($data);
		if($this->db->insert('role', $data))
			return true;
		else
			return false;
	}
	public function cheak_role($data)
	{
		$role = $this->db->where('role_name', $data)->get('role')->result_array();
		if($role)
			return $role;
		else
			return false;
	}
	public function get_role($name='', $admin_id = '')
	{
		if($name != ''){
			$this->db->where('role_name like "%'.$name.'%"');
		}if($admin_id != ''){
			$this->db->where('admin_id', $admin_id);
		}
		if($detail = $this->db->get('role')->result_array()){
			return $detail;
		}else{
			return false;
		}
		
	}
	public function get_role_bank($id = '', $admin_id = '')
	{
		$where = '';
		if($id != ''){
			$id = explode(',', $id);
			$i = 0;
			foreach($id as $d){
					$where .=' OR id = '.$d.'';
			}
			//$this->db->where($where);
		}	
		if($admin_id != ''){
			$this->db->where('admin_id = '.$admin_id.' '.$where.'');
		}
		if($detail = $this->db->get('role')->result_array()){
			return $detail;
		}else{
			return false;
		}
		
	}
	public function get_category($data='')
	{
		$detail = $this->db->where("category LIKE '%".$data['name']."%'")->get('category')->result_array();
		return $detail;
	}
	
	public function category_isactivated($id, $data){
	if($this->db->where('id', $id)->update('m_category', $data))
		return true;
	else
		return false;
	}
	public function subcategory_isactivated($id, $data){
	if($this->db->where('id', $id)->update('m_subcategory', $data))
		return true;
	else
		return false;
	}
	public function get_unit($data)
	{
		$detail = $this->db->where("name LIKE '%".$data['name']."%'")->get('m_unit')->result_array();
		return $detail;
	}
	public function get_subcategory($data ='')
	{
		$detail = $this->db->query('SELECT m_subcategory.id,m_subcategory.name,m_subcategory.image,m_subcategory.isactive, m_category.name as cat_name FROM `m_subcategory`, `m_category` WHERE m_subcategory.cat_id = m_category.id AND m_subcategory.name LIKE "%'.$data['name'].'%"')->result_array();
		// $this->db->select('m_subcategory.*,m_category.name as cat_name');
		// $this->db->from('m_subcategory');
		// $this->db->join('m_category', 'm_subcategory.cat_id = m_category.id'); 
		//$detail = $this->db->get();
		// return $query->result();
		// $detail = $this->db->get('m_subcategory')->result_array();
		return $detail;
	}
	public function get_unit_id($id=false)
	{
		$detail = $this->db->where('id',$id)->get('m_unit')->row_array();
		return $detail;
	}
	public function get_category_id($id=false)
	{
		$detail = $this->db->where('id',$id)->get('m_category')->row_array();
		return $detail;
	}
	public function get_subcategory_id($id=false)
	{
		$detail = $this->db->where('id',$id)->get('m_subcategory')->result();
		return $detail;
	}
	public function get_subcategory_cat_id($id=false){
		$detail = $this->db->where('cat_id',$id)->get('m_subcategory')->result();
		return $detail;
	}
	public function get_rol_id($id=false)
	{
		$detail = $this->db->where('id',$id)->get('role')->row_array();
		return $detail; 
	}
	public function role_edit($data, $id)
	{
		$detail = $this->db->where('id',$id)->update('role', $data);
		return $detail;
	}
	public function category_edit($data, $id)
	{
		$detail = $this->db->where('id',$id)->update('m_category', $data);
		return $detail;
	}
	public function subcategory_edit($data, $id)
	{
		$detail = $this->db->where('id',$id)->update('m_subcategory', $data);
		return $detail;
	}
	public function subcategory_del($id)
	{
		$detail = $this->db->where('id',$id)->delete('m_subcategory');
		return True;
	}
	public function unit_del($id,$data)
	{
		$detail = $this->db->where('id',$id)->update('m_unit', $data);
		
		return True;
	}
	public function category_del($id)
	{
		$detail = $this->db->where('id',$id)->delete('m_category');
		return True;
	}
	public function emp_att($data)
	{
		$detail = $this->db->insert('m_emp_attendence', $data);
		return True;
	}
	public function role_del($id)
	{
		$detail = $this->db->where('id',$id)->delete('role');
		return True;
	}
	public function user_delete($id)
	{
		$detail = $this->db->where('id',$id)->delete('m_user');
		if($detail){
			return true;
		}
		else{
			return false;
		}
	}
	public function product_list($data = ''){
		$detail = $this->db->get_where('m_product')->result_array();
		if($detail){
			return $detail;
		}
		else{
			return false;
		}
	}
	public function superv_list()
	{
		$detail = $this->db->get_where('m_user', array('status =' => FARMER))->result_array();
		if($detail){
			return $detail;
		}
		else{
			return false;
		}
	}
	public function employee_list()
	{
		$detail = $this->db->get_where('m_user', array('status =' => '0'))->result_array();
		if($detail){
			return $detail;
		}
		else{
			return false;
		}
	}
	public function get_emp(){
		//$detail = $this->db->get_where('m_user',array('date !='=> date("Y-m-d h:i:s")))->result_array();
		$detail = $this->db->query('select m_user.* from  m_user , m_emp_attendence where NOT m_user.id = m_emp_attendence.user_id AND NOT m_emp_attendence.date="'.date('Y-m-d h:i:s').'"')->result_array();
		if($detail){
			return $detail;
		}
		else{
			return false;
		}
	}
	public function get_emp_rep(){
		//$detail = $this->db->get_where('m_user',array('date !='=> date("Y-m-d h:i:s")))->result_array();
		$detail = $this->db->query('select m_user.*, m_emp_attendence.date as att_date from  m_user , m_emp_attendence where m_user.id = m_emp_attendence.user_id')->result_array();
		if($detail){
			return $detail;
		}
		else{
			return false;
		}
	}
	public function input_category($data)
	{
		if($this->db->insert('m_category', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function input_subcategory($data)
	{
		if($this->db->insert('m_subcategory', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function input_unit($data)
	{
		if($this->db->insert('m_unit', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function unit_edit($data, $id)
	{
		$detail = $this->db->where('id',$id)->update('m_unit', $data);
		return $detail;
	}
	public function input_superv($data)
	{
		if($this->db->insert('m_user', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	public function m_animal_owned_details($data)
	{
		if($this->db->insert('m_animal_owned_details', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	public function m_animal_breed($data)
	{
		if($this->db->insert('m_animal_breed', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function m_farmer_location($data)
	{
		if($this->db->insert('m_farmer_location', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	public function superv_del($id)
	{
		if($this->db->where('id',$id)->delete('m_user'))
			return true;
		else
			return false;
	}
	public function superv_get_id($id)
	{
		$detail = $this->db->where('id',$id)->get('m_user')->result_array();
		return $detail;
	}
	public function update_superv($data, $id)
	{
		if($this->db->where('id', $id)->update('m_user', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function get_dept_hos_id($id)
	{
		$detail = $this->db->where('id', $id)->get('m_hospital')->result_array();
		//print_r($detail);
		if($detail)
		{
			return $detail; 
		}
		else{
			return false;
		}
	}
	public function get_dept_dept_id($dept_id)
	{
		foreach($dept_id as $key => $id){
			$data[$key] = $this->db->where('id', $id)->get('m_department')->result_array();

		}
		if(!empty($data))
		{
			return $data;
		}
		else{
			return false;
		}
	}
	public function input_request($data)
	{
		if($this->db->insert('m_request', $data))
		{
			return true;
		}else{
			return false;
		}
	}
	public function get_term()
	{
		$policy = $this->db->where('id', '1')->get('m_policy')->result_array();
		if($policy){
			return $policy;
		}else{
			return false;
		}
	}
	public function update_policy($data)
	{
		if($this->db->where('id','1')->update('m_policy',$data)){
			return true;
		}else{
			return false;
		}
	}
	
	public function getAssignedTest($uid=false){
		if($uid){$this->db->where("user_id", $uid);}
		$qry = $this->db->select("product_id")->get("m_fif_form");
		if($qry->num_rows()>0){
			$result = $qry->row_array();
			$this->db->select("test");
			$query = $this->db->where("id",$result['product_id'])->get("m_product");
			if($query->num_rows()>0){
				$rs = $query->row_array();
				return $rs;
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}
	
	public function getCompletedTest($rid=false){
		if($rid){
			$qry = $this->db->select('test_id')->where('req_id',$rid)->get("m_test_completion");
			if($qry->num_rows()>0){
				$res = $qry->result_array();
				foreach($res as $rs){
					$tsts[] = $rs['test_id'];	
				}
				return $tsts;
			}else{
				return false;
			}
		}else{
			return false;	
		}
	}
	
	public function setTestCompletion($rid=false, $tid=false){
		if($rid && $tid){
			$tsts=false;
			$qry = $this->db->select('test_id')->where('req_id',$rid)->get("m_test_completion");
			if($qry->num_rows()>0){
				$res = $qry->result_array();
				foreach($res as $rs){
					$tsts[] = $rs['test_id'];	
				}
			}
			$tests = explode(",", $tid);
			$tests = ($tsts!=false)?array_diff($tests, $tsts):$tests;
			foreach($tests as $test){
				$values[] = array("test_id"=>$test, "req_id"=>$rid, "date"=>(date('m/d/Y')));
			}
			$this->db->insert_batch("m_test_completion", $values);
			return true;
		}else{
			return false;	
		}
	}
	public function test_list()
	{
		$detail = $this->db->get('m_test')->result_array();
		if($detail){
			return $detail;
		}else{
			return false;
		}
	}

	//logic for view lock new created
	public function video_block_add($data){
		if($this->db->insert('video_block', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	public function get_lang_name($id = ''){
		if($id != ''){
			$this->db->where('id', $id);
		}
		return $this->db->get('language')->result_array();
	}
	public function get_vedio_pdf($id = ''){
		if($id != ''){
			$this->db->where('vedio_id', $id);
		}
		return $this->db->get('video_pdf')->result_array();
	}
	public function add_video_pdf($data){
		if($this->db->insert('video_pdf', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	public function get_video_block($name='', $admin_id = '')
	{
		if($name != ''){
			$this->db->where('title like "%'.$name.'%"');
		}
		if($admin_id != ''){
			$this->db->where('user_id', $admin_id);
		}
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}
	public function get_video_block_count(){
		//$detail = $this->db->get('m_product')->num_rows();
		$detail = $this->db->get('video_block')->num_rows();
		return $detail;
	}
	public function get_video_block_by_id($video_id){
		$this->db->where('video_id', $video_id);
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}

	public function edit_video_block($data, $id)
	{
		$this->db->where('video_id', $id);
		$res = $this->db->update('video_block', $data);
		return $res; 
	}

	public function video_del($id)
	{
		$detail = $this->db->where('video_id', $id)->delete('video_block');
		return True;
	}

	public function get_video_block_isactivated($admin_id = '')
	{
		if($admin_id != ''){
			$this->db->where('user_id="'.$admin_id.'" AND isactivated = "1"');
		}
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}

	public function get_video_block_by_search($title='', $category = '')
	{
		if($title != '' ||  $category!= ''){
			$this->db->where('title like "%'.$title.'%" AND category like "%'.$category.'%"');
		}
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}
	public function get_video_block_by_language_search($language='')
	{
		if($language!= ''){
			$this->db->where('language like "%'.$language.'%"');
		}
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}

	public function get_video_block_by_group_number($group_number){
		$this->db->where('users_video_group_number', $group_number);
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}

	public function edit_video_block_by_group_number($data, $id, $users_video_group_number)
	{
		$users_videos = $this->get_video_block_by_group_number($users_video_group_number);
		if(!empty($users_videos)) {
			foreach ($users_videos as $key => $value) {
				$this->db->where('video_id', $value['video_id']);
				$res = $this->db->update('video_block', $data);
			}
		}
		return $res; 
	}

	public function get_video_block_isactivated_by_users_and_group_number($users_id, $users_video_group_number)
	{
		$this->db->where('isactivated = "1" AND users_video_group_number="'.$users_video_group_number.'"');
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}

	public function get_video_block_isactivated_by_users_and_group_number_youtube($users_id, $video_id, $title='', $category = '')
	{
		$this->db->where('isactivated = "1" AND video_id="'.$video_id.'"');
		if($title != '' ||  $category!= ''){
			$this->db->where(' title like "%'.$title.'%" AND category like "%'.$category.'%"');
		}
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}

	//API For frotend user view video details.............
	public function get_user_video_block_by_id($video_id){
		$this->db->where('video_id', $video_id);
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}
	public function get_user_video_block_by_video_id($video_id, $user_id){
		$this->db->where('video_id = "'.$video_id.'" AND user_id = "'.$user_id.'"');
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}
	public function get_user_video_block($user_id){
		$this->db->where('user_id', $user_id);
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}
	public function get_last_three_video_block(){
		$this->db->order_by('video_id', 'DESC')->limit(3);
		if($detail = $this->db->get('video_block')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}
	public function get_last_five_video_block(){
		$this->db->order_by('video_id', 'DESC')->limit(5);
		if($detail = $this->db->get('video_block')->result_array()){
            foreach($detail as $key=>$video){
                $this->db->where("video_id = '". $video['video_id']."'");
                $video = $this->db->get('video_like')->num_rows();;
                $detail[$key]['video_like'] = $video;
     		}
     		foreach($detail as $key=>$video){
                $this->db->where("video_id = '". $video['video_id']."'");
                $video = $this->db->get('video_rating')->num_rows();;
                $detail[$key]['video_rating'] = $video;
     		}
            //return $full_details;
			return $detail;
		}else{
			return false;
		}
	}
	public function get_last_five_video_block_showto(){
		$this->db->order_by('video_id', 'DESC')->limit(5);
		$this->db->where("showto IN ('Farmers', 'Pet Owners')");
		if($detail = $this->db->get('video_block')->result_array()){
            foreach($detail as $key=>$video){
                $this->db->where("video_id = '". $video['video_id']."'");
                $video = $this->db->get('video_like')->num_rows();;
                $detail[$key]['video_like'] = $video;
     		}
     		foreach($detail as $key=>$video){
                $this->db->where("video_id = '". $video['video_id']."'");
                $video = $this->db->get('video_rating')->num_rows();;
                $detail[$key]['video_rating'] = $video;
     		}
     		foreach($detail as $key=>$video){
                $this->db->where("users_id = '". $video['users_id']."'");
                $video = $this->db->get('produc_interest')->num_rows();
                $detail[$key]['interest_in'] = $video;
     		}
     		foreach($detail as $key=>$video){
                $this->db->where("video_id = '". $video['video_id']."'");
                $video = $this->db->get('video_rating')->num_rows();
                $detail[$key]['comment_count'] = $video;
     		}
            //return $full_details;
			return $detail;
		}else{
			return false;
		}
	}
	//API for api response
	public function apis_del($id)
	{
		$detail = $this->db->where('api_id', $id)->delete('apis_list');
		return True;
	}
	public function get_apis_block($name='')
	{
		if($name != ''){
			$this->db->where('method like "%'.$name.'%"');
		}
		if($detail = $this->db->get('apis_list')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}
	public function get_apis_count(){
		$detail = $this->db->get('apis_list')->num_rows();
		return $detail;
	}

	public function get_apis_by_id($api_id){
		$this->db->where('api_id', $api_id);
		if($detail = $this->db->get('apis_list')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}

	public function edit_apis($data, $id)
	{
		$this->db->where('api_id', $id);
		$res = $this->db->update('apis_list', $data);
		return $res; 
	}

	//bull search  functionality 
	public function bull_table_add($data){
		if($this->db->insert('bull_table', $data))
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function select()
	{
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('bull_table');
		return $query;
	}
	public function get_category_id_by_name($id=false)
	{
		$detail = $this->db->where('category', $id)->get('category')->row_array();
		return $detail['category_id'];
	}
	public function get_bull_bullno($id)
	{
		//$query = $this->db->where('id',$id)->get('m_user')->result_array();
		$detail = $this->db->where('bull_no', $id)->get('bull_table')->result_array();
		return $detail;
	}

	//API for api response for language library...........
	public function language_library_del($id)
	{
		$detail = $this->db->where('id', $id)->delete('language_library');
		return True;
	}
	public function get_language_library($name='')
	{
		if($name != ''){
			$this->db->where('method like "%'.$name.'%"');
		}
		if($detail = $this->db->get('language_library')->result_array()){
			$full_details = [];
            foreach($detail as $user){
                $this->db->where("id = '". $user['language_id']."'");
                $language_name = $this->db->get('language')->result_array();
                $user['language_name'] = $language_name[0]['name'];
                $full_details[] = $user;
     		}
            return $full_details;
		}else{
			return false;
		}
	}
	public function get_language_library_count(){
		$detail = $this->db->get('language_library')->num_rows();
		return $detail;
	}
	public function get_language_library_by_id($api_id){
		$this->db->where('id', $api_id);
		if($detail = $this->db->get('language_library')->result_array()){
			return $detail;
		}else{
			return false;
		}
	}
	public function edit_language_library($data, $id)
	{
		$this->db->where('id', $id);
		$res = $this->db->update('language_library', $data);
		return $res; 
	}
	public function allpackages($package_id = ''){
		if ($package_id != '') {
			 $package_id = intval($package_id);
			$where =" WHERE p.package_id = '".$package_id."'";
		}
		$req = $this->db->query("Select p.*,pt.package_type from package_masters as p LEFT JOIN package_type_mst as pt ON p.package_type_id = pt.package_type_id " .$where." ORDER BY p.package_id DESC ")->result_array();
		//  while($row=$req->fetch_assoc()){
		// 	$data[] = (object) $row;
		// }
		return $req;
	}

}