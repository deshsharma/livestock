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

<div class="abc" ><h3>Edit Offer</h3></div>

<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/ecom_offer_edit/".$data[0]['id'], ['onsubmit'=>'return myFunction()']);?>
            
             <?php echo form_error('product'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Product</strong>
            </div>
            <div class="col-md-9">
                <select name="product" id="product" class='ch_manset padd_set'>
                    <option value="">Select Product</option>
                    <?php $product = $this->api_model->get_data('isactive = "1"','product'); ?>
                    <?php foreach($product as $d){ ?>
                        <option value="<?= $d['id'] ?>" <?php if($d['id'] == $data[0]['product_id']){ echo "selected"; } ?>><?= $d['name'].'('.$d['brand'].')' ?></option>
                    <?php } ?>
                </select>
            </div>
            <?php echo form_error('product_pack'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Select Product Pack</strong>
            </div>
            <div class="col-md-9">
                    <select name="product_pack" id="product_pack" class='ch_manset padd_set'>
                        <option value="0">Select Product Pack</option>
                        <?php $pack_name = $this->api_model->get_data('product_id = "'.$data[0]['product_id'].'"', 'product_pack_rate', '', 'id, product_id, pack_id, mrp, sale_price, vt_sale_price, (select name from product_package where id = pack_id) as pack_name'); 
                        //print_r($pack_name);
                        foreach($pack_name as $pack){
                            ?>
                            <option value="<?= $pack['id'] ?>" <?php if($pack['id'] == $data[0]['product_pack']){ echo "selected"; } ?>><?= $pack['pack_name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
            </div>
            <?php echo form_error('rate'); ?>
            <div class="col-md-3" > 
        	   <strong class="right_sre">Cash in Wallet</strong>
            </div>
            <div class="col-md-9">
                <?php echo form_input(['type'=>'number','name'=>'rate', 'value'=> $data[0]['discount_wallet'], 'id'=>'rate','class'=>'ch_manset padd_set']) ?>
        	</div>
            <div style="margin-left: 27%; margin-top:10px" >
                <?php 
                    echo form_submit(['name'=>'submit','value'=>'Edit', 'onkeyup'=>'check();', 'class'=>'btn btn-danger', 'style'=>'width:80px; margin-top: 16px;']);
                ?>
            </div>
            <div style="clear: left;"></div>
        </div>
        </form>
</div>
<script type="text/javascript">
 $('#product').change(function(){
     var id = $('#product').val();
        $.ajax({
            url: "<?= base_url()?>admin/get_product_pack?id="+id,
            cache: false,
            success: function(html){
                var result = JSON.parse(html);
                                        var data = "<option value=''>Select Product Pack</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.id+"'>"+item.pack_name+"</option>"
			                            }); 
                                        $('#product_pack').html(data);
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
                                        var data = "<option value=''>Select Tehshil</option>";
			                            $.each(result, function(index, item){
											data +="<option value='"+item.gvh_id+"'>"+item.gvh_name+"</option>"
			                            }); 
                                        $('#gvh').html(data);
            }
        });
    });
 </script>
