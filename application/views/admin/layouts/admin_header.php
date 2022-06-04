<!DOCTYPE html>
 <html lang="en"> 
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/> 
<link rel="icon" href="https://www.livestoc.com/assets/home/images/favicon4.png">
<title><?php if($_SESSION['status'] == '18'){ echo "LE";}if($_SESSION['status'] == '12' || $_SESSION['status'] == '20' || $_SESSION['type'] == '11' ||  $_SESSION['status'] == '14' || $_SESSION['status'] == '13' || $_SESSION['status'] == '15' || $_SESSION['status'] == '19' || $_SESSION['type'] == '10'){ echo "LB";}else{ echo "Livestoc";}?></title> 
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php if($_SESSION['status'] == '18'){ echo "Livestoc Ecommerce";}else{ echo "Livestoc";}?> | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/css/AdminLTE.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin/bower_components/morris.js/morris1.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/bower_components/select2/dist/css/select2.min.css')?>">
       <!--folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/css/skins/_all-skins.min.css')?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')?>">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">
   <link rel="stylesheet" href="<?= base_url('assets/admin/css/style.css')?>" >
   <link rel="stylesheet" href="<?= base_url('assets/admin/css/pagination.css')?>" >
  <!--================= datatable plugins ====================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/reponsive_datatable/jquery.dataTables.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/reponsive_datatable/rowReorder.dataTables.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/reponsive_datatable/responsive.dataTables.min.css');?>">
  <!--=========================================================-->

  <!-- jQuery 3 -->
  <script src="<?= base_url('assets/admin/bower_components/jquery/dist/jquery.min.js')?>"></script>
  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
  <!-- jQuery UI 1.11.4 -->
  <script type="text/javascript" src="<?= base_url('assets/admin/js/jquery.pagination.js')?>"></script>
  <!--======== datatable plugin ==============-->
  <!-- <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/plugins/reponsive_datatable/jquery.dataTables.min.js');?>"></script> -->
  <!-- <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/plugins/reponsive_datatable/dataTables.responsive.min.js');?>"></script> -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <style>
        .bg1{background: #ffc98b}
        .bg2{background: #d0e6a5}
        .bg3{background: #e79796}
        .bg4{background: #ffb284}
        .bg5{background: #c6c09c}
        .bg6{background: #86e3ec}
        .bg7{background: #ccabd8}
        .bg8{background: #fa897b}
        .skin-blue .main-header .navbar {background-color: #0aa8b0;}
        .skin-blue .main-header .logo{background: #fff;color: #000}
        </style>
  <!--=========================================-->
</head> 
<body class="hold-transition <?php  if($_SESSION['status'] == '18' ||  $_SESSION['status'] == '20' || $_SESSION['status'] == '12' || $_SESSION['type'] == '11' ||  $_SESSION['status'] == '14' || $_SESSION['status'] == '19' || $_SESSION['type'] == '10' ||$_SESSION['status'] == '13' || $_SESSION['status'] == '15' ||  $_SESSION['status'] == '16'){ echo "skin-blue"; }else{ echo "skin-blue"; } ?> sidebar-mini ">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
   <!--  <a href="<?php echo base_url('class_public/dashboard'); ?>" class="logo" onclick="removeMenu()"> -->
      <!-- mini logo for sidebar mini 50x50 pixels -->
     <!--  <span class="logo-mini"> --><!--<img src="<?= base_url('assets/admin/img/small_logo.png'); ?>" height="50" >--> <!-- <?php if($_SESSION['status'] == '18'){ echo "LE";}if($_SESSION['status'] == '12' || $_SESSION['type'] == '11' || $_SESSION['type'] == '12' ||  $_SESSION['status'] == '14' || $_SESSION['status'] == '13' || $_SESSION['status'] == '19' || $_SESSION['type'] == '10' ||  $_SESSION['status'] == '15' ||  $_SESSION['status'] == '16'){ echo "LB";}else{ echo "HPKD";}?> --> <!-- </span> -->
      <!-- logo for regular state and mobile devices -->
      <!-- <span class="logo-lg"> --><!--<img src="<?= base_url('assets/admin/img/logo.png'); ?>" height="50" >--> <!-- <?php if($_SESSION['status'] == '18'){ echo "Livestoc Ecommerce";}if($_SESSION['status'] == '12' || $_SESSION['type'] == '11' ||  $_SESSION['status'] == '14' || $_SESSION['status'] == '13' || $_SESSION['status'] == '20' || $_SESSION['status'] == '19' || $_SESSION['type'] == '10' ||  $_SESSION['status'] == '15' ||  $_SESSION['status'] == '16'){ echo "Livestoc Bussiness"; }else{ echo "HPKD";}?></span> -->
    <!-- </a> -->
     <a href="<?php echo base_url('class_public/dashboard'); ?>" class="logo" onclick="removeMenu()">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="https://www.livestoc.com/uploads/logo/small.png" height="50" > <?php //if($_SESSION['status'] == '18'){ echo "LE";}if($_SESSION['status'] == '12' || $_SESSION['status'] == '20' || $_SESSION['type'] == '11' ||  $_SESSION['status'] == '14' || $_SESSION['status'] == '13' || $_SESSION['status'] == '19' || $_SESSION['type'] == '10' ||  $_SESSION['status'] == '15' ||  $_SESSION['status'] == '16'){ echo "LB";}else{ echo "Livestoc";}?> </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="https://www.livestoc.com/uploads/logo/logolivestoc.png" height="38" > <?php //if($_SESSION['status'] == '18'){ echo "Livestoc Ecommerce";}if($_SESSION['status'] == '12' || $_SESSION['status'] == '20' || $_SESSION['type'] == '11' ||  $_SESSION['status'] == '14' || $_SESSION['status'] == '13' || $_SESSION['status'] == '19' || $_SESSION['type'] == '10' ||  $_SESSION['status'] == '15' ||  $_SESSION['status'] == '16'){ echo "Livestoc Bussiness"; }else{ echo "Livestoc";}?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu" >   
        <ul class="nav navbar-nav">
        <!---- Order Open---->
        <?php if($_SESSION['status'] == '18'){
          $count = $this->api_model->query_build('select count(po.id) as count from product_order as po , product as p where p.id = po.product_id AND po.isactive = "0" AND p.user = "'.$_SESSION['user_id'].'"');
          $order = $this->api_model->query_build('select DISTINCT po.id, if(po.distance_covered IS NOT NULL, po.distance_covered, 0) as distance_covered, pp.name as package_name,(select full_name from users where users_id = po.users_id) as user_name, (select mobile from users where users_id = po.users_id) as user_mobile, (select address from users where users_id = po.users_id) as user_address, po.product_qty, po.package_id, po.delivery_partner_payment_status, po.package_price, po.date, po.isactive, p.user, p.name, p.images from product_order as po , product as p, product_package pp where po.package_id = pp.id AND p.id = po.product_id AND po.isactive = "0" AND p.user ="'.$_SESSION['user_id'].'"');
         ?>
           <li class="dropdown notifications-menu">
            <a href="" class="dropdown-toggle order_header" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php if($count[0]['count'] != '0'){ ?>
              <span class="label label-warning"><?=$count[0]['count'] ?></span>
              <?php } ?>
            </a>
            <ul class="dropdown-menu order_display">
            <?php  if($order){ ?>
              <li class="header">You have <?=$count[0]['count'] ?> New Order</li>
              <li>
                <ul class="menu">
                    <?php foreach($order as $or){ ?>
                    <li>
                      <a href="<?= base_url('admin/order_view/').$or['id'] ?>">
                        <i class="fa fa-shopping-cart text-green"></i> <?= $or['product_qty'] ?> new Order for <?= $or['name'] ?>
                      </a>
                    </li>
                    <?php } ?>
                </ul>
              </li>
              <li class="footer">
                <a href="<?= base_url('admin/orders') ?>">View all Order</a>
              </li>
            <?php } ?>
            </ul>
           </li>
           
          <!---- Order Close---->
        <?php
         $leads = $this->api_model->query_build('SELECT DISTINCT(p.id),pi.id as int_id,pi.*, u.*, p.* FROM produc_interest as pi, product as p, users as u where pi.product_id = p.id AND  u.users_id = pi.users_id AND view_status <> "1" AND p.user= "'.$_SESSION['user_id'].'"');
       
       ?>
        <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle leads_header" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <?php if(count($leads) != '0'){ ?>
              <span class="label label-danger"><?= count($leads) ?></span>
              <?php } ?>
            </a>
            <ul class="dropdown-menu lead_display">
            <?php  if($leads){ ?>
              <li class="header">You have <?= count($leads) ?> New Leads</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php foreach($leads as $le){ ?>
                  <li><!-- Task item -->
                    <a href="<?= base_url('admin/interest_view/').$leads[0]['int_id'] ?>">
                    <i class="fa fa-heart"></i> New interest for <?= $le['name'] ?>
                    </a>
                  </li>
                  <!-- end task item -->
                  <?php } ?>
                </ul>
              </li>
              <li class="footer">
                <a href="<?= base_url('admin/product_interest') ?>">View all Leads</a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php
        } ?>
           <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" style="padding-right:0px;" > 
            <?php 
              $name = $this->session->userdata('user_name');
            ?>         
              <span >Welcome, &nbsp;&nbsp; <strong><?php echo $name; ?></strong> &nbsp;&nbsp;</span>
            </a>            
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <?= anchor('admin/logout','Logout',array('style'=>'padding-left:10px;')) ?>
           
          </li>
          <!-- Control Sidebar Toggle Button -->          
        </ul>
      </div>
    </nav>
  </header>
  <?php //print_r($_SESSION); ?>