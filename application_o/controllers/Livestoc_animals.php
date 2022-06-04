<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Livestoc_animals extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		$this->load->model('loginmodel');
		$this->load->model('pushnoti_model');
		$this->load->model('front_end_model');
        $this->load->model('Admin_detail');
        $this->load->model('livestoc_animal');	
		$this->load->library('form_validation');
        date_default_timezone_set('Asia/Calcutta');
    }
    public function get_livestoc_animals(){
		
    	$doc_id = $this->input->get_post('users_id');
		$cat_id = $this->input->get_post('cat_id');
		$gendor = $this->input->get_post('gender');
		$breed_id = $this->input->get_post('breed_id');
		$start =  $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$status = $this->input->get_post('status');
		$bidding_status =$this->input->get_post('bidding_status'); 
		$where = '';
		// if (isset($_REQUEST['page']) && $_REQUEST['page'] != '') {
        //     $page = $_REQUEST['page'];
        // }
        // if (isset($_REQUEST['limit']) && $_REQUEST['limit'] != '') {
        //     $limit = $_REQUEST['limit'];
        // }

		// $page = ($page - 1) * $limit;

		$select = '';
        if(isset($_REQUEST['latitude']) && $_REQUEST['latitude'] !='')
		{
			$select .=', IFNULL(( 3959 * acos( cos( radians('.$_REQUEST['latitude'].') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians ('.$_REQUEST['longitude'].') ) + sin( radians('.$_REQUEST['latitude'].') ) * sin( radians( a.latitude ) ) ) ),0) AS distance';
		}
		
		// echo $page;
		// exit;
        // Pagination

      /*   if (isset($_REQUEST['sort']) && $_REQUEST['sort'] != '') {
            $sort = $_REQUEST['sort'];
        }

        if (isset($_REQUEST['sortorder']) && $_REQUEST['sortorder'] != '') {
            $sortorder = $_REQUEST['sortorder'];
        } */
		

			$whereForAge = '';
			$breadQueryForDatabase = '';
			// if(isset($_REQUEST['listtype']))
			// {
			// 	$listtype = $_REQUEST['listtype'];
			// 	if($listtype=='2')
			// 	{
			// 		$where = "where animal_purpose = 2";  // featured animal
			// 	}
			// 	if($listtype=='1')
			// 	{
			// 		$where = "where animal_purpose = 1"; // animal for sale
			// 	}
            //     if($listtype=='4')
			// 	{
			// 		$where = "where a.users_type_id = '4' and animal_purpose IN ('1' , '2')"; // breeder for sale
			// 	}

            //     if($listtype=='5')
			// 	{
			// 		$where = "where a.users_type_id = '5' and animal_purpose IN ('1' , '2')"; // dealer for sale
			// 	}				
		
				if(isset($_REQUEST['animal_id']))
				{
					$animal_id =$_REQUEST['animal_id'];
					$where .= " and a.animal_id = $animal_id "; 
				}
				if(isset($_REQUEST['users_id']))
				{
					$users_id = $_REQUEST['users_id'];
				}
				
				if(isset($_REQUEST['gender']) && $_REQUEST['gender'] != '')
				{
					$gender = $_REQUEST['gender'];
					$where .= " and a.gender = '$gender' "; 
				}
				/*
				if(isset($_REQUEST['breed_id']))
				{
					$breed_id =$_REQUEST['breed_id'];
					$where .= " and a.breed_id LIKE '$breed_id'"; 
				}*/
				// New code added by me
				$breadMore = '';
				$categoryRequired = 0;
				if(isset($_REQUEST['breed_id']) && $_REQUEST['breed_id'] != '')
				{
					$breed = $_REQUEST['breed_id'];
					if($where == ''){
						$breadQueryForDatabase = " and a.breed_id LIKE '$breed_id'"; 
					} else{
						$needle   = ",";
						$haystack = $breed;
						$needle   = ",";
						if( strpos( $haystack, $needle ) !== false) {
							$categoryRequired = 1;

							$extension = explode(",", $breed);
							$sizeBreed = sizeof($extension);
							foreach ($extension as $key => $value) {
								if(($sizeBreed -1) == $key) {
									$breadMore .= "'".$value. "'";
								} else {
									$breadMore .= "'".$value. "',";
								}
							}
							$breadQueryForDatabase = " AND a.breed_id IN ($breadMore)"; 
						} else {
							$breadQueryForDatabase = " and a.breed_id like '%$breed%'"; 
						}
					}
				}

				// New code added by me
				if(isset($_REQUEST['is_pregnant']))
				{
					$is_pregnant = $_REQUEST['is_pregnant'];
					if($where == ''){
						if(intval($is_pregnant)==1 && $is_pregnant != '') {
							$where .= " and a.is_pregnant = 'Yes'"; 
						} elseif(intval($is_pregnant)==0 && $is_pregnant!= '') {
							$where .= " and a.is_pregnant = 'No'"; 
						} else {
							$where .= " and a.is_pregnant like '%%'"; 
						}
					} elseif(intval($is_pregnant)==1 && $is_pregnant != '') {
						$where .= " and a.is_pregnant = 'Yes'"; 
					} elseif(intval($is_pregnant)==0 && $is_pregnant!= '') {
						$where .= " and a.is_pregnant = 'No'"; 
					} else {
						$where .= " and a.is_pregnant like '%%'"; 
					}
				}
				//Code for lactation
				if(isset($_REQUEST['lactation']) && $_REQUEST['lactation'] != '')
				{
					$lactation = $_REQUEST['lactation'];
					if($where == ''){
						if($lactation) {
							$where .= " and a.lactation >=$lactation"; 
						} else {
							$where .= " and a.lactation like '%%'"; 
						}
					} elseif(intval($lactation) > 0) {
						$where .= " and a.lactation >= $lactation"; 
					} elseif($lactation == '0') {
						$where .= " and a.lactation >= $lactation";
					} else {
						$where .= " and a.lactation like '%%'"; 
					}
				}

				if((isset($_REQUEST['pricefrom']) && isset($_REQUEST['priceto']) && ($_REQUEST['pricefrom'] !='' && $_REQUEST['priceto'] !='')) )
				{
					$pricefrom =$_REQUEST['pricefrom'];
					$priceto =$_REQUEST['priceto'];
					$where .= " and a.price >= $pricefrom  and a.price<=$priceto"; 
				}
				/*if(isset($_REQUEST['agefrom']) && isset($_REQUEST['ageto']) )
				{
					$agefrom =$_REQUEST['agefrom'];
					$ageto =$_REQUEST['ageto'];
					if(!empty($agefrom) && $agefrom > 0 && !empty($ageto) && $ageto > 0) {
						$whereForAge .= " and ad.animal_age >= $agefrom  and ad.animal_age<=$ageto"; 
					} elseif(empty($agefrom)) {
						$whereForAge .= " and ad.animal_age <=$ageto"; 
					} else {
						$whereForAge .= " and ad.animal_age >= $agefrom"; 
					}
				}*/
				//Code for age
				if((isset($_REQUEST['agefrom']) && isset($_REQUEST['ageto'])) &&  ($_REQUEST['agefrom'] != '' && $_REQUEST['ageto'] != ''))
				{
					$agefrom =$_REQUEST['agefrom'];
					$ageto =$_REQUEST['ageto'];
					if(!empty($agefrom) && $agefrom > 0 && !empty($ageto) && $ageto > 0) {
						$whereForAge .= " and ad.animal_age >= $agefrom  and ad.animal_age<=$ageto"; 
					} elseif(empty($agefrom) && empty($ageto)) {
						$whereForAge .= " and ad.animal_age like '%%'  and ad.animal_age like '%%'"; 
					} elseif(!empty($agefrom)) {
						$whereForAge .= " and ad.animal_age >= $agefrom"; 
					} elseif(!empty($ageto)) {
						$whereForAge .= "and ad.animal_age <=$ageto"; 
					} else {
						$whereForAge .= " and ad.animal_age like '%%'  and ad.animal_age like '%%'"; 
					}
				}

				if(isset($_REQUEST['priceorder']) && $_REQUEST['priceorder'] !='')
				{
					$priceorder =$_REQUEST['priceorder'];
					if($priceorder == 0)
					{
						$order = " order by a.price ASC"; 
					}
					elseif($priceorder == 1)
					{
						$order = " order by a.price DESC"; 
					}
					
				}
				else{
					 $order = " ORDER BY a.animal_id DESC"; 					
				}
		if(isset($_REQUEST['animal_id']) && $_REQUEST['animal_id'] != '')
		{
			$animal_id =$_REQUEST['animal_id'];
			$where = "where a.animal_id = $animal_id"; 
		}
		/*if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
		{
			$category_id = $_REQUEST['category_id'];
			if($where == ''){
				$where .= " where a.category_id IN (".$category_id.")";
			}else{
				$where .= " and a.category_id IN (".$category_id.")";
			}
		}*/
		//New code for category
		if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
		{
			$category_id = $_REQUEST['category_id'];
			if($where == ''){
				$where .= " where a.category_id IN (".$category_id.")";
			}else{
				$where .= " and a.category_id IN (".$category_id.")";
			}
			$needle   = ",";
			$haystack = $category_id;
			$needle   = ",";
			if( strpos( $haystack, $needle ) !== false) {
				$where .= " and a.breed_id like '%%'"; 
			} else {
				$where .= $breadQueryForDatabase;
			}
		}
		
		//print_r($where);
		//die();
		$stateMore = '';
		if(isset($_REQUEST['state']) && $_REQUEST['state'] != '')
		{
			$state =$_REQUEST['state'];
			if($where == ''){
				$where .= " where a.state like '%$state%'"; 
			}else{
				//$where .= " and a.state like '%$state%'"; 
				$needle   = ",";
				$haystack = $state;
				$needle   = ",";
				if( strpos( $haystack, $needle ) !== false) {
					$extension = explode(",", $state);
					$sizeState = sizeof($extension);
					foreach ($extension as $key => $value) {
						if(($sizeState -1) == $key) {
							$stateMore .= "'".$value. "'";
						} else {
							$stateMore .= "'".$value. "',";
						}
					}
					$where .=" AND ae.state_id IN ($stateMore)"; 
				} else {
					$where .= " and ae.state_id like '%$state%'"; 
				}
			}
		}		
		// echo $where;
		// exit;
		if ($where == '') {
            $json['error'][] = "We are in process of updating the listings please check after 48 Hrs.";
        }
        // if($cat_id != ''){
        //     $where .= 'AND category_id IN ('.$cat_id.')';
        // }if($gendor!=''){
        //     $where .= ' AND gender like "'.$gendor.'"';
        // }
		// if($doc_id != ''){
        //     $where .= 'AND ae.users_id = "'.$doc_id.'"';
        // }if($breed_id != ''){
        //     $where .= 'AND breed_id = "'.$breed_id.'"';
        // }
		// if()
        // $stateMore = '';
		// 	if(isset($_REQUEST['state'])){
		// 		$state =$_REQUEST['state'];
		// 		if($where == ''){
		// 			$where .= " where a.state like '%$state%'"; 
		// 		}else{
		// 			//$where .= " and a.state like '%$state%'"; 
		// 			$needle   = ",";
		// 			$haystack = $state;
		// 			$needle   = ",";
		// 			if( strpos( $haystack, $needle ) !== false) {
		// 				$extension = explode(",", $state);
		// 				$sizeState = sizeof($extension);
		// 				foreach ($extension as $key => $value) {
		// 					if(($sizeState -1) == $key) {
		// 						$stateMore .= "'".$value. "'";
		// 					} else {
		// 						$stateMore .= "'".$value. "',";
		// 					}
		// 				}
		// 				$where .=" AND a.state IN ($stateMore)"; 
		// 			} else {
		// 				$where .= " and a.state like '%$state%'"; 
		// 			}
		// 		}
		// 	}
		if($bidding_status == '1'){
			$where = " AND animal_bidding = '1' AND ae.bidding_price <> 0";
		}if($bidding_status == '0'){
			$where = " AND livestoc_sell = '1' AND ae.livestoc_price <> 0";
		}
		if($status == ''){
			$status = " AND ae.status = '0'";
		}else{
			$status = " AND ae.status = '".$status."'";
		}

    	$query = "SELECT ae.animal_rating as animal_rating,ae.animal_style as animal_style, ae.id as evaluation_id, a.animal_id, a.users_id, ae.log_id, a.category_id, ae.booking_amount, ae.evaluation_price,ae.livestoc_price, a.breed_id, a.animal_purpose, a.fullname, a.age,a.no_nipples, a.age_month,a.herd,a.herd_total,a.no_of_males,a.no_of_females,a.total_no_animals, a.yield_max, if(ae.state_id = '0', '', (select name from zone where zone_id = ae.state_id)) as state_name, if(ae.dist_id = '0', '', (select dist_name from district where dis_id = ae.dist_id)) as dist_name, a.height, a.weight, a.yield, a.lactation, a.price, a.gender, a.created_on, a.calf_status, a.treatment_status, a.tag_no, a.herd, a.herd_total, a.dob, a.is_pregnant, a.pregnant_month, a.pregnancy_date, ad.animal_age, ad.animal_month, ae.evaluation_price, ae.livestoc_sell, ae.bidding_start_time, ae.bidding_start_date, ae.bidding_hours, ae.livestoc_price, ae.animal_bidding, ae.bidding_price, if((select animal_id from animal_cart where a.animal_id = animal_cart.animal_id) IS NULL, '0','1') as animal_user_cart FROM animals as a left JOIN animals_detail as ad ON ad.animal_id = a.animal_id RIGHT JOIN animals_evalutor ae ON  ae.animal_id = a.animal_id where ismodified !='2' AND ae.total_amount_paid = '0' ".$status." ".$where." LIMIT ".$start.", ".$perpage."";
    	$data = $this->api_model->sql_query($query);
		  $count = "SELECT COUNT(a.animal_id) as count, a.users_id FROM animals as a left JOIN animals_detail as ad ON ad.animal_id = a.animal_id RIGHT JOIN animals_evalutor ae ON  ae.animal_id = a.animal_id where ismodified !='2' AND ae.total_amount_paid = '0' ".$status." ".$where."";
		$total_count = $this->api_model->sql_query($count);
		if($data = $this->api_model->sql_query($query)){
		$deat = [];
		$k=0;
		foreach($data as $de){					
					$img = $this->api_model->get_animal_image($de['animal_id']);
                    $breed = $this->api_model->get_breed($de['breed_id']);
					$category = $this->api_model->get_category($de['category_id']);
					$video = $this->api_model->get_animal_videos($de['animal_id']);
					$animal_like = $this->api_model->get_data('users_id = "'.$de['users_id'].'" AND animal_id = "'.$de['animal_id'].'"','animal_like_list','','COUNT(animal_like_id) as total_count');
					$favorite_count = $this->api_model->get_data('users_id = "'.$de['users_id'].'" AND animal_id = "'.$de['animal_id'].'"','animal_favorite_list','','COUNT(favorite_id) as total_count');
					$animal_like_list = $this->api_model->get_data('users_id = "'.$de['users_id'].'" AND animal_id = "'.$de['animal_id'].'"','animal_like_list','','COUNT(animal_like_id) as total_count');
					$user_like = $this->api_model->get_data('users_id = "'.$de['users_id'].'" AND animal_id = "'.$de['animal_id'].'"','animal_like_list','','');
					//print_r($animal_user[0]['users_id']);
					//exit;
					if($user_like[0]['users_id'] !=''){
						$user_like[0]['users_id']  = '1';
					}else{
						$user_like[0]['users_id'] = '0';
					}
					// if(!empty($animal_user)){
					// 	$animal_user  = '1';
					// }else{
					// 	$animal_user = '0';
					// }
					$imm= '';
					$ani='';
					$i = 0;
					foreach($video as $vid){
							$url = 'https://www.livestoc.com/uploads_new/animals/video/'.$vid['videos'];
	                        $h = get_headers($url);
	                        $status = array();
	                        preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
	                        if($status[1]==200){
	                            $ani[$i]['videos'] = $url;
	                        }else{
	                            $ani[0]['videos'] = '';
	                        }
	                        $i++;
					}
					$y = 0;
                    foreach($img as $im){
						$url = 'https://www.livestoc.com/harpahu_merge_dev/uploads/animal/'.$im['images'];
                        $h = get_headers($url);
                        $status = array();
                        // preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
                        // if($status[1]==200){
                            $imm[$y]['images'] = $url;
                        // }else{
                        //     $imm = [];
                        // }
	                    $y++;
					}
					$time = '+'.$de['bidding_hours'].' hours';
					$date = date($de['bidding_start_date'].' '.$de['bidding_start_time'].'.u');
					$new_date = date("Y-m-d H:i:s.u", strtotime($time, strtotime($date)));
					/*rating */
					if($de['animal_style']=='1')
						$de['animal_style']='Elite Animal';
					elseif($de['animal_style']=='2')
						$de['animal_style']='Champion Animal';
					elseif($de['animal_style']=='3')
						$de['animal_style']='Going Cheap';
					elseif($de['animal_style']=='4')
						$de['animal_style']='Value For Money';
					else	
						$de['animal_style']='Null';
					/*rating */
					$de['bidding_end_time'] = $new_date;
                    $de['breed_name'] = $breed[0]['breed_name'];
					$de['category'] = $category[0]['category'];
					$de['like_count'] = $animal_like[0]['total_count'];
					$de['favorite_count'] = $favorite_count[0]['total_count'];
					$de['favorite_id'] = $animal_like_list[0]['total_count'];
					$de['like_user'] = $user_like[0]['users_id'];
					// $de['animal_user_cart'] = $animal_user;
					 if(empty($imm)){
						$imm[0]['animals_images'] = [];
					}
                    $de['animals_images'] = $imm;
                    if(empty($ani)){
						$ani = [];
					}
                    $de['animals_video'] = $ani;
                    $deat[$k] = $de;
                    $k++;
                }
			$json['success']  = true; 
			$json['data'] = $deat;
			$json['count'] = $total_count[0]['count'];
		}else{
			$json['success']  = FALSE; 
			if($start != 0 || $start != ''){
				$json['error'] = 'No Data Found';
			}else{
				$json['error'] = 'No more Data Found';
			}
			
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function get_invoice_data(){
		$users_id = $this->input->get_post('users_id');
		$where = '';
		if($users_id != ''){
			$where = ' AND purchaser_user_id = '.$users_id.'';
		}
		$sql = "select distinct log_id from animals_evalutor where log_id <> 0 ".$where."";
		//echo "<pre>";
		if($data = $this->api_model->query_build($sql)){
			$detail = '';
			foreach($data as $da){
				$sql1 = 'select id from animals_evalutor where log_id = '.$da['log_id'].'';
				$data_eve = $this->api_model->query_build($sql1);
				//$i = 0;
				foreach($data_eve as $eve){
					if($eve_ids == ''){
						$eve_ids = $eve['id'];
					}else{
						$eve_ids .= ','.$eve['id'];
					}
					//$i++;
				}
				//$eve_ids = implode(',', $data_eve);
				$sql1 = 'select log_id from animals_evalutor where log_id = '.$da['log_id'].'';
				$data_eve = $this->api_model->query_build($sql1);
				//$log_ids = implode(',', $data_eve);
				//$i = 0;
				foreach($data_eve as $eve){
					//print_r($eve);
					if($log_ids == ''){
						$log_ids .= $eve['log_id'];
					}else{
						$log_ids .= ','.$eve['log_id'];
					}
					//$i++;
				}
				// foreach($data_eve as $da_eve){
				// print_r($da_eve);
				// }
				// echo $detail['ids'];
				// echo "this is test";
				// if($eve_ids == ''){
					$detail['ids'] = $eve_ids;
				// }else{
				// 	$detail['ids'] .= $eve_ids;
				// }
				// if($log_ids == ''){
				// 	$detail['log_ids'] = $log_ids;
				// }else{
				// 	$detail['log_ids'] .= $log_ids;
				// }
				$detail['log_ids'] = $log_ids; 
				$sql2 = 'select sum(livestoc_price) as sum_livestoc_price from animals_evalutor where log_id = '.$da['log_id'].'';
				$total_amount1 = $this->api_model->query_build($sql2);
				$detail['total_amount'] += $total_amount1[0]['sum_livestoc_price'];
				$sql3 = 'select sum(evaluation_price) as sum_evaluation_price from animals_evalutor where log_id = '.$da['log_id'].'';
				$total_amount2 = $this->api_model->query_build($sql3);
				$detail['total_evaluation_amount'] += $total_amount2[0]['sum_evaluation_price'];
				$sql4 = 'select sum(booking_amount) as sum_booking_amount from animals_evalutor where log_id = '.$da['log_id'].'';
				$total_amount3 = $this->api_model->query_build($sql4);
				$detail['total_booking_amount'] += $total_amount3[0]['sum_booking_amount'];
				$detail['total_paid'] += $total_amount1[0]['sum_livestoc_price'] - $total_amount3[0]['sum_booking_amount'];
			}
			$json['success'] = true;
			$json['data'] = $detail;
		}else{
			$json['success'] = false;
			$json['error'] = 'No data found';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}	
}