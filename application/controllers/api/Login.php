<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class Login extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);
       
        $data['email']          = trim($requestJson[APP_NAME]['email']);  
        $data['password']       = trim($requestJson[APP_NAME]['password']);
        $data['fcmId']          = trim($requestJson[APP_NAME]['fcmId']); 

        

        $checkRequestKeys = array(                                        
                                    '0' => 'email',
                                    '1' => 'password',
                                    '2' => 'fcmId'
                                    );
        $resultJson = validateJson($requestJson, $checkRequestKeys);
        // for header code 
        $headers    = apache_request_headers();
        // print_r($headers);die;
        $data['deviceId']       = $headers['Deviceid']; 
        $data['deviceType']     = $headers['Devicetype']; 
        $data['locale']         = $headers['Locale']; 
         

       // check for header 
        $checkData = $this->db->query("SELECT * FROM `user` WHERE (username = '".$data['email']."' OR email = '".$data['email']."') AND password = sha1('".$data['password']."')");

       
        if($checkData->num_rows() != 0 )
        {
            $getUserData = $checkData->row_array();
              if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){
                if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))){
                            if ($resultJson == 1) { 
                                $userDetail = $this->ApiModel->userLogin($data);
                                    if($userDetail != 0){
                                        $response['userDetails'] = $userDetail;
                                        $response['courseDetail'] = $this->ApiModel->courseDetail($userDetail['userId']);
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
        else{
           generateServerResponse('0','166');
        }   
         
    }
}