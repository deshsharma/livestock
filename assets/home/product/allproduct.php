<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<hr class="m0">
    
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="owl-carousel owl-theme">
            <div class="item">
              <img src="<?= base_url() ?>assets/product/images/actual2.jpg"> 
            </div>
            <div class="item">
              <img src="<?= base_url() ?>assets/product/images/actual.jpg">
            </div>
          </div>
            </div>
        </div>  
    </div>  
    <section class="ftco-section pt-0 pb-0">   
      <div class="container-fluid">
            <div class="row">
            <div class="w20 forfilters-outer">
            <hr class="d-block d-ms-none d-md-none d-lg-none mt-0 pt-0">     
            <h5 class="filterexpand">Select Filters</h5>
               
            <hr> 
            <div class="filtercontent">  
            
      <?php 
          if($sec_id != ''){ ?> 
            <div class="row">
                <div class="col-12 mt-4">
                    <p>Categories</p>    
         
            <?= $category ?>
              
              </div>
                </div>    
      <?php } ?>
      </div>  
            </div>
            
            <div class="w80">    
            <div class=" pl-3 pr-3 pl-sm-5 pl-md-5 pl-lg-5 pr-sm-5 pr-md-5 pl-lg-5 mt-3 mt-sm-5 mt-md-5 mt-lg-5">    
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link <?php if($sec_id == ''){ echo 'active'; } ?>" href="<?= base_url('frontend/product_listing'); ?>" role="tab" aria-controls="pills-home-tab" aria-selected="true">All Products</a>
          </li>
            <?php $section = $this->api_model->get_section(); 
              foreach($section as $sec){
              ?>
                  <li class="nav-item" >
                    <a class="nav-link <?php if($sec_id == $sec['id']){ echo 'active'; } ?>" id="pills-profile-tab"  href="<?= base_url('frontend/product_listing/').$sec['id'] ?>" ><?= $sec['name'] ?></a>
                  </li>
            <?php
              } 
            ?>
            </ul>
                <div class="bg-featured">
            <div class="row justify-content-center mb-3">
          <div class="col-md-12 heading-section text-left ftco-animate">
            <h5 class="mb-4 pl-3 pl-sm-5 pl-md-5">Premium Products</h5>
            <?php if(sizeof($data_pro) == 0) {?>
              <h5 class="mb-4 pl-3 pl-sm-5 pl-md-5">Records are not available</h5>
            <?php } ?>
            <div class="row pl-3 pl-sm-5 pl-md-5 pr-3 pr-sm-5 pr-md-5">
                <?php 
                foreach($data_pro as $da){
                    $image = explode(',',$da['images']);
                    $price = $this->api_model->get_data('product_id = "'.$da['id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
                    ?>
                <div class="col-md-6 col-lg-4 ftco-animate premium">
            <div class="product">
              <a href="<?= base_url('frontend/product_view/').$da['id'] ?>" class="img-prod">
                            <div class="forimg">
                            <img class="img-fluid" src="<?= base_url('uploads/product/')?><?= $image[0] ?>" alt="Livestoc">
                            </div>    
                <span class="status"><img class="img-fluid" src="<?= base_url('uploads/product/premium.png') ?>" alt="Livestoc"></span>
                <div class="overlay"></div>
                            <p class="qty3"><?php $package = $this->api_model->get_data('id = "'.$price[0]['pack_id'].'"' , 'product_package', '', '*'); echo $package[0]['name']; ?></p>
                             
              </a>
              
                        <div class="text py-1 pb-1 pl-3 text-left bdrnew1">
                            <div class="row">
	                            <div class="col-8">    
					                <h3 class="mt-2" ><a href="<?= base_url('frontend/product_view/').$da['id'] ?>"> <?= $da['brand'] ?></a></h3>				               
					                <h3 class="fordet"><a href="<?= base_url('frontend/product_view/').$da['id'] ?>" ><?= $da['name'] ?></a></h3>
	                            </div>                           
	                            <div class="col-4 video text-center pl-0 mt-2 mb-2">
		                            <a class="myvid" data-link="<?= base_url('uploads/product/')?><?= base_url('uploads/product/')?><?= $da['video_id'] ?>" data-vedio="<?= $da['video_id'] ?>">    
		                            <i class="fa fa-play mb-2" aria-hidden="true"></i><br>    
		                            <span>Watch Video</span>
		                            </a>    
	                            </div> 
              				</div>
                        </div>
                        
                <div class="text pb-3 text-left cart">
                <div class="d-flex">
                  <div class="pricing">
                                    <div class="forcartnew">
                                    <p class="mb-0 add w-50 text-left float-left bdrrnew" onclick="cart(<?= $da['id'] ?>, <?= $price[0]['id'] ?>, <?= $price[0]['pack_id'] ?>)">Add to Cart</p>
                                    <p class="mb-0 w-50 add text-left float-left pl-2 pricenew"><span class="mr-2 price-dc"><svg class="w55new" x="0px" y="0px" viewBox="0 0 500 500">
                                         <use xlink:href="#rupee"></use>
                                        </svg><?= $price[0]['mrp'] ?></span>
                                        <br/>
                                        <span class="price-sale" style="font-size: small;"><svg class="w55new" x="0px" y="0px" viewBox="0 0 500 500">
                                        <use xlink:href="#rupee"></use>
                                        </svg><?php if($this->session->userdata("user_type") == 0) { echo $price[0]['sale_price'];}else{ echo $price[0]['vt_sale_price']; } ?>
                                      </span>
                                    </p>
                                    </div>    
                                    <?php if($this->session->userdata("users_id")){ ?>
                                    <div class="dropdown float-left w-100 mt-2 pl-3 pr-3">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        I am Interested <i class="fa fa-ellipsis-v" aria-hidden="true"></i> 
                                      </button>
                                         
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="intrested_to_buy(<?= $da['id'] ?>)">Interested In buying the product. <br>Please contact us. </a>
                                       
                                      </div>
                                    </div>
                                    <?php }else{ ?>
                                        <div class="dropdown float-left w-100 mt-2 pl-3 pr-3">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        I am Interested<i class="fa fa-ellipsis-v" aria-hidden="true"></i> 
                                      </button>
                                         
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?= base_url('frontend/interest/'.$da['id']) ?>">Interested In buying the product. <br>Please contact us. </a>
                                      </div>
                                    </div>
                                    <?php } ?>
                                    
                                     <div class="forratenew pl-3 pr-3">
                                     <p class="mb-0 add w-50 text-left ratingnew float-left"><i class="fa fa-star"></i> <?php  $avg = $this->api_model->get_data('product_id = '.$da['id'].'' , 'products_reviews', '', 'AVG(rating) as rating'); echo number_format($avg[0]['rating'], 1); ?> <span>| Reviews:<?php $count = $this->api_model->get_data('product_id = '.$da['id'].'' , 'products_reviews', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?></span></p><p class="mb-0 add w-50 text-right float-left" id="canShare">
                                    </p></div>
                  </div>
                </div>
              </div>
            </div>
          </div> 
                <?php } ?>
            </div>   
          </div>
        </div>      
      </div>
            <div class="tab-content mt-5" id="pills-tabContent">
                
            <!-- tab 1 -->    
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <h5 class="mb-4 pl-3 pl-sm-5 pl-md-5">All Products</h5>
                <?php if(sizeof($data) == 0) {?>
                  <h5 class="mb-4 pl-3 pl-sm-5 pl-md-5">Records are not available</h5>
                <?php } ?>
                <div class="row">  
        <?php 
        foreach($data as $da){
          $image = explode(',',$da['images']);
          $price = $this->api_model->get_data('product_id = "'.$da['id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
          ?>  
            <div class="col-md-6 col-lg-3 ftco-animate">
              <div class="product">
                <a href="<?= base_url('frontend/product_view/').$da['id'] ?>" class="img-prod"><img class="img-fluid" src="<?= base_url('uploads/product/')?><?= $image[0] ?>" alt="Livestoc" style="height: 182px; width: 100%;">
                  <span class="status"><?php $discount = $price[0]['mrp'] - $price[0]['sale_price'];
                                    $discount = ($discount * 100) / $price[0]['mrp'];
                                    echo round($discount);  ?>%</span>
                  <div class="overlay"></div>
                </a>
                <div class="text py-3 pb-4 text-center">
                  <h3><a href="#"><?= $da['name'] ?></a></h3>
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
                        <span href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                          <div class="dropdown dropup">
                            <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" onclick="intrested_to_buy(<?= $da['id'] ?>)">Interested in buying the product. <br>Please contact us. </a>
                              
                            </div>
                          </div>
                        </span>
                                                <span>
                        <a onclick="like(<?= $da['id'] ?>, <?= $price[0]['id'] ?>, <?= $price[0]['pack_id'] ?>)"class="heart d-flex justify-content-center align-items-center ">
                          <span><i class="ion-ios-heart"></i></span>
                        </a>
                                                </span>
                      <?php }else{ ?>
                        <span href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                          <div class="dropdown dropup">
                            <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="<?= base_url('frontend/interest/'.$da['id']) ?>">Interested in buying the product. <br>Please contact us. </a>
                              
                            </div>
                          </div>
                        </span>
                      <?php } ?>
                      <a  onclick="cart(<?= $da['id'] ?>, <?= $price[0]['id'] ?>, <?= $price[0]['pack_id'] ?>)" class="buy-now d-flex justify-content-center align-items-center mx-1">
                        <span><i class="ion-ios-cart"></i></span>
                      </a>                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php } ?>
        <script >
             if (navigator.canShare && navigator.canShare({ files: filesArray })) {
			        navigator.share({
			          files: filesArray,
			          title: 'Vacation Pictures',
			          text: 'Photos from September 27 to October 14.',
			        })
			        .then(() => console.log('Share was successful.'))
			        .catch((error) => console.log('Sharing failed', error));
			      } else {
			        console.log(`Your system doesn't support sharing files.`);
			      }
        </script>
                 
                </div>    
            </div>
            </div>
      </div>
        <div id="myModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <div class="vid_link">
              
            </div>
          </div>
        </div>
    </section>
  <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
  </section>
   
<script>
    $('.myvid').click(function(){
        //alert($(this).data('link'));
        /*if($(this).data('vedio')!=''){
            var html = '<video width="100%" height="100%" controls>\
          <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">\
          <source src="https://www.w3schools.com/tags/movie.mp4" type="video/ogg">\
          Your browser does not support the video tag.\
        </video>';
            $('.vid_link').html(html);
        }*/
        if($(this).data('vedio')!=''){
            $.ajax({
            type: "POST",
            url: "<?= base_url('frontend/') ?>"+"check_video_block",
            data: {video_id: $(this).data('vedio')},
            dataType: "json",
            cache : false,
            success: function(data){
              if((data.msg == 'Your Request is already Submitted')) {
                var video_link = data.video_url[0]['video'];
                var html = '<div class="box-body">\
                    <div style="text-align:center">\
                      <button class="btn btn-info but_set playPause">Play/Pause</button>\
                      <button class="btn btn-info but_set makeBig">Big</button>\
                      <button class="btn btn-info but_set makeSmall">Small</button>\
                      <button class="btn btn-info but_set makeNormal">Normal</button>\
                      <br><br>\
                      <video id="video1" width="250" controls>\
                      <source src="<?php echo base_url().'uploads/videos/'?>'+video_link+'" type="video/mp4">\
                      <source src="mov_bbb.ogg" type="video/ogg">\
                          Your browser does not support HTML video.\
                      </video>\
                    </div>\
                 </div>';
                  $('.vid_link').html(html);
                  var myVideo = document.getElementById("video1"); 
                  $('.playPause').click(function(){
                    if (myVideo.paused) 
                      myVideo.play(); 
                    else 
                      myVideo.pause(); 
                  }) 
                  $('.makeBig').click(function(){ 
                    myVideo.width = 560; 
                  })
                  $('.makeSmall').click(function() { 
                    myVideo.width = 320; 
                  })
                  $('.makeNormal').click(function() { 
                    myVideo.width = 420; 
                  })
              } else {
                  var html = "<p>Vedio Found You need to do payments</p>";
                  html = html+= '<div class="box-body">\
                    <div style="text-align:center">\
                      <button class="btn btn-info but_set playPause">Play/Pause</button>\
                      <button class="btn btn-info but_set makeBig">Big</button>\
                      <button class="btn btn-info but_set makeSmall">Small</button>\
                      <button class="btn btn-info but_set makeNormal">Normal</button>\
                      <br><br>\
                      <video id="video1" width="420" controls>\
                      <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">\
                      <source src="https://www.w3schools.com/tags/movie.mp4" type="video/ogg">\
                          Your browser does not support HTML video.\
                      </video>\
                    </div>\
                 </div>';
                  $('.vid_link').html(html);
                  var myVideo = document.getElementById("video1"); 
                  $('.playPause').click(function(){
                    if (myVideo.paused) 
                      myVideo.play(); 
                    else 
                      myVideo.pause(); 
                  }) 
                  $('.makeBig').click(function(){ 
                    myVideo.width = 560; 
                  })
                  $('.makeSmall').click(function() { 
                    myVideo.width = 320; 
                  })
                  $('.makeNormal').click(function() { 
                    myVideo.width = 420; 
                  }) 
                  //$('#myModal').hide();
                  //$('.vid_link').html(html)
                  //$('#myModal').hide();
              }
            } 
          });
        } else {
            var html = "<p>Vedio Found You need to do payments</p>";
            html = html+= '<div class="box-body">\
              <div style="text-align:center">\
                <button class="btn btn-info but_set playPause">Play/Pause</button>\
                <button class="btn btn-info but_set makeBig">Big</button>\
                <button class="btn btn-info but_set makeSmall">Small</button>\
                <button class="btn btn-info but_set makeNormal">Normal</button>\
                <br><br>\
                <video id="video1" width="420" controls>\
                <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">\
                <source src="https://www.w3schools.com/tags/movie.mp4" type="video/ogg">\
                    Your browser does not support HTML video.\
                </video>\
              </div>\
           </div>';
            $('.vid_link').html(html);
            var myVideo = document.getElementById("video1"); 
            $('.playPause').click(function(){
              if (myVideo.paused) 
                myVideo.play(); 
              else 
                myVideo.pause(); 
            }) 
            $('.makeBig').click(function(){ 
              myVideo.width = 560; 
            })
            $('.makeSmall').click(function() { 
              myVideo.width = 320; 
            })
            $('.makeNormal').click(function() { 
              myVideo.width = 420; 
            }) 
            //$('#myModal').hide();
            //$('.vid_link').html(html)
        }
        $('#myModal').show();
    });
    $('.close').click(function(){
        //var html = "<p>No Vedio Found</p>";
        $('#myModal').hide();
        //$('.vid_link').html(html);
    })
    /*$('.modal').click(function(){
        var html = "<p>No Vedio Found</p>";
        $('#myModal').hide();
        $('.vid_link').html(html);
    })*/
  </script>
  <script src="<?= base_url() ?>assets/product/js/owl.carousel.js"></script>
  <?php include('footer.php'); ?>
