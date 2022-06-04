<?php
class All_videos extends CI_Controller {
    public $webLanguage;
    public function __construct() {
        parent::__construct();
        $this->load->model('front_end_model');
        $this->load->model('api_model');
        $this->load->model('login_cheak_model');
        $this->load->model('loginmodel');


        $this->load->model('admin_detail');
        if($_SESSION['language']){
            $lang = $_SESSION['language'];
        }else{
            $lang = 'en';
        }
        $this->webLanguage = $this->language_left->get_language($lang);  
    }
     public function remove_vedio($id){
        $data['isactive'] = '0';
        $this->api_model->update('id', $id, 'vedio_list', $data);
        return 1;
    }
     public function index(){
        //print_r($this->session->userdata("users_id"));
        //print_r($this->session->userdata("user_name"));
        //print_r($this->session->userdata("user_type")); 
        //0 docker 1 cutomer 
        // if(!$this->session->userdata("users_id")){
        //     return redirect(base_url().'frontend/login');
        // } else {
            $searchtext = '';
            $dropdownsections = '';
            if(!empty($this->input->get_post('searchtext'))) {
                $searchtext = $this->input->get_post('searchtext');
            }
            if(!empty($this->input->get_post('dropdownsections'))) {
                $dropdownsections = $this->input->get_post('dropdownsections');
            }
            if(!empty($this->input->get_post('dropdownsectionsforlanguage'))){
                $dropdownsectionsforlanguage = $this->input->get_post('dropdownsectionsforlanguage');
            }
            if($searchtext!='' || $dropdownsections!='') {
                $detail = $this->admin_detail->get_video_block_by_search($searchtext, $dropdownsections);
            } else if($dropdownsectionsforlanguage!=''){
                $detail = $this->admin_detail->get_video_block_by_language_search($dropdownsectionsforlanguage);
            } else {
                $detail = $this->admin_detail->get_video_block();
            }
            if($detail)
            {
                //print_r($detail);
                $data = [];
                $i = 0; 
                foreach($detail as $de){
                    $vedio_list = $this->api_model->get_data('video_id = '.$de['video_id'].'', 'vedio_list');
                    //$image = $vedio_list[0]['video_thumb'];
                    $de['video_thumb'] = base_url().'uploads/videos/images/'.$vedio_list[0]['video_thumb'];
                    $userDetails = $this->admin_detail->get_data('users', 'users_id ='.$de['user_id']);
                    if($userDetails){
                        $de['user_name'] = $de['submittedby']; 
                        //$de['user_name']  = $userDetails[0]['full_name'];
                    }else{
                        $adminUserDetails = $this->admin_detail->get_data('admin', 'admin_id ='.$de['user_id']);
                        $de['user_name']  = $adminUserDetails[0]['fname'] . " "  .$adminUserDetails[0]['lname'];
                    }
                    $data[$i] = $de;
                    $i++;
                }
            }
            else
            {
                $json_data['error'] = '1';
            }
                $k = '0';
                foreach ($data as $key => $value) {
                        $count = $this->api_model->get_data('video_id = '.$value['video_id'].' AND isactive = "1"', 'vedio_list', '','count(id) as count');
                        $data[$key]['count_values'] = $count[0]['count'];
                        $returnValueForCount[$k] = $data[$key];
                        $k++;
                }
            $json_data['count']= $this->admin_detail->get_video_block_count();
            $json_data['videolist'] = $returnValueForCount;
            // print_r($returnValueForCount);
            // exit;
            $this->load->view('user_videos/videos/header');
            $this->load->view('user_videos/videos/all_videos', $json_data);
        // }
    }
    public function videocheckout($id){
        $video['data'] = $this->admin_detail->get_video_block_by_id($id);       
        $this->load->view('user_videos/videos/header');
        $this->load->view('user_videos/videos/videocheckout', $video);
    }
    // public function video_add()
    // {   
    //     $data['actiNewTab'] = 0;
    //     $data['steps'] = $this->input->get_post('steps');
    //     $data['title'] = $this->input->get_post('title');
    //     $data['price'] = $this->input->get_post('price');
    //     $data['qualifications'] = $this->input->get_post('qualifications');
    //     $data['institute'] = $this->input->get_post('institute');
    //     $data['seris_title'] = $this->input->get_post('seris_title');
    //     $data['user_id'] = $_SESSION['users_id'];
    //     $data['user_type'] = $_SESSION['user_type']; 
    //     $data['isactivated'] = '0';
    //     $data['created_on'] = date('Y-m-d h:i:s');
    //     $data['updated_on'] = date('Y-m-d h:i:s'); 
    //     $data['start_date'] = $this->input->get_post('start_date');
    //     $data['submittedby'] = $this->input->get_post('submittedby');
    //     $data['language'] = $this->input->get_post('language');
    //     $data['category'] = $this->input->get_post('checkboxExpertise');
    //     $data['sublanguage'] = $this->input->get_post('sublanguage');
    //     $data['subject'] = $this->input->get_post('subject');
    //     $data['number_of_videos'] = 1;
    //     $data['description'] = $this->input->get_post('description');
    //     $data['showto'] = $this->input->get_post('showto');

