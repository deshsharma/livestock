<style type="text/css">

#file_name {
  font-size: 13px;
}
.js .inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}
.hide1{
    display:none;
  }
#partitioned{
  padding-left: 15px;
  letter-spacing: 45px;
  border: 0;
  background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
  background-position: bottom;
  background-size: 56px 1px;
  background-repeat: repeat-x;
  background-position-x: 35px;
  width: 209px;  
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
          <div class="col-md-4 col-12 stepsecbg forcusttabs">
            <input type="hidden" name="stepsPage" id='stepsPage' value="<?php echo $this->session->userdata("steps"); ?>">
            <div class="stepsec">
              <a onclick="showNextMenu('basicinformation');" href="#basicinformation"><p class="blue1"><span class="step-counter-activ" id="basicinformationSelection" >01</span><span class="nomob"> Basic Information</span></p></a>
            </div>
            <div class="stepsec">
              <a onclick="showNextMenu('qualification');" href="#qualification"><p><span class="step-counter" id="qualificationSelection">02</span><span class="nomob"> Educational Qualification</span></p></a>
            </div>
            <div class="stepsec">
              <a onclick="showNextMenu('experience');" href="#experience"><p><span class="step-counter" id="experienceSelection">03</span><span class="nomob"> Experience</span></p></a>
            </div>
            <div class="stepsec">
              <a onclick="showNextMenu('registration');" href="#registration"><p><span class="step-counter" id="registrationSelection">04</span><span class="nomob"> Registration Details</span></p></a>
            </div>
            <div class="stepsec">
              <a onclick="showNextMenu('bankdetails');" href="#bankdetails"><p><span class="step-counter" id="bankdetailsSelection">05</span><span class="nomob"> Bank Details</span></p></a>
            </div>
            <div class="stepsec">
              <a onclick="showNextMenu('language');" href="#language"><p><span class="step-counter" id="languageSelection">06</span><span class="nomob"> Select Language</span></p></a>
            </div>
          </div>



        <div class="col-md-8 col-12 tab-content custom-product-edit" id="basicinformationMain">
            <div class="product-tab-list tab-pane active" id="basicinformation">
              <div class="form-Title text-center">
                <h3 class="mt-3">Basic Details</h3>
                <!-- <p>Please enter your Personal Information and proceed to next form</p> -->
              </div>
              <div class="form-Content">
                <div class="page-content">
                  <div class="form-v10-content" style="margin-top: 10px;">
                    <form class="form-detail" method="POST" id="myform" enctype="multipart/form-data">
                        <div class="form-left">
                           <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                              <diV class="col-md-3"></div>
                              <div class="col-md-9 corm_nmset">
                                  <div class=" error" style="margin-left: 22%;color:#ec0606;">
                                      <?= $error ?>
                                  </div>
                              </div>
                           <?php } ?>

                          <div class="container animated bounce image-width-view">
                            <div class="alert"></div>
                                <div id='img_container' class='image-size-view'>
                                  <?php if($profileimage!='') { ?>
                                    <img id="preview" class="image-preview" src="<?= base_url() ?>harpahu_merge/uploads/doc/<?php echo $profileimage?>" alt="your image" title=''/>
                                  <?php } else { ?>
                                    <img id="preview" class="image-preview" src="https://webdevtrick.com/wp-content/uploads/preview-img.jpg" alt="your image" title=''/>
                                  <?php } ?>
                                </div> 
                                  <input type="hidden" name="image_name" id="image_name" value="<?php echo $profileimage ?>">
                                  <div class="box js">
                                    <?php if($profileimage!='') { ?>
                                      <input oninvalid="InvalidMsg(this, 'Profile Image');" oninput="InvalidMsg(this, 'Profile Image');" type="file" name="profile_image" id="profile_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                                    <?php } else { ?> 
                                       <input oninvalid="InvalidMsg(this, 'Profile Image');" oninput="InvalidMsg(this, 'Profile Image');" type="file" name="profile_image" id="profile_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" required />
                                    <?php } ?>

                                      <label for="profile_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="file_name">Upload Authorization Letter&hellip;</span></label>
                                    </div>
   
                                <!-- <div class="input-group"> 
                                  <div class="custom-file">
                                      <input oninvalid="InvalidMsg(this, 'Profile Image');" oninput="InvalidMsg(this, 'Profile Image');" type="file" name="profile_image" id="profile_image" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01" required>
                                      <label class="custom-file-label" for="profile_image">UPLOAD PHOTO</label>
                                  </div>
                                </div> -->
                          </div>

                          <div class="form-row">
                            <?php echo form_error('first_name'); ?>
                            <input oninvalid="InvalidMsg(this, 'Full Name');" oninput="InvalidMsg(this, 'Full Name');"  value="<?php echo $first_name ?>" type="text"  name="first_name" id="first_name" class="input-text" placeholder="Full Name" required>
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
                          <input oninvalid="InvalidMsg(this, 'Email Address');" oninput="InvalidMsg(this, 'Email Address');" value="<?php echo $your_email ?>" type="text" name="your_email" id="your_email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                          <div class="form-row form-row-1">
                            <?php echo form_error('code'); ?>
                            <input  type="text" value="+91" name="code" class="code" id="code" placeholder="Code +" required readonly="">
                          </div>
                          <div class="form-row form-row-2">
                          
                          <!-- <input type="text" value="<?php echo $mobile ?>" maxlength="10" minlength="10" pattern="[0-9]{10}" name="mobile" class="mobile" id="phone" placeholder="Phone Number" > -->


                          <input type="hidden" name="mobile" value="<?= isset($mobile) ? $mobile : $_REQUEST['mobile'] ?>">
                          <input type="text" value="<?= isset($mobile) ? $mobile : $_REQUEST['mobile'] ?>" type="text" maxlength="10" minlength="10" pattern="[0-9]{10}" name="mobile" class="mobile" id="phone" placeholder="Mobile No"  disabled>

                          </div>


                        </div>
                         <div class="form-row">
                              <?php echo form_error('state'); ?>
                              <?php $state1 = $this->api_model->get_state("99");  ?>
                              <select oninvalid="InvalidMsg(this, 'Sate');" oninput="InvalidMsg(this, 'State');" name="state" id="state" required>
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
                              <input oninvalid="InvalidMsg(this, 'Pin Code');" oninput="InvalidMsg(this, 'Pin Code');"  maxlength="6" minlength="4" pattern=".{4,9}" value="<?php echo $pincode ?>" type="text" name="pincode" class="zip" id="pincode" placeholder="Pin Code" required>
                            </div>
                            <div class="form-row form-row-2">
                              <?php echo form_error('place'); ?>
                              <input oninvalid="InvalidMsg(this, 'City/Town');" oninput="InvalidMsg(this, 'City/Town');" value="<?php echo $address ?>" type="text" name="place" class="additional" id="place" placeholder="City/Town" required>
                                 <!--  <select name="place" id="place" required>
                                  <option value="">Select Place</option>
                                  <option <?php if($place == 'Street') echo"selected"; ?>  value="Street">Street</option>
                                  <option <?php if($place == 'District') echo"selected"; ?>  value="District">District</option>
                                  <option <?php if($place == 'City') echo "selected"; ?>  value="City">City</option>
                              </select> -->
                             <!--  <span class="select-btn right">
                                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                              </span> -->
                            </div>
                        </div>
                        <div class="form-row">
                          <?php echo form_error('address'); ?>
                          <input oninvalid="InvalidMsg(this, 'Address');" oninput="InvalidMsg(this, 'Address');" value="<?php echo $address ?>" type="text" name="address" class="additional" id="address" placeholder="Address" required>
                        </div>
                        <p class="msg">Passcode</p>
                        <div class="form-row form-row-1">
                          <div id="divOuter1" class="mobile">
                              <div id="divInner1">
                              <input style="padding-left: 0px !important;letter-spacing: 39px;" id="partitioned" name="passcode" value="<?php echo $passcode ?>"  name="passcode" type="text" maxlength="4" />
                            </div>
                          </div>
                           <!--  <?php echo form_error('passcode'); ?>
                            <input value="<?php echo $passcode ?>" autocomplete="off" type="password"  maxlength="4" minlength="4" pattern="[0-9]{4}" name="passcode" class="zip" id="passcode" placeholder="Passcode" required> -->
                        </div>
                        <p class="msg">Confirm Passcode</p>
                        <div class="form-row form-row-1">
                          <input style="padding-left: 0px !important;letter-spacing: 39px;" id="partitioned" name="confirm_passcode" value="<?php echo $passcode ?>" name="confirm_passcode"  type="text" maxlength="4"/>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-row form-row-1">
                              <?php echo form_error('adhar'); ?>
                              <input oninvalid="InvalidMsg(this, 'Aadhar Number');" oninput="InvalidMsg(this, 'Aadhar Number');" value="<?php echo $adhar ?>" type="text" maxlength="12" minlength="12" pattern="[0-9]{12}" name="adhar" class="additional" id="adhar" placeholder="Aadhar Number" required>
                            </div>
                            <div class="form-row form-row-2">
          
                             <div class="custom-file">
                                  <input type="hidden" name="aadharcar_name" id="aadharcar_name" value="<?php echo $addarcardimage ?>">
                                  <div class="box js">
                                  
                                  <input oninvalid="InvalidMsg(this, 'adhar Image');" oninput="InvalidMsg(this, 'adhar Image');" type="file" name="aadharcar_image" id="aadharcar_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                                  
                                    <label for="aadharcar_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                      <span id="file_name_aadharcar">UPLOAD PHOTO</span></label>
                                  </div>
                                  
                                  <!-- 
                                  <input type="file" name="aadharcar_image" id="aadharcar_image" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label_re" for="profile_image">UPLOAD PHOTO</label>
                                   -->

                              </div>
                            </div>
                        </div>

                        <!-- <div class="form-row">
                            <select name="telephonicConsult" id="telephonicConsult" required>
                                <option value="place">Online/Telephonic Consultation Fees</option>
                                <option value="200">Rs100 - Rs200</option>
                                <option value="400">Rs200 - Rs400</option>
                                <option value="600">Rs400 - Rs600</option>
                            </select>
                            <span class="select-btn">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="msg blue1">We will deduct 20% as convenience fee.</div> -->
                       <div class="form-checkbox" style="width:100%;margin-left:10px;">
                          <label class="container"><div class="msg blue1">I shall be available for Telephonic Consultation to users of Livestoc.</div>
                              <input onchange="telephonicConsultNew();" <?php if($telephonicConsult == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult" value="1">
                              <span class="checkmark"></span>
                          </label>
                        </div>

                        <div id="newchanges" style="width: 100%;margin-left:20px!important;<?php if($telephonicConsult != '1') { echo "display:none"; } ?>" class="form-row">
                        <label class="container">

                        <div class="msg1 blue1" style="margin-top:-18px;">My fee for the telephonic consultation shall be  ₹
                          <input oninvalid="InvalidMsg(this, 'fee for the telephonic consultation');" oninput="InvalidMsg(this, 'fee for the telephonic consultation');" type="intiger" id="telephonicConsultText" name="telephonicConsultText" maxlength="3" minlength="1" class="col-2" placeholder="" value="<?php echo $telephonicConsultText; ?>">
                          per minute.
                        </div>
                              <label class="container"><div class="msg1 blue1" >I authorise Livestoc (Amaze Brandlance Private Limited) to deduct 50% of the same as convenience fee.</div></label>
                          </label>
                        </div>
                     

                        <!--Second Value---->
                        <div class="form-checkbox" style="width:100%;margin-left:10px;">
                          <label class="container"><div class="msg blue1">I shall be available for home visit to users of Livestoc.</div>
                              <input onchange="homeVisitChangesNew();" <?php if($homeVisit == '1') { echo "checked='checked'"; } ?> type="checkbox" name="homeVisit" id="homeVisit" value="1">
                              <span class="checkmark"></span>
                          </label>
                        </div>

                         <div id="homeVisitChanges" style="width: 100%;margin-left:20px!important;<?php if($homeVisit  != '1') { echo "display:none"; } ?>" class="form-row">
                         <label class="container"><div class="msg1 blue1" style="margin-left:16px;margin-top:-18px;">My fee for the home visit shall be ₹ <input oninvalid="InvalidMsg(this, 'fee for the home visit');" oninput="InvalidMsg(this, 'fee for the home visit');" type="intiger" name="homeVisitChangesText" maxlength="3" minlength="1" class="col-2" placeholder="" id="homeVisitChangesText"  value="<?php echo $homeVisitChangesText; ?>"></div>

                            <label class="container"><div class="msg1 blue1">I authorise Livestoc (Amaze Brandlance Private Limited) to deduct 25% of the same as convenience fee.</div>
                            </label>
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
       


    
             <div class="col-md-8 col-12 tab-content custom-product-edit" id="qualificationMain">
                <div class="product-tab-list tab-pane active" id="qualification">
                    <div class="form-Title text-center">
                      <h3 class="mt-3">Educational Qualification</h3>
                      <!-- <p>Please enter your academic details and proceed to next form</p> -->
                    </div>
                    <div class="form-Content">
                      <div class="page-content">
                      <div class="form-v10-content">
                        <form class="form-detail" method="POST" id="myform" enctype="multipart/form-data" action="<?= base_url() ?>vetreg/reg3_edu">
                          <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                              <diV class="col-md-3"></div>
                              <div class="col-md-9 corm_nmset">
                                  <div class=" error" style="margin-left: 22%;color:#ec0606;">
                                      <?= $error ?>
                                  </div>
                              </div>
                          <?php } ?>
                          <div class="form-left">
                            <?php 
                            $fullValuesEdu = $this->session->userdata("reg3_edu"); 
                            //echo "<pre>....";
                            //print_r($fullValuesEdu);
                            if($fullValuesEdu['EDU']) { ?>
                                <input type="hidden" name="nameEduCount" id="nameEduCount" value="<?php count($fullValuesEdu) - 8; ?>">
                            <?php 
                            $loopForArray = 0;
                            for($i=0;$i < 3; $i++) { 
                                if($i > 0) {
                                    $educatonimage = $fullValuesEdu[$loopForArray]['educatonimage'.$i];
                                    $EDU = $fullValuesEdu[$loopForArray]['EDU'.$i];
                                    $institute = $fullValuesEdu[$loopForArray]['institute'.$i];
                                    $yearCompletion = $fullValuesEdu[$loopForArray]['yearCompletion'.$i];
                                    $educatonAdditional = $fullValuesEdu[$loopForArray]['educatonAdditional'.$i];
                                    $specialization1 = $fullValuesEdu[$loopForArray]['specialization'.$i];
                                    $loopForArray = $loopForArray + 1;
                                } else {
                                    $educatonimage = $fullValuesEdu[$i]['educatonimage'];
                                    $EDU = $fullValuesEdu['EDU'];
                                    $institute = $fullValuesEdu['institute'];
                                    $yearCompletion = $fullValuesEdu['yearCompletion'];
                                    $educatonAdditional = $fullValuesEdu['educatonAdditional'];
                                    $specialization1 = $fullValuesEdu['specialization'];
                                }
                                if(!empty($institute)) { ?>
                                  <div id="<?php echo $i; ?>">
                                     <div class="form-row">
                                        <?php echo form_error('EDU'); ?>
                                        <select oninvalid="InvalidMsg(this, 'Educational Qualifications');" oninput="InvalidMsg(this, 'Educational Qualifications');" name="EDU" id="EDU" required>
                                            <option value="">Educational Qualifications</option>
                                            <option <?php if($EDU == 1) echo"selected"; ?> value="1">BVSC</option>
                                            <option <?php if($EDU == 2) echo"selected"; ?> value="2">MVSC</option>
                                            <option <?php if($EDU == 3) echo"selected"; ?> value="3">PHD</option>
                                        </select>
                                        <span class="select-btn">
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                      </div>
                                    
                                    <div class="form-row">
                                      <?php echo form_error('institute'); ?>
                                      <input oninvalid="InvalidMsg(this, 'Institute');" oninput="InvalidMsg(this, 'Institute');" type="text" name="institute" class="additional" id="institute" placeholder="Institute" required value="<?php echo $institute; ?>">
                                    </div>

                                      <div class="form-row speci" style="display:none;">
                                        <?php echo form_error('specialization'); ?>
                                          <select name="specialization" id="specialization" >
                                            <option value="">Select Specialization</option>
                                            <?php 
                                              foreach($specialization as $special){ ?>
                                                  <option <?php if($specialization1 == $special['speci_id']) echo"selected"; ?>  value="<?= $special['speci_id'] ?>"><?= $special['speci_name'] ?></option>
                                              <?php } ?>
                                          </select>
                                        <span class="select-btn">
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                      </div>

                                      <div class="form-row">
                                          <?php echo form_error('yearCompletion'); ?>
                                          <select  oninvalid="InvalidMsg(this, 'Year of Completion');" oninput="InvalidMsg(this, 'Year of Completion');" name="yearCompletion" id="yearCompletion" required>
                                          <option value="">Year of Completion</option>
                                            <?php 
                                            foreach($years as $year){ ?>
                                              <option <?php if($yearCompletion == $year) echo"selected"; ?> value="<?= $year ?>"><?= $year ?></option>
                                            <?php } ?>
                                          </select>
                                          <span class="select-btn">
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                          </span>
                                      </div>

                                    <?php if($i == 0) { ?>
                                      <!-- <div class="form-row">
                                          <?php echo form_error('documents'); ?>
                                          <div class="custom-file" style="width: 272px">
                                            <input oninvalid="InvalidMsg(this, 'Certificate');" oninput="InvalidMsg(this, 'Certificate');" type="file" class="custom-file-input" id="documents" name="documents" required src="<?php echo $educatonimage; ?>">
                                            <label class="custom-file-label" for="documents">Upload Certificate</label>
                                          </div>
                                          <div class="custom-file" style="width: 100px; display: none;">
                                              <button onclick="removeFile(0);" type="button" class="btn btn-light btn-style1">delete</button>
                                          </div>
                                      </div> -->

                                      <div class="form-row">
                                        <?php echo form_error('documents'); ?>
                                        <div class="custom-file">
                                            <input type="hidden" name="documents_name" id="documents_name" value="<?php echo $educatonimage ?>">
                                            <div class="box js">

                                          <?php if($educatonimage!='') { ?>
                                            <input oninvalid="InvalidMsg(this, 'Certificate');" oninput="InvalidMsg(this, 'Certificate');" type="file" name="documents_image" id="documents_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"/>
                                          <?php } else { ?> 
                                            <input oninvalid="InvalidMsg(this, 'Certificate');" oninput="InvalidMsg(this, 'Certificate');" type="file" name="documents_image" id="documents_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" required/>
                                          <?php } ?>

                                            
                                              <label for="documents_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                                <span id="file_name_documents">Upload Certificate</span></label>
                                            </div>
                              
                                      </div>
                                    </div>

                                    <?php } else { ?>
                                      <!-- <div class="form-row">
                                          <?php echo form_error('educatonAdditional'.$i);?>
                                          <div class="custom-file" style="width: 407px;margin-bottom: 23px;">  
                                            <input type="file" id="educaton_image<?php echo $i; ?>" name="educaton_image<?php echo $i; ?>" class="" />
                                            <button onclick="removeFile(<?php echo $i; ?>);" type="button" class="btn btn-light btn-style1" style="margin-right: -256px;">Remove</button>
                                        </div>
                                      </div> -->
                                      <div class="form-row">
                                        <?php echo form_error('educatonAdditional'.$i); ?>
                                        <div class="custom-file">
                                            <input type="hidden" name="educaton_name<?php echo $i ?>" id="educaton_name<?php echo $i ?>" value="<?php echo $educatonimage ?>">
                                            <div class="box js">

                                            <input oninvalid="InvalidMsg(this, 'Upload');" oninput="InvalidMsg(this, 'Upload');" type="file" name="educaton_image<?php echo $i ?>" id="educaton_image<?php echo $i ?>" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"/>
                                            
                                              <label for="educaton_image<?php echo $i ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                                <span id="file_name_educaton<?php echo $i; ?>">UPLOAD PHOTO</span></label>
                                            </div>
                              
                                      </div>
                                    </div>
                                    <?php } ?>
                                </div>
                              <?php } 
                              } 
                            } else { ?>
                              <input type="hidden" name="nameEduCount" id="nameEduCount" value="0">
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


                                  <div class="form-row">
                                    <?php echo form_error('documents'); ?>
                                    <div class="custom-file">
                                          <input type="hidden" name="documents_name" id="documents_name" value="<?php echo $educatonimage ?>">
                                          <div class="box js">

                                          <input oninvalid="InvalidMsg(this, 'Certificate');" oninput="InvalidMsg(this, 'Certificate');" type="file" name="documents_image" id="documents_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" required/>
                                          
                                            <label for="documents_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                              <span id="file_name_documents">Upload Certificate</span></label>
                                          </div>
                                    </div>
                              </div>
                            </div>

                            <?php } ?>
                            
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
              </diV>
              </div>





              <div class="col-md-8 col-12 tab-content custom-product-edit" id="experienceMain">
                <div class="product-tab-list tab-pane active" id="experience">
                    <div class="form-Title text-center">
                      <h3 class="mt-3">Experience</h3>
                      <!-- <p>Please enter your academic details and proceed to next form</p> -->
                    </div>
                    <div class="form-Content">
                      <div class="page-content">
                      <div class="form-v10-content">
                         <form class="form-detail" method="POST" id="myform" action="<?= base_url() ?>vetreg/reg4_experience">
                          <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                              <diV class="col-md-3"></div>
                              <div class="col-md-9 corm_nmset">
                                  <div class=" error" style="margin-left: 22%;color:#ec0606;">
                                      <?= $error ?>
                                  </div>
                              </div>
                          <?php } ?>
                            <div class="form-left">
                                <?php 
                                $reg4_experience = $this->session->userdata("reg4_experience");
                                //echo "<pre>";
                                //print_r($reg4_experience);
                                ?>    
                                <div class="form-row">
                                  <?php echo form_error('total_experince'); ?>
                                  <p style="margin-top: 10px;margin-left:-17px;" class="form-row">Total experience in years</p>
                                  <!-- <input value="<?php echo $total_experince ?>"  type="text" maxlength="2" name="total_experince" id="total_experince" class="total_experince input-text" placeholder="Total experience in years" required> -->
                                  <input type="text" value="<?php echo $reg4_experience['total_experince'] ?>" name="total_experince" maxlength="2" class="col-2" placeholder="" id="total_experince" style="border-color: black;border-width: 1px;height: 34px;max-width: 11%;">
                                </div>


                                <div class="form-row">
                                  
                                <span class="container">I Specialize In</span>
                                <div class="forcheck">
                                  <?php echo form_error('checkbox1'); ?>
                                  <?php
                                    $data = $this->api_model->product_section();
                                    foreach($data as $sec){
                                    //print_r($sec);
                                  ?>
                                  <div class="form-checkbox">
                                  <label class="container"><p><?= $sec['name'] ?></p>
                                      <input <?php if(in_array($sec['name'], $reg4_experience['specialize'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="<?= $sec['name'] ?>">
                                  <span class="checkmark"></span>
                                  </label>
                                  </div>
                                    <?php } ?>
                              </div>  
                              </div>
                               <!--  <div class="form-row">
                                  <?php echo form_error('name_organization'); ?>
                                  <input value="<?php echo $name_organization ?>" type="text" name="name_organization" id="name_organization" class="input-text" placeholder="Name of Organization" required>
                                </div>
                                <div class="form-row">
                                  <?php echo form_error('designation'); ?>
                                  <input value="<?php echo $designation ?>" type="text" name="designation" id="designation" class="input-text" placeholder="Designation" required>
                                </div>
                                <div class="form-row">
                                  <?php echo form_error('fromdate'); ?>
                                  <input value="<?php echo $fromdate ?>" type="text" onfocus="(this.type='date')"  name="fromdate" id="fromdate" placeholder="From Date" class="input-text" required>
                                </div>
                                <div class="form-row">
                                  <?php echo form_error('fromtodate'); ?>
                                  <input value="<?php echo $fromtodate ?>" type="text" onfocus="(this.type='date')" name="fromtodate" id="fromtodate" placeholder="TO Date" preg_replace class="input-text" required>
                                </div>
                                <div class="form-row">
                                  <?php echo form_error('descriptions'); ?>
                                  <input value="<?php echo $descriptions ?>" type="text"  name="descriptions" id="descriptions" class="input-text" placeholder="Please write a few lines about your achievements and experince..." required>
                                </div> -->
                                <p style="margin-top: 5px;margin-left: 12px;" class="form-row">Experience</p>
                                <div class="packValues<?= $i ?><?= $pack['unit_id']?> pack1 <?= $pack['unit_id']?> 
                                          <?php if($unit[0]['id'] != $pack['unit_id'] || $i != 0){ echo "hide"; } ?>">
                                
                                    <!-- <label style="margin-left: 10px;">Composition/Salt</label> -->
                                    
                                        <?php for($i=0;$i<10;$i++){ ?>
                                           
                                              <div class=" <?php if($i != '0'){ echo "hide1"; } ?>">
                                                    <div class="form-row">
                                                      <?php echo form_error('name_organization'); ?>
                                                      <input value="<?php echo $reg4_experience['experince_list'][$i]['name_organization'.$i] ?>" type="text" name="name_organization[]" id="name_organization[]" class="input-text name_organization" placeholder="Name of Organization" <?php if($i == '0'){ echo "required"; } ?>>
                                                    </div>
                                                    <div class="form-row">
                                                      <?php echo form_error('designation'); ?>
                                                      <input value="<?php echo $reg4_experience['experince_list'][$i]['designation'] ?>" type="text" name="designation[]" id="designation[]" class="input-text designation" placeholder="Designation" <?php if($i == '0'){ echo "required"; } ?>>
                                                    </div>
                                                    <div class="form-row">
                                                      <div class="col-2" style="margin-top: 17px;"><label>From Date</label></div>
                                                      <div class="col-4">
                                                        <?php echo form_error('fromdate'); ?>
                                                        <input value="<?php echo $reg4_experience['experince_list'][$i]['fromdate'] ?>" type="date"  onfocus="(this.type='date')" name="fromdate[]" id="fromdate[]" placeholder="From Date" class="fromdate input-text" <?php if($i == '0'){ echo "required"; } ?>>
                                                      </div>
                                                      <div class="col-2" style="margin-top: 17px;"><label>To Date</label></div>
                                                      <div class=" col-4">
                                                        <?php echo form_error('fromtodate'); ?>
                                                        <input value="<?php echo $reg4_experience['experince_list'][$i]['fromtodate'] ?>" type="date" onfocus="(this.type='date')" name="fromtodate[]" id="fromtodate[]" placeholder="To Date" preg_replace class="fromtodate input-text" <?php if($i == '0'){ echo "required"; } ?>>
                                                      </div>
                                                    </div>
                                                    <div class="form-row">
                                                      <?php echo form_error('descriptions'); ?>
                                                      <input value="<?php echo $reg4_experience['experince_list'][$i]['descriptions'] ?>" type="text"  name="descriptions[]" id="descriptions[]" class="descriptions input-text" placeholder="Please write a few lines about your achievements and experience..." <?php if($i == '0'){ echo "required"; } ?>>
                                                    </div>
                                                    <div class="form-row">
                                                        <!-- <p style="font-size: 23px;color:#007bff;margin-left: 17px;margin-top: 10px;" >Previous Employment if Any</p> -->
                                                        <span class="btn btn-sm btn-primary add_more_composition" style="margin-top: 79px;">Add More</span>
                                                        <button class="btn btn-sm btn-primary remove_more hide1" style="margin-left: 10px;" >Remove</button>
                                                    </div>
                                              </div>
                                        <?php } ?>
                                        
                                        <!-- <button class="btn btn-sm btn-primary add_more_composition" style="margin-left: 10px;">Add More Fields</button> -->
                                    
                                  
                                  </div>              
                                <div class="form-checkbox" style="width: 100%">
                                  <label class="container"><div class="msg blue1">Skip it, I will update it later</div>
                                      <input  <?php if($telephonicConsult == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult" >
                                      <span class="checkmark" style="margin-left:12px;"></span>
                                  </label>
                                </div>
                                <div class="row reg">
                                  <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-style2">Next</button>
                                  </div>
                                </div>  
                            </div>
                          </form>
                      </div>
                    </div>
                </div>
              </diV>
            </div>





            <div class="col-md-8 col-12 tab-content custom-product-edit" id="registrationMain">
                <div class="product-tab-list tab-pane active" id="registration">
                    <div class="form-Title text-center">
                      <h3 class="mt-3">Veterinary Council of India Registration Details</h3>
                      <!-- <p>Please enter your academic details and proceed to next form</p> -->
                    </div>
                    <div class="form-Content">
                      <div class="page-content">
                      <div class="form-v10-content">
                        <?php 
                          $reg5_experience = $this->session->userdata("reg5_regdetails");
                          //echo "<pre>";
                          //print_r($reg4_experience);
                          ?> 
                         <form class="form-detail"  method="POST" id="myform" action="<?= base_url() ?>vetreg/reg5_regdetails">
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
                                <input  oninvalid="InvalidMsg(this, 'Registration Number');" oninput="InvalidMsg(this, 'Registration Number');" value="<?php echo $reg5_experience['regisration_number'] ?>" type="text" name="regisration_number" id="regisration_number" class="input-text" placeholder="Registration Number" required>
                              </div>
                              <div class="form-row">
                                <?php echo form_error('regisration_council'); ?>
                                <input oninvalid="InvalidMsg(this, 'State');" oninput="InvalidMsg(this, 'State');" value="<?php echo $reg5_experience['regisration_number'] ?>" type="text" name="regisration_council" id="regisration_council" class="input-text" placeholder=" State" required>
                              </div>
                            
                                <div class="form-row">
                                    <?php echo form_error('year_registration'); ?>
                                    <select oninvalid="InvalidMsg(this, 'Year');" oninput="InvalidMsg(this, 'Year');" value="<?php echo $reg5_experience['regisration_number'] ?>" name="year_registration" id="year_registration" required>
                                    <option value="">Year</option>
                                      <?php 
                                      foreach($years as $year){ ?>
                                        <option <?php if($reg5_experience['registeration_year'] == $year) echo"selected"; ?> value="<?= $year ?>"><?= $year ?></option>
                                      <?php } ?>
                                    </select>
                                    <span class="select-btn">
                                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="form-checkbox" style="width: 100%">
                                  <label class="container"><div class="msg blue1">Skip it, I will update it later</div>
                                      <input  <?php if($$reg5_experience['telephonicConsult'] == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult">
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
              </diV>
            </div>





            <div class="col-md-8 col-12 tab-content custom-product-edit" id="bankdetailsMain">
                <div class="product-tab-list tab-pane active" id="bankdetails">
                    <div class="form-Title text-center">
                      <h3 class="mt-3">Bank Details</h3>
                      <!-- <p>Please enter your academic details and proceed to next form</p> -->
                    </div>
                    <div class="form-Content">
                      <div class="page-content">
                      <div class="form-v10-content">
                        <?php 
                        $reg6_bankdetails = $this->session->userdata("reg6_bankdetails");
                        //echo "<pre>";
                        //print_r($reg4_experience);
                        ?> 
                        <form class="form-detail"  method="POST" id="myform" action="<?= base_url() ?>vetreg/reg6_bankdetails">
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
                                <input oninvalid="InvalidMsg(this, 'Account Holder Name');" oninput="InvalidMsg(this, 'Account Holder Name');"  value="<?php echo $reg6_bankdetails['acct_holder_name'] ?>" type="text" name="acct_holder_name" id="acct_holder_name" class="input-text" placeholder="Account Holder Name" required>
                              </div>
                              <div class="form-row">
                                <?php echo form_error('acct_number'); ?>
                                <input oninvalid="InvalidMsg(this, 'Account Number');" oninput="InvalidMsg(this, 'Account Number');" value="<?php echo $reg6_bankdetails['account_no'] ?>" type="text" name="acct_number" id="acct_number" class="input-text" placeholder="Account Number" required>
                              </div>
                              <div class="form-row">
                                <?php echo form_error('bank_name'); ?>
                                <input  oninvalid="InvalidMsg(this, 'Bank Name');" oninput="InvalidMsg(this, 'Bank Name');" value="<?php echo $reg6_bankdetails['bank_name'] ?>" type="text" name="bank_name" id="bank_name" class="input-text" placeholder="Bank Name" required>
                              </div>
                              <div class="form-row">
                                <?php echo form_error('ifsc'); ?>
                                <input oninvalid="InvalidMsg(this, 'IFSC Code');" oninput="InvalidMsg(this, 'IFSC Code');" value="<?php echo $reg6_bankdetails['ifsc'] ?>" type="text" name="ifsc" id="ifsc" class="input-text" placeholder="IFSC Code" required>
                              </div>
                              <div class="form-row">
                                <?php echo form_error('branch_address'); ?>
                                <input oninvalid="InvalidMsg(this, 'Branch Address');" oninput="InvalidMsg(this, 'Branch Address');" value="<?php echo $reg6_bankdetails['branch_address'] ?>" type="text" name="branch_address" id="branch_address" class="input-text" placeholder="Branch Address" required>
                              </div>
                        
                            <div class="form-checkbox" style="width: 100%">
                              <label class="container"><div class="msg blue1">Skip it, I will update it later</div>
                                  <input  <?php if($reg6_bankdetails['telephonicConsult'] == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult" >
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
              </diV>
            </div>


            

            <div class="col-md-8 col-12 tab-content custom-product-edit" id="languageMain">
                <div class="product-tab-list tab-pane active" id="language">
                    <div class="form-Title text-center">
                      <h4 class="mt-3">I can communicate in the following languages(You can select multiple)</h4>
                      <!-- <p>Please enter your academic details and proceed to next form</p> -->
                    </div>
                    <div class="form-Content">
                      <div class="page-content">
                      <div class="form-v10-content">
                        <form class="form-detail" method="POST" id="myform" action="<?= base_url() ?>vetreg/reg7_language">
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
              </diV>
            </div>









          </div>
        </div>
      </div>
   

  <div class="form-details">
    
  </div>

<?php include('footer_vetreg.php'); ?>
<script type="text/javascript">
  $('.custom-product-edit').hide();
  $('#basicinformationMain').show();
  $(function () {
     $('input[type="file"]').change(function () {
          if ($(this).val() != "") {
                 $(this).css('color', '#333');
          }else{
                 $(this).css('color', 'transparent');
          }
     });
});
$(document).ready(function() {
      showNextMenu($('#stepsPage').val());
      $('#profile_image').change(function(){
        $('#file_name').html('');
        $('#file_name').html($('#profile_image')[0].files[0].name);
        var file_data = $('#profile_image').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('image', file_data);
        $.ajax({
          url: "<?= base_url() ?>Api/web_cropper_images?path=doc",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            data = JSON.parse(data);
              $('#image_name').val(data.data);
              $('#preview').attr('src', '<?= base_url() ?>harpahu_merge/uploads/doc/'+data.data[0]);
          }
        });
      });

      $('#aadharcar_image').change(function(){
        $('#file_name_aadharcar').html('');
        $('#file_name_aadharcar').html($('#aadharcar_image')[0].files[0].name);
        var file_data = $('#aadharcar_image').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('image', file_data);
        $.ajax({
          url: "<?= base_url() ?>Api/web_cropper_images?path=doc",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            data = JSON.parse(data);
              $('#aadharcar_name').val(data.data);
              //$('#preview').attr('src', '<?= base_url() ?>uploads/doc/'+data.data[0]);
          }
        });
      });


      $('#documents_image').change(function(){
        $('#file_name_documents').html('');
        $('#file_name_documents').html($('#documents_image')[0].files[0].name);
        var file_data = $('#documents_image').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('image', file_data);
        $.ajax({
          url: "<?= base_url() ?>Api/web_cropper_images?path=doc",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            data = JSON.parse(data);
            $('#documents_name').val(data.data);
            //$('#preview').attr('src', '<?= base_url() ?>uploads/doc/'+data.data[0]);
          }
        });
      });

      $('#educaton_image1').change(function(){
        $('#file_name_educaton1').html('');
        $('#file_name_educaton1').html($('#educaton_image1')[0].files[0].name);
        var file_data = $('#educaton_image1').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('image', file_data);
        $.ajax({
          url: "<?= base_url() ?>Api/web_cropper_images?path=doc",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            data = JSON.parse(data);
              $('#educaton_name1').val(data.data);
              //$('#preview').attr('src', '<?= base_url() ?>uploads/doc/'+data.data[0]);
          }
        });
      });
      $('#educaton_image2').change(function(){
        $('#file_name_educaton1').html('');
        $('#file_name_educaton1').html($('#educaton_image2')[0].files[0].name);
        var file_data = $('#educaton_image2').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('image', file_data);
        $.ajax({
          url: "<?= base_url() ?>Api/web_cropper_images?path=doc",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            data = JSON.parse(data);
              $('#educaton_name1').val(data.data);
              //$('#preview').attr('src', '<?= base_url() ?>uploads/doc/'+data.data[0]);
          }
        });
      });
      $('#educaton_image3').change(function(){
        $('#file_name_educaton1').html('');
        $('#file_name_educaton1').html($('#educaton_image3')[0].files[0].name);
        var file_data = $('#educaton_image3').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('image', file_data);
        $.ajax({
          url: "<?= base_url() ?>Api/web_cropper_images?path=doc",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            data = JSON.parse(data);
              $('#educaton_name1').val(data.data);
              //$('#preview').attr('src', '<?= base_url() ?>uploads/doc/'+data.data[0]);
          }
        });
      });
      

});

  function showNextMenu(divDetailsName) {
    console.log(divDetailsName);
    $('.custom-product-edit').hide();
    $('#'+divDetailsName).show();
    $('#'+divDetailsName+'Main').show();
    $('#'+divDetailsName+'Selection').removeClass('step-counter-activ');
    $('#'+divDetailsName+'Selection').removeClass('step-counter');
    $('#'+divDetailsName+'Selection').addClass('step-counter-activ');
  }

  $("#profile_image").change(function(event) {  
    //RecurFadeIn();
    //readURL(this);    
  });
  $("#profile_image").on('click',function(event){
    //RecurFadeIn();
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
        $('#telephonicConsultText').attr('required', '');
      } else {
        $('#telephonicConsultText').removeAttr("required");
        x.style.display = "none";
      }
  }
  function homeVisitChangesNew() {
    var x = document.getElementById("homeVisitChanges");
      if (x.style.display === "none") {
        x.style.display = "block";
        $('#homeVisitChangesText').attr('required', '');
      } else {
        $('#homeVisitChangesText').removeAttr("required");
        x.style.display = "none";
      }
  }

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
  
  var addValue = $('#nameEduCount').val();
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
                <div class="custom-file" style="width: 407px;margin-bottom: 23px;">  <input type="file" id="educaton_image'+indeValue+'" name="educaton_image'+indeValue+'" class="" /><button onclick="removeFile('+ indeValue +');" type="button" class="btn btn-light btn-style1" style="margin-right: -96px;">Remove</button></div></div>').insertBefore('#new_qualification');
        e.preventDefault();
    } else {
      addValue = 3;
    }
  });

  $('#telephonicConsult').click(function(){
   
    if($('#telephonicConsult').is(":checked")){
      //$('.total_experince').attr('required');
      $('.name_organization').removeAttr('required');
       $('.designation').removeAttr('required');
       $('.fromdate').removeAttr('required');
       $('.fromtodate').removeAttr('required');
      $('.descriptions').removeAttr('required');
    }else{
     
     // $('#institute').removeAttr('required');
      // $('#EDU').removeAttr('required');
      //$('.total_experince').removeAttr('required');
       $('.name_organization').attr('required');
       $('.designation').attr('required');
       $('.fromdate').attr('required');
       $('.fromtodate').attr('required');
       $('.descriptions').attr('required');
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
    var max_fields_limit4 = 10;
    var x4 = 1; 
    $('.add_more_composition').click(function(e){
     e.preventDefault();
     /*$(this).parent().parent().next().find('.name_organization').attr('required');
     $(this).parent().parent().next().find('.designation').attr('required');
     $(this).parent().parent().next().find('.fromdate').attr('required');
     $(this).parent().parent().next().find('.fromtodate').attr('required');
     $(this).parent().parent().next().find('.descriptions').attr('required');*/
     //$(this).('.total_experince').attr('required');
     // $(this).('.name_organization').attr('required');
     // $(this).('.designation').attr('required');
      //$(this).('.fromdate').attr('required');
     // //$(this).('.fromtodate').attr('required');
     // $(this).('.descriptions').attr('required');
      $(this).parent().parent().next().removeClass('hide1');
      $(this).addClass('hide1');
      $(this).next().removeClass('hide1');
      $(this).parent().parent('div').removeClass('hide1');
      // $(this).text('Remove');
      //$(this).hide();

      // if(x4 < max_fields_limit4){
      //  x4++;
      //  $('.composition_fields_container').append('<div style="margin-top: 5px;"><input type="text" name="composition_name[]" placeholder="Name ....."><input type="number" name="composition_value[]" placeholder="Value ....." style="margin-left: 10px;" /><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div>'); //add input field
      // }
    });  
    $('.remove_more').click(function(e){
      e.preventDefault();
      //$(this).parent().parent().prev().addClass('hide1');
      $(this).parent().parent('div').addClass('hide1');
      //$(this).parent().parent().prev().addClass('hide1');
      // $(this).('.total_experince').removeAttr('required');
      $(this).parent().parent().find('.name_organization').removeAttr('required');
      $(this).parent().parent().find('.designation').removeAttr('required'); 
      $(this).parent().parent().find('.fromdate').removeAttr('required');
      $(this).parent().parent().find('.fromtodate').removeAttr('required');
      $(this).parent().parent().find('.descriptions').removeAttr ('required');
      //$(this).parent().next().removeClass('hide1');
      // $(this).parent('div').addClass('hide');
      // $(this).addClass('add_more_composition');
      // $(this).removeClass('remove_more');
      // $(this).text('Add More Fields');
    });
    $('.composition_fields_container').on("click",".remove_field", function(e){
      //e.preventDefault(); $(this).parent('div').remove(); x4--;
    });

    $('#tog').click(function(){
      $('.ul_to').toggle();
      if($('#catid').val() != 0){
      $('#catid').val(0);
      }
    });           
    $('#cat').on('change', function(){
      if(this.value != 0){
        
      }
    });  
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

function InvalidMsg(textbox, inputName) { 
    if (textbox.value === '') { 
        textbox.setCustomValidity('Please fill out ' + inputName); 
    } else if (textbox.validity.typeMismatch) { 
        textbox.setCustomValidity('Please enter an ' + inputName + ' which is valid!'); 
    } else { 
        textbox.setCustomValidity(''); 
    }
    return true; 
} 
</script>