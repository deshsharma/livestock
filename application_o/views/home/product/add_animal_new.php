<?php $users_id =  $this->session->userdata('users_id');?>
<style>
.hide{
    display:none;
}
</style>
<section>
        <div class="liv-all-animals primary-grey champ-bull-listing champ-bull-reg">
            <div class="container-fluid p0">
            <form method="post" action="<?= base_url('homenew/insert_animals_details');?>">
                <input type="hidden" name="users_id" value="<?= $users_id ?>">
                <div class="row position-relative">
                    <div class="col-12">
                        <h4> Add Animals</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mt-5">
                        <h5><span>1</span>Choose Category</h5>
                        <ul class="list-inline">
                        <?php $category = $this->api_model->get_data('isactivated = "1" ','category','','category_id,category,background,CONCAT("'.IMAGE_PATH.'uploads/logo/",logo) as logo');
                            foreach($category as $cat){
                                //print_r($cat);
                                ?>
                             <li class="list-inline-item text-center category"  name="category">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" name="category" value="<?= $cat['category_id']; ?>" <?php if($cat['category_id'] == '1'){ echo "checked"; } ?>>
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
                           
                        </ul>    
                    </div>   
                </div>
                <div class="row">
                    <div class="col-md-6 mt-5 bull_image">
                        <h5><span>3</span>Upload Images</h5>
                        <?php echo form_error('images'); ?>
                        <div class="col-md-3 mt-5 ">
                            <div class="image-upload mt-4 "> 
                                            <label style="cursor: pointer;" for="file_upload">
                                                <div class="h-100">
                                                    <div class="dplay-tbl">
                                                        <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                                        <div class="form-group ref" style="text-align: center;margin-top: -90px;width: 103%;height: 228px;display:none;">
                                                            <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                                                        </div>
                                                            <h5><b>Choose Your Image to Upload</b></h5>
                                                            <h6 class="mt-10 mb-70">Or Drop Your <br>Image Here</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input data-required="image" type="file"  id="bull_image" class="image-input" data-traget-resolution="image_resolution" value="">
                                                <input type="hidden" name="animal_image" id="bull_photo" value="">
                                            </label>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-6 mt-5">
                        <h5><span>4</span>Upload Video</h5>
                        <div class="image-upload mt-4"> <label style="cursor: pointer;" for="file_upload"> <img src="" alt="" class="uploaded-image">
                            <div class="h-100">
                                <div class="dplay-tbl">
                                    <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                    <div class="form-group ref1" style="text-align: center;margin-top: -100px;width: 103%;height: 230px;display:none;">
                                        <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                                    </div>
                                        <h5><b>Choose Your Video to Upload</b></h5>
                                        <!-- <h6 class="mt-10 mb-70">Or Drop Your <br>Video Here</h6> -->
                                    </div>
                                </div>
                            </div>
                            <!--upload-content-->
                            <input data-required="image" type="file" name="animals_video" id="animals_video" class="image-input" data-traget-resolution="image_resolution" value="">
                            <input type="hidden" name="animals_video" id="animals_videos" value="">
                            </label>
                        </div>
                    </div>
                </div>
                    <div class="row goat heard hide">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong> Choose Type</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="type" value="single" checked="checked">
                                        <p>Single</p>
                                    </label>
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="type" value="herd">
                                        <p>Herd</p>
                                    </label>
                                </li>
                            </ul> 
                        </div>
                    </div>
                    <div class="row pig heard hide">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong> Choose Type</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="type" value="single" checked="checked">
                                        <p>Boar</p>
                                    </label>
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="type" value="herd">
                                        <p>Herd</p>
                                    </label>
                                </li>
                            </ul> 
                        </div>
                    </div>
                <div class="row goat">
                    <div class="col-md-12 mt-4">
                        <h5><span>5</span>Details</h5>

                    </div>
                </div>
                <div class="row goat">
                    <div class="col-md-3 mt-5">
                        <div class="form-group">
                        <?php echo form_error('tag_no'); ?>
                            <input type="text" name = "tag_no" class="form-control" value="<?php echo set_value('tag_no'); ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tag Number / टैग नंबर">
                            </div>

                    </div>
                    <div class="col-md-3 mt-5">
                        <div class="form-group">
                            <?php //echo form_error('fullname'); ?>
                            <input type="text"  name = "fullname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nick Name / उपनाम">
                           </div>

                    </div>
                    <div class="col-md-3 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Age</label>
                            <?php echo form_error('age'); ?>
                            <input type="text" name = "age" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Years">
                           
                          </div>

                    </div>
                    <div class="col-md-3 mt-5">
                        <div class="form-group">
                            <input type="text" name = "age_month" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Months">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 goat">
                    <div class="row">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong> Gender</strong></p>
                            <?php echo form_error('gender'); ?>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="gender" value="Male" checked="checked">
                                        <p>Male</p>
                                    </label>
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="gender" value="Female">
                                        <p>Female</p>
                                    </label>
                                    <!-- <div id="devGender" style="display: none">
                                        Lactation No.
                                        <input type="text"  name="lactation" id="club_lactation" placeholder="lactation" />
                                    </div> -->
                                </li>
                            </ul> 
                        </div>
                    </div>
                </div>
            <!-- <div class="row hide" id="devGender">
                    <div>
                        Lactation No.
                        <input type="text"  name="lactation" id="club_lactation" placeholder="lactation" />
                    </div>
            </div> -->
            <div class="row hide horse">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="color" class="form-control" id="description" aria-describedby="description" placeholder="color">
                    </div>
                </div>
            </div>
             <div class="row hide horse">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="father" class="form-control" id="description" aria-describedby="description" placeholder="Father's Name">
                    </div>
                </div>  
                <div class="col-md-4 mt-4 ">
                    <div class="form-group">
                       <select id="cars" name="fathers_breed" form="carform">
                          <option value="volvo">Father's Breed</option>
                          <option value="37">Zaniskari</option>
                          <option value="38">Bhutia Horse</option>
                          <option value="39">Spiti</option>
                          <option value="45">Chummarti</option>
                          <option value="51">Manipuri Pony</option>
                          <option value="74">Sikang </option>
                          <option value="75">Marwari</option>
                          <option value="196">Kathiawari</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row hide horse">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="mother" class="form-control" id="description" aria-describedby="description" placeholder="Mother's Name">
                    </div>
                </div>             
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                    <select id="cars" name="mothers_breed" form="carform">
                          <option value="volvo">Mothers's Breed</option>
                          <option value="37">Zaniskari</option>
                          <option value="38">Bhutia Horse</option>
                          <option value="39">Spiti</option>
                          <option value="45">Chummarti</option>
                          <option value="51">Manipuri Pony</option>
                          <option value="74">Sikang </option>
                          <option value="75">Marwari</option>
                          <option value="196">Kathiawari</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row hide horse dog cat goat">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="height" class="form-control" id="description" aria-describedby="description" placeholder="Height in foot-inches(e.g. 2.5) / ऊंचाई">
                    </div>
                </div>            
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="weight" class="form-control" id="description" aria-describedby="description" placeholder="Weight in Kg / वजन (किलो  में )">
                    </div>
                </div>
            </div>
            <div class="row hide female ">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="lactation" class="form-control" id="description" aria-describedby="description" placeholder="Lactation No./ब्यात संख्या ">
                    </div>
                </div>
            
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="calving" class="form-control" id="description" aria-describedby="description" placeholder="Last Calving Occured/अधिकतम दैनिक दूध  उत्पादन ">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2 dog">
                    <div class="row">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong> Is registered with any kennel Club?/किसी  भी केनल  कलब  साथ पंजीकृत है</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btnClub" value="Yes" checked="checked">
                                        <p>Yes</p>
                                    </label>
                                    
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btnClub" value="No">
                                        <p>No</p>
                                    </label>
                                </li>
                                <div id="dvClub" style="display: none">
                                        <input type="text" name="clubname" id="club_name" placeholder="Club Name / कलब नाम" />
                                        <input type="text" name="ger_number" id="club_name" placeholder="Reg. No." />
                                    </div> 
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 hide female">
                    <div class="row hide female">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong> Milking Status</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="peak_milk" value="In_milk" checked="checked">
                                        <p>In Milk</p>
                                    </label>
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="peak_milk" value="Dry">
                                        <p>Dry</p>
                                    </label>
                                    </li>
                                    <div id="milk_peak" style="display: none">
                                        Peak milk yield/अधिकतम दैनिक दूध  उत्पादन .
                                        <input type="text"  name="peak" id="milk_peak" placeholder="Peak milk yield/अधिकतम दैनिक दूध  उत्पादन" />
                                    </div>
                                
                            </ul> 
                        </div>
                    </div>
                </div>
                <!-- <div class="row hide female">
                    <div class="col-md-6 mt-3">
                        <span>Calf at Foot (if Any) </span>
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3">                        
                        <input type="button" class="btn" value="YES" name = "btnMilk" />
                        <input type="button" class="btn" value="NO" name = "btnMilk" />
                        <div id="dvMilk" style="display: none">
                        </div>                        
                    </div>
                </div> -->
                <div class="col-md-4 mt-2 hide female">
                    <div class="row hide female">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong> Calf at Foot (if Any)</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="peak_calf" value="Yes" >
                                        <p>YES</p>
                                    </label>
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="peak_calf" value="No"checked="checked">
                                        <p>NO</p>
                                    </label>
                                    </li>
                                    <!-- <div id="calf_peak" style="display: none">
                                        Peak milk yield/ .
                                        <input type="text"  name="peak" id="calf_peak" placeholder="Peak milk yield" />
                                    </div> -->
                                    <div class="col-md-4 mt-2 hide female" id="calf_peak">
                                        <div class="row hide female">
                                            <div class="col-md-12 selectbreed">
                                                <p class="foryld mb-2"><strong> Sex of calf at foot/बछड़े का लिंग</strong></p>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item text-center">
                                                        <label class="champ-reg-lbl">
                                                            <input type="radio" class="btn" name="sex_calf" value="Yes" checked="checked">
                                                            <p>Male</p>
                                                        </label>
                                                    </li>  
                                                    <li class="list-inline-item text-center">
                                                        <label class="champ-reg-lbl">
                                                            <input type="radio" class="btn" name="sex_calf" value="No">
                                                            <p>Female</p>
                                                        </label>
                                                    </li>                                                    
                                                </ul> 
                                            </div>
                                        </div>
                                    </div>
                                
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="row hide">
                    <div class="col-md-6 mt-3">
                         <span>Sex of calf at foot  </span>
                    </div>
                </div>
                <div class="row hide">
                    <div class="col-md-6 mt-3">                       
                        <input type="button" class="btn" value="Male" name = "btnSex" />
                        <input type="button" class="btn" value="Female" name = "btnSex" />
                        <div id="dvSex" style="display: none">
                        </div>                        
                    </div>
                </div>
                <div class="row hide">
                    <div class="col-md-6 mt-3">
                         <span>Calf Status</span>
                    </div>
                </div>
                <div class="row hide">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="Rearing / पालन रखा है" name = "btnSex" />
                        <input type="button" class="btn" value="Sold / बेच दिए" name = "btnSex" />
                        <input type="button" class="btn" value="Died / मर गया" name = "btnSex" />
                    </div>
                </div>
                <?php 
                $cat = $this->api_model->get_data('isactivated = "1"','category');
                foreach($cat as $ca){ 
                    $vac = $this->api_model->get_data('category_id = '.$ca['category_id'].'','vaccination');
                    //print_r($cat);
                    ?>
                            <div class="row hide vacc_<?= $ca['category_id'] ?>">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><h5><?= $ca['category'] ?> Vaccination<h5></label>
                                        <!-- <textarea class="form-control" placeholder="Description"></textarea> -->
                                    
                                    </div>

                                </div>
                            </div>
                            <?php foreach($vac as $va){ ?>
                            <div class="col-md-4 mt-2 hide vacc_<?= $ca['category_id'] ?>">
                                <div class="row">
                                    <div class="col-md-12 selectbreed">
                                        <p class="foryld mb-2"><strong><?= $va['name'] ?></strong></p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item text-center">
                                                <label class="champ-reg-lbl">
                                                    <input type="radio" class="btn btn_yes" data-name="<?= $va['vaccination_id'] ?>" name="vac_check_<?= $va['vaccination_id'] ?>" value="1" checked="checked">
                                                    <p>Yes</p>
                                                </label>
                                                
                                                </li>  
                                                <li class="list-inline-item text-center">
                                                <label class="champ-reg-lbl">
                                                    <input type="radio" class="btn btn_no" data-name="<?= $va['vaccination_id'] ?>" name="vac_check_<?= $va['vaccination_id'] ?>" value="0">
                                                    <p>No</p>
                                                </label>
                                            </li>
                                            <div id="7_in" class="btn_show_<?= $va['vaccination_id'] ?>" style="display: none">
                                                How many months before was the 7 in 1 done ?
                                                <input type="text" name="vac_value_<?= $va['vaccination_id'] ?>" placeholder="<?= $va['name'] ?>" />
                                            </div>
                                        </ul> 
                                    </div>
                                </div>
                            </div>
                <?php }}
                ?>
              
                <div class="row hide female">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Inter Calving Period / दो  ब्यात का  मध्यांतर<h5></label>
                          </div>
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3">                        
                        <input type="button" class="btn" value="Less than 1 year" name = "calving" checked="checked">
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3"> 
                        <input type="button" class="btn" value="1 - 1.5 years" name = "calving" >
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3"> 
                        <input type="button" class="btn" value="1.5 - 2 years" name = "calving" >
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3"> 
                        <input type="button" class="btn" value="More than 2 years" name = "calving" />                        
                    </div>
                </div>
                <div class="col-md-4 mt-2 hide female">
                    <div class="row hide female">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong>Currently pregnant /क्या  गर्भवती  है</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="pregnant" value="Yes" checked="checked">
                                        <p>Yes</p>
                                    </label>
                                    
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="pregnant" value="No">
                                        <p>No</p>
                                    </label>
                                </li>
                                <div id="pregnant_id" style="display: none">
                                    How many months before Currently pregnant ?
                                    <input type="text" name="pregnancy_month" id="pregnant_id" placeholder="Month" />
                                    <input type="text" name="pregnancy_day" id="pregnant_id" placeholder="Day" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 hide female">
                    <div class="row hide female">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong>Method of Conception / गर्भ धारण की बिधि</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="conception" value="ai" checked="checked">
                                        <p>A.I</p>
                                    </label>
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="conception" value="NS">
                                        <p>NS</p>
                                    </label>
                                </li>
                            </ul> 
                        </div>
                    </div>
                </div>
                <!-- <div class="row hide female">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Currently pregnant /क्या  गर्भवती  है <h5></label>
                          </div>
                    </div>
                </div>
                 <div class="row hide female">
                    <div class="col-md-6 mt-3">                      
                        <input type="button" class="btn" value="Yes" name = "pregnant" />
                        <input type="button" class="btn" value="No" name = "pregnant" />  
                    </div>
                </div>  -->
                <div class="row hide">
                     <div class="col-md-3 mt-5">
                        <div class="form-group">
                            <input type="text" name = "pregnant_month" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Pregnancy Month">                           
                          </div>
                    </div>
                    <div class="col-md-3 mt-5">
                        <div class="form-group">
                            <input type="text"  name = "Pregnancy_day" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Pregnancy Day">                           
                          </div>
                    </div>
                </div>
                <div class="row hide">
                    <div class="col-md-6 mt-3">
                        <span> Method of Conception  </span>
                    </div>
                </div>
                <div class="row hide">
                    <div class="col-md-6 mt-3">                      
                        <input type="button" class="btn" value="A.I" name = "conception" />
                        <input type="button" class="btn" value="NS" name = "conception" />  
                    </div>
                </div>
                <div class="col-md-4 mt-2 dog">
                    <div class="row">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong>9 IN 1</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btn_9_in" value="Yes" checked="checked">
                                        <p>Yes</p>
                                    </label>                                    
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btn_9_in" value="No">
                                        <p>No</p>
                                    </label>
                                </li>
                                <div id="9_in" style="display: none">
                                    How many months before was the 9 in 1 done ?
                                    <input type="text" name="9_in_1" id="vcc_9_in_1" placeholder="9 in 1" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 hide dog">
                    <div class="row">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong>7 IN 1</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btn_7_in" value="Yes" checked="checked">
                                        <p>Yes</p>
                                    </label>
                                    
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btn_7_in" value="No">
                                        <p>No</p>
                                    </label>
                                </li>
                                <div id="7_in" style="display: none">
                                    How many months before was the 7 in 1 done ?
                                    <input type="text" name="7_in_1" id="vcc_7_in_1" placeholder="7 IN 1" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 hide dog">
                    <div class="row">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong>6 IN 1</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btn_6_in" value="YES" checked="checked">
                                        <p>Yes</p>
                                    </label>
                                    
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btn_6_in" value="NO">
                                        <p>No</p>
                                    </label>
                                </li>
                                <div id="6_in" style="display: none">
                                    How many months before was the 6 in 1 done ?
                                        <input type="text" name="6_in_1" id="vcc_6_in_1" placeholder="6 in 1" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 hide dog">
                    <div class="row">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong>5 IN 1</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btn_5_in" value="3" checked="checked">
                                        <p>Yes</p>
                                    </label>
                                    
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btn_5_in" value="3">
                                        <p>No</p>
                                    </label>
                                </li>
                                <div id="5_in" style="display: none">
                                    How many months before was the 5 in 1 done ?
                                    <input type="text" name="5_in_1" id="5_in" placeholder="5 IN 1" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <!-- <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <span> 5 IN 1  </span>
                    </div>
                </div>
                <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="Yes" name = "btn_5_in" />
                        <input type="button" class="btn" value="No" name = "btn_5_in" />
                        <div id="5_in" style="display: none">
                            How many months before was the 5 in 1 done ?
                            <input type="text" name="5_in_1" id="vcc_5_in_1" placeholder="5 IN 1" />
                        </div>
                    </div>
                </div> -->
                <div class="row hide cat">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Cat Vaccination<h5></label>
                         </div>
                    </div>
                </div>
                 <div class="row hide cat">
                    <div class="col-md-6 mt-3">
                        <span> FVRCP  </span>
                    </div>
                </div>
                <div class="row hide cat">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="Yes" name = "btn_FVRCP" />
                        <input type="button" class="btn" value="No" name = "btn_FVRCP" />
                        <div id="FVRCP" style="display: none">
                            How many months before was the FVRCP done ?
                            <input type="text" name="fvrcp" id="vcc_FVRCP" placeholder="FVRCP" />
                        </div>
                    </div>
                </div>
                 <div class="row hide cat">
                    <div class="col-md-6 mt-3">
                        <span> FeLV  </span>
                    </div>
                </div>
                 <div class="row hide cat">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="YES" name = "btn_FeLV" />
                        <input type="button" class="btn" value="NO" name = "btn_FeLV" />
                        <div id="FeLV" style="display: none">
                            How many months before was the FVRCP done ?
                            <input type="text" name="felv" id="vcc_FeLV" placeholder="FeLV" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 hide dog cat">
                    <div class="row">
                        <div class="col-md-12 selectbreed">
                            <p class="foryld mb-2"><strong>Rabies / रेबीज</strong></p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btnRabies" value="Yes" checked="checked">
                                        <p>Yes</p>
                                    </label>
                                    
                                    </li>  
                                    <li class="list-inline-item text-center">
                                    <label class="champ-reg-lbl">
                                        <input type="radio" class="btn" name="btnRabies" value="No">
                                        <p>No</p>
                                    </label>
                                </li>
                                <div id="dvrabies" style="display: none">
                                    How many months before was the rabies vaccination done?
                                        <input type="text" name="rabies" id="vcc_rabies" placeholder="Rabies / रेबीज" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="row cow">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Vaccination<h5></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 cow">
                    <div class="row">
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
                                        <input type="text" name="fmd_cc" id="vaccination_id" placeholder="FMD Vaccination" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 cow">
                    <div class="row cow">
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
                                        <input type="text" name="hs_vaccinat" id="vaccination_hs" placeholder="H.S. Vaccination done" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 cow">
                    <div class="row cow">
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
                                        <input type="text" name="black_vcc" id="vaccination_blac" placeholder="Black Quarter" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2 cow">
                    <div class="row cow">
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
                                        <input type="text" name="hs_vaccinat" id="vaccination_bruc" placeholder="Brucellousis Vaccination" />
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>     
                <div class="row cow dog">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Deworming <h5></label>
                            <!-- <textarea class="form-control" placeholder="Description"></textarea> -->
                           
                          </div>

                    </div>
                </div>
                <div class="row cow dog cat">
                    <div class="col-md-6 mt-3">
                        <span>Deworming done ? / पेट के  कीड़ो  की  दवाई  दी?  </span><br>
                        <input type="button" class="btn" value="Yes" name = "btnDeworming" />
                        <input type="button" class="btn" value="No" name = "btnDeworming" />
                        <div id="deworming" style="display: none">
                        How many months before was the rabies vaccination done?
                            <input type="text" name="deworming_name" id="vcc_deworming" />
                        </div>
                    </div>
               
            </div>
            <div class="row hide heard">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="no_of_males" class="form-control" id="no_of_males" aria-describedby="description" placeholder="No of Male">
                    </div>
                </div>  
                <div class="col-md-4 mt-4 hide heard choseBreed">
                    <div class="form-group">
                       <select id="cars" name="carlist" form="carform choseBreed">

                        </select>
                    </div>
                </div>
            </div>           
            <div class="row hide heard">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="no_of_females" class="form-control" id="no_of_females" aria-describedby="description" placeholder="No of Female">
                    </div>
                </div>  
                <div class="col-md-4 mt-4 hide heard choseBreed">
                    <div class="form-group">
                       <select id="cars" name="carlist" form="carform choseBreed">

                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-4">
                    <p class="foryld mb-2"><strong> Description</strong></p>
                    <div class="form-group">
                        <input type="text" name="description" class="form-control" id="description" aria-describedby="description" placeholder="Enter Description">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-4">
                <button class="btn btn-primary champ-reg" name="submit">Submit</button>
                    <!-- <div class="form-group">
                        <input type="text" name="description" class="form-control" id="description" aria-describedby="description" placeholder="Enter Description">
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="row mt-4">
                </div>
            </div>
        </div> 
        </form>
        </div>
    </div>
</section>
<script type="text/javascript">
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
                $("#9_in").show();
            } else {
                $("#9_in").hide();
            }
        });
    });
    $(function () {
        $("input[name=fmd_vaccination]").click(function () {
            if ($(this).val() == "Yes") {
                $("#vaccination_id").show();
            } else {
                $("#vaccination_id").hide();
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
            } else {
                $("#vaccination_blac").hide();
            }
        });
    });
    $(function () {
        $("input[name=bruc_vaccination]").click(function () {
            if ($(this).val() == "Yes") {
                $("#vaccination_bruc").show();
            } else {
                $("#vaccination_bruc").hide();
            }
        });
    });
