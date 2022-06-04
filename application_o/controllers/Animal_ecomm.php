<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Animal_ecomm extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
        $this->load->library('form_validation');
        $this->load->model('front_end_model');
        $this->load->library('language_left');
        define('LANG_DATA',$this->language_left->get_language($lang));
        date_default_timezone_set('Asia/Calcutta');
    }
    public function add_cart(){ 
        $data['evaluation_id'] = $this->input->get_post('evaluation_id');
        $data['animal_id'] = $this->input->get_post('animal_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        //$pack_price = $this->input->get_post('pack_price');
        $data['qty'] = $this->input->get_post('qty');
        $data['evaluation_price'] = $this->input->get_post('evaluation_price');
        $data['livestoc_price'] = $this->input->get_post('livestoc_price');
        $data['bidding_price'] = $this->input->get_post('bidding_price');
        $data['created_on'] = date('Y-m-d h:i:s');
        //$animal_id = json_decode($animal_id);
        if($pro = $this->api_model->get_data('animal_id = "'.$data['animal_id'].'" AND users_id = "'.$data['users_id'].'"',  'animal_cart')){
           // print_r($pro);
            if($pro[0]['qty'] != $data['qty']){
                $update['qty'] = $data['qty'];
                if($this->api_model->update('id', $pro[0]['id'], 'animal_cart', $update)){
                    $json['success']  = TRUE;
                    $json['flag']  = '1';
                    $json['msg'] ="Your cart list has been updated";
                    //$json['msg'] ="Remove from Cart List";
                }
            }else{
                if($this->api_model->removeanimalcart($pro[0]['id'])){
                    $json['success']  = TRUE;
                    $json['flag']  = '0';
                    $json['msg'] ="Successfully removed from cart.";
                }else{
                    $json['success']  = false;
                    $json['error'] = "database problem";
                }
            }
        }else{
            $count = $this->api_model->get_data('users_id = "'.$data['users_id'].'" AND user_type = "'.$data['user_type'].'"', 'animal_cart', '', 'count(id) as count');
            if($count[0]['count'] < '10'){
                if($this->api_model->submit('animal_cart', $data)){
                    $json['success']  = TRUE;
                    $json['flag']  = '1';
                    $json['msg'] ="Successfully added to cart.";
                }else{
                    $json['success']  = false;
                    $json['error'] = "database problem";
                }
            }else{
                $json['success']  = false;
                $json['error'] = "You can only add 10 animals at a time.";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    function remove_cart(){
        $animal_id = $this->input->get_post('animal_id');
        $user_id = $this->input->get_post('user_id');
        $type = $this->input->get_post('type');
        $where = '';
        if($animal_id != ''){
            $where = ' AND animal_id = "'.$animal_id.'"';
        }
            if($this->api_model->own_query('DELETE FROM animal_cart WHERE users_id = "'.$user_id.'" AND user_type = "'.$type.'" '.$where.'')){
                $json['success']  = True;
                $json['msg'] = "Item has been successfully deleted";
            }else{
                $json['success']  = false;
                $json['error'] = "database problem";
            }
        //}
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function get_cart_animal(){
        $users_id = $this->input->get_post('users_id');
        $user_type = $this->input->get_post('user_type');
        $total_count = $this->api_model->get_data('user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"',  'animal_cart','','COUNT(id) as count');
        $k = 0;
        if($pro = $this->api_model->get_data('user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"',  'animal_cart')){
            foreach($pro as $de){
                //print_r($de);
                $value = $this->api_model->get_data('animal_id = "'.$de['animal_id'].'"', 'animals');
                $img = $this->api_model->get_animal_image($de['animal_id']);
                //print_r($value);
                $livestoc_price += $de['livestoc_price'];
                $evaluation_price += $de['evaluation_price'];
                $bidding_price += $de['bidding_price'];
                $category = $this->api_model->get_category($de['category_id']);
                $breed = $this->api_model->get_breed($de['breed_id']);
                $category = $this->api_model->get_category($de['category_id']);
                $video = $this->api_model->get_animal_videos($de['animal_id']);
                $de['booking_amount'] = $de['livestoc_price'] * BOOKING_PRICE / 100;
                $booking_amount += $de['booking_amount'];
                    $animal_like = $this->api_model->get_data('users_id = "'.$de['users_id'].'" AND animal_id = "'.$de['animal_id'].'"','animal_like_list','','COUNT(animal_like_id) as total_count');
                    $favorite_count = $this->api_model->get_data('users_id = "'.$de['users_id'].'" AND animal_id = "'.$de['animal_id'].'"','animal_favorite_list','','COUNT(favorite_id) as total_count');
                    $animal_like_list = $this->api_model->get_data('users_id = "'.$de['users_id'].'" AND animal_id = "'.$de['animal_id'].'"','animal_like_list','','COUNT(animal_like_id) as total_count');
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
                    $de['lactation'] = $value[0]['lactation'];
                    $de['gender'] = $value[0]['gender'];
                    $de['animal_age'] = $value[0]['age'];
                    $de['animal_month'] = $value[0]['age_month'];
                    $de['yield_max'] = $value[0]['yield_max'];
                    $de['height'] = $value[0]['height'];
                    $de['weight'] = $value[0]['weight'];
                    $de['yield'] = $value[0]['yield'];
                    $de['milking_status'] = $value[0]['milking_status'];
                    $de['animal_purpose'] = $value[0]['animal_purpose'];
                    $de['is_pregnant'] = $value[0]['is_pregnant'];
                    $de['pregnancy_date'] = $value[0]['pregnancy_date'];
                    $de['breed_name'] = $breed[0]['breed_name'];
                    $de['category'] = $category[0]['category'];
                    $de['like_count'] = $animal_like[0]['total_count'];
                    $de['favorite_count'] = $favorite_count[0]['total_count'];
                    $de['favorite_id'] = $animal_like_list[0]['total_count'];
                     if(empty($imm)){
                        $imm[0]['animals_images'] = [];
                    }
                    $de['animals_images'] = $imm;
                    if(empty($ani)){
                        $ani[0]['animals_video'] = [];
                    }
                    $de['animals_video'] = $ani;
                    //$deat[0] = $de;
                     $mainData[] =   $de;
                   
                }
                $json['success']  = true; 
                $json['data'] = $mainData;
                $json['livestoc_price'] = $livestoc_price;
                $json['evaluation_price'] = $evaluation_price;
                $json['bidding_price'] = $bidding_price;
                $json['booking_amount'] = $booking_amount;
                $json['count'] = $total_count[0]['count'];
                // print_r($value);
                // exit;
                //$value = $value[0];
            }else{
            $json['success']  = FALSE; 
            if($start != 0 || $start != ''){
                $json['error'] = 'No Data Found';
            }else{
                $json['error'] = 'Your cart is empty. Please add animal to your cart.';
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
}