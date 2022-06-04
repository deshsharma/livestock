
<?php
if($this->session->userdata('users_id')){
  $userId = $this->session->userdata('users_id');
  $userType = $this->session->userdata('user_type');
}else{
  $userId = 0;
  $userType = 0;
}
?>
<section>
    <div class="liv-animal-healthcare mt-5">
        <div class="container-fluid p0">
          <?php if(!empty($data['ecomm_product'][0]['section'])) {?>
            <div class="row">
                <div class="col-12 mb-3">
                    <h3 class="text-uppercase"><span>ANIMALS HEALTHCARE PRODUCTS</span></h3>
                </div>
            <div class="col-12">
              <div id="owl-carousel3" class="owl-carousel owl-theme">
                 <?php  
                  foreach ($data['ecomm_product'] as $key => $value) { 
                    $image = explode(',',$value['images']);
                    $price = $this->api_model->get_data('product_id = "'.$value['id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
                    ?>
                  <div class="item">
                      <div class="card w-100" >
                        <div class="card-body forintrested">
                            <div class="prod-card">
                              <div class="imgdiv">
                                <a href="<?= base_url('frontend/product_view/') ?><?= $value['id'] ?>"><img class="card-img-top" src="<?php echo $value['images']; ?>"  alt="<?php echo $value['product_alt_tag']; ?>"></a>
                                <p class="qty"><?php $package = $this->api_model->get_data('id = "'.$price[0]['pack_id'].'"' , 'product_package', '', '*'); echo $package[0]['name']; ?></p>  
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
                               <a   onclick="cart(<?= $value['id'] ?>, <?= $price[0]['pack_id'] ?>, <?= $price[0]['id'] ?>,<?= $userId ?>, <?= $userType ?>)" class="btn btn-primary"><span class="float-left w-50 bdrr"><?= $this->webLanguage['Add to Cart']?></span> <span class="float-right w-50"><i class="fas fa-rupee-sign"></i> <?php echo $value['sale_price']; ?></span></a>
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
                                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <?= $this->webLanguage['I am Interested']?>
                                    <i class="fa fa-ellipsis-v float-right mt-1" aria-hidden="true"></i>  
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="<?= base_url('frontend/interest/'.$value['id']) ?>"><?= $this->webLanguage['Interested In buying the product. Please contact us.']?></a>
                                  </div>
                              </div>

                              <?php } ?>
              
                              <div class="forratenew pl-3 pr-3">
                                  <p class="mb-0 text-left ratingnew float-left"><i class="fa fa-star"></i>
                                    <?php  $avg = $this->api_model->get_data('product_id = '.$value['id'].'' , 'products_reviews', '', 'AVG(rating) as rating'); echo number_format($avg[0]['rating'], 1); ?> 
                                    <span> <?= $this->webLanguage['Reviews']?> : <?php $count = $this->api_model->get_data('product_id = '.$value['id'].'' , 'products_reviews', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?></span></p>
                              </div>
                          
                        </div>
                      </div>
                  </div>
                  <?php } ?>
              </div>    
            </div>
        </div> <?php } ?>
        </div>          
    </div>
</section>
    