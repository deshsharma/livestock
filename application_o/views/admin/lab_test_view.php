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

<div class="abc" ><h3>Lab Test Detail</h3></div>

<div class="abc_1" >
            <?php //print_r($data); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Name : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['name'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['name'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Mobilr No : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['phone'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['phone'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">No of Sample : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['no_of_sample'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['no_of_sample'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Address : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['adress'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['adress'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">District: -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['district'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['district'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">State : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['state'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['state'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">City : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['city'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['city'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Pin : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['pin'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['pin'];} ?>
        	</div>
            <div class="col-md-3" > 
               <strong class="right_sre">Payment Methoed : -</strong>
            </div>
            <div class="col-md-9">
                <?php 
                                            if($data['request_status'] == '2'){
                                                echo 'COD';
                                            }else{
                                                echo  'Online';
                                            } ?>
            </div>
            <div class="col-md-3" > 
               <strong class="right_sre">Payment Status : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data['ispaid'] == '1'){
                                                echo 'Paid';
                                            }else{
                                                echo 'Non Paid';
                                            }
                                        ?>
            </div>
            <?php if($_SESSION['status'] != '27'){ ?>
            <div class="col-md-3" > 
               <strong class="right_sre">Select Employee : -</strong>
            </div>
            <div class="col-md-9">
                <?php 
                $data1 = $this->api_model->get_admin_status(27);
                //print_r($data);
                        $opt = "<select class='collector' onchange='employee(".$data[0]['req_id'].", this.value)'>"; 
                        $opt .="<option value='0'>Select Employee</option>";
                        foreach($data1 as $da){
                            $sel = '';
                            if($da['admin_id'] == $data[0]['emp_id']){
                                $sel = 'selected';
                            }
                            $opt .= "<option value='".$da['admin_id']."' ".$sel.">".$da['fname']."</option>";
                        }
                        $opt .="</select>";
                        
                        echo $opt;
                ?>
            </div>
            <?php } ?>
            <div class="col-md-3" > 
               <strong class="right_sre">Change Payment Status : -</strong>
            </div>
            <div class="col-md-9">
                <select onchange="change_status(<?= $data[0]['req_id'] ?>, this.value)">
                    <option value=''>Select Payment Status</option>
                    <option value='1' <?php if($data[0]['ispaid'] =='1'){ echo "selected";}?>>Paid</option>
                    <option value='0' <?php if($data[0]['ispaid'] =='0'){ echo "selected";}?>>Non Paid</option>
                </select>
            </div>
            <div class="col-md-3" > 
               <strong class="right_sre">Open Map : -</strong>
            </div>
            <div class="col-md-9">
                <?php //print_r($data); ?>
                <a href="https://maps.google.com/?q=<?= $data[0]['lat'] ?>,<?= $data[0]['lang']?>" target="__blank">Open Map</a>
            </div>
            <!-- <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    //echo form_submit(['name'=>'submit','value'=>'Add', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div> -->
            <div style="clear: left;"></div>
        </div>
</div>
<?php include_once('layouts/admin_footer.php'); ?>
<script type="text/javascript">
    function employee(req_id, emp_id){
        ajaxloader.load("<?php echo base_url('admin/assign_test').'?id=' ?>"+req_id+"&emp_id="+emp_id, function(resp){
            location.reload(true);
        })
    }
    function change_status(req_id, status){
        ajaxloader.load("<?php echo base_url('admin/change_status_test').'?id=' ?>"+req_id+"&status="+status, function(resp){
            location.reload(true);
        })
    }
</script>