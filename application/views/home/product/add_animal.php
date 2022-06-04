<?php $users_id =  $this->session->userdata('users_id');?>
<section>
        <div class="liv-all-animals primary-grey champ-bull-listing champ-bull-reg">
            <div class="container-fluid p0">
            <?php if($error = $this->session->flashdata('add_bank')) {?>
                <div class="com-md-3"></div>
                <div class="col-md-9 corm_nmsset">
                    <div class="error" style="margin-left:0%;">
                    <?= $error ?>
                    </div>
                </div>
            <?php }?>
            <form method="post" action="add_animal_detals" enctype="multipart/form-data">
                <input type="hidden" name="users_id" value="<?= $users_id ?>">
                <div class="row position-relative">
                    <div class="col-12">
                        <h4> Register Animal</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mt-5">
                        <h5><span>1</span>Choose Category</h5>
                        <ul class="list-inline">
                        <?php $category = $this->api_model->get_data('isactivated = "1" ','category','','category_id,category,background,CONCAT("'.IMAGE_PATH.'uploads/logo/",logo) as logo');
                            foreach($category as $cat){?>
                             <li class="list-inline-item text-center category"  name="category">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" name="category" value="<?= $cat['category_id']; ?>">
                                        <img src="<?= $cat['logo'];?>">
                                       
                                      </label>
                                    <p class="champ-reg-name"><?= $cat['category']; ?></p>
                                </li>
                            <?php } ?>
                        </ul>    
                    </div>
                    <div class="col-md-6 mt-5 selectbreed">
                        <h5><span>2</span>Select Breed</h5>
                            <ul class="list-inline breed_id">                           
                                 <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" name="breed_id" class="champ-reg-lbl "value="" checked>

                                    </label>
                                </li>  
                           
                        </ul>    
                    </div>   
                </div>
                <div class="row">
                    <div class="col-md-6 mt-5">
                        <h5><span>3</span>Upload Images</h5>
                        <div class="image-upload mt-4"> 
                                    	<label style="cursor: pointer;" for="file_upload"> <!-- <img src="" alt="" class="uploaded-image"> -->
                                            <div class="h-100">
                                                <div class="dplay-tbl">
                                                    <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                                        <h5><b>Choose Your Image to Upload</b></h5>
                                                        <h6 class="mt-10 mb-70">Or Drop Your <br>Image Here</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--upload-content--> 
                                            <input data-required="image" type="file" name="bull_photo" id="bull_image" class="image-input" data-traget-resolution="image_resolution" value="">
                                            <input type="hidden" name="animal_image" id="bull_photo" value="">
                                        </label>
                        </div>
                                
                    </div>
                    <div class="col-md-6 mt-5">
                        <h5><span>4</span>Upload Video</h5>
                                    <div class="image-upload mt-4"> <label style="cursor: pointer;" for="file_upload"> <img src="" alt="" class="uploaded-image">
                                            <div class="h-100">
                                                <div class="dplay-tbl">
                                                    <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                                        <h5><b>Choose Your Video to Upload</b></h5>
                                                        <h6 class="mt-10 mb-70">Or Drop Your <br>Video Here</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--upload-content--> <input data-required="image" type="file" name="image_name" id="file_upload" class="image-input" data-traget-resolution="image_resolution" value="">
                                        </label> </div>
                                
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <h5><span>5</span>Details</h5>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mt-5">
                        <div class="form-group">
                            <input type="text" name = "tag_no" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tag Number">
                           
                          </div>

                    </div>
                    <div class="col-md-3 mt-5">
                        <div class="form-group">
                            <input type="text"  name = "fullname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nick Name">
                           
                          </div>

                    </div>
                    <div class="col-md-3 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Age</label>
                            <input type="text" name = "age" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Years">
                           
                          </div>

                    </div>
                    <div class="col-md-3 mt-5">
                        <div class="form-group">
                            <input type="text" name = "age_month" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Months">
                          </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="row">
                    <div class="col-md-12 selectbreed">
                        <p class="foryld mb-2"><strong> Gender</strong></p>
                        <ul class="list-inline">
                            <li class="list-inline-item text-center">
                                <label class="champ-reg-lbl">
                                    <input type="radio" class="btn" name="gender" value="Male" checked="">
                                    <p>Male</p>
                                  </label>
                                </li>  
                                <li class="list-inline-item text-center">
                                  <label class="champ-reg-lbl">
                                    <input type="radio" class="btn" name="gender" value="Female">
                                    <p>Female</p>
                                  </label>
                                <div id="devGender" style="display: none">
                                    Lactation No.
                                    <input type="text"  name="lactation" id="club_lactation" placeholder="lactation" />
                                </div>
                            </li>
                        </ul> 
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <span>Is registered with any kennel Club?/किसी  भी केनल  कलब  साथ पंजीकृत है  </span>
                        <input type="button" class="btn" value="Yes" name = "btnClub" />
                        <input type="button" class="btn" value="No" name = "btnClub" />
                        <div id="dvClub" style="display: none">
                            Club Name / कलब नाम  :
                            <input type="text" name="clubname" id="club_name" placeholder="Club Name / कलब नाम" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Dog Vaccination<h5></label>
                            <!-- <textarea class="form-control" placeholder="Description"></textarea> -->
                           
                          </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <span> 9 IN 1 </span>
                        <input type="button" class="btn" value="Yes" name = "btn_9_in" />
                        <input type="button" class="btn" value="No" name = "btn_9_in" />
                        <div id="9_in" style="display: none">
                            How many months before was the 9 in 1 done ?
                            <input type="text" name="9_in_1" id="vcc_9_in_1" placeholder="9 in 1" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <span> 7 IN 1 </span>
                        <input type="button" class="btn" value="Yes" name = "btn_7_in" />
                        <input type="button" class="btn" value="No" name = "btn_7_in" />
                        <div id="7_in" style="display: none">
                        How many months before was the 7 in 1 done ?
                            <input type="text" name="7_in_1" id="vcc_7_in_1" placeholder="7 IN 1" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <span> 6 IN 1  </span>
                        <input type="button" class="btn" value="Yes" name = "btn_6_in" />
                        <input type="button" class="btn" value="No" name = "btn_6_in" />
                        <div id="6_in" style="display: none">
                        How many months before was the 6 in 1 done ?
                            <input type="text" name="6_in_1" id="vcc_6_in_1" placeholder="6 in 1" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <span> 5 IN 1  </span>
                        <input type="button" class="btn" value="Yes" name = "btn_5_in" />
                        <input type="button" class="btn" value="No" name = "btn_5_in" />
                        <div id="5_in" style="display: none">
                            How many months before was the 5 in 1 done ?
                            <input type="text" name="5_in_1" id="vcc_5_in_1" placeholder="5 IN 1" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <span> Rabies / रेबीज </span>
                        <input type="button" class="btn" value="Yes" name = "btnRabies" />
                        <input type="button" class="btn" value="No" name = "btnRabies" />
                        <div id="dvrabies" style="display: none">
                           How many months before was the rabies vaccination done?
                            <input type="text" name="rabies" id="vcc_rabies" placeholder="Rabies / रेबीज" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Deworming <h5></label>
                            <!-- <textarea class="form-control" placeholder="Description"></textarea> -->
                           
                          </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <span>Deworming done ? / पेट के  कीड़ो  की  दवाई  दी?  </span>
                        <input type="button" class="btn" value="Yes" name = "btnDeworming" />
                        <input type="button" class="btn" value="No" name = "btnDeworming" />
                        <div id="deworming" style="display: none">
                        How many months before was the rabies vaccination done?
                            <input type="text" name="deworming_name" id="vcc_deworming" />
                        </div>
                    </div>
               
            </div>
            <div class="row">
            <div class="col-md-4 mt-4">
                <p class="foryld mb-2"><strong> Choose Description</strong></p>
                <div class="form-group">
                    <input type="text" class="form-control" id="description" aria-describedby="description" placeholder="Enter Description">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row mt-4">
                <div class="col-md-2 col-6">
                <button class="btn btn-primary champ-reg" name="submit">Submit</button>
                </div>            
            </div>
        </div>
        </div>    
        
       
       
        </form>
        </div>
    </div>
