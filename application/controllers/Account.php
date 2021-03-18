<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
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
        $this->load->library('upload');
        $this->load->model('studyset_model');
    }

    public function index()
    {

        if ($this->session->userdata('user_login') == true) {
            $this->dashboard();
        } else {
            redirect(site_url('login'), 'refresh');
        }
    }

    function peerListString($user_id)
    {
        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '" . $user_id . "')")->result_array();
        $peer = array();
        foreach ($peer_list as $key => $value) {
            if ($value['user_id'] == $user_id) {
                // $peer[$key] = $value['peer_id']; 
                array_push($peer, $value['peer_id']);
            } else {
                // $peer[$key] = $value['user_id']; 
                array_push($peer, $value['user_id']);
            }
        }
        return $peer;
    }


    function peerListStringDashboard($user_id)
    {
        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '" . $user_id . "')")->result_array();
        $peer = array();
        foreach ($peer_list as $key => $value) {

            $chk_if_follow =  $this->db->query("SELECT * FROM `follow_master` WHERE (`user_id` = '" . $user_id . "' AND `peer_id` = '" . $value['peer_id'] . "')")->row_array();
            if (!empty($chk_if_follow)) {
                array_push($peer, $value['peer_id']);
            }
        }
        $follow_list = $this->db->query("SELECT * FROM `follow_master` WHERE (`user_id` = '" . $user_id . "')")->result_array();
        foreach ($follow_list as $key => $value) {

            $chk_if_follow =  $this->db->query("SELECT * FROM `follow_master` WHERE (`user_id` = '" . $user_id . "' AND `peer_id` = '" . $value['peer_id'] . "')")->row_array();
            if (in_array($value['peer_id'], $peer)) {
            } else {
                array_push($peer, $value['peer_id']);
            }
        }
        return $peer;
    }

    public function searchResult()
    {
        $data['index_menu']  = 'search';
        $data['title']  = 'Search Result | Studypeers';

        $this->load->view('user/include/header', $data);
        $this->load->view('user/search-result');

        $this->load->view('user/include/right-sidebar');

        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }


    public function dashboard()
    {
        is_valid_logged_in();

        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $data['peer_suggestion'] = $this->db->query("SELECT `user`.*, `university`.`SchoolName`, `user_info`.`nickname` FROM `user_info` JOIN `university` ON `university`.`university_id`=`user_info`.`intitutionID` JOIN `user` ON `user`.`id`=`user_info`.`userID` WHERE `user_info`.`intitutionID` = '" . $user_info['intitutionID'] . "' AND `user`.`is_verified` = 1 AND `user`.`id` != '" . $user_id . "' AND `user`.`id` NOT IN (SELECT peer_id from friends where user_id = '" . $user_id . "') ORDER BY `user`.`id` DESC ")->result_array();

        $data['peer_requests'] = $this->db->get_where('peer_master', array('peer_id' => $user_id, 'status' => 1))->result_array();

        $peerList = $this->peerListString($user_id);
        if (count($peerList) > 0) {
            $comma_separated = implode(",", $peerList);

            $data['events'] = $this->db->query("select * from event_master where status = 1 and created_by = " . $user_id . " OR event_master.id in (SELECT reference_id from share_master where peer_id = " . $user_id . " and reference = 'event' and status != 4) OR (event_master.created_by in (" . $comma_separated . ") AND status = 1) order by start_date desc limit 5")->result_array();
        } else {
            $data['events'] = [];
        }
        $data['events'] = [];
        $data['studysets'] = [];

        $data['index_menu']  = 'dashboard';
        $data['title']  = 'Dashboard | Studypeers';

        $this->load->view('user/include/header', $data);
        $this->load->view('user/dashboard');
        $this->load->view('user/profile/add-post');
        $this->load->view('user/profile/post-privacy');
        $this->load->view('user/include/right-sidebar');

        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }

    public function getDashboardFeeds()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $offset     = $this->input->post('count');
        $count      = $offset * 10;
        $peerList = $this->peerListStringDashboard($user_id);


        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status", 1);
        $this->db->where("reference_master.user_id", $user_id);
        if (!empty($peerList)) {
            $this->db->or_group_start();
            $this->db->where_in('reference_master.user_id', $peerList);
            $this->db->where('reference_master.status', 1);
            $this->db->group_end();
        }
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status", 1);
        $this->db->where("reference_master.user_id", $user_id);
        if (!empty($peerList)) {
            $this->db->or_group_start();
            $this->db->where_in('reference_master.user_id', $peerList);
            $this->db->where('reference_master.status', 1);
            $this->db->group_end();
        }
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array();
        // echo $this->db->last_query();die;
        if ($count + 10 < $total_feeds) {
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset + 1;
        $html = $this->load->view('user/dashboard-feeds', $data, true);
        echo $html;
    }

    public function schedule()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'schedule';
        $data['title']  = 'Schedule | Studypeers';

        $data['colors'] = array('constitition', 'mathlaton', 'calculus', 'dance', 'study', 'assignment');

        if ($this->input->get()) {
            // print_r($this->input->get());die;
            $startdate  = $this->input->get('start-date');
            $course     = $this->input->get('course');
            $professor  = $this->input->get('professor');
            $keyword    = $this->input->get('keyword');
            if (!empty($startdate)) {
                $timestamp1 = strtotime($startdate);
                $start_date = date('Y-m-d 23:59:59', $timestamp1);
                $end_date = date('Y-m-d 00:00:00', $timestamp1);
            } else {
                $start_date = date('Y-m-d 23:59:59');
                $end_date = date('Y-m-d 00:00:00');
            }
            if (!empty($course) && !empty($keyword)) {
                $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and course = " . $course . " and schedule_name like '%{$keyword}%' and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
                $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
            } else if (!empty($course) && empty($keyword)) {
                $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and course = " . $course . " and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
                $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
            } else if (empty($course) && !empty($keyword)) {
                $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and schedule_name like '%{$keyword}%' and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
                $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
            } else {
                $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and course = " . $course . " and schedule_name like '%{$keyword}%' and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
                $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
            }

            if (!empty($course)) {
                $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            } else {
                $data['professor']  = array();
            }
        } else {
            $date1 = date('Y-m-d 23:59:59');
            $date2 = date('Y-m-d 00:00:00');

            $y = date('Y');
            $m = date('m');

            $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and YEAR(start_date) = " . $y . " AND MONTH(start_date) = " . $m . " AND YEAR(end_date) = " . $y . " AND MONTH(end_date) >= " . $m . " order by id desc")->result_array();
            // echo $this->db->last_query();die;
            $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $date1 . "' and end_date >= '" . $date2 . "'")->result_array();
            $data['professor']  = array();
        }
        $user_info = $this->db->get_where('schedule_master', array('created_by' => $user_id, 'status' => 1))->result_array();
        $events = array();
        $color_codes = array('#5D8CF1', '#776BA7', '#FFCD9B', '#76EDD7', '#F06DA5', '#CAC8D3');

        if (count($user_info) > 0) {
            foreach ($user_info as $info) {
                $events[] = [
                    "id" => $info['id'],
                    "title" => $info['schedule_name'],
                    "start" => $info['start_date'],
                    "end" => $info['end_date'],
                    "color" => $color_codes[array_rand($color_codes)]
                ];
            }
        }

        $data['events']     = json_encode($events, true);
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schedule/schedule-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/schedule/fullcalendar-script');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/schedule/footer');
    }


    public function getScheduleDayWise()
    {
        if ($this->input->post()) {
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $date       = $this->input->post('date');
            $date1 = $date . ' 23:59:59';
            $date2 = $date . ' 00:00:00';
            $colors = array('constitition', 'mathlaton', 'calculus', 'dance', 'study', 'assignment');
            $schedule_list_day = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $date1 . "' and end_date >= '" . $date2 . "'")->result_array();
            if (!empty($schedule_list_day)) {
                $html = '';
                $c = 0;
                foreach ($schedule_list_day as $key => $value) {
                    $html .= '<div class="' . $colors[$c] . ' event" id="' . $value['id'] . '">
                                                            <div class="time">' . date('d M, Y h:i A', strtotime($value['start_date'])) . ' <span>' . date('d M, Y h:i A', strtotime($value['end_date'])) . '</span></div>
                                                            <div class="name">' . $value['schedule_name'] . '</div>
                                                        </div>';
                    if ($c == 5) {
                        $c = 0;
                    } else {
                        $c++;
                    }
                }
            } else {
                $html = '<div class="blankFeedArea">
                                    <div class="noFeedWrapper">
                                        <figure>
                                            <img src="' . base_url() . 'assets_d/images/blank-feeds.png" alt="No Feed">
                                        </figure>
                                        <h4>Search result not found.</h4>
                                    </div>
                                </div>';
            }
            echo $html;
            die;
        }
    }

    public function addSchedule()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['index_menu']  = 'schedule';
        $data['title']  = 'Add Schedule | Studypeers';

        if ($this->input->post()) {
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

            $insertArr = array(
                'schedule'      => $schedule,
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
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/schedule/footer');
    }

    public function logout()
    {
        is_not_logged_in();

        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->where(array('user_id' => $user_id, 'status' => 1));
        $this->db->update('user_token', array('status' => 2));

        $this->session->unset_userdata('user_data');
        redirect(site_url('home/login'));
    }

    public function getProfessor()
    {
        if ($this->input->post()) {
            $course = $this->input->post('course');
            $get_professor = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            if (!empty($get_professor)) {
                $html = '';
                foreach ($get_professor as $key => $value) {
                    $html .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                }
            } else {
                $html = '<option value="">No Records Found</option>';
            }
            echo $html;
            die;
        }
    }

    public function events()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'events';
        $data['title']  = 'Events | Studypeers';
        if ($this->input->get()) {
            // print_r($this->input->get());die;
            $startdate  = $this->input->get('start-date');
            $course     = $this->input->get('course');
            $professor  = $this->input->get('professor');
            $keyword    = $this->input->get('keyword');
            if (!empty($startdate)) {
                $timestamp1 = strtotime($startdate);
                $start_date = date('Y-m-d', $timestamp1);
                $end_date = date('Y-m-d', $timestamp1);
            } else {
                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d');
            }
            if (!empty($course) && !empty($keyword)) {
                $data['event_list'] = $this->db->query("select * from event_master where status = 1 and course = " . $course . " and event_name like '%{$keyword}%' and created_by = " . $user_id . " and (start_date <= '" . $start_date . "' AND end_date >= '" . $end_date . "') order by start_date and end_date <= '" . $end_date . "' desc")->result_array();
            } else if (!empty($course) && empty($keyword)) {
                $data['event_list'] = $this->db->query("select * from event_master where status = 1 and course = " . $course . " and created_by = " . $user_id . " and (start_date <= '" . $start_date . "' AND end_date >= '" . $end_date . "')  order by start_date desc")->result_array();
            } else if (empty($course) && !empty($keyword)) {
                $data['event_list'] = $this->db->query("select * from event_master where status = 1 and event_name like '%{$keyword}%' and created_by = " . $user_id . " and (start_date <= '" . $start_date . "' AND end_date >= '" . $end_date . "')  order by start_date desc")->result_array();
            } else {
                $data['event_list'] = $this->db->query("select * from event_master where status = 1 and created_by = " . $user_id . " and (start_date <= '" . $start_date . "' AND end_date >= '" . $end_date . "')  order by start_date desc")->result_array();
            }

            if (!empty($course)) {
                $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            } else {
                $data['professor']  = array();
            }
        } else {
            $date = date('Y-m-d');

            $data['event_list'] = $this->db->query("select * from event_master where status = 1 and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "') OR event_master.id in (SELECT reference_id from share_master where peer_id = " . $user_id . " and reference = 'event' and status != 4)  order by start_date desc")->result_array();
        }
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/events-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/events/footer');
    }


    public function getEventsDayWise()
    {
        if ($this->input->post()) {
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $date       = $this->input->post('date');
            $startdate  = $this->input->post('start_date');
            $course     = $this->input->post('course');
            $professor  = $this->input->post('professor');
            $keyword    = $this->input->post('keyword');

            if (!empty($course) && !empty($keyword)) {

                $event_list = $this->db->query("select * from event_master where (status = 1 and course = " . $course . " and event_name like '%{$keyword}%' and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "')) OR (event_master.id in (SELECT share_master.reference_id from share_master where share_master.peer_id = " . $user_id . " and share_master.reference = 'event' and share_master.status != 4 AND (event_master.status = 1 and event_master.course = " . $course . " and event_master.event_name like '%{$keyword}%' and (event_master.start_date <= '" . $date . "' AND event_master.end_date >= '" . $date . "'))))  order by start_date desc")->result_array();
            } else if (!empty($course) && empty($keyword)) {
                $event_list = $this->db->query("select * from event_master where (status = 1 and course = " . $course . " and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "')) OR (event_master.id in (SELECT share_master.reference_id from share_master where share_master.peer_id = " . $user_id . " and share_master.reference = 'event' and share_master.status != 4 AND (event_master.status = 1 and event_master.course = " . $course . " and (event_master.start_date <= '" . $date . "' AND event_master.end_date >= '" . $date . "'))))  order by start_date desc")->result_array();
            } else if (empty($course) && !empty($keyword)) {
                $event_list = $this->db->query("select * from event_master where (status = 1 and event_name like '%{$keyword}%' and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "')) OR (event_master.id in (SELECT share_master.reference_id from share_master where share_master.peer_id = " . $user_id . " and share_master.reference = 'event' and share_master.status != 4 AND (event_master.status = 1 and event_master.event_name like '%{$keyword}%' and (event_master.start_date <= '" . $date . "' AND event_master.end_date >= '" . $date . "'))))  order by start_date desc")->result_array();
            } else {
                $event_list = $this->db->query("select * from event_master where (status = 1 and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "')) OR (event_master.id in (SELECT share_master.reference_id from share_master where share_master.peer_id = " . $user_id . " and share_master.reference = 'event' and share_master.status != 4 AND (event_master.status = 1 and (event_master.start_date <= '" . $date . "' AND event_master.end_date >= '" . $date . "'))))  order by start_date desc")->result_array();
            }



            $html = "";

            if (!empty($event_list)) {
                foreach ($event_list as $key => $value) {
                    $university = $this->db->get_where('university', array('university_id' => $value['university']))->row_array();

                    $peer_attending = $this->db->get_where('share_master', array('reference_id' => $value['id'], 'reference' => 'event', 'status' => 2))->result_array();

                    $html .= '<div class="feed-card list" id="event_id_div_' . $value['id'] . '">';

                    if ($value['featured_image'] != '') {
                        $html .= '<div class="left">
                                    <figure>
                                        <img src="' . base_url() . 'uploads/users/' . $value['featured_image'] . '" alt="Study Set List">
                                    </figure>
                                 </div>
                                 <div class="right">
                                     <div class="feed_card_inner">
                                        <h5><a href="' . base_url() . 'account/eventDetails/' . base64_encode($value['id']) . '">' . $value['event_name'] . '</a></h5>
                                        <div class="badgeList">
                                            <ul>
                                                <li class="badge badge1">
                                                    <a href="event-place.html">
                                                        ' . $university['SchoolName'] . '
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="timeperiod">
                                                    <div class="timeDetail">
                                                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                    <path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
                                                                        c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
                                                                        c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
                                                                    <path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
                                                                        c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
                                                                    <path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
                                                        </svg> ' . $value['location_txt'] . '
                                                    </div>
                                                    <div class="timeDetail">
                                                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                            <path d="M110.3,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,261.4,93.5,247.8,110.3,247.8z"></path>
                                                            <path d="M227.4,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,261.4,210.6,247.8,227.4,247.8z"></path>
                                                            <path d="M344.5,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,261.4,327.7,247.8,344.5,247.8z"></path>
                                                            <path d="M110.3,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,353.3,93.5,339.6,110.3,339.6z"></path>
                                                            <path d="M227.4,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,353.3,210.6,339.6,227.4,339.6z"></path>
                                                            <path d="M344.5,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,353.3,327.7,339.6,344.5,339.6z"></path>
                                                            <path d="M469.2,45.6h-82.1V21.7c0-11.5-9.3-20.8-20.8-20.8c-11.5,0-20.8,9.3-20.8,20.8v24H143.6v-24
                                                                c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H20.8C9.3,45.7,0,54.9,0,66.4v402.5c0,11.5,9.3,20.7,20.8,20.8h447.4
                                                                c11.5-0.3,20.9-9.3,21.9-20.8V66.4C490,54.9,480.7,45.6,469.2,45.6z M448.3,449.3H40.5V197.5h407.8V449.3z M448.3,155.9H40.5V87.3
                                                                h61.4V105c-0.3,11.5,8.8,21,20.3,21.3s21-8.8,21.3-20.3l0,0V87.2h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8
                                                                V87.2h61.3v68.6V155.9z"></path>
                                                        </svg> ' . date('d M, Y', strtotime($value['start_date'])) . '                                           
                                                    </div>
                                                        <div class="timeDetail">
                                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
                                                                        <path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
                                                                            M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
                                                                            S365.867,459.733,250.667,459.733z"></path>
                                                                        <path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
                                                                            c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
                                                            </svg>' . date('h:i A', strtotime($value['start_time'])) . '
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="feed_card_footer">';
                        $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                        $this->db->join('user', 'user.id=user_info.userID');
                        $user = $this->db->get_where('user_info', array('userID' => $value['created_by']))->row_array();
                        $html .= '<div class="userWrap eventBox">
                                                            <div class="user-name">
                                                                <figure>
                                                                    <img src="' . userImage($value['created_by']) . '" alt="user">
                                                                </figure>
                                                                <a href="' . base_url() . 'sp/' . $user['username'] . '"><figcaption>' . $user['nickname'] . '</figcaption></a>

                                                            </div>';
                        if ($value['created_by'] == $user_id) {
                            $html .= '<div class="edit">

                                                                <a href="' . base_url() . 'account/editEvent/' . base64_encode($value['id']) . '">
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
                                                                <a data-toggle="modal" data-id="' . $value['id'] . '" data-target="#confirmationModalList" class="delete_event">                                        
                                                                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                                                    </svg> Delete
                                                                </a>
                                                            </div>  
                                                            <div class="edit invitePeer" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#peersModalShare">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                        <path d="M319.4,85.8c0,2.9,0.1,5.7,0.4,8.6l-140.7,76.7c-19-19.8-45.6-32.2-75.1-32.2c-57.2,0-104,46.8-104,104s46.8,104,104,104
                                                                            c30.7,0,58.5-13.5,77.6-34.9l139.2,76.8c-0.9,5-1.4,10.1-1.4,15.4c0,46.8,38.5,85.3,85.3,85.3c46.8,0,85.3-38.5,85.3-85.3
                                                                            s-38.5-85.3-85.3-85.3c-26.8,0-50.9,12.6-66.5,32.2l-135.6-74.8c3.6-10.5,5.5-21.7,5.5-33.4c0-13-2.4-25.4-6.8-36.9l132.5-73
                                                                            c15.4,22.9,41.5,38.1,70.9,38.1c46.8,0,85.3-38.5,85.3-85.3S451.5,0.5,404.7,0.5S319.4,39,319.4,85.8z M449.4,404.2
                                                                            c0,25-19.8,44.7-44.7,44.7S360,429.1,360,404.2c0-25,19.8-44.7,44.7-44.7S449.4,379.2,449.4,404.2z M104,305.3
                                                                            c-34.3,0-62.4-28.1-62.4-62.4s28.1-62.4,62.4-62.4s62.4,28.1,62.4,62.4C166.5,277.3,138.4,305.3,104,305.3z M449.4,85.8
                                                                            c0,25-19.8,44.7-44.7,44.7S360,110.7,360,85.8c0-25,19.8-44.7,44.7-44.7S449.4,60.9,449.4,85.8z"></path>
                                                                    </svg> Invite
                                                                </a>

                                                            </div>';
                        } else {
                            $this->db->order_by('share_master.id', 'desc');
                            $shared = $this->db->get_where('share_master', array('reference_id' => $value['id'], 'reference' => 'event', 'peer_id' => $user_id))->row_array();
                            $html .= '<div class="delete removeSharedEvent" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#confirmationModalRemove" class="delete_event">                                        
                                                                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                                                    </svg> Hide
                                                                </a>
                                                            </div>
                                                            <div class="edit attendEvent" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#confirmationModalAttend">
                                                                    <svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m452 512h-392c-33.085938 0-60-26.914062-60-60v-392c0-33.085938 26.914062-60 60-60h392c33.085938 0 60 26.914062 60 60v392c0 33.085938-26.914062 60-60 60zm-392-472c-11.027344 0-20 8.972656-20 20v392c0 11.027344 8.972656 20 20 20h392c11.027344 0 20-8.972656 20-20v-392c0-11.027344-8.972656-20-20-20zm370.898438 111.34375-29.800782-26.6875-184.964844 206.566406-107.351562-102.046875-27.558594 28.988281 137.21875 130.445313zm0 0"/>
                                                                    </svg> <span id="attend_text_' . $value['id'] . '">';
                            if ($shared['status'] == 2) {
                                $html .= 'Unattend';
                            } else {
                                $html .= 'Attend';
                            }
                            $html .= '</span>
                                                                </a>
                                                            </div>';
                        }
                        $html .= '</div>';

                        if (!empty($peer_attending)) {


                            $html .= '<div class="userIcoList peersModalAttending" data-toggle="modal" data-target="#peersModalAttending" data-id="' . $value['id'] . '">
                                                            <ul>';
                            if (!empty($peer_attending[0])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[0]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            if (!empty($peer_attending[1])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[1]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            if (!empty($peer_attending[2])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[2]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            $count = count($peer_attending) - 3;


                            $html .= '<li class="more">
                                                                    +';
                            if ($count > 3) {
                                $html .= $count;
                            }
                            $html .= '</li>';


                            $html .= '</ul>
                                                        </div>';
                        }

                        $html .= '<div class="action">';
                        if ($value['addedToCalender'] == 0) {
                            $html .= '<a href="#" class="addEvents" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#addEventModal">
                                                                    <img src="' . base_url() . 'assets_d/images/calendar.svg" alt="Events Calendar"> 
                                                                </a>';
                        } else {
                            $html .= '<a href="#" class="removeEvent" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#removeFromScheduleModal">
                                                                        <img src="' . base_url() . 'assets_d/images/calendar.png" alt="Events Calendar" style="width: 20px;height: 20px;"> 
                                                                    </a>';
                        }
                        $html .= '<a>
                                                                    <div class="action_button">
                                                                        <a href="' . base_url() . 'account/eventDetails/' . base64_encode($value['id']) . '">
                                                                            <svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                                <path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1
                                                                                    l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        
                                                    </div>
                                                 </div>';
                    } else {
                        $html .= '<div class="right">
                                                <div class="feed_card_inner">
                                                    <h5><a href="' . base_url() . 'account/eventDetails/' . base64_encode($value['id']) . '">' . $value['event_name'] . '</a></h5>
                                                    <div class="badgeList">
                                                        <ul>
                                                            <li class="badge badge1">
                                                                <a href="event-place.html">
                                                                    ' . $university['SchoolName'] . '
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="timeperiod">
                                                                <div class="timeDetail">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                                <path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
                                                                                    c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
                                                                                    c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
                                                                                <path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
                                                                                    c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
                                                                                <path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
                                                                    </svg> ' . $value['location_txt'] . '
                                                                </div>
                                                                <div class="timeDetail">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                        <path d="M110.3,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,261.4,93.5,247.8,110.3,247.8z"></path>
                                                                        <path d="M227.4,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,261.4,210.6,247.8,227.4,247.8z"></path>
                                                                        <path d="M344.5,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,261.4,327.7,247.8,344.5,247.8z"></path>
                                                                        <path d="M110.3,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,353.3,93.5,339.6,110.3,339.6z"></path>
                                                                        <path d="M227.4,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,353.3,210.6,339.6,227.4,339.6z"></path>
                                                                        <path d="M344.5,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,353.3,327.7,339.6,344.5,339.6z"></path>
                                                                        <path d="M469.2,45.6h-82.1V21.7c0-11.5-9.3-20.8-20.8-20.8c-11.5,0-20.8,9.3-20.8,20.8v24H143.6v-24
                                                                            c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H20.8C9.3,45.7,0,54.9,0,66.4v402.5c0,11.5,9.3,20.7,20.8,20.8h447.4
                                                                            c11.5-0.3,20.9-9.3,21.9-20.8V66.4C490,54.9,480.7,45.6,469.2,45.6z M448.3,449.3H40.5V197.5h407.8V449.3z M448.3,155.9H40.5V87.3
                                                                            h61.4V105c-0.3,11.5,8.8,21,20.3,21.3s21-8.8,21.3-20.3l0,0V87.2h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8
                                                                            V87.2h61.3v68.6V155.9z"></path>
                                                                    </svg> ' . date('d M, Y', strtotime($value['start_date'])) . '                                           
                                                                </div>
                                                                <div class="timeDetail">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
                                                                                <path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
                                                                                    M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
                                                                                    S365.867,459.733,250.667,459.733z"></path>
                                                                                <path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
                                                                                    c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
                                                                    </svg>' . date('h:i A', strtotime($value['start_time'])) . '
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="feed_card_footer">';
                        $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                        $this->db->join('user', 'user.id=user_info.userID');
                        $user = $this->db->get_where('user_info', array('userID' => $value['created_by']))->row_array();
                        $html .= '<div class="userWrap eventBox">
                                                        <div class="user-name">
                                                            <figure>
                                                                <img src="' . userImage($value['created_by']) . '" alt="user">
                                                            </figure>
                                                            <a href="' . base_url() . 'sp/' . $user['username'] . '"><figcaption>' . $user['nickname'] . '</figcaption></a>

                                                        </div>';
                        if ($value['created_by'] == $user_id) {
                            $html .= '<div class="edit">
                                                                <a href="' . base_url() . 'account/editEvent/' . base64_encode($value['id']) . '">
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
                                                                <a data-toggle="modal" data-id="' . $value['id'] . '" data-target="#confirmationModalList" class="delete_event">                                        
                                                                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                                                    </svg> Delete
                                                                </a>
                                                            </div>  
                                                            <div class="edit invitePeer" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#peersModalShare">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                        <path d="M319.4,85.8c0,2.9,0.1,5.7,0.4,8.6l-140.7,76.7c-19-19.8-45.6-32.2-75.1-32.2c-57.2,0-104,46.8-104,104s46.8,104,104,104
                                                                            c30.7,0,58.5-13.5,77.6-34.9l139.2,76.8c-0.9,5-1.4,10.1-1.4,15.4c0,46.8,38.5,85.3,85.3,85.3c46.8,0,85.3-38.5,85.3-85.3
                                                                            s-38.5-85.3-85.3-85.3c-26.8,0-50.9,12.6-66.5,32.2l-135.6-74.8c3.6-10.5,5.5-21.7,5.5-33.4c0-13-2.4-25.4-6.8-36.9l132.5-73
                                                                            c15.4,22.9,41.5,38.1,70.9,38.1c46.8,0,85.3-38.5,85.3-85.3S451.5,0.5,404.7,0.5S319.4,39,319.4,85.8z M449.4,404.2
                                                                            c0,25-19.8,44.7-44.7,44.7S360,429.1,360,404.2c0-25,19.8-44.7,44.7-44.7S449.4,379.2,449.4,404.2z M104,305.3
                                                                            c-34.3,0-62.4-28.1-62.4-62.4s28.1-62.4,62.4-62.4s62.4,28.1,62.4,62.4C166.5,277.3,138.4,305.3,104,305.3z M449.4,85.8
                                                                            c0,25-19.8,44.7-44.7,44.7S360,110.7,360,85.8c0-25,19.8-44.7,44.7-44.7S449.4,60.9,449.4,85.8z"></path>
                                                                    </svg> Invite
                                                                </a>
                                                            </div>';
                        } else {
                            $this->db->order_by('share_master.id', 'desc');
                            $shared = $this->db->get_where('share_master', array('reference_id' => $value['id'], 'reference' => 'event', 'peer_id' => $user_id))->row_array();
                            $html .= '<div class="delete removeSharedEvent" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#confirmationModalRemove" class="delete_event">                                        
                                                                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                                                    </svg> Hide
                                                                </a>
                                                            </div>
                                                            <div class="edit attendEvent" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#confirmationModalAttend">
                                                                    <svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m452 512h-392c-33.085938 0-60-26.914062-60-60v-392c0-33.085938 26.914062-60 60-60h392c33.085938 0 60 26.914062 60 60v392c0 33.085938-26.914062 60-60 60zm-392-472c-11.027344 0-20 8.972656-20 20v392c0 11.027344 8.972656 20 20 20h392c11.027344 0 20-8.972656 20-20v-392c0-11.027344-8.972656-20-20-20zm370.898438 111.34375-29.800782-26.6875-184.964844 206.566406-107.351562-102.046875-27.558594 28.988281 137.21875 130.445313zm0 0"/>
                                                                    </svg> <span id="attend_text_' . $value['id'] . '">';
                            if ($shared['status'] == 2) {
                                $html .= 'Unattend';
                            } else {
                                $html .= 'Attend';
                            }

                            $html .= '</span>
                                                                </a>
                                                            </div>';
                        }
                        $html .= '</div>';

                        if (!empty($peer_attending)) {


                            $html .= '<div class="userIcoList peersModalAttending" data-toggle="modal" data-id="' . $value['id'] . '" data-target="#peersModalAttending">
                                                            <ul>';
                            if (!empty($peer_attending[0])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[0]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            if (!empty($peer_attending[1])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[1]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            if (!empty($peer_attending[2])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[2]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            $count = count($peer_attending) - 3;
                            $html .= '<li class="more">
                                                                    +';
                            if ($count > 3) {
                                $html .= $count;
                            }
                            $html .= '</li>';

                            $html .= '</ul>
                                                        </div>';
                        }

                        $html .= '<div class="action">';
                        if ($value['created_by'] == $user_id) {
                            if ($value['addedToCalender'] == 0) {
                                $html .= '<a href="#" class="addEvents" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#addEventModal">
                                                                    <img src="' . base_url() . 'assets_d/images/calendar.svg" alt="Events Calendar"> 
                                                                </a>';
                            } else {
                                $html .= '<a href="#" class="removeEvent" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#removeFromScheduleModal">
                                                                        <img src="' . base_url() . 'assets_d/images/calendar.png" alt="Events Calendar" style="width: 20px;height: 20px;"> 
                                                                    </a>';
                            }
                        } else {
                            if ($shared['schedule_master_id'] == 0) {
                                $html .= '<a href="#" class="addEvents" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#addEventModal">
                                                                    <img src="' . base_url() . 'assets_d/images/calendar.svg" alt="Events Calendar"> 
                                                                </a>';
                            } else {
                                $html .= '<a href="#" class="removeEvent" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#removeFromScheduleModal">
                                                                        <img src="' . base_url() . 'assets_d/images/calendar.png" alt="Events Calendar" style="width: 20px;height: 20px;"> 
                                                                </a>';
                            }
                        }
                        $html .= '<a>
                                                                <div class="action_button">
                                                                    <a href="' . base_url() . 'account/eventDetails/' . base64_encode($value['id']) . '">
                                                                        <svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                            <path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1
                                                                                l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    
                                                </div>
                                            </div>';
                    }
                    $html .= '</div>';
                }
            } else {
                $html = '<div class="blankFeedArea">
                                    <div class="noFeedWrapper">
                                        <figure>
                                            <img src="' . base_url() . 'assets_d/images/blank-feeds.png" alt="No Feed">
                                        </figure>
                                        <h4>Search result not found.</h4>
                                    </div>
                                </div>';
            }
            echo $html;
            die;
        }
    }

    public function addEvent()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['index_menu']  = 'events';
        $data['title']  = 'Add Event | Studypeers';



        if ($this->input->post()) {
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

            $privacy        = $this->input->post('privacy');

            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location_txt) . "&key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU";

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

            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image = $this->uploadImg('featured_image', $_FILES['featured_image']['name']);
            } else {
                $featured_image = "";
            }

            $insertArr = array(
                'event_name'    => $event_name,
                'location_txt'  => $location_txt,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'start_time'    => $start_time,
                'end_time'      => $end_time,
                'privacy'       => $privacy,
                'latitude'      => $latitude,
                'longitude'     => $longitude,
                'featured_image' => $featured_image,
                'status'        => 1,
                'created_by'    => $user_id,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('event_master', $insertArr);

            $insert_id = $this->db->insert_id();

            $insertRef = array(
                'reference'     => 'event',
                'reference_id'  => $insert_id,
                'user_id'       => $user_id,

                'status'        => 1,

                'addDate'       => date('Y-m-d H:i:s'),
                'modifyDate'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('reference_master', $insertRef);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/add-event');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/events/footer');
    }


    public function eventDetails()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $event_id = base64_decode($this->uri->segment('3'));

        $data['event'] = $this->db->query("select * from event_master where id = " . $event_id . "")->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['event']['university']))->row_array();

        $data['comment'] = $this->db->get_where('comment_master', array('reference' => 'event', 'reference_id' => $event_id, 'comment_parent_id' => 0))->result_array();

        $data['index_menu']  = 'events';
        $data['title']  = 'Event Details | Studypeers';

        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/event-details');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/events/footer-map');
    }


    public function editEvent()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $event_id = base64_decode($this->uri->segment('3'));

        $data['event'] = $this->db->query("select * from event_master where id = " . $event_id . "")->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['event']['university']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['event']['course']))->result_array();

        $data['index_menu']  = 'events';
        $data['title']  = 'Edit Event | Studypeers';

        if ($this->input->post()) {
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

            $privacy        = $this->input->post('privacy');

            $timestamp1 = strtotime($startdate);
            $start_date = date('Y-m-d', $timestamp1);

            $timestamp2 = strtotime($enddate);
            $end_date = date('Y-m-d', $timestamp2);

            $timestamp3 = strtotime($starttime);
            $start_time = date('H:i:s', $timestamp3);

            $timestamp4 = strtotime($endtime);
            $end_time = date('H:i:s', $timestamp4);

            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image = $this->uploadImg('featured_image', $_FILES['featured_image']['name']);
            } else {
                $featured_image = $this->input->post('old_featured_image');
            }

            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location_txt) . "&key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU";

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

            $uArr = array(
                'event_name'      => $event_name,
                'location_txt' => $location_txt,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'privacy'       => $privacy,
                'start_time'    => $start_time,
                'featured_image'    => $featured_image,
                'end_time'      => $end_time,
                'latitude'      => $latitude,
                'longitude'     => $longitude
            );
            $this->db->where(array('id' => $event_id));
            $this->db->update('event_master', $uArr);

            $get_event = $this->db->query("select * from event_master where id = " . $event_id . " and status = 1")->row_array();
            if ($get_event['addedToCalender'] == 1) {
                $startdate  = $get_event['start_date'] . ' ' . $get_event['start_time'];
                $enddate    = $get_event['end_date'] . ' ' . $get_event['end_time'];
                $sArr = array(
                    'schedule_name'  => $event_name,
                    'location'      => $location_txt,
                    'description'   => $description,
                    'university'    => $university,
                    'course'        => $course,
                    'professor'     => $professor,
                    'start_date'    => $startdate,
                    'end_date'      => $enddate,
                    'latitude'      => $latitude,
                    'longitude'     => $longitude,
                    'featured_image'    => $featured_image,
                    'schedule'      => 'event'

                );

                $this->db->where(array('event_master_id' => $event_id));
                $this->db->update('schedule_master', $sArr);
            }

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/edit-event');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/events/footer');
    }

    public function deleteEvent()
    {
        if ($this->input->post()) {
            $event_id = $this->input->post('event_id');
            $this->db->where(array('id' => $event_id));
            $this->db->update('event_master', array('status' => 3));

            $event_details = $this->db->query("select * from event_master where id = " . $event_id . "")->row_array();
            if ($event_details['addedToCalender'] == 1) {
                $this->db->where(array('event_master_id' => $event_id));
                $this->db->update('schedule_master', array('status' => 3));
            }

            $this->db->where(array('reference_id' => $event_id, 'reference' => 'event'));
            $this->db->update('reference_master', array('status' => 3));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');
        }
    }

    public function deleteDocument()
    {
        if ($this->input->post()) {
            $document_id = $this->input->post('document_id');
            $this->db->where(array('id' => $document_id));
            $this->db->update('document_master', array('status' => 3));

            $this->db->where(array('reference_id' => $document_id, 'reference' => 'document'));
            $this->db->update('reference_master', array('status' => 3));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Document Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/documents'), 'refresh');
        }
    }

    public function deleteQuestion()
    {

        if ($this->input->post()) {
            $question_id = $this->input->post('question_id');
            $this->db->where(array('id' => $question_id));
            $this->db->update('question_master', array('status' => 3));

            $this->db->where(array('reference_id' => $question_id, 'reference' => 'question'));
            $this->db->update('reference_master', array('status' => 3));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Question Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questions'), 'refresh');
        }
    }

    function peerList($user_id)
    {
        $peer_list = $this->db->query("SELECT * FROM `peer_master` WHERE (`user_id` = '" . $user_id . "' OR `peer_id` = '" . $user_id . "') AND `status` = 2")->result_array();
        $peer = array();
        foreach ($peer_list as $key => $value) {
            if ($value['user_id'] == $user_id) {
                $peer[$key] = $value['peer_id'];
            } else {
                $peer[$key] = $value['user_id'];
            }
        }
        return $peer;
    }


    public function documents()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'documents';
        $data['title']  = 'Documents | Studypeers';



        $this->db->select('document_master.*,professor_master.name as professor,course_master.name as course, university.SchoolName, user_info.nickname');
        if ($this->input->get()) {
        } else {
            $this->db->from('document_master');
        }

        $this->db->join('professor_master', 'professor_master.id=document_master.professor');
        $this->db->join('course_master', 'course_master.id=document_master.course');
        $this->db->join('university', 'university.university_id=document_master.university');
        $this->db->join('user_info', 'user_info.userID=document_master.created_by');
        if ($this->input->get('sort-by', TRUE)) {
            $sort_by = $this->input->get('sort-by', TRUE);
            if ($sort_by == 'date') {
                $this->db->order_by('document_master.created_at', 'desc');
            } else if ($sort_by == 'name') {
                $this->db->order_by('document_master.document_name', 'desc');
            }
        } else {
            $this->db->order_by('document_master.id', 'desc');
        }




        if ($this->input->get()) {
            // print_r($this->input->get());die;
            if ($this->input->get('search')) {
                $keyword     = $this->input->get('keyword_search');
                $course     = $this->input->get('course_search');
                $professor  = $this->input->get('professor_search');
                $university = $this->input->get('university_search');
            } else {
                $course     = $this->input->get('course');
                $professor  = $this->input->get('professor');
                $university = $this->input->get('university');
                $keyword     = $this->input->get('keyword');
            }
            if (!empty($keyword)) {
                $this->db->group_start();
                $this->db->like('document_master.document_name', $keyword);
                $this->db->group_end();
            }
            if (!empty($university) && !empty($course)) {
                $data['document_list'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.created_by' => $user_id, 'document_master.status' => 1, 'document_master.university' => $university, 'document_master.course' => $course))->result_array();
                $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            } else if (!empty($university) && empty($course)) {
                $data['document_list'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.created_by' => $user_id, 'document_master.status' => 1, 'document_master.university' => $university))->result_array();
                $data['professor']     = array();
            } else {
                $data['document_list'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.created_by' => $user_id, 'document_master.status' => 1))->result_array();
                $data['professor']     = array();
            }
        } else {
            $this->db->where(array('document_master.created_by' => $user_id, 'document_master.status' => 1));
            $this->db->or_group_start();
            $this->db->where("document_master.`id` IN (SELECT `reference_id` FROM `share_master` where `reference` = 'document' and status = 1 and peer_id = " . $user_id . ")", NULL, FALSE);
            $this->db->group_end();
            $data['document_list'] = $this->db->get()->result_array();
            $data['professor']     = array();
        }


        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/documents/documents-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function removeSharedDoc()
    {
        $id = $this->input->post('id');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->where(array('reference_id' => $id, 'reference' => 'document', 'peer_id' => $user_id));
        $result = $this->db->update('share_master', array('status' => 3));
        echo 1;
        die;
    }


    public function addDocument()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['index_menu']  = 'documents';
        $data['title']  = 'Add Document | Studypeers';

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $document_name     = $this->input->post('document_name');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $privacy        = $this->input->post('privacy');

            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image = $this->uploadImg('featured_image', $_FILES['featured_image']['name']);
            } else {
                $featured_image = "";
            }

            $insertArr = array(
                'document_name' => $document_name,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'privacy'       => $privacy,
                'featured_image' => $featured_image,
                'status'        => 1,
                'created_by'    => $user_id,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('document_master', $insertArr);

            $insert_id = $this->db->insert_id();

            $insertRef = array(
                'reference'     => 'document',
                'reference_id'  => $insert_id,
                'user_id'       => $user_id,

                'status'        => 1,

                'addDate'       => date('Y-m-d H:i:s'),
                'modifyDate'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('reference_master', $insertRef);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Document Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/documents'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/documents/add-document');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function documentDetail()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $document_id = base64_decode($this->uri->segment('3'));

        $data['index_menu']  = 'documents';
        $data['title']  = 'Document Details | Studypeers';

        $this->db->select('document_master.*,professor_master.name as professor,course_master.name as course, university.SchoolName, user_info.nickname');
        $this->db->join('professor_master', 'professor_master.id=document_master.professor');
        $this->db->join('course_master', 'course_master.id=document_master.course');
        $this->db->join('university', 'university.university_id=document_master.university');
        $this->db->join('user_info', 'user_info.userID=document_master.created_by');
        $this->db->order_by('document_master.id', 'desc');
        $data['result'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.id' => $document_id, 'document_master.status' => 1))->row_array();

        $data['comment'] = $this->db->get_where('comment_master', array('reference' => 'document', 'reference_id' => $document_id, 'comment_parent_id' => 0))->result_array();

        $this->db->select('document_rating_master.*, user_info.nickname');
        $this->db->join('user_info', 'user_info.userID=document_rating_master.user_id');
        $this->db->order_by('document_rating_master.created_at', 'desc');
        $this->db->limit(5);
        $data['rating_list'] = $this->db->get_where('document_rating_master', array('document_rating_master.document_id' => $document_id, 'document_rating_master.user_id !=' => $user_id))->result_array();


        $data['user_rating'] = $this->db->get_where('document_rating_master', array('document_rating_master.document_id' => $document_id, 'user_id' => $user_id))->row_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/documents/document-details');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    function rateDocument()
    {
        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $user_rating        = $this->input->post('user_rating');
            $rate_description   = $this->input->post('rate_description');
            $if_anonymous       = $this->input->post('if_anonymous');
            $rate_document      = $this->input->post('rate_document');

            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_rated = $this->db->get_where('document_rating_master', array('document_id' => $rate_document, 'user_id' => $user_id))->row_array();

            if (!empty($chk_if_rated)) {
                $this->db->where(array('id' => $chk_if_rated['id']));
                $this->db->update('document_rating_master', array('rating' => $user_rating, 'description' => $rate_description, 'created_at' => date('Y-m-d H:i:s')));
            } else {

                $insertArr = array(
                    'document_id'      => $rate_document,
                    'user_id'           => $user_id,
                    'rating'            => $user_rating,
                    'description'       => $rate_description,
                    'if_anonymous'      => $if_anonymous,
                    'created_at'        => date('Y-m-d H:i:s')
                );
                $this->db->insert('document_rating_master', $insertArr);
            }

            redirect(site_url('account/documentDetail/' . base64_encode($rate_document)), 'refresh');
        }
    }


    public function editDocument()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $document_id = base64_decode($this->uri->segment('3'));

        $data['index_menu']  = 'documents';
        $data['title']  = 'Edit Document | Studypeers';

        $this->db->select('document_master.*');

        $data['result'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.id' => $document_id, 'document_master.status' => 1))->row_array();

        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['result']['course']))->result_array();

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $document_name     = $this->input->post('document_name');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $privacy        = $this->input->post('privacy');


            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image = $this->uploadImg('featured_image', $_FILES['featured_image']['name']);
            } else {
                $featured_image = $this->input->post('featured_image_old');
            }

            $insertArr = array(
                'document_name' => $document_name,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'privacy'       => $privacy,
                'featured_image' => $featured_image
            );

            $this->db->where(array('id' => $document_id));
            $this->db->update('document_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Document Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/documents'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/documents/document-edit');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function questions()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'questions';
        $data['title']  = 'Questions & Answers | Studypeers';

        $sort_by = '';

        $this->db->select('question_master.*,professor_master.name as professor,course_master.name as course, university.SchoolName, user_info.nickname');
        $this->db->join('professor_master', 'professor_master.id=question_master.professor');
        $this->db->join('course_master', 'course_master.id=question_master.course');
        $this->db->join('university', 'university.university_id=question_master.university');
        $this->db->join('user_info', 'user_info.userID=question_master.created_by');
        if ($this->input->get('sort-by', TRUE)) {
            $sort_by = $this->input->get('sort-by', TRUE);
            if ($sort_by == 'date') {
                $this->db->order_by('question_master.created_at', 'desc');
            } else if ($sort_by == 'name') {
                $this->db->order_by('question_master.question_title', 'desc');
            } else if ($sort_by == 'views') {
                $this->db->order_by('question_master.view_count', 'desc');
            } else if ($sort_by == 'answers') {
                $this->db->reset_query();
                $data['question_list'] = $this->db->query("SELECT `question_master`.*, `professor_master`.`name` as `professor`, `course_master`.`name` as `course`, `university`.`SchoolName`, `user_info`.`nickname`,(select count(`question_answer_master`.id) from question_answer_master where `question_answer_master`.question_id = `question_master`.id AND `question_answer_master`.parent_id = 0) as ansCount FROM `question_master` JOIN `professor_master` ON `professor_master`.`id`=`question_master`.`professor` JOIN `course_master` ON `course_master`.`id`=`question_master`.`course` JOIN `university` ON `university`.`university_id`=`question_master`.`university` JOIN `user_info` ON `user_info`.`userID`=`question_master`.`created_by` WHERE `question_master`.`created_by` = '" . $user_id . "' AND `question_master`.`status` = 1 ORDER BY ansCount DESC")->result_array();
            }
        } else {
            $this->db->order_by('question_master.id', 'desc');
        }
        if ($this->input->get('sort-by', TRUE)) {
            if ($sort_by != 'answers') {
                $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1))->result_array();
            }
        } else if ($this->input->get()) {
            // print_r($this->input->get());die;
            if ($this->input->get('search')) {
                $keyword     = $this->input->get('keyword_search');
                $course     = $this->input->get('course_search');
                $professor  = $this->input->get('professor_search');
                $university = $this->input->get('university_search');
                $category   = $this->input->get('category_search');
            } else {
                $course     = $this->input->get('course');
                $professor  = $this->input->get('professor');
                $university = $this->input->get('university');
                $category   = $this->input->get('category');
                $keyword     = $this->input->get('keyword');
            }
            if (!empty($keyword)) {
                $this->db->group_start();
                $this->db->like('question_master.question_title', $keyword);
                $this->db->group_end();
            }
            if (!empty($university) && !empty($course)) {
                if (empty($category)) {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university, 'question_master.course' => $course))->result_array();
                } else if ($category == 'active' || $category == 'unsolved') {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university, 'question_master.course' => $course, 'question_master.is_solved' => 0))->result_array();
                } else if ($category == 'unanswered') {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university, 'question_master.course' => $course, 'question_master.is_solved' => 0))->result_array();
                }
                $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            } else if (!empty($university) && empty($course)) {
                if (empty($category)) {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university))->result_array();
                } else if ($category == 'active' || $category == 'unsolved') {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university, 'question_master.is_solved' => 0))->result_array();
                } else if ($category == 'unanswered') {
                    $question_list = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university))->result_array();
                    $data['question_list'] = array();
                    foreach ($question_list as $key => $value) {
                        $chk_if_ans = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_id' => $value['id'], 'status' => 1, 'parent_id' => 0))->num_rows();
                        if ($chk_if_ans == 0) {
                            array_push($data['question_list'], $value);
                        }
                    }
                }
                $data['professor']     = array();
            } else {
                if (empty($category)) {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1))->result_array();
                } else if ($category == 'active' || $category == 'unsolved') {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.is_solved' => 0))->result_array();
                } else if ($category == 'unanswered') {
                    $question_list = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1))->result_array();
                    $data['question_list'] = array();
                    foreach ($question_list as $key => $value) {
                        $chk_if_ans = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_id' => $value['id'], 'status' => '1', 'parent_id' => '0'))->num_rows();
                        if ($chk_if_ans == 0) {
                            array_push($data['question_list'], $value);
                        }
                    }
                }
                $data['professor']     = array();
            }
        } else {

            $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1))->result_array();

            $data['professor']     = array();
        }


        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/questions/questions-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }


    public function addQuestion()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['index_menu']  = 'questions';
        $data['title']  = 'Add Question | Studypeers';

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $question_title     = $this->input->post('question_title');
            $university         = $this->input->post('university');
            $course             = $this->input->post('course');
            $professor          = $this->input->post('professor');
            $textarea           = $this->input->post('textarea');


            $insertArr = array(
                'question_title' => $question_title,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,

                'textarea'      => $textarea,
                'status'        => 1,
                'created_by'    => $user_id,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('question_master', $insertArr);

            $insert_id = $this->db->insert_id();

            $insertRef = array(
                'reference'     => 'question',
                'reference_id'  => $insert_id,
                'user_id'       => $user_id,

                'status'        => 1,

                'addDate'       => date('Y-m-d H:i:s'),
                'modifyDate'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('reference_master', $insertRef);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Question Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questions'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/questions/add-question');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }


    public function questionDetail()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $question_id = base64_decode($this->uri->segment('3'));

        $data['index_menu']  = 'questions';
        $data['title']  = 'Question Details | Studypeers';

        $this->db->query("UPDATE question_master SET view_count = view_count + 1 WHERE id = " . $question_id . "");

        $this->db->select('question_master.*,professor_master.name as professor,course_master.name as course, university.SchoolName, user_info.nickname');
        $this->db->join('professor_master', 'professor_master.id=question_master.professor');
        $this->db->join('course_master', 'course_master.id=question_master.course');
        $this->db->join('university', 'university.university_id=question_master.university');
        $this->db->join('user_info', 'user_info.userID=question_master.created_by');
        $this->db->order_by('question_master.id', 'desc');
        $data['result'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.id' => $question_id, 'question_master.status' => 1))->row_array();




        $this->db->select('question_answer_master.*, user_info.nickname');
        $this->db->join('user_info', 'user_info.userID=question_answer_master.answered_by');
        if ($this->input->get('sort-by', TRUE)) {
            $sort_by = $this->input->get('sort-by', TRUE);
            if ($sort_by == 'date') {
                $this->db->order_by('question_answer_master.created_at', 'desc');
            } else if ($sort_by == 'vote') {
                $this->db->order_by('question_answer_master.vote_count', 'desc');
            }
        } else {
            $this->db->order_by('question_answer_master.best_answer', 'desc');
        }

        $data['answer_list'] = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_answer_master.question_id' => $question_id, 'question_answer_master.status' => 1, 'question_answer_master.parent_id' => 0))->result_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/questions/question-details');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }


    public function editQuestion()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $question_id = base64_decode($this->uri->segment('3'));

        $data['index_menu']  = 'questions';
        $data['title']  = 'Edit Question | Studypeers';

        $this->db->select('question_master.*');

        $data['result'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.id' => $question_id, 'question_master.status' => 1))->row_array();


        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['result']['course']))->result_array();

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $question_title     = $this->input->post('question_title');
            $university         = $this->input->post('university');
            $course             = $this->input->post('course');
            $professor          = $this->input->post('professor');
            $textarea           = $this->input->post('textarea');


            $insertArr = array(
                'question_title' => $question_title,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,

                'textarea'      => $textarea
            );

            $this->db->where(array('id' => $question_id));
            $this->db->update('question_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Question Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questions'), 'refresh');
        }


        $this->load->view('user/include/header', $data);
        $this->load->view('user/questions/question-edit');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function voteAnswer()
    {
        if ($this->input->post()) {
            $answer_id     = $this->input->post('answer_id');
            $type       = $this->input->post('type');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_liked = $this->db->get_where($this->db->dbprefix('vote_master'), array('reference' => 'answer', 'reference_id' => $answer_id, 'user_id' => $user_id))->row_array();

            if (!empty($chk_if_liked)) {
                $this->db->where(array('reference' => 'answer', 'reference_id' => $answer_id, 'user_id' => $user_id));
                $this->db->delete('vote_master');
                if ($type == 'upvote') {
                    $this->db->query("UPDATE question_answer_master SET vote_count = vote_count + 1 WHERE id = " . $answer_id . "");
                } else {
                    $this->db->query("UPDATE question_answer_master SET vote_count = vote_count - 1 WHERE id = " . $answer_id . "");
                }
            }


            if ($type == 'upvote') {
                $insertArr = array(
                    'reference'     => 'answer',
                    'reference_id'  => $answer_id,
                    'user_id'       => $user_id,

                    'type'          => 1, // upvote
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $this->db->insert('vote_master', $insertArr);

                $this->db->query("UPDATE question_answer_master SET vote_count = vote_count + 1 WHERE id = " . $answer_id . "");
            } else {
                $insertArr = array(
                    'reference'     => 'answer',
                    'reference_id'  => $answer_id,
                    'user_id'       => $user_id,

                    'type'          => 2, // downvote
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $this->db->insert('vote_master', $insertArr);

                $this->db->query("UPDATE question_answer_master SET vote_count = vote_count - 1 WHERE id = " . $answer_id . "");
            }
            $detail = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('id' => $answer_id))->row_array();
            if ($detail['vote_count'] < 0) {
                echo 0;
                die;
            } else {
                echo $detail['vote_count'];
                die;
            }
        }
    }

    public function voteQuestion()
    {

        if ($this->input->post()) {
            $question_id     = $this->input->post('question_id');
            $type       = $this->input->post('type');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_liked = $this->db->get_where($this->db->dbprefix('vote_master'), array('reference' => 'question', 'reference_id' => $question_id, 'user_id' => $user_id))->row_array();

            if (!empty($chk_if_liked)) {
                $this->db->where(array('reference' => 'question', 'reference_id' => $question_id, 'user_id' => $user_id));
                $this->db->delete('vote_master');
                if ($type == 'upvote') {
                    $this->db->query("UPDATE question_master SET vote_count = vote_count + 1 WHERE id = " . $question_id . "");
                } else {
                    $this->db->query("UPDATE question_master SET vote_count = vote_count - 1 WHERE id = " . $question_id . "");
                }
            }


            if ($type == 'upvote') {
                $insertArr = array(
                    'reference'     => 'question',
                    'reference_id'  => $question_id,
                    'user_id'       => $user_id,

                    'type'          => 1, // upvote
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $this->db->insert('vote_master', $insertArr);

                $this->db->query("UPDATE question_master SET vote_count = vote_count + 1 WHERE id = " . $question_id . "");
            } else {
                $insertArr = array(
                    'reference'     => 'question',
                    'reference_id'  => $question_id,
                    'user_id'       => $user_id,

                    'type'          => 2, // downvote
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $this->db->insert('vote_master', $insertArr);

                $this->db->query("UPDATE question_master SET vote_count = vote_count - 1 WHERE id = " . $question_id . "");
            }
            $detail = $this->db->get_where($this->db->dbprefix('question_master'), array('id' => $question_id))->row_array();
            if ($detail['vote_count'] < 0) {
                echo 0;
                die;
            } else {
                echo $detail['vote_count'];
                die;
            }
        }
    }

    public function removeVoteAnswer()
    {
        if ($this->input->post()) {
            $answer_id     = $this->input->post('answer_id');
            $type       = $this->input->post('type');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('reference' => 'answer', 'reference_id' => $answer_id, 'user_id' => $user_id));
            $this->db->delete('vote_master');


            if ($type == 'upvote') {
                $this->db->query("UPDATE question_answer_master SET vote_count = vote_count - 1 WHERE id = " . $answer_id . "");
            } else {
                $this->db->query("UPDATE question_answer_master SET vote_count = vote_count + 1 WHERE id = " . $answer_id . "");
            }
            $detail = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('id' => $answer_id))->row_array();
            if ($detail['vote_count'] < 0) {
                echo 0;
                die;
            } else {
                echo $detail['vote_count'];
                die;
            }
        }
    }

    public function removeVoteQuestion()
    {
        if ($this->input->post()) {
            $question_id     = $this->input->post('question_id');
            $type       = $this->input->post('type');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('reference' => 'question', 'reference_id' => $question_id, 'user_id' => $user_id));
            $this->db->delete('vote_master');


            if ($type == 'upvote') {
                $this->db->query("UPDATE question_master SET vote_count = vote_count - 1 WHERE id = " . $question_id . "");
            } else {
                $this->db->query("UPDATE question_master SET vote_count = vote_count + 1 WHERE id = " . $question_id . "");
            }
            $detail = $this->db->get_where($this->db->dbprefix('question_master'), array('id' => $question_id))->row_array();
            if ($detail['vote_count'] < 0) {
                echo 0;
                die;
            } else {
                echo $detail['vote_count'];
                die;
            }
        }
    }


    public function submitAnswer()
    {
        if ($this->input->post()) {
            $question_id   = $this->input->post('question_id');
            $answer   = $this->input->post('answer');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'question_id'   => $question_id,
                'answer'        => $answer,
                'answered_by'   => $user_id,

                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('question_answer_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Answer Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }


    public function submitQuestionAnswer()
    {
        if ($this->input->post()) {
            $question_id   = $this->input->post('question_id');
            $answer   = $this->input->post('answer');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'question_id'   => $question_id,
                'answer'        => $answer,
                'answered_by'   => $user_id,

                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('question_answer_master', $insertArr);

            $this->db->select('question_answer_master.*, user_info.nickname');
            $this->db->join('user_info', 'user_info.userID=question_answer_master.answered_by');
            $this->db->order_by('question_answer_master.id', 'desc');

            $value = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_answer_master.question_id' => $question_id, 'question_answer_master.status' => 1, 'question_answer_master.parent_id' => 0))->row_array();

            $value_user = $this->db->get_where($this->db->dbprefix('user'), array('id' => $value['answered_by']))->row_array();


            $html = '<div class="replyAnswerBox" id="replyAnswerBox' . $value['id'] . '">     

                            <div class="answerQuote" id="answerQuote' . $value['id'] . '" style="display:none;">
                                <ul>
                                    <li>
                                        <a>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.625" viewBox="0 0 16 14.625">
                                                <path id="prefix__star" d="M7.432 21.6a.889.889 0 0 1 1.219-.287.864.864 0 0 1 .287.287L11 24.943a.878.878 0 0 0 .575.4l3.91.8a.884.884 0 0 1 .689 1.045.911.911 0 0 1-.222.431l-2.613 2.767a.884.884 0 0 0-.235.7l.4 3.737a.885.885 0 0 1-.787.974.9.9 0 0 1-.434-.062l-3.75-1.565a.876.876 0 0 0-.68 0L4.1 35.743a.883.883 0 0 1-1.219-.911l.4-3.737a.9.9 0 0 0-.235-.7l-2.615-2.77a.884.884 0 0 1 .036-1.251.869.869 0 0 1 .433-.223l3.91-.8a.89.89 0 0 0 .575-.4z" transform="translate(-.189 -21.185)" style="fill:#185aeb"/>
                                            </svg>
                                            Best answer
                                        </a>
                                    </li>
                                </ul>
                            </div>  
                                
                                <div class="feedVoteWrap">
                                    <div class="voteCount">
                                        <div class="uparrow" id="uparrow_' . $value['id'] . '">
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="normalState" width="18.363" height="20" viewBox="0 0 18.363 20" onclick="voteAnswer(\'upvote\', ' . $value['id'] . ')" style="">
                                                <g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
                                                    <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
                                                </g>
                                            </svg>                                      
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?= $up_active_s; ?>" onclick="removeVoteAnswer(\'upvote\', ' . $value['id'] . ')">
                                                <g id="prefix__Layer_1" transform="translate(-31.008 -10.925)">
                                                    <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
                                                        <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" style="fill:#1ae1bd"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="countt" id="count_' . $value['id'] . '">
                                            0
                                        </div>
                                        <div class="downarrow" id="downarrow_' . $value['id'] . '">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18.363" height="20" class="normalState" viewBox="0 0 18.363 20" onclick="voteAnswer(\'downvote\', ' . $value['id'] . ')" style="">
                                                <g id="prefix__up-arrow" transform="rotate(180 24.686 15.463)">
                                                    <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
                                                </g>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?= $down_active_s; ?>" onclick="removeVoteAnswer(\'downvote\', ' . $value['id'] . ')">
                                                <g id="prefix__Layer_1" transform="rotate(180 24.686 15.463)">
                                                    <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
                                                        <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="feed-card list">
                                        <div class="right">
                                            <div class="feed_card_inner">
                                                <p>' . $value['answer'] . '</p>
                                            </div>
                                            <div class="feed_card_footer">
                                                <div class="userWrap study-sets">
                                                    <div class="user-name">
                                                        <figure>
                                                            <img src="' . userImage($value['answered_by']) . '" alt="user">
                                                        </figure>
                                                        <a href="' . base_url() . 'sp/' . $value_user['username'] . '"><figcaption>' . $value['nickname'] . '</figcaption></a>
                                                    </div>
                                                    <p class="date">' . date('d/m/Y', strtotime($value['created_at'])) . '</p>
                                                </div>
                                                <div class="action">
                                                    <ul>
                                                        <li>
                                                            <a href="' . base_url() . 'account/questionDetail/' . base64_encode($question_id) . '" target="_blank">
                                                                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M14.062 257.94L190.06 433.88c30.21 30.21 81.94 8.7 81.94-33.94v-78.28c146.59 8.54 158.53 50.199 134.18 127.879-13.65 43.56 35.07 78.89 72.19 54.46C537.98 464.768 576 403.8 576 330.05c0-170.37-166.04-197.15-304-201.3V48.047c0-42.72-51.79-64.09-81.94-33.94L14.062 190.06c-18.75 18.74-18.75 49.14 0 67.88zM48 224L224 48v128.03c143.181.63 304 11.778 304 154.02 0 66.96-40 109.95-76.02 133.65C501.44 305.911 388.521 273.88 224 272.09V400L48 224z"></path></svg>
                                                                Reply
                                                            </a>
                                                        </li>
                                                         
                                                            <li id="bestAnswerModal' . $value['id'] . '" class="bestAnswerli">
                                                                <a data-toggle="modal" data-target="#confirmationModalBestAnswer" data-id="' . $value['id'] . '" data-value="' . $question_id . '" class="select_best_answer_dashboard">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.625" viewBox="0 0 16 14.625">
                                                                        <path id="prefix__star" d="M7.432 21.6a.889.889 0 0 1 1.219-.287.864.864 0 0 1 .287.287L11 24.943a.878.878 0 0 0 .575.4l3.91.8a.884.884 0 0 1 .689 1.045.911.911 0 0 1-.222.431l-2.613 2.767a.884.884 0 0 0-.235.7l.4 3.737a.885.885 0 0 1-.787.974.9.9 0 0 1-.434-.062l-3.75-1.565a.876.876 0 0 0-.68 0L4.1 35.743a.883.883 0 0 1-1.219-.911l.4-3.737a.9.9 0 0 0-.235-.7l-2.615-2.77a.884.884 0 0 1 .036-1.251.869.869 0 0 1 .433-.223l3.91-.8a.89.89 0 0 0 .575-.4z" transform="translate(-.189 -21.185)" style="fill:#185aeb"/>
                                                                    </svg>
                                                                    Select best answer
                                                                </a>
                                                            </li>
                                                        
                                                        <li class="report">
                                                            <a href="#" class="transAction reportQuestionAnswerDashboard" data-toggle="modal" data-target="#reportModal" data-id="' . $value['id'] . '" data-value="' . $question_id . '">                                                          
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                                    <path id="prefix__flag" d="M10.505 2.5c-1.535 0-2.916-1-5.06-1a6.936 6.936 0 0 0-2.523.474A1.5 1.5 0 1 0 .75 2.8v12.7a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5v-2.608A8.6 8.6 0 0 1 6.245 12c1.535 0 2.916 1 5.06 1a7.26 7.26 0 0 0 4.017-1.249A1.5 1.5 0 0 0 16 10.5V3a1.5 1.5 0 0 0-2.091-1.379 8.938 8.938 0 0 1-3.404.879zm3.995 8a5.878 5.878 0 0 1-3.2 1c-1.873 0-3.188-1-5.06-1a10.719 10.719 0 0 0-3.995.75V4a5.878 5.878 0 0 1 3.2-1c1.873 0 3.188 1 5.06 1A10.685 10.685 0 0 0 14.5 3z" style="fill:#7f7b94"/>
                                                                </svg>
                                                                Report
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            echo $html;
            die;
        }
    }


    public function submitAnswerReply()
    {
        if ($this->input->post()) {
            $question_id   = $this->input->post('question_id');
            $parent_id   = $this->input->post('parent_id');
            $reply   = $this->input->post('reply');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'question_id'   => $question_id,
                'answer'        => $reply,
                'answered_by'   => $user_id,
                'parent_id'     => $parent_id,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('question_answer_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Reply Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }


    public function reportAnswer()
    {
        if ($this->input->post()) {
            $answer_id              = $this->input->post('answer_id');
            $report_reason          = $this->input->post('report_reason');
            $report_description     = $this->input->post('report_description');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $question_id              = $this->input->post('report_question_id');

            $insertArr = array(
                'answer_id'             => $answer_id,
                'report_reason'         => $report_reason,
                'user_id'               => $user_id,
                'report_description'    => $report_description,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );

            $this->db->insert('report_answer', $insertArr);


            $this->db->where(array('id' => $answer_id));
            $this->db->update('question_answer_master', array('status' => 2));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Answer Reported Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }

    public function reportAnswerDashboard()
    {
        if ($this->input->post()) {
            $answer_id              = $this->input->post('answer_id');
            $report_reason          = $this->input->post('report_reason');
            $report_description     = $this->input->post('report_description');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $question_id              = $this->input->post('report_question_id');

            $insertArr = array(
                'answer_id'             => $answer_id,
                'report_reason'         => $report_reason,
                'user_id'               => $user_id,
                'report_description'    => $report_description,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );

            $this->db->insert('report_answer', $insertArr);


            $this->db->where(array('id' => $answer_id));
            $this->db->update('question_answer_master', array('status' => 2));

            echo 1;
            die;
        }
    }

    public function removePeer()
    {
        if ($this->input->post()) {
            $peer_id              = $this->input->post('remove_peer_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('user_id' => $user_id, 'peer_id' => $peer_id));
            $this->db->delete('peer_master');

            $this->db->where(array('user_id' => $peer_id, 'peer_id' => $user_id));
            $this->db->delete('peer_master');

            $this->db->where(array('user_id' => $peer_id, 'peer_id' => $user_id));
            $this->db->delete('friends');

            $this->db->where(array('user_id' => $user_id, 'peer_id' => $peer_id));
            $this->db->delete('friends');

            redirect(site_url('account/dashboard'), 'refresh');
        }
    }


    public function bestAnswer()
    {
        if ($this->input->post()) {
            $question_id    = $this->input->post('best_question_id');
            $answer_id      = $this->input->post('answer_id');

            $this->db->where(array('question_id' => $question_id));
            $this->db->update('question_answer_master', array('best_answer' => 0));

            $this->db->where(array('id' => $answer_id));
            $this->db->update('question_answer_master', array('best_answer' => 1));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Best Answer Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }

    public function bestAnswerDashboard()
    {
        if ($this->input->post()) {
            $question_id    = $this->input->post('best_question_id');
            $answer_id      = $this->input->post('answer_id');

            $this->db->where(array('question_id' => $question_id));
            $this->db->update('question_answer_master', array('best_answer' => 0));

            $this->db->where(array('id' => $answer_id));
            $this->db->update('question_answer_master', array('best_answer' => 1));

            echo 1;
            die;
        }
    }

    public function markQuestion()
    {
        if ($this->input->post()) {
            $question_id        = $this->input->post('mark_question_id');

            $detail = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.id' => $question_id))->row_array();
            if ($detail['is_solved'] == 0) {
                $this->db->where(array('id' => $question_id));
                $this->db->update('question_master', array('is_solved' => 1));
                $txt = 'Marked';
            } else {
                $this->db->where(array('id' => $question_id));
                $this->db->update('question_master', array('is_solved' => 0));
                $txt = 'Unmarked';
            }

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Question ' . $txt . ' Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }

    public function addEventToCalender()
    {
        if ($this->input->post()) {
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $event_id   = $this->input->post('calender_event_id');
            $event      = $this->db->query("select * from event_master where id = " . $event_id . "")->row_array();


            if ($event['created_by'] == $user_id) {

                $startdate  = $event['start_date'] . ' ' . $event['start_time'];
                $enddate    = $event['end_date'] . ' ' . $event['end_time'];
                $schedule   = array(
                    'schedule'      => 'event',
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
                    'featured_image'    => $event['featured_image'],
                    'event_master_id' => $event['id'],
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'created_by'    => $event['created_by'],
                );

                $this->db->insert('schedule_master', $schedule);
                $schedule_id = $this->db->insert_id();


                $this->db->where(array('id' => $event_id));
                $this->db->update('event_master', array('addedToCalender' => 1, 'schedule_master_id' => $schedule_id));
            } else {
                $startdate  = $event['start_date'] . ' ' . $event['start_time'];
                $enddate    = $event['end_date'] . ' ' . $event['end_time'];

                $schedule   = array(
                    'schedule'      => 'event',
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
                    'featured_image'    => $event['featured_image'],
                    'event_master_id' => $event['id'],
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'created_by'    => $user_id,
                );

                $this->db->insert('schedule_master', $schedule);
                $schedule_id = $this->db->insert_id();



                $this->db->where(array('reference_id' => $event_id, 'reference' => 'event', 'peer_id' => $user_id, 'status' => 2));
                $this->db->update('share_master', array('schedule_master_id' => $schedule_id));
            }

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Added To Calender Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            if ($this->input->post('dashboard')) {
                redirect(site_url('account/dashboard'), 'refresh');
            } else if ($this->input->post('timeline')) {
                redirect(site_url('Profile/timeline'), 'refresh');
            } else if ($this->input->post('profile')) {
                $redirect_username = $this->db->get_where($this->db->dbprefix('user'), array('id' => $this->input->post('profile')))->row_array();

                redirect(site_url('sp/' . $redirect_username['username']), 'refresh');
            } else {
                redirect(site_url('account/events'), 'refresh');
            }
        }
    }


    public function getScheduleDetail()
    {
        if ($this->input->post()) {
            $id     = $this->input->post('id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $res    = $this->db->get_where('schedule_master', array('id' => $id))->row_array();
            $uni    = $this->db->get_where('university', array('university_id' => $res['university']))->row_array();
            $course    = $this->db->get_where('course_master', array('id' => $res['course']))->row_array();
            $professor    = $this->db->get_where('professor_master', array('id' => $res['professor']))->row_array();
            if ($res['schedule'] == 'event') {
                $edit_url = base_url() . 'account/editEvent/' . base64_encode($res['event_master_id']);
            } else {
                $edit_url = base_url() . 'account/editSchedule/' . base64_encode($res['id']);
            }
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user = $this->db->get_where('user_info', array('userID' => $res['created_by']))->row_array();
            $html = "";
            if ($res['schedule'] == 'event') {
                $event    = $this->db->get_where('event_master', array('id' => $res['event_master_id']))->row_array();
                if ($event['created_by'] == $user_id) {
                    $html .= '<div class="userWrap action" style="width:auto;">                                      
                        <div class="edit">
                            <a href="' . $edit_url . '">
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
                            <a data-toggle="modal" onclick="deleteSchedule(' . $res['id'] . ')" data-target="#confirmationModal">                                        
                                <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                </svg> Delete
                            </a>
                        </div>  
                    </div>';
                }
            } else {
                $html .= '<div class="userWrap action" style="width:auto;">                                      
                <div class="edit">
                    <a href="' . $edit_url . '">
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
                    <a data-toggle="modal" onclick="deleteSchedule(' . $res['id'] . ')" data-target="#confirmationModal">                                        
                        <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                            <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                        </svg> Delete
                    </a>
                </div>  
            </div>';
            }

            $html .= '<h4>' . $res['schedule_name'] . '</h4>
        <div class="badgeList">
            <ul>
                <li class="badge badge1">' . $uni['SchoolName'] . '</li>
                <li class="badge badge2">' . $course['name'] . '</li>
                <li class="badge badge3">' . $professor['name'] . '</li>
            </ul>
        </div>';

            if ($res['schedule'] == 'event') {
                $html .= '<div class="daytime"> 
                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                    <path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
                        c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
                        c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
                    <path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
                        c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
                    <path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
                </svg>' . $res['location'] . '</div>';
            }

            $html .= '<div class="daytime">
            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
                <path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
                    M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
                    S365.867,459.733,250.667,459.733z"></path>
                <path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
                    c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
            </svg>' . date('d M, Y h:i A', strtotime($res['start_date'])) . ' - ' . date('d M, Y h:i A', strtotime($res['end_date'])) . '</div>
        <div class="userWrap">
            <div class="user-name">
                <figure>
                    <img src="' . userImage($res['created_by']) . '" alt="user">
                </figure>
                <a href="' . base_url() . 'sp/' . $user['username'] . '"><figcaption>' . $user['nickname'] . '</figcaption></a>
            </div>  
        </div>';
            if (!empty($res['description'])) {
                $html .= '<div class="descpription">
            <h6>Description</h6>
            <p>' . $res['description'] . '</p>
            </div>';
            }
            if ($res['schedule'] == 'event') {
                $html .= '<div class="mapWrapper">
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
            print_r(json_encode($result));
            die;
        }
    }


    public function editSchedule()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $schedule_id = base64_decode($this->uri->segment('3'));

        $data['schedule'] = $this->db->query("select * from schedule_master where id = " . $schedule_id . "")->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['schedule']['university']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['schedule']['course']))->result_array();

        $data['index_menu']  = 'schedule';
        $data['title']  = 'Edit Schedule | Studypeers';

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $schedule_id = base64_decode($this->uri->segment('3'));
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

            $insertArr = array(
                'schedule'      => $schedule,
                'schedule_name' => $schedule_name,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'start_date'    => $start_date,
                'end_date'      => $end_date
            );
            //$this->db->insert('schedule_master', $insertArr);
            $this->db->where(array('id' => $schedule_id));
            $this->db->update('schedule_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Schedule Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/schedule'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/schedule/edit-schedule');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/schedule/footer');
    }

    public function deleteSchedule()
    {
        if ($this->input->post()) { //print_r($this->input->post());die;
            $schedule_id = $this->input->post('delete_schedule_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('id' => $schedule_id));
            $this->db->update('schedule_master', array('status' => 3));

            $this->db->where(array('schedule_master_id' => $schedule_id));
            $this->db->update('event_master', array('addedToCalender' => 0));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Schedule Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/schedule'), 'refresh');
        }
    }

    public function removeEvent()
    {
        if ($this->input->post()) { //print_r($this->input->post());die;
            $remove_event_id = $this->input->post('remove_event_id');
            $event      = $this->db->query("select * from event_master where id = " . $remove_event_id . "")->row_array();
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $this->db->where(array('event_master_id' => $remove_event_id, 'created_by' => $user_id));
            $this->db->update('schedule_master', array('status' => 3));

            if ($event['created_by'] == $user_id) {
                $this->db->where(array('id' => $remove_event_id));
                $this->db->update('event_master', array('addedToCalender' => 0));
            } else {
                $this->db->where(array('reference_id' => $remove_event_id, 'reference' => 'event', 'peer_id' => $user_id, 'status' => 2));
                $this->db->update('share_master', array('schedule_master_id' => 0));
            }

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Removed From Schedule Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            if ($this->input->post('dashboard')) {
                redirect(site_url('account/dashboard'), 'refresh');
            } else if ($this->input->post('timeline')) {
                redirect(site_url('Profile/timeline'), 'refresh');
            } else if ($this->input->post('profile')) {
                $redirect_username = $this->db->get_where($this->db->dbprefix('user'), array('id' => $this->input->post('profile')))->row_array();

                redirect(site_url('sp/' . $redirect_username['username']), 'refresh');
            } else {
                redirect(site_url('account/events'), 'refresh');
            }
        }
    }

    public function addComment()
    {
        if ($this->input->post()) {
            $comment = $this->input->post('comment');
            $event_id = $this->input->post('event_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'reference' => 'event',
                'reference_id' => $event_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $count = $this->db->get_where('comment_master', array('reference_id' => $event_id, 'reference' => 'event', 'comment_parent_id' => 0, 'status' => 1))->num_rows();

            $text = 'event';

            $html = '<div class="chatMsg" id="comment_id_' . $comment_id . '">
                        <figure>
                            <img src="' . userImage($user_id) . '" alt="User">
                        </figure>
                        <figcaption>
                            <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name"> ' . $user_info['nickname'] . '</span></a>
                            ' . $comment . '                                                 
                            <div class="actionmsgMenu">
                                <ul>
                                    <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                    <li class="replyuser" onclick="showReplyBox(' . $comment_id . ')">Reply</li>
                                </ul>
                            </div>
                            <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                <div class="react">
                                    <img src="' . base_url() . 'assets_d/images/like.png" alt="Like">
                                </div>
                                <p id="like_count_' . $comment_id . '"></p>
                            </div>
                        </figcaption>
                        <div class="dotsBullet dropdown">
                                                    <img
                                                        src="' . base_url() . 'assets_d/images/more.svg"
                                                        alt="more"
                                                        data-toggle="dropdown">
                                                    <ul class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1">
                                                        <li role="presentation">
                                                            <a role="menuitem"
                                                               tabindex="-1"
                                                               href="javascript:void(0);">
                                                                <div
                                                                    class="left">
                                                                    <img
                                                                        src="' . base_url() . 'assets_d/images/restricted.svg"
                                                                        alt="Save">
                                                                </div>
                                                                <div
                                                                    class="right">
                                                                    <span>Hide/block</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);" onclick="deleteComment(' . $comment_id . ', ' . $event_id . ', \'' . $text . '\')">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="' . base_url() . 'assets_d/images/trash.svg"
                                                                            alt="Link">
                                                                    </div>
                                                                    <div
                                                                        class="right">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        
                                                    </ul>
                                            </div>

                        <div class="reply" id="reply_' . $comment_id . '">
                                                
                        </div>
                        <div class="replyBox" id="replyBox' . $comment_id . '">
                            <figure>
                                <img src="' . userImage($user_id) . '" alt="User">
                            </figure>
                            <div class="replyuser">
                                <input type="text" id="input_reply_' . $comment_id . '" placeholder="Write a Reply..." onkeypress="postReply(event,' . $comment_id . ', this.value)">
                            </div>
                        </div>                                                  
                    </div>';
            $result['html'] = $html;
            if ($count != 0) {
                $result['count'] = '(' . $count . ')';
            } else {
                $result['count'] = '';
            }
            print_r(json_encode($result));
            die;
        }
    }

    public function postReply()
    {
        if ($this->input->post()) {
            $comment = $this->input->post('comment');
            $event_id = $this->input->post('event_id');
            $comment_id = $this->input->post('comment_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'reference' => 'event',
                'reference_id' => $event_id,
                'comment_parent_id' => $comment_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $comment_parent_id = $comment_id;

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="userReplyBox" id="comment_reply_id_' . $comment_id . '"><figure>
                        <img src="' . userImage($user_id) . '" alt="User">
                    </figure>
                    <figcaption>
                        <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name">' . $user_info['nickname'] . '</span></a>
                        ' . $comment . '                                            
                        <div class="actionmsgMenu">
                            <ul>
                                <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                
                            </ul>
                        </div>
                        <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                            <div class="react">
                                <img src="' . base_url() . 'assets_d/images/like.png" alt="Like">
                            </div>
                            <p id="like_count_' . $comment_id . '">0</p>
                        </div>
                    </figcaption>
                    <div class="dotsBullet dropdown">
                                                    <img
                                                        src="' . base_url() . 'assets_d/images/more.svg"
                                                        alt="more"
                                                        data-toggle="dropdown">
                                                    <ul class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1">
                                                        <li role="presentation">
                                                            <a role="menuitem"
                                                               tabindex="-1"
                                                               href="javascript:void(0);">
                                                                <div
                                                                    class="left">
                                                                    <img
                                                                        src="' . base_url() . 'assets_d/images/restricted.svg"
                                                                        alt="Save">
                                                                </div>
                                                                <div
                                                                    class="right">
                                                                    <span>Hide/block</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);" onclick="deleteCommentReply(' . $comment_id . ', ' . $comment_parent_id . ')">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="' . base_url() . 'assets_d/images/trash.svg"
                                                                            alt="Link">
                                                                    </div>
                                                                    <div
                                                                        class="right">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        
                                                    </ul>
                                            </div>
                    </div>';
            echo $html;
            die;
        }
    }

    public function postReplyDocument()
    {
        if ($this->input->post()) {
            $comment = $this->input->post('comment');
            $doc_id = $this->input->post('doc_id');
            $comment_id = $this->input->post('comment_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'reference' => 'document',
                'reference_id' => $doc_id,
                'comment_parent_id' => $comment_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $comment_parent_id = $comment_id;

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="userReplyBox" id="comment_reply_id_' . $comment_id . '"><figure>
                        <img src="' . userImage($user_id) . '" alt="User">
                    </figure>
                    <div class="right">
                        <div class="userWrapText">
                            <figcaption>
                                <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name">' . $user_info['nickname'] . '</span></a>
                                ' . $comment . '                                            
                                <div class="actionmsgMenu">
                                    <ul>
                                        <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                        
                                    </ul>
                                </div>
                                <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                    <div class="react">
                                        <img src="' . base_url() . 'assets_d/images/like-dashboard.svg" alt="Like">
                                    </div>
                                    <p id="like_count_' . $comment_id . '">0</p>
                                </div>
                            </figcaption>
                        </div>
                        <div class="dotsBullet dropdown">
                                                    <img
                                                        src="' . base_url() . 'assets_d/images/more.svg"
                                                        alt="more"
                                                        data-toggle="dropdown">
                                                    <ul class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1">
                                                        <li role="presentation">
                                                            <a role="menuitem"
                                                               tabindex="-1"
                                                               href="javascript:void(0);">
                                                                <div
                                                                    class="left">
                                                                    <img
                                                                        src="' . base_url() . 'assets_d/images/restricted.svg"
                                                                        alt="Save">
                                                                </div>
                                                                <div
                                                                    class="right">
                                                                    <span>Hide/block</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);" onclick="deleteCommentReply(' . $comment_id . ', ' . $comment_parent_id . ')">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="' . base_url() . 'assets_d/images/trash.svg"
                                                                            alt="Link">
                                                                    </div>
                                                                    <div
                                                                        class="right">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        
                                                    </ul>
                                            </div>
                    </div>
                    </div>';
            echo $html;
            die;
        }
    }



    public function likeComment()
    {
        if ($this->input->post()) {
            $comment_id = $this->input->post('comment_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $if_user_liked = $this->db->get_where('comment_like_master', array('comment_id' => $comment_id, 'status' => 1, 'user_id' => $user_id))->row_array();

            if (!empty($if_user_liked)) {
                $this->db->where(array('comment_id' => $comment_id, 'user_id' => $user_id));
                $this->db->delete('comment_like_master');
            } else {

                $insertArr = array(
                    'comment_id' => $comment_id,

                    'user_id' => $user_id,

                    'status' => '1',
                    'created_at' => date('Y-m-d H:i:s')

                );

                $this->db->insert('comment_like_master', $insertArr);
            }
            $count = $this->db->get_where('comment_like_master', array('comment_id' => $comment_id, 'status' => 1))->num_rows();
            echo $count;
        }
    }

    public function likeCommentDocument()
    {
        if ($this->input->post()) {
            $doc_id = $this->input->post('doc_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_liked = $this->db->get_where('document_like_master', array('doc_id' => $doc_id, 'user_id' => $user_id))->num_rows();
            if ($chk_if_liked == 0) {
                $insertArr = array(
                    'doc_id' => $doc_id,
                    'user_id' => $user_id,
                    'created_at' => date('Y-m-d H:i:s')

                );

                $this->db->insert('document_like_master', $insertArr);

                $this->db->query("UPDATE document_master SET likeCount = likeCount + 1 WHERE id = " . $doc_id . "");
            } else {
                $this->db->where(array('doc_id' => $doc_id, 'user_id' => $user_id));
                $this->db->delete('document_like_master');

                $this->db->query("UPDATE document_master SET likeCount = likeCount - 1 WHERE id = " . $doc_id . "");
            }
            $count = $this->db->get_where('document_like_master', array('doc_id' => $doc_id))->num_rows();
            echo $count;
        }
    }

    public function postImgReply()
    {

        if ($this->input->post()) {

            $event_id = $this->input->post('event_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $c_image = $this->uploadCommentImg('file', $_FILES['file']['name']);

            $insertArr = array(
                'reference' => 'event',
                'reference_id' => $event_id,
                'user_id' => $user_id,
                'comment' => $c_image,
                'type'   => 1,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="chatMsg" id="comment_id_' . $comment_id . '">
                        <figure>
                            <img src="' . userImage($user_id) . '" alt="User">
                        </figure>
                        <figcaption>
                            <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name"> ' . $user_info['nickname'] . '</span></a>
                            <img src="' . base_url() . 'uploads/comments/' . $c_image . '" alt="comment" style="height: 70px;">                                                 
                            <div class="actionmsgMenu">
                                <ul>
                                    <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                    <li class="replyuser" onclick="showReplyBox(' . $comment_id . ')">Reply</li>
                                </ul>
                            </div>
                            <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                <div class="react">
                                    <img src="' . base_url() . 'assets_d/images/like.png" alt="Like">
                                </div>
                                <p id="like_count_' . $comment_id . '"></p>
                            </div>
                        </figcaption>
                        <div class="reply" id="reply_' . $comment_id . '">
                                                
                        </div>
                        <div class="replyBox" id="replyBox' . $comment_id . '">
                            <figure>
                                <img src="' . userImage($user_id) . '" alt="User">
                            </figure>
                            <div class="replyuser">
                                <input type="text" id="input_reply_' . $comment_id . '" placeholder="Write a Reply..." onkeypress="postReply(event,' . $comment_id . ', this.value)">
                            </div>
                        </div>                                                  
                    </div>';
            echo $html;
            die;
        }
    }

    public function postImgCommentDoc()
    {

        if ($this->input->post()) {

            $doc_id = $this->input->post('doc_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $c_image = $this->uploadCommentImg('file', $_FILES['file']['name']);

            $insertArr = array(
                'reference' => 'document',
                'reference_id' => $doc_id,
                'user_id' => $user_id,
                'comment' => $c_image,
                'type'   => 1,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="chatMsg" id="comment_id_' . $comment_id . '">
                        <figure>
                            <img src="' . userImage($user_id) . '" alt="User">
                        </figure>
                        <figcaption>
                            <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name"> ' . $user_info['nickname'] . '</span></a>
                            <img src="' . base_url() . 'uploads/comments/' . $c_image . '" alt="comment" style="height: 70px;">                                                 
                            <div class="actionmsgMenu">
                                <ul>
                                    <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                    <li class="replyuser" onclick="showReplyBox(' . $comment_id . ')">Reply</li>
                                </ul>
                            </div>
                            <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                <div class="react">
                                    <img src="' . base_url() . 'assets_d/images/like.png" alt="Like">
                                </div>
                                <p id="like_count_' . $comment_id . '"></p>
                            </div>
                        </figcaption>
                        <div class="reply" id="reply_' . $comment_id . '">
                                                
                        </div>
                        <div class="replyBox" id="replyBox' . $comment_id . '">
                            <figure>
                                <img src="' . userImage($user_id) . '" alt="User">
                            </figure>
                            <div class="replyuser">
                                <input type="text" id="input_reply_' . $comment_id . '" placeholder="Write a Reply..." onkeypress="postReply(event,' . $comment_id . ', this.value)">
                            </div>
                        </div>                                                  
                    </div>';
            echo $html;
            die;
        }
    }

    public function addCommentDocument()
    {
        if ($this->input->post()) {
            $comment = $this->input->post('comment');
            $doc_id = $this->input->post('doc_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'reference' => 'document',
                'reference_id' => $doc_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $count = $this->db->get_where('comment_master', array('reference_id' => $doc_id, 'reference' => 'document', 'comment_parent_id' => 0, 'status' => 1))->num_rows();

            $text = 'document';

            $html = '<div class="chatMsg" id="comment_id_' . $comment_id . '">
                        <div class="chatMsgBox">
                            <figure>
                                <img src="' . userImage($user_id) . '" alt="User">
                            </figure>
                            <div class="right">
                                <div class="userWrapText">
                                    <figcaption>
                                        <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name"> ' . $user_info['nickname'] . '</span></a>
                                        ' . $comment . '                                                 
                                        <div class="actionmsgMenu">
                                            <ul>
                                                <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                                <li class="replyuser" onclick="showReplyBox(' . $comment_id . ')">Reply</li>
                                            </ul>
                                        </div>
                                        <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                            <div class="react">
                                                <img src="' . base_url() . 'assets_d/images/like-dashboard.svg" alt="Like">
                                            </div>
                                            <p id="like_count_' . $comment_id . '"></p>
                                        </div>
                                    </figcaption>
                                    <div class="reply" id="reply_' . $comment_id . '">
                                                
                                    </div>
                                    <div class="replyBox" id="replyBox' . $comment_id . '">
                                        <figure>
                                            <img src="' . userImage($user_id) . '" alt="User">
                                        </figure>
                                        <div class="replyuser">
                                            <input type="text" id="input_reply_' . $comment_id . '" placeholder="Write a Reply..." onkeypress="postReply(event,' . $comment_id . ', this.value)">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="dotsBullet dropdown">
                                                    <img
                                                        src="' . base_url() . 'assets_d/images/more.svg"
                                                        alt="more"
                                                        data-toggle="dropdown">
                                                    <ul class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1">
                                                        <li role="presentation">
                                                            <a role="menuitem"
                                                               tabindex="-1"
                                                               href="javascript:void(0);">
                                                                <div
                                                                    class="left">
                                                                    <img
                                                                        src="' . base_url() . 'assets_d/images/restricted.svg"
                                                                        alt="Save">
                                                                </div>
                                                                <div
                                                                    class="right">
                                                                    <span>Hide/block</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);" onclick="deleteComment(' . $comment_id . ', ' . $doc_id . ', \'' . $text . '\')">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="' . base_url() . 'assets_d/images/trash.svg"
                                                                            alt="Link">
                                                                    </div>
                                                                    <div
                                                                        class="right">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        
                                                    </ul>
                                            </div>

                        
                            </div>                                             
                    </div>';
            $result['html'] = $html;
            if ($count != 0) {
                $result['count'] = '(' . $count . ')';
            } else {
                $result['count'] = '';
            }
            print_r(json_encode($result));
            die;
        }
    }

    public function uploadImg($f_n, $name)
    {
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv'); // Allowed file extensions

        $imagename  = time();
        $config['upload_path']      = 'uploads/users/';
        $config['allowed_types']    = $fileTypes;
        $config['max_size']         = '0';
        $logo_file_name             = '';
        $config['file_name']        =   $imagename;
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        if ($this->upload->do_upload($f_n)) {
            $logo_data = $this->upload->data();
            $logo_file_name = $logo_data['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            die;
        }

        if (!empty($logo_file_name)) {
            $img = $logo_file_name;
        } else {
            $img = 'default.png';
        }
        return $img;
    }

    public function uploadCommentImg($f_n, $name)
    {
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv'); // Allowed file extensions

        $imagename  = time();
        $config['upload_path']      = 'uploads/comments/';
        $config['allowed_types']    = $fileTypes;
        $config['max_size']         = '0';
        $logo_file_name             = '';
        $config['file_name']        =   $imagename;
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        if ($this->upload->do_upload($f_n)) {
            $logo_data = $this->upload->data();
            $logo_file_name = $logo_data['file_name'];
        }

        if (!empty($logo_file_name)) {
            $img = $logo_file_name;
        } else {
            $img = 'default.png';
        }
        return $img;
    }

    public function postCourse()
    {
        if ($this->input->post()) {
            $course_name    = $this->input->post('course_name');
            $course_id      = $this->input->post('course_id');
            $professor_first_name   = $this->input->post('professor_first_name');
            $professor_last_name    = $this->input->post('professor_last_name');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            foreach ($course_name as $key => $value) {
                $insertArr = array(
                    'user_id'   => $user_id,
                    'name'      => $value,
                    'course_id' => $course_id[$key],
                    'status'    => 1,
                    'created_at' => date('Y-m-d H:i:s')

                );

                $this->db->insert('course_master', $insertArr);
                $id = $this->db->insert_id();

                $full_name = $professor_first_name[$key] . ' ' . $professor_last_name[$key];

                $insertArr2 = array(
                    'name'          => $full_name,
                    'course_id'     => $id,
                    'first_name'    => $professor_first_name[$key],
                    'last_name'     => $professor_last_name[$key],
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s')

                );

                $this->db->insert('professor_master', $insertArr2);
            }
        }
        $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Course Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
        $this->session->set_flashdata('flash_message', $message);
        redirect(site_url('account/dashboard'), 'refresh');
    }

    public function showAllCourses()
    {
        $user_id    = $this->session->get_userdata()['user_data']['user_id'];

        $this->db->select('course_master.*,professor_master.first_name,professor_master.last_name ');
        $this->db->join('professor_master', 'professor_master.course_id=course_master.id');

        $get_course = $this->db->get_where($this->db->dbprefix('course_master'), array('course_master.user_id' => $user_id, 'course_master.status' => 1))->result_array();
        $html = '';
        if (!empty($get_course)) {
            foreach ($get_course as $key => $value) {
                $html .= '<div class="courseBox">
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control form-control--lg" placeholder="Course ID" value="' . $value['course_id'] . '">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control form-control--lg course_name" placeholder="Course Name" value="' . $value['name'] . '">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control form-control--lg professor_first_name" placeholder="Professor First Name" value="' . $value['first_name'] . '">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control form-control--lg professor_last_name" placeholder="Professor Last Name" value="' . $value['last_name'] . '">
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            $html = '<h5 class="text-center" style="padding-top: 25px;">No course added yet.</h5>';
        }
        $num = count($get_course);
        echo json_encode(array("html" => $html, "num" => $num));
    }

    public function uploadUserUploads($f_n, $name)
    {
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv'); // Allowed file extensions

        $imagename  = time();
        $config['upload_path']      = 'uploads/user_uploads/';
        $config['allowed_types']    = $fileTypes;
        $config['max_size']         = '0';
        $logo_file_name             = '';
        $config['file_name']        =   $imagename;
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        if ($this->upload->do_upload($f_n)) {
            $logo_data = $this->upload->data();
            $logo_file_name = $logo_data['file_name'];
        }

        if (!empty($logo_file_name)) {
            $img = $logo_file_name;
        } else {
            $img = 'default.png';
        }
        return $img;
    }

    public function uploadEditorImg()
    {
        if (isset($_FILES['upload']['name'])) {
            $c_image = $this->uploadUserUploads('upload', $_FILES['upload']['name']);

            $function_number = $_GET['CKEditorFuncNum'];
            $url = base_url() . 'uploads/user_uploads/' . $c_image;
            $message = '';
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
        }
    }

    public function saveFirebaseToken()
    {
        if ($this->input->post()) {
            $token    = $this->input->post('token');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $user_id, 'token' => $token))->row_array();

            $this->db->where(array('token' => $token, 'status' => 1));
            $this->db->update('user_token', array('status' => 2));

            $insertArr2 = array(
                'user_id'       => $user_id,
                'token'         => $token,
                'status'        => 1,
                'add_date'      => date('Y-m-d H:i:s')

            );

            $this->db->insert('user_token', $insertArr2);

            echo $token;
        }
    }

    public function sendPeerRequest()
    {
        if ($this->input->post()) {
            $peer_id    = $this->input->post('peer_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];


            $insertArr2 = array(
                'user_id'       => $user_id,
                'peer_id'       => $peer_id,
                'status'        => 1,
                'request_date'      => date('Y-m-d H:i:s')

            );

            $this->db->insert('peer_master', $insertArr2);

            $action_id = $this->db->insert_id();

            $userdata = $this->session->userdata('user_data');

            $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
            $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];

            $notification = "<b>" . $full_name . "</b> sent you peer request";

            $insertArr = array(
                'user_id'       => $peer_id,
                'notification'       => $notification,
                'action_type'   => 1,
                'action_id'     => $action_id,
                'img_user_id'   => $user_id,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')

            );

            $this->db->insert('notification_master', $insertArr);

            $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $peer_id, 'status' => 1))->result_array();

            foreach ($get_active_token  as $key => $value) {
                $this->sendTestNotification($value['token'], 'New Peer Request', 'You have received a new Peer Request', $action_id);
            }

            echo 1;
        }
    }

    public function addCancelPeer()
    {
        $peer_id = $this->input->post('peer_id');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];

        $chk_if_request = $this->db->get_where($this->db->dbprefix('peer_master'), array('peer_id' => $peer_id, 'user_id' => $user_id, 'status' => 1))->row_array();

        if (empty($chk_if_request)) {
            $insertArr2 = array(
                'user_id'       => $user_id,
                'peer_id'       => $peer_id,
                'status'        => 1,
                'request_date'      => date('Y-m-d H:i:s')

            );

            $this->db->insert('peer_master', $insertArr2);

            $action_id = $this->db->insert_id();

            $userdata = $this->session->userdata('user_data');

            $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
            $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];

            $notification = "<b>" . $full_name . "</b> sent you peer request";

            $insertArr = array(
                'user_id'       => $peer_id,
                'notification'       => $notification,
                'action_type'   => 1,
                'action_id'     => $action_id,
                'img_user_id'   => $user_id,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')

            );

            $this->db->insert('notification_master', $insertArr);

            $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $peer_id, 'status' => 1))->result_array();

            foreach ($get_active_token  as $key => $value) {
                $this->sendTestNotification($value['token'], 'New Peer Request', 'You have received a new Peer Request', $action_id);
            }
            echo 'Cancel Request';
            die;
        } else {

            $this->db->where(array('action_id' => $chk_if_request['id']));
            $this->db->delete('notification_master');

            if ($chk_if_request['status'] == 1) {

                $this->db->where(array('id' => $chk_if_request['id']));
                $this->db->delete('peer_master');
            }
            echo 'Add Peer';
            die;
        }
    }

    public function sendTestNotification($token, $title, $body, $info)
    {
        $message['title'] = $title;
        $message['body'] = $body;
        sendFCM($message, $token, $info);
    }

    public function acceptRequest()
    {
        if ($this->input->post()) {
            $id    = $this->input->post('id');
            $action_id    = $this->input->post('action_id');

            $this->db->where(array('id' => $id));
            $this->db->update('notification_master', array('status' => 2));


            $detail = $this->db->get_where($this->db->dbprefix('peer_master'), array('id' => $action_id))->row_array();

            if ($detail['status'] == 1) {

                $insert_into_friends = [
                    'user_id' => $detail['user_id'],
                    'peer_id' => $detail['peer_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('friends', $insert_into_friends);

                $insert_data = array(
                    'user_id'       => $detail['user_id'],
                    'peer_id'       => $detail['peer_id'],
                );
                $insert_data_chk = $this->db->get_where($this->db->dbprefix('follow_master'), $insert_data)->row_array();
                if (empty($insert_data_chk)) {
                    $this->db->insert('follow_master', $insert_data);
                }

                $insert_into_friends = [
                    'user_id' => $detail['peer_id'],
                    'peer_id' => $detail['user_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('friends', $insert_into_friends);

                $insert_data = array(
                    'user_id'       => $detail['peer_id'],
                    'peer_id'       => $detail['user_id'],
                );
                $insert_data_chk = $this->db->get_where($this->db->dbprefix('follow_master'), $insert_data)->row_array();
                if (empty($insert_data_chk)) {
                    $this->db->insert('follow_master', $insert_data);
                }


                $this->db->where(array('id' => $action_id));
                $this->db->update('peer_master', array('status' => 2));

                $userdata = $this->session->userdata('user_data');
                $user_detail    = $this->db->get_where('user', array('id' => $detail['peer_id']))->row_array();
                $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];

                $notification = "<b>" . $full_name . "</b> accepted your peer request";

                $insertArr = array(
                    'user_id'       => $detail['user_id'],
                    'notification'  => $notification,
                    'action_type'   => 2,
                    'action_id'     => 0,
                    'img_user_id'   => $detail['peer_id'],
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s')

                );

                $this->db->insert('notification_master', $insertArr);

                $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $detail['user_id'], 'status' => 1))->result_array();

                foreach ($get_active_token  as $key => $value) {
                    $this->sendTestNotification($value['token'], 'Peer Request Accepted', 'Your Peer Request has been accepted by ' . $full_name . '.', '0');
                }
            }

            echo 1;
            die;
        }
    }


    public function readAllNotofication()
    {
        if ($this->input->post()) {
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('user_id' => $user_id));
            $this->db->update('notification_master', array('status' => 2));

            echo 1;
            die;
        }
    }


    public function cancelRequest()
    {
        if ($this->input->post()) {
            $peer_id    = $this->input->post('peer_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $detail = $this->db->get_where($this->db->dbprefix('peer_master'), array('user_id' => $user_id, 'peer_id' => $peer_id, 'status' => 1))->row_array();


            $this->db->where(array('action_id' => $detail['id']));
            $this->db->update('notification_master', array('status' => 2));



            if ($detail['status'] == 1) {

                $this->db->where(array('id' => $detail['id']));
                $this->db->update('peer_master', array('status' => 3));
            }

            echo 1;
            die;
        }
    }


    public function rejectRequest()
    {
        if ($this->input->post()) {
            $id    = $this->input->post('id');
            $action_id    = $this->input->post('action_id');


            $detail = $this->db->get_where($this->db->dbprefix('peer_master'), array('id' => $action_id))->row_array();


            $this->db->where(array('id' => $id));
            $this->db->update('notification_master', array('status' => 2));



            if ($detail['status'] == 1) {

                $this->db->where(array('id' => $action_id));
                $this->db->update('peer_master', array('status' => 3));
            }

            echo 1;
            die;
        }
    }

    public function redirectAction()
    { {
            $id    = $this->input->post('id');

            $notification_detail = $this->db->get_where($this->db->dbprefix('notification_master'), array('id' => $id))->row_array();

            $this->db->where(array('id' => $id));
            $this->db->update('notification_master', array('status' => 2));

            $detail = $this->db->get_where($this->db->dbprefix('share_master'), array('id' => $notification_detail['action_id']))->row_array();

            if ($detail['reference'] == 'studyset') {
                echo base_url() . 'studyset/details/' . $detail['reference_id'];
                die;
            } else if ($detail['reference'] == 'event') {
                echo base_url() . 'account/eventDetails/' . base64_encode($detail['reference_id']);
                die;
            }
        }
    }

    public function getPeerToShare()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $document_id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '" . $user_id . "')")->result_array();

        $html = '';

        foreach ($peer_list as $key => $value) {
            if ($value['user_id'] == $user_id) {
                $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                $this->db->join('user', 'user.id=user_info.userID');
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['peer_id']))->row_array();
            } else {
                $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                $this->db->join('user', 'user.id=user_info.userID');
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['user_id']))->row_array();
            }
            $chk_if_shared = $this->db->get_where($this->db->dbprefix('share_master'), array('peer_id' => $peer['userID'], 'reference' => 'document', 'reference_id' => $document_id, 'status' => 1))->row_array();

            $html .= '<section class="list"><section class="left">
                        <figure>
                            <img src="' . userImage($peer['userID']) . '" alt="user">
                        </figure>
                        <a href="' . base_url() . 'sp/' . $peer['username'] . '"><figcaption>' . $peer['nickname'] . '</figcaption></a>
                    </section>
                    <section class="action" id="action_' . $peer['userID'] . '">';
            if (empty($chk_if_shared)) {
                $html .= '<button type="button" class="like" onclick="shareToPeer(' . $peer['userID'] . ')">share</button>';
            } else {
                $html .= '<button type="button" class="like" onclick="unshareToPeer(' . $peer['userID'] . ')">shared</button>';
            }
            $html .= '</section>
                </section>';
        }
        echo $html;
        die;
    }

    public function shareToPeerDocument()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $insertArr = array(
            'reference' => 'document',
            'reference_id' => $id,
            'user_id' => $user_id,
            'peer_id' => $peer_id,
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s")

        );
        $this->db->insert('share_master', $insertArr);

        $action_id = $this->db->insert_id();

        $userdata = $this->session->userdata('user_data');
        $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
        $notification = "<b>" . $full_name . "</b> has shared a document with you.";

        $insertArr = array(
            'user_id'       => $peer_id,
            'notification'  => $notification,
            'action_type'   => 3, // for share
            'action_id'     => $action_id,
            'img_user_id'   => $user_id,
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s')

        );

        $this->db->insert('notification_master', $insertArr);

        $this->updateShareCountDocument($id);

        $det = $this->db->get_where($this->db->dbprefix('document_master'), array('id' => $id))->row_array();

        $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $peer_id, 'status' => 1))->result_array();

        foreach ($get_active_token  as $key => $value) {
            $this->sendTestNotification($value['token'], 'Document Shared', 'A document has been shared with you', $action_id);
        }
        echo $det['shareCount'];
        die;
    }

    function updateShareCountDocument($id)
    {
        $this->db->where('id', $id);
        $this->db->set('shareCount', 'shareCount+1', FALSE);
        $update_like = $this->db->update('document_master');
        return 1;
    }


    public function unshareToPeerDocument()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $this->db->order_by('share_master.id', 'desc');
        $action_detail    = $this->db->get_where('share_master', array('reference' => 'document', 'reference_id' => $id, 'user_id' => $user_id, 'peer_id' => $peer_id))->row_array();

        $this->db->where(array('id' => $action_detail['id']));
        $this->db->delete('share_master');

        $this->db->where(array('action_id' => $action_detail['id']));
        $this->db->delete('notification_master');

        $this->updateShareCountDocumentDec($id);

        $det = $this->db->get_where($this->db->dbprefix('document_master'), array('id' => $id))->row_array();


        echo $det['shareCount'];
        die;
    }

    function updateShareCountDocumentDec($id)
    {
        $this->db->where('id', $id);
        $this->db->set('shareCount', 'shareCount-1', FALSE);
        $update_like = $this->db->update('document_master');
        return 1;
    }

    public function getPeerToInvite()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');


        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '" . $user_id . "')")->result_array();

        $html = '';

        foreach ($peer_list as $key => $value) {
            if ($value['user_id'] == $user_id) {
                $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                $this->db->join('user', 'user.id=user_info.userID');
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['peer_id']))->row_array();
            } else {
                $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                $this->db->join('user', 'user.id=user_info.userID');
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['user_id']))->row_array();
            }
            $chk_if_shared = $this->db->get_where($this->db->dbprefix('share_master'), array('peer_id' => $peer['userID'], 'reference' => 'event', 'reference_id' => $id, 'status!=' => 4))->row_array();
            if (!empty($chk_if_shared)) {
                if ($chk_if_shared['status'] != 2) {
                    $html .= '<section class="list"><section class="left">
                            <figure>
                                <img src="' . userImage($peer['userID']) . '" alt="user">
                            </figure>
                            <a href="' . base_url() . 'sp/' . $peer['username'] . '"><figcaption>' . $peer['nickname'] . '</figcaption></a>
                        </section>
                        <section class="action" id="action_' . $peer['userID'] . '">';
                    if (empty($chk_if_shared)) {
                        $html .= '<button type="button" class="like" onclick="inviteToPeer(' . $peer['userID'] . ')">invite</button>';
                    } else {
                        $html .= '<button type="button" class="like" onclick="uninviteToPeer(' . $peer['userID'] . ')">invited</button>';
                    }
                    $html .= '</section>
                    </section>';
                }
            } else {
                $html .= '<section class="list"><section class="left">
                            <figure>
                                <img src="' . userImage($peer['userID']) . '" alt="user">
                            </figure>
                            <a href="' . base_url() . 'sp/' . $peer['username'] . '"><figcaption>' . $peer['nickname'] . '</figcaption></a>
                        </section>
                        <section class="action" id="action_' . $peer['userID'] . '">';
                if (empty($chk_if_shared)) {
                    $html .= '<button type="button" class="like" onclick="inviteToPeer(' . $peer['userID'] . ')">invite</button>';
                } else {
                    $html .= '<button type="button" class="like" onclick="uninviteToPeer(' . $peer['userID'] . ')">invited</button>';
                }
                $html .= '</section>
                    </section>';
            }
        }
        echo $html;
        die;
    }


    public function getPeersEVentAttending()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');


        $peer_attending = $this->db->get_where('share_master', array('reference_id' => $id, 'reference' => 'event', 'status' => 2))->result_array();
        $event_details = $this->db->get_where('event_master', array('id' => $id))->row_array();

        $html = '';

        foreach ($peer_attending as $key => $value) {
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['peer_id']))->row_array();


            $html .= '<div id="remove_peer_' . $peer['userID'] . '"><section class="list"><section class="left" >
                            <figure>
                                <img src="' . userImage($peer['userID']) . '" alt="user">
                            </figure>
                            <a href="' . base_url() . 'sp/' . $peer['username'] . '"><figcaption>' . $peer['nickname'] . '</figcaption></a>
                        </section>';
            if ($event_details['created_by'] == $user_id) {
                $html .= '<section class="action" >
                    
                            <button type="button" class="like" onclick="removePeer(' . $peer['userID'] . ')">Remove</button></section>';
            } else {
                $html .= '<section class="action" >
                    
                            <button type="button" class="like">Attending</button></section></div>';
            }
        }
        echo $html;
        die;
    }

    public function invitePeerEvent()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $insertArr = array(
            'reference' => 'event',
            'reference_id' => $id,
            'user_id' => $user_id,
            'peer_id' => $peer_id,
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s")

        );
        $this->db->insert('share_master', $insertArr);

        $action_id = $this->db->insert_id();

        $userdata = $this->session->userdata('user_data');
        $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
        $notification = "<b>" . $full_name . "</b> has invited you to an event.";

        $insertArr = array(
            'user_id'       => $peer_id,
            'notification'  => $notification,
            'action_type'   => 4, // for invite
            'action_id'     => $action_id,
            'img_user_id'   => $user_id,
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s')

        );

        $this->db->insert('notification_master', $insertArr);



        $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $peer_id, 'status' => 1))->result_array();

        foreach ($get_active_token  as $key => $value) {
            $this->sendTestNotification($value['token'], 'Event Invitation', 'You have received an event invitation', $action_id);
        }
        echo 1;
        die;
    }

    public function uninvitePeerEvent()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $this->db->order_by('share_master.id', 'desc');
        $action_detail = $this->db->get_where('share_master', array('reference' =>  'event', 'reference_id' => $id, 'user_id' => $user_id, 'peer_id' => $peer_id))->row_array();

        $this->db->where(array('id' => $action_detail['id']));
        $this->db->delete('share_master');

        $this->db->where(array('action_id' => $action_detail['id']));
        $this->db->delete('notification_master');

        echo 1;
        die;
    }

    public function removePeerAttending()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $this->db->order_by('share_master.id', 'desc');
        $action_detail = $this->db->get_where('share_master', array('reference' =>  'event', 'reference_id' => $id, 'user_id' => $user_id, 'peer_id' => $peer_id))->row_array();

        $this->db->where(array('id' => $action_detail['id']));
        $this->db->delete('share_master');


        echo 1;
        die;
    }


    public function removeSharedEvent()
    {
        $id = $this->input->post('id');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->where(array('reference_id' => $id, 'reference' => 'event', 'peer_id' => $user_id));
        $result = $this->db->update('share_master', array('status' => 4));
        echo 1;
        die;
    }

    public function attendSharedEvent()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->order_by('share_master.id', 'desc');
        $get_last_shared = $this->db->get_where($this->db->dbprefix('share_master'), array('reference_id' => $id, 'reference' => 'event', 'peer_id' => $user_id))->row_array();
        if (!empty($get_last_shared)) {
            if ($type == 'Attend') {
                $this->db->where(array('id' => $get_last_shared['id']));
                $result = $this->db->update('share_master', array('status' => 2));
                echo 'Unattend';
                die;
            } else {
                $this->db->where(array('id' => $get_last_shared['id']));
                $result = $this->db->update('share_master', array('status' => 3));
                echo 'Attend';
                die;
            }
        } else {
            $event = $this->db->get_where($this->db->dbprefix('event_master'), array('id' => $id))->row_array();
            $insertArr = array(
                'reference' => 'event',
                'reference_id' => $id,
                'user_id' => $event['created_by'],
                'peer_id' => $user_id,
                'status' => '2',
                'created_at' => date("Y-m-d H:i:s")

            );
            $this->db->insert('share_master', $insertArr);
            echo 'Unattend';
            die;
        }
    }


    public function getLatestNotification()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];

        $notification = $this->db->get_where('notification_master', array('user_id' => $user_id, 'status' => 1))->num_rows();

        $this->db->order_by('id', 'DESC');
        $this->db->limit('10');
        $last_notification = $this->db->get_where('notification_master', array('user_id' => $user_id, 'status!=' => 3))->result_array();

        $html = "";

        foreach ($last_notification as $key => $value) {
            $time_ago = time_ago_in_php($value['created_at']);
            $cls = "";
            if ($value['status'] == '2') {
                $cls = "read";
            }
            if ($value['action_type'] == 1) {


                $html .= '<li id="notification_' . $value['id'] . '" class="' . $cls . '">
                    <a>
                        <figure>
                            <img src="' . userImage($value['img_user_id']) . '" alt="user">
                        </figure>
                        <div class="right">
                            <h6>' . $value['notification'] . '</h6>
                            <div class="sortNotifyMessage">
                                <div class="info">
                                    Follower  • <div class="time">' . $time_ago . '</div>
                                </div>
                                <div class="optPreview">';
                if ($value['status'] == 1) {
                    $html .= '<div class="viewacceptance" id="accept_' . $value['id'] . '" onclick="acceptRequest(' . $value['id'] . ', ' . $value['action_id'] . ')">Accept</div>
                                        <div class="viewprofile" id="reject_' . $value['id'] . '" onclick="rejectRequest(' . $value['id'] . ', ' . $value['action_id'] . ')">Reject</div>';
                }
                $html .= '</div>
                            </div>
                        </div>
                    </a>
                </li>';
            } else if ($value['action_type'] == 2) {
                $html .= '<li id="notification_' . $value['id'] . '" class="' . $cls . '">
                    <a>
                        <figure>
                            <img src="' . userImage($value['img_user_id']) . '" alt="user">
                        </figure>
                        <div class="right">
                            <h6>' . $value['notification'] . '</h6>
                            <div class="sortNotifyMessage">
                                <div class="info">
                                    Follower  • <div class="time">' . $time_ago . '</div>
                                </div>
                                <div class="optPreview">

                                    <div class="viewprofile">View Profile</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>';
            } else if ($value['action_type'] == 3) {
                $html .= '<li id="notification_' . $value['id'] . '" class="' . $cls . '">
                    <a>
                        <figure>
                            <img src="' . userImage($value['img_user_id']) . '" alt="user">
                        </figure>
                        <div class="right">
                            <h6>' . $value['notification'] . '</h6>
                            <div class="sortNotifyMessage">
                                <div class="info">
                                    Studyset  • <div class="time">' . $time_ago . '</div>
                                </div>
                                <div class="viewprofile" onclick="redirectAction(' . $value['id'] . ')">View Studyset</div>
                            </div>
                        </div>
                    </a>
                </li>';
            } else if ($value['action_type'] == 4) {
                $html .= '<li id="notification_' . $value['id'] . '" class="' . $cls . '">
                    <a>
                        <figure>
                            <img src="' . userImage($value['img_user_id']) . '" alt="user">
                        </figure>
                        <div class="right">
                            <h6>' . $value['notification'] . '</h6>
                            <div class="sortNotifyMessage">
                                <div class="info">
                                    Event  • <div class="time">' . $time_ago . '</div>
                                </div>
                                <div class="viewprofile" onclick="redirectAction(' . $value['id'] . ')">View Event</div>
                            </div>
                        </div>
                    </a>
                </li>';
            }
        }


        $result['notification'] = $html;
        $result['count'] = $notification;

        print_r(json_encode($result));
        die;
    }


    public function reportEvent()
    {
        if ($this->input->post()) {
            $report_event_id              = $this->input->post('report_event_id');
            $report_reason          = $this->input->post('report_reason');
            $report_description     = $this->input->post('report_description');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];


            $insertArr = array(
                'event_id'             => $report_event_id,
                'report_reason'         => $report_reason,
                'user_id'               => $user_id,
                'report_description'    => $report_description,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            );

            $this->db->insert('report_event', $insertArr);


            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Reported Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/eventDetails/' . base64_encode($report_event_id)), 'refresh');
        }
    }


    public function getPostDataById()
    {
        if ($this->input->post()) {
            $post_id              = $this->input->post('post_id');

            $post_query = $this->db->query('SELECT * from posts where id = ' . $post_id)->row_array();
            $post_images_query = $this->db->query('SELECT * from post_images where post_id = ' . $post_id)->result_array();
            $post_videos_query = $this->db->query('SELECT * from post_videos where post_id = ' . $post_id)->result_array();
            $post_options_query = $this->db->query('SELECT * from post_poll_options where post_id = ' . $post_id)->result_array();
            $post_documents_query = $this->db->query('SELECT * from post_documents where post_id = ' . $post_id)->result_array();

            $posts['post_details'] = $post_query;
            $posts['post_images'] = $post_images_query;
            $posts['post_videos'] = $post_videos_query;
            $posts['post_poll_options'] = $post_options_query;
            $posts['post_documents'] = $post_documents_query;

            $html = $this->load->view('user/profile/edit-post-modal', $posts, true);
            echo $html;
        }
    }


    public function deletePollOption()
    {
        $option_id              = $this->input->post('option_id');

        $this->db->where(array('poll_option_id' => $option_id));
        $this->db->delete('user_poll_data');

        $this->db->where(array('id' => $option_id));
        $this->db->delete('post_poll_options');

        echo 1;
        die;
    }
}
