 <style type="text/css">
   .hide1{
        display:none;
      }
 </style>
 <div class="container">
      <div class="formTotal">
        <div class="row">
          <div class="col-md-4 col-12 stepsecbg">
              <div class="stepsec">
              <p class=""><span class="step-counter">01</span><span class="nomob"> Basic Information</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">02</span><span class="nomob"> Educational Qualification</span></p>
            </div>
            <div class="stepsec">
              <p class="blue1"><span class="step-counter-activ">03</span><span class="nomob"> Experience</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">04</span><span class="nomob"> Registration Details</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">05</span><span class="nomob"> Bank Details</span></p>
            </div>
            <div class="stepsec">
              <p><span class="step-counter">06</span><span class="nomob"> Select Language</span></p>
            </div>
          </div>
      <div class="col-md-8">
        <div class="form-Title text-center">
          <h3 class="mt-3">Experience</h3>
          <!-- <p>Please enter your Expertise details and proceed to next form</p> -->
        </div>
        <div class="form-Content">
          <div class="page-content">
    <div class="form-v10-content">
      <form class="form-detail" method="POST" id="myform">
        <?php if( $error = $this->session->flashdata('add_bank')){ ?>
            <diV class="col-md-3"></div>
            <div class="col-md-9 corm_nmset">
                <div class=" error" style="margin-left: 22%;color:#ec0606;">
                    <?= $error ?>
                </div>
            </div>
        <?php } ?>
          <div class="form-left">
              <div class="form-row">
                <?php echo form_error('total_experince'); ?>
                <p style="margin-top: 10px;margin-left:-17px;" class="form-row">Total experience in years</p>
                <!-- <input value="<?php echo $total_experince ?>"  type="text" maxlength="2" name="total_experince" id="total_experince" class="total_experince input-text" placeholder="Total experience in years" required> -->
                <input type="text" value="<?php echo $total_experince ?>" name="total_experince" maxlength="2" class="col-2" placeholder="" id="total_experince" style="border-color: black;border-width: 1px;height: 34px;max-width: 9.666667%;">
              </div>


              <div class="form-row">
                
              <span class="container">I Specialize In</span>
              <div class="forcheck">
                <?php echo form_error('checkbox1'); ?>
                <?php
                  $data = $this->api_model->product_section();
                  foreach($data as $sec){
                    //print_r($sec);
                ?>
                <div class="form-checkbox">
                <label class="container"><p><?= $sec['name'] ?></p>
                    <input <?php if(in_array('Cow/Buffalo', $experince_list)) { echo "checked='checked'"; } ?> type="checkbox" name="checkbox1[]" value="<?= $sec['name'] ?>">
                <span class="checkmark"></span>
                </label>
                </div>
                  <?php } ?>
            </div>  
            </div>
             <!--  <div class="form-row">
                <?php echo form_error('name_organization'); ?>
                <input value="<?php echo $name_organization ?>" type="text" name="name_organization" id="name_organization" class="input-text" placeholder="Name of Organization" required>
              </div>
              <div class="form-row">
                <?php echo form_error('designation'); ?>
                <input value="<?php echo $designation ?>" type="text" name="designation" id="designation" class="input-text" placeholder="Designation" required>
              </div>
              <div class="form-row">
                <?php echo form_error('fromdate'); ?>
                <input value="<?php echo $fromdate ?>" type="text" onfocus="(this.type='date')"  name="fromdate" id="fromdate" placeholder="From Date" class="input-text" required>
              </div>
              <div class="form-row">
                <?php echo form_error('fromtodate'); ?>
                <input value="<?php echo $fromtodate ?>" type="text" onfocus="(this.type='date')" name="fromtodate" id="fromtodate" placeholder="TO Date" preg_replace class="input-text" required>
              </div>
              <div class="form-row">
                <?php echo form_error('descriptions'); ?>
                <input value="<?php echo $descriptions ?>" type="text"  name="descriptions" id="descriptions" class="input-text" placeholder="Please write a few lines about your achievements and experince..." required>
              </div> -->
              <p style="margin-top: 5px;margin-left: 12px;" class="form-row">Experience</p>
              <div class="packValues<?= $i ?><?= $pack['unit_id']?> pack1 <?= $pack['unit_id']?> 
                        <?php if($unit[0]['id'] != $pack['unit_id'] || $i != 0){ echo "hide"; } ?>">
              
                  <!-- <label style="margin-left: 10px;">Composition/Salt</label> -->
                  
                      <?php for($i=0;$i<10;$i++){ ?>
                         
                            <div class=" <?php if($i != '0'){ echo "hide1"; } ?>">
                                  <div class="form-row">
                                    <?php echo form_error('name_organization'); ?>
                                    <input value="<?php echo $name_organization ?>" type="text" name="name_organization[]" id="name_organization[]" class="input-text name_organization" placeholder="Name of Organization" <?php if($i == '0'){ echo "required"; } ?>>
                                  </div>
                                  <div class="form-row">
                                    <?php echo form_error('designation'); ?>
                                    <input value="<?php echo $designation ?>" type="text" name="designation[]" id="designation[]" class="input-text designation" placeholder="Designation" <?php if($i == '0'){ echo "required"; } ?>>
                                  </div>
                                  <div class="form-row">
                                    <div class="col-2" style="margin-top: 17px;padding-left: 15px;"><label>From Date</label></div>
                                    <div class="col-4">
                                      <?php echo form_error('fromdate'); ?>
                                      <input value="<?php echo $fromdate ?>" type="date"  onfocus="(this.type='date')" name="fromdate[]" id="fromdate[]" placeholder="From Date" class="fromdate input-text" <?php if($i == '0'){ echo "required"; } ?>>
                                    </div>
                                    <div class="col-2" style="margin-top: 17px;"><label>To Date</label></div>
                                    <div class=" col-4">
                                      <?php echo form_error('fromtodate'); ?>
                                      <input value="<?php echo $fromtodate ?>" type="date" onfocus="(this.type='date')" name="fromtodate[]" id="fromtodate[]" placeholder="To Date" preg_replace class="fromtodate input-text" <?php if($i == '0'){ echo "required"; } ?>>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <?php echo form_error('descriptions'); ?>
                                    <input value="<?php echo $descriptions ?>" type="text"  name="descriptions[]" id="descriptions[]" class="descriptions input-text" placeholder="Please write a few lines about your achievements and experince..." <?php if($i == '0'){ echo "required"; } ?>>
                                  </div>
                                  <div class="form-row">
                                      <!-- <p style="font-size: 23px;color:#007bff;margin-left: 17px;margin-top: 10px;" >Previous Employment if Any</p> -->
                                      <span class="btn btn-sm btn-primary add_more_composition" style="margin-left: 540px;margin-top: 79px;">Add More</span>
                                      <button class="btn btn-sm btn-primary remove_more hide1" style="margin-left: 10px;" >Remove</button>
                                  </div>
                            </div>
                      <?php } ?>
                      
                      <!-- <button class="btn btn-sm btn-primary add_more_composition" style="margin-left: 10px;">Add More Fields</button> -->
                  
                
                </div>              
              <div class="form-checkbox" style="width: 100%">
                <label class="container"><div class="msg blue1">Skip it, I will update it later</div>
                    <input  <?php if($telephonicConsult == '1') { echo "checked='checked'"; } ?> type="checkbox" name="telephonicConsult" id="telephonicConsult" >
                    <span class="checkmark" style="margin-left:12px;"></span>
                </label>
              </div>
              <div class="row reg">
                <div class="col-12">
                  <button type="submit" name="submit" class="btn btn-primary btn-style2">Next</button>
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

  <div class="form-details">
    
  </div>
  
