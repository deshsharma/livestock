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
                    <div class="form-checkbox">
                    <label class="container"><p>English</p>
                    <input type="checkbox" name="checkbox1[]" value="English">
                    <span class="checkmark"></span>
                    </label>
                    </div>
                  
                    <div class="form-checkbox">
                    <label class="container"><p>Hindi</p>
                    <input type="checkbox" name="checkbox1[]" value="Hindi">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Punjabi</p>
                    <input type="checkbox" name="checkbox1[]" value="Punjabi">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Haryanvi</p>
                    <input type="checkbox" name="checkbox1[]" value="Haryanvi">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Bengali</p>
                    <input type="checkbox" name="checkbox1[]" value="Bengali">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Telugu</p>
                    <input type="checkbox" name="checkbox1[]" value="Telugu">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Marathi</p>
                    <input type="checkbox" name="checkbox1[]" value="Marathi">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Tamil</p>
                    <input type="checkbox" name="checkbox1[]" value="Tamil">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Urdu</p>
                    <input type="checkbox" name="checkbox1[]" value="Urdu">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Gujarati</p>
                    <input type="checkbox" name="checkbox1[]" value="Gujarati">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Kannada</p>
                    <input type="checkbox" name="checkbox1[]" value="Kannada">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Malaylam</p>
                    <input type="checkbox" name="checkbox1[]" value="Malaylam">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Odia</p>
                    <input type="checkbox" name="checkbox1[]" value="Odia">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Assamese</p>
                    <input type="checkbox" name="checkbox1[]" value="Assamese">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Maithili</p>
                    <input type="checkbox" name="checkbox1[]" value="Maithili">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Bhili/Bhilodi</p>
                    <input type="checkbox" name="checkbox1[]" value="Bhili/Bhilodi">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Santali</p>
                    <input type="checkbox" name="checkbox1[]" value="Santali">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Kashmiri</p>
                    <input type="checkbox" name="checkbox1[]" value="Kashmiri">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Nepali</p>
                    <input type="checkbox" name="checkbox1[]" value="Nepali">
                    <span class="checkmark"></span>
                    </label>
                    </div>
                    <div class="form-checkbox">
                    <label class="container"><p>Gondi</p>
                    <input type="checkbox" name="checkbox1[]" value="Gondi">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Sindi</p>
                    <input type="checkbox" name="checkbox1[]" value="Sindi">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Konkani</p>
                    <input type="checkbox" name="checkbox1[]" value="Konkani">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Dogri</p>
                    <input type="checkbox" name="checkbox1[]" value="Dogri">
                    <span class="checkmark"></span>
                    </label>
                    </div>

                    <div class="form-checkbox">
                    <label class="container"><p>Khandeshi</p>
                    <input type="checkbox" name="checkbox1[]" value="Khandeshi">
                    <span class="checkmark"></span>
                    </label>
                    </div>

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

<?php include('footer_vetreg.php'); ?>