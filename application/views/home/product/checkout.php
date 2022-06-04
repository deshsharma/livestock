
    <!-- END nav -->
	<?php
	if($this->session->userdata("users_id") == ''){
		redirect(base_url('frontend/product_listing'));
	}else{
		$data = $this->api_model->get_user_detail($this->session->userdata("users_id"));
	}	 
	?>
    <section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">
                    <div class="col-12 px-4 px-lg-0">
    <div class="pb-5">
    <div class="container">
      <div class="row">
	  					<?php $cart_session = $this->session->userdata('cart_session');
                          $price = 0;
                          $i = 0;
                          foreach($cart_session as $k=>$cart)
                          { 
                           
							$products = $this->front_end_model->get_product_id($cart['product_id']);
              if(!empty($products[0]['video_id'])) {
                $videoDetails = $this->front_end_model->get_video_details($products[0]['video_id']);
                $videoDetailsPrice = $videoDetails[0]['price'];
              } else {
                $videoDetailsPrice = 0;  
              }
							$image = explode(',',$products[0]['images']);
							$price = $this->api_model->get_data('id = "'.$cart['pack_price'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
							if($this->session->userdata("user_type") == 0){
                if($i==0){
                  $product_id = $cart['product_id']; 
                  $package_id = $cart['pack_id'];
                  $package_price = $cart['pack_price']+$videoDetailsPrice;
                  $product_qty = $cart['qty'];
                }else{
                  $product_id .=','.$cart['product_id'];
                  $package_id .=','.$cart['pack_id'];
                  $package_price .=','.$cart['pack_price']+$videoDetailsPrice;
                  $product_qty .=','.$cart['qty'];
                }
								//echo number_format($price[0]['sale_price']*$cart['qty'],2);
								$total_price += number_format(($price[0]['sale_price']+$videoDetailsPrice)*$cart['qty'],2);
							}else{
                if($i==0){
                  $product_id = $cart['product_id']; 
                  $package_id = $cart['pack_id'];
                  $package_price = $cart['pack_price']+$videoDetailsPrice;
                  $product_qty = $cart['qty'];
                }else{
                  $product_id .=','.$cart['product_id'];
                  $package_id .=','.$cart['pack_id'];
                  $package_price .=','.$cart['pack_price']+$videoDetailsPrice;
                  $product_qty .=','.$cart['qty'];
                }
								//echo number_format($price[0]['vt_sale_price']*$cart['qty'],2);
								$total_price += number_format(($price[0]['vt_sale_price']+$videoDetailsPrice)*$cart['qty'],2);
							}
						  }
						?>
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
          <div class="p-4">
            <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
              <div class="col-lg-6">
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong>Order Subtotal </strong><strong class="text-right"><svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?=  number_format($total_price, 2) ?></strong></li>             
						<?php $tax =$this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage'); 
                                  ?>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong>Tax</strong><strong class="text-right"><svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?= $app_tax = number_format($total_price*($tax[0]['tax_percentage']/100), 2)  ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong>Total</strong><strong class="text-right"><svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?= $tamount = number_format($app_tax + $total_price, 2) ?></strong></li>
                  </ul>
                  
                   <div class="col-lg-12 pad">
                      <p class="font-italic mb-4"><strong>TOTAL AMOUNT:  <svg class="w3" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?= $tamount ?></p></strong>
                  </div>
                  <?php 
                    $log_data['users_id'] = $data[0]['users_id'];
                    $log_data['currency'] = 'INR';
                    $log_data['user_type'] = $this->session->userdata("user_type");
                    $log_data['amount'] = $tamount;
                    $log_data['package_id'] = $product_id;
                    $log_data['type'] = '14';
                    $log_data['status'] = '0';
                    $log_data['tax'] = $app_tax;
                    $log = $this->api_model->submit('log_file',$log_data);
                  ?>
             <div class="col-lg-6 pad">   
                <form action="<?= base_url('frontend/product_thanku') ?>" method="POST">
                              <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="rzp_live_HFeWEikeCbWtZ2"
                                data-amount="<?=$tamount*100;?>"
                                data-currency="INR"
                                data-name="<?=$data[0]['fullname'];?>"
                                data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                data-description="Livestoc"
                                data-prefill.name="<?= $tamount*100;?>"
                                data-prefill.email="<?= $data[0]['email']; ?>"
                                data-prefill.contact="<?= $data[0]['mobile']; ?>"
                                data-notes.purchase_id="<?= $log ?>"
                                data-notes.product_id="<?= $product_id ?>"
                                data-notes.package_id="<?= $package_id ?>"
                                data-notes.package_price="<?= $package_price ?>"
                                data-notes.users_id="<?= $this->session->userdata("users_id") ?>"
                                data-notes.user_type="<?= $this->session->userdata("user_type") ?>"
                                data-notes.product_qty="<?= $product_qty ?>"
                                data-notes.product_type="ECOM"
                                data-notes.shopping_order_id="ps_<?= $log ?>"
                                <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?= $tamount ?>" <?php } ?>
                                <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="INR" <?php } ?>
                              >
                              </script>
                              <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                              <input type="hidden" name="shopping_order_id" value="<?= $tamount ?>">
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
			</div>
    </section>
   <?php include('footer.php'); ?>
   <script>  $( document ).ready(function() {
										$(".razorpay-payment-button").val("Pay Now <?= $tamount ?> Rs ");
										$(".razorpay-payment-button").addClass("btn btn-dark rounded-pill check btn-block");
									});</script>
  <script>
		Rs(document).ready(function(){

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