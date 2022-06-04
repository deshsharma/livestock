<script type="text/javascript">
  function yesnoCheck() {
      if (document.getElementById('yesCheck').checked) {
          document.getElementById('ifYes').style.display = 'block';
      }
      else document.getElementById('ifYes').style.display = 'none';
  }
</script>
<link rel="stylesheet" href="<?= base_url() ?>assets/app/css/livestoc.css">
<div class="content-wrapper">
  <section class="content-header">
    <h1>Send Notifications</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notifications</li>
      </ol>
  </section>
  <section class="content">
    <form method="post" onsubmit="return false;">
      <div class="card card-solid">
        <?php if( $error = $this->session->flashdata('add_bank')){ ?>
          <diV class="col-md-3"></div>
            <div class="col-md-9 corm_nmset">
              <div class=" error" style="margin-left:0%;">
                <?= $error ?>
              </div>
            </div>
        <?php } ?>
        <div class="card-header text-muted border-bottom-0">
          <label>All Users <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"> </label>
          <label>Single User <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" checked></label><br>
        </div>
       
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            <div class="col-12 col-sm-8 col-md-12 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                    Register a notification by using following form:
                </div>
                <div id="ifYes" style="display:none">
                  <div class="box-body">              
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php echo form_error('state1'); ?>
                          <label>Select State</label>
                          <?php $data = $this->api_model->get_state(99); ?>
                          <select class="form-control state1" name="state1" required>
                            <option value="">Select State</option>
                            <?php foreach($data as $d){ ?>
                              <option value="<?= $d['zone_id'] ?>"><?= $d['name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php echo form_error('district1'); ?>
                          <label>Select District</label>
                          <select name="district1" id="district_id" class="form-control city1">
                            <option>Select District</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><br>
                  <div class="box-body pt-0">
                    <div class="row">
                      <div class="col-md-7 col-xs-12">
                      <div class="form-group">
                    <div class="checkbox">
                    <?php echo form_error('ai'); ?>
                      <label>
                        <input name="ai"  id="ai[]" value="2" type="radio">
                        AI Worker
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="ai"  id="ai[]" value="1" type="radio">
                        Doctor
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="ai"  id="ai[]" value="0" type="radio">
                        Coustomer
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="ai"  id="ai[]" value="3" type="radio">
                        Retailer
                      </label>
                    </div>
                  </div> 
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="form-group">
                        <label>Select Uses Type</label>
                      </div>
                      <select class="form-control" name="is_premium" id="premium" form="premium">
                        <option value=" "> Select Uses Type </option>
                        <option value="">ALL </option>
                        <option value="1">Premium </option>
                        <option value="0">Non Premium </option>
                      </select>
                    </div>
                  </div>
               

                <div class="form-group mt40">
                  <?php echo form_error('title'); ?>
                  <label>Message Heading</label>
                  <input  name="title" type="text" id="title" class="form-control" placeholder="Enter Heading (max lengtn 30 words)" maxlength="30">
                </div>
                <div class="form-group">
                  <?php echo form_error('msg'); ?>
                  <label>Enter Message Content</label>
                  <textarea name="msg"  id="msg" class="form-control" rows="3" placeholder="Enter Short Message (max lengtn 140 words)" maxlength="140"></textarea>
                </div>
                <div class="col-md-6 mt-5 bull_image">
                  <h5>Please select Images</h5>
                  <?php echo form_error('images'); ?>
                  <div class="col-md-3 mt-5 ">
                    <div class="image-upload mt-4 "> 
                      <label style="cursor: pointer;" for="file_upload"></label>
                      <div class="h-100">
                        <div class="dplay-tbl">
                          <div class="dplay-tbl-cell">
                            <div class="form-group ref" style="text-align: center;margin-top: 0px;width: 114%;height: 61px;display:none;">
                              <img src="<?= base_url('assets/gif/source.gif')?>" style="height: 38px;">                                                      
                            </div>
                          </div>
                          <input data-required="image" type="file"  id="bull_image" class="image-input" data-traget-resolution="image_resolution" value="">
                          <input type="hidden" name="animal_image" id="bull_photo" value="">                      
                        </div>
                      </div>  
                    </div>
                  </div>
                </div>
             
            <div class="form-group mt40 status" style="display:none;">
              <div class="progress progress-xs progress-striped active" style="height: 24px;">
              <div class="progress-bar progress-bar-success pro" style="width: 0%"></div>
            </div>
          </div>
        </div>
        </div>
        <div class="card-footer">
          <div class="">
          <button type="submit" name="submit" value="1" id="sub" class="btn btn-info btn-lg">Send Notification</button>
        </div>
      </div>
    </form>
  </section>
</div>
  <script type="text/javascript">
  $('#sub').click(function(){
    var type = $("input[name='ai']:checked").val()
    var is_premium  =  $( "#premium option:selected" ).attr("value");
    var image = $('#bull_photo').val();
    var district_id  =  $( "#district_id option:selected" ).attr("value");
    //alert(district_id);
    var title = $('#title').val();
    var msg = $('#msg').val();   
    if(type == ''){
      alert('Please Choose type');
    }else if(title == ''){
      alert('Please Fill Title Field');
    }else if(msg == ''){
      alert('Please Fill message Field');
    }else{
        var start = 0;
        $('.status').show();
        send_not(type, is_premium, title, district_id, msg, image, start);
   }
  });
  function send_not(type, is_premium, title, district_id, msg, image, start){
                    $.ajax({
                      url: "<?= base_url() ?>admin/send_notification?type="+type+"&is_premium="+is_premium+"&title="+title+"&district_id="+district_id+"&msg="+msg+"&image="+image+"&start="+start+"&perpage=100",
                      cache: false,
                      success: function(html){
                        $("#results").append(html);
                        var str =JSON.parse(html);
                        var status = str.status;
                        if(status == '1'){
                            var st = parseInt(str.start);
                            var sum = 100 * st;
                            var count = parseInt(str.count)/100;
                            var percentage = st / count;
                            start = st + 100;
                            //var percentage = /(100*);
                            $('.pro').attr("style", "width:"+percentage+"%;");
                            var start = st + 100;
                            send_not(type, is_premium, title, district_id, msg, image, start);
                        }else{
                          $('.pro').attr("style", "width:100%;");
                          alert('All notification sent');
                          location.reload();
                        }
                      }
                    });
  }
  $('#submit').click(function(e){
  if($('#bull_photo').val() == ''){
    e.preventDefault();
    alert("Please Upload Photo");
  }
});
$(document).ready(function() {
                $('#bull_image').change(function(){
                    $('#file_name').html('');
                    $('#file_name').html($('#bull_image')[0].files[0].name);
                    var file_data = $('#bull_image').prop('files')[0];   
                    var form_data = new FormData();     
                    var img; 
                    var imgd;            
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
                            if($('#bull_photo').val() == ''){
                                $('#bull_photo').val(data.data);
                            }else{
                                $imgd = $('#bull_photo').val()+','+data.data;
                                $('#bull_photo').val($imgd);
                            }
                            //alert($('#bull_photo').val());
                            img =  '   <div class="col-md-3 mt-5 ">\
                                            <div class="mt-4"> \
                                            <label style="cursor: pointer;">\
                                            <div class="h-100">\
                                                <div class="dplay-tbl">\
                                                    <div class="dplay-tbl-cell">\
                                                      <img style="height: 92px;width: 80px;margin-top: 50px;margin-left: -58px;" src="<?= base_url('uploads/bank/') ?>/'+data.data+'" >\
                                                    </div>\
                                                </div>\
                                            </div>\
                                            </label>\
                                            </div>\
                                        </div>';
                            $('.bull_image').append(img);
                            $('.ref').hide();
                        }
                    });
                });
});
$('.state').change(function(){
    $.ajax({
      url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
      cache: false,
      success: function(resp){
      var data = resp;
		  var str =data.data;
      var option = '<option value="">Select District</option>';
		  $.each(str, function(index, item){
        option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			}); 
      $('.city').html(option);
										
    }
  });
})
$('.state1').change(function(){
    $.ajax({
    url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
    cache: false,
    success: function(resp){
      var data = resp;
      var str =data.data;
      var option = '<option value="">Select District</option>';
        $.each(str, function(index, item){
        option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
        }); 
      $('.city1').html(option);										
    }
  });
})
  </script>