<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Videos Tutorial | Livestoc</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/allvideos/img/favicon.ico">
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
                <a href="https://www.livestoc.com">Livestoc <span>PRO</span></a>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        
                        <li>
                            <a title="Landing Page" href="<?= base_url().'all_videos'; ?>" aria-expanded="false"><i class="fa fa-home"></i> <span class="mini-click-non">My Account</span></a>
                        </li>
                        
                        <li class="active">
                            <a class="has-arrow" href="<?= base_url().'all_videos'; ?>" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span> <span class="mini-click-non">Video Tutorials</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Courses" href="<?= base_url().'all_videos'; ?>"><span class="mini-sub-pro">All Tutorials</span></a></li>
                                <li><a title="Add Courses" href="<?= base_url().'all_videos/video_add'; ?>"><span class="mini-sub-pro">Add Tutorials</span></a></li>
                                <?php
                                $whishlist_count = $this->api_model->get_video_wishlist_count($this->session->userdata("users_id"));
                                echo '<li class="nav-item"><a href="'.base_url().'all_videos/wishlist" class="nav-link">My Wishlist('.$whishlist_count[0]['count'].')</a></li>'; ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->