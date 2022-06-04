
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

<div class="abc" ><h3>EDIT CRON</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/edit_cron/".$data[0]['id'], ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('table'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Cron Table</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'table', 'value'=>$data[0]['table'], 'id'=>'table','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('function'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Cron function name</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'function', 'value'=>$data[0]['function'], 'id'=>'function','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('Condition'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Cron Condition</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'Condition', 'value'=>$data[0]['condition'], 'id'=>'Condition','class'=>'ch_manset padd_set']) ?>
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
