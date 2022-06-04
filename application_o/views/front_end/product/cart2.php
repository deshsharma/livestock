<?php 
//$cart_session = $this->session->userdata('cart_session');
$cart_session = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart', '', 'count(id) as count');
$total_cart=$cart_session[0]['count'];
// echo $total_cart;
// exit;
$language = $this->api_model->get_data('code = "'.language_library.'"', 'language');
$key = $this->api_model->get_data('language_id = "'.$language[0]['id'].'"','language_library','','key');
$value = $this->api_model->get_data('language_id = "'.$language[0]['id'].'"','language_library','','description');
//echo "<pre>";
//print_r($value);
$i= 0;
foreach($key as $k){
  $detail[$k['key']] = $value[$i]['description'];
  $i++;
}
$language_library = $detail;
//$library= array_fill_keys($key, $value);
//print_r($language_library);
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
                  <h3 class="pb-3"><?= $language_library['Statement Summary'] ?></h3>
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>    
                      <th scope="col"><?= $language_library['Product'] ?></th>
                      <th scope="col"><?= $language_library['Quantity'] ?></th>
                      <th scope="col"><?= $language_library['Price'] ?></th>
                      <th scope="col"><?= $language_library['Total Price'] ?></th>    
                    </tr>
                  </thead>
                  <tbody>
                  <?php //$cart_session = $this->session->userdata('cart_session');
                          $price = 0;
                          $i = 0;
                          if($total_cart > '1'){
                            redirect(base_url('frontend/product_listing'));
                          }
                          $total_price = 0;
                          $cart_ses = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart');
                          foreach($cart_ses as $k=>$cart)
                          {
                            
                                        $products = $this->front_end_model->get_product_id($cart['product_id']);
                                        $image = explode(',',$products[0]['images']);
                                        $price = $this->api_model->get_data('id = "'.$cart['pack_price'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
                                       
                                       ?>
                                            <tr>
                                              <td class="info"><a class="text-dark" onclick="removecart(<?= $cart['id'] ?>)"><i class="fa fa-trash-o"></i>
                                                <input type="hidden" class="product_id" value="<?= $cart['product_id']; ?>">
                                                <input type="hidden" class="pack_id" value="<?= $cart['pack_id']; ?>">
                                                <input type="hidden" class="pack_price" value="<?= $cart['pack_price']; ?>">
                                              </a>
                                              </td>    
                                              <td><img src="<?= base_url('harpahu_merge/uploads/product/')?><?= $image[0] ?>" alt="" width="100" class="img-fluid rounded">
                                              </td>
                                              <td data-label="<?= $language_library['Product'] ?>"><h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $products[0]['name'] ?></a></h5>
                                              </td>
                                              <td data-label="<?= $language_library['Quantity'] ?>">
                                                    <input type='button' value='-' class='qtyminus' field='quantity' />
                                                    <input type='text' name='quantity_<?= $id ?>' value='<?= $cart['qty'] ?>' class='qty' />
                                                    <input type='button' value='+' class='qtyplus' field='quantity' />
                                              </td>
                                              <td data-label="<?= $language_library['Price'] ?>" class="price_sale"><strong><svg class="w10" x="0px" y="0px" viewBox="0 0 500 500">
                                                                <use xlink:href="#rupee"></use>
                                                                </svg></strong><strong class="sale_price"><? if($this->session->userdata("user_type") == 0){ echo number_format($price[0]['sale_price'],2);  }else { echo number_format($price[0]['vt_sale_price'],2); } ?></strong>
                                              </td>
                                              <td data-label="<?= $language_library['Total Price'] ?>" class="total_price_sale"><strong><svg class="w10" x="0px" y="0px" viewBox="0 0 500 500">
                                                                <use xlink:href="#rupee"></use>
                                                                </svg></strong><strong class="total_sale_price"><?php 
                                                                if($this->session->userdata("user_type") == 0){
                                                                  $total_price += $price[0]['sale_price'] * $cart['qty'];
                                                                  echo number_format($price[0]['sale_price']*$cart['qty'],2);
                                                                  //$total_price += number_format($price[0]['sale_price']*$cart['qty'],2);
                                                                }else{
                                                                  echo number_format($price[0]['vt_sale_price']*$cart['qty'],2);
                                                                  $total_price += $price[0]['vt_sale_price']*$cart['qty'];
                                                                }                                                                ?>
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
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"><?= $language_library['Order summary'] ?> </div>
                    <div class="p-4">
                      <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['Order Subtotal'] ?> </strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                  <use xlink:href="#rupee"></use>
                                  </svg><span class="total_product_price"><?=  number_format($total_price, 2) ?></span></strong></li>
                                  <?php $tax = $this->api_model->get_data('' , 'tax_table', '', 'id, name, tax_percentage'); 
                                  ?>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['Tax'] ?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                  <use xlink:href="#rupee"></use>
                                  </svg><span class="tax_product"><?php  echo number_format($total_price*($tax[0]['tax_percentage']/100), 2); $app_tax = $total_price*($tax[0]['tax_percentage']/100); ?></span></strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['Total'] ?></strong><strong class="text-right"><svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                                  <use xlink:href="#rupee"></use>
                                  </svg><span class="total_product_total"><?= number_format($app_tax + $total_price, 2) ?></span></strong></li>
                      </ul>
                    </div>
                  </div>
                  <?php// $user_id = $this->session->userdata("users_id"); print_r($user_id);?>
                  <?php if($this->session->userdata("users_id") != ""){ 
                    $user = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"','users');

                    if($user[0]['address_id'] != ''){
                      $address = $this->api_model->get_data('address_id = "'.$user[0]['address_id'].'" AND users_id = "'.$this->session->userdata("users_id").'"', 'address_mst');
                     // print_r($address);
                    }else{
                      $address = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"', 'address_mst', 'address_id DESC');
                    }
                    $district = $this->api_model->get_data('dis_id = '.$address[0]['district_id'].'', 'district');
                   // print_r($district);
                    ?>
                  <div class="col-lg-6 col-12">
                  <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"><?= $language_library['ADDRESS'] ?></div>
                    <div class="p-4">
                    <?php if(!empty($address)){ ?>
                      <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['Contact Person'] ?></strong><span class="total_product_price"><?= $address[0]['fullname'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['Mobile No'] ?></strong><span class="total_product_price"><?= $address[0]['mobile_code'].$address[0]['mobile'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['Address'] ?></strong><span class="total_product_price"><?= $address[0]['address1'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['District'] ?></strong><span class="total_product_price"><?= $district[0]['dist_name'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['Pin Code'] ?></strong><span class="total_product_price"><?= $address[0]['postal_code'] ?></span></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong><?= $language_library['Address Type'] ?></strong><span class="total_product_price"><?= $address[0]['address_type'] ?></span></li>
                      </ul>
                      <?php if($address[0]['district_id'] != '0'){ ?>
                       <div class="col-12">
                        <form method="post" action="<?= base_url('frontend/product_checkout/') ?>" class="login100-form validate-form">    
                          <input type="hidden" name="address_id" id="" value="<?php if($address[0]['address_id'] != ''){ echo $address[0]['address_id']; } ?>">
                          <input type="hidden" name="form_lat" id="form_lat" value="<?php if($address[0]['latitude'] != ''){ echo $address[0]['latitude']; } ?>">
                          <input type="hidden" name="form_lang" id="form_lang" value="<?php if($address[0]['longitude'] != ''){ echo $address[0]['longitude']; }?>">  
                        <button href="" class="btn btn-dark rounded-pill check btn-block mt-4 check_button" style="text-align: center;"><?= $language_library['Procceed to checkout'] ?></button>
                        </form>
                      </div>
                    <?php } } 
                    
                    if($address[0]['district_id'] == '0'){ ?>
                      <a href="<?= base_url('frontend/resetaddress/').$address[0]['address_id'] ?>" class="btn btn-dark rounded-pill check btn-block mt-4 check_button" style="text-align: center;"><?= $language_library['Edit Address'] ?></a>
                    <?php }else{ ?>
                      <a href="<?= base_url('frontend/my_account/') ?>" class="btn btn-dark rounded-pill check btn-block mt-4 check_button" style="text-align: center;"><?= $language_library['Add Address']?></a>
                    <?php } ?>
                    </div>
                  </div>
                 
                      <?php }else{?>
                        <div class="col-12">
                        <a href="<?= base_url('frontend/product_reg/') ?>" class="btn btn-dark rounded-pill check btn-block mt-4"><?= $language_library['Procceed to checkout'] ?></a>
                        
                      <?php } ?>
                  
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
        $('.check_button').click(function(e){
          if($('#form_lat').val() == ''){
            if (confirm('Please On GeoLocation')) {
                location.reload();
                e.preventDefault()
            } else {
                e.preventDefault()
            }
          }
        });
      $('.state').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
              var str =data;
                    var option = '<option value="">Select District</option>';
                                  $.each(str.data, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
                                  }); 
                                        $('.city').html(option);
                    
                }
                });
    })
    app_url = "<?= base_url('/frontend'); ?>";
	</script>
    <script>
      var x = $("#lat_demo");
    $(document).ready(function(){
      getLocation();
    })
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                alert("Geolocation is not supported by this browser.");
            }
        }
        function showPosition(position) {
          if($('#form_lat').val() == ''){
            $('#form_lat').val(position.coords.latitude);
            $('#form_lang').val(position.coords.longitude);
          }
            //alert("Latitude: " + position.coords.latitude +  "<br>Longitude: " + position.coords.longitude);
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
                  cart_add($(this).parent().siblings('.info').find('.pack_id').val(), $(this).parent().siblings('.info').find('.product_id').val(), $(this).parent().siblings('.info').find('.pack_price').val(), currentVal + 1,$('#users_id').val(),$('#user_type').val());
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
                    cart_add($(this).parent().siblings('.info').find('.pack_id').val(), $(this).parent().siblings('.info').find('.product_id').val(), $(this).parent().siblings('.info').find('.pack_price').val(), currentVal - 1, $('#users_id').val(),$('#user_type').val());
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
   