<div class="content-wrapper">
	<div class="content">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	          	<div class="box-header with-border">
		              <h3 class="box-title">ORDERS MANAGEMENT</h3>
		              <div class="pull-right Search_set1 col-md-6"> 
						   <input type="text" class="glyphicon-search" placeholder="Product Name" id="product_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
							 <input type="hidden" value="" id="count" >
		              </div>
					  <div class="col-md-12">
		              <div class="col-md-6 pull-left Search_set1"><a >Tatal</a>:<a class="total"></a>Rs</div>
					  <div class="col-md-6 pull-right Search_set1">
					  <input type="" name="transaction_id" id="transaction_id" value="" placeholder="Transaction ID">
					  <button id="pay" class="btn btn-primary">Pay</button>
					  </div>
					  </div>
	            </div>
		         <div class="box-body">
		         	<table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
							  <th><input type="checkbox" name="check_all" id="check_all" >Check All</th>
			                  <th>ID</th>
                              <th>Coustomer Name</th>
			                  <th>Coustomer Mobile</th>
			                  <th>Product Name</th>
			                  <th>Package</th>			                  
			                  <th>Qty</th>
							  <th>Kilomiter</th>
							  <th>Amount</th>
			                  <th>Status</th>
							  <th>Payment Status</th>
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
 var str = '';
 var num_display_entries,items_per_page,num_entries,start;
 $('#pay').click(function(){
	selected = new Array();
	$("input:checkbox:checked").each(function(){
		if(!isNaN($(this).val())){
			selected.push($(this).val());
		}
	});
	//alert(selected);
	ajaxloader.load("<?php echo base_url('admin/order_pay').'?id=' ?>"+selected+"&delivery_id=<?= $id ?>&transaction_id="+$('#transaction_id').val(), function(resp){
		if(resp == true){
			alert('Transaction Complited');
		}
	})
	items_per_page = $('#items_per_page').val();
    num_display_entries = $('#num_display_entries').val();
    items_per_page = $('#items_per_page').val();
    loadData(0,items_per_page,'ready');
	$("#check_all").prop("checked", false);
 })
