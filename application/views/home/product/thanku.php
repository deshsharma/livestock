<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Livestoc</title>
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
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/style2.css">  
    <script src="https://use.fontawesome.com/74d90de4f1.js"></script>  
  </head>
  <body class="goto-here"> 
    <section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">
                    <div class="col-12 px-4 px-lg-0">
    <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5 text-center">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold f5rem">Thankyou!!! </div>
          <div class="p-4">
            <p class="font-italic mb-4">Your order has been successfully Placed.</p>
            <?php 
            $cart_session = $this->session->userdata('cart_session');
            foreach($cart_session as $k=>$cart)
            {
              $products = $this->front_end_model->get_product_id($cart['product_id']);
              if(!empty($products[0]['video_id'])) {
                $videoisactivated['isactivated'] = '1';
                $videoDetails = $this->front_end_model->update_video_details_isactivated($products[0]['video_id'],  $videoisactivated);
              }
            }
            ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
                </div>
			</div>
    </section>



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
  window.setTimeout(function() {
        location.href = '<?= base_url('/frontend/product_listing') ?>';
    }, 2000);
		Rs(document).ready(function(){
<?php
  $this->session->unset_userdata('cart_session');
  ?>
		var quantitiy=0;
		   Rs('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt(Rs('#quantity').val());
		        
		        // If is not undefined
		            
		            Rs('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     Rs('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt(Rs('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            Rs('#quantity').val(quantity - 1);
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