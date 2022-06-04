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

<div class="abc" ><h3>Request Detail</h3></div>

<div class="abc_1" >
            <?php //print_r($data); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Contact Name : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['contact_person'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['contact_person'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Mobile No : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['contact_phone'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['contact_phone'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Address : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['address'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['address'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">District: -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['district_id'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ $dis = $this->api_model->get_data('dis_id = "'.$data[0]['district_id'].'"','district'); echo $dis[0]['dist_name']; } ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">State : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['state_id'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ $state = $this->api_model->get_data('zone_id = "'.$data[0]['state_id'].'"', 'zone'); echo $state[0]['name'];} ?>
        	</div>
            <!-- <div class="col-md-3" > 
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
            </div> -->
            <?php if($_SESSION['status'] != '27'){ ?>
            <div class="col-md-3" > 
               <strong class="right_sre">Select AI Worker : -</strong>
            </div>
            <div class="col-md-9">
                <?php 
                $data1 = $this->api_model->get_data('users_type IN ("pvt_vt", "pvt_ai")','doctor');
                $disabled = '';
                if($data[0]['doc_id'] != '0'){
                    $disabled = 'disabled';
                }
                        $opt = "<select class='collector form-control select2' onchange='vt(".$data[0]['id'].", this.value)' ".$disabled.">"; 
                        $opt .="<option value='0'>Select AI Worker</option>";
                        foreach($data1 as $da){
                            $sel = '';
                            if($da['doctor_id'] == $data[0]['vt_id']){
                                $sel = 'selected';
                            }
                            $opt .= "<option value='".$da['doctor_id']."' ".$sel.">".$da['username']."(".$da['mobile'].")"."</option>";
                        }
                        $opt .="</select>";
                        
                        echo $opt;
                ?>
            </div>
            <div class="col-md-3" > 
               <strong class="right_sre">Select Doctor : -</strong>
            </div>
            <div class="col-md-9">
                <?php 
                $data1 = $this->api_model->get_data('users_type IN ("pvt_doc")','doctor');
                $disabled = '';
                if($data[0]['doc_id'] != '0'){
                    $disabled = 'disabled';
                }
                        $opt = "<select class='collector form-control select2' onchange='doctor(".$data[0]['id'].", this.value)' ".$disabled.">"; 
                        $opt .="<option value='0'>Select Doctor</option>";
                        foreach($data1 as $da){
                            $sel = '';
                            if($da['doctor_id'] == $data[0]['doc_id']){
                                $sel = 'selected';
                            }
                            $opt .= "<option value='".$da['doctor_id']."' ".$sel.">".$da['username']."(".$da['mobile'].")"."</option>";
                        }
                        $opt .="</select>";
                        
                        echo $opt;
                ?>
            </div>
            <?php } ?>
            <?php $sub_req = $this->api_model->get_data('request_id = '.$data[0]['id'].'','vt_request_tracking'); 
            if($sub_req){
            ?>
            <?php foreach($sub_req as $su_r){ ?>
                <div class="col-md-3" > 
                    <strong class="right_sre">Sub Request: -</strong>
                </div>
                <div class="col-md-9">
                    <div class="col-md-3" > 
                    <strong class="right_sre">Treatment Type: -</strong>
                    </div>
                    <div class="col-md-9">
                        <?php 
                            if($su_r['treat_type'] == "0"){
                                echo "Treatment";
                            }else{
                                echo "Artificial Insemination";
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-3" >
                &nbsp;&nbsp;
                </div>
                <div class="col-md-9">
                    <div class="col-md-3" > 
                    <strong class="right_sre">Treatment Statement: -</strong>
                    </div>
                    <div class="col-md-9">
                        <?php if($su_r['animal_simtoms'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $su_r['animal_simtoms']; } ?>
                    </div>
                </div>
                <div class="col-md-3" >
                &nbsp;&nbsp;
                </div>
                <div class="col-md-9">
                    <div class="col-md-3" > 
                    <strong class="right_sre">Treatment Status: -</strong>
                    </div>
                    <div class="col-md-9">
                        <?php  if($su_r['treat_status'] == '1'){ 
                                    echo "Accepted"; 
                                }else if($su_r['treat_status'] == '0'){
                                    echo "Pending";
                                }else if($su_r['treat_status'] == '3'){
                                    echo "Canceled";
                                }else if($su_r['treat_status'] == '4'){
                                    echo "Closed";
                        } ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <a href="<?= base_url('repeat_breading/edit_sub').'/'.$su_r['id'] ?>"><button class="btn btn-danger">Edit</button></a> 
                        </div>
                    </div>
                </div>
            <?php } } ?>
            <div class="col-md-3" > 
               <strong class="right_sre">Open Map : -</strong>
            </div>
            <div class="col-md-9">
                <?php //print_r($data); ?>
                <a href="https://maps.google.com/?q=<?= $data[0]['latitude'] ?>,<?= $data[0]['langitude']?>" target="__blank">Open Map</a>
            </div>
            <!-- <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    //echo form_submit(['name'=>'submit','value'=>'Add', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div> -->
            <div style="clear: left;"></div>
        </div>
</div>
<!-- <script src="<?= base_url('assets/admin'); ?>/plugins/select2/select2.min.js"></script> -->
<?php include_once('layouts/admin_footer.php'); ?>  
<script type="text/javascript">
    function vt(req_id, emp_id){
        ajaxloader.load("<?php echo base_url('repeat_breading/assign').'?id=' ?>"+req_id+"&emp_id="+emp_id+"&type=vt", function(resp){
            location.reload(true);
        })
    }
    function doctor(req_id, emp_id){
        ajaxloader.load("<?php echo base_url('repeat_breading/assign').'?id=' ?>"+req_id+"&emp_id="+emp_id+"&type=doc", function(resp){
            location.reload(true);
        })
    }
    function change_status(req_id, status){
        ajaxloader.load("<?php echo base_url('admin/change_status_test').'?id=' ?>"+req_id+"&status="+status, function(resp){
            location.reload(true);
        })
    }
</script>