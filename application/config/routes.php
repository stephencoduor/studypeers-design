<?php
defined('BASEPATH') or exit('No direct script access allowed');

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


$route['admin/(:any)/(:any)']               = "Admin/$1";
$route['admin/(:any)/(:any)/(:any)']        = "Admin/$1/$1";
$route['admin/(:any)/(:any)/(:any)/(:any)'] = "Admin/$1/$1/$1";
$route['admin'] = "Admin/index";


/**
 * chat module routes
 * 
 */

$route['account/find-my-peers'] = "ChatController/getPeers";
$route['account/add-new-peers']  = "ChatController/addNewPeers";
$route['account/submit-chat-users'] = "ChatController/createUserGroup";
$route['account/get-user-groups'] = "ChatController/getUserChat";
$route['account/get-user-group-chat-name'] = "ChatController/getUserGroupNames";
$route['account/add-new-group-member'] = "ChatController/addNewGroupMember";
$route['account/upload-document-server'] = "ChatController/uploadDocumentServer";
$route['submit-single-chat-user'] = "ChatController/createSingleUserGroup";

/**
 * login routes
 * 
 */

$route['login'] = "LoginController/index";
$route['signup'] = "LoginController/signUp";
$route['login/verify-otp'] = "LoginController/verifyOTP";
$route['login/resend-otp-page'] = "LoginController/resendOTPPage";
$route['submit'] = "LoginController/submitSignUpForm";
$route['submit-login-form'] = "LoginController/submitLoginForm";
$route['logout'] = "HomeController/logoutUser";


$route['complete-step'] = "BaseController/index";

/**
 * step submit routes.
 */

$route['home/step-register'] = "HomeController/stepRegisterPage";
$route['submit-step-one'] = "HomeController/submitStepWiseData";
$route['home/step-two-page'] = "HomeController/stepTwoPage";
$route['get-my-university-list'] = "HomeController/getMyUniversityList";
$route['get-university-field-list'] = "HomeController/getFieldList";
$route['get-university-major-field'] = "HomeController/getMajorList";


$route['upload-document-regisration'] = "HomeController/uploadDocument";
$route['home/step-three-page'] = "HomeController/stepThreePage";

$route['home/step-four-page']  = "HomeController/stepFourPage";

$route['Profile/find-my-peers'] = "Profile/getPeers";

$route['sp/(:any)'] = "Profile/friends/$1";

$route['study-tools'] = "Home/studyTools";
$route['connect-with-peers'] = "Home/connectWithPeers";
$route['for-professor'] = "Home/forProfessor";


$route['about-us'] = "Home/aboutUs";
$route['terms-conditions'] = "Home/termsCondition";
$route['privacy-policy'] = "Home/privacyPolicy";
$route['contact-us'] = "Home/contactUs";
$route['FAQ'] = "Home/FAQ";


$route['search-result'] = "Account/searchResult";