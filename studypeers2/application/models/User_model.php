<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function get_all_users($user_id = 0) {
        if ($user_id > 0) {
            $this->db->where('id', $user_id);
        }
        return $this->db->get('user');
    }

    public function get_users() {
        $this->db->where('role_id', 2);
        return $this->db->get('user');
    }

    function add_user() {
        $data['email'] = sanitizer($this->input->post('email'));
        $data['name'] = sanitizer($this->input->post('name'));
        $data['password'] = sha1(sanitizer($this->input->post('password')));
        $data['address'] = 'address';
        $data['phone'] = sanitizer($this->input->post('phone'));
        // $data['website'] = sanitizer($this->input->post('website'));
        $data['about'] = '';
        // $social_links = array(
        //     'facebook' => sanitizer($this->input->post('facebook')),
        //     'twitter' => sanitizer($this->input->post('twitter')),
        //     'linkedin' => sanitizer($this->input->post('linkedin')),
        // );
        // $data['social'] = json_encode($social_links);
        $data['role_id'] = 2;
        $data['wishlists'] = '[]';
        $data['job_wishlist'] = '[]';
        $data['rental_wishlist'] = '[]';
        $verification_code =  md5(rand(100000000, 200000000));
        $data['verification_code'] = $verification_code;

        $validity = $this->check_duplication('on_create', $data['email']);
        if($validity){
            if (strtolower($this->session->userdata('role')) == 'admin') {
                $data['is_verified'] = 1;
                $this->db->insert('user', $data);
                $user_id = $this->db->insert_id();
                $this->upload_user_image($user_id);
                $this->session->set_flashdata('flash_message', get_phrase('user_registration_successfully_done'));
            }else {
                $data['is_verified'] = 0;
                $this->db->insert('user', $data);
                $user_id = $this->db->insert_id();
                $this->upload_user_image($user_id);
                $this->email_model->send_email_verification_mail($data['email'], $verification_code);
                $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done').'. '.get_phrase('please_check_your_mail_inbox_to_verify_your_email_address').'.');
            }
        }else {
            $this->session->set_flashdata('error_message', get_phrase('this_email_id_has_been_taken'));
        }
        return;
    }

    function edit_user($user_id) {
        $data['email'] = sanitizer($this->input->post('email'));
        $data['name'] = sanitizer($this->input->post('name'));
        $data['address'] = sanitizer($this->input->post('address'));
        $data['phone'] = sanitizer($this->input->post('phone'));
        $data['website'] = sanitizer($this->input->post('website'));
        $data['about'] = sanitizer($this->input->post('about'));
        $social_links = array(
            'facebook' => sanitizer($this->input->post('facebook')),
            'twitter' => sanitizer($this->input->post('twitter')),
            'linkedin' => sanitizer($this->input->post('linkedin')),
        );
        $data['social'] = json_encode($social_links);

        $validity = $this->check_duplication('on_update', $data['email'], $user_id);

        if($validity){
            $this->db->where('id', $user_id);
            $this->db->update('user', $data);
            $this->upload_user_image($user_id);
            $this->session->set_flashdata('flash_message', get_phrase('user_updated_successfully'));
        }else {
            $this->session->set_flashdata('error_message', get_phrase('this_email_id_has_been_taken'));
        }
        return;
    }

    public function upload_user_image($user_id) {
        if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
            move_uploaded_file($_FILES['user_image']['tmp_name'], 'uploads/user_image/'.$user_id.'.jpg');
        }
    }

    function get_user_thumbnail($user_id = "") {
        if (file_exists('uploads/user_image/'.$user_id.'.jpg')) {
            return base_url('uploads/user_image/'.$user_id.'.jpg');
        }else {
            return base_url('uploads/user_image/user.png');
        }
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

    public function change_password($user_id) {
        $data = array();
        if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $user_details = $this->get_all_users($user_id)->row_array();
            $current_password = sanitizer($this->input->post('current_password'));
            $new_password = sanitizer($this->input->post('new_password'));
            $confirm_password = sanitizer($this->input->post('confirm_password'));

            if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
                $data['password'] = sha1($new_password);
            }else {
                $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
                return;
            }
        }

        $this->db->where('id', $user_id);
        $this->db->update('user', $data);
        $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
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
      public function send_sms($mobile, $message)
      {
          $message = urlencode($message);
          $dd = 'auth_token=181228f46d568ffc031e952c4640678373aa3fc7bf28668104676dec9a38ea66&from=31001&to='.$mobile.'&text='.$message.'';
          $curl = curl_init();
          curl_setopt_array($curl, array(
              CURLOPT_RETURNTRANSFER => 1,
              CURLOPT_URL => 'http://aakashsms.com/admin/public/sms/v1/send'.$dd,
          ));
          $result = curl_exec($curl);
          return $result;
      }
      public function otp($mobile)
      {
          $otp = $this->generate_random_password();
          $message = $otp." is your authentication code.";
          $this->send_sms($mobile,$message);
          $_SESSION['user_register_otp'] = $otp;
          return $otp;
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
}
