<?php

// session_start();

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
$dist_id = $this->session->userdata('district_id');
//print_r($dist_id);
?>
<div class="content-wrapper">
	<div class="content">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	          	<div class="box-header with-border">
		              <h3 class="box-title">EMPLOYEE MANAGEMENT</h3>
		              <a class="white" href="<?= base_url('employee/add'); ?>"><div class="btn btn-info but_set">
		                 Add Employee
		              </div></a>
		              <div class="pull-right Search_set1"> 
						   <input type="text" class="glyphicon-search" placeholder="User Name" id="product_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
							 <input type="hidden" value="" id="count" >
							 <input type="hidden" value="<?= $dist_id?>" name="distict_id" id="dist_id">
		              </div>
	            </div>
		         <div class="box-body">
		         	<table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th>Employee Name</th>
							  <th> Image </th>
                              <th>Employee Mobile</th>
                              <th>Referral No</th>
							  <th>Employee Type</th>
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
		var person = '';
			if(status == '2'){
				//person = prompt("Please Enter Rejection Region", "Enter Hear");
				if(person == ''){
					exit;
				}
			}
			var per_page = $('#items_per_page').val();
 	ajaxloader.load("<?php echo base_url('employee/employee_status').'?id=' ?>"+id+"&status="+status+"&start="+start+"&perpage="+per_page+"&region="+person+"&name="+$('#product_name').val(), function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str.count[0].count=='0'){ 
			                     		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
									var result = str;
									$('#count').val(result.count[0].count);
                                  delete result.count ;
                                    $.each(result, function(index, item){
										var status = '';
											var type = '';
                                            if(item.isactivated != '1'){
                                                status += "<button type='button' onclick='status("+item.admin_id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
											}else{
                                                status += "<button type='button' onclick='status("+item.admin_id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
                                            }
											if(item.type == '37'){
												type = 'Manager';
											}
											if(item.type == '38'){
												type = 'Exicutive';
											}
			                            	status += "<a href='<?= base_url() ?>employee/edit/"+item.admin_id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
											status += "<a href='<?= base_url('employee/user/')?>"+item.admin_id+"'><button type='button' class='btn btn-primary btn-flat'>User List</button></a>";
											status += "<a href='<?= base_url('employee/vt/')?>"+item.admin_id+"'><button type='button' class='btn btn-danger btn-flat'>VT List</button></a>";
			                            	 tr += "<tr>\
                                                           <td>"+item.fname+"</td>\
														   <td>"+item.emp_image+"</td>\
                                                           <td>"+item.mobile+"</td>\
                                                           <td>"+item.referral_code+"</td>\
														   <td>"+type+"</td>\
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
			                            $.each(result, function(index, item){
											var status = '';
											if(item.id != 1){
			                            	status = "<button type='button' onclick='destal("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											}										 
			                            	status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
			                            	 tr += "<tr>\
                                                           <td>"+item.gvh_name+"</td>\
                                                           <td>"+item.quantity+"</td>\
                                                           <td>"+item.quantity_fare+"</td>\
                                                           <td>"+item.rate+"</td>\
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
      					ajaxloader.load("<?php echo base_url('employee/employee_search').'?name=' ?>"+$('#product_name').val()+"&dist_id="+$('#dist_id').val()+"&start="+start+"&perpage="+per_page, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str.count[0].count=='0'){ 
			                     		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
									var result = str;
									$('#count').val(result.count[0].count);
                                	delete result.count ;
			                            $.each(result, function(index, item){
			                            	var status = '';
											var type = '';
                                            if(item.isactivated != '1'){
                                                status += "<button type='button' onclick='status("+item.admin_id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
											}else{
                                                status += "<button type='button' onclick='status("+item.admin_id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
                                            }
											if(item.type == '37'){
												type = 'Manager';
											}
											if(item.type == '38'){
												type = 'Exicutive';
											}
			                            	status += "<a href='<?= base_url() ?>employee/edit/"+item.admin_id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
											status += "<a href='<?= base_url('employee/user/')?>"+item.admin_id+"'><button type='button' class='btn btn-primary btn-flat'>User List</button></a>";
											status += "<a href='<?= base_url('employee/vt/')?>"+item.admin_id+"'><button type='button' class='btn btn-danger btn-flat'>VT List</button></a>";
			                            	 tr += "<tr>\
                                                           <td>"+item.fname+"</td>\
														   <td><img style='height: 50px;width: 50px;' src="+item.emp_image+"></td>\
                                                           <td>"+item.mobile+"</td>\
                                                           <td>"+item.referral_code+"</td>\
														   <td>"+type+"</td>\
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