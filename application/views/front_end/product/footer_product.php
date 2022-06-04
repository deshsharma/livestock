    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
            <h2 style="font-size: 22px;" class="mb-0"><?= $this->webLanguage['Subscribe to our Newsletter']?></h2>
            <span><?= $this->webLanguage['Get e-mail updates about our latest shops and special offers']?></span>
          </div>
          <div class="col-md-6 d-flex align-items-center subscribe-form">
            <!-- <form action="#" class="subscribe-form"> -->
              <div class="form-group d-flex">
                <input type="text" class="form-control" id="sub_email" placeholder="<?= $this->webLanguage['Enter Email address']?>">
                <input type="submit" value="Subscribe" onclick="subs()" class="submit px-3">
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </section>
    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row">
          <div class="mouse">
            <a href="#" class="mouse-icon">
              <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
            </a>
          </div>
        </div>
        &nbsp;&nbsp;
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><?= $this->webLanguage['LIVESTOC PRO']?></h2>
              <p><?= $this->webLanguage['Connect with millions of farmers and their Animals & grow your Practice and income through direct communication.']?></p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <!-- <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li> -->
                <li class="ftco-animate"><a href="https://www.facebook.com/Livestocfarmmanagement/" target="blank"><span class="icon-facebook"></span></a></li>
               <!--  <li class="ftco-animate"><a href="https://www.instagram.com/livestocpetcare/" target="blank"><span class="icon-instagram"></span></a></li>
                <li class="ftco-animate"><a href="https://in.linkedin.com/company/livestoc/" target="blank"><span class="fa fa-linkedin"></span></a></li> -->
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2"><?= $this->webLanguage['MENU']?></h2>
              <ul class="list-unstyled">
                <li><a href="https://www.livestoc.com/" class="py-2 d-block"><?= $this->webLanguage['home']?></a></li>
                <li><a href="<?= base_url('frontend/product_listing') ?>" class="py-2 d-block"><?= $this->webLanguage['Shop']?></a></li>
                <li><a href="https://www.livestoc.com/blog/" class="py-2 d-block"><?= $this->webLanguage['blog']?></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><?= $this->webLanguage['Help']?></h2>
              <div class="d-flex">
                <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                  <!-- <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li> -->
                  <!-- <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li> -->
                  <li><a href="https://www.livestoc.com/privacy_policy" class="py-2 d-block"><?= $this->webLanguage['Privacy Policy']?></a></li>
                </ul>
                <!-- <ul class="list-unstyled">
                  <li><a href="#" class="py-2 d-block">FAQs</a></li>
                  <li><a href="#" class="py-2 d-block">Contact</a></li>
                </ul> -->
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><?= $this->webLanguage['Have Questions']?>?</h2>
              <div class="block-23 mb-3">
                <ul>
                  <!-- <li><span class="icon icon-map-marker"></span><span class="text">Phase 7, Mohali Punjab,Pannu Towers, India</span></li> -->
                  <li><a href="#"><span class="icon icon-phone"></span><span class="text">1800 102 0379</span></a></li>
                  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">support@livestoc.com</span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
        <p><?= $this->webLanguage['Copyright © All rights reserved.']?></p>
          </div>
        </div>
      </div>
    </footer>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  
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
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
  <!-- <script src="<?= base_url() ?>assets/product/js/google-map.js"></script> -->
  <script src="<?= base_url() ?>assets/product/js/main.js"></script>
  <script src="<?= base_url() ?>/assets/app/js/cart.js"></script>
  <script>
       <?php if($this->session->userdata("users_id")){ ?>
  function like(product_id, price, pack){
	var user_id = <?= $this->session->userdata("users_id") ?>;
	var type = "<?php echo $this->session->userdata("user_type"); ?>";
  var qty = '1';
	$.ajax({
			type: "POST",
			url: "<?= base_url('frontend/') ?>"+"add_like",
			data: { product_id: product_id, user_id: user_id, type: type, pack_id: pack, pack_price: price, qty: qty},
			dataType: "json",
			cache : false,
			success: function(data){
				alert(data.msg);
			} 
		});
  }
<?php } ?>
  function subs(){
    var email = $('#sub_email').val();
    if(isValidEmailAddress(email))
    {
        $.ajax({
          type: "POST",
          url: "<?= base_url('frontend/') ?>"+"add_subscriber",
          data: { email: email},
          dataType: "json",
          cache : false,
          success: function(data){
            alert(data.msg);
          } 
        });
    } else {
        alert('Please enter valid email');
    }
  }
  function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
  function intrested_to_buy(id){
	var user_id = "<?= $this->session->userdata("users_id") ?>";
	var type = "<?php echo $this->session->userdata("user_type"); ?>"
	$.ajax({
			type: "POST",
			url: "<?= base_url('frontend/') ?>"+"add_interested",
			data: { product_id: id, user_id: user_id, type: type},
			dataType: "json",
			cache : false,
			success: function(data){
				alert(data.msg);
			} 
		});
  }
  function cart(product_id, price, pack, user_id, user_type){
    app_url = "<?= base_url('/frontend'); ?>";
     if(user_id == '0'){
      window.location.href = "<?= base_url() ?>frontend/login";
    }else{
      cart_add(product_id, pack, price, '1',user_id, user_type);
    }
  }
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
            

              $('.dropdown-submenu a.test').on("click", function(e){
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
              });
            
            
         jQuery(document).ready(function($){
          $(".filterexpand").click(function()
          {
            $(".filtercontent").slideToggle('slow');
          });  
        });
		  
        $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                autoplay : true,
                dots: false,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 1,
                    nav: false,
                    loop: true,
                    margin: 20
                  }
                }
              })    
            
		});
	</script>
  </body>
</html>