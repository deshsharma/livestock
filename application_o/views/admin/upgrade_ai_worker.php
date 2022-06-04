<style>
.cust-mainbg{background: #ECF0F5; min-height: 100vh}
.cust-wrapper{width: 100%; margin: 0 auto}

.mT40{margin-top: 40px}
.mB40{margin-bottom: 40px}
.mR20{margin-right: 20px}

.cust-addbull input{width: 50%; margin-top: 5px; padding: 10px; font-size: 20px; font-weight: 600; background: #4DA8B0}
.cust-pos{position: relative; top: -30px}
.box-danger2{border-top: 5px solid #0aa8b0; padding: 0 10px;}

.box-header h3{font-size: 26px!important; margin: 20px 0!important;}
.btn-success{background: #c13033; border-color: #c13033 }
.btn-success .fa{padding-right: 10px} 
.error{color:#ff0000;}
@media only screen and (max-width : 767px) {
.cust-wrapper{width: 100%;}
}
</style>
<div class="content-wrapper cust-mainbg">  
    <div class="cust-wrapper">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mT40 mB40">Upgrade to Premium</h12>
            </div>
        </div>
        <?php echo form_open_multipart("admin/upgrade_to_worker/");?>
            <?php //print_r($_SESSION); ?>
            <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                    <diV class="col-md-3"></div>
                    <div class="col-md-9 corm_nmset">
                        <div class=" error" style="margin-left:0%;">
                            <?= $error ?>
                        </div>
                    </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger2 box-primary">
                        <div class="box-header">
                            <!-- <h3 class="box-title text-center">&#8377; 500</h3> -->
                        </div>  
                        <div class="box-body">
                            <div class="col-md-3" > 
                            </div>
                            <div class="col-md-9">
                                <h3 class="container-sm centere">&#8377; 500</h3>
                            </div>
                            <div class="col-md-3" > 
                            </div>
                            <div class="col-md-9">
                                <h3 class="container-sm center">Enter your referral code here</h3></br>
                            </div>
                            <?php echo form_error('code'); ?>
                            <div class="col-md-3 mt-5" > 
                                <strong class="right_sre">Transaction Id</strong>
                            </div>
                            <div class="col-md-9">
                                <?php echo form_input(['type'=>'text','name'=>'transaction_id', 'value'=>set_value('transaction_id'), 'id'=>'key','class'=>'container-sm', 'rules' => 'required']); ?>
                                
                            </div>
                            <?php echo form_error('code'); ?>
                            <div class="col-md-3 mt-5" > 
                                <strong class="right_sre">Referral Code</strong>
                            </div>
                            <div class="col-md-9">
                                <?php echo form_input(['type'=>'text','name'=>'referral_code', 'value'=>set_value('referral_code'), 'id'=>'key','class'=>'container-sm']); ?>
                                
                            </div>
                            <div class="col-md-3 mt-5" > 
                                <strong class="right_sre">USER Mobile Number</strong>
                            </div>
                            <div class="col-md-9">
                                <?php echo form_input(['type'=>'text','name'=>'mobile', 'value'=>set_value('mobile'), 'id'=>'key','class'=>'container-sm', 'minlength'=>'10', 'maxlength'=>'10' ]); ?>                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center cust-addbull"> 
                         <input type="submit" name="submit" class="btn btn-primary" style="margin-bottom: 20px;" id="submit" value="Upgrade">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
