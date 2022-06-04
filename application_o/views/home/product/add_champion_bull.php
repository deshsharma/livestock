<?php  $user_id = $this->session->userdata("users_id"); ?> 
<div class="main-content">
    <div class="foroverlay"></div> 
        <section>
            <div class="liv-all-animals primary-grey champ-bull-listing champ-bull-reg">
                <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                                <diV class="col-md-3"></div>
                                <div class="col-md-9 corm_nmset">
                                    <div class=" error" style="margin-left:0%;">
                                        <?= $error ?>
                                    </div>
                                </div>
                <?php } ?>
                <div class="container-fluid p0">
                <form method="post" action="<?= base_url('homenew/champion_bull')?>">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <div class="row position-relative">
                        <div class="col-12">
                            <h4> Register Champoion Bull</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-5">
                            <h5><span>1</span>Choose Category</h5>
                            <ul class="list-inline">
                                <?php $category = $this->api_model->get_data('category_id IN ("1","8") AND isactivated = "1" ','category','','category_id,category,background,CONCAT("'.IMAGE_PATH.'uploads/logo/",logo) as logo');
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
                            <div class="form-group ref1" style="text-align: center; display:none;">
                                <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                            </div>
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
                                                <input type="hidden" name="adhar_image" id="bull_photo" value="">
                                            </label>
                                        </div>
                                    
                        </div>
                        <div class="col-md-6 mt-5">
                            <h5><span>4</span>Upload Video</h5>
                                        <div class="image-upload mt-4">
                                            <label style="cursor: pointer;" for="file_upload"> <!-- <img src="" alt="" class="uploaded-image"> -->
                                                <div class="h-100">
                                                    <div class="dplay-tbl">
                                                        <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                                            <h5><b>Choose Your Video to Upload</b></h5>
                                                            <h6 class="mt-10 mb-70">Or Drop Your <br>Video Here</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--upload-content--> <input data-required="image" type="file" name="animal_video" id="bull_video" class="image-input" data-traget-resolution="image_resolution" value="">
                                                <input type="hidden" name="ani_video" id="bull_video" value="">
                                            </label> 
                                        </div>
                                    
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
                                <!-- <label for="exampleInputEmail1">Tag Number</label> -->
                                <input type="text" name="tag_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tag Number/ टैग">
                            
                            </div>

                        </div>
                        <div class="col-md-3 mt-5">
                            <div class="form-group">
                                <!-- <label for="exampleInputEmail1">Name</label> -->
                                <input type="text" name="fullname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nick Name / पूरा नाम">
                            
                            </div>

                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Age</label>
                                <input type="text" name="year" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Years">
                            
                            </div>

                        </div>
                        <div class="col-md-3 mt-5">
                            <div class="form-group">
                                <input type="text" name="month" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Months">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <textarea name="description" class="form-control" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-5">
                            <h5>Vaccination</h5>
                            <div class="col-md-12 ">
                                <div class="col-md-12 selectbreed">
                                    <p class="foryld mb-2"><strong> FMD Vaccination done /खुरपका - मुंहपका  का टीका  लगा ?</strong></p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="fmd_vaccination" value="Yes" checked="checked">
                                                <p>Yes</p>
                                            </label>
                                            </li>  
                                            <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="fmd_vaccination" value="No">
                                                <p>No</p>
                                            </label>
                                        </li>
                                        <div id="vaccination_id" style="display: none">
                                            How many months before was the FMD vaccination done?
                                            <input type="hidden" name="vaccination['type']" value="1">
                                            <input type="hidden" name="vaccination['vaccination_id']" id="vacc_7" value="7">
                                            <input type="text" name="vaccination['vaccination_date']" id="vaccination_id" placeholder="FMD Vaccination" />
                                        </div>
                                    </ul> 
                                </div>
                                <div class="col-md-12 selectbreed">
                                    <p class="foryld mb-2"><strong> H.S. Vaccination done /गलाघोंटू  का टीका  लगा ?</strong></p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="hs_vaccination" value="Yes" checked="checked">
                                                <p>Yes</p>
                                            </label>
                                            </li>  
                                            <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="hs_vaccination" value="No">
                                                <p>No</p>
                                            </label>
                                        </li>
                                        <div id="vaccination_hs" style="display: none">
                                        How Many months before was the HS Vaccination doen?
                                            <input type="hidden" name="vaccination['type']" value="1">
                                            <input type="hidden" id="vcc_8" value="8" name="vaccination['vaccination_id']">
                                            <input type="text" name="vaccination['vaccination_date']" id="vaccination_hs" placeholder="H.S. Vaccination done" />
                                        </div>
                                    </ul> 
                                </div>
                                <div class="col-md-12 selectbreed">
                                    <p class="foryld mb-2"><strong> Black Quarter Vaccination done /लंगड़े बुखार  का टीका  लगा ?</strong></p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="bla_vaccination" value="Yes" checked="checked">
                                                <p>Yes</p>
                                            </label>
                                            </li>  
                                            <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="bla_vaccination" value="No">
                                                <p>No</p>
                                            </label>
                                        </li>
                                        <div id="vaccination_blac" style="display: none">
                                        How Many months before was the  Black Quarter Vaccination done?
                                        <input type="hidden" name="vaccination['type']" value="1">
                                               <input type="hidden" name="" value="vaccination['vaccination_id']">
                                                <input type="text" name="vaccination['vaccination_date']" id="vaccination_blac" placeholder="Black Quarter" />
                                        </div>
                                    </ul> 
                                </div>
                                <div class="col-md-12 selectbreed">
                                    <p class="foryld mb-2"><strong> Brucellousis Vaccination done / ब्रुसेलोसिस का टीका  लगा ?</strong></p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="bruc_vaccination" value="Yes" checked="checked">
                                                <p>Yes</p>
                                            </label>
                                            </li>  
                                            <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="bruc_vaccination" value="No">
                                                <p>No</p>
                                            </label>
                                        </li>
                                        <div id="vaccination_bruc" style="display: none">
                                                How Many months before was the  Brucellousis Vaccination done?
                                                <input type="hidden" name="vaccination[]['type']" value="1">
                                                <input type="hidden" name="vaccination[]['vaccination_id']" value="" id="vcc_9">
                                                <input type="text" name="vaccination[]['vaccination_date']" id="vaccination_bruc" placeholder="Brucellousis Vaccination" />
                                        </div>
                                    </ul> 
                                </div>
                            </div>                                
                        </div>
                        <div class="col-md-6 mt-5">
                            <h5>Semen Type</h5>
                            <div class="col-md-12">
                                <div class="col-md-12 selectbreed">
                                    <p class="foryld mb-2"><strong> Semen Type</strong></p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" name="semen_type" value="small" checked>
                                                <p>Normal</p>
                                            </label>
                                            </li>  
                                            <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" name="semen_type" value="big">
                                                <p>Sexed</p>
                                            </label>
                                        </li>
                                    </ul> 
                                    <p class="foryld mb-2"><strong> Progeny Tested</strong></p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item text-center">
                                                <label class="champ-reg-lbl">
                                                    <input type="radio" name="progeny_test" value="small" checked>
                                                    <p>Yes</p>
                                                </label>
                                                </li>  
                                                <li class="list-inline-item text-center">
                                                <label class="champ-reg-lbl">
                                                    <input type="radio" name="progeny_test" value="big">
                                                    <p>No</p>
                                                </label>
                                            </li>
                                        </ul> 
                                        <p class="foryld mb-2"><strong> Imported</strong></p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item text-center">
                                                <label class="champ-reg-lbl">
                                                    <input type="radio" name="imported" value="yes" checked>
                                                    <p>Yes</p>
                                                </label>
                                                </li>  
                                                <li class="list-inline-item text-center">
                                                <label class="champ-reg-lbl">
                                                    <input type="radio" name="imported" value="no">
                                                    <p>No</p>
                                                </label>
                                            </li>
                                        </ul>
                                        <p class="foryld mb-2"><strong> Certified</strong></p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item text-center">
                                                <label class="champ-reg-lbl">
                                                    <input type="radio" name="certified" value="yes" checked>
                                                    <p>Yes</p>
                                                </label>
                                                </li>  
                                                <li class="list-inline-item text-center">
                                                <label class="champ-reg-lbl">
                                                    <input type="radio" name="certified" value="no">
                                                    <p>No</p>
                                                </label>
                                            </li>
                                        </ul>
                                </div>
                            </div>                                
                        </div>
                    </div>
                    <div class="row cow dog cat">
                        <div class="col-md-12">                        
                            <div class="col-md-12 selectbreed">
                                    <p class="foryld mb-2"><strong> Deworming done ? / पेट के  कीड़ो  की  दवाई  दी?</strong></p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="btnDeworming" value="Yes" checked="checked">
                                                <p>Yes</p>
                                            </label>
                                            </li>  
                                            <li class="list-inline-item text-center">
                                            <label class="champ-reg-lbl">
                                                <input type="radio" class="btn" name="btnDeworming" value="No">
                                                <p>No</p>
                                            </label>
                                        </li>
                                        <div id="deworming" style="display: none">
                                            How many months before was the rabies vaccination done?
                                            <input type="text" name="deworming_name" id="vaccination_bruc" placeholder="Brucellousis Vaccination" />
                                        </div>
                                    </ul> 
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <h5><span>6</span>Bull Details</h5>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="foryld"><strong>Yield should be in Kg within Lactation Period of 365 days</strong></p>    
                        <div class="row">
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <input type="text" name="dam_yield" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Dam's Yield (in litres)">
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <input type="text" name="daughter_yield" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Daughter's Yield (in litres)">
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <input type="text" name="total_fat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Total Milk Fat (in kg)">
                            </div>
                        </div>
                        
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <input type="text" name="avg_milk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Avg Milk Protien (in %)">
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <input type="text" name="avg_milk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Avg Milk Protien (in %)">
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <input type="text" name="avg_protin" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Avg Milk Protien (in %)">
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <!-- <label for="exampleInputEmail1">Straw Price</label> -->
                                <input type="text" name="straw_price" class="form-control" id="straw_price" aria-describedby="emailHelp" placeholder="Straw Price">
                            </div>
                        </div>
                        </div>
                    </div>
                        <div class="col-md-4 mt-2">
                        <div class="row">
                        
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-md-12 mt-4">
                    <h5><span>7</span>Upload Bull Details</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-4">
                    <div class="form-group ref2" style="text-align: center; display:none;">
                    <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                    </div>
                    <p class="foryld mb-2"><strong> Animal Registration Certificate</strong></p>
                    <div class="image-upload mt-4">
                    <label style="cursor: pointer;" for="file_upload"> <!-- <img src="" alt="" class="uploaded-image"> -->
                        <div class="h-100">
                            <div class="dplay-tbl">
                                <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                    <h5><b>Choose Animal Registration Certificate Upload</b></h5>
                                    <!-- <h6 class="mt-10 mb-70">Or Drop Your <br>Video Here</h6> -->
                                </div>
                            </div>
                        </div>
                        <!--upload-content--> 
                        <input data-required="image" type="file" name="animal_certificate" id="bull_certificate" class="image-input" data-traget-resolution="image_resolution" value="">
                        <input type="hidden" name="ani_certificate" id="animal_certificate" value="">
                    </label> 
                </div>
                <span>Note: Only PDF or Image can be uploaded</span>
                </div> 
                <div class="col-md-3 mt-4">
                    <div class="form-group ref3" style="text-align: center; display:none;">
                    <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                    </div>
                    <p class="foryld mb-2"><strong> Brochure (if any)</strong></p>
                    <div class="image-upload mt-4"> 
                    <label style="cursor: pointer;" for="file_upload"> <img src="" alt="" class="uploaded-image">
                        <div class="h-100">
                            <div class="dplay-tbl">
                                <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                    <h5><b>Choose Brochure (if any) to Upload</b></h5>
                                    <!-- <h6 class="mt-10 mb-70">Or Drop Your <br>Video Here</h6> -->
                                </div>
                            </div>
                        </div>
                        <!--upload-content--> <input data-required="image" type="file" name="brochure_certificate" id="bull_brocer" class="image-input" data-traget-resolution="image_resolution" value="">
                        <input type="hidden" name="broc_certificate" id="brochure_certificate" value="">
                    </label> 
                </div>
                <span>Note: Only PDF or Image can be uploaded</span>
                </div> 
                <div class="col-md-3 mt-4">
                    <div class="form-group ref4" style="text-align: center; display:none;">
                    <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                    </div>
                    <p class="foryld mb-2"><strong> Animal Health Certificate</strong></p>
                    <div class="image-upload mt-4"> <label style="cursor: pointer;" for="file_upload"> <!-- <img src="" alt="" class="uploaded-image"> -->
                        <div class="h-100">
                            <div class="dplay-tbl">
                                <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                    <h5><b>Animal Health Certificate</b></h5>
                                    <!-- <h6 class="mt-10 mb-70">Or Drop Your <br>Video Here</h6> -->
                                </div>
                            </div>
                        </div>
                        <!--upload-content--> <input data-required="image" type="file" name="health_certificate" id="animal_helth" class="image-input" data-traget-resolution="image_resolution" value="">
                        <input type="hidden" name="heal_certificate" id="health_certificate" value="">
                    </label> 
                </div>
                <span>Note: Only PDF or Image can be uploaded</span>
                </div> 
                <div class="col-md-3 mt-4">
                    <div class="form-group ref5" style="text-align: center; display:none;">
                    <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                    </div>
                    <p class="foryld mb-2"><strong> Champion / ANy Other Certifficate</strong></p>
                    <div class="image-upload mt-4"> <label style="cursor: pointer;" for="file_upload"> <!-- <img src="" alt="" class="uploaded-image"> -->
                        <div class="h-100">
                            <div class="dplay-tbl">
                                <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                    <h5><b>Champion / ANy Other Certifficate</b></h5>
                                    <!-- <h6 class="mt-10 mb-70">Or Drop Your <br>Video Here</h6> -->
                                </div>
                            </div>
                        </div>
                        <!--upload-content--> <input data-required="image" type="file" name="champion_certificate" id="bull_champion" class="image-input" data-traget-resolution="image_resolution" value="">
                        <input type="hidden" name="champ_certificate" id="champion_certificate" value="">
                        </label> 
                    </div>
                    <span>Note: Only PDF or Image can be uploaded</span>
                </div> 
                
            </div>  
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <p class="foryld mb-2"><strong> Choose Location</strong></p>
                        <div class="form-group">
                            <input type="text" name = "location"class="form-control" id="searchTextField" aria-describedby="location help" placeholder="Enter Location">
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-2 col-6">
                        <button class="btn btn-primary champ-reg" name="submit">Free Listing</button>
                        <!-- <a href="#" class="btn btn-primary champ-reg"> Free Listing</a> -->
                    </div>
                    <div class="col-md-3 col-6">
                        <button class="btn btn-primary champ-reg" name="submit">Premium Member</button>
                        <!-- <a href="#" class="btn btn-primary champ-reg"> Premium Member</a> -->
                    </div>
                </div>
            </form>
            </div>
        </div>
        </section>
    </div>
