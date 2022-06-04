<?php
//print_r($_SESSION);
$cart_session = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart', '', 'count(id) as count');
$total_cart=$cart_session[0]['count'];
//echo $total_cart;
?>
<link rel="stylesheet" href="<?= base_url() ?>assets/product/css/style2.css">
    <section class="ftco-section ftco-cart bg_gradient">
    <input type="hidden" name="users_id" id="users_id" value="<?= $this->session->userdata("users_id") ?>">
    <input type="hidden" name="user_type" id="user_type" value="<?= $this->session->userdata("user_type") ?>">
			<div class="container">
				<div class="row">
          <div class="col-12 px-4 px-lg-0">
          <div class="pb-5">
            <div class="container">
              <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
          <!-- Shopping cart table -->
                <table class="cartproducts">
                  <h3 class="pb-3"><?= $this->webLanguage['Statement Summary']?></h3>
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>    
                      <th scope="col"><?= $this->webLanguage['Product']?></th>
                      <th scope="col"><?= $this->webLanguage['Quantity']?></th>
                      <th scope="col"><?= $this->webLanguage['Price']?></th>
                      <th scope="col"><?= $this->webLanguage['Total Price']?></th>    
                    </tr>
                  </thead>
                  <tbody>
                  <?php //$cart_session = $this->session->userdata('cart_session');
                          $price = 0;
                          $i = 0;
                           if($total_cart == '0'){
                            redirect(base_url('frontend/product_listing'));
                          }
                          // if(empty($this->session->userdata('cart_session'))){
                          //   redirect(base_url('frontend/product_listing'));
                          // }
                           $total_price = 0;
                          $cart_ses = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart');
                          $total_price = 0;
                          //print_r($cart_ses);
                          foreach($cart_ses as $k=>$cart)
                          {
                            
                                        $products = $this->front_end_model->get_product_id($cart['product_id']);
                                        $image = explode(',',$products[0]['images']);
                                        $price = $this->api_model->get_data('product_id = "'.$cart['product_id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');

                                       
                                       ?>
                                            <tr>
                                              <td class="info"><a class="text-dark" onclick="removecart(<?= $cart['id'] ?>)"><i class="fa fa-trash-o"></i>
                                                <input type="hidden" class="product_id" value="<?= $cart['product_id']; ?>">
                                                <input type="hidden" class="pack_id" value="<?= $cart['pack_id']; ?>">
                                                <input type="hidden" class="pack_price" value="<?= $cart['pack_price']; ?>">
                                                <input type="hidden" class="users_id" value="<?= $cart['users_id']; ?>">
                                              </a>
                                              </td>    
                                              <td><img src="<?= base_url('harpahu_merge/uploads/product/')?><?= $image[0] ?>" alt="" width="100" class="img-fluid rounded">
                                              </td>
                                              <td data-label="<?= $this->webLanguage['Product']?>"><h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $products[0]['name'] ?></a></h5>
                                              </td>
                                              <td data-label="<?= $this->webLanguage['Quantity']?>">
                                                    <input type='button' value='-' class='qtyminus' field='quantity' />
                                                    <input type='text' name='quantity_<?= $id ?>' value='<?= $cart['qty'] ?>' class='qty' />
                                                    <input type='button' value='+' class='qtyplus' field='quantity' />
                                              </td>
                                              <td data-label="<?= $this->webLanguage['Price']?>" class="price_sale"><strong><svg class="w10" x="0px" y="0px" viewBox="0 0 500 500">
                                                                <use xlink:href="#rupee"></use>
                                                                </svg></strong><strong class="sale_price"><? if($this->session->userdata("user_type") == 1){ echo number_format($price[0]['sale_price'],2);  }else { echo number_format($price[0]['vt_sale_price'],2); } ?></strong>
                                              </td>
                                              <td data-label="<?= $this->webLanguage['Total Price']?>" class="total_price_sale"><strong><svg class="w10" x="0px" y="0px" viewBox="0 0 500 500">
                                                                <use xlink:href="#rupee"></use>
                                                                </svg></strong><strong class="total_sale_price"><?php 
                                                                if($this->session->userdata("user_type") == 1){
                                                                	//echo $price[0]['sale_price'];
                                                                  $total_price += $price[0]['sale_price'] * $cart['qty'];

                                                                  echo number_format($price[0]['sale_price']*$cart['qty'],2);
                                                                  //$total_price += number_format($price[0]['sale_price']*$cart['qty'],2);
                                                                }else{
                                                                  echo number_format($price[0]['vt_sale_price']*$cart['qty'],2);
                                                                  $total_price += $price[0]['vt_sale_price']*$cart['qty'];
                                                                  //echo $total_price;
                                                                }                                                                ?>
                                                              </strong>
                                              </td>    
                                            </tr>
                  <?php $i++;  
                  // print_r($products);
                  // exit;                                             
                $app_tax += ($price[0]['sale_price'] * $cart['qty']) * $products[0]['gst']/100;
                } ?>    
                  </tbody>
                </table>    
          <!-- End -->
                  </div>
                </div>
                <div class="row py-5 p-4 bg-white rounded shadow-sm">
                  <div class="col-lg-6 col-12">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"><?= $this->webLanguage['Order summary']?> </div>
                    <div class="p-4">
                      <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Order Subtotal']?> </strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                  <use xlink:href="#rupee"></use>
                                  </svg><span class="total_product_price"><?=  number_format($total_price, 2) ?></span></strong></li>
                                  <?php $tax = $this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage'); 
                                  ?>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Tax']?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                  <use xlink:href="#rupee"></use>
                                  </svg><span class="tax_product"><?php  echo number_format($app_tax, 2); ?></span></strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Total']?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                  <use xlink:href="#rupee"></use>
                                  </svg><span class="total_product_total"><?= number_format($app_tax + $total_price, 2) ?></span></strong></li>
                      </ul>
                    </div>
                  </div>
                  <?php if($this->session->userdata("users_id") != ""){ 
                    $user = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"','users');

                    if($user[0]['address_id'] != ''){
                      $address = $this->api_model->get_data('address_id = "'.$user[0]['address_id'].'" AND users_id = "'.$this->session->userdata("users_id").'"', 'address_mst');
                     // print_r($address);
                    }else{
                      $address = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"', 'address_mst', 'address_id DESC');
                    }
                    //print_r($address);
                    ?>
                  <div class="col-lg-6 col-12">
                  <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"><?= $this->webLanguage['Address']?></div>
                    <div class="p-4">
                    <?php if(!empty($address)){ ?>
                      <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Contact Person']?></strong><span class=""><?= $address[0]['fullname'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Mobile No']?></strong><span class=""><?= $address[0]['mobile_code'].$address[0]['mobile'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Address']?> </strong> &nbsp;<span class=""> <?= $address[0]['address1'] ?> <br><?= $address[0]['address2'] ?></span></li>
                        <!-- <li class="d-flex justify-content-between py-3 border-bottom"><strong></strong><span class="total_product_price"><?= $address[0]['address2'] ?></span></li> -->
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['District']?></strong><span class=""><?= $address[0]['district'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Pin Code']?></strong><span class=""><?= $address[0]['postal_code'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $this->webLanguage['Address Type']?></strong><span class=""><?= $address[0]['address_type'] ?></span></li>
                      </ul>
                       <div class="col-12">
                       
                      </div>
                    <?php } ?>
                    <a href="<?= base_url('frontend/my_account/') ?>" class="btn btn-dark rounded-pill check btn-block mt-4 check_button" style="text-align: center;"><?= $this->webLanguage['Add Address']?></a>
                    </div>
                  </div>
                 
                      <?php } ?>
                  
              <!-- </div> -->
              <!-- <div class="row  py-5 p-4 bg-white rounded shadow-sm"> -->
                <div class="col-12">
                  <?php if($this->session->userdata("users_id") != ""){ ?>
                          <form method="post" action="<?= base_url('frontend/product_checkout/') ?>" class="login100-form validate-form" id="form_data">
                            <input type="hidden" name="address_id" id="" value="<?php if($address[0]['address_id'] != ''){ echo $address[0]['address_id']; } ?>">    
                            <input type="hidden" name="form_lat" id="form_lat" value="<?php if($address[0]['latitude'] != ''){ echo $address[0]['latitude']; } ?>">
                            <input type="hidden" name="form_lang" id="form_lang" value="<?php if($address[0]['longitude'] != ''){ echo $address[0]['longitude']; }?>">  
                            <button href="" class="btn btn-dark rounded-pill check btn-block mt-4 check_button" style="text-align: center;" <?php if(empty($address)){ ?> disabled <?php } ?> <?php if($address[0]['zone_id'] != '1500' && $address[0]['zone_id'] != '1486'){ ?> onclick="msg()" <?php } ?>><?= $this->webLanguage['Procceed to checkout']?></button>
                          </form>
                          <?php }else{?>
                            <a href="<?= base_url('frontend/product_reg/') ?>" class="btn btn-dark rounded-pill check btn-block mt-4"><?= $this->webLanguage['Procceed to checkout']?></a>
                  <?php } ?>
                </div>
              <!-- </div> -->
              </div>
                </div>

              </div>
            </div>
          </div>
    		</div>
			</div>
		</section>
    <?php include('footer_product.php'); ?>    
    <script src="<?= base_url() ?>/assets/app/js/cart.js"></script>                                 
    <script>
    app_url = "<?= base_url('/frontend'); ?>";
	</script>
    <script>
    function msg(e){
      alert('Currently, We are providing services in Punjab and Haryana Only.');
      $("#form_data").submit(function(e){
          e.preventDefault();
      });
    }
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
                  cart_add($(this).parent().siblings('.info').find('.product_id').val(), $(this).parent().siblings('.info').find('.pack_id').val(), $(this).parent().siblings('.info').find('.pack_price').val(), currentVal + 1,$('#users_id').val(),$('#user_type').val());
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
                     cart_add($(this).parent().siblings('.info').find('.product_id').val(), $(this).parent().siblings('.info').find('.pack_id').val(), $(this).parent().siblings('.info').find('.pack_price').val(), currentVal - 1, $('#users_id').val(),$('#user_type').val());
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
   