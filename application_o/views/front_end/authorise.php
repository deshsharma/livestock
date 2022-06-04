<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vendor Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/vendor/images/icons/favicon.ico"/>
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
					<span class="contact3-form-title">
                        Register
					</span>
					<div class="validate-input w94 opt" data-validate="Name is required">
						<input type="hidden" value="<?= $type ?>" name="type" id="type">
						<input type="checkbox" name="auth" id="auth" placeholder="OPT">
                        I am authorised by Board of Directors/Authorised persons of the Company/Organization to register on the behalf of the company as per the letter of Authorization attached
                        </br><strong>Name and Mobile to be registered as authorized by the organization</strong>
						<!-- <span class="focus-input3"></span>
						<input type="hidden" name="detail" id="detail"> -->
					</div>
					<div class="wrap-input3 validate-input w94 mobile" data-validate="Name is required">
						<input class="input3" type="text" name="name" id="name" placeholder="Name">
						<span class="focus-input3"></span>
					</div>
					<input type="hidden" name="detail" id="detail">
					<div class="wrap-input3 validate-input w94 mobile" data-validate="Name is required">
						<input class="input3" type="number" name="mobile" id="mobile" placeholder="Mobile No">
						<span class="focus-input3"></span>
					</div>
					<div class="validate-input w94 opt" data-validate="Name is required">
					<strong>Authorization Letter</strong><a href="https://www.livestoc.com/vendor.pdf">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>See Sample</span></a>
                        </br>Bord resolution signed by both parties to register at Livestoc Business
						</br><img src="<?= base_url() ?>uploads/system/download.png" style="height: 53px;">
						<form id="uploadForm" action="upload.php" method="post">
							<input type="file" class="input3" name="pdf" id="pdf">
						</form>
						<input type="hidden" name="image_name" id="image_name">
						</br>Note: Only PDF/Images can be uploaded
						</br><input type="checkbox" name="skip" id="skip" placeholder="skip">Skip it, I will Upload it letter
						<!-- <span class="focus-input3"></span>
						<input type="hidden" name="detail" id="detail"> -->
					</div>
					<div class="container-contact3-form-btn mobile">
						<button class="contact3-form-btn stybtn1 text-center" id="sub" name="sub" value="sub">
							Next
						</button>
					</div>
					<!-- <div class="container-contact3-form-btn opt">
						<button class="contact3-form-btn stybtn1 text-center" id="verify" name="sub">Verify</button>
					</div> -->
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
			$(document).ready(function() {
				$('#pdf').change(function(){
					var file_data = $('#pdf').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
					$.ajax({
						url: "<?= base_url() ?>Api/upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							$('#image_name').val(data.data);
						}
					});
				});
			});
		$('#sub').click(function(){
			var myRedirect = function(redirectUrl, arg, value) {
                var form = $('<form action="' + redirectUrl + '" method="post">' +
                '<input type="hidden" name="type" value="' + $('#type').val() + '"></input>' +
				'<input type="hidden" name="name" value="' + $('#name').val() + '"></input>' +
				'<input type="hidden" name="mobile" value="' + $('#mobile').val() + '"></input>' +
				'<input type="hidden" name="authorisation_letter" value="' + $('#image_name').val() + '"></input>' +
				'</form>');
                $('body').append(form);
                $(form).submit();
            };
			//alert($("#mobile").val().length);
			//alert($("input[name='auth']:checkbox").prop("checked"));
			if($("input[name='auth']:checkbox").prop("checked") == false){
				alert('Please accept the statement at the top');
			}else if($("input[name='name']:text").val() == ''){
				alert('Please Fill the name Field');
			}else if($("#mobile").val() == ''){
				alert('Please Fill the Mobile No Field');
			}else if( $("#mobile").val().length < 10 || $("#mobile").val().length >10){
				alert('Please Enter Valid Mobile No');
			}else if($("input[name='skip']:checkbox").prop("checked") == false){
				if($("input[name='pdf']:file").get(0).files.length == 0){
						event.preventDefault();
						alert('Please Select file');
				}else{
					myRedirect("<?= base_url() ?>vendor", "type", type);
				}
			}else{
				myRedirect("<?= base_url() ?>vendor", "type", type);
			}
		});
		
	</script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/js/main.js"></script>
</body>
</html>