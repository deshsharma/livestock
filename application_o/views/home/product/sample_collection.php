 <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
 <?php 
 $user_details = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'"', 'users as us', '', 'users_id,full_name,mobile,mobile_code,address,email,address_id,zone_id,(select address2 from address_mst where address_id = us.address_id) as address2,(select city from address_mst where address_id = us.address_id) as city,(select name from zone where zone_id = us.zone_id) as zone,(select district from address_mst where address_id = us.address_id) as district,(select postal_code from address_mst where address_id = us.address_id) as postal_code');
 //print_r($user_details);
 ?>
<section>
  <div class="liv-all-animals primary-grey champ-bull-listing champ-bull-reg">
    <div class="container-fluid p0">
    <label type="submit" class="btn btn-primary"><?= $this->webLanguage['Sample Collection Center Application Form']?></label></br>
      <form action="" method="POST" id="userdetail" enctype="multipart/form-data">  
        <div class="form-group">
          <label for="inputAddress"><?= $this->webLanguage['Business Name']?></label>
          <input type="text" value="" name = "business_name" class="form-control" id="inputBusiness" placeholder="Business Name">
        </div>
        <div class="form-group">
          <label for="inputAddress2"><?= $this->webLanguage['Contact Person']?> *</label>
          <input type="text" value="<?= $user_details[0]['full_name']?>" name="name" class="form-control" id="inputContact" placeholder="">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4"><?= $this->webLanguage['Code']?></label>
            <input type="text" value="<?= $user_details[0]['mobile_code']?>" name="code" class="form-control" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4"><?= $this->webLanguage['Mobile No']?> *</label>
            <input type="number" name="number" value="<?= $user_details[0]['mobile']?>" class="form-control" id="inputMobile" >
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress2"><?= $this->webLanguage['Address Line 1']?> *</label>
          <input type="text" value="<?= $user_details[0]['address']?>" name= "address" class="form-control" id="inputAddress1" >
        </div>
        <div class="form-group">
          <label for="inputAddress2"><?= $this->webLanguage['Address Line 2']?> *</label>
          <input type="text" value="<?= $user_details[0]['address2']?>" name="address2" class="form-control" id="searchTextField">
          <input type="hidden" id="city2" name="city2" />
					<input type="hidden" value="" id="cityLat" name="cityLat" />
					<input type="hidden" value="" id="cityLng" name="cityLng" />
        </div>
         <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4"><?= $this->webLanguage['City']?></label>
            <input type="text" name="city" value="<?= $user_details[0]['city']?>" class="form-control" id="inputCity">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4"><?= $this->webLanguage['District']?> *</label>
            <input type="text" value="<?= $user_details[0]['district']?>" name="district" class="form-control" id="inputDistrict">
          </div>
        </div>
         <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4"><?= $this->webLanguage['Pin Code']?> *</label>
            <input type="text" name="pin" value="<?= $user_details[0]['postal_code']?>" class="form-control" id="inputPin">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4"><?= $this->webLanguage['State']?> *</label>
            <input type="text" value="<?= $user_details[0]['zone']?>" name="state" class="form-control" id="inputState">
          </div>
        </div> 
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="terms" id="terms" value="accepted">
            <label class="form-check-label" for="gridCheck">
              <?= $this->webLanguage['By ticking this I accept the Terms as applicable']?>
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-check">      
            <label class="form-check-label" for="gridCheck">
              <?= $this->webLanguage['For inquiries please call']?> 7009058918
            </label>
          </div>
        </div>
        <button type="submit" name="submit" value='1' class="btn btn-primary"><?= $this->webLanguage['Next']?></button>
      </form>
    </div>
  </div>
</section>
<script type="text/javascript">
  document.getElementById('userdetail').addEventListener('submit', function(event){
    if(document.getElementById('terms').checked == false){
        event.preventDefault();
        alert("Please accept the terms and conditions to proceed further.");
        return false;
    }
});
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBKXAzms3AOjKJz4hjMlPdFreKAryub2U&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>