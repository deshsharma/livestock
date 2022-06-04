<!-- Content Wrapper. Contains page content -->
<style type="text/css">
         .error {
            margin: 27%;
            width: auto;
            color:red;
            display: inline;
            font-weight: 100;
        }  
        ul.accordion2 li a.toggle {
          width: 100%;
          display: block;
          background: #fefefe;
          color: rgba(0, 0, 0, 0.78);
          padding: 0.75em;
          border-radius: 0.15em;
          transition: background 0.3s ease;
          text-decoration: none;
          box-sizing: border-box;
          cursor: pointer;
          list-style: none;
      }
      .hide{
        display:none;
      }
</style>
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tree.css" />
<script src="<?= base_url() ?>assets/plugins/tree.js"></script>
product_add
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add Product
            <small><?php if($_SESSION['status'] == '18'){ echo "Livestoc Ecommerce";}else{ echo "LIVESTOC";}?></small>
        </h1>
      <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Add Product</li>
      </ol>
    </section>
    <section class="content">
      <div class="">
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
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">&nbsp;</h3>
            </div>
            <form action="<?= base_url() ?>admin/product_add/" id="form" enctype="multipart/form-data" method="post">
            
                <div class="box-body">
                <div class="form-group">
                        <label>SKU Number</label>
                        <p style="font-size: 21px; text-decoration: solid; color: #562903;"><?= $sku_num ?></p>
                        <input type="hidden" name="sku" value="<?= $sku_num ?>" id="sku">
                </div>
                <div class="form-group">
                  <label>Select Section where you want to show your product in Livestoc </label>
                    <div class="row">
                        <?php foreach($section as $s){ ?>
                              <div class="col-md-4">  
                                <div class="radio">
                                  <label>
                                    <input type="checkbox" name="section[]" id="section[]" class="section" value="<?= $s['id'] ?>">
                                    <?= $s['name'] ?>
                                  </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                  <?php echo form_error('section'); ?>
                  <div class="form-group demo" id="lazy">
                    <div class="col-md-3">
                    <label>Category</label>
                    </div>
                    <div class="col-md-9">
                      <div class="col-md-12" id="tog"><a class="tog">Select Category</a></div>
                      <div class="demo col-md-12 ul_to" style="display: none;">
                          <ul class="accordion2 tree">
                              <?php 
                                  echo $category1;
                              ?>
                          </ul>
                      </div>
                      <input type="hidden" name="cat" value="0" id="catid">
                  </div>
                </div>
                </div>
                <div class="form-group">
                      <?php echo form_error('category'); ?>
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <?php echo form_error('category'); ?>
                  <label>Brand</label>
                  <input type="text" name="brand" class="form-control" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <?php echo form_error('height'); ?>
                  <label>Height in Centimenters</label>
                  <input type="number" name="height" class="form-control" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <?php echo form_error('width'); ?>
                  <label>Width in Centimenters</label>
                  <input type="number" name="width" class="form-control" placeholder="Enter ...">
                </div>
                <!-- <div class="form-group">
                  <?php echo form_error('weight'); ?>
                  <label>Product weight in Kg</label>
                  <input type="number" name="weight" class="form-control" placeholder="Enter ...">
                </div> -->
                <!-- <div class="form-group">
                  <?php echo form_error('mrp'); ?>
                  <label>Product MRP (In Rs)</label>
                  <input type="number" name="mrp" class="form-control" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <?php echo form_error('rp'); ?>
                  <label>Special price for Livestoc ( Users ) (In Rs)</label>
                  <input type="number" name="rp" class="form-control" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <?php echo form_error('mrp'); ?>
                  <label>Special price for veterinarian for Livestoc Pro App (In Rs)</label>
                  <input type="number" name="wsp" class="form-control" placeholder="Enter ...">
                </div> -->
                <div class="form-group">
                <?php echo form_error('color'); ?>
                  <label>Select Colour</label>
                  <select name="color" id="color" class="form-control" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option>Select Colour</option>
                    <?php foreach($color as $co){ ?>
                        <option value="<?= $co['id'] ?>" style="color: #f1f1f1; background: <?= $co['colour']?>;"><?= $co['name']?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                <?php echo form_error('hub'); ?>
                  <label>Select HUB</label>
                  <select name="hub" id="hub" class="form-control" onchange="get_hub_employee(this.value)" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option>Select Hub</option>
                    <?php foreach($product_hub as $hub){ ?>
                        <option value="<?= $hub['admin_id'] ?>" ><?= $hub['fname']?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                <?php echo form_error('hubemp'); ?>
                  <label>Select HUB Employee</label>
                  <select name="hubemp" id="hubemp" class="form-control" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option>Select Hub Employee</option>
                  </select>
                </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">&nbsp; Please Select Package Quantity and Unit to enter Rate</h3>
                </div>
                <div class="box-body">
                <div class="form-group">
                <?php echo form_error('category'); ?>
                  <label>Select Unit</label>
                  <select name="unit" id="unit" class="form-control" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <!-- <option>Select Unit</option> -->
                    <?php foreach($unit as $u){ ?>
                        <option value="<?= $u['id'] ?>"><?= $u['name']?></option>
                    <?php } ?>
                  </select>
                </div>
                <?php
                $i = 0; 
                foreach($package as $pack){ 
                ?> 
                <div class="packValues<?= $i ?><?= $pack['unit_id']?> pack1 <?= $pack['unit_id']?> 
                        <?php if($unit[0]['id'] != $pack['unit_id'] || $i != 0){ echo "hide"; } ?>">   
                        <div class="forproduct pack">   
                              <div class="form-group forwd mar">
                                <label>Select Product Quantity</label>
                                <select name="pack_id[]" id="pack_id[]" class="form-control" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                  <!-- <option>Select Unit</option> -->
                                  <?php foreach($package as $pa){ ?>
                                    <option value="<?php echo $pa['id'] ?>"><?php echo $pa['name']; ?></option>
                                  <?php } ?>
                                </select>
                              </div> 
                               <div class="form-group forwd">
                                  <label>MRP</label>
                                  <input type="text" name="pack_mrp[]" class="form-control" placeholder="00.00">
                              </div>    
                              <div class="form-group forwd mar">
                                  <label>Rate for Livestoc</label>
                                  <input type="text" name="pack_sale[]" class="form-control" placeholder="00.00">
                              </div>  
                              <div class="form-group forwd">
                                  <label>Rate for Livestoc Pro</label>
                                  <input type="text" name="pack_sale_price_vt[]" class="form-control" placeholder="00.00">
                              </div> 
                        </div>        
                            <div class="form-group foradd add_mo">
                                <a ><i class="fa fa-plus" aria-hidden="true"></i><label>Add More</label></a>
                            </div>     
                </div>
                <?php $i++; } ?>    
                    <?php //foreach($package as $pack){ ?>
                      <!-- <div class="pack <?= $pack['unit_id']?> 
                        <?php if($unit[0]['id'] != $pack['unit_id']){ echo "hide"; } ?>">
                        <input type="hidden" value="<?= $pack['id'] ?>" name="pack_id[]" />
                        <span><?= $pack['name'] ?> Product Package MRP (In Rs)</span>
                        <input type="number" class="form-control" value="" name="pack_mrp[]" />
                        <span>Special price for Livestoc ( Users ) for <?= $pack['name'] ?> Product (In Rs)</span>
                        <input type="number" class="form-control" value="" name="pack_sale[]" />
                        <span>Special price for veterinarian for Livestoc Pro App for <?= $pack['name'] ?> Product (In Rs)</span>
                        <input type="number" class="form-control" value="" name="pack_sale_price_vt[]" />
                      </div> -->
                    <?php //} ?>
				        <!-- </div> -->
                <div class="form-group">
                <?php echo form_error('language'); ?>
                  <label>Select Languge</label>
                  <select name="language" id="languae" class="form-control" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                  <label>Language Name.</label>
                    <?php
                      $language = $this->api_model->get_data('is_activate = "1"','language','','*');
                    foreach($language as $lang){ ?>                        
                        <option value="<?= $lang['id'] ?>"><?= $lang['name']?></option>
                    <?php } ?>
                  </select>
                </div>
				      <div id="package" class="form-group"></div>
                  <div class="form-group">
                  <?php echo form_error('category'); ?>
                    <label>Short Description</label>
                   <textarea id="editor1" name="desc" rows="8" cols="80">
                      This is my textarea Short Description.
                    </textarea>
                  
                        <!-- <input type="text" name="desc" class="form-control" placeholder="Enter ..."> -->
                      </div>
                  <div class="form-group">
                  <?php echo form_error('category'); ?>
                        <label>Long Description</label>
                    <textarea id="editor2" name="long_desc" rows="8" cols="80">
                      This is my textarea Short Description.
                    </textarea>
                        <!-- <textarea class="form-control" name="long_desc" rows="3" placeholder="Enter ..."></textarea> -->
                  </div>
                  <div class="form-group">
                  <?php echo form_error('category'); ?>
                        <label>Other Description</label>
                    <textarea id="editor3" name="other_desc" rows="8" cols="80">
                      This is my textarea Short Description.
                    </textarea>
                        <!-- <textarea class="form-control" name="other_desc" rows="3" placeholder="Enter ..."></textarea> -->
                  </div>
                </div>
                <div class="form-group">
                  <label style="margin-left: 10px;">Composition/Salt</label>
                  <div class="input-group composition_fields_container" style="margin-left: 10px;">
                      <?php for($i=0;$i<10;$i++){ ?>
                          <?php if($i == '0'){ ?>
                            <div style="margin-top: 5px;" class=""><input type="text" name="composition_name[]" placeholder="Name ....."><input type="number" name="composition_value[]" placeholder="Value ....." style="margin-left: 10px;" /><button class="btn btn-sm btn-primary add_more_composition" style="margin-left: 10px;">Add More Fields</button><button class="btn btn-sm btn-primary remove_more hide" style="margin-left: 10px;">Remove</button></div>
                          <?php }else{ ?>
                            <div style="margin-top: 5px;" class="hide"><input type="text" name="composition_name[]" placeholder="Name ....."><input type="number" name="composition_value[]" placeholder="Value ....." style="margin-left: 10px;" /><button class="btn btn-sm btn-primary add_more_composition" style="margin-left: 10px;">Add More Fields</button><button class="btn btn-sm btn-primary remove_more hide" style="margin-left: 10px;">Remove</button></div>
                          <?php } ?>
                      <?php } ?>
                      
                      <!-- <button class="btn btn-sm btn-primary add_more_composition" style="margin-left: 10px;">Add More Fields</button> -->
                  </div>
                </div>
                <!-- <link rel="stylesheet" href="<?= base_url().'assets/admin/crop/bootstrap.min.css'?>" /> 
                <link rel="stylesheet" href="<?= base_url().'assets/admin/crop/croppie.css'?>" /> -->
                     
                <!-- <div class="form-group pad14"> -->
                  <div class="form-group">
                     <?php echo form_error('category'); ?>
                    <!-- <label for="exampleInputFile">Upload Images</label> -->
                    <label for="exampleInputFile" style="margin-left: 10px;">Upload Images</label>
                      <div class="custom-file"  style="margin-left: 10px;">
                        <input type="file" id="file-1" class="file-1">
                        <input type="hidden" name="pro_image[]" id="pro_image1">
                        <div id="uploaded_image"></div>
                      </div>
                    <!-- <ul class="list-inline forimage">
                        <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>
                        <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>
                        <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>
                        <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>
                        <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>
                        <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>
                        <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>
                    </ul> -->
                </div>
                  <div class="form-group">
                <?php echo form_error('category'); ?>
                    <label for="exampleInputFile" style="margin-left: 10px;">Upload Images</label>
                    <div class="input-group">
                      <div class="custom-file"  style="margin-left: 10px;">
                        <input type="file" id="file-2" class="file-2">
                        <input type="hidden" name="pro_image[]" id="pro_image2">
                        <div id="uploaded_image"></div>
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                <?php echo form_error('category'); ?>
                    <label for="exampleInputFile" style="margin-left: 10px;">Upload Images</label>
                    <div class="input-group">
                      <div class="custom-file"  style="margin-left: 10px;">
                        <input type="file" id="file-3" class="file-3">
                        <input type="hidden" name="pro_image[]" id="pro_image3">
                        <div id="uploaded_image"></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                <?php echo form_error('category'); ?>
                    <label for="exampleInputFile" style="margin-left: 10px;">Upload Images</label>
                    <div class="input-group">
                      <div class="custom-file"  style="margin-left: 10px;">
                        <input type="file" id="file-3" class="file-4">
                        <input type="hidden" name="pro_image[]" id="pro_image4">
                        <div id="uploaded_image"></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                <?php echo form_error('category'); ?>
                    <label for="exampleInputFile" style="margin-left: 10px;">Upload Images</label>
                    <div class="input-group">
                      <div class="custom-file"  style="margin-left: 10px;">
                        <input type="file" id="file-3" class="file-4">
                        <input type="hidden" name="pro_image[]" id="pro_image5">
                        <div id="uploaded_image"></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  <?php echo form_error('category'); ?>
                    <label for="exampleInputFile" style="margin-left: 10px;">Upload Video</label>
                    <div class="input-group">
                      <div class="custom-file"  style="margin-left: 10px;">
                        <input type="file" id="file-4" class="file-6">
                        <input type="hidden" name="pro_vedio" id="pro_vedio">
                        <div id="uploaded_image"></div>
                      </div>
                    </div>
                  </div>
                <div class="box-footer">
                  <input type="submit" id="submit" name="submit" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<!-- <script src="<?= base_url().'assets/plugins/tree.js'?>"></script>
<script src="<?= base_url().'assets/admin/crop/jquery.min.js'?>"></script>  
<script src="<?= base_url().'assets/admin/crop/croppie.js'?>"></script> -->
<script src="<?= base_url().'assets/plugins/tree.js'?>"></script>
<script>
/*var i = 0;
$('.add_mo').click(function(){
  alert(i);
  $(this).hide();
  $(this).parent().next("div").removeClass('hide');
  $i++;
});*/ 

var countFromDatabase = 0;
function loadData($id){
  ajaxloader.load("<?php echo base_url('admin/package_uniqid_count').'?uniqid='?>"+ $id , function(resp){
      var data = resp;
      var str =JSON.parse(data);
      countFromDatabase = str.count[0].count;                       
  });
}

var iCountForRow = 1;
$('.add_mo').click(function(){
  if(iCountForRow == countFromDatabase) {
    $(this).hide();
    iCountForRow = 1;
  } else {
    $(this).hide();
    $(this).parent().next("div").removeClass('hide');
  }
  iCountForRow++;
}); 


$('#cat').on('change', function(){
    if(this.value != 0){
        
    }
});
function node(value){
    $('#catid').val(value);
}
function node(value){
		$('#catid').val(value);
}
function get_checked_value(){
         var valor = [];
          $('input.section[type=checkbox]').each(function () {
              if (this.checked)
                  valor.push($(this).val());
          });
          $.ajax({
            url: "<?= base_url('admin/get_product_category') ?>?section="+valor,
            cache: false,
            success: function(html){
              $("#results").append(html);
            }
          });
          return valor;
}
function get_hub_employee(id){
  //alert(id);
          $.ajax({
            url: "<?= base_url('admin/get_hub_employee') ?>?admin_id="+id,
            cache: false,
            success: function(html){
              $("#hubemp").empty();
              $("#hubemp").append(html);
            }
          });
          return valor;
}
$(function(){
      $('.section:checkbox').click(function(){
        //alert(get_checked_value());
      });
});
$(document).ready(function() {
  loadData(1);

	$('.file-1').change(function(){
		$('#file_name').html('');
		$('#file_name').html($('#file-1')[0].files[0].name);
		var file_data = $('#file-1').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('image', file_data);
		$.ajax({
			url: "<?= base_url() ?>Api/web_cropper_images?path=product",
			type: "POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				data = JSON.parse(data);
				$('#pro_image1').val(data.data);
			}
		});
	});

	$('.file-2').change(function(){
		$('#file_name').html('');
		$('#file_name').html($('#file-1')[0].files[0].name);
		var file_data = $('#file-1').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('image', file_data);
		$.ajax({
			url: "<?= base_url() ?>Api/web_cropper_images?path=product",
			type: "POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				data = JSON.parse(data);
				$('#pro_image2').val(data.data);
			}
		});
	});
	$('.file-3').change(function(){
		$('#file_name').html('');
		$('#file_name').html($('#file-1')[0].files[0].name);
		var file_data = $('#file-1').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('image', file_data);
		$.ajax({
			url: "<?= base_url() ?>Api/web_cropper_images?path=product",
			type: "POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				data = JSON.parse(data);
				$('#pro_image3').val(data.data);
			}
		});
	});
	$('.file-4').change(function(){
		$('#file_name').html('');
		$('#file_name').html($('#file-1')[0].files[0].name);
		var file_data = $('#file-1').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('image', file_data);
		$.ajax({
			url: "<?= base_url() ?>Api/web_cropper_images?path=product",
			type: "POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				data = JSON.parse(data);
				$('#pro_image4').val(data.data);
			}
		});
	});
	$('.file-5').change(function(){
		$('#file_name').html('');
		$('#file_name').html($('#file-1')[0].files[0].name);
		var file_data = $('#file-1').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('image', file_data);
		$.ajax({
			url: "<?= base_url() ?>Api/web_cropper_images?path=product",
			type: "POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				data = JSON.parse(data);
				$('#pro_image5').val(data.data);
			}
		});
	});
	$('.file-6').change(function(){
		$('#file_name').html('');
		$('#file_name').html($('#file-1')[0].files[0].name);
		var file_data = $('#file-1').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('image', file_data);
		$.ajax({
			url: "<?= base_url() ?>Api/web_cropper_images?path=product",
			type: "POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				data = JSON.parse(data);
				$('#pro_vedio').val(data.data);
			}
		});
	});
	/* $('#unit').on('change', function(){
    var unit = $(this).val();
    $('.pack1').addClass('hide');
    $('.'+unit+'').removeClass('hide');
    $('.'+unit+'').closest('.pack').removeClass('hide');
	});*/

  $('#unit').on('change', function(){
      console.log('aaaaa');
      console.log($(this).val());
      console.log(iCountForRow);
      console.log($("#unit option:selected" ).text());
      var unit = $(this).val();
      loadData(unit);
      iCountForRow = 1;
      if($("#unit option:selected" ).text() == 'Kilogram' && $(this).val() == '1') {
        $('.pack1').addClass('hide');
        //$('.packValues'+unit+'').removeClass('hide');
        $('.packValues0'+$(this).val()).removeClass('hide');
        $('.add_mo').show();
        //$('.packValues'+unit+'').closest('.pack').removeClass('hide');
      } else if($("#unit option:selected" ).text() == 'Liter' && $(this).val() == '3') {
        console.log('find values 11111');
        $('.pack1').addClass('hide');
        $('.packValues4'+$(this).val()).removeClass('hide');
        $('.add_mo').show();
      } else {
        $('.pack1').addClass('hide');
        $('.'+unit+'').removeClass('hide');
        $('.'+unit+'').closest('.pack').removeClass('hide');
      }
  });



	// $image_crop = $('#image_demo').croppie({
	// 	enableExif: true,
	// 	viewport: {
	// 	  width:200,
	// 	  height:200,
	// 	  type:'square' //circle
	// 	},
	// 	boundary:{
	// 	  width:300,
	// 	  height:300
	// 	}
	// });

	//   $('#upload_image').on('change', function(){
	// 	var reader = new FileReader();
	// 	reader.onload = function (event) {
	// 	  $image_crop.croppie('bind', {
	// 		url: event.target.result
	// 	  }).then(function(){
	// 		console.log('jQuery bind complete');
	// 	  });
	// 	}
	// 	reader.readAsDataURL(this.files[0]);
	// 	$('#uploadimageModal').modal('show');
	//   });
	//   $('.crop_image').click(function(event){
	// 	event.preventDefault()
	// 	$image_crop.croppie('result', {
	// 	  type: 'canvas',
	// 	  size: 'viewport'
	// 	}).then(function(response){
	// 	  $.ajax({
	// 		url:"<?= base_url().'admin/upload_crop/' ?>",
	// 		type: "POST",
	// 		data:{"image": response},
	// 		success:function(data)
	// 		{
	// 		  $('#uploadimageModal').modal('hide');
	// 		  $('#uploaded_image').html(data);
	// 		}
	// 	  });
	// 	})
	//   });
    
	var max_fields_limit4 = 10;
	var x4 = 1; 
	$('.add_more_composition').click(function(e){
		e.preventDefault();
    $(this).parent().next().removeClass('hide');
    $(this).addClass('hide');
    $(this).parent('div').removeClass('hide');
    // $(this).text('Remove');
    //$(this).hide();

		// if(x4 < max_fields_limit4){
		// 	x4++;
		// 	$('.composition_fields_container').append('<div style="margin-top: 5px;"><input type="text" name="composition_name[]" placeholder="Name ....."><input type="number" name="composition_value[]" placeholder="Value ....." style="margin-left: 10px;" /><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div>'); //add input field
		// }
	});  
  $('.remove_more').click(function(e){
    e.preventDefault();
    $(this).parent().prev().removeClass('hide');
    $(this).parent().addClass('hide');
    $(this).next().removeClass('hide');
    // $(this).parent('div').addClass('hide');
    // $(this).addClass('add_more_composition');
    // $(this).removeClass('remove_more');
    // $(this).text('Add More Fields');
  });
	$('.composition_fields_container').on("click",".remove_field", function(e){
		e.preventDefault(); $(this).parent('div').remove(); x4--;
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
	
});
</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor3')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>