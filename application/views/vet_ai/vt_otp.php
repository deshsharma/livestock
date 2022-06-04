<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vendor Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<!-- <link rel="icon" type="image/png" href="<?= base_url() ?>assets/vendor/images/icons/favicon.ico"/> -->
	<link rel="icon" href="<?= base_url() ?>assets/home/images/favicon4.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/css/main.css">
<!--===============================================================================================-->
</head>
<body>
<div class="bg-contact3" style="background:#7c7c7c;">
		<div class="container-contact3">
			<div class="wrap-contact3">
					<span class="contact3-form-title text-left title">
						Enter Mobile Number
					</span>
					<div id="divOuter" class="otp">
						<div id="divInner">
							<input id="partitioned" type="text" maxlength="6" />
						</div>
					</div>
					<span class="forsuffix mobile">+91</span> 
					<input type="hidden" name="detail" id="detail">
					<input type="hidden" name="type" value="pvt_vt" id="type">
					<input type="hidden" name="name" value="<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : '' ?>" id="name">
					<input type="hidden" name="authorisation_letter" value="<?= isset($_REQUEST['authorisation_letter']) ? $_REQUEST['authorisation_letter'] : '' ?>" id="authorisation_letter">
					<div id="divOuter1" class="mobile">
						<div id="divInner1">
							<input id="partitioned1" name="mobile" value="<?= isset($_REQUEST['mobile']) ? $_REQUEST['mobile'] : '' ?>" type="text" maxlength="10" />
						</div>
					</div>

					<div class="container-contact3-form-btn1 mobile">
						<button class="contact3-form-btn stybtn1" id="sub" name="sub">
							Send OTP
						</button>
					</div>
					<div class="container-contact3-form-btn1 otp">
						<button class="contact3-form-btn stybtn1"  id="verify" name="sub">
							Verify
						</button>
					</div>
		</div>
	</div>
</body>
<!--===============================================================================================-->
<script src="<?= base_url() ?>assets/vendor/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url() ?>assets/vendor/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/vendor/select2/select2.min.js"></script>
	<script>
		$( document ).ready(function() {
			$('.otp').hide();
			if($('#name').val() != ''){
				//alert();
				$('#partitioned1').prop("disabled", true);
			}
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
				$.ajax({
					url: "https://www.livestoc.com/Vendor/request_for_otp?opt="+opt+"&detail="+detail,
					cache: false,
					success: function(html){
						var data = JSON.parse(html);
						$.each(data, function(index, item){
							if(item.Status == 'Success'){
								myRedirect("<?= base_url() ?>vetai/registration", "type", type);
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
					url: "https://www.livestoc.com/Vendor/request_for_otp?mobile="+mobile,
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
		});
		
	</script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/js/main.js"></script>
</body>
</html>