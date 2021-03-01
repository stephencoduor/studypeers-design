<?php
namespace StudyPeersApi;
defined('BASEPATH') or exit('No direct script access allowed');

use Studypeers\CanvasApi\CanvasApiConfig;

class CanvasConfig extends CanvasApiConfig {

    public function __construct() {
        
        /**
         * application instance
         * @var \CI_Controller $CI
         */

        $CI = &get_instance();

        //load api config
        // $CI->load->config('smtech');
        
        
        //set api tld(top level domain)
        // $this->setApiHost("https://canvas-lms.ga");
        //set api token
        //TODO token to be fetched from session.

        // $this->setToken($CI->session->userdata('access_token')); //uncomment this line when auth works
        // $this->setToken("PFK4p62bXPnb0FyXmdc9SFOcvEnkMo1nzsSUDbNsQQqQqTsTfKsH8eOznrvL1zFl");
    }
}