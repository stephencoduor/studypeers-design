<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");

// API PrivacyPolicy Controller
class PrivacyPolicy extends CI_Controller {
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
        
       // check for header 
        $getData = $this->db->query("SELECT * FROM `page_data_master` WHERE id = 1")->row_array();

        /*$loungeData = $this->db->get_where('loungeMaster', array('loungeId'=>$data['loungeId'],'imeiNumber'=>$data['imeiNumber'],'status'=>'1'));*/
       
        
        if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))){
                    
                $response['privacy'] = $getData['privacy'];
                generateServerResponse('1','S', $response);     
                        
            } else{
                generateServerResponse('0','210');
            }
        }else{
                generateServerResponse('0','W');
        }
        
         
    }
}