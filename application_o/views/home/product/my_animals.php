    <style>
    .sale_a .content .call_btn1 {
    background-color: #0098db;
    display: block;
    text-align: center;
    color: #fff;
    padding: 8px 6px;
    margin: 0px 9px;
    
}
.sale_a .content .see {
    display: flex;
    justify-content: space-between;
    /* position: absolute; */
    width: 100%;
    left: 0px;
    margin-top: 10px;
    bottom: 0px;
}
.sale_a .content .see .see-animal {
    display: block;
    background-color: #ffcc4c;
    color: #fff;
    font-weight: 500;
    width: 100%;
    height: 100%;
    padding: 10px;
    margin: 0px 10px;
    border-radius: 5px 5px 5px 6px;
}
.sale_a .content .see .see-animal1 {
    display: block;
    background-color: #48ade4;
    color: #fff;
    font-weight: 400;
    width: 100%;
    height: 100%;
    padding: 10px;
    margin: 0px 6px;
    border-radius: 5px 5px 5px 6px;
}
    </style>
    <div class="main-content primary-grey">
        <div class="sell_animal">
            <div class="top_tab">
                <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <ul class="nav nav-tabs justify-content-center justify-content-md-start" id="myTab" role="tablist" style="margin-top: 10px;">
                                    <li class="nav-item">
                                    <a class="nav-link active" onclick="get_data_type(0)" id="home-tab" data-toggle="tab"  role="tab" aria-controls="home" aria-selected="true">REGISTERED</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" onclick="get_data_type(1)" id="profile-tab" data-toggle="tab"  role="tab" aria-controls="profile" aria-selected="false">ON SALE</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" onclick="get_data_type(2)" id="contact-tab" data-toggle="tab"  role="tab" aria-controls="contact" aria-selected="false">FEATURED</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" onclick="get_data_type(3)" id="tab4-tab" data-toggle="tab"  role="tab" aria-controls="tab4" aria-selected="false">SOLD</a>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" name="type" id="type" value="0">
                            <div class="col-lg-5 top_filters">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid pb-4">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row element">
                                <div class="row element ">
                                    <div class="form-group ref" style="text-align: center;margin-top: 50px;width: 103%;height: 228px;display:none;">
                                        <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 50%;margin-left: 600%;">
                                    </div> 
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-12 mt-4">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="https://www.livestoc.com/harpahu_merge/assets/admin/js/jquery.pagination.js"></script>
<script type="text/javascript" src="<?= base_url('assets/main/js/ajaxloader.js')?>"></script>
<script type="text/javascript">
    var min_age,max_age,category_id,min_price,max_price,gender,get_data_type,type,images;
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
//  function get_data_type(id , type){
// //   if (confirm('Are you sure you want to change the status')) {
//     var person = '';
//     //   if(status == '2'){
//     //     person = prompt("Please Enter Rejection Region", "Enter Hear");
//     //     if(person == ''){
//     //       exit;
//     //     }
//     //   }
//       var per_page = $('#items_per_page').val();
//       start = 0;
//   ajaxloader.load("https://www.livestoc.com/webservices_new_2/useraccount/get_animals_list_user?list_type="+$('#type').val()+"&users_id=2", function(resp){
//                               location.reload(true);  
//                 });
//   //}
//  }
function mark_as_sold(animal_id,users_id,animal_purpose){
    if(confirm('Are you sure want to mark it as sold?')){
    ajaxloader.load(" https://www.livestoc.com/webservices_new_2/animals/animal_sold_out?animal_id="+animal_id+"&users_id="+users_id+"&animal_purpose="+animal_purpose+"",function(resp){
        location.reload(true);

    });
    }
}
 var num_display_entries,items_per_page,num_entries,start,Razorpay,get_data_type,images ;
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
                ajaxloader.load("https://www.livestoc.com/webservices_new_2/useraccount/get_animals_list_user?list_type="+$('#type').val()+"&users_id=<?= $this->session->userdata("users_id") ?>", function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                            if(str.error){ 
                              tr += "<div class='col-md-12' align='center'><div class='jumbotron text-center'>List Not Available.</div></div>";
                              }
                              else{
                                var result = str.data;
                                $('#count').val(str.total);
                                $('.element').html();         
                                delete str.total ;
                                  $.each(result, function(index, item){
                                    var status = ''; 
                                    var featured = '';
                                    var animal_butt = '';
                                    var animal_category = '';
                                    var img = '';
                                    if(item.animals_images != ''){
                                        img = item.animals_images[0].images;
                                    }else{
                                        img = 'https://www.livestoc.com/uploads_new/banners/no_image.png';
                                    }  
                                    if(item.animal_purpose == '2'){
                                      featured = '<span class="tag" ><?= $this->webLanguage['Featured']?></span>';
                                    }else if(item.users_type_id == '4'){
                                      featured = '<span class="tag" ><?= $this->webLanguage['Breeder']?></span>';
                                    }else if(item.users_type_id == '5'){
                                      featured = '<span class="tag" ><?= $this->webLanguage['Dealer']?></span>';
                                    }else{
                                       featured = '<span class="tag" ></span>';
                                    }
                                    if(item.animal_purpose =='0'){
                                        animal_butt ='<a href="<?= base_url().'homenew/my_animal_sell/'?>'+item.animal_id+'" class="call_btn"> <?= $this->webLanguage['Sell Animal']?></a>';
                                    }else if(item.animal_purpose == '1'){
                                        animal_butt ='<div class="see"><div class="see_a"><a onclick="mark_as_sold('+item.animal_id+','+item.users_id+',3)" class="see-animal">Mark as Sold</a></div><div class="see_a"><a onclick="pay()" class="see-animal1" style="font-size: initial;">Upgrade to feature</a></div></div>';
                                    }else if(item.animal_purpose == '2'){
                                        animal_butt ='<a onclick="mark_as_sold('+item.animal_id+','+item.users_id+',3)" class="call_btn"> <?= $this->webLanguage['Mark as Sold']?></a>';
                                    }else{
                                        animal_butt ='<a></a>';
                                    }
                                    if(item.category == 'Dog'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
		                                                <p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
		                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> '+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
		                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    }else if(item.category == 'Cat'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    }else if(item.category == 'Cow' && item.gender == 'Male'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    }else if(item.category == 'Cow' && item.gender == 'Female'){
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' <?= $this->webLanguage['Kilogram']?></strong></p>\
                                    						<p><?= $this->webLanguage['lactation']?> : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Buffalo' && item.gender == 'Male'){
                                    		animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?> </strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Buffalo' && item.gender == 'Female'){
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' <?= $this->webLanguage['Kilogram']?></strong></p>\
                                    						<p><?= $this->webLanguage['lactation']?> : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Goat' && item.gender == 'Male'){
                                    		animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Goat' && item.gender == 'Female'){
                                    		animal_category = '<p><?= $this->webLanguage['Yield']?> : <strong>'+item.peak_milk_yield+' <?= $this->webLanguage['Kilogram']?></strong></p>\
                                    						<p><?= $this->webLanguage['lactation']?> : <strong>'+item.lactation+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    	
                                    }else if(item.category == 'Sheep'){
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong>'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
		                                                ';
                                    }else{
                                    	animal_category = '<p><?= $this->webLanguage['Gender']?> : <strong>'+item.gender+'</strong></p>\
                                    						<p><?= $this->webLanguage['Breed']?> : <strong>'+item.breed_name+'</strong></p>\
			                                                <p><?= $this->webLanguage['Age']?> : <strong>'+item.animal_age+' <?= $this->webLanguage['Years']?> </strong><strong> -'+item.animal_month+' <?= $this->webLanguage['Months']?></strong></p>\
			                                                <p><?= $this->webLanguage['Date']?> : <strong>'+item.created_on+'</strong></p>\
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
                                                <img src='+img+' width="100%" alt="image">\
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
		                                            <span>'+animal_butt+'</span>\
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
  