    <!-- END nav -->
<?php
  $product_detail = $data; 
  $cart_session = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart', '', 'count(id) as count');
$total_cart=$cart_session[0]['count'];
  //print_r($_SESSION);
  if($this->session->userdata("users_id") == ''){
    redirect(base_url());
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
              <?php 
            //   echo "<pre>";
            //    print_r($product_detail);
            //   print_r($data['payment_detail']);
            ?>
              <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"><?= $this->webLanguage['Order summary']?> </div>
              <div class="p-4">
                <p class="font-italic mb-4"><?= $this->webLanguage['Shipping and additional costs are calculated based on values you have entered.']?></p>
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-4">
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Order Subtotal']?> </strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?=  number_format($product_detail['payment_detail'][0]['value'], 2) ?></strong></li>
                          <?php //$tax =$this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage');     
                          $total_tax = ($product_detail['payment_detail'][0]['value'] * ($product_detail['payment_detail'][1]['value'] / 100))
                          ?>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong><?php echo $this->webLanguage['Tax'].'('.$data['payment_detail'][1]['value'].')'.'%'; ?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                              <use xlink:href="#rupee"></use>
                              </svg><?php echo number_format($total_tax , 2);
                              $round_price = $product_detail['payment_detail'][0]['value'] + $total_tax;
                              ?></strong></li>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $product_detail['payment_detail'][2]['name']?> </strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?=  number_format($product_detail['payment_detail'][2]['value'], 2) ?></strong></li>
                    <?php 
                    
                     $total_price += $total_tax;
                     $wallet = 0;
                     $wall = 0;
                     if($wallet < $round_price){ 
                        // if($dis != '1'){
                        //   ?>
                         <script>
                        //   alert('No Dealer available in your area');
                        //   window.location = "<?= base_url('frontend/product_listing') ?>"
                        //   </script>
                         <?php 
                         
                        // }else{
                       ?>
                                        <!-- <li class="d-flex justify-content-between py-3 border-bottom"><strong>Wallet</strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                            <use xlink:href="#rupee"></use>
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Total']?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                        <use xlink:href="#rupee"></use> -->
                                        <!-- </svg><?php echo number_format($round_price - $wall, 2); $tamount = $round_price - $product_detail['payment_detail'][2]['value']; ?></strong></li> -->
                  </ul>
                                  <div class="col-lg-12 pad">
                                      <p class="font-italic mb-4"><strong><?= $this->webLanguage['TOTAL AMOUNT']?> : <?= $round_price ?></p></strong>
                                  </div>
                                  <div class="col-lg-12 pad">
                                    <div class="row">   
                                      <div class="col-12 col-md-12">
                                        <form action="<?= base_url('frontend/product_thanku') ?>" method="POST" id="form_lat">
                                              <script
                                              src="https://checkout.razorpay.com/v1/checkout.js"
                                              data-key="rzp_live_HFeWEikeCbWtZ2"
                                              data-amount="<?php echo $tamount*100; ?>"
                                              data-currency="INR"
                                              data-order_id="<?= $product_detail['data']['0']['razorpayOrderId'] ?>"
                                              data-shopping_order_id="<?= $product_detail['data']['0']['order_id'] ?>"
                                              data-name="<?php echo $data[0]['fullname'];?>"    
                                              data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                              data-description="Sample Collection Center Application Form"
                                              data-prefill.name="<?php echo $data[0]['fullname']?>"
                                              data-prefill.email="<?php echo $data[0]['email']; ?>"
                                              data-prefill.contact="<?php echo $data[0]['mobile']?>"
                                              data-notes.purchase_id="<?= $product_detail['data']['0']['purchase_id'] ?>"
                                              data-notes.shopping_order_id="<?= $product_detail['data']['0']['order_id'] ?>"
                                              data-notes.bank_id="<?= $this->session->userdata("users_id") ?>"
                                              data-notes.user_type="23"
                                              data-notes.type="23"
                                              data-notes.payment_type="23"
                                              data-notes.wallet_balance_consume="<?= $product_detail['wallet_balance_consume'] ?>"
                                              data-notes.reg_no="<?= $product_detail['reg_no'] ?>"
                                              data-notes.product_type="LAB_REG"
                                              data-order_id="<?php echo $razorpayOrderId; ?>"
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $tamount ?>" <?php } ?>
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="" <?php } ?>
                                              >
                                              </script>
                                              <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                                              <input type="hidden" name="shopping_order_id" value="<?= $tamount ?>">
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                <?php } 
                                  //  } 
                               if($wallet >= $round_price){

                              ?>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Wallet']?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                            <use xlink:href="#rupee"></use>
                            </svg><?= $wall = number_format($round_price, 2) ?></strong></li>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Total']?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                            <use xlink:href="#rupee"></use>
                          </svg><?php echo number_format($round_price, 2); $tamount = $round_price - $wallet[0]['sum']; ?></strong></li>
                  </ul>
                  <div class="col-lg-12 pad" id="lat_demo">
                      <p class="font-italic mb-4"><strong><?= $this->webLanguage['TOTAL AMOUNT']?>:  <svg class="w3" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?= number_format($round_price, 2) ?></p></strong>
                  </div>
                  <?php 
                    $log_data['users_id'] = $data[0]['users_id'];
                    $log_data['currency'] = 'INR';
                    $log_data['user_type'] = $this->session->userdata("user_type");
                    $log_data['amount'] = $round_price;
                    $log_data['package_id'] = $product_id;
                    $log_data['type'] = '14';
                    $log_data['status'] = '0';
                    $log_data['tax'] = $app_tax;
                    $log = $this->api_model->submit('log_file',$log_data);
                  ?>
                   <?php 
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
      </div>
    </section>
 <?php //include('footer_product.php'); ?>
   <script>
   var x = $("#lat_demo");
   $(document).ready(function(){
    getLocation();
   })
      function getLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
              alert("Geolocation is not supported by this browser.");
          }
      }

      function showPosition(position) {
        $('#form_lat script').attr('data-notes.lat', position.coords.latitude);
        $('#form_lat script').attr('data-notes.long', position.coords.longitude);
          //alert("Latitude: " + position.coords.latitude +  "<br>Longitude: " + position.coords.longitude);
      }
   </script>
   <script>  $( document ).ready(function() {
                    $(".razorpay-payment-button").val("<?= $this->webLanguage['Pay Now']?> <?= $this->webLanguage['Rs']?> 15930 ");
                    $(".razorpay-payment-button").addClass("btn btn-dark rounded-pill check btn-block");
                  });
                 
                  </script>
  <script>
      
    $(document).ready(function(){

    var quantitiy=0;
       $('.quantity-right-plus').click(function(e){
            
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
                
                Rs('#quantity').val(quantity + 1);

              
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