<?php
class Homenew extends CI_Controller {
    public $webLanguage;
	public function __construct() {
        parent::__construct();
        $this->load->model('front_end_model');
        $this->load->model('api_model');
        $this->load->model('Admin_detail');
        $this->load->model('login_cheak_model');
        $this->load->model('loginmodel');
        $this->load->model('pushnoti_model');
        $this->load->library('pagination');
        if($_SESSION['language']){
            $lang = $_SESSION['language'];
        }else{
            $lang = 'en';
        }
        $this->webLanguage = $this->language_left->get_language($lang);        
    }
    public function test(){
        echo "this is test";
        $countUserIntrested = $this->api_model->get_data('video_id = "19"' , 'video_interest', '', 'count(id) as count'); 
        print_r($countUserIntrested);
        exit;
       
    }
    public function index($id = 0, $cat_id = 0){
        $category = $this->input->get_post('category_id');
        $sec = $this->api_model->get_section($category);
        //print_r($sec);
        //print_r($sec);
        $cat = $category;
        if($category == '0' || $category == ''){
            $category  = '0';
        }else{
            $category  =  $sec[0]['category'];
        }
        $user_id =  $this->session->userdata('users_id');
        $language = $this->session->userdata('language');
        $state_id = $this->input->get_post('state_id');
        $state_name = $this->input->get_post('state_name');
        //$state_name = $this->input->get_post('state_name');
        //if($language != '' || $state_id != '' || $state_name != ''){
            $data = $this->api_model->get_data('section_id = "'.$category.'"','dashboard_crone','','value');
            if(!empty($data)){
                $json  = $data[0]['value']; 
            }else{
                $json['success']  = false; 
                $json['error']  = 'No data found'; 
            }
            $jd = (json_decode($json, true));
            $fullDatabaseValues = $jd;
        // }else{
        //     $fullDatabaseValues = $this->get_dashboard_list($category, $user_id, $language,  $state_id , $state_name, $cat);
        // }
        // print_r($fullDatabaseValues);
        $fullDatabaseValues['category'] = $category;
        $fullDatabaseValues['data']['sec_id'] = $category;
        $fullDatabaseValues['data']['stateList'] = $this->api_model->get_state("99"); 
        $fullDatabaseValues['data']['state_id'] = $state_id;
        $fullDatabaseValues['data']['state_name'] = $state_name;
        $users_id = $user_id;
        $amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
        $amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
        $detail =[];
        // foreach($amount_cr as $a){

        $a['real_balance'] = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
        $amoun_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
        $amoun_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
        $a['livestoc_balence'] = $amoun_cr[0]['amount'] - $amoun_dr[0]['amount'];
        $fullDatabaseValues['data']['wallet'] =   $a['livestoc_balence'];
        $fullDatabaseValues['data']['real_balance'] =   $a['real_balance'];
        $fullDatabaseValues['data']['webLanguage'] = $this->webLanguage;
        //print_r($this->webLanguage);
        /*echo "<pre>";
        print_r($fullDatabaseValues);*/
        $this->load->view('home/product/header');
        $this->load->view('home/product/home', $fullDatabaseValues);
        
    }
    public function get_dashboard_list($category, $user_id, $language,  $state_id , $state_name, $cat){
       // print_r($_REQUEST['category_id']);
        // exit;
        /*$category = $this->input->get_post('category_id');
        if($category == '0'){
            $category  = '';
        }
        $user_id = $this->input->get_post('user_id');
        $language = $this->input->get_post('language');
        $state_id = $this->input->get_post('state_id');
        $state_name = $this->input->get_post('state_name');*/
        $sale_animal = $this->api_model->get_animals($category, 1, 8, $users_type_id, '1','');
        
        if($category == '1,8' || $category =='0' || $category == ''){           
                $json['data']['user_sell_semen'] = '1';
                $json['data']['show_livestoc_lab'] = '1';               
                }else{
                    $json['data']['user_sell_semen'] = '0';
                    $json['data']['show_livestoc_lab'] = '0';
                }
        
        // if($category == '2'){
        //  $category  = '';
        // }
        $semen_banner = $this->api_model->get_featured_semen($category, 0, 2);
        // print_r($semen_banner);
        // exit;
        $get_information_banners = $this->api_model->get_information_banners($category, 1, 4, 'dashboard');
        //$get_dog_cat_banners = $this->api_model->get_dog_cat_banners($category, 1, 4, 'dashboard');
        $get_information_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 1);
        //$get_featured_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 2);
        $get_featured_videos = $this->api_model->get_featured_videos($category, $start, $perpage, 2);
        $get_featured_product = $this->api_model->get_featured_product($category, $start, $perpage, 1);
        $get_articles = $this->api_model->get_articles($category, 1, 5, 1, $user_id);
        $get_dog_cat_banner = $this->api_model->get_dog_cat_banner($category, $start, $perpage);
        $get_animal_services = $this->api_model->get_animal_services($category, $start, $perpage);

        $get_events = $this->api_model->get_events($category, $start, $perpage);
        $get_featured_feed = $this->api_model->get_information_banners($category, $start, $perpage, 'feed');
        $get_featured_mineral_mixtures = $this->api_model->get_information_banners($category, $start, $perpage, 'mixtures');
        $get_featured_equipment = $this->api_model->get_information_banners($category, $start, $perpage, 'equipment');
        $get_featured_sinage = $this->api_model->get_featured_sinage($category, $start, $perpage);
        $featured_animal = $this->api_model->get_animals($category, 1, 5, $users_type_id, '2', '');
        $cat = $category;
        $dealer_animal = $this->api_model->get_animals($category, 1, 5, 5, "'1','2'", '');
        // echo "<pre>";
        // print_r($dealer_animal);
        // exit;
        $breeder_animal = $this->api_model->get_animals($category, 1, 5, 4, "'1','2'", '');
        // echo "<pre>";
        // print_r($breeder_animal);
        // exit;
        $ai_worker = $this->api_model->doc_premium_type("'pvt_ai', 'pvt_vt'");  
        //echo $category;`
        $doc_worker = $this->api_model->doc_premium_type("'repeat_breading', 'animal_nutrition'");

        //video tutorials
       
        $video_tutorials = $this->Admin_detail->get_last_three_video_block($cat);
       
        $get_featured_product_new = $this->front_end_model->get_produc_with_price_and_details($_REQUEST['category_id'], 1, '1');
            
        if($cat == '4' || $cat == '9')
        {
            $sec_id = '';
            //print_r($sec_id);
        }else{
            $sec_id = '';
        }
        if($cat == '3,14'){
            $home_doc_worker = $this->api_model->doc_premium_type("'expert_in_medicine','vet_surgeon','animal_nutrition'", '',$sec_id);
        }else if($cat == '7,10'){
            $home_doc_worker = $this->api_model->doc_premium_type("'expert_in_medicine','vet_surgeon','repeat_breading', 'animal_nutrition'", '',$sec_id);
        }else if($cat == '4' || $cat == '9'){
            $home_doc_worker = $this->api_model->doc_premium_type("'Nutrition'", '',$sec_id);
            //print_r($sec_id);
        }else if($cat == '5'){
            $home_doc_worker = $this->api_model->doc_premium_type("'animal_nutrition'", '',$sec_id);
            //print_r($sec_id);
        }else{
            $home_doc_worker = $this->api_model->doc_premium_type("'veternary_doctor', 'farm_automation','expert_in_medicine','vet_surgeon','repeat_breading','animal_nutrition'", '',$sec_id);
        }
        //echo $sec_id;
        
