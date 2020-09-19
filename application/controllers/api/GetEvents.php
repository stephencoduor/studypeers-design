<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/json");
class GetEvents extends CI_Controller {
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
                                    '2' => 'startdate',
                                    '3' => 'course',
                                    '4' => 'professor',
                                    '5' => 'search_keyword'
                                    );
        $resultJson = validateJson($requestJson, $checkRequestKeys);

        if(!empty($headers['Deviceid']) && !empty($headers['Package'] && !empty($headers['Devicetype']))){ 
            if(($headers['Package'] == strtolower(md5(PACKAGE)) || $headers['Package'] == strtoupper(md5(PACKAGE)))) {
                if ($resultJson == 1) { 

                    $data['userId']         = trim($requestJson[APP_NAME]['userId']);  
                    $data['offset']         = trim($requestJson[APP_NAME]['offset']);  
                    $data['startdate']      = trim($requestJson[APP_NAME]['startdate']);  
                    $data['course']         = trim($requestJson[APP_NAME]['course']);  

                    $data['professor']         = trim($requestJson[APP_NAME]['professor']);  
                    $data['search_keyword']    = trim($requestJson[APP_NAME]['search_keyword']);  
                    
                    // print_r($headers);die;
                    $data['deviceId']       = $headers['Deviceid']; 
                    $data['deviceType']     = $headers['Devicetype']; 
                    $data['locale']         = $headers['Locale']; 

                    $checkData = $this->db->query("SELECT * FROM `user` WHERE id = ".$data['userId']."");

                    if($checkData->num_rows() != 0 )
                    {
            
                        $result = $this->ApiModel->getEvents($data);
                        $response['total_count'] = $result['count'];
                        if(!empty($result['res'])){
                            foreach ($result['res'] as $key => $value) {
                                $response['events'][$key]['event_id']   = $value['id'];
                                $response['events'][$key]['event_name'] = $value['event_name'];
                                $response['events'][$key]['location']   = $value['location_txt'];
                                $response['events'][$key]['latitude']   = $value['latitude'];
                                $response['events'][$key]['longitude']  = $value['longitude'];
                                $response['events'][$key]['start_date'] = $value['start_date'];
                                $response['events'][$key]['start_time'] = $value['start_time'];
                                $response['events'][$key]['end_date']   = $value['end_date'];
                                $response['events'][$key]['end_time']   = $value['end_time'];
                                $response['events'][$key]['description']   = $value['description'];

                                $response['events'][$key]['institute_id']   = $value['university'];
                                $response['events'][$key]['institute_name'] = $value['institute_name'];
                                $response['events'][$key]['course_id']      = $value['course'];
                                $response['events'][$key]['course_name']    = $value['course_name'];
                                $response['events'][$key]['professor_id']   = $value['professor'];
                                $response['events'][$key]['professor_name'] = $value['professor_name'];
                                $response['events'][$key]['user_id']        = $value['created_by'];
                                $response['events'][$key]['user_name']      = $value['user_name'];

                                $response['events'][$key]['session']        = "";

                                $response['events'][$key]['added_to_calender']   = $value['addedToCalender'];
                                if(!empty($value['featured_image'])){
                                    $response['events'][$key]['image'] = base_url().'uploads/users/'.$value['featured_image'];
                                } else {
                                    $response['events'][$key]['image'] = "";
                                }

                                $get_comment_count = $this->db->get_where('comment_master', array('reference_id' => $value['id'], 'reference' => 'event', 'comment_parent_id' => 0, 'status' => 1))->num_rows();
                                $get_like_count = $this->db->get_where('like_master', array('reference' => 'event','reference_id' => $value['id'], 'status' => 1))->num_rows();

                                $response['events'][$key]['like_count']     = $get_like_count;
                                $response['events'][$key]['comment_count']  = $get_comment_count;
                                $response['events'][$key]['share_count']    = 0;
                                $response['events'][$key]['created_at']     = $value['created_at'];
                                
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