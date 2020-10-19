<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook App details
| -------------------------------------------------------------------
|
| To get an facebook app details you have to be a registered developer
| at http://developer.facebook.com and create an app for your project.
|
|  facebook_app_id               string   Your facebook app ID.
|  facebook_app_secret           string   Your facebook app secret.
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string   URL tor redirect back to after login. Do not include domain.
|  facebook_logout_redirect_url  string   URL tor redirect back to after login. Do not include domain.
|  facebook_permissions          array    The permissions you need.
|  facebook_graph_version        string   Set Facebook Graph version to be used. Eg v2.6
|  facebook_auth_on_load         boolean  Set to TRUE to have the library to check for valid access token on every page load.
*/

$config['canvas_app_id']              = '10000000000001';
$config['canvas_app_secret']          = 'Wh3Qik6peTBtCcetGYrsCfLRGiegnQQBl0qPlP8VWIX0N4gNFypC2Hp0CNi7soC4';
$config['canvas_login_type']          = 'web';
$config['canvas_login_redirect_url']  = 'https://canvas-lms.ga/';
$config['canvas_logout_redirect_url'] = 'http://study.co.ke/admin/dashboard';
$config['canvas_permissions']         = array('public_profile', 'publish_actions', 'email');
$config['canvas_graph_version']       = 'v2.6';
$config['canvas_auth_on_load']        = TRUE;
$config['canvas_host']  =   "https://canvas-lms.ga";
