<link rel="stylesheet" href="<?= base_url() ?>assets/app/css/livestoc.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Send Notifications
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notifications</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <!-- <form method="post"> -->
      <div class="card card-solid">
      <?php if( $error = $this->session->flashdata('add_bank')){ ?>
                            <diV class="col-md-3"></div>
                            <div class="col-md-9 corm_nmset">
                                <div class=" error" style="margin-left:0%;">
                                    <?= $error ?>
                                </div>
                            </div>
    <?php } ?>
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            <div class="col-12 col-sm-8 col-md-12 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                    Register a notification by using following form:
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-md-7 col-xs-12">
                    <div class="form-group">
                  <div class="checkbox">
                  <?php echo form_error('ai'); ?>
                    <label>
                      <input name="ai" id='ai[]' value="1" type="radio">
                      AI Worker
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input name="ai" id="ai[]" value="0" type="radio">
                      Coustomer
                    </label>
                  </div>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                  <select name="cars" id="cars" form="carform">
                    <option value=" "> None </option>
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
                  <textarea name="msg" class="form-control" id="msg" rows="3" placeholder="Enter Short Message (max lengtn 250 words)" maxlength="250"></textarea>
                </div>   
                    </div>
                  </div>
                  <div class="form-group mt40 status" style="display:none;">
                    <div class="progress progress-xs progress-striped active" style="height: 24px;">
                      <div class="progress-bar progress-bar-success pro" style="width: 0%"></div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <div class="">
                      <button type="submit" name="submit" value="1" id="sub" class="btn btn-info btn-lg">Send Notification</button>
                  </div>
                  
                </div>
              </div> 
            </div>
           <!-- </form> -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
  $('#sub').click(function(){
    var type = $("input[name='ai']:checked").val()
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
        send_not(type, title, msg, start);
   }
  });
  function send_not(type, title, msg, start){
                    $.ajax({
                      url: "<?= base_url() ?>admin/send_notification/"+type+"/"+title+"/"+msg+"/"+start+"/100",
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
                            send_not(type, title, msg, start);
                        }else{
                          $('.pro').attr("style", "width:100%;");
                          alert('All notification sent');
                          //location.reload();
                        }
                      }
                    });
  }
  </script>