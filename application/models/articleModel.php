<?php
class articleModel
{
    
    public static $_table='article';
	public static $_table_event_log = 'event_log';
    public static $_primary='article_id';
    
  
 
      
    
   public static function articlelimited($start='',$page='',$limit='',$where='',$sort='',$sortorder='',$users_id ='')
    {
 
        global $db;
       $data=array();
        $start = intval($start);
        $page = intval($page);
        $limit = intval($limit);
        $sort=$db->escape( $sort );
        $sortorder=$db->escape( $sortorder );


        if($sort=='')
        {
            $sort= "article_id";
        }

        if($sortorder=='')
        {
            $sortorder='desc';
        }

        $orderby = " order by $sort $sortorder";
		
    
        $req = $db->query("SELECT article_id,title,sub_texts,images FROM ".self::$_table." $where $orderby LIMIT $start, $limit");

        $count = $db->num_rows($req);
        while($row=$req->fetch_assoc())
        {
			$article_id = $row['article_id']; 
			
            if($row['images'] != ''){
            $row['image'] = BASE_URL."uploads_new/articles/".$row['images'];
			  $row['image_thumb'] = BASE_URL."uploads_new/articles/thumb/".$row['images'];
            }
      
             $get_like = self::get_article_like($article_id);
           $row['article_total_like']=  $get_like; 
		  
		   if($users_id!="") 
			   {
				   $like_event = self::check_article_like_by_user($users_id,$article_id);
				 
				   $row['like_user']=  $like_event; 
											
			   }
			   else
			   {
				    $row['like']=  '0';
			   }
		  
            $data[] =  $row;
        }


        return $data;

    }


    public static function articleallrows($where='')
    {
 
        global $db;
        $req = $db->query("SELECT article_id,title,sub_texts,images FROM ".self::$_table." $where");
        $count = $db->num_rows($req);

        return $count;

    }

		public static function get_article_like($article_id){
          global $db;

            $req = $db->query("SELECT event_log_id FROM ".self::$_table_event_log." where event_id = '$article_id' and event_status='0' and type='3' and isactivated ='1'");
		   $count = $db->num_rows($req); 
		   if($count>0)
		   {
			
			   return $count;
		   }
		   else
		   {
			  
			   return 0;
		   }
		   
	
    }
	
	public static function check_article_like_by_user($users_id,$article_id){
          global $db;

		 
            $req = $db->query("SELECT event_log_id FROM ".self::$_table_event_log."  where users_id = '$users_id' and event_id='$article_id' and event_status='0' and type='3' and isactivated ='1'");
		   $count = $db->num_rows($req);
		   if($count>0)
		   {
			
			   return $count;
		   }
		   else
		   {
			  
			   return 0;
		   }
		   
	
    }
	
	   public static function single_article($article_id,$users_id ='')
    {
 
        global $db;
       $data=array();
       $query = "SELECT article_id,title,texts,images,author_name,isactivated,created_on FROM ".self::$_table." WHERE article_id ='$article_id'";
       
        $req = $db->query($query);

        $count = $db->num_rows($req);
        $row=$req->fetch_assoc();
        
		$article_id = $row['article_id']; 
			
            if($row['images'] != ''){
            $row['image'] = BASE_URL."uploads_new/articles/".$row['images'];
			  $row['image_thumb'] = BASE_URL."uploads_new/articles/thumb/".$row['images'];
            }
      
             $get_like = self::get_article_like($article_id);
           $row['article_total_like']=  $get_like; 
		  
		   if($users_id!="") 
			   {
				   $like_event = self::check_article_like_by_user($users_id,$article_id);
				 
				   $row['like_user']=  $like_event; 
											
			   }
			   else
			   {
				    $row['like']=  '0';
			   }
		  
           if($row)
		   {
			    return $row;
		   }
		   else
		   {
			    return FALSE;
		   }
      


    }
	
	   public static function insertarticle($fieldvalues)
    {
        global $db;
//       print_r($fieldvalues);
//       print_r($where);

        $req = $db->insert('article',$fieldvalues);
        if($req)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
  
   
}