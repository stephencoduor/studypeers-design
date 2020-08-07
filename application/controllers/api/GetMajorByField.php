<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class GetMajorByField extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);
       
        $field_id         = trim($requestJson[APP_NAME]['field_id']); 
        
        $headers    = apache_request_headers();
        
       // check for header 
        $getData = $this->db->query("SELECT * FROM `major_master` WHERE field_id = ".$field_id)->result_array();

        
        
        if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))){
                    
                $response['major_list'] = $getData;
                generateServerResponse('1','S', $response);     
                        
            } else{
                generateServerResponse('0','210');
            }
        }else{
                generateServerResponse('0','W');
        }
        
         
    }
}