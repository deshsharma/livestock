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
        <h3 class="pb-0 pt-3">My Account</h3>  
    </div>
  </div>    
    <div class="row mt-5 mb-5 orderinfo">
        
        <div class="col-12 col-md-4 mt-3">
          <?php $user_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'users', '', '*'); 
          ?>
            <h5><?= $user_data[0]['full_name'] ?></h5>
            <p><strong>Father's name :</strong> <?= $user_data[0]['fathers_name'] ?></p>
            <p><strong>Email Address :</strong> <?= $user_data[0]['email'] ?></p>
            <p class="primaryBlue"><strong>Mobile Number :</strong> <?= $user_data[0]['mobile'] ?></p>
            <p><strong>Aadhar Number :</strong> <?= $user_data[0]['aadhaar_no'] ?></p>
        </div>
        <div class="col-12 col-md-5 mt-3">
            <h5>Address <br><small>For Shipping and Billing</small></h5>
            <p><strong>Addrees line  :</strong> <?= $user_data[0]['address'] ?></p>
            <p><strong>State : </strong> <?php $state = $this->api_model->get_state('', $user_data[0]['zone_id']); echo $state[0]['name']; ?></p>
            <p><strong>Disctrict :</strong> <?php $city = $this->api_model->get_city_dist($user_data[0]['city']); echo $city[0]['city_name'] ?></p>
        </div>
        <div class="col-12 col-md-3 ml-auto mt-4 mt-md-0">
            <a href="<?= base_url('frontend/resetprofile') ?>" class="btn btn-dark rounded-pill check btn-block">Edit Profile</a>
            <a href="<?= base_url('frontend/resetaddress') ?>" class="btn btn-dark rounded-pill check btn-block mt-4">Change Address</a>
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
       <?php include('footer.php'); ?>