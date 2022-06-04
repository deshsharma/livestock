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
                                     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <label class="form-control" for="profile_image" type="text">Title: <?php echo $newForViewFirst[0]['title']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if( $this->session->userdata("users_id") != ''){ ?>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 addvid pull-right mt20-xs">
                                        <a href="<?= base_url().'all_videos/video_add'; ?>" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i>Add Tutorial</a>
                                    </div>
                                    <?php } ?>
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
                    foreach($newForViewFirst as $key=>$video){
                         $status_data = $this->api_model->vedio_status($video['video_id'], $this->session->userdata("users_id"), $this->session->userdata('user_type'));
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
                        <div class="courses-inner res-mg-b-30">
                            <div class="courses-title">
                                <?php if(empty($status_data)){ ?>
                                <img src="<?= $video['video_thumb'] ?>">
                            <?php }else{ ?>
                                 <video controls>     
                                                <source src="<?= base_url() .'uploads/videos/'.$video['video']; ?>" type="video/mp4">
                                </video>
                            <?php } ?>
                                <!-- <video controls>
                                  <source src="https://www.w3schools.com/tags/movie.mp4" type="video/mp4">
                                  Your browser does not support HTML video.
                                </video> -->
                                <span class="video-number"><?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].' AND isactive = "1"', 'vedio_list', '','count(id) as count');
                                print_r($count[0]['count']);
                                ?></span>
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
                                                <!-- <span class="fa fa-eye"></span> <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_like', '', 'COUNT(video_id) as count'); echo $count[0]['count']; ?> -->
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
                                                    <?php } ?>  
                                                    <li><a href="http://www.facebook.com/sharer.php?u=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-facebook mr10"></span> Facebook</a></li>
                                                    <li><a href="https://www.instagram.com/share?text=videoForview&url=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>" ><span class="fa fa-instagram mr10"></span> Instagram</a></li>
                                                    <li><a href="http://twitter.com/share?text=video livestoc&url=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-twitter mr10"></span> Twitter</a></li>
                                                </ul>
                                            </li>
                                            <li class="pull-right mr10 commentlike" onclick="like(<?= $video['video_id'] ?>)">


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


                                    <div class="courses-alaltic">
                                    <?php  if($this->session->userdata("users_id") != ''){  ?>
                                        <span class="cr-ic-r mt-xs-20">
                                            <span class="course-icon"><i class="fa fa-plus"></i></span>
                                           <!--  (<?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_rating', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?>) -->
                                        </span>
                                   
                                        <a data-toggle="collapse" href="#collapseExample<?= $video['video_id']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Write a review
                                          </a>
                                        <div class="collapse forreview" id="collapseExample<?= $video['video_id']; ?>">
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
                                    <?php } ?>

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
                                <h2 class="headingcol"><?= ucfirst($video['seris_title']) ?></h2>
                                <h5 class="headingcol"><?= ucfirst($video['title']) ?></h5>
                                <span class="grey"> <?= ucfirst($video['user_name']) ?></span>
                                <p class="grey mb0"> <?= $video['qualifications'] ?></p>
                                <div class="video-ins grey">
                                    <div class="row">
                                        <div class="col-xs-12 mt10">
                                            <p class="institute mb0"><!-- <i class="fa fa-university"></i> Institute: --> <?= $video['institute'];?></p>
                                        </div>
                                       <!--  <div class="col-xs-12 mt10">
                                            <p class="qualification mb0"><i class="fa fa-graduation-cap"></i> Qualification: <?= $video['qualifications'] ?></p>
                                        </div> -->
                                    </div>
                                </div>
                                <hr>
                                <p><?= $video['description'] ?></p>
                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-calendar"></i></span> <?php  
                                            $orgDate = $video['created_on'];  
                                            $newDate = date("d-M-Y", strtotime($orgDate));  
                                            echo $newDate;  
                                        ?></span>
                                <p class="categories mt20">Category : <?php 
                                        $categoryValues = explode(',', $video['category']);
                                        foreach ($categoryValues as $key => $value) { 
                                            $cat = $this->api_model->get_category($value);
                                            ?>
                                           <span><?php echo $cat[0]['category']; ?></span> 
                                        <?php } ?></p>
                                <p class="language">Audio: <?php 
                                        $languageValues = explode(',', $video['language']);
                                        foreach ($languageValues as $key => $value) { ?>
                                           <span><?php echo $value; ?></span> 
                                        <?php } ?></p>
                                <?php
                                    if($this->session->userdata("user_type") == 0 || $video['user_id'] == $this->session->userdata("users_id")) {   
                                        if($this->session->userdata("users_id") != ''){ 
                                            $pdf = $this->admin_detail->get_vedio_pdf($video['video_id']); 
                                            if(!empty($pdf)){
                                            ?>
                                            <p class="language"><i class="fa fa-file-text" aria-hidden="true"></i> 
                                                <?php 
                                                foreach ($pdf as  $p) { 
                                                    $lang_name = $this->admin_detail->get_lang_name($p['lang_id']);
                                                    //print_r($lang_name);
                                                    ?>
                                                <span><a href="<?= base_url('uploads/videos/').$p['pdf_name'] ?>" target="__blank"><?php echo $lang_name[0]['name']; ?></a></span> 
                                                <?php } ?>
                                            </p>
                                            <?php }}else{
                                                 $pdf = $this->admin_detail->get_vedio_pdf($video['video_id']); 
                                                 if(!empty($pdf)){
                                                   ?>
                                                  <p class="language"><i class="fa fa-file-text" aria-hidden="true"></i> 
                                                       <?php 
                                                       foreach ($pdf as  $p) { 
                                                           $lang_name = $this->admin_detail->get_lang_name($p['lang_id']);
                                                           //print_r($lang_name);
                                                           ?>
                                                       <span><?php echo $lang_name[0]['name']; ?></span> 
                                                       <?php } ?>
                                                   </p>
                                               <?php }
                                            }
                                    }else if(!empty($status_data)) { 
                                        if($this->session->userdata("users_id") != ''){ 
                                        $pdf = $this->admin_detail->get_vedio_pdf($video['video_id']); 
                                        if(!empty($pdf)){
                                        ?>
                                       <p class="language"><i class="fa fa-file-text" aria-hidden="true"></i> 
                                            <?php 
                                            foreach ($pdf as  $p) { 
                                                $lang_name = $this->admin_detail->get_lang_name($p['lang_id']);
                                                //print_r($lang_name);
                                                ?>
                                            <span><a href="<?= base_url('uploads/videos/').$p['pdf_name'] ?>" target="__blank"><?php echo $lang_name[0]['name']; ?></a></span> 
                                            <?php } ?>
                                        </p>
                                    <?php }}else{
                                        $pdf = $this->admin_detail->get_vedio_pdf($video['video_id']); 
                                        if(!empty($pdf)){
                                          ?>
                                         <p class="language"><i class="fa fa-file-text" aria-hidden="true"></i> 
                                              <?php 
                                              foreach ($pdf as  $p) { 
                                                  $lang_name = $this->admin_detail->get_lang_name($p['lang_id']);
                                                  //print_r($lang_name);
                                                  ?>
                                              <span><?php echo $lang_name[0]['name']; ?></span> 
                                              <?php } ?>
                                          </p>
                                      <?php }
                                    }}else{
                                         $pdf = $this->admin_detail->get_vedio_pdf($video['video_id']); 
                                          if(!empty($pdf)){
                                            ?>
                                           <p class="language"><i class="fa fa-file-text" aria-hidden="true"></i> 
                                                <?php 
                                                foreach ($pdf as  $p) { 
                                                    $lang_name = $this->admin_detail->get_lang_name($p['lang_id']);
                                                    //print_r($lang_name);
                                                    ?>
                                                <span><?php echo $lang_name[0]['name']; ?></span> 
                                                <?php } ?>
                                            </p>
                                        <?php }
                                    } ?>
                            </div>
                            <?php if( $this->session->userdata("users_id") != ''){ ?>
                             <div class="product-buttons mt20">
                                    <?php 
                                        
                                        //print_r($status_data);
                                        if($video['user_id'] == $this->session->userdata("users_id")) { ?>  
                                            <h5>₹<?= $video['price']; ?></h5>
                                            <button onclick="window.location.href='<?= base_url()."all_videos/video_edit/".$video['video_id'] ; ?>'" type="button" class="button-default cart-btn"><i class="fas fa-video mr10"></i>EDIT</button>
                                      
                                    <?php } else if(empty($status_data)) { ?> 
                                        <a href="<?= base_url('all_videos/videocheckout/') ?><?= $video['video_id'] ?>"><h5 style="width: 40%;">₹<?= $video['price']; ?></h5></a>
                                         <!-- <button style="border: none;margin:0;padding:0px;width: 20%;"  onclick="window.location.href='<?= base_url()."all_videos/video_details?video_id=".$video['video_id']. "&group_number=".$video['users_video_group_number']; ?>'" type="button" class="fa fa-eye">
                                        </button> -->
                                        <button style="width: 20%;" onclick="cart(<?= $video['video_id']; ?>, <?= $video['price'] ?>, <?= $video['user_id'] ?>, '<?= $video['title'] ?>')" type="button" class="fa fa-shopping-cart"></button>
                                    <?php } else { ?>
                                        <button style="border: none" onclick="window.location.href='<?= base_url()."all_videos/video_play_list?video_id=".$video['video_id']. "&group_number=".$video['users_video_group_number']; ?>'" type="button" class="button-default cart-btn">
                                            <i class="fas fa-video mr10"></i>WATCH
                                        </button>
                                       <!--  <button style="border: none;"  onclick="window.location.href='<?= base_url()."all_videos/video_details?video_id=".$video['video_id']. "&group_number=".$video['users_video_group_number']; ?>'" type="button" class="button-default cart-btn">
                                            DETAILS
                                        </button> -->
                                   <?php } ?>
                                </div>
                                    <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
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
