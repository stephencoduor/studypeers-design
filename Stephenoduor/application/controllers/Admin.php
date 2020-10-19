<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Admin Controller
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('user_model');
		$this->load->model('admin_model');
		$this->load->library('pagination');
		// Set the timezone
		date_default_timezone_set(get_settings('timezone'));
	}

	public function index()
	{
		if ($this->session->userdata('admin_login') == true) {
			redirect(site_url('admin/dashboard'), 'refresh');
		} else {
			redirect(site_url('admin/login'), 'refresh');
		}
	}

	public function dashboard()
	{
		is_admin_not_logged_in();
		$page_data['admin_data'] = $this->session->userdata('admin_login');
		$page_data['title'] = "Dashboard - Studypeers";
		$page_data['active_menu'] = "dashboard";
		$this->load->view('admin/include/header', $page_data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/include/footer');
	}

	public function login()
	{
		is_admin_logged_in();
		$this->load->view('admin/login');
		if ($this->input->post()) {
			$email = sanitizer($this->input->post('email'));
			$password = sanitizer($this->input->post('password'));

			$credential = "SELECT * FROM `admin` WHERE (email = '$email') AND password = sha1('$password')";

			$query = $this->db->query($credential);

			if ($query->num_rows() > 0) {
				$row = $query->row();
				$user['is_logged_in'] 	= 1;
				$user['admin_id']    	= $row->id;
				$user['role_id']    	= 1;
				$user['role']       = 1;
				$user['username']   = $row->name;

				$this->session->set_userdata('admin_login', $user);
				redirect(site_url('admin/dashboard'), 'refresh');
			} else {
				$this->session->set_flashdata('error_message', get_phrase('provided_credentials_are_invalid'));
				redirect(site_url('admin/login'), 'refresh');
			}
		}
	}

	public function logout()
	{
		is_admin_not_logged_in();

		$this->session->unset_userdata('admin_login');
		redirect(site_url('admin/login'));
	}

	public function addSchool()
	{
		is_admin_not_logged_in();
		if ($this->input->method() === 'post') {
			$data = [
				"name" => $this->input->post('name'),
				"website" => $this->input->post('website'),
				"canvas_url" => $this->input->post('canvas_url'),
				"emailDomain" => $this->input->post('emailDomain'),
				"alpha_two_code" => $this->input->post('alpha_two_code'),
				"country" => $this->input->post('country'),
				"client_id" => $this->input->post('client_id'),
				"client_secret" => $this->input->post('client_secret'),
				"token_endpoint" => $this->input->post('token_endpoint'),
				"auth_endpoint" => $this->input->post('auth_endpoint'),

			];

			if ($this->db->insert('university', $data)) {
				$message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> School Added <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
				$this->session->set_flashdata('flash_message', $message);
				return redirect(site_url('admin/addSchool'), 'refresh');;
			}
		}
		$page_data['admin_data'] = $this->session->userdata('admin_login');
		$page_data['title'] = "Add School - Studypeers";
		$page_data['active_menu'] = 'school';
		$this->load->view('admin/include/header', $page_data);
		$this->load->view('admin/school/add-school');
		$this->load->view('admin/include/footer');
	}

	function viewSchool()
	{
		$page_data['admin_data'] = $this->session->userdata('admin_login');
		$page_data['title'] = "School List - Studypeers";
		$page_data['active_menu'] = 'school';


		$per_page = 10;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->db->count_all('university');

		if ($total_records > 0) {

			$page_data['result'] = $this->admin_model->get_school_records($per_page, $offset);

			$config['base_url'] = base_url() . 'admin/viewSchool';
			$config['total_rows'] = $total_records;
			$config['per_page'] = $per_page;
			$config["uri_segment"] = 3;
			$config = array_merge($config,get_pagination_config());
			

			$this->pagination->initialize($config);

			// build paging links
			$page_data["page_links"] = $this->pagination->create_links();
		}

		$this->load->view('admin/include/header', $page_data);
		$this->load->view('admin/school/list');
		$this->load->view('admin/include/footer');
	}

	public function manageUsers()
	{
		is_admin_not_logged_in();
		$page_data['admin_data'] = $this->session->userdata('admin_login');
		$page_data['title'] = "Manage Users - Studypeers";
		$this->db->order_by('id', 'desc');
		$page_data['result'] = $this->db->get_where('user', array('is_detailed' => 1))->result_array();
		$page_data['active_menu'] = "users";
		$this->load->view('admin/include/header', $page_data);
		$this->load->view('admin/users/user-list');
		$this->load->view('admin/include/footer');
	}

	public function pendingUsers()
	{
		is_admin_not_logged_in();
		$page_data['admin_data'] = $this->session->userdata('admin_login');
		$page_data['title'] = "Manage Pending Users - Studypeers";
		$page_data['result'] = $this->db->get_where('user', array('is_detailed' => 1, 'is_verified' => 0))->result_array();
		$page_data['active_menu'] = "users";
		$this->load->view('admin/include/header', $page_data);
		$this->load->view('admin/users/user-list');
		$this->load->view('admin/include/footer');
	}


	public function viewUser()
	{
		is_admin_not_logged_in();
		$page_data['admin_data'] = $this->session->userdata('admin_login');
		$page_data['title'] = "View User - Studypeers";
		$user_id = base64_decode($this->uri->segment('3'));
		$this->db->select('user.* , user_info.*');
		$this->db->join('user_info', 'user_info.userID=user.id');

		$page_data['result'] = $this->db->get_where($this->db->dbprefix('user'), array('user.id' => $user_id))->row_array();
		$page_data['active_menu'] = "users";
		$page_data['field_data']  = $this->db->get_where('field_of_study_master', array('status' => 1))->result_array();

		$page_data['countries'] = $this->db->get('countries')->result_array();

		if ($this->input->post()) {
			// print_r($this->input->post());die;
			if ($this->input->post('update')) {
				$data = array();
				if ($this->input->post('verify_university')) {
					$university = $this->input->post('university');
					$university_url = $this->input->post('university_url');
					$country 	= $this->input->post('country');
					$country_det  = $this->db->get_where($this->db->dbprefix('countries'), array('id' => $country))->row_array();
					$email_domain = $this->input->post('email_domain');
					$uniArr = array(
						'URL' => $university_url,
						'SchoolName' 	=> $university,
						'EmailDomain' 	=> $email_domain,
						'Country' 	=> $country_det['name'],
						'alpha_two_code' => $country_det['sortname']
					);
					$uni_id = $this->user_model->insert_data('university', $uniArr);
					$data['intitutionID'] = $uni_id;
				}

				if ($this->input->post('verify_field')) {
					$add_course = $this->input->post('add_course');

					$fieldArr = array(
						'name' => $add_course,
						'status' 	=> 1
					);
					$field_id = $this->user_model->insert_data('field_of_study_master', $fieldArr);
					$data['course'] = $field_id;
				}

				if ($this->input->post('verify_major')) {
					$add_major = $this->input->post('add_major');
					if ($this->input->post('course')) {
						$field_id = $this->input->post('course');
					}
					$majorArr = array(
						'name' => $add_major,
						'field_id' 	=> $field_id
					);
					$major_id = $this->user_model->insert_data('major_master', $majorArr);
					$data['major'] = $major_id;
				}
				if (!empty($data)) {
					$this->db->where(array('userID' => $user_id));
					$this->db->update('user_info', $data);
				}
				$this->db->where(array('id' => $user_id));
				$this->db->update('user', array('is_verified' => 1));
				$this->email_model->send_welcome_email($this->input->post('email'));
				$message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> User Verified Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
				$this->session->set_flashdata('flash_message', $message);
				redirect(site_url('admin/manageUsers'), 'refresh');
			} else {
				$disable_reason = $this->input->post('disable_reason');
				$this->db->where(array('id' => $user_id));
				$this->db->update('user', array('is_disable' => 1, 'disable_reason' => $disable_reason));
				$message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> User Disabled Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
				$this->session->set_flashdata('flash_message', $message);
				redirect(site_url('admin/manageUsers'), 'refresh');
			}
		}

		$this->load->view('admin/include/header', $page_data);
		$this->load->view('admin/users/view-user');
		$this->load->view('admin/include/footer');
	}


	public function viewVerifiedUser()
	{
		is_admin_not_logged_in();
		$page_data['admin_data'] = $this->session->userdata('admin_login');
		$page_data['title'] = "View User - Studypeers";
		$user_id = base64_decode($this->uri->segment('3'));
		$this->db->select('user.* , user_info.*');
		$this->db->join('user_info', 'user_info.userID=user.id');

		$page_data['result'] = $this->db->get_where($this->db->dbprefix('user'), array('user.id' => $user_id))->row_array();
		$page_data['active_menu'] = "users";
		$page_data['field_data']  = $this->db->get_where('field_of_study_master', array('status' => 1))->result_array();

		if ($this->input->post()) {
			// print_r($this->input->post());die;
			if ($this->input->post('update')) {

				$username 	= $this->input->post('username');
				$first_name = $this->input->post('first_name');
				$last_name 	= $this->input->post('last_name');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$country_code     = $this->input->post('country_code');

				$dob 	= $this->input->post('dob');
				$gender = $this->input->post('gender');
				$intitution_email 	= $this->input->post('intitution_email');
				$institute_id 		= $this->input->post('institute_id');
				$course = $this->input->post('course');
				$major 	= $this->input->post('major');

				$degree 	= $this->input->post('degree');
				$session 	= $this->input->post('session');
				$field_interest 	= $this->input->post('field_interest');
				$profile_setting 	= $this->input->post('profile_setting');
				$privacy 	= $this->input->post('privacy');
				$nickname 	= $this->input->post('nickname');

				$verify_user 	= $this->input->post('verify_user');

				if ($this->input->post('intitution_email')) {
					$intitution_type = 1;
				} else {
					$intitution_type = 2;
				}

				$userArr = array(
					'username' 		=> $username,
					'first_name' 	=> $first_name,
					'last_name' 	=> $last_name,
					'country_code' 	=> $country_code,
					'phone' 		=> $phone,
					'is_verified' 	=> $verify_user
				);

				$this->db->where(array('id' => $user_id));
				$this->db->update('user', $userArr);

				$data = array(
					'dob' 		=> $dob,
					'gender' 	=> $gender,
					'intitution_email' 	=> $intitution_email,
					'institute_type' 	=> $intitution_type,
					'intitutionID' 	=> $institute_id,
					'session' 	=> $session,
					'field_interest' 	=> $field_interest,
					'degree' 	=> $degree,
					'privacy' 	=> $privacy,
					'nickname' 	=> $nickname,
					'major' 	=> $major,
					'course' 	=> $course,
					'profile_setting' => $profile_setting
				);

				$this->db->where(array('userID' => $user_id));
				$this->db->update('user_info', $data);

				$message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> User Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
				$this->session->set_flashdata('flash_message', $message);
				redirect(site_url('admin/manageUsers'), 'refresh');
			} else if ($this->input->post('enable')) {
				$this->db->where(array('id' => $user_id));
				$this->db->update('user', array('is_disable' => 0, 'disable_reason' => ''));
				$message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> User Enabled Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
				$this->session->set_flashdata('flash_message', $message);
				redirect(site_url('admin/manageUsers'), 'refresh');
			} else {
				$disable_reason = $this->input->post('disable_reason');
				$this->db->where(array('id' => $user_id));
				$this->db->update('user', array('is_disable' => 1, 'disable_reason' => $disable_reason));
				$message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> User Disabled Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
				$this->session->set_flashdata('flash_message', $message);
				redirect(site_url('admin/manageUsers'), 'refresh');
			}
		}

		$this->load->view('admin/include/header', $page_data);
		$this->load->view('admin/users/view-verified-user');
		$this->load->view('admin/include/footer');
	}
}
