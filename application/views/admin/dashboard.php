<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php');
//print_r($_SESSION);
?>
<div class="content-wrapper">
<section class="content-header">
      <h1>
        Dashboard
        <?php //print_r($_SESSION);  ?>
        <small>
          <?php if($_SESSION['status'] == '18'){ echo "Livestoc Ecommerce";}?>
          <?php if($_SESSION['status'] == '12' || $_SESSION['status'] == '20' || $_SESSION['status'] == '14' || $_SESSION['type'] == '11' || $_SESSION['type'] == '10' || $_SESSION['status'] == '19' || $_SESSION['status'] == '13' || $_SESSION['status'] == '15' || $_SESSION['status'] == '16'){ echo "Livestoc Bussiness";}else{ echo "LIVESTOC";}?>
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
</section>
<section class="content">
      <div class="row">
      <?php if($_SESSION['status'] == '18'){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg1">
              <div class="inner">
                <h3><?php $data =  $this->api_model->product_count();  echo $data[0]['count'];?></h3>
                <p>Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= base_url('admin/product_add'); ?>" class="small-box-footer">Add Product <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box  -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?php
                $user_id = '';
                if($_SESSION['status'] != '1')
                $user_id = $this->session->userdata("user_id"); 
                $data =  $this->api_model->get_order_count('', $user_id);  echo $data[0]['count'];
                 //print_r($data);
                ?>
                 
                </h3>
                <p>Product Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('admin/orders')?>" class="small-box-footer">See Order<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php
                $user_id = '';
                if($_SESSION['status'] != '1')
                $user_id = $this->session->userdata("user_id"); 
                //$data =  $this->api_model->product_interest_search('', $user_id, '', '');  if(empty($data)){ echo "0"; }else{ echo count($data);} 
                $leads = $this->api_model->query_build('SELECT DISTINCT(p.id),pi.*, u.*, p.* FROM produc_interest as pi, product as p, users as u where pi.product_id = p.id AND  u.users_id = pi.users_id AND p.user= "'.$_SESSION['user_id'].'"');
                echo count($leads);
               ?></h3>
                <p>Product Interest</p>
              </div>
              <div class="icon">
                <i class="fa fa-history"></i>
              </div>
              <a href="<?= base_url('admin/product_interest') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-dgreen">
              <div class="inner">
                <h3>&nbsp;</h3>

                <p>Bank Detail</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6">
             small box -->
            <!--<div class="small-box bg-dgreen">
              <div class="inner">
                <h3>&nbsp;</h3>

                <p>Bank Detail</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          </div> -->
        <?php }else if($_SESSION['status'] == '12' || $_SESSION['status'] == '20' || $_SESSION['status'] == '14' || $_SESSION['type'] == '11' || $_SESSION['type'] == '10' || $_SESSION['status'] == '19' ||  $_SESSION['status'] == '15' || $_SESSION['status'] == '16' || $_SESSION['status'] == '13'){ 
         ?>

            <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <?php //print_r($_SESSION); ?>
      <?php  if($_SESSION['status'] == '12' || $_SESSION['status'] == '14' || $_SESSION['status'] == '13'){?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg1">
            <div class="inner">
              <h3 id="bull_cout">150</h3>

              <p>Bulls</p>
            </div>
            <div class="icon">
              <i class="fa fa-list-ul" aria-hidden="true"></i>
            </div>
            <a href="<?= base_url('admin/add_bull'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php } 
        if($_SESSION['type'] != '10' AND $_SESSION['type'] != '11'){
        ?>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg2">
            <div class="inner">
              <h3 id="stock_count">53<!--<sup style="font-size: 20px">%</sup>--></h3>

              <p>Straws</p>
            </div>
            <div class="icon">
              <i class="fa fa-list-ol" aria-hidden="true"></i>
            </div>
            <a href="<?= base_url('admin/semen_stock_list'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php } else{ ?>
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                      <div>
                          <div class="panel-heading" style="padding-top: 20%; text-align:center;">
                          <h3><strong>Welcome To Dashboard</strong></h3>
                          </div>
                      </div>
                </div>
            </div>
        <?php }
         if($_SESSION['status'] == '12' || $_SESSION['status'] == '14' || $_SESSION['status'] == '13' || $_SESSION['status'] == '19'){?>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg3">
            <div class="inner">
              <h3 id="coustomer_order">44</h3>

              <p>Total Sales Order</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/sale') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php } ?>
        <!-- ./col -->
        <!-- <div class="col-lg-3 col-xs-6"> -->
          <!-- small box -->
          <!-- <div class="small-box bg4">
            <div class="inner">
              <h3 id="pending_coustomer_order">65</h3>
              <p>Pending Order</p>
            </div>
            <div class="icon">
              <i class="fa fa-history" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
        <!-- ./col -->
      <!-- </div>
        
            <div class="row"> -->
        <?php if($_SESSION['status'] == '12' || $_SESSION['status'] == '14' || $_SESSION['status'] == '13'){ ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg5">
            <div class="inner">
              <h3 id="distributer_count">150</h3>

              <p>Distributors</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-o" aria-hidden="true"></i>
            </div>
            <a href="<?= base_url('admin/distributors') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php } ?>
        <!-- ./col -->
        <?php if($_SESSION['status'] == '12' || $_SESSION['status'] == '20'|| $_SESSION['status'] == '14' || $_SESSION['status'] == '15' || $_SESSION['status'] == '13'){ ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg6">
            <div class="inner">
              <h3 id="supplier_count">53<sup style="font-size: 20px">%</sup></h3>

              <p>Suppliers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-o" aria-hidden="true"></i>
            </div>
            <a href="<?= base_url('admin/suppliers'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php } ?>
        <!-- ./col -->
        <!-- <div class="col-lg-3 col-xs-6"> -->
          <!-- small box -->
          <!-- <div class="small-box bg7">
            <div class="inner">
              <h3>44</h3>

              <p>Notifications</p>
            </div>
            <div class="icon">
              <i class="fa fa-bell" aria-hidden="true"></i>
            </div>
            <a href="<?= base_url('admin/notification') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
        <!-- ./col -->
        <?php if($_SESSION['status'] == '12' || $_SESSION['status'] == '14' || $_SESSION['status'] == '13' ){ ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg8">
            <div class="inner">
              <h3 id="bank_count">65</h3>

              <p>Add Bank</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/sub_user') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg8">
            <div class="inner">
              <h3 id="sub_user">0</h3>

              <p>Add SubUser</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/sys_user') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php } ?>
        <!-- <div class="col-lg-3 col-xs-6"> -->
          <!-- small box -->
          <!-- <div class="small-box bg8">
            <div class="inner">
              <h3 id="">0</h3>

              <p>Transfer Semen</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/transfer_semen') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
        <!-- ./col -->
      </div>    
      <!-- /.row -->
      <!-- Main row -->
      <!-- <div class="row"> -->
        <!-- Left col -->
        <!-- <section class="col-lg-7 connectedSortable"> -->
          <!-- Custom tabs (Charts with tabs)-->
          <!-- <div class="nav-tabs-custom"> -->
            <!-- Tabs within a box -->
            <!-- <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding"> -->
              <!-- Morris chart - Sales -->
              <!-- <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div> -->
          <!-- /.nav-tabs-custom -->


          <!-- /.box-->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <!-- <section class="col-lg-5 connectedSortable"> -->
          <!-- /.box -->

          <!-- solid sales graph -->
          <!-- <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sales Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div> -->
            <!-- /.box-body -->
            <!-- <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Mail-Orders</div>
                </div> -->
                <!-- ./col -->
                <!-- <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Online</div>
                </div> -->
                <!-- ./col -->
                <!-- <div class="col-xs-4 text-center">
                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">In-Store</div>
                </div> -->
                <!-- ./col -->
              <!-- </div> -->
              <!-- /.row -->
            <!-- </div> -->
            <!-- /.box-footer -->
          <!-- </div> -->
          <!-- /.box -->

          <!-- /.box -->

        <!-- </section> -->
        
        <?php }else{ ?>
          <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total No Of Doctor</span>
                  <span class="info-box-number"><?php $doc = $this->api_model->get_data('users_type = "pvt_doc"','doctor','','count(doctor_id) as count'); echo $doc[0]['count']; ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total No Of VT</span>
                  <span class="info-box-number"><?php $doc = $this->api_model->get_data('users_type = "pvt_vt"','doctor','','count(doctor_id) as count'); echo $doc[0]['count']; ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total AI Worker</span>
                  <span class="info-box-number"><?php $doc = $this->api_model->get_data('users_type = "pvt_ai"','doctor','','count(doctor_id) as count'); echo $doc[0]['count']; ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total Enqury</span>
                  <span class="info-box-number"><?= isset($product)?$product:0;  ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            </div>
            <div class="row">
            <?php //print_r($_SESSION); ?>
            <?php if($_SESSION['status'] == '1'){ ?>
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">&nbsp;&nbsp;&nbsp;</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Perticulars</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="<?= base_url('admin/doctor/pvt_ai') ?>">Total No AI Technician</a></td>
                    <td>
                      <?php $doc = $this->api_model->get_data('users_type = "pvt_ai"','doctor','','count(doctor_id) as count'); echo $doc[0]['count']; ?>
                      <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/doctor/pvt_doc') ?>">Total No Doctor</a></td>
                    <td>
                      <?php $doc = $this->api_model->get_data('users_type = "pvt_doc"','doctor','','count(doctor_id) as count'); echo $doc[0]['count']; ?>
                      <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/doctor/doc_vt') ?>">Total No Vet</a></td>
                    <td>
                      <?php $doc = $this->api_model->get_data('users_type = "pvt_vt"','doctor','','count(doctor_id) as count'); echo $doc[0]['count']; ?>
                      <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                  <td><a href="<?= base_url('admin/semen_account') ?>">Total No of Semen Strow IN</a></td>
                    <td>
                      <?php $doc = $this->api_model->get_data('admin_id = "37"','seman_stock','','sum(opening_stock) as count'); echo $doc[0]['count']; ?>
                      <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/semen_account') ?>">Total No of Semen Strow Out</a></td>
                      <td>
                      <?php $doc = $this->api_model->get_data('FIND_IN_SET(admin_id, (select group_concat(admin_id) from admin where type = 16))','seman_stock','','sum(opening_stock) - sum(rest_stock) as count'); echo $doc[0]['count']; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/ai_report') ?>">Total No of AI's Done</a></td>
                      <td>
                      <?php $doc = $this->api_model->get_data('treat_type = "3" AND status = "4"','vt_requests','','count(id) as count'); echo $doc[0]['count']; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/vet_call') ?>">No of Vet Calls</a></td>
                      <td>
                        <?php $doc = $this->api_model->get_data('call_status = "Connected"','doctor_call_inisite','','count(id) as count'); echo $doc[0]['count']; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/home_visit') ?>">No of Vet Home Visit</a></td>
                      <td>
                        <?php $doc = $this->api_model->get_data('treat_type = "0" AND status = "4"','vt_requests','','count(id) as count'); echo $doc[0]['count']; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/videos') ?>">No of Video Tutorials</a></td>
                      <td>
                        <?php $doc = $this->api_model->get_data('','video_block','','count(video_id) as count'); echo $doc[0]['count']; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/breader/3') ?>">No of Premium Breader</a></td>
                      <td>
                        <?php $doc = $this->api_model->get_data('is_premium_breeder_dealer = "1" AND users_type_id = "3"','users','','count(users_id) as count'); echo $doc[0]['count']; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/dealer/2') ?>">No of Premium Dealer</a></td>
                      <td>
                      <?php $doc = $this->api_model->get_data('is_premium_breeder_dealer = "2"','users','','count(users_id) as count'); echo $doc[0]['count']; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="<?= base_url('admin/doctor') ?>">No of Premium Doctor</a></td>
                      <td>
                        <?php $doc = $this->api_model->get_data('is_premium = "1"','doctor','','count(doctor_id) as count'); echo $doc[0]['count']; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">Total Creadited wallet Amount</a></td>
                      <td>
                        <?php $doc = $this->api_model->get_data('status = "Cr" AND wallet_type = "1"','livestoc_wallets','','sum(amount) as count'); echo $doc[0]['count']."&nbsp;Rs"; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">Total Debited wallet Amount</a></td>
                      <td>
                      <?php $doc = $this->api_model->get_data('status = "Dr" AND wallet_type = "1"','livestoc_wallets','','sum(amount) as count'); echo $doc[0]['count']."&nbsp;Rs"; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">Total Creadited Livestoc wallet Amount</a></td>
                      <td>
                      <?php $doc = $this->api_model->get_data('status = "Cr" AND wallet_type = "0"','livestoc_wallets','','sum(amount) as count'); echo $doc[0]['count']."&nbsp;Rs"; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">Total Debited Livestoc wallet Amount</a></td>
                      <td>
                      <?php $doc = $this->api_model->get_data('status = "Dr" AND wallet_type = "0"','livestoc_wallets','','sum(amount) as count'); echo $doc[0]['count']."&nbsp;Rs"; ?>
                        <!-- <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div> -->
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
            </div>
            <!-- /.box-footer -->
          </div>
          <?php }else{ ?>
                <div class="col-md-8 col-md-offset-1">
                      <div>
                          <div class="panel-heading" style="padding-top: 10%; padding-left: 25%">
                          <h3><strong>Welcome To Dashboard</strong></h3>
                          </div>
                      </div>
                </div>
          <?php } ?>
            </div>
           
        <?php } ?>
        <!-- /.col -->
      
  </section>
<?php include_once('layouts/admin_footer.php'); ?>
<?php if($_SESSION['status'] == '12' || $_SESSION['status'] == '14' || $_SESSION['status'] == '20' || $_SESSION['status'] == '19' ||  $_SESSION['status'] == '15' ||  $_SESSION['status'] == '16' || $_SESSION['status'] == '13'){ ?>
<script>
  ajaxloader.load("<?php echo base_url('api/check_activate_status').'?admin_id='.$_SESSION['user_id'].'&user_type='.$_SESSION['type'] ?>", function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
                              if(str.data.isactivated == 0){
                                window.open('<?= base_url('admin/logout') ?>', '_self');
                              }else{
                                $('#bull_cout').html('');
                                $('#bull_cout').html(str.data.count.bull_count);
                                $('#stock_count').html('');
                                if(str.data.count.stock_count){
                                  $('#stock_count').html(str.data.count.stock_count);
                                }else{
                                  $('#stock_count').html('0');
                                }
                                if(str.data.count.coustomer_order == '' || str.data.count.coustomer_order == null){
                                  $('#coustomer_order').html('');
                                  $('#coustomer_order').html('0');
                                  $('#pending_coustomer_order').html('');
                                  $('#pending_coustomer_order').html('0');
                                }else{
                                  $('#coustomer_order').html('');
                                  $('#coustomer_order').html(str.data.count.coustomer_order);
                                  $('#pending_coustomer_order').html('');
                                  $('#pending_coustomer_order').html(str.data.count.coustomer_order);
                                }
                                
                                $('#distributer_count').html('');
                                $('#distributer_count').html(str.data.count.distributer_count);
                                $('#bank_count').html('');
                                $('#bank_count').html(str.data.count.bank_count);
                                $('#supplier_count').html('');
                                $('#supplier_count').html(str.data.count.supplier_count);
                                $('#sub_user').html(str.data.count.sub_user_count);
                              }
		            });
    </script>
<?php } ?>