<style>
  .bg1{background: #ffc98b}
.bg2{background: #d0e6a5}
.bg3{background: #e79796}
.bg4{background: #ffb284}
.bg5{background: #c6c09c}
.bg6{background: #86e3ec}
.bg7{background: #ccabd8}
.bg8{background: #fa897b}
.pl-18{padding-left:18px;}
.premium{    background-color: #ff6000;
    color: #fff;
    padding: 2px 6px;
    border-radius: 3px;
    float: right;}
.highlight{Margin-top:20px; padding:4%; margin-bottom:30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);}
.grey_bg{
    background:#f4f4f4; border-radius:4px; padding:2%; margin:2%;}
.grey_bg1{
    background:#ffc98b; border-radius:4px; padding:2%; margin:2%;}

.grey_bg2{
    background:#d0e6a5; border-radius:4px; padding:2%; margin:2%;}

.grey_bg3{
    background:#e79796; border-radius:4px; padding:2%; margin:2%;}

.skin-blue .main-header .navbar {background-color: #0aa8b0;}
.skin-blue .main-header .logo{background: #fff;color: #000}
.pL25{padding-left: 25px}
.pL15{padding-left: 15px}
.pR15{padding-right: 15px}
.pT10{padding-top: 10px}
.pL5{padding-left: 5px}
.mT20{margin-top: 20px}
.mT10{margin-top: 10px}
.mB20{margin-bottom: 20px}
.forfull{float: left; width: 100%}
.box-content{margin-top:20px;margin-bottom:20px}

@media only screen and (max-width : 767px) {
.cust-wrapper{width: 100%;}
}
.card {
  position: relative;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #ffffff;
  background-clip: border-box;
  border: 0 solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
  box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
  margin-bottom: 1rem;
}
}

.card > hr {
  margin-right: 0;
  margin-left: 0;
}

.card > .list-group:first-child .list-group-item:first-child {
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
}

.card > .list-group:last-child .list-group-item:last-child {
  border-bottom-right-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}

.card-body {
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  padding: 1.25rem;
}

.card-title {
  margin-bottom: 0.75rem;
}

.card-subtitle {
  margin-top: -0.375rem;
  margin-bottom: 0;
}

.card-text:last-child {
  margin-bottom: 0;
}

.card-link:hover {
  text-decoration: none;
}

.card-link + .card-link {
  margin-left: 1.25rem;
}

.card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: rgba(0, 0, 0, 0.03);
  border-bottom: 0 solid rgba(0, 0, 0, 0.125);
}

.card-header:first-child {
  border-radius: calc(0.25rem - 0) calc(0.25rem - 0) 0 0;
}

.card-header + .list-group .list-group-item:first-child {
  border-top: 0;
}

.card-footer {
  padding: 0.75rem 1.25rem;
  background-color: rgba(0, 0, 0, 0.03);
  border-top: 0 solid rgba(0, 0, 0, 0.125);
}

.card-footer:last-child {
  border-radius: 0 0 calc(0.25rem - 0) calc(0.25rem - 0);
}

.card-header-tabs {
  margin-right: -0.625rem;
  margin-bottom: -0.75rem;
  margin-left: -0.625rem;
  border-bottom: 0;
}

.card-header-pills {
  margin-right: -0.625rem;
  margin-left: -0.625rem;
}

.card-img-overlay {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1.25rem;
}

.card-img {
  width: 100%;
  border-radius: calc(0.25rem - 0);
}

.card-img-top {
  width: 100%;
  border-top-left-radius: calc(0.25rem - 0);
  border-top-right-radius: calc(0.25rem - 0);
}

.card-img-bottom {
  width: 100%;
  border-bottom-right-radius: calc(0.25rem - 0);
  border-bottom-left-radius: calc(0.25rem - 0);
}

.card-deck {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
}

.card-deck .card {
  margin-bottom: 7.5px;
}

@media (min-width: 576px) {
  .card-deck {
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    margin-right: -7.5px;
    margin-left: -7.5px;
  }
  .card-deck .card {
    display: -ms-flexbox;
    display: flex;
    -ms-flex: 1 0 0%;
    flex: 1 0 0%;
    -ms-flex-direction: column;
    flex-direction: column;
    margin-right: 7.5px;
    margin-bottom: 0;
    margin-left: 7.5px;
  }
}

.card-group {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
}

.card-group > .card {
  margin-bottom: 7.5px;
}

@media (min-width: 576px) {
  .card-group {
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
  }
  .card-group > .card {
    -ms-flex: 1 0 0%;
    flex: 1 0 0%;
    margin-bottom: 0;
  }
  .card-group > .card + .card {
    margin-left: 0;
    border-left: 0;
  }
  .card-group > .card:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }
  .card-group > .card:not(:last-child) .card-img-top,
  .card-group > .card:not(:last-child) .card-header {
    border-top-right-radius: 0;
  }
  .card-group > .card:not(:last-child) .card-img-bottom,
  .card-group > .card:not(:last-child) .card-footer {
    border-bottom-right-radius: 0;
  }
  .card-group > .card:not(:first-child) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }
  .card-group > .card:not(:first-child) .card-img-top,
  .card-group > .card:not(:first-child) .card-header {
    border-top-left-radius: 0;
  }
  .card-group > .card:not(:first-child) .card-img-bottom,
  .card-group > .card:not(:first-child) .card-footer {
    border-bottom-left-radius: 0;
  }
}

.card-columns .card {
  margin-bottom: 0.75rem;
}
.bg-light {
    background-color: #f8f9fa!important;
}
.product-image {
  max-width: 100%;
  height: auto;
  width: 100%;
}

.product-image-thumbs {
  -ms-flex-align: stretch;
  align-items: stretch;
  display: -ms-flexbox;
  display: flex;
  margin-top: 2rem;
}

.product-image-thumb {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075);
  border-radius: 0.25rem;
  background-color: #ffffff;
  border: 1px solid #dee2e6;
  display: -ms-flexbox;
  display: flex;
  margin-right: 1rem;
  max-width: 7rem;
  padding: 0.5rem;
}

.product-image-thumb img {
  max-width: 100%;
  height: auto;
  -ms-flex-item-align: center;
  align-self: center;
}

.product-image-thumb:hover {
  opacity: 0.5;
}
.btn:not(:disabled):not(.disabled).active, .btn:not(:disabled):not(.disabled):active {
    box-shadow: none;
}
.btn-group>.btn-group:not(:last-child)>.btn, .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.prod{background-color: #f4f4f4;
    color: #444;
    border: 1px solid #ddd; 
    padding:6px 12px;
}
.pad{padding:4px 8px;}

@media (min-width: 576px) {
  .card-columns {
    -webkit-column-count: 3;
    -moz-column-count: 3;
    column-count: 3;
    -webkit-column-gap: 1.25rem;
    -moz-column-gap: 1.25rem;
    column-gap: 1.25rem;
    orphans: 1;
    widows: 1;
  }
  .card-columns .card {
    display: inline-block;
    width: 100%;
  }
}
  </style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php 
    // print_r($data); 
    //   print_r($_POST);
       ?>
       <?php 
 $key = 'rzp_test_BGvDPwYDMMTtJ7';
$secrate_key = '84DqmQNSQAWHGAl6xy7t75Nq';
  $razorpayOrderId = $data[0]['razorpayOrderId'];
  $admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customer Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> stock</a></li>
        <li class="active">Customer Details</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="col-md-12">
                <div class="box-solid">
                  <div class="box-header with-border">
                      <h3 class="box-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h3>
                  </div>
                  <div class="box-body clearfix">
                      <div class="box-content">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                          <h3>Total Amount : Rs <?= $_POST['total_price'] ?></h3>
                          <form action="<?= base_url('admin/bull') ?>" method="POST">
                                <script
                                    src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="<?= $key ?>"
                                    data-amount="<?= $_POST['total_price']*100 ?>"
                                    data-shopping_order_id="<?= $data[0]['order_id'] ?>"
                                    data-currency="INR"
                                    data-name="<?= $_SESSION['user_name'] ?>"
                                    data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                    data-description="some thing"
                                    data-prefill.name="<?= $admin_data[0]['fname'] ?>"  
                                    data-prefill.email="<?= $admin_data[0]['email'] ?>"
                                    data-prefill.contact="<?= $row2['mobile'] ?>"
                            data-notes.purchase_id="<?= $data[0]['purchase_id'] ?>"
                                    data-notes.bank_id="<?= $admin_data[0]['admin_id'] ?>"
                                    data-notes.bull_id="<?= $_POST['bull_id'] ?>"
                                    data-notes.type="11"
                                    data-notes.month_id="<?= $_POST['premium_bull_type'] ?>"
                                    data-notes.product_type="BUSSI"
                                    data-notes.shopping_order_id="Pack_<?= $data[0]['purchase_id'] ?>"
                                    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?= $_POST['total_price'] ?>" <?php } ?>
                                    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="INR" <?php } ?>
                                >
                                </script>
                                <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                                <input type="hidden" name="shopping_order_id" value="<?= $data[0]['purchase_id'] ?>">
                        </form>
                        <script>  $( document ).ready(function() {
                            $(".razorpay-payment-button").val("Pay Now <?= $_POST['total_price'] ?>Rs ");
                            $(".razorpay-payment-button").css("background", "#fa1a3d");
                            $(".razorpay-payment-button").css("color", "#fff");
                        });</script>
                          <!-- <button type="button" class="btn btn-info btn-lg">Pay Now</button> -->
                      </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
	
</div>

    </section>
</div>
<script>
  $('.razorpay-payment-button').addClass('btn btn-info btn-lg');
  $('.razorpay-payment-button').removeAttr("style");
</script>