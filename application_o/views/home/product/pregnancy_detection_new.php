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
//   echo "<pre>";
//    print_r($product_detail);
//    print_r($product_detail['no_of_non_premium_animal']);
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
			 					<div class="summary-item"><span class="text"><?= $product_detail['payment_detail'][0][name] ?></span><span class="price">&#8377; <?=  $product_detail['payment_detail'][0][value] ?></span></div>
                                 <div class="summary-item"><span class="text"><?= $product_detail['payment_detail'][1][name] ?></span><span class="price"><?=  $product_detail['payment_detail'][1][value] ?></span></div>
								<div class="summary-item"><span class="text">Wallet balance used</span><span class="price">&#8377; <?=  $product_detail[wallet_balance_consume] ?></span></div>
			 					<div class="summary-item"><span class="text">Total Amount</span><span class="price">&#8377; <?=  $product_detail['actual_pay_amount'] ?></span></div>
                      <div class="col-12 col-md-12">
                          <form action="<?= base_url('frontend/product_thanku') ?>" method="POST" id="form_lat">
								 
                                              <script
                                              src="https://checkout.razorpay.com/v1/checkout.js"
                                              data-key="rzp_test_SXDq8BpuHEWRZ8"
                                              data-amount="<?php echo $product_detail[actual_pay_amount]*100; ?>"
                                              data-currency="INR"
                                              data-order_id=""
                                              data-name="<?php echo $data[0]['fullname']; ?>"    
                                              data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                              data-description="Lab Collection Center Application Form"
                                              data-prefill.name="<?php echo $data[0]['fullname'];?>"
                                              data-prefill.email="<?php echo $data[0]['email']; ?>"
                                              data-prefill.contact="<?php echo $data[0]['mobile']; ?>"
                                              data-notes.purchase_id="<?= $product_detail[data][0]['purchase_id'] ?>"
                                              data-notes.bank_id="<?= $this->session->userdata("users_id") ?>"
                                              data-notes.shopping_order_id="<?= $product_detail['data'][0]['order_id'] ?>"
                                              data-notes.user_type="24"
                                              data-notes.type="24"
                                              data-notes.payment_type="24"
                                              data-notes.premium_type="0"
                                              data-notes.lab_id="<?= $product_detail[lab_id]?>"
                                              data-notes.no_of_non_premium_animal="<?= $product_detail['no_of_non_premium_animal']?>"
                                              data-notes.no_of_premium_animal="<?= $product_detail['no_of_premium_animal']?>"
                                              data-notes.no_of_sample="<?= $product_detail[no_of_semp]?>"
                                              data-notes.wallet_balance_consume="<?= $product_detail['wallet_balance_consume'] ?>"
                                              data-notes.reg_no="<?= $product_detail['reg_no'] ?>"
                                              data-notes.product_type="LAB_TEST"
                                              data-order_id="<?php echo $rozar_id; ?>"
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $product_detail[actual_pay_amount] ?>" <?php } ?>
                                              <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="" <?php } ?>
                                              >
                                              </script>
                                              <input type="hidden" name="shopping_order_id" value="<?=  $product_detail[data][0]['order_id'] ?>">
                                  </form>
                                  </div></br>
                                  <div class="col-12 col-md-12">
                                    <form action="<?= base_url('homenew/make_cod') ?>" method="post">
                                    <input type="hidden" name="shopping_order_id" value="<?= $product_detail['data'][0]['order_id'] ?>">
                                    <input type="hidden" name="premium_type" value="0">
                                    <input type="hidden" name="lab_mobile" value="<?php echo $data[0]['mobile']; ?>">
                                    <input type="hidden" name="users_id" value="<?= $this->session->userdata("users_id") ?>">
                                    <input type="hidden" name="reg_no" value="<?= $product_detail['reg_no'] ?>">
                                    <input type="hidden" name="purchase_id" value="<?= $product_detail[data][0]['purchase_id'] ?>">
                                    <input type="hidden" name="actual_amount" value="<?php echo $product_detail[actual_pay_amount] ?>">
                                    <input type="hidden" name="no_of_non_premium_animal" value="<?= $product_detail['no_of_non_premium_animal']?>">
                                    <input type="hidden" name="no_of_premium_animal" value="<?= $product_detail['no_of_premium_animal']?>">
                                    <input type="hidden" name="wallet_balance_consume" value="<?= $product_detail['wallet_balance_consume'] ?>">
                                    <input type="hidden" name="lab_id" value="<?= $product_detail[lab_id]?>">
                                    <input type="hidden" name="no_of_sample" value="<?= $product_detail[no_of_semp]?>">
                                    <input type="submit" value="Cash On Delivery" class="btn btn-primary btn-lg btn-block">
                                  </form>
                                </div>
			 					
				 			</div>
			 			</div>
		 			</div> 
		 		</div>
	 		</div>
		</section>
	</main>

<script>
  $( document ).ready(function() {
                    $(".razorpay-payment-button").val("<?= $this->webLanguage['Pay Now']?> <?= $this->webLanguage['Rs']?> <?=  $product_detail[actual_pay_amount] ?> ");
                    $(".razorpay-payment-button").addClass("btn btn-primary btn-lg btn-block");
                  });
                 
                  
</script>