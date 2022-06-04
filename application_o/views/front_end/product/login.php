<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Livestoc Pro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/animate.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/aos.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/ionicons.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/icomoon.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/style.css">
    <script src="https://use.fontawesome.com/74d90de4f1.js"></script>  
    <script src="<?= base_url() ?>assets/main/js/ajaxloader.js"></script>
  </head>
  <body class="goto-here">
		<div class="py-1 bg-primary">
      <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
          <div class="col-lg-12 d-block">
            <div class="row d-flex">
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                <span class="text">1800 103 1541</span>
              </div>
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                <span class="text">support@livestoc.com</span>
              </div>
              <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                <span class="text">3-5 Business days delivery &amp; Free Returns</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="<?= base_url('frontend/product_listing') ?>">Livestoc Pro</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="<?= base_url('frontend/product_listing') ?>" class="nav-link">Home</a></li>
	          <li class="nav-item active dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="shop.html">Shop</a>
              	<a class="dropdown-item" href="wishlist.html">Wishlist</a>
                <a class="dropdown-item" href="product-single.html">Single Product</a>
                <a class="dropdown-item" href="cart.html">Cart</a>
                <a class="dropdown-item" href="checkout.html">Checkout</a>
              </div>
            </li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
              <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
              <?php if(!$this->session->userdata("users_id")){
                echo '<li class="nav-item"><a href="'.base_url().'frontend/login" class="nav-link">Login</a></li>';
              }else{
                        echo '<li class="nav-item"><a href="'.base_url().'frontend/logout" class="nav-link">Logout</a></li>';
                        echo '<li class="nav-item"><a href="blog.html" class="nav-link">'.$this->session->userdata("user_name").'</a></li>';
              } ?>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
	          <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    <section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">
    			

          <div class="px-4 px-lg-0">


  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-4 offset-4 p-5 bg-white rounded shadow-sm mb-5">

    <div class="">
      <div class="">
        <form class="login100-form validate-form" id="frm_login">
          <span class="login100-form-title p-b-26">
            Login
          </span>
          <span class="login100-form-title p-b-48 mb-5">
            <img class="img-fluid" src="<?= base_url() ?>assets/product/images/vendor_logo.png" alt="vendor_login">
          </span>

          <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
            <input class="input100" type="text" name="username" id="uname">
            <span class="focus-input100" data-placeholder="Mobile"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter passcode">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password">
            <span class="focus-input100" data-placeholder="Passcode"></span>
          </div>

          <div class="container-login100-form-btn mt-4">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" id="btnLogin">
                Login
              </button>
            </div>
          </div>

          <div class="text-center mt-2">
            <!-- <span class="txt1">
              Don’t have an account?
            </span>

            <a class="txt2" href="#">
              Sign Up
            </a> -->
          </div>
        </form>
      </div>
    </div>


        </div>
      </div>


    </div>
  </div>
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
                             window.location = "<?php echo base_url('frontend/product_listing/1') ?>";
                        }
                       });
                  }
        });
    });
		// Rs(document).ready(function(){

		// var quantitiy=0;
		//    Rs('.quantity-right-plus').click(function(e){
		        
		//         // Stop acting like a button
		//         e.preventDefault();
		//         // Get the field name
		//         var quantity = parseInt(Rs('#quantity').val());
		        
		//         // If is not undefined
		            
		//             Rs('#quantity').val(quantity + 1);

		          
		//             // Increment
		        
		//     });

		//      Rs('.quantity-left-minus').click(function(e){
		//         // Stop acting like a button
		//         e.preventDefault();
		//         // Get the field name
		//         var quantity = parseInt(Rs('#quantity').val());
		        
		//         // If is not undefined
		      
		//             // Increment
		//             if(quantity>0){
		//             Rs('#quantity').val(quantity - 1);
		//             }
		//     });
		    
		// });
	</script>
    <script>
    // jQuery(document).ready(function(){
    // // This button will increment the value
    // $('.qtyplus').click(function(e){
    //     // Stop acting like a button
    //     e.preventDefault();
    //     // Get the field name
    //     fieldName = $(this).attr('field');
    //     // Get its current value
    //     var currentVal = parseInt($('input[name='+fieldName+']').val());
    //     // If is not undefined
    //     if (!isNaN(currentVal)) {
    //         // Increment
    //         $('input[name='+fieldName+']').val(currentVal + 1);
    //     } else {
    //         // Otherwise put a 0 there
    //         $('input[name='+fieldName+']').val(0);
    //     }
    // });
    // // This button will decrement the value till 0
    // $(".qtyminus").click(function(e) {
    //     // Stop acting like a button
    //     e.preventDefault();
    //     // Get the field name
    //     fieldName = $(this).attr('field');
    //     // Get its current value
    //     var currentVal = parseInt($('input[name='+fieldName+']').val());
    //     // If it isn't undefined or its greater than 0
    //     if (!isNaN(currentVal) && currentVal > 0) {
    //         // Decrement one
    //         $('input[name='+fieldName+']').val(currentVal - 1);
    //     } else {
    //         // Otherwise put a 0 there
    //         $('input[name='+fieldName+']').val(0);
    //     }
    // });
// });
  
    </script>
      
  </body>
</html>