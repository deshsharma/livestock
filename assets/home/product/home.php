<?php $this->webLanguage; ?>
<?php include('header_user_locations.php'); ?>
<style type="text/css">
.liv-category ul li a.active {
    padding: 5px 12px;
    background-color: #eee!important;
    color: #48ade4!important;
}
</style>

    <?php //print_r($_REQUEST)?>
    <section>
        <div class="top-carousel">
            <div class="row">
                <?php if($category =='1,8'){?>
                    <div class="col-12">
                        <h5 class="text mb-4 float-left" style="margin-top: 1.5rem;"><span>&nbsp;&nbsp; <?= $this->webLanguage['Bulls For Artificial Insemination']?></span></h5>
                    </div>
                    <div class="col-12">
                        <div id="owl-carousel1" class="owl-carousel owl-theme">
                        <?php   
                            $section1 = $this->api_model->get_section($category);
                            $i = 0;
                            if($data1 = $this->api_model->get_bull_by_source_id($section1[0]['category'], $name)){
                                foreach($data1 as $d){
                                    $bread_name1 = $this->api_model->get_animal_breed($d['bread']);
                                    $url = base_url().'harpahu_merge/uploads/bank/'.$d['image'];
                                    $file = BASE_URL . "uploads_new/animals/thumb/" . $row['images'];
                                    $handlerr = curl_init($file);
                                    curl_setopt($handlerr,  CURLOPT_RETURNTRANSFER, TRUE);
                                    $resp = curl_exec($handlerr);
                                    $ht = curl_getinfo($handlerr, CURLINFO_HTTP_CODE);
                                    if ($d['image'] != ''){
                                    ?>
                                    <div class="item">
                                    <a href="<?= base_url('bull_detail/').$d['id']; ?>">
                                        <div class="card">
                                            <div class="imgdiv">
                                            <img src="<?php echo base_url().'harpahu_merge/uploads/bank/'.$d['image']; ?>" alt="<?php echo  $d['bull_alt_tag']; ?>">
                                            </div>      
                                            <div class="card-body">
                                                <h6 class="card-text text-center"><?php echo  $bread_name1[0]['breed_name']; ?></h6>
                                                <p class="card-text text-center"><?= $this->webLanguage['Bull ID']?>:- <?php echo "LIVE_".$d['id']; ?>
                                                    <?php if($d['dam_yield'] != ''){ ?><br><?= $this->webLanguage['Dam Yield (Kg)']?>:- <?= $d['dam_yield'] ?><?php } ?></p>
                                            </div>
                                        </div>
                                    </a>    
                                    </div>  
                                <?php
                                /*if($i == 5) {
                                    break;
                                    }
                                    $i++;*/
                                }
                                }
                            } ?>
                      </div>
                  </div><?php }?>
            </div>
        </div>
    </section> 
    
    <?php include('animal_kingdom_list.php'); ?>    
    <?php include('cattle_dealers_and_dreeders_register.php'); ?>
    <?php include('telephonic_consultation_and_cattle_pregnancy.php'); ?>    
    <?php include('top_services_list.php'); ?>  
    <?php include('animal_healthcare_products_list.php'); ?> 
    <?php include('video_tutorials_list.php'); ?> 
    <?php if($_REQUEST['category_id'] != '2' && $_REQUEST['category_id'] != '3' && $_REQUEST['category_id'] != '4' && $_REQUEST['category_id'] != '5' && $_REQUEST['category_id'] != '6' && $_REQUEST['category_id'] != '7' ){?>
   <!--  <section class="neon-blue mt-5">
        <div class="container-fluid">
            <div class="row resume pt-4 pb-4">
                <div class="col-md-12 pl-md-5 mt-5 mt-md-0">
                    <h1>BUY ANIMALS ONLINE- LIVESTOC APP</h1>
                   
                     <h2>LIVESTOCK FARMING</h2>
                  

                    <h4><span>Search</span> Resume</h4>
                    <div class="input-group mt-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Search Resume" aria-label="search" aria-describedby="basic-addon1">
                    </div>  
                </div>
                <div class="col-md-8 pl-md-5 mt-5 mt-md-0">
                    <h4>Submit Resume at <span>Livestoc Recruiter</span> for Job</h4>
                     <a href="#" class="applynow forsubmit">Apply Now <i class="fas fa-chevron-right pl-3" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>       
    </section>    --> 
    <?php }?>
    <?php include('news_and_articles_list.php'); ?>   
        <!-- SCO CONTENT -->
         <section class="neon-blue mt-5">
        <div class="container-fluid">
            <div class="row resume pt-4 pb-4">
               
                    <button class="tablink" onclick="openPage('Home', this, '#48ade4')">BUY ANIMALS</button>
                    <button class="tablink" onclick="openPage('News', this, '#48ade4')" id="defaultOpen" active>LIVESTOCK FARMING</button>
                    <button class="tablink" onclick="openPage('Contact', this, '#48ade4')">DOWNLOAD LIVESTOC</button>
                    <button class="tablink" onclick="openPage('About', this, '#48ade4')"> HOME VISITING VETS</button>
                    <button class="tablink" onclick="openPage('SEMENS', this, '#48ade4')"> SEMENS</button>
                    <button class="tablink" onclick="openPage('SERVICES', this, '#48ade4')"> OUR SERVICES</button>
                    <button class="tablink" onclick="openPage('SALE', this, '#48ade4')"> SALE</button>
                    <button class="tablink" onclick="openPage('Veterinary_Services', this, '#48ade4')"> VETERINARY SERVICES</button>

                     <!-- <div class="col-md-12 pl-md-5 mt-5 mt-md-0"> -->
                    <div id="Home" class="tabcontent">
                      <h1>BUY ANIMALS ONLINE- LIVESTOC APP</h1>
                      <p>The meat we eat, the leather we wear, the eggs we fry, the milk we drink, and the wool we cover ourselves in is what is called livestock. To quote Wikipedia, “Livestock is commonly defined as domesticated animals raised in an agricultural setting to produce labour and commodities.” So, it’s the mooing cows on the streets, the bleating sheep in the farms, the clucking hens, and the neighing horses that actually form the livestock.

