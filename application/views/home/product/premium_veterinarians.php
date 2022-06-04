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
                <div class="container-fluid px-0">
                  <div class="row element1">
                   <!--  <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                       <div class="dealer_card">
                          <div class="row ">
                             <div class="col-md-4 col-4">
                                <div class="picture">
                                   <img src="https://media.istockphoto.com/photos/young-woman-portrait-in-the-city-picture-id1009749608?k=6&m=1009749608&s=612x612&w=0&h=ckLkBgedCLmhG-TBvm48s6pc8kBfHt7Ppec13IgA6bo=" width="100%" alt="">
                                </div>
                             </div>
                             <div class="col-md-8 col-8">
                                <h4>Sobhnath</h4>
                                <div class="address">
                                   <div>District:</div>
                                   <div><strong>Sahibzada Ajit Singh Nagar</strong></div>
                                </div>
                                <div class="address">
                                   <div>State:</div>
                                   <div><strong>Panjab</strong></div>
                                </div>
                                <div class="address">
                                   <div>Category:</div>
                                   <div><strong>Dog, Cat</strong></div>
                                </div>
                             </div>
                          </div>
                          <div class="address pt-1">
                             <div>Address:</div>
                             <div class="div">
                                <strong>c 86 phase 7 industrial area, Phase 8B, Sector 74, Sahibzada Ajit Singh Nagar, Punjab 160055, India</strong>
                             </div>
                          </div>
                          <div class="location">
                             <div><i class="fa fa-map-marker"></i></div>
                             <div class="km"><strong>8.3KM</strong> <a href="#">See location on google</a></div>
                          </div>
                          <div class="see">
                             <div class="see_a">
                                <a href="#" class="see-animal">See animal posted by dealer</a> 
                             </div>
                             <div class="see_call">
                                <a href="#" class="call"><i class="fa fa-phone"></i></a> 
                             </div>
                          </div>
                        </div>
                    </div> -->
                  </div>
                </div>
                <div class="clearfix"></div>
                  <div class="container-fluid px-0">
                    <div class="row element">
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
                ajaxloader.load("<?php echo base_url('harpahu_merge/api/get_all_doc_by_premium') ?>?premium_type=&langitude=76.6946086&speci_id="+$("#speci_id").val()+"&latitu=30.716722&distance=50&languages="+$("#select_languages").val()+"&name=&start=0&visiting_set="+$("#select_Charges").val()+"&type="+$("#expert_list").val()+"&expertise="+$("#animal_category").val()+"", function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                              var tr1 = '';
                            if(str.error){ 
                              tr += "<div class='col-md-12' align='center'>We are in process of updating the listings please check after 48 Hrs.</div>";
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
                                    var numb = item.distance;
                                    numb = parseFloat(numb).toFixed(4);
                                    pre = '';
                                    if(item.is_premium !== '0'){
                                      address = '<span class="card1" >'+item.address+'</span>';
                                      pre = '<span style="position: absolute;margin-left: -44px;" ><img src="<?= base_url('../uploads_new/profile/') ?>premium_logo.png" alt="premium" style="width: 44px"></span>';
                                    }else{
                                      address = '<span class="card1" >xxxxxxxxxxxx</span>';
                                    }
                                    if(item.is_premium !== '0'){
                                      district = '<span class="card1" >'+item.district+'</span>';
                                    }else{
                                      district = '<span class="card1" >xxxxxxxxxxxx</span>';
                                    }
                                    if(item.image !== null){
                                      image = '<span class="card1" ><img src="'+item.image+'" alt="Avatar" width="100%" style="border-radius: 50%;width: 72px;height: 72px;"></span>';
                                    }else{
                                        image = '<span class="card1" ><img src="<?= base_url('../uploads_new/profile/') ?>1615888678.jpg" alt="Avatar" style="width: 100%;" style="border-radius: 50%;width: 69px;height: 62px;"></span>';
                                    }
                                    if(item.is_premium !== '0' && item.is_premium !== '' ){
                                      if(item.image !== null){
                                      image = '<span class="card1" ><img src="'+item.image+'" alt="Avatar" width="100%"></span>';
                                       pre = '<span style="position: absolute;margin-left: -44px;" ><img src="<?= base_url('../uploads_new/profile/') ?>premium_logo.png" alt="premium" style="width: 44px"></span>';
                                    }else{
                                        image = '<span class="card1" ><img src="<?= base_url('../uploads_new/profile/') ?>1615888678.jpg" alt="Avatar" style="width: 100%;"></span>';
                                    }
                                    tr1+='<div class="col-lg-4 col-md-6 col-sm-6 mb-4">\
                                       <div class="dealer_card">\
                                          <div class="row ">\
                                             <div class="col-md-4 col-4">\
                                                <div class="picture">'+image+pre+'</div>\
                                             </div>\
                                             <div class="col-md-8 col-8">\
                                                <h4>'+item.username+'</h4>\
                                                <div class="address">'+item.qualification[0]['qualification_name']+'</div>\
                                                <div class="address">\
                                                   <div>Designation :<strong>'+item.experience[0]['designation']+'</strong></div>\
                                                </div>\
                                                <div class="address">Experience :<strong>'+item.total_experience+'Year</strong></div>\
                                                <div class="address">Experties:<strong>'+item.expertise_list+'</strong></div>\
                                                <div class="address">Institutes:<strong>'+item.qualification[0]['institute']+'</strong></div>\
                                                </div>\
                                          </div>\
                                          <div class="address pt-1">\
                                             <div>Scan Speak:</div>\
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
                                             </div>\
                                             <div class="see_call">\
                                                <a href="#" class="call"><i class="fa fa-phone"></i></a>\
                                             </div>\
                                          </div>\
                                        </div>\
                                    </div>\
                                    '; 
                                  }
                                   if(item.is_premium === '0'){
                                    tr+='<div class="col-lg-4 col-md-6 col-sm-6 mb-4">\
                                         <div class="dealer_card1">\
                                            <div class="row">\
                                               <div class="col-md-3 col-3">\
                                                  <div class="picture1">'+image+'</div>\
                                               </div>\
                                               <div class="col-md-8 col-8">\
                                                  <strong>'+item.username+'</strong>\
                                                  <div class="address">\
                                                     <div>'+item.qualification[0]['qualification_name']+'</div>\
                                                  </div>\
                                               </div>\
                                            </div>\
                                         </div>\
                                      </div>\
                                      ';
                                    }
                                      }); 
                              }
                            $('.element1').html(tr1);
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
