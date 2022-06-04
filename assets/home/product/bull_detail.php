<?php //include('header_user_locations.php'); ?>
    <section>
        <div class="liv-all-animals primary-grey">
            <div class="container-fluid p0">
                <div class="row position-relative">
                    <div class="col-12">
                        <div class="all-animal-tab">
               

                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 forpos">
                                        <div id="sync1" class="slider owl-carousel">
                                          <div class="item"><img class="card-img-top" src="<?php echo base_url().'harpahu_merge/uploads/bank/'.$data[0]['image']; ?>" alt="<?php echo $data[0]['bull_alt_tag']; ?>"></div>
                                        </div>
                                       
                                    <?php $cat = $this->api_model->get_data('category_id = "'.$data[0]['category'].'"', 'category', 'category') ?>
                                    <div class="row mt-4">
                                    <div class="col-6 pr-0">
                                        <div class="neon-blue p-2 pl-3">
                                        <h4 class="mb-1"><strong><?= $cat[0]['category']; ?></strong> <?= "LIVE_".$data[0]['id'] ?></h4>
                                        <?php $bread = $this->api_model->get_data('breed_id = "'.$data[0]['bread'].'"', 'breed', 'breed_name') ?>
                                        <p class="mb-0"><?= $bread[0]['breed_name'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl-0 text-right">
                                        <div class="dblue p-2 pr-3">
                                        <p class="mb-0"><?= $this->webLanguage['Price']?></p>
                                        <?php $group = $this->api_model->get_data('id = "'.$data[0]['groups'].'"','semen_group','group, farmer_price') ?>
                                        <h4 class="mb-1"><?= $this->webLanguage['Rs']?> <?= $group[0]['farmer_price'] ?></h4>
                                        </div>
                                    </div> 
                                  </div>
                                </div>
<div class="col-12 col-sm-6 col-md-6 col-lg-8 mt-0">
    <div class="row mt-md-0 mt-4">
        <div class="col-md-4 pr-0 pl-0">
            <div class="primary-grey p-2 pl-3">
            <p><?= $this->webLanguage['Unique ID']?>: <strong><?= $data[0]['bull_no'] ?></strong></p>
            <p><?= $this->webLanguage['Category']?>: <strong><?= $cat[0]['category']; ?></strong></p>
            <p><?= $this->webLanguage['Breed']?> : <strong><?= $bread[0]['breed_name'] ?></strong></p>
            <p><?= $this->webLanguage['Dams Yield (kg)']?>: <strong><?= $data[0]['lat_yield'] ?></strong></p>     
            </div>
        </div>
        <div class="col-md-4 pl-md-0 pl-2">
            <div class="primary-grey p-2 pr-3 text-left">
            <p><?= $this->webLanguage['Semen Type']?>: <strong><?= $data[0]['semen_type'] ?></strong></p>
            <p><?= $this->webLanguage['Semen Bank']?> : <strong><?= $data[0]['bull_bank_name'] ?></strong></p>    
            <p><?= $this->webLanguage['Group']?>: <strong><?= $group[0]['group'] ?></strong></p>
            
            </div>
        </div>
       
      </div>
     
      <div class="row mt-5">
          <div class="col-md-6 col-12 pr-0 offset-md-6">
              <a href="https://play.google.com/store/apps/details?id=com.it.livestoc" class="btn btn-primary2 pt-2"></i> <?= $this->webLanguage['For Order Please Install Livestoc App']?></a>
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
</body>