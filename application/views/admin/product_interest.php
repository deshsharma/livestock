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
		              <h3 class="box-title">PRODUCTS INTEREST</h3>
		              <!-- <a class="white" href="<?= base_url('admin/superv_add'); ?>"><div class="btn btn-info but_set">
		                 Add User
		              </div></a> -->
		              <div class="pull-right Search_set1"> 
						   <input type="text" class="glyphicon-search" placeholder="User Name" id="product_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
                           <input type="hidden" value="" id="count" >
		              </div>
	            </div>
		         <div class="box-body">
		         	<table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th>Product Name</th>
			                  <th>User Name</th>
			                  <th>Mobile</th>
			                  <th>User Type</th>
			                  <th>Active</th>
			                  <th>Verified</th>
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
 	ajaxloader.load("<?php echo base_url('admin/animal_status').'?id=' ?>"+id+"&status="+status, function(resp){
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
					if(item.isactive != '1'){
                        status += 'Active';
                    }else{
                        status += 'Deactive';
                    }
                    										 
                	//status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
                	 tr += "<tr>\
                            	<td>"+item.name+"</td>\
                                <td>"+item.full_name+"</td>\
                                <td>"+item.user_type+"</td>\
                                <td>"+status+"</td>\
                                <td>"+item.is_verified+"</td>\
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
                                   <td>"+item.name+"</td>\
                                   <td>"+item.full_name+"</td>\
                                   <td>"+item.user_type+"</td>\
                                   <td>"+status+"</td>\
                                   <td>"+item.is_verified+"</td>\
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
			ajaxloader.load("<?php echo base_url('admin/product_interest_search').'?name=' ?>"+$('#product_name').val()+"&start="+start+"&perpage="+per_page, function(resp){
                  	var data = resp;
                  	var str =JSON.parse(data);
                  	var tr = '';
                 	if(str['error']=='1' || str['count'] == null){ 
                 		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
                   	}
                  	else{
                  		var result = str;
                        $('#count').val(result.count);
                        delete result.count ;
                        $.each(result, function(index, item){
                        	var status = '';
                        	var is_verified = '';
                        	var user_type  = '';
                            if(item.isactive != '1'){
                                status += "Active";
                            } else {
                                status += "Deactive";
                            }
                            if(item.is_verified == '1'){
                                is_verified += "Verified";
                            } else {
                                is_verified += "Not Verified";
                            }
                            if(item.user_type == '1'){
                            	user_type = 'Farmer';
                            } else if (item.user_type == '2') {
                            	user_type = 'Seller';
                            }
                            else if (item.user_type == '3') {
                            	user_type = 'VT';
                            }
                            else if (item.user_type == '4') {
                            	user_type = 'Breeder';
                            }
                            else if (item.user_type == '5') {
                            	user_type = 'Dealer';
                            }	 
                            else if (item.user_type == '6') {
                            	user_type = 'Distributer';
                            } else {
								user_type = 'Not Varified';
                            }
                        	 tr += "<tr>\
                               <td>"+item.name+"</td>\
                               <td>"+item.full_name+"</td>\
                               <td>"+ item. mobile_code + item.mobile+"</td>\
                               <td>"+user_type+"</td>\
                               <td>"+status+"</td>\
                               <td>"+is_verified+"</td>\
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