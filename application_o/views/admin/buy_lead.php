<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('admin/product_interest') ?>">Leads</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>
    <?php //print_r($_SESSION); 
      $admin_data = $this->api_model->get_data('admin_id = "'.$_SESSION['user_id'].'"','admin');
      //print_r($admin_data);
    ?>
    <!-- <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div> -->

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Livestoc.
            <small class="pull-right">Date: <?= date('Y-m-d') ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Livestoc.</strong><br>
           C-86 Pannu Tower <br>
            Phone: 1800 102 0379<br>
            Email: support@livestoc.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?= $admin_data[0]['fname'] ?></strong><br>
            <?= $admin_data[0]['address'] ?></br>
            Email: <?= $admin_data[0]['email'] ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> <?= date('Y-m-d') ?><br>
          <b>Account:</b> 968-34567
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php $id_data = explode(',',$id); 
        $cout_id = count($id_data);
      ?>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><?= $cout_id ?></td>
              <td>Leads</td>
              <td>Rs<?= PRODUCT_LEAD * $cout_id ?></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <!-- <p class="lead">Payment Methods:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> -->

          <!-- <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due <?= date('Y-m-d') ?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Total:</th>
                <td>Rs<?= PRODUCT_LEAD * $cout_id ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
              <?php 
                    $log_data['users_id'] = $this->session->userdata("user_id");
                    $log_data['currency'] = 'INR';
                    $log_data['user_type'] = $this->session->userdata("user_type");
                    $log_data['amount'] = PRODUCT_LEAD * $cout_id;
                    $log_data['package_id'] = $id;
                    $log_data['type'] = '15';
                    $log_data['status'] = '0';
                    $log_data['tax'] = $app_tax;
                    $log = $this->api_model->submit('log_file',$log_data);
                    $curl = curl_init();
                  // curl_setopt_array($curl, array(
                  //   CURLOPT_URL => "https://www.livestoc.com/razorpay_orderid.php?purchase_id=".$log."&amount=".$log_data['amount']."&currency='INR'",
                  //   CURLOPT_RETURNTRANSFER => true,
                  //   CURLOPT_ENCODING => "",
                  //   CURLOPT_MAXREDIRS => 10,
                  //   CURLOPT_TIMEOUT => 30,
                  //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  //   CURLOPT_CUSTOMREQUEST => "GET",
                  //   CURLOPT_HTTPHEADER => array(
                  //     "Accept: */*",
                  //     "Accept-Encoding: gzip, deflate",
                  //     "Cache-Control: no-cache",
                  //     "Connection: keep-alive",
                  //     "Cookie: PHPSESSID=pd76811dvepd0ao972vfg5abi4; ci_session=pmsh0l1ish4521b781egnuj41galc4uj",
                  //     "Host: www.livestoc.com",
                  //     "Postman-Token: 91f7b6cf-efc3-4c86-a7ec-f27f9e4f829f,ef189fb4-d157-44d2-ba00-804ee44657e4",
                  //     "User-Agent: PostmanRuntime/7.15.2",
                  //     "cache-control: no-cache"
                  //   ),
                  // ));
                  // $response = curl_exec($curl);
                  // $err = curl_error($curl);
                  // curl_close($curl);
                  // $razorpayOrderId =  json_decode($response);
                  ?>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
          <form action="<?= base_url('admin/product_interest/1') ?>" method="POST">
                              <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="rzp_test_SXDq8BpuHEWRZ8"
                                data-amount="<?=(PRODUCT_LEAD *100) * $cout_id;?>"
                                data-currency="INR"
                                data-name="<?=$admin_data[0]['bank_name'];?>"
                                data-image="https://www.livestoc.com/images/livestoc-color-logo.png"
                                data-description="LiveStoc"
                                data-prefill.name="<?= (PRODUCT_LEAD*100) * $cout_id;?>"
                                data-prefill.email="<?= $admin_data[0]['email']; ?>"
                                data-prefill.contact="<?= $admin_data[0]['mobile']; ?>"
                                data-notes.purchase_id="<?= $log ?>"
                                data-notes.lead_id="<?= $id ?>"
                                data-notes.users_id="<?= $this->session->userdata("users_id") ?>"
                                data-notes.user_type="<?= $this->session->userdata("user_type") ?>"
                                data-notes.product_qty="<?= $product_qty ?>"
                                data-notes.product_type="ECOM_LEAD"
                                data-notes.shopping_order_id="LIVE_<?= $log ?>"
                                data-order_id="<?= $razorpayOrderId ?>"
                                <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?= PRODUCT_LEAD * $cout_id ?>" <?php } ?>
                                <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="INR" <?php } ?>
                              >
                              </script>
                               <!--Any extra fields to be submitted with the form but not sent to Razorpay -->
                              <input type="hidden" name="shopping_order_id" value="<?= PRODUCT_LEAD * $cout_id ?>">
									</form>
          <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button> -->
          <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <script>  $( document ).ready(function() {
										$(".razorpay-payment-button").val("Pay Rs <?= PRODUCT_LEAD * $cout_id ?> ");
										$(".razorpay-payment-button").addClass("btn btn-success pull-right");
									});
  </script>