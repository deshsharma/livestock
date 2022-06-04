<?php 
    if($_SESSION['language']){
    $lang = $_SESSION['language'];
    }else{
      $lang = 'en';
    }
    $webLanguage = $this->language_left->get_language($lang);
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
<?php //print_r($head); ?>
    <title><?= $head['title'] ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="<?= $head['description'] ?>"/>
    <meta name="keywords" content="<?= $head['description'] ?>"/>
    <meta name="document-classification" content="LiveStoc" />
    <meta name="document-type" content="Public"/>
    <meta name="Classification" content="<?= $head['title'] ?>" />
    <meta name="author" content="<?= $head['auther'] ?>" />
    <meta name="language" content="EN">
    <meta name="robots" content="index,follow" />
    <meta name="rating" content="general" />
    <meta name="revisit-after" content="7 days" />
    <meta name="reply-to" content="support@livestoc.com">
    <meta name="copyright" content="© Copyright 2020, All Rights Reserved, Livestoc">
    <meta name="distribution" content="global" />
    <meta name="coverage" content="Worldwide" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= $head['link'] ?>" />
    <meta property="og:title" content="<?= $head['title'] ?>" />
    <meta property="og:description" content="<?= $head['description'] ?>" />
    <meta property="og:image" content="<?= $head['image'] ?>" />
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta property="og:url" content="<?= $head['link'] ?>" />
    <!-- favicon
    ============================================ -->
    <link rel="icon" href="<?= base_url() ?>assets/home/images/favicon4.png">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/allvideos/img/favicon.ico"> -->
    <!-- Google Fonts
    ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/allvideos/css/bootstrap.min.css">
    <!-- Bootstrap CSS
    ============================================ -->

    <script src="https://kit.fontawesome.com/365d836442.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?= base_url() ?>assets/allvideos/css/font-awesome.min.css">
    <!-- educate icon CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/allvideos/css/educate-custon-icon.css">
    <!-- metisMenu CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/allvideos/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/allvideos/css/metisMenu/metisMenu-vertical.css">
    <!-- style CSS
    ============================================ -->



    <!-- ionicons CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/product/css/ionicons.min.css">



    <link rel="stylesheet" href="<?= base_url() ?>assets/allvideos/css/style.css">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/allvideos/css/responsive.css">
    <!-- modernizr JS
    ============================================ -->
    <script src="<?= base_url() ?>assets/allvideos/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://use.fontawesome.com/74d90de4f1.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
    <!-- Start Left menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="https://www.livestoc.com"><span><?= $webLanguage['Livestoc']?></span></a>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <?php if( $this->session->userdata("users_id") != ''){ ?>
                        <li>
                            <a title="Landing Page" href="<?= base_url().'all_videos'; ?>" aria-expanded="false"><i class="fa fa-home"></i> <span class="mini-click-non"><?= $webLanguage['My Account']?></span></a>
                        </li>
                        <?php } ?>
                        <?php if( $this->session->userdata("users_id") != ''){ ?>
                        <li class="active">
                            <a class="has-arrow" href="<?= base_url().'all_videos'; ?>" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span> <span class="mini-click-non"><?= $webLanguage['Video Tutorials']?></span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Courses" href="<?= base_url().'all_videos'; ?>"><span class="mini-sub-pro"><?= $webLanguage['All Tutorials']?></span></a></li>
                                <li><a title="Add Courses" href="<?= base_url().'all_videos/video_add'; ?>"><span class="mini-sub-pro"><?= $webLanguage['Add Tutorials']?></span></a></li>
                                <?php
                                $whishlist_count = $this->api_model->get_video_wishlist_count($this->session->userdata("users_id"));
                                echo '<li class="nav-item"><a href="'.base_url().'all_videos/wishlist" class="nav-link">'.$webLanguage['My Wishlist'].'('.$whishlist_count[0]['count'].')</a></li>'; ?>
                            </ul>
                        </li>
                        <?php }else{ ?>
                            <li class="active">
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="All Courses" href="<?= base_url().'all_videos'; ?>"><span class="mini-sub-pro"><?= $webLanguage['All Tutorials']?></span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->