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
        	   <strong class="right_sre"></strong>
            </div>
            <div class="col-md-12" style="text-align: center;">
            <?php if($data[0]['users_type'] == 'pvt_doc'){ ?>
                    <div class="col-md-12"><?php if($data[0]['image'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo "<img src=".base_url()."uploads/doctor/".$data[0]['image']." data-imgsrc=".base_url()."uploads/doctor/".$doc['image']." class='image' style='width: 25%;height: 162px;'>";} ?></div>
                <?php }else{ ?>
                   <div class="col-md-12"> <?php if($data[0]['image'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo "<img src=".base_url()."uploads/doc/".$data[0]['image']." data-imgsrc=".base_url()."uploads/doc/".$doc['image']." class='image' style='width: 25%;height: 162px;'>";} ?></div>
                <?php } ?>
        	</div>
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
        	   <strong class="right_sre">Enrollment Date : -</strong>
            </div>
            <div class="col-md-9">
                <?php if($data[0]['date'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo $data[0]['date'];} ?>
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
                    <div class="col-md-12"><?php if($data[0]['adhaar_img'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo "<img src=".base_url()."uploads/doctore_doc/".$data[0]['adhaar_img']." data-imgsrc=".base_url()."uploads/doctore_doc/".$doc['adhaar_img']." style='width: 25%;height: 162px;'>";} ?></div>
                <?php }else{ ?>
                   <div class="col-md-12"> <?php if($data[0]['adhaar_img'] == ''){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}else{ echo "<img src=".base_url()."uploads/doc/".$data[0]['adhaar_img']." data-imgsrc=".base_url()."uploads/doc/".$doc['adhaar_img']." style='width: 25%;height: 162px;'>";} ?></div>
                <?php } ?>
                <!-- <div class="col-md-12"><span class="btn btn-danger" onclick="">Reject</span></div> -->
            </div>
            <?php $document = $this->api_model->get_data('doc_id = "'.$data[0]['doctor_id'].'"', 'document_table', '', '*'); 
            foreach($document as $doc){
                ?>
                    <div class="col-md-3"> 
                    <strong class="right_sre"><?= $doc['degree_name'] ?> : -</strong>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12"><?php echo "<img src=".base_url()."uploads/doc/".$doc['image']." data-imgsrc=".base_url()."uploads/doc/".$doc['image']." style='width: 25%;height: 162px;' class='image' data-toggle='modal' data-target='#modal-default' data-doc_id='".$data[0]['doctor_id']."' data-document='".$doc['id']."'>" ?></div>
                        <?php //if($doc['isactive'] == '1'){ ?>
                            <!-- <div class="col-md-12"><span class="btn btn-danger" onclick="document_doc(<?= $data[0]['doctor_id'] ?>, <?= $doc['id'] ?>, '0')" >Reject</span></div> -->
                        <?php //}else{ ?>
                            <!-- <div class="col-md-12"><span class="btn btn-primary" onclick="document_doc(<?= $data[0]['doctor_id'] ?>, <?= $doc['id'] ?>, '1')">Approved</span></div> -->
                        <?php //} ?>
                    </div>
                <?php } ?>
            <div class=""></div>
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
        <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" value="" class="doctor_id_value">
                <input type="hidden" value="" class="document_id_value">
                <p class="image_source">One fine body…</p>
                <div class="col-md-3">Remark : - </div>
                <div class="col-md-9"><input type="text" class="form-control" id="remark"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left re-submit" data-status="0" data-dismiss="modal">Reject</button>
                <button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Approved</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</div>
<?php include_once('layouts/admin_footer.php'); ?>
<script>
function document_doc(user_id, document_id, status){
    $.ajax({
        url: "<?= base_url('admin/doc_approval/') ?>?doc_id="+user_id+"&document_id="+document_id+"&status="+status,
        cache: false,
        success: function(html){
            str =JSON.parse(html);
            alert(str.msg);
            window.location.reload();
        }
    });
}
$('.re-submit').click(function(){
    var user_id = $('.doctor_id_value').val();
    var document_id = $('.document_id_value').val();
    var remark = $('#remark').val();
    $.ajax({
        url: "<?= base_url('admin/doc_approval/') ?>?doc_id="+user_id+"&document_id="+document_id+"&status=0&remark="+remark,
        cache: false,
        success: function(html){
            str =JSON.parse(html);
            alert(str.msg);
            window.location.reload();
        }
    });
});
$('.sub-submit').click(function(){
    var user_id = $('.doctor_id_value').val();
    var document_id = $('.document_id_value').val();
    var remark = $('#remark').val();
    $.ajax({
        url: "<?= base_url('admin/doc_approval/') ?>?doc_id="+user_id+"&document_id="+document_id+"&status=1&remark="+remark,
        cache: false,
        success: function(html){
            str =JSON.parse(html);
            alert(str.msg);
            window.location.reload();
        }
    });
});
$('.image').click(function(){
    $('.doctor_id_value').val($(this).data('doc_id'));
    $('.document_id_value').val($(this).data('document'));
    $('.image_source').html('<img src="'+$(this).data('imgsrc')+'" style="height:100%; width:100%;">');
    //alert($(this).data('imgsrc'))
})
</script>