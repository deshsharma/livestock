<?php  //$users_id = $this->session->userdata("users_id"); //print_r($users_id); ?>

    <div class="main-content">
    <div class="foroverlay"></div> 
<section>
        <div class="liv-all-animals primary-grey champ-bull-listing champ-bull-reg">
             <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
             <?php } ?>
            <div class="container-fluid p0">
                <form method="post" action="add_dealer_registration" enctype="multipart/form-data">
                <input type="hidden" id="users_id" name="users_id" value="<?php echo $this->session->userdata('users_id'); ?>">
                <input type="hidden" id="users_type" name="users_type" value="<?php echo $this->session->userdata('user_type'); ?>">
                <input type="hidden" id="user_name" name="user_name" value="<?php echo $this->session->userdata('user_name'); ?>">
                    <div class="row position-relative">
                        <div class="col-12">
                            <h4 class="btn btn-primary champ-reg"> Enter Details</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <p class="foryld mb-2"><strong> Enter Farm Name</strong></p>
                            <div class="form-group">
                                <input type="text" name = "farm_name"class="form-control" id="farmName" aria-describedby="farm name" placeholder="Farm Name (if any)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-5">
                            <h5><span>1</span>Choose Category</h5>
                            <ul class="list-inline">
                                <?php $category = $this->api_model->get_data('isactivated = "1" ','category','','category_id,category,background,CONCAT("'.IMAGE_PATH.'uploads/logo/",logo) as logo');
                                    foreach($category as $cat){?>
                                    <li class="list-inline-item text-center category"  name="category">
                                        <label class="champ-reg-lbl">
                                            <input type="checkbox" name="category" value="<?= $cat['category_id']; ?>">
                                            <img src="<?= $cat['logo'];?>" style="height: 62px;">
                                        </label>
                                        <p class="champ-reg-name"><?= $cat['category']; ?></p>
                                        <p class="champ-reg-name">Please chose breed you specialize in</p>
                                    </li>
                                <?php } ?>
                            </ul>    
                        </div>
                        <div class="col-md-6 mt-5 selectbreed">
                            <h5><span>2</span>Select Breed</h5>
                                <ul class="list-inline breed_id">                           
                                    <li class="list-inline-item text-center">
                                        <label class="champ-reg-lbl">
                                            <input type="radio" name="breed_id" class="champ-reg-lbl "value="" checked>

                                        </label>
                                    </li>
                            </ul>    
                        </div>                   
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <p class="foryld mb-2"><strong> Choose Location</strong></p>
                            <div class="form-group">
                                <input type="text" name = "address"class="form-control" id="searchTextField" aria-describedby="location help" placeholder="Enter Location" autocomplete="on" runat="server" required>
                                <input type="hidden" id="city2" name="city2" />
                                <input type="hidden" value="" id="cityLat" name="cityLat" />
                                <input type="hidden" value="" id="cityLng" name="cityLng" /></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-2 col-6">
                            <!-- <button class="btn btn-primary champ-reg" name="submit">Free Listing</button> -->
                            <input type="submit" name="submit" value="Free Listing">
                        </div>
                        <!-- <div class="col-md-3 col-6"> -->
                            <!-- <button class="btn btn-primary champ-reg" name="submit">Premium Member</button> -->
                            <!-- <input type="submit" name="submit" value="Premium Member" >
                        </div> -->
                    </div>
                </form>
        </div>
    </div>
</section>
<script>
$('.category').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_breed?category_id="+$('input[name="category"]:checked').val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data.data;
                    var option = '<input type="radio" name="breed_id" class="champ-reg-lbl " >';
                    					var radio = '';
			                            $.each(str, function(index, item){
                                     radio += '<li class="list-inline-item text-center">\
			                                    <label class="champ-reg-lbl">\
			                                        <input type="radio" name="breed_id" class="champ-reg-lbl "value="'+item.breed_id+'">\
			                                        <p>'+item.breed_name+'</p>\
			                                    </label>\
			                                  </li>  '
			                            }); 
                                        $('.breed_id').html(radio);
										
                }
                });
})
$(document).ready(function(){
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
            items:3,
            nav:false
        },
        1000:{
            items:1,
            nav:false,
            loop:false
        }
    }
})

$('#owl-carousel2').owlCarousel({
    loop:true,
    margin:25,
    responsiveClass:true,
    responsive:{
        0:{
            items:1.25,
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
            items:1.45,
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
    margin:25,
    responsiveClass:true,
    responsive:{
        0:{
            items:1.25,
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
    $('#tab_selector').on('change', function (e) {
        $('.form-tabs li a').eq($(this).val()).tab('show');
    });

});          
</script>
 <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.submit.lat();
                document.getElementById('cityLng').value = place.geometry.submit.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
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