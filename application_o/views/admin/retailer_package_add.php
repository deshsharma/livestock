<link rel="stylesheet" href="<?= base_url() ?>assets/app/css/livestoc.css">
<div class="content-wrapper cust-mainbg">  
<div class="cust-wrapper">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="mT40 mB40">Add Retailer Package</h12>
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
  <?php echo form_open_multipart("admin/retailer_package_add");?>
  <?php //print_r($_SESSION); ?>
  <div class="row">
    <div class="col-md-12">
          <div class="box box-danger2 box-primary">
            <div class="box-header">
              <!-- <h3 class="box-title">Enter the required information</h3> -->
            </div>  
        <div class="box-body">
                <!-- text input -->
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_error('name'); ?>
                        <label>Package Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <?php echo form_error('mrp'); ?>
                        <label>MRP.</label>
                        <input type="number" name ='mrp' class="form-control"  placeholder="Enter ..." >
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_error('sale'); ?>
                        <label>Sale Price</label>
                        <input type="number" name="sale" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <?php echo form_error('qty'); ?>
                        <label>Retailer Qty.</label>
                        <input type="number" name ='qty' class="form-control"  placeholder="Enter ..."  >
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_error('description'); ?>
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
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
</script>