<script src="<?= base_url() ?>assets/main/js/ajaxloader.js"></script><script src="<?= base_url() ?>assets/main/js/ajaxloader.js"></script>
    <section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">  
        <div class="col-12 col-md-12 mb-5 mt-5 mt-sm-0 mt-md-0">
            <form class="login100-form validate-form bg-white p-4 p-md-5 rounded minh-login" id="frm_login">
              <span class="login100-form-title p-b-26 text-left">
                Login
              </span>
              <!-- <span class="mt-4 d-block">I want to login as</span> -->
                
            <div class="form-check mt-2 d-inline-block mb-3">
              <!-- <input class="form-check-input" type="radio" name="option" id="exampleRadios2" value="0" checked>
              <label class="form-check-label" for="exampleRadios2">
                Customer
              </label> -->
            </div> 
            <div class="form-check mt-3 d-inline-block ml-4">
              <!-- <input class="form-check-input" type="radio" name="option" id="exampleRadios1" value="1">
              <label class="form-check-label" for="exampleRadios1">
                Doctor
              </label> -->
            </div>      
                
              <div class="row mt-4">        
              <div class="col-12 col-md-6">    
              <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                <input class="input100" type="text" name="username" id="uname">
                <span class="focus-input100" data-placeholder="Mobile/Email"></span>
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
              </div>
              <div class="row mt-4">    
              <div class="col-12 col-md-6">
              <div class="text-left mt-1">
                <!-- <span class="txt1">
                  Don’t have an account yet ?
                </span>

                <a class="txt2 d-block" href="#">
                  Sign Up Here
                </a> -->
              </div>
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
                   ajaxloader.loadURL("<?php echo base_url('login/vet_login') ?>",$('#frm_login').serialize(), function(resp){
                    var data = resp;
                    if(data['error']=='1'){   
                       $('#frm_login').find('.text-danger').remove();
                       $('#uname').before("<p class='text-danger'>Invalid Username/Password.</p>");
                       return false;
                    }else{
                      window.location = "<?php echo base_url('all_videos') ?>";
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