    //     if(!empty($data['qualifications']) && !empty($data['institute'])  && !empty($data['submittedby']) && empty($data['language'])) {
    //         $data['actiNewTab'] = 1;
    //     } elseif(!empty($data['qualifications']) && !empty($data['institute'])  && !empty($data['submittedby']) && !empty($data['language']) && !empty($data['seris_title'])){
    //         $data['actiNewTab'] = 2;
    //         if($this->input->get_post('expertise')!=1) {
    //             $data['category'] = implode( ", ", $this->input->get_post('checkboxExpertise'));
    //         }
    //     }else{
    //         $data['actiNewTab'] = 0;
    //     }
    //     //$this->form_validation->set_rules('seris_title','Title Required', 'required|trim');
    //     $this->form_validation->set_rules('title','Title Required', 'required|trim');
    //     $this->form_validation->set_rules('price','Price Required', 'numeric|required|trim');
    //     $this->form_validation->set_rules('qualifications','Qualifications Required','required|trim');
    //     $this->form_validation->set_rules('institute','Institute Required','required|trim');
    //     $this->form_validation->set_rules('start_date','Start date Required','required|trim');
    //     $this->form_validation->set_rules('submittedby','Submittedby Required','required|trim');
    //     $this->form_validation->set_rules('description','Please Enter Long Description','required|trim');
    //     //$this->form_validation->set_rules('language','Language Required','required|trim');
    //     //$this->form_validation->set_rules('category','Category Required','required|trim');
    //     if (!empty($this->input->get_post('showto'))){
    //         $this->form_validation->set_rules('showto',"Showto", "trim|xss_clean");
    //     } else {
    //         $this->form_validation->set_rules('showto',"Showto", "trim|required");
    //     }
    //     $this->form_validation->set_rules('language',"Please select language", "trim|required");
    //     $this->form_validation->set_rules('sublanguage',"Please select sublanguage", "trim|required");
    //     $this->form_validation->set_rules('checkboxExpertise',"Category", "trim|required");
    //     $this->form_validation->set_rules('subject','Subject Required','required|trim');
    //     $this->form_validation->set_error_delimiters('<div  class="col-md-12 error">', '</div>');
    // 	// print_r($data);
    // 	// exit;
    //     if($this->form_validation->run('add_rol')){   
    //         $users_video_group_number = rand(0, 1000000);
    //         for($i = 0; $i<20; $i++){
    //             if($_POST['vedio_name_'.$i.''] != ''){
    //                 // echo $_POST['vedio_name_'.$i.''];
    //                 // echo $_POST['vedio_thumb_'.$i.''];
    //                 //echo 'vedio_name_0';
    //                     $data['video_thumb'] = $_POST['vedio_thumb_'.$i.''] ;
    //                     $data['video'] = $_POST['vedio_name_'.$i.''];
    //                     $data['link'] = base_url('uploads/videos');
    //                         if($i == 0){
    //                             $data['showto'] = implode( ", ", $data['showto']);
    //                         }
    //                         unset($data['actiNewTab']);
    //                         unset($data['steps']);
    //                         $data['users_video_group_number'] = $users_video_group_number;
    //                         // echo "<pre>";
    //                         // print_r($data);
    //                         if($video_id = $this->admin_detail->video_block_add($data)){ 
    //                             $lang = $this->api_model->get_all_languages();
    //                             $vedio_pdf = '';
    //                             foreach($lang as $la){
    //                                 //echo $_POST['pdf_name_'.$i.'_'.$la['id'].''].'</br>'; 
    //                                 if($_POST['pdf_name_'.$i.'_'.$la['id'].''] != ''){
    //                                   //  echo "this is test";
    //                                     $vedio_pdf['vedio_id'] = $video_id;
    //                                     $vedio_pdf['lang_id'] = $_POST['lang_'.$i.'_'.$la['id'].''];
    //                                     $vedio_pdf['pdf_name'] = $_POST['pdf_name_'.$i.'_'.$la['id'].''];
    //                                     //print_r($vedio_pdf);
    //                                     $this->admin_detail->add_video_pdf($vedio_pdf);
    //                                 }
    //                             }
    //                         }else{
    //                             //load the error and success messages
    //                             $data['errors'] = $this->error;
    //                             $data['success'] = $this->success;
    //                             //load the view along with data
    //                             $this->session->set_flashdata('add_rol','Problem with database');
    //                             $this->load->view('user_videos/videos/header');
    //                             $this->load->view('user_videos/videos/video_add', $data);
    //                         }
    //             }
    //             else{
    //                 if($i == '0'){
    //                     $this->session->set_flashdata('add_rol','Please add video for upload');
    //                     $header['head']['title'] = 'LiveStoc';
    //                     $header['head']['description'] = '';
    //                     $header['head']['auther'] = $vid[0]['submittedby'];
    //                     $header['head']['link'] = base_url().'all_videos';
    //                     $this->load->view('user_videos/videos/header',$header);
    //                     $this->load->view('user_videos/videos/video_add', $data);
    //                 }
    //             }
    //         }
    //          $data['errors'] = $this->error;
    //             $data['success'] = $this->success;
    //             $this->session->set_flashdata('add_rol','Video was successfully uploaded to direcoty');
    //             redirect('all_videos');
    //             exit;
    //        // exit;
    //         // for ($i=0; $i <= count($_FILES); $i++) {