We at Livestoc, realize the need and importance of not just meeting the needs of the livestock sector but also transforming the entire livestock industry across the world. From buying animals online to selling cow semens for sale in India, from providing home visit vet services to setting up your new farm, the Livestoc app is a one-stop solution to all your animal husbandry needs. Be it the nuisance that your tube well turned out to be or your pitbull puppy that created a mess at your home, Livestoc offers a wide range of animal and farm services near you.</p>
                    </div>

                    <div id="News" class="tabcontent">
                      <h1>LIVESTOCK FARMING</h1>
                      <p >More than 100 million farmers in India are dependent upon agriculture as a primitive source of income for them and their kin. The challenges for redressing poverty in rural areas are mainly related to the expansion of economic opportunities, empowerment of the poor to take advantage of new opportunities, and an effective safety net to reduce vulnerability and protect the poorer of the poor. Animal husbandry emerged and is emerging to be one such opportunity for this grazier population. This newly flourishing sector, if and when pursued as a sidekick, has proved to and is continuing to better the livelihoods of these families. By not only ensuring a meagre and a steady supply of income, but the share of the livestock sector to the Indian GDP has also been increasing at a faster rate than that from the crops. 

In the untapped sector of livestock farming, we at Livestoc aim to exploit the field by providing our farming and cattle services across the country. So, if your Google searches look something like “Veterinary Doctor Near Me Home Visit'' or “Puppies for Sale India'' or even “Cow Semens for sale in India'', then we are just the solution for you. Download our app, available on the play store as well as the app store, and get to experience an n number of services we have to offer to you. The app is designed to especially meet the needs of the cattle and pet industry throughout the country. Buy cows online or buy animals online, the Livestoc app is sketched in a way to provide quality healthy livestock as per Your needs and preferences.
                        </p> 
                    </div>

                    <div id="Contact" class="tabcontent">
                      <h1>DOWNLOAD LIVESTOC and BUY COWS ONLINE</h1>
                      <p>Whether you are looking for a two-month-old Malvi cow or a black Banni buffalo, we have all of them in-store. Enter your location, add your preferences and hit the enter button. Voila! You now have a whole list to choose your new cattle from and buy cows online.

                    Besides cows and buffaloes, the Livestoc has a number of horse breeds to offer as well. To name a few are the Kathiawari, the Marwari, the Bhutia horse and the Mainpuri Pony,  etc. Moving on from horses, we at Livestoc deal with other cattle too. It's the sheep and the goats. Trust us, buying animals online has never been this easy. With a pan-India network, we assure you of quick delivery of your products and services. If you're sitting in the mountains in Assam or at a beach in Kerala, pondering about having cattle to yourselves, download our app and buy cows online.
                                        </p>
                    </div>

                    <div id="About" class="tabcontent">
                      <h1>HOME VISIT VETS</h1>
                      <p>But with pets come responsibilities. through our pet care services division, we cater to the needs of pet owners. Get your pets vaccinated, groomed and certified with clicks on your phones. And why not get that beautiful goofball of yours to participate in dog shows, right? We've got them covered too. Refrain from standing in long queues to get entry passes, and waiting for your turn at a vet's clinic, every other week, to get your pet a haircut and a bath. Download our app and place your orders online. Our team of experts and home visiting vets are just a click away to take charge of all your pet care needs. No more worrying about veterinarians near me when we have a whole range of home visit vets to offer to you.

