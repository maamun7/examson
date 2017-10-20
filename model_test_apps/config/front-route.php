<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['home'] = "exm_home";
$route['home/(:any)'] = "exm_home/$1";
$route['exam-center'] = "front/exm_exam_center";
$route['exam-center/(:any)'] = "front/exm_exam_center/$1";
$route['exam'] = "user_profile/exm_exam";
$route['exam/(:any)'] = "user_profile/exm_exam/$1";
$route['user'] = "user_profile/Exm_user";
$route['user/(:any)'] = "user_profile/exm_user/$1";
$route['exam_activity'] = "user_profile/exm_exam_activity";
$route['exam_activity/(:any)'] = "user_profile/exm_exam_activity/$1";
$route['auth'] = "front/exm_auth";
$route['auth/(:any)'] = "front/exm_auth/$1";

/*
$route['signin'] = "front/exm_signin";
$route['signin/(:any)'] = "front/exm_signin/$1";
$route['signup'] = "front/exm_signup";
$route['signup/(:any)'] = "front/exm_signup/$1";

*/

