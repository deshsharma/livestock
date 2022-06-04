<style>
    .shopping-cart{
	padding-bottom: 50px;
	font-family: 'Montserrat', sans-serif;
}

.shopping-cart.dark{
	background-color: #c7e5f5;
}

.shopping-cart .content{
	box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
	background-color: white;
}

.shopping-cart .block-heading{
    padding-top: 50px;
    margin-bottom: 40px;
    text-align: center;
}

.shopping-cart .block-heading p{
	text-align: center;
	max-width: 420px;
	margin: auto;
	opacity:0.7;
}

.shopping-cart .dark .block-heading p{
	opacity:0.8;
}

.shopping-cart .block-heading h1,
.shopping-cart .block-heading h2,
.shopping-cart .block-heading h3 {
	margin-bottom:1.2rem;
	color: #3b99e0;
}

.shopping-cart .items{
	margin: auto;
}

.shopping-cart .items .product{
	margin-bottom: 20px;
	padding-top: 20px;
	padding-bottom: 20px;
}

.shopping-cart .items .product .info{
	padding-top: 0px;
	text-align: center;
}

.shopping-cart .items .product .info .product-name{
	font-weight: 600;
}

.shopping-cart .items .product .info .product-name .product-info{
	font-size: 14px;
	margin-top: 15px;
}

.shopping-cart .items .product .info .product-name .product-info .value{
	font-weight: 400;
}

.shopping-cart .items .product .info .quantity .quantity-input{
    margin: auto;
    width: 80px;
}

.shopping-cart .items .product .info .price{
	margin-top: 15px;
    font-weight: bold;
    font-size: 22px;
 }

.shopping-cart .summary{
	border-top: 2px solid #5ea4f3;
    background-color: #f7fbff;
    height: 100%;
    padding: 30px;
}

.shopping-cart .summary h3{
	text-align: center;
	font-size: 1.3em;
	font-weight: 600;
	padding-top: 20px;
	padding-bottom: 20px;
}

.shopping-cart .summary .summary-item:not(:last-of-type){
	padding-bottom: 10px;
	padding-top: 10px;
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.shopping-cart .summary .text{
	font-size: 1em;
	font-weight: 600;
}

.shopping-cart .summary .price{
	font-size: 1em;
	float: right;
}

.shopping-cart .summary button{
	margin-top: 20px;
}

@media (min-width: 768px) {
	.shopping-cart .items .product .info {
		padding-top: 25px;
		text-align: left; 
	}

	.shopping-cart .items .product .info .price {
		font-weight: bold;
		font-size: 22px;
		top: 17px; 
	}

	.shopping-cart .items .product .info .quantity {
		text-align: center; 
	}
	.shopping-cart .items .product .info .quantity .quantity-input {
		padding: 4px 10px;
		text-align: center; 
	}
}

</style>
<?php
  $product_detail = $data; 
  $cart_session = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart', '', 'count(id) as count');
$total_cart=$cart_session[0]['count'];
  //print_r($_SESSION);
  if($this->session->userdata("users_id") == ''){
    redirect(base_url());
  }else{
    $data = $this->api_model->get_user_detail($this->session->userdata("users_id"));
	//print_r($data);
	//echo $data[0]['fullname'];
  }  
  ?>
   <?php 
            //   echo "<pre>";
            //    print_r($product_detail);
            //   print_r($data['payment_detail']);
            $gst_per = $product_detail['payment_detail'][1]['value'];
            $gst_name = $product_detail['payment_detail'][1]['name'];
            $total_tax = ($product_detail['payment_detail'][0]['value'] * ($product_detail['payment_detail'][1]['value'] / 100));
            //print_r($total_tax);
            $round_price = ($product_detail['payment_detail'][0]['value'] + $total_tax) -($product_detail['payment_detail'][2]['value']);
            $rozar_id = $product_detail['data'][0]['razorpayOrderId'];
			$parchase_id = $product_detail['data'][0]['purchase_id'];

			//print_r($parchase_id);

            ?>
<main class="page">
	 	<section class="shopping-cart dark">
	 		<div class="container">
		        <div class="block-heading">
		        </div>
		        <div class="content">
	 				<div class="row">
			 			<div class="col-md-12 col-lg-12">
			 				<div class="summary">
			 					<h3>ORDER SUMMARY</h3>
								<p>Shipping and additional costs are calculated based on values you have entered.</p>
			 					<div class="summary-item"><span class="text">Sub Total</span><span class="price">Rs <?=  number_format($product_detail['payment_detail'][0]['value'], 2) ?></span></div>
								<?php if($gst_per != ''){?><div class="summary-item"><span class="text"><?= $gst_name ?><?= $gst_per ?></span><span class="price"><?= $total_tax?></span></div><?php }?>
								<div class="summary-item"><span class="text">Wallet balance used</span><span class="price">Rs <?=  number_format($product_detail['payment_detail'][2]['value'], 2) ?></span></div>
			 					<div class="summary-item"><span class="text">Total</span><span class="price">Rs <?= $round_price?></span></div>
								 <form action="<?= base_url('frontend/product_thanku') ?>" method="POST" id="form_lat">
                                              <script
                                              src="https://checkout.razorpay.com/v1/checkout.js"
                                              data-key="rzp_test_SXDq8BpuHEWRZ8"
                                              data-amount="<?php echo $tamount*100; ?>"
                                              data-currency="INR"
                                              data-order_id="<?= $product_detail['data'][0]['razorpayOrderId'] ?>"
                                              data-shopping_order_id="<?= $product_detail['data'][0]['order_id'] ?>"
                                              data-name="<?php echo $data[0]['fullname']; ?>"    
                                              data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                              data-description="Sample Collection Center Application Form"
                                              data-prefill.name="<?php echo $data[0]['fullname'];?>"
                                              data-prefill.email="<?php echo $data[0]['email']; ?>"
                                              data-prefill.contact="<?php echo $data[0]['mobile']; ?>"
                                              data-notes.purchase_id="<?= $round_price ?>"
                                              data-notes.shopping_order_id="<?= $product_detail['data'][0]['order_id'] ?>"
                                              data-notes.bank_id="<?= $this->session->userdata("users_id") ?>"
                                              data-notes.user_type="23"
                                              data-notes.type="23"
                                              data-notes.payment_type="23"
                                              data-notes.wallet_balance_consume="<?= $product_detail['wallet_balance_consume'] ?>"
                                              data-notes.reg_no="<?= $product_detail['reg_no'] ?>"
                                              data-notes.product_type="LAB_REG"
                                              data-order_id="<?php echo $rozar_id; ?>"
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $round_price ?>" <?php } ?>
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="" <?php } ?>
                                              >
                                              </script>
                                              <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                                              <input type="hidden" name="shopping_order_id" value="<?= $round_price ?>">
											  <!-- <button type="button" class="btn btn-primary btn-lg btn-block">Pay Now <?= $round_price ?></button> -->
                                  </form>
			 					
				 			</div>
			 			</div>
		 			</div> 
		 		</div>
	 		</div>
		</section>
	</main>

<script>
  $( document ).ready(function() {
                    $(".razorpay-payment-button").val("<?= $this->webLanguage['Pay Now']?> <?= $this->webLanguage['Rs']?> <?= $round_price ?> ");
                    $(".razorpay-payment-button").addClass("btn btn-primary btn-lg btn-block");
                  });
                 
                  
</script>