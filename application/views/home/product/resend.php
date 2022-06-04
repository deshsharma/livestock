<link rel="stylesheet" href="<?= base_url('assets/product/') ?>css/main2.css">
 <section class="ftco-section ftco-cart bg_gradient">
      <div class="container">
        <div class="row">  
            <div class="col-12 col-md-6 offset-md-3 mb-5 mt-5 mt-sm-0 mt-md-0">
                <div class="login100-form validate-form bg-white p-4 p-md-5 rounded minh-login">
                  <span class="login100-form-title p-b-26 text-left mobile">
                    Your OTP will be sent to this number
                  </span>
                  <span class="login100-form-title p-b-26 text-left otp" style="display: none;">
                    Please enter 6-digit OTP we sent via SMS
                  </span>
                      <div class="row mt-4"> 
                        <input type="hidden" name="detail" id="detail">
                        <input type="hidden" name="users_id" id="users_id">
                          <div class="col-12 col-md-12 mobile">    
                            <form class="contact3-form validate-form">
                              <span class="forsuffix">+91</span> 
                              <div id="divOuter2">
                                <div id="divInner2">
                                 <input id="partitioned1" name="mobile" type="text" maxlength="10" />
                                </div>
                              </div>
                            </form>
                          </div>       
                          <div class="col-12 col-md-12 otp" style="display: none;">    
                            <form class="contact3-form validate-form">
                              <div id="divOuter1">
                                <div id="divInner1">
                                  <input id="partitioned" type="text" maxlength="6" />
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="col-12 col-md-6 mt-3">    
                              <div class="container-login100-form-btn">
                                <div class="wrap-login100-form-btn">
                                  <div class="login100-form-bgbtn"></div>
                                  <button class="login100-form-btn mobile" id="sub" name="sub">
                                    Send OTP
                                  </button>
                                  <button class="login100-form-btn otp" id="verify" name="sub" style="display: none;">
                                    submit OTP
                                  </button>
                                </div>
                              </div>      
                            </div>   
                        </div>
                    </div>
                    
              </div>    
          </div>
      </div>
      </div>                      
               
      </div>
     </div>
  </section>
  <script>
    $( document ).ready(function() {
      // $('.otp').hide();
      // if($('#name').val() != ''){
      //   //alert();
      //   $('#partitioned1').prop("disabled", true);
      // }
    });
    $('#verify').click(function(){
      var myRedirect = function(redirectUrl, arg, value) {
                var form = $('<form action="' + redirectUrl + '" method="post">' +
                '<input type="hidden" name="type" value="' + $('#type').val() + '"></input>' +
        '<input type="hidden" name="name" value="' + $('#name').val() + '"></input>' +
        '<input type="hidden" name="mobile" value="' + $('#partitioned1').val() + '"></input>' +
        '<input type="hidden" name="authorisation_letter" value="' + $('#authorisation_letter').val() + '"></input>' +
        '</form>');
                $('body').append(form);
                $(form).submit();
            };
      var opt = $('#partitioned').val();
      var detail = $('#detail').val();
      if(opt == ''){
        alert('Please Enter OPT');
      }else{
        var users_id = $('#users_id').val();
        $.ajax({
          url: "https://www.livestoc.com/harpahu_dhyan/Vendor/request_for_otp?opt="+opt+"&detail="+detail,
          cache: false,
          success: function(html){
            var data = JSON.parse(html);
            $.each(data, function(index, item){
              if(item.Status == 'Success'){
                window.location.href ='<?= base_url('frontend/reset_pass/') ?>'+users_id;
              }else{
                alert(item.Details);
              }
            });
          }
        });
      }
    });
    $('#sub').click(function(){
      var mobile = $('#partitioned1').val();
      if(mobile == ''){
        alert('Please fill the Mobile');
      }else{
        $.ajax({
          url: "https://www.livestoc.com/harpahu_merge_dev/api/get_mobile_status?mobile="+mobile,
          cache: false,
          success: function(html){
            console.log(html);
            var data = JSON.parse(html);
            if(data.succ == '0'){
              alert('Your No is Not Exists in our database Please Register with us')
              window.location.href ='<?= base_url('frontend/login')?>';
            }else{
              $('#users_id').val(data.succ[0].users_id);
                    $.ajax({
                    url: "https://www.livestoc.com/harpahu_dhyan/Vendor/request_for_otp?mobile="+mobile,
                    cache: false,
                    success: function(html){
                      var data = JSON.parse(html);
                        $.each(data, function(index, item){
                          if(item.Status == 'Success'){
                              $('#detail').val(item.Details);
                              $('.otp').show();
                              $('.mobile').hide();
                              $('.title').html('Please enter 6-digit OTP we sent via SMS');
                          }else{
                            alert(item.Details)
                          }
                        });
                      }
                    });
            }
          }
        });
      }
    });
    
  </script>
  <!-- <link rel="stylesheet" href="<?= base_url('assets/product/') ?>css/main.css"> -->
<?php include('footer.php') ?>
