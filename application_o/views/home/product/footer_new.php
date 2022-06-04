

<section class="sell-animals">
      <div class="container-fluid">
        <div class="row px-3">
          <div class="col-md-10 offset-md-1 mt-5">
          <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/home/images/sell-animals.jpg" class="img-fluid"></a>
          </div>
        </div>
      </div>
    </section>


   <!-- <section class="features">
      <div class="container-fluid pe-5 ps-5">
        <div class="row mt-5">
          <div class="col-md-4">
            <div class="features-box">
            <img src="<?= base_url() ?>assets/home/images/talk-to-expert.png">
            <div class="features-content">
              <img src="<?= base_url() ?>assets/home/images/premium-listing.png">
              <p>For telephonic consultation</p>
              <a href="#">Talk to Expert 
              Veterinarian <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="features-box">
            <img src="<?= base_url() ?>assets/home/images/request-visit.png">
            <div class="features-content">
              <p>Need an expert at home ?</p>
              <a href="#">Request for Veterinary 
                Doctor Home Visit <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="features-box">
            <img src="<?= base_url() ?>assets/home/images/artificial-insemination.png">
            <div class="features-content">
              <p>For telephonic consultation</p>
              <a href="#">Artificial Insemination
                or Pet Vaccination <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    
  <?php //print_r($this->webLanguage); echo 'this is tests';?>

  <section class="news mt-5">
  <div class="container-fluid">
  <div class="row">
      <div class="col-12 mb-2 mt-3">    
          <h3 class="float-left"><span>Video Tutorials</span> &amp; Veterinary Courses</h3>
      </div>
  </div>    
  <div class="row mt-3 justify-content-between">
      <div class="col-md-9 vidouter ">
          <div class="newsbg">
            <iframe src="https://www.youtube.com/embed/YsM1QwjpUpc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <div class="row mt-4 vidfields">
            <div class="col-md-6 col-12">
              <h4>Dr Kumar SK</h4>
              <p>MD (AYU)</p>  
              <p>TransDisciplinary University (TDU) </p>
            </div>
            <div class="col-md-6 col-12 vidrightfields text-end">
              <p><i class="far fa-eye"></i> Views : <span>30</span></p>
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  Audio languages
                </a>
              
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="#">English</a></li>
                  <li><a class="dropdown-item" href="#">Hindi</a></li>
                  <li><a class="dropdown-item" href="#">Punjabi</a></li>
                </ul>
              </div>
              <a href="#" class="sharebtn">Share</a>
            </div>
          </div>
          <h3 class="mt-4">Ethnoveterinary treatment for Mastitis</h3>
          <p class="mt-2">This module gives a brief explanation on management of mastitis by ethnoveterinary formulation, Ingredients, ratio of ingredients,The method of preparation,Standardisation of recipe and application in mastitis Animal.</p>
      </div> 
      <div class="col-md-3">
        <div class="vidrightbg">
          <div class="row">
               <div class="col-md-12 mt-5 mt-md-0">
                  <div class="newsbg">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/YsM1QwjpUpc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      <p><span>Posted By</span> Agriland</p>
                      <span class="date">27 May</span>
                  </div>
                  <h3 class="mt-4">Breeding 2019 : What is actually happening on farms ?</h3>
                  <div class="row vidfields">
                    <div class="col-md-12">
                      <h4>Dr Kumar SK</h4>
                      <p>MD (AYU)</p>  
                    </div>
                  </div>
              </div>
             <!-- <div class="col-md-12 mt-5 mt-md-3">
                <div class="newsbg">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/YsM1QwjpUpc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <p><span>Posted By</span> Agriland</p>
                    <span class="date">27 May</span>
                </div>
                <h3 class="mt-4">Breeding 2019 : What is actually happening on farms ?</h3>
                <div class="row vidfields">
                  <div class="col-md-12">
                    <h4>Dr Kumar SK</h4>
                    <p>MD (AYU)</p>  
                  </div>
                </div>
            </div>-->
          </div>
          <div class="row">
            <div class="col-12">
              <a href="#" class="viewall">View More Videos</a>
              <a href="#" class="postvideo">Post Videos Now</a>
            </div>
          </div>
          </div>
      </div>    
  </div>
  </div>