If you're looking for someone to sell your pets and animals to, we've got your back. Likewise selling livestock, we also provide a platform for you to sell your cats and dogs and cows and goats, thus meeting up all your livestock needs. 
.
                        </p>
                    </div>
                     <div id="SEMENS" class="tabcontent">
                      <h1>COW SEMENS FOR SALE IN INDIA</h1>
                      <p>The Livestoc app was designed with the idea to produce an all-solution platform for livestock owners. If you're into farming, animal husbandry, a pet lover or a cattle caretaker, the Livestoc app screens all your needs and preferences and thence provides to you the best of solutions, nearest to you. We also help people exchange semens of their herds and stocks. Like humans, animals too need to sustain their hierarchical lineage. With a firm acceptance of the fact, we provide our users the ease of trading semens with the ones of their needs and liking, like, cow semens for sale in India.

Moving on from the biotic dealings, our brand offers a further wide range of services for someone who is looking up to set up their new farm or even renew their old one. Starting from the selling of farm products and heavy types of equipment to arranging your farms and then to providing consultancy services, we have all the expertise in the field. Looking for "farm consultancy near me"? Give our app a try and you'll worry no more. With a team of specialists mastering the fields of farming and animal husbandry, we at Livestoc believe in the quality of service.
                        </p>
                    </div>
                    <div id="SERVICES" class="tabcontent">
                      <h1>OUR SERVICES</h1>
                      <p>The app intends to devise and create an organised sector of livestoc and dairy farming. With an immense amount of potential, we aim to profitably exploit the number of plausibilities that the segment is yet to offer. We believe in inclusive growth of dairy farmers, pet owners, veterinarians, pet trainers & groomers, animal breeders & traders and animal product manufacturers.
                        <ul>
                          <li><h4>Livestock Management Division:</h4> We address dairy farming issues including establishing an optimal farm management life cycle, adopting practical science-based feed & nutritional strategies, keeping animal disease at bay effectively yet economically, and understanding the dynamics of breeding genetics. We, at Livestoc, seek to ease and enrich the dairy farmer through integrated solutions to boost the entire dairy production lifecycle