    //         //     if($_FILES['video_name'.$i]['name']){
    //         //         //set preferences
    //         //         //file upload destination
    //         //         $upload_path = '/var/www/html/harpahu_merge_dev/uploads/videos';
    //         //         $config = array();
    //         //         $config['upload_path'] = $upload_path;
    //         //         //allowed file types. * means all types
    //         //         $config['allowed_types'] = 'wmv|mp4|avi|mov|3gp|flv|mp3';
    //         //         //allowed max file size. 0 means unlimited file size
    //         //         $config['max_size'] = '0';
    //         //         //max file name size
    //         //         $config['max_filename'] = '255';
    //         //         //whether file name should be encrypted or not
    //         //         $config['encrypt_name'] = FALSE;
    //         //         //store video info once uploaded
    //         //         $video_data = array();
    //         //         //check for errors
    //         //         $is_file_error = FALSE;
    //         //         //check if file was selected for upload
    //         //         if (!$_FILES['video_name'.$i]) {
    //         //             $is_file_error = TRUE;
    //         //             $this->handle_error('Select a video file.');
    //         //         }
    //         //         //if file was selected then proceed to upload
    //         //         if (!$is_file_error) {
    //         //             //load the preferences
    //         //             $this->load->library('upload', $config);
    //         //             $this->upload->initialize($config);
    //         //             //check file successfully uploaded. 'video_name' is the name of the input
    //         //             if (!$this->upload->do_upload('video_name'.$i)) {
    //         //                 //if file upload failed then catch the errors
    //         //                 //$this->handle_error($this->upload->display_errors());
    //         //                 $is_file_error = TRUE;
    //         //             } else {
    //         //                 //store the video file info
    //         //                 $video_data = $this->upload->data();
    //         //             }
    //         //         }
    //         //         // There were errors, we have to delete the uploaded video
    //         //         if ($is_file_error) {
    //         //             //this message added for show that error
    //         //             $this->session->set_flashdata('add_rol','Please add video for upload');
    //         //             if ($video_data) {
    //         //                 $file = $upload_path . $video_data['file_name'];
    //         //                 if (file_exists($file)) {
    //         //                     unlink($file);
    //         //                 }
    //         //             }
    //         //         } else {
    //         //             $data['video'] = $video_data['file_name'];
    //         //             $data['link'] = $upload_path;
    //         //             $this->session->set_flashdata('add_rol','Video was successfully uploaded to direcoty');
    //         //         }

