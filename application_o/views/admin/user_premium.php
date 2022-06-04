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
        <?php echo form_open_multipart("admin/user_update_premium/");?>
            <?php //print_r($_SESSION['user_id']); ?>
            <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                    <diV class="col-md-3"></div>
                    <div class="col-md-9 corm_nmset">
                        <div class=" error" style="margin-left:0%;">
                            <?= $error ?>
                        </div>
                    </div>
            <?php } ?>
            <?php $pack = $this->load->api_model->premium_package($id, $users_id='');
              // print_r($pack);
              
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger2 box-primary">
                        <div class="col-md-12 text-center cust-addbull">
                            <label class="form-control form-control-lg">&#8377; <?= $pack[0]['promo_balance']?></label>
                            <input type="hidden" name="package_id" value="<?= $pack[0]['id']?>">
                            <input type="hidden" name="package_price" value="<?= $pack[0]['price']?>">
                            <input type="hidden" name="promo_balance" value="<?= $pack[0]['promo_balance']?>">
                            <input type="hidden" name="ai_promo_balance" value="<?= $pack[0]['ai_promo_balance']?>">
                            <input type="hidden" name="users_id" value="<?= $_SESSION['user_id']?>">
                        </div>
                        <div>
                            <label> User Mobile Number </label>
                            <input type="text" name="mobile" class="form-control form-control-lg" placeholder="Mobile Number" value="<?php echo set_value('mobile'); ?>" required/>
                        </div>  
                        <label>Select package</label>                      
                        <select  name="package_id" class="form-control form-control-lg" required>
                        <option value="">select Package</option>
                            <?php foreach($pack as $p){?>
                                <option value="<?= $p['id']?>"><?= $p['name']?></option>
                            <?php }?>
                        </select>
                        <?php $referred_by = $this->api_model->get_data('type IN ("37","38")', 'admin', '', 'admin_id, referral_code as refral_code, CONCAT(CONCAT(fname," "), lname) as user_name');
                        //print_r($referred_by);
                        ?>
                        <label > Referred By </label>
                        <select  class="form-control" name="admin_id">
                        <option value=" "> Select Referred By</option>
                        <?php foreach ($referred_by as $rb){?>
                            
                            <option value="<?= $rb['admin_id']?>"><?= $rb['user_name']?>(#<?= $rb['refral_code']?>)</option>
                        <?php }?>
                        </select>                        
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
