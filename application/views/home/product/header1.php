<?php 
$cart_session = $this->session->userdata('cart_session');
$total_cart=count($cart_session);
//print_r($webLanguage);
?>
<?php 
$cart_session = $this->session->userdata('cart_session');
$total_cart=count($cart_session);
$vedio_session = $this->session->userdata('video_session');
$total_vedio_cart=count($vedio_session);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> India's first Livestock app - Dairy Farm Management &  Pet Care Services </title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="keywords" content="Livestoc,Animal Health App,Livestock Manager App,Veterinarians Near Me,Home Visit Vet,Veterinary Doctor Home Visit,Best Veterinary Doctor Near Me,Cow Semens For Sale In India,Gir Bull Seman,Hf Cow Semens,Cow For Sale In Tamilnadu,Gir Cow For Sale In Karnataka,Sahiwal Cow For Sale In Haryana,Gir Cow For Sale In Gujarat,Buy Cow Online,Buy Animal Online,Animal For Sale In India,Farming Animals For Sale,Sell Animals Online,Buy Horse In India,Farm Equipment India,Veterinary Products Online India,Veterinary Pharmaceuticals In India,Veterinary Rapid Test Kits,Cow Pregnancy Rapid Test,Veterinary Nutritionist Consultation,Farm Automation India,Dog For Sale India,Buy Pitbull Puppy,Puppies for Sale India,Cow for Sale Punjab">
  <meta name="description" content="Livestoc is an integrated technology-based ecosystem designed to transform  livestock sector  by bridging the gaps in  animal  health management and providing market linkages.LIVESTOC is a pioneer mobile app which offers customized & comprehensive livestock management solutions through its varied offerings. A first of its kind cloud based application; Livestoc is designed to not just meet the needs of the livestock sector but also transform the entire livestock industry across the world.">
<!-- <meta name="description" content="The Livestoc app is designed to meet the needs of the entire cattle & pet industry in the country through both online & offline expert consultancy, requisite quality products and services. Get the Best Veterinary Products and Veterinary Nutrition Consultation Online in India From Livestoc.com. Livestoc app Offers Vet on Call Services." /> -->
    <link rel="canonical" href="https://www.livestoc.com/" />
    <script data-ad-client="ca-pub-9448233878137928" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- <link rel="icon" href="<?= base_url() ?>assets/home/images/favicon3.png"> -->
    <link rel="icon" href="<?= base_url() ?>assets/home/images/favicon4.png" type="image/x-icon">
    
    <!-- Font import -->
    <!-- <script src="https://kit.fontawesome.com/365d836442.js" crossorigin="anonymous"></script> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,800;0,900;1,300;1,700&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/bootstrap.css">
    <!-- Font import -->
    <!-- <script src="https://kit.fontawesome.com/365d836442.js" crossorigin="anonymous"></script> -->
    <script src="<?= base_url() ?>assets/home/js/365d836442.js"></script>
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/owl.carousel.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/owl.theme.default.css">
    
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/pagination.css" > -->
    <link rel="stylesheet" href="https://www.livestoc.com/harpahu_merge/assets/admin/css/pagination.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <!-- Custom styles -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/bootstrap.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113285997-1"></script>
  <!-- <script src="https://www.livestoc.com/harpahu_merge/assets/admin/bower_components/jquery/dist/jquery.min.js"></script> -->
 <link href="<?= base_url() ?>assets/home/css/livestoc.css" type="text/css" rel="stylesheet">

	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-113285997-1');
	</script>

</head>
<body>
    <header>
  <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid align-items-start headermenu text-end text-md-start">
          <a class="navbar-brand" href="<?= base_url() ?>"><img class="img-fluid" src="<?= base_url() ?>assets/home/images/logo.png"></a>
          <div class="d-md-flex d-inline-block">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
         
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mt-1">
               <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>"><?= $this->webLanguage['home']?></a>
              </li>
               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $this->webLanguage['Animals'] ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="<?= base_url('buy-animal')?>"><?= $this->webLanguage['Buy Animal']?></a>
                  <!-- <a class="dropdown-item" href="<?= base_url('buy-animal')?>"><?= $this->webLanguage['Sell Animal']?></a> -->
                  <!-- <a class="dropdown-item" href="https://www.livestoc.com/app/buy-animal.php"><?= $this->webLanguage['Add Animal']?></a> -->
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" style="margin-right: 0px;"  href="<?= base_url('veterinary-products-online-india') ?>"><?= $this->webLanguage['Shop']?></a>
              </li>
              <?php if($total_cart){ ?>
                <li class="nav-item">
                  <a class="nav-link cr" href="<?= base_url('frontend/product_cart/') ?>"><i class="fas fa-shopping-cart mr-2"></i>[<span id="cr"><?= $total_cart ?></span>]</a>
                </li>
              <?php }else{ ?>
                <li class="nav-item">
                  <a class="nav-link cr" href="#"><i class="fas fa-shopping-cart mr-2"></i>[<span id="cr">0</span>]</a>
                </li>
              <?php } ?>

              
              <li class="nav-item">
                <a class="nav-link" style="margin-right: 0px;" href="<?= base_url('video') ?>"><?= $this->webLanguage['Video Tutorial']?></a>
              </li>
              <?php if($total_cart){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('all_videos/video_cart/') ?>"><i class="fas fa-shopping-cart mr-2"></i>[<?= $total_vedio_cart ?>]</a>
                </li>
              <?php }else{ ?>
                <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fas fa-shopping-cart mr-2"></i>[0]</a>
                </li>
              <?php } ?>
              
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url()?>about-us"><?= $this->webLanguage['About Us']?></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $this->webLanguage['Language']?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php $header_lang = $this->api_model->get_data('is_activate = "1"', 'language'); 
                  foreach($header_lang as $la){ ?>
                  <a class="dropdown-item lang" value="<?= $la['code'] ?>" data-val="<?= $la['code'] ?>"><?= $la['name'] ?></a>
                  <?php } ?>
                </div>
              </li>
                  <?php if(!$this->session->userdata("users_id")){
                    echo '<li class="nav-item"><a class="nav-link" href="'.base_url().'frontend/login"   id="navbarDropdownMenuLink" role="button" aria-haspopup="true" aria-expanded="false">
                   '.$this->webLanguage['login'].'
                    </a>';
                 }else{

                   echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"  href="'.base_url().'frontend/my_account" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      '.$this->session->userdata("user_name").'</a>';
                  echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="'.base_url().'frontend/my_account">'.$this->webLanguage['My Account'].'</a>
                    <a class="dropdown-item" href="'.base_url().'frontend/my_order">'.$this->webLanguage['My Orders'].'</a>
                    <a class="dropdown-item" href="'.base_url().'all_videos">'.$this->webLanguage['All Videos'].'</a>
                    <a class="dropdown-item" href="'.base_url().'homenew/animal_favorite_list">'.$this->webLanguage['My Wishlist'].'</a>
                    <a class="dropdown-item" href="'.base_url().'frontend/logout" >'.$this->webLanguage['logout'].'</a>
                  </div>';
                } ?>
              </li>
    
            </ul>
          </div>
      </div>
      </div> 
      
      <div class="menubutton">
              <ul class="list-unstyled">
              <img src="<?= base_url() ?>assets/home/images/menu-icon.png"><span><?= $this->webLanguage['MENU']?> </span>
                
              </ul>
          </div>
      </div>
      </nav>
      
</header>








    