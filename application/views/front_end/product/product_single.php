<style>
.btn-secondary{
    color: #fff;
    background-color: #00afef;
    border-color: #00afef;
}
.dropdown-item:hover, .dropdown-item:focus {
    color: #fff;
    text-decoration: none;
    background-color: #00afef;
}
</style>
<hr class="m0">
<input type="hidden" name="product_id" id="product_id" value="<?= $data[0]['id'] ?>">
<?php //print_r($_SESSION); 
            $image = explode(',',$data[0]['images']);
            $price = $this->api_model->get_data('product_id = "'.$data[0]['id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
            $qty = 1;
           foreach($_SESSION['cart_session'] as $cart){
             if($cart['product_id'] == $data[0]['id']){
                $qty = $cart['qty'];
                $p_id = $cart['pack_id'];
                $p_price = $cart['pack_price'];
             }
           }
            ?>
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 ftco-animate">
            <a href="<?= base_url('harpahu_merge/uploads/product/')?><?= $image[0] ?>" class="image-popup">
            <div class="forimg">
            <img src="<?= base_url('harpahu_merge/uploads/product/')?><?= $image[0] ?>" class="img-fluid" alt="Colorlib Template">
          </div>
          </a>
          </div>
          <div class="col-lg-6 product-details pl-md-5 ftco-animate">
            <h3><?= $data[0]['name'] ?></h3>
            <div class="rating d-flex">
              <p class="text-left mr-4">
                <a href="#" class="mr-2" style="color: #00afef;"><?php  $avg = $this->api_model->get_data('product_id = '.$data[0]['id'].'' , 'products_reviews', '', 'AVG(rating) as rating'); echo number_format($avg[0]['rating'], 1); ?><span style="color: #bbb;">&nbsp;&nbsp;<?= $this->webLanguage['Rating']?></span></a>
              </p>
              <p class="text-left mr-4">
                <a href="#" class="mr-2" style="color: #00afef;"><?php $count = $this->api_model->get_data('product_id = '.$data[0]['id'].'' , 'products_reviews', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?><span style="color: #bbb;">&nbsp;&nbsp;<?= $this->webLanguage['Reviews']?></span></a>
              </p>
              <!-- <p class="text-left">
                <a href="#" class="mr-4" style="color: #00afef;">500 <span style="color: #bbb;">Sold</span></a>
              </p> -->
            </div>
            <div class=" m-auto d-flex">
											<?php if($this->session->userdata("users_id")){ ?>
												<span href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
													<div class="dropdown dropup" style="color: #ffff;">
														<a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fa fa-info" aria-hidden="true"></i>
														</a>
														<div class="dropdown-menu btn-secondary" aria-labelledby="dropdownMenuButton">
															<a class="dropdown-item" onclick="intrested_to_buy(<?= $data[0]['id'] ?>)">Interested in buying the product. <br>Please contact us. </a>
															
														</div>
													</div>
												</span>
                        <span class="btn-secondary" style="text-align: center !important; padding: 5px; border-radius: 24px; padding-left: 13px; padding-right: 13px; margin-left: 10px; background-color: #00afef; border-color: #00afef;">
                            <a onclick="like(<?= $data[0]['id'] ?>, <?= $price[0]['id'] ?>, <?= $price[0]['pack_id'] ?>)"class="heart d-flex justify-content-center align-items-center btn-secondary">
                              <span><i class="ion-ios-heart"></i></span>
                            </a>
                        </span>
											<?php }else{ ?>
												<span href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
													<div class="dropdown dropup" style="color: #ffff;">
														<a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fa fa-info" aria-hidden="true"></i>
														</a>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a class="dropdown-item" href="<?= base_url('frontend/interest/'.$da['id']) ?>">Interested in buying the product. <br>Please contact us. </a>
															
														</div>
													</div>
												</span>
											<?php } ?>
											</a>
										

										</div> 
            <p class="fordetails"><span><?= $this->webLanguage['Product Code']?> :</span> <?= $data[0]['sku'] ?> 
           
                    <p class="fordetails"><span><?= $this->webLanguage['Tags']?>:</span> <?= $data[0]['name'] ?>
                    
                    <div class="row"> 
                     <div class="col-12">
                    <span><?= $this->webLanguage['Select size of pack']?></span>        
                      <select name="package" id="package">
                              <?php foreach($price as $pr) {
                                $package = $this->api_model->get_data('id = "'.$pr['pack_id'].'"' , 'product_package', '', '*');
                                ?>
                              <option value="<?= $package[0]['id'] ?>" data-pack="<?= $pr['pack_id'] ?>" <?php if($pr['pack_id'] == $p_id){ echo "selected"; } ?>><?= $package[0]['name'] ?></option>
                              <?php } ?>
                          </select>   
                          <svg class="w3" x="0px" y="0px" viewBox="0 0 500 500">
                                  <use xlink:href="#rupee"></use>
                                  </svg>
                          <select name="price" id="price">
                              <?php foreach($price as $pr) {
                                $package = $this->api_model->get_data('id = "'.$pr['pack_id'].'"' , 'product_package', '', '*');
                                ?>
                              <option value="<?= $pr['id'] ?>" data-pack="<?= $pr['pack_id'] ?>" <?php if($pr['pack_id'] == $p_id){ echo "selected"; if($this->session->userdata("user_type") == 0) { $pp = $pr['sale_price']; }else{ $pp = $pr['vt_sale_price']; } } ?>><?php if($this->session->userdata("user_type") == 0) { echo $pr['sale_price'];}else{ echo $pr['vt_sale_price']; } ?></option>
                              <?php } ?>
                          </select>  
                    </div>  
                    </div>    
                    
                            
                    <div class="row">     
                    <div class="col-md-4 mt-4">    
                    <span><?= $this->webLanguage['Quantity']?></span>
                   <div class="input-group mt-2 mb-4">
                      <span class="input-group-btn mr-2">
                          <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                           <i class="ion-ios-remove"></i>
                          </button>
                        </span>
                      <input type="text" id="quantity" name="quantity" class="form-control input-number" value="<?= $qty ?>" min="1" max="100">
                      <span class="input-group-btn ml-2">
                          <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                             <i class="ion-ios-add"></i>
                         </button>
                      </span>
                    </div>     
                       
                        </div>        
                        
                    <div class="col-md-8 col-xs-3 d-flex mb-3 mt-4 text-right">   
                    <div class="row">    
                    <p class="price col-md-12" >
                        <span ><?= $this->webLanguage['Total Price']?> - </span>
                        <svg class="w5" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg> 
                        <strong class="pr"><?php if($pp != ''){ echo $qty*$pp; }else{if($this->session->userdata("user_type") == 0) { echo $qty*$price[0]['sale_price'];}else{ echo $qty*$price[0]['vt_sale_price']; }} ?></strong>
                    </p>
                    <p class=" col-md-12"><a onclick="cart()" class="btn btn-black py-3 px-5 xs-w100"><?= $this->webLanguage['Add to Cart']?></a></p>    
                    </div> 
                        </div>    
                    <div class="input-group col-md-6 col-xs-3 d-flex mb-3 mt-5">            
                    
                    </div> 
                    </div>        
          </div>
        </div>
                
            
            <div class="row">
          <div class="col-lg-8 mt-5 ftco-animate">
            <span class="subheading"><?= $this->webLanguage['Product']?></span>
              <h2><?= $this->webLanguage['Description']?></h2>
              <?php
              //print_r($_SESSION); 
              if($_SESSION['language']){
                $lang = $_SESSION['language'];
              }else{
                $lang = 'en';
              }
              $decription =  $this->api_model->get_data('table_id = "'.$data[0]['id'].'" AND language_code = "'.$lang.'" AND table = "product"', 'different_language_details'); ?>
                    <!-- <h5 class="mb-4" style="margin-top: 24px; margin-bottom: 4px !important;"><?= $this->webLanguage['Long Desciption']?></h5> -->
                    <?= $decription[0]['description'] ? $decription[0]['description'] : ($default_decription[0]['description']?$default_decription[0]['description']:$data[0]['long_desc']); ?>
          </div>
               <div class="col-lg-4 mt-5 ftco-animate">
                    <span class="subheading"><?= $this->webLanguage['Product']?></span>
                     <?php $review = $this->api_model->get_data('product_id = '.$data[0]['id'].' AND is_active = "1"' , 'products_reviews', '', 'COUNT(product_id) AS NumberOfProducts');?>
                    <h2 class="mb-4"><?= $this->webLanguage['Reviews']?> <span class="reviewcount">(<?php echo $review[0]['NumberOfProducts'];?>)</span></h2>
                    <p>
                      <?php if($this->session->userdata("user_type") == 0){ ?>
                        <a href="<?= base_url('frontend/review/').$data[0]['id'] ?>" >
                         <?= $this->webLanguage['Write a new review']?>
                        </a>
                      <?php }else{ ?>
                        <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                          <?= $this->webLanguage['Write a new review']?>
                        </a>
                      <?php } ?>
                    </p>
                    <div class="collapse forreview" id="collapseExample">
                      <div class="card card-body">
                      <!-- <form> -->
                        <div class="rating d-flex">
                          <p class="text-left mr-4">
                            <span class="mr-2"><?= $this->webLanguage['Rating']?></span>
                            <a><span class="ion-ios-star-outline ratings_star" data-rating="1"></span>
                            <span class="ion-ios-star-outline ratings_star" data-rating="2"></span>
                            <span class="ion-ios-star-outline ratings_star" data-rating="3"></span>
                            <span class="ion-ios-star-outline ratings_star" data-rating="4"></span>
                            <span class="ion-ios-star-outline ratings_star" data-rating="5"></span></a>
                          </p>
                        </div>
                     
                      <div class="form-group">
                          <textarea class="form-control" name="commnet" id="commnet" placeholder="Your review *"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary float-right" onclick="rating_review()"><?= $this->webLanguage['Submit']?></button>
                    <!-- </form> -->
                        
                      </div>
                    </div>
                    <hr>
                    <?php $review = $this->api_model->get_data('product_id = '.$data[0]['id'].' AND is_active = "1"' , 'products_reviews', '', '*');
                    $i = 0;
                    if(!empty($review)){
                      foreach($review as $re){ 
                        $i++;
                          $user_data = $this->api_model->get_data('users_id = '.$re['user_id'].'' , 'users', '', '*');
                          if($i == 10){
                            break;
                          }
                      ?> 
                      <p><strong><?= $user_data[0]['full_name'] ?></strong><br><?= $re['description'] ?></p>
                      <?php } ?>
                      <a href="<?= base_url('frontend/all_review/')?><?= $data[0]['id'] ?>" class="float-right"><?= $this->webLanguage['View All']?></a>
                    <?php }else{ ?>
                      <p><?= $this->webLanguage['No Review Found']?></p>
                    <?php } ?>
                </div>
            </div>    
            
            
            
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading"><?= $this->webLanguage['Products']?></span>
            <h2 class="mb-4"><?= $this->webLanguage['Related Products']?></h2>
            <!-- <p><?= $this->webLanguage['Far far away, behind the word mountains, far from the countries Vokalia and Consonantia']?></p> -->
          </div>
        </div>      
      </div>
      <div class="container">
        <div class="row">
          <?php $related = $this->front_end_model->get_produc_with_price('', $data[0]['category']); 
          foreach($related as $rel){
            $image = explode(',',$rel['images']);
                    $price = $this->api_model->get_data('product_id = "'.$rel['id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
          ?>
          <div class="col-md-6 col-lg-3 col-12 ftco-animate fadeInUp ftco-animated">
            <div class="product">
              <a href="<?= base_url('frontend/product_view/').$rel['id'] ?>" class="img-prod">
              <div class="forimg">
              <img class="img-fluid" src="<?= base_url('harpahu_merge/uploads/product/')?><?= $image[0] ?>" alt="Colorlib Template" >
              </div>
                <span class="status"><?php $discount = $price[0]['mrp'] - $price[0]['sale_price'];
                                    $discount = ($discount * 100) / $price[0]['mrp'];
                                    echo round($discount);  ?>%</span>
                  <div class="overlay"></div>
              </a>
              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="<?= base_url('frontend/product_view/').$rel['id'] ?>"><?= $rel['name'] ?></a></h3>
                <div class="d-flex">
                  <div class="pricing">
                    <p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?= $price[0]['mrp'] ?></span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg><?php if($this->session->userdata("user_type") == 0) { echo $price[0]['sale_price'];}else{ echo $price[0]['vt_sale_price']; } ?></span></p>
                  </div>
                </div>
                <div class="bottom-area d-flex px-3">
                  <div class="m-auto d-flex">
                    <?php if($this->session->userdata("users_id")){ ?>
                    <a onclick="intrested_to_buy(<?= $rel['id'] ?>)" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                      <span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                    </a>
                    <a onclick="like(<?= $da['id'] ?>)" class="heart d-flex justify-content-center align-items-center ">
                      <span><i class="ion-ios-heart"></i></span>
                    </a>
                  <?php }else{ ?>
                      <a href="<?= base_url('frontend/interest/'.$rel['id']) ?>" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                      <span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                    </a>
                  <?php } ?>
                    <a onclick="cart(<?= $rel['id'] ?>, <?= $price[0]['id'] ?>, <?= $price[0]['pack_id'] ?>)" class="buy-now d-flex justify-content-center align-items-center mx-1">
                      <span><i class="ion-ios-cart"></i></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
            <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
            <input type="hidden" id="users_type" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('user_type') : 0; ?>">
        </div>
      </div>
</section>

    <?php $this->load->view('front_end/product/footer_product'); ?>
  <script>
   app_url = "<?= base_url('/frontend'); ?>";
  function cart(){
    if($('#users_id').val() == '0'){
      window.location.href = "<?= base_url() ?>frontend/login";
    }else{
      cart_add($('#product_id').val(), $('#package').val(), $('#price').val(), $('#quantity').val(), $('#users_id').val(), $('#users_type').val());
    }
  }
    $('#package').on('change', function(){
      $('#price').prop("selectedIndex", $(this).prop("selectedIndex"));
      $('.pr').html(($('#price option:selected').text()) * parseInt($('#quantity').val()));
      //cart_add($('#product_id').val(), $('#package').val(), $('#price').val(), $('#quantity').val());
    })
    $('#price').on('change',function(){
      $('#package').prop("selectedIndex", $(this).prop("selectedIndex"));
      $('.pr').html(($('#price option:selected').text()) * parseInt($('#quantity').val()));
      //cart_add($('#product_id').val(), $('#package').val(), $('#price').val(), $('#quantity').val());
    })
    $(document).ready(function(){

    var quantitiy=0;
       $('.quantity-right-plus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($('#quantity').val());
                var tot = quantity;
                $('#quantity').val(quantity);
                var price = $('#price option:selected').text();
                var total = price * (tot);
                $('.pr').html(total);
                //cart_add($('#product_id').val(), $('#package').val(), $('#price').val(), quantity);
        });

         $('.quantity-left-minus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($('#quantity').val());
                if(quantity>=1){
                var tot = quantity;
                $('#quantity').val(quantity);
                var price = $('#price option:selected').text();
                var total = price * (tot);
                $('.pr').html(total);
                //cart_add($('#product_id').val(), $('#package').val(), $('#price').val(), tot);
                }else{
                  $('#quantity').val(1);
                }
                
        });
        
    });
    $(document).ready(function () {
      $(".ratings_star").click(function () {
      $(".ratings_star").removeClass("selected_rating");
        $(this).addClass("selected_rating");
       var rating = $(this).data('rating'); // Get the rating from the selected star
        $(this).addClass("ion-ios-star");
        $(this).removeClass("ion-ios-star-outline");
        $(this).prevAll().removeClass("ion-ios-star-outline");
        $(this).prevAll().addClass("ion-ios-star");
        $(this).nextAll().removeClass("ion-ios-star");
        $(this).nextAll().addClass("ion-ios-star-outline");
      });
    });
    
  function rating_review(){
  var product_id ="<?= $data[0]['id'] ?>";
  var farmer_id ="<?= $this->session->userdata("users_id") ?>";
  var rating_val = $(".selected_rating").data('rating');
  var description =  $("#commnet").val();
   $.ajax({
       url: '<?= base_url('frontend/rating_ajax') ?>',
       type: 'post',
       data: {product_id:product_id,farmer_id:farmer_id,description:description,rating:rating_val},
       dataType: 'text',
       success: function(data){
            if(data== 'Your Product Review Send'){
              $('.review-popup').hide();
              location.reload();
            }
            else{
              alert(data);
            }
    
       }
     }); 
  }
  </script>
    
  </body>
</html>