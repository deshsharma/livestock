<div class="container">
      <div class="formTotal">
        <div class="row">
          <div class="col-md-4 col-12 stepsecbg">
              <div class="stepsec">
              <p class=""><span class="step-counter">01</span><span class="nomob"> Basic Information</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">02</span><span class="nomob"> Educational Qualification</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">03</span><span class="nomob"> Experience</span></p>
            </div>
            <div class="stepsec">
              <p class="blue1"><span class="step-counter-activ">04</span><span class="nomob"> Registration Details</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">05</span><span class="nomob"> Bank Details</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">06</span><span class="nomob"> Select Language</span></p>
            </div>
          </div>
      <div class="col-md-8">
        <div class="form-Title text-center">
          <h3 class="mt-3">Veterinary Council of India Registration Details</h3>
          <!-- <p>Please enter your registration details and proceed to next form</p> -->
        </div>
        <div class="form-Content">
          <div class="page-content">
            <div class="form-v10-content">
              <form class="form-detail"  method="POST" id="myform">
                <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                    <diV class="col-md-3"></div>
                    <div class="col-md-9 corm_nmset">
                        <div class=" error" style="margin-left: 22%;color:#ec0606;">
                            <?= $error ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-left">
                    <div class="form-row">
                      <?php echo form_error('regisration_number'); ?>
                      <input value="<?php echo $regisration_number ?>" type="text" name="regisration_number" id="regisration_number" class="input-text" placeholder="Registration Number" required>
                    </div>
                    <div class="form-row">
                      <?php echo form_error('regisration_council'); ?>
                      <input value="<?php echo $regisration_number ?>" type="text" name="regisration_council" id="regisration_council" class="input-text" placeholder=" State" required>
                    </div>
                  
                      <div class="form-row">
                          <?php echo form_error('year_registration'); ?>
                          <select name="year_registration" id="year_registration" required>
                          <option value="">Year</option>
                            <?php 
                            foreach($years as $year){ ?>
                              <option <?php if($year_registration == $year) echo"selected"; ?> value="<?= $year ?>"><?= $year ?></option>
                            <?php } ?>
                          </select>
                          <span class="select-btn">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                          </span>
                      </div>
	
                      <div class="form-checkbox" style="width: 100%">
                        <label class="container"><div class="msg blue1">Skip it, I will update it later</div>
                            <input  <?php if($telephonicConsult == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult">
                            <span class="checkmark"></span>
                        </label>
                      </div>

                      <div class="row reg">
                        <div class="col-12">
                          <button name="submit" value="1" class="btn btn-primary btn-style2">Next</button> 
                        </div>
                      </div>  
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>    
  </div>
  </div>

  <div class="form-details">
    
  </div>

<?php include('footer.php'); ?>
<script type="text/javascript">
  $('#telephonicConsult').click(function(){
    if($('#telephonicConsult').checked){
      $('#regisration_number').attr('required');
      $('#regisration_council').attr('required');
      $('#year_registration').attr('required');
    }else{
      $('#regisration_number').removeAttr('required');
      $('#regisration_council').removeAttr('required');
      $('#year_registration').removeAttr('required');
    }
  });
</script>