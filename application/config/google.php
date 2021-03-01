<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '808891959485-jgluqc01l6b7q8ghseqe71j4qtv84fa0.apps.googleusercontent.com';
$config['google']['client_secret']    = 'vOudl_UEPMA7JAKXxz6yh6ya';
$config['google']['redirect_uri']     = 'socialLogin/googleCallback';
$config['google']['application_name'] = 'Study Peers';
$config['google']['api_key']          = 'AIzaSyDq2nes2KPwH_6QNMbWEa1ELgoFtKF2Kh4';
$config['google']['scopes']           = array();
