<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        // $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        // $this->output->set_header('Pragma: no-cache');
        // Set the timezone
        // date_default_timezone_set(get_settings('timezone'));
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') == true) {
            redirect(site_url('admin/dashboard'), 'refresh');
        } elseif ($this->session->userdata('user_login') == true) {
            redirect(site_url('user/dashboard'), 'refresh');
        } else {
            redirect(site_url('home/login'), 'refresh');
        }
    }

    public function validate_login($from = "")
    {
        $email = sanitizer($this->input->post('email'));
        $password = sanitizer($this->input->post('password'));
        // $credential = array('email' => $email, 'password' => sha1($password), 'is_verified' => 1 );
        $credential = "SELECT * FROM `user` WHERE (username = '$email' OR email = '$email') AND password = sha1('$password')";

        // Checking login credential for admin
        $query = $this->db->query($credential);
        //$query = $this->db->get_where('admin', $credential);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $user['is_logged_in'] = 2;
            $user['user_id']    = $row->id;
            $user['role_id']    = $row->role_id;
            $user['role']       = get_user_role('user_role', $row->id);
            $user['first_name']   = $row->first_name;
            $user['profileImage'] = empty($row->image) ? base_url() . 'uploads/user-male.png' : base_url() . '/uploads/users/' . $row->image;
            $user['user_login']   = 1;
            if ($row->role_id == 2) {
                if ($row->is_detailed == 0) {
                    $user['is_logged_in']   = 1;
                    $this->session->set_userdata('user_data', $user);
                    redirect(site_url('home/sign_up'), 'refresh');
                } else {
                    $user['is_logged_in']   = 2;
                    $this->session->set_userdata('user_data', $user);
                    redirect(site_url('account/dashboard'), 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase('provided_credentials_are_invalid'));
            redirect(site_url('home/login'), 'refresh');
        }
    }
    public function register_user()
    {
        $this->user_model->add_user();
        redirect(site_url('home/sign_up'), 'refresh');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('home/login'), 'refresh');
    }

    function forgot_password($from = "")
    {
        $email = sanitizer($this->input->post('email'));
        //resetting user password here
        $new_password = substr(md5(rand(100000000, 20000000000)), 0, 7);

        // Checking credential for admin
        $query = $this->db->get_where('user', array('email' => $email));
        if ($query->num_rows() > 0) {
            $this->db->where('email', $email);
            $this->db->update('user', array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password, $email);
            $this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('home/login'), 'refresh');
        } else {
            $this->session->set_flashdata('error_message', get_phrase('password_reset_failed'));
            redirect(site_url('home/login'), 'refresh');
        }
    }

    // function for user verification
    public function verify_email_address($verification_code = "")
    {
        $user_details = $this->db->get_where('user', array('verification_code' => $verification_code));
        if ($user_details->num_rows() == 0) {
            $this->session->set_flashdata('error_message', get_phrase('verification_failed'));
        } else {
            $user_details = $user_details->row_array();
            $updater = array(
                'is_verified' => 1
            );
            $this->db->where('id', $user_details['id']);
            $this->db->update('user', $updater);
            $this->session->set_flashdata('flash_message', get_phrase('congratulations') . '!' . get_phrase('your_email_address_has_been_successfully_verified') . '.');
        }
        redirect(site_url('home/login'), 'refresh');
    }
    public function get_mobile_no_verification()
    {

        $contact = $this->input->post('user_mobile');
        $check = $this->user_model->otp($contact);
        echo $check;
    }
    public function email_verification()
    {
        $arr = array();
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = sha1(sanitizer($this->input->post('password')));

        $guest_user['email'] = $email;
        $guest_user['username'] = $username;
        $guest_user['password'] = $password;

        $this->session->set_userdata('guest_user', $guest_user);
        $validity = $this->user_model->check_duplication('on_create', $email);
        $validate_usernme = $this->user_model->check_duplication_username('on_create', $username);
        if ($validity && $validate_usernme) {
            $check = $this->user_model->otp($email);
            $this->data['message'] = 'Verification code has been send on your mail.';
            $this->data['otp'] = $check;
            $this->data['page_name'] = 'valid_email_otp';
            $this->load->view('index', $this->data);
        } else if (!$validity) {
            $this->data['message'] = 'Email Already Exist.Please use another email';
            // $this->data['otp'] = 0;
            $this->data['page_name'] = 'register';
            $this->load->view('index', $this->data);
        } else if (!$validate_usernme) {
            $this->data['message'] = 'Username Already Exist.Please use another username';
            // $this->data['otp'] = 0;
            $this->data['page_name'] = 'register';
            $this->load->view('index', $this->data);
        }
    }

    public function validateUnique()
    {
        $value = $this->input->post('value');
        $field = $this->input->post('field');
        $duplicate_check = $this->db->get_where('user', array($field => $value))->num_rows();
        if ($duplicate_check != 0) {
            echo $field . ' already exists. Please use another one.';
            die;
        } else {
            echo 0;
            die;
        }
    }

    public function validate_otp()
    {
        $otp = $this->input->post('otp');
        if ($_SESSION['user_otp'] == $otp) {
            $data = array(
                "user_detailled" => TRUE
            );
            $this->session->set_userdata($data);
            unset($_SESSION['user_otp']);
            echo 'success';
        } else {
            echo 'failure';
        }
    }
}
