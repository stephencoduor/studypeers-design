<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$config['google']['client_id']        = '183108033073-b44b0k3qchofqgfb3r7e7qbdcnjj9k55.apps.googleusercontent.com';
$config['google']['client_secret']    = '6gio3UhMqGSBBnAt_T1GLeat';
$config['google']['redirect_uri']     = 'socialLogin/googleCallback';
$config['google']['application_name'] = 'Study Peers';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();