<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('file_path', '/var/www/html/harpahu_merge_dev/uploads/');
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);
define('TEL_NO', '18001031541');
define('RADIOUS_DIST','10');
define('PRODUCT_LEAD','100');
define('language_library','hi');
define('BOOKING_PRICE','15');
define('category','en');
define('HOME_VISIT_DAYS','1');
define('RETAILER_ADD','2000');
define('category_hindi','hi');
define('category_punjabi','pa');
define('CALL_PERCENTAGE','50');
define('TREATMENT_CANCEL_TIME', '1');
define('DOG_MEATING_DUMMY_PRICE', '27000');
define('DOG_MEATING_PRICE', '13500');
define('RETAILER_DOG_MEATING_PRICE', '13000');
define('LIVESTOC_CASH_DOG_MEATING','500');
define('BULL_MEATING_DUMMY_PRICE', '27000');
define('BULL_MEATING_PRICE', '1');
define('RETAILER_BULL_MEATING_PRICE', '13000');
define('LIVESTOC_CASH_BULL_MEATING','500');
define('BREADER_DOMMY_PRICE', '27000');
define('BREADER_PRICE', '13500');
define('RETAILER_BREADER_PRICE', '13000');
define('BREADING_RECORD_PRICE', '20');
define('HOME_VISIT', '25');
define('DEALER_DOMMY_PRICE', '27000');
define('LIVESTOC_CASH_BREADER','500');
define('LIVESTOC_CASH_DEALER','500');
define('DEALER_PRICE', '13500');
define('RETAILER_DEALER_PRICE', '13000');
define('LAB_PRICE','25000');
define('LAB_CHARGES','650');
define('LAB_CHARGES_OFFER','500');
define('LAB_DISTANCE','25');
define('LAB_OFFER_CHARGES','500');
define('YIELD_CHARGES','1500');
define('YIELD_OFFER_CHARGES','1250');
define('UNLOCK_PRICE', '100');
define('HELP_LINE','7009058918');
define('ITEMS_PER_PAGE','20');
define('NUM_DISPLAY_ENTRIES','10');
define('NUM_DAYS_PAYMENT','0');
define('SERVICE_TAX', '0');
define('REFER_AMOUNT', '200');
define('GAS_PRICE', '20');
define('SHEATH_PRICE', '20');
define('GLOVES_PRICE', '20');
define('GAS_TAX', '18');
define('BREADING_PRICE', '20');
define('BREADING_TEXT','प्रजनन रिकॉर्ड को बनाने / बनाए रखने के लिए भुक्तान करे');
define('REFER_REV_AMOUNT', '200');
define('DISTANCE_PRICE', '1500');
define('PURCHASE_PER', '20');
define('VERSION','1');
define('CALL_CHECK_ACCOUNT','0');
define('RETAILER_VERSION', '1');
define('BUSINESS_VERSION', '1');
define('PRO_VERSION', '1');
define('VER_FORCE','0');
define('BUSI_FORCE', '0');
define('RETAILER_FORCE', '0');
define('PRO_FORCE', '0');
define('AI_PRICE', '160');
define('DEWARMING_TIME_FROM', '90');
define('CALL_TIME', '00:05:00');
define('CALL_MIN', '5');
define('CALL_RATE', '10');
define('TO_ADMIN','shahiakhilesh75@gmail.com');
define('REPEATE_BREEDING', '15');
define('IMAGE_PATH','https://www.livestoc.com/');
define('OLD_API_PATH','webservices_new_2/');
define('UPLOAD_LINK', '/var/www/html/harpahu_dhyan_dev/uploads/');
define('PAYMENT_STATUS_LINK','https://www.livestoc.com/harpahu_dhyan/api/');
define('CO_EMAIL', 'amazebrandlance@gmail.com');
define('PARAVATE_SERVERKEY','AIzaSyBLMIkhQ3Rt5Q5a-KO2ApXiKUpxPIuLtA8');
define('COUSTOMER_SERVERKEY','AIzaSyAnJZY5jCsLC5inEc4fbLoUwR34DcSiL2c');
define('IOS_COUSTOMER_SERVERKEY','AAAAc9RE3lw:APA91bGW-_BXujZzCCcP_RvIyRAQmIiGGoenu7H8mFTVCVg7RowSIUsM58-rhXU0sXA5Y_TcczxnNOhy1gFp4-Z5aLrq6awNCbXwNegbRCorI_-Qank7JJBoQwqy6-2xUTqKqulGatfd');
define('IOS_PARAVATE_SERVERKEY','AIzaSyBSdJhdH9r-SDMCvGchHqUeBJZyBcVSqwE');
define('BUSINESS_AND_SERVERKEY','AIzaSyAE82LCEGqBhu9eMEO28kDVdDMzMg-iZdI');
define('BUSINESS_IOS_SERVERKEY','AIzaSyCmAPwHGmopVqxOiSQlSy5f8Om2T_BWzb4');
define('LIVESTOCK_AND_SERVERKEY','AIzaSyAMl7ntcwx00i4lJkKb59JWnFf5ayCRd10');
define('LIVESTOCK_IOS_SERVERKEY','AIzaSyAMl7ntcwx00i4lJkKb59JWnFf5ayCRd10');
define('DEALER_APP_SERVERKEY','AAAA-TpE3_I:APA91bH-FlCp16SB2wM5pAfk9QE7ay3LyAdjjtuEmpdEMcVIWuFgowZ0lQ9rBUv-8NjLWfh8dZzcTX_yYvDmq_1CBeNoGYZSfSEio3weJz0mETq3zHca3uai7M4Tt7a3NoMCO9U1npQa');
define('DEALER_IOS_SERVERKEY','AAAA-TpE3_I:APA91bH-FlCp16SB2wM5pAfk9QE7ay3LyAdjjtuEmpdEMcVIWuFgowZ0lQ9rBUv-8NjLWfh8dZzcTX_yYvDmq_1CBeNoGYZSfSEio3weJz0mETq3zHca3uai7M4Tt7a3NoMCO9U1npQa');
define('RETAILER_SERVERKEY','AAAAtoSpA8o:APA91bF6gUR3XLHSMmIyRsiTKP3kmoCWOchNe_fJTfaV1Aj_Ah7miB8CS83GJRS-64LCqsbUzQpUGiwjXzQHZDK-n4GCwTnZ91Wmss8-Vg2O4NP7WdFwhe45EXknZDfwogxaf0CE29M2');
define('IOS_RETAILER_SERVERKEY','AAAAtoSpA8o:APA91bF6gUR3XLHSMmIyRsiTKP3kmoCWOchNe_fJTfaV1Aj_Ah7miB8CS83GJRS-64LCqsbUzQpUGiwjXzQHZDK-n4GCwTnZ91Wmss8-Vg2O4NP7WdFwhe45EXknZDfwogxaf0CE29M2');
// define('IOS_PARAVATE_SERVERKEY','AIzaSyBSdJhdH9r-SDMCvGchHqUeBJZyBcVSqwE');
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
