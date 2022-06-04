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

<div class="abc" ><h3>EDIT EMPLOYEE</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/employee_edit/", ['onsubmit'=>'return myFunction()']);?>
            
             <?php echo form_error('dist_name'); ?>  
			 <input type="hidden" value="<?= $data[0]['doc_id'] ?>" name="id">
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select District Name</strong>
            </div>
            <div class="col-md-9">
			<?php //print_r($data); ?>
                <select name="dist_name" id="dist" class='ch_manset padd_set'>
                    <option value="">Select District</option>
                    <?php $data1 = $this->api_model->get_district(); ?>
                    <?php foreach($data1 as $d){ ?>
                        <option value="<?= $d['dis_id'] ?>" <?php if($data[0]['dist_id'] == $d['dis_id']){ echo "selected"; } ?>><?= $d['dist_name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('tehshil'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Tehshil Name</strong>
            </div>
            <div class="col-md-9">
			<?php $tehshil = $this->api_model->get_tehshil_total(); ?>
                <select name="tehshil" id="tehshil" class='ch_manset padd_set'>
                    <option value="">Select Tehshil</option>
					<?php foreach($tehshil as $teh){ ?>
						<option value="<?= $teh['tehsil_code'] ?>" <?php if($data[0]['tehshil_id'] == $teh['tehsil_code']){ echo "selected"; } ?>><?= $teh['tehshil_name'] ?></option>
					<?php } ?>
                </select>
        	</div>
            <?php echo form_error('gvh'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select GVH Name</strong>
            </div>
            <div class="col-md-9">
			<?php $gvh = $this->api_model->get_all_gvh(); ?>
                <select name="gvh" id="gvh" class='ch_manset padd_set'>
                    <option value="">Select GVH</option>
					<?php foreach($gvh as $g){ ?>
						<option value="<?= $g['gvh_id']?>" <?php if($data[0]['gvh_id']== $g['gvh_id']){ echo "selected"; } ?>><?= $g['gvh_name'] ?></option>
					<?php } ?>
                </select>
        	</div>
            <?php echo form_error('gvd'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select GVD Name</strong>
            </div>
            <div class="col-md-9">
				<?php $gvd = $this->api_model->get_all_gvd(); ?>
                <select name="gvd" id="gvd" class='ch_manset padd_set'>
                    <option value="">Select GVD</option>
					<?php foreach($gvd as $gv){ ?>
						<option value="<?= $gv['gvd_id']?>" <?php if($data[0]['gvd_id'] == $gv['gvd_id']){ echo "selected"; } ?>><?= $gv['gvd_name'] ?></option>
					<?php } ?>
                </select>
        	</div>
            <?php echo form_error('village'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Villgae</strong>
            </div>
            <div class="col-md-9">
			<?php $vill_array = explode(',',$data[0]['village_id']); 
			$vill = $this->api_model->get_all_village(); ?>
                <select name="village[]" id="village" class='ch_manset padd_set select2' size="30" style="height: 100%;" multiple>
                    <option value="">Select Village</option>
					<?php foreach($vill as $vi){ ?>
						<option value="<?= $vi['vill_id'] ?>"<?php  foreach($vill_array as $va){ if($va == $vi['vill_id']){ echo "selected";}} ?>><?= $vi['vill_name'] ?></option>
					<?php } ?>
                </select>
        	</div>
            <?php echo form_error('user_type'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Type</strong>
            </div>
            <div class="col-md-9">
                <select name="user_type" id="user_type" class='ch_manset padd_set' require>
                    <option value="">Select Type</option>
                    <option value="0" <?php if($data[0]['type'] == 0){ echo "selected"; } ?>>VLDA</option>
                    <option value="1" <?php if($data[0]['type'] == 1){ echo "selected"; } ?>>VS</option>
                    <option value="3" <?php if($data[0]['type'] == 3){ echo "selected"; } ?>>DD</option>
                </select>
        	</div>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Employee Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>''.$data[0]["doc_name"].'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('phone'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Employee Mobile</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'phone', 'value'=>''.$data[0]["doc_mobile"].'', 'id'=>'phone','class'=>'ch_manset padd_set']) ?>
        	</div>
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Edit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
<script type="text/javascript">
 $('#dist').change(function(){
     var id = $('#dist').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_tehshil?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select Tehshil</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.tehsil_code+"'>"+item.tehshil_name+"</option>"
			                            }); 
                                        $('#tehshil').html(data);
            }
        });
        $.ajax({
            url: "<?= base_url()?>admin/get_village?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select Village</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.vill_id+"'>"+item.vill_name+"</option>"
			                            }); 
                                        $('#village').html(data);
            }
        });
    });
    $('#tehshil').change(function(){
     var id = $('#tehshil').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_gvh?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select GVH</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.gvh_id+"'>"+item.gvh_name+"</option>"
			                            }); 
                                        $('#gvh').html(data);
            }
        });
        // $.ajax({
        //     url: "<?= base_url()?>admin/get_village?id="+id,
        //     cache: false,
        //     success: function(html){
        //         var result = JSON.parse(html);
        //                                 var data = "<option value=''>Select Village</option>";
		// 	                            $.each(result, function(index, item){
		// 									data +="<option value='"+item.vill_id+"'>"+item.vill_name+"</option>"
		// 	                            }); 
        //                                 $('#village').html(data);
        //     }
        // });
    });
    $('#gvh').change(function(){
     var id = $('#gvh').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_gvd?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select GVD</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.gvd_id+"'>"+item.gvd_name+"</option>"
			                            }); 
                                        $('#gvd').html(data);
            }
        });
    });
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>
