<section>
	<div class="main-content primary-grey">
        <div class="sell_animal">
            <div class="top_tab">
                <div class="container-fluid">
                    <div class="row justify-content-center">
			            <input type="hidden" id="animal_id" value="">
			            <input type="hidden" id="count">
	                	<div class="col-lg-6">
	                        <ul class="nav nav-tabs justify-content-center justify-content-md-start" id="myTab" role="tablist" style="margin-top: 10px;">
	                            <li class="nav-item">
	                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="get_data_type(1)"><?= $this->webLanguage['All']?></a>
	                            </li>
	                            <li class="nav-item">
	                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" onclick="get_data_type(2)"><?= $this->webLanguage['Featured']?></a>
	                            </li>
	                            <li class="nav-item">
	                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" onclick="get_data_type(4)"><?= $this->webLanguage['Posted By Breeder']?></a>
	                            </li>
	                            <li class="nav-item">
	                            <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false" onclick="get_data_type(5)"><?= $this->webLanguage['Posted By Dealer']?></a>
	                            </li>
	                        </ul>
	                    </div>
                		<div class="col-lg-5 col-md-3 top_filters" style="margin-top: 10px;">
                                <div class="row justify-content-center">
                                    <div class="col-sm col">
                                        <div class="form-group mb-0">
                                          <select  id="select_state" onchange="get_data_type('')" class="form-control">
      		                            		 	<?php $cat_data =  $this->api_model->get_state("99");  ?>
      		                                		<option value=""><?= $this->webLanguage['Select State']?> </option>
      		                                    	<?php foreach($cat_data as $d){ ?>
		                                        <option value="<?= $d['name'] ?>" ><?= $d['name'] ?></option>
		                                        <?php } ?>
		                        			        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm col">
                                        <div class="form-group mb-0">
                                            <select  id="animal_category" onchange="get_data_type('')" class="form-control">
        			                           	 		<?php $cat_data = $this->api_model->get_category();  ?>
        			                           	 		<option value=""><?= $this->webLanguage['Select Category']?> </option>
        			                                    <?php foreach($cat_data as $d){ ?>
			                                        <option value="<?= $d['category_id'] ?>" ><?= $d['category'] ?></option>
			                                         <?php } ?>
			                    			           </select>
                                        </div>
                                    </div>
                                    <div class="col-sm col">
                                            <div class="dropdown">
                                            <a class="form-control text-center dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= $this->webLanguage['More Filters']?>
                                            </a>
                                                <div class="dropdown-menu dropdown-menu-right filters" aria-labelledby="dropdownMenuButton" style="will-change: transform;">
                                                    <div class="dropdown-item row">
                                                        <input type="hidden" name="type" id="type" value="1">
                                                        <div class="col-6">
                                                            <p class="mb-0"><?= $this->webLanguage['Select Gender']?></p>      
                                                        </div>    
                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline">
                                                                <input type="hidden" name="inlineRadioOptions" id="inlineRadioOptions" value="">
                                                                <input class="form-check-input gender" type="radio" name="inlineRadioOptions" id="male" value="Male" >
                                                                <label class="form-check-label gender" for="inlineRadio1"><?= $this->webLanguage['Male']?></label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="male" value="Female" checked="checked">
                                                                <label class="form-check-label" for="inlineRadio2"><?= $this->webLanguage['Female']?></label>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="dropdown-item row mt-3">
                                                        <div class="col-6">
                                                            <p class="mb-0"><?= $this->webLanguage['Price']?></p>      
                                                        </div>    
                                                        <div class="col-12">
                                                            <input type="text" class="form-control mr-3" id="min_price" placeholder="<?= $this->webLanguage['Min']?>">
                                                            <input type="text" class="form-control" id="max_price" placeholder="<?= $this->webLanguage['Max']?>">
                                                        </div>
                                                    </div>  
                                                    <div class="dropdown-item row mt-5">
                                                        <div class="col-6">
                                                            <p class="mb-0"><?= $this->webLanguage['Age']?></p>      
                                                        </div>    
                                                        <div class="col-12">
                                                            <input type="text" class="form-control mr-3" id="min_age" placeholder="<?= $this->webLanguage['Min']?>">
                                                            <input type="text" class="form-control" id="max_age" placeholder="<?= $this->webLanguage['Max']?>">
                                                        </div>
                                                    </div> 
                                                    <div class="dropdown-item row mt-5">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-primary" onclick="filter()"><?= $this->webLanguage['Apply']?></button>
                                                            <a id="clear" onclick="filter()"><?= $this->webLanguage['Clear filters']?></a>
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>
                                    </div>
                                </div>
                        </div>
                    <div class="container-fluid pb-4">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row element">
                            <div class="form-group ref" style="text-align: center;margin-top: 50px;width: 103%;height: 228px;display:none;">
                                <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 50%;">
                            </div> 
                            </div>
                        </div>
                    </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4" aling="center">
                            <div id="Pagination" style="text-align: center;"></div> 
                            <input type="hidden" value="10" name="items_per_page" id="items_per_page">
                            <input type="hidden" value="5" name="num_display_entries" id="num_display_entries">
                            <input type="hidden" value="Prev" name="prev_text" id="prev_text">
                            <input type="hidden" value="Next" name="next_text" id="next_text">
                        </div>
                    </div>
      		</div>
    	</section>
  	</div>
 </div>
    
