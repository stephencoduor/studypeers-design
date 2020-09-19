<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class GetEventDetail extends CI_Controller {
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
            
                        $result = $this->ApiModel->getEventDetail($data);
                        
                        if(!empty($result)){
                            
                                $event['event_id']   = $result['id'];
                                $event['event_name'] = $result['event_name'];
                                $event['location']   = $result['location_txt'];
                                $event['latitude']   = $result['latitude'];
                                $event['longitude']  = $result['longitude'];
                                $event['start_date'] = $result['start_date'];
                                $event['start_time'] = $result['start_time'];
                                $event['end_date']   = $result['end_date'];
                                $event['end_time']   = $result['end_time'];
                                $event['description']   = $result['description'];

                                $event['institute_id']   = $result['university'];
                                $event['institute_name'] = $result['institute_name'];
                                $event['course_id']      = $result['course'];
                                $event['course_name']    = $result['course_name'];
                                $event['professor_id']   = $result['professor'];
                                $event['professor_name'] = $result['professor_name'];
                                $event['user_id']        = $result['created_by'];
                                $event['user_name']      = $result['user_name'];

                                $event['session']        = "";

                                $event['added_to_calender']   = $result['addedToCalender'];
                                if(!empty($result['featured_image'])){
                                    $event['image'] = base_url().'uploads/users/'.$result['featured_image'];
                                } else {
                                    $event['image'] = "";
                                }
                                $get_comment_count = $this->db->get_where('comment_master', array('reference_id' => $result['id'], 'reference' => 'event', 'comment_parent_id' => 0, 'status' => 1))->num_rows();
                                $get_like_count = $this->db->get_where('like_master', array('reference' => 'event','reference_id' => $result['id'], 'status' => 1))->num_rows();
                                $event['like_count']     = $get_like_count;
                                $event['comment_count']  = $get_comment_count;
                                $event['share_count']    = 0;
                                $event['created_at']     = $result['created_at'];
                                
                            
                            
                            $response['event_details']   = $event;
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