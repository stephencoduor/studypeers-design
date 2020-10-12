<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class AddReplyImage extends CI_Controller {
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
                                    '1' => 'comment_id',
                                    '2' => 'image'
                                    );
        $resultJson = validateJson($requestJson, $checkRequestKeys);

        if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){ 
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))) {
                if ($resultJson == 1) { 

                    $data['userId']         = trim($requestJson[APP_NAME]['userId']);  
                    $data['comment_id']     = trim($requestJson[APP_NAME]['comment_id']);  
                    $data['image']          = trim($requestJson[APP_NAME]['image']);  
                    
                    // print_r($headers);die;
                    $data['deviceId']       = $headers['Deviceid']; 
                    $data['deviceType']     = $headers['Devicetype']; 
                    $data['locale']         = $headers['Locale']; 

                    $checkData = $this->db->query("SELECT * FROM `user` WHERE id = ".$data['userId']."");

                    if($checkData->num_rows() != 0 )
                    {
            
                        $result = $this->ApiModel->addReplyImage($data);
                        
                        if(!empty($result)){
                            $value = $this->db->get_where('comment_master', array('id' => $result))->row_array();
                            $get_user = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();

                            $response['comment']['comment_parent_id']       = $value['comment_parent_id'];
                            $response['comment']['reference']        = $value['reference'];
                            $response['comment']['reference_id']     = $value['reference_id'];
                            $response['comment']['user_id']          = $value['user_id'];
                            $response['comment']['user_name']        = $get_user['nickname'];
                            $response['comment']['type']             = $value['type'];
                            $response['comment']['created_at']       = $value['created_at'];

                            if($value['type'] == 1){
                                $response['comment']['reply'] = base_url().'uploads/comments/'.$value['comment'];
                            } else {
                                $response['comment']['reply'] = $value['comment'];
                            }

                            generateServerResponse('1','225', $response);

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