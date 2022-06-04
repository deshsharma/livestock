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
                  <h3 class="box-title">USER LIST</h3>
                  <a class="white" href="<?= base_url('admin/district_manager_reg'); ?>"><div class="btn btn-info but_set">
                     Add USER
                  </div></a>
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
                        <th>USER NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>REFRAL CODE</th>
                        <th>USER TYPE</th>
                        <th>UPDATE LOCATION</th>
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
  ajaxloader.load("<?php echo base_url('admin/manager_status').'?id=' ?>"+id+"&status="+status+"&start="+start+"&perpage="+per_page+"&name="+$('#product_name').val(), function(resp){
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
                                    if(item.users_type == 'pvt_dis'){
                                      type = 'Dirstrict Manager';
                                    }else if(item.users_type == 'pvt_milk'){
                                      type = 'Yield Checker';
                                    }else if(item.users_type == 'pvt_field'){
                                      type = 'Field Executive';
                                    }
                                    if(item.isactivated == 1){
                                      status = "<button type='button' onclick='status("+item.doctor_id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
                                    }else{
                                      status = "<button type='button' onclick='status("+item.doctor_id+", 1)' class='btn btn-danger btn-flat'>Active</button>";
                                    }
                                               // status += "<a href='<?= base_url(); ?>admin/paravate_order_view/"+item.id+"' ><button type='button' class='btn btn-success btn-flat'>View</button></a>"              
                                    //status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
                                     status += "<a href='<?= base_url('admin/location_update/')?>"+item.doctor_id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
                                     status += "<a href='<?= base_url('admin/sub_dis_list/')?>"+item.doctor_id+"'><button type='button' class='btn btn-primary btn-flat'>User List</button></a>";
                                     status += "<a href='<?= base_url('admin/sub_dis_doc/')?>"+item.doctor_id+"'><button type='button' class='btn btn-danger btn-flat'>VT List</button></a>";
                                     //status += "<a href='<?= base_url('admin/sub_dis_u_list/')?>"+item.doctor_id+"'><button type='button' class='btn btn-danger btn-flat'>U List</button></a>";
                                     tr += "<tr>\
                                                            <td>"+item.username+"</td>\
                                                            <td>"+item.email+"</td>\
                                                            <td>"+item.mobile+"</td>\
                                                            <td>"+item.refral_code+"</td>\
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
                                                     <td>"+item.name+"</td>\
                                                     <td>"+item.phone+"</td>\
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
                ajaxloader.load("<?php echo base_url('admin/manager_search').'?name=' ?>"+$('#product_name').val()+"&start="+start+"&perpage="+per_page, function(resp){
                              var data = resp;
                              var str =JSON.parse(data);
                              var tr = '';
                            if(str.count[0].count=='0'){ 
                              tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
                              }
                              else{
                                var result = str;
                                var type = '';
                                $('#count').val(result.count[0].count);
                                delete result.count ;
                                  $.each(result, function(index, item){ 
                                    var status = '';
                                    if(item.users_type == 'pvt_dis'){
                                      type = 'Dirstrict Manager';
                                    }else if(item.users_type == 'pvt_milk'){
                                      type = 'Yield Checker';
                                    }else if(item.users_type == 'pvt_field'){
                                      type = 'Field Executive';
                                    }
                      if(item.isactivated == 1){
                        status = "<button type='button' onclick='status("+item.doctor_id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
                      }else{
                        status = "<button type='button' onclick='status("+item.doctor_id+", 1)' class='btn btn-danger btn-flat'>Active</button>";
                      }
                                               // status += "<a href='<?= base_url(); ?>admin/paravate_order_view/"+item.id+"' ><button type='button' class='btn btn-success btn-flat'>View</button></a>"              
                                    //status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
                                     status += "<a href='<?= base_url('admin/location_update/')?>"+item.doctor_id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
                                     status += "<a href='<?= base_url('admin/sub_dis_list/')?>"+item.doctor_id+"'><button type='button' class='btn btn-primary btn-flat'>User List</button></a>";
                                     status += "<a href='<?= base_url('admin/sub_dis_doc/')?>"+item.doctor_id+"'><button type='button' class='btn btn-danger btn-flat'>VT List</button></a>";
                                     //status += "<a href='<?= base_url('admin/sub_dis_u_list/')?>"+item.doctor_id+"'><button type='button' class='btn btn-danger btn-flat'>U List</button></a>";
                                     tr += "<tr>\
                                                            <td>"+item.username+"</td>\
                                                            <td>"+item.email+"</td>\
                                                            <td>"+item.mobile+"</td>\
                                                            <td>"+item.refral_code+"</td>\
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
<?php include_once('layouts/admin_footer.php'); ?>