
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
<div class="abc" ><h3>EDIT OFFER</h3></div>
<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
    <?php echo form_open("admin/semen_group_discount_edit/".$data[0]['id'], ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Offer Name</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>$data[0]['name'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('group'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Select Semen Group</strong>
                </div>
                <div class="col-md-9">
                <select name="group[]" class="form-control" style="margin-bottom: 10px;" multiple>
                <option value="0">Select Group</option>
                <?php $data1 = $this->api_model->semen_account_search(); 
                        $group = explode(',', $data[0]['groups']);
                      foreach($data1 as $da){
                        ?>
                        <option value="<?= $da['id'] ?>" <?php if(in_array($da['id'], $group)){ echo "Selected";} ?>><?= $da['group']?></option>
                        <?php
                      }
                ?>
                </select>
        	</div>
            <?php echo form_error('qty'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Semen Quaitity</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'qty', 'value'=>$data[0]['semen_quantity'], 'id'=>'offer_price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('limit_qty'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Semen Limit Quaitity</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'limit_qty', 'id'=>'limit_qty', 'value'=>$data[0]['limit_quantity'], 'class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('percentage'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Discount Percentage</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'number','name'=>'percentage', 'value'=>$data[0]['percentage'], 'id'=>'price','class'=>'ch_manset padd_set']) ?>
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
