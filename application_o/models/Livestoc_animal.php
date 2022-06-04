<?php
class Livestoc_animal extends CI_Model {
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
        $query = "SELECT a.animal_id, a.users_id, a.category_id, a.breed_id, a.animal_purpose, a.fullname, a.age, a.age_month, a.yield_max, a.height, a.weight, a.yield, a.lactation, a.price, a.gender, a.created_on, a.calf_status, a.treatment_status, a.tag_no, a.herd, a.herd_total, a.dob, a.is_pregnant, a.pregnant_month, a.pregnancy_date, ad.animal_age, ad.animal_month FROM animals as a left JOIN animals_detail as ad ON ad.animal_id = a.animal_id where ismodified !='2' ".$where."";
        print_r("SELECT a.animal_id, a.users_id, a.category_id, a.breed_id, a.animal_purpose, a.fullname, a.age, a.age_month, a.yield_max, a.height, a.weight, a.yield, a.lactation, a.price, a.gender, a.created_on, a.calf_status, a.treatment_status, a.tag_no, a.herd, a.herd_total, a.dob, a.is_pregnant, a.pregnant_month, a.pregnancy_date, ad.animal_age, ad.animal_month FROM animals as a left JOIN animals_detail as ad ON ad.animal_id = a.animal_id where ismodified !='2' ".$where."");
        $detail = $this->db->query($query)->result_array();
        return $detail;
    }
}