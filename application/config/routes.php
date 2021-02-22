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
|	http://codeigniter.com/user_guide/general/routing.html
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

$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['forgot-password'] = 'auth/forgotPassword';
$route['reset-password'] = 'auth/resetPassword';
$route['logout'] = 'auth/logout';

$route['dashboard'] = 'dashboard';

$route['users'] = 'user/index';

$route['unit'] = 'unit/index';
$route['unit/add'] = 'unit/add';
$route['unit/delete/(:num)'] = 'unit/delete/$1';
$route['unit/edit/(:num)'] = 'unit/edit/$1';

$route['learning-content'] = 'learningContent/index';
$route['learning-content/(:num)'] = 'learningContent/unitLearningContent/$1';
$route['learning-content/add'] = 'learningContent/add';
$route['learning-content/delete/(:num)'] = 'learningContent/delete/$1';
$route['learning-content/edit/(:num)'] = 'learningContent/edit/$1';

$route['lecture'] = 'lecture/index';
$route['lecture/(:num)'] = 'lecture/unitLecture/$1';
$route['lecture/add'] = 'lecture/add';
$route['lecture/delete/(:num)'] = 'lecture/delete/$1';
$route['lecture/edit/(:num)'] = 'lecture/edit/$1';

$route['practice'] = 'practice/index';
$route['practice/(:num)'] = 'practice/unitPractice/$1';
$route['practice/add'] = 'practice/add';
$route['practice/delete/(:num)'] = 'practice/delete/$1';
$route['practice/edit/(:num)'] = 'practice/edit/$1';

$route['glossary'] = 'glossary/index';

$route['sttt'] = 'sttt/index';
$route['sttt/(:num)'] = 'sttt/unitSTTT/$1';
$route['sttt/add'] = 'sttt/add';
$route['sttt/delete/(:num)'] = 'sttt/delete/$1';
$route['sttt/edit/(:num)'] = 'sttt/edit/$1';

$route['video-online'] = 'videoonline/index';

$route['forum'] = 'forum/index';

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
