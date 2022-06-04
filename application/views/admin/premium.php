<link rel="stylesheet" href="<?= base_url('assets/admin/dist/css/') ?>owl.carousel.min.css">
<link rel="stylesheet" href="<?= base_url('assets/admin/dist/css/') ?>owl.theme.default.min.css">
<link rel="stylesheet" href="<?= base_url('assets/admin/dist/css/') ?>custom.css">  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Choose Packages
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Bull</a></li>
        <li><a href="#">Bull Listing</a></li>
        <li class="active">Packages</li>  
          
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="card card-solid">
        <div class="row">
          <div class="col-md-12">
            <div class="owl-carousel owl-theme">
            <?php $pre = $this->api_model->get_premium_bull_price(); 
            foreach($pre as $p){

              if($type == '1'){
                if($p['id'] != '1'){
            ?>
            <div class="item">
                <div class="grey_bg">
                  <h2 class="page-header"><?= $p['type_name'] ?></h2>
                  <ul class="pl-18">
                          <?php $tip = $this->api_model->get_facility_prem_id($p['id']);  
                          foreach($tip as $t){?>
                                  <li><?= $t['name'] ?></li>
                          <?php }
                          ?>
                      </ul>
                      <p>Sample view of <?= $p['type_name'] ?>.</p>
                        <img src="<?= base_url('assets/admin/dist/img/').$p['Image'] ?>" alt="" class="img-fluid">
                        <hr>
                        <?php $rate =$this->api_model->get_premium_bull_rate($p['id']); 
                                if(empty($rate)){
                                  ?>
                                      <div class="nav-tabs-custom">
                                        <a href="<?= base_url('admin/bull') ?>"><button class="btn btn-sm btn-danger"><a style="color: #ffffff;">Submit</buttton></a>
                                      </div>
                                  <?php
                                }else{ ?>
                                <h4>Duration Of Payment</h4>
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs">
                                                        <?php 
                                                        $j = 1;
                                                        foreach($rate as $r){
                                                          if($j==1){ ?>
                                                                <li class="active"><a href="#tab_<?= $p['id'] ?>_<?= $j ?>" data-toggle="tab"><?= $r['name'] ?></a></li>
                                                          <?php }else{ ?>
                                                                <li><a href="#tab_<?= $p['id'] ?>_<?= $j ?>" data-toggle="tab"><?= $r['name'] ?></a></li>
                                                          <?php }
                                                          ?>
                                                      <?php $j++; }
                                                        ?>
                                                      </ul>
                                                    <div class="tab-content">
                                                    <?php $j = 1; foreach($rate as $r){  ?>
                                                        <div class="tab-pane <?php if($j == 1){ echo "active"; }?>" id="tab_<?= $p['id'] ?>_<?= $j ?>">
                                                            <div class="row">
                                                              <div class="col-md-6 col-xs-6">
                                                                  <h6><strong>Price</strong></h6>
                                                                  <h6><strong>GST</strong></h6>
                                                                  <h6><strong>Total Price</strong></h6>
                                                              </div>
                                                              <div class="col-md-6 col-xs-6">
                                                                  <?php if($r['discount'] != '0'){ ?>
                                                                    <strong><i class="fa fa-inr" aria-hidden="true"></i> <strike><?= $r['actual_price'] ?></strike>&nbsp;&nbsp;<i class="fa fa-inr" aria-hidden="true"></i> <?php echo $r['actual_price'] - $r['discount']; ?></strong>
                                                                  <?php }
                                                                  else{ ?>
                                                                    <h6><strong><i class="fa fa-inr" aria-hidden="true"></i> <?= $r['actual_price'] ?></strong></h6>
                                                                  <?php } ?>
                                                                  <h6><strong><?= $r['gst'] ?>%</strong></h6>
                                                                  <h6><strong><i class="fa fa-inr" aria-hidden="true"></i> <?= $r['total_price'] ?></strong></h6>
                                                                  <form action="<?= base_url('admin/get_last_log_id_web')?>" method="POST">
                                                                    <input type="hidden" name="user_type" value="3">
                                                                    <input type="hidden" name="request_status" value="1">
                                                                    <input type="hidden" name="type" value="11">
                                                                    <input type="hidden" name="users_id" value="<?= $_SESSION['user_id'] ?>">
                                                                    <!-- <input type="hidden" name="payment_type" value="11"> -->
                                                                    <input type="hidden" name="currency" value="INR">
                                                                    <?php if($r['discount'] != '0'){ ?>
                                                                      <input type="hidden" name="amount" value="<?php echo $r['actual_price'] - $r['discount']; ?>">
                                                                      <input type="hidden" name="total_price" value="<?php echo $r['actual_price'] - $r['discount']; ?>"> 
                                                                    <?php }
                                                                    else{ ?>
                                                                      <input type="hidden" name="amount" value="<?= $r['total_price'] ?>">
                                                                      <input type="hidden" name="total_price" value="<?= $r['total_price'] ?>"> 
                                                                    <?php } ?>
                                                                    <input type="hidden" name="premium_bull_type" value="<?= $p['id'] ?>">
                                                                    <input type="hidden" name="bull_id" value="<?= $bull_id ?>">
                                                                    <div><input type="submit" class="btn btn-sm btn-danger"></div>
                                                                </form> 
                                                              </div>
                                                            </div>
                                                        </div>
                                                    <?php $j++; } 
                                                      ?>
                                                    
                                                    </div>
                                                </div>
                                              </div>
                                              </div>
                                <?php }  ?>
                    
                </div>
            </div>
            <?php }}else{ ?>
              <div class="item">
              <div class="grey_bg">
                <h2 class="page-header"><?= $p['type_name'] ?></h2>
                <ul class="pl-18">
                        <?php $tip = $this->api_model->get_facility_prem_id($p['id']);  
                        foreach($tip as $t){?>
                                <li><?= $t['name'] ?></li>
                        <?php }
                        ?>
                    </ul>
                    <p>Sample view of <?= $p['type_name'] ?>.</p>
                      <img src="<?= base_url('assets/admin/dist/img/').$p['Image'] ?>" alt="" class="img-fluid">
                      <hr>
                      <?php $rate =$this->api_model->get_premium_bull_rate($p['id']); 
                              if(empty($rate)){
                                ?>
                                      <div class="nav-tabs-custom" style="text-align:right;">
                                        <a href="<?= base_url('admin/bull') ?>"><button class="btn btn-sm btn-danger" style="color: #ffffff;">Submit</buttton></a>
                                      </div>
                                <?php
                              }else{ ?>
                              <h4>Duration Of Payment</h4>
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="nav-tabs-custom">
                                                      <ul class="nav nav-tabs">
                                                      <?php 
                                                      $j = 1;
                                                      foreach($rate as $r){
                                                        if($j==1){ ?>
                                                              <li class="active"><a href="#tab_<?= $p['id'] ?>_<?= $j ?>" data-toggle="tab"><?= $r['name'] ?></a></li>
                                                        <?php }else{ ?>
                                                              <li><a href="#tab_<?= $p['id'] ?>_<?= $j ?>" data-toggle="tab"><?= $r['name'] ?></a></li>
                                                        <?php }
                                                        ?>
                                                    <?php $j++; }
                                                      ?>
                                                    </ul>
                                                  <div class="tab-content">
                                                  <?php $j = 1; foreach($rate as $r){  ?>
                                                      <div class="tab-pane <?php if($j == 1){ echo "active"; }?>" id="tab_<?= $p['id'] ?>_<?= $j ?>">
                                                          <div class="row">
                                                            <div class="col-md-6 col-xs-6">
                                                                <h6><strong>Price</strong></h6>
                                                                <h6><strong>GST</strong></h6>
                                                                <h6><strong>Total Price</strong></h6>
                                                            </div>
                                                            <div class="col-md-6 col-xs-6">
                                                                  <?php if($r['discount'] != '0'){ ?>
                                                                    <strong><i class="fa fa-inr" aria-hidden="true"></i> <strike><?= $r['actual_price'] ?></strike>&nbsp;&nbsp;<i class="fa fa-inr" aria-hidden="true"></i> <?php echo $r['actual_price'] - $r['discount']; ?></strong>
                                                                  <?php }
                                                                  else{ ?>
                                                                    <h6><strong><i class="fa fa-inr" aria-hidden="true"></i> <?= $r['actual_price'] ?></strong></h6>
                                                                  <?php } ?>
                                                                <h6><strong><?= $r['gst'] ?>%</strong></h6>
                                                                <h6><strong><i class="fa fa-inr" aria-hidden="true"></i> <?= $r['total_price'] ?></strong></h6>
                                                                <form action="<?= base_url('admin/get_last_log_id_web')?>" method="POST">
                                                                  <input type="hidden" name="user_type" value="3">
                                                                  <input type="hidden" name="request_status" value="1">
                                                                  <input type="hidden" name="type" value="11">
                                                                  <input type="hidden" name="users_id" value="<?= $_SESSION['user_id'] ?>">
                                                                  <!-- <input type="hidden" name="payment_type" value="11"> -->
                                                                  <input type="hidden" name="currency" value="INR">
                                                                  <input type="hidden" name="amount" value="<?= $r['total_price'] ?>">
                                                                  <input type="hidden" name="total_price" value="<?= $r['total_price'] ?>"> 
                                                                  <input type="hidden" name="premium_bull_type" value="<?= $p['id'] ?>">
                                                                  <input type="hidden" name="bull_id" value="<?= $bull_id ?>">
                                                                  <div><input type="submit" class="btn btn-sm btn-danger"></div>
                                                              </form> 
                                                            </div>
                                                          </div>
                                                      </div>
                                                  <?php $j++; } 
                                                    ?>
                                                  
                                                  </div>
                                              </div>
                                            </div>
                                            </div>
                              <?php }  ?>
                  
              </div>
          </div>
           <?php }} ?>
                </div>
            </div>
          </div> 
                     
            </div>
        </div>
        </div>
        </div>
    </section>
</div>