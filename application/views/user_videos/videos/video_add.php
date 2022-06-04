    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class="educate-icon educate-nav"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <?php include('header_user_details.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 addvid pull-right">
                                        <a href="<?= base_url() ?>all_videos" class="btn btn-primary waves-effect waves-light"><i class="fa fa-arrow-left"></i>Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


                <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st forcusttabs">
                            <ul id="myTabedu1" class="tab-review-design">
                                <?php if($actiNewTab == 0) {?>
                                    <li class="active"><a href="#description"><?= $webLanguage['Author Information']?></a></li>
                                <?php } else { ?>
                                     <li><a href="#description">Author Information</a></li>
                                <?php } ?>

                                <?php if($actiNewTab == 1) {?>
                                    <li class="active"><a href="#reviews"> <?= $webLanguage['Video Details']?></a></li>
                                <?php } else { ?>
                                    <li><a href="#reviews"> <?= $webLanguage['Video Details']?></a></li>
                                <?php } ?>

                                <?php if($actiNewTab == 2) {?>
                                    <li  class="active"><a href="#INFORMATION"><?= $webLanguage['Upload Videos']?></a></li>
                                <?php } else { ?>
                                    <li><a href="#INFORMATION"><?= $webLanguage['Upload Videos']?></a></li>
                                <?php } ?>
   
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade <?php if($actiNewTab == 0) {?> active in ?php } else { ?> <?php } ?>" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad addcoursepro">
                                                    <form method="POST" class="dropzone dropzone-custom needsclick addcourse" id="demo1-upload" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="SubmittedBy"><?= $webLanguage['Submitted By']?></label>
                                                                    <input value="<?php echo $submittedby ?>" name="submittedby" id="submittedby" type="text" required class="form-control mt10 mb30">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="Qualification"><?= $webLanguage['Qualification']?></label>
                                                                    <input value="<?php echo $qualifications ?>" name="qualifications" id="qualifications" required type="text" class="form-control mt10 mb30">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="Institution"><?= $webLanguage['Institution']?></label>
                                                                    <input value="<?php echo $institute ?>" type="text" name="institute" id="institute" required type="text" class="form-control mt10 mb30">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="payment-adress mt45">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light wforbutton"><?= $webLanguage['Next']?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade <?php if($actiNewTab == 1) {?> active in ?php } else { ?> <?php } ?>" id="reviews">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <form method="POST" class="dropzone dropzone-custom needsclick addcourse" id="demo1-upload">
                                                <input value="<?php echo $submittedby ?>" name="submittedby" type="hidden">
                                                <input value="<?php echo $qualifications ?>" name="qualifications" type="hidden">
                                                <input value="<?php echo $institute ?>" type="hidden" name="institute" id="institute" >
                                                         <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 forhead mt20">
                                                                <h4><?= $webLanguage['Tutorial Type']?></h4>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                <label>
                                                                <input type="radio" name="type" id="type" value="1" <?php if($type == '1'){ echo "checked"; } ?>> <i></i> <?= $webLanguage['Series (Multiple videos)']?></label>
                                                                </div>
                                                          <!--   </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> -->
                                                                <div class="form-group">
                                                                <label>
                                                                <input type="radio" name="type" id="type" value="0" <?php if($type != '1'){ echo "checked"; } ?>> <i></i> <?= $webLanguage['Single Video']?> </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 forhead mt20">
                                                                <h4><?= $webLanguage['Tutorial is based on']?></h4>
                                                                <?php 
                                                                    $categoryNew = explode(',', $category);
                                                                    //print_r($categoryNew);
                                                                ?>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 forcheck">
                                                                <div class="row">
                                                                <div class="bt-df-checkbox pull-left w-100">
                                                                    <?php $data = $this->api_model->product_section(); 
                                                                    //print_r($data);
                                                                        foreach ($data as $d) {?>
                                                                         <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                            <div class="i-checks pull-left">
                                                                                <label>
                                                                                <input <?php if(in_array($d['id'], $categoryNew)) { echo "checked='checked'"; } ?> type="checkbox" name="checkboxExpertise[]" value="<?php echo $d['id']; ?>"> <i></i> <?php echo $d['name']; ?> </label>
                                                                            </div>
                                                                        </div>  
                                                                      <?php  }
                                                                     ?>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                             </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="Institution"><?= $webLanguage['Heading of the series/ Video']?></label>
                                                                    <input value="<?php echo $title ?>" type="text" name="heading" id="heading" required name="heading" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="Institution"><?= $webLanguage['Description of the series/ Video']?></label>
                                                                    <textarea  name="description" id="description" required name="description" class="form-control mt10 mb30"><?php echo $description ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no_of_series" <?php if($type != '1'){ ?>style="display:none;" <?php } ?>>
                                                                <div class="form-group">
                                                                    <label for="Institution">No of Videos in Series</label>
                                                                    <input value="<?php if($size != ''){ echo $size; }else{ echo  "1"; } ?>" type="number" name="size" id="size" required name="size" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="Institution"><?= $webLanguage['Language']?></label>
                                                                    <select id="language" name="language" class="form-control" required>
                                                                        <option value="none" selected="" disabled=""><?= $webLanguage['Language']?></option>
                                                                        <?php
                                                                        $lang = $this->api_model->get_data('','language'); 
                                                                        foreach($lang as  $la){ 
                                                                            //echo print_r($la); ?>
                                                                        <option value="<?= $la['code'] ?>" <?php if($la['code'] == $language){ echo "selected"; } ?>><?= $la['name'] ?></option>
                                                                        <?php } ?>
                                                                        </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                                                <div class="form-group">
                                                                    <label for="Institution"><?= $webLanguage['Subject']?></label>
                                                                    <select id="subject" name="subject" class="form-control" required>
                                                                        <option value="none" selected="" disabled=""><?= $webLanguage['Subject']?></option>
                                                                        <option <?php if($subject == 'Anatomy') echo"selected"; ?> value="Anatomy">Anatomy</option>
                                                                        <option <?php if($subject == 'Physiology') echo"selected"; ?> value="Physiology">Physiology</option>
                                                                        <option <?php if($subject == 'Bochemistry') echo"selected"; ?> value="Bochemistry">Bochemistry</option>
                                                                        <option <?php if($subject == 'Animal Nutrition') echo"selected"; ?> value="Animal Nutrition">Animal Nutrition</option>
                                                                        <option <?php if($subject == 'Livestock Production and Management') echo"selected"; ?> value="Livestock Production and Management">Livestock Production and Management</option>
                                                                        <option <?php if($subject == 'Livestock Products Technology') echo"selected"; ?> value="Livestock Products Technology">Livestock Products Technology</option>
                                                                        <option <?php if($subject == 'Microbiology') echo"selected"; ?> value="Microbiology">Microbiology</option>
                                                                        <option <?php if($subject == 'Virology') echo"selected"; ?> value="Virology">Virology</option>
                                                                        <option <?php if($subject == 'Animal Breeding and Genetics') echo"selected"; ?> value="Animal Breeding and Genetics">Animal Breeding and Genetics</option>
                                                                        <option <?php if($subject == 'Veterinary Medicine') echo"selected"; ?> value="Veterinary Medicine">Veterinary Medicine</option>
                                                                        <option <?php if($subject == 'Veterinary Surgery') echo"selected"; ?> value="Veterinary Surgery">Veterinary Surgery</option>
                                                                        <option <?php if($subject == 'Gynaecology and Obstetrics') echo"selected"; ?> value="Gynaecology and Obstetrics">Gynaecology and Obstetrics</option>
                                                                        <option <?php if($subject == 'Pathology') echo"selected"; ?> value="Pathology">Pathology</option>
                                                                        <option <?php if($subject == 'Parasitology') echo"selected"; ?> value="Parasitology">Parasitology</option>
                                                                        <option <?php if($subject == 'Ethno Veterinary & Ayurveda') echo"selected"; ?> value="Ethno Veterinary & Ayurveda">Ethno Veterinary & Ayurveda</option>
                                                                        <!-- <option value="Others">Others</option> -->
                                                                    </select>
                                                                    <!-- <input value="<?php echo $subject ?>" type="text" id="subject" name="subject" required class="form-control"> -->
                                                                   <!--  <div>
                                                                        <input >
                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="Institution"><?= $webLanguage['Price in INR']?></label>
                                                                    <input value="<?php echo $price ?>" type="text" pattern=".{0,9}" id="video_price" name="price"  required class="form-control" placeholder="&#8377;">
                                                                </div>
                                                                <div class="form-group">
                                                                     <label><?= $webLanguage['Important: Please note that Livestoc M/S Amaze Brandlance Private Limited will deduct 50% of the price quoted by you as its service charges.']?></label>
                                                                </div>
                                                            </div> 
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 forhead mt20">
                                                                    <label><?= $webLanguage['Show To (You can select Multiple)']?></label>
                                                                </div>
                                                                <?php $sh = explode(',', $showto); 
                                                                ?>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="i-checks pull-left">
                                                                        <label>
                                                                            <input <?php if(in_array('Veterinariaans', $sh)) { echo "checked='checked'"; } ?> type="checkbox" name="showto[]" value="Veterinariaans"> <i></i> <?= $webLanguage['Veterinariaans']?>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                            <div class="i-checks pull-left">
                                                                                <label>
                                                                                    <input <?php if(in_array('Farmers', $sh)) { echo "checked='checked'"; } ?> type="checkbox" name="showto[]" value="Farmers"> <i></i> <?= $webLanguage['Farmers']?>
                                                                                </label>
                                                                            </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                            <div class="i-checks pull-left">
                                                                                <label>
                                                                                    <input <?php if(in_array('Pet Owners', $sh)) { echo "checked='checked'"; } ?> type="checkbox" name="showto[]" value="Pet Owners"> <i></i> <?= $webLanguage['Pet Owners']?> 
                                                                                </label>
                                                                            </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                            <div class="i-checks pull-left">
                                                                                <label>
                                                                                    <input <?php if(in_array('Paravets', $sh)) { echo "checked='checked'"; } ?> type="checkbox" name="showto[]" value="Paravets"> <i></i> <?= $webLanguage['Paravets']?> 
                                                                                </label>
                                                                            </div>
                                                                </div>
                                                            </div>
                                                            <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt30">
                                                                <div class="form-group">
                                                                    <label for="Institution">Sub Title</label>
                                                                    <input name="subject" type="text" class="form-control mt10 mb30" placeholder="sub Title">
                                                                </div>
                                                            </div> -->    
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="payment-adress mt20">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light wforbutton"><?= $webLanguage['Next']?></button>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                <div class="product-tab-list tab-pane fade <?php if($actiNewTab == 2) {?> active in ?php } else { ?> <?php } ?>" id="INFORMATION">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <form method="POST" class="dropzone dropzone-custom needsclick addcourse" id="demo1-upload" >
                                                <input type="hidden" name="qualifications" id="qualifications" value="<?php echo $qualifications ?>">
                                                <input type="hidden" name="institute" id="institute" value="<?php echo $institute ?>">
                                                <input type="hidden" name="submittedby" id="submittedby" value="<?php echo $submittedby ?>">
                                                <input type="hidden" name="checkboxExpertise" id="checkboxExpertise" value="<?php echo $category ?>">
                                                <input type="hidden" name="language" id="language" value="<?php echo $language ?>">
                                                <input type="hidden" name="sublanguage" id="sublanguage" value="<?php echo $sublanguage ?>">
                                                <input type="hidden" name="showto" value='<?= $showto ?>'> 
                                                <input type="hidden" name="subject" value='<?= $subject ?>'> 
                                                <input type="hidden" name="price" value='<?= $price ?>'> 
                                                <input type="hidden" name="heading" value='<?= $title ?>'>
                                                <input type="hidden" name="description" value='<?= $description ?>'>
                                                <input type="hidden" name="size" value='<?= $size ?>'>
                                                <input type="hidden" name="language" value='<?= $language ?>'> 
                                                <input type="hidden" name="type" value='<?= $type ?>'> 
                                                <input type="hidden" name="expertise" id="expertise" value="1">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                            <div class="videsource"> 
                                                              
                                                            <div class="row" id="newvid">
                                                            <div class="col-md-12 col-xs-12 text-left videoname">
                                                                <h4><?= $webLanguage['Videos']?></h4>    
                                                            </div>     
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">     
                                                                <div class="form-group alert-up-pd mt20 mb0">
                                                                    <div class="dz-message needsclick download-custom">
                                                                        <i class="fas fa-video"></i>
                                                                        <h2 class="edudropnone mt20"><?= $webLanguage['Drop video here or click to upload.']?></h2>
                                                                        <!-- <p class="edudropnone mb0"><span class="note needsclick">Max size 100MB allowed. </span>
                                                                        </p> -->
                                                                        <input name="imageico" class="hd-pro-img" type="text" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                                                            <div class="form-group alert-up-pd mt20 mb0">
                                                                    <div class="dz-message needsclick download-custom">
                                                                        <i class="fa fa-image"></i>
                                                                        <h2 class="edudropnone mt20"><?= $webLanguage['Drop thumbnail here or click to upload.']?></h2>
                                                                        <!-- <p class="edudropnone mb0"><span class="note needsclick">Max size 20MB allowed.</span>
                                                                        </p> -->
                                                                        <input name="imageico" class="hd-pro-img" type="text" />
                                                                    </div>
                                                                </div>    
                                                            </div>
                                                            </div> 
                                                            <!-- <div class="row">
                                                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">   
                                                                    <div class="videopreview">    
                                                                    <video controls>
                                                                      <source src="<?= base_url() ?>assets/allvideos/videos/baby_dog13.mp4" type="video/mp4">
                                                                      Your browser does not support HTML video.
                                                                    </video> 
                                                                    </div>    
                                                                </div>    
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center mt20-xs">
                                                                    <div class="thumbnailpreview">
                                                                        <img src="<?= base_url() ?>assets/allvideos/img/puppy.jpeg">    
                                                                    </div> 
                                                                </div>
                                            
                                                            </div>  -->
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <?php if( $error = $this->session->flashdata('add_rol')){ ?>
                                                                    <diV class="col-md-3"></div>
                                                                    <div class="col-md-9 corm_nmset">
                                                                        <div class=" error" style="margin-left:0%;">
                                                                            <?= $error ?>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php //print_r($_SESSION) ?>
                                                                 <div class="form-group ref" style="text-align: center; display:none;">
                                                                  <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                                                                </div>
                                                                <?php echo form_error('name'); ?>
                                                                 <input type="hidden" name="addVideoCount" id="addVideoCount" value="0">
                                                                 <?php 
                                                                 $size = $size != '' ? $size : '1'; 
                                                                 for($i = 0; $i<$size; $i++){
                                                                    $display = '';
                                                                    if($i >= 5){
                                                                        $display = "display:none;";
                                                                    }
                                                                    $d = $i+1;
                                                                     echo '<div style="'.$display.' margin-top:10px; margin-bottom:10px;" class="adddisplay_'.$i.'"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                                                                        <input type="hidden" name="vedio_name_'.$i.'" id="vedio_name_'.$i.'" class="vedio_nam" value="">
                                                                        <input style="margin: auto; margin-top:10px; margin-bottom:10px;" class="set_width vedio_name" name="video_name'.$i.'" id="video_name'.$i.'" readonly="readonly" type="file" /></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center mt20-xs">
                                                                        <input type="hidden" name="vedio_thumb_'.$i.'" id="vedio_thumb_'.$i.'" class="vedio_thumb_name" value="">
                                                                        <input style="margin: auto; margin: auto; margin-top:10px; margin-bottom:10px;" class="set_width" name="video_image'.$i.'" id="video_image'.$i.'" readonly="readonly" type="file" /></div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                            <div class="form-group">
                                                                                <label for="SubmittedBy">'.$webLanguage['Video Title'].'</label>
                                                                                <input  name="video_title_'.$i.'" id="video_title_'.$i.'" type="text" required class="form-control mt10 mb30">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                            <div class="form-group">
                                                                                <label for="SubmittedBy">'.$webLanguage['Video Description'].'</label>
                                                                                <input  name="video_dis_'.$i.'" id="video_dis_'.$i.'" type="text" required class="form-control mt10 mb30">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mt20-xs" style="text-align: right;"><span class="btn btn-primary"  data-toggle="modal" data-target="#modal-default__'.$i.'">'.$webLanguage['Add PDF'].'</span>&nbsp;&nbsp';
                                                                        $dis = '';
                                                                        if($i < 400){
                                                                            $dis =  "style = 'display: none;'";
                                                                        }
                                                                        echo '<span class="btn btn-primary add_more  waves-effect waves-light addmore" onclick="add_display('.$d.')" '.$dis.'>Add More Videos</span>';
                                                                        //}
                                                                        echo '</div></div>';
                                                                    
                                                                 }?>
                                                                <!--  <input style="margin-top: 20px;" id='addVideoMoreButton' class="btn btn-primary waves-effect waves-light addmore" type="button" id="more_fields" value="Add More Videos" />  -->
                                                            </div>   
                                                             <div class="row">
                                                                    <button type="submit" class="submitvideo btn btn-primary waves-effect waves-light wforbutton"><?= $webLanguage['Submit']?></button>
                                                                        
                                                                </div>  
                                                    </div>
                                                </div>
                                                 <!-- <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-6 col-xs-12 text-center"> --> 
                                                   
                                                <!-- </div> -->
                                                <?php for($i = 0; $i<$size; $i++){
                                                 echo '<div class="modal fade" id="modal-default__'.$i.'" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">'.$webLanguage['Upload PDF'].'</h4>
                                                        </div>
                                                        <div class="modal-body">';
                                                        ?>
                                                        <div class="form-group ref_ref" style="text-align: center; display:none;">
                                                            <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                                                        </div>
                                                        <?php
                                                        $lang = $this->api_model->get_all_languages();
                                                        //echo count($lang);
                                                        foreach($lang as $la){
                                                            echo '<div class="col-md-12"><div class="col-md-6">';
                                                            echo '<select name="lang_'.$i.'_'.$la['id'].'" class="form-control">';
                                                                echo '<option value="">Language</option>';
                                                                foreach($lang as $l){
                                                                    echo '<option value="'.$l['id'].'">'.$l['name'].'</option>';
                                                                }
                                                            echo '</select>';
                                                            echo '</div>';
                                                            echo '<div class="col-md-6">';
                                                            echo '<input type="hidden" name="pdf_name_'.$i.'_'.$la['id'].'" id="pdf_name_'.$i.'_'.$la['id'].'">';
                                                            echo '<input style="margin: auto;" class="set_width" name="video_pdf_'.$i.'_'.$la['id'].'" id="video_pdf_'.$i.'_'.$la['id'].'" readonly="readonly" type="file" />';
                                                            echo '</div></div>';
                                                        }
                                                        echo '</div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">'.$webLanguage['Upload'].'</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>';
                                                }
                                                ?>
                                               <!--  <div class="row">
                                                        <button type="submit" class="submitvideo btn btn-primary waves-effect waves-light wforbutton">Submit</button>
                                                            
                                                </div> -->
                                            </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2020. All rights reserved. LIVESTOC PRO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php include('footer_video.php'); ?>
<style type="text/css">
.upload-area:hover{
    cursor: pointer;
}
.upload-area h2{
    text-align: center;
    font-weight: normal;
    font-family: sans-serif;
    line-height: 50px;
    color: darkslategray;
}
#video_name{
    display: none;
}
.split_values_two_row div {
    float: left;
    width: 50%;
}
.first_right-row{
    margin-top:30px!important;
}

/* Code By Webdevtrick ( https://webdevtrick.com ) */
.box-header {
  color: #444;
  display: block;
  padding: 10px;
  position: relative;
  border-bottom: 1px solid #f4f4f4;
  margin-bottom: 10px;
}
.box-tools {
  position: absolute;
  right: 10px;
  top: 5px;
}
.dropzone-wrapper {
  border: 2px dashed #91b0b3;
  color: #92b0b3;
  position: relative;
  height: 50px;
}
.dropzone-desc {
  position: absolute;
  margin: 0 auto;
  left: 0;
  right: 0;
  text-align: center;
  width: 40%;
  top: 2px;
  font-size: 16px;
}
.dropzone-new,.dropzone-new:focus {
  position: absolute;
  outline: none !important;
  width: 100%;
  height: 60px;
  cursor: pointer;
  opacity: 0;
}
.dropzone-wrapper:hover,.dropzone-wrapper.dragover-new {
  background: #ecf0f5;
}
.preview-zone {
  text-align: center;
}
.preview-zone .box {
  box-shadow: none;
  border-radius: 0;
  margin-bottom: 0;
}
</style>
<script type="text/javascript">
$('input[name="type"]').click(function(){
    if($(this).val() == '1'){
        $('.no_of_series').show();
    }else{
        $('.no_of_series').hide();
    }
})
    <?php for($i = 0; $i<$size; $i++){?>
        $('#video_name<?= $i ?>').change(function(){
            $('#file_name').html('');
            $('#file_name').html($('#video_name<?= $i ?>')[0].files[0].name);
            var file_data = $('#video_name<?= $i ?>').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('image', file_data);
             $('.ref').show();
            $.ajax({
                url: "<?= base_url() ?>Api/upload_vedio?path=videos",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    data = JSON.parse(data);
                    $('#vedio_name_<?= $i ?>').val(data.video_name);
                    $('.ref').hide();
                }
            });
        });
         $('#video_image<?= $i ?>').change(function(){
            $('#file_name').html('');
            $('#file_name').html($('#video_image<?= $i ?>')[0].files[0].name);
            var file_data = $('#video_image<?= $i ?>').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('image', file_data);
             $('.ref').show();
            $.ajax({
                url: "<?= base_url() ?>Api/web_cropper_images?path=videos/images",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    data = JSON.parse(data);
                    $('#vedio_thumb_<?= $i ?>').val(data.data);
                    $('.ref').hide();
                }
            });
        });

    <?php  $lang = $this->api_model->get_all_languages();
            foreach($lang as $la){
            ?>
                $('#video_pdf_<?= $i ?>_<?= $la['id'] ?>').change(function(){
                        $('#file_name').html('');
                        $('#file_name').html($('#video_pdf_<?= $i ?>_<?= $la['id'] ?>')[0].files[0].name);
                        var file_data = $('#video_pdf_<?= $i ?>_<?= $la['id'] ?>').prop('files')[0];   
                        var form_data = new FormData();                  
                        form_data.append('image', file_data);
                        $('.ref_ref').show();
                        $.ajax({
                            url: "<?= base_url() ?>Api/web_upload_Images?path=videos",
                            type: "POST",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData:false,
                            success: function(data){
                                data = JSON.parse(data);
                                $('#pdf_name_<?= $i ?>_<?= $la['id'] ?>').val(data.data);
                                $('.ref_ref').hide();
                            }
                        });
                });
            <?php
            }
     } ?>
    $('.add_more').click(function(){
        $(this).hide()
        $(this).parent().parent().next();
    })
    function add_display(ele){
        $('.adddisplay_'+ele+'').show();
    }
    function add_pdf(id){
        alert(id);
    }
   $(function() {
    $('#addVideoMoreButton').on("click", function(e){ 
        /*var indexValueForVideo = parseInt($('#addVideoCount').val());
        $('<?php if (isset($success) && strlen($success)) {echo '<div class="success">';echo '<p>'.$success. '</p>';echo '</div>';echo '<object width="338" height="300"><param name="src" value="' . $video_path . '/' . $video_name . '"><param name="autoplay" value="false"><param name="controller" value="true"><param name="bgcolor" value="#333333"><embed type="' . $video_type . '" src="' . $video_path . '/' . $video_name . '" autostart="false" loop="false" width="338" height="300" controller="true" bgcolor="#333333"></embed></object>';}if (isset($errors) && strlen($errors)) {echo '<div class="error">'; echo '<p>' . $errors . '</p>';echo '</div>';}if (validation_errors()) { echo validation_errors('<div class="error">', '</div>');}?><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center"><div class="videopreview"><input style="margin: auto;" class="set_width" name="video_name'+indexValueForVideo+'" id="video_name'+indexValueForVideo+'" readonly="readonly" type="file" /></div></div></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center mt20-xs"><div class="thumbnailpreview"><input style="margin: auto;" class="set_width" name="video_image'+indexValueForVideo+'" id="video_image'+indexValueForVideo+'" readonly="readonly" type="file" /></div></div>').insertBefore('#addVideoMoreButton');
        var nextValue = parseInt($('#addVideoCount').val()) + 1;
        $('#addVideoCount').val(nextValue);*/

        var indexValueForVideo = parseInt($('#addVideoCount').val());
        $('<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center"><div class="videopreview"><input style="margin: auto;" class="set_width" name="video_name'+indexValueForVideo+'" id="video_name'+indexValueForVideo+'" readonly="readonly" type="file" /></div></div></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center mt20-xs"><div class="thumbnailpreview"><input style="margin: auto;" class="set_width" name="video_image'+indexValueForVideo+'" id="video_image'+indexValueForVideo+'" readonly="readonly" type="file" /></div></div>').insertBefore('#addVideoMoreButton');
        $('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"><span class="videopdf btn btn-primary" onclick="add_pdf('+indexValueForVideo+')">Add PDF</span></div>').insertBefore('#addVideoMoreButton');
        var nextValue = parseInt($('#addVideoCount').val()) + 1;
        $('#addVideoCount').val(nextValue);


    });
     
    // preventing page from redirecting
    $("html").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("h2").text("Drag here");
    });
    $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });
    // Drag enter
    $('.upload-area').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h2").text("Drop");
    });
    // Drag over
    $('.upload-area').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h2").text("Drop");
    });
    // Drop
    $('.upload-area').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h2").text("Upload");
        var file = e.originalEvent.dataTransfer.files;
        var fd = new FormData();
        fd.append('file', file[0]);
    });
    // Open file selector on div click
    $("#uploadfile").click(function(){
        $("#video_name").click();
    });
    // file selected
    $("#video_name").change(function(){
        var fd = new FormData();
        var files = $('#video_name')[0].files[0];
        fd.append('file',files);
    });

    //File upload functions
    function readFile(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var htmlPreview =
            '<img width="200" src="' + e.target.result + '" />' +
            '<p>' + input.files[0].name + '</p>';
          var wrapperZone = $(input).parent();
          var previewZone = $(input).parent().parent().find('.preview-zone');
          var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');
          wrapperZone.removeClass('dragover-new');
          previewZone.removeClass('hidden');
          boxZone.empty();
          boxZone.append(htmlPreview);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
     
    function reset(e) {
      e.wrap('<form>').closest('form').get(0).reset();
      e.unwrap();
    }
     
    $(".dropzone-new").change(function() {
      readFile(this);
    });
     
    $('.dropzone-wrapper').on('dragover-new', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).addClass('dragover-new');
    });
     
    $('.dropzone-wrapper').on('dragleave', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).removeClass('dragover-new');
    });
     
    $('.remove-preview').on('click', function() {
      var boxZone = $(this).parents('.preview-zone').find('.box-body');
      var previewZone = $(this).parents('.preview-zone');
      var dropzone = $(this).parents('.form-group').find('.dropzone-new');
      boxZone.empty();
      previewZone.addClass('hidden');
      reset(dropzone);
    });
});
</script>