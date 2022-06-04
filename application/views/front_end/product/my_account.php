    <section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">
          <div class="col-12 px-4 px-lg-0">
            <div class="pb-5">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12 p-md-5 bg-white rounded shadow-sm mb-5 p-4">
                    <div class="orderouterbox">            
                      <div class="row">
                        <div class="col-md-12 orderhead text-left">
                            <h3 class="pb-0 pt-3"><?= $this->webLanguage['My Account']?></h3>  
                        </div>
                      </div>    
                      <div class="row mt-5 mb-5 orderinfo">
                          <div class="col-12 col-md-9 ">
                              <div class="row">
                                      <?php $user_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'users', '', '*'); 
                                      //print_r($user_data);
                                      $address = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"', 'address_mst', 'address_id DESC');
                                      //print_r($address);
                                      ?>
                                    <div class="col-12 col-md-4">
                                        <h5><?= $user_data[0]['full_name'] ?></h5>
                                        <!-- <p><strong>Father's name :</strong> <?= $user_data[0]['fathers_name'] ?></p> -->
                                        <p><strong><?= $this->webLanguage['Email Address']?> :</strong> <?= $user_data[0]['email'] ?></p>
                                        <p class="primaryBlue"><strong><?= $this->webLanguage['Mobile Number']?> :</strong> <?= $user_data[0]['mobile'] ?></p>
                                        <!-- <p><strong>Aadhar Number :</strong> <?= $user_data[0]['aadhaar_no'] ?></p> -->
                                    </div>
                                    <?php foreach($address as $add){ ?>
                                        <div class="col-12 col-md-4">
                                            <h5><?= $add['address_type'] ?> <?= $this->webLanguage['Address']?></h5>
                                            <p><strong><?= $this->webLanguage['Addrees line']?> :</strong> <?= $add['address1'] ?></p>
                                            <p><strong><?= $this->webLanguage['Mobile No']?> :</strong> <?= $add['mobile_code'].$add['mobile'] ?></p>
                                            <p><strong><?= $this->webLanguage['State']?> : </strong> <?php $state = $this->api_model->get_state('', $add['zone_id']); echo $state[0]['name']; ?></p>
                                            <p><strong><?= $this->webLanguage['Disctrict']?> :</strong> <?= $add['district'] ?></p>
                                            <p><strong><?= $this->webLanguage['Pin Code']?> :</strong> <?= $add['postal_code'] ?></p>
                                            <?php if($user_data[0]['address_id'] != $add['address_id']){ ?>
                                              <div class="row">
                                                  <div class="col-6"><span onclick="change_default(<?= $add['address_id'] ?>)" class="btn btn-dark rounded-pill check btn-block"><?= $this->webLanguage['Default']?></span></div>
                                                  <div class="col-6"><a href="<?= base_url('frontend/resetaddress').'/'.$add['address_id'] ?>" class="btn btn-dark rounded-pill check btn-block"><?= $this->webLanguage['Edit']?></a></div>
                                              </div>
                                            <?php }else{ ?>
                                            <div class="row">
                                              <div class="col-6"><span class="btn btn-dark rounded-pill check btn-block" style="background-color: #676c6e;"><?= $this->webLanguage['Default']?></span></div>
                                              <div class="col-6"><a href="<?= base_url('frontend/resetaddress').'/'.$add['address_id'] ?>" class="btn btn-dark rounded-pill check btn-block"><?= $this->webLanguage['Edit']?></a></div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                              </div>
                            </div>
                            <div class="col-12 col-md-3 ml-auto mt-4 mt-md-0">
                                <a href="<?= base_url('frontend/resetprofile') ?>" class="btn btn-dark rounded-pill check btn-block"><?= $this->webLanguage['Edit Profile']?></a>
                              <!--  <a href="<?= base_url('frontend/resetpass') ?>" class="btn btn-dark rounded-pill check btn-block mt-4">Reset password</a> -->
                                <a href="<?= base_url('frontend/resetaddress') ?>" class="btn btn-dark rounded-pill check btn-block mt-4"><?= $this->webLanguage['Add Address']?></a>
                            </div>
                        </div>   
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
    		</div>
			</div>
<?php include('footer_product.php'); ?>
<script>
  function change_default(id){
    $.ajax({
		  url: "<?= IMAGE_PATH.OLD_API_PATH ?>login/update_DefaultAddress?address_id="+id+"&users_id=<?= $this->session->userdata("users_id") ?>",
		  cache: false,
		  success: function(html){
        if(html.success == true){
          location.reload();
        }
      }
        //location.reload();
      });
  }
</script>