    //         //         if($_FILES['video_image'.$i]['name']){
    //         //             if($i == 0){
    //         //                 $this->load->library('upload');
    //         //                 if($_FILES['video_image'.$i]['name']){
    //         //                     $_FILES['file']['name']       = $_FILES['video_image'.$i]['name'];
    //         //                     $_FILES['file']['type']       = $_FILES['video_image'.$i]['type'];
    //         //                     $_FILES['file']['tmp_name']   = $_FILES['video_image'.$i]['tmp_name'];
    //         //                     $_FILES['file']['error']      = $_FILES['video_image'.$i]['error'];
    //         //                     $_FILES['file']['size']       = $_FILES['video_image'.$i]['size']; 
    //         //                     $config1 = array();
    //         //                     $config1['upload_path'] = '/var/www/html/harpahu_merge_dev/uploads/videos/images';
    //         //                     $config1['allowed_types'] = 'gif|jpg|png|jpeg';
    //         //                     $config1['max_size']      = '5000';
    //         //                     $config1['overwrite']     = FALSE;    
    //         //                     $this->load->library('upload', $config1);
    //         //                     $this->upload->initialize($config1);
    //         //                     if($this->upload->do_upload('file')){
    //         //                         $imageData = $this->upload->data();
    //         //                         $uploadImgData = $imageData['file_name'];
    //         //                     }else{
    //         //                         $do = $this->upload->display_errors();
    //         //                     }
    //         //                     $image_name = $uploadImgData;
    //         //                     $data['video_thumb'] = $image_name;
    //         //                 }
    //         //             }
    //         //         }
                            
                    
    //         //     }else{
    //         //         if(count($_FILES) > 1) {
    //         //             redirect('all_videos');
    //         //             exit;
    //         //         }else{
    //         //             $this->session->set_flashdata('add_rol','Please add video for upload');
    //         //             $this->load->view('user_videos/videos/header');
    //         //             $this->load->view('user_videos/videos/video_add', $data);
    //         //         }
    //         //     }
    //         // }
    //     } else {
    //         $header['head']['title'] = 'LiveStoc';
    //         $header['head']['description'] = '';
    //         $header['head']['auther'] = $vid[0]['submittedby'];
    //         $header['head']['link'] = base_url().'all_videos';
    //         $this->load->view('user_videos/videos/header',$header);
    //         $this->load->view('user_videos/videos/video_add', $data);
    //     }
    // }
    public function video_add()
    {   
        $data['actiNewTab'] = 0;
        $data['type'] = $this->input->get_post('type');
        $data['steps'] = $this->input->get_post('steps');
        $data['title'] = $this->input->get_post('heading');
        $data['price'] = $this->input->get_post('price');
        $data['size'] = $this->input->get_post('size');
        $data['qualifications'] = $this->input->get_post('qualifications');
        $data['institute'] = $this->input->get_post('institute');
        $data['user_id'] = $_SESSION['users_id'];
        $data['user_type'] = $_SESSION['user_type']; 
        $data['isactivated'] = '0';
        $data['created_on'] = date('Y-m-d h:i:s');
        $data['updated_on'] = date('Y-m-d h:i:s'); 
        $data['start_date'] = $this->input->get_post('start_date');
        $data['submittedby'] = $this->input->get_post('submittedby');
        $data['language'] = $this->input->get_post('language');
        $data['category'] = $this->input->get_post('checkboxExpertise');
        $data['sublanguage'] = $this->input->get_post('sublanguage');
        $data['subject'] = $this->input->get_post('subject');
        $data['number_of_videos'] = 1;
        $data['description'] = $this->input->get_post('description');
        if(is_array($this->input->get_post('showto'))){
            $showto = $this->input->get_post('showto');
            //if(is_array($showto)){
                $showto = implode( ", ",$showto);
            //}
        }else{
            $showto = $this->input->get_post('showto');
        }   
        $data['showto'] = $showto;
        // print_r($data);
        // exit;
        if(!empty($data['qualifications']) && !empty($data['institute'])  && !empty($data['submittedby']) && empty($data['language'])) {
            $data['actiNewTab'] = 1;
        } elseif(!empty($data['qualifications']) && !empty($data['institute'])  && !empty($data['submittedby']) && !empty($data['language'])){
            $data['actiNewTab'] = 2;
            if($this->input->get_post('expertise')!=1) {
                //$cate = $this->input->get_post('checkboxExpertise');
                //if(is_array($cate)){
                    $data['category'] = implode( ", ",$this->input->get_post('checkboxExpertise'));
                //}else{
                    //$data['category'] = $this->input->get_post('checkboxExpertise');
                //}
               
            }
        }else{
            $data['actiNewTab'] = 0;
        }
        $this->form_validation->set_rules('heading','Title Required', 'required|trim');
        $this->form_validation->set_rules('price','Price Required', 'numeric|required|trim');
        $this->form_validation->set_rules('qualifications','Qualifications Required','required|trim');
        $this->form_validation->set_rules('institute','Institute Required','required|trim');
        //$this->form_validation->set_rules('start_date','Start date Required','required|trim');
        $this->form_validation->set_rules('submittedby','Submittedby Required','required|trim');
        $this->form_validation->set_rules('description','Please Enter Long Description','required|trim');
        $this->form_validation->set_rules('language','Language Required','required|trim');
        //$this->form_validation->set_rules('category','Category Required','required|trim');
        // if (!empty($this->input->get_post('showto'))){
        $this->form_validation->set_rules('showto',"Showto Required", "required");
        // } else {
        //     $this->form_validation->set_rules('showto',"Showto", "trim|required");
        // }
        //$this->form_validation->set_rules('language',"Please select language", "trim|required");
        $this->form_validation->set_rules('checkboxExpertise',"Category", "trim|required");
        $this->form_validation->set_rules('subject','Subject Required','required|trim');
        $this->form_validation->set_error_delimiters('<div  class="col-md-12 error">', '</div>');
       
    
        if($this->form_validation->run('add_rol')){         
            //$users_video_group_number = rand(0, 1000000);
            // print_r($_POST);
            // exit;
            unset($data['actiNewTab']);
            unset($data['steps']);
            $video_id = $this->admin_detail->video_block_add($data);
            for($i = 0; $i<$data['size']; $i++){
                 
                if($_POST['vedio_name_'.$i.''] != ''){
                    // echo $_POST['vedio_name_'.$i.''];
                    // echo $_POST['vedio_thumb_'.$i.''];
                    //echo 'vedio_name_0';
                        $data_new['video_id'] = $video_id ;
                        $data_new['video_thumb'] = $_POST['vedio_thumb_'.$i.''] ;
                        $data_new['video'] = $_POST['vedio_name_'.$i.''];
                        $data_new['title'] = $_POST['video_title_'.$i.''];
                        $data_new['discription'] = $_POST['video_dis_'.$i.''];
                        $data_new['link'] = base_url('uploads/videos');
                            // if($i == 0){
                            //     //$data['showto'] = implode( ", ", $data['showto']);
                            // }
                          
                            $data['users_video_group_number'] = $users_video_group_number;
                            // echo "<pre>";
                            // print_r($data);
                            if($sub_id = $this->api_model->submit('vedio_list', $data_new)){ 
                                $lang = $this->api_model->get_all_languages();
                                $vedio_pdf = '';
                                foreach($lang as $la){
                                    //echo $_POST['pdf_name_'.$i.'_'.$la['id'].''].'</br>'; 
                                    if($_POST['pdf_name_'.$i.'_'.$la['id'].''] != ''){
                                      //  echo "this is test";
                                        $vedio_pdf['vedio_id'] = $sub_id;
                                        $vedio_pdf['lang_id'] = $_POST['lang_'.$i.'_'.$la['id'].''];
                                        $vedio_pdf['pdf_name'] = $_POST['pdf_name_'.$i.'_'.$la['id'].''];
                                        //print_r($vedio_pdf);
                                        $this->admin_detail->add_video_pdf($vedio_pdf);
                                    }
                                }
                            }
                }
            }
            redirect('all_videos');
            exit;
        } else {
            $this->load->view('user_videos/videos/header');
            $this->load->view('user_videos/videos/video_add', $data);
        }
    }
    public function video_edit($id)
    {
        // echo "<pre>";
        // print_r($_REQUEST);
        // exit;
        $video_data = $this->admin_detail->get_video_block_by_id($id);
        $video['video_id'] = $video_data[0]['video_id'];
        $video['type'] = isset($_REQUEST['type']) ? $this->input->get_post('type') : $video_data[0]['type'];
        //$video['steps'] = isset($_REQUEST['steps']) ? $this->input->get_post('steps') : $video_data[0]['steps'];
        $video['title'] = isset($_REQUEST['heading']) ? $this->input->get_post('heading') : $video_data[0]['title'];
        $video['price'] = isset($_REQUEST['price']) ? $this->input->get_post('price') : $video_data[0]['price'];;
        $video['size'] = isset($_REQUEST['size']) ? $this->input->get_post('size') : $video_data[0]['size'];;
        $video['qualifications'] = isset($_REQUEST['qualifications']) ? $this->input->get_post('qualifications') : $video_data[0]['qualifications'];;
        $video['institute'] = isset($_REQUEST['institute']) ? $this->input->get_post('institute') : $video_data[0]['institute'];
        $video['submittedby'] = isset($_REQUEST['submittedby']) ? $this->input->get_post('submittedby') : $video_data[0]['submittedby'];;
        $video['language'] = isset($_REQUEST['language']) ? $this->input->get_post('language') : $video_data[0]['language'];
        //$video['category'] = isset($_REQUEST['checkboxExpertise']) ? $this->input->get_post('checkboxExpertise') : $video_data[0]['category'];
        $video['subject'] = isset($_REQUEST['subject']) ? $this->input->get_post('subject') : $video_data[0]['subject'];
        $video['number_of_videos'] = isset($_REQUEST['number_of_videos']) ? $this->input->get_post('number_of_videos') : $video_data[0]['number_of_videos'];
        $video['description'] = isset($_REQUEST['description']) ? $this->input->get_post('description') : $video_data[0]['description'];
        //$video['showto'] = isset($_REQUEST['showto']) ? $this->input->get_post('showto') : $video_data[0]['showto'];
    //    print_r($video);
    //    exit;
        if($this->input->get_post('showto')) {
            $showto = $this->input->get_post('showto');
            if(is_array($showto)){
                $video['showto'] = implode( ", ", $this->input->get_post('showto'));
            }else{
                $video['showto'] = $this->input->get_post('showto');
            }
        } else {
            $video['showto'] = $video_data[0]['showto'];
        }
        $cata = $this->input->get_post('checkboxExpertise');
        if(is_array($cata)){
            $video['category'] = implode( ", ", $this->input->get_post('checkboxExpertise'));
        }else{
            $video['category'] = isset($_REQUEST['checkboxExpertise']) ? $this->input->get_post('checkboxExpertise') : $video_data[0]['category'];
        }
        // $video['videorecords'] = $this->admin_detail->get_video_block_by_group_number($video['video'][0]['users_video_group_number']);
        // $video['actiNewTab'] = 0;
        // $video['qualifications'] = $this->input->get_post('qualifications');
        // $video['institute'] = $this->input->get_post('institute');
        // $video['submittedby'] = $this->input->get_post('submittedby');
        // $video['language'] = $this->input->get_post('language');
        // $video['sublanguage'] = $this->input->get_post('sublanguage');
        if(!empty($video['qualifications']) && !empty($video['institute'])  && !empty($video['submittedby']) && empty($video['language'])) {
            $video['actiNewTab'] = 1;
        } elseif(!empty($video['qualifications']) && !empty($video['institute'])  && !empty($video['submittedby']) && !empty($video['language'])){
            $video['actiNewTab'] = 2;
            // if($this->input->get_post('expertise')!=1) {
            //     $cata = $this->input->get_post('checkboxExpertise');
            //     if(is_array($cata)){
            //         $video['category'] = implode( ", ", $this->input->get_post('checkboxExpertise'));
            //     }else{
            //         $video['category'] = isset($_REQUEST['checkboxExpertise']) ? $this->input->get_post('checkboxExpertise') : $video_data[0]['category'];
            //     }
            // }
        }else{
            $video['actiNewTab'] = 0;
        }

        $this->form_validation->set_rules('heading','Title Required', 'required|trim');
        $this->form_validation->set_rules('price','Price Required', 'numeric|required|trim');
        $this->form_validation->set_rules('qualifications','Qualifications Required','required|trim');
        $this->form_validation->set_rules('institute','Institute Required','required|trim');
        //$this->form_validation->set_rules('start_date','Start date Required','required|trim');
        $this->form_validation->set_rules('submittedby','Submittedby Required','required|trim');
        $this->form_validation->set_rules('description','Please Enter Long Description','required|trim');
        $this->form_validation->set_rules('size','Size Required','required|trim');
        $this->form_validation->set_rules('type','Type Required','required|trim');
        $this->form_validation->set_rules('showto',"Showto Required", "required");
        // if (!empty($this->input->get_post('showto'))){
        //     $this->form_validation->set_rules('showto',"Showto", "trim|xss_clean");
        // } else {
        //     $this->form_validation->set_rules('showto',"Showto", "trim|required");
        // }
        $this->form_validation->set_rules('language',"Please select language", "trim|required");
        // //$this->form_validation->set_rules('sublanguage',"Please select sublanguage", "trim|required");
        $this->form_validation->set_rules('checkboxExpertise',"Category", "trim|required");
        $this->form_validation->set_rules('subject','Subject Required','required|trim');

        //$this->form_validation->set_rules('subject','Subject Required','required|trim');
        $this->form_validation->set_error_delimiters('<div  class="col-md-12 error">', '</div>');
        if($this->form_validation->run('edit_video'))
        {
            $id = $video['video_id'];
            $value['title'] = $this->input->post('heading');
            $value['price'] = $this->input->post('price');
            $value['qualifications'] = $this->input->get_post('qualifications');
            $value['institute'] = $this->input->get_post('institute');
            $value['start_date'] = $this->input->get_post('start_date');
            $value['submittedby'] = $this->input->get_post('submittedby');
            $value['updated_on'] = date('Y-m-d h:i:s'); 
            //$value['language'] = implode(",", $this->input->get_post('checkbox1'));
            $value['language'] = $this->input->get_post('language');
            $value['sublanguage'] = $this->input->get_post('sublanguage');
            $value['category'] = $this->input->get_post('checkboxExpertise');
            $value['subject'] = $this->input->get_post('subject');
            $value['number_of_videos'] = 1;
            $value['description'] = $this->input->get_post('description');
            $value['user_id'] = $_SESSION['users_id'];
            $value['user_type'] = $_SESSION['user_type']; 
            $value['showto'] =  $video['showto'];
            $size = $this->input->get_post('size');
            if($this->api_model->update('video_id', $id, 'video_block', $value)){
                for($i = 0; $i<$size; $i++){
                    if($_POST['vedio_name_'.$i.''] != ''){
                        // echo $_POST['vedio_name_'.$i.''];
                        // echo $_POST['vedio_thumb_'.$i.''];
                        //echo 'vedio_name_0';
                            $data_new['video_id'] = $id ;
                            $data_new['video_thumb'] = $_POST['vedio_thumb_'.$i.''] ;
                            $data_new['title'] = $_POST['video_title_'.$i.''];
                            $data_new['discription'] = $_POST['video_dis_'.$i.''];
                            $data_new['video'] = $_POST['vedio_name_'.$i.''];
                            $data_new['link'] = base_url('uploads/videos');
                            // print_r($data_new);
                            // exit;
                            if($sub_id = $this->api_model->submit('vedio_list', $data_new)){ 
                                    $lang = $this->api_model->get_all_languages();
                                    $vedio_pdf = '';
                                    foreach($lang as $la){ 
                                        if($_POST['pdf_name_'.$i.'_'.$la['id'].''] != ''){
                                            $vedio_pdf['vedio_id'] = $sub_id;
                                            $vedio_pdf['lang_id'] = $_POST['lang_'.$i.'_'.$la['id'].''];
                                            $vedio_pdf['pdf_name'] = $_POST['pdf_name_'.$i.'_'.$la['id'].''];
                                            $this->admin_detail->add_video_pdf($vedio_pdf);
                                        }
                                    }
                            }
                    }
                }
                redirect('all_videos');
                exit;
            }else
            {
                $this->session->set_flashdata('add_rol','There is Problem With Database.');
                $this->load->view('user_videos/videos/header');
                $this->load->view('user_videos/videos/video_edit', $video);
            }
        }else{
            // echo "<pre>";
            // print_r($video);
            // exit;
            $this->load->view('user_videos/videos/header');
            $this->load->view('user_videos/videos/video_edit', $video);
        }   
    }