<script type="text/javascript" src="https://www.livestoc.com/harpahu_merge/assets/admin/js/jquery.pagination.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/main/js/ajaxloader.js')?>"></script>
     
<script type="text/javascript">
 var min_age,max_age,category_id,min_price,max_price,gender,get_data_type;
 <?php if($this->session->userdata("users_id")){ ?>
 function add_animal_like(animal_id, user_id, status){
	$.ajax({
			type: "POST",
			url: "<?= base_url('webservices_new_dev/animals/') ?>"+"add_animal_like",
			data: { animal_id: animal_id, users_id: user_id, status: status},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.success){
                    if(data.data.status == '0'){
                        var count = $('.'+animal_id+'_like').text();
                        $('.'+animal_id+'_l').html('');
                        $('.'+animal_id+'_l').html('<a onclick="add_animal_like('+animal_id+', <?= $this->session->userdata("users_id") ?>, 1)" class="like"><span class="5389_like">'+(parseInt(count) - 1)+'</span> <i class="fa fa-thumbs-up" aria-hidden="true"></i></a>');
                    }else{
                        var count = $('.'+animal_id+'_like').text();
                        $('.'+animal_id+'_l').html('');
                        $('.'+animal_id+'_l').html('<a onclick="add_animal_like('+animal_id+', <?= $this->session->userdata("users_id") ?>, 0)" class="like"><span class="5389_like">'+(parseInt(count) + 1)+'</span> <i class="fa fa-thumbs-up" aria-hidden="true" style="color: #48ade4;"></i></a>');
                    }
				}else{
				alert(data.error)
				}
			} 
    });
 }
 function add_animal_wishlist(animal_id, user_id, status){
	$.ajax({
			type: "POST",
			url: "<?= base_url('webservices_new_dev/animals/') ?>"+"add_animal_favorite",
			data: { animal_id: animal_id, users_id: user_id, status: status},
			dataType: "json",
			cache : false,
			success: function(data){
                if(data.success){
                    if(data.data.status == '0'){
                        $('.'+animal_id+'').html('');
                        $('.'+animal_id+'').html('<li class="5389"><a onclick="add_animal_wishlist('+animal_id+', <?= $this->session->userdata("users_id") ?>, 1)" class="wishl"><span class="5389_wishlist"><?= $this->webLanguage['Add to Wishlist']?></span></a></li>');
                    }else{
                        $('.'+animal_id+'').html('');
                        $('.'+animal_id+'').html('<li class="5389"><a onclick="add_animal_wishlist('+animal_id+', <?= $this->session->userdata("users_id") ?>, 0)" class="wishl"><span class="5389_wishlist"><?= $this->webLanguage['Remove to Wishlist']?></span></a></li>');
                    }
                }else{
                alert(data.error)
                }
			} 
		});
  }
