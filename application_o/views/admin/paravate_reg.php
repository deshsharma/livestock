<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php'); 
//print_r($dept);
if(isset($data))
{
	$name = $data['name'];
	$address= $data['address'];
    $password = $data['password'];
    $conf_password = "";
    $phone = $data['phone'];
}else{
	$name = "";
	$address= "";
	$reg_no = "";
    $phone = "";
    $password = "";
    $conf_password = "";
}

$roles = $this->admin_detail->get_role();

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

<div class="abc" ><h3>ADD USER</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('superv_add')){ ?>
                            <div class="col-lg-10 corm_nmset">
                              <div class="callout callout-danger">
                                <?= $error ?>
                              </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/add_superv/", ['onsubmit'=>'return myFunction()']);?>
            <div class="col-md-12"><?php echo form_error('type'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Type </strong>
            </div>
            <div class="col-md-9">
                <select name="type" class="ch_manset padd_set">
                	<option value="0">Select Type</option>
                    <option value="So">So</option>
                    <option value="Sv">Supervisor</option>
                    <option value="govt_vt">Veterinarian</option>
                </select>
            </div>
            <div class="col-md-12"><?php echo form_error('name'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'id'=>'name','value'=>$name,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('fname'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Father Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'fname', 'id'=>'fname','value'=>$name,'class'=>'ch_manset padd_set']); ?>
        	</div>
             <div class="col-md-12"><?php echo form_error('phone'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Phone NO</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'phone', 'value'=>$phone, 'id'=>'phone', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('phone2'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Secound Phone NO</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'phone2', 'value'=>$phone2, 'id'=>'phone2', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('reg_no'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Registration NO</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'reg_no', 'value'=>$reg_no, 'id'=>'reg_no', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('reg_year'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Registration Year</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'reg_year', 'value'=>$reg_year, 'id'=>'reg_year', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('reg_council'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Registration council</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'reg_council', 'value'=>$reg_council, 'id'=>'reg_council', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('aadhar_no'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Aadhar No</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'aadhar_no', 'value'=>$aadhar_no, 'id'=>'aadhar_no', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('adhaar_img'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Aadhar Image</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'adhaar_img', 'value'=>$adhaar_img, 'id'=>'adhaar_img', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('gender'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Gender</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'gender', 'value'=>$gender, 'id'=>'gender', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('dob'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Dob</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'dob', 'value'=>$dob, 'id'=>'dob', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3 ">
                <strong class="right_sre">Password</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_password(['name'=>'password', 'value'=>$password, 'id'=>'password', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3 ">
                <strong class="right_sre">Confirm Password</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_password(['name'=>'conf_password', 'value'=>$conf_password, 'id'=>'conf_password', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
        	 <div style="clear: left;"></div>
        	 <div class="col-md-12"><?php echo form_error('address'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Address </strong>
            </div>
             <div class="col-md-9">
                <?php echo form_textarea(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'address', 'id'=>'address','value'=>$address,'class'=>'ch_manset padd_set']) ?>
            </div>
        	 <div style="clear: left;"></div>
        	 <div class="col-md-12"><?php echo form_error('role'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Role </strong>
            </div>
             <div class="col-md-9">
                <select name="role" class="ch_manset padd_set">
                	<option value="0">Select Role</option>
                    <?php
                    if($roles){
						foreach($roles as $role){
							$onclick='';

							if($role['id']!=CUSTOMER){
								echo '<option value="'.$role['id'].'" onclick="show_hospital(this.value)">'.$role['role_name'].'</option>';	
							}
						}
					}
					?>
                </select>
            </div>
            <div style="clear: left;"></div>
            <div style="margin-left: 27%;" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Submit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'margin-top:27px;']),
                         form_input(['type'=>'button', "onclick"=>"window.location.href='superv_list'", 'value'=>'Cancel','class'=>'btn btn-default', 'style'=>'margin-top:27px; margin-left: 10px;']);
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
 <script>
  $(document).ready(function(){ 
	 $('select[name=role]').change(function(){
	   if($(this).val()=='<?php echo CALLER;?>' || $(this).val()=='<?php echo SERVICE_BOY;?>' || $(this).val()=='<?php echo HOSPITAL;?>'){
			$("#hsp").show();
	   }else{
			$("#hsp").hide();   
	   }
	 });
	$("#hsp").hide(); 
 });
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>
