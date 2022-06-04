
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

<div class="abc" ><h3>ADD SECTION PROP</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/section_prop_add/", ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('section'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Select Section</strong>
                </div>
                <div class="col-md-9">
                <select name="section" class="ch_manset padd_set">
                    <option>Select Section</option>
                    <?php $sec = $this->api_model->get_data('isactive = "1"', 'product_section'); 
                        foreach($sec as $se){
                        ?>
                            <option value="<?= $se['id'] ?>"><?= $se['name'] ?></option>
                        <?php } ?>
                </select>
        	</div>
            <?php echo form_error('prop'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Prop Name</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'prop', 'value'=>'', 'id'=>'prop','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('price'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Prop Price</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'price', 'value'=>'', 'id'=>'price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <div class="col-md-3" > 
                <strong class="right_sre">Retailer Price</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'ret_price', 'value'=>'', 'id'=>'ret_price','class'=>'ch_manset padd_set']) ?>
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
