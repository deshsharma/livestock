
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

<div class="abc" ><h3>ADD COMPOSITION</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin_composition/composition_add/");?>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Composition Name</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <div class="col-md-12"><?php echo form_error('rate_unit'); ?></div>
            <div class="col-md-3" > 
                <strong class="right_sre">Select Unit</strong>
                </div>
                <div class="col-md-9">
                    <?php $data = $this->api_model->get_data('isactive = "1"', 'unit'); 
                    ?>
                    <select name="rate_unit" class="ch_manset padd_set">
                        <option value="">Select Unit</option>
                        <?php foreach($data as $da){ ?>
                            <option value="<?= $da['id'] ?>"><?= $da['name'] ?></option>
                        <?php } ?>
                    </select>
        	</div>
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Add', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
