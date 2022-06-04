<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="<?= base_url() ?>assets/front_end/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/css/main.css">
<!--===============================================================================================-->
</head>
<body>
<?php 
require_once('includes/db_conn_new.php');
include('includes/razorpay-php/Razorpay.php');

use Razorpay\Api\Api;
//$key = 'rzp_test_BGvDPwYDMMTtJ7';
//$secrate_key = '84DqmQNSQAWHGAl6xy7t75Nq';
$key = 'rzp_live_HFeWEikeCbWtZ2';
$secrate_key = 'X4iQKNBn3vSiJVwF8ZuXP89O';
$api = new Api($key, $secrate_key);
// $package_type = $row['package_type'];
$orderData = [
    'receipt'         => $last_id,
    'amount'          => $payment_price * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
  ];
  $razorpayOrder = $api->order->create($orderData);
  $razorpayOrderId = $razorpayOrder['id'];

//print_r($row1);
?>
	<div class="bg-contact3" style="background:ececec;">
		<div class="container-contact3">
			<div class="wrap-contact3">
				<!-- <form class="contact3-form validate-form"> -->
					<span class="contact3-form-title">
                        <?php //print_r($data); ?>
						Please Pay <span style="color:red;"><?php print_r($payment_price); ?></span> Rs
					</span>
                    <span class="contact3-form-title">
                    <form action="<?= base_url() ?>payment" method="POST">
                            <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="<?= $key ?>"
                                data-amount="<?= $payment_price*100 ?>"
                                data-currency="INR"
                                data-name="<?= $name ?>"
                                data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                data-description="Company "
                                data-prefill.name="<?= $name ?>"
                                data-prefill.email="<?= $email ?>"
                                data-prefill.contact="<?= $mobile ?>"
                                data-notes.last_id="<?= $last_id ?>"
                                data-notes.shopping_order_id="Pack_<?= $last_id ?>"
                                data-notes.type="COM_REG"
                                data-order_id="<?= $razorpayOrderId ?>"
                                <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?= $payment_price ?>" <?php } ?>
                                <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="INR" <?php } ?>
                            >
                            </script>
                            <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                            <input type="hidden" name="shopping_order_id" value="<?= $last_id ?>">
                    </form>
                    </span>
				<!-- </form> -->
			</div>
		</div>
	</div>










	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="<?= base_url() ?>assets/front_end/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/front_end/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url() ?>assets/front_end/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/front_end/vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
                    $( document ).ready(function(){
                        $('.razorpay-payment-button').attr('class', 'btn btn-success');
                    });
	</script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>assets/front_end/js/main.js"></script>

</body>
</html>
