<section class="ftco-section ftco-cart bg_gradient">
			<div class="container">
				<div class="row">  
          <?php
          $user_data = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"' , 'users', '', '*'); 
          //print_r($data);
           ?>
        <div class="col-12 col-md-6 offset-md-3 mb-5 mt-5 mt-sm-0 mt-md-0">
        <form method="post" action="<?= base_url('frontend/resetaddress') ?>/<?= $data[0]['address_id'] ?>" class="login100-form validate-form bg-white p-4 p-md-5 rounded minh-login">
          <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                                <diV class="col-md-3"></div>
                                <div class="col-md-9 corm_nmset">
                                    <div class=" error" style="margin-left:0%;">
                                        <?= $error ?>
                                    </div>
                                </div>
            <?php } ?>
          <span class="login100-form-title p-b-26 text-left">
          <?php if(!empty($data)){ ?>
            <?= $this->webLanguage['Reset Address']?>
          <?php }else{ ?>
            Add Address
          <?php } ?>
          </span>    
          <div class="row mt-4">
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Contract Person">
            <?php echo form_error('contact_person'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input id="contact_person" name="contact_person" type="text" size="50" value="<?= $data[0]['fullname'] ?>" >  
            <span class="focus-input100" data-placeholder="Contact Person"></span>
          </div>
          </div> 
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Mobile No">
            <?php echo form_error('mobile'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input id="mobile" name="mobile" type="text" size="50" value="<?= $data[0]['mobile'] ?>">  
            <span class="focus-input100" data-placeholder="Mobile No"></span>
          </div>
          </div>        
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Address">
            <?php echo form_error('address'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input id="searchTextField" name="address" type="text" size="50" autocomplete="on" runat="server" value="<?= $data[0]['address1'] ?>" required/>  
					    <input type="hidden" id="city2" name="city2" />
					    <input type="hidden" value="" id="cityLat" name="cityLat" />
					    <input type="hidden" value="" id="cityLng" name="cityLng" /></p>
            <!-- <textarea class="input100" name="address"><?= $user_data[0]['address'] ?></textarea> -->
            <span class="focus-input100" data-placeholder="Address"></span>
          </div>
          </div> 
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Address">
            <?php echo form_error('address2'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input  name="address2" type="text" size="50" value="<?= $data[0]['address2'] ?>"/>  
            <!-- <textarea class="input100" name="address"><?= $user_data[0]['address'] ?></textarea> -->
            <span class="focus-input100" data-placeholder="Address2"></span>
          </div>
          </div> 
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Enter Aadhar Number">
          <?php echo form_error('state'); ?>
            <?php $state = $this->api_model->get_state("99"); 
             //print_r($state);
             ?>
            <select name="state" id="state" class="input100 state" required>
              <option value="">Select State</option>
              <?php 
              foreach($state as $st){ ?>
                <option value="<?= $st['zone_id'] ?>" <?php if($data[0]['zone_id'] == $st['zone_id']){ echo "selected"; } ?>><?= $st['name'] ?></option>
              <?php } 
              ?>
            </select>
            <!-- <input class="input100" type="text" name="state"> -->
            <span class="focus-input100" data-placeholder="State"></span>
          </div> 
          </div>
          <div class="col-12 col-md-12"> 
           <div class="wrap-input100 validate-input" data-validate="Enter Mobile Number">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <?php echo form_error('District'); ?>
            <select name="district" id="district" class="input100 city" required>
              <option value="">Select District</option>
              <?php $district = $this->api_model->get_city($data[0]['zone_id']); 
              foreach($district as $dis){
             ?>
                <option value="<?= $dis['dist_name'] ?>" <?php if($dis['dist_name'] == $data[0]['city']){ echo "selected";} ?>><?= $dis['dist_name'] ?></option>
             <?php } ?>
            </select>
            <!-- <input class="input100" type="text" name="District"> -->
            <span class="focus-input100" data-placeholder="district"></span>
          </div>   
          </div> 
           <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="City">
            <?php echo form_error('city'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input id="city" name="city" type="text" value="<?= $_REQUEST['city']; ?>" size="50" required>  
            <span class="focus-input100" data-placeholder="City"></span>
          </div>
          </div> 
          <div class="col-12 col-md-12">    
          <div class="wrap-input100 validate-input" data-validate="Pin Code">
            <?php echo form_error('pin_code'); ?>
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input id="pin_code" name="pin_code" type="text" value="<?= $data[0]['postal_code'] ?>" size="50" required>  
            <span class="focus-input100" data-placeholder="Pin Code"></span>
          </div>
          </div> 
          <div class="col-12 col-md-12">    
            <div class="wrap-input100 validate-input" data-validate="Address Type">
              <?php echo form_error('address_type'); ?>
              <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
              </span>
              <select name="address_type" id="address_type" class="input100 type" style="border: none; box-shadow: none;" required>
                <option value="">Select Address Type</option>
                <option value="Home" <?php if($data[0]['address_type'] == 'Home'){ echo "selected"; } ?>>Home</option>
                <option value="Office" <?php if($data[0]['address_type'] == 'Office'){ echo "selected"; } ?>>Office</option>
                <option value="Others" <?php if($data[0]['address_type'] == 'Others'){ echo "selected"; } ?>>Others</option>
              </select>
              <span class="focus-input100" data-placeholder="Address Type"></span>
            </div>
          </div> 
          </div>     
          <div class="row">        
          <div class="col-12 col-md-6">    
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <?php if(!empty($data)){ ?>
              <button class="login100-form-btn" name="submit">
              <?= $this->webLanguage['Reset Address']?>
              </button>
              <?php }else{ ?>
                <button class="login100-form-btn" name="submit">
                Add Address
                </button>
              <?php } ?>
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
       <script>
       	$.ajax({
		  url: "https://www.livestoc.com/harpahu_merge_dev/api/get_address_lat_data?admin_id=<?= $_SESSION['user_id'] ?>",
		  cache: false,
		  success: function(html){
		    //html = JSON.parse(html)
		    console.log(html)
		    console.log(html.data[0]['latitude']);
		    console.log(html.data[0]['longitude']);
		    console.log(html.data[0]['complete_addr']);
		    $('.lat').html(html.data[0]['latitude']);
		    $('.long').html(html.data[0]['longitude']);
		    $('.add').html(html.data[0]['complete_addr']);
		    var iframe = document.createElement("iframe");
			iframe.onload = function() {
			   var doc = iframe.contentDocument;

			   iframe.contentWindow.showNewMap = function() {
			    var mapContainer =  doc.createElement('div');
			    mapContainer.setAttribute('style',"width: 100%; height: 500px");
			    doc.body.appendChild(mapContainer);

			    var mapOptions = {
			        center: new this.google.maps.LatLng(-35.000009, -58.197645),
			        zoom: 5,
			        mapTypeId: this.google.maps.MapTypeId.ROADMAP
			    }

			    var map = new this.google.maps.Map(mapContainer,mapOptions);
			}

			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&' + 'callback=showNewMap';
			iframe.contentDocument.getElementsByTagName('head')[0].appendChild(script);
			};
			$('.map').html(iframe);
		  }
		});
       </script>
   <script>
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
