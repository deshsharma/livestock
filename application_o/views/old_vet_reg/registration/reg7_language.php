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
              <p><span class="step-counter">05</span><span class="nomob"> Bank Details</span></p>
            </div>
            <div class="stepsec">
              <p class="blue1"><span class="step-counter-activ">06</span><span class="nomob"> Select Language</span></p>
            </div>
          </div>
      <div class="col-md-8">
        <div class="form-Title text-center">
          <!-- <h3 class="mt-3">Select Language</h3> -->
          <h4 class="mt-3">I can communicate in the following languages(You can select multiple)</h4>
        </div>
        <div class="form-Content">
          <div class="page-content">
    <div class="form-v10-content">
      <form class="form-detail" method="POST" id="myform">
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
                <div class="forcheck w-100">
                    <?php echo form_error('checkbox1'); ?>                   
					<?php 
						$language = $this->api_model->get_data('', 'prefered_lang', '', '');
						//print_r($language);
						foreach($language as $lang){ ?>
						 <div class="form-checkbox">
							<label class="container"><p><?= $lang['lang_name']?></p>
								<input type="checkbox" name="checkbox1[]" value="<?= $lang['lang_id'] ?>">
								<span class="checkmark"></span>
							</label>
						</div>
					<?php }?>
              </div>  
          </div>

               <div class="row reg">
      <div class="col-12">
        <button name="submit" value="1" class="btn btn-primary btn-style2">Submit</button> 
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