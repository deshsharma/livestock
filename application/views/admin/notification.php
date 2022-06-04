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
      <div class="card card-solid">
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
                    <label>
                      <input type="checkbox">
                      AI Worker
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Distributor
                    </label>
                  </div>
                </div>  
                        <div class="form-group mt40">
                  <label>Message Heading</label>
                  <input type="text" class="form-control" placeholder="Enter Heading (max lengtn 20 words)" maxlength="20">
                </div>
                        <div class="form-group">
                  <label>Enter Message Content</label>
                  <textarea class="form-control" rows="3" placeholder="Enter Short Message (max lengtn 200 words)" maxlength="200"></textarea>
                </div>   
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <div class="">
                <button type="button" class="btn btn-info btn-lg">Send Notification</button>
            </div>
                </div>
              </div> 
            </div>
   
          </div>
        </div>
      </div>
    </section>
  </div>