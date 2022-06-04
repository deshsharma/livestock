<?php print_r($_REQUEST);?>
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div id="page-wrapper" >  
                <div id="page-inner">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form method="post" action="<?= base_url('admin/pet_vaccination_update')?>">
                                    <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                                            <diV class="col-md-3"></div>
                                            <div class="col-md-9 corm_nmset">
                                                <div class=" error" style="margin-left:0%;">
                                                    <?= $error ?>
                                                </div>
                                            </div>
                                    <?php } ?>
                                        <div class="form-group">
                                            <label>Packages Type*</label>
                                            <?php
                                            $packages = $this->admin_detail->allpackages($id);
                                            //print_r($packages[0]['package_desc']);
                                            $package_type = $this->api_model->get_data('', 'package_type_mst'); ?>
                                            <select name ="package_type_id" id ="package_type_id" class="form-control" required>
                                                <?php 
                                                foreach($package_type as $p_type){
                                                    echo "<option value ='".$p_type['package_type_id']."'>".$p_type['package_type']."</option>";
                                                }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type ="hidden" name= "package_id" value="<?php echo $id;?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Pacakage Name* :</label>
                                            <input type ="text" name= "package_name" value="<?php echo $packages[0]['package_name'];?>" class="form-control" placeholder="Please Enter Package Name" required/>
                                        </div>
                                        <div id="package_days">
                                            <div class="form-group" >
                                                <label>Pacakage Days* :</label>
                                                <input type ="number" name= "package_days" value="<?php echo $packages[0]['package_days'];?>" class="form-control" placeholder="Please Enter Package Days" required="required"/>
                                            </div>
                                            <div class="form-group" id= "">
                                                <label>Pacakage Call/Animal Amount* :</label>
                                                <input type ="number" name= "package_call" value="<?php echo $packages[0]['package_callnum'];?>" class="form-control" placeholder="Please Enter Package Days" required="required"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Pacakage Price* :</label>
                                            <input type ="number" name= "package_price" value="<?php echo $packages[0]['package_price'];?>" class="form-control" placeholder="Please Enter Package Price" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Doctor Price* :</label>
                                            <input type ="number" name= "doc_price" value="<?php echo $packages[0]['doc_price'];?>" class="form-control" placeholder="Please Enter Package Price" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Company Price* :</label>
                                            <input type ="number" name= "company_price" value="<?php echo $packages[0]['company_price'];?>" class="form-control" placeholder="Please Enter Package Price" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Pacakage Discount Percent* :</label>
                                            <input type ="number" name= "package_discount_percent" value="<?php echo $packages[0]['package_discount_percent'];?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>Pacakage GST Percent*:</label>
                                            <input type ="number" name= "gst_percent" value="<?php echo $packages[0]['gst_percent'];?>" class="form-control" placeholder="Please Enter Package GST" required/>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Features :</label>
                                            <textarea  name="features" value="<?php echo $packages[0]['features']; ?>" class="form-control"  placeholder="Features (Camma Separated)" ></textarea>
                                            </textarea>
                                        </div> -->
                                        <div class="form-group">
                                                <label>Features</label>
                                            <textarea id="editor3" name="features" rows="8" cols="40">
                                            <?php echo $packages[0]['features'];?>
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                                <label>Pacakage Full Description*</label>
                                            <textarea id="editor1" name="package_desc" rows="8" cols="80">
                                            <?php echo $packages[0]['package_desc'];?>
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                                <label>Pacakage Short Description</label>
                                            <textarea id="editor2" name="package_short_desc" rows="8" cols="80">
                                            <?php echo $packages[0]['package_short_desc'];?>
                                            </textarea>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Add Package Image</label>
                                            <input type="file" name= "image"/>
                                        </div> -->
                                        <div class="col-md-3" > 
                                            <strong class="right_sre">Add Package Image </strong>
                                            <div class="form-group ref" style="margin-left: 222%;height: 37px;margin-top: -12px;display:none;">
                                                <img src="https://www.livestoc.com/harpahu_merge_dev/assets/gif/source.gif" style="height: 38px;">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <input data-required="image" type="file" id="bull_image" class="image-input" data-traget-resolution="image_resolution" value="">
                                            <input type="hidden" name="animal_image" id="bull_photo" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Status*</label>
                                            <select name ="isactivated" class="form-control" required>
                                                <option value ="1">Active</option>
                                                <option value ="0">Deactive</option>
                                            </select>
                                        </div>
                                        <br/>
                                        <div class="box-footer">
                                        <input type="submit" id="submit" name="submit" class="btn btn-primary">
                                        </div>
                                        <!-- <button type="submit" name="submit" class="btn btn-default" value="submit">Submit</button> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
 <script>
  $(function () {
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
    CKEDITOR.replace('editor3')
    $('.textarea').wysihtml5()
  })
  $(document).ready(function () {
    $('#package_type_id').change(function(){
        if($('#package_type_id').val() == '3') {
            $('#package_days').hide(); 
			$("#package_days :input").removeAttr("required","required");		
        } else {
            $('#package_days').show();
			$("#package_days :input").attr("required","required");			
        } 
    });
});
// $('#submit').click(function(e){
//   if($('#bull_photo').val() == ''){
//     e.preventDefault();
//     alert("Please Upload Photo");
//   }
// });
$(document).ready(function() {
                $('#bull_image').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_image')[0].files[0].name);
                    var file_data = $('#bull_image').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#bull_photo').val(data.data);
                            $('.ref').hide();
                        }
                    });
                });
});
</script>