
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

<div class="abc" ><h3>EDIT SUB REQUEST</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("repeat_breading/edit_sub/".$data[0]['id'], ['onsubmit'=>'return myFunction()']);?>
            <?php if($data[0]['doc_id'] !=0){ ?>
            <?php echo form_error('doc'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Select Doctor</strong>
                </div>
                <div class="col-md-9">
                <?php 
                $data1 = $this->api_model->get_data('users_type IN ("pvt_doc")','doctor');
                //print_r($data);
                        $opt = "<select name='doc' class='collector form-control ch_manset select2 padd_set'>"; 
                        $opt .="<option value='0'>Select Doctor</option>";
                        foreach($data1 as $da){
                            $sel = '';
                            if($da['doctor_id'] == $data[0]['doc_id']){
                                $sel = 'selected';
                            }
                            $opt .= "<option value='".$da['doctor_id']."' ".$sel.">".$da['username']."(".$da['mobile'].")"."</option>";
                        }
                        $opt .="</select>";
                        
                        echo $opt;
                ?>
        	</div>
            <?php } ?>
            <?php if($data[0]['vt_id'] !=0){ ?>
            <?php echo form_error('ai'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Select AI Worker</strong>
                </div>
                <div class="col-md-9">
                <?php 
                $data1 = $this->api_model->get_data('users_type IN ("pvt_vt", "pvt_ai")','doctor');
                //print_r($data);
                        $opt = "<select name='ai' class='collector form-control ch_manset select2 padd_set' >"; 
                        $opt .="<option value='0'>Select AI Worker</option>";
                        foreach($data1 as $da){
                            $sel = '';
                            if($da['doctor_id'] == $data[0]['vt_id']){
                                $sel = 'selected';
                            }
                            $opt .= "<option value='".$da['doctor_id']."' ".$sel.">".$da['username']."(".$da['mobile'].")"."</option>";
                        }
                        $opt .="</select>";
                        
                        echo $opt;
                ?>
        	</div>
            <?php } ?>
            <?php echo form_error('type'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Select Teatment Type</strong>
                </div>
                <div class="col-md-9">
                    <select name="type" class='form-control ch_manset padd_set' disable>
                        <option value=''>Select Treatment Type</option>
                        <option value='0' <?php if($data[0]['treat_type'] == '0'){ echo "selected"; } ?>>Treatment Type</option>
                        <option value='1' <?php if($data[0]['treat_type'] == '1'){ echo "selected"; } ?>>Vaccination Type</option>
                        <option value='2' <?php if($data[0]['treat_type'] == '2'){ echo "selected"; } ?>>deworming Type</option>
                        <option value='3' <?php if($data[0]['treat_type'] == '3'){ echo "selected"; } ?>>AI Type</option>
                        <option value='4' <?php if($data[0]['treat_type'] == '4'){ echo "selected"; } ?>>crisis Type</option>
                        <option value='5' <?php if($data[0]['treat_type'] == '5'){ echo "selected"; } ?>>Home visiting Type</option>
                        <option value='6' <?php if($data[0]['treat_type'] == '6'){ echo "selected"; } ?>>Yield check Type</option>
                        <option value='7' <?php if($data[0]['treat_type'] == '7'){ echo "selected"; } ?>>Repeat breeding Type</option>
                    </select>
        	</div>
            <?php echo form_error('status'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Select Status</strong>
                </div>
                <div class="col-md-9">
                    <select name="status" class=' form-control ch_manset padd_set'>
                        <option value=''>Select Status</option>
                        <option value='0' <?php if($data[0]['treat_status'] == '0'){ echo "selected"; } ?>>Pending</option>
                        <option value='1' <?php if($data[0]['treat_status'] == '1'){ echo "selected"; } ?>>Accept</option>
                        <option value='5' <?php if($data[0]['treat_status'] == '5'){ echo "selected"; } ?>>Start</option>
                        <option value='3' <?php if($data[0]['treat_status'] == '3'){ echo "selected"; } ?>>cancel</option>
                        <option value='4' <?php if($data[0]['treat_status'] == '4'){ echo "selected"; } ?>>Closed</option>
                    </select>
        	</div>
            <?php echo form_error('symtoms'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Animal Symptoms</strong>
                </div>
                <div class="col-md-9">
                    <textarea name="symtoms" class=' form-control ch_manset padd_set'><?= $data[0]['animal_simtoms'] ?></textarea>
        	</div>
            <?php echo form_error('suggestion'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Animal Suggestion</strong>
                </div>
                <div class="col-md-9">
                    <textarea name="suggestion" class=' form-control ch_manset padd_set'><?= $data[0]['animal_suggestion'] ?></textarea>
        	</div>
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Edit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
                <a href="<?= base_url('repeat_breading/view/'.$data[0]['request_id']); ?>" class="btn btn-success" style="width:80px; margin-top: 16px;">Back</a>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
