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
                                            <div class="input-group-btn" style="width: 0%!important;%">
                                                <button type="button" class="btn btn-dropdown-custom dropdown-toggle" data-toggle="dropdown"><span class="fa fa-th"></span> Categories <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a onclick="searchVideoDropDownSections('Cow/Buffalo');" href="#">Cow/Buffalo</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchVideoDropDownSections('Dog/Cat');"  href="#">Dog/Cat</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchVideoDropDownSections('Sheep/Goat');" href="#">Sheep/Goat</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchVideoDropDownSections('Pig');" href="#">Pig</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchVideoDropDownSections('Horse');" href="#">Horse</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchVideoDropDownSections('Poultry');" href="#">Poultry</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchVideoDropDownSections('Fish');" href="#">Fish</a>
                                                    </li>
                                                </ul>
                                            </div><!-- /btn-group -->


                                            <!-- search language -->
                                            <div class="input-group-btn" style="width: 0%!important;">
                                                <button type="button" class="btn btn-dropdown-custom dropdown-toggle" data-toggle="dropdown"><span class="fa fa-th"></span> Language <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a onclick="searchLanguageDropDownSections('Hindi');" href="#">Hindi</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchLanguageDropDownSections('English');"  href="#">English</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchLanguageDropDownSections('Punjabi');" href="#">Punjabi</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchLanguageDropDownSections('Tamil');" href="#">Tamil</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="searchLanguageDropDownSections('Urdu');" href="#">Urdu</a>
                                                    </li>
                                                </ul>
                                            </div><!-- /btn-group -->

                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="input-group">
                                            <input id="searchText" type="text" class="form-control" placeholder="Search...">
                                            <span class="input-group-btn">
                                                <button onclick="searchVideoSections();" class="btn btn-search" type="button"><span class="fa fa-search"></span></button>
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
                    foreach($videolist as $key=>$video){
                        $status_data = $this->api_model->vedio_status($video['video_id'], $this->session->userdata("users_id"), $this->session->userdata('user_type'));
                        $vedio_list = $this->api_model->get_data('video_id = '.$video['video_id'].'', 'vedio_list');
                       // print_r($video);
                    ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="courses-inner res-mg-b-30">
                                <div class=" courses-title" style="margin-bottom: 86px;">
                                    <?php 
                                    if($video['user_id'] == $this->session->userdata("users_id")) { ?>  
                                        <div class="videocontainer">
                                            <video controls>
                                              <source src="<?= base_url() .'uploads/videos/'.$vedio_list[0]['video']; ?>" type="video/mp4">
                                              Your browser does not support HTML video.
                                            </video>
                                        </div>
                                    <?php } else if(empty($status_data)) { ?> 
                                        <div class="videocontainer">
                                            <img src="<?= base_url() .'uploads/videos/images/'.$vedio_list[0]['video_thumb']; ?>">
                                        </div>
                                    <?php } else { ?>
                                        <div class="videocontainer">
                                            <video controls>     
                                                <source src="<?= base_url() .'uploads/videos/'.$vedio_list[0]['video']; ?>" type="video/mp4">
                                                Your browser does not support HTML video.
                                            </video>
                                        </div>
                                   <?php } ?>
                                    <span class="video-number"><?php echo $video['count_values'] ?></span>
                                    <h2><?= $video['title'] ?></h2>
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
                                                    <!--  <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_like', '', 'COUNT(video_id) as count'); echo $count[0]['count']; ?> -->
                                                    
                                                </li>
                                                
                                                <li class="share">
                                                    <button type="button" class="btn btn-dropdown-share dropdown-toggle" data-toggle="dropdown">Share <span class="fa fa-share ml10"></span>
                                                    </button>
                                                    <ul class="dropdown-menu social-media-share">
                                                    <?php
                                                    $useragent=$_SERVER['HTTP_USER_AGENT'];
                                                    if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){ 
                                                    ?>
                                                        <li><a  target="__blank" href="https://api.whatsapp.com/send?text=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-whatsapp mr10"></span>whatsapps</a></li>
                                                    <?php }else{ ?>
                                                        <li><a target="__blank" href="https://web.whatsapp.com/send?text=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-whatsapp mr10"></span>whatsapps</a></li>
                                                    <?php } ?>   
                                                        <li><a target="__blank" href="http://www.facebook.com/sharer.php?u=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-facebook mr10"></span> Facebook</a></li>
                                                        <li><a target="__blank" href="https://www.instagram.com/share?text=videoForview&url=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>" ><span class="fa fa-instagram mr10"></span> Instagram</a></li>
                                                        <li><a target="__blank" href="http://twitter.com/share?text=video livestoc&url=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-twitter mr10"></span> Twitter</a></li>
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
                                                        <span class="fa fa-thumbs-up"></span> 
                                                        <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_like', '', 'COUNT(video_id) as count'); echo $count[0]['count']; ?></a>
                                                    </li>
                                                <li class="pull-right mr10 commentlike">
                                                    <a href="#"><span class="fa fa-comment"></span> 
                                                    <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_rating', '', 'COUNT(rating) as count'); echo $count[0]['count']; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- <h2 class="headingcol"><?= ucfirst($video['seris_title']) ?></h2> -->
                                    <!-- <h5 class="headingcol"><?= ucfirst($video['title']) ?></h5> -->
                                    <!-- <span class="grey"> <?= ucfirst($video['user_name']) ?></span> -->
                                    <!-- <div class="col-xs-12 mt10"> -->
                                        <!-- <p class="grey mb0">
                                                     <i class="fa fa-graduation-cap"></i> --> 
                                            <!--<?= $video['qualifications'] ?>
                                        </p> -->
                                   <!--  </div> -->
                                    <!-- <div class="video-ins grey">
                                        <div class="row">
                                            <div class="col-xs-12 mt10">
                                                <p class="institute mb0">
                                                     <i class="fa fa-university"></i> --> 
                                                   <!-- <?= $video['institute'] ?>
                                                </p>
                                            </div>
                                            
                                        </div>
                                    </div> -->
                                    <!-- <hr>
                                    <p><?= substr($video['description'], 0, 30) ?>..</p>
                                    <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-calendar"></i></span>
                                        <?= $video['created_on'] ?> 
                                        <?php  
                                            $orgDate = $video['created_on'];  
                                            $newDate = date("d-M-Y", strtotime($orgDate));  
                                            echo $newDate;  
                                        ?>
                                    </span>
                                    <p class="categories mt20">Category :
                                        <?php 
                                        $categoryValues = explode(',', $video['category']);
                                        foreach ($categoryValues as $key => $value) { 
                                            $cat = $this->api_model->get_category($value);
                                            if($key > 0) { break; }?>
                                           <span><?php echo $cat[0]['category']; ?>..</span> 
                                        <?php } ?>
                                    </p>
                                    <p class="language">Audio:
                                        <?php 
                                        $languageValues = explode(',', $video['language']);
                                        foreach ($languageValues as $key => $value) { if($key > 0) { break; }?>
                                           <span><?php echo $value; ?>..</span> 
                                        <?php } ?>
                                    </p>
                                    <?php
                                    if($this->session->userdata("user_type") == 0 || $video['user_id'] == $this->session->userdata("users_id")) {   
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
                                    <?php }}else if(!empty($status_data)) {
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
                                    } ?> -->
                                </div>
                                <div class="product-buttons mt20">
                                    <?php 
                                        
                                        //print_r($status_data);
                                        if($video['user_id'] == $this->session->userdata("users_id")) { ?>  
                                            <h5>₹<?= $video['price']; ?></h5>
                                            <button onclick="window.location.href='<?= base_url()."all_videos/video_edit/".$video['video_id'] ; ?>'" type="button" class="button-default cart-btn"><i class="fas fa-video mr10"></i>EDIT</button>
                                      
                                    <?php } else if(empty($status_data)) { ?> 
                                        <a href="<?= base_url('all_videos/videocheckout/') ?><?= $video['video_id'] ?>"><h5 style="width: 40%;">₹<?= $video['price']; ?></h5></a>
                                         <button style="border: none;margin:0;padding:0px;width: 20%;"  onclick="window.location.href='<?= base_url()."all_videos/video_details?video_id=".$video['video_id']; ?>'" type="button" class="fa fa-eye">
                                        </button>
                                        <button style="width: 20%;" onclick="cart(<?= $video['video_id']; ?>, <?= $video['price'] ?>, <?= $video['user_id'] ?>, '<?= $video['title'] ?>')" type="button" class="fa fa-shopping-cart"></button>
                                    <?php } else { ?>
                                        <button style="border: none;float: right;" onclick="window.location.href='<?= base_url()."all_videos/video_play_list?video_id=".$video['video_id']. "&group_number=".$video['users_video_group_number']; ?>'" type="button" class="button-default cart-btn">
                                            <i class="fas fa-video mr10"></i>WATCH
                                        </button>
                                        <button style="border: none;"  onclick="window.location.href='<?= base_url()."all_videos/video_details?video_id=".$video['video_id']; ?>'" type="button" class="button-default cart-btn">
                                            DETAILS
                                        </button>
                                   <?php } ?>
                                </div>



                    </div>
                </div>
            <?php  } ?>
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
<?php include('footer.php'); ?>
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

    function searchVideoSections() {
        var searchText = $('#searchText').val();
        console.log(searchText);
        console.log(dropDownSections);
        window.location.href ='<?= base_url('all_videos') ?>?searchtext='+searchText+ '&dropdownsections='+dropDownSections; 
    }
    function searchLanguageDropDownSections($value) {
        searchLanguageDropDownSections = $value;
        var searchText = $('#searchText').val();
        console.log(searchText);
        console.log(searchLanguageDropDownSections);
        window.location.href ='<?= base_url('all_videos') ?>?searchtext='+searchText+ '&dropdownsectionsforlanguage='+searchLanguageDropDownSections; 
    }
  </script>