function check(some){
	if($("#check_all").prop("checked")){
		$("#check_all").prop("checked", false);
		var checkboxes = document.getElementsByTagName('input'), val = null;  
		for (var i = 0; i < checkboxes.length; i++)
		{
			if (checkboxes[i].type == 'checkbox')
			{
				if (val === null) val = checkboxes[i].checked;
				checkboxes[i].checked = val;
			}
		}
		$('#check_all_id').val('');
	}
}
$('#check_all').on('change',function(){
     var checkboxes = document.getElementsByTagName('input'), val = null;  
     for (var i = 0; i < checkboxes.length; i++)
     {
         if (checkboxes[i].type == 'checkbox')
         {
             if (val === null) val = checkboxes[i].checked;
             checkboxes[i].checked = val;
         }
     }
})
 
 function status(id , status){
	if (confirm('Are you sure you want to change the status')) {
		var person = '';
			// if(status == '2'){
			// 	person = prompt("Please Enter Rejection Region", "Enter Hear");
			// 	if(person == ''){
			// 		exit;
			// 	}
			// }
			var per_page = $('#items_per_page').val();
 			ajaxloader.load("<?php echo base_url('admin/order_status').'?id=' ?>"+id+"&status="+status+"&start="+start+"&perpage="+per_page+"&region="+person+"&delivery_id=<?= $id ?>", function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str.count[0].count=='0'){ 
			                     		tr += "<tr><td colspan='8' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
																var result = str;
																$('#count').val(result.count[0].count);
																$('.total').text(result.count[0].total);
                                delete result.count ;
			                            $.each(result, function(index, item){
			                            	var status = '';
											// if(item.id != 1){
			                            	// status = "<button type='button' onclick='del("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											// }
                                            // if(item.is_active != '1'){
                                            //     status += "<button type='button' onclick='status("+item.id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
																								//status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
																						// }else{
                      //                           status += "<button type='button' onclick='status("+item.id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
																								//status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
                                            //}
                                            										 
			                            	//status += "<a href='order_view/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>View</button></a>";
											var payment_state = '';
											if(item.delivery_partner_payment_status == '0'){
												payment_state = 'Non Paid';
											}else{
												payment_state = 'Paid';
											}
			                            	if(item.isactive == '0'){
			                            		status = 'Not Accepted';
			                            	}else if(item.isactive == '1'){
			                            		status = 'Pending';
			                            	}else if(item.isactive == '2'){
			                            		status = "Packed";
			                            	}else if(item.isactive == '3'){
			                            		status = "Intransite";
			                            	}else if(item.isactive == '4'){
			                            		status = "Cancelled";
			                            	}else if(item.isactive == '5'){
			                            		status = "Delivered";
			                            	}else if(item.isactive == '6'){
			                            		status = "Reached";
			                            	}else if(item.isactive == '7'){
			                            		status = "Coustomer Not Available";
			                            	}
			                            	var status1 ="<select onchange='status("+item.id+",this.value)'>\
			                            	<option value='0' >Status</option>\
			                            	<option value='1' >Pending</option>\
			                            	<option value='2' >Packed</option>\
			                            	<option value='3' >Intransite</option>\
			                            	<option value='4' >Cancelled</option>\
			                            	</select><a href='<?= base_url() ?>admin/order_view/"+item.id+"' class='btn btn-primary'>View</a>" 
			                            	 tr += "<tr>\
											 				<td><input type='checkbox' value='"+item.id+"' onclick='check(this)'></td>\
                                                           <td>"+item.id+"</td>\
                                                           <td>"+item.user_name+"</td>\
                                                           <td>"+item.user_mobile+"</td>\
                                                           <td>"+item.name+"</td>\
                                                           <td>"+item.package_name+"</td>\
                                                           <td>"+item.product_qty+"</td>\
														   <td>"+item.distance_covered+"</td>\
														   <td>"+item.total+"</td>\
                                                           <td>"+status+"</td>\
														   <td>"+payment_state+"</td>\
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
      					ajaxloader.load("<?php echo base_url('admin/delivery_partner_order_search').'?name=' ?>"+$('#product_name').val()+"&start="+start+"&perpage="+per_page+"&delivery_id=<?= $id ?>", function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str.count[0].count=='0'){ 
			                     		tr += "<tr><td colspan='8' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
																var result = str;
																$('#count').val(result.count[0].count);
																$('.total').text(result.count[0].total);
                                delete result.count ;
			                            $.each(result, function(index, item){
			                            	var status = '';
											// if(item.id != 1){
			                            	// status = "<button type='button' onclick='del("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											// }
                                            // if(item.is_active != '1'){
                                            //     status += "<button type='button' onclick='status("+item.id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
																								//status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
																						// }else{
                      //                           status += "<button type='button' onclick='status("+item.id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
																								//status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
                                            //}
                                            										 
			                            	//status += "<a href='order_view/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>View</button></a>";
											var payment_state = '';
											if(item.delivery_partner_payment_status == '0'){
												payment_state = 'Non Paid';
											}else{
												payment_state = 'Paid';
											}
			                            	if(item.isactive == '0'){
			                            		status = 'Not Accepted';
			                            	}else if(item.isactive == '1'){
			                            		status = 'Pending';
			                            	}else if(item.isactive == '2'){
			                            		status = "Packed";
			                            	}else if(item.isactive == '3'){
			                            		status = "Intransite";
			                            	}else if(item.isactive == '4'){
			                            		status = "Cancelled";
			                            	}else if(item.isactive == '5'){
			                            		status = "Delivered";
			                            	}else if(item.isactive == '6'){
			                            		status = "Reached";
			                            	}else if(item.isactive == '7'){
			                            		status = "Coustomer Not Available";
			                            	}
			                            	var status1 ="<select onchange='status("+item.id+",this.value)'>\
			                            	<option value='0' >Status</option>\
			                            	<option value='1' >Pending</option>\
			                            	<option value='2' >Packed</option>\
			                            	<option value='3' >Intransite</option>\
			                            	<option value='4' >Cancelled</option>\
			                            	</select><a href='<?= base_url() ?>admin/order_view/"+item.id+"' class='btn btn-primary'>View</a>" 
			                            	 tr += "<tr>\
											 			   <td><input type='checkbox' onclick='check(this)' value='"+item.id+"'></td>\
                                                           <td>"+item.id+"</td>\
                                                           <td>"+item.user_name+"</td>\
                                                           <td>"+item.user_mobile+"</td>\
                                                           <td>"+item.name+"</td>\
                                                           <td>"+item.package_name+"</td>\
                                                           <td>"+item.product_qty+"</td>\
														   <td>"+item.distance_covered+"</td>\
														   <td>"+item.total+"</td>\
                                                           <td>"+status+"</td>\
														   <td>"+payment_state+"</td>\
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