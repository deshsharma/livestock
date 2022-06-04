<section>
        <div class="liv-all-animals primary-grey champ-bull-listing">
           <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
            <div class="container-fluid p0">
                <div class="row position-relative">
                    <div class="col-12 col-md-6 filtr">
                      
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
                        <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 50%;">
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
  ajaxloader.load("<?php echo base_url('webservices_new_dev/animals/get_user_bull_list').'?id=' ?>"+id+"&status="+status+"&type="+$()+"&start="+start+"&perpage="+per_page+"&region="+person+"category_id="+category_id+"gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"agefrom="+min_age+"ageto="+max_age, function(resp){
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
                ajaxloader.load("<?php echo base_url('webservices_new_dev/animals/get_user_bull_list') ?>?breed_id=&longitude=76.6947301&latitude=30.7167342&gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"&category_id="+$("#animal_category").val()+"&lactation=&agefrom="+$("#min_age").val()+"&users_id=&listtype="+$('#type').val()+"&page=1&ageto="+$("#max_age").val()+"&isactivated=1", function(resp){
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
                                    var type = '';
                                    var name = '';
                                    var prem = '';
                                    var prog = '';
                                    var imp = '';
                                    var nor = '';
                                    var dam = '';
                                    var daut = '';
                                    var numb = item.distance;
                                    dist = parseFloat(numb).toFixed(2);
                                    if(item.meeting_status == '1'){
                                      prem = '<span>Premium</span>';
                                    }else{
                                      prem = '<span>Non Premium</span>';
                                    }
                                    if(item.ispremium != '0'){
                                      name = '<spam>'+item.bull_detail.contact_name+'</spam>';
                                    }else{
                                      name = '<spam>xxxxxx</spam>';
                                    }
                                    if(item.bull_detail.progini_test == 'YES'){
                                      prog = '<a>Progeny Tested</a>';
                                    }
                                    if(item.bull_detail.is_imported == 'YES'){
                                      imp = '<a>Imported</a>';
                                    }
                                    if(item.bull_detail.semen_type == 'Normal'){
                                      nor = '<a>Normal</a>';
                                    }
                                    if(item.bull_detail.lat_yield !=''){
                                      dam  = '<spam>'+item.bull_detail.lat_yield+' Kg</spam>';
                                    }else{
                                      dam  = '<spam>Not Given</spam>';
                                    }
                                    if(item.bull_detail.daughter_yield !=''){
                                      daut  = '<spam>'+item.bull_detail.lat_yield+' Kg</spam>';
                                    }else{
                                      daut  = '<spam>Not Given</spam>';
                                    } 
                                   tr+=' <div class="col-lg-3 col-sm-6">\
                                              <div class="bull">\
                                                  <div class="picture">\
                                                      <img src="'+item.animals_images[0].images+'" width="100%" alt="">\
                                                  </div>\
                                                  <div class="content">\
                                                      <div class="pre">\
                                                          <div class="pre_left">\
                                                              <a >'+prem+'</a>\
                                                          </div>\
                                                          <div class="pre_right">\
                                                              <a href="#"><i class="fa fa-play-circle"></i> Watch Video</a>\
                                                          </div>\
                                                      </div>\
                                                      <div class="id">\
                                                          <strong>'+item.category+' # '+item.animal_id+'</strong>\
                                                          <span>'+item.breed_name+'</span>\
                                                      </div>\
                                                      <div class="dams_main">\
                                                          <div class="dams">\
                                                              <div class="column">\
                                                                  <span>Dam\' s Yield</span>\
                                                                  <strong>'+dam+'</strong>\
                                                              </div>\
                                                              <div class="column">\
                                                                  <span>Daughter\' s Yield</span>\
                                                                  <strong>'+daut+' </strong>\
                                                              </div>\
                                                              <div class="column">\
                                                                  <span>Straw s Price</span>\
                                                                  <strong><i class="fa fa-inr"></i> '+item.bull_detail.semen_price+'</strong>\
                                                              </div>\
                                                          </div>\
                                                          <div class="tags">'+nor+''+prog+''+imp+'\
                                                          </div>\
                                                      </div>\
                                                      <div class="s_name">\
                                                          <div class="name">\
                                                              <div class="s_name_left">\
                                                                  <img src="'+item.user_image+'" alt="">\
                                                              </div>\
                                                              <div class="s_name_right">\
                                                                  <h4>Owner Name: '+name+'</h4>\
                                                                  <p>'+dist+' Km</p>\
                                                              </div>\
                                                          </div>\
                                                          <div class="call_bt">\
                                                              <a href="#"><i class="fa fa-phone"></i></a>\
                                                          </div>\
                                                      </div>\
                                                  </div>\
                                                  <div class="wish">\
                                                      <a target="__blank" href="https://web.whatsapp.com/send?text='+item.animals_images[0].images+'"><i class="fa fa-share"></i></a>\
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