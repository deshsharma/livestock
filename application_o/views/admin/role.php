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
				  <?php //print_r($_SESSION); ?>
		              <h3 class="box-title">ROLE MANAGEMENT</h3>
		              <a class="white" href="role_add"><div class="btn btn-info but_set">
		                 Add Role
		              </div></a>
		              <div class="pull-right Search_set1"> 
						   <input type="text" class="glyphicon-search" placeholder="Role Name" id="modele_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
		              </div>
	            </div>
		         <div class="box-body">
		         	<table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th class='col-md-1 col-xs-1'>ID</th>
			                  <th class='col-md-2 col-xs-2'>Name</th>
			                  <th class='col-md-6 col-xs-6'>Model detail</th>
			                  <th class='col-md-3 col-xs-3'></th>
			                </tr>
		                </thead>
		                <tbody>
		          
		                </tbody>		                
		            </table>
		            <div class="col-md-12" aling="center">
				         <div id="Pagination" style="text-align: center;"></div> 
				         <input type="hidden" value="<?php echo page_limit;?>" name="items_per_page" id="items_per_page">
				         <input type="hidden" value="<?php echo per_page;?>" name="num_display_entries" id="num_display_entries">
				         <input type="hidden" value="Prev" name="prev_text" id="prev_text">
				         <input type="hidden" value="Next" name="next_text" id="next_text">
				    </div>
		         </div>
		      </div><!--end of box-->
		    </div><!--end of col-->
		</div><!--End of row-->
	</div><!--End of Content-->
<script type="text/javascript">
var navigation = <?php $string; ?>
console.log(navigation);
function delete_data(id)
{
	var r = confirm("Are You Sure You Want To Delete Module");
    if(r==true)
    {
    	//$('#tabdata tbody').remove(); 
                     	ajaxloader.load("<?php echo base_url('admin/role_del').'?id=' ?>"+id, function(resp){
                      				var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str['error']=='1'){ 
			                     		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
			                      		 $('#tabdata tbody').empty();
			                      		var result = str;
			                            $.each(result, function(index, item){
											//alert(item.id);
											var status = '';
											if(item.id != 1){
			                            	status = "<button type='button' onclick='delete_data("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											}
											status +="<a href='module_get_id/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>"; 
											 tr += "<tr>\
			                                               <td class='col-md-2'>"+item.id+"</td>\
			                                               <td class='col-md-2'>"+item.role_name+"</td>\
			                                               <td class='col-md-6'>"+item.module_list+"</td>\
			                                               <td class='col-md-2' align='center'>"+status+"</td>\
			                                               </tr>";
			                            });
			                        }
			                       $('#tabdata tbody').html(tr);  
                     	});
    }
}
 var num_display_entries,items_per_page,num_entries,start;
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
              $("#Pagination").pagination(num_entries, {
                num_display_entries: num_display_entries,
                items_per_page:items_per_page,
                callback: pageselectCallback
              });
           }	
           catch(ex){}
     }  
      function loadData(start,per_page,event_type){
      					ajaxloader.load("<?php echo base_url('admin/get_role').'?admin_id='.$_SESSION['user_id'].'&name=' ?>"+$('#modele_name').val(), function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(!str){ 
			                     		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
			                      		var result = str;
			                            $.each(result, function(index, item){
											var status = '';
											if(item.id != '1'){
			                            	status = "<button type='button' onclick='delete_data("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											}
			                            	var status = status+"<a href='role_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
			                            	 tr += "<tr>\
			                                               <td>"+item.id+"</td>\
			                                               <td>"+item.role_name+"</td>\
			                                               <td>"+item.module_list+"</td>\
			                                               <td align='center'>"+status+"</td>\
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