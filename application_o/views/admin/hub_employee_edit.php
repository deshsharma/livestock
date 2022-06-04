
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

<div class="abc" ><h3>ADD HUB</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/hub_employee_edit/".$data[0]['admin_id'], ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('hub'); ?>
                <div class="col-md-3" > 
                    <strong class="right_sre">Select Hub</strong>
                    </div>
                    <div class="col-md-9">
                        <select name="hub" class='ch_manset padd_set'>
                            <?php
                            $hub = $this->api_model->get_data('type = "30"', 'admin');
                            echo "<option value='0'>Select HUB</option>";
                            foreach($hub as $h){
                                ?>
                                <option value="<?= $h['admin_id'] ?>" <?php if($h['admin_id'] == $data[0]['super_admin_id']){ echo "selected"; } ?>><?= $h['fname'] ?></option>
                                <?php
                            } 
                            ?>
                        </select>
                </div>
                <?php echo form_error('password'); ?>
                <div class="col-md-3" > 
                    <strong class="right_sre">Password</strong>
                    </div>
                    <div class="col-md-9">
                        <?php echo form_input(['type'=>'password','name'=>'password', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
                </div>
                <?php echo form_error('name'); ?>
                <div class="col-md-3" > 
                    <strong class="right_sre">Employee Name</strong>
                    </div>
                    <div class="col-md-9">
                        <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>$data[0]['fname'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
                </div>
            <?php echo form_error('mobile'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Employee Mobile No</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'mobile', 'value'=>$data[0]['mobile'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('email'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Employee Email</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'email', 'value'=>$data[0]['email'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
            </div>
            <?php echo form_error('address'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Employee Address</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'address', 'value'=>$data[0]['address'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
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
