<?php //print_r($_REQUEST['id']);?>
<section>
  <div class="liv-all-animals primary-grey champ-bull-listing">
    <input type="hidden" name="speci_id" id="speci_id" value="<?= $_REQUEST['id']?>">
    <input type="hidden" name="exper" id="expert_list" value="<?= $_REQUEST['type']?>">
    <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
    <div class="container-fluid p0">
      <div class="row position-relative">
        <div class="col-12">
        </div>
       <!-- <div class="dropdown-item row mt-3"style="visibility: hidden">
          </div>   -->                
        </div>
        <div class="clearfix"></div>
          <div class="container-fluid px-0">
            <div class="row element">
              <!-- <div class="col-lg-4 col-md-6 col-sm-6 mb-4">                                         
                <div class="dealer_card1">   
                  <div class="row">
                    <div class="col-md-6 col-6">
                      <strong>Type  </strong>
                      <div>Veterinary Doctor</div> 
                      <div>Phone</div> 
                      <div>Date</div>
                      <div>OTP</div> 
                      <div>Status</div> 
                    </div>                                               
                    <div class="col-md-6 col-6">                                                  
                      <strong>: Home Visit</strong> 
                      <div class="address"> 
                        <div>: jarnail singh</div>
                        <div>: <a href="tel:9041859336">9041859336 <i class="fa fa-phone" aria-hidden="true"></i></a></div>
                        <div>: 2021-02-26</div>
                        <div>: 1624</div>
                        <div>: Completed</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->

               <!-- <div><img src="https://www.livestoc.com/uploads/logo/green_call_icon.png"><div>\ -->
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
      window.location.href = "<?= base_url() ?>homenew/my_request";
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

        ajaxloader.load("<?php echo base_url('api/get_user_treat_request')?>?users_id="+$('#users_id').val()+"&users_id="+$('#users_id').val()+"&type="+type+"&perposs="+perposs+ function(resp){
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

                ajaxloader.load("<?php echo base_url('api/get_user_treat_request') ?>?users_id=2", function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                              var tr1 = '';
                            if(str.error){ 
                              tr += "<div class='col-md-12' align='center'>You do not have any request at the moment.</div>";
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
                                    if(item.status == '1'){
                                      status = '<spam>Accepted</spam>';
                                    }else if(item.status == '2'){
                                      status = '<spam>Rejected</spam>';
                                    }else if(item.status == '3'){
                                      status = '<spam>Canceled</spam>';
                                    }else if(item.status == '4'){
                                      status = '<spam>Completed</spam>';
                                    }else if(item.status == '5'){
                                      status = '<spam>Started</spam>';
                                    }else{
                                      status = '<spam>Rescheduled</spam>';
                                    } 
                                    tr+='<div class="col-lg-4 col-md-6 col-sm-6 mb-4">\
                                            <div class="dealer_card1">\
                                              <div class="row">\
                                              <div class="col-md-12 col-12">Type : <strong>Home Visit</strong>\
                                                  <div class="address">\
                                                    <div>Veterinary Doctor : <strong>'+item.doctor_name+'</strong></div>\
                                                    <div>Phone : <strong>'+item.doctor_mobile+'</strong><a href="tel:'+item.doctor_mobile+'"><img src="https://www.livestoc.com/uploads/logo/green_call_icon.png" style="margin-left: 125px;height: 24px;"></a></div>\
                                                    <div>Date : <strong>'+item.created_on+'</strong></div>\
                                                    <div>OTP : <strong>'+item.otp+'</strong></div>\
                                                    <div>Status : <strong>'+status+'</strong></div>\
                                                  </div>\
                                                </div>\
                                              </div>\
                                            </div>\
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
