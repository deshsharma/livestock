<?php
class Front_end_model extends CI_Model {
    public function get_state(){
        $data = $this->db->get('state')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_city($state_id){
        $data = $this->db->where('state_id', $state_id)->get('district')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function ins_push($data){
        $detail = $this->db->insert('push_notification', $data);
    }
    public function get_coustomer($user_id){
        $data = $this->db->where('users_id', $user_id)->get('users')->result_array();
        return $data;
    }
    public function get_benefits($id){
        $data = $this->db->where('premium_id', $id)->get('benefits')->result_array();
        return $data;
    }
    public function premium_type($id){
        $data = $this->db->get('premium_type')->result_array();
        return $data;
    }
    public function update_animal($data , $id){
        $data = $this->db->where('animal_id', $id)->update('animals', $data);
        return $data;
    }
    public function get_user_by_ref_code($ref){
        $data = $this->db->query("SELECT us.users_id, us.full_name, us.mobile, CONCAT('https://www.livestoc.com/uploads/profile/', us.image) as image, ad.address1 as address, (select count(selling_id) from selling where users_id = us.users_id) as no_count FROM users as us, address_mst as ad WHERE us.doc_referal_by = '".$ref."' AND ad.address_id = us.address_id")->result_array();
        //$data = $this->db->where('doc_referal_by', $ref)->get('users')->result_array();
        return $data;
    }
    public function check_refral_code($users_id, $refral_id = ''){
        $where = "";
        if($refral_id != ''){
            $where .= ' AND doc_referal_by = "'.$refral_id.'"';
        }
        $data = $this->db->where('users_id = '.$users_id.' '.$where.'')->get('users')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function update_referal_code($data, $users_id){
        if($this->db->where('users_id', $users_id)->update('users', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function register_data_update($data, $id){
        $detail = $this->db->where('id', $id)->update('registration_form', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
	public function get_listing_data_cat($cat_id, $type){
		$where = '';
		/*if($type == 1){
			$where .= ' AND payment_status <> "0"';
		}*/
		$detail = $this->db->where('category = "'.$cat_id.'" '.$where.'')->order_by('payment_status','ASC')->get('registration_form')->result_array();
		if($detail){
			return $detail;
		}else{
			return false;
		}
	}
    public function ins_registration($data){
        $detail = $this->db->insert('registration_form',$data);
        if($detail){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function get_product_category(){
        $data = $this->db->where('isactive = "1"')->get('product_category')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_product_section(){
        $data = $this->db->where('isactive = 1')->get('product_section')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_product_id($id = ''){   
        if($id != ''){
            $this->db->where('id', $id);
        }
        $detail = $this->db->select('id,name,images,gst,brand,shor_desc,long_desc,other_desc,sku,category,video_id')->get('product')->result_array();
        return $detail;
    }    
    public function get_produc_with_price($id = '', $cat_id= '', $type=''){
        $this->db->select('pro.id, pro.name, pro.images, pro.brand, pro.shor_desc, pro.long_desc, pro.other_desc, pro.video_id');
        if($id != ''){
            //$this->db->where(''.$id.' IN (section)');
            $this->db->where('FIND_IN_SET('.$id.', section)');
        }
        if($cat_id != '' && $cat_id != '0'){
            $this->db->where('FIND_IN_SET(category, "'.$cat_id.'")');
        }
        if($type != ''){
            $this->db->where('ispremium',$type);
        }
        $this->db->where("isactive = '1'");
        $this->db->from('product as pro');
        //$this->db->distinct();
        //$this->db->join('product_pack_rate as pr', 'pr.product_id = pro.id');
        //$this->db->get()->result_array();
        return $this->db->get()->result_array();
    }    
    public function get_produc_with_price_and_details($id = '', $type='', $cat_id= '', $sec_id = '', $users_id = '', $user_type = ''){
        //$this->db->select('*');
        /* if($id != ''){
            $this->db->where(''.$id.' IN (section)');
           // $this->db->select('FIND_IN_SET('.$id.', section)');
        } */
      
       
        $where = '';
        if($cat_id != ''){
            $where = 'FIND_IN_SET("'.$cat_id.'",pro.category)';
        }
        if($sec_id != ''){
            if($where != ''){
                $where .= ' AND FIND_IN_SET("'.$sec_id.'",pro.section)';
            }else{
                $where .= ' FIND_IN_SET("'.$sec_id.'",pro.section)';
            }
        }
        if($type != ''){
            if($where != ''){
                $where .= ' AND pro.ispremium = "'.$type.'"';
            }else{
                $where .= ' pro.ispremium = "'.$type.'"';
            }
        }
        if($type == 0){
            if($where != ''){
                $where .= ' AND pro.ispremium = "'.$type.'"';
            }else{
                $where .= ' pro.ispremium = "'.$type.'"';
            }
        }
         if($where != ''){
            $where .= ' AND pro.isactive = "1"';
        }else{
            $where .= ' pro.isactive = "1"';    
        }
        //echo 'SELECT * FROM `product` as `pro` WHERE '.$where.' ORDER BY RAND() LIMIT 5';
        $mainData = $this->db->query('SELECT * FROM `product` as `pro` WHERE '.$where.' ORDER BY RAND() LIMIT 5')->result_array();
        //$this->db->order_by('id', 'DESC')->limit(5);
        //$mainData = $this->db->get('productasd as pro')->result_array();
        foreach ($mainData as $key => $value) {
            $priceDetails = $this->db->where('product_id = "'.$value['id'].'"')->get('product_pack_rate')->result_array();
            // print_r($priceDetails);
            // exit;
            $pack_name = $this->get_data('product_package', 'id = "'.$priceDetails[0]['pack_id'].'"', 'name');
            $mainData[$key]['pack_id'] = $priceDetails[0]['pack_id'];
            $mainData[$key]['pack_name'] = $pack_name[0]['name'];
            $mainData[$key]['mrp'] = $priceDetails[0]['mrp'];
            $mainData[$key]['sale_price'] = $priceDetails[0]['sale_price'];
            $mainData[$key]['vt_sale_price'] = $priceDetails[0]['vt_sale_price'];
            $mainData[$key]['product_id'] = $priceDetails[0]['product_id'];
            $product_rating =$this->get_data('products_reviews', 'product_id = "'.$priceDetails[0]['product_id'].'"', 'avg(rating) as avg');
            $mainData[$key]['product_rating'] = $product_rating[0]['avg'];
            $product_review = $this->get_data('products_reviews', 'product_id = "'.$priceDetails[0]['product_id'].'"', 'count(id) as count');
            $mainData[$key]['product_review'] = $product_review[0]['count'];
            if($users_id != ''){
                //echo 'product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"';
                if($product_user_like = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"', 'product_like', '', 'count(id) as count')){
                    $mainData[$key]['product_user_like'] = $product_user_like[0]['count'];
                }else{
                    $mainData[$key]['product_user_like'] = 0;
                }
                if($product_user_like = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"', 'product_cart', '', 'count(id) as count, qty')){
                    $mainData[$key]['product_user_cart'] = $product_user_like[0]['count'];
                    $mainData[$key]['cart_qty'] = $product_user_like[0]['qty'];
                }else{
                    $mainData[$key]['product_user_cart'] = 0;
                    $mainData[$key]['cart_qty'] = 0;
                } 
            }else{
                $mainData[$key]['product_user_like'] = 0;
                $mainData[$key]['product_user_cart'] = 0;
                $mainData[$key]['cart_qty'] = 0;
            }
            $imagePath = explode(',', $value['images']);
            $mainData[$key]['images'] =  IMAGE_PATH.'harpahu_merge/uploads/product/'.$imagePath[0];
        }
        return $mainData;
    }
    // public function get_produc_with_price_and_details($category_id = '',  $type='', $cat_id= ''){
       
    //      $where = '';
    //     if($category_id != ''){
    //         $where = 'FIND_IN_SET("'.$category_id.'",pro.category)';
    //     }
    //     if($type != ''){
    //         if($where != ''){
    //             $where .= 'AND pro.ispremium = "'.$type.'"';
    //         }else{
    //             $where .= 'pro.ispremium = "'.$type.'"';
    //         }
    //     }
    //      if($where != ''){
    //         $where .= ' AND pro.isactive = "1"';
    //     }else{
    //         $where .= 'pro.isactive = "1"';    
    //     }
    //     $mainData = $this->db->query('SELECT * FROM `product` as `pro` WHERE '.$where.' ORDER BY RAND() LIMIT 5')->result_array();
    //     foreach ($mainData as $key => $value) {
    //         $priceDetails = $this->db->where('product_id = "'.$value['id'].'"')->get('product_pack_rate')->result_array();
    //         $mainData[$key]['pack_id'] = $priceDetails[0]['pack_id'];
    //         $mainData[$key]['mrp'] = $priceDetails[0]['mrp'];
    //         $mainData[$key]['sale_price'] = $priceDetails[0]['sale_price'];
    //         $mainData[$key]['vt_sale_price'] = $priceDetails[0]['vt_sale_price'];
    //         $mainData[$key]['product_id'] = $priceDetails[0]['product_id'];
    //         $imagePath = explode(',', $value['images']);
    //         $mainData[$key]['images'] =  IMAGE_PATH.'harpahu_merge/uploads/product/'.$imagePath[0];
    //     }
    //     return $mainData;
    // }
    public function get_data($table = '', $where = ''){
        if($where != ''){
            $this->db->where($where);
        }
       return $this->db->get($table)->result_array();
    }
    public function submit_data($table, $data){
        $data = $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function get_video_details($id = ''){   
        if($id != ''){
            $this->db->where('video_id', $id);
        }
        $detail = $this->db->select('video_id, price, isactivated, video_thumb, title, user_id')->get('video_block')->result_array();
        return $detail;
    }
    public function update_video_details_isactivated($id , $data){
        if($this->db->where('video_id = '.$id.'')->update('video_block', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_section_id($id = ''){
        if($id != ''){
            $this->db->where('id', $id);
        }
        $detail = $this->db->get('product_section')->result_array();
        return $detail;
    }
    public function get_category($data='')
    {
        $detail = $this->db->where("name LIKE '%".$data['name']."%'")->get('category')->result_array();
        return $detail;
    }
    public function get_subcategory($data ='')
    {
        $detail = $this->db->query('SELECT subcategory.id,subcategory.name,subcategory.image,subcategory.isactive, category.name as cat_name FROM `m_subcategory`, `m_category` WHERE m_subcategory.cat_id = m_category.id AND m_subcategory.name LIKE "%'.$data['name'].'%"')->result_array();
        // $this->db->select('m_subcategory.*,m_category.name as cat_name');
        // $this->db->from('m_subcategory');
        // $this->db->join('m_category', 'm_subcategory.cat_id = m_category.id'); 
        //$detail = $this->db->get();
        // return $query->result();
        // $detail = $this->db->get('m_subcategory')->result_array();
        return $detail;
    }
    public function section_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('product_section')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function section_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(id) as count from product_section'.$where.'')->result_array();
        return $data;
    }
    public function get_admin_rate($id){
        $detail = $this->db->query('SELECT AVG(rating) as rate from m_rating where product_id = '.$id.' AND rating_created = 1')->result_array();
        return $detail;
    }
    public function product_list($id){
        $detail = $this->db->get('product')->result_array();
        return $detail;
    }
    public function product_category_search($name = '', $start = '', $perpage = ''){
        if(isset($name)){
            $this->db->where('cat_name like "%'.$name.'%"');
        }
        if($start != ''){
            $this->db->limit($perpage, $start);
        }
        $detail = $this->db->get('product_category')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function product_category_status($id , $data){
        if($this->db->where('id = '.$id.'')->update('product_category', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function product_category_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(id) as count from product_category'.$where.'')->result_array();
        return $data;
    }   
    public function get_subcategory_cat_id($users_id=false){
        $detail = $this->db->where('super_cat_id',$users_id)->get('product_category')->result();
        return $detail;
    }
    public function country_name($country_id)
    {
         $country_name = $this->db->where("id='$country_id'")->get('country')->row();
         if( $country_name)
         {
             return $country_name;
             
         }
         else{
              return FALSE;
         }
         
    }
    public function state_name($state_id)
    {
         $state = $this->db->where("id='$state_id'")->get('state')->row();
         if( $state)
         {
             return $state;
             
         }
         else{
              return FALSE;
         }
         
    }
    public function city_name($city_id)
    {
         $city = $this->db->where("id='$city_id'")->get('city')->row();
         if($city)
         {
             return $city;
             
         }
         else{
              return FALSE;
         }
         
    }
    public function location_name($loaction_id)
    {
         $location = $this->db->where("id='$loaction_id'")->get('location')->row();
         if($location)
         {
             return $location;
             
         }
         else{
              return FALSE;
         }
         
    }
    public function login($mobile, $mobile_code,$passcode)
    {
         $login = $this->db->query("SELECT id,name,email,mobile_code,phone,fcm_android,fcm_ios,country_id,state_id,city_id,location_id,status,google_review,approval,reg_date FROM m_user WHERE phone='$mobile' AND mobile_code ='$mobile_code' AND password=Md5('$passcode')")->row();
        if($login){
          $country_name = $this->front_end_model->country_name($login->country_id);
            if($country_name ==''){$country_name->name = '';}
                $state_name = $this->front_end_model->state_name($login->state_id);
            if($state_name ==''){$state_name->name = '';}
                $city_name = $this->front_end_model->city_name($login->city_id);
            if($city_name ==''){$city_name->name = '';}
                $location_name = $this->front_end_model->location_name($login->location_id);
            if($location_name ==''){$location_name->name = '';}
                $login->country_name= $country_name->name;
                $login->state_name= $state_name->name;
                $login->city_name= $city_name->name;
                $login->location_name= $location_name->name;
                // for ios review popup hide
                $login->enable_ios= '0';
                return $login;
        }
        else
        {
            return false;
        }
    }
    public function custmer_details($users_id ='')
    {
    
        $detail = $this->db->where("users_id='$users_id'")->get('users')->row();
        if($detail){
            
            $country_name = $this->front_end_model->country_name($detail->country_id);
            $state_name = $this->front_end_model->state_name($detail->state_id);
            $city_name = $this->front_end_model->city_name($detail->city_id);
            $location_name = $this->front_end_model->location_name($detail->location_id);
        
            $detail->country_name= $country_name->name;
            $detail->state_name= $state_name->name;
            $detail->city_name= $city_name->name;
            $detail->location_name= $location_name->name;
            return $detail;
        }
        else
        {
            return false;
        }
    }
}