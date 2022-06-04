    <!-- END nav -->
<?php
  $cart_session = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart', '', 'count(id) as count');
$total_cart=$cart_session[0]['count'];
  //print_r($_SESSION);
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
              <?php 
                    if($total_cart > '1'){
                            redirect(base_url('frontend/product_listing'));
                          } 
                          $cart_ses = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart');
                    //$cart_session = $this->session->userdata('cart_session');
                          $price = 0;
                          $i = 0;
                          $form_lat = $this->input->get_post("form_lat");
                          $form_lang = $this->input->get_post("form_lang");
                          $address_id = $this->input->get_post("address_id");
                          foreach($cart_ses as $k=>$cart)
                          { 
                            $products = $this->front_end_model->get_product_id($cart['product_id']);
                            $image = explode(',',$products[0]['images']);
                            $price = $this->api_model->get_data('product_id = "'.$cart['product_id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
                            if($this->session->userdata("user_type") == 0){
                              if($i==0){
                                $product_id = $cart['product_id']; 
                                $package_id = $cart['pack_id'];
                                $package_price = $cart['pack_price'];
                                $product_qty = $cart['qty'];
                              }else{
                                $product_id .=','.$cart['product_id'];
                                $package_id .=','.$cart['pack_id'];
                                $package_price .=','.$cart['pack_price'];
                                $product_qty .=','.$cart['qty'];
                              }
                              //echo number_format($price[0]['sale_price']*$cart['qty'],2);
                              $total_price += ($price[0]['sale_price'])*$cart['qty'];
                            }else{
                              if($i==0){
                                $product_id = $cart['product_id']; 
                                $package_id = $cart['pack_id'];
                                $package_price = $cart['pack_price'];
                                $product_qty = $cart['qty'];
                              }else{
                                $product_id .=','.$cart['product_id'];
                                $package_id .=','.$cart['pack_id'];
                                $package_price .=','.$cart['pack_price'];
                                $product_qty .=','.$cart['qty'];
                              }
                              //echo number_format($price[0]['vt_sale_price']*$cart['qty'],2);
                              $total_price += ($price[0]['vt_sale_price'])*$cart['qty'];
                              $total_tax += ($total_price*($products[0]['gst']/100));
                            }
                            $product = $this->api_model->get_data('id = "'.$cart['product_id'].'"','product');
                            $dis = '';
                            $distributor = '';
                            if($product[0]['hub'] == '0'){
                                $distributer = $this->api_model->query_build('SELECT `admin_id`, IFNULL(( 3959 * acos( cos( radians('.round($form_lat, 4).') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians ('.round($form_lang, 4).') ) + sin( radians('.round($form_lat, 4).') ) * sin( radians( latitude ) ) ) ), 0) AS distance FROM `admin` WHERE `super_admin_id` = '.$product[0]['user'].' having distance < 10');
                               
                                foreach($distributer as $dist){
                                   $dis = '1';
                                }
                            }
                            $i++;
              }
             //echo $total_price;
            ?>
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"><?= $this->webLanguage['Order summary']?> </div>
          <div class="p-4">
            <p class="font-italic mb-4"><?= $this->webLanguage['Shipping and additional costs are calculated based on values you have entered.']?></p>
              <div class="col-lg-12">
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Order Subtotal']?> </strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?=  number_format($total_price, 2) ?></strong></li>
              <!-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="w50">Shipping and handling</strong><strong class="text-right"><svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>Rs10.00</strong></li> -->
            <?php $tax =$this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage');     ?>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Tax']?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                              <use xlink:href="#rupee"></use>
                              </svg><?php echo number_format($total_tax, 2); $app_tax = $total_tax;
                              $round_price = $total_price + $app_tax;
                              ?></strong></li>
                    <?php //$wallet_cr = $this->api_model->get_data('users_id = "'.$_SESSION['users_id'].'" AND status = "Cr" AND wallet_type = "1"', 'livestoc_wallets','','sum(amount) as sum');
                   // $wallet_dr = $this->api_model->get_data('users_id = "'.$_SESSION['users_id'].'" AND status = "Dr" AND wallet_type = "1"', 'livestoc_wallets','','sum(amount) as sum');
                     //print_r($wallet_dr);
                     //$wallet = $wallet_cr[0]['sum'] - $wallet_dr[0]['sum'];
                    
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
                                            </svg><?= number_format($wallet, 2) ?></strong></li> -->
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Total']?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                        <use xlink:href="#rupee"></use>
                                        </svg><?php echo number_format($round_price - $wall, 2); $tamount = $round_price - $wallet; ?></strong></li>
                                  </ul>
                                  <div class="col-lg-12 pad">
                                      <p class="font-italic mb-4"><strong><?= $this->webLanguage['TOTAL AMOUNT']?> :  <svg class="w3" x="0px" y="0px" viewBox="0 0 500 500">
                                        <use xlink:href="#rupee"></use>
                                        </svg><?= $tamount ?></p></strong>
                                  </div>
                                  <?php 
                                    $log_data['users_id'] = $data[0]['users_id'];
                                    $log_data['currency'] = 'INR';
                                    $log_data['user_type'] = $this->session->userdata("user_type");
                                    $log_data['amount'] = $total_price;
                                    $log_data['package_id'] = $product_id;
                                    $log_data['type'] = '14';
                                    $log_data['status'] = '0';
                                    $log_data['tax'] = $app_tax;
                                    $log = $this->api_model->submit('log_file',$log_data);
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                      CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$log."&amount=".$tamount."&currency='INR'",
                                      CURLOPT_RETURNTRANSFER => true,
                                      CURLOPT_ENCODING => "",
                                      CURLOPT_MAXREDIRS => 10,
                                      CURLOPT_TIMEOUT => 30,
                                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                      CURLOPT_CUSTOMREQUEST => "GET",
                                      CURLOPT_HTTPHEADER => array(
                                        "Accept: */*",
                                        "Accept-Encoding: gzip, deflate",
                                        "Cache-Control: no-cache",
                                        "Connection: keep-alive",
                                        "Cookie: PHPSESSID=pd76811dvepd0ao972vfg5abi4; ci_session=pmsh0l1ish4521b781egnuj41galc4uj",
                                        "Host: www.livestoc.com",
                                        "Postman-Token: 91f7b6cf-efc3-4c86-a7ec-f27f9e4f829f,ef189fb4-d157-44d2-ba00-804ee44657e4",
                                        "User-Agent: PostmanRuntime/7.15.2",
                                        "cache-control: no-cache"
                                      ),
                                    ));
                                    $response = curl_exec($curl);
                                    $err = curl_error($curl);
                                    curl_close($curl);                                 
                                    $razorpayOrderId =  json_decode($response);
                                  ?>
                                  <div class="col-lg-12 pad">
                                  <div class="row">   
                                  <div class="col-12 col-md-8">
                                    <form action="<?= base_url('frontend/product_thanku') ?>" method="POST" id="form_lat">
                                              <script
                                              src="https://checkout.razorpay.com/v1/checkout.js"
                                              data-key="rzp_live_HFeWEikeCbWtZ2"
                                              data-amount="<?php echo $tamount*100; ?>"
                                              data-currency="INR"
                                              data-name="<?php echo $data[0]['fullname'];?>"
                                              data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                              data-description="Livestoc"
                                              data-prefill.name="<?php echo $data[0]['fullname']?>"
                                              data-prefill.email="<?php echo $data[0]['email']; ?>"
                                              data-prefill.contact="<?php echo $data[0]['mobile']?>"
                                              data-notes.purchase_id="<?= $log ?>"
                                              data-notes.product_id="<?= $product_id ?>"
                                              data-notes.package_id="<?= $package_id ?>"
                                              data-notes.package_price="<?= $package_price ?>"
                                              data-notes.tax="<?= $app_tax ?>"
                                              data-notes.users_id="<?= $this->session->userdata("users_id") ?>"
                                              data-notes.address_id="<?= $address_id ?>"
                                              data-notes.wallet="<?php echo $wallet; ?>"
                                              data-notes.user_type="<?= $this->session->userdata("user_type") ?>"
                                              data-notes.product_qty="<?= $product_qty ?>"
                                              data-notes.latitude="<?= $form_lat ?>"
                                              data-notes.langitude="<?= $form_lang ?>"
                                              data-notes.product_type="ECOM_WEB"
                                              data-notes.shopping_order_id="ps_<?= $log ?>"
                                              data-order_id="<?php echo $razorpayOrderId; ?>"
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $tamount ?>" <?php } ?>
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="" <?php } ?>
                                              >
                                              </script>
                                              <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                                              <input type="hidden" name="shopping_order_id" value="<?= $tamount ?>">
                                  </form>
                                  </div>
                                  <div class="col-12 col-md-4">
                                    <form action="<?= base_url('frontend/cash_on_delivery/') ?>" method="post">
                                    <input type="hidden" name="shopping_order_id" value="<?= $log ?>">
                                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                    <input type="hidden" name="address_id" value="<?= $address_id ?>">
                                    <input type="hidden" name="package_id" value="<?= $package_id ?>">
                                    <input type="hidden" name="package_price" value="<?= $package_price ?>">
                                    <input type="hidden" name="users_id" value="<?= $this->session->userdata("users_id") ?>">
                                    <input type="hidden" name="user_type" value="<?= $this->session->userdata("user_type") ?>">
                                    <input type="hidden" name="product_qty" value="<?= $product_qty ?>">
                                    <input type="hidden" name="wall" value="<?= $wallet ?>">
                                    <input type="hidden" name="latitude" value="<?= $form_lat ?>">
                                    <input type="hidden" name="langitude" value="<?= $form_lang ?>">
                                    <input type="hidden" name="amount" value="<?= $round_price ?>">
                                    <input type="submit" value="<?= $this->webLanguage['Cash On Delivery']?>" class="btn btn-dark rounded-pill check btn-block">
                                    </form>
                                  </div>
                                  </div>
                            <!-- <a href="#" class="btn btn-dark rounded-pill check btn-block">PAY NOW</a> -->
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
                  <form method="post">
                    <input type="hidden" name="shopping_order_id" value="<?= $log ?>">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                    <input type="hidden" name="package_id" value="<?= $package_id ?>">
                    <input type="hidden" name="address_id" value="<?= $address_id ?>">
                    <input type="hidden" name="package_price" value="<?= $package_price ?>">
                    <input type="hidden" name="users_id" value="<?= $this->session->userdata("users_id") ?>">
                    <input type="hidden" name="user_type" value="<?= $this->session->userdata("user_type") ?>">
                    <input type="hidden" name="product_qty" value="<?= $product_qty ?>">
                    <input type="hidden" name="wall" value="<?= $round_price ?>">
                    <input type="hidden" name="amount" value="<?= $round_price ?>">
                    <div class="row">   
                          <div class="col-12 col-md-8">
                              <input type="submit" name="submit" class="btn btn-dark rounded-pill check btn-block" value="<?= $this->webLanguage['Pay Now']?> <?= number_format($round_price, 2) ?> Rs">
                          </div>
                          <div class="col-12 col-md-4">
                              <input type="submit" value="<?= $this->webLanguage['Cash On Delivery']?>" class=" btn btn-dark rounded-pill check btn-block">
                          </div>
                    </div>
                  </form>
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
 <?php include('footer_product.php'); ?>
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
                    $(".razorpay-payment-button").val("<?= $this->webLanguage['Pay Now']?> <?= $this->webLanguage['Rs']?> <?= $tamount ?> ");
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