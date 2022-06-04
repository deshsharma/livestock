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
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                          <!-- Shopping cart table -->
                          <table class="cartproducts" style="width: 90%">
                            <h3 class="pb-3">Statement Summary</h3>
                            <thead>
                              <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>    
                                <th scope="col">Video Title</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Video Price</th>
                                <th scope="col">Total Price</th>    
                              </tr>
                            </thead>
                            <tbody>
                            <?php $cart_session = $this->session->userdata('video_session');
                                $price = 0;
                                $i = 0;
                                if(empty($this->session->userdata('video_session'))){
                                  redirect(base_url('all_videos'));
                                }
                                foreach($cart_session as $k=>$cart)
                                {
                                    //print_r($cart);
                                    //$video = $this->front_end_model->get_product_id($cart['product_id']);

                                    if(!empty($cart['video_id'])) {
                                      $videoDetails = $this->front_end_model->get_video_details($cart['video_id']);
                                      $image = $videoDetails[0]['video_thumb'];
                                      $videoDetailsPrice = $videoDetails[0]['price'];
                                    } else {
                                      $videoDetailsPrice = 0;  
                                      $image = '';
                                    }
                                    ?>
                                        <tr>
                                          <td class="info"><a class="text-dark" onclick="videoremovecart(<?= $i ?>)"><i class="fa fa-trash-o"></i>
                                            <input type="hidden" class="video_id" value="<?= $cart['video_id']; ?>">
                                            <input type="hidden" class="users_id" value="<?= $cart['users_id']; ?>">
                                            <input type="hidden" class="price" value="<?= $cart['price']; ?>">
                                            <input type="hidden" class="title" value="<?= $cart['title']; ?>">
                                          </a>
                                          </td>    
                                          <td>
                                            <img src="<?= base_url('uploads/videos/images/')?><?= $image ?>" alt="" width="100" class="img-fluid rounded">
                                          </td>
                                          <td data-label="Product">
                                            <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">
                                              <?= $cart['title'] ?></a>
                                            </h5>
                                          </td>
                                          <td data-label="Quantity">
                                                <input type='button' value='-' class='qtyminus' field='quantity' />
                                                <input type='text' name='quantity_<?= $id ?>' value='<?= $cart['qty'] ?>' class='qty' />
                                                <input type='button' value='+' class='qtyplus' field='quantity' />
                                          </td>
                                          <td data-label="Price" class="price_sale"><strong><svg class="w10" x="0px" y="0px" viewBox="0 0 500 500">
                                              <use xlink:href="#rupee"></use>
                                              </svg></strong><strong class="sale_price">
                                                <?php 
                                                if($this->session->userdata("user_type") == 0){ 
                                                  echo number_format($cart['price'], 2);  
                                                }else { 
                                                  echo number_format($cart['price'],2); } 
                                                ?>
                                            
                                                </strong>
                                          </td>

                                          <td data-label="Total Price" class="total_price_sale"><strong><svg class="w10" x="0px" y="0px" viewBox="0 0 500 500">
                                                <use xlink:href="#rupee"></use>
                                                </svg></strong><strong class="total_sale_price"><?php  
                                                if($this->session->userdata("user_type") == 0){
                                                  echo number_format(($cart['price']) * $cart['qty'], 2);
                                                  $total_price += number_format(($cart['price']) * $cart['qty'],2);
                                                }else{
                                                  echo number_format(($cart['price']) * $cart['qty'],2);
                                                  $total_price += number_format(($cart['price']) * $cart['qty'],2);
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
                          <div class="row py-5 p-4 bg-white rounded shadow-sm" style="width: 90%">
                            <div class="col-lg-6 col-12">
                              <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                              <div class="p-4">
                                <ul class="list-unstyled mb-4">
                                  <li class="d-flex justify-content-between py-3 border-bottom"><strong>Order Subtotal </strong><strong class="text-right"><svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                                            <use xlink:href="#rupee"></use>
                                            </svg><span class="total_product_price"><?=  number_format($total_price, 2) ?></span></strong>
                                  </li>
                                  <?php $tax =$this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage');?>
                                  <li class="d-flex justify-content-between py-3 border-bottom"><strong>Tax</strong><strong class="text-right">
                                    <svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                                      <use xlink:href="#rupee"></use>
                                      </svg><span class="tax_product"><?= $app_tax = number_format($total_price*($tax[0]['tax_percentage']/100), 2)  ?></span></strong>
                                  </li>
                                  <li class="d-flex justify-content-between py-3 border-bottom"><strong>Total</strong><strong class="text-right">
                                      <svg class="w4" x="0px" y="0px" viewBox="0 0 500 500">
                                        <use xlink:href="#rupee"></use>
                                      </svg>
                                      <span class="total_product_total"><?= number_format($app_tax + $total_price, 2) ?></span></strong>
                                  </li>
                                </ul>
                                <?php if($this->session->userdata("users_id") != ""){ ?>
                                    <a href="<?= base_url('all_videos/video_checkout/') ?>" class="btn btn-dark rounded-pill check btn-block mt-4">Procceed to checkout</a>
                                <?php }else{?>
                                    <a href="<?= base_url('all_videos/video_reg/') ?>" class="btn btn-dark rounded-pill check btn-block mt-4">Procceed to checkout</a>
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
                                    
  <script>
    app_url = "<?= base_url('/all_videos'); ?>";
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
                  video_cart_add(
                    $(this).parent().siblings('.info').find('.video_id').val(), 
                    $(this).parent().siblings('.info').find('.price').val(), 
                    $(this).parent().siblings('.info').find('.users_id').val(), 
                    $(this).parent().siblings('.info').find('.title').val(),
                    currentVal + 1);
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

                    video_cart_add(
                    $(this).parent().siblings('.info').find('.video_id').val(), 
                    $(this).parent().siblings('.info').find('.price').val(), 
                    $(this).parent().siblings('.info').find('.users_id').val(), 
                    $(this).parent().siblings('.info').find('.title').val(), 
                    currentVal - 1);
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
   