<?php if($_REQUEST['category_id'] !='5'){?>
    <section>
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="section-left neon-blue h-100">
                        <div class="row">
                            <div class="col-12">
                                <p class="tele"><img src="<?= base_url() ?>assets/home/images/call.png" alt="call"><?= $this->webLanguage['For Telephonic Consultation']?></p>
                        <ul class="list-inline">
                            <?php if( $_REQUEST['category_id'] != '4' && $_REQUEST['category_id'] != '6' && $_REQUEST['category_id'] != '7'){?>
                            <li><a onclick="premium('expert_in_medicine','89')" style="margin-top: 24px;"><?= $this->webLanguage['Expert In Vet Medicine']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                            <li class="mt-4"><a onclick="premium('animal_nutrition',4)"><?= $this->webLanguage['Animal Nutrition']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                             <li class="mt-4"><a onclick="premium('vet_surgeon','96')"><?= $this->webLanguage['Vet Surgeon']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                            <?php if($_REQUEST['category_id'] !='2' && $_REQUEST['category_id'] != '3'){//print_r($_REQUEST['category_id']);?>
                            <li class="mt-4"><a onclick="premium('farm_automation','85')"><?= $this->webLanguage['Farm Management / LPM']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                            <li class="mt-4"><a onclick="premium('repeat_breading','83')"><?= $this->webLanguage['Gynaecology Repeat Breeding']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                            <?php }}else {?><li><a onclick="premium('animal_nutrition','85')" ><?= $this->webLanguage['Nutrition']?> <i class="fas fa-chevron-right float-right pad"></i></a></li> <?php }?>
                        </ul>
                            </div>
                        </div>
                        <div class="premium"><img class="img-fluid" src="<?= base_url() ?>assets/home/images/premium-listing.png" alt="premium"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section-left primary-grey h-100 mt-5 mt-md-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="row myrequest">
                                    <div class="col-md-7"><p class="mt-2"><?= $this->webLanguage['Request Veterinary Doctor For Home Visit']?><strong> </strong></p></div>
                                    <div class="col-md-4 offset-md-1 mt-3 text-center mb-4 mb-md-0"><a onclick="MyRequest()"><?= $this->webLanguage['My Requests']?></a></div>
                                </div>    
                        <ul class="list-inline mt5">
                            <?php if( $_REQUEST['category_id'] != '4' && $_REQUEST['category_id'] != '6' && $_REQUEST['category_id'] != '7' ){?>
                         <li><a onclick ="HomeVisit('expert_in_medicine','89')" style="margin-top: 19px;"><?= $this->webLanguage['Expert In Vet Medicine']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                         <li class="mt-4"><a class="neon-blue" onclick ="HomeVisit('vet_surgeon','96')"> <?= $this->webLanguage['Vet Surgeon']?><i class="fas fa-chevron-right float-right pad"></i></a></li>
                         <li class="mt-4"><a onclick="HomeVisit('animal_nutrition',4)"> <?= $this->webLanguage['Animal Nutrition']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                            
                            <?php if( $_REQUEST['category_id'] !='2' && $_REQUEST['category_id'] != '3') {//print_r($_REQUEST['category_id']); {?>
                           
                            <li class="mt-4"><a class="neon-blue" onclick="HomeVisit('repeat_breading','83')"> <?= $this->webLanguage['Gynaecology Repeat Breeding']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                            
                            <li class="mt-4"><a onclick="HomeVisit('farm_automation','85')"><?= $this->webLanguage['Farm Management / LPM']?> <i class="fas fa-chevron-right float-right pad"></i></a></li>
                        <?php }} else {?> <li><a onclick="HomeVisit('animal_nutrition','85')" ><?= $this->webLanguage['Nutrition']?> <i class="fas fa-chevron-right float-right pad"></i></a></li> <?php }?>
                        </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <?php }?>
   <section>
    <div class="container-fluid mt-5">
         <?php if($_REQUEST['category_id'] !='2' && $_REQUEST['category_id'] != '3' && $_REQUEST['category_id'] != '4' && $_REQUEST['category_id'] !='5' && $_REQUEST['category_id'] != '6' && $_REQUEST['category_id'] != '7'){?>
        <!-- <div class="row">
            <div class="col-md-9">
                <div class="livestoclab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="livestoclabbg p-4">
                                <img src="<?= base_url() ?>assets/home/images/liv-lab.png" alt="Veterinarians Near Me">
                                <p><?= $this->webLanguage['Cattle Pregnancy Test in 28 days with American Technology']?></p> -->
                                <!-- <p>Cattle Pregnancy <br>
                                    Test in 28 days with <br>
                                    American Technology</p> -->
                            <!-- </div>    
                        </div>
                        <div class="col-md-6 pr-3 pl-5">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check"></i> <?= $this->webLanguage['Own a Sample Collection Center in your Area']?> </li>
                                <li><i class="fas fa-check"></i> <?= $this->webLanguage['Golden Opportunity']?></li>
                                <li><i class="fas fa-check"></i> <?= $this->webLanguage['Invest']?> <i class="fas fa-rupee-sign"></i> <?php echo LAB_PRICE;?>/ -</li>
                                <li><i class="fas fa-check"></i> <?= $this->webLanguage['Earn in Lacs']?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <a onclick="apply()" class="applynow"><?= $this->webLanguage['Apply Now']?></a>
            </div>   
            <div class="col-md-3 ">
                <div class="topservices">
                    <div class="bbg"><?= $this->webLanguage['We Provide more than 20 Services']?> <span></span></div>
                    <a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN" class="applynow w60"><?= $this->webLanguage['View All']?></a>
                </div>
            </div>
        </div> -->
        <?php }?> 
             
    </div>  
    <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">   
   </section>
<script>
   app_url = "<?= base_url('/frontend'); ?>";
  function apply(){
    // if($('#users_id').val() == '0'){
    //   window.location.href = "<?= base_url() ?>frontend/login";
    // }else{
       window.location.href = "<?= base_url() ?>homenew/sample_collection";
    // }
  }
  function MyRequest(){
    //  if($('#users_id').val() == '0'){
    //   window.location.href = "<?= base_url() ?>frontend/login";
    // }else{
       window.location.href = "<?= base_url() ?>homenew/my_request";
    // }
  }
  function premium(type,id){
    // if($('#users_id').val() == '0'){
    //   window.location.href = "<?= base_url() ?>frontend/login";
    // }else{
       window.location.href = "<?= base_url('homenew/veterinarians_list') ?>?type="+type+"&id="+id+"";
    // }
  }
  function HomeVisit(type,id){
    // if($('#users_id').val() == '0'){
    //   window.location.href = "<?= base_url() ?>frontend/login";
    // }else{
       window.location.href = "<?= base_url('homenew/veterinarians_doctor') ?>?type="+type+"&id="+id+"";
    // }
  }
</script>
   