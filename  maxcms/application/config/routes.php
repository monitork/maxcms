<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "news";
$route['404_override'] = '';

$route['dich-vu/(:any)'] = "dichvu/detail/$1";
$route['dich-vu'] = "dichvu";


//Config Router Admincp
$route['admincp'] = "admincp";
$route['admincp/menu'] = "admincp/menu";
$route['admincp/login'] = "admincp/login";
$route['admincp/logout'] = "admincp/logout";
$route['admincp/permission'] = "admincp/permission";
$route['admincp/saveLog'] = "admincp/saveLog";
$route['admincp/update_profile'] = "admincp/update_profile";
$route['admincp/setting'] = "admincp/setting";
$route['admincp/getSetting'] = "admincp/getSetting";
$route['admincp/(:any)/(:any)/(:any)/(:any)'] = "$1/admincp_$2/$3/$4";
$route['admincp/(:any)/(:any)/(:any)'] = "$1/admincp_$2/$3";
$route['admincp/(:any)/(:any)'] = "$1/admincp_$2";
$route['admincp/(:any)'] = "$1/admincp_index";

$route['tim-kiem'] = "search";
$route['dang-ky'] = "user/dang_ky";
$route['quen-mat-khau'] = "user/quen_mat_khau";

/*TIN TUC*/
$route['tin-tuc'] = "news/index";
$route['tin-tuc/tags/(:any)'] = "news/tags/$1";
$route['tin-tuc/(:any)/(:any)'] = "news/detail/$2";
$route['tin-tuc/(:any)'] = "news/category/$1";
/*END TIN TUC*/




/*LIEN HE*/
$route['lien-he'] = "contact/index";
/*END LIEN HE*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */