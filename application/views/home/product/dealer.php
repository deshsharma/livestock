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
                    <div class="dropdown-item row mt-3">
                    </div>
                    <div class="dropdown-item row mt-3">
                    </div>
                   
                </div>
                <div class="row element">
                  <div class="col-12 col-sm-6 col-md-6 col-lg-4 ">

                  </div>
              </div>

            </div>
          </div>
</section>
<!-- <section>
  <div class="liv-all-animals primary-grey champ-bull-listing">
  <div class="row element ">
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 ">
      
      </div>
    </div>
  </div>
</section> -->
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
  ajaxloader.load("<?php echo base_url('harpahu_merge/api/get_user_type').'?id=' ?>"+id+"&status="+status+"&type="+$()+"&start="+start+"&perpage="+per_page+"&region="+person+"category_id="+category_id+"gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"agefrom="+min_age+"ageto="+max_age, function(resp){
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

                ajaxloader.load("<?php echo base_url('harpahu_merge/api/get_user_type') ?>?category_id="+$("#animal_category").val()+"&latitude=30.7166839&name=&start=0&language=en&type=5&longitude=76.6946636", function(resp){
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
                                    pre = '';
                                    if(item.is_premium !== '0'){
                                      address = '<span class="card1" >'+item.address+'</span>';
                                      pre = '<span style="position: absolute;margin-left: -69px;" ><img src="<?= base_url('../uploads_new/profile/') ?>premium_logo.png" alt="premium" style="width: 71px"></span>';
                                    }else{
                                      address = '<span class="card1" >xxxxxxxxxxxx</span>';
                                    }
                                    if(item.is_premium !== '0'){
                                      district = '<span class="card1" >'+item.district+'</span>';
                                    }else{
                                      district = '<span class="card1" >xxxxxxxxxxxx</span>';
                                    }
                                    if(item.image !== null){
                                      image = '<span class="card1" ><img src="'+item.image+'" alt="Avatar" style="width: 43%;"></span>';
                                    }else{
                                        image = '<span class="card1" ><img src="<?= base_url('../uploads_new/profile/') ?>1615888678.jpg" alt="Avatar" style="width: 43%;"></span>';
                                    } 
                                   tr+='<div class="white-bg-container container1">\
                                    <div class="card1  ">\
                                      <div class="">'+image+pre+'</div>\
                                        <div class="container">\
                                          <h4><b> '+item.full_name+'</b></h4>\
                                          <p><strong>Farm Name </strong>: '+item.farm_name+'</p>\
                                          <p><strong>Address </strong>: '+address+'</p>\
                                          <p><strong> District </strong>: '+district+'</p>\
                                          <p><strong>Category</strong>: '+item.category[0].category+'</p>\
                                        </div>\
                                      </div>\
                                      <a href="#" class="call_now"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a>\
                                    </div>\
                                    ';
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
