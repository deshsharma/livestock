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

<div class="abc" ><h3>ADD GVH</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/gvd_add/", ['onsubmit'=>'return myFunction()']);?>
            
             <?php echo form_error('dist_name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select District Name</strong>
            </div>
            <div class="col-md-9">
                <select name="dist_name" id="dist" class='ch_manset padd_set'>
                    <option value="">Select District</option>
                    <?php $data = $this->api_model->get_district(); ?>
                    <?php foreach($data as $d){ ?>
                        <option value="<?= $d['dis_id'] ?>"><?= $d['dist_name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('tehshil'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Tehshil Name</strong>
            </div>
            <div class="col-md-9">
                <select name="tehshil" id="tehshil" class='ch_manset padd_set'>
                    <option value="">Select Tehshil</option>
                </select>
        	</div>
            <?php echo form_error('tehshil'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select GVH Name</strong>
            </div>
            <div class="col-md-9">
                <select name="gvh" id="gvh" class='ch_manset padd_set'>
                    <option value="">Select GVH</option>
                </select>
        	</div>
            
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">GVD Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
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
    });
    $('#tehshil').change(function(){
     var id = $('#tehshil').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_gvh?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select Tehshil</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.gvh_id+"'>"+item.gvh_name+"</option>"
			                            }); 
                                        $('#gvh').html(data);
            }
        });
    });
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>
