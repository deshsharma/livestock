
<section>
        <div class="container-fluid p0">
            <div class="video-tutorial primary-grey mt-5">
            <div class="row">
                <div class="col-md-9">
                    <h4><strong><?= $this->webLanguage['ONLINE VETERINARY COURSES AND VIDEO TUTORIALS']?></strong></h4>
                    <p class="mt-3 viddetail"><?= $this->webLanguage['By Expert Veterinarians. Learn Latest Techniques and Procedures. Animal Health Management for Enchanced Profitablity']?> <strong></strong> <br> <strong></strong></p>
                </div>
                <div class="col-md-3 pl-md-5">
                    <button onclick="goToVideoTutorials()" type="button" class="btn btn-info w-100"><?= $this->webLanguage['View Video Tutorials']?></button>
                    <button onclick="goPostVideoTutorials()" type="button" class="btn btn-success mt-3 w-100"><?= $this->webLanguage['Post Videos Now']?></button>
                </div>
            </div>
                
            <!--courses-area-->
                <div class="courses-area video-section mt-3">
                <div class="row">
                    <div id="owl-carousel4" class="owl-carousel owl-theme">
                    <?php  
                    //print_r($data['video_tutorials']);
                    foreach ($data['video_tutorials'] as $key => $video) { 
                        ?>
                        <div class="item">
                        <div class="col-md-12">
                            <div class="courses-inner res-mg-b-30 video-bg">
                                <div class="courses-title">
                                    <div class="videouter">
                                    <img src="<?= $video['video_thumb'] ?>" alt="Vet on Call by Livestoc">
                                        <span class="video-number"><?php echo $key + 15; ?></span>
                                    </div>    
                                    <div class="videoitems">
                                    
                                    <div class="icons">
                                        <ul>
                                            <li class="views"><span class="fa fa-eye"></span>
                                                <?php 
                                                $countUserIntrested = $this->api_model->get_data('video_id = "'.$video['video_id'].'"' , 'video_interest', '', 'count(id) as count'); 
                                                if(!empty($countUserIntrested)) { ?>
                                                    <?= $countUserIntrested[0]['count'] ?>
                                                <?php } else { ?>
                                                   <?= $countUserIntrested[0]['count'] ?>
                                                <?php }?>
                                            </li>

                                            <li class="share"><button type="button" class="btn btn-dropdown-share dropdown-toggle" data-toggle="dropdown">Share <span class="fa fa-share ml10"></span></button>
                                                <ul class="dropdown-menu social-media-share">
                                                     <?php
                                                    $useragent=$_SERVER['HTTP_USER_AGENT'];
                                                    if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){ 
                                                    ?>
                                                        <li><a  target="__blank" href="https://api.whatsapp.com/send?text=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-whatsapp mr10"></span>whatsapps</a></li>
                                                    <?php }else{ ?>
                                                        <li><a target="__blank" href="https://web.whatsapp.com/send?text=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-whatsapp mr10"></span>whatsapps</a></li>
                                                    <?php } ?><br>
                                                    <li><a href="http://www.facebook.com/sharer.php?u=https://www.livestoc.com/all_videos&p[title]=video livestoc"><span class="fa fa-facebook mr10"></span> Facebook</a></li><br>
                                                    <li><a href="https://www.instagram.com/share?text=videoForview&url=https://www.livestoc.com/all_videos"><span class="fa fa-instagram mr10"></span> Instagram</a></li><br>
                                                    <li><a href="http://twitter.com/share?text=video livestoc&url=https://www.livestoc.com/all_videos"><span class="fa fa-twitter mr10"></span> Twitter</a></li>
                                                </ul>
                                            </li>

                                            <li class="float-right mr10 commentlike">

                                                <?php 
                                                $countUserLike = $this->api_model->get_data('video_id = '.$video['video_id'].' AND users_id = '.$this->session->userdata("users_id").'' , 'video_like', ''); 
                                                if(!empty($countUserLike)) { ?>
                                                    <a href="#">
                                                <?php } else { ?>
                                                    <a href="#" style="color: gray;">
                                                <?php }?>

                                                <span class="fa fa-thumbs-up"></span>  <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_like', '', 'COUNT(video_id) as count'); echo $count[0]['count']; ?></a>


                                            </li>
                                            <li class="float-right mr10 commentlike">

                                               <a href="#"><span class="fa fa-comment"></span> <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_rating', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?> </a>

                                            </li>
                                        </ul>
                                    </div>
                                    
                                    </div>
                                    <h2 class="headingcol"><?= ucfirst($video['seris_title']) ?></h2>
                                    <h5 class="headingcol" style="font-size: 15px;"><?= ucfirst($video['title']) ?></h5>
                                    <span class="grey"> <?= ucfirst($video['submittedby']) ?></span>
                                    <p class="grey mb0"> <?= $video['qualifications'] ?></p>
                                    <div class="video-ins grey">
                                        <div class="row">
                                            <div class="col-12 mt-1">
                                                <p class="institute mb0"> <?= $video['institute'] ?></p>
                                            </div>
                                          
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="trunc"><?= $video['description']; ?></p>
                                    <p class="language mt-0">Audio: <?php 
                                        $languageValues = explode(',', $video['language']);
                                        foreach ($languageValues as $key => $value) { if($key > 3) { break; }?>
                                           <span><?php echo $value; ?>..</span> 
                                        <?php } ?>
                                    </p>
                                </div>
                                <div class="product-buttons mt-5">
                                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?= base_url('/')."all_videos"; ?>'">
                                        <span class="float-left w-50 bdrr"><i class="fas fa-rupee-sign"></i> <?= $video['price']; ?></span><span class="float-right w-50"><i class="fas fa-video"></i> WATCH </span></button>
                                        
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php  } ?>
                     
                    </div>    
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    