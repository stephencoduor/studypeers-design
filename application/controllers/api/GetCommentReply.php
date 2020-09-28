<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class GetCommentReply extends CI_Controller {
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
                                    '1' => 'offset',
                                    '2' => 'comment_id'
                                    );
        $resultJson = validateJson($requestJson, $checkRequestKeys);

        if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){ 
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))) {
                if ($resultJson == 1) { 

                    $data['userId']         = trim($requestJson[APP_NAME]['userId']);  
                    $data['offset']         = trim($requestJson[APP_NAME]['offset']);  
                    $data['comment_id']     = trim($requestJson[APP_NAME]['comment_id']);  
                    
                    
                    // print_r($headers);die;
                    $data['deviceId']       = $headers['Deviceid']; 
                    $data['deviceType']     = $headers['Devicetype']; 
                    $data['locale']         = $headers['Locale']; 

                    $checkData = $this->db->query("SELECT * FROM `user` WHERE id = ".$data['userId']."");

                    if($checkData->num_rows() != 0 )
                    {
            
                        $result = $this->ApiModel->getCommentReply($data);
                        $response['total_count'] = $result['count'];
                        if(!empty($result['res'])){
                            foreach ($result['res'] as $key => $value) {
                                $response['comments'][$key]['comment_parent_id']        = $value['comment_parent_id'];
                                $response['comments'][$key]['reference']        = $value['reference'];
                                $response['comments'][$key]['reference_id']     = $value['reference_id'];
                                $response['comments'][$key]['user_id']          = $value['user_id'];
                                $response['comments'][$key]['type']             = $value['type'];
                                $response['comments'][$key]['created_at']       = $value['created_at'];
                                
                                if($value['type'] == 1){
                                    $response['comments'][$key]['comment'] = base_url().'uploads/comments/'.$value['comment'];
                                } else {
                                    $response['comments'][$key]['comment'] = $value['comment'];
                                }
                               
                                
                            }
                            
                            
                            generateServerResponse('1','S', $response);

                        }else{
                            generateServerResponse('1','E');
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