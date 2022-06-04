<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Homenew';
$route['animals-treatment'] = 'about/treatment';
$route['contact'] = 'about/contact';
$route['contact-us'] = 'homenew/contact_us';
$route['bull_detail/(:any)'] = 'Homenew/bull_detail/$1';
$route['veterinary-products-online-india'] = 'frontend/product_listing';
$route['shop'] = 'frontend/product_listing';
$route['video'] = 'all_videos';
$route['insemination'] = 'about/insemination';
$route['semen'] = 'about/semen';
$route['frontend'] = 'frontend/buyer_seller_point';
$route['animal-nutrition-consultancy'] = 'about/nutrition_consultancy';
$route['farm_management'] = 'about/farm_management';
$route['privacy_policy'] = 'about/privacy_policy';
$route['register'] = 'frontend/register';
$route['semen_bull_listing'] = 'frontend/semen_bull_listing';
$route['payment'] = 'frontend/payment_success';
$route['webhook'] = 'frontend/webhook';
$route['animal_premium_status'] = 'frontend/animal_premium_status';
$route['about-us'] = 'homenew/about_us';
$route['My-Farms'] = 'homenew/farm';
$route['buy-animal'] = 'Homenew/sell_animals';
$route['admin'] = 'welcome/admin';
$route['veterinary-doctors'] = 'vetreg/homepage';
$route['veterinary-doctors/product_otp'] = 'vetreg/product_otp';
$route['veterinary-doctors/vt_otp'] = 'vetai/vt_otp';
$route['veterinary-doctors/ai_otp'] = 'vetai/ai_otp';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
