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
          <span class="login100-form-title p-b-26 text-left">
            Reset Address
          </span>    
          <div class="row mt-4">        
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Address">
            <?php echo form_error('address'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <textarea class="input100" name="address"><?= $user_data[0]['address'] ?></textarea>
            <span class="focus-input100" data-placeholder="Address"></span>
          </div>
          </div> 
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Aadhar Number">
          <?php echo form_error('state'); ?>
            <?php $state = $this->api_model->get_state("99"); 
             ?>
            <select name="state" id="state" class="input100 state" required>
              <option value="">Select State</option>
              <?php 
              foreach($state as $st){ ?>
                <option <?php if($st['zone_id'] == $user_data[0]['zone_id']){ echo "selected"; } ?> value="<?= $st['zone_id'] ?>"><?= $st['name'] ?></option>
              <?php } 
              ?>
            </select>
            <span class="focus-input100" data-placeholder="State"></span>
          </div> 
          </div>
          <div class="col-12 col-md-12"> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input type="hidden" name="cityname" id="cityname" value="<?php echo $user_data[0]['city']; ?>">
            <input type="hidden" name="zonename" id="zonename" value="<?php echo $user_data[0]['zone_id']; ?>">
            <?php echo form_error('District'); ?>
            <select name="District" id="district" class="input100 city" required>
              <option value="">Select District</option>
            </select>
            <span class="focus-input100" data-placeholder="district"></span>
          </div>   
          </div>     
          </div>     
          <div class="row">        
          <div class="col-12 col-md-6">    
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="submit">
                Reset Address
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

   <?php include('footer.php'); ?>
   <script>
     var cityname = $('#cityname').val();
     var zonename = $('#zonename').val();
     jQuery(document).ready(function(){
        $.ajax({
            url: "<?= base_url() ?>api/get_city?state_id="+zonename,
            cache: false,
            success: function(resp){
              var data = resp;
              var str =data;
              var option = '<option value="">Select District</option>';
              $.each(str.data, function(index, item){
                  option += "<option value='"+item.dis_id+"'"+ (cityname === item.dis_id ? " selected='selected'" : "")+">" +item.dist_name+ "</option>"
              }); 
              $('.city').html(option);
            }
        });
     });
     $('.state').change(function(){
        $.ajax({
          url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
          cache: false,
          success: function(resp){
            var data = resp;
            var str =data;
            var option = '<option value="">Select District</option>';
            $.each(str.data, function(index, item){
                option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
            }); 
            $('.city').html(option);
          }
        });
    })
   </script>