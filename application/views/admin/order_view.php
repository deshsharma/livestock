<style>
.cust-mainbg{background: #ECF0F5; min-height: 100vh}
.cust-wrapper{width: 100%; margin: 0 auto}

.mT40{margin-top: 40px}
.mB40{margin-bottom: 40px}
.mR20{margin-right: 20px}

.cust-addbull button{width: 50%; margin-top: 5px; padding: 10px; font-size: 20px; font-weight: 600; background: #4DA8B0}
.cust-pos{position: relative; top: -30px}
.box-danger2{border-top: 5px solid #0aa8b0; padding: 0 10px;}

.box-header h3{font-size: 26px!important; margin: 20px 0!important;}
.btn-success{background: #c13033; border-color: #c13033 }
.btn-success .fa{padding-right: 10px} 
.error{color:#ff0000;}
.mr5{margin-right:5px; margin-bottom:5px; border:2px solid #fff;}

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
        Product Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php 
      //print_r($order); 
      $data = $this->api_model->get_data('id = '.$order[0]['product_id'].'' , 'product', '', '*');
      $user_data = $this->api_model->get_data('users_id = '.$order[0]['users_id'].'', 'users','','*');
      $product_rate = $this->api_model->get_data('id ='.$order[0]['id'].'','product_package','','*'); 
      //print_r($user_data);
      //print_r($product_rate);
      ?>
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?= $data[0]['name'] ?></h3>
              <div class="col-md-12 ">
			  <?php $image = explode(',', $data[0]['images']); 
							  $i = 0;
							  ?>
							    <div class="col-md-12 product-image-thumbs">
									<img src="<?= base_url().'uploads/product/'.$image[0] ?>" class="product-image" alt="Product Image" style="width:1500px; height:100%;">
								</div>
							  <?php
                            foreach($image as $im){ 
                                if($im != ''){ 
									if($i==0){?>
									<div class="col-md-2 product-image-thumb active"><img src="<?= base_url().'uploads/product/'.$im ?>" alt="Product Image"></div>
									<?php }else{ ?>
										<div class="col-md-2 product-image-thumb" ><img src="<?= base_url().'uploads/product/'.$im ?>" alt="Product Image"></div>
									<?php } 
									$i++;
								}
							}
             ?>
              </div>
			  <div class="col-md-12">
			  <div class="row mt-4">
				<div class="col-md-12 col-12">
          &nbsp;
				<!-- <h4>Product Description</h4>
				<p><?= $data[0]['long_desc'] ?></p> -->
				</div>
				<div class="col-md-12 col-12">
          &nbsp;
					<!-- <h4>Other Description</h4>
					<p><?= $data[0]['other_desc'] ?></p> -->
				</div>
				</div>
			  </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?= $data[0]['name'] ?></h3>
              <p><?= $data[0]['shor_desc'] ?></p>
              <hr>
              <h2 class="lead"><b>Order Detail</b></h2>
                <p class="text-muted text-sm prod"><b>Order ID : </b>#<?= $order[0]['id'] ?></p>
                <p class="text-muted text-sm prod"><b>Order Status : </b><?php 
                                    if($order[0]['isactive'] == '1'){
                                      echo 'Pending';
                                    }else if($order[0]['isactive'] == '2'){
                                      echo "Packed";
                                    }else if($order[0]['isactive'] == '3'){
                                      echo "Intransite";
                                    }else if($order[0]['isactive'] == '4'){
                                      echo "Cancelled";
                                    } ?></p> 
                <p class="text-muted text-sm prod"><b>Costomer Name : </b><?= $user_data[0]['full_name'] ?></p>
                <p class="text-muted text-sm prod"><b>Coustomer Mobile : </b><?= $user_data[0]['mobile'] ?></p>
                <p class="text-muted text-sm prod"><b>Coustomer State : </b><?php $state= $this->api_model->get_state('',$user_data[0]['zone_id']); echo $state[0]['name']; ?></p>
                <p class="text-muted text-sm prod"><b>Coustomer Address : </b><?= $user_data[0]['address'] ?></p>
                <p class="text-muted text-sm prod"><b>Product Package : </b><?= $product_rate[0]['name'] ?></p>
                <p class="text-muted text-sm prod"><b>Product Quantity : </b><?= $order[0]['product_qty'] ?></p>
                <p class="text-muted text-sm prod"><b>Product Rate : </b><?= $order[0]['package_price'] ?>Rs</p>
				<!-- <h3 class="my-3">Composition</h3> -->
				<?php 
                //$composition = $this->api_model->get_packacge_composition_product_id($data[0]['id']); 
                //foreach($composition as $comp){ ?>
                <!-- <p class="text-muted text-sm prod"><b><?= $comp['name'] ?> : </b><?= $comp['value'] ?></p> -->
                <?php //} ?>
              
			  <?php 
                //$product_rate = $this->api_model->get_packacge_rate_product_id($data[0]['id']); 
            	//foreach($product_rate as $pro){ ?>
				  <!-- <div class="bg-gray py-2 px-3 mt-4 pad">
					<h4 class="mb-0">Unit : <?= $pro['name'] ?></h4>
					<small class="mb-0">MRP : <?= $pro['mrp'] ?></small></br>
					<small class="mb-0">Price : <?= $pro['sale_price'] ?></small></br>
					<small class="mb-0">AI Price : <?= $pro['vt_sale_price'] ?></small></br>
				  </div> -->
				<?php //} ?>
              
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>