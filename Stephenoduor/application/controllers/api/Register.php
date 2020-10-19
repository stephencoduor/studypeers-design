<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");

// API Register Controller
class Register extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);
        
        $data['username']       = trim($requestJson[APP_NAME]['username']); 
        $data['email']          = trim($requestJson[APP_NAME]['email']);  
        $data['password']       = trim($requestJson[APP_NAME]['password']);
        

        

        $checkRequestKeys = array(                                        
                                    '0' => 'username',
                                    '1' => 'email',
                                    '2' => 'password'
                                    );
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
                            $user_id = $this->ApiModel->userRegister($data);
                            if($user_id != 0){

                                $response['user_id'] = $user_id;
                                $response['user_email'] = $data['email'];
                                generateServerResponse('1','S', $response);

                            }else{
                                generateServerResponse('0','P');
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