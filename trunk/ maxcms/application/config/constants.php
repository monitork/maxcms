<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

// Define Ajax Request
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');


//NEWS
define('DIR_NEWS_IMAGES', 'static/uploads/news/images/');
define('LINK_NEWS', PATH_URL.'tin-tuc/');
define('LINK_CAR_SALE', PATH_URL.'dang-ban-oto/');
define('LINK_EXPERIENCE', PATH_URL.'kinh-nghiem/');

define('LINK_NEWS_TAGS', PATH_URL.'tin-tuc/tags/');
define('LINK_EXPERIENCE_TAGS', PATH_URL.'kinh-nghiem/tags/');
define('LINK_TIMMUAXE', PATH_URL.'mua-ban-oto/');


define('DATETIME_FORMAT_DB', "Y-m-d H:i:s");
define('DATETIME_FORMAT_FULLDATE', "l");
define('DATETIME_FORMAT', "d/m/Y");
define('DATETIME_FORMAT_NODATA', "Y-m-d");
//*****************************************************************DATABASE
//NEWS
define('CATEGORY_NEWS_TB', PREFIX.'category_news');
define('NEWS_TB', 'news_2013_03');
define('TAGS_TB', PREFIX.'tags');
define('JOIN_TAGS_TB', PREFIX.'join_tags');
define('NEWS_BLOG', 'admin_new_blog');

/* END Nodata */
//*****************************************************************END DATABASE

/* End of file constants.php */
/* Location: ./application/config/constants.php */