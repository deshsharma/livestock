<?php 
$cart_session = $this->session->userdata('cart_session');
$total_cart=count($cart_session);
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
<hr class="m0">
    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<?php $image = explode(',',$data[0]['images']); 

    			?>
    			<div class="col-lg-2 mb-5 ftco-animate">
    				<a href="<?= base_url('uploads/product/')?><?= $image[0] ?>" class="image-popup"><img src="<?= base_url('uploads/product/')?><?= $image[0] ?>" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?= $data[0]['name'] ?></h3>
    				<div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #00afef;"><?php  $avg = $this->api_model->get_data('product_id = '.$data[0]['id'].'' , 'products_reviews', '', 'AVG(rating) as rating'); echo number_format($avg[0]['rating'], 1); ?> <span style="color: #bbb;"><?= $language_library['Rating'] ?></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #00afef;"><?php $count = $this->api_model->get_data('product_id = '.$data[0]['id'].'' , 'products_reviews', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?> <span style="color: #bbb;"><?= $language_library['Reviews'] ?></span></a>
							</p>
						</div>
  
                           
    			</div>
    		</div>
                
            
            <div class="row">
    			
                <div class="col-lg-12 mt-2 ftco-animate">
                    <h2 class="mb-4"><?= $language_library['All Reviews'] ?> <span class="reviewcount">(<?php $count = $this->api_model->get_data('product_id = '.$data[0]['id'].'' , 'products_reviews', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?>)</span></h2>
                    <p>
                      <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <?= $language_library['Write a new review'] ?>
                      </a>
                    </p>
                    <div class="collapse forreview" id="collapseExample">
                      <div class="card card-body">
                        <div class="rating d-flex">
							<p class="text-left mr-4">
								<span class="mr-2"><?= $language_library['Rating'] ?></span>
								<a><span class="ion-ios-star-outline ratings_star" data-rating="1"></span>
								<span class="ion-ios-star-outline ratings_star" data-rating="2"></span>
								<span class="ion-ios-star-outline ratings_star" data-rating="3"></span>
								<span class="ion-ios-star-outline ratings_star" data-rating="4"></span>
								<span class="ion-ios-star-outline ratings_star" data-rating="5"></span></a>
							</p>
						 </div>
                      <div class="form-group">
                          <textarea class="form-control" name="commnet" id="commnet"  placeholder="Your review *"></textarea>
                      </div>
                      <button type="submit"  onclick="rating_review()" class="btn btn-primary float-right">Submit</button>
                        
                      </div>
                    </div>
                    <hr>
                    <?php $review = $this->api_model->get_data('product_id = '.$data[0]['id'].'' , 'products_reviews', '', '*');
                    $i = 0;
                    if(!empty($review)){
                      foreach($review as $re){ 
                        $i++;
                          $user_data = $this->api_model->get_data('users_id = '.$re['user_id'].'' , 'users', '', '*');
                          if($i == 10){
                            break;
                          }
                      ?> 
                    	<p class="mb-0"><strong><?= $user_data[0]['full_name'] ?></strong></p>
                        <div class="rating d-flex">
							<p class="text-left">
								<span class="mr-2"><?= $language_library['Rating'] ?></span>
								<?php
								$num = $re['rating'];
                    //echo '<p class="ml-2" style="font-size:10px;">Consumer Rating:-';
		                    for ($n=1; $n<=5; $n++) {
		                        echo '<span class="ion-ios-star';
		                            if ($num<$n) {
		                                        echo '-outline';
		                            }
                                echo '"></span>';
                            }
								?>
							</p>
						 </div>
                        <p><?= $re['description'] ?></p>
                    <?php } }else{ ?>
                      <p>No Review Found</p>
                    <?php } ?>
                </div>
            </div>    
    	</div>
    </section>
    <div class="container">
        <div class="row">
          <?php $related = $this->front_end_model->get_produc_with_price('', $data[0]['category']); 
          foreach($related as $rel){
            $image = explode(',',$rel['images']);
                    $price = $this->api_model->get_data('product_id = "'.$rel['id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
          ?>
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="<?= base_url('frontend/product_view/').$rel['id'] ?>" class="img-prod"><img class="img-fluid" src="<?= base_url('uploads/product/')?><?= $image[0] ?>" alt="Colorlib Template">
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
        </div>
      </div>
    </section>
        <?php include('footer.php'); ?>
  <script>
   app_url = "<?= base_url('/frontend'); ?>";
  function cart(){
    cart_add($('#product_id').val(), $('#package').val(), $('#price').val(), $('#quantity').val());
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