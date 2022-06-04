
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

<div class="abc" ><h3>ADD VEHICLE TYPE</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/v_type_add/", ['onsubmit'=>'return myFunction()']);?>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Type Name</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('pro_image'); ?>
            <div class="col-md-3" > 
                    <!-- <label for="exampleInputFile">Upload Images</label> -->
                    <strong class="right_sre">Upload Images</strong>
            </div>
            <div class=" col-md-9">
                        <input type="file" id="file-1" class="file-1">
                        <input type="hidden" name="pro_image" id="pro_image1">
                        <div id="uploaded_image"></div>
            </div>
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Add', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
<script>
$(document).ready(function() {
	$('.file-1').change(function(){
		$('#file_name').html('');
		$('#file_name').html($('#file-1')[0].files[0].name);
		var file_data = $('#file-1').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('image', file_data);
		$.ajax({
			url: "https://www.amazebrandlance.com/file_upload/upload_Images?path=mastitis",
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
});
</script>
