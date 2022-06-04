<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Category_model');
    }
    public function get_category(){
      $detail = $this->Category_model->get_category();
      foreach($detail as $de){
        $de['logo'] = base_url()."uploads/category/".$de['logo'];
        $daat[] =$de;  
      }
      $detail = $daat;
                  if($detail){
                      $data['success'] =  True;
                      $data['data'] =  $detail;
                  }else{
                      $data['success'] =  False;
                      $data['error'] =  "There is no found";
          }
          header('Content-Type: application/json');
          echo json_encode($data);
          exit;
  }

   public function get_breed(){
		$category_id =$this->input->get_post('category_id');
		if(!isset($category_id))
		{
			 $data['error'] = "category id is required";
		}
		if(!$category_id)
		{
			 $data['error'] = "category id is required";
		}
    if(empty($data['error'])){
					          $detail = $this->Category_model->get_breed($category_id);
                    $data['success'] =  True;
                    $data['data'] =  $detail;
                }
				else
				{
                    $data['success'] =  False;   
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
}
}