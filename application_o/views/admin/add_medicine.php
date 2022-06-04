
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

<div class="abc" ><h3>ADD MEDICINE</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/add_medicine/", ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Name</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('type'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Type</strong>
                </div>
                <div class="col-md-9">
                <select name="type" class="ch_manset padd_set">
                <option>Select Type</option>
                <?php $cat = $this->api_model->get_data('','medicine_type'); 
                    foreach($cat as $ca){
                ?>
                    <option value="<?= $ca['id'] ?>"><?= $ca['name'] ?></option>
                <?php } ?>
                </select>
                    <?php// echo form_input(['type'=>'text','name'=>'category', 'value'=>'', 'id'=>'category','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('unit'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Unit</strong>
                </div>
                <div class="col-md-9">
                <select name="unit" class="ch_manset padd_set">
                <option>Select Unit</option>
                <?php $cat = $this->api_model->get_data('','unit'); 
                    foreach($cat as $ca){
                ?>
                    <option value="<?= $ca['id'] ?>"><?= $ca['name'] ?></option>
                <?php } ?>
                </select>
                    <?php// echo form_input(['type'=>'text','name'=>'category', 'value'=>'', 'id'=>'category','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('category'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Category</strong>
                </div>
                <div class="col-md-9">
                <select name="category[]" class="ch_manset padd_set" multiple>
                <option>Select Category</option>
                <?php $cat = $this->api_model->get_data('','category'); 
                    foreach($cat as $ca){
                ?>
                    <option value="<?= $ca['category_id'] ?>"><?= $ca['category'] ?></option>
                <?php } ?>
                </select>
                    <?php// echo form_input(['type'=>'text','name'=>'category', 'value'=>'', 'id'=>'category','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('composition'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Composition</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'composition', 'value'=>'', 'id'=>'composition','class'=>'ch_manset padd_set']) ?>
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
