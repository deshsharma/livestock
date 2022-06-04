
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

<div class="abc" ><h3>EDIT PACKAGE</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/semen_packages_edit/", ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Package Name</strong>
                </div>
                <div class="col-md-9">
                <input type="hidden" name="id" value="<?= $data[0]['id'] ?>">
                    <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>$data[0]['name'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('quantity'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Package Price</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'price', 'value'=>$data[0]['price'], 'id'=>'price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('quantity_fare'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Package Offer Price</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'offer_price', 'value'=>$data[0]['offer_price'], 'id'=>'offer_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('per_animal_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Per Aminal Price</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'per_animal_price', 'value'=>$data[0]['per_animal_price'], 'id'=>'per_animal_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('qty'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Aminal Quantity</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'qty', 'value'=>$data[0]['animal_quantity'], 'id'=>'qty','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('bull_image'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Package Image</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'file','name'=>'bull_image', 'value'=>$data[0]['image'], 'id'=>'bull_image','class'=>'ch_manset padd_set']) ?>
                    <?php echo form_input(['type'=>'hidden','name'=>'bull_photo', 'value'=>$data[0]['image'], 'id'=>'bull_photo']) ?>
        	</div>
            <?php echo form_error('descr'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Package Desciption</strong>
                </div>
                <div class="col-md-9">
                    <textarea class="textarea" name="descr" value ="<?= $data[0]['description']?>"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                  <?= $data[0]['description']?>
                                              </textarea>
                    <?php //echo form_textarea(['name'=>'descr', 'value'=>$data[0]['description'], 'id'=>'descr','class'=>'ch_manset padd_set']) ?>
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
<script>
$(document).ready(function() {
				$('#bull_image').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#bull_image')[0].files[0].name);
					var file_data = $('#bull_image').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
					$.ajax({
						url: "<?= base_url() ?>Api/web_cropper_images?path=package",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#bull_photo').val(data.data);
						}
					});
				});
});
</script>
