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

<div class="abc" ><h3>ADD SEMEN STOCK</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bull')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/seman_stock/", ['onsubmit'=>'return myFunction()']);?>
           
            <?php echo form_error('bull_source'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Bull Source</strong>
            </div>
            <div class="col-md-9">
                <select name="bull_source" id="source_name" class='ch_manset padd_set' <?php if($_SESSION['status'] != 1){ echo "disabled"; } ?>>
                <option >Select Bull Source</option>
                    <?php foreach($data as $da){ ?>
                        <option value="<?= $da['admin_id'] ?>" <?php if($_SESSION['user_id'] == $da['admin_id']){ echo "selected"; } ?>><?= $da['bank_name'] ?></option>
                    <?php }?>
                </select>
        	</div>
            <?php echo form_error('bull_id'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Bull Id</strong>
            </div>
            <div class="col-md-9">
                <select name="bull_id" id="bull" class='ch_manset padd_set' <?php //if($_SESSION['status'] != 1){ echo "disabled"; } ?>>
                    <?php if($_SESSION['status'] != 1){ 
                       $bull_data = $this->api_model->get_bull_by_source_id($_SESSION['user_id']);
                       foreach($bull_data as $bull){
                            ?>
                                <option value="<?= $bull['id'] ?>"><?= $bull['bull_no'] ?></option>
                            <?php
                       }
                    }else{
                        echo "<option>Select Bull</option>";
                    } ?>
                </select>
        	</div>
            <?php echo form_error('dob'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Batch NO</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'batch_no', 'value'=>'', 'id'=>'batch_no','class'=>'ch_manset padd_set', 'placeholder'=>'___/__-__-__(_)','autocomplete'=>'off']) ?>
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
 $("#source_name").change(function() {
     var id = this.value;
 	ajaxloader.load("<?php echo base_url('admin/get_bull');?>?bull_source="+id+"", function(resp){
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
                                            tr += "<option value="+item.id+">"+item.bull_no+"</tr>";
                                        });
                                        $('#bull').html(tr);
                                      }
     });
 });
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>
