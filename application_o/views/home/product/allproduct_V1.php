
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
					<div class="dropdown forfilters mb-4 show">
						
						<?= $category ?>
              </div>
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
              
            <div class="row pl-3 pl-sm-5 pl-md-5 pr-3 pr-sm-5 pr-md-5">
                
          </div>
        </div>   		
    	</div>
            <div class="tab-content mt-5" id="pills-tabContent">
                
            <!-- tab 1 -->    
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">  
				<?php 
				foreach($data as $da){
					$image = explode(',',$da['images']);
					$price = $this->api_model->get_data('product_id = "'.$da['id'].'"' , 'product_pack_rate', '', 'id, pack_id, sale_price, vt_sale_price, mrp');
					?>	
						<div class="col-md-6 col-lg-3 ftco-animate">
							<div class="product">
								<a href="<?= base_url('frontend/product_view/').$da['id'] ?>" class="img-prod"><img class="img-fluid" src="<?= base_url('uploads/product/')?><?= $image[0] ?>" alt="Livestoc" style="height: 182px; width: 100%;">
									
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
												<a onclick="like(<?= $da['id'] ?>)"class="heart d-flex justify-content-center align-items-center ">
													<span><i class="ion-ios-heart"></i></span>
												</a>
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
											<!-- <a href="#" class="heart d-flex justify-content-center align-items-center ">
												<span><i class="ion-ios-heart"></i></span>
											</a> -->

										</div>
									</div>
								</div>
							</div>
						</div>
				<?php } ?>
                  <!-- <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div> -->
                <!-- <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>  -->
                <!-- <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>  -->
                <!-- <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>  -->
                <!-- <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>  -->
                    
                <!-- <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>  -->
                    
                <!-- <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>     
                  </div>    
              </div> -->
                
            <!-- tab 2 -->    
              <!-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">  
                <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
                <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>  
            </div>  
              </div>
                
             tab3 
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row">  
                <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
                <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="<?= base_url() ?>assets/product/images/product-1.jpg" alt="Livestoc">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 text-center">
    						<h3><a href="#">Rapid Test Kit</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"><svg class="w55g" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>120.00</span><span class="price-sale"><svg class="w55" x="0px" y="0px" viewBox="0 0 500 500">
                        <use xlink:href="#rupee"></use>
                        </svg>80.00</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="fa fa-info" aria-hidden="true"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>  
                </div>
              </div>
            </div> -->
                </div>    
            </div>
            </div>
    	</div>
    </section>
	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	</section>
		<!-- <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section> -->
	<script src="<?= base_url() ?>assets/product/js/owl.carousel.js"></script>
	<?php include('footer.php'); ?>