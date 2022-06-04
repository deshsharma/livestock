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

<div class="abc" ><h3>ADD SYSTEM USER</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/sys_user_add/", ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('role'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Choose User Role</strong>
            </div>
            <div class="col-md-9">
                <?php //print_r($_SESSION); ?>
                <select name="role" id="role" class="form-control" style="margin-bottom: 10px;">
                    <option value="">Select Role</option>
                    <?php
                    $name = ''; 
                    if($_SESSION['type'] == '2' || $_SESSION['type'] == '3'|| $_SESSION['type'] == '1'){
                        //$name = '19';
                        $data = $this->admin_detail->get_role_bank($name, $_SESSION['user_id']);
                    }else{
                        $data = $this->admin_detail->get_role($name, $_SESSION['user_id']);
                    }
                    foreach($data as $d){ ?>
                        <option value="<?= $d['id']?>"><?= $d['role_name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('login_name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">User Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'login_name', 'value'=>'', 'id'=>'login_name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('email'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">User Email</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'email', 'value'=>'', 'id'=>'email','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('password'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">User Password</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'password', 'value'=>'', 'id'=>'newpassword','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('confrmpwd'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">User Confirm Password</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'confrmpwd', 'value'=>'', 'id'=>'confrmpwd','class'=>'ch_manset padd_set']) ?>
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
