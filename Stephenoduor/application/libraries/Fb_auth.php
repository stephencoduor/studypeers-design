<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FB_auth {
    const BASE = "https://graph.facebook.com";

    private $apiVersion = "v2.6";
    private $tokenEndpoint;
    private $codeEndpoint;
    const CODE_BASE = "https://www.facebook.com/";
    private $app;
    public function __construct() {
        
        /* $this->config = $this->app->load->config('facebook'); */
        $this->facebook_app_id = "754026455378259";
        $this->facebook_login_redirect_url = "https://studypeers.ga/fb";
        $this->facebook_app_secret = "d16460a8a335104f754f048d2873c330";
        $this->scope = ['public_profile', 'email'];
        if (isset($this->app->config->facebook_graph_version)){
            $this->apiVersion = $this->app->config->facebook_graph_version;
        } 
        $this->tokenEndpoint = self::BASE.'/'.$this->apiVersion.'/oauth/access_token';
        $this->codeEndpoint = self::CODE_BASE.$this->apiVersion."/dialog/oauth";
        $this->state = bin2hex(random_bytes(12));
        
    }
    

    public function login_url () {
        $params = [
            "client_id" => $this->facebook_app_id,
            "state" => $this->state,
            "redirect_uri"  => $this->facebook_login_redirect_url,
            "scope" => implode(',',$this->scope)
        ];

        return $this->codeEndpoint.'?'. http_build_query( $params ) ;
        
    }

    private function getCode() {
        header("Location: ".$this->login_url());
    }
    function getToken() {
        $ci= & get_instance();
        if ($ci->session->userdata('fb_token')) {
            return $ci->session->userdata('fb_token');
        }

        if (!isset($_GET['code'])) {

            return $this->getCode();

        }
        $code = $_GET['code'];
        $params = [
            "code"=>$code,
            "client_id" => $this->facebook_app_id,
            "client_secret" => $this->facebook_app_secret,
            "redirect_uri"  => $this->facebook_login_redirect_url
        ];

        
        $response = $this->executeRequest($params);
        $response = json_decode($response);
       
        if (json_last_error()) 
        {
            die(json_last_error_msg());
        }
        // $ci->session->set_userdata()
        return $response;

    }

    function executeRequest($params,$endpoint = '') {
        if (!$endpoint) {
            $endpoint = $this->tokenEndpoint;
        }
            
        $handler = curl_init();
        curl_setopt( $handler, CURLOPT_URL, $endpoint. '?' . http_build_query( $params ) );
		curl_setopt( $handler, CURLOPT_RETURNTRANSFER, TRUE );
        curl_setopt( $handler, CURLOPT_SSL_VERIFYPEER, FALSE );
        
        $response = curl_exec($handler);
        curl_close($handler);
        return $response;
    }

    function getCurrentUser($token) {
        $params = [
            "fields" => "name,email",
            "access_token" => $token
        ];
      
        $endpoint = "https://graph.facebook.com/v2.6/me";
        return json_decode($this->executeRequest($params,$endpoint));
    }
}