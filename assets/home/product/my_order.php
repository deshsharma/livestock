<section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">
          <div class="col-12 px-4 px-lg-0">
  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-md-5 bg-white rounded shadow-sm mb-5 p-4">
        <?php $order_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'product_order', '', '*'); 
        $order_count = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'product_order', '', 'count(id) as count');
        $user_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'users', '', '*');
       
          ?>
  <h3 class="pb-3">My Orders<small>(<?= $order_count[0]['count'] ?> Orders)</small></h3>
  <?php foreach($order_data as $od){ 
    $product_data = $this->api_model->get_data('id = "'.$od['product_id'].'"', 'product', '', '*');
    //print_r($product_data);
    ?>                      
  <div class="orderouterbox">            
  <div class="row">
    <div class="col-md-12 orderhead">
      <div class="row">
        <div class="col-6 col-md-2">
          <h5 class="mt-4">ORDER PLACED</h5><small><?= $od['date'] ?></small>
        </div> 
        <div class="col-6 col-md-2">
          <h5 class="mt-4">TOTAL</h5><small>RS <?= number_format($od['package_price']*$od['product_qty'],2) ?></small>
        </div>  
        <div class="col-6 col-md-2">
          <h5 class="mt-4">SHIPS TO</h5><small><?= $user_data[0]['full_name'] ?></small>
        </div> 
        <div class="col-6 col-md-2 ml-auto text-md-right text-center">
          <h5 class="mt-4">ORDER ID</h5><small>#<?= $od['id'] ?></small>
        </div>   
      </div>
    </div>
  </div>    
  <?php $image = explode(',',$product_data[0]['images']); 
  ?>
    <div class="row mt-5 mb-5 orderinfo">
        <div class="col-12 col-md-3 pl-0"><img src="<?= base_url('uploads/product/')?><?= $image[0] ?>" alt="" class="img-fluid rounded"></div>
        <div class="col-12 col-md-6 mt-3">
            <h5><?= $product_data[0]['name'] ?></h5>
            <p><strong>Quantity:</strong> <?= $od['product_qty'] ?> pcs</p>
            <p><strong>Item Price:</strong> Rs <?= number_format($od['package_price']*$od['product_qty'],2) ?></p>
            <p><strong>Order Placed on:</strong> <?= $od['date'] ?></p>
            <p><strong>Delivery Date:</strong> <?= $od['update_date'] ?> </p>
            <p class="primaryBlue"><strong>Delivery Status:</strong>
              <?php  
             
              if($od['isactive'] == '1'){
                                      echo 'Order Placed';
                                    }else if($od['isactive']== '2'){
                                      echo "Item Packed";
                                    }else if($od['isactive'] == '3'){
                                      echo "Intransite";
                                    }else if($od['isactive'] == '4'){
                                      echo "Cancelled";
                                    } 
              ?></p>
        </div>
        
        <div class="col-12 col-md-2 ml-auto mt-4 mt-md-0">
            <a href="<?= base_url('frontend/all_review/').$od['product_id'] ?>" class="btn btn-dark rounded-pill check btn-block mt-4">Write Review</a>
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
                <h5 class="modal-title" id="staticBackdropLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete this product ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
              </div>
            </div>
          </div>
        </div>   
        
        
		</section>

    <?php include('footer.php'); ?>
