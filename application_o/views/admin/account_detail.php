<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php'); 
?>
<div class="content-wrapper">
	<div class="content">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	          	<div class="box-header with-border">
		              <h3 class="box-title">ACCOUNT SUMMARY</h3>
		              <!-- <a class="white" href="<?= base_url('admin/superv_add'); ?>"><div class="btn btn-info but_set">
		                 Add User
		              </div></a> -->
		              <div class="pull-right Search_set1"> 
						   <!-- <input type="text" class="glyphicon-search" placeholder="User Name" id="product_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span>  -->
                           <input type="hidden" value="" id="count" >
                           <input type="hidden" value="" id='users_id'>
		              </div>
	            </div>
		         <div class="box-body">
                 <?php //print_r($data); ?>
		         	<table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th>Log Id</th>
                              <th>Payment Purpose</th>
			                  <th>Type</th>
                              <th>Amount</th>
			                  <th></th>
			                </tr>
		                </thead>
		                <tbody>
		                	
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
<script type="text/javascript">
 var num_display_entries,items_per_page,num_entries,start;
 function status(id , status){
    if (confirm('Are you sure you want to change the status')) {
 	ajaxloader.load("<?php echo base_url('admin/user_status').'?id=' ?>"+id+"&status="+status, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str['error']=='1'){ 
			                     		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
                                        var result = str;
			                            $.each(result, function(index, item){
											var status = '';
											if(item.isactivated != '1'){
                                                status += "<button type='button' onclick='status("+item.users_id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
                                            }else{
                                                status += "<button type='button' onclick='status("+item.users_id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
                                            }
                                            										 
			                            	//status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
			                            	 tr += "<tr>\
			                                               <td>"+item.full_name+"</td>\
			                                               <td>"+item.mobile+"</td>\
			                                               <td>"+status+"</td>\
			                                               </tr>";
			                            }); 
			                       	}
			                    $('#tabdata tbody').empty();  
                       		 $('#tabdata tbody').html(tr);                    	
		            });
	}
 }
 function del(id)
 {
 	if (confirm('Are you sure you want to Delete')) {
 	ajaxloader.load("<?php echo base_url('admin/superv_del').'?id=' ?>"+id, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str['error']=='1'){ 
			                     		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
                                          var result = str;
                                        $('#count').val(result.count[0].count);
                                        delete result.count ;
			                            $.each(result, function(index, item){
											var status = '';
											if(item.id != 1){
			                            	status = "<button type='button' onclick='destal("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											}										 
			                            	status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
			                            	 tr += "<tr>\
			                                               <td>"+item.id+"</td>\
			                                               <td>"+item.payment_type+"</td>\
                                                           <td>"+item.amount+"</td>\
			                                               <td>"+status+"</td>\
			                                               </tr>";
			                            }); 
			                       	}
			                    $('#tabdata tbody').empty();  
                       		 $('#tabdata tbody').html(tr);                    	
		            });
	}
 }
 $(document).ready(function() {
        $('#product_name').keypress(function (e) {
            if (e.which == 13) {
                filterData();
                return false;    
              }
        });

        items_per_page = $('#items_per_page').val();
        num_display_entries = $('#num_display_entries').val();
        items_per_page = $('#items_per_page').val();
        loadData(0,items_per_page,'ready');
 });

    function pageselectCallback(page_index, jq, event_type){
        start = page_index*items_per_page
        if(typeof event_type == 'undefined')
             loadData(start,items_per_page,event_type)
        return false;
     }
     function initPagination() {
        try{
                num_entries = $('#count').val();
              $("#Pagination").pagination(num_entries, {
                num_display_entries: num_display_entries,
                items_per_page:items_per_page,
                callback: pageselectCallback
              });
           }
           catch(ex){}
     }  

      function loadData(start,per_page,event_type){
      					ajaxloader.load("<?php echo base_url('admin/get_account_detail/')?><?= $data['users_id'] ?>/<?= $data['type'] ?>/"+start+"/"+per_page, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str['error']=='1'){ 
			                     		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
                                        var result = str;
                                        $('#count').val(result.count[0].count);
                                        delete result.count ;
			                            $.each(result, function(index, item){
			                            	var status = '';
											// if(item.id != 1){
			                            	// status = "<button type='button' onclick='del("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											// }
                                            // if(item.isactivated != '1'){
                                                // status += "<button type='button' onclick='status("+item.users_id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
												//status += "<a href='<?= base_url('admin/get_account_info/')?>"+item.users_id+"/1'><button type='button' class='btn btn-primary btn-flat'>Account</button></a>";
                                            // }else{
                                                // status += "<button type='button' onclick='status("+item.users_id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
												//status += "<a href='<?= base_url('admin/get_account_info/')?>"+item.users_id+"/1'><button type='button' class='btn btn-primary btn-flat'>Account</button></a>";
                                            // }									 
			                            	status += "<a href='<?= base_url('') ?>admin/get_summary_detail/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Detail</button></a>";
			                            	 var type = item.type;
                                             if(item.type == '5'){
                                                type = 'Breeding Record Charges';
                                                }else if(item.type == '6'){
                                                    type = 'Artificial Insemination';
                                                }else if(item.type == '11'){
                                                    type = 'Advance Semen Booking';
                                                }else if(item.type == '12'){
                                                    type = 'Animal Premium';
                                                }else if(item.type == '13'){
                                                    type = 'Semen Stock Payment';
                                                }else if(item.type == '14'){
                                                    type = 'Shopping Cart';
                                                }else if(item.type == '15'){
                                                    type = 'Registered as Dealer';
                                                }else if(item.type == '16'){
                                                    type = 'Registered as Breeder';
                                                }else if(item.type == '17'){
                                                    type = 'Dog Mating Registration';
                                                }else if(item.type == '18'){
                                                    type = 'Bull Registration to Sell Semen';
                                                }else if(item.type == '19'){
                                                    type = 'Upgraded to Premium Member';
                                                }else if(item.type == '23'){
                                                    type = 'Livestoc lab+cattle pregnancy test in 28 days with American Technology.';
                                                }else if(item.type == '24'){
                                                    type = 'Pregnancy Detection Sample';
                                                }
                                             if(item.type == '15'){
                                                 type = 'Registered as Dealer';
                                             }
                                             if(item.type == '16'){
                                                 type = 'Registered as Breeder';
                                             }
                                             if(item.type == '17'){
                                                 type = 'Upgrade to Breader';
                                             }if(item.type == '18'){
                                                 type = 'Dog Mating Registration';
                                             }if(item.type == '20'){
                                                 type = 'Upgraded to Premium Member';
                                             }
                                             tr += "<tr>\
                                                           <td>"+item.id+"</td>\
                                                           <td>"+type+"</td>\
			                                               <td>"+item.payment_type+"</td>\
                                                           <td>"+item.amount+"</td>\
			                                               <td>"+status+"</td>\
			                                               </tr>";
			                            });
			                       	}
                       		 $('#tabdata tbody').html(tr);                    	
		                  if(!result){
		                     $('#Pagination').hide();
		                  }
		                  else
		                  {
		                    $('#Pagination').show();
		                  }
		                  if(event_type == 'ready')
		                     initPagination();
		            });
       };
     filterData = function (){
           loadData(0,$('#items_per_page').val(),'ready');
       }
  </script>
<?php include_once('layouts/admin_footer.php'); ?>