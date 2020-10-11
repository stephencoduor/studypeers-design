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

	
}
