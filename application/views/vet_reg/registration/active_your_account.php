<style>
    /* Popup container */
    .popup {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }
    /* The actual popup (appears on top) */
    .popup .popuptext {
      visibility: hidden;
      width: 160px;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 8px 0;
      position: absolute;
      z-index: 1;
      bottom: 170%;
      left: 9%;
      margin-left: -80px;
    }
    /* Popup arrow */
    .popup .popuptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }
    /* Toggle this class when clicking on the popup container (hide and show the popup) */
    .popup .show {
      visibility: visible;
      -webkit-animation: fadeIn 1s;
      animation: fadeIn 1s
    }
    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity:1 ;}
    } 
</style>
<div class="container">
      <div class="formTotal">
      <div class="col-md-12">
        <div class="form-Title text-center">
          <h3 class="mt-3">Activate Your Account</h3>
        </div>
        <div class="form-Content">
          <div class="page-content">
            <div class="form-v10-content">
              <input type="hidden" id="showsecondtab" value="<?php echo $showsecondtab ?>">
              <?php if($showsecondtab !=1) { ?>
              <form class="form-detail label-hide" method="POST" id="myform">
                <input type="hidden" id="id" name="id" value="<?= $id ?>">
                <?php $user_data = $this->api_model->doc_detail_id($id); 
                ?>
                <input type="hidden" id="username" name="username" value="<?= $user_data[0]['username'] ?>">
                <input type="hidden" id="password" name="password" value="<?= $user_data[0]['password'] ?>">
                <input type="hidden" id="email" name="email" value="<?= $user_data[0]['email'] ?>">
                <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                  <diV class="col-md-3"></div>
                  <div class="col-md-9 corm_nmset">
                      <div class=" error" style="margin-left:0%;">
                          <?= $error ?>
                      </div>
                  </div>
               <?php } ?>
                <div class="form-left" style="margin-left: auto;margin-right: auto ; margin-bottom: auto;width: auto;">
                    <div class="form-row">
                       <div class="forcheck w-100">
                            <p id='show-error'>Please select checkbox</p>
                            <div class="form-checkbox">
                            <label class="container">
                                <p style="width: 200px">I Accept Terms & Conditions</p>
                                <input type="checkbox" name="checkbox1" id='checkbox1' value="English">
                                <span class="checkmark"></span>
                            </label>
                            </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-8">
                          <?php echo form_error('referral_code'); ?>
                          <input type="text" name="referral_code" class="additional" id="referral_code" placeholder="Referral Code if Any">
                        </div>
                        <div class="col-4">
                        <button type="button" id='appy_referral_code' class="btn btn-primary btn-style2" style="color: #ffff;">Apply</button>  
                      </div>
                    </div>
                    <div class="form-row">
                      <button name="submit" value="1" class="btn btn-primary btn-style2 show popup" style="color: #ffff;">Activate My Account</button> 
                      <span class="popuptext" id="myPopup" style="display:none;color: red;margin-top: -220px;margin-left: 34px;">Please Accept Terms & Conditions</span>
                     </div>
                     <p style="margin-left: 29px;">Please enter referral code If any,otherwize you can call at 18001031541</p>                     
                     <div class="form-row">
                      <button name="submitskip"  value="1" class="btn btn-primary btn-style2 show" style="color: #ffff;">Don't have referrral code,skip it</button> 
                     </div>
                </div>
               <!--  <div class="form-left" style=" width: 270px;margin-left: auto;margin-right: auto ;">
                    <div class="form-row">
                       
                        <div class="forcheck w-100">
                            <p id='show-error'>Please select checkbox</p>
                            <div class="form-checkbox">
                            <label class="container">
                                <p style="width: 200px">I Accept Terms & Conditions</p>
                                <input type="checkbox" name="checkbox1" id='checkbox1' value="English">
                                <span class="checkmark"></span>
                            </label>
                            </div>
                      </div>

                        <div class='show popup' style="color:blue; width: 200px; border: 1px solid rgb(192,192,192);background: yellow;color: black;text-align: center;">
                            <label style="margin-top: 10px;">Activate Your Account</label>
                            <span class="popuptext" id="myPopup">Please select checkbox</span>
                        </div>  
                  </div> 
                </div>-->
              </form>
            <?php } ?>

              <form class="form-detail form_for_active_account" method="POST" id="myform2" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="<?= $id ?>">
                <?php $user_data = $this->api_model->doc_detail_id($id); 
                ?>
                <input type="hidden" id="username" name="username" value="<?= $user_data[0]['username'] ?>">
                <input type="hidden" id="password" name="password" value="<?= $user_data[0]['password'] ?>">
                <input type="hidden" id="email" name="email" value="<?= $user_data[0]['email'] ?>">
                <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                  <diV class="col-md-3"></div>
                  <div class="col-md-9 corm_nmset">
                      <div class=" error" style="margin-left:0%;">
                          <?= $error ?>
                      </div>
                  </div>
               <?php } ?>
                <div class="form-left" style="margin-left: auto;margin-right: auto ; margin-bottom: auto;width: auto;">
                    <div class="form-row">
                      <div class="col-8">
                          <?php echo form_error('referral_code'); ?>
                          <input type="text" name="referral_code" class="additional" id="referral_code" placeholder="Referral Code if Any">
                        </div>
                        <div class="col-4">
                        <button type="button" id='appy_referral_code' class="btn btn-primary btn-style2" style="color: #ffff;">Apply</button>  
                      </div>
                    </div>
                    <div class="form-row">
                      <button name="submit" value="1" class="btn btn-primary btn-style2" style="color: #ffff;">Submit</button> 
                     </div>
                     <p style="margin-left: 29px;">Please enter referral code If any,otherwize you can call at 18001031541</p>                     
                     <div class="form-row">
                      <button name="submitskip"  value="1" class="btn btn-primary btn-style2" style="color: #ffff;">Don't have referrral code,skip it</button> 
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
<style type="text/css">
   /* Popup container */
    .popup {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }
    /* The actual popup (appears on top) */
    .popup .popuptext {
      visibility: hidden;
      width: 160px;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 8px 0;
      position: absolute;
      z-index: 1;
      bottom: 170%;
      left: 9%;
      margin-left: -80px;
    }
    /* Popup arrow */
    .popup .popuptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }
    /* Toggle this class when clicking on the popup container (hide and show the popup) */
    .popup .show {
      visibility: visible;
      -webkit-animation: fadeIn 1s;
      animation: fadeIn 1s
    }
    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity:1 ;}
    } 
