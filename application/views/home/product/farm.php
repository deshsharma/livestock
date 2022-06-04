<style>
.shopping-cart .block-heading{
    padding-top: 0px;
    margin-bottom: 40px;
    text-align: center;
}
.shopping-cart .block-heading1{
    padding-top: 40px;
    margin-bottom: 40px;
    text-align: center;
}
</style>
<?php 
 $user_details = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'"', 'from_profile as fp', '', 'id,users_id,doc_id,vt_id,form_name');
 //print_r($user_details);
 ?>
<section>
    <div class="liv-all-animals primary-grey champ-bull-listing">
         
        <div class="container-fluid px-0">
            <?php if($user_details){ ?>
            <div class="shopping-cart dark">
                <div class="block-heading">
                <h1>My Farm</h1>
                </div>
            </div>   
            <div class="row">
               <?php foreach($user_details as $d){?>
                  <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                     <div class="dealer_card">
                        <a href="<?= base_url().'homenew/farm_profile/'.$d['id'];?>">
                            <div class="dealer-style">
                                <p class="mb-0"><span><strong><?= $d['form_name'] ?></strong></span><i class="fas fa-chevron-right float-right pr-3 mt-2"></i></p>
                            </div>
                        </a>
                     </div>
                  </div> 
                <?php }?>
            </div> 
            <?php } else{?>
                <div class="shopping-cart dark">
                    <div class="block-heading1">
                        <h4>No Record Found.</h4>
                    </div>
                </div> 
            <?php }?>                          
        </div>
    </div>
</section>