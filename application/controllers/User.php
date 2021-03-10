<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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

	public function dashboard() {
		if ($this->session->userdata('user_login') != true) {
			redirect(site_url('login'), 'refresh');
		}
		$page_data['page_name'] = 'user/dashboard';
		$page_data['title'] = get_phrase('dashboard');
		$this->load->view('index', $page_data);
	}
	public function register_user()
    { 
    	// var_dump($_POST);die();
    	if($this->session->userdata('user_id')){
	        $userID=$this->session->userdata('user_id');
	        $mobile_no=$this->input->post('mobile_no');
	        $gender=$this->input->post('gender');
	        $dob=$this->input->post('dob');
	        $institute=$this->input->post('institute');
	        $intitution_email=$this->input->post('intitution_email');
	        $course=$this->input->post('course');
	        $session=$this->input->post('session');
	        $field_interest=$this->input->post('field_interest');
	        $is_detailed=1;
	        $insert = array(
	        'userID'=>$userID,
	        'gender'=>$gender,
	        'dob'=>$dob,
	        'intitutionID'=>$institute,
	        'intitution_email'=>$intitution_email,
	        'courseID'=>$course,
	        'session'=>$session,
	        'field_interest'=>$field_interest,
	        );
	        $this->user_model->insert_data('user_info',$insert);
	        $this->user_model->update_data('user',array('id'=>$userID),array('is_detailed'=>1));
	        // $this->data['page_name'] = 'user/notify';
	        $this->load->view('user/notify');
    	}else{
    		redirect(site_url('home', 'refresh'));
    	}	

    }

    public function verify_university_email(){
    	$user_id = $this->uri->segment('3');
    	$this->db->where(array('id' => $user_id));
        $this->db->update('user', array('is_verified' => 1));
        $get_user = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $this->email_model->send_welcome_email($get_user['email']);
        $this->data['page_name'] = 'verified_email';
        $this->data['active'] = 'verified_email';
        $this->load->view('index',$this->data); 

        
    }
    

    public function profile_verified(){
    	$this->data['page_name'] = 'verified_email';
        $this->load->view('index',$this->data); 
    }


    

	
}
