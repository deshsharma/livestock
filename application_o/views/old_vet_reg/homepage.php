<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vetreg/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vetreg/style.css">
    <link rel="stylesheet" type="text/css" href="util.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vetreg/css/main.css">
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
   <link href="http://allfont.net/allfont.css?fonts=raleway-extrabold" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vetreg/css/select2/select2.min.css">
  <link href="css/hover-min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
    
    <script src="https://kit.fontawesome.com/c31488d787.js"></script>
	<title>Homepage</title>
  </head>
  <body>



<nav class="navbar navbar-expand-lg navbar-light nav-bg">
  <a class="navbar-brand" href="https://www.livestoc.com"><img src="<?= base_url() ?>assets/vetreg/images/logo.png" alt="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('vetreg/homepage') ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://www.livestoc.com/about">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://www.livestoc.com/treatment">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>vetreg/login">Login</a>
      </li>
      <li class="nav-item dropdown" style="margin-top: 5px;">
        <a class="nav-link dropdown-toggle link-sty" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          English
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="#">English</a>
          <!-- <a class="dropdown-item" href="#">Hindi</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Punjabi</a> -->
        </div>
      </li>
    </ul>
    
  </div>
</nav>



<!--header
<div class="example2">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><img src="images/logo.png" alt="logo">
        </a>
      </div>
      <div id="navbar2" class="">
        <ul class="nav justify-content-end">
  <li class="nav-item">
      <li class="nav-item">
    <a class="nav-link style2" href="#">My Account</a>
  </li>
  <div class="sl-nav">
    <ul>
      <li class="style2 f14">English <i class="fa fa-angle-down" aria-hidden="true"></i>
        <div class="triangle"></div>
        <ul>
          <li><div id="English"></div></i> <span class="active">English</span></li>
          <li><div id="Hindi"></div></i> <span>Hindi</span></li>
          <li><div id="Punjabi"></div></i> <span>Punjabi</span></li>
          <li><div id="Marathi"></div></i> <span>Marathi</span></li>
        </ul>
      </li>
    </ul>
  </div>

  </li>
</ul>
       <ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" href="#">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">About Us</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Services</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Login/Register</a>
  </li>
</ul>
      </div>
    </div>
  </nav>
</div>  --> 

<div class="home">
	<div class="">
	<div class="row">
		<div class="col-12">
			<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= base_url() ?>assets/vetreg/images/home/v1.jpg" class="d-block w-100" alt="slide1">
       <div class="carousel-caption d-none d-md-block animated pulse">
          <h1 style="color: #042e2f;">CONNECT WITH<br>MILLIONS OF<br>FARMERS</h1>
          <!-- <p><button onclick="window.location.href = '<?= base_url() ?>vetreg/product_otp';" type="button" class="btn btn-primary hvr-grow">Register</button><button onclick="window.location.href = 'https://www.livestoc.com/about'" type="button" class="btn btn-secondary hvr-grow">Learn More</button></p> -->
        </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
		</div>
	</div>
</div>
<!-- <div class="info animated pulse">
  <div class="row">
    <div class="col-6 col-md-6 pad0">
      <div class="col1">
        <i class="fa fa-map-marker " aria-hidden="true"></i>
        Office Address: <br>
        Phase-7 Mohali,Punjab,India.<br>
        Pannu Towers
      </div>
    </div>
    <div class="col-6 col-md-6 pad0">
      <div class="col2">
         <i class="fa fa-envelope" aria-hidden="true"></i>
        Email Address:<br>
        support@livestoc.com<br>
        info@livestock.com
      </div>
    </div>
    </div>
  </div>
</div> -->


