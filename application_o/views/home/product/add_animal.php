<?php $users_id =  $this->session->userdata('users_id');?>
<style>
.hide{
    display:none;
}
</style>
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
            <form method="post" action="<?= base_url('homenew/add_animal_detals');?>" enctype="multipart/form-data">
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
                                <?php $breed = $this->api_model->get_data('isactivated = "1" AND category_id = "1"', 'breed');
                                foreach($breed as $br){
                                ?>                           
                                    <li class="list-inline-item text-center">
                                        <label class="champ-reg-lbl">
                                            <input type="radio" name="breed_id" class="champ-reg-lbl" value="<?= $br['breed_id']; ?>">
                                            <p><?= $br['breed_name']; ?></p>
                                        </label>
                                    </li>  
                                <?php } ?>
                           
                        </ul>    
                    </div>   
                </div>
                <div class="row">
                    <div class="col-md-6 mt-5 bull_image">
                        <h5><span>3</span>Upload Images</h5>
                        <div class="col-md-3 mt-5 ">
                            <div class="image-upload mt-4 "> 
                                            <label style="cursor: pointer;" for="file_upload">
                                                <div class="h-100">
                                                    <div class="dplay-tbl">
                                                        <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                                            <h5><b>Choose Your Image to Upload</b></h5>
                                                            <h6 class="mt-10 mb-70">Or Drop Your <br>Image Here</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input data-required="image" type="file" name="bull_photo" id="bull_image" class="image-input" data-traget-resolution="image_resolution" value="">
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
                                                        <h5><b>Choose Your Video to Upload</b></h5>
                                                        <h6 class="mt-10 mb-70">Or Drop Your <br>Video Here</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--upload-content--> <input data-required="image" type="file" name="image_name" id="file_upload" class="image-input" data-traget-resolution="image_resolution" value="">
                                        </label> </div>
                                
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
                                    <!-- <div id="devGender" style="display: none">
                                        Lactation No.
                                        <input type="text"  name="lactation" id="club_lactation" placeholder="lactation" />
                                    </div> -->
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
                            <input type="text" name = "tag_no" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tag Number / टैग नंबर">
                           
                          </div>

                    </div>
                    <div class="col-md-3 mt-5">
                        <div class="form-group">
                            <input type="text"  name = "fullname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nick Name / उपनाम">
                           
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
                <div class="col-md-4 mt-2 goat">
                    <div class="row">
                    <div class="col-md-12 selectbreed">
                        <p class="foryld mb-2"><strong> Gender</strong></p>
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
                        <input type="text" name="hight" class="form-control" id="description" aria-describedby="description" placeholder="Father's Name">
                    </div>
                </div>  
                <div class="col-md-4 mt-4 ">
                    <div class="form-group">
                       <select id="cars" name="carlist" form="carform">
                          <option value="volvo">Chose Breed</option>
                          <option value="saab">Saab</option>
                          <option value="opel">Opel</option>
                          <option value="audi">Audi</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row hide horse">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="hight" class="form-control" id="description" aria-describedby="description" placeholder="Mother's Name">
                    </div>
                </div>             
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                       <select id="cars" name="carlist" form="carform">
                          <option value="volvo">Chose Breed</option>
                          <option value="saab">Saab</option>
                          <option value="opel">Opel</option>
                          <option value="audi">Audi</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row hide horse dog cat goat">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="hight" class="form-control" id="description" aria-describedby="description" placeholder="Height in foot-inches(e.g. 2.5) / ऊंचाई">
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
                <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <span>Is registered with any kennel Club?/किसी  भी केनल  कलब  साथ पंजीकृत है  </span>
                        <input type="button" class="btn" value="Yes" name = "btnClub" />
                        <input type="button" class="btn" value="No" name = "btnClub" />
                        <div id="dvClub" style="display: none">
                           <!--  Club Name / कलब नाम  : -->
                            <input type="text" name="clubname" id="club_name" placeholder="Club Name / कलब नाम" />
                            <input type="text" name="ger_number" id="club_name" placeholder="Register number" />
                        </div>                        
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3">
                        <span>Milking Status </span>
                    </div>
                </div>
                 <div class="row hide female">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="In Milk" name = "btnMilk" />
                        <input type="button" class="btn" value="Dry" name = "btnMilk" />
                        <div id="dvMilk" style="display: none">
                            <input type="text" name="clubname" id="club_Milk" placeholder="Peak milk yield" />
                        </div>                        
                    </div>
                </div>
                <div class="row hide female">
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
                <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Dog Vaccination<h5></label>
                            <!-- <textarea class="form-control" placeholder="Description"></textarea> -->
                           
                          </div>

                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Inter Calving Period / दो  ब्यात का  मध्यांतर<h5></label>
                          </div>
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3">                        
                        <input type="button" class="btn" value="Less than 1 year" name = "calving" />
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3"> 
                        <input type="button" class="btn" value="1 - 1.5 years" name = "calving" />
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3"> 
                        <input type="button" class="btn" value="1.5 - 2 years" name = "calving" />
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3"> 
                        <input type="button" class="btn" value="More than 2 years" name = "calving" />                        
                    </div>
                </div>
                <div class="row hide female">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Currently pregnant /क्या  गर्भवती  है <h5></label>
                          </div>
                    </div>
                </div>
                 <div class="row hide">
                    <div class="col-md-6 mt-3">                      
                        <input type="button" class="btn" value="Yes" name = "pregnant" />
                        <input type="button" class="btn" value="No" name = "pregnant" />  
                    </div>
                </div> 
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
                 <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <span> 9 IN 1 </span>
                    </div>
                </div>               
                <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="Yes" name = "btn_9_in" />
                        <input type="button" class="btn" value="No" name = "btn_9_in" />
                        <div id="9_in" style="display: none">
                            How many months before was the 9 in 1 done ?
                            <input type="text" name="9_in_1" id="vcc_9_in_1" placeholder="9 in 1" />
                        </div>
                    </div>
                </div>
                <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <span> 7 IN 1 </span>
                    </div>
                </div>
                <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="Yes" name = "btn_7_in" />
                        <input type="button" class="btn" value="No" name = "btn_7_in" />
                        <div id="7_in" style="display: none">
                        How many months before was the 7 in 1 done ?
                            <input type="text" name="7_in_1" id="vcc_7_in_1" placeholder="7 IN 1" />
                        </div>
                    </div>
                </div>
                <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <span> 6 IN 1  </span>
                    </div>
                </div>
                <div class="row hide dog">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="Yes" name = "btn_6_in" />
                        <input type="button" class="btn" value="No" name = "btn_6_in" />
                        <div id="6_in" style="display: none">
                        How many months before was the 6 in 1 done ?
                            <input type="text" name="6_in_1" id="vcc_6_in_1" placeholder="6 in 1" />
                        </div>
                    </div>
                </div>
                <div class="row hide dog">
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
                </div>
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
                        <input type="button" class="btn" value="Yes" name = "btn_FeLV" />
                        <input type="button" class="btn" value="No" name = "btn_FeLV" />
                        <div id="FeLV" style="display: none">
                            How many months before was the FVRCP done ?
                            <input type="text" name="felv" id="vcc_FeLV" placeholder="FeLV" />
                        </div>
                    </div>
                </div>
                <div class="row hide dog cat">
                    <div class="col-md-6 mt-3">
                        <span> Rabies / रेबीज </span>
                    </div>
                </div>
                <div class="row hide dog cat">
                    <div class="col-md-6 mt-3">
                        <input type="button" class="btn" value="Yes" name = "btnRabies" />
                        <input type="button" class="btn" value="No" name = "btnRabies" />
                        <div id="dvrabies" style="display: none">
                           How many months before was the rabies vaccination done?
                            <input type="text" name="rabies" id="vcc_rabies" placeholder="Rabies / रेबीज" />
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
                 <div class="row cow">
                    <div class="col-md-6 mt-3">
                        <span> FMD Vaccination done /खुरपका - मुंहपका  का टीका  लगा ?  </span>
                    </div>
                </div>
                <div class="row cow">
                    <div class="col-md-6 mt-3">                      
                        <input type="button" class="btn" value="Yes" name = "vaccination" />
                        <input type="button" class="btn" value="No" name = "vaccination" />  
                    </div>
                </div>
                <div class="row cow">
                    <div class="col-md-6 mt-3">
                        <span> H.S. Vaccination done /गलाघोंटू  का टीका  लगा ?  </span>
                    </div>
                </div>
                <div class="row cow">
                    <div class="col-md-6 mt-3">                      
                        <input type="button" class="btn" value="Yes" name = "vaccination" />
                        <input type="button" class="btn" value="No" name = "vaccination" />  
                    </div>
                </div>
                <div class="row cow">
                    <div class="col-md-6 mt-3">
                        <span> Black Quarter Vaccination done /लंगड़े बुखार  का टीका  लगा ?  </span>
                    </div>
                </div>
                <div class="row cow">
                    <div class="col-md-6 mt-3">                      
                        <input type="button" class="btn" value="Yes" name = "vaccination" />
                        <input type="button" class="btn" value="No" name = "vaccination" />  
                    </div>
                </div>
                <div class="row cow">
                    <div class="col-md-6 mt-3">
                        <span> Brucellousis Vaccination done / ब्रुसेलोसिस का टीका  लगा ?  </span>
                    </div>
                </div>
                <div class="row cow">
                    <div class="col-md-6 mt-3">                      
                        <input type="button" class="btn" value="Yes" name = "vaccination" />
                        <input type="button" class="btn" value="No" name = "vaccination" />  
                    </div>
                </div>     
                <div class="row cow">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><h5>Deworming <h5></label>
                            <!-- <textarea class="form-control" placeholder="Description"></textarea> -->
                           
                          </div>

                    </div>
                </div>
                <div class="row cow dog">
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
            <div class="row hide heard">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="male" class="form-control" id="description" aria-describedby="description" placeholder="No of Male">
                    </div>
                </div>  
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                       <select id="cars" name="carlist" form="carform">
                          <option value="volvo">Chose Breed</option>
                          <option value="saab">Saab</option>
                          <option value="opel">Opel</option>
                          <option value="audi">Audi</option>
                        </select>
                    </div>
                </div>
            </div>           
            <div class="row hide heard">
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                        <input type="text" name="hight" class="form-control" id="description" aria-describedby="description" placeholder="No of Female">
                    </div>
                </div>  
                <div class="col-md-4 mt-4">
                    <div class="form-group">
                       <select id="cars" name="carlist" form="carform">
                          <option value="volvo">Chose Breed</option>
                          <option value="saab">Saab</option>
                          <option value="opel">Opel</option>
                          <option value="audi">Audi</option>
                        </select>
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
$('input[name="category"]').click(function(){
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
                                                      <img src="<?= base_url('uploads/bank/') ?>/'+data.data+'">\
                                                    </div>\
                                                </div>\
                                            </div>\
                                            </label>\
                                            </div>\
                                        </div>';
                            $('.bull_image').append(img);
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
    $(function () {
        $("input[name=btn_FVRCP]").click(function () {
            if ($(this).val() == "Yes") {
                $("#FVRCP").show();
            } else {
                $("#FVRCP").hide();
            }
        });
    });
    $(function () {
        $("input[name=btn_FeLV]").click(function () {
            if ($(this).val() == "Yes") {
                $("#FeLV").show();
            } else {
                $("#FeLV").hide();
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