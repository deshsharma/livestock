<style>
div.a {
  font-size: 15px;
}
</style>
<section>
  <div class="liv-all-animals primary-grey champ-bull-listing">
    <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
    <div class="container-fluid p0">
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
function Call(number){
  alert(number);
}

      function loadData(start,per_page,event_type){
                  $('.ref').show();
                ajaxloader.load("<?php echo base_url('api/get_lab_detail') ?>?langitude=76.6946064&latitude=30.7167227&users_id=2&id=1", function(resp){
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
                                    numb = parseFloat(numb).toFixed(2);
                                    pre = '';
                                   tr+='<div class="col-lg-4 col-md-6 col-sm-6 mb-4">\
                                       <div class="dealer_card">\
                                       <div class="address pt-1">\
                                             <div><strong> '+item.business_name+'</strong></div>\
                                          </div>\
                                          <div class="address pt-1">\
                                             <div><strong><?= $this->webLanguage['Contact Person']?>: </strong></div>\
                                             <div class="div"> '+item.name+'</div>\
                                          </div>\
                                          <div class="address pt-1">\
                                             <div><strong><?= $this->webLanguage['Phone Number']?>: </strong></div>\
                                             <div class="div"> '+item.phone+'</div>\
                                          </div>\
                                          <div class="address pt-1">\
                                             <div><strong><?= $this->webLanguage['ADDRESS']?>: </strong></div>\
                                             <div class="div"> '+item.adress+'</div>\
                                          </div>\
                                          <div class="location">\
                                             <div class="km"><strong>'+numb+' KM</strong></div>\
                                          </div>\
                                          <div class="see">\
                                          <label onclick="Call('+item.phone+')" class="form-control" for="exampleFormControlFile1" style="text-align: center;background-color: #48ade4;font-color: white;color: white;"><?= $this->webLanguage['Call Now']?></label>\
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