
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

<div class="abc" ><h3>ADD UNIT</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/unit_add/", ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Unit Name</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('quantity'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Unit Quantity</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'quantity', 'value'=>'', 'id'=>'quantity','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('quantity_fare'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Maximum quantity fare</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'quantity_fare', 'value'=>'', 'id'=>'quantity_fare','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('rate'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Dilivary Rate</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'rate', 'value'=>'', 'id'=>'rate','class'=>'ch_manset padd_set']) ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('rate_unit'); ?></div>
            <div class="col-md-3" > 
                <strong class="right_sre">Dilivary Rate In Paise or Rs</strong>
                </div>
                <div class="col-md-9">
                    <select name="rate_unit" class="ch_manset padd_set">
                        <option value="">Select Rate In</option>
                        <option value="1">Rs</option>
                        <option value="0">Paise</option>
                    </select>
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
