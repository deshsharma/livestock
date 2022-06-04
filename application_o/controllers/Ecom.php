<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ecom extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
        $this->load->library('form_validation');
        $this->load->model('front_end_model');
        $this->load->library('language_left');
        define('LANG_DATA',$this->language_left->get_language($lang));
        date_default_timezone_set('Asia/Calcutta');
    }
    public function index(){
        $id = $this->input->get_post('users_id');
        $lang = $this->input->get_post('lang');
        $cat_id = $this->input->get_post('cat_id');
        $type = $this->input->get_post('user_type');
        if($cat_id == ''){
         $cat_id = 0;
        }
        $start = 0;
        $perpage = 5;
        $la = $this->language_left->get_language($lang);
        $data['banner'] = $this->api_model->get_information_banners($cat_id, $start, $perpage, 'offersimage');;
        $data['category'] = $this->product_category_show($cat_id, $la);
        $data['product'][0]['name'] = $la['Premium Products'];
        //$da = $this->front_end_model->get_produc_with_price_and_details(1,1,$cat_id);
        $data['product'][0]['data']= $this->front_end_model->get_produc_with_price_and_details(1,1,'', $cat_id, $id, $type);
        $data['product'][0]['id'] = '1';
        $data['product'][1]['name'] = $la['Non Premium Products'];
        $data['product'][1]['data']= $this->front_end_model->get_produc_with_price_and_details(1,0,'', $cat_id, $id, $type);
        $data['product'][1]['id'] = '0';
        $data['cart'] ='0';
        $data['wishlist'] ='0';
        //print_r($data);
        $json['success']  = TRUE;
        $json['data'] = $data;
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function ecom_search(){
        $search = $this->input->get_post('search');
        $section = $this->input->get_post('section');
        $category = $this->input->get_post('category');
        //echo $search;
        if($search != ''){
            //echo "this is test";
            $where = '(name like "%'.$search.'%" OR brand like "%'.$search.'%") AND '; 
            if($section != '')
            $where .= 'FIND_IN_SET(section, "'.$section.'") AND '; 
            if($category != '')
            $where .= 'category = "'.$category.'" AND '; 
            if($data = $this->api_model->get_data($where.'isactive = "1"', 'product', '','id, name')){
                $json['success']  = true;
                $json['data']  = $data;
            }else{
                $json['success']  = false;
            }
        }else{
            $json['success']  = false;
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function get_cart_product($users_id = '', $user_type = '', $cart_type=''){
        if($users_id == '')
        $users_id = $this->input->get_post('users_id');
        if($user_type == '')
        $user_type = $this->input->get_post('user_type');
        //$tax = $this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage'); 
        if($pro = $this->api_model->get_data('users_id = "'.$users_id.'" AND user_type = "'.$user_type.'"',  'product_cart')){
            foreach($pro as $pr){
                $value = $this->api_model->get_data('id = "'.$pr['product_id'].'"', 'product');
                $value = $value[0];
                $priceDetails = $this->api_model->get_data('product_id = "'.$pr['product_id'].'"', 'product_pack_rate');
                $pack_name = $this->api_model->get_data( 'id = "'.$priceDetails[0]['pack_id'].'"', 'product_package');
                $value['pack_id'] = $priceDetails[0]['pack_id'];
                $value['cart_qty'] = $pr['qty'];
                $value['pack_name'] = $pack_name[0]['name'];
                $value['mrp'] = $priceDetails[0]['mrp'];
                $value['sale_price'] = $priceDetails[0]['sale_price'];
                $value['vt_sale_price'] = $priceDetails[0]['vt_sale_price'];
                $value['product_id'] = $priceDetails[0]['product_id'];
                $product_rating =$this->api_model->get_data( 'product_id = "'.$priceDetails[0]['product_id'].'"', 'products_reviews', '','avg(rating) as avg');
                $value['product_rating'] = $product_rating[0]['avg'];
                $product_review = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'"', 'products_reviews', '', 'count(id) as count');
                $value['product_review'] = $product_review[0]['count'];
                if($users_id != ''){
                    if($product_user_like = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"', 'product_like', '', 'count(id) as count')){
                        $value['product_user_like'] = $product_user_like[0]['count'];
                    }else{
                        $value['product_user_like'] = 0;
                    } 
                    if($product_user_like = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"', 'product_cart', '', 'count(id) as count')){
                        $value['product_user_cart'] = $product_user_like[0]['count'];
                    }else{
                        $value['product_user_cart'] = 0;
                    }   
                }else{
                    $value['product_user_like'] = 0;
                    $value['product_user_cart'] = 0;
                }
                if($user_type == '1'){
                    $total_price += $priceDetails[0]['sale_price'] * $pr['qty'];
                    $app_tax += ($priceDetails[0]['sale_price']*$pr['qty'])*($value[0]['gst']/100);
                }else{
                    $total_price +=  $priceDetails[0]['vt_sale_price']*$pr['qty'];
                    $app_tax += ($priceDetails[0]['vt_sale_price']*$pr['qty'])*($value[0]['gst']/100);
                }
                $app_tax = $total_price*($tax[0]['tax_percentage']/100);
                $imagePath = explode(',', $value['images']);
                $i=0;
                foreach($imagePath as $im){
                    if($im){
                        $image[$i]=  IMAGE_PATH.'harpahu_merge/uploads/product/'.$im;
                        $i++;
                    }
                }
                $value['product_images'] = $image;
                $mainData[] =   $value;
            }
            $json['success']  = TRUE;
            $json['data'] =$mainData;
            $json['product_cost']['product_sub_total'] = $total_price;
            $json['product_cost']['product_tax_total'] = $app_tax;
            $json['product_cost']['product_total'] = $total_price + $app_tax;
        }else{
            $json['success']  = false;
            $json['error'] ='Your Cart is Empty';
        }
        if($cart_type == '1'){
            return $json;
        }else{
            header('Content-Type: application/json');
            echo json_encode($json);
            exit;
        }
    } 
    public function get_like_product(){
        $users_id = $this->input->get_post('users_id');
        $user_type = $this->input->get_post('user_type');
        if($pro = $this->api_model->get_data('users_id = "'.$users_id.'" AND user_type = "'.$user_type.'"',  'product_like')){
            foreach($pro as $pr){
                $value = $this->api_model->get_data('id = "'.$pr['product_id'].'"', 'product');
                $value = $value[0];
                $priceDetails = $this->api_model->get_data('product_id = "'.$pr['product_id'].'"', 'product_pack_rate');
                $pack_name = $this->api_model->get_data( 'id = "'.$priceDetails[0]['pack_id'].'"', 'product_package');
                $value['pack_id'] = $priceDetails[0]['pack_id'];
                $value['pack_name'] = $pack_name[0]['name'];
                $value['mrp'] = $priceDetails[0]['mrp'];
                $value['sale_price'] = $priceDetails[0]['sale_price'];
                $value['vt_sale_price'] = $priceDetails[0]['vt_sale_price'];
                $value['product_id'] = $priceDetails[0]['product_id'];
                $product_rating =$this->api_model->get_data( 'product_id = "'.$priceDetails[0]['product_id'].'"', 'products_reviews', '','avg(rating) as avg');
                $value['product_rating'] = $product_rating[0]['avg'];
                $product_review = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'"', 'products_reviews', '', 'count(id) as count');
                $value['product_review'] = $product_review[0]['count'];
                if($users_id != ''){
                    if($product_user_like = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"', 'product_like', '', 'count(id) as count')){
                        $value['product_user_like'] = $product_user_like[0]['count'];
                    }else{
                        $value['product_user_like'] = 0;
                    } 
                    if($product_user_like = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"', 'product_cart', '', 'count(id) as count, qty')){
                        $value['product_user_cart'] = $product_user_like[0]['count'];
                        $value['cart_qty'] = $product_user_like[0]['qty'] ? $product_user_like[0]['qty'] : 0;;
                    }else{
                        $value['product_user_cart'] = 0;
                        $value['cart_qty'] = 0;
                    }   
                }else{
                    $value['product_user_like'] = 0;
                    $value['product_user_cart'] = 0;
                }
                $imagePath = explode(',', $value['images']);
                $i=0;
                foreach($imagePath as $im){
                    if($im){
                        $image[$i]=  IMAGE_PATH.'harpahu_merge/uploads/product/'.$im;
                        $i++;
                    }
                }
                $value['product_images'] = $image;
                $mainData[] =   $value;
            }
            $json['success']  = TRUE;
            $json['data'] =$mainData;
        }else{
            $json['success']  = false;
            $json['error'] ='Your Wishlist is Empty.';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    } 
    public function get_product_type(){
        $premium_type = $this->input->get_post('premium_type');
        $category = $this->input->get_post('category');
        $section = $this->input->get_post('section');
        $lang = $this->input->get_post('lang');
        $start = $this->input->get_post('start');
        $users_id = $this->input->get_post('users_id');
        $user_type = $this->input->get_post('user_type');
        $product_id = $this->input->get_post('product_id');
        $order_by = $this->input->get_post('order_by');
        $la = $this->language_left->get_language($lang);
        $perpage = '10';
        $where = '';
        if($premium_type != ''){
            $where .= ' ispremium = "'.$premium_type.'" AND';
        } 
        if($category != ''){
            $where .= ' category = "'.$category.'" AND';
        }
        if($section != ''){
            $where .= ' section = "'.$section.'" AND';
        }
        if($product_id != ''){
            $where .= ' id = "'.$product_id.'" AND';
        }
        if($data = $this->api_model->get_data(''.$where.' isactive = "1"', 'product as pro', $order_by, '*, (select mrp from product_pack_rate as pr where pr.product_id = pro.id LIMIT 1) as mrp', $start, $perpage)){
            foreach ($data as $key => $value) {
                $decription =  $this->api_model->get_data('table_id = "'.$value['id'].'" AND language_code = "'.$lang.'" AND table = "product"', 'different_language_details');
                $default_decription =  $this->api_model->get_data('table_id = "'.$value['id'].'" AND language_code = "en" AND table = "product"', 'different_language_details');
                $priceDetails = $this->api_model->get_data('product_id = "'.$value['id'].'"', 'product_pack_rate');
                $pack_name = $this->api_model->get_data( 'id = "'.$priceDetails[0]['pack_id'].'"', 'product_package');
                $value['pack_id'] = $priceDetails[0]['pack_id'];
                $value['long_desc'] = $decription[0]['description'] ? $decription[0]['description'] : ($default_decription[0]['description']?$default_decription[0]['description']:$value['long_desc']);
                $value['pack_name'] = $pack_name[0]['name'];
                $value['mrp'] = $priceDetails[0]['mrp'];
                $value['sale_price'] = $priceDetails[0]['sale_price'];
                $value['vt_sale_price'] = $priceDetails[0]['vt_sale_price'];
                $value['product_id'] = $priceDetails[0]['product_id'];
                $product_rating =$this->api_model->get_data( 'product_id = "'.$priceDetails[0]['product_id'].'"', 'products_reviews', '','avg(rating) as avg');
                $value['product_rating'] = $product_rating[0]['avg'];
                $product_review = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND is_active = "1"', 'products_reviews', '', 'count(id) as count');
                $value['product_review'] = $product_review[0]['count'];
                if($users_id != ''){
                    if($product_user_like = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"', 'product_like', '', 'count(id) as count')){
                        $value['product_user_like'] = $product_user_like[0]['count'];
                    }else{
                        $value['product_user_like'] = 0;
                    } 
                    if($product_user_like = $this->api_model->get_data('product_id = "'.$priceDetails[0]['product_id'].'" AND user_type = "'.$user_type.'" AND users_id = "'.$users_id.'"', 'product_cart', '', 'count(id) as count, qty')){
                        $value['product_user_cart'] = $product_user_like[0]['count'];
                        $value['cart_qty'] = $product_user_like[0]['qty'] ? $product_user_like[0]['qty'] : 0;
                    }else{
                        $value['product_user_cart'] = 0;
                        $value['cart_qty'] = 0;
                    }   
                }else{
                    $value['product_user_like'] = 0;
                    $value['product_user_cart'] = 0;
                }
                $imagePath = explode(',', $value['images']);
                $i=0;
                foreach($imagePath as $im){
                    if($im){
                        $image[$i]=  IMAGE_PATH.'harpahu_merge/uploads/product/'.$im;
                        $i++;
                    }
                }
                $value['product_images'] = $image;
                $mainData[] =   $value;
            }
            $json['success']  = TRUE;
            $json['data'] =$mainData;
            if($category != ''){
                $lang = $this->product_cat($category,'',$la);
            }else{
                $lang = $this->product_category_show($section, $la);
            }
            $json['category'] = $lang ? $lang : [];
            $count = $this->api_model->get_data(''.$where.' isactive = "1"', 'product','','count(id) as count');
            $json['count'] = $count[0]['count'];
        }else{
            $json['success']  = false;
            $json['error'] = "No Product Found";
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function product_cat($cat_id, $id, $lang_array){
        $pro_data = $this->api_model->product_cat_id($cat_id);
        //print_r($pro_data);
        $i=0;
        foreach($pro_data as $pro){
            $json[$i]['id'] = $pro['id'];
            $json[$i]['name'] = $lang_array[$pro['cat_name']];
            $json[$i]['image'] = base_url('uploads/product_category').'/'.$pro['image'];
            $json[$i]['sub_category'] = $this->product_cat($pro['id'], $id, $lang_array) ? $this->product_cat($pro['id'], $id, $lang_array) : [];
            $i++;
        }
        return $json;
    }
    public function product_category_show($id, $lang_array){
        $category = $this->api_model->get_category_main($id, $lang_array);
        $i=0;
        foreach($category as $cat){
            $json[$i]['id'] = $cat['id'];
            $json[$i]['name'] = $lang_array[$cat['cat_name']];
            $json[$i]['image'] = base_url('uploads/product_category').'/'.$cat['image'];
            $json[$i]['sub_category'] = $this->product_cat($cat['id'], $id, $lang_array) ? $this->product_cat($cat['id'], $id, $language, $lang_array) : [];
            $i++;
        }
        return $json;
    }
    public function add_like(){ 
        $data['product_id'] = $this->input->get_post('product_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['pack_id'] = $this->input->get_post('pack_id');
        $data['pack_price'] = $this->input->get_post('pack_price');
        $data['qty'] = $this->input->get_post('qty');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($pro = $this->api_model->get_data('product_id = "'.$data['product_id'].'" AND users_id = "'.$data['users_id'].'"',  'product_like')){
            if($this->api_model->removeproductlike($pro[0]['id'])){
                $json['success']  = TRUE;
                $json['flag']  = '0';
                $json['msg'] ="Remove from Wishlist";
            }else{
                $json['success']  = false;
                $json['error'] = "database problem";
            }
        }else{
            if($this->api_model->submit('product_like', $data)){
                $json['success']  = TRUE;
                $json['flag']  = '1';
                $json['msg'] ="Added to Wishlist";
            }else{
                $json['success']  = false;
                $json['error'] = "database problem";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function add_cart(){ 
        $data['product_id'] = $this->input->get_post('product_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['pack_id'] = $this->input->get_post('pack_id');
        $data['pack_price'] = $this->input->get_post('pack_price');
        $data['qty'] = $this->input->get_post('qty');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($pro = $this->api_model->get_data('product_id = "'.$data['product_id'].'" AND users_id = "'.$data['users_id'].'"',  'product_cart')){
           // print_r($pro);
            if($pro[0]['qty'] != $data['qty']){
                $update['qty'] = $data['qty'];
                if($this->api_model->update('id', $pro[0]['id'], 'product_cart', $update)){
                    $json['success']  = TRUE;
                    $json['flag']  = '1';
                    $json['msg'] ="Your cart list has been updated";
                    //$json['msg'] ="Remove from Cart List";
                }
            }else{
                if($this->api_model->removeproductcart($pro[0]['id'])){
                    $json['success']  = TRUE;
                    $json['flag']  = '0';
                    $json['msg'] ="Remove from Cart List";
                }else{
                    $json['success']  = false;
                    $json['error'] = "database problem";
                }
            }
        }else{
            $count = $this->api_model->get_data('users_id = "'.$data['users_id'].'" AND user_type = "'.$data['user_type'].'"', 'product_cart', '', 'count(id) as count');
            if($count[0]['count'] < '1'){
                if($this->api_model->submit('product_cart', $data)){
                    $json['success']  = TRUE;
                    $json['flag']  = '1';
                    $json['msg'] ="Added to Cart List";
                }else{
                    $json['success']  = false;
                    $json['error'] = "database problem";
                }
            }else{
                $json['success']  = false;
                $json['error'] = "Only one item can be added to cart at a time";
            }
        }
        //print_r($data);
        $cart_item = $this->get_cart_product($data['users_id'], $data['user_type'], '1');
        //print_r($cart_item);
        if($cart_item['data']){
            $json['data'] = $cart_item['data'];
            $json['product_cost'] = $cart_item['product_cost'];
        }else{
            $json['data'] = [];
            $json['product_cost'] = null;
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    function remove_cart(){
        $product_id = $this->input->get_post('product_id');
        $user_id = $this->input->get_post('user_id');
        $type = $this->input->get_post('type');
        $where = '';
        if($product_id != ''){
            $where = ' AND product_id = "'.$product_id.'"';
        }
            if($this->api_model->own_query('DELETE FROM product_cart WHERE users_id = "'.$user_id.'" AND user_type = "'.$type.'" '.$$where.'')){
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
    function my_order(){
        $users_id = $this->input->get_post('users_id');
        $type= $this->input->get_post('type');
        if($data = $this->api_model->get_data('users_id = "'.$users_id.'" AND user_type = "'.$type.'"' , 'product_order', 'id DESC', '*')){
            $detail = [];
            foreach($data as $da){
                $address = $this->api_model->get_data('address_id = "'.$da['address_id'].'"','address_mst');
                $package_detail = $this->api_model->get_data('id = "'.$da['package_id'].'"','product_package');
                $product_detail = $this->api_model->get_data('id = "'.$da['product_id'].'"','product');
                $da['mobile'] = $address[0]['mobile'];
                $da['package_name'] = $package_detail[0]['name'];
                $da['product_name'] = $product_detail[0]['name'];
                $da['coutomer_name'] = $address[0]['fullname'];
                $da['address1'] = $address[0]['address1'];
                $da['address2'] = $address[0]['address2'];
                $da['city'] = $address[0]['city'];
                $da['district'] = $address[0]['district'];
                $da['invoice'] = base_url().'api/product_invoice/'.$da['id'];
                $imagePath = explode(',', $product_detail[0]['images']);
                $i=0;
                foreach($imagePath as $im){
                    if($im){
                        $image[$i]=  IMAGE_PATH.'harpahu_merge/uploads/product/'.$im;
                        $i++;
                    }
                }
                $da['product_images'] = $image;
                $detail[] = $da;
            }
            $json['success'] = true;
            $json['data'] = $detail;
        }else{
            $json['success'] = false;
            $json['error'] = 'Your Order List is Empty';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function get_product_pak_rate(){
        $product_id = $this->input->get_post('product_id');
        $type = $this->input->get_post('type');
        $select = '';
        if($type = '1'){
            $select = ',pr.sale_price as price';
        }else{
            $select = ',pr.vt_sale_price as price';
        }
        if($data = $this->api_model->query_build('select pr.id, pp.name '.$select.' from product_pack_rate as pr, product_package as pp where pp.id = pr.pack_id AND pr.product_id = "'.$product_id.'"')){
            $json['success'] = true;
            $json['data'] = $data;
        }else{
            $json['success'] = false;
            $json['error'] = 'No Package Found';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function get_product_cal(){
        $price = $this->input->get_post('price');
        $qty = $this->input->get_post('qty');
        $product_id = $this->input->get_post('product_id');
        $total_price += $price * $qty;
        $product = $this->api_model->get_data('id = "'.$product_id.'"','product');
        //$tax = $this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage'); 
        $app_tax += ($price * $qty)*($product[0]['gst']/100);
        $json['success'] = true;
        $json['product_cost']['product_sub_total'] = $total_price;
        $json['product_cost']['product_tax_total'] = $app_tax;
        $json['product_cost']['product_total'] = $total_price + $app_tax;
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function get_review(){
        $product_id = $this->input->get_post('product_id');
        $lim = $this->input->get_post('limit');
         if($lim == ''){
         $lim = 2000;
        }
        if($data = $this->api_model->get_data('product_id = "'.$product_id.'" AND is_active = "1" LIMIT 0,'.$lim.'', 'products_reviews as pr','','*, (select full_name from users where users_id = pr.user_id) as users_name')){
            $json['success'] = true;
            $json['data'] = $data;
        }else{
            $json['success'] = false;
            $json['error'] = 'No Review Found';
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function insert_review(){
        $data['product_id'] = $this->input->get_post('product_id');
        $data['user_id'] = $this->input->get_post('users_id');
        $data['description'] = $this->input->get_post('description');
        $data['rating'] = $this->input->get_post('rating');
        if($data['product_id'] == ''){
            $json['success']  = false;
            $json['error'] = "Please Send Product Id";
        }else if($data['user_id'] == ''){
            $json['success']  = false;
            $json['error'] = "Please Send User Id";
        }else if($data['description'] == ''){
            $json['success']  = false;
            $json['error'] = "Please Send Description";
        }else if($data['rating'] == ''){
            $json['success']  = false;
            $json['error'] = "Please Send Rating";
        }else{
            $data['is_active'] = '1';
             $data['date'] = date('Y-m-d');             
            if($this->api_model->submit('products_reviews', $data)){
                $json['success'] = true;
                $json['msg'] = 'Review has been successfully submited';
            }else{
                $json['success']  = false;
                $json['error'] = "database problem";
            }
        } 
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function cash_on_delivery(){
            // print_r($_REQUEST);
            // exit;
            $order_type = '0';
            $purchase_id = $this->input->get_post('shopping_order_id');
           // $row = $this->api_model->get_data('id = "'.$purchase_id.'"', 'log_file');
            $update['payment_type'] = 'Dr';
            $update['status'] = '2';
            $update['transaction_id'] = $purchase_id;  
            $this->api_model->update('id', $purchase_id, 'log_file', $update);
            $wallet = $this->input->get_post('wall');
            $product_id = json_decode($this->input->get_post('product_id')); 
            //$product_id = explode(',',$product_id);
            $package_id = json_decode($this->input->get_post('package_id'));
            //$package_id = explode(',',$package_id);
            $package_price = json_decode($this->input->get_post('package_price'));
            //$package_price = explode(',',$package_price);
            $user_type = $this->input->get_post('user_type');
            $address_id = $this->input->get_post('address_id');
            $users_id = $this->input->get_post('users_id');
            $product_qty = json_decode($this->input->get_post('product_qty'));
            //$product_qty = explode(',',$product_qty);
            $date = date('Y-m-d h:i:s');
            $i = 0;
            // print_r($package_price);
            //exit;
            // print_r($_REQUEST);
            // exit;
            if($wallet > 0){
                $wall['log_id'] = $purchase_id;
                $wall['users_id'] = $users_id;
                $wall['type'] = '14';
                $wall['amount'] = $wallet;
                $wall['status'] = 'Dr';
                $wall['wallet_type'] = '1';
                $wall['date'] = $date;
                $this->api_model->submit('livestoc_wallets', $wall);
            }
            foreach($product_id as $pur){
                //$price = ($package_price[$i] * $product_qty[$i]) + (($package_price[$i] * $product_qty[$i]) * ($product[0]['gst']/100));
                // echo $price;
                // exit;
                $product = $this->api_model->get_data('id = "'.$pur.'"','product');
                    $dis = '';
                     // print_r($product);
                     //    exit;
                    if($product[0]['livestoc_status'] == '1'){
                        $address = $this->api_model->get_data('address_id = '.$address_id.'', 'address_mst');
                        $admin_data = $this->api_model->get_data(' FIND_IN_SET('.$address[0]['district_id'].', service_district) AND (type = 32 or type = 33)', 'admin');
                        // print_r($admin_data);
                        // exit;
                        $k = 0;
                        $y = 0;
                        $dist = 0;
                        $dist1 = 0;
                        foreach($admin_data as $ad){
                            if($ad['type'] = '32'){
                                if($k == '0'){
                                    $dist1 = $ad['admin_id'];
                                }else{
                                    $dist1 .= ','. $ad['admin_id'];
                                }
                                $k++;
                            }
                            // if($ad['type'] = '33'){
                            //     if($y == '0'){
                            //         $dist1 = $ad['admin_id'];
                            //     }else{
                            //         $dist1 = '1'.$ad['admin_id'];
                            //     }
                            //     $y++;
                            // }
                            $title = 'New Order';
                            $msg1 = 'you have new order.Please check the App.';
                            $msg['users_id'] = $ad['admin_id'];
                            $msg['title'] = $title;
                            $msg['message'] = $msg1;
                            $msg['date'] = date('Y-m-d h:i:s');
                            $msg['type'] = '4';
                            $msg['isactive'] = '1';
                            $msg['flag'] = '4';
                            $this->api_model->user_notification($msg);
                            $old_msg['to_users_id'] = $ad['admin_id'];
                            $old_msg['to_id'] = $ad['admin_id'];
                            $old_msg['to_type'] = 'Dealer';
                            $old_msg['title'] = $title;
                            $old_msg['from_type'] = 'Livestoc Team';
                            $old_msg['success'] = '1';
                            $old_msg['device'] = 'android';
                            $old_msg['active'] = '1'; 
                            $old_msg['description'] = $msg1;
                            $old_msg['date_added'] = date('Y-m-d h:i:s');
                            $this->api_model->old_notification($old_msg);
                            $this->simple_push_none($ad['admin_id'], 3 , $title, '1', $msg1);
                        }
                        //$transporter_level1 = $this->api_model->query_build('select');
                    }else{
                        if($product[0]['hub'] == '0'){
                            $distributer = $this->api_model->query_build('SELECT `admin_id`, IFNULL(( 3959 * acos( cos( radians('.round($_REQUEST['latitude'], 4).') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('.round($_REQUEST['langitude'], 4).') ) + sin( radians('.round($_REQUEST['latitude'], 4).') ) * sin( radians( latitude ) ) ) ), 0) AS distance FROM `admin` WHERE `super_admin_id` = '.$product[0]['user'].' having distance < 10');
                            //$distributer = $this->api_model->get_data("super_admin_id = ".$product[0]['user']." HAVING distance < 10", 'admin','','admin_id, IFNULL(( 3959 * acos( cos( radians('.round($_REQUEST['latitude'], 4).') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('.round($_REQUEST['langitude'], 7).') ) + sin( radians('.round($_REQUEST['latitude'],4).') ) * sin( radians( latitude ) ) ) ),0) AS distance');
                            $i = 0;
                            foreach($distributer as $dist){
                                if($i == 0){
                                    $dis = $dist['admin_id'];
                                }else{
                                    $dis .= ','.$dist['admin_id'];
                                }
                                $i++;
                            }
                            $title = 'New Order';
                            $msg1 = 'you have new order.Please check the App.';
                            $msg['users_id'] = $users_id;
                            $msg['title'] = $title;
                            $msg['message'] = $msg1;
                            $msg['date'] = date('Y-m-d h:i:s');
                            $msg['type'] = '4';
                            $msg['isactive'] = '1';
                            $msg['flag'] = '4';
                            $this->api_model->user_notification($msg);
                            $old_msg['to_users_id'] = $dist['admin_id'];
                            $old_msg['to_id'] = $dist['admin_id'];
                            $old_msg['to_type'] = 'Dealer';
                            $old_msg['title'] = $title;
                            $old_msg['from_type'] = 'Livestoc Team';
                            $old_msg['success'] = '1';
                            $old_msg['device'] = 'android';
                            $old_msg['active'] = '1'; 
                            $old_msg['description'] = $msg1;
                            $old_msg['date_added'] = date('Y-m-d h:i:s');
                            $this->api_model->old_notification($old_msg);
                            $this->simple_push_none($dist['admin_id'], 3 , $title, '1', $msg1);
                        }
                    }
                $pri_row = $this->api_model->get_data('id = "'.$package_id[$i].'"', 'product_pack_rate');
                if($user_type == 0){
                    $price = $pri_row[0]['sale_price'];
                }
                else{
                    $price = $pri_row[0]['vt_sale_price'];
                }
                if($product_offer = $this->api_model->get_data('product_pack = "'.$package_id[$i].'" AND product_id = "'.$pur.'"', 'product_offer')){
                    $wall['log_id'] = $purchase_id;
                    $wall['users_id'] = $users_id;
                    $wall['type'] = '14';
                    $wall['animal_id'] = $pur;
                    $wall['amount'] = $product_offer[0]['discount_wallet'];
                    $wall['status'] = 'Cr';
                    $wall['wallet_type'] = '1';
                    $wall['date'] = $date;
                    $this->api_model->submit('livestoc_wallets', $wall);
                }
                $date = date('Y-m-d h:i:s');
                $order['log_id'] = $purchase_id;
                $order['product_id'] = $pur;
                $order['distributor_id'] = $dis;
                $order['delivery_partner'] = $dist1;
                $order['address_id'] = $address_id;
                $order['delivery_partner_level2'] = '0';
                $qty = $product_qty[$i];
                $order['product_qty'] = $qty;
                $order['users_id'] = $users_id;
                $order['package_id'] = $package_id[$i];
                $tax =$this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage'); 
                $price = ($package_price[$i] * $qty) + (($package_price[$i] * $qty) * ($product[0]['gst']/100));
                $order['package_price'] = $price;
                $order['user_type'] = $user_type;
                $order['otp'] = rand(1000,9999);
                $order['latitude'] = $_REQUEST['latitude'];
                $order['longitude'] = $_REQUEST['langitude'];
               
                $order['isactive'] = '0';
                $order['update_date'] = $date;
                $order['order_type'] = $order_type;
                $order['date'] = $date;
                $this->api_model->submit('product_order', $order);
                if($dis != ''){
                    $msg1 = 'you have new order.Please check the App';
                    $flag ='2';
                    $msg['users_id'] = $dis;
                    $msg['title'] = 'you have new order.Please check the App';
                    $msg['message'] = $msg1;
                    $msg['date'] = date('Y-m-d h:i:s');
                    $msg['type'] = '2';
                    $msg['isactive'] = '1';
                    $msg['flag'] = '2';
                    $msg['doctor_id'] = $dis;
                    // print_r($msg);
                    // exit;
                    $this->api_model->user_notification($msg);
                    $this->oder_push_non($user_id,$doctor_id,  2, $title , $flag, DEALER_APP_SERVERKEY, DEALER_IOS_SERVERKEY, $msg1);
                }
                $i++;
                $this->api_model->own_query('DELETE FROM product_cart where users_id = "'.$users_id.'" AND product_id = "'.$pur.'"'); 
            }
            $json['success'] = true;
            $json['msg'] = 'Your order has been successfully Placed';
            header('Content-Type: application/json');
            echo json_encode($json);
            exit;
    }
     function send_push_none(){
        $id = $this->input->get_post('id');
        $type = $this->input->get_post('type');
        $title = $this->input->get_post('title');
        $flag = $this->input->get_post('flag');
        $msg = $this->input->get_post('msg');
        $this->simple_push_none($id, $type , $title, $flag, $msg);
    }
     public function simple_push_none($user_id, $type , $title, $flag = 0, $msg){
        if($type == 1){
            $detail = $this->api_model->get_fcm_doc($user_id);
            $server_key = PARAVATE_SERVERKEY;
        }else if($type == 2){
            $detail = $this->api_model->get_fcm_user($user_id);
            $server_key = LIVESTOCK_AND_SERVERKEY;
        }else if($type == 3){
            $detail = $this->api_model->get_fcm_admin($user_id);
            $server_key = DEALER_APP_SERVERKEY;
            $detail[0]['fcm_android'] = $detail[0]['fcm_and'];
            $detail[0]['fcm_ios'] = $detail[0]['fcm_IOS'];
        }else{
            $detail = $this->api_model->get_fcm_user($user_id);
            $server_key = COUSTOMER_SERVERKEY;
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
                                                $result = curl_exec($curl_session);
        }if($detail[0]['fcm_ios'] != ''){
                                            $key = IOS_COUSTOMER_SERVERKEY;
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
        //return $result;
    }
}