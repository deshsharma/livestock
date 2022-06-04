<?php 
 if($_SESSION['language']){
    $lang = $_SESSION['language'];
    }else{
      $lang = 'en';
    }
    $webLanguage = $this->language_left->get_language($lang);

$cart_session = $this->session->userdata('video_session');
$total_cart=count($cart_session);
?>
<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 pull-right">
    <div class="header-right-info">
        <ul class="nav navbar-nav mai-top-nav header-right-menu">

            <li class="nav-item cta cta-colored">
                <?php if( $this->session->userdata("users_id") != ''){ ?>
                    <?php if($total_cart){ ?>
                        <a href="<?= base_url('all_videos/video_cart/') ?>" role="button" aria-expanded="false" class="nav-link">
                        <i class="educate-icon educate-bell" aria-hidden="true"></i>
                            <span class="icon-shopping_cart"></span>Tutorials [<?= $total_cart ?>]
                        </a>
                    <?php }else{ ?>
                        <a href="#" role="button" aria-expanded="false" class="nav-link"><i class="educate-icon educate-bell" aria-hidden="true"></i><span class="icon-shopping_cart"></span><?= $webLanguage['Tutorials']?> [0]</a>
                    <?php } ?>
                <?php }else{ ?>
                    <a href="https://www.livestoc.com/frontend/login" role="button" aria-expanded="false" class="nav-link"><?= $webLanguage['login']?></a>
                <?php } ?>
            </li>
            
            <!-- <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-bell" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                    <div class="notification-single-top">
                        <h1>Notifications</h1>
                    </div>
                    <ul class="notification-menu">
                        <li>
                            <a href="#">
                                <div class="notification-icon">
                                    <i class="educate-icon educate-checked edu-checked-pro admin-check-pro" aria-hidden="true"></i>
                                </div>
                                <div class="notification-content">
                                    <span class="notification-date pull-right">16 Sept</span>
                                    <h2>Guidance Video 1</h2>
                                    <p>You video has been published</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="notification-view">
                        <a href="#">View All Notification</a>
                    </div>
                </div>
            </li> -->
            <?php if( $this->session->userdata("users_id") != ''){ ?>
            <li class="nav-item">
                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                        <!-- <img src="<?= base_url() ?>assets/allvideos/img/pro4.jpg" alt="" /> -->
                        <span class="admin-name"><?php echo $this->session->userdata("user_name") ?></span>
                        <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                    </a>
                <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                    <li><a href="<?= base_url('all_videos') ?>"><span class="edu-icon edu-home-admin author-log-ic"></span><?= $webLanguage['My Account']?></a>
                    </li>
                    <!-- <li><a href="#"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a>
                    </li>
                    <li><a href="#"><span class="edu-icon edu-money author-log-ic"></span>User Billing</a>
                    </li>
                    <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                    </li> -->
        
                    <li><a href="<?= base_url('all_videos') ?>"><span class="edu-icon edu-home-admin author-log-ic"></span><?= $webLanguage['All Tutorials']?></a>
                    </li>
                    <li><a href="<?= base_url('all_videos/video_add') ?>"><span class="edu-icon edu-home-admin author-log-ic"></span><?= $webLanguage['Add Tutorials']?></a>
                    </li>

                    <li><a href="<?= base_url().'frontend/logout'; ?>"><span class="edu-icon edu-locked author-log-ic"></span><?= $webLanguage['logout']?></a>
                    </li>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>