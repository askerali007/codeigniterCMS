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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dp-admin'] 		  = 'dp-admin/home';
$route['dp-admin/(:any)'] = "dp-admin/$1";


$route['management'] 	  = 'management/index';
$route['history'] 		  = 'history/index';
$route['wildlife'] 		  = 'wildlife/index';
$route['careers'] 		  = 'careers/index';
$route['careers/vacancies'] = 'careers/index/vacancies';
$route['applynow']		  = 'careers/applynow';
$route['applynow/(:any)'] = 'careers/applynow/$1';
$route['contactus']		  = 'contactus/index';
$route['news']		  	  = 'news/index';
$route['search']		  = 'search/index';

//####### Pages ###########//
$route['home'] 						= 'page/index/home';
$route['director-general-message'] 	= 'page/index/director-general-message';
$route['our-mission'] 				= 'page/index/our-mission';
$route['our-values'] 				= 'page/index/our-values';
$route['our-business'] 				= 'page/index/our-business';
$route['pipeline-department'] 		= 'page/index/pipeline-department';
$route['margham-field'] 			= 'page/index/margham-field';
$route['lng'] 						= 'page/index/lng';
$route['transporting-gas'] 			= 'page/index/transporting-gas';
$route['our-organisation'] 			= 'page/index/our-organisation';
$route['hsse'] 						= 'page/index/hsse';
$route['hse-guidelines'] 			= 'page/index/hse-guidelines';
$route['operating-excellence'] 		= 'page/index/operating-excellence';
$route['lng-project'] 				= 'page/index/lng-project';
$route['ISO14001'] 					= 'page/index/ISO14001';
$route['commercial-services'] 		= 'page/index/commercial-services';
$route['commercial'] 				= 'page/index/commercial';
$route['general-conditions'] 		= 'page/index/general-conditions';
$route['terms'] 					= 'page/index/terms';
$route['privacy'] 					= 'page/index/privacy';



//$route[''] = 'page/index/';

//$route['(:any)'] 		  = "page/index/$1";
//$route['([^/]+)/?'] = 'page/index/$1';



