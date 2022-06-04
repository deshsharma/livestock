  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  //$.widget.bridge('uibutton', $.ui.button);
</script>
<script type="text/javascript" src="<?= base_url('assets/main/js/ajaxloader.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/admin/bower_components/select2/dist/js/select2.full.min.js')?>"></script>
<!-- datepicker -->
<script src="<?= base_url('assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<script src="<?= base_url('assets/admin/bower_components/ckeditor/ckeditor.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/admin/js/adminlte.min.js')?>"></script>
<!-- colorpicker
<script src="<?= base_url('assets/admin/bower_components/raphael/raphael.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/bower_components/morris.js/morris.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
<!-- jvectormap -->
<script src="<?= base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?= base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<script src="<?= base_url('assets/admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')?>"></script>
<script src="<?= base_url('assets/admin/dist/js/') ?>owl.carousel.js"></script>    
<script>
            $(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 3,
                    nav: true,
                    loop: false,
                    margin: 20
                  }
                }
              })
            })
</script>
</body> 
</html>
<script>
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    // CKEDITOR.replace('editor1')
    // CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
  <script type="text/javascript">
   //Date picker
   $('#datepicker').datepicker({
      dateFormat: 'yy-mm-dd',
      autoclose: true,
      mminDate:-1,
      maxDate:-2
    }).attr('readonly','readonly')
    $("#from-datepicker").datepicker({ 
        format: 'dd-mm-yyyy',
        autoclose: true
    });
      // $(document).ready(function(){
      //    $('#tblTaxList').html('');
      //          $('#totalnotification').append(0);
			//    var restable = $('#mobrespons').DataTable( {
			// 	 "searching": true,
			// 	 "paging": true, 
			// 	 "info": true,         
			// 	 "lengthChange":true,
			// 	 "pageLength": 100,
			// 	rowReorder: {
			// 		selector: 'td:nth-child(1)'
			// 	},
			// 	responsive: true
			// } ); 
      //    });

          $(document).ready(function(){
                $('#shtgstock').html('');
                $('#totalshtgstock').append(0);     
         });      

        showNotification = function(obj){return false;
          alert();
          if($(obj).attr('aria-expanded') == 'true'){
              $(obj).attr('aria-expanded','false');
              $(obj).parent().removeClass('open');
          }
          else
          {
              $(obj).attr('aria-expanded','true');
              $(obj).parent().addClass('open');
          }
        }
    </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    });
</script>