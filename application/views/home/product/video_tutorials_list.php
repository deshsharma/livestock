<section class="news mt-5">
  <div class="container-fluid">
  <div class="row">
      <div class="col-12 mb-2 mt-3">    
          <h3 class="float-left"><span><?= $this->webLanguage['ONLINE VETERINARY COURSES AND VIDEO TUTORIALS']?></span></h3>
      </div>
  </div>    
  <div class="row mt-3 justify-content-between">
    <?php foreach ($data['video_tutorials'] as $key => $video) { 
                        ?>
      <div class="col-md-9 vidouter ">
          <div class="newsbg">
          <img class="img-center" src="<?= $video['video_thumb'] ?>" width="990">
          </div>
          <div class="row mt-4 vidfields">
            <div class="col-md-6 col-12">
              <h4> <?= ucfirst($video['submittedby']) ?></h4>
              <p><?= $video['qualifications'] ?></p>  
            
            </div>
            <div class="col-md-6 col-12 vidrightfields text-end">
             
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  Share
                </a>
						<ul class="dropdown-menu social-media-share" aria-labelledby="dropdownMenuLink">
						<?php
						$useragent=$_SERVER['HTTP_USER_AGENT'];
						if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){ 
						?>

						<li><a  class="dropdown-item" target="__blank" href="https://api.whatsapp.com/send?text=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>"><span class="fa fa-whatsapp mr10"></span>whatsapps</a></li>
						<?php }else{ ?>
						<li><a class="dropdown-item" target="__blank" href="https://web.whatsapp.com/send?text=https://www.livestoc.com/all_videos/video_details?video_id=<?= $video['video_id'] ?>">whatsapps</a></li>
						<?php } ?><br>
						<li><a class="dropdown-item" href="http://www.facebook.com/sharer.php?u=https://www.livestoc.com/all_videos&p[title]=video livestoc"> Facebook</a></li><br>
						<li><a class="dropdown-item"  href="https://www.instagram.com/share?text=videoForview&url=https://www.livestoc.com/all_videos"> Instagram</a></li><br>
						<li><a class="dropdown-item" href="http://twitter.com/share?text=video livestoc&url=https://www.livestoc.com/all_videos"> Twitter</a></li>
						</ul>

              </div>
              <p><i class="far fa-eye"></i> Views : <span></span></p>
						<?php 
						$countUserIntrested = $this->api_model->get_data('video_id = "'.$video['video_id'].'"' , 'video_interest', '', 'count(id) as count'); 
						if(!empty($countUserIntrested)) { ?>
							<?= $countUserIntrested[0]['count'] ?>
						<?php } else { ?>
						   <?= $countUserIntrested[0]['count'] ?>
						<?php }?>
						<ul>
						<!--<li class="views"><span class="fa fa-eye"></span>-->
            
						<?php //echo $countUserIntrested[0]['count']; ?>

						<!--<li class="float-right mr10 commentlike">
						<!--<span class="fa fa-thumbs-up"></span>  <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_like', '', 'COUNT(video_id) as count'); //echo $count[0]['count']; ?></a>
						</li>-->
						<!--<li class="float-right mr10 commentlike">
						<!--<a href="#"><span class="fa fa-comment"></span> <?php $count = $this->api_model->get_data('video_id = '.$video['video_id'].'' , 'video_rating', '', 'COUNT(rating) as count'); //echo $count[0]['count']; ?> </a> 
						</li>-->
						</ul>
             
            </div>
          </div>
          <h3 class="mt-4"><?= ucfirst($video['title']) ?></h3>
          <p class="mt-2"><?= $video['description']; ?></p>
      </div> 
      <div class="col-md-3">
        <div class="vidrightbg">
          <div class="row">
                <div class="col-md-12 mt-5 mt-md-3">
                <div class="newsbg">
                <img class="img-center" src="<?= $video['video_thumb'] ?>">
                    <p><span>Posted By <?= ucfirst($video['submittedby']) ?></span></p>
                    <span class="date"></span>
                </div>
                <h3 class="mt-4"><?= ucfirst($video['title']) ?></h3>
                <div class="row vidfields">
                  <div class="col-md-12">
                    <h4> <?= ucfirst($video['submittedby']) ?></h4>
                    <p><?= $video['qualifications'] ?></p>  
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
					<button onclick="goToVideoTutorials()" type="button" class="btn btn-info w-100 viewall"><?= $this->webLanguage['View Video Tutorials']?></button>
					<button onclick="goPostVideoTutorials()" type="button" class="btn btn-success mt-3 w-100 postvideo" ><?= $this->webLanguage['Post Videos Now']?></button>
             
            </div>
          </div>
          </div>
      </div> 
	<?php } ?>	  
  </div>
  </div>
</section>