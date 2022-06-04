
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
                <strong class="right_sre">Composition Name Englsih</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('name_hi'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Composition Name Hindi</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name_hi', 'value'=>'', 'id'=>'name_hi','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('name_pa'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Composition Name Punjabi</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name_pa', 'value'=>'', 'id'=>'name_pa','class'=>'ch_manset padd_set']) ?>
        	</div>
            <!-- <div class="form-group">
                <?php echo form_error('language'); ?>
                <div class="col-md-3" > 
                  <label class="right_sre">Select Languge</label>
                </div>
                <div class="col-md-9" > 
                  <select name="language" id="languae" class="ch_manset padd_set" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                  <label>Language Name.</label>
                    <?php
                      $language = $this->api_model->get_data('is_activate = "1"','language','','*');
                    foreach($language as $lang){ ?>                        
                        <option value="<?= $lang['id'] ?>"><?= $lang['name']?></option>
                    <?php } ?>
                  </select>
                  </div>
            </div> -->
            <!-- <div class="form-group">
                <div class="col-md-3" >
                <?php echo form_error('category'); ?>
                    <label class="right_sre">Short Description</label>
                </div>
                <div class="col-md-9">
                    <textarea id="editor1" class="ch_manset padd_set" name="desc" rows="8" cols="80">
                        This is my textarea Short Description.
                    </textarea>
                </div>
            <div> -->
            <!-- <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_error('category'); ?>
                        <label class="right_sre">Long Description</label>
                </div>
                <div class="col-md-9">
                        <textarea id="editor2" class="ch_manset padd_set" name="long_desc" rows="8" cols="80">
                        This is my textarea Long Description.
                        </textarea>
                </div>
                <div class="col-md-3">
                    <?php echo form_error('category'); ?>
                    <label class="right_sre">Other Description</label>
                </div>
                <div class="col-md-9">
                    <textarea id="editor3" class="ch_manset padd_set" name="other_desc" rows="8" cols="80">
                    This is my textarea Other Description.
                    </textarea>
                </div>
            </div> -->
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
