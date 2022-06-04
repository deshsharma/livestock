<?php 
//print_r($_SESSION);
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php'); 
?>
<div class="content-wrapper">
	<div class="content">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
              <?php if($request == '1'){ ?>
                <div class="callout callout-success">
                    <h4>Congratulations</h4>

                    <p>Now you can view your leads.</p>
                </div>
              <?php } ?>
	          	<div class="box-header with-border">
		              <h3 class="box-title">PRODUCT LEADS</h3>
		              <!-- <a class="white" href="<?= base_url('admin/superv_add'); ?>"><div class="btn btn-info but_set">
		                 Add User
		              </div></a> -->
		              <div class="pull-right Search_set1"> 
						   <input type="text" class="glyphicon-search" placeholder="Product Name" id="product_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
                           <input type="hidden" value="" id="count" >
                           <input type="hidden" value='' id = "item_id">
		              </div>
	            </div>
		         <div class="box-body">
		         	<table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
                        <th><input type="checkbox" name="check_all" id="check_all"></th>
                        <th></th>
			                  <th>Product Name</th>
			                  <th>User Type</th>
                        <th></th>
			                </tr>
		                </thead>
		                <tbody>
		                	
		                </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
			                  <th style="text-align: center;"><button id="pay" class="btn btn-primary">Buy Selected</button></th>
			                  <th></th>
                        <th></th>
                    </tfoot>		                
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
$('#pay').click(function(){
      selected = new Array();
      $("input:checkbox:checked").each(function(){
        if(!isNaN($(this).val())){
          selected.push($(this).val());
        }
      });
      if(selected == ''){
        alert('Please Select Leads');
      }else{
        window.location.href = "<?= base_url('admin/buy_lead/') ?>"+encodeURIComponent(selected);
      }
      //alert(selected);
      //window
  });
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

     setInterval(function() {
      per_page = 20;
      event_type = 'undefined';
      ajaxloader.load("<?php echo base_url('admin/product_interest_view_status?id=') ?>"+$('#item_id').val(), function(resp){
        // alert('done');
      });
      loadData(start,per_page,event_type)
      }, 10000);
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
                        var item_id = ''
                        $.each(result, function(index, item){
                          var image = item.images.split(",", 1);
                          item_id += item.int_id+",";
                          //alert(image);
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
                            var button = '';
                            var check_box = '';
                            if(item.is_paid == '0'){
                              button = "<a  href='<?= base_url('admin/buy_lead/') ?>"+item.int_id+"'  class='btn btn-danger'>Buy Lead</a>";
                              check_box = "<input type='checkbox' onclick='check(this)' value='"+item.int_id+"'>";
                            }else{
                              button = "<a  href='<?= base_url('admin/interest_view/') ?>"+item.int_id+"'  class='btn btn-success'>View</a>";
                            }
                            var view = '';
                            if(item.view_status == '0'){
                              view = "<span class='badge bg-red'>New</span>";
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
                            //var button = "<a  href='<?= base_url('admin/interest_view/') ?>"+item.int_id+"'  class='btn btn-success'>View</a>";
                        	 tr += "<tr>\
                               <td>"+check_box+"</td>\
                               <td><img src='<?= base_url('uploads/product/') ?>"+image+"' style='height:25px;'></td>\
                               <td>"+item.name+" &nbsp; "+view+"</td>\
                               <td>"+user_type+"</td>\
                               <td>"+button+"</td>\
                               </tr>";
                        });
                   	}
           $('#item_id').val(item_id);
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
  <!-- <td>"+item.full_name+"</td>\ -->
                               <!-- <td>"+ item. mobile_code + item.mobile+"</td>\ -->
<?php include_once('layouts/admin_footer.php'); ?>