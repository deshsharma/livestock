<section>
        <div class="liv-animal-kingdom">
            <?php if(count($data['sale_animal']) > 0) { ?>
                <div class="container-fluid p0">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-uppercase mb-4 float-left"><span><?= $this->webLanguage['ANIMAL FOR SALE']?></span></h3>
                            <a href="<?= base_url('homenew/buy_animals')?>" class="viewall float-right">View All</a>
                        </div>
                    <div class="col-12">
                        <div id="owl-carousel2" class="owl-carousel owl-theme">
                            <?php  
                            foreach ($data['sale_animal'] as $key => $value) { ?>
                            <div class="item">
                                <a href="<?= base_url('app/single_animal/').$value['animal_id'] ?>">
                                     <!-- <a href="<?= base_url('animal_sale/').$value['animal_id'] ?>"> -->
                                    <div class="card">
                                        <div class="imgdiv">
                                        <img src="<?php echo $value['animals_images'][0]['images']; ?>" alt="animal health care at home livestoc">
                                        </div>      
                                        <div class="card-body">
                                            <h6 class="card-text text-center"><?php echo $value['breed']; ?></h6>
                                            <p class="card-text text-center"><i class="fas fa-rupee-sign"></i> <?php echo $value['price']; ?></p>
                                        </div>
                                    </div>
                                </a>      
                            </div>
                            <?php } ?>
                        </div>    
                    </div>
                </div>
                </div>
            
                <div class="sell-animal text-center" style="width: auto!important;">
                    <a style="font-size: 12px" href="<?php base_url()?>homenew/sell_animals" type="button" class="btn btn-primary text-uppercase"><img class="img-fluid mr-3" src="<?= base_url() ?>assets/home/images/rs.png" alt="Sell Your Animals"><?= $this->webLanguage['Sell Your Animals']?></a>
                </div>

            <?php } else { ?>
                <div class="sell-animal text-center" style="width: auto!important;">
                    <a  style="font-size: 12px" href="<?php base_url()?>homenew/sell_animals" type="button" class="btn btn-primary text-uppercase"><img class="img-fluid mr-3" src="<?= base_url() ?>assets/home/images/rs.png" alt="Sell Your Animals"><?= $this->webLanguage['Sell Your Animals']?></a>
                </div>
            <?php } ?>
        </div>
    </section>