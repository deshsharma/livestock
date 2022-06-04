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
      <?php if( $error = $this->session->flashdata('dary_farm')){ ?>
                            <div class="col-lg-10 corm_nmset">
                              <div class="callout callout-danger">
                                <?= $error ?>
                              </div>
                            </div>
    <?php } ?>
        <?php echo form_open_multipart("admin/add_dary_farms/", ['onsubmit'=>'return myFunction()']);?>
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
            <div class="col-md-12"><?php echo form_error('farm_name'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Farm Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'farm_name', 'id'=>'farm_name','class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('owner_name'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Owner Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'owner_name', 'id'=>'owner_name','class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('address'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Address </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'address', 'id'=>'address','class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('location'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Location</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'location', 'id'=>'location','class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('latitude'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Latitude</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'latitude', 'id'=>'latitude','class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('langitude'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Langitude</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'langitude', 'id'=>'langitude', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('product'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Product</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_textarea(['type'=>'text','name'=>'product', 'rows'=>'2', 'cols'=>'50', 'id'=>'product', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('rating'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Rating</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'rating', 'id'=>'rating','class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12 input_fields_container">
            <div class="col-md-12"><?php echo form_error('animal_type'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Animal Type</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'name'=>'animal_type[]', 'id'=>'animal_type[]','class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('animale_breed'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Animal Breed</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'name'=>'animal_breed[]', 'id'=>'animal_breed[]','class'=>'ch_manset padd_set']) ?>
            </div>
            <div class="col-md-12"><?php echo form_error('animale_no'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Number of Animal</strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text', 'name'=>'animale_no[]', 'id'=>'animale_no[]','class'=>'ch_manset padd_set']) ?>
            </div>
            
            </div>
            <div class="col-md-12"><button id="add">Add More</button></div>
            <div class="col-md-12"><?php echo form_error('logo'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Logo</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'file','name'=>'Logo', 'id'=>'Logo','class'=>'ch_manset padd_set']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('email'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Banner </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'file','name'=>'Banner[]', 'id'=>'Banner', 'multiple'=>"multiple",'class'=>'ch_manset padd_set']); ?>
        	</div>
            <div style="clear: left;"></div>
            <div style="margin-left: 27%;">
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
//   $('.add').click(function(){
//     alert("The paragraph was clicked.");
//   });
    $(document).ready(function() {
    $('#add').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
            $('.input_fields_container').append('<div><div class="col-md-3">\
        	   <strong class="right_sre">Animal Type</strong></div><div class="col-md-9">\
                <input type="text" name="animal_type[]" value="" id="animal_type[]" class="ch_manset padd_set">\
            </div><div class="col-md-3"><strong class="right_sre">Animal Breed</strong></div><div class="col-md-9">\
                <input type="text" name="animal_breed[]" value="" id="animal_breed[]" class="ch_manset padd_set">\
            </div><div class="col-md-3"><strong class="right_sre">No of Animal</strong></div><div class="col-md-9">\
                <input type="text" name="animale_no[]" value="" id="animale_no[]" class="ch_manset padd_set">\
            </div>\
            </div><div class="col-md-12"><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div></div>'); //add input field
    });  
    $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); $(this).parent().parent('div').remove(); x--;
    })
});
</script>