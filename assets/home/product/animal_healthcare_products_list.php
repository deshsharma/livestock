
<?php
if($this->session->userdata('users_id')){
  $userId = $this->session->userdata('users_id');
  $userType = $this->session->userdata('user_type');
}else{
  $userId = 0;
  $userType = 0;
}
?>


<section class="amnimal-listing liv-animal-healthcare mt-5">
  
<div class="bg-top"></div>
        <div class="container-fluid">
        <div class="row pt-5">
          <div class="col-6 pl-2">
          <h2 class="d-inline-block"><span><?= $this->webLanguage['HEALTHCARE PRODUCTS']?></span></h2>
          </div>
          <div class="col-6 text-end">
            <a href="#" class="viewall">View all</a>
          </div>
        </div>
          <?php if(!empty($data['ecomm_product'][0]['section'])) {?>
        <div class="row">
        <div class="col-12">
        <div class="owl-carousel owl-carousel-products mt-4">
                 <?php  
                  foreach ($data['ecomm_product'] as $key => $value) { 
                    $image = explode(',',$value['images']);
                    $price = $this->api_model->get_data('product_id = "'.$value['id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
                    ?>
                
                      <div class="card" >
                        <div class="card-body forintrested">
                            <div class="prod-card">
                              <div class="imgdiv">
                                <a href="<?= base_url('frontend/product_view/') ?><?= $value['id'] ?>"><img class="card-img-top" src="<?php echo $value['images']; ?>"  alt="<?php echo $value['product_alt_tag']; ?>"></a>
                                <p class="qty">47.3 Liter</p>
                                <p class="qty"><i class="fas fa-rupee-sign" aria-hidden="true"></i><?php $package = $this->api_model->get_data('id = "'.$price[0]['pack_id'].'"' , 'product_package', '', '*'); echo $package[0]['name']; ?></p>  
                              </div>
                              <div class="row">
                                <div class="col-md-12 col-12">    
                                  <h5 class="card-title mt-2 mb-1" style=" margin-left: 4px;"><?php echo $value['name']; ?></h5>
                                  <p class="card-text" style=" margin-left: 4px;"><?php echo $value['brand']; ?></p>
                                </div>
                                <?php if($value['vedio'] != ''){ ?>
                                <div class="col-md-4 video text-center pl-0 mt-3 pt-2 mb-2">
                                  <a onclick="showAlertMessage(<?= $value['vedio'] ?>)" class="myvid" data-link="<?= base_url('uploads/product/')?><?= $value['vedio'] ?>" data-vedio="<?= $value['vedio'] ?>"> 
                                  <i class="fa fa-play mb-2" aria-hidden="true"></i><br>    
                                  <span>Watch</span>
                                  </a>    
                                </div>
                                <?php } ?>
                              </div>
                            </div>
                            
                               <a style="color:#fff!important;"  onclick="cart(<?= $value['id'] ?>, <?= $price[0]['pack_id'] ?>, <?= $price[0]['id'] ?>,<?= $userId ?>, <?= $userType ?>)" class="btn btn-primary"><span class="float-left w-50"><?= $this->webLanguage['Add to Cart']?></span> <span class="float-right w-50"><i class="fas fa-rupee-sign"></i> <?php echo $value['sale_price']; ?></span></a>
                              <?php if($this->session->userdata("users_id")){ ?>
                                <div class="btn-group dropup">
                                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownMenuButton">
                                  <?= $this->webLanguage['I am Interested']?>
                                    <i class="fa fa-ellipsis-v float-right mt-1" aria-hidden="true"></i>  
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" onclick="intrested_to_buy(<?= $value['id'] ?>)"><?= $this->webLanguage['Interested In buying the product. Please contact us.']?></a>
                                  </div>
                              </div>

                              <?php }else{ ?>
   

<div class="btn-group dropup">
<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?= $this->webLanguage['I am Interested']?> <i class="fa fa-ellipsis-v float-end mt-1" aria-hidden="true"></i>  
</button>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="<?= base_url('frontend/interest/'.$value['id']) ?>"><?= $this->webLanguage['Interested In buying the product. Please contact us.']?></a>
</li>
</ul>
</div>

                              <?php } ?>
              
                              <div class="forratenew pl-3 pr-3">
                                  <p class="mb-0 text-left ratingnew float-left"><i class="fa fa-star"></i>
                                    <?php  $avg = $this->api_model->get_data('product_id = '.$value['id'].'' , 'products_reviews', '', 'AVG(rating) as rating'); echo number_format($avg[0]['rating'], 1); ?> 
                                    <span> <?= $this->webLanguage['Reviews']?> : <?php $count = $this->api_model->get_data('product_id = '.$value['id'].'' , 'products_reviews', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?></span></p>
                              </div>
                          
                        </div>
                      </div>
                 
                  <?php } ?>
              </div>    
            </div>
        </div> <?php } ?>
                 
    </div>
</section>
    