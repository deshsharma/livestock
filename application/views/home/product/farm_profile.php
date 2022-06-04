<style>
  label {
    display: block;
    margin: 10px 0;
  }
</style>
 <input type="hidden" id="users_id" value="<?php echo $this->session->userdata('users_id') ? $this->session->userdata('users_id') : 0; ?>">
 <?php
 //print_r($farm_id); 
 $user_details = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND id = "'.$farm_id.'"', 'from_profile as fp', '', '*, (Select name from form_type where id = type_of_form) as type_of_form_name, (Select username from doctor where doctor_id = doc_id) as doctor_name, (Select username from doctor where doctor_id = vt_id) as vt_name, (Select mobile from doctor where doctor_id = doc_id) as doctor_mobile, (Select mobile from doctor where doctor_id = vt_id) as vt_mobile, (Select email from doctor where doctor_id = doc_id) as doctor_email, (Select email from doctor where doctor_id = vt_id) as vt_email, (Select CONCAT("https://www.livestoc.com/harpahu_merge_dev/uploads//doctor/", image) from doctor where doctor_id = doc_id) as doctor_image, (Select CONCAT("https://www.livestoc.com/harpahu_merge_dev/uploads//doc/", image) from doctor where doctor_id = vt_id) as vt_image, (Select full_name from users where users_id = fp.users_id) as user_name, (Select mobile from users where users_id = fp.users_id) as user_mobile, (Select address1 from address_mst where address_id = (select address_id from users where users_id = fp.users_id)) as user_default_address, (select (select (select name from zone as z where z.zone_id = mst.zone_id) from address_mst as mst where mst.users_id = frp.users_id order by address_id DESC limit 1) as state from address_mst as frp where frp.address_id = (select address_id from users where users_id = fp.users_id)) as user_state, (Select CONCAT("https://www.livestoc.com/uploads_new//profile//thumb/", image) from users where users_id = fp.users_id) as user_image');
 //print_r($user_details);
 ?>