    public function rating_ajax(){
        $data['video_id'] = $this->input->get_post('video_id');
        $data['users_id'] = $this->input->get_post('users_id');
        $data['feedback'] = $this->input->get_post('feedback');
        $data['rating'] = $this->input->get_post('rating');
        if($data['feedback'] == ''){
            echo "Please write your reviews";
        }else if($data['rating'] == ''){
            echo "Please rate the tutorial";
        }else{
            if($review = $this->api_model->get_data('video_id = '.$data['video_id'].' AND users_id = '.$data['users_id'].'' ,'video_rating', '', '*')){
                echo "You have already submitted your reviews";
            }else{
                if($this->api_model->submit('video_rating', $data)){
                    echo "Your Rate and Reviews has been successfully submitted";
                }else{
                    echo "Database Error";
                }
            }
        }
    }
    
        public function add_interested(){
        $data['video_id'] = $this->input->get_post('video_id');
        $data['users_id'] = $this->input->get_post('user_id');
        $data['user_type'] = $this->input->get_post('type');
        $data['created_date'] = date('Y-m-d h:i:s');
        if($this->front_end_model->get_data('video_interest', 'video_id = "'.$data['video_id'].'" AND users_id = "'.$data['users_id'].'"')){
            $this->api_model->remove_video_whishlist($data['video_id'], $data['users_id']);
            $error['msg'] = "Removed from Wish List";
        }else{
            if($this->front_end_model->submit_data('video_interest', $data)){
                $error['msg'] = "Added to Wish List";
            }else{
                $error['msg'] = "database problem";
            }
        }
        echo json_encode($error);
    }

