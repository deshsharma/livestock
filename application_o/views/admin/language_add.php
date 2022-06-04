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
      <h1 class="mT40 mB40">Add Note</h12>
    </div>
  </div>

  <?php echo form_open_multipart("admin/add_note/");?>
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
                <div class="row">
                        <div class="form-group">
                        <?php echo form_error('name'); ?>
                        <label>Language Name.</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter ..." value="<?= $_POST['name'] ?>">
                        </div>
                </div>
                <div class="row">
                        <div class="form-group">
                        <?php echo form_error('code'); ?>
                        <label>Language Code.</label>
                        <input type="text" name="code" class="form-control" placeholder="Enter ..." value="<?= $_POST['code'] ?>">
                        </div>
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
