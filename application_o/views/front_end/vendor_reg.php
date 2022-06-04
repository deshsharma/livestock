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
				<form class="contact3-form validate-form"  action="" method="post" name="form" id="form"> 
					<span class="contact3-form-title">
						VENDOR REGISTRATION FORM
					</span>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<input type="hidden" name="lati" value="" id="lati">
						<input type="hidden" name="latlong" value="" id="latlong">
						<input class="input3" type="text" value="<?= isset($fname) ? $fname : $_REQUEST['name'] ?>" id="contact_person" name="contact_person" placeholder="Full Name" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="text" pattern="[0-9]{10}" value="<?= isset($mobile) ? $mobile : $_REQUEST['mobile'] ?>" id="mobile" name="mobile" placeholder="Mobile" required>
						<span class="focus-input3"></span>
					</div>
					<input type="hidden" name="type" value="<?= isset($type) ? $type : $_REQUEST['type'] ?>" id="type">
					<input type="hidden" name="authorisation_letter" value="<?= isset($authorisation_letter) ? $authorisation_letter : $_REQUEST['authorisation_letter'] ?>" id="authorisation_letter" >
					<div class="wrap-input3 validate-input w94 partnership_deed" data-validate="Name is required">
						<input class="input3" type="text" name="name" id="name" value="<?= isset($bank_name) ? $bank_name : ''?>" placeholder="Company Name" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="email" name="email" id="email" value="<?= isset($email) ? $email : $_REQUEST['email'] ?>" placeholder="Email" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="password" name="password" id="password" placeholder="Password" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94 indivisual" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="text" name="aadhar_no" id="aadhar_no" maxlength="12" value="<?= isset($aadhar_no) ? $aadhar_no : $_REQUEST['aadhar_no'] ?>" placeholder="Aadhar Number">
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="text" name="pan" id="pan" maxlength="10"  value="<?= isset($pan_no) ? $pan_no : $_REQUEST['pan'] ?>" placeholder="PAN Number" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94 partnership_deed" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="text" name="gst_no" id="gst_no" maxlength="15" value="<?= isset($gst_no) ? $gst_no : $_REQUEST['gst_no'] ?>" placeholder="GST Number" >
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94 partnership_deed" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="text" name="reg_num" maxlength="21" id="reg_num" value="<?= isset($cin) ? $cin : $_REQUEST['reg_num'] ?>" placeholder="CIN No.(Corporate Identity Number)" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="text" name="full_address" id="full_address" value="<?= isset($address) ? $address : $_REQUEST['full_address'] ?>" placeholder="Address Line 1" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="text" name="full_address1" id="full_address1" value="<?= isset($address1) ? $address1 : $_REQUEST['full_address1'] ?>" placeholder="Address Line 2" >
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
					<?php $state = $this->api_model->get_state("99"); 
					//print_r($state);
					?>
						<select name="state" id="state" class="selection-2 state" required>
							<option value="">Select State</option>
							<?php 
							foreach($state as $st){ ?>
								<option value="<?= $st['zone_id'] ?>"><?= $st['name'] ?></option>
							<?php } 
							?>
						</select>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<select name="district" id="district" class="selection-2 city" required>
							<option value="">Select District</option>
						</select>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input3" type="text"name="pincode" max="999999" id="pincode" value="<?= isset($pin) ? $pin : $_REQUEST['pincode'] ?>" placeholder="Pin Code" required>
						<span class="focus-input3"></span>
					</div>
                    <div class="validate-input w94" data-validate="Name is required">
						<div class="box js">
							<input type="file" name="address_doc" id="address_doc" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"  />
							<label for="address_doc"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="address_doc_image_name">Upload Utility Bill/Rent Deed&hellip;</span></label>
							<input type="hidden" name="address_doc_image" id="address_doc_image" >
						</div>
					<div class="validate-input w94 indivisual" data-validate="Name is required">
						<div class="box js">
								<input type="file" name="aadhar_image" id="aadhar_image" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"  multiple/>
								<label for="aadhar_image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="aadhar_image_name">Upload Aadhar Card Front Image&hellip;</span></label>
								<input type="hidden" name="aadhar_image_image" id="aadhar_image_image" >
						</div>
					</div>
					<div class="validate-input w94 indivisual" data-validate="Name is required">
						<div class="box js">
								<input type="file" name="aadhar_image_back" id="aadhar_image_back" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"  multiple/>
								<label for="aadhar_image_back"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="aadhar_image_back_name">Upload Aadhar Card Back Image&hellip;</span></label>
								<input type="hidden" name="aadhar_image_back_image" id="aadhar_image_back_image" >
						</div>
					</div>
                    </div>
					<div class="validate-input w94 partnership_deed" data-validate="Name is required">
						<div class="box js">
							<input type="file" name="partnership_deed" id="partnership_deed" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"/>
							<label for="partnership_deed"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="partnership_deed_image_name">Upload Partnership Deed&hellip;</span></label>
							<input type="hidden" name="partnership_deed_image" id="partnership_deed_image" value="">
						</div>
                    </div>
					<div class="validate-input w94 partnership_deed" data-validate="Name is required">
						<div class="box js">
								<input type="file" name="reg_certificate" id="reg_certificate" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"  />
								<label for="reg_certificate"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="reg_certificate_image_name">Upload CIN No.(Corporate Identity Number)&hellip;</span></label>
								<input type="hidden" name="reg_certificate_image" id="reg_certificate_image" value="">
						</div>
					</div>
					<div class="container-contact3-form-btn">
						<button class="contact3-form-btn stybtn1 text-center" name="sub" id="sub">
							Submit
						</button>
					</div>
				</form>
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
	$( document ).ready(function() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
	function showPosition(position) {
		$('#lati').val(position.coords.latitude); 
		$('#latlong').val(position.coords.longitude);
	}
			$('.opt').hide();
			$('#mobile').prop("readonly", true);	
			if($('#authorisation_letter').val() != ''){
				$('#contact_person').prop("readonly", true);
			}
			if($('#type').val() == 'public'){
				$('#partnership_deed_image_name').html('');
				$('#partnership_deed_image_name').html('AOA or MOA upload');
			}
			if($('#type').val() == 'gov'){
				$('#partnership_deed_image_name').html('');
				$('#partnership_deed_image_name').html('AOA or MOA upload');
			}
			if($('#type').val() == 'indivisual' || $('#type').val() == 'dev'){
				//alert();
				$('#partnership_deed').removeAttr('required');
				$('#name').removeAttr('required');
				$('#reg_num').removeAttr('required');
				$('#aadhar_no').attr('required','required');
				$('.partnership_deed').hide();
			}else{
			//if($('#type').val() == 'partnership'){
				//alert();
				$('#gst_no').attr('required','required');
				$('#name').attr('required','required');
				$('#reg_num').attr('required','required');
				$('.indivisual').hide();
			}
		});
	//$('.select2-container--focus').hide();
	$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	$('#form').on('submit',function(e){
		if($('#type').val() == 'indivisual' || $('#type').val() == 'dev'){
			if(!$('#aadhar_no').val().match('^[0-9]+$')){
				e.preventDefault();
				alert('Please Fill Valid aadhar No');
			}
		}else{
			if(!$('#gst_no').val().match('^[0-9a-zA-Z]+$')){
				e.preventDefault();
				alert('Please Fill Valid GST No');
			}
			if(!$('#reg_num').val().match('^[0-9a-zA-Z]+$')){
				e.preventDefault();
				alert('Please Fill Valid CIN No');
			}
		}
		if(!$('#pan').val().match('^[0-9a-zA-Z]+$')){
			e.preventDefault();
			alert('Please Fill Valid PAN No');
		}else if(!$('#pincode').val().match('^[0-9]+$')){
			e.preventDefault();
			alert('Please Fill Valid PIN No');
		}
		
		// if($('#mobile').val() == ''){
		// 	e.preventDefault();
		// 	alert('Please Fill the Mobile Field');
		// }else if(!$('#mobile').match('[0-9]{10}')){
		// 	e.preventDefault();
		// 	alert('Please Fill Valid Mobile number');
		// }else if($('#contact_person').val() == ''){
		// 	e.preventDefault();
		// 	alert('Please Fill the Contact Person Field');
		// }else if($('#email').val() == ''){
		// 	e.preventDefault();
		// 	alert('Please Fill the Email Field');
		// }else if($('#password').val() == ''){
		// 	e.preventDefault();
		// 	alert('Please Fill the Password Field');
		// }else if($('#phone').val() == ''){
		// 	e.preventDefault();
		// 	alert('Please Fill the Phone Field');
		// }else if(!$('#phone').match('[0-9]{10}')){
		// 	e.preventDefault();
		// 	alert('Please Fill Valid Phone number');
		// }else if($('#pan').val() == ''){
		// 	e.preventDefault();
		// 	alert('Please Fill the Pan NO Field');
		// }else if(!num_alpha($('#pan').val()) == ''){
		// 	e.preventDefault();
		// 	alert('Please Fill Valid Pan NO');
		// }else{
		// 	e.preventDefault();
		// }
	})
	 $('.state').change(function(){
                $.ajax({
                url: "<?= base_url() ?>api/get_city?state_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data;
                    var option = '<option value="">Select District</option>';
			                            $.each(str.data, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			                            }); 
                                        $('.city').html(option);
										
                }
                });
        })
		$(document).ready(function() {
				$('#aadhar_image').on('change',function(){
					$('#aadhar_image_name').html('');
					$('#aadhar_image_name').html($('#aadhar_image')[0].files[0].name);
					var file_data = $('#aadhar_image').prop('files')[0];   
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
							$('#aadhar_image_image').val(data.data);
						}
					});
				});
		});
		$(document).ready(function() {
				$('#aadhar_image_back').change(function(){
					$('#aadhar_image_back_name').html('');
					$('#aadhar_image_back_name').html($('#aadhar_image_back')[0].files[0].name);
					var file_data = $('#aadhar_image_back').prop('files')[0];   
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
							$('#aadhar_image_back_image').val(data.data);
						}
					});
				});
		});
		$(document).ready(function() {
				$('#address_doc').change(function(){
					$('#address_doc_image_name').html('');
					$('#address_doc_image_name').html($('#address_doc')[0].files[0].name);
					var file_data = $('#address_doc').prop('files')[0];   
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
							$('#address_doc_image').val(data.data);
						}
					});
				});
		});
		$(document).ready(function() {
				$('#partnership_deed').change(function(){
					$('#partnership_deed_image_name').html('');
					$('#partnership_deed_image_name').html($('#partnership_deed')[0].files[0].name);
					var file_data = $('#partnership_deed').prop('files')[0];   
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
							$('#partnership_deed_image').val(data.data);
						}
					});
				});
		});
		$(document).ready(function() {
				$('#reg_certificate').change(function(){
					$('#reg_certificate_image_name').html('');
					$('#reg_certificate_image_name').html($('#reg_certificate')[0].files[0].name);
					var file_data = $('#reg_certificate').prop('files')[0];   
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
							$('#reg_certificate_image').val(data.data);
						}
					});
				});
		});
	</script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/vendor/js/main.js"></script>
</body>
</html>