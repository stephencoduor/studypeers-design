<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GoogleCalendar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->config->load('google', TRUE);
        $this->load->model('user_model');

    }

    public function schedules()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        //get events from event_master db
        $user_info = $this->db->get_where('event_master', array('created_by' => $user_id))->result_array();
        $events = array();
        if(count($user_info) > 0){
            foreach($user_info as $info){
                $events[] = [
                    "title" => $info['event_name'],
                    "start" => $info['start_date'],
                    "end" => $info['end_date']
                ];
            }
        }

        $this->load->view('user/schedule/full-calendar');
    }

    public function checkGoogleLogin()
    {
        $google_config = $this->config->item('google');
        $client = new Google_Client();
        $client->setApplicationName($google_config['google']['application_name']);
        $client->setDeveloperKey($google_config['google']['api_key']);
        $service = new Google_Service_Books($client);
       /* if(isset($this->session->get_userdata()['google_login'])){
            $check_google_login = $this->session->get_userdata()['google_login'];
            if($check_google_login){
                //already logged in with google
                //get access token from db
                $user_id = $this->session->get_userdata()['user_data']['user_id'];
                $social_id = $this->user_model->getGoogleSocialLoginToken($user_id);
                echo "Social id from db ";
                print_r($social_id);die;
            }else{
                echo 'No';
            }
        }*/
        $client = new Google_Client();
        $client->setApplicationName($google_config['google']['application_name']);
        $client->setClientId($google_config['google']['client_id']);
        $client->setClientSecret($google_config['google']['client_secret']);
        $client->setRedirectUri( base_url('GoogleCalendar/loginCallback'));
        $client->addScope(array('https://www.googleapis.com/auth/calendar.readonly'));
        $client->addScope("profile");
        //Send Client Request
        $objOAuthService = new Google_Service_Oauth2($client);
        $authUrl = $client->createAuthUrl();
        header('Location: '.$authUrl);

    }

    public function loginCallback()
    {
        $google_config = $this->config->item('google');
        // Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
        $client_id = $google_config['google']['client_id'];
        $client_secret = $google_config['google']['client_secret'];
        $redirect_uri = base_url('GoogleCalendar/loginCallback');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];

        //Create Client Request to access Google API
        $client = new Google_Client();
        $client->setApplicationName($google_config['google']['application_name']);
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope(array('https://www.googleapis.com/auth/calendar.events.readonly','email','profile'));
        //Send Client Request
        $service = new Google_Service_Oauth2($client);
        $client->authenticate($_GET['code']);
        $access_token = $client->getAccessToken();
        $service = new Google_Service_Calendar($client);

        $calendarList  = $service->calendarList->listCalendarList();
        if(count($calendarList->getItems()) > 0) {
            $this->db->where(array('created_by' => $user_id, 'google_events' => 1));
            $this->db->delete('schedule_master');
            $this->db->where(array('created_by' => $user_id, 'google_events' => 1));
            $this->db->delete('event_master');
            foreach ($calendarList->getItems() as $calendarListEntry) {
                $events = $service->events->listEvents($calendarListEntry->id);
                foreach($events->getItems() as $eventItems){
                    $event_data = [];

                    if($eventItems['creator']['email'] != 'en.indian#holiday@group.v.calendar.google.com'){
                        $event_name = $eventItems['summary'];
                        $event_id = $eventItems['id'];
                        $description = $eventItems['description'];
                        $location = $eventItems['location'];
                        $start_date = $eventItems['start']['date'];
                        $start_datetime = $eventItems['start']['dateTime'];
                        $end_date = $eventItems['end']['date'];
                        $end_datetime = $eventItems['end']['dateTime'];
                        $event_data = [
                            'schedule' => 'others',
                            'schedule_name' => $event_name,
                            'schedule_id' => $event_id,
                            'description' => $description,
                            'location' => $location,
                            'status' => 1,
                            'created_by' => $user_id
                        ];
                        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($location)."&key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU";
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $responseJson = curl_exec($ch);
                        curl_close($ch);
                        $response = json_decode($responseJson);
                        if ($response->status == 'OK') {
                            $latitude = $response->results[0]->geometry->location->lat;
                            $longitude = $response->results[0]->geometry->location->lng;
                        } else {
                            $latitude = 0;
                            $longitude = 0;
                        }
                        $event_data['latitude'] = $latitude;
                        $event_data['longitude'] = $longitude;
                        if(!empty($start_date)){
                            $timestamp1 = strtotime($start_date);
                            $startDate = date('Y-m-d H:i:s', $timestamp1);
                        }else{
                            $timestamp1 = strtotime($start_datetime);
                            $startDate = date('Y-m-d H:i:s', $timestamp1);
                        }
                        if(!empty($end_date)){
                            $timestamp2 = strtotime($end_date);
                            $endDate = date('Y-m-d H:i:s', $timestamp2);
                        }else{
                            $timestamp2 = strtotime($end_datetime);
                            $endDate = date('Y-m-d H:i:s', $timestamp2);
                        }
                        $event_data['start_date'] = $startDate;
                        $event_data['end_date'] = $endDate;
                        $event_data['google_events'] = 1;
                        $result = $this->db->insert('schedule_master', $event_data);
                        $this->db->update('user',array('is_imported_schedules' => 1));
                    }
                }
            }
            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Schedule Imported Successfully From Google.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/schedule'), 'refresh');
        }
        $message = '<div class="alert alert-danger" role="alert"><strong>Error! </strong> No schedule found.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
        $this->session->set_flashdata('flash_message', $message);
        redirect(site_url('account/schedule'), 'refresh');
    }


}