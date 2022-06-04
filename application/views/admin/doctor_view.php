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

<div class="abc" ><h3>Dcotor Detail</h3></div>

<div class="abc_1" >
            <div class="col-md-3" > 
        	   <strong class="right_sre">Type : -</strong>
            </div>
            <div class="col-md-9">
                <?php
                if($data[0]['users_type'] == 'pvt_doc'){
                    echo 'Private Doctor';
                }
                if($data[0]['users_type'] == 'pvt_ai'){
                    echo 'Private AI';	
                }
                if($data[0]['users_type'] == 'pvt_vt'){
                    echo 'Private Veterinarian';
                }	 
                ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Name : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['username'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['username'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Full Name : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['fullname'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['fullname'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Registration NO : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['registration_no'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['registration_no'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Registration Year : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['registeration_year'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['registeration_year'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Registration Council : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['registeration_council'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['registeration_council'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Email : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['email'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['email'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Mobile 1st : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['mobile'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['mobile'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Mobile 2nd : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['mobile_2nd'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['mobile_2nd'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Aadhar No : -</strong>
            </div>
            <div class="col-md-9">
               
                <?php if($data[0]['aadhar_no'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['aadhar_no'];} ?>
                
            </div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Aadhar Image  : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['users_type'] == 'pvt_doc'){ ?>
                <?php if($data[0]['adhaar_img'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo "<img src=".base_url()."uploads/doctore_doc/".$data[0]['adhaar_img']." style='width: 25%;height: 162px;'>";} ?>
                <?php }else{ ?>
                    <?php if($data[0]['adhaar_img'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo "<img src=".base_url()."uploads/doc/".$data[0]['adhaar_img']." style='width: 25%;height: 162px;'>";} ?>
                <?php } ?>
            </div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Expertise IN : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['expertise_list'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['expertise_list'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">City : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['city'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['city'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">State : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['state'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['state'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Pincode : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['pincode'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['pincode'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Address : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['address_full'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['address_full'];} ?>
        	</div>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Qualification Detail : -</strong>
            </div>
            <div class="col-md-9">
                <?php foreach($data['doc'] as $doc){ ?>
                    <div class="col-md-3" > 
                        <strong class="right_sre">Qualification Name : -</strong>
                    </div>
                    <div class="col-md-9">
                        <?= $doc['qualification_name'] ?>
                    </div>
                    <div class="col-md-3" > 
                        <strong class="right_sre">Qualification Year : -</strong>
                    </div>
                    <div class="col-md-9">
                        <?= $doc['year'] ?>
                    </div>
                    <div class="col-md-3" > 
                        <strong class="right_sre">Institute Name : -</strong>
                    </div>
                    <div class="col-md-9">
                        <?= $doc['institute'] ?>
                    </div>
                    <div class="col-md-3" > 
                        <strong class="right_sre">Qualification Image : -</strong>
                    </div>
                    <div class="col-md-9">
                        <img src="<?= $doc['document'] ?>" style="width: 25%;height: 162px;">
                    </div>
                <?php } ?>
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