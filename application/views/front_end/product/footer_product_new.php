<style>
    .site_footer{
	background-color: #f8f8f8;
	padding: 30px 0;
}
.site_footer span{
	font-size: 20px;
	margin-bottom: 17px;
	display: block;
}
.site_footer ul{
	margin: 0px;
}
.site_footer ul li{
	padding-bottom: 15px;
}
.site_footer ul li a{
	font-size: 14px;
	color: #000;
}
.social li a{
	height: 45px;
	width: 45px;
	display: flex;
	align-items: center;
	justify-content: center;
	color: #000;
	border:#000 solid 2px
}
.social li a:hover{
	text-decoration: none;
}
.flex{
	display: flex;
}
.flex .app{
	padding:0px 5px;
}
.flex .app:first-child{
	padding-left: 0px;
}
.sm_footer{
	text-align: center;
	color: #fff;
	padding:10px 0;
	background-color: #333;
}
.sm_footer a{
	color: #fff;
} 
</style>
<?php //print_r($this->webLanguage); echo 'this is tests';?>
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
<div class="site_footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg col-md-4 col-6">
                <ul class="list-unstyled">
                    <li class="heading"><?= $this->webLanguage['LIVESTOC QUICK LINKS'] ?></li>
                    <li><a href="https://www.livestoc.com/vendor/product_vendor"><?= $this->webLanguage['Sell Products at Livestoc']?></a></li>
                    <!-- <li><a href="<?= base_url('/') ?>all_videos"><?= $this->webLanguage['Upload Video Tutorial']?></a></li> -->
                    <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Register your Champion Bull']?></a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Register as an Animal Dealer']?></a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Register as a Breeder']?></a></li>
                    <li><a href="https://www.livestoc.com/vendor/product_vendor"><?= $this->webLanguage['Register as a Semen Company']?></a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['Submit Resume at LivestocRecruiter for Job']?></a></li>
                </ul>
            </div>
            <div class="col-lg col-md-4 col-6">
                <ul class="list-unstyled">
                    <li class="heading"><?= $this->webLanguage['LIVESTOC PRO']?></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['LivestocPro']?></a></li>
                    <li><a href="<?= base_url('veterinary-doctors/homepage') ?>"><?= $this->webLanguage['Register as a Veterinarian']?></a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['Register as an AI Technician']?></a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['Register as a Paravet']?></a></li>
                    <li><a href="<?= base_url('shop') ?>"><?= $this->webLanguage['Buy Products']?></a></li>
                    <li><a href="<?= base_url('contact-us')?>"><?= $this->webLanguage['Contact Us']?></a></li>
                    
                </ul>
            </div>
            <div class="col-lg col-md-4 col-6">
                <ul class="list-unstyled">
                    <li class="heading"><?= $this->webLanguage['USEFUL LINKS']?></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['LivestocLab']?></a></li>
                    <li><a href="<?= base_url('buy-animal')?>"><?= $this->webLanguage['Buy Animals']?></a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Sell Animals']?></a></li>
                    <!-- <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['My Animals']?></a></li> -->
                    <li><a href="https://www.livestoc.com/blog"><?= $this->webLanguage['Blogs']?></a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Add Animals']?></a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Register for LivestocLab Sample Collection Center']?></a></li>
                </ul>
            </div>
            <!-- <div class="col-lg col-md-4 col-6">  -->   
                <!-- <ul class="list-unstyled">
                    <li class="heading"><?= $this->webLanguage['QUICK LINKS']?></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['Advertise Job/ Vacancies']?></a></li>
                    <li><a href="https://www.livestoc.com/frontend/register"><?= $this->webLanguage['Advertise with Us']?></a></li>
                    <li><a href="https://www.livestoc.com/frontend/wishlist"><?= $this->webLanguage['My Wishlist']?></a></li>
                    <li><a href="https://www.livestoc.com/frontend/my_order"><?= $this->webLanguage['Purchase History']?></a></li>
                    <li><a href="https://www.livestoc.com/contact"><?= $this->webLanguage['Contact Us']?></a></li> 
                </ul>  -->
            <!-- </div> -->
               <div class="col-lg col-md-4 col-12">
                <span><?= $this->webLanguage['CONTACT DETAILS']?></span>
                <ul class="list-unstyled">
                    <li><a href="#"><i class="fa fa-phone"></i> 1800 102 0379 </a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> support@livestoc.com</a></li>
                </ul> 
                <span><?= $this->webLanguage['Social Media']?></span>
                <ul class="list-unstyled social">
                    <li class="list-inline-item social"><a href="https://www.facebook.com/Livestocfarmmanagement/"><i class="fab fa-facebook-f"></i></a></li>
                     <li class="list-inline-item social"><a href="https://in.linkedin.com/company/livestoc"><i class="fa fa-linkedin"></i></a></li>
                </ul>
                <span><?= $this->webLanguage['Download the Livestoc app']?></span>
                <div class="flex">
                    <a class="app" href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en"><img src="https://www.livestoc.com/assets/home/images/google-play.png" width="100%"></a>
                    <a class="app" href="https://apps.apple.com/us/app/livestoc/id1357092418"><img src="https://www.livestoc.com/assets/home/images/app-icon.png" width="100%"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sm_footer">
    <a href="#">Livestoc</a> © 2017 - 2021. Copyright © All rights reserved.
</div>
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