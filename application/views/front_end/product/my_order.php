<section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">
          <div class="col-12 px-4 px-lg-0">
            <div class="pb-5">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12 p-md-5 bg-white rounded shadow-sm mb-5 p-4">
                    <?php
                    //print_r($_SESSION); 
                    $order_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'" AND user_type = "'.$this->session->userdata("user_type").'"' , 'product_order', 'id DESC', '*'); 
                    $order_count = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'" AND user_type = "'.$this->session->userdata("user_type").'"' , 'product_order', '', 'count(id) as count');
                    $user_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'users', '', '*'); ?>
                    <h3 class="pb-3"><?= $this->webLanguage['My Orders']?><small>(<?= $order_count[0]['count'] ?> <?= $this->webLanguage['Orders']?>)</small></h3>
                    <?php foreach($order_data as $od){ 
                      $product_data = $this->api_model->get_data('id = "'.$od['product_id'].'"', 'product', '', '*');    
                      $package = $this->api_model->get_data('id = "'.$od['package_id'].'"', 'product_package');             
                      ?>                      
                      <div class="orderouterbox">            
                        <div class="row">
                          <div class="col-md-12 orderhead">
                            <div class="row">
                              <div class="col-6 col-md-2">
                                <h5 class="mt-4"><?= $this->webLanguage['ORDER PLACED']?></h5><small><?= $od['date'] ?></small>
                              </div> 
                              <div class="col-6 col-md-2">
                                <h5 class="mt-4"><?= $this->webLanguage['Total']?></h5><small><?= $this->webLanguage['Rs']?> <?= number_format($od['package_price']*$od['product_qty'],2) ?></small>
                              </div>  
                              <div class="col-6 col-md-2">
                                <h5 class="mt-4"><?= $this->webLanguage['SHIPS TO']?></h5><small><?= $user_data[0]['full_name'] ?></small>
                              </div> 
                              <div class="col-6 col-md-2">
                                <h5 class="mt-4"><?= $this->webLanguage['OTP']?></h5><small><?= $od['otp'] ?></small>
                              </div> 
                              <div class="col-6 col-md-2 ml-auto text-md-right text-center">
                                <h5 class="mt-4"><?= $this->webLanguage['ORDER ID']?></h5><small>#<?= $od['id'] ?></small>
                              </div>   
                            </div>
                          </div>
                        </div>    
                        <?php $image = explode(',',$product_data[0]['images']); 
                        ?>
                        <div class="row mt-5 mb-5 orderinfo">
                          <div class="col-12 col-md-3 pl-0"><div class="forimg"><img src="<?= base_url('harpahu_merge/uploads/product/')?><?= $image[0] ?>" alt="" class="img-fluid rounded"></div></div>
                            <div class="col-12 col-md-6 mt-3">
                                  <h5><?= $product_data[0]['name'] ?></h5>
                                  <p><strong><?= $this->webLanguage['Quantity']?>:</strong> <?= $od['product_qty'] ?> (<?= $package[0]['name'] ?>)</p>
                                  <p><strong><?= $this->webLanguage['Item Price']?>:</strong> Rs <?= number_format($od['package_price']*$od['product_qty'],2) ?></p>
                                  <p><strong><?= $this->webLanguage['Order Placed on']?>:</strong> <?= $od['date'] ?></p>
                                  <?php if($od['isactive'] == '5'){ ?>
                                  <p><strong><?= $this->webLanguage['Delivery Date']?>:</strong> <?= $od['update_date'] ?> </p>
                                  <?php } ?>
                                  <p><strong><?= $this->webLanguage['ORDER TYPE']?>:</strong> <?php if($od['order_type'] == '1'){ echo "Online"; }else{ echo "Cash On Delivery"; } ?> </p>
                                  <p class="primaryBlue"><strong><?= $this->webLanguage['Delivery Status']?>:</strong>
                                    <?php       
                                                          if($od['isactive'] == '0'){
                                                            echo "Pending";
                                                          }else if($od['isactive'] == '1'){
                                                            echo 'Order Placed';
                                                          }else if($od['isactive']== '2'){
                                                            echo "Item Packed";
                                                          }else if($od['isactive'] == '3'){
                                                            echo "In Transit";
                                                          }else if($od['isactive'] == '4'){
                                                            echo "Cancelled";
                                                          }else if($od['isactive'] == '5'){
                                                            echo "Delivered";
                                                          }  
                                    ?></p>
                              </div>                            
                              <div class="col-12 col-md-2 ml-auto mt-4 mt-md-0">
                                  <!-- <a href="#" class="btn btn-dark rounded-pill check btn-block">Track Order</a> -->
                                  <a href="<?= base_url('frontend/all_review/').$od['product_id'] ?>" class="btn btn-dark rounded-pill check btn-block mt-4"><?= $this->webLanguage['Write Review']?></a>
                                  <a href="<?= base_url('api/product_invoice/').$od['id'] ?>" target="__blank" class="btn btn-dark rounded-pill check btn-block mt-4"><?= $this->webLanguage['Invoice']?></a>
                                  <!-- <a href="#" class="btn btn-dark rounded-pill check btn-block mt-4">Cancel Item</a> -->
                              </div>
                        </div>
                      <?php } ?>
                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        
<!-- delete modal -->        
        <div class="modal fade formod" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><?= $this->webLanguage['Delete Product']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <?= $this->webLanguage['Are you sure you want to delete this product']?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"><?= $this->webLanguage['Understood']?></button>
              </div>
            </div>
          </div>
        </div>   
</section>

<?php include('footer_product.php'); ?>
