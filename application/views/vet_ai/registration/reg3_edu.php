
    <div class="container">
      <div class="formTotal">
        <div class="row">
          <div class="col-md-4 col-12 stepsecbg">
              <div class="stepsec">
              <p class=""><span class="step-counter">01</span><span class="nomob"> Basic Information</span></p>
            </div>
            <div class="stepsec">
              <p class="blue1"><span class="step-counter-activ">02</span><span class="nomob"> Educational Qualification</span></p>
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
              <p><span class="step-counter">06</span><span class="nomob"> Select Language</span></p>
            </div>
          </div>
      <div class="col-md-8">
        <div class="form-Title text-center">
          <h3 class="mt-3">Educational Qualification</h3>
          <!-- <p>Please enter your academic details and proceed to next form</p> -->
        </div>
        <div class="form-Content">
          <div class="page-content">
    <div class="form-v10-content">
      <form class="form-detail" method="POST" id="myform" enctype="multipart/form-data">
        <?php if( $error = $this->session->flashdata('add_bank')){ ?>
            <diV class="col-md-3"></div>
            <div class="col-md-9 corm_nmset">
                <div class=" error" style="margin-left: 22%;color:#ec0606;">
                    <?= $error ?>
                </div>
            </div>
        <?php } ?>
        <div class="form-left">
          <div id="0">
             <div class="form-row">
                <?php echo form_error('EDU'); ?>
                <select name="EDU" id="EDU" required>
                    <option value="">Educational Qualifications</option>
                    <option value="1">BVSC</option>
                    <option value="2">MVSC</option>
                    <option value="3">PHD</option>
                </select>
                <span class="select-btn">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
              </div>
            
            <div class="form-row">
              <?php echo form_error('institute'); ?>
              <input type="text" name="institute" class="additional" id="institute" placeholder="Institute" required>
            </div>

              <div class="form-row speci" style="display:none;">
                <?php echo form_error('specialization'); ?>
                  <select name="specialization" id="specialization" >
                    <option value="">Select Specialization</option>
                    <?php 
                      foreach($specialization as $special){ ?>
                          <option value="<?= $special['speci_id'] ?>"><?= $special['speci_name'] ?></option>
                      <?php } ?>
                  </select>
                <span class="select-btn">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
              </div>

             <!--  <div class="form-row">
                
                <select name="specialization" id="specialization" required>
                    <option value="place">Select Specialization</option>
                    <option value="Street">pathology/parasitology</option>
                    <option value="District">pathology/parasitology</option>
                    <option value="City">pathology/parasitology</option>
                </select>
                <span class="select-btn">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
              </div> -->
              <div class="form-row">
                  <?php echo form_error('yearCompletion'); ?>
                  <select name="yearCompletion" id="yearCompletion" required>
                  <option value="">Year of Completion</option>
                    <?php 
                    foreach($years as $year){ ?>
                      <option value="<?= $year ?>"><?= $year ?></option>
                    <?php } ?>
                  </select>
                  <span class="select-btn">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
              </div>

            <!-- <div class="form-row">
              
              <input type="text" name="educatonAdditional" class="additional" id="educatonAdditional" placeholder=" Documents" required>
              <button type="button" class="btn btn-light btn-style11">upload</button><button type="button" class="btn btn-light btn-style1">delete</button>
            </div> -->

            <div class="form-row">
                <?php echo form_error('documents'); ?>
                <!-- <input style="width: 250px;" type="text" name="educatonAdditional" class="additional" id="educatonAdditional" placeholder="Documents Description" required> -->
                <div class="custom-file" style="width: 272px">
                <!-- <input type="file" class="custom-file-input" id="documents" name="documents" required> -->
                  <input type="file" class="custom-file-input" id="documents" name="documents" required>
                  <label class="custom-file-label" for="documents">Upload Certificate</label>
                </div>
                <div class="custom-file" style="width: 100px; display: none;">
                    <button onclick="removeFile(0);" type="button" class="btn btn-light btn-style1">delete</button>
                </div>
            </div>
        </div>

          <div id="new_qualification"></div>

          <div class="form-row">
            <div class="custom-file">
              <button style="right: 3%;" id='addMore' type="button" class="btn btn-light btn-style1">Add Qualification</button>
            </div>
          </div>

          <div class="form-checkbox" style="width: 100%">
              <label class="container"><div class="msg blue1">Skip it, I will update it later</div>
                  <input  <?php if($telephonicConsult == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="skip" value="1">
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

<?php include('footer_vetreg.php'); ?>
<script type="text/javascript">
$("#EDU").change(function(){
  if($(this).val() == '1'){
    $(".speci").hide();
  }else{
    $(".speci").show();
  }
});
  $('#skip').click(function(){
    if($('#skip').checked){
      $('#EDU').attr('required');
      $('#institute').attr('required');
      //$('#specialization').attr('required');
      $('#yearCompletion').attr('required');
      $('#educatonAdditional').attr('required');
      $('#documents').attr('required');
    }else{
     // $('#institute').removeAttr('required');
       $('#EDU').removeAttr('required');
      $('#institute').removeAttr('required');
      //$('#specialization').removeAttr('required');
      $('#yearCompletion').removeAttr('required');
      $('#educatonAdditional').removeAttr('required');
      $('#documents').removeAttr('required');
    }
  });
  $("#documents").change(function(event) {  
    RecurFadeIn();
    readURL(this);    
  });
  $("#documents").on('click',function(event){
    RecurFadeIn();
  });
  function readURL(input) {    
    if (input.files && input.files[0]) {   
      var reader = new FileReader();
      var filename = $("#documents").val();
      filename = filename.substring(filename.lastIndexOf('\\')+1);
      reader.onload = function(e) {    
        $('#preview').attr('src', e.target.result);
        $('#preview').hide();
        $('#preview').fadeIn(500);      
        $('.custom-file-label').text(filename);             
      }
      reader.readAsDataURL(input.files[0]);    
    } 
    $(".alert").removeClass("loading").hide();
  }
  function RecurFadeIn(){ 
    console.log('ran');
    FadeInAlert("Wait for it...");  
  }
  function FadeInAlert(text){
    $(".alert").show();
    $(".alert").text(text).addClass("loading");  
  }
  
  var addValue = 0;
  function removeFile(indexValue) {
     console.log('removeFile');
     console.log(indexValue);
     if(indexValue > 0) {
        $('div#'+indexValue).remove();
        addValue = (addValue - 1);
      }
     /*$('.custom-file-label').empty();  
     $("#documents").empty();
     $('.custom-file-label').text('Upload');
     $('#educatonAdditional').val('');*/
  }

  $('#addMore').on("click", function(e){
      console.log('bbbbbbb');
      console.log($("select[id='EDU']").length);
      console.log('addValueaddValue');
      addValue = addValue + 1;
      var indeValue = addValue;
      console.log(addValue);
      if(indeValue < 4) {
        $('<div id="'+indeValue+'"><div class="form-row"><?php echo form_error('EDU'+indeValue); ?><select name="EDU'+indeValue+'" id="EDU'+indeValue+'" required><option value="">Educational Qualifications</option><option value="1">BVSC</option><option value="2">MVSC</option><option value="3">PHD</option></select><span class="select-btn"><i class="fa fa-angle-down" aria-hidden="true"></i></span></div><div class="form-row"><?php echo form_error('institute'+indeValue); ?><input type="text" name="institute'+indeValue+'" class="additional" id="institute'+indeValue+'" placeholder="Institute" required></div><div class="form-row"><?php echo form_error('specialization'); ?><select name="specialization'+indeValue+'" id="specialization'+indeValue+'" required><option value="">Select Specialization</option><?php foreach($specialization as $special){ ?><option value="<?= $special['speci_id'] ?>"><?= $special['speci_name'] ?></option> <?php } ?></select><span class="select-btn"><i class="fa fa-angle-down" aria-hidden="true"></i></span></div><div class="form-row"><?php echo form_error('yearCompletion'+indeValue); ?><select name="yearCompletion'+indeValue+'" id="yearCompletion'+indeValue+'" required><option value="">Year of Completion</option><?php foreach($years as $year){ ?><option value="<?= $year ?>"><?= $year ?></option> <?php } ?></select><span class="select-btn"><i class="fa fa-angle-down" aria-hidden="true"></i></span> </div><div class="form-row"><?php echo form_error('educatonAdditional'+indeValue);?>
                <div class="custom-file" style="width: 407px;margin-bottom: 23px;">  <input type="file" id="educaton_image'+indeValue+'" name="educaton_image'+indeValue+'" class="" /><button onclick="removeFile('+ indeValue +');" type="button" class="btn btn-light btn-style1" style="margin-right: -256px;">Remove</button></div></div>').insertBefore('#new_qualification');
        e.preventDefault();
    } else {
      addValue = 3;
    }
  });
</script>