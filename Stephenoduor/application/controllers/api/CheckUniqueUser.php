<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");

// API CheckUniqueUser Controller
class CheckUniqueUser extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);
        
        $data['type']           = trim($requestJson[APP_NAME]['type']);
        
        
        
        if($data['type'] == 'username') {
            $data['username']       = trim($requestJson[APP_NAME]['value']);
            $checkRequestKeys = array(                                        
                                    '0' => 'value'
                                    );
        } else if($data['type'] == 'email') {
            $data['email']          = trim($requestJson[APP_NAME]['value']); 
            $checkRequestKeys = array(                                        
                                    '0' => 'value'
                                    );
        } 
        $resultJson = validateJson($requestJson, $checkRequestKeys);
        // for header code 
        $headers    = apache_request_headers();
        // print_r($headers);die;
        $data['deviceId']       = $headers['Deviceid']; 
        $data['deviceType']     = $headers['Devicetype']; 
        $data['locale']         = $headers['Locale']; 
         

        
          if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))){
                        if ($resultJson == 1) { 
                            $user_id = $this->ApiModel->checkUniqueUsername($data);
                            if($user_id != 0){
                                if($data['type'] == 'username') {
                                    generateServerResponse('0','U');
                                } else if($data['type'] == 'email') {
                                    generateServerResponse('0','A');
                                }
                                
                            }else{
                                generateServerResponse('1','S');
                            }
                        }else{
                            
                            generateServerResponse('0','101');              
                        }
                   }else{
                     generateServerResponse('0','210');
                   }
            }else{
                generateServerResponse('0','W');
            }
          
         
    }
}