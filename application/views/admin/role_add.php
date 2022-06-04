<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php');
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
        <?php echo form_open("admin/role_add_editor/", ['onsubmit'=>'return myFunction()']);?>
            <?php //print_r($_SESSION) ?>
             <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <div class="col-md-3" > 
               <strong class="right_sre">Select Permission</strong>
            </div>
            <div class="col-md-9">
                <div class="row">
                <php if ?>
                <?php foreach($navigation as $key => $mode): ?>
                    <?php if(in_array($key, $modules)){ ?>
                    <ul>
                        <li>
                                <input type="checkbox" name="module[]" value = "<?php echo $key; ?>"><?php echo $mode['Text'];  ?>
                                    <?php 
                                        if(isset($mode['submenu_num'])){
                                            if(in_array($subkey, $modules)){
                                                echo '<ul>';
                                                foreach($mode['submenu'] as $subkey => $submode) 
                                                {
                                                    echo '<li><input type="checkbox" name="module[]" value = "'.$subkey.'">'.$submode['Text'].'</li>';
                                                }
                                                echo '</ul>';
                                            }
                                        }
                            ?>
                        </li>
                    </ul>
                    <?php } ?>
                <?php endforeach; ?>
                </div>
            </div>
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Add', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
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
