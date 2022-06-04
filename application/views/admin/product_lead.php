<div class="content-wrapper">
	<div class="content">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	          	<div class="box-header with-border">
		              <h3 class="box-title">LEAD MANAGEMENT</h3>
		              <!-- <a class="white" href="<?= base_url('admin/package_add'); ?>"><div class="btn btn-info but_set">
		                 Add Package
		              </div></a> -->
		              <!-- <div class="pull-right Search_set1"> 
						   <input type="text" class="glyphicon-search" placeholder="User Name" id="product_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
							 <input type="hidden" value="" id="count" >
		              </div> -->
	            </div>
                <?php //print_r($data); ?>
		         <div class="box-body">
		         	<table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th>Product Name</th>
                              <th>Coustomer Name</th>
                              <th>Coustomer Mobile</th>
			                  <th></th>
			                </tr>
		                </thead>
		                <tbody>
		                	<?php
		                	if(empty($data)){
		                		echo "<tr>
                                    <td colspan='4'>No Interest Found</td>
                                </tr>";
		                	}else{ 
		                	foreach($data as $da){ 
                                $product = $this->admin_detail->get_data('product', 'id = '.$da['product_id'].'');
                                if($da['user_type'] == '1'){
                                    $user = $this->admin_detail->get_data('users', 'users_id= "'.$da['users_id'].'"');
                                    $user_name = $user[0]['full_name'];
                                    $user_mobile = $user[0]['mobile'];
                                }else{
                                    $user = $this->admin_detail->get_data('doctor', 'doctor_id = "'.$da['users_id'].'"');
                                    $user_name = $user[0]['username'];
                                    $user_mobile = $user[0]['mobile'];
                                }
                                //
                                ?>
                                <tr>
                                    <td><?= $product[0]['name'];  ?></td>
                                    <td><?= $user_name  ?></td>
                                    <td><?= $user_mobile ?></td>
                                    <td></td>
                                </tr>
                            <?php }}?>
		                </tbody>		                
		            </table>
		            <div class="col-md-12" aling="center">
									<div id="Pagination" style="text-align: center;"></div> 
									<input type="hidden" value="<?= ITEMS_PER_PAGE ?>" name="items_per_page" id="items_per_page">
									<input type="hidden" value="<?= NUM_DISPLAY_ENTRIES ?>" name="num_display_entries" id="num_display_entries">
									<input type="hidden" value="Prev" name="prev_text" id="prev_text">
									<input type="hidden" value="Next" name="next_text" id="next_text">
				    </div>
		         </div>
		      </div><!--end of box-->
		    </div><!--end of col-->
		</div><!--End of row-->
	</div><!--End of Content-->
</div><!-- /.content -->