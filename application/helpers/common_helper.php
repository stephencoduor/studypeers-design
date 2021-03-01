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
			redirect('home/sign_up');
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

function dnd(...$_)
{
	echo "<pre>";
	var_dump($_);
	echo "</pre>";
	die;
}

if (!function_exists('get_schools')) {
	function get_schools()
	{
		$app = & get_instance();
		$app->db->select('name,canvas_url');
		$query = $app->db->get('university');
		
		$html = '<select name="school" class="form-control">';
		if ($query->num_rows()) {
			foreach ($query->result() as $row) {
				$html .= '<option value="'.$row->canvas_url.'">'.$row->name.'</option>';
			}
		}else {
			$html .= '<option value="">No Schools Available</option>';
		}

		$html .= '</select>';

		echo $html;
	}
}

function get_pagination_config() {
			$config['full_tag_open'] = '<div class="cols-xs-12 text-center"><ul   class="pagination">';
			$config['full_tag_close'] = '</ul></div>';
			// first link
			$config['first_tag_open'] = '<li class="first page-item">';
			$config['first_tag_close'] = '</li>';
			// last link
			$config['last_tag_open'] = '<li class="last page-item">';
			$config['last_tag_close'] = '</li>';
			// current active pagination
			$config['cur_tag_open'] = '<li class="active page-item"><a href="#" class="page-link"> ';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			// next (>) link
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['attributes'] = array('class' => 'page-link');
			// prev (<) link
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';

			return $config;
}

function canvas_url() {
	
	$ci =& get_instance();
	$host = $ci->input->server('SERVER_NAME');
	return ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://".$host : "http://".$host);
}

// ------------------------------------------------------------------------
/* End of file user_helper.php */
/* Location: ./system/helpers/common.php */
