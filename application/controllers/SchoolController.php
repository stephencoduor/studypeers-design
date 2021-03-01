<?php
defined('BASEPATH') or exit('No direct script access allowed');
//Controller for ui testing
class SchoolController extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('lms_model');

        // Set the timezone
        date_default_timezone_set(get_settings('timezone'));
        $this->load->library('upload');
//        $this->canvas->setApiHost($this->session->userdata('canvas')->canvasUrl);
        $this->canvas->setToken($this->session->userdata('access_token'));
    }

    public function index(){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'courses';
        $data['title']  = 'Courses | Studypeers';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        // $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']  = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $this->load->view("ui_design_test_views/header",$data);

        $this->load->view("ui_design_test_views/indexUi");
        $this->load->view("user/courses/list");

        $this->load->view("ui_design_test_views/footer");
    }

    public function assignments($course_id){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data["assignments"]=$this->db->get_where("assignments",["user_id"=>$user_id,"course_id"=>$course_id])->result_array();
        $this->index();
    }
    public function quizzes(){
        $this->index();
    }
    public function discussions(){
        $this->index();
    }
    public function notifications(){
        $this->index();
    }
    public function grades(){
        $this->index();
    }
    public function results(){
        $this->index();
    }
    public function files(){
        $this->index();
    }
    public function submissions(){
        $this->index();
    }
    public function universities(){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'schools';
        $data['title']  = 'Enrolled Schools';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data["universities"]= $this->db->query("select * from university where university_id in (select  university_id from user_tokens where user_id={$user_id} group by user_id,lms_id)")->result_array();
//          dnd($universities);



        $this->load->view('user/include/header', $data);

//        $this->load->view("ui_design_test_views/indexUi");
        $this->load->view("user/schools/list");

        $this->load->view("ui_design_test_views/footer");
    }

    public function schoolProfile($id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'University Profile';

        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data["school"]=$this->db->get_where("university",["university_id"=>$id])->row_array();
        $data['title']  = $data["school"]["name"];
//        print_r($data);die;
//        $this->load->view('front/header', $data);
        $data['course']     = $this->db->query("select * from course_master where    user_id=". $user_id." and university_id=".$id." order by created_at desc")->result_array();
//        dnd($data["course"]);
        $this->load->view('user/include/header', $data);
//		$this->load->view('ui_design_test_views/header', $data);
        $this->load->view('user/schools/profile');
        $this->load->view('user/include/footer');
    }


    function  courseDetail($school_id,$course_id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'Course Details';

        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['discussions']     = $this->db->order_by('id', 'desc')->get_where('discussion', array('user_id' => $user_id,"course_id"=>$course_id))->result_array();
        $data['quizzes']     = $this->db->order_by('id', 'asc')->get_where("quizz",array("course_id"=>$course_id))->result_array();
        $data['assignments']     = $this->db->get_where("assignment", array("course_id"=>$course_id,"user_id"=>$user_id))->result_array();
        $data["school"]=$this->db->order_by('university_id', 'desc')->get_where("university",["university_id"=>$school_id])->row_array();
        $data['results']     = $this->db->order_by('id', 'desc')->get_where('result', array('userId' => $this->session->userdata('canvas_user_id')))->result_array();
        $data['title']  = 'Course Details | '.$data["school"]["name"];
        $data["grades"]="";
        $data["notifications"]=$this->db->order_by('id', 'desc')->get_where("notifications",array("user_id"=>$user_id))->result_array();
        $data["files"]=$this->db->order_by('id', 'desc')->get_where("files",array("user_id"=>$user_id,"course_id"=>$course_id))->result_array();
        $data["submissions"]=$this->db->order_by('id', 'desc')->get_where("submissions",array("user_id"=>$user_id,"course_id"=>$course_id))->result_array();

        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id,"course_id"=>$course_id))->row_array();