<section>
  <div class="liv-all-animals primary-grey champ-bull-listing champ-bull-reg">
    <div class="container-fluid p0">
      <label><input type="checkbox" class="agree"> Please check to Edit.</label>
      <form action="<?= base_url().'homenew/update_farm_profile'?>" method="POST" id="userdetail" enctype="multipart/form-data">
        <input type="hidden" name="users_id" value="<?php echo $this->session->userdata('users_id'); ?>">
        <input type="hidden" name="id" value="<?php echo $user_details[0]['id'];?>">
        <div class="row">
            <!-- <div class="col-md-6 mt-5">            
              <div class="image-upload mt-4"> 
                <label style="cursor: pointer;" for="file_upload">
                  <div class="h-100">
                    <div class="dplay-tbl">
                      <div class="dplay-tbl-cell">
                        <img src="<?= $user_details[0]['doctor_image']?>"> 
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="animal_image" id="bull_photo" value="">
                </label>
              </div>
              <span class=""><?= $user_details[0]['doctor_name']?> </span>
              <label><strong>Veterinary Doctor</strong></label>                              
            </div> -->
            <!-- <div class="col-md-6 mt-5">
              <div class="image-upload mt-4">
                <label style="cursor: pointer;" for="file_upload"> <img src="" alt="" class="uploaded-image">
                  <div class="h-100">
                    <div class="dplay-tbl">
                        <img src="<?= $user_details[0]['vt_image']?>"> 
                    </div>
                  </div>
                </label> 
              </div>
             <span class=""><?= $user_details[0]['vt_name']?> </span>
             <label><strong>Service Provider</strong></label>
             <span>Change</span>
             <div class="form-row">
               <input type="text" name="serch">
             </div>                                  
            </div> -->
          </div><br></br>
          <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputAddress">Farm Type</label>
            <input type="text" value="<?= $user_details[0]['type_of_form_name']?>" name = "type_of_form_name" class="form-control" id="inputfarmName" placeholder="My Dairy Farm">
            </div>    
            <div class="form-group col-md-6">
              <label for="inputAddress">Farm Name</label>
              <input type="text" value="<?= $user_details[0]['form_name']?>" name = "form_name" class="form-control" id="inputfarmName" placeholder="Farm Name">
            </div>
          </div> 
          <?php if($user_details[0]['type_of_form_name'] == 'My Dairy Farm'){?>                      
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">No.of Animals</label>
                  <input type="text" name="total_no_animal" value="<?= $user_details[0]['total_no_animal']?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">No. of Milking Animals</label>
                  <input type="text" name="milking" value="<?= $user_details[0]['milking']?>" class="form-control" id="milking" >
                </div>
              </div>
               <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">No. of Non Milking Animals</label>
                  <input type="text" name="non_milking" value="<?= $user_details[0]['non_milking']?>" class="form-control" id="non_milking">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">No. of Pregnant Animals</label>
                  <input type="text"  value="<?= $user_details[0]['pregnent']?>" name="pregnent" class="form-control" id="inputPregnent">
                </div>
              </div>
               <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">No. of Non-Pregnant Animals</label>
                  <input type="text" name = "non_pregnent" value="<?= $user_details[0]['non_pregnent']?>" class="form-control" id="inputPin">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">No. of Heifer Animals</label>
                  <input type="text" value="<?= $user_details[0]['heifer']?>" name="heifer" class="form-control" id="inputHeifer">
                </div>          
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>No of Repeat Breeder Animals</strong></label>
                  <input type="text" value="<?= $user_details[0]['repeat_breeders'] ?>" name="repeat_breeders" class="form-control" id="inputSample">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">No. of Dry Animals</label>
                  <input type="text" name="dry" value="<?= $user_details[0]['dry']?>" class="form-control" id="inputDry">
                </div>
              </div>
              <div class="form-row">
                  <label for="inputSample4"><strong>Calf at Foot (if Any)</strong></label>
                </div>
                <div class="form-row">                 
                  <input type="button" class="btn" value="Yes" name="btnClub">
                  <input type="button" class="btn" value="No" name="btnClub">                                          
                </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>Type of Shed</strong></label>
                  <input type="text" value="<?= $user_details[0]['type_of_shed']?>" name="type_of_shed" class="form-control" id="inputSample">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Type of Flooring</label>
                  <input type="text" name="type_of_floring" value="<?= $user_details[0]['type_of_floring']?>" class="form-control" id="inputCity">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>Exposer to Sun Light</strong></label>
                  <input type="text" value="<?= $user_details[0]['exposer_sun_light']?>" name="exposer_sun_light" class="form-control" id="inputSample">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Ventilation</label>
                  <input type="text" name="ventilation" value="<?= $user_details[0]['ventilation']?>" class="form-control" id="ventilation">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label><strong class="alert alert-primary">Fodder Detail</strong></label>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>Green Fodder</strong></label>
                  <input type="text" value="<?= $user_details[0]['green_fodder']?>" name="green_fodder" class="form-control" id="green_fodder">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Feed</label>
                  <input type="text" name="feed" value="<?= $user_details[0]['feed']?>" class="form-control" id="feed">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>Dry Fodder</strong></label>
                  <input type="text" value="<?= $user_details[0]['dry_fodder']?>" name="dry_fodder" class="form-control" id="dry_fodder">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Mineral Mixture in kg</label>
                  <input type="text" name="minral_mixture" value="<?= $user_details[0]['minral_mixture']?>" class="form-control" id="minral_mixture">
                </div>
              </div>
      <?php }else if($user_details[0]['type_of_form_name'] == 'My Piggery Farm'){?>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>No. of Animals</strong></label>
                  <input type="text" value="<?= $user_details[0]['total_no_animal']?>" name="total_no_animal" class="form-control" id="total_no_animal">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Ventilation</label>
                  <input type="text" name="ventilation" value="<?= $user_details[0]['ventilation']?>" class="form-control" id="ventilation">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>No. of Fattening Pigs</strong></label>
                  <input type="text" value="<?= $user_details[0]['no_of_fattening_pig']?>" name="no_of_fattening_pig" class="form-control" id="no_of_fattening_pig">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">No. of Sow</label>
                  <input type="text" name="no_of_sow" value="<?= $user_details[0]['no_of_sow']?>" class="form-control" id="no_of_sow">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>No. of Piglets</strong></label>
                  <input type="text" value="<?= $user_details[0]['no_of_piglets']?>" name="no_of_piglets" class="form-control" id="no_of_piglets">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">No. of Boar</label>
                  <input type="text" name="no_of_boar" value="<?= $user_details[0]['no_of_boar']?>" class="form-control" id="no_of_boar">
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <label> Creep Space </label>
              </div>
              <div class="col-md-6 mt-3">                      
                <input type="button" class="btn" value="Yes" style="background-color: #48ade4;" name="creep_space">
                <input type="button" class="btn" value="No" style="background-color: #48ade4;" name="creep_space">  
              </div>
              <div class="col-md-6 mt-3">
                <label> Farrowing Pen </label>
              </div>
              <div class="col-md-6 mt-3">                      
                <input type="button" class="btn" value="Yes" style="background-color: #48ade4;" name="farrawing_pen">
                <input type="button" class="btn" value="No" style="background-color: #48ade4;" name="farrawing_pen">  
              </div>
              <div class="col-md-6 mt-3">
                <label> Adequate Drainage </label>
              </div>
              <div class="col-md-6 mt-3">                      
                <input type="button" class="btn" value="Yes" style="background-color: #48ade4;" name="adequate_drainage">
                <input type="button" class="btn" value="No" style="background-color: #48ade4;" name="adequate_drainage">  
              </div>
        <?php }else if($user_details[0]['type_of_form_name'] == 'My Sheep Goat Farm'){?>
          <div class="col-md-6 mt-3">
                <label> Animals Reared for Meat </label>
              </div>
              <div class="col-md-6 mt-3">                      
                <input type="button" class="btn" value="Yes" style="background-color: #48ade4;" name="animals_reared_for_meat">
                <input type="button" class="btn" value="No" style="background-color: #48ade4;" name="animals_reared_for_meat">  
              </div>
              <div class="col-md-6 mt-3">
                <label> Animals Reared for Wool </label>
              </div>
              <div class="col-md-6 mt-3">                      
                <input type="button" class="btn" value="Yes" style="background-color: #48ade4;" name="animals_reared_for_wool">
                <input type="button" class="btn" value="No" style="background-color: #48ade4;" name="animals_reared_for_wool">  
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>No. of Milch Animals</strong></label>
                  <input type="text" value="<?= $user_details[0]['milch_animals']?>" name="milch_animals" class="form-control" id="milch_animals">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Type of Housing</label>
                  <input type="text" name="type_of_housing" value="<?= $user_details[0]['type_of_housing']?>" class="form-control" id="type_of_housing">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>Rearing System</strong></label>
                  <select name="rearing_system" class="form-control" id="cars">
                  <option value="intensive">Choose</option>                   
                    <option value="intensive">Intensive</option>
                    <option value="Artifical">Extensive</option>
                  </select>
                </div>
              </div>
          <?php }else if($user_details[0]['type_of_form_name'] == 'My Poultry Farm'){?>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>No. of Birds</strong></label>
                  <input type="text" value="<?= $user_details[0]['total_no_of_birds']?>" name="total_no_of_birds" class="form-control" id="total_no_of_birds">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">No. of Layer</label>
                  <input type="text" name="no_of_layer" value="<?= $user_details[0]['no_of_layer']?>" class="form-control" id="no_of_layer">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>No. of Breeder</strong></label>
                  <input type="text" value="<?= $user_details[0]['no_of_breeder']?>" name="no_of_breeder" class="form-control" id="no_of_breeder">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Type of Bredding</label>
                  <input type="text" name="type_of_bedding" value="<?= $user_details[0]['type_of_bedding']?>" class="form-control" id="type_of_bedding">
                </div>
              </div>
            <?php }else{?>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>Species</strong></label>
                  <input type="text" value="<?= $user_details[0]['species']?>" name="species" class="form-control" id="inputSample">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Fish Quantity (in kg)</label>
                  <input type="text" value="<?= $user_details[0]['no_of_fish']?>" name="no_of_fish" class="form-control" id="inputCity">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>Type of Pond</strong></label>
                  <input type="text" value="<?= $user_details[0]['type_of_pond']?>" name="type_of_pond" class="form-control" id="inputSample">
                </div>
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">Size of Pond (in feet)</label>
                  <input type="text" value="<?= $user_details[0]['sige_of_pond']?>" name="sige_of_pond" class="form-control" id="inputCity">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputSample4"><strong>Type of Aeration</strong></label>
                  <select name="type_of_aeration" class="form-control" id="cars">                   
                    <option value="<?= $user_details[0]['type_of_aeration']?>"><?= $user_details[0]['type_of_aeration']?></option>
                    <option value="Artifical">Artifical (Machine)</option>
                  </select>
                </div>
              </div>
            <?php }?>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputSample4"><strong>Others</strong></label>
            <input type="text" value="<?= $user_details[0]['others']?>" name="others" class="form-control" id="inputSample">
          </div>
        </div>
        <button type="submit" name="submit" class="btn btn btn-success">Update</button>
      </form>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('form input[type="text"]').prop("disabled", true);
        $(".agree").click(function(){
            if($(this).prop("checked") == true){
                $('form input[type="text"]').prop("disabled", false);
            }
            else if($(this).prop("checked") == false){
                $('form input[type="text"]').prop("disabled", true);
            }
        });
    });
</script>