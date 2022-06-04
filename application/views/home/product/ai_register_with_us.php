<section>
        <div class="liv-all-animals primary-grey champ-bull-listing">
           <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
            <div class="container-fluid p0">
                <div class="row position-relative">
                  <div class="col-12">
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
                ajaxloader.load("<?php echo base_url('new_api/get_near_by_ai_worker') ?>?langitude=76.6946278&latitude=30.7167433", function(resp){
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
                                    var perm_status = '';
                                    var numb = item.distance;
                                    numb = parseFloat(numb).toFixed(4);
                                    pre = '';
                                    if(item.image !== null){
                                      image = '<span class="card1"><img src="'+item.image+'" alt="AiImage" style="height: 120px;width: 100px;"></span>';
                                    }else{
                                        image = '<span class="card1" ><img src="<?= base_url('../uploads_new/profile/') ?>1615888678.jpg" alt="AiImage" style="height: 120px;width: 100px;"></span>';
                                    }
                                    if(item.status !== '0'){
                                      perm_status = '<p class="label success" style="margin-left: 20px;background-color: #659D32;color: white;">premium</p>';
                                    }
                                   tr+='<div class="col-lg-4 col-md-6 col-sm-6 mb-4"><div class="dealer_card "><div class="row">\
                                             <div class="col-md-4">'+image+'</div>\
                                              <div class="col-md-8">\
                                                <h4>'+item.username+'</h4>\
                                                <div class="address">\
                                                   <div><?= $this->webLanguage['Referral Code']?>:</div>\
                                                   <div class="div">\
                                                      <strong>'+item.refral_code+'</strong>\
                                                   </div>\
                                                </div>\
                                                <div class="address">\
                                                   <div><?= $this->webLanguage['Experience']?>:</div>\
                                                   <div class="div">\
                                                      <strong>'+item.total_experience+' Year</strong>\
                                                   </div>\
                                                </div>\
                                                <div class="address">\
                                                   <div>Address:</div>\
                                                   <div><strong>'+item.state+'</strong></div>\
                                                </div>\
                                                <div class="address">\
                                                   <div><?= $this->webLanguage['Distance']?>:</div>\
                                                   <div><strong>'+numb+' <?= $this->webLanguage['K.M']?></strong></div>\
                                                </div>\
                                             </div>\
                                             <lable>'+perm_status+'</lable>\
                                          </div>\
                                          <div class="see">\
                                             <div class="see_a">\
                                                <a class="see-animal2"><?= $this->webLanguage['No. of AI Done']?> :'+item.no_of_ai+'</a>\
                                             </div>\
                                             <div class="see_a">\
                                               <a class="see-animal2"><?= $this->webLanguage['Successful AI(s)']?>:'+item.succes_ai+'</a>\
                                             </div>\
                                          </div></div></div>\
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