<style type="text/css">
    area:focus{
  border: none;
  outline-style: none; 
  -moz-outline-style:none;  
}
<?php //print_r($_REQUEST)?>
</style>
<section>
        <div class="share-reg mtcust">
            <div class="container-fluid">
                <div class="row mt-5">
                    <input type="hidden" name="cat_id" value="$_REQUEST['category_id']"> 
                    <div class="col-md-5 pr-md-0">
                        <a href="<?= base_url()?>homenew/buyer_seller_point/">
                        <img  usemap="#workmap" class="img-fluid" src="<?= base_url() ?>assets/home/images/share-happiness.png">
                        </a>
                    </div>
                        <map name="workmap">
                            <area shape="rect" coords="524,162,709,214" alt="SellAnimal" href="<?= base_url()?>homenew/buyer_seller_point/"> 
                            <area shape="rect" coords="19,20,235,295" alt="BuyAnimal" href="<?= base_url()?>homenew/buyer_seller_point/2">
                        </map>
                    
                    <div class="col-md-6 offset-md-1 pl-md-0 mt-4 mt-md-0">
                        <div class="row">
                            <?php if($_REQUEST['category_id'] != '2' && $_REQUEST['category_id'] != '3' && $_REQUEST['category_id'] != '4' && $_REQUEST['category_id'] != '5' && $_REQUEST['category_id'] != '6' && $_REQUEST['category_id'] != '7' ){?>
                            <div class="col-12">
                                
                                <div class="dealer neon-blue">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="dealer-style"> 
                                             <a href="<?php base_url()?>homenew/champion_bull_list" class="forlink"><p class="mb-0"><?= $this->webLanguage['Top Champion Bull Listing']?> <span><strong></strong> </span></p></a>  
                                            </div>   
                                        </div>
                                        <div class="col-md-6 pl-md-5 pl-4 mt-2 mt-md-0">
                                           <a href="<?php base_url()?>homenew/add_champion_bull_list" class="forlink"> <p class="mt-2"><strong><?= $this->webLanguage['Register For Free Now']?></strong> <strong class="blue"></strong> <i class="fas fa-chevron-right float-right pr-3"></i></p></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <?php }?>
                            
                            <div class="col-12 mt-4">
                                <div class="dealer neon-green">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="dealer-style">
                                                
                                                <?php  $cat_name = $this->api_model->get_section_name($category); ?>
                                            <?php if($_REQUEST['category_id'] !='1' ){?>
                                            <a href="<?= base_url()?>homenew/dealer_list" class="forlink"><p class="mb-0"><?= $this->webLanguage['Top']?> <?php print_r($cat_name[0]['name']);?> <span><strong><?= $this->webLanguage['Dealers  of India']?></strong></span></p></a>
                                            
                                            <?php }else{?><a href="<?php base_url()?>homenew/dealer_list" class="forlink"><p class="mb-0"><a href="<? base_url('homenew/dealer_list'); ?>" class="forlink"><?= $this->webLanguage['Top Cow / Buffalo Dealers  of India']?> <span><strong></strong></span></p></a><?php }?></a>
                                            </div>   
                                        </div>
                                        <div class="col-md-6 pl-md-5 pl-4 mt-2 mt-md-0">
                                            <a href="<?= base_url() ?>homenew/add_dealer_registration" class="forlink"><p class="mt-2"><strong><?= $this->webLanguage['Register For Free Now']?></strong> <strong class="blue"></strong> <i class="fas fa-chevron-right float-right pr-3"></i></p></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                
                                <div class="dealer neon-blue">
                                    <div class="row">
                                        <div class="col-md-6">
                                             <div class="dealer-style">
                                                <?php  $cat_name = $this->api_model->get_section_name($category);  ?>
                                            <?php if($_REQUEST['category_id'] =='1' ){?>                                                
                                            <a href="<?php base_url()?>homenew/breeder_list" class="forlink"><p class="mb-0"> <span><?= $this->webLanguage['Top Cattle Breeders  of India']?><strong></strong> </span></p></a>
                                            <?php }else{?><a href="<?php base_url()?>homenew/breeder_list" class="forlink"><p class="mb-0"><?= $this->webLanguage['Top']?> <?php print_r($cat_name[0]['name']);?> <span><strong><?= $this->webLanguage['Breeders of India']?></strong></span></p></a> <?php }?>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 pl-md-5 pl-4 mt-2 mt-md-0">
                                            <a href="<?php base_url()?>homenew/breeder_list" class="forlink"><p class="mt-2"><strong><?= $this->webLanguage['Register For Free Now']?></strong><strong class="blue"></strong> <i class="fas fa-chevron-right float-right pr-3"></i></p></a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
        