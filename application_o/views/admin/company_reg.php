<?php 
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

<div class="abc" ><h3>Company Name</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('com_profile')){ ?>
                            <div class="col-lg-10 corm_nmset">
                              <div class="callout callout-danger">
                                <?= $error ?>
                              </div>
                            </div>
    <?php } ?>
        <?php echo form_open_multipart("admin/add_comp/", ['onsubmit'=>'return myFunction()']);?>
            <div class="col-md-12"><?php echo form_error('type'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Type </strong>
            </div>
            <div class="col-md-9">
                <select name="type" class="ch_manset padd_set">
                	<option value="">Select Type</option>
                    <option value="1">Premium</option>
                    <option value="2">Non Premium</option>
                </select>
            </div>
            <div class="col-md-12"><?php echo form_error('name'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Company Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'id'=>'name','value'=>$name,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('brand'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Company Brand Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'brand', 'id'=>'brand','value'=>$brand,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('rating'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Company Rating</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'rating', 'id'=>'rating','value'=>$rating,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('con_per'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Contact Person</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'con_per', 'id'=>'con_per','value'=>$con_per,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('phone'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Phone NO</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'phone', 'value'=>$phone, 'id'=>'phone', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('loc'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">City Name</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'loc', 'value'=>$loc, 'id'=>'loc', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('latitute'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Latitute</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'latitute', 'value'=>$latitute, 'id'=>'latitute', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('langitute'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Langitute</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'langitute', 'value'=>$langitute, 'id'=>'langitute', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('product'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Product with comma seprated </strong>
            </div>
             <div class="col-md-9">
                <?php echo form_textarea(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'product', 'id'=>'product','value'=>$product,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('email'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Email </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'email', 'id'=>'email','value'=>$email,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('url'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Company Link</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'url', 'id'=>'url','value'=>$url,'class'=>'ch_manset padd_set']); ?>
        	</div>
        	 <div style="clear: left;"></div>
        	 <div class="col-md-12"><?php echo form_error('address'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Address </strong>
            </div>
             <div class="col-md-9">
                <?php echo form_textarea(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'address', 'id'=>'address','value'=>$address,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('description'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Description</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_textarea(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'description', 'id'=>'description','value'=>$description,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('logo'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Logo </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'file','name'=>'Logo', 'id'=>'Logo','value'=>$Logo,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('email'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Banner </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'file','name'=>'Banner', 'id'=>'Banner','value'=>$Banner,'class'=>'ch_manset padd_set']); ?>
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
