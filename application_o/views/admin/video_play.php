<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php'); 
?>
<div class="content-wrapper">
	<div class="content">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	          	<div class="box-header with-border">
				          <?php //print_r($_SESSION); ?>
		              <h3 class="box-title">VIDEOS TUTORIALS</h3>
		              <a class="white" href="videos"><div class="btn btn-info but_set">
		                 Video List
		              </div></a>
	            </div>
		         <div class="box-body">
		         	  <div style="text-align:center"> 
                  <button class="btn btn-info but_set" onclick="playPause()">Play/Pause</button> 
                  <button class="btn btn-info but_set" onclick="makeBig()">Big</button>
                  <button class="btn btn-info but_set" onclick="makeSmall()">Small</button>
                  <button class="btn btn-info but_set" onclick="makeNormal()">Normal</button>
                  <br><br>
                  <video id="video1" width="420" controls>
                  <source src="<?= base_url().'uploads/videos/'.$video_name?>" type="video/mp4">
                  <source src="mov_bbb.ogg" type="video/ogg">
                      Your browser does not support HTML video.
                  </video>
                </div> 
		         </div>
		      </div><!--end of box-->
		    </div><!--end of col-->
		</div><!--End of row-->
	</div><!--End of Content-->
<script type="text/javascript">
  var myVideo = document.getElementById("video1"); 
  function playPause() { 
    if (myVideo.paused) 
    myVideo.play(); 
    else 
    myVideo.pause(); 
  } 

  function makeBig() { 
    myVideo.width = 560; 
  } 

  function makeSmall() { 
    myVideo.width = 320; 
  } 

  function makeNormal() { 
    myVideo.width = 420; 
  } 
</script> 
<?php include_once('layouts/admin_footer.php'); ?>