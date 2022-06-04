<section>
        <div class="liv-all-animals primary-grey champ-bull-listing">
           <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
            <div class="container-fluid p0">
                <div class="row position-relative">
                    <div class="col-12 col-md-6 filtr">
                       <!-- <div class="dropdown">
                          <a class="viewall float-right dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More Filters
                          </a>
                          <div class="dropdown-menu dropdown-menu-right filters" aria-labelledby="dropdownMenuButton">
                            <div class="dropdown-item row">
                              <input type="hidden" name="type" id="type" value="1">
                                <div class="col-6">
                                <p class="mb-0">Select Gender</p>      
                                </div>    
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                      <input type="hidden" name="inlineRadioOptions" id="inlineRadioOptions" value="">
                                      <input class="form-check-input gender" type="radio" name="inlineRadioOptions" id="male" value="Male" checked="checked">
                                      <label class="form-check-label gender" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="male" value="Female">
                                      <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                </div>
                            </div>  
                            <div class="dropdown-item row mt-3">
                                <div class="col-6">
                                <p class="mb-0">Price Range</p>      
                                </div>    
                                <div class="col-12">
                                    <input type="text" class="form-control mr-3" id="min_price" placeholder="Min">
                                    <input type="text" class="form-control" id="max_price" placeholder="Max">
                                </div>
                            </div>  
                            <div class="dropdown-item row mt-5">
                                <div class="col-6">
                                <p class="mb-0" >Age</p>      
                                </div>    
                                <div class="col-12">
                                    <input type="text" class="form-control mr-3" id="min_age" placeholder="Min">
                                    <input type="text" class="form-control" id="max_age" placeholder="Max">
                                </div>
                            </div> 
                            <div class="dropdown-item row mt-5">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" onclick="filter()">Apply</button>
                                    <a id="clear" onclick="filter()">clear filters</a>
                                </div>
                            </div>
                          </div>
                        </div> -->
                        <select  id="animal_category" onchange="get_data_type('')" class="viewall float-right dropdown-toggle" style="border: 2px solid rgba(0,0,0,0.3);color: #60aade; padding: 6px 15px;margin-right: 20px;">
                          <?php $cat_data = $this->api_model->get_data('category_id IN(8,1) AND isactivated="1"' ,'category','', '', '', '');
                          //$cat_data = $this->api_model->get_category(); 
                           ?>
                          <option value="">Select Category </option>
                            <?php foreach($cat_data as $d){ ?>
                              <option value="<?= $d['category_id'] ?>" ><?= $d['category'] ?></option>
                          <?php } ?>
                        </select>
                        
                    </div>
                    
                    <div class="col-12">
                      <!-- <a  class="btn btn-primary champ-reg" onclick="reg()"> Register Champion Bull</a> -->
                    </div>
                   
                </div>
                <div class="row element">
                  <div class="col-12 col-sm-6 col-md-6 col-lg-4 ">
                  <div class="form-group ref" style="text-align: center;margin-top: 0px;width: 103%;height: 228px;display:none;">
                        <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 100%;">
                     </div>
                  </div>
              </div>

            </div>
          </div>
</section>
<?php include('footer_new.php'); ?>
<script type="text/javascript" src="<?= base_url('assets/main/js/ajaxloader.js')?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript">
 var num_display_entries,items_per_page,num_entries,start;
 var min_age,max_age,category_id,min_price,max_price,gender;
 app_url = "<?= base_url('/frontend'); ?>";
 function reg(){
    if($('#users_id').val() == '0'){
      window.location.href = "<?= base_url() ?>frontend/login";
    }else{
      window.location.href = "<?= base_url() ?>homenew/champion_bull";
    }
  }
