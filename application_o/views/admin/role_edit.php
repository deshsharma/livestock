<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php');
$role = $this->admin_detail->get_rol_id($id);
?>
<style type="text/css">
         .error {
            margin: 27%;
            width: auto;
            color:red;
            display: inline;
            font-weight: 100;
        }  
</style>
<div class="content-wrapper" >

<div class="abc" ><h3>Add Your Role</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_rol')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/role_edit/".$id, ['onsubmit'=>'return myFunction()']);?>
            
             <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Role Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>$role['role_name'], 'id'=>'name','class'=>'ch_manset padd_set']); ?>
                <input type="hidden" name="id" value="<?php echo $role['id']; ?>" >
        	</div>
            <div class="col-md-3" > 
               <strong class="right_sre">Module List</strong>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php
                    $rol = explode(',',$role['module_list']);
					//print_r($rol);
                     ?><?php
                     $done="";
                    foreach($navigation as $key => $mode){ 
                         if(in_array($key, $modules)){
                        //foreach($rol as $r){
                            if(in_array($key, $rol)){$checked = "checked='checked'";}else{$checked="";}
                                ?>
                                <!--<div class="col-md-4">
                                    <input type="checkbox" name="module_<?php echo $key; ?>" <?php echo $checked;?> ><?php echo $mode['Text'];  ?>
                                </div>-->
                                <ul>
                                    <li>
                                    <input type="checkbox" name="module[]" value="<?php echo $key; ?>"  <?php echo $checked;?> ><?php echo $mode['Text'];  ?>
                                    <?php 
                                        if(isset($mode['submenu'])){
                                            
                                                echo '<ul>';
                                                foreach($mode['submenu'] as $subkey => $submode) 
                                                {
                                                    if(in_array($subkey, $modules)){
                                                        if(in_array($subkey, $rol)){$checked = "checked='checked'";}else{$checked="";}
                                                        echo '<li><input type="checkbox" name="module[]" value="'.$subkey.'" '.$checked.'>'.$submode['Text'].'</li>';
                                                    }
                                                    //print_r($submode);
                                                }
                                                echo '</ul>';
                                        }
                                    ?>
                                    </li>
                                </ul>
                                <?php
                                $done = "yes";
                        //}
                        $done = "";
                        }
                    }
                    ?>
                  </div>  
                </div>
            <div style="margin-left: 27%; margin-top:10px;" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Update', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
<script type="text/javascript">
 function myFunction() {
    var newpassword = document.getElementById("newpassword").value;
    var confrmpwd = document.getElementById("confrmpwd").value;
    var ok = true;
    if (newpassword != confrmpwd) {
        document.getElementById("newpassword").style.borderColor = "#E34234";
        document.getElementById("confrmpwd").style.borderColor = "#E34234";
        ok = false;
    }
    else 
	{
           ok = true;
    }
    return ok;
}
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>
