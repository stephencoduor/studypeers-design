<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Account Controller
class Account extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
 
		$this->load->database();
		$this->load->library('session');
		/*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');

		// Set the timezone
		date_default_timezone_set(get_settings('timezone'));
	}

	public function index() {
		if ($this->session->userdata('user_login') == true) {
			$this->dashboard();
		}else {
			redirect(site_url('login'), 'refresh');
		}
	}

	public function dashboard(){
		is_valid_logged_in(); 
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'dashboard';
        $data['title']  = 'Dashboard | Studypeers';
        $this->load->view('user/include/header', $data);
        $this->load->view('user/dashboard');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
    }

    public function schedule(){ 
    	is_valid_logged_in(); 
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'schedule';
        $data['title']  = 'Schedule | Studypeers';
        $date = date('Y-m-d 00:00:00');
        $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and created_by = ".$user_id." and start_date >= '".$date."'")->result_array();
        $data['colors'] = array('constitition', 'mathlaton', 'calculus', 'dance', 'study', 'assignment');
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schedule/schedule-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/schedule/footer');
    }

    public function addSchedule(){
    	is_valid_logged_in(); 
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1))->result_array();
        $data['index_menu']  = 'schedule';
        $data['title']  = 'Add Schedule | Studypeers';

        if($this->input->post()){
            // print_r($this->input->post());die;
            $schedule       = $this->input->post('schedule');
            $schedule_name  = $this->input->post('schedule_name');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $startdate      = $this->input->post('start-date');
            $enddate        = $this->input->post('end-date');

            $timestamp1 = strtotime($startdate);
            $start_date = date('Y-m-d H:i:s', $timestamp1); 

            $timestamp2 = strtotime($enddate);
            $end_date = date('Y-m-d H:i:s', $timestamp2);

            $insertArr = array( 'schedule'      => $schedule,
                                'schedule_name' => $schedule_name,
                                'description'   => $description,
                                'university'    => $university,
                                'course'        => $course,
                                'professor'     => $professor,
                                'start_date'    => $start_date,
                                'end_date'      => $end_date,
                                'status'        => 1,
                                'created_by'    => $user_id,
                                'created_at'    => date('Y-m-d H:i:s')
                            );
            $this->db->insert('schedule_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Schedule Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/schedule'), 'refresh');

        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/schedule/schedule-add');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/schedule/footer');
    }

	public function logout(){
		is_not_logged_in(); 
    	 
    	$this->session->unset_userdata('user_data');
    	redirect(site_url('home/login'));
    }

    public function getProfessor(){
        if($this->input->post()){
            $course = $this->input->post('course');
            $get_professor = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            if(!empty($get_professor)){
                $html = '';
                foreach ($get_professor as $key => $value) {
                    $html.= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                }
            } else {
                $html = '<option value="">No Records Found</option>';
            }
            echo $html;die;
        }
    }

	public function events(){
        is_valid_logged_in(); 
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'events';
        $data['title']  = 'Events | Studypeers';
        $date = date('Y-m-d 00:00:00');
        $data['event_list'] = $this->db->query("select * from event_master where status = 1 and created_by = ".$user_id." and start_date >= '".$date."'")->result_array();
        
        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/events-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/events/footer');
    }

    public function addEvent(){
        is_valid_logged_in(); 
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1))->result_array();
        $data['index_menu']  = 'events';
        $data['title']  = 'Add Event | Studypeers';

        if($this->input->post()){
            // print_r($this->input->post());die;
            $event_name     = $this->input->post('event_name');
            $location_txt   = $this->input->post('location_txt');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $startdate      = $this->input->post('start-date');
            $enddate        = $this->input->post('end-date');
            $starttime      = $this->input->post('start-time');
            $endtime        = $this->input->post('end-time');

            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($location_txt)."&key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU";
                        
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

            $timestamp1 = strtotime($startdate);
            $start_date = date('Y-m-d', $timestamp1); 

            $timestamp2 = strtotime($enddate);
            $end_date = date('Y-m-d', $timestamp2);

            $timestamp3 = strtotime($starttime);
            $start_time = date('H:i:s', $timestamp3); 

            $timestamp4 = strtotime($endtime);
            $end_time = date('H:i:s', $timestamp4);

            $insertArr = array( 'event_name'    => $event_name,
                                'location_txt'  => $location_txt,
                                'description'   => $description,
                                'university'    => $university,
                                'course'        => $course,
                                'professor'     => $professor,
                                'start_date'    => $start_date,
                                'end_date'      => $end_date,
                                'start_time'    => $start_time,
                                'end_time'      => $end_time,
                                'latitude'      => $latitude,
                                'longitude'     => $longitude,
                                'status'        => 1,
                                'created_by'    => $user_id,
                                'created_at'    => date('Y-m-d H:i:s')
                            );
            $this->db->insert('event_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');

        }
        
        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/add-event');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/events/footer');
    }


    public function eventDetails(){
        is_valid_logged_in(); 
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $event_id = base64_decode($this->uri->segment('3')); 

        $data['event'] = $this->db->query("select * from event_master where id = ".$event_id."")->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['event']['university']))->row_array();
        
        $data['index_menu']  = 'events';
        $data['title']  = 'Event Details | Studypeers';

        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/event-details');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/events/footer-map');
    }


    public function editEvent(){
        is_valid_logged_in(); 
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $event_id = base64_decode($this->uri->segment('3')); 

        $data['event'] = $this->db->query("select * from event_master where id = ".$event_id."")->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['event']['university']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['event']['course']))->result_array();
        
        $data['index_menu']  = 'events';
        $data['title']  = 'Edit Event | Studypeers';

         if($this->input->post()){
            // print_r($this->input->post());die;
            $event_name       = $this->input->post('event_name');
            $location_txt  = $this->input->post('location_txt');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $startdate      = $this->input->post('start-date');
            $enddate        = $this->input->post('end-date');
            $starttime      = $this->input->post('start-time');
            $endtime        = $this->input->post('end-time');

            $timestamp1 = strtotime($startdate);
            $start_date = date('Y-m-d', $timestamp1); 

            $timestamp2 = strtotime($enddate);
            $end_date = date('Y-m-d', $timestamp2);

            $timestamp3 = strtotime($starttime);
            $start_time = date('H:i:s', $timestamp3); 

            $timestamp4 = strtotime($endtime);
            $end_time = date('H:i:s', $timestamp4);

            $uArr = array( 'event_name'      => $event_name,
                                'location_txt' => $location_txt,
                                'description'   => $description,
                                'university'    => $university,
                                'course'        => $course,
                                'professor'     => $professor,
                                'start_date'    => $start_date,
                                'end_date'      => $end_date,
                                'start_time'    => $start_time,
                                'end_time'      => $end_time
                            );
            $this->db->where(array('id' => $event_id));
            $this->db->update('event_master', $uArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');

        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/edit-event');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/events/footer');
    }

    public function deleteEvent(){
        if($this->input->post()){
            $event_id = $this->input->post('event_id');
            $this->db->where(array('id' => $event_id));
            $this->db->update('event_master',array('status' => 3));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');
        }
    }


    public function addEventToCalender(){
        if($this->input->post()){
            $event_id   = $this->input->post('calender_event_id');
            $event      = $this->db->query("select * from event_master where id = ".$event_id."")->row_array();
            $startdate  = $event['start_date'].' '.$event['start_time'];
            $enddate    = $event['end_date'].' '.$event['end_time'];
            $schedule   = array('schedule'      => 'event',
                                'schedule_name' => $event['event_name'],
                                'description'   => $event['description'],
                                'university'    => $event['university'],
                                'course'        => $event['course'],
                                'professor'     => $event['professor'],
                                'start_date'    => $startdate,
                                'end_date'      => $enddate,
                                'location'      => $event['location_txt'],
                                'latitude'      => $event['latitude'],
                                'longitude'     => $event['longitude'],
                                'status'        => 1,
                                'created_at'    => date('Y-m-d H:i:s'),
                                'created_by'    => $event['created_by'],
                             );

            $this->db->insert('schedule_master', $schedule);
            $schedule_id = $this->db->insert_id();

            $this->db->where(array('id' => $event_id));
            $this->db->update('event_master',array('addedToCalender' => 1, 'schedule_master_id' => $schedule_id));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Added To Calender Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');
        }
    }


    public function getScheduleDetail(){
        if($this->input->post()){
            $id     = $this->input->post('id');
            $res    = $this->db->get_where('schedule_master', array('id' => $id))->row_array();
            $uni    = $this->db->get_where('university', array('university_id' => $res['university']))->row_array();
            $course    = $this->db->get_where('course_master', array('id' => $res['course']))->row_array();
            $professor    = $this->db->get_where('professor_master', array('id' => $res['professor']))->row_array();

            $html = '<div class="userWrap action">                                      
            <div class="edit">
                <a href="'.base_url().'account/editSchedule/'.base64_encode($res['id']).'">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <polygon points="51.2,353.28 0,512 158.72,460.8         "></polygon>
                                </g>
                            </g>
                            <g>
                                <g>
                                    
                                        <rect x="89.73" y="169.097" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.8575 260.3719)" width="353.277" height="153.599"></rect>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M504.32,79.36L432.64,7.68c-10.24-10.24-25.6-10.24-35.84,0l-23.04,23.04l107.52,107.52l23.04-23.04
                                        C514.56,104.96,514.56,89.6,504.32,79.36z"></path>
                                </g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                    </svg> Edit
                </a>
            </div>          
            <div class="delete">
                <a data-toggle="modal" data-target="#confirmationModal">                                        
                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                    </svg> Delete
                </a>
            </div>  
        </div>
        <h4>'.$res['schedule_name'].'</h4>
        <div class="badgeList">
            <ul>
                <li class="badge badge1">'.$uni['SchoolName'].'</li>
                <li class="badge badge2">'.$course['name'].'</li>
                <li class="badge badge3">'.$professor['name'].'</li>
            </ul>
        </div>';

        if($res['schedule'] == 'event') {
            $html.='<div class="daytime"> 
                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                    <path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
                        c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
                        c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
                    <path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
                        c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
                    <path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
                </svg>'.$res['location'].'</div>';
        }

        
        $html.='<div class="daytime"> 
            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
                <path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
                    M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
                    S365.867,459.733,250.667,459.733z"></path>
                <path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
                    c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
            </svg>'.date('d M, Y H:i', strtotime($res['start_date'])).' - '.date('d M, Y H:i', strtotime($res['end_date'])).'</div>
        <div class="userWrap">
            <div class="user-name">
                <figure>
                    <img src="'.base_url().'assets_d/images/user.jpg" alt="user">
                </figure>
                <figcaption>Gilmer B</figcaption>
            </div>  
        </div>
        <div class="descpription">
            <h6>Description</h6>
            <p>'.$res['description'].'</p>
        </div>';
        if($res['schedule'] == 'event') {
            $html.='<div class="mapWrapper">
                <div id="map-container-google-1" class="z-depth-1-half map-container">
                  <div id="map" style="height: 100%;"></div>
                </div>
            </div>';
            $result['location_txt'] = $res['location'];
            $result['latitude'] = $res['latitude'];
            $result['longitude'] = $res['longitude'];
            $result['type'] = 2;
        } else {
            $result['type'] = 1;
        }
        $result['html'] = $html;
        print_r(json_encode($result));die;
        
        }
    }
}
