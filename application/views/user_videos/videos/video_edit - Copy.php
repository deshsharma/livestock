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
                    <div class="product-payment-inner-st">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                    <div id="dropzone1" class="pro-ad addcoursepro">
                                        <form action="<?= base_url() ?>all_videos/video_edit/<?php echo $video[0]['video_id'] ?>" class="dropzone dropzone-custom needsclick addcourse" id="demo1-upload" enctype="multipart/form-data" method="post">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                                    <p>
                                                        <a href="<?php echo base_url(). 'all_videos'; ?>"><button type="button" class="btn btn-info btn-flat">Check Play Video</button></a>
                                                    </p>

                                                    <!--File upload start-->
                                                    <div class="form-group">
                                                        <label class="control-label">Upload Video Image</label>
                                                        <div class="preview-zone hidden">
                                                          <div class="box box-solid">
                                                            <div class="box-header with-border">
                                                              <div><b>Preview</b></div>
                                                              <div class="box-tools pull-right">
                                                                <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                                  <i class="fa fa-times"></i>Reset The Image
                                                                </button>
                                                              </div>
                                                            </div>
                                                            <div class="box-body"></div>
                                                          </div>
                                                        </div>
                                                        <div class="dropzone-wrapper">
                                                          <div class="dropzone-desc">
                                                            <i class="glyphicon glyphicon-download-alt"></i>
                                                            <p>Choose an video image</p>
                                                          </div>
                                                          <input type="file" id="video_image" name="video_image"  class="dropzone-new">
                                                        </div>
                                                    </div>
                                                    <!--File upload end-->


                                                    <div class="form-group">
                                                        <input value="<?php echo $video[0]['title'] ?>" type="text" id="title" name="title"  class="form-control" placeholder="Title" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <input value="<?php echo date_format(date_create($video[0]['start_date']), "Y-m-d"); ?>" id="start_date" name="start_date" type="date" class="form-control" placeholder="Video Upload Date" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <input value="<?php echo $video[0]['submittedby'] ?>" name="submittedby" id="submittedby" type="text" class="form-control" placeholder="Submitted By" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <input value="<?php echo $video[0]['qualifications']; ?>" name="qualifications" id="qualifications" class="form-control" placeholder="Qualification" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <input value="<?php echo $video[0]['institute']; ?>" type="text" name="institute" id="institute" class="form-control" placeholder="Institute Name" required>
                                                    </div>

                                                    <!--Subject for video -->
                                                    <div class="form-group">
                                                        <input value="<?php echo $video[0]['subject']; ?>" type="text" id="subject" name="subject"  class="form-control" placeholder="Subject" required>
                                                    </div>
                                                    <!--End Subject for view -->

                                                    <!--price for video -->
                                                    <div class="form-group">
                                                        <input value="<?php echo $video[0]['price']; ?>" type="text" pattern=".{0,9}" id="price" name="price"  class="form-control" placeholder="Price" required>
                                                    </div>
                                                    <!--End price for view -->

                                                    <!--description -->
                                                    <div class="form-group">
                                                        <textarea value="<?php echo $video[0]['description']; ?>" class="form-control" name="description" rows="3" placeholder="Description ..." required><?php echo $video[0]['description']; ?></textarea>
                                                    </div>
                                                    <!--End decription -->
                                                    
                                                    <div class="split_values_two_row">
                                                        <!-- language selection-->
                                                        <div class="form-group">
                                                            <span class="expert"><strong>Select Language :</strong></span><br/>
                                                            <input <?php if(in_array('English', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="English">
                                                            <span class="checkmark"></span>English
                                                        </div>
                                                        <div class="form-group first_right-row">
                                                            <input <?php if(in_array('Hindi', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Hindi">
                                                            <span class="checkmark"></span>Hindi
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Punjabi', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Punjabi">
                                                            <span class="checkmark"></span>Punjabi
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Haryanvi', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Haryanvi">
                                                            <span class="checkmark"></span>Haryanvi
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Bengali', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Bengali">
                                                            <span class="checkmark"></span>Bengali
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Telugu', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Telugu">
                                                            <span class="checkmark"></span>Telugu
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Marathi', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Marathi">
                                                            <span class="checkmark"></span>Marathi
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Tamil', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Tamil">
                                                            <span class="checkmark"></span>Tamil
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Urdu', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Urdu">
                                                            <span class="checkmark"></span>Urdu
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Gujarati', $video[0]['language'])) { echo "checked='checked'"; } ?>  type="checkbox" name="checkbox1[]" value="Gujarati">
                                                            <span class="checkmark"></span>Gujarati
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Kannada', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Kannada">
                                                            <span class="checkmark"></span>Kannada
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Malaylam', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Malaylam">
                                                            <span class="checkmark"></span>Malaylam
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Odia', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Odia">
                                                            <span class="checkmark"></span>Odia
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Assamese', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Assamese">
                                                            <span class="checkmark"></span>Assamese
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Maithili', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Maithili">
                                                            <span class="checkmark"></span>Maithili
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Bhili/Bhilodi', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Bhili/Bhilodi">
                                                            <span class="checkmark"></span>Bhili/Bhilodi
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Santali', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Santali">
                                                            <span class="checkmark"></span>Santali
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Kashmiri', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Kashmiri">
                                                            <span class="checkmark"></span>Kashmiri
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Nepali', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Nepali">
                                                            <span class="checkmark"></span>Nepali
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Gondi', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Gondi">
                                                            <span class="checkmark"></span>Gondi
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Sindi', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Sindi">
                                                            <span class="checkmark"></span>Sindi
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Konkani', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Konkani">
                                                            <span class="checkmark"></span>Konkani
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Dogri', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Dogri">
                                                            <span class="checkmark"></span>Dogri
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Khandeshi', $video[0]['language'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="Khandeshi">
                                                            <span class="checkmark"></span>Khandeshi
                                                        </div>
                                                        <!-- end language selection-->

                                                        <!-- Category selection-->
                                                        <div class="form-group">
                                                            <span class="expert"><strong>Category in :</strong></span><br/>
                                                            <input <?php if(in_array('Cow/Buffalo', $video[0]['category'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkboxExpertise[]" value="Cow/Buffalo">
                                                            <span class="checkmark"></span>Cow/Buffal
                                                        </div>
                                                        <div class="form-group first_right-row">
                                                            <input <?php if(in_array('Dog/Cat', $video[0]['category'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkboxExpertise[]" value="Dog/Cat">
                                                            <span class="checkmark"></span>Dog/Cat
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Sheep/Goat', $video[0]['category'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkboxExpertise[]" value="Sheep/Goat">
                                                            <span class="checkmark"></span>Sheep/Goat
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Pig', $video[0]['category'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkboxExpertise[]" value="Pig">
                                                            <span class="checkmark"></span>Pig
                                                        </div>
                                                        <div class="form-group">
                                                              <input <?php if(in_array('Horse', $video[0]['category'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkboxExpertise[]" value="Horse">
                                                              <span class="checkmark"></span>Horse
                                                        </div>
                                                        <div class="form-group">
                                                              <input <?php if(in_array('Poultry', $video[0]['category'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkboxExpertise[]" value="Poultry">
                                                              <span class="checkmark"></span>Poultry
                                                        </div>
                                                        <div class="form-group">
                                                            <input <?php if(in_array('Fish', $video[0]['category'])) { echo "checked='checked'"; } ?> type="checkbox" name="checkboxExpertise[]" value="Fish">
                                                            <span class="checkmark"></span>Fish
                                                        </div>
                                                        <!-- Category selection-->
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                                                    <div class="form-group alert-up-pd">
                                                            <?php if( $error = $this->session->flashdata('edit_video')){ ?>
                                                                    <diV class="col-md-3"></div>
                                                                    <div class="col-md-9 corm_nmset">
                                                                        <div class=" error" style="margin-left:0%;">
                                                                            <?= $error ?>
                                                                        </div>
                                                                    </div>
                                                            <?php } ?>
                                                            <?php //print_r($_SESSION) ?>
                                                            <?php echo form_error('name'); ?>
                                                            <?php
                                                                if (isset($success) && strlen($success)) {
                                                                    echo '<div class="success">';
                                                                    echo '<p>' . $success . '</p>';
                                                                    echo '</div>';
                                                                    //traditional video play - less than HTML5
                                                                    echo '<object width="338" height="300">
                                                                      <param name="src" value="' . $video_path . '/' . $video_name . '">
                                                                      <param name="autoplay" value="false">
                                                                      <param name="controller" value="true">
                                                                      <param name="bgcolor" value="#333333">
                                                                      <embed type="' . $video_type . '" src="' . $video_path . '/' . $video_name . '" autostart="false" loop="false" width="338" height="300" controller="true" bgcolor="#333333"></embed>
                                                                      </object>';
                                                                }
                                                                if (isset($errors) && strlen($errors)) {
                                                                    echo '<div class="error">';
                                                                    echo '<p>' . $errors . '</p>';
                                                                    echo '</div>';
                                                                }
                                                                if (validation_errors()) {
                                                                    echo validation_errors('<div class="error">', '</div>');
                                                                }
                                                            ?>
                                                            <?php
                                                                $attributes = array('name' => 'video_upload', 'id' => 'video_upload');
                                                                echo form_open_multipart($this->uri->uri_string(), $attributes);
                                                            ?>
                                                            <input style="margin: auto;" name="video_name" id="video_name" readonly="readonly" type="file" />

                                                            <div class="upload-area"  id="uploadfile">
                                                                <div class="dz-message needsclick download-custom">
                                                                    <i class="fa fa-download edudropnone" aria-hidden="true"></i>
                                                                    <h2 class="edudropnone">Drop video here or click to upload.</h2>
                                                                    <p class="edudropnone"><span class="note needsclick">Video review will shown here. <strong>Max size 100MB allowed.</strong> </span>
                                                                    </p>
                                                                    <input name="imageico" class="hd-pro-img" type="text" />
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 text-left mt40">
                                                    <div class="payment-adress">
                                                        <input name="video_upload" value="Add Video" type="submit" class="btn btn-primary waves-effect waves-light"/>
                                                        <input type="hidden" id="video_id" name="video_id" value="<?php echo $video[0]['video_id'] ?>">
                                                    </div>
                                                </div>
                                            </div>
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
<?php include('footer.php'); ?>
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
   $(function() {
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
    var htmlPreview1 =
        '<img width="200" src="<?php echo base_url().'uploads/videos/images/'.$video[0]['video_thumb'] ?>" />' +
        '<p><?php echo $video[0]['video_thumb'] ?></p>';
    var wrapperZone1 = $('.dropzone-new').parent();
    var previewZone1 = $('.dropzone-new').parent().parent().find('.preview-zone');
    var boxZone1 = $('.dropzone-new').parent().parent().find('.preview-zone').find('.box').find('.box-body');
    wrapperZone1.removeClass('dragover-new');
    previewZone1.removeClass('hidden');
    boxZone1.empty();
    boxZone1.append(htmlPreview1);

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
