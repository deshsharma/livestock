<?php
if($this->session->userdata('status')== '1'){
      // if($this->session->userdata('fif_status') == '1')
      // {
      //   header('Location: '.base_url('fif'));
      //   exit;
      // }else{
        header('Location: '.base_url('admin/dashboard'));
      //   exit;
      // }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head><title>Sign in</title><!-- META SECTION -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<!-- END META SECTION --><!-- CSS INCLUDE --><link rel="stylesheet" href="<?= base_url('assets/main/assets/css/styles.css')?>"><!-- EOF CSS INCLUDE -->
</head>
<body><!-- APP WRAPPER -->
<div class="app app-fh"><!-- START APP CONTAINER -->
<div class="app-container" style="background: url(<?= base_url('assets/admin/img/__bg_admin.jpg')?>) center center no-repeat fixed; background-size: cover;">
<div class="app-login-box"><div class="app-login-box-title ">

<div class="app-login-box-container ">
<div class="row">
<div class="col-md-12" style="padding:0px !important">
   <?= anchor('user/','<button class="btn btn-facebook btn-block">Login In</button>') ?> 
</div>
<!-- <div class="col-md-6" style="padding:0px !important">
   <?= anchor('user/usre_sign_up','<button class="btn btn-twitter btn-block">Sign Up</button>') ?>
</div> -->


</div>
<div class="app-login-box-container margin-top-20">
 <?php echo form_open('#', ['id'=>'frm_login']) ?>
  <?php if( $error = $this->session->flashdata('login_failed')): ?>
      <div class="callout callout-danger">
                                <?= $error ?>
          </div>
        <?php endif; ?>
<?php echo form_error('username'); ?>
<div class="form-group">
<?php echo form_input(['name'=>'username','class'=>'form-control new_form', 'id'=>'uname', 'placeholder'=>'User Name/Mobile No', 'required'=>'required', 'oninvalid'=>"this.setCustomValidity('Username cannot be blank')", 'oninput'=>"setCustomValidity('')" ]); ?>
</div>
 <?php echo form_error('password'); ?>
<div class="form-group">
 <?php echo form_password(['name'=>'password','id'=>'password','class'=>'form-control new_form','placeholder'=>'Password', 'required'=>'required', 'oninvalid'=>"this.setCustomValidity('Password cannot be blank')", 'oninput'=>"setCustomValidity('')" ]) ?>
</div>
<div class="form-group">
  <button id="btnLogin" class="btn btn-success btn-block">Login</button>
</div>
</form>
</div>
<div class="app-login-box-footer"><a href="<?= base_url('user/forget'); ?>" style="color:#FFF;">Forget Password?</a></br><?= anchor('','Cancel', array('style'=>'color:#FFF; float:right;')) ?></div>
</div></div><!-- END APP CONTAINER --></div>
<script type="text/javascript" src="<?= base_url('assets/main/assets/js/vendor/jquery/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/main/assets/js/vendor/bootstrap/bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/main/js/ajaxloader.js')?>"></script>
<script type="text/javascript">
 $(document).ready(function() {
        $('#btnLogin').on('click',function(event){
                if($('#uname, #password').val()!='')
                  {
                    event.preventDefault();
                       ajaxloader.loadURL("<?php echo base_url('login/admin_login') ?>",$('#frm_login').serialize(), function(resp){
                        var data = resp;
                        if(data['error']=='1'){   
                           $('#frm_login').find('.text-danger').remove();
                           $('#uname').before("<p class='text-danger'>Invalid Username/Password.</p>");
                           return false;
                        }
                        // else if(data['error']=='2'){
                        //   window.location="<?php echo base_url('fif'); ?>"
                        // }
                        else{
                             window.location = "<?php echo base_url('class_public/dashboard') ?>";
                        }
                       });
                  }
        });
  });
function switchVisible() {
            if (document.getElementById('Div1')) {

                if (document.getElementById('Div1').style.display == 'none') {
                    document.getElementById('Div1').style.display = 'block';
                    document.getElementById('Div2').style.display = 'none';
                }
                else {
                    document.getElementById('Div1').style.display = 'none';
                    document.getElementById('Div2').style.display = 'block';
                }
            }
}
</script>
</body>
</html>