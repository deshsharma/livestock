<?php
class Api_model extends CI_Model {
	
    public function get_user($users_id){
        $detail = $this->db->select('users_id, mobile, aadhaar_no, password')->where(['users_id' => $users_id])->get('users')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_doc_address($id){
        $detail = $this->db->where('users_id', $id)->get('doc_address')->result_array();
        if($detail){
            return $detail; 
        }else{
            return False;
        }
    }
    public function get_doc_call_history($number1){
        $detail = $this->db->where('customer_number', $number1)->get('doctor_call_inisite')->result_array();
        if($detail){
            return $detail; 
        }else{
            return False;
        }
    }
    public function product_status($id, $data){

        $detail = $this->db->where('id', $id)->update('produc_interest', $data);
        if($detail){
            return $detail; 
        }else{
            return False;
        }
    }
     public function get_seman_bull_detail($bull_id){
        $data = $this->db->select('id,bull_no,bull_id,dob, bread, category,lat_yield,rating,image,price,semen_type,bull_source,ispremium,bull_source,total_milk_fat')->where('id', $bull_id)->get('bull_table')->result_array();
        return $data;
    }
    public function get_coustomer_semen_order1($users_id){
        $this->db->where('users_id', $users_id);
        return $this->db->select('id,users_id,suppliyer_id,otp,bull_id,company_id, no_strow, distributor_id,full_name,mobile_no,deliverd,date')->get('pre_order_ai_table')->result_array();
    }
    public function gett_coustomer_dist_pre_count($admin_id){
        $data =$this->db->query('SELECT sum(no_strow) as count FROM `pre_order_ai_table` WHERE FIND_IN_SET('.$admin_id.',distributor_id)')->result_array();
        // $this->db->select('sum(no_strow) as count')->where('FIND_IN_SET('.$admin_id.',company_id)')->get('pre_order_ai_table')->result_array();
        return $data;
    }
    public function get_lead_dealer_breader($users_id, $status=''){
        $where = '';
        if($status != '')
            $where = ' AND lb.status = "'.$status.'"';
        return $this->db->query('select lb.id, lb.users_id, lb.lead_user_id, lb.perposs, '.UNLOCK_PRICE.' as price, lb.status, lb.created_on,us.full_name, us.mobile, CONCAT("'.IMAGE_PATH.'uploads_new/profile/thumb/",us.image) as image, us.district, us.state,(select name from zone where zone_id = us.zone_id) as state_name, (select dist_name from district where dis_id = us.district) as district_name , us.address from lead_breader_dealer as lb left Join users as us on lb.users_id = us.users_id where lb.lead_user_id = "'.$users_id.'" '.$where.' ORDER BY id DESC')->result_array();
    }    
    public function get_lab_detail($id, $latitude, $langitude){
        $de = $this->db->query("select  users_id, name,adress, district, state, city,location, latitude,langitude, phone, email, business_name, ispaid , IFNULL(( 3959 * acos( cos( radians(".$latitude.") ) * cos( radians( latitude ) ) * cos( radians( langitude ) - radians (".$langitude.") ) + sin( radians(".$latitude.") ) * sin( radians( latitude ) ) ) ),0) AS distance from lab_reg where ispaid = '".$id."'order by distance")->result_array();
        return $de;
    }
    public function get_breed_name($name = '', $category = ''){
        if($category != ''){
            $this->db->where('br.category_id IN ('.$category.')');
        }else{
            $this->db->where('br.category_id IN (1,2,3,7,8,10,14)');
        }
        if($name != ''){
            $this->db->where('br.breed_name like "%'.$name.'%"');
        }
        $this->db->where('br.isactivated', '1');
        $this->db->select('br.breed_id, br.category_id, br.breed_name, br.breed_name_punjabi, br.breed_name_hindi, br.breed_name_urdu, br.breed_name_gujarati, br.breed_name_tamil, br.breed_name_marathi, br.breed_name_kannada, br.breed_name_bengali, br.breed_name_malayalam, br.breed_name_telugu, br.breed_name_french, br.breed_name_portuguese, br.breed_name_spanish, br.isactivated, cat.category, cat.category_punjabi,cat.category_hindi,cat.category_urdu, cat.category_gujarati,cat.category_tamil,cat.category_bengali,cat.category_marathi,cat.category_kannada,cat.category_malayalam,cat.category_telugu,cat.category_french,cat.category_portuguese,cat.category_spanish,cat.category_russian,cat.category_malay,cat.category_turkish,cat.category_arabic,cat.category_korean,cat.category_german,cat.category_italian,cat.category_dutch,cat.category_danish,cat.category_belarusian,cat.category_ukrainian,cat.category_thai');
        $this->db->from('breed as br');
        $this->db->join('category as cat', 'br.category_id = cat.category_id');
        return $this->db->get()->result_array();        
    }
    public function doctor_call_rating($doctor_id = ''){
            $detail = $this->db->query("select docr.doctor_id, docr.users_id, docr.rating, docr.feedback, us.full_name, docr.created_on from doctor_call_rating as docr left join users as us on docr.users_id = us.users_id where docr.doctor_id='".$doctor_id."'")->result_array();
        //$detail = $this->db->query("SELECT d.doctor_id,d.username,CONCAT('https://www.livestoc.com/harpahu_merge_dev/uploads/doctor/',d.image) as image,dc.users_id, dc.feedback,dc.created_on, AVG(rating) FROM doctor as d LEFT JOIN doctor_call_rating as dc ON d.doctor_id=dc.doctor_id where d.doctor_id= '".$doctor_id."'")->result_array();
       //$detail = $this->db->query("SELECT (select CONCAT('https://www.livestoc.com/harpahu_merge_dev/uploads/doctor/',image) as image from doctor where doctor.doctor_id = doctor_call_rating.doctor_id) image,feedback, AVG(rating) as rate from doctor_call_rating where doctor_id = '".$doctor_id."'")->result_array();
        if($detail){
            return $detail; 
        }else{
            return False;
        }
    }
    public function wallets_transaction($users_id){
        $detail = $this->db->query("select lw.id, lw.log_id, lw.users_id, lf.type, lw.animal_id, lw.amount, lw.status, if(lf.type = '21',if(lw.animal_id IS NOT NULL, (select ani.fullname as animal_name from animals as ani, users as us where animal_id = lw.animal_id and ani.users_id = us.users_id ),''),'') as animal_name, if(lf.type = '26', 'Doctor home visit Request', if(lw.type = '25','Contacted to Buyer',if(lw.type = '24','Pregnancy Detection Sample',if(lw.type = '23','Money used for LivestocLab + Cattle Pregnancy Test',if(lw.wallet_type = '1', if(lw.status = 'Cr','Added Money to Wallet',CONCAT('Contacted with Seller ', (select us.full_name as username from animals as ani, users as us where animal_id = lw.animal_id and ani.users_id = us.users_id))), if(lw.status = 'Cr','dsfdsfds',CONCAT('Contacted with Seller ', (select us.full_name as username from animals as ani, users as us where animal_id = lw.animal_id and ani.users_id = us.users_id)))))))) as type, lw.date, if(lf.method IS NOT NULL, lf.method, 'Wallet') as method from livestoc_wallets as lw left Join log_file as lf on lw.log_id = lf.id where lw.users_id = '".$users_id."' ORDER BY lw.id DESC")->result_array();
        //$detail = $this->db->query("select lw.id, lw.log_id, lw.users_id, lf.type, lw.animal_id, lw.amount, lw.status, if(lw.wallet_type = '1', if(lw.status = 'Cr','Added Money to Wallet','Real money used for Purchase'),if(lw.status = 'Cr','Added Money to Wallet by Livestoc','Livestoc wallet used for Purchase')) as type, lw.date, if(lf.method IS NOT NULL, lf.method, 'Wallet') as method from livestoc_wallets as lw left Join log_file as lf on lw.log_id = lf.id where lw.users_id = '".$users_id."'")->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
   public function get_user_wallets($users_id,$type,$payment_type){
        $this->db->where('users_id = "'.$users_id.'" AND  payment_type = "Cr" AND user_type = "1"');
        $detail =$this->db->select('SUM(amount) as real_balance')->get('log_file')->result_array();

        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_doctor_list_count($languages = '',$expertise_list = '',$specialisation_list = '', $qualification = '',$start = '', $expertise_list_num='' ,$name='', $price=''){
         $where = '';
          if($languages != ''){
            $where .= " AND CONCAT(',', `languages`, ',') REGEXP ',(".$languages."),'";
          }
           if($expertise_list != ''){
            $where .= " AND expertise_list REGEXP '(^|,)(".$expertise_list.")(,|$)'";
          }
          if($expertise_list_num != ''){
            $where .= " AND specialisation_list REGEXP '(^|,)(".$expertise_list_num.")(,|$)'";
          }
          if($name != ''){
            $where .= " AND username like '%".$name."%'";
          }
          if($specialisation_list != ''){
            $where .= "  AND (select group_concat(REPLACE(REPLACE(REPLACE(speci_id,'[',''),']',''),'\"','')) from doc_qualification where doc_id = doc.doctor_id) REGEXP '(^|,)(".$specialisation_list.")(,|$)'";
          }
           if($qualification != ''){
            $where .= " AND (select group_concat(qualifi_id) from doc_qualification where doc_id = doc.doctor_id) REGEXP '(^|,)(".$qualification.")(,|$)'";
          }

        $detail = $this->db->query("select count(doctor_id) as count from doctor as doc where users_type = 'pvt_doc' AND consul_fee <> '0' AND is_available_consultation <> '0' ".$where."")->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_doctor_list($languages = '',$expertise_list = '',$specialisation_list = '', $qualification = '',$start = '', $expertise_list_num='', $name='', $price=''){       
          $where = '';
          $order = '';
          if($languages != ''){
            $where .= " AND languages REGEXP '(^|,)(".$languages.")(,|$)'";
          }
           if($expertise_list != ''){
            $where .= " AND expertise_list REGEXP '(^|,)(".$expertise_list.")(,|$)'";
          }
          if($name != ''){
            $where .= " AND username like '%".$name."%'";
          }
          if($price != ''){
            if($price == '0'){
                $order = ' Order by consul_fee ASC';
            }else{
                $order = ' Order by consul_fee DESC';
            }
          }
          else{
            if($order != ''){
                $order .= ' , is_consultation_on DESC';
            }else{
                $order = ' Order by is_consultation_on DESC';
            }
          }
          if($expertise_list_num != ''){
            $where .= " AND specialisation_list REGEXP '(^|,)(".$expertise_list_num.")(,|$)'";
          }
          if($specialisation_list != ''){
            $where .= "  AND (select group_concat(REPLACE(REPLACE(REPLACE(speci_id,'[',''),']',''),'\"','')) from doc_qualification where doc_id = doc.doctor_id) REGEXP '(^|,)(".$specialisation_list.")(,|$)'";
          }
           if($qualification != ''){
            $where .= " AND (select group_concat(qualifi_id) from doc_qualification where doc_id = doc.doctor_id) REGEXP '(^|,)(".$qualification.")(,|$)'";
          }
         $detail = $this->db->query("select username, doctor_id,is_consultation_on, consul_fee, is_available_consultation, mobile_code, mobile, if((select ROUND( avg(rating),1) as rating from doctor_call_rating where doctor_id = doc.doctor_id) IS NULL, '0', (select ROUND(avg(rating),1) as rating from doctor_call_rating where doctor_id = doc.doctor_id)) as rating, (Select group_concat(qualifi_name) FROM qualification where FIND_IN_SET(qualifi_id, (select group_concat(qualifi_id) from doc_qualification where doc_id = doc.doctor_id))) as qualifi_name,total_experience,(select group_concat(lang_name) from prefered_lang where FIND_IN_SET(lang_id,languages)) as languages,expertise_list, CONCAT('https://www.livestoc.com/harpahu_merge_dev/uploads/doctor/',image) as image,(select group_concat(speci_name) as speci_name from specialisation where FIND_IN_SET(speci_id ,(select group_concat(REPLACE(REPLACE(REPLACE(speci_id,'[',''),']',''),'\"','')) from doc_qualification where doc_id = doc.doctor_id))) as qulifi_name from doctor as doc where users_type = 'pvt_doc' AND consul_fee <> '0' AND is_available_consultation <> '0' ".$where." ".$order." LIMIT ".$start.",".NUM_DISPLAY_ENTRIES." ")->result_array();
        //$detail = $this->db->query("select username, doctor_id, consul_fee, mobile, (Select group_concat(qualifi_name) FROM qualification where FIND_IN_SET(qualifi_id, (select group_concat(qualifi_id) from doc_qualification where doc_id = doc.doctor_id))) as qualifi_name,total_experience,languages,expertise_list, CONCAT('https://www.livestoc.com/harpahu_merge_dev/uploads/doctor/',image) as image,(select group_concat(speci_name) as speci_name from specialisation where FIND_IN_SET(speci_id ,(select group_concat(REPLACE(REPLACE(REPLACE(speci_id,'[',''),']',''),'\"','')) from doc_qualification where doc_id = doc.doctor_id))) as qulifi_name from doctor as doc where users_type = 'pvt_doc' AND is_available_consultation = '1' ".$where." LIMIT ".$start.",".NUM_DISPLAY_ENTRIES." ")->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }

    }
    public function get_doc_premium_plans($id){
        $detail = $this->db->select('id,name,price,link')->where('id', $id)->get('pricing')->result_array();
        if($detail){
            return $detail; 
        }else{
            return False;
        }
    }
    public function get_doc_premium_status($doctor_id){
        return $this->db->select('doctor_id,is_premium')->where('doctor_id',$doctor_id)->get('doctor')->result_array();

    }
    public function submit($table, $data){
        if($this->db->insert($table, $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function get_doc_quif_speci($speci_id){
        return $this->db->query('select * from doctor as doc, doc_qualification as docq where doc.doctor_id = docq.doc_id AND docq.speci_id like "%'.$speci_id.'%"')->result_array();
    }
    public function get_doc_quif_speci_list($speci_id ='', $premium_type = '',$latitu ='', $langitude = '', $languages='', $name='', $expertise='', $visiting_set='', $start ='', $visit = ''){
        $where = '';
        $join = '';
        if($speci_id != ''){
            $where .=" AND dq.speci_id LIKE '%".$speci_id."%'";
        }
        if($visit != ''){
            $where .=" AND doc.avaialable_for_visit = '1'";
        }
        if($premium_type == '1'){
            $where .= ' AND is_premium = "1"';
        }
        if($premium_type == '0'){
            $where .= ' AND is_premium = "0"';
        }
        $where .= ' AND doc.doctor_id IS NOT NULL';
        if($languages != ''){
            $where .= " AND CONCAT(',', doc.languages, ',') REGEXP ',(".$languages."),'";
        }
        if($name !=''){
            $where .=' AND doc.username LIKE "%'.$name.'%"';
        }
        if($expertise !=''){
            $where .=' AND FIND_IN_SET("'.$expertise.'",doc.specialisation_list)';
        }
        $order_by ='';
        $select = '';
        if($latitu != ''){
            $select = ', if((SELECT langitute from doc_service_loc where doctor_id = doc.doctor_id),IFNULL(( 3959 * acos( cos( radians('.$latitu.') ) * cos( radians( (SELECT latitute from doc_service_loc where doctor_id = doc.doctor_id) ) ) * cos( radians( (SELECT langitute from doc_service_loc where doctor_id = doc.doctor_id) ) - radians ('.$langitude.') ) + sin( radians('.$latitu.') ) * sin( radians( (SELECT latitute from doc_service_loc where doctor_id = doc.doctor_id) ) ) ) ),0),IFNULL(( 3959 * acos( cos( radians('.$latitu.') ) * cos( radians( doc.latitude ) ) * cos( radians( doc.longitude ) - radians ('.$langitude.') ) + sin( radians('.$latitu.') ) * sin( radians( doc.latitude ) ) ) ),0)) AS distance';
            if($visiting_set == '')
            $order_by .= " order by distance";
        }
        if($visiting_set == '0'){
            if($order_by != ''){
                $order_by .= " ,visiting_fee ASC";
            }else{
                $order_by .= " order by visiting_fee ASC";
            }
            //$where .= " order by visiting_fee ASC";
        }else if($visiting_set == '1'){
             if($order_by != ''){
                $order_by .= " ,visiting_fee DESC";
            }else{
                $order_by .= " order by visiting_fee DESC";
            }
            //$where .= " order by visiting_fee DESC";
        }
        $limit = '';
        if($start !=''){
            $limit .=' LIMIT '.$start.','.NUM_DISPLAY_ENTRIES.'';
        }
        //$join = 'left join doc_pack_listing as dpl ON dpl.doc_id = doc.doctor_id';
        //echo $query = "select DISTINCT dpl.doc_id, refral_by_code, refral_code, doc.username,doc.email,doc.specialisation_list,doc.visiting_fee, doc.qualification, (select max(latitude) from doc_pack_listing where doc_id = doc.doctor_id limit 1)as doc_lat, (select max(longitude) from doc_pack_listing where doc_id = doc.doctor_id limit 1) as doc_lang,dpl.address, doc.mobile, (select group_concat(name) from language where id IN (doc.languages)) as languages, doc.expertise_list, doc.total_experience, doc.city,doc.state, doc.is_premium,dq.doc_qu_id ".$select." from doctor as doc left Join doc_qualification as dq ON doc.doctor_id = dq.doc_id left join doc_pack_listing as dpl ON dpl.doc_id = doc.doctor_id ".$where."";
        $query = "select DISTINCT doc.doctor_id as doc_id, doc.online_for_visit, doc.avaialable_for_visit, refral_by_code, refral_code, doc.username,doc.email,doc.specialisation_list,doc.visiting_fee, doc.qualification, (SELECT address from doc_service_loc where doctor_id = doc.doctor_id) as address, doc.mobile, CONCAT('".base_url()."uploads/doctor/',doc.image) as image, doc.languages, doc.expertise_list, doc.total_experience, doc.city,doc.state, doc.is_premium ".$select." from doctor as doc, doc_qualification as dq where doc.doctor_id = dq.doc_id  AND doc.doctor_id IS NOT NULL ".$where.$order_by.$limit."";
        
        return $this->db->query($query)->result_array();
        //return $this->db->query('select username,email,specialisation_list,qualification,mobile,expertise_list,total_experience,city,state,doc_id,doc_qu_id from doctor as doc, doc_qualification as docq where doc.doctor_id = docq.doc_id AND docq.speci_id like "%'.$speci_id.'%"')->result_array();
    }
    public function get_all_lang($doc_lang){
        return $this->db->query('select group_concat(lang_name) as name from prefered_lang where lang_id IN ('.$doc_lang.')')->result_array();

    }
    public function get_doc_quif_speci_count($speci_id='', $premium_type = '',$latitu ='', $langitude = '', $languages='', $name='', $expertise=''){
        $where = '';
        $join = '';
        if($premium_type != ''){
            $where = ' AND doc.doctor_id IN (Select group_concat(doc_id) from doc_pack_listing where is_paid = "1")';
        }else{
            $where = ' AND doc.doctor_id NOT IN (Select group_concat(doc_id) from doc_pack_listing where is_paid = "1")';
        }
        $where .= ' AND dpl.doc_id IS NOT NULL';
        if($languages != ''){
            $where .= ' AND FIND_IN_SET("'.$languages.'",doc.languages)';
        }
        if($name !=''){
            $where .=' AND username LIKE "%'.$name.'%"';
        }
        if($expertise !=''){
            $where .=' AND FIND_IN_SET("'.$expertise.'",doc.specialisation_list)';
        }
        return $this->db->query("select count(DISTINCT dpl.doc_id) as count from doctor as doc left Join doc_qualification as dq ON doc.doctor_id = dq.doc_id left join doc_pack_listing as dpl ON dpl.doc_id = doc.doctor_id where dq.speci_id LIKE '%".$speci_id."%' ".$where."")->result_array();
    }
    public function update_quilfi($doc_id, $qualifi_id, $data){
        $this->db->where('doc_id ="'.$doc_id.'" AND qualifi_id="'.$qualifi_id.'"');
        return $this->db->update('doc_qualification', $data);
    }
    public function get_job_list($cat_id = '', $sub_cat = '', $prefered_location = ''){
        if($cat_id != ''){
            $this->db->where(''.$cat_id.' IN (pro.category)');
        }if($sub_cat != ''){
            $this->db->where("pro.sub_category REGEXP REPLACE('".$sub_cat."',',','|')");
        }if($prefered_location != ''){
            $this->db->where("pro.prefered_location REGEXP REPLACE('".$prefered_location."',',','|')");
        }
        //$job = $this->db->get('naukari_profile')->result_array();
        $this->db->where('show_in_job  = "1"');
        $this->db->select('pro.users_id, pro.category, pro.salary, pro.salary_thousand, pro.expected_salary_thousand, pro.expected_salary, pro.notice, pro.sub_category, pro.sub_subcategory, pro.prefered_location, doc.username, doc.mobile, doc.fullname, CONCAT("https://www.livestoc.com/harpahu_merge_dev/uploads/doctor/",doc.image) as image, CONCAT("https://www.livestoc.com/harpahu_merge_dev/uploads/job/",re.resume) as resume');
        $this->db->from('naukari_profile as pro');
        $this->db->join('doctor as doc', 'doc.doctor_id = pro.users_id');
        $this->db->join('job_resume as re', 're.users_id = pro.users_id');
        $result = $this->db->get()->result_array();
        $jd = [];
        foreach($result as $j){
            $category = $this->get_data('id IN ('.$j['category'].')', 'job_category');
            $ca = '';
            $i = 0;
            foreach($category as $cat){
                $subcategory = $this->get_data('id IN ('.$j['sub_category'].') and job_category_id = "'.$cat['id'].'"', 'job_sub_category');
                $su = '';
                $k = 0;
                $sub_s='';
                if(!is_null($j['sub_category'])){
                foreach($subcategory as $sub){
                        $sub_s = '';
                        if(!is_null($j['sub_subcategory'])){
                            $sub_subcategory = $this->get_data('id IN ('.$j['sub_subcategory'].') and sub_cat_id = "'.$sub['id'].'"', 'job_sub_subcategory');
                            $l = 0;
                            foreach($sub_subcategory as $s_sub){
                                if($l == 0){
                                    if($sub_s != '0'){
                                        $sub_s .= ','.$s_sub['sub_cat_name'];
                                    }else{
                                        $sub_s = $s_sub['sub_cat_name'];
                                    }
                                }
                                else{
                                    $sub_s .= ','.$s_sub['sub_cat_name'];
                                }
                                $l++;
                            }
                        }
                        if($k == 0)
                        $su = $sub['sub_cat_name'];
                        else
                        $su .= ','.$sub['sub_cat_name'];
                        $k++;
                    }
                }
                if($i == 0)
                $ca = $cat['category_name'];
                else
                $ca .= ','.$cat['category_name'];
                 //$ca[] = $cat['category_name'];
                 $i++;
            }
            $j['category'] = $ca;
            $j['sub_category'] = $su;
            $j['sub_subcategory'] = $sub_s;
            $pre = 0;
            foreach($this->get_district($j['prefered_location']) as $pre){
                if($pre == 0)
                $pref = $pre['dist_name'];
                else
                $pref .= ','.$pre['dist_name'];
                $pre++;
            }
            $j['prefered_location'] = $pref;
            // $j['subcategory'] = $this->get_data('FIND_IN_SET(id, "'.$j['sub_category'].'")', 'job_sub_category');
            // $j['sub_subcategory'] = $this->get_data('FIND_IN_SET(id, "'.$j['sub_subcategory'].'")', 'job_sub_subcategory');
            $jd[] = $j;
        }
        return $jd;
    }
    public function get_doc_profile($doc_id){
        $this->db->where('doctor_id', $doc_id);
        $doc_data = $this->db->select('doctor_id, users_type, username, email, mobile, address_full, specialisation_list, expertise_list')->get('doctor')->result_array();
        $do = [];
        foreach($doc_data as $doc){
            $doc['specialisation_list'] = $this->db->where('FIND_IN_SET(speci_id , "'.$doc['specialisation_list'].'")')->get('specialisation')->result_array();
            $doc_doc = $this->db->where('doc_id= "'.$doc['doctor_id'].'"')->get('doc_qualification')->result_array();
            $sp = [];    
            foreach($doc_doc as $d){
                $speci_id = $d['speci_id'];
                $spe = implode(',', json_decode($speci_id));
                $d['speci_id'] = $this->db->where('FIND_IN_SET(speci_id , "'.$spe.'")')->get('specialisation')->result_array();
                $sp[] = $d;
            }
            $doc['doc_qualification'] =  $sp;
            $job = $this->db->where('users_id', $doc_id)->get('naukari_profile')->result_array();
            $jd = [];
            foreach($job as $j){
                $category = $this->get_data('FIND_IN_SET(id, "'.$j['category'].'")', 'job_category');
                $ca = [];
                foreach($category as $cat){
                    $subcategory = $this->get_data('FIND_IN_SET(id, "'.$j['sub_category'].'") and job_category_id = "'.$cat['id'].'"', 'job_sub_category');
                    $su = [];
                    foreach($subcategory as $sub){
                        $sub['sub_subcategory'] = $this->get_data('FIND_IN_SET(id, "'.$j['sub_subcategory'].'") and sub_cat_id = "'.$sub['id'].'"', 'job_sub_subcategory');
                        $su[] = $sub;
                    }
                    $cat['subcategory'] = $su;
                    $ca[] = $cat;
                }
                $j['category'] = $ca;
                $j['prefered_location'] = $this->get_district($j['prefered_location']);
                // $j['subcategory'] = $this->get_data('FIND_IN_SET(id, "'.$j['sub_category'].'")', 'job_sub_category');
                // $j['sub_subcategory'] = $this->get_data('FIND_IN_SET(id, "'.$j['sub_subcategory'].'")', 'job_sub_subcategory');
                $jd[] = $j;
            }
            $doc['job_profile'] =  $jd;
            $doc['resume'] = $this->db->select('CONCAT("'.base_url('uploads/job/').'", resume) as resume')->where('users_id', $doc_id)->get('job_resume')->result_array();
            $do = $doc;
        }
        return $doc;
    }
    public function get_wishlist_count($users_id){
        return $this->db->select('count(id) as count')->where('users_id', $users_id)->get('product_like')->result_array();
    }
    public function get_whishlist($users_id){
        return $this->db->where('users_id', $users_id)->get('product_like')->result_array();
    }
    public function get_data($where = '' , $table = '', $order_by = '', $select = ''){
       if($where != ''){
           $this->db->where($where);
       } 
       if($select != ''){
           $this->db->select($select);
       }
       if($order_by != ''){
        $this->db->order_by($order_by);
       }
      return $this->db->get($table)->result_array();
    }
    public function animal_listing($latitude = '', $longitude = '', $seman_price_to ='', $seman_price_from ='', $breed = '', $category ='', $ordery_by = ''){
        $select = '';
        $order = '';
        $where = '';
        if($latitude != ''){
            $select .=', IFNULL(( 3959 * acos( cos( radians('.$_REQUEST['latitude'].') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians ('.$_REQUEST['longitude'].') ) + sin( radians('.$_REQUEST['latitude'].') ) * sin( radians( a.latitude ) ) ) ),0) AS distance';
            $order .= ' ORDER BY distance '.$ordery_by;
        }
        if($seman_price != ''){
            $where .= ' AND semen_price BETWEEN '.$seman_price_to.' AND '.$seman_price_from;
                    if($order != '')
                        $order .= ',semen_price '.$ordery_by;
                    else
                        $order .= ' ORDER BY semen_price '.$ordery_by;
        }
        if($breed != ''){
            $where .= ' AND breed_id IN ('.$breed.')';
        }
        if($breed != ''){
            $where .= ' AND category_id IN ('.$category.')';
        }
        $query = "select * ".$select." from package_users_dog as pd, animals as ani where pd.flag_type = '1' AND ani.animal_id = pd.animal_id ".$where." ".$order."";
    }
    public function check_invoice_otp($id, $otp){
        $data = $this->db->where('id = '.$id.' AND otp = "'.$otp.'"')->get('semen_invoice_performa')->result_array();
        return $data;
    }
    public function update($where = '', $id = '', $table, $data){
        if($where != ''){
            $this->db->where($where, $id);
        }
        return $this->db->update($table, $data);
    }
    public function get_proforma_invoice($doc_id = '', $invoice_id = '', $admin_id){
        if($doc_id != '')
        $this->db->where('users_id', $doc_id);
        if($invoice_id != '')
        $this->db->where('id', $invoice_id);
        if($admin_id != '')
        $this->db->where('admin_id',$admin_id);
        $this->db->select('*, CONCAT("'.base_url().'api/invoice/", id) as link');
        return $this->db->get('semen_invoice_performa')->result_array();
    }
    public function get_count($table, $field, $user_id, $table_field, $condition){
        $this->db->where($table_field, $user_id);
        return $this->db->select(''.$condition.'('.$field.') as count')->get($table)->result_array();
    }
    public function get_pro_dashboard($doc_type=''){
        if($doc_type != '')
        $this->db->where('FIND_IN_SET("'.$doc_type.'" , type)');
        $data = $this->db->select('id, name, table, field, type, field_web, where_field, field_count, isactivated')->order_by('isactivated', 'DESC')->get('pro_dashboard_menu')->result_array();
        return $data;
    }    
    public function get_banners($banners_type = ''){
        if($banners_type != ''){
            $this->db->where('banners_type=', $banners_type);
        }
        $this->db->where(' isactivated = "1"');
        $detail = $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/banners/", image) as image, banners_id, banners_type, category_id, title, link')->get('banners')->result_array();
        if($detail){
            return $detail; 
        }else{
            return False;
        }
    }
    public function get_banner_description($banners_id = ''){
        $this->db->where('banners_id', $banners_id);
        $detail = $this->db->select('description')->get('banners_desciption')->result_array();
         if($detail){
            return $detail; 
        }else{
            return False;
        }
    }
    public function removeproductlike($id){
        return $this->db->where('id',$id)->delete('product_like');
    }
    public function del_doc_address($id){
        if($this->db->where('id', $id)->delete('doc_address')){
            return True;
        }else{
            return False;
        }
    }
    public function get_admin_sub_user($id){
        if($data = $this->db->query('SELECT count(admin_id) as count FROM `admin` WHERE `super_admin_id` = "'.$id.'" AND (user_type = "11" or user_type = "10")')->result_array()){
            return $data;
        }else{
            return false;
        }
    }
    public function check_mobile($mobile){
        $detail = $this->db->where('mobile', $mobile)->get('doctor')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function passcode_update_doc($doctor_id, $data){
        $detail = $this->db->where('doctor_id', $doctor_id)->update('doctor',$data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function like($data){
        $data = $this->db->insert('like', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    public function get_like_count($product_id, $product_type){
        $data = $this->db->select('count(id) as count')->where('product_id = '.$product_id.' AND product_type = "'.$product_type.'" AND like ="1"')->get('like')->result_array();
        return $data;
    }
    public function check_like($users_id,  $product_id, $user_type, $product_type){
        $data = $this->db->where('users_id = '.$users_id.' AND product_id = '.$product_id.' AND user_type = "'.$user_type.'" AND product_type = "'.$product_type.'"')->get('like')->result_array();
        return $data;
    }
    public function update_like($id, $data){
        $data = $this->db->where('id', $id)->update('like', $data);
        return $data;
    }
    public function get_like_status($users_id, $product_id ,$product_type){
        $data = $this->db->where('users_id = '.$users_id.' AND product_id = '.$product_id.' AND product_type = "'.$product_type.'" AND like ="1"')->get('like')->result_array();
        return $data;
    }
    public function product_section(){
        $data = $this->db->select('id, name, name_hindi, name_punjabi, category, CONCAT("'.base_url('uploads/section/').'", image) as image, isactive')->get('product_section')->result_array();
        return $data;
    }
    public function get_doc_specialisation_name_latlong($latituit, $langituit, $specialization){
        $data = $this->db->query("SELECT cl.doctor_id, do.username, do.total_experience, do.city, do.ai_visiting_fee, do.expertise_list, do.address_full, do.mobile, CONCAT('https://www.livestoc.com/harpahu_dhyan/uploads/doctor/',do.image) as image, IFNULL(( 3959 * acos( cos( radians('$latituit') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('$langituit') ) + sin( radians('$latituit') ) * sin( radians( cl.lantitute ) ) ) ),0) AS distance FROM current_loc as cl, doctor as do where do.doctor_id = cl.doctor_id and FIND_IN_SET('".$specialization."',expertise_list) AND do.users_type='pvt_doc' having distance <= '".RADIOUS_DIST."' order by distance")->result_array();
        return $data;
    }
    public function get_specialisation_for_doc($quali_id){
        $data = $this->db->select('speci_name')->where('FIND_IN_SET(speci_id, "'.$quali_id.'")')->get('specialisation')->result_array();
        return $data;
    }
    public function get_specialisation_id($speci_id){
        $data = $this->db->select('speci_name')->where('speci_id',$speci_id)->get('specialisation')->result_array();
        return $data;
    }
    public function pre_order_ai_table($user_id, $type=''){
        if($type != ''){
            $this->db->where('requested_app', $type);
        }
        $data = $this->db->where('users_id',$user_id)->order_by('id','DESC')->get('pre_order_ai_table')->result_array();
        return $data;
    }
    // public function get_coustomer_pre_comp_count($admin_id){
    //     $bank = $this->db->query('select admin_id from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
    //     foreach($bank as $ba){
    //         $su = $this->db->query('SELECT sum(no_strow) as count FROM `pre_order_ai_table` WHERE FIND_IN_SET('.$ba['admin_id'].',company_id)')->result_array();
    //         $sum +=$su[0]['count'];
    //     }
    //     return $sum;

    //     //$data['bank_count'] = $bank[0]['count'];
    //     // $data =$this->db->query('SELECT sum(no_strow) as count FROM `pre_order_ai_table` WHERE FIND_IN_SET('.$admin_id.',company_id)')->result_array();
    //     // return $data;
    // }
     public function get_coustomer_pre_comp_count($admin_id){
        $bank = $this->db->query('select admin_id from admin where user_type = "'.$type.'" AND super_admin_id ='.$admin_id.'')->result_array();
        foreach($bank as $ba){
            $su = $this->db->query('SELECT sum(no_strow) as count FROM `pre_order_ai_table` WHERE FIND_IN_SET('.$ba['admin_id'].',company_id)')->result_array();
            $sum +=$su[0]['count'];
        }
        return $sum;

        //$data['bank_count'] = $bank[0]['count'];
        // $data =$this->db->query('SELECT sum(no_strow) as count FROM `pre_order_ai_table` WHERE FIND_IN_SET('.$admin_id.',company_id)')->result_array();
    }
    public function get_coustomer_pre_count($admin_id){
        $data =$this->db->query('SELECT sum(no_strow) as count FROM `pre_order_ai_table` WHERE FIND_IN_SET('.$admin_id.',company_id)')->result_array();
        // $this->db->select('sum(no_strow) as count')->where('FIND_IN_SET('.$admin_id.',company_id)')->get('pre_order_ai_table')->result_array();
        return $data;
    }
    public function get_distributor_by_latlong($lati, $long, $admin_id, $radious){
        $de = $this->db->query("select admin_id, fname, mobile, IFNULL(( 3959 * acos( cos( radians('$lati') ) * cos( radians( longitude ) ) * cos( radians( latitude ) - radians ('$long') ) + sin( radians('$lati') ) * sin( radians( longitude ) ) ) ),0) AS distance from admin where super_admin_id = '".$admin_id."' AND user_type = '6' having distance <= '".$radious."' order by distance")->result_array();
        return $de;
    }
    public function pre_order_ai_table_vt($user_id, $type=''){
        $data = $this->db->where('FIND_IN_SET('.$user_id.', vt_id)')->order_by('id','DESC')->get('pre_order_ai_table')->result_array();
        return $data;
    }
    public function pre_order_ai_table_comp($user_id, $type=''){
        if($type == '1'){
            $this->db->where(''.$user_id.' = company_id');
        }else{
            $this->db->where('"'.$user_id.'" = distributor_id');
        }
        $data = $this->db->where('requested_app = "LVET"')->order_by('id','DESC')->get('pre_order_ai_table')->result_array();
        return $data;
    }
    public function pre_order_ai_table_ai($user_id, $type=''){
        if($type == '1'){
            $this->db->where(''.$user_id.' = company_id');
        }else{
            $this->db->where('"'.$user_id.'" = distributor_id');
        }
        $data = $this->db->where('requested_app = "LPRO"')->order_by('id','DESC')->get('pre_order_ai_table')->result_array();
        return $data;
    }
    public function user_notification($data){
        $data = $this->db->insert('user_notification', $data);
        return $data;
    }
    public function old_notification($data){
        $data = $this->db->insert('push_notification', $data);
        return $data;
    }
    public function business_ai_request($data){
        $data = $this->db->insert('pre_order_ai_table',$data);
        return $data;
    }
    public function update_company_data($id, $data){
        $detail = $this->db->where('admin_id', $id)->update('admin', $data);
        return $detail;
    }
    public function get_address_lat_data($id){
        $detail = $this->db->select('latitude, longitude, complete_addr')->where('admin_id', $id)->get('admin')->result_array();
        return $detail;
    }
    public function get_log_file_id($id){
        $data = $this->db->where('id', $id)->get('log_file')->result_array();
        return $data;
    }
    public function get_facility(){
        $data = $this->db->where('isactive = "1"')->get('facility_premium')->result_array();
        return $data;
    }
    public function get_breed_dealer($type=''){
        if($type != '')  
        $this->db->where('type',$type);      
        $data = $this->db->where('isactive = "1"')->get('breed_dealer')->result_array();
        return $data;
    }
    public function get_facility_prem_id($id){
        $data = $this->db->where('premium_type_id = "'.$id.'" AND isactive = "1"')->get('facility_premium')->result_array();
        return $data;
    }
    public function get_premium_bull_rate($type){
        $data = $this->db->where('type = "'.$type.'" AND isactive = "1"')->get('rate_bull_premium')->result_array();
        return $data;
    }
    public function get_premium_bull_price(){
        //$data = $this->db->query('select *, data(select * from rate_bull_premium where type = sb.id) from semen_bull_type as sb where isactivated = "1"')->result_array();
        $data = $this->db->where('isactivated = "1"')->get('semen_bull_type')->result_array();
        return $data;
    }
    public function get_get_user_type($name = '',$type = '',$district = '',$state = ''){
        if($name != ""){
         $this->db->where('full_name like "%'.$name.'%"');
        }
        // if($premium != ''){
        //     $this->db->where('is_premium = "'.$premium.'"');
        // }
        if($type != ''){
            $this->db->where('users_type_id = "'.$type.'"');
        }
        if($district != ''){
            $this->db->where('dealer_city_id = '.$district.'');
        }if($state != ''){
            $this->db->where('dealer_state_id = '.$state.'');
        }
        $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/profile/", image) as image');   
        $data = $this->db->select('full_name, users_type_id, email, mobile,is_premium, city,dealer_city_id,dealer_state_id, dealer_cat_id, dealer_bread_id,language')->get('users')->result_array();     
        // $data = $this->db->query('select full_name, users_type_id, email, image, mobile,is_premium, city from users where users_type_id like "%'.$type.'" AND full_name like "%'.$name.'" AND is_premium like "%'.$premium.'%" AND dealer_city_id like "%'.$district.'%" AND dealer_state_id like "%'.$state.'%"')->result_array();
        return $data;
    }
    public function get_latlong_distance($latitude = '',$longitude ='',$type = '', $start = '', $name = '', $dealer_cat_id = ''){
        $where = '';
        if($type != ''){
            $where .= ' where users_type_id = "'.$type.'"';
        }
        if($dealer_cat_id != ''){
            if($where != ''){
                $where .= " AND dealer_cat_id REGEXP '(^|,)(".$dealer_cat_id.")(,|$)'";
            }else{
                $where .= " where dealer_cat_id REGEXP '(^|,)(".$dealer_cat_id.")(,|$)'";    
            }            
        }
        $data = $this->db->query('SELECT ( 3959 * acos( cos( radians( '.$latitude.' ) ) * cos( radians( latitude ) ) * 
        cos( radians( longitude ) - radians( '.$longitude.' ) ) + sin( radians( '.$latitude.' )
        ) * sin( radians( latitude ) ) ) ) AS distance,users_id,breader_type,users_type_id,dealer_bread_id,dealer_cat_id,full_name,CONCAT("'.IMAGE_PATH.'uploads_new/profile/", image) as image,address,mobile,users_type_id,latitude,longitude,breeder_city,state,district,farm_name,contact_person,contact_phone, is_premium from users '.$where.' ORDER BY distance ASC LIMIT '.$start.','.NUM_DISPLAY_ENTRIES.'')->result_array();
        return $data;
    }
    public function get_dog_listing($latitude = '',$longitude ='',$mating_charge = '',$start = ''){
        $where = '';
        if($type != ''){
            $where = ' where mating_charge = "'.$mating_charge.'"';
        }
        if($dealer_cat_id != ''){
            $where = ' where dealer_cat_id = "'.$dealer_cat_id.'"';
        }
       // $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/profile/", awb_certificate) as awb_certificate'); 
        $data = $this->db->query(' SELECT ( 3959 * acos( cos( radians( 30.7165995 ) ) * cos( radians( latitude ) ) * 
        cos( radians( longitude ) - radians( 76.694631 ) ) + sin( radians( 30.7165995 ) ) * sin( radians( latitude ) ) ) )
         AS distance,dog.users_id,dog.latitude,dog.longitude,CONCAT("'.IMAGE_PATH.'uploads_new/profile/", awb_certificate) as awb_certificate,CONCAT("'.IMAGE_PATH.'uploads_new/profile/", vaccination_certificate) as vaccination_certificate,dog.award,
         dog.mating_charge,aw.award_name,aw.event_organized_by,aw.image_path,aw.date from package_users_dog '.$where.' as dog  JOIN
          package_users_dog_award as aw where user_type = "17" HAVING distance <= 100 ORDER BY distance ASC LIMIT 0,10')->result_array();
        return $data;
    }
    public function get_dog_award(){
        $data = $this->db->query('SELECT animal_id,award_name,event_organized_by,image_path,date from package_users_dog_award')->result_array();
    }
    public function get_semen_vt_ai($search, $type){
        $data = $this->db->query('select username, doctor_id, state, email, image, mobile, users_type, city from doctor where users_type IN ('.$type.') AND city like "%'.$search.'%" OR city like "%'.$search.'%" OR mobile like "%'.$search.'%" OR doctor_id = "'.$search.'" OR username like "%'.$search.'%" OR state like "%'.$search.'%"')->result_array();
        return $data;
    }

    /*public function get_user_payment_detail($user_id, $type = ''){
        if($type != ''){
            $this->db->where('user_type = "'.$type.'"');
        }
        $data = $this->db->select("id,
            if(type = '15', 'Registered as Dealer',
            if(type = '16', 'Registered as Breeder', 
            if(type = '11', 'Advance Semen Booking',
            if(type = '12', 'Animal Premium','')))) as type,
            type as type_type, premium_bull_type, payment_type, users_id, ai_id, currency, request_id, request_status, status, amount, user_type, date")->where('users_id = '.$user_id.'')->get('log_file')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }*/

    public function get_user_payment_detail1($user_id, $type = ''){
        if($type != ''){
            $this->db->where('type = "'.$type.'"');

        }
        $this->db->where('payment_type','Dr');
        $this->db->where('date is NOT NULL', NULL, FALSE);
        $data = $this->db->select("id, if(type = '17', 'Dog Mating Registration',if(type = '12', 'Animal Premium','')) as type,type as type_type, premium_bull_type, payment_type, users_id, ai_id, currency, request_id, request_status,type, status, amount, user_type, date")->where('users_id = '.$user_id.'')->where('date is NOT NULL', NULL, FALSE)->order_by('id', 'DESC')->get('log_file')->result_array();
        if($data){
            return $data; 
        }else{
            return false; 
        }
    }
    public function purchase($users_id){
        return $this->db->where('users_id = '.$users_id.' AND payment_status = "Success"')->get('purchase')->result_array();
    }

    public function get_user_payment_detail($user_id, $type = ''){
        if($type != ''){
            $this->db->where('user_type = "'.$type.'"');
        }
        $data = $this->db->select("id, if(type = '11', 'Advance Semen Booking',if(type = '12', 'Animal Premium','')) as type,type as type_type, premium_bull_type, payment_type, users_id, ai_id, currency, request_id, request_status, status, amount, user_type, date")->where('users_id = '.$user_id.'')->get('log_file')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }


    public function get_semen_stock_id($id){
        $data = $this->db->where('id', $id)->get('seman_stock')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function update_semen_stock($stock_id, $stock){
        if($this->db->where('id', $stock_id)->update('seman_stock', $stock)){
            return true;
        }else{
            return false;
        }
    }
    public function add_company_semen($data){
        $detail = $this->db->insert('admin', $data);
        if($detail){
            return $this->db->insert_id();
        }else{
            return false;
        }
        
    }
    public function get_admin_detail1($suppliyer_id){
        $data = $this->db->where('admin_id', $suppliyer_id)->get('admin')->result_array();
        return $data;
    }
    public function get_seman_company_id($id){
        $detail = $this->db->where('admin_id', $id)->get('admin')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function check_doc_email($email){
        $detail = $this->db->where('email', $email)->get('doctor')->result_array();
        return $detail;
    }
    public function ai_listing_by_state($state_name = '', $type = ''){
        //$detail = $this->db->select('username, mobile, image')->where('state = "'.$name.'" AND users_type  = "pvt_ai" OR users_type = "pvt_vt"')->get('doctor')->result_array();
        if($state_name != ''){
            $this->db->where('state like "'.$state_name.'"');
        }
        if($type != ''){
            $this->db->where('users_type = "'.$type.'"');
        }else{
            $this->db->where('users_type = "pvt_ai"');
        }
        $detail = $this->db->select('username, mobile, image, city, state, ai_visiting_fee, total_experience, refral_code')->where('isactivated ="1"')->get('doctor')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function add_semen_stock($data){
        if($detail = $this->db->insert('seman_stock', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function user_reff_insert_req($data){
        if($detail = $this->db->insert('user_reff_update_req', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function job_sub_category_insert($data){
        if($detail = $this->db->insert('job_sub_category', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function put_jobs($data){
        if($detail = $this->db->insert('resume', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function put_naukari($data){
        if($detail = $this->db->insert('naukari_profile', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function check_company_seman_email($email){
        $detail = $this->db->where('email = "'.$email.'"')->get('admin')->result_array();
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function comp_mobile_email($mobile = '', $email = ''){
        if($mobile != ''){
            $this->db->where('mobile = "'.$mobile.'"');
        }
        if($email != ''){
            $this->db->where('email = "'.$email.'"');
        }
        $data = $this->db->get('admin')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_bank_name_by_id($id){
        $data = $this->db->where('admin_id', $id)->get('admin')->result_array();
        return $data;
     }
    public function get_paid_service_installment_desc($id){
        $detail = $this->db->where('paid_service_id', $id)->order_by('id', 'DESC')->get('paid_services_installment')->result_array();
        return $detail;
    }
    public function get_paid_id_id($id){
        $detail = $this->db->query('select count(*) as count from paid_services_animal_installation_table where animal_paid_order_id = '.$id.'')->result_array();
        return $detail;
    }
    public function get_paid_service_installment_count($id){
        $detail = $this->db->query('select count(*) as count from paid_services_installment where paid_service_id = '.$id.'')->result_array();
        return $detail;
    }
    public function get_paid_service_id($id){
        $detial = $this->db->where('id', $id)->get('paid_services')->result_array();
        return $detial;
    }
    public function get_paid_servises_payout($id){
        $data = $this->db->where('users_id = '.$id.' AND payment_status = "2"')->get('paid_order_paravate')->result_array();
        return $data;
    }
    public function ins_buy_table($data){
        $data = $this->db->insert('buy_table', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    public function ins_buy_animal($data){
        $data = $this->db->insert('buy_animal_table', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    public function get_user_payment($request_id){
        $data = $this->db->where('request_id',$request_id)->get('log_file')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_bank_detail($doc_id){
        $data = $this->db->select('bank_name, branch_address, ifsc_code, account_no, account_holder_name')->where('doctor_id', $doc_id)->get('doctor')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function  inp_user_detail($data){
		if($this->db->insert('get_coustomer_data',$data)){
			return true;
		}else{
			return false;
		}
    }
    public function ins_paid_services_order($data){
        $detail = $this->db->insert('paid_order_paravate', $data);
        $last_id = $this->db->insert_id();
        if($detail){
            return $last_id;
        }else{
            return false;
        }
    }
    public function paid_service_update($data, $id){
        $data = $this->db->where('id', $id)->update('paid_order_paravate', $data);
        return $id;
    }
    public function insert_animal_paid_services($data){
        $data = $this->db->insert('paid_services_animal_table', $data);
        return $data;
    }
    public function get_dary_farm($id = 0, $latitude = 0, $langitude = 0){
        $where = '';
        $select = '';
        $order = '';
        if($id != 0){
            $where = ' where id = '.$id.'';
        }
        if($latitude != 0){
            $select .= ", IFNULL(( 3959 * acos( cos( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('$langitude') ) + sin( radians('$latitude') ) * sin( radians( latitude ) ) ) ),0) AS distance";
            $order .= ', distance';
        }
        $data = $this->db->query('Select type, emp_id, farm_name, owner_name, address, location, latitude, langitude, product, rating, animal_type, animal_breed, animale_no, image, banner '.$select.' from dary_company_detail '.$where.' order by type '.$order.'')->result_array();
        return $data;
    }
    public function add_bank($data){
        $data = $this->db->insert('admin', $data);
        $last_id = $this->db->insert_id();
        if($data){
            return $last_id;
        }else{
            return false;
        }
    }
    public function add_sys_user($data){
        $data = $this->db->insert('admin', $data);
        if($data){
            return true;
        }else{
            return false;
        }
    }
    // public function insert_referal_code($data, $users_id){
    //     if($this->db->where('users_id', $users_id)->insert('users', $data)){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
    public function update_referal_code($data, $users_id){
        if($this->db->where('users_id', $users_id)->update('users', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function check_refral_code($users_id = '', $refral_id = ''){
        $where = "";
        if($users_id != ''){
            $where .= ' where users_id = "'.$users_id.'"';
            $use = 1;
        }
        if($refral_id != ''){
            if($use == 1){
                $where .= ' AND doc_referal_by = "'.$refral_id.'"';
            }else{
                $where .= ' where doc_referal_by = "'.$refral_id.'"';
            }
        }
        $data = $this->db->query('select * from users '.$where.'')->result_array();
        //$data = $this->db->where('users_id = '.$users_id.' '.$where.'')->get('users_ref')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_animal($id = '', $cat_id = '', $gendor='', $heard='', $breed_id = '', $doc_id = ''){
        $where = '';
        if($id != ''){
            $where .= 'AND users_id = "'.$id.'"';
        }
        if($cat_id != ''){
            $where .= 'AND category_id IN ('.$cat_id.')';
        }if($gendor!=''){
            $where .= ' AND gender like "'.$gendor.'"';
        }if($heard!=''){
            $where .= ' AND herd = "'.$heard.'"';
        }if($doc_id != ''){
            $where .= 'AND private_vt = "'.$doc_id.'"';
        }if($breed_id != ''){
            $where .= 'AND breed_id = "'.$breed_id.'"';
        }
        $query = "SELECT a.animal_id, a.users_id, a.category_id, a.breed_id, a.fullname, a.age, a.age_month, a.yield_max, a.height, a.weight, a.yield, a.lactation, a.price, a.gender, a.created_on, a.calf_status, a.treatment_status, a.tag_no, a.herd, a.herd_total, a.dob, a.is_pregnant, a.pregnant_month, a.pregnancy_date, ad.animal_age, ad.animal_month FROM animals as a, animals_detail as ad where ismodified !='2' AND ad.animal_id = a.animal_id ".$where."";
        $detail = $this->db->query($query)->result_array();
        return $detail;
    }
    public function get_animal_doc($id = '', $cat_id = '', $gendor='', $heard='', $breed_id = '', $doc_id = ''){
        $where = '';
        if($id != ''){
            $where .= 'AND users_id = "'.$id.'"';
        }
        if($cat_id != ''){
            $where .= 'AND category_id IN ('.$cat_id.')';
        }if($gendor!=''){
            $where .= ' AND gender like "'.$gendor.'"';
        }if($heard!=''){
            $where .= ' AND herd = "'.$heard.'"';
        }if($doc_id != ''){
            $where .= 'AND private_vt = "'.$doc_id.'"';
        }if($breed_id != ''){
            $where .= 'AND breed_id = "'.$breed_id.'"';
        }
        $query = "SELECT animal_id, users_id, category_id, breed_id, fullname, age, age_month, yield_max, height, weight, yield, lactation, price, gender, created_on, calf_status, treatment_status, tag_no, herd, herd_total, dob, is_pregnant, pregnant_month, pregnancy_date FROM animals as a where ismodified !='2' ".$where."";
        $detail = $this->db->query($query)->result_array();
        return $detail;
    }
    public function check_village_map($vill_code){
        $data = $this->db->query("select * from doctor_dump where find_in_set('".$vill_code."', village_id)")->result_array();
        // $data = $this->db->where('vill_id', $vill_code)->get('village')->result_array();
        // $vill_data = $this->db->where('village_code', $data[0]['village_code'])->get('doctor_villages')->result_array();
        if($data)
        {
            return $data;
        }else{
            return false;
        }
    }
    public function get_tarnsaction_total($users_id, $type = '', $payment_type = ''){
        $where = '';
        if($type != ''){
            $where .= ' AND type = "'.$type.'"';
        }
        if($payment_type != '' ){
            $where .= ' AND payment_type = "'.$payment_type.'"';
        }
        $data = $this->db->select('sum(amount) as sum')->where('users_id = '.$users_id.''.$where.'')->get('log_file')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_point_total($users_id, $type = '', $payment_type = ''){
        $where = '';
        if($type != ''){
            $where .= ' AND type = "'.$type.'"';
        }
        if($payment_type != '' ){
            $where .= ' AND payment_type = "'.$payment_type.'"';
        }
        $data = $this->db->select('sum(point) as sum')->where('users_id = '.$users_id.''.$where.'')->get('point_table')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_tarnsaction_record($users_id, $type = ''){
        $where = '';
        if($type != ''){
            $where = ' AND payment_type = "'.$type.'"';
        }
        $data = $this->db->where('users_id = '.$users_id.''.$where.' AND user_type = "0"')->get('log_file')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_company_detail($id = 0, $latitude = 0, $langitude = 0){
        $where = '';
        $select = '';
        $order = '';
        if($id != 0){
            $where = ' where id = '.$id.'';
        }
        if($latitude != 0){
            $select .= ", IFNULL(( 3959 * acos( cos( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('$langitude') ) + sin( radians('$latitude') ) * sin( radians( latitude ) ) ) ),0) AS distance";
            $order .= ', distance';
        }
        $data = $this->db->query('Select id, emp_id, type, name, contact_person, phone, brand, rating, location, product, address, latitude, longitude, email, url, logo, banner, description  '.$select.' from company_detail '.$where.' order by type '.$order.'')->result_array();
        return $data;
    }
    public function get_seman_company_detail($id = 0, $latitude = 0, $langitude = 0){
        $where = '';
        $select = '';
        $order = '';
        if($id != 0){
            $where = ' where id = '.$id.'';
        }
        if($latitude != 0){
            $select .= ", IFNULL(( 3959 * acos( cos( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('$langitude') ) + sin( radians('$latitude') ) * sin( radians( latitude ) ) ) ),0) AS distance";
            $order .= ', distance';
        }
        $data = $this->db->query('Select id, emp_id, type, bull_id, phone, name, breed_bull, contact_person, dob, dam_yield, doughter_yield, latitute, langitute, company_name, rating, contact_person, milk_yield, avvg_milk_fat, total_milk_fat, avg_milk_protein, total_milk_protein, email, url, address, description, image, banner '.$select.' from seman_comp_detail '.$where.' order by type '.$order.'')->result_array();
        return $data;
    }
    public function test(){
        $data = $this->db->where('id = 94')->get('log_file')->row_array();
        return $data;
    }
    public function insert_doc_pack($data){
        $data = $this->db->insert('doc_pack_listing', $data);
        $last_id = $this->db->insert_id();
        if($data){
            return $last_id;
        }else{
            return false;   
        }
    }
    public function doc_pack_listing($type , $distance = 0, $latitu = '', $langitude = '', $state = ''){
        $where = '';
        $select = '';
        if($state != ''){
            $where .= ' AND doc.state_code = "'.$state.'"';
        }
        if($distance != 0){
            $select = ", IFNULL(( 3959 * acos( cos( radians('$latitu') ) * cos( radians( dp.latitude ) ) * cos( radians( dp.langitude ) - radians ('$langitude') ) + sin( radians('$latitu') ) * sin( radians( dp.latitude ) ) ) ),0) AS distance";
            $where .= "having distance <= '$distance'  order by distance";
        }
        $data = $this->db->query('select distinct(doc_id), doc.username, doc.experience_desc, doc.mobile, doc.state, doc.district, doc.subdistrict, doc.city, doc.pincode, doc.address_full, doc.expertise_list, doc.total_experience, doc.city, doc.consul_fee, doc.image '.$select.' from doc_pack_listing as dp, doctor as doc where dp.doc_id = doc.doctor_id AND service_type = "'.$type.'" '.$where.'')->result_array();
        return $data;
    }
    public function doc_primum_listing($type, $distance = 0, $latitu = '', $langitude = '', $state = '', $speci_id = '', $start){
        $where = '';
        $select = '';
        if($state != ''){
            $where .= 'doc.state_code = "'.$state.'"';
        }
        if($speci_id != ''){
            $where .= ''.$speci_id.' IN (qualification )';
        }
        if($distance != 0){
            $select = ", IFNULL(( 3959 * acos( cos( radians('$latitu') ) * cos( radians( dp.latitude ) ) * cos( radians( dp.langitude ) - radians ('$langitude') ) + sin( radians('$latitu') ) * sin( radians( dp.latitude ) ) ) ),0) AS distance";
            $where .= "having distance <= '$distance'  order by distance";
        }
        if($where != ''){
            $where = 'where '.$where;
        }
        // $this->db->limit(10, 1);
        //$data = $this->db->query('SELECT * FROM doctor LIMIT 11, 10');
        $data = $this->db->query('select doctor_id as doc_id , doc.username, doc.experience_desc, doc.mobile, doc.state, doc.district, doc.subdistrict, doc.city, doc.pincode, doc.address_full, doc.expertise_list, doc.total_experience, doc.city, doc.consul_fee, doc.image '.$select.' from  doctor as doc '.$where.'LIMIT '.$start.','.NUM_DISPLAY_ENTRIES.'')->result_array();
        return $data;
    }
    public function sql_query($query){
        return $this->db->query($query)->result_array();
    }
    public function count_primum_doctor($type , $distance = 0, $latitu = '', $langitude = '', $state = '', $speci_id = '', $start){
        $where = '';
        $select = '';
        if($state != ''){
            $where .= ' AND doc.state_code = "'.$state.'"';
        }
        if($speci_id != ''){
            $where .= ''.$speci_id.' IN (qualification )';
        }
        if($distance != 0){
            $select = ", IFNULL(( 3959 * acos( cos( radians('$latitu') ) * cos( radians( dp.latitude ) ) * cos( radians( dp.langitude ) - radians ('$langitude') ) + sin( radians('$latitu') ) * sin( radians( dp.latitude ) ) ) ),0) AS distance";
            $where .= "having distance <= '$distance'  order by distance";
        }
        if($where != ''){
            $where = 'where '.$where;
        }
		$data = $this->db->query('select count(*) as count from doctor '.$where.'')->result_array();
        return $data;
       
    }
    public function get_total_credit($doc_id){
        $data = $this->db->query('select sum(amount) as amount from log_file where users_id = '.$doc_id.' AND payment_type = "Cr" AND user_type="0"')->result_array();
        return $data;
    }
    public function get_total_point_credit($doc_id){
        $data = $this->db->query('select sum(point) as amount from point_table where users_id = '.$doc_id.' AND payment_type = "Cr" AND user_type="0"')->result_array();
        return $data;
    }
    public function get_total_debit($doc_id){
        $data = $this->db->query('select sum(amount) as amount from log_file where users_id = '.$doc_id.' AND payment_type = "Dr" AND user_type="0"')->result_array();
        return $data;
    }
    public function get_my_purchase_detail($doc_id = '', $pack_id = ''){
        if($doc_id != ''){
            $this->db->where('doc_id = "'.$doc_id.'" AND is_paid <> "0"');
        }else{
            $this->db->where('purchase_id = "'.$pack_id.'"');
        }
        $this->db->order_by("doc_id","DESC");
        $data = $this->db->select('service_type, discount_amount, subtotal, total, taxes, purchase_id, created_at, subscription_id,is_paid')->get('doc_pack_listing')->result_array();
        return $data;
    }
    public function get_subus_dtail($id){
        $data = $this->db->where('id', $id)->get('subscription')->result_array();
        return $data;
    }
    public function listing_update($listing_id, $list_data){
        $data = $this->db->where('listing_id  = '.$listing_id.'')->update('doc_pack_listing',$list_data);
    }
    public function state_data($type){
        $data = $this->db->select('state_id, state_name, '.$type.'_price as price')->where('is_active = "1"')->get('state')->result_array();
        return $data;
    }
    public function get_bull_by_source_id($bull_source = 0, $name = ''){
        if($bull_source != 0){
            $this->db->where('bull_source = '.$bull_source.'');
        }
        $this->db->where('isactive = "1"');
        if($name != ''){
            $this->db->where('bull_name LIKE "%'.$name.'%" OR bull_no LIKE "%'.$name.'%" OR id LIKE "%'.$name.'%"');
        }
        if($data = $this->db->get('bull_table')->result_array()){
            return $data;
        }else{
            return false;
        }
    }
    public function get_subscription(){
        $data = $this->db->where('isactive = "1"')->get('subscription')->result_array();
        return $data;
    }
    public function update_log_file($data, $id){
        $detail = $this->db->where('id = '.$id.'')->update('log_file', $data);
        $data = $this->db->where('id = '.$id.'')->get('log_file')->row_array();
        return $data;
    }
    
    public function insert_doc_info($data){
        if($this->db->insert('doctor', $data)){
            $last_id = $this->db->insert_id();
            return $last_id;
        }else{
            return false;
        }        
    }
    public function breading_detail($user_id){
        $data = $this->db->query('Select * from ai_record where payment = 1 AND user_id = "'.$user_id.'"')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function update_ai_detail($ai_id, $data){
        $this->db->where('id = '.$ai_id.'')->update('ai_record', $data);
    }
    public function update_payment_status($data,  $id){
        $detail = $this->db->where('doctor_id = '.$id.'')->update('doctor', $data);
        return $detail;
    }
    public function payment_status($data){
        $this->db->insert('purchase_transaction',$data);
    }
    public function insert_log_data($data){
        $detail = $this->db->insert('log_file',$data);
        $last_id[]['purchase_id'] = $this->db->insert_id();
        return $last_id;
    }
    public function get_doc_by_ref_code($code){
        $detail = $this->db->where('refral_code = '.$code.'')->select('doctor_id')->get('doctor')->row_array();
        return $detail;
    }
    public function get_doc_id_det($id){
        $detail = $this->db->where('doctor_id = "'.$id.'"')->get('doctor')->row_array();
        return $detail;
    }
    public function paid_services(){
        $detail = $this->db->get('paid_services')->result_array();
        return $detail;
    }
    public function paid_services_id($id){
        $detail = $this->db->where('id', $id)->get('paid_services')->result_array();
        return $detail;
    }
    public function insert_point_data($data){
        $detail = $this->db->insert('point_table',$data);
        return $detail;
    }
    public function insert_mlm_point_data($data){
        $detail = $this->db->insert('mlm_point_table',$data);
        return $detail;
    }
    public function check_ref($ref){
        $data = $this->db->where('refral_code = "'.$ref.'"')->get('doctor')->row_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
	public function count_refral_uses($ref){
		$data = $this->db->query('select count(*) as count from doctor where refral_by_code = "'.$ref.'"')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function add_dummy($data){
        $this->db->insert('dummy', $data);
    }
    public function get_all_ai_request(){
        $this->db->get('');
    }
    public function get_all_tax(){
        $detail = $this->db->get('tax_table')->result_array();
        return $detail;
    }
    public function get_doc_price(){
        $detail = $this->db->get('doc_payment')->result_array();
        return $detail;
    }
    public function insert_doc_quali($data){
        if($this->db->insert('doc_qualification', $data)){
            $last_id = $this->db->insert_id();
            return $last_id;
        }else{
            return false;
        }   
    }
    public function insert_doc_exp($data){
        if($this->db->insert('doc_experience', $data)){
            $last_id = $this->db->insert_id();
            return $last_id;
        }else{
            return false;
        }  
    }
    public function get_state($country_code = '',$zone_id = ''){
        if($zone_id != '')
        $this->db->where('zone_id', $zone_id);
        if($country_code != '')
        $this->db->where('country_id', $country_code);
        $data = $this->db->get('zone')->result_array();
        return $data;
    }
    public function sub_sub_cat($sub_cat_id){
        $this->db->where('isactivated = "1"');
        return $this->db->where('sub_cat_id',$sub_cat_id)->get('job_sub_subcategory')->result_array();
    }
    public function get_city($state_id = '', $country_id = ''){
        if($state_id !=''){
            $this->db->where('state_id = '.$state_id.'');
        }if($country_id =''){
            $this->db->where('country_id = '.$country_id.'');
            $this->db->where('isactive = "1"');
        }
        $this->db->order_by('dist_name', 'ASC');
        $data = $this->db->get('district')->result_array();
        return $data;
    }
    public function get_city_dist($city_id = ''){
        if($city_id != ''){
            $this->db->where('city_id', $city_id);
        }
        return $this->db->get('city')->result_array();
    }
    public function get_qualification($id = ''){
        if($id != '')
        $this->db->where('qualifi_id', $id);
        $data = $this->db->get('qualification')->result_array();
        return $data;
    }
    public function get_job_sub_cat($job_cat = ''){
        if($job_cat != '')
        $this->db->where('job_category_id',$job_cat);
        $this->db->where('isactivated = "1"');
        $data = $this->db->get('job_sub_category')->result_array();
        return $data;
    }
    public function get_job_category(){
        $this->db->where('isactivated = "1"');
        $data = $this->db->get('job_category')->result_array();
        return $data;
    }
    public function get_bank_detail_update($data, $doc_id){
        $data = $this->db->where('doctor_id', $doc_id)->update('doctor', $data);
        if($data){
            return true;
        }else{
            return false;
        }
    }
    public function get_prefered_language($pre = ''){
        if($pre != '')
        $this->db->where("lang_id IN (".$pre.")");
        $data = $this->db->get('prefered_lang')->result_array();
        return $data;
    }
    public function get_specialisation($quali_id){
        $data = $this->db->where('quali_id = "'.$quali_id.'"')->get('specialisation')->result_array();
        return $data;
    }
    public function mobilecheck($mobile, $mobile_code){
        $detail = $this->db->where('mobile = "'.$mobile.'" AND mobile_code = "'.$mobile_code.'"')->get('users');
        $data = $detail->result_array();
        $count = $detail->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return FALSE;
        }
    }
    public function emailcheck($email){
        $detail = $this->db->where('email = "'.$email.'"')->get('users');
        $data = $detail->result_array();
        $count = $detail->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return FALSE;
        }
    }
    public function set_user($data){
        $detail = $this->db->insert('users', $data);
        if ($detail) {
            return true;
        } else {
            return FALSE;
        }
    }
    public function mobileadhaarcheck($mobile ='', $mobile_code ='', $aadhaar_no =''){
        if($mobile != ''){
        $this->db->where('mobile = "'.$mobile.'"');
        $this->db->where('mobile_code = "'.$mobile_code.'"');
        }
        if($aadhaar_no !='')
        $this->db->where('aadhaar_no = "'.$aadhaar_no.'"');
        $detail = $this->db->get('users');
        $data = $detail->result_array();
        $count = $detail->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return FALSE;
        }
    }
    public function docmobileadhaarcheck($mobile, $mobile_code){
        $detail = $this->db->where('mobile = "'.$mobile.'" AND mobile_code = "'.$mobile_code.'"')->get('doctor');
        $data = $detail->result_array();
        $count = $detail->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return FALSE;
        }
    }
    public function docemailcheck($email){
        $detail = $this->db->where('email = "'.$email.'"')->get('doctor');
        $data = $detail->result_array();
        $count = $detail->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return FALSE;
        }
    }
    public function docadhaarcheck($aadhar_no){
        $detail = $this->db->where('aadhar_no = "'.$aadhar_no.'"')->get('doctor');
        $data = $detail->result_array();
        $count = $detail->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return FALSE;
        }
    }
    public function get_last_log_id(){
        $detail = $this->db->query("SELECT max(id) as purchase_id FROM log_file")->result_array();
        return $detail;
    }
    public function get_banner(){
        $query = "SELECT * FROM banners where isactivated <> 0";
        $detail = $this->db->query($query)->result_array();
		$data = [];
		foreach($detail as $de){
			$de['image'] = base_url()."uploads/banner/".$de['image'];
			$data[] = $de;
		}
        return $data;
    }
    public function add_report_milk_adulttration($data){
        if($this->db->insert('report_milk_adulttration', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_state_id($state_id){
        $detail = $this->db->where('state_id', $state_id)->get('state')->result_array();
        return $detail;
    }
    public function get_distict_id($dist_id){
        $detail = $this->db->where('dis_id', $dist_id)->get('district')->result_array();
        return $detail;
    }
    public function get_distict($state_id){
        $detail = $this->db->where('state_id', $state_id)->get('district')->result_array();
        return $detail;
    }
    public function get_tehshil($dist_id){
        $detail = $this->db->where('dist_id', $dist_id)->get('tehshil')->result_array();
        return $detail;
    }
    public function get_gvh($tehshil_id){
        $detail = $this->db->where('tehshil_id', $tehshil_id)->get('gvh_table')->result_array();
        return $detail;
    }
    public function get_gvd($gvh_id){
        $detail = $this->db->where('gvh_id', $gvh_id)->get('gvd_table')->result_array();
        return $detail;
    }
    public function ins_gvh($data){
        $detail = $this->db->insert('gvh_table', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function get_invoice_id($id){
        return $this->db->where('id', $id)->get('semen_invoice_performa')->result_array();
    }
    public function get_employee_report(){
        $detail = $this->db->query("select dis.dist_name, if(type = '1', 'Vs','VLD') as employee_type, (select gvh_name from gvh_table as gvh where gvh.gvh_id = d.gvh_id) as gvh, (select gvd_name from gvd_table as gvd where gvd.gvd_id = d.gvd_id) as gvd, d.doc_code, d.doc_name, d.doc_mobile, vill.vill_name from doctor_dump as d, village as vill, district as dis where find_in_set(vill.vill_id, d.village_id) AND d.dist_id = dis.dis_id order by dis.dist_name")->result_array();
        return $detail;
    }
    public function get_doctor_report(){
        $detail = $this->db->query("select doctor_id, username, fullname, father_name, users_type, email, mobile, mobile_2nd, if(users_type='pvt_doc', CONCAT('https://www.livestoc.com/harpahu_dhyan/uploads/doctor/',image),CONCAT('https://www.livestoc.com/harpahu_dhyan/uploads/doc/',image)) as image, total_experience, city, state from doctor where isactivated = '1' AND users_type IN ('pvt_vt','pvt_ai','pvt_doc')")->result_array();
        return $detail;
    }
    public function get_doc_detail_id($id){
        $detail = $this->db->where('doctor_id',$id)->get('doctor')->result_array();
        return $detail;
    }
    public function ins_employee($data){
        $detail = $this->db->insert('doctor_dump', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function update_employee($data, $id){
        $detail = $this->db->where('doc_id', $id)->update('doctor_dump', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function ins_gvd($data){
        $detail = $this->db->insert('gvd_table', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function get_village($dist){
        $detail = $this->db->query('select * from district as dis, tehshil as teh, village as vil where dis.dis_id = teh.dist_id AND teh.tehsil_code = vil.tehshil_code AND dis.dis_id = '.$dist.' ORDER BY vil.vill_name  ASC')->result_array();
        //$detail = $this->db->where('tehshil_code', $dist)->order_by("vill_name", "asc")->get('village')->result_array();
        return $detail;
    }
    public function get_village_tehsil_code($dist){
        //$detail = $this->db->query('select * from district as dis, tehshil as teh, village as vil where dis.dis_id = teh.dist_id AND teh.tehsil_code = vil.tehshil_code AND dis.dis_id = '.$dist.' ORDER BY vil.vill_name  ASC')->result_array();
        $detail = $this->db->where('tehshil_code', $dist)->order_by("vill_name", "asc")->get('village')->result_array();
        return $detail;
    }
    public function get_animal_ani_id($animal_id){
        $query = "SELECT animal_id, users_id, category_id, breed_id, fullname, age, age_month, yield_max, height, weight, yield, lactation, price, gender,vt_id, calf, calf_status, treatment_status, breed_id, tag_no, no_of_males, no_of_females, herd, herd_total, tag_no, dob, is_pregnant, pregnant_month, pregnancy_date FROM animals where animal_id IN ('".$animal_id."')";
        $detail = $this->db->query($query)->result_array();
        return $detail;
    }
    public function get_animal_image($animal_id){
        $detail = $this->db->select('images')->where('animal_id', $animal_id)->get('animals_images')->result_array();
        return $detail;
    }
    public function get_animal_detail($id){
        $query = "SELECT * FROM animals where users_id = ".$id."";
        $detail = $this->db->query($query)->result_array();
        return $detail;
    }   
    public function get_animal_vacc($animal_id){
        //$detail = $this->db->where('animal_id = '.$animal_id.' AND treat_type = "1"')->get('vt_requests')->result_array();
        $detail = $this->db->query("select vr.* from vt_requests as vr where vr.animal_id = ".$animal_id." AND vr.treat_type = '1'")->result_array();
        //$detail = $this->db->query("select tr.id, tr.prescription, tr.size, tr.doze_time, tr.simtoms, tr.suggetions, tr.test_id, tr.blod_test, tr.blod_test_status from vt_requests as vr RIGHT JOIN treatment_req as tr ON tr.request_id = vr.id Where vr.treat_type = '1' AND vr.animal_id like '%".$animal_id."%'")->result_array();
        //$detail = $this->db->query('Select vg.name, vg.description, vg.short_desc, sv.vaccination_date from selling_vaccination as sv, vaccination_govt as vg where sv.vaccination_id = vg.vaccination_id AND sv.animal_id = '.$animal_id.'')->result_array();
        return $detail;
    }
    public function get_treat($animal_id){
        $detail = $this->db->query('select tr.simtoms, tr.doc_id, tr.vt_id, tr.date, (select username from doctor where doctor_id = tr.vt_id) as vt_name, tr.blod_test, tr.blod_test_status, d.username from treatment_req as tr, doctor as d where tr.doc_id = d.doctor_id AND tr.animal_id ='.$animal_id.'')->result_array();
        //$detail = $this->db->query("select tr.id, tr.prescription, tr.size, tr.doze_time, tr.simtoms, tr.suggetions, tr.test_id, tr.blod_test, tr.blod_test_status from vt_requests as vr RIGHT JOIN treatment_req as tr ON tr.request_id = vr.id Where vr.treat_type = '0' AND vr.animal_id like '%".$animal_id."%'")->result_array();
        return $detail;
    }
    public function get_deworming($animal_id)
    {
        $detail = $this->db->query('select date, status from deworming where animal_id = '.$animal_id.'')->result_array();
        return $detail;
    }
    public function get_breed($id = '', $category_id = ''){
        if($id != '')
        $this->db->where('breed_id', $id);
        if($category_id != '')
        $this->db->where('category_id',$category_id);
        // if($dealer_cat_id = '')
        // $this->db->where('dealer_cat_id',$dealer_cat_id);
        $this->db->where('isactivated = "1"');
        return $this->db->get('breed')->result_array();
    }
    public function get_breed_cat_id($id){
        $detail = $this->db->where('category_id', $id)->where('isactivated = "1"')->get('breed')->result_array();
        return $detail;
    }

    public function get_category($id ='',$dealer_cat_id = ''){
        if($id != '')
        $this->db->where('category_id', $id);
        if($dealer_cat_id != '')
        
        $this->db->where('category_id',$dealer_cat_id);
    $this->db->order_by("display_order");
        $this->db->select('category_id, animals_type_id, category, category_hindi, category_punjabi,CONCAT("'.IMAGE_PATH.'uploads/logo/",logo) as logo, CONCAT("'.IMAGE_PATH.'uploads/logo/bg/",background) as background');
        $detail = $this->db->get('category')->result_array();
        return $detail;
    }
    public function update_doc_ai_charges($doc_id, $data){
        $detail = $this->db->where('doctor_id', $doc_id)->update('doctor',$data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function avaialable_for_visit($doc_id, $data){
        $detail = $this->db->where('doctor_id', $doc_id)->update('doctor',$data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function insert_add($data){
        if($this->db->insert('address_mst', $data)){
            return True;
        }else{
            return False;
        }
    }
    public function get_address($id){
        $detail = $this->db->where('users_id', $id)->get('address_mst')->result_array();
        if($detail){
            return $detail; 
        }else{
            return False;
        }
    }
    public function get_ai_detail($id){
        $detail = $this->db->query('Select ai.vt_id, ai.strow_no, ai.date, d.username from ai_detail as ai, doctor as d  where animal_id = '.$id.' and ai.vt_id = d.doctor_id')->result_array();
        return $detail;
    }	
    public function del_address($id){
        if($this->db->where('id', $id)->delete('user_address')){
            return True;
        }else{
            return False;
        }
    }
    public function del_education($id){
        if($this->db->where('doc_qu_id', $id)->delete('doc_qualification')){
            return True;
        }else{
            return False;
        }
    }
    public function del_experience($exp_id){
        if($this->db->where('exp_id', $exp_id)->delete('doc_experience')){
            return True;
        }else{
            return False;
        }
    }
    public function change_request_status($request_id,$data){
        if($this->db->where('id', $request_id)->update('vt_requests',$data)){
            $this->db->where('request_id',$request_id)->update('vt_request_tracking', $data);
            return True;
        }else{
            return False;
        }
    }
    public function get_request_detail($req_id){
        $data = $this->db->where('id ='.$req_id.' AND vt_id = "0"')->get('vt_requests')->result_array();
        return $data;
    }
	public function animal_dead_update($animal_id,$data){
        $update = $this->db->where('animal_id', $animal_id)->update('animals',$data);
		if($update)
			return TRUE;
		else
			return FALSE;
    }

    public function get_vacc_detail_id($id){
        $update = $this->db->select('name, description')->where('vaccination_id IN ('.$id.')')->get('vaccination')->result_array();
		if($update)
			return $update;
		else
			return $update = [];
    }

    public function insert_vacc_req($data){
        $detail = $this->db->insert('ani_vacc_req', $data);
        return $detail;
    }
	public function get_vaccin($cat_id){
        $detail = $this->db->where('category_id', $cat_id)->get('vaccination')->result_array();
        if($detail){
            return $detail;
        }else{
            return False;
        }
    }
	 public function animal_table_update($animal_id,$data){
        $update = $this->db->where('animal_id', $animal_id)->update('animals',$data);
		if($update)
			return TRUE;
		else
			return FALSE;
    }
    
    public function get_user_info($id){
      $detail = $this->db->query("Select doctor_id,email,mobile_code, username, mobile,latitude,longitude,aadhar_no,fullname,officers_code,parent_id from doctor where doctor_id = '".$id."'")->row();
      if($detail)
		{
			 return $detail;
		}
		else{
			 return FALSE;
		}
    }
    public function get_user_info_id($id){
        $detail = $this->db->select('full_name, mobile, image')->where('users_id', $id)->get('users')->result_array();
        if($detail){
            return $detail;
        }else{
            return FALSE;
        }
    }
    public function request_track_detail($id){
        $detail = $this->db->where('request_id', $id)->get('vt_request_tracking')->result_array();
        if($detail){
            return $detail;
        }else{
            return False;
        }
    }

    public function get_request_by_id($id){
        $detail = $this->db->where('id', $id)->get('vt_requests')->result_array();
        if($detail){
            return $detail;
        }else{
            return False;
        }
    }

    public function cheack_tretment_image($id){
        $detail = $this->db->select('symptoms_image')->where('request_id', $id)->get('treatment_req')->result_array();
        if($detail){
            return $detail;
        }else{
            return False;
        }
    }

    public function request_detail($id){
        $detail = $this->db->select('address, latitude, langitude, treat_type, date')->where('id', $id)->get('vt_requests')->result_array();
        if($detail){
            return $detail;
        }else{
            return False;
        }
    }

	public function doctor_table_update($id,$data){
        $update = $this->db->where('doctor_id', $id)->update('doctor',$data);
		if($update)
			return TRUE;
		else
			return FALSE;
    }
    public function input_ai_record($ai_data){
        $data = $this->db->insert('ai_record', $ai_data);
        return $data;
    }
    public function get_opt_request($id, $otp){
        $update = $this->db->where('id = '.$id.' AND otp = '.$otp.'')->get('vt_request_tracking')->result_array();
		if($update)
			return $update;
		else
			return FALSE;
    }
    public function get_visiting_treet($users_id, $treat_type){
        return $this->db->where('users_id = "'.$users_id.'" AND treat_type = "'.$treat_type.'"')->order_by('id DESC')->get('vt_requests')->result_array();
    }
    public function get_super_request_by_id($id){
        $update = $this->db->where('id = '.$id.'')->get('vt_requests')->result_array();
		if($update)
			return $update;
		else
			return FALSE;
    }

    public function get_subrequest_by_id($id){
        $detail = $this->db->where('id = '.$id.'')->get('vt_request_tracking')->result_array();
        return $detail;
    }

    public function get_subrequest_by_id_status($id){
        $detail = $this->db->where('treat_status = 4 and request_id = '.$id.'')->get('vt_request_tracking')->result_array();
        return $detail;
    }

    public function request_test_ins($data){
        if($this->db->insert('request_test', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function change_super_request($id, $data){
        $update = $this->db->where('id = '.$id.'')->update('vt_requests',$data);
		if($update)
			return true;
		else
			return FALSE;
    }

    public function add_bull($data){
        $data = $this->db->insert('bull_table', $data);
        if($data){
            return $insert_id = $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function ins_doc($data){
        if($this->db->insert('doctor', $data)){
            return $insert_id = $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function get_user_doc_id($id){
        $detail = $this->db->where('users_id',$id)->get('users')->result_array();
        if($detail){
            return $detail[0]['vt_id'];
        }else{
            return false;
        }
    }

    public function get_doc_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' OR username like "%'.$name.'%"';
        }
        $query = $this->db->query('SELECT count(*) as count FROM doctor where isactivated = "1" AND users_type IN ("pvt_vt", "pvt_ai", "pvt_doc")'.$where)->result_array();
        return $query;
    }
    public function check_mobile_number_employee($mob_no){
        $detail = $this->db->where('doc_mobile', $mob_no)->get('doctor_dump')->result_array();
        return $detail;
    }
    public function doctor_doc_status($id , $data){
        if($this->db->where('doctor_id = '.$id.'')->order_by("doctor_id", "DESC")->update('doctor', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function state_status($id , $data){
        if($this->db->where('state_id = '.$id.'')->order_by("state_id", "DESC")->update('state', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function gvh_status($id , $data){
        if($this->db->where('gvh_id = '.$id.'')->order_by("gvh_id", "DESC")->update('gvh_table', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function tehshil_status($id , $data){
        if($this->db->where('tehshil_id = '.$id.'')->order_by("tehshil_id", "DESC")->update('tehshil', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function employee_status($id , $data){
        if($this->db->where('doc_id = '.$id.'')->order_by("doc_id", "DESC")->update('doctor_dump', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function gvd_status($id , $data){
        if($this->db->where('gvd_id = '.$id.'')->order_by("gvd_id", "DESC")->update('gvd_table', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function district_status($id , $data){
        if($this->db->where('dis_id = '.$id.'')->order_by("dis_id", "DESC")->update('district', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_doc_banner($type){
        $detail = $this->db->where('type = "'.$type.'"')->get('doc_banner')->result_array();
        return $detail;
    }
    public function user_status($id , $status){
        $data['isactivated'] = $status;
        if($this->db->where('users_id = '.$id.'')->order_by("users_id", "DESC")->update('users', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function doctor_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('username like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $this->db->order_by("doctor_id", "desc");
        $this->db->where('isactivated', '1');
        $detail = $this->db->where('users_type IN ("pvt_ai","pvt_vt","pvt_doc")')->get('doctor')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function sys_user_status($id, $status){
        $data['isactivated'] = $status;
        $detail = $this->db->where('admin_id', $id)->update('admin', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function sys_user_search($name = '', $start, $perpage, $type ='', $admin_id=''){
        if(isset($name)){
            $this->db->where('fname like "%'.$name.'%"');
        }
        //if($admin_id != ''){
            $this->db->where('super_admin_id', $admin_id);
        //}
        if($type != ''){
            $this->db->where('type = "'.$type.'"');
        }
        $this->db->limit($perpage, $start);
        $this->db->from('admin');
        $this->db->join('role', 'admin.type = role.id');
        $detail = $this->db->get()->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_sys_user_count($name = '', $type ='', $admin_id=''){
        $where = '';
        if($admin_id != ''){
            $where =' where super_admin_id = "'.$admin_id.'"';
            if($name != ''){
                $where .= ' AND fname like "%'.$name.'%"';
                if($type != ''){
                    $where .= ' and type = "'.$type.'"';
                }
            }else{
                if($type != ''){
                    $where .= ' AND type = "'.$type.'"';
                }
            }
        }else{
            if($name != ''){
                $where = 'where fname like "%'.$name.'%"';
                if($type != ''){
                    $where .= ' and type = "'.$type.'"';
                }
            }else{
                if($type != ''){
                    $where = 'where type = "'.$type.'"';
                }
            }
        }
        
        $data = $this->db->query('Select count(*) as count from admin'.$where.'')->result_array();
        return $data;
    }
    public function get_packacge_rate_product_id($id){
        $data = $this->db->query('select pp.pack_id, pp.mrp, pp.sale_price, pp.vt_sale_price, pk.name from product_pack_rate as pp, product_package as pk where pp.product_id = '.$id.' AND pp.pack_id = pk.id')->result_array();
        //$data = $this->db->where('product_id', $id)->get('product_pack_rate')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_packacge_composition_product_id($id){
        $data = $this->db->where('product_id', $id)->get('product_composition')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function product_id($id){
        $detail = $this->db->where('id', $id)->get('product')->result_array();
        return $detail;
    }
    public function state_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('state_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('state')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_state_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where state_name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from state'.$where.'')->result_array();
        return $data;
    }
    public function village_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('vill_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('village')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_village_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where vill_name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from village'.$where.'')->result_array();
        return $data;
    }
    public function teshil_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('tehshil_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('tehshil')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function ins_tehshil($data){
        $detail = $this->db->insert('tehshil', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function check_village_code($code){
        $detail = $this->db->where('village_code',$code)->get('village')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function ins_village($data){
        $detail = $this->db->insert('village', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function get_district($pre = ''){
        if($pre != '')
        $this->db->where('dis_id IN ('.$pre.')');
        $data = $this->db->get('district')->result_array();
        return $data;
    }
    public function request_edit($id, $data){
       $data = $this->db->where('id', $id)->update('vt_requests', $data);
       $detail = $this->db->where('id', $id)->get('vt_requests')->result_array();
       if($detail){
            return $detail;
       }else{
            return false;
       }
    }
    public function get_teshil_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where tehshil_name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from tehshil'.$where.'')->result_array();
        return $data;
    }
    public function gvh_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('gvh_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('gvh_table')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_gvh_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where gvh_name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from gvh_table'.$where.'')->result_array();
        return $data;
    }
    public function gvd_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('gvd_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('gvd_table')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_gvd_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where gvd_name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from gvd_table'.$where.'')->result_array();
        return $data;
    }
    public function employee_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('doc_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('doctor_dump')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_employee_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where doc_name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from doctor_dump'.$where.'')->result_array();
        return $data;
    }
    public function paravet_order_search($name = '', $start, $perpage){
        $where = '';
        if($name != ''){
            $where .= ' AND d.username like "%'.$name.'%"';
        }
        $detail = $this->db->query('select po.id, d.date, d.username, po.name, po.phone, po.users_id from paid_order_paravate as po, doctor as d where d.doctor_id = po.users_id '.$where.' order by d.date DESC LIMIT '.$start.', '.$perpage.'')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_paravet_order_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' AND d.username like "%'.$name.'%"';
        }
        $data = $this->db->query('select d.username,d.date, po.name, po.phone, po.users_id from paid_order_paravate as po, doctor as d where d.doctor_id = po.users_id '.$where.' order by d.date DESC')->result_array();
        return $data;
    }
    public function district_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('dist_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('district')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_district_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where dist_name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from district'.$where.'')->result_array();
        return $data;
    }
    public function input_laguage($data){
        if($this->db->insert('language', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_featured_videos($category = '', $start = '', $perpage ='', $video_type){
        if($category !='' ){
            $this->db->where('category_id IN ('.$category.')');   
        }if($video_type != ''){
            $this->db->where('video_type', $video_type); 
        }
         if($start != '')
         $this->db->limit($perpage, $start);
         $this->db->where('isactivated', 1);
        return $this->db->select('video_id, video_type, category_id, title, CONCAT("'.IMAGE_PATH.'uploads_new/featured_video/",video) as video, CONCAT("'.IMAGE_PATH.'uploads_new/featured_video/video_thumb/",video_thumb) as video_thumb, price, link')->get('video')->result();
    }
    public function get_featured_product($category = '', $start = '', $perpage ='', $product_type=''){
        if($category !='' ){
            $this->db->where('category_id IN ('.$category.')');   
         }
         if($start != '')
         $this->db->limit($perpage, $start);
         if($product_type != '')
         $this->db->where('product_type', $product_type);
         $this->db->where('isactivated', 1);
         $this->db->select('product_id,product_type, category_id, title, CONCAT("'.IMAGE_PATH.'uploads_new/featured_product/", video) as video, CONCAT("'.IMAGE_PATH.'uploads_new/featured_product/featured_thumb/", product_thumb) as product_thumb , price, link, isactivated');
         return $this->db->get('featured_product')->result_array();
    }
    public function get_articles($category = '', $start = '', $perpage ='', $user_id = ''){
        if($category !='' ){
            $this->db->where('category_id IN ('.$category.')');   
         }
         if($start != '')
         $this->db->limit($perpage, $start);
         $this->db->where('isactivated', '1');
         if($user_id != '')
         $this->db->order_by("article_id", "DESC");
         $this->db->select("(SELECT count(event_log_id) as count FROM event_log where users_id = '$users_id' and event_id=article_id and event_status='0' and type='3' and isactivated ='1') as like_user");
         return $this->db->select('article_id,CONVERT(title USING utf8) as title,category_id,sub_texts, (SELECT count(event_log_id) as count FROM event_log where event_id = article_id and event_status="0" and type="3" and isactivated ="1") as article_total_like, CONCAT("'.IMAGE_PATH.'uploads_new/articles/",images) as image, CONCAT("'.IMAGE_PATH.'uploads_new/articles/thumb/", images)  as image_thumb,created_by_id,author_name,created_on')->get('article')->result();
    }
    public function get_dog_cat_banner($category = '', $start = '', $perpage =''){
        if($category !='' ){
            $this->db->where('category_id IN ('.$category.')');   
         }
         $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/banners/", images) as images');
         $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/banners/",images_hindi) as images_hindi');
         $this->db->select('article_id,title,category_id,name');
         $this->db->where('isactivated','1');
        return $this->db->get('dog_cat_banner')->result_array();
    }
    public function get_animal_services($category = '', $start = '', $perpage =''){
        if($category !='' ){
            $this->db->where('category_id IN ('.$category.')');   
         }
        //  $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/banners/", images) as images');
        //  $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/banners/",images_hindi) as images_hindi');
        //  $this->db->select('article_id,title,category_id,name');
         $this->db->where('isactivated','1');
        return $this->db->get('animal_services')->result_array();
    }
    public function get_events($category = '', $start = '', $perpage =''){
        if($category !='' ){
            $this->db->where('category_id IN ('.$category.')');   
         }
         $this->db->where('isactivated',1);
         $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/events/", images) as images');
         $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/events/thumb/", small_image) as event_image');
         $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/events/thumb/", small_image) as image_thumb');
         $this->db->select('event_id,title,category_id,sub_texts, email, phon_no, event_date, created_by_id,author_name,created_on');
        return $this->db->get('event')->result_array();
    }
    public function get_featured_sinage(){
        if($category !='' ){
            $this->db->where('category_id IN ('.$category.')');   
         }
         $this->db->select('id, category_id, title, CONCAT("'.IMAGE_PATH.'uploads/sinage/", image) as images, link');
         return $this->db->get('feature_sinage')->result_array();
    }
    public function get_animals($category = '', $start = '', $perpage ='', $users_type_id = '', $animal_purpose='', $state_name = ''){
         if($category !='' ){
            $this->db->where('a.category_id IN ('.$category.')');   
         }
         if($users_type_id != '')
         $this->db->where('a.users_type_id', $users_type_id);
         if($animal_purpose != '')
         $this->db->where('a.animal_purpose IN ('.$animal_purpose.')');
         if($state_name != '')
         $this->db->where('a.state LIKE "%'.$state_name.'%"');
         $this->db->select('a.animal_id as animal_id,a.state,a.fullname,a.users_type_id,b.breed_name as breed,a.gender,a.price,a.breed_id,a.category_id,c.category_id,c.category');
         $this->db->order_by('a.animal_id','DESC');
         $this->db->from('animals as a');
         $this->db->limit($perpage, $start);
         $this->db->where("a.isactivated='1' and a.isaccepted='1'");
         $this->db->join('category as c', 'a.category_id=c.category_id', 'left');
         $this->db->join('breed as b', 'a.breed_id=b.breed_id', 'left');
         $this->db->join('animals_detail as ad', 'a.animal_id = ad.animal_id', 'left');
         $data = $this->db->get()->result_array();
         $detail = [];
         foreach($data as $da){
            $da['animals_images'] = $this->get_animal_image_link($da['animal_id']);
            $detail[] = $da;
         }
         if($data)
		 {
			return $detail;
		 }
         else
         {
            return FALSE;
         }
    }
    public function doc_premium_type($type, $language='', $category=''){
        //$this->
        if($language == 'hi')
        $lang = '_hindi';
        if($language == 'pa')
        $lang = '_punjabi';
        if($category != ''){
            $this->db->where('speci_id IN ('.$category.')');
        }else{
            $this->db->where('type IN ('.$type.')');
        }
        $this->db->where('isactive', '1');
        $this->db->select('id, name'.$lang.' as  name, speci_id, type, discription'.$lang.' as discription, CONCAT("'.IMAGE_PATH.'uploads/doctor_type/", image) as image');
        return $this->db->get('doc_premium_type')->result_array();
    }
    public function get_animal_image_link($animal_id){
        return $this->db->select('CONCAT("'.IMAGE_PATH.'uploads_new/animals/thumb/", images) as images')->where('animal_id', $animal_id)->get('animals_images')->result_array();
    }
    public function get_information_banners($category = '', $start = '', $perpage ='', $type = ''){
        if($category !='' ){
           $this->db->where('category_id IN ('.$category.')');   
        }
        if($start != '')
        $this->db->limit($perpage, $start);
        if($type != '')
        $this->db->where('banners_type = "'.$type.'"');
        $this->db->where('isactivated', 1);
        return $this->db->select('banners_id, banners_type, category_id, title, CONCAT("'.IMAGE_PATH.'uploads_new/banners/",image) as image, link')->get('banners')->result_array();
    }
    public function get_seman_stock($users_id, $type){
        $this->db->where('type', $type);
        $this->db->where('admin_id', $users_id);
        return $this->db->get('seman_stock')->result_array();
    }
    public function get_featured_semen($category = '', $start = '', $perpage =''){
        if($category !='' ){
            $this->db->where('category_id IN ('.$category.')');
        }
        $this->db->limit($perpage, $start);
        return $this->db->select('id, category_id, name, bull_no, dob, bread, dam_yield, CONCAT("'.IMAGE_PATH.'uploads/semen/",image) as image')->get('feature_semen')->result_array();
    }
    public function get_seman_banner(){
        $this->db->query("SELECT a.animal_id,a.state,a.fullname,a.users_type_id,a.gender,a.price,a.breed_id,a.category_id,c.category_id,c.category FROM animals as a left join category as c on a.category_id=c.category_id LEFT JOIN animals_detail as ad ON a.animal_id = ad.animal_id  $where $wherefilter and a.isactivated='1' and a.isaccepted='1' order by a.animal_id DESC $limit");
    }
    public function language_search($name = '', $start = '', $perpage =''){
        if(isset($name)){
            $this->db->where('name like "%'.$name.'%"');
        }
        if($start != ''){
            $this->db->limit($perpage, $start);
        }else{
            $this->db->where('is_activate = "1"');
        }
        $detail = $this->db->get('language')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function language_status($id, $data){
        if($this->db->where('id', $id)->update('language', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_language_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from language'.$where.'')->result_array();
        return $data;
    }
    public function user_search($name = '', $start, $perpage){
        if(isset($name)){
            //old records as per full name
            //$this->db->where('fullname like "%'.$name.'%"');
            $this->db->where('full_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('users')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_animal_count_user($user_id = ''){
        if($user_id !=''){
            $this->db->where('users_id', $user_id);
        }
        $data = $this->db->select('count(animal_id) as count')->get('animals')->result_array();
        return $data;
    }
    public function get_animal_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where fullname like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from animals'.$where.'')->result_array();
        return $data;
    }
    public function get_bank_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where bank_name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from seman_bank'.$where.'')->result_array();
        return $data;
    }
    public function get_user_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where fullname like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from users'.$where.'')->result_array();
        return $data;
    }
    public function animal_search($name = '', $start, $perpage){
        if(isset($name)){
            //$this->db->where('title like "%'.$name.'%"');
             $this->db->where('fullname like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('animals')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function seman_bull_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('bull_no like "%'.$name.'%"');
        }
        $this->db->order_by("id", "DESC");
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('bull_table')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function insert_doc_add($data){
        if($this->db->insert('doc_address', $data)){
            return True;
        }else{
            return False;
        }
    }
    public function get_seman_detail($id){
        $data = $this->db->where('id', $id)->get('bull_table')->result_array();
        return $data;
    }
    public function get_animal_id($id){
        $data = $this->db->select('animal_id, title, tag_no')->where('animal_id', $id)->get('animals')->result_array();
        return $data;
    }
    public function get_ai_payment($user_id, $type = ''){
        if($type != ''){
            $this->db->where('payment', $type);
        }
        $detail = $this->db->where('user_id', $user_id)->get('ai_record')->result_array();
        return $detail;
    }
    public function get_bull_detail($id){
        $detail = $this->db->query("SELECT bul.id, bul.bull_no, bul.dob, bul.lat_yield, bul.sire_no, cat.breed_name, sb.bank_name as bull_source  FROM bull_table as bul, breed as cat, admin as sb where bul.id=".$id." and cat.breed_id = bul.bread AND sb.admin_id = bul.bull_source")->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_vt_comp_latitude_pvt($lati, $long, $radious){
        $de = $this->db->query("select du.doctor_id, du.username, du.mobile, du.image, IFNULL(( 3959 * acos( cos( radians('$lati') ) * cos( radians( langitute ) ) * cos( radians( lantitute ) - radians ('$long') ) + sin( radians('$lati') ) * sin( radians( langitute ) ) ) ),0) AS distance from current_loc as cu, doctor as du where cu.doctor_id = du.doctor_id AND du.users_type IN ('pvt_vt', 'pvt_ai') AND isactivated = '1' having distance <= '".$radious."' order by distance")->result_array();
        return $de;
    }
    public function change_status_company($admin_id, $data){
        $data = $this->db->where('admin_id', $admin_id)->update('admin', $data);
        return $data;
    }
    public function get_admin_detail($admin_id){
        $data = $this->db->where('admin_id', $admin_id)->get('admin')->result_array();
        return $data;
    }
    public function change_active_status($bull_id, $data){
        if($this->db->where('id', $bull_id)->update('bull_table', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function change_stow_active_status($stock_id, $data){
        if($this->db->where('id', $stock_id)->update('seman_stock', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_strow_count_by_source_id_bull_id($admin_id, $bull_id, $issuer = ''){
        $issu = '';
        if($issuer != ''){
            $issu =' AND admin_id = '.$issuer.'';
        }
        $data = $this->db->query('select sum(rest_stock) as count from seman_stock where bull_id = '.$bull_id.' AND bank_id = '.$admin_id.''.$issu.' AND isactive = "1"')->result_array();
        // $data = $this->db->where('bull_id = '.$bull_id.' AND bank_id = '.$admin_id.'')->get('seman_stock')->result_array();
        return $data;
    }
    public function check_semen_strow($strow, $bull_id)
    {
        $data = $this->db->where('batch_no = "'.$strow.'" AND bull_id = '.$bull_id.'')->get('seman_stock')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_all_bull($search = ''){
        if($search != ''){
            $this->db->where('bull_no like "%'.$search.'%"');
        }
        $detail = $this->db->select('id, bull_no')->get('bull_table')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_ai_doc_latlog_type($type, $langituit, $latituit){
        $where = ''; 
        if($type == 1){
            $where .= 'AND 	users_type like "pvt_ai"';
        }else{
            $where .= 'AND users_type = "govt_vt"';
        }
        $data = $this->db->query("SELECT cl.doctor_id, do.username, do.total_experience, do.city, do.ai_visiting_fee, do.image, IFNULL(( 3959 * acos( cos( radians('$latituit') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('$langituit') ) + sin( radians('$latituit') ) * sin( radians( cl.lantitute ) ) ) ),0) AS distance FROM current_loc as cl, doctor as do where do.doctor_id = cl.doctor_id ".$where." having distance <= '".RADIOUS_DIST."' order by distance")->result_array();
        return $data;
    }
    public function get_doc_degree($doc_id){
        $data = $this->db->where('doc_id', $doc_id)->get('doc_qualification')->result_array();
        return $data;
    }
    public function get_seman_breed_without_id($category_id){
        $data = $this->db->select('id, bull_no, bull_name, bull_id, dob, progini_test, sire_no, video, dam_no, lat_yield, daughter_yield, total_milk_fat, sires_breed, dams_breed, total_milk_proteen, avg_milk_proteen, rating, description, lact_no, bull_source, category, bread, seman_category, image, price, vt_ai_price, is_imported, is_certified, ispremium, company_charges, semen_type')->where('category = "'.$category_id.'"')->get('bull_table')->result_array();
        return $data;
    }
    public function get_semen_price($type, $bull_id){
        $data = $this->db->query('select id, bull_no as BUll_ID, '.$type.' as price, company_charges as Company_charges, vt_ai_price from bull_table where id = '.$bull_id.'')->result_array();
        return $data;
    }
    public function get_seman_breed_id_count($breed_id = '', $category_id = '', $premium = '', $daughter_yield_from = '', $daughter_yield_to = '', $user_type ='', $price_from='', $price_to='', $milk_type = '', $price_order = '', $latitude = '', $longitude = '',  $start = '10'){
        // if($latitude != ''){
            if($breed_id != ''){
                $this->db->where('bul.bread',$breed_id);
            }if($premium != ''){
               // $this->db->where('bul.ispremium != "0"');
            }if($daughter_yield_from != ''){
                $this->db->where('bul.lat_yield BETWEEN '.$daughter_yield_from.' AND '.$daughter_yield_to.'');
            }if($milk_type != ''){
                $this->db->where('bul.milk_type', $milk_type);
            }if($category_id != ''){
                $this->db->where('bul.category', $category_id);
            }
            if($price_from != ''){
                if($user_type == '1'){
                    $this->db->where('bul.price BETWEEN '.$price_from.' AND '.$price_to.'');
                }else{
                    $this->db->where('bul.ai_price BETWEEN '.$price_from.' AND '.$price_to.'');
                }
            }
            if($limit){
                $this->db->limit($limit, $start);
            }
            $this->db->where('isactive = "1"');
            if($price_order == '0'){
                $this->db->order_by("bul.price", "desc");
            }if($price_order == '1'){
                $this->db->order_by("bul.price", "ASC");
            }else{
                $this->db->order_by("bul.ispremium", "desc");
            }
            if($latitude != ''){
                $this->db->order_by("distance");
                //$this->db->having('0 < stock');
                $this->db->where('a.isactivated="1" AND (select sum(rest_stock) as stock from seman_stock as st where st.bull_id = bul.id AND a.admin_id = st.admin_id) IS NOT NULL AND a.user_type="6" OR a.user_type="9"');
                $this->db->select('bul.id, (select if(sum(st.rest_stock) IS NULL, 0,sum(st.rest_stock)) as stock from seman_stock as st where st.bull_id = bul.id) as stock, IFNULL(( 3959 * acos( cos( radians("'.$latitude.'") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ("'.$longitude.'") ) + sin( radians("'.$latitude.'") ) * sin( radians( latitude ) ) ) ),0) AS distance')
                ->from('`admin` as `a`, `bull_table` as `bul');
                }else{
                    $this->db->where('a.isactivated="1" AND (select sum(rest_stock) as stock from seman_stock as st where st.bull_id = bul.id AND a.admin_id = st.admin_id) IS NOT NULL AND a.user_type="6" OR a.user_type="9"');
                $this->db->select('bul.id, (select if(sum(st.rest_stock) IS NULL, 0,sum(st.rest_stock)) as stock from seman_stock as st where st.bull_id = bul.id) as stock')
                ->from('`admin` as `a`, `bull_table` as `bul');
                }
            $data = $this->db->get()->result_array();
            $detail = [];
            $count = 0;
            foreach($data as $d){
                if($d['stock'] != 0){
                    $detail[] = $d;
                    $count+=1;
                }
            }
            $count['count'] = $count;
            //$data = $this->db->query('SELECT   FROM admin as a, bull_table as bul where a.isactivated="1" AND a.user_type="5" OR a.user_type="9" and  order by distance')->result_array();
        // }else{
        //     if($breed_id != ''){
        //         $this->db->where('bread',$breed_id);
        //     }if($premium != ''){
        //         $this->db->where('ispremium != "0"');
        //     }if($daughter_yield_from != ''){
        //         $this->db->where('lat_yield BETWEEN '.$daughter_yield_from.' AND '.$daughter_yield_to.'');
        //     }if($milk_type != ''){
        //         $this->db->where('milk_type', $milk_type);
        //     }if($category_id != ''){
        //         $this->db->where('category', $category_id);
        //     }
        //     if($price_from != ''){
        //         if($user_type == '1'){
        //             $this->db->where('price BETWEEN '.$price_from.' AND '.$price_to.'');
        //         }else{
        //             $this->db->where('ai_price BETWEEN '.$price_from.' AND '.$price_to.'');
        //         }
        //     }
        //     $this->db->where('isactive = "1"');
        //     if($price_order == '0'){
        //         $this->db->order_by("price", "desc");
        //     }if($price_order == '1'){
        //         $this->db->order_by("price", "ASC");
        //     }else{
        //         $this->db->order_by("ispremium", "desc");
        //     }
        //     $data = $this->db->select('count(id) as count')->get('bull_table')->result_array();
        // }
        return $count;
    }
    public function get_seman_breed_id($breed_id = '', $category_id = '', $limit = '', $premium = '', $daughter_yield_from = '', $daughter_yield_to = '', $user_type ='', $price_from='', $price_to='', $milk_type = '', $price_order = '', $latitude = '', $longitude = '',  $start = '0'){
        // if($latitude != ''){
            if($breed_id != ''){
                $this->db->where('bul.bread',$breed_id);
            }if($premium != ''){
               // $this->db->where('bul.ispremium != "0"');
            }if($daughter_yield_from != ''){
                $this->db->where('bul.lat_yield BETWEEN '.$daughter_yield_from.' AND '.$daughter_yield_to.'');
            }if($milk_type != ''){
                $this->db->where('bul.milk_type', $milk_type);
            }if($category_id != ''){
                $this->db->where('bul.category', $category_id);
            }
            if($price_from != ''){
                if($user_type == '1'){
                    $this->db->where('bul.price BETWEEN '.$price_from.' AND '.$price_to.'');
                }else{
                    $this->db->where('bul.ai_price BETWEEN '.$price_from.' AND '.$price_to.'');
                }
            }
            if($limit){
                $this->db->limit($limit, $start);
            }
            $this->db->where('isactive = "1"');
            if($price_order == '0'){
                $this->db->order_by("bul.price", "desc");
            }if($price_order == '1'){
                $this->db->order_by("bul.price", "ASC");
            }else{
                $this->db->order_by("bul.ispremium", "desc");
            }
            if($latitude != ''){
                $this->db->order_by("distance");
                $this->db->having('0 < stock');
                $this->db->where('a.isactivated="1" AND (select sum(rest_stock) as stock from seman_stock as st where st.bull_id = bul.id AND a.admin_id = st.admin_id) IS NOT NULL AND a.user_type="6" OR a.user_type="9"');
                $this->db->select('a.fname, a.admin_id, bul.id, bul.bull_no, (select if(sum(st.rest_stock) IS NULL, 0,sum(st.rest_stock)) as stock from seman_stock as st where st.bull_id = bul.id) as stock, bul.bull_name, bul.bull_id, bul.dob, bul.progini_test, bul.sire_no, bul.video, bul.dam_no, bul.lat_yield, bul.daughter_yield, bul.total_milk_fat, bul.sires_breed, bul.dams_breed, bul.total_milk_proteen, bul.avg_milk_proteen, bul.rating, bul.description, bul.lact_no, bul.bull_source, bul.category, bul.bread, bul.seman_category, bul.image, bul.price, bul.ai_price, bul.vt_ai_price, bul.is_imported, bul.is_certified, bul.ispremium, bul.company_charges, bul.semen_type, IFNULL(( 3959 * acos( cos( radians("'.$latitude.'") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ("'.$longitude.'") ) + sin( radians("'.$latitude.'") ) * sin( radians( latitude ) ) ) ),0) having distance <= "'.RADIOUS_DIST.'" AS distance')
                ->from('`admin` as `a`, `bull_table` as `bul');
                }else{
                    $this->db->where('a.isactivated="1" AND (select sum(rest_stock) as stock from seman_stock as st where st.bull_id = bul.id AND a.admin_id = st.admin_id) IS NOT NULL AND a.user_type="6" OR a.user_type="9"');
                $this->db->select('a.fname, a.admin_id, bul.id, bul.bull_no, (select if(sum(st.rest_stock) IS NULL, 0,sum(st.rest_stock)) as stock from seman_stock as st where st.bull_id = bul.id) as stock, bul.bull_name, bul.bull_id, bul.dob, bul.progini_test, bul.sire_no, bul.video, bul.dam_no, bul.lat_yield, bul.daughter_yield, bul.total_milk_fat, bul.sires_breed, bul.dams_breed, bul.total_milk_proteen, bul.avg_milk_proteen, bul.rating, bul.description, bul.lact_no, bul.bull_source, bul.category, bul.bread, bul.seman_category, bul.image, bul.price, bul.ai_price, bul.vt_ai_price, bul.is_imported, bul.is_certified, bul.ispremium, bul.company_charges, bul.semen_type')
                ->from('`admin` as `a`, `bull_table` as `bul');
                }
            $data = $this->db->get()->result_array();
            $detail = [];
            foreach($data as $d){
                if($d['stock'] != 0){
                    $detail[] = $d;
                }
            }
            //$data = $this->db->query('SELECT   FROM admin as a, bull_table as bul where a.isactivated="1" AND a.user_type="5" OR a.user_type="9" and  order by distance')->result_array();
        // }else{
        //     if($breed_id != ''){
        //         $this->db->where('bread',$breed_id);
        //     }if($premium != ''){
        //         $this->db->where('ispremium != "0"');
        //     }if($daughter_yield_from != ''){
        //         $this->db->where('lat_yield BETWEEN '.$daughter_yield_from.' AND '.$daughter_yield_to.'');
        //     }if($milk_type != ''){
        //         $this->db->where('milk_type', $milk_type);
        //     }if($category_id != ''){
        //         $this->db->where('category', $category_id);
        //     }
        //     if($price_from != ''){
        //         if($user_type == '1'){
        //             $this->db->where('price BETWEEN '.$price_from.' AND '.$price_to.'');
        //         }else{
        //             $this->db->where('ai_price BETWEEN '.$price_from.' AND '.$price_to.'');
        //         }
        //     }
        //     if($limit){
        //         $this->db->limit($limit, $start);
        //     }
        //     $this->db->where('isactive = "1"');
        //     if($price_order == '0'){
        //         $this->db->order_by("price", "desc");
        //     }if($price_order == '1'){
        //         $this->db->order_by("price", "ASC");
        //     }else{
        //         $this->db->order_by("ispremium", "desc");
        //     }
        //     $data = $this->db->select('id, bull_no, bull_name, bull_id, dob, progini_test, sire_no, video, dam_no, lat_yield, daughter_yield, total_milk_fat, sires_breed, dams_breed, total_milk_proteen, avg_milk_proteen, rating, description, lact_no, bull_source, category, bread, seman_category, image, price, vt_ai_price, is_imported, is_certified, ispremium, company_charges, semen_type')->get('bull_table')->result_array();
        // }
        return $detail;
    }
    public function get_count_doc($type){
        $data = $this->db->select('count(doctor_id) as count')->where('users_type', $type)->get('doctor')->result_array();
        return $data;
    }
    public function get_bank(){
        $detail = $this->db->where('type = 8')->get('admin')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function seman_bank_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('bank_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->where('type = 8')->get('admin')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function ins_ref($data){
        if($this->db->insert('refral_table', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function ins_pic($data){
        if($this->db->insert('document_table', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function change_status_treat($id, $data){
        $update = $this->db->where('id', $id)->update('vt_request_tracking',$data);
		if($update)
			return TRUE;
		else
			return FALSE;
    }
	
	  public function get_doctor_info($id){
        $detail = $this->db->query("Select doctor_id,email,mobile_code,mobile,latitude,longitude,aadhar_no,fullname,officers_code,parent_id from doctor where doctor_id = '".$id."'")->row();
      if($detail)
		{
			 return $detail;
		}
		else{
			 return FALSE;
		}
    }
    public function insert_animals($data){
        if($this->db->insert('animals', $data)){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }
    public function inser_vt_request($data){
        if($this->db->insert('vt_requests', $data)){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }
    public function insert_animals_images($data){
        if($this->db->insert('animals_images', $data)){
            return True;
        }else{
            return false;
        }
    }
    public function insert_vaccinationsWithDate($data){
        if($this->db->insert('animal_vaccination', $data)){
            return True;
        }else{
            return false;
        }
    }
    public function get_user_detail($id){
        $query = $this->db->select('users_id,full_name as fullname, mobile, zone_id as state, email, latitude, longitude, image, address')->where('users_id', $id)->get('users')->result_array();
        return $query;
    }

    public function vt_req_det($doc_id = '', $type = '', $doc_date){
        $status = '';
        if(!isset($type) || $type != ''){
            $status = "status = '".$type."' AND ";
        }if($type == 2){
            $status = "status = '2' OR status = '3' OR status = '4' AND ";
        }
        $query = $this->db->query("SELECT vt.users_id,  vt.created_on, vt.animal_simtoms, vt.symptoms_image, vacc_id, vt.id, vt.status, vt.address, vt.latitude, vt.langitude, vt.animal_id, vt.treat_type FROM vt_requests as vt where vt.created_on >= '".$doc_date."' AND ".$status." vt.vt_id = '".$doc_id."'")->result_array();
        if($query)
		{
            foreach($query as $row){
                    if($row['animal_id'] != ''){
                        $ani_de = explode(',',$row['animal_id']);
                        $ani_de = count($ani_de);
                    }else{
                        $ani_de =0;
                    }                   
                    if($row['animal_simtoms'] == 'null'){
                        $row['animal_simtoms'] = '';
                    }else{
                        $row['animal_simtoms'] = isset($row['animal_simtoms'])? $row['animal_simtoms'] : '';
                    }
                    if($row['treat_type'] == 3){
                        $seman_data = $this->get_seman_detail($row['vacc_id']);
                        $animal_breed = $this->get_animal_breed($seman_data[0]['bread']);
                        $row['seman_bread_name'] = $animal_breed[0]['breed_name']; 
                        $animal_category = $this->get_animal_category($seman_data[0]['category']);
                        $row['seman_category'] = $animal_category[0]['category'];
                        $row['seman_price'] = $seman_data[0]['price'];
                        $row['vt_price'] = $seman_data[0]['vt_ai_price'];
                    }
                    $user = $this->get_user_detail($row['users_id']);
                    if($row['animal_simtoms'] != ''){
                        $animal_sym = $this->get_symtoms_animal($row['animal_simtoms']);
                        foreach($animal_sym as $a_s){
                            $b[] = $a_s['name'];
                        }
                        $row['animal_simtoms'] = $b;
                    }else{
                        $row['animal_simtoms'] = [];
                    }
                    $row['animal_count'] = $ani_de;
                    $row['user_name'] = $user[0]['fullname'];
                    $row['mobile'] = $user[0]['mobile'];
                    // $row['location'] = $user[0]['state'];
                    // $row['latitude'] = $user[0]['latitude'];
                    // $row['longitude'] = $user[0]['longitude'];
                    //$row['image'] = $user[0]['image'];
                    $row['image'] = base_url()."uploads/image/profile.jpg";
                    //$row["image"] = base_url().'uploads/animal/'.$defaultimage;
                    $detail[] =  $row;
            }
			return $detail;
		}
		else{
			 return FALSE;
		}
    }
    public function get_animal_breed($id){
        $data = $this->db->select('breed_name')->where('breed_id ='.$id)->get('breed')->result_array();
        return $data;
    }
    public function get_animal_category($id){
        $data = $this->db->select('category')->where('category_id ='.$id)->get('category')->result_array();
        return $data;
    }
    public function get_symtoms_animal($data){
        $data = $this->db->select('name')->where('id IN ('.$data.')')->get('coustomer_treatment_symtoms')->result_array();
        return $data;
    }
	 public function insert_vt_request($data){
        if($this->db->insert('vt_requests', $data)){
            return $this->db->insert_id();
        }else{
            return False;
        }
    }
    public function insert_vt_track_request($data){
        if($this->db->insert('vt_request_tracking', $data)){
            return $this->db->insert_id();
        }else{
            return False;
        }
    }
	public function user_animal_symtoms(){
        $data = $this->db->get('coustomer_treatment_symtoms')->result_array();
        return $data;
    }
	 public function animal_treatment_track($id){
		$query = $this->db->query("SELECT vt.*,s.fullname FROM vt_request_tracking as vt LEFT JOIN animals as s ON vt.animal_id = s.animal_id where vt.user_id = '".$id."' AND vt.treat_status <> '4' AND vt.status = '1' OR vt.status = '0'");
        $detail = '';
		foreach($query->result_array() as $row){
			$img = $this->get_animal_image($row['animal_id']);
			$image =  $img['0']['images'];
			$defaultimage = '1315099364.jpg';
			$row["image"] = base_url().'uploads/animal/'.$defaultimage;
					$detail[] =  $row;
				}
       if($detail)
		{
			 return $detail;
		}
		else{
			 return FALSE;
		}
    }

    public function get_requ_some($id){
        $detail = $this->db->where('id', $id)->get('vt_requests')->result_array();
        return $detail;
    }
	
	 public function get_prescription_report($animal_id){
        $detail = $this->db->query('Select dp.*,s.title,s.tag_no from doctor_prescription as dp LEFT JOIN animals as s ON dp.animal_id = s.animal_id where dp.animal_id = '.$animal_id.' and dp.pres_status = "1"')->row();
		if($detail)
		{
			 return $detail;
		}
		else{
			 return FALSE;
		}
    }
	
	 public function get_prec_test_report($prescription_id){
        $detail = $this->db->query('Select * from vet_req_prec_test_report where prescription_id = '.$prescription_id)->row();
		if($detail)
		{
			 return $detail;
		}
		else{
			 return FALSE;
		}
    }
	public function get_bank_issuer($admin_id){
        if($admin_id != ''){
            $this->db->where('super_admin_id ='.$admin_id.'');
        }
        $this->db->where('user_type = 5');
        if($data_s = $this->db->get('admin')->result_array()){
            return $data_s;
        }else{
            return false;
        }
       // $data_s = $this->db->query('select * from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
        
    }
	public function update_fcm($users_id,$data)
	{
		$update = $this->db->where('users_id', $users_id)->update('users',$data);
		if($update)
			return TRUE;
		else
			return FALSE;
    }
    public function get_admin_by_super_admin_id_type($admin_id, $user_type){
        $data = $this->db->query('select * from admin where user_type = '.$user_type.' AND super_admin_id ='.$admin_id.'')->result_array();
        return $data;
    }
    public function listing_authority($admin_id, $user_type, $search = ''){
        $where = '';
        if($search != ''){
            $where  = ' AND fname  like "%'.$search.'%"';
        }
        if($user_type == 5){
            $data = $this->db->query('select * from admin where user_type = '.$user_type.' AND super_admin_id ='.$admin_id.'')->result_array();
        }else if($user_type == 6){
            $da = $this->db->where('admin_id', $admin_id)->get('admin')->result_array();
            if($da[0]['user_type'] == 2 || $da[0]['user_type'] == 3 || $da[0]['user_type'] == 4){
                $data_s = $this->db->query('select * from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
                $bank_data = [];
                foreach($data_s as $d){
                    $dat = $this->db->query('select * from admin where user_type = 6 AND super_admin_id ='.$d['admin_id'].' '. $where.'')->result_array();
                    foreach($dat as $t){
                        $bank_data[] = $t;
                    }
                }
                $data = array_values($bank_data);
            }else{
                $data = $this->db->query('select * from admin where user_type = 6 AND super_admin_id ='.$admin_id.' '. $where.'')->result_array();
            }
        }else if($user_type == 7){
            $da = $this->db->where('admin_id', $admin_id)->get('admin')->result_array();
            if($da[0]['user_type'] == 2 || $da[0]['user_type'] == 3 || $da[0]['user_type'] == 4){
                $data_s = $this->db->query('select * from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
                $bank_data = [];
                foreach($data_s as $d){
                    $dat = $this->db->query('select * from admin where user_type = 6 AND super_admin_id ='.$d['admin_id'].'')->result_array();
                    $suplier_data = [];
                    foreach($dat as $du){
                        $sur_data = $this->db->query('select * from admin where user_type = 7 AND super_admin_id ='.$du['admin_id'].' '. $where.'')->result_array();
                        foreach($sur_data as $su){
                            $suplier_data = $su;
                        }
                    }
                    $data_sd[] = $suplier_data;
                }
                $data = array_values($data_sd);
            }else if($da[0]['user_type'] == 5 || $da[0]['user_type'] == 1){
                $suplier_data = $this->db->query('select * from admin where user_type = 6 AND super_admin_id ='.$admin_id.'')->result_array();
                $sur_data = [];
                $i = 0;
                foreach($suplier_data as $du){
                    $sui = $this->db->query('select * from admin where user_type = 7 AND super_admin_id ='.$du['admin_id'].' '. $where.'')->result_array();
                    if(!empty($sui)){
                        $sur_data[] = $sui[0];
                    }
                }
                $data = array_values($sur_data); 
            }else{
                $data = $this->db->query('select * from admin where user_type = 7 AND super_admin_id ='.$admin_id.'  '. $where.'')->result_array();
            }
        }else{
            $data = $this->db->where("admin_id = ".$admin_id."")->get('admin')->result_array();
        }
        // print_r($data);
        // exit;
        return $data;
    }
    public function get_semen_bull_count($source_id){
        $data = $this->db->query('select count(id) as count from bull_table where bull_source IN ('.$source_id.') AND isactive = "1"')->result_array();
        return $data;
    }
    public function get_semen_stoc_total($admin_id){
        $data = $this->db->query('select sum(rest_stock) as sum from seman_stock where admin_id IN ('.$admin_id.') AND isactive = "1"')->result_array();
        return $data;
    }
    public function get_semen_stock_listing($admin_id = '', $name = ''){
        if($admin_id ==''){
            $comp_1 = $this->db->query('select admin_id from admin where user_type = 2')->result_array();
            // print_r($comp_1);
            // exit;
            $detail = [];
            foreach($comp_1 as $com)
            {
                $admin_d = $this->get_admin_detail($com['admin_id']);
                $user_type = $admin_d[0]['user_type'];
                if($user_type == 2 || $user_type == 3 || $user_type == 4){
                    $bank_1 = $this->db->query('select admin_id from admin where user_type = 5 AND super_admin_id ='.$com['admin_id'].'')->result_array();
                    $ban = 0;
                    foreach($bank_1 as $ba){
                        if($i == 0){
                            $ban = $ba['admin_id'];
                        }else{
                            $ban .= ','.$ba['admin_id'];
                        }
                        $i++;
                    }
                    $data = $this->db->query('select * from seman_stock where admin_id IN ('.$ban.') AND rest_stock <> 0 AND isactive = "1" AND (bull_id LIKE "%'.$name.'%" OR id LIKE "%'.$name.'%") OR id LIKE "%'.$name.'%"')->result_array();
                }else{
                    $data = $this->db->query('select * from seman_stock where admin_id = '.$admin_id.' AND rest_stock <> 0 AND isactive = "1" AND (bull_id LIKE "%'.$name.'%" OR id LIKE "%'.$name.'%") OR id LIKE "%'.$name.'%"')->result_array();
                }
                $detail[] = $data;
            }
        }else{
            $admin_d = $this->get_admin_detail($admin_id);
            $user_type = $admin_d[0]['user_type'];
            if($user_type == 2 || $user_type == 3 || $user_type == 4){
                $bank_1 = $this->db->query('select admin_id from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
                // print_r($bank_1);
                // exit;
                $ban = 0;
                foreach($bank_1 as $ba){
                    if($i == 0){
                        $ban = $ba['admin_id'];
                    }else{
                        $ban .= ','.$ba['admin_id'];
                    }
                    $i++;
                }
                $data = $this->db->query('select * from seman_stock where admin_id IN ('.$ban.') AND rest_stock <> 0 AND isactive = "1" AND (bull_id LIKE "%'.$name.'%" OR id LIKE "%'.$name.'%")')->result_array();
            }else{
                $data = $this->db->query('select * from seman_stock where admin_id = '.$admin_id.' AND rest_stock <> 0 AND isactive = "1" AND (bull_id LIKE "%'.$name.'%" OR id LIKE "%'.$name.'%")')->result_array();
            }
            $detail = $data;
        }
        return $detail;
    }
    public function subscribe_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('email like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('product_subscribe')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function subscribe_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where email like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from product_subscribe'.$where.'')->result_array();
        return $data;
    }
    public function lab_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('lab_reg')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function lab_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from  lab_reg'.$where.'')->result_array();
        return $data;
    }
    public function lab_test_search($name = '', $start='', $perpage='', $id='', $user_id=''){
        $this->db->select("`lr.id as req_id`,`lr.emp_id`,`lr.users_id`,`lr.log_id`,`lr.no_of_sample`,`lr.farm_name`,`lr.name`,`lr.adress`,`lr.district`,`lr.state`,`lr.city`,`lr.pin`,`lr.location`,`lr.latitude as lat`,`lr.langitude as lang`,`lr.phone`,`lr.email`,`lr.ispaid`,`lr.order_date`,`lf.request_status`");
        if(isset($name)){
            $this->db->where('lr.name like "%'.$name.'%"');
        }
        if($user_id !='')
            $this->db->where('lr.emp_id',$user_id);
        if($start != '')
            $this->db->limit($perpage, $start);
        if($id != '')
            $this->db->where('lr.id', $id);
        $this->db->order_by('lr.id', 'DESC');
        $this->db->from('lab_request as lr');
        $this->db->join('log_file as lf','lf.id = lr.log_id');
        $detail = $this->db->get()->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function lab_test_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from lab_request'.$where.'')->result_array();
        return $data;
    }
    public function get_admin_status($status = ''){
        if($status != ''){
            $this->db->where('type', $status);
        }
        return $this->db->get('admin')->result_array();
    }
    public function unit_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('unit')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function unit_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from unit'.$where.'')->result_array();
        return $data;
    }
    public function unit_status($id , $data){
        if($this->db->where('id = '.$id.'')->order_by("id", "DESC")->update('unit', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function order_status($id , $data){
        if($this->db->where('id = '.$id.'')->update('product_order', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function package_search($name = '', $start, $perpage){
        $where = '';
        if(isset($name)){
            $where = 'AND pro.name like "%'.$name.'%"';
        }
        //$this->db->limit($perpage, $start);
        $detail = $this->db->query('select pro.id, pro.name, pro.quantity, u.name as unit, pro.isactive from product_package as pro, unit as u where pro.unit_id = u.id '.$where.' limit '.$start.', '.$perpage.'')->result_array();
       // $detail = $this->db->get('product_packageas')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function get_packages_unit_id($unit_id){
        $data = $this->db->where('unit_id', $unit_id)->get('product_package')->result_array();
        return $data;
    }
    public function package_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from product_package '.$where.'')->result_array();
        return $data;
    }
    public function package_status($id , $data){
        if($this->db->where('id = '.$id.'')->order_by("id", "DESC")->update('product_package', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function colour_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        $detail = $this->db->get('colour')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    public function colour_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(id) as count from colour'.$where.'')->result_array();
        return $data;
    }
    public function colour_status($id , $data){
        if($this->db->where('id = '.$id.'')->update('colour', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function ins_colour_name($data){
        if($this->db->insert('colour', $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
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
    public function section_status($id , $data){
        if($this->db->where('id = '.$id.'')->update('product_section', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_section(){
        $data = $this->db->get('product_section')->result_array();
        return $data;
    }
    public function ins_section_name($data){
        if($this->db->insert('product_section', $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function product_cat_id($id){
        $data = $this->db->where('isactive = "1" AND super_cat_id = "'.$id.'"')->get('product_category')->result_array();
        return $data;
    }
    public function get_color(){
        $data = $this->db->where('isactive = "1"')->get('colour')->result_array();
        return $data;
    }
    public function get_category_main($id = ''){
        $where = '';
        if($id != ''){
            $where = ' FIND_IN_SET('.$id.',section) AND ';
        }
        $data = $this->db->where(''.$where.'isactive = "1" AND super_cat_id = "0"')->get('product_category')->result_array();
        return $data;
    }
    public function get_package(){
        $data = $this->db->get('product_package')->result_array();
        return $data;
    }
    public function get_product_last_id(){
        $row = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("product")->row();
        return $row->id; 
    }
    public function get_productname(){
        $data = $this->db->select('id, name')->get('product_name')->result_array();
        return $data;
    }
    public function product_count($name = ''){
        if(isset($name)){
            $this->db->where('cat_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        if($_SESSION['status'] == '1'){
            
            $detail = $this->db->query('select count(*) as count from product as pro, product_category as pc where pro.category = pc.id AND pro.name like "%'.$name.'%"')->result_array();
        }else{
            $detail = $this->db->query('select count(*) as count from product as pro, product_category as pc where pro.category = pc.id AND pro.user="'.$_SESSION['user_id'].'" AND pro.name like "%'.$name.'%"')->result_array();
        }
        //$detail = $this->db->get('product')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
        // $where = '';
        // if($name != ''){
        //     if($_SESSION['status'] == '1'){
        //         $where = ' where name like "%'.$name.'%"';
        //     }else{
        //         $where = ' AND name like "%'.$name.'%"';
        //     }
        // }
        // if($_SESSION['status'] == '1'){
        //     $data = $this->db->query('Select count(*) as count from product'.$where.'')->result_array();
        // }else{
        //     $data = $this->db->query('Select count(*) as count from product where user="'.$_SESSION['user_id'].'" '.$where.' AND isactive = "1"')->result_array();
        // }
        return $detail;
    }
    public function product_search($name = '', $start, $perpage){
        if(isset($name)){
            $this->db->where('cat_name like "%'.$name.'%"');
        }
        $this->db->limit($perpage, $start);
        if($_SESSION['status'] == '1'){
            
            $detail = $this->db->query('select pro.id, pro.name, pro.brand, pc.cat_name as product_cat, pro.images, pro.shor_desc,  pro.hight, pro.width, pro.sku, pro.isactive from product as pro, product_category as pc where pro.category = pc.id AND pro.name like "%'.$name.'%" LIMIT '.$perpage.' OFFSET '.$start.'')->result_array();
        }else{
            $detail = $this->db->query('select pro.id, pro.name, pro.brand, pc.cat_name as product_cat, pro.images, pro.shor_desc,  pro.hight, pro.width, pro.sku, pro.isactive from product as pro, product_category as pc where pro.category = pc.id AND pro.user="'.$_SESSION['user_id'].'" AND pro.name like "%'.$name.'%" LIMIT '.$perpage.' OFFSET '.$start.'')->result_array();
        }
        //$detail = $this->db->get('product')->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }
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
    public function delivery_partner($search){
        $data = $this->db->query('select fname, mobile, email, address, admin_id, image, user_type from admin where (user_type = "9" AND fname like "%'.$search.'%") OR (user_type = "9" AND mobile like "%'.$search.'%") OR (user_type = "9" AND admin_id = "'.$search.'")')->result_array();
        return $data;
    }
    public function ins_unit($data){
        if($this->db->insert('unit', $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function ins_package($data){
        if($this->db->insert('product_package', $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function get_unit(){
        $data = $this->db->select('id, name')->get('unit')->result_array();
        return $data;
    }
    public function product_category_count($name = ''){
        $where = '';
        if($name != ''){
            $where = ' where name like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(id) as count from product_category'.$where.'')->result_array();
        return $data;
    }
    public function product_category_status($id , $data){
        if($this->db->where('id = '.$id.'')->update('product_category', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_product_cat(){
        $data = $this->db->get('product_category')->result_array();
        return $data; 
    }
    public function ins_product_category_name($data){
        if($this->db->insert('product_category', $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function athority_count($admin_id, $user_type){
        if($user_type == 2 || $user_type == 3 || $user_type == 4){
            $bank = $this->db->query('select count(*) as count from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
            $data['bank_count'] = $bank[0]['count'];
            $distributer = $this->db->query('select count(*) as count from admin where user_type = 6 AND super_admin_id IN (select admin_id from admin where user_type = 5 AND super_admin_id ='.$admin_id.')')->result_array();
            $data['distributer_count'] = $distributer[0]['count'];
            $supplier = $this->db->query('select count(*) as count from admin where user_type = 7 AND super_admin_id IN (select admin_id from admin where user_type = 6 AND super_admin_id IN (select admin_id from admin where user_type = 5 AND super_admin_id ='.$admin_id.'))')->result_array();
            $data['supplier_count'] = $supplier[0]['count'];
            $i = 0 ;
            $bank_1 = $this->db->query('select admin_id from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
            //print_r($bank_1);
            $ban = 0;
            foreach($bank_1 as $ba){
                if($i == 0){
                    $ban = $ba['admin_id'];
                }else{
                    $ban .= ','.$ba['admin_id'];
                }
                $i++;
            }
            $count_data = $this->get_semen_bull_count($ban);
            $data['bull_count'] = $count_data[0]['count'];
            $sum_total = $this->get_semen_stoc_total($ban);
            $data['stock_count'] = $sum_total[0]['sum'];
            //$data['bank_count'] = $this->db->query('select count(*) as count from admin where user_type = '.$user_type.' AND super_admin_id ='.$admin_id.'')->result_array();
        }else if($user_type == 1 || $user_type == 5){
            $data['bank_count'] = '0';
            $distributer = $this->db->query('select count(*) as count from admin where user_type = 6 AND super_admin_id = '.$admin_id.'')->result_array();
            $data['distributer_count'] = $distributer[0]['count'];
            $supplier = $this->db->query('select count(*) as count from admin where user_type = 7 AND super_admin_id IN (select admin_id from admin where user_type = 6 AND super_admin_id = '.$admin_id.')')->result_array();
            $data['supplier_count'] = $supplier[0]['count'];
            $count_data = $this->get_semen_bull_count($admin_id);
            $data['bull_count'] = $count_data[0]['count'];
            $sum_total = $this->get_semen_stoc_total($admin_id);
            $data['stock_count'] = $sum_total[0]['sum'];
        }else if($user_type == 6){
            $data['bank_count'] = '0';
            $data['distributer_count'] = '0';
            $supplier = $this->db->query('select count(*) as count from admin where user_type = 7 AND super_admin_id ='.$admin_id.'')->result_array();
            $data['supplier_count'] = $supplier[0]['count'];
            $data['bull_count'] = '0';
            $sum_total = $this->get_semen_stoc_total($admin_id);
            $data['stock_count'] = $sum_total[0]['sum'];
        }else{
            $data['bank_count'] = '0';
            $data['distributer_count'] = '0';
            //$supplier = $this->db->query('select count(*) as count from admin where user_type = 7 AND super_admin_id ='.$admin_id.'')->result_array();
            $data['supplier_count'] = '0';
            $data['bull_count'] = '0';
            $sum_total = $this->get_semen_stoc_total($admin_id);
            $data['stock_count'] = $sum_total[0]['sum'];
        }
        return $data;
    }
    // public function athority_count($admin_id, $user_type){
    //     if($user_type == 2 || $user_type == 3 || $user_type == 4){
    //         $bank = $this->db->query('select count(*) as count from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
    //         $data['bank_count'] = $bank[0]['count'];
    //         $distributer = $this->db->query('select count(*) as count from admin where user_type = 6 AND super_admin_id IN (select admin_id from admin where user_type = 5 AND super_admin_id ='.$admin_id.')')->result_array();
    //         $data['distributer_count'] = $distributer[0]['count'];
    //         $supplier = $this->db->query('select count(*) as count from admin where user_type = 7 AND super_admin_id IN (select admin_id from admin where user_type = 6 AND super_admin_id IN (select admin_id from admin where user_type = 5 AND super_admin_id ='.$admin_id.'))')->result_array();
    //         $data['supplier_count'] = $supplier[0]['count'];
    //         $i = 0 ;
    //         $bank_1 = $this->db->query('select admin_id from admin where user_type = 5 AND super_admin_id ='.$admin_id.'')->result_array();
    //         //print_r($bank_1);
    //         $ban = 0;
    //         foreach($bank_1 as $ba){
    //             if($i == 0){
    //                 $ban = $ba['admin_id'];
    //             }else{
    //                 $ban .= ','.$ba['admin_id'];
    //             }
    //             $i++;
    //         }
    //         $count_data = $this->get_semen_bull_count($ban);
    //         $data['bull_count'] = $count_data[0]['count'];
    //         $sum_total = $this->get_semen_stoc_total($ban);
    //         $data['stock_count'] = $sum_total[0]['sum'];
    //         //$data['bank_count'] = $this->db->query('select count(*) as count from admin where user_type = '.$user_type.' AND super_admin_id ='.$admin_id.'')->result_array();
    //     }else if($user_type == 1 || $user_type == 5){
    //         $data['bank_count'] = '0';
    //         $distributer = $this->db->query('select count(*) as count from admin where user_type = 6 AND super_admin_id = '.$admin_id.'')->result_array();
    //         $data['distributer_count'] = $distributer[0]['count'];
    //         $supplier = $this->db->query('select count(*) as count from admin where user_type = 7 AND super_admin_id IN (select admin_id from admin where user_type = 6 AND super_admin_id = '.$admin_id.')')->result_array();
    //         $data['supplier_count'] = $supplier[0]['count'];
    //         $count_data = $this->get_semen_bull_count($admin_id);
    //         $data['bull_count'] = $count_data[0]['count'];
    //         $sum_total = $this->get_semen_stoc_total($admin_id);
    //         $data['stock_count'] = $sum_total[0]['sum'];
    //     }else if($user_type == 6){
    //         $data['bank_count'] = '0';
    //         $data['distributer_count'] = '0';
    //         $supplier = $this->db->query('select count(*) as count from admin where user_type = 7 AND super_admin_id ='.$admin_id.'')->result_array();
    //         $data['supplier_count'] = $supplier[0]['count'];
    //         $data['bull_count'] = '0';
    //         $sum_total = $this->get_semen_stoc_total($admin_id);
    //         $data['stock_count'] = $sum_total[0]['sum'];
    //     }else{
    //         $data['bank_count'] = '0';
    //         $data['distributer_count'] = '0';
    //         //$supplier = $this->db->query('select count(*) as count from admin where user_type = 7 AND super_admin_id ='.$admin_id.'')->result_array();
    //         $data['supplier_count'] = '0';
    //         $data['bull_count'] = '0';
    //         $sum_total = $this->get_semen_stoc_total($admin_id);
    //         $data['stock_count'] = $sum_total[0]['sum'];
    //     }
    //     return $data;
    // }
    public function update_comp_fcm($users_id, $data)
	{
		$update = $this->db->where('admin_id', $users_id)->update('admin',$data);
		if($update)
			return TRUE;
		else
			return FALSE;
    }
    public function update_para_fcm($users_id,$data)
	{
		$update = $this->db->where('doctor_id', $users_id)->update('doctor',$data);
		if($update)
			return TRUE;
		else
			return FALSE;
    }
    public function cheak_doc_loc($id){
        $de =  $this->db->where('doctor_id', $id)->get('current_loc')->result_array();
        return $de;
    }
    public function insert_doc_loc($data){
        $de =  $this->db->insert('current_loc', $data);
        return $de;
    }
    public function update_doc_loc($id, $data){
        $de =  $this->db->where('doctor_id', $id)->update('current_loc', $data);
        return $de;
    }
    public function cheak_doc_service_loc($id){
        $de =  $this->db->where('doctor_id', $id)->get('doc_service_loc')->result_array();
        return $de;
    }
    public function insert_doc_service_loc($data){
        $de =  $this->db->insert('doc_service_loc', $data);
        exit;
        return $de;
    }
    public function update_doc_service_loc($id, $data){
        $de =  $this->db->where('doctor_id', $id)->update('doc_service_loc', $data);
        return $de;
    }
    public function get_doc_id($id){
        $de = $this->db->select('parent_id')->where('doctor_id', $id)->get('doctor')->result_array();
        return $de;
    }
    public function insert_prescription($data){
        if($this->db->insert('treatment_req', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function change_animal_status($id, $data){
        $detail = $this->db->where('animal_id', $id)->update('animals', $data);
        if($detail){
            return true;
        }else{
            return false;
        }
    }
    public function get_subrequest_animal_id($id){
        $detail = $this->db->where('animal_id', $id)->get('vt_request_tracking')->result_array();
        return $detail;
    }
    public function get_fcm_doc($id){
        $de = $this->db->select('fcm_android', 'fcm_ios')->where('doctor_id', $id)->get('doctor')->result_array();
        return $de;
    }
    public function get_fcm_user($id){
        $de = $this->db->where('users_id', $id)->get('users')->result_array();
        return $de;
    }
    public function check_pre($request_id, $animal_id, $users_id, $id, $vt_id){
        $de = $this->db->where('request_id = "'.$request_id.'" and animal_id = "'.$animal_id.'" AND users_id = "'.$users_id.'" AND map_id = "'.$id.'" AND vt_id = "'.$vt_id.'" AND status = "1"')->get('treatment_req')->result_array();
        return $de;
    }
    public function request_supertest_ins($id, $data){
        $de = $this->db->where('id', $id)->update('treatment_req', $data);
        return $de;
    }
    public function get_test_det($id, $req_id){
        $de = $this->db->where('id IN ('.$id.')')->get('lab_test')->result_array();
        //$de = $this->db->query('select * from lab_test as lt request_test as rt where lt.id IN ('.$id.') AND lt.id = rt.test_id AND sub_request_id ='.$req_id.'')->result_array();
        return $de;
    }
    public function get_test_pic($test_id, $req_id){
        $de = $this->db->where('test_id ='.$test_id.' AND sub_request_id = '.$req_id.'')->get('request_test')->result_array();
        return $de;
    }
    public function get_pils_det($id){
        $de = $this->db->where('id IN ('.$id.')')->get('pharmeshi')->result_array();
        return $de;
    }
    public function get_vacc_det($id){
        $de = $this->db->where('vaccination_id IN ('.$id.')')->get('vaccination_govt')->result_array();
        return $de;
    }
    public function get_employee_detial_id($id){
        $detail = $this->db->where('doc_id',$id)->get('doctor_dump')->result_array();
        return $detail;
    }
    public function get_tehshil_total(){
        $data = $this->db->get('tehshil')->result_array();
        return $data;
    }
    public function get_all_gvh(){
        $data = $this->db->get('gvh_table')->result_array();
        return $data;
    }
    public function get_all_gvd(){
        $data = $this->db->get('gvd_table')->result_array();
        return $data;
    }
    public function get_all_village(){
        $data = $this->db->get('village')->result_array();
        return $data;
    }
    public function get_pregnancy($id ,$type){
        $where = '';
        if($type != 3){
            $where .= " vt.pregnancy_status ='1' AND";
        }
        $de = $this->db->query("select vt.vt_id, vt.id, vt.pregnancy_status, vr.date, d.username as vt_name from vt_request_tracking as vt, vt_requests as vr, doctor as d where ".$where." d.doctor_id = vt.vt_id AND vt.request_id = vr.id AND  vt.animal_id = '".$id."' AND vt.treat_type = '".$type."'")->result_array();
        return $de;
    }
    public function ai_bull_detail_id($id){
        $data = $this->db->where('id', $id)->get('bull_table')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_bull_detail_ai($subid){
        $de = $this->db->query('select bt.id, bt.bull_no from ai_record as ai, bull_table as bt where ai.sub_request_id = '.$subid.' AND bt.id = ai.bull_id')->result_array();
        if($de){
            return $de;
        }
        else{
            return false;
        }
    }
    public function get_simtoms_det($id){
        $de = $this->db->where('id IN ('.$id.')')->get('simtoms')->result_array();
        return $de;
    }
    public function get_total_simtoms(){
        $de = $this->db->get('simtoms')->result_array();
        return $de;
    }
    public function get_doc_langitued($doc_id){
        $de = $this->db->where('doctor_id', $doc_id)->get('current_loc')->result_array();
        return $de;
    }
    public function vt_req_det_lanitude($doc_id, $type, $lati, $long){
        $status = '';
        if($type == 0){
            $status = "vt_id = '0' AND status = '".$type."' ";
        }
        if($type == 2){
            $status = "vt_id ='".$doc_id."' AND status = '4'";
        }
        if($type == 1){
            $status = "vt_id ='".$doc_id."' AND status = '".$type."' ";
        }
        $query = $this->db->query("SELECT users_id, created_on, vt_id, animal_simtoms, symptoms_image, id, vacc_id, treat_type, status, address, latitude, langitude, animal_id, treat_type, IFNULL(( 3959 * acos( cos( radians('$lati') ) * cos( radians( latitude ) ) * cos( radians( langitude ) - radians ('$long') ) + sin( radians('$lati') ) * sin( radians( latitude ) ) ) ),0) AS distance FROM vt_requests where ".$status." having distance <= '".RADIOUS_DIST."' order by distance")->result_array();
        if($query)
		{
            foreach($query as $row){
                    $ani_de = explode(',',$row['animal_id']);
                    $ani_de = count($ani_de);
                    if($row['animal_simtoms'] == 'null'){
                        $row['animal_simtoms'] = '';
                    }else{
                        $row['animal_simtoms'] = isset($row['animal_simtoms'])? $row['animal_simtoms'] : '';
                    }
                    $user = $this->get_user_detail($row['users_id']);
                    // print_r($user);
                    // exit;
                    if($row['treat_type'] == 3){
                        $seman_data = $this->get_seman_detail($row['vacc_id']);
                        $animal_breed = $this->get_animal_breed($seman_data[0]['bread']);
                        $row['seman_bread_name'] = $animal_breed[0]['breed_name']; 
                        $animal_category = $this->get_animal_category($seman_data[0]['category']);
                        $row['seman_category'] = $animal_category[0]['category'];
                        $row['seman_price'] = $seman_data[0]['price'];
                        $row['vt_price'] = $seman_data[0]['vt_ai_price'];
                    }
                    // $animal_breed = $this->get_animal_breed($row['breed_id']);
                    // $row['animal_breed'] = $animal_breed[0]['breed_name']; 
                    // $animal_category = $this->get_animal_category($row['category_id']);
                    // $row['animal_category'] = $animal_category[0]['category'];
                    if($row['animal_simtoms'] != ''){
                        $animal_sym = $this->get_symtoms_animal($row['animal_simtoms']);
                        foreach($animal_sym as $a_s){
                            $b[] = $a_s['name'];
                        }
                        $row['animal_simtoms'] = $b;
                    }else{
                        $row['animal_simtoms'] = [];
                    }
                    $row['animal_count'] = $ani_de;
                    $row['user_name'] = $user[0]['fullname'];
                    $row['mobile'] = $user[0]['mobile'];
                    $row['image'] = base_url()."uploads/image/".$user[0]['image'];;
                    $detail[] =  $row;
            }
			return $detail;
		}
		else{
			 return FALSE;
		}
        //$de = $this->db->query("select du.doctor_id, du.username, du.mobile, du.image, IFNULL(( 3959 * acos( cos( radians('$lati') ) * cos( radians( langitute ) ) * cos( radians( lantitute ) - radians ('$long') ) + sin( radians('$lati') ) * sin( radians( langitute ) ) ) ),0) AS distance from current_loc as cu, doctor as du where cu.doctor_id = du.doctor_id AND du.users_type IN ('pvt_vt', 'pvt_ai') having distance <= '".RADIOUS_DIST."' order by distance")->result_array();
        //return $de;
    }
    public function get_vt_by_latlong($lati, $long){
        $de = $this->db->query("select doctor.doctor_id, doctor.username, doctor.mobile, doctor.image, IFNULL(( 3959 * acos( cos( radians('$lati') ) * cos( radians( doctor.latitude ) ) * cos( radians( doctor.longitude ) - radians ('$long') ) + sin( radians('$lati') ) * sin( radians( doctor.latitude ) ) ) ),0) AS distance from doctor where doctor.users_type='vt' and doctor.service_availability='1' and doctor.status='1' having distance <= '".RADIOUS_DIST."' order by distance")->result_array();
        return $de;
    }
    public function get_vt_by_latitude_pvt($lati, $long){
        $de = $this->db->query("select du.doctor_id, du.username, du.mobile, du.image, IFNULL(( 3959 * acos( cos( radians('$lati') ) * cos( radians( langitute ) ) * cos( radians( lantitute ) - radians ('$long') ) + sin( radians('$lati') ) * sin( radians( langitute ) ) ) ),0) AS distance from current_loc as cu, doctor as du where cu.doctor_id = du.doctor_id AND du.users_type IN ('pvt_vt', 'pvt_ai') having distance <= '".RADIOUS_DIST."' order by distance")->result_array();
        return $de;
    }
    public function get_vt($doctor_id){
        $de = $this->db->select('doctor_id')->where('parent_id', $doctor_id)->get('doctor')->result_array();
        return $de;
    }
    public function get_vt_detail($id){
        $de = $this->db->select('username as vt_name, mobile as vt_mobile')->get('doctor')->result_array();
        return $de;
    }
    public function get_user_new_ad($id){
        $de = $this->db->select('address,  latitude, langitude, date')->where('id', $id)->get('vt_requests')->result_array();
        return $de;
    }
    public function get_doc_req_det($doc_id = '', $type = ''){
        $status = '';
        if(!isset($type) || $type != ''){
            $status = "status = '".$type."' AND ";
        }if($type == 2){
            $status = "status = '2' OR status = '3' OR status = '4' AND ";
        }
        $query = $this->db->query("SELECT vt.users_id, vt.vt_id,  vt.created_on, vt.id, vt.status, vt.address, vt.latitude, vt.langitude, vt.animal_id, vt.treat_type FROM vt_requests as vt where ".$status." vt.vt_id  IN (".$doc_id.")")->result_array();
        if($query)
		{
            foreach($query as $row){
                    $ani_de = explode(',',$row['animal_id']);
                    $ani_de = count($ani_de);
                    $user = $this->get_user_detail($row['users_id']);
                    $vt = $this->get_vt_detail($row['vt_id']);
                    // $img = $this->get_animal_image($row['animal_id']);
                    // $image =  $img['0']['images'];
                    // $defaultimage = '1315099364.jpg';
                    $row['animal_count'] = $ani_de;
                    $row['user_name'] = $user[0]['fullname'];
                    $row['mobile'] = $user[0]['mobile'];
                    $row['vt_name'] = $vt[0]['vt_name'];
                    $row['vt_mobile'] = $vt[0]['vt_mobile'];
                    // $row['location'] = $user[0]['state'];
                    // $row['latitude'] = $user[0]['latitude'];
                    // $row['longitude'] = $user[0]['longitude'];
                    //$row['image'] = $user[0]['image'];
                    $row['image'] = base_url()."uploads/image/profile.jpg";
                    //$row["image"] = base_url().'uploads/animal/'.$defaultimage;
                    $detail[] =  $row;
            }
			return $detail;
		}
		else{
			 return FALSE;
		}
    }
    public function doc_detail_id($doc_id){
        $data = $this->db->where('doctor_id', $doc_id)->get('doctor')->result_array();
        return $data;
    }
    public function get_doc_treat_det($doc_id){
        $query = $this->db->query("SELECT vt.users_id, vt.vt_id, vt.map_id as sub_request_id, vt.id, vt.request_id, vt.symptoms_image, vt.suggetions as simptom_text, vt.simtoms, vt.animal_id FROM treatment_req as vt where status='0' AND vt.doc_id  IN (".$doc_id.")")->result_array();
        if($query)
		{
            foreach($query as $row){
                    $ani_de = explode(',',$row['animal_id']);
                    $ani_de = count($ani_de);
                    $user = $this->get_user_detail($row['users_id']);
                    $vt = $this->get_vt_detail($row['vt_id']);
                    $animal_det = $this->get_animal_ani_id($row['animal_id']);
                    $img = $this->get_animal_image($row['animal_id']);
                    $user_cu_ad = $this->get_user_new_ad($row['request_id']);
                    $user_simptoms = $this->get_simtoms_det($row['simtoms']);
                    $animal_data = $this->get_animal_ani_id($row['animal_id']);
                    $animal_breed = $this->get_animal_breed($animal_data[0]['breed_id']);
                    $row['animal_breed'] = $animal_breed[0]['breed_name']; 
                    $animal_category = $this->get_animal_category($animal_data[0]['category_id']);
                    $row['animal_category'] = $animal_category[0]['category'];
                    $row['animal_age'] = $animal_data[0]['age'];
				    $row['animal_age_month'] = $animal_data[0]['age_month']; 
                    $i=0;
                    foreach($user_simptoms as $tre){
                        if($i==0){
                            $tre_name = $tre['name'];
                        }else{
                            $tre_name .= ','.$tre['name'];
                        }
                        $i++;
                    }
                    $row['simtoms'] = $tre_name;
                    $image =  $img['0']['images'];
                    $defaultimage = '1315099364.jpg';
                    $row['animal_count'] = $ani_de;
                    $row['user_name'] = $user[0]['fullname'];
                    $row['mobile'] = $user[0]['mobile'];
                    $row['vt_name'] = $vt[0]['vt_name'];
                    $row['vt_mobile'] = $vt[0]['vt_mobile'];
                    $row['animal_name'] = $animal_det[0]['title'];
                    $row['animal_gender'] = $animal_det[0]['gender'];
                    $row['address'] = isset($user_cu_ad[0]['address']) ? $user_cu_ad[0]['address'] : '';
                    $row['latitude'] = isset($user_cu_ad[0]['latitude']) ? $user_cu_ad[0]['latitude'] : '';
                    $row['langitude'] = isset($user_cu_ad[0]['langitude']) ? $user_cu_ad[0]['langitude'] : '';
                    $row['date'] = isset($user_cu_ad[0]['date']) ? $user_cu_ad[0]['date'] : '';
                    // $row['location'] = $user[0]['state'];
                    // $row['latitude'] = $user[0]['latitude'];
                    // $row['longitude'] = $user[0]['longitude'];
                    //$row['image'] = $user[0]['image'];
                    if($row["symptoms_image"]==''){
                        $row["symptoms_image"] = '' ;
                    }else{
                        $row["symptoms_image"] = base_url().'uploads/symtoms/'.$row["symptoms_image"];
                    }
                    $row['image'] = base_url()."uploads/image/profile.jpg";
                    $row["animal_image"] = base_url().'uploads/animal/'.$defaultimage;
                    //$row['animal_detail'] = $animal_det;
                    $detail[] =  $row;
            }
			return $detail;
		}
		else{
			 return FALSE;
		}
    }
    public function get_pharmacy(){
        $de = $this->db->where('isactive = "1"')->order_by("type", "asc")->get('pharmeshi')->result_array();
        return $de;
    }
    public function get_lab_test(){
        $de = $this->db->select('id, name, type')->where('isactive = "1"')->get('lab_test')->result_array();
        return $de;
    }
    public function update_treat_data($treat_id, $data){
        $de = $this->db->where('id', $treat_id)->update('treatment_req', $data);
        if($de){
            return true;
        }else{
            return false;
        }
    }
    public function get_treet_id($id){
        $de = $this->db->where('id',$id)->get('treatment_req')->result_array();
        return $de;
    }

    //New function added for doc_premiumlist
    public function get_doc_premiumlist_detail($is_premium, $is_paid, $langituit, $latituit, $specy_id_where){
        
        $where = 'AND do.users_type = "pvt_doc"  AND do.is_premium = "'.$is_premium.'" AND do.is_paid = "'.$is_paid.'"';
        $data = $this->db->query("SELECT cl.doctor_id,do.is_premium,do.is_paid, do.username, do.total_experience, do.city, do.ai_visiting_fee, do.image, dq.doc_id, dq.speci_id, IFNULL(( 3959 * acos( cos( radians('$latituit') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('$langituit') ) + sin( radians('$latituit') ) * sin( radians( cl.lantitute ) ) ) ),0) AS distance FROM current_loc as cl, doctor as do, doc_qualification as dq where do.doctor_id = cl.doctor_id AND do.doctor_id = dq.doc_id ".$where." having distance <= '".RADIOUS_DIST."' order by distance")->result_array();
        
        $detail = [];
        foreach($data as $da){
            if($da['speci_id']) {
                if($specy_id_where == 'Any') {
                    $speciFiceId = json_decode($da['speci_id']);
                    $specialisationDetails = [];
                    $indexValue = 0;
                    foreach ($speciFiceId as $value) {
                        $specialisation =  $this->db->query("select sp.speci_name, sp.speci_id, sp.quali_id from specialisation as sp  where sp.speci_id = ".$value."")->result_array();
                        $specialisationDetails[$indexValue] = $specialisation[0];
                        $indexValue = $indexValue + 1;
                    }
                } else {
                    $specy_id_where1 = explode(",", $specy_id_where);
                    $speciFiceId1 = json_decode($da['speci_id']);
                    $specialisationDetails = [];
                    $indexValue1 = 0;
                    foreach ($speciFiceId1 as $value) {
                        foreach ($specy_id_where1 as $specy_id) {
                            if($specy_id == $value) {
                                $specialisation1 =  $this->db->query("select sp.speci_name, sp.speci_id, sp.quali_id from specialisation as sp  where sp.speci_id = ".$value."")->result_array();
                                $specialisationDetails[$indexValue1] = $specialisation1[0];
                                $indexValue1 = $indexValue1 + 1;
                            }
                        }
                    }
                }
                if(!empty($specialisationDetails)) {
                    $da['speci_details'] = $specialisationDetails;
                    $detail[] = $da;
                }
            }
           
        }
        if($data)
        {
            return $detail;
        }
        else
        {
            return FALSE;
        }
        return $data;
    }

    public function count_doc_premiumlist($type , $distance = 0, $latitu = '', $langitude = '', $state = '', $speci_id = '', $start,
            $is_premium,
            $is_paid,$specy_id_where){
            $where = 'do.users_type = "pvt_doc" AND do.is_premium = "'.$is_premium.'" AND do.is_paid = "'.$is_paid.'"';
            $select = '';
            if($state != ''){
                $where .= ' AND doc.state_code = "'.$state.'"';
            }
            $data = $this->db->query('select cl.doctor_id, do.users_type, do.is_premium,do.is_paid, do.username, do.total_experience, do.city, do.ai_visiting_fee, do.image, dq.doc_id, dq.speci_id, IFNULL(( 3959 * acos( cos( radians('.$latitu.') ) * cos( radians( cl.lantitute ) ) * cos( radians( cl.langitute ) - radians ('.$langitude.') ) + sin( radians('.$latitu.') ) * sin( radians( cl.lantitute ) ) ) ),0) AS distance from current_loc as cl, doctor as do, doc_qualification as dq where do.doctor_id = cl.doctor_id AND do.doctor_id = dq.doc_id AND '. $where.' having distance <= '.RADIOUS_DIST.' order by distance')->result_array();
        
            $detail = [];
            foreach($data as $da){
                if($da['speci_id']) {
                    if($specy_id_where == 'Any') {
                        $speciFiceId = json_decode($da['speci_id']);
                        $specialisationDetails = [];
                        $indexValue = 0;
                        foreach ($speciFiceId as $value) {
                            $specialisation =  $this->db->query("select sp.speci_name, sp.speci_id, sp.quali_id from specialisation as sp  where sp.speci_id = ".$value."")->result_array();
                            $specialisationDetails[$indexValue] = $specialisation[0];
                            $indexValue = $indexValue + 1;
                        }
                    } else {
                        $specy_id_where1 = explode(",", $specy_id_where);
                        $speciFiceId1 = json_decode($da['speci_id']);
                        $specialisationDetails = [];
                        $indexValue1 = 0;
                        foreach ($speciFiceId1 as $value) {
                            foreach ($specy_id_where1 as $specy_id) {
                                if($specy_id == $value) {
                                    $specialisation1 =  $this->db->query("select sp.speci_name, sp.speci_id, sp.quali_id from specialisation as sp  where sp.speci_id = ".$value."")->result_array();
                                    $specialisationDetails[$indexValue1] = $specialisation1[0];
                                    $indexValue1 = $indexValue1 + 1;
                                }
                            }
                        }
                    }
                    if(!empty($specialisationDetails)) {
                        $da['speci_details'] = $specialisationDetails;
                        $detail[] = $da;
                    }
                }
               
            }
        return count($detail);
       /* $where = ' users_type = "pvt_doc"  AND is_premium = "'.$is_premium.'" AND is_paid ="'.$is_paid.'"';
        $select = '';
        if($state != ''){
            $where .= ' AND doc.state_code = "'.$state.'"';
        }
        if($speci_id != ''){
            $where .= ''.$speci_id.' IN (qualification )';
        }
        if($distance != 0){
            $select = ", IFNULL(( 3959 * acos( cos( radians('$latitu') ) * cos( radians( dp.latitude ) ) * cos( radians( dp.langitude ) - radians ('$langitude') ) + sin( radians('$latitu') ) * sin( radians( dp.latitude ) ) ) ),0) AS distance";
            $where .= "having distance <= '$distance'  order by distance";
        }
        if($where != ''){
            $where = 'where '.$where;
        }
        $data = $this->db->query('select count(*) as count from doctor '.$where.'')->result_array();
        return $data;*/
    }

    public function ins_user_livestoc_amount($balance_amount){
        $users_data = $this->db->select('users_id')->get('users')->result_array();
        $dateNow = date('Y-m-d H:i:s');
        foreach($users_data as $user){
            if($user['users_id']){
                $value['users_id'] = $user['users_id'];
                $value['amount'] = $balance_amount;
                $value['status'] = 'Cr';
                $value['wallet_type'] = '0';
                $value['date'] = $dateNow;
                $data = $this->db->insert('livestoc_wallets', $value);
            }
        }
        return true;
    }
    public function product_interest_search($name = '', $user_id ='', $start='', $perpage=''){
        /*$where = '';
        if($name != ''){
            $where = ' where p.name = "'.$name.'"';
        }
        $this->db->limit($perpage, $start);
        $query = "SELECT pi.*, u.*, p.* FROM produc_interest as pi 
            LEFT JOIN product as p ON pi.product_id = p.id  
            LEFT JOIN users as u ON u.users_id = pi.users_id ".$where."";
        $detail = $this->db->query($query)->result_array();
        if($detail){
            return $detail;
        }else{
            return false;
        }*/
        $where = '';
        if($name != ''){
            $where = ' where p.name like "%'.$name.'%"';
        } 
        if($user_id != ''){
          if($where != ''){
            $where .= ' and p.user= "'.$user_id.'"';
          }else{
            $where .= ' where p.user= "'.$user_id.'"';
          }  
        }
        $this->db->limit($perpage, $start);
        $query = "SELECT DISTINCT(p.id),pi.*, u.*, p.* FROM produc_interest as pi 
            LEFT JOIN product as p ON pi.product_id = p.id  
            LEFT JOIN users as u ON u.users_id = pi.users_id ".$where."";
        $detail = $this->db->query($query)->result_array();
        $row = $this->db->query($query)->num_rows();

        if($detail){
            $detail['details'] =  $detail;
            $detail['count'] =  $row;
            return $detail;
        }else{
            return false;
        }
    }
    public function get_product_interest_count($name = '', $user_id){
        $where = '';
        if($name != ''){
            //$where = ' where fullname like "%'.$name.'%"';
        }
        $data = $this->db->query('Select count(*) as count from produc_interest'.$where.'')->result_array();
        return $data;
    }
    public function get_account_search($name = '', $user_id, $start, $perpage){
        if($name != ''){
            $this->db->where('users_id = "'.$name.'" AND payment_type IS NOT NULL AND payment_type!=""');
        } else {
            $this->db->where('payment_type = "Cr" OR payment_type = "Dr" AND payment_type IS NOT NULL AND payment_type!=""');
        }
        $data = $this->db->select("id, if(type = '11', 'Advance Semen Booking',if(type = '12', 'Animal Premium','')) as type,type as type_type, premium_bull_type, payment_type, users_id, ai_id, currency, request_id, request_status, status, amount, user_type, date")->get('log_file')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_account_count($name = '', $user_id){
        $where = '';
        if($name != ''){
            $this->db->where('users_id = "'.$name.'" AND payment_type IS NOT NULL AND payment_type!=""');
        } else {
            $this->db->where('payment_type = "Cr" OR payment_type = "Dr" AND payment_type IS NOT NULL AND payment_type!=""');
        }
        $data = $this->db->query('Select count(*) as count from log_file'.$where.'')->result_array();
        return $data;
    }
     public function get_order_search($name = '', $user_id='', $start='', $perpage=''){
        $where = '';
        if($user_id !=''){
           $where = "where p.user = '".$user_id."'";
        }
        // if($name != ''){
        //     $this->db->where('users_id = "'.$name.'" AND payment_type IS NOT NULL AND payment_type!=""');
        // } else {
        //     $this->db->where('payment_type = "Cr" OR payment_type = "Dr" AND payment_type IS NOT NULL AND payment_type!=""');
        // }
        $data = $this->db->query("select DISTINCT po.id, pp.name as package_name,(select full_name from users where users_id = po.users_id) as user_name, (select mobile from users where users_id = po.users_id) as user_mobile, (select address from users where users_id = po.users_id) as user_address, po.product_qty, po.package_id, po.package_price, po.date, po.isactive, p.user, p.name, p.images from product_order as po left join product as p on p.id = po.product_id left join product_package pp on po.package_id = pp.id ".$where."")->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_order_count($name = '', $user_id=''){
        $where = '';
        if($user_id !=''){
           $where = "where p.user = '".$user_id."'";
        }
        // if($name != ''){
        //     $this->db->where('users_id = "'.$name.'" AND payment_type IS NOT NULL AND payment_type!=""');
        // } else {
        //     $this->db->where('payment_type = "Cr" OR payment_type = "Dr" AND payment_type IS NOT NULL AND payment_type!=""');
        // }
        $data = $this->db->query('select count(po.id) as count from product_order as po left join product as p on p.id = po.product_id '.$where.'')->result_array();
        return $data;
    }
    public function get_calllogs_search($name = '', $user_id, $start, $perpage){
        if($name != ''){
            $this->db->where('users_id = "'.$name.'" AND payment_type IS NOT NULL AND payment_type!=""');
        } else {
            $this->db->where('payment_type = "Cr" OR payment_type = "Dr" AND payment_type IS NOT NULL AND payment_type!=""');
        }
        $data = $this->db->select("id, if(type = '11', 'Advance Semen Booking',if(type = '12', 'Animal Premium','')) as type,type as type_type, premium_bull_type, payment_type, users_id, ai_id, currency, request_id, request_status, status, amount, user_type, date")->get('log_file')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    public function get_calllogs_count($name = '', $user_id){
        $where = '';
        if($name != ''){
            $this->db->where('users_id = "'.$name.'" AND payment_type IS NOT NULL AND payment_type!=""');
        } else {
            $this->db->where('payment_type = "Cr" OR payment_type = "Dr" AND payment_type IS NOT NULL AND payment_type!=""');
        }
        $data = $this->db->query('Select count(*) as count from log_file'.$where.'')->result_array();
        return $data;
    }

    public function removevideolike($id){
        return $this->db->where('id',$id)->delete('video_like');
    }

    public function removevideo($id){
        return $this->db->where('video_id',$id)->delete('video_block');
    }

    public function insert_livestoc_wallets($data){
        $detail = $this->db->insert('livestoc_wallets', $data);
        $last_id[]['id'] = $this->db->insert_id();
        return $last_id;
    }

    public function package_uniqid_count($uniqid = ''){
        $where = '';
        if($uniqid != ''){
            $where = ' where unit_id = "'.$uniqid.'"';
        }
        $data = $this->db->query('Select count(*) as count from product_package '.$where.'')->result_array();
        return $data;
    }
    //api for apis seach etc
    public function add_api_records($data){
        $data = $this->db->insert('apis_list', $data);
        if($data){
            return true;
        }else{
            return false;
        }
    }
    public function get_apis_search($name = '', $user_id, $start, $perpage){
        if($name != ''){
            $this->db->where('method = "'.$name.'"');
        }
        $data = $this->db->select("api_id, linkurl, description, method, created_on, updated_on")->get('apis_list')->result_array();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    public function get_apis_count($name = '', $user_id){
        $where = '';
        if($name != ''){
            $this->db->where('method = "'.$name.'"');
        }
        $data = $this->db->query('Select count(*) as count from apis_list'.$where.'')->result_array();
        return $data;
    }
    public function del_apis($id){
        if($this->db->where('api_id', $id)->delete('apis_list')){
            return True;
        }else{
            return False;
        }
    }

    public function get_user_auth_tocken($users_number){
        $dateNow = date('Y-m-d H:i:s');
        $value['created_on'] = $dateNow;
        $value['updated_on'] = $dateNow;
        $value['users_auth_tocken'] = $users_number;
        $details = $this->db->where('users_auth_tocken', $users_number)->get('users_auth_tocken')->result_array();
        if($details) {
            return $details[0]['users_auth_tocken'];
        } else {
            if($this->db->insert('users_auth_tocken', $value)) {
                return $value['users_auth_tocken'];
            } else {
                return false;
            }
        }
    }
    public function get_user_auth_users($users_auth_tocken){
        $details = $this->db->where('users_auth_tocken', $users_auth_tocken)->get('users_auth_tocken')->result_array();
        if($details) {
            $splitValues = explode('_',$details[0]['users_auth_tocken']);
            return $this->get_fcm_user($splitValues[0]);
        } else {
            return false;
        }
    }

}
	