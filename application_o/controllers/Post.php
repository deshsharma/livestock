<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('new_api_model');
		$this->load->model('login_cheak_model');
		$this->load->model('loginmodel');
		$this->load->model('pushnoti_model');
		$this->load->model('front_end_model');
		$this->load->model('Admin_detail');
		$this->load->library('form_validation');  
		date_default_timezone_set('Asia/Calcutta');
	}
	public function post(){
		$data['users_id'] = $this->input->get_post('users_id');
		$data['user_type'] = $this->input->get_post('user_type');
		$data['title'] = $this->input->get_post('title');
		$data['description'] = $this->input->get_post('description');
		$data['is_active'] = '1';
		$data['created_on'] = date('Y-m-d H:i:s');
		$image = $this->input->get_post('post_image'); 
		$post_img = json_decode($image);
		$post['is_active'] = '1';
		$post['created_on'] = date('Y-m-d H:i:s');
		$video = $this->input->get_post('post_video'); 
		$post_video = json_decode($video);		
		$id = $this->api_model->post($data);
		if($id){
			$post['post_id'] = $id;
			foreach($post_img as $img){
				$post['post_image'] = $img;
				$post['type'] = '0';
				$details = $this->api_model->submit('post_image',$post);
			}
			foreach($post_video as $vid){
					$post['post_image'] = $vid;
					$post['type'] = '1';
					$details = $this->api_model->submit('post_image',$post);
			}
			$json['success']  = true; 
			$json['msg'] = 'Successfully Posted';
			
		}else{
			$json['success']  = false; 
			$json['error'] = 'database error.';
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
		
	}
	public function get_post(){
		$users_id = $this->input->get_post('users_id');
		$my_post = $this->input->get_post('my_post');
		$post_id = $this->input->get_post('post_id');
		$start = $this->input->get_post('start');
		$limit = $this->input->get_post('limit');
		if($my_post == '1'){
			$my_post = "AND users_id = ".$users_id."";
		}
		if($post_id != ''){
			$post_id = "AND id = ".$post_id."";
		}
		//print_r($post_id);
		$post_data =  $this->api_model->query_build("SELECT id,users_id,user_type,title,description,created_on,(SELECT username FROM doctor where 	doctor_id = po.users_id) as user_name,(SELECT mobile FROM doctor where doctor_id = po.users_id) as mobile, CONCAT('".base_url('uploads/doctor')."/', (select image from doctor where doctor_id = po.users_id)) as user_image  FROM post as po where  is_active = '1' ".$my_post.$post_id." AND (SELECT id from post_fallow where users_id = ".$users_id." AND followed_id = po.users_id) IS NULL ORDER BY id DESC LIMIT ".$start.",".$limit." ");
		$count =  $this->api_model->query_build("SELECT count(id) as count  FROM post as po where (SELECT id from post_fallow where users_id = ".$users_id." AND followed_id = po.users_id) IS NULL ".$my_post.$post_id." AND is_active = '1' ORDER BY id DESC");
		$detail = [];
		$i=0;
		foreach($post_data as $da){
			$data = $this->api_model->get_data('post_id = "'.$da['id'].'" AND type = "0"' , 'post_image', '', 'id, post_image');
			if($data[0]['post_image'] !=''){
			$da['image'][0] = 'https://amazebrandlance.com/uploads/post/'.$data[0]['post_image'];
			}else{
				$da['image'] = [];
			}
			$data = $this->api_model->get_data('post_id = "'.$da['id'].'" AND type = "1"' , 'post_image', '', 'id, post_image');
			if($data[0]['post_image'] != ''){
			$da['video'][0] = 'https://amazebrandlance.com/uploads/post/'.$data[0]['post_image'];	
			}else{
				$da['video'] = [];
			}
			
			$comm = $this->api_model->get_data('post_id = "'.$da['id'].'"' , 'post_comment as pc', 'id DESC', 'id,users_id,created_on, comment,CONCAT("'.base_url('uploads/doctor').'/", (select image from doctor where doctor_id = pc.users_id)) as user_image,(SELECT username FROM doctor where doctor_id = pc.users_id) as user_name', '0','2');
			$comment_count = $this->api_model->get_data('post_id = "'.$da['id'].'"','post_comment','','count(id) as count');
			 	if($pro = $this->api_model->get_data('post_id = "'.$da['id'].'" AND users_id = "'.$users_id.'"',  'post_like')){
		            $cou =  $this->api_model->get_data('post_id = "'.$da['id'].'"',  'post_like', '', 'count(id) as count');
		            $user_like  = '1';
		            $like_count = $cou[0]['count'];
		        }else{
		            $cou =  $this->api_model->get_data('post_id = "'.$da['id'].'"',  'post_like', '', 'count(id) as count');
		            $user_like  = '0';
		            $like_count = $cou[0]['count'];
		        }

			$da['comment'] = $comm;
			$da['user_like'] = $user_like;
			$da['like_count'] = $like_count;
			$da['comment_count'] = $comment_count[0]['count'];
			$detail[$i] = $da;
			$i++;
			//print_r($data);
		}
		if($detail){
			$json['success']  = TRUE;
			$json['data'] = $detail;
			$json['count'] = $count[0]['count'];
		}else{
			$json['success']  = FALSE;
			$json['error'] = "No Data Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	 public function add_like(){ 
        $data['post_id'] = $this->input->get_post('post_id');
        $data['users_id'] = $this->input->get_post('users_id');
        $data['created_on'] = date('Y-m-d h:i:s');
       
        if($pro = $this->api_model->get_data('post_id = "'.$data['post_id'].'" AND users_id = "'.$data['users_id'].'"',  'post_like')){
            if($this->api_model->removepostlike($pro[0]['id'])){
            	$cou =  $this->api_model->get_data('post_id = "'.$data['post_id'].'"',  'post_like', '', 'count(id) as count');
                $json['success']  = TRUE;
                $json['flag']  = '0';
                $json['msg'] ="Remove like";
                $json['count'] = $cou[0]['count'];
            }else{
                $json['success']  = false;
                $json['error'] = "database problem";
            }
        }else{
            if($this->api_model->submit('post_like', $data)){
            	$cou =  $this->api_model->get_data('post_id = "'.$data['post_id'].'"',  'post_like', '', 'count(id) as count');
                $json['success']  = TRUE;
                $json['flag']  = '1';
                $json['msg'] ="Added like";
                $json['count'] = $cou[0]['count'];
            }else{
                $json['success']  = false;
                $json['error'] = "database problem";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
    public function add_comment(){
    	$data['users_id'] = $this->input->get_post('users_id');
    	$data['user_type'] = $this->input->get_post('user_type');
    	$data['post_id'] = $this->input->get_post('post_id');
    	$data['comment'] = $this->input->get_post('comment');
    	$data['created_on'] = date('Y-m-d H:i:s');
    	if($details = $this->api_model->submit('post_comment',$data)){
    		$count = $this->api_model->get_data('post_id = '.$data['post_id'].'','post_comment','','count(id) as count');
			$data['id'] = $details;
			$user = $this->api_model->get_data('doctor_id = "'.$data['users_id'].'"','doctor','','username, CONCAT("'.base_url('uploads/doctor').'/", image) as image');
			$doc_id = $this->api_model->get_data('id = '.$data['post_id'].'','post','','users_id');
			$data['user_name'] =  $user[0]['username'];
			$data['user_image'] =  $user[0]['image'];
    		$json['success']  = TRUE;
            $json['msg'] ="Added comment";
			$json['data'][] = $data;
            $json['count'] = $count[0]['count'];
				$old_msg['to_users_id'] =  $doc_id[0]['users_id'];
				$old_msg['to_id'] =  $doc_id[0]['users_id'];
				$old_msg['to_type'] = 'users';
				$old_msg['title'] = $user[0]['username'];
				$old_msg['from_type'] = 'Livestoc Team';
				$old_msg['success'] = '1';
				$old_msg['device'] = 'android';
				$old_msg['active'] = '1'; 
				$old_msg['description'] = $data['comment'];
				$old_msg['date_added'] = date('Y-m-d h:i:s');
				$this->api_model->old_notification($old_msg);
				$msg['users_id'] = $doc_id[0]['users_id'];
				$msg['title'] = $user[0]['username'];
				$msg['message'] = $data['comment'];
				$msg['date'] = date('Y-m-d h:i:s');
				$msg['type'] = '1';
				$msg['isactive'] = '1';
				$msg['flag'] = '8';
				$this->api_model->user_notification($msg);
				$this->load->helper('push_notification');
				push_non($msg['users_id'], 1 , $msg['title'], $data['post_id'], $msg['flag'], PARAVATE_SERVERKEY, PARAVATE_SERVERKEY, $msg['message'], $fcm_and= '', $fcm_ios = '');
    	}else{
    		$json['success']  = false;
            $json['error'] = "database problem";
    	}
    	header('Content-Type: application/json');
        echo json_encode($json);
        exit;
    }
	public function unfollow_list(){
		$users_id = $this->input->get_post('users_id');
		$users_type = $this->input->get_post('users_type');
		if($detail = $this->api_model->get_data('users_id = '.$users_id.' AND user_type = "'.$users_type.'"','post_fallow', '','followed_id as users_id, if(followed_type = "1", (select username from doctor where doctor_id = followed_id), "") as user_name, if(followed_type = "1", CONCAT("'.base_url('uploads/doctor').'/",(select image from doctor where doctor_id = followed_id)), "") as  user_image, followed_type')){
			$json['success']  = true;
            $json['data'] = $detail;
		}else{
			$json['success']  = false;
            $json['error'] = "No Listing found";
		}
		header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
	public function get_all_comment(){
		$post_id = $this->input->get_post('post_id');
		$details = $this->api_model->get_data('post_id = "'.$post_id.'"','post_comment as pc','','*,CONCAT("'.base_url('uploads/doctor').'/", (select image from doctor where doctor_id = pc.users_id)) as user_image,(SELECT username FROM doctor where doctor_id = pc.users_id) as user_name');		
		if($details){
			$json['success']  = TRUE;
			$json['data'] = $details;
		}else{
			$json['success']  = FALSE;
			$json['error'] = "No Data Found";
		}
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
	public function fallow_unfallow(){
		$data['followed_id'] = $this->input->get_post('followed_id');
		$data['followed_type'] = $this->input->get_post('followed_type');
        $data['users_id'] = $this->input->get_post('users_id');
		$data['user_type'] = $this->input->get_post('user_type');
        $data['created_on'] = date('Y-m-d h:i:s');
        $upda['follow'] = '0';
        if($pro = $this->api_model->get_data('followed_id = "'.$data['followed_id'].'" AND users_id = "'.$data['users_id'].'"',  'post_fallow')){
            if($this->api_model->removeunfallow($pro[0]['id'])){ 
                $json['success']  = true;
				$json['flag']  = '1';
                $json['msg'] ="Successfully Followed";
            }else{
                $json['success']  = false;
                $json['error'] = "database problem";
            }
        }else{
            if($this->api_model->submit('post_fallow', $data)){  
                $json['success']  = true;
				$json['flag']  = '0';
                $json['msg'] ="Successfully Un-Followed. Now you will not be able to see the post, posted by this person";
            }else{
                $json['success']  = false;
                $json['error'] = "database problem";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
        exit;
	}
	public function delete_post(){	
		$id = $this->input->get_post('post_id');
		$users_id = $this->input->get_post('users_id');
		if(!isset($id) || $id == ''){
			$json['success']  = false; 
			$json['error'] = "Please send Post Id";
		}else if(!isset($users_id) || $users_id == ''){
			$json['success']  = false; 
			$json['error'] = "Please send users Id";
		}else{
			if($this->api_model->own_query('DELETE FROM post WHERE id = "'.$id.'" AND users_id = "'.$users_id.'"')){
				$json['success']  = true; 
				$json['msg'] = "Successfully Deleted";
			}else{
				$json['success']  = false; 
				$json['msg'] = "Something Went Wrong.";
			}
		}			
		header('Content-Type: application/json');
		echo json_encode($json);
		exit;
	}
}