$('input[name="category"]').click(function(){
   // alert($(this).val());
    if($(this).val() == '2'){
        $('input[name="category"]').removeAttr('checked');
        $('.dog').hide();
        $('.cat').hide();
        $('.horse').show()
        $('#devGender').hide();
        $('.female').hide();
        $('.cow').hide()
    }else if($(this).val() == '1'){
        $('.dog').hide();
        $('.cat').hide();
        $('.cow').show()
        $('.horse').hide()
    }else if($(this).val() == '7'){
        $('.dog').hide();
        $('.cat').hide();
        $('.cow').hide();
        $('.horse').hide();
        $('.goat').show();
    }else if($(this).val() == '5'){
        $('.dog').hide();
        $('.cat').hide();
        $('.cow').hide();
        $('.horse').hide();
        $('.female').hide();
        $('.goat').show();
    }else if($(this).val() == '10'){
        $('.dog').hide();
        $('.cat').hide();
        $('.cow').hide();
        $('.horse').hide();
        $('.goat').show();
    }else if($(this).val() == '8'){
        $('.dog').hide();
        $('.cat').hide();
        $('.cow').show()
        $('.horse').hide()
    }else if($(this).val() == '3'){
        $('.horse').hide();
        $('.cat').hide();
        $('.dog').show();
        $('input[name="category"]').removeAttr('checked');
        $('#devGender').hide();
        $('.female').hide();
        $('.cow').hide()
    }else if($(this).val() == '14'){
        $('.horse').hide();
        $('.dog').hide();
        $('.cat').show();
        $('input[name="category"]').removeAttr('checked');
        $('#devGender').hide();
        $('.female').hide();
        $('.cow').hide()
    }
})
$('input[name="type"]').click(function(){
    if($('input[name="category"]:checked').val() == '7' || $('input[name="category"]:checked').val() == '10'){
        if($(this).val() == 'herd'){
            $('.goat').hide();
            $('.heard').show();
        }else{
            $('.heard').hide();
            $('.goat').show();
        }
    }
});
$('input[name="type"]').click(function(){
    if($('input[name="category"]:checked').val() == '5'){
        if($(this).val() == 'herd'){
            $('.pig').hide();
            $('.heard').show();
        }else{
            $('.heard').hide();
            $('.pig').show();
        }
    }
});
$('input[name="gender"]').click(function(){
    //alert($('input[name="category"]:checked').val())
    if($('input[name="category"]:checked').val() == '1' || $('input[name="category"]:checked').val() == '8'){
        if(($(this).val()=='Female')){
        $('#devGender').show();
        $('.female').show();
        }else{
            $('#devGender').hide();
            $('.female').hide();
        }
    }
    
})
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
$('.category').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_breed?category_id="+$('input[name="category"]:checked').val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data.data;
                    var select = '<select id="cars" name="carlist" form="carform choseBreed"><option value="">Chose Breed</option>';
			                            $.each(str, function(index, item){
                                     select += '<option value="'+item.breed_id+'">'+item.breed_name+'</option>'
			                            });
                                        select += "</select>";
                                        $('.choseBreed').html(select);
										
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
                    var img; 
                    var imgd;            
                    form_data.append('image', file_data);
                    $('.ref').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            if($('#bull_photo').val() == ''){
                                $('#bull_photo').val(data.data);
                            }else{
                                $imgd = $('#bull_photo').val()+','+data.data;
                                $('#bull_photo').val($imgd);
                            }
                            //alert($('#bull_photo').val());
                            img =  '   <div class="col-md-3 mt-5 ">\
                                            <div class="mt-4"> \
                                            <label style="cursor: pointer;">\
                                            <div class="h-100">\
                                                <div class="dplay-tbl">\
                                                    <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>\
                                                      <img style="height: 100px;width: 80px;" src="<?= base_url('uploads/bank/') ?>/'+data.data+'" >\
                                                    </div>\
                                                </div>\
                                            </div>\
                                            </label>\
                                            </div>\
                                        </div>';
                            $('.bull_image').append(img);
                            $('.ref').hide();
                        }
                    });
                });
});
$('#submit').click(function(e){
  if($('#animals_videos').val() == ''){
    e.preventDefault();
    alert("Please Upload videos");
  }
});
$(document).ready(function() {
                $('#animals_video').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#animals_video')[0].files[0].name);
                    var file_data = $('#animals_video').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref1').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_videos?path=animal_video",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#animals_videos').val(data.data);
                            $('.ref1').hide();
                        }
                    });
                });
});
$('.btn_yes').click(function(){
    $('.btn_show_'+$(this).data('name')+'').show();
})
$('.btn_no').click(function(){
    $('.btn_show_'+$(this).data('name')+'').hide();
})
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