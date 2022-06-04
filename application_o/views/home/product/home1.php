<?php $this->webLanguage; ?>
<?php include('header_user_locations.php'); ?>
<style type="text/css">
.liv-category ul li a.active {
    padding: 5px 12px;
    background-color: #eee!important;
    color: #48ade4!important;
}
</style>

    <?//php print_r($_REQUEST)?>
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
    
    <?php //include('cattle_dealers_and_dreeders_register.php'); ?>

    <?php //include('telephonic_consultation_and_cattle_pregnancy.php'); ?>    
    
    <?php //include('top_services_list.php'); ?>  

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
    <?php //include('news_and_articles_list.php'); ?>   
     
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