<?php
class Share extends CI_Controller {
	public function __construct() {
		parent::__construct();
    }
    public function index(){
        $code = $this->input->get_post('code');
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
        $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
        if( $iPod || $iPhone || $iPad){
        header( 'Location: http://itunes.apple.com/app/clash-of-clans/id529479190?mt=8' );
        die();
        }
        else if($Android){
        header( 'Location: market://details?id=com.it.livestoc&referrer='.$code.'' );
        die();
        }
        else
        {
            // header( 'Location: market://details?id=com.it.livestoc&referrer='.$code.'' );
            // echo  'https://play.google.com/store/apps/details?id=com.it.livestoc&referrer='.$code;
            // exit;
        header( 'Location: https://play.google.com/store/apps/details?id=com.it.livestoc&referrer='.$code.'' );
        die();
        }
    }
}