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
                               <!--  <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 addvid pull-right">
                                        <a href="<?= base_url().'all_videos/video_add'; ?>" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i>Add New Video</a>
                                    </div>
                                </div> -->
                                <div class="row">
                                     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-dropdown-custom dropdown-toggle" data-toggle="dropdown"><span class="fa fa-th"></span> Categories <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                         <?php $data = $this->api_model->product_section();// print_r($data); ?>
                                                            <?php foreach($data as $d){ ?>
                                                                <a onclick="searchVideoDropDownSections('<?= $d['id'] ?>');"  href="#"><?= $d['name'] ?></a>
                                                            <?php } ?>
                                                    </li>
                                                </ul>
                                            </div><!-- /btn-group -->
                                            <input id="searchText" type="text" class="form-control" placeholder="Search...">
                                            <span class="input-group-btn">
                                                <?php 
                                                $splitValue = ''; 
                                                if($newForViewFirst[0]['video_id']) {
                                                    $splitValue = ','; 
                                                }
                                                ?>
                                                <button onclick="searchVideoSections(<?php echo $newForViewFirst[0]['video_id'] . $splitValue . $newForViewFirst[0]['users_video_group_number']; ?>);" class="btn btn-search" type="button"><span class="fa fa-search"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 addvid pull-right mt20-xs">
                                        <a href="<?= base_url().'all_videos/video_add'; ?>" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i>Add Tutorial</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="courses-area">
            <div class="container-fluid">
                <div class="row">
                    <?php 
                    //print_r($newForViewFirst);
                    foreach($newForViewFirst as $key=>$video){
                        $vid = $this->api_model->get_data('video_id = '.$video['video_id'].' and isactive = "1"', 'vedio_list');
                        $count = count($vid);
                        $vim_id = $this->input->get_post('vid_id');
                    ?>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="courses-inner res-mg-b-30">
                            <div class="courses-title">
                                <?php 
                                foreach($vid as $v){
                                    if($vim_id == $v['id']){
                                        if($this->session->userdata("user_type") == 0 || $video['user_id'] == $this->session->userdata("users_id")) {  ?>  
                                            <video controls>
                                              <source src="<?= base_url() .'uploads/videos/'.$v['video']; ?>" type="video/mp4">
                                              Your browser does not support HTML video.
                                            </video>
                                        <?php } else if($video['isactivated'] !== '1') { ?> 
                                            <img src="<?= $v['video_thumb'] ?>">
                                            <!-- <video controls>
                                              <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">
                                              Your browser does not support HTML video.
                                            </video> -->
                                            <p>For full video make a payment</p>
                                        <?php } else { 
                                            //echo "this is test";
                                            ?>
                                            <video controls>
                                                <source src="<?= base_url() .'uploads/videos/'.$v['video']; ?>" type="video/mp4">
                                                Your browser does not support HTML video.
                                            </video>
                                       <?php } 
                                    }   
                                }
                                if($vim_id == ''){
                                    if($this->session->userdata("user_type") == 0 || $video['user_id'] == $this->session->userdata("users_id")) {  ?>  
                                        <video controls>
                                          <source src="<?= base_url() .'uploads/videos/'.$vid[0]['video']; ?>" type="video/mp4">
                                          Your browser does not support HTML video.
                                        </video>
                                    <?php } else if($video['isactivated'] !== '1') { ?> 
                                        <img src="<?= $video['video_thumb'] ?>">
                                        <!-- <video controls>
                                          <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">
                                          Your browser does not support HTML video.
                                        </video> -->
                                        <p>For full video make a payment</p>
                                    <?php } else { 
                                        //echo "this is test";
                                        ?>
                                        <video controls>
                                            <source src="<?= base_url() .'uploads/videos/'.$vid[0]['video']; ?>" type="video/mp4">
                                            Your browser does not support HTML video.
                                        </video>
                                   <?php } 
                                }
                                ?>
                                <span class="video-number"><?php echo $count; ?></span>
                                <div class="videoitems">
                                    <div class="icons">
                                        <ul>
                                            <?php 
                                            $countUserIntrested = $this->api_model->get_data('video_id = '.$vid[0]['id'].' AND users_id = '.$this->session->userdata("users_id").'' , 'video_interest', ''); 
                                            if(!empty($countUserIntrested)) { ?>
                                                <li class="views" onclick="intrested_to_buy(<?= $vid[0]['id'] ?>)">
                                            <?php } else { ?>
                                                <li class="views" style="color: gray;" onclick="intrested_to_buy(<?= $vid[0]['id'] ?>)">
                                            <?php }?>
                                                <span><i class="ion-ios-heart"></i></span> 
                                                <!-- <span class="fa fa-eye"></span> <?php $count = $this->api_model->get_data('video_id = '.$vid[0]['id'].'' , 'video_like', '', 'COUNT(video_id) as count'); echo $count[0]['count']; ?> -->
                                            </li>

                                            <li class="share"><button type="button" class="btn btn-dropdown-share dropdown-toggle" data-toggle="dropdown">Share <span class="fa fa-share ml10"></span></button>
                                                <ul class="dropdown-menu social-media-share">
                                                    <li><a target="__blank" href="http://www.facebook.com/sharer.php?u=https://www.livestoc.com/harpahu_merge_dev/all_videos/video_details?video_id=<?php echo $video['video_id'];?>&group_number=<?php echo $video['users_video_group_number'];?>&p[title]=<?php echo $video['title']?>&p[summary]=<?php echo $video['description'];?>"><span class="fa fa-facebook mr10"></span> Facebook</a></li>
                                                    <li><a target="__blank" href="https://www.instagram.com/share?text=<?php echo $video['title'];?>&url=https://www.livestoc.com/harpahu_merge_dev/all_videos/video_details?video_id=<?php echo $video['video_id'];?>&group_number=<?php echo $video['users_video_group_number'];?>&description=<?php echo $video['description'];?>" ><span class="fa fa-instagram mr10"></span> Instagram</a></li>
                                                    <li><a target="__blank" href="http://twitter.com/share?text=<?php echo $video['title'];?>&url=https://www.livestoc.com/harpahu_merge_dev/all_videos/video_details?video_id=<?php echo $video['video_id'];?>&group_number=<?php echo $video['users_video_group_number'];?>&description=<?php echo $video['description'];?>"><span class="fa fa-twitter mr10"></span> Twitter</a></li>
                                                </ul>
                                            </li>
                                             <li class="pull-right mr10 commentlike" onclick="like(<?= $vid[0]['id'] ?>)">
                                                <?php 
                                                $countUserLike = $this->api_model->get_data('video_id = '.$vid[0]['id'].' AND users_id = '.$this->session->userdata("users_id").'' , 'video_like', ''); 
                                                if(!empty($countUserLike)) { ?>
                                                    <a href="#">
                                                <?php } else { ?>
                                                    <a href="#" style="color: gray;">
                                                <?php }?>
                                                <span class="fa fa-thumbs-up">
                                                </span>  <?php $count = $this->api_model->get_data('video_id = '.$vid[0]['id'].'' , 'video_like', '', 'COUNT(video_id) as count'); echo $count[0]['count']; ?></a>
                                            </li>
                                             
                                            <li class="pull-right mr10 commentlike"><a href="#"><span class="fa fa-comment"></span> <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_rating', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?> </a></li>
                                        </ul>


                                    <div class="courses-alaltic">
                                        <span class="cr-ic-r mt-xs-20">
                                            <span class="course-icon"><i class="fa fa-plus"></i></span>
                                            (<?php $count = $this->api_model->get_data('video_id = '.$vid[0]['id'].'' , 'video_rating', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?>)
                                        </span>

                                        <a data-toggle="collapse" href="#collapseExample<?= $vid[0]['id']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Write a review
                                          </a>
                                        <div class="collapse forreview" id="collapseExample<?= $vid[0]['id']; ?>">
                                          <div class="card card-body">
                                            <div class="rating d-flex">
                                                <p class="text-left mr-4">
                                                    <span class="mr-2">Rating</span>
                                                    <a><span class="ion-ios-star-outline ratings_star" data-rating="1"></span>
                                                    <span class="ion-ios-star-outline ratings_star" data-rating="2"></span>
                                                    <span class="ion-ios-star-outline ratings_star" data-rating="3"></span>
                                                    <span class="ion-ios-star-outline ratings_star" data-rating="4"></span>
                                                    <span class="ion-ios-star-outline ratings_star" data-rating="5"></span></a>
                                                </p>
                                             </div>
                                          <div class="form-group">
                                              <textarea class="form-control" name="commnet" id="commnet<?= $video['video_id']; ?>"  placeholder="Your review *"></textarea>
                                          </div>
                                          <button type="submit"  onclick="rating_review(<?= $video['video_id']; ?>)" class="btn btn-primary float-right">Submit</button>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="courses-alaltic">
                                        <span class="cr-ic-r mt-xs-20">
                                            <span class="course-icon"><i class="fa fa-plus"></i></span>
                                            (<?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_rating', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?>)
                                        </span>    
                                        <a data-toggle="collapse" href="#collapseExampleReview<?= $video['video_id']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Reviews
                                        </a>
                                        <div class="collapse forreview" id="collapseExampleReview<?= $video['video_id']; ?>">
                                            <hr>
                                            <?php $review = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_rating', '', '*');
                                            $i = 0;
                                            if(!empty($review)){
                                              foreach($review as $re){ 
                                                  $i++;
                                                  $user_data = $this->api_model->get_data('users_id = '.$re['users_id'].'' , 'users', '', '*');
                                                  if($i == 10){
                                                    break;
                                                  }
                                                ?> 
                                                <p class="mb-0"><strong><?= $user_data[0]['full_name'] ?></strong></p>
                                                <div class="rating d-flex">
                                                    <p class="text-left">
                                                        <span class="mr-2">Rating</span>
                                                        <?php
                                                        $num = $re['rating'];
                                                        //echo '<p class="ml-2" style="font-size:10px;">Consumer Rating:-';
                                                        for ($n=1; $n<=5; $n++) {
                                                            echo '<span class="ion-ios-star';
                                                                if ($num < $n) {
                                                                    echo '-outline';
                                                                }
                                                            echo '"></span>';
                                                            }
                                                        ?>
                                                    </p>
                                                 </div>
                                                <p><?= $re['feedback'] ?></p>
                                                <?php 
                                                } 
                                            }else{ ?>
                                              <p>No Review Found</p>
                                            <?php } ?>
                                        </div>
                                    </div>


                                    </div>
                                </div>
                                
                                <h2 class="headingcol"><?= $video['title'] ?></h2>
                                <span class="grey">By  <?= $video['user_name'] ?></span>
                                <div class="video-ins grey">
                                    <div class="row">
                                        <div class="col-xs-12 mt10">
                                            <p class="institute mb0"><i class="fa fa-university"></i> Institute: <?= $video['institute'];?></p>
                                        </div>
                                        <div class="col-xs-12 mt10">
                                            <p class="qualification mb0"><i class="fa fa-graduation-cap"></i> Qualification: <?= $video['qualifications'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p><?= $video['description'] ?></p>
                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-calendar"></i></span> <?php  
                                            $orgDate = $video['created_on'];  
                                            $newDate = date("d-M-Y", strtotime($orgDate));  
                                            echo $newDate;  
                                        ?></span>
                                <?php 
                                $categoriesIds = $video['category'];
                                $categoryList = $this->api_model->get_category_wherein($categoriesIds);
                                ?>
                                <p class="categories mt20">Category :
                                <?php 
                                
                                foreach ($categoryList as $key => $value) { ?>
                                   <span><?php echo $value['name']; ?></span> 
                                <?php } ?>
                                </p>
                                <p class="language">Audio: <?php 
                                        $languageValues = explode(',', $video['language']);
                                        foreach ($languageValues as $key => $value) { ?>
                                           <span><?php echo $value; ?></span> 
                                        <?php } ?></p>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?php } 
                    //echo "this is test ".$newForViewFirst[0]['video_id'];
                    $vid = $this->api_model->get_data('video_id = '.$newForViewFirst[0]['video_id'].' and isactive = "1"', 'vedio_list', '', '');
                    $i = 0;
                    foreach ($vid as $key=>$video) { 
                    $vi = $this->api_model->get_data('video_id = '.$video['video_id'].'', 'video_block'); 
                    if($vim_id == '' && $i == '0'){
                        $i++;
                    } else if($vim_id != $video['id'] || $i != '0'){  
                    ?>
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <?php if($key==0) { ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <h4 style="margin-bottom:20px;">More</h4>
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="res-mg-b-30">
                                        <div class="courses-title">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                   <!--  <a title="Play Video" id="thumbnail" class="yt-simple-endpoint inline-block style-scope ytd-thumbnail" aria-hidden="true" tabindex="-1" rel="null" href="<?= base_url()."all_videos/video_play_list?video_id=".$video['video_id']. "&group_number=".$video['users_video_group_number']; ?>">
                                                        <yt-img-shadow ftl-eligible="" class="style-scope ytd-thumbnail no-transition" style="background-color: transparent;" loaded="">css-build:shady-->
                                                            <!-- <img id="img" class="style-scope yt-img-shadow" alt="" src="<?= $video['video_thumb']; ?>" width="9999"></yt-img-shadow> 
                                                    </a> -->
                                                  
                                                    <a id="thumbnail" class="yt-simple-endpoint inline-block style-scope ytd-thumbnail" aria-hidden="true" tabindex="-1" rel="null" href="<?= base_url()."all_videos/video_play_list?video_id=".$video['video_id']. "&vid_id=".$video['id']; ?>">
                                                        <img src="<?= base_url('uploads/videos/images/').$video['video_thumb'] ?>" style="width:100%;height:100%;">
                                                    </a> 
                                                       
                                                    <div class="videoitems">
                                                    
                                                        <div class="icons">
                                                            <ul>
                                                                <?php 
                                                                    $countUserIntrested = $this->api_model->get_data('video_id = '.$video['video_id'].' AND users_id = '.$this->session->userdata("users_id").'' , 'video_interest', ''); 
                                                                    if(!empty($countUserIntrested)) { ?>
                                                                        <li class="views" onclick="intrested_to_buy(<?= $video['video_id'] ?>)">
                                                                    <?php } else { ?>
                                                                        <li class="views" style="color: gray;" onclick="intrested_to_buy(<?= $video['video_id'] ?>)">
                                                                    <?php }?>
                                                                     <span><i class="ion-ios-heart"></i></span>

                                                                </li>

                                                                <li class="share">
                                                                    <ul class="dropdown-menu social-media-share">
                                                                        <li><a href="http://www.facebook.com/sharer.php?u=https://www.livestoc.com/harpahu_merge_dev/all_videos/video_details?video_id=<?php echo $video['video_id'];?>&group_number=<?php echo $video['users_video_group_number'];?>&p[title]=<?php echo $video['title']?>&p[summary]=<?php echo $video['description'];?>"><span class="fa fa-facebook mr10"></span> Facebook</a></li>
                                                                        <li><a href="https://www.instagram.com/share?text=<?php echo $video['title'];?>&url=https://www.livestoc.com/harpahu_merge_dev/all_videos/video_details?video_id=<?php echo $video['video_id'];?>&group_number=<?php echo $video['users_video_group_number'];?>&description=<?php echo $video['description'];?>" ><span class="fa fa-instagram mr10"></span> Instagram</a></li>
                                                                        <li><a href="http://twitter.com/share?text=<?php echo $video['title'];?>&url=https://www.livestoc.com/harpahu_merge_dev/all_videos/video_details?video_id=<?php echo $video['video_id'];?>&group_number=<?php echo $video['users_video_group_number'];?>&description=<?php echo $video['description'];?>"><span class="fa fa-twitter mr10"></span> Twitter</a></li>
                                                                    </ul>

                                                                </li>
                                                               <li class="pull-right mr0 commentlike" onclick="like(<?= $video['video_id'] ?>)">

                                                                 <?php 
                                                                $countUserLike = $this->api_model->get_data('video_id = '.$video['video_id'].' AND users_id = '.$this->session->userdata("users_id").'' , 'video_like', ''); 
                                                                if(!empty($countUserLike)) { ?>
                                                                    <a href="#">
                                                                <?php } else { ?>
                                                                    <a href="#" style="color: gray;">
                                                                <?php }?>


                                                                    <span class="fa fa-thumbs-up"></span>  <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_like', '', 'COUNT(video_id) as count'); echo $count[0]['count']; ?></a></li>

                                                                <li class="pull-right mr10 commentlike"><a href="#"><span class="fa fa-comment"></span> <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_rating', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?> </a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row"> -->
                                                            <!-- <div class="col-xs-12 mt10"> -->
                                                                <p class="institute mb0"> Title: <?= $video['title'];?></p>
                                                            <!-- </div> -->
                                                    <!-- </div> -->
                                        </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    
                    <?php } } ?>
                    </div>
                </div>
               
            </div>
        </div>

        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2020. All rights reserved. LIVESTOC</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer_video.php'); ?>
  <script>
  
    $(document).ready(function () {
      $(".ratings_star").click(function () {
      $(".ratings_star").removeClass("selected_rating");
        $(this).addClass("selected_rating");
       var rating = $(this).data('rating'); // Get the rating from the selected star
        $(this).addClass("ion-ios-star");
        $(this).removeClass("ion-ios-star-outline");
        $(this).prevAll().removeClass("ion-ios-star-outline");
        $(this).prevAll().addClass("ion-ios-star");
        $(this).nextAll().removeClass("ion-ios-star");
        $(this).nextAll().addClass("ion-ios-star-outline");
      });
    });
    
  function rating_review($video_id){
       var video_id = $video_id;
       var users_id ="<?= $this->session->userdata("users_id") ?>";
       var rating_val = $(".selected_rating").data('rating');
       var feedback =  $("#commnet"+$video_id).val();
       $.ajax({
           url: '<?= base_url('all_videos/rating_ajax') ?>',
           type: 'post',
           data: {video_id:video_id,users_id:users_id,feedback:feedback,rating:rating_val},
           dataType: 'text',
           success: function(data){
                if(data== 'Your Product Review Send'){
                    $('.review-popup').hide();
                    location.reload();
                }else{
                    alert(data);
                }
        
           }
         }); 
  }
    <?php if($this->session->userdata("users_id")){ ?>
      function like($video_id){
        var video_id = $video_id;
        var users_id = <?= $this->session->userdata("users_id") ?>;
        var type = "<?php echo $this->session->userdata("user_type"); ?>";
        $.ajax({
                type: "POST",
                url: "<?= base_url('all_videos/') ?>"+"add_like",
                data: { video_id: video_id, users_id: users_id, type: type},
                dataType: "json",
                cache : false,
                success: function(data){
                    //alert(data.msg);
                    location.reload();
                } 
            });
      }
    <?php } ?>

    var dropDownSections = '';
    function searchVideoDropDownSections($value) {
        dropDownSections = $value;
        searchVideoSections();
    }

    function searchVideoSections($video_id = '', $group_number = '') {
        if($video_id=='' &&  $group_number == '')
        {
           window.location.reload();
        } else {
            var searchText = $('#searchText').val();
            window.location.href ='<?= base_url('all_videos/video_play_list?video_id=') ?>'+$video_id+'&group_number='+$group_number+'&searchText='+searchText+'&dropDownSections='+dropDownSections; 
        }
    }

  </script>
