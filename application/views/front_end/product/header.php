<?php
$cart_session = $this->api_model->get_data('users_id = "'.$this->session->userdata('users_id').'" AND user_type = "'.$this->session->userdata('user_type').'"', 'product_cart', '', 'count(id) as count');
$total_cart=$cart_session[0]['count']; 
// $cart_session = $this->session->userdata('cart_session');
// $total_cart=count($cart_session);
if($_SESSION['language']){
  $lang = $_SESSION['language'];
}else{
  $lang = 'en';
}
$webLanguage = $this->language_left->get_language($lang);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Buy the Best Veterinary Products Online In India From Livestoc - We Offers Animal Health Care Products</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="description" content="The Livestoc app is designed to meet the needs of the entire cattle & pet industry in the country through both online & offline expert consultancy, requisite quality products and services. Livestoc aims to usher in wide spread profitability in the Indian livestock segment and believes in inclusive growth for dairy farmers, pet owners, veterinarians, pet trainers & groomers, animal breeders & traders and animal product manufacturers."> -->
    <meta name="description" content=" Buy Veterinary Products online india From Livestoc.com - We offers healthy food for Dogs, Cows & Other Animals. Shop the Best Veterinary Products and Supplies from livestoc app. We also offers Veterinary Rapid Test Kits at best prices.  " />
    <meta name="keywords" content="Livestoc,Animal Health App,Livestock Manager App,Veterinarians Near Me,Home Visit Vet,Veterinary Doctor Home Visit,Best Veterinary Doctor Near Me,Cow Semens For Sale In India,Gir Bull Seman,Hf Cow Semens,Cow For Sale In Tamilnadu,Gir Cow For Sale In Karnataka,Sahiwal Cow For Sale In Haryana,Gir Cow For Sale In Gujarat,Buy Cow Online,Buy Animal Online,Animal For Sale In India,Farming Animals For Sale,Sell Animals Online,Buy Horse In India,Farm Equipment India,Veterinary Products Online India,Veterinary Pharmaceuticals In India,Veterinary Rapid Test Kits,Cow Pregnancy Rapid Test,Veterinary Nutritionist Consultation,Farm Automation India,Dog For Sale India,Buy Pitbull Puppy,Puppies for Sale India,Cow for Sale Punjab">
     <link rel="icon" href="https://www.livestoc.com/assets/home/images/favicon4.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/animate.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/main.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/aos.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/jquery.timepicker.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/icomoon.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/owl.theme.default.min.css"> 
    <script src="https://use.fontawesome.com/74d90de4f1.js"></script>  
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/style.css"> 
    <script src="<?= base_url() ?>assets/product/js/jquery.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113285997-1"></script>
    <link rel="canonical" href="https://www.livestoc.com/" />
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-113285997-1');
    </script>  
  </head>
  <body class="goto-here">
      <svg class="hidden" version="1.1" id="rupee" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 344.329 344.329" style="enable-background:new 0 0 344.329 344.329;" xml:space="preserve">
<g>
	<g>
		<path d="M277.965,90h-50.8c-2.9-28-18-54-40.1-70h90.9c5.5,0,10-4.5,10-10s-4.5-10-10-10h-211.6c-5.5,0-10,4.5-10,10s4.5,10,10,10
			h60.6c41.2,0,75.2,31,80.1,70h-140.7c-5.5,0-10,4.5-10,10s4.5,10,10,10h140.7c-5,40.5-39.4,70.9-80.1,71h-60.5
			c-5.6,0.1-10.1,4.7-10,10.3c0,2.7,1.2,5.3,3.1,7.2l151.3,143.1c4,3.8,10.3,3.6,14.1-0.4c3.8-4.1,3.6-10.4-0.4-14.3L91.465,201
			h35.4c52.2,0,95.3-40,100.3-91h50.8c5.5,0,10-4.5,10-10S283.465,90,277.965,90z"/>
	</g>
</g>
      </svg>
		<div class="py-1 bg-primary">
      <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
          <div class="col-lg-12 d-block">
            <div class="row d-flex">
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                <span class="text">1800 102 0379</span>
              </div>
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                <span style="text-transform: lowercase;" class="text">support@livestoc.com</span>
              </div>
              <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                <span class="text"><?= $this->webLanguage['3-5 BUSINESS DAYS DELIVERY & FREE RETURNS'] ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
        <a class="navbar-brand" href="<?= base_url('frontend/product_listing') ?>"> <img src="https://www.livestoc.com/uploads/logo/logolivestoc.png"></a> 
        <ul class="list-unstyled forcart">    
            
            <?php if($total_cart){ ?>
          <li class="nav-item cta cta-colored"><a href="<?= base_url('frontend/product_cart/') ?>" class="nav-link"><span class="icon-shopping_cart"></span>[<?= $total_cart ?>]</a></li>
        <?php }else{ ?>
          <li class="nav-item cta cta-colored"><a  class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
        <?php } ?> 
            
        </ul>           
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> <?= $this->webLanguage['MENU']?>
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto formar35">
            <li class="nav-item"><a href="https://www.livestoc.com/" class="nav-link"><?= $this->webLanguage['home']?></a></li>
	          <li class="nav-item"><a href="<?= base_url('veterinary-products-online-india') ?>" class="nav-link"><?= $this->webLanguage['Shop']?></a></li>
            <li class="nav-item"><a href="https://www.livestoc.com/blog/" class="nav-link"><?= $this->webLanguage['blog']?></a></li>
            <?php if(!$this->session->userdata("users_id")){
          echo '<li class="nav-item"><a href="'.base_url().'frontend/login" class="nav-link">'.$this->webLanguage['login'].'</a></li>';
			  }else{
          $whishlist_count = $this->api_model->get_wishlist_count($this->session->userdata("users_id"));
          echo '<li class="nav-item"><a href="'.base_url().'frontend/wishlist" class="nav-link">'.$this->webLanguage['My Wishlist'].'('.$whishlist_count[0]['count'].')</a></li>';
          echo '<li class="nav-item"><a href="'.base_url().'frontend/my_account" class="nav-link">'.$this->session->userdata("user_name").'</a></li>';
           echo '<li class="nav-item"><a href="'.base_url().'frontend/my_order" class="nav-link">'.$this->webLanguage['My Orders'].'</a></li>';
            echo '<li class="nav-item"><a href="'.base_url().'all_videos" class="nav-link">'.$this->webLanguage['Videos'].'</a></li>';
          echo '<li class="nav-item"><a href="'.base_url().'frontend/logout" class="nav-link">'.$this->webLanguage['logout'].'</a></li>';
			  } ?>
	          
				<?php //if($total_cart){ ?>
          <!-- <li class="nav-item cta cta-colored"><a href="<?= base_url('frontend/product_cart/') ?>" class="nav-link cr"><span class="icon-shopping_cart"></span>[<span id="cr"><?= $total_cart ?></span>]</a></li> -->
        <?php //}else{ ?>
          <!-- <li class="nav-item cta cta-colored"><a  class="nav-link cr"><span class="icon-shopping_cart"></span>[<span id="cr">0<span>]</a></li> -->
        <?php //} ?>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->