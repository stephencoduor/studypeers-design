<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
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
		$this->load->helper('url');
        $this->load->library('mypagination');
    }

    public function index()
    {
        is_valid_logged_in();
		
		$data['index_menu']  = 'search';
        $data['title']  = 'Settings | Studypeers';
		
		$this->load->view('user/include/header', $data);
        $this->load->view('user/settings');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }
	
	public function changePassword(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('current_password','Current Password','required');
		$this->form_validation->set_rules('new_password','New Password','required');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required');
		$this->form_validation->set_error_delimiters('', '');
		if($this->form_validation->run() == FALSE){
			$result['status'] = false;
			print_r(json_encode($result));
			die;
		} else {
			$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
			
			$current_password = sha1($this->input->post('current_password'));
			$new_password     = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');
			
			$checkIfOldPass = "SELECT id FROM user WHERE id='".$CurrentUserID."' AND password != '' AND password='".$current_password."'";
			$oldPassResult = $this->db->query($checkIfOldPass)->result_array();
			
			if(!empty($oldPassResult)) {
				
				$updatePassword['password'] = sha1($new_password);
				
				$this->db->where(array('id' => $CurrentUserID));
				if($this->db->update('user',$updatePassword)){
					$result['status'] = true;
					$result['message'] = 'Your password has been changed &nbsp; succesfully.';	
				} else {
					$result['status'] = false;
					$result['message'] = 'Something went wrong!';	
				}
			} else {
				$result['status'] = false;
				$result['message'] = 'Your entered current password is &nbsp; not matched!';
			}
			
			print_r(json_encode($result));
			die;	
		}
	}
}