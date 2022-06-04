<div class="content-wrapper">
    <div class="content">
        <div class="row">
            
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  <a href="<?php echo base_url('admin/pet_vacc_add');?>"> <label> Add Vaccination</label></a>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Packages Type</th>
                                                    <th>Packages Name</th>
                                                    <th>Packages Days</th>
                                                    <th>Status</th>
                                                    <th>Images</th>
                                                    <th>Price after discount</th>
                                                    <th>Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                             $details = $this->admin_detail->allpackages();
                                            foreach ($details as  $value){ ?>
                                                <tr class="gradeA " id="row_<?=$value['primary']?>">
                                                <td class=" "><?= $value['package_id'] ?></td> 
                                                <td class=" "><?= $value['package_type'] ?></td>
                                                <td class=" "><?= $value['package_name'] ?></td> 
                                                <td class=" "><?= $value['package_days'] ?></td> 
                                                <td class=" "><?php 
                                                if($value['isactivated'] == '1'){
                                                    echo "Activate";
                                                }else{
                                                    echo "deactivate";
                                                }?>
                                                </td>
                                                <?php if($value['image']){?>
                                                    <td class=" "><img src="https://www.livestoc.com/uploads_new/packages/thumb/<?php echo $value['image'];?>" style="width: 150px;height: 100px;"></td> 
                                                <?php }else{?>
                                                    <td class=" "><img src="https://www.livestoc.com/uploads_new/packages/thumb/packages_demo.jpg" style="width: 150px;height: 100px;"></td> 
                                                <?php }?>
                                                <td class=" "><?= $value['total'] ?></td> 									
                                                <td class=" "><?php echo $date = date("d-M-y",strtotime($value['created_on']));?></td> 
                                                <td class=" "><a title ="View" href ="<?=base_url('admin/pet_vaccination_view/')?><?= $value['package_id'] ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a title ="View" href ="<?=base_url('admin/pet_vaccination_edit/')?><?= $value['package_id'] ?>"><i class="fa fa-edit"></i></a></td>
                                                </tr>
                                            <?}?> 
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      