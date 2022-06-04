<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php');
if($data[0]['user_type'] == 1){
    $user = $this->api_model->get_data('users_id = '.$data[0]['users_id'].'', 'users', '', '*');
    $address = $this->api_model->get_data('address_id = '.$user[0]['address_id'].'', 'address_mst', '', '*');
    $sta =$this->api_model->get_data('zone_id = '.$address[0]['zone_id'].'', 'zone', '', '*');
}
if($data[0]['user_type'] == 0){
    $user = $this->api_model->get_data('doctor_id = '.$data[0]['users_id'].'', 'doctor', '', '*');
}
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

<div class="abc" ><h3>Summary Detail</h3></div>

<div class="abc_1" >
            <?php
            //print_r($sta);
            //print_r($user); 
            //print_r($data); 
            ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Name : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($user[0]['full_name'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $user[0]['full_name'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Mobile No : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($user[0]['mobile'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $user[0]['mobile'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Address : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($address[0]['address1'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $address[0]['address1'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">District: -</strong>
            </div>
            <div class="col-md-9">
                <?php if($address[0]['district'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $address[0]['district'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">State : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($sta[0]['name'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $sta[0]['name'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">City : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($address[0]['city'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $address[0]['city'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Pin : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($address[0]['postal_code'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $address[0]['postal_code'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Amount : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['amount'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['amount'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Status : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['payment_type'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['payment_type'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Currency : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['currency'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['currency'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Date : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['date'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['date'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Method : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['method'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['method'];} ?>
        	</div>
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