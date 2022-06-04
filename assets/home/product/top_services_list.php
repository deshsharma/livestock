<?php if($_REQUEST['category_id'] !='2' && $_REQUEST['category_id'] != '3' && $_REQUEST['category_id'] != '4' && $_REQUEST['category_id'] !='5' && $_REQUEST['category_id'] != '6' && $_REQUEST['category_id'] != '7'){?>
    <section>
        <div class="top-services primary-grey mt-5">
            <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 mt-1">
                    <h4 class="blue"><img class="img-fluid mr-3" src="<?= base_url() ?>assets/home/images/premium-icon.png" alt="icon"><?= $this->webLanguage['Top Services']?></h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="dealer neon-green">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="dealer-style">
                                            <p class="mb-0"><?= $this->webLanguage['Artificial Insemination']?> <span><strong></strong></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 algn">
                                            <a href="#" class="forlink">
                                            <p class="mt-2"><?= $this->webLanguage['Order Now']?> <i class="fas fa-chevron-right float-right pr-3 mt-2"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="dealer neon-blue">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="dealer-style">
                                            <p class="mb-0"><?= $this->webLanguage['Order Semen in Advance']?><span><strong></strong></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 algn">
                                            <a href="#" class="forlink">
                                            <p class="mt-2"><?= $this->webLanguage['Book Now']?><i class="fas fa-chevron-right float-right pr-3 mt-2"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                </div>
                </div>
                <div class="row mt-4 mb-4">
                <div class="col-md-6">
                    <div class="dealer neon-green">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="dealer-style">
                                            <p class="mb-0"><?= $this->webLanguage['Sample Collection Center']?> <span class="d-block"><strong></strong></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 algn">
                                            <a href="#" class="forlink">
                                            <p class="mt-2"><?= $this->webLanguage['View All Near You']?> <br> <i class="fas fa-chevron-right float-right pr-3"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="dealer neon-blue">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="dealer-style">
                                            <p class="mb-0"><?= $this->webLanguage['Pregnancy Detection in 28 Days']?> <span><strong></strong></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 algn">
                                            <a href="#" class="forlink">
                                            <p class="mt-2"><?= $this->webLanguage['Submit Sample Now Only']?> <br>  @ Rs <?php echo LAB_CHARGES;?> <i class="fas fa-chevron-right float-right pr-3"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                </div>
                </div>
            </div>
        </div> 
    </section>
  <?php }?>