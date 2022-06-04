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
           <!--  <div class="stepsec">
              <p class="stepsec"><span class="step-counter">05</span><span class="nomob"> Council Registration Details</span></p>
            </div> -->
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
						<?php 
                            $council_year = $this->api_model->get_data('is_active = "1"', 'state', '', '');
                            //print_r($council_year);
                          ?>
						<select name="regisration_council" id="regisration_council" required>
                          <option value="">Veterinany Council</option>
                            <?php                            
                            foreach($council_year as $year){ ?>
							
                              <option <?php if($council_year == $year) echo"selected"; ?> value="<?= $year['state_name'] ?>"><?= $year['state_name'] ?> Veterinary Council</option>
                            <?php } ?>
                          </select>
					</div>
                  
                      <div class="form-row">
                          <?php echo form_error('year_registration'); ?>
                          <select name="year_registration" id="year_registration" required>
                          <option value="">Year of Registration</option>
                            <?php 
                            foreach($years as $year){ ?>
                              <option <?php if($year_registration == $year) echo"selected"; ?> value="<?= $year ?>"><?= $year ?></option>
                            <?php } ?>
                          </select>
                          <span class="select-btn">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                          </span>
                      </div>
                      <div class="form-row">
                          <div class="form-group ref2" style="text-align: center; display:none;">
                        <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                        </div>
                         <input data-required="image" type="file" name="animal_certificate" id="bull_certificate" class="image-input" data-traget-resolution="image_resolution" value="">
                        <input type="hidden" name="ani_certificate" id="animal_certificate" value="">
                        
                      </div>
                        <div class="form-Title text-center">
				          <h3 class="mt-5">State Registration Details</h3>
				        </div>
                      <div class="form-row mt-5">
                      <?php echo form_error('state_year_of_reg'); ?>
                      <input value="<?php echo $state_year_of_reg ?>" type="text" name="state_year_of_reg" id="regisration_number" class="input-text" placeholder="State Registration Number" required>
                    </div>
                    <div class="form-row">
						<?php 
                            $council_year = $this->api_model->get_data('status = "1" AND country_id = 99', 'zone', '', '');
							
                          ?>
						<select name="state_veterinary_council" id="state_veterinary_council" required>
                          <option value="">Veterinany Council</option>
                            <?php                            
                            foreach($council_year as $year){ ?>
                              <option <?php if($council_year == $year) echo"selected"; ?> value="<?= $year['zone_id'] ?>"><?= $year['name'] ?> Veterinary Council</option>
                            <?php } ?>
                          </select>
					</div>
                  
                      <div class="form-row">
                          <?php echo form_error('year_registration'); ?>
                          <select name="state_reg_number" id="year_registration" required>
                          <option value="">Year of Registration</option>
                            <?php 
                            foreach($years as $year){ ?>
                              <option <?php if($year_registration == $year) echo"selected"; ?> value="<?= $year ?>"><?= $year ?></option>
                            <?php } ?>
                          </select>
                          <span class="select-btn">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                          </span>
                      </div>
                      <div class="form-row">
                        <div class="form-group ref1" style="text-align: center; display:none;">
                        <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                        </div>
                        <input data-required="image" type="file"  id="bull_image" class="image-input" data-traget-resolution="image_resolution" value="">
                        <input type="hidden" name="animal_image" id="bull_photo" value="">
                      </div>
                    <!--   <div class="form-checkbox" style="width: 100%">
                        <label class="container"><div class="msg blue1">Skip it, I will update it later</div>
                            <input  <?php if($telephonicConsult == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult">
                            <span class="checkmark"></span>
                        </label>
                      </div> -->

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

$('#submit').click(function(e){
  if($('#animal_certificate').val() == ''){
    e.preventDefault();
    alert("Please Upload Animal Certificate Photo");
  }
});
  $('#submit').click(function(e){
  if($('#bull_photo').val() == ''){
    e.preventDefault();
    alert("Please Upload Photo");
  }
});
  $(document).ready(function() {
                $('#bull_image').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_image')[0].files[0].name);
                    var file_data = $('#bull_image').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref1').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#bull_photo').val(data.data);
                            $('.ref1').hide();
                        }
                    });
                });
});

$(document).ready(function() {
                $('#bull_certificate').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_certificate')[0].files[0].name);
                    var file_data = $('#bull_certificate').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref2').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#animal_certificate').val(data.data);
                            $('.ref2').hide();
                        }
                    });
                });
});
</script>