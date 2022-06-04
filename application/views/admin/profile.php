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
<div class="abc" ><h3>User Profile</h3></div>
<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('login_failed')){ ?>
                            <div class="col-lg-10 corm_nmset">
                              <div class="callout callout-danger">
                                <?= $error ?>
                              </div>
                            </div>
    <?php } ?>
    <?php foreach($user_data as $use): ?>
        <?php echo form_open("admin/update_profile/", ['onsubmit'=>'return myFunction()']);?>
            <div class="col-md-3 corm_nmset">
        	       <div ><strong class="right_sre"></strong></div>
            </div>
            <?php //print_r($_SESSION); ?>
            <div class="col-md-9 corm_nmset" >
                <input type="hidden" name="password" class="ch_manset" style="padding: 6px;"> 
                 <?php echo form_input(['name'=>'password','class'=>'ch_manset', 'type'=>'hidden', 'style'=>'padding: 6px;', 'placeholder'=>'Password']); ?>
            </div>
            <div class="col-md-3" > 
        	   <strong class="right_sre"> New Password</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'password','name'=>'newpassword', 'id'=>'newpassword','class'=>'ch_manset padd_set']) ?>
        	</div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Confirm Password</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'password','name'=>'confirmpassword', 'id'=>'confrmpwd','class'=>'ch_manset padd_set']) ?>
            </div>
                        <?php echo form_error('name'); ?>
             <div style="clear: left;"></div>
            <div class="col-md-3 corm_nmset">
                <strong class="right_sre">Name</strong>
            </div>
            <div class="col-md-9 corm_nmset" > 
                <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>''.$use['fname'].'', 'id'=>'confrmpwd', 'style'=>'padding: 6px;', 'class'=>'ch_manset']) ?>
            </div>
                        <?php echo form_error('phone'); ?>
             <div style="clear: left;"></div>
            <div class="col-md-3" >
                <strong class="right_sre">Phone Number</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'phone', 'value'=>''.$use['mobile'].'', 'id'=>'phone', 'class'=>'ch_manset padd_set', 'readonly'=>'readonly']) ?>
            </div>
            <div style="clear: left;"></div>
            <div class="col-md-3" >
                <strong class="right_sre">Email ID</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'email', 'value'=>''.$use['email'].'', 'id'=>'email', 'class'=>'ch_manset padd_set', 'readonly'=>'readonly']) ?>
            </div>
                        <?php echo form_error('address'); ?>
            <div style="clear: left;"></div>
            <div class="col-md-3">
                <strong class="right_sre">Address</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_textarea(['type'=>'text','name'=>'address', 'id'=>'address', 'value'=>''.$use['address'].'', 'class'=>'ch_manset padd_set']) ?>
            </div>
             <div style="clear: left;"></div>
            <div style="margin-left: 27%;" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Submit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px;']),"&nbsp;&nbsp;",
                         form_input(['type'=>'button', "onclick"=>"window.location.href='user_profile'", 'value'=>'Cancel','class'=>'btn btn-default', 'style'=>'width:80px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
<?php endforeach; ?>
</div>
<script type="text/javascript">
 function myFunction() {
    var newpassword = document.getElementById("newpassword").value;
    var confrmpwd = document.getElementById("confrmpwd").value;
    var ok = true;
    if (newpassword != confrmpwd) {
        document.getElementById("newpassword").style.borderColor = "#E34234";
        document.getElementById("confrmpwd").style.borderColor = "#E34234";
        alert('Password and Confirm Password Not Matched');
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
