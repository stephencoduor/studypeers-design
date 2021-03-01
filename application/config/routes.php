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

$route['admin/lms/delete/(:num)']["post"] = "SchoolController/deleteLmsSystem/$1";
$route['admin/lms/update/(:num)'] = "SchoolController/updateLms/$1";
$route['admin/viewLms'] = "SchoolController/manageLms";
$route['admin/addLms'] = "SchoolController/addLms";
$route['admin/school/filtered'] = "SchoolController/filteredSchools";

$route['admin/school/update/(:num)'] = "SchoolController/update_school/$1";
$route['admin/school/delete/(:num)']["post"] = "SchoolController/delete_school/$1";

$route['admin/(:any)/(:any)']               = "Admin/$1";
$route['admin/(:any)/(:any)/(:any)']        = "Admin/$1/$1";
$route['admin/(:any)/(:any)/(:any)/(:any)'] = "Admin/$1/$1/$1";
$route['admin'] = "Admin/index";
$route['admin'] = "Admin/index";


$route['token_success'] = "Canvas/login";
$route['fb'] = "Canvas/fblogin";
$route['canvas'] = "Canvas/test";
$route['accounts'] = "canvas_accounts/list_accounts";
$route['users'] = "canvas_users/showUserDetails";
$route['accounts/(:num)/users'] = "canvas_users/listUsersInAccount/$1";
$route['users/stream'] = "canvas_users/listActivityStream";
$route['accounts/(:num)/createUser'] = "canvas_users/createUser/$1";
$route['courses'] = "canvas_courses/listCourses";
//$route['courses/sync'] = 'Account/syncCourses';
$route['courses/sync'] = 'CourseDetailSync/syncCourses';
$route['assignments/sync'] = 'Account/syncAssignments';
$route['results/sync'] = 'Account/syncResults';
$route['discussions/sync'] = 'Account/syncDiscussions';
$route['announcements/sync'] = 'Account/syncAnnouncements';
$route['quizzes/sync'] = 'Account/syncQuizzes';

//customized for testing urls for ui

$route['ui/testing/index'] = 'SchoolController/index';
$route['ui/testing/quizzes'] = 'SchoolController/quizzes';
$route['ui/testing/submissions'] = 'SchoolController/submissions';
$route['ui/testing/files'] = 'SchoolController/files';
$route['ui/testing/grades'] = 'SchoolController/grades';
$route['ui/testing/notifications'] = 'SchoolController/notifications';
$route['ui/testing/discussions'] = 'SchoolController/discussions';
$route['ui/testing/assignments'] = 'SchoolController/assignments';

//back to real url mapping
$route['account/schools'] = 'SchoolController/universities';
$route['account/token/add']["post"] = 'SchoolController/save_canvas_token';
$route['account/token/update/(:num)']["post"] = 'SchoolController/update_user_token/$1';
$route['account/token/delete/(:num)']["post"] = 'SchoolController/deleteLms/$1';
$route['account/profile/settings'] = 'SchoolController/user_profileSettings';
$route['account/profile/settings/lms/(:num)'] = 'SchoolController/lmsSettings/$1';
$route['account/schools/(:num)'] = 'SchoolController/schoolProfile/$1';


$route['school/assignment/(:num)'] = 'SchoolController/viewAssignment/$1';
$route['school/file/(:num)'] = 'SchoolController/viewFile/$1';
$route['school/notification/(:num)'] = 'SchoolController/notificationDetail/$1';
$route['school/discussion/(:num)'] = 'SchoolController/discussionDetail/$1';
$route['school/result/(:num)'] = 'SchoolController/resultDetail/$1';
$route['school/submission/(:num)'] = 'SchoolController/submissionDetail/$1';
$route['school/quizz/(:num)'] = 'SchoolController/viewQuiz/$1';
$route['school/discussion/(:num)'] = 'SchoolController/viewDiscussion/$1';
$route['account/schools/(:num)/course/(:num)'] = 'SchoolController/courseDetail/$1/$2';