<?php include('footer.php'); ?> 
<script type="text/javascript">
  $('#telephonicConsult').click(function(){
   
    if($('#telephonicConsult').is(":checked")){
      //$('.total_experince').attr('required');
      $('.name_organization').removeAttr('required');
       $('.designation').removeAttr('required');
       $('.fromdate').removeAttr('required');
       $('.fromtodate').removeAttr('required');
      $('.descriptions').removeAttr('required');
    }else{
     
     // $('#institute').removeAttr('required');
      // $('#EDU').removeAttr('required');
      //$('.total_experince').removeAttr('required');
       $('.name_organization').attr('required');
       $('.designation').attr('required');
       $('.fromdate').attr('required');
       $('.fromtodate').attr('required');
       $('.descriptions').attr('required');
    }
  });
    $("#documents").change(function(event) {  
    RecurFadeIn();
    readURL(this);    
  });
  $("#documents").on('click',function(event){
    RecurFadeIn();
  });
  function readURL(input) {    
    if (input.files && input.files[0]) {   
      var reader = new FileReader();
      var filename = $("#documents").val();
      filename = filename.substring(filename.lastIndexOf('\\')+1);
      reader.onload = function(e) {    
        $('#preview').attr('src', e.target.result);
        $('#preview').hide();
        $('#preview').fadeIn(500);      
        $('.custom-file-label').text(filename);             
      }
      reader.readAsDataURL(input.files[0]);    
    } 
    $(".alert").removeClass("loading").hide();
  }
  function RecurFadeIn(){ 
    console.log('ran');
    FadeInAlert("Wait for it...");  
  }
  function FadeInAlert(text){
    $(".alert").show();
    $(".alert").text(text).addClass("loading");  
  }
  
  var addValue = 0;
  function removeFile(indexValue) {
     console.log('removeFile');
     console.log(indexValue);
     if(indexValue > 0) {
        $('div#'+indexValue).remove();
        addValue = (addValue - 1);
      }
     /*$('.custom-file-label').empty();  
     $("#documents").empty();
     $('.custom-file-label').text('Upload');
     $('#educatonAdditional').val('');*/
  }
    var max_fields_limit4 = 10;
  var x4 = 1; 
  $('.add_more_composition').click(function(e){
   e.preventDefault();
   /*$(this).parent().parent().next().find('.name_organization').attr('required');
   $(this).parent().parent().next().find('.designation').attr('required');
   $(this).parent().parent().next().find('.fromdate').attr('required');
   $(this).parent().parent().next().find('.fromtodate').attr('required');
   $(this).parent().parent().next().find('.descriptions').attr('required');*/
   //$(this).('.total_experince').attr('required');
   // $(this).('.name_organization').attr('required');
   // $(this).('.designation').attr('required');
    //$(this).('.fromdate').attr('required');
   // //$(this).('.fromtodate').attr('required');
   // $(this).('.descriptions').attr('required');
    $(this).parent().parent().next().removeClass('hide1');
    $(this).addClass('hide1');
    $(this).next().removeClass('hide1');
    $(this).parent().parent('div').removeClass('hide1');
    // $(this).text('Remove');
    //$(this).hide();

    // if(x4 < max_fields_limit4){
    //  x4++;
    //  $('.composition_fields_container').append('<div style="margin-top: 5px;"><input type="text" name="composition_name[]" placeholder="Name ....."><input type="number" name="composition_value[]" placeholder="Value ....." style="margin-left: 10px;" /><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div>'); //add input field
    // }
  });  
  $('.remove_more').click(function(e){
    e.preventDefault();
    //$(this).parent().parent().prev().addClass('hide1');
    $(this).parent().parent('div').addClass('hide1');
    //$(this).parent().parent().prev().addClass('hide1');
    // $(this).('.total_experince').removeAttr('required');
    $(this).parent().parent().find('.name_organization').removeAttr('required');
    $(this).parent().parent().find('.designation').removeAttr('required'); 
    $(this).parent().parent().find('.fromdate').removeAttr('required');
    $(this).parent().parent().find('.fromtodate').removeAttr('required');
    $(this).parent().parent().find('.descriptions').removeAttr ('required');
    //$(this).parent().next().removeClass('hide1');
    // $(this).parent('div').addClass('hide');
    // $(this).addClass('add_more_composition');
    // $(this).removeClass('remove_more');
    // $(this).text('Add More Fields');
  });
  $('.composition_fields_container').on("click",".remove_field", function(e){
    //e.preventDefault(); $(this).parent('div').remove(); x4--;
  });

  $('#tog').click(function(){
    $('.ul_to').toggle();
    if($('#catid').val() != 0){
    $('#catid').val(0);
    }
  });           
  $('#cat').on('change', function(){
    if(this.value != 0){
      
    }
  });  
</script>