
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
<div class="abc" ><h3>EDIT COMPANY GROUP PRICE</h3></div>
<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
    <?php echo form_open("admin/semen_company_price_edit/".$data[0]['id'], ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('company'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Select Company</strong>
                </div>
                <div class="col-md-9">
                <?php $data2 = $this->api_model->get_data('user_type IN ("1", "2", "3", "4")' , 'admin'); ?>
                <select class="form-control" name="company" style="margin-bottom: 10px;" >
                    <option value="">Select Company</option>
                    <?php foreach($data2 as $da){ ?>
                        <option value="<?= $da['admin_id']?>" <?php if($data[0]['company'] == $da['admin_id']){ echo "selected"; } ?>><?= $da['fname'] ?></option>
                    <?php } ?>
                </select>
                    <?php //echo form_input(['type'=>'text','name'=>'name', 'value'=>$data[0]['group'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('group'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Select Semen Group</strong>
                </div>
                <div class="col-md-9">
                <select name="group" class="form-control" style="margin-bottom: 10px;" >
                <option value="">Select Group</option>
                <?php $data1 = $this->api_model->semen_account_search(); 
                      foreach($data1 as $da){
                        ?>
                        <option value="<?= $da['id'] ?>" <?php if($data[0]['group'] == $da['id']){ echo "selected"; } ?>><?= $da['group']?></option>
                        <?php
                      }
                ?>
                </select>
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
                    echo form_submit(['name'=>'submit','value'=>'Add', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
