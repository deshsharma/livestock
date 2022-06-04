
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

<div class="abc" ><h3>VIEW COMPOSITION REQUEST</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("comp_request/view/".$data[0]['id']);?>
                <div class="col-md-3" > 
                    <strong class="right_sre">User Name</strong>
                </div>
                <div class="col-md-9">
                    <?= $data[0]['user_name'] ?>
        	    </div>
                <div class="col-md-3" > 
                    <strong class="right_sre">User Mobile</strong>
                </div>
                <div class="col-md-9">
                    <?= $data[0]['user_mobile'] ?>
        	    </div>
                <div class="col-md-3" > 
                    <strong class="right_sre">Section Name</strong>
                </div>
                <div class="col-md-9">
                    <?= $data[0]['section_name'] ?>
        	    </div>
                <div class="col-md-3" > 
                    <strong class="right_sre">Section Prop Name</strong>
                </div>
                <div class="col-md-9">
                    <?= $data[0]['section_prop_name'] ?>
        	    </div>
            <div class="col-md-12"><?php echo form_error('rate_unit'); ?></div>
            <?php $comp = $this->api_model->get_data('', 'feed_composition'); 
                foreach($comp as $co){
                $unit = $this->api_model->get_data('isactive = "1" AND id = "'.$co['unit'].'"', 'unit'); 
                ?>
                    <div class="col-md-3" > 
                        <strong class="right_sre"><?= $co['name'] ?> In <?= $unit[0]['name'] ?></strong>
                        </div>
                        <div class="col-md-9">
                        <?php echo form_input(['type'=>'text','name'=>'name_'.$co['id'], 'value'=>$data[0]['name'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
                    </div>
                <?php } ?>
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Update', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
