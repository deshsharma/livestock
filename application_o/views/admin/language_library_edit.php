<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php');
?>
<style type="text/css">
         .error {
            margin: 27%;
            width: auto;
            color:red;
            display: inline;
            font-weight: 100;
        }  
</style>
<div class="content-wrapper" >

<div class="abc" ><h3>Edit Language Library</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_rol')){ ?>
            <diV class="col-md-3"></div>
            <div class="col-md-9 corm_nmset">
                <div class=" error" style="margin-left:0%;">
                    <?= $error ?>
                </div>
            </div>
    <?php } ?>
        <?php echo form_open("admin/language_library_edit/".$id, ['onsubmit'=>'return myFunction()']);?>
            
            <?php echo form_error('language_id'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Language id</strong>
            </div>

            <div class="col-md-9">
                <select name="language_id" id="language_id" class='ch_manset padd_set' required>
                    <option value="">Select Language</option>
                    <?php foreach($allLangues as $br) { ?>
                        <option value="<?= $br['id'] ?>" <?php if($details[0]['language_id'] == $br['id']){ echo "selected";} ?>><?= $br['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <?php echo form_error('key'); ?>
            <div class="col-md-3" > 
               <strong class="right_sre">Key</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'key', 'value'=>$details[0]['key'], 'id'=>'key','class'=>'ch_manset padd_set']); ?>
                <input type="hidden" name="id" value="<?php echo $details[0]['key']; ?>" >
            </div>

           <!--  <div class="col-md-3" > 
               <strong class="right_sre">Code</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'code', 'value'=>$details[0]['code'], 'id'=>'code','class'=>'ch_manset padd_set']); ?>
                <input type="hidden" name="id" value="<?php echo $details[0]['code']; ?>" >
            </div> -->

            <?php echo form_error('description'); ?>
            <div class="col-md-3" > 
               <strong class="right_sre">Description</strong>
            </div>
            <div class="col-md-9">
                <textarea value=" <?php echo $details[0]['description'] ?>" class="form-control ch_manset padd_set" name="description" id="description" rows="3" placeholder="Description ..."><?php echo $details[0]['description'] ?></textarea>
            </div>
            
            <div style="margin-left: 27%; margin-top:10px;" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Update', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
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
