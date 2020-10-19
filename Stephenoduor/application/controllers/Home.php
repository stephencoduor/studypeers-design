<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// Home Controller
class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('upload');
        
    }
	public function index()
	{
        
		$this->data['page_name'] = 'main';
		$this->load->view('index',$this->data);

	}
    public function login()
    {
        $obj =& get_instance(); 
        $userData = $obj->session->userdata('user_data');  
        if (!empty($userData)) {
            $logged_in = $userData['is_logged_in']; 
            if($logged_in != 2){
                redirect('home/sign_up');
            } else {
                redirect('account/dashboard');
            } 
        }
        $this->data['page_name'] = 'login';
        $this->load->view('index',$this->data);
    }
    public function register()
    { 
        $this->data['message'] = '';
        $this->data['page_name'] = 'register';
        $this->load->view('index',$this->data);

    }
    
    public function sign_up() { 
        is_logged_in(); 
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $data['user_detail'] = $this->user_model->get_user_data($user_id);
        $data['field_data']  = $this->db->get_where('field_of_study_master', array('status' => 1))->result_array();
        $data['countries']  = $this->db->get('countries')->result_array();
        $this->load->view('register_form2', $data);
        
        
    }
    public function about(){
        $this->data['page_name'] = 'about';
        $this->load->view('index',$this->data);
        
    }
    public function privacy(){
        $this->data['page_name'] = 'privacy';
        $this->load->view('index',$this->data);
        
    }
    public function term(){
        $this->data['page_name'] = 'terms';
        $this->load->view('index',$this->data);
        
    }
    public function contact(){
        if($_POST){
            $insert = $_POST;
            $this->user_model->insert_data('contact',$insert);
            redirect(base_url("home/contact"));
        }else{
            $this->data['page_name'] = 'contact';
            $this->load->view('index',$this->data);
        }

    }
    public function forgot_password() {
        $this->data['page_name'] = 'forgot_password';
            $this->load->view('index',$this->data);
    }

    public function searchUniversity(){
        if($this->input->post()){
            $keyword = $this->input->post('keyword');
            
            $res = $this->db->query("SELECT * FROM `university` WHERE `SchoolName` LIKE '".$keyword."%' ESCAPE '!'")->result_array();
            
            $html = '';
            if(!empty($res)) {
                foreach ($res as $key => $value) {
                    $html.= '<div id="suggestion_'.$value['university_id'].'" onclick="selectUniversity('.$value['university_id'].')">'.$value['SchoolName'].'</div>';
                }
            }
            echo $html;die;
        }
    }

    public function searchField(){
        if($this->input->post()){
            $keyword = $this->input->post('keyword');
            $this->db->like('name', $keyword);
            $res = $this->db->get('field_of_study_master')->result_array();

            $html = '';
            if(!empty($res)) {
                foreach ($res as $key => $value) {
                    $html.= '<div id="course_suggestion_'.$value['id'].'" onclick="selectField('.$value['id'].')">'.$value['name'].'</div>';
                }
            }
            echo $html;die;
        }
    }

    public function searchMajor(){
        if($this->input->post()){
            $keyword = $this->input->post('keyword');
            $course  = $this->input->post('course');
            $this->db->like('name', $keyword);
            $res = $this->db->get_where('major_master', array('field_id' => $course))->result_array();
            $html = '';
            if(!empty($res)) {
                foreach ($res as $key => $value) {
                    $html.= '<div id="major_suggestion_'.$value['id'].'" onclick="selectMajor('.$value['id'].')">'.$value['name'].'</div>';
                }
            }
            echo $html;die;
        }
    }

    public function getMajor(){
        if($this->input->post()){
            
            $field  = $this->input->post('field');
            
            $res = $this->db->get_where('major_master', array('field_id' => $field))->result_array();
            $html = '<option value="">Select Major</option>';
            if(!empty($res)) {
                foreach ($res as $key => $value) {
                    $html.= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                }
            }
            echo $html;die;
        }
    }

    public function verifyEmail(){
        if($this->input->post()){
            $email = $this->input->post('email');
            $institute_id = $this->input->post('institute_id');
            $explode = explode("@",$email);
            $domain = $explode[1];
            $get_domain = $this->db->get_where('university', array('university_id' => $institute_id))->row_array();
            if($domain != $get_domain['EmailDomain']){
                echo 'Invalid email domain provided. Email must be of one of this domains: '.$get_domain['EmailDomain'];
            } else {
                echo '0';
            }
        }
    }


    public function saveRegistrationStepWise(){
        $step     = $this->input->post('step');
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        
        if($step == 1) {
            $first_name = $this->input->post('first_name'); 
            $last_name  = $this->input->post('last_name');
            $mobile_no  = $this->input->post('mobile_no');
            $dob        = $this->input->post('dob');
            $gender     = $this->input->post('gender');
            $country_code     = $this->input->post('country_code'); 

            $update_arr = array('first_name' => $first_name,
                                'last_name' => $last_name,
                                'phone'     => $mobile_no,
                                'country_code' => $country_code,
                                'form_step' => 1
                             );

            $this->db->where(array('id' => $user_id));
            $this->db->update('user', $update_arr);

            $data['userID'] = $user_id;
            $data['dob']    = $dob;
            $data['gender'] = $gender;  
            $this->db->insert('user_info', $data);
        } else if($step == 2) {
            $institute  = $this->input->post('institute');
            $institute_id = $this->input->post('institute_id');
            $institute_type = $this->input->post('institute_type');
            $add_institute  = $this->input->post('add_institute');

            $intitution_email = $this->input->post('intitution_email');
            $intitution_idcard  = $this->input->post('intitution_idcard');

            $data['institute_type'] = $institute_type;
        
            if($institute_type == 1){
                $data['intitutionID'] = $institute_id;
            } else {
                $data['add_institute'] = $add_institute;
            }

            
            if($this->input->post('remember')){ 
                if (!empty($_FILES['intitution_idcard']['name'])) {
                    $data['intitution_idcard'] = $this->uploadImg('intitution_idcard', $_FILES['intitution_idcard']['name']);
                } 
            } else {
                $data['intitution_email'] = $intitution_email;
            }
            
            if($this->input->post('manual_verification_check')){
                $data['manual_verification'] = 1;
            } else {
                $data['manual_verification'] = 0;
            }
            
            $this->db->where(array('userID' => $user_id));
            $this->db->update('user_info', $data);

            $update_arr = array(
                                'form_step' => 2
                             );

            $this->db->where(array('id' => $user_id));
            $this->db->update('user', $update_arr);
        } else if($step == 3) {
            $field  = $this->input->post('field');
            $major        = $this->input->post('major');
            $degree        = $this->input->post('degree');
            $session     = $this->input->post('session');
            $field_interest  = $this->input->post('field_interest');
            $field_type = $this->input->post('field_type');
            $major_type = $this->input->post('major_type');
            $data['degree'] = $degree;
            $data['field_type'] = $field_type;
            $data['major_type'] = $major_type;
            $data['field_interest'] = $field_interest;
            if($field_type == 2){
                $data['add_major'] = $major;
                $data['add_course'] = $field;
                $data['manual_verification'] = 1;
            } else {
                $data['course'] = $field;
                if($major_type == 2){
                    $data['add_major'] = $major;
                    $data['manual_verification'] = 1;
                } else {
                    $data['major'] = $major;
                }
            }
            $this->db->where(array('userID' => $user_id));
            $this->db->update('user_info', $data);
            $update_arr = array(
                                'form_step' => 3
                             );

            $this->db->where(array('id' => $user_id));
            $this->db->update('user', $update_arr);
        }
        echo 0;die;
    }


    public function submit_user_registration(){
        $user_id = $this->session->get_userdata()['user_data']['user_id']; 
        $get_user = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $get_user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $first_name = $get_user['first_name']; 
        $last_name  = $get_user['last_name'];
        $mobile_no  = $get_user['phone'];
        $dob        = $get_user_info['dob'];
        $gender     = $get_user_info['gender'];

        $institute_id   = $get_user_info['intitutionID'];
        $institute_type = $get_user_info['institute_type'];
        $add_institute  = $get_user_info['add_institute'];

        $intitution_email   = $get_user_info['intitution_email'];
        $intitution_idcard  = $get_user_info['intitution_idcard'];
        $course             = $get_user_info['course'];
        $class              = $get_user_info['major'];
        $degree             = $get_user_info['degree'];
        $session            = $get_user_info['session'];
        $field_interest     = $get_user_info['field_interest'];

        $field_type     = $get_user_info['field_type'];
        $add_course     = $get_user_info['add_course'];

        $major_type     = $get_user_info['major_type'];
        $add_major      = $get_user_info['add_major'];

        if($this->input->post('profile_setting')){
            $data['profile_setting'] =  1;
        }
        $data['privacy'] = $this->input->post('privacy');
        $nickname_text = $this->input->post('nickname_text');

        
        $full_name = $first_name.' '.$last_name;
        if($institute_type == 1){
            $get_university = $this->db->get_where('university', array('university_id' => $institute_id))->row_array();
            $university = $get_university['SchoolName'];
        } else {
            $university =  $add_institute;
            $this->email_model->send_new_university_email('admin@studypeers.com', $university, $full_name, base_url());
        }

        if($field_type == 1 && $major_type == 2){
            $this->email_model->send_new_major_email('admin@studypeers.com', $full_name, $add_major, base_url());
        } else if($field_type == 2 && $major_type == 2){
            $this->email_model->send_new_course_email('admin@studypeers.com', $full_name, $add_major, $add_course, base_url());
        }


        
        if($get_user_info['manual_verification'] == 1 || $field_type == 1 || $major_type == 1){
            if($get_user_info['manual_verification'] == 1) {
                $this->email_model->send_manual_verification('admin@studypeers.com', $university, $full_name, $intitution_email, base_url());
            }
            $this->email_model->send_manual_verification_student($get_user['email']);
        } else {
            $this->email_model->send_verification_by_student($get_user['email']);
        }

        if(!empty($intitution_email) && !$this->input->post('manual_verification_check')){
            $this->email_model->send_new_user_email('admin@studypeers.com', $full_name, $intitution_email);
        }


        if($institute_type == 1 && $get_user_info['manual_verification'] == 0 && !empty($intitution_email)){ 
            $this->email_model->send_uni_verification_by_student($intitution_email, $university, base_url().'User/verify_university_email/'.$user_id);
        }
        
        $data['nickname'] = $nickname_text;
        
        $this->db->where(array('userID' => $user_id));
        $this->db->update('user_info', $data);

        $update_arr = array(
                                'form_step' => 4,
                                'form_completed' => 1,
                                'is_detailed' => 1
                             );

        $this->db->where(array('id' => $user_id));
        $this->db->update('user', $update_arr);
        $user = $this->session->get_userdata()['user_data'];
        $user['is_logged_in'] = 2;
        $this->session->set_userdata('user_data', $user);
        redirect(base_url().'account/dashboard', 'refresh');
    }


    


    public function uploadImg($f_n, $name) {
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv' ); // Allowed file extensions

            $imagename  = time();
            $config['upload_path']      = 'uploads/user_identification/';
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
	
}
