<link rel="stylesheet" href="<?= base_url() ?>assets/app/css/livestoc.css">
<div class="content-wrapper cust-mainbg">  
<div class="cust-wrapper">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="mT40 mB40"><?php echo "Add Coupans"; ?></h12>
    </div>
  </div>
  <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
  <?php echo form_open_multipart("coupans/create/");?>
  <?php //print_r($_SESSION); ?>
  <div class="row">
    <div class="col-md-12">
          <div class="box box-danger2 box-primary">
            <div class="box-header">
              <!-- <h3 class="box-title">Enter the required information</h3> -->
            </div>  
        <div class="box-body">
                <!-- text input -->
                <div class="form-group ref" style="text-align: center; display:none;">
                  <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_error('name'); ?>
                        <label>Create Coupan </label>
                        <?php $coupan = 'LIVE'.rand(1000000,100000); ?>
                        <input type="text" name="name" value="<?= $coupan ?>" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <?php echo form_error('type'); ?>
                        <label>Select Type</label>
                        <?php if($type != ''){ 
                                ?>
                                <input type="hidden" name="type" value="<?= $type ?>" class="form-control" placeholder="Enter ...">
                                <?php
                            } ?>
                        <select name="type" id="type" class="form-control" <?php if($type != ''){ echo 'disabled';} ?>>
                            <option value="">Select Type</option>
                            <option value="animals" <?php if($type == 'animals'){ echo "selected"; } ?>>Animals</option>
                            <option value="product" <?php if($type == 'product'){ echo "selected"; } ?>>Product</option>
                            <!-- <option value="product">Services</option> -->
                        </select>
                        </div>
                    </div>
                </div>
                <?php //if($type == 1){ ?>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('user'); 
                            $users = $this->api_model->get_data('','users', 'users_id DESC', 'users_id, full_name, mobile');
                            //print_r($users);
                            ?>
                             <?php if($users_id != ''){ 
                                ?>
                                <input type="hidden" name="user" value="<?= $users_id ?>" class="form-control" placeholder="Enter ...">
                                <?php
                            } ?>
                            <label>Select User</label>
                                <select name="user" class="form-control" <?php if($users_id != ''){ echo 'disabled';} ?>>
                                    <option>Select User</option>
                                    <?php foreach($users as $us) { ?>
                                        <option value="<?= $us['users_id'] ?>" <?php if($us['users_id'] == $users_id){ echo "selected"; } ?>><?= $us['full_name']."(".$us['mobile'].")" ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 animals" style="<?php if($type != 'animals'){ echo "display:none;";} ?>">
                            <div class="form-group">
                            <?php echo form_error('animal'); 
                            $animals = $this->api_model->get_data('','animals','animal_id DESC');
                            ?>
                             <?php if($product_id != '' && $type == 'animals'){ 
                                ?>
                                <input type="hidden" name="animal" value="<?= $product_id ?>" class="form-control" placeholder="Enter ...">
                                <?php
                            } ?>
                            <label>Select Animal</label>
                                <select name="animal" class="form-control" <?php if($type == 'animals'){ echo 'disabled';} ?>>
                                    <option>Select Animal</option>
                                    <?php foreach($animals as $ani){ ?>
                                        <option value="<?= $ani['animal_id'] ?>" <?php if($ani['animal_id'] == $product_id){ echo "selected"; } ?>>#<?= $ani['animal_id'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 product" style="<?php if($type != 'product'){ echo "display:none;";} ?>">
                            <div class="form-group">
                            <?php echo form_error('product'); 
                            $product = $this->api_model->get_data('','product','id DESC');
                            ?>
                            <?php if($product_id != '' && $type == 'product'){ 
                                ?>
                                <input type="hidden" name="product" value="<?= $product_id ?>" class="form-control" placeholder="Enter ...">
                                <?php
                            } ?>
                            <label>Select Product</label>
                                <select name="product" class="form-control" <?php if($type == 'product'){ echo 'disabled';} ?>>
                                    <option>Select Animal</option>
                                    <?php foreach($product as $pro){ ?>
                                        <option value="<?= $pro['id'] ?>" <?php if($pro['id'] == $product_id){ echo "selected"; } ?>>#<?= $ani['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        
                        <div>
                        </div>
                        </div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <?php echo form_error('time'); 
                                ?>
                                <label>Select Time(Hr)</label>
                                    <select name="time" class="form-control" >
                                        <option>Select Time</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <?php echo form_error('rate'); 
                                ?>
                                <label>Off In Rs</label>
                                    <input type="text" name="rate" value="" class="form-control" placeholder="Enter ...">
                                </div>
                            </div>
                        </div>
                <?php //} ?>

          </div>
        </div>
    

   
            <div class="row">
                <div class="col-md-12 text-center cust-addbull"> 
                    <input type="submit" name="submit" class="btn btn-primary" style="margin-bottom: 20px;" id="submit" value="Submit">
                </div>
            </div>

            </div>
    </div>
</form>
</div>
</div>
<script>
    $('#type').change(function(){
        if($(this).val() == 'animals'){
            $('.animals').show();
            $('.product').hide();
        }else if($(this).val() == 'product'){
            $('.product').show();
            $('.animals').hide();
        }else{
            $('.product').hide();
            $('.animals').hide();
        }
    })
$('.state').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data.data;
                    var option = '<option value="">Select District</option>';
			                            $.each(str, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			                            }); 
                                        $('.city').html(option);
										
                }
                });
})
$('.state1').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data.data;
                    var option = '<option value="">Select District</option>';
			                            $.each(str, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			                            }); 
                                        $('.city1').html(option);
										
                }
                });
})
$('#submit').click(function(e){
  if($('#bull_photo').val() == ''){
    e.preventDefault();
    alert("Please Upload Photo");
  }
});
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