Livestoc Farm Care Products and Equipment: With a global knowledge base ably supported by a local service & support network, Livestoc empowers animal owners & aggregators with accurate tools to make operational & strategic decisions for enhanced productivity and sustainability. Ease of application & innovation lies at the heart of all targeted solutions offered by Livestoc.</li>
                          <li><h4>Online buying and selling of livestock:</h4> The Livestoc has a wide array of animals and cattle to offer to its customers. Dogs, cats, cows and buffaloes from the streets; horses, sheep and goats from the grasslands; pigs from the swamps and fishes from the ponds.</li>
                          <li><h4>Livestoc Pet Care Services and Products division:</h4> We cater to the needs of pet owners right from the comfort of their homes. These door-to-door services are offered by Livestoc in only tier 1 and 2 cities of India. Besides, home visiting veterinarians near you, we deal in making available a range of pet care products and essentials to you at your doorsteps. Buy animal products online if you buy animals online.</li>
                          <li><h4>Livestoc Pet Care Services and Products division:</h4> We cater to the needs of pet owners right from the comfort of their homes. These door-to-door services are offered by Livestoc in only tier 1 and 2 cities of India. Besides, home visiting veterinarians near you, we deal in making available a range of pet care products and essentials to you at your doorsteps. Buy animal products online if you buy animals online.</li>
                          <li><h4>Breeding amenities by an exchange of semens:</h4> We facilitate the collection of cow semens for sale in India to further the breeding process among cattle. Get options of sellers and buyers of cow semens for sale in the country.</li>
                        </ul>
We are in a phase when the Government of India has initiated the application of much long-needed reforms and changes with its farm laws and the anti-slaughtering bills, in the interests of the farmers and protecting cows respectively. It is high time we come to realisation with the fact that the cattle and the farms form the backbone of the Indian economy and it is in the hands of its citizens to refurbish and modify that which has been neglected for long in the past. 

With a similar vision in mind, we at Livestoc desire to change the unchanged and revamp the delayed. If you've followed us here till the end, we believe you support us and are here with us. What are you waiting for? Our app, Livestoc, is available on both the play store and the app store. Download the app now. Change begins at home. Together we can and we will move towards a healthy farming system of cropping and livestock farming.

                        </p>
                    </div>
                    <div id="SALE" class="tabcontent">
                      <h1>PUPPIES FOR SALE IN INDIA with HOME VISITING VETS</h1>
                      <p>It's not just the cattle livestock. If watching Instagram stories of your peers playing and getting all mushy with their dogs and cats is a lot for you to take, get yourselves one. The Livestoc app has a wide range of puppies for sale in India. Be it a German Shepherd, a Bulldog, a Golden Retriever, or a cute Shih Tzu, we've got them all. Buy a Pitbull puppy for sale in India on our Livestoc app. Reluctant to take sides, we welcome cat people too looking for Persian cats or Siamese cats or American bobtail cats.
                        </p>
                    </div>
                    <div id="Veterinary_Services" class="tabcontent">
                      <h1>Veterinary Services</h1>
                      <p>Fauna is an important part of any ecosystem. The pet trend has been on a rise for the past few years
                          and so has been the need for veterinary services and products, apparently. Likewise, human beings,
                          pets too need their essential certifications, regular medical check-ups, preventive and curable
                          measures against diseases all partake of veterinary services. When one talks about veterinary
                          services, they not only extend to pets but the whole of animal life. Your domestic buffaloes and your
                          commercial horses, the deer in the wild and the dogs at your homes, all need their daily dosage of
                          drugs and vaccines. Veterinary services keep in check the shape and state of animals around them.
                          Livestoc app offers you a wide range of veterinary services. Veterinarians near me are the or vet on
                          call are the need of every pet owner. One just cannot go without getting their pets examined by a
                          specialist. The Livestoc helps you connect with the right people so that you avail the benefits of
                          the best veterinary doctors near you. Many a time it may not be likely for you to get your dog or cat
                          or other pets to the vets. We at Livestoc bring to you the services of a veterinary doctor near me
                          home visit. Doctors at Livestoc are just a phone call away! We maintain a leading team of experts to
                          bring to you the best of services at affordable costs. The vets associated with Livestoc are highly
                          educated and experienced in their field and are well-equipped with all sorts of animal problems that
                          one may face. If you are looking for the best veterinary doctors near you or even those paying home
                          visits, then Livestoc is just the solution for you.
                          However, the duties of a vet do not only end with providing the right medicine to fight a certain
                          disease, there&#39;s a lot more to it. One such job is providing the right balance of diet for your loved
                          one. Yes! You heard it right! Not only humans are the ones who need to get the right amount of
                          nutrition for their body to work well. Animals too depend on the right diet to reload their energy
                          tank only to hop around here and there. This where veterinary nutritionist consultation comes into
                          the picture. They do thorough research and study of the health and the requirements of your pets
                          and then prescribe what is best for them. Veterinary nutritionist consultation is as important as
                          upkeeping the physical health of those cute creatures. So next time when you pay a visit to the best
                          veterinary doctors near me make sure that you get from them a veterinary nutritionist
                          consultation and make your favourite strong and healthy inside out.
                        </p>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </section>
        <!-- END SCO CONTENT -->


 <section>
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
              <div class="col-md-12 mt-5 mt-md-3">
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
    <?php include('footer_new.php'); ?>    
        
    </div>    
