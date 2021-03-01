<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");

// API SaveRegistrationStepWise Controller
class SaveRegistrationStepWise extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);
        
        $data['step']         = trim($requestJson[APP_NAME]['step']);  
        $data['user_id']      = trim($requestJson[APP_NAME]['user_id']);  
        
        if($data['step'] == 1) {
            $data['first_name']         = trim($requestJson[APP_NAME]['first_name']);
            $data['last_name']          = trim($requestJson[APP_NAME]['last_name']);
            $data['mobile_no']          = trim($requestJson[APP_NAME]['mobile_no']);
            $data['dob']                = trim($requestJson[APP_NAME]['dob']);
            $data['gender']             = trim($requestJson[APP_NAME]['gender']);
            $data['country_code']       = trim($requestJson[APP_NAME]['country_code']);

            $checkRequestKeys = array(                                        
                                    '0' => 'first_name',
                                    '1' => 'last_name',
                                    '2' => 'mobile_no',
                                    '3' => 'dob',
                                    '4' => 'gender',
                                    '5' => 'country_code',
                                    '6' => 'user_id'
                                );
        } else if($data['step'] == 2) {
            $data['institute_type']         = trim($requestJson[APP_NAME]['institute_type']);
            $data['institute_id']           = trim($requestJson[APP_NAME]['institute_id']);
            $data['add_institute']          = trim($requestJson[APP_NAME]['add_institute']);
            $data['intitution_email']       = trim($requestJson[APP_NAME]['intitution_email']);
            $data['intitution_idcard']      = trim($requestJson[APP_NAME]['intitution_idcard']);
            $data['manual_verification']    = trim($requestJson[APP_NAME]['manual_verification']);

            $checkRequestKeys = array(                                        
                                    '0' => 'institute_type',
                                    '1' => 'institute_id',
                                    '2' => 'add_institute',
                                    '3' => 'intitution_email',
                                    '4' => 'intitution_idcard',
                                    '5' => 'manual_verification'
                                );


        } else if($data['step'] == 3) {
            $data['field_type']         = trim($requestJson[APP_NAME]['field_type']);
            $data['field']              = trim($requestJson[APP_NAME]['field']);
            $data['major_type']         = trim($requestJson[APP_NAME]['major_type']);
            $data['major']              = trim($requestJson[APP_NAME]['major']);
            $data['degree']             = trim($requestJson[APP_NAME]['degree']);
            $data['session']            = trim($requestJson[APP_NAME]['session']);
            $data['field_interest']     = trim($requestJson[APP_NAME]['field_interest']);

            $checkRequestKeys = array(                                        
                                    '0' => 'field_type',
                                    '1' => 'field',
                                    '2' => 'major_type',
                                    '3' => 'major',
                                    '4' => 'degree',
                                    '5' => 'session',
                                    '6' => 'field_interest'
                                );


        } else if($data['step'] == 4) {
            $data['profile_setting']      = trim($requestJson[APP_NAME]['profile_setting']);
            $data['privacy']              = trim($requestJson[APP_NAME]['privacy']);
            $data['nickname_text']        = trim($requestJson[APP_NAME]['nickname_text']);

            $checkRequestKeys = array(                                        
                                    '0' => 'profile_setting',
                                    '1' => 'privacy',
                                    '2' => 'nickname_text'
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
                    $result = $this->ApiModel->saveRegistrationStepWise($data);
                    if($result != 0){

                        $response['user_id'] = $data['user_id'];
                        
                        generateServerResponse('1','S', $response);

                    }else{
                        generateServerResponse('0','W');
                    }
                }else{
                    
                    generateServerResponse('0','101');              
                }
            } else{
                generateServerResponse('0','210');
            }
        }else{
                generateServerResponse('0','W');
        }
          
         
    }
}