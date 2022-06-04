    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                              <i class="educate-icon educate-nav"></i>
                                          </button>
                                        </div>
                                    </div>
                                    <?php include('header_user_details.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="courses-area">
        <div class="container-fluid">
          <link rel="stylesheet" href="<?= base_url() ?>assets/allvideos/css/style2.css">
              <section class="ftco-section">
                  <div class="container">
                      <div class="row">
                        <div class="col-lg-10 p-5 bg-white rounded shadow-sm mb-5">
                          <!-- Shopping cart table -->
                          <table class="cartproducts">
                            <h3 class="pb-3">Wishlist</h3>
                            <thead>
                              <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>    
                                <th scope="col">Tutorial Title</th>
                                <!-- <th scope="col">Quantity</th> -->
                                <!-- <th scope="col">Video Price</th> -->
                                <th scope="col">Tutorial Price</th>    
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              //$this->session->userdata("users_id");
                              $whishlist_data = $this->api_model->get_video_whishlist($this->session->userdata("users_id")); 
                              ?>

                                  <?php $cart_session = $this->session->userdata('cart_session');
                                    $price = 0;
                                    $i = 0;
                                    // if(empty($this->session->userdata('cart_session'))){
                                    //   redirect(base_url('frontend/product_listing'));
                                    // }
                                    foreach($whishlist_data as $k=>$cart)
                                    { 
                                        /*echo "<pre>";
                                        print_r($cart);*/
                                        //$products = $this->front_end_model->get_video_details($cart['video_id']);
                                        $videoDetails = $this->front_end_model->get_video_details($cart['video_id']);
                                        $image = explode(',',$videoDetails[0]['video_thumb']);
                                        $price = $videoDetails[0]['price'];
                                        ?>
                                        <tr>
                                          <td class="info"><a class="text-dark" onclick="removelike(<?= $cart['id'] ?>)"><i class="fa fa-trash-o"></i>
                                            <input type="hidden" class="video_id" value="<?= $cart['video_id']; ?>">
                                            <input type="hidden" class="users_id" value="<?= $cart['users_id']; ?>">
                                            <input type="hidden" class="price" value="<?= $price; ?>">
                                          </a>
                                          </td>    
                                          <td><img src="<?= base_url('uploads/videos/images/')?><?= $image[0] ?>" alt="" width="100" class="img-fluid rounded">
                                          </td>
                                          <td data-label="Product"><h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $videoDetails[0]['title'] ?></a></h5>
                                          </td>
                                          <!-- <td data-label="Quantity">
                                              <input type='button' value='-' class='qtyminus' field='quantity' />
                                              <input type='text' name='quantity_<?= $id ?>' value='1' class='qty' />
                                              <input type='button' value='+' class='qtyplus' field='quantity' />
                                          </td> -->
                                         <!--  <td data-label="Price" class="price_sale"><strong><svg class="w10" x="0px" y="0px" viewBox="0 0 500 500">
                                              <use xlink:href="#rupee"></use>
                                              </svg></strong>
                                              <strong class="sale_price">

                                                <?php 
                                                if($this->session->userdata("user_type") == 0){ 
                                                  echo number_format($price, 2);  
                                                }else { 
                                                  echo number_format($price,2); } 
                                                ?>
                                              </strong>
                                          </td> -->
                                          <td data-label="Total Price" class="total_price_sale"><strong><svg class="w10" x="0px" y="0px" viewBox="0 0 500 500">
                                            <use xlink:href="#rupee"></use>
                                            </svg></strong><strong class="total_sale_price"><?php  
                                            if($this->session->userdata("user_type") == 0){
                                              echo number_format(($price) * 1, 2);
                                              $total_price += number_format(($price) * 1 ,2);
                                            }else{
                                              echo number_format(($price) * 1,2);
                                              $total_price += number_format(($price) * 1 ,2);
                                            }
                                            ?>
                                          </strong>
                                          </td>    
                                        </tr>
                            <?php $i++;  } ?>
                            </tbody>
                          </table>    
                    <!-- End -->
                  </div>
                </div>
                <div class="row py-5 p-4 bg-white rounded shadow-sm">
                  <div class="col-lg-6 col-12">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                    <div class="p-4">
                      <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong>Order Subtotal </strong><strong class="text-right"><svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                          <use xlink:href="#rupee"></use>
                          </svg><span class="total_product_price"><?=  number_format($total_price, 2) ?></span></strong></li>
                          <?php $tax =$this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage'); 
                          ?>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong>Tax</strong><strong class="text-right"><svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                          <use xlink:href="#rupee"></use>
                          </svg><span class="tax_product"><?= $app_tax = number_format($total_price*($tax[0]['tax_percentage']/100), 2)  ?></span></strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong>Total</strong><strong class="text-right"><svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                          <use xlink:href="#rupee"></use>
                          </svg><span class="total_product_total"><?= number_format($app_tax + $total_price, 2) ?></span></strong></li>
                      </ul>
                      <?php if($this->session->userdata("users_id") != ""){ ?>
                      <a href="<?= base_url('frontend/product_checkout/') ?>" class="btn btn-dark rounded-pill check btn-block mt-4">Procceed to checkout</a>
                      <?php }else{?>
                        <a href="<?= base_url('frontend/product_reg/') ?>" class="btn btn-dark rounded-pill check btn-block mt-4">Procceed to checkout</a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
            </div>
              </section>
            </div>
          </div>

        <div class="footer-copyright-area">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="footer-copy-right">
                          <p>Copyright © 2020. All rights reserved. LIVESTOC PRO</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <?php include('footer.php'); ?>    
<style type="text/css">
  .pt-5,.py-5 {
  padding-top: 3rem !important; }
.pr-5,.px-5 {
  padding-right: 3rem !important; }
.pb-5,
.py-5 {
  padding-bottom: 3rem !important; }

.pl-5,
.px-5 {
  padding-left: 3rem !important; }

.m-n1 {
  margin: -0.25rem !important; }

.mt-n1,
.my-n1 {
  margin-top: -0.25rem !important; }

.mr-n1,
.mx-n1 {
  margin-right: -0.25rem !important; }

.mb-n1,
.my-n1 {
  margin-bottom: -0.25rem !important; }

.ml-n1,
.mx-n1 {
  margin-left: -0.25rem !important; }

.m-n2 {
  margin: -0.5rem !important; }

.mt-n2,
.my-n2 {
  margin-top: -0.5rem !important; }

.mr-n2,
.mx-n2 {
  margin-right: -0.5rem !important; }

.mb-n2,
.my-n2 {
  margin-bottom: -0.5rem !important; }

.ml-n2,
.mx-n2 {
  margin-left: -0.5rem !important; }

.m-n3 {
  margin: -1rem !important; }

.mt-n3,
.my-n3 {
  margin-top: -1rem !important; }

.mr-n3,
.mx-n3 {
  margin-right: -1rem !important; }

.mb-n3,
.my-n3 {
  margin-bottom: -1rem !important; }

.ml-n3,
.mx-n3 {
  margin-left: -1rem !important; }

.m-n4 {
  margin: -1.5rem !important; }

.mt-n4,
.my-n4 {
  margin-top: -1.5rem !important; }

.mr-n4,
.mx-n4 {
  margin-right: -1.5rem !important; }

.mb-n4,
.my-n4 {
  margin-bottom: -1.5rem !important; }

.ml-n4,
.mx-n4 {
  margin-left: -1.5rem !important; }

.m-n5 {
  margin: -3rem !important; }

.mt-n5,
.my-n5 {
  margin-top: -3rem !important; }

.mr-n5,
.mx-n5 {
  margin-right: -3rem !important; }

.mb-n5,
.my-n5 {
  margin-bottom: -3rem !important; }

.ml-n5,
.mx-n5 {
  margin-left: -3rem !important; }

.m-auto {
  margin: auto !important; }

.mt-auto,
.my-auto {
  margin-top: auto !important; }

.mr-auto,
.mx-auto {
  margin-right: auto !important; }

.mb-auto,
.my-auto {
  margin-bottom: auto !important; }

.ml-auto,
.mx-auto {
  margin-left: auto !important; }

@media (min-width: 576px) {
  .m-sm-0 {
    margin: 0 !important; }
  .mt-sm-0,
  .my-sm-0 {
    margin-top: 0 !important; }
  .mr-sm-0,
  .mx-sm-0 {
    margin-right: 0 !important; }
  .mb-sm-0,
  .my-sm-0 {
    margin-bottom: 0 !important; }
  .ml-sm-0,
  .mx-sm-0 {
    margin-left: 0 !important; }
  .m-sm-1 {
    margin: 0.25rem !important; }
  .mt-sm-1,
  .my-sm-1 {
    margin-top: 0.25rem !important; }
  .mr-sm-1,
  .mx-sm-1 {
    margin-right: 0.25rem !important; }
  .mb-sm-1,
  .my-sm-1 {
    margin-bottom: 0.25rem !important; }
  .ml-sm-1,
  .mx-sm-1 {
    margin-left: 0.25rem !important; }
  .m-sm-2 {
    margin: 0.5rem !important; }
  .mt-sm-2,
  .my-sm-2 {
    margin-top: 0.5rem !important; }
  .mr-sm-2,
  .mx-sm-2 {
    margin-right: 0.5rem !important; }
  .mb-sm-2,
  .my-sm-2 {
    margin-bottom: 0.5rem !important; }
  .ml-sm-2,
  .mx-sm-2 {
    margin-left: 0.5rem !important; }
  .m-sm-3 {
    margin: 1rem !important; }
  .mt-sm-3,
  .my-sm-3 {
    margin-top: 1rem !important; }
  .mr-sm-3,
  .mx-sm-3 {
    margin-right: 1rem !important; }
  .mb-sm-3,
  .my-sm-3 {
    margin-bottom: 1rem !important; }
  .ml-sm-3,
  .mx-sm-3 {
    margin-left: 1rem !important; }
  .m-sm-4 {
    margin: 1.5rem !important; }
  .mt-sm-4,
  .my-sm-4 {
    margin-top: 1.5rem !important; }
  .mr-sm-4,
  .mx-sm-4 {
    margin-right: 1.5rem !important; }
  .mb-sm-4,
  .my-sm-4 {
    margin-bottom: 1.5rem !important; }
  .ml-sm-4,
  .mx-sm-4 {
    margin-left: 1.5rem !important; }
  .m-sm-5 {
    margin: 3rem !important; }
  .mt-sm-5,
  .my-sm-5 {
    margin-top: 3rem !important; }
  .mr-sm-5,
  .mx-sm-5 {
    margin-right: 3rem !important; }
  .mb-sm-5,
  .my-sm-5 {
    margin-bottom: 3rem !important; }
  .ml-sm-5,
  .mx-sm-5 {
    margin-left: 3rem !important; }
  .p-sm-0 {
    padding: 0 !important; }
  .pt-sm-0,
  .py-sm-0 {
    padding-top: 0 !important; }
  .pr-sm-0,
  .px-sm-0 {
    padding-right: 0 !important; }
  .pb-sm-0,
  .py-sm-0 {
    padding-bottom: 0 !important; }
  .pl-sm-0,
  .px-sm-0 {
    padding-left: 0 !important; }
  .p-sm-1 {
    padding: 0.25rem !important; }
  .pt-sm-1,
  .py-sm-1 {
    padding-top: 0.25rem !important; }
  .pr-sm-1,
  .px-sm-1 {
    padding-right: 0.25rem !important; }
  .pb-sm-1,
  .py-sm-1 {
    padding-bottom: 0.25rem !important; }
  .pl-sm-1,
  .px-sm-1 {
    padding-left: 0.25rem !important; }
  .p-sm-2 {
    padding: 0.5rem !important; }
  .pt-sm-2,
  .py-sm-2 {
    padding-top: 0.5rem !important; }
  .pr-sm-2,
  .px-sm-2 {
    padding-right: 0.5rem !important; }
  .pb-sm-2,
  .py-sm-2 {
    padding-bottom: 0.5rem !important; }
  .pl-sm-2,
  .px-sm-2 {
    padding-left: 0.5rem !important; }
  .p-sm-3 {
    padding: 1rem !important; }
  .pt-sm-3,
  .py-sm-3 {
    padding-top: 1rem !important; }
  .pr-sm-3,
  .px-sm-3 {
    padding-right: 1rem !important; }
  .pb-sm-3,
  .py-sm-3 {
    padding-bottom: 1rem !important; }
  .pl-sm-3,
  .px-sm-3 {
    padding-left: 1rem !important; }
  .p-sm-4 {
    padding: 1.5rem !important; }
  .pt-sm-4,
  .py-sm-4 {
    padding-top: 1.5rem !important; }
  .pr-sm-4,
  .px-sm-4 {
    padding-right: 1.5rem !important; }
  .pb-sm-4,
  .py-sm-4 {
    padding-bottom: 1.5rem !important; }
  .pl-sm-4,
  .px-sm-4 {
    padding-left: 1.5rem !important; }
  .p-sm-5 {
    padding: 3rem !important; }
  .pt-sm-5,
  .py-sm-5 {
    padding-top: 3rem !important; }
  .pr-sm-5,
  .px-sm-5 {
    padding-right: 3rem !important; }
  .pb-sm-5,
  .py-sm-5 {
    padding-bottom: 3rem !important; }
  .pl-sm-5,
  .px-sm-5 {
    padding-left: 3rem !important; }
  .m-sm-n1 {
    margin: -0.25rem !important; }
  .mt-sm-n1,
  .my-sm-n1 {
    margin-top: -0.25rem !important; }
  .mr-sm-n1,
  .mx-sm-n1 {
    margin-right: -0.25rem !important; }
  .mb-sm-n1,
  .my-sm-n1 {
    margin-bottom: -0.25rem !important; }
  .ml-sm-n1,
  .mx-sm-n1 {
    margin-left: -0.25rem !important; }
  .m-sm-n2 {
    margin: -0.5rem !important; }
  .mt-sm-n2,
  .my-sm-n2 {
    margin-top: -0.5rem !important; }
  .mr-sm-n2,
  .mx-sm-n2 {
    margin-right: -0.5rem !important; }
  .mb-sm-n2,
  .my-sm-n2 {
    margin-bottom: -0.5rem !important; }
  .ml-sm-n2,
  .mx-sm-n2 {
    margin-left: -0.5rem !important; }
  .m-sm-n3 {
    margin: -1rem !important; }
  .mt-sm-n3,
  .my-sm-n3 {
    margin-top: -1rem !important; }
  .mr-sm-n3,
  .mx-sm-n3 {
    margin-right: -1rem !important; }
  .mb-sm-n3,
  .my-sm-n3 {
    margin-bottom: -1rem !important; }
  .ml-sm-n3,
  .mx-sm-n3 {
    margin-left: -1rem !important; }
  .m-sm-n4 {
    margin: -1.5rem !important; }
  .mt-sm-n4,
  .my-sm-n4 {
    margin-top: -1.5rem !important; }
  .mr-sm-n4,
  .mx-sm-n4 {
    margin-right: -1.5rem !important; }
  .mb-sm-n4,
  .my-sm-n4 {
    margin-bottom: -1.5rem !important; }
  .ml-sm-n4,
  .mx-sm-n4 {
    margin-left: -1.5rem !important; }
  .m-sm-n5 {
    margin: -3rem !important; }
  .mt-sm-n5,
  .my-sm-n5 {
    margin-top: -3rem !important; }
  .mr-sm-n5,
  .mx-sm-n5 {
    margin-right: -3rem !important; }
  .mb-sm-n5,
  .my-sm-n5 {
    margin-bottom: -3rem !important; }
  .ml-sm-n5,
  .mx-sm-n5 {
    margin-left: -3rem !important; }
  .m-sm-auto {
    margin: auto !important; }
  .mt-sm-auto,
  .my-sm-auto {
    margin-top: auto !important; }
  .mr-sm-auto,
  .mx-sm-auto {
    margin-right: auto !important; }
  .mb-sm-auto,
  .my-sm-auto {
    margin-bottom: auto !important; }
  .ml-sm-auto,
  .mx-sm-auto {
    margin-left: auto !important; } }

@media (min-width: 768px) {
  .m-md-0 {
    margin: 0 !important; }
  .mt-md-0,
  .my-md-0 {
    margin-top: 0 !important; }
  .mr-md-0,
  .mx-md-0 {
    margin-right: 0 !important; }
  .mb-md-0,
  .my-md-0 {
    margin-bottom: 0 !important; }
  .ml-md-0,
  .mx-md-0 {
    margin-left: 0 !important; }
  .m-md-1 {
    margin: 0.25rem !important; }
  .mt-md-1,
  .my-md-1 {
    margin-top: 0.25rem !important; }
  .mr-md-1,
  .mx-md-1 {
    margin-right: 0.25rem !important; }
  .mb-md-1,
  .my-md-1 {
    margin-bottom: 0.25rem !important; }
  .ml-md-1,
  .mx-md-1 {
    margin-left: 0.25rem !important; }
  .m-md-2 {
    margin: 0.5rem !important; }
  .mt-md-2,
  .my-md-2 {
    margin-top: 0.5rem !important; }
  .mr-md-2,
  .mx-md-2 {
    margin-right: 0.5rem !important; }
  .mb-md-2,
  .my-md-2 {
    margin-bottom: 0.5rem !important; }
  .ml-md-2,
  .mx-md-2 {
    margin-left: 0.5rem !important; }
  .m-md-3 {
    margin: 1rem !important; }
  .mt-md-3,
  .my-md-3 {
    margin-top: 1rem !important; }
  .mr-md-3,
  .mx-md-3 {
    margin-right: 1rem !important; }
  .mb-md-3,
  .my-md-3 {
    margin-bottom: 1rem !important; }
  .ml-md-3,
  .mx-md-3 {
    margin-left: 1rem !important; }
  .m-md-4 {
    margin: 1.5rem !important; }
  .mt-md-4,
  .my-md-4 {
    margin-top: 1.5rem !important; }
  .mr-md-4,
  .mx-md-4 {
    margin-right: 1.5rem !important; }
  .mb-md-4,
  .my-md-4 {
    margin-bottom: 1.5rem !important; }
  .ml-md-4,
  .mx-md-4 {
    margin-left: 1.5rem !important; }
  .m-md-5 {
    margin: 3rem !important; }
  .mt-md-5,
  .my-md-5 {
    margin-top: 3rem !important; }
  .mr-md-5,
  .mx-md-5 {
    margin-right: 3rem !important; }
  .mb-md-5,
  .my-md-5 {
    margin-bottom: 3rem !important; }
  .ml-md-5,
  .mx-md-5 {
    margin-left: 3rem !important; }
  .p-md-0 {
    padding: 0 !important; }
  .pt-md-0,
  .py-md-0 {
    padding-top: 0 !important; }
  .pr-md-0,
  .px-md-0 {
    padding-right: 0 !important; }
  .pb-md-0,
  .py-md-0 {
    padding-bottom: 0 !important; }
  .pl-md-0,
  .px-md-0 {
    padding-left: 0 !important; }
  .p-md-1 {
    padding: 0.25rem !important; }
  .pt-md-1,
  .py-md-1 {
    padding-top: 0.25rem !important; }
  .pr-md-1,
  .px-md-1 {
    padding-right: 0.25rem !important; }
  .pb-md-1,
  .py-md-1 {
    padding-bottom: 0.25rem !important; }
  .pl-md-1,
  .px-md-1 {
    padding-left: 0.25rem !important; }
  .p-md-2 {
    padding: 0.5rem !important; }
  .pt-md-2,
  .py-md-2 {
    padding-top: 0.5rem !important; }
  .pr-md-2,
  .px-md-2 {
    padding-right: 0.5rem !important; }
  .pb-md-2,
  .py-md-2 {
    padding-bottom: 0.5rem !important; }
  .pl-md-2,
  .px-md-2 {
    padding-left: 0.5rem !important; }
  .p-md-3 {
    padding: 1rem !important; }
  .pt-md-3,
  .py-md-3 {
    padding-top: 1rem !important; }
  .pr-md-3,
  .px-md-3 {
    padding-right: 1rem !important; }
  .pb-md-3,
  .py-md-3 {
    padding-bottom: 1rem !important; }
  .pl-md-3,
  .px-md-3 {
    padding-left: 1rem !important; }
  .p-md-4 {
    padding: 1.5rem !important; }
  .pt-md-4,
  .py-md-4 {
    padding-top: 1.5rem !important; }
  .pr-md-4,
  .px-md-4 {
    padding-right: 1.5rem !important; }
  .pb-md-4,
  .py-md-4 {
    padding-bottom: 1.5rem !important; }
  .pl-md-4,
  .px-md-4 {
    padding-left: 1.5rem !important; }
  .p-md-5 {
    padding: 3rem !important; }
  .pt-md-5,
  .py-md-5 {
    padding-top: 3rem !important; }
  .pr-md-5,
  .px-md-5 {
    padding-right: 3rem !important; }
  .pb-md-5,
  .py-md-5 {
    padding-bottom: 3rem !important; }
  .pl-md-5,
  .px-md-5 {
    padding-left: 3rem !important; }
  .m-md-n1 {
    margin: -0.25rem !important; }
  .mt-md-n1,
  .my-md-n1 {
    margin-top: -0.25rem !important; }
  .mr-md-n1,
  .mx-md-n1 {
    margin-right: -0.25rem !important; }
  .mb-md-n1,
  .my-md-n1 {
    margin-bottom: -0.25rem !important; }
  .ml-md-n1,
  .mx-md-n1 {
    margin-left: -0.25rem !important; }
  .m-md-n2 {
    margin: -0.5rem !important; }
  .mt-md-n2,
  .my-md-n2 {
    margin-top: -0.5rem !important; }
  .mr-md-n2,
  .mx-md-n2 {
    margin-right: -0.5rem !important; }
  .mb-md-n2,
  .my-md-n2 {
    margin-bottom: -0.5rem !important; }
  .ml-md-n2,
  .mx-md-n2 {
    margin-left: -0.5rem !important; }
  .m-md-n3 {
    margin: -1rem !important; }
  .mt-md-n3,
  .my-md-n3 {
    margin-top: -1rem !important; }
  .mr-md-n3,
  .mx-md-n3 {
    margin-right: -1rem !important; }
  .mb-md-n3,
  .my-md-n3 {
    margin-bottom: -1rem !important; }
  .ml-md-n3,
  .mx-md-n3 {
    margin-left: -1rem !important; }
  .m-md-n4 {
    margin: -1.5rem !important; }
  .mt-md-n4,
  .my-md-n4 {
    margin-top: -1.5rem !important; }
  .mr-md-n4,
  .mx-md-n4 {
    margin-right: -1.5rem !important; }
  .mb-md-n4,
  .my-md-n4 {
    margin-bottom: -1.5rem !important; }
  .ml-md-n4,
  .mx-md-n4 {
    margin-left: -1.5rem !important; }
  .m-md-n5 {
    margin: -3rem !important; }
  .mt-md-n5,
  .my-md-n5 {
    margin-top: -3rem !important; }
  .mr-md-n5,
  .mx-md-n5 {
    margin-right: -3rem !important; }
  .mb-md-n5,
  .my-md-n5 {
    margin-bottom: -3rem !important; }
  .ml-md-n5,
  .mx-md-n5 {
    margin-left: -3rem !important; }
  .m-md-auto {
    margin: auto !important; }
  .mt-md-auto,
  .my-md-auto {
    margin-top: auto !important; }
  .mr-md-auto,
  .mx-md-auto {
    margin-right: auto !important; }
  .mb-md-auto,
  .my-md-auto {
    margin-bottom: auto !important; }
  .ml-md-auto,
  .mx-md-auto {
    margin-left: auto !important; } }

@media (min-width: 992px) {
  .m-lg-0 {
    margin: 0 !important; }
  .mt-lg-0,
  .my-lg-0 {
    margin-top: 0 !important; }
  .mr-lg-0,
  .mx-lg-0 {
    margin-right: 0 !important; }
  .mb-lg-0,
  .my-lg-0 {
    margin-bottom: 0 !important; }
  .ml-lg-0,
  .mx-lg-0 {
    margin-left: 0 !important; }
  .m-lg-1 {
    margin: 0.25rem !important; }
  .mt-lg-1,
  .my-lg-1 {
    margin-top: 0.25rem !important; }
  .mr-lg-1,
  .mx-lg-1 {
    margin-right: 0.25rem !important; }
  .mb-lg-1,
  .my-lg-1 {
    margin-bottom: 0.25rem !important; }
  .ml-lg-1,
  .mx-lg-1 {
    margin-left: 0.25rem !important; }
  .m-lg-2 {
    margin: 0.5rem !important; }
  .mt-lg-2,
  .my-lg-2 {
    margin-top: 0.5rem !important; }
  .mr-lg-2,
  .mx-lg-2 {
    margin-right: 0.5rem !important; }
  .mb-lg-2,
  .my-lg-2 {
    margin-bottom: 0.5rem !important; }
  .ml-lg-2,
  .mx-lg-2 {
    margin-left: 0.5rem !important; }
  .m-lg-3 {
    margin: 1rem !important; }
  .mt-lg-3,
  .my-lg-3 {
    margin-top: 1rem !important; }
  .mr-lg-3,
  .mx-lg-3 {
    margin-right: 1rem !important; }
  .mb-lg-3,
  .my-lg-3 {
    margin-bottom: 1rem !important; }
  .ml-lg-3,
  .mx-lg-3 {
    margin-left: 1rem !important; }
  .m-lg-4 {
    margin: 1.5rem !important; }
  .mt-lg-4,
  .my-lg-4 {
    margin-top: 1.5rem !important; }
  .mr-lg-4,
  .mx-lg-4 {
    margin-right: 1.5rem !important; }
  .mb-lg-4,
  .my-lg-4 {
    margin-bottom: 1.5rem !important; }
  .ml-lg-4,
  .mx-lg-4 {
    margin-left: 1.5rem !important; }
  .m-lg-5 {
    margin: 3rem !important; }
  .mt-lg-5,
  .my-lg-5 {
    margin-top: 3rem !important; }
  .mr-lg-5,
  .mx-lg-5 {
    margin-right: 3rem !important; }
  .mb-lg-5,
  .my-lg-5 {
    margin-bottom: 3rem !important; }
  .ml-lg-5,
  .mx-lg-5 {
    margin-left: 3rem !important; }
  .p-lg-0 {
    padding: 0 !important; }
  .pt-lg-0,
  .py-lg-0 {
    padding-top: 0 !important; }
  .pr-lg-0,
  .px-lg-0 {
    padding-right: 0 !important; }
  .pb-lg-0,
  .py-lg-0 {
    padding-bottom: 0 !important; }
  .pl-lg-0,
  .px-lg-0 {
    padding-left: 0 !important; }
  .p-lg-1 {
    padding: 0.25rem !important; }
  .pt-lg-1,
  .py-lg-1 {
    padding-top: 0.25rem !important; }
  .pr-lg-1,
  .px-lg-1 {
    padding-right: 0.25rem !important; }
  .pb-lg-1,
  .py-lg-1 {
    padding-bottom: 0.25rem !important; }
  .pl-lg-1,
  .px-lg-1 {
    padding-left: 0.25rem !important; }
  .p-lg-2 {
    padding: 0.5rem !important; }
  .pt-lg-2,
  .py-lg-2 {
    padding-top: 0.5rem !important; }
  .pr-lg-2,
  .px-lg-2 {
    padding-right: 0.5rem !important; }
  .pb-lg-2,
  .py-lg-2 {
    padding-bottom: 0.5rem !important; }
  .pl-lg-2,
  .px-lg-2 {
    padding-left: 0.5rem !important; }
  .p-lg-3 {
    padding: 1rem !important; }
  .pt-lg-3,
  .py-lg-3 {
    padding-top: 1rem !important; }
  .pr-lg-3,
  .px-lg-3 {
    padding-right: 1rem !important; }
  .pb-lg-3,
  .py-lg-3 {
    padding-bottom: 1rem !important; }
  .pl-lg-3,
  .px-lg-3 {
    padding-left: 1rem !important; }
  .p-lg-4 {
    padding: 1.5rem !important; }
  .pt-lg-4,
  .py-lg-4 {
    padding-top: 1.5rem !important; }
  .pr-lg-4,
  .px-lg-4 {
    padding-right: 1.5rem !important; }
  .pb-lg-4,
  .py-lg-4 {
    padding-bottom: 1.5rem !important; }
  .pl-lg-4,
  .px-lg-4 {
    padding-left: 1.5rem !important; }
  .p-lg-5 {
    padding: 3rem !important; }
  .pt-lg-5,
  .py-lg-5 {
    padding-top: 3rem !important; }
  .pr-lg-5,
  .px-lg-5 {
    padding-right: 3rem !important; }
  .pb-lg-5,
  .py-lg-5 {
    padding-bottom: 3rem !important; }
  .pl-lg-5,
  .px-lg-5 {
    padding-left: 3rem !important; }
  .m-lg-n1 {
    margin: -0.25rem !important; }
  .mt-lg-n1,
  .my-lg-n1 {
    margin-top: -0.25rem !important; }
  .mr-lg-n1,
  .mx-lg-n1 {
    margin-right: -0.25rem !important; }
  .mb-lg-n1,
  .my-lg-n1 {
    margin-bottom: -0.25rem !important; }
  .ml-lg-n1,
  .mx-lg-n1 {
    margin-left: -0.25rem !important; }
  .m-lg-n2 {
    margin: -0.5rem !important; }
  .mt-lg-n2,
  .my-lg-n2 {
    margin-top: -0.5rem !important; }
  .mr-lg-n2,
  .mx-lg-n2 {
    margin-right: -0.5rem !important; }
  .mb-lg-n2,
  .my-lg-n2 {
    margin-bottom: -0.5rem !important; }
  .ml-lg-n2,
  .mx-lg-n2 {
    margin-left: -0.5rem !important; }
  .m-lg-n3 {
    margin: -1rem !important; }
  .mt-lg-n3,
  .my-lg-n3 {
    margin-top: -1rem !important; }
  .mr-lg-n3,
  .mx-lg-n3 {
    margin-right: -1rem !important; }
  .mb-lg-n3,
  .my-lg-n3 {
    margin-bottom: -1rem !important; }
  .ml-lg-n3,
  .mx-lg-n3 {
    margin-left: -1rem !important; }
  .m-lg-n4 {
    margin: -1.5rem !important; }
  .mt-lg-n4,
  .my-lg-n4 {
    margin-top: -1.5rem !important; }
  .mr-lg-n4,
  .mx-lg-n4 {
    margin-right: -1.5rem !important; }
  .mb-lg-n4,
  .my-lg-n4 {
    margin-bottom: -1.5rem !important; }
  .ml-lg-n4,
  .mx-lg-n4 {
    margin-left: -1.5rem !important; }
  .m-lg-n5 {
    margin: -3rem !important; }
  .mt-lg-n5,
  .my-lg-n5 {
    margin-top: -3rem !important; }
  .mr-lg-n5,
  .mx-lg-n5 {
    margin-right: -3rem !important; }
  .mb-lg-n5,
  .my-lg-n5 {
    margin-bottom: -3rem !important; }
  .ml-lg-n5,
  .mx-lg-n5 {
    margin-left: -3rem !important; }
  .m-lg-auto {
    margin: auto !important; }
  .mt-lg-auto,
  .my-lg-auto {
    margin-top: auto !important; }
  .mr-lg-auto,
  .mx-lg-auto {
    margin-right: auto !important; }
  .mb-lg-auto,
  .my-lg-auto {
    margin-bottom: auto !important; }
  .ml-lg-auto,
  .mx-lg-auto {
    margin-left: auto !important; } }

@media (min-width: 1200px) {
  .m-xl-0 {
    margin: 0 !important; }
  .mt-xl-0,
  .my-xl-0 {
    margin-top: 0 !important; }
  .mr-xl-0,
  .mx-xl-0 {
    margin-right: 0 !important; }
  .mb-xl-0,
  .my-xl-0 {
    margin-bottom: 0 !important; }
  .ml-xl-0,
  .mx-xl-0 {
    margin-left: 0 !important; }
  .m-xl-1 {
    margin: 0.25rem !important; }
  .mt-xl-1,
  .my-xl-1 {
    margin-top: 0.25rem !important; }
  .mr-xl-1,
  .mx-xl-1 {
    margin-right: 0.25rem !important; }
  .mb-xl-1,
  .my-xl-1 {
    margin-bottom: 0.25rem !important; }
  .ml-xl-1,
  .mx-xl-1 {
    margin-left: 0.25rem !important; }
  .m-xl-2 {
    margin: 0.5rem !important; }
  .mt-xl-2,
  .my-xl-2 {
    margin-top: 0.5rem !important; }
  .mr-xl-2,
  .mx-xl-2 {
    margin-right: 0.5rem !important; }
  .mb-xl-2,
  .my-xl-2 {
    margin-bottom: 0.5rem !important; }
  .ml-xl-2,
  .mx-xl-2 {
    margin-left: 0.5rem !important; }
  .m-xl-3 {
    margin: 1rem !important; }
  .mt-xl-3,
  .my-xl-3 {
    margin-top: 1rem !important; }
  .mr-xl-3,
  .mx-xl-3 {
    margin-right: 1rem !important; }
  .mb-xl-3,
  .my-xl-3 {
    margin-bottom: 1rem !important; }
  .ml-xl-3,
  .mx-xl-3 {
    margin-left: 1rem !important; }
  .m-xl-4 {
    margin: 1.5rem !important; }
  .mt-xl-4,
  .my-xl-4 {
    margin-top: 1.5rem !important; }
  .mr-xl-4,
  .mx-xl-4 {
    margin-right: 1.5rem !important; }
  .mb-xl-4,
  .my-xl-4 {
    margin-bottom: 1.5rem !important; }
  .ml-xl-4,
  .mx-xl-4 {
    margin-left: 1.5rem !important; }
  .m-xl-5 {
    margin: 3rem !important; }
  .mt-xl-5,
  .my-xl-5 {
    margin-top: 3rem !important; }
  .mr-xl-5,
  .mx-xl-5 {
    margin-right: 3rem !important; }
  .mb-xl-5,
  .my-xl-5 {
    margin-bottom: 3rem !important; }
  .ml-xl-5,
  .mx-xl-5 {
    margin-left: 3rem !important; }
  .p-xl-0 {
    padding: 0 !important; }
  .pt-xl-0,
  .py-xl-0 {
    padding-top: 0 !important; }
  .pr-xl-0,
  .px-xl-0 {
    padding-right: 0 !important; }
  .pb-xl-0,
  .py-xl-0 {
    padding-bottom: 0 !important; }
  .pl-xl-0,
  .px-xl-0 {
    padding-left: 0 !important; }
  .p-xl-1 {
    padding: 0.25rem !important; }
  .pt-xl-1,
  .py-xl-1 {
    padding-top: 0.25rem !important; }
  .pr-xl-1,
  .px-xl-1 {
    padding-right: 0.25rem !important; }
  .pb-xl-1,
  .py-xl-1 {
    padding-bottom: 0.25rem !important; }
  .pl-xl-1,
  .px-xl-1 {
    padding-left: 0.25rem !important; }
  .p-xl-2 {
    padding: 0.5rem !important; }
  .pt-xl-2,
  .py-xl-2 {
    padding-top: 0.5rem !important; }
  .pr-xl-2,
  .px-xl-2 {
    padding-right: 0.5rem !important; }
  .pb-xl-2,
  .py-xl-2 {
    padding-bottom: 0.5rem !important; }
  .pl-xl-2,
  .px-xl-2 {
    padding-left: 0.5rem !important; }
  .p-xl-3 {
    padding: 1rem !important; }
  .pt-xl-3,
  .py-xl-3 {
    padding-top: 1rem !important; }
  .pr-xl-3,
  .px-xl-3 {
    padding-right: 1rem !important; }
  .pb-xl-3,
  .py-xl-3 {
    padding-bottom: 1rem !important; }
  .pl-xl-3,
  .px-xl-3 {
    padding-left: 1rem !important; }
  .p-xl-4 {
    padding: 1.5rem !important; }
  .pt-xl-4,
  .py-xl-4 {
    padding-top: 1.5rem !important; }
  .pr-xl-4,
  .px-xl-4 {
    padding-right: 1.5rem !important; }
  .pb-xl-4,
  .py-xl-4 {
    padding-bottom: 1.5rem !important; }
  .pl-xl-4,
  .px-xl-4 {
    padding-left: 1.5rem !important; }
  .p-xl-5 {
    padding: 3rem !important; }
  .pt-xl-5,
  .py-xl-5 {
    padding-top: 3rem !important; }
  .pr-xl-5,
  .px-xl-5 {
    padding-right: 3rem !important; }
  .pb-xl-5,
  .py-xl-5 {
    padding-bottom: 3rem !important; }
  .pl-xl-5,
  .px-xl-5 {
    padding-left: 3rem !important; }
  .m-xl-n1 {
    margin: -0.25rem !important; }
  .mt-xl-n1,
  .my-xl-n1 {
    margin-top: -0.25rem !important; }
  .mr-xl-n1,
  .mx-xl-n1 {
    margin-right: -0.25rem !important; }
  .mb-xl-n1,
  .my-xl-n1 {
    margin-bottom: -0.25rem !important; }
  .ml-xl-n1,
  .mx-xl-n1 {
    margin-left: -0.25rem !important; }
  .m-xl-n2 {
    margin: -0.5rem !important; }
  .mt-xl-n2,
  .my-xl-n2 {
    margin-top: -0.5rem !important; }
  .mr-xl-n2,
  .mx-xl-n2 {
    margin-right: -0.5rem !important; }
  .mb-xl-n2,
  .my-xl-n2 {
    margin-bottom: -0.5rem !important; }
  .ml-xl-n2,
  .mx-xl-n2 {
    margin-left: -0.5rem !important; }
  .m-xl-n3 {
    margin: -1rem !important; }
  .mt-xl-n3,
  .my-xl-n3 {
    margin-top: -1rem !important; }
  .mr-xl-n3,
  .mx-xl-n3 {
    margin-right: -1rem !important; }
  .mb-xl-n3,
  .my-xl-n3 {
    margin-bottom: -1rem !important; }
  .ml-xl-n3,
  .mx-xl-n3 {
    margin-left: -1rem !important; }
  .m-xl-n4 {
    margin: -1.5rem !important; }
  .mt-xl-n4,
  .my-xl-n4 {
    margin-top: -1.5rem !important; }
  .mr-xl-n4,
  .mx-xl-n4 {
    margin-right: -1.5rem !important; }
  .mb-xl-n4,
  .my-xl-n4 {
    margin-bottom: -1.5rem !important; }
  .ml-xl-n4,
  .mx-xl-n4 {
    margin-left: -1.5rem !important; }
  .m-xl-n5 {
    margin: -3rem !important; }
  .mt-xl-n5,
  .my-xl-n5 {
    margin-top: -3rem !important; }
  .mr-xl-n5,
  .mx-xl-n5 {
    margin-right: -3rem !important; }
  .mb-xl-n5,
  .my-xl-n5 {
    margin-bottom: -3rem !important; }
  .ml-xl-n5,
  .mx-xl-n5 {
    margin-left: -3rem !important; }
  .m-xl-auto {
    margin: auto !important; }
  .mt-xl-auto,
  .my-xl-auto {
    margin-top: auto !important; }
  .mr-xl-auto,
  .mx-xl-auto {
    margin-right: auto !important; }
  .mb-xl-auto,
  .my-xl-auto {
    margin-bottom: auto !important; }
  .ml-xl-auto,
  .mx-xl-auto {
    margin-left: auto !important; } }

.text-monospace {
  font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }

.text-justify {
  text-align: justify !important; }

.text-wrap {
  white-space: normal !important; }

.text-nowrap {
  white-space: nowrap !important; }

.text-truncate {
  overflow: hidden;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  white-space: nowrap; }

.text-left {
  text-align: left !important; }

.text-right {
  text-align: right !important; }

.text-center {
  text-align: center !important; }

@media (min-width: 576px) {
  .text-sm-left {
    text-align: left !important; }
  .text-sm-right {
    text-align: right !important; }
  .text-sm-center {
    text-align: center !important; } }

@media (min-width: 768px) {
  .text-md-left {
    text-align: left !important; }
  .text-md-right {
    text-align: right !important; }
  .text-md-center {
    text-align: center !important; } }

@media (min-width: 992px) {
  .text-lg-left {
    text-align: left !important; }
  .text-lg-right {
    text-align: right !important; }
  .text-lg-center {
    text-align: center !important; } }

@media (min-width: 1200px) {
  .text-xl-left {
    text-align: left !important; }
  .text-xl-right {
    text-align: right !important; }
  .text-xl-center {
    text-align: center !important; } }

.text-lowercase {
  text-transform: lowercase !important; }

.text-uppercase {
  text-transform: uppercase !important; }

.text-capitalize {
  text-transform: capitalize !important; }

.font-weight-light {
  font-weight: 300 !important; }

.font-weight-lighter {
  font-weight: lighter !important; }

.font-weight-normal {
  font-weight: 400 !important; }

.font-weight-bold {
  font-weight: 700 !important; }

.font-weight-bolder {
  font-weight: bolder !important; }

.font-italic {
  font-style: italic !important; }

.text-white {
  color: #fff !important; }

.text-primary {
  color: #007bff !important; }

a.text-primary:hover, a.text-primary:focus {
  color: #0056b3 !important; }

.text-secondary {
  color: #6c757d !important; }

a.text-secondary:hover, a.text-secondary:focus {
  color: #494f54 !important; }

.text-success {
  color: #28a745 !important; }

a.text-success:hover, a.text-success:focus {
  color: #19692c !important; }

.text-info {
  color: #17a2b8 !important; }

a.text-info:hover, a.text-info:focus {
  color: #0f6674 !important; }

.text-warning {
  color: #ffc107 !important; }

a.text-warning:hover, a.text-warning:focus {
  color: #ba8b00 !important; }

.text-danger {
  color: #dc3545 !important; }

a.text-danger:hover, a.text-danger:focus {
  color: #a71d2a !important; }

.text-light {
  color: #f8f9fa !important; }

a.text-light:hover, a.text-light:focus {
  color: #cbd3da !important; }

.text-dark {
  color: #343a40 !important; }

a.text-dark:hover, a.text-dark:focus {
  color: #121416 !important; }

.text-body {
  color: #212529 !important; }

.text-muted {
  color: #6c757d !important; }

.text-black-50 {
  color: rgba(0, 0, 0, 0.5) !important; }

.text-white-50 {
  color: rgba(255, 255, 255, 0.5) !important; }

.text-hide {
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0; }

.text-decoration-none {
  text-decoration: none !important; }

.text-reset {
  color: inherit !important; }

.visible {
  visibility: visible !important; }

.invisible {
  visibility: hidden !important; }

@media print {
  *,
  *::before,
  *::after {
    text-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important; }
  a:not(.btn) {
    text-decoration: underline; }
  abbr[title]::after {
    content: " (" attr(title) ")"; }
  pre {
    white-space: pre-wrap !important; }
  pre,
  blockquote {
    border: 1px solid #adb5bd;
    page-break-inside: avoid; }
  thead {
    display: table-header-group; }
  tr,
  img {
    page-break-inside: avoid; }
  p,
  h2,
  h3 {
    orphans: 3;
    widows: 3; }
  h2,
  h3 {
    page-break-after: avoid; }
  @page {
    size: a3; }
  body {
    min-width: 992px !important; }
  .container {
    min-width: 992px !important; }
  .navbar {
    display: none; }
  .badge {
    border: 1px solid #000; }
  .table {
    border-collapse: collapse !important; }
    .table td,
    .table th {
      background-color: #fff !important; }
  .table-bordered th,
  .table-bordered td {
    border: 1px solid #dee2e6 !important; }
  .table-dark {
    color: inherit; }
    .table-dark th,
    .table-dark td,
    .table-dark thead th,
    .table-dark tbody + tbody {
      border-color: #dee2e6; }
  .table .thead-dark th {
    color: inherit;
    border-color: #dee2e6; } }

body {
  font-family: "Poppins", Arial, sans-serif;
  background: #fff;
  font-size: 15px;
  line-height: 1.8;
  font-weight: 400;
  color: gray; }
  body.menu-show {
    overflow: hidden;
    position: fixed;
    height: 100%;
    width: 100%; }

a {
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease;
  color: #00afef; }
  a:hover, a:focus {
    text-decoration: none;
    color: #00afef; }

h1, h2, h3, h4, h5,
.h1, .h2, .h3, .h4, .h5 {
  line-height: 1.5;
  font-weight: 400;
  color: #000000;
  font-family: "Poppins", Arial, sans-serif; }

.text-primary {
  color: #00afef !important; }

.topper {
  font-size: 11px;
  width: 100%;
  display: block;
  text-transform: uppercase;
  letter-spacing: 1px; }
  @media (max-width: 767.98px) {
    .topper {
      margin-bottom: 10px; } }
  .topper .icon span {
    color: #fff; }
  .topper .text {
    width: calc(100% - 30px);
    color: white; }

.ftco-navbar-light {
  background: transparent !important;
  z-index: 3;
  padding: 0; }
  @media (max-width: 991.98px) {
    .ftco-navbar-light {
      background: #000000 !important;
      position: relative;
      top: 0;
      padding: 10px 15px; } }
  .ftco-navbar-light.ftco-navbar-light-2 {
    position: relative;
    top: 0; }
  .ftco-navbar-light .navbar-brand {
    color: #00afef; }
    .ftco-navbar-light .navbar-brand:hover, .ftco-navbar-light .navbar-brand:focus {
      color: #000000; }
    @media (max-width: 991.98px) {
      .ftco-navbar-light .navbar-brand {
        color: #fff; } }
  @media (max-width: 991.98px) {
    .ftco-navbar-light .navbar-nav {
      padding-bottom: 10px; } }
  .ftco-navbar-light .navbar-nav > .nav-item > .nav-link {
    font-size: 11px;
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    padding-left: 20px;
    padding-right: 20px;
    font-weight: 400;
    color: #000000;
    text-transform: uppercase;
    letter-spacing: 2px;
    opacity: 1 !important; }
    .ftco-navbar-light .navbar-nav > .nav-item > .nav-link:hover {
      color: #000000; }
    @media (max-width: 991.98px) {
      .ftco-navbar-light .navbar-nav > .nav-item > .nav-link {
        padding-left: 0;
        padding-right: 0;
        padding-top: .9rem;
        padding-bottom: .9rem;
        color: rgba(255, 255, 255, 0.7); }
        .ftco-navbar-light .navbar-nav > .nav-item > .nav-link:hover {
          color: #fff; } }
  .ftco-navbar-light .navbar-nav > .nav-item .dropdown-menu {
    border: none;
    background: #fff;
    -webkit-box-shadow: 0px 10px 34px -20px rgba(0, 0, 0, 0.41);
    -moz-box-shadow: 0px 10px 34px -20px rgba(0, 0, 0, 0.41);
    box-shadow: 0px 10px 34px -20px rgba(0, 0, 0, 0.41);
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    border-radius: 0; }
    .ftco-navbar-light .navbar-nav > .nav-item .dropdown-menu .dropdown-item {
      font-size: 14px; }
      .ftco-navbar-light .navbar-nav > .nav-item .dropdown-menu .dropdown-item:hover, .ftco-navbar-light .navbar-nav > .nav-item .dropdown-menu .dropdown-item:focus {
        background: transparent;
        color: #000000; }
  .ftco-navbar-light .navbar-nav > .nav-item.ftco-seperator {
    position: relative;
    margin-left: 20px;
    padding-left: 20px; }
    @media (max-width: 991.98px) {
      .ftco-navbar-light .navbar-nav > .nav-item.ftco-seperator {
        padding-left: 0;
        margin-left: 0; } }
    .ftco-navbar-light .navbar-nav > .nav-item.ftco-seperator:before {
      position: absolute;
      content: "";
      top: 10px;
      bottom: 10px;
      left: 0;
      width: 2px;
      background: rgba(255, 255, 255, 0.05); }
      @media (max-width: 991.98px) {
        .ftco-navbar-light .navbar-nav > .nav-item.ftco-seperator:before {
          display: none; } }
  .ftco-navbar-light .navbar-nav > .nav-item.cta > a {
    color: #000000; }
    @media (max-width: 767.98px) {
      .ftco-navbar-light .navbar-nav > .nav-item.cta > a {
        padding-left: 15px;
        padding-right: 15px; } }
    @media (max-width: 991.98px) {
      .ftco-navbar-light .navbar-nav > .nav-item.cta > a {
        color: #fff;
        background: #00afef; } }
  .ftco-navbar-light .navbar-nav > .nav-item.active > a {
    color: #000000; }
    @media (max-width: 991.98px) {
      .ftco-navbar-light .navbar-nav > .nav-item.active > a {
        color: #fff; } }
  .ftco-navbar-light .navbar-toggler {
    border: none;
    color: rgba(255, 255, 255, 0.5) !important;
    cursor: pointer;
    padding-right: 0;
    text-transform: uppercase;
    font-size: 16px;
    letter-spacing: .1em; }
    .ftco-navbar-light .navbar-toggler:focus {
      outline: none !important; }
  .ftco-navbar-light.scrolled {
    position: fixed;
    right: 0;
    left: 0;
    top: 0;
    margin-top: -130px;
    background: #fff !important;
    -webkit-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1); }
    .ftco-navbar-light.scrolled .nav-item.active > a {
      color: #00afef !important; }
    .ftco-navbar-light.scrolled .nav-item.cta > a {
      color: #fff !important;
      background: #00afef;
      border: none !important; }
      .ftco-navbar-light.scrolled .nav-item.cta > a span {
        display: inline-block;
        color: #fff !important; }
    .ftco-navbar-light.scrolled .nav-item.cta.cta-colored span {
      border-color: #00afef; }
    @media (max-width: 991.98px) {
      .ftco-navbar-light.scrolled .navbar-nav {
        background: none;
        border-radius: 0px;
        padding-left: 0rem !important;
        padding-right: 0rem !important; } }
    @media (max-width: 767.98px) {
      .ftco-navbar-light.scrolled .navbar-nav {
        background: none;
        padding-left: 0 !important;
        padding-right: 0 !important; } }
    .ftco-navbar-light.scrolled .navbar-toggler {
      border: none;
      color: rgba(0, 0, 0, 0.5) !important;
      border-color: rgba(0, 0, 0, 0.5) !important;
      cursor: pointer;
      padding-right: 0;
      text-transform: uppercase;
      font-size: 16px;
      letter-spacing: .1em; }
    .ftco-navbar-light.scrolled .nav-link {
      padding-top: 0.9rem !important;
      padding-bottom: 0.9rem !important;
      color: #000000 !important; }
      .ftco-navbar-light.scrolled .nav-link.active {
        color: #00afef !important; }
    .ftco-navbar-light.scrolled.awake {
      margin-top: 0px;
      -webkit-transition: .3s all ease-out;
      -o-transition: .3s all ease-out;
      transition: .3s all ease-out; }
    .ftco-navbar-light.scrolled.sleep {
      -webkit-transition: .3s all ease-out;
      -o-transition: .3s all ease-out;
      transition: .3s all ease-out; }
    .ftco-navbar-light.scrolled .navbar-brand {
      color: #000000; }

.navbar-brand {
  font-weight: 800;
  font-size: 20px;
  text-transform: uppercase; }

.hero-wrap {
  width: 100%;
  position: relative; }
  .hero-wrap .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    content: '';
    opacity: .6;
    width: 50%;
    background: #00afef; }
  .hero-wrap .slider-text {
    color: #fff;
    position: relative; }
    .hero-wrap .slider-text .breadcrumbs {
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 3px;
      margin-bottom: 0;
      z-index: 99;
      font-weight: 300; }
      .hero-wrap .slider-text .breadcrumbs span {
        color: white; }
        .hero-wrap .slider-text .breadcrumbs span a {
          color: #fff; }
    .hero-wrap .slider-text .bread {
      font-weight: 800;
      color: #fff;
      font-size: 30px;
      font-family: "Poppins", Arial, sans-serif;
      letter-spacing: 3px;
      text-transform: uppercase; }
    .hero-wrap .slider-text .btn-primary {
      border: 1px solid rgba(255, 255, 255, 0.4);
      -webkit-border-radius: 30px;
      -moz-border-radius: 30px;
      -ms-border-radius: 30px;
      border-radius: 30px; }
      .hero-wrap .slider-text .btn-primary:hover, .hero-wrap .slider-text .btn-primary:focus {
        background: #fff !important;
        color: #000000; }
  .hero-wrap.hero-bread {
    padding: 10em 0; }

.mouse {
  position: absolute;
  left: 0;
  right: 0;
  top: -30px;
  z-index: 99; }

.mouse-icon {
  width: 60px;
  height: 60px;
  border: 1px solid rgba(255, 255, 255, 0.7);
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  border-radius: 50%;
  background: #00afef;
  cursor: pointer;
  position: relative;
  text-align: center;
  margin: 0 auto;
  display: block; }

.mouse-wheel {
  height: 30px;
  margin: 2px auto 0;
  display: block;
  width: 30px;
  background: transparent;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  border-radius: 50%;
  -webkit-animation: 1.6s ease infinite wheel-up-down;
  -moz-animation: 1.6s ease infinite wheel-up-down;
  animation: 1.6s ease infinite wheel-up-down;
  color: #fff;
  font-size: 20px; }

@-webkit-keyframes wheel-up-down {
  100% {
    margin-top: 2px;
    opacity: 1; }
  30% {
    opacity: 1; }
  0% {
    margin-top: 20px;
    opacity: 0; } }

@-moz-keyframes wheel-up-down {
  100% {
    margin-top: 2px;
    opacity: 1; }
  30% {
    opacity: 1; }
  0% {
    margin-top: 20px;
    opacity: 0; } }

@keyframes wheel-up-down {
  100% {
    margin-top: 2px;
    opacity: 1; }
  30% {
    opacity: 1; }
  0% {
    margin-top: 20px;
    opacity: 0; } }

.owl-carousel {
  position: relative; }
  .owl-carousel .owl-item {
    opacity: .4; }
    .owl-carousel .owl-item.active {
      opacity: 1; }
  .owl-carousel .owl-dots {
    text-align: center; }
    .owl-carousel .owl-dots .owl-dot {
      width: 10px;
      height: 10px;
      margin: 5px;
      border-radius: 50%;
      background: #e6e6e6;
      position: relative; }
      .owl-carousel .owl-dots .owl-dot:after {
        position: absolute;
        top: -2px;
        left: -2px;
        right: 0;
        bottom: 0;
        width: 14px;
        height: 14px;
        content: '';
        border: 1px solid rgba(255, 255, 255, 0.3);
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%; }
      .owl-carousel .owl-dots .owl-dot:hover, .owl-carousel .owl-dots .owl-dot:focus {
        outline: none !important; }
      .owl-carousel .owl-dots .owl-dot.active {
        background: #b3b3b3; }
  .owl-carousel.home-slider {
    position: relative;
    height: 55vh;
    z-index: 0; }
    .owl-carousel.home-slider .slider-item {
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      height: 55vh;
      position: relative;
      z-index: 0; }

 @media (max-width: 768px) {
    .owl-carousel.home-slider .slider-item {
      background-size: 100%;
      height: auto;  
     }
     .owl-carousel.home-slider{height: 300px}
     
     .owl-carousel.home-slider .slider-item .slider-text {
         min-height: 250px; height: auto!important}
     .ftco-section {
         padding: 2em 0!important;}
}


      @media (max-width: 1199.98px) {
        
        .owl-carousel.home-slider .slider-item {
          background-position: center center !important; } }
      .owl-carousel.home-slider .slider-item .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: #000000;
        opacity: .2; }
      .owl-carousel.home-slider .slider-item .slider-text {
        height: 650px;
        z-index: 0; }
        @media (max-width: 991.98px) {
          .owl-carousel.home-slider .slider-item .slider-text {
            text-align: center; } }
        .owl-carousel.home-slider .slider-item .slider-text .subheading {
          color: #000000;
          font-weight: 300;
          font-size: 12px;
          letter-spacing: 4px;
          text-transform: uppercase;
          display: inline-block;
          color: #fff; }
        .owl-carousel.home-slider .slider-item .slider-text h1 {
          font-size: 8vw;
          color: #fff;
          line-height: 1.3;
          font-weight: 400;
          font-family: "Amatic SC", cursive; }
          @media (max-width: 767.98px) {
            .owl-carousel.home-slider .slider-item .slider-text h1 {
              font-size: 40px; } }
        .owl-carousel.home-slider .slider-item .slider-text p {
          color: rgba(0, 0, 0, 0.8);
          font-weight: 400; }
          @media (max-width: 991.98px) {
            .owl-carousel.home-slider .slider-item .slider-text p {
              color: rgba(255, 255, 255, 0.7);
              font-size: 23px; } }
    .owl-carousel.home-slider .owl-nav {
      position: absolute;
      bottom: 60px !important;
      left: 0;
      right: 0;
      margin: 0 auto; }
      @media (max-width: 991.98px) {
        .owl-carousel.home-slider .owl-nav {
          display: none; } }
      .owl-carousel.home-slider .owl-nav .owl-prev,
      .owl-carousel.home-slider .owl-nav .owl-next {
        position: absolute;
        width: 60px;
        height: 60px;
        background: #fff !important;
        -moz-transition: all 0.7s ease;
        -o-transition: all 0.7s ease;
        -webkit-transition: all 0.7s ease;
        -ms-transition: all 0.7s ease;
        transition: all 0.7s ease;
        opacity: 1; }
        .owl-carousel.home-slider .owl-nav .owl-prev span:before,
        .owl-carousel.home-slider .owl-nav .owl-next span:before {
          font-size: 20px;
          margin-top: 7px;
          color: #000000; }
      .owl-carousel.home-slider .owl-nav .owl-prev {
        top: 0 !important;
        right: 0 !important; }
        @media (min-width: 992px) {
          .owl-carousel.home-slider .owl-nav .owl-prev {
            right: 61px !important; } }
        .owl-carousel.home-slider .owl-nav .owl-prev:hover, .owl-carousel.home-slider .owl-nav .owl-prev:focus {
          background: #000000 !important;
          outline: none !important; }
          .owl-carousel.home-slider .owl-nav .owl-prev:hover span:before, .owl-carousel.home-slider .owl-nav .owl-prev:focus span:before {
            font-size: 20px;
            margin-top: 7px;
            color: #00afef; }
      .owl-carousel.home-slider .owl-nav .owl-next {
        top: 0 !important;
        right: 0 !important; }
        @media (min-width: 992px) {
          .owl-carousel.home-slider .owl-nav .owl-next {
            right: 0 !important; } }
        .owl-carousel.home-slider .owl-nav .owl-next:hover, .owl-carousel.home-slider .owl-nav .owl-next:focus {
          background: #000000 !important;
          outline: none !important; }
          .owl-carousel.home-slider .owl-nav .owl-next:hover span:before, .owl-carousel.home-slider .owl-nav .owl-next:focus span:before {
            font-size: 24px;
            margin-top: 7px;
            color: #00afef; }
    .owl-carousel.home-slider .owl-dots {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 40px;
      width: 100%;
      text-align: center; }
      @media (min-width: 992px) {
        .owl-carousel.home-slider .owl-dots {
          display: none; } }
      @media (max-width: 767.98px) {
        .owl-carousel.home-slider .owl-dots {
          bottom: 5px; } }
      .owl-carousel.home-slider .owl-dots .owl-dot {
        width: 10px;
        height: 10px;
        margin: 5px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.4); }
        .owl-carousel.home-slider .owl-dots .owl-dot.active {
          background: #46b0ef; }

.bg-light {
  background: #f7f6f2 !important; }

.bg-primary {
  background: #00afef; }

.bg-secondary {
  background: #ffe6eb !important; }

.bg-color-1 {
  background: #e4b2d6; }

.bg-color-2 {
  background: #dcc698; }

.bg-color-3 {
  background: #a2d1e1; }

.bg-color-4 {
  background: #dcd691; }

.btn {
  cursor: pointer;
  -webkit-border-radius: 30px;
  -moz-border-radius: 30px;
  -ms-border-radius: 30px;
  border-radius: 30px;
  -webkit-box-shadow: 0px 24px 36px -11px rgba(0, 0, 0, 0.09);
  -moz-box-shadow: 0px 24px 36px -11px rgba(0, 0, 0, 0.09);
  box-shadow: 0px 24px 36px -11px rgba(0, 0, 0, 0.09); }
  .btn:hover, .btn:active, .btn:focus {
    outline: none; }
  .btn.btn-primary {
    background: ##00afef;
    border: 1px solid #00afef;
    color: #fff; }
    .btn.btn-primary:hover {
      border: 1px solid #00afef;
      background: transparent;
      color: #00afef; }
    .btn.btn-primary.btn-outline-primary {
      border: 1px solid #00afef;
      background: transparent;
      color: #00afef; }
      .btn.btn-primary.btn-outline-primary:hover {
        border: 1px solid transparent;
        background: #00afef;
        color: #fff; }
  .btn.btn-white {
    background: #fff;
    border: 1px solid #fff;
    color: #000000; }
    .btn.btn-white:hover {
      background: #00afef;
      border: 1px solid #00afef;
      color: #fff; }
    .btn.btn-white.btn-outline-white {
      border: 1px solid #fff;
      background: transparent;
      color: #fff; }
      .btn.btn-white.btn-outline-white:hover {
        border: 1px solid transparent;
        background: #00afef;
        color: #fff; }
  .btn.btn-black {
    background: #000000;
    border: 1px solid #000000;
    color: #fff; }
    .btn.btn-black:hover {
      background: #00afef;
      border: 1px solid #00afef;
      color: #fff; }
    .btn.btn-black.btn-outline-white {
      border: 1px solid #000000;
      background: transparent;
      color: #000000; }
      .btn.btn-black.btn-outline-white:hover {
        border: 1px solid transparent;
        background: #000000;
        color: #fff; }

.img-2 {
  position: relative; }
  @media (max-width: 767.98px) {
    .img-2 {
      height: 300px;
      margin-bottom: 40px; } }
  .img-2 .icon {
    width: 100px;
    height: 100px;
    background: #00afef;
    -webkit-animation: pulse 2s infinite;
    animation: pulse 2s infinite;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%; }
    .img-2 .icon span {
      color: #fff;
      font-size: 24px; }

.wrap-about {
  position: relative; }
  @media (min-width: 992px) {
    .wrap-about {
      padding-left: 6em; } }
  @media (min-width: 768px) {
    .wrap-about {
      padding-left: 3em; } }
  .wrap-about .heading-section-bold h2 {
    font-size: 40px;
    font-weight: 600;
    color: #000000; }

.deal-of-the-day h3 {
  font-size: 30px;
  font-family: "Lora", Georgia, serif;
  font-style: italic; }
  .deal-of-the-day h3 a {
    color: #00afef; }

.deal-of-the-day .price {
  font-weight: 500;
  font-size: 18px;
  color: rgba(0, 0, 0, 0.5); }

#timer {
  width: 80%; }
  @media (max-width: 991.98px) {
    #timer {
      width: 90%; } }
  #timer .time {
    width: 25%;
    font-size: 40px;
    font-weight: 500;
    border-left: 1px solid rgba(0, 0, 0, 0.05);
    color: #00afef; }
    @media (max-width: 991.98px) {
      #timer .time {
        font-size: 30px; } }
    #timer .time:first-child {
      border-left: transparent; }
    #timer .time span {
      font-size: 12px;
      display: block;
      color: #000000;
      text-transform: uppercase; }

.product-category li {
  display: inline-block;
  font-weight: 400;
  font-size: 16px; }
  .product-category li a {
    color: #00afef;
    padding: 5px 20px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    border-radius: 5px; }
    .product-category li a.active {
      background: #00afef;
      color: #fff; }

.ftco-product .owl-carousel .owl-stage-outer {
  padding-bottom: 2em;
  position: relative; }

.product {
  display: block;
  width: 100%;
  margin-bottom: 30px;
  position: relative;
  -moz-transition: all 0.3s ease;
  -o-transition: all 0.3s ease;
  -webkit-transition: all 0.3s ease;
  -ms-transition: all 0.3s ease;
  transition: all 0.3s ease;
  border: 1px solid #f0f0f0; }
  @media (max-width: 991.98px) {
    .product {
      margin-bottom: 30px; } }
  .product .img-prod {
    position: relative;
    display: block;
    overflow: hidden; 
    min-height: 185px;
    max-height: 185px;
    background: #EEEFF1;  
}
    .product .img-prod .overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      content: '';
      opacity: 0;
      background: #00afef;
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      -webkit-transition: all 0.3s ease;
      -ms-transition: all 0.3s ease;
      transition: all 0.3s ease; }
    .product .img-prod span.status {
      position: absolute;
      top: 0;
      left: 0;
      padding: 2px 10px;
      color: #fff;
      font-weight: 300;
      background: #00afef;
      font-size: 12px; }
    .product .img-prod img {
      -webkit-transform: scale(1);
      -moz-transform: scale(1);
      -ms-transform: scale(1);
      -o-transform: scale(1);
      transform: scale(1);
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      -webkit-transition: all 0.3s ease;
      -ms-transition: all 0.3s ease;
      transition: all 0.3s ease; }
    .product .img-prod:hover img, .product .img-prod:focus img {
      -webkit-transform: scale(1.1);
      -moz-transform: scale(1.1);
      -ms-transform: scale(1.1);
      -o-transform: scale(1.1);
      transform: scale(1.1); }
  .product .img {
    display: block;
    height: 500px; }
  .product .icon {
    width: 60px;
    height: 60px;
    background: #fff;
    opacity: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .product .icon span {
      color: #000000; }
  .product:hover .icon {
    opacity: 1; }
  .product:hover .img-prod .overlay {
    opacity: 0; }
  .product .text {
    background: #fff;
    position: relative;
    width: 100%; }
    .product .text h3 {
      font-size: 14px;
      margin-bottom: 5px;
      font-weight: 300;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-family: "Poppins", Arial, sans-serif; }
      .product .text h3 a {
        color: #000000; }
    .product .text p.price {
      margin-bottom: 0;
      color: #00afef;
      font-weight: 400; }
      .product .text p.price span.price-dc {
        text-decoration: line-through;
        color: #b3b3b3; }
      .product .text p.price span.price-sale {
        color: #00afef; }
    .product .text .pricing {
      width: 100%;
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      -webkit-transition: all 0.3s ease;
      -ms-transition: all 0.3s ease;
      transition: all 0.3s ease; }
    .product .text .bottom-area {
      position: absolute;
      bottom: 15px;
      left: 0;
      right: 0;
      opacity: 0;
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      -webkit-transition: all 0.3s ease;
      -ms-transition: all 0.3s ease;
      transition: all 0.3s ease; }
      .product .text .bottom-area a {
        color: #fff;
        width: 100%;
        background: #00afef;
        width: 40px;
        height: 40px;
        margin: 0 auto;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%; }
      .product .text .bottom-area .m-auto {
        margin: 0 auto; }
  .product:hover {
    -webkit-box-shadow: 0px 7px 15px -5px rgba(0, 0, 0, 0.07);
    -moz-box-shadow: 0px 7px 15px -5px rgba(0, 0, 0, 0.07);
    box-shadow: 0px 7px 15px -5px rgba(0, 0, 0, 0.07); }
    .product:hover .pricing {
      opacity: 0; }
    .product:hover .text .bottom-area {
      opacity: 1; }

.product-details h3 {
  font-size: 30px;
  font-weight: 400; }

.product-details .price span {
  font-size: 30px;
  color: #000000; }

.product-details button i {
  color: #000000; }

.product-details .quantity-left-minus {
  background: transparent;
  padding: 0 15px; }

.product-details .quantity-right-plus {
  background: transparent;
  padding: 0 15px; }

.product-details button, .product-details .form-control {
  height: 40px !important;
  text-align: center;
  border: 1px solid rgba(0, 0, 0, 0.1) !important;
  color: #00afef;
  padding: 10px 20px;
  background: transparent !important;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  -ms-border-radius: 0;
  border-radius: 0;
  font-size: 14px; }
  .product-details button:hover, .product-details button:focus, .product-details .form-control:hover, .product-details .form-control:focus {
    text-decoration: none;
    outline: none; }

.product-details .form-group {
  position: relative; }
  .product-details .form-group .form-control {
    padding-right: 40px;
    color: #000000;
    background: transparent !important; }
    .product-details .form-group .form-control::-webkit-input-placeholder {
      /* Chrome/Opera/Safari */
      color: #4d4d4d; }
    .product-details .form-group .form-control::-moz-placeholder {
      /* Firefox 19+ */
      color: #4d4d4d; }
    .product-details .form-group .form-control:-ms-input-placeholder {
      /* IE 10+ */
      color: #4d4d4d; }
    .product-details .form-group .form-control:-moz-placeholder {
      /* Firefox 18- */
      color: #4d4d4d; }
  .product-details .form-group .icon {
    position: absolute;
    top: 50%;
    right: 20px;
    font-size: 14px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    color: #000000; }
    .product-details .form-group .icon span {
      color: #000000; }
    @media (max-width: 767.98px) {
      .product-details .form-group .icon {
        right: 10px; } }
  .product-details .form-group .select-wrap {
    position: relative; }
    .product-details .form-group .select-wrap select {
      font-size: 13px;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      text-transform: uppercase;
      letter-spacing: 2px; }

.ftco-cart button i {
  color: #00afef; }

.ftco-cart .quantity-left-minus {
  background: transparent;
  padding: 16px 20px; }

.ftco-cart .quantity-right-plus {
  background: transparent;
  padding: 16px 20px; }

.ftco-cart button, .ftco-cart .form-control {
  height: 54px !important;
  text-align: center;
  padding: 0;
  font-size: 14px; }

.ftco-cart .form-group {
  position: relative; }
  .ftco-cart .form-group .form-control {
    padding-right: 40px; }
  .ftco-cart .form-group .icon {
    position: absolute;
    top: 50%;
    right: 20px;
    font-size: 14px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    color: #00afef; }
    .ftco-cart .form-group .icon span {
      color: #00afef; }
    @media (max-width: 767.98px) {
      .ftco-cart .form-group .icon {
        right: 10px; } }
  .ftco-cart .form-group .select-wrap {
    position: relative; }
    .ftco-cart .form-group .select-wrap select {
      font-size: 14px;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none; }

.ftco-cart .info label {
  font-size: 13px;
  color: #000000; }

.cart-list {
  overflow-x: scroll; }

.table {
  min-width: 1000px !important;
  width: 100%;
  text-align: center; }
  .table th {
    font-weight: 500; }
  .table .thead-primary {
    background: #00afef; }
    .table .thead-primary tr th {
      padding: 20px 10px;
      color: #fff !important;
      border: 1px solid transparent !important; }
  .table tbody tr td {
    text-align: center !important;
    vertical-align: middle;
    padding: 40px 10px;
    border: 1px solid transparent !important;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important; }
    .table tbody tr td.product-remove a {
      bordeR: 1px solid rgba(0, 0, 0, 0.1);
      padding: 4px 10px;
      color: #000000; }
      .table tbody tr td.product-remove a:hover {
        border: 1px solid #00afef;
        background: #00afef; }
        .table tbody tr td.product-remove a:hover span {
          color: #fff; }
    .table tbody tr td.quantity {
      width: 20%; }
    .table tbody tr td.image-prod .img {
      display: block;
      width: 100px;
      height: 100px;
      margin: 0 auto; }
    .table tbody tr td.product-name {
      width: 30%; }
      .table tbody tr td.product-name h3 {
        font-size: 16px; }
    .table tbody tr td.total, .table tbody tr td.price {
      color: #000000; }

.cart-wrap .btn-primary {
  display: inline-block; }

.cart-total {
  width: 100%;
  display: block;
  border: 1px solid rgba(0, 0, 0, 0.05);
  padding: 20px; }
  .cart-total h3 {
    font-size: 16px;
    margin-bottom: 20px; }
  .cart-total p {
    width: 100%;
    display: block; }
    .cart-total p span {
      display: block;
      width: 50%; }
    .cart-total p.total-price span {
      text-transform: uppercase; }
      .cart-total p.total-price span:last-child {
        color: #000000;
        font-weight: 600; }
  .cart-total hr {
    background: rgba(255, 255, 255, 0.1); }

.billing-heading {
  font-size: 24px; }

.billing-form .form-group {
  position: relative; }

.billing-form label {
  color: #000000;
  font-size: 14px; }

.billing-form .icon {
  position: absolute;
  top: 50% !important;
  right: 15px;
  font-size: 14px;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%); }
  .billing-form .icon span {
    color: black !important; }

.billing-form .select-wrap, .billing-form .input-wrap {
  position: relative; }
  .billing-form .select-wrap select, .billing-form .input-wrap select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none; }

.billing-form .form-control {
  font-weight: 300;
  border: transparent !important;
  border: 1px solid rgba(0, 0, 0, 0.1) !important;
  height: 58px !important;
  padding-left: 15px;
  padding-right: 15px;
  background: transparent !important;
  color: rgba(0, 0, 0, 0.4) !important;
  font-size: 14px;
  border-radius: 0px;
  -webkit-box-shadow: none !important;
  box-shadow: none !important; }
  .billing-form .form-control::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: rgba(0, 0, 0, 0.4); }
  .billing-form .form-control::-moz-placeholder {
    /* Firefox 19+ */
    color: rgba(0, 0, 0, 0.4); }
  .billing-form .form-control:-ms-input-placeholder {
    /* IE 10+ */
    color: rgba(0, 0, 0, 0.4); }
  .billing-form .form-control:-moz-placeholder {
    /* Firefox 18- */
    color: rgba(0, 0, 0, 0.4); }
  .billing-form .form-control:focus, .billing-form .form-control:active {
    border-color: #00afef !important; }

.billing-form textarea.form-control {
  height: inherit !important; }

.cart-detail {
  width: 100%;
  display: block;
  border: 1px solid rgba(0, 0, 0, 0.05); }
  .cart-detail.cart-total {
    border: 1px solid rgba(0, 0, 0, 0.05); }
  .cart-detail .btn-primary {
    display: block;
    width: 100%; }

.circle {
  width: 300px;
  height: 300px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  border-radius: 50%;
  margin: 0 auto;
  background: rgba(255, 255, 255, 0.8); }
  .circle h2 {
    font-size: 50px; }

.ftco-social {
  padding: 0; }
  .ftco-social li {
    list-style: none;
    margin-right: 10px; }

.ftco-partner {
  padding: 5em 0; }
  .ftco-partner .partner {
    display: block;
    padding: 0 20px; }
    @media (max-width: 991.98px) {
      .ftco-partner .partner {
        padding: 0; } }

.subscribe-form {
  width: 100%; }
  .subscribe-form .form-group {
    position: relative;
    margin-bottom: 0;
    border: none;
    background: #fff;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    border-radius: 0; }
    .subscribe-form .form-group input {
      background: #fff !important;
      border: 1px solid transparent;
      color: black !important;
      font-size: 14px;
      font-weight: 300;
      -webkit-border-radius: 30px;
      -moz-border-radius: 30px;
      -ms-border-radius: 30px;
      border-radius: 30px; }
      .subscribe-form .form-group input::-webkit-input-placeholder {
        /* Chrome/Opera/Safari */
        color: black !important; }
      .subscribe-form .form-group input::-moz-placeholder {
        /* Firefox 19+ */
        color: black !important; }
      .subscribe-form .form-group input:-ms-input-placeholder {
        /* IE 10+ */
        color: black !important; }
      .subscribe-form .form-group input:-moz-placeholder {
        /* Firefox 18- */
        color: black !important; }
    .subscribe-form .form-group .submit {
      border-left: 1px solid #00afef;
      color: #fff !important;
      -webkit-border-radius: 0;
      -moz-border-radius: 0;
      -ms-border-radius: 0;
      border-radius: 0;
      font-size: 12px;
      background: #00afef !important; }
      .subscribe-form .form-group .submit:hover {
        cursor: pointer; }
  .subscribe-form .icon {
    position: absolute;
    top: 50%;
    right: 20px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.8); }

.aside-stretch {
  background: #9bc166; }
  .aside-stretch:after {
    position: absolute;
    top: 0;
    left: 100%;
    bottom: 0;
    content: '';
    width: 360%;
    background: rgba(255, 255, 255, 0.9); }
  @media (max-width: 767.98px) {
    .aside-stretch {
      background: transparent; }
      .aside-stretch:after {
        background: transparent;
        display: none; } }

.form-control {
  height: 52px !important;
  background: #fff !important;
  color: #000000 !important;
  font-size: 18px;
  border-radius: 0px;
  -webkit-box-shadow: none !important;
  box-shadow: none !important; }
  .form-control:focus, .form-control:active {
    border-color: #000000; }

textarea.form-control {
  height: inherit !important; }

.ftco-animate {
  opacity: 0;
  visibility: hidden; }

.bg-primary {
  background: #00afef !important; }

.bg-black {
  background: #000000 !important; }

.goto-here {
  width: 100%;
  display: block; }

.about-author .desc h3 {
  font-size: 24px; }

.ftco-section {
  padding: 5em 0;
  position: relative; }

.ftco-no-pt {
  padding-top: 0 !important; }

.ftco-no-pb {
  padding-bottom: 0 !important; }

.ftco-bg-dark {
  background: #3c312e; }

.ftco-footer {
  font-size: 14px;
  padding: 7em 0;
  color: #000000; }
  .ftco-footer .ftco-footer-logo {
    text-transform: uppercase;
    letter-spacing: .1em; }
  .ftco-footer .ftco-footer-widget h2 {
    font-weight: normal;
    margin-bottom: 20px;
    font-size: 16px;
    font-weight: 500; }
  .ftco-footer .ftco-footer-widget ul li {
    font-size: 14px;
    margin-bottom: 0px; }
    .ftco-footer .ftco-footer-widget ul li a {
      color: #000000; }
  .ftco-footer .ftco-footer-widget .btn-primary {
    border: 2px solid #fff !important; }
    .ftco-footer .ftco-footer-widget .btn-primary:hover {
      border: 2px solid #fff !important; }

.ftco-footer-social li {
  list-style: none;
  margin: 0 10px 0 0;
  display: inline-block; }
  .ftco-footer-social li a {
    height: 50px;
    width: 50px;
    display: block;
    float: left;
    background: rgba(0, 0, 0, 0.02);
    border-radius: 50%;
    position: relative; }
    .ftco-footer-social li a span {
      position: absolute;
      font-size: 26px;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      color: #000000; }
    .ftco-footer-social li a:hover {
      color: #000000; }

#map {
  width: 100%; }
  @media (max-width: 991.98px) {
    #map {
      height: 300px; } }

@-webkit-keyframes pulse {
  0% {
    -webkit-box-shadow: 0 0 0 0 rgba(130, 174, 70, 0.4); }
  70% {
    -webkit-box-shadow: 0 0 0 30px rgba(130, 174, 70, 0); }
  100% {
    -webkit-box-shadow: 0 0 0 0 rgba(130, 174, 70, 0); } }

@keyframes pulse {
  0% {
    -moz-box-shadow: 0 0 0 0 rgba(130, 174, 70, 0.4);
    -webkit-box-shadow: 0 0 0 0 rgba(130, 174, 70, 0.4);
    box-shadow: 0 0 0 0 rgba(130, 174, 70, 0.4); }
  70% {
    -moz-box-shadow: 0 0 0 30px rgba(130, 174, 70, 0);
    -webkit-box-shadow: 0 0 0 30px rgba(130, 174, 70, 0);
    box-shadow: 0 0 0 30px rgba(130, 174, 70, 0); }
  100% {
    -moz-box-shadow: 0 0 0 0 rgba(130, 174, 70, 0);
    -webkit-box-shadow: 0 0 0 0 rgba(130, 174, 70, 0);
    box-shadow: 0 0 0 0 rgba(130, 174, 70, 0); } }

.heading-section {
  position: relative; }
  .heading-section .subheading {
    font-size: 18px;
    display: block;
    margin-bottom: 10px;
    font-family: "Lora", Georgia, serif;
    font-style: italic;
    color: #00afef; }
  .heading-section h2 {
    position: relative;
    font-size: 40px;
    font-weight: 600;
    color: #000000;
    font-family: "Poppins", Arial, sans-serif; }
    @media (max-width: 767.98px) {
      .heading-section h2 {
        font-size: 28px; } }
  .heading-section.heading-section-white .subheading {
    color: rgba(255, 255, 255, 0.9); }
  .heading-section.heading-section-white h2 {
    font-size: 30px;
    color: #fff; }
    .heading-section.heading-section-white h2:after, .heading-section.heading-section-white h2:before {
      display: none; }
  .heading-section.heading-section-white p {
    color: rgba(255, 255, 255, 0.9); }

.hero-wrap,
.img,
.blog-img,
.user-img {
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center; }

.ftco-services .services {
  display: block;
  width: 100%;
  -moz-transition: all 0.3s ease;
  -o-transition: all 0.3s ease;
  -webkit-transition: all 0.3s ease;
  -ms-transition: all 0.3s ease;
  transition: all 0.3s ease; }
  .ftco-services .services .icon {
    line-height: 1.3;
    position: relative;
    margin: 0 auto;
    width: 100px;
    height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .ftco-services .services .icon:after {
      position: absolute;
      top: 10px;
      left: 10px;
      right: 10px;
      bottom: 10px;
      content: '';
      border: 2px solid rgba(255, 255, 255, 0.19);
      -webkit-border-radius: 50%;
      -moz-border-radius: 50%;
      -ms-border-radius: 50%;
      border-radius: 50%; }
    .ftco-services .services .icon span {
      font-size: 50px;
      color: #fff;
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      -webkit-transition: all 0.3s ease;
      -ms-transition: all 0.3s ease;
      transition: all 0.3s ease; }
  .ftco-services .services .media-body {
    width: 100%; }
    .ftco-services .services .media-body h3 {
      font-size: 15px;
      text-transform: uppercase;
      font-weight: 500;
      font-family: "Poppins", Arial, sans-serif;
      color: #000000; }
    .ftco-services .services .media-body span {
      text-transform: uppercase;
      color: rgba(0, 0, 0, 0.5);
      font-size: 12px;
      font-weight: 500; }
  .ftco-services .services:hover .icon, .ftco-services .services:focus .icon {
    background: #00afef; }
    .ftco-services .services:hover .icon span, .ftco-services .services:focus .icon span {
      color: #fff; }

.ftco-category .category-wrap {
  display: block;
  width: 100%;
  height: 250px; }
  .ftco-category .category-wrap .text {
    background: #00afef; }
    .ftco-category .category-wrap .text h2 {
      font-size: 18px;
      font-family: "Poppins", Arial, sans-serif; }
      .ftco-category .category-wrap .text h2 a {
        color: #fff; }

.ftco-category .category-wrap-2 {
  width: 100%; }
  .ftco-category .category-wrap-2 .text {
    width: 100%; }
    .ftco-category .category-wrap-2 .text h2 {
      color: #00afef;
      font-family: "Lora", Georgia, serif;
      font-style: italic;
      font-size: 24px; }

.testimony-section {
  position: relative; }
  .testimony-section .owl-carousel {
    margin: 0; }
  .testimony-section .owl-carousel .owl-stage-outer {
    padding-bottom: 2em;
    position: relative; }
  .testimony-section .owl-nav {
    position: absolute;
    top: 100%;
    width: 100%; }
    .testimony-section .owl-nav .owl-prev,
    .testimony-section .owl-nav .owl-next {
      position: absolute;
      -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
      margin-top: -10px;
      outline: none !important;
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      -webkit-transition: all 0.3s ease;
      -ms-transition: all 0.3s ease;
      transition: all 0.3s ease;
      opacity: 0; }
      .testimony-section .owl-nav .owl-prev span:before,
      .testimony-section .owl-nav .owl-next span:before {
        font-size: 30px;
        color: rgba(0, 0, 0, 0.2);
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        transition: all 0.3s ease; }
      .testimony-section .owl-nav .owl-prev:hover span:before, .testimony-section .owl-nav .owl-prev:focus span:before,
      .testimony-section .owl-nav .owl-next:hover span:before,
      .testimony-section .owl-nav .owl-next:focus span:before {
        color: #000000; }
    .testimony-section .owl-nav .owl-prev {
      left: 50%;
      margin-left: -80px; }
    .testimony-section .owl-nav .owl-next {
      right: 50%;
      margin-right: -80px; }
  .testimony-section:hover .owl-nav .owl-prev,
  .testimony-section:hover .owl-nav .owl-next {
    opacity: 1; }
  .testimony-section:hover .owl-nav .owl-prev {
    left: 50%;
    margin-left: -80px; }
  .testimony-section:hover .owl-nav .owl-next {
    right: 50%;
    margin-right: -80px; }
  .testimony-section .owl-dots {
    text-align: center; }
    .testimony-section .owl-dots .owl-dot {
      width: 10px;
      height: 10px;
      margin: 5px;
      border-radius: 50%;
      background: rgba(0, 0, 0, 0.2); }
      .testimony-section .owl-dots .owl-dot.active {
        background: #00afef; }

.testimony-wrap {
  display: block;
  position: relative;
  background: rgba(255, 255, 255, 0.1);
  color: rgba(0, 0, 0, 0.8); }
  .testimony-wrap .user-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: relative;
    margin-top: -75px;
    margin: 0 auto; }
    .testimony-wrap .user-img .quote {
      position: absolute;
      bottom: -10px;
      right: 0;
      width: 40px;
      height: 40px;
      background: #fff;
      -webkit-border-radius: 50%;
      -moz-border-radius: 50%;
      -ms-border-radius: 50%;
      border-radius: 50%; }
      .testimony-wrap .user-img .quote i {
        color: #00afef; }
  .testimony-wrap .name {
    font-weight: 400;
    font-size: 18px;
    margin-bottom: 0;
    color: #000000; }
  .testimony-wrap .position {
    font-size: 12px;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 2px; }
  .testimony-wrap .line {
    position: relative;
    border-left: 1px solid #e6e6e6; }
    .testimony-wrap .line:after {
      position: absolute;
      top: 50%;
      left: -2px;
      -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
      content: '';
      width: 3px;
      height: 30px;
      background: #00afef; }

.image-popup {
  cursor: -webkit-zoom-in;
  cursor: -moz-zoom-in;
  cursor: zoom-in; }

.mfp-with-zoom .mfp-container,
.mfp-with-zoom.mfp-bg {
  opacity: 0;
  -webkit-backface-visibility: hidden;
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out; }

.mfp-with-zoom.mfp-ready .mfp-container {
  opacity: 1; }

.mfp-with-zoom.mfp-ready.mfp-bg {
  opacity: 0.8; }

.mfp-with-zoom.mfp-removing .mfp-container,
.mfp-with-zoom.mfp-removing.mfp-bg {
  opacity: 0; }

#section-counter {
  position: relative;
  z-index: 0; }
  #section-counter:after {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    content: '';
    z-index: -1;
    opacity: .3;
    background: #fff; }

.ftco-counter {
  padding: 5em 0; }
  .ftco-counter .text strong.number {
    font-weight: 400;
    font-size: 30px;
    color: #000000; }
  .ftco-counter .text span {
    display: block;
    font-size: 12px;
    color: rgba(0, 0, 0, 0.7);
    text-transform: uppercase;
    letter-spacing: 1px; }
  @media (max-width: 767.98px) {
    .ftco-counter .counter-wrap {
      margin-bottom: 20px; } }
  .ftco-counter .ftco-number {
    display: block;
    font-size: 72px;
    font-weight: bold;
    color: #00afef; }
  .ftco-counter .ftco-label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .1em; }

.block-20 {
  overflow: hidden;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: top center;
  height: 250px;
  width: 100%;
  position: relative;
  display: block;
  margin-bottom: 20px; }
  @media (min-width: 768px) {
    .block-20 {
      width: 450px; } }

@media (min-width: 768px) {
  .blog-entry {
    margin-bottom: 60px; } }

@media (max-width: 767.98px) {
  .blog-entry {
    margin-bottom: 30px; } }

.blog-entry .text {
  position: relative;
  border-top: 0;
  border-radius: 2px;
  width: 100%; }
  .blog-entry .text .tag {
    color: #b3b3b3; }
  .blog-entry .text .heading {
    font-size: 20px;
    margin-bottom: 16px; }
    .blog-entry .text .heading a {
      color: #000000; }
      .blog-entry .text .heading a:hover, .blog-entry .text .heading a:focus, .blog-entry .text .heading a:active {
        color: #00afef; }
  .blog-entry .text .meta-chat {
    color: #b3b3b3; }
  .blog-entry .text .read {
    color: #000000;
    font-size: 14px; }

.blog-entry .meta > div {
  display: inline-block;
  margin-right: 5px;
  margin-bottom: 5px;
  font-size: 12px;
  font-weight: 400; }
  .blog-entry .meta > div a {
    color: black;
    font-size: 12px; }
    .blog-entry .meta > div a:hover {
      color: black; }

.block-23 ul {
  padding: 0; }
  .block-23 ul li, .block-23 ul li > a {
    display: table;
    line-height: 1.5;
    margin-bottom: 15px; }
  .block-23 ul li .icon, .block-23 ul li .text {
    display: table-cell;
    vertical-align: top; }
  .block-23 ul li .icon {
    width: 40px;
    font-size: 18px;
    padding-top: 2px; }

.block-17 {
  background: #fff;
  overflow: hidden;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  -ms-border-radius: 2px;
  border-radius: 2px; }
  .block-17 form .fields {
    width: calc(100% - 80px);
    position: relative; }
    .block-17 form .fields .one-third {
      width: 50%;
      background: #fff; }
      .block-17 form .fields .one-third:last-child {
        border-right: none;
        border-left: 1px solid rgba(0, 0, 0, 0.1); }
      .block-17 form .fields .one-third label {
        font-weight: 700;
        color: #000000; }
    .block-17 form .fields .form-control {
      -webkit-box-shadow: none !important;
      box-shadow: none !important;
      border: transparent;
      background: #fff !important;
      color: #4d4d4d !important;
      border: 2px solid rgba(0, 0, 0, 0.1);
      font-size: 14px;
      width: 100%;
      height: 70px !important;
      bordeR: 1px solid transparent;
      padding: 10px 30px;
      -webkit-border-radius: 0;
      -moz-border-radius: 0;
      -ms-border-radius: 0;
      border-radius: 0; }
      .block-17 form .fields .form-control::-webkit-input-placeholder {
        /* Chrome/Opera/Safari */
        color: #4d4d4d; }
      .block-17 form .fields .form-control::-moz-placeholder {
        /* Firefox 19+ */
        color: #4d4d4d; }
      .block-17 form .fields .form-control:-ms-input-placeholder {
        /* IE 10+ */
        color: #4d4d4d; }
      .block-17 form .fields .form-control:-moz-placeholder {
        /* Firefox 18- */
        color: #4d4d4d; }
    .block-17 form .fields .icon {
      position: absolute;
      top: 50%;
      right: 30px;
      font-size: 14px;
      -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
      color: rgba(0, 0, 0, 0.7); }
      @media (max-width: 767.98px) {
        .block-17 form .fields .icon {
          right: 10px; } }
    .block-17 form .fields .select-wrap {
      position: relative; }
      .block-17 form .fields .select-wrap select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none; }
  .block-17 form .search-submit {
    width: 160px;
    background: #00afef;
    border: 1px solid #00afef;
    color: #fff;
    padding: 12px 10px;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    border-radius: 0; }
    @media (max-width: 767.98px) {
      .block-17 form .search-submit {
        width: 80px; } }
    .block-17 form .search-submit:hover {
      background: #00afef !important;
      color: #fff !important;
      border: 1px solid #00afef !important; }

.block-27 ul {
  padding: 0;
  margin: 0; }
  .block-27 ul li {
    display: inline-block;
    margin-bottom: 4px;
    font-weight: 400; }
    .block-27 ul li a, .block-27 ul li span {
      color: #000000;
      text-align: center;
      display: inline-block;
      width: 40px;
      height: 40px;
      line-height: 40px;
      border-radius: 50%;
      border: 1px solid #e6e6e6;
      background: #fff; }
    .block-27 ul li.active a, .block-27 ul li.active span {
      background: #00afef;
      color: #fff;
      border: 1px solid transparent; }

.contact-section .contact-info p a {
  color: #1a1a1a; }

.contact-section .info {
  width: 100%; }

.contact-section .contact-form {
  width: 100%; }

.block-9 .form-control {
  outline: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  font-size: 15px; }

.block-21 .blog-img {
  display: block;
  height: 80px;
  width: 80px; }

.block-21 .text {
  width: calc(100% - 100px); }
  .block-21 .text .heading-1 {
    font-size: 18px;
    font-weight: 300; }
    .block-21 .text .heading-1 a {
      color: #000000; }
      .block-21 .text .heading-1 a:hover, .block-21 .text .heading-1 a:active, .block-21 .text .heading-1 a:focus {
        color: #00afef; }
  .block-21 .text .meta > div {
    display: inline-block;
    font-size: 12px;
    margin-right: 5px; }
    .block-21 .text .meta > div a {
      color: gray; }

.tagcloud a {
  text-transform: uppercase;
  display: inline-block;
  padding: 4px 10px;
  margin-bottom: 7px;
  margin-right: 4px;
  border-radius: 4px;
  color: #000000;
  border: 1px solid #ccc;
  font-size: 11px; }
  .tagcloud a:hover {
    border: 1px solid #000; }

.comment-form-wrap {
  clear: both; }

.comment-list {
  padding: 0;
  margin: 0; }
  .comment-list .children {
    padding: 50px 0 0 40px;
    margin: 0;
    float: left;
    width: 100%; }
  .comment-list li {
    padding: 0;
    margin: 0 0 30px 0;
    float: left;
    width: 100%;
    clear: both;
    list-style: none; }
    .comment-list li .vcard {
      width: 80px;
      float: left; }
      .comment-list li .vcard img {
        width: 50px;
        border-radius: 50%; }
    .comment-list li .comment-body {
      float: right;
      width: calc(100% - 80px); }
      .comment-list li .comment-body h3 {
        font-size: 20px; }
      .comment-list li .comment-body .meta {
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: .1em;
        color: #ccc; }
      .comment-list li .comment-body .reply {
        padding: 5px 10px;
        background: #e6e6e6;
        color: #000000;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: .1em;
        font-weight: 400;
        border-radius: 4px; }
        .comment-list li .comment-body .reply:hover {
          color: #fff;
          background: black; }

.search-form .form-group {
  position: relative; }
  .search-form .form-group input {
    padding-right: 50px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    color: black;
    font-size: 13px; }
    .search-form .form-group input::-webkit-input-placeholder {
      /* Chrome/Opera/Safari */
      color: black; }
    .search-form .form-group input::-moz-placeholder {
      /* Firefox 19+ */
      color: black; }
    .search-form .form-group input:-ms-input-placeholder {
      /* IE 10+ */
      color: black; }
    .search-form .form-group input:-moz-placeholder {
      /* Firefox 18- */
      color: black; }
    .search-form .form-group input:focus, .search-form .form-group input:active {
      border-color: #00afef !important; }

.search-form .icon {
  position: absolute;
  top: 50%;
  right: 20px;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  color: #000000; }

.sidebar-box {
  margin-bottom: 30px;
  padding: 25px;
  font-size: 15px;
  width: 100%;
  background: #fff; }
  .sidebar-box *:last-child {
    margin-bottom: 0; }
  .sidebar-box h3.heading {
    font-size: 20px;
    margin-bottom: 30px; }

.categories, .sidelink {
  padding: 0; }
  .categories li, .sidelink li {
    position: relative;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px dotted #dee2e6;
    list-style: none; }
    .categories li:last-child, .sidelink li:last-child {
      margin-bottom: 0;
      border-bottom: none;
      padding-bottom: 0; }
    .categories li a, .sidelink li a {
      display: block;
      color: #000000; }
      .categories li a span, .sidelink li a span {
        position: absolute;
        right: 0;
        top: 0;
        color: #ccc; }
    .categories li.active a, .sidelink li.active a {
      color: #000000;
      font-style: italic; }

.sidebar-box-2 {
  display: block;
  width: 100%;
  margin-bottom: 40px; }
  .sidebar-box-2 .heading {
    font-size: 20px;
    text-transform: uppercase; }
    .sidebar-box-2 .heading a {
      color: #000000; }
  .sidebar-box-2 ul {
    margin: 0;
    padding: 0; }
    .sidebar-box-2 ul li {
      font-size: 12px;
      list-style: none;
      margin-bottom: 10px; }
      .sidebar-box-2 ul li a {
        color: #000000; }

#ftco-loader {
  position: fixed;
  width: 96px;
  height: 96px;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  background-color: rgba(255, 255, 255, 0.9);
  -webkit-box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
  box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
  border-radius: 16px;
  opacity: 0;
  visibility: hidden;
  -webkit-transition: opacity .2s ease-out, visibility 0s linear .2s;
  -o-transition: opacity .2s ease-out, visibility 0s linear .2s;
  transition: opacity .2s ease-out, visibility 0s linear .2s;
  z-index: 1000; }

#ftco-loader.fullscreen {
  padding: 0;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  -webkit-transform: none;
  -ms-transform: none;
  transform: none;
  background-color: #fff;
  border-radius: 0;
  -webkit-box-shadow: none;
  box-shadow: none; }

#ftco-loader.show {
  -webkit-transition: opacity .4s ease-out, visibility 0s linear 0s;
  -o-transition: opacity .4s ease-out, visibility 0s linear 0s;
  transition: opacity .4s ease-out, visibility 0s linear 0s;
  visibility: visible;
  opacity: 1; }

#ftco-loader .circular {
  -webkit-animation: loader-rotate 2s linear infinite;
  animation: loader-rotate 2s linear infinite;
  position: absolute;
  left: calc(50% - 24px);
  top: calc(50% - 24px);
  display: block;
  -webkit-transform: rotate(0deg);
  -ms-transform: rotate(0deg);
  transform: rotate(0deg); }

#ftco-loader .path {
  stroke-dasharray: 1, 200;
  stroke-dashoffset: 0;
  -webkit-animation: loader-dash 1.5s ease-in-out infinite;
  animation: loader-dash 1.5s ease-in-out infinite;
  stroke-linecap: round; }

@-webkit-keyframes loader-rotate {
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg); } }

@keyframes loader-rotate {
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg); } }

@-webkit-keyframes loader-dash {
  0% {
    stroke-dasharray: 1, 200;
    stroke-dashoffset: 0; }
  50% {
    stroke-dasharray: 89, 200;
    stroke-dashoffset: -35px; }
  100% {
    stroke-dasharray: 89, 200;
    stroke-dashoffset: -136px; } }

@keyframes loader-dash {
  0% {
    stroke-dasharray: 1, 200;
    stroke-dashoffset: 0; }
  50% {
    stroke-dasharray: 89, 200;
    stroke-dashoffset: -35px; }
  100% {
    stroke-dasharray: 89, 200;
    stroke-dashoffset: -136px; } }



 .bg_gradient{
  background: #f5f5f5;
  background: -webkit-linear-gradient(to right, #f5f5f5, #a0ddf4);
  background: linear-gradient(to right, #f5f5f5, #a0ddf4);
  min-height: 100vh;
}
 
.mysearch input {
  outline: none;
}
.mysearch input[type=search] {
  -webkit-appearance: textfield;
  -webkit-box-sizing: content-box;
  font-family: inherit;
  font-size: 100%;
}
.mysearch input::-webkit-search-decoration,
.mysearch input::-webkit-search-cancel-button {
  display: none; 
}


.mysearch input[type=search] {
  background: url(https://static.tumblr.com/ftv85bp/MIXmud4tx/search-icon.png) no-repeat right 9px ;
  border: none;
  width: 55px;
  -webkit-transition: all .5s;
  -moz-transition: all .5s;
  transition: all .5s;
}
.mysearch input[type=search]:focus {
  width: 130px;
  background-color: #fff;
    border-bottom: 1px solid #ccc;
}


.mysearch input:-moz-placeholder {
  color: #999;
}
.mysearch input::-webkit-input-placeholder {
  color: #999;
}

/* Demo 2 */
.mysearch #demo-2 input[type=search] {
  width: 15px;
  padding: 5px 0 0 20px;
  color: transparent;
  cursor: pointer;
}
.mysearch #demo-2 input[type=search]:hover {
  background-color: #fff;
}
.mysearch #demo-2 input[type=search]:focus {
  width: 130px;
  padding-right: 30px;
    padding-left: 0;
  color: #000;
  background-color: #fff;
  cursor: auto;
}
.mysearch #demo-2 input:-moz-placeholder {
  color: transparent;
}
.mysearch #demo-2 input::-webkit-input-placeholder {
  color: transparent;
}

.table thead tr th.prodhead div{text-align: left!important}
.table tbody.forcart tr td{padding: 10px}
.table tbody.forcart tr td.prodimage{text-align: left!important}
.table tbody.forcart tr td strong{font-weight: 100}
.table tbody.forcart tr td.total strong{font-weight: 500}
.table tbody.forcart tr td i{font-weight: 100; font-size: 20px}
.qty {width: 35px; height: 30px; text-align: center;}
input.qtyplus { width:25px; height:25px; position: relative; top: 4px; padding: 0}
input.qtyminus { width:25px; height:25px; position: relative; top: 4px; padding: 0}
#demo-2{margin-top:14px;}

.cat-new .cat-box{border: 1px solid rgba(0,0,0,0.2); text-align: center; height: 40px; padding: 6px;}
.cat-new .cat-box a{color: #000}
.filters{background:#f4f4f4; padding:6rem 0}

.forreview input{height: 40px!important; font-size: 12px}
.forreview textarea{height: 100px!important; font-size: 12px}
span.reviewcount{font-size: 14px}
.product-details p.price{font-size: 30px; color: #000}
.product-details p.price span{font-size: 18px}
.fordetails span{font-weight: 400; color: #00afef}






input {
  outline: none;
  border: none;
}

textarea {
  outline: none;
  border: none;
}

textarea:focus, input:focus {
  border-color: transparent !important;
}

input:focus::-webkit-input-placeholder { color:transparent; }
input:focus:-moz-placeholder { color:transparent; }
input:focus::-moz-placeholder { color:transparent; }
input:focus:-ms-input-placeholder { color:transparent; }

textarea:focus::-webkit-input-placeholder { color:transparent; }
textarea:focus:-moz-placeholder { color:transparent; }
textarea:focus::-moz-placeholder { color:transparent; }
textarea:focus:-ms-input-placeholder { color:transparent; }

input::-webkit-input-placeholder { color: #adadad;}
input:-moz-placeholder { color: #adadad;}
input::-moz-placeholder { color: #adadad;}
input:-ms-input-placeholder { color: #adadad;}

textarea::-webkit-input-placeholder { color: #adadad;}
textarea:-moz-placeholder { color: #adadad;}
textarea::-moz-placeholder { color: #adadad;}
textarea:-ms-input-placeholder { color: #adadad;}

/*---------------------------------------------*/
button {
  outline: none !important;
  border: none;
  background: transparent;
}

button:hover {
  cursor: pointer;
}

iframe {
  border: none !important;
}


/*//////////////////////////////////////////////////////////////////
[ Utility ]*/
.txt1 {
  font-family: Poppins-Regular;
  font-size: 13px;
  color: #666666;
  line-height: 1.5;
}

.txt2 {
  font-family: Poppins-Regular;
  font-size: 13px;
  color: #333333;
  line-height: 1.5;
}

/*//////////////////////////////////////////////////////////////////
[ login ]*/

.limiter {
  width: 100%;
  margin: 0 auto;
}

.container-login100 {
  width: 100%;  
  min-height: 100vh;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background: #f2f2f2;  
}

.wrap-login100 {
  width: 390px;
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  padding: 77px 55px 33px 55px;

  box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
  -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
  -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
}


/*------------------------------------------------------------------
[ Form ]*/

.login100-form {
  width: 100%;
}

.login100-form-title {
  display: block;
  font-size: 30px;
  color: #333333;
  line-height: 1.2;
  text-align: center;
}
.login100-form-title i {
  font-size: 60px;
}

/*------------------------------------------------------------------
[ Input ]*/

.wrap-input100 {
  width: 100%;
  position: relative;
  border-bottom: 2px solid #adadad;
  margin-bottom: 37px;
}

.input100 {
  font-family: Poppins-Regular;
  font-size: 15px;
  color: #555555;
  line-height: 1.2;

  display: block;
  width: 100%;
  height: 45px;
  background: transparent;
  padding: 0 5px;
}

/*---------------------------------------------*/ 
.focus-input100 {
  position: absolute;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;
}

.focus-input100::before {
  content: "";
  display: block;
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;

  background: #6a7dfe;
  background: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  background: -o-linear-gradient(left, #21d4fd, #b721ff);
  background: -moz-linear-gradient(left, #21d4fd, #b721ff);
  background: linear-gradient(left, #21d4fd, #b721ff);
}

.focus-input100::after {
  font-family: Poppins-Regular;
  font-size: 15px;
  color: #999999;
  line-height: 1.2;
  content: attr(data-placeholder);
  display: block;
  width: 100%;
  position: absolute;
  top: -17px;
  left: 0px;
  padding-left: 5px;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.input100:focus + .focus-input100::after {
  top: -17px;
}

.input100:focus + .focus-input100::before {
  width: 100%;
}

.has-val.input100 + .focus-input100::after {
  top: -17px;
}

.has-val.input100 + .focus-input100::before {
  width: 100%;
}

/*---------------------------------------------*/
.btn-show-pass {
  font-size: 15px;
  color: #999999;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  position: absolute;
  height: 100%;
  top: 0;
  right: 0;
  padding-right: 5px;
  cursor: pointer;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.btn-show-pass:hover {
  color: #6a7dfe;
  color: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  color: -o-linear-gradient(left, #21d4fd, #b721ff);
  color: -moz-linear-gradient(left, #21d4fd, #b721ff);
  color: linear-gradient(left, #21d4fd, #b721ff);
}

.btn-show-pass.active {
  color: #6a7dfe;
  color: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  color: -o-linear-gradient(left, #21d4fd, #b721ff);
  color: -moz-linear-gradient(left, #21d4fd, #b721ff);
  color: linear-gradient(left, #21d4fd, #b721ff);
}



/*------------------------------------------------------------------
[ Button ]*/
.container-login100-form-btn {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding-top: 13px;
}

.wrap-login100-form-btn {
  width: 100%;
  display: block;
  position: relative;
  z-index: 1;
  border-radius: 25px;
  overflow: hidden;
  margin: 0 auto;
}

.login100-form-bgbtn {
  position: absolute;
  z-index: -1;
  width: 300%;
  height: 100%;
  background: #a64bf4;
  background: -webkit-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
  background: -o-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
  background: -moz-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
  background: linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
  top: 0;
  left: -100%;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn {
  font-family: Poppins-Medium;
  font-size: 15px;
  color: #fff;
  line-height: 1.2;
  text-transform: uppercase;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  width: 100%;
  height: 50px;
}

.wrap-login100-form-btn:hover .login100-form-bgbtn {
  left: 0;
}


/*------------------------------------------------------------------
[ Responsive ]*/

@media (max-width: 576px) {
  .wrap-login100 {
    padding: 77px 15px 33px 15px;
  }
}



/*------------------------------------------------------------------
[ Alert validate ]*/

.validate-input {
  position: relative;
}

.alert-validate::before {
  content: attr(data-validate);
  position: absolute;
  max-width: 70%;
  background-color: #fff;
  border: 1px solid #c80000;
  border-radius: 2px;
  padding: 4px 25px 4px 10px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: 0px;
  pointer-events: none;

  font-family: Poppins-Regular;
  color: #c80000;
  font-size: 13px;
  line-height: 1.4;
  text-align: left;

  visibility: hidden;
  opacity: 0;

  -webkit-transition: opacity 0.4s;
  -o-transition: opacity 0.4s;
  -moz-transition: opacity 0.4s;
  transition: opacity 0.4s;
}

.alert-validate::after {
  content: "\f06a";
  font-family: FontAwesome;
  font-size: 16px;
  color: #c80000;

  display: block;
  position: absolute;
  background-color: #fff;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: 5px;
}

.alert-validate:hover:before {
  visibility: visible;
  opacity: 1;
}

@media (max-width: 992px) {
  .alert-validate::before {
    visibility: visible;
    opacity: 1;
  }
}
.hidden{position: absolute;
overflow: hidden;
width: 0;
height: 0;
pointer-events: none;}
.w1{width:11px;}
.w3{width:3%}
.w4{width:4%;}
.w5{width:5%;}
.w7{width:7%;}
.f10{font-size:10px;}
.w55{width:5.5%; fill: #00afef }
.w55g{width:5.5%;}
.m0{margin:0}
.w50{width: 50%}

.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}


.forfilters-outer{border-right: 1px solid #ccc; padding: 20px 15px; position: relative; background: #fff; }
.forfilters-outer input{font-size: 14px}
.forfilters-outer .btn.btn-outline-secondary{border-radius: 0; font-size: 14px}
.forfilters-outer .btn.btn-outline-secondary i{font-size: 22px}

.forfilters.dropdown{float: left; width: 100%} 
.forfilters button{margin-top: 10px;
    border: none;
    border-radius: 0;
    width: 30%;
    padding: 0px 17px 0 0;
    font-size: 16px;
    text-align: right;
    box-shadow: none;}
.forfilters a.level{float: left; width: 70%}
.forfilters i.ion-ios-arrow-down{position: relative; top: -5px}

.forfilters li.dropdown-submenu a.level2{width: 70%; float: left}
.forfilters li.dropdown-submenu a.test{width: 30%; float: left; text-align: right}

.forfilters button:focus, .forfilters button:hover{outline: none; box-shadow: none}
.forfilters ul.dropdown-menu{width: 100%; padding: 0 15px; border: none; position: relative!important; transform: none!important}
.forfilters ul.dropdown-menu li{padding: 5px 0; font-size: 15px}

.forfilters ul.dropdown-menu .dropdown-submenu .dropdown-menu{top: 0; left: 0; margin-top: 20px; border: none; padding-right: 0}
.forfilters .dropdown-toggle::after{float: right; margin: 10px 10px 0 0;}

.bg-all{background: #48ADE4;
    padding: 40px 0 20px 0;
    color: #fff;}
.bg-all h2{color: #fff}
.forfilters-outer h5 span{font-size: 14px; padding-top: 5px; font-weight: 200}
.w20{width: 20%; float: left}
.w80{width: 80%; float: left}
.product-details button:hover{color:#000;}
.product-details button:activ {color: #000;}
.product-details button:focus {color: #000;}

.forunit.dropdown-toggle::after{float: right; position: relative; top: 5px}
.price{width: 100; display: block;}
.price span{font-weight: 200; position: relative; top: -2px; font-size: 22px}
.price strong{font-weight: 500; font-size: 20px; position: relative; top: 0}
.blue{color:#00baf2}


.bg-featured{background: #fafafa; padding: 40px 0 5px 0; color: #fff;}
.bg-featured h5{color: #153547} 
body, html{overflow-x: hidden}
.premium h3{font-size: 18px; font-weight: bold}
a.navbar-brand img{width: 30%}
.minh-login{min-height: 480px}
.noacct{padding-left: 20px}
.premium .product .text{background: #153547; color: #fff}
.premium .product{border: none}
.premium .product .img-prod{min-height: 225px; max-height: 225px}
.premium .product h3 a{font-size: 20px; font-weight: bold; color: #d3ae3d}
.premium .product .video {color: #000; font-weight: 100; font-size: 12px; line-height: 20px; border-left: 1px solid #ccc}
.premium .product .video a{color: #fff}
.premium .product .img-prod span.status{padding: 2px 12px; color: #d3ae3d; font-size: 24px; background: #153547}
.premium .product .cart .dropdown .btn{color: #fff; background: none; border: none; padding: 0; text-align: left; width: 100%} 
.premium .product .cart .dropdown .btn:focus{box-shadow: none}
.premium .product .cart .dropdown-toggle::after{display: none}
.premium .product .cart .dropdown-toggle i{right: 7px; position: absolute; top: 3px; font-size: 24px}
.premium .product .cart hr{border-color: #fff}
.premium .product .cart .add{color: #d3ae3d; font-weight: 600}
.premium .product .cart .add .price-dc{color: #fff; text-decoration: line-through}
.premium .product .cart .add .price-dc svg{fill: #fff}
.premium .product .cart .add .price-sale{color: #d3ae3d}
.premium .product .cart .add .price-sale svg{fill: #d3ae3d}
.premium .product .cart .add.w35{width: 35%; float: left}
.premium .product .cart .add.w65{width: 65%; float: left}
.premium .product:hover .pricing {opacity: 1;}

.product .text .bottom-area .dropdown .dropdown-toggle{box-shadow: none; border: none}
.product .text .bottom-area .dropdown .dropdown-toggle::after{display: none}
.product .text .bottom-area .dropdown .dropdown-menu a.dropdown-item{color: #000;
    background: none;
    padding: 0 10px;
    font-size: 12px;
    margin: 0;}

.product .text .bottom-area .dropdown .dropdown-menu {top: -10px; min-width: 220px; left: -48px!important}
.pad{padding-top:10px; padding-left:0;}
.f5rem{font-size:5rem}

.forfilters ul.dropdown-menu li{list-style: none; font-weight: lighter}
.forfilters ul.dropdown-menu li a:hover, .forfilters ul.dropdown-menu li a:focus, .forfilters ul.dropdown-menu li a:active{color: #000; padding-left: 10px}
.forfilters ul.dropdown-menu li a.active{color: #000; padding-left: 10px}
.forfilters ul.dropdown-menu li ul{padding-left: 15px}
.forfilters ul.dropdown-menu li ul li{border-bottom: 1px solid rgba(0,0,0,0.08); margin: 5px 0;}
.forfilters ul.dropdown-menu li ul li::before{content: '-'; font-size: 10px; padding-right: 5px; color:rgba(0,0,0,0.2);}
  /*
  .product:hover .pricing{opacity: 1}
  .product .pricing{border-bottom: 1px solid #ccc;}
  .product .text .bottom-area{opacity: 1}
  .product .text .bottom-area {position: relative; bottom: -8px;} */

  @media (max-width: 768px) {
      .ftco-section {padding: 0em 0!important;}
      .bg-all{margin-bottom: 0}
      .w20{width: 100%}
      .w80{width: 100%}
      .filtercontent{display: none}
      .filtercontentb{display: block}
      .forfilters-outer{border-right: 1px solid #ccc; padding: 20px 15px; position: -webkit-sticky;
    position: sticky;
    top: 50px; background: #fff; z-index: 10000}
  .nav-link{padding: 0.5rem}
      .premium .product h3 a{font-size: 16px}    
      .xs-w100{width:100%}   
      .premium .product .cart .dropdown .dropdown-menu.show{position: relative!important; margin-bottom: 40px}
      .f5rem{font-size:1.5rem}
      .w10 {width: 3%;}
  }
  </style>      

<script>
    app_url = "<?= base_url('/all_videos'); ?>";
    function removelike(id){
    
        var x = confirm("Are you sure you want to Remove?");
        if (x){
        $.ajax({
        type:"POST",
        url: app_url+"/removelike",
        data:{id:id},
        success:function(data){
        //if(data=='Success'){
        location.reload();
        /*}else{
        alert('Selected service already in your checkout list.');
        } */
        }
        });
        }else{
        return false;
        }
    }
  </script>
    <script>
    jQuery(document).ready(function(){
          $('.qtyplus').click(function(e){
              var price;
              var total_price
              e.preventDefault();
              fieldName = $(this).attr('field');
              var currentVal = parseInt($(this).siblings('.qty').val());
              if (!isNaN(currentVal)) {
                  price = parseFloat($(this).parent().siblings('.price_sale').find('.sale_price').html());
                  total_price = parseFloat(price * (currentVal + 1))
                  $(this).parent().siblings('.total_price_sale').find('.total_sale_price').html(total_price.toFixed(2))
                  $(this).siblings('.qty').val(currentVal + 1);
                  // alert($(this).parent().siblings('.info').find('.product_id').val());
                  // alert($(this).parent().siblings('.info').find('.pack_id').val());
                  // alert($(this).parent().siblings('.info').find('.pack_price').val());
                  cart_add($(this).parent().siblings('.info').find('.product_id').val(), $(this).parent().siblings('.info').find('.pack_id').val(), $(this).parent().siblings('.info').find('.pack_price').val(), currentVal + 1);
              } else {
                  $(this).siblings('.qty').val(0);
              }
              var sum = 0;
              $('.total_sale_price').each(function(){
                  sum += parseFloat($(this).html()); 
              });
              $('.total_product_price').html(sum.toFixed(2));
              $('.tax_product').html(parseFloat(sum * (<?= $tax[0]['tax_percentage'] ?>/100)).toFixed(2));
              var to = parseFloat($('.total_product_price').html());
              var to_tax = parseFloat($('.tax_product').html());
              total_product_val = to+to_tax;
              $('.total_product_total').html(total_product_val.toFixed(2));
          });
          $(".qtyminus").click(function(e) {
              e.preventDefault();
              fieldName = $(this).attr('field');
              var currentVal = parseInt($(this).siblings('.qty').val());
              //if(currentVal != '0'){
               // alert(currentVal);
                if (!isNaN(currentVal) && currentVal > 1) {
                    price = parseFloat($(this).parent().siblings('.price_sale').find('.sale_price').html());
                    total_price = price * (currentVal - 1)
                    $(this).parent().siblings('.total_price_sale').find('.total_sale_price').html(total_price)
                    $(this).siblings('.qty').val(currentVal - 1);
                    cart_add($(this).parent().siblings('.info').find('.product_id').val(), $(this).parent().siblings('.info').find('.pack_id').val(), $(this).parent().siblings('.info').find('.pack_price').val(), currentVal - 1);
                } 
                else {
                    $(this).siblings('.qty').val(0);
                }
              //}
              var sum = 0;
              $('.total_sale_price').each(function(){
                  sum += parseFloat($(this).html());  
              });
              $('.total_product_price').html(sum.toFixed(2));
              $('.tax_product').html(parseFloat(sum * (<?= $tax[0]['tax_percentage'] ?>/100)).toFixed(2));
              var to = parseFloat($('.total_product_price').html());
              var to_tax = parseFloat($('.tax_product').html());
              total_product_val = to+to_tax;
              $('.total_product_total').html(total_product_val.toFixed(2));
          });
      });
    </script>
   