</div>
<script>
$(function () {
        $("input[name=fmd_vaccination]").click(function () {
            if ($(this).val() == "Yes") {
                $("#vaccination_id").show();
                $("#vacc_7").show();
            } else {
                $("#vaccination_id").hide();
                $("vacc_7").hide();
            }
        });
    });
    $(function () {
        $("input[name=hs_vaccination]").click(function () {
            if ($(this).val() == "Yes") {
                $("#vaccination_hs").show();
            } else {
                $("#vaccination_hs").hide();
            }
        });
    });
    $(function () {
        $("input[name=bla_vaccination]").click(function () {
            if ($(this).val() == "Yes") {
                $("#vaccination_blac").show();
            }else{
                $("#vaccination_blac").hide();
            }
        });
    });
    $(function () {
        $("input[name=bruc_vaccination]").click(function () {
            if ($(this).val() == "Yes") {
                $("#vaccination_bruc").show();
            }else{
                $("#vaccination_bruc").hide();
            }
        });
    });
    $(function () {
        $("input[name=btnDeworming]").click(function () {
            if ($(this).val() == "Yes") {
                $("#deworming").show();
            } else {
                $("#deworming").hide();
            }
        });
    });
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
$('#submit').click(function(e){
  if($('#animal_certificate').val() == ''){
    e.preventDefault();
    alert("Please Upload Animal Certificate Photo");
  }
});
$('#submit').click(function(e){
  if($('#brochure_certificate').val() == ''){
    e.preventDefault();
    alert("Please Upload Animal Certificate Photo");
  }
});
$('#submit').click(function(e){
  if($('#health_certificate').val() == ''){
    e.preventDefault();
    alert("Please Upload Animal health_certificate Photo");
  }
});
$('#submit').click(function(e){
  if($('#champion_certificate').val() == ''){
    e.preventDefault();
    alert("Please Upload Animal health_certificate Photo");
  }
});
$('#submit').click(function(e){
  if($('#animal_video').val() == ''){
    e.preventDefault();
    alert("Please Upload Animal health_certificate Photo");
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
$(document).ready(function() {
                $('#bull_certificate').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_certificate')[0].files[0].name);
                    var file_data = $('#bull_certificate').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref2').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#animal_certificate').val(data.data);
                            $('.ref2').hide();
                        }
                    });
                });
});
$(document).ready(function() {
                $('#bull_brocer').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_brocer')[0].files[0].name);
                    var file_data = $('#bull_brocer').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref3').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#brochure_certificate').val(data.data);
                            $('.ref3').hide();
                        }
                    });
                });
});
$(document).ready(function() {
                $('#animal_helth').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#animal_helth')[0].files[0].name);
                    var file_data = $('#animal_helth').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref4').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#health_certificate').val(data.data);
                            $('.ref4').hide();
                        }
                    });
                });
});
$(document).ready(function() {
                $('#bull_champion').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_champion')[0].files[0].name);
                    var file_data = $('#bull_champion').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref5').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#champion_certificate').val(data.data);
                            $('.ref5').hide();
                        }
                    });
                });
});
$(document).ready(function() {
                $('#bull_video').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_video')[0].files[0].name);
                    var file_data = $('#bull_video').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref6').show();
                    $.ajax({
                        url: "http://www.amazebrandlance.com/file_upload/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#animal_video').val(data.data);
                            $('.ref6').hide();
                        }
                    });
                });
});
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
    
    $('#owl-carousel1').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:1,
            nav:false,
            loop:false
        }
    }
})

$('#owl-carousel2').owlCarousel({
    loop:true,
    margin:25,
    responsiveClass:true,
    responsive:{
        0:{
            items:1.25,
            nav:true,
            dots:false,
            loop: false
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:4,
            nav:true,
            loop:false,
            dots:false
        }
    }
})
     
$('#owl-carousel3').owlCarousel({
    loop:true,
    margin:25,
    responsiveClass:true,
    responsive:{
        0:{
            items:1.45,
            nav:true,
            dots:false
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:4,
            nav:true,
            loop:false,
            dots: false
        }
    }
})
$('#owl-carousel4').owlCarousel({
    loop:true,
    margin:25,
    responsiveClass:true,
    responsive:{
        0:{
            items:1.25,
            nav:false,
            margin:0,
            dots:false
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:3,
            nav:true,
            loop:false,
            dots: false
        }
    }
})   
    $('#tab_selector').on('change', function (e) {
        $('.form-tabs li a').eq($(this).val()).tab('show');
    });

});          
</script>
 <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.submit.lat();
                document.getElementById('cityLng').value = place.geometry.submit.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

                
       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBKXAzms3AOjKJz4hjMlPdFreKAryub2U&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>  