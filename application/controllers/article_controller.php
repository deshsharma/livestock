<?php

//   ini_set('display_errors', 1);
//   ini_set('display_startup_errors', 1);
//   error_reporting(E_ALL);   
  class articleController {
     
    public static $_route='article';
    public static $_model='articleModel';
    public static $_primary='article_id';  
      
    public function __construct() {
        
    }

      public function index()
      {

          $metatitle ="View Article";
          $_primary = self::$_primary;
          $_route = self::$_route;
          $_model = self::$_model;
		  $json = array();
          require_once('models/'.$_model.'.php');

          // Pagination
          $page=1;
          $limit=10;
          $start=0;

          if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
              $page=$_REQUEST['page'];
          }
          if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
              $limit=$_REQUEST['limit'];
          }

          $start=($page-1)*$limit;
          // Pagination

          if(isset($_REQUEST['sort']) && $_REQUEST['sort']!=''){
              $sort=$_REQUEST['sort'];
          }

          if(isset($_REQUEST['sortorder']) && $_REQUEST['sortorder']!=''){
              $sortorder=$_REQUEST['sortorder'];
          }

          $where=" where 1";
          $searchkeyword = $_REQUEST['searchkeyword'];
          if($searchkeyword!='')
          {
              $where.=" and category like '%$searchkeyword%'";
          }

          $where.=" and isactivated = '1'";

           $users_id = $_REQUEST['users_id']; 
          $category_id = $_REQUEST['category_id'];
          if($category_id != ''){
              $where.=" and category_id = '$category_id'";
          }
	      
		   $article_id = $_REQUEST['article_id'];
          if($article_id != ''){
              $where.=" and article_id = '$article_id'";
          }


          $all = $_model::articlelimited($start,$page,$limit,$where,$sort,$sortorder,$users_id);

          $countrows = $_model::articleallrows($where);

    

          if($all)
          {
              $json['success'] = True;
			   $json['data']= $all;
			   $json['total']= $countrows;
               
          }
          else
          {
			   $json['success'] = FALSE;
              $json['error'][] = "Listing Not Available";
          }

          header('Content-Type: application/json');
        echo json_encode($json);
        exit;
      }

    
     public function all(){
		
		$metatitle ="View ALL Article";
          $_primary = self::$_primary;
          $_route = self::$_route;
          $_model = self::$_model;
		$json = array();
          require_once('models/'.$_model.'.php');
		// Pagination
        $page = 1;
        $limit = 10;
        $start = 0;
		
        if (isset($_REQUEST['page']) && $_REQUEST['page'] != '') {
            $page = $_REQUEST['page'];
        }
        if (isset($_REQUEST['limit']) && $_REQUEST['limit'] != '') {
            $limit = $_REQUEST['limit'];
        }

        $start = ($page - 1) * $limit;
        // Pagination

        if (isset($_REQUEST['sort']) && $_REQUEST['sort'] != '') {
            $sort = $_REQUEST['sort'];
        }

        if (isset($_REQUEST['sortorder']) && $_REQUEST['sortorder'] != '') {
            $sortorder = $_REQUEST['sortorder'];
        }

		
          $where=" where 1";
         $category_id = $_REQUEST['category_id'];
          if($category_id != ''){
              $where.=" and category_id = '$category_id'";
          }
	      
		   $article_id = $_REQUEST['article_id'];
          if($article_id != ''){
              $where.=" and article_id = '$article_id'";
          }
            $where.=" and isactivated = '1'";

           $users_id = $_REQUEST['users_id'];


        $all_articles = $_model::articlelimited($start,$page,$limit,$where,$sort,$sortorder,$users_id);
	
        $countrows = $_model::articleallrows($where);
 
		
        // Pagination
        $paginate = globalfunctions::pagination($limit, $page, SITE_URL . $_route . '/all?category_id=' . $_REQUEST['category_id'] . '&limit=' . $_REQUEST['limit'] . '&sort=' . $_REQUEST['sort'] . '&sortorder=' . $_REQUEST['sortorder'] . '&page=', $countrows); //call function to show pagination
        // Pagination.'&limit='.$_REQUEST['limit']


		 
		 require_once('views/'.$_route.'/all.php');
      
    }
	
	  public function singleArticle(){
		
		$metatitle ="View Single Article";
          $_primary = self::$_primary;
          $_route = self::$_route;
          $_model = self::$_model;
		$json = array();
          require_once('models/'.$_model.'.php');
		// Pagination
        $article_id = $_REQUEST['article_id'];
		
      if(!isset($_REQUEST['article_id']))
	  {
		  $error = "Articel id is required";
	  }
	  
	  if(isset($_REQUEST['users_id']))
	  {
		  $users_id = $_REQUEST['users_id'];
	  }
        

        $single_articles = $_model::single_article($article_id,$users_id);
	   
		 require_once('views/'.$_route.'/singleArticle.php');
      
    }
   
    
   
     public function add_article()
      {

          global $db;

           $metatitle ="Add Article";
		 
          $_primary = self::$_primary;
          $_route = self::$_route;
          $_model = self::$_model;
          $success='';
          $error='';
          require_once('models/'.$_model.'.php');
         // $categories =  $_model::fetch_category();



          if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Go'){

               $title              =  trim($_REQUEST['title']);
               $author_name        =  trim($_REQUEST['author_name']);
               $category_id        =  trim($_REQUEST['category_id']);
               $texts              =  $_REQUEST['texts'];
               $sub_texts          =  "";
               $isactivated        =  1;

              if($title == ''){
                  $error = 'Title is Required';
              }
              
              if($author_name == ''){
                  $error = 'Author Name is Required';
              }

              if($category_id == ''){
                  $error = 'Category Id is Required';
              }

              if($texts == ''){
                  $error = 'Text is Required';
              }

              if($isactivated == ''){
                  $error = 'Activate field is Required';
              }



                if (isset($_FILES["images"]["name"]) && $_FILES["images"]["name"]!='') {

                $allowedExts = array("jpg", "jpeg", "gif", "png");
                $extension = strtolower(end(explode(".", $_FILES["images"]["name"])));
                if ((($_FILES["images"]["type"] == "image/gif")
                        || ($_FILES["images"]["type"] == "image/jpeg")
                        || ($_FILES["images"]["type"] == "image/png")
                        || ($_FILES["images"]["type"] == "image/pjpeg"))
                    && ($_FILES["images"]["size"] < 1024*1024*40)
                    && in_array($extension, $allowedExts)) {
                    if ($_FILES["images"]["error"] > 0) {
                        $error.="File Upload Error 1<br/>";
                    } else {
                        $logo=time().".".$extension;
					  
						
				
                        if(move_uploaded_file($_FILES["images"]["tmp_name"], SITE_ROOT."../uploads_new/articles/". $logo)){
							
                            $tempFileName = SITE_ROOT. "../uploads_new/articles/" . $logo;
                            $newFilePath = SITE_ROOT. "../uploads_new/articles/thumb/" . $logo;
                            make_thumb($tempFileName,$newFilePath,300,300);
                        }else{
                            
                            $error.="File Upload Error 3 1.<br/>";
                        }


                    }
                } else {
                    $error.="File Upload Error 2.<br/>";
                }
            }

			
              if($error==''){

                  $fieldvalues = [
                      'title'              =>  $title,
                      'author_name'        =>  $author_name,
                      'category_id'        =>  $category_id,
                      'texts'              =>  $texts,
                      'sub_texts'              =>  $sub_texts,
                      'isactivated'        =>  $isactivated,
                      'created_on'            =>  date('Y-m-d H:i:s'),
                  ];
                  if($newFilePath){
                      $fieldvalues['images'] = $logo;
                  }
                  $update = $_model::insertarticle($fieldvalues);
                  if($update){
                    echo   $success = "Added Successfully";
                  }else{
                      echo $error = "Error updating";
                  }

              }
		  else{
			  
			   echo $error;

          }


          
      }


	  }
    
  }
?>