<?php } ?>
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
  ajaxloader.load("<?php echo base_url('webservices_new_dev/animals/get_animals_list').'?id=' ?>"+id+"&status="+status+"&type="+$()+"&start="+start+"&perpage="+per_page+"&region="+person+"category_id="+category_id+"gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"agefrom="+$("#min_age").val()+"ageto="+$("#max_age").val(), function(resp){
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
                $('.ref').show();
                if(start == '0'){
                    per_page = 1;
                }else{
                    per_page = 1 + (parseInt(start)/ parseInt(per_page));
                }
                ajaxloader.load("<?php echo base_url('webservices_new_dev/animals/get_animals_list') ?>?is_pregnant=&gender="+$("input:radio[name=inlineRadioOptions]:checked").val()+"&category_id="+$("#animal_category").val()+"&lactation=&agefrom="+$("#min_age").val()+"&users_id=<?=$this->session->userdata("users_id") ?>&state="+$("#select_state").val()+"&listtype="+$('#type').val()+"&page="+per_page+"&ageto="+$("#max_age").val()+"&isactivated=1", function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                            if(str.error){ 
                              tr += "<div class='col-md-12' align='center'><div class='jumbotron text-center'>We are in process of updating the listings please check after 48 Hrs.</div></div>";
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
                                      featured = '<span class="tag" ><?= $this->webLanguage['Featured']?></span>';
                                    }else if(item.users_type_id == '4'){
                                      featured = '<span class="tag" ><?= $this->webLanguage['Breeder']?></span>';
                                    }else if(item.users_type_id == '5'){
                                      featured = '<span class="tag" ><?= $this->webLanguage['Dealer']?></span>';
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
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' <?= $this->webLanguage['Kilogram']?></strong></p>\
                                    						<p><?= $this->webLanguage['lactation']?> : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Buffalo' && item.gender == 'Male'){
                                    		animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Buffalo' && item.gender == 'Female'){
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' <?= $this->webLanguage['Kilogram']?></strong></p>\
                                    						<p><?= $this->webLanguage['lactation']?> : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Goat' && item.gender == 'Male'){
                                    		animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Goat' && item.gender == 'Female'){
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' <?= $this->webLanguage['Kilogram']?></strong></p>\
                                    						<p><?= $this->webLanguage['lactation']?> : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
			                                                <p><?= $this->webLanguage['State']?> : <strong>'+item.state+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Sheep'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
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
                                    var login = '';
                                    <?php if($_SESSION['users_id']){ ?>
                                        if(item.favorite_id == '0' || item.favorite_id == '' || item.favorite_id == null ){
                                            login = '<li class="'+item.animal_id+'"><a onclick="add_animal_wishlist('+item.animal_id+', <?= $_SESSION['users_id'] ?>, 1)" class="wishl"><span class="'+item.animal_id+'_wishlist"><?= $this->webLanguage['Add to Wishlist']?></span></a></li>';
                                        }else{
                                            login = '<li class="'+item.animal_id+'"><a onclick="add_animal_wishlist('+item.animal_id+', <?= $_SESSION['users_id'] ?>, 0)" class="wishl"><span class="'+item.animal_id+'_wishlist"><?= $this->webLanguage['Remove to wishlist']?></span></a></li>';
                                        }
                                        if(item.like_user == '0'){
                                            login += '<li class="'+item.animal_id+'_l"><a onclick="add_animal_like('+item.animal_id+', <?= $_SESSION['users_id'] ?>, 1)" class="like"><span class="'+item.animal_id+'_like">'+item.like_count+'</span> <i class="fa fa-thumbs-up"></i></a></li>'
                                        }else{
                                            login += '<li class="'+item.animal_id+'_l"><a onclick="add_animal_like('+item.animal_id+', <?= $_SESSION['users_id'] ?>, 0)" class="like"><span class="'+item.animal_id+'_like">'+item.like_count+'</span> <i class="fa fa-thumbs-up" style="color: #48ade4;"></i></a></li>'
                                        }
                                        
                                    <?php }else{ ?>
                                        login = '<li><a href="<?= base_url() ?>/frontend/login" class="wishl"><span><?= $this->webLanguage['Add to Wishlist']?></span></a></li>';
                                        login += '<li><a href="<?= base_url() ?>/frontend/login" class="like"><span>'+item.like_count+'</span> <i class="fa fa-thumbs-up"></i></a></li>'
                                    <?php } ?>
                                   tr+='<div class="col-lg-3 col-sm-6">\
		                                    <div class="sale_a">\
		                                        <a href="<?= base_url('homenew/animal_details/') ?>'+item.animal_id+'">\
		                                        <div class="picture">\
		                                            <img src="'+item.animals_images[0].images+'" width="100%" alt="">\
		                                            <span>'+featured+'</span>\
		                                        </div>\
		                                        <div class="content" style="padding-bottom: 8px;">\
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
		                                            <ul>'+login+'\
		                                            </ul>\
		                                        </div>\
		                                    </div>\
		                                </div>\
                                      ';
                                      }); 
                              }
                           $('.element').html(tr);
                             $('.ref').show();                      
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