//

        $this->load->view('user/include/header', $data);
        $this->load->view('user/schools/course_details');
        $this->load->view('user/include/footer');

    }

    function viewAssignment($id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'Assignment Details';
        $data['title']  = 'Assignment | Assignment';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['assignment']     = $this->db->query("select a.id, a.submissions_download_url,a.name,a.description,c.name as course_name,a.due_at,a.html_url from assignment a left join course_master c on c.course_id=a.course_id where a.user_id={$user_id} and a.id ={$id}")->row_array();
//        print_r($data['assignment']);die;
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schools/assignment_details');
        $this->load->view('user/include/footer');
    }
    function user_profileSettings(){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();

        $data['index_menu']  = 'User Profile';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
//        print_r($data);die();
        $data['title']  = $data["user_detail"]["email"]." Profile Settings";
        $data["schools"]=$this->db->query("select * from university where university_id not in (select university_id from user_tokens where user_id=".$user_id.")")->result_array();

        $canvases=$this->db->get_where("user_tokens",array("user_id"=>$user_id))->result_array();
        $data["lmses"]=$this->db->get_where("lms")->result_array();

        $data["canvases"]=$canvases;
//        dnd($canvases);
        $this->load->view('user/include/header', $data);
        $this->load->view("user/profile");
        $this->load->view('user/include/footer');
    }

    function save_canvas_token(){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $user_token["token"]=$this->input->post("token");
        $user_token["user_id"]=$this->input->post("user_id");
        $user_token["university_id"]=$this->input->post("university_id");
        $user_token["lms_id"]=$this->db->get_where("university",array("university_id"=>$user_token['university_id']))->row_array()["lms"];
        $user_token["university_name"]=$this->db->get_where("university",array("university_id"=>$user_token["university_id"]))->row_array()["name"];
        $token=$this->db->get_where("user_tokens",array("user_id"=>$user_token["user_id"],"university_id"=>$user_token["university_id"]))->row_array();
        if(!$token){
            $insert= $this->db->insert("user_tokens",$user_token);
            if($insert) {
                $this->session->set_flashdata('success', 'User Access token added successfully');
            }else{
                $this->session->set_flashdata('error', 'Some Error Occurred While Trying to Save token Please Try Again!!!!');
            }
        }else{
            $insert= $this->db->update("user_tokens",$user_token);
            if($insert) {
                $this->session->set_flashdata('success', 'User Access token Updated successfully');
            }else{
                $this->session->set_flashdata('error', 'Some Error Occurred While Trying to Save token Please Try Again!!!!');
            }
        }


        redirect("account/profile/settings");

    }
    function update_user_token($token_id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $user_token["token"]=$this->input->post("token");
        $user_token["university_id"]=$this->db->get_where("user_tokens",array("user_id"=>$user_id))->row_array()["university_id"];
        $user_token["lms_id"]=$this->db->get_where("university",array("university_id"=>$user_token['university_id']))->row_array()["lms"];
        $this->db->where("id",$token_id);
        $update=$this->db->update("user_tokens",$user_token);
        if($update){
            $this->session->set_flashdata('success', 'User Access token Updated successfully');
        }else{
            $this->session->set_flashdata('error', 'Some Error Occurred While Trying to Token token Please Try Again!!!!');
        }
        redirect("account/profile/settings");


    }


    function viewQuiz($id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'Quizz Detail';
        $data['title']  = 'Quizz | Studypeers';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data["quiz"]=$this->db->get_where("quizz",array("id"=>$id))->row_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/schools/quizz_detail');
        $this->load->view('user/include/footer');
    }

    function viewDiscussion($id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'Assignment Details';
        $data['title']  = 'Assignment | Assignment';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data["discussion"]=$this->db->get_where("discussion",array("id"=>$id))->row_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schools/discussion_detail');
        $this->load->view('user/include/footer');
    }

    function fileDetail($id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'Assignment Details';
        $data['title']  = 'Assignment | Assignment';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data["file"]=$this->db->get_where("files",array("id"=>$id))->row_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schools/file_detail');
        $this->load->view('user/include/footer');

    }
    function submissionDetail($id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'Assignment Details';
        $data['title']  = 'Assignment | Assignment';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data["submission"]=$this->db->get_where("submissions",array("id"=>$id))->row_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schools/submission_detail');
        $this->load->view('user/include/footer');
    }
    function resultDetail($id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'Assignment Details';
        $data['title']  = 'Assignment | Assignment';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data["result"]=$this->db->get_where("result",array("id"=>$id))->row_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schools/result_detail');
        $this->load->view('user/include/footer');
    }
    function notificationDetail($id){
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'Assignment Details';
        $data['title']  = 'Assignment | Assignment';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data["notification"]=$this->db->get_where("discussion",array("id"=>$id))->row_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schools/notification_detail');
        $this->load->view('user/include/footer');
    }

    function deleteLms($token_id){

        is_valid_logged_in();
        $this->db->where("id",$token_id);
      $delete=  $this->db->delete("user_tokens");
      if($delete){
          $this->session->set_flashdata('success', 'User Access token Deletion Success');
      }else{
          $this->session->set_flashdata('error', 'User Access token Deletion Failed!!!');
      }


        redirect("account/profile/settings");

    }

    function update_school($university_id){
        is_admin_not_logged_in();

        if ($this->input->method() === 'post') {
            $data = [
                "name" => $this->input->post('name'),
                "website" => $this->input->post('website'),
                "canvas_url" => $this->input->post('canvas_url'),
//				"emailDomain" => $this->input->post('emailDomain'),
                "alpha_two_code" => $this->input->post('alpha_two_code'),
                "country" => $this->input->post('country'),
                "lms" => $this->input->post('lms')

            ];
            $this->db->where("university_id",$university_id);
            if ($this->db->update('university', $data)) {
                $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> School Updated <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
                $this->session->set_flashdata('flash_message', $message);
                return redirect(site_url('admin/school/update/'.$university_id), 'refresh');
            }}
        $school=$this->db->get_where("university",array("university_id"=>$university_id))->row_array();
        if($school["lms"]){
            $page_data["school_lms"]=$this->db->query("select * from lms where id={$school['lms']}")->row_array();
            $page_data["lmses"]=$this->db->query("select * from lms where id not in (select lms from university where university_id={$university_id})")->result_array();

        }else{
            $page_data["lmses"]=$this->db->query("select * from lms")->result_array();

        }

//       dnd($page_data["lmses"]);
        $page_data['admin_data'] = $this->session->userdata('admin_login');
        $page_data['title'] = "Edit School - Studypeers";
        $page_data['active_menu'] = 'school';
        $page_data["school"]=$school;

        $this->load->view('admin/include/header', $page_data);
        $this->load->view('admin/school/edit-school');
        $this->load->view('admin/include/footer');
    }
    function delete_school($univeristy_id){
        $this->db->where("university_id",$univeristy_id);
        $delete=$this->db->delete("university");
        if($delete) {
            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> School Deleted <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
        }else{
            $message = '<div class="alert alert-danger" role="alert"><strong>Error!</strong> School Deletion Failed <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
        }

        redirect("admin/viewSchool");
    }
    function manageLms(){

        is_admin_not_logged_in();
        $page_data['admin_data'] = $this->session->userdata('admin_login');
        $page_data['title'] = "Lms List ";
        $page_data['active_menu'] = 'lms';

        $per_page = 10;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->db->count_all('lms');
        if ($total_records > 0) {

            $page_data['result'] = $this->lms_model->get_lms_records($per_page, $offset);

            $config['base_url'] = base_url() . 'admin/viewLms';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $per_page;
            $config["uri_segment"] = 3;
            $config = array_merge($config,get_pagination_config());


            $this->pagination->initialize($config);

            // build paging links
            $page_data["page_links"] = $this->pagination->create_links();

        }
        $this->load->view('admin/include/header', $page_data);
        $this->load->view('admin/lms/list');
        $this->load->view('admin/include/footer');
    }
    function  addLms(){

        is_admin_not_logged_in();
        if ($this->input->method() === 'post') {
            $data = [
                "name" => $this->input->post('name'),
                "lms_end_points" => $this->input->post('lms_end_points')
            ];
            if($_FILES["lms_logo"]["error"] == 0) {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('lms_logo'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $message = '<div class="alert alert-danger" role="alert"><strong>Error!</strong>'.$error.' <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
                    $this->session->set_flashdata('flash_message', $message);
                    return redirect(site_url('admin/addLms'), 'refresh');

                }
                else
                {
                    $data["lms_logo"] = "uploads/".$this->upload->data()["file_name"];
                }
            }

            if ($this->db->insert('lms', $data)) {
                $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Lms Added <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
                $this->session->set_flashdata('flash_message', $message);
                return redirect(site_url('admin/addLms'), 'refresh');
            }
        }
        $page_data['admin_data'] = $this->session->userdata('admin_login');
        $page_data['title'] = "Add Lms";
        $page_data['active_menu'] = 'lms';
        $this->load->view('admin/include/header', $page_data);
        $this->load->view('admin/lms/add-lms');
        $this->load->view('admin/include/footer');
    }
    function updateLms($lms_id){


        is_admin_not_logged_in();
        if ($this->input->method() === 'post') {
            $data = [
                "name" => $this->input->post('name'),
                "lms_end_points" => $this->input->post('lms_end_points')
            ];
            if($_FILES["lms_logo"]["error"] == 0) {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|bmp|jpeg';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('lms_logo'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $message = '<div class="alert alert-danger" role="alert"><strong>Error!</strong>'.$error["error"].' <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
                    $this->session->set_flashdata('flash_message', $message);
                    return redirect(site_url('admin/lms/update/'.$lms_id), 'refresh');

                }
                else
                {
                    $data["lms_logo"] = "uploads/".$this->upload->data()["file_name"];
                }
            }
            $this->db->where("id",$lms_id);
            if ($this->db->update('lms', $data)) {
                $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Lms Updated <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
                $this->session->set_flashdata('flash_message', $message);
                return redirect(site_url('admin/lms/update/'.$lms_id), 'refresh');
            }
        }
        $page_data['admin_data'] = $this->session->userdata('admin_login');

        $lms_=$this->db->get_where("lms",array("id"=>$lms_id))->row_array();
        $page_data["lms_"]=$lms_;
        $page_data['title'] = "Edit ".$lms_["name"]." Lms";
        $page_data['active_menu'] = 'lms';
        $this->load->view('admin/include/header', $page_data);
        $this->load->view('admin/lms/edit-lms');
        $this->load->view('admin/include/footer');
    }

    function deleteLmsSystem($lms_id){
        is_admin_not_logged_in();
        $this->db->where("id",$lms_id);
        $delete=$this->db->delete("lms");
        if($delete) {
            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong>Lms Deleted <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
        }else{
            $message = '<div class="alert alert-danger" role="alert"><strong>Error!</strong> Lms Deletion Failed <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
        }

        redirect("admin/viewLms");
    }

    function lmsSettings($lms_id){

        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();

        $data['index_menu']  = 'User Profile';
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
//        print_r($data);die();
        $data['title']  = $data["user_detail"]["email"]." Profile Settings";
        $data["schools"]=$this->db->query("select * from university where lms={$lms_id} and university_id not in (select university_id from user_tokens where user_id=".$user_id.")")->result_array();

        $canvases=$this->db->get_where("user_tokens",array("user_id"=>$user_id,"lms_id"=>$lms_id))->result_array();
        $data["lmses"]=$this->db->get_where("lms")->result_array();
        $data["lms_"]=$this->db->get_where("lms",array("id"=>$lms_id))->row_array();

        $data["canvases"]=$canvases;
        $this->load->view('user/include/header', $data);
        $this->load->view("user/lms");
        $this->load->view('user/include/footer');

    }
    function filteredSchools(){
        $search=$this->input->get("search");
        $count=$this->input->get("limit");
        $offset=$this->input->get("offset");
        $sort_name=$this->input->get("sort");
        $sort_order=$this->input->get("order");
        if($search) {
            $this->db->or_like('name', $search);
            $this->db->or_like('country', $search);
            $this->db->or_like('website', $search);
        }
        if($sort_name){
            $this->db->order_by($sort_name, $sort_order);
        }
        $schools=$this->db->get_where("university")->result_array();
        $s_count=sizeof($schools);
        $schools__=array_slice($schools, $offset, $count);
        $refined_data=[];
        foreach ($schools__ as $sch){
            $data_=[];
            foreach ($sch as $key => $value){
                $data_[$key]=$value;
                if(strlen($value)>30){
                    $data_[$key]=substr($value,0,30)."...";
                }
            }
            $data_["actions"]="<a href='/admin/school/update/{$sch['university_id']}?>'"."
            class='btn btn-sm btn-success fa fa-edit'></a>".
                "<button onclick='deleteSchool('{$sch['university_id']}','{$sch['name']}') ".
                "class='btn btn-sm btn-danger fa fa-trash' data-toggle='modal' data-target='#delete-school'></button>";
            $refined_data[]=$data_;
            $data_=null;
        }

       return  $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(["count"=>$s_count,"items"=>$refined_data]));
    }
}
