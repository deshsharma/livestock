<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<style>
:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: .75rem;
}

body {
  background: #eee;
  /* background: linear-gradient(to right, #0062E6, #33AEFF); */
}

.card-signin {
  border: 0;
  border-radius: 1rem;
  /* box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1); */
}

.card-signin .card-title {
  margin-bottom: 2rem;
  font-weight: 300;
  font-size: 1.5rem;
}

.card-signin .card-body {
  padding: 2rem;
}

.form-signin {
  width: 100%;
}

.form-signin .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  transition: all 0.2s;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group input {
  height: auto;
  /* border-radius: 2rem; */
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input::-ms-input-placeholder {
    color: #777;
  }
}

/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input:-ms-input-placeholder {
    color: #777;
  }
}

</style>
<?php 
//print_r($animal_id);
  $add_id = $this->api_model->get_data('users_id = '.$this->session->userdata('users_id').'', 'users','','users_id,full_name,mobile,address_id');
  $address = $this->api_model->get_data('address_id = '.$add_id[0]['address_id'].'', 'address_mst','','address1,postal_code,latitude,longitude');
  // print_r($address[0]['address1']);
  // print_r($address[0]['postal_code']);
  // print_r($add_id);
?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">          
            <h5 class="card-title text-center" >Sell Animal</h5>
            <form class="form-signin" action="<?= base_url('homenew/my_animal_sell_price')?>" method="post">
                <input type="hidden" name="users_id" value="<?= $add_id[0]['users_id'] ?>">
                <input type="hidden" name="animal_id" value="<?= $animal_id ?>" >
                <input type="hidden" name="animal_purpose" value="1" >
                <input type="hidden" name="state" value="">
                <input type="hidden" name="latitude" value="<?= $address[0]['latitude']?>" >
                <input type="hidden" name="longitude" value="<?= $address[0]['longitude']?>">
		        	<p class="foryld mb-2"><strong>Price</strong></p>
              <div class="form-label-group">
                <input type="text" name="price" class="form-control" placeholder="Price" required >
              </div>
              <div class="form-label-group">
              <div class="col-md-12 selectbreed">
                <p class="foryld mb-2"><strong> Price Type</strong></p>
                <ul class="list-inline">
                  <li class="list-inline-item text-center">
                    <label class="champ-reg-lbl">
                      <input type="radio" name="price_type" value="0" checked="">
                      <p>Fixed</p>
                    </label>
                  </li>  
                  <li class="list-inline-item text-center">
                    <label class="champ-reg-lbl">
                      <input type="radio" name="price_type" value="1">
                      <p>Negotiable</p>
                    </label>
                  </li>
                </ul>  
              </div>
            </div>
            <div class="form-label-group">
             <p class="form-control"><strong>Contact Details<span class="price" style="margin-left: 44%;"><a href="<?= base_url('frontend/my_account/') ?>">Change</a></span></strong></p>
            </div>
            <div class="form-label-group">
              <div class="summary-item"><span class="text"><?= $address[0]['address1'] ?> <?= $address[0]['postal_code'] ?></span></div>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" type="submit">SUBMIT</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
