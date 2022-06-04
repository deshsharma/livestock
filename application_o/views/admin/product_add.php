<style type="text/css">
         .error {
            margin: 27%;
            width: auto;
            color:red;
            display: inline;
            font-weight: 100;
        }  
</style>

<script src="https://www.livestoc.com/harpahu_merge_dev/assets/plugins/tree.js"></script>
<div class="content-wrapper" >

<div class="abc" ><h3>ADD PRODUCT</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open_multipart("admin/product_add/", ['onsubmit'=>'return myFunction()', 'method'=>'post']);?>
        <?php echo form_error('section'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Product Section</strong>
            </div>
            <div class="col-md-9">
                <select name="section" id="section" class='ch_manset padd_set'>
                    <option value="">Select Product Section</option>
                    <?php foreach($brand as $d){ ?>
                        <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('category'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Product Category</strong>
            </div>
            <div class="col-md-9">
                <select name="category" id="category" class='ch_manset padd_set'>
                    <option value="">Select Product Category</option>
                    <?php foreach($category as $ca){ ?>
                        <option value="<?= $ca['id'] ?>"><?= $ca['name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('unit'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Product Unit</strong>
            </div>
            <div class="col-md-9">
                <select name="unit" id="unit" class='ch_manset padd_set'>
                    <option value="">Select Product Unit</option>
                    <?php foreach($unit as $u){ ?>
                        <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('brand'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product Brand</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'brand', 'value'=>'', 'id'=>'brand','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product Name</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>'', 'id'=>'name','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('hight'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product Height</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'hight', 'value'=>'', 'id'=>'hight','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('width'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product Width</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'width', 'value'=>'', 'id'=>'width','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('weight'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product weight in Kg</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'weight', 'value'=>'', 'id'=>'weight','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('mrp'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product MRP</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'mrp', 'value'=>'', 'id'=>'mrp','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('discount'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product Discount</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'discount', 'value'=>'', 'id'=>'discount','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('sku'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product SKU No</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'sku', 'value'=>'', 'id'=>'sku','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('color'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Product Colour</strong>
            </div>  
            <div class="col-md-9">
                <select name="color" id="color" class='ch_manset padd_set'>
                    <option value="">Select Product Colour</option>
                    <?php foreach($color as $co){ ?>
                        <option value="<?= $co['id'] ?>"><?= $co['name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('hub'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select HUB</strong>
            </div>  
            <div class="col-md-9">
                <select name="hub" id="hub" class='ch_manset padd_set'>
                    <option value="">Select Hub</option>
                    <?php foreach($product_hub as $hub){ ?>
                        <option value="<?= $hub['hub'] ?>"><?= $co['fname'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('color'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Product Colour</strong>
            </div>  
            <div class="col-md-9">
                <select name="color" id="color" class='ch_manset padd_set'>
                    <option value="">Select Product Colour</option>
                    <?php foreach($color as $co){ ?>
                        <option value="<?= $co['id'] ?>"><?= $co['name'] ?></option>
                    <?php } ?>
                </select>
        	</div>
            <?php echo form_error('color'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Product Images</strong>
            </div>  
            <div class="col-md-9">
            <input type="file" name="register[]" class="btn2 text-center ch_manset padd_set" multiple >
        	</div>
            <?php echo form_error('price'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product Base Price</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'text','name'=>'price', 'value'=>'', 'id'=>'price','class'=>'ch_manset padd_set']) ?>
        	</div>
            <?php echo form_error('shor_desc'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product Short Discription</strong>
            </div>
            <div class="col-md-9">
                <textarea name="shor_desc" id="editor1"></textarea>
        	</div>
            <?php echo form_error('long_desc'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Product Long Discription</strong>
            </div>
            <div class="col-md-9">
                <textarea name="long_desc" class="" id="editor2"></textarea>
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
<script type="text/javascript">
 $('#colour').change(function(){
     if($('#color').val() == ''){
        $('#color').val($(this).val());
     }else{
        $('#color').val( $('#color').val()+','+$(this).val());
     }
     
 })
 $('#dist').change(function(){
     var id = $('#dist').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_tehshil?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select Tehshil</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.tehsil_code+"'>"+item.tehshil_name+"</option>"
			                            }); 
                                        $('#tehshil').html(data);
            }
        });
        $.ajax({
            url: "<?= base_url()?>admin/get_village?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select Village</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.vill_id+"'>"+item.vill_name+"</option>"
			                            }); 
                                        $('#village').html(data);
            }
        });
    });
    $('#tehshil').change(function(){
     var id = $('#tehshil').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_gvh?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select GVH</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.gvh_id+"'>"+item.gvh_name+"</option>"
			                            }); 
                                        $('#gvh').html(data);
            }
        });
    });
    $('#gvh').change(function(){
     var id = $('#gvh').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_gvd?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select GVD</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.gvd_id+"'>"+item.gvd_name+"</option>"
			                            }); 
                                        $('#gvd').html(data);
            }
        });
    });
    $(document).ready(function(){
        $('.select2-selection__choice').attr('style', 'color:black;');
    });
 </script>