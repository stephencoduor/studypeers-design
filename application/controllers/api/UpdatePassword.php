<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class UpdatePassword extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);
       
        $data['user_id']        = trim($requestJson[APP_NAME]['user_id']); 
        $data['password']       = trim($requestJson[APP_NAME]['password']);  
        
        

        $checkRequestKeys = array(                                        
                                    '0' => 'user_id',
                                    '1' => 'password'
                                    );
        $resultJson = validateJson($requestJson, $checkRequestKeys);
        // for header code 
        $headers    = apache_request_headers();
        // print_r($headers);die;
        $data['deviceId']       = $headers['Deviceid']; 
        $data['deviceType']     = $headers['Devicetype']; 
        $data['locale']         = $headers['Locale']; 
         

       // check for header 
        $checkData = $this->db->query("SELECT * FROM `user` WHERE (id = '".$data['user_id']."')");

        
        if($checkData->num_rows() != 0 )
        {
            $getUserData = $checkData->row_array();
              if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){
                if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))){
                            if ($resultJson == 1) { 
                                $userDetail = $checkData->row_array();
                                $chk = $this->ApiModel->updatePassword($userDetail['id'], $data['password']);
                                
                                    if($chk == 1){
                                        $response['user_id'] = $userDetail['id'];
                                        generateServerResponse('1','108', $response);

                                    }else{
                                        generateServerResponse('0','W');
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
           generateServerResponse('0','105');
        }   
         
    }
}