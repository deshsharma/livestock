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

<div class="abc" ><h3>ADD BANK</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open_multipart("admin/seman_bank_add/", ['onsubmit'=>'return myFunction()']);?>
            
             <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Bank Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('login_name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Login Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'login_name', 'value'=>'', 'id'=>'login_name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('email'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Email</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'email', 'value'=>'', 'id'=>'email','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('pan_no'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">PAN NO</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'pan_no', 'value'=>'', 'id'=>'pan_no','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('pancard'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">PAN CARD Image</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'file','name'=>'pancard', 'id'=>'pancard','value'=>'','class'=>'ch_manset padd_set']); ?>
        	</div>
            <?php echo form_error('gst_no'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">GST NO</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'gst_no', 'value'=>'', 'id'=>'gst_no','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('password'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Password</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'password', 'value'=>'', 'id'=>'password','class'=>'ch_manset padd_set']) ?>
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
