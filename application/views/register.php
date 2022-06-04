<!DOCTYPE html>
<html lang="en">
<head>
	<title> Register For Buying & Selling of Animals, Animal Health Care Products & Veterinary Services at Livestoc </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/home/images/favicon4.png"/>
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
	<meta name="description" content=" Register as a Seller and Buyer of Animals at Livestoc.com. You can also register your self as a Seller of Animal Health Care Products and Veterinary Service Providers at Livestoc.com. " />
<!--===============================================================================================-->
</head>
<body>

	<div class="bg-contact3" style="background:ececec;">
		<div class="container-contact3">
			<div class="wrap-contact3">
				<form class="contact3-form validate-form" method="post" enctype='multipart/form-data'>
					<span class="contact3-form-title">
						Registration for Listing
					</span>
					<div class="row">
					<div class="wrap-input3 validate-input">
						<div class="col-md-12"><?php echo form_error('cat'); ?></div>
							<div>
								<?php $data = $this->front_end_model->get_product_category(); ?>
								<select class="selection-2 " name="cat" required>
									<option value="">Select Category</option>
									<?php foreach($data as $d){ ?>
										<option value="<?= $d['id'] ?>"><?= $d['cat_name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<span class="focus-input3"></span>
						</div>
					</div>
					<div class="wrap-contact3-form-radio">
                    <div class="col-md-12"><?php echo form_error('choice'); ?></div>
						<div class="contact3-form-radio m-r-42">
							<input class="input-radio3" id="radio1" type="radio" name="choice" value="Manufacturer" checked="checked">
							<label class="label-radio3" for="radio1">
								Manufacturer
							</label>
						</div>

						<div class="contact3-form-radio m-r-42">
							<input class="input-radio3" id="radio2" type="radio" name="choice" value="Trader">
							<label class="label-radio3" for="radio2">
								Trader
							</label>
						</div>

						<div class="contact3-form-radio m-r-42">
							<input class="input-radio3" id="radio3" type="radio" name="choice" value="Distributor">
							<label class="label-radio3" for="radio3">
								Distributor
							</label>
						</div>

						<div class="contact3-form-radio m-r-42">
							<input class="input-radio3" id="radio4" type="radio" name="choice" value="Dealer">
							<label class="label-radio3" for="radio4">
								Dealer
							</label>
						</div>
					</div>

					<div class="wrap-input3 validate-input w94" data-validate="Name is required">
                        <div class="col-md-12"><?php echo form_error('name'); ?></div>
						<input class="input3" type="text" name="name" placeholder="Company Name" required>
						<span class="focus-input3"></span>
					</div>

					<div class="wrap-input3 validate-input" data-validate="Addr is required">
                    <div class="col-md-12"><?php echo form_error('address1'); ?></div>
						<input class="input3" type="text" name="address1" placeholder="Address Line 1" required>
						<span class="focus-input3"></span>
					</div>

					<div class="wrap-input3 validate-input" data-validate="Addr is required">
                        <div class="col-md-12"><?php echo form_error('address2'); ?></div>
						<input class="input3" type="text" name="address2" placeholder="Address Line 2">
						<span class="focus-input3"></span>
					</div>

					<div class="wrap-input3 validate-input" data-validate="Addr is required">
                    <div class="col-md-12"><?php echo form_error('address3'); ?></div>  
						<input class="input3" type="text" name="address3" placeholder="Address Line 3">
						<span class="focus-input3"></span>
					</div>
                    <div class="wrap-input3 validate-input">
                    <div class="col-md-12"><?php echo form_error('state'); ?></div>
						<div>
                            <?php $data = $this->front_end_model->get_state(); ?>
							<select class="selection-2 state" name="state" required>
                                <option value="">State</option>
                                <?php foreach($data as $d){ ?>
                                    <option value="<?= $d['state_id'] ?>"><?= $d['state_name'] ?></option>
                                <?php } ?>
							</select>
						</div>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input">
                    <div class="col-md-12"><?php echo form_error('city'); ?></div>
						<div>
							<select class="selection-2 city" name="city" required>
								<option value="">City</option>
							</select>
						</div>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input" data-validate="Addr is required">
                    <div class="col-md-12"><?php echo form_error('pin'); ?></div>
						<input class="input3" type="text" name="pin" placeholder="Pin Code" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input" data-validate="Addr is required">
                    <div class="col-md-12"><?php echo form_error('mobilr'); ?></div>
						<input class="input3" type="number" name="mobilr" pattern="[0-9]{10}" MAXLENGTH="10" placeholder="Mobile Number 1" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input" data-validate="Addr is required">
                    <div class="col-md-12"><?php echo form_error('mobilr1'); ?></div>
						<input class="input3" type="number" name="mobilr1" pattern="[0-9]{10}" MAXLENGTH="10" placeholder="Mobile Number 2" >
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input" data-validate="Addr is required">
                    <div class="col-md-12"><?php echo form_error('land_line'); ?></div>
						<input class="input3" type="text" name="land_line" placeholder="LandLine Number 1">
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input" data-validate="Addr is required">
                    <div class="col-md-12"><?php echo form_error('land_line'); ?></div>
						<input class="input3" type="text" name="land_line1" placeholder="LandLine Number 2">
						<span class="focus-input3"></span>
					</div>

					<div class="wrap-input3 validate-input w94" data-validate="Addr is required">
                    <div class="col-md-12"><?php echo form_error('contact_person'); ?></div>
						<input class="input3" type="text" name="contact_person" placeholder="Contact Person" required>
						<span class="focus-input3"></span>
					</div>
					<div class="wrap-input3 validate-input w94" data-validate="Addr is required">
						<input class="input3" type="text" name="desc" placeholder="Description">
						<span class="focus-input3"></span>
						 <div class="col-md-12"><?php echo form_error('desc'); ?></div>
						<textarea id="desc" name="desc" rows="1" cols="">
						</textarea>
					</div>
					<div class="wrap-input3 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <div class="col-md-12"><?php echo form_error('email'); ?></div>
						<input class="input3" type="email" name="email" placeholder="Your Email ID 1" required>
						<span class="focus-input3"></span>
					</div>
					
					<div class="wrap-input3 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <div class="col-md-12"><?php echo form_error('email2'); ?></div>
						<input class="input3" type="text" name="email2" placeholder="Your Email ID 2">
						<span class="focus-input3"></span>
					</div>

					<div class="new">
							<p>Your Product is for:<span class="required"></span></p>
							<div class="form-group">
							<input type="checkbox" id="s201" class="sell_all">
							<label for="s201">Select All</label>
							</div>
							<?php $data = $this->front_end_model->get_product_section(); ?>
							<?php foreach($data as $d){ ?>
							<div class="form-group">
							<input type="checkbox" name="section[]" id="p<?= $d['id'] ?>" value="<?= $d['id'] ?>">
							<label for="p<?= $d['id'] ?>"><?= $d['sec_name'] ?></label>
							</div>
							<?php } ?>
					</div>

					<div class="new-row">
					<div class="col50">
								<div class="mb5 copy after-add-more">
									<div class="wrap-input3 validate-input" data-validate="Addr is required">
										<input class="input3" type="text" name="product[]" placeholder="Products" required>
										<span class="focus-input3"></span>
									</div>
								</div>
							<div class="validate-input mb am">
							<a class="add-more" >Add More <i class="fa fa-plus-square" aria-hidden="true"></i></a>
							</div>
					</div>
					
					<div class="col50">
								<div class="mb5 copy2 after-add-more2">
										<div class="wrap-input3 validate-input" data-validate="Addr is required">
											<input class="input3" type="text" name="brand[]" placeholder="Brand" required>
											<span class="focus-input3"></span>
										</div>
								</div>
					<div class="validate-input mb am">
					<a class="add-more2">Add More <i class="fa fa-plus-square" aria-hidden="true"></i></a>
					</div>
					</div>
					</div>
					
<div class="new">
<div class="col-md-12"><?php echo form_error('s'); ?></div>
	<p>Product Availability in :<span class="required">*</span></p>
	<div class="form-group">
      <input type="checkbox" name="sell_all" id="sell_all" class="sell_all">
      <label for="sell_all">Select All</label>
    </div>
    <?php $data = $this->front_end_model->get_state(); ?>
    <?php foreach($data as $d){ ?>
    <div class="form-group">
      <input type="checkbox" name="s[]" id="s<?= $d['state_id'] ?>" value="<?= $d['state_id'] ?>">
      <label for="s<?= $d['state_id'] ?>"><?= $d['state_name']?></label>
    </div>
    <?php } ?>
</div>

<!-- <div class="new mt80">
    <div class="form-group" style="width: 100%;">
    <?php echo form_error('sapp'); ?>
      <input type="checkbox" id="sapp" value="1" name="sapp">
      <label for="sapp"><span style="color:#000;">I am intersted in upgrading to premium listing; sales team can contact me.</span></label>
    </div>
</div> -->
<div class="new-row">
<span class="contact3-form-title1">Select</span>

					<div class="wrap-contact3-form-radio pb15">
						<div class="contact3-form-radio mR40">
							<input class="input-radio3" id="radio31" type="radio" name="user_type" value="1" checked="checked">
							<label class="label-radio3" for="radio31">
								Premium Listing<span style="font-size:13px;"><br>(Only Rs 12000 + Taxes for 1 year)</span>
							</label>
						</div>

						<div class="contact3-form-radio ml2">
							<input class="input-radio3" id="radio32" type="radio" name="user_type" value="0">
							<label class="label-radio3" for="radio32">
								Free Listing
							</label>
						</div>
					</div>
</div>
<div class="new-row">
	<div class="col-6 new-row-left pad0">
		<img src="<?= base_url() ?>/assets/images/premium_listing.jpg" alt="list">
	</div>
	<div class="col-6 new-row-left pad0 ml15">
		<img src="<?= base_url() ?>/assets/images/free_listing.jpg" alt="list">
	</div>
</div>
<div class="new-row mt20">
	<p>Please upload packaging images.
		<span><input type="file" name="register[]" class="btn2 text-center" multiple></span>
	</p>
</div>	





					<div class="container-contact3-form-btn ">
						<button class="btn btn-danger" name="sub">
							Submit
						</button>
					</div>
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
    <script type="text/javascript">
        $(document).ready(function() {
			$(".sell_all").click(function(){
				var checked = !$(this).data('checked');
				$(this).parent().parent().find('input:checkbox').prop('checked', checked);
				$(this).val(checked ? 'uncheck all' : 'check all' )
				$(this).data('checked', checked);
				// if($(this). prop("checked") == true){
				// 	//alert('true');
				// 	$(this).parent().parent().find('input:checkbox').attr("checked", true);
				// 	//$(this).parent().parent().find('input:checkbox').prop('checked', $(this).prop("checked"));
				// }else{
				// 	$(this).parent().parent().find('input:checkbox').attr("checked", false);
				// }
			});
            $(".add-more").click(function(){ 
				//$( ".copy" ).clone().prependTo( ".after-add-more" );
                var html = $(".copy").html();
                $(".after-add-more").after(html);
				$(".after-add-more").siblings().find('input').removeAttr('required');
            });
            $("body").on("click",".remove",function(){ 
                $(this).parents(".control-group").remove();
            });
            $(".add-more2").click(function(){ 
                var html = $(".copy2").html();
                $(".after-add-more2").after(html);
				$(".after-add-more2").siblings().find('input').removeAttr('required');
            });
            $("body").on("click",".remove",function(){ 
                $(this).parents(".control-group").remove();
            });
        });
        $('.state').change(function(){
                $.ajax({
                url: "<?= base_url() ?>frontend/get_city?state_id="+$(this).val(),
                cache: false,
                success: function(resp){
                    var data = resp;
			        var str =data;
                    var option = '<option value="">City</option>';
			                            $.each(str, function(index, item){
                                            option += "<option value='"+item.dis_id+"'>"+item.dist_name+"</option>"
			                            }); 
                                        $('.city').html(option);
										
                }
                });
        })
        

        </script>
<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/front_end/js/main.js"></script>

</body>
</html>
