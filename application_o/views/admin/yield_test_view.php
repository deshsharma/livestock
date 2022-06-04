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
<?php 
$data = $this->api_model->yield_test_search_address($user_id);
 //print_r($data);
 // print_r($user_id);
?>
<div class="content-wrapper" >

<div class="abc" ><h3>Yield Add</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('msg')){ ?>
                            <div class="col-lg-10 corm_nmset">
                              <div class="callout callout-danger">
                                <?= $error ?>
                              </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/yield_video_upload/", ['onsubmit'=>'return myFunction()']);?>  
            
            <div class="col-md-12"><?php echo form_error('name'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">First Name </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'id'=>'name','value'=>$data[0]['full_name'],'class'=>'ch_manset padd_set', 'disabled']); ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('fname'); ?></div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">District </strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'lname', 'id'=>'fname','value'=>$data[0]['district'],'class'=>'ch_manset padd_set']); ?>
        	</div>
             <div class="col-md-12"><?php echo form_error('phone'); ?></div>
            <div class="col-md-3 ">
                <strong class="right_sre">Phone NO</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'number','name'=>'phone', 'value'=>$data[0]['mobile'], 'id'=>'phone', 'maxlength'=>'10', 'minlength'=>'10', 'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3 ">
                <strong class="right_sre">Address</strong>
            </div>
            <div class="col-md-9" > 
                <?php echo form_input(['type'=>'text','name'=>'address', 'value'=>$data[0]['address'],  'style'=>'padding: 6px;', 'class'=>'ch_manset']); ?>
            </div>
            <div class="col-md-3">
               <strong class="right_sre">Select Employee Type </strong>
            </div>
             <div class="col-md-9">
                <div class="form-group">
                   <?php echo form_error('user_id'); ?>                       
                    <?php $data = $this->api_model->get_yield_status(); //echo "<pre>";print_r($data); echo "this is test"; ?>
                    <select class="form-control state1" name="user_id" required>
                        <option value="">Select Employee</option>
                            <?php foreach($data as $d){ ?>
                            <option value="<?= $d['doctor_id'] ?>"><?= $d['username'] ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>      
        	 <div style="clear: left;"></div>
        	 <div class="col-md-12"><?php echo form_error('yield'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Yield </strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'yield1', 'id'=>'yield1','value'=>$data[0]['yield1'],'class'=>'ch_manset padd_set']); ?>
            </div>
            <div class="col-md-12"><?php echo form_error('yield'); ?></div>
            <div class="col-md-3">
               <strong class="right_sre">Second Yield </strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'yield2', 'id'=>'yield2','value'=>$data[0]['yield2'],'class'=>'ch_manset padd_set']); ?>
            </div>
             <div class="col-md-12"><?php echo form_error('yield'); ?></div>
        	<div class="col-md-3">
        	   <strong class="right_sre">Animals Id </strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'animal_id', 'id'=>'animal_id','value'=>$data[0]['animal_id'],'class'=>'ch_manset padd_set']); ?>
            </div>
            <div class="col-md-3">
        	   <strong class="right_sre">First Date </strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'datetime-local','name'=>'first_date', 'id'=>'datetime-local','value'=>$data[0]['datetime-local'],'class'=>'ch_manset padd_set']); ?>
            </div>
             <div class="col-md-3">
               <strong class="right_sre">Second Date </strong>
            </div>
             <div class="col-md-9">
                <?php echo form_input(['type'=>'datetime-local','name'=>'second_date', 'id'=>'datetime-local','value'=>$data[0]['datetime-local'],'class'=>'ch_manset padd_set']); ?>
            </div>
            <div class="col-md-3">
        	   <strong class="right_sre">Yield Video </strong>
            </div>
             <div class="col-md-9">
                 <input  class="set_width vedio_name" name="video_name"id="video_name" readonly="readonly" type="file" />
                  
            </div>
            <div class="col-md-3">
               <strong class="right_sre">Second Yield Video </strong>
            </div>
             <div class="col-md-9">
                 <input  class="set_width vedio_name" name="video_name2"id="video_name2" readonly="readonly" type="file" />                  
            </div>
        	 <div style="clear: left;"></div>        	
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
<?php include_once('layouts/admin_footer.php'); ?>
<script type="text/javascript">
        $('#video_name<?= $i ?>').change(function(){
            $('#file_name').html('');
            $('#file_name').html($('#video_name')[0].files[0].name);
            var file_data = $('#video_name').prop('files')[0]; 
            //alert (file_data);
            var form_data = new FormData();                  
            form_data.append('image', file_data);
             $('.ref').show();
            $.ajax({
                url: "<?= base_url() ?>Api/upload_vedio?path=animal_yield",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    data = JSON.parse(data);
                    $('#vedio_name_<?= $i ?>').val(data.video_name);
                    $('.ref').hide();
                }
            });
        });
         $('#video_name2<?= $i ?>').change(function(){
            $('#file_name').html('');
            $('#file_name').html($('#video_name2')[0].files[0].name);
            var file_data = $('#video_name2').prop('files')[0]; 
            //alert (file_data);
            var form_data = new FormData();                  
            form_data.append('image', file_data);
             $('.ref').show();
            $.ajax({
                url: "<?= base_url() ?>Api/upload_vedio?path=animal_yield",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    data = JSON.parse(data);
                    $('#vedio_name_<?= $i ?>').val(data.video_name2);
                    $('.ref').hide();
                }
            });
        });
         $('#video_image<?= $i ?>').change(function(){
            $('#file_name').html('');
            $('#file_name').html($('#video_image<?= $i ?>')[0].files[0].name);
            var file_data = $('#video_image<?= $i ?>').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('image', file_data);
             $('.ref').show();
            $.ajax({
                url: "<?= base_url() ?>Api/web_cropper_images?path=videos/images",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    data = JSON.parse(data);
                    $('#vedio_thumb_<?= $i ?>').val(data.data);
                    $('.ref').hide();
                }
            });
        });
    function validateForm() {
    var x = document.forms["myForm"]["animal_id"].value;
       if (x == "" || x == null) {
            alert("Animal Id must be filled out");
            return false;
        }
    }
 </script>
<script type="text/javascript">
    function employee(req_id, emp_id){
        ajaxloader.load("<?php echo base_url('admin/assign_test').'?id=' ?>"+req_id+"&emp_id="+emp_id, function(resp){
            location.reload(true);
        });
    }
    function change_status(req_id, status){
        ajaxloader.load("<?php echo base_url('admin/change_status_test').'?id=' ?>"+req_id+"&status="+status, function(resp){
            location.reload(true);
        });
    }
</script>