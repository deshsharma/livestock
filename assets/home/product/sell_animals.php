
<div class="main-content">
  <div class="foroverlay"></div>  
    <section>
      <div class="liv-all-animals primary-grey">
            <div class="container-fluid p0">
              <input type="hidden" id="animal_id" value="">
              <input type="hidden" id="count">
                <div class="row position-relative ">
                   <div class="col-12 col-md-6 filtr">
                        <div class="dropdown">
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
                        </div>
                        <select  id="animal_category" onchange="get_data_type('')" class="viewall float-right dropdown-toggle" style="border: 2px solid rgba(0,0,0,0.3);color: #60aade; padding: 6px 15px;margin-right: 20px;">
                        	
                           	 <?php $cat_data = $this->api_model->get_category();  ?>
                           	 		<option value="">Select Category </option>
                                    <?php foreach($cat_data as $d){ ?>
                                        <option value="<?= $d['category_id'] ?>" ><?= $d['category'] ?></option>
                                    <?php } ?>
                        </select>  
                    </div>
                      <div class="col-12">
                        <div class="all-animal-tab">
                            <ul class="nav nav-pills mb-4 form-tabs d-none d-md-flex" id="pills-tab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" role="tab" aria-controls="pills-all" aria-selected="true" onclick="get_data_type(1)">All</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="pills-featured-tab" data-toggle="pill"  role="tab" aria-controls="pills-featured" aria-selected="false" onclick="get_data_type(2)">Featured</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="pills-breeder-tab" data-toggle="pill" role="tab" aria-controls="pills-breeder" aria-selected="false" onclick="get_data_type(4)">Posted By Breeder</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="pills-dealer-tab" data-toggle="pill"  role="tab" aria-controls="pills-dealer" aria-selected="false" onclick="get_data_type(5)">Posted By Dealer</a>
                              </li>
                            </ul>
                            <select class="mb10 form-control d-block d-md-none mb-4" id="tab_selector" onchange="get_data_type(this.value)">
                                    <option value="1">All</option>
                                    <option value="2">Featured</option>
                                    <option value="4">Posted By Breeder</option>
                                    <option value="5">Posted By Dealer</option>
                            </select>   
                      </div>
                    </div>    
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                        <div class="row element">
                          <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                          </div>
                        </div>
                    </div>
                  </div>
                   <div class="tab-pane fade" id="pills-featured" role="tabpanel" aria-labelledby="pills-featured-tab">
                        <div class="row">
                          <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                          </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-breeder" role="tabpanel" aria-labelledby="pills-breeder-tab">
                          <div class="row">
                             <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                             </div>
                          </div>
                    </div>
                    <div class="tab-pane fade" id="pills-dealer" role="tabpanel" aria-labelledby="pills-dealer-tab">
                        <div class="row">
                          <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                          </div>
                      </div>
                    </div>
                    </div>
                    <!-- <input type="hidden" name="count" id="count" value=""> -->
                    <div class="card-footer">
                    <input type="hidden" value="20" name="num_display_entries" id="num_display_entries">
                        <ul class="pagination">
                          <li><a href="1"><<</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                          <li><a href="5">>></a></li>
                        </ul>
                      <!-- <div id="Pagination" style="text-align: center;"></div> 
                        <input type="hidden" value="50" name="items_per_page" id="items_per_page">
                        <input type="hidden" value="50" name="num_display_entries" id="num_display_entries">
                        <input type="hidden" value="Prev" name="prev_text" id="prev_text">
                        <input type="hidden" value="Next" name="next_text" id="next_text"> -->
                    </div>
                                   
                         
      </div>
    </section>
  </div>
 </div>
    
