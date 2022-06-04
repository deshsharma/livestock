<link rel="stylesheet" href="<?= base_url() ?>assets/app/css/livestoc.css">
<div class="content-wrapper cust-mainbg">  
<div class="cust-wrapper">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="mT40 mB40"><?php if($type == '1'){ echo  "Add Distributor";}else{ echo "Add Retailer"; } ?>
    </div>
  </div>
  <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
  <?php echo form_open_multipart("admin/add_pro_subuser/".$type);?>
  <?php //print_r($_SESSION); ?>
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
                  <label for="exampleInputFile">Upload Image</label>
                  <input type="file" id="bull_image">
                  <input type="hidden" name="image" id="bull_photo" value="">
                  <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                                <?php if($_SESSION['status'] == '1'){ ?>
                                <?php echo form_error('vendor_id'); ?>
                                <?php $vendor = $this->api_model->get_data('type = "18"', "admin", 'fname ASC', 'admin_id, fname'); ?>
                                <label>Select Vendor</label>
                                <select name="vendor_id" class="form-control">
                                    <option value="">Select Vendor</option>
                                    <?php foreach($vendor as $vd){ ?>
                                        <option value="<?= $vd['admin_id'] ?>"><?= $vd['fname'] ?></option>
                                    <?php } ?>
                                </select>
                            <?php }else{ ?>
                                    <input type="hidden" name="vendor_id" value="<?= $_SESSION['user_id'] ?>">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_error('name'); ?>
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <?php echo form_error('mobile'); ?>
                        <label>Mobile No.</label>
                        <input type="number" name ='mobile' class="form-control" pattern=".{5,10}" placeholder="Enter ..."  min="1000000000" max="9999999999">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="type_user" value="<?= $type ?>">
                <?php
                if($type == 1){
                    echo "<input type='hidden' name='user_type' value='10'>";
                    echo "<input type='hidden' name='type' value='29'>";
                }else if($type == 2){
                    echo "<input type='hidden' name='user_type' value='6'>";
                    echo "<input type='hidden' name='type' value='15'>";
                }else if($type == 3){
                    echo "<input type='hidden' name='user_type' value='7'>";
                    echo "<input type='hidden' name='type' value='16'>";
                }
                ?>
                <?php //if($type == 1){ ?>
                   <!--  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('authority_type'); ?>
                            <label>Semen Bank/Authority Type</label>
                                <select name="authority_type" class="form-control">
                                    <option>Select Semen Bank/Authority Type</option>
                                    <option value="Government" >Government</option>
                                    <option value="Private" >Private</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <?php echo form_error('grade'); ?>
                            <label>Choose Grade.</label>
                                <select name="grade" class="form-control">
                                    <option>Select Choose Grade</option>
                                    <option value="A" >A</option>
                                    <option value="B" >B</option>
                                    <option value="C" >C</option>
                                    <option value="D" >D</option>
                                    <option value="E" >E</option>
                                </select>
                            </div>
                        </div>
                        </div> -->
                <?php // } ?>
                 <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group ref1" style="text-align: center; display:none;">
                          <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">Upload Adhar Front Image</label>
                          <input type="file" id="adhar_front_image">

                          <input type="hidden" name="adhar_image" id="adhar_front_img" value="">
                          <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group ref2" style="text-align: center; display:none;">
                          <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">Upload Adhar Back Image</label>
                          <input type="file" id="adhar_back_image">
                          <input type="hidden" name="adhar_back_image" id="adhar_back_img" value="">
                          <!-- <button type="button" class="btn btn-success pull-right mR20 cust-pos"><i class="fa fa-plus"></i> Add new</button> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('address1'); ?>
                            <label>Address Line 1</label>
                            <input type="text" name='address1' class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('address2'); ?>
                            <label>Address Line 2</label>
                            <input type="text" name='address2' class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('state'); ?>
                            <label>State</label>
                            <?php $data = $this->api_model->get_state(99); 
                            ?>
							<select class="form-control state" name="state" required>
                                <option value="">Select State</option>
                                <?php foreach($data as $d){ ?>
                                    <option value="<?= $d['zone_id'] ?>"><?= $d['name'] ?></option>
                                <?php } ?>
							</select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('district'); ?>
                            <label>District</label>
                            <select name="district" class="form-control city">
                                    <option>Select District</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('adhar_no'); ?>
                            <label>Adhar Number</label>
                            <input type="number" name ='adhar_no' class="form-control" placeholder="Enter ..." min="100000" max="999999999999">
                        </div>
                    </div>
               <!--  </div>
                  <div class="row"> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('pin'); ?>
                            <label>Pin Code</label>
                            <input type="number" name ='pin' class="form-control" placeholder="Enter ..." min="100000" max="999999">
                        </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo form_error('location'); ?>
                            <label>Enter Location</label>
                            <!-- <input type="text" name ='location' class="form-control" placeholder="Enter your Location"> -->
                             <input id="searchTextField" type="text"  placeholder="Enter a location" autocomplete="on" runat="server" required/>
                              <input type="hidden" id="city2" name="city2" />
                                <input type="hidden" value="" id="cityLat" name="cityLat" />
                                <input type="hidden" value="" id="cityLng" name="cityLng" /></p>
                                <!-- <input type="submit" name="location" value="submit" class="btn btn-info" /> -->
                        </div>
                    </div>
                    <?php if($type = 1){ ?>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Select Type </label>
                            <select name="comp_type" class="form-control">
                                <option>Select Type</option>
                                <option value="25" >Livestoc Company</option>
                                <option value="26" >Private Company</option>                                  
                            </select>

                        </div>                        
                    </div> <? }?>
                </div>
          </div>
        </div>
    </div>

   <div class="col-md-6">
            <div class="box box-danger2 box-primary">
                <div class="box-header">
                Generate Login Password for Distributor
                </div>  
                <div class="box-body">              
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo form_error('email'); ?>
                                    <label>Login Email Id</label>
                                    <input type="email" name ='email' class="form-control" placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo form_error('Password'); ?>
                                    <label>Password</label>
                                    <input type="password" name ='password' class="form-control" placeholder="Enter ...">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="box-header">
                Define Service Area for Distributor
                </div>  
                <div class="box-body">              
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo form_error('state1'); ?>
                                    <label>State</label>
                                    <?php $data = $this->api_model->get_state(99); ?>
                                    <select class="form-control state1" name="state1" required>
                                        <option value="">Select State</option>
                                        <?php foreach($data as $d){ ?>
                                            <option value="<?= $d['zone_id'] ?>"><?= $d['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo form_error('district1'); ?>
                                    <label>District</label>
                                    <select name="district1" class="form-control city1">
                                        <option>Select District</option>
                                    </select>
                                </div>
                            </div>
                    </div>
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
$('.state').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data.data;
                    var option = '<option value="">Select District</option>';
			                            $.each(str, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			                            }); 
                                        $('.city').html(option);
										
                }
                });
})
$('.state1').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data.data;
                    var option = '<option value="">Select District</option>';
			                            $.each(str, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			                            }); 
                                        $('.city1').html(option);
										
                }
                });
})
$('#submit').click(function(e){
  if($('#bull_photo').val() == ''){
    e.preventDefault();
    alert("Please Upload Photo");
  }
});
$('#submit').click(function(e){
  if($('#adhar_front_img').val() == ''){
    e.preventDefault();
    alert("Please Upload Adhar Front Image");
  }
});
$('#submit').click(function(e){
  if($('#adhar_back_img').val() == ''){
    e.preventDefault();
    alert("Please Upload Adhar Back Image");
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
                $('#adhar_front_image').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#adhar_front_image')[0].files[0].name);
                    var file_data = $('#adhar_front_image').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref1').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#adhar_front_img').val(data.data);
                            $('.ref1').hide();
                        }
                    });
                });
});
$(document).ready(function() {
                $('#adhar_back_image').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#adhar_back_image')[0].files[0].name);
                    var file_data = $('#adhar_back_image').prop('files')[0];   
                    var form_data = new FormData();                  
                    form_data.append('image', file_data);
                    $('.ref2').show();
                    $.ajax({
                        url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            data = JSON.parse(data);
                            $('#adhar_back_img').val(data.data);
                            $('.ref2').hide();
                        }
                    });
                });
});
</script>
 <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.submit.lat();
                document.getElementById('cityLng').value = place.geometry.submit.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

                
       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBKXAzms3AOjKJz4hjMlPdFreKAryub2U&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
     