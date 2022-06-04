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

<div class="abc" ><h3>UPDATE BULL</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('edit_bull')){ ?>
                            <div class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open_multipart("admin/edit_bull/", ['onsubmit'=>'return myFunction()']);?>
            <input type="hidden" name="id" value="<?= $bull_data[0]['id'] ?>">
             <?php echo form_error('bull_no'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Bull NO</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'bull_no', 'value'=>$bull_data[0]['bull_no'], 'id'=>'bull_no','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('bull_id'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Bull Id</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'bull_id', 'value'=>$bull_data[0]['bull_id'], 'id'=>'bull_id','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('dob'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Date of Birth</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'dob', 'value'=>$bull_data[0]['dob'], 'id'=>'datepicker','class'=>'ch_manset padd_set', 'autocomplete'=>'off']) ?>
        	</div>
            <?php echo form_error('sire_no'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Sire No</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'sire_no', 'value'=>$bull_data[0]['sire_no'], 'id'=>'sire_no','class'=>'ch_manset padd_set', 'autocomplete'=>'off']) ?>
        	</div>
            <?php echo form_error('dam_no'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Dam No</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'dam_no', 'value'=>$bull_data[0]['dam_no'], 'id'=>'dam_no','class'=>'ch_manset padd_set', 'autocomplete'=>'off']) ?>
        	</div>
            <?php echo form_error('lat_yield'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Dam's Lactation Yield</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'lat_yield', 'value'=>$bull_data[0]['lat_yield'], 'id'=>'lat_yield','class'=>'ch_manset padd_set', 'autocomplete'=>'off']) ?>
        	</div>
            <?php echo form_error('lact_no'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Lact. No.</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'lact_no', 'value'=>$bull_data[0]['lact_no'], 'id'=>'lact_no','class'=>'ch_manset padd_set', 'autocomplete'=>'off']) ?>
        	</div>
            <?php echo form_error('bull_source'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Bull Source</strong>
               <?php //print_r($bull_data); ?>
            </div>
            <div class="col-md-9">
                <select name="bull_source" id="" class='ch_manset padd_set'>
                <option >Select Bull Source</option>
                    <?php foreach($data as $da){ ?>
                        <option value="<?= $da['admin_id'] ?>" <?php if($da['admin_id'] == $bull_data[0]['source']){ echo "selected";} ?>><?= $da['bank_name'] ?></option>
                    <?php }?>
                </select>
        	</div>
            <?php echo form_error('category'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Category</strong>
            </div>
            <div class="col-md-9">
                        <?php $cat_data = $this->api_model->get_category_all();
                        //print_r($bull_data);
                        ?>
                <select name="category" id="" class='ch_manset padd_set category'>
                    <option>Select Category</option>
                    <?php foreach($cat_data as $cat){
                        ?>
                            <option value="<?= $cat['category_id'] ?>" <?php if($cat['category_id'] == $bull_data[0]['category']){ echo "selected";} ?>><?= $cat['category'] ?></option>
                        <?php 
                    }  ?>
                    
                </select>
        	</div>
            <?php echo form_error('bread'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Breed</strong>
            </div>
            <div class="col-md-9">
                    <?php $breed = $this->api_model->get_breed_all(); 
                    ?>
                <select name="bread" class='ch_manset padd_set breed'>
                    <option>Select Breed</option>
                    <?php foreach($breed as $br) { ?>
                        <option value="<?= $br['breed_id'] ?>" <?php if($br['breed_id'] == $bull_data[0]['bread']){ echo "selected";} ?>><?= $br['breed_name'] ?></option>
                    <?php } ?>
                    
                </select>
        	</div>
            <?php echo form_error('image'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Add Image</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'file','name'=>'image', 'id'=>'iamge','value'=>$image,'class'=>'ch_manset padd_set']); ?>
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
 $(".category").change(function() {
     var id = this.value;
 	ajaxloader.load("<?php echo base_url('admin/get_breed');?>?id="+id+"", function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str['error']=='1'){ 
			                     		tr += "<option>No record found!</option>";
			                       	}
			                      	else{
			                      		var result = str;
                                          tr += "<option value=''>Select Category</option>"
			                            $.each(result, function(index, item){
                                            tr += "<option value="+item.breed_id+">"+item.breed_name+"</tr>";
                                        });
                                        $('.breed').html(tr);
                                      }
     });
 });
//  $(document).ready(function() {
//  	ajaxloader.load("<?php echo base_url('admin/get_category'); ?>", function(resp){
// 			                      	var data = resp;
// 			                      	var str =JSON.parse(data);
// 			                      	var tr = '';
// 			                     	if(str['error']=='1'){ 
// 			                     		tr += "<option>No record found!</option>";
// 			                       	}
// 			                      	else{
// 			                      		var result = str;
//                                           tr += "<option value=''>Select Category</option>" 
//                                            var compair =  parseInt(<?php echo $bull_data[0]['category']; ?>);
//                                            var sel = '';
// 			                            $.each(result, function(index, item){
//                                             if(compair == item.category_id){ 
//                                                 sel = " selected"; 
//                                             }
//                                             tr += "<option value="+item.category_id+" "+sel+" >"+item.category+"</option>";
//                                         });

//                                         $('.category').html(tr);
//                                       }
//      });
    //  ajaxloader.load("<?php echo base_url('admin/get_bank'); ?>", function(resp){
	// 		                      	var data = resp;
	// 		                      	var str =JSON.parse(data);
	// 		                      	var tr = '';
	// 		                     	if(str['error']=='1'){ 
	// 		                     		tr += "<option>No record found!</option>";
	// 		                       	}
	// 		                      	else{
	// 		                      		var result = str;
    //                                       tr += "<option value=''>Select Category</option>" 
	// 		                            $.each(result, function(index, item){
    //                                         tr += "<option value="+item.category_id+">"+item.category+"</option>";
    //                                     });

    //                                     $('.category').html(tr);
    //                                   }
    //  });
 });
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>
