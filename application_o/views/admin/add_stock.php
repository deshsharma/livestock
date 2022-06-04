<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Stock
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Please fill the following details</h3>
            </div>
            <div class="row">
            <?php //print_r($data); ?>
                <div class="col-md-6 col-xs-12">
                <form role="form" method="post" action="<?= base_url('admin/add_stock/').$data[0]['id'] ?>"> 
                <input type="hidden" name="bull_id" value="<?= $data[0]['id'] ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Bull ID/ Tag No.</label>
                  <input type="text" value="<?= $data[0]['bull_id'] ?>" readonly class="form-control" id="exampleInputEmail1" placeholder="Enter Bull ID/ Tag No.">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Bull Breed</label>
                  <input type="text" class="form-control" value="<?= $data[0]['breed_name'] ?>" readonly id="exampleInputEmail1" placeholder="Enter Bull Breed">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">No. of Straws</label>
                  <input type="number" class="form-control" name="opening_stock" id="exampleInputEmail1" placeholder="Enter No of Straws" required min="0">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Ejaculation Number</label>
                  <input type="number" class="form-control" name="ejacuation_no" id="exampleInputEmail1" placeholder="Enter Ejaculation Number" required min="0">
                </div>   
                <div class="form-group">
                  <label for="exampleInputFile">Upload Semen Issuance/Production Certificate</label>
                  <div class="form-group ref" style="text-align: center; display:none;">
                    <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">
                  </div>
                  <input type="file" id="bull_image">
                  <input type="hidden" name="image" id="bull_photo" value="">
                    <p class="help-block">Issued by semen bank with Bull ID &amp; Batch No. details</p>
                </div>
              </div>
                </div>
            </div>
          </div>
</div>
<style>
/* #partitioned {
  padding-left: 15px;
  letter-spacing: 42px;
  border: 0;
  background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
  background-position: bottom;
  background-size: 50px 1px;
  background-repeat: repeat-x;
  background-position-x: 35px;
  width: 220px;
} */
</style>
</div>    
    <div class="row">
        <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title pT10">Batch Number (<a href="https://www.livestoc.com/strow/" target="_blank">See Sample</a>)</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <div class="row">
            <div class="col-md-6"> 
            
            <div class="box-body">    
               <div class="row">
                <div class="col-md-3">    
                <div class="form-group">
                  <label for="exampleInputEmail1">Day of year</label>
                  <!-- <input id="partitioned" type="text" maxlength="3" /> -->
                  <input type="number" class="form-control" name="batch_days" id="" placeholder="out of 365" min="0" max="365" required>
                </div>
                </div>
                <div class="col-md-6">    
                <div class="form-group">
                  <label for="exampleInputEmail1">Date (dd / mm / yyyy)</label>
                  <input type="text" class="form-control" name="batch_date" id="from-datepicker" placeholder="dd - mm - yyyy" autocomplete="off" required>
                </div>
                </div>
                <div class="col-md-3">    
                <div class="form-group">
                  <label for="exampleInputEmail1">Straw number</label>
                  <input type="number" class="form-control" name="batch_num" id="" placeholder="Enter Number" min="0" required>
                </div>
                </div>    
                </div>
             </div>
            
            </div>
            <div class="col-md-6 mB20"> 
            <div class="col-md-4 mB20 mT20 pull-right">
            <div class="text-right">
                <button type="submit" name="submit" value="1" id="submit" class="btn btn-block btn-info btn-lg">Submit</button>
            </div>
            </div>    
            </div> 
            </div> 
            </form>    
                
</div>
</div>
</div>
<script>
$('#submit').click(function(e){
  if($('#bull_photo').val() == ''){
    e.preventDefault();
    alert("Please Upload Semen Issuance/Production Certificate");
  }
});
$(document).ready(function() {
				$('#bull_image').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#bull_image')[0].files[0].name);
					var file_data = $('#bull_image').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
          $('.ref').show();
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#bull_photo').val(data.data);
              $('.ref').hide();
						}
					});
				});
});
</script>
        