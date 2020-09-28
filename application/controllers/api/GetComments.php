<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class GetComments extends CI_Controller {
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
                                    '2' => 'reference',
                                    '3' => 'reference_id'
                                    );
        $resultJson = validateJson($requestJson, $checkRequestKeys);

        if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){ 
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))) {
                if ($resultJson == 1) { 

                    $data['userId']         = trim($requestJson[APP_NAME]['userId']);  
                    $data['offset']         = trim($requestJson[APP_NAME]['offset']);  
                    $data['reference']      = trim($requestJson[APP_NAME]['reference']);  
                    $data['reference_id']   = trim($requestJson[APP_NAME]['reference_id']);  

                    
                    // print_r($headers);die;
                    $data['deviceId']       = $headers['Deviceid']; 
                    $data['deviceType']     = $headers['Devicetype']; 
                    $data['locale']         = $headers['Locale']; 

                    $checkData = $this->db->query("SELECT * FROM `user` WHERE id = ".$data['userId']."");

                    if($checkData->num_rows() != 0 )
                    {
            
                        $result = $this->ApiModel->getComments($data);
                        $response['total_count'] = $result['count'];
                        if(!empty($result['res'])){
                            foreach ($result['res'] as $key => $value) {

                                $get_like_count = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1))->num_rows();
                                $get_reply_count = $this->db->get_where('comment_master', array('comment_parent_id' => $value['id'], 'status' => 1))->num_rows();
                                $get_user = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();

                                $response['comments'][$key]['comment_id']        = $value['id'];
                                $response['comments'][$key]['reference']        = $value['reference'];
                                $response['comments'][$key]['reference_id']     = $value['reference_id'];
                                $response['comments'][$key]['user_id']          = $value['user_id'];
                                $response['comments'][$key]['user_name']        = $get_user['nickname'];
                                $response['comments'][$key]['type']             = $value['type'];
                                $response['comments'][$key]['created_at']       = $value['created_at'];
                                $response['comments'][$key]['likeCount']        = $get_like_count;
                                $response['comments'][$key]['replyCount']       = $get_reply_count;
                                
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