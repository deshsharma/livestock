 <?php //print_r($data); ?>
 <link href="https://www.livestoc.com/assets/home/css/saleanimal.css" type="text/css" rel="stylesheet">
  <section>
        <div class="liv-all-animals primary-grey">
            <div class="container-fluid p0">
                <div class="row position-relative">
                    <div class="col-12">
                        <div class="all-animal-tab">
               					

                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 forpos">
                                	<?php $animal_details = $this->api_model->get_data('animal_id = "'.$data[0]['animal_id'].'"', 'animals_images', '','images,CONCAT("'.IMAGE_PATH.'uploads_new/animals/thumb/",images) as images');   ?>
                                        <div id="sync1" class="slider owl-carousel">
                                        	<?php foreach($animal_details as $img)
                                        	 {?>
                                          <div class="item"><img class="card-img-top" src="<?php print_r($img['images']); ?>" alt="Card image cap"></div>
                                         <?php } ?>
                                        </div>
                                        <div id="sync2" class="navigation-thumbs owl-carousel">
                                        	<?php foreach($animal_details as $img)
                                        	 {?>
                                          <div class="item"><img class="card-img-top" src="<?php print_r($img['images']); ?>" alt="Card image cap"></div>
                                         <?php } ?>
                                        </div>
                                    <div class="likes">
                                        <a onclick="add_animal_like(<?= $data[0]['animal_id'] ?>, <?= $data[0]['users_id'] ?>, <?= $status='1' ?>)"><?php echo $data[0]['likes']; ?><i class="fa fa-thumbs-up ml-2 blue" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="wishlist">
                                        <a class="#" >Add to Wishlist</a>
                                    </div>

                                    <div class="watch">
                                        <a href="#"><i class="fas fa-play"></i> </a>
                                    </div>
                                    <div class="row mt-4">
                                    <div class="col-6 pr-0">
                                        <div class="neon-blue p-2 pl-3">
                                        <h5 class="mb-1"><?php echo $data[0]['cat_name']; ?> #<?php echo $data[0]['animal_id'];?></h5>
                                        <p class="mb-1"><?php echo $data[0]['breed_name']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl-0 text-right">
                                        <div class="dblue p-2 pr-3">
                                        <p class="mb-0">Price</p>
                                        <h4 class="mb-1">Rs <?php echo $data[0]['price'];?></h4>
                                        </div>
                                    </div> 
                                  </div>
                                </div>
                            
    
    
<div class="col-12 col-sm-6 col-md-6 col-lg-8 mt-0">
     
    <div class="row mt-md-0 mt-4">
        <div class="col-md-4 pr-0 pl-0">
            <div class="primary-grey p-2 pl-3">
            <p>Unique ID: <strong><?php echo $data[0]['animal_id']; ?></strong></p>
            <p>Category: <strong><?php echo $data[0]['cat_name']; ?></strong></p>
            <p>Breed : <strong>Holstein Friesian (HF)</strong></p>
            <p>State: <strong><?php echo $data[0]['state'];?></strong></p>     
            </div>
        </div>
        <div class="col-md-4 pl-md-0 pl-2">
            <div class="primary-grey p-2 pr-3 text-left">
            <p>Age: <strong><?php echo $data[0]['age']; ?> Years <?php echo $data[0]['month']; ?>Months</strong></p>
            <p>Gender : <strong><?php echo $data[0]['gender'];?></strong></p>    
           <p>Yield: <strong><?php echo $data[0]['peak_milk_yield'];?> Liters</strong></p>
            <p>Lactation: <strong><?php echo $data[0]['lactation'];?></strong></p>
            </div>
        </div>
        <div class="col-md-4 pl-md-0 pl-2">
        </div>
      </div>
      <div class="row">
          <div class="col-12 mt-2">
              <p>Details<strong>  <?php echo $data[0]['description'];?></strong></p>
          </div>         
        </div>      
      <div class="row mt-5">
          <div class="col-md-3 col-6 pr-0 offset-md-6">
             <a href="#" onclick="contact_seller()" class="btn btn-primary"><i class="fa fa-phone-square mr-3" aria-hidden="true"></i>Contact Seller</a>
          </div>
          <div class="col-md-3 col-6 pl-0">
             
          </div>
      </div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<?php include('footer_new.php'); ?> 
     
      <!-- <script src="js/owl.carousel.min.js"></script> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <!-- <script src="js/bootstrap.js"></script> -->
 <script type="text/javascript">
 	function contact_seller(){
 		alert('<?php echo $data[0]['Contact'];?>');
 	}
 </script>
