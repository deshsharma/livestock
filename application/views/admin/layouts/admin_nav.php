<?php
$url = base_url('assets/admin/json/module.json');
/*$string = file_get_contents($url); 
$navigation = json_decode($string,true);*/

$string = file_get_contents('assets/admin/json/module.json');
$navigation = json_decode($string,true);
// echo json_last_error();
// echo json_last_error_msg();
// print_r($navigation);
$role = $this->admin_detail->get_rol_id($this->session->userdata("status"));
//print_r($role);
$modules = explode(",",$role['module_list']);
?>
<script type="text/javascript">
	function subMenuItems(id, val){
		document.getElementById(id).innerHTML = val;	
	}
</script>

<aside class="main-sidebar">
   <section class="sidebar">
   <div class="user-panel">
       <div class="pull-left image">
          &nbsp
        </div> 
        <div class="pull-left info">
          <p><?= $role['role_name'] ?></p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
     <ul class="sidebar-menu" data-widget="tree">
        <?php foreach($navigation as $key => $nav): 
			if(in_array($key, $modules)){
			?>
          <?php if(isset($nav['submenu'])){?>
               <li class="treeview" id=<?php echo "'main_".$key."'"; ?>>
              <a href="#" onclick="clickMenu(this);">
                <i class="fa fa-files-o"></i>
                <span><?php echo $nav['Text']; ?></span>
                <span class="pull-right-container">
                  <span id="sbnum_<?php echo $key; ?>" class="label label-primary pull-right"><?php //echo $nav['submenu_num']; ?></span>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php
				$subnum=0; 
				foreach($nav['submenu'] as $subkey => $nav_sub): 
					if(in_array($subkey, $modules)){
					?>
					 <li id=<?php echo "'main_".$key."'"; ?>><?= anchor(''.$nav_sub['Url'].'','<i class="fa '.$nav_sub["class"].'"></i>'.$nav_sub['Text'].'', array('onclick'=>'clickMenu(this);')) ?></li>
					<?php
						$subnum++;
					}
				endforeach; ?>
                <script>subMenuItems('sbnum_<?php echo $key; ?>', '<?php echo $subnum;?>')</script>
             </ul>
            </li>
          <?php }else{?>
            <li id=<?php echo "'main_".$key."'"; ?>>
              <?= anchor(''.$nav['Url'].'','<i class="fa '.$nav["class"].'"></i><span>'.$nav['Text'].'</span>', array('onclick'=>'clickMenu(this);')) ?>
            </li>          
        <?php } } endforeach; ?>
   </ul>
  </section>
</aside>
<script type="text/javascript">
    function clickMenu(object){
        localStorage.setItem("selected_node", $(object).parent().attr('id'));
    }
    
    /*This is only work on logout and home logo*/
    function removeMenu(){
        localStorage.removeItem("selected_node");
    }

   
    if(localStorage.getItem("selected_node") == null || localStorage.getItem("selected_node") == 'main_0'){
       $('#main_0').addClass('active');
    }
    else
    {
       $('#'+localStorage.getItem("selected_node")).addClass('active');
       if($('#'+localStorage.getItem("selected_node")).parent().attr('class') == 'treeview-menu'){
           $('#'+localStorage.getItem("selected_node")).parent().parent().addClass('menu-open');
           $('#'+localStorage.getItem("selected_node")).parent().css('display','block');
       }
    }
</script>
