<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

    }
    function get_all_row_where($table,$array,$select='*')
    {
        $this->db->select($select);
        return $this->db->get_where($table,$array)->result();
    }

    function get_single_row_where($table,$array,$select='*')
    {
        $this->db->select($select);
        return $this->db->get_where($table,$array)->row();
    }
    function get_single_row_where1($table,$array,$select='*')
    {
        $this->db->select($select);
        return $this->db->get_where($table,$array)->row_array();
    }

    public function get_single_table_query($query)
    {
        $query = $this->db->query($query);
        return $query->row();
    }
    public function get_all_table_query($query)
    {
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_single_row($table,$select='*')
    {
        $this->db->select($select);
        return $this->db->get($table)->row();
    }

    function get_all_row_where_join ($table,$array,$join,$select='*')
    {
        $this->db->select($select);
        foreach($join as $j){
            $this->db->join($j['table'],$j['parameter'],$j['position']);
        }
        return $this->db->get_where($table,$array)->result();
    }
    function get_single_row_where_join ($table,$array,$join,$select='*')
    {
        $this->db->select($select);
        foreach($join as $j){
            $this->db->join($j['table'],$j['parameter'],$j['position']);
        }
        return $this->db->get_where($table,$array)->row();
    }
    function insert_data($table,$array)
    {
        $this->db->insert($table,$array);
        return $this->db->insert_id();
    }
    function update_data($table,$where,$values)
    {
        $this->db->where($where);
        $this->db->update($table,$values);
        return true;
    }
    function delete_data($table,$where)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return true;
    }
    public function get_single_table($query)
    {
        $query = $this->db->query($query);
        return $query->row();
    }

    public function generate_random_password($length = 6) {
        $numbers = range('0','9');
        $final_array = array_merge($numbers);
        //$final_array = array_merge($numbers);
        $password = '';

        while($length--) {
            $key = array_rand($final_array);
            $password .= $final_array[$key];
        }

        return $password;
    }

    function add_user() {
        $guest_user = $this->session->userdata('guest_user');
        $data['email'] = sanitizer($guest_user['email']);
        $data['username'] = sanitizer($guest_user['username']);
        $data['password'] = sanitizer($guest_user['password']);
        $data['address'] = 'address';
        $data['phone'] = '';
        $data['about'] = '';
        $data['role_id'] = 2;
        $data['wishlists'] = '[]';
        $data['job_wishlist'] = '[]';
        $data['rental_wishlist'] = '[]';
        // $verification_code =  $this->generate_random_password();
        $data['verification_code'] = 1;
        $validity = $this->check_duplication('on_create', $data['email']);
        if($validity){
            if (strtolower($this->session->userdata('role')) == 'admin') {
                $data['is_verified'] = 1;
                $this->db->insert('user', $data);
                $user_id = $this->db->insert_id();
                $this->upload_user_image($user_id);
                $this->session->set_flashdata('flash_message', get_phrase('user_registration_successfully_done'));
            }else {
                $this->session->unset_userdata('guest_user');

                $data['is_verified'] = 0;
                $this->db->insert('user', $data);
                $user_id = $this->db->insert_id();
                $row = $this->get_single_row_where('user',array('id'=>$user_id));
                $user['is_logged_in'] = 1;
                $user['user_id']    = $row->id;
                $user['role_id']    = $row->role_id;
                $user['role']       = get_user_role('user_role', $row->id);
                $user['username']   = $row->username;
                $user['user_login']   = 1;
                $this->session->set_userdata('user_data', $user);
                // $this->upload_user_image($user_id);
                // $this->email_model->send_email_verification_mail($data['email'], $verification_code);
                $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done').'. '.get_phrase('please_check_your_mail_inbox_to_verify_your_email_address and login ').'.');
            }
        }else {
            $this->session->set_flashdata('error_message', get_phrase('this_email_id_has_been_taken'));
        }
        return;
    }
    public function check_duplication($action = "", $email = "", $user_id = "") {
        $duplicate_email_check = $this->db->get_where('user', array('email' => $email));

        if ($action == 'on_create') {
            if ($duplicate_email_check->num_rows() > 0) {
                return false;
            }else {
                return true;
            }
        }elseif ($action == 'on_update') {
            if ($duplicate_email_check->num_rows() > 0) {
                if ($duplicate_email_check->row()->id == $user_id) {
                    return true;
                }else {
                    return false;
                }
            }else {
                return true;
            }
        }
    }

    public function check_duplication_username($action = "", $username = "", $user_id = "") {
        $duplicate_check = $this->db->get_where('user', array('username' => $username));

        if ($action == 'on_create') {
            if ($duplicate_check->num_rows() > 0) {
                return false;
            }else {
                return true;
            }
        }elseif ($action == 'on_update') {
            if ($duplicate_check->num_rows() > 0) {
                if ($duplicate_check->row()->id == $user_id) {
                    return true;
                }else {
                    return false;
                }
            }else {
                return true;
            }
        }
    }

    public function send_sms($mobile, $message){
        $sender = "OASTRT";
        $message = urlencode($message);

        $msg = "sender=".$sender."&route=4&country=91&message=".$message."&mobiles=".$mobile."&authkey=326316AiwVqIDBTjr5e993f6eP1";

        $ch = curl_init('http://api.msg91.com/api/sendhttp.php?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        $result = curl_close($ch);
        return $res;
    }
    public function otp($email)
    {
        $verification_code =  $this->generate_random_password();
        $this->email_model->send_email_verification_mail($email, $verification_code);
        return $verification_code;
    }


    public function get_user_data($user_id){
        $this->db->select('user.username,user.first_name,user.last_name,user.phone,user.form_step, user_info.*');
        $this->db->join('user_info','user_info.userID=user.id');

        $result = $this->db->get_where($this->db->dbprefix('user'), array('user.id'=>$user_id))->row_array();

        return $result;
    }

    //get user's data with same email and registration_type column
    public function check_email_with_registration_type($email, $registration_type)
    {
        $query = $this->db->select('*');
        $query = $this->db->where(['email'=>$email,'registration_type'=>$registration_type]);
        $query = $this->db->get('user');
        return $query->result();
    }

    public function check_email_duplicacy($email)
    {
        $query = $this->db->select('*');
        $query = $this->db->where(['email'=>$email]);
        $query = $this->db->get('user');
        return $query->result();
    }

    public function getGoogleSocialLoginToken($user_id){
        $query = $this->db->select('google_id');
        $query = $this->db->where(['id'=> $user_id]);
        $query = $this->db->get('user');
        return $query->result();
    }
}
