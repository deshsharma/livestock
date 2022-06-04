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
//$type = $this->admin_detail->get_district_manager();
//$state = $this->admin_detail->get_state();

//$district = $this->admin_detail->get_district();

// foreach($state as $st){
//     $dis = $this->admin_detail->get_district($st['state_id']);
//     print_r($st);
//     print_r($dis);
//     //exit;
// }
//echo "This is testing";;

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
        <?php echo form_open("admin/manager_reg/", ['onsubmit'=>'return myFunction()']);?>
        <div class="col-md-12"><?php echo form_error('type'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Image </strong>
               <div class="form-group ref" style="margin-left: 222%;height: 37px;margin-top: -12px;display:none;">
                <img src="https://www.livestoc.com/harpahu_merge_dev/assets/gif/source.gif" style="height: 38px;">
            </div>
            </div>
            
            <div class="col-md-9">
                <input data-required="image" type="file" id="bull_image" class="image-input" data-traget-resolution="image_resolution" value="">
                <input type="hidden" name="animal_image" id="bull_photo" value="">
            </div>
        <div class="col-md-12"><?php echo form_error('type'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Type </strong>
            </div>
            <div class="col-md-9">
                 <select name="type" id="type" class="ch_manset padd_set">
                    <option value="0">Select Type</option>
                    <option value="pvt_dis">Dirstrict Manager</option>
                    <option value="pvt_adis">Assistant Dirstrict Manager</option>
                    <option value="pvt_milk">Yield Checker</option>
                </select>
            </div>
            <div id="dist_man">
            <div class="col-md-3" > 
               <strong class="right_sre">Select District Manager </strong>
            </div>
            <div class="col-md-9">
               <?php $data = $this->admin_detail->get_district_manager();// print_r($data); ?>
                    <select class="form-control " name="r_code" required>
                        <option value=" ">Select District Manager</option>

                            <?php foreach($data as $d){ ?>
                            <option value="<?= $d['refral_code'] ?>"><?= $d['username'] ?></option>
                            <?php } ?>
                    </select>
                <!-- <select name="dis" class="ch_manset padd_set">
                    <option value="0">Select Type</option>
                    <option value="pvt_dis">District Manager</option>
                     <option value="pvt_milk">Milk Checker</option>
                    
                   
                </select> -->
            </div>
            </div>
            <div class="col-md-12"><?php echo form_error('name'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">First Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'id'=>'name','value'=>$name,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('fname'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Last Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'lname', 'id'=>'fname','value'=>$name,'class'=>'ch_manset padd_set']); ?>
        	</div>
             <div class="col-md-12"><?php echo form_error('phone'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Phone NO</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'number','name'=>'phone', 'value'=>$phone, 'id'=>'phone', 'maxlength'=>'10', 'minlength'=>'10', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
             <div class="col-md-3 ">
                <strong class="right_sre">EMAIL</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'email', 'value'=>$emil, 'id'=>'phone', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3">
               <strong class="right_sre">State </strong>
            </div>
             <div class="col-md-9">
                <div class="form-group">
                   <?php echo form_error('state1'); ?>                       
                    <?php $data = $this->api_model->get_state("99"); //echo "<pre>";print_r($data); ?>
                    <select class="form-control state1" name="state1[]" multiple>
                        <option value="">Select State</option>
                            <?php foreach($data as $d){ ?>
                            <option value="<?= $d['zone_id'] ?>"><?= $d['name'] ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>        
            <div class="col-md-12"><?php //echo form_error('district'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">District</strong>
            </div>
             <div class="col-md-9">
                <div class="form-group">
                    <?php echo form_error('district1'); ?>
                    <select name="district1[]" class="form-control city1" multiple>
                    <option>Select District</option>
                    </select>
                </div>
            </div> 
           <!--  <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'district', 'value'=>$dob, 'id'=>'dob', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div> -->
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
        	 <!-- <div class="col-md-12"><?php echo form_error('role'); ?></div> -->
        	<!-- <div class="col-md-3">
        	   <strong class="right_sre">Role </strong>
            </div>
             <div class="col-md-9">
                <select name="role" class="ch_manset padd_set">
                	<option value="0">Select Role</option> -->
                   <!--  <?php
                    if($roles){
						foreach($roles as $role){
							$onclick='';

							if($role['id']!=CUSTOMER){
								echo '<option value="'.$role['id'].'" onclick="show_hospital(this.value)">'.$role['role_name'].'</option>';	
							}
						}
					}
					?> -->
               <!--  </select>
            </div> -->
            <div style="clear: left;"></div>
            <div style="margin-left: 27%;" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Submit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'margin-top:27px;']),
                         form_input(['type'=>'button', "onclick"=>"window.location.href='dis_list'", 'value'=>'Cancel','class'=>'btn btn-default', 'style'=>'margin-top:27px; margin-left: 10px;']);
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
 $('#type').change(function(){
    if($(this).find("option:selected").text() == 'Dirstrict Manager'){
        $('#dist_man').hide();
    }else{
        $('#dist_man').show();
    }
 });
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
 <script>
$('.state').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?zone_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
                    var str =data.data;
                    var option = '<option value="" multiple>Select District</option>';
                                        $.each(str, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
                                        }); 
                                        $('.city').html(option);
                                        
                }
                });
})
$('.state1').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?zone_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
                    var str =data.data;
                    var option = '<option value="" multiple>Select District</option>';
                                        $.each(str, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
                                        }); 
                                        $('.city1').html(option);
                                        
                }
                });
})
$('#submit').click(function(e){
  if($('#bull_photo').val() == ''){
    e.preventDefault();
    alert("Please Upload Photo");
  }
});
$(document).ready(function() {
                $('#bull_image').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_image')[0].files[0].name);
                    var file_data = $('#bull_image').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#bull_photo').val(data.data);
                            $('.ref').hide();
                        }
                    });
                });
});
</script>
 <?php include_once('layouts/admin_footer.php'); ?>
