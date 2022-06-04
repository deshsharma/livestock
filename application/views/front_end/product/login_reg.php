<script src="<?= base_url() ?>assets/main/js/ajaxloader.js"></script><script src="<?= base_url() ?>assets/main/js/ajaxloader.js"></script>
    <section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">  
        <div class="col-12 col-md-7 mb-5 mt-5 mt-sm-0 mt-md-0">
        <form class="login100-form validate-form bg-white p-4 p-md-5 rounded minh-login" id="frm_login">
          <span class="login100-form-title p-b-26 text-left">
            Login
          </span>
          <!-- <span class="mt-4 d-block">I want to login as</span> -->
            
        <div class="form-check mt-2 d-inline-block mb-3">
         
        </div> 
        <div class="form-check mt-3 d-inline-block ml-4">
        
        </div>      
            
          <div class="row mt-4">        
          <div class="col-12 col-md-6">    
          <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
            <input class="input100" type="text" name="username" id="uname">
            <span class="focus-input100" data-placeholder="Mobile"></span>
          </div>
          </div>
              
              
          <div class="col-12 col-md-6">      
          <div class="wrap-input100 validate-input" data-validate="Enter passcode">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password">
            <span class="focus-input100" data-placeholder="Passcode"></span>
          </div>
          </div>
          </div>  

          <div class="row">        
          <div class="col-12 col-md-6">    
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" id="btnLogin">
                Login
              </button>
            </div>
          </div>      
              </div>
             <div class="col-12 col-md-6 text-left text-md-right mt-5">
            <a class="txt2" href="<?= base_url('frontend/resend') ?>">
              Forgot Password ?
            </a>
          </div>   
            </div>
          <div class="row mt-4">    
          <div class="col-12 col-md-6">
          <div class="text-left mt-1">
            
          </div>
          </div>    
            </div>    
        </form>
      </div>
                            
      <div class="col-12 col-md-5 mb-5 noacct">
        <form class="login100-form validate-form pt-2 pl-4 pl-md-5 bg-white p-4 p-md-5 rounded minh-login" method="POST">
            <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                                <diV class="col-md-3"></div>
                                <div class="col-md-9 corm_nmset">
                                    <div class=" error" style="margin-left:0%;">
                                        <?= $error ?>
                                    </div>
                                </div>
            <?php } ?>
             <h5 class="text-left">  Sign Up</h5>
           

           <div class="wrap-input100 validate-input mt-4" data-validate = "Valid email is: a@b.c">
           <?php echo form_error('name'); ?>
            <input class="input100" type="text" name="name">
            <span class="focus-input100" data-placeholder="Name"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('f_name'); ?>
            <input class="input100" type="text" name="f_name">
            <span class="focus-input100" data-placeholder="Father's Name"></span>
          </div> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('number'); ?>
            <input class="input100" type="text" name="number">
            <span class="focus-input100" data-placeholder="Mobile Number"></span>
          </div> 
          <div class="wrap-input100 validate-input" data-validate="Enter Your Passcodee">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('passcode'); ?>
            <input class="input100" type="password" name="passcode">
            <span class="focus-input100" data-placeholder="Passcode"></span>
          </div> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('email'); ?>
            <input class="input100" type="text" name="email">
            <span class="focus-input100" data-placeholder="Email ID"></span>
          </div> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('adhar'); ?>
            <input class="input100" type="text" name="adhar">
            <span class="focus-input100" data-placeholder="Adhar No"></span>
          </div> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('address1'); ?>
            <input class="input100" type="text" name="address1">
            <span class="focus-input100" data-placeholder="Address Line 1"></span>
          </div> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="text" name="address2">
            <span class="focus-input100" data-placeholder="Address Line 2"></span>
          </div> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('state'); ?>
            <?php $state = $this->api_model->get_state("99"); 
					//print_r($state);
					?>
						<select name="state" id="state" class="input100 state" required>
							<option value=""> State </option>
							<?php 
							foreach($state as $st){ ?>
								<option value="<?= $st['zone_id'] ?>"><?= $st['name'] ?></option>
							<?php } 
							?>
						</select>
            <!-- <input class="input100" type="text" name="state"> -->
            <span class="focus-input100" data-placeholder="State"></span>
          </div> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('District'); ?>
            <select name="District" id="district" class="input100 city" required>
							<option value=""> District </option>
						</select>
            <!-- <input class="input100" type="text" name="District"> -->
            <span class="focus-input100" data-placeholder="district"></span>
          </div> 

          <div class="form-checkbox" style="width: 100%">
            <label class="container">
                <input style="width:23%" checked='checked' type="checkbox" name="termsandconditions" id="termsandconditions" value="1">
                <span class="msg blue1">Terms & Conditions</span>
                <span class="checkmark"></span>
            </label>
          </div> 
            
          <div class="container-login100-form-btn mt-4">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="submit" value="1">
                Submit
              </button>
            </div>
          </div>        
        </form>
        </div>                
      </div>
     </div>
	</section>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="<?= base_url() ?>assets/product/js/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/jquery.easing.1.3.js"></script>
  <script src="<?= base_url() ?>assets/product/js/jquery.waypoints.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/jquery.stellar.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/owl.carousel.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/jquery.magnific-popup.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/aos.js"></script>
  <script src="<?= base_url() ?>assets/product/js/jquery.animateNumber.min.js"></script>
  <script src="<?= base_url() ?>assets/product/js/bootstrap-datepicker.js"></script>
  <script src="<?= base_url() ?>assets/product/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?= base_url() ?>assets/product/js/google-map.js"></script>
  <script src="<?= base_url() ?>assets/product/js/main.js"></script>

  <script>
  $('.state').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data;
                    var option = '<option value="">Select District</option>';
			                            $.each(str.data, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			                            }); 
                                        $('.city').html(option);
										
                }
                });
    })
     $(document).ready(function() {
        $('#btnLogin').on('click',function(event){
                if($('#uname, #password').val()!='')
                  {
                    event.preventDefault();
                       ajaxloader.loadURL("<?php echo base_url('login/user_login') ?>",$('#frm_login').serialize(), function(resp){
                        var data = resp;
                        if(data['error']=='1'){   
                           $('#frm_login').find('.text-danger').remove();
                           $('#uname').before("<p class='text-danger'>Invalid Username/Password.</p>");
                           return false;
                        }
                        // else if(data['error']=='2'){
                        //   window.location="<?php echo base_url('fif'); ?>"
                        // }
                        else{
                             window.location = "<?php echo base_url() ?>";
                        }
                       });
                  }
        });
    });
	</script>
    <script>
    jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});
  
    </script>
      
  </body>
</html>