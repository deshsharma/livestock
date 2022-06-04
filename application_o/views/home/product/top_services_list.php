<style>
div.a {
  font-size: 12px;
}
<?php //print_r($_REQUEST); 
$user_id = $this->session->userdata("users_id"); print_r($user_id);
     $user = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"','users');
     if($user[0]['address_id'] != ''){
        $address = $this->api_model->get_data('address_id = "'.$user[0]['address_id'].'" AND users_id = "'.$this->session->userdata("users_id").'"', 'address_mst');
        print_r($address);
      }else{
        $address = $this->api_model->get_data('users_id = "'.$this->session->userdata("users_id").'"', 'address_mst', 'address_id DESC');
      }
?>
</style>
<?php if($_REQUEST['category_id'] !='2' && $_REQUEST['category_id'] != '3' && $_REQUEST['category_id'] != '4' && $_REQUEST['category_id'] !='5' && $_REQUEST['category_id'] != '6' && $_REQUEST['category_id'] != '7'){?>
    <section>
        <div class="top-services primary-grey mt-5">
            
            <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 mt-1">
                    <h4 class="blue"><img class="img-fluid mr-3" src="<?= base_url() ?>assets/home/images/premium-icon.png" alt="icon"><?= $this->webLanguage['Top Services']?></h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="dealer neon-green">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="dealer-style">
                                            <p class="mb-0 check_button" ><?= $this->webLanguage['AI Registered with us']?> <span><strong></strong></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 algn">
                                            <!-- <a href="<?= base_url('homenew/ai_list') ?>" class="forlink"> -->
                                            <p class="mt-2"><?= $this->webLanguage['List']?> <i class="fas fa-chevron-right float-right pr-3 mt-2"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="dealer neon-blue">
                                    <div class="row">
                                        <?php if($address[0][latitude] !='' && $user_id != '' ){?>
                                        <div class="col-md-12">
                                            <div class="dealer-style check_button" id="lat_demo">
                                                <a href="<?= base_url() ?>homenew/ai_list" >
                                            <p class="mb-0"><?= $this->webLanguage['AI Registered with us']?><i class="fas fa-chevron-right float-right pr-3 mt-2"></i></p></a>
                                            </div>
                                        </div>
                                        <?php } else{?> 
                                            <div class="col-md-12">
                                            <div class="dealer-style check_button" id="lat_demo">
                                                <a href="<?= base_url() ?>frontend/login" >
                                            <p class="mb-0"><?= $this->webLanguage['AI Registered with us']?><i class="fas fa-chevron-right float-right pr-3 mt-2"></i></p></a>
                                            </div>
                                        </div>
                                        <?php }?>
                                       <!--  <div class="col-md-4 algn">
                                            <a href="#" class="forlink">
                                            <p class="mt-2"></p>
                                            </a>
                                        </div> -->
                                    </div>
                                </div>
                </div>
                </div>
                <div class="row mt-4 mb-4">
                <div class="col-md-6">
                    <div class="dealer neon-green">
                        <a href="<?= base_url('homenew/test_lab')?>">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="dealer-style">
                                    <p class="mb-0"><?= $this->webLanguage['Pregnancy Test of Cattle in 28 Days']?><div class="a"></div></p>
                                </div>
                            </div>
                            <div class="col-md-4 algn">
                                <div class="a"><?= $this->webLanguage['Near By You']?><i class="fas fa-chevron-right float-right pr-3"></i></div>
                            </div>
                       </div></a>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="dealer neon-blue">
                                    <div class="row">
                                   
                                        <div class="col-md-6">
                                            <div class="dealer-style">
                                            <p class="mb-0"><?= $this->webLanguage['Pregnancy Detection in 28 Days']?> <span><strong></strong></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 algn">
                                            <a  ><p onclick="sample()" class="mt-2"><?= $this->webLanguage['Submit Sample Now Only']?> <br>  @ Rs <?php echo LAB_CHARGES;?> <i class="fas fa-chevron-right float-right pr-3"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                   
                                </div>
                </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="form_lat" id="form_lat" value="<?php if($address[0]['latitude'] != ''){ echo $address[0]['latitude']; } ?>">
        <input type="hidden" name="form_lang" id="form_lang" value="<?php if($address[0]['longitude'] != ''){ echo $address[0]['longitude']; }?>"> 
        <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>"> 
    </section>
  <?php }?>
<script>
   app_url = "<?= base_url('/frontend'); ?>";
  function sample(){
    if($('#users_id').val() == '0'){
      window.location.href = "<?= base_url() ?>frontend/login";
    }else{
        window.location.href = "<?= base_url() ?>homenew/pregnancy_detection";
    }
  }
   function AiRegister(){
    if($('#users_id').val() == '0'){
      window.location.href = "<?= base_url() ?>frontend/login";
    }else{
        window.location.href = "<?= base_url() ?>homenew/ai_list";
    }
  }

</script>
<script>
$('.check_button').click(function(e){
          if($('#form_lat').val() == ''){
            if (confirm('Please On GeoLocation')) {
                location.reload();
                e.preventDefault()
            } else {
                e.preventDefault()
            }
          }
        });
   var x = $("#lat_demo");
   $(document).ready(function(){
    getLocation();
   })
      function getLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
              alert("Geolocation is not supported by this browser.");
          }
      }

      function showPosition(position) {
        $('#form_lat script').attr('data-notes.lat', position.coords.latitude);
        $('#form_lat script').attr('data-notes.long', position.coords.longitude);
         // alert("Latitude: " + position.coords.latitude +  "<br>Longitude: " + position.coords.longitude);
      }
   </script>
