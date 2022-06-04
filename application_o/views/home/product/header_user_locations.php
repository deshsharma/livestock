
<div class="loc-search">
        <div class="container-fluid">
        <div class="row">
          <div class="col-6 loc">
            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
            <p><span><?= $this->webLanguage['Your Location']?></span><?php echo $data['state_name'];?></p>
          </div>
          <div class="col-6 search">
            <div class="input-group">
              
              <input value='<?php echo json_encode($data['stateList']); ?>' type='hidden' name='locationValues' id='locationValues'/>
              <input name="searchTextFieldForSearch" id="searchTextFieldForSearch" style="width: 89%;" class="form-control" placeholder="Search">
              <i class="fas fa-search"></i>
            </div>
          </div>
        </div>
      </div>
      </div>

    <div class="row pb-4 pb-md-0">
        
        <div class="col-md-4 col-12 pr-md-0">
            <?php if($this->session->userdata("users_id")){ ?>
                <div class="wallet float-left">
                    <a href="#">
                    <i class="fas fa-wallet"></i>
                    <p><span><?= $this->webLanguage['Wallet Balance']?></span> Rs <?php echo $data['wallet'] ?>/ <?= $data['real_balance']  ?></p>
                    </a>    
                </div>
             <?php } ?>

          
        </div> 
   
    </div>

<style type="text/css">
.liv-category ul li a.active {
    padding: 5px 12px;
    background-color: #eee!important;
    color: #48ade4!important;
}
</style>
<div class="main-content">
    <div class="foroverlay"></div>    
    <div class="rightmenu">
        <ul class="list-unstyled">
           
            <li><a href="https://www.livestoc.com/frontend/my_account"><?= $this->webLanguage['My Profile']?></a></li>
            <li><a href="<?= base_url('My-Farms')?>"><?= $this->webLanguage['My Farms / My Animals']?></a></li>
            <!-- <li><a href="https://www.livestoc.com/harpahu_merge/frontend/wishlist">My Wishlist</a></li> -->
            <li><a href="https://www.livestoc.com/frontend/my_order"><?= $this->webLanguage['Purchase History']?></a></li>
            <!-- <li><a href="#">Choose Language</a></li> -->
           <!--  <li><a href="https://www.livestoc.com/harpahu_merge_dev/frontend/my_order">My Address</a></li> -->
            <!-- <li><a href="https://www.livestoc.com/harpahu_merge/vetreg/homepage">Add Veterinarian</a></li> -->
            <li><a href="https://www.livestoc.com/frontend/register"><?= $this->webLanguage['Advertise With Us']?></a></li>
            <li><a href="https://www.livestoc.com/vendor/product_vendor"><?= $this->webLanguage['Sell Semen at Livestoc']?></a></li>
            <li><a href="<?= base_url() ?>frontend/product_listing"><?= $this->webLanguage['Sell your Products']?></a></li>   
            <li><a href="https://www.livestoc.com/vetreg/product_otp"><?= $this->webLanguage['Register as Veterinarian']?></a></li>
            <!-- <li><a href="https://www.livestoc.com/harpahu_merge/vetreg/homepage">Register as AI Worker</a></li> -->
            <!-- <li><a href="#">Notifications</a></li> -->
            <!-- <li><a href="#">Change Passcode</a></li> -->
            <li><a href="<?= base_url('contact-us')?>"><?= $this->webLanguage['Help /Contact Us']?></a></li>
            <li><a href="<?= base_url()?>about-us"><?= $this->webLanguage['About Us']?></a></li>
            <li>
            <?php if(!$this->session->userdata("users_id")){
                echo '<a href="'.base_url().'frontend/login">
                '.$this->webLanguage['login'].'
                </a>';
             }else{
              echo '<a href="'.base_url().'frontend/logout" >Logout</a>';
            } ?>
           
        </ul>
    </div>





    
    
    <section class="aminal-tabs">
        
            <div class="container-fluid">
                 <div class="row">
                      <div class="col-12 pl-2 pr-2">
                        <p class="selectcat"><?= $this->webLanguage['Select Category']?></p>

                                <div class="aminal-tabs-scrl">      
                                          <ul class="list-inline" id="pills-tab" role="tablist">
                                          <li class="list-inline-item">
                                          <a class="selected" <?php if($_REQUEST['category_id'] == ''){ echo 'active'; } ?>" href="<?= base_url('homenew/index'); ?>" role="tab" aria-controls="pills-home-tab" aria-selected="true"><?= $this->webLanguage['All']?></a>
                                          </li>
                                          <?php 

                                          if($_SESSION['language'] != '' && $_SESSION['language'] != 'en'){
                                          $new_data = $this->api_model->get_data('code = "'.$_SESSION['language'].'"', 'language');
                                          $name = $new_data[0]['sign_name'];
                                          $section = $this->api_model->get_section('', $name);
                                          $name = 'name_'.$name;
                                          }else{
                                          $name = 'name';
                                          $section = $this->api_model->get_section('', '');
                                          }

                                          //print_r($section);    
                                          foreach($section as $sec){
                                          //echo $sec['id'];
                                          ?>
                                          <li class="list-inline-item">
                                            <a class="nav-link <?php if($_REQUEST['category_id'] == $sec['id']){ echo 'active'; } ?>" id="pills-profile-tab"  onclick="getFullValuesForSearch(<?= $sec['id'];?>)"><?= $sec[$name] ?></a>
                                          </li>
                                          <?php
                                          }
                                          ?>
                                          </ul>
                                </div>
                      </div>
                </div>
     </div> 
    </section>


    