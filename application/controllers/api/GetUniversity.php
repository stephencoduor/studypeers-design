<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class GetUniversity extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);
        
        $data['offset']         = trim($requestJson[APP_NAME]['offset']);  
        $data['keyword']        = trim($requestJson[APP_NAME]['keyword']);
        

        

        $checkRequestKeys = array(                                        
                                    '0' => 'offset',
                                    '1' => 'keyword'
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
                    $result = $this->ApiModel->getUniversity($data);
                    if(!empty($result['res'])){
                        
                        $response['total_count'] = $result['count'];
                        $response['university_list'] = $result['res'];
                        
                        generateServerResponse('1','S', $response);

                    }else{
                        generateServerResponse('1','E');
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