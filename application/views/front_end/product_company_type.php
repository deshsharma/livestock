<!DOCTYPE html>
<html lang="en">
<head>
	<title>Become a Vendor of Animal Health Care Products & Veterinary Services at Livestoc </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/home/images/favicon4.png"/>
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
	<meta name="description" content=" Become a Vendor at Livestoc.com. Sell and Buy your animals from Livestoc.com. Register yourself as Veterinary Doctor and become the part of the Best Veterinarians in India. Sell Your Animal Health Care Products at Livestoc " />
<!--===============================================================================================-->
</head>
<body>

<div class="bg-contact3" style="background:#7c7c7c;">
		<div class="container-contact3">
			<div class="wrap-contact3">
					<span class="contact3-form-title">
						Register
					</span>
					<input type="hidden" name="detail" id="detail">
					<input type="hidden" name="image_name" id="image_name">
					<div class="wrap-contact3-form-radio">
						<div class="contact3-form-radio mR40">
							<input class="input-radio3" id="radio1" type="radio" name="type" value="indivisual" checked="checked">
							<label class="label-radio3" for="radio1">	
							Individual/Proprietor
							</label>
						</div>

						<div class="contact3-form-radio mR40">
							<input class="input-radio3" id="radio2" type="radio" name="type" value="partnership">
							<label class="label-radio3" for="radio2">
							Partnership Company
							</label>
						</div>

						<div class="contact3-form-radio mR40">
							<input class="input-radio3" id="radio3" type="radio" name="type" value="public">
							<label class="label-radio3" for="radio3">
								Public/Private Limited Company
							</label>
						</div>

						<div class="contact3-form-radio mR40">
							<input class="input-radio3" id="radio4" type="radio" name="type" value="gov">
							<label class="label-radio3" for="radio4">
								Govt/Semi-Govt Undertaking
							</label>
						</div>
						
					</div>
					<div class="company">
								<div class="new">
											<div class="form-group">
											<input type="checkbox" id="s201" name="auth" required>
											<label for="s201" id="lable"> I am authorised by Board of Directors/Authorised persons of the Company/ Organization to register at livestoc Business App on the behalf of the registering company as per the letter of Authorization attached</label>
											</div>
										</div>
										<div class="wrap-input3 validate-input w94" data-validate="Name is required">
											<input class="input3" type="text" name="name" id="name" placeholder="Name" required>
											<span class="focus-input3"></span>
										</div>
										<div class="wrap-input3 validate-input w94" data-validate="Name is required">
											<input class="input3" type="text" name="mobile" id="mobile" placeholder="Mobile Number (Official Mobile Number authorised by Company)" required>
											<span class="focus-input3"></span>
										</div>
										<p>Authorization Letter (Board resolution signed by authorised persons of the company to register at Livestoc Business)<span class="required"></span></p>
										<p><a href="https://www.livestoc.com/vendor.pdf" target="_blank">See Sample<span class="required"></span></a></p>
										<div class="validate-input w94" data-validate="Name is required">
										<div class="box js">
										<input type="file" name="pdf" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" required />
										<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="file_name">Upload Authorization Letter&hellip;</span></label>
									</div>
									</div>
									<p class="black"><strong>NOTE :</strong> Only PDF/Image file must be uploaded<span class="required"></span></p>

									<div class="new">
										<div class="form-group mt60 float">
										<input type="checkbox" name="skip" id="s202">
										<label for="s202">I will upload later.</label>
										</div>
								</div>
					</div>
					<div class="container-contact3-form-btn">
						<button class="contact3-form-btn stybtn1 text-center submit">
							Submit
						</button>
					</div>
			</div>
		</div>
	</div>










	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url() ?>assets/vendor/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/vendor/select2/select2.min.js"></script>
	<script>
	$(document).ready(function() {
				$('#file-1').change(function(){
					$('#file_name').html('');
					$('#file_name').html($('#file-1')[0].files[0].name);
					var file_data = $('#file-1').prop('files')[0];   
					var form_data = new FormData();                  
					form_data.append('image', file_data);
					$.ajax({
						url: "<?= base_url() ?>Api/web_upload_Images?path=bank",
						type: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							data = JSON.parse(data);
							$('#image_name').val(data.data);
						}
					});
				});
	});
	$(document).ready(function(){
		$('.company').hide();
		$('#s201').removeAttr('required');
		$('#name').removeAttr('required');
		$('#mobile').removeAttr('required');
		$('#pdf').removeAttr('required');
	})
	$("input[type='radio']").click(function(){
		if(this.value != 'indivisual'){
			$('.company').show();
			$('#s201').attr('required','required');
			$('#name').attr('required','required');
			$('#mobile').attr('required','required');
			$('#pdf').attr('required','required');
			$("#s202").attr('required','required');
		}
		if(this.value == 'indivisual' || this.value == 'dev'){
			$('.company').hide();
			$('#s201').removeAttr('required');
			$('#name').removeAttr('required');
			$('#mobile').removeAttr('required');
			$('#pdf').removeAttr('required');
			$("#s202").removeAttr('required');
		}
		// if(this.value == 'partnership'){
		// 	alert();
		// }
	})
	// $('#file-1').on('change', function(){
	// 	$('#file_name').html('');
	// 	$('#file_name').html($('#file-1')[0].files[0].name);
	// })
	// $("#s202").click(function(){
	// 	if($("input[name='skip']:checkbox").prop("checked") == true){
	// 		$("#s202").removeAttr('required');
	// 	}else{
	// 		$("#s202").attr('required','required');
	// 	}
	// })
	var myRedirect = function(redirectUrl, arg, value) {
                var form = $('<form action="' + redirectUrl + '" method="post">' +
                '<input type="hidden" name="'+ arg +'" value="' + value + '"></input>' + '</form>');
                $('body').append(form);
                $(form).submit();
    };
	var myRedirect1 = function(redirectUrl, arg, value) {
                var form = $('<form action="' + redirectUrl + '" method="post">' +
                '<input type="hidden" name="type" value="' + $("input[type='radio']:checked").val() + '"></input>' +
				'<input type="hidden" name="name" value="' + $('#name').val() + '"></input>' +
				'<input type="hidden" name="mobile" value="' + $('#mobile').val() + '"></input>' +
				'<input type="hidden" name="authorisation_letter" value="' + $('#image_name').val() + '"></input>' +
				'</form>');
                $('body').append(form);
                $(form).submit();
            };
	$('.submit').click(function(){
		var val = $("input[type='radio']:checked").val();
		if(val == 'indivisual' || val == 'dev'){
			myRedirect("<?= base_url() ?>vendor/product_otp", "type", val);
		}else{
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
					//alert($('#file-1').val())
					//alert($('#file-1')[0].files[0].name);
					myRedirect1("<?= base_url() ?>vendor/product_otp", "type", val);
				}
			}else{
				myRedirect1("<?= base_url() ?>vendor/product_otp", "type", val);
			}
		}
	});
	</script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/js/main.js"></script>

</body>
</html>
