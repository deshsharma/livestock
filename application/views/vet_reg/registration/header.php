<?php 
header('Access-Control-Allow-Origin: *');
?>
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
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>vendor/css-hamburgers/hamburgers.min.css">
    <link href="http://allfont.net/allfont.css?fonts=raleway-extrabold" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vetreg/css/select2/select2.min.css">
    <link href="css/hover-min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vetreg/css/formstyle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/c31488d787.js"></script>
    <link rel="icon" href="<?= base_url() ?>assets/home/images/favicon4.png">
    <title>Rgistration form</title>
    <link rel="canonical" href="https://www.livestoc.com/" />
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-113285997-1');
    </script>  
  </head>
  <body>
<!--header-->
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
        <a class="nav-link" href="<?= base_url() ?>vetreg/active_your_account">Login</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-sty" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          English
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="#">English</a>
         <!--  <a class="dropdown-item" href="#">Hindi</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Punjabi</a> -->
        </div>
      </li>
    </ul>
    
  </div>
</nav> 