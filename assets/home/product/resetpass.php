<link rel="stylesheet" href="<?= base_url('assets/product/') ?>css/main3.css">
 <section class="ftco-section ftco-cart bg_gradient">
      <div class="container">
        <div class="row">  
        <div class="col-12 col-md-6 offset-md-3 mb-5 mt-5 mt-sm-0 mt-md-0">
        <form method="POST" class="login100-form validate-form bg-white p-4 p-md-5 rounded minh-login">
          <span class="login100-form-title p-b-26 text-left">
            Reset Passcode
          </span>
          <div class="row mt-4">        
          <div class="col-12 col-md-12">    
          <form class="contact3-form validate-form" method="POST">
            <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <div class="col-lg-10 corm_nmset">
                              <div class="callout callout-danger">
                                <?= $error ?>
                              </div>
                            </div>
            <?php } ?>
              <input type="hidden" name="id" value="<?= $id ?>">

                <p class="f14 mT20passcode">Enter New passcode<br /></p>
                <?php echo form_error('password'); ?>
                <div class="divOuter2">
                  <div id="divInner">
                    <input id="partitioned" name="password" type="number" maxlength="4" minlength="4" />
                  </div>
                </div>
                    <p class="f14 mT20passcode2">Confirm New passcode<br /></p>
                    <?php echo form_error('cpassword'); ?>
                <div class="divOuter2">
                  <div id="divInner">
                    <input id="partitioned" name="cpassword" type="number" maxlength="4" minlength="4" />
                  </div>
                </div>
                    
                <p class="f14 mt60"></p>
          </form>
              <div class="row">        
          <div class="col-12 col-md-6">    
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="submit">
                Confirm
              </button>
            </div>
          </div>      
              </div>   
            </div>
               <div class="row mt-4">    
          <div class="col-12 col-md-6">
          <div class="text-left mt-1">
            <a class="txt2 d-block pl-3" href="<?= base_url('frontend/login') ?>">
              Go Back to Login
            </a>
          </div>
          </div>    
            </div>
          </div>    
          </div>     
          
             
        </form>
      </div>
                            
               
      </div>
     </div>
  </section>



   <?php include('footer.php'); ?>