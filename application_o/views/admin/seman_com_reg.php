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
<div class="abc" ><h3>Add Company</h3></div>
<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('sem_com_profile')){ ?>
                            <div class="col-lg-10 corm_nmset">
                              <div class="callout callout-danger">
                                <?= $error ?>
                              </div>
                            </div>
    <?php } ?>
        <?php echo form_open_multipart("admin/add_seman_comp/", ['onsubmit'=>'return myFunction()']);?>
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
            <div class="col-md-12"><?php echo form_error('bull_id'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Bull Id</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'bull_id', 'id'=>'bull_id','value'=>$bull_id,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('name'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Bull Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'id'=>'name','value'=>$name,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('company_name'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Company Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'company_name', 'id'=>'company_name','value'=>$company_name,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('phone'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Phone</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'phone', 'id'=>'phone','value'=>$phone,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('breed'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Breed</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'breed', 'id'=>'breed','value'=>$breed,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('dob'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Date of Birth</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'dob', 'id'=>'datepicker', 'autocomplete'=>'off', 'value'=>$dob,'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('dam_yield'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Dam Yield</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'dam_yield', 'value'=>$dam_yield, 'id'=>'dam_yield', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('doughter_yield'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Doughter Yield</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'doughter_yield', 'value'=>$doughter_yield, 'id'=>'doughter_yield', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
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
            <div class="col-md-12"><?php echo form_error('rating'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Rating</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'rating', 'id'=>'rating','value'=>$rating,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('contact_person'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Contact person</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'contact_person', 'id'=>'contact_person','value'=>$contact_person,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('milk_yield'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Milk yield</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'milk_yield', 'id'=>'milk_yield','value'=>$milk_yield,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('avvg_milk_fat'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Avvg Milk Fat</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'avvg_milk_fat', 'id'=>'avvg_milk_fat','value'=>$avvg_milk_fat,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('total_milk_fat'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Total Milk Fat</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'total_milk_fat', 'id'=>'total_milk_fat','value'=>$total_milk_fat,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('avg_milk_protein'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Avg Milk protein</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'avg_milk_protein', 'id'=>'avg_milk_protein','value'=>$avg_milk_protein,'class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('total_milk_protein'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Total Milk Protein</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'rows'=>'2', 'cols'=>'50','name'=>'total_milk_protein', 'id'=>'total_milk_protein','value'=>$total_milk_protein,'class'=>'ch_manset padd_set']) ?>
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