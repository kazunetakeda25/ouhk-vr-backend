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

$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['forgot-password'] = 'auth/forgotPassword';
$route['reset-password'] = 'auth/resetPassword';
$route['email-verify'] = 'auth/emailVerify';
$route['logout'] = 'auth/logout';

$route['user'] = 'user/index';
$route['user/add'] = 'user/add';
$route['user/delete/(:num)'] = 'user/delete/$1';
$route['user/edit/(:num)'] = 'user/edit/$1';

$route['unit'] = 'unit/index';
$route['unit/add'] = 'unit/add';
$route['unit/delete/(:num)'] = 'unit/delete/$1';
$route['unit/edit/(:num)'] = 'unit/edit/$1';

$route['learning-content'] = 'learningcontent/index';
$route['learning-content/(:num)'] = 'learningcontent/unitLearningContent/$1';
$route['learning-content/add'] = 'learningcontent/add';
$route['learning-content/delete/(:num)'] = 'learningcontent/delete/$1';
$route['learning-content/edit/(:num)'] = 'learningcontent/edit/$1';

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
$route['glossary/(:num)'] = 'glossary/unitGlossary/$1';
$route['glossary/practice/(:num)'] = 'glossary/practiceGlossary/$1';
$route['glossary/add'] = 'glossary/add';
$route['glossary/delete/(:num)'] = 'glossary/delete/$1';
$route['glossary/edit/(:num)'] = 'glossary/edit/$1';

$route['sttt'] = 'sttt/index';
$route['sttt/(:num)'] = 'sttt/unitSTTT/$1';
$route['sttt/practice/(:num)'] = 'sttt/practiceSTTT/$1';
$route['sttt/add'] = 'sttt/add';
$route['sttt/delete/(:num)'] = 'sttt/delete/$1';
$route['sttt/edit/(:num)'] = 'sttt/edit/$1';

$route['forum'] = 'forum/index';
$route['forum/add'] = 'forum/add';
$route['forum/delete/(:num)'] = 'forum/delete/$1';
$route['forum/edit/(:num)'] = 'forum/edit/$1';
$route['forum/comment/(:num)'] = 'forum/comment/$1';
$route['forum/comment/add'] = 'forum/addComment';
$route['forum/comment/delete/(:num)'] = 'forum/deleteComment/$1';
$route['forum/comment/edit/(:num)'] = 'forum/editComment/$1';

$route['setting'] = 'setting/index';

$route['default_controller'] = 'auth/login';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;