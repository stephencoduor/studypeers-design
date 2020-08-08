<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class GetSessions extends CI_Controller {
  public function __construct()
    {
        parent::__construct();         
        $this->load->model('api/ApiModel');
      
    }
    public function index()
    {
        $requestData           = isset($HTTpres_RAW_POST_DATA) ? $HTTpres_RAW_POST_DATA : file_get_contents('php://input');
        $requestJson           = json_decode($requestData, true);
       
        
        $headers    = apache_request_headers();
        
        
        if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))){
                $arr = array('Summer 2020', 'Winter 2019/20', 'Summer 2019', 'Winter 2018/19', 'Summer 2018', 'Winter 2017/18');
                $response['session'] = $arr;
                generateServerResponse('1','S', $response);     
                        
            } else{
                generateServerResponse('0','210');
            }
        }else{
                generateServerResponse('0','W');
        }
        
         
    }
}