</section>
<script type="text/javascript">
// $().change(function()){
//     $.ajex({
//         url: "<?= base_url() ?>api/get_breed?category_id="+$('input[name="categroy"]:checked').val(),
//         cache:false,
//         success: function(resp){
//             var data = resp;
//             var str = data.data;
//             alert(this is test);
//         }
//     })
// }
$('.category').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_breed?category_id="+$('input[name="category"]:checked').val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data.data;
                    var option = '<input type="radio" name="breed_id" class="champ-reg-lbl " >';
                    					var radio = '';
			                            $.each(str, function(index, item){
                                     radio += '<li class="list-inline-item text-center">\
			                                    <label class="champ-reg-lbl">\
			                                        <input type="radio" name="breed_id" class="champ-reg-lbl "value="'+item.breed_id+'">\
			                                        <p>'+item.breed_name+'</p>\
			                                    </label>\
			                                  </li>  '
			                            }); 
                                        $('.breed_id').html(radio);
										
                }
                });
})
$('#submit').click(function(e){
  if($('#bull_photo').val() == ''){
    e.preventDefault();
    alert("Please Upload Photo");
  }
});
$(document).ready(function() {
                $('#bull_image').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_image')[0].files[0].name);
                    var file_data = $('#bull_image').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref1').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#bull_photo').val(data.data);
                            $('.ref1').hide();
                        }
                    });
                });
});
$(function () {
        $("input[name=gender]").click(function () {
            if ($(this).val() == "Female") {
                $("#dvGender").show();
            } else {
                $("#dvGender").hide();
            }
        });
    });

    $(function () {
        $("input[name=btnClub]").click(function () {
            if ($(this).val() == "Yes") {
                $("#dvClub").show();
            } else {
                $("#dvClub").hide();
            }
        });
    });
    $(function () {
        $("input[name=btn_9_in]").click(function () {
            if ($(this).val() == "Yes") {
                $("#9_in").show();
            } else {
                $("#9_in").hide();
            }
        });
    });
    $(function () {
        $("input[name=btn_7_in]").click(function () {
            if ($(this).val() == "Yes") {
                $("#7_in").show();
            } else {
                $("#7_in").hide();
            }
        });
    });
    $(function () {
        $("input[name=btn_6_in]").click(function () {
            if ($(this).val() == "Yes") {
                $("#6_in").show();
            } else {
                $("#6_in").hide();
            }
        });
    });
    $(function () {
        $("input[name=btn_5_in]").click(function () {
            if ($(this).val() == "Yes") {
                $("#5_in").show();
            } else {
                $("#5_in").hide();
            }
        });
    });
    $(function () {
        $("input[name=btnRabies]").click(function () {
            if ($(this).val() == "Yes") {
                $("#dvrabies").show();
            } else {
                $("#dvrabies").hide();
            }
        });
    });
    $(function () {
        $("input[name=btnDeworming]").click(function () {
            if ($(this).val() == "Yes") {
                $("#deworming").show();
            } else {
                $(this).val() == "No";
                $("#deworming").hide();
            }
        });
    });
    var header = document.getElementById("container");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style>
.btn {
  /* border: none;
  outline: none; */
  padding: 2px 17px;
  background-color: #48ade4;
  cursor: pointer;
  font-size: 18px;
}
.active, .btn:hover {
  background-color: #666;
  color: white;
}
</style>