<div class="content-wrapper">
	<div class="content">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	          	<div class="box-header with-border">
		              <h3 class="box-title">MANAGE LANGUAGE LIBRARY</h3>
		              <a class="white" href="<?= base_url('admin/language_library_add'); ?>"><div class="btn btn-info but_set">
		                 Add Language Library
		              </div></a>
		              <div class="pull-right Search_set1"> 
						   <input type="text" class="glyphicon-search" placeholder="Language Library Id" id="product_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
                           <input type="hidden" value="" id="count" >
		              </div>
	            </div>
		         <div class="box-body">
		         	<table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
                              <th>ID</th>
			                  <th>Language Id</th>
			                  <th>Language Name</th>
			                  <th>Key</th>
			                  <th>Description</th>
			                  <th>Created Date</th>
			                  <th>Action</th>
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
 			ajaxloader.load("<?php echo base_url('admin/language_status').'?id=' ?>"+id+"&status="+status, function(resp){
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
	                if(item.is_activate != '1'){
	                    //status += "Active";
	                    status += "<button type='button' onclick='status("+item.id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
	                }else{
	                    //status += "Deactive";
	                    status += "<button type='button' onclick='status("+item.id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
	                }										 
	            	//status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
	            	 tr += "<tr>\
                       <td>"+item.id+"</td>\
                       <td>"+item.name+"</td>\
                       <td>"+item.description+"</td>\
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
 		ajaxloader.load("<?php echo base_url('admin/language_library_del').'?id=' ?>"+id, function(resp){
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
					var status  = "<button type='button' onclick='del("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
					var status = status+"<a href='language_library_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
	            	 tr += "<tr>\
	                   <td>"+item.id+"</td>\
	                   <td>"+item.language_id+"</td>\
	                   <td>"+item.language_name+"</td>\
	                   <td>"+item.key+"</td>\
	                   <td>"+item.description+"</td>\
	                   <td>"+item.created_on+"</td>\
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
	ajaxloader.load("<?php echo base_url('admin/language_library_search').'?name=' ?>"+$('#product_name').val()+"&start="+start+"&perpage="+per_page, function(resp){
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
            	//var status = '';
            	var status  = "<button type='button' onclick='del("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
				var status = status+"<a href='language_library_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
                /*if(item.is_activate != '1'){
                    //status += "Active";
                    status += "<button type='button' onclick='status("+item.id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
                }else{
                    //status += "Deactive";
                    status += "<button type='button' onclick='status("+item.id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
                }*/
                										 
            	//status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
            	 tr += "<tr>\
                   <td>"+item.id+"</td>\
                   <td>"+item.language_id+"</td>\
                   <td>"+item.language_name+"</td>\
                   <td>"+item.key+"</td>\
                   <td>"+item.description+"</td>\
                   <td>"+item.created_on+"</td>\
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