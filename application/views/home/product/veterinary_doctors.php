<?php //print_r($_REQUEST['id']);?>
<section>
        <div class="liv-all-animals primary-grey champ-bull-listing">
          <input type="hidden" name="speci_id" id="speci_id" value="<?= $_REQUEST['id']?>">
          <input type="hidden" name="exper" id="expert_list" value="<?= $_REQUEST['type']?>">
           <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
            <div class="container-fluid p0">
                <div class="row position-relative">
                    <div class="col-12 col-md-6 filtr">
                        <select  id="animal_category" onchange="get_data_type('')" class="viewall float-right dropdown-toggle" style="border: 2px solid rgba(0,0,0,0.3);color: #60aade; padding: 6px 15px;margin-right: 20px;">
                          <?php $cat_data = $this->api_model->get_data('isactivated="1"' ,'category','', '', '', '');
                          //$cat_data = $this->api_model->get_category(); 
                           ?>
                          <option value="">Expertise</option>
                            <?php foreach($cat_data as $d){ ?>
                              <option value="<?= $d['category_id'] ?>" ><?= $d['category'] ?></option>
                          <?php } ?>
                        </select>
                         <select  id="select_languages" onchange="get_data_type('')" class="viewall float-right dropdown-toggle" style="border: 2px solid rgba(0,0,0,0.3);color: #60aade; padding: 6px 15px;margin-right: 20px;">
                             <?php $cat_data =  $this->api_model->get_prefered_language();  ?>
                                <option value="">Languages Known </option>
                                    <?php foreach($cat_data as $d){ ?>
                                        <option value="<?= $d['lang_id'] ?>" ><?= $d['lang_name'] ?></option>
                                    <?php } ?>
                        </select>
                        <select  id="select_Charges" onchange="get_data_type('')" class="viewall float-right dropdown-toggle" style="border: 2px solid rgba(0,0,0,0.3);color: #60aade; padding: 6px 15px;margin-right: 20px;">
                                <option value="">Visit Charges</option>                                    
                                <option value="0" >Low to High</option>
                                <option value="1" >High to Low</option>
                                    
                        </select>
                    </div>
                    
                    <div class="col-12">
                    </div>
                    <div class="dropdown-item row mt-3"style="visibility: hidden">
                    </div>
                    <div class="dropdown-item row mt-3" style="visibility: hidden">
                    </div>                   
                </div>
                 <div class="clearfix"></div>
                <div class="container-fluid px-0" id="lat_demo">
                  <div class="row element">
                  <div class="form-group ref" style="text-align: center;margin-top: 0px;width: 103%;height: 228px;display:none;">
                        <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 50%;">
                     </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                 <!--  <div class="container-fluid px-0">
                    <div class="row element">
                         
                    </div>
                </div> -->
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
function Request(lead_user_id , type){
  if (confirm('Should we forwad yor request to connect with this Dealer?')) {
    var perposs = 'Interested to Buy or Sell Animals';

        ajaxloader.load("<?php echo base_url('api/lead_dealer_breader')?>?lead_user_id="+lead_user_id+"&users_id="+$('#users_id').val()+"&type="+type+"&perposs="+perposs+ function(resp){
                              location.reload(true);  
                });
  }
}
// function Request(){
//   alert('this is testing');
// }
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
                ajaxloader.load("<?php echo base_url('harpahu_merge/api/get_all_doc_by_visit') ?>?premium_type=&langitude=76.6946086&speci_id="+$("#speci_id").val()+"&latitu=30.716722&distance=50&languages="+$("#select_languages").val()+"&name=&start=0&visiting_set="+$("#select_Charges").val()+"&type="+$("#expert_list").val()+"&expertise="+$("#animal_category").val()+"", function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                              var tr1 = '';
                            if(str.error){ 
                              tr += "<div class='col-md-12' align='center'>No Listing Found in Your Area.</div>";
                              }
                              else{
                                var result = str.data;
                                $('#count').val(str.total);
                                $('.element').html();
                                $('.element1').html();          
                                delete str.total ;
                                  $.each(result, function(index, item){
                                    var status = ''; 
                                    var featured = '';
                                    var request = '';
                                    var numb = item.distance;
                                    numb = parseFloat(numb).toFixed(4);
                                    pre = '';
                                    if(item.image !== null){
                                      image = '<span class="card1" ><img src="'+item.image+'" alt="doctor" style="height: 120px;width: 100px;"></span>';
                                    }else{
                                        image = '<span class="card1" ><img src="<?= base_url('../uploads_new/profile/') ?>1615888678.jpg" alt="Avatar" style="height: 120px;width: 100px;"></span>';
                                    }
                                    if(item.online_for_visit !== '0' && item.online_for_visit !== 'NULL'){
                                        request = '<div class="see_call2"style="background-color: #163547;">\
                                                <a href="#" class="call" style="color: white;" >Send Request</a>\
                                             </div>\
                                             ';
                                    }else{
                                        request = '<div class="see_call2"style="background-color: #e6eef7;">\
                                                <label class="call" >Send Request</label>\
                                             </div>\
                                             ';
                                    }
                                    tr+='<div class="col-lg-4 col-md-6 col-sm-6 mb-4">\
                                       <div class="dealer_card">\
                                          <div class="row ">\
                                             <div class="col-md-4 col-4">\
                                                <div class="picture">'+image+'</div>\
                                             </div>\
                                             <div class="col-md-8 col-8">\
                                                <h4>'+item.username+'</h4>\
                                                <div class="address"><strong>'+item.qualification[0]['qualification_name']+'</strong></div>\
                                                <div class="address">Designation<strong>: '+item.experience[0]['designation']+'</strong>\
                                                </div>\
                                                <div class="address">Experience :<strong>'+item.total_experience+'Year</strong></div>\
                                                <div class="address">Experties:<strong>'+item.expertise_list+'</strong></div>\
                                                <div class="address">Institutes:<strong>'+item.qualification[0]['institute']+'</strong></div>\
                                                </div>\
                                          </div>\
                                          <div class="address pt-1">\
                                             <div>Can Speak:</div>\
                                             <div class="div">\
                                                <strong>'+item.languages+'</strong>\
                                             </div>\
                                          </div>\
                                          <div class="address pt-1">\
                                             <div>Specialization:</div>\
                                             <div class="div">\
                                                <strong>'+item.qualification[0]['speci_name']+'</strong>\
                                             </div>\
                                          </div>\
                                          <div class="location">\
                                             <div><i class="fa fa-map-marker"></i></div>\
                                             <div class="km"><strong>'+numb+'KM</strong> <a href="#">'+item.address+'</a></div>\
                                          </div>\
                                          <div class="see">\
                                             <div class="see_a">\
                                                <a href="#" class="see-animal"> Visit Charges : &#8377; '+item.visiting_fee+'</a>\
                                             </div> '+request+'</div>\
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
   var x = $("#lat_demo");
   $(document).ready(function(){
    getLocation();
   })
      function getLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
              alert("Geolocation is not supported by this browser.");
          }
      }
      function showPosition(position) {
        $('#form_lat script').attr('data-notes.lat', position.coords.latitude);
        $('#form_lat script').attr('data-notes.long', position.coords.longitude);
          //alert("Latitude: " + position.coords.latitude +  "<br>Longitude: " + position.coords.longitude);
      }
</script>