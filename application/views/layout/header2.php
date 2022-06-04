<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PetCare Kennels - Responsive html template</title>
	<link href="<?= base_url() ?>assetss/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assetss/css/style.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Cabin:400,500,600,700,400italic,500italic,600italic,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link rel="canonical" href="https://www.livestoc.com/" />
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113285997-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-113285997-1');
	</script>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" /><![endif]-->

	</head>
	<body class="contentpage">
		<!-- Navigation -->
		<div class="navbar navbar-default navbar-fixed-top affix inner-pages" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="<?= base_url(); ?>"><strong>Live</strong>Stoc<br />
						<span data-hover="Kennels" style="font-size: 8px; letter-spacing: 5px;">IMPOVE YOUR STOCK</span>
					</a></h1>
				</div>	
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="<?= base_url() ?>" title="Home"><span data-hover="Home">Home</span></a>
						</li>
						<!-- <li>
							<a href="prices.html" title="Prices"><span data-hover="Prices">Prices</span></a>
						</li> -->
						<li class="active">
							<a href="<?= base_url()?>about" title="About us"><span data-hover="About us">About us</span></a>
						</li>
						<li class="dropdown">
							<a href="services.html" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="Services">Services</span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#" title="Artifical Insemination">Animal Treatment</a>
								</li>
								<li>
									<a href="#" title="Treatment">Artificial Insemination</a>
								</li>
								<li>
									<a href="#" title="Farm Management">Best Quality Semen</a>
								</li>
								<li>
									<a href="#" title="Loan Insurance">Buy & Sell Livestoc</a>
								</li>
								<li>
									<a href="#" title="Pregnancy Test">Farm Products&nbsp;/&nbsp;Equipment Shopping</a>
								</li>
								<li>
									<a href="#" title="Pet Vaccination">Animal Nutrition Consultancy</a>
								</li>
								<li>
									<a href="services.html" title="Enroll for Dog Show">Farm Automation&nbsp;/&nbsp;New Farm Set Up</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="https://www.livestoc.com/ecommerce/" title="Shop"><span data-hover="Shop">Shop</span></a>
						</li>
						<li>
							<a href="https://www.livestoc.com/app/login.php" title="Login / Register"><span data-hover="Login / Register">Login / Register</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Navigation end -->