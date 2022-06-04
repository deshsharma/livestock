<section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">  
           <?php
          $user_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'users', '', '*'); 
           ?>
        <div class="col-12 col-md-6 offset-md-3 mb-5 mt-5 mt-sm-0 mt-md-0">
        <form method="post" class="login100-form validate-form bg-white p-4 p-md-5 rounded minh-login">
          <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                                <diV class="col-md-3"></div>
                                <div class="col-md-9 corm_nmset">
                                    <div class=" error" style="margin-left:0%;">
                                        <?= $error ?>
                                    </div>
                                </div>
            <?php } ?>
          <span class="l
          <span class="login100-form-title p-b-26 text-left">
            Profile Edit
          </span>    
          <div class="row mt-4">  
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Name">
            <?php echo form_error('name'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="text" name="name" value="<?= $user_data[0]['full_name'] ?>">
            <span class="focus-input100" data-placeholder="Name"></span>
          </div>
          </div>      
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Father's Name">
            <?php echo form_error('fname'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="text" name="fname" value="<?= $user_data[0]['fathers_name'] ?>">
            <span class="focus-input100" data-placeholder="Father's name"></span>
          </div>
          </div>
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Email">
            <?php echo form_error('email'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="email" name="email" value="<?= $user_data[0]['email'] ?>">
            <span class="focus-input100" data-placeholder="Email"></span>
          </div>
          </div>
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <?php echo form_error('mobile'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="number" name="mobile" disabled="disabled" value="<?= $user_data[0]['mobile'] ?>" >
            <span class="focus-input100" data-placeholder="Mobile Number"></span>
          </div>
          </div>      
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Aadhar Number">
            <?php echo form_error('adhar_no'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="number" name="adhar_no" value="<?= $user_data[0]['aadhaar_no'] ?>">
            <span class="focus-input100" data-placeholder="Aadhar Number"></span>
          </div>
          </div>
          </div>     
          <div class="row">        
          <div class="col-12 col-md-6">    
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="submit">
                Edit Profile
              </button>
            </div>
          </div>      
              </div>   
            </div>
          <div class="row mt-4">    
          <div class="col-12 col-md-6">
          <div class="text-left mt-1">
            <a class="txt2 d-block pl-3" href="<?= base_url('frontend/my_account') ?>">
              Go Back to My Account
            </a>
          </div>
          </div>    
            </div>    
        </form>
      </div>
                            
               
      </div>
     </div>
	</section>

   <?php include('footer_product.php'); ?>
   