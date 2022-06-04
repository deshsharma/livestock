<link rel="stylesheet" href="<?= base_url() ?>assets/app/css/livestoc.css">
<div class="content-wrapper">
<section class="content">
	          	<div class="box-header with-border">
		              <h3 class="box-title">Semen Stock Management</h3>
                  <?php //print_r($_SESSION); ?>
                  <?php if($_SESSION['type'] == '5' || $_SESSION['type'] == '1' || $_SESSION['type'] == '10' || $_SESSION['type'] == '11' ){?>
		              <a class="white" href="<?= base_url('admin/seman_stock'); ?>"><div class="btn btn-info but_set">
					  		Add Semen Stock
		              </div></a>
                  <?php } ?>
		              <div class="pull-right Search_set1"> 
						   <input type="text" class="glyphicon-search" placeholder="" id="product_name" name="product_name">
						   <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
							 <input type="hidden" value="" id="count" >
		              </div>
	            </div>
      <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
              <div class="row d-flex align-items-stretch product">

              </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
									<div id="Pagination" style="text-align: center;"></div> 
									<input type="hidden" value="9" name="items_per_page" id="items_per_page">
									<input type="hidden" value="10" name="num_display_entries" id="num_display_entries">
									<input type="hidden" value="Prev" name="prev_text" id="prev_text">
									<input type="hidden" value="Next" name="next_text" id="next_text">
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
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
			var per_page = $('#items_per_page').val();
 	ajaxloader.load("<?php echo base_url('api/semen_strow_deactive').'?stock_id=' ?>"+id+"&isactive="+status+"&start="+start+"&perpage="+per_page+"&region="+person, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
			                   
                              window.location.reload(true);                	
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
			                     	 if(str.data.success==false){ 
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
        <?php
        if($_SESSION['status'] == 1){ ?>
            var get_url = "<?php echo base_url('api/get_semen_stock_listing')?>?name="+$('#product_name').val();
        <?php }else{ 
						if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
								$admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);  ?>
								var get_url = "<?php echo base_url('api/get_semen_stock_listing').'?admin_id='.$admin_data[0]['super_admin_id'] ?>&name="+$('#product_name').val();
						<?php }else{ ?>
								var get_url = "<?php echo base_url('api/get_semen_stock_listing').'?admin_id='.$_SESSION['user_id'] ?>&name="+$('#product_name').val();
						<?php } 
						}
          ?>
      					ajaxloader.load(get_url, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
                              if(str.success == false){
                                        tr += "<div class='col-md-12' align='center'>No record found!</div>";
                                      }
			                     	 else if(str.data.success==false){ 
                              			tr += "<div class='col-md-12' align='center'>No record found!</div>";
			                       	}
			                      	else{
																var result = str.data;
								// 								$('#count').val(result.count[0].count);
                                // delete result.count ;
			                            $.each(result, function(index, item){
			                            	var status = '';
											// if(item.id != 1){
			                            	// status = "<button type='button' onclick='del("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											// }
                            <?php if($_SESSION['status']!='19'){ ?>
                                              if(item.isactive != '1'){
                                                status += "<button type='button' onclick='status("+item.id+", 1)' class='btn btn-sm btn-danger'>Active</button>"
												//status += "<a href='<?= base_url('admin/product_view') ?>/"+item.id+"'><button type='button' onclick='' class='btn btn-sm btn-info'>View</button></a>";
																								//status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
																						}else{
                                                status += "<button type='button' onclick='status("+item.id+", 0)' class='btn btn-sm btn-danger'>Delete</button>";
												//status += "<a href='<?= base_url('admin/product_view') ?>/"+item.id+"'><button type='button' onclick='' class='btn btn-sm btn-info'>View</button></a>";
																								//status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
                                            }
                                  <?php } ?>
											var premium ='';
											if(item.ispremium == '3'){
												premium = "<span class='text-right platinum'>PREMIUM PLATINUM</span>";
											}else if(item.ispremium == '2'){
												premium = "<span class='text-right gold'>PREMIUM</span>";
											}else if(item.ispremium == '1'){
												premium = "<span class='text-right premium'>PREMIUM</span>";
											}else{
												premium = "<a href=''><span class='text-right premium'>Upgrade to Premium</span></a>";
											}
														   tr+="<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch'><div class='card bg-light'>\
																	<div class='card-header text-muted border-bottom-0' >\
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
																	</div>\
																	<div class='card-body pt-0'>\
																	<div class='row'>\
																		<div class='col-md-8 col-xs-7'>\
																		<h2 class='lead'><b># "+item.id+" </b></h2>\
																		<p class='text-muted text-sm'><b>Tag: </b>"+item.bull_id+" </p>\
                                                                        <p class='text-muted text-sm'><b>Category: </b>"+item.bull_cat_name+" </p>\
																		<p class='text-muted text-sm'><b>Breed: </b>"+item.bull_bread_name+" </p>\
																		<p class='text-muted text-sm'><b>Total Strow: </b>"+item.rest_stock+" </p>\
																		<p class='text-muted text-sm'><b>Batch Number: </b>"+item.batch_no+" </p>\
                                                                        <p class='text-muted text-sm'><b>Progeny Tested: </b>"+item.progini_test+" </p>\
                                                                        <p class='text-muted text-sm'><b>Dam's Yield (kg): </b>"+item.dam_yield+" </p>\
                                                                        <p class='text-muted text-sm'><b>Semen Type: </b>"+item.groups+" </p>\
																		<p class='text-muted text-sm'><b>Semen Bank: </b>"+item.semen_bank_name+" </p>\
																			<p class='text-muted text-sm'><b>Date Added: </b>"+item.date+" </p>\
																		</div>\
																		<div class='col-md-4 col-xs-5 text-center'>\
																		<img src='"+item.bull_image+"' alt='' style='width: 100%; height: 86px;' class='img-circle img-fluid'>\
																		</div>\
																	</div>\
																	</div>\
																	<div class='card-footer'>\
																	<div class='text-right'>\
																			"+status+"\
																	</div>\
																	</div>\
																</div>\
															</div></div>";
			                            }); 
			                       	}
                       		 $('.product').html(tr);                    	
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