    public function add_like(){
        $data['video_id'] = $this->input->get_post('video_id');
        $data['users_id'] = $this->input->get_post('users_id');
        $data['user_type'] = $this->input->get_post('type');
        if($linkeData = $this->front_end_model->get_data('video_like', 'video_id = "'.$data['video_id'].'" AND users_id = "'.$data['users_id'].'"')){
            $this->api_model->removevideolike($linkeData[0]['id']);
            $error['msg'] = "Already in like list";
        }else{
            if($this->front_end_model->submit_data('video_like', $data)){
                $error['msg'] = "Added to like list";
            }else{
                $error['msg'] = "database problem";
            }
        }
        echo json_encode($error);
    }
    
    public function wishlist(){
        $this->load->view('user_videos/videos/header');
        $this->load->view('user_videos/videos/wishlist');
    }
    public function wishlist_checkout(){
        $this->load->view('user_videos/videos/header');
        $this->load->view('user_videos/videos/wishlist_checkout');
    }
    public function removelike(){
        $id =$this->input->get_post('id');
        $this->api_model->removevideolike($id);
    }
    public function removeVidewishlistlike(){
        $id = $this->input->get_post('id');
        $this->api_model->remove_whishlist_list($id);
    }

    //play video with listing
    public function video_play_list(){ 
        if(!$this->session->userdata("users_id")){
            return redirect(base_url().'frontend/login');
        } else {
            $video_id = $this->input->get('video_id');
            $group_number = $this->input->get('group_number');
            $searchtext = '';
            $dropdownsections = '';
            if(!empty($this->input->get('searchText'))) {
                $searchtext = $this->input->get('searchText');
            }
            if(!empty($this->input->get('dropDownSections'))) {
                $dropdownsections = $this->input->get('dropDownSections');
            }
            
            $detail = $this->admin_detail->get_video_block_isactivated_by_users_and_group_number_youtube(
                $this->session->userdata("users_id"),
                $video_id,
                $searchtext,
                $dropdownsections
            );
            if($detail)
            {
                $data = [];
                foreach($detail as $de){
                    $vid = $this->api_model->get_data('video_id = '.$de['video_id'].' AND isactive="1"', 'vedio_list');
                    $de['video_thumb'] = base_url().'uploads/videos/images/'.$vid[0]['video_thumb'];
                    $userDetails = $this->admin_detail->get_data('users', 'users_id ='.$de['user_id']);
                    if($userDetails){
                        $de['user_name'] = $de['submittedby']; 
                        //$de['user_name']  = $userDetails[0]['full_name'];
                    }else{
                        $adminUserDetails = $this->admin_detail->get_data('admin', 'admin_id ='.$de['user_id']);
                        $de['user_name']  = $adminUserDetails[0]['fname'] . " "  .$adminUserDetails[0]['lname'];
                    }
                    $data[$de['video_id']] = $de;
                }
            }
            else
            {
                $json_data['error'] = '1';
            }
            
            if(!empty($searchtext)) {
                $newForViewFirst = [];
                $newForViewSecond = [];
                $i = 0;
                foreach ($data as $key => $value) {
                    if($i == 0) {
                        $newForViewFirst[] =  $value;
                    } else {
                        $newForViewSecond[] = $value;
                    }
                    $i++;
                }
            } else {
                $newForViewFirst = [];
                $newForViewSecond = [];
                foreach ($data as $key => $value) {
                    if($video_id == $key) {
                        $newForViewFirst[] =  $value;
                    } else {
                        $newForViewSecond[] = $value;
                    }
                }
            }

            $json_data['count']= $this->admin_detail->get_video_block_count();
            $json_data['videolist'] = $data;
            $json_data['url_video_id'] = $video_id;
            $json_data['newForViewFirst'] = $newForViewFirst;
            $json_data['newForViewSecond'] = $newForViewSecond;

            $this->load->view('user_videos/videos/header');
            $this->load->view('user_videos/videos/video_play_list', $json_data);
        }
    }
    //play video_details with listing
    public function video_details(){ 
        // if(!$this->session->userdata("users_id")){
        //     return redirect(base_url().'frontend/login');
        // } else {
            $video_id = $this->input->get('video_id');
            $vid = $this->api_model->get_data('video_id = "'.$video_id.'"' , 'video_block', '', '*');
            $header['head']['title'] = $vid[0]['title'];
            $header['head']['description'] = $vid[0]['description'];
            $header['head']['auther'] = $vid[0]['submittedby'];
            $header['head']['link'] = base_url().'all_videos/video_details?video_id='.$video_id;
            $header['head']['image'] = base_url().'uploads/videos/images/'.$vid[0]['video_thumb'];
            $group_number = $vid[0]['users_video_group_number'];
            $searchtext = '';
            $dropdownsections = '';
            if(!empty($this->input->get('searchText'))) {
                $searchtext = $this->input->get('searchText');
            }
            if(!empty($this->input->get('dropDownSections'))) {
                $dropdownsections = $this->input->get('dropDownSections');
            }
            
            $detail = $this->admin_detail->get_video_block_any_by_users_and_group_number(
                $this->session->userdata("users_id"),
                $group_number,
                $searchtext,
                $dropdownsections
            );
            if($detail)
            {
                $data = [];
                foreach($detail as $de){
                    $image = explode(',',$de['video_thumb']);
                    $de['video_thumb'] = base_url().'uploads/videos/images/'.$image[0];
                    $userDetails = $this->admin_detail->get_data('users', 'users_id ='.$de['user_id']);
                    if($userDetails){
                        $de['user_name'] = $de['submittedby']; 
                        //$de['user_name']  = $userDetails[0]['full_name'];
                    }else{
                        $adminUserDetails = $this->admin_detail->get_data('admin', 'admin_id ='.$de['user_id']);
                        $de['user_name']  = $adminUserDetails[0]['fname'] . " "  .$adminUserDetails[0]['lname'];
                    }
                    $data[$de['video_id']] = $de;
                }
            }
            else
            {
                $json_data['error'] = '1';
            }
            
            if(!empty($searchtext)) {
                $newForViewFirst = [];
                $newForViewSecond = [];
                $i = 0;
                foreach ($data as $key => $value) {
                    if($i == 0) {
                        $newForViewFirst[] =  $value;
                    } else {
                        $newForViewSecond[] = $value;
                    }
                    $i++;
                }
            } else {
                $newForViewFirst = [];
                $newForViewSecond = [];
                foreach ($data as $key => $value) {
                    if($video_id == $key) {
                        $newForViewFirst[] =  $value;
                    } else {
                        $newForViewSecond[] = $value;
                    }
                }
            }

            $json_data['count']= $this->admin_detail->get_video_block_count();
            $json_data['videolist'] = $data;
            $json_data['url_video_id'] = $video_id;
            $json_data['newForViewFirst'] = $newForViewFirst;
            $json_data['newForViewSecond'] = $newForViewSecond;
            $this->load->view('user_videos/videos/header', $header);
            $this->load->view('user_videos/videos/video_details', $json_data);
        // }
    }


    
    //fuunction for payment moethod
    public function video_cart(){
        $this->load->view('user_videos/videos/header');
        $this->load->view('user_videos/videos/cart2');
    }
    public function video_checkout(){
        $this->load->view('user_videos/videos/header');
        $this->load->view('user_videos/videos/checkout');
    }
    public function video_thanku(){
        $this->load->view('user_videos/videos/thanku.php');
    }
    public function video_reg(){
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
    public function video_cart_sess(){
        $video_id = $this->input->get_post('video_id');
        $price = $this->input->get_post('price');
        $users_id = $this->input->get_post('users_id');
        $title = $this->input->get_post('title');
        $qty = $this->input->get_post('qty');
        $video_cart = array();
        $set = 0;
        if($this->session->userdata('video_session')){
            $cart_session = $this->session->userdata('video_session');
            foreach($cart_session as $id=>$val){
                if($val['video_id']==  $video_id){
                    $val['price'] = $price;
                    $val['users_id'] = $users_id;
                    $val['title'] = $title;
                    $val['qty'] = $qty;
                    $set = 1;
                }
                $cart[$id] = $val;
            }
        } 
        if($set==0){
            $video_cart['video_id']  = $video_id;
            $video_cart['price']  = $price;
            $video_cart['users_id'] = $users_id;
            $video_cart['title'] = $title;
            $video_cart['qty'] = $qty;
            $cart[] = $video_cart;
        }
        $this->session->set_userdata('video_session', $cart);
        $cart_session = $this->session->userdata('video_session');
        $arr = array();
        echo json_encode($cart_session );
    }
    public function video_removecart_sess(){
        //print_r($_REQUEST);
        $id = $_POST['id'];
        $count =count($this->session->userdata('video_session'));
        if($count==1)
        $this->session->unset_userdata('video_session');
        $cart_des=$this->session->userdata('video_session');
        print_r($cart_des);
        unset($cart_des[$id]);
        $this->session->set_userdata('video_session',$cart_des);
        //print_r($this->session->userdata("cart_session"));
    }
    public function removevideo(){
        $id =$this->input->get_post('id');
        $this->api_model->removevideo($id);
    }
}