<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['admin'] = "admin/cdashboard";
$route['admin/dashboard'] = "admin/cdashboard";
$route['admin/dashboard/(:any)'] = "admin/cdashboard/$1"; 
$route['admin/main_category'] = "admin/cmain_category";
$route['admin/main_category/(:any)'] = "admin/cmain_category/$1";
$route['admin/subject'] = "admin/csubject";
$route['admin/subject/(:any)'] = "admin/csubject/$1";
$route['admin/chapter'] = "admin/cchapter";
$route['admin/chapter/(:any)'] = "admin/cchapter/$1";
$route['admin/question'] = "admin/cquestion";
$route['admin/question/(:any)'] = "admin/cquestion/$1";
$route['admin/model_test_category'] = "admin/cmodel_test_category";
$route['admin/model_test_category/(:any)'] = "admin/cmodel_test_category/$1";
$route['admin/model_test_sub_category'] = "admin/cmodel_test_sub_cat";
$route['admin/model_test_sub_category/(:any)'] = "admin/cmodel_test_sub_cat/$1";
$route['admin/model_test'] = "admin/cmodel_test";
$route['admin/model_test/(:any)'] = "admin/cmodel_test/$1";

