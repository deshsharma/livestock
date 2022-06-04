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
		              <h3 class="box-title">LIVESTOC CASH</h3>
		              <a class="white" href="<?= base_url('admin/add_balance'); ?>"><div class="btn btn-info but_set">
		                 add balance
		              </div></a>
	            </div>
		         <div class="box-body">
		            <div class="col-md-12" aling="center">
						Please click on add balance and do import information
				    </div>
		         </div>
		      </div><!--end of box-->
		    </div><!--end of col-->
		</div><!--End of row-->
	</div><!--End of Content-->
</div><!-- /.content -->
<?php include_once('layouts/admin_footer.php'); ?>