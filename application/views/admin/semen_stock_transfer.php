<link rel="stylesheet" href="<?= base_url() ?>assets/app/css/livestoc.css">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
          Stock Transfer
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content" >
      <div class="row option" >
        <div class="col-md-12">
          <div class="box box-primary pL15 pR15" <?php if(isset($doc_id)){ echo "style='display:none;'"; } ?>>
            <div class="row">
              <div class="col-md-12"> 
                <div class="box-header with-border">
                <?php //print_r($_SESSION); ?>
                  <h3 class="box-title pT10">STEP 1 : Choose to Transfer</h3>
                </div>
                <div class="form-group mL15">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" class="choose" value="1">
                     Transfer Stock to AI Worker
                    </label>
                  </div>
                  <?php if($_SESSION['type'] == '1' || $_SESSION['type'] == '2' || $_SESSION['type'] == '3' || $_SESSION['type'] == '4' || $_SESSION['type'] == '5' || $_SESSION['type'] == '11' || $_SESSION['type'] == '10' ){ ?>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" class="choose" value="2">
                      Transfer Stock to Distributor
                    </label>
                  </div>
                  <?php } ?>
                  <?php if( $_SESSION['type'] == '6'){  ?>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios3" class="choose" value="3">
                      Transfer Stock to Supplier
                    </label>
                  </div>
                  <?php } ?>
                  <?php if( $_SESSION['type'] == '1' || $_SESSION['type'] == '2' || $_SESSION['type'] == '3' || $_SESSION['type'] == '4' || $_SESSION['type'] == '5' || $_SESSION['type'] == '11' || $_SESSION['type'] == '10'){  ?>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios3" class="choose" value="4">
                      Transfer Stock to Delivery Partner
                    </label>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>    
    <div class="row delivery" style="display:none;">
      <div class="col-md-12">
         <div class="box box-primary pL15 pR15">
            <div class="row">
              <div class="col-md-12"> 
                <div class="box-header with-border">
                  <h3 class="box-title pT10">STEP 2 : Search Delivery Partner</h3>
                </div>
                  <div class="box-body">
                    <div class="input-group col-md-6 mT10">
                      <input type="hidden" id="type" value="">
                      <input type="text" id="search" class="form-control" placeholder="Enter Name">
                      <span class="input-group-addon search"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div>
                  </div>
              </div>
            </div>
            <div class="row vt"> 
              
            </div>     
          </div>    
        </div>
      </div>  
    
    <div class="row Stock" <?php if(!isset($doc_id)){ echo 'style="display:none;"'; }?> <?php if($_POST['submit']){ ?> style="display:none;" <?php } ?>>
      <div class="col-md-12">
         <div class="box box-primary pL15 pR15">
         <form method="post">
         <input type="hidden" name="doc_id" value="<?= $doc_id ?>">
         <input type="hidden" name="doc_type" value="<?= $doc_type ?>">
         <input type="hidden" name="stock_data" id="stock_data" value="">
              <div class="row">
                <div class="col-md-12"> 
                  <div class="box-header with-border">
                    <h3 class="box-title pT10">STEP 3 : Select Stock</h3>
                  </div>
                </div>
              </div>
              <div class="row product"> 
                
              </div> 
                <div class="row row-product" align="center">
                      <!-- <div class="col-md-6">
                        <div class="form-group"> -->
                          <!-- <label for="exampleInputEmail1">Enter no. of Straws</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter number"> -->
                        <!-- </div> -->
                      <!-- </div>-->
                      <div class="col-md-2">
                         <!-- <div class="form-group"> -->
                        <label for="exampleInputEmail1">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                          <button type="submit" name="submit" value="1" class="btn btn-sm btn-primary form-control bull" style="margin-bottom: 10px;">Next</button>
                          <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter number"> -->
                        </div>
                      <!-- </div>  -->
                </div> 
              </div> 
            </form>   
          </div>
        </div>   
    <div class="row final" <?php if(!$_POST['submit']){ ?> style="display:none;"<?php } ?>>
        <div class="col-md-12">
          <div class="box box-primary pL15 pR15">
            <div class="row">
              <div class="col-md-12"> 
              <form method="post">
              <input type="hidden" name="doc_id" value="<?= $doc_id ?>">
              <input type="hidden" name="doc_type" value="<?= $doc_type ?>">
              <input type="hidden" name="stock_data" value='<?= $stock_data ?>'>
                <div class="box-header with-border">
                  <h3 class="box-title pT10">STEP 4 : Confirmation</h3>
                </div>
              </div>
            </div>     
            <div class="row"> 
              <div class="col-12 col-sm-6 col-md-4 mT20 mB20">
                <p class="box-title pL5">Selected Delivery Partner</p>
                <?php if($doc_type == 1){
                  $doc_data = $this->api_model->get_doc_id_det($doc_id);
                  $name = $doc_data['username'];
                 }else{ 
                  $doc_data = $this->api_model->get_admin_detail($doc_id);
                  $name = $doc_data[0]['fname'];
                  } ?>
                <div class="card-header text-muted border-bottom-0">
                  <?= $name ?>
                </div>       
              </div>
            </div>
            <div class="row"> 
              <div class="col-8 col-sm-6 col-md-4 mT20 mB20">
                <p class="box-title pL5">Selected Stock(s)</p>
                <?php  $st = json_decode($stock_data);
                //print_r($st->data);
                $i = 0;
                foreach($st->data as $s){
                  //echo "<pre>";
                 // print_r($s);
                 // echo $i;
                  if($this->input->get_post('strow_'.$s->id) != ''){
                   // echo "this is test";
                    //echo $_POST['strow_'.$s[$i]->id];  ?>
                   <div class="card-header text-muted border-bottom-0 mT10">
                   <input type="hidden" name="strow_<?= $s->id ?>" value="<?= $_POST['strow_'.$s->id] ?>">
                   <?php //print_r($s);
                    $total += $s->sale_price * $_POST['strow_'.$s->id]; ?>
                    <span class="pull-left"> <?= $_POST['strow_'.$s->id] ?> Straw(s) of Stock #<?= $s->id ?></span><span class="pull-right"><i class="fa fa-inr" aria-hidden="true"></i> : <?= $s->sale_price * $_POST['strow_'.$s->id]; ?></span>
                    </div> 
                  <?php }
                  $i++;
                }
                ?>
              </div>    
            </div>  
            <div class="row"> 
              <div class="col-12 mT20 mB20"> 
                <div class="card-footer forfull">
                  <div class="col-md-4 mB20">
                    <h3>Total Amount : <i class="fa fa-inr" aria-hidden="true"></i> <?= $total ?></h3>
                  </div> 
                  <div class="col-md-4 pull-right mB20 mT20">
                    <div class="text-right">
                      <button type="submit" name="final" value="1" class="btn btn-block btn-info btn-lg">Transfer Stock</button>
                    </div>
                  </div>
                </div>    
              </div>
            </div> 
            </form>
          </div>    
        </div>
      </div>  
    </section>
  </div>
  <script>
  <?php if(isset($doc_id)){ ?>
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
     <?php
     if($_SESSION['status'] == 1){ ?>
        var get_url = "<?php echo base_url('api/get_semen_stock_listing')?>";
     <?php }else{ 
        if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
          $admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);  ?>
          var get_url = "<?php echo base_url('api/get_semen_stock_listing').'?admin_id='.$admin_data[0]['super_admin_id'] ?>";
      <?php }else{ ?>
        var get_url = "<?php echo base_url('api/get_semen_stock_listing').'?admin_id='.$_SESSION['user_id'] ?>";
      <?php }  
        }
      ?>
      function loadData(start,per_page,event_type){
      					ajaxloader.load(get_url, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
                             
			                      	var tr = '';
                              if(str.success == false){
                                        tr += "<div class='col-md-12' align='center'>No record found!</div>";
                                        $('.row-product').hide();
                                      }
			                     	 else if(str.data.success==false){ 
                              tr += "<div class='col-md-12' align='center'>No record found!</div>";
                              $('.row-product').hide();
			                       	}
			                      	else{
                                $('.row-product').show();
																var result = str.data;
                                //console.log(result);
                                $('#stock_data').val(resp);
								// 								$('#count').val(result.count[0].count);
                                // delete result.count ;
			                            $.each(result, function(index, item){
                                    if(typeof item.id !== 'undefined'){
                                    
			                            	var status = '';
											// if(item.id != 1){
                        status = '<div class="col-md-12"><input type="number" class="form-control" placeholder="No of Straw" name="strow_'+item.id+'"></div>';
			                            	// status = "<button type='button' onclick='del("+item.id+")' class='btn btn-danger btn-flat'>Delete</button>";
											// }
                                            // if(item.isactive != '1'){
                                            //     status += "<button type='button' onclick='status("+item.id+", 1)' class='btn btn-sm btn-danger'>Active</button>"
												//status += "<a href='<?= base_url('admin/product_view') ?>/"+item.id+"'><button type='button' onclick='' class='btn btn-sm btn-info'>View</button></a>";
																								//status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
																						// }else{
                                            //     status += "<button type='button' onclick='status("+item.id+", 0)' class='btn btn-sm btn-success'>Deactive</button>";
												//status += "<a href='<?= base_url('admin/product_view') ?>/"+item.id+"'><button type='button' onclick='' class='btn btn-sm btn-info'>View</button></a>";
																								//status += "<button type='button' onclick='status("+item.doctor_id+", 2)' class='btn btn-primary btn-flat'>Reject</button>";
                                            // }
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
																	<div class='card-header text-muted border-bottom-0'>\
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
																	</div>\
																	<div class='card-body pt-0'>\
																	<div class='row'>\
																		<div class='col-md-7 col-xs-7'>\
																		<h2 class='lead'><b># "+item.id+" </b></h2>\
																		<p class='text-muted text-sm'><b>Tag: </b>"+item.bull_id+" </p>\
                                                                        <p class='text-muted text-sm'><b>Category: </b>"+item.bull_cat_name+" </p>\
																		<p class='text-muted text-sm'><b>Breed: </b>"+item.bull_bread_name+" </p>\
																		<p class='text-muted text-sm'><b>Total Strow: </b>"+item.rest_stock+" </p>\
																		<p class='text-muted text-sm'><b>Batch Number: </b>"+item.batch_no+" </p>\
                                                                        <p class='text-muted text-sm'><b>Progeny Tested: </b>"+item.progini_test+" </p>\
																		<p class='text-muted text-sm'><b>Semen Bank: </b>"+item.semen_bank_name+" </p>\
																			<p class='text-muted text-sm'><b>Date Added: </b>"+item.date+" </p>\
																		</div>\
																		<div class='col-md-5 col-xs-5 text-center'>\
																		<img src='"+item.bull_image+"' alt='' style='width: 100%; height: 105px;' class='img-circle img-fluid'>\
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
			                            }}); 
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
      <?php }else{ ?>
  $('.choose').click(function(){
    $('#type').val($(this).val());
    $('.option').hide();
    $('.delivery').show();
  });
  $('.search').click(function(){
    //alert($('#type').val());
    var url;
    <?php
    if($_SESSION['type'] == '10' || $_SESSION['type'] == '11'){
      $admin_data = $this->api_model->get_seman_company_id($_SESSION['user_id']);  ?>
      var id = <?= $admin_data[0]['super_admin_id'] ?>;
  <?php }else{ ?>
     var id = <?= $_SESSION['user_id'] ?>;
  <?php }  
    ?>
    if($('#type').val() == 1){
      url = "<?php echo base_url('api/get_semen_vt_distributer').'?type=1&search='?>"+$('#search').val();
    }else if($('#type').val() == 2){
      url = "<?php echo base_url('api/listing_authority').'?user_type=6&admin_id=' ?>"+id+"&search="+$('#search').val();
    }else if($('#type').val() == 4){
      url = "<?php echo base_url('api/delivery_partner').'?&search='?>"+$('#search').val();
    }else{
      url = "<?php echo base_url('api/listing_authority').'?user_type=7&admin_id=' ?>"+id+"&search="+$('#search').val();
    }
    ajaxloader.load(url, function(resp){
			                      	var data = resp;
			                      	var str =JSON.parse(data);
			                      	var tr = '';
                              if(str.success == false){
                                        tr += "<div class='col-md-12' align='center'>No record found!</div>";
                                      }
			                     	  else if(str.data.length == 0){ 
                                        tr += "<div class='col-md-12' align='center'>No record found!</div>";
			                       	}
			                      	else{
			                      		  var result = str.data;
			                            $.each(result, function(index, item){
                                    if(!item.doctor_id){
                                      item.doctor_id = item.admin_id;
                                      item.username = item.fname
                                    } 
                                  var status = '';									 
			                            	status += "<a href='<?= base_url()?>admin/transfer_semen/"+item.doctor_id+"/"+$('#type').val()+"'><button type='button' class='btn btn-info partner'>Select</button></a>";
			                            	 tr+="<div class='col-12 col-sm-6 col-md-4 d-flex align-items-stretch'><div class='card bg-light'>\
                                                    <div class='card-header text-muted border-bottom-0'>\
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                                                    </div>\
                                                  <div class='card-body pt-0'>\
                                                    <div class='row'>\
                                                      <div class='col-md-7 col-xs-7'>\
                                                        <h2 class='lead'><b># "+item.doctor_id+" </b></h2>\
                                                        <p class='text-muted text-sm'><b>Name: </b>"+item.username+" </p>\
                                                        <p class='text-muted text-sm'><b>Mobile: </b>"+item.mobile+" </p>\
                                                        <p class='text-muted text-sm'><b>Email: </b>"+item.email+" </p>\
                                                        <p class='text-muted text-sm'><b>State: </b>"+item.state+" </p>\
                                                      </div>\
                                                      <div class='col-md-5 col-xs-5 text-center'>\
                                                        <img src='"+item.image+"' alt='' style='width: 100%; height: 105px;' class='img-circle img-fluid'>\
                                                      </div>\
                                                    </div>\
                                                  </div>\
                                                <div class='card-footer'>\
                                                  <div class='text-right'>\
                                                      "+status+"\
                                                  </div>\
                                                </div>\
																              </div></div></div>";
			                            }); 
			                       	}
			                      $('.vt').empty();  
                       		  $('.vt').html(tr);                    	
		            });
  });
  $('button').click(function(){
    alert();
    // $('.delivery').hide();
    // $('.Stock').show();
  });
  $('.bull').click(function(){
    $('.Stock').hide();
    $('.final').show(); 
  })
<?php } ?>
  </script>