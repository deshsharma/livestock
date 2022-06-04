<style>
.cust-mainbg{background: #ECF0F5; min-height: 100vh}
.cust-wrapper{width: 100%; margin: 0 auto}

.mT40{margin-top: 40px}
.mB40{margin-bottom: 40px}
.mR20{margin-right: 20px}

.cust-addbull input{width: 50%; margin-top: 5px; padding: 10px; font-size: 20px; font-weight: 600; background: #4DA8B0}
.cust-pos{position: relative; top: -30px}
.box-danger2{border-top: 5px solid #0aa8b0; padding: 0 10px;}

.box-header h3{font-size: 26px!important; margin: 20px 0!important;}
.btn-success{background: #c13033; border-color: #c13033 }
.btn-success .fa{padding-right: 10px} 
.error{color:#ff0000;}
@media only screen and (max-width : 767px) {
.cust-wrapper{width: 100%;}
}
</style>
<div class="content-wrapper cust-mainbg">  
<div class="cust-wrapper">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="mT40 mB40">Add Bull Record</h12>
    </div>
  </div>

  <?php echo form_open_multipart("admin/add_bull/");?>
  <?php //print_r($_SESSION); ?>
  <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
  <div class="row">
    <div class="col-md-6">
          <div class="box box-danger2 box-primary">
            <div class="box-header">
              <!-- <h3 class="box-title">Enter the required information</h3> -->
            </div>  
        <div class="box-body">
                <!-- text input -->
                <div class="form-group ref" style="text-align: center; display:none;">
                  <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Bull Image</label>
                  <input type="file" id="bull_image">
                  <input type="hidden" name="bull_photo" id="bull_photo" value="">
                  <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <?php echo form_error('bull_id'); ?>
                  <label>Bull ID/ Tag No.</label>
                  <input type="text" name="bull_id" class="form-control" placeholder="Enter ..." value="<?= $_POST['bull_id'] ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <?php echo form_error('name'); ?>
                  <label>Bull's Name.</label>
                  <input type="text" name ='name' class="form-control" placeholder="Enter ..." value="<?= $_POST['name'] ?>">
                </div>
              </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                    <?php if($_SESSION['status'] == '1'){ ?>
                      <div class="form-group">
                      <?php echo form_error('bull_source'); ?>
                        <label>Semen Bank.</label>
                        <select name="bull_source" id="" class='ch_manset padd_set'>
                            <option >Select Bull Source</option>
                            <?php foreach($data as $da){ ?>
                                <option value="<?= $da['admin_id'] ?>"><?= $da['bank_name'] ?></option>
                            <?php }?>
                        </select>
                      </div>
                    <?php }else{
                       //$detail = $this->api_model->get_seman_company_id($_SESSION['user_id']);
                       //print_r($detail);
                      ?>
                      <div class="form-group">
                        <?php echo form_error('bull_source'); ?>
                        <label>Semen Bank.</label>
                        <input type="text" class="form-control" name="" value="<?= $_SESSION['user_name'] ?>" placeholder="Enter ..." readonly>
                        <input type="hidden" name="bull_source" value="<?= $_SESSION['user_id'] ?>">
                      </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_error('dob'); ?>
                      <label>DOB:</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="dob" class="form-control pull-right" id="datepicker" value="<?= $_POST['dob'] ?>">
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <?php echo form_error('category'); ?>
                    <label>Bull's Category.</label>
                    <select name="category" id="" class='ch_manset padd_set category'>
                        <option>Select Category</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php echo form_error('bread'); ?>
                    <label>Bull's Breed.</label>
                    <select name="bread" class='ch_manset padd_set breed'>
                        <option>Select Breed</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <?php echo form_error('sire_bread'); ?>
                    <label>Sire's Breed.</label>
                    <select name="sire_bread" class='ch_manset padd_set breed'>
                        <option>Select Breed</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                  <?php echo form_error('Dam_bread'); ?>
                    <label>Dam's Breed.</label>
                    <select name="Dam_bread" class='ch_manset padd_set breed'>
                        <option>Select Breed</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label style="color: #3c8dbc;">Yield should be in litres within lactation period of 310 days</label>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <?php echo form_error('lat_yield'); ?>
                    <label>Dam's Yield(In Litres)</label>
                    <input type="number" name="lat_yield" class="form-control" placeholder="Enter ..." value="<?= $_POST['lat_yield'] ?>" min="0" max="99999">
                  </div>
                </div>
                <div class="col-md-6">              
                  <div class="form-group">
                    <?php echo form_error('daughter_yield'); ?>
                    <label>Daughter's Yield(In Kg)</label>
                    <input type="number" name="daughter_yield" class="form-control" placeholder="Enter ..." value="<?= $_POST['daughter_yield'] ?>" min="0"  max="99999">
                  </div>
                </div>        
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Total Milk Fat(Kg)</label>
                    <input type="number" name="total_milk_fat" class="form-control" placeholder="Enter ..." value="<?= $_POST['total_milk_fat'] ?>"  min="0" max="99999">
                  </div>
                </div>
                <div class="col-md-6">              
                  <div class="form-group">
                    <label>Avg. Milk Protein(%)</label>
                    <input type="number" name="avg_milk_proteen" class="form-control" placeholder="Enter ..." value="<?= $_POST['avg_milk_proteen'] ?>"  min="0" max="100">
                  </div>
                </div>        
              </div>
              <div class="form-group">
                    <?php echo form_error('total_milk_proteen'); ?>
                    <label>Total Milk Protein (In Kg)</label>
                    <input type="number" name="total_milk_proteen" class="form-control" placeholder="Enter ..." value="<?= $_POST['total_milk_proteen'] ?>"  min="0" max="99999">
                  </div>
              <div class="form-group">
                    <label>Select Milk Type</label>
                      <div class="row">
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="milk_type" id="milk_type" value="A1" <?php if($_POST['milk_type'] == 'A1'){ echo "checked"; } ?>>
                              A1
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="milk_type" id="milk_type" value="A2" <?php if($_POST['milk_type'] == 'A2'){ echo "checked"; } ?>>
                              A2
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="milk_type" id="milk_type" value="Other" <?php if($_POST['milk_type'] == 'Other'){ echo "checked"; } ?>>
                              Other
                            </label>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="form-group">
                    <label>Semen Type</label>
                      <div class="row">
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="semen_type" id="semen_type" value="Normal" <?php if($_POST['semen_type'] == 'Normal'){ echo "checked"; } ?>>
                              Normal
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="semen_type" id="semen_type" value="Sexed" <?php if($_POST['semen_type'] == 'Sexed'){ echo "checked"; } ?>>
                              Sexed
                            </label>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="form-group">
                    <label>Category</label>
                      <div class="row">
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="star_cat" id="star_cat" value="1" <?php if($_POST['semen_type'] == '1'){ echo "checked"; } ?>>
                              1 Star
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="star_cat" id="star_cat" value="3" <?php if($_POST['semen_type'] == '3'){ echo "checked"; } ?>>
                              3 Star
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="star_cat" id="star_cat" value="5" <?php if($_POST['semen_type'] == '5'){ echo "checked"; } ?>>
                              5 Star
                            </label>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="form-group">
                    <label>Progeny Tested</label>
                      <div class="row">
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="progini_test" id="progini_test" value="Yes" <?php if($_POST['progini_test'] == 'Yes'){ echo "checked"; } ?>>
                              Yes
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="progini_test" id="progini_test" value="No" <?php if($_POST['progini_test'] == 'No'){ echo "checked"; } ?>>
                              No
                            </label>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="form-group">
                    <label>Is Imported</label>
                      <div class="row">
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="is_imported" id="is_imported" value="Yes" <?php if($_POST['is_imported'] == 'Yes'){ echo "checked"; } ?>>
                              Yes
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="is_imported" id="is_imported" value="No" <?php if($_POST['is_imported'] == 'No'){ echo "checked"; } ?>>
                              No
                            </label>
                          </div>
                        </div>
                      </div>
                </div>
                
               
          </div>


          </div>
          </div>

   <div class="col-md-6">
          <div class="box box-danger2 box-primary">
            <div class="box-header">
              <!-- <h3 class="box-title">Enter the required information</h3> -->
            </div>  
        <div class="box-body">
                
                <div class="form-group">
                    <label>Is Certified</label>
                      <div class="row">
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="is_certified" id="is_certified" value="Yes" <?php if($_POST['is_certified'] == 'Yes'){ echo "checked"; } ?>>
                              Yes
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">  
                          <div class="radio">
                            <label>
                              <input type="radio" name="is_certified" id="is_certified" value="No" <?php if($_POST['is_certified'] == 'No'){ echo "checked"; } ?>>
                              No
                            </label>
                          </div>
                        </div>
                      </div>
                </div>
                  <div class="form-group">
                      <label style="color: #3c8dbc;">Semen's Price for Farmer to be shown in Livestoc & HPKD</label>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <?php echo form_error('price'); ?>
                        <label>Semen's Price For Farmer (In Rs) </label>
                        <input type="number" name="price" class="form-control" placeholder="Enter ..." value="<?= $_POST['price'] ?>"  min="0">
                      </div>
                    </div>  
                </div>
                <div class="form-group">
                      <label style="color: #3c8dbc;">Semen's Price for AI Worker to be shown in Livestoc Pro</label>
                </div>
                <div class="row">
                    <div class="col-md-6">              
                      <div class="form-group">
                      <?php echo form_error('ai_price'); ?>
                        <label>Semen's Price For AI (In Rs)</label>
                        <input type="number" name="ai_price" class="form-control" placeholder="Enter ..." value="<?= $_POST['ai_price'] ?>"  min="0">
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                      <?php echo form_error('distributor_price'); ?>
                        <label>Semen's Price For Distributor/Supplier (In Rs)</label>
                        <input type="number" name="distributor_price" class="form-control" placeholder="Enter ..." value="<?= $_POST['distributor_price'] ?>"  min="0">
                      </div>
                    </div>       
                </div>
                <div class="form-group">
                  <label>Description(If Any)</label>
                  <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."><?= $_POST['description'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Animal Registration Certificate</label>
                  <input type="file" id="file-1">
                  <input type="hidden" name="registration" id="pro_image1">
                  <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Brochure(if any)</label>
                  <input type="file" id="file-2">
                  <input type="hidden" name="brochure" id="pro_image2">
                  <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Animal Health Certificates</label>
                  <input type="file" id="file-3">
                  <input type="hidden" name="health" id="pro_image3">
                  <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Progeny Record (if any)</label>
                  <input type="file" id="file-4">
                  <input type="hidden" name="progeny" id="pro_image4">
                  <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                </div>
                <!-- text input -->
                <div class="form-group">
                  <label for="exampleInputFile">Champion/Any Other Certificate</label>
                  <input type="file" id="file-5">
                  <input type="hidden" name="champion" id="pro_image5">
                  <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload Video</label>
                  <input type="file" id="file-6">
                  <input type="hidden" name="video" id="pro_image6">
                  <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                </div>
                
                <!-- radio -->
               

    </div>

  </div>
  <div class="row">
   <div class="col-md-12 text-center cust-addbull"> 
  <input type="submit" name="submit" class="btn btn-primary" style="margin-bottom: 20px;" id="submit" value="Submit">
</div>
</div>

</div>
</div>
</form>
</div>
</div>
<script>
$('#submit').click(function(e){
  if($('#bull_photo').val() == ''){
    e.preventDefault();
    alert("Please Upload Bull's Photo");
  }
});
$(document).ready(function() {
				$('#bull_image').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#bull_image')[0].files[0].name);
					var file_data = $('#bull_image').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
          $('.ref').show();
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#bull_photo').val(data.data);
              $('.ref').hide();
						}
              
					});
				});
});
$(document).ready(function() {
				$('#file-1').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#file-1')[0].files[0].name);
					var file_data = $('#file-1').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
          $('.ref').show();
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#pro_image1').val(data.data);
              $('.ref').hide();
						}
					});
				});
});
$(document).ready(function() {
				$('#file-2').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#file-2')[0].files[0].name);
					var file_data = $('#file-2').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
          $('.ref').show();
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#pro_image1').val(data.data);
              $('.ref').hide();
						}
					});
				});
	});
  $(document).ready(function() {
				$('#file-3').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#file-3')[0].files[0].name);
					var file_data = $('#file-3').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
          $('.ref').show();
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#pro_image1').val(data.data);
              $('.ref').hide();
						}
					});
				});
	});
  $(document).ready(function() {
				$('#file-4').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#file-4')[0].files[0].name);
					var file_data = $('#file-4').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
          $('.ref').show();
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#pro_image1').val(data.data);
              $('.ref').hide();
						}
					});
				});
	});
  $(document).ready(function() {
				$('#file-5').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#file-5')[0].files[0].name);
					var file_data = $('#file-5').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
          $('.ref').show();
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#pro_image1').val(data.data);
              $('.ref').hide();
						}
					});
				});
	});
  $(document).ready(function() {
				$('#file-6').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#file-6')[0].files[0].name);
					var file_data = $('#file-6').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
          $('.ref').show();
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#pro_image1').val(data.data);
              $('.ref').hide();
						}
					});
				});
	});
$(".category").change(function() {
     var id = this.value;
     $('.ref').show();
 	ajaxloader.load("<?php echo base_url('admin/get_breed');?>?id="+id+"", function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str['error']=='1'){ 
			                     		tr += "<option>No record found!</option>";
			                       	}
			                      	else{
			                      		var result = str;
                                          tr += "<option value=''>Select Category</option>"
			                            $.each(result, function(index, item){
                                            tr += "<option value="+item.breed_id+">"+item.breed_name+"</tr>";
                                        });
                                        $('.breed').html(tr);
                                      }
                              $('.ref').hide();
     });
 });
 $(document).ready(function() {
  $('.ref').show();
 	ajaxloader.load("<?php echo base_url('admin/get_category'); ?>", function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str['error']=='1'){ 
			                     		tr += "<option>No record found!</option>";
			                       	}
			                      	else{
			                      		var result = str;
                                          tr += "<option value=''>Select Category</option>" 
			                            $.each(result, function(index, item){
                                          if(item.category_id == 1 || item.category_id == 8){
                                            tr += "<option value="+item.category_id+">"+item.category+"</option>";
                                          }
                                        });
                                        $('.category').html(tr);
                                      }
                                      $('.ref').hide();
     });
 });
</script>