<script type="text/javascript" src="https://www.livestoc.com/harpahu_merge/assets/admin/js/jquery.pagination.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/main/js/ajaxloader.js')?>"></script>
     
   <script type="text/javascript">
 var min_age,max_age,category_id,min_price,max_price,gender;
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
  ajaxloader.load("<?php echo base_url('webservices_new_dev/animals/get_animals_list').'?id=' ?>"+id+"&status="+status+"&type="+$()+"&start="+start+"&perpage="+per_page+"&region="+person+"category_id="+category_id+"gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"agefrom="+min_age+"ageto="+max_age, function(resp){
                              location.reload(true);  
                });
  }
 }

 var num_display_entries,items_per_page,num_entries,start;
         $(document).ready(function() {
                $('#product_name').keypress(function (e) {
                    if (e.which == 13) {
                        filterData();
                        return false;    
                      }
                });
        
                items_per_page = $('#items_per_page').val();
                num_display_entries = $('#num_display_entries').val();
                loadData(0,items_per_page,'ready');
         });
        
            function pageselectCallback(page_index, jq, event_type){
                start = page_index*items_per_page
                //alert(start);
                if(typeof event_type == 'undefined')
                loadData(start,items_per_page,event_type)
                return false;
             }
             function initPagination() {
                try{
                      num_entries = $('#count').val();
                      $("#pagination").pagination(num_entries, {
                        num_display_entries: num_display_entries,
                        items_per_page:items_per_page,
                        callback: pageselectCallback
                      });
                   }	
                   catch(ex){}
             }  

      function loadData(start,per_page,event_type){

                ajaxloader.load("<?php echo base_url('webservices_new_dev/animals/get_animals_list') ?>?is_pregnant=&gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"&category_id="+$("#animal_category").val()+"&lactation=&agefrom="+$("#min_age").val()+"&users_id=&listtype="+$('#type').val()+"&page=1&ageto="+$("#max_age").val()+"&isactivated=1", function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                            if(str.error){ 
                              tr += "<div class='col-md-12' align='center'>We are in process of updating the listings please check after 48 Hrs.</div>";
                              }
                              else{
                                var result = str.data;
                                var tat = str.total / num_display_entries;
                                tat = Math.ceil(tat);
                                var i = 0;
                                var page = '';
                                for(i=1;i<=tat;i++){
                                  page += '<li><a href="#">'+i+'</a></li>';
                                }
                                $('.pagination').html(page);
                                $('#count').val(str.total);
                                $('.element').html();         
                                delete str.total ;
                                  $.each(result, function(index, item){
                                    var status = ''; 
                                    var featured = '';  
                                    if(item.animal_purpose == '2'){
                                      featured = '<span class="tag" >featured</span>';
                                    }else if(item.users_type_id == '4'){
                                      featured = '<span class="tag" >Breeder</span>';
                                    }else if(item.users_type_id == '5'){
                                      featured = '<span class="tag" >Dealer</span>';
                                    }else{
                                       featured = '<span class="tag" >Sale Animals</span>';
                                    }
                                   tr+='<div class="white-bg-container">\
                                            <div class="card">\
                                              <a href="<?= base_url('homenew/animal_details/') ?>'+item.animal_id+'"> <img class="card-img-top" src="'+item.animals_images[0].images+'" alt="Card image cap" > </a>\
                                                  <div class="card-body p-0 sellanimals sellanimals">\
                                                    <div class="row">\
                                                        <div class="col-6 pr-0">\
                                                            <div class="neon-blue p-2 pl-3">\
                                                              <h4 class="mb-1"><strong></strong> # '+item.animal_id+'</h4>\
                                                              <p class="mb-0">'+item.category+'</p>\
                                                            </div>\
                                                        </div>\
                                                        <div class="col-6 pl-0 text-right">\
                                                            <div class="dblue p-2 pr-3">\
                                                              <p class="mb-0">Price</p>\
                                                              <h4 class="mb-0">Rs '+item.price+'</h4>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                    <div class="row">\
                                                      <div class="col-6 pr-0">\
                                                          <div class="primary-grey p-2 pl-3">\
                                                             <p>Yield: <strong> '+item.peak_milk_yield+'</strong></p>\
                                                             <p>Age: <strong> '+item.animal_age+' years</strong></p>\
                                                              <p>State: <strong> '+item.state+'</strong></p>\
                                                          </div>\
                                                      </div>\
                                                      <div class="col-6 pl-0">\
                                                          <div class="primary-grey p-2 pr-3 text-right">\
                                                            <p>Date: <strong> '+item.created_on+' </strong></p>\
                                                            <p>Lactation: <strong> '+item.lactation+' </strong></p>\
                                                          </div>\
                                                      </div>\
                                                    </div>\
                                                  </div>\
                                                  <div class="liv-tag">'+featured+'</div>\
                                                  <div class="wishlist">\
                                                      <a class="#">Add to Wishlist</a>\
                                                  </div>\
                                                  <div class="likes">\
                                                      <a href="#"> <i class="fa fa-thumbs-up ml-2 blue" aria-hidden="true">'+item.favorite_count+'</i></a>\
                                                  </div>\
                                            </div>\
                                        </div>\
                                      ';
                                      }); 
                              }
                           $('.element').html(tr);                      
                      if(!result){
                         $('#Pagination').hide();
                      }
                      else
                      {
                        $('#Pagination').show();
                      }
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
      <!-- <script src="js/owl.carousel.min.js"></script> -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
      <!-- <script src="js/bootstrap.js"></script> -->
  
<?php include('footer_new.php'); ?>   
</body>