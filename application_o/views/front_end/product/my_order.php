<?php 
//$cart_session = $this->session->userdata('cart_session');
$total_cart=count($cart_session);
$language = $this->api_model->get_data('code = "'.language_library.'"', 'language');
$key = $this->api_model->get_data('language_id = "'.$language[0]['id'].'"','language_library','','key');
$value = $this->api_model->get_data('language_id = "'.$language[0]['id'].'"','language_library','','description');
//echo "<pre>";
//print_r($value);
$i= 0;
foreach($key as $k){
  $detail[$k['key']] = $value[$i]['description'];
  $i++;
}
$language_library = $detail;
//$library= array_fill_keys($key, $value);
//print_r($language_library);
?>
<section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">
          <div class="col-12 px-4 px-lg-0">
  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-md-5 bg-white rounded shadow-sm mb-5 p-4">
        <?php $order_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'product_order', 'id DESC', '*'); 
        $order_count = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'product_order', '', 'count(id) as count');
        $user_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'users', '', '*');
        //print_r($order_data);
           //print_r($user_data);
          ?>
  <h3 class="pb-3"><?= $language_library['My Orders'] ?><small>(<?= $order_count[0]['count'] ?> <?= $language_library['Orders']?>)</small></h3>
  <?php foreach($order_data as $od){ 
    $product_data = $this->api_model->get_data('id = "'.$od['product_id'].'"', 'product', '', '*');
    //print_r($product_data);
    ?>                      
  <div class="orderouterbox">            
  <div class="row">
    <div class="col-md-12 orderhead">
      <div class="row">
        <div class="col-6 col-md-2">
          <h5 class="mt-4"><?= $language_library['ORDER PLACED'] ?></h5><small><?= $od['date'] ?></small>
        </div> 
        <div class="col-6 col-md-2">
          <h5 class="mt-4"><?= $language_library['Total'] ?></h5><small>RS <?= number_format($od['package_price']*$od['product_qty'],2) ?></small>
        </div>  
        <div class="col-6 col-md-2">
          <h5 class="mt-4"><?= $language_library['SHIPS TO'] ?></h5><small><?= $user_data[0]['full_name'] ?></small>
        </div> 
        <div class="col-6 col-md-2 ml-auto text-md-right text-center">
          <h5 class="mt-4"><?= $language_library['ORDER ID'] ?></h5><small>#<?= $od['id'] ?></small>
        </div>  
      </div>
    </div>
  </div>    
  <?php $image = explode(',',$product_data[0]['images']); 
  ?>
    <div class="row mt-5 mb-5 orderinfo">
        <div class="col-12 col-md-3 pl-0"><img src="<?= base_url('uploads/product/')?><?= $image[0] ?>" alt="" class="img-fluid rounded"></div>
        <div class="col-12 col-md-6 mt-3">
            <h5><?= $product_data[0]['name'] ?></h5>
            <p><strong><?= $language_library['Quantity'] ?> :</strong> <?= $od['product_qty'] ?> pcs</p>
            <p><strong><?= $language_library['Item Price'] ?> :</strong> Rs <?= number_format($od['package_price']*$od['product_qty'],2) ?></p>
            <p><strong><?= $language_library['Order Placed on'] ?> :</strong> <?= $od['date'] ?></p>
            <p><strong><?= $language_library['Delivery Date'] ?> :</strong> <?= $od['update_date'] ?> </p>
            <p class="primaryBlue"><strong><?= $language_library['Delivery Status'] ?> :</strong>
              <?php  
              // if($od['isactive'] == '1'){ 
              //   echo "Order Placed"; 
              // }
              if($od['isactive'] == '1'){
                                      echo 'Order Placed';
                                    }else if($od['isactive']== '2'){
                                      echo "Item Packed";
                                    }else if($od['isactive'] == '3'){
                                      echo "Intransite";
                                    }else if($od['isactive'] == '4'){
                                      echo "Cancelled";
                                    }else if($od['isactive'] == '5'){
                                      echo "Delivered";
                                    }
              ?></p>
              <p><strong><?= $language_library['ORDER TYPE'] ?> :</strong> <?php if($od['order_type'] == '0'){ 
                echo "CASH ON DELIVERY"; 
                }else{ echo "ONLINE"; } ?> </p>
        </div>
        
        <div class="col-12 col-md-2 ml-auto mt-4 mt-md-0">
        <?php  if($od['order_type'] == '0' && $od['order_payment_status'] == 0){  
          $data = $this->api_model->get_user_detail($this->session->userdata("users_id"));
          ?>
          <div>
          <form action="<?= base_url('frontend/product_thanku') ?>" method="POST" id="form_lat">
                                              <script
                                              src="https://checkout.razorpay.com/v1/checkout.js"
                                              data-key="rzp_test_SXDq8BpuHEWRZ8"
                                              data-amount="<?php echo $od['package_price'] *100; ?>"
                                              data-currency="INR"
                                              data-name="<?php echo $data[0]['fullname'];?>"
                                              data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                              data-description="Livestoc"
                                              data-prefill.name="<?php echo $data[0]['fullname']?>"
                                              data-prefill.email="<?php echo $data[0]['email']; ?>"
                                              data-prefill.contact="<?php echo $data[0]['mobile']?>"
                                              data-notes.purchase_id="<?= $od['log_id'] ?>"
                                              data-notes.order_id ="<?= $od['id'] ?>"
                                              data-notes.product_type="ORDER"
                                              data-notes.shopping_order_id="ps_<?= $od['log_id'] ?>"
                                              data-order_id="<?php echo $razorpayOrderId; ?>"
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $od['package_price'] ?>" <?php } ?>
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="" <?php } ?>
                                              >
                                              </script>
                                              <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                                              <input type="hidden" name="shopping_order_id" value="<?= $od['package_price']  ?>">
                                  </form>
              <script>  $( document ).ready(function() {
										//$(".razorpay-payment-button").val("Pay Now <?= $od['package_price'] ?> Rs ");
										$(".razorpay-payment-button").addClass("btn btn-dark rounded-pill check btn-block mt-4");
									});
                 
              </script>
          </div>
          <div>
          <!-- </br> -->
          <form action="<?= base_url('frontend/order_cod/') ?>" method="post">
                                    <input type="hidden" name="order_id" value="<?= $od['id'] ?>">
                                    <input type="submit" value="Pay COD" class="btn btn-dark rounded-pill check btn-block mt-4">
          </form>
          <!-- <a href="#" class="btn btn-dark rounded-pill check btn-block">Pay COD</a> -->
          </div>
        <?php } ?>
            <!-- <a href="#" class="btn btn-dark rounded-pill check btn-block">Track Order</a> -->
            <a href="<?= base_url('new_api/product_invoice/').$od['id'] ?>" target="__blank" class="btn btn-dark rounded-pill check btn-block mt-4"><?= $language_library['Invoice'] ?></a>
            <a href="<?= base_url('frontend/all_review/').$od['product_id'] ?>" class="btn btn-dark rounded-pill check btn-block mt-4"><?= $language_library['Write Review'] ?> </a>
            <!-- <a href="#" class="btn btn-dark rounded-pill check btn-block mt-4">Cancel Item</a> -->
        </div>
    </div>
<?php } ?>
   </div>
            
            
            
    </div>
</div>
    </div>
  </div>
</div>
    		</div>

			</div>
        
        
<!-- delete modal -->        
        <div class="modal fade formod" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete this product ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
              </div>
            </div>
          </div>
        </div>   
        
        
		</section>

    <?php include('footer.php'); ?>
