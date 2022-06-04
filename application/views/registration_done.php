<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="<?= base_url() ?>assets/front_end/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front_end/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="bg-contact3" style="background:ececec;">
		<div class="container-contact3">
			<div class="wrap-contact3">
				<form class="contact3-form validate-form">
					<span class="contact3-form-title">
						

						<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>Registration Done
					</span>


				</form>
			</div>
		</div>
	</div>










	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="<?= base_url() ?>assets/front_end/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/front_end/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url() ?>assets/front_end/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/front_end/vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>assets/front_end/js/main.js"></script>

</body>
</html>
