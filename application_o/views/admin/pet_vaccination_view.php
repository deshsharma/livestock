<?php //print_r($id);
$packages = $this->admin_detail->allpackages($id);
//print_r($packages[0]['package_id']);
?>
<div class="content-wrapper">
    <div class="content">
        <div class="row">
<div id="page-wrapper" >
    <div id="page-inner">        
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <?php echo $packages[0]['package_name'];?>
                    </div>
                    <div class="panel-body">
						  <div class="table-responsive">
                                <table class="table table-hover">                                    
                                    <tbody>
                                        <tr>
										 <td><i class="fa fa-align-justify"></i></td>
                                            <th>Name: </th>
                                            <td>  <?php echo $packages[0]['package_name'];?></td>                               
                                        </tr>
										 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Type: </th>
                                            <td>  <?php echo $packages[0]['package_type'];?></td>                               
                                        </tr>
										 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Price: </th>
                                            <td>  <?php echo $packages[0]['package_price'];?></td>
                               
                                        </tr>
										 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Days: </th>
                                            <td>  <?php echo $packages[0]['package_days'];?></td>
                               
                                        </tr>
										<?php if($packages[0]->package_callnum != '') {?>
										 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Amount Left: </th>
                                            <td>  <?php echo $packages[0]['package_callnum'];?></td>
                               
                                        </tr>
										<?php } ?>
										 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Discount Percent: </th>
                                            <td>  <?php echo $packages[0]['package_discount_percent'];?></td>
                               
                                        </tr>
										<tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Discount Value: </th>
                                            <td>  <?php echo $packages[0]['package_discount_value'];?></td>
                               
                                        </tr>
										
										 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Effected value : </th>
                                            <td>  <?php echo $packages[0]['package_effected_price'];?></td>
                               
                                        </tr>
										 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package GST Percent: </th>
                                            <td>  <?php echo $packages[0]['gst_percent'];?></td>
                               
                                        </tr>
										 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Gst Value : </th>
                                            <td>  <?php echo $packages[0]['gst'];?></td>
                               
                                        </tr>
										
											 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Total Price After All Discount And GST : </th>
                                            <td>  <?php echo $packages[0]['total'];?></td>
                               
                                        </tr>
											 <tr>
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Package Description: </th>
                                            <td>  <?php echo $packages[0]['package_desc'];?></td>
                               
                                        </tr>
                                        <tr>
										
										 <td><i class="fa fa-angle-double-right"></i></td>
                                            <th>Status: </th>
                                            <td>  <?php 
											if($packages[0]['isactivated'] == 1)
											{
												echo "Activate";
											}
											
											else
											{
												echo "Deactivate";
											}
											?></td>
                               
                                        </tr>
                                       
										
										
										
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        
                    </div>
                </div>
				<div class="col-md-6 col-sm-6">
				<?php if($packages[0]['image'] != '')
				{ ?>
			 <img src="https://www.livestoc.com/uploads_new/packages/thumb/<?php echo $packages[0]['image'];?>" style="width: 350px;height: 300px;">
				<?php } else {?>
			 <img src="https://www.livestoc.com/uploads_new/packages/packages_demo.jpg">
			 <?php } ?>
                
                </div>
            </div>
    </div>
    </div>
    </div>
    </div>
