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
		
		$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
		$getUserDetails = "SELECT * FROM user WHERE id='".$CurrentUserID."'";
		$userDetailResult = $this->db->query($getUserDetails)->result_array();
		
		$isSocialLogin = 0;
		if(!empty($userDetailResult)) {
			$fb_id        = ($userDetailResult[0]['fb_id']) ? $userDetailResult[0]['fb_id'] : '';
			$google_id    = ($userDetailResult[0]['google_id']) ? $userDetailResult[0]['google_id'] : '';
			$linkedin_id  = ($userDetailResult[0]['linkedin_id']) ? $userDetailResult[0]['linkedin_id'] : '';
			$microsoft_id = ($userDetailResult[0]['microsoft_id']) ? $userDetailResult[0]['microsoft_id'] : '';
			
			$password     = ($userDetailResult[0]['password']) ? $userDetailResult[0]['password'] : '';
			
			if($password == '' && ($fb_id != '' || $google_id != '' || $linkedin_id != '' || $microsoft_id != '')){
				$isSocialLogin = 1;
			} else if($password == ''){
				$isSocialLogin = 1;
			}
		}
		
		$data['isSocialLogin'] = $isSocialLogin;
		$data['userDetails']   = ($userDetailResult) ? $userDetailResult[0] : array();
		
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
			$result['message'] = validation_errors();
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
	
	public function setPassword(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('set_new_password','New Password','required');
		$this->form_validation->set_rules('set_confirm_password','Confirm Password','required');
		$this->form_validation->set_error_delimiters('', '');
		if($this->form_validation->run() == FALSE){
			$result['status'] = false;
			$result['message'] = validation_errors();
			print_r(json_encode($result));
			die;
		} else {
			$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
			
			$new_password     = $this->input->post('set_new_password');
			$confirm_password = $this->input->post('set_confirm_password');
			
			$checkIfOldPass = "SELECT id FROM user WHERE id='".$CurrentUserID."'";
			$oldPassResult = $this->db->query($checkIfOldPass)->result_array();
			
			if(!empty($oldPassResult)) {
				
				$updatePassword['password'] = sha1($new_password);
				
				$this->db->where(array('id' => $CurrentUserID));
				if($this->db->update('user',$updatePassword)){
					$result['status'] = true;
					$result['message'] = 'Your password has been set &nbsp; succesfully.';	
				} else {
					$result['status'] = false;
					$result['message'] = 'Something went wrong!';	
				}
			} else {
				$result['status'] = false;
				$result['message'] = 'Something went wrong!';
			}
			
			print_r(json_encode($result));
			die;	
		}
	}
	
	public function changePhoneNumber() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_code','Country Code','required');
		$this->form_validation->set_rules('phone','Phone Number','required');
		$this->form_validation->set_error_delimiters('', '');
		if($this->form_validation->run() == FALSE){
			$result['status'] = false;
			$result['message'] = validation_errors();
			print_r(json_encode($result));
			die;
		} else {
			$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
			
			$country_code = $this->input->post('country_code');
			$phone        = $this->input->post('phone');
			
			$checkIfOldPass = "SELECT id FROM user WHERE id='".$CurrentUserID."'";
			$oldPassResult = $this->db->query($checkIfOldPass)->result_array();
			
			if(!empty($oldPassResult)) {
				
				$checkMoExist = "SELECT id FROM user WHERE id != '".$CurrentUserID."' AND country_code='".$country_code."' AND phone='".$phone."'";
				$MoResult = $this->db->query($checkMoExist)->result_array();
				
				if(!empty($MoResult)) {
					$result['status'] = false;
					$result['message'] = 'User with provided mobile number is already exist!';
				} else {
					$updatePhone['country_code'] = $country_code;
					$updatePhone['phone']        = $phone;
					
					$this->db->where(array('id' => $CurrentUserID));
					if($this->db->update('user',$updatePhone)){
						$result['status'] = true;
						$result['message'] = 'Your phone number has been updated succesfully.';	
					} else {
						$result['status'] = false;
						$result['message'] = 'Something went wrong!';	
					}	
				}
			} else {
				$result['status'] = false;
				$result['message'] = 'Something went wrong!';
			}
			
			print_r(json_encode($result));
			die;	
		}
	}
	
	public function changeEmailAddress() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address','Email Address','required');
		$this->form_validation->set_error_delimiters('', '');
		if($this->form_validation->run() == FALSE){
			$result['status'] = false;
			$result['message'] = validation_errors();
			print_r(json_encode($result));
			die;
		} else {
			$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
			
			$email_address = $this->input->post('email_address');
			
			$checkIfOldPass = "SELECT id FROM user WHERE id='".$CurrentUserID."'";
			$oldPassResult = $this->db->query($checkIfOldPass)->result_array();
			
			if(!empty($oldPassResult)) {
				
				$checkEmailExist = "SELECT id FROM user WHERE id != '".$CurrentUserID."' AND email='".$email_address."'";
				$emailResult = $this->db->query($checkEmailExist)->result_array();
				
				if(!empty($emailResult)) {
					$result['status'] = false;
					$result['message'] = 'User with provided email address is already exist!';
				} else {
					$updateEmail['email'] = $email_address;
					
					$this->db->where(array('id' => $CurrentUserID));
					if($this->db->update('user',$updateEmail)){
						$result['status'] = true;
						$result['message'] = 'Your email has been updated succesfully.';	
					} else {
						$result['status'] = false;
						$result['message'] = 'Something went wrong!';	
					}	
				}
			} else {
				$result['status'] = false;
				$result['message'] = 'Something went wrong!';
			}
			
			print_r(json_encode($result));
			die;	
		}
	}
	
	public function deactivateUserAccount(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('is_deactivate','Deactivate Confirmation','required');
		$this->form_validation->set_rules('reason_deactivate','Reason for Deactivation','required');
		$this->form_validation->set_error_delimiters('', '');
		if($this->form_validation->run() == FALSE){
			$result['status'] = false;
			$result['message'] = validation_errors();
			print_r(json_encode($result));
			die;
		} else {
			$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
			
			$is_deactivate          = ($this->input->post('is_deactivate')) ? $this->input->post('is_deactivate') : '';
			$reason_deactivate      = ($this->input->post('reason_deactivate')) ? $this->input->post('reason_deactivate') : '';
			$description_deactivate = ($this->input->post('description_deactivate')) ? $this->input->post('description_deactivate') : '';
			
			$checkIfUserExist = "SELECT id FROM user WHERE id='".$CurrentUserID."'";
			$userResult = $this->db->query($checkIfUserExist)->result_array();
			
			if(!empty($userResult)) {
				
				$updateUserStatus['is_deactivate']          = $is_deactivate;
				$updateUserStatus['reason_deactivate']      = $reason_deactivate;
				$updateUserStatus['description_deactivate'] = $description_deactivate;
				$updateUserStatus['deactivated_at']         = date("Y-m-d H:i:s");
				$this->db->where(array('id' => $CurrentUserID));
				if($this->db->update('user',$updateUserStatus)) {
					
					// unset current session and redirect user to login 
					$this->db->where(array('user_id' => $CurrentUserID, 'status' => 1));
					$this->db->update('user_token', array('status' => 2));
					$this->session->unset_userdata('user_data');
					
					$result['status'] = true;
					$result['message'] = 'Your account has been deactivated succesfully.';
					$result['redirect'] = base_url();					
				} else {
					$result['status'] = false;
					$result['message'] = 'Something went wrong!';	
				}
			} else {
				$result['status'] = false;
				$result['message'] = 'Something went wrong!';
			}
			
			print_r(json_encode($result));
			die;	
		}
	}
}