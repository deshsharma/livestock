<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}
.topright {
  position: absolute;
  /*top: 145px;
  right: 137px;*/
  /*font-size: 18px;*/
}
.container1 {
  position: relative;
}
.container1 .call_now {
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 100%;
    text-align: center;
    background-color: var(--blue);
    color: #fff;
    padding: 10px;
    display: block;
}
.container1 {
    background-color: #fff;
    padding: 10px;
    position: relative;
    margin-bottom: 25px;
}
</style>
<section>
        <div class="liv-all-animals primary-grey champ-bull-listing">
           <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
            <div class="container-fluid p0">
                <div class="row position-relative">
                    <div class="col-12 col-md-6 filtr">
                        <select  id="animal_category" onchange="get_data_type('')" class="viewall float-right dropdown-toggle" style="border: 2px solid rgba(0,0,0,0.3);color: #60aade; padding: 6px 15px;margin-right: 20px;">
                          <?php $cat_data = $this->api_model->get_data('isactivated="1"' ,'category','', '', '', '');
                          //$cat_data = $this->api_model->get_category(); 
                           ?>
                          <option value="">Select Category </option>
                            <?php foreach($cat_data as $d){ ?>
                              <option value="<?= $d['category_id'] ?>" ><?= $d['category'] ?></option>
                          <?php } ?>
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
                       <div class="row ">
                         <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                             <div class="dealer_card1">
                                <div class="row">
                                   <div class="col-md-3 col-3">
                                      <div class="picture1">
                                         <img src="https://media.istockphoto.com/photos/young-woman-portrait-in-the-city-picture-id1009749608?k=6&m=1009749608&s=612x612&w=0&h=ckLkBgedCLmhG-TBvm48s6pc8kBfHt7Ppec13IgA6bo=" width="100%" alt=""style="border-radius: 50%;width: 69px;height: 62px;">
                                      </div>
                                   </div>
                                   <div class="col-md-8 col-8">
                                      <h5>Sobhnath</h5>
                                      <div class="address">
                                         <div>District:</div>
                                         <div>Sahibzada Ajit Singh Nagar</div>
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

                ajaxloader.load("<?php echo base_url('api/get_all_doc_by_premium') ?>?premium_type=0&langitude=76.6946086&speci_id=89&latitu=30.716722&distance=50&languages=&name=&start=0&visiting_set=&type=expert_in_medicine&expertise=", function(resp){
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
                                      image = '<span class="card1" ><img src="'+item.image+'" alt="Avatar" width="100%"></span>';
                                    }else{
                                        image = '<span class="card1" ><img src="<?= base_url('../uploads_new/profile/') ?>1615888678.jpg" alt="Avatar" style="width: 100%;"></span>';
                                    } 
                                   tr+='';
                                      }); 
                              }
                           $('.element').html(tr);                      
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
