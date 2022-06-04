<section>
	<div class="main-content primary-grey">
        <div class="sell_animal">
            <div class="top_tab">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                    <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
			            <input type="hidden" id="animal_id" value="">
			            <input type="hidden" id="count">
	                	<div class="col-lg-6">
	                        <ul class="nav nav-tabs justify-content-center justify-content-md-start" id="myTab" role="tablist">
	                            <!-- <li class="nav-item">
	                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="get_data_type(1)">All</a>
	                            </li>
	                            <li class="nav-item">
	                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" onclick="get_data_type(2)">Featured</a>
	                            </li>
	                            <li class="nav-item">
	                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" onclick="get_data_type(4)">Posted By Breeder</a>
	                            </li>
	                            <li class="nav-item">
	                            <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false" onclick="get_data_type(5)">Posted By Dealer</a>
	                            </li> -->
	                        </ul>
	                    </div>
                    <div class="container-fluid pb-4">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row element">
                                
                            </div>
                        </div>
                    </div>  
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12 mt-4" aling="center">
                            <div id="Pagination" style="text-align: center;"></div> 
                            <input type="hidden" value="10" name="items_per_page" id="items_per_page">
                            <input type="hidden" value="5" name="num_display_entries" id="num_display_entries">
                            <input type="hidden" value="Prev" name="prev_text" id="prev_text">
                            <input type="hidden" value="Next" name="next_text" id="next_text">
                        </div>
                    </div> -->
      		</div>
    	</section>
  	</div>
 </div>
    
<script type="text/javascript" src="https://www.livestoc.com/harpahu_merge/assets/admin/js/jquery.pagination.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/main/js/ajaxloader.js')?>"></script>
     
<script type="text/javascript">
 var min_age,max_age,category_id,min_price,max_price,gender,get_data_type;
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
                      $("#Pagination").pagination(num_entries, {
                        num_display_entries: num_display_entries,
                        items_per_page:items_per_page,
                        callback: pageselectCallback
                      });
                   }	
                   catch(ex){}
             }  

      function loadData(start,per_page,event_type){
                if(start == '0'){
                    per_page = 1;
                }else{
                    per_page = 1 + (parseInt(start)/ parseInt(per_page));
                }
                ajaxloader.load("<?php echo base_url('webservices_new_dev/animals/animal_favorite_list') ?>?users_id="+$('#users_id').val()+"", function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                            if(str.error){ 
                              tr += "<div class='col-md-12' align='center'>Listing Not Available.</div>";
                              }
                              else{
                                var result = str.data;
                                $('#count').val(str.total);
                                $('.element').html();         
                                delete str.total ;
                                  $.each(result, function(index, item){
                                    var status = ''; 
                                    var featured = '';
                                    var animal_category = '';  
                                    if(item.animal_purpose == '2'){
                                      featured = '<span class="tag" >featured</span>';
                                    }else if(item.users_type_id == '4'){
                                      featured = '<span class="tag" >Breeder</span>';
                                    }else if(item.users_type_id == '5'){
                                      featured = '<span class="tag" >Dealer</span>';
                                    }else{
                                       featured = '<span class="tag" ></span>';
                                    }
                                    if(item.category == 'Dog'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
		                                                <p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
		                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> '+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
		                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    }else if(item.category == 'Cat'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    }else if(item.category == 'Cow' && item.gender == 'Male'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    }else if(item.category == 'Cow' && item.gender == 'Female'){
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' Kg </strong></p>\
                                    						<p>lactation : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Buffalo' && item.gender == 'Male'){
                                    		animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Buffalo' && item.gender == 'Female'){
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' Kg </strong></p>\
                                    						<p>lactation : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Goat' && item.gender == 'Male'){
                                    		animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Goat' && item.gender == 'Female'){
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' Kg </strong></p>\
                                    						<p>lactation : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Sheep'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    }else{
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong> -'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    }
                                   tr+='<div class="col-lg-3 col-sm-6">\
		                                    <div class="sale_a">\
		                                        <a >\
		                                        <div class="picture">\
		                                            <img src="'+item.animals_images[0].images+'" width="100%" alt="">\
		                                            <span>'+featured+'</span>\
		                                        </div>\
		                                        <div class="content">\
		                                            <div class="ani_tag">\
		                                                <strong>'+item.category+' #'+item.animal_id+'</strong>\
		                                                <span>'+item.breed_name+'</span>\
		                                                <div class="rate">\
		                                                    <div class="rate_txt"><?= $this->webLanguage['Price']?></div>\
		                                                    <i class="fa fa-inr"></i> <span>'+item.price+'</span>\
		                                                </div>\
		                                            </div>\
		                                            <div class="des">'+animal_category+' </div>\
		                                            <a href="#" class="call_btn"><i class="fa fa-phone-square"></i> <?= $this->webLanguage['Contact Seller']?></a>\
		                                        </div>\
		                                        </a>\
		                                        <div class="wish">\
		                                            <ul>\
		                                                <li><a href="#" class="wishl"><span><?= $this->webLanguage['Add to Wishlist']?> </span></a></li>\
		                                                <li><a href="#" class="share"> <span>Share</span> <i class="fa fa-share"></i></a></li>\
		                                                <li><a href="#" class="like"><span>'+item.like_count+'</span> <i class="fa fa-thumbs-up"></i></a></li>\
		                                            </ul>\
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