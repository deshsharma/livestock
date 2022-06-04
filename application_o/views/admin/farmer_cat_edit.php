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
<div class="abc" ><h3>EDIT PRODUCT NAME</h3></div>
<div class="abc_1" >
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <?php echo form_open("admin/farmer_cat_edit/".$cat[0]['id'], ['onsubmit'=>'return myFunction()']);?>
        <script src="https://www.livestoc.com/harpahu_merge_dev/assets/plugins/tree.js"></script>
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tree.css" />
            <link rel="stylesheet" href="<?= base_url().'assets/plugins/tree.css'?>" />
            <?php echo form_error('unit'); ?>
            <?php //print_r($cat); 
            $uni = explode(',',$cat[0]['unit']);
            ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Product Category Name</strong>
                </div>
                <div class="col-md-9">
                        <select name="unit[]" class="form-control" style="width: 100%; margin-bottom: 10px;" multiple data-select2-id="1" tabindex="-1" aria-hidden="true">
                          <?php foreach($unit as $s){ ?>
                              <option value="<?= $s['id'] ?>" <?php if(in_array($s['id'],$uni)){ echo "selected"; } ?>><?= $s['name']?></option>
                          <?php } ?>
                        </select>
        	    </div>
            <?php echo form_error('name'); ?>
            <div class="col-md-3" > 
                <strong class="right_sre">Product Category Name</strong>
                </div>
                <div class="col-md-9">
                    <?php echo form_input(['type'=>'text','name'=>'name', 'value'=>$cat[0]['cat_name'], 'id'=>'name','class'=>'ch_manset padd_set']) ?>
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
<?php 
// public function tree(){
//     echo "this is ";
// }
?> 
<script src="<?= base_url().'assets/plugins/tree.js'?>"></script>
<script>   				
$('#cat').on('change', function(){
    if(this.value != 0){
        
    }
});
function node(value){
    $('#catid').val(value);
    $('#'+value).toggleClass('Active');
}
// lazy demo
// $('#lazy').jstree({
// 		'core' : {
// 			'data' : {
// 				"url" : "//www.jstree.com/fiddle/?lazy",
// 				"data" : function (node) {
// 					return { "id" : node.id };
// 				}
// 			}
// 		}
// 	});

	// data from callback
	// $('#clbk').jstree({
	// 	'core' : {
	// 		'data' : function (node, cb) {
	// 			if(node.id === "#") {
	// 				cb([{"text" : "Root", "id" : "1", "children" : true}]);
	// 			}
	// 			else {
	// 				cb(["Child"]);
	// 			}
	// 		}
	// 	}
	// });
</script>