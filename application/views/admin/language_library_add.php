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
      <h1 class="mT40 mB40">Add Language Library</h12>
    </div>
  </div>

  <?php echo form_open_multipart("admin/language_library_add/");?>
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
              <!-- <h3 class="box-title">Enter the required information</h3> -->
            </div>  
            <div class="box-body">
                <!-- text input -->

                <?php echo form_error('language_id'); ?>
                <div class="col-md-3" > 
                 <strong class="right_sre">Language id</strong>
                </div>
                <div class="col-md-9">
                    <select name="language_id" id="language_id" class='ch_manset padd_set' required>
                        <option value="">Select Language</option>
                        <?php foreach($allLangues as $br) { ?>
                            <option value="<?= $br['id'] ?>"><?= $br['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <?php echo form_error('key'); ?>
                <div class="col-md-3" > 
                   <strong class="right_sre">Key</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'key', 'value'=>'', 'id'=>'key','class'=>'ch_manset padd_set']); ?>
                    <input type="hidden" name="id" value="<?php echo $details[0]['key']; ?>" >
                </div>

                <!-- <div class="col-md-3" > 
                   <strong class="right_sre">Code</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'code', 'value'=>'', 'id'=>'code','class'=>'ch_manset padd_set']); ?>
                    <input type="hidden" name="id" value="<?php echo $details[0]['code']; ?>" >
                </div> -->

                <?php echo form_error('description'); ?>
                <div class="col-md-3" > 
                   <strong class="right_sre">Description</strong>
                </div>

                <div class="col-md-9">
                    <textarea value=" <?php echo $details[0]['description'] ?>" class="form-control ch_manset padd_set" name="description" id="description" rows="3" placeholder="Description ..."><?php echo $details[0]['description'] ?></textarea>
                </div>

            </div>
          </div>
    <div class="row">
        <div class="col-md-12 text-center cust-addbull"> 
        <input type="submit" name="submit" class="btn btn-primary" style="margin-bottom: 20px;" id="submit" value="Submit">
    </div>
</div>

</div>
</div>
</form>
</div>
</div>
