<?php 
// echo "<pre>";
// print_r($data);
// exit;

//use Razorpay\Api\Api;
$key = 'rzp_test_SXDq8BpuHEWRZ8';
$secrate_key = '84DqmQNSQAWHGAl6xy7t75Nq';
// $key = 'rzp_live_HFeWEikeCbWtZ2';
// $secrate_key = 'X4iQKNBn3vSiJVwF8ZuXP89O';
// $api = new Api($key, $secrate_key);
// $query = "SELECT * FROM `package_masters` where `package_id`='".$_REQUEST['pakage_id']."'";
// $result = $db_conn->query($query);
// $row1 = mysqli_fetch_array($result);
// $package_type = $row['package_type'];
// $purchase_id = $_REQUEST['purchase_id'];
// $orderData = [
//     'receipt'         => $purchase_id,
//     'amount'          => $row1['total'] * 100, // 2000 rupees in paise
//     'currency'        => 'INR',
//     'payment_capture' => 1 // auto capture
//   ];
//   $razorpayOrder = $api->order->create($orderData);
//   $razorpayOrderId = $razorpayOrder['id'];

//print_r($row1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>LiveStock ::</title>
	
<script src="js/jquery-2.1.1.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="js/bootstrap.min.js"></script>
<link href="css/css.css" rel="stylesheet" />	
<link href="css/main.css" rel="stylesheet" /> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">	
<link href="http://fonts.googleapis.com/css?family=Karla:400,400i,700,700i%7CLora:400,400i" rel="stylesheet" media="screen" />

	</head>
<body class="product-product-65 product-style1 global-cart-basket sticky-enabled hide_ex_tax cut-names basel-back-btn-disabled widget-title-style2 title_in_bc tall_height_bc">
	
	
<!-- ========================== Start Only Mobile Post ========================== -->	

<div class="divContinuePackage">

<div class="divNameVacc">
<h2 class="h2_divNameVacc"><?php echo "AI Request";?></h2>	
<!-- <p class="p_divNameVacc"> <?= $row1['features'] ?></p>	 -->
</div>
<?php
// $query = "SELECT * FROM `users` where `users_id`='".$_REQUEST['users_id']."'";
// $result = $db_conn->query($query);
// $row2 = mysqli_fetch_array($result);
//print_r($row2);
?>
<!-- <div class="detail_divContinuePackage">
<h2 class="h2_divContinuePackage"> Customer Detail </h2>	
<p class="p_divContinuePackage"> <?= $row2['full_name'] ?> </p>	
<p class="p_divContinuePackage"> <?= $row2['mobile_code'].'-'.$row2['mobile'] ?> </p> -->
<!--<p class="p_divContinuePackage date"> Purchase on 14 april 2019 </p>-->	
</div>	
<?php
// $query = "SELECT * FROM `animals` where `animal_id`='".$_REQUEST['animal_id']."'";
// $result = $db_conn->query($query);
// $row3 = mysqli_fetch_array($result);
//print_r($row);
?>
<div class="detail_divContinuePackage_AB">
<!-- <h2 class="h2_divContinuePackage"> Animal ID/Name </h2>	  -->
<!-- <p class="p_divContinuePackage"> #<?= $row3['animal_id'] ?> / <?= $row3['fullname'] ?> </p>		 -->
</div>	
<div class="wastehight"></div>	 
	
<div class="divbutton_r" style="text-align: center;">
<form action="/harpahu_merge_dev/" method="POST">
            <script
                src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="<?= $key ?>"
                data-amount="<?= $data['actual_payment']*100 ?>"
                data-currency="INR"
                data-product_type='AILVAT'
                data-bank_id='62903'
                data-shopping_order_id='LVAT_<?= $data['purchase_id'] ?>'
                data-name="<?php echo "Akhilesh" ?>"
                data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                data-description="some thing"
                data-prefill.name="<?php echo "Akhilesh" ?>"
                data-prefill.email="<?php echo "shahiakhilesh75@gmail.com"?>"
                data-prefill.contact="<?php echo "7007692445" ?>"
				data-notes.purchase_id="<?= $data['purchase_id'] ?>"
                data-notes.bull_id="<?= '1' ?>"
                data-notes.product_type='AILVAT'
                data-notes.animal_id='["4133"]'
                data-notes.bank_id = '62903'
                data-notes.shopping_order_id="LVAT_<?= $data['purchase_id'] ?>"
                <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?= $data['actual_payment'] ?>" <?php } ?>
                <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="INR" <?php } ?>
            >
            </script>
            <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
            <input type="hidden" name="shopping_order_id" value="<?= $data['purchase_id'] ?>">
     </form>
     <script>  $( document ).ready(function() {
        $(".razorpay-payment-button").val("Pay Now <?= $data['actual_payment'] ?>Rs ");
        $(".razorpay-payment-button").css("background", "#fa1a3d");
        $(".razorpay-payment-button").css("color", "#fff");
    });</script>
<!-- <button id="rzp-button1" class="btn">Pay Rs <span><?= $row1['total'] ?></span></button> -->
</div>	
	
</div>
	
	

	
<!-- ========================== End Only Mobile Post ========================== -->	
	
	
	
</body>
</html>