<div class="">
  <div class="benefits">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 text-left m10">
        <h5>BENEFITS FOR YOU</h5>
        <p>Register for Free NOW and connect with Millions of Animal Owners at Livestoc and Grow your Practice.
      	<ul>
      	<h5>Benefits for Veterinarians</h5>
		  <li style="margin-left: 16px;">Get onboard the first and largest animal health services platform in India.</li>
		  <li style="margin-left: 16px;">Showcase your Expertise and increase your practice as a Premium Veterinarian.</li>
		  <li style="margin-left: 16px;">Millions of Farmers and Pet Owners looking for you at Livestoc.</li>
		  <li style="margin-left: 16px;">Earn per minute by providing Telephonic Consultation & Chat.</li>
		  <li style="margin-left: 16px;">Submit Video Tutorials and Earn.</li>
		  <li style="margin-left: 16px;">Get huge discounts on veterinary products at our smart shopping cart.</li>
		   <li style="margin-left: 16px;">Get products delivered at home.</li>
		  <li style="margin-left: 16px;">Recommend products to your clients and Earn.</li>
		  <li style="margin-left: 16px;">Add more clients to your list through Livestoc.</li>
		  <li style="margin-left: 16px;"> Provide veterinary services at Home and Earn.</li>
		  <li style="margin-left: 16px;">Maintain Animal Profiles, Portfolios and Records.</li>
		  <li style="margin-left: 16px;">Get Job Offers from top Companies in India and Abroad.</li>
		   <li style="margin-left: 16px;">Apply for Job Vacancies posted at Livestoc.</li>
		  <li style="margin-left: 16px;">Submit Articles and enhance your brand position.</li>
		</ul>

      <div class="section-choose mt-5">
        <h5>I AM A</h5> 
        <p class="style1 hvr-grow"><a href="<?= base_url() ?>vetreg/product_otp"> QUALIFIED VETERINARIAN</a></p>
        <p disabled class="style1 hvr-grow"> QUALIFIED VETERINARY ASSISTANT</p>
        <p disabled class="style1 hvr-grow">TRAINED AI WORKER</p>
      </div>
    </div>
    <div class="col-12 col-md-6 pad0">
        <img src="<?= base_url() ?>assets/vetreg/images/home/cow.gif" class="mt-20per mt-0per img-fluid" alt="slide1">
        <!-- <img src="<?= base_url() ?>assets/vetreg/images/home/why.png" class="img-fluid mt-3 p15-xs mb-4" alt="slide1"> -->
    </div>
  </div>
  </div> 
</div>

<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-12 text-center xs-text-left mt75 mt-0-xs">
<img class="img-fluid" src="<?= base_url() ?>assets/vetreg/images/logo.png" alt="logo"> 
<p class="mt-3 hidden-xs hvr-grow">© 2019 · <a href="https://www.livestoc.com"> livestoc.com</a> <br> All Rights Reserved</p>    
</div>
      <div class="col-md-1 text-center d-none d-sm-block">
        <div class="bdrf">
        </div>
      </div>
      <div class="col-md-8 col-12">
<div class="row mt20">
<!-- <div class="col-md-4 mT20 text-center-xs">
<h3 class="mT0"> Address:</h3>
<p class="mL30"> Phase 7, Mohali<br>
Punjab<br>
Pannu Towers, India</p>
</div> -->
<div class="col-md-4 mT20 text-center-xs">
<h3 class="mT0">Contact Us:</h3>
<p class="mL30 ">support@livestoc.com<br>
 1800 102 0379</p>
</div>
<div class="col-md-4 mT20 text-center-xs">
<h3 class="mT0"> Customer Support:</h3>
<p class="mL30"> 1800 102 0379</p>
</div>
<div class="clearfix"></div>    
<div class="col-md-4 mt-4 text-center-xs">
<h3 class="mT0"> DOWNLOAD APP</h3>
<p class="mL30 mL0-xs">
<a href="#"><img class="img-fluid w-48 hvr-grow" src="<?= base_url() ?>assets/vetreg/images/gPlay.png" alt="logo"></a>
<a href="#"><img class="img-fluid w-48" src="<?= base_url() ?>assets/vetreg/images/ios.png" alt="logo"></a></p>
</div>      
<div class="col-md-4 mt-4 text-center-xs">
<h3 class="mT0"> Follow Us on</h3>
<ul class="mL0 mL0-xs pl-0">
<li class="list-inline-item"><a href="https://www.facebook.com/livestocpetcare" target="_blank" class="fb hvr-grow"><i class="fab fa-facebook-f"></i></a></li>
<li class="list-inline-item"><a href="https://twitter.com/livestocpetcare" target="_blank" class="twitter hvr-grow"><i class="fab fa-twitter"></i></a></li>
<li class="list-inline-item"><a href="https://www.instagram.com/livestocpetcare" target="_blank" class="twitter hvr-grow"><i class="fab fa-instagram"></i></a></li>    
</ul>
</div>      
</div>        
</div>
      
    </div>
  </div>
  </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>