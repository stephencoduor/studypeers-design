<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class DeleteEvent extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);

        // for header code 
        $headers    = apache_request_headers();

        $checkRequestKeys = array(                                        
                                    '0' => 'userId',
                                    '1' => 'event_id'
                                    );
        $resultJson = validateJson($requestJson, $checkRequestKeys);

        if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){ 
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))) {
                if ($resultJson == 1) { 

                    $data['userId']         = trim($requestJson[APP_NAME]['userId']);  
                    $data['event_id']        = trim($requestJson[APP_NAME]['event_id']);  

                    
                    
                    // print_r($headers);die;
                    $data['deviceId']       = $headers['Deviceid']; 
                    $data['deviceType']     = $headers['Devicetype']; 
                    $data['locale']         = $headers['Locale']; 

                    $checkData = $this->db->query("SELECT * FROM `user` WHERE id = ".$data['userId']."");

                    if($checkData->num_rows() != 0 )
                    {
            
                        $result = $this->ApiModel->deleteEvent($data);
                        
                        if($result == 1){
                            
                            generateServerResponse('1','222');

                        }else{
                            generateServerResponse('1','N');
                        }
                    
                    } else {
                        generateServerResponse('0','105');
                    }
                }else{
                    
                    generateServerResponse('0','101');              
                }
            } else{
                generateServerResponse('0','210');
            }
        } else{
                generateServerResponse('0','210');
        }

        
          
         
    }
}