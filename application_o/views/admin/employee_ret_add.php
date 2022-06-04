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
        <?php echo form_open("employee/add/", ['onsubmit'=>'return myFunction()']);?>
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
                    <option value="37">Vertical Head</option>
                    <option value="39">District Manager</option>
                    <option value="38">Executive</option>
                    <option value="44">Animal Evaluator</option>
                </select>
            </div>
            <div id="dist_man">
            <div class="col-md-3" > 
               <strong class="right_sre">Select Vertical manager </strong>
            </div>
            <div class="col-md-9">
               <?php $data = $this->api_model->get_data('type = "37"','admin');// print_r($data); ?>
                    <select class="form-control " name="r_code" required>
                        <option value=" ">Select District Manager</option>

                            <?php foreach($data as $d){ ?>
                            <option value="<?= $d['admin_id'] ?>"><?= $d['fname'] ?></option>
                            <?php } ?>
                    </select>
            </div>
            </div>
             <div id="dist_man_list">
            <div class="col-md-3" > 
               <strong class="right_sre">Select District Manager </strong>
            </div>
            <div class="col-md-9">
               <?php $data = $this->api_model->get_data('type = "39"','admin');// print_r($data); ?>
                    <select class="form-control " name="r_code" required>
                        <option value=" ">Select District Manager</option>

                            <?php foreach($data as $d){ ?>
                            <option value="<?= $d['admin_id'] ?>"><?= $d['fname'] ?></option>
                            <?php } ?>
                    </select>
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
             <!-- <div class="col-md-3 ">
                <strong class="right_sre">EMAIL</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'email','name'=>'email', 'value'=>$emil, 'id'=>'phone', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div> -->
            <div class="col-md-3 ">
                <strong class="right_sre">EMAIL</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'email','name'=>'email', 'value'=>$emil, 'id'=>'phone', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3 ">
                <strong class="right_sre">EMPLOYEE CODE</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'employee_code', 'value'=>$employee_code, 'id'=>'employee_code', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3 ">
                <strong class="right_sre">BLOOD GROUP</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'blood_group', 'value'=>$blood_group, 'id'=>'blood_group', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3 ">
                <strong class="right_sre">CROP ADDRESS</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'corp_address', 'value'=>$corp_address, 'id'=>'corp_address', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3 ">
                <strong class="right_sre">TYPE OF JOB</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'type_of_job', 'value'=>$type_of_job, 'id'=>'type_of_job', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
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
        	 <div style="clear: left;"></div>
        	 <div class="col-md-12"><?php echo form_error('address'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Address </strong>
            </div>
             <div class="col-md-9">
             <!-- <textarea rows='2' cols='50' name='address' id="address"><?= $data[0]['complete_addr'] ?></textarea> -->
                <?php echo form_textarea(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'address', 'id'=>'address','value'=>'','class'=>'ch_manset padd_set']) ?>
            </div>
        	 <div style="clear: left;"></div>
            <div style="clear: left;"></div>
            <div style="margin-left: 27%;" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Submit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'margin-top:27px;']);
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
    $('#type').on('change', function() {
      if ( this.value == '37')
      {
       $("#dist_man").hide();
        $('#dist_man_list').hide();
      }
      // else
      // {
      //   $("#dist_man").hide();
      // }
    });
});
  $('#type').change(function(){
    if($(this).find("option:selected").text() == 'District Manager'){
        $('#dist_man_list').hide();
         $('#dist_man').hide();
    }else{
        $('#dist_man_list').show();
    }
 });
    $('#type').change(function(){
    if($(this).find("option:selected").text() == 'Executive'){
        $('#dist_man').hide();
    }else{
        $('#dist_man').show();
    }
 });
  $('#type').change(function(){
    if($(this).find("option:selected").text() == 'Animal Evaluator'){
        // $('#dist_man_list').hide();
         $('#dist_man').hide();
    }else{
        $('#dist_man_list').show();
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
