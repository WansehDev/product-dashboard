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
$route['default_controller'] = 'users';

/* USER LOGIN ROUTE */
$route['login'] = '/';
$route['users/validate'] = 'users/process_login';

/* USER REGISTER ROUTE */
$route['register'] = 'users/register';
$route['register/validate'] = 'users/process_register';

/* USER(NONADMIN) DASHBOARD ROUTE */
$route['dashboard'] = 'users/dashboard';

/* USER(ADMIN) DASHBOARD ROUTE */
$route['admin_dashboard'] = 'users/admin_dashboard';
$route['create'] = 'admins/create';
$route['products/edit/(:any)'] = 'admins/edit/$1';
$route['products/remove/(:any)'] = 'admins/confirm_delete/$1';
$route['products/save/(:any)'] = 'admins/update/$1';

/* ALL USER PROFILE ROUTE */
$route['profile'] = 'users/profile';
$route['profile/edit'] = 'users/update_profile';
$route['profile/password'] = 'users/update_password_profile';


/* USER ITEM ROUTE */
$route['products/show/(:any)'] = 'users/item/$1';
$route['products/add/(:any)'] = 'users/add_post/$1';
$route['products/comments/(:any)'] = 'users/add_comment/$1';

/* USER LOGOUT ROUTE */
$route['logout'] = 'users/logout';

/* PRODUCT ROUTES */
$route['product/validate'] = 'admins/process_product';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