<script>
$('.lang').click(function(){
    //alert($(this).value);
    var lang = $(this).data('val');
    $.ajax({
        url: "<?= base_url('frontend/language') ?>",
        data: {lang: lang},
        type: 'POST',
        success: function(data) {
            location.reload();
        }
    });
    <?php //$_SESSION['language'] = echo "$(this).data('val')"; ?> 
})
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script> 
var searchLocationVal = '';
var searchLocationName = '';
$(document).ready(function(){

    var availableTags1 = JSON.parse($('#locationValues').val());
    var availableTags = []; 
    $.each(availableTags1, function(index,obj)
    {
        //We can access the object using obj or this
        //console.log("index:"+index + " , value: "+obj.name +" , value:"+this);
        availableTags.push({label: obj.name, value: obj.name});   
    });
 
    $( "#searchTextFieldForSearch" ).autocomplete({
        source: availableTags
    });
    
    $("#searchTextFieldForSearch").change(function(){
        searchLocationVal = $("#searchTextFieldForSearch").val();
        searchLocationName = $("#searchTextFieldForSearch option:selected").text();
        //window.location.href = '<?= base_url() ?>home?search='+ val;
        window.location.href = '<?= base_url() ?>homenew/index?state_name='+searchLocationVal;
    });
    $(".menubutton").click(function(){
        $(".rightmenu").toggleClass('show');
        $(".foroverlay").toggleClass('foroverlayshow');
        $(this).toggleClass('forBtn');   
    });
    $(".foroverlay").click(function(){
        $(".menubutton").removeClass('forBtn');
        $(".rightmenu").removeClass('show');
        $(this).removeClass('foroverlayshow');
    });
    $('#owl-carousel1').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:4,
            nav:false
        },
        1000:{
            items:4,
            nav:false,
            loop:false
        }
    }
})
$('#owl-carousel2').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:true,
            dots:false,
            loop: false
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:4,
            nav:true,
            loop:false,
            dots:false
        }
    }
})
$('#owl-carousel3').owlCarousel({
    loop:true,
    margin:25,
    responsiveClass:true,
    responsive:{
        0:{
            items:1.10,
            nav:true,
            dots:false
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:4,
            nav:true,
            loop:false,
            dots: false
        }
    }
})
$('#owl-carousel4').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1.10,
            nav:false,
            margin:0,
            dots:false
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:3,
            nav:true,
            loop:false,
            dots: false
        }
    }
})    
});
function goToVideoTutorials(){
    window.location.href = '<?= base_url('/') ?>all_videos';
}
function goPostVideoTutorials() {
    window.location.href = '<?= base_url('/') ?>all_videos';
}
function goProductListing($sec = '') {
    window.location.href = '<?= base_url() ?>frontend/product_listing/'+$sec;
}
function getFullValuesForSearch($sec) {
    //alert($sec);
    window.location.href = '<?= base_url() ?>homenew/index?category_id='+$sec+"&state_name="+searchLocationName+"&state_id="+searchLocationVal+"&language=en";
}
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
</body>
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: #20668a;
  color: #ecf0f5;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  /*width: 25%;*/
}

.tablink:hover {
  background-color: #48ade4;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: #212529;
  display: none;
  padding: 10px 20px;
  height: 100%;
}

#Home {background-color: #ffffff;}
#News {background-color: #ffffff;}
#Contact {background-color: #ffffff;}
#About {background-color: #ffffff;}
</style>