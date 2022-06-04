<style type="text/css">
#partitioned{
  padding-left: 15px;
  letter-spacing: 45px;
  border: 0;
  background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
  background-position: bottom;
  background-size: 56px 1px;
  background-repeat: repeat-x;
  background-position-x: 35px;
  width: 300px;  
}
.custom-file-label_re{
  transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}
.input-group > .custom-file_re {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    position: relative;
    -ms-flex: 1 1 auto;
    height: calc(1.5em + 0.75rem + 2px);
    flex: 1 1 auto;
    width: 1%;
    margin-bottom: 0;
    color: #7c7c7c;

}
.custom-file-label_re::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    display: block;
    height: calc(1.5em + 0.75rem);
    padding: 0.375rem 0.75rem;
    line-height: 1.5;
    color: #495057;
    content: "Browse";
    background-color: #e9ecef;
    border-left: inherit;
    border-radius: 0 0.25rem 0.25rem 0;
}

 </style>   
    <div class="container">
      <div class="formTotal">
        <div class="row">
          <div class="col-md-4 col-12 stepsecbg">
              <div class="stepsec">
                <p class="blue1"><span class="step-counter-activ">01</span><span class="nomob"> Basic Information</span></p>
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
                <p><span class="step-counter">06</span><span class="nomob"> Select Language</span></p>
              </div>
            </div>
              <div class="col-md-8 col-12">
                <div class="form-Title text-center">
                  <h3 class="mt-3">Basic Details</h3>
                  <!-- <p>Please enter your Personal Information and proceed to next form</p> -->
                </div>
                <div class="form-Content">
                <div class="page-content">
                  <div class="form-v10-content">
                    <form class="form-detail" method="POST" id="myform" enctype="multipart/form-data">
                        <div class="form-left">
                           <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                              <diV class="col-md-3">
                            </div>
                            <div class="col-md-9 corm_nmset">
                              <div class=" error" style="margin-left: 22%;color:#ec0606;">
                                <?= $error ?>
                              </div>
                            </div>
                           <?php } ?>
                          <div class="container animated bounce image-width-view">
                            <div class="alert"></div>
                                <div id='img_container' class='image-size-view'>
                                    <img id="preview" class="image-preview" src="https://webdevtrick.com/wp-content/uploads/preview-img.jpg" alt="your image" title=''/>
                                </div> 
                                <div class="input-group"> 
                                  <div class="custom-file">
                                      <input type="file" name="profile_image" id="profile_image" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01" required>
                                      <label class="custom-file-label" for="profile_image">UPLOAD PHOTO</label>
                                  </div>
                                </div>
                          </div>
                          <div class="form-row">
                            <?php echo form_error('first_name'); ?>
                            <input value="<?php echo $first_name ?>" type="text"  name="first_name" id="first_name" class="input-text" placeholder="Full Name" required>
                          </div>
                          <div class="form-row">
                              <?php echo form_error('options'); ?>
                              <?php 
                              if(empty($gender)) {
                                $gender = 'Male';
                              }
                              ?>
                              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                              <label class="btn btn-secondary <?php if($gender == 'Male') echo 'active'; ?>">
                                <input <?php if($gender == 'Male') echo "checked"; ?> type="radio" name="options" id="option2" value="Male" autocomplete="off"> Male
                              </label>
                              <label class="btn btn-secondary <?php if($gender == 'Female') echo 'active'; ?>">
                                <input <?php if($gender == 'Female') echo "checked"; ?> type="radio" name="options" id="option3" value="Female"  autocomplete="off"> Female
                              </label>
                            </div>
                         </div> 
                        <div class="form-row">
                          <?php echo form_error('your_email'); ?>
                          <input value="<?php echo $your_email ?>" type="text" name="your_email" id="your_email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                          <div class="form-row form-row-1">
                            <?php echo form_error('code'); ?>
                            <input type="text" value="+91" name="code" class="code" id="code" placeholder="Code +" required readonly="">
                          </div>
                          <div class="form-row form-row-2">
                            <!-- <?php echo form_error('phone'); ?> -->
                            <input type="hidden" name="mobile" value="<?= isset($mobile) ? $mobile : $_REQUEST['mobile'] ?>">
                            <input type="text" value="<?= isset($mobile) ? $mobile : $_REQUEST['mobile'] ?>" type="text" maxlength="10" minlength="10" pattern="[0-9]{10}" name="mobile" class="mobile" id="phone" placeholder="Phone Number"  disabled >
                          </div>
                        </div>
                         <div class="form-row">
                              <?php echo form_error('state'); ?>
                              <?php $state1 = $this->api_model->get_state("99");  ?>
                              <select name="state" id="state" required>
                              <option value="">State</option>
                                <?php 
                                foreach($state1 as $st){ ?>
                                  <option <?php if($state == $st['name']) echo"selected"; ?> value="<?= $st['name'] ?>"><?= $st['name'] ?></option>
                                <?php } ?>
                              </select>
                              <span class="select-btn">
                                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                              </span>
                          </div>
                        <div class="form-group">
                          <div class="form-row form-row-1">
                            <?php echo form_error('pincode'); ?>
                            <input maxlength="6" minlength="4" pattern=".{4,9}" value="<?php echo $pincode ?>" type="text" name="pincode" class="zip" id="pincode" placeholder="Pin Code" required>
                          </div>
                          <div class="form-row form-row-2">
                            <?php echo form_error('place'); ?>
                            <input value="<?php echo $address ?>" type="text" name="place" class="additional" id="place" placeholder="City/Town" required>
                              
                          </div>
                      </div>
                      <div class="form-row">
                        <?php echo form_error('address'); ?>
                        <input value="<?php echo $address ?>" type="text" name="address" class="additional" id="address" placeholder="Address" required>
                      </div>
                      <p class="msg">Passcode.</p>
                      <div class="form-row form-row-1">
                        <input id="partitioned" name="passcode" value="<?php echo $passcode ?>" class="confirm_passcode" name="passcode" type="text" maxlength="4" />
                          </div>
                      <p class="msg">Confrom Passcode.</p>
                      <div class="form-row form-row-1">
                        <input id="partitioned" name="confirm_passcode" value="<?php echo $passcode ?>" name="confirm_passcode" class="confirm_passcode" type="text" maxlength="4"/>
                         
                      </div>
                      <div class="form-group">
                          <div class="form-row form-row-1">
                            <?php echo form_error('adhar'); ?>
                            <input value="<?php echo $adhar ?>" type="text" maxlength="12" minlength="12" pattern="[0-9]{12}" name="adhar" class="additional" id="adhar" placeholder="Aadhar Number" required>
                          </div>
                          <div class="form-row form-row-2">
                            <!-- <input type="file" id="aadharcar_image" name="aadharcar_image" class="" /> -->
                           <div class="custom-file">
                                    <input type="file" name="profile_image" id="profile_image_re" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01" required="">
                                    <label class="custom-file-label_re" for="profile_image">UPLOAD PHOTO</label>
                                </div>
                          </div>
                      </div>
                     <div class="form-checkbox" style="width:100%;margin-left:10px;">
                        <label class="container"><div class="msg blue1">I shall be available for Telephonic Consultation to users of Livestoc.</div>
                            <input onchange="telephonicConsultNew();" <?php if($telephonicConsult == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult" value="1">
                            <span class="checkmark"></span>
                        </label>
                      </div>
                      <div id="newchanges" style="display: none;" class="form-row" style="width: 100%;margin-left:20px!important;">
                      <label class="container"><div class="msg1 blue1" style="margin-left:16px;margin-top:-18px;">My fee for the telephonic consultation shall be  ₹
                        <input type="text" maxlength="3" name="telephonicConsultText" pattern="{0-9}" class="col-2" placeholder="" style="">per minute.
                      </div> 
                            <label class="container"><div class="msg1 blue1" >I authorise Livestoc (Amaze Brandlance Private Limited) to deduct 50% of the same as convenience fee.</div>
                      </div>
                      <!--Second Value---->
                      <div class="form-checkbox" style="width:100%;margin-left:10px;">
                        <label class="container"><div class="msg blue1">I shall be available for home visit to users of Livestoc.</div>
                            <input onchange="homeVisitChangesNew();" <?php if($homeVisit == '1') { echo "checked='checked'"; } ?> type="checkbox" name="homeVisit" id="homeVisit" value="1">
                            <span class="checkmark"></span>
                        </label>
                      </div>
                      <div id="homeVisitChanges" style="display: none;" class="form-row" style="width: 100%;margin-left:20px!important;">
                       <label class="container"><div class="msg1 blue1" style="margin-left:16px;margin-top:-18px;">My fee for the home visit shall be ₹ <input type="text" name="homeVisitChangesText" maxlength="3" class="col-2" placeholder="" id="homeVisitChangesText" style=""></div>
                          <label class="container"><div class="msg1 blue1">I authorise Livestoc (Amaze Brandlance Private Limited) to deduct 25% of the same as convenience fee.</div>
                      </div>
                      <div class="row reg">
                        <div class="col-12">
                          <button name="submit" value="1" class="btn btn-primary btn-style2">Next</button> 
                        </div>
                      </div>  
                    </div>
               
              </form>
              <!--  <div class="col-md-8">      
              </div> -->
          </div>
        </div>
      </div>
    </div>    
  </div>
  </div>
</label>
</label>
</div>
  <div class="form-details">
    
  </div>

<?php include('footer_vetreg.php'); ?>
<script type="text/javascript">


  $(function () {
     $('input[type="file"]').change(function () {
          if ($(this).val() != "") {
                 $(this).css('color', '#333');
          }else{
                 $(this).css('color', 'transparent');
          }
     });
})


  $("#profile_image").change(function(event) {  
    RecurFadeIn();
    readURL(this);    
  });
  $("#profile_image").on('click',function(event){
    RecurFadeIn();
  });
  $("#profile_image_re").change(function(event) {  
    RecurFadeIn();
    readURL_r(this);    
  });
  $("#profile_image_re").on('click',function(event){
    RecurFadeIn();
  });
  function readURL(input) {    
    if (input.files && input.files[0]) {   
      var reader = new FileReader();
      var filename = $("#profile_image").val();
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
  function readURL_r(input) {    
    if (input.files && input.files[0]) {   
      var reader = new FileReader();
      var filename = $("#profile_image_re").val();
      filename = filename.substring(filename.lastIndexOf('\\')+1);
      reader.onload = function(e) {    
        $('.custom-file-label_re').text(filename);             
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
  /*function testing() {
    console.log('adasdasdasd');
    $('#newchanges').show();
  }*/
  function telephonicConsultNew() {
    var x = document.getElementById("newchanges");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
  }
  function homeVisitChangesNew() {
    var x = document.getElementById("homeVisitChanges");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
  }
</script>