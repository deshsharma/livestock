
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
        <?php echo form_open("admin/semen_group_edit/", ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('group'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Group Name</strong>
                </div>
                <div class="col-md-9">
                    <input type="hidden" value="<?= $data[0]['id'] ?>" name="id">
                    <?php echo form_input(['type'=>'text','name'=>'group', 'value'=>$data[0]['group'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('farmer_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Group Semen Price for Farmer</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'farmer_price', 'value'=>$data[0]['farmer_price'], 'id'=>'price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('farmer_offer_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Group Semen Offer Price for Farmer</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'farmer_offer_price', 'value'=>$data[0]['farmer_offer_price'], 'id'=>'offer_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('ai_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Group Semen Price for AI Worker</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'ai_price', 'value'=>$data[0]['ai_price'], 'id'=>'price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('ai_offer_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Group Semen Offer Price for AI Worker</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'ai_offer_price', 'value'=>$data[0]['ai_offer_price'], 'id'=>'offer_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('advance_booking_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Advance Booking Price</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'advance_booking_price', 'value'=>$data[0]['advance_booking_price'], 'id'=>'per_animal_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('advance_booking_offer_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Advance Booking Offer Price</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'advance_booking_offer_price', 'value'=>$data[0]['advance_booking_offer_price'], 'id'=>'per_animal_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('ai_service_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">AI Service Charges</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'ai_service_price', 'value'=>$data[0]['ai_service_price'], 'id'=>'qty','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('ai_service_offer_price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">AI Offer Service Charges</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'ai_service_offer_price', 'value'=>$data[0]['ai_service_offer_price'], 'id'=>'qty','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('company_charges'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Company Charges</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'company_charges', 'value'=>$data[0]['company_charges'], 'id'=>'qty','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('company_offer_charges'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Company offer Charges</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'company_offer_charges', 'value'=>$data[0]['company_offer_charges'], 'id'=>'qty','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('ai_incentive'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">AI Incentive</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'ai_incentive', 'value'=>$data[0]['ai_incentive'], 'id'=>'qty','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('ai_offer_incentive'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">AI offer Incentive</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'ai_offer_incentive', 'value'=>$data[0]['ai_offer_incentive'], 'id'=>'qty','class'=>'ch_manset padd_set']) ?>
        	</div>
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Edit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
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
