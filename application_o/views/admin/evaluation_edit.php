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

<div class="abc" ><h3>EDIT EVALUATION</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("evaluation/edit/".$data[0]['id'], ['onsubmit'=>'return myFunction()']);?>
        <?php echo form_error('state_name'); ?>  
			 <input type="hidden" value="<?= $data[0]['id'] ?>" name="id">
			 <input type="hidden" value="<?= $data[0]['animal_id'] ?>" name="animal_id">
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select State Name</strong>
            </div>
            <div class="col-md-9">
			<?php //$data1 = $this->api_model->get_state(99); 
            //print_r($data1); ?>
                <select name="state_name" id="state" class='ch_manset padd_set'>
                    <option value="">Select State</option>
                    <?php $data1 = $this->api_model->get_state(99); ?>
                    <?php foreach($data1 as $d){ ?>
                        <option value="<?= $d['zone_id'] ?>" <?php if($data[0]['state_id'] == $d['zone_id']){ echo "selected"; } ?>><?= $d['name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
             <?php echo form_error('dist_name'); ?>  
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
            <?php echo form_error('name'); ?>
            <div class="col-md-3"  style="padding:10px;" > 
        	   <strong class="right_sre">Employee Name</strong>
            </div>
            <div class="col-md-9" style="padding:10px;">
                <?php //print_r($data); 
                $admin = $this->api_model->get_data('admin_id = '.$data[0]['admin_id'].'','admin');
                echo $admin[0]['fname'].'('. $admin[0]['mobile'].')';
                ?>
                <?php //echo form_input(['type'=>'text','name'=>'name', 'value'=>''.$data[0]["doc_name"].'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('phone'); ?>
            <div class="col-md-3"  style="padding:10px;" > 
        	   <strong class="right_sre">Animal ID</strong>
            </div>
            <div class="col-md-9"  style="padding:10px;">
                <?php echo '#'.$data[0]['animal_id']; ?>
                <?php //echo form_input(['type'=>'text','name'=>'phone', 'value'=>''.$data[0]["doc_mobile"].'', 'id'=>'phone','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('phone'); ?>
            <div class="col-md-3"  style="padding:10px;" > 
        	   <strong class="right_sre">Purchase Price</strong>
            </div>
            <div class="col-md-9"  style="padding:10px;">
                <?php echo $data[0]['evaluation_price']; ?>
                <?php //echo form_input(['type'=>'text','name'=>'phone', 'value'=>''.$data[0]["doc_mobile"].'', 'id'=>'phone','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('phone'); ?>
			
            <div class="col-md-3"  style="padding:10px;" > 
        	   <strong class="right_sre">Posted By Livestoc</strong>
            </div>
			
            <div class="col-md-9" id="livestoc_sell"  style="padding:10px;">
            <?php
            if($data[0]['livestoc_sell'] == '1'){
                $status = 'Yes';
                $class = 'btn btn-success';
                $stu = '0';
            }else{
                $status = 'No';
                $class = 'btn btn-danger';
                $stu = '1';
            }
            ?>
                <span class="<?= $class ?>" onclick="animal_bidding(<?= $data[0]['id'] ?>, <?= $stu ?>, 'livestoc_sell')"><?= $status ?></span>
                <?php //echo $data[0]['evaluation_price']; ?>
                <?php //echo form_input(['type'=>'text','name'=>'phone', 'value'=>''.$data[0]["doc_mobile"].'', 'id'=>'phone','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('livestoc_price'); ?>
            <div class="col-md-3"  style="padding:10px;" > 
        	   <strong class="right_sre">Sell Price</strong>
            </div>
            <div class="col-md-9"  style="padding:10px;">
                <?php// echo $data[0]['livestoc_price']; ?>
                <?php echo form_input(['type'=>'text','name'=>'livestoc_price', 'value'=>''.$data[0]["livestoc_price"].'', 'id'=>'livestoc_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('phone'); ?>
            <div class="col-md-3"  style="padding:10px;" > 
        	   <strong class="right_sre">Bidding Section</strong>
            </div>
            <div class="col-md-9" id="animal_bidding"  style="padding:10px;">
            <?php
            if($data[0]['animal_bidding'] == '1'){
                $status = 'Yes';
                $class = 'btn btn-success';
                $stu = '0';
            }else{
                $status = 'No';
                $class = 'btn btn-danger';
                $stu = '1';
            }
            ?>
                <span class="<?= $class ?>" onclick="animal_bidding(<?= $data[0]['id'] ?>, <?= $stu ?>, 'animal_bidding')"><?= $status ?></span>
                <?php //echo $data[0]['evaluation_price']; ?>
                <?php //echo form_input(['type'=>'text','name'=>'phone', 'value'=>''.$data[0]["doc_mobile"].'', 'id'=>'phone','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('bidding_price'); ?>
            <div class="col-md-3"  style="padding:10px;" > 
        	   <strong class="right_sre">Bidding Price</strong>
            </div>
            <div class="col-md-9"  style="padding:10px;">
                <?php //echo $data[0]['bidding_price']; ?>
                <?php echo form_input(['type'=>'text','name'=>'bidding_price', 'value'=>''.$data[0]["bidding_price"].'', 'id'=>'bidding_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('bidding_time'); ?>
            <div class="col-md-3"  style="padding:10px;" > 
        	   <strong class="right_sre">Bidding Time Limit</strong>
            </div>
            <div class="col-md-9"  style="padding:10px;">
                <?php //echo $data[0]['bidding_price']; ?>
                <?php echo form_input(['type'=>'number','name'=>'bidding_time', 'value'=>''.$data[0]["bidding_time"].'', 'id'=>'bidding_time','class'=>'ch_manset padd_set']) ?>
        	</div>
			
			<?php echo form_error('animal_rating'); ?>  
		    <div class="col-md-3" > 
        	   <strong class="right_sre">Select Animal Rating</strong>
            </div>
            <div class="col-md-9">
			    <select name="animal_rating" class='ch_manset padd_set'>
                    <option value="">Select Raiting</option>
					<?php for($ac=1; $ac<5; $ac++ ){ ?>
                        <option value="<?php echo $ac;?>" <?php if($data[0]['animal_rating'] == $ac){ echo "selected"; } ?>><?php echo $ac;?></option>
					<?php } ?>	
                </select>
        	</div>
			<?php echo form_error('animal_style'); ?>  
		    <div class="col-md-3" > 
        	   <strong class="right_sre">Select Animal style</strong>
            </div>
            <div class="col-md-9">
			    <select name="animal_style" class='ch_manset padd_set'>
                    <option value="">Select style</option>
					<?php //for($ac=1; $ac<4; $ac++ ){ ?>
                        <option value="1" <?php if($data[0]['animal_style'] == '1'){ echo "selected"; } ?>> Elite Animal </option>
						<option value="2" <?php if($data[0]['animal_style'] == '2'){ echo "selected"; } ?>> Champion Animal </option>
						<option value="3" <?php if($data[0]['animal_style'] == '3'){ echo "selected"; } ?>> Going Cheap </option>
						<option value="4" <?php if($data[0]['animal_style'] == '4'){ echo "selected"; } ?>> Value For Money </option>
					<?php //} ?>	
                </select>
        	</div>
			
			
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Edit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
                <a class="btn btn-success" href="<?= base_url('/evaluation') ?>" style="width:80px; margin-top: 16px;">Back</a>
            </div>
			 
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
<script type="text/javascript">
 $('#state').change(function(){
     var id = $('#state').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_district?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select District</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			                            }); 
                                        $('#dist').html(data);
            }
        });
    });
 function animal_bidding(id, status, type){
	    $.ajax({    
            url: "<?= base_url()?>evaluation/change_status?id="+id+"&status="+status+"&type="+type,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                    //alert(html['livestoc_sell']);
                                        // if($data[0]['animal_bidding'] == '1'){
                                        //     $status = 'Yes';
                                        //     $class = 'btn btn-success';
                                        //     $stu = '0';
                                        // }else{
                                        //     $status = 'No';
                                        //     $class = 'btn btn-danger';
                                        //     $stu = '1';
                                        // }
                                        var data = "";
			                            $.each(result, function(index, item){
                                            var status = '';
                                            var classs = '';
                                            var stu = '';
                                            if(item.animal_bidding == '1'){
                                                status = 'Yes';
                                                classs = 'btn btn-success';
                                                stu = '0';
                                            }else{
                                                status = 'No';
                                                classs = 'btn btn-danger';
                                                stu = '1';
                                            }
                                            if(type == 'animal_bidding'){
                                                data +="<span class='"+classs+"' onclick='animal_bidding("+item.id+", "+stu+", 'animal_bidding')'>"+status+"</span>";
                                            }else{
                                                data +="<span class='"+classs+"' onclick='animal_bidding("+item.id+", "+stu+", 'livestoc_sell')'>"+status+"</span>";
                                            }
										 	
			                            }); 
                                        $('#'+type+'').html('');
                                        $('#'+type+'').html(data);
										location.href=location.href; 
            }
        });
 }
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>
