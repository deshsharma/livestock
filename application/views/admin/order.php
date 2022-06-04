<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php');
?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
        Your Order
        <small><?php if($_SESSION['status'] == '18'){ echo "Livestoc Ecommerce";}else{ echo "HAR PASHU KA DHYAN";}?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Order</li>
      </ol>
</section>
<section class="content">
      <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-peach">
              <div class="inner">
                <h3>150</h3>

                <p>All Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Pending</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-lgreen">
              <div class="inner">
                <h3>44</h3>

                <p>Delivered</p>
              </div>
              <div class="icon">
                <i class="fa fa-history"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dgreen">
              <div class="inner">
                <h3>65</h3>

                <p>Dispatched</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-8 col-md-offset-1">
                <div>
                    <div class="panel-heading" style="padding-top: 10%; padding-left: 25%">
                    <h3><strong>&nbsp;</strong></h3>
                    </div>
                </div>
          </div>
      </div>
      </div>
  </section>
<?php include_once('layouts/admin_footer.php'); ?>