<script> 
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
		    
		var sync1 = $(".slider");
		var sync2 = $(".navigation-thumbs");

		var thumbnailItemClass = '.owl-item';

		var slides = sync1.owlCarousel({
			video:true,
		  startPosition: 12,
		  items:1,
		  loop:true,
		  margin:10,
		  autoplay:false,
		  autoplayTimeout:6000,
		  autoplayHoverPause:false,
		  nav: false,
		  dots: true
		}).on('changed.owl.carousel', syncPosition);

		function syncPosition(el) {
		  $owl_slider = $(this).data('owl.carousel');
		  var loop = $owl_slider.options.loop;

		  if(loop){
		    var count = el.item.count-1;
		    var current = Math.round(el.item.index - (el.item.count/2) - .5);
		    if(current < 0) {
		        current = count;
		    }
		    if(current > count) {
		        current = 0;
		    }
		  }else{
		    var current = el.item.index;
		  }

		  var owl_thumbnail = sync2.data('owl.carousel');
		  var itemClass = "." + owl_thumbnail.options.itemClass;


		  var thumbnailCurrentItem = sync2
		  .find(itemClass)
		  .removeClass("synced")
		  .eq(current);

		  thumbnailCurrentItem.addClass('synced');

		  if (!thumbnailCurrentItem.hasClass('active')) {
		    var duration = 300;
		    sync2.trigger('to.owl.carousel',[current, duration, true]);
		  }   
		}
		var thumbs = sync2.owlCarousel({
		  startPosition: 12,
		  items:4,
		  loop:false,
		  margin:10,
		  autoplay:false,
		  nav: false,
		  dots: false,
		  onInitialized: function (e) {
		    var thumbnailCurrentItem =  $(e.target).find(thumbnailItemClass).eq(this._current);
		    thumbnailCurrentItem.addClass('synced');
		  },
		})
		.on('click', thumbnailItemClass, function(e) {
		    e.preventDefault();
		    var duration = 300;
		    var itemIndex =  $(e.target).parents(thumbnailItemClass).index();
		    sync1.trigger('to.owl.carousel',[itemIndex, duration, true]);
		}).on("changed.owl.carousel", function (el) {
		  var number = el.item.index;
		  $owl_slider = sync1.data('owl.carousel');
		  $owl_slider.to(number, 100, true);
		});




		});          
</script>
<script>
       <?php if($this->session->userdata("users_id")){ ?>
  function add_animal_like(animal_id, user_id, status){
	var user_id = <?= $this->session->userdata("users_id") ?>;
	// var type = "<?php echo $this->session->userdata("user_type"); ?>";
  // var qty = '1';
	$.ajax({
			type: "POST",
			url: "<?= base_url('webservices_new_dev/animals/') ?>"+"add_animal_like",
			data: { animal_id: animal_id, users_id: user_id, status: status},
			dataType: "json",
			cache : false,
			success: function(data){
        if(data.success){
          location.reload();
        }else{
          alert(data.error)
        }
       // console.log(data)
			} 
		});
  }
<?php } ?>
  function subs(){
    var email = $('#sub_email').val();
    if(isValidEmailAddress(email))
    {
        $.ajax({
          type: "POST",
          url: "<?= base_url('frontend/') ?>"+"add_subscriber",
          data: { email: email},
          dataType: "json",
          cache : false,
          success: function(data){
            alert(data.msg);
          } 
        });
    } else {
        alert('Please enter valid email');
    }
  }
  function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
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
  function cart(product_id, price, pack){
    app_url = "<?= base_url('/frontend'); ?>";
    cart_add(product_id, pack, price, '','','1');
  }
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
            

              $('.dropdown-submenu a.test').on("click", function(e){
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
              });
            
            
         jQuery(document).ready(function($){
          $(".filterexpand").click(function()
          {
            $(".filtercontent").slideToggle('slow');
          });  
        });
		  
        $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                autoplay : true,
                dots: false,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 1,
                    nav: false,
                    loop: true,
                    margin: 20
                  }
                }
              })    
            
		});
	</script>  