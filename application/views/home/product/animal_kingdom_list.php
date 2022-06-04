

<section class="amnimal-listing mt-5">
<?php if(count($data['sale_animal']) > 0) { ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-6 pl-2">
            <h2 class="d-inline-block"><span>ANIMALS FOR SALE</span></h2></div>
          <div class="col-6 text-end">
            <a href="#" class="viewall viewall2"><?= $this->webLanguage['View All'] ?></a>
           
          </div>
        </div>
        
                        <div class="col-12">
                                <div id="owl-carousel2" class="owl-carousel owl-theme">
                                    <?php  
                                    foreach ($data['sale_animal'] as $key => $value) { ?>
                                           <div class="animal-card animal-card-small">
                                                <!-- <a href="<?= base_url('app/single_animal/').$value['animal_id'] ?>"> -->
                                                    <a href="<?= base_url('homenew/animal_details/').$value['animal_id'] ?>">
                                                   
                                                    <div class="card">
                                                        <img src="<?php echo $value['animals_images'][0]['images']; ?>" alt="animal health care at home livestoc">
                                                        </div> 
                                                        <p class="playvid"><a href="#"><i class="fas fa-play"></i></a></p>
                                                         <h6 class="card-text text-center"><?php //echo $value['breed']; ?></h6>
                                                        <p class="specialtag"><i class="fas fa-rupee-sign me-1"></i> <?php echo $value['price']; ?></p>

                                                        <div class="row px-3 mt-38">
					  <div class="col-8">
						<p class="state">Haryana</p>
						<h4><?php echo $value['breed']; ?></h4>
					  </div>
					  <div class="col-4 text-end">
						<p class="rating"> <i class="fas fa-star"></i> 4.5 star</p>
						<p class="fav favselected"><i class="far fa-heart"></i><i class="fas fa-heart"></i></p>
					  </div>
					</div>
            <hr>

            <div class="row px-3 animaldetails">
					  <div class="col-12">
						<p>Breed <span>Breed name</span></p>
					  </div>
					  <div class="col-12">
						<p>Age <span>12 years</span></p>
					  </div>
					  
					</div>
					<hr>
                    <div class="row px-3 animaldetails">
					  <div class="col-12">
						<p>Yield <span>2 kilogram</span></p>
					  </div>
					  <div class="col-12">
						<p>Lactation <span class="single">2</span></p>
						<p>Pregnant <span class="single">Yes</span></p>
					  </div>
					  <div class="col-12">
						<p>Calf at Foot <span>Yes</span></p>
					  </div>
					  <div class="col-12">
						<a href="#" class="viewmore mt-2">View more</a>
					  </div>
					</div>
                                                 
                                                </a>
                                                <div class="row animalactions mt-3">
                                                                    <div class="col-12">
                                                                    <a href="#" class="visit"><i class="fas fa-phone-alt me-1"></i> Contact seller</a>
                                                                    </div>
                                                            </div>
                                                
                                            </div>
                                            
                                                    
                                    <?php } ?>
                                </div>    
                        </div>
                  </div>
            
                <!-- <div class="sell-animal text-center" style="width: auto!important;">
                    <a style="font-size: 12px" href="https://www.livestoc.com/app/buy-animal.php" type="button" class="btn btn-primary text-uppercase"><img class="img-fluid mr-3" src="<?= base_url() ?>assets/home/images/rs.png" alt="Sell Your Animals"><?= $this->webLanguage['Sell Your Animals']?></a>
                </div> -->

            <?php } else { ?>
                <div class="sell-animal text-center" style="width: auto!important;">
                    <a  style="font-size: 12px" href="https://www.livestoc.com/app/buy-animal.php" type="button" class="btn btn-primary text-uppercase"><img class="img-fluid mr-3" src="<?= base_url() ?>assets/home/images/rs.png" alt="Sell Your Animals"><?= $this->webLanguage['Sell Your Animals']?></a>
                </div>
            <?php } ?>
        </div>
    </section>