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
              <p><span class="step-counter">04</span><span class="nomob"> Registration Details</span></p>
            </div>
            <div class="stepsec">
              <p  class="blue1"><span class="step-counter-activ">05</span><span class="nomob"> Bank Details</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">06</span><span class="nomob"> Select Language</span></p>
            </div>
          </div>
      <div class="col-md-8">
        <div class="form-Title text-center">
          <h3 class="mt-3">Bank Details</h3>
          <!-- <p>Please enter your bank details and proceed to next form</p> -->
        </div>
        <div class="form-Content">
          <div class="page-content">
              <div class="form-v10-content">
                <form class="form-detail"  method="POST" id="myform">
                  <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                      <diV class="col-md-3"></div>
                      <div class="col-md-9 corm_nmset">
                          <div class=" error" style="margin-left: 22%;color: #ec0606;">
                              <?= $error ?>
                          </div>
                      </div>
                  <?php } ?>
                  <div class="form-left">
                      <div class="form-row">
                        <?php echo form_error('acct_holder_name'); ?>
                        <input value="<?php echo $acct_holder_name ?>" type="text" name="acct_holder_name" id="acct_holder_name" class="input-text" placeholder="Account Holder Name" required>
                      </div>
                      <div class="form-row">
                        <?php echo form_error('acct_number'); ?>
                        <input value="<?php echo $acct_number ?>" type="text" name="acct_number" id="acct_number" class="input-text" placeholder="Account Number" required>
                      </div>
                      <div class="form-row">
                        <?php echo form_error('bank_name'); ?>
                        <input value="<?php echo $bank_name ?>" type="text" name="bank_name" id="bank_name" class="input-text" placeholder="Bank Name" required>
                      </div>
                      <div class="form-row">
                        <?php echo form_error('ifsc'); ?>
                        <input value="<?php echo $ifsc ?>" type="text" name="ifsc" id="ifsc" class="input-text" placeholder="IFSC Code" required>
                      </div>
                      <div class="form-row">
                        <?php echo form_error('branch_address'); ?>
                        <input value="<?php echo $branch_address ?>" type="text" name="branch_address" id="branch_address" class="input-text" placeholder="Branch Address" required>
                      </div>
                
                    <div class="form-checkbox" style="width: 100%">
                      <label class="container"><div class="msg blue1">Skip it, I will update it later</div>
                          <input  <?php if($telephonicConsult == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult" >
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

<?php include('footer_vetreg.php'); ?>
<script type="text/javascript">
  $('#telephonicConsult').click(function(){
    if($('#telephonicConsult').checked){
      $('#acct_holder_name').attr('required');
      $('#acct_number').attr('required');
      $('#bank_name').attr('required');
      $('#ifsc').attr('required');
      $('#branch_address').attr('required');
    }else{
      $('#acct_holder_name').removeAttr('required');
      $('#acct_number').removeAttr('required');
      $('#bank_name').removeAttr('required');
      $('#ifsc').removeAttr('required');
       $('#branch_address').removeAttr('required');
    }
  });
</script>