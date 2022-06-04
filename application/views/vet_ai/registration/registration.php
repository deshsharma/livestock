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
            <div class="stepsec">
              <a onclick="showNextMenu('basicinformation');"><p class="blue1"><span class="step-counter-activ" id="basicinformationSelection" >01</span><span class="nomob"> Basic Information</span></p></a>
            </div>
          </div>

        <div class="col-md-8 col-12 tab-content custom-product-edit" id="basicinformationMain">
            <div class="product-tab-list tab-pane active" id="basicinformation">
              <div class="form-Title text-center">
                <h3 class="mt-3">Register Now</h3>
               
              </div>
              <div class="form-Content">
                <div class="page-content" style="margin-top: -110px;">
                  <div class="form-v10-content">
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
                                </div>

                          <div class="form-row">
                            <?php echo form_error('first_name'); ?>
                            <input oninvalid="InvalidMsg(this, 'Name');" oninput="InvalidMsg(this, 'Name');"  value="<?php echo $first_name ?>" type="text"  name="first_name" id="first_name" class="input-text" placeholder="Name" required>
                          </div>

                          <div class="form-row">
                            <?php echo form_error('father_name'); ?>
                            <input oninvalid="InvalidMsg(this, 'Father Name');" oninput="InvalidMsg(this, 'Father Name');"  value="<?php echo $father_name ?>" type="text"  name="father_name" id="father_name" class="input-text" placeholder="Father Name" required>
                          </div>


                        <div class="form-row">
                          <?php echo form_error('your_email'); ?>
                          <input oninvalid="InvalidMsg(this, 'Email Address');" oninput="InvalidMsg(this, 'Email Address');" value="<?php echo $your_email ?>" type="text" name="your_email" id="your_email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="Email Address">
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

                         <div class="form-group">
                            <div class="form-row form-row-1">
                              <?php echo form_error('adhar'); ?>
                              <input oninvalid="InvalidMsg(this, 'Aadhar Number');" oninput="InvalidMsg(this, 'Aadhar Number');" value="<?php echo $adhar ?>" type="text" maxlength="12" minlength="12" pattern="[0-9]{12}" name="adhar" class="additional" id="adhar" placeholder="Aadhar Number" required>
                            </div>
                            <div class="form-row form-row-2">
          
                             <div class="custom-file">
                                  <input type="hidden" name="aadharcar_name" id="aadharcar_name" value="<?php echo $adhaar_img ?>">
                                  <div class="box js">
                                  
                                  <input oninvalid="InvalidMsg(this, 'adhar Image');" oninput="InvalidMsg(this, 'adhar Image');" type="file" name="aadharcar_image" id="aadharcar_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                                  
                                    <label for="aadharcar_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                      <span id="file_name_aadharcar">UPLOAD PHOTO</span></label>
                                  </div>

                              </div>
                            </div>
                        </div>


                        <div class="form-group">
                          <div class="form-row form-row-1">
                            <?php echo form_error('code'); ?>
                            <input  type="text" value="+91" name="code" class="code" id="code" placeholder="Code +" required readonly="">
                          </div>
                          <div class="form-row form-row-2">

                          <input type="hidden" name="mobile" value="<?= isset($mobile) ? $mobile : $_REQUEST['mobile'] ?>">
                          <input type="hidden" name="type" value="<?= isset($users_type) ? $users_type : $_REQUEST['type'] ?>">
                          <input type="text" value="<?= isset($mobile) ? $mobile : $_REQUEST['mobile'] ?>" type="text" maxlength="10" minlength="10" pattern="[0-9]{10}" name="mobile" class="mobile" id="phone" placeholder="Mobile No"  disabled > 
                          <!-- 
                          <input type="text" value="<?php echo $mobile ?>" maxlength="10" minlength="10" pattern="[0-9]{10}" name="mobile" class="mobile" id="phone" placeholder="Mobile No" > -->
                          </div>
                         
                        </div>

                        <div class="form-group">
                          <div class="form-row form-row-1">
                            <?php echo form_error('code'); ?>
                            <input  type="text" value="+91" name="code" class="code" id="code" placeholder="Code +" required readonly="">
                          </div>
                          <div class="form-row form-row-2">
                         
                          <input type="text" value="<?php echo $alternatemobile ?>" maxlength="10" minlength="10" pattern="[0-9]{10}" name="alternatemobile" class="mobile" id="alternatemobile" placeholder="Alternate Number" >
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row form-row-1">
                              <?php echo form_error('10th'); ?>
                              <input oninvalid="InvalidMsg(this, '10th');" oninput="InvalidMsg(this, '10th');" value="<?php echo $tenth ?>" type="text" name="10th" class="additional" id="10th" placeholder="10th" disabled>
                            </div>
                            <div class="form-row form-row-2">
          
                             <div class="custom-file">
                                  <input type="hidden" name="tenth_name" id="tenth_name" value="<?php echo $tenth ?>">
                                  <div class="box js">
                                  
                                  <input oninvalid="InvalidMsg(this, 'tenth Image');" oninput="InvalidMsg(this, 'tenth Image');" type="file" name="tenth_image" id="tenth_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                                  
                                    <label for="tenth_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                      <span id="file_name_tenth">UPLOAD PHOTO</span></label>
                                  </div>

                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row form-row-1">
                              <?php echo form_error('12th'); ?>
                              <input oninvalid="InvalidMsg(this, '12th');" oninput="InvalidMsg(this, '12th');" value="<?php echo $plustwo ?>" type="text" name="12th" class="additional" id="12th" placeholder="12th" disabled>
                            </div>
                            <div class="form-row form-row-2">
          
                             <div class="custom-file">
                                  <input type="hidden" name="plustwo_name" id="plustwo_name" value="<?php echo $plustwo ?>">
                                  <div class="box js">
                                  
                                  <input oninvalid="InvalidMsg(this, 'adhar Image');" oninput="InvalidMsg(this, 'adhar Image');" type="file" name="plustwo_image" id="plustwo_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                                  
                                    <label for="plustwo_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                      <span id="file_name_plustwo">UPLOAD PHOTO</span></label>
                                  </div>

                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row form-row-1">
                              <?php echo form_error('12th'); ?>
                              <input oninvalid="InvalidMsg(this, 'diplomainstitute');" oninput="InvalidMsg(this, 'diplomainstitute');" value="<?php echo $diplomainstitute ?>" type="text" name="diplomainstitute" class="additional" id="diplomainstitute" placeholder="Diploma Institute" disabled>
                            </div>
                            <div class="form-row form-row-2">
          
                             <div class="custom-file">
                                  <input type="hidden" name="diplomainstitute_name" id="diplomainstitute_name" value="<?php echo $diploma ?>">
                                  <div class="box js">
                                  
                                  <input oninvalid="InvalidMsg(this, 'adhar Image');" oninput="InvalidMsg(this, 'adhar Image');" type="file" name="diplomainstitute_image" id="diplomainstitute_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                                  
                                    <label for="diplomainstitute_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                      <span id="file_name_diplomainstitute">UPLOAD PHOTO</span></label>
                                  </div>

                              </div>
                            </div>
                        </div>

                        
                        <div class="form-row">
                          <?php echo form_error('total_experince'); ?>
                          <input type="text" value="<?php echo $total_experince ?>" name="total_experince" class="mobile" id="alternatemobile" placeholder="Total experince in years" > 
                        </div>

                        <div class="form-row">
                          <?php echo form_error('address'); ?>
                          <input oninvalid="InvalidMsg(this, 'Address');" oninput="InvalidMsg(this, 'Address');" value="<?php echo $address ?>" type="text" name="address" class="additional" id="address" placeholder="Address" required>
                        </div>

                        <div class="form-group">
                            <div class="form-row form-row-1">
                              <?php echo form_error('pincode'); ?>
                              <input oninvalid="InvalidMsg(this, 'Pin Code');" oninput="InvalidMsg(this, 'Pin Code');"  maxlength="6" minlength="4" pattern=".{4,9}" value="<?php echo $pincode ?>" type="text" name="pincode" class="zip" id="pincode" placeholder="Pin Code" required>
                            </div>
                            <div class="form-row form-row-2">
                              <?php echo form_error('place'); ?>
                              <input oninvalid="InvalidMsg(this, 'City/Town');" oninput="InvalidMsg(this, 'City/Town');" value="<?php echo $address ?>" type="text" name="place" class="additional" id="place" placeholder="City/Town" required>
                               
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
                           
     
                        
                        <p class="msg">Passcode</p>
                        <div class="form-row form-row-1">
                          <div id="divOuter1" class="mobile">
                              <div id="divInner1">
                              <input style="padding-left: 0px !important;letter-spacing: 39px;" id="partitioned" name="passcode" value="<?php echo $passcode ?>"  name="passcode" type="text" maxlength="4" />
                            </div>
                          </div>

                        </div>
                        <p class="msg">Confrom Passcode</p>
                        <div class="form-row form-row-1">
                          <input style="padding-left: 0px !important;letter-spacing: 39px;" id="partitioned" name="confirm_passcode" value="<?php echo $passcode ?>" name="confirm_passcode"  type="text" maxlength="4"/>
                        </div>
                        

                        <div class="form-row">
                            <span class="container">Experties</span>
                            <div class="forcheck">
                              <?php echo form_error('checkbox1'); ?>
                              <?php
                                $data = $this->api_model->product_section();
                                foreach($data as $sec){
                                  //print_r($sec);
                              ?>
                              <div class="form-checkbox">
                              <label class="container"><p style="width: 100%;"><?= $sec['name'] ?></p>
                                  <input <?php if(in_array('Cow/Buffalo', $experince_list)) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="<?= $sec['name'] ?>">
                              <span class="checkmark"></span>
                              </label>
                              </div>
                                <?php } ?>
                          </div>  
                        </div>

                        <div class="form-checkbox" style="width:100%;margin-left:10px;">
                          <label class="container"><div class="msg blue1">I Will accept the rates as per company policy</div>
                              <input <?php if($accept_polices == '1') { echo "checked='checked'"; } ?> type="checkbox" name="homeVisit" id="homeVisit" value="1">
                              <span class="checkmark"></span>
                          </label>
                        </div>


                        <div class="row reg">
                          <div class="col-12">
                            <button name="submit" value="1" class="btn btn-primary btn-style2">SUBMIT</button> 
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
      showNextMenu('basicinformation');
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

      $('#tenth_image').change(function(){
        $('#file_name_tenth').html('');
        $('#file_name_tenth').html($('#tenth_image')[0].files[0].name);
        var file_data = $('#tenth_image').prop('files')[0];   
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
              $('#tenth_name').val(data.data);
              //$('#preview').attr('src', '<?= base_url() ?>uploads/doc/'+data.data[0]);
          }
        });
      });


      $('#plustwo_image').change(function(){
        $('#file_name_plustwo').html('');
        $('#file_name_plustwo').html($('#plustwo_image')[0].files[0].name);
        var file_data = $('#plustwo_image').prop('files')[0];   
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
            $('#plustwo_name').val(data.data);
            //$('#preview').attr('src', '<?= base_url() ?>uploads/doc/'+data.data[0]);
          }
        });
      });

      $('#diplomainstitute_image').change(function(){
        $('#file_name_diplomainstitute').html('');
        $('#file_name_diplomainstitute').html($('#diplomainstitute_image')[0].files[0].name);
        var file_data = $('#diplomainstitute_image').prop('files')[0];   
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
              $('#diplomainstitute_name').val(data.data);
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