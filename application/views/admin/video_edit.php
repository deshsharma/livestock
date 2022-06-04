<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php');
$role = $this->admin_detail->get_rol_id($id);
?>
<style type="text/css">
         .error {
            margin: 27%;
            width: auto;
            color:red;
            display: inline;
            font-weight: 100;
            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }
            #body {
                margin: 0 15px 0 15px;
            }
            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
            .error {
                color: #E13300;
            }
            .success {
                color: darkgreen;
            }
        }  
</style>
<div class="content-wrapper" >

<div class="abc" ><h3>Add Your Video</h3></div>

<div class="abc_1" >
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
            <div class="col-md-3" > 
               <strong class="right_sre">Video Upload</strong>
            </div>
            <div class="col-md-9">
                <div id="container">
                <div id="body">
                    <p>Select a video file to upload </p>
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
                    <p><input name="video_name" id="video_name" readonly="readonly" type="file" /></p>

                    <p>
                        <a href="<?php echo base_url(). 'admin/video_play?video='.$video[0]['video']; ?>"><button type="button" class="btn btn-info btn-flat">Check Play</button></a>
                    </p>

                    <p>Video Image</p>

                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <img id="preview" style="width:100px" src="<?php echo base_url().'uploads/videos/images/'.$video[0]['video_thumb']; ?>" alt="your image" title=''/>
                    </div>

                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <input type="file" id="video_image" name="video_image" class=""  />
                    </div>

                    <p>Title</p>
                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <input value="<?php echo $video[0]['title'] ?>" type="text" id="video_title" name="video_title" class="" required />
                    </div>

                    <p>Video Upload Date</p>
                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <input value="<?php echo date_format(date_create($video[0]['start_date']), "Y-m-d"); ?>" id="start_date" name="start_date" type="date" class="form-control" placeholder="Video Upload Date" required>
                    </div>

                    <p>Submitted By</p>
                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <input value="<?php echo $video[0]['submittedby']; ?>" name="submittedby" id="submittedby" type="text" class="form-control" placeholder="Submitted By" required>
                    </div>

                    <p>Price</p>
                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <input value="<?php echo $video[0]['price']; ?>" type="text" pattern=".{0,9}" id="video_price" name="video_price" class="" required />
                    </div>

                    <p>Qualifications</p>
                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <input value="<?php echo $video[0]['qualifications']; ?>" type="text" name="qualifications" class="additional" id="qualifications" placeholder="Qualifications" required>
                        <!-- <select name="qualifications" id="qualifications" required>
                            <option value="">Qualifications</option>
                            <option value="BVSC" <?php if($video[0]['qualifications'] == 'BVSC'){ echo "selected";} ?>>BVSC</option>
                            <option value="MVSC" <?php if($video[0]['qualifications'] == 'MVSC'){ echo "selected";} ?>>MVSC</option>
                            <option value="PHD"  <?php if($video[0]['qualifications'] == 'PHD'){ echo "selected";} ?>>PHD</option>
                        </select>
                        <span class="select-btn">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span> -->
                    </div>

                    <p>Institute Name</p>
                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <input value="<?php echo $video[0]['institute']; ?>" type="text" name="institute" class="additional" id="institute" placeholder="Institute" required>
                    </div>

                    <p>Subject</p>
                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <input value="<?php echo $video[0]['subject']; ?>" type="text" name="subject" class="additional" id="subject" placeholder="Subject" required>
                    </div>

                    <p>Description</p>
                    <div class="form-row form-row-2" style="margin-bottom: 20px;">
                        <textarea value="<?php echo $video[0]['description']; ?>" class="form-control" name="description" rows="3" placeholder="Description ..." required><?php echo $video[0]['description']; ?></textarea>
                    </div>

                    <div class="form-row form-row-2">
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

                    <p><input name="video_upload" value="Upload Video" type="submit" /></p>
                    <input type="hidden" id="video_id" name="video_id" value="<?php echo $video[0]['video_id'] ?>">
                    <?php
                        echo form_close();
                    ?>
                </div>
        </div>
    </div>
<!--     <div style="margin-left: 27%; margin-top:10px" >
        <?php 
            echo form_submit(['name'=>'submit','value'=>'Add', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
        ?>
    </div> -->
    <div style="clear: left;"></div>
</div>
</div>
<script type="text/javascript">
 function myFunction() {
    var newpassword = document.getElementById("newpassword").value;
    var confrmpwd = document.getElementById("confrmpwd").value;
    var ok = true;
    if (newpassword != confrmpwd) {
        document.getElementById("newpassword").style.borderColor = "#E34234";
        document.getElementById("confrmpwd").style.borderColor = "#E34234";
        ok = false;
    }
    else 
    {
           ok = true;
    }
    return ok;
}
 </script>
 <?php include_once('layouts/admin_footer.php'); ?>