</style>
<script type="text/javascript">

  if($('#showsecondtab').val()== 1) {
    $('.form_for_active_account').show();
    $('#show-error').show();
  } else {
    $('.form_for_active_account').hide();
    $('#show-error').hide();
  }

  $(".show").click(function (e) {
   
    if($('#checkbox1').is(':checked')) {
        //$('.label-hide').hide();
        $('.myform').submit();
        $('#myPopup').hide();
    } else {
       e.preventDefault()
        $('#myPopup').show();
        //$('.form_for_active_account').hide();
        //$('#show-error').show();
        // var popup = document.getElementById("myPopup");
        // popup.classList.toggle("show");
    }
  });

    $(document).ready(function() {
      $('#appy_referral_code').on("click", function(e){
          $.ajax({
                type: "POST",
                url: "<?= base_url() ?>vetreg/check_ref_hpkd?ref="+$('#referral_code').val(),
                dataType: "json",
                cache : false,
                success: function(resp){
                    if(resp.success == false) {
                        //$('#appy_referral_code').text('Not Verified');
                        alert('Referral Code Not Verified');
                    } else {
                        $('#appy_referral_code').text('Verified');
                        $('#id').val(resp.data.doctor_id);
                        $('#username').val(resp.data.username);
                        $('#password').val(resp.data.password);
                        $('#email').val(resp.data.email);
                    }               
                }
            });
      });
    });
</script>