</section>  
                  </main>



  <footer>
  <div class="footer-top mt-5">
  <div class="container-fluid">
      <div class="row">
          <div class="col-12 alllinks">
          <ul class="list-unstyled">
                <li class="heading"><?= $this->webLanguage['LIVESTOC QUICK LINKS'] ?></li>
                <li><a href="https://www.livestoc.com/vendor/product_vendor"><?= $this->webLanguage['Sell Products at Livestoc']?></a></li>
                <!-- <li><a href="<?= base_url('/') ?>all_videos"><?= $this->webLanguage['Upload Video Tutorial']?></a></li> -->
                <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Register your Champion Bull']?></a></li>
                <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Register as an Animal Dealer']?></a></li>
                <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Register as a Breeder']?></a></li>
                <li><a href="https://www.livestoc.com/vendor/product_vendor"><?= $this->webLanguage['Register as a Semen Company']?></a></li>
                <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['Submit Resume at LivestocRecruiter for Job']?></a></li>
          </ul>
          <ul class="list-unstyled">
            <li class="heading"><?= $this->webLanguage['LIVESTOC PRO']?></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['LivestocPro']?></a></li>
            <li><a href="<?= base_url('veterinary-doctors/homepage') ?>"><?= $this->webLanguage['Register as a Veterinarian']?></a></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['Register as an AI Technician']?></a></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['Register as a Paravet']?></a></li>
            <li><a href="<?= base_url('shop') ?>"><?= $this->webLanguage['Buy Products']?></a></li>
            <li><a href="https://www.livestoc.com/blog"><?= $this->webLanguage['Blogs']?></a></li>
          </ul>
          <ul class="list-unstyled">
            <li class="heading"><?= $this->webLanguage['USEFUL LINKS']?></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['LivestocLab']?></a></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Buy Animals']?></a></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Sell Animals']?></a></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['My Animals']?></a></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Add Animals']?></a></li>
            <li><a href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en_IN"><?= $this->webLanguage['Register for LivestocLab Sample Collection Center']?></a></li>
    </ul>    
          <ul class="list-unstyled">
            <!-- <ul class="list-unstyled">
                    <li class="heading"><?= $this->webLanguage['QUICK LINKS']?></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN"><?= $this->webLanguage['Advertise Job/ Vacancies']?></a></li>
                    <li><a href="https://www.livestoc.com/frontend/register"><?= $this->webLanguage['Advertise with Us']?></a></li>
                    <li><a href="https://www.livestoc.com/frontend/wishlist"><?= $this->webLanguage['My Wishlist']?></a></li>
                    <li><a href="https://www.livestoc.com/frontend/my_order"><?= $this->webLanguage['Purchase History']?></a></li>
                    <li><a href="https://www.livestoc.com/contact"><?= $this->webLanguage['Contact Us']?></a></li> 
                </ul> -->
          </ul> 
          <ul class="list-unstyled">
              <li class="heading"><?= $this->webLanguage['CONTACT DETAILS']?></li>
              <li><strong>Head Office: Livestoc Office,C86, phase-7 Pannu Tower, Mohali</strong></li>
              <li><strong><a href="#">Telephone:7829111823 </a></strong></li>
              <li><strong><a href="#">Email: support@livestoc.com</a></strong></li>
              <li class="heading forsocial mt-5">Social Media</li>
              <li class="list-inline-item social"><a href="https://www.facebook.com/Livestocfarmmanagement/"><i class="fab fa-facebook-f"></i></a></li>
              <li class="list-inline-item social"><a href="https://in.linkedin.com/company/livestoc"><i class="fa fa-linkedin"></i></a></li>
               <li class="list-inline-item social"><a href="#"><i class="fab fa-twitter"></i></a></li>
               <li class="list-inline-item social"><a href="#"><i class="fab fa-youtube"></i></a></li>
          </ul>     
          </div>    
      </div>
      <div class="row">
          <div class="col-12 mt-4">
              <h4 class="heading"><?= $this->webLanguage['Download the Livestoc app']?></h4>
          </div>
      </div>
      <div class="row">
          <div class="col-md-4">
              <ul class="list-inline">
                  
                  <li class="list-inline-item"><a class="app" href="https://play.google.com/store/apps/details?id=com.it.livestoc&hl=en"><img class="img-fluid" src="https://www.livestoc.com/assets/home/images/google-play.png" width="100%"></a></li>   
                  <li class="list-inline-item"><a class="app" href="https://apps.apple.com/us/app/livestoc/id1357092418"><img class="img-fluid" src="https://www.livestoc.com/assets/home/images/app-icon.png" width="100%"></a></li>
              </ul>
          </div>
      </div>
  </div>
  </div>
  
  <div class="footer-bottom text-center">
     
      <p><a href="#">Livestoc</a> &copy; 2017 - <?= date("Y")?>. <?= $this->webLanguage['Copyright © All rights reserved.']?> </p>
  </div>


<script src="https://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBKXAzms3AOjKJz4hjMlPdFreKAryub2U&libraries=places"></script>
<script src="https://www.livestoc.com/assets/app/js/cart.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/jquery.pagination.js"></script> -->
 </footer>  
    
</main>
<script type="text/javascript">
    
    function messageForApp() {
        if (confirm('For this you can download the Livestoc App?')) {
          // Save it!
          window.location.href='https://play.google.com/store/apps/details?id=com.vet.tech&hl=en_IN';
          console.log('Thing was saved to the database.');
        } else {
          // Do nothing!
          console.log('Thing was not saved to the database.');
        }
    }
    function cart(product_id, price, pack, user_id, user_type){
        app_url = "<?= base_url('/frontend'); ?>";
        if(user_id == '0'){
        window.location.href = "<?= base_url() ?>frontend/login";
        }else{
        cart_add(product_id, pack, price, '1',user_id, user_type);
        }
    }
//     function cart(product_id, price, pack){
//     //app_url = 'http://localhost:8081/home';
//     app_url = "<?= base_url('/homenew'); ?>";
//     cart_add(product_id, pack, price, '','','1');
//   }
function intrested_to_buy(id){
    var user_id = "<?= $this->session->userdata("users_id") ?>";
    var type = "<?php echo $this->session->userdata("user_type"); ?>"
    $.ajax({
            type: "POST",
            url: "<?= base_url('frontend/') ?>"+"add_interested",
            data: { product_id: id, user_id: user_id, type: type},
            dataType: "json",
            cache : false,
            success: function(data){
                alert(data.msg);
            } 
        });
  }
  <?php if($this->session->userdata("users_id")){ ?>
  function like(product_id, price, pack){
    var user_id = <?= $this->session->userdata("users_id") ?>;
    var type = "<?php echo $this->session->userdata("user_type"); ?>";
    var qty = '1';
    $.ajax({
            type: "POST",
            url: "<?= base_url('frontend/') ?>"+"add_like",
            data: { product_id: product_id, user_id: user_id, type: type, pack_id: pack, pack_price: price, qty: qty},
            dataType: "json",
            cache : false,
            success: function(data){
                alert(data.msg);
            } 
        });
  }
  <?php } ?>
  function showAlertMessage(id='') {
    if(id=='') {
        confirm('This Video Is Not Available');
    }
  }
</script>


