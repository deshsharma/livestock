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
define('RADIOUS_DIST','10000');
define('LAB_PRICE','13500');
define('LAB_CHARGES','550');
define('UNLOCK_PRICE', '100');
define('HELP_LINE','7009058918');
define('ITEMS_PER_PAGE','20');
define('NUM_DISPLAY_ENTRIES','10');
define('NUM_DAYS_PAYMENT','0');
define('REFER_AMOUNT', '200');
define('BREADING_PRICE', '27');
define('BREADING_TEXT','प्रजनन रिकॉर्ड को बनाने / बनाए रखने के लिए भुक्तान करे');
define('REFER_REV_AMOUNT', '200');
define('DISTANCE_PRICE', '1500');
define('PURCHASE_PER', '20');
define('VERSION','1');
define('BUSINESS_VERSION', '1');
define('PRO_VERSION', '1');
define('VER_FORCE','0');
define('BUSI_FORCE', '0');
define('PRO_FORCE', '0');
define('AI_PRICE', '160');
define('REPEATE_BREEDING', '15');
define('TREATMENT_CANCEL_TIME', '1');
define('TREATMENT_CANCEL_TIME_TO', '2');
define('DEWARMING_TIME_FROM', '90');
define('DEWARMING_TIME_TO', '91');
define('PREMIUM_DAYS', '365');
define('PREMIUM_DAYS_TO', '366');
define('IMAGE_PATH','https://www.livestoc.com/');
define('OLD_API_PATH','webservices_new_dev/');
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
// define('COUSTOMER_SERVERKEY','AIzaSyAnJZY5jCsLC5inEc4fbLoUwR34DcSiL2c');
// define('IOS_COUSTOMER_SERVERKEY','AAAAc9RE3lw:APA91bGW-_BXujZzCCcP_RvIyRAQmIiGGoenu7H8mFTVCVg7RowSIUsM58-rhXU0sXA5Y_TcczxnNOhy1gFp4-Z5aLrq6awNCbXwNegbRCorI_-Qank7JJBoQwqy6-2xUTqKqulGatfd');
// define('IOS_PARAVATE_SERVERKEY','AIzaSyBSdJhdH9r-SDMCvGchHqUeBJZyBcVSqwE');
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

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