        //print_r($home_doc_worker);
        // $section = $this->api_model->get_section();
        $section = $this->api_model->get_product_cat();
        $home_doc=[];
        // echo utf8_decode($get_articles[1]->title);
        // echo "<pre>";
         // print_r($section);
        // exit;
        $json['data']['livestoc_lab_price'] = LAB_PRICE;
        foreach($home_doc_worker as $home){
            $home['image'] = IMAGE_PATH.'uploads/doctor_type/doctor.png'; 
            $home_doc[] = $home;
        }
        $sequence_order =[];//array("featured_animal","sale_animal","featured_feed","featured_mineral_mixtures","featured_equipment","information_banners","information_videos", "featuredproduct_videos","featured_product","articles","events","dealer_animal","breeder_animal");
        if ($featured_animal || $home_doc_worker|| $sale_animal || $get_information_videos || $get_information_banners || $get_featured_videos || $get_featured_product || $get_articles || $get_events) {
            $json['success'] = TRUE;
            if($category == '1,8' || $category =='0' || $category == '2' || $category == ''){
                if(!empty($semen_banner))
                {
                $json['data']['featured_semen'] = $semen_banner;
                //$sequence_order[] = 'featured_semen';
                }
            }
            
            //print_r($home_doc_worker);    
            if($category == '3,14'){
                if(!empty($expert_in_medicine))
                    {
                    $json['data']['expert_in_medicine'] = $expert_in_medicine;
                    //$sequence_order[] = 'expert_in_medicine';
                    }
                    $sequence_order[] = 'dog_mating';
                    $sequence_order[] = 'Dog_list_mating';
                }
            if(!empty($sale_animal))
            {
             $json['data']['sale_animal'] = $sale_animal;
             $sequence_order[] = 'sale_animal';
            }
            $sequence_order[] = 'sell_Your_Animal';
            $sequence_order[] = 'Happiness';
            $sequence_order[] = 'register_dealer_breeder';
            $sequence_order[] = 'search';
            
            if($category =='0' || $category =='' || $category =='4' || $category =='9' || $category =='7,10' || $category =='3,14' || $category == '1,8' || $category == '5'){
                if(!empty($home_doc_worker)){
                    $json['data']['home_doc_worker'] = $home_doc;
                    //$sequence_order[] = 'home_doc_worker';
                }
            }
            if($category != '5' && $category != '4' && $category != '9'){
                //$sequence_order[] = 'ai_reqest';
                if(!empty($get_information_banners))
                {
                $json['data']['information_banners'] = $get_information_banners;
                $sequence_order[] = 'information_banners';
                }
            }
            if($category == '1,8' || $category == ''){
                $sequence_order[] = 'sale_bull_semen';
            }
            // Static value
            $json['data']['breeder_price'] = '5999';
            $json['data']['mating_price'] = '5999';
            $json['data']['add_bull_price'] = '5999';
            $json['data']['pregnancy_test_price'] = LAB_CHARGES;
            $json['data']['pregnancy_sample_helpline'] = HELP_LINE;
            // end static value
            if(!empty($get_featured_product))
            {
             $json['data']['featured_product'] = $get_featured_product;
             $sequence_order[] = 'featured_product';
            }
            //$json['data']['information_banners'] = $get_information_banners;
            if($category != '3,14' && $category != '7,10' && $category != '2' && $category != '5' && $category != '4' && $category != '9'){
                if($category == '1,8' || $category =='0' || $category == '' || $category == '7,10'){
                    if(!empty($ai_worker)){
                        $json['data']['ai_worker'] = $ai_worker;
                        //$sequence_order[] = 'ai_worker';
                    }
                }

            }
            if($category == '3,14'){
                if(!empty($get_dog_cat_banner))
                {
                 $json['data']['dog_mating'] = $get_dog_cat_banner;
                 //$sequence_order[] = 'dog_mating';
                }
            }
            if(!empty($get_animal_services))
                {
                 $json['data']['animal_services'] = $get_animal_services;
                 //$sequence_order[] = 'dog_mating';
                }
            
            if(!empty($section))
            {
             $json['data']['other_primum_list'] = $section;
             //$sequence_order[] = 'other_primum_list';
            }
            //$sequence_order[] = 'knowledge_bank';
            if(!empty($get_articles))
            {
             $json['data']['articles'] = $get_articles;
             $sequence_order[] = 'articles';
            }
            // dog Image
            if(!empty($featured_animal))
            {
             $json['data']['featured_animal'] = $featured_animal;
            // $sequence_order[] = 'featured_animal';
            }
            if($category == '1,8' || $category =='0' || $category == ''){           
                if(!empty($doc_worker)){
                    $json['data']['doc_worker'] = $doc_worker;
                    //$sequence_order[] = 'doc_worker';             
                }
            }           
            // if(!empty($get_featured_mineral_mixtures))
            // {
            //  $json['data']['featured_mineral_mixtures'] = $get_featured_mineral_mixtures;
            //  //$sequence_order[] = 'featured_mineral_mixtures';
            // }
            // if(!empty($get_featured_equipment)){
            //  $json['data']['featured_equipment'] = $get_featured_equipment;
            //  //$sequence_order[] = 'featured_equipment';
            // }
            // if($category == '3,14'){
            //  if(!empty($get_dog_mating)){
            //      $json['data']['get_dog_matingred_feed'] = $get_dog_mating;
            //      //$sequence_order[] = 'get_dog_mating';
            //  }
            // }            
            if(!empty($get_information_videos))
            {
             $json['data']['information_videos'] = $get_information_videos;
             //$sequence_order[] = 'information_videos';
            }
                        
            // if(!empty($get_featured_sinage)){
            //  $json['data']['featured_silage'] = $get_featured_sinage;
            //  //$sequence_order[] = 'featured_silage';
            // }
            if(!empty($get_featured_videos))
            {
             $json['data']['featuredproduct_videos'] = $get_featured_videos;
            // $sequence_order[] = 'featuredproduct_videos';
            }else{
                $json['data']['featuredproduct_videos'] = [];
                //$sequence_order[] = 'featuredproduct_videos';
            }
            // if(!empty($get_dog_cat_banners))
            // {
            //  $json['data']['get_dog_cat_banners'] = IMAGE_PATH.'uploads/doctor_type/doctor1.png';
            // // $sequence_order[] = 'get_dog_mating';
            // }else{
            //  $json['data']['get_dog_cat_banners']['image'] = IMAGE_PATH.'uploads/doctor_type/doctor1.png';
            //  //$json['data']['name'] = [];
            //  //$sequence_order[] = 'get_dog_mating';
            // }
            // foreach($get_dog_cat_banners as $dog){
            //  $dog['image'] = IMAGE_PATH.'uploads/doctor_type/doctor.png'; 
            //  $doc_image[] = $dog;
            // }
            if(!empty($dealer_animal))
            {
             $json['data']['dealer_animal'] = $dealer_animal;
             //$sequence_order[] = 'dealer_animal';
            }
            if(!empty($breeder_animal))
            {
             $json['data']['breeder_animal'] = $breeder_animal;
             //$sequence_order[] = 'breeder_animal';
            }       
            if(!empty($get_events))
            {
             $json['data']['events'] = $get_events;
             //$sequence_order[] = 'events';
            }
            // if($category == '3,14'){
            //  $json['sequence_order'] = array('animals','search','home_doc','ai_request','ai_worker_list','other_primum_list','knowledge','artical');
            // }else if($category == '5'){
            //  $json['sequence_order'] = array('search','home_doc','ai_request','ai_worker_list','other_primum','knowledge','artical');
            // }else{
                 $json['sequence_order'] = $sequence_order;
            //}
            if(!empty($video_tutorials)) {
                $dem = [];
                foreach($video_tutorials as $d){
                    $d['video_thumb'] = isset($d['video_thumb']) ? base_url()."uploads/videos/images/".$d['video_thumb'] : '';
                    $d['video'] = isset($d['video']) ? base_url()."uploads/videos/".$d['video'] : '';
                    $dem[] = $d;
                }
                $json['data']['video_tutorials'] = $dem;
            }
            if(!empty($get_featured_product_new))
            {
                $json['data']['featured_product_new'] = $get_featured_product_new;
                $sequence_order[] = 'featured_product_new';
            }
        } else {
            $json['success'] = FALSE;
            $json['error'][] = "Listing Not Available";
        }
        // echo "<pre>";
        // print_r($json);
        /*header('Content-Type: application/json');
        echo json_encode($json);
        exit;*/
        return $json;
    }
    public function bull_detail($i){
        $bull_detail = $this->api_model->get_data('id = "'.$i.'"' , 'bull_table', '', '*'); 
        $data['data'] = $bull_detail;
        $this->load->view('home/product/header');
        $this->load->view('home/product/bull_detail', $data);
    }
    public function animal_details($id){
    	$animal_detail = $this->api_model->get_data('animal_id = "'.$id.'"' , 'animals as ani', '', 'animal_id,no_nipples,is_pregnant,users_id,category_id,(SELECT category from category where category_id = ani.category_id) as cat_name,(SELECT weight from category where category_id = ani.category_id) as weight,(SELECT breed_name from breed where breed_id = ani.breed_id) as breed_name,(select fathers_breed from animals_detail where animal_id = ani.animal_id) as fathers_breed,(select animal_age from animals_detail where animal_id = ani.animal_id) as age,(select color from animals_detail where animal_id = ani.animal_id) as color,(select mothers_breed from animals_detail where animal_id = ani.animal_id) as mothers_breed,(select mothers_breed from animals_detail where animal_id = ani.animal_id) as mothers_breed,(select herd from animals_detail where animal_id = ani.animal_id) as herd,(select height from animals_detail where animal_id = ani.animal_id) as height,(select pregnancy_month from animals_detail where animal_id = ani.animal_id) as pregnancy_month,(select animal_month from animals_detail where animal_id = ani.animal_id) as month,(select description from animals_detail where animal_id = ani.animal_id) as description,(select seller_contact  from animals_detail where animal_id = ani.animal_id) as Contact,(SELECT count(animal_like_id) as countlike FROM animal_like_list where animal_id = ani.animal_id) as likes,breed_id,fullname,gender,price,lactation,peak_milk_yield,address1,district,country,ispremium_date,state');
    	$data['data'] = $animal_detail; 
    	$this->load->view('home/product/header');
        $this->load->view('home/product/animal_details', $data);
    }
    public function get_city(){
        $state_id = $this->input->get_post('state_id');
        if(!isset($state_id) || $state_id == ''){
            echo "Please send state id";
        }else{
            $data = $this->front_end_model->get_city($state_id);
        }
        // print_r($data);
        // exit;
		header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    public function reset_pass($id){
        if(isset($_POST['submit'])){
        	$pass = $this->input->get_post('password');
        	$confirm = $this->input->get_post('cpassword');
        	$this->form_validation->set_rules('password','Please Fill Password','required|numeric');
        	$this->form_validation->set_rules('cpassword','Please Fill Confirm Password','required|numeric');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
	        	if($pass == $confirm){
	        		$data_ins['passcode'] = md5($pass);
	        		$id = $this->input->get_post('id');
	        		$this->api_model->update('users_id', $id, 'users', $data_ins);
	        		$this->session->set_flashdata('add_bank','Your Password Change You can Login');
	        		$data['id'] = $this->input->get_post('id');
		        	$this->load->view('front_end/product/header');
		        	$this->load->view('front_end/product/resetpass', $data);
	        		return redirect(base_url('frontend/login'));
	        	}else{
	        		$this->session->set_flashdata('add_bank','Confirm Password and Password should be same');
	        		$data['id'] = $this->input->get_post('id');
		        	$this->load->view('front_end/product/header');
		        	$this->load->view('front_end/product/resetpass', $data);
	        	}
	        }else{
	        	$data['id'] = $this->input->get_post('id');
		        $this->load->view('front_end/product/header');
		        $this->load->view('front_end/product/resetpass', $data);
	        }
        }else{
        	$data['id'] = $id;
        	$this->load->view('front_end/product/header');
        	$this->load->view('front_end/product/resetpass', $data);	
        }
    }
    public function  my_account(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/my_account');
    }
    public function  resend(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/resend');
    }
    public function  otp(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/otp');
    }
    public function  my_order(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/my_order');
    }
    public function all_review($id){
        $data['data'] = $this->front_end_model->get_product_id($id);
       $this->load->view('front_end/product/header');
       $this->load->view('front_end/product/allreview',$data);
    }
    public function get_premium_detail(){
        $data = $this->front_end_model->premium_type();
        $detail = [];
        foreach($data as $d){
            $d['benefits'] = $this->front_end_model->get_benefits($d['id']);
            $detail[] = $d;
        }
        $json['success'] = True;
        $json['data'] = $detail;
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function add_subscriber(){
        $data['email'] = $this->input->get_post('email');
        if($this->api_model->get_data('email ="'.$data['email'].'"', 'product_subscribe')){
            $error['msg'] = 'You are already subscribed';
        }else{
            if($this->api_model->submit('product_subscribe', $data)){
                $error['msg'] = 'You are subscribed';
            }else{
                echo "this is test";
            }
        }
        echo json_encode($error);
    } 
    public function semen_bull_listing(){
        $this->load->view('semen_bull_listing');
    }
    public function payment_success(){
        $this->load->view('registration_done');
    }
    public function get_user_by_ref(){
        $ref = $this->input->get_post('ref');
        $data = $this->front_end_model->get_user_by_ref_code($ref);
        echo json_encode($data);
    }
    public function get_refral_doc(){
        $users_id = $this->input->get_post('users_id');
        if(!isset($users_id) || $users_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send users id";
        }else{
            if($data = $this->front_end_model->check_refral_code($users_id)){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.livestoc.com/harpahu_dhyan/animal/check_ref?ref=".$data[0]['doc_referal_by']."",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "postman-token: a8cfa165-6d9f-4bcb-c43a-1f69520cbf2c"
                ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $res = json_decode($response);
                if($res->success){
                    $data_w['name'] = $res->data->username;
                    $data_w['mobile'] = $res->data->mobile;
                    $data_w['mobile2'] = $res->data->mobile_2nd;
                    $url = 'https://www.livestoc.com/harpahu_dhyan/uploads/doc/'.$res->data->image;
                    $h = get_headers($url);
                    $status = array();
                    preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
                    if($status[1]==200){
                        $data_w['image'] = $url;
                    }else{
                        $data_w['image'] = 'https://www.livestoc.com/harpahu_dhyan/uploads/image/profile.jpg';
                    }
                    $json['success'] = true;
                    $json['data'] =  $data_w;
                    //$json['msg'] =  "Your Service provider has been successfully assoiciated with your Account";
                }else{
                    $json['success'] = False;
                    $json['error'] = "There is no service provider associated with your Account";
                }
            }else{
                $json['success'] = False;
                $json['error'] = "There is no service provider associated with your Account";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function cheak_refral_code(){
        $users_id = $this->input->get_post('users_id');
        $refral_id = $this->input->get_post('refral_id');
        if(!isset($users_id) || $users_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send users id";
        }else if(!isset($refral_id) || $refral_id == ''){
            $json['success'] = False;
            $json['error'] = "Please send refral id";
        }else{
            if($data = $this->front_end_model->check_refral_code($users_id, $refral_id)){
                    $json['success'] = False;
                    $json['error'] = "The Service Provider is already attached with you";
            }else{
                $data_ref = $this->front_end_model->check_refral_code($users_id);
                if($data_ref[0]['doc_referal_by'] == 0 || $data_ref[0]['doc_referal_by'] == ''){
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://www.livestoc.com/harpahu_dhyan/animal/check_ref?ref=".$refral_id."",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "postman-token: a8cfa165-6d9f-4bcb-c43a-1f69520cbf2c"
                    ),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $res = json_decode($response);
                    if($res->success){
                        $ref_data['doc_referal_by'] = $refral_id;
                        $this->front_end_model->update_referal_code($ref_data, $users_id);
                        $data['name'] = $res->data->username;
                        $data['mobile'] = $res->data->mobile;
                        $data['mobile2'] = $res->data->mobile_2nd;
                        $url = 'https://www.livestoc.com/harpahu_dhyan/uploads/doc/'.$res->data->image;
                        $h = get_headers($url);
                        $status = array();
                        preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
                        if($status[1]==200){
                            $data['image'] = $url;
                        }else{
                            $data['image'] = '';
                        }
                        $json['success'] = true;
                        $json['data'] =  $data;
                        $json['msg'] =  "Your Service provider has been successfully assoiciated with your Account";
                    }else{
                        $json['success'] = False;
                        $json['error'] = "Your referral code is not matched";
                    }
                }else{
                    $json['success'] = true;
                    $json['msg'] =  "Your request for updating Service Provider has been submited successfuly. After approval, it will be updated into your account.";
                }               
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    } 
    public function cart_sess(){
        $product_id = $this->input->get_post('product_id');
        $pack_id = $this->input->get_post('pack_id');
        $pack_price = $this->input->get_post('pack_price');
        $qty = $this->input->get_post('qty');
        $product_cart = array();
        $set = 0;
        if($this->session->userdata('cart_session')){
            $cart_session = $this->session->userdata('cart_session');
            foreach($cart_session as $id=>$val){
                if($val['product_id']==  $product_id){
                    $val['pack_id'] = $pack_id;
                    $val['pack_price'] = $pack_price;
                    $val['qty'] = $qty;
                    $set = 1;
                }
                $cart[$id] = $val;
            }
        } 
        if($set==0){
            $product_cart['product_id']  = $product_id;
            $product_cart['pack_id']  = $pack_id;
            $product_cart['pack_price'] = $pack_price;
            $product_cart['qty'] = $qty;
            $cart[] = $product_cart;
        }
        $this->session->set_userdata('cart_session', $cart);
        $cart_session = $this->session->userdata('cart_session');
        $arr = array();
        echo json_encode($cart_session );
}
    public function webhook(){
        $last_id = $this->input->get_post('last_id');
        $data['payment_status'] = '1';
        $this->front_end_model->register_data_update($data, $last_id);
    }
    public function animal_premium_status(){
        $purchase_id = $this->input->get_post('purchase_id');
        $users_id = $this->input->get_post('bank_id');
        $bull_id = $this->input->get_post('bull_id');
        $bull_price = $this->input->get_post('bull_price');
        $type = $this->input->get_post('type');
        $bull_id = json_decode($bull_id);
        $bull_price = json_decode($bull_price);
        $i = 0;
        foreach($bull_id as $bull){
            $data['ispremium'] = '1';
            $this->front_end_model->update_animal($data, $bull);
            $i++;
        }
    }
	public function get_product_category(){
		$data = $this->front_end_model->get_product_category();
		$json['success']  = true; 
		$json['data'] = $data;
		header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
	public function get_listing_data(){
		$id = $this->input->get_post('cat_id');
		$type = $this->input->get_post('type');
		$data = $this->front_end_model->get_listing_data_cat($id, $type);
		$detail = [];
		$im_data = [];
		foreach($data as $da){
			$image = explode(',',$da['images']);
			foreach($image as $im){
				$im_data[] = base_url()."uploads/register/".$im;
			}
			$da['images'] = $im_data;
			$detail[] = $da; 
		}
		if($data){
			$json['success']  = true; 
			$json['data'] = $detail;
		}else{
			$json['success']  = false; 
			$json['error'] = "No data found";
		}
		header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
    public function register(){
        if(isset($_POST['sub'])){
            //print_r($_POST);
            $data['choice'] = $this->input->get_post('choice');
            $data['name'] = $this->input->get_post('name');
            $data['address1'] = $this->input->get_post('address1');
            $data['address2'] = $this->input->get_post('address2');
            $data['address3'] = $this->input->get_post('address3');
            $data['city'] = $this->input->get_post('city');
            $data['State'] = $this->input->get_post('state');
            $data['pin'] = $this->input->get_post('pin');
            $data['mobile'] = $this->input->get_post('mobilr');
            $data['mobile2'] = $this->input->get_post('mobilr1');
            $data['category'] = $this->input->get_post('cat');
            $data['section'] = implode(',',$this->input->get_post('section'));
            $data['land_line'] = $this->input->get_post('land_line');
            $data['land_line2'] = $this->input->get_post('land_line1');
            $data['contact_person'] = $this->input->get_post('contact_person');
            $data['email'] = $this->input->get_post('email');
            $data['email2'] = $this->input->get_post('email2');
			$data['discription'] = $this->input->get_post('desc');
            $data['product'] = implode(',',$this->input->get_post('product'));
            $data['brand'] = implode(',',$this->input->get_post('brand'));
            $data['services_in'] = implode(',',$this->input->get_post('s'));
            $data['user_type'] = $this->input->get_post('user_type');
            $data['date'] = date('Y-m-d h:i:s');
            $this->form_validation->set_rules('choice','Chose Type','required|trim');
            $this->form_validation->set_rules('name','Name filed','required|trim');
            $this->form_validation->set_rules('address1','Address Field','required|trim');
            $this->form_validation->set_rules('pin','Pin Field','required|trim');
            $this->form_validation->set_rules('mobilr','Mobile Field','numeric|required|trim');
            $this->form_validation->set_rules('contact_person','Contact Person Field','required|trim');
            $this->form_validation->set_rules('email','Email Field','required|valid_email|trim');
            if($this->form_validation->run('product_add')){
                if($data['user_type'] == 1){
                    $data['payment_price'] = 12000 + (12000*18/100);
                    //$data['payment_price'] = 1;
                    if($_FILES){
                        $this->load->library('upload');
                            $files = $_FILES;
                            // echo "<pre>";
                            // print_r($files);
                            $cpt = count($_FILES['register']['name']);
                            $name = [];
                            for($i=0; $i<$cpt; $i++){
                                    $_FILES['file']['name']       = $_FILES['register']['name'][$i];
                                    $_FILES['file']['type']       = $_FILES['register']['type'][$i];
                                    $_FILES['file']['tmp_name']   = $_FILES['register']['tmp_name'][$i];
                                    $_FILES['file']['error']      = $_FILES['register']['error'][$i];
                                    $_FILES['file']['size']       = $_FILES['register']['size'][$i]; 
                                    $config = array();
                                    $config['upload_path'] = '/var/www/html/uploads/register';
                                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                                    $config['max_size']      = '5000';
                                    $config['overwrite']     = FALSE;	 
                                    $this->load->library('upload', $config);
                                    $this->upload->initialize($config);
                                    if($this->upload->do_upload('file')){
                                        $imageData = $this->upload->data();
                                        $uploadImgData[] = $imageData['file_name'];
                                    }else{
                                        $do = $this->upload->display_errors();
                                    }
                            }
                            $image_name = implode(',',$uploadImgData);
                            $data['images'] = $image_name;
                            $data1 = $this->front_end_model->ins_registration($data);
                            if($data1){
                                $data['last_id'] = $data1;
                                $this->load->view('register_pay', $data);
                            }else{
                                $this->load->view('register');
                            }
                    }
                }else{
                    $data['payment_price'] = '0';
                    if($_FILES){
                    
                        $this->load->library('upload');
                            $files = $_FILES;
                            // echo "<pre>";
                            // print_r($files);
                            $cpt = count($_FILES['register']['name']);
                            $name = [];
                            for($i=0; $i<$cpt; $i++){
                                    $_FILES['file']['name']       = $_FILES['register']['name'][$i];
                                    $_FILES['file']['type']       = $_FILES['register']['type'][$i];
                                    $_FILES['file']['tmp_name']   = $_FILES['register']['tmp_name'][$i];
                                    $_FILES['file']['error']      = $_FILES['register']['error'][$i];
                                    $_FILES['file']['size']       = $_FILES['register']['size'][$i]; 
                                    $config = array();
                                    $config['upload_path'] = '/var/www/html/uploads/register';
                                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                                    $config['max_size']      = '5000';
                                    $config['overwrite']     = FALSE;	 
                                    $this->load->library('upload', $config);
                                    $this->upload->initialize($config);
                                    if($this->upload->do_upload('file')){
                                        $imageData = $this->upload->data();
                                        $uploadImgData[] = $imageData['file_name'];
                                    }else{
                                        $do = $this->upload->display_errors();
                                    }
                            }
                            $image_name = implode(',',$uploadImgData);
                            $data['images'] = $image_name;
                            $data = $this->front_end_model->ins_registration($data);
                            if($data){
                                $this->load->view('registration_done');
                            }else{
                                $this->load->view('register');
                            }
                    }
                }
            //    if($data){
            //     $this->load->view('registration_done');
            //    }else{
            //     $this->load->view('register');
            //    }
            }else{
                $this->load->view('register');
            }
        }else{
            $this->load->view('register');
        }
    }
    public function  get_product_list(){
        $name = $this->input->get_post('name');
        $color = $this->input->get_post('color');
        $section = $this->input->get_post('section');
        echo $name;
        echo $color;
        echo $section;
    }


    //Server backup code
    /*public function product_cat($cat_id, $id){
		$pro_data = $this->api_model->product_cat_id($cat_id);
        //if($pro_data){
    		$i = 0;
    		$div .= '<ul class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(145px, -230px, 0px); top: 0px; left: 0px; will-change: transform;">';
    		foreach($pro_data as $pro){
    				if($i == 0){
    					$div .= '<li class="dropdown-submenu">
                    <a href="'.base_url('frontend/product_listing/').$id.'/'.$pro['id'].'" id="'.$pro['id'].'" onclick="node('.$pro['id'].')" class="level2">'.$pro['cat_name'].'</a>';  
                    
    					$div .= $this->product_cat($pro['id']);
    					$div .='</li>';
    				}else{
    					$div .= '<li class="dropdown-submenu"><a class="filter" href="'.base_url('frontend/product_listing/').$id.'/'.$pro['id'].'" id="'.$pro['id'].'" onclick="node('.$pro['id'].')">'.$pro['cat_name'].'</a>';
    					$div .= $this->product_cat($pro['id']);
    					$div .= '</li>';
    				}
    			$i++;
    		}
    		$div .= '</ul>';
    		return $div;
        //}	
    }   
    /*public function product_category_show($id){
		$category = $this->api_model->get_category_main($id);
		//$div = "<ul class='dropdown forfilters mb-4 pl-0 list-unstyled'>";
		foreach($category as $cat){
			$div .= '<ul class="dropdown forfilters mb-4 pl-0 list-unstyled"><li class="dropdown-submenu"><a href="'.base_url('frontend/product_listing/').$id.'/'.$cat['id'].'" class="level" d="'.$cat['id'].'" onclick="node('.$cat['id'].')">'.$cat['cat_name'].'</a></li><button class="btn btn-default" type="button" data-toggle="dropdown" aria-expanded="true"><i class="ion-ios-arrow-down"></i></button>';
				$data = $this->product_cat($cat['id'], $id);
				$div .= $data;
			$div .= '</ul>';
		}
		//$div .= "</ul>";
		return $div;
	}
    public function product_listing($id, $cat_id){
       $data['sec_id'] = $id;
       $data['data_pro'] = $this->front_end_model->get_produc_with_price($id, $cat_id, '1');
       $data['data'] = $this->front_end_model->get_produc_with_price($id, $cat_id, '0'); 
       $data['category'] = $this->product_category_show($id);
       $this->load->view('front_end/product/header');
       $this->load->view('front_end/product/allproduct',$data);
   }*/


   // localcode working
    public function product_cat($cat_id, $id){
        $pro_data = $this->api_model->product_cat_id($cat_id);
        //if($pro_data){
            $i = 0;
            $div .= '<ul class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(145px, -230px, 0px); top: 0px; left: 0px; will-change: transform;">';
            foreach($pro_data as $pro){
                    if($i == 0){
                        $div .= '<li class="dropdown-submenu">
                    <a href="'.base_url('frontend/product_listing/').$id.'/'.$pro['id'].'" id="'.$pro['id'].'" onclick="node('.$pro['id'].')" class="level2">'.$pro['cat_name'].'</a>';  
                    
                        $div .= $this->product_cat($pro['id']);
                        $div .='</li>';
                    }else{
                        $div .= '<li class="dropdown-submenu"><a class="filter" href="'.base_url('frontend/product_listing/').$id.'/'.$pro['id'].'" id="'.$pro['id'].'" onclick="node('.$pro['id'].')">'.$pro['cat_name'].'</a>';
                        $div .= $this->product_cat($pro['id']);
                        $div .= '</li>';
                    }
                $i++;
            }
            $div .= '</ul>';
            return $div;
        //} 
    }
    public function product_category_show($id){
     
        $category = $this->api_model->get_category_main($id);
        //$div = "<ul class='dropdown forfilters mb-4 pl-0 list-unstyled'>";
        foreach($category as $cat){
            $div .= '<ul class="dropdown forfilters mb-4 pl-0 list-unstyled"><li class="dropdown-submenu"><a href="'.base_url('frontend/product_listing/').$id.'/'.$cat['id'].'" class="level" d="'.$cat['id'].'" onclick="node('.$cat['id'].')">'.$cat['cat_name'].'</a></li><button class="btn btn-default" type="button" data-toggle="dropdown" aria-expanded="true"><i class="ion-ios-arrow-down"></i></button>';
                $data = $this->product_cat($cat['id'], $id);
                $div .= $data;
            $div .= '</ul>';
        }
        //$div .= "</ul>";
        return $div;
    }
   public function product_listing($id = 1, $cat_id = 1){
     
       $data['sec_id'] = $id;
       $data['data_pro'] = $this->front_end_model->get_produc_with_price($id, $cat_id, '1');
       $data['data'] = $this->front_end_model->get_produc_with_price($id, $cat_id, '0'); 
       $data['category'] = []; //$this->product_category_show($id);
       $this->load->view('front_end/product/header');
       $this->load->view('front_end/product/allproduct',$data);
   }


   public function product_view($id, $cat_id){
      
       $data['data'] = $this->front_end_model->get_product_id($id);
       $this->load->view('front_end/product/header');
       $this->load->view('front_end/product/product_single',$data);
   }
   public function product_cart(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/cart2');
    }
    public function product_checkout(){
        $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/checkout');
    }
    public function product_reg(){
        if($_POST['submit']){
            $data['full_name'] = $this->input->get_post('name');
            $data['fathers_name'] = $this->input->get_post('f_name');
            $data['mobile'] = $this->input->get_post('number');
            $data['mobile_code'] = '+91';
            $data['email'] = $this->input->get_post('email');
            $data['aadhaar_no'] = $this->input->get_post('adhar');
            $data['address'] = $this->input->get_post('address1').' '. $this->input->get_post('address2');
            $data['state_code'] = $this->input->get_post('state');
            $data['passcode'] = md5($this->input->get_post('passcode'));
            $data['zone_id'] = $this->input->get_post('state');
            $data['city'] = $this->input->get_post('District');
            $data['terms_conditions'] = $this->input->get_post('termsandconditions');
            $data['country_id'] = '99';
            $this->form_validation->set_rules('name','Please Enter Name','required|trim');
			$this->form_validation->set_rules('f_name','Please Enter Father Name','required|trim');
            $this->form_validation->set_rules('number','Please Enter Mobile No','numeric|required|trim');
            $this->form_validation->set_rules('email','Please Enter Email','required|trim');
            $this->form_validation->set_rules('adhar','Please Enter Adhar No','numeric|required|trim');
            $this->form_validation->set_rules('address1','Please Enter Address','required|trim');
            $this->form_validation->set_rules('passcode','Please Enter Passcode','numeric|required|trim');
            $this->form_validation->set_rules('state','Please Enter State','required');
            $this->form_validation->set_rules('District','Please Select District','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
                $data['created_on'] = date('Y-m-d h:i:s');
                if($this->api_model->mobilecheck($data['mobile'], '+91')){
                    $this->session->set_flashdata('add_bank','Mobile No Already Exist');
                    $this->load->view('front_end/product/header');
                    $this->load->view('front_end/product/product_reg');
                }else{
                    $ins = $this->api_model->submit('users', $data);
                    $doc_data = $this->api_model->get_data('users_id = "'.$ins.'"' , 'users', '', '*');
                    $login_id = $login_detail[0]['users_id'];
					$login_name = $login_detail[0]['full_name'];
					$status = $login_detail[0]['type'];
                    $type = 0;
                    $this->session->set_userdata('users_id', $login_id);
                    $this->session->set_userdata('user_name', $login_name);
                    $this->session->set_userdata('user_type', $type);
                    return redirect(base_url().'frontend/product_checkout');
                }
            }else{
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/product_reg');
            }
        }else{
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/product_reg');
        } 
    }
    public function resetpass(){
        if(isset($_POST['submit'])){
            $data['full_name'] = $this->input->get_post('name');
            $data['fathers_name'] = $this->input->get_post('fname');
            $data['email'] = $this->input->get_post('email');
            $data['aadhaar_no'] = $this->input->get_post('adhar_no');
            $this->form_validation->set_rules('adhar_no','Please Enter Addhar No','required|trim');
            $this->form_validation->set_rules('name','Please Enter Name','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run('add_bank')){
                    $ins = $this->api_model->update('users_id',$this->session->userdata("users_id"), 'users', $data);
                    $doc_data = $this->api_model->get_data('users_id = "'.$ins.'"' , 'users', '', '*');
                    $this->session->set_flashdata('add_bank','Your Password is Updated');
                    $this->load->view('front_end/product/header');
                    $this->load->view('front_end/product/resetpass');
            }else{
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/resetpass'); 
            }
        }else{
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/resetpass');
        }
    }
    public function resetprofile(){
        if(isset($_POST['submit'])){
            $data['full_name'] = $this->input->get_post('name');
            $data['fathers_name'] = $this->input->get_post('fname');
            $data['email'] = $this->input->get_post('email');
            $data['aadhaar_no'] = $this->input->get_post('adhar_no');
            $this->form_validation->set_rules('adhar_no','Please Enter Addhar No','required|trim');
            $this->form_validation->set_rules('name','Please Enter Name','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run('add_bank')){
                    $ins = $this->api_model->update('users_id',$this->session->userdata("users_id"), 'users', $data);
                    $doc_data = $this->api_model->get_data('users_id = "'.$ins.'"' , 'users', '', '*');
                    $this->session->set_flashdata('add_bank','Your Profile is Updated');
                    $this->load->view('front_end/product/header');
                    $this->load->view('front_end/product/resetprofile');
            }else{
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/resetprofile'); 
            }
        }else{
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/resetprofile');
        }
    }
    public function resetaddress(){
        if(isset($_POST['submit'])){
            $data['address'] = $this->input->get_post('address');
            $data['state_code'] = $this->input->get_post('state');
            $data['zone_id'] = $this->input->get_post('state');
            $data['city'] = $this->input->get_post('District');
            $data['country_id'] = '99';
            $this->form_validation->set_rules('address','Please Enter Address','required|trim');
            $this->form_validation->set_rules('state','Select State','required');
            $this->form_validation->set_rules('District','Select District','required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run('add_bank')){
                    $ins = $this->api_model->update('users_id',$this->session->userdata("users_id"), 'users', $data);
                    $doc_data = $this->api_model->get_data('users_id = "'.$ins.'"' , 'users', '', '*');
                    $this->session->set_flashdata('add_bank','Your Address is Updated');
                    $this->load->view('front_end/product/header');
                    $this->load->view('front_end/product/resetaddress');
            }else{
                $this->load->view('front_end/product/header');
                $this->load->view('front_end/product/resetaddress'); 
            }
        }else{
            $this->load->view('front_end/product/header');
            $this->load->view('front_end/product/resetaddress'); 
        }
    }
    public function add_interested(){
        $data['product_id'] = $this->input->get_post('product_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($this->front_end_model->get_data('produc_interest', 'product_id = "'.$data['product_id'].'" AND users_id = "'.$data['users_id'].'"')){
            $error['msg'] = "Your Request is already Submitted";
        }else{
            if($this->front_end_model->submit_data('produc_interest', $data)){
                $error['msg'] = "Your Request is Submitted";
            }else{
                $error['msg'] = "database problem";
            }
        }
        echo json_encode($error);
    }
    public function product_thanku(){
        $this->load->view('front_end/product/thanku.php');
    }
    public function wishlist(){
    	$this->load->view('front_end/product/header');
        $this->load->view('front_end/product/wishlist');
    }
    public function add_like(){ 
        $data['product_id'] = $this->input->get_post('product_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['pack_id'] = $this->input->get_post('pack_id');
        $data['pack_price'] = $this->input->get_post('pack_price');
        $data['qty'] = $this->input->get_post('qty');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($this->front_end_model->get_data('product_like', 'product_id = "'.$data['product_id'].'" AND users_id = "'.$data['users_id'].'"')){
            $error['msg'] = "Already in Wishlist";
        }else{
            if($this->front_end_model->submit_data('product_like', $data)){
                $error['msg'] = "Added to Wishlist";
            }else{
                $error['msg'] = "database problem";
            }
        }
        echo json_encode($error);
    }
    public function removelike(){
    	$id =$this->input->get_post('id');
    	$this->api_model->removeproductlike($id);
    }
    public function interest(){
       $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/login_reg');
    }
    public function review($id){
        $data['id'] = $id; 
       $this->load->view('front_end/product/header');
        $this->load->view('front_end/product/login_review',$data);
    }
    public function rating_ajax(){
        $data['product_id'] = $this->input->get_post('product_id');
        $data['user_id'] = $this->input->get_post('farmer_id');
        $data['description'] = $this->input->get_post('description');
        $data['rating'] = $this->input->get_post('rating');
        if($data['description'] == ''){
            echo "Please Fill description";
        }else if($data['rating'] == ''){
            echo "Please fill Rating";
        }else{
        	if($review = $this->api_model->get_data('product_id = '.$data['product_id'].' AND user_id = '.$data['user_id'].'' ,'products_reviews', '', '*')){
        		echo "Your review is already submited";
	        }else{
	        	if($this->api_model->submit('products_reviews', $data)){
	                echo "Your Product Review Send";
	            }else{
	                echo "Database Error";
	            }
	        }
        }
    }
    public function get_category()
	{
		$name =  $this->input->get('name');
		$data['name'] = isset($name)?$name:'';
		if(!$data = $this->front_end_model->get_category($data)){
			$data['error'] = '1';
		}
		echo json_encode($data);
	} 
	public function get_subcategory($name)
	{
		$name =  $this->input->get('name');
		$data['name'] = isset($name)?$name:'';
		if(!$data = $this->front_end_model->get_subcategory($data)){
			$data['error'] = '1';
		}
		echo json_encode($data);
    }

    public function get_login_reg(){
        $this->load->view('front_end/product/login_reg');
    }
    public function logout()
	{
		$this->session->sess_destroy();
		return redirect(base_url('frontend/login'));
	}
    // public function section_search($id){
	// 	$detail['data'] = $this->front_end_model->get_section_id($id);		
    //     $this->load->view('front_end/product/allproduct',$detail);
    //        }
    public function section_search(){
        $name =  $this->input->get('name');
        $name = $this->input->get_post('section');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->front_end_model->section_search($name, $start, $perpage);
		$detail['count'] = $this->front_end_model->section_count($name);
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
    public function removecart_sess(){
        //print_r($_REQUEST);
		$id=$_POST['id'];
	    $count =count($this->session->userdata('cart_session'));
	    if($count==1)
	   	$this->session->unset_userdata('cart_session');
        $cart_des=$this->session->userdata('cart_session');
        print_r($cart_des);
        unset($cart_des[$id]);
        $this->session->set_userdata('cart_session',$cart_des);
        //print_r($this->session->userdata("cart_session"));
    }	
    public function farmer_list($cat_id, $id){
        $data['cat_id'] = $cat_id;
        $data['id'] = $id;
        $data['product_list'] = $this->front_end_model->product_list($id);
        // print_r($data);
        // exit;
      //$data['subcategory_list'] = $this->Admin_detail->get_subcategory_cat_id($id);
        $this->load->view('front_end/product/product_single',$data);
    }
    public function product_category_search($name){
		$name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = $this->input->get_post('perpage');
		$detail = $this->front_end_model->product_category_search($name, $start, $perpage);
        $detail['count'] = $this->front_end_model->product_category_count($name);
        // print_r($detail);
        // exit;
        $this->load->view('front_end/product/allproduct',$detail);
		// if($detail)
		// {
		// 	$json_data = $detail;
		// }
		// else
		// {
		// 	$json_data['error'] = '1';
		// }
		// echo json_encode($json_data);
    }
    public function product_category_status()
	{
		$id = $this->input->get('id');
		$status = $this->input->get_post('status');
		$name =  $this->input->get('name');
		$perpage = $this->input->get_post('perpage');
		$data['isactive'] = $status;
		if($this->front_end_model->product_category_status($id, $data))
		{
			$product_data = $this->front_end_model->product_category_search($name, $start,$perpage);
			$product_data['count']= $this->front_end_model->product_category_count($name); 
			if($product_data)
			{
				$json_data = $product_data;
			}
			else{
				$json_data['error'] = '1';
			}
			//echo json_encode($json_data);
		}
    }
    public function mycart($users_id){		
        $data['customer_details'] = $this->front_end_model->custmer_details($_SESSION['users_id']);
        //print_r($data);        
        $this->load->view('front_end/product/cart2'); 
    }
    public function subcat($id = ''){
        if(!isset($id)){
            $id = $this->input->get_post('id');
        }
        $data['customer_details'] = $this->Front_end_model->custmer_details($_SESSION['user_id']);
        $data['subcategory_list'] = $this->Front_end_model->get_subcategory_cat_id($id);
        $data['id'] = $id;
        print_r($data);
        $this->load->view('Frontend/allproduct', $data);	
	}
    public function check_video_block(){
        $data['video_id'] = $this->input->get_post('video_id');
        $data = $this->Admin_detail->get_data('video_block', 'video_id = "'.$data['video_id'].'" AND isactivated = "1"');
        if($data){
            $error['msg'] = "Your Request is already Submitted";
            $error['video_url'] = $data;
        }else{
            $error['msg'] = "Payment required";
        }
        echo json_encode($error);
    }
    public function sell_animals($id = 0, $cat_id = 0){
     	 $this->load->view('home/product/header');
         $detail['data'] = $this->get_dashboard_list($category, $user_id, $language,  $state_id , $state_name, $cat);
        $this->load->view('home/product/sell_animals', $detail);
    }
    public function dealer_list(){
        $this->load->view('home/product/header');
        $this->load->view('home/product/dealer_list');
    }
    public function breeder_list(){
        $this->load->view('home/product/header');
        $this->load->view('home/product/breeder_list');
    }
    public function champion_bull_list(){
    	$this->load->view('home/product/header');
    	$this->load->view('home/product/champion_bull_list');
    }    
    public function champion_bullss(){
		$data['address'] = $this->input->get_post('address');
        $data['latitude'] = $this->input->get_post('latitude');
        $data['longitude'] = $this->input->get_post('longitude');
        $data['contact_name'] = $this->input->get_post('contact_name');
        $data['contact_number'] = $this->input->get_post('contact_number');              
        $data['semen_price'] = $this->input->get_post('semen_price');
		$data['users_id'] = $this->input->get_post('users_id');
		$data['daughter_yield'] = $this->input->get_post('daughter_yield');                
        $data['avg_milk_proteen'] = $this->input->get_post('avg_milk_proteen');
        $data['registration_certificate'] = $this->input->get_post('registration_certificate');
        $data['health_certificate'] = $this->input->get_post('health_certificate');
        $data['championship_images'] = $this->input->get_post('championship_images');
        $data['brochure'] = $this->input->get_post('brochure');
        $data['total_milk_proteen'] = $this->input->get_post('total_milk_proteen');
        $data['total_milk_fat'] = $this->input->get_post('total_milk_fat');
        $data['semen_type'] = $this->input->get_post('semen_type');
        $data['progini_test'] = $this->input->get_post('progini_test');
        $data['milk_type'] = $this->input->get_post('milk_type');
        $data['lat_yield'] = $this->input->get_post('lat_yield');
        $data['is_imported'] = $this->input->get_post('is_imported');
        $data['user_type'] = $this->input->get_post('user_type');
		$data['purchase_id'] = '';
		$log_id = $this->input->get_post('purchase_id');
		$livestoc_balence_consume  = $this->input->get_post('livestoc_balence_consume');
		$real_balance_consume = $this->input->get_post('real_balance_consume');
		$is_premium = '0';
				if($livestoc_balence_consume != '0' && !is_null($livestoc_balence_consume)){
					$data1['log_id'] = $log_id;
					$data1['users_id'] = $data['users_id'];
					$data1['animal_id'] = '';
					$data1['amount'] = $livestoc_balence_consume;
					$data1['status'] = 'Dr';
					$data1['type'] = $data['user_type'];
					$data1['wallet_type'] = '0';
					$data1['date'] = date('Y-m-d h:i:s');
					$this->api_model->submit('livestoc_wallets',$data1);
					$data['purchase_id'] = $log_id;
					$is_premium = '1';
				}
				if($real_balance_consume != '0' && !is_null($livestoc_balence_consume)){
					$data1['log_id'] = $log_id;
					$data1['users_id'] = $data['users_id'];
					$data1['animal_id'] = '';
					$data1['amount'] = $real_balance_consume;
					$data1['status'] = 'Dr';
					$data1['type'] = $data['user_type'];
					$data1['wallet_type'] = '1';
					$data1['date'] = date('Y-m-d h:i:s');
					$this->api_model->submit('livestoc_wallets',$data1);
					$data['purchase_id'] = $log_id;
					$is_premium = '1';
				}
        $data['animal_id'] = $this->input->get_post('animal_id');
        //$animal_id = json_decode($animal_id, true);
   //      	print_r($data);
			// exit;
        //foreach($animal_id as $ani){
			$pack_id = $this->api_model->get_data('animal_id = "'.$ani.'" AND users_id = "'.$data['users_id'].'"' , 'package_users_dog', '', '*');
		
				//$data['animal_id'] = $ani;
				$this->api_model->submit('package_users_dog', $data);
           	$dat['meating_payment_status'] = $is_premium;
           	$dat['latitude'] = $data['latitude'];
           	$dat['longitude'] = $data['longitude'];
           	$this->api_model->update('animal_id', $ani, 'animals', $dat);
		//}
		$u_data = $this->api_model->get_user_info_id($data['users_id']);
		$to = TO_ADMIN;
		$subject = 'Top Champion Bull Listing'; 
		$email = ''.$data['contact_name'].'('.$data['contact_number'].') registered his/her  bull in top Champion Bull Listing from '.$data['address'].'';
		$e = $this->send_mail($to, $subject, $email);
        $json['success'] = true;
		$json['msg'] = 'Your bull is successfully placed in Champion Bull listing.';
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;  
	}
    public function champion_bull(){
		if(isset($_POST['submit'])){
			// print_r($_REQUEST);
			// exit;
        $data['users_id'] = $this->input->get_post('user_id');
        $data['images'] = $this->input->get_post('adhar_image');
        $video['videos'] = $this->input->get_post('animal_video');
        $data['tag_no'] = $this->input->get_post('tag_number');
        $data['fullname'] = $this->input->get_post('fullname');
        $data['age'] = $this->input->get_post('year');
        $data['age_month'] = $this->input->get_post('month');
        // $data['vaccination'] = $this->input->get_post('vaccination');
        // $data['deworming'] = $this->input->get_post('deworming');
        $data['description'] = $this->input->get_post('description');
        $data['category_id'] = $this->input->get_post('category');
        $data['breed_id'] = $this->input->get_post('breed_id');
        $data['address1'] = $this->input->get_post('location');

        $data1['daughter_yield'] = $this->input->get_post('daughter_yield'); 
        //$data1['total_milk_proteen'] = $this->input->get_post('total_milk_proteen');
        $data1['total_milk_fat'] = $this->input->get_post('total_fat');
        $data1['avg_milk_proteen'] = $this->input->get_post('avg_protin');
        $data1['semen_type'] = $this->input->get_post('semen_type');
        $data1['progini_test'] = $this->input->get_post('progeny_test');
        //$data1['is_imported'] = $this->input->get_post('is_imported');

        $data1['semen_price'] = $this->input->get_post('straw_price');
        $data1['registration_certificate'] = $this->input->get_post('ani_certificate');
        $data1['brochure'] = $this->input->get_post('broc_certificate');
        $data1['health_certificate'] = $this->input->get_post('heal_certificate');
        $data1['championship_images'] = $this->input->get_post('champ_certificate');

        //exit;
			$this->form_validation->set_rules('fullname','Please Enter Nick Name Product','required');
			$this->form_validation->set_rules('year','Please Enter year ','required|trim');
			$this->form_validation->set_rules('straw_price','Please Enter Straw Price','required|trim');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
			if($this->form_validation->run('add_bank')){
				 $ani_id = $this->api_model->insert_animals_details($data);
				// print_r($ani_id);
				// exit;
				if($ani_id){
					$animal_img['animal_id'] = $ani_id;
					$animal_img['created'] = date('Y-m-d');
					$this->api_model->submit('animals_images', $animal_img);
					$data1['animal_id'] = $ani_id;
					$data1['created'] = date('Y-m-d');
					$this->api_model->submit('package_users_dog', $data1);

					$this->session->set_flashdata('add_bank','Your data is Inserted.');
					$this->load->view('home/product/header');

					redirect('homenew/champion_bull_list');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('homenew/add_champion_bull');
				}
			}else{
					
				$this->load->view('home/product/header');			
			    $this->load->view('home/product/add_champion_bull', $detail);
			}
		}else{
			$this->load->view('home/product/header');			
			$this->load->view('home/product/add_champion_bull', $detail);
		}
    }
    public function add_animals(){
        $this->load->view('home/product/header');
        $this->load->view('home/product/add_animal');
    }
    public function add_animal_detals(){
        // echo"<per>";
        // print_r($_REQUEST);
        // exit;
        $data['users_id'] = $this->input->get_post('users_id');
        $data['category_id'] = $this->input->get_post('category');
        $data['breed_id'] = $this->input->get_post('breed_id');
        $data['animal_purpose'] = '0';
        $data['tag_no'] = $this->input->get_post('tag_no');
        $data['fullname'] = $this->input->get_post('fullname');
        $data['age'] = $this->input->get_post('age');
        $data['age_month'] = $this->input->get_post('age_month');
        $data['gender'] = $this->input->get_post('gender');
        //$data['images'] = $this->input->get_post('images');
        $data['lactation'] = "0";//$this->input->get_post('lactation');
        $data['milking_status'] = $this->input->get_post('milking_status');
        $data['peak_milk_yield'] = $this->input->get_post('peak_milk_yield');
        $data['sex_of_calf'] = $this->input->get_post('sex_of_calf');
        $data['calf_status'] = $this->input->get_post('calf_status');
        $data['inter_calving_period'] = $this->input->get_post('inter_calving_period');
        $data['is_pregnant'] = $this->input->get_post('is_pregnant');
        $data['pregnant_month'] = $this->input->get_post('pregnant_month');
        $data['pregnancy_days'] = $this->input->get_post('pregnancy_days');
        $data['method_of_conception'] = $this->input->get_post('method_of_conception');
        $data['price'] = $this->input->get_post('price');
        $data['address1'] = $this->input->get_post('address1');
        $data['state'] = $this->input->get_post('state');
        $data['country'] = $this->input->get_post('country');
        $data['castration'] = $this->input->get_post('castration');
        $data['no_of_males'] = $this->input->get_post('no_of_males');
        $data['no_of_females'] = $this->input->get_post('no_of_females');
        $data['herd'] = $this->input->get_post('herd');
        $data['latitude'] = $this->input->get_post('latitude');
        $data['longitude'] = $this->input->get_post('longitude');
        $data['district'] = $this->input->get_post('district');
        $data['no_nipples'] = $this->input->get_post('no_nipples');
        $data1['created_on'] = date('Y-m-d');

        $animal_vaccination['vaccination_id'] = $this->input->get_post('vaccination_id');
        $animal_vaccination['vaccination_date'] = $this->input->get_post('vaccination_date');
        $animal_vaccination['vaccination_status'] = $this->input->get_post('vaccination_status');

        $animals_detail['description'] = $this->input->get_post('description');
        $animals_detail['father'] = $this->input->get_post('father');
        $animals_detail['mother'] = $this->input->get_post('mother');
        $animals_detail['price_type'] = $this->input->get_post('price_type');
        $animals_detail['seller_name'] = $this->input->get_post('seller_name');
        $animals_detail['seller_contact'] = $this->input->get_post('seller_contact');
        $animals_detail['club_reg_no'] = $this->input->get_post('club_reg_no');
        $animals_detail['club_name'] = $this->input->get_post('club_name');
        $animals_detail['height'] = $this->input->get_post('height');
        $animals_detail['weight'] = $this->input->get_post('weight');
        $animals_detail['color'] = $this->input->get_post('color');
        $animals_detail['fathers_breed'] = $this->input->get_post('fathers_breed');
        $animals_detail['mothers_breed'] = $this->input->get_post('mothers_breed');
        $animals_detail['height'] = $this->input->get_post('height');


        $animals_videos['animal_id'] = $this->input->get_post('animal_id');
        $animals_videos['videos'] = $this->input->get_post('videos');
        $animals_videos['height'] = $this->input->get_post('height');
        $animals_videos['height'] = $this->input->get_post('height');

        $this->form_validation->set_rules('fullname','Please Enter Nick Name Product','required');
        //$this->form_validation->set_rules('category_id','Please Select Category Id ','required');
        // $this->form_validation->set_rules('animal_age','Please Enter Nick Name Product','required');
        // $this->form_validation->set_rules('animal_month','Please Enter Nick Name Product','required');
        // $this->form_validation->set_rules('gender','Please Enter Nick Name Product','required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
        if($this->form_validation->run('add_bank')){
            $ani_id = $this->api_model->insert_animals_details($data);

            if($ani_id){
                $animal_img['animal_id'] = $ani_id;
                $animal_img['created'] = date('Y-m-d');
                $this->api_model->submit('animals_images', $animal_img);
                $data1['animal_id'] = $ani_id;
                $data1['created'] = date('Y-m-d');
                //$this->api_model->submit('package_users_dog', $data1);

                $this->session->set_flashdata('add_bank','Your data is Inserted.');
                $this->load->view('home/product/header');

                redirect('homenew/champion_bull_list');
            }else{
                $this->session->set_flashdata('add_bank','Database Error.');
                $this->load->view('home/product/header');			
                $this->load->view('home/product/add_animal', $detail);
            }
        }else{
                
            $this->load->view('home/product/header');			
            $this->load->view('home/product/add_animal', $detail);
        }
    }
    public function about_us(){
        $this->load->view('home/product/header');
        $this->load->view('home/product/about_us');
    }
    public function sample_collection(){
        if($_POST['submit']){
            // print_r($_SESSION);
            // exit;
                $data1['name'] = $this->input->get_post('name');
                $data1['adress'] = $this->input->get_post('address');
                $data1['district'] = $this->input->get_post('district');
                $data1['state'] = $this->input->get_post('state');
                $data1['pin'] = $this->input->get_post('pin');
                $data1['location'] = $this->input->get_post('address2');
                $data1['latitude'] = $this->input->get_post('cityLat');
                $data1['langitude'] = $this->input->get_post('cityLng');
                $data1['phone'] = $this->input->get_post('number');
                $data1['city'] = $this->input->get_post('city2');
                $data1['business_name'] = $this->input->get_post('business_name');
                $data1['users_id'] = $_SESSION['users_id'];
                $users_id = $data1['users_id'];
                $data1['email'] = $this->input->get_post('email');
                //$this->api_model->submit('lab_reg', $data1);
                
                $amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                // echo $amount_cr;
                // exit;

                $amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                $livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
                $a['real_balance'] = $livestoc_balance;
                $amount = LAB_PRICE;
                $tax = ($amount * 18)/100; 
                $total_amount = $tax + $amount;
                $product_rate = $total_amount;
                if($product_rate  != 0){
                                if($a['real_balance'] > 0){
                                    if($a['real_balance'] == $product_rate){
                                        $a['real_balance_consume'] = $product_rate;
                                        $a['real_balance_status'] = 0; 
                                        $product_rate = 0;
                                    }else if($a['real_balance'] <= $product_rate){
                                        $a['real_balance_status'] = 0; 
                                        $a['real_balance_consume'] = $a['real_balance'];
                                        $product_rate =  $product_rate - $a['real_balance'];
                                    }else if($a['real_balance'] >= $product_rate){
                                        $a['real_balance_consume'] = $product_rate;
                                        $a['real_balance_status'] = $a['real_balance'] - $product_rate; 
                                        $product_rate = 0;
                                    }else{
                                        $a['real_balance_status'] = 0;
                                        $a['real_balance_consume'] = 0;
                                    }
                                }else{
                                    $a['real_balance_status'] = 0;
                                    $a['real_balance_consume'] = 0;
                                }
                            }else{
                                $a['real_balance_status'] = 0;
                                $a['real_balance_consume'] = 0;
                            }  
                            $a['balance_actual_payment'] = $product_rate;
                $type = '23';
                $currency = $this->input->get_post('currency');
                $user_type = $this->input->get_post('user_type');
                $request_status  =$this->input->get_post('request_status');
                if($last_id = $this->api_model->submit('lab_reg', $data1)){
                    $data['users_id'] = $users_id;
                    $data['currency'] = 'INR';
                    $data['type'] = $type;
                    $data['amount'] = $total_amount;
                    $amount_detail[0]['name'] = 'Amount';
                    $amount_detail[0]['value'] = $amount;
                    $amount_detail[1]['name'] = 'Tax (GST) %';
                    $amount_detail[1]['value'] = '18';
                    if(!$a['real_balance_consume'] == '0'){
                        $amount_detail[2]['name'] = 'Wallet balance used';
                        $amount_detail[2]['value'] = $a['real_balance_consume'];
                    }
                    $amount_detail[3]['name'] = 'Total Amount';
                    $amount_detail[3]['value'] = $a['balance_actual_payment'];
                    $data['user_type'] = $user_type;
                    $data['premium_bull_type'] = '0';
                    $data['request_status'] = isset($request_status) ? $request_status : 0;
                    $data['date'] = date('Y-m-d h:i:s');
                    $detail = $this->api_model->insert_log_data($data);
                    //  print_r($data);
                    // exit;
                    $detail[0]['order_id'] = "LVAT_".$detail[0]['purchase_id']."";
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$detail[0]['purchase_id']."&amount=".$a['balance_actual_payment']."&currency=".$currency."",
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
                    $detail[0]['razorpayOrderId'] =  json_decode($response);
                    $json['success'] = true;
                    $json['data'] = $detail;
                    $json['payment_detail'] = array_values($amount_detail);
                    $json['actual_pay_amount'] = $a['balance_actual_payment'];
                    $json['reg_no'] = $last_id;
                    $json['wallet_balance_consume'] = $a['real_balance_consume'];
                    $js['data'] = $json;
                    $this->load->view('home/product/header');           
                    $this->load->view('home/product/sample_collection_confirm', $js);
                    $this->load->view('home/product/footer_new');
                }else{
                    echo "<script>alert('Database Problem')</script>";
                    $this->load->view('home/product/header');           
                    $this->load->view('home/product/sample_collection');
                    $this->load->view('home/product/footer_new');
                    //$json['error'] = 'Database Problem';
                }
        }else{
            $this->load->view('home/product/header');           
            $this->load->view('home/product/sample_collection');
            $this->load->view('home/product/footer_new');
        }
    }
   
    public function ai_list(){
        $this->load->view('home/product/header');
        $this->load->view('home/product/ai_register_with_us');
        $this->load->view('home/product/footer_new');
    }
    public function farm_profile($id){
        $data['farm_id'] = $id;
        $this->load->view('home/product/header');
        $this->load->view('home/product/farm_profile', $data);
        $this->load->view('home/product/footer_new');
    }
    public function farm(){
        $this->load->view('home/product/header');
        $this->load->view('home/product/farm');
        $this->load->view('home/product/footer_new');
    }
    public function update_farm_profile(){
         //print_r($_REQUEST);
        if(isset($_REQUEST['submit'])){
            $id = $this->input->get_post('id');
            $data['users_id'] = $this->input->get_post('users_id');
            $doc_id = $this->input->get_post('doc_id');
            if(isset($doc_id) && $doc_id != ''){
                $data['doc_id'] = $doc_id;          
            }
            $vt_id = $this->input->get_post('vt_id');
            if(isset($vt_id) && $vt_id != ''){
                $data['vt_id'] = $vt_id;            
            }
            $form_name = $this->input->get_post('form_name');
            if(isset($form_name) && $form_name != ''){
                $data['form_name'] = $form_name;            
            }
            $total_no_animal = $this->input->get_post('total_no_animal');
            if(isset($total_no_animal) && $total_no_animal != ''){
                $data['total_no_animal'] = $total_no_animal;            
            }
            $calf_male = $this->input->get_post('calf_male');
            if(isset($calf_male) && $calf_male != ''){
                $data['calf_male'] = $calf_male;            
            }
            $calf_female = $this->input->get_post('calf_female');
            if(isset($calf_female) && $calf_female != ''){
                $data['calf_female'] = $calf_female;            
            }
            $type_of_shed = $this->input->get_post('type_of_shed');
            if(isset($type_of_shed) && $type_of_shed != ''){
                $data['type_of_shed'] = $type_of_shed;          
            }
            $ventilation = $this->input->get_post('ventilation');
            if(isset($ventilation) && $ventilation != ''){
                $data['ventilation'] = $ventilation;            
            }
            $exposer_sun_light = $this->input->get_post('exposer_sun_light');
            if(isset($exposer_sun_light) && $exposer_sun_light != ''){
                $data['exposer_sun_light'] = $exposer_sun_light;            
            }
            $milking_practices = $this->input->get_post('milking_practices');
            if(isset($milking_practices) && $milking_practices != ''){
                $data['milking_practices'] = $milking_practices;            
            }
            $type_of_floring = $this->input->get_post('type_of_floring');
            if(isset($type_of_floring) && $type_of_floring != ''){
                $data['type_of_floring'] = $type_of_floring;            
            }
            $green_fodder = $this->input->get_post('green_fodder');
            if(isset($green_fodder) && $green_fodder != ''){
                $data['green_fodder'] = $green_fodder;          
            }
            $feed = $this->input->get_post('feed');
            if(isset($feed) && $feed != ''){
                $data['feed'] = $feed;          
            }
            $dry_fodder = $this->input->get_post('dry_fodder');
            if(isset($dry_fodder) && $dry_fodder != ''){
                $data['dry_fodder'] = $dry_fodder;          
            }
            $minral_mixture = $this->input->get_post('minral_mixture');
            if(isset($minral_mixture) && $minral_mixture != ''){
                $data['minral_mixture'] = $minral_mixture;          
            }
            $milking = $this->input->get_post('milking');
            if(isset($milking) && $milking != ''){
                $data['milking'] = $milking;            
            }
            $non_milking = $this->input->get_post('non_milking');
            if(isset($non_milking) && $non_milking != ''){
                $data['non_milking'] = $non_milking;            
            }
            $dry = $this->input->get_post('dry');
            if(isset($dry) && $dry != ''){
                $data['dry'] = $dry;            
            }
            $pregnent = $this->input->get_post('pregnent');
            if(isset($pregnent) && $pregnent != ''){
                $data['pregnent'] = $pregnent;          
            }
            $non_pregnent = $this->input->get_post('non_pregnent');
            if(isset($non_pregnent) && $non_pregnent != ''){
                $data['non_pregnent'] = $non_pregnent;          
            }
            $heifer = $this->input->get_post('heifer');
            if(isset($heifer) && $heifer != ''){
                $data['heifer'] = $heifer;          
            }
            $repeat_breeders = $this->input->get_post('repeat_breeders');
            if(isset($repeat_breeders) && $repeat_breeders != ''){
                $data['repeat_breeders'] = $repeat_breeders;            
            }
            $no_of_fattening_pig = $this->input->get_post('no_of_fattening_pig');
            if(isset($no_of_fattening_pig) && $no_of_fattening_pig != ''){
                $data['no_of_fattening_pig'] = $no_of_fattening_pig;            
            }
            $no_of_sow = $this->input->get_post('no_of_sow');
            if(isset($no_of_sow) && $no_of_sow != ''){
                $data['no_of_sow'] = $no_of_sow;            
            }
            $no_of_piglets = $this->input->get_post('no_of_piglets');
            if(isset($no_of_piglets) && $no_of_piglets != ''){
                $data['no_of_piglets'] = $no_of_piglets;            
            }
            $no_of_boar = $this->input->get_post('no_of_boar');
            if(isset($no_of_boar) && $no_of_boar != ''){
                $data['no_of_boar'] = $no_of_boar;          
            }
            $adequate_ventilalion = $this->input->get_post('adequate_ventilalion');
            if(isset($adequate_ventilalion) && $adequate_ventilalion != ''){
                $data['adequate_ventilalion'] = $adequate_ventilalion;          
            }
            $sunlight_enposure = $this->input->get_post('sunlight_enposure');
            if(isset($sunlight_enposure) && $sunlight_enposure != ''){
                $data['sunlight_enposure'] = $sunlight_enposure;            
            }
            $type_of_flooring = $this->input->get_post('type_of_flooring');
            if(isset($type_of_flooring) && $type_of_flooring != ''){
                $data['type_of_flooring'] = $type_of_flooring;          
            }
            $creep_space = $this->input->get_post('creep_space');
            if(isset($creep_space) && $creep_space != ''){
                $data['creep_space'] = $creep_space;            
            }
            $farrawing_pen = $this->input->get_post('farrawing_pen');
            if(isset($farrawing_pen) && $farrawing_pen != ''){
                $data['farrawing_pen'] = $farrawing_pen;            
            }
            $adequate_drainage = $this->input->get_post('adequate_drainage');
            if(isset($adequate_drainage) && $adequate_drainage != ''){
                $data['adequate_drainage'] = $adequate_drainage;            
            }
            $type_of_form = $this->input->get_post('type_of_form');
            if(isset($type_of_form) && $type_of_form != ''){
                $data['type_of_form'] = $type_of_form;          
            }
            $total_no_of_birds = $this->input->get_post('total_no_of_birds');
            if(isset($total_no_of_birds) && $total_no_of_birds != ''){
                $data['total_no_of_birds'] = $total_no_of_birds;            
            }
            $no_of_broiler = $this->input->get_post('no_of_broiler');
            if(isset($no_of_broiler) && $no_of_broiler != ''){
                $data['no_of_broiler'] = $no_of_broiler;            
            }
            $no_of_layer = $this->input->get_post('no_of_layer');
            if(isset($no_of_layer) && $no_of_layer != ''){
                $data['no_of_layer'] = $no_of_layer;            
            }
            $no_of_breeder = $this->input->get_post('no_of_breeder');
            if(isset($no_of_breeder) && $no_of_breeder != ''){
                $data['no_of_breeder'] = $no_of_breeder;            
            }
            $rearing_system = $this->input->get_post('rearing_system');
            if(isset($rearing_system) && $rearing_system != ''){
                $data['rearing_system'] = $rearing_system;          
            }
            $type_of_bedding = $this->input->get_post('type_of_bedding');
            if(isset($type_of_bedding) && $type_of_bedding != ''){
                $data['type_of_bedding'] = $type_of_bedding;            
            }
            $animals_reared_for_meat = $this->input->get_post('animals_reared_for_meat');
            if(isset($animals_reared_for_meat) && $animals_reared_for_meat != ''){
                $animals_reared_for_meat = $animals_reared_for_meat;            
            }
            $animals_reared_for_wool = $this->input->get_post('animals_reared_for_wool');
            if(isset($animals_reared_for_wool) && $animals_reared_for_wool != ''){
                $data['animals_reared_for_wool'] = $animals_reared_for_wool;            
            }
            $milch_animals = $this->input->get_post('milch_animals');
            if(isset($milch_animals) && $milch_animals != ''){
                $data['milch_animals'] = $milch_animals;            
            }
            $system_of_rearing = $this->input->get_post('system_of_rearing');
            if(isset($system_of_rearing) && $system_of_rearing != ''){
                $data['system_of_rearing'] = $system_of_rearing;            
            }
            $type_of_housing = $this->input->get_post('type_of_housing');
            if(isset($type_of_housing) && $type_of_housing != ''){
                $data['type_of_housing'] = $type_of_housing;            
            }
            $type_of_pond = $this->input->get_post('type_of_pond');
            if(isset($type_of_pond) && $type_of_pond != ''){
                $data['type_of_pond'] = $type_of_pond;          
            }
            $sige_of_pond = $this->input->get_post('sige_of_pond');
            if(isset($sige_of_pond) && $sige_of_pond != ''){
                $data['sige_of_pond'] = $sige_of_pond;          
            }
            $type_of_aeration = $this->input->get_post('type_of_aeration');
            if(isset($type_of_aeration) && $type_of_aeration != ''){
                $data['type_of_aeration'] = $type_of_aeration;          
            }
            $poultry_type = $this->input->get_post('poultry_type'); 
            if(isset($poultry_type) && $poultry_type != ''){
                $data['poultry_type'] = $poultry_type;          
            }
            $species = $this->input->get_post('species');   
            if(isset($species) && $species != ''){
                $data['species'] = $species;            
            }
            $others = $this->input->get_post('others');
            if(isset($others) && $others != ''){
                $data['others'] = $others;          
            }
            $no_of_fish = $this->input->get_post('no_of_fish');
            if(isset($no_of_fish) && $no_of_fish != ''){
                $data['no_of_fish'] = $no_of_fish;          
            }       
            if(!isset($data['users_id']) || $data['users_id'] == ''){
                $data['users_id'] = $users_id;
            }else if(!isset($id) || $id == ''){
                $data['id'] = $id;
            }else{
            // echo "<pre>";
            // print_r($data);
            // exit;
                if($last = $this->api_model->get_data_update('id = "'.$id.'"', 'from_profile', $data)){ 
                echo "<script>alert('Your Form has been Successfully Updated')</script>";                   
                    $this->load->view('home/product/header');           
                    $this->load->view('home/product/farm');
                    $this->load->view('home/product/footer_new');
                }else{
                    echo "<script>alert('Database Problem')</script>";
                    $this->load->view('home/product/header');           
                    $this->load->view('home/product/farm_profile',$data);
                    $this->load->view('home/product/footer_new');
                }
            }
        }else{
                $this->load->view('home/product/header');           
                $this->load->view('home/product/farm_profile');
                $this->load->view('home/product/footer_new');
        }
    }
    public function test_lab(){
        $this->load->view('home/product/header');           
        $this->load->view('home/product/test_lab');
    }
    public function veterinarians_list($type){
        $this->load->view('home/product/header');           
        $this->load->view('home/product/premium_veterinarians');
    }
     public function veterinarians_doctor($type){
        $this->load->view('home/product/header');           
        $this->load->view('home/product/veterinary_doctors');
    }
    public function my_request(){
        $this->load->view('home/product/header');
        $this->load->view('home/product/my_request');
    }
    public function animal_favorite_list(){
        $this->load->view('home/product/header');
        $this->load->view('home/product/animal_favorite_list');
    }
    public function contact_us(){
        //print_r($_REQUEST);
        $data['name'] = $this->input->get_post('name');
        $data['phone'] = $this->input->get_post('contact');
        $data['email'] = $this->input->get_post('email');
        $data['message'] = $this->input->get_post('message');
        $data['inquiry_from'] = 'Contac Us';
        $data['date_added'] = date('Y-m-d H:i:s');
        if($this->api_model->submit('enquiries', $data)){
            echo "<script>alert('Thankyou ')</script>";
            redirect(base_url());
        }else{
            $this->load->view('home/product/header');
            $this->load->view('home/product/contact_us');
             $this->load->view('home/product/footer_new');
        }
        // $this->load->view('home/product/header');
        // $this->load->view('home/product/contact_us');
        // $this->load->view('home/product/footer_new');       
    }
    public function pregnancy_detection(){
        if(isset($_REQUEST['submit'])){
                $data1['name'] = $this->input->get_post('name');
                $data1['adress'] = $this->input->get_post('address');
                $data1['district'] = $this->input->get_post('district');
                $data1['no_of_sample'] = $this->input->get_post('sample');
                $data1['farm_name'] = $this->input->get_post('farm_name');
                $data1['state'] = $this->input->get_post('state');
                $data1['pin'] = $this->input->get_post('pin');
                $data1['location'] = $this->input->get_post('location');
                $data1['latitude'] = $this->input->get_post('latitude');
                $data1['langitude'] = $this->input->get_post('langitude');
                $data1['phone'] = $this->input->get_post('phone');
                $data1['city'] = $this->input->get_post('city');
                $lab_id = $this->input->get_post('lab_id');
                $app_type = $this->input->get_post('app_type');
                $admin_id = $this->input->get_post('admin_id');
                $data1['users_id'] = $this->input->get_post('users_id');
                $data1['order_date'] = date('Y-m-d h:i:s');
                $users_id = $data1['users_id'];
                $data1['email'] = $this->input->get_post('email');
                $sample = $data1['no_of_sample'];
                //$this->api_model->submit('lab_reg', $data1);
                // print_r($sample);
                // print_r($data1);
                // exit;
                if($app_type == '3'){
                    $amount_cr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $amount_dr = $this->api_model->get_data('users_id = "'.$admin_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "3"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                }else{
                    $amount_cr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Cr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                    $amount_dr = $this->api_model->get_data('users_id = "'.$users_id.'" AND status="Dr" AND wallet_type = "1" AND user_type = "0"' , 'livestoc_wallets', '', 'SUM(amount) as amount');
                }
                $livestoc_balance = $amount_cr[0]['amount'] - $amount_dr[0]['amount'];
                $a['real_balance'] = $livestoc_balance;
                $start_data = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 365 day"));
                $end_data = date('Y-m-d');
                $amount = 0;
                $total_amount = 0;
                if($this->api_model->get_data('users_id = "'.$users_id.'" AND ai_package_log.date between "'.$start_data.'" AND "'.$end_data.'"', 'ai_package_log', '', '*')){                   
                            $amount = LAB_OFFER_CHARGES;
                            $total_amount = LAB_OFFER_CHARGES * $data1['no_of_sample'];
                            $amount_detail[1]['name'] = 'Premium rate for '.$data1['no_of_sample'].' animals';
                            $amount_detail[1]['value'] = $amount;
                            $json['premium_type'] = '1';
                            $json['no_of_premium_animal'] =  $data1['no_of_sample'];
                            $json['no_of_non_premium_animal'] = '0';
                    }else{
                        $amount = LAB_CHARGES;
                        $total_amount = LAB_CHARGES * $data1['no_of_sample'];
                        $amount_detail[1]['name'] = 'Rate for one sample';
                        $amount_detail[1]['value'] = $amount;
                        $json['premium_type'] = '0';
                        $json['no_of_premium_animal'] =  $data1[0]['sum'];
                        $json['no_of_non_premium_animal'] ='0';
                    }
                    $product_rate = $total_amount;
                    if($product_rate  != 0){
                        if($a['real_balance'] > 0){
                            if($a['real_balance'] == $product_rate){
                                $a['real_balance_consume'] = $product_rate;
                                $a['real_balance_status'] = 0; 
                                $product_rate = 0;
                            }else if($a['real_balance'] <= $product_rate){
                                $a['real_balance_status'] = 0; 
                                $a['real_balance_consume'] = $a['real_balance'];
                                $product_rate =  $product_rate - $a['real_balance'];
                            }else if($a['real_balance'] >= $product_rate){
                                $a['real_balance_consume'] = $product_rate;
                                $a['real_balance_status'] = $a['real_balance'] - $product_rate; 
                                $product_rate = 0;
                            }else{
                                $a['real_balance_status'] = 0;
                                $a['real_balance_consume'] = 0;
                            }
                        }else{
                            $a['real_balance_status'] = 0;
                            $a['real_balance_consume'] = 0;
                        }
                    }else{
                        $a['real_balance_status'] = 0;
                        $a['real_balance_consume'] = 0;
                    }  
                    $a['balance_actual_payment'] = $product_rate;
                    $type = '24';
                    $currency = 'INR';
                    $user_type = '24';
                    $request_status  =$this->input->get_post('request_status');
                if($last_id = $this->api_model->submit('lab_request', $data1)){
                    $data['users_id'] = $users_id;
                    $data['currency'] = $currency;
                    $data['type'] = $type;
                    $data['amount'] = $total_amount;
                    $amount_detail[2]['name'] = 'No of Samples';
                    $amount_detail[2]['value'] = $data1['no_of_sample'];
                    if(!$a['real_balance_consume'] == '0'){
                        $amount_detail[3]['name'] = 'Wallet balance used';
                        $amount_detail[3]['value'] = $a['real_balance_consume'];
                    }
                    $amount_detail[4]['name'] = 'Total Amount';
                    $amount_detail[4]['value'] = $a['balance_actual_payment'];
                    $data['user_type'] = $user_type;
                    $data['premium_bull_type'] = '';
                    $data['request_status'] = isset($request_status) ? $request_status : 0;
                    $data['date'] = date('Y-m-d h:i:s');
                    $detail = $this->api_model->insert_log_data($data);
                    // print_r($detail);
                    // exit;
                    $detail[0]['order_id'] = "LVAT_".$detail[0]['purchase_id']."";
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$detail[0]['purchase_id']."&amount=".$a['balance_actual_payment']."&currency=".$currency."",
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
                    $detail[0]['razorpayOrderId'] =  json_decode($response);
                    $json['success'] = true;
                    $json['data'] = $detail;
                    $json['payment_detail'] = array_values($amount_detail);
                    $json['actual_pay_amount'] = $a['balance_actual_payment'];
                    $json['reg_no'] = $last_id;
                    $json['wallet_balance_consume'] = $a['real_balance_consume'];
                    $json['no_of_semp'] = $sample;
                    $json['lab_id'] = $lab_id;
                    $js['data'] = $json;

                    $this->load->view('home/product/header');           
                    $this->load->view('home/product/pregnancy_detection_new', $js);
                    $this->load->view('home/product/footer_new');
                }else{
                    echo "<script>alert('Database Problem')</script>";
                    $this->load->view('home/product/header');           
                    $this->load->view('home/product/pregnancy_detection_new');
                    $this->load->view('home/product/footer_new');
                    //$json['error'] = 'Database Problem';
                }
        }else{
            $this->load->view('home/product/header');           
            $this->load->view('home/product/pregnancy_detection');
            $this->load->view('home/product/footer_new');
        }
    }
    
}