function get_data_type(type){
    if(type != ''){
       $('#type').val(type);
    }else{
      type = $('#type').val();
    }
    loadData(0,$('#items_per_page').val(),'ready');
}
function filter(inlineRadioOptions){
   var gender= $("input:radio[name=inlineRadioOptions]:checked").val();
    var min_age = $("#min_age").val();
    var max_age =  $("#max_age").val();
    var category_id =  $("#animal_category").val();
    var min_price = $("#min_price").val();
    var max_price =  $("#max_price").val();  
    loadData(0,$('#items_per_page').val(),'ready');
    //alert(min_age);
}
 function status(id , status){
  if (confirm('Are you sure you want to change the status')) {
    var person = '';
      if(status == '2'){
        person = prompt("Please Enter Rejection Region", "Enter Hear");
        if(person == ''){
          exit;
        }
      }
      var per_page = $('#items_per_page').val();
      start = 0;
  ajaxloader.load("https://www.livestoc.com/webservices_new_2/animals/get_user_bull_list?id='"+id+"&status="+status+"&type="+$()+"&start="+start+"&perpage="+per_page+"&region="+person+"category_id="+category_id+"gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"agefrom="+min_age+"ageto="+max_age, function(resp){
                              location.reload(true);  
                });
  }
 }

 $(document).ready(function() {
        $('#product_name').keypress(function (e) {
            if (e.which == 13) {
                filterData();
                return false;    
              }
        });

        items_per_page = $('#items_per_page').val();
        num_display_entries = $('#num_display_entries').val();
        items_per_page = $('#items_per_page').val();
        loadData(0,items_per_page,'ready');
 });

    function pageselectCallback(page_index, jq, event_type){
        start = page_index*items_per_page
        if(typeof event_type == 'undefined')
             loadData(start,items_per_page,event_type)
        return false;
     }
     function initPagination() {
        try{
              num_entries = $('#count').val();
              $("#Pagination").pagination(num_entries, {
                num_display_entries: num_display_entries,
                items_per_page:items_per_page,
                callback: pageselectCallback
              });
           }
           catch(ex){}
     }  

      function loadData(start,per_page,event_type){
                     $('.ref').show();
                ajaxloader.load("https://www.livestoc.com/webservices_new_2/animals/get_user_bull_list?breed_id=&longitude=&latitude=&gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"&category_id="+$("#animal_category").val()+"&lactation=&agefrom="+$("#min_age").val()+"&users_id=&listtype="+$('#type').val()+"&page=1&ageto="+$("#max_age").val()+"&isactivated=1", function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                            if(str.error){ 
                              tr += "<div class='col-md-12' align='center'>We are in process of updating the listings please check after 48 Hrs.</div>";
                              }
                              else{
                                var result = str.data;
                                $('#count').val(str.total);
                                $('.element').html();         
                                delete str.total ;
                                  $.each(result, function(index, item){
                                    var status = ''; 
                                    var featured = ''; 
                                   tr+='<div class="white-bg-container">\
                                      <div class="card">\
                                          <img class="card-img-top" src="'+item.animals_images[0].images+'" alt="Card image cap" style="height: 201px;">\
                                          <div class="card-body p-0 sellanimals sellanimals">\
                                            <div class="row">\
                                                <div class="col-6 pr-0">\
                                                  <div class="neon-blue p-2 pl-3">\
                                                    <p class="mb-0">Premium</p>\
                                                  </div>\
                                                </div>\
                                                <div class="col-6 pl-0 text-right">\
                                                  <div class="dblue p-2 pr-3">\
                                                    <p class="mb-0"><a class="myvid" data-link="<?= base_url('uploads/product/')?><?= base_url('uploads/product/')?>'+item.bull_video+'" data-vedio="'+item.bull_video+'"> <i class="fas fa-play pr-2"></i> Watch Video</a></p>\
                                                  </div>\
                                                </div>\
                                              </div>\
                                              <div class="row">\
                                                <div class="col-12">\
                                                    <div class="p-2 pl-3">\
                                                    <h4 class="mb-1"><strong>'+item.category+'</strong> #'+item.animal_id+'</h4>\
                                                    <p class="mb-0">'+item.breed_name+'</p>\
                                                    </div>\
                                                </div>\
                                              </div>\
                                              <div class="row">\
                                                <div class="col-6 pr-0">\
                                                    <div class="primary-grey pt-3 pl-3">\
                                                      <p>Daughter\'s Yield <strong><br>Not Given</strong></p>\
                                                      <p>Dom\'s Yield: <strong><br>'+item.bull_detail.lat_yield+' kg</strong></p>\
                                                    </div>\
                                                </div>\
                                                <div class="col-6 pl-0">\
                                                    <div class="primary-grey pt-3 pr-3 text-right">\
                                                      <p>Straw\'s Price <strong><br>Rs '+item.bull_detail.semen_price+'</strong></p>\
                                                    </div>\
                                                </div>\
                                              </div>\
                                              <div class="row">\
                                                <div class="col-12">\
                                                    <div class="primary-grey pl-3 pr-3">\
                                                        <ul class="list-inline champ-tags">\
                                                            <li class="list-inline-item"><strong>Normal: </strong>'+item.bull_detail.semen_type+'</li>\
                                                            <li class="list-inline-item"><strong>Progeny Tested: </strong>'+item.bull_detail.semen_type+'</li>\
                                                            <li class="list-inline-item"><strong>Imported: </strong>'+item.bull_detail.is_imported+'</li>\
                                                        </ul>\
                                                    </div>\
                                                </div>\
                                              </div>\
                                              <div class="row">\
                                                <div class="col-3 pr-0">\
                                                    <img src="'+item.user_image+'" class="img-fluid">\
                                                </div>\
                                                  <div class="col-6 pr-0 pt-2">\
                                                      <p class="mb-0 mt-1"><strong>Owner Name : '+item.bull_detail.contact_name+' </strong></p>\
                                                      <p class="mb-0">0.01km</p>\
                                                  </div>\
                                                  <div class="col-3 pl-0">\
                                                    <a href="" class="btn btn-primary btn-call"><i class="fa fa-phone-square" aria-hidden="true"></i></a>\
                                                  </div>\
                                              </div>\
                                          </div>\
                                          <div class="wishlist">\
                                            <li class="fas fa-share-alt share"><button type="button" class="btn btn-dropdown-share dropdown-toggle" data-toggle="dropdown">Share</button>\
                                                <ul class="dropdown-menu social-media-share">\
                                                     <?php
                                                    $useragent=$_SERVER['HTTP_USER_AGENT'];
                                                    if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){ 
                                                    ?>
                                                        <li><a  target="__blank" href="https://api.whatsapp.com/send?text='+item.animals_images[0].images+'"><span class="fa fa-whatsapp mr10"></span>whatsapps</a></li>\
                                                    <?php }else{ ?>
                                                        <li><a target="__blank" href="https://web.whatsapp.com/send?text='+item.animals_images[0].images+'"><span class="fa fa-whatsapp mr10"></span>whatsapps</a></li>\
                                                    <?php } ?><br>\
                                                    <li><a href="http://www.facebook.com/sharer.php?u=https://www.livestoc.com/all_videos&p[title]=video livestoc"><span class="fa fa-facebook mr10"></span> Facebook</a></li><br>\
                                                    <li><a href="https://www.instagram.com/share?text=videoForview&url=https://www.livestoc.com/all_videos"><span class="fa fa-instagram mr10"></span> Instagram</a></li><br>\
                                                    <li><a href="http://twitter.com/share?text=video livestoc&url=https://www.livestoc.com/all_videos"><span class="fa fa-twitter mr10"></span> Twitter</a></li>\
                                                </ul>\
                                            </li>\
                                          </div>\
                                      </div>\
                                    </div>\
                                    ';
                                      }); 
                              }
                           $('.element').html(tr);
                           $('.ref').hide();                      
                      // if(!result){
                      //    $('#Pagination').hide();
                      // }
                      // else
                      // {
                        $('#Pagination').show();
                      //}
                      if(event_type == 'ready')
                         initPagination();
                });
       };
     filterData = function (){
           loadData(0,$('#items_per_page').val(),'ready');
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
    
    

});          
</script>
<script>
    $('.myvid').click(function(){
        //alert($(this).data('link'));
        /*if($(this).data('vedio')!=''){
            var html = '<video width="100%" height="100%" controls>\
          <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">\
          <source src="https://www.w3schools.com/tags/movie.mp4" type="video/ogg">\
          Your browser does not support the video tag.\
        </video>';
            $('.vid_link').html(html);
        }*/
        if($(this).data('vedio')!=''){
            $.ajax({
            type: "POST",
            url: "<?= base_url('frontend/') ?>"+"check_video_block",
            data: {video_id: $(this).data('vedio')},
            dataType: "json",
            cache : false,
            success: function(data){
              if((data.msg == 'Your Request is already Submitted')) {
                var video_link = data.video_url[0]['video'];
                var html = '<div class="box-body">\
                    <div style="text-align:center">\
                      <button class="btn btn-info but_set playPause">Play/Pause</button>\
                      <button class="btn btn-info but_set makeBig">Big</button>\
                      <button class="btn btn-info but_set makeSmall">Small</button>\
                      <button class="btn btn-info but_set makeNormal">Normal</button>\
                      <br><br>\
                      <video id="video1" width="250" controls>\
                      <source src="<?php echo base_url().'uploads/videos/'?>'+video_link+'" type="video/mp4">\
                      <source src="mov_bbb.ogg" type="video/ogg">\
                          Your browser does not support HTML video.\
                      </video>\
                    </div>\
                 </div>';
                  $('.vid_link').html(html);
                  var myVideo = document.getElementById("video1"); 
                  $('.playPause').click(function(){
                    if (myVideo.paused) 
                      myVideo.play(); 
                    else 
                      myVideo.pause(); 
                  }) 
                  $('.makeBig').click(function(){ 
                    myVideo.width = 560; 
                  })
                  $('.makeSmall').click(function() { 
                    myVideo.width = 320; 
                  })
                  $('.makeNormal').click(function() { 
                    myVideo.width = 420; 
                  })
              } else {
                  var html = "<p>Vedio Found You need to do payments</p>";
                  html = html+= '<div class="box-body">\
                    <div style="text-align:center">\
                      <button class="btn btn-info but_set playPause">Play/Pause</button>\
                      <button class="btn btn-info but_set makeBig">Big</button>\
                      <button class="btn btn-info but_set makeSmall">Small</button>\
                      <button class="btn btn-info but_set makeNormal">Normal</button>\
                      <br><br>\
                      <video id="video1" width="420" controls>\
                      <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">\
                      <source src="https://www.w3schools.com/tags/movie.mp4" type="video/ogg">\
                          Your browser does not support HTML video.\
                      </video>\
                    </div>\
                 </div>';
                  $('.vid_link').html(html);
                  var myVideo = document.getElementById("video1"); 
                  $('.playPause').click(function(){
                    if (myVideo.paused) 
                      myVideo.play(); 
                    else 
                      myVideo.pause(); 
                  }) 
                  $('.makeBig').click(function(){ 
                    myVideo.width = 560; 
                  })
                  $('.makeSmall').click(function() { 
                    myVideo.width = 320; 
                  })
                  $('.makeNormal').click(function() { 
                    myVideo.width = 420; 
                  }) 
                  //$('#myModal').hide();
                  //$('.vid_link').html(html)
                  //$('#myModal').hide();
              }
            } 
          });
        } else {
            var html = "<p>Vedio Found You need to do payments</p>";
            html = html+= '<div class="box-body">\
              <div style="text-align:center">\
                <button class="btn btn-info but_set playPause">Play/Pause</button>\
                <button class="btn btn-info but_set makeBig">Big</button>\
                <button class="btn btn-info but_set makeSmall">Small</button>\
                <button class="btn btn-info but_set makeNormal">Normal</button>\
                <br><br>\
                <video id="video1" width="420" controls>\
                <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">\
                <source src="https://www.w3schools.com/tags/movie.mp4" type="video/ogg">\
                    Your browser does not support HTML video.\
                </video>\
              </div>\
           </div>';
            $('.vid_link').html(html);
            var myVideo = document.getElementById("video1"); 
            $('.playPause').click(function(){
              if (myVideo.paused) 
                myVideo.play(); 
              else 
                myVideo.pause(); 
            }) 
            $('.makeBig').click(function(){ 
              myVideo.width = 560; 
            })
            $('.makeSmall').click(function() { 
              myVideo.width = 320; 
            })
            $('.makeNormal').click(function() { 
              myVideo.width = 420; 
            }) 
            //$('#myModal').hide();
            //$('.vid_link').html(html)
        }
        $('#myModal').show();
    });
    $('.close').click(function(){
        //var html = "<p>No Vedio Found</p>";
        $('#myModal').hide();
        //$('.vid_link').html(html);
    })
    /*$('.modal').click(function(){
        var html = "<p>No Vedio Found</p>";
        $('#myModal').hide();
        $('.vid_link').html(html);
    })*/
  </script>