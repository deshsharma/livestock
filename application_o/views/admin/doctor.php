<?php 
include_once('layouts/admin_header.php');
include_once('layouts/admin_nav.php'); 
?>
<script>
$('.image').click(function(){
	alert();
	// alert($(this).data('imgsrc'));
    // $('.doctor_id_value').val($(this).data('doc_id'));
    // $('.document_id_value').val($(this).data('document'));
    // $('.image_source').html('<img src="'+$(this).data('imgsrc')+'" style="height:100%; width:100%;">');
    //alert($(this).data('imgsrc'))
})
</script>
<div class="content-wrapper">
	<div class="content">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	          	<div class="box-header with-border">
		              <h3 class="box-title">VETERINARIAN MANAGEMENT</h3>
		              <!-- <a class="white" href="<?= base_url('admin/superv_add'); ?>"><div class="btn btn-info but_set">
		                 Add User
		              </div></a> -->
					  <a class="white" href="<?= base_url('admin/doctor_report'); ?>"><div class="btn btn-info but_set">
		                 Doctor Report
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
							  <th></th>
			                  <th>Name</th>
							  <th>Document</th>
							  <th>Type</th>
			                  <th>Phone No</th>
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
	<div class="div_model">
	</div>
</div><!-- /.content -->
<script type="text/javascript">

 var num_display_entries,items_per_page,num_entries,start;
 function status(id , status){
	if (confirm('Are you sure you want to change the status')) {
		var person = '';
			if(status == '2'){
				person = prompt("Please Enter Rejection Region", "Enter Hear");
				if(person == ''){
					exit; 
				}
			}
			if($(this).parent().find("input[name='10th']").prop('checked')){
				alert()
			}
			var per_page = $('#items_per_page').val();
 	ajaxloader.load("<?php echo base_url('admin/doc_status').'?id=' ?>"+id+"&status="+status+"&start="+start+"&perpage="+per_page+"&region="+person, function(resp){
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
											var type = '';
											var image ='';
											if(item.users_type == 'pvt_doc'){
												type = 'Private Doctor';
												image = '<img src="<?= base_url() ?>uploads/doctore_doc/'+item.image+'" data-toggle="modal" data-target="#modal-default_'+item.doctor_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doctore_doc/'+item.tenth+'" data-toggle="modal" data-target="#modal-default__'+item.tenth_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doctore_doc/'+item.tenthtwo+'"  data-toggle="modal" data-target="#modal-default__'+item.tenthtwo_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doctore_doc/'+item.diploma_image+'"  data-toggle="modal" data-target="#modal-default__'+item.diploma_id+'" style="height: 98px; width: 94px;">'
												div+='<div class="modal fade" id="modal-default_'+item.doctor_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doctore_doc/'+item.image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												div+='<div class="modal fade" id="modal-default__'+item.tenth_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doctore_doc/'+item.tenth+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												div+='<div class="modal fade" id="modal-default__'+item.tenthtwo_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doctore_doc/'+item.tenthtwo+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
													div+='<div class="modal fade" id="modal-default__'+item.diploma_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doctore_doc/'+item.diploma_image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
											}
											if(item.users_type == 'pvt_ai'){
												type = 'Private AI';
												image = '<img src="<?= base_url() ?>uploads/doc/'+item.image+'" data-toggle="modal" data-target="#modal-default_'+item.doctor_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doc/'+item.tenth+'" data-toggle="modal" data-target="#modal-default__'+item.tenth_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doc/'+item.tenthtwo+'"  data-toggle="modal" data-target="#modal-default__'+item.tenthtwo_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doc/'+item.diploma_image+'"  data-toggle="modal" data-target="#modal-default__'+item.diploma_id+'" style="height: 98px; width: 94px;">'	
												div+='<div class="modal fade" id="modal-default_'+item.doctor_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												div+='<div class="modal fade" id="modal-default__'+item.tenth_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.tenth+'" style="width: 100%;height: 100%;"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												div+='<div class="modal fade" id="modal-default__'+item.tenthtwo_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.tenthtwo+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
													div+='<div class="modal fade" id="modal-default__'+item.diploma_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.diploma_image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
											}
											if(item.users_type == 'pvt_vt'){
												type = 'Private Veterinarian';
												image = '<img src="<?= base_url() ?>uploads/doc/'+item.image+'" data-toggle="modal" data-target="#modal-default_'+item.doctor_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doc/'+item.tenth+'" data-toggle="modal" data-target="#modal-default__'+item.tenth_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doc/'+item.tenthtwo+'"  data-toggle="modal" data-target="#modal-default__'+item.tenthtwo_id+'" style="height: 98px; width: 94px;">'
												image += '<img src="<?= base_url() ?>uploads/doc/'+item.diploma_image+'"  data-toggle="modal" data-target="#modal-default__'+item.diploma_id+'" style="height: 98px; width: 94px;">'
												div+='<div class="modal fade" id="modal-default_'+item.doctor_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.image+'" style="width: 100%;height: 100%;"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												div+='<div class="modal fade" id="modal-default__'+item.tenth_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.tenth+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
													div+='<div class="modal fade" id="modal-default__'+item.tenthtwo_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.tenthtwo+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
													div+='<div class="modal fade" id="modal-default__'+item.diploma_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.diploma_image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
											}	
											<?php if($_SESSION['status'] != 11){ ?>
											if(item.isactivated != '1'){
                                                status += "<button type='button' onclick='status("+item.doctor_id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
																								status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
                                            }else{
                                                status += "<button type='button' onclick='status("+item.doctor_id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
																								status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
                                            }
											<?php } ?>	
											status += "<a href='<?= base_url('/admin/doctore_view') ?>/"+item.doctor_id+"' class='btn btn-info btn-flat'>View</a>";								 
			                            	//status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
			                            	 tr += "<tr>\
											 			   <td><input type='checkbox' name='show[]' value='"+item.doctor_id+"' id='show[]'></td>\
											 			   <td>"+item.fullname+"</td>\
														   <td>"+image+"</td>\
														   <td>"+type+"</td>\
			                                               <td>"+item.mobile+"</td>\
			                                               <td>"+status+"</td>\
			                                               </tr>";
														   image = '';
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
											var type = '';
											if(item.users_type == 'pvt_doc'){
												type = 'Private Doctor';
											}
											if(item.users_type == 'pvt_ai'){
												type = 'Private AI';	
											}
											if(item.users_type == 'pvt_vt'){
												type = 'Private Veterinarian';
											}	
											if(item.id != 1){
			                            	status = "<button type='button' onclick='destal("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											}										 
			                            	status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
			                            	 tr += "<tr>\
			                                               <td>"+item.name+"</td>\
														   <td>"+item.email+"</td>\
														   <td>"+item.aadhar_no+"</td>\
														   <td>"+type+"</td>\
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
      					ajaxloader.load("<?php echo base_url('admin/doctor_search').'?name=' ?>"+$('#product_name').val()+"&start="+start+"&perpage="+per_page, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                     	if(str['error']=='1'){ 
			                     		tr += "<tr><td colspan='7' align='center'>No record found!</td></tr>";
			                       	}
			                      	else{
																var result = str;
																var div = '';
																$('#count').val(result.count[0].count);
                                delete result.count ;
			                            $.each(result, function(index, item){
			                            	var status = '';
											var type = '';
											var image = '';
											// if(item.id != 1){
			                            	// status = "<button type='button' onclick='del("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											// }
											<?php if($_SESSION['status'] != 11){ ?>
                                            if(item.isactivated != '1'){
                                                status += "<button type='button' onclick='status("+item.doctor_id+", 1)' class='btn btn-danger btn-flat'>Active</button>"
																								status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
																						}else{
                                                status += "<button type='button' onclick='status("+item.doctor_id+", 0)' class='btn btn-success btn-flat'>Deactive</button>";
																								status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
											}
											<?php } ?>
											status += "<a href='<?= base_url('/admin/doctore_view') ?>/"+item.doctor_id+"' class='btn btn-info btn-flat'>View</a>";
                                            if(item.users_type == 'pvt_doc'){
												type = 'Private Doctor';
												image = '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doctore_doc/'+item.image+'" data-toggle="modal" data-target="#modal-default_'+item.doctor_id+'" style="height: 98px; width: 94px;"></div>'
												
												div+='<div class="modal fade" id="modal-default_'+item.doctor_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doctore_doc/'+item.image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												
											}
											if(item.users_type == 'pvt_ai'){
												type = 'Private AI';
												image = '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doc/'+item.image+'" data-toggle="modal" data-target="#modal-default_'+item.doctor_id+'" style="height: 98px; width: 94px;"></div>'
												image += '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doc/'+item.tenth+'" data-toggle="modal" data-target="#modal-default__'+item.tenth_id+'" style="height: 98px; width: 94px;"><div><div class="col-md-6">10th</div><div class="col-md-6"><input type="checkbox" name="10th"></div></div></div>'
												image += '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doc/'+item.tenthtwo+'"  data-toggle="modal" data-target="#modal-default__'+item.tenthtwo_id+'" style="height: 98px; width: 94px;"><div><div class="col-md-6">10th+2</div><div class="col-md-6"><input type="checkbox" name="10th+2"></div></div></div>'
												image += '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doc/'+item.diploma_image+'"  data-toggle="modal" data-target="#modal-default__'+item.diploma_id+'" style="height: 98px; width: 94px;"><div><div class="col-md-6">Diploma</div><div class="col-md-6"><input type="checkbox" name="Diploma"></div></div></div>'	
												div+='<div class="modal fade" id="modal-default_'+item.doctor_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												div+='<div class="modal fade" id="modal-default__'+item.tenth_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.tenth+'" style="width: 100%;height: 100%;"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												div+='<div class="modal fade" id="modal-default__'+item.tenthtwo_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.tenthtwo+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
													div+='<div class="modal fade" id="modal-default__'+item.diploma_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.diploma_image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
											}
											if(item.users_type == 'pvt_vt'){
												type = 'Private Veterinarian';
												image = '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doc/'+item.image+'" data-toggle="modal" data-target="#modal-default_'+item.doctor_id+'" style="height: 98px; width: 94px;"></div>'
												image += '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doc/'+item.tenth+'" data-toggle="modal" data-target="#modal-default__'+item.tenth_id+'" style="height: 98px; width: 94px;"><div><div class="col-md-6">10th</div><div class="col-md-6"><input type="checkbox" name="10th"></div></div></div>'
												image += '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doc/'+item.tenthtwo+'"  data-toggle="modal" data-target="#modal-default__'+item.tenthtwo_id+'" style="height: 98px; width: 94px;"><div><div class="col-md-6">10th+2</div><div class="col-md-6"><input type="checkbox" name="10th+2"></div></div></div>'
												image += '<div class="col-md-3"><img src="<?= base_url() ?>uploads/doc/'+item.diploma_image+'"  data-toggle="modal" data-target="#modal-default__'+item.diploma_id+'" style="height: 98px; width: 94px;"><div><div class="col-md-6">Diploma</div><div class="col-md-6"><input type="checkbox" name="Diploma"></div></div></div>'
												div+='<div class="modal fade" id="modal-default_'+item.doctor_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.image+'" style="width: 100%;height: 100%;"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
												div+='<div class="modal fade" id="modal-default__'+item.tenth_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.tenth+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
													div+='<div class="modal fade" id="modal-default__'+item.tenthtwo_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.tenthtwo+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
													div+='<div class="modal fade" id="modal-default__'+item.diploma_id+'" style="display: none;">\
													<div class="modal-dialog">\
														<div class="modal-content">\
														<div class="modal-header">\
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
															<span aria-hidden="true">×</span></button>\
															<h4 class="modal-title">Default Modal</h4>\
														</div>\
														<div class="modal-body">\
															<p class="image_source"><img src="<?= base_url() ?>uploads/doc/'+item.diploma_image+'" style="height:100%; width:100%"></p>\
														</div>\
														<div class="modal-footer">\
															<button type="button" class="btn btn-primary sub-submit" data-status="1" data-dismiss="modal">Close</button>\
														</div>\
														</div>\
													</div>\
													</div>';
											}									 
			                            	//status += "<a href='superv_edit/"+item.id+"'><button type='button' class='btn btn-info btn-flat'>Edit</button></a>";
			                            	 tr += "<tr>\
											 			   <td><input type='checkbox' name='show[]' value='"+item.doctor_id+"' id='show[]'></td>\
			                                               <td>"+item.fullname+"</td>\
														   <td>"+image+"</td>\
														   <td>"+type+"</td>\
			                                               <td>"+item.mobile+"</td>\
			                                               <td>"+status+"</td>\
			                                               </tr>";
														   image = '';
														
			                            }); 
			                       	}
                       		 $('#tabdata tbody').html(tr);
							$('.div_model').html(div);                       	
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