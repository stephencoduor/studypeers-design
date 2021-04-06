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
        $data['title']  = 'Search Detail | Studypeers';
		
		$this->load->view('user/include/header', $data);
        $this->load->view('user/settings');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }
}