<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
if (!function_exists('get_settings')) {
  function get_settings($type = '')
  {
    $CI = &get_instance();
    $CI->load->database();

    $CI->db->where('type', $type);
    $result = $CI->db->get('settings')->row()->description;
    return $result;
  }
}

if (!function_exists('slugify')) {
  function slugify($text)
  {
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    if (empty($text))
      return 'n-a';
    return $text;
  }
}

// Sanitize input fields
if (!function_exists('sanitizer')) {
  function sanitizer($string = "")
  {
    //$sanitized_string = preg_replace("/[^@ -.a-zA-Z0-9]+/", "", html_escape($string));
    $sanitized_string = html_escape($string);
    return $sanitized_string;
  }
}

if (!function_exists('convert_url')) {
  function convert_url($text)
  {
    $text = trim($text, '-');
    $text = preg_replace('~-~', ' ', $text);
    $text = ucfirst($text);
    return $text;
  }
}
if (!function_exists('otp')) {
  function otp($mobile)
  {
    unset($_SESSION['user_register_otp']);
    $otp = generate_random_password();
    $message = "your authentication code" . $otp;
    $res = send_sms($mobile, $message);
    $_SESSION['user_register_otp'] = $otp;
    return $otp;
  }
}
if (!function_exists('send_sms')) {
  function send_sms($mobile, $message)
  {
    $sender = "OASTRT";
    $message = urlencode($message);

    $msg = "sender=" . $sender . "&route=4&country=91&message=" . $message . "&mobiles=" . $mobile . "&authkey=326316AiwVqIDBTjr5e993f6eP1";

    $ch = curl_init('http://api.msg91.com/api/sendhttp.php?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    $result = curl_close($ch);
    return $res;
  }
}
if (!function_exists('generate_random_password')) {
  function generate_random_password($length = 6)
  {
    $numbers = range('0', '9');
    $final_array = array_merge($numbers);
    //$final_array = array_merge($numbers);
    $password = '';

    while ($length--) {
      $key = array_rand($final_array);
      $password .= $final_array[$key];
    }

    return $password;
  }
}

// Sanitize input fields
if (!function_exists('sanitizer')) {
  function sanitizer($string = "")
  {
    //$sanitized_string = preg_replace("/[^@ -.a-zA-Z0-9]+/", "", html_escape($string));
    $sanitized_string = html_escape($string);
    return $sanitized_string;
  }
}

function is_logged_in()
{
  $obj = &get_instance();
  $userData = $obj->session->userdata('user_data');
  if (!empty($userData)) {
    $logged_in = $userData['is_logged_in'];
    if ($logged_in != 1) {
      redirect('account/dashboard');
    }
  } else {
    redirect(base_url());
  }
}

function is_valid_logged_in()
{
  $obj = &get_instance();
  $userData = $obj->session->userdata('user_data');

  if (!empty($userData)) {
    $logged_in = $userData['is_logged_in'];
    if ($logged_in != 2) {
      redirect('home/step-register');
    }
  } else {
    redirect(base_url());
  }
}
// Check login status if not login redirect it to login page
function is_not_logged_in()
{
  $obj = &get_instance();
  $userData = $obj->session->userdata();
  if (empty($userData)) {
    redirect(base_url());
  }
}

function is_admin_logged_in()
{
  $obj = &get_instance();
  $userData = $obj->session->userdata('admin_login');
  if (!empty($userData)) {

    redirect('admin/dashboard');
  }
}

function is_admin_not_logged_in()
{
  $obj = &get_instance();
  $userData = $obj->session->userdata('admin_login');
  if (empty($userData)) {
    redirect(base_url('admin/login'));
  }
}

function sendFCM($message, $id, $message_info = '', $type = '')
{

  $API_ACCESS_KEY = "AAAAKqIW2jE:APA91bHoQ8MnTa5K0gBAzHguOAjf69280kgDgpGfwlueRsyA4fGIjcyzgXRBePl2n-pOgpGhmtIlEvgOnJ6Z0-vI9Znz--v9m9C5Wvz6eBLD9W5iMOYtovrJt1PkSlRBtZTOaXbUgCCv";

  $url = 'https://fcm.googleapis.com/fcm/send';

  $fields = array(
    'registration_ids' => array(
      $id
    ),
    'data' => array(
      "notification" => array(
        'title' => $message['title'],
        'body' => $message['body'],
        'icon' => '/logo-mb.jpg',
      ),
      'message_info' => $message_info,
    ),
    'priority' => 'high',

  );
  $fields = json_encode($fields);

  $headers = array(
    'Authorization: key=' . $API_ACCESS_KEY,
    'Content-Type: application/json'
  );
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  $result = curl_exec($ch);
  curl_close($ch);
}


// ------------------------------------------------------------------------
/* End of file user_helper.php */
/* Location: ./system/helpers/common.php */
